<?php
$__DPCSEC['RCDAC7_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCDAC7_DPC")) && (seclevel('RCDAC7_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCDAC7_DPC",true);

$__DPC['RCDAC7_DPC'] = 'rcdac7';
 
$__EVENTS['RCDAC7_DPC'][0]='cpdac7';

$__ACTIONS['RCDAC7_DPC'][0]='cpdac7';

//$__DPCATTR['RCDAC7_DPC']['cpdac7'] = 'cpdac7,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCDAC7_DPC'][0]='RCDAC7_DPC;Dac7;Dac7';
$__LOCALE['RCDAC7_DPC'][2]='_cpdac7;Dac7;Dac7 Χρονισμός εργασιών';

require_once(_r('cp/cpdac7.lib.php'));

class rcdac7 extends cpdac7 {

    var $title, $path;
	var $seclevid, $userDemoIds;
		
	function __construct() {
	
		$this->path = paramload('SHELL','prpath');
		$this->title = localize('RCDAC7_DPC',getlocal());	 
	  
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
		$this->userDemoIds = array(5,6,7); //8 

		parent::__construct();
	}
	
    function event($event=null) {
	   //DISABLE LOGIN, FREE EXEC FROM CRON
	   //$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   //if ($login!='yes') return null;		 
	
	   switch ($event) {
   
	     case 'cpdac7'       :
		 default             :  if (($cmd = GetReq('dac7cmd')) && ($this->execDac7cmd($cmd)))
									$this->jsDialog('Start', localize('RCDAC7_DPC', getlocal()), 3000);//, 'cdact.php?t=texit');	
								    //{}	
	   }	
			
    }   
	
    function action($action=null) {
	  //DISABLE LOGIN, FREE EXEC FROM CRON	
	  //$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	  //if ($login!='yes') return null;	
	 
	  switch ($action) {
			
					  
	     case 'cpdac7'      :
		 default            : $out = GetReq('dac7cmd');
							  
	  }	 

	  return ($out);
    }
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}		
};
}
?>