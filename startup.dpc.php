#!/usr/bin/env php
<?php

$argc = $GLOBALS['argc'];
$argv = $GLOBALS['argv'];	
//print_r($argv); 

//error_reporting(E_ALL|E_STRICT);
/*if (!isset($argv[1]))
{
  echo "usage: ",$argv[0], ' "file"|"string"',"\n";
  exit(1);
}*/

//require_once("system/system.lib.php");	
require_once("system/kernelv2.lib.php");

  new kernelv2();//$argv[1],$argv[2],$argv[3]);

/*
//PHP5

  //set time limit 
  //set_time_limit (50); 
  
//error_log ("You messed up!", 2, "195.97.2.40:7869");
//error_log ("You messed up!", 2, "loghost");
//error_log ("You messed up!", 3, "/var/tmp/my-errors.log");
//error_log ("You messed up!", 1, "balexiou@panikidis.gr"); 

//load environment vars
$environment = @parse_ini_file(getenv('SystemRoot')."/phpdac5.ini");
define(_APPNAME_,$environment['appname']);
define(_APPPATH_,$environment['apppath']);
define(_DPCTYPE_,$environment['dpctype']);
define(_PRJPATH_,$environment['prjpath']);
define(_DPCPATH_,_APPPATH_.$environment['dpcpath']);//echo _DPCPATH_,'>>';

//echo _APPPATH_;


require_once("dpclass.dpc.php");	 //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< PHP 5
//require_once("system/system.lib.php");
    
//if (iniload('SHELL')) { 

//require_once("shell/shell.lib.php");    
*/
	
class startup {

   var $path;
   var $proj;
   var $time;

   function __construct($path=null,$proj=null) { //var_dump($GLOBALS);
     /*
     $this->time = $this->getthemicrotime(); 
     */     
	 
	 $this->_loadinifiles($path,$proj);   //<<<ERROR at startup must be at the start of script
	 
	 
	 
	 
	 
	 /*
	 $this->_seterrorlevel();
	 
     //echo "\nTime elapsed: ",$this->getthemicrotime() - $time, " seconds";

	 $this->_startsession();		 	 
	  */	
	 //echo "\nTime elapsed: ",$this->getthemicrotime() - $time, " seconds";   
   }
   /*
   public function render($cl=null,$command=null,$ret=null,$alternative_agent=null) {
   
     $mysh = new shell($cl,$command);
	 
     if ($ret) {
       $out = $mysh->render($alternative_agent);
	   unset($mysh);
	   return ($out);     
     }
     else {	 
       $mysh->render();
	   unset ($mysh);	  
	 }    
   }

   private function getthemicrotime() {
   
     list($usec,$sec) = explode(" ",microtime());
     return ((float)$usec + (float)$sec);
   } 
   */
   private function _loadinifiles($path,$proj) {
	 $argc = $GLOBALS['argc'];
	 $argv = $GLOBALS['argv'];	 
	 
     //check args for comman line kernew startup
     if ((isset($argc)) && ($argv[1]=='-?')) die("Helpme!!!");
	 /*
     require_once("system/sysdb.lib.php");
	 require_once("system/controller.lib.php");
	 require_once("system/dispatcher.lib.php");
	 require_once("system/session.lib.php");
     */ 
	 //class libs
	 /*
	 require_once("system/parser.lib.php");
	 require_once("system/ktimer.lib.php"); //ktimer class
	 require_once("system/azdgcrypt.lib.php"); //AZDGcrypt class
	 require_once("system/client.lib.php");
	 */
	 require_once("system/system.lib.php"); 	 
	 
     if ((isset($argc)) && ($argv[1]=='-start')) { //server case 	
	   	 
       require_once("system/kernel.lib.php");

       $k = new kernel($argv[2],'0.0.0.0',19123);  //redirect to kernel script
     }
		
	 /*elseif ((isset($argc)) && ($argv[1]=='-cl')) { //cmd case	    
	 
       $initst = array('project'=>$argv[2]);//'panikidis'!!!!!!!!
       $prj = $initst['project']; //echo $prj;	 
       $config = @parse_ini_file("../config.ini",1); //print_r($config);
       $theme = @parse_ini_file("../maptheme.ini");
	   //make these vars globals
	   SetGlobal('initst',$initst);
	   SetGlobal('prj',array('project'=>$argv[2]));
	   SetGlobal('config',$config);
	   SetGlobal('theme',$theme);
		 
       if (iniload('SHELL')) { 

         require_once("shell/shell.lib.php"); 			 
	 
         if ((!is_array($initst)) || 
             (!is_array($config)) || 
             (!is_array($theme))) $this->_shutdown(2);	 
       }
	   else 
	     $this->_shutdown(1);	 
	 }
	 elseif (isset($path) && isset($proj)) {//psh.exe case    
	 
       //if (!is_array($initst)) 
	   $initst = array('project'=>$proj);
       $prj = $initst['project']; //echo $prj;	 
	   $config = @parse_ini_file($path.$proj."/config.ini",1); //print_r($config);
	   $theme = @parse_ini_file($path.$proj."/maptheme.ini");
	   //make these vars globals
	   SetGlobal('initst',$initst);
	   SetGlobal('prj',array('project'=>$argv[2]));
	   SetGlobal('config',$config);
	   SetGlobal('theme',$theme);	   
		 
       if (iniload('SHELL')) { 

         require_once("shell/shell.lib.php"); 			 
	 
         if ((!is_array($initst)) || 
             (!is_array($config)) || 
             (!is_array($theme))) $this->_shutdown(2);	 
       }
	   else 
	     $this->_shutdown(1);			 
	 }	
     else {	//web case		    
	 
       $initst = @parse_ini_file("action.conf");
       $prj = $initst['project']; //echo $prj;
	   //problem with ssl..directory
       $config = @parse_ini_file(_APPPATH_."/"._PRJPATH_."/$prj/config.ini",1); //print_r($config);
       $theme = @parse_ini_file(_APPPATH_."/"._PRJPATH_."/$prj/maptheme.ini");
	   //make these vars globals
	   SetGlobal('initst',$initst);
	   SetGlobal('prj',array('project'=>$argv[2]));
	   SetGlobal('config',$config);
	   SetGlobal('theme',$theme);	   
	   	  
       if (iniload('SHELL')) { 

         require_once("shell/shell.lib.php"); 	
	 
         if ((!is_array($initst)) || 
             (!is_array($config)) || 
             (!is_array($theme))) $this->_shutdown(2);	 
       }
	   else 
	     $this->_shutdown(1);				   	 
     }*/
   }
   /*
   private function _seterrorlevel() {
   
     if (paramload('DIRECTIVES','e_user_error'))   $exer[] = paramload('DIRECTIVES','e_user_error');
     if (paramload('DIRECTIVES','e_user_warning')) $exer[] = paramload('DIRECTIVES','e_user_warning');
     if (paramload('DIRECTIVES','e_user_notice'))  $exer[] = paramload('DIRECTIVES','e_user_notice');
     if (paramload('DIRECTIVES','e_warning'))      $exer[] = paramload('DIRECTIVES','e_warning');
     if (paramload('DIRECTIVES','e_error'))        $exer[] = paramload('DIRECTIVES','e_error');

     if (is_array($exer)) {
	   
	   $errorep = implode("|",$exer);
	   error_reporting ($errorep);    
	 }  
   }
   
   private function _startsession() {
   
	 $argc = $GLOBALS['argc'];
	 $argv = $GLOBALS['argv'];	 
   
     // CACHE CONTROL 
     //session.cache_limiter specifies cache control method to use for session pages (none/nocache/private/private_no_expire/public). 
     session_cache_limiter('nocache'); //private_no_expire//'nocache');
  
     //set path to save sessions
     session_save_path(paramload('SHELL','sespath'));
     //$sespath = session_save_path();
     //print "$sespath";
  
     if (isset($argc)) {//command line mode
  
       if ($argv[1]=='-help') { //help
	     die("\nusage: phpfile parameters\nParameters:\n-session [oprional] session_id\n-level [optional] 0,1,2,3,4,5,6,7,8,9\n-action[optional] -p1[optional] -p2[optional] \n-cl [optional] HTML, PALM, WAP,..");
	   }  	
	   else { //command line start 
	  
         $sesnameID = scanargs('-session');  
	     $levelID =  scanargs('-level');	
         if (isset($sesnameID)) session_id($sesnameID); 	  	  
	  
	     @session_start(); //echo "start1";
	  
	     if (isset($levelID)) SetSessionParam("UserSecID",encode($levelID));   	  	
	   }  
     } 
     else { //web mode
	 
       @session_start();  //echo "start2";
     }   
   }
   
   private function _shutdown($errno=null) {
   
     switch ($errno) {
	   case 1  : $m = "shell module required.\n";
	   case 2  : $m = "\nInvalid configuration!\n";
	   default : $m = "";
	 }
	 
	 die($m);
   }
   
   
   function __destruct() {
   
	 if (paramload('SHELL','debug')) 
	   echo "\nTime elapsed: ",$this->getthemicrotime() - $this->time, " seconds\n";   
   }
   */  
};   
?>