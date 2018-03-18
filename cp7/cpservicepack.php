<?php
require('phpdac7.php');
$page = new pcntl('

super javascript;
/super rcserver.rcssystem;

load_extension adodb refby _ADODB_; 
super database;

/---------------------------------load and create libs
use xwindow.window;

/---------------------------------load not create dpc (internal use)

include networlds.clientdpc;
include gui.form;
include gui.htmlarea;
			
/---------------------------------load all and create after dpc objects
public cms.cmsrt;
#ifdef SES_LOGIN
public cp.servicepack;
public cp.rcpmenu;
#endif
public cp.rccontrolpanel;
',1);

$cptemplate = _m('rcserver.paramload use FRONTHTMLPAGE+cptemplate');

    $mc_page = (GetSessionParam('LOGIN')) ? 'cp-tags' : 'cp-login';
	echo $page->render(null,getlocal(), null, $cptemplate.'/index.php');
?>