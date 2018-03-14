<?php

$__DPCSEC['RCFORM_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCFORM_DPC")) && (seclevel('RCFORM_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCFORM_DPC",true);

$__DPC['RCFORM_DPC'] = 'rcform';

$b = GetGlobal('controller')->require_dpc('cms/cmsform.dpc.php');
require_once($b);


$__EVENTS['RCFORM_DPC'][0]='cpform';
$__EVENTS['RCFORM_DPC'][1]='searchtopic';
$__EVENTS['RCFORM_DPC'][2]='cpviewframe';
$__EVENTS['RCFORM_DPC'][3]='cpviewsubmitedform';

$__ACTIONS['RCFORM_DPC'][0]='cpform';
$__ACTIONS['RCFORM_DPC'][1]='searchtopic';
$__ACTIONS['RCFORM_DPC'][2]='cpviewframe';
$__ACTIONS['RCFORM_DPC'][3]='cpviewsubmitedform';

$__DPCATTR['RCFORM_DPC']['cpform'] = 'cpform,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCFORM_DPC'][0]='RCFORM_DPC;Inbox;Εισερχόμενα';
$__LOCALE['RCFORM_DPC'][1]='_id;Id;Id';
$__LOCALE['RCFORM_DPC'][2]='_date;Date;Ημ/νία';
$__LOCALE['RCFORM_DPC'][3]='_email;e-mail;e-mail';
$__LOCALE['RCFORM_DPC'][4]='_forms;Inbox;Εισερχόμενα';
$__LOCALE['RCFORM_DPC'][5]='_subject;Subject;Θέμα';

class rcform extends cmsform {

    var $title;


	function rcform() {
	
	  cmsform::__construct();
	
	  $GRX = GetGlobal('GRX');
	  $this->title = localize('CMSFORM_DPC',getlocal());
	  $this->path = paramload('SHELL','prpath');	  
	}

    function event($event=null) {

	   $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   if ($login!='yes') return null;

	   switch ($event) {
	     case 'cpviewsubmitedform' : echo $this->view_submited_form(); 
		                             die(); 
									 break;
		 case 'cpviewframe' :  echo $this->loadframe('vform');
							   die();
		                       break;					 
	     case 'cpform'      : 
		 default            :   
	   }

    }

    function action($action=null) {
		
	   $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   if ($login!='yes') return null;

	   switch ($action) {
	   			 
		 default            : $out .= $this->viewForms();	
	   }

	   return ($out);
    }

	
	protected function viewForms() {
       $db = GetGlobal('db');
	   $a = GetReq('a');
       $UserName = GetGlobal('UserName');

	   if (!defined('MYGRID_DPC')) return "Load JQGRID";

	   $out = 	$this->viewGrid();	 
		 	 					
	   return ($out);	
	
	}		
	
	protected function view_submited_form() {
	    $db = GetGlobal('db');
		$id = GetReq('id');
		
		$sSQL = 'select postform from cform where id='.$id;
		$ret = $db->Execute($sSQL,2);

        return ($ret->fields[0]);		
	}
	
	protected function loadframe($ajaxdiv=null) {
		$id = GetReq('id');

		$vurl = seturl('t=cpviewsubmitedform&id='.$id);
		$frame = "<iframe src =\"$vurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv.'|'.$frame;
		else
			return ($frame);
	}	
	
    protected function getFormsList($width=null, $height=null, $rows=null, $editlink=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide
        $mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;
        $editlink = $editlink ? $editlink : null;//seturl("t=cpeditcat&editmode=1&cat={cat2}");
							 
		$xsSQL = 'select id,date,email,subject from cform';	
		
        _m("mygrid.column use grid1+id|".localize('_id',getlocal())."|5");
        _m("mygrid.column use grid1+date|".localize('_date',getlocal())."|10");
		if ($editlink)
			_m("mygrid.column use grid1+email|".localize('_email',getlocal())."|link|10|".$editlink);		
		else
			_m("mygrid.column use grid1+email|".localize('_email',getlocal())."|10");
			
		_m("mygrid.column use grid1+subject|".localize('_subject',getlocal())."|15");	
			
		$out .= _m("mygrid.grid use grid1+cform+$xsSQL+$mode+".localize('_forms',getlocal())."+id+$noctrl+1+$rows+$height+$width+0+1+1");
	    return ($out);
    }
	
	protected function viewGrid() {
	   $id = 'id';
	   $editlink = "javascript:viewform({".$id."})";
	   
	   $ret = $this->getFormsList(null,240,20, $editlink, 'r', true);
	   $init_content = null; 
	   $ret .= "<div id='vform'>$init_content</div>";    	   

	   return ($ret);			  
	   
	}	
};
}
?>