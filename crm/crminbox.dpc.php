<?php
$__DPCSEC['CRMINBOX_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CRMINBOX_DPC")) && (seclevel('CRMINBOX_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CRMINBOX_DPC",true);

$__DPC['CRMINBOX_DPC'] = 'crminbox';

$b = GetGlobal('controller')->require_dpc('crm/crmmodule.dpc.php');
require_once($b);

$__LOCALE['CRMINBOX_DPC'][0]='CRMINBOX_DPC;Inbox;Εισερχόμενα';
$__LOCALE['CRMINBOX_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['CRMINBOX_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['CRMINBOX_DPC'][3]='_status;Status;Κατάσταση';
$__LOCALE['CRMINBOX_DPC'][4]='_user;User;Πελάτης';
$__LOCALE['CRMINBOX_DPC'][5]='_cid;cid;cid';
$__LOCALE['CRMINBOX_DPC'][6]='_subject;Subject;Θέμα';


class crminbox extends crmmodule  {
		
	function __construct() {
	
	  crmmodule::__construct();
	}

	public function inbox_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('CRMINBOX_DPC',getlocal()); // .'_'. str_replace('@','AT',$selected_cus); 
	
	    if (defined('MYGRID_DPC')) {
			
			$xSQL2 = "select id,date,email,subject from cform where email='$selected'";	
		
			_m("mygrid.column use grid1+id|".localize('_id',getlocal())."|2|0");
			_m("mygrid.column use grid1+date|".localize('_date',getlocal())."|5|1|");
			_m("mygrid.column use grid1+email|".localize('_email',getlocal())."|5|0|");
			_m("mygrid.column use grid1+subject|".localize('_subject',getlocal())."|link|10|"."javascript:showdetails({id});".'||');
			
			$ret .= _m("mygrid.grid use grid1+cform+$xSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	
		
	public function showdetails($data=null) {
		
		//return ("details:" . $data);
		
	    $bodyurl = 'cpform.php?t=cpviewsubmitedform&id='.$data; 
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";      

		return ($frame);		
	}	
	
};
}
?>