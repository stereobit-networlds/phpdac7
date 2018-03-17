<?php
$__DPCSEC['CRMSTATS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CRMSTATS_DPC")) && (seclevel('CRMSTATS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CRMSTATS_DPC",true);

$__DPC['CRMSTATS_DPC'] = 'crmstats';

$b = GetGlobal('controller')->require_dpc('crm/crmmodule.dpc.php');
require_once($b);

$__EVENTS['CRMSTATS_DPC'][0]='crmstats';
$__EVENTS['CRMSTATS_DPC'][1]='crmstatsbyip';

$__ACTIONS['CRMSTATS_DPC'][0]='crmstats';
$__ACTIONS['CRMSTATS_DPC'][1]='crmstatsbyip';

$__LOCALE['CRMSTATS_DPC'][0]='CRMSTATS_DPC;Statistics;Στατιστικά';
$__LOCALE['CRMSTATS_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['CRMSTATS_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['CRMSTATS_DPC'][3]='_attr;Attr;Attr';
$__LOCALE['CRMSTATS_DPC'][4]='_tid;tID;tID';
$__LOCALE['CRMSTATS_DPC'][5]='_ip;Ip;Ip';


class crmstats extends crmmodule  {
		
	function __construct() {
	
	  crmmodule::__construct();
	}
	
    function event($event=null) {
	
	   $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   if ($login!='yes') return null;		 
	
	   switch ($event) {
		   	
		 case 'crmstatsbyip' : //echo $this->ipstats_grid(null,340,14,'r',true);
		                       //die();
							   break; 	   
	     case 'crmstats'     :
		 default             :    
		                      
	   }
			
    }   
	
    function action($action=null) {
		
	  $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	  if ($login!='yes') return null;	
	 
	  switch ($action) {	  
								
		 case 'crmstatsbyip': $out = $this->ipstats_grid(null,340,14,'r',true);
							  break;					  
	     case 'crmstats'    :
		 default            : $out = null;
	  }	 

	  return ($out);
    }	

	public function stats_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('CRMSTATS_DPC',getlocal()); // .'_'. str_replace('@','AT',$selected_cus); 
	
	    if (defined('MYGRID_DPC')) {
			
	        $xSQL2 = "select * from (select id,date,tid,attr1,attr2,attr3,REMOTE_ADDR from stats where attr2='$selected' OR attr3='$selected') as o";  				
		   		   
		    //echo $sSQL2;

		    _m("mygrid.column use grid9+id|".localize('_id',getlocal())."|2|1|");
			_m("mygrid.column use grid9+date|".localize('_date',getlocal()).'|5|0|');				
            _m("mygrid.column use grid9+tid|".localize('_tid',getlocal()).'|5|0|'); //."|link|5|"."javascript:showdetails(\"{tid}\");".'||');
            _m("mygrid.column use grid9+attr1|".localize('_attr',getlocal()).'|30|0|');//."|link|5|"."javascript:showdetails(\"{attr1}\");".'||');			
			//_m("mygrid.column use grid9+attr2|".localize('_attr',getlocal()).'|10|0|');
			//_m("mygrid.column use grid9+attr3|".localize('_attr',getlocal()).'|10|0|');
			_m("mygrid.column use grid9+REMOTE_ADDR|".localize('_ip',getlocal())."|link|10|"."javascript:showdetails(\"{REMOTE_ADDR}\");".'||');
			
			$ret .= _m("mygrid.grid use grid9+stats+$xSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	
	
	protected function ipstats_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));

	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('CRMSTATS_DPC',getlocal()); // .'_'. str_replace('@','AT',$selected_cus); 
	
	    if (defined('MYGRID_DPC')) {
			
	        $xSQL2 = "select * from (select id,date,tid,attr1,attr2,attr3,REMOTE_ADDR from stats where attr2='$selected' OR attr3='$selected') as o";  				
		   		   
		    //echo $sSQL2;

		    _m("mygrid.column use grid9+id|".localize('_id',getlocal())."|2|1|");
			_m("mygrid.column use grid9+date|".localize('_date',getlocal()).'|5|0|');				
            _m("mygrid.column use grid9+tid|".localize('_tid',getlocal()).'|5|0|'); 
            _m("mygrid.column use grid9+attr1|".localize('_attr',getlocal()).'|30|0|');	
			//_m("mygrid.column use grid9+attr2|".localize('_attr',getlocal()).'|10|0|');
			//_m("mygrid.column use grid9+attr3|".localize('_attr',getlocal()).'|10|0|');			
			_m("mygrid.column use grid9+REMOTE_ADDR|".localize('_ip',getlocal())."|10|0|");
			
			$ret .= _m("mygrid.grid use grid9+stats+$xSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	
	
	public function ipstats() {
		$out = $this->ipstats_grid(null,250,10,'r',true);
		return ($out);
	}
		
	public function showdetails($data=null) {
		
		//return ("details:" . $data);
		$bodyurl = 'cpcrm.php?t=cpcrmrun&mod=crmstats.ipstats&id='.$data; 
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";      

		return ($frame);		
	}	
	
};
}
?>