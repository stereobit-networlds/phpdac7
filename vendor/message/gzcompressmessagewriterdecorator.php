<?php
//namespace message;
 
class GzCompressMessageWriterDecorator extends MessageWriterDecorator
/*implements MessageWriterInterface*/
{
	/*protected $_messageWriter=null;
	
	public function __construct(MessageWriterInterface $messageWriter)
	{
		$this->_messageWriter = $messageWriter;
	}*/
	
	public function writeText($text)
	{
		$text = gzcompress($text);
		$this->_messageWriter->writeText($text);
	}
}
?>