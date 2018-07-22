<?php
error_reporting(E_ALL & ~E_NOTICE);

define ("GLEVEL", 1); 		//main messaging level 
define ("KERNELVERBOSE", 1);//override daemon VERBOSE_LEVEL 1/2
define ("_DS_", DIRECTORY_SEPARATOR);
define ("_MACHINENAME", ((strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? 'WINMS' : 'LINMS'));
define ("_DUMPFILE", 'dumpsrv-'. _MACHINENAME . '.log');
define ("_UMONFILE", '/tier/umon-'. _MACHINENAME . '-');
define ("_BELL", "\007");
	
require_once("system/timer.lib.php");
//require_once("kernel/sresc.lib.php");
require_once("kernel/cnf.lib.php");
require_once("kernel/mem.lib.php");
require_once("kernel/shm.lib.php");
//require_once("kernel/buf.lib.php");
require_once("kernel/kfs.lib.php");
require_once("kernel/dmn.lib.php");
require_once("kernel/utils.lib.php");
require_once("kernel/var.lib.php");
require_once("kernel/proc.lib.php");
require_once("kernel/imo.lib.php");
require_once("kernel/sch.lib.php");
require_once("kernel/umon.lib.php");
//require_once("agents/resources.lib.php");

    //srv ver, before load cnf
	function _sverbose($str=null)
	{
		if (KERNELVERBOSE > 0)
			echo $str;
	}

class kernel {
	
	private $timer, $saveSrvState;
	private $process, $processStack, $startProcess;	
		
    public $dmn, $daemon_ip, $daemon_port, $daemon_type;
	public $cnf, $fs, $utl, $sch, $umon;
	public $dpcpath, $resources;

	public static $pdo;	
   
	public function __construct($dtype=null,$ip='127.0.0.1',$port='19123') 
	{  
		$argc = $GLOBALS['argc'];
		$argv = $GLOBALS['argv'];
		
		$this->saveSrvState = true; 
		
		$this->cnf = new Config(Config::TYPE_ALL & ~Config::TYPE_BIRD & ~Config::TYPE_DOG & ~Config::TYPE_CAT & ~Config::TYPE_RAT);		
	  
		$this->utl = new utils($this); //utils
		$this->utl->grapffiti(1);	
	  
		$this->dpcpath = isset($argv[1]) ? ((substr($argv[1],0,1)!='-') ? $argv[1] . '/' : './') : './'; //getcwd().'/' php7
	    $this->fs = new kfs($this, $this->dpcpath); //filesystem
		
		$this->daemon_type = isset($argv[1]) ? ((substr($argv[1],0,1)=='-') ? substr($argv[1],1) : '') : '';
		$this->daemon_ip = isset($argv[2]) ? $argv[2] : '127.0.0.1';
		$this->daemon_port = isset($argv[3]) ? $argv[3] : '19123';
	  	  
		$this->cnf->_say("Daemon repository at $this->daemon_ip:$this->daemon_port", 'TYPE_LION');
	  
		//REGISTER PHPRES (client side,resources) 		 
		/*$phpdac_c = stream_wrapper_register("phpres5","c_resstream");
		if (!$phpdac_c) $this->cnf->_say("Client resource protocol failed to registered!" , 'TYPE_LION');
					else $this->cnf->_say("Client resource protocol registered!", 'TYPE_RAT'); 	  
	     */
		//start buf / shmem	
		$this->shm = new shm($this); //buf
		$this->mem = new mem($this);
		if ($this->mem->initialize())
		{	
			//clear log
			@unlink('dumpmem-'. _MACHINENAME .'.log');
			  
			//init timer
			$this->timer = new timer($this);
			
			//init resources
			/*$this->resources = new resources($this);
			$this->resources->set_resource('variable','myservervalue');	  
			$this->resources->set_resource('srvName','kernelv2');//agent use on process?	
			*/
			//init printer	  
			self::initPrinter();
			//init db
			self::$pdo = null;	
			if (self::initPDO())
				$this->cnf->_say("PDO connection: ok!" , 'TYPE_IRON');
			
			//init umonitor
			$this->cnf->_say("uMonitor start", 'TYPE_LION');			
			$this->umon = new umon($this);
			$this->umon->checkPorts();			
			
			//init scheduler
			$this->sch = new scheduler($this);
			if ($this->sch->loadmem==false) // not loaded from shmem
			{   
				$this->sch->schedule('env.scheduleprint','every','20');	  
				$this->sch->schedule('env.internalClient','every','50');	  		  
				//$this->sch->schedule('env.show_connections','every','20');		  	  		  
				
				$this->cnf->_say("New Scheduler", 'TYPE_LION');
			}
			else
			{
				$this->cnf->_say("Loading schedules from mem", 'TYPE_LION');
				//print_r(json_decode($this->read('srvSchedules'), true));
			}	

			//init daemon
			if ($this->dmn = new dmn($this, /*daemonize this*/
								 $this->daemon_type,
								 $this->daemon_ip,
								 $this->daemon_port))
			{
				//dispatch batch, before listen
				$this->exebatchfile('kernel.ash', true);

				//listen, now	
				$this->dmn->listen();
			}	
		}
		else 
		{
			$this->cnf->_say('Memory critical error!', 'TYPE_LION');
			$this->shutdown(true);
		}	  
	}		
	  
    //return pseudo pointer for comaptibility with agentds class
    public function get_agent($agent,$serialized=null) 
	{
		return $this;	   
    }
   
    //return pseudo pointer for compatibility with agentds class   
    public function update_agent(&$o_agent,$agent) 
	{
		return true;
    }       
	

	//RUNTIME
	
    private function _gc($ret)
	{
		//echo PHP_EOL . $ret .PHP_EOL . PHP_EOL;
		return ($ret);
	}
   
	//alias - remote read
	public function readC($dpc) 
	{
		//return $this->_gc($this->mem->readC($dpc));
		return $this->mem->readC($dpc);
	}
	
	//alias - local read
	public function read($dpc) 
	{
		//echo "SERVER READ ($dpc):" . $this->mem->read($dpc) . "---->" . PHP_EOL;
		return $this->mem->read($dpc);
	}		
	
	//mem save interface
	public function save($var, $value=null)
	{
		//echo "SERVER SAVE ($var):" . $value . "---->" . PHP_EOL;
		return $this->mem->save($var, $value);
	}	
	
	public function setvar($var=null)	
	{
		if (!$var) return false;
		$this->cnf->_say("Set var: " . $var, 'TYPE_LION');
		
		$set = false;
		$pv = explode('-', $var);
		//0=setvar, 1=async, 2=variable(srvProcessStack), 3=value(json encoded)
		switch ($pv[1])
		{
			case 'async' : 	//a tier responds
							$cmd = isset($pv[2]) ? $pv[2] : null;
							if ($cmd)
							{
								switch ($pv[2])
								{
									case 'srvProcessStack' : 
									$reduce = isset($pv[3]) ? json_decode($pv[3], true) : null;
									$set = (new proc($this))
												->reduce($reduce)
												->go();
									break;
									
									default :	
								}	
							}
							break;
			case 'sync'  :
			default      :	
		}
		
		return $set;
	}	

    public function show_schedules() 
	{
		$sh = $this->sch->showschedules();
		return 'env.show_schedules';
    }	
	
	//call from mem when variable asked async
	public function openProcess($batch=false, $var=false)
	{
		$cwd = getcwd();
		//echo 'working dir:' . $cwd;
		
		//exec("start /D d:\github\phpdac7\bin agentds $batch"); //process
		
		//exec("start /D $cwd\\tier tier $batch"); //...
		//exec("start /D $cwd tier $batch"); //...
		
		//echo $cwd . "\bin\createprocess.exe php tier/tier.dpc.php $batch";
		//exec($cwd . "\bin\createprocess.exe php tier/tier.dpc.php $batch");
		//exec("start /D $cwd\\tier tierp.bat $batch"); //createprocess.exe in phpdac7/ptier
		//exec("$cwd\\tier\\tierp.bat pdo"); //!!! insilenent, createprocess.exe in phpdac7
		
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			exec("start /D $cwd\\tier tierp.bat $batch"); //createprocess.exe in phpdac7/ptier
			//!!exec("createprocess.exe /w=2000 /term /f=CREATE_NEW_CONSOLE tier.bat pdo"); //!!!
		}
		else {//require screen gnu package
			//exec("screen /usr/local/php727/bin/php $cwd/tier/tier.dpc.php");	
			
			//screen -S NameOfScreen -d -m 'php -f sniper.php > results.html'
			//screen -S TIER001 -d -m './start.sh'
			exec("screen $cwd/tier.sh $batch");	
		}	
		
		return true;
	}
	
	public function internalClient($set=false) 
	{
		$batch = $set ? $set : '';//pdo
		
		//https://blogs.technet.microsoft.com/systemcenteressentials/2009/09/01/using-psexec-to-open-a-remote-command-window/
		//psExec \\computer cmd		
		
		//start a client (auto)
		//exec("start /D d:\github\phpdac7\bin agentds pdo");// -inetd");
		
		//exec("start /D c:\xampp-phpdac7\bin agentds pdo"); //php 7 !!!
		//powershell (can ret value /pipes ) 
		//$ret = 
			//shell_exec("start powershell.exe -executionPolicy Unrestricted -NoExit -Command c:\xampp-phpdac7\php.exe agents\agentds.dpc.php pdo");
		
        /*
			C:\Windows\System32\WindowsPowerShell\v1.0\powershell.exe -InputFormat none -File file.ps1
			
		*/	
		
		//DUMP MEM FOR UPDATE/SAVE PURPOSES
		$this->cnf->_say('--------------- MEM DUMP ---------------', 'TYPE_LION');
		_dump($this->mem->dumpMem() ,'w', '/dumpmem-tree-'. _MACHINENAME .'.log');
		
		//return ($ret);		
	}

    public function scheduleprint() 
	{	
		//$this->cnf->_say("SERVER print", 'TYPE_LION');
		//printer_write($this->resources->get_resource('printer'), "SERVER print"."\n\r");  
		
		$this->dmn->show_connections();
		$this->show_schedules();
		$this->utl->grapffiti(); //grpahixs on
				
		$tb = $this->mem->calc(); //calc
	    $this->cnf->_say("Total buffer : ". $this->utl->convert($tb) . 
						', mem usage: ' .	$this->utl->convert(memory_get_usage()), 
						'TYPE_IRON');
						
		$this->mem->checkMem(false); //mem check on (silent)
		$this->mem->showGC(); //show gc
		//$this->fs->hView(); //show hash table		
		
		//save state
		if ($this->saveSrvState===true) 		
			$this->save('srvState',$this->mem->getShmContents());							
		
		return true;
    } 
	
	//PRINTER
	
    private function prn($message=null,$doctitle=null) 
	{
		if (!$message) return false;
		
		//$pr = $this->resources->get_resource('printer');
		if (is_resource($pr) &&
			get_resource_type($pr)=='printer') 
		{
			printer_start_doc($pr, $doctitle);	  
			printer_write($pr,$message."\n\r");  	 
			//printer_end_doc($pr, $doctitle); //double print 0 bytes when enabled !!!!
			$this->cnf->_say($message, 'TYPE_LION');
			return true;
		}
	  
		$this->cnf->_say("printing error!", 'TYPE_LION'); 
		return false;	
    }	
	
	private function initPrinter() 
	{
		if (extension_loaded('printer')) {
			//$printer = "FinePrint pdfFactory Pro";
			$printer = "\\\http://{$this->daemon_ip}\\e-Enterprise.printer";
			$printout = @printer_open($printer);//true;
			if (is_resource($printout) &&
				get_resource_type($printout)=='printer') 
			{  
				printer_set_option($printout, PRINTER_MODE, 'RAW'); 
				//$this->resources->set_resource('printer',$printout);
				$this->cnf->_say("printer:" . $printer . " connected.", 'TYPE_LION');
				//printer_close($printout);
			}
			else
				$this->cnf->_say("printer:" . $printer . " error: Could not connect!", 'TYPE_LION');  
		}
	}	

	//PDO
	
	private static function initPDO() 
	{
		try 
		{
			//$dbh = new PDO('sqlite:memory:');	
			self::$pdo = @new PDO('mysql:host=localhost;dbname=basis;charset=utf8', 'e-basis', 'sisab2018');
			return true;
	    } 
		catch (PDOException $e) 
		{
            $this->cnf->_say("Failed to get DB handle: " . $e->getMessage(), 'TYPE_LION');
        }
		return false;	
	}

	public static function pdoConn()
	{
        return self::$pdo;
    }

	//real db connect (server)
	public function pdoQuery($dpc)
	{
		if (!is_resource(self::$pdo))
			self::initPDO(); //re-connect
		
		//else
		//if (is_resource(self::$pdo)) 
		if (self::$pdo)	
		{	
			$pdodpc = str_replace('-',' ',$dpc);
			foreach(self::$pdo->query($pdodpc, PDO::FETCH_ASSOC) as $row) 
				$_data[] = $row;
			
			return $_data;	
		}
		//return ;
	}

	/* NOTICE :
	After a lot of hours working with DataLink on Oracle->MySQL and PDO we (me and Adriano Rodrigues, that solve it) discover that PDO (and oci too) need the attribute AUTOCOMMIT set to FALSE to work correctly with.
	There's  3 ways to set autocommit to false: On constructor, setting the atribute after construct and before query data or initiating a Transaction (that turns off autocommit mode)	
	// First way - On PDO Constructor
	$options = array(PDO::ATTR_AUTOCOMMIT=>FALSE);
	$pdo = new PDO($dsn,$user,$pass,$options);	
	// Second Way - Before create statements
	$pdo = new PDO($dsn,$user,$pass);
	$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,FALSE);
	// or
	$pdo->beginTransaction();

    // now we are ready to query DataLinks	
	// To use DataLinks on oci just use OCI_DEFAULT on oci_execute() function;
	
	http://php.net/manual/en/pdo.query.php
	*/
	public function pdoExec($prep, $vals)
	{
		/*$entryData = array(
			'category' => $_POST['category'],
			'title'    => $_POST['title'],
			'article'  => $_POST['article'],
			 'when'     => time()
		);

		self::$pdo->prepare("INSERT INTO blogs (title, article, category, published) VALUES (?, ?, ?, ?)")
				  ->execute($entryData['title'], $entryData['article'], $entryData['category'], $entryData['when']);	
		*/	

		$this->cnf->_say("SQL Exec:". $dpc, 'TYPE_LION');		
	}	

	//UTILS
	
	//batch commands
	private function exebatchfile($file=null,$w=false) 
	{
	    if (!$file) return false;
		
		$batchfile = getcwd() . _DS_ . 'kernel' . _DS_ . $file;
		$this->cnf->_say("Init batch file: " . $batchfile, 'TYPE_LION'); 
		
		if (is_readable($batchfile)) 
		{	
			$f = @file($batchfile);
			if (!empty($f)) {
				//print_r($f);
				foreach ($f as $command_line) {
					if (trim($command_line)) {
						//echo "-" . $command_line;
						$this->dmn->dispatch(trim($command_line),null);
					}
				}			  
			}
			return true;	
		}
		
		$this->cnf->_say('Init batch file not found!', 'TYPE_LION'); 
		return false;
	}	
	
    //php 5.5
	public function getNameOfClass()
	{
		return static::class;
		//older
		return get_class($this); //__CLASS__
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

	//SHUTDOWN

	public function shutdown($now=false) 
	{
		if ($now) die(); 
   	
		$this->cnf->_say("Shutdown!", 'TYPE_LION');
	  
		//close printer
		if (extension_loaded('printer')) {
			//$printout = $this->resources->get_resource('printer');   
			if (is_resource($printout) &&
				get_resource_type($printout)=='printer')
				printer_close($printout);	  
		}

		die("");
    }	
   
	public function __destruct() 
	{	
		//$this->mem->free(); !!!
		//unregister_tick_function(array($this->scheduler,"checkschedules"),true);
		
		unset($this->umon); //destruct
		
		unset($this->sch); //destruct
		unset($this->dmn); //destruct
		//unset($this->resources); //destruct
		unset($this->timer); //destruct
		//unset($this->proc); //destruct
		unset($this->mem); //destruct
		unset($this->shm); //destruct
		unset($this->fs); //destruct
		unset($this->utl); //destruct
		unset($this->cnf); //destruct
		
		//unset(self::$pdo); //err, self destruct
		_sverbose(". " . PHP_EOL);
	}	
}
?>