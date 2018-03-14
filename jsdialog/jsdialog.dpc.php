<?php

$__DPCSEC['JSDIALOG_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ( (!defined("JSDIALOG_DPC")) && (seclevel('JSDIALOG_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("JSDIALOG_DPC",true);

$__DPC['JSDIALOG_DPC'] = 'jsdialog';


$__EVENTS['JSDIALOG_DPC'][0]='jsdialog';
$__EVENTS['JSDIALOG_DPC'][1]='jsyes';
$__EVENTS['JSDIALOG_DPC'][2]='jsno';
$__EVENTS['JSDIALOG_DPC'][3]='jscancel';

$__ACTIONS['JSDIALOG_DPC'][0]='jsdialog';
$__ACTIONS['JSDIALOG_DPC'][1]='jsyes';
$__ACTIONS['JSDIALOG_DPC'][2]='jsno';
$__ACTIONS['JSDIALOG_DPC'][3]='jscancel';

$__LOCALE['JSDIALOG_DPC'][0]='JSDIALOG_DPC;JS dialog;JS dialog';
$__LOCALE['JSDIALOG_DPC'][1]='_defaultText;e-shop technology demonstartion. Designated trademarks and brands are property of their respective owners.;Η εγγραφή σας καθώς και οι παραγγελίες σας ΔΕΝ θα εκτελεστούν. Οι τιμές που αναφέρονται είναι τυχαίες. Έμπορικά σήματα ή δικαιώματα τρίτων που τυχόν αναφέρονται ανήκουν στους κατόχους τους.';
$__LOCALE['JSDIALOG_DPC'][2]='_defaultTitle;e-Enterprise shop (Demo use);e-Enterprise shop (Χρήση για δοκιμή)';

class jsdialog {
	
	var $title, $prpath, $urlpath, $url;
	var $dajaxpage;

    public function __construct() {
		
		$this->prpath = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');	
		$this->url = paramload('SHELL','urlbase');
		$this->title = localize('JSDIALOG_DPC',getlocal());	
		
		/*dynamic ajax dialogs call*/
		$this->dajaxpage = 'jsdialog.php';
	}
	
    public function event($event=null) {
		
	    switch ($event) {
		 
		    case 'jscancel'       : //cancel				
	                                break;
		    case 'jsyes'          : //yes option				
	                                break;									
	        case 'jsno'           : //no option
									break;
			case 'jsdialog'       :
			default               :	$title = localize('_defaultTitle', getlocal());
									$text = localize('_defaultText', getlocal());
									$d = $this->defaultDialog($text, $title); 
									//$d = $this->sayInformation($text, $title); 
									die($d);						  
        }
    }	

    public function action($action=null)  { 
	
	    switch ($action) {
		   case 'jsdialog'       : 
		   default               : $out = null;
		}			 

	    return ($out);
	}
	
	/* load js and css in page */
	public function javascript() {
		/*
		<link rel="stylesheet" href="css/zebra/flat/zebra_dialog.css" type="text/css">
		<script type="text/javascript" src="js/zebra/zebra_dialog.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){
		
				<phpdac>jsdialog.startDialog</phpdac>	
			});
		</script>		
		*/
	}

	/*called by page into document.ready( function */
	/*ajax call always jsdialog.php (default = this->defaultDialog)*/
	public function	startDialog($responder=null) {
		
		$respond = $responder ? $responder : $this->dajaxpage;
		
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

	/*default message from page when call startDialog */
	/*messages has to be configured inside this class and/or a FS mechanism */
	public function defaultDialog($text=null, $title=null) {
		$msg = $title ? '<strong>' . $title .'</strong><br/>'. $text : $text;
		$ret = "
		new $.Zebra_Dialog('$msg', 
		{
			'buttons':  false,
			'modal': false,
			'position': ['right - 20', 'top + 20'],
			'auto_close': 3000
		});";
		return ($ret);
	}
	
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
			'position': ['right - 20', 'top + 20']
		});";
		return ($ret);
	}	
	
	///lib/js/Zebra_Dialog-master/Zebra_Dialog-master/examples/index.html
	
	// this example is for the "error" box only
	// for the other types the "type" property changes to "warning", "question", "information" and "confirmation"
	// and the text for the "title" property also changes
	/*$.Zebra_Dialog('<strong>Zebra_Dialog</strong>, a small, compact and highly configurable dialog box plugin for jQuery', 
	{
		'type':     'error',
		'title':    'Error'
	});
	*/
	public function zdialog($text, $title=null, $type='error') {
		return "new $.Zebra_Dialog('$text', 
	{
		'type':     '$type',
		'title':    '$title'
	});";
	}
	
	/*$.Zebra_Dialog('<strong>Zebra_Dialog</strong>, a small, compact and highly configurable dialog box plugin for jQuery', 
	{
		'type':     'question',
		'title':    'Custom buttons',
		'buttons':  ['Yes', 'No', 'Help'],
		'onClose':  function(caption) {
			alert((caption != '' ? '"' + caption + '"' : 'nothing') + ' was clicked');
		}
	});	
	*/
	public function zdialogQuestion($text, $title=null, $buttons) {
		$b = $buttons ? $buttons : "'Yes', 'No', 'Help'";
		return "new $.Zebra_Dialog('$text', 
		'type':     'question',
		'title':    '$title',
		'buttons':  [$b]
	});";
	}
	
	/*$.Zebra_Dialog('<strong>Zebra_Dialog</strong>, a small, compact and highly configurable dialog box plugin for jQuery', 
	{
		'type':     'question',
		'title':    'Custom buttons',
		'buttons':  [
                    {caption: 'Yes', callback: function() { alert('"Yes" was clicked')}},
                    {caption: 'No', callback: function() { alert('"No" was clicked')}},
                    {caption: 'Cancel', callback: function() { alert('"Cancel" was clicked')}}
                ]
	});	
	*/
	public function zdialogCB($text, $title=null, $buttons, $cb) {
		if (is_array($buttons)) {
			foreach ($buttons as $b=>$caption)
				$btn[] = "{caption: '$caption', callback: ".$cb[$b]."}";
		}	
		$mybuttons = implode(',',$btn);
		
		return "new $.Zebra_Dialog('$text', 
		'type':     'question',
		'title':    '$title',
		'buttons':  [$mybuttons]
	});";
	}	
	
	/*new $.Zebra_Dialog('<strong>Some dummy content:</strong><br><br>', 
	{
		'source':  {'ajax': 'ajax.html'},
		width: 600,
		'title': 'External content loaded via AJAX'
	});*/
	public function zdialogAjax($url,$title=null,$width=600) {
		$w = $width ? $width : 600;		
		if ($url)		
		return "new $.Zebra_Dialog('$text', 
	{
		'source':  {'ajax': '$url'},
		width: $w,
		'title': '$title'
	});";
	}	
	
	/*new $.Zebra_Dialog('<strong>Content loaded via IFRAME:</strong>', 
	{
		source: {'iframe': {
			'src':  'http://en.m.wikipedia.org/wiki/Dialog_box',
			'height': 500
			}},
		width: 800,
		title:  'External content loaded in an iFrame'
	});	
	*/
	public function zdialogFrame($url,$title=null,$width=800,$height=500) {
		$w = $width ? $width : 800;
		$h = $height ? $height : 500;
		if ($url)
		return "new $.Zebra_Dialog('$text', 
	{
		source: {'iframe': {
			'src':  '$url',
			'height': $h
			}},
		width: $w,
		title:  '$title'
	});";
	}		
	
	public function sayError($text=null, $title=null) {

		/*$ret = "
		new $.Zebra_Dialog('$text', 
		{
			'type':     'error',
			'title':    '$title'
		});";
		return ($ret);*/
		
		return ($this->zDialog($text,$title,'error'));
	}	

	public function sayWarning($text=null, $title=null) {

		/*$ret = "
		new $.Zebra_Dialog('$text', 
		{
			'type':     'warning',
			'title':    '$title'
		});";
		return ($ret);*/
		
		return ($this->zDialog($text,$title,'warning'));
	}		
	
	public function sayInformation($text=null, $title=null) {

		/*$ret = "
		new $.Zebra_Dialog('$text', 
		{
			'type':     'information',
			'title':    '$title'
		});";
		return ($ret);*/
		
		return ($this->zDialog($text,$title,'information'));		
	}	
	
	public function sayConfirmation($text=null, $title=null) {

		/*$ret = "
		new $.Zebra_Dialog('$text', 
		{
			'type':     'confirmation',
			'title':    '$title'
		});";
		return ($ret);*/
		
		return ($this->zDialog($text,$title,'confirmation'));
	}		
					
};
}
?>