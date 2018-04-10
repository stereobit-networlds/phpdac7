<?php

class mem 
{	
	private $env;
	private $shm_max, $memlength; 	
	private $dpc_addr, $dpc_length, $dpc_free;	
	private $dataspace, $extra_space;	
	
	public function __construct(& $env=null) 
	{	
		$this->env = $env;
		
		$this->shm_max = 0;
		$this->memlength = 0;
		
		$this->dpc_attr = array();
		$this->dpc_length = array();
		$this->dpc_free = array();
		
		$this->extra_space = 1024 * 10; //kb //1000;// per file (shmid res inc+)
		$this->dataspace = 1024000 * 9; //mb //90000; //sum of shmem without preinsert		
	}
	
	public function initialize() 
	{
		return $this->startmemdpc();
	}		
	
	public function get($dpc) 
	{
		if (!$dpc) return false;
		
		$offset = $this->dpc_addr[$dpc];
	    $length = $this->dpc_length[$dpc]; 
		$free = $this->dpc_free[$dpc];
		$rlength = intval($length - $free); //real length

		return array($offset, $length, $free, $rlength);	
	}

	public function set($dpc, $length=false, &$data) 
	{
		if ((!$dpc) || (!$length)) {
			_dump("MEMSET\n\n$dpc length:$length\n\n", 'a+', '/dumpmem-error-'.$_SERVER['COMPUTERNAME'].'.log');
			return false;
		}	
		
		$offset = $this->getOffset();
		$mempage = $offset + $length + $this->extra_space + 2; //1+1 = spinlocks
		$maxmem = $this->shm_max + $this->dataspace;
		
		if ($mempage < $maxmem)	
		{
			$this->memlength = $mempage; 
			
			$this->dpc_addr[$dpc] = $offset;		
			$this->dpc_length[$dpc] = $length + $this->extra_space;
			$this->dpc_free[$dpc] = $this->extra_space;
	
	        $data .= str_repeat(' ', $this->extra_space); //clean free space
			return $offset;
		}
		_dump("MEMSET\n$dpc\nlength:$length\nmaxmem:$maxmem\nmempage:$mempage\noffset:$offset\n", 'a+', '/dumpmem-error-'.$_SERVER['COMPUTERNAME'].'.log');
		return false;
	}
	
	//check remaining space to fit in mem page
	public function upd($dpc, $free, &$data) 
	{
		if ((!$dpc) || ($free<0)) return false;
		
		$this->dpc_free[$dpc] = $free;
		$data .= str_repeat(' ', $free); //clean free space
		
		return $this->dpc_addr[$dpc]; //offset
	}	

	public function exist($dpc)
	{
		if (!$dpc) return false;
		
		if (isset($this->dpc_addr[$dpc]))
			return true;
		
		return false;	
	}
	
	public function extra()
	{
		return $this->extra_space;	
	}
	
	public function space()
	{
		return $this->dataspace;	
	}	

	public function maxmem()
	{
		return $this->shm_max + $this->dataspace;
	}

	public function shmmax()
	{
		return $this->shm_max;
	}	

	public function calc()
	{
		$totalbytes = 0;
		
		reset($this->dpc_length);
		foreach ($this->dpc_length as $dpc=>$length)
			$totalbytes+= $length + $this->dpc_free[$dpc];
			
		return $totalbytes;	
	}	

	//scheduled task
	public function checkMem($show=false)
	{		
		reset($this->dpc_length);
		foreach ($this->dpc_length as $dpc=>$length) 
		{
			$warning = false;
			$read = null;
			$offset = $this->dpc_addr[$dpc];
			$free = $this->dpc_free[$dpc];
			
			if ($free < intval(1024 * 5)) //1 kb
			{
				$warning = ' <<<<<<<<<<<<<<<<<< need extra space!'; 
				$read = PHP_EOL . $this->read($dpc) . PHP_EOL;
			}	
			
			if (($show)||($warning))
				$this->env->cnf->_say(
					$dpc . " re-loaded, " . 
					$offset . ':'. $length . ':'. $free . 
					$warning . $read,
					'TYPE_LION');				
		}
		$this->env->cnf->_say('shmax:' . $this->shm_max . 
							"\nmem length:". $this->memlength . 
							"\nmem offset: " . $this->getOffset(), 'TYPE_LION');	
	}
	
	private function cnv($bytes)
	{
		return $this->env->utl->convert($bytes);
	}
	
	private function getOffset() {
		$offset = 0; 
		$zeros = 0;
		
		reset($this->dpc_length);
		foreach ($this->dpc_length as $_dpc=>$_size)
		{
			$offset += $_size;
			$zeros +=2; //spinlocks
		}
		$offset += $zeros; //segments x 2		   
		return ($offset + 1); 
	}	
	
	private function startmemdpc() 
	{   
		$this->env->cnf->_say("Start", 'TYPE_LION');  

		$data = null;
		$reloadedData = null;
		$reloadedDataBytes = 0;	
		$loadFromDir = null;//'build/cpdac7/';//null; // trail /
	  
		if ($this->shm_max = $this->loadstate($loadFromDir)) 
		{   //reload shm
	
			//only calc bytes   
			$calc_shm_max = $this->load_dpc_tree($data, true); 
		
			if ($calc_shm_max != $this->shm_max)
			{	
				$this->env->cnf->_say('Reloaded data size: '. $this->shm_max, 'TYPE_LION');
				//die($calc_shm_max . '-' . $this->shm_max . PHP_EOL);
				//no die, delete shm_id
			}
			$space = $this->shm_max + $this->dataspace;
			$this->env->cnf->_say("Re-allocate shared memory segment. $space bytes",'TYPE_CAT');
		
			if ($sid = $this->env->shm->_shopen($space)) 
			{
				//re-load dump file
				if (!$reloadedData = @file_get_contents($loadFromDir . 'dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log'))
						die('Dump file missing.' . PHP_EOL);
			
				//WRITE ALL DATA AT ONCE IN SHMEM
				//Do not Check SpinLock \0 included		
				$bw = $this->writeSH($reloadedData, 0);
				// Do not dump
				//unlink(getcwd() . '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
			
				if ($bw != strlen($reloadedData)) 
					die("Couldn't write the entire length of data\n");
				
				//do not save state
				$this->checkMem(1);	 
			}
			else
				die("Couldn't create shared memory segment. System Halted.\n");		
		}	
		else //new start
		{
			$this->shm_max = $this->load_dpc_tree($data); //\0 included
			//echo ">>>>>>>>>>>>>>>", $this->shm_max;
	  
			///////////////allocate dpc tree
			// Create shared memory block with system id if 0xff3
			$space = $this->shm_max + $this->dataspace;
			$this->env->cnf->_say("Allocate shared memory segment. $space bytes",'TYPE_CAT');
			
			if ($sid = $this->env->shm->_shopen($space)) 
			{
				// Do not Check SpinLock \0 included		
				$bw = $this->writeSH($data, 0);
				//init mem dump w not a+ (dump includes all 1st entries not updates)
				_dump($data ,'w', '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
		
				if ($bw != $this->shm_max) 
				{
					die("Couldn't write the entire length of data\n");
				}  
				else	
					$this->savestate();	
			}
			else
				die("Couldn't create shared memory segment. System Halted.\n");
		}
		
	    $this->env->cnf->_say("Total shmem reserved: $space bytes",'TYPE_LION');
		return $sid; 	
	}

	public function getShmContents()
	{
		return @file_get_contents('shm.id');
	}	
	
	//save shared mem resource id and mem alloc arrays
	public function savestate() //make private
	{   
		$this->env->cnf->_say("Save state", 'TYPE_RAT');
		$data = $this->shm_max ."@^@". serialize($this->dpc_addr) . 
		                       "@^@". serialize($this->dpc_length). 
							   "@^@". serialize($this->dpc_free) .
							   "@^@" . $this->memlength;
						
		//save table in sh mem as resource var..
		//at runtime loop, recursional memory err
		//$this->savedpcmem('srvState',$data); /recursion err, at timer
							
		return file_put_contents('shm.id', $data ,LOCK_EX);
	}
   
	//load shared mem resource id and mem alloc arrays
	private function loadstate($altdir=null) 
	{
	   if ($data = @file_get_contents($altdir . 'shm.id'))
	   {
			$this->env->cnf->_say("Load state", 'TYPE_RAT');
			if ($altdir)
				$this->env->cnf->_say($altdir, 'TYPE_RAT');

			//save table in sh mem as resource var (already in)
			//at runtime loop, recursional memory err
			//$this->savedpcmem('srvState',$data);	
		   
			$entries = explode('@^@', $data);
			if (is_array($entries)) {
				$this->shm_max = $entries[0];				
				$this->dpc_addr = (array) unserialize($entries[1]);
				$this->dpc_length = (array) unserialize($entries[2]);
				$this->dpc_free = (array) unserialize($entries[3]);
				$this->memlength = $entries[4];

				$this->env->cnf->_say("shm_max:" . $entries[0], 'TYPE_LION');
				return ($entries[0]);
			}
	   }
	   $this->env->cnf->_say("shm_max:" . $data, 'TYPE_LION');
	   return false;
	}
	
	//return &data
    private function load_dpc_tree(&$data, $reload=false) {
	   $libs = null;
	   $exts = null;
   	
	   $this->env->cnf->_say("loading dpc modules...", 'TYPE_RAT');	   
	   $libs = $this->env->fs->read_dpcs();
	   //echo "loading dpc extensions...\n";	
	   //$exts = $this->fs->read_extensions();
	   
	   $tree = (is_array($exts)) ? array_merge($libs,$exts) : $libs;
	   //print_r($tree);  
	  
	   if ($tree) 
	   {
	    //print_r($tree);
	    //echo ".....\n";
	    //$offset = 0;
	    foreach($tree as $dpc_id=>$dpcf) 
		{
	      if (($dpcf!='') && ($dpcf[0]!=';')) 
		  {
		    if ($f = $this->env->fs->_readPHP($dpcf)) //@file_get_contents($dpcf)) 
			{
              if ($reload===false) //bypass, just compute bytes
			  { 		
					$this->set($dpcf, strlen($f), $f); //clean f 
					//$offset+= $this->dpc_length[$dpcf];// + 1; //\0foot
			  }
			  //add header sign
			  $data .= "\0";
			  $data .= $f; //cleaned
			  //add extra space for modifications (clean)
			  //$data .= str_repeat(' ', $this->extra_space);
			  //add foot sign
			  $data .= "\0";
			  
			  if ($reload===false)
				$this->env->cnf->_say($dpcf . " loaded", 'TYPE_LION');
			  //else //show index at load
				//$this->env->cnf->_say($dpcf . " re-loaded", 'TYPE_LION');  
		    }
		    else 
	          $this->env->cnf->_say($dpcf . " Error", 'TYPE_LION');
	 
		  }
	    }
	    $totalbytes = strlen($data);
	    $this->env->cnf->_say("\nTotal Bytes : ".$totalbytes, 'TYPE_LION');
	
        return $totalbytes; 
	  }
	  else
	    die("Dpc tree error. System Halted." . PHP_EOL); 		
	} 	
   
	//Check SpinLock
	private function checkSpinLock($dpc)
	{   
       $offset = $this->dpc_addr[$dpc] - 1;
	   if ($this->env->shm->_shread($offset-1, 1) !== "\0")
		   return false;
	   
	   return true;
	}
	
	private function dataDiff($dpc=null, $data=null)
	{
		if (!$dpc) return false;

		$storedData = md5($this->read($dpc));		
 		$newData = md5($data);		
	
		$this->env->cnf->_say("md5:" . $storedData . ':'. $newData, 'TYPE_LION');
		if ($storedData != $newData)
			return true;
		
		return false;
	}

	//save calls,urls etc into shared mem
	private function savedpcmem($dpc, &$data) 
	{
	   $dataLength = strlen($data); 
	   
	   if (isset($this->dpc_addr[$dpc])) 
	   {
			//rewrite  
			list($offset, $length, $free, $rlength) = $this->get($dpc);	
		     
			if (isset($data)) //replace
			{				
			  $remaining = $length - $dataLength;			  
			  
			  if ($offset = $this->upd($dpc, $remaining, $data))		
			  {
					/*				    
					if ($this->checkSpinLock($dpc)===false)
						$this->env->cnf->_say(">>>>>>>>>>>>>>>>>>>>>>>>>>>spinlock 0:$dpc",'TYPE_DOG');		
					*/
					if ($this->writeSH($data, $offset))
					{	
						$this->savestate();
						$this->env->cnf->_say("$dpc updated",'TYPE_LION');
						_dump("SAVE\n\n\n\n" . $data);
					}	
			  }
			  else
			  {
				  _dump("MEM-ERROR\n$dpc\n$remaining\n".strlen($data)."\n" . $data, 'w', '/dumpmem-error-'.$_SERVER['COMPUTERNAME'].'.log');
				  die($dpc . " (savedpcmem update remain page space: $remaining) error, increase extra space!" . PHP_EOL); 
			  }
			
			}//if data			 
	   }
	   else { //write first time (append)
	   
			if (!$data) return false;	
			_say($data,3);
		
			if ($offset = $this->set($dpc, $dataLength, $data))	
			{
				/*
				if ($this->checkSpinLock($dpc)===false)
					$this->env->cnf->_say(">>>>>>>>>>>>>>>>>>>>>>>>>>>spinlock 1:$dpc",'TYPE_DOG'); 
				*/	
				if ($this->writeSH("\0". $data ."\0", $offset))
				{
					_dump("\0". $data ."\0" ,'a+', '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
					
					$this->savestate();
					$this->env->cnf->_say("$dpc saved",'TYPE_LION');
					_dump("LOAD\n\n\n\n" . $data);
				}
			}
			else
			{		
				_dump("MEM-ERROR\n$dpc\noffset: $offset\nlength: ".strlen($data)."\n" . $data, 'w', '/dumpmem-error-'.$_SERVER['COMPUTERNAME'].'.log');
				die($dpc . " (savedpcmem save offset:$offset) error, increase data space!" . PHP_EOL);		
			}	
			     
	   }
	   $this->env->cnf->_say("Data : " . $dataLength, 'TYPE_RAT');	   
	   
	   return ($data);
	} 	
	
	public function save($dpc=null, &$data) {
		
		return $this->savedpcmem($dpc, $data);
	}	
	
	
	//fetch shared mem page (empty spaces)
	private function loaddpcmem($dpc) 
	{
		if (isset($this->dpc_addr[$dpc])) 
		{
			return 
			$this->env->shm->_shread($this->dpc_addr[$dpc], 
									 $this->dpc_length[$dpc]);
        }
		return false; 	
	}	
	
	//fetch trimed shm page plus stats (if)
	private function getdpcmem($dpc=null, $stats=false) 
	{
		list($offset, $length, $free, $rlength) = $this->get($dpc);
		
		if ($data = $this->loaddpcmem($dpc))
			$ret = $data . $offset . ':' . $length . ':' . $free . PHP_EOL;
		else
			$ret = "Invalid dpc!";
	  
		return ($stats ? $ret : trim($data));	      
	}
	
	//alias public
	public function read($dpc=null) {
		
		return $this->getdpcmem($dpc);
	}
	
	//main client dipatcher (prototype)
	private function getdpcmemc($dpc)
	{	 	  
		if ($this->exist($dpc))
		{
			list($offset, $length, $free, $rlength) = $this->get($dpc);
			
			if ($offset >= $this->shmmax()) 
			{
				if (substr($dpc,0,7)==='select-') //PDO
				{
					if (!$this->env->scheduler->findschedule($dpc)) 
					{
						//update data
					}
					else
						$data = null; //bypass and read	
				}
				elseif (substr($dpc,0,4)==='www.') //WWW 
				{
					if (!$this->env->scheduler->findschedule($dpc)) 
					{
						//update data
					}
					else
						$data = null; //bypass and read
				}
				elseif (@is_readable($this->env->dpcpath . $dpc)) //FILE
				{
					if ($filediff) {
						//update data
					}	
					else
						$data = null; //bypass and read
				}
				else //VAR
				{
					$data = null ;//bypass and read
				}

				if (isset($data)) 
				{ 
					if ($dataLength < $length) 
					{
						//update data
					}	
					else
					{
						_dump("MEM-ERROR\n$dpc\nremain page space: $remaining\nlength: ".strlen($data)."\n" . $data, 'w', '/dumpmem-error-'.$_SERVER['COMPUTERNAME'].'.log');
						die($dpc . " (getdpcmem update) error, increase extra space!" . PHP_EOL); 
					}	
				}
			}
			//read mem
		}
		else //NEW
		{ 
			if (substr($dpc,0,7)==='select-') //PDO
			{
				if (!$this->env->scheduler->findschedule($dpc)) 
				{
				}
			}
			elseif (substr($dpc,0,4)==='www.') //WWW 
			{
				$data = (!$this->env->scheduler->findschedule($dpc)) ?
						$this->env->utl->httpcl($dpc) : null; //bypass
			}
			elseif (is_readable($this->env->dpcpath . $dpc)) //FILE
			{
			}
			else //new VAR
			{
				//new process
			}

			if (!$data) return false;
			
			//write mem
			if ($mempage < $memmax)	
			{
			}
			else
			{	
				_dump("MEM-ERROR\n$dpc\noffset: $offset\nlength: ".strlen($data)."\n" . $data, 'w', '/dumpmem-error-'.$_SERVER['COMPUTERNAME'].'.log');		
				die($dpc . " (getdpcmemc save offset:$offset) error, increase data space!" . PHP_EOL);			
			}	
		}
	  
		return ($data);		
	}
	
	//alias public
	public function readC()
	{
		return $this->getdpcmemc($dpc);
	}
	
	public function readSH($dpc) {
		
		return $this->read($dpc);
		//return $this->env->shm->_shread($dpc);
		//return $this->env->shm->readSafe($dpc); 
	}	
	
	public function writeSH($data=null, $offset=null) {
		
		if ($this->env->shm->_shwrite($data, $offset))	
		//if ($this->env->shm->writeSafe($dpc, $data)) //no /0	
		{		
			return true;//$this->savestate();
		}
		return false;
	}		

    private function close() 
    {
		//@unlink("shm.id"); //NO DEL
		//$this->env->cnf->_say("Deleting state..!",'TYPE_LION'); 
	  
		return true;	
    }	
	
	//public function free()	
	public function __destruct() 
	{		
	    $this->close();

		return true;	
	}	
}	
?>