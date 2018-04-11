<?php

class mem 
{	
	private $env;
	private $shm_max, $memlength; 	
	private $dpc_addr, $dpc_length, $dpc_free;	
	private $dataspace, $extra_space;
	//public static $pdo;	
	
	public function __construct(& $env=null) 
	{	
		$this->env = $env;
		//self::$pdo = $env::$pdo;
		
		$this->shm_max = 0;
		$this->memlength = 0; //!!!! 
		
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
	
	//mem table get
	public function get($dpc) 
	{
		if (!$dpc) return false;
		
		$offset = $this->dpc_addr[$dpc];
	    $length = $this->dpc_length[$dpc]; 
		$free = $this->dpc_free[$dpc];
		$rlength = intval($length - $free); //real length

		return array($offset, $length, $free, $rlength);	
	}

	//mem table set
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
	
	//mem table, check remaining space to fit in mem page
	public function upd($dpc, $free, &$data) 
	{
		if ((!$dpc) || ($free<0)) return false;
		
		$this->dpc_free[$dpc] = $free;
		$data .= str_repeat(' ', $free); //clean free space
		
		return $this->dpc_addr[$dpc]; //offset
	}	

	//mem table exist
	public function exist($dpc)
	{
		if (!$dpc) return false;
		
		if (isset($this->dpc_addr[$dpc]))
			return true;
		
		return false;	
	}
	
	//extra space used per file e.g. file size + 10 kb
	public function extra()
	{
		return $this->extra_space;	
	}
	
	//space for sh mem to handle
	public function space()
	{
		return $this->dataspace;	
	}	

	//max mem = libs loaded plus space
	public function maxmem()
	{
		return $this->shm_max + $this->dataspace;
	}

	//libs end offset
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

	//init and periodic check, scheduled task
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
				$read = PHP_EOL . $this->readSH($dpc) . PHP_EOL;
			}	
			
			if (($show)||($warning))
				$this->env->cnf->_say(
					$dpc . " re-loaded, " . 
					$offset . ':'. $length . ':'. $free . 
					$warning . $read,
					'TYPE_IRON');				
		}
		$this->env->cnf->_say('shmax:' . $this->shm_max . 
							", mem length:". $this->memlength . 
							", mem offset: " . $this->getOffset(), 
							'TYPE_LION');	
	}
	
	//alias kb, mb, gb converter
	private function cnv($bytes)
	{
		return $this->env->utl->convert($bytes);
	}
	
	public function getShmContents()
	{
		return @file_get_contents('shm.id');
	}	
	
	//get next offset to write
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

	
	//sh mem read
	public function readSH($dpc) {
		
		//return $this->read($dpc); //no safe

		list($offset, $length, $free, $rlength) = $this->get($dpc);
		
		return $this->env->shm->readSafe($offset, $length, $rlength); 
	}	
	
	//sh mem write
	public function writeSH($data=null, $offset=null) {
		
		//if ($this->env->shm->_shwrite($data, $offset)) //no safe
		
		if ($this->env->shm->writeSafe($data, $offset)) 	
		{		
			return $this->savestate();
		}
		return false;
	}		
	
	
	// MEM HANDLERS
	
	//init
	private function startmemdpc() 
	{   
		$this->env->cnf->_say("Start", 'TYPE_LION');  

		$data = null;
		$reloadedData = null;
		$reloadedDataBytes = 0;	
		$loadFromDir = null;//'build/cpdac7/';//null; // trail /
	  
		if ($this->shm_max = $this->loadstate($loadFromDir)) 
		{   
			//reload shm, calc bytes   
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
				//$bw = $this->writeSH($reloadedData, 0);
				//Do not Check SpinLock \0 included
				$bw = $this->env->shm->_shwrite($reloadedData, 0); //direct
				
				// Do not dump, do not unlink
				//unlink(getcwd() . '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
			
				if ($bw != strlen($reloadedData)) {
					$this->env->cnf->_say("Reloaded data:" . strlen($data) .'-'. $bw, 'TYPE_LION');
					die("Couldn't write the entire length of data\n");
				}	
				
				//do not save state
				$this->checkMem(1);	 
			}
			else
				die("Couldn't create shared memory segment. System Halted.\n");		
		}	
		else //new start
		{
			$this->shm_max = $this->load_dpc_tree($data); //\0 included
	  
			// Create shared memory block with system id if 0xff3
			$space = $this->shm_max + $this->dataspace;
			$this->env->cnf->_say("Allocate shared memory segment. $space bytes",'TYPE_CAT');
			
			if ($sid = $this->env->shm->_shopen($space)) 
			{
				//WRITE ALL DATA AT ONCE IN SHMEM
				//$bw = $this->writeSH($data, 0);
				// Do not Check SpinLock \0 included				
				$bw = $this->env->shm->_shwrite($data, 0); //direct
				
				//init mem dump w not a+ (dump includes all 1st entries not updates)
				_dump($data ,'w', '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
		
				if ($bw != $this->shm_max) 
				{
					$this->env->cnf->_say("Data:" . strlen($data) .'-'. $bw . '-' . $this->shm_max, 'TYPE_LION');
					die("Couldn't write the entire length of data\n");
				}  
				//else	
				$this->savestate();	
			}
			else
				die("Couldn't create shared memory segment. System Halted.\n");
		}
		
	    $this->env->cnf->_say("Total shmem reserved: $space bytes",'TYPE_LION');
		return $sid; 	
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
	
	//libs init (shmem offset) return &data
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
			if ($f = $this->env->fs->_readPHP($dpcf)) 
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
	    $this->env->cnf->_say("Total Bytes : ".$totalbytes, 'TYPE_IRON');
	
        return $totalbytes; 
	  }
	  else
	    die("Dpc tree error. System Halted." . PHP_EOL); 		
	} 	
   
	//Check spinlock 
	private function checkSpinLock($dpc)
	{   
       $spo = $this->dpc_addr[$dpc] - 1;
	   if ($this->env->shm->_shread($spo, 1) !== "\0")
		   return false;
	   
	   return true;
	}
	
	private function dataDiff($dpc=null, $data=null)
	{
		if (!$dpc) return false;

		$storedData = md5($this->readSH($dpc));		
 		$newData = md5($data);		
	
		$this->env->cnf->_say("md5:" . $storedData . ':'. $newData, 'TYPE_LION');
		if ($storedData != $newData)
			return true;
		
		return false;
	}
	
	//check md5 checksum for incoming data and inventory data
	private function md5diff($newData=null, $invData=null)
	{
		$a = md5($newData);		
 		$b = md5($invData);		
	
		$this->env->cnf->_say("md5:----" . $a . ':'. $b . '----', 'TYPE_LION');
		if (strcmp($a, $b)!==0)
			return true;
		
		return false;
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

	//save calls,urls etc into shared mem (server side)
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
			  
				if (($offset = $this->upd($dpc, $remaining, $data)) &&		
					($this->writeSH($data, $offset)))
				{	
					$this->env->cnf->_say("$dpc updated",'TYPE_LION');
					_dump("SAVE\n\n\n\n" . $data);
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
		
			if (($offset = $this->set($dpc, $dataLength, $data)) &&
			    ($this->writeSH("\0". $data ."\0", $offset)))
			{
				//save dump-tree for any use (phar creation etc)
				_dump("\0". $data ."\0" ,'a+', '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
					
				$this->env->cnf->_say("$dpc saved",'TYPE_LION');
				_dump("LOAD\n\n\n\n" . $data);
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
	
	//server side
	public function save($dpc=null, &$data) {
		
		return $this->savedpcmem($dpc, $data);
	}	
	
	//save calls,urls etc into shared mem (client side)
	private function getdpcmemc($dpc)
	{	 	
		$data = null;
		
		if ($this->exist($dpc))
		{
			list($offset, $length, $free, $rlength) = $this->get($dpc);
			$invdata = $this->readSH($dpc); //read mem data before

			if ($offset >= $this->shmmax()) 
			{
				if (!$data = $this->_sqlselect($dpc, false))
					if (!$data = $this->_wwwquery($dpc, false))
						if (!$data = $this->_localfile($dpc, false, $rlength)) //rlenght = md5($invdata)
							$data = $this->_variable($dpc, false);
								//files comes as variables when no change=null val

				//update if data diff (scheduled data returns always null)		
				if ((isset($data)) && ($upd = $this->md5diff($data, $invdata)))
				{ 			
					$dataLength = strlen($data); 
					$remaining = $length - $dataLength;
					
					if (($offset = $this->upd($dpc, $remaining, $data)) &&	
						($this->writeSH($data, $offset)))
					{
						$this->env->cnf->_say("$dpc updated!",'TYPE_LION');
						_dump("UPDATE\n\n\n\n" . $data);
					}
					else
					{
						_dump("MEM-ERROR\n$dpc\n$remaining\n".strlen($data)."\n" . $data, 'w', '/dumpmem-error-'.$_SERVER['COMPUTERNAME'].'.log');
						die($dpc . " (savedpcmem update remain page space: $remaining) error, increase extra space!" . PHP_EOL); 
					}	
					
				}//if data and data diff
				else
					$data = $invdata;
			}
			//else continue 
			//$data = $this->readSH($dpc); //read at top
			$isupdate = $upd ? ' updated ' : null;
			$this->env->cnf->_say("read $isupdate $dpc :" . strlen($data), 'TYPE_RAT');
		}
		else //NEW
		{ 
			if (!$data = $this->_sqlselect($dpc, true))
				if (!$data = $this->_wwwquery($dpc, true))
					if (!$data = $this->_localfile($dpc, true, false))
						if (!$data = $this->_variable($dpc, true))
							return false;

			//if (!$data) return false;	
			_say($data,3);		
		
			$dataLength = strlen($data);		

			if (($offset = $this->set($dpc, $dataLength, $data)) &&
				($this->writeSH("\0". $data ."\0", $offset)))
			{
				//save dump-tree for any use (phar creation etc)
				_dump("\0". $data ."\0" ,'a+', '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
				
				$this->env->cnf->_say("$dpc saved!",'TYPE_LION');
				_dump("INSERT\n\n\n\n" . $data);
			}
			else
			{		
				_dump("MEM-ERROR\n$dpc\noffset: $offset\nlength: ".strlen($data)."\n" . $data, 'w', '/dumpmem-error-'.$_SERVER['COMPUTERNAME'].'.log');		
				die($dpc . " (getdpcmemc save offset:$offset) error, increase data space!" . PHP_EOL);
			}	
		
			$this->env->cnf->_say("New $dpc : " . strlen($data), 'TYPE_RAT');	
		}
	  
		return ($data);		
	}
	
	//client side (client side)
	public function readC($dpc)
	{
		return $this->getdpcmemc($dpc);
	}		

	//sql handler (client side)
	private function _sqlselect($dpc, $new=false)
	{
		if (substr($dpc,0,7)!=='select-') return null;
		   
		if ($new)
		{		
			$data = json_encode($_data);
			_say($data,3); //show new data				
		}	
		else
		{		
			if ((!$this->env->scheduler->findschedule($dpc)) /*&&
				is_resource(self::$pdo)*/)
			{
			/*
				$pdodpc = str_replace('-',' ',$dpc);
				foreach(self::$pdo->query($pdodpc, PDO::FETCH_ASSOC) as $row) 
					$_data[] = $row;
			*/
				$_data = $this->env->pdoQuery($dpc);			
				$data = json_encode($_data);
			}
			else
				$data = null; //bypass
		}

		return $data;	
	}

	//www handler (client side)
	private function _wwwquery($dpc, $new=false)
	{
		if (substr($dpc,0,4)!=='www.') return null;
		   
		$data = (!$this->env->scheduler->findschedule($dpc)) 
				?
				$this->env->utl->httpcl($dpc) : 
				null; //bypass
						
		if ((!$data) && (!$new))
		{
			$this->env->cnf->_say('Scheduled data stream:' . $dpc, 'TYPE_LION');
			_say($data,3);
		}				
		
		return $data;		
	}

	//file handler (client side)
	private function _localfile($dpc, $new=false, $rlength=false)
	{
		if (!is_readable($this->env->dpcpath . $dpc)) return null; 
	
		if ($new) 
		{
			//local storage
			$data = $this->env->fs->_readPHP($this->env->dpcpath . $dpc); 			
		}
		else
		{
			//local storage reload ----------md5 !!! 
			//if (strcmp(md5('$this->env->dpcpath . $dpc'), $rlength)!=0)	
				
			$sf = @filesize($this->env->dpcpath . $dpc);
			$this->env->cnf->_say("Size:" . $rlength .':' . $sf, 'TYPE_RAT');
			if ($rlength != $sf) {	
				$data = $this->env->fs->_readPHP($this->env->dpcpath . $dpc); 
				_say($data,3); 
			}	
			else
				$data = null; //bypass and read			
		}
		
		return $data;		
	}	
	
	//var handler - process handler (client side)
	private function _variable($dpc, $new=false)
	{
		$data = null;
		//if () //VARIABLE
		//{   
			if ($new) //INSERT
			{
				//create var
				//$this->env->cnf->_say($this->env->dpcpath . $dpc . ' not found!', 'TYPE_LION');	
				
				//MUST BE POOLED
				if ($async = $this->env->proc->set($dpc) > 0) 
				{
					$this->env->cnf->_say('reading variable (async): ' . $dpc, 'TYPE_LION');
					//..open client at async class
					exec("start /D d:\github\phpdac7\bin agentds process");
					//..data write
					//re-save chain (remove)
				}
				else {	
					$this->env->cnf->_say('reading variable (sync): ' . $dpc, 'TYPE_LION');
					
					//proceed at once
					if ($dataNOWRITE = $this->env->proc->go()) {
						//print_r($this->proc->getProcessStack());
						//echo implode(',', $this->env->proc->getProcessChain()) . ' finished!' . PHP_EOL; 
						$this->env->cnf->_say(implode(',', $this->env->proc->getProcessChain()) . ' finished', 'TYPE_LION');
					}
					/*
					//test imo
					$immX = Immutable::create()
							->set('test', 'a string goes here')
							->set('another', 100)
							->arr([1,2,3,4,5,6])
							->arr(['a' => 1, 'b' => 2])
							->build();
					echo (string) $immX;
					
					$immY = Immutable::create()
							->set('anObject', $immX)
							->build();
					echo (string) $immY;
					echo $immY->get('test'); // a string goes here
					var_dump($immY->has('test')); // bool(true)
					var_dump($immY->has('non-existent')); // bool(false)
					echo $immY->getOrElse('test', 'some default text'); // a string goes here
					echo $immY->getOrElse('non-existent', 'some default text'); // some default text
					
					$immZ = Immutable::with($immY)
							->set('a story', 'This is where someone should write a story')
							->setIntKey(300, 'My int indexed value')
							->arr(['arr: int indexed', 'arr' => 'arr: assoc key becomes immutable key'])
							->build();
					echo (string) $immZ;
					*/		
				}
				
			
				//open client to proceess(s) 
				//-pool check and reply based on client response..
				/*
				$dataTEST = (new proc($this))
							->set($dpc)
							->go();
				echo $dataTest . PHP_EOL;			
				*/				
			}
			else
			{
				$this->env->cnf->_say('reading variable: '. $dpc, 'TYPE_BIRD');	
				$data = null ;//bypass and read
			}
		//}		
		
		return $data;		
	}	
	
    private function close() 
    {
		//@unlink("shm.id"); //NO DEL NEED FILE
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