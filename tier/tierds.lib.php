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
   
class tierds {

	private $mem; 
	public $env, $dmn, $cnf, $utl, $res;
	public $agent, $active_agent, $active_o_agent; 
	public $daemon_ip, $daemon_port, $daemon_type;	
  
	public $resources, $timer, $scheduler;
	public $gtk, $gtkds_conn, $window, $agentbox;  
	public $ldscheme, $verboseLevel, $argbatch;
	
	public static $ldschemeS;  	
	public static $pdo;
	
	private static $timeout_counter;
	private $timeout, $uuid, $tkeys;

	public function __construct() { 
		global $dh, $dp;
		$argc = $GLOBALS['argc'];
		$argv = $GLOBALS['argv'];
		//print_r($argv);
		
		$this->verboseLevel = GLEVEL;	  
		$this->agent = 'SH';//default
		$this->tkeys = array('heartbeat', 'heartbrst', 'netport');
	
		//argv1 is daemon type -param or batchfile .ash
		$this->argbatch = (substr($argv[1],0,1)!='-') ? $argv[1].'.ash' : '';
		
		$this->daemon_type = (substr($argv[1],0,1)=='-') ? substr($argv[1],1) : ''; 
		$this->daemon_ip = $argv[2] ? $argv[2] : '127.0.0.1';//$ip;//'192.168.4.203';
		$this->daemon_port = $argv[3] ? $argv[3] : '19125';//$port;//19123;
		//!!!_say("Phpagn5 client at $this->daemon_ip:$this->daemon_port");	  
		
		self::$timeout_counter = 0;
		$this->timeout = ($this->daemon_type=='inetd') ? 0 : _TIMEOUT; //times to loop x20sec scheduler		
	  
		//dac server	
		$this->phpdac_ip = $argv[5] ? $argv[5] : '127.0.0.1';//$dacip;
		$this->phpdac_port = $argv[6] ? $argv[6] : '19123';//$dacport; 
		
		_tverbose("[----]Phpdac5 server at $this->phpdac_ip:$this->phpdac_port" . PHP_EOL); 
	    
		//REGISTER PHPDAC 7
		$dh = $this->phpdac_ip;  //global inside dacstreamc7 for gc
		$dp = $this->phpdac_port;//global inside dacstreamc7 for gc
		require("tier/dacstreamc7.lib.php"); //linux must set (disable class inside tier.dpc.php)			
		$phpdac_c = stream_wrapper_register("phpdac5","tier_dacstream");
		if (!$phpdac_c) 
		{
			//_say("Client dac protocol failed to registered!");
			_tverbose("[----]Dac protocol failed to registered" . PHP_EOL);
			die();
		}	  
		else
		{		
			_tverbose("[----]Dac protocol registered" . PHP_EOL);
	  
			$this->ldscheme = "phpdac5://{$this->phpdac_ip}:{$this->phpdac_port}";
			self::$ldschemeS = "phpdac5://". ($argv[5] ? $argv[5] : '127.0.0.1') .":". ($argv[6] ? $argv[6] : '19123');	
	
			//REGISTER PHPAGN (client side,interconnections) protocol.			
			require($this->ldscheme . "/kernel/sagnc.lib.php"); 
			$phpdac_c = stream_wrapper_register("phpagn5","c_agnstream");
			if (!$phpdac_c) 
			{
				_tverbose("[----]Agent protocol failed to registered" . PHP_EOL);
				die();
			}	  
			else 
			{
				_tverbose("[----]Agent protocol registered" . PHP_EOL); 	

				//REGISTER PHPRES (client side,resources) protocol.		
				require_once($this->ldscheme . "/kernel/sresc.lib.php"); 
				$phpdac_c = stream_wrapper_register("phpres5","c_resstream");
				if (!$phpdac_c) 
				{
					_tverbose("[----]Resource protocol failed to registered" . PHP_EOL);
					die();
				}	  
				else
				{		
					_tverbose("[----]Resource protocol registered" . PHP_EOL); 
	
					//INITIALIZE ENVIRONMENT
		
					require_once($this->ldscheme . "/kernel/cnf.lib.php");
					$this->cnf = new Config(Config::TYPE_ALL & ~Config::TYPE_DOG & ~Config::TYPE_CAT & ~Config::TYPE_RAT);		
					$this->cnf->_say('Load conf', 'TYPE_LION');
					require_once($this->ldscheme . "/kernel/utils.lib.php");
					$this->utl = new utils($this); //utils	
					$this->cnf->_say('Load utils', 'TYPE_LION');
					
					//client res (no shm agent for resources)
					require_once($this->ldscheme . "/tier/res.lib.php");
					$this->res = new res($this); 	
					$this->cnf->_say('Load resource handler', 'TYPE_LION');
		
					//kernel tools
					require_once($this->ldscheme . "/kernel/imo.lib.php");
		
					require_once($this->ldscheme . "/tier/memt.lib.php");
					$this->mem = new memt($this);
					if ($this->mem->initialize())			
					{	
						$this->mem->open();

						//clear log
						@unlink(_DUMPFILE);
		  
						$this->env['name'] = _MACHINENAME;  			 
						$this->env['os'] = $_SERVER['OS'];	  
						$this->env['domain'] = $_SERVER['USERDNSDOMAIN'];				 
						$this->env['appdata'] = $_SERVER['APPDATA'];	  
						$this->env['homepath'] = $_SERVER['HOMEPATH'];	  	
						$this->env['host'] = $_SERVER['REMOTE_ADDR'];  
						//var_dump($this->env);	
						//var_dump($_SERVER);
			
						//init printer	 
						$this->initPrinter();
						
						//init db
						self::$pdo = null;	//serialize err 1250 (see inside process)		
						if (self::initPDO())
							$this->cnf->_say("PDO connection: ok!" , 'TYPE_IRON');
				  
						//INITIALIZE AGENTS
						$this->active_agent = null;
						$this->active_o_agent = null;	
						$this->init_agents();
	  
						//initialize task from already loaded agents (BEWARE TO LOAD THE DEFAULT AGENTS)
						if ($s = $this->get_agent('scheduler'))
							$s->schedule('env.show_connections','every','20'); 
  
						//initialize GTk connector (for calling proc from this ($env) class ...purposes)
						$this->gtk = ($argv[4]==='-gtk') ? true : false;
						if ($this->gtk) 
						{
							require($this->ldscheme . "/tier/gtklib.lib.php");  			  
							$this->cnf->_say("GTK connector loaded!", 'TYPE_LION');
							$this->gtkds_conn = new gtkds_connector();
		
							//////////////////////////////////// gtk win
							require($this->ldscheme . "/tier/gtkds.lib.php");
							//new gtkds($this,0);//connector init is off ..bellow loaded!		
						}
						else
							$this->uuid = $argv[4]; //uuid param
	    
						//init daemon
						require_once($this->ldscheme . "/tier/dmnt.lib.php");
						if ($this->dmn = new dmnt($this, /*daemonize this*/
								 $this->daemon_type,
								 $this->daemon_ip,
								 $this->daemon_port))
						{
							//$this->dmn->RegisterAction(array(&$this,'timer'));
							//listen
							$this->dmn->listen(1); 				
						}	
					}
					else 
					{
						$this->cnf->_say('Memory critical error', 'TYPE_LION');
						$this->shutdown(true);
					}
				}
			}	
		}
	}

	//dmn Println
	public function _echo($msg) 
	{
		$this->dmn->Println($msg);
	}
	
	//cnf say
	public function _say($msg, $type='TYPE_LION', $crln=true) 
	{
		$this->cnf->_say($msg, $type, $crln);
	}	

	//include -remote- file (return string to require/require_once)
	public function _include($inc) {	
						
		return ($this->ldscheme .'/' . $inc);
	}		
	
	public function show_connections($show=null,$dacserver=null)
	{
		//set timeout inc by 1, when called as proc
		$this->set_timeout();
		
		return $this->dmn->show_connections($show,$dacserver);
	}
	
	
	
	//HEARTBEAT
	
	//set timeout inc by 1, when called as proc
	private function set_timeout() 
	{
		if (!$this->timeout) return;// false; //-inetd daemon type

		if (self::$timeout_counter == $this->timeout) 
		{				
			//shutdown when uuid	
			if ($this->umonDestroy())
				$this->shutdown(true);
		}	
		else	
			//self::$timeout_counter += 1;
			self::set_timeout_counter();
		
		$this->_say("Timeout ({$this->uuid}):" . self::$timeout_counter, 'TYPE_RAT');
		return true;
	}
	
	//set timeout counter (heartbeat when reset)
	private function set_timeout_counter($c=null)
	{
		if (($c) && (is_numeric($c))) 
		{
			if (self::$timeout_counter > 0) 
			{	
				self::$timeout_counter = $c; //1 = reset (heartbeat)
				return true; // no msg if rem
			}
			else
				return false;	
		}	
		else
			self::$timeout_counter += 1;
		
		$this->_say("Heartbeat ({$this->uuid}):" . self::$timeout_counter . '/' . _TIMEOUT, 'TYPE_BIRD');
		return true;
	}
	
	//delete umon file	
	//tier/file, saved from kernel into tier/ directory	
	private function umonDestroy()
	{
		//no shutdown when no uuid, manual tier
		//manual tiers has no uuid
		if (!$this->uuid) return false; 
		
		$cwd = getcwd(); 
		$uufile = $cwd . _UMONFILE . $this->uuid . '.log';
		
		return @unlink($uufile); 	
	}
	
	//get the umon port number, fetch to phpdac7(uuid)
	public function umonPort($uuid=null)
	{
		//manual tiers has no uuid
		$uid = $uuid ? $uuid : $this->uuid; 
		if (!$uid) return false; 
		
		$cwd = getcwd(); 
		$uufile = $cwd . _UMONFILE . $uid . '.log';
		$port = @file_get_contents($uufile);
		
		return $port ? trim($port) : false; 	
	}	
	
	//reset the heartbeat 
	public function heartbrst($args=null)
	{
		$h = $this->set_timeout_counter(1);
		$this->_say('heartbeat reset:'. $h , 'TYPE_IRON');
		return $h;
	}
	
	//get the heartbeat
	public function heartbeat($args=null)
	{
		$h = self::$timeout_counter;
		$this->_say('heartbeat reply:'. $h , 'TYPE_IRON');
		return ($h);
	}	
	
	//get umon port
	public function netport($args=null)
	{
		$port = $this->umonPort();
		$this->_say('netport reply:'. $port , 'TYPE_IRON');
		return ($port);
	}	
	
	public function iscmd($k=null)
	{
		if (!$k) return false;
		
		return in_array($k, $this->tkeys);
	}

	
	//READS / RESOURCES
	
	//alias - remote read (phpdac7)
	public function readC($dpc) 
	{		
	    //dispatch ram cmds (no shm cmds)
		$keycmd = strstr($dpc, '-') ? explode('-', $dpc) : $dpc;
		$cmd = is_array($keycmd) ? array_shift($keycmd) : $keycmd;
		if ($this->iscmd($cmd))
		{
			$this->_say('read key: '. $cmd, 'TYPE_IRON');
			
			if (method_exists($this, $cmd))
			{	
				return $this->$cmd($keycmd); //rest of array
			}	
			else
				$this->_say('unknown method for key: '. $cmd, 'TYPE_IRON');
		}
		
		//else		
		//read resource
		return $this->res->get_resource($dpc);
	}	
	
	//alias - local read
	public function read($dpc) 
	{
		//echo "AGENT READ ($dpc):" . $this->res->get_resource($dpc) . "---->" . PHP_EOL;
		return $this->res->get_resource($dpc);
	}	
	
	
	
	//AGENTS
	
	//reead file of agents to initialize
	private function init_agents() 
	{    
	   $f = $this->ldscheme . "/tier/tierds.ini";			
	   $this->cnf->_say('Init agents file: ' . $f, 'TYPE_LION');
	   
	   $code = @file_get_contents($f);
	   if (isset($code))
	   {
		    $file = explode(PHP_EOL, $code);
		   
			//clean code by nulls and commends
			foreach ($file as $num=>$line) 
			{
				if ($trimedline = trim(str_replace(array("\r", "\n", ';'), '', $line)))
					if ($trimedline[0]!="#") //comment          
						$lines[] = $trimedline;
			}
			
			//print_r($lines);
			//$toktext = implode("",$lines); //one line may have more than one cmds sep by ;
			//$token = explode(";",$toktext);	//tokenize	  			
	        foreach ($lines as $tid=>$tcmd) 
			{  
			   //echo $tcmd .PHP_EOL;
			   $part = explode(' ', $tcmd);
			   
			   switch ($part[0]) {	
			   
			     case 'system':	//run system cmds
				                $name = explode(".",trim($part[0]));
				                break;				  
								
			     case 'schedule': //run scheduled cmds
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
								  $name = explode(".",trim($part[0]));
								  $this->create_agent($name[1],$name[0]);//$part[1]);-RESIDENT disbaled
								} 
				                
			   }
			   $i+=1;
			   //echo $i .'-----['. $tcmd .']-----' . PHP_EOL;
	        }	 
			return true;
	   }
	   
	   return false;
	}  
   
	public function create_agent($agent,$domain=null,$include_ip=null,$as_name=null,$type='dpc',$includeonly=false) 
	{
		global $__DPC;  
		$dpc = $domain ? $domain : 'agents';
		$class = strtoupper($agent).'_DPC';	  
		//echo $class;
	  
		if (defined($class)) 
		{
			$this->_say($agent . " exists!", 'TYPE_IRON');
			return true;
		}	  
	  
		if (isset($include_ip))
			require("phpdac5://$include_ip:". $this->phpdac_port . "/$dpc/$agent" .'.'. $type.'.php');    
		else 
			require($this->ldscheme . "/$dpc/$agent" . '.'. $type.'.php');    
	  
		if (($type=='lib') && ($includeonly)) 
		{
			$this->cnf->_say('include library: '.$agent, 'TYPE_LION');
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
						if ( $_m = $this->mem->add($as_name,$s_agent))
							$this->cnf->_say("Create agent [$agent] as $as_name", 'TYPE_LION');
					}
					else {
						if ($_m = $this->mem->add($agent,$s_agent))
							$this->cnf->_say("Create agent [$agent]", 'TYPE_LION');
					}  
 
					//var_dump($this->agn_addr);
					//var_dump($this->agn_length);	  
					//echo "\n",substr($this->agn_mem_store,0,256),"\n",strlen($this->agn_mem_store),"\n";				
					//echo "NEW AGENT(".strlen($s_agent)."):" . get_class($o_agent) . '(' . memory_get_usage() .")\n";		
					
					return $_m; //true;
				}
				else {
					$this->cnf->_say("loading agent [$agent] failed!", 'TYPE_LION');
					//return false;		  
				}
			}
			catch (Exception $e) {
				//serialize err !!
				$this->cnf->_say("Agent [$agent] failed to initialize", 'TYPE_LION');
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
				
				$this->cnf->_say("[$agent] destroyed", 'TYPE_LION');
				return true;
			}	
			else 
			{
				$this->cnf->_say("[$agent] NOT destroyed!", 'TYPE_LION');			
				return false;
			}	
		}
		//else
		$this->cnf->_say("Invalid object or agent is active!", 'TYPE_LION');
	}
   
	//update the object data in shared mem
	public function update_agent(&$o_agent, $agent=null) 
	{	
		//$o_agent = $this->get_agent($agent); //!!!!!!!!!!!!!
	
		if ($this->mem->agn_mem_type==2)
		{
			if (is_object($o_agent)) // is object !!!
			{		
				if ($agent)
				{/*
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
							$this->cnf->_say("update agent [$agent]: " . $length, 'TYPE_CAT');	
							return true;		
						}
						$this->cnf->_say("update agent [$agent] write failed:" . $length, 'TYPE_LION');	
						//return false;						
					}
					$this->cnf->_say("update agent [$agent] failed:" . $length, 'TYPE_LION');
					//return false;
					*/
					
					$s_agent = serialize($o_agent);
					
					if ($_m = $this->mem->upd($agent, $s_agent))
					{
						$this->cnf->_say("update agent [$agent] ", 'TYPE_LION');	
						return true;
					}
					else
						$this->cnf->_say("update agent [$agent] failed:" . $length, 'TYPE_LION');
						
				}
				else
					$this->cnf->_say("update agent [$agent] has no id!", 'TYPE_LION');
			}
			else
				$this->cnf->_say("Update agent [$agent] is not an object:" . gettype($o_agent), 'TYPE_LION');
		}
		else  //1/0
		{
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
						
						$this->cnf->_say("Update agent [$agent]", 'TYPE_LION');			
						return true;
					}
					else
						$this->cnf->_say("Update agent [$agent] failed!", 'TYPE_LION');
				}
				else
					$this->cnf->_say("Update agent [$agent] not neccesery!", 'TYPE_LION');	 
			}
			else
				$this->cnf->_say("Update agent [$agent] is not an object!", 'TYPE_LION');
	  
			//var_dump($this->agn_addr);
			//var_dump($this->agn_length);	  
			//echo "\n",$this->agn_mem_store,"\n",strlen($this->agn_mem_store),"\n";		  		
		}
		
		return false;
	} 
   
	//return object pointer of agent OR serialized string of agent
	public function get_agent($agent, $serialized=null) 
	{
		if (!$agent)
		{
			$this->cnf->_say("getAgent id not defined! ", 'TYPE_LION');
			return false;
		}	
		
		if ($this->mem->agn_mem_type==2)
		{
			$mem = & $this->mem->agn_addr[$agent];
			$length = $this->mem->agn_length[$agent];
			$free = $this->mem->agn_free[$agent];
			
			if ($free>0) 
			{
				if ($s_agent = $mem->read(0,$length)) 
				{				
					if (!$serialized) 
					{
						$o_agent = unserialize($s_agent);
	  
						//auto update
						$o_agent->env = &$this;
						//echo "get_agent($size):" . get_class($o_agent) . '(' . memory_get_usage() .")\n";
		  
						$this->cnf->_say("getAgent [$agent]: " . $length, 'TYPE_LION');
						return ($o_agent);
					}
					
					$this->cnf->_say("getAgent [$agent] serialized: " . $length, 'TYPE_LION');
					return ($s_agent);
				}
				
				$this->cnf->_say("getAgent [$agent] read error:" . $length, 'TYPE_LION');		  
				return false;
			}
			
			$this->cnf->_say("getAgent [$agent] free error " . $length, 'TYPE_LION');		  
			return false;
		}
		
		//else
		
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
			$daemon->changePrompt($agent . '>');
		
			$ret = implode(".", get_class_methods($this->active_o_agent)) . "\n";
	    }
	    else 
			$ret = "Invalid agent!";	
	
		return ($ret);	      
	}
   
	//uncall agent from cmd
	public function uncall_agent($daemon=null) 
	{
		if (is_object($this->active_o_agent)) 
		{   
			$this->active_o_agent = null;
			$this->active_agent = null;		
			$ret = "Ok!";				

			if (is_object($daemon))
				$daemon->changePrompt($daemon->promptString);	
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
		$this->_say('>'.$s_agent.'<', 'TYPE_BIRD');
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
				$inc = (isset($this->phpdac_ip)) ?
							$this->phpdac_ip : $from;
			}   
			require("phpdac5://$inc:{$this->phpdac_port}/" . "agents/$agent.dpc.php");
	  	  
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
		$xi = 0;
		foreach ($this->mem->agn_addr as $agn=>$addr) 
		{	
			$xi+= 1;
			
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
 
				$this->_say($this->mem->agn_addr[$agn].":".$this->mem->agn_length[$agn], 'TYPE_BIRD');
				//echo $s_agent,"\n";
			}
		   
			$o_agent = unserialize($s_agent);	
		
			if (is_object($o_agent)) 
			{
				//$daemon->changePrompt($agent.">");   
				/*$ret .= (method_exists($o_agent,'iam')) ?
							$o_agent->iam()."\t" : $agn." Ok!"."\t";*/
				if (method_exists($o_agent,'iam')) 
				{			
					$this->_say($o_agent->iam(), 'TYPE_IRON');
					//$this->_say("agent [$agn] ok!", 'TYPE_IRON');
				}	
				else
					$this->_say($agn . ' ok!', 'TYPE_IRON');
			}
			else
				//$ret .= "Invalid agent [$agn]!\t";	
				$this->_say("Invalid agent [$agn]", 'TYPE_LION');
	    
		}

		return $xi; //($ret);
	}
   
	private function free_agents() 
	{
		$this->mem->close();
		
		if ($this->gtk) 
		{
			$this->gtkds_conn->set_async_code("
				foreach (\$this->agentbox->children() as \$num=>\$child) {
					\$this->agentbox->remove(\$child);
				}	
				");		      
		} 
		
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
			
			$this->cnf->_say($message, 'TYPE_LION');
			return true;
		}
	   
		$this->cnf->_say("Priniting error!", 'TYPE_LION');
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
				
				$this->cnf->_say("printer:" . $printer . " connected.", 'TYPE_LION');
			}
			else  
				$this->cnf->_say("printer:" . $printer . " error: Could not connect!", 'TYPE_LION');
		}
	}

	public static function initPDO() 
	{
		try 
		{
		  self::$pdo = @new PDO('mysql:host=localhost;dbname=basis;charset=utf8', 'e-basis', 'sisab2018');
		  return true;
	    } 
		catch (PDOException $e) 
		{
            _tverbose("[----]Failed to get DB handle: " . $e->getMessage(), 'TYPE_LION');
        }
		return false;	
	}	
	
	public function pdoConn()
	{
        return self::$pdo;
    }	 

	//server db connect (client) or clientside db	
	public function pdoQuery($dpc, $clientside=false)
	{
		if (($clientside==true) && (self::$pdo))	
		{	
			foreach(self::$pdo->query($dpc, PDO::FETCH_ASSOC) as $row) 
				$_data[] = $row;
			
			return $_data;	
			
		}
		//else from srv	
		$sql = str_replace(' ', '-', $dpc);	
		return file_get_contents($this->ldscheme . "/$sql");
		//MUST return array of fileds or one field (string) 	
	}	
	
	//insert, update, delete to srv
	public function pdoExec($dpc, $clientside=false)
	{
		if (($clientside==true) && (self::$pdo))	
		{
			//...
		}
		
		return file_get_contents($this->ldscheme . "/$dpc");
		//MUST return true false		
	}		
   
	private function destroy() 
	{
		if ($this->gtk) 
			Gtk::main_quit();
	} 	

    public function shutdown($now=false) 
	{
		//_say("Shutdown " . $now, 1);
		$this->cnf->_say('Shutdown ' . $now, 'TYPE_LION');	 
		
		$this->free_agents();
		
	  	if ($now) die();		
	  
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
		unset($this->cnf); //destruct
		unset($this->utl); //destruct
		unset($this->dmn); //destruct
		unset($this->mem); //destruct
		//$this->cnf->_say('.', 'TYPE_LION');
		_tverbose('.' . PHP_EOL);
	}	
	
}
?>