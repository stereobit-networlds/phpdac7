<?php

class crondaemon {
	
	var $name, $prpath, $masterEnv;
	var $dac7, $indac7, $dacEnv;

    function __construct(& $env=null, $name=null) {

		$this->name = $name ? $name : 'cdaemon';
		$this->prpath = paramload('SHELL','prpath');
		
		$this->dac7 = _m('cmsrt.isDacRunning');
		$this->indac7 = _m('cmsrt.runningInsideDac');
		//$this->dacEnv = GetGlobal('controller')->env;			
		
		$this->masterEnv = $env; //run inside dac		
    }

    public function run() {
		
		//if (class_exists('pcntlui', true)) {
		if ($this->indac7) {
			//if (method_exists($this->dacEnv, '_say')) {	
			if ((is_object($this->masterEnv)) && (method_exists($this->masterEnv, '_say'))) {
				
				//$this->_echo('Environment is valid!', 'TYPE_IRON');
				
				$this->_processCronTabs();
				$this->_startJobs();
				
				return true;
			}	
			//else
			$this->_echo('INVALID ENV!', 'TYPE_DOG');
			return false;
		}
		//else exec jobs outside dacEnv	
     	$this->_processCronTabs();
       	$this->_startJobs();
		
		return true;
    }
	
    protected function _processCronTabs() {
		$db = GetGlobal('db');
		
		$this->_echo('Process Cron Tabs', 'TYPE_IRON');
		
    	$sql = 'SELECT `id` FROM crontab';
    	foreach($db->GetCol($sql) as $crontabId) {
			
			//$this->_echo('Cron Tab: ' . $crontabId, 'TYPE_IRON');
			
    		$crontab = new crontab($crontabId);
    		if (is_a($crontab, 'crontab')) $crontab->process();
    	}
    }	
    
	protected function _getJobs() {
    	$db = GetGlobal('db');
		
    	$jobs = array();
		$sql = 'SELECT `id` FROM cronjob WHERE `pid` = '.$db->qstr(0).' AND `endTimestamp` = '.$db->qstr('0000-00-00 00:00:00');
		
		$rows = $db->GetCol($sql);
		if ($db->ErrorMsg()) {
			
			$this->writeLog('MySQL error: '.$db->ErrorMsg().' when _getJobs is called '.$sql);
			$this->_echo('Db error:'. $db->ErrorMsg(), 'TYPE_IRON');
			
			return false;
		}
		else {
			foreach((array)$rows as $cronJobId)  
				$jobs[] = new cronjob($cronJobId);
			if (!empty($jobs)) {
				
				$this->writeLog('found jobs ('.count($jobs).'): '.implode(',',$rows));
				$this->_echo('found jobs ('.count($jobs).'): '.implode(',',$rows), 'TYPE_IRON');
			}	
			
			return $jobs;
		}	
	}
 
    protected function _startJobs() {

	    //$this->storeMessage('Cron started');
    	$this->writeLog('checking for jobs');
		
   		$jobs = $this->_getJobs();
		
    	foreach($jobs as $jid=>$job) {
			
			$this->storeMessage("Cron job $jid started");
    	
	    	if (!empty($job->code)) {
				
				$script = new cronscript($this->masterEnv);
				$results = $script->run($job->code, true);
			}

			$job->endTimestamp = time();
			
			//if (!empty($results)) 
			if ($results) {	
				$job->results = $results;
				
				$this->_echo('JobID:'.$jid . ' => ' . $results, 'TYPE_IRON');
			}	
			else {
				$job->results = 'error';//'results were empty';
				
				$this->_echo('JobID:'.$jid . ' => Error!', 'TYPE_IRON');
			}	
			
			$job->update();
   		}
		
    }
	
	protected function writeLog($data = '') {
		if (empty($data)) return;

		$data = date('d-m-Y H:i:s')."\r\n" . $data . "\r\n----\r\n";
		$ret = file_put_contents($this->prpath . '/cron.log', $data, FILE_APPEND | LOCK_EX);
		
		return $ret;
	}	
	
	protected function storeMessage($message=null, $alert=false, $flag=null) {
		$db = GetGlobal('db');	
		if (empty($message)) return null;
		$f = $flag ? $flag : 'info';
		
	    $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if (($alert==true) && ($login=='yes') && defined('RCCONTROLPANEL_DPC')) {
			//set message at session
			$time = time();
			$saytime = GetGlobal('controller')->calldpc_method("rccontrolpanel.timeSayWhen use $time");
			$msg = "$f|" . $message . "|$saytime"; //|cptransactions.php";
			GetGlobal('controller')->calldpc_method("rccontrolpanel.setMessage use $msg+1");
			return true;	
        }			
		//else
		//insert message into db directly (!!! better)
		$sSQL = "insert into cpmessages (hash, msg, type, owner) values (";
		$sSQL.= $db->qstr(md5($message)) . ",";
		$sSQL.= $db->qstr($message) . ",";
		$sSQL.= $db->qstr('cron') . ",";
		$sSQL.= $db->qstr('cron');
		$sSQL.= ")";
		//echo $sSQL;
		$result = $db->Execute($sSQL,1);
		
		return true;
    }

	//say a message 
	protected function _echo($message=null, $type='TYPE_IRON') {
		if (!$message) return false;
		
		if ($this->indac7==true) { 
		
			//if (method_exists($this->dacEnv, '_say'))
				//$this->dacEnv->_say($message, $type);
			if ((is_object($this->masterEnv)) && (method_exists($this->masterEnv, '_say')))	
				$this->masterEnv->_say($message, $type);				
			else
				echo '[----]' . $message . PHP_EOL;
			
			return true;
		}
		
		return false;
	}	
}
?>