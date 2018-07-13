<?php
class aidonitsa {
public $xmlfile, $xmlout; 
public $xmldate, $xmlnode, $imglist, $imgfolder;
public function __construct() {
	$this->xmlfile = "https://www.aidonitsa.gr/xml/skroutz.php"; //"aidonitsa-skroutz.xml"; //"https://www.aidonitsa.gr/xml/skroutz.php"; 
	$this->xmlout = "C:/Users/billy/Dropbox/Vasis/xml/aidonitsa-out.xml"; //"c:/xampp-basis/xmltest/aidonitsa-skroutz-out.xml";
	$this->xmlnode = 'product';
	$this->xmldate = 'created_at';
	$this->imglist = $this->xmlout; //read image list to retreive
	$this->imgfolder = "C:/Users/billy/Dropbox/Vasis/xml/aidonitsa/"; //"c:/xampp-basis/xmltest/aidonitsa/"; //save to
}
public function nodemain(&$element) {
return array (
	'id' => strval($element->id),
	'code3' => strval($element->mpn),
	'code5' => strtoupper('AI-' . hash('crc32', strval($element->mpn))),
	'itmname' => strval(strip_tags(htmlspecialchars_decode($element->name))), //CDATA
	//'descr' => strval(html_entity_decode($element->descr)),
	//'descr' => strval(htmlspecialchars_decode($element->descr)),	
	//'itmdescr' => strval(htmlentities($element->descr)),	
	'itmdescr' => strval(strip_tags(htmlspecialchars_decode($element->descr))),		
	'uniname1' => strval('ΤΕΜΑΧΙΟ'),
	'price0' => strval(floatval(number_format($element->price_with_vat /1.24, 2))),
	'price1' => strval(floatval(number_format($element->price_with_vat /1.24, 2))),
	'price2' => strval(floatval(number_format($element->price_with_vat /1.24, 2))),
	'pricepc' => strval('0'),	
	'ypoloipo' => (strval($element->instock)=='Y') ? strval('1'):strval('0'),
	'categories' => explode(' >  ', strval($element->category)),
	'weight' => strval($element->weight),
	'volume' => strval('0.0'),
	'color' => strval($element->color),	
	'dimensions' => strval($element->dimensions),
	'manufacturer' => strval($element->manufacturer),//CDATA	
	'instock' => strval($element->instock),
	'availability' => strval($element->availability),
	'image' => strval($element->image),//CDATA
	'url' => strval($element->link),//CDATA	
	'owner' => (strval('aidonitsa')),
);}}
?>