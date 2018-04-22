<?php
class csvread implements xmlnodeInterface
{
	public function xmltnode($node)
	{		
		//$csvline = $node->line;
		//$csvid = $node->attributes()->id;
		
		return $node->line;
	}
}
?>