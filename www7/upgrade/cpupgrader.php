<?php
$localscript=1;
require('phpdac7.php'); 
$htmlpage = new pcntl('
super javascript;
use i18n.i18n;
public cms.cmsrt;
public cms.rcupgrader;
public i18n.i18nL;
',1);

$report = GetParam('report') ? 1: null;

if ($app = GetParam('app')) {
	
	$ver = GetParam('version');
	$file = GetParam('element');
	
	switch ($ver) {
		//case '1.1': break;
		//case 'fix1': break;
		
		default : 	if ($file) 
						echo _m("rcupgrader.fetchfile use $ver+$file");
					else
						echo _m("rcupgrader.runscan use $ver+$app+$report");
	}
}
?>