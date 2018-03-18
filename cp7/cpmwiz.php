<?php
require('phpdac7.php');
$page = new pcntl('

super javascript;
/super rcserver.rcssystem;

load_extension adodb refby _ADODB_; 
super database;

use xwindow.window;
use gui.swfcharts;
/---------------------------------load not create dpc (internal use)
include networlds.clientdpc;			

/---------------------------------load all and create after dpc objects
public cms.cmsrt;
#ifdef SES_LOGIN
public cp.shlogin;
public bshop.rcitems;
public phpdac.rcwizard;
public cp.rcpmenu;
#endif
public cp.rccontrolpanel;
',1);

$cptemplate = _m('rcserver.paramload use FRONTHTMLPAGE+cptemplate');
$lan = getlocal();
if ($cptemplate) {
    $mc_page = (GetSessionParam('LOGIN')) ? 'cp-tags' : 'cp-login';
	echo $page->render(null,getlocal(), null, $cptemplate.'/index.php');
}
else
	echo $page->render(null,getlocal(),null,"cpwizard$lan.html");
?>