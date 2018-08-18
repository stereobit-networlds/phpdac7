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

if (!extension_loaded('shmop'))  
	(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ?
	dl('php_shmop.dll') : dl('shmop.so');

class shm 
{	
	private $env, $ipcKey, $shm_id;
	
	public function __construct(& $env=null, $ikey=null) 
	{	
		$this->env = $env;
		
		$this->env->cnf->_say('DUMP FILE:' . realpath(_DUMPFILE), 'TYPE_LION');
		
		//create ipc key 	
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			$this->ipcKey = $iKey ? $iKey : 0xfff;
		}
		else {
			$this->ipcKey = $this->_ftok(realpath(_DUMPFILE), 19123);//'sa'); 
			//$this->ipcKey = ftok(realpath(_DUMPFILE), 'sa');
		}
		//echo $this->ipcKey;
		
		$this->shm_id = null;
	}
	
	public function _shopen($space) 
	{
		$this->shm_id = shmop_open($this->ipcKey, "c", 0644, $space);
		
		return ($this->shm_id);
	}
	
	public function _shread($offset, $length) 
	{
		//echo $offset,'>>>>>>>>>>>>>>>>>>>>>>OFFSET'.PHP_EOL;
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
	
	
	//Check SpinLock
	private function spinlock($offset)
	{ 
	   //initial spinklock read
	   $off = ($offset > 1) ? $offset-1 : 0; 
       //$this->env->cnf->_say("spinlock: " . $off, 'TYPE_LION');	
	   
	   if ($this->_shread($off, 1) == "\1")
		   return true;
	   
	   return false;
	}	
	
 	//set flag to \0, must written before read 
	//(length must be the mempage)
	//rlenght is the length of actual data
    public function readSafe($offset, $length, $rlength=null)
    {
		if ($this->spinlock($offset)===false) {
			//spinLock = \0
			//$this->env->cnf->_say("Locked segment not readed: " . $offset, 'TYPE_LION');
			//return false;
		}	
		
		//release spinlocks for write
		//shmop_write($this->shm_id, "\0", $offset-1);
		//shmop_write($this->shm_id, "\0", $length+1);
				
		$ln = isset($rlength) ? $rlength : $length;
		//echo '>'.$rlength . '>>>>>>>>>>>>>>' . $length . '>' . $ln;		
		//echo $data . '+++++++.'.PHP_EOL;		
		
		return shmop_read($this->shm_id, $offset, $ln);
    }
    
	//set flag to \1, must read (data must contain the free space)
    public function writeSafe($data, $offset)
    {
	    if ($this->spinlock($offset)===true) 
		{   //spinLock = \1
			$this->env->cnf->_say("Locked segment (not written):" . $offset, 'TYPE_LION');
			return false;
		}	  

        //set spinlocks		
		//shmop_write($this->shm_id, "\1", $offset-1);
		//shmop_write($this->shm_id, "\1", strlen($data)+1);
		
		return shmop_write($this->shm_id, $data, $offset);
    } 

	public function lockSafe($offset, $length)
	{
        //set spinlocks  \1	
		shmop_write($this->shm_id, "\1", $offset-1);
		shmop_write($this->shm_id, "\1", $length+1);	
		return true;	
	}
	
	public function unlockSafe($offset, $length)
	{
        //set spinlocks \0	
		shmop_write($this->shm_id, "\0", $offset-1);
		shmop_write($this->shm_id, "\0", $length+1);	
		return true;	
	}	
	
	public function _ftok($pathname, $proj_id) 
	{
		//DISABLED due to invalid proj_id (became int)
		//if (function_exists('ftok'))
			//return ftok($pathname, $proj_id);
		
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
		//echo 'shmem ';
        $del = @shmop_delete($this->shm_id);

        if($del === false)
            return false;	

		return @shmop_close($this->shm_id);	
	}	
}