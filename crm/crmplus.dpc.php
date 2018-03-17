<?php
$__DPCSEC['CRMPLUS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CRMPLUS_DPC")) && (seclevel('CRMPLUS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CRMPLUS_DPC",true);

$__DPC['CRMPLUS_DPC'] = 'crmplus';

$b = GetGlobal('controller')->require_dpc('crm/crmmodule.dpc.php');
require_once($b);

$__LOCALE['CRMPLUS_DPC'][0]='CRMPLUS_DPC;Plus;Plus';
$__LOCALE['CRMPLUS_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['CRMPLUS_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['CRMPLUS_DPC'][3]='_status;Status;Κατάσταση';
$__LOCALE['CRMPLUS_DPC'][4]='_owner;Owner;Καταχώρητης';
$__LOCALE['CRMPLUS_DPC'][5]='_pid;pid;pid';
$__LOCALE['CRMPLUS_DPC'][6]='_crmplist;List;Λίστα';
$__LOCALE['CRMPLUS_DPC'][7]='_crmpgant;Gantt;Διάγραμμα';
$__LOCALE['CRMPLUS_DPC'][8]='_projects;Projects;Πλάνο';
$__LOCALE['CRMPLUS_DPC'][9]='_since;Since;Απο';
$__LOCALE['CRMPLUS_DPC'][10]='_newproject;New;Νέο';
$__LOCALE['CRMPLUS_DPC'][11]='_title;Title;Τίτλος';
$__LOCALE['CRMPLUS_DPC'][12]='_descr;Description;Περιγραφή';
$__LOCALE['CRMPLUS_DPC'][13]='_cat;Category;Κατηγορία';
$__LOCALE['CRMPLUS_DPC'][14]='_start;Start;Εκκίνηση';
$__LOCALE['CRMPLUS_DPC'][15]='_end;End;Λήξη';
$__LOCALE['CRMPLUS_DPC'][16]='_class;Class;Κλάση';
$__LOCALE['CRMPLUS_DPC'][17]='_resclass;rClass;rΚλάση';
$__LOCALE['CRMPLUS_DPC'][18]='_hideusers;Hide;Hide';
$__LOCALE['CRMPLUS_DPC'][19]='_plan;Plan;Πλάνο';
$__LOCALE['CRMPLUS_DPC'][20]='_reswforward;rForward;rForward';
$__LOCALE['CRMPLUS_DPC'][21]='_include;Include;Συμπεριέλαβε';
$__LOCALE['CRMPLUS_DPC'][22]='_exclude;Exclude;Απέκλεισε';
$__LOCALE['CRMPLUS_DPC'][23]='_invsend;iSend;iSend';
$__LOCALE['CRMPLUS_DPC'][24]='_remsend;rSend;rSend';
$__LOCALE['CRMPLUS_DPC'][25]='_closed;Closed;Έκλεισε';
$__LOCALE['CRMPLUS_DPC'][26]='_private;Private;Ιδιωτικό';
$__LOCALE['CRMPLUS_DPC'][27]='_projects;Projects;Projects';

/*crmplus as module to crm basic */
class crmplus extends crmmodule  {
		
	function __construct() {
	
	  crmmodule::__construct();
	}

	public function plus_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_projects',getlocal()); // .'_'. str_replace('@','AT',$selected_cus); 
	
	    if (defined('MYGRID_DPC')) {
			
			$xsSQL = "SELECT * from (select id,pid,owner,active,date,dateupd,title,descr,code,cat,start,end,class,resclass,type,plan,reswforward,hideusers,private,include,exclude,invsend,remsend,closed from projects where code='$selected') o ";		   
		    //echo $xsSQL;
			_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|||1");	
			//_m("mygrid.column use grid1+timein|".localize('_date',getlocal())."|5|0|");	   
			_m("mygrid.column use grid1+pid|".localize('_pid',getlocal())."|2|1|");
			//_m("mygrid.column use grid1+owner|".localize('_owner',getlocal())."|5|0|");						
			_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|boolean|1|");
			//_m("mygrid.column use grid1+date|".localize('_date',getlocal())."|5|1|");
			//_m("mygrid.column use grid1+dateupd|".localize('_dateupd',getlocal())."|5|1|");
			_m("mygrid.column use grid1+title|".localize('_title',getlocal())."|link|10|"."javascript:showdetails(\"{code}\");".'||');
			_m("mygrid.column use grid1+descr|".localize('_descr',getlocal())."|15|1|");
			_m("mygrid.column use grid1+code|".localize('_code',getlocal())."|10|1||||1|");
			_m("mygrid.column use grid1+cat|".localize('_cat',getlocal())."|5|0|");
			_m("mygrid.column use grid1+start|".localize('_start',getlocal())."|5|1|");			
			_m("mygrid.column use grid1+end|".localize('_end',getlocal())."|5|1|");
			_m("mygrid.column use grid1+class|".localize('_class',getlocal())."|2|1|");
			_m("mygrid.column use grid1+rescalss|".localize('_resclass',getlocal())."|2|1|");
			_m("mygrid.column use grid1+type|".localize('_type',getlocal())."|5|1|");
			_m("mygrid.column use grid1+plan|".localize('_plan',getlocal())."|5|1|");
			//_m("mygrid.column use grid1+reswforward|".localize('_reswforward',getlocal())."|5|1|");
			//_m("mygrid.column use grid1+hideusers|".localize('_hideusers',getlocal())."|boolean|1|");
			//_m("mygrid.column use grid1+private|".localize('_private',getlocal())."|boolean|1|");
			//_m("mygrid.column use grid1+include|".localize('_include',getlocal())."|5|1|");
			//_m("mygrid.column use grid1+exclude|".localize('_exclude',getlocal())."|5|1|");
			_m("mygrid.column use grid1+invsend|".localize('_invsend',getlocal())."|2|1|");
			_m("mygrid.column use grid1+remsend|".localize('_remsend',getlocal())."|2|1|");
			_m("mygrid.column use grid1+closed|".localize('_closed',getlocal())."|boolean|1|");
		   
			$ret .= _m("mygrid.grid use grid1+projects+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	
		
	public function showdetails($data=null) {
		
		//return ("details:" . $data);
		
		//"javascript:$(\"#acal\").load(\"cpcrmplus.php?t=acalajax&projectid={id}&ptitle={title}&id={code}&date={start}\");"

	    $bodyurl = 'cpcrmplus.php?t=cpcrmshowgant&iframe=1&id='.$data; 
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";      

		return ($frame);		
	}	
	
};
}
?>