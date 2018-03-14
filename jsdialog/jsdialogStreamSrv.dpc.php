<?php

$__DPCSEC['JSDIALOGSTREAMSRV_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ( (!defined("JSDIALOGSTREAMSRV_DPC")) && (seclevel('JSDIALOGSTREAMSRV_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("JSDIALOGSTREAMSRV_DPC",true);

$__DPC['JSDIALOGSTREAMSRV_DPC'] = 'jsdialogStreamSrv';

$d = GetGlobal('controller')->require_dpc('jsdialog/jsdialog.dpc.php');
require_once($d);

GetGlobal('controller')->get_parent('JSDIALOG_DPC','JSDIALOGSTREAMSRV_DPC');

$__EVENTS['JSDIALOGSTREAMSRV_DPC'][4]='jsdialogstreamsrv';
$__EVENTS['JSDIALOGSTREAMSRV_DPC'][5]='jsdtime';

$__ACTIONS['JSDIALOGSTREAMSRV_DPC'][4]='jsdialogstreamsrv';
$__ACTIONS['JSDIALOGSTREAMSRV_DPC'][5]='jsdtime';


$__LOCALE['JSDIALOGSTREAMSRV_DPC'][0]='JSDIALOGSTREAMSRV_DPC;JS dialog stream;JS dialog stream';
$__LOCALE['JSDIALOGSTREAMSRV_DPC'][1]='_sText;Stream message;Stream message';
$__LOCALE['JSDIALOGSTREAMSRV_DPC'][2]='_sTitle;e-Enterprise;e-Enterprise';

class jsdialogStreamSrv extends jsdialog {
	
	var $title, $prpath, $urlpath, $url;
	var $dajaxpage;

    function __construct() {
		
		jsdialog::__construct();

		//override
		//$this->dajaxpage = 'jsdialogStreamSrv.php';  /'jsdialog.php'
	}
	
    function event($event=null) {
		
	    switch ($event) {
		 
		    case 'jsdtime'        : die($this->respond()); 
	                                break;

			case 'jsdialogstreamsrv' :
			default                  :	die($this->respond()); //jsdialog::event($event);						  
									
        }
    }	

    function action($action=null)  { 
	
	    switch ($action) {
		   case 'jsdialogstreamsrv'  : 
		   default                   : $out = null;//jsdialog::action($action);
		}			 

	    return ($out);
	}	
	
	public function	streamDialog($responder=null) {
		
		$respond = $responder ? $this->dajaxpage."?t=".$responder : $this->dajaxpage;
		
		$ret = "
			$.ajax({
            url: '$respond',
            context: document.body,
            success: function(responseText) {
				eval(responseText);
            }
        });		
		";
		return ($ret);
	}

	protected function respond() {
		$title = localize('_sTitle', getlocal());
		$text = localize('_sText', getlocal()) . " " . date('Y-m-d H:i:s');
		//$response = $this->defaultDialog($text, $title); 
		
		//..exec scenario..
		$source = null;
		
		$response = $this->sayMsg($text, $title, $source, 2000); 
		
		return ($response);
	}
	
	//override
	public function say($text=null, $title=null, $source=null, $close=null) {
		$msg = $title ? '<strong>' . $title .'</strong><br/>'. $text : $text;
		$s = $source ? "'source':  {'ajax': '$source'}," : null;
		$c = $close ? "'auto_close': $close," : null;
		
		$ret = "
		new $.Zebra_Dialog('$msg', 
		{
			'buttons':  false,
			'modal': false,
			$s
			$c
			'position': ['right - 20', 'bottom - 20']
		});";
		return ($ret);
	}	

	public function sayMsg($text=null, $title=null, $source=null, $close=null, $type=null) {
		$msg = $title ? '<strong>' . $title .'</strong><br/>'. $text : $text;
		$s = $source ? "'source':  {'ajax': '$source'}," : null;
		$c = $close ? "'auto_close': $close," : null;
		$type = $type ? $type : 'warning';
		
		$ret = "
		new $.Zebra_Dialog('$msg', 
		{
			'type'   : '$type',
			'buttons':  false,
			'modal': false,
			$s
			$c
			'position': ['right - 20', 'bottom - 20']
		});";
		return ($ret);
	}		
					
};
}
?>