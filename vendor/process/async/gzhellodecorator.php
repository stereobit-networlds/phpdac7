<?php
 
class GzHelloDecorator extends HelloDecorator
{	
	public function writeText($text)
	{
		$text = gzcompress($text);
		$this->_messageWriter->writeText($text);
	}
}
?>