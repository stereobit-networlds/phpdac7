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

ob_start(); //ob_clean needs to start for clean (phpdac5 prompts)
$_cleanOB = 2; //1 level of ob_clean after-init-,2 after-event,3 after-render before return

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
$_cleanOB = 0; //0 level if not a phpdac call
$dh = $env['dachost'];
$dp = $env['dacport'];

//$u = file_put_contents($env['dpcpath'] . '/key.md', md5($_ENV['COMPUTERNAME'] . $_ENV['LOGONSERVER']));
if ($env['key']!==md5($_ENV['COMPUTERNAME'] . $_ENV['LOGONSERVER'])) die('phpdac7 valid key required');

try {
	if ($dac = @is_file($env['dpcpath'] . "/shm.id")) {
		if ($pharApp = $env['app']) {
			require("phar://$pharApp/system/pcntlphar.lib.php");
			
			require("phar://$pharApp/system/dacstreamc.lib.php");
			stream_wrapper_register("phpdac5","c_dacstream");			
		}	
		else {
			$_cleanOB = 2; //1 level of ob_clean after-init-,2 after-event,3 after-render before return
			require($env['dpcpath'] . "/system/dacstreamc.lib.php");
			if ($phpdac_c = stream_wrapper_register("phpdac5","c_dacstream"))	
				require("phpdac5://$dh:$dp/system/pcntlst.lib.php");	
			else
				die("Client protocol failed to registered!");
		}
	}
    else		 
		require($env['dpcpath'] . '/system/pcntl.lib.php');
}
catch (Exception $e) {
	echo 'Caught exception: ',  $e->getMessage() . PHP_EOL;
	throw $e;
}


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

function dclean($dmsg=null) {
    global $dh, $dp;	
	//echo "PHPDAC5 Kernel v2, $dh:$dp\r\nphpdac5> getdpcmemc";
	return str_replace("phpdac5> getdpcmemc ",'',
			str_replace("PHPDAC5 Kernel v2, $dh:$dp", '', $dmsg));		
}
			
function jdecode($dmsg) {			
	preg_match( '/\[(.*)\]/', $dmsg, $res);
	//echo $res[0];	
	return @json_decode($res[0]);					
}

/* namespace\process */   
class dacProcess {
    static public function test($name) {
        //print '[['. $name .']]';
    }
	
    static public function autoload($class)  {
		global $env, $dac, $pharApp;	

        if (0 !== strpos($class, 'process')) //check is process dir
            return;
		
		$file = 'process/'.str_replace(array('_', "\0"), array('/', ''), $class).'.php';		

		if ($dac) {
			if ($pharApp = $env['app'])		
				//require 'cgi-bin/' . $file; //cgi-bin code
				require "phar://$pharApp/" . $file; //phar code
			else			
				require("phpdac5://$dh:$dp/" . $file);
		}	
		elseif (@file_exists($env['dpcpath'] . '/' . $file))
			require $env['dpcpath'] . '/' . $file;
		else
			die($file . ' required.');
    }
}

ini_set('unserialize_callback_func', 'spl_autoload_call');
spl_autoload_register(__NAMESPACE__ .'\dacProcess::autoload');

/* remote script */
if (($dac) && (!$localscript)) { 
	__log('fetch remote:'.$_SERVER['PHP_SELF']);
	if ($pharApp = $env['app'])
		require("phar://$pharApp/www7" . $_SERVER['PHP_SELF']);
	else	
		require("phpdac5://$dh:$dp/www7" . $_SERVER['PHP_SELF']);
	die();
} //else continue
__log('fetch local:'.$_SERVER['PHP_SELF']);
?>