<?php
$__DPCSEC['CRMREPORTS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CRMREPORTS_DPC")) && (seclevel('CRMREPORTS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CRMREPORTS_DPC",true);

$__DPC['CRMREPORTS_DPC'] = 'crmreports';

$b = GetGlobal('controller')->require_dpc('crm/crmmodule.dpc.php');
require_once($b);

$__LOCALE['CRMREPORTS_DPC'][0]='CRMREPORTS_DPC;Reports;Αναφορές';
$__LOCALE['CRMREPORTS_DPC'][1]='_ID;Id;Α/Α';
$__LOCALE['CRMREPORTS_DPC'][2]='_DATE;Date;Ημερομηνία';
$__LOCALE['CRMREPORTS_DPC'][3]='_ΝΑΜΕ;Name;Όνομα';
$__LOCALE['CRMREPORTS_DPC'][4]='_TYPE;Type;Τύπος';
$__LOCALE['CRMREPORTS_DPC'][5]='_description;Description;Περιγραφή';
$__LOCALE['CRMREPORTS_DPC'][6]='_title;Title;Τίτλος';


class crmreports extends crmmodule  {
		
	function __construct() {
	
	  crmmodule::__construct();
	}

	public function reports_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('CRMREPORTS_DPC',getlocal());  
	
	    if (defined('MYGRID_DPC')) {
			
			$sSQL = "select * from (select id,timein,title,description,rgroup from reports where rgroup='crm') as o"; 		   

			_m("mygrid.column use grid1+id|".localize('_ID',getlocal())."|2|0");	
			_m("mygrid.column use grid1+timein|".localize('_DATE',getlocal())."|2|0|");			
			_m("mygrid.column use grid1+title|".localize('_title',getlocal())."|link|5|javascript:showdetails(\"{id}~$selected\");".'||'); 
			_m("mygrid.column use grid1+description|".localize('_description',getlocal())."|10|0|");
			_m("mygrid.column use grid1+rgroup|".localize('_TYPE',getlocal()).'|5|0');		
			//_m("mygrid.column use grid1+scode|".localize('_code',getlocal()).'|20|0');			
			
			$ret .= _m("mygrid.grid use grid1+reports+$sSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	

	public function showdetails($data=null) {
		
		//$bodyurl = 'cpreports.php?t=cprepshow&iframe=1&&id='.$data; 
		$bodyurl = 'cpreports.php?t=cprepcrm&&id='.$data;
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";      

		return ($frame);		
	}	
	
};
}
?>