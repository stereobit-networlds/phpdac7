<?php

class asyncloop extends processInst {
	
	protected $caller, $env, $_stack;
	
	public function __construct(& $caller, $callerName, $stack=null) {

		parent::__construct($caller, $callerName, $stack);
		$this->processStepName = __CLASS__;
		
		$this->caller = $caller;
		$this->env = $caller->env;
		$this->_stack = $stack['kernel'];
		array_shift($this->_stack); //exclude self 'async' call
		
		$pid = $this->getChainId(); //next
		echo "process asyncloop ({$this->_stack[$pid]}): ". $this->caller->status . PHP_EOL;
		
		include_once($this->_include("tier/imot.lib.php"));
		$this->loader('vendor/process/async/');
	}
	
	//override
	protected function go($data=null) {
		
		//array_shift($this->_stack); //exclude self 'async' call	
		$etl = $this->runETL($this->_stack);
		if (is_object($etl)) {	
			//ETL input
			echo "> AsynLoop - MessageWriter:\n";
			$str='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus congue lectus, nec interdum erat ornare nec. Nunc tincidunt lobortis augue at vehicula.';
			
			//ETL output loop
			for($i=1;$i<=10;$i++) {
				$etl->writeText('['.$i.']' . $str);//$str);
			}
		}		
		return $str; //true //????
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