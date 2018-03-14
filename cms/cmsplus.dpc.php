<?php
$__DPCSEC['CMSPLUS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CMSPLUS_DPC")) && (seclevel('CMSPLUS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CMSPLUS_DPC",true);

$__DPC['CMSPLUS_DPC'] = 'cmsplus';

class cmsplus {

    var $appname, $urlpath, $prpath, $url;
	var $seclevid, $userDemoIds;
	var $cptemplate, $tpath, $template;
		
	function __construct() {
		
		$this->appname = paramload('ID','instancename');		
	
		$this->urlpath = paramload('SHELL','urlpath');
		$this->url = paramload('SHELL','urlbase');	
		$this->prpath = paramload('SHELL','prpath'); 
	  
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
		$this->userDemoIds = array(5,6,7,8); //8 
		
	    $tmpl = remote_paramload('FRONTHTMLPAGE','cptemplate',$this->prpath);  
	    $this->cptemplate = $tmpl ? $tmpl : 'metro';
		$this->tpath = remote_paramload('FRONTHTMLPAGE','path',$this->prpath);	
		$this->template = remote_paramload('FRONTHTMLPAGE','template',$this->prpath);			
	}
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}	

	public function isLevelUser($level=6) {
		return ($this->seclevid>=$level ? true : false);
	}		
};
}
?>