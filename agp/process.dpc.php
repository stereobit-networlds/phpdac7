<?php
if (!defined("PROCESS_DPC")) {
define("PROCESS_DPC",true);

$__DPC['PROCESS_DPC'] = 'process';

class process extends pstack /*implements Serializable*/ {

	var $env, $envStack, $envChain;
	public static $pdo;	

	public function __construct(& $env, $chain=null, $cmd=null) {	

	    self::$pdo = $env::$pdo;//initPDO();
	
	    //DISABLED
		//parent::__construct($this, 'kernelv2', $this->envStack); 
		
		$this->env = $env;
		$this->envStack = $this->getProcessStack();
		$this->envChain = $this->getProcessChain();		
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

	public function isFinished($event=null) {

		/*if ($this->debug) {
			echo PHP_EOL . 'getEvent:' . $event;
			echo PHP_EOL . 'getCaller:' . $this->callerName;
			echo PHP_EOL . 'getChain:' . @implode(',',$this->envChain);
			echo PHP_EOL . 'getStack:';// . array_map(function($a) { return $a;}, $stack);;		
			print_r($this->envStack);
		}*/

		switch ($this->pMethod) {
			
			case 'puzzled'    :	
				//when running pid is the process run id
			    $us = ($this->isRunningProcess()) ?	$this->clp : $this->pid;
				
				//run specific process class
				$usClass = str_replace('-','_', $us);
				$inChain = in_array($usClass, $this->envChain);		
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
				
					foreach ($this->envChain as $i=>$processInst) {
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
				if (!empty($this->envChain)) {
					foreach ($this->envChain as $i=>$processInst) {
						if (!$this->runInstance($processInst, $event)) 
							return false;
					}
				}
		}
		
		return true;
	}
	
	protected function runInstance($inst=null, $event=null) {
		if (!$inst) die('No instance to run!');		
		
		$file = 'agp/'. str_replace(array('_', "\0"), array('/', ''), $inst).'.php';
		if ($dac5 = $this->env->ldscheme) { 
			//agent	
			//$this->env->_echo($dac5 .'/'. $file);
			//echo $dac5 .'/'. $file;
			
			require_once ($dac5 .'/'. $file);
			if (class_exists($inst)) {
				//this interface
				$c = new $inst($this, $this->callerName, $this->envStack);
				if ($c->isFinished($event)) 
					return true;			
			}
		} 
        elseif (file_exists($file)) {
		    //kernel
			//$this->env->_echo($file);
			//echo $file;
        
			require_once $file;	
			if (class_exists($inst)) {	
                //this->env interface			
				$c = new $inst($this->env, $this->callerName, $this->envStack);
				if ($c->isFinished($event)) 
					return true;
			}	
		}
		//else
		//$this->env->_echo($file . ' not found!'); 	
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