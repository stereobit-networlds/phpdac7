<?php

$__DPCSEC['RCNOTUFIER_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ( (!defined("RCNOTIFIER_DPC")) && (seclevel('RCNOTIFIER_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCNOTIFIER_DPC",true);

$__DPC['RCNOTIFIER_DPC'] = 'RCNOTIFIER';


$__EVENTS['RCNOTIFIER_DPC'][0]='cpnotifier';
$__EVENTS['RCNOTIFIER_DPC'][1]='cpnotice';
$__EVENTS['RCNOTIFIER_DPC'][2]='cpsubscribe';
$__EVENTS['RCNOTIFIER_DPC'][3]='cpadvsubscribe';

$__ACTIONS['RCNOTIFIER_DPC'][0]='cpfactory';
$__ACTIONS['RCNOTIFIER_DPC'][1]='cpnotice';
$__ACTIONS['RCNOTIFIER_DPC'][2]='cpsubscribe';
$__ACTIONS['RCNOTIFIER_DPC'][3]='cpadvsubscribe';

$__LOCALE['RCNOTIFIER_DPC'][0]='RCNOTIFIER_DPC;Notifier;Notifier';

class rcnotifier {
	
	var $title, $prpath, $urlpath, $url;

    function __construct() {
		
	  $this->prpath = paramload('SHELL','prpath');
      $this->urlpath = paramload('SHELL','urlpath');	
	  $this->url = paramload('SHELL','urlbase');
	  $this->title = localize('RCNOTIFIER_DPC',getlocal());	  
	}
	
    function event($event=null) {
	
	   /////////////////////////////////////////////////////////////
	   if (GetSessionParam('LOGIN')!='yes') die();                //	
	   /////////////////////////////////////////////////////////////			

       if (!$this->msg) {
  
	     switch ($event) {
		 
		    case 'cpsubscribe'    : 				
	                                break;
		    case 'cpnotice'       : 				
	                                break;									
	        case 'cpsubscribers'  :
			case 'cpnotifier'     :
			default               :							  
         }
      }
    }	

    function action($action=null)  { 

	     switch ($action) {
		   case 'cpnotifier'     : 
		   default               : $out .= null;
		 }			 

	     return ($out);
	}

    public function notify() {
		
	}	
					
};
}
?>