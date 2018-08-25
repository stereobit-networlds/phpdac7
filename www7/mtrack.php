<?php
define('SMTP_PHPMAILER','true');

$page = new pcntl('
super javascript;

load_extension adodb refby _ADODB_; 		
super database;

public cms.cmsrt;
public mail.smtpmail;

',1);	 

$ret = _m('cmsrt.readTracker');
?>