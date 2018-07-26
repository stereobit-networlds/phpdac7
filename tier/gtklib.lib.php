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