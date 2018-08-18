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

//https://www.sitepoint.com/packaging-your-apps-with-phar/

$usage ="[updphar.dpc.php] Update and generate .phar files from shared memory dump file and update build/update/ dir." . PHP_EOL . 
        "Usage: param1=selected file, number in list or 0 to proceed all files, " . PHP_EOL . 
		"       param2=phar name (with extension), default value 'testapp.phar',". PHP_EOL .
		"       param3=destination folder, on null value './' is selected". PHP_EOL . 
        "Example: php -d phar.readonly=0 updphar.dpc.php 12 app1.phar" . PHP_EOL .
		"         php -d phar.readonly=0 updphar.dpc.php 0 app2.phar path/to/" . PHP_EOL;
		
define ("_DS_", DIRECTORY_SEPARATOR);
define ("_MACHINENAME", ((strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? 'WINMS' : 'LINMS'));		
define ("_DEFDIR", ((strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? '' : './'));		
			
//ini_set('phar.readonly','0'); //use php -d phar.readonly=0 scriptname 
$pharReadOnly = ini_get('phar.readonly'); 
echo 'Phar Readonly:' . $pharReadOnly . PHP_EOL;		
$selected = isset($argv[1]) ? $argv[1] : 0;
$pharName = isset($argv[2]) ? $argv[2] : 'testapp.phar';
$selectdir = isset($argv[3]) ? $argv[3] : ''; //getcwd'/' //'/vendor/stereobit/';
$inpath = $selectdir ? $selectdir : _DEFDIR; //'build/' . str_replace('.phar', '', $pharName);
$updpath = $inpath . 'update/'; //'build/update/';

if ($selected=='-?') die($usage);

//if ($shmTable = @file_get_contents('build/' . str_replace('.phar', '', $pharName) . '/shm.id')) {
if ($shmTable = @file_get_contents($inpath . 'shm.id')) {	
	
	if ($pharReadOnly == 0) {
		echo '-------------' . $inpath . $pharName . '-------------'.PHP_EOL;
		$phar = new Phar($inpath . $pharName, 0, $pharName); 
					
		//pre-req files
		if ($selected == 0) {
			/*
			$pharPCNTL = content_handler(file_get_contents('system/pcntlphar.lib.php'),true);
			$phar->addFromString("system/pcntlphar.lib.php", $pharPCNTL);
			echo 'Prereq 1: system/pcntlphar.lib.php' . '->' . strlen($pharPCNTL) .  PHP_EOL;
			
			$dacPCNTL = content_handler(file_get_contents('system/dacstreamc.lib.php'),true);
			$phar->addFromString("system/dacstreamc.lib.php", $dacPCNTL);
			echo 'Prereq 2: system/dacstreamc.lib.php' . '->' . strlen($dacPCNTL) .  PHP_EOL;
			*/
		}
	}
	else
		echo '-------------' . $inpath .'dumpmem-tree-'. _MACHINENAME .'.log' . '-------------'.PHP_EOL;	
	
	$parts = explode("@^@",$shmTable);
	$addr = (array) unserialize($parts[1]);
	$length = (array) unserialize($parts[2]); 
	$free = (array) unserialize($parts[3]); 
	
	$buildMEM = $inpath . 'dumpmem-tree-'. _MACHINENAME .'.log';
	$mem = file_get_contents($buildMEM);
	//echo $mem;
	
	$_updfile = null;
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

			if ($pharReadOnly == 0)
				$phar->addFromString($_name, $_file);
			
			echo $_file;
			echo 'EOF'. $pharReadOnly . PHP_EOL;
			echo $i . '-' . $_name . ' :' . $start .'->'. $ln . '-' . $fr .'->'. ($ln-$fr) . PHP_EOL;
		}		
		elseif ($selected==0) { //all
		
			if ($pharReadOnly == 0) {
				
				$_updfile = $updpath . $_name;
				if (file_exists($_updfile)) {
					$phar->addFromString($_name, file_get_contents($_updfile));
					echo $i . '-' . $_name . ' : .......UPDATED' . PHP_EOL;
				}
				else {	
					$phar->addFromString($_name, $_file);
					echo $i . '-' . $_name . ' :' . $start .'->'. $ln . '-' . $fr .'->'. ($ln-$fr) . PHP_EOL;
				}
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
	if ($ins = insertFiles($phar, 'insertlist.txt', $inpath))
		echo $ins . ' files added in phar.' . PHP_EOL;
	
	//delete files from build/update/ dir 
	if ($del = removeFiles($phar, 'removelist.txt', $inpath))
		echo $del . ' files removed from phar.' . PHP_EOL;	
	
	if ($pharReadOnly == 0)
		$phar->setStub($phar->createDefaultStub("dpclass.dpc.php"));
		
}
else
	die('Shared memory data table missing!'.PHP_EOL);


function insertFiles(&$phar, $list=null, $path=null) {
	if (!is_object($phar)) return false;
	$_list = $list ? $list : 'insertlist.txt';
	$_path = $path ? $path : 'build/update/';
	$_insfile = $_path . 'update/' . $_list; 
	$i=0;
	
	echo "Insert files (descriptor: $_insfile)" . PHP_EOL;
	if (@is_file($_insfile)) {

		$files = file($_insfile);

		if (!empty($files)) {

			foreach ($files as $name) {
				$i+=1;
				$_name = str_replace(array('*','\\'),
									 array('','/'), trim($name));
									 
				//$newFile = getcwd() . '/' . $_path . $_name;					 
				$newFile = $_path . 'update/' . $_name;					 
				//echo $i . '-' . $newFile; 

				if (file_exists($newFile)) {
					$phar->addFromString($_name, file_get_contents($newFile));
					echo $i . '-' . $newFile .': '. $_name . ' .......INSERTED' . PHP_EOL;
				}				
				else
					echo $i . '-' . $newFile . ' : .......NOT EXIST!' . PHP_EOL;
			}
		}
	}
	else {
		echo "Insert descriptor file not exit!" . PHP_EOL;
		return false;
	}
	
	return $i;
}

function removeFiles(&$phar, $list=null, $path=null) {
	if (!is_object($phar)) return false;
	$_list = $list ? $list : 'removelist.txt';
	$_path = $path ? $path : 'build/update/';
	$_delfile = $_path . 'update/' .  $_list; 
	$i=0;
	
	echo "Delete files (descriptor: $_delfile)" . PHP_EOL;
	if (@is_file($_delfile)) {

		$files = file($_delfile);

		if (!empty($files)) {

			foreach ($files as $name) {
				$i+=1;
				$_name = str_replace(array('*','\\'),
									 array('','/'), trim($name));				
				//$newFile = getcwd() . '/' . $_path . $_name;					 
				//echo $i . '-' . $newFile; 

				//if (file_exists($newFile)) {
					$phar->delete($_name);
					echo $i . '-' . $_name . ' : ........DELETED' . PHP_EOL;
				//}
				//else
					//echo $i . '-' . $newFile . ' : .......NOT EXIST!' . PHP_EOL;
			}
		}
	}
	else {
		echo "Delete descriptor file not exit!" . PHP_EOL;
		return false;
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