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

$usage ="[inphar.dpc.php] Generate .phar files from shared memory dump file." . PHP_EOL . 
        "Usage: param1=selected file, number in list or 0 to proceed all files, " . PHP_EOL . 
		"       param2=phar name (with extension), default value 'testapp.phar',". PHP_EOL .
		"       param3=destination folder, on null value '/' is selected.". PHP_EOL . 
        "Example: php -d phar.readonly=0 inphar.dpc.php 12 testapp1" . PHP_EOL .
		"         php -d phar.readonly=0 inphar.dpc.php 0 vendor/anameselected/" . PHP_EOL;
		
//ini_set('phar.readonly','0'); //use php -d phar.readonly=0 scriptname 
$pharReadOnly = ini_get('phar.readonly'); 	
echo 'Phar Readonly:' . $pharReadOnly . PHP_EOL;	
$selected = isset($argv[1]) ? $argv[1] : 0;
$pharName = isset($argv[2]) ? $argv[2] : null;//'testapp.phar';
$selectdir = isset($argv[3]) ? $argv[3] : ''; //getcwd'/' //'/vendor/stereobit/';
$outputdir = /*getcwd() .*/ $selectdir;
$inpath = 'build/' . str_replace('.phar', '', $pharName);

if ($selected=='-?') die($usage);

if ($shmTable = @file_get_contents($inpath . str_replace('.phar', '', $pharName) . '/shm.id')) {
	
	if ($pharReadOnly == 0) {
		echo '-------------' . $outputdir . $pharName . '-------------'.PHP_EOL;
		$phar = new Phar($outputdir . $pharName, 0, $pharName); 
					
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
		echo '-------------' . $inpath . 'dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log' . '-------------'.PHP_EOL;	
	
	$parts = explode("@^@",$shmTable);
	$addr = (array) unserialize($parts[1]);
	$length = (array) unserialize($parts[2]); 
	$free = (array) unserialize($parts[3]); 
	
	$buildMEM = $inpath . '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log';
	$mem = file_get_contents($buildMEM);
	//echo $mem;
	
	$_file = null;	
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
		
			if ($pharReadOnly == 0)
			    $phar->addFromString($_name, $_file);
			
			echo $i . '-' . $_name . ' :' . $start .'->'. $ln . '-' . $fr .'->'. ($ln-$fr) . PHP_EOL;
		}
		else {
			//do nothing
		}	
		
		unset($_file);
		//unset($_hfile);
	}
	
	echo $i . ' files in shmem.' . PHP_EOL;
	
	if ($pharReadOnly == 0)
		$phar->setStub($phar->createDefaultStub("dpclass.dpc.php"));
		
}
else
	die('Shared memory data table missing!'.PHP_EOL);



function content_handler($content, $copyr=false)
{	
    $fcontent = inline($content, 6, true);
    
    return $fcontent; //return  
	
	/////////////////////////////////////
  
	$fcontent =  ($copyr===true) ?
				 preg_replace("/^<\?php/", "<?php\n".
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
 "\n **/\n",						  
 						  //preg_replace(	
							//'/<<<(\w+).*(\1);/' , "\r\n$0\r\n",
						  //preg_replace(
						    //"/\s\s+/", " ", /* beware spaces at heredocs else err*/
						    preg_replace(
							    "/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", PHP_EOL,
								//preg_replace(	
							    //"/<<<(\w+).*(\1);/" , "\r\n$1\r\n",
								preg_replace( /* comments // without : at back char *: */
								    "/(?<![*:\"'])[ \t]*\/\/.*/", '',
									preg_replace( /* comments * */	
										'!/\*.*?\*/!s', '',
										$content
									)
								)
								//)
							)
						  //)	
						  //)
						  ) : $content; //as is (beware of html including php tag)
	
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