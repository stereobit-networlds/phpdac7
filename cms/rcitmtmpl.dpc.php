<?php

$__DPCSEC['RCITMTMPL_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCITMTMPL_DPC")) && (seclevel('RCITMTMPL_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCITMTMPL_DPC",true);

$__DPC['RCITMTMPL_DPC'] = 'rcitmtmpl';

$__EVENTS['RCITMTMPL_DPC'][0]='cpwitmtmpl';

$__ACTIONS['RCITMTMPL_DPC'][0]='cpitmtmpl';

$__DPCATTR['RCITMTMPL_DPC']['cpitmtmpl'] = 'cpitmtmpl,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCITMTMPL_DPC'][0]='RCITMTMPL_DPC;Item templates;Πρότυπα προβολής';
$__LOCALE['RCITMTMPL_DPC'][1]='_id;Id;Id';
$__LOCALE['RCITMTMPL_DPC'][2]='_tmpl;Selected template;Επιλογή προβολής';
$__LOCALE['RCITMTMPL_DPC'][3]='_date;Date;Ημ/νία';
$__LOCALE['RCITMTMPL_DPC'][4]='_owner;Owner;Χρήστης';
$__LOCALE['RCITMTMPL_DPC'][5]='_code;Code;Κωδικός';
$__LOCALE['RCITMTMPL_DPC'][6]='_itmactive;Active;Ενεργό';
$__LOCALE['RCITMTMPL_DPC'][7]='_active;Active;Ενεργό';
$__LOCALE['RCITMTMPL_DPC'][8]='_itmname;Title;Τίτλος';
$__LOCALE['RCITMTMPL_DPC'][9]='_itmfname;Title;Τίτλος';


class rcitmtmpl {

    var $title, $path, $post;

	public function __construct() {
		$lan = getlocal();
	
		$this->title = localize('RCITMTMPL_DPC',$lan);
		$this->path = paramload('SHELL','prpath');

	}

    public function event($event=null) {

		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;

		switch ($event) {
             
			case 'cpitmtmpl'    :   
			default            	: 
		}
    }

    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	

		switch ($action) {
			 
			case 'cpitmtmpl'   : 
			default            : 	$out .= $this->viewItmTemplates();	
		}

		return ($out);
    }
	
	
	protected function viewItmTemplates() {	   
		$lan = getlocal();
		$title = str_replace(' ','_',localize('RCITMTMPL_DPC',$lan));
		$isadmin = _m('cmsrt.isLevelUser use 9');
			
	    if (defined('MYGRID_DPC')) {
			
			$edit = $isadmin ? 'd' : 'e';
			$editf = $isadmin ? 1 : 0;
			
			$itmtitle = $lan ? 'itmname' :  'itmfname';
			$code = _v('cmsrt.fcode');
			
            $xsSQL = "SELECT * from (select id,datein,active,itmactive,$code,$itmtitle,template,owner from products) o ";		   
		    //echo $xsSQL;
			
		    _m("mygrid.column use grid1+id|".localize('id',$lan)."|5|0|||1");
		    _m("mygrid.column use grid1+datein|".localize('_date',$lan)."|8|0|");	   
			_m("mygrid.column use grid1+active|".localize('_active',$lan)."|boolean|0|101:0");
			_m("mygrid.column use grid1+itmactive|".localize('_active',$lan)."|boolean|0|");
		    _m("mygrid.column use grid1+$code|".localize('_code',$lan)."|10|0|");						
			_m("mygrid.column use grid1+$itmtitle|".localize('_'.$itmtitle,$lan)."|20|0|");
		    _m("mygrid.column use grid1+template|".localize('_tmpl',$lan)."|20|1|");
		    _m("mygrid.column use grid1+owner|".localize('_owner',$lan)."|10|1|");
		   
		    $out .= _m("mygrid.grid use grid1+products+$xsSQL+$edit+".$title."+id+0+1+25+600++0+1+1");
		   
		    return ($out); 	
	    }

		return ('ENABLE JQGRID:'.$out);		
	}	
	
};
}
?>