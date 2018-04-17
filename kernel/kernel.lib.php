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
			
			//init proc
			$this->proc = new proc($this); //nofluent
	  
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
   	
	
   
	//TIER DISPATCHER  
   /*
	private function getdpcmemc($dpc) 
	{
		$data = null;		
		//$dpc = $this->utl->dehttpDpc($dpc); //in dmn	  

		if ($this->mem->exist($dpc))
		{
			//fetch dpc   
			list($offset, $length, $free, $rlength) = $this->mem->get($dpc);

			//dpc and streams that exists in data (after shmax_id) area only
			if ($offset >= $this->mem->shmmax()) 
			{
				//SQL
				if (substr($dpc,0,7)==='select-') 
				{
					if ((!$this->scheduler->findschedule($dpc)))		
					{
						$pdodpc = str_replace('-',' ',$dpc);
						foreach(self::$pdo->query($pdodpc, PDO::FETCH_ASSOC) as $row) 
							$_data[] = $row;

						$data = json_encode($_data);
						_say($data,3); //show new data
					}
					else 
					{
						$data = null; //bypass and read
						$this->cnf->_say('Scheduled PDO stream:' . $dpc, 'TYPE_LION');
						_say($data,3);
					}
				}
				elseif (substr($dpc,0,4)==='www.') //WWW
				{
					if (!$this->scheduler->findschedule($dpc)) 
					{
						$data = $this->utl->httpcl($dpc);
						_say($data,3); //show new data
					}
					else 
					{
						$data = null; //bypass and read
						$this->cnf->_say('Scheduled data stream:' . $dpc, 'TYPE_LION');
						_say($data,3);
					}	
				}
				elseif (@is_readable($this->dpcpath . $dpc)) //FILE 
				{
					//local storage reload  
					$sf = @filesize($this->dpcpath . $dpc);
					$this->cnf->_say("Size:" . $rlength .':' . $sf, 'TYPE_RAT');
					if ($rlength != $sf) {
						$data = $this->fs->_readPHP($this->dpcpath . $dpc); 
						_say($data,3); 
					}	
					else
						$data = null; //bypass and read
				}
				else  { //variable
					$this->cnf->_say('reading variable: '. $dpc, 'TYPE_BIRD');	
					$data = null ;//bypass and read
				}

				if (isset($data)) //update 
				{ 			
					$dataLength = strlen($data); 
					$remaining = $length - $dataLength;
					
					if (($offset = $this->mem->upd($dpc, $remaining, $data)) &&	
						($this->mem->writeSH($data, $offset)))
					{
						$this->cnf->_say("$dpc updated!",'TYPE_LION');
						_dump("UPDATE\n\n\n\n" . $data);
					}
					else
					{
						_dump("MEM-ERROR\n$dpc\n$remaining\n".strlen($data)."\n" . $data, 'w', '/dumpmem-error-'.$_SERVER['COMPUTERNAME'].'.log');
						die($dpc . " (savedpcmem update remain page space: $remaining) error, increase extra space!" . PHP_EOL); 
					}	
					
				}//if data
			}
			//else.. read mem and continue
			$data = $this->mem->readSH($dpc);
			    
			$this->cnf->_say("reading $dpc :" . strlen($data), 'TYPE_RAT');
		}
		else //NEW
		{ 
			if (substr($dpc,0,7)==='select-') //PDO
			{   
				if ((!$this->scheduler->findschedule($dpc)) )
				{
					$pdodpc = str_replace('-',' ',$dpc);
					foreach(self::$pdo->query($pdodpc, PDO::FETCH_ASSOC) as $row) 
						$_data[] = $row;

					$data = json_encode($_data);
				}
				else
					$data = null; //bypass		
			} 	
			elseif (substr($dpc,0,4)==='www.') //WWW 
			{
				$data = (!$this->scheduler->findschedule($dpc)) ?
						$this->utl->httpcl($dpc) : null; //bypass			
			}	
			elseif (is_readable($this->dpcpath . $dpc)) //FILE
			{

				//local storage
				$data = $this->fs->_readPHP($this->dpcpath . $dpc); //dump inside
			}
			else 
			{   //VAR
				//create var
				$this->cnf->_say($this->dpcpath . $dpc . ' not found!', 'TYPE_LION');	
				
				//MUST BE POOLED
				if ($async = $this->proc->set($dpc) > 0) 
				{
					$this->cnf->_say('set async variable for processing:' . $dpc, 'TYPE_LION');
					//..open client at async class
					exec("start /D d:\github\phpdac7\bin agentds process");
					//..data write
					//re-save chain (remove)
				}
				else {	
					$this->cnf->_say('set sync variable for processing:' . $dpc, 'TYPE_LION');
					
					//proceed at once
					if ($dataNOWRITE = $this->proc->go()) {
						//print_r($this->proc->getProcessStack());
						//echo implode(',', $this->proc->getProcessChain()) . ' finished!' . PHP_EOL; 
						$this->cnf->_say(implode(',', $this->proc->getProcessChain()) . ' finished', 'TYPE_LION');
					}	
				}
				
			
				//open client to proceess(s) 
				//-pool check and reply based on client response..
			}	
		
			if (!$data) return false;	
			_say($data,3);		
		
			$dataLength = strlen($data);		

			if (($offset = $this->mem->set($dpc, $dataLength, $data)) &&
				($this->mem->writeSH("\0". $data ."\0", $offset)))
			{
				//save dump-tree for any use (phar creation etc)
				_dump("\0". $data ."\0" ,'a+', '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
				
				$this->cnf->_say("$dpc saved!",'TYPE_LION');
				_dump("INSERT\n\n\n\n" . $data);
			}
			else
			{		
				_dump("MEM-ERROR\n$dpc\noffset: $offset\nlength: ".strlen($data)."\n" . $data, 'w', '/dumpmem-error-'.$_SERVER['COMPUTERNAME'].'.log');		
				die($dpc . " (getdpcmemc save offset:$offset) error, increase data space!" . PHP_EOL);
			}	
		
			$this->cnf->_say("New $dpc : " . strlen($data), 'TYPE_RAT');		
		}
	  
		return ($data);	      
	}*/

	//alias
	public function _main($dpc) 
	{
		//return $this->getdpcmemc();
		return $this->mem->readC($dpc);
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

    public function show_schedules() 
	{
		$sh = $this->scheduler->showschedules();
		//echo 'save::::::::::::::::::::;';
		//print_r($sh);
		$this->mem->save('srvSchedules', json_encode($sh));
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
			$this->mem->save('srvSchedules', serialize($sh));//json_encode($sh));				
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
				$this->mem->save('srvState',$this->mem->getShmContents());
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

	private function shutdown($now=false) 
	{
		if ($now) die(); 
   	
		$this->cnf->_say("Shutdown....", 'TYPE_LION');
	  
		//close printer
		if (extension_loaded('printer')) {
			$printout = $this->resources->get_resource('printer');   
			if (is_resource($printout) &&
				get_resource_type($printout)=='printer')
				printer_close($printout);	  
		}
		//close mem	
		//return ($this->closememdpc()); //dustruct
    }	
   
	public function __destruct() 
	{		
		//$this->mem->free(); !!!
		
		unset($this->scheduler); //destruct
		unset($this->dmn); //destruct
		unset($this->resources); //destruct
		unset($this->proc); //destruct
		unset($this->timer); //destruct
		unset($this->mem); //destruct
		unset($this->shm); //destruct
		unset($this->fs); //destruct
		unset($this->utl); //destruct
		unset($this->cnf); //destruct
		
		//unset(self::$pdo); //err, self destruct
	}	
}
?>