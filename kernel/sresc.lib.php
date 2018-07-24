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

class c_resstream {

   var $position;
   var $data;
   
   //var $AGNEOF;
   //var $size;

   function stream_open($_url,$mode,$options,&$opened_path) {
   
		$url = parse_url($_url);   
		$timeout = 5;//30;
   
        $server = $url['host'];
		$port = $url['port'];
		$path = $url['path'];
		//print_r($url);
		
        //$socket = fsockopen($server, $port, $errno, $errstr, $timeout); 
		//PERSISTENT CONNECTION
		$socket = pfsockopen($server, $port, $errno, $errstr, $timeout); 

		if (!$socket) {
		  echo $errstr,"(",$errno,")\n";
		  return false;
		}
		//stream_set_blocking($socket,1);
        $resmem = substr($path,1);//exclude '/' from the begining of str
		$request = "getresource " . $resmem . "\r\n";//"\r\n\r\n";		
        fputs($socket, $request); 

        $ret = ''; 
        while (!feof($socket)) { 
          $ret .= fgets($socket, 4096);
        }  
        fclose($socket);  
				
		//$this->AGNEOF = strlen($ret);;
		//$this->size = strlen($ret);
	    $this->data = $ret;
		    
		$this->position = 0;
		
		return true;   
   }
   
   function stream_read($count) {
   
        $ret = substr($this->data,$this->position,$count);
		$this->position += strlen($ret);
		
        return ($ret);//serialized object //(unserialize($ret));
   }
   
   function stream_write($data) {
   
       /* $left = substr($this->data, 0, $this->position);
		$right = substr($this->data, $this->position + strlen($data));
		
		$this->data = $left . $data . $right;
		
		$this->position += strlen($data); */
		
		return (strlen($data));
   }
   
   function stream_tell() {
   
     return ($this->position);
   }
   
   function stream_eof() {
   
     //return ($this->AGNEOF);
	 return $this->position >= strlen($this->data);
   }
   
   function stream_seek($offset,$whence) {
   
     switch($whence){
     	case SEEK_SET: 
     		if (($offset < strlen($this->data)) && ($offset >=0)) {
     		    $this->position = $offset;
				return true;
     		}
			else
			    return false;
     		break;
     	case SEEK_CUR: 
     		if ($offset >=0) {
     		    $this->position += $offset;
				return true;
     		}
			else
			    return false;
     		break;
		case SEEK_END: 
     		if (strlen($this->data) + $offset >= 0) {
     		    $this->position = strlen($this->data) + $offset;
				return true;
     		}
			else
			    return false;
     		break;	
     	default:
     		return false;
     } // switch
   }
   
   function stream_stat() {
   
     return (array('size'=>strlen($this->data)));
   }
}
?>