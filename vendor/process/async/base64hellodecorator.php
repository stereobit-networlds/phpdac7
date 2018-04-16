<?php
 
class Base64HelloDecorator extends HelloDecorator
{
	public function writeText($text)
	{
		$text = base64_encode($text);
		$this->_messageWriter->writeText($text);
	}
}
?>