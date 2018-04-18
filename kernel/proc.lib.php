<?php
//require_once('mail/smtpmail.dpc.php'); //mail 2 send
require_once('agp/pstack.lib.php');
require_once('agp/processInst.lib.php');
require_once("agp/process.dpc.php");

class proc 
{	
	public $env, $envname, $async, $sync;
	private $process, $processStack, $startProcess;	
	public static $pdo;	
	
	public function __construct(& $env=null) 
	{	
		$this->env = $env;
		$this->envname = get_class($env);
		
		self::$pdo = $env::pdoConn();

		$this->processStack = array();
		$this->startProcess = array();	
		
		$this->sync = false;
		$this->async = false;
		$this->process = null;					
	}
	
	public function isSyncProc()
	{
		return ($this->sync==true) ? true : false;
	}
	
	public function isaSyncProc()
	{
		return ($this->async==true) ? true : false;
	}		
	
	//dmn Println
	public function _echo($msg) 
	{
		$this->env->_echo($msg);
	}
	
	//env interface
	public function pdoQuery($dpc)
	{
		return ($this->env->pdoQuery($dpc));
	}
	
	//env interface
	public function pdoExec($prep, $vals)
	{
		return ($this->env->pdoExec($prep, $vals));
	}		
	
	//MUST BE POOLED (async/asyncloop)
	public function set($cmd=null) 
	{
		//if (!$cmd) return false; //fluent
		if (isset($cmd)) {
			$this->async = false; //reset
			$this->sync = false; //reset
			$pcmd = explode('/',$cmd);
			
			if (($pcmd[0]=='async') || ($pcmd[0]=='asyncloop')) 
			{
				//async/asyncloop must exist as class, no shift
				$this->async = true;//array_shift($pcmd); 
	
				$this->processStack($pcmd);
			
				//save in sh mem as resource var (not in resources)
				$this->env->save('srvProcessStack',
									json_encode($this->getProcessStack()));
				$this->env->save('srvProcessChain',
									json_encode($this->getProcessChain()));
				
				echo "\x07"; //beep
				$this->env->cnf->_say('new proc (async): ' . $dpc, 'TYPE_LION');
				
				//open new win/thread
				$this->env->openProcess('process', $dpc);
				
				//return 1;
			}
			elseif (($pcmd[0]=='sync') || ($pcmd[0]=='syncloop')) 
			{
				//sync asyncs ...!!
				$this->env->cnf->_say('new proc (sync): ' . $dpc, 'TYPE_LION');
				
				$this->sync = true;
				$this->processStack($pcmd);
				
				//return -1;
			}	
			else //srv execute
				$this->processStack($pcmd);
			
			//return 0; 
		}
		
		return $this; //fluent
	}
	
	public function go() 
	{
		$this->process = new process($this);//, $c, null);
		if ($this->process->isFinished(null)) {
			//echo implode('|', $c) . ' finished!' . PHP_EOL;
			//$this->env->cnf->_say(implode('|', $this->getProcessChain()) . ' finished', 'TYPE_LION');			
			
			//unset chain,stack ?
			//unset($this->process); //nofluent
			return true; //nofluent
		}
		//unset($this->process);	
		
		return $this; //fluent
	}
	
	private function processStack($processes) 
	{
		$dpc = $this->envname;
		
		$this->processStack[$dpc] = array_filter($processes);//, 
			//function($value) { return $value !== ''; });	
		
		$this->startProcess = array(); //reset
		$this->startProcess[$dpc] = array_filter($processes);//, 
			//function($value) { return $value !== ''; });			
			
		//print_r(self::$startProcess);	
		return true;	
	}
	
	public function getProcessStack() 
	{
		return (array) $this->processStack;
	}	
	
	public function getProcessChain() 
	{	
		return $this->startProcess[$this->envname];
		
		/*$processChain = array();
		  foreach (self::$startProcess as $inDpc=>$processArray) {
			if ($inDpc==__CLASS__) {
				foreach ($processArray as $process)
					$processChain[] = $process;	
			}	
		}*/		
		//print_r($pChain);
		//echo implode(',',$processChain) . PHP_EOL;
		//if (!empty($processChain))
			//return implode(',',$processChain);	
			
		//return false;
		/*
		return array_filter(self::$startProcess, 
			function($value, $key) { 
				echo $key;
				print_r($value);
				return $key ==__CLASS__;
			}, ARRAY_FILTER_USE_BOTH);		
		*/	
	}
	
	//public function free()	
	public function __destruct() 
	{	
        unset($this->async);	
	} 	
}	
?>	