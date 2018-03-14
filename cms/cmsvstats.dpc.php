<?php
$__DPCSEC['CMSVSTATS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CMSVSTATS_DPC")) && (seclevel('CMSVSTATS_DPC',decode(GetSessionParam('UserSecID')))) ) {

define("CMSVSTATS_DPC",true);

$__DPC['CMSVSTATS_DPC'] = 'cmsvstats';

$__EVENTS['CMSVSTATS_DPC'][0]='cmsvstats';
$__EVENTS['CMSVSTATS_DPC'][1]='cmsvmcstart';

$__ACTIONS['CMSVSTATS_DPC'][0]='cmsvstats';
$__ACTIONS['CMSVSTATS_DPC'][1]='cmsvmcstart';

$__DPCATTR['CMSVSTATS_DPC']['cmsvstats'] = 'cmsvstats,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['CMSVSTATS_DPC'][0]='CMSVSTATS_DPC;Statistics;Στατιστική';


//http://stackoverflow.com/questions/12257584/how-to-detect-fake-users-crawlers-and-curl

//test
//SELECT count(tid), count(attr1),`HTTP_USER_AGENT` FROM `stats` where `HTTP_USER_AGENT` NOT LIKE 'Mozilla%' group by `HTTP_USER_AGENT` order by date DESC LIMIT 5000

class cmsvstats  {

    var $title;
	var $mc, $cid, $hashtag;
	var $http_referer;
		
	public function __construct() {

		$this->title = localize('CMSVSTATS_DPC',getlocal());			
	  
		$this->hashtag = $_COOKIE['hashtag']; //fetch generic hashtag if any
		$this->cid = $_COOKIE['cid']; //fetch mail campaign id	  
		$this->mc = $_COOKIE['mc'];	//fetch client mail base64encoded
	  
		//save reference at start
		if (!$this->http_referer = $_SESSION['http_referer']) { 
			$this->http_referer = $_SERVER['HTTP_REFERER'];
			$_SESSION['http_referer'] = $_SERVER['HTTP_REFERER'];	
		}
		//echo $this->http_referer .'>';	
		
		//alternative for long sessions
		/*if (!isset($_COOKIE['origin_ref'])) {
			$this->http_referer = $_SERVER['HTTP_REFERER'];
			setcookie('http_referer', $_SERVER['HTTP_REFERER']);		
		}*/
	  
		$this->javascript(); //check for hash and save cookies	  
	}
	

    public function event($event=null) {		 

		switch ($event) {
		   
			case 'cmsvmcstart'  : $this->callback_update_first_referece_record();
								die();// $this->mc.','.$this->cid.','.$this->hashtag);
								break; 

			case 'cmsvstats'   :
			default            : 
		}
		
    }   

    public function action($action=null) {

		switch ($action) {
		  
			case 'cmsvmcstart' : break;  
			case 'cmsvstats'   :
			default            : $out .= $this->show_statistics();

		}	 
		return ($out);
    }

	
	protected function javascript() {
        if (iniload('JAVASCRIPT')) {
		
		    //return no js when tags already loaded 
			if (isset($this->hashtag) || (isset($this->cid) && isset($this->mc))) {}
			else {	
				$code.= $this->javascript_redir();				
		
				$js = new jscript;
				$js->load_js($code,"",1);			   
				unset ($js);		
			}	
     	}	  
	}
	
    protected function javascript_redir()  {
   
		$jscript = <<<EOF
function redir(url) {
    http.open('get', url+'&ajax=1');
    //http.onreadystatechange = handleRedir;
    http.send(null);
}
function handleRedir() {if(http.readyState == 4){
    var response = http.responseText;
    var update = new Array();
    response = response.replace( /^\s+/g, "" );  
    response = response.replace( /\s+$/g, "" ); 		
    if(response.indexOf('|' != -1)) { update = response.split('|');
        document.getElementById(update[0]).innerHTML = update[1];
	}}}

if (window.location.hash) {
	var hash = window.location.hash.substring(1);
	var value = hash.split("|");
	if (value[1]!=null) { cc("cid",value[0],"1"); cc("mc",value[1],"1");} else cc("hashtag",hash,"1");
	sndUrl("katalog.php?t=cmsvmcstart");
}
else { }
	  
EOF;

		return ($jscript);
	}		
	
	
	
	//hash can't fetched for first time by php (not yet saved in cookies)
	//this function update the last rec were no tag info = first in tags history
	//run once when cookie set
	protected function callback_update_first_referece_record() {
        $db = GetGlobal('db'); 
        $UserName = GetGlobal('UserName');	
		$name = $UserName ? decode($UserName) : session_id();
		$ref = $this->cid ? $this->cid : ($this->hashtag ? $this->hashtag : '');
		$cmail = $this->mc ? base64_decode($this->mc) : '';		
		$day = date('d'); $month = date('m'); $year = date('Y');
		$sSQL = "select id from stats where attr2=" . $db->qstr($name) . " and (attr3='' or ref='') ";
		$sSQL.= "and year='$year' and month='$month' and day='$day' order by id desc LIMIT 1";
     	$res = $db->Execute($sSQL,2);
        if (!empty($res->fields)) {
			$sSQL = "update stats set attr3=".$db->qstr($cmail).", ref=".$db->qstr($ref)." where id=".$res->fields[0];
			//echo $sSQL;
			$db->Execute($sSQL,1);	 		
			if ($db->Affected_Rows()) 
				return true;
        }	
		return false;			
	}	

	public function update_item_statistics($id, $attr1=null, $iref=null) {
        $db = GetGlobal('db'); 
        $UserName = GetGlobal('UserName');	
		$name = $UserName ? decode($UserName) : session_id();

		if ((GetSessionParam('ADMIN')) || (_m("cms.isUaBot")))
			return false;

	    $currentdate = time();
	    $mydate = $db->qstr(date('Y-m-d h:i:s',$currentdate));		
	    $myday  = date('d',$currentdate);	
	    $mymonth= date('m',$currentdate);	
	    $myyear = date('Y',$currentdate);

		$ref = $this->cid ? $this->cid : ($this->hashtag ? $this->hashtag : ($iref ? $iref : ''));
		$cmail = $this->mc ? base64_decode($this->mc) : '';		
						
		$sSQL = "insert into stats (day,month,year,tid,attr2,attr3,ref,attr1,REMOTE_ADDR,HTTP_X_FORWARDED_FOR,HTTP_USER_AGENT,REFERER) values (";
		$sSQL.= $myday . ",";
		$sSQL.= $mymonth . ",";
		$sSQL.= $myyear . ",";						
		$sSQL.= $db->qstr($id) . ',';
        $sSQL.= $db->qstr($name) . ','; 
		$sSQL.= $db->qstr($cmail) . ',';
		$sSQL.= $db->qstr($ref) . ",";		
		$sSQL.= $db->qstr($attr1) . ",";
		$sSQL.= $db->qstr($_SERVER['REMOTE_ADDR']) . ",";
		$sSQL.= $db->qstr($_SERVER['HTTP_X_FORWARDED_FOR']) . ","; 
		$sSQL.= $db->qstr($_SERVER['HTTP_USER_AGENT']). ",";
		$sSQL.= $db->qstr($this->http_referer). ")";			
		//echo $sSQL;
		$db->Execute($sSQL,1);	 		
		if ($db->Affected_Rows()) 
		  return true;
		else 
		  return false;		
	}

	public function update_category_statistics($cat, $tid=null, $iref=null) {
        $db = GetGlobal('db'); 
		
		if ((GetSessionParam('ADMIN')) || (_m("cms.isUaBot")))
			return false;		

        $UserName = GetGlobal('UserName');		
		$name = $UserName ? decode($UserName) : session_id();			
	    $currentdate = time();
	    $mydate = $db->qstr(date('Y-m-d h:i:s',$currentdate));		
	    $myday  = date('d',$currentdate);	
	    $mymonth= date('m',$currentdate);	
	    $myyear = date('Y',$currentdate);	
		
		$ref = $this->cid ? $this->cid : ($this->hashtag ? $this->hashtag : ($iref ? $iref : ''));
		$cmail = $this->mc ? base64_decode($this->mc) : '';

		$sSQL = "insert into stats (day,month,year,attr1,attr2,attr3,ref,tid,REMOTE_ADDR,HTTP_X_FORWARDED_FOR,HTTP_USER_AGENT,REFERER) values (";
		$sSQL.= $myday . ",";
		$sSQL.= $mymonth . ",";
		$sSQL.= $myyear . ",";						
		$sSQL.= $db->qstr($cat) . ",";		
		$sSQL.= $db->qstr($name) . ","; 
		$sSQL.= $db->qstr($cmail) . ",";
		$sSQL.= $db->qstr($ref) . ",";		
		$sSQL.= $db->qstr($tid) . ",";
		$sSQL.= $db->qstr($_SERVER['REMOTE_ADDR']) . ",";
		$sSQL.= $db->qstr($_SERVER['HTTP_X_FORWARDED_FOR']) . ","; 
		$sSQL.= $db->qstr($_SERVER['HTTP_USER_AGENT']). ",";
		$sSQL.= $db->qstr($this->http_referer). ")";	
		//echo $sSQL;		
		$db->Execute($sSQL,1);	 		

		if ($db->Affected_Rows()) {
		  return true;
		}  
		else 
		  return false;		
	}	

	public function update_page_statistics($id, $attr1=null, $iref=null) {
        $db = GetGlobal('db'); 
        $UserName = GetGlobal('UserName');	
		$name = $UserName ? decode($UserName) : session_id();
		
		if ((GetSessionParam('ADMIN')) || (_m("cms.isUaBot")))
			return false;		
	
	    $currentdate = time();
	    $myday  = date('d',$currentdate);	
	    $mymonth= date('m',$currentdate);	
	    $myyear = date('Y',$currentdate);

		$ref = $this->cid ? $this->cid : ($this->hashtag ? $this->hashtag : ($iref ? $iref : ''));
		$cmail = $this->mc ? base64_decode($this->mc) : '';		
						
		$sSQL = "insert into stats (day,month,year,tid,attr2,attr3,ref,attr1,REMOTE_ADDR,HTTP_X_FORWARDED_FOR,HTTP_USER_AGENT,REFERER) values (";
		$sSQL.= $myday . ",";
		$sSQL.= $mymonth . ",";
		$sSQL.= $myyear . ",";						
		$sSQL.= $db->qstr($id) . ',';
        $sSQL.= $db->qstr($name) . ','; 
		$sSQL.= $db->qstr($cmail) . ',';
		$sSQL.= $db->qstr($ref) . ",";		
		$sSQL.= $db->qstr($attr1) . ",";
		$sSQL.= $db->qstr($_SERVER['REMOTE_ADDR']) . ",";
		$sSQL.= $db->qstr($_SERVER['HTTP_X_FORWARDED_FOR']) . ","; 
		$sSQL.= $db->qstr($_SERVER['HTTP_USER_AGENT']). ",";
		$sSQL.= $db->qstr($this->http_referer). ")";				
		//echo $sSQL;
		$db->Execute($sSQL,1);	 		
		if ($db->Affected_Rows()) 
		  return true;
		else 
		  return false;		
	}

	public function update_action_statistics($id, $user=null) {
        $db = GetGlobal('db'); 
		
		if ((GetSessionParam('ADMIN')) || (_m("cms.isUaBot")))
			return false;		

	    $currentdate = time();	
	    $myday  = date('d',$currentdate);	
	    $mymonth= date('m',$currentdate);	
	    $myyear = date('Y',$currentdate);
						
		$sSQL = "insert into stats (day,month,year,tid,attr1,attr3,REMOTE_ADDR,HTTP_X_FORWARDED_FOR,HTTP_USER_AGENT,REFERER) values (";
		$sSQL.= $myday . ",";
		$sSQL.= $mymonth . ",";
		$sSQL.= $myyear . ",";						
		$sSQL.= $db->qstr('action') . ',';		
		$sSQL.= $db->qstr($id) . ',';
		$sSQL.= $db->qstr($user) . ',';
		$sSQL.= $db->qstr($_SERVER['REMOTE_ADDR']) . ",";
		$sSQL.= $db->qstr($_SERVER['HTTP_X_FORWARDED_FOR']) . ","; 
		$sSQL.= $db->qstr($_SERVER['HTTP_USER_AGENT']). ",";
		$sSQL.= $db->qstr($this->http_referer). ")";					

		$db->Execute($sSQL,1);	 
		
		if ($db->Affected_Rows()) 
			return true;
		else 
			return false;		
	}	
	
	public function update_event_statistics($id, $user=null) {
        $db = GetGlobal('db'); 
		
		if ((GetSessionParam('ADMIN')) || (_m("cms.isUaBot")))
			return false;		

	    $currentdate = time();	
	    $myday  = date('d',$currentdate);	
	    $mymonth= date('m',$currentdate);	
	    $myyear = date('Y',$currentdate);
						
		$sSQL = "insert into stats (day,month,year,tid,attr1,attr3,REMOTE_ADDR,HTTP_X_FORWARDED_FOR,HTTP_USER_AGENT,REFERER) values (";
		$sSQL.= $myday . ",";
		$sSQL.= $mymonth . ",";
		$sSQL.= $myyear . ",";						
		$sSQL.= $db->qstr('event') . ',';		
		$sSQL.= $db->qstr($id) . ',';
		$sSQL.= $db->qstr($user) . ',';
		$sSQL.= $db->qstr($_SERVER['REMOTE_ADDR']) . ",";
		$sSQL.= $db->qstr($_SERVER['HTTP_X_FORWARDED_FOR']) . ","; 
		$sSQL.= $db->qstr($_SERVER['HTTP_USER_AGENT']). ",";
		$sSQL.= $db->qstr($this->http_referer). ")";					

		$db->Execute($sSQL,1);	 
		
		if ($db->Affected_Rows()) 
			return true;
		else 
			return false;		
	}	
	
	public function isBot($a=null) {
		$agent = $a ? $a : $this->useragent;
		$avoiduseragent = _m("cms.arrayload use CMS+httpUserAgentsToAvoid");
		
		if (!empty($avoiduseragent)) {
			foreach ($avoiduseragent as $i=>$ua) {
				if (stristr($agent, $ua)) 
					return true;
			}
		}
		
		return false;	
	}	
};
}
?>