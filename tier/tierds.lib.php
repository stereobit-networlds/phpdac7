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
   
class tierds {

	public $env, $dmn, $cnf, $utl, $res, $mem, $agn;
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
						require_once($this->ldscheme . "/tier/agn.lib.php");
						$this->agn = new agn($this);
						if ($this->agn->init_agents())			
						{
							//initialize task from already loaded agents (BEWARE TO LOAD THE DEFAULT AGENTS)
							if ($s = $this->agn->get_agent('scheduler'))
								$s->schedule('env.show_connections','every','20'); 
						}
						else
							$this->cnf->_say('Agents init error!', 'TYPE_LION');							
  
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
						{
							$this->uuid = $argv[4]; //uuid param
							//CTRl-C need Register shutdown function for pid file del.
							//register_shutdown_function(array($this, 'umonDestroy'));
						}	
	    
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
			//shutdown when uuid - !!	
			//if ($this->umonDestroy()) 
			$this->umonDestroy(); //not if, proc must close 	
			$this->shutdown();
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
		//manual tiers / procs has no uuid
		//if (!$this->uuid) return false; 
		
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
	public function readC($dpc=null) 
	{	
		if (!$dpc) return false;
		
		//$this->_say('dpc: '. $dpc, 'TYPE_IRON');
		
        if ($pos = strpos($dpc, "\r\n\r\n"))
		//if ($pos = strstr($dpc, 'socket.io'))	
        {
			$this->_say('pos: '. $pos, 'TYPE_IRON');
			return "HTTP/1.1 400 bad request\r\n\r\nheader too long";
		}	
		else
		{
			//dispatch cmds (no shm cmds)
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
	
	
   
	private function free_tier() 
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
		if (!$dbcon = @file_get_contents(self::$ldschemeS . "/kernel/dbcon.db"))
		{
			_tverbose("[----]Dbcon not exist, bypass.." . PHP_EOL);
			return false;
		}
		//'mysql:host=localhost:3306;dbname=admin_pangr;charset=utf8<@>panik<@>fxpower77'
		$_DBCON = explode('<@>', $dbcon);
		
		try 
		{
			//self::$pdo = @new PDO('mysql:host=localhost:3306;dbname=admin_pangr;charset=utf8', 'panik', 'fxpower77');
			$con = trim($_DBCON[0]);
			$usr = trim($_DBCON[1]);
			$pas = trim($_DBCON[2]);
			self::$pdo = @new PDO($con, $usr, $pas);

			return true;
	    } 
		catch (PDOException $e) 
		{
            _tverbose("[----]Failed to get DB handle: " . $e->getMessage() . PHP_EOL);
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
		
		$this->free_tier();
		
	  	if ($now) die();		
	  
		//close printer	 
		if (extension_loaded('printer')) {	
			$printout = $this->get_agent('resources')->get_resource('printer');   		
			if (is_resource($printout) &&
				get_resource_type($printout)=='printer')
				printer_close($printout);
		}	
		
		//unset(self::$pdo); //err, self destruct	
		die();
		//return true;	
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