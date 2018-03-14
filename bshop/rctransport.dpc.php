<?php
$__DPCSEC['RCTRANSPORT_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCTRANSPORT_DPC")) && (seclevel('RCTRANSPORT_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCTRANSPORT_DPC",true);

$__DPC['RCTRANSPORT_DPC'] = 'rctransport';

$__EVENTS['RCTRANSPORT_DPC'][0]='cptransport';
$__EVENTS['RCTRANSPORT_DPC'][1]='cpitemqfetch';
$__EVENTS['RCTRANSPORT_DPC'][2]='cpitemqform';
$__EVENTS['RCTRANSPORT_DPC'][3]='cpitemqdetail';
$__EVENTS['RCTRANSPORT_DPC'][4]='cpitemqdel';

$__ACTIONS['RCTRANSPORT_DPC'][0]='cptransport';
$__ACTIONS['RCTRANSPORT_DPC'][1]='cpitemqfetch';
$__ACTIONS['RCTRANSPORT_DPC'][2]='cpitemqform';
$__ACTIONS['RCTRANSPORT_DPC'][3]='cpitemqdetail';
$__ACTIONS['RCTRANSPORT_DPC'][4]='cpitemqdel';

$__LOCALE['RCTRANSPORT_DPC'][0]='RCTRANSPORT_DPC;Transport;Τρόποι αποστολής';
$__LOCALE['RCTRANSPORT_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['RCTRANSPORT_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['RCTRANSPORT_DPC'][3]='_actions;Actions;Επιλογή';
$__LOCALE['RCTRANSPORT_DPC'][4]='_items;Items;Είδη';
$__LOCALE['RCTRANSPORT_DPC'][5]='_active;Active;Ενεργό';
$__LOCALE['RCTRANSPORT_DPC'][6]='_title;Title;Τίτλος';
$__LOCALE['RCTRANSPORT_DPC'][7]='_descr;Description;Περιγραφή';
$__LOCALE['RCTRANSPORT_DPC'][8]='_orderid;Order;Order';
$__LOCALE['RCTRANSPORT_DPC'][9]='_transports;Transports;Αποστολές';
$__LOCALE['RCTRANSPORT_DPC'][10]='_code;Code;Κωδικός';
$__LOCALE['RCTRANSPORT_DPC'][11]='_lantitle;LTitle;Τίτλος μτφ.';
$__LOCALE['RCTRANSPORT_DPC'][12]='_address;Address;Διεύθυνση';
$__LOCALE['RCTRANSPORT_DPC'][13]='_area;Area;Περιοχή';
$__LOCALE['RCTRANSPORT_DPC'][14]='_zip;Zip;Ταχ. κωδικός';
$__LOCALE['RCTRANSPORT_DPC'][15]='_country;Country;Χώρα';
$__LOCALE['RCTRANSPORT_DPC'][16]='_cartsum;Σcart;Σcart.';
$__LOCALE['RCTRANSPORT_DPC'][17]='_rules;Rules;Κανονισμοί';
$__LOCALE['RCTRANSPORT_DPC'][18]='_groupid;Group;Group';
$__LOCALE['RCTRANSPORT_DPC'][19]='_cost;Cost;Κόστος';
$__LOCALE['RCTRANSPORT_DPC'][20]='_price;Price;Αξία';
$__LOCALE['RCTRANSPORT_DPC'][21]='_save;Save;Αποθήκευση';


class rctransport {
	
    var $title, $path, $urlpath;
	var $seclevid, $userDemoIds;	
	
	public function __construct() {

		$this->path = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		$this->title = localize('RCTRANSPORT_DPC',getlocal());	 
	  
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
			case 'cptransport'  :
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
			case 'cptransport'  :
			default             : $out = $this->transport();
		}	 

		return ($out);
    }
	
	protected function transport() {
		$mode = GetReq('mode');
        
		$turl0 = seturl('t=cptransport');		
		$turl1 = seturl('t=cptransport&mode=rules');
		$button = $this->createButton(localize('_actions', getlocal()), 
										array(localize('_transports', getlocal())=>$turl0,
										      localize('_rules', getlocal())=>$turl1,
		                                ),'success');		
																
		switch ($mode) {
			case 'rules'    :   $content = $this->gridRules(null,140,5,'d', true); break;
			default         :   $content = $this->grid(null,140,5,'e', true);
		}			
		
					
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
		//if (!$id) return null;
		if ((!$id) || (!$_POST)) return null;
		$db = GetGlobal('db');
				
		$data = trim($_POST['formdata']);

		$encdata = trim($_POST['formdata']); //base64_encode(trim($_POST['formdata']));	
		$sSQL = "select notes from ptransports where code=" . $db->qstr($id);
		$res = $db->Execute($sSQL);	
		
		if ($res->fields[0]) {
			$sSQL1 = ($data) ? 
						"update ptransports set notes="  . $db->qstr($encdata) . " where code=" . $db->qstr($id) :
						"update ptransports set notes='' where code=" . $db->qstr($id); 

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
		
		$sSQL = "select notes from ptransports where code=" . $db->qstr($id);
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
		$title = localize('_transports', getlocal()); 
		
        $xsSQL = "SELECT * from (select id,active,code,title,lantitle,cost,groupid,cartsum,orderid from ptransports) o ";		   
		   							
		_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|");			
		_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|boolean|1|");				
		_m("mygrid.column use grid1+code|".localize('_code',getlocal())."|link|5|"."javascript:editform(\"{code}\");".'||');
		_m("mygrid.column use grid1+title|".localize('_title',getlocal())."|10|1|");	
		_m("mygrid.column use grid1+lantitle|".localize('_lantitle',getlocal())."|5|1|");			
		_m("mygrid.column use grid1+cost|".localize('_cost',getlocal())."|5|1|");		
		_m("mygrid.column use grid1+groupid|".localize('_groupid',getlocal())."|5|1|");
		_m("mygrid.column use grid1+cartsum|".localize('_cartsum',getlocal())."|5|1|");					
		_m("mygrid.column use grid1+orderid|".localize('_orderid',getlocal())."|5|1|");

		$out = _m("mygrid.grid use grid1+ptransports+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}	
	
	
	protected function gridRules($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_rules', getlocal()); 
		
        $xsSQL = "SELECT * from (select id,active,datein,title,address,area,zip,country,cost,transports,orderid from ptransrules) o ";		   
		   							
		_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|");
		_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|boolean|1|");		
		_m("mygrid.column use grid1+datein|".localize('_date',getlocal())."|5|0|");		
		_m("mygrid.column use grid1+title|".localize('_title',getlocal())."|5|1|");
		_m("mygrid.column use grid1+address|".localize('_address',getlocal())."|5|1|");		
		_m("mygrid.column use grid1+area|".localize('_area',getlocal())."|5|1|");			
		_m("mygrid.column use grid1+zip|".localize('_zip',getlocal())."|5|1|");		
		_m("mygrid.column use grid1+country|".localize('_country',getlocal())."|5|1|");
		_m("mygrid.column use grid1+cost|".localize('_cost',getlocal())."|5|1|");					
		_m("mygrid.column use grid1+transports|".localize('_transports',getlocal())."|5|1|");
		_m("mygrid.column use grid1+orderid|".localize('_orderid',getlocal())."|5|1|");

		$out = _m("mygrid.grid use grid1+ptransrules+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
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