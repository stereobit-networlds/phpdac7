<?php
require_once('cp/phpdac7.php');

$htmlpage = new pcntl('
/include cms.cms;
include ippserver.ipp;
',1);
$listener = new ipp('e-Enterprise.printer' ,'BASIC' ,80 ,array('admin'=>'3964dae4','guest'=>'13add271','billy'=>'88e815c2',));
$listener->ipp_send_reply(); 
//}
?>