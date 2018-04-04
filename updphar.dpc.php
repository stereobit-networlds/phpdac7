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

//https://www.sitepoint.com/packaging-your-apps-with-phar/

$usage ="[updphar.dpc.php] Update and generate .phar files from shared memory dump file and update build/update/ dir." . PHP_EOL . 
        "Usage: param1=selected file, number in list or 0 to proceed all files, " . PHP_EOL . 
		"       param2=phar name (with extension), default value 'testapp.phar',". PHP_EOL .
		"       param3=destination folder, on null value '/' is selected.". PHP_EOL . 
        "Example: php -d phar.readonly=0 updphar.dpc.php 12 testapp1" . PHP_EOL .
		"         php -d phar.readonly=0 updphar.dpc.php 0 vendor/anameselected/" . PHP_EOL;
		
//ini_set('phar.readonly','0'); //use php -d phar.readonly=0 scriptname 
$pharReadOnly = ini_get('phar.readonly'); 		
$selected = isset($argv[1]) ? $argv[1] : 0;
$pharName = isset($argv[2]) ? $argv[2] : 'testapp.phar';
$selectdir = isset($argv[3]) ? $argv[3] : ''; //getcwd'/' //'/vendor/stereobit/';
$outputdir = /*getcwd() .*/ $selectdir;

if ($selected=='-?') die($usage);

if ($shmTable = @file_get_contents('shm.id')) {
	
	if (!$pharReadOnly) {
		$phar = new Phar($outputdir . $pharName, 0, $pharName); 
					
		//pre-req files
		if ($selected == 0) {
			//$pharPCNTL = file_get_contents('system/pcntlphar.lib.php');
			$pharPCNTL = content_handler(file_get_contents('system/pcntlphar.lib.php'),true);
			$phar->addFromString("system/pcntlphar.lib.php", $pharPCNTL);
			echo 'Prereq : system/pcntlphar.lib.php' . '->' . strlen($pharPCNTL) .  PHP_EOL;
		}
	}				
	
	$parts = explode("@^@",$shmTable);
	$addr = (array) unserialize($parts[1]);
	$length = (array) unserialize($parts[2]); 
	$free = (array) unserialize($parts[3]); 
	
	$mem = file_get_contents('dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
	//echo $mem;
	$i=0;
	foreach ($addr as $name=>$start) {
		$i+=1;
		$ln = $length[$name];
		$fr = $free[$name];
		$_name = str_replace(array('*','\\',),
							 array('','/'), $name);
		$_file = substr($mem, $start, $ln-$fr); 
		//$_hfile = content_handler($_file, true);
		
		if ($selected==$i) { //specified file

			if (!$pharReadOnly)
				$phar->addFromString($_name, $_file);
			
			echo $_file;
			echo 'EOF'. $pharReadOnly . PHP_EOL;
			echo $i . '-' . $_name . ' :' . $start .'->'. $ln . '-' . $fr .'->'. ($ln-$fr) . PHP_EOL;
		}		
		elseif ($selected==0) { //all
		
			if (!$pharReadOnly)
				
				$_updfile = 'build/update/' . $_name;
				if (file_exists($_updfile)) {
					$phar->addFromString($_name, file_get_contents($_updfile));
					echo $i . '-' . $_name . ' : .......................UPDATED' . PHP_EOL;
				}
				else {	
					$phar->addFromString($_name, $_file);
					echo $i . '-' . $_name . ' :' . $start .'->'. $ln . '-' . $fr .'->'. ($ln-$fr) . PHP_EOL;
				}	
		}
		else {
			//do nothing
		}	
		
		unset($_file);
		//unset($_hfile);
	}
	echo $i . ' files in shmem.' . PHP_EOL;
	
	//insert new files from build/update/ dir 
	//(depend on insertlist.txt)
	if ($ins = insertFiles($phar))
		echo $ins . ' files added in phar.' . PHP_EOL;
	
	if (!$pharReadOnly)
		$phar->setStub($phar->createDefaultStub("dpclass.dpc.php"));
		
}
else
	die('Shared memory data table missing!'.PHP_EOL);


function insertFiles(&$phar, $path=null) {
	if (!is_object($phar)) return false;
	$_path = $path ? $path : 'build/update/';
	$_insfile = 'build/update/insertlist.txt';
	$i=0;
	
	if (is_file($_insfile)) {

		$files = file($_insfile);

		if (!empty($files)) {

			foreach ($files as $name) {
				$i+=1;
				$_name = str_replace(array('*','\\'),
									 array('','/'), trim($name));				
				$newFile = getcwd() . '/' . $_path . $_name;					 
				//echo $i . '-' . $newFile; 

				//if (file_exists($newFile)) {
					$phar->addFromString($_name, file_get_contents($newFile));
					echo $i . '-' . $_name . ' : .......................INSERTED' . PHP_EOL;
				//}				
			}
		}
	}
	
	return $i;
}


function content_handler($content, $copyr=false)
{	
    $fcontent = inline($content, 6, true);
    
    return $fcontent;  	
}

function inline($data, $level=null, $copyr=false)
{
	if (!$data) return null;
	
	switch ($level) 
	{
		
		case 6 : $data = preg_replace( /* comments * */	
										'!/\*.*?\*/!s', '',
										$data
									 );		
									 
		case 5 : $data = preg_replace( /* comments // without : at back char *: */
								    "/(?<![*:\"'])[ \t]*\/\/.*/", '',
									$data
									);			
		
		case 4 : /*$data = preg_replace(	
									"/<<<(\w+).*(\1);/" , "\r\n$1\r\n",
									$data
									);*/					
		
		case 3 : $data = preg_replace(
									"/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", PHP_EOL,
									$data
									);	

		case 2 : /*$data = preg_replace(
									"/\s\s+/", " ", // beware spaces at heredocs else err
									$data
									);	*/	
									
		case 1 : /*$data = preg_replace(	
									'/<<<(\w+).*(\1);/' , "\r\n$0\r\n",
									$data
									);*/

									 
		default: $data = ($copyr===true) ? preg_replace("/^<\?php/", "<?php\n".
 "\n/**".
 "\n *".
 "\n *  Copyright 2018,     balexiou@stereobit.com".
 "\n *".
 "\n *  Licensed under the Apache License, Version 2.0 (the \"License\");".
 "\n *  you may not use this file except in compliance with the License".
 "\n *  You may obtain a copy of the License at".
 "\n *".
 "\n *  http://www.apache.org/licenses/LICENSE-2.0".
 "\n *".
 "\n *  Unless required by applicable law or agreed to in writing, software".
 "\n *  distributed under the License is distributed on an \"AS IS\" BASIS,".
 "\n *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.".
 "\n *  See the License for the specific language governing permissions and".
 "\n *  limitations under the License.".
 "\n *".
 "\n *".
 "\n **/\n", $data) : $data;	
 
	}
	
	return ($data);
}
?>