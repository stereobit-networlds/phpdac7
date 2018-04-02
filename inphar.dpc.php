#!/usr/bin/env php
<?php
//https://www.sitepoint.com/packaging-your-apps-with-phar/
/*
$srcRoot = "~/myapp/src";
$buildRoot = "~/myapp/build";
 
$phar = new Phar($buildRoot . "/myapp.phar", 
	FilesystemIterator::CURRENT_AS_FILEINFO |     	FilesystemIterator::KEY_AS_FILENAME, "myapp.phar");
$phar["index.php"] = file_get_contents($srcRoot . "/index.php");
$phar["common.php"] = file_get_contents($srcRoot . "/common.php");
$phar->setStub($phar->createDefaultStub("index.php"));

copy($srcRoot . "/config.ini", $buildRoot . "/config.ini");
*/

$usage ="[inphare.dpc.php] Generate .phar files from shared memory dump file." . PHP_EOL . 
        "Usage: param1=selected file, number in list or 0 to proceed all files, " . PHP_EOL . 
		"       param2=phar name (with extension), default value 'testapp.phar',". PHP_EOL .
		"       param3=destination folder, on null value '/vendor/stereobit/' is selected.". PHP_EOL . 
        "Example: php -d phar.readonly=0 inphar.dpc.php 12 testapp1" . PHP_EOL .
		"         php -d phar.readonly=0 inphar.dpc.php 0 /vendor/anameselected/" . PHP_EOL;
		
//ini_set('phar.readonly','0'); //use php -d phar.readonly=0 scriptname 
$pharReadOnly = ini_get('phar.readonly'); 		
$selected = isset($argv[1]) ? $argv[1] : 0;
$pharName = isset($argv[2]) ? $argv[2] : 'testapp.phar';
$selectdir = isset($argv[3]) ? $argv[3] : '/vendor/stereobit/';
$outputdir = getcwd() . $selectdir;

if ($selected=='-?') die($usage);

if ($shmTable = @file_get_contents('shm.id')) {
	
	if (!$pharReadOnly)
		$phar = new Phar($outputdir . $pharName, 
					FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME, $pharName);	
	
	$parts = explode("@^@",$shmTable);
	$addr = (array) unserialize($parts[1]);
	$length = (array) unserialize($parts[2]); 
	$free = (array) unserialize($parts[3]); 
	
	$mem = file_get_contents('dumpmem-tree-BILLY-PC.log');
	//echo $mem;
	$i=0;
	foreach ($addr as $name=>$start) {
		$i+=1;
		$ln = $length[$name];
		$fr = $free[$name];
		
		if ((!$pharReadOnly) && ($selected==0)) 
			$phar[str_replace('*','',$name)] = substr($mem, $start, $ln-$fr); //mb!!
		else 
			$test[$i] = substr($mem, $start, $ln-$fr);
		
		echo $name . ' :' . $start .'-'. $ln . '->' . $fr .'->'. ($ln-$fr) . PHP_EOL;
		
	}
	
	echo $i . ' files in shmem.' . PHP_EOL;
	//test
	//echo $phar['process/pstack.lib.php'];
	if ($selected > 0) {
		echo $test[$selected];
		echo 'EOF'. $pharReadOnly . PHP_EOL;
		
		if (!$pharReadOnly)
			$phar['testphar.php'] = $test[$selected];
	}
	
	if (!$pharReadOnly)
		$phar->setStub($phar->createDefaultStub("dpclass.dpc.php"));
		
}
else
	die('Shared memory data table missing!'.PHP_EOL);
?>