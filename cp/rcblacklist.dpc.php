<?php
$__DPCSEC['RCBLACKLIST_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCBLACKLIST_DPC")) && (seclevel('RCBLACKLIST_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCBLACKLIST_DPC",true);

$__DPC['RCBLACKLIST_DPC'] = 'rcblacklist';
 
$__EVENTS['RCBLACKLIST_DPC'][0]='cpblacklist';
$__EVENTS['RCBLACKLIST_DPC'][1]='cpblactivity';
$__EVENTS['RCBLACKLIST_DPC'][2]='cpblhistory';

$__ACTIONS['RCBLACKLIST_DPC'][0]='cpblacklist';
$__ACTIONS['RCBLACKLIST_DPC'][1]='cpblactivity';
$__ACTIONS['RCBLACKLIST_DPC'][2]='cpblhistory';

//$__DPCATTR['RCBLACKLIST_DPC']['cpblacklist'] = 'cpblacklist,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCBLACKLIST_DPC'][0]='RCBLACKLIST_DPC;Blacklist;Εξαιρέσεις';
$__LOCALE['RCBLACKLIST_DPC'][1]='_HTTP_X_FORWARDED_FOR;Ip (f);Ip (f)';
$__LOCALE['RCBLACKLIST_DPC'][2]='_REMOTE_ADDR;Ip;Ip';
$__LOCALE['RCBLACKLIST_DPC'][3]='_status;Active;Ενεργό';
$__LOCALE['RCBLACKLIST_DPC'][4]='_timein;Date;Ημερομηνία';
$__LOCALE['RCBLACKLIST_DPC'][5]='_id;ID;ID';
$__LOCALE['RCBLACKLIST_DPC'][6]='_activity;Activity;Δραστηριότητα';
$__LOCALE['RCBLACKLIST_DPC'][7]='_tid;Action 1;Τύπος 1';
$__LOCALE['RCBLACKLIST_DPC'][8]='_attr1;Action 2;Τύπος 2';
$__LOCALE['RCBLACKLIST_DPC'][9]='_attr3;Action 3;Τύπος 3';
$__LOCALE['RCBLACKLIST_DPC'][10]='_ref;Ref;Ref';

class rcblacklist  {

    var $title, $path;
	var $seclevid, $userDemoIds;
		
	function __construct() {
	
	  $this->path = paramload('SHELL','prpath');
	  $this->title = localize('RCBLACKLIST_DPC',getlocal());	 
	  
	  $this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
	  $this->userDemoIds = array(5,6,7); //8 
	  //echo $this->seclevid;  
	}
	
    function event($event=null) {
	
	   $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   if ($login!='yes') return null;		 
	
	   switch ($event) {
							 
		 case 'cpblhistory' : //die('test-first-level');
		                       break;
		 case 'cpblactivity' : echo $this->loadframe();
		                       die();
							   break; 	   
	     case 'cpblacklist'  :
		 default             :    
		                      
	   }
			
    }   
	
    function action($action=null) {
		
	  $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	  if ($login!='yes') return null;	
	 
	  switch ($action) {
													  
		 case 'cpblhistory' : $out = $this->activity_grid(null,340,14,'r', true);	 
							  break; 
		 case 'cpblactivity': 
							  break;					  
	     case 'cpblacklist' :
		 default            : $out = $this->blacklist_grid(null,140,14,'d', true);	
							  $out .= "<div id='blactivity'></div>";
	  }	 

	  return ($out);
    }
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}		

	protected function loadframe($ajaxdiv=null) {
		$ip = GetReq('ip');
		$bodyurl = seturl("t=cpblhistory&iframe=1&ip=$ip");
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"460px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}		
	
	protected function blacklist_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('RCBLACKLIST_DPC',getlocal()); 

        $myfields = "id,timein,status,REMOTE_ADDR,HTTP_X_FORWARDED_FOR";  		

		$xsSQL = 'select * from (select '.$myfields . ' from blacklistip) as o';
		//echo $xsSQL ;
		_m("mygrid.column use grid1+id|".localize('_id',getlocal())."|link|5|"."javascript:blactivity(\"{REMOTE_ADDR}\");".'||');	  //."|1|0");	
		_m("mygrid.column use grid1+status|".localize('_status',getlocal()).'|boolean|1');			
		_m("mygrid.column use grid1+timein|".localize('_timein',getlocal())."|5|0|");			
		_m("mygrid.column use grid1+REMOTE_ADDR|".localize('_REMOTE_ADDR',getlocal())."|5|1|");//."|link|5|"."javascript:blactivity(\"{REMOTE_ADDR}\");".'||');	 
		_m("mygrid.column use grid1+HTTP_X_FORWARDED_FOR|".localize('_HTTP_X_FORWARDED_FOR',getlocal())."|5|0|");			
	
		$out = _m("mygrid.grid use grid1+blacklistip+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width");
		
		return ($out);  	
	}		
	
	
    protected function activity_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
		$ip = GetReq('ip');
	    $height = $height ? $height : 440;
        $rows = $rows ? $rows : 18;
        $width = $width ? $width : null; //wide
        $mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;					
        $lan = getlocal() ? getlocal() : 0;
		$title = localize('_activity', $lan);	

	    $sSQL = "select * from (select id,date,tid,attr1,attr3,ref,REMOTE_ADDR,HTTP_X_FORWARDED_FOR from stats where REMOTE_ADDR='$ip'";
        $sSQL.= ') as o';  				
		   		   
		//echo $sSQL;

		_m("mygrid.column use grid2+id|".localize('_id',getlocal())."|5|0|");
		_m("mygrid.column use grid2+date|".localize('_timein',getlocal()).'|5|0');				
        _m("mygrid.column use grid2+tid|".localize('_tid',getlocal()).'|10|0');
        _m("mygrid.column use grid2+attr1|".localize('_attr1',getlocal()).'|19|0');			
        _m("mygrid.column use grid2+attr3|".localize('_attr3',getlocal()).'|10|0');
        _m("mygrid.column use grid2+ref|".localize('_ref',getlocal()).'|10|0');		
		_m("mygrid.column use grid2+REMOTE_ADDR|".localize('_REMOTE_ADDR',getlocal()).'|5|0');	 
		_m("mygrid.column use grid2+HTTP_X_FORWARDED_FOR|".localize('_HTTP_X_FORWARDED_FOR',getlocal())."|5|0|");			

		$out .= _m("mygrid.grid use grid2+stats+$sSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
	    return ($out);
	
    }				
	
};
}
?>