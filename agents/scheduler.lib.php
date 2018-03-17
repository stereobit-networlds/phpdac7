<?php
$__DPCSEC['SCHEDULER_DPC']='1;1;1;1;1;1;1;1;2';

if (!defined("SCHEDULER_DPC")) {
define("SCHEDULER_DPC",true);

$__DPC['SCHEDULER_DPC'] = 'scheduler';

class scheduler {

   var $timeline, $env;
 
   function __construct($env=null) {
   
	 //var_dump($env->agn_addr);   
   
     $this->timeline = array();
	 $this->env = $env;
	 
	 //no need (see schedule method)
     //register_tick_function(array($this,"checkschedules"),true);		 
   }
   
	function agents() {
	
	  print_r($this->env->agn_addr);
	}   
   
   public function schedule($agent,$frequency,$time) {
	   
	 if ($this->findschedule($agent)==true)
		 return false;
	 
	 //echo $agent. "," . $frequency . "," , $time, "," ,">>>>>>>\n";	 
	 
     $schedules = array();
     $schedules['agent'] = $agent;
	 
	 switch ($frequency) {
		case 'at'    : $schedules['freq'] = 0; break; //once
		case 'every' : $schedules['freq'] = 1; break; //cycle
		default      : $schedules['freq'] =-1; break; //now
 	 }
	 
	 $schedules['time'] = $time;
	 
	 //$timein = time();// + rand(10,1000); 
	 //due to speed up it is possible to have
	 //multiple schedules entry in the same time, so add 1 sec
	 if (array_key_exists($timein,$this->timeline))
	   $this->timeline[] = $schedules;  	
	 else
	   $this->timeline[] = $schedules; 
	 
	 //$this->env->update_agent($this,'scheduler'); must called by caller to update env
	 //print_r($this->timeline); //test scheduler
	 //var_dump($this);
	 
	 $this->env->update_agent($this,'scheduler');
	 
	 //re-register
	 unregister_tick_function(array($this,"checkschedules"));
     register_tick_function(array($this,"checkschedules"),true);	 	 
	 
	 return (implode("\t", $schedules));//true;
   }
   
   public function checkschedules() {
   
     //echo "check schedules....";
	 //print_r($this->timeline);	 
	 //echo time(),"\n"; 	 
	 
	 $new_timeline = array();
	 $error = null;
	 
	 foreach ($this->timeline as $inittime=>$entry) {
	   
	   $new_element = $this->check_schedule_entry($entry,$inittime);
	   //print_r($new_element);echo 'cccc';
	   
	   if (is_array($new_element)) 
		 $new_timeline[$inittime] = $new_element;
	   else
	     $error = $new_element;	 
	 }
	 
	 //print_r($new_timeline);
	 //reconf timeline
	 //$this->timeline = null;
	 if (!empty($new_timeline))
	   $this->timeline = (array)$new_timeline;
	   
	 $ret = $error. '> check schedules... '. time();  
	 return ($ret);  
   }
   
   function check_schedule_entry(&$entry,$inittime) {  
   
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

			$ret = $this->env->$cmd($p1,$p2,$p3); 
			$this->env->dmn->Println ($ret);

			$entry['lasttime'] = $now;
			$entry['counter'] = $entry['counter']+1;
		  
			//$this->env->update_agent($this,'scheduler');		  
	   
			return ($entry['freq']==0) ? 0 : $entry;//once or new array element 			   
	   }
	   else {
			$o_agent = $this->env->get_agent($agent);	 
			//print_r($o_agent);
			if ((is_object($o_agent)) && (method_exists($o_agent,$cmd))) {   

				if (method_exists($o_agent,$cmd)) 
					$ret = $o_agent->$cmd($p1,$p2,$p3);
				else
					$ret = "Invalid command.\n" . implode("\n",get_class_methods($o_agent)) . "\n";  
		  
				$this->env->dmn->Println($ret);  
	   	   
				$entry['lasttime'] = $now;
				$entry['counter'] = $entry['counter']+1;
		  
				//$this->env->update_agent($this,'scheduler');		  
	   
				return ($entry['freq']==0) ? 0 : $entry;//once or new array element 	   
			}
			else {
				//dmn dispatch, batch files, commands, etc
				$cmd = str_replace("\\"," ",$entry['agent']);
				$this->env->dmn->dispatch(str_replace("\\"," ",$entry['agent']),null); 

				$entry['lasttime'] = $now;
				$entry['counter'] = $entry['counter']+1;
		  
				//$this->env->update_agent($this,'scheduler');		  
	   
				return ($entry['freq']==0) ? 0 : $entry;//once or new array element			 
			}
	   }	           
     }
	 else
	   //return not scheduled yet entries (as is)	   
	   return ($entry);//not executed yet 
  }
  
  function findschedule($agent=null) {
	  if (!$agent) return false;
	  
	  foreach ($this->timeline as $inittime=>$entry) {
		/*
		$str = explode(' ',$entry['agent']);
		$ca = (is_array($str)) ? $str[0] : $str;
		if ($ca==$agent)*/

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
  
  public function overwriteschedules(&$sh=null) {
	  if (!empty($sh)) {
		  
		$this->timeline = $sh;
		return true;
	  }
	  return false;	
  }
  
  //show the schedules running ........
  function showschedules() {
     $header= true;
     echo "Schedules\n";
     foreach ($this->timeline as $t=>$d) {
	   if ($header) {		
			echo implode("\t",array_keys($d)) ."\n";	 	
			$header = false;
	   }			

	   if (strstr($d['agent'],"\\")) {	
			//cut cmd params
			$arg = explode("\\",$d['agent']);
			$agent = $arg[1];//$arg[0] . "\\" . $arg[1];
			$u = isset($arg[2]) ? '*' : null; //username
			$p = isset($arg[3]) ? '*' : null; //password
			echo $agent.$u.$p . "\t" . $d['freq'] . "\t" . 
				$d['time']. "\t" . $d['lasttime'] . "\t" . 
				$d['counter'] ."\n";
			unset($arg);	
	   }
	   else
		  echo implode("\t",$d) . "\n";	
	 }  
	 
     return ($this->timeline);  
  }
  
  function __destruct() {
  
	  unregister_tick_function(array($this,'checkschedules'));  
  }
  	 
};
}
?>