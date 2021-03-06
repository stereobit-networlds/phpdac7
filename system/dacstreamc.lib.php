<?php

class c_dacstream {

   var $position;
   var $data;
   
   var $DPCEOF;
   var $size;

   //php 7.4 combatibility
   public function stream_set_option() {
		return false;
   }


   function stream_open($_url,$mode,$options,&$opened_path) {
   
		$url = parse_url($_url);   
		$timeout = 5;//30;
   
        $server = $url['host'];
		$port = $url['port'];
		$path = $url['path'];
		//print_r($url);
		
        //$socket = fsockopen($server, $port, $errno, $errstr, $timeout); 
		//PERSISTENT CONNECTION
		$socket = @pfsockopen($server, $port, $errno, $errstr, $timeout); 
		
		if (!$socket) {
		  echo $errstr,"(",$errno,")\n";
		  return false;
		}
        $dpcmem = substr($path,1);//exclude '/' from the begining of str
		$request = "getdpcmemc " . $dpcmem . "\r\n";//client version of getdpcmem
        fputs($socket, $request); 
        $ret = ''; 
        while (!feof($socket)) { 
          $ret .= fgets($socket, 4096);
        }  
        fclose($socket);  
				
		$this->DPCEOF = strlen($ret);;
		$this->size = strlen($ret);
	    $this->data = $ret;
		    
		$this->position = 0;
		
		return true;   
   }
   
   function stream_read($count) {
   
        $ret = substr($this->data,$this->position,$count);
		$this->position += strlen($ret);
		
        return ($ret);
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
   
     //return ($this->DPCEOF);
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