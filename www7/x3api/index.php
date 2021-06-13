<?php
if (array_key_exists('curl_check', $_GET))
//if ($_REQUEST['curl_check'])	
	die('success');

if (array_key_exists('zip_check', $_GET)) {
//if ($_REQUEST['zip_check'])	{
    $time = time();
	$zip = new ZipArchive();
	$filename = "./testfile". $time .".zip";

	if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
	exit("cannot open <$filename>\n");
	}

	$zip->addFromString("/testdir/testfile.txt", "#1 This is a test string added as testfile.txt.\n");
	$zip->addFromString("testfile.txt", "#2 This is a test string added as testfile2.txt.\n");
	//$zip->addFile("testfile.txt","testfile.php");
	//echo "numfiles: " . $zip->numFiles . "\n";
	//echo "status:" . $zip->status . "\n";
	$zip->close();	
	
	//die('success');
	die(file_get_contents($filename));
}	

if (array_key_exists('install', $_GET)) {
    $time = time();
	$i = $_GET['install'];
	
	foreach ($_POST as $var=>$val) {
		$data.= $var . ':' . $val . "\r\n";
	}
	file_put_contents($i . $time.'.php', $data);

    switch ($i) {
		
		case  2 :	$f = 'data.zip'; break;
		case  1 :	$f = 'data.zip'; break;
		default :   $f = $i .'.zip';
	}
    //echo $f;	
	die(file_get_contents($f));
}
?>