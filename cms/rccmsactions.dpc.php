<?php

$__DPCSEC['RCCMSACTIONS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCCMSACTIONS_DPC")) && (seclevel('RCCMSACTIONS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCCMSACTIONS_DPC",true);

$__DPC['RCCMSACTIONS_DPC'] = 'rccmsactions';

$a = GetGlobal('controller')->require_dpc('cms/cmsplus.dpc.php');
require_once($a);

$__EVENTS['RCCMSACTIONS_DPC'][0]='cpcmsactions';
$__EVENTS['RCCMSACTIONS_DPC'][1]='cpcmsframe';

$__ACTIONS['RCCMSACTIONS_DPC'][0]='cpcmsactions';
$__ACTIONS['RCCMSACTIONS_DPC'][1]='cpcmsframe';

$__DPCATTR['RCCMSACTIONS_DPC']['cpcmsactions'] = 'cpcmsactions,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCCMSACTIONS_DPC'][0]='RCCMSACTIONS_DPC;Actions;Δράσεις';
$__LOCALE['RCCMSACTIONS_DPC'][1]='_ACTIVE;Active;Ενεργό';
$__LOCALE['RCCMSACTIONS_DPC'][2]='_LISTNAME;List;Όνομα λίστας';
$__LOCALE['RCCMSACTIONS_DPC'][3]='_ID;Id;Α/Α';
$__LOCALE['RCCMSACTIONS_DPC'][4]='_MAIL;e-Mail;e-Mail';
$__LOCALE['RCCMSACTIONS_DPC'][5]='_DATE;Insert date;Ημερομηνία εισαγωγής';
$__LOCALE['RCCMSACTIONS_DPC'][6]='_ΝΑΜΕ;Name;Όνομα';
$__LOCALE['RCCMSACTIONS_DPC'][7]='_TYPE;Type;Τύπος';
$__LOCALE['RCCMSACTIONS_DPC'][8]='_ip;Ip;Ip';
$__LOCALE['RCCMSACTIONS_DPC'][9]='_agent;Agent;Agent';

class rccmsactions extends cmsplus  {

	public function __construct() {
		
		cmsplus::__construct();
	}

    public function event($event=null) {

		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;

		switch ($event) {
			case 'cpcmsframe'    :   
			case 'cpcmsactions'  :
			default              :                    
		}
    }

    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	

		switch ($action) {
			case 'cpcmsframe'   : $out = $this->add_event(); break;
			case 'cpcmsactions' :
			default             : //$out .= "<div id='cmsaction'></div>";
			                      $out .= $this->show_actions(null,null,null,'e', true);
		}

		return ($out);
    }


	protected function show_actions($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 600;
        $rows = $rows ? $rows : 25;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'r';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('RCCMSACTIONS_DPC',getlocal());		

	    if (defined('MYGRID_DPC')) {
		
			$sSQL = "select * from (";
			$sSQL.= "SELECT id,date,tid,attr1,attr3,REMOTE_ADDR,HTTP_X_FORWARDED_FOR,HTTP_USER_AGENT from stats where tid='action'";
			$sSQL .= ') as o';  		   
			//echo $sSQL;
			_m("mygrid.column use grid1+id|".localize('_ID',getlocal()).'|5|0');
			_m("mygrid.column use grid1+date|".localize('_DATE',getlocal()).'|5|0');		   
			_m("mygrid.column use grid1+attr1|".localize('_TYPE',getlocal()).'|5|0');	
			_m("mygrid.column use grid1+attr3|".localize('_MAIL',getlocal()).'|10|0');	
			_m("mygrid.column use grid1+REMOTE_ADDR|".localize('_ip',getlocal()).'|5|1');	
			_m("mygrid.column use grid1+HTTP_X_FORWARDED_FOR|".localize('_ip',getlocal()).'|5|1');		
			_m("mygrid.column use grid1+HTTP_USER_AGENT|".localize('_agent',getlocal()).'|10|1');
			$out .= _m("mygrid.grid use grid1+stats+$sSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $out .= 'Initialize jqgrid.';
		   
        return ($out); 
	}
	
	protected function add_event() {
		
	}

};
}
?>