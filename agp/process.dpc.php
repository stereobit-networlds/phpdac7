<?php
//require_once('mail/smtpmail.dpc.php'); //mail 2 send
require_once('agp/pstack.lib.php');
require_once('agp/processInst.lib.php');

class process extends pstack {

	protected $proccesChain;

	public function __construct(& $caller, $chain=null, $cmd=null) {

		parent::__construct($caller); //not a name or stack in this
		
		if (strstr($chain,',')) //process chain
			$this->proccesChain = explode(',', $chain);
		else	
			$this->proccesChain[0] = $chain;
		
		//when no getreq t check at construct else after event
		//if ((!$cmd) || ($cmd=='process')) 
			//$this->isFinished(); //!!! err 2 times
		
		//echo 'construct: ' . $this->processName . PHP_EOL;
	}
	/*
    static public function autoload($class)  {	

        //if (0 !== strpos($class, 'agp')) 
          //  return;
		
        //echo dirname(__FILE__).'/'.str_replace(array('_', "\0"), array('/', ''), $class).'.php';
        //if (file_exists($file = 'agp/'. str_replace(array('_', "\0"), array('/', ''), $class).'.php')) {
			$file = 'agp/'. str_replace(array('_', "\0"), array('/', ''), $class).'.php';
			$this->caller->getdpcmem($file);
            require $file;
        //}
    }	
	*/
	public function isFinished($event=null) {
		//if (!$this->user) return false;	//!!!!!!!!!!!!	
		if ($this->isClosedProcess()) return true;
		
		$stack =  $this->caller->getProcessStack(); 

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
				}
		}

		return true;
	}
	
	protected function runInstance($inst=null, $event=null) {
		if (!$inst) die('No instance to run!');		
		$stack =  $this->caller->getProcessStack();			
		
		//echo 'agp/'. str_replace(array('_', "\0"), array('/', ''), $inst).'.php';
		//if (isset($this->dpc_addr[$dpc]))
        //if (file_exists($file = dirname(__FILE__).'/'. str_replace(array('_', "\0"), array('/', ''), $inst).'.php')) {
		if ($this->caller->getdpcmemc('agp/'. str_replace(array('_', "\0"), array('/', ''), $inst).'.php')) {	
			echo  PHP_EOL;
            
			//insert code to shmem
			/* $code = *///$this->caller->getdpcmemc('agprocess/'. str_replace(array('_', "\0"), array('/', ''), $inst).'.php');
			
			//require $file;
            require_once 'agp/'. str_replace(array('_', "\0"), array('/', ''), $inst).'.php';			
        	
			$c = new $inst($this->caller, $this->callerName, $stack);
			if ($c->isFinished($event)) 
				return true;
		}
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
//ini_set('unserialize_callback_func', 'spl_autoload_call');
//spl_autoload_register('process::autoload');
?>