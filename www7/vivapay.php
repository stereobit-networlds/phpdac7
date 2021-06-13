<?php
$htmlpage = new pcntl('
super javascript;

load_extension adodb refby _ADODB_; 
super database;

/---------------------------------load and create libs
use i18n.i18n;

/---------------------------------load not create dpc
include mail.smtpmail;
	
/---------------------------------load all and create after dpc objects
public cms.cmsrt;
public cms.cmsvstats;
public cms.cmslogin;
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
public bshop.shvivapay;
public jsdialog.jsdialogStream;
public i18n.i18nL;

',1);

$mc_page = 'cart-order';
$user = GetGlobal('UserName') ? decode(GetGlobal('UserName')) : '';
_m("cmsvstats.update_page_statistics use fp+$mc_page+".$user);
echo $htmlpage->render(null,getlocal());
$time = (microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]) / 60;
echo "<!-- local $time -->";
?>