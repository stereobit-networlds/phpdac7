<?php

class dacstream {

   var $position;
   var $data;
   
   var $DPCEOF;
   var $address;
   var $size;
   //var $current_dpc_name;
   //var $current_dpc_size;

   function stream_open($path,$mode,$options,&$opened_path) {

		$url = parse_url($path);
		//print_r($url);
        $filename = _DPCPATH_."\shm.id";
        
		$fd = @fopen($filename, "r" );

		if (!$fd) {
            echo "shm_id not exist!!!\n";
			return false;
		}

		$data = explode("^",fread($fd,filesize($filename)));
		fclose($fd);  
				
		$this->DPCEOF = $data[0];
		$this->address = unserialize($data[1]); //print_r($this->address);
		$this->size = unserialize($data[2]); //print_r($this->size);

	    $shm_id = $this->dpc_shm_id = shmop_open(0xfff, "a",0,0);//, 0644, $shm_max);
   
        if ($shm_id) {
		  //$this->current_dpc_name = $url['host'] . $url['path'];
		  //$this->current_dpc_size = $this->size[$this->current_dpc_name];
		
		  $dpcid = $url['host'] . $url['path']; //echo $dpcid,'>>>';
		  $this->data = shmop_read($shm_id,$this->address[$dpcid],$this->size[$dpcid]);		
		}  
		    
		$this->position = 0;
		
		return true;   
   }
   
   function stream_read($count) {
   
        $ret = substr($this->data,$this->position,$count);		
		$this->position += strlen($ret);
		
		return ($ret);
   }
   
   function stream_write($data) {
   
        /*$left = substr($this->data, 0, $this->position);
		$right = substr($this->data, $this->position + strlen($data));
		
		$this->data = $left . $data . $right;
		
		$this->position += strlen($data);*/ 
		
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