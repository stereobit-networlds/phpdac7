<?php

$__DPCSEC['RCULISTSTATS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCULISTSTATS_DPC")) && (seclevel('RCULISTSTATS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCULISTSTATS_DPC",true);

$__DPC['RCULISTSTATS_DPC'] = 'rculiststats';

$__EVENTS['RCULISTSTATS_DPC'][0]='cpuliststats';

$__ACTIONS['RCULISTSTATS_DPC'][0]='cpuliststats';

$__DPCATTR['RCULISTSTATS_DPC']['cpuliststats'] = 'cpuliststats,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCULISTSTATS_DPC'][0]='RCULISTSTATS_DPC;Statistics;Στατιστική';
$__LOCALE['RCULISTSTATS_DPC'][1]='_viewallnotifications;View all notifications;Όλες οι ειδοποιήσεις';
$__LOCALE['RCULISTSTATS_DPC'][2]='_outoflist;out of list;αφαίρεση απο';
$__LOCALE['RCULISTSTATS_DPC'][3]='_mailsent;e-Mails sent;e-Mails που στάλθηκαν';
$__LOCALE['RCULISTSTATS_DPC'][4]='_mailtosend;e-Mails to send;e-Mails προς αποστολή';
$__LOCALE['RCULISTSTATS_DPC'][5]='_taskprocess;Task process;Εξέλιξη εργασιών';
$__LOCALE['RCULISTSTATS_DPC'][6]='_viewallnotifications;View all notifications;Όλα τα μηνύματα';
$__LOCALE['RCULISTSTATS_DPC'][7]='_views;Views;Επισκέψεις';
$__LOCALE['RCULISTSTATS_DPC'][8]='_bqueue;Queue;Λίστα';
$__LOCALE['RCULISTSTATS_DPC'][9]='_runningcamps;Running campaigns;Καμπάνιες σε εξέλιξη';
$__LOCALE['RCULISTSTATS_DPC'][10]='_activequeue;Active queue;Υπόλοιπο λίστας';
$__LOCALE['RCULISTSTATS_DPC'][11]='_breg;Subscriptions;Εγγραφές';
$__LOCALE['RCULISTSTATS_DPC'][12]='_bunreg;Unsubscribed;Διαγραφές';
$__LOCALE['RCULISTSTATS_DPC'][13]='_bounce;Bounce mails;Επιστροφές e-mail';
$__LOCALE['RCULISTSTATS_DPC'][14]='_bclick;Clicked;Μετάβαση στη σελίδα';

class rculiststats  {

    var $title, $urlpath, $prpath, $seclevid, $userDemoIds;
	var $savehtmlpath, $cid, $messages, $stats, $cpStats, $owner, $cptemplate;

	public function __construct() {
		$GRX = GetGlobal('GRX');
		$this->title = localize('RCULISTSTATS_DPC',getlocal());
		$this->prpath = paramload('SHELL','prpath'); 
		$this->urlpath = paramload('SHELL','urlpath');

		//$tmpl = remote_paramload('FRONTHTMLPAGE','cptemplate',$this->prpath);  
	    //$this->cptemplate = $tmpl ? $tmpl : 'metro';		
		
		$tmplsavepath = remote_paramload('RCBULKMAIL','tmplsavepath', $this->prpath);
		$savepath = $tmplsavepath ? $tmplsavepath : null;//$defaultsavepath;
		$this->savehtmlpath = $savepath ? $this->urlpath . $savepath : null;		
		
		$this->seclevid = GetSessionParam('ADMINSecID');
		$this->userDemoIds = array(5,6);//,7); //remote_arrayload('RCBULKMAIL','demouser', $this->prpath);
		$this->owner = $_POST['Username'] ? $_POST['Username'] : GetSessionParam('LoginName'); //decode(GetSessionParam('UserName'));		
		
		$this->cid = $_GET['cid'] ? $_GET['cid'] : $_POST['cid'];
		
		$this->messages = array(); //reset messages any time page reload - local msg system
		$this->stats = array();
		$this->cpStats = false;	

		$this->crmLevel = 9;		
	}

    public function event($event=null) {

		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;		
		
		switch ($event) {				 			
			case 'cpuliststats'  :
			default              :  	
		}
    }

    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	

		switch ($action) {
			case 'cpuliststats'   	   :
			default          		   : $this->runstats();	
		}
		
		//when stats run (used by timeline fun call into breadcrumb)
		$this->cpStats = $this->isStats();			

		return ($out);
    }

	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}
	
	public function isLevelUser($level=6) {
		return ($this->seclevid>=$level ? true : false);
	}	
	
	public function isCrmUser() {
		return ($this->seclevid>=$this->crmLevel ? true : false);
	}	
	
	
	public function viewMessages($template=null) {
		if (empty($this->messages)) return;
	    $t = ($template!=null) ? _m("cmsrt.select_template use $template+1") : null;
		
		foreach ($this->messages as $m=>$message) {
			if ($t) 	
				$ret .= $this->combine_tokens($t, array(0=>$message));
			else
				$ret .= "<option value=\"$m\">$message</option>";
		}
		return ($ret);
	}	
	
	protected function show_select_camp($name, $taction=null, $class=null) {
		$db = GetGlobal('db');		
		$timein = $this->sqlDateRange('timein', true, false);
		//all as 9 user or only owned		
		$ownerSQL = null;//($this->seclevid==9) ? null : ' and owner=' . $db->qstr($this->owner);			

		$sSQL = 'select cdate,cid,title from mailcamp where '.$timein . $ownerSQL ;

	    $choose = "<option value=\"\">Select...</option>";
		
		$sSQL .= " and active=1";
		$sSQL .= " ORDER BY cdate desc";
     
        $mycid = $cid ? $cid : $this->cid; /*new post or load camp request */ 		

		//echo $sSQL;	
	    $resultset = $db->Execute($sSQL,2);	
	
		$url = ($taction) ? seturl('t='.$taction.'&cid=',null,null,null,null) : 
		                    seturl('t=cpuliststats&cid=',null,null,null,null);
	 
		$ret .= "<select name=\"$name\" onChange=\"location=this.options[this.selectedIndex].value\" $class>"; 
		$ret .= $choose ? $choose : null; //"<option value=\"\">Select...</option>";
		//print_r($resultset);
		
		if (empty($resultset)) return null;
		foreach ($resultset as $n=>$rec) {
			$selection = ($rec[1] == $mycid) ? " selected" : null;
			$ret .= "<option value='".$url . $rec[1]."' $selection >". $rec[2]."</option>" ;
        }		
		$ret .= "</select>";			    	
		       
	    return ($ret);		
	}		

    public function campaignSelect($action=null) {

		$ret = $this->show_select_camp('campaign', $action, 'class="span6 chzn-select" data-placeholder="Choose a Category" tabindex="1"');		
		return ($ret);
	}		
	
	
	
	public function runSql($name, $sql, $retasis=false) {
		$db = GetGlobal('db');			
		if (!$sql) return 0;
		$resultset = $db->Execute($sql,2);
		
		if ($retasis==false) { //save in stats and return int
			$this->stats[$name]['value'] = $resultset->fields[0];	
			return intval($resultset->fields[0]); 	
		}
		
		return ($resultset->fields[0]);
	}		
	
	protected function sqlDateRange($fieldname, $istimestamp=false, $and=false) {
		$sqland = $and ? ' AND' : null;
		if ($daterange = GetParam('rdate')) {//post
			$range = explode('-',$daterange);
			$dstart = str_replace('/','-',trim($range[0]));
			$dend = str_replace('/','-',trim($range[1]));
			if ($istimestamp)
				$dateSQL = $sqland . " DATE($fieldname) BETWEEN STR_TO_DATE('$dstart','%m-%d-%Y') AND STR_TO_DATE('$dend','%m-%d-%Y')";
			else			
				$dateSQL = $sqland . " $fieldname BETWEEN STR_TO_DATE('$dstart','%m-%d-%Y') AND STR_TO_DATE('$dend','%m-%d-%Y')";
			
			//$this->messages[] = 'Range selection:'.$daterange;			
		}				
		elseif ($y = GetReq('year')) {
			if ($m = GetReq('month')) { $mstart = $m; $mend = $m;} else { $mstart = '01'; $mend = '12'; $m='12';}
			$daysofmonth = cal_days_in_month(CAL_GREGORIAN, $m, $y);	
			if ($istimestamp)
				$dateSQL = $sqland . " DATE($fieldname) BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";
			else
				$dateSQL = $sqland . " $fieldname BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";
			
			//$this->messages[] = 'Combo selection:'.$m.'-'.$y;
		}	
        else {
			//always this year by default
			//$mstart = '01'; $mend = '12';
			
			$mstart = $mend = date('m');
			$y = date('Y');
			$daysofmonth = date('t');
			if ($istimestamp)
				$dateSQL = $sqland . " DATE($fieldname) BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";
			else
				$dateSQL = $sqland . " $fieldname BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";	
            //echo $dateSQL;			
		}	
		
		return ($dateSQL);
	}
	
	protected function runstats() {
		$db = GetGlobal('db');
		
		//all as 9 user or only owned		
		$ownerSQL = null; // for all //($this->seclevid==9) ? null : ' and owner=' . $db->qstr($this->owner);		
		
		$sSQLcid = ($this->cid) ? " and cid=" . $db->qstr($this->cid) : null;
		
		$timein = $this->sqlDateRange('startdate', false);
		$datein = $this->sqlDateRange('datein', true);

		$sSQL = "select count(id) from ulists where active=0 and " . $datein;		
		$this->runSql('inactiveSubscribers', $sSQL);			
		$sSQL = "select count(id) from ulists where active=1 and " . $timein;		
		$this->runSql('activeSubscribers', $sSQL);		
		$sSQL = "select count(id) from ulists where active=1";// . $timein;	
		//echo $sSQL;
		$ts = $this->runSql('totalSubscribers', $sSQL);		
		//echo $ts;
		
		$timein = $this->sqlDateRange('timein', true, true);
		$cidortime = $sSQLcid ? $sSQLcid : $timein;		
		
		$sSQL = "select count(id) from mailqueue where active=1" . $ownerSQL . $cidortime ;		
		$this->runSql('activeQueue', $sSQL);		
		$sSQL = "select count(id) from mailqueue where active=0" . $ownerSQL . $cidortime ;		
		$this->runSql('inactiveQueue', $sSQL);
		
		//all campaign msgs, -9 is stopped campaign, -8 paused
		$sSQL = "select count(id) from mailqueue where active is not null " . $ownerSQL . $cidortime ; 
		$tq = $this->runSql('totalQueue', $sSQL); 		
		//echo $tq, $sSQL;
		$sSQL = "select count(id) from mailqueue where active=0 " . $ownerSQL . $cidortime ; 
		$tq1 = $this->runSql('totalQueue', $sSQL); 			
		
		$sSQL = "select sum(reply) from mailqueue where status>0 and active=0" . $ownerSQL . $cidortime ;	
		$this->runSql('repliedQueue', $sSQL);			
		$sSQL = "select count(id) from mailqueue where status>0 and active=0" . $ownerSQL . $cidortime;  //on sent mails (active=0)	
		$sc = $this->runSql('succeed', $sSQL);
		$sSQL = "select count(id) from mailqueue where status IS NULL and active=0" . $ownerSQL . $cidortime;  //on sent mails (active=0)		
		$ul = $this->runSql('unread', $sSQL);	
		$sSQL = "select count(id) from mailqueue where status=-1 and active=0" . $ownerSQL . $cidortime;  //on sent mails (active=0)		
		$bl = $this->runSql('badmail', $sSQL);			
		$sSQL = "select count(id) from mailqueue where status=-2 and active=0" . $ownerSQL . $cidortime;  //on sent mails (active=0)		
		$fl = $this->runSql('bounced', $sSQL);			
		$sSQL = "select count(id) from mailqueue where (active=1 or active=-8)" . $ownerSQL . $cidortime;  //on sent mails (active=0) // or active=-9		
		$sl = $this->runSql('notsentyet', $sSQL);			
	
		$sSQL = "SELECT COUNT( DISTINCT (subject) ) FROM mailqueue where active=1" . $ownerSQL;	
		$this->runSql('runningCampaigns', $sSQL);

		//percent of sends and replies (uniques=status)
		$rpercent = round($sc*100/$tq1); // (on current inactive mails) - tq = all mails
		$this->stats['percentSucceed']['value'] = intval($rpercent);

		//percent of unread sents
		$upercent = round($ul*100/$tq1); //tq
		$this->stats['percentUnread']['value'] = intval($upercent);	
		
		//percent of failed sents
		$this->stats['failed']['value'] = $bl + $fl;	
		$fpercent = round(($bl+$fl)*100/$tq1); //tq
		$this->stats['percentFailed']['value'] = intval($fpercent);		

		//percent of have to sent
		$spercent = round($sl*100/$tq);
		$this->stats['percentUnsend']['value'] = intval($spercent);			
        //echo $sl,':',$tq,':',$spercent; 
							
		//print_r($this->stats);							
        $this->messages[] = 'Stats completed.';
		return true;
	}
	
	public function getStats($section=null, $subsection=null) {
		if (!$section) return 0;
		$sb = $subsection ? $subsection : 'value';
		$n = intval($this->stats[$section][$sb]);
		
		return (number_format($n,0,',','.'));
	}	
	
	public function isStats() {
		return (!empty($this->stats) ? true : false);
	}
	
	public function getCampaignName($id=null) {
		$db = GetGlobal('db');	
		$cid = $id ? $id : $this->cid;
		if (!$cid) return null;	
		
		$sSQL = 'select title from mailcamp where cid=' . $db->qstr($cid);
		$res = $db->Execute($sSQL,2);

		return ($res->fields[0] ? $res->fields[0] : null);
	}	
	
	/* % of process of active camps*/
	public function percentofCamps($template=null) {
		$db = GetGlobal('db');			
		$t = ($template!=null) ? _m("cmsrt.select_template use $template+1") : null;
		$tokens = array();
		//get params also here due to fp call for rccontrol panel (login 1st)
		$this->owner = $_POST['Username'] ? $_POST['Username'] : GetSessionParam('LoginName'); //decode(GetSessionParam('UserName'));	
		$this->seclevid = GetSessionParam('ADMINSecID');			
		
		//all as 9 user or only owned		
		$ownerSQL = ($this->seclevid==9) ? null : ' and owner=' . $db->qstr($this->owner);	
		$timein = ($ownerSQL) ? $this->sqlDateRange('timein', true, true) : 
							    $this->sqlDateRange('timein', true, false);
		$dateRangeSQL = $timein ? (($ownerSQL) ? $timein : ' and ' . $timein) : null;
		
		$sSQL = "SELECT cid,subject,AVG(active),MIN(timein),MAX(timein) AS a FROM mailqueue where active>=0 $ownerSQL $dateRangeSQL group by cid,subject order by a desc";
		$resultset = $db->Execute($sSQL,2);
		//echo $sSQL; //, $resultset->fields[1];
		
		if (empty($resultset->fields)) return null;
		foreach ($resultset as $n=>$rec) {
		    if ($rec[2] > 0) { //float avg of actives (else must be 0)

					$percent = (100-intval($rec[2]*100));
					
					//send message to cp task indicator 
					//$mt = seturl('t=cppreviewcamp&cid='.$rec[0]);
					$mt = 'cpbulkmail.php?t=cppreviewcamp&cid='.$rec[0];
					_m("rccontrolpanel.setTask use danger|$rec[1]|$percent|$mt");					
					
					//normal render
					if ($t) {
						$tokens[] = $rec[0];
						$tokens[] = $rec[1];
						$tokens[] = $percent;
						$tokens[] = $rec[3];
						$tokens[] = '...'; //$rec[4];
						$ret .= $this->combine_tokens($t, $tokens);
						unset($tokens);
					}	
			}	
		}

		return ($ret);	
	}		
	
	/* % of process of last deactived camps*/
	public function lastCamps($template=null, $limit=null) {
		$db = GetGlobal('db');		
		$t = ($template!=null) ? _m("cmsrt.select_template use $template+1") : null;
		$tokens = array();
		//get params also here due to fp call for rccontrol panel (login 1st)
		$this->owner = $_POST['Username'] ? $_POST['Username'] : GetSessionParam('LoginName'); 
		$this->seclevid = GetSessionParam('ADMINSecID');			
		
		//all as 9 user or only owned	
		$ownerSQL = ($this->seclevid==9) ? null : ' and owner=' . $db->qstr($this->owner); 
		$timein = ($ownerSQL) ? $this->sqlDateRange('timein', true, true) : 
							    $this->sqlDateRange('timein', true, false);
		$dateRangeSQL = $timein ? (($ownerSQL) ? $timein : ' and ' . $timein) : null;
		
		$l = $limit ? $limit : 3;	
        $limitSQL = $limit ? 'LIMIT '.$l : 'LIMIT 3'; 	
		
		$sSQL = "SELECT cid,subject,AVG(active),MIN(timein),MAX(timeout) AS a FROM mailqueue where active>=0 $ownerSQL $dateRangeSQL GROUP BY cid,subject ORDER BY a DESC ".$limitSQL;
		//echo $sSQL;
		$resultset = $db->Execute($sSQL,2);
		
		if (empty($resultset->fields)) return null;
		foreach ($resultset as $n=>$rec) {
		    if ($rec[2] == 0) { //float avg of actives (must be 0)
				if ($t) {
					$tokens[] = $rec[0];
					$tokens[] = $rec[1];
					$tokens[] = (100-intval($rec[2]*100));
					$tokens[] = $rec[3];
					$tokens[] = $rec[4];					
					$ret .= $this->combine_tokens($t, $tokens);
					unset($tokens);
				}
				else
					$ret[] = $rec[1]; //?? no mean
			}	
		}

		return ($ret);	
	}	
	
	/* % of process of all the same cid camps (instances = replayed)*/
	public function instanceCamps($template=null, $limit=null) {
		if (!$cid = $_GET['cid']) return false;
		$db = GetGlobal('db');			
		$l = $limit ? $limit : 5;
		$t = ($template!=null) ? _m("cmsrt.select_template use $template+1") : null;
		$tokens = array();
		
		$sSQL = "SELECT cid,subject, AVG(active),MIN(timein),MAX(timeout) AS a FROM  mailqueue where cid='$cid' GROUP BY subject ORDER BY a DESC LIMIT ".$l;
		$resultset = $db->Execute($sSQL,2);
		//echo $sSQL;
		foreach ($resultset as $n=>$rec) {

			if ($t) {
				$tokens[] = $rec[0];
				$tokens[] = $rec[1];
				$tokens[] = (100-intval($rec[2]*100));
				$tokens[] = $rec[3];
				$tokens[] = $rec[4];						
				$ret .= $this->combine_tokens($t, $tokens);
				unset($tokens);
			}
			else
				$ret[] = $rec[1]; //no mean
		}

		return ($ret);	
	}	
	
	public function getViews($template=null, $limit=null) {
		$db = GetGlobal('db');	
		$l = $limit ? $limit : 5;
		$cid = $_GET['cid'] ? $_GET['cid'] : null;	
		
		if ((defined('CRMFORMS_DPC')) && ($this->isCrmUser())) {
			$template = 'crm-' . $template;
			$crm = true;
		}
		else
			$crm = false;
		
		$t = ($template!=null) ? _m("cmsrt.select_template use $template+1") : null;
		$tokens = array();
		
		$refsql = $cid ? "and cid='$cid'" : null;		
		
		//all as 9 user or only owned
		$ownerSQL = null ;//($this->seclevid==9) ? null : 'and owner=' . $db->qstr($this->owner); 		
		
		$sSQL = "SELECT id,timeout,receiver,subject FROM mailqueue where active=0 and status=1 $refsql $ownerSQL order by id desc LIMIT " . $l;
		//echo $sSQL;
		$resultset = $db->Execute($sSQL,2);
		
		if (empty($resultset)) return null;
		foreach ($resultset as $n=>$rec) {
			$saytime = _m('rccontrolpanel.timeSayWhen use '. strtotime($rec[1]));
			$tokens[] = $saytime . ', '. $rec[3];
			$tokens[] = $crm ?	_m("crmforms.formsMenu use ".$rec[2]."+crmdoc") : $rec[2];
			
			$ret .= $this->combine_tokens($t, $tokens);
			unset($tokens);	
		}

		return ($ret);			
	}	
	
	public function getMailBounce($template=null, $limit=null) {
		$db = GetGlobal('db');	
		$l = $limit ? $limit : 5;
		$cid = $_GET['cid'] ? $_GET['cid'] : null;		
		$t = ($template!=null) ? _m("cmsrt.select_template use $template+1") : null;
		$tokens = array();
		
		$refsql = $cid ? "and cid='$cid'" : null;
				
		//all as 9 user or only owned
		$ownerSQL = null;//($this->seclevid==9) ? null : 'and owner=' . $db->qstr($this->owner); 		
		
		$sSQL = "SELECT id,timeout,receiver,subject FROM mailqueue where active=0 and status=-2 $refsql $ownerSQL order by id desc LIMIT " . $l;
		//echo $sSQL;
		$resultset = $db->Execute($sSQL,2);
		
		if (empty($resultset)) return null;
		foreach ($resultset as $n=>$rec) {
			$saytime = _m('rccontrolpanel.timeSayWhen use '. strtotime($rec[1]));
			$tokens[] = $saytime . ', '. $rec[3];
			$tokens[] = $rec[2];
			$ret .= $this->combine_tokens($t, $tokens);
			unset($tokens);	
		}

		return ($ret);			
	}	
	
	public function getClicks($template=null, $limit=null) {
		$db = GetGlobal('db');	
		$l = $limit ? $limit : 5;
		$cid = $_GET['cid'] ? $_GET['cid'] : null;	
		
		if ((defined('CRMFORMS_DPC')) && ($this->isCrmUser())) {
			$template = 'crm-' . $template;
			$crm = true;
		}
		else
			$crm = false;
		
		$t = ($template!=null) ? _m("cmsrt.select_template use $template+1") : null;
		$tokens = array();
		
		//$timein = $this->sqlDateRange('timein', true, false);
		//if ($timein) return null; //no current tasks when time range
		$refsql = $cid ? "and mailcamp.cid='$cid'" : null;
		
		//all as 9 user or only owned	
		$ownerSQL = null;//($this->seclevid==9) ? null : 'and mailcamp.owner=' . $db->qstr($this->owner); 		
		
		$sSQL = "SELECT stats.id,date,attr3,title FROM stats,mailcamp where stats.ref=mailcamp.cid $refsql $ownerSQL order by stats.id desc LIMIT " . $l;
		//echo $sSQL;
		$resultset = $db->Execute($sSQL,2);
		
		if (empty($resultset)) return null;
		foreach ($resultset as $n=>$rec) {
			$saytime = _m('rccontrolpanel.timeSayWhen use '. strtotime($rec[1]));
			$tokens[] = $saytime . ', '. $rec[3];
			$tokens[] = $crm ?	_m("crmforms.formsMenu use ".$rec[2]."+crmdoc") : $rec[2];
			
			$ret .= $this->combine_tokens($t, $tokens);
			unset($tokens);	
		}

		return ($ret);			
	}
	
	public function getClicksAll($template=null, $limit=null) {
		$db = GetGlobal('db');	
		$l = $limit ? $limit : 50;
		$cid = $_GET['cid'] ? $_GET['cid'] : null;		
		$t = ($template!=null) ? _m("cmsrt.select_template use $template+1") : null;
		$tokens = array();
		
		$sSQL = "SELECT stats.id,date,attr3,title,ref FROM stats,mailcamp where stats.ref=mailcamp.cid group by ref order by date desc LIMIT " . $l;
		$resultset = $db->Execute($sSQL,2);
		
		if (empty($resultset)) return null;
		foreach ($resultset as $n=>$rec) {
			$tokens[] = $rec[1] . ' '. $rec[3];
			$tokens[] = $rec[2];
			$ret .= $this->combine_tokens($t, $tokens);
			unset($tokens);
		}

		return ($ret);	
	}	

	/*unsubscribers 1 month before*/
	public function getUnsubs($template=null, $limit=null) {
		$db = GetGlobal('db');	
		$l = $limit ? $limit : 5;
		$cid = $_GET['cid'] ? $_GET['cid'] : null;		
		$t = ($template!=null) ? _m("cmsrt.select_template use $template+1") : null;
		$tokens = array();
		
		//$timein = $this->sqlDateRange('timein', true, false);
		//if ($timein) return null; //no current tasks when time range
		$refsql = null; //$cid ? "and ref='$cid'" : null;
		
		//all as 9 user or only owned
		$ownerSQL = null;//($this->seclevid==9) ? null : null;//'and ulists.owner=' . $db->qstr($this->owner); 		
		
		$lastmonth = mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"));
		
		$sSQL = "SELECT datein,listname,email FROM ulists where active=0 and (datein>$lastmonth) $refsql $ownerSQL order by datein desc LIMIT " . $l;
		$resultset = $db->Execute($sSQL,2);

		if (empty($resultset)) return null;
		foreach ($resultset as $n=>$rec) {
			$tokens[] = _m('rccontrolpanel.timeSayWhen use '. strtotime($rec[0])) .' '. $rec[1]; //date('d-m-Y G:i',strtotime($rec[0])) . ' '. $rec[1];
			$tokens[] = $rec[2];
			$ret .= $this->combine_tokens($t, $tokens);
			unset($tokens);	
		}

		return ($ret);			
	}	
	

    public function select_timeline($template,$year=null, $month=null) {
		$year = GetParam('year') ? GetParam('year') : date('Y'); 
	    $month = GetParam('month') ? GetParam('month') : date('m');
		$daterange = GetParam('rdate');
		
		$t = ($template!=null) ? _m("cmsrt.select_template use $template+1") : null;		
	    if ($t) {
			for ($y=(date('Y')-2); $y<=intval(date('Y')); $y++) {
				$yearsli .= '<li>'. seturl('month='.$month.'&year='.$y, $y) .'</li>';
			}
		
			for ($m=1;$m<=12;$m++) {
				$mm = sprintf('%02d',$m);
				$monthsli .= '<li>' . seturl('month='.$mm.'&year='.$year, $mm) .'</li>';
			}	  
	        
			$camptitle = $this->getCampaignName();
	        $posteddaterange = $daterange ? ' &gt ' . $daterange : ($year ? ' &gt ' . $month . ' ' . $year : null) ;
	  
			$tokens[] = localize('RCULISTSTATS_DPC',getlocal()) . $posteddaterange . ' &gt ' . $camptitle; 
			$tokens[] = $year;
			$tokens[] = $month;
			$tokens[] = localize('_year',getlocal());
			$tokens[] = $yearsli;
			$tokens[] = localize('_month',getlocal());			
			$tokens[] = $monthsli;	
            $tokens[] = $daterange;			
		
			$ret = $this->combine_tokens($t, $tokens); 				
     
			return ($ret);
		}
		
		return null;	
    }	  
	
	protected function nformat($n, $dec=0) {
		return (number_format($n,$dec,',','.'));
	}		
	
	protected function combine_tokens($template, $tokens, $execafter=null) {
	    if (!is_array($tokens)) return;		

		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
			$fp = new fronthtmlpage(null);
			$ret = $fp->process_commands($template);
			unset ($fp);		  		
		}		  		
		else
			$ret = $template;
		  
	    foreach ($tokens as $i=>$tok) 
		    $ret = str_replace("$".$i."$",$tok,$ret);

		//clean unused token marks
		for ($x=$i;$x<30;$x++)
			$ret = str_replace("$".$x."$",'',$ret);

		
		//execute after replace tokens
		if (($execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
			$fp = new fronthtmlpage(null);
			$retout = $fp->process_commands($ret);
			unset ($fp);
          
			return ($retout);
		}		
		
		return ($ret);
	}	
};
}
?>