<?php

class hello extends processInst {
	
	protected $env, $_stack;
	
	public function __construct(& $caller, $callerName, $stack=null) {

		parent::__construct($caller, $callerName, $stack);
		$this->processStepName = __CLASS__;
		
		$this->env = $caller->env;
		$this->_stack = $stack['kernel'];

		echo 'process 1:' . $this->caller->status . PHP_EOL;
		//echo 'stack:' . implode('-', $this->_stack) .  PHP_EOL;
		
		//$this->loader('vendor/immutable/');
	}
	
	protected function go() {
		
		$pid = $this->getChainId()-1;
		echo '>>>' . $this->_stack[$pid] . '<<<<';
		
		
		//test imo
		//1st type of include
		/*$phpdac = isset($this->env->ldscheme) ? 
						$this->env->ldscheme .'/' : null;
		require_once($phpdac . 'vendor/immutable/immutable.php');
		*/
		
		require_once($this->_include('vendor/immutable/immutable.php'));
		
		$immX = ImmutableC::create()
							->set('test', 'a string goes here')
							->set('another', 100)
							->arr([1,2,3,4,5,6])
							->arr(['a' => 1, 'b' => 2])
							->build();
		echo (string) $immX;
					
		$immY = ImmutableC::create()
							->set('anObject', $immX)
							->build();
		echo (string) $immY;
		echo $immY->get('test'); // a string goes here
		var_dump($immY->has('test')); // bool(true)
		var_dump($immY->has('non-existent')); // bool(false)
		echo $immY->getOrElse('test', 'some default text'); // a string goes here
		echo $immY->getOrElse('non-existent', 'some default text'); // some default text
					
		$immZ = ImmutableC::with($immY)
							->set('a story', 'This is where someone should write a story')
							->setIntKey(300, 'My int indexed value')
							->arr(['arr: int indexed', 'arr' => 'arr: assoc key becomes immutable key'])
							->build();
		echo (string) $immZ;
							
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
			
			$this->go();
			
			$this->stackRunStep(1);
			return true;
		};
		
		//$this->stackRunStep();		
		return false;		
	}	

}
?>