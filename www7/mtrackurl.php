<?php
define('SMTP_PHPMAILER','true');

$page = new pcntl('
super javascript;

load_extension adodb refby _ADODB_; 
super database;		

public cms.cmsrt;
public cp.rctrackurl;

',1);	 

$lan = getlocal();
echo $page->render(null,$lan,null,"index.html");
?>