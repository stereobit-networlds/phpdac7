<?php
error_reporting(E_ALL & ~E_NOTICE);
	
require_once("system/daemon.lib.php");
require_once("system/timer.lib.php");
require_once("agents/resources.lib.php");
require_once("agents/scheduler.lib.php");

define ("GLEVEL", 1); 
define ("__PHAR", 0);  

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

   var $daemon_ip, $daemon_port, $daemon_type;
   var $verboseLevel, $dmn, $agent, $dpcpath;
   var $scheduler, $resources, $timer, $pdo;
   
   private $shm_id, $shm_max, $dpc_addr, $dpc_length, $dpc_free;
   private $dataspace, $extra_space;
   private $ipcKey, $phar;
   
   function __construct($dtype=null,$ip='127.0.0.1',$port='19123') 
   {  
	  $argc = $GLOBALS['argc'];
      $argv = $GLOBALS['argv'];
	  
	  //graph
	  $this->grapffiti(1);	  
	  
	  $this->shm_id = null;
	  $this->shm_max = 0;
	  $this->dpc_attr = array();
	  $this->dpc_length = array();
	  $this->dpc_free = array();	  

	  $this->agent = 'SH';//default !?!
	  $this->verboseLevel = GLEVEL;	  
	  $this->extra_space = 1024 * 10; //kb //1000;// per file
	  $this->dataspace = 1024000 * 5; //mb //50000;
		  
  	  $this->dpcpath = isset($argv[1]) ? ((substr($argv[1],0,1)!='-') ? $argv[1] . '/' : './') : './'; //getcwd().'/' php7
	  $this->daemon_type = isset($argv[1]) ? ((substr($argv[1],0,1)=='-') ? substr($argv[1],1) : '') : '';
	  $this->daemon_ip = isset($argv[2]) ? $argv[2] : '127.0.0.1';
	  $this->daemon_port = isset($argv[3]) ? $argv[3] : '19123';
	  	  
	  _say("Daemon repository at $this->daemon_ip:$this->daemon_port",1);
	  
 	  //REGISTER PHPRES (client side,resources) 		
      require_once("agents/resstream.lib.php"); 
	  $phpdac_c = stream_wrapper_register("phpres5","c_resstream");
	  if (!$phpdac_c) _say("Client resource protocol failed to registered!");
		         else _say("Client resource protocol registered!",2); 	  
	  
	  //create ipc key (if..)	
	  $pathname = null;//$argv[0]
	  $this->ipcKey = $this->_ftok($pathname, 's'); //create ipc Key
	  //start mem	  
	  if ($this->startmemdpc()) 
	  {	
	    //clear log
	    @unlink('dumpmem-'.$_SERVER['COMPUTERNAME'].'.log');
			  
		//init timer
		$this->timer = new timer($this);
	  
		//init resources
		$this->resources = new resources($this);
		$this->resources->set_resource('variable','myservervalue');	  
      
		//init printer	  
		if (extension_loaded('printer')) {
			//$printer = "FinePrint pdfFactory Pro";
			$printer = "\\\http://127.0.0.1\\e-Enterprise.printer";
			$printout = @printer_open($printer);//true;
			if (is_resource($printout) &&
				get_resource_type($printout)=='printer') 
			{  
				printer_set_option($printout, PRINTER_MODE, 'RAW'); 
				$this->resources->set_resource('printer',$printout);
				_say("printer:" . $printer . " connected.",1);
				//printer_close($printout);
			}
			else
				_say("printer:" . $printer . " error: Could not connect!",1);  
		}  	  
		  
		//init scheduler
		$this->scheduler = new scheduler($this);
		//$this->scheduler->schedule('env.show_connections','every','20');		  	  		  
		$this->scheduler->schedule('env.scheduleprint','every','20');	  
		$this->scheduler->schedule('env.internalClient','every','50');	  		  
	  	  
		//init db
		try 
		{
		  $this->pdo = @new PDO('mysql:host=localhost;dbname=basis;charset=utf8', 'e-basis', 'sisab2018');
		  _say("PDO connection: ok!" ,1);
	    } 
		catch (PDOException $e) 
		{
            _say("Failed to get DB handle: " . $e->getMessage(),1);
        }
		
		//init phar
		if (__PHAR)
		{   //ini_set('phar.readonly','0');
	        _say("Phar initialized!" ,1);
			$this->phar = new Phar(getcwd() . "/phpdac7.phar", 
			                       FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME, 
								   "phpdac7.phar");		
		}
		
		$this->startdaemon();
	  }
	  else 
	  {
		  _say('Shared memory critical error!');
		  $this->shutdown(true);
	  }	  
   }
   
   private function startdaemon() 
   {
   
      $this->dmn = new daemon($this->daemon_type,true,$this);//'standalone',false);
      $this->dmn->setAddress ($this->daemon_ip);//'127.0.0.1');
      $this->dmn->setPort ($this->daemon_port);
      $this->dmn->Header = "PHPDAC5 Kernel v2, " . $this->daemon_ip . ':' . $this->daemon_port;

      $this->dmn->start ();  	
	  
      $this->dmn->setCommands (array ("help", "quit", "date", "shutdown","echo","silence",
	                                  "ver","use","agent","setagent","level","setlevel",
									  "getdpcmem","getdpcmemc","helo","run",
									  "print","getresource", "getresourcec", "showresources", 
									  "findresource", "findresourcec", "setresource", "delresource",
									  "checkschedules","showschedules", "setschedule", 
									  "who", "http", "***"));
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
	  	  	  	  	  
	  $this->dmn->CommandAction ("***", array($this,"phpdac_handler"));//handle everyting else...	  
	  
	  //dispatch batch
	  $this->exebatchfile($this->dmn, 'kernel.ash', true);
	  
	  //continue shceduling after ash run
	  $this->retrieve_schedules();
	  	  
	  //listen
      $this->dmn->listen(1); 	    	       
   }
   
   private function exebatchfile(&$dmn,$file=null,$w=false) 
   {
	    if (!$file) return false;
		
		$batchfile = getcwd() . DIRECTORY_SEPARATOR . $file;
		
		if ((is_readable($batchfile)) && ($f = @file($batchfile))) {
			
			_say('Init batch file: ' . $batchfile,1); 
			if (!empty($f)) {
			  //print_r($f);
		      foreach ($f as $command_line) {
				if (trim($command_line)) {
					 //echo "-" . $command_line;
                     $dmn->dispatch($command_line,null);
                }
		      }			  
			}
			return true;	
		}
		return false;
   }   
   
   //general purpose commands
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
					$this->shutdown();
                return false;
                break;
        case 'DATE':
                $dmn->Println (date ("Y-m-d H:i:s"));
                return true;
                break;
        case 'SHUTDOWN':
		        $dmn->changePrompt();
                $dmn->shutdown();
				$this->shutdown();				
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
		        $dmn->Println ('Agent is '.GetGlobal('__USERAGENT'));
                return true;
                break;
				
		case 'SETLEVEL' : 
				//$this->userLevelID = $arguments[0]; 
				//SetSessionParam("UserSecID",encode($arguments[0]));
		case 'LEVEL':
		        $dmn->Println ('Level is ...');//.decode(GetSessionParam("UserSecID")));
                return true;
                break;				
				
		case 'GETDPCMEM'://server version
		        $data = $this->getdpcmem($arguments[0]);
		        $dmn->Println ($data);
                return true;
                break;	
				
		case 'GETDPCMEMC'://client version
		        $dmn->setEcho(0);//echo off
				//header from 1st command still appear...must set client silence off				
				$dmn->setSilence(1);//silence off...???
		        $data = $this->getdpcmemc($arguments[0]);
		        $dmn->Println (trim($data));
                return false;//and quit
                break;					
				
		case 'HELO':
                return false;
                break;		
				
		case 'RUN':
                return true;
                break;							
				
		case 'PRINT':
		        $this->prn($arguments[0],$arguments[1]);
                return true;
                break;	
				
		case 'GETRESOURCE' : //local version
		        //$dmn->setEcho(0);//echo off
				//$dmn->setSilence(1);//silence off...???
		        $resource = $this->resources->get_resource($arguments[0],1);
		        $dmn->Println ($resource);
				//return true;
		        //return ($resource);
				return false;//and quit replied answer to agn
		        break; 
				
		case 'GETRESOURCEC' :  //client version
		        $resource = $this->resources->get_resourcec($arguments[0],$arguments[1],$arguments[2]);
		        $dmn->Println ($resource);
				return true;
		        break;				
				
		case 'SHOWRESOURCES':
		        $r = $this->resources->showresources();
				$dmn->Println ($r);
                return true;
                break;	
				
		case 'FINDRESOURCE':				
		case 'FINDRESOURCEC':
		        $r = $this->resources->findresource($arguments[0],1);
				$dmn->Println ($r);
                return true;
                break;					
				
		case 'SETRESOURCE':
		        $r = $this->resources->set_resource($arguments[0],$arguments[1]);
				$dmn->Println ($r);
                return true;
                break;											
				
		case 'DELRESOURCE':
		        $r = $this->resources->del_resource($arguments[0]);
				$dmn->Println ($r);
                return true;
                break;						
				
		case 'CHECKSCHEDULES':
		        $c = $this->scheduler->checkschedules();
				$dmn->Println ($c);
                return true;
                break;	
				
		case 'SHOWSCHEDULES':
		        $s = $this->scheduler->showschedules();
				$dmn->Println ($s);
                return true;
                break;	
				
		case 'SETSCHEDULE' :
				$entry = $this->scheduler->schedule($arguments[0],$arguments[1],$arguments[2]);	
				$dmn->Println($entry);
				return true;
		        break;				
				
		case 'WHO':
		        $sessions = $this->show_connections(1);
				$dmn->Println($sessions);
				return true;
		        break;														
				
		case 'HTTP':
		        $data = $this->httpcl($arguments[0],$arguments[1],$arguments[2]);
				$this->savedpcmem($arguments[0],$data);
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

   private function startmemdpc($ipcKey=null) 
   {   
      $iKey = $ipcKey ? $ipcKey : 0xfff;
	  
	  if (!extension_loaded('shmop')) 
		  dl('php_shmop.dll');
	  
	  _say("Start",1);   
	  
	  $data =null;
      $this->shm_max = $this->load_dpc_tree($data); //\0 included
	  //echo ">>>>>>>>>>>>>>>", $this->shm_max;
	  
	  ///////////////allocate dpc tree
	  // Create shared memory block with system id if 0xff3
	  $space = $this->shm_max + $this->dataspace;
	  
	  _say("Allocate shared memory segment... $space bytes",2);
      $this->shm_id = shmop_open($ikey, "c", 0644, $space);
	  
      if ($this->shm_id) 
	  {
		// Do not Check SpinLock \0 included		
		$bw = shmop_write($this->shm_id, $data, 0);
		//init mem dump w not a+ (dump includes all 1st entries not updates)
		_dump($data ,'w', '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
		
        if($bw != $this->shm_max) 
		{
          die("Couldn't write the entire length of data\n");
		}  
		else	
		  $this->savestate();	
	  }
	  else
		die("Couldn't create shared memory segment. System Halted.\n");

	  return true; 	
   } 
   
   //save shared mem resource id and mem alloc arrays
   private function savestate() 
   {   /*
		$fd = @fopen( "shm.id", "w" );

		if (!$fd) 
		{
            echo "shm_id not saved!!!\n";
			return false;
		}
		_say("Save state",2);
		$data = $this->shm_max ."@^@". serialize($this->dpc_addr) . 
		                       "@^@". serialize($this->dpc_length). 
							   "@^@". serialize($this->dpc_free);//. 
							   //"@^@". serialize($this->shared_buffer); 

		fwrite($fd, $data);
		fclose($fd);      
		return true;
		*/
		_say("Save state",2);
		$data = $this->shm_max ."@^@". serialize($this->dpc_addr) . 
		                       "@^@". serialize($this->dpc_length). 
							   "@^@". serialize($this->dpc_free);
							   
		return file_put_contents('shm.id', $data ,LOCK_EX);
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
	   if (shmop_read($this->shm_id, $offset, 1) !== "\0")
		   return false;
	   
	   return true;
   }
   
   //fetch shared mem
   private function loaddpcmem($dpc) 
   {
	    $dpc = $this->dehttpDpc($dpc);
	   
		if (isset($this->dpc_addr[$dpc])) 
		{
			return 
			shmop_read($this->shm_id, 
	                   $this->dpc_addr[$dpc], 
			 	       $this->dpc_length[$dpc]);
        }
		return false; 	
   }   
   
   //save calls,urls etc into shared mem
   private function savedpcmem($dpc, &$data) 
   {
	   $dataLength = strlen($data); 	   
	   $dpc = $this->dehttpDpc($dpc); //if it is a http call
	   
	   if (isset($this->dpc_addr[$dpc])) 
	   {
			//rewrite
			//fetch dpc   
			$offset = $this->dpc_addr[$dpc];
			$length = $this->dpc_length[$dpc]; 
			$free = $this->dpc_free[$dpc];
			$rlength = intval($length - $free);
			//$oldData = substr($this->shared_buffer,$offset,$length);		
		     
			if (isset($data)) //replace
			{				
			  $remaining = $length - $dataLength;			  
			  _say("diff:" . $rlength.':'.$dataLength,2);
			  
			  //$oldData = $this->loaddpcmem($dpc);		
			  $oldData = shmop_read($this->shm_id, $offset, $rlength); 				
			  $hold = md5($oldData);	
			  $hnew = md5($data);// . str_repeat(' ',$remaining));
			  _say("md5:" . $hold . ':'. $hnew,2);
						
			  if ($dataLength < $length) 
			  {
					//update free space and save state
					$this->dpc_free[$dpc] = $remaining;
									    
					if ($this->checkSpinLock($dpc)===false)
						_say(">>>>>>>>>>>>>>>>>>>>>>>>>>>spinlock 0:$dpc",1);		
			
			        $data .=  str_repeat(' ',$remaining);
					if (shmop_write($this->shm_id, $data, $offset))
					{	
						$this->savestate();
						_say("$dpc saved",1);
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
					_say(">>>>>>>>>>>>>>>>>>>>>>>>>>>spinlock 1:$dpc",1); 
					
				$data .= str_repeat(' ',$this->extra_space);
				
				if (shmop_write($this->shm_id, "\0". $data ."\0", $offset))
				{
					_dump("\0". $data ."\0" ,'a+', '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
					
					$this->savestate();
					_say("$dpc loaded",1);
					_dump("LOAD\n\n\n\n" . $data);
				}
			}
			else	
				die($dpc . " error, increase data space!");		
			     
	   }
	   
	   _say("Data : " . $dataLength, 2);	   
	   return ($data);
   }    
   
   private function getdpcmem($dpc) 
   {
	  $dpc = $this->dehttpDpc($dpc);
   
	  if ($data = $this->loaddpcmem($dpc))
		  $ret = $data . 
			     $this->dpc_addr[$dpc] .':'.
				 $this->dpc_length[$dpc] .':'.
				 $this->dpc_free[$dpc] ."\n";
	  else
		  $ret = "Invalid dpc!";
	  
	  return ($ret);	      
   }	  
   
   //client version
   private function getdpcmemc($dpc) 
   {
	  $dpc = $this->dehttpDpc($dpc);
	  $data = null; 	  

      if (isset($this->dpc_addr[$dpc])) 
	  {
		//fetch dpc   
		$offset = $this->dpc_addr[$dpc];
	    $length = $this->dpc_length[$dpc]; 
		$free = $this->dpc_free[$dpc];
		$rlength = intval($length - $free);
		//$oldData = substr($this->shared_buffer,$offset,$length);		
		
        //echo "AAAAAAAAAAAAAAAAAAAAAA\n";
		//dpc and streams that exists in data area only
		if ($offset >= $this->shm_max) 
		{
			if (substr($dpc,0,7)==='select-') 
			{
				//echo "PDO 00000000000000000000000\n";
				if (!$this->scheduler->findschedule($dpc)) 
				{
					$pdodpc = str_replace('-',' ',$dpc);
					foreach($this->pdo->query($pdodpc, PDO::FETCH_ASSOC) as $row) {
						//$data.= json_encode($row).'@;@';
						$_data[] = $row;
					}
					$data = json_encode($_data);
					_say($data,3); //show new data
				}
				else 
				{
					$data = null; //bypass and read
					_say('Scheduled PDO stream:' . $dpc,1);
					_say($data,3);
				}
			}
			elseif (substr($dpc,0,4)==='www.') 
			{
				//echo "111111111111111111111111\n";
				if (!$this->scheduler->findschedule($dpc)) 
				{
					$data = $this->httpcl($dpc);
					_say($data,3); //show new data
				}
				else 
				{
					$data = null; //bypass and read
					_say('Scheduled data stream:' . $dpc,1);
					_say($data,3);
				}	
			}
			elseif (is_readable($this->dpcpath . $dpc)) 
			{
				//echo "222222222222222222222222\n";
				//local storage reload  
				$sf = filesize($this->dpcpath . $dpc);
				_say("Size:" . $rlength .':' . $sf,2);
				if ($rlength != $sf) {
					$data = $this->_readPHP($this->dpcpath . $dpc); 
					_say($data,3); 
				}	
				else
					$data = null; //bypass and read
			}
			else  { //variable
				_say($dpc . ' reading variable',1);	
				$data = null ;//bypass and read
			}	
			
			if (isset($data)) //update 
			{ 			
			  $dataLength = strlen($data); 
			  $remaining = $length - $dataLength;
			  _say("diff:" . $rlength.':'.$dataLength,2);
				
			  //$oldData = $this->loaddpcmem($dpc);	
			  $oldData = shmop_read($this->shm_id, $offset, $rlength);
			  //$newData = $data;// . str_repeat(' ',$remaining);
			  
			  $hold = md5($oldData);	
			  $hnew = md5($data);
			  _say("md5:" . $hold . ':'. $hnew,2);
						
			  if ($dataLength < $length) 
			  {
				//update free space and save state
				$this->dpc_free[$dpc] = $remaining;				  
				  
				if ($this->checkSpinLock($dpc)===false)
					_say(">>>>>>>>>>>>>>>>>>>>>>>>>>>spinlock 2:$dpc",1); 
					
				$data .= str_repeat(' ',$remaining);
				if (shmop_write($this->shm_id, $data, $offset))
				{
					$this->savestate();
					_say("$dpc saved",1);
					_dump("UPDATE\n\n\n\n" . $data);//$this->shared_buffer);
				}	
			  }
			  else
				die($dpc . " error, increase extra space!\n"); 
			
			}//if data
		}
		
		//else read mem
		_say("reading $dpc ",2);
		
		if ($this->checkSpinLock($dpc)===true)
			_say(">>>>>>>>>>>>>>>>>>>>>>>>>>>spinlock reader:$dpc",3);
		
		$data = shmop_read($this->shm_id, 
	                       $offset, 
			  			   $length);
						   
		_say("Data : " . strlen($data), 2);
	  }
	  else 
	  { 
	    //fetch and save, new dpc or new data stream

		//PDO stream
		if (substr($dpc,0,7)==='select-') 
		{   //echo "PDO SELECTCCCCCCCCCCCCCCCCCCCCC\n";
			if (!$this->scheduler->findschedule($dpc)) {
				$pdodpc = str_replace('-',' ',$dpc);
				foreach($this->pdo->query($pdodpc, PDO::FETCH_ASSOC) as $row) {
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
				    $this->httpcl($dpc) : null; //bypass			
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
			$data = $this->_readPHP($this->dpcpath . $dpc); //dump inside
		}
		else 
			_say($this->dpcpath . $dpc . ' not found!',1);	
		
		if (!$data) return false;	
		_say($data,3);		
		
		$dataLength = strlen($data);
		
		//$sb = strlen($this->shared_buffer);
		//foreach ($this->dpc_length as $_dpc=>$_length)
			//$sb+= $_length + $this->dpc_free[$_dpc]; //calc		
		$offset = $this->getShmOffset();
			
		if ((($offset+1+1) + $dataLength + $this->extra_space) < 
		    ($this->shm_max + $this->dataspace)) 
		{	  
			$this->dpc_addr[$dpc] = $offset + 1; //\0 new head			
			$this->dpc_length[$dpc] = $dataLength + $this->extra_space;
			$this->dpc_free[$dpc] = $this->extra_space;
			
			if ($this->checkSpinLock($dpc)===false)
				_say(">>>>>>>>>>>>>>>>>>>>>>>>>>>spinlock 3:$dpc",1); 
			
			$data .= str_repeat(' ',$this->extra_space);
			if (shmop_write($this->shm_id, "\0". $data ."\0", $offset))
			{
				_dump("\0". $data ."\0" ,'a+', '/dumpmem-tree-'.$_SERVER['COMPUTERNAME'].'.log');
				
				$this->savestate();
				_say("$dpc inserted",1);
				_dump("INSERT\n\n\n\n" . $data);
			}	
		}
		else	
			die($dpc . " error, increase data space!\n");		
		
		_say("Data : " . $dataLength, 2);		
	  }
	  
	  return ($data);	      
    }  

 	//set flag to \0, must written before read  
    public function readSafe($dpc)
    {
		$dpc = $this->dehttpDpc($dpc);
		
	    if ($this->checkSpinLock($dpc)===true) {
			//spinLock = \0
			_say("Locked segment (must written):" . $dpc);
			return false;
		}	
		$offset = $this->dpc_addr[$dpc];
		$size = $this->dpc_length[$dpc];
		$dataSize = $this->dpc_length[$dpc] - $this->dpc_free[$dpc];		
        
        $data = shmop_read($this->shm_id, $offset, $dataSize);
		
        // release spinlocks
        shmop_write($this->shm_id, "\0", $offset-1);
		shmop_write($this->shm_id, "\0", $size+1);
        return $data;
    }
    
	//set flag to \1, must read
    public function writeSafe($dpc,$data)
    {
		$dpc = $this->dehttpDpc($dpc);
		
	    if ($this->checkSpinLock($dpc)===false) 
		{   //spinLock = \1
			_say("Locked segment (not readed):" . $dpc);
			return false;
		}	  
		
	    $dataSize = strlen($data);
		
		if ($this->dpc_addr[$dpc]) 
		{  //update
			$offset = $this->dpc_addr[$dpc];
			$size = $this->dpc_length[$dpc];
			$oldSize = $this->dpc_length[$dpc] - $this->dpc_free[$dpc];		
						
			if ($dataSize < $size)
			{
				$remaining = $size - $dataSize;
				_say("diff:" . $oldSize.':'.$dataSize,1);
				
				$oldData = shmop_read($this->shm_id,$offset,$oldSize);
				$hold = md5($oldData);	
				$hnew = md5($newData);
				_say("md5:" . $hold . ':'. $hnew,1);				
				
				$newData = $data . str_repeat(' ',$remaining);								
			}	
			else	
			{	
				//throw new Exception('dataSize > block');
				_say("Error::::::::::::::: Update: DataSize > block :" . $dpc);
			}			
        }
		else 
		{   
	        //append / insert
			$offset = $this->getShmOffset();
			
			//+1+1 = \lock flags
			if ((($offset+1+1) + $dataSize + $this->extra_space) < 
				($this->shm_max + $this->dataspace)) 
			{
                $this->dpc_addr[$dpc] = $offset + 1; //\0 new head			
				$this->dpc_length[$dpc] = $dataSize + $this->extra_space;
				$this->dpc_free[$dpc] = $this->extra_space;	
				
				$newData = $data . str_repeat(' ',$this->extra_space);
			}
			else			
			{
				//throw new Exception('dataSize > block');
				_say("Error::::::::::::::: Insert: DataSize > dataspace :" . $dpc);
			}	
		}
	    // set spinlocks	
		shmop_write($this->shmId, "\1", $offset-1);
		shmop_write($this->shm_id, $newData, $offset);
		shmop_write($this->shmId, "\1", strlen($newData)+1);
		
        return true;
    }   
   
    private function closememdpc() 
    {
      if (!shmop_delete($this->shm_id)) 
	  {
        _say("Couldn't mark shared memory block for deletion",1);
		return false;
      }	  
	  shmop_close($this->shm_id);	
	  $this->shm_id = null;   
	  
	  @unlink("shm.id");
	  _say("Deleting state..!",2); 
	  
	  return true;	
    }     
   
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
	
	
   //DPC DIR FUNCS	
   private function read_dpcs() 
   {
        $dpath = $this->dpcpath;
		$selections = array('libs');//array('agents','tcp'); 
		//echo '>>>>>>>>>>>>>>>>>>'. realpath($this->dpcpath);
		/*
		foreach (glob("*.php") as $filename) {
			echo "$filename size " . filesize($filename) . "\n";
		}
		*/
	    if (is_dir($dpath)) {
		
          $mydir = dir($dpath);
		 
          while ($fileread = $mydir->read ()) 
		  {
	   
           //read directories
		   //if (($fileread!='.') && ($fileread!='..'))  { //ALL
		   if (in_array($fileread, $selections)) 
		   { 

	          if (is_dir($dpath. DIRECTORY_SEPARATOR .$fileread)) 
			  {

                 $mysubdir = dir($dpath."/".$fileread);
                 while ($subfileread = $mysubdir->read ()) 
				 {	
				 
		           if (($subfileread!='.') && ($subfileread!='..'))  
				   {
                       if ((stristr ($subfileread,".dpc.php")) || 
						   (stristr ($subfileread,".ext.php")) || 
					       (stristr ($subfileread,".lib.php")))  
				           $mydpc[] = $fileread . DIRECTORY_SEPARATOR . $subfileread;								     
				   }
				 }
			  }
		   }
	      }
	      $mydir->close ();
        }
		//echo $dpath,'>';
		//print_r($mydpc);
		return ($mydpc);   
   }
   
   //UNDER CONSTRUCTION: recur
   private function read_extensions() 
   {
        $dpath = $this->dpcpath . "system/extensions";
   
	    if (is_dir($dpath)) {
          $mydir = dir($dpath);
          while ($fileread = $mydir->read ()) 
		  {
		   if (($fileread!='.') && ($fileread!='..'))  
		   {
	          if (is_dir($dpath . DIRECTORY_SEPARATOR . $fileread)) 
			  {
                 $mysubdir = dir($dpath . DIRECTORY_SEPARATOR . $fileread);
                 while ($subfileread = $mysubdir->read ()) 
				 {	
		           if (($subfileread!='.') && ($subfileread!='..'))  
				   {
                       if (stristr ($subfileread,".php")) 
				           $mydpcext[] = 'system/extensions/'.$fileread."/".$subfileread;							     
				   }
				 }
			  }
		   }
	      }
	      $mydir->close ();
        }
		return ($mydpcext);   
   }   
   
   private function load_dpc_tree(&$data) {
	   $libs = null;
	   $exts = null;
   	
	   _say("loading dpc modules...",2);	   
	   $libs = $this->read_dpcs();
	   //echo "loading dpc extensions...\n";	
	   //$exts = $this->read_extensions();
	   
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
		    if ($f = $this->_readPHP($dpcf)) //@file_get_contents($dpcf)) 
			{	
			  $this->dpc_addr[$dpcf] = $offset + 1; //\0head			
			  $this->dpc_length[$dpcf] = strlen($f) + $this->extra_space;
			  $this->dpc_free[$dpcf] = $this->extra_space;
			  
			  $offset+= $this->dpc_length[$dpcf];// + 1; //\0foot
			  
			  //add header sign
			  $data .= "\0";
			  
			  //add data space
		      //$this->shared_buffer .= $f;
			  $data .= $f;
			  //add extra space for reloading
			  //$this->shared_buffer .= str_repeat(' ',$this->extra_space);
			  $data .= str_repeat(' ',$this->extra_space);
			  
			  //add foot sign
			  $data .= "\0";
			  
			  _say($dpcf . " loaded",1);
		    }
		    else 
	          _say($dpcf . " Error",1);
	 
		  }
	    }
	    //print $shared_buffer;
	    $totalbytes = strlen($data);//$this->shared_buffer);
	    _say("\nTotal Bytes : ".$totalbytes,2);
		
		//print_r($this->dpc_addr);
		//print_r($this->dpc_length);
	  
        return $totalbytes; 
	  }
	  else
	    die("Dpc tree error. System Halted.\n"); 		
   }   	   
   
   
    //UTILS
	
	//for data streams dpc address extract args
	public function dehttpDpc($dpc) 
	{	
	  if (strstr($dpc,"\\")) 
	  {     //data stream
			//cut cmd params
			$arg = explode("\\",$dpc);
			return $arg[1];
      }
	  return $dpc; //as is
    }   
	
    public function prn($message=null,$doctitle=null) 
	{
		if (!$message) return false;
		
		$pr = $this->resources->get_resource('printer');
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
   
    public function show_connections($show=null) 
	{
      $ret = $this->dmn->show_connections();
	  
	  //save in resources
      $this->resources->set_resource('_sessions',serialize($ret));	  
	  
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
	  
	  //else //echoed
	  return ($ret);
    } 
	
    public function show_schedules() 
	{
      $sh = $this->scheduler->showschedules();
	  //print_r($sh);
	  
	  //save in resources (..to disable)
      //$this->resources->set_resource('_schedules',serialize($sh));	  
	  
	  //savein mem,save dump
	  $this->savedpcmem('srvSchedules',json_encode($sh));
	  _dump(json_encode($sh),'w','/dumpsh-'.$_SERVER['COMPUTERNAME'].'.log');
	  
	  //return ($sh);
	  return null;
    }	
	
    private function retrieve_schedules() 
	{	  
	  //load dump
	  if ($jsonsh = @file_get_contents(getcwd() . '/dumpsh-'.$_SERVER['COMPUTERNAME'].'.log')) 
	  {
	  //shared mem not yet
	  //if ($this->loaddpcmem('srvSchedules')) 
	  //{ 
	  
	  	  _say("Loading schedules from dump file",1);
		 $sh = json_decode($jsonsh); 
		 //print_r($sh);
		 
		 //override (stdClass error, needs re-arrange)
		 //if ($this->scheduler->overwriteschedules($sh)) 
			// _say("Ok!",1); else _say("Error",1);
		 
		 //save in resources (..to disable)
         //$this->resources->set_resource('_schedules',serialize($sh));
		 
		 //save in sh mem as resource var (not in resources)
	     $this->savedpcmem('srvSchedules',json_encode($sh));
		 return true;
	  }
	  
	  return false;
    }	
	
	public function internalClient($set=false) 
	{
		$batch = $set ? $set : '';//pdo
		
		//start a client (auto)
		exec("start /D d:\github\phpdac7\bin agentds pdo");// -inetd");
		//exec("start /D c:\xampp-phpdac7\bin agentds pdo"); //php 7
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
		//_say("SERVER print",1);
		//printer_write($this->resources->get_resource('printer'), "SERVER print"."\n\r");  
		
		_say($this->show_connections(),1);
		_say($this->show_schedules(),1);
		
		$this->grapffiti();		
			
		$totalbytes = 0;
		foreach ($this->dpc_length as $_dpc=>$_length)
			$totalbytes+= $_length + $this->dpc_free[$_dpc]; //calc
	
	    _say("Total buffer : ".$totalbytes. ', usage: ' . memory_get_usage(),1);
		
		return true;
    } 	
   
	public function httpcl($url=null, $user=null,$password=null) 
	{
		if (!$url) return null;
		//echo ">>>>>>>>>>>>>$url<<<<<<<<<<<<<<<\n";
		require_once("tcp/saslclient.lib.php");
		require_once("tcp/httpclient.lib.php");		
		
		//$http=new \LIB\tcp\httpclient;
		$http= new httpclient;
		
		$http->timeout=0;
		$http->data_timeout=0;
		$http->debug=0;//1
		$http->html_debug=0;//1				
		$http->user_agent="Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
		$http->follow_redirect=0;
		$http->prefer_curl=0;
		
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
				
		if ($error=="") 
		{
			_say("Sending request for page: " . HtmlSpecialChars($arguments["RequestURI"]),1);
			if(strlen($user))
				_say("\nLogin:    ".$user."\nPassword: ".str_repeat("*",strlen($password)),2);
			_say('',2);
			flush();
			$error=$http->SendRequest($arguments);
			_say('',2);

			if($error=="") 
			{
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
		
		if(strlen($error)) 
		{
			_say("Error: ".$error,1);
			return null;	
		}

		return ($body);		
	}
	
	public function convert($size)
	{
		$unit=array('b','kb','mb','gb','tb','pb');
		return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
	}	

   private function shutdown($now=false) 
   {
	  if ($now) die(); 
   	
	  _say("Shutdown....",1);
	  
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

	public function _ftok($pathname, $proj_id) 
	{
		$st = @stat($pathname);
		if (!$st) 
		{
			return -1;
		}
  
		$key = sprintf("%u", (($st['ino'] & 0xffff) | (($st['dev'] & 0xff) << 16) | (($proj_id & 0xff) << 24)));
		return $key;
	}	
	
	protected function _readPHP($filename=null) 
	{
		if (!$filename) return false;
		
		$fdata = @file_get_contents($filename);

		if (__PHAR && is_object($this->phar))
		{	_say("Phar file added: " . $filename ,1);
			$this->phar[$filename] = $fdata;
		}
		
		return $fdata; //stop here
		
		return  (
						  preg_replace("/^<\?php/","<?php",						  
 						  //preg_replace(	
							//'/<<<(\w+).*(\1);/' , "\r\n$0\r\n",
						  //preg_replace(
						    //"/\s\s+/", " ", /* beware spaces at heredocs else err*/
						    preg_replace(
							    "/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", PHP_EOL,
								//preg_replace(	
							    //"/<<<(\w+).*(\1);/" , "\r\n$1\r\n",
								preg_replace( /* comments // without : at back char :* */
								    "/(?<![*:\"'])[ \t]*\/\/.*/", '',
									preg_replace( /* comments * */		
										'!/\*.*?\*/!s', '',
										@file_get_contents($filename)
									)
								)
								//)
							)
						  //)	
						  //)
						  )
				);
    }						
   
	function __destruct() 
	{
		if (__PHAR && is_object($this->phar))
		{   _say("Phar completed" ,1);
			$this->phar->setStub($phar->createDefaultStub("dpclass.dpc.php"));
			//may be cmd from a client...
		}	
		
		//when ctrl-c
		@unlink("shm.id"); 
		
        if(!$this->shm_id)
            return;		
		
		shmop_delete($this->shm_id);	
	}	

	//http://patorjk.com/software/taag
	public function grapffiti($x=null) 
	{
		$xz = $x ? $x : rand(2,12); //+2 empty
		//echo '>>>>>>>>>>>>>>>>>>>>>>.'.$xz."\n";
		switch ($xz) {
			
	    case 10 :


echo "\n __      __        .__  __ /\      /\    ";
echo "\n/  \    /  \_____  |__|/  |\ \    /  \   ";
echo "\n\   \/\/   /\__  \ |  \   __\ \   \/\/   ";
echo "\n \        /  / __ \|  ||  |  \ \         ";
echo "\n  \__/\  /  (____  /__||__|   \ \        ";
echo "\n       \/        \/            \/        ";
	
		echo "\r\n\r\n";
		break;
				
		case 9 :
echo "\n~~~~~~_~~~~~~~~~~~~~~~~~~~~~~_~~~~~_~_~~~";
echo "\n~~~~~|~|~~~~~~~~~~~~~~~~~~~~|~|~~~(_)~|~~";
echo "\n~~___|~|_~___~_~__~___~~___~|~|__~~_|~|_~";
echo "\n~/~__|~__/~_~\~'__/~_~\/~_~\|~'_~\|~|~__|";
echo "\n~\__~\~||~~__/~|~|~~__/~(_)~|~|_)~|~|~|_~";
echo "\n~|___/\__\___|_|~~\___|\___/|_.__/|_|\__|";
echo "\n~~~~~|~|~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~__|~|~__~_~~___~_~__~___~~~___~~_~__~~";
echo "\n~~/~_\`~|/~_\`~|/~_~\~'_~\`~_~\~/~_~\|~\~";
echo "\n~|~(_|~|~(_|~|~~__/~|~|~|~|~|~(_)~|~|~|~|";
echo "\n~~\__,_|\__,_|\___|_|~|_|~|_|\___/|_|~|_|";
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";


		echo "\r\n\r\n";
		break;
				
		case 8 :	
echo "\n~~~oo_~~~(o)__say(o)~~~~~))~~~~~~~~~~~~~.-.~~~~~_~~~wW~~Ww(o)__say(o)~~~~~~~~~~~~~~~~";
echo "\n~~/~~_)-<(__~~__)wWw~(Oo)-.~wWw~~~~c(O_O)c~~/||_~(O)(O)(__~~__)~~~~~~~~~~~~~~~~";
echo "\n~~\__~\`.~~~(~~)~~(O)_~|~(_))(O)_~~,'.---.\`,~~/\`_)~(..)~(~~)~~~~~~~~~~~~~~~~~";
echo "\n~~~~~\`.~|~~~)(~~.'~__)|~~.'.'~__)/~/|_|_|\~\|~~\`.~~||~~~~~)(~~~~~~~~~~~~~~~~~";
echo "\n~~~~~_|~|~~(~~)(~~_)~~)|\\(~~_)~~|~\_____/~||~(_))_||_~~~(~~)~~~~~~~~~~~~~~~~~~";
echo "\n~~,-'~~~|~~~)/~~\`.__)(/~~\)\`.__)~'.~\`---'~.\`(.'-'(_/\_)~~~)~~~~~~~~~~~~~~~~";
echo "\n~(_..--'~~~(~~~~~~~~~~)~~~~~~~~~~~~\`-...-'~~~)~~~~~~~~~~~(~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~~~~_~~~~~~~~~~~~~\\\~~~~///~~~.-.~~~\\\~~///~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~~_||\~~/)~~~~wWw~((O)~~(O))~c(O_O)c~((O)(O))~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~(_'\~(o)(O)~~(O)_~|~\~~/~|~,'.---.\`,~|~\~||~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~.'~~|~//\\~~.'~__)||\\//||/~/|_|_|\~\||\\||~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~((_)~||(__)|(~~_)~~||~\/~|||~\_____/~|||~\~|~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~\`-\`.)/,-.~|~\`.__)~||~~~~||'.~\`---'~.\`||~~||~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~~~~(-'~~~''~~~~~~(_/~~~~\_)~\`-...-'~(_/~~\_)~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";


		echo "\r\n\r\n";
		break;
		
		case 7:
echo "\n~~~_~~~_~~~_~~~_~~~_~~~_~~~_~~~_~~~_~~";
echo "\n~~/~\~/~\~/~\~/~\~/~\~/~\~/~\~/~\~/~\~";
echo "\n~(~s~|~t~|~e~|~r~|~e~|~o~|~b~|~i~|~t~)";
echo "\n~~\_/~\_/~\_/~\_/~\_/~\_/~\_/~\_/~\_/~";
echo "\n~~~_~~~_~~~_~~~_~~~_~~~_~~~~~~~~~~~~~~";
echo "\n~~/~\~/~\~/~\~/~\~/~\~/~\~~~~~~~~~~~~~";
echo "\n~(~d~|~a~|~e~|~m~|~o~|~n~)~~~~~~~~~~~~";
echo "\n~~\_/~\_/~\_/~\_/~\_/~\_/~~~~~~~~~~~~~";


		echo "\r\n\r\n";
		break;
			
		case 6:
		
echo "\n~~~~~~_~~~~~~~~~~~~~~~~~~~~~~_~~~~~_~_~~~";
echo "\n~~___|~|_~___~_~__~___~~___~|~|__~(_)~|_~";
echo "\n~/~__|~__/~_~\~'__/~_~\/~_~\|~'_~\|~|~__|";
echo "\n~\__~\~||~~__/~|~|~~__/~(_)~|~|_)~|~|~|_~";
echo "\n~|___/\__\___|_|~~\___|\___/|_.__/|_|\__|";
echo "\n~~~~~~_~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~__|~|~__~_~~___~_~__~___~~~___~~_~__~~";
echo "\n~~/~_\`~|/~_\`~|/~_~\~'_~\`~_~\~/~_~\|~\~";
echo "\n~|~(_|~|~(_|~|~~__/~|~|~|~|~|~(_)~|~|~|~|";
echo "\n~~\__,_|\__,_|\___|_|~|_|~|_|\___/|_|~|_|";
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
		
		echo "\r\n\r\n";
		break;

		case 5 :
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~___~~~~~~~~";
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~/~_~\~~~~~~~";
echo "\n~~____~___~___~~___~~___~___~|~|_)~)_~___~";
echo "\n~/~~._|~~~)~__)/~_~\/~__)~_~\|~~_~<|~(~~~)";
echo "\n(~()~)~|~|>~_)|~|_)~>~_|~(_)~)~|_)~)~||~|~";
echo "\n~\__/~~~\_)___)~~__/\___)___/|~~__/~\_)\_)";
echo "\n~~~~~~~~~~~~~~|~|~~~~~~~~~~~~|~|~~~~~~~~~~";
echo "\n~~~~~~~~~~~~~~|_|~~~~~~~~~~~~|_|~~~~~~~~~~";
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~__~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~/~_)~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~\~\~~~__~~_____~_~~~_~~___~~_~~__~~~~~~~";
echo "\n~/~_~\~/~~\/~/~__)~|~|~|/~_~\|~|/~/~~~~~~~";
echo "\n(~(_)~|~()~~<>~_)|~|_|~(~(_)~)~/~/~~~~~~~~";
echo "\n~\___/~\__/\_\___)~._,_|\___/|__/~~~~~~~~~";
echo "\n~~~~~~~~~~~~~~~~~|~|~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~~~~~~~~~~~~~~~|_|~~~~~~~~~~~~~~~~~~~~~~";
		
		echo "\r\n\r\n";
		break;
		
        case 4 :
echo "\n*****_**********************_*****_*_***";
echo "\n****|*|********************|*|***(_)*|**";
echo "\n*___|*|_*___*_*__*___**___*|*|__**_|*|_*";
echo "\n/*__|*__/*_*\*'__/*_*\/*_*\|*'_*\|*|*__|";
echo "\n\__*\*||**__/*|*|**__/*(_)*|*|_)*|*|*|_*";
echo "\n|___/\__\___|_|**\___|\___/|_.__/|_|\__|";
echo "\n****************************************";
echo "\n****************************************";
echo "\n*****_**********************************";
echo "\n****|*|*********************************";
echo "\n**__|*|*__*_**___*_*__*___***___**_*__**";
echo "\n*/*_\`*|/*_\`*|/*_*\*'_*\`*_*\*/*_*\|*\*";
echo "\n|*(_|*|*(_|*|**__/*|*|*|*|*|*(_)*|*|*|*|";
echo "\n*\__,_|\__,_|\___|_|*|_|*|_|\___/|_|*|_|";
echo "\n****************************************";
echo "\n****************************************";
		
		
		echo "\r\n\r\n";
		break;
		
		case 3 :
echo "\n*****_**********************_*****_*_***";
echo "\n*___|*|_*___*_*__*___**___*|*|__*(_)*|_*";
echo "\n/*__|*__/*_*\*'__/*_*\/*_*\|*'_*\|*|*__|";
echo "\n\__*\*||**__/*|*|**__/*(_)*|*|_)*|*|*|_*";
echo "\n|___/\__\___|_|**\___|\___/|_.__/|_|\__|";
echo "\n****************************************";
echo "\n*****_**********************************";
echo "\n**__|*|*__*_**___*_*__*___***___**_*__**";
echo "\n*/*_\`*|/*_\`*|/*_*\*'_*\`*_*\*/*_*\|*\*";
echo "\n|*(_|*|*(_|*|**__/*|*|*|*|*|*(_)*|*|*|*|";
echo "\n*\__,_|\__,_|\___|_|*|_|*|_|\___/|_|*|_|";
echo "\n****************************************";
		
		echo "\r\n\r\n";
		break;
		
		case 2:
		
echo "\n*****_**********************_*****_*_***";
echo "\n*___|*|_*___*_*__*___**___*|*|__*(_)*|_*";
echo "\n/*__|*__/*_*\*'__/*_*\/*_*\|*'_*\|*|*__|";
echo "\n\__*\*||**__/*|*|**__/*(_)*|*|_)*|*|*|_*";
echo "\n|___/\__\___|_|**\___|\___/|_.__/|_|\__|";
echo "\n****************************************";
echo "\n*****_**********************************";
echo "\n**__|*|*__*_**___*_*__*___***___**_*__**";
echo "\n*/*_\`*|/*_\`*|/*_*\*'_*\`*_*\*/*_*\|*\*";
echo "\n|*(_|*|*(_|*|**__/*|*|*|*|*|*(_)*|*|*|*|";
echo "\n*\__,_|\__,_|\___|_|*|_|*|_|\___/|_|*|_|";
echo "\n****************************************";
		
		echo "\r\n\r\n";	
		break;

		
		case 1 :
		//default:	
/*		
echo "\n**************************************************";
echo "\n* stereobit daemon - a minimal script agency*.   *";
echo "\n*                                                *";
echo "\n*   Copyright 2015-18,  balexiou@stereobit.com   *";
echo "\n*                                                *";
echo "\n*   This digital loop is owned by the numbers.   *";
echo "\n*   Is free for them but you can play as long    *";
echo "\n*   your personal pc can consume electric energy.*";
echo "\n*   Distribute with care and ask for detailsit   *";
echo "\n*   if you like to modify it under the terms of  *";
echo "\n*   the GNU Library General Public License.      *";
echo "\n*                                                *";
echo "\n*   License as published by the Free Software    *";
echo "\n*   Foundation; either version 2 of the License, *";
echo "\n*   (at your option) any later version.          *";
echo "\n*                                                *";
echo "\n*   This piece of software is distributed in the *";
echo "\n*   hope that it will be useful somehow,         *";
echo "\n*   but WITHOUT ANY WARRANTY without even        *";
echo "\n*   the implied warranty of MERCHANTABILITY or   *";
echo "\n*   FITNESS FOR A PARTICULAR PURPOSE.            *";
echo "\n*   See the GNU Library General Public License   *";
echo "\n*   for Library General Public License for more  *";
echo "\n*   details.                                     *";
echo "\n*                                                *";
echo "\n*   You should have received a copy of the GNU   *";
echo "\n*   Library General Public License along with    *";
echo "\n*   this library.                                *";
echo "\n*	If not, write to the Free Software			 *";
echo "\n*                                                *";
echo "\n*   (*)If you feel that writing scripts and code *";
echo "\n*   is your forte, these are some agents who     *";
echo "\n*   specialise in handling this type of material *";
echo "\n*                                                *";
echo "\n**************************************************";

	    echo "\n\r\n\r";*/
		echo $this->licence();
			
		}//switch
	}

	public function licence() {
		$ret =
 "\n/***************************************************************************".
 "\n*                                                                          *".
 "\n*  Copyright 2018,     balexiou@stereobit.com                              *".
 "\n*                                                                          *".
 "\n*  Licensed under the Apache License, Version 2.0 (the \"License\");       *".
 "\n*  you may not use this file except in compliance with the License         *".
 "\n*  You may obtain a copy of the License at                                 *".
 "\n*                                                                          *".
 "\n*  http://www.apache.org/licenses/LICENSE-2.0                              *".
 "\n*                                                                          *".
 "\n*  Unless required by applicable law or agreed to in writing, software     *".
 "\n*  distributed under the License is distributed on an \"AS IS\" BASIS,     *".
 "\n*  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.*".
 "\n*  See the License for the specific language governing permissions and     *".
 "\n*  limitations under the License.                                          *".
 "\n*                                                                          *".
 "\n*                                                                          *".
 "\n****************************************************************************/\n";	
		return ($ret);
	}
}
?>