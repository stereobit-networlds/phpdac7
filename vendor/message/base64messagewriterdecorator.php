<?php
 
//namespace message;
 
class Base64MessageWriterDecorator extends MessageWriterDecorator
/*implements MessageWriterInterface*/
{
	/*protected $_messageWriter=null;
	
	public function __construct(MessageWriterInterface $messageWriter)
	{
		$this->_messageWriter = $messageWriter;
	}*/
	
	public function writeText($text)
	{
		$text = base64_encode($text);
		$this->_messageWriter->writeText($text);
	}
}
?>