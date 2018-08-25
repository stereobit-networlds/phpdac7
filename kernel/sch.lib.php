<?php
/**
 * This file is part of phpdac7.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    balexiou<balexiou@stereobit.com>
 * @copyright balexiou<balexiou@stereobit.com>
 * @link      http://www.stereobit.com/php-dac7.php
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
$__DPCSEC['SCHEDULER_DPC']='1;1;1;1;1;1;1;1;2';

if (!defined("SCHEDULER_DPC")) {
define("SCHEDULER_DPC",true);

$__DPC['SCHEDULER_DPC'] = 'scheduler';

class scheduler {

    public $env;
	public $timeline, $loadmem;
 
    public function __construct($env=null) {
   
 		$this->env = $env;
		
		//$this->timeline = array();		
		//$this->loadmem = false;
		$this->loadmem = $this->readSchedules();
		register_tick_function(array($this,"checkschedules"),true);	 	 		
    }
   
    //!!!
	public function agents() {
	
		print_r($this->env->agn_addr);
	}   

	private function readSchedules()
	{
		$savedSchedules = json_decode($this->env->read('srvSchedules'),true);
		if (!empty($savedSchedules))
		{
			//print_r($savedSchedules);
			return true;
		}
		return false;
	}
   
	public function schedule($agent,$frequency,$time) {
	   	//saved timeline
		$tmline = json_decode($this->env->read('srvSchedules'), true);	 
			
		if ($this->findschedule($agent, $tmline)==true)
			return false;
	 
		//echo $agent. "," . $frequency . "," , $time, "," ,">>>>>>>\n";	 
		//print_r($tmline[$agent]);
	 
		$schedules = array();
		$schedules['agent'] = $agent;
	 
		switch ($frequency) 
		{
			case 'at'    : $schedules['freq'] = 0; break; //once
			case 'every' : $schedules['freq'] = 1; break; //cycle
			default      : $schedules['freq'] =-1; break; //now
		}
	 
		$schedules['time'] = $time;
	 
		$timein = microtime();// + rand(10,1000); 
		//due to speed up it is possible to have
		//multiple schedules entry in the same time, so add 1 sec
		/*if (array_key_exists($timein, $this->timeline))
			$this->timeline[] = $schedules;  	
		else
			$this->timeline[] = $schedules;
		*/
		//$tmline[$timein] = $schedules; //!!!
		$tmline[] = $schedules;
		//print_r($schedules);
		
		$this->env->save('srvSchedules', json_encode($tmline));

		//$this->env->update_agent($this,'scheduler'); must called by caller to update env
		//print_r($this->timeline); //test scheduler
		//var_dump($this);
	 
		$this->env->update_agent($this,'scheduler');
	 
		//re-register
		//unregister_tick_function(array($this,"checkschedules"));
		//register_tick_function(array($this,"checkschedules"),true);	 	 
	 
		return (implode("\t", $schedules));//true;
	}
   
	public function checkschedules() {
 
		$newtmline = array();
		$savesh = array();
		$error = null;
	    $savesh = array(); 
		$tmline = json_decode($this->env->read('srvSchedules'), true);
		
		foreach ($tmline as $inittime => $entry) {
	   
			list($save, $newsh) = $this->check_schedule_entry($entry, $inittime);
			$savesh[] = $save;
			//print_r($newsh);echo 'cccc';
	   
			if (is_array($newsh)) 
				$newtmline[$inittime] = $newsh;
			//else
				//$error = $newsh;	 
			/*
			if (!empty(array_diff($entry, $newsh)))
				//$newtmline[$inittime] = $newsh;
				print_r($newsh);
			else
				echo '.';*/
		 
		}
	 
		//print_r($newtmline);
		//reconf timeline
		if (!empty($newtmline))
		{ 
			//print_r($savesh);
			//save only when there is data modification
			if (array_sum($savesh) > 0) 
			{
				//$this->timeline = (array)$newtmline;
				$this->env->save('srvSchedules', json_encode($newtmline));
				//print_r(json_decode($this->env->read('srvSchedules'),true));
			}
		} 
	   
		$ret = $error. '> check schedules... '. time();  
		return ($ret); 		
	}
   
	public function check_schedule_entry(&$entry, $inittime) {  
     //echo $this->env->get_agent('scheduledtask')->value;
	 //echo ".\n";   
   
     if (array_key_exists('lasttime',$entry))
	   $last_time = $entry['lasttime'];
	 else
	   $last_time = $inittime;
	  
	 $now = time();  
	 if ($now-$last_time >= $entry['time']) {
		 
	   $str = explode(' ',$entry['agent']);
	   $agn = explode('.',$str[0]);
	   $agent = $agn[0];
	   $cmd = $agn[1]; 
	   $p1 = $str[1];
	   $p2 = $str[2];
	   $p3 = $str[3];		 
	 
	   //echo $agent,"...\n";
	   //in case of 'env' execute from env'
	   if (($agent=='env') && (method_exists($this->env,$cmd))) {
		   
			$this->env->cnf->_say("$agent.". $cmd, 'TYPE_CAT');
			
			$ret = $this->env->$cmd($p1,$p2,$p3); 
			$this->env->dmn->Println ($ret);

			$entry['lasttime'] = $now;
			$entry['counter'] = $entry['counter']+1;
		  
			//$this->env->update_agent($this,'scheduler');		  
	   
			return ($entry['freq']==0) ? 0 : array(1, $entry);//once or new array element 			   
	   }
	   else {
			$o_agent = $this->env->get_agent($agent);	
			//print_r($o_agent);
			if ((is_object($o_agent)) && (method_exists($o_agent,$cmd))) {   
			
				$this->env->cnf->_say("$agent.". $cmd, 'TYPE_CAT');
				
				if (method_exists($o_agent,$cmd)) 
					$ret = $o_agent->$cmd($p1,$p2,$p3);
				else
					$ret = "Invalid command.\n" . implode("\n",get_class_methods($o_agent)) . "\n";  
		  
				$this->env->dmn->Println($ret);  
	   	   
				$entry['lasttime'] = $now;
				$entry['counter'] = $entry['counter']+1;
		  
				//$this->env->update_agent($this,'scheduler');		  
	   
				return ($entry['freq']==0) ? 0 : array(1, $entry);//once or new array element 	   
			}
			else {
				//dmn dispatch, batch files, commands, etc
				$cmd = str_replace("\\"," ",$entry['agent']);
				$this->env->cnf->_say($entry['agent'] .".". $cmd, 'TYPE_CAT');				
				
				$this->env->dmn->dispatch(str_replace("\\"," ",$entry['agent']),null); 
								
				$entry['lasttime'] = $now;
				$entry['counter'] = $entry['counter']+1;
		  
				//$this->env->update_agent($this,'scheduler');		  
	   
				return ($entry['freq']==0) ? 0 : array(1, $entry);//once or new array element			 
			}
	   }	           
     }
	 else
		//return not scheduled yet entries (as is)	   
		return array(0, $entry);//not executed yet 
  }
  
	public function findschedule($agent=null, $schedules=null) {
		if (!$agent) return false;
		$tmline = isset($schedules) ? $schedules :
					json_decode($this->env->read('srvSchedules'), true);		
	  
		if (empty($tmline)) return false;
		
		foreach ($tmline as $inittime=>$entry) {

			if (strstr($entry['agent'],"\\")) {
				//cut cmd params
				$arg = explode("\\",$entry['agent']);
				$ca = $arg[1];//$arg[0] . "\\" . $arg[1];
				if (strstr($ca,$agent))
					return true;
			}
			else {
				if (strstr($agent,$entry['agent']))
					return true;
			}
		}	
	  
		return false; 
	}

	//show the schedules
	public function showschedules($titles = null) {
	  
		$tmline = json_decode($this->env->read('srvSchedules'), true); 
		$header= true;
	 
		//echo "Schedules\n";
		foreach ($tmline as $t=>$d) {
			if ($header) {	
			
				$htitles = is_array($titles) ? $titles : array_keys($d);	
				$this->env->_say(implode("\t", $htitles), 'TYPE_CAT');	 	
				$header = false;
			}			
		
			if (strstr($d['agent'],"\\")) {	
				//cut cmd params
				$arg = explode("\\",$d['agent']);
				$agent = $arg[1];//$arg[0] . "\\" . $arg[1];
				$u = isset($arg[2]) ? '*' : null; //username
				$p = isset($arg[3]) ? '*' : null; //password
				$this->env->_say($agent.$u.$p . "\t" . $d['freq'] . "\t" . 
					$d['time']. "\t" . $d['lasttime'] . "\t" . 
					$d['counter'], 'TYPE_CAT');
				unset($arg);	
			}
			else
				$this->env->_say(implode("\t",$d), 'TYPE_CAT');	
		}  
	 
		return (array) $tmline;  
	}
  
	public function __destruct() {
  
		unregister_tick_function(array($this,'checkschedules'));  
	}
  	 
};
}