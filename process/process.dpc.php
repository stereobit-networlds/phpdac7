<?php
namespace Process;

class foo {
    static public function test($name) {
        //print '[['. $name .']]';
    }
	
    static public function autoload($class)  {	

        if (0 !== strpos($class, 'process')) 
            return;
		
        //echo dirname(__FILE__).'/'.str_replace(array('_', "\0"), array('/', ''), $class).'.php';
        if (file_exists($file = dirname(__FILE__).'/'.str_replace(array('_', "\0"), array('/', ''), $class).'.php')) {
            require $file;
        }
    }
}

ini_set('unserialize_callback_func', 'spl_autoload_call');
spl_autoload_register(__NAMESPACE__ .'\foo::autoload');

$__DPCSEC['PROCESS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if (!defined("PROCESS_DPC")) {
define("PROCESS_DPC",true);

$__DPC['PROCESS_DPC'] = 'process';

require_once(GetGlobal('controller')->require_dpc('process/pstack.lib.php'));
require_once(GetGlobal('controller')->require_dpc('process/processInst.lib.php'));

class process extends pstack {

	protected $proccesChain;

	public function __construct(& $caller, $chain=null, $cmd=null) {

		parent::__construct($caller); //not a name or stack in this
		
		if (strstr($chain,',')) //process chain
			$this->proccesChain = explode(',', $chain);
		else	
			$this->proccesChain[0] = $chain;
		
		//when no getreq t check at construct else after event
		if ((!$cmd) || ($cmd=='process')) 
			$this->isFinished();
		
		//echo 'construct: ' . $this->processName . '<br/>';
	}

	public function isFinished($event=null) {
		if (!$this->user) return false;		
		if ($this->isClosedProcess()) return true;
		
		$stack =  GetGlobal('controller')->getProcessStack(); 

		if ($this->debug) {
			echo '<br/>getEvent:' . $event;
			echo '<br/>getCaller:' . $this->callerName;
			echo '<br/>getChain:' . implode(',',$this->proccesChain);
			echo '<br/>getStack:';// . array_map(function($a) { return $a;}, $stack);;		
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
		$stack =  GetGlobal('controller')->getProcessStack();			
		
		try {
			$c = new $inst($this->caller, $this->callerName, $stack);
			if ($c->isFinished($event)) 
				return true;
		}	
		catch(Exception $e){
			//echo 'Process Exception:' . $e->getMessage();
			throw $e;
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