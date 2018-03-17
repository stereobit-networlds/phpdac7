<?php

$__DPCSEC['RCSUBSCRIBERS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCSUBSCRIBERS_DPC")) && (seclevel('RCSUBSCRIBERS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCSUBSCRIBERS_DPC",true);

$__DPC['RCSUBSCRIBERS_DPC'] = 'rcsubscribers';

$__EVENTS['RCSUBSCRIBERS_DPC'][0]='cpsubscribers';
$__EVENTS['RCSUBSCRIBERS_DPC'][1]='cpsubsframe';

$__ACTIONS['RCSUBSCRIBERS_DPC'][0]='cpsubscribers';
$__ACTIONS['RCSUBSCRIBERS_DPC'][1]='cpsubsframe';

$__DPCATTR['RCSUBSCRIBERS_DPC']['cpsubscribers'] = 'cpsubscribers,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCSUBSCRIBERS_DPC'][0]='RCSUBSCRIBERS_DPC;Subscribers;Συνδρομητές';
$__LOCALE['RCSUBSCRIBERS_DPC'][1]='_ACTIVE;Active;Ενεργό';
$__LOCALE['RCSUBSCRIBERS_DPC'][2]='_LISTNAME;List;Όνομα λίστας';
$__LOCALE['RCSUBSCRIBERS_DPC'][3]='_ID;Id;Α/Α';
$__LOCALE['RCSUBSCRIBERS_DPC'][4]='_SUBMAIL;e-Mail;e-Mail';
$__LOCALE['RCSUBSCRIBERS_DPC'][5]='_SUBDATE;Insert date;Ημερομηνία εισαγωγής';
$__LOCALE['RCSUBSCRIBERS_DPC'][6]='_SUBΝΑΜΕ;Name;Όνομα';
$__LOCALE['RCSUBSCRIBERS_DPC'][7]='_FAILED;Failed;Αποτυχίες';
$__LOCALE['RCSUBSCRIBERS_DPC'][8]='_INSUPDDATE;Update date;Ημερομηνία μεταβολής';

class rcsubscribers  {

    var $title;
	var $path;

	public function __construct() {
		$GRX = GetGlobal('GRX');
		$this->title = localize('RCSUBSCRIBERS_DPC',getlocal());
		$this->path = paramload('SHELL','prpath'); 
	}

    public function event($event=null) {

		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;

		switch ($event) {
			case 'cpsubsframe'   :   
			case 'cpsubscribers' :
			default              :                    
		}
    }

    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	

		switch ($action) {
			case 'cpsubsframe'  : $out .= $this->show_subscribers(null,200,8,'d', true); break;
			case 'cpsubscribers':
			default             : $out .= $this->show_subscribers(null,null,null,'e', true);
		}

		return ($out);
    }


	protected function show_subscribers($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 600;
        $rows = $rows ? $rows : 25;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'e';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('RCSUBSCRIBERS_DPC',getlocal());		

	    if (defined('MYGRID_DPC')) {
		
			$sSQL = "select * from (";
			$sSQL.= "SELECT id,datein,startdate,active,failed,name,email,listname FROM ulists";
			$sSQL .= ') as o';  		   
			//echo $sSQL;
			_m("mygrid.column use grid1+id|".localize('_ID',getlocal()).'|2|0');
			_m("mygrid.column use grid1+email|".localize('_SUBMAIL',getlocal()).'|10|1');
			_m("mygrid.column use grid1+listname|".localize('_LISTNAME',getlocal()).'|10|1');
			_m("mygrid.column use grid1+startdate|".localize('_SUBDATE',getlocal()).'|8|0');
			_m("mygrid.column use grid1+datein|".localize('_INSUPDDATE',getlocal()).'|8|0');			
			_m("mygrid.column use grid1+name|".localize('_FNAME',getlocal()).'|19|1');	
			_m("mygrid.column use grid1+active|".localize('_ACTIVE',getlocal()).'|boolean|1');	
			_m("mygrid.column use grid1+failed|".localize('_FAILED',getlocal()).'|5|1');	
			//_m("mygrid.column use grid1+listname|".localize('_LISTNAME',getlocal()).'|20|1');		
			$out .= _m("mygrid.grid use grid1+ulists+$sSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width");//+0+1+0");

	    }
		else 
		   $out .= 'Initialize jqgrid.';
		   
        return ($out); 
	}

};
}
?>