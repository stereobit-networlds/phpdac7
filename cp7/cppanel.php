<?php
require('phpdac7.php');
$page = new pcntl('
super javascript;

/---------------------------------load and create libs
use xwindow.window,xwindow.window2,browser;

/---------------------------------load not create dpc (internal use)
include frontpage.fronthtmlpage;

/---------------------------------load all and create after dpc objects
public cms.cmsrt;
public cpanel.rcpanel;

',1);
echo $page->render(null,0,null,'cp_nocache.html');//'template4.htm');
?>

