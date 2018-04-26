<?php
 
class xmlnodeb64Decorator extends xmlnodeDecorator
{
	public function xmltnode($node)
	{
		if ($node) {
			$imm = ImmutableC::with($node)
							->set('test', 'a string goes here ')
							->set('another', 100)
							->arr([1,2,3,4,5,6])
							->arr(['a' => 1, 'b' => 2])
							->build();
												
			//echo 'base64HelloDecorator:' . $immY . PHP_EOL;
		}
		else
			echo 'base64helloDecorator: env not found!' . PHP_EOL;		
		
		//$node = base64_encode($node);
		return $this->_messageWriter->xmltnode($imm);
	}
}
?>