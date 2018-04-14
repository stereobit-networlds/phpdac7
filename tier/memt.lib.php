<?php
if (!extension_loaded('shmop')) dl('php_shmop.dll');		
if (!extension_loaded('sync')) 	dl('php_sync.dll');	

class memt 
{	
	private $env;
	public $agn_mem_type = 2;//shared 1 vs convensional
	public $agn_mem_store;
	
	public $shm_id, $shm_max, $agn_shm_id, $ipcKey;
	public $agn_addr, $agn_length, $agn_attr, $agn_free;
	public $shared_buffer, $dataspace, $extra_space;	
	//public static $pdo;	
	
	public function __construct(& $env=null) 
	{	
		$this->env = $env;
		
		$this->shm_id = null;
		$this->shm_max = 1024 * 100 * 100;
		$this->ipcKey = null;
	  
		$this->agn_shm_id = null;
		$this->agn_attr = array();
		$this->agn_length = array();
		$this->agn_free = array();
	  
		$this->shared_buffer = null;
		$this->extra_space = 1024 * 10; //kb //1000;// per agn
		$this->dataspace = 1024000 * 1; //mb //50000;
	  		
		//$pathname = null;//$argv[0]	!!
		//$this->ipcKey = $this->_ftok($pathname, 's'); //create ipc Key			
	}		
	
	public function initialize() 
	{
		return $this->startmemagn();
	}

	//buffer2 used as optional when reconf-clean mem  
	private function startmemagn() 
	{ 
		if ($this->agn_mem_type!=2)
			return true; //bypass
		
		$iKey = $this->ipcKey ? $this->ipcKey : 0xff9;	
		
		_say("Start",1);
		if ($this->agn_mem_type==2) 
			return true;
		
		$this->shm_max = 1024;
		$data = "\0" . str_repeat('~',$this->shm_max) . "\0"; 	
		
		// Create shared memory block with system id if 0xff3
		$space = $this->shm_max + $this->dataspace;					
		
		_say("Allocate shared memory segment... $space bytes",2);
		$this->shm_id = shmop_open($iKey, "c", 0644, $space);
		
		if ($this->shm_id) 
		{
			// Do not Check SpinLock		
			$bw = shmop_write($this->shm_id, $data, 0);
		
			if($bw != $this->shm_max) 
			{
				die("Couldn't write the entire length of data\n");
			}  
			else	
				$this->savestate($this->shm_max);	
		}
		else
			die("Couldn't create shared memory segment. System Halted.\n");

		return true;
	}	
	
	public function open() 
	{
		return $this->openmemagn('aek;');
	}	
   
	//buffer2 used as optional when reconf-clean mem  
	private function openmemagn($buffer=null,$buffer2=null) 
	{  	  
        if ($this->agn_mem_type==2) {
			
			$this->shm_max = strlen($buffer) + strlen($buffer2);

			$this->shm_id = shmop_open(0xfff, "c", 0644, $this->shm_max);
			if(!$this->shm_id) 
			{ 
				_say("Couldn't create shared memory segment.",1);
				_say("System Halted.",1);
				die();
			}
			
			$bw = shmop_write($this->shm_id, $buffer, 0);	
			return ($bw);
		}
		elseif ($this->agn_mem_type==1) 
		{
			$shm_max = strlen($buffer) + strlen($buffer2);
			
			$this->agn_shm_id = shmop_open(0xfff, "c", 0644, $this->shm_max);
	  
			if(!$this->agn_shm_id) 
			{ 
				_say("Couldn't create shared memory segment.",1);
				_say("System Halted.",1);
				die();
			}  
  
			$shm_bytes_written = shmop_write($this->agn_shm_id, $buffer, 0);
			if($shm_bytes_written != $shm_max) 
			{
				_say("Couldn't write the entire length of data",1);
				_say($this->shm_max.":".$shm_bytes_written.">".$buffer,1);
			}
			else 
			{	
				$this->shared_buffer = $buffer . $buffer2;
				$this->savestate($shm_max);
				//echo "Ok!\n";
			}  			 
		}
		else 
		{ 
			$shm_max = strlen($buffer) + strlen($buffer2);
			
			//default
			$this->agn_mem_store = $buffer . $buffer2; 
			$this->savestate($shm_max);
			//echo $this->agn_mem_store," Ok!\n";
			return true;	
		}  
	}
	
	
	public function add($agent,$data) 
	{
		return $this->addmemagn($agent, $data);
	}	
   	
	private function addmemagn($agent,$data) 
	{
		//if ($agent=='scheduler') 
		//{
		//echo "\n,.",strlen($this->shared_buffer)/*,$this->shared_buffer*/;
		//echo "\n,.",strlen($this->agn_mem_store),$this->agn_mem_store;
		//}
		
	
		$a_size = strlen($data);
	  
		if ($this->agn_mem_type==2) 	
		{	
			$mem = new SyncSharedMemory($agent, $this->extra_space);
			if ($mem->first())
			{
				// Do first time initialization work here.
			}

			if ($mem->write($data,0)) 
			{
				$this->agn_addr[$agent] = &$mem;
				$this->agn_length[$agent] = $a_size;
				$this->agn_free[$agent] = $this->extra_space - $a_size;
				_say("addmemagn: $agent start". ':'.$a_size,1);
				return true;
			}
			
			_say("addmemagn: $agent failed". ':'.$a_size,1);
			return false;
			/*
			$a_index = $this->getAgnOffset();
			
			//extend agent info table
			$this->agn_addr[$agent] = $a_index;			
			$this->agn_length[$agent] = $a_size + $this->extra_space;
			$this->agn_free[$agent] = $this->extra_space;
				
			_say("New $agent ". $a_index.':'.$a_size,1);
			//var_dump($this->agn_addr);			
			*/
			/*
			$this->shm_max = $a_index + $a_size + $this->extra_space;	
			$data .= str_repeat(' ',$this->extra_space);
			if (shmop_write($this->shm_id, "\0". $data ."\0", $offset))
			{
				$this->savestate($this->shm_max);
				_say("$agent inserted",1);
				_dump("INSERT\n\n\n\n" . $data);
			}
			*/
		}
		elseif ($this->agn_mem_type==1) 	
		{
			$a_index = strlen($this->shared_buffer);
			
			//extend agent info table
			$this->agn_addr[$agent] = $a_index;			
			$this->agn_length[$agent] = $a_size;	
			_say("New $agent ". $a_index.':'.$a_size,1);
			//var_dump($this->agn_addr);			
			
			$shm_max = $a_index + $a_size;
			$this->shared_buffer .= $data;
			  
			//extend and add the new agent at sh mem
			if ($this->agn_shm_id) { 
				_say("Close shared memory segment",2);	  
				$this->closememagn();	 
				_say("Re-allocate shared memory segment",2);
				$this->openmemagn($this->shared_buffer); 	  
			}
			else {
				_say("Allocate shared memory segment",2);
				$this->openmemagn($this->shared_buffer); 	  	  
			}			
		}	
		else
		{
			$a_index = 	strlen($this->agn_mem_store);
			
			//extend agent info table
			$this->agn_addr[$agent] = $a_index;			
			$this->agn_length[$agent] = $a_size;	
			_say("New $agent ". $a_index.':'.$a_size,1);
			//var_dump($this->agn_addr);			
			
			$shm_max = $a_index + $a_size;
			$this->agn_mem_store .= $data;

			_say("Close standart memory segment",2);	  
			$this->closememagn();	   
			_say("Allocate standart memory segment",2);
			$this->openmemagn($this->agn_mem_store);			
		}	
    }	
	
	private function updatememagn($agent,$data) 
	{
		if ($this->agn_mem_type==2)
		{
			//replace agent info table  
			/*$offset = $this->agn_addr[$agent];			
			$length = $this->agn_length[$agent];
			$rlength = $length - $this->agn_free[$agent];		  
			$dataLength = strlen($data);
			//echo "Update old ",$a_index,':',$rlength,"\n"; 
			//echo "update new ",$a_index,':',$dataLength,"\n";			
			if ($rlenght==$dataLength) 
			{ 
				$remaining = $length - $dataLength;			  
				_say("diff:" . $rlength.':'.$dataLength,2);
			  
				//$oldData = $this->loaddpcmem($dpc);		
				$oldData = shmop_read($this->shm_id, $offset, $rlength); 				
				$hold = md5($oldData);	
				$hnew = md5($data);// . str_repeat(' ',$remaining));
				_say("md5:" . $hold . ':'. $hnew,2);
			}*/
			
			$mem = &$this->agn_addr[$agent];
			$length = $this->agn_length[$agent];
			$rlength = $length - $this->agn_free[$agent];
			$dataLength = strlen($data);
			if ($dataLength < $this->extra_space) 
			{ 			  
				_say("diff:" . $rlength.':'.$dataLength,2);
			    if ($mem->write($data,0)) 
				{
					//$this->agn_addr[$agent] = &$mem;
					$this->agn_length[$agent] = $dataLength;
					$this->agn_free[$agent] = $this->extra_space - $datalength;
					_say("updatememagn: $agent modified". ':'.$dataLength,1);
					return true;
				}
			
				_say("updatememagn: $agent failed to modified". ':'.$dataLength,1);
				return false;
			}			
			_say("updatememagn: $agent length error". ':'.$dataLength,1);
			return false;
		}			
		else //1,0
		{
			
			//replace agent info table  
			$a_index = $this->agn_addr[$agent];			
			$a_old_size = $this->agn_length[$agent];		
			//echo "\nupdate old ",$a_index,':',$a_old_size,"\n";   
			$a_new_size = strlen($agn_serialized);
			//echo "update new ",$a_index,':',$a_new_size,"\n";			
			
			if ($a_old_size==$a_new_size) { //1st method
		
				if ($this->agn_mem_type==1) {//shared	  
		
					$this->shared_buffer = substr_replace($this->shared_buffer,$agn_serialized,$a_index,$a_old_size);    		
		  
					//update and replace the new agent at sh mem
					if ($this->agn_shm_id) { 
						echo "Close shared memory segment ...\n";	  
						$this->closememagn();	 
						echo "Re-allocate shared memory segment ...\n";
						$this->openmemagn($this->shared_buffer); 	  
					}
					else {
						echo "Allocate shared memory segment ...\n";
						$this->openmemagn($this->shared_buffer); 	  	  
					}
				}
				else {
		
					$this->agn_mem_store = substr_replace($this->agn_mem_store,$agn_serialized,$a_index,$a_old_size);    		
		
					echo "Close standart memory segment ...\n";	  
					$this->closememagn();	   
					echo "Allocate standart memory segment ...\n";
					$this->openmemagn($this->agn_mem_store);		
				}
		
				return true;			
			}	
			else
				echo "Dimension error!\n";			
		}
		
		return false;	
    }	
	
	private function removememagn($agent) 
	{
		if ($this->agn_mem_type==2) 
		{  	
			$mem = &$this->agn_addr[$agent];   
			$length = $this->agn_length[$agent];
			
			if ($mem->write(str_repeat(' ',$this->extra_space),0)) 
			{
				$this->agn_free[$agent] = -1;
				_say("Remove ". $agent.'>'.':'.$length,1);		  
				return true;
			}
			_say("Remove ". $agent.'>'.':'.$length,1);		  
			return false;
	  
		}	
		elseif ($this->agn_mem_type==1) 
		{  
			$a_index = $this->agn_addr[$agent];   
			$a_size = $this->agn_length[$agent];
			echo "\nremove ", $agent,'>',$a_index,':',$a_size,"\n";		
		
		    $deleted_agent = str_repeat('x',$a_size);
		    
			//update shared buffer
			$this->shared_buffer = substr_replace($this->shared_buffer,$deleted_agent,$a_index,$a_size);	      
		
			if (!shmop_write($this->agn_shm_id,$deleted_agent,$a_index)) 
			{
				_say("[$agent] Couldn't mark shared memory block for writing.");
				return false;
			} 
			$this->cleanmemagn();	
		}
		else 
		{
			$a_index = $this->agn_addr[$agent];   
			$a_size = $this->agn_length[$agent];
			echo "\nremove ", $agent,'>',$a_index,':',$a_size,"\n";		
			
			$deleted_agent = str_repeat('x',$a_size);
			
			//echo "\n",$this->agn_mem_store,"\n",strlen($this->agn_mem_store),"\n";	  
			$this->agn_mem_store = substr_replace($this->agn_mem_store,$deleted_agent,$a_index,$a_size);
			//echo "\n",$this->agn_mem_store,"\n",strlen($this->agn_mem_store),"\n";
			$this->clean_mem_store();
		}
		//if clean remark this...
		//unset($this->agn_addr[$agent]);
		//unset($this->agn_length[$agent]);	
	  
		return true;
	}	
	
	private function clean_mem_store() 
	{
		
		if ($this->agn_mem_type==2) 
		{
			//do nothing
		}
		else 
		{		
		$offset = 0;
		//var_dump($this->agn_addr);
		//var_dump($this->agn_length);	  
		//echo "\n",$this->agn_mem_store,"\n",strlen($this->agn_mem_store),"\n";	
	  
		reset($this->agn_addr);
		foreach ($this->agn_addr as $id=>$value) 
		{
			$current_index = $value;				
			$current_size = $this->agn_length[$id];
			$free = $this->agn_free[$id];//??	
		
			$s_agent = substr($this->agn_mem_store,$current_index,$current_size);
			//echo '>',$s_agent,'<',strlen($s_agent); 		
			$removed_agent = str_repeat('x',$current_size);
		
			if ($s_agent==$removed_agent) 
			{
				//is a deleted agent
				//echo "\nclean $id $current_index:$current_size\n";
				$offset = strlen($s_agent);
			}
			else 
			{
				$a_size = $current_size;		
		  
				$local_agn_addr[$id] = $current_index - $offset;
				$local_agn_length[$id] = $a_size;
				//?? free
				
				$local_agn_mem_store .= $s_agent;
		  
				$a_index += $a_size;
				$shm_max += $a_size;
			}
		}
	  
		//print_r($local_agn_addr);
		//print_r($local_agn_length);

		//$this->agn_mem_store = $local_agn_mem_store;
		//echo strlen($this->agn_mem_store),">>>>>>>>\n";	  
	  
		$this->agn_addr = (array)$local_agn_addr;
		$this->agn_length = (array)$local_agn_length;
	  	    
		$this->closememagn();	//reset shared buffer
		$this->openmemagn('aek;',$local_agn_mem_store);
	  
		//var_dump($this->agn_addr);
		//var_dump($this->agn_length);
		}	
	}	
	
	private function cleanmemagn() 
	{
		if ($this->agn_mem_type==2) 
		{
			//do nothing
		}
		else
		{
		$shm_max = 0;
	  
		reset($this->agn_addr);
		foreach ($this->agn_addr as $id=>$value) 
		{
			$current_index = $value;				
			$current_size = $this->agn_length[$id];		
			$current_free = $this->agn_free[$id];
			
			//!!!!
			/*$s_agent = shmop_read($this->agn_shm_id,$current_index,$current_size); 
			*/
			_say('>'.$s_agent.'<'.strlen($s_agent)); 		
			//$s_agent= substr($this->shared_buffer,$value,$current_size);
		
			$removed_agent = str_repeat('x',$current_size);
			if ($s_agent==$removed_agent) 
			{
				//is a deleted agent
				_say("removed",2);
			}
			else 
			{
				$local_agn_addr[$id] = $current_index;
				$local_agn_length[$id] = $current_size;
				$local_agn_free[$id] = $current_free;
				
				$local_shared_buffer .= $s_agent;
		  
				$a_index += $current_size;
				$shm_max += $current_size;
			}
		}
		//echo $local_shared_buffer;
		//$this->shared_buffer = $local_shared_buffer;
		$this->agn_addr = (array)$local_agn_addr;
		$this->agn_length = (array)$local_agn_length;
	    
		$this->closememagn();	//reset shared buffer
		$this->openmemagn('aek;',$local_shared_buffer);
	    }
	}	
	
	private function closememagn() 
	{
		if ($this->agn_mem_type==2) 
		{		   

		}
		elseif ($this->agn_mem_type==1) 
		{		   
			if (!$this->agn_shm_id) return -1;
	  
			if(!shmop_delete($this->agn_shm_id)) {
				_say("Couldn't mark shared memory block for deletion.");
			}	  
	  
			shmop_close($this->agn_shm_id);	
			$this->agn_shm_id = null;  
			
		}		

		//delete id file
		if (is_file('agn.id')) {
			_say("Deleting state...",2);
			unlink("agn.id"); //!!!permisions denied when multiple agns
		}
		//echo "Ok!\n";   
	}

    //if ($this->agn_mem_type==2) 
    private function stopmemagn() 
    { 
	  if ($this->agn_mem_type==2)  
		  return true;
	
      if (!shmop_delete($this->shm_id)) 
	  {
        _say("Couldn't mark shared memory block for deletion",1);
		return false;
      }	  
	  shmop_close($this->shm_id);	
	  $this->shm_id = null;   
	  
	  @unlink("agn.id");
	  _say("Deleting state..!",2); 
	  
	  return true;	
    }		
	
	
	
	//save shared mem resource id and mem alloc arrays
	private function savestate($shm_max=null) 
	{
		$fd = @fopen( "agn.id", "w" );
		if (!$fd) 
		{
            _say("agn_id not saved!!!");
			return false;
		}

		_say("Saving state.",2);
		$data = $shm_max ."^". 
		        serialize($this->agn_addr) ."^". 
				serialize($this->agn_length); 

		fwrite($fd, $data);
		fclose($fd);      
		return true;
	}  

	private function getAgnOffset() {
		$offset = 0; 
		$zeros = 0;
		
		foreach ($this->agn_length as $_agn=>$_size)
		{
			$offset += $_size;
			$zeros +=2; //\0...\0
		}
		$offset += $zeros; //segments x 2		   
		return ($offset); //+1 into calling function
	}	
	
	

    private function close() 
    {
		$this->stopmemagn(); //final	
		
		return true;	
    }	
	
	private function _ftok($pathname, $proj_id) 
	{
		$st = @stat($pathname);
		if (!$st) 
		{
			return -1;
		}
  
		$key = sprintf("%u", (($st['ino'] & 0xffff) | (($st['dev'] & 0xff) << 16) | (($proj_id & 0xff) << 24)));
		return $key;
	} 	
	
	//public function free()	
	public function __destruct() 
	{		
	    $this->close();

		return true;	
	}		
}
?>