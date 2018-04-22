<?php
//require_once('mail/smtpmail.dpc.php'); //mail 2 send
require_once('agp/pstack.lib.php');
require_once('agp/processInst.lib.php');
require_once("agp/process.dpc.php");

class proc 
{	
	public $env, $envname, $async;
	private $process, $processStack, $startProcess;	
	public static $pdo;	
	
	public function __construct(& $env=null) 
	{	
		$this->env = $env;
		$this->envname = get_class($env);
		
		self::$pdo = $env::pdoConn();

		$this->processStack = array();
		$this->startProcess = array();	
		
		$this->process = null;					
		$this->async = false;		
	}
	
	public function isAsyncProc()
	{
		return $this->async;
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

	//cnf say
	public function _say($msg, $type='TYPE_LION') 
	{
		$this->env->cnf->_say($msg, $type);
	}	
	
	//MUST BE POOLED (async) ...
	public function set($cmd=null) //from whom client !!! 
	{
		if (!$cmd) return false;
		$this->async = false; //reset
		
		if ($stack = $this->setProcessStack($cmd)) 
		{		
			$this->env->cnf->_say('set new proc: ' . $cmd, 'TYPE_LION');
			return $this; //fluent
		}
		return false;//$this; //fluent
	}
	
	public function go($event=null, $inputdata=null) 
	{
		if (empty($this->processStack)) return false;
		$data = $inputdata;
		
		foreach ($this->processStack as $p=>$chain)
		{	
		    //print_r($chain);
			$this->process = new process($this, null, $data);
			if ($data = $this->process->isFinished($event)) 
			{ 
				echo '>>>>>>>>>>>>>>>>>>>>>>>>>>PROCESSDATA:'. $data . PHP_EOL;
				if ($data=='async') 
				//if ($chain[0]=='async') 
				{
					echo "\x07"; //beep
					$achain = implode('/',$chain) .'/';
					echo '>>>>>>>>>>>>>>>>>>>>>>>>>>OPENPROCESS:'. $achain . PHP_EOL;
					$this->env->openProcess('process', $chain);
					//tier must return closed chain (server update stack)
		  		}			
				unset($this->process); 
				//return null;//$data; //true; //////////////test
			}
		}
		//unset($this->process);	
		//return $this; //fluent
		return ($data!=='async') ? $data : null; //true; //////////////test
		//return null;//false;
	}
	
	//private function processStack($processes) 
	private function setProcessStack($cmd) 
	{
		if (!$cmd) return false; 
		
		//piping async/x/y/z|a/b/c/
		if (strstr($cmd, '|')) 
		{
			$ps = explode('|', $cmd);
			foreach ($ps as $pd)
				$pcmd[] = explode('/',$pd);
		}	
		else 
			$pcmd[0] = explode('/',$cmd);		
		
		//print_r($processes);
		foreach ($pcmd as $p)
			$this->processStack[] = array_filter($p);

		$this->startProcess = array_filter($pcmd[0]); //1st
	
		//print_r(self::$startProcess);	
		//return true;	
		
		//save stack
		$this->env->save('srvProcessStack',	json_encode($this->processStack));
		
		return (array) $this->processStack;
	}
	
	public function getProcessStack() 
	{
		return (array) $this->processStack;
	}

	public function getProcessChain() 
	{	
		//return $this->startProcess[$this->envname];
		return (array) $this->startProcess; //1st
	}	
	
	public function getNextProcessChain() 
	{	
		$next = array_shift($this->processStack);
		//print_r($next);
		//print_r($this->processStack);
		
		//save	!!!DONT
		//echo '>>>>>>>>>>>>>>>>>>>>>>>>>>>SAVE' . PHP_EOL;
		//$this->env->save('srvProcessStack', json_encode($this->processStack));	
		
		return (array) $next;
	}
	
	//public function free()	
	public function __destruct() 
	{	
        unset($this->async);	
	} 	
}	
?>	