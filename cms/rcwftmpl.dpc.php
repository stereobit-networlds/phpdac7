<?php

$__DPCSEC['RCWFTMPL_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCWFTMPL_DPC")) && (seclevel('RCWFTMPL_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCWFTMPL_DPC",true);

$__DPC['RCWFTMPL_DPC'] = 'rcwftmpl';

$__EVENTS['RCWFTMPL_DPC'][0]='cpwftmpl';

$__ACTIONS['RCWFTMPL_DPC'][0]='cpwftmpl';

$__DPCATTR['RCWFTMPL_DPC']['cpwftmpl'] = 'cpwftmpl,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCWFTMPL_DPC'][0]='RCWFTMPL_DPC;Page templates;Πρότυπα προβολής';
$__LOCALE['RCWFTMPL_DPC'][1]='_mcid;Id;Id';
$__LOCALE['RCWFTMPL_DPC'][2]='_mcname;Selected template;Επιλογή προβολής';
$__LOCALE['RCWFTMPL_DPC'][3]='_mctmpl;Theme;Θέμα';
$__LOCALE['RCWFTMPL_DPC'][4]='_mcdata;Content;Περιεχόμενο';
//$__LOCALE['RCWFTMPL_DPC'][5]='_name1;First Name;Ονομα';

class rcwftmpl {

    var $title, $path, $post;

	public function __construct() {
		$lan = getlocal();
	
		$this->title = localize('RCWFTMPL_DPC',$lan);
		$this->path = paramload('SHELL','prpath');

	}

    public function event($event=null) {

		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;

		switch ($event) {
             
			case 'cpwftmpl'     :   
			default            	: 
		}
    }

    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	

		switch ($action) {
			 
			case 'cpwftmpl'    : 
			default            : 	$out .= $this->viewWFTemplates();	
		}

		return ($out);
    }
	
	
	protected function viewWFTemplates() {	   
		$lan = getlocal();
		$title = str_replace(' ','_',localize('RCWFTMPL_DPC',$lan));
		$isadmin = _m('cmsrt.isLevelUser use 8');
			
	    if (defined('MYGRID_DPC')) {
			
			$edit = $isadmin ? 'd' : 'e';
			$editf = $isadmin ? 1 : 0;
			
            $xsSQL = "SELECT * from (select id,mcid,mcname,mctmpl from wftmpl) o ";		   
		    //echo $xsSQL;
			
		    _m("mygrid.column use grid1+id|".localize('id',$lan)."|5|0|||1");
		    //_m("mygrid.column use grid1+timein|".localize('_date',$lan)."|8|0|");	   
			//_m("mygrid.column use grid1+active|".localize('_active',$lan)."|boolean|1|");
		    _m("mygrid.column use grid1+mcid|".localize('_mcid',$lan)."|10|1|");						
			_m("mygrid.column use grid1+mcname|".localize('_mcname',$lan)."|10|1|");
		    _m("mygrid.column use grid1+mctmpl|".localize('_mctmpl',$lan)."|20|1|");
		    _m("mygrid.column use grid1+mcdata|".localize('_mcdata',$lan)."|10|1|");
		   
		    $out .= _m("mygrid.grid use grid1+wftmpl+$xsSQL+$edit+".$title."+id+0+1+25+600++0+1+1");
		   
		    return ($out); 	
	    }

		return ('ENABLE JQGRID:'.$out);		
	}	
	
};
}
?>