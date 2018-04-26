<?php
class kaisidis {
public $xmlfile, $xmlout; 
public $xmldate, $xmlnode;
public function __construct() {
	$this->xmlfile = "c:/xampp-basis/xmltest/kaisidis-test.xml";
	$this->xmlout = "c:/xampp-basis/xmltest/kaisidis-test.txt";
	$this->xmlnode = 'product';
	$this->xmldate = 'created_at';
}
public function nodemain(&$element) {
return array (
	'id' => strval($element->id),
	'name' => strval($element->name),
	'price' => strval($element->price),
	'image' => strval($element->image),
	'url' => strval($element->url),
	'manufacturer' => strval($element->manufacturer),
	//'descr' => strval(html_entity_decode($element->descr)),	
	//'descr' => strval(htmlentities($element->descr)),	
	'descr' => strval(htmlspecialchars_decode($element->descr)),	
	'weight' => strval($element->weight),
	'volume' => strval($element->volume),
	'color' => strval($element->filters->filter[3]->value),
);}}
?>