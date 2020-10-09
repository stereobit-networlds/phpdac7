<?php

class cronscript {
	
	var $name, $prpath, $masterEnv;
	//var $dac7, $indac7, $dacEnv;

    function __construct(& $env=null, $name=null) {

		$this->name = $name ? $name : 'cscript';
		$this->prpath = paramload('SHELL','prpath');
		
		$this->dac7 = _m('cmsrt.isDacRunning');
		$this->indac7 = _m('cmsrt.runningInsideDac');
		$this->dacEnv = GetGlobal('controller')->env;			
		
		$this->masterEnv = $env; //run inside dac		
    }

    public function run($script=null, $saverr=false) {
		if (!$script) {
			
			if ($saverr)
				@file_put_contents($this->prpath . 'cronerr.txt', date('c') . PHP_EOL . "No script to run" . PHP_EOL . $script . PHP_EOL);			
			
			
			$this->writeLog('No script to run.');
			return false;	
		}
		
		$ret = null;
		
		//if (class_exists('pcntlui', true)) {
			//$this->_echo('Init pcntlui...', 'TYPE_IRON');	
			
			if ($saverr)
				@file_put_contents($this->prpath . 'cronerr.txt', date('c') . PHP_EOL . "Script:" . PHP_EOL . $script . PHP_EOL);			
			
			$this->writeLog($script);
			
			if ($this->indac7 == false) {
				set_time_limit(120);
			}	
			

			try {
				
				$ret = eval($script);	
			} 
			catch (ParseError $e) 				
			{
 
				$error = $e;//error_get_last();
				$this->_echo('Script error: ' . $error, 'TYPE_IRON');
				
				if ($saverr)
					@file_put_contents($this->prpath . '/cronerr.txt', $error . PHP_EOL);
					
				$this->writeLog("\r\nError:". $error . PHP_EOL);		
				//$ret = true; //bypass					
			}
			//test
			//$ret = $this->testscript();
			
			if ($this->indac7 == false) {
				set_time_limit(ini_get('max_execution_time'));
			}
			
			if ($saverr)
				@file_put_contents($this->prpath . 'cronerr.txt', date('c') . "End of run". PHP_EOL);			
						
		/*}
		else {
			$this->_echo('Init pcntlui...failed!', 'TYPE_IRON');
			if ($saverr)
				@file_put_contents($this->prpath . 'cronerr.txt', date('c') . PHP_EOL . "Class pcntl not exist" . PHP_EOL . $script . PHP_EOL);			
		}*/			
		
		return ($ret ? $ret : false);
    }
	
	protected function testscript() {
			$page = new pcntlui(null,'
load_extension adodb refby _ADODB_; 
super database;
',0,1,'/var/www/html/');				
			$db = GetGlobal('db');
			$now = date("Y-m-d H:m:s");
			$sSQL = "insert into syncsql (fid,status,date,execdate,sqlres,sqlquery,reference) values (1,1,'$now','$now',''," .
					$db->qstr(0) . "," . $db->qstr('e-Enterprise') . ")"; 
			$ret = $db->Execute($sSQL,1);
			
			//$this->writeLog('Script:'.$sSQL;);	
			return ($ret);	
	}
	
	
	protected function writeLog($data = '') {
		if (empty($data)) return;

		$data = date('d-m-Y H:i:s')."\r\n" . $data . "\r\n----\r\n";
		$ret = @file_put_contents($this->prpath . '/cron.log', $data, FILE_APPEND | LOCK_EX);
		
		return $ret;
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