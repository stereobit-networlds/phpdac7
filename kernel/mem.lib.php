<?php

class mem 
{	
	private $env;
	private $shm_max, $memlength; 	
	private $dpc_addr, $dpc_length, $dpc_free, $dpc_gc;	
	private $dataspace, $extra_space, $gc;	
	
	public function __construct(& $env=null) 
	{	
		$this->env = $env;
		
		$this->shm_max = 0;
		$this->memlength = 0; //mem dump 
		
		$this->dpc_attr = array();
		$this->dpc_length = array();
		$this->dpc_free = array();
		
		$this->extra_space = 1024 * 10; //kb //1000;// per file (shmid res inc+)
		$this->dataspace = 1024000 * 9; //mb //90000; //sum of shmem without preinsert		
		
		$this->gc = true;
	}
	
	public function initialize() 
	{
		return $this->startmemdpc();
	}

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
			$this->env->cnf->_say("Re-allocate memory segment. $space bytes",'TYPE_CAT');
		
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
				die("Couldn't create memory segment. System Halted.\n");		
		}	
		else //new start
		{
			$this->shm_max = $this->load_dpc_tree($data); //\0 included
	  
			// Create shared memory block with system id if 0xff3
			$space = $this->shm_max + $this->dataspace;
			$this->env->cnf->_say("Allocate smemory segment. $space bytes",'TYPE_CAT');
			
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
				die("Couldn't create memory segment. System Halted.\n");
		}
		
	    $this->env->cnf->_say("Total mem reserved: $space bytes",'TYPE_LION');
		return $sid; 	
	}	
	
	
	//mem table get
	public function get($dpc) 
	{
		if (!$dpc) return false;
		
		$offset = $this->dpc_addr[$dpc];
	    $length = $this->dpc_length[$dpc]; 
		$free = $this->dpc_free[$dpc];
		$rlength = intval($length - $free) + 1; //real length

		return array($offset, $length, $free, $rlength);	
	}

	//mem table set
	public function set($dpc, $length=false, &$data) 
	{
		if ((!$dpc) || (!$length)) 
		{
			_dump("MEMSET\n\n$dpc length:$length\n\n", 'a+', '/dumpmem-error-'.$_SERVER['COMPUTERNAME'].'.log');
			return false;
		}	
		
		//get an offset
		list ($offset, $lGC, $fGC) = $this->getOffset($length);
		//$offset = $this->getOffset();
		
		//if retreived offset,length,freespace from gc
		/*if ($lGC > 0) 
		{   
			//gc mem input in between
			$this->env->cnf->_say("GC  <<<<<<<<<<<<<<<< $dpc",'TYPE_LION');
			
			$this->dpc_addr[$dpc] = $offset;		
			$this->dpc_length[$dpc] = $lGC;
			$this->dpc_free[$dpc] = $fGC;
	
			$data .= str_repeat(' ', $fGC); //clean free space
			return $offset;
		}
		else
		{ */  
			//standart incremental input
			$mempage = $offset + $length + $this->extra_space + 2; //1+1 = spinlocks
			$maxmem = $this->shm_max + $this->dataspace;	
			//check for mem limit
			if ($mempage < $maxmem)	
			{
				$this->memlength = $mempage; //update global var !!!
			
				$this->dpc_addr[$dpc] = $offset + 1;		
				$this->dpc_length[$dpc] = $length + $this->extra_space;
				$this->dpc_free[$dpc] = $this->extra_space;
	
				$data .= str_repeat(' ', $this->extra_space); //clean free space
				return $offset;
			}
		//}	
		_dump("MEMSET\n$dpc\nlength:$length\nmaxmem:$maxmem\nmempage:$mempage\noffset:$offset\n", 'a+', '/dumpmem-error-'.$_SERVER['COMPUTERNAME'].'.log');
		return false;
	}
	
	//mem table, check remaining space to fit in mem page
	public function upd($dpc, $free, &$data) 
	{
		if (!$dpc) return false;
		
		if ($free<=0) //bankswitch /gc
		{	
			if (!$this->gc) return false;
			
			$this->env->cnf->_say("Bank switch <<<<<<<<<<<<<< $dpc",'TYPE_LION');
			return $this->bankSwitch($dpc, $data);
		}	
		//else
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

	//export all mem at once (save file)
	public function dumpMem()
	{
		return $this->env->shm->_shread(0, $this->memlength);
	}	

	//init and periodic check (scheduled task)
	public function checkMem($show=false, $createHash=false)
	{		
		reset($this->dpc_length);
		foreach ($this->dpc_length as $dpc=>$length) 
		{
			$warning = false;
			$read = null;
			$offset = $this->dpc_addr[$dpc];
			$free = $this->dpc_free[$dpc];
			
			if ($createHash===true) 
			{
				$read = $this->readSH($dpc);
				$this->env->fs->hAdd($dpc, md5($read));
				//echo $read . PHP_EOL;
			}	
			
			if ($free < intval(1024 * 5)) //1 kb --- BANKSWITCH
			{
				$warning = ' <<<<<<<<<<<<<<<<<< need extra space!'; 
				//$read = PHP_EOL . $this->readSH($dpc) . PHP_EOL;
			}	
			
			if (($show)||($warning))
				$this->env->cnf->_say($offset . "\t". $length . "\t" . $free .
									  "\t" . $dpc . " re-loaded\t" . $warning,	'TYPE_IRON');	
					
		}
		
		list($memOffset) = $this->getOffset();
		$this->env->cnf->_say('shmax:' . $this->shm_max . 
							"\t mem length:" . $this->memlength . 
							"\t mem offset: " . $memOffset, 
							'TYPE_LION');	
	}
	
	//re-create hash-table (not used, create per file at checkMem)
	public function createHashTable()
	{
		reset($this->dpc_length);
		foreach ($this->dpc_length as $dpc=>$length) 
		{
			$offset = $this->dpc_addr[$dpc];
			$free = $this->dpc_free[$dpc];
			
			$md5data = md5($this->read($dpc));
			$this->env->fs->hAdd($dpc, $md5data);
		}

		$this->env->cnf->_say("Re-create hash table.", 'TYPE_LION');	
		return true;
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
	private function getOffset($length=null) {
		$offset = 0; 
		$zeros = 0;
		
		/*if (($this->gc===true) && (isset($length)))
		{
			//select from gc
			//$gc_o = $this->selectFromGC($length);
			list($oGC, $lGC, $fGC) = $this->selectFromGC($length);
			
			return array($oGC + 1, $lGC, $fGC); 
		}*/	
		
		reset($this->dpc_length);
		foreach ($this->dpc_length as $_dpc=>$_size)
		{
			$offset += $_size + 2;
			//$zeros +=2; //spinlocks
		}
		//$offset += $zeros; //segments x 2		   
		
		//return ($offset + 1); 
		return array($offset, 0, 0); //+1 !!!
	}
	
	//unset dpc, set a new
	private function bankSwitch($dpc, $data)
	{
		//save at gc
		$this->dpc_gc[] = array($this->dpc_addr[$dpc],
								$this->dpc_length[$dpc],
								$this->dpc_free[$dpc]);
									
		//unset current dpc (create a mem hole)								
		unset($this->dpc_addr[$dpc]);
		unset($this->dpc_length[$dpc]);
		unset($this->dpc_free[$dpc]);
		
		return $this->set($dpc, strlen($data), $data);
	}

	//select an offset from an existng gc element
	private function selectFromGC($length)	
	{
		if (!empty($this->dpc_gc))
		{
			//$gc = array_shift($this->dpc_gc); //first
			//return $gc[0]; //offset of an old dpc
			
			//check size
			foreach ($this->dpc_gc as $i=>$gc) {
				if ($gc[1] > $length) //+2, dont count spinklocks
				{
					$remove = $i;
					$offsetGC  = $gc[0]; 
					$lengthGC  = $gc[1]; 
					$freeGC    = $gc[1] - $length; //overwrite remaining
				}	
			} 
			unset ($this->dpc_gc[$remove]); //clean gc element
			
			return array($offsetGC, $lengthGC, $freeGC);
		}
		return false;	
	}
	
	//scheduled
	public function showGC()
	{
		if (empty($this->dpc_gc)) return;
		
		echo '----------- GC -----------' . PHP_EOL;
		foreach ($this->dpc_gc as $entry)
			echo implode("\t", $entry) . PHP_EOL;
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
	
	
	
	//save mem resource id and mem alloc arrays
	public function savestate() //make private
	{   
		$this->env->cnf->_say("Save state", 'TYPE_RAT');
		$data = $this->shm_max ."@^@". serialize($this->dpc_addr) . 
		                       "@^@". serialize($this->dpc_length). 
							   "@^@". serialize($this->dpc_free) .
							   "@^@". serialize($this->dpc_gc) .
							   "@^@" . $this->memlength;
						
		//save table in sh mem as resource var..
		//at runtime loop, recursional memory err
		//$this->savedpcmem('srvState',$data); /recursion err, at timer
							
		return file_put_contents('shm.id', $data ,LOCK_EX);
	}
   
	//load mem resource id and mem alloc arrays
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
				$this->dpc_gc = (array) unserialize($entries[4]);
				$this->memlength = $entries[5];

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
			foreach($tree as $dpc_id=>$dpcf) 
			{
				if (($dpcf!='') && ($dpcf[0]!=';')) 
				{
					if ($f = $this->env->fs->_readPHP($dpcf)) 
					{
						if ($reload===false) //bypass, just compute bytes
						{ 		
							$this->set($dpcf, strlen($f), $f); //clean f 
						}
						//add header sign
						$data .= "\0";
			  
						$data .= $f; //cleaned
			  
						//save md5 without spinklocks 
						//at reload recreate at init
						$this->env->fs->hAdd($dpcf, md5($f)); 
			  
						//add foot sign
						$data .= "\0";
			  
						if ($reload===false)
							$this->env->cnf->_say($dpcf . " loaded", 'TYPE_LION');  
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
		//initial spinlock read
		$off = ($this->dpc_addr[$dpc] > 1) ? $this->dpc_addr[$dpc]-1 : 0;
		
		if ($this->env->shm->_shread($off, 1) !== "\0")
			return false;
	   
		return true;
	}
	
	//fetch mem page (with empty space)
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
	  
		return ($stats ? $ret : substr($data ,0 ,$rlength));	      
	}
	
	//alias public
	public function read($dpc=null) {
		
		//return $this->getdpcmem($dpc);//, true);
		return $this->readSH($dpc); //safe
	}	

	//save calls,urls etc into mem (server side)
	private function savedpcmem($dpc, &$data) 
	{
	   $dataLength = strlen($data); 
	   
	   if (isset($this->dpc_addr[$dpc])) 
	   {
			//rewrite  
			list($offset, $length, $free, $rlength) = $this->get($dpc);	
		     
			$htexist = $this->env->fs->hmd5($dpc); 
			$htnew = md5($data); 			 
			if ((isset($data)) && (strcmp($htexist, $htnew)!==0)) //replace
			{				
				$remaining = $length - $dataLength;			  
			  
				if (($offset = $this->upd($dpc, $remaining, $data)) &&		
					($this->writeSH($data, $offset)))
				{	
					$this->env->fs->hEdt($dpc, $htnew);
					
					//MAKE PERIODICAL DUMPS OF ENTIRE MEM (DUMPMEM)
					//!!!!update dump-tree for any use (phar creation etc)
					//_dump("\0". $data ."\0" ,'a+', '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
										
					$this->env->cnf->_say("$htnew $dpc updated",'TYPE_LION');
					_dump("SAVE\n\n\n\n" . $data);
				}	
				else
				{
					_dump("MEM-ERROR\n$dpc\n$remaining\n".strlen($data)."\n" . $data, 'w', '/dumpmem-error-'.$_SERVER['COMPUTERNAME'].'.log');
					die($dpc . " (savedpcmem update page: $remaining) error, increase page space!" . PHP_EOL); 
				}
			
			}//if data			 
	   }
	   else { //write first time (append)
	   
			if (!$data) return false;	
			_say($data,3);
		
		    $htnew = md5($data);
			if (($offset = $this->set($dpc, $dataLength, $data)) &&
			    ($this->writeSH("\0". $data ."\0", $offset)))
			{
				$this->env->fs->hAdd($dpc, $htnew);
				
				//save dump-tree for any use (phar creation etc)
				_dump("\0". $data ."\0" ,'a+', '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
					
				$this->env->cnf->_say("$htnew $dpc saved",'TYPE_LION');
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
	
	//save calls,urls etc into mem (client side)
	private function getdpcmemc($dpc)
	{	 	
		$data = null;
		
		if ($this->exist($dpc))
		{
			list($offset, $length, $free, $rlength) = $this->get($dpc);

			if ($offset >= $this->shmmax()) 
			{
				if (!$data = $this->_setvar($dpc, false))
					if (!$data = $this->_sqlexec($dpc, false))
						if (!$data = $this->_sqlquery($dpc, false))
							if (!$data = $this->_wwwquery($dpc, false))
								if (!$data = $this->_localfile($dpc, false, $rlength)) //rlenght = md5($invdata)
									$data = $this->_variable($dpc, false);
									//files comes as variables when no change=null val

				
				$htexist = $this->env->fs->hmd5($dpc); //echo $htexist . PHP_EOL;
				$htnew = md5($data); //echo $htnew . PHP_EOL;
				if ((isset($data)) && (strcmp($htexist, $htnew)!==0))
				{ 			
					$dataLength = strlen($data); 
					$remaining = $length - $dataLength;
					
					if (($offset = $this->upd($dpc, $remaining, $data)) &&	
						($this->writeSH($data, $offset)))
					{
						//get md5 before extra spaces added
						$this->env->fs->hEdt($dpc, $htnew); //update md5
						
						$this->env->cnf->_say("$htnew $dpc updated!",'TYPE_LION');
						_dump("UPDATE\n\n\n\n" . $data);
					}
					else
					{
						_dump("MEM-ERROR\n$dpc\n$remaining\n".strlen($data)."\n" . $data, 'w', '/dumpmem-error-'.$_SERVER['COMPUTERNAME'].'.log');
						die($dpc . " (savedpcmem update page: $remaining) error, increase mempage space!" . PHP_EOL); 
					}	
					
				}//if data and data diff

			}
			//else continue and read
			
			$data = $this->readSH($dpc); 
		}
		else //NEW
		{ 
			if (!$data = $this->_setvar($dpc, true))
				if (!$data = $this->_sqlexec($dpc, true))
					if (!$data = $this->_sqlquery($dpc, true))
						if (!$data = $this->_wwwquery($dpc, true))
							if (!$data = $this->_localfile($dpc, true, false))
								if (!$data = $this->_variable($dpc, true))
									return false;

			//if (!$data) return false;	
			_say($data,3);		
		
			$dataLength = strlen($data);		
			$htnew = md5($data);
			
			if (($offset = $this->set($dpc, $dataLength, $data)) &&
				($this->writeSH("\0". $data ."\0", $offset)))
			{
				$this->env->fs->hAdd($dpc, $htnew);
				
				//save dump-tree for any use (phar creation etc)
				_dump("\0". $data ."\0" ,'a+', '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
				
				$this->env->cnf->_say("$htnew $dpc saved!",'TYPE_LION');
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

	//sql query handler (client side)
	private function _sqlquery($dpc, $new=false)
	{
		if (substr($dpc,0,7)!=='select-') return null;
		   
		if ($new)
		{	
			$_data = $this->env->pdoQuery($dpc);
			$data = json_encode($_data);
			_say($data,3); //show new data				
		}	
		else
		{		
			if (!$this->env->sch->findschedule($dpc))
			{
				$_data = $this->env->pdoQuery($dpc);			
				$data = json_encode($_data);
			}
			else
				$data = null; //bypass
		}

		return $data;	
	}
	
	//sql exec handler (client side)
	private function _sqlexec($dpc, $new=false)
	{
		if ((substr($dpc,0,7)!=='insert-') ||
			(substr($dpc,0,7)!=='update-') ||
			(substr($dpc,0,7)!=='delete-')) return null;
		   	
		$_data = $this->env->pdoExec($dpc);
		$data = json_encode($_data);
		_say($data,3); //show new data	

		return $data;	
	}	

	//www handler (client side)
	private function _wwwquery($dpc, $new=false)
	{
		if (substr($dpc,0,4)!=='www.') return null;
		   
		$data = (!$this->env->sch->findschedule($dpc)) 
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
			$htexist = $this->env->fs->hmd5($dpc); 
			$htnew = md5(@file_get_contents($this->env->dpcpath . $dpc)); 
			if (strcmp($htexist, $htnew)!==0)
			{
				$data = $this->env->fs->_readPHP($this->env->dpcpath . $dpc); 
				_say($data,3); 
			}	
			else
				$data = null; //bypass and read			
		}
		
		return $data;		
	}	
	
	//set-update handler (client side to server)
	private function _setvar($dpc, $new=false)
	{
		if (substr($dpc,0,7)!=='setvar-') return null;
		   	
		//echo '>>>>>>>>>>>>>>>SETVAR' . PHP_EOL;
		$data = $this->env->setvar($dpc);
		/*$data = (new proc($this->env))
							->redset($dpc);
							//->go($param);*/
		return true;//$data;	
	}	
	
	//var handler - process handler (client side)
	private function _variable($dpc, $new=false)
	{
		$data = null;
		//if () //VARIABLE
		//{   
			if ($new) //INSERT
			{	
				$this->env->cnf->_say('new variable: '. $dpc, 'TYPE_BIRD');	
				
				$param = null;
				$data = (new proc($this->env))
								->set($dpc)
								->go($param);						
			}
			else
			{
				$this->env->cnf->_say('read variable: '. $dpc, 'TYPE_BIRD');	
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
		//echo 'mem ';
	    $this->close();

		return true;	
	}	
}	
?>