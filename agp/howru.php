<?php

class howru extends processInst {
	
	protected $env, $_stack;
	
	public function __construct(& $caller, $callerName, $stack=null) {

		parent::__construct($caller, $callerName, $stack);
		
		$this->processStepName = __CLASS__;
		
		$this->env = $caller->env;
		$this->_stack = $stack['kernel'];
		
		echo 'process 2:' . $this->caller->status . PHP_EOL;
		//echo 'stack:' . implode('-', $this->_stack['kernel']) . PHP_EOL;
		
		//spl_autoload_register(array($this, 'loader')); //1st loader
		$this->loader('vendor/message/');
	}
	
	protected function go() {
		
		$pid = $this->getChainId()-1;
		echo '>>>' . $this->_stack[$pid] . '<<<<';
		
		$str='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus congue lectus, nec interdum erat ornare nec. Nunc tincidunt lobortis augue at vehicula.';
 
		echo "MessageWriter:\n";
		$writer1 = new MessageWriter();
		$writer1->writeText($str);
		echo "\n";
		echo "GzCompressMessageWriterDecorator - MessageWriter\n";
		$writer2 = new GzCompressMessageWriterDecorator( new MessageWriter() );
		$writer2->writeText($str);
		echo "\n";
		echo "GzCompressMessageWriterDecorator - Base64MessageWriterDecorator - MessageWriter:\n";
		$writer3 = new GzCompressMessageWriterDecorator( new Base64MessageWriterDecorator(new MessageWriter()));
		$writer3->writeText($str);
		echo "\n";	
		echo "Base64MessageWriterDecorator - GzCompressMessageWriterDecorator - MessageWriter:\n";	
		$writer2 = new Base64MessageWriterDecorator(new GzCompressMessageWriterDecorator(new MessageWriter()));
		$writer2->writeText($str);
		echo "\n";		
	}

	/*
    private function loader($className) {
	
	    //echo 'Trying to load ', $className, ' via ', __METHOD__, "()\n"; 

		try {
			if ($phpdac = $this->caller->ldscheme)
				require ($phpdac . '/vendor/message/' . str_replace(array('\\', "\0"), array('/', ''), $className) . '.php');
			else
				require('vendor/message/' . $className . '.php');
			
			//$class = str_replace('\\', '/', $className);
			//require_once($class . '.php');//..error if not exist..
			
			$ok = "File $className loaded!";
		} 
		catch (Exception $e) {
            $err = "File $className not exist!";
        }
    }*/	
 
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