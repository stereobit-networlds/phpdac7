$page = new pcntl('
super javascript;
load_extension adodb refby _ADODB_; 
super database;
use i18n.i18n;
use jqgrid.jqgrid;
public jqgrid.mygrid;
public cms.cmsrt;
#ifdef SES_LOGIN
public cp.rcmessages;
public cp.rcpmenu;
#endif
public cp.rccontrolpanel;
public i18n.i18nL;

',1);
	
    $mc_page = (GetSessionParam('LOGIN')) ? $p : 'cp-login';
    $cmd = GetReq('t') ? GetReq('t') : 'cpmsg';
	return $page->action($cmd);