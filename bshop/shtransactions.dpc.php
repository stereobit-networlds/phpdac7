<?php

$__DPCSEC['SHTRANSACTIONS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("SHTRANSACTIONS_DPC")) && (seclevel('SHTRANSACTIONS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("SHTRANSACTIONS_DPC",true);

$__DPC['SHTRANSACTIONS_DPC'] = 'shtransactions';

require_once(_r('libs/browser2.lib.php'));
require_once(_r('bshop/transactions.dpc.php'));

GetGlobal('controller')->get_parent('TRANSACTIONS_DPC','SHTRANSACTIONS_DPC');

$__EVENTS['SHTRANSACTIONS_DPC'][6]='transviewhtml';
$__EVENTS['SHTRANSACTIONS_DPC'][7]='cancelorder';

$__ACTIONS['SHTRANSACTIONS_DPC'][6]='transviewhtml';
$__ACTIONS['SHTRANSACTIONS_DPC'][7]='cancelorder';

$__LOCALE['SHTRANSACTIONS_DPC'][0]='SHTRANSACTIONS_CNF;Transaction List;Λίστα Συναλλαγών';	   
$__LOCALE['SHTRANSACTIONS_DPC'][1]='_COST;Cost;Κόστος';	
$__LOCALE['SHTRANSACTIONS_DPC'][2]='_LOADCART;Load;Στο καλάθι';	
$__LOCALE['SHTRANSACTIONS_DPC'][3]='_PREVIEWCART;Preview;Προβολή';	
$__LOCALE['SHTRANSACTIONS_DPC'][4]='_CANCELTRANS;Cancel;Ακύρωση';	
$__LOCALE['SHTRANSACTIONS_DPC'][5]='_trhostcancel;Cancel by host;Ακυρώθηκε απο τον παραλήπτη';	
$__LOCALE['SHTRANSACTIONS_DPC'][6]='_trtranscancel;Cancel by user;Ακυρώθηκε απο τον χρήστη';	
$__LOCALE['SHTRANSACTIONS_DPC'][7]='_trusercancel;Canceled;Ακυρώθηκε';
$__LOCALE['SHTRANSACTIONS_DPC'][8]='_trinprocess;In process;Σε επεξεργασία';
$__LOCALE['SHTRANSACTIONS_DPC'][9]='_trintransport;Ready to delivery;Προς διανομή';
$__LOCALE['SHTRANSACTIONS_DPC'][10]='_trsubmited;Submited;Παρελήφθει';
$__LOCALE['SHTRANSACTIONS_DPC'][11]='_trinhand;Delivered;Ολοκληρώθηκε';
$__LOCALE['SHTRANSACTIONS_DPC'][12]='_mailcancelbody;Canceled transaction;Ακύρωση παραγγελίας';
$__LOCALE['SHTRANSACTIONS_DPC'][13]='_mailcancelsubject;Canceled transaction;Ακύρωση παραγγελίας';
	   
class shtransactions extends transactions {

	var $path, $prpath;
	var $initial_word;
   
	static $staticpath, $myf_button_class; 

	public function __construct() {
   
		transactions::__construct();
	   
		self::$staticpath = paramload('SHELL','urlpath');
		$this->prpath = paramload('SHELL','prpath');
	   
		//override if exist
		if ($tpath = paramload('SHTRANSACTIONS','path'))
			$this->path = $this->prpath . $tpath;	

		$this->initial_word = remote_paramload('SHTRANSACTIONS','trid',$this->prpath);     	   	   
		$bc = remote_paramload('SHTRANSACTIONS','buttonclass',$this->prpath); 
		self::$myf_button_class = $bc ? $bc : 'myf_button';	   
	}
   
	//override
	public function event($event=null) {
   
		switch ($event) {
			case 'cancelorder'  : 	$this->cancelOrder(GetReq('tid')); 
									$this->jsBrowser();
									break;   
		   
			case 'transviewhtml': 	$this->viewTransactionHtml();
									die();
									break;
								
			default             :	transactions::event($event);
									$this->jsBrowser();
		}
   }
   
	//override
	public function action($action=null)  { 

		switch ($action) {
			case 'cancelorder' : 
			default            : $out = $this->viewTransactions();
		} 

		return ($out);
	}   
	
	protected function jsBrowser() {
		
		$code = $this->jsTrans();		
		   
		if ($code) {
			$js = new jscript;	
			$js->load_js($code,null,1);		
			unset ($js);
		}
	}

	protected function jsTrans() {
		$mobileDevices = _m('cmsrt.mobileMatchDev');
		
		$code = "
	if (/{$mobileDevices}/i.test(navigator.userAgent)) 
		window.scrollTo(0,parseInt($('#questions').offset().top, 10));
	else {		
		gotoTop('questions');	
	
		$(window).scroll(function() { 
			if (agentDiv('transactions')) {
				$.ajax({ url: 'jsdialog.php?t=jsdcode&id=trans&div=transactions', cache: false, success: function(jsdialog){
					eval(jsdialog);		
				}})	
			}	
		});	
	}	
";
		
		return ($code);
	}	
   
	//overwrite
	public function saveTransaction($data='',$user='',$payway=null,$roadway=null,$qty=null,$cost=null,$costpt=null) {
		//execute default save and get id
		//$id = transactions::saveTransaction($data,$user,$payway,$roadway,$qty,$cost,$costpt);
		$db = GetGlobal('db');
		
		$myqty = $qty ? $qty : 0;
		$mycost = $cost ? $cost : 0;
		$mycostpt = $costpt ? $costpt : 0;
		
		$myuser = $user ? $user : $this->userid;
		$theid = $this->generate_id();
		$referer = GetSessionParam('http_referer'); //as saved at vstats

		if (($theid) && ($myuser)) {
			$id = $theid + $this->tcounter;
			$myid = $this->initial_word . $id;  
			$mydate = date('Y/m/d'); 
			$mytime = date('H:i:s');
			$mydata = $data;
			
			$sSQL = "insert into transactions (tid,cid,tdate,ttime,tdata,tstatus,payway,roadway,qty,cost,costpt,referer) values " .
					"(" .
					$db->qstr($myid) . "," .
					$db->qstr($myuser) . "," .
					$db->qstr($mydate) . "," .
					$db->qstr($mytime) . "," .
					$db->qstr($mydata) . "," . 
					"0," .
					$db->qstr($payway) . "," . 
					$db->qstr($roadway) . "," .
					$myqty . "," .
					$mycost . "," .
					$mycostpt . ",".				 				 				 
					$db->qstr($referer) . ")";

	        $res = $db->Execute($sSQL);			
			//echo $sSQL;
			
			if ($db->Affected_Rows()) {
				//echo 'save xml';
				$xml = new pxml();
				$xml->addtag('ORDER',null,null,"id=".$id);							
				$xml->addtag('XUL','ORDER',null,null); 
				$xml->addtag('GTKWINDOW','XUL',null,null);
							
				$ret = $xml->getxml();
				$this->save2disk($id,$ret);
				unset($xml); 

				return ($id); //true	
			}
		} 	
							
		return false;						
	}
   
	protected function save2disk($id,$data) {
   
		$file = $this->path . $id . ".xml"; 
		//echo $file,$data;
		$fd = fopen($file, 'w');
		fwrite($fd, $data);
		fclose($fd);   
	}

    //override use tid instead of recid in db mode
	public function setTransactionStatus($trid,$state) {
		$db = GetGlobal('db');
	    $sSQL = "update transactions set tstatus=" . $state . " where tid='" . $this->initial_word. $trid ."'";
        $result = $db->Execute($sSQL);
		
        if ($db->Affected_Rows()) 
			return true;
		
		return false;   	   				  
	}
	
	public function getTransactionStatus($trid) {
		$db = GetGlobal('db');
		$sSQL = "select tstatus from transactions where tid='" . $this->initial_word. $trid ."'";
		$result = $db->Execute($sSQL);	
	   
		$ret = $result->field['tstatus'];
		return ($ret);
	}
	
	public function setTransactionStoreData($trid,$fieldname,$value=null) {
		$db = GetGlobal('db');
		$sSQL = "update transactions set $fieldname='" . $value . "' where tid='" . $this->initial_word. $trid ."'";
		$result = $db->Execute($sSQL);
		
		if ($db->Affected_Rows()) 
			return true;

		return false;   	   
	}
	
	public function getTransactionStoreData($fieldname,$trid) {
       $db = GetGlobal('db');
	   $sSQL = "select $fieldname from transactions where tid='" . $this->initial_word. $trid ."'";
       $result = $db->Execute($sSQL);
		
       $ret = $result->fields[$fieldname]; 
	   return $ret;   	   
	}	 
	
	//called by shpaypal to check txn_id
	public function checkPaypalTXNID($txnid) {
		$db = GetGlobal('db');
		$sSQL = "select type1 from transactions where payway='PAYPAL' and type1=";
		$sSQL .= $db->qstr($txnid);
		$result = $db->Execute($sSQL);
		
		if ($result->fields['type1']) 
			return false;
		
	    return true;	
	} 
	
	//called by shpiraeus to check txn_id
	public function checkPiraeusTicket($txnid) {
		$db = GetGlobal('db');
		$sSQL = "select type1 from transactions where payway='PIRAEUS' and type1=";
		$sSQL .= $db->qstr($txnid);
		$result = $db->Execute($sSQL);
		
		if ($result->fields['type1']) 
			return false;

		return true; 	
	} 
	
	//replace 2 func above
	protected function is_unique($id,$fieldnametocheck=null,$valtocheck=null,$field=null) {
		$db = GetGlobal('db');
		$f = $field ? 'type2':'type1';
		$sSQL = "select $f from transactions where ";
	   
		if ($fieldnametocheck)
			$sSQL .= $fieldnametocheck."=" . $db->qstr($valtocheck) . " and ";
	   
		$f . "=" . $db->qstr($id);
		 
		$sSQL .= $db->qstr($txnid);
		$result = $db->Execute($sSQL);
		
		if ($result->fields[$f]) 
			return false;

		return true;// not exist ok  		
	}	 
	
	public function saveTransactionHtml($id, $data, $template=null,$user=null,$fkey=null) {
		$file = $this->path . $id . ".html"; 
		
		if (defined('TWIGENGINE_DPC')) {
			$dd = _m('twigengine.render use '.$template.'++'.$data);
        }
        else {  		
		
			//d must be serialized array of tokens when template	
			$d = unserialize($data);		
		
			$myprintcarttemplate = _m('cmsrt.select_template use ' . str_replace('.htm', '', $template));

			$tokens[] = _v('shcart.transaction_id');
			$tokens[] = '';//dummy
			
			//echo $user,'>',$fkey;
			$tokens[] = _m("shcustomers.showcustomerdata use $user+$fkey+cusdetails.htm");
			$tokens[] = GetSessionParam('orderdetails');
			$tokens[] = GetSessionParam('ordercart');
		  
			$dd = $this->combine_tokens($myprintcarttemplate,$tokens,true);		

		}//if
		
        $fd = fopen($file, 'w');
        fwrite($fd, $dd, strlen($dd));
        fclose($fd);   		
	} 
	
	public function getTransactionHtml($id) {
        $file = $this->path . $id . ".html"; 

		if (!$this->isTransOwner($id)) {
		  $ret = 'Invalid transaction id'; 		
		  return ($ret);
		}		
		
	    if (is_readable($file)) {
		
		  $ret = file_get_contents($file);
		}
		else
		  $ret = 'file not exist!';  
		
		return ($ret);		
	} 	
	
	//override
	public function getTransaction($trid) {
       $db = GetGlobal('db');
	   
	   if ($this->storetype=='DB') {  //db	
	   	   
	     $sSQL = "select tdata from transactions where tid=" . $db->qstr($trid);
	     $res = $db->Execute($sSQL);

	     if ($res) { 
	       $out = $res->fields[0]; 
		   return ($out);
	     }
	   }
	} 
	
	//return array of relative sales id's
	public function getRelativeSales($limit=null,$id=null) {
       $db = GetGlobal('db');
	   $id = $id?$id:GetReq('id');
	   
	   //search serialized data for id
	   $sSQL = "select tid,tdata from transactions " .
	           "where tdata like'%" . $id ."%' order by tid desc";
       $result = $db->Execute($sSQL,2);
	   //echo $sSQL;
	   
	   foreach ($result as $n=>$rec) {	
         $tdata = $rec['tdata'];
		 
		 if ($tdata) {
		   $cdata = unserialize($tdata);
		   if (count($cdata)>1) {//if many items
		     foreach ($cdata as $i=>$buffer_data) {
		 
		       $param = explode(";",$buffer_data);
		       if ($param[0] != $id) 
		         $ret[] = $param[0]; //save code
			 
		       if (count($ret)>$limit) break; //limit to fetch	 
		     }	 
		   }
		 } 
	   }
	   return $ret;   	   	
	}	
	
	protected function cancelOrder($trid) {
		$db = GetGlobal('db');
		if (!$this->isTransOwner($trid)) {
		  echo 'Invalid tranascrion id';
		  die();		
		}	   	   
		   
		$sSQL = "update transactions set tstatus=-2 where tid='" . $this->initial_word . $trid ."'";
        $result = $db->Execute($sSQL);
		
        if ($db->Affected_Rows()) {

			$this->cancelPoints($trid);	
		  
		    //send mail to host
		    $s = localize('_mailcancelsubject', getlocal()) . ' ' . $trid;
			$b = $this->getTransactionHtml($trid);
			
			// MAIL THE ORDER TO HOST
			$host = _v('shcart.cartreceive_mail');
			$this->mailto($host,$s,$b);
			
			//TO CUSTOMER
		    $this->mailto(null,$s,$b);
		
			return true;
		}	
		else 
			return false;   	   
	}

	//ppolicy cancel
	protected function cancelPoints($trid) {
		$db = GetGlobal('db');		
		if (!$trid) return false;
		
		$sSQL = "update custpoints set active=0 where source=" . $db->qstr($trid);					
		$res = $db->Execute($sSQL);
		
		//sum of points
		$sSQL = "update ppolicy set active=0 where descr=" . $db->qstr($trid);
		$res = $db->Execute($sSQL);			

		return true;	
	}	
	
	protected function mailto($mto=null,$subject=null,$body=null,$template=null) {
        $UserName = GetGlobal('UserName');	
	    $to = $mto ? $mto : decode($UserName);	
		if (!$UserName) return false;
		  
        if ($template) {
			$mytemplate = _m('cmsrt.select_template use ' . str_replace('.htm', '', $template));
		
			$tokens[] = $body ? $body : localize('_mailcancelbody', getlocal());			  					
			$mailbody = $this->combine_tokens($mytemplate,$tokens);
		}
		else	
			$mailbody = $body ? $body : localize('_mailcancelbody', getlocal());			  					
		
		$mailsubject = $subject ? $subject : localize('_mailcancelsubject', getlocal());
		
		$from = _v('shusers.usemail2send');
	    //$ret = _m('shusers.mailto use '.$from.'+'.$to.'+'.$mailsubject.'+'.$mailbody);
		$body = str_replace('+','<SYN/>',$mailbody); 
		$mailerr = _m("cmsrt.cmsMail use $from+$to+$mailsubject+$body");	
		
		return ($mailerr);
	} 	
	
	public function getTransactionsList() {
		$db = GetGlobal('db');
		$UserName = GetGlobal('UserName');	
		$name = $UserName ? decode($UserName) : null;		   
		if (!$name) return;
	   	
		if ($this->storetype=='DB') {  //db	
	   	   
			$sSQL = "select tid,tdate,ttime,tstatus,payway,roadway,cost,costpt from transactions where cid=" . $db->qstr($name) . 
					"order by tid DESC";				 
				 
			$res = $db->Execute($sSQL,2);
			//print_r ($res->fields[5]);
			$i=0;
			if (!empty($res)) { 
				foreach ($res as $n=>$rec) {
					$i+=1;
					$transtbl[] = $rec[0].";".$rec[3].";".$rec[4]."/".$rec[5].";".$rec[1]." / ".$rec[2].";" .	
								number_format($rec[6],2,',','.');		   
				}
		   
				$ppager = GetReq('pl') ? GetReq('pl') : 10;
				$browser = new browse($transtbl,null,$this->getpage($transtbl,$this->searchtext));
				$out .= $browser->render("transview",$ppager,$this,1,0,0,0);
				unset ($browser);	
			}
			else 
				$out = null;	 
	   }	
	   
	   return ($out);
	} 	
	
	//override
	public function viewTransactions() {
		$db = GetGlobal('db');
		$a = GetReq('a');
		$UserName = GetGlobal('UserName');	   
	   
		if (!$UserName) {
			if (defined('SHLOGIN_DPC')) {
				_m("shlogin.login_javascript"); 	 
				$out = _m("shlogin.quickform use +transview+shtransactions>viewTransactions");		   
			}  
			else {
				_m("cmslogin.login_javascript"); 
				$out = _m("cmslogin.quickform use +transview+shtransactions>viewTransactions");
			}	
			//else
				//$out = ("You must be logged in to view this page.");
		   
			return ($out);  
		}	 

		$myaction = 'transview/'; //seturl("transview/");	   
	   
		if (seclevel('TRANSADMIN_',$this->userLevelID)) {
			$this->admint=1;
			$out .= "<form method=\"POST\" action=\"";
			$out .= "$myaction";
			$out .= "\" name=\"Transview\">";		 
		}
		elseif (seclevel('TRANSCANCEL_',$this->userLevelID)) { 
			$this->admint=2;	   
			$out .= "<form method=\"POST\" action=\"";
			$out .= "$myaction";
			$out .= "\" name=\"Transview\">";		   
		}
		else {
			$out .= "<form method=\"POST\" action=\"";
			$out .= "$myaction";
			$out .= "\" name=\"Transview\">";		   
		}

		$out .= $this->getTransactionsList();	 
		 
		if ($this->admint) {
            $out .= "<input type=\"hidden\" name=\"FormName\" value=\"Transview\">";
            $out .= "</form>";			 		   	 	
		}  	
	   
		return ($out);
	}	
	
	//overide
	public function details($id,$template=null) {
	   
		if (defined('SHCART_DPC')) 
			$ret = _m('shcart.previewcart use '.$id.'++'.$template);
		 
	    return ($ret);
	}
	
	public function viewTransactionHtml($id=null) {
	    $id = $id?$id:GetReq('tid');
		
		if (!$this->isTransOwner($id)) {
			echo 'Invalid tranascrion id';
			die();		
		}
	
        $file = $this->path . $id . ".html"; 

		if (is_readable($file)) {
			$ret = file_get_contents($file);	
			echo $ret;
			die();
		}
		else
			return false;
	} 		
	
	//override
    public function viewtrans($id,$status,$payway,$datetime,$trtotal,$dummy=null) {
	   
		$link = 'trload/'.$id.'/';
		$cload_button = $this->myf_button(localize('_LOADCART',getlocal()),$link);
	   
		if (is_readable($this->path . $id . ".html")) {	
			$lnk = 'trview/'.$id.'/';
			$preview_button = $this->myf_button(localize('_PREVIEWCART',getlocal()),$lnk);
		}
		else 
			$preview_button = null;		  

		//line details
		$linetemplate = _m('cmsrt.select_template use fptransline');
		$tokens[] = $this->details($id,'shcartpreview'); //use template for line
		$line = $this->combine_tokens($linetemplate,$tokens);

		$data[] = $id;
		$data[] = $payway;
		$data[] = $datetime;
		$data[] = $trtotal;
		$data[] = $dummy;	
		$data[] = $cload_button;
		$data[] = $preview_button;

		switch ($status) {	
		    case -3    : $trstatus = localize('_trhostcancel', getlocal()); break;
		    case -2    : $trstatus = localize('_trtranscancel', getlocal()); break;
		    case -1    : $trstatus = localize('_trusercancel', getlocal()); break;
		
		    case 3     : $trstatus = localize('_trinhand', getlocal()); break;
		    case 2     : $trstatus = localize('_trintransport', getlocal()); break;
		    case 1     : $trstatus = localize('_trinprocess', getlocal()); break;
			case 0     : 
			default    : $trstatus = localize('_trsubmited', getlocal());			
		}	
		
		if ($status>=0) {
			$cancelnk = 'trcancel/'.$id.'/';
			$cancel_button = $this->myf_button(localize('_CANCELTRANS',getlocal()),$cancelnk);	
			$data[] = $trstatus;
			$data[] = $cancel_button;
		}	
		else {
			$data[] = $trstatus;
			$data[] = null;
		}	
		
		$data[] = $line;

		$mytemplate = _m('cmsrt.select_template use fptrans');
		$out = $this->combine_tokens($mytemplate,$data);		
			
	    return ($out);
	}
	
	//security function to not vew trans of other users
	public function isTransOwner($id=null) {
		$db = GetGlobal('db');
		$id = $id?$id:GetReq('tid');
		$myuser = GetGlobal('UserID');	
		$user = $myuser ? decode($myuser) : null;
	   
		//search serialized data for id
		$sSQL = "select tid from transactions" .
				" where tid=" . $db->qstr($id) . ' and cid=' . $db->qstr($user);
		$result = $db->Execute($sSQL,2);
	   
		if ($result->fields['tid']==$id)
			return true;
		   
		return false;	   
    }	   
		
	//override
	public function headtitle() {
		//$mytemplate = _m('cmsrt.select_template use fptrans');
		//$out = $this->combine_tokens($mytemplate,$data);
		//return ($out);		
		
		return null;//deactivate
	}	

	protected function combine_tokens(&$template_contents, $tokens, $execafter=null) {
	    if (!is_array($tokens)) return;
		
		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
			$fp = new fronthtmlpage(null);
			$ret = $fp->process_commands($template_contents);
			unset ($fp);		  		
		}		  		
		else
			$ret = $template_contents;
		  
	    foreach ($tokens as $i=>$tok) {
		    $ret = str_replace("$".$i."$",$tok,$ret);
	    }

		for ($x=$i;$x<40;$x++)
			$ret = str_replace("$".$x."$",'',$ret);
		
		if (($execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
			$fp = new fronthtmlpage(null);
			$retout = $fp->process_commands($ret);
			unset ($fp);
          
			return ($retout);
		}		
		
		return ($ret);
	}	
	
	protected static function myf_button($title,$link=null,$image=null) {
		$path = self::$staticpath;//$this->urlpath;//
		$bc = self::$myf_button_class;
	   
		if (($image) && (is_readable($path."/images/".$image.".png"))) 
			$imglink = "<a href=\"$link\" title='$title'><img src='images/".$image.".png'/></a>";
	   
		if (preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT'])) { 
			//echo 'ie';
			$_b = $imglink ? $imglink : "[$title]";
			$ret = "&nbsp;<a href=\"$link\">$_b</a>&nbsp;";
			return ($ret);
		}	
	   
		if ($imglink)
	       return ($imglink);
	
		//else button	
		if ($link)
			$ret = "<a href=\"$link\">";
		  
		$ret .= "<input type=\"button\" class=\"$bc\" value=\"".$title."\" />";
	   
		if ($link)
			$ret .= "</a>";	   
		  
		return ($ret);
	}	
	
};
}
?>