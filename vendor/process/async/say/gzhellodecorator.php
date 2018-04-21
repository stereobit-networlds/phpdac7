<?php
//include_once(tierds::$ldscheme . "/tier/imot.lib.php"));
class GzHelloDecorator extends HelloDecorator
{	
	public function writeText($text, &$env=null)
	{	
		if ($env) {
			echo $env->get('test') . PHP_EOL; // a string goes here
			var_dump($env->has('test')) . PHP_EOL; // bool(true)
			var_dump($env->has('non-existent')) . PHP_EOL; // bool(false)
			echo $env->getOrElse('test', 'some default text') . PHP_EOL; // a string goes here
			echo $env->getOrElse('non-existent', 'some default text') . PHP_EOL; // some default text		
		
			$immY = ImmutableC::create()
							->set('anObject', $env)
							->build();
			echo 'gzHelloDecorator:' . $immY . PHP_EOL;								
		}
		else
			echo 'gzhelloDecorator: env not found!' . PHP_EOL;
							
		$text = gzcompress($text);
		$this->_messageWriter->writeText($text, $immY);
	}
}
?>