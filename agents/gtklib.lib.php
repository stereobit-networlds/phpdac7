<?php
/*if( !class_exists('gtk')) {
    die('Please load the php-gtk2 module in your php.ini' . "\r\n");
}*/

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