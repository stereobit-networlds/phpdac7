<?php
if (!defined("PROCESS_DPC")) {
define("PROCESS_DPC",true);

$__DPC['PROCESS_DPC'] = 'process';

class process extends pstack {

	public $env, $envStack, $envChain, $envData;	

	public function __construct(& $env, $chain=null, $data=null) {	

		$this->env = $env;
		$this->envData = $data;		
		$this->envStack = $this->getProcessStack();
		//print_r($this->envStack);		
		//$this->envChain = $this->getProcessChain();	
		$this->envChain = $this->getNextProcessChain(); //srv read chain
		//print_r($this->envChain); 	
		
		parent::__construct($env, 'kernel', $this->envStack);//array('kernel'=>$this->envStack));//$this->envStack); 
		$this->debug = false;	//override
		
		//$this->pMethod = $this->envChain[0]; //override
	}	
	
	public function getProcessStack() 
	{
		if ($dac5 = $this->env->ldscheme)
		{
			$s = file_get_contents($dac5 . '/srvProcessStack');
			return (array) json_decode($s);
		}
		else
			return (array) $this->env->getProcessStack(); //proc
	}
	
	public function getProcessChain() 
	{
		if ($dac5 = $this->env->ldscheme)
		{
			$c = file_get_contents($dac5 . '/srvProcessChain');
			return (array) json_decode($c);
		}
		else
			return (array) $this->env->getProcessChain(); //proc		
	}	
	
	public function getNextProcessChain() 
	{
		if ($dac5 = $this->env->ldscheme)
		{
			//$c = file_get_contents($dac5 . '/srvProcessChain');
			//return (array) json_decode($c);
			
			/*if (!empty($this->envChain)) //readed 1st
				$next = array_shift($this->envStack);
			else
			{*/	
				//read srv var
				$s = file_get_contents($dac5 . '/srvProcessStack');
				$stack = json_decode($s);
				//print_r($stack); echo '::next::';
				$next = array_shift($stack);
			//}	
			return (array) $next;
		}
		else
		{
			//proc
			return (array) $this->env->getNextProcessChain(); 
			
		}	
	}	
	
	public function isFinished($event=null, $data=null) {
		//print_r($this->envChain); echo '::isFinished::';
		if (empty($this->envChain)) return;
		
		$this->pMethod = $this->envChain[0];	
		$chainData = isset($data) ? $data : $this->envData;		

		/*if ($this->debug) {
			echo PHP_EOL . 'getEvent:' . $event;
			echo PHP_EOL . 'getCaller:' . $this->callerName;
			echo PHP_EOL . 'getChain:' . @implode(',',$this->envChain);
			echo PHP_EOL . 'getStack:';// . array_map(function($a) { return $a;}, $stack);;		
			print_r($this->envStack);
		}*/

		switch ($this->pMethod) {			
				
			case 'async'      : //exec srv async class and call tier
			/*case 'asyncloop'  :*/ //only the async handler (rest exec in tier)
								//if (!$this->runInstance($this->envChain[0], $event, null, $chainData)) 
									//return false;  //async data cant be returned
									//$chainData = false;
								$this->runInstance($this->envChain[0], $event, $this->envChain, $chainData);	
								$chainData = 'async'; //test true
								break;				
				
			case 'sync'       : //srv exec
			/*case 'syncloop'   :*/	//sync serial process until unknown class found, 
								//then transform call to tier call !!
								$restStack = $this->envChain; //init copy
								foreach ($this->envChain as $i=>$processInst) 
								{   
									if (!$data = $this->runInstance($processInst, $event, $this->envChain, $chainData))
									{	
										//continue async a+switch cmd
										if (!empty($restStack)) 
										{   //print_r($restStack); echo '::restStack::';
											//recursion, make async proc for the rest
											$asc = 'a'. $this->pMethod;
											$innerAsyncDpc = $asc .'/' . implode('/',$restStack) . '/';
											//async data cant be returned
											//go() return null, or !!! leave prev data to return
											return (new proc($this->env->env))
															->set($innerAsyncDpc)
															->go($event, $chainData);
										}	
										//else / return chain data (synced)!!
										$chainData = 'async'; //test true //return false;
									}
									else {		
										//else export executed cmd	
										$dummy = array_shift($restStack); 			
										//print_r($restStack);
										$chainData = $data; //data to pass
									}
								}
								break;
			case 'balanced'   :				
			default           : //if ($rid = $this->isRunningProcess()) 
								//echo 'Running:' . $rid;
								foreach ($this->envChain as $i=>$processInst) {
									if (!$data = $this->runInstance($processInst, $event, $this->envChain, $chainData)) 
										$chainData = false;
									//else
									$chainData = $data;
								}
								//}
		}
		
		//recussion
		/*if ($this->envChain = $this->getNextProcessChain())
		{	
			if ($dac5 = $this->env->ldscheme) {
				;//else error re-loading async without new
			}
			else	
				$chainData = $this->isFinished($event, $chainData);
		}*/	
		//else
		return ($chainData);//true;
	}
	
	protected function runInstance($inst=null, $event=null, $chain=null, $data=null) {
		if (!$inst) die('No instance to run!');		
		$file = 'agp/'. str_replace(array('_', "\0"), array('/', ''), $inst).'.php';
		
		$myChain = isset($chain) ? $chain : $this->envChain;
		
		if (!class_exists($inst)) //already loaded class name
		{
			if ($dac5 = $this->env->ldscheme) { 
				//agent
				include_once ($dac5 .'/'. $file);
			}	
			elseif (file_exists($file)) {
				//kernel
				include_once $file;	
			}
		}
		
		if (class_exists($inst)) { //loaded class check
			try { 
				//if it is async and class exists, try...
				$c = new $inst($this, $this->callerName, $myChain);
				if ($data = $c->isFinished($event, $data)) 
					return $data;			
			}
			catch (Throwable $t) {
				$this->env->_say($inst . ' class found with errors!', 'TYPE_LION');
				echo $t . PHP_EOL; //<<<<<<<<< err
				return false;
			}
		}
		//else
			//$this->env->_say($inst . ' class not exist!', 'TYPE_LION');
		
		$this->env->_say($inst . ' not found!', 'TYPE_LION');
		return false;	
	}
	
	//method #2 (just require/fetch)
	protected function getInstance($inst=null, $vendor='agp/') {
		if (!$inst) die('No instance to run!');		
		$file = $vendor . str_replace(array('_', "\0"), array('/', ''), $inst).'.php';
		
		if ($dac5 = $this->env->ldscheme) { 
			//agent
			include_once ($dac5 .'/'. $file);
		}
        elseif (file_exists($file)) {
		    //kernel
			include_once $file;	
		}
		
		if (class_exists($inst))
			return true;			

		return false;	
	}	

	//fire-up a running process instance from the calling object 
	public function start() {
		
		if ($this->stackRun())
			return true;
		
		return false;
	}	
 
};
}
?>