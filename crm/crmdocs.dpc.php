<?php
$__DPCSEC['CRMDOCS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CRMDOCS_DPC")) && (seclevel('CRMDOCS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CRMDOCS_DPC",true);

$__DPC['CRMDOCS_DPC'] = 'crmdocs';

$b = GetGlobal('controller')->require_dpc('crm/crmmodule.dpc.php');
require_once($b);

$__LOCALE['CRMDOCS_DPC'][0]='CRMDOCS_DPC;Documents;Έγγραφα';
$__LOCALE['CRMDOCS_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['CRMDOCS_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['CRMDOCS_DPC'][3]='_status;Status;Κατάσταση';
$__LOCALE['CRMDOCS_DPC'][4]='_user;User;Πελάτης';
$__LOCALE['CRMDOCS_DPC'][5]='_cid;cid;cid';
$__LOCALE['CRMDOCS_DPC'][6]='_clicks;Clickpath;Clickpath';
$__LOCALE['CRMDOCS_DPC'][7]='_price;Price;Αξία';


class crmdocs extends crmmodule  {
		
	function __construct() {
	
	  crmmodule::__construct();
	}

	public function docs_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('CRMDOCS_DPC',getlocal());  
	
	    if (defined('MYGRID_DPC')) {
			
            $xSQL2 = "SELECT * from (select d.id,d.date,d.docid,d.cid,d.formname,d.title,d.owner,m.timeout,m.reply,m.status,m.mailstatus from crmdocs d, mailqueue m where d.docid=m.cid and d.cid='$selected') o ";
			//echo $xSQL2;
			_m("mygrid.column use grid3+id|".localize('_id',getlocal())."|2|0|");
			_m("mygrid.column use grid3+date|".localize('_date',getlocal())."|5|1|");//"|link|5|"."javascript:showdetails({id});".'||');
			_m("mygrid.column use grid3+docid|".localize('docid',getlocal())."|10|1||||1|");			
			_m("mygrid.column use grid3+cid|".localize('_user',getlocal())."|10|1||||1|");
			_m("mygrid.column use grid3+formname|".localize('form',getlocal())."|link|5|"."javascript:showdetails(\"{cid}\");".'||');						
			_m("mygrid.column use grid3+title|".localize('_subject',getlocal())."|link|19|"."javascript:showdetails(\"{docid}\");".'||');//."|19|0|");
			_m("mygrid.column use grid3+timeout|".localize('_date',getlocal())."|5|1|");
		    _m("mygrid.column use grid3+reply|".localize('_reply',getlocal())."|2|0|");	
			_m("mygrid.column use grid3+status|".localize('_status',getlocal())."|2|0|||||right");	
		    _m("mygrid.column use grid3+mailstatus|".localize('_failed',getlocal())."|2|1|");			
			
			$ret .= _m("mygrid.grid use grid3+crmdocs+$xSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
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

	protected function docitems_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('CRMDOCSITEM_DPC',getlocal());
	
	    if (defined('MYGRID_DPC')) {
			
			$xsSQL2 = "SELECT * FROM (SELECT w.id,w.docid,w.date,w.code,w.itemcode,w.name,w.active as act,w.price0,w.price1,p.itmactive,p.active,p.code5,p.itmname,p.sysins,p.cat0,p.cat1,p.cat2,p.cat3,p.cat4 FROM crmdocsitem w, products p WHERE w.itemcode=p.code5 AND w.docid='$selected') x";
			//echo $xsSQL2;
			_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|||1");
			_m("mygrid.column use grid1+date|".localize('_date',getlocal()). "|5|0|");
			//_m("mygrid.column use grid1+docid|".localize('docid',getlocal())."|1|0|");		
			//_m("mygrid.column use grid1+name|".localize('_title',getlocal()). "|5|0|");
			_m("mygrid.column use grid1+act|".localize('_active',getlocal())."|boolean|1|");
		    _m("mygrid.column use grid1+itmactive|".localize('_active',getlocal())."|2|0|");		
			_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|2|0|");
			_m("mygrid.column use grid1+code5|".localize('_code',getlocal())."|link|4|"."javascript:showdetails(\"{itemcode}~$selected\");".'||');
			_m("mygrid.column use grid1+sysins|".localize('_date',getlocal())."|5|0|");			
			_m("mygrid.column use grid1+itmname|".localize('_title',getlocal())."|10|0|");	
			_m("mygrid.column use grid1+cat0|".localize('_cat0',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat1|".localize('_cat1',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat2|".localize('_cat2',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat3|".localize('_cat3',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat4|".localize('_cat4',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+price0|".localize('_price',getlocal())."|10|1|");	
			_m("mygrid.column use grid1+price1|".localize('_price',getlocal())."|2|1|");				
			$ret .= _m("mygrid.grid use grid1+crmdocsitem+$xsSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	
	
	public function items() {
		$out = $this->docitems_grid(null,250,10,'e',true);
		return ($out);
	}		

    protected function _checkmail($data) {

		if( !eregi("^[a-z0-9]+([_\\.-][a-z0-9]+)*" . "@([a-z0-9]+([\.-][a-z0-9]{1,})+)*$", $data, $regs) )  
			return false;

		return true;  
	}	
		
	public function showdetails($data=null) {
		
        if ($this->_checkmail($data)) //email for attr3
			$bodyurl = 'cpcrm.php?t=cpcrmrun&mod=crmtasks.taskclicks&id='.$data; 
		else //campaign id = doc id
			$bodyurl = 'cpcrm.php?t=cpcrmrun&mod=crmdocs.items&id='.$data; 
		
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";      

		return ($frame);		
	}	
	
};
}
?>