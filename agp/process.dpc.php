<?php
if (!defined("PROCESS_DPC")) {
define("PROCESS_DPC",true);

$__DPC['PROCESS_DPC'] = 'process';

class process extends pstack {

	public $env, $envStack, $envChain, $envData;	

	public function __construct(& $env, $chain=null, $data=null) {	

		$this->env = $env;
		$this->envStack = $this->getProcessStack();
		$this->envChain = $this->getProcessChain();
		$this->envData = $data;
		
		parent::__construct($env, 'kernel', $this->envStack); 
		$this->debug = true;	//override
		
		$this->pMethod = $this->envChain[0]; //override
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
	
	public function isFinished($event=null) {
		if (empty($this->envChain)) return false;
		$chainData = $this->envData;

		/*if ($this->debug) {
			echo PHP_EOL . 'getEvent:' . $event;
			echo PHP_EOL . 'getCaller:' . $this->callerName;
			echo PHP_EOL . 'getChain:' . @implode(',',$this->envChain);
			echo PHP_EOL . 'getStack:';// . array_map(function($a) { return $a;}, $stack);;		
			print_r($this->envStack);
		}*/

		switch ($this->pMethod) {
			
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
								if (!$this->runInstance($this->envChain[0], $event, null, $chainData)) 
									//return false;  //async data cant be returned
									$chainData = false;
								break;				
				
			case 'sync'       : 
			case 'syncloop'   :	
								$restStack = $this->envChain; //init copy
								foreach ($this->envChain as $i=>$processInst) 
								{   
									if (!$data = $this->runInstance($processInst, $event, null, $chainData))
									{	
										//continue async a+switch cmd
										if (!empty($restStack)) 
										{   
											//recursion, make async proc for the rest
											$asc = 'a'. $this->pMethod;
											$innerAsyncDpc = $asc .'/' . implode('/',$restStack) . '/';
											//async data cant be returned
											//go() return null, or !!! leave prev data to return
											return (new proc($this->env->env))
															->set($innerAsyncDpc)
															->go($event, $chainData);
										}	
										//else
										//$chainData = false;	//return false;
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
			default           :
								//if ($rid = $this->isRunningProcess()) 
								//echo 'Running:' . $rid;
								foreach ($this->envChain as $i=>$processInst) {
									if (!$data = $this->runInstance($processInst, $event, null, $chainData)) 
										$chainData = false;
									//else
									$chainData = $data;
								}
								//}
		}
		
		return ($chainData);//true;
	}
	
	protected function runInstance($inst=null, $event=null, $stack=null, $data=null) {
		if (!$inst) die('No instance to run!');		
		$file = 'agp/'. str_replace(array('_', "\0"), array('/', ''), $inst).'.php';
		
		$myStack = isset($stack) ? array('kernel'=>$stack) : $this->envStack;
		
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
				$c = new $inst($this, $this->callerName, $myStack);
				if ($data = $c->isFinished($event, $data)) 
					return $data;			
			}
			catch (Throwable $t) {
				$this->env->_say($inst . ' found, try async!', 'TYPE_LION');
				echo $t . PHP_EOL;
				return false;
			}
		}
		
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