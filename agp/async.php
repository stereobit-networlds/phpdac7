<?php
/**
 * This file is part of phpdac7.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    balexiou<balexiou@stereobit.com>
 * @copyright balexiou<balexiou@stereobit.com>
 * @link      http://www.stereobit.com/php-dac7.php
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
 
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
		//echo "process async ({$this->nextCmd}): ". $this->caller->status . PHP_EOL;	
		$this->env->_say("process async ({$this->nextCmd}): ". $this->caller->status, 'TYPE_IRON');
				
		//$this->loader("vendor/process/async/{$this->nextCmd}/"); //next cmd namespace		
	}
	
	//override
	protected function go($data=null) {
		
		if ($this->env->ldscheme) //is tier call, exec
		{	
			$this->loader("vendor/enterprise/async/{$this->nextCmd}/"); //next cmd namespace		
	
			$async = array_shift($this->_stack); //exclude self 'async' call
			$class = array_shift($this->_stack); //get class
			
			//return new $class($this);
			$run = new $class($this);
			return is_object($run) ? $run : false;
		}	
		//server part
		//echo "--------- tier go()!!" . PHP_EOL;
		$this->env->_say("--------- tier go()!!", 'TYPE_LION');
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