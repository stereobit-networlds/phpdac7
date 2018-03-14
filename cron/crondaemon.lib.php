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
		$sql = 'SELECT `id` FROM cronJob WHERE `pid` = '.$db->qstr(0).' AND `endTimestamp` = '.$db->qstr('0000-00-00 00:00:00');
		$rows = $db->GetCol($sql);
		if ($db->ErrorMsg()) {
			$this->writeLog('MySQL error: '.$db->ErrorMsg().' when _getJobs is called '.$sql);
			//$this->_kill(true);
			return false;
		}
		else {
			foreach((array)$rows as $cronJobId)  
				$jobs[] =& new cronjob($cronJobId);
			if (!empty($jobs)) 
				$this->writeLog('found jobs ('.count($jobs).'): '.implode(',',$rows));
			
			return $jobs;
		}	
	}
 
    protected function _startJobs() {

    	$this->writeLog('checking for jobs');
		
   		$jobs = $this->_getJobs();
		
    	foreach($jobs as $job) {
			
    	
	    	if (!empty($job->code)) {
				ob_start();
				eval($job->code);
				$results = ob_get_contents();
				ob_end_clean();
			}
			//$job =& new cronjob($job->id);
			$job->endTimestamp = time();
			if (!empty($results)) $job->results = $results;
			else $job->results = 'results were empty';
			$job->update();
			//$this->setFinished();
   		}
    }
	
	protected function writeLog($data = '') {
		if (empty($data)) return;

		$data = date('d-m-Y H:i:s')."\r\n" . $data . "\r\n----\r\n";
		$ret = file_put_contents($this->prpath . '/cron.log', $data, FILE_APPEND | LOCK_EX);
		
		return $ret;
	}	
}
?>