<?php
$__DPCSEC['RCREPLICA_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCREPLICA_DPC")) && (seclevel('RCREPLICA_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCREPLICA_DPC",true);

$__DPC['RCREPLICA_DPC'] = 'rcreplica';
 
$__EVENTS['RCREPLICA_DPC'][0]='cpreplica';
$__EVENTS['RCREPLICA_DPC'][1]='cpreplfile';
$__EVENTS['RCREPLICA_DPC'][2]='cpreplsql';
$__EVENTS['RCREPLICA_DPC'][3]='cpdorepfile';
$__EVENTS['RCREPLICA_DPC'][4]='cpdorepsql';
$__EVENTS['RCREPLICA_DPC'][5]='cpdorepall';

$__ACTIONS['RCREPLICA_DPC'][0]='cpreplica';
$__ACTIONS['RCREPLICA_DPC'][1]='cpreplfile';
$__ACTIONS['RCREPLICA_DPC'][2]='cpreplsql';
$__ACTIONS['RCREPLICA_DPC'][3]='cpdorepfile';
$__ACTIONS['RCREPLICA_DPC'][4]='cpdorepsql';
$__ACTIONS['RCREPLICA_DPC'][5]='cpdorepall';

//$__DPCATTR['RCREPLICA_DPC']['cpreplica'] = 'cpreplica,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCREPLICA_DPC'][0]='RCREPLICA_DPC;Replication;Replication';
$__LOCALE['RCREPLICA_DPC'][1]='_stamp;Stamp;Stamp';
$__LOCALE['RCREPLICA_DPC'][2]='_status;Status;Κατάσταση';
$__LOCALE['RCREPLICA_DPC'][3]='_filepath;Object;Στοιχείο';
$__LOCALE['RCREPLICA_DPC'][4]='_filemod;Date modified;Ημερομηνία αλλαγής';
$__LOCALE['RCREPLICA_DPC'][5]='_results;Results;Αποτέλεσμα';
$__LOCALE['RCREPLICA_DPC'][6]='_code;Code;Κωδικός';
$__LOCALE['RCREPLICA_DPC'][7]='_id;ID;ID';
$__LOCALE['RCREPLICA_DPC'][8]='_save;Save;Αποθήκευση';
$__LOCALE['RCREPLICA_DPC'][9]='_date;Date;Ημερ.';
$__LOCALE['RCREPLICA_DPC'][10]='_time;Time;Ώρα';
$__LOCALE['RCREPLICA_DPC'][11]='_status;Status;Φάση';
$__LOCALE['RCREPLICA_DPC'][12]='_fid;id;id';
$__LOCALE['RCREPLICA_DPC'][13]='_savesql;Save;Save';
$__LOCALE['RCREPLICA_DPC'][14]='_SQL;SQL Query;SQL Query';
$__LOCALE['RCREPLICA_DPC'][15]='_xdate;X Date;X Date';
$__LOCALE['RCREPLICA_DPC'][16]='_ref;Reference;Reference';
$__LOCALE['RCREPLICA_DPC'][17]='_sqlres;Res;Res';
$__LOCALE['RCREPLICA_DPC'][18]='_query;Query;Query';
$__LOCALE['RCREPLICA_DPC'][19]='_acct;Acct;Acct';
$__LOCALE['RCREPLICA_DPC'][20]='_files;Files;Αρχεία';
$__LOCALE['RCREPLICA_DPC'][21]='_sql;Database;Βάση δεδομένων';
$__LOCALE['RCREPLICA_DPC'][22]='_runday;Run 1 day back;Εκτέλεση για 1 ημέρα πριν';
$__LOCALE['RCREPLICA_DPC'][23]='_runtoday;Run today;Εκτέλεση για σήμερα';
$__LOCALE['RCREPLICA_DPC'][24]='_runweek;Run 1 week back;Εκτέλεση για μια εβδομάδα πριν';
$__LOCALE['RCREPLICA_DPC'][25]='_runmonth;Run 1 month back;Εκτέλεση για ενα μήνα πρίν';
$__LOCALE['RCREPLICA_DPC'][26]='_runall;Run all;Εκτέλεση όλων';
$__LOCALE['RCREPLICA_DPC'][27]='_mode;Mode;Επιλογή';
$__LOCALE['RCREPLICA_DPC'][28]='_actions;Actions;Ενέργειες';

require_once(_r('cp/cpdac7.lib.php'));

class rcreplica extends cpdac7 {

    var $title, $path, $urlpath;
	var $seclevid, $userDemoIds;
		
	function __construct() {
		
		parent::__construct();
	
		$this->path = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		$this->title = localize('RCREPLICA_DPC',getlocal());	 
	  
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
		$this->userDemoIds = array(5,6,7,8); 		  
	}
	
    function event($event=null) {
	
	   $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   if ($login!='yes') return null;		 
	
	   switch ($event) {

		 case 'cpdorepall'   : $this->doreplication(null, true);
		                       break;
	   
		 case 'cpdorepsql'   : $this->doreplication(1, true);
		                       break;
		 case 'cpdorepfile'  : $this->doreplication(2, true);
		                       break;
		 case 'cpreplsql'    : echo $this->loadframe(null,'sql');
		                       die();	
		                       break;  	
		 case 'cpreplfile'   : echo $this->loadframe(null,'file');
		                       die();
							   break; 	   
	     case 'cpreplica'    :
		 default             :    
		                      
	   }
			
    }   
	
    function action($action=null) {
		
	  $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	  if ($login!='yes') return null;	
	 
	  switch ($action) {
		  
		 case 'cpdorepall'  : $out = $this->replicationMode(); break;		  
			
		 case 'cpdorepsql'  : break; 										  
		 case 'cpdorepfile' : $out = $this->scanReport('cgi-bin', 1, 0, true, urldecode(GetReq('date')));
							  break; 
		 case 'cpreplsql'   :						
		 case 'cpreplfile'  : 
							  break;					  
	     case 'cpreplica'   :

		 default            : $out = $this->replicationMode();
	  }	 

	  return ($out);
    }
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}	

	protected function replicationMode() {
		$lan = getlocal();
		$mode = (GetReq('mode')=='sql') ? 'SQL' : 'Filesystem';
		$um = (GetReq('mode')=='sql') ? '&mode=sql' : '&mode=files'; 
		$mcmd = array();
		$rcmd = array();
		
		$mcmd[localize('_files', $lan)] = seturl('t=cpreplica&mode=files');
		$mcmd[localize('_sql', $lan)] = seturl('t=cpreplica&mode=sql');		
		$button = $this->createButton(localize('_mode', $lan), $mcmd);
													
		$rcmd[localize('_runtoday', $lan)] = seturl('t=cpdorepall&backtrace=today'.$um);
		$rcmd[localize('_runday', $lan)] = seturl('t=cpdorepall&backtrace=yesterday'.$um);
		$rcmd[localize('_runweek', $lan)] = seturl('t=cpdorepall&backtrace=week'.$um);
		$rcmd[localize('_runmonth', $lan)] = seturl('t=cpdorepall&backtrace=month'.$um);
		if ($this->dac7) {
			$rcmd[0] = ''; //sep
			$rcmd[localize('_runall', $lan)] = seturl('t=cpdorepall'.$um);
		}		
		
		$button .= $this->createButton(localize('_actions', $lan), $rcmd,'warning');
													  													   
		$content = (GetReq('mode')=='sql') ?
					$this->replica_sqlgrid(null,140,5,'r', true) :
					$this->replica_filegrid(null,140,5,'r', true) ;
					
		$ret = $this->window($mode, $button, $content);
		
		return ($ret);
	}	

	protected function loadframe($ajaxdiv=null, $mode=null) {
		$date = GetParam('date');
		$acct = GetParam('acct');
		$cmd = ($mode=='sql') ? 'cpdorepsql&date='.$date : 'cpdorepfile&date='.$date.'&acct='.$acct;
		$bodyurl = seturl("t=$cmd&iframe=1");
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"440px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}		
	
	protected function replica_filegrid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('RCREPLICA_DPC',getlocal()); 
		
		$backtrace = date("Y-m-d H:i:s", mktime(date('H'), date('i'), date('s'), date('n'), date('j')-30,date('Y')));

		$xsSQL = "select * from (SELECT id, stamp, status, acct, REPLACE(file_path,'{$this->urlpath}','') as file_path, file_last_mod FROM fshistory WHERE (status='ADDED' or status='ALTERED' or STATUS='DELETED') and file_path NOT LIKE 'FIRST SCAN%' and stamp > '$backtrace') as o";		
		//echo $xsSQL;  
		_m("mygrid.column use grid1+id|".localize('_id',getlocal())."|2|0");	
		_m("mygrid.column use grid1+stamp|".localize('_stamp',getlocal())."|link|5|".'||');
		_m("mygrid.column use grid1+status|".localize('_status',getlocal()).'|5|1');			
		_m("mygrid.column use grid1+acct|".localize('_acct',getlocal())."|link|5|"."javascript:filedetails(\"{stamp}\",\"{acct}\");".'||');
		//if (!$this->isDemoUser())
			_m("mygrid.column use grid1+file_path|".localize('_filepath',getlocal())."|19|1"); 		
		_m("mygrid.column use grid1+file_last_mod|".localize('_filemod',getlocal())."|link|5|"."javascript:details(\"{stamp}\");".'||');
		
		$out = _m("mygrid.grid use grid1+fshistory+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");
		
		return ($out);  	
	}
	
	protected function replica_sqlgrid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('RCREPLICA_DPC',getlocal()); 	
		
		$backtrace = date("Y-m-d H:i:s", mktime(date('H'), date('i'), date('s'), date('n'), date('j')-30,date('Y')));

		$xsSQL = "SELECT * FROM (SELECT i.id,i.fid,i.time,i.date,i.execdate,i.status,i.sqlres,i.sqlquery,i.reference FROM syncsql i where i.reference='system' AND i.reference NOT LIKE 'replication' AND i.sqlquery NOT LIKE '%cron%') x";
		//echo $xsSQL;

		_m("mygrid.column use grid2+id|".localize('id',getlocal())."|2|0|");
		_m("mygrid.column use grid2+time|".localize('_date',getlocal())."|link|3|"."javascript:sqldetails({id});".'||');			
		_m("mygrid.column use grid2+execdate|".localize('_xdate',getlocal())."|3|0|");			
		_m("mygrid.column use grid2+status|".localize('_status',getlocal())."|1|0|");
		_m("mygrid.column use grid2+sqlquery|".localize('_query',getlocal())."|25|1|");
	    _m("mygrid.column use grid2+sqlres|".localize('_sqlres',getlocal())."|2|0|");			
	    _m("mygrid.column use grid2+reference|".localize('_ref',getlocal())."|2|0|");
		
		$out = _m("mygrid.grid use grid2+syncsql+$xsSQL+$mode+$title+time+$noctrl+1+$rows+$height+$width+1+1+1");
		
		return ($out);  	
	}	
			
	protected function scanReport($acc=null, $daysback=null, $minsback=null, $reportout=false, $date=null) {
		$db = GetGlobal('db');	
		$backtracedays = $daysback ? $daysback : 1;
		$backtracemins = $minsback ? $minsback : 0;
		$acct = $acc ? $acc : 'scanner';
		$repout = $reportout ? true : $this->report_out;
		
		$report = "Scan Report\r\n\r\n";
		
		//	Prepare scan report
		if ($date) { //as clicked by grid
			$backtrace = $date;
			$gthan = '>';// '<'; //less than ?
		}	
		else {
			$backtrace = date("Y-m-d H:i:s", mktime(date('H'), date('i')-$backtracemins, date('s'), date('n'), date('j')-$backtracedays,date('Y')));
			$gthan = '>'; //greater than
		}	

		$report .= "Scan log report for $acct file changes since ".$backtrace.":\r\n\r\n";	

		$results = $db->Execute("SELECT stamp, status, REPLACE(file_path,'{$this->urlpath}','') as file_path, file_last_mod FROM fshistory WHERE acct = '$acct' AND stamp $gthan '$backtrace'");
		if (!$results)
		{
			$report .="No log entries available!\r\n ";
		} else {
			//while($result=mysqli_fetch_array($results))
			foreach ($results as $r=>$rec) 	
			{
				$report .= $rec['stamp']." =>  ".strtoupper($rec['status'])." =>  ".$rec['file_path']."\r\n";
			}
		}

		// OUTPUT Report
		if ($this->email_out)
		{
			$to = (count($this->addresses)>1) ? implode(", ", $this->addresses): $this->addresses[0];
			$mailed = mail($to, $acct . ' Integrity Monitor Log Report',$report); 
		}

		if ($repout) 
			return(nl2br($report));
		else
			return true;	
	}
	
	//replicate differencial sql system activity
	protected function difSQL($d=null, $download=false) {
		$db = GetGlobal('db');
		$backtrace = date("Y-m-d H:i:s", mktime(date('H'), date('i'), date('s'), date('n'), date('j')-$d, date('Y')));

		static $zip; 
		$zip = new ZipArchive();
        $d1 = date('Ymd-His');
		$d2 = date("Ymd-His", mktime(date('H'), date('i'), date('s'), date('n'), date('j')-$d, date('Y')));
        $zname = $d1.'-'.$d2.'-'.'dsql.zip';			
		$zfilename = $this->path . "/uploads/" . $zname; //zip to save into
		 
		if ($zip->open($zfilename, ZipArchive::CREATE)!==TRUE) {
            echo "Cannot open $zfilename";
			return false;
		}
		else {
			//temp file to save sql as txt
			$tempfile = $this->path . "/uploads/dsql.txt"; 
			$fh = @fopen($tempfile, 'w');			
			
			//desc form old to new 
			$sSQL = "SELECT id,time,sqlquery FROM syncsql where status=1 and reference='system' AND reference NOT LIKE 'replication' AND sqlquery NOT LIKE '%cron%' and time > '$backtrace' order by id DESC";
			$result = $db->Execute($sSQL);
			foreach ($result as $r=>$rec) {
				fwrite($fh, "\r\n" . $rec['sqlquery'] . "\r\n");
				//if (!$download) echo $rec['sqlquery'] . '<br/>';
			}
			
			@fclose($fh);
			
			//add txt to zip
			$f = str_replace($this->urlpath .'/', '', $tempfile);
			$zip->addFile($tempfile, $f);
			$zip->close();		  
			//@unlink($tempfile);
		
			if ($download==true) {
				$dn = new DOWNLOADFILE($zfilename, 'application/zip');
				$ret = $dn->df_download();
				//return ($ret);	
			}	
			else 
				return ($zfilename);		
		}
		
	}	
	
	//dac7 version
	protected function dac7difSQL($d=null) {
		$db = GetGlobal('db');
		$backtrace = date("Y-m-d H:i:s", mktime(date('H'), date('i'), date('s'), date('n'), date('j')-$d, date('Y')));

		//desc form old to new 
		$sSQL = "SELECT id,time,sqlquery FROM syncsql where status=1 and reference='system' AND reference NOT LIKE 'replication' AND sqlquery NOT LIKE '%cron%' and time > '$backtrace' order by time";
		$this->_echo($sSQL, 'TYPE_IRON');
		$result = $db->Execute($sSQL);
		foreach ($result as $r=>$rec) {
			//$this->_echo($rec['sqlquery'], 'TYPE_IRON');
			echo '.';
		}
		$this->_echo('..!', 'TYPE_IRON');	
		
		return true;		
	}	
		
	
	//replicate differencial file system activity
	protected function difFiles($d=null, $download=false) {
		$db = GetGlobal('db');
		$backtrace = date("Y-m-d H:i:s", mktime(date('H'), date('i'), date('s'), date('n'), date('j')-$d, date('Y')));

		static $zip; 
		$zip = new ZipArchive();
        $d1 = date('Ymd-His');
		$d2 = date("Ymd-His", mktime(date('H'), date('i'), date('s'), date('n'), date('j')-$d, date('Y')));
        $zname = $d1.'-'.$d2.'-'.'dfiles.zip';			
		$zfilename = $this->path . "/uploads/" . $zname; //to save into
         
		if ($zip->open($zfilename, ZipArchive::CREATE)!==TRUE) {
            echo "Cannot open $zfilename";
			return false;
		}
		else {
			$sSQL = "SELECT id, timein, stamp, status, file_path, file_last_mod FROM fshistory WHERE (acct NOT LIKE '%replicated%') AND (status='ADDED' or status='ALTERED') AND (file_path NOT LIKE 'FIRST SCAN%') AND (timein > '$backtrace') ORDER BY timein";
			$result = $db->Execute($sSQL);
		
			foreach ($result as $r=>$rec) {
				if (is_readable($rec['file_path']))  {   
				
					$f = str_replace($this->urlpath .'/', '', $rec['file_path']);
					$zip->addFile($rec['file_path'], $f);
					//if (!$download) echo $f . '<br/>';
				}	
			}
			
			$zip->close();		  
		
			if ($download==true) {
				$dn = new DOWNLOADFILE($zfilename, 'application/zip');
				$ret = $dn->df_download();
				//return ($ret);	
			}	
			else 
				return ($zfilename);		
		}
		
	}
	
	//dac7 version
	protected function dac7difFiles($d=null, $download=false) {
		$db = GetGlobal('db');
		$backtrace = date("Y-m-d H:i:s", mktime(date('H'), date('i'), date('s'), date('n'), date('j')-$d, date('Y')));

		$sSQL = "SELECT id, timein, stamp, status, file_path, file_last_mod FROM fshistory WHERE (acct NOT LIKE '%replicated%') AND (status='ADDED' or status='ALTERED') AND (file_path NOT LIKE 'FIRST SCAN%') AND (timein > '$backtrace') ORDER BY timein";
		$this->_echo($sSQL, 'TYPE_IRON');
		
		$result = $db->Execute($sSQL);
		
		foreach ($result as $r=>$rec) {
			if (is_readable($rec['file_path']))  {   
				
				$f = str_replace($this->urlpath .'/', '', $rec['file_path']);
				//$this->_echo($f 'TYPE_IRON');
				echo '.';
			}	
		}
		$this->_echo('..!', 'TYPE_IRON');	

		return true;
	}	

	protected function zipFiles($afiles, $download=false, $ftp=false)	{
		static $zip; 
		$zip = new ZipArchive();
		$zfilename = $this->path . "/uploads/replication.zip" . $zname;
		if ($zip->open($zfilename, ZipArchive::CREATE)!==TRUE) {
            echo "Cannot open $zfilename";
			return false;
		}
		else {	
			foreach ($afiles as $file) {
				$f = str_replace($this->urlpath .'/', '', $file);
				$zip->addFile($file, $f);
				//if (!$download) echo $f . '<br/>';
			}
			
			$zip->close();
			
			if ($download==true) {
				$dn = new DOWNLOADFILE($zfilename, 'application/zip');
				$ret = $dn->df_download();
				//return ($ret);	
			}
			elseif ($ftp) {
				
				//ftp connection (app public root conn)
				$conn_id = ftp_connect($ftp_server);	
				$login = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
				
				if ($login) {//move to ftp
					$remote_file = str_replace($this->urlpath .'/', '', $zfilename);
						
					//if ($debug_mode)
					//    echo "remotefile:".$remote_file.'<br>';
						
					if (ftp_put($conn_id, $remote_file, $zfilename, FTP_BINARY)) {
                        //@unlink($file);							
                        //self::write2disk('imgsaveandresize.log',date(DATE_RFC822)."$file transfered\r\n");									
					}
                    else {	    
						if ($debug_mode)
                            echo "FTP:File not found:".$zfilename.'<br>';						
                        //self::write2disk('imgsaveandresize.log',date(DATE_RFC822)."$file NOT transfered\r\n");																
					}	
				}				

				// close the ftp connection		
				if ($conn_id) 
					ftp_close($conn_id);				
			}	
			else 
				return ($zfilename);			
		}	
		
	}
	
	public function doreplication($mode=null, $download=false) {
		$mode = $mode ?? ((GetReq('mode')=='sql') ? 1 : 2); //0
		$bt = GetReq('backtrace');
		$loc = '_runall';
		
		if ($this->dac7) { //call remote dac7 cmd
			//save cookie params for dac-7 cmd
			$reqparams = "mode=" . $mode . "&backtrace=" . $bt;
			//file_put_contents($this->path . '/_cookie.txt', $reqparams, LOCK_EX);				   

			if ($bt) { //inside dac7, outside of -this- class
				
				switch ($bt) {
					case 'month'     : $loc = '_runmonth'; $d = 30; break;
					case 'week'      : $loc = '_runweek'; $d = 7; break;
					case 'yesterday' : $loc = '_runday'; $d = 1; break;
					case 'today'     : $loc = '_runtoday'; $d = 0; break;
					default          : $loc = '_runall'; $d = 0;
				}
				
				//add days param
				$reqparams .= "&days=" . $d;
			}	
			
			//executed inside dac7 engine when called as ppost ETL
			/*if ($this->execDac7cmd('async/ppost/backup_replication/', $reqparams))
				$this->jsDialog('Start', localize('_runall', getlocal()), 3000, 'cdact.php?t=texit');	
			*/
			
			//executed inside dac7 engine when called as dbo ETL
						
			//'async/dbo/replication/dbofilter03/dbofilter04/replicatenode/'
			//'_replicationdb'=>'async/dbo/replication_db/dbofilter_execute_remote/dbofilter_update_local/replicatenode/',
			//'_replicationfl'=>'async/dbo/replication_files/dbofilter03/dbofilter04/replicatenode/',
			
			switch ($mode) {
				case 2 :	//exec ETL method for files replication
							if ($this->execDac7cmd('async/dbo/replication_files/dbofilter_savefile_remote/dbofilter_updatefile_local/replicatefilenode/', $reqparams))
								$this->jsDialog('Start', localize($loc, getlocal()), 3000, 'cdact.php?t=texit');
							break;
				case 1 :
				default:
							//exec ETL method for db replication
							if ($this->execDac7cmd('async/dbo/replication_db/dbofilter_execute_remote/dbofilter_update_local/replicatenode/', $reqparams))
								$this->jsDialog('Start', localize($loc, getlocal()), 3000, 'cdact.php?t=texit');	
			}
			return true;	
		}
		else {
			if ($this->indac7) {
				//executed inside dac7 engine when called as ppost ETL
				switch ($bt) {
					case 'month'     : $d = 30; break;
					case 'week'      : $d = 7; break;
					case 'yesterday' : $d = 1; break;
					case 'today'     : $d = 0; break;
					default          : $d = 0;
				}
				
				$this->dac7difSQL($d); 
				$this->dac7difFiles($d);
				
				return true;
			}
			else { //common www request
				ini_set('max_execution_time', 600);
				ini_set('memory_limit','1024M');

				//set_time_limit(180);		
		
				switch ($bt) {
					case 'month'     : $d = 30; break;
					case 'week'      : $d = 7; break;
					case 'yesterday' : $d = 1; break;
					case 'today'     : $d = 0; break;
					default          : $d = 0;
				}
		
				if ($d) {			
					switch ($mode) {
						case 1  : 	$this->difSQL($d, $download); break;
						case 2  : 	$this->difFiles($d, $download); break;
						case 0  :
						default : 	$f1 = $this->difSQL($d, false); 
									$f2 = $this->difFiles($d, false);
									$this->zipFiles(array($f1,$f2), $download);
					}			  
				}
				else {
					$f1 = $this->difSQL(365, false); 
					$f2 = $this->difFiles(365, false);
					$this->zipFiles(array($f1,$f2), $download);
				}
				
				return true;
			}
		}
		return false;	
	}
	
	protected function createButton($name=null, $urls=null, $t=null, $s=null) {
		$type = $t ? $t : 'primary'; //danger /warning / info /success
		switch ($s) {
			case 'large' : $size = 'btn-large '; break;
			case 'small' : $size = 'btn-small '; break;
			case 'mini'  : $size = 'btn-mini '; break;
			default      : $size = null;
		}
		
		//$ret = "<button class=\"btn  btn-primary\" type=\"button\">Primary</button>";
		
		if (!empty($urls)) {
			foreach ($urls as $n=>$url)
				$links .= $url ? '<li><a href="'.$url.'">'.$n.'</a></li>' : '<li class="divider"></li>';
			$lnk = '<ul class="dropdown-menu">'.$links.'</ul>';
		} 
		
		$ret = '
			<div class="btn-group">
                <button data-toggle="dropdown" class="btn '.$size.'btn-'.$type.' dropdown-toggle">'.$name.' <span class="caret"></span></button>
                '.$lnk.'
            </div>'; 
			
		return ($ret);
	}

	protected function window($title, $buttons, $content) {
		$ret = '	
		    <div class="row-fluid">
                <div class="span12">
                  <div class="widget red">
                        <div class="widget-title">
                           <h4><i class="icon-reorder"></i> Replication: '.$title.'</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <!--a href="javascript:;" class="icon-remove"></a-->
                           </span>
                        </div>
                        <div class="widget-body">
							<div class="btn-toolbar">
							'. $buttons .'
							<hr/><div id="rdetails"></div>
							</div>
							'.  $content .'
                        </div>
                  </div>
                </div>
            </div>
';
		return ($ret);
	}	

	
	
	protected function writeLog($data = '') {
		if (empty($data)) return;

		$data = date('d-m-Y H:i:s')."\r\n" . $data . "\r\n----\r\n";
		$ret = file_put_contents($this->path . 'scanner.log', $data, FILE_APPEND | LOCK_EX);
		
		return $ret;
	}	
};
}
?>