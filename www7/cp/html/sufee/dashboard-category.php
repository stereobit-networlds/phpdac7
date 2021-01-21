$page = new pcntl('
super javascript;
load_extension adodb refby _ADODB_; 
super database;
use i18n.i18n;
use gui.swfcharts;
use jqgrid.jqgrid;
use cms.cmscharts;

include mail.smtpmail;

public jqgrid.mygrid;
public cms.cmsrt;

#ifdef SES_LOGIN
public crm.crmforms;
public crm.rccrmtrace;
#endif

public piwik.siteanalytics;
public bmail.rculiststats;
public cp.rcmessages;
public cp.rccpclick;
public cp.rcpmenu;
public cp.cplogin;
public cp.rccontrolpanel;
public i18n.i18nL;

',1);
	
    $mc_page = (GetSessionParam('LOGIN')) ? $p : 'cp-login';
    $cmd = GetReq('t') ? GetReq('t') : 'cp';
	return $page->action($cmd);