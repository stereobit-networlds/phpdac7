<?php

class async extends processInst {
	
	protected $caller, $env, $nextCmd;
	public $_stack;
	
	public function __construct(& $caller, $callerName, $chain=null) {

		parent::__construct($caller, $callerName, $chain);
		$this->processStepName = __CLASS__;
		
		$this->caller = $caller;
		$this->env = $caller->env;
		//print_r($chain); echo '::async::';
		$this->_stack = $chain; //['kernel'];
		
		$pid = $this->getChainId(); //next
		$this->nextCmd = $this->_stack[$pid];
		echo "process async ({$this->nextCmd}): ". $this->caller->status . PHP_EOL;	
				
		//$this->loader("vendor/process/async/{$this->nextCmd}/"); //next cmd namespace		
	}
	
	//override
	protected function go($data=null) {
		//is tier call, exec
		if ($this->env->ldscheme) 
		{	
			$this->loader("vendor/process/async/{$this->nextCmd}/"); //next cmd namespace		
	
			$async = array_shift($this->_stack); //exclude self 'async' call
			$class = array_shift($this->_stack);
			
			return new $class($this);
			//$run = new $class($this);
			//return is_object($run) ? $run : false;
		}	
		//server part
		echo "--------- tier go()!!" . PHP_EOL;
		return false;		
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