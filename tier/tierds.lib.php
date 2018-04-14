<?php
	error_reporting(E_ALL & ~E_NOTICE);

	define ("GLEVEL", 1); 
	define ("KERNELVERBOSE", 2);//override daemon VERBOSE_LEVEL
	
	define('_DACSTREAMCVIEW_', 3); //must be 3 for clean replies
	define('_DACSTREAMCREP1_', '');
	define('_DACSTREAMCREP2_', '');
	define('_DACSTREAMCREP3_', '');
	define('_DACSTREAMCREP0_', '');

	require_once("tier/dmnt.lib.php");	
	require_once("tier/memt.lib.php");

	function _say($str, $level=0, $crln=true) 
	{
	    global $glevel;
	    $cr = $crln ? PHP_EOL : null;
		if ($level<=$glevel)
			echo ucfirst($str) . $cr;
		
		_dump(date ("Y-m-d H:i:s :").$str.PHP_EOL,'a+');
	}
   
	function _dump($data=null,$mode=null,$filename=null) 
	{
	   $m = $mode ? $mode : 'w';
	   $f = $filename ? $filename : '/dumpagn-'.$_SERVER['COMPUTERNAME'].'.log';

        if ($fp = @fopen (getcwd() . $f , $m)) {
            fwrite ($fp, $data);
            fclose ($fp);
            return true;
        }
        return false;
	}   
   
class tierds {

	private $mem, $argbatch; 
	public $dmn, $env, $agent, $active_agent, $active_o_agent; 
	public $daemon_ip, $daemon_port, $daemon_type;	
  
	public $resources, $timer, $scheduler;
	public $gtk, $gtkds_conn, $window, $agentbox;  
	public $ldscheme, $echoLevel, $verboseLevel;//, $promptString;
	
	public static $ldschemeS;  	
	public static $pdo;

	public function __construct() { 
		global $dh, $dp;
		$argc = $GLOBALS['argc'];
		$argv = $GLOBALS['argv'];
		//print_r($argv);
		
		self::$pdo = null;
		$this->verboseLevel = GLEVEL;	  
		$this->agent = 'SH';//default		

		//argv1 is daemon type -param or batchfile .ash
		$this->argbatch = (substr($argv[1],0,1)!='-') ? $argv[1].'.ash' : '';
		
		$this->daemon_type = (substr($argv[1],0,1)=='-') ? substr($argv[1],1) : ''; 
		$this->daemon_ip = $argv[2] ? $argv[2] : '127.0.0.1';//$ip;//'192.168.4.203';
		$this->daemon_port = $argv[3] ? $argv[3] : '19125';//$port;//19123;
		_say("Phpagn5 client at $this->daemon_ip:$this->daemon_port");	  
	  
		//dac server	
		$this->phpdac_ip = $argv[5] ? $argv[5] : '127.0.0.1';//$dacip;
		$this->phpdac_port = $argv[6] ? $argv[6] : '19123';//$dacport; 
		_say("Phpdac5 server at $this->phpdac_ip:$this->phpdac_port"); 
	    
		//REGISTER PHPDAC 7
		$dh = $this->phpdac_ip;  //global inside dacstreamc7 for gc
		$dp = $this->phpdac_port;//global inside dacstreamc7 for gc
		require_once("system/dacstreamc7.lib.php");			
		//require_once($this->ldscheme . "/system/dacstreamc.lib.php"); //not yet
		$phpdac_c = stream_wrapper_register("phpdac5","c_dacstream");
		if (!$phpdac_c) 
		{
			_say("Client dac protocol failed to registered!");
			die();
		}	  
		else 
			_say("Client dac protocol registered!");
	  
		$this->ldscheme = "phpdac5://{$this->phpdac_ip}:{$this->phpdac_port}";
		self::$ldschemeS = "phpdac5://". ($argv[5] ? $argv[5] : '127.0.0.1') .":". ($argv[6] ? $argv[6] : '19123');	
				
		//REGISTER PHPAGN (client side,interconnections) protocol.			
		require_once($this->ldscheme . "/agents/agnstreamc.lib.php"); 
		$phpdac_c = stream_wrapper_register("phpagn5","c_agnstream");
		if (!$phpdac_c) 
		{
			_say("Client agent protocol failed to registered!");
			die();
		}	  
		else 
			_say("Client agent protocol registered!"); 	

		//REGISTER PHPRES (client side,resources) protocol.		
		require_once($this->ldscheme . "/agents/resstream.lib.php"); 
		$phpdac_c = stream_wrapper_register("phpres5","c_resstream");
		if (!$phpdac_c) 
		{
			_say("Client resource protocol failed to registered!");
			die();
		}	  
		else 
			_say("Client resource protocol registered!"); 
				 				 

		$this->mem = new memt($this);
		if ($this->mem->initialize())			
		{		  
			//clear log
			@unlink('dumpagn-'.$_SERVER['COMPUTERNAME'].'.log');
		  
			$this->env['name'] = $_SERVER['COMPUTERNAME'];  			 
			$this->env['os'] = $_SERVER['OS'];	  
			$this->env['domain'] = $_SERVER['USERDNSDOMAIN'];				 
			$this->env['appdata'] = $_SERVER['APPDATA'];	  
			$this->env['homepath'] = $_SERVER['HOMEPATH'];	  	
			$this->env['host'] = $_SERVER['REMOTE_ADDR'];  
			//var_dump($this->env);	
			//var_dump($_SERVER);

			/*$this->promptString = 'phpagn5>';	
			$this->echoLevel = 1;     	*/  
	  
			//INITIALIZE AGENTS
			$this->active_agent = null;
			$this->active_o_agent = null;	
	  
			$this->init_agents($this->phpdac_ip,$this->phpdac_port);
	  
			/* LOADED AS AGENTS...removed from agents.exe as libs include
			$this->timer = new timer;	
			//register_tick_function(array(&$time,"showtime"),true);	
			$this->scheduler = new scheduler(&$this);		  			
	        
			//init resources (loaded as lib agent)
			$this->resources = new resources($this);	  
			*/		  
			
			//init printer	 
			$this->initPrinter();
		    //init db
		    $this->initPDO();	//serialize err 1250 (see inside process)		
						  
			//(starting at scheduler construction)
			//register_tick_function(array($this->get_agent('scheduler'),"checkschedules"),true);	  
			//print_r($this->get_agent('scheduler'));
	  
			//initialize task from already loaded agents (BEWARE TO LOAD THE DEFAULT AGENTS)
			$this->get_agent('scheduler')->schedule('env.show_connections','every','20'); 
  
			//initialize GTk connector (for calling proc from this ($env) class ...purposes)
			$this->gtk = ($argv[4]==='-gtk') ? true : false;
	  
			if ($this->gtk) 
			{
				require_once($this->ldscheme . "/agents/gtklib.lib.php");  		
				_say("GTK connector loaded!");	  
				$this->gtkds_conn = new gtkds_connector();
		
				//////////////////////////////////// gtk win
				require_once($this->ldscheme . "/agents/gtkds.lib.php");
				//new gtkds($this,0);//connector init is off ..bellow loaded!		
			}
	  
			//require_once($this->ldscheme . "/system/daemon.lib.php");
			//$this->startdaemon();  
			//init daemon
			if ($this->dmn = new dmnt($this, /*daemonize this*/
								 $this->daemon_type,
								 $this->daemon_ip,
								 $this->daemon_port))
			{
				//$this->dmn->RegisterAction(array(&$this,'timer'));
	   
				//dispatch batch
				$this->exebatchfile($this->argbatch, true);
				//listen
				$this->dmn->listen(1); 				
			}	
		}
		else 
		{
		  _say('Memory critical error!');
		  $this->shutdown(true);
		}	  
	}

	//dmn Println
	public function _echo($msg) 
	{
		$this->dmn->Println($msg);
	}
	
	//reead file of agents to initialize
	private function init_agents($ip,$port) 
	{   
	   $this->mem->open();    
	   
       _say('Init agents file: ' . getcwd() . "/tierds.ini",1); 
       if (!is_file(getcwd() ."/tierds.ini")) 
		   return -1;   
		  
       $code = @file_get_contents(getcwd() . "/tierds.ini");
	   
	   if ($file = explode("\n",$code)) 
	   {
			//clean code by nulls and commends
			foreach ($file as $num=>$line) {
			  $trimedline = trim($line);
		      if (($trimedline) &&       //empty line			  
			      ($trimedline[0]!="#")) //comment  
			  {        
				 $lines[] = $trimedline;
			  }
			}
			//print_r($lines);
			//one line may have more than one cmds sep by ;
			$toktext = implode("",$lines);
			//tokenize
			$token = explode(";",$toktext);		

	        //then...read tokens  			
	        foreach ($token as $tid=>$tcmd) 
			{  
			   $part = explode(' ',$tcmd);
			   switch ($part[0]) {	
			   
			     case 'system':	//run system cmds
				                $name = explode(".",trim($part[0]));
				                break;				  
								
			     case 'schedule'://run scheduled cmds
				                $this->get_agent('scheduler')->schedule($part[1],$part[2],$part[3]); 
				                break;
								
				 case 'library' : if ($part[1]) 
				                {
								  $name = explode(".",trim($part[1]));
								  $this->create_agent($name[1],$name[0],null,null,'lib',false);
								} 
				                break; 

				 case 'include' : if ($part[1]) 
								{
								  $name = explode(".",trim($part[1]));
								  $this->create_agent($name[1],$name[0],null,null,'lib',true);
								} 
				                break;								
							  
				 default      : //create agents  
			  		            if ($part[0]) 
								{
								  //$includer = "phpdac5://$ip:$port/" . str_replace(".","/",trim($part[0])) . "." . 'dpc' . ".php";
								  //$this->load_agent($includer,$part[0]);
								  
								  $name = explode(".",trim($part[0]));
								  $this->create_agent($name[1],$name[0]);//$part[1]);-RESIDENT disbaled
								} 
				                
			   }
			   $i+=1;
	        }	 
	   }
	   
	   return true;
	}  
   
	public function create_agent($agent,$domain=null,$include_ip=null,$as_name=null,$type='dpc',$includeonly=false) 
	{
		global $__DPC;  
		$dpc = $domain ? $domain : 'agents';
		$class = strtoupper($agent).'_DPC';	  
		//echo $class;
	  
		if (defined($class)) 
		{
			_say($agent . " exists!");
			return true;
		}	  
	  
		if (isset($include_ip))
			require("phpdac5://$include_ip:$this->phpdac_port" . "/$dpc/$agent" . '.'.$type.'.php');    
		else 
			require($this->ldscheme . "/$dpc/$agent" . '.'.$type.'.php');    
	  
		if (($type=='lib') && ($includeonly)) 
		{
			_say('include library: '.$agent);
			return true;
		}	  
	  
		$class = strtoupper($agent).'_DPC';	 
		//echo $class;
		if ((defined($class)) && (class_exists($__DPC[$class])) ) 
		{
			try 
			{
				$o_agent = new $__DPC[$class]($this);
		  		  
				if (is_object($o_agent)) 
				{ 
					$s_agent = serialize($o_agent); 
			
					if (isset($as_name)) 
					{
						$this->mem->add($as_name,$s_agent);
						_say("Create agent:$agent as $as_name");//,0,false);//\n";			
					}
					else {
						$this->mem->add($agent,$s_agent);
						_say("Create agent:$agent");//,0,false);//,"\n";
					}  
 
					//var_dump($this->agn_addr);
					//var_dump($this->agn_length);	  
					//echo "\n",substr($this->agn_mem_store,0,256),"\n",strlen($this->agn_mem_store),"\n";				
					//echo "NEW AGENT(".strlen($s_agent)."):" . get_class($o_agent) . '(' . memory_get_usage() .")\n";		
					return true;
				}
				else {
					_say('loading agent ..'.$agent."..failed!");
					//return false;		  
				}
			}
			catch (Exception $e) {
				//serialize err !!
				_say("Agent ($agent) failed to initialize");
			} 
		}
		//echo 'failed agent ..',$agent,"\n";
		return false;	 	   
	} 
   
	public function destroy_agent($agent) 
	{
	  $o_agent = $this->get_agent($agent);
	  
      //seems to load the 1st agent in case of invalid agent name   
	  if (is_object($o_agent) && ($this->active_agent!=$agent)) {   
     
	    if ($this->mem->removememagn($agent)) 
		{
		  $o_agent->destroy();
		
	      unset($this->mem->agn_attr[$agent]);//RESIDENT ATTRIBUTE
	      _say("[$agent] Destroyed");
		  
		  return true;
	    }	
	    else 
		{
	      _say("[$agent] NOT destroyed!");			
		  return false;
	    }	
	  }
	  else
	    _say("Invalid object or activated!");
	}
   
	//update the object data in shared mem
	public function update_agent(&$o_agent,$agent) 
	{
		
		if ($this->mem->agn_mem_type==2)
		{
			$mem = & $this->mem->agn_addr[$agent];
			$length = $this->mem->agn_length[$agent];
			$free = $this->mem->agn_free[$agent];
			
			if ($free>0)
			{
				$s_agent = serialize($o_agent);
				if ($mem->write($s_agent,0)) 
				{
					$this->mem->agn_length[$agent] = strlen($s_agent);
					$this->mem->agn_free[$agent] = $this->mem->extra_space - strlen($s_agent);
					_say("update Agent ok:" . $length,1);	
					return true;		
				}
				_say("update write failed:" . $length,1);	
				return false;						
			}	
			_say("update Agent failed:" . $length,1);
			return false;
		}
		//var_dump($this->agn_addr);
		//var_dump($this->agn_length);	  
		//echo "\n",$this->agn_mem_store,"\n",strlen($this->agn_mem_store),"\n";   
		//echo "\n,.",strlen($this->shared_buffer),$this->shared_buffer;
	   
		if (is_object($o_agent)) 
		{
			$old_agent = $this->get_agent($agent,true);
          
			//$o_agent->env = $this;
			$s_agent = serialize($o_agent);    
		  
			//if (strlen($old_agent)!=strlen($s_agent)) 
			//{
			if (strcmp($old_agent,$s_agent)) 
			{
				//echo '+++++',strcmp($old_agent,$s_agent),'++++'; 
		  
				//1st method
				//$this->updatememagn($agent,$s_agent);
		  
				//2nd method
				//remove and then insert 2ND METHOD
				//echo  strlen($this->agn_mem_store),">>>>>\n";			
				$removed = $this->mem->removememagn($agent);
				//echo  strlen($this->agn_mem_store),">>>>>\n";
				if ($removed) 
				{		  
					$this->mem->add($agent,$s_agent);
					_say('Update agent:'.$agent,1);			
				}
				else
					_say('Update agent:'.$agent."..failed!",1);
			}
			else
				_say('Update agent:'.$agent."..not neccesery!",2);	 
	  }
	  
	  //var_dump($this->agn_addr);
	  //var_dump($this->agn_length);	  
	  //echo "\n",$this->agn_mem_store,"\n",strlen($this->agn_mem_store),"\n";		  		
	} 
   
	//return object pointer of agent OR serialized string of agent
	public function get_agent($agent,$serialized=null) 
	{
		if ($this->mem->agn_mem_type==2)
		{
			$mem = & $this->mem->agn_addr[$agent];
			$length = $this->mem->agn_length[$agent];
			$free = $this->mem->agn_free[$agent];
			
			if ($free>0) 
			{
				if ($s_agent = $mem->read(0,$length)) 
				{
					_say("getAgent ok:" . $length,1);
					
					if (!$serialized) 
					{
						$o_agent = unserialize($s_agent);
	  
						//auto update
						$o_agent->env = &$this;
		  
						//echo "get_agent($size):" . get_class($o_agent) . '(' . memory_get_usage() .")\n";
						return ($o_agent);
					}
					
					return ($s_agent);
				}
				_say("getAgent read error:" . $length,1);		  
				return false;
			}
			_say("getAgent free error :" . $length,1);		  
			return false;
		}
		
		//echo $agent,"\n>>>>>>>>>>>>>";
		if (isset($this->mem->agn_addr[$agent])) 
		{
			//var_dump($this->agn_addr);
			//var_dump($this->agn_length);		
	  
			/*if ($this->agn_mem_type==2) 
			{ 	  
				$offset = $this->agn_addr[$agent];
				$length = $this->agn_length[$agent];
				$free = $this->agn_free[$agent];
				$rlength = $length - $free;
			
				//echo $offset,':',$length,"\n";		
				$s_agent = shmop_read($this->shm_id,$offset,$rlength); 
			}
	        else*/if ($this->mem->agn_mem_type==1) 
			{
				$a_index = $this->mem->agn_addr[$agent];
				$a_size = $this->mem->agn_length[$agent];
				//echo $a_index,':',$a_size,"\n";	
				
				$s_agent = shmop_read($this->mem->agn_shm_id,$a_index,$a_size); 
			}	
			else 
			{
				$a_index = $this->mem->agn_addr[$agent];
				$a_size = $this->mem->agn_length[$agent];
				//echo $a_index,':',$a_size,"\n";				
				
				$s_agent = substr($this->mem->agn_mem_store,$a_index,$a_size);		
			}  
			//echo '>',$s_agent,'<',strlen($s_agent); 

			if ($serialized) 
			{
				//auto update ?????  
				return ($s_agent);
			}
			else 
			{  
				$size = strlen($s_agent);
				$o_agent = unserialize($s_agent);
	  
				//auto update
				$o_agent->env = &$this;
		  
				//echo "get_agent($size):" . get_class($o_agent) . '(' . memory_get_usage() .")\n";
				return ($o_agent);
			}  
		}
	  
		return null;	   
	}    
   
	//call agent's methods from cmd line!!!
	public function call_agent($agent,$daemon) 
	{
		$o_agent = $this->get_agent($agent);
	  
        //seems to load the 1st agent in case of invalid agent name   
	    if (is_object($o_agent)) 
		{
			//$daemon->changePrompt($agent.">");   
			if (method_exists($o_agent,'iam')) 
				$ret = $o_agent->iam();
			else 
				$ret = "Ok!";
    
			$this->active_o_agent = $o_agent;
			//var_dump(get_class_methods($this->active_o_agent));
			$this->active_agent = $agent;
			$daemon->changePrompt($agent.'>');
		
			$ret = implode(".",get_class_methods($this->active_o_agent)) . "\n";
	    }
	    else 
			$ret = "Invalid agent!";	
	
		return ($ret);	      
	}
   
	//uncall agent from cmd
	public function uncall_agent($daemon) 
	{
		if (is_object($this->active_o_agent)) 
		{   
			$this->active_o_agent = null;
			$this->active_agent = null;	
			$daemon->changePrompt($daemon->promptString);	
			$ret = "Ok!";					  
		}
		else
			$ret = "Invalid agent!";	
		
		return ($ret);			  
	}
   
	//call agent from sh mem buffer (client version)
	//use local
	public function call_agentc($agent) 
	{	
		$s_agent = $this->get_agent($agent,1);
	  
	    //delete agent from host
		/*if ($this->agn_attr[$agent]!='RESIDENT') //???
			$this->destroy_agent($agent);
	  	*/  
	    return ($s_agent);
	}
   
	//send agent to other agent station
	public function move_agentc($agent,$to) 
	{
	}   
   
	//accept agent from other agent station
	//$from = ip:port
	public function accept_agentc($agent,$from,$include=null) 
	{
		//get agent
		$f_agent = file_get_contents("phpagn5://$from:19125/" . $agent);//call callagentc from $from
		$s_agent = substr($f_agent,68,strlen($f_agent)-68-1);//header of daemon OFF
		_say('>'.$s_agent.'<');
		/*for ($i=0;$i<68;$i++) 
		{
			echo ord($f_agent{$i}),'.';
			$x .= $f_agent{$i};
		}	
		echo $x;*/
	  
		if (isset($s_agent)) 
		{
			//MUST BE INCLUDED TO UNSERIALZE OBJECTS
			if (!isset($include)) 
			{
				$include = (isset($this->phpdac_ip)) ?
							$this->phpdac_ip : $from;
			}   
			require("phpdac5://$include:19123/" . "agents/$agent.dpc.php");
	  	  
			$o_agent = unserialize($s_agent);	  
      
			if (is_object($o_agent)) 
			{
				//$daemon->changePrompt($agent.">");   
				$ret = (method_exists($o_agent,'iam')) ?
								$o_agent->iam() : "Ok!";
		  
				$this->mem->add($agent,$s_agent); 
			}
			else
				$ret = "Invalid agent!";	
		}
		else
			$ret = "Invalid agent!";	
	  			
	  return ($ret);	   
	}
   
	public function show_agents() 
	{
      if (!is_array($this->mem->agn_addr)) return -1;
	  
      //var_dump($this->agn_addr);	  
	  //var_dump($this->agn_length);  
   
      foreach ($this->mem->agn_addr as $agn=>$addr) 
	  {					
		  if ($this->mem->agn_mem_type==2) 
		  {
			  $mem = & $addr;
			  $length = $this->mem->agn_length[$agn];
			  $free = $this->mem->agn_free[$agn];
			  $s_agent = $mem->read(0,$length);
		  }
		  else 
		  {

			/*if ($this->agn_mem_type==2) 
				$s_agent = shmop_read($this->shm_id,$addr,$this->agn_length[$agn]);  
			else*/if ($this->mem->agn_mem_type==1) 
				$s_agent = shmop_read($this->mem->agn_shm_id,$addr,$this->mem->agn_length[$agn]);  
			else 
				$s_agent = substr($this->mem->agn_mem_store,$addr,$this->mem->agn_length[$agn]);  		
 
			_say($this->mem->agn_addr[$agn].":".$this->mem->agn_length[$agn],2);
			//echo $s_agent,"\n";
		   }
			$o_agent = unserialize($s_agent);	
		
			if (is_object($o_agent)) 
			{
				//$daemon->changePrompt($agent.">");   
				$ret .= (method_exists($o_agent,'iam')) ?
							$o_agent->iam()."\n" : $agn." Ok!"."\n";
			}
			else
				$ret .= "Invalid agent!\n";	
	    
		}
	  
		return ($ret);
	}
   
	private function free_agents() 
	{
		if ($this->gtk) 
		{
			$this->gtkds_conn->set_async_code("
				foreach (\$this->agentbox->children() as \$num=>\$child) {
					\$this->agentbox->remove(\$child);
				}	
				");		      
		} 
		
		$this->mem->closememagn();
		return true;
   }
   
   public function prn($message=null,$doctitle=null) 
   {
		if (!$message) return false;
	  
		$pr = $this->get_agent('resources')->get_resource('printer');
		//$this->update_agent($this->get_agent('resources'),'resources');
		if (is_resource($pr) &&
			get_resource_type($pr)=='printer') 
		{
			printer_start_doc($pr, $doctitle);	  
			printer_write($pr,$message."\n\r");  	 
			//printer_end_doc($pr, $doctitle); //double print 0 bytes when enabled !!!!
			_say($message,1);
			return true;
		}
	  
		_say("printing error!",1);  
		return false;
	}

	private function initPrinter() 
	{
		if (extension_loaded('printer')) {
			//$printer = "FinePrint pdfFactory Pro";
			$printer = "\\\http://{$this->phpdac_ip}\\e-Enterprise.printer";
			$printout = @printer_open($printer);//true;
			if (is_resource($printout) &&
				get_resource_type($printout)=='printer') 
			{
				printer_set_option($printout, PRINTER_MODE, 'RAW'); 
				$this->get_agent('resources')->set_resource($printer,$printout);
				_say("printer:" . $printer . " connected.",1);
			}
			else
				_say("printer:" . $printer . " error: Could not connect!",1);  
		}
	}

	public static function initPDO() 
	{
		try 
		{
		  self::$pdo = @new PDO('mysql:host=localhost;dbname=basis;charset=utf8', 'e-basis', 'sisab2018');
		  _say("PDO connection: ok!" ,1);
	    } 
		catch (PDOException $e) 
		{
            _say("Failed to get DB handle: " . $e->getMessage(),1);
        }	
	}	
	
	public function pdoConn()
	{
        return self::$pdo;
    }	 
	
	private function exebatchfile($file=null,$w=false) 
	{
	    if ((!$file) || ($file=='.ash')) //empty ashbatch 
			$file = 'init.ash';
		
		$batchfile = getcwd() . DIRECTORY_SEPARATOR . $file; 
		
		if ((is_readable($batchfile)) && ($f = @file($batchfile))) 
		{
			if ($w)
			  _say('Init batch file: ' . $batchfile);			
			
			if (!empty($f)) 
			{
				foreach ($f as $command_line) 
				{
					if (trim($command_line)) 
					{
						//echo "-" . $command_line;
						$this->dmn->dispatch(trim($command_line),null);
					}
				}		  
			}
			return true;	
		}
		return false;
	}			
   
	private function destroy() 
	{
		if ($this->gtk) 
			Gtk::main_quit();
	} 	

    public function shutdown($now=false) 
	{
		if ($now) die(); 
   	
		_say("Shutdown....",1);
	  
		//unregister_tick_function($this->get_agent('scheduler'),'checkschedules');

		//is agents now
		//unset($this->timer);
		//unset($this->scheduler);		
	  	  
		_say("Shutdown...",1);
	  	
		$this->free_agents();
		
		unset($this->dmn); //destruct
		unset($this->mem); //destruct
	  
		//close printer	 
		if (extension_loaded('printer')) {	
			$printout = $this->get_agent('resources')->get_resource('printer');   		
			if (is_resource($printout) &&
				get_resource_type($printout)=='printer')
				printer_close($printout);
		}	
		
		//unset(self::$pdo); //err, self destruct	
		return true;	
	} 
	

	public function __destruct() 
	{
        //if(!$this->dpc_agn_id)
		if(!$this->shm_id)	
            return;			   
		
	    shmop_delete($this->shm_id);
	}
	
	public function httpcl($url=null, $user=null,$password=null) 
	{
		if (!$url) return null;
		
		//require_once($this->ldscheme . "tcp/sasl.lib.php");
		//require_once($this->ldscheme . "tcp/httpclient.lib.php");		
		//include at agents.ini
		
		$http=new httpclient;
		$http->timeout=0;
		$http->data_timeout=0;
		$http->debug=0;//1
		$http->html_debug=0;//1				
		$http->user_agent="Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
		$http->follow_redirect=0;
		$http->prefer_curl=0;
		//$user="info@e-basis.gr";
		//$password="basis2012!@";
		$realm="";       /* Authentication realm or domain      */
		$workstation=""; /* Workstation for NTLM authentication */
		$authentication=(strlen($user) ? UrlEncode($user).":".UrlEncode($password)."@" : "");
				
		$url="http://".$authentication.$url;//"www.php.net/";
				
		$error=$http->GetRequestArguments($url,$arguments);

		if(strlen($realm))
			$arguments["AuthRealm"]=$realm;

		if(strlen($workstation))
			$arguments["AuthWorkstation"]=$workstation;

		$http->authentication_mechanism=""; // force a given authentication mechanism;
		$arguments["Headers"]["Pragma"]="nocache";
				
		_say("Opening connection to: " . HtmlSpecialChars($arguments["HostName"]),1);
		flush();
		$error=$http->Open($arguments);
				
		if ($error=="") {
			_say("Sending request for page: " . HtmlSpecialChars($arguments["RequestURI"]),1);
			if(strlen($user))
				_say("\nLogin:    ".$user."\nPassword: ".str_repeat("*",strlen($password)),2);
			_say('',2);
			flush();
			$error=$http->SendRequest($arguments);
			_say('',2);

			if($error=="") {
				_say("Request:\n\n".HtmlSpecialChars($http->request),2);
				_say("Request headers:\n",2);
				for(Reset($http->request_headers),$header=0;$header<count($http->request_headers);Next($http->request_headers),$header++)
				{
					$header_name=Key($http->request_headers);
					if(GetType($http->request_headers[$header_name])=="array")
					{
						for($header_value=0;$header_value<count($http->request_headers[$header_name]);$header_value++)
							_say($header_name.": ".$http->request_headers[$header_name][$header_value],2);
					}
					else
						_say($header_name.": ".$http->request_headers[$header_name],2);
				}
				_say('',2);
				flush();
				
				$headers=array();
				$error=$http->ReadReplyHeaders($headers);
				_say('',2);
				if($error=="")
				{
					_say("Response status code:\n".$http->response_status,2);
					switch($http->response_status)
					{
						case "301":
						case "302":
						case "303":
						case "307":
							_say(" (redirect to ".$headers["location"].")\nSet the follow_redirect variable to handle redirect responses automatically.",2);
							break;
					}
					_say('');
					_say("Response headers:\n",2);
					for(Reset($headers),$header=0;$header<count($headers);Next($headers),$header++)
					{
						$header_name=Key($headers);
						if(GetType($headers[$header_name])=="array")
						{
							for($header_value=0;$header_value<count($headers[$header_name]);$header_value++)
								_say($header_name.": ".$headers[$header_name][$header_value],2);
						}
						else
							_say($header_name.": ".$headers[$header_name],2);
					}
					_say('',2);
					flush();
					
					//echo "Response body:\n\n";
					/*You can read the whole reply body at once or
					block by block to not exceed PHP memory limits.
					*/
					
					$error = $http->ReadWholeReplyBody($body);
					//if(strlen($error) == 0)
						//echo HtmlSpecialChars($body);
					
					/*for(;;)
					{
						$error=$http->ReadReplyBody($body,1000);
						if($error!="" || strlen($body)==0)
							break;
						//echo $body;//HtmlSpecialChars($body);
						//return...
					}*/

					_say('',2);
					//flush();
				}
			}
			$http->Close();
			
		}
		
		if(strlen($error)) {
			_say("Error: ".$error,1);
			return null;	
		}

		return ($body);		
	}	
	
}

?>