<?php
$localscript=1;
require_once('phpdac7.php');
/*
$htmlpage = new pcntl('
load_extension adodb refby _ADODB_; 
super database;

',1);
*/
//echo 'start';
$cmd = isset($_GET['t']) ? $_GET['t'] : 'srvSchedules';

/*$ret = phpdac7\jdecode(phpdac7\get($cmd));				
//echo $ret;
if (!empty($ret))
		foreach ($ret as $line)
			echo '<br/>' . $line->agent . ' ' . $line->counter;
*/	
//for($i=0;$i<5;$i++)
$ret = phpdac7\getT($cmd);
//$ret = phpdac7\getT('{"query":"mutation{sum(x:2,y:2)}"}');
//$ret = phpdac7\getT('process');// . serialize(array_merge($env, $usr, array('dacport'=>$agnport))));
echo $ret;		
?>