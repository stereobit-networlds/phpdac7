<?php
/**
 * class Worker is the actual processor of jobs.
 *
 */
class worker {

	var $jobId 				= 0;
	var $code 				= '';
	var $concurrent			= false;
	var $implementationId	= 0;
    var $_finished			= false;
	

    function __construct($name) {

    }

    function run() {

        $this->execute();
    }

    /**
     * Get the local finished var
     *
     * @return boolean
     * @access public
     */
    function getFinished(){
    	//return $this->getVariable('_kill');
    }
    
    /**
     * Set this worker to finish. Tells the daemon that the work is done!
     *
     * @return boolean
     */
    function setFinished(){

    	//writeLog($this->getName().': finished executing... '.$this->jobId);
		//$this->_finished = true;
    	//$this->setVariable('_kill', 1);

    	return true;
    }
    
    /**
     * The actual execution happens right here
     *
     * @return void
     */
    function execute() {

    	/*if (!$this->_finished) {
	    	if (!empty($this->code)) {
				ob_start();
				eval($this->code);
				$results = ob_get_contents();
				ob_end_clean();
			}
			$job =& new cronjob($this->jobId);
			$job->endTimestamp = time();
			if (!empty($results)) $job->results = $results;
			else $job->results = 'results were empty';
			$job->update();
			$this->setFinished();
    	}*/
	}
}
?>