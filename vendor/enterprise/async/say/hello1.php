<?php
//http://drib.tech/programming/decorator-pattern 
 
class Hello1 implements HelloInterface
{
	public function writeText($text)
	{
		// for the test - just print it to the screen
		print $text;
		echo "MessageWriter:\n";
	}
}
?>