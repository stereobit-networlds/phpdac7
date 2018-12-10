<?php

$__DPCSEC['RCBMAILCLICK_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCBMAILCLICK_DPC")) && (seclevel('RCBMAILCLICK_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCBMAILCLICK_DPC",true);

$__DPC['RCBMAILCLICK_DPC'] = 'rcbmailclick';

require_once(_r('database/dblocales.lib.php'));
require_once(_r('jsdialog/jsdialog.dpc.php'));

GetGlobal('controller')->get_parent('JSDIALOG_DPC','JSDIALOGSTREAM_DPC');
$__EVENTS['RCBMAILCLICK_DPC'][4]='bmailsent';
$__EVENTS['RCBMAILCLICK_DPC'][5]='bmailreg';
$__EVENTS['RCBMAILCLICK_DPC'][6]='bmaildel';
$__EVENTS['RCBMAILCLICK_DPC'][7]='bmailrecs';
$__EVENTS['RCBMAILCLICK_DPC'][8]='bmailqueue';
$__EVENTS['RCBMAILCLICK_DPC'][9]='bmailcamp';
$__EVENTS['RCBMAILCLICK_DPC'][10]='bmailview';
$__EVENTS['RCBMAILCLICK_DPC'][11]='bmailfail';
$__EVENTS['RCBMAILCLICK_DPC'][12]='bmailrepl';
$__EVENTS['RCBMAILCLICK_DPC'][13]='bmaillist';

$__ACTIONS['RCBMAILCLICK_DPC'][4]='bmailsent';
$__ACTIONS['RCBMAILCLICK_DPC'][5]='bmailreg';
$__ACTIONS['RCBMAILCLICK_DPC'][6]='bmaildel';
$__ACTIONS['RCBMAILCLICK_DPC'][7]='bmailrecs';
$__ACTIONS['RCBMAILCLICK_DPC'][8]='bmailqueue';
$__ACTIONS['RCBMAILCLICK_DPC'][9]='bmailcamp';
$__ACTIONS['RCBMAILCLICK_DPC'][10]='bmailview';
$__ACTIONS['RCBMAILCLICK_DPC'][11]='bmailfail';
$__ACTIONS['RCBMAILCLICK_DPC'][12]='bmailrepl';
$__ACTIONS['RCBMAILCLICK_DPC'][13]='bmaillist';

$__LOCALE['RCBMAILCLICK_DPC'][0]='RCBMAILCLICK_DPC;Popup;Παράθυρο';
$__LOCALE['RCBMAILCLICK_DPC'][1]='_grid;Grid;Λίστα';
$__LOCALE['RCBMAILCLICK_DPC'][2]='_failed;Failed;Αποτυχίες';
$__LOCALE['RCBMAILCLICK_DPC'][3]='_view;Views;Προβολές';

class rcbmailclick extends jsdialog {

    function __construct() {
		
		jsdialog::__construct();
		
		//override
		$this->dajaxpage = 'cpuliststats.php'; //'jsdialog.php';
    }
	
    public function event($event=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;
		
	    switch ($event) {
			
			case 'bmaillist'      :
			case 'bmailcamp'      :
			case 'bmailrepl'      :
			case 'bmailfail'      :
			case 'bmailview'      :
			case 'bmailqueue'     :
			case 'bmailrecs'      :
			case 'bmailsent'      : 
		    case 'bmailreg'       : 
			case 'bmaildel'       : 
			default               :	//jsdialog::event($event);						  						
        }
    }	

    public function action($action=null)  { 

		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	
		
	    switch ($action) {
			
			case 'bmaillist'      : $datein = $this->sqlDateRange('startdate', false);
									 $out = $this->viewGrid(
											'_grid',
											array('id','startdate','active','gdpr','listname','email','failed','owner'),
											'ulists',
											"SELECT * FROM ulists where active=1 ", /*and $datein",*/
											null,300,12,'r',0
											);
									 break; 
									 
			case 'bmailsent'       : $datein = $this->sqlDateRange('timein', true);
									 $out = $this->viewGrid(
											'_grid',
											array('id','timein','timeout','active','sender','receiver', 'subject', 'reply', 'status', 'mailstatus', 'trackid', 'cid', 'owner'),
											'mailqueue',
											"SELECT * FROM mailqueue where active=0 and $datein",
											null,300,12,'r',0
											); 
									 break; 

			case 'bmailqueue'      : $datein = $this->sqlDateRange('timein', true);
									 $out = $this->viewGrid(
											'_grid',
											array('id','timein','timeout','active','sender','receiver', 'subject', 'reply', 'status', 'mailstatus', 'trackid', 'cid', 'owner'),
											'mailqueue',
											"SELECT * FROM mailqueue where (active=1 or active=-8) and $datein",
											null,300,12,'r',0
											); 
									 break;	
									 
			case 'bmailfail'       : $datein = $this->sqlDateRange('timein', true);
									 $out = $this->viewGrid(
											'_grid',
											array('id','timein','timeout','active','sender','receiver', 'subject', 'reply', 'status', 'mailstatus', 'trackid', 'cid', 'owner'),
											'mailqueue',
											"SELECT * FROM mailqueue where active=0 and (status=-1 or status=-2) and $datein",
											null,300,12,'r',0
											); 
									 break;
									 
			case 'bmailview'       : $datein = $this->sqlDateRange('timein', true);
									 $out = $this->viewGrid(
											'_grid',
											array('id','timein','timeout','active','sender','receiver', 'subject', 'reply', 'status', 'mailstatus', 'trackid', 'cid', 'owner'),
											'mailqueue',
											"SELECT * FROM mailqueue where active=0 and status>0 and $datein",
											null,300,12,'r',0
											); 
									 break;

			case 'bmailrepl'       : $datein = $this->sqlDateRange('timein', true);
									 $out = $this->viewGrid(
											'_grid',
											array('id','timein','timeout','active','sender','receiver', 'subject', 'reply', 'status', 'mailstatus', 'trackid', 'cid', 'owner'),
											'mailqueue',
											"SELECT * FROM mailqueue where active=0 and status>0 and reply>0 and $datein",
											null,300,12,'r',0
											); 
									 break;									 

			case 'bmailcamp'       : $datein = $this->sqlDateRange('timein', true);
									 $out = $this->viewGrid(
											'_grid',
											array('id','cdate','ctype','title','ulists','cc', 'bcc', 'template', 'active', 'owner', 'cid'),
											'mailcamp',
											"SELECT * FROM mailcamp where active=1 and $datein",
											null,300,12,'r',0
											); 
									 break;										 
									 
			case 'bmailreg'        : $datein = $this->sqlDateRange('startdate', false);
									 $out = $this->viewGrid(
											'_grid',
											array('id','startdate','active','gdpr','listname','email','failed','owner'),
											'ulists',
											"SELECT * FROM ulists where active=1 and $datein",
											null,300,12,'r',0
											);
									 break;
									 
			case 'bmaildel'        : $datein = $this->sqlDateRange('datein', true);
									 $out = $this->viewGrid(
											'_grid',
											array('id','datein','active','gdpr','listname','email','failed','owner'),
											'ulists',
											"SELECT * FROM ulists where active=0 and $datein",
											null,300,12,'r',0
											);
									 break;
									 
			case 'bmailrecs'       : $datein = $this->sqlDateRange('datein', true);
									 $out = $this->viewGrid(
											'_grid',
											array('id','datein','startdate','active','gdpr','listname','email','failed','owner'),
											'ulists',
											"SELECT * FROM ulists ",/*where active=1 and $datein",*/
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