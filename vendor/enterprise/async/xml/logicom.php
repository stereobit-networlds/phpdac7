<?php
class logicom {
public $xmlfile, $xmlout; 
public $xmldate, $xmlnode, $imglist, $imgfolder;
public function __construct() {
	$this->xmlfile = "c:/xampp-basis/xmltest/logicom.xml";
	$this->xmlout = "C:/Users/billy/Dropbox/Vasis/xml/logicom-out.xml"; //"c:/xampp-basis/xmltest/logicom-out.xml";
	$this->xmlnode = 'Product';
	$this->xmldate = 'created_at';
	$this->imglist = $this->xmlout; //read image list to retreive
	$this->imgfolder = "C:/Users/billy/Dropbox/Vasis/xml/logicom/"; //"c:/xampp-basis/xmltest/logicom/"; //save to
}
public function nodemain(&$element) {
return array (
	'id' => strval($element->attributes()->id),
	'code3' => strval($element->attributes()->SKU),
	'code5' => strtoupper('LC-' . hash('crc32', strval($element->attributes()->SKU))),
	'itmname' => strval(strip_tags(htmlspecialchars_decode($element->attributes()->Name))),
	//'descr' => strval(html_entity_decode($element->descr)),
	//'descr' => strval(htmlspecialchars_decode($element->descr)),	
	//'itmdescr' => strval(htmlentities($element->Description)),	
	'itmdescr' => strval(strip_tags(htmlspecialchars_decode($element->Description))),
	'uniname1' => strval('ΤΕΜΑΧΙΟ'),
	'price0' => strval($element->attributes()->Price),
	'price1' => strval($element->attributes()->Price),
	'price2' => strval($element->attributes()->Price),
	'pricepc' => strval('0'),
	'ypoloipo' => (strval($element->attributes()->Availability)=='Normal') ? strval('1'):strval('0'),
	'categories' => explode('- / ', strval($element->Details->CategoryList->attributes()->Name)),
	'weight' => strval('0.0'),
	'volume' => strval('0.0'),	
	'color' => strval($element->Color),
	'dimensions' => strval($element->Dimensions),
	'manufacturer' => (strval(substr($element->Details->ManufacturerList->attributes()->Name,0,
							 strpos($element->Details->ManufacturerList->attributes()->Name, '-')))),
	'instock' => (strval($element->attributes()->Availability)=='Normal') ? strval('1'):strval('0'),
	'availability' => (strval($element->attributes()->Availability)=='Normal') ? strval('1'):strval('0'),							 
	'image' => (strval($element->Details->Images->Image[2]->attributes()->URL)),
	'url' => (strval($element->Details->ProductURL->attributes()->URL)),
	'owner' => (strval('logicom')),
);}}
?>