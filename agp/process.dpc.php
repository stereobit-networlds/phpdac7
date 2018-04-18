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
		//parent::__construct($this, 'kernel', $this->envStack); 
		
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
		if (empty($this->envChain)) return false;

		/*if ($this->debug) {
			echo PHP_EOL . 'getEvent:' . $event;
			echo PHP_EOL . 'getCaller:' . $this->callerName;
			echo PHP_EOL . 'getChain:' . @implode(',',$this->envChain);
			echo PHP_EOL . 'getStack:';// . array_map(function($a) { return $a;}, $stack);;		
			print_r($this->envStack);
		}*/

		switch ($this->envChain[0]) {
			
			/*case 'puzzled'    :	
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
				break;*/
				
			case 'async'      : //only the async handler (rest in async)
			case 'asyncloop'  : //only the async handler (rest in asyncloop)
								if (!$this->runInstance($this->envChain[0], $event, null)) 
									return false;
								break;				
				
			case 'sync'       : 
			case 'syncloop'   :	
								$restStack = $this->envChain; //init copy
								foreach ($this->envChain as $i=>$processInst) 
								{
									if (!$this->runInstance($processInst, $event, null))
									{	//continue async a+switch cmd
										//$this->env->env->mem->save...
										if (!empty($restStack)) //must be saved or rewind by 1 ??
											return $this->runInstance('a'.$this->envChain[0], $event, null);//$restStack	
										else
											return false;
									}	
									//else export executed cmd	
									$dummy = array_shift($restStack); //must me saved in srv mem!!			
									print_r($restStack);
								}
								break;
			case 'balanced'   :				
			default           :
								//if ($rid = $this->isRunningProcess()) 
								//echo 'Running:' . $rid;
								foreach ($this->envChain as $i=>$processInst) {
									if (!$this->runInstance($processInst, $event, null)) 
										return false;
								}
								//}
		}
		
		return true;
	}
	
	protected function runInstance($inst=null, $event=null, $stack=null) {
		if (!$inst) die('No instance to run!');		
		$file = 'agp/'. str_replace(array('_', "\0"), array('/', ''), $inst).'.php';
		
		$myStack = isset($stack) ? array('kernel'=>$stack) : $this->envStack;
		
		if ($dac5 = $this->env->ldscheme) { 
			//agent
			require_once ($dac5 .'/'. $file);
			if (class_exists($inst)) {
				//this interface
				$c = new $inst($this, $this->callerName, $myStack);
				if ($c->isFinished($event)) 
					return true;			
			}
		} 
        elseif (file_exists($file)) {
		    //kernel
			require_once $file;	
			if (class_exists($inst)) {	
                //this->env interface			
				$c = new $inst($this->env, $this->callerName, $myStack);
				if ($c->isFinished($event)) 
					return true;
			}	
		}
		//else
		//$this->env->_echo($file . ' not found!'); 	
		echo $file . ' not found!' . PHP_EOL;

		return false;	
	}
	
	//method #2 (just require/fetch)
	protected function getInstance($inst=null, $vendor='agp/') {
		if (!$inst) die('No instance to run!');		
		$file = $vendor . str_replace(array('_', "\0"), array('/', ''), $inst).'.php';
		
		if ($dac5 = $this->env->ldscheme) { 
			//agent
			require_once ($dac5 .'/'. $file);
			if (class_exists($inst)) {
					return true;			
			}
		} 
        elseif (file_exists($file)) {
		    //kernel
			require_once $file;	
			if (class_exists($inst)) {	
					return true;
			}	
		}

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