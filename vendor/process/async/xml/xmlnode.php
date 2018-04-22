<?php
class xmlnode implements xmlnodeInterface
{
	public function xmltnode($node)
	{
		/*echo $node->get('test') . PHP_EOL; // a string goes here
		var_dump($node->has('test')) . PHP_EOL; // bool(true)
		var_dump($node->has('non-existent')) . PHP_EOL; // bool(false)
		echo $node->getOrElse('test', 'some default text') . PHP_EOL; // a string goes here
		echo $node->getOrElse('non-existent', 'some default text') . PHP_EOL; // some default text		
		
		$imm = ImmutableC::create()
							->set('anObject', $node)
							->build();
							
		return $imm;*/
		return $node;
	}
}
?>