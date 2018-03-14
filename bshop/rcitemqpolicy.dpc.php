<?php
$__DPCSEC['RCITEMQPOLICY_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCITEMQPOLICY_DPC")) && (seclevel('RCITEMQPOLICY_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCITEMQPOLICY_DPC",true);

$__DPC['RCITEMQPOLICY_DPC'] = 'rcitemqpolicy';

$__EVENTS['RCITEMQPOLICY_DPC'][0]='cpitemqpolicy';
$__EVENTS['RCITEMQPOLICY_DPC'][1]='cpitemqfetch';
$__EVENTS['RCITEMQPOLICY_DPC'][2]='cpitemqform';
$__EVENTS['RCITEMQPOLICY_DPC'][3]='cpitemqdetail';
$__EVENTS['RCITEMQPOLICY_DPC'][4]='cpitemqdel';

$__ACTIONS['RCITEMQPOLICY_DPC'][0]='cpitemqpolicy';
$__ACTIONS['RCITEMQPOLICY_DPC'][1]='cpitemqfetch';
$__ACTIONS['RCITEMQPOLICY_DPC'][2]='cpitemqform';
$__ACTIONS['RCITEMQPOLICY_DPC'][3]='cpitemqdetail';
$__ACTIONS['RCITEMQPOLICY_DPC'][4]='cpitemqdel';

$__LOCALE['RCITEMQPOLICY_DPC'][0]='RCITEMQPOLICY_DPC;Items;Items';
$__LOCALE['RCITEMQPOLICY_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['RCITEMQPOLICY_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['RCITEMQPOLICY_DPC'][3]='_qty;Quantity;Ποσότητα';
$__LOCALE['RCITEMQPOLICY_DPC'][4]='_items;Items;Είδη';
$__LOCALE['RCITEMQPOLICY_DPC'][5]='_active;Active;Ενεργό';
$__LOCALE['RCITEMQPOLICY_DPC'][6]='_title;Title;Τίτλος';
$__LOCALE['RCITEMQPOLICY_DPC'][7]='_descr;Description;Περιγραφή';
$__LOCALE['RCITEMQPOLICY_DPC'][8]='_xml;Xml;Xml';
$__LOCALE['RCITEMQPOLICY_DPC'][9]='_color;Color;Χρώμα';
$__LOCALE['RCITEMQPOLICY_DPC'][10]='_code;Code;Κωδικός';
$__LOCALE['RCITEMQPOLICY_DPC'][11]='_dimensions;Dimension;Διαστάσεις';
$__LOCALE['RCITEMQPOLICY_DPC'][12]='_size;Size;Μέγεθος';
$__LOCALE['RCITEMQPOLICY_DPC'][13]='_dimensions;Dimensions;Διαστάσεις';
$__LOCALE['RCITEMQPOLICY_DPC'][14]='_xmlcreate;Create XML;Δημιούργησε XML';
$__LOCALE['RCITEMQPOLICY_DPC'][15]='_xml;XML item;Είδος XML';
$__LOCALE['RCITEMQPOLICY_DPC'][16]='_manufacturer;Manufacturer;Κατασκευαστής';
$__LOCALE['RCITEMQPOLICY_DPC'][17]='_uniname1;Unit;Μον.μετρ.';
$__LOCALE['RCITEMQPOLICY_DPC'][18]='_ypoloipo1;Qty;Υπόλοιπο';
$__LOCALE['RCITEMQPOLICY_DPC'][19]='_price0;Price 1;Αξία 1';
$__LOCALE['RCITEMQPOLICY_DPC'][20]='_price1;Price 2;Αξία 2';
$__LOCALE['RCITEMQPOLICY_DPC'][21]='_save;Save;Αποθήκευση';


class rcitemqpolicy {
	
    var $title, $path, $urlpath;
	var $seclevid, $userDemoIds;	
	
	public function __construct() {

		$this->path = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		$this->title = localize('RCCRM_DPC',getlocal());	 
	  
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
		$this->userDemoIds = array(5,6,7,8); 		  
	}

    public function event($event=null) {
	
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;		 
	
		switch ($event) {
		
			case 'cpitemqdetail': break;				
			case 'cpitemqform'  : break;
			
			case 'cpitemqdel':    $this->deleteFormData();                       			
			case 'cpitemqfetch' : echo $this->loadframe();
		                          die();
							      break;
			case 'cpitemqpolicy':
			default             :    
		                      
		}
			
    }   
	
    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	
	 
		switch ($action) {	
			case 'cpitemqdetail': break;			
			case 'cpitemqform'  : $out = $this->show(); 
			                      break;
			case 'cpitemqdel'   :								  
			case 'cpitemqfetch' : break;
			case 'cpitemqpolicy':
			default             : $out = $this->itemsMode();
		}	 

		return ($out);
    }
	
	protected function itemsMode() {
		$mode = GetReq('mode') ? GetReq('mode') : 'qty';
        /*
		$turl0 = seturl('t=cpcrmforms&mode=messages');		
		$turl1 = seturl('t=cpcrmforms&mode=offers');
		$button = $this->createButton(localize('_forms', getlocal()), 
										array(localize('_messages', getlocal())=>$turl0,
										      localize('_offers', getlocal())=>$turl1,
		                                ),'success');		
		*/															
		switch ($mode) {
	
			case 'qty'      :   
			default         :   
			
		}			
		$content = $this->items_grid(null,140,5,'e', true);
					
		$ret = $this->window('q-Policy: '.localize('_'.$mode, getlocal()), $button, $content);
		
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
				
		$data = trim($_POST['formdata']);

		$encdata = base64_encode(trim($_POST['formdata']));	
		$sSQL = "select code from ppolicyres where ispoints=0 and code=" . $db->qstr($id);
		$res = $db->Execute($sSQL);	
		
		if ($res->fields[0])
			$sSQL1 = ($data) ? 
						"update ppolicyres set data="  . $db->qstr($encdata) . " where ispoints=0 and code=" . $db->qstr($id) :
						"delete from ppolicyres where ispoints=0 and code=" . $db->qstr($id); 
		else
			$sSQL1 = ($data) ? 
						"insert into ppolicyres (active,code,data,ispoints) values (1,'$id','$encdata',0)" :
						null;
		
		if ($sSQL1)
			$db->Execute($sSQL1);
		
		return true;		
		//return ($ret);
	}

	protected function deleteFormData() {
		$id = GetParam('id');
		if (!$id) return false;
		
		$ret = @unlink($this->path . $id.'.txt');
		
		return ($ret);
	}		
	
	public function fetchFormData() {
		$id = GetParam('id');
		$db = GetGlobal('db');		
		
		if ($id) 
			$ret = $this->saveFormData($id);
		
		$sSQL = "select data from ppolicyres where ispoints=0 and code=" . $db->qstr($id);
		$res = $db->Execute($sSQL);	
		return (base64_decode($res->fields[0]));		
	}
	
	protected function items_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal();// ? getlocal() : 0;  
		$title = localize('_items', $lan); 
		$iname = $lan ? 'itmname' : 'itmfname';
		
        $xsSQL = "SELECT * from (select id,sysins,code5,xml,itmactive,active,$iname,uniname1,ypoloipo1,price0,price1,manufacturer,size,color from products) o ";		   
		//code3,cat0,cat1,cat2,cat3,cat4,resources
		   							
		_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|");//"|link|5|"."javascript:editform(\"{id}\");".'||');			
		_m("mygrid.column use grid1+itmactive|".localize('_active',getlocal())."|2|0|");//"|boolean|1|1:0");		
		_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|2|0|");//"|boolean|1|101:0|");
		_m("mygrid.column use grid1+sysins|".localize('_date',getlocal())."|5|0|");		
		_m("mygrid.column use grid1+code5|".localize('_code',getlocal())."|5|0|");	
		_m("mygrid.column use grid1+$iname|".localize('_title',getlocal())."|link|10|"."javascript:editform(\"{code5}\");".'||');	
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
							<hr/><div id="crmform"></div>
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