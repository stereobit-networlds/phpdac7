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

class dmnt {	

	private $env, $dmn; 
	private $daemon_type, $daempn_ip, $daemon_port, $promptString;
	public $type, $ip, $port;
	
	public function __construct(& $env, $type, $ip, $port, $prompt=false) 
	{	
		$this->env = $env;
		
		$this->daemon_type = $type;
		$this->daemon_ip = $ip;
		$this->daemon_port = $port;
		$this->promptString = 'phpagn5>';
		$this->env->_say("Phpagn5 client at {$this->daemon_ip}:{$this->daemon_port}", 'TYPE_IRON');	  
		
		//require($this->env->ldscheme . "/system/daemon.lib.php");
		require($this->env->ldscheme . "/tier/dmnl.lib.php");
		
		$this->dmn = new daemon($type, true, $this->env);//$prompt);	  
		$this->dmn->setAddress ($ip);//'127.0.0.1');
		$this->dmn->setPort ($port);
		$this->dmn->Header = "PHPDAC5 Agent v2, ". $this->env->env['name'] . ' ' . $this->daemon_ip .':'. $this->daemon_port;

		$this->dmn->start($this->promptString); 

		$this->dmn->setCommands (array ("help", "quit", "date", "shutdown","echo","silence",
	                                  "ver", "callagent", "uncall", "callagentc", "call", "helo", "run", "net",
									  "create", "destroy", "show", "move", "accept", "print",  
									  "getresource", "getresourcec", "showresources", 
									  "findresource", "findresourcec", "setresource", "delresource",
									  "checkschedules", "showschedules", "setschedule",
									  "who", "http", "startgtk", "system", "batch", 
									  "netport", "heartbeat", "heartbrst", "zooconf", "***"));	  
		//list of valid commands that must be accepted by the server	
	  
		$this->dmn->CommandAction ("help", array($this,"command_handler")); //add callback
		$this->dmn->CommandAction ("quit", array($this,"command_handler")); // by calling 
		$this->dmn->CommandAction ("date", array($this,"command_handler")); //this routine
		$this->dmn->CommandAction ("shutdown", array($this,"command_handler"));
	  
		$this->dmn->CommandAction ("echo", array($this,"command_handler"));	  
		$this->dmn->CommandAction ("silence", array($this,"command_handler"));		  
	  
		$this->dmn->CommandAction ("ver", array($this,"command_handler"));	  	
		$this->dmn->CommandAction ("callagent", array($this,"command_handler"));	
		$this->dmn->CommandAction ("call", array($this,"command_handler"));//alias	    
		$this->dmn->CommandAction ("uncall", array($this,"command_handler"));	  
		$this->dmn->CommandAction ("callagentc", array($this,"command_handler"));//client version quit after		  
		$this->dmn->CommandAction ("helo", array($this,"command_handler"));	
		$this->dmn->CommandAction ("run", array($this,"command_handler"));
		$this->dmn->CommandAction ("net", array($this,"command_handler"));	  

		$this->dmn->CommandAction ("create", array($this,"command_handler"));	  
		$this->dmn->CommandAction ("destroy", array($this,"command_handler"));	  
		$this->dmn->CommandAction ("show", array($this,"command_handler"));
		$this->dmn->CommandAction ("move", array($this,"command_handler"));
		$this->dmn->CommandAction ("accept", array($this,"command_handler"));	  	  	  	
		$this->dmn->CommandAction ("print", array($this,"command_handler"));		  	   
		$this->dmn->CommandAction ("getresource", array($this,"command_handler"));	 	  	  
		$this->dmn->CommandAction ("getresourcec", array($this,"command_handler"));	  
		$this->dmn->CommandAction ("showresources", array($this,"command_handler"));		  
		$this->dmn->CommandAction ("findresource", array($this,"command_handler"));	  
		$this->dmn->CommandAction ("findresourcec", array($this,"command_handler"));			  
		$this->dmn->CommandAction ("setresource", array($this,"command_handler"));	  
		$this->dmn->CommandAction ("delresource", array($this,"command_handler"));		  
		$this->dmn->CommandAction ("checkschedules", array($this,"command_handler"));	
		$this->dmn->CommandAction ("showschedules", array($this,"command_handler"));
		$this->dmn->CommandAction ("setschedule", array($this,"command_handler"));
		$this->dmn->CommandAction ("who", array($this,"command_handler"));
		$this->dmn->CommandAction ("http", array($this,"command_handler"));	  
		$this->dmn->CommandAction ("startgtk", array($this,"command_handler"));	  
		$this->dmn->CommandAction ("system", array($this,"command_handler"));
		$this->dmn->CommandAction ("batch", array($this,"command_handler"));
		$this->dmn->CommandAction ("netport", array($this,"command_handler"));
		$this->dmn->CommandAction ("heartbeat", array($this,"command_handler"));
		$this->dmn->CommandAction ("heartbrst", array($this,"command_handler"));
	    $this->dmn->CommandAction ("zooconf", array($this,"command_handler"));
	  
		$this->dmn->CommandAction ("***", array($this,"agent_handler"));//handle everyting else...	  
	  									
		//1st action exebatch .ash
		$this->exebatchfile($this->env->argbatch, true);
	}							  
	
	public function command_handler ($command, $arguments, $dmn) 
	{
   
		switch ($command) 
		{
        case 'HELP':
                //commands are converted to uppercase by default. If you want to
                //disable this, look into tokenise().
                $commands = implode (' ', $dmn->valid_commands);
                $dmn->Println ('Valid Commands: ');
                $dmn->Println ($commands);
                return true;
                break;
        case 'QUIT':
		        $dmn->changePrompt();
				
				//only in inetd mode
				if ($this->daemon_type=='inetd') $this->env->shutdown();
                return false;
                break;
        case 'DATE':
                $dmn->Println (date ("Y-m-d H:i:s"));
                return true;
                break;
        case 'SHUTDOWN':
		        $dmn->changePrompt();
                $dmn->shutdown ();
				
				$this->env->shutdown();				
                exit;
                break;
				
        case 'ECHO':
                $dmn->setEcho($arguments[0]);
                return true;
                break;	
				
        case 'SILENCE':
                $dmn->setSilence($arguments[0]);
                return true;
                break;							
				
        case 'VER':
                $dmn->Println (implode(",",$arguments).':shell script engine V0.01 on PHP'.phpversion());
                return true;
                break;						
				
		case 'CALL'     ://alias		
		case 'CALLAGENT'://server version
		        $data = $this->env->agn->call_agent($arguments[0],$dmn);
		        $dmn->Println ($data);
                return true;
                break;	
				
		case 'UNCALL'://server version
		        $data = $this->env->agn->uncall_agent($dmn);
		        $dmn->Println ($data);
                return true;
                break;					
				
		case 'CALLAGENTC'://client version ... moves agent from server to client
		        $dmn->setEcho(0);//echo off
				//header from 1st command still appear...must set client silence off				
				$dmn->setSilence(1);//silence off...???
		        $data = $this->env->agn->call_agentc($arguments[0]);
		        $dmn->Println ($data);
                return false;//and quit
                break;					
				
		case 'HELO':
                return false;
                break;		
				
		case 'RUN':
                return true;
                break;	

		case 'PRINT':
		        $this->env->prn($arguments[0],$arguments[1]);
                return true;
                break;				
				
		case 'NET':
		        if (method_exists($this->env,$arguments[0])) 
				{
                  $data = $this->env->{$arguments[0]}($arguments[1],$arguments[2],$arguments[3]);		
		          $dmn->Println ($data);		        
				}
                return true;
                break;					
				
		case 'SHOW':
				$data = $this->env->agn->show_agents();
		        $dmn->Println($data);
                return true;
                break;
				
		case 'CREATE':
		        $data = $this->env->agn->create_agent($arguments[0],$arguments[1],$arguments[2],$arguments[3]);
		        $dmn->Println ($data);			
                return true;
                break;
				
		case 'DESTROY':
		        $data = $this->env->agn->destroy_agent($arguments[0]);
		        $dmn->Println ($data);			
                return true;
                break;								
				
		case 'MOVE':
		        $data = $this->env->agn->move_agentc($arguments[0],$arguments[1]);
		        $dmn->Println ($data);			
                return true;
                break;
				
		case 'ACCEPT':	
		        $data = $this->env->agn->accept_agentc($arguments[0],$arguments[1],$arguments[2]);
		        $dmn->Println ($data);		
                return true;
                break;																	

		case 'GETRESOURCE' : //local (or remote) resources
				$dmn->setEcho(0);
				$dmn->setSilence(1);
		        //$resource = $this->env->agn->get_agent('resources')->get_resource($arguments[0],$arguments[1]);
				//$resource = $this->env->res->get_resource($arguments[0],$arguments[1]);
				//alias
				$resource = $this->env->readC($arguments[0]);
				
		        $dmn->Println(trim($resource));
				return ($this->env->daemon_type=='inetd') ? true : false;
				//return false;//and quit				
		        break;										
				
		case 'GETRESOURCEC' : //phpdac5 resource saved in shmem
		        //$resource = $this->env->agn->get_agent('resources')->get_resourcec($arguments[0],$this->phpdac_ip,$this->phpdac_port);
				$resource = file_get_contents($this->env->ldscheme .'/'. $arguments[0]);
				$dmn->Println ($resource);
				return true;
		        break;
				
		case 'SHOWRESOURCES':
		        //$r = $this->env->agn->get_agent('resources')->showresources();
				$r = $this->env->res->showresources();
				$dmn->Println ($r);
                return true;
                break;			
									 						
		case 'FINDRESOURCE':				
		case 'FINDRESOURCEC':
		        //$r = $this->env->agn->get_agent('resources')->findresource($arguments[0],1);
				$r = $this->env->res->findresource($arguments[0],1);
				$dmn->Println ($r);
                return true;
                break;	
				
		case 'SETRESOURCE':
		        //$r = $this->env->agn->get_agent('resources')->set_resource($arguments[0],$arguments[1]);
				$r = $this->env->res->set_resource($arguments[0],$arguments[1]);
				$dmn->Println ($r);
                return true;
                break;		
				
		case 'DELRESOURCE':
		        //$r = $this->env->agn->get_agent('resources')->del_resource($arguments[0]);
				$r = $this->env->res->del_resource($arguments[0]);
				$dmn->Println ($r);
                return true;
                break;													
				
		case 'CHECKSCHEDULES':
		        $c = $this->env->agn->get_agent('scheduler')->checkschedules();
				$dmn->Println ($c);
                return true;
                break;	
				
		case 'SHOWSCHEDULES':
		        $s = $this->env->agn->get_agent('scheduler')->showschedules();
				$dmn->Println ($s);
                return true;
                break;

		case 'SETSCHEDULE' :
		        $sh = $this->env->agn->get_agent('scheduler');
				$entry = $sh->schedule($arguments[0],$arguments[1],$arguments[2]);				
				$this->env->agn->update_agent($sh,'scheduler');
				
				$dmn->Println($entry);
				return true;
		        break;
				
		case 'WHO':
		        $sessions = $this->show_connections(1,$arguments[0]);
				$dmn->Println($sessions);
				return true;
		        break;	

		case 'HTTP':
		        $h = $this->env->utl->httpcl($arguments[0],$arguments[1],$arguments[2]);
				$dmn->Println($h);
				return true;
		        break;					
				
		case 'STARTGTK':
		        if ($this->gtk) 
				{
					$this->env->_say("Starting GTK Console...", "TYPE_LION");
					new gtkds($this,0);
					$dmn->Println($c);
					return true;
				}
				
		        break;	

		case 'SYSTEM': 
				$ret = shell_exec($arguments[0]);	
				$dmn->Println ($ret);
				return true;
				break;

		case 'BATCH': 
				$this->exebatchfile($arguments[0]);
				return true;
				break;
				
		case 'NETPORT': 
				$ret = $this->env->umonPort($arguments[0]);
				$dmn->Println ($ret);
				return ($this->env->daemon_type=='inetd') ? true : false;
				break;

		case 'HEARTBEAT': 
				$ret = $this->env->getHeartbeat();
				$dmn->Println ($ret);
				return ($this->env->daemon_type=='inetd') ? true : false;
				break;

		case 'HEARTBRST': 
				$this->env->setHeartbeat();
				//$dmn->Println ($ret);
				return ($this->env->daemon_type=='inetd') ? true : false;
				break;	

		case 'ZOOCONF': 
				$conf = implode(' ', $arguments);
				$ret = $this->env->setZooConf($conf);
				$dmn->Println ($ret);
				return ($this->env->daemon_type=='inetd') ? true : false;
				break;				
        }		
	}  
   
	//agent command dispatcher (all *** commands)
	public function agent_handler($command, $arguments, $dmn) 
	{	
		//create command line from daemon			
		$shell_command = $command . " " . implode(' ',$arguments);			
		
		if (is_object($this->env->agn->active_o_agent)) 
		{
			if (method_exists($this->env->agn->active_o_agent,$command))
				$ret = $this->env->agn->active_o_agent->$command($arguments[0],$arguments[1],$arguments[2]);
			else
				$ret = "Invalid command.\n\n" . 
						implode("\n",get_class_methods($this->env->agn->active_o_agent)) . "\n";  
		  
			$dmn->Println ($ret); 
			return true;  
		}			
		else {			
			$dmn->Println ($shell_command); 
			return true;  
		}
	} 	
	
	public function show_connections($show=null,$dacserver=null) 
	{
		if ($dacserver) 
		{ 	
			//get sessions from phpdac server's daemon...
			$sret = $this->env->agn->get_agent('resources')->get_resourcec('_sessions',$this->env->phpdac_ip,$this->env->phpdac_port);
			$ret = unserialize($sret);
		}
		else 
		{ 	
			//get session from this agentds daemon
			$titles = array("Host", "Port", "On\t", "First", "Prompt\t", "Echo", "Silent");
			$ret = $this->dmn->show_connections($titles);
	  
			//save in resources
			//$this->env->agn->get_agent('resources')->set_resource('_sessions',serialize($ret));		  
		}
	  
		if ($show) 
		{
			if (!empty($ret)) 
			{
				//print out
				foreach ($ret as $session)
					$out .= implode("-",$session). "\r\n";	  
			}  
			return ($out);  
		}
		else
			return ($ret);	
    }	
	
	public function listen() 
	{ 	  
		//listen
		$this->dmn->listen(1); 	
		
		return true;	
	}
	
	public function dispatch($command_line,$id) 
	{ 	  
		//dispatch
		$this->dmn->dispatch($command_line,$id); 	
		
		return true;	
	}	
	
	public function Println($str=null) 
	{	
		$this->dmn->Println($str);
		return true;
	} 

	private function exebatchfile($file=null, $say=false) 
	{
	    if ((!$file) || ($file=='.ash')) $file = 'init.ash';

		/*$batchfile = getcwd() . DIRECTORY_SEPARATOR . $file; 
		if ((is_readable($batchfile)) && ($f = @file($batchfile))) 
			$fdata = file_get_contents($batchfile);
		*/
		//remote file
		$batchfile = $this->env->ldscheme . "/tier/" . $file;			
		$this->env->_say('Init batch file: ' . $batchfile, 'TYPE_DOG');	
		
		$fdata = @file_get_contents($batchfile);
		if (isset($fdata))
		{
			//if ($say)
				//$this->env->_say('Init batch file: ' . $batchfile, 'TYPE_DOG');			
		  
		    $f = explode(PHP_EOL, $fdata);
			
			if (!empty($f)) 
			{
				foreach ($f as $command_line) 
				{
					if (($cmd = trim($command_line)) && ($cmd[0]!='#')) 
					{
						//echo "-" . $command_line;
						$this->dmn->dispatch($cmd,null);
					}
				}		  
			}
			return true;	
		}
		return false;
	}		
}