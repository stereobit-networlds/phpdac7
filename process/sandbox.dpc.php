<?php
$__DPCSEC['SANDBOX_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if (!defined("SANDBOX_DPC")) {
define("SANDBOX_DPC",true);

$__DPC['SANDBOX_DPC'] = 'sandbox';

$__EVENTS['SANDBOX_DPC'][0]= "sandbox";
$__EVENTS['SANDBOX_DPC'][1]= "process";

$__ACTIONS['SANDBOX_DPC'][0]= "sandbox";
$__ACTIONS['SANDBOX_DPC'][1]= "process";

//include process dpc at page

class sandbox extends Process\process {

	var $user, $seclevid, $pid, $status; //test

	public function __construct($p=null) {
		
	    //parent::__construct(); //no parent construct in this		
		
		$UserName = GetGlobal('UserName');		
		$UserSecID = GetGlobal('UserSecID');
		$this->user = decode($UserName);			
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : 
							($_SESSION['ADMINSecID'] ? $_SESSION['ADMINSecID'] :
								(((decode($UserSecID))) ? (decode($UserSecID)) : 0));		
		

		$this->pid = GetParam('pid');
		$this->pMethod = GetGlobal('processMethod');
		$this->status = _v('shcart.status');
		
		
		if ((defined('PROCESS_DPC')) && ($p))	{
			$this->process = new Process\process($this, $p, GetReq('t'));	
		}		
	}
	
	//called by controller after event
	public function processEvent($event=null) { 
		//echo 'Event:',$event;
		if ((defined('PROCESS_DPC')) &&
		    ($this->process instanceof Process\process)) { 
			$this->process->isFinished($event);
		}	
	}	
	
	public function event($event=null) {
		if (!$this->user) {
			if (defined('CMSLOGIN_DPC'))
				_m('cmslogin.event use cmslogin');
		}	
		else {		
			switch ($event) {
			case 'sandbox' : 
			case 'process' :	
			default        : 
				if ($this->isRunningProcess()) {
					//is running process
					print_r($_POST);
					//$this->stackPost();
				}
				else {	
					//command event
					switch ($this->pid) {
					case 'ppst' :	break;	
					case 'preg' :	break;
					
					default 	:	//echo '(' . $this->status . ')';
					}	
				}				
			}
		}	
	}
	
	public function action($action=null) {
		if (!$this->user) {
			//login page
			//$ret = $this->loadLoginForm();
			if (defined('CMSLOGIN_DPC'))
				$ret = _m('cmslogin.action use cmslogin');
		}	
		else {		
			switch ($action) {
			case 'sandbox' :
			case 'process' :
			default        : 
				if ($this->isClosedProcess()) {
					//process closed
					if (!$ret = self::getFormStack()) { //at last step
						$ret = $this->showProcess(null,99); //show prev steps
					}
				}		
				elseif ($this->isRunningProcess()) {
					//is running process	
					if (!$ret = $this->getFormStack()) {		
						$ret = $this->showProcess();
						$ret.= $this->stackCalc();
					}
				}
				else {
					//command action
					switch ($this->pid) {
					
					case 'ppst' :	$ret.= $this->stackViewPost();		
									break;
					case 'preg' :	$ret = ($this->stackRegister()) ? 'Registered' : 'Already registered or unable to store';
									$ret.= $this->stackView();
									break;
					case 'prun' :	$ret = ($rid = $this->stackRun()) ? 'Running: ' . $rid : 'Started';
									$ret.= $this->stackView();
									break;				
					case 'popn' :	$ret = $this->showOpenProcess();
									break;										
					case 'pcls' :	$ret = $this->showClosedProcess();
									break;										
					
					default 	:	$ret = $this->stackView(); //static call
					}				
				}
			}		
		}
		
		return ($ret);	
	}
	
	protected function stackViewPost() {
		print_r($_POST);
		return $this->stackView();
	}	
	
};
}
?>	