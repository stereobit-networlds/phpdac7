<?php
$__DPCSEC['RCCRON_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCCRON_DPC")) && (seclevel('RCCRON_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCCRON_DPC",true);

$__DPC['RCCRON_DPC'] = 'rccron';
 
$__EVENTS['RCCRON_DPC'][0]='cpcron';
$__EVENTS['RCCRON_DPC'][1]='cpjobsshow';
$__EVENTS['RCCRON_DPC'][2]='cpcronjobs';
$__EVENTS['RCCRON_DPC'][3]='cpjobcode';
$__EVENTS['RCCRON_DPC'][4]='cpjobcodesave';
$__EVENTS['RCCRON_DPC'][5]='cpjobcoderun';

$__ACTIONS['RCCRON_DPC'][0]='cpcron';
$__ACTIONS['RCCRON_DPC'][1]='cpjobsshow';
$__ACTIONS['RCCRON_DPC'][2]='cpcronjobs';
$__ACTIONS['RCCRON_DPC'][3]='cpjobcode';
$__ACTIONS['RCCRON_DPC'][4]='cpjobcodesave';
$__ACTIONS['RCCRON_DPC'][5]='cpjobcoderun';

//$__DPCATTR['RCCRON_DPC']['cpcron'] = 'cpcron,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCCRON_DPC'][0]='RCCRON_DPC;Cron;Cron';
$__LOCALE['RCCRON_DPC'][1]='_description;Job description;Περιγραφή εργασίας';
$__LOCALE['RCCRON_DPC'][2]='_concurrent;Concurrent;Concurrent';
$__LOCALE['RCCRON_DPC'][3]='_implementationId;Impl;Impl';
$__LOCALE['RCCRON_DPC'][4]='_cronDefinition;Settings;Ρυθμίσεις';
$__LOCALE['RCCRON_DPC'][5]='_startTimestamp;Start;Έναρξη';
$__LOCALE['RCCRON_DPC'][6]='_endTimestamp;End;Λήξη';
$__LOCALE['RCCRON_DPC'][7]='_results;Results;Αποτέλεσμα';
$__LOCALE['RCCRON_DPC'][8]='_pid;pid;pid';
$__LOCALE['RCCRON_DPC'][9]='_cronjob;Jobs;Εργασίες';
$__LOCALE['RCCRON_DPC'][10]='_code;Code;Κωδικός';
$__LOCALE['RCCRON_DPC'][11]='_id;ID;ID';
$__LOCALE['RCCRON_DPC'][12]='_title;Title;Τίτλος';
$__LOCALE['RCCRON_DPC'][13]='_type;Type;Τύπος';
$__LOCALE['RCCRON_DPC'][14]='_lastActualTimestamp;Lt;Lt';
$__LOCALE['RCCRON_DPC'][15]='_save;Save;Αποθήκευση';
$__LOCALE['RCCRON_DPC'][16]='_cron;Cron;Χρονισμός εργασιών';
$__LOCALE['RCCRON_DPC'][17]='_coderun;Test code;Έλεγχος εργασίας';

require_once(_r('cp/cpdac7.lib.php'));

class rccron extends cpdac7 {

    var $title, $path;
	var $seclevid, $userDemoIds;
	//var $dac7, $indac7, $dacEnv; //extended class
		
	function __construct() {
		
		parent::__construct();		
	
		$this->path = paramload('SHELL','prpath');
		$this->title = localize('RCCRON_DPC',getlocal());	 
	  
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
		$this->userDemoIds = array(5,6,7); //8 
		//echo $this->seclevid;    
	}
	
    function event($event=null) {
	
	   $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   if ($login!='yes') return null;		 
	
	   switch ($event) {
		 case 'cpjobcoderun' : $this->run_job_code(true);	
							   die('<br><br><br>End of task');	
		                       break;  
							   
		 case 'cpjobcodesave': $this->save_job_code();	
		                       break;  		   
		   							   
		 case 'cpjobcode'  : //die('saverel|test join cat');						   
							   //echo $this->loadsubframe();
		                       die();
							 
		 case 'cpjobsshow'   : //die('test-first-level');
		                       break;
		 case 'cpcronjobs'   : echo $this->loadframe();
		                       die();
							   break; 	   
	     case 'cpcron'       :
		 default             :  //when dac7 running fireup/exec cron with click
								//useful when no e-Enterprisr.printer is active 
								//and also usefull for system cron a cron call with silent-on enabled !! LOGIN ERR!!
		                        /*if ($this->dac7==true) {
									
									//execute long running processs	
									$cmd = 'async/ppost/cron_crondaemon/';
									phpdac7\getT($cmd); //exec cmd //and close tier
				
									$this->jsDialog('Start', localize('_cron', getlocal()), 3000);//, 'cdact.php?t=texit');
									//$this->messages[] = 'LRP started!';	
								}*/
								
								//extended class	
								//if ($this->execDac7cmd('async/ppost/cron_crondaemon/'))
									//$this->jsDialog('Start', localize('_cron', getlocal()), 3000);//, 'cdact.php?t=texit');	
								
								//if ($this->execDac7cmd('async/ppost/cron_crondaemon2/'))	
									//$this->jsDialog('Start', localize('_cron', getlocal()), 3000, 'cdact.php?t=texit');	
								
								//dac7 internal client...
	   }
			
    }   
	
    function action($action=null) {
		
	  $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	  if ($login!='yes') return null;	
	 
	  switch ($action) {

		 case 'cpjobcoderun'  : break;	 //died task
		 case 'cpjobcodesave' : 										  
		 case 'cpjobsshow'    : $out = $this->cronjobs_grid(null,140,5,'r', true);
								//$out .= "<div id='jobcode'></div>"; //2nd div inside this save	 
								$out .= $this->codeform();
							    break; 
		 case 'cpcronjobs'  : 
							  break;					  
	     case 'cpcron'      :

		 default            : // usefull for system cron a cron call with silend-on enabled LOGIN ERR!!
							  if ($silent = GetReq('silent')) {} 
							  else { 	
								$edit = _m("cmsrt.isLevelUser use 8") ? 'd' : 'e';
								$out .= "<div id='cronjobs'></div>";
								$out .= $this->crontab_grid(null,140,5,$edit, true);	
							  }
							  
	  }	 

	  return ($out);
    }
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}		

	protected function loadframe($ajaxdiv=null) {
		$id = GetParam('id');
		$bodyurl = seturl("t=cpjobsshow&iframe=1&id=$id");
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"540px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}		
	
	protected function crontab_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('RCCRON_DPC',getlocal()); //localize('_items', $lan);	

        $myfields = "id,title,description,code,concurrent,implementationId,cronDefinition,lastActualTimestamp";  		

		$xsSQL = 'select * from (select '.$myfields . ' from crontab) as o';
		  
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+id|".localize('_id',getlocal())."|2|0");	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+lastActualTimestamp|".localize('_lastActualTimestamp',getlocal())."|link|2|"."javascript:cronjobs(\"{id}\");".'||');
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+cronDefinition|".localize('_cronDefinition',getlocal()).'|5|1');			
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+title|".localize('_title',getlocal())."|5|1"); //"|link|5|"."javascript:cronjobs(\"{id}\");".'||');		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+description|".localize('_description',getlocal())."|19|1|");
		//GetGlobal('controller')->calldpc_method("mygrid.column use grid1+code|".localize('_code',getlocal()).'|20|1');	
	    GetGlobal('controller')->calldpc_method("mygrid.column use grid1+concurrent|".localize('_concurrent',getlocal())."|2|1|");				
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+implementationId|".localize('_implementationId',getlocal())."|2|1|");
		//GetGlobal('controller')->calldpc_method("mygrid.column use grid1+lastActualTimestamp|".localize('_lastActualTimestamp',getlocal()).'|5|0|');		
		$out = GetGlobal('controller')->calldpc_method("mygrid.grid use grid1+crontab+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width");
		
		return ($out);  	
	}
	
	
	protected function loadsubframe($ajaxdiv=null) {
		$id=GetParam('id');		
	    $bodyurl = seturl("t=cpjobcode&iframe=1&id=$id");
	
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"260px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}			
	
	
    protected function cronjobs_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
		$id = GetParam('id');
	    $height = $height ? $height : 440;
        $rows = $rows ? $rows : 18;
        $width = $width ? $width : null; //wide
        $mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;					
        $lan = getlocal() ? getlocal() : 0;
		$title = localize('_cronjob', $lan);	

		$xsSQL = "select * from (select id,startTimestamp,endTimestamp,code,concurrent,implementationId,results,pid from cronjob where crontabId=$id order by id desc) as o";
        //echo $xsSQL;
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+id|".localize('_id',getlocal())."|2|0|");	//"|link|10|"."javascript:jobcode(\"{id}\");".'||'
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+startTimestamp|".localize('_startTimestamp',getlocal())."|5|0");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+endTimestamp|".localize('_endTimestamp',getlocal())."|5|0");
	    //GetGlobal('controller')->calldpc_method("mygrid.column use grid2+code|".localize('_code',getlocal())."|10|0|");				
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+concurrent|".localize('_concurrent',getlocal())."|2|0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+implementationId|".localize('_implementationId',getlocal())."|2|0|");
	    GetGlobal('controller')->calldpc_method("mygrid.column use grid2+results|".localize('_results',getlocal()).'|5|0');	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+pid|".localize('_pid',getlocal()).'|2|0|');		

		$out .= GetGlobal('controller')->calldpc_method("mygrid.grid use grid2+cronjob+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
	    return ($out);
	
    }		
	
	
    protected function codeform($id=null)  { 
	    $id = GetParam('id');	
        $filename = seturl("t=cpjobcodesave");//&id=".$id);  
        $readonly = $this->isDemoUser() ? 'readonly' : null;  		
    
        $toprint  = "<FORM id=\"form1\" action=". "$filename" . " method=post>";
        $toprint .= "<P><FONT face=\"Arial, Helvetica, sans-serif\" size=1>";	   
        $toprint .= "<DIV class=\"monospace\"><TEXTAREA wrap='virtual' id='crondata' style=\"width:100%\" NAME=\"jobcmd\" ROWS=15 cols=60 wrap=\"virtual\" $readonly>"; 
	    $toprint .=  $this->load_job_code($id);		 
        $toprint .= "</TEXTAREA></DIV>";	   
	   
        if (!$this->isDemoUser()) {
			$toprint .= "<input type=\"hidden\" name=\"FormName\" value=\"savejobcode\">"; 
			$toprint .= "<input type=\"hidden\" name=\"id\" value=\"".$id."\">";
			$toprint .= "<INPUT type=\"submit\" name=\"submit\" value=\"" . localize('_save',getlocal()) . "\">&nbsp;";  
			$toprint .= "<INPUT type=\"hidden\" name=\"FormAction\" value=\"" . "cpjobcodesave" . "\">";
			
			//url to test code	
			$runcodeurl = seturl("t=cpjobcoderun&id=".$id); 
			$toprint .= "&nbsp;&nbsp;<h3><a href='$runcodeurl'>".localize('_coderun',getlocal())."</a></h3>";
	   	}    
        $toprint .= "</FONT></FORM>"; 

       return ($toprint);
    }	

	protected function load_job_code($id) {
		$db = GetGlobal('db'); 
		if (!$id) return;
		$sql = "select code from crontab where id=".$id;
		$result = $db->Execute($sql);
		
		return ($result->fields['code']);		
	}		
	
	protected function save_job_code() {
		$db = GetGlobal('db'); 
		if (!$id=GetParam('id')) return;
		$sql = "UPDATE crontab SET code=" . $db->qstr(GetParam('jobcmd')) . "where id=".$id;
		$result = $db->Execute($sql);

		return (true);		
	}		
	
	protected function run_job_code($verbose=false, $saverr=false) {
		if (!$id=GetParam('id')) return false;
		$script =  $this->load_job_code($id);
		
		echo '<br>' . $script;
		//require_once(_r('agents/pcntlui.dpc.php'));
		
		$ret = eval($script);
		//$ret = $this->testscript();
		echo '<br>result:' . $ret;
		return $id;
		
		if ($verbose)
			echo '<br>' . $script;
		
		
		if (class_exists('pcntl', true)) {
			if ($saverr)
				@file_put_contents($this->path . 'cronerr.txt', date('c') . PHP_EOL . "Script:" . PHP_EOL . $script . PHP_EOL);			
			
			set_time_limit(120);
			
			//$ret = eval($script);
			//if (($ret==false) && ($error = error_get_last())) 
			/*if (!$ret = eval($script))	
			{  
				$error = error_get_last();
				if ($verbose)
					echo '<br>' . $error;				
				if ($saverr)
					@file_put_contents($this->path . '/cronerr.txt', $error . PHP_EOL);
						
				//$ret = true; //bypass					
			}
			//test*/
			//$ret = $this->testscript();
			
			set_time_limit(ini_get('max_execution_time'));
			
			if ($verbose)
				echo '<br>' . date('c') . " End of run";
			if ($saverr)
				@file_put_contents($this->path . 'cronerr.txt', date('c') . " End of run" . PHP_EOL);			
						
		}

		if ($verbose)
			echo date('c') . "<br> Class pcntl not exist";
		if ($saverr)
			@file_put_contents($this->path . 'cronerr.txt', date('c') . " Class pcntl not exist" . PHP_EOL);			
							
		
		return (true);		
	}	

	protected function testscript() {
			$page = new pcntl('
load_extension adodb refby _ADODB_; 
super database;
',0,1);				
			$db = GetGlobal('db');
			$now = date("Y-m-d H:m:s");
			$sSQL = "insert into syncsql (fid,status,date,execdate,sqlres,sqlquery,reference) values (1,1,'$now','$now',''," .
					$db->qstr(0) . "," . $db->qstr('e-Enterprise') . ")"; 
	
			$ret = $db->Execute($sSQL,1);
			
			return (true);	
	}	
	
	protected function testscript2() {				
			$db = GetGlobal('db');
			$now = date("Y-m-d H:m:s");
			$sSQL = "insert into syncsql (fid,status,date,execdate,sqlres,sqlquery,reference) values (1,1,'$now','$now',''," .
					$db->qstr(0) . "," . $db->qstr('cron') . ")"; 
			$ret = $db->Execute($sSQL,1);
			
			return (true);	
	}	
};
}
?>