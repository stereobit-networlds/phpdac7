<?php

class mem 
{	
	private $env;
	private $shm_id, $shm_max; 	
	private $dpc_addr, $dpc_length, $dpc_free;	
	private $dataspace, $extra_space;	
	
	public function __construct(& $env=null) 
	{	
		$this->env = $env;
		
		$this->shm_id = null;
		$this->shm_max = 0;
		
		$this->dpc_attr = array();
		$this->dpc_length = array();
		$this->dpc_free = array();
		
		$this->extra_space = 1024 * 10; //kb //1000;// per file (shmid res inc+)
		$this->dataspace = 1024000 * 9; //mb //90000; //sum of shmem without preinsert		
	}
	
	public function get($dpc) 
	{
		if (!$dpc) return false;
		
		$offset = $this->dpc_addr[$dpc];
	    $length = $this->dpc_length[$dpc]; 
		$free = $this->dpc_free[$dpc];

		return array($offset, $length, $free);	
	}

	public function set($dpc, $offset, $length) 
	{
		if (!$dpc) return false;
		
		$this->dpc_addr[$dpc] = $offset;		
		$this->dpc_length[$dpc] = $length + $this->extra_space;
		$this->dpc_free[$dpc] = $this->extra_space;

		//return array($offset, $length, $free);	
		return true;
	}
	
	public function upd($dpc, $free) 
	{
		if (!$dpc) return false;
		
		//$this->dpc_addr[$dpc] = $offset;		
		//$this->dpc_length[$dpc] = $length + $this->extra_space;
		$this->dpc_free[$dpc] = $free;
	
		return true;
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

	public function maxmem()
	{
		return $this->shm_max + $this->dataspace;
	}

	public function shmmax()
	{
		return $this->shm_max;
	}	
	
	public function shmid()
	{
		return $this->shm_id;
	}	

	public function calc()
	{
		$totalbytes = 0;
		
		foreach ($this->dpc_length as $dpc=>$length)
			$totalbytes+= $length + $this->dpc_free[$dpc];
			
		return $totalbytes;	
	}

	public function __destruct()
	//public function free() 
	{		
		//when ctrl-c !!
		@unlink("shm.id"); 
		
        if(!$this->shm_id)
            return false;

		return true;	
	}
	
	public function initialize() 
	{
		return $this->startmemdpc();
	}	

	
	
	private function startmemdpc() 
	{   
	  $this->env->cnf->_say("Start", 'TYPE_LION');  

	  $data = null;
	  $reloadedData = null;
	  $reloadedDataBytes = 0;	
	  $loadFromDir = null;//'build/cpdac7/';//null; // trail /
	  
	  if ($this->shm_max = $this->loadstate($loadFromDir)) 
	  {
		//only calc bytes   
	    $calc_shm_max = $this->load_dpc_tree($data, true); 
		
		if ($calc_shm_max != $this->shm_max)
		{	
			$this->env->cnf->_say('Loaded data has diferrent size', 'TYPE_RAT');
			die($calc_shm_max . '-' . $this->shm_max . PHP_EOL);
		}
		$space = $this->shm_max + $this->dataspace;
		$this->env->cnf->_say("Re-allocate shared memory segment. $space bytes",'TYPE_CAT');
		
		//$this->shm_id = shmop_open($ikey, "c", 0644, $space);
		if ($this->shm_id = $this->env->shm->_shopen($space)) 
		{
			//re-load dump file
			$reloadedData = file_get_contents($loadFromDir . 'dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
			
			// Do not Check SpinLock \0 included		
			$bw = $this->env->shm->_shwrite($this->shm_id, $reloadedData, 0);
			// Do not dump
			//unlink(getcwd() . '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
			
			if ($bw != strlen($reloadedData)) 
				die("Couldn't write the entire length of data\n");
			//do not save state
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
		$this->shm_id = $this->env->shm->_shopen($space);
	  
		if ($this->shm_id) 
		{
			// Do not Check SpinLock \0 included		
			$bw = $this->env->shm->_shwrite($this->shm_id, $data, 0);
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
	  
	  return true; 	
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
							   "@^@". serialize($this->dpc_free);
						
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
				$this->dpc_addr = (array) unserialize($entries[1]);
				$this->dpc_length = (array) unserialize($entries[2]);
				$this->dpc_free = (array) unserialize($entries[3]);
				$this->shm_max = $entries[0];

				return ($entries[0]);
			}
	   }
	   
	   return false;
	}
	
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
	    $offset = 0;
	    foreach($tree as $dpc_id=>$dpcf) 
		{
	      if (($dpcf!='') && ($dpcf[0]!=';')) 
		  {
		    if ($f = $this->env->fs->_readPHP($dpcf)) //@file_get_contents($dpcf)) 
			{
              if ($reload===false) //bypass, just compute bytes
			  { /*		
				$this->dpc_addr[$dpcf] = $offset + 1; //\0head			
				$this->dpc_length[$dpcf] = strlen($f) + $this->extra_space;
				$this->dpc_free[$dpcf] = $this->extra_space;
				*/
				$this->set($dpc, $offset+1, strlen($f));
			  
				$offset+= $this->dpc_length[$dpcf];// + 1; //\0foot
			  }
			  //add header sign
			  $data .= "\0";
			  $data .= $f;
			  //add extra space for modifications
			  $data .= str_repeat(' ',$this->extra_space);
			  //add foot sign
			  $data .= "\0";
			  
			  if ($reload===false)
				$this->env->cnf->_say($dpcf . " loaded", 'TYPE_LION');
			  else
				$this->env->cnf->_say($dpcf . " re-loaded", 'TYPE_LION');  
		    }
		    else 
	          $this->env->cnf->_say($dpcf . " Error", 'TYPE_LION');
	 
		  }
	    }
	    //print $shared_buffer;
	    $totalbytes = strlen($data);//$this->shared_buffer);
	    $this->env->cnf->_say("\nTotal Bytes : ".$totalbytes, 'TYPE_RAT');
		
		//print_r($this->dpc_addr);
		//print_r($this->dpc_length);
	  
        return $totalbytes; 
	  }
	  else
	    die("Dpc tree error. System Halted.\n"); 		
	} 	

	public function getShmOffset() { //make private
		$offset = 0; 
		$zeros = 0;
		
		foreach ($this->dpc_length as $_dpc=>$_size)
		{
			$offset += $_size;
			$zeros +=2; //\0...\0
		}
		$offset += $zeros; //segments x 2		   
		return ($offset); //+1 into calling function
	}
   
	//Check SpinLock
	public function checkSpinLock($dpc) //make private
	{   
       $offset = $this->dpc_addr[$dpc] - 1;
	   if ($this->env->shm->_shread($this->shm_id, $offset, 1) !== "\0")
		   return false;
	   
	   return true;
	}
   
	//fetch shared mem
	private function loaddpcmem($dpc) 
	{
	    $dpc = $this->env->utl->dehttpDpc($dpc);
	   
		if (isset($this->dpc_addr[$dpc])) 
		{
			return 
			$this->env->shm->_shread($this->shm_id, 
									$this->dpc_addr[$dpc], 
									$this->dpc_length[$dpc]);
        }
		return false; 	
	}

	//save calls,urls etc into shared mem
	public function savedpcmem($dpc, &$data) //make private
	{
	   $dataLength = strlen($data); 	   
	   $dpc = $this->env->utl->dehttpDpc($dpc); //if it is a http call
	   
	   if (isset($this->dpc_addr[$dpc])) 
	   {
			//rewrite
			//fetch dpc   
			/*$offset = $this->dpc_addr[$dpc];
			$length = $this->dpc_length[$dpc]; 
			$free = $this->dpc_free[$dpc];*/
			list($offset, $length, $free) = $this->get($dpc);
			$rlength = intval($length - $free);		
		     
			if (isset($data)) //replace
			{				
			  $remaining = $length - $dataLength;			  
			  $this->env->cnf->_say("diff:" . $rlength.':'.$dataLength, 'TYPE_RAT');
			  
			  //$oldData = $this->loaddpcmem($dpc);		
			  $oldData = $this->env->shm->_shread($this->shm_id, $offset, $rlength); 				
			  $hold = md5($oldData);	
			  $hnew = md5($data);// . str_repeat(' ',$remaining));
			  $this->env->cnf->_say("md5:" . $hold . ':'. $hnew, 'TYPE_RAT');
						
			  if ($dataLength < $length) 
			  {
					//update free space and save state
					$this->dpc_free[$dpc] = $remaining;
									    
					if ($this->checkSpinLock($dpc)===false)
						$this->env->cnf->_say(">>>>>>>>>>>>>>>>>>>>>>>>>>>spinlock 0:$dpc",'TYPE_DOG');		
			
			        $data .=  str_repeat(' ',$remaining);
					if ($this->env->shm->_shwrite($this->shm_id, $data, $offset))
					{	
						$this->savestate();
						$this->env->cnf->_say("$dpc saved",'TYPE_CAT');
						_dump("SAVE\n\n\n\n" . $data);
					}	
			  }
			  else
					die($dpc . " error, increase extra space!\n"); 
			
			}//if data			 
	   }
	   else { //write first time (append)
	   
			if (!$data) return false;	
			_say($data,3);
		
			$offset = $this->getShmOffset();
			
			if ((($offset+1+1) + $dataLength + $this->extra_space) < 
				($this->shm_max + $this->dataspace)) 
			{
				/*$this->dpc_addr[$dpc] = $offset + 1; //\0 new head			
				$this->dpc_length[$dpc] = $dataLength + $this->extra_space;
				$this->dpc_free[$dpc] = $this->extra_space;*/
				$this->set($dpc, $offset + 1, $dataLength);

				if ($this->checkSpinLock($dpc)===false)
					$this->env->cnf->_say(">>>>>>>>>>>>>>>>>>>>>>>>>>>spinlock 1:$dpc",'TYPE_DOG'); 
					
				$data .= str_repeat(' ',$this->extra_space);
				
				if ($this->env->shm->_shwrite($this->shm_id, "\0". $data ."\0", $offset))
				{
					_dump("\0". $data ."\0" ,'a+', '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
					
					$this->savestate();
					$this->env->cnf->_say("$dpc loaded",'TYPE_CAT');
					_dump("LOAD\n\n\n\n" . $data);
				}
			}
			else	
				die($dpc . " error, increase data space!");		
			     
	   }
	   $this->env->cnf->_say("Data : " . $dataLength, 'TYPE_RAT');	   
	   
	   return ($data);
	} 	
	
	private function getdpcmem($dpc) 
	{
		$dpc = $this->env->utl->dehttpDpc($dpc);
		list($offset, $length, $free) = $this->get($dpc);
		
		if ($data = $this->loaddpcmem($dpc))
			$ret = $data . $offset . ':' . $length . ':' . $free . PHP_EOL;
		else
			$ret = "Invalid dpc!";
	  
		return ($ret);	      
	}

    private function closememdpc() 
    {
		if ($this->env->shm->_shopen($this->shm_id))	  
		{
			$this->env->cnf->_say("Couldn't mark shared memory block for deletion", 'TYPE_CAT');
			return false;
		}	  
		//shmop_close($this->shm_id);	
		$this->env->shm->_shclose($this->shm_id);
		$this->shm_id = null;   
	  
		@unlink("shm.id");
		$this->env->cnf->_say("Deleting state..!",'TYPE_CAT'); 
	  
		return true;	
    }	
}	
?>