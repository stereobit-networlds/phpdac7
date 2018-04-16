<?php
 
class HelloDecorator implements HelloInterface
{
	protected $_messageWriter;
	
	public function __construct(HelloInterface $messageWriter)
	{
		$this->_messageWriter = $messageWriter;
	}
	
	public function writeText($text)
	{
		$this->_messageWriter->writeText($text);
	}
}
?>