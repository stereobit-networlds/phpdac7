<?php
if (!extension_loaded('shmop'))  dl('php_shmop.dll');

class shm 
{	
	private $env, $ipcKey, $shm_id;
	
	public function __construct(& $env=null, $ikey=null) 
	{	
		$this->env = $env;
		
		//create ipc key 	
		//$pathname = null;//realpath(__FILE__) !!!
		//$this->ipcKey = $this->_ftok($pathname, 's'); //create ipc Key		
		$this->ipcKey = $iKey ? $iKey : 0xfff;
		
		$this->shm_id = null;
	}
	
	public function _shopen($space) 
	{
		$this->shm_id = shmop_open($this->ipcKey, "c", 0644, $space);
		
		return ($this->shm_id);
	}
	
	public function _shread($offset, $length) 
	{
		return shmop_read($this->shm_id, $offset, $length);
	}

	public function _shwrite($data, $offset) 
	{
		return shmop_write($this->shm_id, $data, $offset);
	}

	public function _shdelete() 
	{
		return shmop_delete($this->shm_id);
	}	
	
	public function _shclose() 
	{
		return shmop_close($this->shm_id);
	}	
	
	
 	//set flag to \0, must written before read  
    public function readSafe($dpc)
    {
		//$dpc = $this->env->utl->dehttpDpc($dpc);
		
		if ($this->env->mem->exist($dpc))	
		{
			/*if ($this->env->mem->checkSpinLock($dpc)===true) {
				//spinLock = \0
				$this->env->cnf->_say("Locked segment (must written):" . $dpc , 'TYPE_LION');
				return false;
			}*/	
	
			list ($offset, $size, $free, $rlength) = $this->env->mem->get($dpc); 	
			$data = shmop_read($this->shm_id, $offset, $rlength);
		
			// release spinlocks
			//shmop_write($this->shm_id, "\0", $offset-1);
			//shmop_write($this->shm_id, "\0", $size+1);
		
			return $data;
		}
		return null;
    }
    
	//set flag to \1, must read
    public function writeSafe($dpc, $data)
    {
		$dataSize = strlen($data);
		$newData = $data;

	    /*if ($this->env->mem->checkSpinLock($dpc)===false) 
		{   //spinLock = \1
			$this->env->cnf->_say("Locked segment (not readed):" . $dpc, 'TYPE_LION');
			return false;
		}*/	  
		
		if ($this->env->mem->exist($dpc))	
		{   
			//read existed
			list ($offset, $size, $free, $rlength) = $this->env->mem->get($dpc); 		
			$remaining = $size - $dataSize;

			if ($offset = $this->env->mem->upd($dpc, $remaining, $data))	
			{
				//shmop_write($this->shm_id, "\1", $offset-1);
				shmop_write($this->shm_id, $newData, $offset);
				//shmop_write($this->shm_id, "\1", strlen($newData)+1);	
			}	
			else	
			{	
		        _dump("SHM-MEM-ERROR-UPDATE\n$dpc\n$remaining\n".strlen($data)."\n" . $data, 'w', '/dumpmem-error-'.$_SERVER['COMPUTERNAME'].'.log');
				$this->env->cnf->_say("Error::::::::::::::: Update: DataSize ($dataSize) > block ($size) :" . $dpc, 'TYPE_LION');
			}			
        }
		else 
		{   
	        //append / insert
			if ($offset = $this->env->mem->set($dpc, $datasize, $data))
			{ 
				//shmop_write($this->shm_id, "\1", $offset-1);
				shmop_write($this->shm_id, $newData, $offset);
				//shmop_write($this->shm_id, "\1", strlen($newData)+1);
			}
			else			
			{	
				_dump("SHM-MEM-ERROR-INSERT\n$dpc\n$datasize\n".strlen($data)."\n" . $data, 'w', '/dumpmem-error-'.$_SERVER['COMPUTERNAME'].'.log');
				$this->env->cnf->_say("Error::::::::::::::: Insert: DataSize > dataspace :" . $dpc, 'TYPE_LION');
			}	
		}
		
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
	
	//public function free()	
	public function __destruct() 
	{	
        $del = @shmop_delete($this->shm_id);

        if($del === false)
            return false;	

		return @shmop_close($this->shm_id);	
	}	
}
?>