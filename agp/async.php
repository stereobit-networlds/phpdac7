<?php

class async extends processInst {
	
	protected $caller, $env, $_stack;
	
	public function __construct(& $caller, $callerName, $stack=null) {

		parent::__construct($caller, $callerName, $stack);
		$this->processStepName = __CLASS__;
		
		$this->caller = $caller;
		$this->env = $caller->env;
		$this->_stack = $stack['kernel'];
		array_shift($this->_stack); //exclude self 'async' call
		
		$pid = $this->getChainId(); //next
		//$prevChainData = $caller->setPost(null, null, $pid);
		echo "process async ({$this->_stack[$pid]}): ". $this->caller->status . PHP_EOL;	
		
		include_once($this->_include("tier/imot.lib.php"));		
		$this->loader('vendor/process/async/');	
	}
	
	//override
	protected function go($data=null) {
		
		$immX = ImmutableC::create()
							->set('test', 'a string goes here:' . $data)
							->set('another', 100)
							->arr([1,2,3,4,5,6])
							->arr(['a' => 1, 'b' => 2])
							->build();
		echo 'async:' . $immX . PHP_EOL;		
		
		echo "Async - MessageWriter:\n";
		$str='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus congue lectus, nec interdum erat ornare nec. Nunc tincidunt lobortis augue at vehicula.';
		
		//array_shift($this->_stack); //exclude self 'async' call
		if ($etl = $this->runETL($this->_stack))
		{
			//ETL output
			echo "Output:\n";
			$etl->writeText($str, $immX) . PHP_EOL;
		}		
		return $immX;
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