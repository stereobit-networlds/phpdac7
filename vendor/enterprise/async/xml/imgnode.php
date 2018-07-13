<?php
class imgnode implements xmlnodeInterface
{
	public function xmltnode($node)
	{		
		//$imm = "<image filename='".str_replace(array("/","\\","*"),'-',$node->get('code3')).".jpg'>";
		$imm = "<image filename='".str_replace(array("/","\\","*"),'-',$node->get('code5')).".jpg'>";
		$imm.= "<url>" . $node->get('image') . "</url>";
		$imm.= "</image>";
		return $imm;//$node;
	}
}
?>