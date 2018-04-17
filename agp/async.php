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
		
		$this->loader('vendor/process/async/');
		$this->runAsync();
	}
	
	
	//method #2 (make code and eval)	
	protected function runAsync() {
		array_shift($this->_stack); //exclude self 'async' call
		reset($this->_stack);
		
		//ETL input
		echo "GzCompressMessageWriterDecorator - MessageWriter:\n";
		$str='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus congue lectus, nec interdum erat ornare nec. Nunc tincidunt lobortis augue at vehicula.';
		$etl = null; //new obj
		
		//ETL run
		//$x = false;
		foreach ($this->_stack as $i=>$pInst) {
			//if check (no autoloader)
			//if ($x = $this->getInstance($processInst, 'vendor/process/async/')) {
				$cc[] = "new $pInst(";
			//}	
		}
		//if ($x===true) { //all loaded
			reset($cc);

			$zcmd = null;
			array_walk($cc, function($v, $k) use (&$zcmd) 
			{  
				$zcmd.= ($n = next($this->_stack)) ? $v : $v . str_repeat(')',count($this->_stack)) . ';';
				return $v;
			});
			echo $zcmd . '!!!';
			try {
				//eval('$content = (100 - );');
				eval('$etl = ' . $zcmd);
			} 
			catch (Throwable $t) {
				//echo $content=null;
				echo $t . PHP_EOL;
			}	
		//}
		//else
			//echo 'Invalid command!' . PHP_EOL;
		
		//ETL output
		echo "Output:\n";
		$etl->writeText($str) . PHP_EOL;
	}
	
	//method #2 (just require/fetch)
	/*protected function getInstance($inst=null, $vendor='agp/') {
		if (!$inst) die('No instance to run!');		
		$file = $vendor . str_replace(array('_', "\0"), array('/', ''), $inst).'.php';
		
		if ($dac5 = $this->env->ldscheme) { 
			//agent
			require_once ($dac5 .'/'. $file);
			if (class_exists($inst)) {
					return true;			
			}
		} 
        elseif (file_exists($file)) { //sync(never here)
		    //kernel
			require_once $file;	
			if (class_exists($inst)) {	
					return true;
			}	
		}

		return false;	
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