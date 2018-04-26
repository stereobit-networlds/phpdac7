<?php
class logicom {
public $xmlfile, $xmlout; 
public $xmldate, $xmlnode;
public function __construct() {
	$this->xmlfile = "c:/xampp-basis/xmltest/logicom.xml";
	$this->xmlout = "c:/xampp-basis/xmltest/logicom.txt";
	$this->xmlnode = 'Product';
	$this->xmldate = 'created_at';
}
public function nodemain(&$element) {
return array (
	'id' => strval($element->attributes()->id),
	'name' => strval($element->attributes()->Name),
	'price' => strval($element->attributes()->Price),
	'image' => (strval($element->Details->Images->Image[2]->attributes()->URL)),
	'url' => (strval($element->Details->ProductURL->attributes()->URL)),
	'manufacturer' => (strval(substr($element->Details->ManufacturerList->attributes()->Name,0,
							 strpos($element->Details->ManufacturerList->attributes()->Name, '-')))),
);}}
?>