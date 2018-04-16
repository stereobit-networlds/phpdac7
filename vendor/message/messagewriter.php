<?php
//http://drib.tech/programming/decorator-pattern 
//namespace message;
 
class MessageWriter implements MessageWriterInterface
{
	public function writeText($text)
	{
		// for the test - just print it to the screen
		print $text;
	}
}
?>