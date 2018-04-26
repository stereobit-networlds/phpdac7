<?php
class csvnode implements xmlnodeInterface
{
	public function xmltnode($node)
	{
		$imm = ($cat = $node->get('categories')) ?
			    'XMLCATEGORY;' . $cat[0] .';'. $cat[1] .';'. $cat[2] .';' : 'XMLCATEGORY;;;;';
		$imm.= str_replace(array("/","\\","*"),'-',$node->get('code3')) . ';101;1;';
		$imm.= $node->get('itmname') . ';;;'; //itmfname ; size
		$imm.= $node->get('price0') .';'. $node->get('price1') .';';
		$imm.= $node->get('itmdescr') .';'. $node->get('uniname1') .';';
		$imm.= $node->get('ypoloipo') .';0;'; //xml
		$imm.= $node->get('manufacturer') .';;'; //itmremark
		$imm.= $node->get('color') .';.';

		$sqlnode = "<csv id='".str_replace(array("/","\\","*"),'-',$node->get('code3'))."'>";
		$sqlnode.= "<line>" . $imm . "</line>";
		$sqlnode.= "</csv>";
		
		return $sqlnode;
	}
}
?>