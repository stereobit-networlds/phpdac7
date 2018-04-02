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

',1);

$mc_page = _m('cmsrt.mcSelectPage use index+home++1');
$user = GetGlobal('UserName') ? decode(GetGlobal('UserName')) : '';
_m("cmsvstats.update_page_statistics use fp+$mc_page+".$user);

if ($mc_page == 'home') { 
	$_GET['style'] = 'alt2';
	$_GET['mc_page'] = 'home';
}	
else
	$_GET['style'] = 'alt';

$headerStyle = ($mc_page=='home') ? 1 : 2;
echo $htmlpage->render(null,getlocal(),null,'media-center/index.php');
$time = (microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]) / 60;
echo "<!-- remote $time -->";
?>