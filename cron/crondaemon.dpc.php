<?php

class crondaemon {
	
	var $name, $prpath;

    function __construct($name=null) {

		$this->name = $name ? $name : 'cdaemon';
		$this->prpath = paramload('SHELL','prpath');
		
    }

    public function run() {

     	$this->_processCronTabs();
       	$this->_startJobs();
    }
	
    protected function _processCronTabs() {
		$db = GetGlobal('db');
    	$sql = 'SELECT `id` FROM crontab';
    	foreach($db->GetCol($sql) as $crontabId) {
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
			return false;
		}
		else {
			foreach((array)$rows as $cronJobId)  
				$jobs[] = new cronjob($cronJobId);
			if (!empty($jobs)) 
				$this->writeLog('found jobs ('.count($jobs).'): '.implode(',',$rows));
			
			return $jobs;
		}	
	}
 
    protected function _startJobs() {

	    //$this->storeMessage('Cron started');
    	$this->writeLog('checking for jobs');
		
   		$jobs = $this->_getJobs();
		
    	foreach($jobs as $job) {
			
			$this->storeMessage('Cron job started');
    	
	    	if (!empty($job->code)) {
				
				$script = new cronscript();
				$results = $script->run($job->code);
			}

			$job->endTimestamp = time();
			
			//if (!empty($results)) 
			if ($results)	
				$job->results = $results;
			else 
				$job->results = 'error';//'results were empty';
			
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
}
?>