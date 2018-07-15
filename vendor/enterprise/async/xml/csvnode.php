<?php
class csvnode implements xmlnodeInterface
{
	public function xmltnode($node)
	{
		$imm = ($cat = $node->get('categories')) ?
			    'XMLCATEGORY;' . preg_replace('/\s\s+/', ' ', str_replace(array("&","-",";"),'', trim($cat[0]))) .';'. preg_replace('/\s\s+/', ' ',str_replace(array("&","-",";"),'', trim($cat[1]))) .';'. preg_replace('/\s\s+/', ' ',str_replace(array("&","-",";"),'', trim($cat[2]))) .';' : 'XMLCATEGORY;;;;';
		$imm.= str_replace(array("/","\\","*"),'-', trim($node->get('code5'))) . ';101;1;';
		$imm.= str_replace(array("/","\\","*"),'-', trim($node->get('code3'))) . ';'.
			   str_replace(array(";","amp","&","<",">",'"'),array('','','','','',"'"), trim($node->get('itmname'))) . ';'. 
			   str_replace(array(";","amp","&","<",">",'"'),array('','','','','',"'"), trim($node->get('itmname'))) . ';';
		$imm.= $node->get('price0') .';'. $node->get('price1') .';';
		$imm.= $node->get('price2') .';'. $node->get('pricepc') .';';
		$imm.= str_replace(array(";","amp","&","<",">",'"'),array('','','','','',"'"), trim($node->get('itmdescr'))) .';'. $node->get('uniname1') .';';
		$imm.= $node->get('ypoloipo') .';0;'; //xml
		$imm.= str_replace(array(";","amp","&","<",">",'"'),array('','','','','',"'"), trim($node->get('manufacturer'))) .';'. 
			   trim($node->get('dimensions')). ';'; 
		$imm.= trim($node->get('color')) .';';
		$imm.= trim($node->get('weight')) .';';
		$imm.= trim($node->get('volume')) .';';
		$imm.= trim($node->get('owner')) .';.';

		$sqlnode = "<csv id='".str_replace(array("/","\\","*"),'-',$node->get('code3'))."'>";
		$sqlnode.= "<line>" . $imm . "</line>";
		$sqlnode.= "</csv>";
		
		return $sqlnode;
	}
}
?>