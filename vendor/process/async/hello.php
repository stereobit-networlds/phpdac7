<?php
//http://drib.tech/programming/decorator-pattern 
 
class Hello implements HelloInterface
{
	public function writeText($text, &$env=null)
	{
		$throwAway = ImmutableC::with($env)
								->set('a story', 'My story begins by the slow moving waters of the meandering river.')
								->build();
		echo 'hello:' . $throwAway . PHP_EOL;
		
		// for the test - just print it to the screen
		print $text;
	}
}
?>