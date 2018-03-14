<?php
if (!defined("CONTROLLER_DPC")) {
define("CONTROLLER_DPC",true);
		
class controller  {

    private $_actions;
	private $_events;
	private $_attr;
	private $_security;
    private $systemdb;
	
    public function __construct($code=null,$preprocess=null,$locales=null) {

		$this->_events  = array();	  	
		$this->_actions = array();
		$this->_attr    = array();
		$this->_security= array();		  
    }
   
    public function include_dpc($dpc) {

	    require_once(_DPCPATH_."/".$dpc);
    }
   
	public function require_dpc($dpc, $cgipath=null) {

		$ret = _DPCPATH_."/".$dpc;
		//echo '>',$ret,'<br>';	
		return $ret;	
	}   
   
	//read project file ...
	private function compile($accelerated=0) { 
	  
     if (iniload('ID')) {
	 
       $projectfile = paramload('ID','fpath').paramload('ID','name').".php";
	   //echo ">>>>>>>>>",$projectfile;
       $c = unserialize(GetGlobal("__COMPILE")); //get global	   
	   if (($accelerated) && (is_array($c))) {//accelerate reading...!!!!
	     $token = $c;
		 //echo 'Accelerated';
	   }
	   else {//not accelerated
	     //echo 'NOT accelerated';
	     //if (file_exists($projectfile)) { //accelerate.. no check
		   if ($file = file($projectfile)) {
			//clean code by nulls and commends and hold it as array
			foreach ($file as $num=>$line) {
			  $trimedline = trim($line);
		      if (($trimedline) && //check if empty line			  
			      ($trimedline[0]!="#")) {  //check commends        
			     //echo $trimedline."<br>";			    
				 $lines[] = $trimedline;
			  }
			}
			//print_r($lines);
			//implode lines because one line may have more than one cmds sep by ;
			$toktext = implode("",$lines);
			//echo $toktext;
			//tokenize
			$token = explode(";",$toktext);
			//print_r($token); //last token = empty
			//echo $token;
			SetGlobal("__COMPILE",serialize($token)); //save the global....
		   }	
	       else
		     raise_error(3,'EXIT');
	     /*}
	     else
	       raise_error(0,'EXIT',"File '$projectfile' not exist\n"); */
	   }//not accel	   
		   
	   //then...read tokens  			
	   foreach ($token as $tid=>$tcmd) {
			  
			   $part = explode(' ',$tcmd);
			   switch ($part[0]) {
			     case 'system': //include and load a set of system lib dpc
				                $syslibs = explode(",",$part[1]);
						        //print_r($syslibs);
								foreach ($syslibs as $lid=>$lib) {
								  if (strstr($lib,'.')) 
								    $this->calldpc($lib,'lib');//if . exist select from a spec dir
								  else 
								    $this->calldpc("system.$lib",'lib'); //else libs dir = default
								}		 
				                break;			   
			   
			     case 'use'   : //include and load a set of lib dpc
				                $libs = explode(",",$part[1]);
						        //print_r($libs);
								foreach ($libs as $lid=>$lib) {
								  if (strstr($lib,'.')) 
								    $this->calldpc($lib,'lib');//if . exist select from a spec dir
								  else 
								    $this->calldpc("libs.$lib",'lib'); //else libs dir = default
								}		 
				                break;
				
				 case 'super' :	//include and load a set of dpc		
				                $dpcs = explode(",",$part[1]);
						        //print_r($dpcs);
								foreach ($dpcs as $did=>$dpc) {
								  if (strstr($dpc,'.')) $this->calldpc($dpc,'dpc');
								                   else $this->calldpc("$dpc.$dpc",'dpc');//same name for dir + class
								}		 
				                break;		
								
				 case 'include' ://include NOT load a set of dpc		
				                $dpcs = explode(",",$part[1]);
						        //print_r($dpcs);
								foreach ($dpcs as $did=>$dpc) {
								  if (strstr($dpc,'.')) $this->set_include($dpc,'dpc');
								                   else $this->set_include("$dpc.$dpc",'dpc');//same name for dir + class
								}		 
				                break;											 	
							  
			     case 'load_extension' : //include only NOT load a set of extensions dpc
								if (strstr(trim($part[1]),'.')) 
								  $this->set_extension(trim($part[1]),trim($part[3]),1);
								else //. not exist				 
				                  $this->set_extension(trim($part[1]).".".trim($part[1]),trim($part[3]),1);
				                break;	
								
				 case 'instance':if (strstr(trim($part[3]),'.'))		
				                   $this->set_instance($part[3],$part[1],$part[5]);
                                 else //. not exist				 
				                   $this->set_instance(trim($part[3]).".".trim($part[3]),$part[1],$part[5]);								   
								 break;		
								 				  
				 case 'member': $dpcmods[] = $part[1];
				                break;			  
								
				 default      : //only include and save dpc modules to load th objects by shell			  
			  		            if ($part[0]) {
								  $this->set_include($part[0],'dpc');
								//  calldpc_include($part[0],'dpc');	
					              $dpcmods[] = $part[0]; //hold dpc names												 
								} 
				                
			   }//switch
			   $i+=1; 
	   }//foreach		
	   return ($dpcmods); //return the array of included dpcs 

	 }//if iniload
	 else
	   raise_error(1,'EXIT');   
	}
   
	//function calldpc_init() {
	public function init($code) { //$accelerated=0) {        
      $accelerated=0; //php strict standart
	  
      //ACCELERATE modules reading...
	  $t = new ktimer;
	  $t->start('compile');		  
      $modules = $this->compile($accelerated); //include and load project file's dpc lib,ext,dpc'  
	  $t->stop('compile');
	  echo "compile " , $t->value('compile');	  

	  //INCLUDE FIRST
	  $t->start('include');		  
	  foreach  ($modules as $id=>$dpc) {	  
	     //echo $dpc."<br>";
		 //$this->set_include($dpc,'dpc'); //MOVED TO SWITCH OF COMPILE 
	  }
	  $t->stop('include');
	  echo "include " , $t->value('include');	  	    	 	  		      
	
	  //NEW AFTER (one by one as it writed in script)	 
	  //print_r($modules);
	  foreach  ($modules as $id=>$dpc) {
		 if ($dpc!=$norenewdpc) {
		   //$this->_new($dpc,'dpc'); 
		   if (is_object($cdpc))  {
		   
		     if ($cdpc->is_client_dpc($dpc))
		       $this->_new($dpc,'dpc');   
		     else
		       die("$dpc not supported!");
		   }
		   else
		     $this->_new($dpc,'dpc'); 
		 }  
		 //echo '>',$id,'=',$dpc;    
	  }		   
	 	  
	}

	public function init_object($dpc,$type) {
      global $__DPC,$__DPCSEC,$__DPCMEM,$__ACTIONS,$__EVENTS,$__LOCALE,$__PARSECOM,
             $__BROWSECOM,$__BROWSEACT,$__PRIORITY,$__QUEUE,$__DPCATTR,$__DPCPROC;	

	  global $activeDPC,$info,$xerror,$GRX,$argdpc;  //IMPORTANT GLOBALS!!!
	  
	  global $__DPCOBJ; //holds objects of new approach of name of type xxx.yyy
	  global $__DPCID; //array of new name alias  	  	    	  	   

      $argdpc = _DPCPATH_;// paramload('DIRECTIVES','dpc_type');	  
	  //echo $argdpc,'>'; 
	  $includer = $argdpc . "/" . str_replace(".","/",trim($dpc)) . "." . $type . ".php";
	  //echo $includer,'|',$argdpc,'|',_DPCPATH_,'<br>';	
	  //try {
	  //if (is_file($includer)) {
	  require($includer);	//REQUIRE NOT REQUIRE ONCE DUE TO RE-INIT DPC
	  	  
	  //START THE OBJECT
      $parts = explode(".",trim($dpc)); 
	  $class = strtoupper($parts[1]).'_DPC';
	  
	  //update local table
      $this->make_local_table($class);	  
	  
	  if ((defined($class)) &&
	      (class_exists($__DPC[$class])) ) {
		//echo '>>>',strtoupper($parts[1]),'_DPC','=',$__DPC[strtoupper($parts[1]).'_DPC'];
	    //SetGlobal('__DPCMEM[$class]',& new GetGlobal('__DPC[$class]');
		$__DPCMEM[$class] =  new $__DPC[$class]; 
		$__DPCOBJ[$dpc] =  $__DPCMEM[$class];//alias of new name object array
		$__DPCID[$class] = $dpc; //new name index array
		return TRUE;
	  }	  
	  //}//is file
	  return FALSE;  
	  
	  /*}//try
	  catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
      } */	  
	}
		
	//alias of _new(parent).....init_object,,,......(mode:one by one)
	public function calldpc($dpcexpression,$type='dpc') {
		//echo $dpcexpression,"\n";
		return $this->init_object($dpcexpression,$type);
		//return $this->_new($dpcexpression,$type);	   
	}	
	
	
	//call a dpc method using params as use a+b+c
	public function calldpc_method($dpcmethodequalvars,$noerror=null) {
	  $__DPCMEM = GetGlobal('__DPCMEM');
	  $__DPC = GetGlobal('__DPC');
	  $__ACTIONS = GetGlobal('__ACTIONS');		  
	  
	  $part = explode(" use ",$dpcmethodequalvars); //echo $dpcmethodequalvars,">>>>";
	  $dpcmethod = explode(".",trim($part[0]));	//echo $dpcmethod[0],">>>>";
	  $method = trim($dpcmethod[1]);	
	  $class = strtoupper(trim($dpcmethod[0])).'_DPC';
	  $var = explode("+",trim($part[1]));    
	  
	  if ((defined($class)) &&
	      (is_object($__DPCMEM[$class])) &&
	      (method_exists($__DPCMEM[$class],$method))) {
	  
	    //echo strtoupper(trim($dpcmethod[0])).'_DPC'; 
		$ret = $__DPCMEM[$class]->$method($var[0],$var[1],$var[2],$var[3],$var[4],$var[5],$var[6],$var[7],$var[8],$var[9],$var[10],$var[11],$var[12],$var[13],$var[14],$var[15],
		                                  $var[16],$var[17],$var[18],$var[19],$var[20],$var[21],$var[22],$var[23],$var[24],$var[25],$var[26],$var[27],$var[28],$var[29],$var[30]);
		
		return ($ret);
	  }
	  else {
	    //TRY TO FIND CALLS THAT INHERIT FROM CALLED METHOD...
		//get method form inherited class (automated)
		if ($child_class = $this->find_child_method($method,$__DPCMEM)) {
		  $inherited_class = strtoupper(trim($child_class)).'_DPC';
		  //echo $inherited_class;
		  $ret = $__DPCMEM[$inherited_class]->$method($var[0],$var[1],$var[2],$var[3],$var[4],$var[5],$var[6],$var[7],$var[8],$var[9],$var[10],$var[11],$var[12],$var[13],$var[14],$var[15],
		                                              $var[16],$var[17],$var[18],$var[19],$var[20],$var[21],$var[22],$var[23],$var[24],$var[25],$var[26],$var[27],$var[28],$var[29],$var[30]);
		
		  return ($ret);		
		}
		  
	    if (!isset($noerror)) 
		  die("(".trim($dpcmethodequalvars).") is not a dpc object or method not exist !\n");
	  }	
	}	
			
	
	//call a dpc method using vars as array of pointers
	public function calldpc_method_use_pointers($dpcmethod,$par,$noerror=null) {
	  $__DPCMEM = GetGlobal('__DPCMEM');
	  $__DPC = GetGlobal('__DPC');		  
	  
	  $part = explode(".",trim($dpcmethod));
	  $class = strtoupper(trim($part[0])) . '_DPC';
	  $method = trim($part[1]);	 
	  
	  if ((defined($class)) &&
	      (is_object($__DPCMEM[$class])) &&
	      (method_exists($__DPCMEM[$class],$method))) {
	  
		$ret = $__DPCMEM[$class]->$method($par[0],$par[1],$par[2],$par[3],$par[4],$par[5],$par[6],$par[7],$par[8],$par[9],$par[10],$par[11],$par[12],$par[13],$par[14],$par[15],
		                                  $par[16],$par[17],$par[18],$par[19],$par[20],$par[21],$par[22],$par[23],$par[24],$par[25],$par[26],$par[27],$par[28],$par[29],$par[30]);		
		
		return ($ret);
	  }
	  else {
	  
	    //TRY TO FIND CALLS THAT INHERIT FROM CALLED METHOD...
		//get method form inherited class (automated)
		if ($child_class = $this->find_child_method($method,$__DPCMEM)) {
		  $inherited_class = strtoupper(trim($child_class)).'_DPC';
		  $ret = $__DPCMEM[$inherited_class]->$method($par[0],$par[1],$par[2],$par[3],$par[4],$par[5],$par[6],$par[7],$par[8],$par[9],$par[10],$par[11],$par[12],$par[13],$par[14],$par[15],
		                                              $par[16],$par[17],$par[18],$par[19],$par[20],$par[21],$par[22],$par[23],$par[24],$par[25],$par[26],$par[27],$par[28],$par[29],$par[30]);
		
		  return ($ret);		
		}
			  
	    if (!isset($noerror)) 
		  die("(".trim($dpcmethod).' use *'.implode(',',$par).") is not a dpc object or method not exist !\n");
	  }	
	}		
	
	//return a dpc var
	public function calldpc_var($dpcvar,$value=null) {
	  $__DPCMEM = GetGlobal('__DPCMEM');	  
	  
	  $part = explode(".",$dpcvar);
	  $classpart = strtoupper(trim($part[0])) . '_DPC';
	  $varpart = trim($part[1]);
	  
	  //if (defined(strtoupper(trim($part[0])).'_DPC')) {
	  if ((defined($classpart)) &&
	      (is_object($__DPCMEM[$classpart]))) {   
	  
	    //echo strtoupper($dpc).'_DPC';
		if ($value) {
		  
		  $__DPCMEM[$classpart]->$varpart = $value;
		  SetGlobal('__DPCMEM',$__DPCMEM);
		  return ($value); 
		}  
		else {
		
		  $ret = $__DPCMEM[$classpart]->$varpart;
		  return ($ret);
		}  
	  }	
	  else {
	  
	    //TRY TO FIND CALLS THAT INHERIT FROM CALLED METHOD...
		//get method form inherited class (automated)
		if ($child_class = $this->find_child_method($varpart,$__DPCMEM)) {
		  $inherited_class = strtoupper(trim($child_class)).'_DPC';
		  
		  if ($value) {
		    $__DPCMEM[$inherited_class]->$varpart = $value;
		    SetGlobal('__DPCMEM',$__DPCMEM);
		    return ($value); 		  		  
		  }
		  else {
		    $ret = $__DPCMEM[$inherited_class]->$varpart;
		    return ($ret);		
	      }		
		}	  
	  
	    die($part[0]." is not a dpc object !\n");	  	  
	  }	
	}
	
	//TRY TO FIND METHOD CALLS IN CODE like (inheritedclass.viewcart) THAT INHERIT FROM PARENTS CLASS (like parentclass.viewcart)
	//BUT STILL CALLED FROM RUNTIME CODE AS PARENTS COMMANDS...
	//THIS FUNCTION ON ERROR FIND THE INHERITED CLASS AUTOMATICALLY AND REPLACE CURRENT DPC COMMAND TO inheritedclass.viewcart
	protected function find_child_method($method,$dpcarray) {
	
	  foreach ($dpcarray as $class) {
	    if ((is_object($class)) && (method_exists($class,$method)))
		  return get_class($class);
	  }
	  
	  return null;
	}		
	
	//call a extension ext.php class file as is
    protected function set_extension($extension,$defname,$noerror=null) {
     //echo $extension,"\n";
	 if (!defined($defname)) {
	 
	   define($defname,'true');

       $argdpc = _DPCPATH_; //paramload('DIRECTIVES','dpc_type');
	   $includer = $argdpc . "/system/extensions/" . str_replace(".","/",trim($extension)) . ".ext.php";	
	   //echo $defname;           
	   //echo $includer; 		
	   require_once($includer);	  		   
	   
	   return TRUE;
	 }
	 else {
	   if (!$noerror) die("$extension defined more than once!");  
	   return FALSE;
	 }  
    }	
	
	//just include the spec dpc (mode:batch)
	protected function set_include($dpc,$type) {
      global $__DPC,$__DPCSEC,$__DPCMEM,$__ACTIONS,$__EVENTS,$__LOCALE,$__PARSECOM,
             $__BROWSECOM,$__BROWSEACT,$__PRIORITY,$__QUEUE,$__DPCATTR,$__DPCPROC;	  

	  global $activeDPC,$info,$xerror,$GRX,$argdpc; 	//IMPORTANT GLOBALS!!!  
	
	  //echo $dpc,"\n";
      $argdpc = _DPCPATH_; //paramload('DIRECTIVES','dpc_type');
	  	 
	  $includer = $argdpc . "/" . str_replace(".","/",trim($dpc)) . "." . $type . ".php";

	  require($includer);	//REQUIRE NOT REQUIRE ONCE DUE TO RE-INIT DPC	
	  
	  //update local table
      $parts = explode(".",trim($dpc)); 
	  $class = strtoupper($parts[1]).'_DPC';	  
      $this->make_local_table($class);	  
	}
	
	
	//create a subclass of the parent object to re-define constructor
	protected function set_instance($dpc,$instname,$params=null) {
	  	
      global $__DPC,$__DPCSEC,$__DPCMEM,$__ACTIONS,$__EVENTS,$__LOCALE,$__PARSECOM,
             $__BROWSECOM,$__BROWSEACT,$__PRIORITY,$__QUEUE,$__DPCATTR,$__DPCPROC;	  

	  global $activeDPC,$info,$xerror,$GRX,$argdpc; 	//IMPORTANT GLOBALS!!!  
	  
	  $__DPC = GetGlobal('__DPC');	  
	  
      $parts = explode(".",trim($dpc)); 
	  $parentclass = strtoupper($parts[1]).'_DPC';	//echo $parentclass;  
	  $idpc =  $__DPC[$parentclass];	
	  //print_r($__DPC);
	  
	  //if parent class not exist load it!
	  if (!class_exists($idpc)) {
	    //$this->set_include($dpc,'dpc');//NOT WORK BECAUSE OF ACTION 
		//echo $dpc;
		$this->calldpc($dpc,'dpc');
		$__DPC = GetGlobal('__DPC');//re-loadit afer include	
		$idpc =  $__DPC[$parentclass];	  
	  }		
	  
	  if (class_exists($idpc)) {
	
        $x  = "class $instname extends $idpc" . ' {';
	    $x .= 'function __construct() {';
	    $x .= $parts[1]."::__construct();";
	    //now we must pass the init params
		if (isset($params)) {
	      $params_array = explode(",",$params);
	      foreach ($params_array as $id=>$val) {
	        if (isset($val)) {   
	          $parts = explode('=',$val);
	          $x .= '$this->' . $parts[0] . " = '" . $parts[1] . "';";
		    }  
	      }
		}  	
	    $x .= '}';
        $x .= '};';
	  
	    //echo $x;
        @eval($x);	
	  
	    //$instname = new $instname;
        $this->_newinstance2($instname); 	
	  }
	  else
	    die("Error: There is not [$dpc] class to extend!");    	  
	}			
	
    //free dpc resources
    //function calldpc_free() {	
    protected function free() {	
	  $__DPCMEM = GetGlobal('__DPCMEM');
	  $__DPCATTR = GetGlobal('__DPCATTR');		    
	  $__DPC = GetGlobal('__DPC');	  
	  $__DPCOBJ = GetGlobal('__DPCOBJ');  	  
	  $__DPCID = GetGlobal('__DPCID'); 	  
   
      if (is_array($__DPC)) {
	  reset($__DPC);
	  //print_r($__DPC);
      while (list ($dpc,$classname) = each ($__DPC)) {
		  
	      if ((defined($dpc)) &&
	          (is_object($__DPCMEM[$dpc])) &&
	          (method_exists($__DPCMEM[$dpc],'free'))) {
			 	    
		    $__DPCMEM[$dpc]->free();	
          }				  
					  
		  $__DPCMEM[$dpc] = null; 
		  $__DPCATTR[$dpc] = null;
		  $__DPCOBJ[$dpc] =  null;//alias of new name object array	
		  $__DPCID[$dpc] = null;		  
		  //echo $dpc," unallocated\n";   		  		  	  
	      SetGlobal('__DPCMEM',$__DPCMEM);
	      SetGlobal('__DPCATTR',$__DPCATTR);	  		  
	      SetGlobal('__DPCOBJ',$__DPCOBJ);		  
		  SetGlobal('__DPCID',$__DPCID);		  	 	
	  } 
	  }
    } 	 

	//if dpc_init is set then dpc has priority and executed before new of others 
    protected function event($action,$dpc_init=null) {   
	   $__DPCMEM = GetGlobal('__DPCMEM');
	   $__DPC = GetGlobal('__DPC');		 
       $__EVENTS = GetGlobal('__EVENTS');		    
       $__DPCPROC = GetGlobal('__DPCPROC');	
       $__DPCID = GetGlobal('__DPCID');		   
	   
	   $i = 1;
	   $step = 0;
	   $EVENT_QUEUE = array(); //holds multiple commands	      
	   
       //select common events ordered by priority	   
       if ($action) {
	     if ($dpc_int) { //has init priority
		 
		   if ( (seclevel($dpc_init,decode(GetSessionParam('UserSecID')))) && //check if allowed
		        (in_array($action,$__EVENTS[$dpc_init])) &&  //check if action included in current dpc
		        (class_exists($__DPC[$dpc_init]))  ) {//check if dpc has initialized

				$__DPCMEM[$dpc_init]->event($action);
		   }
		 }
		 else {
		   if (!empty($__EVENTS)) {   	 
	       reset($__EVENTS); //print_r($__EVENTS);
           foreach ($__EVENTS as $dpc_name => $command) {
		   
		     if (seclevel($dpc_name,decode(GetSessionParam('UserSecID')))) {//check if allowed		   		            
		   
			   if ((is_array($command)) && (in_array($action,$command))) {  //check if action included in current dpc
			     //print $val;				
				 
	             if (class_exists($__DPC[$dpc_name])) {  //check if dpc has initialized 		     
				 
				   $p = $__DPCPROC[$dpc_name];
                   $q = (($p ?  $p : $i++)) * 1000; //priority 1000 = start
				   if (array_key_exists($q,$EVENT_QUEUE)) {
					 $step+=1;
					 $EVENT_QUEUE[$q+$step] = $dpc_name;				   
				   }  
				   else				   
				     $EVENT_QUEUE[$q] = $dpc_name;			   	 			  
				 } 		 	 
		       }
			 }  
	       }
		   }//if __EVENTS
		   //break =  end of multiple events or end of loop
		   
		   //start event queue
		   reset($EVENT_QUEUE); 
		   //execute by priority	
		   ksort($EVENT_QUEUE);	//print_r($EVENT_QUEUE);   
		   foreach ($EVENT_QUEUE as $priority=>$dpc_name) { 
			 //echo $dpc_name,$action,"<br>"; 		   
		     $__DPCMEM[$dpc_name]->event($action); 
		   }	
		}	 
		return 0;   
	  }
    }
 	  
    protected function action($action) {  
	       $__DPCMEM = GetGlobal('__DPCMEM');
	       $__DPC = GetGlobal('__DPC');		 
           $__DPCPROC = GetGlobal('__DPCPROC');		    
           $__ACTIONS = GetGlobal('__ACTIONS');	
           $__DPCID = GetGlobal('__DPCID');			   	   		   	

		   $ret = null;
		   $i = 1;
		   $step = 0;
	       $ACTION_QUEUE = array(); //holds multiple commands			      		    

		   //select common action ordered by priority
		   if ($action) {
	         reset($__ACTIONS); //print_r($__ACTIONS);
             foreach ($__ACTIONS as $dpc_name => $command) {		
			 	 		   
			   if (seclevel($dpc_name,decode(GetSessionParam('UserSecID')))) {//check if allowed

				 if ((is_array($command)) && (in_array($action,$command))) { //check if action included in current dpc
   		       							   
		           if (class_exists($__DPC[$dpc_name])) { //check if dpc has initialized

					 $p = $__DPCPROC[$dpc_name];
                     $q = (($p ?  $p : $i++)) * 1000; //priority 1000=start
					 
					 if (array_key_exists($q,$ACTION_QUEUE)) {
					   $step+=1;
					   $ACTION_QUEUE[$q+$step] = $dpc_name;				   
					 }  
					 else  
				       $ACTION_QUEUE[$q] = $dpc_name;				   
				   }	 	    
		         }
			   } 
	         }
			 
		     //break =  end of multiple actions or end of loop
			 
			 //start action queue
		     reset($ACTION_QUEUE); 
			 //execute by priority
			 ksort($ACTION_QUEUE); //print_r($ACTION_QUEUE);
		     foreach ($ACTION_QUEUE as $priority=>$dpc_name) { 
			   //echo $dpc_name,$action,"<br>"; 
		       $ret .= $__DPCMEM[$dpc_name]->action($action);	
			   
			 }  	 
			   
			 return ($ret); 
		   }
		   
		   return null;		   	      
    }	

	//find dpc name based on current action
	//function calldpc_active($action) {  	
	public function active($action) {   

	   $__DPCMEM = GetGlobal('__DPCMEM');
	   $__DPC = GetGlobal('__DPC');		 
       $__EVENTS = GetGlobal('__EVENTS');		    
       $__ACTIONS = GetGlobal('__ACTIONS');		    	          
	   
       if ($action) {
		 if (!empty($__EVENTS)) {   
			reset($__EVENTS);
			foreach ($__EVENTS as $dpc_name=>$commarray ) {
				if ((is_array($commarray)) && (in_array($action,$commarray))) {
					//print_r($commarray);
					//echo $dpc_name;
					return ($dpc_name); 
				}	 
			}
		 }
		 if (!empty($__ACTIONS)) {   	
			reset($__ACTIONS);
			foreach ($__ACTIONS as $dpc_name=>$commarray ) {
				if ((is_array($commarray)) && (in_array($action,$commarray))) {
					//print_r($commarray);
					//echo $dpc_name;		 
					return ($dpc_name); 
				}	 
			}
         }			
       }
	   
	   return (false);
    }
	//return actions array based on dpc name
	protected function get_dpcactions_array($dpc) {
	
	  $dpcactions = GetGlobal('__ACTIONS');
	  if (!empty($dpcactions[$dpc]))
	    return ($dpcactions[$dpc]);
	  else
	    return ($x=array());	
	}
	//return actions array based on action name
	protected function get_actions_array($action) {
	
	  $dpc = $this->active($action); 
	  $dpcactions = GetGlobal('__ACTIONS');
	  return ($dpcactions[$dpc]);
	}	
	
	//create a new dpc object instance based on a dpc as is
	protected function _newinstance($instname,$dpc,$type) {
      global $__DPC,$__DPCSEC,$__DPCMEM,$__ACTIONS,$__EVENTS,$__LOCALE,$__PARSECOM,
             $__BROWSECOM,$__BROWSEACT,$__PRIORITY,$__QUEUE,$__DPCATTR,$__DPCPROC;	  

	  global $activeDPC,$info,$xerror,$GRX,$argdpc; //IMPORTANT GLOBALS!!!
	  
	  global $__DPCOBJ; //holds objects of new approach of name of type xxx.yyy
	  global $__DPCID; //array of new name alias	  
	  
	  $__DPCMEM = GetGlobal('__DPCMEM');
	  $__DPC = GetGlobal('__DPC');
	  
	  //START THE OBJECT
      $parts = explode(".",trim($dpc)); 
	  $class = strtoupper($parts[1]).'_DPC';
	  
	  $idpc = $parts[0].".".$instname;
	  $iclass = strtoupper($instname).'_DPC';
	  
	  //update local table
      //$this->make_local_table($class);		  
	  
	  if ((defined($class)) &&
	      (is_object($__DPCMEM[$class])) ) {
		  
		//echo '>>>',strtoupper($parts[1]),'_DPC','=',$__DPC[strtoupper($parts[1]).'_DPC'];
		//echo " ",$iclass,">>>",$idpc;
	    if ((!defined($iclass)) &&
	        (!isset($__DPCMEM[$iclass])) ) {		
		  
		  define($iclass,true); //define instance
		
	      $__DPCMEM[$iclass] =  & new $__DPC[$class];
		  $__DPCOBJ[$idpc] =  & $__DPCMEM[$iclass];//alias of new name object array
		  $__DPCID[$iclass] = $idpc; //new name index array		 
		
		  SetGlobal("_DPCMEM",$__DPCMEM);
		
		  return TRUE;
		}
		else
		  die("Instance error! Name conflicts,");  
	  }	  
	
	  return FALSE; 	  		
	}	
	
	//create a new dpc object instance based on a subclass of a dpc where construct diferrent	
	protected function _newinstance2($instname) {
      global $__DPC,$__DPCSEC,$__DPCMEM,$__ACTIONS,$__EVENTS,$__LOCALE,$__PARSECOM,
             $__BROWSECOM,$__BROWSEACT,$__PRIORITY,$__QUEUE,$__DPCATTR,$__DPCPROC;	  

	  global $activeDPC,$info,$xerror,$GRX,$argdpc; //IMPORTANT GLOBALS!!!
	  
	  global $__DPCOBJ; //holds objects of new approach of name of type xxx.yyy
	  global $__DPCID; //array of new name alias		
	
	  $idpc = $instname; //$parts[0].".".$instname;
	  $iclass = strtoupper($instname).'_DPC';	
	
	  if ((!defined($iclass)) &&
	      (!isset($__DPCMEM[$iclass])) ) {		
		  
		  define($iclass,true); //define instance
		
	      $__DPCMEM[$iclass] =  & new $instname;
		  $__DPCOBJ[$idpc] =  & $__DPCMEM[$iclass];//alias of new name object array
		  $__DPCID[$iclass] = $idpc; //new name index array		 
		
		  SetGlobal("_DPCMEM",$__DPCMEM);
		  //echo "OK";
		  return TRUE;
	  }
      else
		  die("Instance error! Name conflicts,"); 	 	
	}	
   	
	//transfer events,action,attributes,locales from parent to child
	//it used when a dpc inherit from other dpc and
	//parent dpc just included where child dpc loaded by script 
	public function get_parent($parent,$child) {
	  
	  $GLOBALS["__EVENTS"][$child] = $GLOBALS["__EVENTS"][$parent];
	  $GLOBALS["__EVENTS"][$parent] = array();
	  $GLOBALS["__ACTIONS"][$child] = $GLOBALS["__ACTIONS"][$parent];
	  $GLOBALS["__ACTIONS"][$parent] = array();
	  $GLOBALS["__DPCATTR"][$child] = $GLOBALS["__DPCATTR"][$parent];
	  $GLOBALS["__DPCATTR"][$parent] = array();	  
	  
	  //compatibility for script parser commands
	  $GLOBALS["__PARSECOM"][$child] = $GLOBALS["__PARSECOM"][$parent];
	  $GLOBALS["__PARSECOM"][$parent] = array();	  
	    
	  
	  //PARENT LOCALES TO MEMORY	  
	  $this->make_local_table($parent);
	}	
	
    //special fun to make all entries in locales root enabled
    protected function make_local_table($dpc=null,$debug=null) {
        $loc = GetGlobal('__LOCALE');
        $lr = GetGlobal('__DPCLOCALE');
   
	    //echo $dpc,">>><br>";
	    if (is_array($loc[$dpc])) {
		
	        foreach ($loc[$dpc] as $id=>$explain) {
	         $parts = explode(";",$explain);
		     $lr[$parts[0]] = $parts[1].";".$parts[2].";".$parts[3];
	        }		 
			
			if ($debug) {
	          echo $dpc,'<br>';
		      print_r($lr);
		      echo '<br>';
			}			
	    }
	 
	    SetGlobal('__DPCLOCALE',$lr);
    }	
	
	//create a new dpc object (mode:batch)
	protected function _new($dpc,$type) {
      global $__DPC,$__DPCSEC,$__DPCMEM,$__ACTIONS,$__EVENTS,$__LOCALE,$__PARSECOM,
             $__BROWSECOM,$__BROWSEACT,$__PRIORITY,$__QUEUE,$__DPCATTR,$__DPCPROC;	  

	  global $activeDPC,$info,$xerror,$GRX,$argdpc; //IMPORTANT GLOBALS!!!
	  
	  global $__DPCOBJ; //holds objects of new approach of name of type xxx.yyy
	  global $__DPCID; //array of new name alias	  
	  
	  $__DPCMEM = GetGlobal('__DPCMEM');
	  $__DPC = GetGlobal('__DPC');
	  
	  //START THE OBJECT
      $parts = explode(".",trim($dpc)); 
	  $class = strtoupper($parts[1]).'_DPC';
	  
	  //update local table
      $this->make_local_table($class);		  
	  
	  if ((defined($class)) &&
	      (class_exists($__DPC[$class])) ) {
		//echo '>>>',strtoupper($parts[1]),'_DPC','=',$__DPC[strtoupper($parts[1]).'_DPC'];
	    $__DPCMEM[$class] =  & new $__DPC[$class];
		$__DPCOBJ[$dpc] =  & $__DPCMEM[$class];//alias of new name object array
		$__DPCID[$class] = $dpc; //new name index array		 
		
		SetGlobal("_DPCMEM",$__DPCMEM);
		
		return TRUE;
	  }	  
	
	  return FALSE; 	  		
	}		
	
	function __destruct() {
		
		//$this->free();
	}
};
}
?>