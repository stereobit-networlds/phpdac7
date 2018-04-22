<?php
class sqlnode implements xmlnodeInterface
{
	public function xmltnode($node)
	{
		$imm = "REPLACE into produxml (cat0,cat1,cat2,cat3,code4,active,itmactive,itmname,price0,price1,itmdescr,uniname1,ypoloipo,xml,manufacturer,dimensions,weight,volume,color,owner) values (";
		$imm.= ($cat = $node->get('categories')) ?
			    "'XMLCATEGORY','{$cat[0]}','{$cat[1]}','{$cat[2]}'" : 
				"'XMLCATEGORY','','',''";
		$imm.= ",'". str_replace(array("/","\\","*"),'-',$node->get('code3')) ."',101,1";
		$imm.= ",'". $node->get('itmname') ."'";
		$imm.= ",'". $node->get('price0') ."'";
		$imm.= ",'". $node->get('price1') ."'";
		$imm.= ",'". $node->get('itmdescr') ."'";
		$imm.= ",'". $node->get('uniname1') ."'";
		$imm.= ",". $node->get('ypoloipo') .",0"; //xml
		$imm.= ",'". $node->get('manufacturer') ."'"; 
		$imm.= ",'". $node->get('dimensions') ."'";
		$imm.= ",". floatval($node->get('weight'));
		$imm.= ",". floatval($node->get('volume'));
		$imm.= ",'". $node->get('color') ."'";
		$imm.= ",'". $node->get('owner') ."');";

		$sqlnode = "<sql id='".str_replace(array("/","\\","*"),'-',$node->get('code3'))."'>";
		$sqlnode.= "<query>" . $imm . "</query>";
		$sqlnode.= "</sql>";
		
		return $sqlnode;
	}
}
?>