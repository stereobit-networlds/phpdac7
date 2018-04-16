<?php

class async extends processInst {
	
	protected $env, $_stack;
	
	public function __construct(& $caller, $callerName, $stack=null) {

		parent::__construct($caller, $callerName, $stack);
		$this->processStepName = __CLASS__;
		
		$this->env = $caller->env;
		$this->_stack = $stack['kernel'];
		$pid = $this->getChainId(); //next
		
		echo "process async ({$this->_stack[$pid]}): ". $this->caller->status . PHP_EOL;
		
		//$this->loader('vendor/process/async/');
		//new $this->_stack[$pid]();
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
	public function isFinished($event=null) {
		
		if (!parent::isFinished($event)) {
			//$this->stackRunStep();
			return false;
		}	
		
		if ($this->runCode(0, $event)) {
			//$cwd = getcwd();
			//exec("start /D $cwd tierp.bat process"); 
			//echo "ASYNC start /D $cwd tierp.bat process<<<<<<<<<<<<<<";
			$this->stackRunStep(1);
			return true;
		};
		
		//$this->stackRunStep();		
		return false;		
	}	

}
?>