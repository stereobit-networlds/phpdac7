<?php
$__DPCSEC['RCSHOP_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCSHOP_DPC")) && (seclevel('RCSHOP_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCSHOP_DPC",true);

$__DPC['RCSHOP_DPC'] = 'rcshop';

$__EVENTS['RCSHOP_DPC'][0]='cpshop';
$__EVENTS['RCSHOP_DPC'][1]='cpshopfshow';
$__EVENTS['RCSHOP_DPC'][2]='cpshopshowform';
$__EVENTS['RCSHOP_DPC'][3]='cpshopformdetail';
$__EVENTS['RCSHOP_DPC'][4]='cpshopformdata';
$__EVENTS['RCSHOP_DPC'][5]='cpshopformsubdetail';

$__ACTIONS['RCSHOP_DPC'][0]='cpshop';
$__ACTIONS['RCSHOP_DPC'][1]='cpshopfshow';
$__ACTIONS['RCSHOP_DPC'][2]='cpshopshowform';
$__ACTIONS['RCSHOP_DPC'][3]='cpshopformdetail';
$__ACTIONS['RCSHOP_DPC'][4]='cpshopformdata';
$__ACTIONS['RCSHOP_DPC'][5]='cpshopformsubdetail';

$__LOCALE['RCSHOP_DPC'][0]='RCSHOP_DPC;e-Shop;e-Shop';
$__LOCALE['RCSHOP_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['RCSHOP_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['RCSHOP_DPC'][3]='_ipurchases;Purchases;Πωλήσεις';
$__LOCALE['RCSHOP_DPC'][4]='_owner;Owner;Καταχώρητης';
$__LOCALE['RCSHOP_DPC'][5]='_active;Active;Ενεργό';
$__LOCALE['RCSHOP_DPC'][6]='_title;Title;Τίτλος';
$__LOCALE['RCSHOP_DPC'][7]='_descr;Description;Περιγραφή';
$__LOCALE['RCSHOP_DPC'][8]='_cat;Category;Κατηγορία';
$__LOCALE['RCSHOP_DPC'][9]='_class;Class;Κλάση';
$__LOCALE['RCSHOP_DPC'][10]='_code;Code;Κωδικός';
$__LOCALE['RCSHOP_DPC'][11]='_idashboard;Dashboard;Συνοπτικά';
$__LOCALE['RCSHOP_DPC'][12]='_qpolicy;Q Policy;Ποσ. έκπτωση';
$__LOCALE['RCSHOP_DPC'][13]='_itemrelations;Relative items;Σχετικά είδη';
$__LOCALE['RCSHOP_DPC'][14]='_cat0;Category 1;Κατηγορία 1';
$__LOCALE['RCSHOP_DPC'][15]='_cat1;Category 2;Κατηγορία 2';
$__LOCALE['RCSHOP_DPC'][16]='_cat2;Category 3;Κατηγορία 3';
$__LOCALE['RCSHOP_DPC'][17]='_cat3;Category 4;Κατηγορία 4';
$__LOCALE['RCSHOP_DPC'][18]='_cat4;Category 5;Κατηγορία 5';

$__LOCALE['RCSHOP_DPC'][19]='_status;Status;Φάση';
$__LOCALE['RCSHOP_DPC'][20]='_payway;Pay method;Πληρωμή';
$__LOCALE['RCSHOP_DPC'][21]='_roadway;Delivery;Διανομή';
$__LOCALE['RCSHOP_DPC'][22]='_qty;Qty;Ποσοτ.';
$__LOCALE['RCSHOP_DPC'][23]='_cost;Cost A;Κόστος A';
$__LOCALE['RCSHOP_DPC'][24]='_costpt;Cost B;Κόστος B';
$__LOCALE['RCSHOP_DPC'][25]='Eurobank;Credit card;Πιστωτική κάρτα'; 
$__LOCALE['RCSHOP_DPC'][26]='Piraeus;Credit card;Πιστωτική κάρτα'; 
$__LOCALE['RCSHOP_DPC'][27]='Paypal;Credit card;Πιστωτική κάρτα'; 
$__LOCALE['RCSHOP_DPC'][28]='PayOnsite;Pay on site;Πληρωμή στο κατάστημά μας';
$__LOCALE['RCSHOP_DPC'][29]='BankTransfer;Bank transfer;Κατάθεση σε τραπεζικό λογαριασμό';
$__LOCALE['RCSHOP_DPC'][30]='PayOndelivery;Pay on delivery;Αντικαταβολή';
$__LOCALE['RCSHOP_DPC'][31]='Invoice;Invoice;Τιμολόγιο';
$__LOCALE['RCSHOP_DPC'][32]='Receipt;Receipt;Απόδειξη';
$__LOCALE['RCSHOP_DPC'][33]='CompanyDelivery;Our Delivery Service;Διανομή με όχημα της εταιρείας';
$__LOCALE['RCSHOP_DPC'][34]='Logistics;3d Party Logistic Service;Μεταφορική εταιρεία';
$__LOCALE['RCSHOP_DPC'][35]='Courier;Courier;Courier';
$__LOCALE['RCSHOP_DPC'][36]='CustomerDelivery;Self Service;Παραλαβή απο το κατάστημα μας';
$__LOCALE['RCSHOP_DPC'][37]='_user;User;Χρήστης';
$__LOCALE['RCSHOP_DPC'][38]='_istats;Visits;Επισκέψεις';
$__LOCALE['RCSHOP_DPC'][39]='_catitems;Category;Κατηγορίας';
$__LOCALE['RCSHOP_DPC'][40]='_solditems;Sold;Πωληθέντα';
$__LOCALE['RCSHOP_DPC'][41]='_listitems;Lists;Λίστες';


class rcshop {
	
    var $title, $path, $urlpath;
	var $seclevid, $userDemoIds;
	var $ckeditver, $url;	
	var $appname, $urkRedir, $isHostedApp; 
	
	public function __construct() {

		$this->path = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		$this->url = paramload('SHELL','urlbase');
		$this->title = localize('RCSHOP_DPC',getlocal());	 
	  
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
		$this->userDemoIds = array(5,6,7,8); 		  
		
		$this->ckeditver = 3;
		
		$this->appname = paramload('ID','instancename');
		$this->urlRedir = remote_paramload('RCBULKMAIL','urlredir', $this->path);
		$this->isHostedApp = remote_paramload('RCBULKMAIL','hostedapp', $this->path);		
	}

    public function event($event=null) {
	
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;		 
	
		switch ($event) {
			case 'cpshopformsubdetail': break;				
			
			case 'cpshopformdata': echo $this->loadsubframe();
		                          die();
		                          break;
							   
			case 'cpshopformdetail':
			                      break;		
			case 'cpshopshowform': break;
			case 'cpshopfshow'   : echo $this->loadframe();
		                          die();
							      break;
			case 'cpshop'       :
			default             :    
		                      
		}
			
    }   
	
    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	
	 
		switch ($action) {	
			case 'cpshopformsubdetail': $out = $this->showFormDetail(); 
			                           break;		
		
		    case 'cpshopformdata': break;
			
			case 'cpshopformdetail': 
			                      break;
			case 'cpshopshowform': $out = $this->show(); 
			                      break;	
			case 'cpshopfshow'   : break;
			case 'cpshop'        :
			default              : $out = $this->shopMode();
		}	 

		return ($out);
    }
	
	protected function shopMode() {
		$mode = GetReq('mode') ? GetReq('mode') : 'items';
        
		$turl0 = seturl('t=cpshop&mode=items');		
		$turl1 = seturl('t=cpshop&mode=solditems');
		$turl2 = seturl('t=cpshop&mode=catitems');
		$l = array(localize('_items', getlocal())=>$turl0,
			       localize('_solditems', getlocal())=>$turl1,
				   localize('_catitems', getlocal())=>$turl2,);
		$s = serialize($l); 
										
		$button = _m("cms.createButton use ".localize('_listitems', getlocal()).'+'.$s.'+success');		
																	
		switch ($mode) {
			case 'solditems':   $content = $this->solditems_grid(null,140,5,'r', true); break;
			case 'catitems' :   $content = $this->catitems_grid(null,140,5,'r', true); break;
			case 'items'    :   
			default         :   $content = $this->items_grid(null,140,5,'r', true); 
		}			
					
		$ret = $this->window('e-Shop: '.localize('_'.$mode, getlocal()), $button, $content);
		
		return ($ret);
	}	
	
	protected function loadframe($ajaxdiv=null, $mode=null) {
		$id = GetParam('id');
		$cmd = 'cpshopshowform&id='.$id ;//$mode not used
		$bodyurl = seturl("t=$cmd&iframe=1");
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"460px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}
	
	protected function loadsubframe($ajaxdiv=null, $module=null, $init=false) {
		$module = $module ? $module : GetParam('module'); //module details
		$id = GetParam('id'); //form id

		if ($init)
			$bodyurl = seturl("t=cpshopformdetail&iframe=1&id=$id&module=$module");
		else
			$bodyurl = seturl("t=cpshopformsubdetail&iframe=1&id=$id&module=$module");
	
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
		
		$ret = $this->loadsubframe(null,'dashboard', true);
		
		return ($ret);
	}	
	
	protected function showFormDetail() {
		$module = GetReq('module');
		$formid = GetReq('id');
		
		switch ($module) {
			case 'irelatives' : $ret = $this->irelatives_grid(null,360,15,'r', true); 
			                    break; 
			case 'ipurchases' : $ret = $this->ipurchases_grid(null,360,15,'r', true);
			                    break; 
			case 'istats'     : $ret = $this->itemstats_grid(null,360,15,'r', true);
			                    break;
			case 'formcode'   :
			case 'iqpolicy'   :
			case 'dashboard'  :
			default           : 
		}
		
		return ($ret);
	}
	
	protected function fetchField($id=null, $field=null) {
		if ((!$id) || (!$field)) return null;
		
		$db = GetGlobal('db');
		$sSQL = "select $field from products where id=".$id;
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		return $res->fields[0];
	}
	
	protected function saveFormData($id, $data=null) {
		if (!$id) return null;
		$db = GetGlobal('db');
		//$sSQL = "update cmstemplates set data=" . $db->qstr($data);
		//$sSQL.= " where id=" . $id;
		//$res = $db->Execute($sSQL);
		return true;
	}	
	
	public function fetchFormData() {
		$id = GetParam('id');
		
		/*if ($_POST['id'])
			$ret = $this->saveFormData($id, base64_encode($_POST['formdata']));
		
		return base64_decode($this->fetchField($id, 'data'));*/
	}
	
	protected function saveQPolicyData($id) {
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
	}		
	
	public function fetchQPolicyData() {
		$db = GetGlobal('db');			
		$id = GetParam('id');
		$icode = _m("cmsrt.getItemCode use ".$id);
		
		if ($_POST['id']) 
			$ret = $this->saveQPolicyData($icode);
		
		$sSQL = "select data from ppolicyres where ispoints=0 and code=" . $db->qstr($icode);
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
		$title = localize('_items',$lan);
		$iname = $lan ? 'itmname' : 'itmfname';
	
	    if (defined('MYGRID_DPC')) {	
			
			$code = _m("cmsrt.getmapf use code");
			
			$xsSQL2 = "SELECT * FROM (SELECT id,datein,$code,itmactive,active,$iname,sysins,cat0,cat1,cat2,cat3,cat4 FROM products) x";
			//echo $xsSQL2;
			_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|||1");
			_m("mygrid.column use grid1+datein|".localize('_date',getlocal()). "|5|0|");
			_m("mygrid.column use grid1+$code|".localize('_code',getlocal())."|link|4|"."javascript:editform(\"{id}\");".'||');
		    _m("mygrid.column use grid1+itmactive|".localize('_active',getlocal())."|2|0|");		
			_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|2|0|");
			_m("mygrid.column use grid1+sysins|".localize('_date',getlocal())."|5|0|");			
			_m("mygrid.column use grid1+$iname|".localize('_title',getlocal())."|10|0|");	
			_m("mygrid.column use grid1+cat0|".localize('_cat0',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat1|".localize('_cat1',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat2|".localize('_cat2',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat3|".localize('_cat3',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat4|".localize('_cat4',getlocal())."|5|0|");	
			$ret .= _m("mygrid.grid use grid1+products+$xsSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);	
	}	
	
	
	protected function getSoldItems() {
        $db = GetGlobal('db');
		
	    $sSQL = "select tdata from transactions where " . $this->sqlDateRange('timein', true);
        $result = $db->Execute($sSQL,2);
	    foreach ($result as $n=>$rec) {	
			$tdata = $rec['tdata'];
		 
			if ($tdata) {
				$cdata = unserialize($tdata);
				if (is_array($cdata)) { 
					foreach ($cdata as $i=>$buffer_data) {
						$param = explode(";",$buffer_data);
						if ($param[0]!='x') 
							$ret[] = $param[0];  
					}	 
				}
			} 
	    }
	    return ((!empty($ret)) ? implode('|', $ret) : null);	   	
	}
	
	protected function solditems_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal();// ? getlocal() : 0;  
		$title = localize('_solditems',$lan);
		$iname = $lan ? 'itmname' : 'itmfname';		
	
	    if (defined('MYGRID_DPC')) {	
			
			$code = _m("cmsrt.getmapf use code");
			
			$codelist = $this->getSoldItems();
			if (!empty($codelist)) {
				$dSQL = " $code REGEXP '". $codelist . "'";
			}	
			else
				$dSQL = " $code=0"; //dummy, null grid				
			
			$xsSQL2 = "SELECT * FROM (SELECT id,datein,$code,itmactive,active,$iname,sysins,cat0,cat1,cat2,cat3,cat4 FROM products where $dSQL) x";
			//echo $xsSQL2;
			_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|||1");
			_m("mygrid.column use grid1+datein|".localize('_date',getlocal()). "|5|0|");
			_m("mygrid.column use grid1+$code|".localize('_code',getlocal())."|link|4|"."javascript:editform(\"{id}\");".'||');
		    _m("mygrid.column use grid1+itmactive|".localize('_active',getlocal())."|2|0|");		
			_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|2|0|");
			_m("mygrid.column use grid1+sysins|".localize('_date',getlocal())."|5|0|");			
			_m("mygrid.column use grid1+$iname|".localize('_title',getlocal())."|10|0|");	
			_m("mygrid.column use grid1+cat0|".localize('_cat0',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat1|".localize('_cat1',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat2|".localize('_cat2',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat3|".localize('_cat3',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat4|".localize('_cat4',getlocal())."|5|0|");	
			$ret .= _m("mygrid.grid use grid1+products+$xsSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);	
	}	

	protected function catitems_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal();// ? getlocal() : 0;  
		$title = localize('_catitems',$lan);
		$iname = $lan ? 'itmname' : 'itmfname';		
	
	    if (defined('MYGRID_DPC')) {	
			
			$code = _m("cmsrt.getmapf use code");			
			$cpGet = _v('rcpmenu.cpGet');

			if ($cat = $cpGet['cat']) {
				$csep = _v('cmsrt.cseparator');
				$categories = explode($csep, $cat);			
				foreach ($categories as $i=>$c) 
                   $ds[] = 'cat'.strval($i)."='"._m("cmsrt.replace_spchars use $c+1") . "'";  
				
				$dSQL = (!empty($ds)) ? implode (' AND ', $ds) : " $code=0";
			}	
			else
				$dSQL = " $code=0"; //dummy, null grid					
			
			$xsSQL2 = "SELECT * FROM (SELECT id,datein,$code,itmactive,active,$iname,sysins,cat0,cat1,cat2,cat3,cat4 FROM products where $dSQL) x";
			//echo $xsSQL2;
			_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|||1");
			_m("mygrid.column use grid1+datein|".localize('_date',getlocal()). "|5|0|");
			_m("mygrid.column use grid1+$code|".localize('_code',getlocal())."|link|4|"."javascript:editform(\"{id}\");".'||');
		    _m("mygrid.column use grid1+itmactive|".localize('_active',getlocal())."|2|0|");		
			_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|2|0|");
			_m("mygrid.column use grid1+sysins|".localize('_date',getlocal())."|5|0|");			
			_m("mygrid.column use grid1+$iname|".localize('_title',getlocal())."|10|0|");	
			_m("mygrid.column use grid1+cat0|".localize('_cat0',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat1|".localize('_cat1',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat2|".localize('_cat2',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat3|".localize('_cat3',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat4|".localize('_cat4',getlocal())."|5|0|");	
			$ret .= _m("mygrid.grid use grid1+products+$xsSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
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
							<hr/><div id="shopform"></div>
							</div>
							'.  $content .'
                        </div>
                  </div>
                </div>
            </div>
';
		return ($ret);
	}	
	
	public function formsTree() {
		if (!GetReq('id')) return false;		
		
		$id = "&id=" . GetReq('id');
		$treeTitle = $this->fetchField(GetReq('id'), _m("cmsrt.getmapf use code"));
		
		$relatives = localize('_itemrelations',getlocal());
		$qpolicy = localize('_qpolicy',getlocal());
		$dashboard = localize('_idashboard',getlocal());
		$purchases = localize('_ipurchases',getlocal());
		$stats = localize('_istats',getlocal());

		$ret = '	
                            <ul id="tree_2" class="tree">
                                <li>
                                    <a data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle" data-role="branch" href="#">'.substr($treeTitle, 0, 9).'</a>
                                    <ul class="branch in">
										<li><a data-role="leaf" href="javascript:subdetails(\'dashboard'.$id.'\')"><i class="icon-user"></i> '.$dashboard.'</a></li>
										<li><a data-role="leaf" href="javascript:subdetails(\'ipurchases'.$id.'\')"><i class=" icon-book"></i> '.$purchases.'</a></li>
                                        <li><a data-role="leaf" href="javascript:subdetails(\'iqpolicy'.$id.'\')"><i class=" icon-book"></i> '.$qpolicy.'</a></li>										
										<li><a data-role="leaf" href="javascript:subdetails(\'irelatives'.$id.'\')"><i class=" icon-book"></i> '.$relatives.'</a></li>
                                        <li><a data-role="leaf" href="javascript:subdetails(\'istats'.$id.'\')"><i class="icon-share"></i> '.$stats.'</a></li>											
										<!--li><a data-role="leaf" href="javascript:subdetails(\'formtest'.$id.'\')"><i class="icon-share"></i> Test</a></li-->
                                    </ul>
                                </li>
                            </ul>		
';
		return ($ret);
	}
		
    public function ckeditorjs($element=null, $maxmininit=false, $disable=false) {

		$readonly = $disable ? 1 : 0;  
		$element_name = $element; 
		$minmax = $maxmininit ? $maxmininit : ($_GET['stemplate'] ? 'maximize' : 'minimize') ;		
		$fullpage = 'false';
		
	    $ckattr = ($this->ckeditver==4) ?
	           "fullpage : $fullpage,"	  
	           : 
	           "skin : 'v2', 
			   fullpage : $fullpage, 
			   extraPlugins :'docprops',";		
		
		$ret = "
			<script type='text/javascript'>
	           CKEDITOR.replace('$element_name',
			   {
				$ckattr	
				filebrowserBrowseUrl : '/cp/ckfinder/ckfinder.html',
	            filebrowserImageBrowseUrl : '/cp/ckfinder/ckfinder.html?type=Images',
	            filebrowserFlashBrowseUrl : '/cp/ckfinder/ckfinder.html?type=Flash',
	            filebrowserUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	            filebrowserImageUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	            filebrowserFlashUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
	            filebrowserWindowWidth : '1000',
 	            filebrowserWindowHeight : '700'				
			   }		   
			   );
			   CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
			   CKEDITOR.config.forcePasteAsPlainText = true; // default so content won't be manipulated on load
			   CKEDITOR.config.fullPage = $fullpage;
               CKEDITOR.config.entities = false;
			   CKEDITOR.config.basicEntities = false;
			   CKEDITOR.config.entities_greek = false;
			   CKEDITOR.config.entities_latin = false;
			   CKEDITOR.config.entities_additional = '';
			   CKEDITOR.config.htmlEncodeOutput = false;
			   CKEDITOR.config.entities_processNumerical = false;
			   CKEDITOR.config.fillEmptyBlocks = function (element) {
				return true; // DON'T DO ANYTHING!!!!!
               };
			   CKEDITOR.config.allowedContent = true; // don't filter my data	
			   CKEDITOR.config.protectedSource.push( /<phpdac[\s\S]*?\/phpdac>/g );
			   CKEDITOR.on('instanceReady',
               function( evt )
               {
                  var editor = evt.editor;
                  editor.execCommand('$minmax');
				  editor.setReadOnly($readonly);
               });			   
		    </script>		
";

		return ($ret);
	}
	
	protected function getRelativeItems($id=null) {
		$db = GetGlobal('db');		
		if (!$id) return null;			
		
		$icode = _m("cmsrt.getItemCode use ".$id);
		$objSQL = "select relation from relatives WHERE relative=" . $db->qstr($icode);

		$oret = $db->Execute($objSQL);
		foreach ($oret as $i=>$rec)
			$list[] = $rec[0];
		
		$ret = ((!empty($list)) ? implode(',', $list) : null);	
		return ($ret);			
	}		
	
	protected function irelatives_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = str_replace(' ','_',localize('_itemrelations',getlocal()));
		
		$code = _m("cmsrt.getmapf use code");		
	
	    if (defined('MYGRID_DPC')) {
			
			$ilist = $this->getRelativeItems($selected);
			
			if (!empty($ilist)) {
				$dSQL = " $code in (". $ilist . ")";
			}	
			else
				$dSQL = " $code=0"; //dummy, null grid			
			
			$xsSQL2 = "SELECT * FROM (SELECT id,datein,$code,itmactive,active,itmname,sysins,cat0,cat1,cat2,cat3,cat4 FROM products WHERE $dSQL) x";
			//echo $xsSQL2;
			_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|||1");
			_m("mygrid.column use grid1+datein|".localize('_date',getlocal()). "|5|0|");
			_m("mygrid.column use grid1+$code|".localize('_code',getlocal())."|link|4|"."javascript:showdetails(\"{code5}~$selected\");".'||');
		    _m("mygrid.column use grid1+itmactive|".localize('_active',getlocal())."|2|0|");		
			_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|2|0|");
			_m("mygrid.column use grid1+sysins|".localize('_date',getlocal())."|5|0|");			
			_m("mygrid.column use grid1+itmname|".localize('_title',getlocal())."|10|0|");	
			_m("mygrid.column use grid1+cat0|".localize('_cat0',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat1|".localize('_cat1',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat2|".localize('_cat2',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat3|".localize('_cat3',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat4|".localize('_cat4',getlocal())."|5|0|");	
			$ret .= _m("mygrid.grid use grid1+products+$xsSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	
	
	
	protected function getItemTransactions($id=null) {
        $db = GetGlobal('db');
	    if (!$id) return null;
	    $icode = _m("cmsrt.getItemCode use ".$id);
		
	    $sSQL = "select recid from transactions where tdata REGEXP " . $db->qstr($icode);
        $result = $db->Execute($sSQL,2);
	    //echo $sSQL;
	   
	    foreach ($result as $n=>$rec) {	
			$ret[] = $rec[0]; 
	    }
	    return ((!empty($ret)) ? implode(',', $ret) : null);   	   	
	}	
	
	protected function ipurchases_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_ipurchases',getlocal());
	
	    if (defined('MYGRID_DPC')) {
			
			$codelist = $this->getItemTransactions($selected);
			
			if (!empty($codelist)) {
				$dSQL = " recid in (". $codelist . ")";
			}	
			else
				$dSQL = ' recid=0'; //dummy, null grid			
			
			$lookup1 = "ELT(FIELD(i.payway, 'Eurobank','Piraeus','Paypal','BankTransfer','PayOnsite','PayOndelivery'),".
			                      "'".localize('Eurobank',getlocal())."',".
								  "'".localize('Piraeus',getlocal())."',".
								  "'".localize('Paypal',getlocal())."',".
			                      "'".localize('BankTransfer',getlocal())."',".
								  "'".localize('PayOnsite',getlocal())."',".
								  "'".localize('PayOndelivery',getlocal())."') as pw";			
								  
			$lookup2 = "ELT(FIELD(i.roadway, 'CompanyDelivery','CustomerDelivery','Logistics','Courier'),".
				                  "'".localize('CompanyDelivery',getlocal())."',".
					   		      "'".localize('CustomerDelivery',getlocal())."',".
								  "'".localize('Logistics',getlocal())."',".
								  "'".localize('Courier',getlocal())."') as rw";								  
		
			$xsSQL2 = "SELECT * FROM (SELECT i.recid,i.tid,i.cid,i.tdate,i.ttime,i.tstatus,$lookup1,$lookup2,i.qty,i.cost,i.costpt FROM transactions i where $dSQL) x";

			_m("mygrid.column use grid2+recid|".localize('id',getlocal())."|5|0|||1|1");
			_m("mygrid.column use grid2+tid|".localize('id',getlocal())."|link|5|"."javascript:showtrans({tid});".'||');
			_m("mygrid.column use grid2+cid|".localize('_user',getlocal())."|20|1|");			
			_m("mygrid.column use grid2+tdate|".localize('_date',getlocal())."|date|0|");
		    _m("mygrid.column use grid2+ttime|".localize('_time',getlocal())."|9|0|");	
			_m("mygrid.column use grid2+tstatus|".localize('_status',getlocal())."|5|0|||||right");	
		    _m("mygrid.column use grid2+pw|".localize('_payway',getlocal())."|20|1|");			
		    _m("mygrid.column use grid2+rw|".localize('_roadway',getlocal())."|20|1|");
	        _m("mygrid.column use grid2+qty|".localize('_qty',getlocal())."|5|0|||||right");				
			_m("mygrid.column use grid2+cost|".localize('_cost',getlocal())."|5|0|||||right");
			_m("mygrid.column use grid2+costpt|".localize('_costpt',getlocal())."|5|0|||||right");

			$ret .= _m("mygrid.grid use grid2+transactions+$xsSQL2+$mode+$title+recid+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	
	
	
	
	protected function itemstats_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_istats',getlocal());
		
		$code = _m("cmsrt.getItemCode use ".$selected);
	
	    if (defined('MYGRID_DPC')) {
			
	        $xSQL2 = "select * from (select id,date,tid,attr1,attr2,attr3,REMOTE_ADDR,ref from stats where tid='$code') as o";  				
            //echo $xSQL2;
		    _m("mygrid.column use grid9+id|".localize('id',getlocal())."|2|1|");
			_m("mygrid.column use grid9+date|".localize('_date',getlocal()).'|5|0|');				
            _m("mygrid.column use grid9+tid|".localize('_tid',getlocal()).'|5|0|'); 
            _m("mygrid.column use grid9+attr1|".localize('attr',getlocal()).'|10|0|');				
            _m("mygrid.column use grid9+attr2|".localize('attr',getlocal()).'|10|0|');		
			_m("mygrid.column use grid9+attr3|".localize('attr',getlocal()).'|10|0|');
			_m("mygrid.column use grid9+REMOTE_ADDR|".localize('_ip',getlocal())."|10|0|");
			_m("mygrid.column use grid9+ref|".localize('ref',getlocal())."|10|0|");
			
			$ret .= _m("mygrid.grid use grid9+stats+$xSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}
	
	
    public function select_timeline($template,$year=null, $month=null) {
		$id = urldecode(GetReq('id'));
		$year = GetParam('year') ? GetParam('year') : date('Y'); 
	    $month = GetParam('month') ? GetParam('month') : date('m');
		$daterange = GetParam('rdate');
		
		$t = ($template!=null) ? _m("cmsrt.select_template use ".$template) : null;		
	    if ($t) {
			for ($y=2015;$y<=intval(date('Y'));$y++) {
				$yearsli .= '<li>'. seturl("t=cpshopformsubdetail&id=$id&module=dashboard&month=".$month.'&year='.$y, $y) .'</li>';
			}
		
			for ($m=1;$m<=12;$m++) {
				$mm = sprintf('%02d',$m);
				$monthsli .= '<li>' . seturl("t=cpshopformsubdetail&id=$id&module=dashboard&month=".$mm.'&year='.$year, $mm) .'</li>';
			}	  
	  
	        $posteddaterange = $daterange ? ' &gt ' . $daterange : ($year ? ' &gt ' . $month . ' ' . $year : null) ;
	  
			$tokens[] = null; 
			$tokens[] = $year;
			$tokens[] = $month;
			$tokens[] = localize('_year',getlocal());
			$tokens[] = $yearsli;
			$tokens[] = localize('_month',getlocal());			
			$tokens[] = $monthsli;	
            $tokens[] = $daterange;			
		
			$ret = _m("cmsrt.combine_tokens use $t+" . serialize($tokens));//$this->combine_tokens($t, $tokens); 				
     
			return ($ret);
		}
		
		return null;	
    }	
	
	protected function sqlDateRange($fieldname, $istimestamp=false, $and=false) {
		$sqland = $and ? ' AND' : null;
		if ($daterange = GetParam('rdate')) {//post
			$range = explode('-',$daterange);
			$dstart = str_replace('/','-',trim($range[0]));
			$dend = str_replace('/','-',trim($range[1]));
			if ($istimestamp)
				$dateSQL = $sqland . " DATE($fieldname) BETWEEN STR_TO_DATE('$dstart','%m-%d-%Y') AND STR_TO_DATE('$dend','%m-%d-%Y')";
			else			
				$dateSQL = $sqland . " $fieldname BETWEEN STR_TO_DATE('$dstart','%m-%d-%Y') AND STR_TO_DATE('$dend','%m-%d-%Y')";			
		}				
		elseif ($y = GetReq('year')) {
			if ($m = GetReq('month')) { $mstart = $m; $mend = $m;} else { $mstart = '01'; $mend = '12';}
			$daysofmonth = cal_days_in_month(CAL_GREGORIAN, $m, $y);
			
			if ($istimestamp)
				$dateSQL = $sqland . " DATE($fieldname) BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";
			else
				$dateSQL = $sqland . " $fieldname BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";		
		}	
        else {
			//$dateSQL = null; 
			
			//always this year by default
			//$mstart = '01'; $mend = '12';
			//always this month by default
			$mstart = date('m'); $mend = date('m');
			$y = date('Y');
			$daysofmonth = date('t');
			
			if ($istimestamp)
				$dateSQL = $sqland . " DATE($fieldname) BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";
			else
				$dateSQL = $sqland . " $fieldname BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";	
            //echo $dateSQL;			
		}	
		
		return ($dateSQL);
	}	
	
	protected function nformat($n, $dec=0) {
		return (number_format($n,$dec,',','.'));
	}

	public function inbox() {//dummy
		return 0;
	}		
	
	public function visits() {
		$db = GetGlobal('db');
		$id = GetReq('id');
		
        $code = _m("cmsrt.getItemCode use ".$id);
		
		$sSQL = "select count(id) from stats where tid='$code'";
		$sSQL.= " and " . $this->sqlDateRange('date', true);	
		$res = $db->Execute($sSQL);
		$ret = $this->nformat($res->fields[0]);
		
		return ($ret);
	}	
	
	public function uniquevisits() {
		$db = GetGlobal('db');
		$id = GetReq('id');
		
        $code = _m("cmsrt.getItemCode use ".$id);
		
		$sSQL = "select distinct count(attr2) from stats where tid='$code' ";
		$sSQL.= " and " . $this->sqlDateRange('date', true); 
		$res = $db->Execute($sSQL);
		$ret = $this->nformat($res->fields[0]);
		
		return ($ret);
	}		

	public function cartin() {
		$db = GetGlobal('db');
		$id = GetReq('id');
		
        $code = _m("cmsrt.getItemCode use ".$id);
		
		$sSQL = "select count(id) from stats where tid='$code' and attr1='cartin'";
		$sSQL.= " and " . $this->sqlDateRange('date', true); 
		$res = $db->Execute($sSQL);
		$ret = $this->nformat($res->fields[0]);
		
		return ($ret);
	}	
	
	public function cartout() {
		$db = GetGlobal('db');
		$id = GetReq('id');
		
        $code = _m("cmsrt.getItemCode use ".$id);
		
		$sSQL = "select count(id) from stats where tid='$code' and attr1='cartout'";
		$sSQL.= " and " . $this->sqlDateRange('date', true); 
		$res = $db->Execute($sSQL);
		$ret = $this->nformat($res->fields[0]);
		
		return ($ret);
	}	
	
	public function itemqty() {
		$id = GetReq('id');
		$ret = $this->fetchField($id, 'ypoloipo1');
		return ($ret);
	}
	
	public function transactions() {
		$db = GetGlobal('db');
		$id = GetReq('id');
		
		$code = _m("cmsrt.getItemCode use ".$id);
		
		$sSQL = "select count(recid) from transactions where tdata REGEXP '$code'";
		$sSQL.= $this->sqlDateRange('timein', true, true); 
		$res = $db->Execute($sSQL);
		$ret = $this->nformat($res->fields[0]);
		return ($ret);
	}
	
	
	public function itemsPurchased() {
       $db = GetGlobal('db');
	   $id = GetReq('id');
	   $code = _m("cmsrt.getItemCode use ".$id);
	   
	   $sSQL = "select tdata from transactions " . 
	           "where tdata REGEXP " . $db->qstr($code) . $this->sqlDateRange('timein', true, true);
       $result = $db->Execute($sSQL,2);
	   
	   foreach ($result as $n=>$rec) {	
         $tdata = $rec['tdata'];
		 
		 if ($tdata) {
		   $cdata = unserialize($tdata);
		   if (is_array($cdata)) { //if (count($cdata)>1) {//if many items
		     foreach ($cdata as $i=>$buffer_data) {
		        $param = explode(";",$buffer_data); 
				if (!in_array($param[0],$ret))  
					$ret[] = $param[0];  
		     }	 
		   }
		 } 
	   }
	   
	   return $this->nformat(count($ret));   	   	
	}

	public function itemsPurchasedQty() {
       $db = GetGlobal('db');
	   $id = GetReq('id');
	   $ret = 0;
	   $code = _m("cmsrt.getItemCode use ".$id);
	   
	   $sSQL = "select tdata from transactions " . 
	           "where tdata REGEXP " . $db->qstr($code) . $this->sqlDateRange('timein', true, true);
       $result = $db->Execute($sSQL,2);
	   
	   foreach ($result as $n=>$rec) {	
         $tdata = $rec['tdata'];
		 
		 if ($tdata) {
		   $cdata = unserialize($tdata);
		   if (is_array($cdata)) { 
		     foreach ($cdata as $i=>$buffer_data) {
		       $param = explode(";",$buffer_data);
				if ($param[0]==$code) {
					$ret += $param[9];  
				}
		     }	 
		   }
		 } 
	   }
	   
	   return $this->nformat($ret);   	   	
	}	
	
	public function itemRevenue() {
       $db = GetGlobal('db');
	   $id = GetReq('id');
	   $ret = 0.0;
	   $code = _m("cmsrt.getItemCode use ".$id);
	   
	   $sSQL = "select tdata from transactions " . 
	           "where tdata REGEXP " . $db->qstr($code) . $this->sqlDateRange('timein', true, true);
       $result = $db->Execute($sSQL,2);
	   //echo $sSQL;
	   foreach ($result as $n=>$rec) {	
         $tdata = $rec['tdata'];
		 
		 if ($tdata) {
		   $cdata = unserialize($tdata);
		   if (is_array($cdata)) { 
		     foreach ($cdata as $i=>$buffer_data) {
		       $param = explode(";",$buffer_data);
				if ($param[0]==$code) {
					$ret +=  floatval($param[9] * floatval(str_replace(',','.',$param[8]))); 
				}			    
		     }	 
		   }
		 } 
	   }
	   
	   return $this->nformat($ret, 2);   	   	
	}	
};
}
?>