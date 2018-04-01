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

ob_start(); //ob_clean after init at pcntl
date_default_timezone_set('Europe/Athens');
session_start(); 

$start=microtime(true);
$env = array(
'appname' => 'phpdac7',
'apppath' => '',
'dpctype' => 'local',
'dpcpath' => '../../xampp-phpdac7',
'prjpath' => '.',
'app' => '',
'cppath' =>'home/sterobi/public_html/basis/cp',
'key' => 'd41d8cd98f00b204e9800998ecf8427e', 
);
$dac = is_file($env['dpcpath'] . "/shm.id") ? true : false;
//$u = file_put_contents($env['dpcpath'] . '/key.md', md5($_ENV['COMPUTERNAME'] . $_ENV['LOGONSERVER']));
if ($env['key']!==md5($_ENV['COMPUTERNAME'] . $_ENV['LOGONSERVER'])) die('phpdac7 valid key required');

try {
	require("dpc/system/dacstreamc.lib.php");
	$phpdac_c = stream_wrapper_register("phpdac5","c_dacstream");
	if (!$phpdac_c)
			echo "Client protocol failed to registered!";	
	if (($phpdac_c) && ($dac))
		require('phpdac5://127.0.0.1:19123/system/pcntlst.lib.php');
    else	
		require('dpc/system/pcntl.lib.php');		 
}
catch (Exception $e) {
	echo 'Caught exception: ',  $e->getMessage() . PHP_EOL;
	throw $e;
}


class dacProcess {
    static public function test($name) {
        //print '[['. $name .']]';
    }
	
    static public function autoload($class)  {
		global $env, $phpdac_c, $dac;	

        if (0 !== strpos($class, 'process')) //check is process dir
            return;
		
		$file = 'process/'.str_replace(array('_', "\0"), array('/', ''), $class).'.php';		
        //echo '>>>' . $env['dpcpath'] . $file;
		if (($phpdac_c) && ($dac))
			require('phpdac5://127.0.0.1:19123/' . $file);
		elseif (file_exists($env['dpcpath'] . '/' . $file))
				require $env['dpcpath'] . '/' . $file;
		else
			die($file . ' required.');
    }
}

ini_set('unserialize_callback_func', 'spl_autoload_call');
spl_autoload_register(__NAMESPACE__ .'\dacProcess::autoload');
?>