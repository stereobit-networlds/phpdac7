<?php
class c_dacstream {

   var $position;
   var $data;
   
   var $DPCEOF;
   var $size;
   
   var $path, $dpcmem;

   //php 7.4 combatibility
   public function stream_set_option() {
		return false;
   }
  

   public function stream_open($_url,$mode,$options,&$opened_path) {
   
		$url = parse_url($_url);   
		$timeout = 5;//30;
   
        $server = $url['host'];
		$port = $url['port'];
		$this->path = $url['path'];
		//print_r($url);
		
        //$socket = fsockopen($server, $port, $errno, $errstr, $timeout); 
		//PERSISTENT CONNECTION
		$socket = @pfsockopen($server, $port, $errno, $errstr, $timeout); 
		
		if (!$socket) {
		  echo $errstr,"(",$errno,")\n";
		  return false;
		}
		//exclude '/' from the begining of str
        $this->dpcmem = (substr($this->path,0,1)=='/') ? substr($this->path,1) : $this->path;
		//client version of getdpcmem
		$request = "getdpcmemc " . $this->dpcmem . "\r\n";
        fputs($socket, $request); 
        $ret = ''; 
        while (!feof($socket)) { 
          $ret .= fgets($socket, 4096);
        }  
        fclose($socket);  
				
		$this->DPCEOF = strlen($ret);
		$this->size = strlen($ret);
	    $this->data = $ret;
		    
		$this->position = 0;
		
		return true;   
   }
   
   public function stream_read($count) {
   
        $ret = substr($this->data,$this->position,$count);
		$this->position += strlen($ret);
		
        return ($this->gc($ret,_DACSTREAMCVIEW_));
		//return $ret;
   }
   
   public function stream_write($data) {
   
       /* $left = substr($this->data, 0, $this->position);
		$right = substr($this->data, $this->position + strlen($data));
		
		$this->data = $left . $data . $right;
		
		$this->position += strlen($data); */
		
		return (strlen($data));
   }
   
   public function stream_tell() {
   
     return ($this->position);
   }
   
   public function stream_eof() {
     //return ($this->DPCEOF);
	 return $this->position >= strlen($this->data);
   }
   
   public function stream_seek($offset,$whence) {
   
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
   
   public function stream_stat() {
   
     return (array('size'=>strlen($this->data)));
   }
   
    //https://api.drupal.org/api/drupal/includes%21stream_wrappers.inc/function/DrupalLocalStreamWrapper%3A%3Aurl_stat/7.x
	//Parameters
	//$uri: A string containing the URI to get information about.
	//$flags: A bit mask of STREAM_URL_STAT_LINK and STREAM_URL_STAT_QUIET.
	public function url_stat($uri, $flags) {
		// Suppress warnings if requested or if the file or directory does not
		// exist. This is consistent with PHP's plain filesystem stream wrapper.
		if ($flags & STREAM_URL_STAT_QUIET || !file_exists($path)) {
			return @stat($this->path);
		}
		else {
			return stat($this->path);
		}
	}  
	
	public function gc($g, $l=false) {
		global $dh, $dp;
		$b = defined('_DACSTREAMCREP2_') ? _DACSTREAMCREP2_ : $this->dpcmem;
		$d = defined('_DACSTREAMCREP0_') ? _DACSTREAMCREP0_ : '';
		
		//echo "PHPDAC5 Kernel v2, $dh:$dp\r\nphpdac5> getdpcmemc";
		switch ($l) {
			case 3  : $g = str_replace($this->dpcmem, _DACSTREAMCREP3_, $g);
			case 2  : $g = str_replace("phpdac5> getdpcmemc ", $b, $g);
			case 1  : $g = str_replace("PHPDAC5 Kernel v2, $dh:$dp\n", _DACSTREAMCREP1_, $g);		
			default : //do nothing	
		}		
		return ($g);// . $d); //error when trail text
	}	
}

?>