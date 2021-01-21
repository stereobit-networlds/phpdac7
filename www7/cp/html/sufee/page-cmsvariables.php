$page = new pcntl('
super javascript;

load_extension adodb refby _ADODB_; 
super database;

/---------------------------------load and create libs
use i18n.i18n;
use jqgrid.jqgrid;

/---------------------------------load not create dpc (internal use)
#include networlds.clientdpc;	

/---------------------------------load all and create after dpc objects
public jqgrid.mygrid;
public cms.cmsrt;
#ifdef SES_LOGIN
public cms.rccmsvariables;
public cp.rcpmenu;
#endif
public cp.rccontrolpanel;
public i18n.i18nL;

',1);

$cptemplate = _m('cmsrt.paramload use FRONTHTMLPAGE+cptemplate');

	switch (GetReq('t')) {
		case 'cpcmsframe'      : $p = 'cp-iframe-jqgrid'; break;
		case 'cpcmscalevents'  : break;
		case 'cpcmsvarcalendar': $p = 'cp-cmsvarcalendar'; break;
		case 'cpcmstimevars'   : //$p = 'cp-cmstimevars'; break;
		case 'cpcmsvars'       : 
		default                : $p = 'cp-cmsvariables'; 
	}
	
    $mc_page = (GetSessionParam('LOGIN')) ? $p : 'cp-login';
    $cmd = GetReq('t') ? GetReq('t') : 'cpcmsvars';
	return $page->action($cmd);
