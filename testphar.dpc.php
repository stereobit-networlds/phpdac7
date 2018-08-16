#!/usr/bin/env php
<?php
/**
 * This file is part of phpdac7.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    balexiou<balexiou@stereobit.com>
 * @copyright balexiou<balexiou@stereobit.com>
 * @link      http://www.stereobit.com/php-dac7.php
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
 
$usage ="[testphar.dpc.php] Test generated .phar files from shared memory dump file." . PHP_EOL . 
        "Usage: param1=selected file, number in list or 0,". PHP_EOL .
		"       param2=phar name (with extension), default value 'testapp.phar',". PHP_EOL . 		
		"       param3=source folder, on null value './' is selected". PHP_EOL . 
		"       param4=search string". PHP_EOL .	
        "Example: php -d phar.readonly=0 testphar.dpc.php app1.phar" . PHP_EOL .
		"         php -d phar.readonly=0 testphar.dpc.php app2.phar /path/to/ findstring" . PHP_EOL;
		
define ("_DS_", DIRECTORY_SEPARATOR);
define ("_DEFDIR", ((strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? '' : './'));
		
//ini_set('phar.readonly','0'); //use php -d phar.readonly=0 scriptname 
$pharReadOnly = ini_get('phar.readonly'); 	
$selected = isset($argv[1]) ? $argv[1] : 0;	
$pharName = isset($argv[2]) ? $argv[2] : 'testapp.phar';
$selectdir = isset($argv[3]) ? $argv[3] : _DEFDIR; //'/vendor/stereobit/';
$sourcedir = /*getcwd() .*/ $selectdir;
$searchphartext = isset($argv[4]) ? $argv[4] : null;

if ($selected == '-?') die($usage);

try {
	echo '-------------' . $sourcedir . $pharName . '-------------'.PHP_EOL;
    // open an existing phar
    $p = new Phar($sourcedir . $pharName, 0);
	
	$i = 0;
    // Phar extends SPL's DirectoryIterator class
    foreach (new RecursiveIteratorIterator($p) as $file) {
        // $file is a PharFileInfo class, and inherits from SplFileInfo
        //echo $file->getFileName() . PHP_EOL;
        //echo file_get_contents($file->getPathName()) . "\n"; // display contents;
		$i+=1;
		
		if ($searchphartext) { 
			//search for a given string
			$text = file_get_contents($file->getPathName());
			if (strstr($text, $searchphartext)) 
				echo $i . '-' .$file->getPathName() . PHP_EOL;
		}
		elseif ($selected==$i) {
			//return selected file content
			echo file_get_contents($file->getPathName()) . PHP_EOL;
			echo $i . '-' .$file->getPathName() . PHP_EOL;
		}
		elseif ($selected==0) {
			//show file
			echo $i . '-' .$file->getPathName() . PHP_EOL;
		}	
		else {
			//do nothing
		}
			
    }
	/*
    if (isset($p['internal/file.php'])) {
        var_dump($p['internal/file.php']->getMetadata());
    }

    // create a new phar - phar.readonly must be 0 in php.ini
    // phar.readonly is enabled by default for security reasons.
    // On production servers, Phars need never be created,
    // only executed.
    if (Phar::canWrite()) {
        $p = new Phar('newphar.tar.phar', 0, 'newphar.tar.phar');
        // make this a tar-based phar archive, compressed with gzip compression (.tar.gz)
        $p = $p->convertToExecutable(Phar::TAR, Phar::GZ);

        // create transaction - nothing is written to newphar.phar
        // until stopBuffering() is called, although temporary storage is needed
        $p->startBuffering();
        // add all files in /path/to/project, saving in the phar with the prefix "project"
        $p->buildFromIterator(new RecursiveIteratorIterator(new DirectoryIterator('/path/to/project')), '/path/to/');

        // add a new file via the array access API
        $p['file1.txt'] = 'Information';
        $fp = fopen('hugefile.dat', 'rb');
        // copy all data from the stream
        $p['data/hugefile.dat'] = $fp;

        if (Phar::canCompress(Phar::GZ)) {
            $p['data/hugefile.dat']->compress(Phar::GZ);
        }

        $p['images/wow.jpg'] = file_get_contents('images/wow.jpg');
        // any value can be saved as file-specific meta-data
        $p['images/wow.jpg']->setMetadata(array('mime-type' => 'image/jpeg'));
        $p['index.php'] = file_get_contents('index.php');
        $p->setMetadata(array('bootstrap' => 'index.php'));

        // save the phar archive to disk
        $p->stopBuffering();
		
    }*/
} 
catch (Exception $e) {
    echo 'Could not open Phar: ', $e;
	echo PHP_EOL;
}
?>