<?php
if (!extension_loaded('shmop'))  dl('php_shmop.dll');

class shm 
{	
	private $env, $ipcKey;
	
	public function __construct(& $env=null, $ikey=null) 
	{	
		$this->env = $env;
		
		//create ipc key 	
		//$pathname = null;//realpath(__FILE__) !!!
		//$this->ipcKey = $this->_ftok($pathname, 's'); //create ipc Key		
		
		$this->ipcKey = $iKey ? $iKey : 0xfff;
	}
	
	public function _shopen($space) 
	{
		return shmop_open($this->ipcKey, "c", 0644, $space);
	}
	
	public function _shread($id, $offset, $length) 
	{
		return shmop_read($id, $offset, $length);
	}

	public function _shwrite($id, $data, $offset) 
	{
		return shmop_write($id, $data, $offset);
	}

	public function _shdelete($id) 
	{
		return shmop_delete($id);
	}	
	
	public function _shclose($id) 
	{
		return shmop_close($id);
	}	
	
	
 	//set flag to \0, must written before read  
    public function readSafe($dpc)
    {
		$dpc = $this->dehttpDpc($dpc);
		
	    if ($this->checkSpinLock($dpc)===true) {
			//spinLock = \0
			$this->env->cnf->_say("Locked segment (must written):" . $dpc , 'TYPE_CAT');
			return false;
		}	
		$offset = $this->dpc_addr[$dpc];
		$size = $this->dpc_length[$dpc];
		$dataSize = $this->dpc_length[$dpc] - $this->dpc_free[$dpc];		
        
        $data = shmop_read($this->shm_id, $offset, $dataSize);
		
        // release spinlocks
        shmop_write($this->shm_id, "\0", $offset-1);
		shmop_write($this->shm_id, "\0", $size+1);
        return $data;
    }
    
	//set flag to \1, must read
    public function writeSafe($dpc,$data)
    {
		$dpc = $this->dehttpDpc($dpc);
		
	    if ($this->checkSpinLock($dpc)===false) 
		{   //spinLock = \1
			$this->env->cnf->_say("Locked segment (not readed):" . $dpc, 'TYPE_CAT');
			return false;
		}	  
		
	    $dataSize = strlen($data);
		
		if ($this->dpc_addr[$dpc]) 
		{  //update
			$offset = $this->dpc_addr[$dpc];
			$size = $this->dpc_length[$dpc];
			$oldSize = $this->dpc_length[$dpc] - $this->dpc_free[$dpc];		
						
			if ($dataSize < $size)
			{
				$remaining = $size - $dataSize;
				$this->env->cnf->_say("diff:" . $oldSize.':'.$dataSize, 'TYPE_CAT');
				
				$oldData = shmop_read($this->shm_id,$offset,$oldSize);
				$hold = md5($oldData);	
				$hnew = md5($newData);
				$this->env->cnf->_say("md5:" . $hold . ':'. $hnew, 'TYPE_CAT');				
				
				$newData = $data . str_repeat(' ',$remaining);								
			}	
			else	
			{	
				//throw new Exception('dataSize > block');
				$this->env->cnf->_say("Error::::::::::::::: Update: DataSize > block :" . $dpc, 'TYPE_CAT');
			}			
        }
		else 
		{   
	        //append / insert
			$offset = $this->getShmOffset();
			
			//+1+1 = \lock flags
			if ((($offset+1+1) + $dataSize + $this->extra_space) < 
				($this->shm_max + $this->dataspace)) 
			{
                $this->dpc_addr[$dpc] = $offset + 1; //\0 new head			
				$this->dpc_length[$dpc] = $dataSize + $this->extra_space;
				$this->dpc_free[$dpc] = $this->extra_space;	
				
				$newData = $data . str_repeat(' ',$this->extra_space);
			}
			else			
			{
				//throw new Exception('dataSize > block');
				$this->env->cnf->_say("Error::::::::::::::: Insert: DataSize > dataspace :" . $dpc, 'TYPE_CAT');
			}	
		}
	    // set spinlocks	
		shmop_write($this->shmId, "\1", $offset-1);
		shmop_write($this->shm_id, $newData, $offset);
		shmop_write($this->shmId, "\1", strlen($newData)+1);
		
        return true;
    } 	
	
	public function _ftok($pathname, $proj_id) 
	{
		$st = @stat($pathname);
		if (!$st) 
		{
			return -1;
		}
  
		$key = sprintf("%u", (($st['ino'] & 0xffff) | (($st['dev'] & 0xff) << 16) | (($proj_id & 0xff) << 24)));
		return $key;
	}	
}
?>