<?php
 
class Base64HelloDecorator extends HelloDecorator
{
	public function writeText($text, &$env=null)
	{
		if ($env) {
			$immY = ImmutableC::create()
								->set('anObject', $env)
								->build();
												
			echo 'base64HelloDecorator:' . $immY . PHP_EOL;
		}
		else
			echo 'base64helloDecorator: env not found!' . PHP_EOL;		
		
		$text = base64_encode($text);
		$this->_messageWriter->writeText($text, $immY);
	}
}
?>