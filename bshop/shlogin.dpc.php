<?php
$__DPCSEC['SHLOGIN_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if (!defined("SHLOGIN_DPC")) {
define("SHLOGIN_DPC",true);

$__DPC['SHLOGIN_DPC'] = 'shlogin';

$a = GetGlobal('controller')->require_dpc('cms/cmslogin.dpc.php');
require_once($a);
 
//$__EVENTS['SHLOGIN_DPC'][0]='shlogin';
//$__ACTIONS['SHLOGIN_DPC'][0]='shlogin';
GetGlobal('controller')->get_parent('CMSLOGIN_DPC','SHLOGIN_DPC');

$__DPCATTR['SHLOGIN_DPC']['shlogin'] = 'shlogin,1,0,0,0,0,0,0,0,1,1,1,1';

$__LOCALE['SHLOGIN_DPC'][0]='SHLOGIN_DPC;Login;Login';

class shlogin extends cmslogin {
   

	public function __construct() {
		
		cmslogin::__construct();
	}
   
	public function event($event=null) {

		switch ($event) {
			
			case 'rempwd'   : 	$this->jsBrowser();
								break;
			
			case 'dologin'  :   if (defined('SHCART_DPC')) { 									
									//when cart items and goto cart
									/*if (_m('shcart.getcartCount')) {
										//echo 'shlogin:';
										SetSessionParam('cartstatus',1); 
										_v('shcart.status use 1'); 
									}*/
									_m('shcart.jsBrowser');
								}	
								//break;
			case 'shlogin'  :
			case 'cmslogin' :   cmslogin::event($event);
								$this->jsBrowser(); 
								break;	
		
			default 		: 	cmslogin::event($event);
		}
	}
   
	public function action($action=null) {

		switch ($action) {
			case 'dologin'	: 	/*if ($this->login_successfull) {
									if (defined('SHCART_DPC')) {
									}
								}	
								break;*/
			default 		: 	$out = cmslogin::action($action);
		}	
		return ($out);
	}
	
	protected function jsBrowser() {
		
		$code = $this->jsLogin();		
		   
		if ($code) {
			$js = new jscript;	
			$js->load_js($code,null,1);		
			unset ($js);
		}
	}

	protected function jsLogin() {
		$mobileDevices = _m('cmsrt.mobileMatchDev');

		$code = "
	if (/{$mobileDevices}/i.test(navigator.userAgent)) 
		window.scrollTo(0,parseInt($('#authentication').offset().top, 10));
	else {		
		gotoTop('authentication');	
	
		$(window).scroll(function() { 
			if (agentDiv('authentication')) {
				$.ajax({ url: 'jsdialog.php?t=jsdcode&id=login&div=authentication', cache: false, success: function(jsdialog){
					eval(jsdialog);		
				}})	
			}	
		});	
	}	
";
		
		return ($code);
	}	
   
};
}
?>