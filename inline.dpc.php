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

	//File put contents fails if you try to put a file in a directory that doesn't exist. This creates the directory.
	function file_force_contents($dir, $contents)
	{
        $parts = explode('/', $dir); //print_r($parts);
        $file = array_pop($parts);
        $dir = '';
        foreach($parts as $part)
            if (($part) && (!is_dir($dir .= "/$part"))) mkdir($dir);
        return file_put_contents("$dir/$file", $contents);
    }

    function inline_r($path, $location=null)
	{
	    //echo '>>>>' . $location . $path . PHP_EOL;			
		if (!file_exists($path)) 
			return 0;
		
	    if (is_file($path)) 
		{
			if ((strstr($path, '.dpc.php')) ||
				(strstr($path, '.lib.php'))) 
			{ 
			    if ($location) //safer to remark else overwtite files
					$tname = $path;
				else	
					$tname = str_replace(array('.dpc.php','.lib.php'),
										 array('.nlv.php','.nlb.php'),$path);
				//echo 'Filename:' . $tname;
				
				/*$returnValue = preg_match_all('|<<<(\w+).*(\1);|msU', 'xxx',
											file_get_contents($path), $matches);
											
				echo 'a:' .$returnValue;*/
				
				$enc = file_force_contents($location . $tname, 
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
										@file_get_contents($path)
									)
								)
								//)
							)
						  //)	
						  //)
						  )
						);					 
						
				if ($enc) 
				{
					echo $location . $tname . PHP_EOL;
					return $enc; //filesize($tname); //exit bytes
				}
				
				echo $location . $tname . " error!" . PHP_EOL;
				return 1; //exit 1
			}
				
			return 1; //exit 1	
		}	
			
		$ret = 0;
		
		$glob = glob($path."/*", GLOB_NOSORT);
		
		if (is_array($glob)) 
		{
			foreach(glob($path."/*", GLOB_NOSORT) as $fn)
				$ret += inline_r($fn, $location);
		}	
		return $ret;
    }
//  Removes multi-line comments and does not create
//  a blank line, also treats white spaces/tabs 
//$text = preg_replace('!^[ \t]*/\*.*?\*/[ \t]*[\r\n]!s', '', $text);

//  Removes single line '//' comments, treats blank characters
//$text = preg_replace('![ \t]*//.*[ \t]*[\r\n]!', '', $text);

//  Strip blank lines
//$text = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $text); 

//https://stackoverflow.com/questions/709669/how-do-i-remove-blank-lines-from-text-in-php										             
	
	
	
	$argc = $GLOBALS['argc'];
	$argv = $GLOBALS['argv'];	
	//print_r($argv);
	if ($argc>1) {
		$b = inline_r($argv[1], $argv[2]);
		echo "Total bytes inlined: " .$b. PHP_EOL;	
	}
	else
		die("Usage: param1=read dir/file, write file(.nlv,.nlb).php files, " . PHP_EOL . 
			"       param2=alt location to write file(.dpc,.lib).php files". PHP_EOL . 
	        "Example: php inline.dpc.php /github/phpdac6/nvl" . PHP_EOL .
			"         php inline.dpc.php /github/phpdac6/nlv otherroot" . PHP_EOL);
 
?>