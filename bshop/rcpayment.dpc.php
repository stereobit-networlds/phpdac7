<?php
$__DPCSEC['RCPAYMENT_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCPAYMENT_DPC")) && (seclevel('RCPAYMENT_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCPAYMENT_DPC",true);

$__DPC['RCPAYMENT_DPC'] = 'rcpayment';

$__EVENTS['RCPAYMENT_DPC'][0]='cppayment';
$__EVENTS['RCPAYMENT_DPC'][1]='cpitemqfetch';
$__EVENTS['RCPAYMENT_DPC'][2]='cpitemqform';
$__EVENTS['RCPAYMENT_DPC'][3]='cpitemqdetail';
$__EVENTS['RCPAYMENT_DPC'][4]='cpitemqdel';

$__ACTIONS['RCPAYMENT_DPC'][0]='cppayment';
$__ACTIONS['RCPAYMENT_DPC'][1]='cpitemqfetch';
$__ACTIONS['RCPAYMENT_DPC'][2]='cpitemqform';
$__ACTIONS['RCPAYMENT_DPC'][3]='cpitemqdetail';
$__ACTIONS['RCPAYMENT_DPC'][4]='cpitemqdel';

$__LOCALE['RCPAYMENT_DPC'][0]='RCPAYMENT_DPC;Payment;Τρόποι πληρωμής';
$__LOCALE['RCPAYMENT_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['RCPAYMENT_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['RCPAYMENT_DPC'][3]='_qty;Quantity;Ποσότητα';
$__LOCALE['RCPAYMENT_DPC'][4]='_items;Items;Είδη';
$__LOCALE['RCPAYMENT_DPC'][5]='_active;Active;Ενεργό';
$__LOCALE['RCPAYMENT_DPC'][6]='_title;Title;Τίτλος';
$__LOCALE['RCPAYMENT_DPC'][7]='_descr;Description;Περιγραφή';
$__LOCALE['RCPAYMENT_DPC'][8]='_orderid;Order;Order';
$__LOCALE['RCPAYMENT_DPC'][9]='_payments;Payments;Πληρωμές';
$__LOCALE['RCPAYMENT_DPC'][10]='_code;Code;Κωδικός';
$__LOCALE['RCPAYMENT_DPC'][11]='_lantitle;LTitle;Τίτλος μτφ.';
$__LOCALE['RCPAYMENT_DPC'][12]='_tcodes;Transport methods;Τρόποι αποστολής';
$__LOCALE['RCPAYMENT_DPC'][13]='_dimensions;Dimensions;Διαστάσεις';
$__LOCALE['RCPAYMENT_DPC'][14]='_xmlcreate;Create XML;Δημιούργησε XML';
$__LOCALE['RCPAYMENT_DPC'][15]='_xml;XML item;Είδος XML';
$__LOCALE['RCPAYMENT_DPC'][16]='_cartsum;Cart sum;Σύνολο κλθ.';
$__LOCALE['RCPAYMENT_DPC'][17]='_uniname1;Unit;Μον.μετρ.';
$__LOCALE['RCPAYMENT_DPC'][18]='_groupid;Group;Group';
$__LOCALE['RCPAYMENT_DPC'][19]='_cost;Cost;Κόστος';
$__LOCALE['RCPAYMENT_DPC'][20]='_price;Price;Αξία';
$__LOCALE['RCPAYMENT_DPC'][21]='_save;Save;Αποθήκευση';


class rcpayment {
	
    var $title, $path, $urlpath;
	var $seclevid, $userDemoIds;	
	
	public function __construct() {

		$this->path = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		$this->title = localize('RCPAYMENT_DPC',getlocal());	 
	  
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
			case 'cppayment'    :
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
			case 'cppayment'    :
			default             : $out = $this->payment();
		}	 

		return ($out);
    }
	
	protected function payment() {
		$mode = GetReq('mode') ? GetReq('mode') : 'qty';
        /*
		$turl0 = seturl('t=cpcrmforms&mode=messages');		
		$turl1 = seturl('t=cpcrmforms&mode=offers');
		$button = $this->createButton(localize('_forms', getlocal()), 
										array(localize('_messages', getlocal())=>$turl0,
										      localize('_offers', getlocal())=>$turl1,
		                                ),'success');		
																
		switch ($mode) {
	
			case 'qty'      :   
			default         :   
			
		}*/			
		$content = $this->grid(null,140,5,'e', true);
					
		$ret = $this->window($this->title, $button, $content);
		
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

		$encdata = trim($_POST['formdata']); //base64_encode(trim($_POST['formdata']));	
		$sSQL = "select notes from ppayments where code=" . $db->qstr($id);
		$res = $db->Execute($sSQL);	
		
		if ($res->fields[0]) {
			$sSQL1 = ($data) ? 
						"update ppayments set notes="  . $db->qstr($encdata) . " where code=" . $db->qstr($id) :
						"update ppayments set notes='' where code=" . $db->qstr($id); 

			if ($sSQL1)
				$db->Execute($sSQL1);
			
			return true;
		}	
		return (false);
	}

	protected function deleteFormData() {
		$id = GetParam('id');
		if (!$id) return false;

		return ($ret);
	}		
	
	public function fetchFormData() {
		$id = GetParam('id');
		$db = GetGlobal('db');		
		
		if ($id) 
			$ret = $this->saveFormData($id);
		
		$sSQL = "select notes from ppayments where code=" . $db->qstr($id);
		$res = $db->Execute($sSQL);	
		
		return $res->fields[0]; //(base64_decode($res->fields[0]));		
	}
	
	protected function grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_payments', getlocal()); 
		
        $xsSQL = "SELECT * from (select id,active,code,title,lantitle,cost,tcodes,orderid from ppayments) o ";		   
		   							
		_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|");
		_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|boolean|1|");			
		_m("mygrid.column use grid1+code|".localize('_code',getlocal())."|link|5|"."javascript:editform(\"{code}\");".'||');
		_m("mygrid.column use grid1+title|".localize('_title',getlocal())."|10|1|");	
		_m("mygrid.column use grid1+lantitle|".localize('_lantitle',getlocal())."|5|1|");		
		_m("mygrid.column use grid1+tcodes|".localize('_tcodes',getlocal())."|10|1|");			
		_m("mygrid.column use grid1+cost|".localize('_cost',getlocal())."|5|1|");		
		//_m("mygrid.column use grid1+groupid|".localize('_groupid',getlocal())."|5|1|");
		//_m("mygrid.column use grid1+cartsum|".localize('_cartsum',getlocal())."|5|1|");					
		_m("mygrid.column use grid1+orderid|".localize('_orderid',getlocal())."|5|1|");

		$out = _m("mygrid.grid use grid1+ppayments+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
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