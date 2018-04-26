<?php
//http://drib.tech/programming/decorator-pattern 

//input
$str='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus congue lectus, nec interdum erat ornare nec. Nunc tincidunt lobortis augue at vehicula.';
 
//run
echo "GzCompressMessageWriterDecorator - MessageWriter:\n";
$process = 	new GzCompressMessageWriterDecorator( 
				new Base64MessageWriterDecorator(
					new MessageWriter()));
//output					
$process->writeText($str);

interface HelloInterface
{
	public function writeText($text);
}

class Hello implements HelloInterface
{
	public function writeText($text)
	{
		// for the test - just print it to the screen
		print $text;
	}
}
 
class HelloDecorator implements HelloInterface
{
	protected $_messageWriter;
	
	public function __construct(HelloInterface $messageWriter)
	{
		$this->_messageWriter = $messageWriter; //result
	}
	
	public function writeText($text)
	{
		$this->_messageWriter->writeText($text);
	}
}

class Base64HelloDecorator extends HelloDecorator
{
	public function writeText($text)
	{
		$text = base64_encode($text); //process
		$this->_messageWriter->writeText($text);
	}
}

class GzHelloDecorator extends HelloDecorator
{	
	public function writeText($text)
	{
		$text = gzcompress($text); //process
		$this->_messageWriter->writeText($text);
	}
}

class LeetHelloDecorator extends HelloDecorator
{
	public function writeText($text)
	{
		$text = strtolower($text); //process
		$text = strtr($text, "oesaig", "035416");
		$this->_messageWriter->writeText($text);
	}
}

?>