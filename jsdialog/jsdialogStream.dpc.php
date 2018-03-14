<?php

$__DPCSEC['JSDIALOGSTREAM_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ( (!defined("JSDIALOGSTREAM_DPC")) && (seclevel('JSDIALOGSTREAM_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("JSDIALOGSTREAM_DPC",true);

$__DPC['JSDIALOGSTREAM_DPC'] = 'jsdialogStream';

$d = GetGlobal('controller')->require_dpc('jsdialog/jsdialog.dpc.php');
require_once($d);

GetGlobal('controller')->get_parent('JSDIALOG_DPC','JSDIALOGSTREAM_DPC');

$__EVENTS['JSDIALOGSTREAM_DPC'][4]='jsdialogstream';
$__EVENTS['JSDIALOGSTREAM_DPC'][5]='jsdtime';
$__EVENTS['JSDIALOGSTREAM_DPC'][6]='jsdcode';
//$__EVENTS['JSDIALOGSTREAM_DPC'][7]='jscancel';

$__ACTIONS['JSDIALOGSTREAM_DPC'][4]='jsdialogstream';
$__ACTIONS['JSDIALOGSTREAM_DPC'][5]='jsdtime';
$__ACTIONS['JSDIALOGSTREAM_DPC'][6]='jsdcode';
//$__ACTIONS['JSDIALOGSTREAM_DPC'][7]='jscancel';

$__LOCALE['JSDIALOGSTREAM_DPC'][0]='JSDIALOGSTREAM_DPC;JS dialog stream;JS dialog stream';
$__LOCALE['JSDIALOGSTREAM_DPC'][1]='_sText;Stream message;Stream message';
$__LOCALE['JSDIALOGSTREAM_DPC'][2]='_sTitle;e-Enterprise;e-Enterprise';
$__LOCALE['JSDIALOGSTREAM_DPC'][3]='_cookiesmsg;We use cookies to ensure that we give you the best experience on our website;Αυτός ο ιστότοπος χρησιμοποιεί cookies. Με τη χρήση αυτού του ιστότοπου αποδέχεστε τη χρήση τους';

class jsdialogStream extends jsdialog {
	
	var $title, $prpath, $urlpath, $url;
	var $dajaxpage;

    public function __construct() {
		
		jsdialog::__construct();

		//load personilized scenario...	
	}
	
    public function event($event=null) {
		
	    switch ($event) {
			
			case 'jsdcode'        : break; //bypass, exec code at .php body
		    case 'jsdtime'        : die($this->respond()); break;
			case 'jsdialogstream' :
			default               :	jsdialog::event($event);						  						
        }
    }	

    public function action($action=null)  { 
	
	    switch ($action) {
			
			case 'jsdcode'         : $out = null; break; //bypass, exec code at .php body	
			case 'jsdtime'         : $out = null; break;
			case 'jsdialogstream'  : 
			default                : $out = jsdialog::action($action);
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
		
		$response = $this->say($text, $title, $source, 2000); 
		
		return ($response);
	}
					
};
}
?>