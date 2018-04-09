<?php
error_reporting(E_ALL & ~E_NOTICE);

define ("GLEVEL", 1); 		//messaging level 
define ("VVAR", 0);
define ("VSHM", 1);
define ("VMSG", 1);
define ("KERNELVERBOSE", 1);//override daemon VERBOSE_LEVEL
	
require_once("system/timer.lib.php");
require_once("kernel/cnf.lib.php");
require_once("kernel/mem.lib.php");
require_once("kernel/shm.lib.php");
require_once("kernel/kfs.lib.php");
require_once("kernel/dmn.lib.php");
require_once("kernel/utils.lib.php");
require_once("kernel/proc.lib.php");

require_once("agents/resources.lib.php");
require_once("agents/scheduler.lib.php");


	function _say($str, $level=0, $crln=true) 
	{
	    $cr = $crln ? PHP_EOL : null;
		if ($level<=GLEVEL)
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

class kernelv2 {
	
	private $timer;
	private $process, $processStack, $startProcess;	
	
	//private $shm_id, $shm_max; 
	//private $dpc_addr, $dpc_length, $dpc_free;
	//private $dataspace, $extra_space;
		
    public $dmn, $daemon_ip, $daemon_port, $daemon_type;
	public $cnf, $fs, $utl, $dpcpath, $scheduler, $resources;

	public static $pdo;	
   
	function __construct($dtype=null,$ip='127.0.0.1',$port='19123') 
	{  
		$argc = $GLOBALS['argc'];
		$argv = $GLOBALS['argv'];
		
		$this->cnf = new Config(Config::TYPE_ALL & ~Config::TYPE_DOG & ~Config::TYPE_CAT & ~Config::TYPE_RAT);		
	  
		$this->utl = new utils($this); //utils
		$this->utl->grapffiti(1);	
	  
		//$this->shm_id = null;
		//$this->shm_max = 0;
		//$this->dpc_attr = array();
		//$this->dpc_length = array();
		//$this->dpc_free = array();	  	  
		//$this->extra_space = 1024 * 10; //kb //1000;// per file (shmid res inc+)
		//$this->dataspace = 1024000 * 9; //mb //90000; //sum of shmem without preinsert
		  
		$this->dpcpath = isset($argv[1]) ? ((substr($argv[1],0,1)!='-') ? $argv[1] . '/' : './') : './'; //getcwd().'/' php7
	    $this->fs = new kfs($this, $this->dpcpath); //filesystem
		
		$this->daemon_type = isset($argv[1]) ? ((substr($argv[1],0,1)=='-') ? substr($argv[1],1) : '') : '';
		$this->daemon_ip = isset($argv[2]) ? $argv[2] : '127.0.0.1';
		$this->daemon_port = isset($argv[3]) ? $argv[3] : '19123';
	  	  
		$this->cnf->_say("Daemon repository at $this->daemon_ip:$this->daemon_port", 'TYPE_LION');
	  
		//REGISTER PHPRES (client side,resources) 		
		require_once("agents/resstream.lib.php"); 
		$phpdac_c = stream_wrapper_register("phpres5","c_resstream");
		if (!$phpdac_c) $this->cnf->_say("Client resource protocol failed to registered!" , 'TYPE_LION');
					else $this->cnf->_say("Client resource protocol registered!", 'TYPE_RAT'); 	  
	  
		//start shmem	
		$this->shm = new shm($this);	
		//if ($this->startmemdpc()) 
		$this->mem = new mem($this);
		if ($this->mem->initialize())
		{	
			//clear log
			@unlink('dumpmem-'.$_SERVER['COMPUTERNAME'].'.log');
			  
			//init timer
			$this->timer = new timer($this);
			
			$this->proc = new proc($this); //nofluent
	  
			//init resources
			$this->resources = new resources($this);
			$this->resources->set_resource('variable','myservervalue');	  
			$this->resources->set_resource('srvName','kernelv2');//agent use on process?	
      
			//init printer	  
			self::initPrinter();
			//init db
			self::$pdo = null;	
			self::initPDO();

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
		
				//dispatch batch, before
				$this->exebatchfile($this->dmn, 'kernel.ash', true);
	  
				//continue shceduling after ash run, before
				$this->retrieve_schedules();

				//listen, now	
				$this->dmn->listen();
			}	
		}
		else 
		{
			$this->cnf->_say('Shared memory critical error!', 'TYPE_LION');
			$this->shutdown(true);
		}	  
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
	
	//batch commands
	private function exebatchfile(&$dmn,$file=null,$w=false) 
	{
	    if (!$file) return false;
		
		$batchfile = getcwd() . DIRECTORY_SEPARATOR . $file;
		
		if ((is_readable($batchfile)) && ($f = @file($batchfile))) {
			
			$this->env->cnf->_say('Init batch file: ' . $batchfile, 'TYPE_LION'); 
			if (!empty($f)) {
			  //print_r($f);
		      foreach ($f as $command_line) {
				if (trim($command_line)) {
					 //echo "-" . $command_line;
                     $dmn->dispatch(trim($command_line),null);
                }
		      }			  
			}
			return true;	
		}
		return false;
	}	
   
	//SHMEM DISPATCHER

	/*private function startmemdpc() 
	{   
	  $this->cnf->_say("Start", 'TYPE_LION');  

	  $data =null;
	  $reloadedData = null;
	  $reloadedDataBytes = 0;	
	  $loadFromDir = null;//'build/cpdac7/';//null; // trail /
	  
	  if ($this->shm_max = $this->loadstate($loadFromDir)) 
	  {
		//only calc bytes   
	    $calc_shm_max = $this->load_dpc_tree($data, true); 
		
		if ($calc_shm_max != $this->shm_max)
		{	
			$this->cnf->_say('Loaded data has diferrent size', 'TYPE_RAT');
			die($calc_shm_max . '-' . $this->shm_max . PHP_EOL);
		}
		$space = $this->shm_max + $this->dataspace;
		$this->cnf->_say("Re-allocate shared memory segment. $space bytes",'TYPE_CAT');
		
		//$this->shm_id = shmop_open($ikey, "c", 0644, $space);
		if ($this->shm_id = $this->shm->_shopen($space)) 
		{
			//re-load dump file
			$reloadedData = file_get_contents($loadFromDir . 'dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
			
			// Do not Check SpinLock \0 included		
			$bw = $this->shm->_shwrite($this->shm_id, $reloadedData, 0);
			// Do not dump
			//unlink(getcwd() . '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
			
			if ($bw != strlen($reloadedData)) 
				die("Couldn't write the entire length of data\n");
			//do not save state
		}
		else
			die("Couldn't create shared memory segment. System Halted.\n");		
	  }	
	  else //new start
	  {
		$this->shm_max = $this->load_dpc_tree($data); //\0 included
		//echo ">>>>>>>>>>>>>>>", $this->shm_max;
	  
		///////////////allocate dpc tree
		// Create shared memory block with system id if 0xff3
		$space = $this->shm_max + $this->dataspace;
	  
		$this->cnf->_say("Allocate shared memory segment. $space bytes",'TYPE_CAT');
		//$this->shm_id = shmop_open($ikey, "c", 0644, $space);
		$this->shm_id = $this->shm->_shopen($space);
	  
		if ($this->shm_id) 
		{
			// Do not Check SpinLock \0 included		
			$bw = $this->shm->_shwrite($this->shm_id, $data, 0);
			//init mem dump w not a+ (dump includes all 1st entries not updates)
			_dump($data ,'w', '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
		
			if ($bw != $this->shm_max) 
			{
				die("Couldn't write the entire length of data\n");
			}  
			else	
				$this->savestate();	
		}
		else
			die("Couldn't create shared memory segment. System Halted.\n");
      }
	  
	  return true; 	
	} 
   
	//save shared mem resource id and mem alloc arrays
	private function savestate() 
	{   
		$this->cnf->_say("Save state", 'TYPE_RAT');
		$data = $this->shm_max ."@^@". serialize($this->dpc_addr) . 
		                       "@^@". serialize($this->dpc_length). 
							   "@^@". serialize($this->dpc_free);
						
		//save table in sh mem as resource var..
		//at runtime loop, recursional memory err
		//$this->savedpcmem('srvState',$data); /recursion err, at timer
							
		return file_put_contents('shm.id', $data ,LOCK_EX);
	}
   
	//load shared mem resource id and mem alloc arrays
	private function loadstate($altdir=null) 
	{
	   if ($data = @file_get_contents($altdir . 'shm.id'))
	   {
			$this->cnf->_say("Load state", 'TYPE_RAT');
			if ($altdir)
				$this->cnf->_say($altdir, 'TYPE_RAT');

			//save table in sh mem as resource var (already in)
			//at runtime loop, recursional memory err
			//$this->savedpcmem('srvState',$data);	
		   
			$entries = explode('@^@', $data);
			if (is_array($entries)) {
				$this->dpc_addr = (array) unserialize($entries[1]);
				$this->dpc_length = (array) unserialize($entries[2]);
				$this->dpc_free = (array) unserialize($entries[3]);
				$this->shm_max = $entries[0];

				return ($entries[0]);
			}
	   }
	   
	   return false;
	}	
   
	private function getShmOffset() {
		$offset = 0; 
		$zeros = 0;
		
		foreach ($this->dpc_length as $_dpc=>$_size)
		{
			$offset += $_size;
			$zeros +=2; //\0...\0
		}
		$offset += $zeros; //segments x 2		   
		return ($offset); //+1 into calling function
	}
   
	// Check SpinLock
	private function checkSpinLock($dpc)
	{   
       $offset = $this->dpc_addr[$dpc] -1;
	   if ($this->shm->_shread($this->shm_id, $offset, 1) !== "\0")
		   return false;
	   
	   return true;
	}
   
	//fetch shared mem
	private function loaddpcmem($dpc) 
	{
	    $dpc = $this->utl->dehttpDpc($dpc);
	   
		if (isset($this->dpc_addr[$dpc])) 
		{
			return 
			$this->shm->_shread($this->shm_id, 
								$this->dpc_addr[$dpc], 
								$this->dpc_length[$dpc]);
        }
		return false; 	
	}   
   
	//save calls,urls etc into shared mem
	public function savedpcmem($dpc, &$data) 
	{
	   $dataLength = strlen($data); 	   
	   $dpc = $this->utl->dehttpDpc($dpc); //if it is a http call
	   
	   if (isset($this->dpc_addr[$dpc])) 
	   {
			//rewrite
			//fetch dpc   
			$offset = $this->dpc_addr[$dpc];
			$length = $this->dpc_length[$dpc]; 
			$free = $this->dpc_free[$dpc];
			$rlength = intval($length - $free);		
		     
			if (isset($data)) //replace
			{				
			  $remaining = $length - $dataLength;			  
			  $this->cnf->_say("diff:" . $rlength.':'.$dataLength, 'TYPE_RAT');
			  
			  //$oldData = $this->loaddpcmem($dpc);		
			  $oldData = $this->shm->_shread($this->shm_id, $offset, $rlength); 				
			  $hold = md5($oldData);	
			  $hnew = md5($data);// . str_repeat(' ',$remaining));
			  $this->cnf->_say("md5:" . $hold . ':'. $hnew, 'TYPE_RAT');
						
			  if ($dataLength < $length) 
			  {
					//update free space and save state
					$this->dpc_free[$dpc] = $remaining;
									    
					if ($this->checkSpinLock($dpc)===false)
						$this->cnf->_say(">>>>>>>>>>>>>>>>>>>>>>>>>>>spinlock 0:$dpc",'TYPE_DOG');		
			
			        $data .=  str_repeat(' ',$remaining);
					if ($this->shm->_shwrite($this->shm_id, $data, $offset))
					{	
						$this->savestate();
						$this->cnf->_say("$dpc saved",'TYPE_CAT');
						_dump("SAVE\n\n\n\n" . $data);
					}	
			  }
			  else
					die($dpc . " error, increase extra space!\n"); 
			
			}//if data			 
	   }
	   else { //write first time (append)
	   
			if (!$data) return false;	
			_say($data,3);
		
			$offset = $this->getShmOffset();
			
			if ((($offset+1+1) + $dataLength + $this->extra_space) < 
				($this->shm_max + $this->dataspace)) 
			{
				$this->dpc_addr[$dpc] = $offset + 1; //\0 new head			
				$this->dpc_length[$dpc] = $dataLength + $this->extra_space;
				$this->dpc_free[$dpc] = $this->extra_space;

				if ($this->checkSpinLock($dpc)===false)
					$this->cnf->_say(">>>>>>>>>>>>>>>>>>>>>>>>>>>spinlock 1:$dpc",'TYPE_DOG'); 
					
				$data .= str_repeat(' ',$this->extra_space);
				
				if ($this->shm->_shwrite($this->shm_id, "\0". $data ."\0", $offset))
				{
					_dump("\0". $data ."\0" ,'a+', '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
					
					$this->savestate();
					$this->cnf->_say("$dpc loaded",'TYPE_CAT');
					_dump("LOAD\n\n\n\n" . $data);
				}
			}
			else	
				die($dpc . " error, increase data space!");		
			     
	   }
	   
	   $this->cnf->_say("Data : " . $dataLength, 'TYPE_RAT');	   
	   return ($data);
	}    
   
	private function getdpcmem($dpc) 
	{
	  $dpc = $this->utl->dehttpDpc($dpc);
   
	  if ($data = $this->loaddpcmem($dpc))
		  $ret = $data . 
			     $this->dpc_addr[$dpc] .':'.
				 $this->dpc_length[$dpc] .':'.
				 $this->dpc_free[$dpc] ."\n";
	  else
		  $ret = "Invalid dpc!";
	  
	  return ($ret);	      
	}	*/  
   
	//client version
	public function getdpcmemc($dpc) 
	{
	  $dpc = $this->utl->dehttpDpc($dpc);
	  $data = null; 	  

      //if (isset($this->dpc_addr[$dpc])) 
	  if ($this->mem->exist($dpc))
	  {
		//fetch dpc   
		/*$offset = $this->dpc_addr[$dpc];
	    $length = $this->dpc_length[$dpc]; 
		$free = $this->dpc_free[$dpc];*/
		list($offset, $length, $free) = $this->mem->get($dpc);
		$rlength = intval($length - $free); //real length

        //echo "AAAAAAAAAAAAAAAAAAAAAA\n";
		//dpc and streams that exists in data area only
		//if ($offset >= $this->shm_max) 
		if ($offset >= $this->mem->shmmax()) 
		{
			if (substr($dpc,0,7)==='select-') 
			{
				//echo "PDO 00000000000000000000000\n";
				if (!$this->scheduler->findschedule($dpc)) 
				{
					$pdodpc = str_replace('-',' ',$dpc);
					foreach(self::$pdo->query($pdodpc, PDO::FETCH_ASSOC) as $row) {
						//$data.= json_encode($row).'@;@';
						$_data[] = $row;
					}
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
			elseif (substr($dpc,0,4)==='www.') 
			{
				//echo "111111111111111111111111\n";
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
			elseif (is_readable($this->dpcpath . $dpc)) 
			{
				//echo "222222222222222222222222\n";
				//local storage reload  
				$sf = filesize($this->dpcpath . $dpc);
				$this->cnf->_say("Size:" . $rlength .':' . $sf, 'TYPE_RAT');
				if ($rlength != $sf) {
					$data = $this->fs->_readPHP($this->dpcpath . $dpc); 
					_say($data,3); 
				}	
				else
					$data = null; //bypass and read
			}
			else  { //variable
				//_say('reading variable: '. $dpc, 1 & VVAR);	
				$this->cnf->_say('reading variable: '. $dpc, 'TYPE_BIRD');	
				$data = null ;//bypass and read
			}	
			
			if (isset($data)) //update 
			{ 			
			  $dataLength = strlen($data); 
			  $remaining = $length - $dataLength;
			  $this->cnf->_say("diff:" . $rlength.':'.$dataLength, 'TYPE_RAT');
				
			  //$oldData = $this->mem->loaddpcmem($dpc);
			  $sid = $this->mem->shmid();	
			  $oldData = $this->shm->_shread($sid, $offset, $rlength);
			  //$newData = $data;// . str_repeat(' ',$remaining);
			  
			  $hold = md5($oldData);	
			  $hnew = md5($data);
			  $this->cnf->_say("md5:" . $hold . ':'. $hnew, 'TYPE_RAT');
						
			  if ($dataLength < $length) 
			  {
				//update free space and save state
				/*$this->dpc_free[$dpc] = $remaining;*/
				$this->mem->upd($dpc, $remaining);
				  
				if ($this->mem->checkSpinLock($dpc)===false)
					$this->cnf->_say(">>>>>>>>>>>>>>>>>>>>>>>>>>>spinlock 2:$dpc",'TYPE_DOG'); 
					
				$data .= str_repeat(' ',$remaining);
				$sid = $this->mem->shmid();
				if ($this->shm->_shwrite($sid, $data, $offset))
				{
					$this->mem->savestate();
					$this->cnf->_say("$dpc saved",'TYPE_CAT');
					_dump("UPDATE\n\n\n\n" . $data);
				}	
			  }
			  else
				die($dpc . " error, increase extra space!\n"); 
			
			}//if data
		}
		
		//else read mem
		$this->cnf->_say("reading $dpc ",'TYPE_DOG');
		
		if ($this->mem->checkSpinLock($dpc)===true)
			$this->cnf->_say(">>>>>>>>>>>>>>>>>>>>>>>>>>>spinlock reader:$dpc",'TYPE_DOG');
		
		$sid = $this->mem->shmid();
		$data = $this->shm->_shread($sid, $offset, $length);
						   
		$this->cnf->_say("Data : " . strlen($data), 'TYPE_RAT');
	  }
	  else 
	  { 
	    //fetch and save, new dpc or new data stream

		//PDO stream
		if (substr($dpc,0,7)==='select-') 
		{   //echo "PDO SELECTCCCCCCCCCCCCCCCCCCCCC\n";
			if (!$this->scheduler->findschedule($dpc)) {
				$pdodpc = str_replace('-',' ',$dpc);
				foreach(self::$pdo->query($pdodpc, PDO::FETCH_ASSOC) as $row) {
					//$data.= json_encode($row).'@;@';
					$_data[] = $row;
				}
				$data = json_encode($_data);
			}
			else
				$data = null; //bypass		
		} //datastream	
		elseif (substr($dpc,0,4)==='www.') 
		{
			//echo "CCCCCCCCCCCCCCCCCCCC\n";
			$data = (!$this->scheduler->findschedule($dpc)) ?
				    $this->utl->httpcl($dpc) : null; //bypass			
		}	
	    elseif (is_readable($this->dpcpath . $dpc)) 
		{
			//echo "BBBBBBBBBBBBBBBBBBBB\n";
			//remote storage
			/** // Create a stream
			$opts = array(
				'http'=>array(
					'method'=>"GET",
					'header'=>"Accept-language: en\r\n" .
							"Cookie: foo=bar\r\n"
				)
			);
			$context = stream_context_create($opts);
			// Open the file using the HTTP headers set above
			$file = file_get_contents('http://www.example.com/', false, $context);
			*/
			//https://raw.github.com/stereobit-networlds/phpdac6/master/
			//local storage
			$data = $this->fs->_readPHP($this->dpcpath . $dpc); //dump inside
		}
		else { 
			$this->cnf->_say($this->dpcpath . $dpc . ' not found!', 'TYPE_LION');	
			
			//create var
 
            //MUST BE POOLED
			/*$this->processStack(__CLASS__, explode('/',$dpc));
			$s = $this->getProcessStack(); //print_r($s);
			$c = $this->getProcessChain(); //print_r($c);
			
			//save in sh mem as resource var (not in resources)
			$this->savedpcmem('srvProcessStack',json_encode($s));
			$this->savedpcmem('srvProcessChain',json_encode($c));
			
			$this->process = new process($this);//, $c, null);
			if ($this->process->isFinished(null)) {
				echo implode(',', $c) . ' finished!' . PHP_EOL; 
			}*/
			
			if ($async = $this->proc->set($dpc) > 0) 
			{
				$this->cnf->_say('set async variable for processing:' . $dpc, 'TYPE_LION');
				//..open client at async class
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
			/*
			$dataTEST = (new proc($this))
						->set($dpc)
						->go();
			echo $dataTest . PHP_EOL;			
			*/
		}	
		
		if (!$data) return false;	
		_say($data,3);		
		
		$dataLength = strlen($data);		
		$offset = $this->mem->getShmOffset();
		//$mempage = ($offset+1+1) + $dataLength + $this->extra_space;
		$extra = $this->mem->extra();
		$mempage = ($offset+1+1) + $dataLength + $extra;
		$memmax = $this->mem->maxmem();
			
		//if ((($offset+1+1) + $dataLength + $this->extra_space) < 
		    //($this->shm_max + $this->dataspace)) 
		if ($mempage < $memmax)	
		{	  
			/*$this->dpc_addr[$dpc] = $offset + 1; //\0 new head			
			$this->dpc_length[$dpc] = $dataLength + $this->extra_space;
			$this->dpc_free[$dpc] = $this->extra_space;*/
			$this->mem->set($dpc, $offset+1, $dataLength);
			
			if ($this->mem->checkSpinLock($dpc)===false)
				$this->cnf->_say(">>>>>>>>>>>>>>>>>>>>>>>>>>>spinlock 3:$dpc", 'TYPE_DOG'); 
			
			$data .= str_repeat(' ', $extra);//$this->extra_space);
			$sid = $this->mem->shmid();
			if ($this->shm->_shwrite($sid, "\0". $data ."\0", $offset))
			{
				_dump("\0". $data ."\0" ,'a+', '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
				
				$this->mem->savestate();
				$this->cnf->_say("$dpc inserted",'TYPE_CAT');
				_dump("INSERT\n\n\n\n" . $data);
			}	
		}
		else	
			die($dpc . " error, increase data space!\n");		
		
		$this->cnf->_say("Data : " . $dataLength, 'TYPE_RAT');		
	  }
	  
	  return ($data);	      
	}  
	
    /*private function closememdpc() 
    {
		//if (!shmop_delete($this->shm_id)) 
		if ($this->shm->_shopen($this->shm_id))	  
		{
			$this->cnf->_say("Couldn't mark shared memory block for deletion", 'TYPE_CAT');
			return false;
		}	  
		//shmop_close($this->shm_id);	
		$this->shm->_shclose($this->shm_id);
		$this->shm_id = null;   
	  
		@unlink("shm.id");
		$this->cnf->_say("Deleting state..!",'TYPE_CAT'); 
	  
		return true;	
    } */    
   
    //return pseudo pointer for comaptibility with agentds class
    public function get_agent($agent,$serialized=null) 
	{
	  return $this;	   
    }
   
    //return pseudo pointer for comaptibility with agentds class   
    public function update_agent(&$o_agent,$agent) 
	{
      return true;
    }       
	

	//RUNTIME

    public function show_schedules() 
	{
      $sh = $this->scheduler->showschedules();
	  //print_r($sh);
	  
	  //save in resources (..to disable)
      //$this->resources->set_resource('_schedules',serialize($sh));	  
	  
	  //savein mem,save dump
	  $this->mem->savedpcmem('srvSchedules',json_encode($sh));
	  _dump(json_encode($sh),'w','/dumpsh-'.$_SERVER['COMPUTERNAME'].'.log');
	  
	  //return ($sh);
	  return null;
    }	
	
    public function retrieve_schedules() 
	{	  
	  //load dump
	  if ($jsonsh = @file_get_contents(getcwd() . '/dumpsh-'.$_SERVER['COMPUTERNAME'].'.log')) 
	  {
	  //shared mem not yet
	  //if ($this->loaddpcmem('srvSchedules')) 
	  //{ 
	  
	  	 $this->cnf->_say("Loading schedules from dump file", 'TYPE_LION');
		 $sh = json_decode($jsonsh); 
		 //print_r($sh);
		 
		 //override (stdClass error, needs re-arrange)
		 //if ($this->scheduler->overwriteschedules($sh)) 
			// _say("Ok!",1); else _say("Error",1);
		 
		 //save in resources (..to disable)
         //$this->resources->set_resource('_schedules',serialize($sh));
		 
		 //save in sh mem as resource var (not in resources)
	     $this->mem->savedpcmem('srvSchedules',json_encode($sh));
		 return true;
	  }
	  
	  return false;
    }	
	
	public function internalClient($set=false) 
	{
		$batch = $set ? $set : '';//pdo
		
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
		
		$this->utl->grapffiti();		
			
		/*$totalbytes = 0;
		foreach ($this->dpc_length as $_dpc=>$_length)
			$totalbytes+= $_length + $this->dpc_free[$_dpc]; //calc
	    */
		$tb = $this->mem->calc();
	    $this->cnf->_say("Total buffer : ". $this->utl->convert($tb) . 
						  ', mem usage: ' . $this->utl->convert(memory_get_usage()), 'TYPE_LION');
		
		//save table in sh mem as resource var		
		//if ($table = file_get_contents('shm.id'))
		if ($table = $this->mem->getShmContents())	
		{		
			$this->mem->savedpcmem('srvState',$table);
			//$this->cnf->_say("Table saved", 'TYPE_LION');
		}
		
		return true;
    } 
	
	

	//FILESYSTEM   
   /*
    private function load_dpc_tree(&$data, $reload=false) {
	   $libs = null;
	   $exts = null;
   	
	   $this->cnf->_say("loading dpc modules...", 'TYPE_RAT');	   
	   $libs = $this->fs->read_dpcs();
	   //echo "loading dpc extensions...\n";	
	   //$exts = $this->fs->read_extensions();
	   
	   $tree = (is_array($exts)) ? array_merge($libs,$exts) : $libs;
	   //print_r($tree);  
	  
	   if ($tree) 
	   {
	    //print_r($tree);
	    //echo ".....\n";
	    $offset = 0;
	    foreach($tree as $dpc_id=>$dpcf) 
		{
	      if (($dpcf!='') && ($dpcf[0]!=';')) 
		  {
		    if ($f = $this->fs->_readPHP($dpcf)) //@file_get_contents($dpcf)) 
			{
              if ($reload===false) //bypass, just compute bytes
			  { 		
				$this->dpc_addr[$dpcf] = $offset + 1; //\0head			
				$this->dpc_length[$dpcf] = strlen($f) + $this->extra_space;
				$this->dpc_free[$dpcf] = $this->extra_space;
			  
				$offset+= $this->dpc_length[$dpcf];// + 1; //\0foot
			  }
			  //add header sign
			  $data .= "\0";
			  $data .= $f;
			  //add extra space for modifications
			  $data .= str_repeat(' ',$this->extra_space);
			  //add foot sign
			  $data .= "\0";
			  
			  if ($reload===false)
				$this->cnf->_say($dpcf . " loaded", 'TYPE_LION');
			  else
				$this->cnf->_say($dpcf . " re-loaded", 'TYPE_LION');  
		    }
		    else 
	          $this->cnf->_say($dpcf . " Error", 'TYPE_LION');
	 
		  }
	    }
	    //print $shared_buffer;
	    $totalbytes = strlen($data);//$this->shared_buffer);
	    $this->cnf->_say("\nTotal Bytes : ".$totalbytes, 'TYPE_RAT');
		
		//print_r($this->dpc_addr);
		//print_r($this->dpc_length);
	  
        return $totalbytes; 
	  }
	  else
	    die("Dpc tree error. System Halted.\n"); 		
	}*/ 		
	
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
		  _say("PDO connection: ok!" , 1);
		  //$this->cnf-> ..is static
	    } 
		catch (PDOException $e) 
		{
            _say("Failed to get DB handle: " . $e->getMessage(), 1);
        }	
	}

	public static function pdoConn()
	{
        return self::$pdo;
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
	  return ($this->closememdpc());
    }	
   
	function __destruct() 
	{		
		//when ctrl-c
		/*@unlink("shm.id"); 
		
        if(!$this->shm_id)
            return;		
		*/
		//$this->mem->free();
		unset($this->mem); //destruct
	}	
}
?>