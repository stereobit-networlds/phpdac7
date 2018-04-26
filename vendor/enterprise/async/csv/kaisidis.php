<?php
class kaisidis {
public $xmlfile, $xmlout; 
public $xmldate, $xmlnode, $imglist, $imgfolder;
public function __construct() {
	$this->xmlfile = "c:/xampp-basis/xmltest/kaisidis-test.xml";
	$this->xmlout = "c:/xampp-basis/xmltest/kaisidis-test-out.xml";
	$this->xmlnode = 'product';
	$this->xmldate = 'created_at';
	$this->imglist = $this->xmlout; //read image list to retreive
	$this->imgfolder = "c:/xampp-basis/xmltest/kaisidis/"; //save to
}
public function nodemain(&$element) {
return array (
	'id' => strval($element->id),
	'code3' => strval($element->sku),
	'itmname' => strval($element->name),
	//'descr' => strval(html_entity_decode($element->descr)),	
	//'descr' => strval(htmlentities($element->descr)),	
	'itmdescr' => strval(htmlspecialchars_decode($element->descr)),	
	'uniname1' => strval('ΤΕΜΑΧΙΟ'),
	'price0' => strval($element->price),
	'price1' => strval($element->price),
	'ypoloipo' => strval($element->stock_indicator),	
	'categories' => array(strval($element->group->name), strval($element->group->category->name), strval($element->group->category->subcategory->name)),
	'weight' => strval($element->weight),
	'volume' => strval($element->volume),
	'color' => strval($element->filters->filter[3]->value),	
	'dimensions' => strval($element->dim1) .'x'. strval($element->dim2) .'x'. strval($element->dim3),	
	'manufacturer' => strval($element->manufacturer),	
	'image' => strval($element->image),
	'url' => strval($element->url),	
	'owner' => (strval('data-media')),
);}}
?>