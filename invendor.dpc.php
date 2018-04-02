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
 
$usage ="[invendor.dpc.php] Generate licence files from shared memory dump file." . PHP_EOL .
		"Usage: param1=selected file, number in list or 0 to proceed all files," . PHP_EOL . 
		"       param2=destination folder, default value '/vendor/stereobit/',". PHP_EOL . 
		"       param3=filename without .php, default value 'testshm{id}'". PHP_EOL .		
        "Example: php invendor.dpc.php 12 " . PHP_EOL .
		"         php invendor.dpc.php 0 /vendor/stenet/" . PHP_EOL;
			
$selected = isset($argv[1]) ? $argv[1] : 0;
$selectdir = isset($argv[2]) ? $argv[2] : null;
$selectnam = isset($argv[3]) ? $argv[3] : 'testshm';
$outputdir = getcwd() . ($selectdir ? $selectdir : '/vendor/stereobit/');

if ($selected=='-?') die($usage);

function file_force_contents($fn, $content, $copyr=false)
{
	if(!file_exists(dirname($fn)))
		mkdir(dirname($fn), 0777, true);	

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
	
	return file_put_contents($fn, $fcontent, LOCK_EX);	
}


if ($shmTable = @file_get_contents('shm.id')) {
	
	$parts = explode("@^@",$shmTable);
	$addr = (array) unserialize($parts[1]);
	$length = (array) unserialize($parts[2]); 
	$free = (array) unserialize($parts[3]); 
	
	$shmfile = array();
	$mem = file_get_contents('dumpmem-tree-BILLY-PC.log');
	//echo $mem;
	$i = 0;
	$ok = 0;
	foreach ($addr as $name=>$start) {
		$i+=1;
		$ln = $length[$name];
		$fr = $free[$name];
		
		$shmfile[$i] = substr($mem, $start, $ln-$fr);

		if ($selected==0) {
			//echo dirname($outputdir . $name) . PHP_EOL;
			if(!file_exists(dirname($outputdir . $name)))
				mkdir(dirname($outputdir . $name), 0777, true);	
		
			//$ok = file_put_contents($outputdir . $name, $shmfile[$i], LOCK_EX);			
			$ok = file_force_contents($outputdir . $name, $shmfile[$i], true);
		}		
		echo $name . ' :' . $start .'-'. $ln . '->' . $fr .'->'. ($ln-$fr) .'->'. $ok . PHP_EOL;		
	}
	

	echo $i . ' files in shmem.' . PHP_EOL;

	if ($selected > 0) {
		echo 'EOF'. PHP_EOL;	
		
		echo dirname($outputdir . $selectnam . $selected . '.php') .'/'. 
			 $selectnam . $selected . '.php' . PHP_EOL;
		/*if(!file_exists(dirname($outputdir . $selectnam . $selected . '.php')))
			mkdir(dirname($outputdir . $selectnam . $selected . '.php'), 0777, true);	
		
		$ret = file_put_contents($outputdir . $selectnam . $selected . '.php', $shmfile[$selected], LOCK_EX);
		*/
		$ok = file_force_contents($outputdir . $selectnam . $selected . '.php', $shmfile[$selected], false);
	}
}
else
	die('Shared memory data table missing!'.PHP_EOL);
?>