<?php
error_reporting(E_ALL & ~E_NOTICE);

define ("GLEVEL", 1); 		//main messaging level 
define ("KERNELVERBOSE", 1);//override daemon VERBOSE_LEVEL
define ("_DS_", DIRECTORY_SEPARATOR);
	
require_once("system/timer.lib.php");
require_once("kernel/sresc.lib.php");
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

require_once("agents/resources.lib.php");
require_once("agents/scheduler.lib.php");


	function _say($str, $level=0, $crln=true) 
	{
	    $cr = $crln ? PHP_EOL : null;
		if ($level <= GLEVEL)
			echo ucfirst($str) . $cr;
		
		_dump(date ("Y-m-d H:i:s :").$str.PHP_EOL,'a+','/dumpsrv-'.$_SERVER['COMPUTERNAME'].'.log');
	}
   
	function _dump($data=null,$mode=null,$filename=null) 
	{
		$m = $mode ? $mode : 'w';
		$f = $filename ? $filename : '/dumpmem-'.$_SERVER['COMPUTERNAME'].'.log';

		if ($fp = @fopen (getcwd() . $f , $m)) 
		{
			fwrite ($fp, $data);
			fclose ($fp);
			return true;
		}
		return false;
	}    

class kernel {
	
	private $timer, $saveSrvState;
	private $process, $processStack, $startProcess;	
		
    public $dmn, $daemon_ip, $daemon_port, $daemon_type;
	public $cnf, $fs, $utl, $dpcpath, $scheduler, $resources;

	public static $pdo;	
   
	public function __construct($dtype=null,$ip='127.0.0.1',$port='19123') 
	{  
		$argc = $GLOBALS['argc'];
		$argv = $GLOBALS['argv'];
		
		$this->saveSrvState = true; //save srvState at mem resources
		
		$this->cnf = new Config(Config::TYPE_ALL & ~Config::TYPE_DOG & ~Config::TYPE_CAT & ~Config::TYPE_RAT);		
	  
		$this->utl = new utils($this); //utils
		$this->utl->grapffiti(1);	
	  
		$this->dpcpath = isset($argv[1]) ? ((substr($argv[1],0,1)!='-') ? $argv[1] . '/' : './') : './'; //getcwd().'/' php7
	    $this->fs = new kfs($this, $this->dpcpath); //filesystem
		
		$this->daemon_type = isset($argv[1]) ? ((substr($argv[1],0,1)=='-') ? substr($argv[1],1) : '') : '';
		$this->daemon_ip = isset($argv[2]) ? $argv[2] : '127.0.0.1';
		$this->daemon_port = isset($argv[3]) ? $argv[3] : '19123';
	  	  
		$this->cnf->_say("Daemon repository at $this->daemon_ip:$this->daemon_port", 'TYPE_LION');
	  
		//REGISTER PHPRES (client side,resources) 		 
		$phpdac_c = stream_wrapper_register("phpres5","c_resstream");
		if (!$phpdac_c) $this->cnf->_say("Client resource protocol failed to registered!" , 'TYPE_LION');
					else $this->cnf->_say("Client resource protocol registered!", 'TYPE_RAT'); 	  
	  
		//start buf / shmem	
		$this->shm = new shm($this); //buf
		$this->mem = new mem($this);
		if ($this->mem->initialize())
		{	
			//clear log
			@unlink('dumpmem-'.$_SERVER['COMPUTERNAME'].'.log');
			  
			//init timer
			$this->timer = new timer($this);
			
			//init proc (new at mem)
			//$this->proc = new proc($this);
	  
			//init resources
			$this->resources = new resources($this);
			$this->resources->set_resource('variable','myservervalue');	  
			$this->resources->set_resource('srvName','kernelv2');//agent use on process?	
      
			//init printer	  
			self::initPrinter();
			//init db
			self::$pdo = null;	
			if (self::initPDO())
				$this->cnf->_say("PDO connection: ok!" , 'TYPE_IRON');

			//init daemon
			if ($this->dmn = new dmn($this, /*daemonize this*/
								 $this->daemon_type,
								 $this->daemon_ip,
								 $this->daemon_port))
			{
				//init scheduler
				$this->scheduler = new scheduler($this);
				//$this->scheduler->schedule('env.show_connections','every','20');		  	  		  
				$this->scheduler->schedule('env.scheduleprint','every','20');	  
				$this->scheduler->schedule('env.internalClient','every','50');	  		  
		
				//dispatch batch, before listen
				$this->exebatchfile('kernel.ash', true);
	  
				//continue shceduling after ash run, before listen
				$this->retrieve_schedules();

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
		return $this->mem->read($dpc);
	}		
	
	//mem save interface
	public function save($var, $value=null)
	{
		//echo "SERVER SAVE:" . $value . "---->" . PHP_EOL;
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
		$sh = $this->scheduler->showschedules();
		//echo 'save::::::::::::::::::::;';
		//print_r($sh);
		$this->save('srvSchedules', json_encode($sh));
		//DISABLED _dump(json_encode($sh),'w','/dumpsh-'.$_SERVER['COMPUTERNAME'].'.log');
	  
		return null;
    }	
	
    public function retrieve_schedules() 
	{	  
		//load dump
		
		//shared mem not yet !!
		if ($jsonsh = $this->mem->read('srvSchedules')) 
		{ 
			$this->cnf->_say("Loading schedules from mem", 'TYPE_LION');
			$sh = json_decode($jsonsh, true); //true = convert to array
			//print_r($sh);
			
			if ($this->scheduler->overwriteschedules($sh)) 
				$this->cnf->_say("Scheduled Ok!", 'TYPE_LION'); 
		        //!!!not ok lasttime/counter reset (review)	
			else {
				$this->cnf->_say("Scheduler Error", 'TYPE_LION');	
				print_r($sh); 
			}	
			
			return true;
		}
		/*DISABLED elseif ($jsonsh = @file_get_contents(getcwd() . '/dumpsh-'.$_SERVER['COMPUTERNAME'].'.log'))
		{	
			$this->cnf->_say("Loading schedules from dump file", 'TYPE_LION');
			$sh = unserialize($jsonsh); 
				
			//save in sh mem as resource var (not in resources)
			$this->save('srvSchedules', serialize($sh));//json_encode($sh));				
			return true;
		}*/
		 
	  
		return false;
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
		
		exec("start /D $cwd\\tier tierp.bat $batch"); //createprocess.exe in phpdac7/ptier
		
		//!!exec("createprocess.exe /w=2000 /term /f=CREATE_NEW_CONSOLE tier.bat pdo"); //!!!
		
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
		
		//return ($ret);
	}

    public function scheduleprint() 
	{	
		//$this->cnf->_say("SERVER print", 'TYPE_LION');
		//printer_write($this->resources->get_resource('printer'), "SERVER print"."\n\r");  
		
		$this->cnf->_say($this->dmn->show_connections(), 'TYPE_LION');
		$this->cnf->_say($this->show_schedules(), 'TYPE_LION');
		
		$this->utl->grapffiti(); //grpahixs on
				
		$tb = $this->mem->calc(); //calc
	    $this->cnf->_say("Total buffer : ". 
						$this->utl->convert($tb) . 
						', mem usage: ' . 
						$this->utl->convert(memory_get_usage()), 
						'TYPE_LION');
						
		$this->mem->checkMem(false); //mem check on (silent)
		$this->mem->showGC(); //show gc
		//$this->fs->hView(); //show hash table		
		
		//save table in sh mem as resource var
		if ($this->saveSrvState===true) {
			try //boo!!
			{	//(TEST OFF >15kb shmem halt)	
				$this->save('srvState',$this->mem->getShmContents());
				//$this->cnf->_say("Table saved", 'TYPE_LION');
			} 
			catch (Exception $e) {
				_say('saveSrvState Error: '.  $e->getMessage(). PHP_EOL, 1);
				//exit;
			}
		}						
		
		return true;
    } 
	
	//PRINTER
	
    private function prn($message=null,$doctitle=null) 
	{
		if (!$message) return false;
		
		$pr = $this->resources->get_resource('printer');
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
				$this->resources->set_resource('printer',$printout);
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
            _say("Failed to get DB handle: " . $e->getMessage(), 1);
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

	//SHUTDOWN

	public function shutdown($now=false) 
	{
		if ($now) die(); 
   	
		$this->cnf->_say("Shutdown!", 'TYPE_LION');
	  
		//close printer
		if (extension_loaded('printer')) {
			$printout = $this->resources->get_resource('printer');   
			if (is_resource($printout) &&
				get_resource_type($printout)=='printer')
				printer_close($printout);	  
		}

		die("");
    }	
   
	public function __destruct() 
	{	
		//$this->mem->free(); !!!
		unset($this->scheduler); //destruct
		unset($this->dmn); //destruct
		unset($this->resources); //destruct
		unset($this->timer); //destruct
		//unset($this->proc); //destruct
		unset($this->mem); //destruct
		unset($this->shm); //destruct
		unset($this->fs); //destruct
		unset($this->utl); //destruct
		unset($this->cnf); //destruct
		
		//unset(self::$pdo); //err, self destruct
		echo ". " . PHP_EOL;
	}	
}
?>