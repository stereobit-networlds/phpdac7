<?php

$__DPCSEC['RCMESSAGES_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCMESSAGES_DPC")) && (seclevel('RCMESSAGES_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCMESSAGES_DPC",true);

$__DPC['RCMESSAGES_DPC'] = 'rcmessages';

$__EVENTS['RCMESSAGES_DPC'][0]='cpmessages';
$__EVENTS['RCMESSAGES_DPC'][1]='cpmsg';
$__EVENTS['RCMESSAGES_DPC'][2]='cpdelmessage';
$__EVENTS['RCMESSAGES_DPC'][3]='cpshowmessages';
$__EVENTS['RCMESSAGES_DPC'][4]='cpmessagesno';
$__EVENTS['RCMESSAGES_DPC'][5]='cpinbox';
$__EVENTS['RCMESSAGES_DPC'][6]='cpinboxno';
$__EVENTS['RCMESSAGES_DPC'][7]='cptasks';
$__EVENTS['RCMESSAGES_DPC'][8]='cptasksno';
$__EVENTS['RCMESSAGES_DPC'][9]='cpitemvisits';
$__EVENTS['RCMESSAGES_DPC'][10]='cpcatvisits';

$__ACTIONS['RCMESSAGES_DPC'][0]='cpmessages';
$__ACTIONS['RCMESSAGES_DPC'][1]='cpmsg';
$__ACTIONS['RCMESSAGES_DPC'][2]='cpdelmessage';
$__ACTIONS['RCMESSAGES_DPC'][3]='cpshowmessages';
$__ACTIONS['RCMESSAGES_DPC'][4]='cpmessagesno';
$__ACTIONS['RCMESSAGES_DPC'][5]='cpinbox';
$__ACTIONS['RCMESSAGES_DPC'][6]='cpinboxno';
$__ACTIONS['RCMESSAGES_DPC'][7]='cptasks';
$__ACTIONS['RCMESSAGES_DPC'][8]='cptasksno';
$__ACTIONS['RCMESSAGES_DPC'][9]='cpitemvisits';
$__ACTIONS['RCMESSAGES_DPC'][10]='cpcatvisits';

$__DPCATTR['RCMESSAGES_DPC']['cpmessages'] = 'cpmessages,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCMESSAGES_DPC'][0]='RCMESSAGES_DPC;Messages;Μηνύματα';
$__LOCALE['RCMESSAGES_DPC'][1]='_id;Id;Α/Α';
$__LOCALE['RCMESSAGES_DPC'][2]='_date;Date;Ημερομηνία';
$__LOCALE['RCMESSAGES_DPC'][3]='_message;Message;Μήνυμα';
$__LOCALE['RCMESSAGES_DPC'][4]='_type;Type;Τύπος';
$__LOCALE['RCMESSAGES_DPC'][5]='_visits;Visits;Επισκέπτες';
$__LOCALE['RCMESSAGES_DPC'][6]='_attr1;Category;Κατηγορία';
$__LOCALE['RCMESSAGES_DPC'][7]='_attr2;Visitor;Επισκέπτης';
$__LOCALE['RCMESSAGES_DPC'][8]='_attr3;Visitor;Επισκέπτης';
$__LOCALE['RCMESSAGES_DPC'][9]='_ip;Ip;Ip';
$__LOCALE['RCMESSAGES_DPC'][10]='_tid;Item;Είδος';
$__LOCALE['RCMESSAGES_DPC'][11]='_httpagent;Agent;Agent';

class rcmessages  {
	
	var $seclevid, $owner, $messages;

	public function __construct() {
		
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];		
		$this->owner = $_POST['Username'] ? $_POST['Username'] : GetSessionParam('LoginName');
		
		$this->messages = GetSessionParam('cpMessages') ? GetSessionParam('cpMessages') : array();
		$this->isCrm = false;
	}

    public function event($event=null) {

		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;

		switch ($event) {
			case 'cpitemvisits' : 	break;							 
			case 'cpcatvisists' : 	break;

			case 'cpinboxno'   	: 	//ajax call
									$tsk = $this->getInboxTotal();
									die($tsk);
									break;							 
			case 'cpinbox'     	: 	$tsk = $this->getInbox();
									die($tsk);
									break;								 

			case 'cptasksno'   	: 	//$this->site_stats();  
									$tsk = $this->getTasksTotal();
									die($tsk);
									break;	 							 
			case 'cptasks'     	: 	//SetSessionParam('cpTasks', ''); //reset tasks
									//$this->site_stats(); //read space task
									if (defined('RCULISTSTATS_DPC')) //read active campaign tasks
										_m('rculiststats.percentofCamps');
									$tsk = $this->getTasks();
									die($tsk);
									break;			
			
			case 'cpdelmessage' : 	//ajax call
									$msgs = $this->storeMessage();
									die('cpmessages|'.$msgs);
									break;	

			case 'cpshowmessages': 	break;	

			case 'cpmessagesno' :	//ajax call
			                        $msgs = $this->getMessagesTotal();
									die($msgs);
									break;			
			
			case 'cpmsg'    	:   break;  
			case 'cpmessages'   :   
			default             :   //ajax call
			                        $msgs = $this->getMessages();
									die($msgs);                
		}
    }

    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	

		switch ($action) {
			case 'cpitemvisits' : 	$out = $this->viewItemVisits(null,null,null,'r', true); 
									break;
			case 'cpcatvisits'  : 	$out = $this->viewCatVisits(null,null,null,'r', true); 
									break;	

			case 'cpinboxno'   	:					 
			case 'cpinbox'     	: 
			case 'cptasksno'   	: 
			case 'cptasks'     	:   break;									
			
		    case 'cpdelmessage' : 	break;	
			case 'cpshowmessages':  $out = $this->viewPastMessages(null,null,null,'r', true); 
									break;			
			
			case 'cpmsg'        : 	$out = $this->showMessages(null,null,null,'r', true); 
									break;
									
			case 'cpmessagesno' : 	$out = null; break;
			
			case 'cpmessages'   :
			default             :   $out = null;
		}

		return ($out);
    }
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}	
	
	public function isLevelUser($level=6) {
		return ($this->seclevid>=$level ? true : false);
	}	
	
	public function isCrmUser() {
		return ($this->seclevid>=_v('rccontrolpanel.crmLevel') ? true : false);
	}

	public function isCrmEnabled() {
		if ((defined('CRMFORMS_DPC')) && ($this->isCrmUser())) {
			$this->isCrm = true;
			return true;
		}	

		return false;		
	}	

    public function checkmail($data) {
		return (filter_var($data, FILTER_VALIDATE_EMAIL) ? true : false);
	}	

	
	/* cp header messages and tasks */ 	
	public function getMessagesTotal() {
		$db = GetGlobal('db');	
		
		$sSQL = "SELECT count(id) from stats where tid='action' and DATE(date) BETWEEN DATE( DATE_SUB( NOW() , INTERVAL 1 DAY ) ) AND DATE ( NOW() )order by date desc";
		$result = $db->Execute($sSQL);		
		$ret = $result->fields[0];
		
		return ($ret>10) ? '10' : strval($ret);		
	}	

	public function getMessages($limit=null) {
		$db = GetGlobal('db');	
		$lim = $limit ? $limit : 10;
		
		$sSQL = "SELECT date,tid,attr1,attr3 from stats where tid='action' and DATE(date) BETWEEN DATE( DATE_SUB( NOW() , INTERVAL 1 DAY ) ) AND DATE ( NOW() ) order by date desc limit " . $lim;
		$resultset = $db->Execute($sSQL);
		
		if (empty($resultset)) return null;
		foreach ($resultset as $n=>$rec) {		
			
			switch ($rec['attr1']) {
				case 'fblogin'     : 	$text = localize('_fblogin',getlocal()); 
										$cmd = 'cpusers.php'; 
										$tmpl = 'dropdown-notification-success'; 
										break;
				case 'fblogout'    : 	$text = localize('_logout',getlocal()); 
										$cmd = 'cpusers.php'; 
										$tmpl = 'dropdown-notification-info'; 
										break;				
				case 'login'       : 	$text = localize('_login',getlocal()); 
										$cmd = 'cpusers.php'; 
										$tmpl = 'dropdown-notification-success'; 
										break; 
				case 'logout'      : 	$text = localize('_logout',getlocal()); 
										$cmd = 'cpusers.php'; 
										$tmpl = 'dropdown-notification-info'; 
										break;
				case 'login-failed': 	$text = localize('_logfail',getlocal()); 
										$cmd = 'cpusers.php'; 
										$tmpl = 'dropdown-notification-important'; 
										break;
				default            : 	$text = null;  $cmd = 'cpform.php'; 
										$tmpl = 'dropdown-notification-warning'; 
			}
			
			$tokens[] = $rec['attr3'] . ' ' . $text;
			$tokens[] = _m('rccontrolpanel.timeSayWhen use ' . strtotime($rec[0]));			
			$tokens[] = $cmd;
			
			$tdata = _m("cmsrt.select_template use $tmpl+1");
			$ret .= $this->combine_tokens($tdata, $tokens, true);
			unset($tokens);	
		}
		
		return ($ret);			
	}
	
	/*delete msg from queue return rest-ajax*/
	public function storeMessage($limit=null) {
		$db = GetGlobal('db');	
		if (empty($this->messages)) return null;
		if (!$h = GetReq('hash')) return null;
		//print_r($this->messages);
		$tokens = array(); 
		$lim = $limit ? $limit : 6;
		
		//insert message into db
		$sSQL = "insert into cpmessages (hash, msg, type, owner) values (";
		$sSQL.= $db->qstr($h) . ",";
		$sSQL.= $db->qstr(GetReq('msg')) . ",";
		$sSQL.= $db->qstr(GetReq('type')) . ",";
		$sSQL.= $db->qstr($this->owner);
		$sSQL.= ")";
		//echo $sSQL;
		$result = $db->Execute($sSQL,1);			 
		$ret = $db->Affected_Rows(); 
		
		if ($ret) {
		
			//delete msg from session
			$nm = array();
			foreach ($this->messages as $hash=>$message) {
				if ($h!=$hash) 
					$nm[$hash] = $message;
			}
			$this->messages = (empty($nm)) ? null : $nm;
			SetSessionParam('cpMessages', $nm);
			if (empty($nm)) return null;
		
			//send out rest queue
			$msgs = array_reverse($nm, true);
			$i = 0;
			foreach ($msgs as $n=>$m) {
				$tokens = explode('|', $m); 
				switch (array_shift($tokens)) {
					case 'important' : $tmpl = 'dropdown-notification-important'; break;
					case 'success'   : $tmpl = 'dropdown-notification-success'; break;
					case 'warning'   : $tmpl = 'dropdown-notification-warning'; break;
					case 'error'     : $tmpl = 'dropdown-notification-error'; break;
					case 'info'      :
					default          : $tmpl = 'dropdown-notification-info';
				
				}
				$tdata = _m("cmsrt.select_template use $tmpl+1");
				$ret .= $this->combine_tokens($tdata, $tokens, true);
				unset($tokens);	
				$i+=1;
				if ($i>$lim) break;
			}
		}
		
		return ($ret);			
	}	

	public function setMessage($message=null, $daysback=null) {
		$db = GetGlobal('db');
		if (!$message) return false;
		
		$interval = $daysback ? $daysback : 90;
		$id = explode('|',$message);
		$hash = md5($id[0].$id[1]);
		
		//search in db for deleted msg
		$sSQL = "select hash from cpmessages where hash=" . $db->qstr($hash) . ' and owner=' . $db->qstr($this->owner);
		//of last 3 month
		$sSQl.= " and DATE(date) BETWEEN DATE( DATE_SUB( NOW() , INTERVAL $interval DAY ) ) AND DATE ( NOW() )";// order by DATE(date) desc";
		$result = $db->Execute($sSQL,1);			 
		//$ret = $db->Affected_Rows(); 
		//if ($result->fields[0]) echo $sSQL;
		//if message has viewed (isin db) return
        if ($result->fields[0]) return false;
		
		//add the message if not already in session		
		//if (array_key_exists($hash, $this->messages)) { /* in session */}
		//else {
			$this->messages[$hash] = $message;
			SetSessionParam('cpMessages', $this->messages);
			return true;
		//}
		//return false;	
	}

	protected function showMessages($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 600;
        $rows = $rows ? $rows : 25;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'r';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('RCMESSAGES_DPC',getlocal());		
	
		$ownerSQL = ($this->seclevid==9) ? null : "where owner='$this->owner'"; 		
		   	
		if (defined('MYGRID_DPC')) {
		   
			$sSQL = "select * from (SELECT id,date,type,msg FROM cpmessages where type='system' or type='cron' or type= 'analyzer' order by id desc";
            $sSQL.= ') as o';  				

		    _m("mygrid.column use grid9+id|".localize('_id',getlocal())."|5|1|");
			_m("mygrid.column use grid9+date|".localize('_date',getlocal()).'|5|1');		   
            _m("mygrid.column use grid9+type|".localize('_type',getlocal()).'|10|1');
            _m("mygrid.column use grid9+msg|".localize('_message',getlocal()).'|20|1');			

		    $out = _m("mygrid.grid use grid9+cpmessages+$sSQL+r+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		}
        else  
			$out = null;
		
	    return ($out);		   
	}	
	
	protected function viewPastMessages() {
	    $height = $height ? $height : 600;
        $rows = $rows ? $rows : 25;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'r';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('RCMESSAGES_DPC',getlocal());	
		
		$ownerSQL = ($this->seclevid==9) ? null : " and owner='$this->owner'"; 		
		$nonsysmsg = "type NOT REGEXP('system|cron|analyzer')";
		   	
		if (defined('MYGRID_DPC')) {
		   
			$sSQL = "select * from (SELECT id,date,type,msg FROM cpmessages where $nonsysmsg $ownerSQL order by date desc";
            $sSQL.= ') as o';  				

		    _m("mygrid.column use grid9+id|".localize('_id',getlocal())."|5|1|");
			_m("mygrid.column use grid9+date|".localize('_date',getlocal()).'|5|1');		   
            _m("mygrid.column use grid9+type|".localize('_type',getlocal()).'|10|1');
            _m("mygrid.column use grid9+msg|".localize('_message',getlocal()).'|20|1');			

		    $out .= _m("mygrid.grid use grid9+cpmessages+$sSQL+r+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		}
        else  
			$out .= null;
   		
	    return ($out);	
	}	

	public function viewMessages($template=null) {
		$this->messages = GetSessionParam('cpMessages');
		if (empty($this->messages)) return;
		$rtokens = array();
		
		if ((defined('CRMFORMS_DPC')) && ($this->isCrmUser())) {
			$template = 'crm-' . $template;
			$crm = true;
		}
		else
			$crm = false;
		
		foreach ($this->messages as $hash=>$message) {
			//echo $message;
			$tokens = explode('|', $message); 
			$status = $tokens[0]; //used as template (important|error...)
			$rtokens[] = $tokens[1]; //msg
			$rtokens[] = $tokens[2]; //time
			$rtokens[] = $tokens[3] ? $tokens[3] : '#'; //link
			$rtokens[] = $hash; //hash when link to delete
			
			$rtokens[] = $tokens[4] ? 
			   (((filter_var($tokens[4], FILTER_VALIDATE_EMAIL)) && $crm) ? _m("crmforms.formsMenu use ".$tokens[4]."+crmdoc") : null) : null;
			
			$st = $status ? '-' . $status : null;
			$statusTmpl = str_replace($template, $template.$st ,$template);
			$t = ($template!=null) ? _m("cmsrt.select_template use $statusTmpl+1") : null;
			
			$ret .= $t ? $this->combine_tokens($t, $rtokens) :
				         "<option value=\"$hash\">".$rtokens[0]."</option>";
			
			unset($rtokens);
		}
		//echo $ret;
		return ($ret);
	}		
	
	public function viewSysMessages($template=null) {
		$db = GetGlobal('db');
		
		$sSQL = "SELECT id,msg,date,hash FROM cpmessages where type='system' or type='cron' or type= 'analyzer' order by id desc LIMIT 4";
        $result = $db->Execute($sSQL);
		if (!$result) return ;
		
		foreach ($result as $i=>$rec) {
			//$status = 'important';
			$rtokens = array();
			$rtokens[] = $rec[1]; //msg
			$rtokens[] = _m('rccontrolpanel.timeSayWhen use ' . strtotime($rec[2])); //time
			$rtokens[] = $this->isLevelUser(8) ? 'cpmessages.php?t=cpmsg' :'#'; //link
			$rtokens[] = $rec[3]; //hash
			
			$st = $status ? '-' . $status : null;
			$statusTmpl = str_replace($template, $template.$st ,$template);
			$t = ($template!=null) ? _m("cmsrt.select_template use $statusTmpl+1") : null;
			
			$ret .= $t ? $this->combine_tokens($t, $rtokens) :
			             "<option value=\"$hash\">".$rtokens[1]."</option>"; 
			
			unset($rtokens);
		}
		//echo $ret;
		return ($ret);
	}	
	
	protected function viewCatVisits() {
	    $height = $height ? $height : 600;
        $rows = $rows ? $rows : 25;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'r';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_visits',getlocal());		
		
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat']; 	
		   	
		if (defined('MYGRID_DPC')) {
		   
			$sSQL = "select * from (SELECT id,date,attr1,attr2,attr3,REMOTE_ADDR,HTTP_USER_AGENT FROM stats WHERE attr1='$cat'";
            $sSQL.= ') as o';  

		    _m("mygrid.column use grid9+id|".localize('_id',getlocal())."|5|0|");
			_m("mygrid.column use grid9+date|".localize('_date',getlocal()).'|5|0');		   
            _m("mygrid.column use grid9+attr1|".localize('_attr1',getlocal()).'|5|0');
            _m("mygrid.column use grid9+attr2|".localize('_attr2',getlocal()).'|5|0');			
            _m("mygrid.column use grid9+attr3|".localize('_attr3',getlocal()).'|5|0');
            _m("mygrid.column use grid9+REMOTE_ADDR|".localize('_ip',getlocal()).'|5|0');			
			_m("mygrid.column use grid9+HTTP_USER_AGENT|".localize('_httpagent',getlocal()).'|10|0');

		    $out .= _m("mygrid.grid use grid9+stats+$sSQL+r+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");
		}
        else  
			$out .= null;
		
	    return ($out);	
	}		
	
	protected function viewItemVisits() {
	    $height = $height ? $height : 600;
        $rows = $rows ? $rows : 25;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'r';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_visits',getlocal());		
		
		$cpGet = _v('rcpmenu.cpGet');
		$id = _m("cmsrt.getRealItemCode use " . $cpGet['id']); 	
		   	
		if (defined('MYGRID_DPC')) {
		   
			$sSQL = "select * from (SELECT id,date,tid,attr2,attr3,REMOTE_ADDR,HTTP_USER_AGENT FROM stats WHERE tid='$id'";
            $sSQL.= ') as o';  

		    _m("mygrid.column use grid9+id|".localize('_id',getlocal())."|5|0|");
			_m("mygrid.column use grid9+date|".localize('_date',getlocal()).'|5|0');		   
            _m("mygrid.column use grid9+tid|".localize('_tid',getlocal()).'|5|0');
            _m("mygrid.column use grid9+attr2|".localize('_attr2',getlocal()).'|5|0');			
            _m("mygrid.column use grid9+attr3|".localize('_attr3',getlocal()).'|5|0');
            _m("mygrid.column use grid9+REMOTE_ADDR|".localize('_ip',getlocal()).'|5|0');			
	        _m("mygrid.column use grid9+HTTP_USER_AGENT|".localize('_httpagent',getlocal()).'|10|0');		

		    $out .= _m("mygrid.grid use grid9+stats+$sSQL+r+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");
		}
        else  
			$out .= null;
		
	    return ($out);	
	}

	public function viewCategoryStatistics($template=null) {
		$db = GetGlobal('db');
		$cpGet = _v('rcpmenu.cpGet');	
		$cat = $cpGet['cat'];
		
		if ((defined('CRMFORMS_DPC')) && ($this->isCrmUser())) {
			$template = 'crm-' . $template;
			$crm = true;
		}
		else
			$crm = false;		
		
		$t = $template ? _m("cmsrt.select_template use $template+1") : null;		
		
        $timein = _m('rccontrolpanel.sqlDateRange use date+1+1');			
		$noBots = _m('rccontrolpanel.avoidBotsSQL use HTTP_USER_AGENT+1');
		
		$sSQL = "SELECT id,date,DATE_FORMAT(date, '%d-%m-%Y') as day,attr2,attr3,REMOTE_ADDR FROM stats where $noBots attr1='$cat' $timein group by day,attr2,attr3,REMOTE_ADDR order by id desc LIMIT 100";
        $result = $db->Execute($sSQL);
		if (!$result) return ;

		foreach ($result as $i=>$rec) {
			$rtokens = array();
			$visitor = $this->checkmail($rec['attr3']) ? $rec['attr3'] : 
							($this->checkmail($rec['attr2']) ? $rec['attr2'] : $rec['REMOTE_ADDR']);
							
			$rtokens[] = $rec['attr3'] ? $rec['attr3'] . " (" . $rec['REMOTE_ADDR'] . ")" : 
			                             $rec['attr2'] . " (" . $rec['REMOTE_ADDR'] . ")"; 
			$rtokens[] = _m('rccontrolpanel.timeSayWhen use ' . strtotime($rec['date'])); 
			$rtokens[] = $crm ? 'cpcrmtrace.php?t=cpcrmprofile&v='.$visitor : '#'; //link
			$rtokens[] = null;//$rec[3]; //hash
			
			$rtokens[] =  ((filter_var($visitor, FILTER_VALIDATE_EMAIL)) && $crm) ? _m("crmforms.formsMenu use ".$visitor."+crmdoc") : null;
						
			
			$ret .= $t ? $this->combine_tokens($t, $rtokens) : 
			             "<option value=\"$hash\">".$rtokens[1]."</option>";
			
			unset($rtokens);
		}
		return ($ret);
	}	

	public function viewItemStatistics($template=null) {
		$db = GetGlobal('db');
		$cpGet = _v('rcpmenu.cpGet');
		$id = _m("cmsrt.getRealItemCode use " . $cpGet['id']);
		
		if ((defined('CRMFORMS_DPC')) && ($this->isCrmUser())) {
			$template = 'crm-' . $template;
			$crm = true;
		}
		else
			$crm = false;		
		
		$t = $template ? _m("cmsrt.select_template use $template+1") : null;
		
        $timein = _m('rccontrolpanel.sqlDateRange use date+1+1');			
		$noBots = _m('rccontrolpanel.avoidBotsSQL use HTTP_USER_AGENT+1');
			
		$sSQL = "SELECT id,date,DATE_FORMAT(date, '%d-%m-%Y') as day,attr2,attr3,REMOTE_ADDR FROM stats where $noBots tid='$id' $timein group by day,attr2,attr3,REMOTE_ADDR order by id desc LIMIT 100";
        $result = $db->Execute($sSQL);

		if (!$result) return ;
		
		foreach ($result as $i=>$rec) {
			$rtokens = array();
			$visitor = $this->checkmail($rec['attr3']) ? $rec['attr3'] : 
							( $this->checkmail($rec['attr2']) ? $rec['attr2'] : $rec['REMOTE_ADDR']);
			
			$rtokens[] = $rec['attr3'] ? $rec['attr3'] . " (" . $rec['REMOTE_ADDR'] . ")" : 
			                             $rec['attr2'] . " (" . $rec['REMOTE_ADDR'] . ")"; 
			$rtokens[] = _m('rccontrolpanel.timeSayWhen use ' . strtotime($rec['date'])); 
			$rtokens[] = $crm ? 'cpcrmtrace.php?t=cpcrmprofile&v='.$visitor : '#'; //link
			$rtokens[] = null;//$rec[3]; //hash
			
			$rtokens[] = ($this->checkmail($visitor) && $crm) ? _m("crmforms.formsMenu use $visitor+crmdoc") : null;
						
			
			$ret .= $t ? $this->combine_tokens($t, $rtokens) : 
			             "<option value=\"$hash\">".$rtokens[1]."</option>";
			
			unset($rtokens);
		}
		return ($ret);
	}	
	
	
	/////////////////////////////// TASK MESSAGES		
	
	//alias, tasks var in rccontrolpanel
	public function setTask($task=null) {
		return _m('rccontrolpanel.setTask use ' . $task);
	}	
	
	public function getTasksTotal() { 
		$tasks = _v('rccontrolpanel.tasks');
		
		$ret = (empty($tasks)) ? null : strval(count($tasks));
		return $ret;		
	}		

	public function getTasks($limit=null) {
		$tasks = _v('rccontrolpanel.tasks');		
		if (empty($tasks)) return null;

		$tokens = array(); 
		$lim = $limit ? $limit : 6;
		$msgs = array_reverse($tasks, true);
		$i = 0;
		foreach ($msgs as $n=>$m) {
			$tokens = explode('|', $m); 
			switch (array_shift($tokens)) {
				case 'active'    : $tmpl = 'dropdown-task-progress-active'; break;
				case 'success'   : $tmpl = 'dropdown-task-progress-success'; break;
				case 'warning'   : $tmpl = 'dropdown-task-progress-warning'; break;
				case 'danger'    : $tmpl = 'dropdown-task-progress-danger'; break;
				case 'info'      :
				default          : $tmpl = 'dropdown-task-progress-info';
				
			}
			$tdata = _m("cmsrt.select_template use $tmpl+1");
			$ret .= $this->combine_tokens($tdata, $tokens, true);
			unset($tokens);	
			$i+=1;
			if ($i>$lim) break;
		}
		
		return ($ret);			
	}	
	

	/////////////////////////////// INBOX MESSAGES
	
	//alias, inbox var in rccontrolpanel
	public function setInbox($message=null) {
		return _m('rccontrolpanel.setInbox use ' . $message);
	}		
	
	public function getInboxTotal() {
		$db = GetGlobal('db');	
		
		$sSQL = "SELECT count(id) from stats where tid='event' and attr1 REGEXP 'registration|subscribe|unsubscribe|activation|contact|cart-submit' and DATE(date) BETWEEN DATE( DATE_SUB( NOW() , INTERVAL 1 DAY ) ) AND DATE ( NOW() ) order by date desc";
		$result = $db->Execute($sSQL);		
		$ret = $result->fields[0];
		
		return ($ret>10) ? '10' : strval($ret);		
	}

	public function getInbox($limit=null) {
		$db = GetGlobal('db');	
		$lim = $limit ? $limit : 10;
		$tdata = _m('cmsrt.select_template use dropdown-inbox-message+1');
		
		$sSQL = "SELECT date,tid,attr1,attr3 from stats where tid='event' and attr1 REGEXP 'registration|subscribe|unsubscribe|activation|contact|cart-submit' and DATE(date) BETWEEN DATE( DATE_SUB( NOW() , INTERVAL 1 DAY ) ) AND DATE ( NOW() ) order by date desc limit " . $lim;
		$resultset = $db->Execute($sSQL);
		
		if (empty($resultset)) return null;
		foreach ($resultset as $n=>$rec) {		
			
			$tokens[] = $rec['attr3']; 
			
			switch ($rec['attr1']) {
				case 'registration': 	$text = localize('_reginbox',getlocal()); 
										$cmd = 'cpusers.php'; 
										break; 
				case 'activation'  : 	$text = localize('_actinbox',getlocal()); 
										$cmd = 'cpusers.php'; 
										break; 
				case 'subscribe'   : 	$text = localize('_subinbox',getlocal()); 
										$cmd = 'cpsubscribers.php'; 
										break; 
				case 'unsubscribe' : 	$text = localize('_unsubinbox',getlocal()); 
										$cmd = 'cpsubscribers.php'; 
										break; 
				case 'cart-submit' : 	$text = localize('_sale',getlocal()); 
										$cmd = 'cptransactions.php'; 
										break;
				case 'contact'     : 	$text = localize('_formsubmit',getlocal()); 
										$cmd = 'cpform.php'; 
										break;
				default            : 	$text = null; 
			}
			
			$tokens[] = $text;
			$tokens[] = _m('rccontrolpanel.timeSayWhen use ' . strtotime($rec[0]));			
			$tokens[] = $cmd;
			
			$ret .= $this->combine_tokens($tdata, $tokens, true);
			unset($tokens);	
		}
		
		return ($ret);			
	}			
	
	
	//cp html call, last month check 
	public function getInactiveUsers() {
		$db = GetGlobal('db');
		$text = localize('_inactiveuser',getlocal());
		$sSQL = "select username,timein from users where active=0 and DATE(timein) BETWEEN DATE( DATE_SUB( NOW() , INTERVAL 30 DAY ) ) AND DATE ( NOW() ) order by DATE(timein) desc";
		$result = $db->Execute($sSQL,2);

		foreach ($result as $i=>$rec) {
			$saytime = _m('rccontrolpanel.timeSayWhen use ' . strtotime($rec[1]));
			$msg = "warning|" . $text .' '. $rec[0] . "|$saytime|cpusers.php|".$rec[0];
			$this->setMessage($msg);
		}
		return null;
	} 
	
	//cp html call, last month check 
	public function getActiveUsers() {
		$db = GetGlobal('db');
		$text = localize('_newactiveuser',getlocal());
		$sSQL = "select username,timein from users where active=1 and DATE(timein) BETWEEN DATE( DATE_SUB( NOW() , INTERVAL 10 DAY ) ) AND DATE ( NOW() ) order by DATE(timein) desc";
		$result = $db->Execute($sSQL,2);

		foreach ($result as $i=>$rec) {
			$saytime = _m('rccontrolpanel.timeSayWhen use ' . strtotime($rec[1]));
			$msg = "success|" . $text .' '. $rec[0] . "|$saytime|cpusers.php|".$rec[0];
			$this->setMessage($msg);
		}
		return null;
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

		for ($x=$i;$x<30;$x++)
		  $ret = str_replace("$".$x."$",'',$ret);

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