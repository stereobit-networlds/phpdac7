<?php
class kaisidis {
public $xmlfile, $xmlout; 
public $xmldate, $xmlnode, $imglist, $imgfolder;
public function __construct() {
	$this->xmlfile = "C:/Users/billy/Dropbox/Vasis/xml/kaisidis.xml"; //"c:/xampp-basis/xmltest/kaisidis-test.xml";
	$this->xmlout = "C:/Users/billy/Dropbox/Vasis/xml/datamedia-out.xml"; //"c:/xampp-basis/xmltest/kaisidis-test-out.xml";
	$this->xmlnode = 'product';
	$this->xmldate = 'created_at';
	$this->imglist = $this->xmlout; //read image list to retreive
	$this->imgfolder = "C:/Users/billy/Dropbox/Vasis/xml/data-media/"; //"c:/xampp-basis/xmltest/kaisidis/"; //save to
}
public function nodemain(&$element) {
return array (
	'id' => strval($element->id),
	'code3' => strval($element->sku),
	'code5' => strtoupper('DM-' . hash('crc32', strval($element->sku))),
	'itmname' => strval(strip_tags(htmlspecialchars_decode($element->name))),
	//'descr' => strval(html_entity_decode($element->descr)),	
	//'descr' => strval(htmlentities($element->descr)),	
	//'itmdescr' => strval(htmlspecialchars_decode($element->descr)),	
	'itmdescr' => strval(''),//strip_tags(htmlspecialchars_decode($element->descr))),		
	'uniname1' => strval('ΤΕΜΑΧΙΟ'),
	'price0' => strval($element->price),
	'price1' => strval($element->retail_price),
	'price2' => strval($element->price_without_offer),
	'pricepc' => strval($element->retail_percent),	
	'ypoloipo' => strval($element->stock_indicator),	
	'categories' => array(htmlspecialchars_decode(strval($element->group->name)), strval(htmlspecialchars_decode($element->group->category->name)), strval(htmlspecialchars_decode($element->group->category->subcategory->name))),
	'weight' => strval($element->weight),
	'volume' => strval($element->volume),
	'color' => strval($element->filters->filter[3]->value),	
	'dimensions' => strval($element->dim1) .'x'. strval($element->dim2) .'x'. strval($element->dim3),	
	'manufacturer' => strval($element->manufacturer),
	'instock' => strval($element->availability),
	'availability' => strval($element->availability),	
	'image' => strval($element->image),
	'url' => strval($element->url),	
	'owner' => (strval('data-media')),
);}}
?>