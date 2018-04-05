<?php
//$processMethod = 'balanced'; 
//$processDebug = false;

$htmlpage = new pcntl('
super javascript;
load_extension adodb refby _ADODB_; 
super database;
use i18n.i18n;
include mail.smtpmail;
include process;

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
public bshop.shcart->processcart_bcstep0->processcart_bcstep1->processcart_bcstep2->processcart_bcstep3;
/public bshop.shcart;
public bshop.shtransactions;
public jsdialog.jsdialogStream;
public i18n.i18nL;

/phpcode if ($x==1) { $x=2: } else $x=3: echo $x:;
/phpcode echo $x . \' x\':;

/phpcode echo \'status \' . GetSessionParam(\'cartstatus\'):;
/nvl bshop.a bshop.b return (GetSessionParam(\'cartstatus\')):;

',1);

    /*when in cart procedure disable common subscribe form in every page -footer-*/	
    $nosubform = ((GetParam('t')=='viewcart') || ((GetReq('t')=='calc')) ||
	              (GetReq('t')=='cart-order') || ((GetReq('t')=='cart-submit')) || 
		          (GetReq('t')=='cart-cancel') || ((GetReq('t')=='cart-checkout')) ||
				  (GetReq('t')=='addtocart') || ((GetReq('t')=='removefromcart')) ||
				  (GetParam('FormAction')==_v('shcart.checkout')) ||
				  (GetParam('FormAction')==_v('shcart.order')) ||
				  (GetParam('FormAction')==_V('shcart.submit'))) ? 1 : 0;
	  
    $mc_page = _m('cmsrt.mcSelectPage use +klist');	
    $headerStyle = ($mc_page=='home') ? 1 : 2;
    echo $htmlpage->render(null,getlocal(),null,'media-center/index.php');	

$time = (microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]) / 60;
echo "<!-- remote $time -->";
?>