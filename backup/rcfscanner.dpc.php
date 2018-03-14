<?php
$__DPCSEC['RCFSCANNER_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCFSCANNER_DPC")) && (seclevel('RCFSCANNER_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCFSCANNER_DPC",true);

$__DPC['RCFSCANNER_DPC'] = 'rcfscanner';
 
$__EVENTS['RCFSCANNER_DPC'][0]='cpfscanner';
$__EVENTS['RCFSCANNER_DPC'][1]='cpscanrep';
$__EVENTS['RCFSCANNER_DPC'][2]='cpsreport';
$__EVENTS['RCFSCANNER_DPC'][3]='cpmakeaccfile';
$__EVENTS['RCFSCANNER_DPC'][4]='cpdorun';

$__ACTIONS['RCFSCANNER_DPC'][0]='cpfscanner';
$__ACTIONS['RCFSCANNER_DPC'][1]='cpscanrep';
$__ACTIONS['RCFSCANNER_DPC'][2]='cpsreport';
$__ACTIONS['RCFSCANNER_DPC'][3]='cpmakeaccfile';
$__ACTIONS['RCFSCANNER_DPC'][4]='cpdorun';

//$__DPCATTR['RCFSCANNER_DPC']['cpfscanner'] = 'cpfscanner,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCFSCANNER_DPC'][0]='RCFSCANNER_DPC;Scanner;Scanner';
$__LOCALE['RCFSCANNER_DPC'][1]='_stamp;Stamp;Stamp';
$__LOCALE['RCFSCANNER_DPC'][2]='_status;Status;Κατάσταση';
$__LOCALE['RCFSCANNER_DPC'][3]='_filepath;Object;Στοιχείο';
$__LOCALE['RCFSCANNER_DPC'][4]='_filemod;Date modified;Ημερομηνία αλλαγής';
$__LOCALE['RCFSCANNER_DPC'][5]='_results;Results;Αποτέλεσμα';
$__LOCALE['RCFSCANNER_DPC'][6]='_code;Code;Κωδικός';
$__LOCALE['RCFSCANNER_DPC'][7]='_id;ID;ID';
$__LOCALE['RCFSCANNER_DPC'][8]='_save;Save;Αποθήκευση';
$__LOCALE['RCFSCANNER_DPC'][9]='_date;Date;Ημερ.';
$__LOCALE['RCFSCANNER_DPC'][10]='_time;Time;Ώρα';
$__LOCALE['RCFSCANNER_DPC'][11]='_status;Status;Status';
$__LOCALE['RCFSCANNER_DPC'][12]='_fid;id;id';
$__LOCALE['RCFSCANNER_DPC'][13]='_savesql;Save;Save';
$__LOCALE['RCFSCANNER_DPC'][14]='_SQL;SQL Query;SQL Query';
$__LOCALE['RCFSCANNER_DPC'][15]='_xdate;X Date;X Date';
$__LOCALE['RCFSCANNER_DPC'][16]='_ref;Reference;Reference';
$__LOCALE['RCFSCANNER_DPC'][17]='_sqlres;Res;Res';
$__LOCALE['RCFSCANNER_DPC'][18]='_query;Query;Query';
$__LOCALE['RCFSCANNER_DPC'][18]='_acct;Acct;Acct';

class rcfscanner  {

    var $title, $path, $urlpath;
	var $seclevid, $userDemoIds;
	
	var $report_out, $email_out, $addresses;
	var $report;
		
	function __construct() {
	
		$this->path = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		$this->title = localize('RCFSCANNER_DPC',getlocal());	 
	  
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
		$this->userDemoIds = array(5,6,7,8); 
		//echo $this->seclevid;

		//	Output to monitor (true or false)
		//		Recommend true for testing and FALSE for CRON
		$this->report_out = false;		
		//	Output as e-mail (true or false)
		//		Recommend false for testing and true for CRON
		$this->email_out = false;		
		//	E-mail address(es) to send reports of change
		//$addresses = array("balexiou@stereobit.com",);// "user2@domain2.com");
		$this->addresses = array("b.alexiou@stereobit.gr",);// "user2@domain2.com");

		$this->report = null;	
	}
	
    function event($event=null) {
	
	   $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   if ($login!='yes') return null;		 
	
	   switch ($event) {

		 case 'cpdorun'      : $this->report = $this->runscan();//'cgi-bin'); 
		                       break;
		 case 'cpmakeaccfile': $this->makeAccFile($this->urlpath.'/cgi-bin/'); 
		                       break;
	   

		 case 'cpsreport'    : break; 	
		 case 'cpscanrep'    : echo $this->loadframe();
		                       die();
							   break; 	   
	     case 'cpfscanner'   :
		 default             :    
		                      
	   }
			
    }   
	
    function action($action=null) {
		
	  $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	  if ($login!='yes') return null;	
	 
	  switch ($action) {
		  
		 case 'cpdorun'     : $out = $this->wscanner($this->report); break;
		 case 'cpmakeaccfile': $out = $this->wscanner(); break;		  
												  
		 case 'cpsreport'   : //$out = $this->scanReport('cgi-bin', 1, 0, true, urldecode(GetReq('date')));
							  $out = $this->scanReport(GetReq('acct'), 1, 0, true, urldecode(GetReq('date')));	
							  break; 					
		 case 'cpscanrep'   : break;					  
	     case 'cpfscanner'  :
		 default            : $out = $this->wscanner();
	  }	 

	  return ($out);
    }
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}	
	
	public function runscan($acc=null) {
		
		//$where = $this->urlpath . '/cgi-bin/'; //change also acc on event
		//$report = $this->scan($acc, $where, null, true);
		
		$report = $this->scan($acc, null, null, true);
		
		return ($report);
	}
	
	protected function wscanner($report=null) {
		$title = localize('RCFSCANNER_DPC',getlocal());
		
		$turl1 = seturl('t=cpdorun');
		$turl2 = seturl('t=cpmakeccfile');		
		$button .= $this->createButton('Actions', array('Run'=>$turl1,
													   'Create acc file'=>$turl2,
		                                               ),'warning');
					
		$content = $report; //when scanner run				
		$content .=	$this->filegrid(null,140,5,'r', true) ;
					
		$ret = $this->window($title, $button, $content);
		
		return ($ret);
	}	

	protected function loadframe($ajaxdiv=null) {
		$date = GetReq('date');
		$acct = GetReq('acct');
		$cmd = 'cpsreport&date='.$date . '&acct='.$acct;
		$bodyurl = seturl("t=$cmd&iframe=1");
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"440px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}		
	
	protected function filegrid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('RCFSCANNER_DPC',getlocal()); 
		
		$backtrace = date("Y-m-d H:i:s", mktime(date('H'), date('i'), date('s'), date('n'), date('j')-30,date('Y')));

		//$xsSQL = "select * from (SELECT id, stamp, status, acct, file_path, file_last_mod FROM fshistory WHERE (status='ADDED' or status='ALTERED' or STATUS='DELETED') and file_path NOT LIKE 'FIRST SCAN%' and stamp > '$backtrace') as o";		
		$xsSQL = "select * from (SELECT id, stamp, status, acct, REPLACE(file_path,'{$this->urlpath}','') as file_path, file_last_mod FROM fshistory WHERE (status='ADDED' or status='ALTERED' or STATUS='DELETED') and file_path NOT LIKE 'FIRST SCAN%' and stamp > '$backtrace') as o";		
		//echo $xsSQL;  
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+id|".localize('_id',getlocal())."|2|0");	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+stamp|".localize('_stamp',getlocal())."|5|1|".'||');
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+status|".localize('_status',getlocal())."|5|1|".'||');			
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+acct|".localize('_acct',getlocal())."|link|5|"."javascript:sdetails(\"{stamp}\",\"{acct}\");".'||');	
		//if (!$this->isDemoUser())
			GetGlobal('controller')->calldpc_method("mygrid.column use grid1+file_path|".localize('_filepath',getlocal())."|19|1");	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+file_last_mod|".localize('_filemod',getlocal())."|link|5|"."javascript:details(\"{stamp}\");".'||');
		
		$out = GetGlobal('controller')->calldpc_method("mygrid.grid use grid1+fshistory+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}

	
	protected function printCurrentDirRecursively($originDirectory, $printDistance=0, &$fh=null){
    
		//if($printDistance==0) @fwrite($fh, "\r\n");
		$leftWhiteSpace = "";
		//for ($i=0; $i < $printDistance; $i++)  $leftWhiteSpace = $leftWhiteSpace." ";
    
		$CurrentWorkingDirectory = dir($originDirectory);
		while($entry=$CurrentWorkingDirectory->read()){
			if($entry != "." && $entry != ".."){
				if(is_dir($originDirectory."\\".$entry)){
					@fwrite($fh, $leftWhiteSpace.$originDirectory."\\".$entry."\r\n");
					$this->printCurrentDirRecursively($originDirectory."\\".$entry, $printDistance+2, $fh);
				}
				/*else{
					@fwrite($fh, $leftWhiteSpace.$entry."\r\n");
				}*/
			}
		}
		$CurrentWorkingDirectory->close();
    
		//if($printDistance==0) @fwrite($fh, "\r\n");	
	}	
	
    protected function readDirectories($path=null, $fh) {
        $app_path = $this->urlpath . '/';			
	    static $dirname;
		$dirname .= $path .'/'; //goto next dir
		
		//$fh = @fopen($filename, 'w');
				
	    if (is_dir($app_path . $dirname)) {
		
          $mydir = dir($app_path . $dirname);
          while ($fileread = $mydir->read ()) {
		    if (($fileread!='.') && ($fileread!='..'))  {
  	            if (is_dir($app_path . $dirname."/".$fileread))  { 
					fwrite($fh, $app_path . $dirname."/".$fileread."\r\n");				 
					$this->readDirectories($fileread, $fh);
				}
				//else //if file do nothing
		    } 
	      }
	      $mydir->close();
		  $dirname = str_replace($path .'/','',$dirname);		  
        }
		
	    //$ret = @fclose($fh);
		return ($ret);
    }	
			
	
	protected function makeAccFile($startpath, $acc=null) {
		$acct = $acc ? $acc : 'scanner';
		$filename = $this->path . $acc . '.acc';
		$fh = fopen($filename, 'w');
		
		set_time_limit(180); 
		//$this->printCurrentDirRecursively($startpath, 0, $fh);	
		$this->readDirectories($startpath, $fh);

		$ret = @fclose($fh);	
		return $ret;
	}

	static function getIDX($f, $max) {
		$i = @file_get_contents($f);
		$index = intval(trim($i));
		$idx = ($max > $index+1) ? $index+1 : 0;	
        @file_put_contents($f, strval($idx), LOCK_EX);		
		return ($index);
	}
	
	protected function selectPath($acc=null, &$acct) {
		//if (!$acc) return ($this->urlpath);
		$acct = $acc ? $acc : 'scanner';
		
		$tpath = remote_paramload('FRONTHTMLPAGE', 'path', $this->path);
		$template = remote_paramload('FRONTHTMLPAGE', 'template', $this->path);
		$cptemplate = remote_paramload('FRONTHTMLPAGE', 'cptemplate', $this->path);
		
		/*$accfile = $this->path . $acct . '.acc';
		
		if (is_readable($accfile)) {*/
			
			//$datalines = explode(';', @file_get_contents($accfile)); //file($accfile);
			$datalines = array(0=>$this->urlpath . '/cgi-bin',
							1=>$this->urlpath . '/css',
							2=>$this->urlpath . '/newsletters',
							3=>$this->urlpath . '/cp/transactions',
							4=>$this->urlpath . '/cp/collections',
							5=>$this->urlpath . "/cp/$tpath/$cptemplate",
							6=>$this->urlpath . "/cp/$tpath/$template",
							);
			//$datalines = array_merge($datalines1, $datalines2);
			//print_r($datalines);
			//if (!empty($datalines)) {
				
				$accindexfile = $this->path . $acct . '.id';
				$index = rcfscanner::getIDX($accindexfile, count($datalines));
				$scanpath = $datalines[$index];
				$sp = explode('/', $scanpath);
				$acct = array_pop($sp); //return acct per dir
				
				//0,2,4 - 1,3,0 ???
				//return ($index .'-'.$scanpath);
				
				return ($scanpath);				
				
			//}	
		//}
		
		//return ($this->urlpath); 
		return false;
	}

		
	public function scan($acc=null, $spath=null, $skipdir=null, $reportout=false) {
		$db = GetGlobal('db');
		$repout = $reportout ? true : $this->report_out;
		$testing = true; //false;
		$acct = $acc ? $acc : 'scanner';		
		
		$path = $spath ? $spath : $this->selectPath(null, $acct);	
		//return ($acct."[". $path . "]");//test	
		if (!$path) return ("Acc file not defined ($acct)"); // false
		
		if (!is_dir($path)) return ("Invalid path ($path)");
		
		@unlink($this->path . 'scanner.log');
		$log = fopen($this->path . 'scanner.log', "a");
		
		$scan_path_length = strlen($path);

	    ini_set('max_execution_time', 600);
	    ini_set('memory_limit','1024M');		
		
		//	Extensions to fetch
		//  	Example: $ext = array("php", "html", "htm", "js");   
		//	Recommended: An empty array will return ALL extensions 
		//		which is best for real security
		$ext_array = array();
		//	Make extensions lower case for scanner comparison
		$ext_array = array_map('strtolower',$ext_array);
		// 	extensions to omit
		//		An empty array will return all extensions
		//      *** The $excl_ext array can only contain elements *** 
		//		*** if $ext array above is empty *** 
		$excl_array = array('ftpquota','txt','swf','fla','ini'); //<< ini
		//	Make extensions lower case for scanner comparison
		$excl_array = array_map('strtolower',$excl_array);
		//	Scan extensionless files?
		$extensionless = false;
		// 	directories to ignore
		//		An empty array will check all directories in the SCAN_PATH tree
		$skip = is_array($skipdir) ? $skipdir : array();	
		//	$indent for report indent
		$indent = " &nbsp; &nbsp;";
		$indent2 = $indent . $indent;

		//	INITIALIZE
		//	Initialization of scanner variables and tables
		
		//	Clear and title the report variable before starting
		$report = "Scan File Check for $acct ($path)\r\n\r\n";
		//	Initialize the baseline array for the baseline table
		$baseline = array();		
		//	Initialize the current array for the current file scan
		$current = array();
		//	Intitialize the differences arrays 
		$added = array();
		$altered = array();
		$deleted = array();

		//	Limit first scan entries in history table

		//	Get date and time of last scan for report
		$last_scanned_records = $db->Execute("SELECT `scanned` FROM fsscanned WHERE `acct` = '$acct' ORDER BY `scanned` DESC LIMIT 1");
		//if ($last_scanned_records && 0 < mysqli_num_rows($last_scanned_records))
		if ($last_scanned = $last_scanned_records->fields[0])
		{
			//	Get last timestamp
			//while($last_datetime = @mysqli_fetch_assoc($last_scanned_records))
			//{
			//$last_scanned = $last_datetime['scanned'];
			$firstscan = false;
			//}
		} else {
			$firstscan = true;
			$count_baseline = 0;
		}

		//	Start timer (scan duration)
		$start = microtime(true);

		//	END OF INITIALIZE

		//	BASELINE
		// 	Read from database to obtain file paths, hash values and 
		//		last modified dates to compare against current files

		$baseline_results = $db->Execute("SELECT `file_path`, `file_hash`, `file_last_mod` FROM fsbaseline WHERE `acct` = '$acct' ORDER BY `file_path` ASC");

		if ($baseline_results) 
		{
			//while ($baseline_files = @mysqli_fetch_assoc($baseline_results))
			foreach ($baseline_results as $ib=>$baseline_files)	
			{
				$baseline[$baseline_files['file_path']] = array(
					'file_hash' => $baseline_files['file_hash'],
					'file_last_mod' => $baseline_files['file_last_mod']);
			}

			//	Get the count of baseline records
			$count_baseline = count($baseline);

			if (0 == $count_baseline) 
			//	Prior scanned results but empty baseline table
			{
				//	Check for database hack by checking $firstscan
				if (!$firstscan)
				{
					$report .= "Empty baseline table!\r\nPROBABLE HACK ATTACK\r\n(ALL files are missing/deleted)!\r\n\r\n";	
				}
			}
	
			$report .= "$count_baseline baseline files extracted from database.\r\n";
	
			//	Output number of baseline files for testing
			if ($testing) fwrite($log, "$count_baseline baseline files extracted from database.");
		}
		//	Baseline files read into baseline array and baseline_count made


		//	SCAN		
		
		$dir = new RecursiveDirectoryIterator($path);
		$iter = new RecursiveIteratorIterator($dir);
		while ($iter->valid())
		{
			// 	Not in Dot AND not in $skip (prohibited) directories
			if (!$iter->isDot() && !(in_array($iter->getSubPath(), $skip)))
			{
				//	Get or set file extension ('' vs null)
				if (is_null(pathinfo($iter->key(), PATHINFO_EXTENSION)))
				{
					$ext = '';
				} else {
					$ext = strtolower(pathinfo($iter->key(), PATHINFO_EXTENSION));
				}

				//	Check for allowed file extension OR
				//	$ext empty AND not excluded ext OR
				//	is not $extensionless (if prohibited)
				//	if ((!empty($ext_array)) || (empty($ext_array) && !in_array($ext, $excl_array, true)))
				if (
					(in_array($ext, $ext_array, true)) ||	
					// in allowed extension array
					(empty($ext_array) && !in_array($ext, $excl_array, true)) ||	
					// OR NOT in excluded extension array
					(empty($ext) && $extensionless) )	
					// OR extensionless AND extensionless is allowed
				{
					$file_path = $iter->key();
					//	Ensure $file_path without \'s
					$file_path = str_replace(chr(92),chr(47),$file_path);
			
					//	Handle addition to $current array
					$current[$file_path] = array('file_hash' => hash_file("sha1", $file_path), 'file_last_mod' => date("Y-m-d H:i:s", filemtime($file_path)));

					//	IF file_path is not in baseline, file was ADDED
					if (!array_key_exists($file_path, $baseline))
					{
						$added[$file_path] = array('file_hash' => $current[$file_path]['file_hash'], 'file_last_mod' => $current[$file_path]['file_last_mod']);
			
						//	INSERT added record in baseline table
						$res = $db->Execute("INSERT INTO fsbaseline SET `file_path` = '$file_path', `file_hash` = '" . $added[$file_path]['file_hash'] . "', `file_last_mod` = '" . $added[$file_path]['file_last_mod'] . "', `acct` = '$acct'");
						if ($testing && (!$res)) fwrite($log, $db->error);

						//	INSERT added file record in history table
						//		EXCEPT if $firstscan (to prevent unnecessary records)
						if(!$firstscan) 
						{
							$res = $db->Execute("INSERT INTO fshistory SET `stamp` = '" . date('Y-m-d h:i:s') . "', `status` = 'Added', `file_path` = '$file_path', `hash_org` = 'Not Applicable', `hash_new` = '" . $added[$file_path]['file_hash'] . "', `file_last_mod` = '" . $added[$file_path]['file_last_mod'] . "', `acct` = '$acct'");
							if ($testing && (!$res)) fwrite($log, $db->error);
						}  else {
							//	First Scan entry into history table
							$res = $db->Execute("INSERT INTO fshistory SET `stamp` = '" . date('Y-m-d h:i:s') . "', `status` = 'Added', `file_path` = 'FIRST SCAN (file listings inhibited)', `hash_org` = 'Not Applicable', `hash_new` = 'Not Applicable', `file_last_mod` = 'Not Applicable', `acct` = '$acct'");
							if ($testing && (!$res)) fwrite($log, $db->error);
						}	//	End of handling $added array entry

					} else {

						//	IF file was ALTERED 
						if ($baseline[$file_path]['file_hash'] <> $current[$file_path]['file_hash'] || $baseline[$file_path]['file_last_mod'] <> $current[$file_path]['file_last_mod'])
						{
							$altered[$file_path] = array('hash_org' => $baseline[$file_path]['file_hash'], 'hash_new' => $current[$file_path]['file_hash'], 'file_last_mod' => $current[$file_path]['file_last_mod']);
				
							//	UPDATE altered record in baseline
							$res = $db->Execute("UPDATE fsbaseline SET `file_hash` = '" . $altered[$file_path]['hash_new'] . "', `file_last_mod` = '" . $altered[$file_path]['file_last_mod'] . "' WHERE `file_path` = '$file_path' AND `acct` = '$acct'");
							if ($testing && (!$res)) fwrite($log, $db->error);

							//	INSERT altered file info in history table
							$res = $db->Execute("INSERT INTO fshistory SET `stamp` = '" . date('Y-m-d h:i:s') . "', `status` = 'Altered', `file_path` = '$file_path', `hash_org` = '" . $altered[$file_path]['hash_org'] . "', `hash_new` = '" . $altered[$file_path]['hash_new'] . "', `file_last_mod` = '" . $altered[$file_path]['file_last_mod'] . "', `acct` = '$acct'");
							if ($testing && (!$res)) fwrite($log, $db->error);
						}
					}
				}	//	End of handling $altered array entry
			}	// End of handling $current record entry
			$iter->next();
		}//while
		
		
		//	DELETED
		//	Compare and generate $deleted array
		//	$deleted contains records where file_path 
		//		in $baseline but not in $current
		$deleted = array_diff_key($baseline, $current);
		//	Next line necessary for Windows
		$deleted = str_replace(chr(92),chr(47),$deleted);

		foreach($deleted as $key => $value)
		{
			//	Handle DELETEd file
			//	DELETE file from baseline table
			$res = $db->Execute("DELETE FROM fsbaseline WHERE `file_path` = '$key' LIMIT 1");
			if ($testing && (!$res)) 
			{
				fwrite($log, $db->error);
			} else {
				if ($testing) fwrite($log, "Deleted " . $key . "'s baseline record.");
			}

			//	Record deletion in history table
			$res = $db->Execute("INSERT INTO fshistory SET `stamp` = '" . date('Y-m-d h:i:s') . "', `status` = 'Deleted', `file_path` = '$key', `hash_org` = '" . $deleted[$key]['file_hash'] . "', `hash_new` = 'Not Applicable', `file_last_mod` = '" . $deleted[$key]['file_last_mod'] . "', `acct` = '$acct'");
			if ($testing && (!$res)) fwrite($log, $db->error);
		}
		//	End of Deleted file handling

		//	PREPARE Report 
	
		//	Get scan duration
		$elapsed = round(microtime(true) - $start, 5);
	
		//	Add count summary to report
		$count_current = count($current);
		$report .= "$count_current files collected in scan.\r\n";
		if (0 == $count_current)
		{
			//	ALL files are gone!
			$report .= "\r\nThere are NO files in the specified location.\r\n";
			if (!$firstscan) $report .= "This indicates a possible HACK ATTACK\r\nOR an incorrect path to the account's files\r\n";
		}

		$count_added = count($added);
		$report .= "$indent $count_added files ADDED to baseline.\r\n";
		if (!$firstscan)
		{
			foreach($added as $filename => $value) $report .= "$indent2 + " . substr($filename,$scan_path_length) . "\r\n";
		}

		$count_altered = count($altered);
		$report .= "$indent $count_altered ALTERED files updated.\r\n";
		foreach($altered as $filename => $value) $report .= "$indent2 " . chr(177) . " " . substr($filename,$scan_path_length) . "\r\n";

		$count_deleted = count($deleted);
		$report .= "$indent $count_deleted files DELETED from baseline.\r\n";
		foreach($deleted as $filename => $value) $report .= "$indent2 - " . substr($filename,$scan_path_length) . "\r\n";

		fwrite($log, "\r\n");

		$count_changes = $count_added + $count_altered + $count_deleted;	

		//	Completed update of history table for Unchanged

		if (0 == $count_changes)
		{  
			$path = "File structure is unchanged since last scan, script execution time $elapsed seconds.\r\nThe baseline contains $count_current files.\r\n";

			//	Update history table
			$res = $db->Execute("INSERT INTO fshistory SET `stamp` = '" . date('Y-m-d h:i:s') . "', `status` = 'Unchanged', `file_path` = '$path', `hash_org` = 'Not Applicable', `hash_new` = 'Not Applicable', `file_last_mod` = 'Not Applicable', `acct` = '$acct'");
			if ($testing && (!$res)) fwrite($log, $db->error);

			// update scanned table
			$res = $db->Execute("INSERT INTO fsscanned SET `scanned` = '" . date('Y-m-d h:i:s') . "', `changes` = '$count_changes', `acct` = '$acct'");  
			if ($testing && (!$res)) fwrite($log, $db->error);

			$report .= "File structure is unchanged since last scan.\r\n\r\nThe baseline now contains $count_current files.\r\n\r\nScan executed in $elapsed seconds.";
	
		} else {
	
			$res = $db->Execute("INSERT INTO fsscanned SET `scanned` = '" . date('Y-m-d h:i:s') . "', `changes` = '$count_changes', `acct` = '$acct'");  
			if ($testing && (!$res)) fwrite($log, $db->error);

			$report .= "\r\n\r\nSummary:\r\n
Baseline start: $count_baseline
Current Baseline: $count_current
Changes to baseline: $count_changes\r\n
$indent Added: $count_added
$indent Altered: $count_altered
$indent Deleted: $count_deleted.\r\n
Scan executed in $elapsed seconds.";

			//if (0 < $count_changes) 
				//$report .= "\r\n\r\nIf you did not makes these changes, examine your files closely\r\nfor evidence of embedded hacker code or added hacker files.\r\n(WinMerge provides excellent comparisons)";
		}

		//	Clean-up history table and scanned table by deleting entries over 30 days old
		$res = $db->Execute("DELETE FROM fshistory WHERE `stamp` < DATE_SUB(NOW(), INTERVAL 30 DAY)");
		if ($testing && (!$res)) fwrite($log, "History table clean-up problem: " . $db->error . "<br />");

		$res = $db->Execute("DELETE FROM fsscanned WHERE `scanned` < DATE_SUB(NOW(), INTERVAL 30 DAY)");
		if ($testing && (!$res)) fwrite($log, "Scanned table clean-up problem: " . $db->error . "<br />");

		//	End of Report preparation and clean-up		
		
		//	OUTPUT Report
		
		//	E-mail Report
		if ($this->email_out && 0 < $count_changes)
		{
			$to =  (count($this->addresses)>1) ? implode(", ", $this->addresses) : $this->addresses[0];
			mail($to, "Scan Report for $acct",str_replace('&nbsp;',' ',$report)); 
		}

		if ($testing) fwrite($log, $report);

		//	Destroy tables (release to memory)
		$baseline = $current = $added = $altered = $deleted = array();

		$ret = fclose($log);
		
		if ($repout) 
			return(nl2br($report));
		else		
			return ($ret);	
	}
	
	public function scanReport($acc=null, $daysback=null, $minsback=null, $reportout=false, $date=null) {
		$db = GetGlobal('db');	
		$backtracedays = $daysback ? $daysback : 1;
		$backtracemins = $minsback ? $minsback : 0;
		$acct = $acc ? $acc : 'scanner';
		$repout = $reportout ? true : $this->report_out;
		
		$report = "Scan Report ($acct)\r\n\r\n";
		
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

		$results = $db->Execute("SELECT stamp, status, file_path, file_last_mod FROM fshistory WHERE acct = '$acct' AND stamp $gthan '$backtrace'");
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
				$links .= '<li><a href="'.$url.'">'.$n.'</a></li>';
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
                           <h4><i class="icon-reorder"></i> '.$title.'</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <!--a href="javascript:;" class="icon-remove"></a-->
                           </span>
                        </div>
                        <div class="widget-body">
							<div class="btn-toolbar">
							'. $buttons .'
							<hr/><div id="fdetails"></div>
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