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
class kfs 
{	
	private $env, $dpcpath; 
	private static $hTable;
	
	public function __construct(& $env=null, $path=null) 
	{	
		$this->env = $env;
		$this->dpcpath = isset($path) ? $path : $env->dpcpath;	
		
		self::$hTable = array(); //hash table (can handle all data types)
	}
	
	//prepare data with md5 before and store
	public static function hAdd($name, $md5data) 
	{
		self::$hTable[$name] = $md5data;
		return true;
	}
	
	//alias, override a value
	public static function hEdt($name, $md5data) 
	{
		self::$hTable[$name] = $md5data;
		return true;
	}	
	
	//remove (stay in)...
	public static function hRem($name)
	{
		reset(self::$hTable);
		//foreach (self::$hTable as $n=>$v)
			//if (strcmp($n,$name)!==0) ..
			
		return true;		
	}
	
	//read an element
	public static function hmd5($name) 
	{
		return self::$hTable[$name];
	}	

	//export to save (not used)
	public static function hExp() 
	{
		return json_encode(self::$hTable);
	}	
	
	//import (replace) load (not used)
	public static function hImp($arr) 
	{
		self::$hTbable = (array) json_decode($arr, true);
		return true;
	}

	//compare two md5 strings, true when equal
	public static function hCmp($md5d1, $md5d2) 
	{
		return (strcmp($md5d1,$md5d2)===0) ? true : false;
	}	
	
	//view hash table (use scheduled tasks)
	public static function hView() 
	{
		_verbose('[------------- hash -------------]' . "\tentry" . PHP_EOL); //header
		reset(self::$hTable);
		foreach (self::$hTable as $n=>$v)
			_verbose('[' . $v . ']' . "\t" . $n . PHP_EOL);
			
		return $ret;
	}		
	
	
	
	//todo: handle md5 array of contents for readed files
	//eg. array[filename] = md5(contentsofthefiles)
	public function _readPHP($filename=null) 
	{
		if (!$filename) return false;
		
		$fdata = @file_get_contents($filename);
		
		return $fdata; //stop here
		
		///////////////////////////////////////////////////
		return  (
						  preg_replace("/^<\?php/","<?php",						  
 						  //preg_replace(	
							//'/<<<(\w+).*(\1);/' , "\r\n$0\r\n",
						  //preg_replace(
						    //"/\s\s+/", " ", /* beware spaces at heredocs else err*/
						    preg_replace(
							    "/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", PHP_EOL,
								//preg_replace(	
							    //"/<<<(\w+).*(\1);/" , "\r\n$1\r\n",
								preg_replace( /* comments // without : at back char :* */
								    "/(?<![*:\"'])[ \t]*\/\/.*/", '',
									preg_replace( /* comments * */		
										'!/\*.*?\*/!s', '',
										@file_get_contents($filename)
									)
								)
								//)
							)
						  //)	
						  //)
						  )
				);
    }

	public function read_dpcs() 
	{
        $dpath = $this->dpcpath;
		
		$selections = array('libs');//array('agents','tcp'); 
		//echo '>>>>>>>>>>>>>>>>>>'. realpath($this->dpcpath);
		/*
		foreach (glob("*.php") as $filename) {
			echo "$filename size " . filesize($filename) . "\n";
		}
		*/
	    if (is_dir($dpath)) {
		
          $mydir = dir($dpath);
		 
          while ($fileread = $mydir->read ()) 
		  {
	   
           //read directories
		   //if (($fileread!='.') && ($fileread!='..'))  { //ALL
		   if (in_array($fileread, $selections)) 
		   { 

	          if (is_dir($dpath. DIRECTORY_SEPARATOR .$fileread)) 
			  {

                 $mysubdir = dir($dpath."/".$fileread);
                 while ($subfileread = $mysubdir->read ()) 
				 {	
				 
		           if (($subfileread!='.') && ($subfileread!='..'))  
				   {
                       if ((stristr ($subfileread,".dpc.php")) || 
						   (stristr ($subfileread,".ext.php")) || 
					       (stristr ($subfileread,".lib.php")))  
				           $mydpc[] = $fileread . DIRECTORY_SEPARATOR . $subfileread;								     
				   }
				 }
			  }
		   }
	      }
	      $mydir->close ();
        }
		//echo $dpath,'>';
		//print_r($mydpc);
		return ($mydpc);   
	}
   
	//UNDER CONSTRUCTION: recur
	public function read_extensions() 
	{
        $dpath = $this->dpcpath . "system/extensions";
   
	    if (is_dir($dpath)) {
          $mydir = dir($dpath);
          while ($fileread = $mydir->read ()) 
		  {
		   if (($fileread!='.') && ($fileread!='..'))  
		   {
	          if (is_dir($dpath . DIRECTORY_SEPARATOR . $fileread)) 
			  {
                 $mysubdir = dir($dpath . DIRECTORY_SEPARATOR . $fileread);
                 while ($subfileread = $mysubdir->read ()) 
				 {	
		           if (($subfileread!='.') && ($subfileread!='..'))  
				   {
                       if (stristr ($subfileread,".php")) 
				           $mydpcext[] = 'system/extensions/'.$fileread."/".$subfileread;							     
				   }
				 }
			  }
		   }
	      }
	      $mydir->close ();
        }
		return ($mydpcext);   
   }   

	//public function free()	
	public function __destruct() 
	{	
        unset($this->dpcpath);	
	}   
}	
?>	