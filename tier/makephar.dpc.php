#!/usr/bin/env php
<?php
/*
	Licence
	
	Copyright (c) 2018 stereobit.networlds | Vassilis Alexiou
	balexiou@stereobit.com | https://www.stereobit.com
	
	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:
	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.
	
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
	
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