<?php
 
//namespace message;
 
class MessageWriterDecorator implements MessageWriterInterface
{
	protected $_messageWriter;
	
	public function __construct(MessageWriterInterface $messageWriter)
	{
		$this->_messageWriter = $messageWriter;
	}
	
	public function writeText($text)
	{
		$this->_messageWriter->writeText($text);
	}
}
?>