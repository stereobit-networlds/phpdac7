<?php

$__DPCSEC['RCFACTORY_DPC']='1;1;1;1;1;1;2;2;9;9;9';

if ( (!defined("RCFACTORY_DPC")) && (seclevel('RCFACTORY_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCFACTORY_DPC",true);

$__DPC['RCFACTORY_DPC'] = 'rcfactory';


$__EVENTS['RCFACTORY_DPC'][0]='cpfactory';
$__EVENTS['RCFACTORY_DPC'][1]='cpunsubscribe';
$__EVENTS['RCFACTORY_DPC'][2]='cpsubscribe';
$__EVENTS['RCFACTORY_DPC'][3]='cpadvsubscribe';

$__ACTIONS['RCFACTORY_DPC'][0]='cpfactory';
$__ACTIONS['RCFACTORY_DPC'][1]='cpunsubscribe';
$__ACTIONS['RCFACTORY_DPC'][2]='cpsubscribe';
$__ACTIONS['RCFACTORY_DPC'][3]='cpadvsubscribe';

$__LOCALE['RCFACTORY_DPC'][0]='RCFACTORY_DPC;Factory;Factory';

class rcfactory {
	
	var $title, $prpath, $urlpath, $url;

    function __construct() {
		
	  $this->prpath = paramload('SHELL','prpath');
      $this->urlpath = paramload('SHELL','urlpath');	
	  $this->url = paramload('SHELL','urlbase');
	  $this->title = localize('RCFACTORY_DPC',getlocal());	  
	}
	
    function event($event=null) {
	
	   $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   if ($login!='yes') return null;			

       if (!$this->msg) {
  
	     switch ($event) {
		 
		    case 'cpsubscribe'    : 				
	                                break;
		    case 'cpunsubscribe'  : 				
	                                break;									
	        case 'cpsubscribers'  :
			case 'cpfactory'     :
			default               :							  
         }
      }
    }	

    function action($action=null)  { 
	
	     $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	     if ($login!='yes') return null;

	     switch ($action) {
		   case 'cpadvsubscribe' : break;
		   default               : $out .= null;
		 }			 

	     return ($out);
	}	
					
};
}
?>