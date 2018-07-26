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
 
class howru extends processInst {
	
	protected $env, $_stack;
	
	public function __construct(& $caller, $callerName, $stack=null) {

		parent::__construct($caller, $callerName, $stack);
		
		$this->processStepName = __CLASS__;
		
		$this->env = $caller->env;
		$this->_stack = $stack['kernel'];
		
		echo 'process 2:' . $this->caller->status . PHP_EOL;
		//echo 'stack:' . implode('-', $this->_stack['kernel']) . PHP_EOL;
		
		//$this->loader('vendor/message/');
		//$this->caller->setPost("test123", null, $this->getChainId());
	}
	
	//override
	protected function go($data=null) {
		//$pid = $this->getChainId()-1;
		//echo '>>>' . $this->_stack[$pid] . '<<<<';
		
		$str='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus congue lectus, nec interdum erat ornare nec. Nunc tincidunt lobortis augue at vehicula.';
		//$this->caller->setPost($str, null, $this->getChainId());
 
		//echo "MessageWriter:\n";
		/*$writer1 = new MessageWriter();
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
		echo "\n";*/

		return $str;	
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