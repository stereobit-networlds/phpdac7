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
//require_once("system/daemon.lib.php");
require_once("kernel/dmnl.lib.php");

class dmn {
	
	private $env, $dmn;
	public $type, $ip, $port;
	
	public function __construct(& $env, $type, $ip, $port, $prompt=false) {
		
	  $this->env = $env;	
		
      $this->dmn = new daemon($type, true, $this->env);//$prompt);
      $this->dmn->setAddress ($ip);
      $this->dmn->setPort ($port);
      $this->dmn->Header = "PHPDAC5 Kernel v2, " . $ip . ':' . $port;

      $this->dmn->start ();  	
	  
      $this->dmn->setCommands (array ("help", "quit", "date", "shutdown","echo","silence",
	                                  "ver","use","agent","setagent","level","setlevel",
									  "getdpcmem","getdpcmemc","helo","run",
									  "print","getresource", "getresourcec", "showresources", 
									  "findresource", "findresourcec", "setresource", "delresource",
									  "checkschedules","showschedules", "setschedule", 
									  "who", "http", "netport", "***"));
      //list of valid commands that must be accepted by the server	
	  
      $this->dmn->CommandAction ("help", array($this,"command_handler")); //add callback
      $this->dmn->CommandAction ("quit", array($this,"command_handler")); // by calling 
      $this->dmn->CommandAction ("date", array($this,"command_handler")); //this routine
      $this->dmn->CommandAction ("shutdown", array($this,"command_handler"));
	  
      $this->dmn->CommandAction ("echo", array($this,"command_handler"));	  
      $this->dmn->CommandAction ("silence", array($this,"command_handler"));		  
	  
      $this->dmn->CommandAction ("ver", array($this,"command_handler"));	  
      $this->dmn->CommandAction ("use", array($this,"command_handler"));	
      $this->dmn->CommandAction ("agent", array($this,"command_handler"));
      $this->dmn->CommandAction ("setagent", array($this,"command_handler"));	  	  
      $this->dmn->CommandAction ("level", array($this,"command_handler"));
      $this->dmn->CommandAction ("setlevel", array($this,"command_handler"));
      $this->dmn->CommandAction ("getdpcmem", array($this,"command_handler"));	  
      $this->dmn->CommandAction ("getdpcmemc", array($this,"command_handler"));//client version quit after		  
      $this->dmn->CommandAction ("helo", array($this,"command_handler"));	
      $this->dmn->CommandAction ("run", array($this,"command_handler"));
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
	  $this->dmn->CommandAction ("netport", array($this,"command_handler"));	  
	  	  	  	  	  
	  $this->dmn->CommandAction ("***", array($this,"phpdac_handler"));//handle everyting else...	  
	  		
	}
	
	public function command_handler ($command, $arguments, $dmn) 
	{
	   
      switch ($command) {
        case 'HELP':
                $commands = implode (' ', $dmn->valid_commands);
                $dmn->Println ('Valid Commands: ');
                $dmn->Println ($dmn->valid_commands);
                return true;
                break;
        case 'QUIT':
		        $dmn->changePrompt();
				//only in inetd mode
				if ($this->daemon_type=='inetd') 
					$this->env->shutdown();
                return false;
                break;
        case 'DATE':
                $dmn->Println (date ("Y-m-d H:i:s"));
                return true;
                break;
        case 'SHUTDOWN':
		        $dmn->changePrompt();
                $dmn->shutdown();
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
                $dmn->Println (implode(",",$arguments).':shell script engine V0.05 on PHP'.phpversion());
                return true;
                break;				
				
        case 'USE':
		        $ret = 'myuse';
                $dmn->Println ($ret);
                return true;
                break;		
				
		case 'SETAGENT' : 
		        SetGlobal('__USERAGENT',strtoupper($arguments[0]));		
		case 'AGENT':
		        $dmn->Println('Agent is '.GetGlobal('__USERAGENT'));
                return true;
                break;
				
		case 'SETLEVEL' : 
				//$this->userLevelID = $arguments[0]; 
				//SetSessionParam("UserSecID",encode($arguments[0]));
		case 'LEVEL':
		        $dmn->Println('Level is ...');//.decode(GetSessionParam("UserSecID")));
                return true;
                break;				
				
		case 'GETDPCMEM'://server version
		        $data = $this->env->read($this->env->utl->dehttpDpc($arguments[0]));
		        $dmn->Println($data);
                return true;
                break;	
				
		case 'GETDPCMEMC'://client version
		        $dmn->setEcho(0);
				$dmn->setSilence(1); //when disabled server sends responds 'exit etc' at any call
		        $data = $this->env->readC($this->env->utl->dehttpDpc($arguments[0]));

		        $dmn->Println(trim($data));
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
				
		case 'GETRESOURCE' : //local version
		        //$dmn->setEcho(0);//echo off
				//$dmn->setSilence(1);//silence off...???
		        $resource = $this->env->resources->get_resource($arguments[0],1);
		        $dmn->Println($resource);
				//return true;
		        //return ($resource);
				return false;//and quit replied answer to agn
		        break; 
				
		case 'GETRESOURCEC' :  //client version
		        $resource = $this->env->resources->get_resourcec($arguments[0],$arguments[1],$arguments[2]);
		        $dmn->Println($resource);
				return true;
		        break;				
				
		case 'SHOWRESOURCES':
		        $r = $this->env->resources->showresources();
				$dmn->Println($r);
                return true;
                break;	
				
		case 'FINDRESOURCE':				
		case 'FINDRESOURCEC':
		        $r = $this->env->resources->findresource($arguments[0],1);
				$dmn->Println($r);
                return true;
                break;					
				
		case 'SETRESOURCE':
		        $r = $this->env->resources->set_resource($arguments[0],$arguments[1]);
				$dmn->Println($r);
                return true;
                break;											
				
		case 'DELRESOURCE':
		        $r = $this->env->resources->del_resource($arguments[0]);
				$dmn->Println($r);
                return true;
                break;						
				
		case 'CHECKSCHEDULES':
		        $c = $this->env->scheduler->checkschedules();
				$dmn->Println($c);
                return true;
                break;	
				
		case 'SHOWSCHEDULES':
		        $s = $this->env->scheduler->showschedules();
				$dmn->Println($s);
                return true;
                break;	
				
		case 'SETSCHEDULE' :
				$entry = $this->env->scheduler->schedule($arguments[0],$arguments[1],$arguments[2]);	
				$dmn->Println($entry);
				return true;
		        break;				
				
		case 'WHO':
		        $sessions = $this->show_connections(1);
				$dmn->Println($sessions);
				return true;
		        break;														
				
		case 'HTTP':
		        $data = $this->env->utl->httpcl($arguments[0],$arguments[1],$arguments[2]);
				$this->env->save($arguments[0],$data);
				$dmn->Println($data);
				return true;
		        break;	

		case 'NETPORT':
		        $data = $this->env->umon->umonPort($arguments[0]);
				$dmn->Println($data);
				return true;
		        break;					
      }
	}
	
	//phpdac command dispatcher (all *** commands)
	public function phpdac_handler($command, $arguments, $dmn) 
	{
		//create command line from daemon			
		$shell_command = $command . " " . implode(' ',$arguments);			
					
		$dmn->Println($shell_command);
		
		return true;  
	}	

    public function show_connections($show=null) 
	{
		$out = null;
		$titles = array("Host\t", "Port", "On\t", "First", "Prompt\t", "Echo", "Silent");	
		$ret = $this->dmn->show_connections($titles);
	  
		//save in resources
		//$this->env->resources->set_resource('_sessions',serialize($ret));	  
	  
		if (!$show)  return ($ret);
	  
		if (!empty($ret)) 
		{
			foreach ($ret as $session)
				$out .= implode("-",$session). PHP_EOL;	  
		}  
		
		return ($out);  
    } 	
	
	public function listen() 
	{ 	  
		//listen
		$this->dmn->listen(1); 	
		
		return true;	
	}
	
	public function Println($str=null) 
	{	
		$this->dmn->Println($str);
		return true;
	} 	
	
	//public function free()	
	public function __destruct() 
	{	
        unset($this->dmn);	
	} 	
}