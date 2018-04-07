<?php
if (!defined("PROCESS_DPC")) {
define("PROCESS_DPC",true);

$__DPC['PROCESS_DPC'] = 'process';

class process extends pstack {

	protected $proccesChain;

	public function __construct(& $caller, $chain=null, $cmd=null) {

		parent::__construct($caller); //not a name or stack in this
		
		//$this->proccesChain = (array) $chain;
		$this->proccesChain = (array) !empty($chain) ? $chain :
									  $caller::processChain(); //srv call if not as param
		//print_r($this->proccesChain);
		
		//when no getreq t check at construct else after event
		//if ((!$cmd) || ($cmd=='process')) 
			//$this->isFinished(); //!!! err 2 times
		
		//echo 'construct: ' . $this->processName . PHP_EOL;
	}
	
	//get from caller = this, kernel not exist as caller when run on agent 
	//else if run from kernel, kernel exist as caller
	static public function getProcessStack() 
	{
		return (array) $caller::$processStack;
	}	

	public function isFinished($event=null) {
		//if (!$this->user) return false;	//!!!!!!!!!!!!	
		if ($this->isClosedProcess()) return true; //ask sql
		
		$stack =  $this->caller::getProcessStack(); 

		if ($this->debug) {
			echo PHP_EOL . 'getEvent:' . $event;
			echo PHP_EOL . 'getCaller:' . $this->callerName;
			echo PHP_EOL . 'getChain:' . implode(',',$this->proccesChain);
			echo PHP_EOL . 'getStack:';// . array_map(function($a) { return $a;}, $stack);;		
			print_r($stack);
		}
		
		switch ($this->pMethod) {
			
			case 'puzzled'    :	
				//when running pid is the process run id
			    $us = ($this->isRunningProcess()) ?	$this->clp : $this->pid;
				
				//run specific process class
				$usClass = str_replace('-','_', $us);
				$inChain = in_array($usClass, $this->getProcessChain());		
				if ((class_exists($usClass)) && ($inChain)) {
					if (!$this->runInstance($usClass, $event)) 
						return false;	
				}	
				break;			
			
			case 'serialized' : 
			    if ($rid = $this->isRunningProcess()) {
					//echo 'Running:' . $rid;
					//get next state call
					list($stateClass,$stateCaller,$stateUser, $stateStatus) = $this->getProcessStep();
					echo 'class:' . $stateCaller .'/'.$stateClass .'/'.$this->callerName.'<br/>'; 
					if (($stateClass) && ($stateCaller == $this->callerName)) { 
						if (!$this->runInstance($stateClass, $event)) 
							return false;
					}
					//else
					break;
				}	
				else { //static run
					//check execution state by saving the caller class name
					//echo $this->callerName,':',GetSessionParam('pCallerName');
					if (($sCaller = GetSessionParam('pCallerName')) && ($this->callerName != $sCaller))
						return false;
				
					foreach ($this->proccesChain as $i=>$processInst) {
						if (!$this->runInstance($processInst, $event)) { 
							SetSessionParam('pCallerName', $this->callerName);
							return false;
						}	
					}
					//when true reset
					SetSessionParam('pCallerName', null); 
				}
				break;
				
			case 'balanced'   :			
			default           :
				//if ($rid = $this->isRunningProcess()) 
					//echo 'Running:' . $rid;
		
				foreach ($this->proccesChain as $i=>$processInst) {
					if (!$this->runInstance($processInst, $event)) 
						return false;
					//echo $processInst . '>';
				}
		}

		return true;
	}
	
	protected function runInstance($inst=null, $event=null) {
		if (!$inst) die('No instance to run!');		
		$stack =  $this->caller::getProcessStack();			
		
		echo 'agp/'. str_replace(array('_', "\0"), array('/', ''), $inst).'.php';
		//if (isset($this->dpc_addr[$dpc]))
        if (file_exists($file = 'agp/'. str_replace(array('_', "\0"), array('/', ''), $inst).'.php')) {
		//if ($this->caller->getdpcmemc('agp/'. str_replace(array('_', "\0"), array('/', ''), $inst).'.php')) {	
			echo  PHP_EOL;
            
			//insert code to shmem
			/* $code = *///$this->caller->getdpcmemc('agprocess/'. str_replace(array('_', "\0"), array('/', ''), $inst).'.php');
			
			require_once $file;
            //require_once 'agp/'. str_replace(array('_', "\0"), array('/', ''), $inst).'.php';			
        	
			$c = new $inst($this->caller, $this->callerName, $stack);
			if ($c->isFinished($event)) 
				return true;
		}
		//else
		echo ' not found!' . PHP_EOL; 	

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