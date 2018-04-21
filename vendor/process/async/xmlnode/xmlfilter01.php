<?php
class xmlfilter01 extends xmlnodeDecorator
{	
	public function xmltnode($node)
	{	
		if ($node) {
			$imm = ImmutableC::create()
							->arr($node)
							->build();	
			//echo 'XmlGzDecorator:' . $imm . PHP_EOL;								
		}
		else
			echo 'XmlGzDecorator: node not found!' . PHP_EOL;
							
		//$node = gzcompress($node);
		return $this->_messageWriter->xmltnode($imm);
	}
}
?>