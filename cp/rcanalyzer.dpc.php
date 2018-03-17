<?php

$__DPCSEC['RCANALYZER_DPC']='1;1;1;1;1;1;2;2;9;9;9';

if ( (!defined("RCANALYZER_DPC")) ) {// && (seclevel('RCANALYZER_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCANALYZER_DPC",true);

$__DPC['RCANALYZER_DPC'] = 'rcanalyzer';


$__EVENTS['RCANALYZER_DPC'][0]='cpanalyze';
$__EVENTS['RCANALYZER_DPC'][1]='analyze';
$__EVENTS['RCANALYZER_DPC'][2]='cpanalyzer';

$__ACTIONS['RCANALYZER_DPC'][0]='cpanalyze';
$__ACTIONS['RCANALYZER_DPC'][1]='analyze';
$__ACTIONS['RCANALYZER_DPC'][2]='cpanalyzer';

$__LOCALE['RCANALYZER_DPC'][0]='RCANALYZER_DPC;Analyser;Analyser';
$__LOCALE['RCANALYZER_DPC'][1]='_analyze;Analyse;Ανάλυση';

class rcanalyzer {
	
	var $title, $prpath, $urlpath, $url;
	var $cpanelmailpath, $sendermailfolder, $folder;
	
	var $batch;

    function __construct() {
		
	  $this->prpath = paramload('SHELL','prpath');
      $this->urlpath = paramload('SHELL','urlpath');	
	  $this->url = paramload('SHELL','urlbase');
	  $this->title = localize('RCANALYZER_DPC',getlocal());

	  $rootpath = paramload('RCCONTROLPANEL','rootpath', $this->prpath);
      $this->cpanelmailpath = $rootpath ? '/home/'.$rootpath.'/mail/' : '/home/stereobi/mail/';	 
	  $sender = remote_paramload('RCBULKMAIL','user',$this->prpath); //'b.alexiou@stereobit.gr';//
	  $this->sendermailfolder = '.' . str_replace('.','_',$sender) . '/cur/'; //.link to folder cur
	  $this->folder = $this->cpanelmailpath . $this->sendermailfolder;
	  
	  $this->batch = 1000;
	}
	
    function event($event=null) {
	
	   //$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   //if ($login!='yes') return null;			

       if (!$this->msg) {
  
	     switch ($event) {
		    case 'analyze'        : 				
			case 'cpanalyze'      : 
			case 'cpanalyzer'     :
			default               :							  
         }
      }
    }	

    function action($action=null)  { 
	
		//$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    //if ($login!='yes') return null;

	     switch ($action) {
		   case 'analyze'        : 
		   case 'cpanalyze'      : 
		   case 'cpanalyzer'     :		   
		   default               : $out = $this->analyze();
		 }			 

	     return ($out);
	}
	
	public function analyze($verbose=null) {
		$db = GetGlobal('db');
		
		//select cursor from last rec
		$sSQL = "select idx from panalyze where id = (select count(id) from panalyze)";
		$result = $db->Execute($sSQL,2);
		$cursor = $result->fields[0] ? $result->fields[0] : 0;//$this->batch;		
		//echo $cursor,'>';
		
		$ret = $this->analyze_stats(500, $cursor, $verbose);
		$ret.= $this->analyze_ip(500, 4);
		
		//$ret .= $this->analyze_sendmails($cursor, $verbose);
		
		//$ret .= $this->analyze_mailbounce();
		
		return ($ret);//true;
	}
	
	protected function analyze_stats($limit=null,$cursor=null, $verbose=null) {
		$db = GetGlobal('db');
		$l = $limit ? $limit : $this->batch;
		
		$analyze_results = array();
		$u = $r = $s = $c = $f = array();
		$cs = $ru = $ur = $cin = $cout = array();
		$ipcs = $ipru = $ipur = $ipcin = $ipcout = array();
		$ipf = $ips = $ipu = array();
		//$datemin = time();
		//$datemax = 0;
		
		//select date margins
		//$sSQL = "SELECT min(date),max(date) FROM stats WHERE id>$cursor LIMIT $l";
		//$rest = $db->Execute($sSQL,2);
		
		$curlimit = $cursor + $limit;
		$datemin = "(SELECT min(date) FROM stats WHERE id>$cursor and id<$curlimit)"; //$rest->fields[0]; //strtotime($rest->fields[0]);
		$datemax = "(SELECT max(date) FROM stats WHERE id>$cursor and id<$curlimit)";//$rest->fields[1]; //strtotime($rest->fields[1]);
		
		//select recs from stats
		$sSQL = "select date,vid,tid,attr1,attr2,attr3,ref,REMOTE_ADDR,HTTP_X_FORWARDED_FOR from stats order by id LIMIT $cursor ,$l";
		$result = $db->Execute($sSQL,2);
		//echo $sSQL;
		
		if (empty($result)) return 'Empty record set.';
		
        foreach ($result as $z=>$rec) {
			//$datemin = (strtotime($rec['date'])>$datemin) ? $datemin : strtotime($rec['date']);
			//$datemax = (strtotime($rec['date'])>$datemax) ? strtotime($rec['date']) : $datemax;
			/*
			$dmn = (strtotime($rec['date'])>$dmn) ? $dmn : strtotime($rec['date']);
			$dmx = (strtotime($rec['date'])>$dmx) ? strtotime($rec['date']) : $dmx;
			$datemin = date( 'Y-m-d H:i:s', $dmn);
			$datemax = date( 'Y-m-d H:i:s', $dmx);			
			*/
			$sessionuser = $rec['attr2'];
			$product = $rec['tid'];
			$category = $rec['attr1'];
			$username = $rec['attr3'];
			$reference = $rec['ref'];
			$REMOTE_ADDR = $rec['REMOTE_ADDR'];
			$HTTP_X_FORWARDED_FOR = $rec['HTTP_X_FORWARDED_FOR'];
			
			$ip = $HTTP_X_FORWARDED_FOR ? $HTTP_X_FORWARDED_FOR : ($REMOTE_ADDR ? $REMOTE_ADDR : '0.0.0.0');
			$user = (trim($username)!='') ? $username : ($sessionuser ? $sessionuser : 'unknown'); 
			
			$ret .= 'user:'.$user.'<br/>';
			$ret .= 'ip:'.$ip.'<br/>';
			
			if ($reference) {
				$ret .= 'ref:'.$reference.'<br/>';
				if ($product) $r[$reference] .= $product . '|';	
				if ($category) $c[$reference] .= $category . '|';
				
				$ur[$user] .= $reference . '|';
				$ru[$reference] .= $user . '|';
				
				$ipur[$ip] .= $reference . '|';
				$ipru[$reference] .= $ip . '|';
			}	
			
			if ($product) {
				$ret .= 'prd:'.$product.'<br/>';
				switch ($product) {
					case 'filter' :	$f[$user] .= $category . '|'; $ipf[$ip] .= $category . '|'; break;
					case 'search' :	$s[$user] .= $category . '|'; $ips[$ip] .= $category . '|'; break;
					default       : $u[$user] .= $product . '|'; $ipu[$ip] .= $product . '|';
				}
			}	
			
			if ($category) {
			    $ret .= 'cat:'.$category.'<br/>';
				switch ($category) {
					case 'cartin' :	$cin[$user] .= $product . '|'; $ipcin[$ip] .= $product . '|'; break;
					case 'cartout':	$cout[$user] .= $product . '|'; $ipcout[$ip] .= $product . '|'; break;
					default       : $cs[$user] .= $category . '|'; $ipcs[$ip] .= $category . '|';
				}
			}

			$cursor += 1; //inc cursor
		}
		
		//save analysis on ref /items
		$i = 0;
		foreach ($r as $ref=>$prd) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,cursor) value ($datemin, $datemax,'event',";
			$sSQL.= $db->qstr('reference '. $ref . ' refitm ' . $prd);
			$sSQL.= ", $cursor)";
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}	
		$analyze_results['ref-items'] = $i;
		//save analysis on ref /categories
		$i = 0;
		foreach ($c as $ref=>$cat) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,cursor) value ($datemin, $datemax,'event',";
			$sSQL.= $db->qstr('reference '. $ref . ' refcat ' . $cat);
			$sSQL.= ", $cursor)";
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}			
		$analyze_results['ref-cat'] = $i;
		
		
		//save analysis on user /items
		$i = 0;
		foreach ($u as $usr=>$prd) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,idx) value ($datemin, $datemax,'event',";
			$sSQL.= $db->qstr('user '. $usr . ' matchitm ' . $prd);
			$sSQL.= ", $cursor)";
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}
		$analyze_results['user-items'] = $i;
		//save analysis on ip /items
		$i = 0;
		foreach ($ipu as $usr=>$prd) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,idx) value ($datemin, $datemax,'event',";
			$sSQL.= $db->qstr('ip '. $usr . ' matchitm ' . $prd);
			$sSQL.= ", $cursor)";
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}
		$analyze_results['ip-items'] = $i;	

		
		//save analysis on user /categories
		$i = 0;
		foreach ($cs as $usr=>$cat) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,idx) value ($datemin, $datemax,'event',";
			$sSQL.= $db->qstr('user '. $usr . ' matchcat ' . $cat);
			$sSQL.= ", $cursor)";
			//echo $sSQL;
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}	
		$analyze_results['user-categories'] = $i;
		//save analysis on ip /categories
		$i = 0;
		foreach ($ipcs as $usr=>$cat) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,idx) value ($datemin, $datemax,'event',";
			$sSQL.= $db->qstr('ip '. $usr . ' matchcat ' . $cat);
			$sSQL.= ", $cursor)";
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}	
		$analyze_results['ip-categories'] = $i;		
		
		
		//save analysis on user /ref
		$i = 0;
		foreach ($ur as $usr=>$ref) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,idx) value ($datemin, $datemax,'event',";
			$sSQL.= $db->qstr('user '. $usr . ' matchref ' . $ref);
			$sSQL.= ", $cursor)";
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}
		$analyze_results['user-ref'] = $i;
		//save analysis on ip /ref
		$i = 0;
		foreach ($ipur as $usr=>$ref) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,idx) value ($datemin, $datemax,'event',";
			$sSQL.= $db->qstr('ip '. $usr . ' matchref ' . $ref);
			$sSQL.= ", $cursor)";
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}
		$analyze_results['ip-ref'] = $i;	

		
		//save analysis on ref /user
		$i = 0;
		foreach ($ru as $ref=>$usr) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,idx) value ($datemin, $datemax,'event',";
			$sSQL.= $db->qstr('reference '. $ref . ' matchusr ' . $usr);
			$sSQL.= ", $cursor)";
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}			
		$analyze_results['ref-user'] = $i;
		//save analysis on ref /ip
		$i = 0;
		foreach ($ipru as $ref=>$usr) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,idx) value ($datemin, $datemax,'event',";
			$sSQL.= $db->qstr('reference '. $ref . ' matchip ' . $usr);
			$sSQL.= ", $cursor)";
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}			
		$analyze_results['ref-ip'] = $i;		
		
		
		//save analysis on filter
		$i = 0;
		foreach ($f as $usr=>$filter) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,idx) value ($datemin, $datemax,'event',";
			$sSQL.= $db->qstr('user '. $usr . ' filter ' . $filter);
			$sSQL.= ", $cursor)";
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}	
		$analyze_results['user-filter'] = $i;
		//save analysis on filter (ip)
		$i = 0;
		foreach ($ipf as $usr=>$filter) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,idx) value ($datemin, $datemax,'event',";
			$sSQL.= $db->qstr('ip '. $usr . ' filter ' . $filter);
			$sSQL.= ", $cursor)";
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}	
		$analyze_results['ip-filter'] = $i;	

		
		//save analysis on search
		$i = 0;
		foreach ($s as $usr=>$search) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,idx) value ($datemin, $datemax,'event',";
			$sSQL.= $db->qstr('user '. $usr . ' search ' . $search);
			$sSQL.= ", $cursor)";
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}			
		$analyze_results['user-search'] = $i;
		//save analysis on search (ip)
		$i = 0;
		foreach ($ips as $usr=>$search) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,idx) value ($datemin, $datemax,'event',";
			$sSQL.= $db->qstr('ip '. $usr . ' search ' . $search);
			$sSQL.= ", $cursor)";
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}			
		$analyze_results['ip-search'] = $i;
		
		
		//save analysis on user / cart in
		$i = 0;
		foreach ($cin as $usr=>$cartitemsin) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,idx) value ($datemin, $datemax,'event',";
			$sSQL.= $db->qstr('user '. $usr . ' cartin ' . $cartitemsin);
			$sSQL.= ", $cursor)";
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}
		$analyze_results['user-itmincart'] = $i;
		//save analysis on ip / cart in
		$i = 0;
		foreach ($ipcin as $usr=>$cartitemsin) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,idx) value ($datemin, $datemax,'event',";
			$sSQL.= $db->qstr('ip '. $usr . ' cartin ' . $cartitemsin);
			$sSQL.= ", $cursor)";
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}
		$analyze_results['ip-itmincart'] = $i;	

		
		//save analysis on user / cart out
		$i = 0;
		foreach ($cout as $usr=>$cartitemsout) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,idx) value ($datemin,$datemax,'event',";
			$sSQl.= $db->qstr('user '. $usr . ' cartout ' . $cartitemsout);
			$sSQL.= ", $cursor)";
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}			
		$analyze_results['user-itemoutcart'] = $i;
		//save analysis on ip / cart out
		$i = 0;
		foreach ($ipcout as $usr=>$cartitemsout) {
			$sSQL = "insert into panalyze (datemin,datemax,type,expression,idx) value ($datemin,$datemax,'event',";
			$sSQl.= $db->qstr('ip '. $usr . ' cartout ' . $cartitemsout);
			$sSQL.= ", $cursor)";
			$result = $db->Execute($sSQL,1);	
			$i = ($db->Affected_Rows()) ? $i+1 : $i;	
		}			
		$analyze_results['ip-itemoutcart'] = $i;		
		
		//print_r($analyze_results);
		foreach ($analyze_results as $descr=>$i) {
			//$this->storeMessage($descr . ':' . $i . ' results');
			if ($verbose) 
				$ret .= $descr . ':' . $i . ' results';
		}	
		
		$this->storeMessage('Statistics analyzer completed ('. count($analyze_results) . ')');
		return ($ret);//true;	
	}
	
	
	/*search ip to block */
	protected function analyze_ip($limit=null, $pmax=null) {
		$db = GetGlobal('db');
        $points = array();
		$l = $limit ? $limit : 500; //last 500 recs
		$pm = $pmax ? $pmax : 9; //max points to black ip
		
		$sSQL = "select tid,attr1,REMOTE_ADDR,HTTP_X_FORWARDED_FOR from stats order by id desc LIMIT " . $l;
		$result = $db->Execute($sSQL,2); 	
		//echo $sSQL;
		
		foreach ($result as $z=>$rec) {

			$ip = $rec['HTTP_X_FORWARDED_FOR'] ? $rec['HTTP_X_FORWARDED_FOR'] : $rec['REMOTE_ADDR'];
			
			/*if ((stristr($rec[0], 'select')) || (stristr($rec[0], 'union')) || (stristr($rec[0], 'name_const')) ||
				(stristr($rec[0], 'from')) || (stristr($rec[0], 'hex')) || (stristr($rec[0], 'unhex')) ||			
			    (stristr($rec[0], '1=1')) || (stristr($rec[0], '"1"="1"')) ||
				(stristr($rec[0], '"x"="x')) || (stristr($rec[0], "'x'='x")) ||
				(stristr($rec[0], ' and ')) || (stristr($rec[0], "select*from" ||
				(stristr($rec[0], "'1'='1")) || (stristr($rec[0], '1>1'))) {*/
			if (preg_match_all('~\b(select|union|from|hex|1=1|and)\b~i', $rec['tid'], $matches)) {
					$points[$ip] += 1; //add word point
					//echo '.';
				}	
			/*if ((stristr($rec[1], 'select')) || (stristr($rec[1], ' union')) || (stristr($rec[1], 'name_const')) ||
				(stristr($rec[1], 'from')) || (stristr($rec[1], 'hex')) || (stristr($rec[1], 'unhex')) ||			
			    (stristr($rec[1], '1=1')) || (stristr($rec[1], '"1"="1"')) || 
				(stristr($rec[1], '"x"="x')) || (stristr($rec[1], "'x'='x")) ||
				(stristr($rec[1], ' and ')) || (stristr($rec[1], "select*from" ||
				(stristr($rec[1], "'1'='1")) || (stristr($rec[1], '1>1'))) {*/ 
			if (preg_match_all('~\b(select|union|from|hex|1=1|and)\b~i', $rec['attr1'], $matches)) {	
					$points[$ip] += 1; //add word point
					//echo '.';
				}					
		}

		foreach	($points as $ipaddr=>$point) {
			if ($point > $pm) {
				$blacklist[] = $ipaddr;
				
				$sSQL = "select REMOTE_ADDR from blacklistip where REMOTE_ADDR=" . $db->qstr($ipaddr);
				$result = $db->Execute($sSQL,2); 
				
				//write to db
				if ($result->fields[0]) 
					$sSQL = "update blacklistip set status=1 WHERE REMOTE_ADDR=" . $db->qstr($ipaddr);
				else 
					$sSQL = "insert into blacklistip (REMOTE_ADDR,HTTP_X_FORWARDED_FOR) values ('$ipaddr','$ipaddr')";					
				
				$result = $db->Execute($sSQL,1); 
				$this->storeMessage('Security alert ip blocked ('. $ipaddr . ')', true, 'warning');
			}	
		}
		
		//write to file
		if (!empty($blacklist)) {
			$ret = file_put_contents($this->prpath . 'black-list.txt', "\n" . implode("\n", $blacklist), FILE_APPEND);
			return ($ret);
		}
		
		return false;	
	}
	
	
	
	protected function analyze_sendmails($cursor=null, $verbose=null) {
		$db = GetGlobal('db');

		$sSQL = "select receiver from mailstats where id>" . $cursor . ' LIMIT 1000';
		$result = $db->Execute($sSQL,2); 

		//...	
		
        $this->storeMessage('Send mails analyze completed ('.$ret.')');
		return ($ret);
	}	
	
	
	
	
	protected function analyze_mailbounce() {
		
		$ret = $this->analyze_mail_cleanBounce(0, true);
		
		$this->storeMessage('Mailbounce analyze completed ('.$ret.')');
		return ($ret);
	}
	
	protected function ulist_update($email=null) {
		$db = GetGlobal('db');
		if ($email==null) return false;
		
		$sSQL = "select failed from ulists where email=" . $db->qstr($email);
		$result = $db->Execute($sSQL,2);
		
		$xtimes = $result->fields[0] ? intval($result->fields[0])+1 : 1;
		
		$sSQL = 'update ulists set failed=' . $xtimes . " where email=" . $db->qstr($email);
		$result = $db->Execute($sSQL,1);
		
		return true;
	}
	
	protected function analyze_mail_cleanBounce($days=0,$delete=false) {
		$db = GetGlobal('db');
		$daysback = mktime(0, 0, 0, date("m"), date("d")-$days,   date("Y"));
		$ret = null;

		if ($handle = opendir($this->folder)) {
			//$ret = $app . " ($sender)" . "\n";
            $bouncehandler = new Bouncehandler();
			
			while (false !== ($file = readdir($handle))) {
				if($file=='.' || $file=='..') continue;
				
				$t = filemtime($this->folder . $file);	
				if ($t > $daysback) {
					$bounce = @file_get_contents($this->folder . $file);
					$rep = $bouncehandler->parse_email($bounce); 
					if ($a = $bouncehandler->is_a_bounce()) { 
					    
						$f[$t] = $file;
						
						$to = $rep[0]['recipient'];
						$l[$t] = $to;
						
						//ulists update
						$this->ulist_update($to);

						//also update mailqueue (last sending mail)		
						$sSQL = "select id from mailqueue where receiver=" . $db->qstr($to) . " order by id desc LIMIT 1";
						$result = $db->Execute($sSQL,2);
						
						$sSQL = "update mailqueue set status=-2, mailstatus='BOUNCE' where id=" . $result->fields[0];
						$result = $db->Execute($sSQL,1);
					}	
				}
			}

			closedir($handle);
		}
		
		if (empty($f)) return null;	

		foreach ($f as $ft=>$file) {
			if ($delete==true) 
				unlink($this->folder . $file);
		}	
		return (count($f));			
	}
	
	protected function storeMessage($message=null, $alert=false, $flag=null) {
		$db = GetGlobal('db');	
		if (empty($message)) return null;
		$f = $flag ? $flag : 'info';
		
	    $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if (($alert==true) && ($login=='yes') && defined('RCCONTROLPANEL_DPC')) {
			//set message at session
			$time = time();
			$saytime = GetGlobal('controller')->calldpc_method("rccontrolpanel.timeSayWhen use $time");
			$msg = "$f|" . $message . "|$saytime"; //|cptransactions.php";
			GetGlobal('controller')->calldpc_method("rccontrolpanel.setMessage use $msg+1");
			return true;	
        }			
		//else
		//insert message into db directly (!!! better)
		$sSQL = "insert into cpmessages (hash, msg, type, owner) values (";
		$sSQL.= $db->qstr(md5($message)) . ",";
		$sSQL.= $db->qstr($message) . ",";
		$sSQL.= $db->qstr('analyzer') . ",";
		$sSQL.= $db->qstr('analyzer');
		$sSQL.= ")";
		//echo $sSQL;
		$result = $db->Execute($sSQL,1);
		
		return true;
    }		
		
					
};
}
?>