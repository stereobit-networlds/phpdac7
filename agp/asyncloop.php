<?php

class asyncloop extends processInst {
	
	protected $env, $_stack;
	
	public function __construct(& $caller, $callerName, $stack=null) {

		parent::__construct($caller, $callerName, $stack);
		$this->processStepName = __CLASS__;
		
		$this->env = $caller->env;
		$this->_stack = $stack['kernel'];
		
		$pid = $this->getChainId(); //next
		echo "process asyncloop ({$this->_stack[$pid]}): ". $this->caller->status . PHP_EOL;
		
		$this->loader('vendor/process/async/');
		if ($etl = $this->runAsync()) {
			
			//ETL input
			echo "> GzCompressMessageWriterDecorator - MessageWriter:\n";
			$str='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus congue lectus, nec interdum erat ornare nec. Nunc tincidunt lobortis augue at vehicula.';
			
			//ETL output loop
			for($i=1;$i<=10;$i++) {
				$etl->writeText('['.$i.']' . $str);//$str);
			}
		}
	}
	
	
	//ETL make (decoration pattern)	
	protected function runAsync() {
		array_shift($this->_stack); //exclude self 'async' call
		reset($this->_stack);		
		foreach ($this->_stack as $i=>$pInst) {
			$cc[] = "new $pInst(";
		}
		if (!empty($cc)) { //all loaded
			$zcmd = null; //init cmd
			reset($cc);
			array_walk($cc, function($v, $k) use (&$zcmd) 
			{  
				$zcmd.= ($n = next($this->_stack)) ? $v : $v . str_repeat(')',count($this->_stack)) . ';';
				return $v;
			});
			echo $zcmd . '!!!';
			
			try {
				eval('$etl = ' . $zcmd);
			} 
			catch (Throwable $t) {
				echo $t . PHP_EOL;
				return false;
			}	
		}
		else {
			echo 'Invalid command!' . PHP_EOL;
			return false;
		}	
		
		return ($etl);
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