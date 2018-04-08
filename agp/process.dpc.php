<?php
if (!defined("PROCESS_DPC")) {
define("PROCESS_DPC",true);

$__DPC['PROCESS_DPC'] = 'process';

class process extends pstack /*implements Serializable*/ {

	var $env;

	public function __construct(& $env, $chain=null, $cmd=null) {

		parent::__construct($env, null, null); //not a name or stack in this
		
		$this->env = $env;
	}
	
	//serialize funcs as agent
	/*
	public function serialize()
	{
		return serialize(array($this->caller, $this->chain, $this->cmd));
	}

	public function unserialize($serialized)
	{
		list($this->caller, $this->chain, $this->cmd) = unserialize($serialized);
		//$this->caller::initPDO();
		//self::$pdo = @new PDO('mysql:host=localhost;dbname=basis;charset=utf8', 'e-basis', 'sisab2018');
	}*/	
	
	//agent or server, request var
	/*public function getMyProcessStack() 
	{
		//return (array) $this->caller::$processStack;
		return $this->env->getProcessStack();
	}

	public function getMyProcessChain() 
	{	//echo 'XXXXXXXXXX' . $this->env->ldscheme;
		$c = file_get_contents($this->env->ldscheme . '/srvProcessChain');
		//echo 'THIS chain:' . $c;	
		return $c;	
		//return (array) $this->caller::$processStack;
		//return $this->env->getProcessChain();
	}	*/

	public function isFinished($event=null) {

		$stack =  $this->env->getProcessStack(); 

		if ($this->debug) {
			echo PHP_EOL . 'getEvent:' . $event;
			echo PHP_EOL . 'getCaller:' . $this->callerName;
			echo PHP_EOL . 'getChain:' . implode(',',$this->env->getProcessChain());
			echo PHP_EOL . 'getStack:';// . array_map(function($a) { return $a;}, $stack);;		
			print_r($stack);
		}

		switch ($this->pMethod) {
			
			case 'puzzled'    :	
				//when running pid is the process run id
			    $us = ($this->isRunningProcess()) ?	$this->clp : $this->pid;
				
				//run specific process class
				$usClass = str_replace('-','_', $us);
				$inChain = in_array($usClass, $this->env->getProcessChain());		
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
				
					foreach ($this->env->getProcessChain() as $i=>$processInst) {
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

				foreach ($this->env->getProcessChain() as $i=>$processInst) {
					if (!$this->runInstance($processInst, $event)) 
						return false;
				}
		}
		
		return true;
	}
	
	protected function runInstance($inst=null, $event=null) {
		if (!$inst) die('No instance to run!');		
		
		$stack =  $this->env->getProcessStack();			
		
		$file = 'agp/'. str_replace(array('_', "\0"), array('/', ''), $inst).'.php';
		if ($dac5 = $this->env->ldscheme) { 
			//agent	
			echo  $dac5 .'/'. $file . PHP_EOL;
			
			require_once ($dac5 .'/'. $file);
			$c = new $inst($this->env, $this->callerName, $stack);
			if ($c->isFinished($event)) 
				return true;			
		} 
        elseif (file_exists($file)) {
		    //kernel
			echo  $file . PHP_EOL;
        
			require_once $file;			
			$c = new $inst($this->env, $this->callerName, $stack);
			if ($c->isFinished($event)) 
				return true;
		}
		else
			echo $file . ' not found!' . PHP_EOL; 	

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