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

$usage ="[makephar.dpc.php] Generate tier.phar." . PHP_EOL . 
        "Usage: param1=phar name (with extension), default value 'tier.phar" . PHP_EOL . 
		"       param2=destination folder, on null value '/' is selected.',". PHP_EOL . 
        "Example: php -d phar.readonly=0 makephar.dpc.php," . PHP_EOL .
		"         php -d phar.readonly=0 makephar.dpc.php tier.phar vendor/anameselected/" . PHP_EOL;
		
//ini_set('phar.readonly','0'); //use php -d phar.readonly=0 scriptname 
$pharReadOnly = ini_get('phar.readonly'); 	
echo 'Phar Readonly:' . $pharReadOnly . PHP_EOL;	
$pharName = isset($argv[1]) ? $argv[1] : 'tier.phar';
$selectdir = isset($argv[2]) ? $argv[2] : getcwd() . '/build/'; //'/vendor/stereobit/';
$outputdir = $selectdir ;

if ($pharName == '-?') die($usage);

if (is_readable('tier.dpc.php')) {	
	
	if ($pharReadOnly == 0) {
		echo '-------------' . $outputdir .$pharName . '-------------'.PHP_EOL;
		$phar = new Phar($outputdir .$pharName, 0, $pharName); 
		$phar->addFromString('/tierds.lib.php', file_get_contents('tierds.lib.php'));
		$phar->addFromString('/tier.dpc.php', file_get_contents('tier.dpc.php'));
		$phar->setStub($phar->createDefaultStub("/tier.dpc.php"));
	}
	else
		echo 'Set phar.readonly=0'.PHP_EOL;		
}
else
	die('tier file missing!'.PHP_EOL);



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