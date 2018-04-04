<?php
//required file 'phpdac7.php'
if (!array($env)) die('phpdac7 required');
$environment = (array) $env;//@parse_ini_file("phpdac7.ini");
$dpcpath = $environment['dpcpath'] ? $environment['dpcpath'] : 'dpc';
$pharApp = $environment['app']; //phar app

define('_APPNAME_', $environment['appname']);
define('_APPPATH_', $environment['apppath']);
define('_DPCTYPE_', $environment['dpctype']);
define('_PRJPATH_', $environment['prjpath']);
define('_DPCPATH_', $dpcpath);
define('_ISAPP_', $environment['app']); 
	
require_once("phpdac5://127.0.0.1:19123/system/system.lib.php");	
require_once("phpdac5://127.0.0.1:19123/system/parser.lib.php");
require_once("phpdac5://127.0.0.1:19123/system/ktimer.lib.php");
require_once("phpdac5://127.0.0.1:19123/system/azdgcrypt.lib.php"); 	    
//require_once("phpdac5://127.0.0.1:19123/system/cryptopost.lib.php");  //load at page use crypt.cryptopost 
require_once("phpdac5://127.0.0.1:19123/system/ccpp.lib.php");
require_once("phpdac5://127.0.0.1:19123/system/controllst.lib.php");

function _l($value=null) {
	return (localize($value, getlocal()));
}

function _r($r=null) {
	return $r ? GetGlobal('controller')->require_dpc($r) : null;
}

function _v($v=null,$val=null) {
	return $v ? GetGlobal('controller')->calldpc_var($v, $val) : null;
}

function _m($m=null, $noerr=null) {
	return $m ? GetGlobal('controller')->calldpc_method($m, $noerr) : null;
}

function _m2($m=null, $params=array()) {
	$mf = $m ? explode('.', $m) : null;
	return empty($mf) ? null : call_user_func_array(array($mf[0], $mf[1]), $params);
	//call_user_func_array(array(__NAMESPACE__ . "\\" . $mf[0], $mf[1]), $params); //5.3.0 namespace
}

define("PCNTL_DPC",true);
$__DPC['PCNTL_DPC'] = 'pcntl'; 

$__ACTIONS['PCNTL_DPC'][1]='index';
$__ACTIONS['PCNTL_DPC'][2]='default';

$__DPCSEC['_PCNTLADMIN']='9;1;1;1;1;1;1;9;9;9;9';

class pcntl extends controller {

	var $mytime, $myaction, $languange, $code, $myactive;
	var $file_name, $file_path, $file_extension;
	var $root_page, $debug, $name, $noqueue;
	var $fp, $lan, $cl, $local_security, $httpurl;
	var $preprocessor, $preprocess, $startProcess, $processStack;
	var $encrypted;	

	public function __construct($code=null,$preprocess=null,$noqueue=null) { 
		global $_cleanOB;
		
		$this->mytime = $this->getthemicrotime();    
		$xtime = $this->getthemicrotime(); 		
		
		controller::__construct();		

		$this->httpurl = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
		$this->httpurl.= $_SERVER['HTTP_HOST'];//(strstr($_SERVER['HTTP_HOST'], 'www')) ? $_SERVER['HTTP_HOST'] : 'www.' . $_SERVER['HTTP_HOST'];		
		
		$this->_loadinifiles(); 
		
		$this->root_page = 'index.php';//paramload('SHELL','filename');		
		$this->debug = false;// paramload('SHELL','debug');			
		//echo $this->root_page,'>',$this->debug;		
		$this->name = null;
	  
		//register this
		$__DPCMEM = GetGlobal('__DPCMEM');		    	 
		$__DPCMEM['PCNTL_DPC'] =  &$this; 
		SetGlobal('__DPCMEM',$__DPCMEM);
	  		  
		$this->file_path = pathinfo($_SERVER['PHP_SELF'],PATHINFO_DIRNAME); 
		//if ($this->file_path=="\\") 
			//$this->file_path = null;   
		$this->file_info = pathinfo($_SERVER['PHP_SELF'],PATHINFO_BASENAME);

		$p = explode (".",$this->file_info);		  
		$this->file_name = $p[0]; 
		$this->file_extension = $p[1];  
	  
		$lan = getlocal();
		$_lan = $lan ? $lan : 0;
		setlocal($_lan);		 
	        
		//CCPP preprocessor
		$this->preprocess = $preprocess;   	  
	 
	    //process vars
		$this->processStack = array();
	    $this->startProcess = array();
		
		$this->local_security = array();
		$this->code = $code;
		$this->noqueue = $noqueue;		
		$this->myaction = null;
		$this->encrypted = null;
		
		SetGlobal('controller',$this);			
		
		$this->init();	

		if (($this->shm) && ($_cleanOB))
			ob_clean (); //clean phpdac5 prompts before event (pre ajax die)			
				
		$this->event($this->myaction);
		
		if (($this->shm) && ($_cleanOB>1)) 
			ob_clean (); //clean phpdac5 prompts after event		
		
		if ($this->debug) 
			echo "<!-- construct elapsed " . $this->getthemicrotime() - $xtime . " sec -->"; 	   	  		
	}
	
	public function getName($localize=false) {
		
		if (strstr($this->file_name,'_')) {
			$p = explode('_',$this->file_name);
			$name = $p[1];
		}
		else  
			$name = $this->name ? $this->name : $this->file_name;		
		
		if ($localize)
			return (localize('_' . $name, getlocal()));
		
		return $name;
	}
/*	
parse_ini_string_m is analog for a parse_ini_string function.

had to code this function due to the lack of a php 5.3 on some hosting.

parse_ini_string_m:
- ignores commented lines that start with ";" or "#"
- ignores broken lines that do not have "="
- supports array values and array value keys
*/
    public function parse_ini_string_m($str) {
    
    if(empty($str)) return false;

    $lines = explode("\n", $str);
	//$lines = explode(PHP_EOL, $str);
    $ret = Array();
    $inside_section = false;

    foreach($lines as $line) {
        
        $line = trim($line);

        if(!$line || $line[0] == "#" || $line[0] == ";") continue;
        
        if($line[0] == "[" && $endIdx = strpos($line, "]")){
            $inside_section = substr($line, 1, $endIdx-1);
            continue;
        }

        if(!strpos($line, '=')) continue;

        $tmp = explode("=", $line, 2);

        if($inside_section) {
            
            $key = rtrim($tmp[0]);
            $value = ltrim($tmp[1]);

            if(preg_match("/^\".*\"$/", $value) || preg_match("/^'.*'$/", $value)) {
                $value = mb_substr($value, 1, mb_strlen($value) - 2);
            }

            $t = preg_match("^\[(.*?)\]^", $key, $matches);
            if(!empty($matches) && isset($matches[0])) {

                $arr_name = preg_replace('#\[(.*?)\]#is', '', $key);

                if(!isset($ret[$inside_section][$arr_name]) || !is_array($ret[$inside_section][$arr_name])) {
                    $ret[$inside_section][$arr_name] = array();
                }

                if(isset($matches[1]) && !empty($matches[1])) {
                    $ret[$inside_section][$arr_name][$matches[1]] = $value;
                } else {
                    $ret[$inside_section][$arr_name][] = $value;
                }

            } else {
                $ret[$inside_section][trim($tmp[0])] = $value;
            }            

        } else {
            
            $ret[trim($tmp[0])] = ltrim($tmp[1]);

        }
    }
    return $ret;
    }	
	
	protected function _loadinifiles() {

		if (is_readable("config.ini.php")) {//in root	  
			include("config.ini.php");
			$config = @parse_ini_string($conf, 1, INI_SCANNER_RAW);//NORMAL); 
			//$config = $this->parse_ini_string_m($conf);
			include("myconfig.txt.php");
			$myconfig = parse_ini_string($myconf, 1, INI_SCANNER_RAW);			
			//$myconfig = $this->parse_ini_string_m($myconf);
		}	
		elseif (is_readable("cp/config.ini.php")) {//in cp
			include("cp/config.ini.php");
			$config = @parse_ini_string($conf, 1, INI_SCANNER_RAW);//NORMAL);
			//$config = $this->parse_ini_string_m($conf);
			include("cp/myconfig.txt.php");	
			$myconfig = parse_ini_string($myconf, 1, INI_SCANNER_RAW);		
			//$myconfig = $this->parse_ini_string_m($myconf);		
		}		
		else
			die("Configuration error, config.ini not exist!");	
		/*
		echo '<pre>';
		print_r($config);
		echo '</pre>';		
		echo nl2br($conf);
		*/
		//extra conf
		if (!empty($myconfig))
			$config = array_merge($config, $myconfig); 			
		
		SetGlobal('config',$config);   
	  	  
		//$this->preprocessor = new CCPP($config);
	}  	
   
	//overwrite
	public function init($c=null) {      
   
		$t = new ktimer;
	  
		$t->start('compile',1);		  
		$modules = $this->compile(); 
		$t->stop('compile');
		if ($this->debug) 
			echo "<!-- compile " . $t->value('compile') . ' sec -->';  	  
	  
		//INCLUDE FIRST
		$t->start('include');	
		if (!empty($modules)) {   	  
		foreach  ($modules as $id=>$dpc) {
	  
			if ( (!defined($dpc)) && ($this->seclevel($dpc)) ) {
				define($dpc,true);
				$modules_to_start[] = $dpc;
				//echo $dpc,'<br/>';
			}   
		}
		}//empty
		$t->stop('include');
		if ($this->debug) 
			echo "<!-- include " . $t->value('include') . ' sec -->'; 	   	 
     

		if ($this->noqueue) {
			//...no action
		}
		else //dispacth or redirect...
			$this->myaction = $this->_getqueue(); 	
		
		if (is_array($modules_to_start)) {
			
			$t->start('new');			  
			foreach  ($modules_to_start as $id=>$dpc) { 
				$this->_new($dpc,'dpc');     
				//echo $dpc ,'<br/>';
			}	
			$t->stop('new');
			
			if ($this->debug) 
				echo "<!-- initialize (new) " . $t->value('new') . ' sec -->';	
	    }  	    	
    }
	
	private function processStack($dpc, $processes) {
	
		$this->processStack[$dpc] = $processes;
											
		foreach ($processes as $process)
			$this->startProcess[$dpc][] = $process;		
			
		return true;	
	}
	
	public function getProcessStack() {
		return (array) $this->processStack;
	}

    //overwrite..
    private function compile($code='', $preprocess=0) {   

        if ($this->preprocess==true) {
			
            $this->preprocessor = new CCPP(GetGlobal('config'));
			$code = $this->preprocessor->execute($this->code, 0, true);
			
			if ($file = explode(PHP_EOL,$code)) { 
				//clean php tags
				array_pop($file);//last line
				array_shift($file);//first line
			}			
	    }
	    else
			$file = explode(PHP_EOL,$this->code);
  
    
		//clean code by nulls and commends and hold it as array
		foreach ($file as $num=>$line) {
		    if ($trimedline = trim($line)) {
				if ((substr_compare($trimedline, '#',0,1)!=0) && 
				    (substr_compare($trimedline, '/',0,1)!=0)) {
						
					//echo $trimedline."<br>";
					//$lines[] = $trimedline;
					
					//one or more spaces between
                    //echo preg_replace('/\s\s+/', ' ', $trimedline) . '<br/>'; 
					$lines[] = preg_replace('/\s\s+/', ' ', $trimedline);
				} 
			}
		}
		//print_r($lines);
		//implode lines because one line may have more than one cmds sep by ;
		$toktext = implode("",$lines);
		//tokenize
		$token = explode(";",$toktext);
        SetGlobal("__COMPILE",serialize($token)); //save the global....			
	   
	    try {	
			//then...read tokens  			
			foreach ($token as $tid=>$tcmd) {
			  
			    $part = explode(' ',$tcmd); //one space anyway (preg before)
				//$part = preg_replace('/\s\s+/', ' ', $tcmd); //one or more spaces between
				$i = 0;
			    switch ($part[0]) {
			     case 'system'	: 	//include and load a set of system lib dpc
									$syslibs = explode(",",$part[1]);
									//print_r($syslibs);
									foreach ($syslibs as $lid=>$lib) {
										if (strstr($lib,'.')) 
											$this->calldpc($lib,'lib');//if . exist select from a spec dir
										else 
											$this->calldpc("system.$lib",'lib'); //else libs dir = default
									}		 
									break;			   
			   
			     case 'use'   	: 	//include and load a set of lib dpc
									$libs = explode(",",$part[1]);
									//print_r($libs);
									foreach ($libs as $lid=>$lib) {
										if (strstr($lib,'.')) 
											$this->calldpc($lib,'lib');//if . exist select from a spec dir
										else 
											$this->calldpc("libs.$lib",'lib'); //else libs dir = default
									}		 
									break;
				
				 case 'super' 	:	//include and load a set of dpc		
									$dpcs = explode(",",$part[1]);
									//print_r($dpcs);
									foreach ($dpcs as $did=>$dpc) {
										if (strstr($dpc,'.')) 
											$this->calldpc($dpc,'dpc');
								        else 
											$this->calldpc("$dpc.$dpc",'dpc');//same name for dir + class
									}		 
									break;		
								
				 case 'include' :	//include NOT load a set of dpc		
									$dpcs = explode(",",$part[1]);
									//print_r($dpcs);
									foreach ($dpcs as $did=>$dpc) {
										if (strstr($dpc,'.')) 
											$this->set_include($dpc,'dpc');
								        else 
											$this->set_include("$dpc.$dpc",'dpc');//same name for dir + class
									}		 
									break;	
								
				 case 'instance':	if ($m = $part[1]) {
										if (strstr($m,'->')) {
											$mp = explode('->',$m);
											$instanceDpc = array_shift($mp);
											if ($this->set_instance(trim($part[3]), $instanceDpc, implode(',',$mp))) {
												$idotDpc = (strstr($instanceDpc, '.')) ? $instanceDpc : 'instance.' . $instanceDpc;
												$dpcmods[] = $idotDpc;
												$this->processStack($idotDpc, $mp);			
											}
										}  
										else {
											if ($this->set_instance(trim($part[3]), trim($part[1]), null))
												$dpcmods[] = 'instance.' . $part[1];
										}
									}	
									break;
								 
			     case 'load_extension' : //include only NOT load a set of extensions dpc
									if (strstr(trim($part[1]),'.')) 
										$this->set_extension(trim($part[1]),trim($part[3]),1);
									else //. not exist				 
										$this->set_extension(trim($part[1]).".".trim($part[1]),trim($part[3]),1);
									break;	
								
				 case 'security':	$this->setlevel($part[1],$part[2],str_replace(':',';',$part[3]));
									break;									
								
				 case 'member'	: 	$dpcmods[] = $part[1];
									break;		
								
				 case 'dpccode' : 	$fpart = array_shift($part); //exclude cmd
									//echo implode(' ',$part);
				                    echo $this->execute_dpc_code(implode(' ',$part), false);	
									break;	
									
				 case 'phpcode' : 	$fpart = array_shift($part); //exclude cmd
									//echo implode(' ',$part);
				                    echo $this->execute_php_code(implode(' ',$part), false);	
									break;
									
			     case 'nvl'     :   $fpart = array_shift($part); //exclude cmd
									$part1 = array_shift($part); //1st dpc
									$part2 = array_shift($part); //2nd dpc
				                    if ($this->execute_php_code(implode(' ',$part), true)==true) { //remain code must return true
										echo $part1;
										//$this->set_include($part1,'dpc');	
										//$dpcmods[] = $part1; 
									}
									else {
										echo $part2;
										//$this->set_include($part2,'dpc');	
										//$dpcmods[] = $part2; 
									}
									break;
				 
				 case 'private' :	//loads dpc from private dir
									if ($m = $part[1]) {
										if (strstr($m,'->')) {
											$mp = explode('->',$m);
											$privateDpc = array_shift($mp);
											$this->set_include($privateDpc,'dpc',$part[2]);
											$dpcmods[] = $privateDpc;

											$this->processStack($privateDpc, $mp);			
										}  
										else {
											$this->set_include($part[1],'dpc',$part[2]);
											$dpcmods[] = $part[1];
										}	
									}	
									break; 		 
							  
				 case 'public'  : 	if ($m = $part[1]) {
										if (strstr($m,'->')) {
											$mp = explode('->',$m); 
											$publicDpc = array_shift($mp);
											$this->set_include($publicDpc,'dpc'); 
											$dpcmods[] = $publicDpc;
											
											$this->processStack($publicDpc, $mp);			
										}  
										else {
											$this->set_include($part[1],'dpc');	
											$dpcmods[] = $part[1]; 												 
										}	
									} 
									break;
								  
				 default        : 	if ($part[0]) { 
										if (substr($part[0], -1)==';') {
											eval('?><?php;'.$tcmd.'?><?php ');	
										}	
										else {
											eval('?><?php;'.$tcmd.'; ?><?php ');	
										}	
										//echo '<br/>EVAL:'.$tcmd.";";
									}
				                
			    }//switch
			    $i+=1; 
			}//foreach
	   
	    }
	    catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage() . PHP_EOL;
			throw $e;
		}
		//print_r($dpcmods);
	    return ($dpcmods); //return the array of included dpcs 
    }    
   
    public function execute_dpc_code($code, $verbose=false) {
		$ccode = str_replace(':',';',$code);
		
		if ($verbose)
			echo $ccode . '<br/>';
		
		$code_cmds = explode(';',$ccode);
		foreach ($code_cmds as $line=>$cmd) 
			$ret .= $this->calldpc_method($cmd,1);//1=no error			
	  
		return ($ret);
    }
   
    public function execute_php_code($code, $verbose=false) {
	    $ccode = str_replace(':',';',$code);
		
		if ($verbose)
			echo $ccode . '<br/>';
		
		$ret = eval($ccode);
		
		return ($ret);
    }   
	
	protected function _getqueue() {	

		$this->decryptPost();
		 
		if (array_key_exists('FormAction',$_POST)) {
			//if post has & query cut it from post
			$postq = explode('&',$_POST['FormAction']);
			$ret = $postq[0];// $_POST['FormAction'];
		}  
		elseif (array_key_exists('t',$_GET)) {
			$ret = $_GET['t'];
			
			/*
			if ($t = $_GET['t']) {
				$ret = $t; 
			}	
			else {//redirect to root controller-page	  
				$current_page = pathinfo($_SERVER['PHP_SELF']);
				//echo $current_page['dirname'],">>>>",$this->file_path;
				//if is not the root-page-controller
				if ($this->root_page != $current_page['basename']) {

					$page = str_replace($this->file_path."/".$current_page['basename'], '/' . $this->root_page,	$this->get_server_url());
					//echo $page;					  
					//extract '?t=' due to re-queue recursive error 					  
					$mypage = substr($page,0,strlen($current_page['basename'])+1);//echo $mypage; die();
					//unset($_GET['t']);			
					//echo $this->httpurl . $mypage;
					$this->redirect($this->httpurl . $mypage);				  
				}
				else 
					$ret = 'index';
			}*/	
		}  
		else {
			if (strstr($this->file_name,'_')) {
				//extract alias string sep by _
				//use:RewriteRule ^p/([^/]*)/$ /process_$1.php?t=process [L]
				$p = explode('_',$this->file_name);
				$ret = array_shift($p); //cmd is the first part
			}
			else //self name is the standart action 
				$ret = $this->file_name;	
		}	 	
		
		//save name
		$this->name = $ret;
		
		//echo $ret,'>';
		//if ($ret) {
		  
			//get the active dpc = this name default
			$this->myactive = $this->active($this->file_name);	  		  
			//if can't handled by standart=filename dpc 
			//print_r($this->get_dpcactions_array($this->myactive));
			if (!@in_array($ret,$this->get_dpcactions_array($this->myactive))) {
		      
				//check if ret can't handled also by ret dpc
				if (!@in_array($ret,$this->get_actions_array($ret))) {
					
					$this->myactive = $this->active($ret);//update myactive dpc			  
					$page = str_replace($this->file_name.".".$this->file_extension,
										$ret.".".$this->file_extension,
										$this->get_server_url());
					$this->redirect($this->httpurl . $page);
				}
			}	
			//echo $this->myactive,'>>>>';		  
        /*}
		else { //goto root page
			$page = str_replace($this->file_info,$this->root_page,$this->get_server_url());
			$this->redirect($this->httpurl . $page);		  
		}*/ 
		
		return ($ret); //final return ret
    }
   	
	//public alias: used by dpcs (like frontpage!)
	public function getqueue() {
   
        return ($this->myaction);
	}	
   	
   
    public function render($theme=null,$lan=null,$cl=null,$fp=null) {      
   
		$atime = $this->getthemicrotime();  
	  	  
		//$this->pre_render($theme,$lan,$cl,$fp);
		$data = $this->action($this->myaction);
	  
	    $hfp = new fronthtmlpage($fp, $theme);  
	    $ret = $hfp->render($data); //this->data);
	    unset($hfp);

		if ($this->debug) 
			echo "<!-- action elapsed " . $this->getthemicrotime() - $atime .  " sec -->";  	    
	  
		return ($ret); 	   
	}
   
	//set security level at runtime
	public function setlevel($modulename,$plafon,$colonvals) {
		$sec2 = GetGlobal('__DPCSEC2'); //alternative array
		$sec2[$modulename] = $plafon . ";" . $colonvals;
		
		SetGlobal('__DPCSEC2',$sec2);
	 
		$this->local_security[$modulename] = $plafon . ";" . $colonvals;
	}
   
	//get security level at runtime
	protected function seclevel($modulename) {
		$levelofsec = decode(GetSessionParam('UserSecID'));
   
		$sec = GetGlobal('__DPCSEC');
		$sec2 = GetGlobal('__DPCSEC2');	 
		if (isset($sec[$modulename])) { 
			$parts = explode(";",$sec[$modulename]);
	 
			if ($parts[$levelofsec+1] >= $parts[0])
				return 1;//allow
			else
				return 0;//deny
		}
	 
		return 1; //default allow
	} 	   
   
	public function locale($alias,$val) {
		$__DPCLOCALE = GetGlobal('__DPCLOCALE');
	  
		if (isset($__DPCLOCALE[$alias])) {
			//echo "Locale ($alias) already defined!";
			return false;
		}  
	  
		$__DPCLOCALE[$alias] = $val;
		SetGlobal('__DPCLOCALE',$__DPCLOCALE);
	  
		return true;
	}
   
	//batch as param in construction (overwritible)
	protected function localize($array) {
		
		if (is_array($array)) {
			$__DPCLOCALE = GetGlobal('__DPCLOCALE');
	  
			foreach ($array as $id=>$val)
				$__DPCLOCALE[$id] = $val;
		
			SetGlobal('__DPCLOCALE',$__DPCLOCALE);
		}		
	}
   
	protected function getthemicrotime() {
   
		list($usec,$sec) = explode(" ",microtime());
		return ((float)$usec + (float)$sec);
	}    
  
	protected function redirect($url) {
   
	}
	
	protected function get_server_url() {
        //ereg removed in php7, use preg_match
	    //if (!ereg("Microsoft", $_SERVER["SERVER_SOFTWARE"])) {//APACHE
		if (!preg_match("/Microsoft/i", $_SERVER["SERVER_SOFTWARE"])) {//APACHE
			$url = $_SERVER['REQUEST_URI'];//seems to be common with IIS ?????	   
	    }     
	    else //IIS
			$url = $_SERVER['URL'];
		 
	    return ($url);	 
    }
   
	//override to load dpc from priv dirs
	protected function set_include($dpc,$type,$myargdpc=null) {
		global $__DPC,$__DPCSEC,$__DPCMEM,$__ACTIONS,$__EVENTS,$__LOCALE,$__PARSECOM,
				$__BROWSECOM,$__BROWSEACT,$__PRIORITY,$__QUEUE,$__DPCATTR,$__DPCPROC;	  

		global $activeDPC,$info,$xerror,$GRX,$argdpc,$pharApp; 	 
	
		if (($this->shm) && (!$myargdpc)) {
			if ($pharApp)
				require_once("phar://$pharApp/". str_replace(".","/",trim($dpc)) . "." . $type . ".php");
			else
				require_once("phpdac5://127.0.0.1:19123/". str_replace(".","/",trim($dpc)) . "." . $type . ".php");
			//else	  
				//require_once("phpdac://" . str_replace(".","/",trim($dpc)) . "." . $type . ".php");		
		}
		else {
			//echo $dpc,"<br/>";
			$argdpc = _DPCPATH_;
			$_argdpc = $myargdpc ? paramload('SHELL','urlpath').$myargdpc : $argdpc;
			//echo $_argdpc,'<>';
			$includer = $_argdpc . "/" . str_replace(".","/",trim($dpc)) . "." . $type . ".php";

			require_once($includer);	
		}
		//update local table
		$parts = explode(".",trim($dpc)); 
		$class = strtoupper($parts[1]).'_DPC';	  
		$this->make_local_table($class);	  
	} 

	//override
	public function require_dpc($dpc, $cgipath=null) {
		$path = $cgipath ? $cgipath : _DPCPATH_; 
		global $pharApp;	
		
		if ($this->shm) {
			if ($pharApp)
				$ret = "phar://$pharApp/". $dpc;
			else
				$ret = "phpdac5://127.0.0.1:19123/". $dpc; //nopath
				//echo $dpc . ' :shared<br/>';	
			//else	  
				//$ret = "phpdac://". $dpc; //nopath
		}	
		else		
			$ret = $path . "/" . $dpc;
		
		return $ret;	
	} 
	
	//require via ctrl
	public function _require($dpc, $cgipath=null) {
		$path = $cgipath ? $cgipath : _DPCPATH_; 
		global $pharApp;	
		
		if ($this->shm) {
			if ($pharApp)
				require_once("phar://$pharApp/". $dpc);
			else
				require_once("phpdac5://127.0.0.1:19123/". $dpc); //nopath
				//echo $dpc . ' :shared<br/>';	
			//else	  
				//require_once("phpdac://". $dpc); //nopath
		}	
		else		
			require_once($path . "/" . $dpc);
	}	

	//override
    protected function event($event,$dpc_init=null) {  
		if (!$event) return null;
		$__DPCMEM = GetGlobal('__DPCMEM');
		$__DPC = GetGlobal('__DPC');		 
		$__EVENTS = GetGlobal('__EVENTS');		    
		$__DPCPROC = GetGlobal('__DPCPROC');	
		$__DPCID = GetGlobal('__DPCID');	
		
		if (empty($__EVENTS)) return null;
		reset($__EVENTS); //print_r($__EVENTS);		
	   
		//$i = 1;
		//$step = 0;
		//$EVENT_QUEUE = array(); //holds multiple commands	      
	     	 
		foreach ($__EVENTS as $dpc_name => $command) {
			//check if allowed
		    if ((class_exists($__DPC[$dpc_name])) &&
				(seclevel($dpc_name, decode(GetSessionParam('UserSecID'))))) {	
				//check if action included in current dpc	
				if ((is_array($command)) && (in_array($event,$command))) {  
					//echo $dpc_name,$event,"<br>"; 		   
					$__DPCMEM[$dpc_name]->event($event);

					if (method_exists($__DPCMEM[$dpc_name],'processEvent')) {
						try {
							$__DPCMEM[$dpc_name]->processEvent($event);
							//echo $dpc_name ." has  processEvent method<br/>";
						}	
						catch(Exception $e){
							echo 'Process Exception:' . $e->getMessage();
							throw $e;
						}
					}				
		        }
			}  
		}

		return 0;   
    }	
	
	//override
    protected function action($action) {  
		if (!$action) return null;
	    $__DPCMEM = GetGlobal('__DPCMEM');
	    $__DPC = GetGlobal('__DPC');		 
        $__DPCPROC = GetGlobal('__DPCPROC');		    
        $__ACTIONS = GetGlobal('__ACTIONS');	
        $__DPCID = GetGlobal('__DPCID');			   	   		   	

		if (empty($__ACTIONS)) return null;
		reset($__ACTIONS);
		$ret = null;
		
		foreach ($__ACTIONS as $dpc_name => $command) {		
			//check if allowed
			if ((class_exists($__DPC[$dpc_name])) &&
			    (seclevel($dpc_name,decode(GetSessionParam('UserSecID'))))) {
				//check if action included in current dpc
				if ((is_array($command)) && (in_array($action,$command))) { 
   		       		//echo $dpc_name,$action,"<br>"; 
					$ret .= $__DPCMEM[$dpc_name]->action($action);  	 	    
				}
			} 
	    }	 
			   
		return ($ret); 	   	      
    }		
	
	
	//override
	protected function _new($dpc,$type) {
		global $__DPC,$__DPCSEC,$__DPCMEM,$__ACTIONS,$__EVENTS,$__LOCALE,$__PARSECOM,
				$__BROWSECOM,$__BROWSEACT,$__PRIORITY,$__QUEUE,$__DPCATTR,$__DPCPROC;	  
		global $activeDPC,$info,$xerror,$GRX,$argdpc; //IMPORTANT GLOBALS!!!
		global $__DPCOBJ; 
		global $__DPCID; 
	  
		$__DPCMEM = GetGlobal('__DPCMEM');
		$__DPC = GetGlobal('__DPC');
	  
		//START THE OBJECT
		$parts = explode(".",trim($dpc)); 
		$class = strtoupper($parts[1]).'_DPC';
	  
		//update local table
		$this->make_local_table($class);
		
		//print_r($this->startProcess);
		//echo $dpc,'>',$class;
		if (defined($class)) {
			
			//echo '<br/>>>>',strtoupper($parts[1]),'_DPC','=',$__DPC[strtoupper($parts[1]).'_DPC'];
			//print_r($this->startProcess);
			
			$processChain = array();
			foreach ($this->startProcess as $inDpc=>$processArray) {
				if ($inDpc==$dpc) {
					foreach ($processArray as $process)
						$processChain[] = $process;	
				}	
			}	
			//print_r($processChain);
			if (!empty($processChain))
				$pchain = implode(',',$processChain);

			//echo '<br/>' . $dpc . ':' . $pchain;
			if (class_exists($__DPC[$class])) {
				$__DPCMEM[$class] =  new $__DPC[$class]($pchain);
				$__DPCOBJ[$dpc] =  & $__DPCMEM[$class];//alias of new name object array
				$__DPCID[$class] = $dpc; //new name index array		 
				SetGlobal("_DPCMEM",$__DPCMEM);
				return true;
			}
			elseif (is_string($__DPCMEM[$class])) {  //string class , instance
				//echo '<br/>>>>',strtoupper($parts[1]),'_DPC','=',$__DPC[strtoupper($parts[1]).'_DPC'];
				//echo $__DPCMEM[$class];
				@eval($__DPCMEM[$class]);
				
				$__DPCMEM[$class] =  new $__DPC[$class]($pchain);
				$__DPCOBJ[$dpc] =  & $__DPCMEM[$class];//alias of new name object array
				$__DPCID[$class] = $dpc; //new name index array		 
				SetGlobal("_DPCMEM",$__DPCMEM);
				return true;
			}
			else {}
		}	  
	
		return false; 	  		
	}	

	//override
	protected function set_instance($dpc,$instname,$p=null) {
		global $__DPC,$__DPCSEC,$__DPCMEM,$__ACTIONS,$__EVENTS,$__LOCALE,$__PARSECOM,
				$__BROWSECOM,$__BROWSEACT,$__PRIORITY,$__QUEUE,$__DPCATTR,$__DPCPROC;	  

		global $activeDPC,$info,$xerror,$GRX,$argdpc; 	
	  
		$__DPC = GetGlobal('__DPC');	  
	  
		$parts = explode(".",trim($dpc)); 
		$parentclass = strtoupper($parts[1]).'_DPC';	 
		$idpc =  $__DPC[$parentclass];	
	  
		//if parent class not exist load it!
		if (!class_exists($idpc)) {
			$this->calldpc($dpc,'dpc');
			//$__DPC = GetGlobal('__DPC');//re-loadit afer include	
			//$idpc =  $__DPC[$parentclass];	  
		}		
	  
		if (class_exists($idpc)) {
	        //create instance as string extending a defined class 
			$x  = "class $instname extends $idpc" . ' {';
			$x .= "function __construct(\$p=null) {";
			$x .= "parent::__construct(\$p);";  	
			$x .= '}';
			$x .= '};';
	  
			//echo $x;
			//@eval($x); //moved at _new
			
			$iclass = strtoupper($instname).'_DPC';
			define($iclass,true); //define instance
			
			$__DPCMEM[$iclass] = $x;
			$__DPCID[$iclass] = $instname;				
			$__DPC[$iclass] = $instname;
			
			//$i = new $instname($p); //moved at _new
	
			return true;
		}
		//else
			//die("Error: There is not [$dpc] class to extend!");    	  
		
		return false;
	}
	

	//cryptopost funcs (cryptopost js files required at page)
	protected function decryptPost() {
		
		// Check for FORM encrypted data
		if ((defined('CRYPTOPOST_DPC')) && (isset($_POST['cryptoPost'])))  {
				
			//echo getcwd() . '/openssl.cnf';	
			//$crypto = new Cryptopost(1024, getcwd() . '/openssl.cnf'); 
			//echo 'PCNTL***>>>';// . $_POST['cryptoPost'] . '>';
			
			$cryptedPost = $_POST;              // Save crypted data for debug
			//$formId = $crypto->decodeForm();    // Decrypt $_POST contents
			$formId = $this->calldpc_method('cryptopost.decodeForm');
			//echo $formId . '>';
			
			//$this->aesDebug($cryptedPost); //already decrypted use var
		    //print_r($_POST);
			// Encrypt processed data if you need to fill form again:
			//$encrypted = $crypto->encodeData($_POST, $formId);		
			$this->encrypted = $this->calldpc_method('cryptopost.encodeData use +'.$formId);
		}
		
		//return $_POST; //decrypted or as is / no need	
	}
	
	public function getEncrypted() {
		return $this->encrypted;
	}
	
	public function cryptOnSubmit($formname) {
		
		if (defined('CRYPTOPOST_DPC'))
			return 'onsubmit="return cryptoPost.encrypt(\''.$formname.'\')"';
		
		return null;
	}
	
	public function onSubmitJS($formname) {
		
		if (defined('CRYPTOPOST_DPC'))
			return 'cryptoPost.encrypt(\''.$formname.'\'); document.tForm.submit();';
		
		return 'document.getElementById(\''.$formname.'\').submit();';
	}	
	
	// Encrypt processed data if you need to fill form again:
	// Fill form input fields 
	public function postDecrypt($enc=null) {
		
		if (defined('CRYPTOPOST_DPC'))
			return "<script>cryptoPost.decrypt('$enc');</script>";
		
		return null;
	}	
	
	public function getmyRSAPublickey() {
		
		if (defined('CRYPTOPOST_DPC'))
			return $this->calldpc_method('cryptopost.getmyRSAPublickey');
		
		return null;
	}		
	
	protected function aesDebug($crPost=null) {
	    $cryptedPost = isset($crPost) ? $crPost : $_POST;
		if (!defined('CRYPTOPOST_DPC'))
			echo "Cryptopost not defined";
		else {		
            // Debug
            echo '<h2>Session keys:</h2>';
            if (isset($_SESSION['RSA_Public_key'])){
                echo 'RSA public key (hex) = '. $_SESSION['RSA_Public_key'];
                echo '<br /><br />';
            }
            if (isset($_SESSION['aesKey'])){
                echo 'AES key (hex) = '. bin2hex($_SESSION['aesKey']);
                echo '<br />';
            }
			
            if (isset($cryptedPost)){
                echo '<h2>Received POST data:</h2><pre>';
                var_dump($cryptedPost);
                echo '</pre><br />';
                echo '<h2>Decrypted POST data:</h2><pre>';
                var_dump($_POST);
                echo '</pre><br />';
            }
		}		
	}	
	
   
	public function __destruct() {		  
	  
		if ($this->debug) 
			echo "<!-- Time elapsed " . $this->getthemicrotime() - $this->mytime . " sec -->"; 
		controller::__destruct();   
	}
   
}
?>