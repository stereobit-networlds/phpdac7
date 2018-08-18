<?php
/**
 * This file is part of phpdac7.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    balexiou<balexiou@stereobit.com>
 * @copyright balexiou<balexiou@stereobit.com>
 * @link      http://www.stereobit.com/php-dac7.php
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

class memt 
{	
	private $env;
	public $agn_mem_type;// = 2;//shared 1 vs convensional
	public $agn_mem_store;
	
	public $shm_id, $shm_max, $agn_shm_id, $ipcKey;
	public $agn_addr, $agn_length, $agn_attr, $agn_free;
	public $shared_buffer, $dataspace, $extra_space;	
	//public static $pdo;	
	
	public function __construct(& $env=null) 
	{	
		$this->env = $env;	
		
		//$this->agn_mem_type = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? 2 : 1;
		$this->agn_mem_type = 2;
		
		$this->shm_id = null;
		$this->shm_max = 1024 * 100 * 100;
		$this->ipcKey = null;
	  
		$this->agn_shm_id = null;
		$this->agn_attr = array();
		$this->agn_length = array();
		$this->agn_free = array();
	  
		$this->shared_buffer = null;
		$this->extra_space = _MEMEXTRSPC; //1024 * 1000; //kb //1000/3200/..;// per agn
		$this->dataspace = _MEMDATASPC; //1024000 * 9; //mb //90000;
	  			
		//create ipc Key		
		$this->env->cnf->_say('DUMP FILE:' . realpath(_DUMPFILE), 'TYPE_LION');
		$pathname = realpath(_DUMPFILE); 
		$this->ipcKey = $this->_ftok($pathname, 's'); 			
	}		
	
	public function initialize() 
	{
		return $this->startmemagn();
	}

	//buffer2 used as optional when reconf-clean mem  
	private function startmemagn() 
	{ 
		$oswin = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? true : false;			
		$this->env->cnf->_say("Start mem manager " . $this->agn_mem_type, 'TYPE_LION');
		
		if ($this->agn_mem_type==2) 
		{	
			if (!extension_loaded('sync')) 	
				$oswin ? dl('php_sync.dll') : dl('sync.so');
			
			return true;
		}
		else
		{
			if (!extension_loaded('shmop')) 
				$oswin ? dl('php_shmop.dll') : dl('shmop.so');	
			
			return true; //bypass
		}			
		
		//bypass ...
		$iKey = $this->ipcKey ? $this->ipcKey : 0xfff;		
		
		$this->shm_max = 1024;
		$data = "\0" . str_repeat('~',$this->shm_max) . "\0"; 	
		
		// Create shared memory block with system id if 0xff3
		$space = $this->shm_max + $this->dataspace;					
		
		$this->env->cnf->_say("Allocate memory segment... $space bytes", 'TYPE_RAT');
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
	private function openmemagn($buffer=null, $buffer2=null) 
	{  	 
		$iKey = $this->ipcKey ? $this->ipcKey : 0xfff;	
		
        if ($this->agn_mem_type==2) {
			
			$this->shm_max = strlen($buffer) + strlen($buffer2);

			$this->shm_id = shmop_open($iKey, "c", 0644, $this->shm_max);
			if(!$this->shm_id) 
			{ 
				$this->env->cnf->_say("Couldn't create memory segment.", 'TYPE_LION');
				$this->env->cnf->_say("System Halted.", 'TYPE_LION');
				die();
			}
			
			$bw = shmop_write($this->shm_id, $buffer, 0);	
			return ($bw);
		}
		elseif ($this->agn_mem_type==1) 
		{
			$shm_max = strlen($buffer) + strlen($buffer2);
			
			$this->agn_shm_id = shmop_open($iKey, "c", 0644, $this->shm_max);
	  
			if(!$this->agn_shm_id) 
			{ 
				$this->env->cnf->_say("Couldn't create memory segment.", 'TYPE_LION');
				$this->env->cnf->_say("System Halted.", 'TYPE_LION');
				die();
			}  
  
			$shm_bytes_written = shmop_write($this->agn_shm_id, $buffer, 0);
			if($shm_bytes_written != $shm_max) 
			{
				$this->env->cnf->_say("Couldn't write the entire length of data", 'TYPE_LION');
				$this->env->cnf->_say($this->shm_max.":".$shm_bytes_written.">".$buffer, 'TYPE_RAT');
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
	
	
	public function add($agent, $data) 
	{
		return $this->addmemagn($agent, $data);
	}	
   	
	private function addmemagn($agent, $data) 
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
				
				$this->env->cnf->_say("addmemagn [$agent] :". $a_size, 'TYPE_LION');
				return true;
			}
			
			$this->env->cnf->_say("addmemagn [$agent] failed:". $a_size, 'TYPE_LION');
			return false;
		}	
		/*elseif ($this->agn_mem_type==1)	{
			
			$offset = $this->getAgnOffset() + 1;
			
			//extend agent info table
			$this->agn_addr[$agent] = $offset;			
			$this->agn_length[$agent] = $a_size;
			$this->agn_free[$agent] = $this->extra_space - $a_size;
				
			$this->env->cnf->_say("New $agent ". $offset.':'.$a_size, 'TYPE_LION');
			//var_dump($this->agn_addr);			
			
			
			$this->shm_max = $offset + $a_size + $this->extra_space;	
			$data .= str_repeat(' ',$this->extra_space);
			if (shmop_write($this->shm_id, "\0". $data ."\0", $offset))
			{
				$this->savestate($this->shm_max);
				_say("$agent inserted",1);
				//_dump("INSERT\n\n\n\n" . $data);
				$this->env->cnf->_say("addmemagn: [$agent] start". ':'.$a_size, 'TYPE_LION');
				return true;
			}
			
			$this->env->cnf->_say("addmemagn: [$agent] failed". ':'.$a_size, 'TYPE_LION');
			return false;
		}*/
		elseif ($this->agn_mem_type==1) //3 !!!!
		{
			$a_index = strlen($this->shared_buffer);
			
			//extend agent info table
			$this->agn_addr[$agent] = $a_index;			
			$this->agn_length[$agent] = $a_size;	
			
			$this->env->cnf->_say("New [$agent] ". $a_index.':'.$a_size, 'TYPE_LION');
			//var_dump($this->agn_addr);			
			
			$shm_max = $a_index + $a_size;
			$this->shared_buffer .= $data;
			  
			//extend and add the new agent at sh mem
			if ($this->agn_shm_id) { 
				$this->env->cnf->_say("Close memory segment", 'TYPE_RAT');	  
				$this->closememagn();	 
				$this->env->cnf->_say("Re-allocate memory segment", 'TYPE_RAT');
				$this->openmemagn($this->shared_buffer); 	  
			}
			else {
				$this->env->cnf->_say("Allocate memory segment", 'TYPE_RAT');
				$this->openmemagn($this->shared_buffer); 	  	  
			}			
		}	
		else
		{
			$a_index = 	strlen($this->agn_mem_store);
			
			//extend agent info table
			$this->agn_addr[$agent] = $a_index;			
			$this->agn_length[$agent] = $a_size;
			
			$this->env->cnf->_say("New [$agent] ". $a_index.':'.$a_size, 'TYPE_LION');
			//var_dump($this->agn_addr);			
			
			$shm_max = $a_index + $a_size;
			$this->agn_mem_store .= $data;

			$this->env->cnf->_say("Close standart memory segment", 'TYPE_RAT');	  
			$this->closememagn();	   
			$this->env->cnf->_say("Allocate standart memory segment", 'TYPE_RAT');
			$this->openmemagn($this->agn_mem_store);			
		}	
    }	
	
	public function upd($agent, $data) 
	{
		return $this->updatememagn($agent, $data);
	}	
	
	//agent name and data as the object
	private function updatememagn($agent, $data) 
	{	
		$s_size = strlen($data);
	
		if ($this->agn_mem_type==2)
		{
			$mem = & $this->agn_addr[$agent];
			$length = $this->agn_length[$agent];
			$free = $this->agn_free[$agent];
			
			if ($free>0)
			{
				if ($mem->write($data,0)) 
				{
					$this->agn_length[$agent] = $s_size;
					$this->agn_free[$agent] = ($this->extra_space - $s_size);
					
					$this->env->cnf->_say("updmemagn [$agent]: " . $length, 'TYPE_LION');	
					return true;		
				}
				
				$this->env->cnf->_say("updmemagn [$agent] write failed:" . $length, 'TYPE_LION');	
				//return false;						
			}
		}
		else //1,0
		{
			//replace agent info table  
			$a_index = $this->agn_addr[$agent];			
			$a_old_size = $this->agn_length[$agent];		
			//echo "\nupdate old ",$a_index,':',$a_old_size,"\n";   
			$a_new_size = $s_size;//strlen($agn_serialized);
			//echo "update new ",$a_index,':',$a_new_size,"\n";			
			
			if ($a_old_size == $a_new_size) { //1st method
		
				if ($this->agn_mem_type==1) {//shared	  
		
					$this->shared_buffer = substr_replace($this->shared_buffer,$agn_serialized,$a_index,$a_old_size);    		
		  
					//update and replace the new agent at sh mem
					if ($this->agn_shm_id) { 
						$this->env->cnf->_say("Close shared memory segment", 'TYPE_LION');	  
						$this->closememagn();	 
						$this->env->cnf->_say("Re-allocate shared memory segment", 'TYPE_LION');
						$this->openmemagn($this->shared_buffer); 	  
					}
					else {
						$this->env->cnf->_say("Allocate shared memory segment", 'TYPE_LION');
						$this->openmemagn($this->shared_buffer); 	  	  
					}
				}
				else {
		
					$this->agn_mem_store = substr_replace($this->agn_mem_store, $s_size, $a_index, $a_old_size);    		
		
					$this->env->cnf->_say("Close standart memory segment", 'TYPE_LION');	  
					$this->closememagn();	   
					$this->env->cnf->_say("Allocate standart memory segment", 'TYPE_LION');
					$this->openmemagn($this->agn_mem_store);		
				}
		
				return true;			
			}	
			//else
			$this->env->cnf->_say("Dimension error!", 'TYPE_LION');			
		}
		
		return false;
	}
	
	public function removememagn($agent) 
	{
		if ($this->agn_mem_type==2) 
		{  	
			$mem = &$this->agn_addr[$agent];   
			$length = $this->agn_length[$agent];
			
			if ($mem->write(str_repeat(' ',$this->extra_space),0)) 
			{
				$this->agn_free[$agent] = -1;
				$this->env->cnf->_say("Remove [$agent] " . $length, 'TYPE_LION');		  
				return true;
			}
			
			$this->env->cnf->_say("Remove [$agent] ". $length, 'TYPE_LION');		  
			return false;
	  
		}	
		elseif ($this->agn_mem_type==1) 
		{  
			$a_index = $this->agn_addr[$agent];   
			$a_size = $this->agn_length[$agent];
			//echo "\nremove ", $agent,'>',$a_index,':',$a_size,"\n";		
			$this->env->cnf->_say("Remove [$agent] " . $a_size, 'TYPE_LION');
			
		    $deleted_agent = str_repeat('x',$a_size);
		    
			//update shared buffer
			$this->shared_buffer = substr_replace($this->shared_buffer,$deleted_agent,$a_index,$a_size);	      
		
			if (!shmop_write($this->agn_shm_id,$deleted_agent,$a_index)) 
			{
				$this->env->cnf->_say("[$agent] Couldn't mark memory block for writing.", 'TYPE_LION');
				return false;
			} 
			$this->cleanmemagn();	
		}
		else 
		{
			$a_index = $this->agn_addr[$agent];   
			$a_size = $this->agn_length[$agent];
			$this->env->cnf->_say("remove ". $agent.'>'.$a_index .':'. $a_size, "TYPE_LION");		
			
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
	
    public function clean() 
    {
		$this->cleanmemagn(); //final	
		
		return true;	
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
				_say('>'.$s_agent.'<'.strlen($s_agent)); 		
				*/
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
	
	public function close()
	{
		return $this->closememagn();
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
				$this->env->cnf->_say("Couldn't mark memory block for deletion.", 'TYPE_LION');
			}	  
	  
			shmop_close($this->agn_shm_id);	
			$this->agn_shm_id = null;  
			
		}		

		//delete id file
		if (is_file('agn.id')) {
			$this->env->cnf->_say("Deleting state...", 'TYPE_RAT');
			unlink("agn.id"); //!!!permisions denied when multiple agns
		}
		//echo "Ok!\n";   
	}

	
    public function stop() 
    {
		$this->stopmemagn(); //final	
		return true;	
    }
	
    //if ($this->agn_mem_type==2) 
    private function stopmemagn() 
    { 
	  if ($this->agn_mem_type==2)  
		  return true;
	
      if (!shmop_delete($this->shm_id)) 
	  {
        $this->env->cnf->_say("Couldn't mark memory block for deletion", 'TYPE_LION');
		return false;
      }	  
	  shmop_close($this->shm_id);	
	  $this->shm_id = null;   
	  
	  @unlink("agn.id");
	  $this->env->cnf->_say("Deleting state..!", 'TYPE_RAT'); 
	  
	  return true;	
    }		
	
	
	
	//save shared mem resource id and mem alloc arrays
	private function savestate($shm_max=null) 
	{
		$fd = @fopen( "agn.id", "w" );
		if (!$fd) 
		{
            $this->env->cnf->_say("agn_id not saved!!!", 'TYPE_RAT');
			return false;
		}

		$this->env->cnf->_say("Saving state.", 'TYPE_RAT');
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
		
	
	private function _ftok($pathname, $proj_id) 
	{
		if (function_exists('ftok'))
			return ftok($pathname, $proj_id);
		
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
	    $this->stop();

		return true;	
	}		
}