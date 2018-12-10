<?php

$__DPCSEC['RCCPCLICK_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCCPCLICK_DPC")) && (seclevel('RCCPCLICK_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCCPCLICK_DPC",true);

$__DPC['RCCPCLICK_DPC'] = 'rccpclick';

require_once(_r('database/dblocales.lib.php'));
require_once(_r('jsdialog/jsdialog.dpc.php'));

GetGlobal('controller')->get_parent('JSDIALOG_DPC','JSDIALOGSTREAM_DPC');
$__EVENTS['RCCPCLICK_DPC'][4]='cpmailsent';
$__EVENTS['RCCPCLICK_DPC'][5]='cpusersin';
$__EVENTS['RCCPCLICK_DPC'][6]='cpcustin';
$__EVENTS['RCCPCLICK_DPC'][7]='cpmailrecs';
$__EVENTS['RCCPCLICK_DPC'][8]='cpmailqueue';
$__EVENTS['RCCPCLICK_DPC'][9]='cptransact';
$__EVENTS['RCCPCLICK_DPC'][10]='cpitemsinact';
$__EVENTS['RCCPCLICK_DPC'][11]='cpitemsactiv';
$__EVENTS['RCCPCLICK_DPC'][12]='cpctgvisits';
$__EVENTS['RCCPCLICK_DPC'][13]='cpitmvisits';

$__ACTIONS['RCCPCLICK_DPC'][4]='cpmailsent';
$__ACTIONS['RCCPCLICK_DPC'][5]='cpusersin';
$__ACTIONS['RCCPCLICK_DPC'][6]='cpcustin';
$__ACTIONS['RCCPCLICK_DPC'][7]='cpmailrecs';
$__ACTIONS['RCCPCLICK_DPC'][8]='cpmailqueue';
$__ACTIONS['RCCPCLICK_DPC'][9]='cptransact';
$__ACTIONS['RCCPCLICK_DPC'][10]='cpitemsinact';
$__ACTIONS['RCCPCLICK_DPC'][11]='cpitemsactiv';
$__ACTIONS['RCCPCLICK_DPC'][12]='cpctgvisits';
$__ACTIONS['RCCPCLICK_DPC'][13]='cpitmvisits';

$__LOCALE['RCCPCLICK_DPC'][0]='RCCPCLICK_DPC;Popup;Παράθυρο';
$__LOCALE['RCCPCLICK_DPC'][1]='_grid;Grid;Λίστα';
$__LOCALE['RCCPCLICK_DPC'][2]='_failed;Failed;Αποτυχίες';
$__LOCALE['RCCPCLICK_DPC'][3]='_view;Views;Προβολές';
$__LOCALE['RCCPCLICK_DPC'][4]='_itmactive;Active items;Ενεργά είδη';
$__LOCALE['RCCPCLICK_DPC'][5]='_itminactive;Inactive items;Ανενεργά είδη';

class rccpclick extends jsdialog {

    function __construct() {
		
		jsdialog::__construct();
		
		//override
		$this->dajaxpage = 'cp.php'; //'jsdialog.php';
    }
	
    public function event($event=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;
		
	    switch ($event) {
			
			case 'cpitmvisits'    :
			case 'cpctgvisits'    :
			case 'cpitemsactiv'   :
			case 'cpitemsinact'   :
			case 'cptransact'     :
			case 'cpmailqueue'    :
			case 'cpmailrecs'     :
			case 'cpmailsent'     : 
		    case 'cpusersin'      : 
			case 'cpcustin'       : 
			default               :	//jsdialog::event($event);						  						
        }
    }	

    public function action($action=null)  { 

		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	
		
	    switch ($action) {
			
			case 'cpitmvisits'     : $datein = $this->sqlDateRange('date', true);
									 $cpGet = _v('rcpmenu.cpGet');
									 $id = _m("cmsrt.getRealItemCode use " . $cpGet['id']);
									 $out = $this->viewGrid(
											'_grid',
											array('id','date','tid','attr1','attr2','vid', 'ref', 'REMOTE_ADDR', 'HTTP_USER_AGENT', 'REFERER'),
											'stats',
											"SELECT * FROM stats where tid='$id' and $datein",
											null,300,12,'r',0
											); 
									 break;			
			
			case 'cpctgvisits'     : $datein = $this->sqlDateRange('date', true);
									 $cpGet = _v('rcpmenu.cpGet');
									 $cat = $cpGet['cat'];
									 $out = $this->viewGrid(
											'_grid',
											array('id','date','tid','attr1','attr2','vid','ref','REMOTE_ADDR','HTTP_USER_AGENT','REFERER'),
											'stats',
											"SELECT * FROM stats where attr1='$cat' and $datein",
											null,300,12,'r',0
											);
									 break; 
									 
			case 'cpmailsent'      : $datein = $this->sqlDateRange('timein', true);
									 $out = $this->viewGrid(
											'_grid',
											array('id','timein','timeout','active','sender','receiver', 'subject', 'reply', 'status', 'mailstatus', 'trackid', 'cid', 'owner'),
											'mailqueue',
											"SELECT * FROM mailqueue where active=0 and $datein",
											null,300,12,'r',0
											); 
									 break; 

			case 'cpmailqueue'     : $datein = $this->sqlDateRange('timein', true);
									 $out = $this->viewGrid(
											'_grid',
											array('id','timein','timeout','active','sender','receiver', 'subject', 'reply', 'status', 'mailstatus', 'trackid', 'cid', 'owner'),
											'mailqueue',
											"SELECT * FROM mailqueue where (active=1 or active=-8) and $datein",
											null,300,12,'r',0
											); 
									 break;	
									 
			case 'cptransact'      : $datein = $this->sqlDateRange('timein', true);
									 $out = $this->viewGrid(
											'_grid',
											array('recid','timein','tid','cid','tdate','ttime', 'tstatus', 'payway', 'roadway', 'qty', 'cost', 'costpt', 'referer'),
											'transactions',
											"SELECT * FROM transactions where $datein",
											null,300,12,'r',0
											); 
									 break;

			case 'cpitemsactiv'    : $datein = $this->sqlDateRange('datein', true);
									 $itmname = $lan ? 'itmname' : 'itmfname';	
									 $out = $this->viewGrid(
											'_grid',
											array('id','datein','code1','code2','code3','code4', 'code5', $itmname, 'uniname1', 'uniname2', 'ypoloipo1', 'ypoloipo2', 'price0', 'price1', 'price2', 'pricepc', 'weight', 'volume', 'dimensions', 'size', 'color', 'manufacturer', 'xml', 'owner'),
											'products',
											"SELECT * FROM products where active>0 and itmactive>0"/* and $datein"*/,
											null,300,12,'r',0
											); 
									 break;									 

			case 'cpitemsinact'    : $datein = $this->sqlDateRange('datein', true);
									 $itmname = $lan ? 'itmname' : 'itmfname';	
									 $out = $this->viewGrid(
											'_grid',
											array('id','datein','code1','code2','code3','code4', 'code5', $itmname, 'uniname1', 'uniname2', 'ypoloipo1', 'ypoloipo2', 'price0', 'price1', 'price2', 'pricepc', 'weight', 'volume', 'dimensions', 'size', 'color', 'manufacturer', 'xml', 'owner'),
											'products',
											"SELECT * FROM products where active=0 and itmactive=0 "/*and $datein"*/,
											null,300,12,'r',0
											);  
									 break;										 
									 
			case 'cpusersin'       : $datein = $this->sqlDateRange('timein', false);
									 $out = $this->viewGrid(
											'_grid',
											array('id','timein','active','email','fname','lname','timezone','fb'),
											'users',
											"SELECT * FROM users where $datein",
											null,300,12,'r',0
											);
									 break;
									 
			case 'cpcustin'        : $datein = $this->sqlDateRange('timein', true);
									 $out = $this->viewGrid(
											'_grid',
											array('id','timein','active','mail','name','afm','eforia','prfdescr','street','address','number','area','zip','city','country','voice1','voice2','fax'),
											'customers',
											"SELECT * FROM customers where $datein",
											null,300,12,'r',0
											);
									 break;
									 
			case 'cpmailrecs'      : $datein = $this->sqlDateRange('datein', true);
									 $out = $this->viewGrid(
											'_grid',
											array('id','datein','startdate','active','gdpr','listname','email','failed','owner'),
											'ulists',
											"SELECT * FROM ulists where $datein",
											null,300,12,'r',0
											);
									 break;		
									 
			default                : $out = jsdialog::action($action);
		}			 

	    return ($out);
	}	

	public function popupClick($responder=null, $title=null) {
		//$w = $width ? $width : 600;
		
		$t = $title ? localize($title, getlocal()) : 'title';
		$url = $responder ? $this->dajaxpage."?t=".$responder : $this->dajaxpage;
		
		$y = GetReq('year');
		$m = GetReq('month');
		$url.= "&month=$m&year=$y";
		
		return $this->zdialogFrame($url, $t, 1200, 400);
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
			if ($m = GetReq('month')) { $mstart = $m; $mend = $m;} else { $mstart = '01'; $mend = '12'; $m='12';}
			$daysofmonth = cal_days_in_month(CAL_GREGORIAN, $m, $y);	
			if ($istimestamp)
				$dateSQL = $sqland . " DATE($fieldname) BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";
			else
				$dateSQL = $sqland . " $fieldname BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";
			
		}	
        else {
			//always this year by default
			//$mstart = '01'; $mend = '12';
			
			$mstart = $mend = date('m');
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
	
	protected function viewGrid($gtitle, $fields, $table, $sql, $width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 300;
        $rows = $rows ? $rows : 12;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'r';
		$noctrl = $noctrl ? 0 : 1;	
		$nosearch = $_GET['cid'] ? 1 : 1;//0; where in sql
		$id = $fields[0];
		
		if (defined('MYGRID_DPC')) {
			$lan = getlocal() ? '1' : '0';	
		    $title = str_replace(' ','_', localize($gtitle, $lan));
			
			$locs = new dblocales;
			if (method_exists($locs, $table)) {
				$translations = $locs->$table();
				//echo $table . ' locales exists!';	
			}
			else 
				$translations = array();
				//echo $table . ' locales func not exists!';	
			
			$query = str_replace('*', implode(',', $fields), $sql);
			$sSQL = "select * from ($query) as o";
			
			foreach ($fields as $f) {
				if (strstr($f, '.')) {
					$fx = explode('.', $f);
					$_f = $fx[1];
				}
				else
					$_f = $f;
				
				//_m("mygrid.column use grid9+$_f|".localize('_'.$_f, $lan).'|10|0');
				_m("mygrid.column use grid9+$_f|". $locs->loc($_f, $translations) .'|10|0');
			}	
			
		    $out .= _m("mygrid.grid use grid9+$table+$sSQL+$mode+$title+$id+$noctrl+1+$rows+$height+$width+$nosearch+1+1");
			
		}
        else  
			$out = null;
   		
	    return ($out);	
	} 	
	
};
}   
?>