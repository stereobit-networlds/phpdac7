<?php
$__DPCSEC['CRMOUTBOX_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CRMOUTBOX_DPC")) && (seclevel('CRMOUTBOX_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CRMOUTBOX_DPC",true);

$__DPC['CRMOUTBOX_DPC'] = 'crmoutbox';

$b = GetGlobal('controller')->require_dpc('crm/crmmodule.dpc.php');
require_once($b);

$__LOCALE['CRMOUTBOX_DPC'][0]='CRMOUTBOX_DPC;Outbox;Εξερχόμενα';
$__LOCALE['CRMOUTBOX_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['CRMOUTBOX_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['CRMOUTBOX_DPC'][3]='_status;Status;Κατάσταση';
$__LOCALE['CRMOUTBOX_DPC'][4]='_user;User;Πελάτης';
$__LOCALE['CRMOUTBOX_DPC'][5]='_cid;cid;cid';
$__LOCALE['CRMOUTBOX_DPC'][5]='_clicks;Clickpath;Clickpath';


class crmoutbox extends crmmodule  {
		
	function __construct() {
	
	  crmmodule::__construct();
	}

	public function outbox_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('CRMOUTBOX_DPC',getlocal()); 
	
	    if (defined('MYGRID_DPC')) {
			
            $xSQL2 = "SELECT * from (select id,timein,timeout,receiver,subject,reply,status,mailstatus,cid from mailqueue where receiver='$selected') o ";
				//and (origin='crm' or origin='cart' or origin='users' or origin='customers')
			//echo $xSQL2;
			_m("mygrid.column use grid3+id|".localize('_id',getlocal())."|5|0|");
			//_m("mygrid.column use grid3+timein|".localize('_date',getlocal())."|5|1|");//"|link|5|"."javascript:showdetails({id});".'||');
			_m("mygrid.column use grid3+receiver|".localize('_user',getlocal())."|10|1||||1|");			
			_m("mygrid.column use grid3+timeout|".localize('_date',getlocal())."|5|1|");//"|link|5|"."javascript:showdetails(\"{receiver}\");".'||');						
			_m("mygrid.column use grid3+subject|".localize('_subject',getlocal())."|link|19|"."javascript:showdetails({id});".'||');//."|19|0|");
		    _m("mygrid.column use grid3+reply|".localize('_reply',getlocal())."|2|0|");	
			_m("mygrid.column use grid3+status|".localize('_status',getlocal())."|2|0|||||right");	
		    _m("mygrid.column use grid3+mailstatus|".localize('_failed',getlocal())."|2|1|");			
		    _m("mygrid.column use grid3+cid|".localize('_cid',getlocal())."|link|10|"."javascript:showdetails(\"{cid}\");".'||');
			
			$ret .= _m("mygrid.grid use grid3+mailqueue+$xSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	
	
	protected function allclicks_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = GetReq('id');
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_clicks',getlocal()); 
	
	    if (defined('MYGRID_DPC')) {
			
	        $xSQL2 = "select * from (select id,date,tid,attr1,attr2,attr3,ref,REMOTE_ADDR from stats where ref='$selected') as o";  				
		   	//echo $xSQL2;	   			
		    _m("mygrid.column use grid9+id|".localize('_id',getlocal())."|2|1|");
			_m("mygrid.column use grid9+date|".localize('_date',getlocal()).'|10|0|');				
            _m("mygrid.column use grid9+tid|".localize('_tid',getlocal()).'|5|0|'); 
            _m("mygrid.column use grid9+attr1|".localize('_attr',getlocal()).'|19|0|');
            _m("mygrid.column use grid9+attr2|".localize('_attr',getlocal()).'|10|0|');
            _m("mygrid.column use grid9+attr3|".localize('_attr',getlocal()).'|10|0|');			
            _m("mygrid.column use grid9+ref|".localize('_cid',getlocal()).'|10|0|');			
			_m("mygrid.column use grid9+REMOTE_ADDR|".localize('_ip',getlocal())."5|0|");//"|link|10|"."javascript:showdetails(\"{REMOTE_ADDR}\");".'||');
			
			$ret .= _m("mygrid.grid use grid9+stats+$xSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}
	
	public function alltaskclicks() {
		$out = $this->allclicks_grid(null,250,10,'r',true);
		return ($out);
	}		

	protected function clicks_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = GetReq('id');
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_clicks',getlocal()); 
	
	    if (defined('MYGRID_DPC')) {
			
	        $xSQL2 = "select * from (select id,date,tid,attr1,attr2,attr3,ref,REMOTE_ADDR from stats where attr3='$selected') as o";  				
		   	//echo $xSQL2;	   			
		    _m("mygrid.column use grid9+id|".localize('_id',getlocal())."|2|1|");
			_m("mygrid.column use grid9+date|".localize('_date',getlocal()).'|10|0|');				
            _m("mygrid.column use grid9+tid|".localize('_tid',getlocal()).'|5|0|'); 
            _m("mygrid.column use grid9+attr1|".localize('_attr',getlocal()).'|19|0|');
            _m("mygrid.column use grid9+attr2|".localize('_attr',getlocal()).'|10|0|');
            _m("mygrid.column use grid9+attr3|".localize('_attr',getlocal()).'|10|0|');			
            _m("mygrid.column use grid9+ref|".localize('_cid',getlocal()).'|10|0|');			
			_m("mygrid.column use grid9+REMOTE_ADDR|".localize('_ip',getlocal())."5|0|");//"|link|10|"."javascript:showdetails(\"{REMOTE_ADDR}\");".'||');
			
			$ret .= _m("mygrid.grid use grid9+stats+$xSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}		
		
	public function taskclicks() {
		$out = $this->clicks_grid(null,250,10,'r',true);
		return ($out);
	}	


    protected function _checkmail($data) {

		if( !eregi("^[a-z0-9]+([_\\.-][a-z0-9]+)*" . "@([a-z0-9]+([\.-][a-z0-9]{1,})+)*$", $data, $regs) )  
			return false;

		return true;  
	}	
		
	public function showdetails($data=null) {
		
		//return ("details:" . $data);
		if (is_numeric($data)) //id for content preview
			$bodyurl = 'cpulists.php?t=cpmailbodyshow&id='.$data; 
		//elseif ($this->_checkmail($data)) //email for attr3
			//$bodyurl = 'cpcrm.php?t=cpcrmrun&mod=crmoutbox.taskclicks&id='.$data; 
		else //campaign id
			$bodyurl = 'cpcrm.php?t=cpcrmrun&mod=crmoutbox.alltaskclicks&id='.$data; 
		
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";      

		return ($frame);		
	}	
	
};
}
?>