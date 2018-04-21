<?php
class aidonitsa {
public $xmlfile, $xmlout; 
public $xmldate, $xmlnode;
public function __construct() {
	$this->xmlfile = "aidonitsa-skroutz.xml"; //"https://www.aidonitsa.gr/xml/skroutz.php";
	$this->xmlout = "c:/xampp-basis/xmltest/aidonitsa-skroutz.txt";
	$this->xmlnode = 'product';
	$this->xmldate = 'created_at';
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