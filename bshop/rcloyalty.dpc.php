<?php
$__DPCSEC['RCLOYALTY_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCLOYALTY_DPC")) && (seclevel('RCLOYALTY_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCLOYALTY_DPC",true);

$__DPC['RCLOYALTY_DPC'] = 'rcloyalty';

$__EVENTS['RCLOYALTY_DPC'][0]='cployalty';
$__EVENTS['RCLOYALTY_DPC'][1]='cpitemqfetch';
$__EVENTS['RCLOYALTY_DPC'][2]='cpitemqform';
$__EVENTS['RCLOYALTY_DPC'][3]='cpitemqdetail';
$__EVENTS['RCLOYALTY_DPC'][4]='cpitemqdel';
$__EVENTS['RCLOYALTY_DPC'][5]='cployaltyfetch';
$__EVENTS['RCLOYALTY_DPC'][6]='cployaltyload';

$__ACTIONS['RCLOYALTY_DPC'][0]='cployalty';
$__ACTIONS['RCLOYALTY_DPC'][1]='cpitemqfetch';
$__ACTIONS['RCLOYALTY_DPC'][2]='cpitemqform';
$__ACTIONS['RCLOYALTY_DPC'][3]='cpitemqdetail';
$__ACTIONS['RCLOYALTY_DPC'][4]='cpitemqdel';
$__ACTIONS['RCLOYALTY_DPC'][5]='cployaltyfetch';
$__ACTIONS['RCLOYALTY_DPC'][6]='cployaltyload';

$__LOCALE['RCLOYALTY_DPC'][0]='RCLOYALTY_DPC;Loyalty;Επιβράβευση';
$__LOCALE['RCLOYALTY_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['RCLOYALTY_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['RCLOYALTY_DPC'][3]='_qty;Quantity;Ποσότητα';
$__LOCALE['RCLOYALTY_DPC'][4]='_items;Items;Είδη';
$__LOCALE['RCLOYALTY_DPC'][5]='_active;Active;Ενεργό';
$__LOCALE['RCLOYALTY_DPC'][6]='_title;Title;Τίτλος';
$__LOCALE['RCLOYALTY_DPC'][7]='_descr;Description;Περιγραφή';
$__LOCALE['RCLOYALTY_DPC'][8]='_xml;Xml;Xml';
$__LOCALE['RCLOYALTY_DPC'][9]='_color;Color;Χρώμα';
$__LOCALE['RCLOYALTY_DPC'][10]='_code;Code;Κωδικός';
$__LOCALE['RCLOYALTY_DPC'][11]='_dimensions;Dimension;Διαστάσεις';
$__LOCALE['RCLOYALTY_DPC'][12]='_size;Size;Μέγεθος';
$__LOCALE['RCLOYALTY_DPC'][13]='_dimensions;Dimensions;Διαστάσεις';
$__LOCALE['RCLOYALTY_DPC'][14]='_xmlcreate;Create XML;Δημιούργησε XML';
$__LOCALE['RCLOYALTY_DPC'][15]='_xml;XML item;Είδος XML';
$__LOCALE['RCLOYALTY_DPC'][16]='_manufacturer;Manufacturer;Κατασκευαστής';
$__LOCALE['RCLOYALTY_DPC'][17]='_uniname1;Unit;Μον.μετρ.';
$__LOCALE['RCLOYALTY_DPC'][18]='_ypoloipo1;Qty;Υπόλοιπο';
$__LOCALE['RCLOYALTY_DPC'][19]='_price0;Price 1;Αξία 1';
$__LOCALE['RCLOYALTY_DPC'][20]='_price1;Price 2;Αξία 2';
$__LOCALE['RCLOYALTY_DPC'][21]='_points;Points;Πόντοι';
$__LOCALE['RCLOYALTY_DPC'][22]='_customers;Customers;Πελάτες';
$__LOCALE['RCLOYALTY_DPC'][23]='_iteminsert;Insert points;Εισαγωγή πόντων σε είδη';
$__LOCALE['RCLOYALTY_DPC'][24]='_item;Item;Είδος';
$__LOCALE['RCLOYALTY_DPC'][25]='_source;Source;Πηγή προέλευσης';
$__LOCALE['RCLOYALTY_DPC'][26]='_notes;Notes;Σημειώσεις';
$__LOCALE['RCLOYALTY_DPC'][27]='_save;Save;Αποθήκευση';
$__LOCALE['RCLOYALTY_DPC'][28]='_ccode;User id;Αναγνωριστικό';
$__LOCALE['RCLOYALTY_DPC'][29]='_cartpoints;Cart loyalty;Εισαγωγή πόντων σε αγορές';
$__LOCALE['RCLOYALTY_DPC'][30]='_shopcart;Shopping cart;Καλάθι αγορών';

$__LOCALE['RCLOYALTY_DPC'][31]='_tel;Tel.;Τηλέφωνο';
$__LOCALE['RCLOYALTY_DPC'][32]='_mob;Mobile;Κινητό';
$__LOCALE['RCLOYALTY_DPC'][33]='_mail;e-mail;e-mail';
$__LOCALE['RCLOYALTY_DPC'][34]='_fax;Fax;Fax';
$__LOCALE['RCLOYALTY_DPC'][35]='_ptype;Price type;Τύπος Τιμών';
$__LOCALE['RCLOYALTY_DPC'][36]='_name;Name;Όνομα';
$__LOCALE['RCLOYALTY_DPC'][37]='_afm;Vat ID;ΑΦΜ';
$__LOCALE['RCLOYALTY_DPC'][38]='_area;Area;Περιοχή';
$__LOCALE['RCLOYALTY_DPC'][39]='_prfdescr;Occupation;Επάγγελμα';
$__LOCALE['RCLOYALTY_DPC'][40]='_doy;DOY.;ΔΟΥ.';
$__LOCALE['RCLOYALTY_DPC'][41]='_street;Street;Οδός';
$__LOCALE['RCLOYALTY_DPC'][42]='_number;No;Αριθμος';
$__LOCALE['RCLOYALTY_DPC'][43]='_city;City;Πόλη';
$__LOCALE['RCLOYALTY_DPC'][44]='_attr1;P1;P1';
$__LOCALE['RCLOYALTY_DPC'][45]='_attr2;P2;P2';
$__LOCALE['RCLOYALTY_DPC'][46]='_attr3;P3;P3';
$__LOCALE['RCLOYALTY_DPC'][47]='_attr4;P4;P4';
$__LOCALE['RCLOYALTY_DPC'][48]='_custaddress;Addresses;Διευθύνσεις';
$__LOCALE['RCLOYALTY_DPC'][49]='_active;Active;Ενεργός';
$__LOCALE['RCLOYALTY_DPC'][50]='_code2;Code;Κωδικός';
$__LOCALE['RCLOYALTY_DPC'][51]='_address;Address;Διεύθυνση';
$__LOCALE['RCLOYALTY_DPC'][52]='_discount;Discount;Έκπτωση';
$__LOCALE['RCLOYALTY_DPC'][53]='_price;Price;Αξία';


class rcloyalty {
	
    var $title, $path, $urlpath;
	var $seclevid, $userDemoIds;	
	
	public function __construct() {

		$this->path = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		$this->title = localize('RCLOYALTY_DPC',getlocal());	 
	  
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
		$this->userDemoIds = array(5,6,7,8); 		  
	}

    public function event($event=null) {
	
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;		 
	
		switch ($event) {
			
			case 'cployaltyfetch': break;
			case 'cployaltyload' : echo $this->loadLoyalty();
		                           die();
							       break;			
		
			case 'cpitemqdetail': break;				
			case 'cpitemqform'  : break;
			
			case 'cpitemqdel':    $this->deleteFormData();                       			
			case 'cpitemqfetch' : echo $this->loadframe();
		                          die();
							      break;
			case 'cployalty'    :
			default             :    
		                      
		}
			
    }   
	
    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	
	 
		switch ($action) {	
		
		    case 'cployaltyfetch': $out = $this->loyalty_grid(null,340,12,'d', true); 
								  break;
			case 'cployaltyload' : break;								  
		
			case 'cpitemqdetail': break;			
			case 'cpitemqform'  : $out = $this->show(); 
			                      break;
			case 'cpitemqdel'   :								  
			case 'cpitemqfetch' : break;
			case 'cployalty'    :
			default             : $out = $this->loyaltyMode();
		}	 

		return ($out);
    }
	
	protected function loyaltyMode() {
		$mode = GetReq('mode') ? GetReq('mode') : 'customers';
        
		$turl0 = seturl('t=cployalty&mode=items');		
		$turl1 = seturl('t=cployalty&mode=customers');
		$turl2 = seturl('t=cployalty&mode=shopcart');
		$button = $this->createButton(localize('_points', getlocal()), 
										array(localize('_iteminsert', getlocal())=>$turl0,
											  localize('_cartpoints', getlocal())=>$turl2,
										      localize('_customers', getlocal())=>$turl1,
		                                ),'success');		
																
		switch ($mode) {
	        case 'shopcart' : $content = $this->cartpolicy_grid(null,140,5,'d', true); break;
	        case 'items'    : $content = $this->items_grid(null,140,5,'e', true); break;
			case 'customers':   
			default         : $content = $this->customers_grid(null,140,5,'e', true);  
			
		}			
					
		$ret = $this->window($this->title .': '.localize('_'.$mode, getlocal()), $button, $content);
		
		return ($ret);
	}	
	
	protected function loadframe($ajaxdiv=null, $mode=null) {
		$id = GetParam('id');
		$cmd = 'cpitemqform&id='.$id ;//$mode not used
		$bodyurl = seturl("t=$cmd&iframe=1");
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"460px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}

	protected function show() {
		$id = GetReq('id');
		$title = 'ID:' . $id; 
		$ret = null; //$title; //test
		
		return ($ret);
	}	
	
	protected function saveFormData($id) {	
		if ((!$id) || (!$_POST)) return null;
		$db = GetGlobal('db');
		
		$data = base64_encode(trim($_POST['formdata']));			

		$sSQL = "select code from ppolicyres where ispoints=1 and code=" . $db->qstr($id);
		$res = $db->Execute($sSQL);	
		
		if ($res->fields[0])
			$sSQL1 = ($data) ? 
						"update ppolicyres set data="  . $db->qstr($data) . " where ispoints=1 and code=" . $db->qstr($id) :
						"delete from ppolicyres where ispoints=1 and code=" . $db->qstr($id); 
		else
			$sSQL1 = ($data) ? 
						"insert into ppolicyres (active,code,data,ispoints) values (1,'$id','$data',1)" :
						null;
		
		if ($sSQL1)
			$db->Execute($sSQL1);
		
		return true;	
		/*
		$ret = ($data) ? @file_put_contents($this->path . $id.'.lyt', $data) : null;
		return ($ret);
		*/
	}

	//disabled
	protected function deleteFormData() {
		
		return false;
		/*
		$id = GetParam('id');
		if (!$id) return false;
		
		$ret = @unlink($this->path . $id.'.lyt');
		*/
		return ($ret);
	}		
	
	public function fetchFormData() {
		$id = GetParam('id');
		$db = GetGlobal('db');		
		
		if ($id) 
			$ret = $this->saveFormData($id);
		
		$sSQL = "select data from ppolicyres where ispoints=1 and code=" . $db->qstr($id);
		$res = $db->Execute($sSQL);	
		return (base64_decode($res->fields[0]));
		
		//$data = @file_get_contents($this->path . $id.'.lyt');
		//return (trim($data));
	}
	
	protected function items_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_items', getlocal()); 
		
        $xsSQL = "SELECT * from (select id,sysins,code5,xml,itmactive,active,itmname,uniname1,ypoloipo1,price0,price1,manufacturer,size,color from products) o ";		   
		//code3,cat0,cat1,cat2,cat3,cat4,resources
		   							
		_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|");//"|link|5|"."javascript:editform(\"{id}\");".'||');			
		_m("mygrid.column use grid1+itmactive|".localize('_active',getlocal())."|2|0|");//"|boolean|1|1:0");		
		_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|2|0|");//"|boolean|1|101:0|");
		_m("mygrid.column use grid1+sysins|".localize('_date',getlocal())."|5|0|");		
		_m("mygrid.column use grid1+code5|".localize('_code',getlocal())."|5|0|");	
		_m("mygrid.column use grid1+itmname|".localize('_title',getlocal())."|link|10|"."javascript:editform(\"{code5}\");".'||');	
		_m("mygrid.column use grid1+uniname1|".localize('_uniname1',getlocal())."|5|0|");		
		_m("mygrid.column use grid1+ypoloipo1|".localize('_ypoloipo1',getlocal())."|5|1|");			
		_m("mygrid.column use grid1+price0|".localize('_price0',getlocal())."|5|1|");		
		_m("mygrid.column use grid1+price1|".localize('_price1',getlocal())."|5|1|");			
		_m("mygrid.column use grid1+manufacturer|".localize('_manufacturer',getlocal())."|5|0|");
		_m("mygrid.column use grid1+size|".localize('_size',getlocal())."|5|0|");
		_m("mygrid.column use grid1+color|".localize('_color',getlocal())."|5|0|");
		_m("mygrid.column use grid1+xml|".localize('_xml',getlocal())."|link|2|"."javascript:deleteform(\"{code5}\");".'||');

		$out = _m("mygrid.grid use grid1+products+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}	
	
	
	
	
	protected function customers_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_customers',getlocal());
	
	    if (defined('MYGRID_DPC')) {
			
			$xsSQL2 = "SELECT * FROM (SELECT id,timein,active,code2,name,afm,eforia,prfdescr,street,address,number,area,city,zip,voice1,voice2,fax,mail,attr1,attr2,attr3,attr4 FROM customers) x";
			//$out.= $xsSQL2;
			_m("mygrid.column use grid2+id|".localize('id',getlocal())."|5|0|||1");
			_m("mygrid.column use grid2+timein|".localize('_date',getlocal()). "|10|0|");
			_m("mygrid.column use grid2+active|".localize('_active',getlocal())."|boolean|1|");	
			_m("mygrid.column use grid2+code2|".localize('_code2',getlocal())."|10|0|"); //|||1|"); //hide code
			_m("mygrid.column use grid2+name|".localize('_name',getlocal())."|link|30|"."javascript:loyalty(\"{code2}\");".'||');
		    _m("mygrid.column use grid2+prfdescr|".localize('_prfdescr',getlocal())."|20|1|");			
		    //_m("mygrid.column use grid2+afm|".localize('_afm',getlocal())."|10|1|");
	        //_m("mygrid.column use grid2+eforia|".localize('_doy',getlocal())."|20|1|");				
		    _m("mygrid.column use grid2+street|".localize('_street',getlocal())."|20|1|");
			_m("mygrid.column use grid2+address|".localize('_address',getlocal())."|30|1|");
			_m("mygrid.column use grid2+number|".localize('_number',getlocal())."|5|1|");
			_m("mygrid.column use grid2+area|".localize('_area',getlocal())."|10|1|");
		    _m("mygrid.column use grid2+city|".localize('_city',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+zip|".localize('_zip',getlocal())."|10|1|||1|1");
			_m("mygrid.column use grid2+voice1|".localize('_tel',getlocal())."|10|1|");
		    _m("mygrid.column use grid2+voice2|".localize('_tel',getlocal())."|10|1|");			
			//_m("mygrid.column use grid2+fax|".localize('_fax',getlocal())."|10|1|");			
			//_m("mygrid.column use grid2+mail|".localize('_mail',getlocal())."|20|1|");
			//_m("mygrid.column use grid2+attr1|".localize('_attr1',getlocal())."|5|1|");
		    //_m("mygrid.column use grid2+attr2|".localize('_attr2',getlocal())."|5|1|");							
			//_m("mygrid.column use grid2+attr3|".localize('_attr3',getlocal())."|5|1|");
		    //_m("mygrid.column use grid2+attr4|".localize('_attr4',getlocal())."|5|1|");			

			$ret .= _m("mygrid.grid use grid2+customers+$xsSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}


	protected function loadLoyalty($ajaxdiv=null, $mode=null) {
		$id = GetParam('id');
		$cmd = 'cployaltyfetch&id='.$id ;//$mode not used
		$bodyurl = seturl("t=$cmd&iframe=1");
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"460px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}	
	
	protected function loyalty_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));

	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_points',getlocal());  
	
	    if (defined('MYGRID_DPC')) {
			
			$xsSQL2 = "SELECT * FROM (SELECT id,datein,ccode,active,item,source,points,notes FROM custpoints WHERE ccode='$selected') x";
			//echo $xsSQL2;
			_m("mygrid.column use grid2+id|".localize('id',getlocal())."|2|0|||1");
			_m("mygrid.column use grid2+datein|".localize('_date',getlocal())."|10|0|");			
			_m("mygrid.column use grid2+active|".localize('_active',getlocal())."|boolean|1|");	
			_m("mygrid.column use grid2+ccode|".localize('_ccode',getlocal())."|10|1|");//|||1|");
			_m("mygrid.column use grid2+item|".localize('_item',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+source|".localize('_source',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+points|".localize('_points',getlocal())."|5|1|");
			_m("mygrid.column use grid2+notes|".localize('_notes',getlocal())."|20|1|");	
			
			$ret .= _m("mygrid.grid use grid2+custpoints+$xsSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	


	protected function cartpolicy_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_points', getlocal()); //str_replace(' ','_', localize('_cartpoints', getlocal())); 	
		
        $xsSQL = "SELECT * from (select id,datein,active,code1,code2,name,descr,price,qty,discount,points from ppolicy) o ";		   
		   							
		_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|");			
		_m("mygrid.column use grid1+datein|".localize('_date',getlocal())."|5|0|");	
		_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|boolean|1|");
		_m("mygrid.column use grid1+code1|".localize('_code',getlocal())."|5|0|");//"|link|10|"."javascript:editcart(\"{code1}\");".'||');			
		_m("mygrid.column use grid1+code2|".localize('_code',getlocal())."|link|10|"."javascript:showcart(\"{code2}\");".'||');	
		_m("mygrid.column use grid1+name|".localize('_title',getlocal())."|5|1|");	
		_m("mygrid.column use grid1+descr|".localize('_descr',getlocal())."|10|1|");					
		_m("mygrid.column use grid1+price|".localize('_price',getlocal())."|5|1|");		
		//_m("mygrid.column use grid1+price1|".localize('_price1',getlocal())."|5|1|");			
		_m("mygrid.column use grid1+points|".localize('_points',getlocal())."|5|1|");
		_m("mygrid.column use grid1+qty|".localize('_qty',getlocal())."|5|1|");		
		_m("mygrid.column use grid1+discount|".localize('_discount',getlocal())."|5|1|");		
		//_m("mygrid.column use grid1+xml|".localize('_xml',getlocal())."|link|2|"."javascript:deleteform(\"{code5}\");".'||');

		$out = _m("mygrid.grid use grid1+ppolicy+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}		
	
	protected function createButton($name=null, $urls=null, $t=null, $s=null) {
		$type = $t ? $t : 'primary'; //danger /warning / info /success
		switch ($s) {
			case 'large' : $size = 'btn-large '; break;
			case 'small' : $size = 'btn-small '; break;
			case 'mini'  : $size = 'btn-mini '; break;
			default      : $size = null;
		}
		
		//$ret = "<button class=\"btn  btn-primary\" type=\"button\">Primary</button>";
		
		if (!empty($urls)) {
			foreach ($urls as $n=>$url)
				$links .= '<li><a href="'.$url.'">'.$n.'</a></li>';
			$lnk = '<ul class="dropdown-menu">'.$links.'</ul>';
		} 
		
		$ret = '
			<div class="btn-group">
                <button data-toggle="dropdown" class="btn '.$size.'btn-'.$type.' dropdown-toggle">'.$name.' <span class="caret"></span></button>
                '.$lnk.'
            </div>'; 
			
		return ($ret);
	}
	
	
	protected function window($title, $buttons, $content) {
		$ret = '	
		    <div class="row-fluid">
                <div class="span12">
                  <div class="widget red">
                        <div class="widget-title">
                           <h4><i class="icon-reorder"></i> '.$title.'</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                        </div>
                        <div class="widget-body">
							<div class="btn-toolbar">
							'. $buttons .'
							<hr/><div id="loyaltyform"></div>
							</div>
							'.  $content .'
                        </div>
                  </div>
                </div>
            </div>
';
		return ($ret);
	}		
	
};
}
?>