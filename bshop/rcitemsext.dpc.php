<?php

$__DPCSEC['RCITEMSEXT_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if (!defined("RCITEMSEXT_DPC")) {
define("RCITEMSEXT_DPC",true);

$__DPC['RCITEMSEXT_DPC'] = 'rcitemsext';

$__EVENTS['RCITEMSEXT_DPC'][0]='cpitemsext';
//$__EVENTS['RCITEMSEXT_DPC'][1]='cpxmlcreate';

$__ACTIONS['RCITEMSEXT_DPC'][0]='cpitemsext';
//$__ACTIONS['RCITEMSEXT_DPC'][1]='cpxmlcreate';

$__LOCALE['RCITEMSEXT_DPC'][0]='RCITEMSEXT_DPC;Items;Είδη';
$__LOCALE['RCITEMSEXT_DPC'][1]='_XMLFILE;XML file;XML file';
$__LOCALE['RCITEMSEXT_DPC'][2]='_XMLITEMS;XML items;XML είδη';
$__LOCALE['RCITEMSEXT_DPC'][3]='_dimensions;Dimension;Διαστάσεις';
$__LOCALE['RCITEMSEXT_DPC'][4]='_size;Size;Μέγεθος';
$__LOCALE['RCITEMSEXT_DPC'][5]='_resources;Resources;Resources';
$__LOCALE['RCITEMSEXT_DPC'][6]='_xmlcreate;Create XML;Δημιούργησε XML';
$__LOCALE['RCITEMSEXT_DPC'][7]='_xml;XML item;Είδος XML';
$__LOCALE['RCITEMSEXT_DPC'][8]='_manufacturer;Manufacturer;Κατασκευαστής';
$__LOCALE['RCITEMSEXT_DPC'][9]='_cat0;Category 1;Κατηγορία 1';
$__LOCALE['RCITEMSEXT_DPC'][10]='_cat1;Category 2;Κατηγορία 2';
$__LOCALE['RCITEMSEXT_DPC'][11]='_cat2;Category 3;Κατηγορία 3';
$__LOCALE['RCITEMSEXT_DPC'][12]='_cat3;Category 4;Κατηγορία 4';
$__LOCALE['RCITEMSEXT_DPC'][13]='_cat4;Category 5;Κατηγορία 5';
$__LOCALE['RCITEMSEXT_DPC'][14]='_code0;Code 0;Κωδικός 0';
$__LOCALE['RCITEMSEXT_DPC'][15]='_code1;Code 1;Κωδικός 1';
$__LOCALE['RCITEMSEXT_DPC'][16]='_code2;Code 2;Κωδικός 2';
$__LOCALE['RCITEMSEXT_DPC'][17]='_code3;Code 3;Κωδικός 3';
$__LOCALE['RCITEMSEXT_DPC'][18]='_code4;Code 4;Κωδικός 4';
$__LOCALE['RCITEMSEXT_DPC'][19]='_code5;Code 5;Κωδικός 5';
$__LOCALE['RCITEMSEXT_DPC'][20]='_itmactive;Active;Ενεργό';
$__LOCALE['RCITEMSEXT_DPC'][21]='_active;Active;Ενεργό';
$__LOCALE['RCITEMSEXT_DPC'][22]='_itmname;Title;Τίτλος';
$__LOCALE['RCITEMSEXT_DPC'][23]='_uniname1;Unit;Μονάδα μ.';
$__LOCALE['RCITEMSEXT_DPC'][24]='_ypoloipo1;Qty 1;Υπόλοιπο 1';
$__LOCALE['RCITEMSEXT_DPC'][25]='_ypoloipo2;Qty 2;Υπόλοιπο 2';
$__LOCALE['RCITEMSEXT_DPC'][26]='_price0;Price 1;Αξία 1';
$__LOCALE['RCITEMSEXT_DPC'][27]='_price1;Price 2;Αξία 2';
$__LOCALE['RCITEMSEXT_DPC'][28]='_color;Color;Χρώμα';
$__LOCALE['RCITEMSEXT_DPC'][29]='_resources;Res;Συσχ.';
$__LOCALE['RCITEMSEXT_DPC'][30]='_pricepc;Discount;Έκπτωση';
$__LOCALE['RCITEMSEXT_DPC'][31]='_price2;Price 3;Αξία 3';
$__LOCALE['RCITEMSEXT_DPC'][32]='_weight;Weight;Βάρος';
$__LOCALE['RCITEMSEXT_DPC'][33]='_volume;Volume;Όγκος';
$__LOCALE['RCITEMSEXT_DPC'][34]='_itmfname;Title;Τίτλος';

class rcitemsext {

    var $prpath, $title, $select_fields, $editf;
	var $cseparator, $restype, $lan;

    public function __construct() {
	  
		$this->title = localize('RCITEMSEXT_DPC',getlocal());	  
		$this->lan = getlocal();
		
		$this->prpath = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		
		$iname = $this->lan ? 'itmname' : 'itmfname';
		$this->select_fields = array('code5','cat0','cat1','cat2','cat3',/*'cat4',*/
									 'itmactive','active',$iname,'uniname1','xml',
									 'ypoloipo1','price0','price1','price2','pricepc',
									 'manufacturer','size','dimensions','color','weight','volume');
	   	
		$this->editf = array('itmactive','active',$iname,'uniname1','xml',
							'ypoloipo1','price0','price1','price2','pricepc',
							'manufacturer','size','color','dimensions','resources','weight','volume');
	   
		$csep = remote_paramload('RCITEMS','csep',$this->path); 
		$this->cseparator = $csep ? $csep : '^';	 

		$this->restype = remote_paramload('RCITEMS','restype',$this->path);	   
	}
	
    public function event($event=null) {
	
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;			

		switch ($event) {
			/*case 'cpxmlcreate'  : 	$this->create_xml();
									break;*/
			default             :		
		                        						  
		}
    }	

    public function action($action=null)  { 
	
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;
		
	    switch ($action) {
			//case 'cpxmlcreate'  :
			default             :  $out = $this->form();
		}			 

	     return ($out);
	}	
	
	protected function form() {
	
        //$out = $this->xmlform(); 	   
	    $out .= $this->show_grids(1);  
	    return ($out);		
	}	
	
	protected function show_grids() {

		$title = str_replace(' ','_',$this->title);
        $myfields = implode(',', $this->select_fields);	

		$sSQL = 'select * from (select id,'.$myfields . ' from products) as o';	   
		//echo $sSQL;

		foreach ($this->select_fields as $i=>$f) {
			if (stristr($f,'active')) {
				$type = 'boolean';
				$edit = 1;
				$options = ($f=='itmactive') ? "1:0" : "101:0";	
				$align = 'left';
                //$title = localize('_'.$f,getlocal());					
			}
			else {
				$type = 10;
				$edit = in_array($f, $this->editf) ? 1 : 0;
				$options = null; 
				$align = 'left';
				//$title = stristr($f,$this->editf) ? localize('_editf',getlocal()) : localize('_'.$f,getlocal());
			}				
			_m("mygrid.column use grid9+$f|".localize('_'.$f,getlocal())."|$type|$edit|$options|$link_option|$search|$hidden|$align");	
		}
			
		$out = _m("mygrid.grid use grid9+products+$sSQL+e+$title+id+1+1+12+300++0+1+1");
			
		return ($out);	
	}	
	
	protected function combine_tokens($template_contents,$tokens, $execafter=null) {
	    if (!is_array($tokens)) return;
		
		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
			$fp = new fronthtmlpage(null);
			$ret = $fp->process_commands($template_contents);
			unset ($fp);		  		
		}		  		
		else
			$ret = $template_contents;
		  
	    foreach ($tokens as $i=>$tok) 
		    $ret = str_replace("$".$i."$",$tok,$ret);

		//clean unused token marks
		for ($x=$i;$x<20;$x++)
			$ret = str_replace("$".$x."$",'',$ret);
		
		//execute after replace tokens
		if (($execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
			$fp = new fronthtmlpage(null);
			$retout = $fp->process_commands($ret);
			unset ($fp);
			return ($retout);
		}		
		
		return ($ret);
	}
	
	public function fnum($n, $dec_digits, $dp=null, $tp=null) {
	  $dec = $dp ? $dp : $this->decimal;
      $ret = number_format(floatval($n),$dec_digits,$dec,$tp);
      return ($ret);	  
	}

	public function pricewithtax($price,$tax=null) {

		if ($tax) {
			$mytax = (($price*$tax)/100);	
			$value = ($price+$mytax);		  
		}
		else
			$value = $price;
	 
		$ret = $this->fnum($value,2,',',''); //'.'
	
		return ($ret);
	}	
	
	//override from fronthtmlpage (use rcxmlfeeds.nvltokens)
	public function nvltokens($token=null,$state1=null,$state2=null,$value=null,$isdigit=null) {
		//echo '>',$token,':',$value,'<br/>';
		if (is_numeric($value) && ($isdigit==true)) 
           $ret = ($token==$value) ? $state1 : $state2;			
		elseif ($value) 
			$ret = ($token==$value) ? $state1 : $state2;  	
        else 	
           $ret = $token ? $state1 : $state2;
 
		return ($ret);
    }		
};
}
?>