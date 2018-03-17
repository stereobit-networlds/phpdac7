<?php

$__DPCSEC['RCBMAILBOUNCE_DPC']='1;1;1;1;1;1;2;2;9;9;9';

if ( (!defined("RCBMAILBOUNCE_DPC")) && (seclevel('RCBMAILBOUNCE_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCBMAILBOUNCE_DPC",true);

$__DPC['RCBMAILBOUNCE_DPC'] = 'rcbmailbounce';


$__EVENTS['RCBMAILBOUNCE_DPC'][0]='cpbmailbounce';
$__EVENTS['RCBMAILBOUNCE_DPC'][1]='cpbouncedel';
$__EVENTS['RCBMAILBOUNCE_DPC'][2]='cpbounceview';
$__EVENTS['RCBMAILBOUNCE_DPC'][3]='cpbmbtrack';

$__ACTIONS['RCBMAILBOUNCE_DPC'][0]='cpbmailbounce';
$__ACTIONS['RCBMAILBOUNCE_DPC'][1]='cpbouncedel';
$__ACTIONS['RCBMAILBOUNCE_DPC'][2]='cpbounceview';
$__ACTIONS['RCBMAILBOUNCE_DPC'][3]='cpbmbtrack';

$__LOCALE['RCBMAILBOUNCE_DPC'][0]='RCBMAILBOUNCE_DPC;Bmail bounce;Bmail bounce';

class rcbmailbounce {
	
	var $title, $prpath, $urlpath, $url;
	var $cpanelmailpath, $sendermailfolder, $folder;

    function __construct() {
		
	  $this->prpath = paramload('SHELL','prpath');
      $this->urlpath = paramload('SHELL','urlpath');	
	  $this->url = paramload('SHELL','urlbase');
	  $this->title = localize('RCBMAILBOUNCE_DPC',getlocal());

	  $rootpath = paramload('RCCONTROLPANEL','rootpath', $this->prpath);
      $this->cpanelmailpath = $rootpath ? '/home/'.$rootpath.'/mail/' : '/home/stereobi/mail/';	 
	  $sender = remote_paramload('RCBULKMAIL','user',$this->prpath); //default
	  $mp = explode('@',$sender);
	  $this->sendermailfolder = $mp[1] . '/' . str_replace('.','_',$mp[0]) . '/cur/';
	  $this->folder = $this->cpanelmailpath . $this->sendermailfolder; 
	}
	
    function event($event=null) {
	
	   $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   if ($login!='yes') return null;			

       if (!$this->msg) {
  
	     switch ($event) {
		    case 'cpbounceview'   : break;
			case 'cpbnbtrack'     : $out = $this->ulist_track(); 
			                        break;
		    case 'cpbouncedel'    : unlink($this->folder . $_GET['eml']);				
	                                break;									
			case 'cpbmailbounce'  :
			default               :							  
         }
      }
    }	

    function action($action=null)  { 
	
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;

	     switch ($action) {
		   case 'cpbounceview'   : $out = $this->view_report(); break;	 
		   case 'cpbnbtrack'     : 
		   case 'cpbouncedel'    : 
		   case 'cpbmailbounce'  :		   
		   default               : $out = $this->fetchmails(); //mails_indir_bounce_only();
		 }			 

	     return ($out);
	}
	
	protected function fetchmails() {
		$maxf = 800; //100 * 24
		$ret = null;		
		
		$mfiles = scandir($this->folder, 1); //desc
		if (empty($mfiles)) return ($this->folder . " : Empty<br/>");	
		
		$c = count($mfiles);
		$max = ($c<$maxf) ? $c : $maxf;
		
		$ret = "<h3>Mails ($max):</h3>";
		$bouncehandler = new Bouncehandler();
		
		//set_time_limit(120);
		for ($f=0;$f<=$max;$f++) {
			
			$file = $mfiles[$f];
			$fsize = filesize($this->folder . $file);
			
			if ($file=='.' || $file=='..' || $fsize>(1024*20)) continue; //20kb max
			
			echo $f .'-'. $file . "<br/>";
			$bounce = @file_get_contents($this->folder . $file);
			$rep = $bouncehandler->parse_email($bounce); 
			if ($a = $bouncehandler->is_a_bounce()) { 
				$to = $rep[0]['recipient'];

				$ret .= "<a href=\"".$_SERVER['PHP_SELF']."?t=cpbounceview&eml=".urlencode($file)."\">$file</a>";
				$ret .= " was last modified: " . date ("d m Y H:i:s.", filemtime($this->folder . $file)) . "<br/>\n";
				$ret .= " Send to: " . seturl('t=cpbmbtrack&to='.urlencode($to),$to) . "<br/>\n";
				$ret .= seturl('t=cpbouncedel&eml='.urlencode($file),'Delete') . "<br/>\n";				
				
				echo $ret;
			    $ret = null;
			}
		}
		//set_time_limit(ini_get('max_execution_time'));	
		
		return ($ret);
	}

	protected function mails_indir() {
		$lastmonth = mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"));
		$lastweek = mktime(0, 0, 0, date("m"), date("d")-7,   date("Y"));
		$ret = null;
		
		//$ret = $this->folder;
		if ($handle = opendir($this->folder)) {
			$ret = "<h3>Mails:</h3>";
			
			while (false !== ($file = readdir($handle))) {
				if($file=='.' || $file=='..') continue;
				//if (strstr($file,'1460228648')) {
				$t = filemtime($this->folder . $file);		
				if ($t > $lastweek) 	
					$f[$t] = $file;
			}

			closedir($handle);
		}
		if (empty($f)) return ($ret);
		krsort($f);
		foreach ($f as $ft=>$file) {
			$ret .= "<a href=\"".$_SERVER['PHP_SELF']."?t=cpbounceview&eml=".urlencode($file)."\">$file</a>";
			$ret .= " was last modified: " . date ("d m Y H:i:s.", $ft) ."<br/>\n";
		}
		
		return ($ret);	
	}	
	
	protected function mails_indir_bounce_only() {
		$lastmonth = mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"));
		$lastweek = mktime(0, 0, 0, date("m"), date("d")-7,   date("Y"));
		$lastday = mktime(0, 0, 0, date("m"), date("d")-1,   date("Y"));
		$today = mktime(0, 0, 0, date("m"), date("d")-1,   date("Y"));
		$ret = null;

		if ($handle = opendir($this->folder)) {
			$ret = "<h3>Mails:</h3>\n";
            $bouncehandler = new Bouncehandler();
			
			set_time_limit(120);
			$i=0;
			while (($i<1000) && (false !== ($file = readdir($handle)))) {
				if($file=='.' || $file=='..') continue;
				
				$t = filemtime($this->folder . $file);	
				if ($t >= $today) { //$lastweek) {
					$bounce = @file_get_contents($this->folder . $file);
					$rep = $bouncehandler->parse_email($bounce); 
					if ($a = $bouncehandler->is_a_bounce()) { 
					    
						$f[$t] = $file;
						
						//fetch to
						//$bounce = $bouncehandler->init_bouncehandler($bounce, 'string');
						//list($head, $body) = preg_split("/\r\n\r\n/", $bounce, 2);	
						//$head_hash = $bouncehandler->parse_head($head);
						//print_r($rep);
						$l[$t] = $rep[0]['recipient'];//$head_hash['to'];
					}	
				}
				$i+=1;
			}
			
			set_time_limit(ini_get('max_execution_time'));

			closedir($handle);
		}
		
		if (empty($f)) return ($ret);
		
		krsort($f); 
		krsort($l);
		foreach ($f as $ft=>$file) {
			$ret .= "<a href=\"".$_SERVER['PHP_SELF']."?t=cpbounceview&eml=".urlencode($file)."\">$file</a>";
			//$ret .= " was last modified: " . date ("d m Y H:i:s.", $ft) . "<br/>\n";
			$ret .= " Send to: " . seturl('t=cpbmbtrack&to='.urlencode($l[$ft]),$l[$ft]) . "<br/>\n";
			$ret .= seturl('t=cpbouncedel&eml='.urlencode($file),'Delete') . "<br/>\n";
		}
		
		return ($ret);			
	}		
	
	protected function view_report() {
		$mfile = $_GET['eml'];
		$bouncehandler = new Bouncehandler();
		
		$ret = "<HR><P><B>".$mfile."</B>  --  ";
		$ret.= "<a href=\"cpbmailbounce.php\">Back</a></P>";
		
		$bounce = @file_get_contents($this->folder . $mfile);

		$multiArray = $bouncehandler->get_the_facts($bounce);
		$ret .= "<TEXTAREA COLS=300 ROWS=".(count($multiArray)*8).">";
		//print_r($bouncehandler); exit;

		$ret .= print_r($multiArray, true);
		$ret .= "</TEXTAREA>";

		$bounce = $bouncehandler->init_bouncehandler($bounce, 'string');
		list($head, $body) = preg_split("/\r\n\r\n/", $bounce, 2);	
		
		$ret .= "<hr><h2>Here is the parsed head</h2>\n";
		$head_hash = $bouncehandler->parse_head($head);
		$ret .= "<TEXTAREA COLS=100 ROWS=".(count($head_hash)*2.7).">";
		$ret .= print_r($head_hash, true);
		$ret .= "</TEXTAREA>";

		if ($bouncehandler->is_RFC1892_multipart_report($head_hash) === TRUE) {
			$ret .= "<h2><font color=red>Looks like an RFC1892 multipart report</font></H2>";
		}
		else if ($bouncehandler->looks_like_an_FBL === TRUE){
			
			$ret .= "<h2><font color=red>It's a Feedback Loop, ";
			if($bouncehandler->is_hotmail_fbl)
				$ret .= " in Hotmail Doofus Format (HDF?)</font></H2>";
			else
				$ret .= " in Abuse Feedback Reporting Format (ARF)</font></H2>";
		}
		else {
			$ret .= "<h2><font color=red>Not an RFC1892 multipart report</font></H2>";
			$ret .= "<TEXTAREA COLS=300 ROWS=100>";
			$ret .= print_r($body, true);
			$ret .= "</TEXTAREA>";
			//exit;
			return ($ret);
		}


		$ret .= "<h2>Here is the parsed report</h2>\n";
		$ret .= "<P>Postfix adds an appropriate X- header (X-Postfix-Sender:), so you do not need to create one via phpmailer.  RFC's call for an optional Original-recipient field, but mandatory Final-recipient field is a fair substitute.</P>";
		$boundary = $head_hash['Content-type']['boundary'];
		$mime_sections = $bouncehandler->parse_body_into_mime_sections($body, $boundary);
		$rpt_hash = $bouncehandler->parse_machine_parsable_body_part($mime_sections['machine_parsable_body_part']);
		$ret .= "<TEXTAREA COLS=100 ROWS=".(count($rpt_hash)*16).">";
		$ret .= print_r($rpt_hash, true);
		$ret .= "</TEXTAREA>";

		$ret .= "<h2>Here is the error status code</h2>\n";
		$ret .= "<P>It's all in the status code, if you can find one.</P>";
		for($i=0; $i<count($rpt_hash['per_recipient']); $i++){
			$ret .= "<P>Report #".($i+1)."<BR>\n";
			$ret .= $bouncehandler->find_recipient($rpt_hash['per_recipient'][$i]);
			$scode = $rpt_hash['per_recipient'][$i]['Status'];
			$ret .= "<PRE>$scode</PRE>";
			$ret .= $bouncehandler->fetch_status_messages($scode);
			$ret .= "</P>\n";
		}

		$ret .= "<h2>The Diagnostic-code</h2> <P>is not the same as the reported status code, but it seems to be more descriptive, so it should be extracted (if possible).";
		for($i=0; $i<count($rpt_hash['per_recipient']); $i++){
			$ret .= "<P>Report #".($i+1)." <BR>\n";
			$ret .= $bouncehandler->find_recipient($rpt_hash['per_recipient'][$i]);
			$dcode = $rpt_hash['per_recipient'][$i]['Diagnostic-code']['text'];
			if($dcode){
				$ret .= "<PRE>$dcode</PRE>";
				$ret .= $bouncehandler->fetch_status_messages($dcode);
			}
			else{
				$ret .= "<PRE>couldn't decode</PRE>";
			}
			$ret .= "</P>\n";
		}

		$ret .= "<H2>Grab original To: and From:</H2>\n";
		$ret .= "<P>Just in case we don't have an Original-recipient: field, or a X-Postfix-Sender: field, we can retrieve information from the (optional) returned message body part</P>\n";
		$head = $bouncehandler->get_head_from_returned_message_body_part($mime_sections);
		$ret .= "<P>From: ".$head['From']."<br>To: ".$head['To']."<br>Subject: ".$head['Subject']."</P>";

		$ret .= "<h2>Here is the body in RFC1892 parts</h2>\n";
		$ret .= "<P>Three parts: [first_body_part], [machine_parsable_body_part], and [returned_message_body_part]</P>";
		$ret .= "<TEXTAREA cols=300 rows=100>";
		$ret .= print_r($mime_sections, true);
		$ret .= "</TEXTAREA>";		

		return ($ret);	
	}
	
	protected function ulist_track($email=null) {
		$db = GetGlobal('db');
		$to = $email ? $email : $_GET['to'];
		
		$sSQL = "select failed from ulists where email=" . $db->qstr($to);
		$result = $db->Execute($sSQL,2);
		
		$xtimes = $result->fields[0] ? intval($result->fields[0])+1 : 1;
		
		$sSQL = 'update ulists set failed=' . $xtimes . " where email=" . $db->qstr($to);
		$result = $db->Execute($sSQL,1);
		
		return true;
	}
	
	//can be used by cron
	public function cleanBounce($app=null,$days=1,$delete=false) {
		$db = GetGlobal('db'); 
		$maxf = 800; //100 * 24
		$ret = null;
		
		if ($app) {
			$appprpath = str_replace('/cp', '/'.$app.'/cp', $this->prpath);
			//echo $appprpath;
			//$sender = remote_paramload('RCBULKMAIL','user', $appprpath);
			$appconfig = @parse_ini_file($appprpath . "myconfig.txt", 1, INI_SCANNER_NORMAL);	
			$sender = $appconfig['RCBULKMAIL']['user'];
			//echo $sender;
			if (!$sender) return ('conf error:'.$app);
			//$this->sendermailfolder = '.' . str_replace('.','_',$sender) . '/cur/'; //.link to folder cur
			$mp = explode('@',$sender);
			$this->sendermailfolder = $mp[1] . '/' . str_replace('.','_',$mp[0]) . '/cur/';
			$this->folder = $this->cpanelmailpath . $this->sendermailfolder;		
			//echo '>App:', $this->folder;
			
			//direct call to db for ulists update
			GetGlobal('controller')->calldpc_method('database.switch_db use '.$app);		 
			$db = GetGlobal('db'); 				
		}
		
		$mfiles = scandir($this->folder, SCANDIR_SORT_DESCENDING); //1/ //desc
		if (empty($mfiles)) return ($this->folder . " : Empty\n");	
		
		$c = count($mfiles);
		$max = ($c<$maxf) ? $c : $maxf;		
		
		$bouncehandler = new Bouncehandler();
		
		for ($f=0;$f<=$max;$f++) {
			
			$file = $mfiles[$f];
			$fsize = @filesize($this->folder . $file);
			
			if ($file=='.' || $file=='..' || $fsize>(1024*20)) continue; //20kb max
			
			//echo $file . "\r\n";
			$bounce = @file_get_contents($this->folder . $file);
			$rep = $bouncehandler->parse_email($bounce); 
			if ($a = $bouncehandler->is_a_bounce()) { 
				$to = $rep[0]['recipient'];
				
				$sSQL = "select failed from ulists where email=" . $db->qstr($to);
				$result = $db->Execute($sSQL,2);
		
				$xtimes = $result->fields[0] ? intval($result->fields[0])+1 : 1;
		
				$sSQL = 'update ulists set failed=' . $xtimes . " where active=1 and email=" . $db->qstr($to);
				$result = $db->Execute($sSQL,1);

				//also update mailqueue (last sending mail)		
				$sSQL = "select id from mailqueue where active=0 and receiver=" . $db->qstr($to) . " order by id desc LIMIT 1";
				$result = $db->Execute($sSQL,2);
						
				$sSQL = "update mailqueue set status=-2, mailstatus='BOUNCE' where id=" . $result->fields[0];
				$result = $db->Execute($sSQL,1);

				$ret .= $file;
				$ret .= " was last modified: " . date ("d m Y H:i:s.", filemtime($this->folder . $file));
				$ret .= " Send to: " . $to ."\n";
				if ($delete==true) {
					$ret .= "Deleted\r\n";
					unlink($this->folder . $file);
				}				
			}
		}		
		
		return $ret;			
	}
					
};
}
?>