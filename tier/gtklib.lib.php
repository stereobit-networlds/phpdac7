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

//used by agentds
class gtkds_connector {

   private $code_sep;
   
   function __construct() {
   
	 $this->code_sep = "\r\n<-->\r\n";  
   }
   
   function set_async_code($code) {
   
     if (is_file("code.txt")) { //means executed code remains
	   $fname = "code.bee";
	 }
	 else
	   $fname = "code.txt";
	   
	 if ($fp=fopen($fname,"a+")) {
	 
	   fwrite($fp,$code.$this->code_sep);
	   fclose($fp);
	 }  
	 
   }
   
   function set_async_data($data) {
   
	 $fname = "data.txt"; 
	 $mode = "a+";  
	   
	 if ($fp=fopen($fname,$mode)) {
	 
	   fwrite($fp,$data.$this->code_sep);
	   fclose($fp);
	 }  	          
   }
   
   function get_async_data() {
   
     if (is_file("data.txt")) { //means values exists
	   $fname = "data.txt"; 
	   
	   //read 1st part of data
	   if ($fp=fopen($fname,"rb")) {
	     $data_chunk = fread($fp,filesize($fname));
	     fclose($fp);
		 
		 $parts = explode($this->code_sep,$data_chunk);
		 $ret = array_shift($parts);
		 unlink($fname); //delete it
	   }
	   //if data leaved ... create again ..writing the rest...
	   if ((trim($parts[0])) && ($fp=fopen($fname,"wb"))) {
	     fwrite($fp,implode($this->code_sep,$parts));
	     fclose($fp);	   
	   }	   
	   
	   return $ret;	    
	 }  	     
   }     
}
?>