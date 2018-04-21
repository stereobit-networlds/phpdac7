<?php

class async extends processInst {
	
	protected $caller, $env, $nextCmd;
	public $_stack;
	
	public function __construct(& $caller, $callerName, $stack=null) {

		parent::__construct($caller, $callerName, $stack);
		$this->processStepName = __CLASS__;
		
		$this->caller = $caller;
		$this->env = $caller->env;
		$this->_stack = $stack['kernel'];
		
		$pid = $this->getChainId(); //next
		$this->nextCmd = $this->_stack[$pid];
		echo "process async ({$this->nextCmd}): ". $this->caller->status . PHP_EOL;	
		
		include_once($this->_include("tier/imot.lib.php"));		
		$this->loader("vendor/process/async/{$this->nextCmd}/"); //next cmd namespace		
	}
	
	//override
	protected function go($data=null) {
		if (!$this->env->ldscheme) 
		{	
			//is srv call, dont exec
			echo "--------- tier go()!!" . PHP_EOL;
			return false;
		}	
		$async = array_shift($this->_stack); //exclude self 'async' call
		$class = array_shift($this->_stack);
		return new $class($this);
	}	
 
	//override
	public function nextStep($event=null) {
		return parent::nextStep($event);
	}
	
	//override
	public function prevStep($event=null) {
		return parent::prevStep($event);
	}	
	
	//override
	public function isFinished($event=null, $data=null) {
		
		if (!parent::isFinished($event)) {
			//$this->stackRunStep();
			return false;
		}	
		
		if ($this->runCode(0, $event)) {
			
			$this->stackRunStep(1);
			//return true;
			return ($this->go($data));
		};
		
		//$this->stackRunStep();		
		return false;		
	}	

}
?>