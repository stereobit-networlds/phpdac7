<?php
class xmlnodeconf {
public $xmlfile; 
public $xmlnode;
public function __construct() {
	$this->xmlfile = "aidonitsa-skroutz.xml"; //"https://www.aidonitsa.gr/xml/skroutz.php";
	$this->xmlnode = 'product';
}
public function nodemain(&$element) {
return array (
	'id' => strval($element->id),
	'name' => strval($element->name), //CDATA
	'price' => strval($element->price_with_vat),
	'image' => strval($element->image),//CDATA
	'link' => strval($element->link),//CDATA
	'manufacturer' => strval($element->manufacturer),//CDATA
	//'descr' => strval(html_entity_decode($element->descr)),	
	//'descr' => strval(htmlentities($element->descr)),	
	'instock' => strval($element->instock),
	'weight' => strval($element->weight),
	'availability' => strval($element->availability),
	'color' => strval($element->color),
);}}
?>