<?php
$__DPCSEC['CRMMODULE_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CRMMODULE_DPC")) && (seclevel('CRMMODULE_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CRMMODULE_DPC",true);

$__DPC['CRMMODULE_DPC'] = 'crmmodule';

class crmmodule  {

    var $title, $path;
	var $seclevid, $userDemoIds;
	
	var $module;
		
	function __construct() {
	
	  $this->path = paramload('SHELL','prpath'); 
	  
	  $this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
	  $this->userDemoIds = array(5,6,7,8); //8 
	  
	  $this->module = GetReq('data'); //as come from rccrm js
	}
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}	

	public function module_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
		
	}
		
	public function show_details($data=null) {
		
	}	
	
};
}
?>