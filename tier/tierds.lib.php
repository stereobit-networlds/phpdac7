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
define ('_CAT',  1);  //MEM WRITES
define ('_DOG',  2);  //SPINLOCKS / READS
define ('_LION', 4);  //MESSAGES 
define ('_RAT',  8);  //DATA
define ('_BIRD', 16); //VAR
define ('_IRON', 32); //MESSAGES
define ('_ZION', 64); //MESSAGES	
define ('_ALL', 127); //31;	
/*
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
	require_once '../vendor/webonyx/graphql-php/vendor/autoload.php';
else
	//require_once 'vendor/webonyx/graphql-php/vendor/autoload.php';
	require_once 'vendor/autoload.php';
	
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\GraphQL;
*/	
class tierds {

	public $env, $dmn, $cnf, $utl, $res, $mem, $agn;
	public $daemon_ip, $daemon_port, $daemon_type;	
  
	public $resources, $timer, $scheduler;
	public $gtk, $gtkds_conn, $window, $agentbox;  
	public $ldscheme, $verboseLevel, $argbatch;
		
	public static $ldschemeS, $pdo, $_SIG, $_APPENV, $_APPCONF;
	
	private static $timeout_counter;
	private $timeout, $uuid, $tkeys;
	
	protected $app;

	public function __construct() { 
		global $dh, $dp;
		$argc = $GLOBALS['argc'];
		$argv = $GLOBALS['argv'];
		//print_r($argv);
		
		$this->verboseLevel = GLEVEL;	  
		$this->tkeys = array('heartbeat', 'heartbrst', 'netport', 'appconf', 'appinfo');
		
		//PCNTL SIGNALS
		$this->installSIG();	
		
		//REMOTE APP CONF
		self::$_APPENV = null;
		self::$_APPCONF = null;
		
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
					$this->cnf = $this->zooConf(); //new Config(Config::TYPE_ALL & ~Config::TYPE_DOG & ~Config::TYPE_CAT & ~Config::TYPE_RAT);		
					$this->cnf->_say('Load conf', 'TYPE_DOG');
					require_once($this->ldscheme . "/kernel/utils.lib.php");
					$this->utl = new utils($this); //utils	
					$this->cnf->_say('Load utils', 'TYPE_DOG');
					
					//client res (no shm agent for resources)
					require_once($this->ldscheme . "/tier/res.lib.php");
					$this->res = new res($this); 	
					$this->cnf->_say('Load resource handler', 'TYPE_DOG');
		
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
							$this->cnf->_say('Agents init error!', 'TYPE_DOG');							
  
						//initialize GTk connector (for calling proc from this ($env) class ...purposes)
						$this->gtk = ($argv[4]==='-gtk') ? true : false;
						if ($this->gtk) 
						{
							require($this->ldscheme . "/tier/gtklib.lib.php");  			  
							$this->cnf->_say("GTK connector loaded!", 'TYPE_DOG');
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
		//connections
		$conn = $this->dmn->show_connections($show,$dacserver);
		
		//set timeout inc by 1, when called as proc
		$this->set_timeout();
		
		return ($conn);
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
		
		$this->_say("Timeout ({$this->uuid}):" . self::$timeout_counter, 'TYPE_BIRD');
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
		
		$this->_say("Heartbeat ({$this->uuid}):" . self::$timeout_counter . '/' . _TIMEOUT, 'TYPE_DOG');
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
	
	//reset the heartbeat (url/cmd)
	public function heartbrst($args=null)
	{
		$h = $this->set_timeout_counter(1);
		$this->_say('heartbeat reset:'. $h , 'TYPE_BIRD');
		return null;//$h; //<<<< not return 1 to browser
	}
	
	//reset the heartbeat (daemon cmd reply)
	public function setHeartbeat() 
	{
		return $this->heartbrst();
	}
	
	//get the heartbeat (url/cmd)
	public function heartbeat($args=null)
	{
		$h = self::$timeout_counter;
		$this->_say('heartbeat reply:'. $h , 'TYPE_BIRD');
		return null;//($h); //<<<< not return 1 to browser
	}

	//get the heartbeat (daemon cmd reply)
	public function getHeartbeat() 
	{
		return $this->heartbeat();
	}	
	
	//get umon port
	public function netport($args=null)
	{
		$port = $this->umonPort();
		$this->_say('netport reply:'. $port , 'TYPE_CAT');
		return ($port);
	}	
	
	
	
	//REMOTE APP
	
	//phpdac7 file sends env array 
	//tier read env and save, read config and save
	private function appconf($env=null)
	{
		if (!$env) return false;
		if (!empty(self::$_APPENV)) return null;//true;
		
		$_env = implode('-', $env);
		//$this->_say('App env:'. $_env , 'TYPE_IRON');
		
		self::$_APPENV = unserialize($_env);
		//print_r(self::$_APPENV);
		
		require($this->ldscheme . '/tier/app.lib.php');
		$this->app = new app($this, self::$_APPENV);
		
		/*
		if (empty(self::$_APPENV)) 
		{
			$this->_say('App environment not found!' , 'TYPE_LION');
			return false;
		}	
		else
			$this->_say('App environment loaded!' , 'TYPE_IRON');
		
		//save app config
		$this->appIni(self::$_APPENV['cppath']);
		
		//re-init connection to db
		if ($this->reInitPDO()==true)
			$this->cnf->_say("PDO connection: ok!" , 'TYPE_IRON');
			
		return null;//true;*/
	}

	//cmd tier respond
	public function appinfo()
	{
		if (is_object($this->app))
			return $this->app->appInfo();
	}
	
	//READS / RESOURCES
	
	public function iscmd($k=null)
	{
		if (!$k) return false;
		
		return in_array($k, $this->tkeys);
	}	
	
	//alias - remote read (phpdac7)
	public function readC($dpc=null) 
	{	
		if (!$dpc) return false;
		
		//$this->_say('dpc: '. $dpc, 'TYPE_IRON');
		
        /*if ($pos = strpos($dpc, "\r\n\r\n"))
		//if ($pos = strstr($dpc, 'socket.io'))	
        {
			$this->_say('pos: '. $pos, 'TYPE_CAT');
			return "HTTP/1.1 400 bad request\r\n\r\nheader too long";
		}*/
		if ($dpc[0]=='{') {
/*			echo 'graphQL:' . $dpc . PHP_EOL;
			//$this->_say('GraphQL: '. urldecode($dpc), 'TYPE_CAT');
			//return "HTTP/1.1 400 bad request\r\n\r\nheader too long";
			
try {
    $queryType = new ObjectType([
        'name' => 'Query',
        'fields' => [
            'echo' => [
                'type' => Type::string(),
                'args' => [
                    'message' => ['type' => Type::string()],
                ],
                'resolve' => function ($root, $args) {
                    return $root['prefix'] . $args['message'];
                }
            ],
        ],
    ]);

    $mutationType = new ObjectType([
        'name' => 'Calc',
        'fields' => [
            'sum' => [
                'type' => Type::int(),
                'args' => [
                    'x' => ['type' => Type::int()],
                    'y' => ['type' => Type::int()],
                ],
                'resolve' => function ($root, $args) {
                    return $args['x'] + $args['y'];
                },
            ],
        ],
    ]);

    // See docs on schema options:
    // http://webonyx.github.io/graphql-php/type-system/schema/#configuration-options
    $schema = new Schema([
        'query' => $queryType,
        'mutation' => $mutationType,
    ]);

    $rawInput = $dpc; //'{"query":"mutation{sum(x:2,y:2)}"}'; //file_get_contents('php://input');
    $input = json_decode($rawInput, true);
    $query = $input['query'];
    $variableValues = isset($input['variables']) ? $input['variables'] : null;

    $rootValue = ['prefix' => 'You said: '];
    $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
    $output = $result->toArray();
} catch (\Exception $e) {
    $output = [
        'error' => [
            'message' => $e->getMessage()
        ]
    ];
}
//header('Content-Type: application/json; charset=UTF-8');
return json_encode($output);	
*/
		}	
		else
		{
			//dispatch cmds (no shm cmds)
			$keycmd = strstr($dpc, '-') ? explode('-', $dpc) : $dpc;
			$cmd = is_array($keycmd) ? array_shift($keycmd) : $keycmd;
			if ($this->iscmd($cmd))
			{
				$this->_say('read key: '. $cmd, 'TYPE_CAT');
			
				if (method_exists($this, $cmd))
				{	
					return $this->$cmd($keycmd); //rest of array
				}	
				else
					$this->_say('unknown method for key: '. $cmd, 'TYPE_LION');
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

	//init db connection based on a default db
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
	/*
	//re-init db connection based on app db
	private function reInitPDO() 
	{
		//if (!$dbcon = @file_get_contents(self::$ldschemeS . "/kernel/dbcon.db"))
		if (empty(self::$_APPCONF))	
		{
			$this->cnf->_say("App connection failed!", 'TYPE_LION');
			return false;
		}
		//'mysql:host=localhost:3306;dbname=admin_pangr;charset=utf8<@>panik<@>fxpower77'
		//$_DBCON = explode('<@>', $dbcon);
		
		try 
		{
			//self::$pdo = @new PDO('mysql:host=localhost:3306;dbname=admin_pangr;charset=utf8', 'panik', 'fxpower77');
			$con = trim(self::$_APPCONF['DATABASE']['dbname']);
			$usr = trim(self::$_APPCONF['DATABASE']['dbuser']);
			$pas = trim(self::$_APPCONF['DATABASE']['dbpwd']);
			self::$pdo = @new PDO("mysql:host=localhost:3306;dbname=$con;charset=utf8", $usr, $pas);
			
			$this->cnf->_say("App db connection $usr@$con ok!", 'TYPE_IRON');
			return true;
	    } 
		catch (PDOException $e) 
		{
			$this->cnf->_say("App failed to get DB handle: " . $e->getMessage(), 'TYPE_LION');
        }
		return false;	
	}	
	*/
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
    /*
    private function pdoTest()
	{
		$start = microtime(true);
		
		$sql = "SELECT * 
          FROM users
         WHERE notes = :notes";
         
		$notes = 'ACTIVE';

		$statement = self::$pdo->prepare($sql);
		$statement->bindParam(':notes', $notes, PDO::PARAM_STR);
		$statement->execute();

		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
		$rcount = count($rows);
		
		foreach ($rows as $row) {
			echo $row['email'] . PHP_EOL;
		}
		$tm = (microtime(true) - $start);
		$this->_say("PDO microtime ($rcount) :" . $tm, 'TYPE_LION');
	}*/
   
	private function destroy() 
	{
		if ($this->gtk) 
			Gtk::main_quit();
	} 	

    public function shutdown($now=false) 
	{
		//_say("Shutdown " . $now, 1);
		$this->cnf->_say('Shutdown ' . $now, 'TYPE_IRON');	 
		
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

	
	//ZOO CONF MESSAGES
	protected function zooConf($zooconf = null)
	{
		//return new Config(Config::TYPE_ALL & ~Config::TYPE_DOG & ~Config::TYPE_CAT & ~Config::TYPE_RAT);
		
		$zoo = $zooconf ? $zooconf : _ALL & ~_DOG & ~_CAT & ~_RAT;
		//_tverbose('[----]' . $zoo . PHP_EOL);
		//return new Config($zoo);
		
		//ERR if (!$zconf = @file_get_contents(self::$ldschemeS . "/kernel/zoo.conf"))
		$_zc = getcwd() . "/tier/zoo.conf";
		if (!$zconf = trim(@file_get_contents($_zc)))	
		{
			_tverbose('[----]' . $zoo . PHP_EOL);
			return new Config($zoo);
		}
			
		_tverbose('[----]' . $zconf . PHP_EOL);
		return new Config(eval("return $zconf;"));
	}

	//save zoo cnf (daemon cmd reply)
	public function setZooConf($conf=null)
	{
		$_zc = getcwd() . "/tier/zoo.conf";
		if (!$conf) return 'Zoo conf:' . file_get_contents($_zc);
		
		if (copy($_zc, $_zc . '.bak')) 
		{
			if (file_put_contents($_zc, $conf)) 
			{
				$this->_say('Zoo Conf:'. $conf . ' saved!', 'TYPE_IRON');
				return 'Zoo conf:' . file_get_contents($_zc);
			}
		}
		$this->_say('Zoo Conf:'. $conf . ' NOT saved!', 'TYPE_IRON');
		return 'Zoo conf:' . file_get_contents($_zc);
	}
	
	
	//SIGNALS
	
	protected function installSIG() 
	{
		if (!function_exists('pcntl_signal'))
		{
			_tverbose("[----]WARNING: you need to enable the pcntl extension". PHP_EOL);
			//exit(1);
			self::$_SIG = false;
		}
		else
		{	
			self::$_SIG = true;
			_tverbose("[----]Installing signals handler..." . PHP_EOL);
			
			pcntl_signal(SIGINT, array($this,'sig_handler')); //ctrl-c
			pcntl_signal(SIGTERM, array($this,"sig_handler"));
			pcntl_signal(SIGHUP,  array($this,"sig_handler"));
			pcntl_signal(SIGUSR1, array($this,"sig_handler"));
			
			return true;
		}		
		
		return false;
	}	
	
	//SIGNALS HANDLER
	public function sig_handler($signo)
	{
		switch ($signo) {
			case SIGINT: 
						// handle ctrl-c
						//exit;
						_tverbose("[----]Caught SIGINT..." . PHP_EOL);
						
						$this->umonDestroy(); //destroy umon (if any, uuid session)
						$this->shutdown(true);
						
						break;		
						
			case SIGTERM:
						// handle shutdown tasks
						//exit;
						_tverbose("[----]Caught SIGTERM..." . PHP_EOL);
						
						$this->umonDestroy(); //destroy umon (if any, uuid session)
						$this->shutdown(true);
						
						break;
						
			case SIGHUP:
						// handle restart tasks
						_tverbose("[----]Caught SIGHUP..." . PHP_EOL);
						
						$this->umonDestroy(); //destroy umon (if any, uuid session)
						$this->shutdown(true);
						
						break;
						
			case SIGUSR1:
						_tverbose("[----]Caught SIGUSR1..." . PHP_EOL);
						break;
						
			default:
						// handle all other signals
						/*
1) SIGHUP       2) SIGINT       3) SIGQUIT      4) SIGILL
5) SIGTRAP      6) SIGABRT      7) SIGBUS       8) SIGFPE
9) SIGKILL      10) SIGUSR1     11) SIGSEGV     12) SIGUSR2
13) SIGPIPE     14) SIGALRM     15) SIGTERM     16) SIGSTKFLT
17) SIGCHLD     18) SIGCONT     19) SIGSTOP     20) SIGTSTP
21) SIGTTIN     22) SIGTTOU     23) SIGURG      24) SIGXCPU
25) SIGXFSZ     26) SIGVTALRM   27) SIGPROF     28) SIGWINCH
29) SIGIO       30) SIGPWR      31) SIGSYS      34) SIGRTMIN
35) SIGRTMIN+1  36) SIGRTMIN+2  37) SIGRTMIN+3  38) SIGRTMIN+4
39) SIGRTMIN+5  40) SIGRTMIN+6  41) SIGRTMIN+7  42) SIGRTMIN+8
43) SIGRTMIN+9  44) SIGRTMIN+10 45) SIGRTMIN+11 46) SIGRTMIN+12
47) SIGRTMIN+13 48) SIGRTMIN+14 49) SIGRTMIN+15 50) SIGRTMAX-14
51) SIGRTMAX-13 52) SIGRTMAX-12 53) SIGRTMAX-11 54) SIGRTMAX-10
55) SIGRTMAX-9  56) SIGRTMAX-8  57) SIGRTMAX-7  58) SIGRTMAX-6
59) SIGRTMAX-5  60) SIGRTMAX-4  61) SIGRTMAX-3  62) SIGRTMAX-2
63) SIGRTMAX-1  64) SIGRTMAX
						*/
		}
	}	
	
}