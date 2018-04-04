#!/usr/bin/env php
<?php
/**
 *
 * Copyright (c) 2009-2018, Vassilis Alexiou <balexiou@stereobit.com>.
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Vassilis Alexiou nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 */
 
$usage ="[testphar.dpc.php] Test generated .phar files from shared memory dump file." . PHP_EOL . 
        "Usage: param1=phar name (with extension), default value 'testapp.phar',". PHP_EOL .
		"       param2=source folder, on null value '/vendor/stereobit/' is selected.". PHP_EOL . 
        "Example: php -d phar.readonly=0 testphar.dpc.php testapp1" . PHP_EOL .
		"         php -d phar.readonly=0 testphar.dpc.php testapp2 /vendor/anameselected/" . PHP_EOL;
		
//ini_set('phar.readonly','0'); //use php -d phar.readonly=0 scriptname 
$pharReadOnly = ini_get('phar.readonly'); 		
$pharName = isset($argv[1]) ? $argv[1] : 'testapp.phar';
$selectdir = isset($argv[2]) ? $argv[2] : '';// '/' //'/vendor/stereobit/';
$sourcedir = /*getcwd() .*/ $selectdir;
if ($pharName=='-?') die($usage);

try {
	echo '-------------' . $sourcedir . $pharName . '-------------'.PHP_EOL;
    // open an existing phar
    $p = new Phar($sourcedir . $pharName, 0);
    // Phar extends SPL's DirectoryIterator class
    foreach (new RecursiveIteratorIterator($p) as $file) {
        // $file is a PharFileInfo class, and inherits from SplFileInfo
        //echo $file->getFileName() . PHP_EOL;
        //echo file_get_contents($file->getPathName()) . "\n"; // display contents;
		echo $file->getPathName() . PHP_EOL;
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