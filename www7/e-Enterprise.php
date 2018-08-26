<?php
define('SMTP_PHPMAILER','true');

$ip = $_SERVER['REMOTE_ADDR'];
if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
    $ip = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
}
$sesID = md5($ip); //'enterprise'; // or fixed id

//$localscript=1;
//$nosession=1;
//require_once('cp/phpdac7.php');
$htmlpage = new pcntl('
/include cms.cms;
include ippserver.ipp;
',1);
$listener = new ipp('e-Enterprise.printer' ,'BASIC' ,80 ,array('admin'=>'3964dae4','guest'=>'13add271','billy'=>'88e815c2',));
$listener->ipp_send_reply(); 

/*
include ('cp/admin/ippserver/ListenerIPP.php');
$listener = new IPPListener('e-Enterprise.printer' ,'BASIC' ,80 ,array('admin'=>'3964dae4','guest'=>'13add271','billy'=>'88e815c2',));
$listener->ipp_send_reply(); 
*/
?>