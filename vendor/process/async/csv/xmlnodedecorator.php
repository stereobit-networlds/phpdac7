<?php

class xmlnodeDecorator implements xmlnodeInterface
{
	protected $_messageWriter;
	
	public function __construct(xmlnodeInterface $messageWriter)
	{
		$this->_messageWriter = $messageWriter;
	}
	
	public function xmltnode($node)
	{
		if ($node) {
			$imm = ImmutableC::with($node)
								->set('a story', 'This is where someone should write a story')
								->setIntKey(300, 'My int indexed value')
								->arr(['arr: int indexed', 'arr' => 'arr: assoc key becomes immutable key'])
								->build();		
			//echo 'xmlDecorator:' . $imm . PHP_EOL;
		}
		else
			echo 'xmlDecorator: node not found!' . PHP_EOL;
		
		return $this->_messageWriter->xmltnode($imm);
	}
}
?>