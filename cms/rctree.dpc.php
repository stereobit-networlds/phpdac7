<?php
$__DPCSEC['RCTREE_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCTREE_DPC")) && (seclevel('RCTREE_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCTREE_DPC",true);

$__DPC['RCTREE_DPC'] = 'rctree';
 
$__EVENTS['RCTREE_DPC'][0]='cptree';
$__EVENTS['RCTREE_DPC'][1]='cptreerel';
$__EVENTS['RCTREE_DPC'][2]='cptreeleaf';

$__ACTIONS['RCTREE_DPC'][0]='cptree';
$__ACTIONS['RCTREE_DPC'][1]='cptreerel';
$__ACTIONS['RCTREE_DPC'][2]='cptreeleaf';

$__LOCALE['RCTREE_DPC'][0]='RCTREE_DPC;Tree;Δέντρο';
$__LOCALE['RCTREE_DPC'][1]='_leaf;Childs;Παιδιά';
$__LOCALE['RCTREE_DPC'][2]='_rel;Relation;Σχέση';
$__LOCALE['RCTREE_DPC'][3]='_active;Active;Ενεργό';
$__LOCALE['RCTREE_DPC'][4]='_timein;Date;Ημερομηνία';
$__LOCALE['RCTREE_DPC'][5]='_id;ID;ID';
$__LOCALE['RCTREE_DPC'][6]='_title;Title;Τίτλος';
$__LOCALE['RCTREE_DPC'][7]='_descr;Description;Περιγραφή';
$__LOCALE['RCTREE_DPC'][8]='_code;Code;Κωδικός';
$__LOCALE['RCTREE_DPC'][9]='_parent;Parent;Σχέση';
$__LOCALE['RCTREE_DPC'][10]='_orderid;Order;Σειρά';
$__LOCALE['RCTREE_DPC'][11]='_title0;Title L1;Τίτλος L1';
$__LOCALE['RCTREE_DPC'][12]='_title1;Title L2;Τίτλος L2';
$__LOCALE['RCTREE_DPC'][13]='_title2;Title L3;Τίτλος L3';

class rctree  {

    var $title, $path;
	var $seclevid, $userDemoIds;
		
	function __construct() {
	
	  $this->path = paramload('SHELL','prpath');
	  $this->title = localize('RCTREE_DPC',getlocal());	 
	  
	  $this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
	  $this->userDemoIds = array(5,6,7); //8 
	  //echo $this->seclevid;  
	}
	
    function event($event=null) {
	
	   $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   if ($login!='yes') return null;		 
	
	   switch ($event) {
							 
		 case 'cptreeleaf'   : //die('test-first-level');
		                       break;
		 case 'cptreerel'    : echo $this->loadframe();
		                       die();
							   break; 	   
	     case 'cptree'       :
		 default             :    
		                      
	   }
			
    }   
	
    function action($action=null) {
		
	  $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	  if ($login!='yes') return null;	
	 
	  switch ($action) {
													  
		 case 'cptreeleaf'  : $edit = $this->isDemoUser() ? 'r' : 'd';
		                      $out = $this->childs_grid(null,340,14,$edit, true);	 
							  break; 
		 case 'cptreerel'   : 
							  break;					  
	     case 'cptree'      :
		 default            : $edit = $this->isDemoUser() ? 'r' : 'd';
		                      $out .= $this->tree_grid(null,140,5,$edit, true);	
							  
	  }	 

	  return ($out);
    }
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}		

	protected function loadframe($ajaxdiv=null) {
		$parent = GetReq('id');
		$bodyurl = seturl("t=cptreeleaf&iframe=1&id=$parent");
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"460px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}		
	
	protected function tree_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('RCTREE_DPC',getlocal()); //localize('_items', $lan);	

        $xsSQL = "SELECT * from (select id,timein,active,tid,pid,tname,tdescr,tname0,tname1,tname2,items,users,orderid from ctree) o ";		   
					
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+id|".localize('id',getlocal())."|5|0|");//."|link|2|"."javascript:treerel(\"{tid}\");".'||');		
		//GetGlobal('controller')->calldpc_method("mygrid.column use grid1+itmactive|".localize('_active',getlocal())."|2|0|");//"|boolean|1|1:0");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+active|".localize('_active',getlocal())."|boolean|1|1:0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+timein|".localize('_date',getlocal())."|link|8|"."javascript:treerel(\"{tid}\");".'||');;//."|5|0|");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tid|".localize('_code',getlocal())."|5|1|");	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+pid|".localize('_parent',getlocal())."|5|1|");			
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tname|".localize('_title',getlocal())."|5|1|");	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tdescr|".localize('_descr',getlocal())."|5|1|");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tname0|".localize('_title0',getlocal())."|5|1|");			
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tname1|".localize('_title1',getlocal())."|5|1|");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tname2|".localize('_title2',getlocal())."|5|1|");			
		//GetGlobal('controller')->calldpc_method("mygrid.column use grid1+manufacturer|".localize('_manufacturer',getlocal())."|5|0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+items|".localize('_items',getlocal())."|boolean|1|1:0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+users|".localize('_users',getlocal())."|boolean|1|1:0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+orderid|".localize('_orderid',getlocal())."|2|1|");

		$out = GetGlobal('controller')->calldpc_method("mygrid.grid use grid1+ctree+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}		
	
	
    protected function childs_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
		$pid = GetReq('id');
	    $height = $height ? $height : 440;
        $rows = $rows ? $rows : 18;
        $width = $width ? $width : null; //wide
        $mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;					
        $lan = getlocal() ? getlocal() : 0;
		$title = localize('_leaf', $lan);	

        $xsSQL = "SELECT * from (select id,timein,active,tid,pid,tname,tdescr,tname0,tname1,tname2,items,users,orderid from ctree WHERE pid='$pid') o ";		   
					
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|");		
		//GetGlobal('controller')->calldpc_method("mygrid.column use grid1+itmactive|".localize('_active',getlocal())."|2|0|");//"|boolean|1|1:0");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+active|".localize('_active',getlocal())."|boolean|1|1:0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+timein|".localize('_date',getlocal())."|5|0|");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tid|".localize('_code',getlocal())."|5|1|");	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+pid|".localize('_parent',getlocal())."|5|1|");			
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tname|".localize('_title',getlocal())."|5|1|");	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tdescr|".localize('_descr',getlocal())."|5|1|");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tname0|".localize('_title0',getlocal())."|5|1|");			
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tname1|".localize('_title1',getlocal())."|5|1|");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tname2|".localize('_title2',getlocal())."|5|1|");			
		//GetGlobal('controller')->calldpc_method("mygrid.column use grid1+manufacturer|".localize('_manufacturer',getlocal())."|5|0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+items|".localize('_items',getlocal())."|boolean|1|1:0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+users|".localize('_users',getlocal())."|boolean|1|1:0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+orderid|".localize('_orderid',getlocal())."|2|1|");

		$out = GetGlobal('controller')->calldpc_method("mygrid.grid use grid1+ctree+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  
	
    }				
	
};
}
?>