<?php

class cpdac7 {

	var $dac7, $indac7, $dacEnv, $cookiepath;
		
	function __construct() {
	
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
		$this->userDemoIds = array(5,6,7); //8 
		//echo $this->seclevid;  
	  
		$this->dac7 = _m('cmsrt.isDacRunning');
		$this->indac7 = _m('cmsrt.runningInsideDac');
		$this->dacEnv = GetGlobal('controller')->env;

		$this->cookiepath = paramload('SHELL','prpath');	
	}
	
    public function execDac7cmd($cmd=null, $cookievalues=null) {	
	
	   if (($this->dac7==true) && ($cmd)) {
		   
		    if ($cookievalues) {
				//save cookie params for dac-7 cmd
				file_put_contents($this->cookiepath . '/_cookie.txt', $cookievalues, LOCK_EX);					
			}	
									
			phpdac7\getT($cmd);
			
			return true;
		}		
	  	return false;
    }   
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}		
		
	protected function jsDialog($text=null, $title=null, $time=null, $source=null) {
	   $stay = $time ? $time : 3000;//2000;

       if (defined('JSDIALOGSTREAMSRV_DPC')) {
			$sd = new jsdialogStreamSrv();
			//$ret= $sd->streamDialog();
			
			if ($text)	
				$code = $sd->say($text, $title, $source, $stay);
			else
				$code = $sd->streamDialog('jsdtime');
		   
			$js = new jscript;	
			$js->load_js($code,null,1);		
			unset ($js);
	   }	
	}

	public function streamDialog() {
		
		if (defined('RCPMENU_DPC'))
			return _m('rcpmenu.streamDialog');
		
		return null;
	}	
	
	//say a message 
	protected function _echo($message=null, $type='TYPE_IRON') {
		if (!$message) return false;
		
		if ($this->indac7==true) { 
		
			if (method_exists($this->dacEnv, '_say'))
				$this->dacEnv->_say($message, $type);				
			//else
				//echo '_echo:' . $message . PHP_EOL;
			
			return true;
		}
		
		return false;
	}	
}
?>