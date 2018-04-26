<?php
class sqlread implements xmlnodeInterface
{
	public function xmltnode($node)
	{		
		//$sqlquery = $node->query;
		//$sqlid = $node->attributes()->id;
		
		return $node->query;
	}
}
?>