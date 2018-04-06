<?php
namespace phpdac7;

// Report simple running errors
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ...)
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

// Report all errors except E_NOTICE
// This is the default value set in php.ini
error_reporting(E_ALL & ~E_NOTICE);
// For PHP < 5.3 use: E_ALL ^ E_NOTICE

// Report all PHP errors (see changelog)
//error_reporting(E_ALL);

// Report all PHP errors
//error_reporting(-1);
ini_set('log_errors','on');
ini_set('display_errors',1);
ini_set('error_log','errors.log');
//error_log( "Hello, errors!" );

//ob_start(); //ob_clean needs to start for clean (phpdac5 prompts)

date_default_timezone_set('Europe/Athens');
session_start(); 

$start=microtime(true);
$env = array(
'appname' => 'phpdac7',
'apppath' => '',
'dpctype' => 'local',
'dpcpath' => '/xampp-phpdac7',
'prjpath' => '/',
'dachost' => '127.0.0.1',
'dacport' => '19123',
'app' => '/xampp-phpdac7/vendor/stereobit/cpdac7.phar',
'cppath' =>'home/sterobi/public_html/basis/cp',
'key' => 'd41d8cd98f00b204e9800998ecf8427e', 
);
$dac = false; //when shm.id exists turns to true
$pharApp = false; //when phar is enabled turns to true
//$_cleanOB = 0; //0 level if not a phpdac call
$dh = $env['dachost'];
$dp = $env['dacport'];

//$u = file_put_contents($env['dpcpath'] . '/key.md', md5($_ENV['COMPUTERNAME'] . $_ENV['LOGONSERVER']));
if ($env['key']!==md5($_ENV['COMPUTERNAME'] . $_ENV['LOGONSERVER'])) die('phpdac7 valid key required');

$dac = @is_file($env['dpcpath'] . "/shm.id");
$stream = $env['app'] ? "phar://" . $env['app'] : "phpdac5://$dh:$dp";
$st = $dac ? $stream : $env['dpcpath'];
		
define('_DPCPATH_', $env['dpcpath']);

define('_DACSTREAMCVIEW_', 3); //1,2,3 verbose level
define('_DACSTREAMCREP1_', "<!-- $st/");
//define('_DACSTREAMCREP2_', 'B'); //when at least 2 rem to show uri
define('_DACSTREAMCREP3_', ' -->');
define('_DACSTREAMCREP0_', 'D'); //trail txt err		
		
//require("$st/system/dacstreamc.lib.php"); //rem
stream_wrapper_register("phpdac5","phpdac7\c7_dacstream");
require("$st/system/pcntlst.lib.php");


//namespace\funcs
function __log($data=null,$mode=null,$filename=null) 
{
	$m = $mode ? $mode : 'a+';
	$f = $filename ? $filename : '/phpdac7-'.getenv('COMPUTERNAME').'.log';

	if ($fp = @fopen (getcwd() . $f , $m)) 
    {
		fwrite ($fp, date('c') .':'. $data . PHP_EOL);
		fclose ($fp);
		return true;
	}
    return false;
}
   
//call phpdac7 srv to get a variable 
function get($call=null) {
    global $dh, $dp;		
    if (!$call) return false;   
	   
    return @file_get_contents("phpdac5://$dh:$dp/" . $call);
}
			
function jdecode($dmsg=null) {			
	preg_match( '/\[(.*)\]/', $dmsg, $res);
	//echo $res[0];	
	return @json_decode($res[0]);					
}


//namespace\c7_dacstream
class c7_dacstream {

   var $position;
   var $data;
   
   var $DPCEOF;
   var $size;
   
   var $path, $dpcmem;

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


//namespace\process
class dacProcess {
    static public function test($name) {
        //print '[['. $name .']]';
    }
	
    static public function autoload($class)  {
		global $st;	
        if (0 !== strpos($class, 'process')) //check is process dir
            return;
				
		require($st . '/process/'.str_replace(array('_', "\0"), array('/', ''), $class).'.php');
    }
}

ini_set('unserialize_callback_func', 'spl_autoload_call');
spl_autoload_register(__NAMESPACE__ .'\dacProcess::autoload');

/* remote script */
if (($dac) && (!$localscript)) { 

	require("$st/www7" . $_SERVER['PHP_SELF']);
		
	__log('fetch remote:'.$_SERVER['PHP_SELF']);	
	die();
} //else continue
__log('fetch local:'.$_SERVER['PHP_SELF']);
?>