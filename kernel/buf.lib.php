<?php
/*
	Licence
	
	Copyright (c) 2018 stereobit.networlds | Vassilis Alexiou
	balexiou@stereobit.com | https://www.stereobit.com
	
	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:
	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.
	
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
	
*/

class buf 
{	
	private $env, $shm_id, $buffer;
	
	public function __construct(& $env=null) 
	{	
		$this->env = $env;
		$this->buffer = null;
		$this->shm_id = null;
	}
	
	public function _shopen($space) 
	{
		//$fp = fopen("php://temp/maxmemory:$space", 'r+')
		//fputs($fp, "hello\n");
		// Read what we have written.
		//rewind($fp);
		//echo stream_get_contents($fp);		
		
		$this->shm_id = 'xxx';//& $this->buffer;
		
		//$this->buffer = str_repeat(' ', $space);		
		if ($this->buffer = fopen("php://temp/maxmemory:$space", 'r+'))
		//if ($this->buffer = fopen("php://memory:$space", 'r+'))
			return true;
		
		return false;
	}
	
	public function _shread($offset, $length) 
	{
		//return substr($this->buffer, $offset, $length);
		fseek($this->buffer, $offset, SEEK_SET);
		return fread($this->buffer, $length);
	}

	public function _shwrite($data, $offset) 
	{
		//substr_replace($this->buffer, $data, $offset, strlen($data));
		//return strlen($data);
		fseek($this->buffer, $offset, SEEK_SET);
		return fwrite($this->buffer, $data, strlen($data));
	}

	public function _shdelete() 
	{
		unset($this->shm_id);
	}	
	
	public function _shclose() 
	{
		unset($this->buffer);
	}	
	
	
	//Check SpinLock
	private function spinlock($offset)
	{ 
       //$this->env->cnf->_say("spinlock: " . $offset, 'TYPE_LION');	
	   if ($this->_shread($offset-1, 1) == "\1")
		   return true;
	   
	   return false;
	}	
	
 	//set flag to \0, must written before read 
	//(length must be the mempage)
	//rlenght is the length of actual data
    public function readSafe($offset, $length, $rlenght=null)
    {
		if ($this->spinlock($offset)===false) {
			//spinLock = \0
			//$this->env->cnf->_say("Locked segment not readed: " . $offset, 'TYPE_LION');
			//return false;
		}	
		
		//release spinlocks for write
		//str_replace($this->buffer,, "\0", $offset-1, 1);
		//str_replace($this->buffer,, "\0", $length+1, 1);
		
		//$ret = substr($this->buffer, $offset, $length);
		fseek($this->buffer, $offset, SEEK_SET);
		$ret = fread($this->buffer, $length);
		return $rlength ? substr($ret,0, $rlength) : $ret; //no rtrim
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
		//str_replace($this->buffer, "\1", $offset-1, 1);
		//str_replace($this->buffer, "\1", strlen($data)+1, 1);
		
		//str_replace($this->buffer, $data, $offset, strlen($data));
		//return strlen($data);
		fseek($this->buffer, $offset, SEEK_SET);
		$ret = fwrite($this->buffer, $data, strlen($data));		
    } 

	public function lockSafe($offset, $length)
	{
        //set spinlocks  \1	
		//str_replace($this->buffer, "\1", $offset-1, 1);
		//str_replace($this->buffer, "\1", $length+1, 1);	
		return true;	
	}
	
	public function unlockSafe($offset, $length)
	{
        //set spinlocks \0	
		//str_replace($this->buffer, "\0", $offset-1, 1);
		//str_replace($this->buffer, "\0", $length+1, 1);	
		return true;	
	}		
	
	//public function free()	
	public function __destruct() 
	{	
		unset($this->shm_id);
		unset($this->buffer);
		return true;	
	}	
}
?>