<?php
$localscript=1;
require_once('phpdac7.php');

$htmlpage = new pcntl('
load_extension adodb refby _ADODB_; 
super database;

',1);
//echo 'start';
$cmd = isset($_GET['t']) ? $_GET['t'] : 'srvSchedules';

//$ret = phpdac7\dclean(phpdac7\get(str_replace($cmd, '', phpdac7\get($cmd))));
$ret = phpdac7\jdecode(phpdac7\get(phpdac7\get($cmd)));
//print_r($ret);
if (!empty($ret)) {
	foreach ($ret as $line)
		echo '<br/>' . $line->agent . ' ' . $line->counter;
}		
?>