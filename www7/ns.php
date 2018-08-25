<?php
$htmlpage = new pcntl('
super javascript;
load_extension adodb refby _ADODB_; 
super database;

use i18n.i18n;
include mail.smtpmail;

public twig.twigengine;
public cms.cmsrt;
public cms.cmsvstats;
/public cms.cmslogin;
public bshop.shlogin;
public cms.cmsmenu;
public cms.cmssubscribe;
public bshop.shkategories; 
public bshop.shkatalogmedia;
public bshop.shnsearch;
public bshop.shwishcmp;
public bshop.shtags;
public bshop.shusers;
public bshop.shcustomers;
public bshop.shcart;
public bshop.shtransactions;
public jsdialog.jsdialogStream;
public i18n.i18nL;

public cp.rcnewsletter;
',1);

$ns_page = $_GET['a'] ? urldecode($_GET['a']) .'.html' : null; 

if ($ns_page) {
	//render the normal htmlpage first (else err)
	$htmlpage->render(null, getlocal(), null, $ns_page);
	ob_clean();
	echo _m('rcnewsletter.render use ' . $ns_page);	
}	
else {
	$mc_page = _m('cmsrt.mcSelectPage use index+home++1');
	echo $htmlpage->render(null, getlocal(), null, 'media-center/index.php'); //not work!!
}
?>