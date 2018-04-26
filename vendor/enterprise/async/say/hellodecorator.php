<?php

class HelloDecorator implements HelloInterface
{
	protected $_messageWriter;
	
	public function __construct(HelloInterface $messageWriter)
	{
		$this->_messageWriter = $messageWriter;
	}
	
	public function writeText($text, &$env=null)
	{
		if ($env) {
			$immZ = ImmutableC::with($env)
								->set('a story', 'This is where someone should write a story')
								->setIntKey(300, 'My int indexed value')
								->arr(['arr: int indexed', 'arr' => 'arr: assoc key becomes immutable key'])
								->build();		
			echo 'helloDecorator:' . $immZ . PHP_EOL;
		}
		else
			echo 'helloDecorator: env not found!' . PHP_EOL;
		
		$this->_messageWriter->writeText($text, $immZ);
	}
}
?>