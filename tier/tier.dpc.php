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
error_reporting(E_ALL & ~E_NOTICE);

define ("GLEVEL", 1); 
define ("KERNELVERBOSE", 1);//override daemon VERBOSE_LEVEL 1/2
define ("_DS_", DIRECTORY_SEPARATOR);	
define ("_MACHINENAME", ((strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? 'WINMS' : 'LINMS'));
define ("_DUMPFILE", 'dumpagn-'. _MACHINENAME . '.log');
//due to getcwd diff from win to unx
define ("_UMONFILE", ((strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? '/umon-'. _MACHINENAME . '-' : '/tier/umon-'. _MACHINENAME . '-'));
define ("_TIMEOUT", 10); //30= time x 20sec = 600 /60 = 10 min
define ("_MEMEXTRSPC", 1024 * 1000); ////1000 / 3200/ (kb)
define ("_MEMDATASPC", 1024000 * 9); //mb 
	
define('_DACSTREAMCVIEW_', 3); //must be 3 to clean replies
define('_DACSTREAMCREP1_', '');
define('_DACSTREAMCREP2_', '');
define('_DACSTREAMCREP3_', '');
define('_DACSTREAMCREP0_', '');

    //tier ver, before load cnf
	function _tverbose($str=null)
	{
		if (KERNELVERBOSE > 0)
			echo $str;
	}
	
require_once("tier/tierds.lib.php"); 
new tierds();

class tier_dacstream_DISABLED {

	public $position, $data, $size;
	public $DPCEOF, $path, $dpcmem;

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
		$request = "getdpcmemc " . $this->dpcmem . PHP_EOL;//"\r\n";
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
		
		return $ret;
		//return ($this->gc($ret,_DACSTREAMCVIEW_)); //DISABLED
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
			default : /*$g = str_replace("\n", '', $g);*///do nothing	
		}		
		return ($g);// . $d); //error when trail text
	}	
}
?>