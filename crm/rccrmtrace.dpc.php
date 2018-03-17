<?php
$__DPCSEC['RCCRMTRACE_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCCRMTRACE_DPC")) && (seclevel('RCCRMTRACE_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCCRMTRACE_DPC",true);

$__DPC['RCCRMTRACE_DPC'] = 'rccrmtrace';
 
$__EVENTS['RCCRMTRACE_DPC'][0]='cpcrmtrace';
$__EVENTS['RCCRMTRACE_DPC'][1]='cpcrmprofile';
$__EVENTS['RCCRMTRACE_DPC'][2]='cpcrmactivities';
$__EVENTS['RCCRMTRACE_DPC'][3]='cpcrmcontact';
$__EVENTS['RCCRMTRACE_DPC'][4]='cpcrmtimeline';
$__EVENTS['RCCRMTRACE_DPC'][5]='cpcrmeditprofile';
$__EVENTS['RCCRMTRACE_DPC'][6]='cpcrmsaveprofile';
$__EVENTS['RCCRMTRACE_DPC'][7]='cpcrmdataprofile';
$__EVENTS['RCCRMTRACE_DPC'][8]='cpcrmframe';
$__EVENTS['RCCRMTRACE_DPC'][9]='cpcrmaddfav';
$__EVENTS['RCCRMTRACE_DPC'][10]='cpcrmremfav';
$__EVENTS['RCCRMTRACE_DPC'][11]='cpcrmaddoffer';
$__EVENTS['RCCRMTRACE_DPC'][12]='cpcrmaddcol';
$__EVENTS['RCCRMTRACE_DPC'][13]='cpcrmuser';
$__EVENTS['RCCRMTRACE_DPC'][14]='cpcrmcust';
$__EVENTS['RCCRMTRACE_DPC'][15]='cpcrmcont';
$__EVENTS['RCCRMTRACE_DPC'][16]='cpcrmaddactivity';
$__EVENTS['RCCRMTRACE_DPC'][17]='cpcrmsaveactivity';

$__ACTIONS['RCCRMTRACE_DPC'][0]='cpcrmtrace';
$__ACTIONS['RCCRMTRACE_DPC'][1]='cpcrmprofile';
$__ACTIONS['RCCRMTRACE_DPC'][2]='cpcrmactivities';
$__ACTIONS['RCCRMTRACE_DPC'][3]='cpcrmcontact';
$__ACTIONS['RCCRMTRACE_DPC'][4]='cpcrmtimeline';
$__ACTIONS['RCCRMTRACE_DPC'][5]='cpcrmeditprofile';
$__ACTIONS['RCCRMTRACE_DPC'][6]='cpcrmsaveprofile';
$__ACTIONS['RCCRMTRACE_DPC'][7]='cpcrmdataprofile';
$__ACTIONS['RCCRMTRACE_DPC'][8]='cpcrmframe';
$__ACTIONS['RCCRMTRACE_DPC'][9]='cpcrmaddfav';
$__ACTIONS['RCCRMTRACE_DPC'][10]='cpcrmremfav';
$__ACTIONS['RCCRMTRACE_DPC'][11]='cpcrmaddoffer';
$__ACTIONS['RCCRMTRACE_DPC'][12]='cpcrmaddcol';
$__ACTIONS['RCCRMTRACE_DPC'][13]='cpcrmuser';
$__ACTIONS['RCCRMTRACE_DPC'][14]='cpcrmcust';
$__ACTIONS['RCCRMTRACE_DPC'][15]='cpcrmcont';
$__ACTIONS['RCCRMTRACE_DPC'][16]='cpcrmaddactivity';
$__ACTIONS['RCCRMTRACE_DPC'][17]='cpcrmsaveactivity';

$__LOCALE['RCCRMTRACE_DPC'][0]='RCCRMTRACE_DPC;Crm trace;Crm trace';
$__LOCALE['RCCRMTRACE_DPC'][1]='_id;ID;ID';
$__LOCALE['RCCRMTRACE_DPC'][2]='_save;Save;Αποθήκευση';
$__LOCALE['RCCRMTRACE_DPC'][3]='_date;Date;Ημερ.';
$__LOCALE['RCCRMTRACE_DPC'][4]='_time;Time;Ώρα';
$__LOCALE['RCCRMTRACE_DPC'][5]='_customers;Customers;Πελάτες';
$__LOCALE['RCCRMTRACE_DPC'][6]='_users;Users;Χρήστες';
$__LOCALE['RCCRMTRACE_DPC'][7]='_campaigns;Campaigns;Καμπάνιες';
$__LOCALE['RCCRMTRACE_DPC'][8]='_ulist;Leads;Λίστες';
$__LOCALE['RCCRMTRACE_DPC'][9]='_failed;Fails;Αποτυχίες';
$__LOCALE['RCCRMTRACE_DPC'][10]='_listname;List name;Όνομα λίστας';
$__LOCALE['RCCRMTRACE_DPC'][11]='_mode;Search in;Αναζήτηση σε';
$__LOCALE['RCCRMTRACE_DPC'][12]='_reply;Replies;Απαντήσεις';
$__LOCALE['RCCRMTRACE_DPC'][13]='_subject;Subject;Θέμα';
$__LOCALE['RCCRMTRACE_DPC'][14]='_dateins;Start at;Εκκίνηση';
$__LOCALE['RCCRMTRACE_DPC'][15]='_dateupd;Updated;Ενημερώση';
$__LOCALE['RCCRMTRACE_DPC'][16]='_about;About;Eπαφή';
$__LOCALE['RCCRMTRACE_DPC'][17]='_unknown;Unknown;Άγνωστος';
$__LOCALE['RCCRMTRACE_DPC'][18]='_undefined;Unknown;Άγνωστο';
$__LOCALE['RCCRMTRACE_DPC'][19]='_crm;Crm;Crm';
$__LOCALE['RCCRMTRACE_DPC'][20]='_favadded;Add recommendation;Εισαγωγή προτίμησης';
$__LOCALE['RCCRMTRACE_DPC'][21]='_favremoved;Remove recommendation;Διαγραφή προτίμησης';
$__LOCALE['RCCRMTRACE_DPC'][22]='_favexist;Recommendation exist;Υπάρχουσα προτίμηση';
$__LOCALE['RCCRMTRACE_DPC'][23]='_addcollection;Add in collection;Εισαγωγή στη συλλογή';

class rccrmtrace  {

    var $title, $path, $urlpath;
	var $seclevid, $userDemoIds, $owner;
	
	var $contactRec, $cantactData;
	var $v, $visitor, $visitorIP, $visitorEmail, $resolved, $ref, $source;
	var $fb, $login, $recognize, $resolve;
		
	function __construct() {
	
		$this->path = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		$this->title = localize('RCCRMTRACE_DPC',getlocal());	 
	  
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
		$this->userDemoIds = array(5,6,7,8); 	
		
		$this->owner = $_POST['Username'] ? $_POST['Username'] : GetSessionParam('LoginName');		
		
		$this->contactRec = array(0=>'id',1=>'date',2=>'udate',3=>'code',4=>'type',5=>'email',
								  6=>'firstname',7=>'lastname',8=>'address',9=>'country',10=>'birthday',
								  11=>'occupation',12=>'mobile',13=>'phone',14=>'skype',15=>'website',
								  16=>'facebook',17=>'twitter',18=>'linkedin',19=>'longitude',20=>'latitude',
								  21=>'about');
		$this->contactData = array();						   

		//$this->visitor = GetParam('v') ? GetParam('v') : false;	
		$this->v = GetParam('v') ? GetParam('v') : false;		
		if (($this->v) && (stristr($this->v, '|'))) { //pre-resolved visitor
			$p = explode('|', $this->v);
			$this->visitor = $p[0]; //email
			$this->visitorEmail = $p[0]; //email			
			$this->visitorIP = $p[1]; //ip
			$this->resolved = true;			
		}
		else {
			$this->visitor = $this->v;
			$this->visitorEmail = $this->iseMailUser($this->v) ? $this->v : null;
			$this->visitorIP = $this->isIPUser($this->v) ? $this->v : null;//'0.0.0.0';	
			$this->resolved = false;
		}
		
		$this->ref = null;
		$this->source = null;	
		
		$this->fb = GetReq('fb') ? true : false;
		$this->login = GetReq('login') ? true : false;
		$this->recognize = GetReq('recognized') ? true : false;
		$this->resolve = GetReq('resolved') ? true : false;		
	}
	
    function event($event=null) {
	
	    $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;		 
	
	    switch ($event) {
			
			case 'cpcrmsaveactivity' : $this->saveActivity();
			                           $this->readProfile();
			                           break;
			case 'cpcrmaddactivity'  : $this->readProfile();
			                           break;
			
			case 'cpcrmuser'       : $this->readUserProfile(); break;
			case 'cpcrmcust'       : $this->readCustomerProfile(); break;
			case 'cpcrmcont'       : $this->readContactProfile(); break;
			
			case 'cpcrmaddcol'     : echo $this->addCollection();
									 die();	
		    case 'cpcrmaddoffer'   : echo $this->addfavProfile('crmoffer');
									 die();				
			
		    case 'cpcrmremfav'     : echo $this->remfavProfile();
									 die();
		    case 'cpcrmaddfav'     : echo $this->addfavProfile();
									 die();									 
			
		    case 'cpcrmframe'      : echo $this->urlframe();
									 die();
							         break; 		   
		    case 'cpcrmdataprofile': echo $this->crmframe();
									 die();
							         break; 
		   
		    case 'cpcrmtimeline'   : 
		    case 'cpcrmcontact'    : 
			case 'cpcrmactivities' : $this->readProfile();  	
			                         break;
			case 'cpcrmsaveprofile': $this->saveProfile();
			                         $this->readProfile();
									 break;
			
			case 'cpcrmeditprofile': 			
			case 'cpcrmprofile'    : $this->readProfile();
                                     break;			
			case 'cpcrmtrace'      :
			default                :    
		                      
	    }
			
    }   
	
    function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	
	 
		switch ($action) {

			case 'cpcrmsaveactivity' : break;
			case 'cpcrmaddactivity'  : break;		
		
			case 'cpcrmuser'       : break;
			case 'cpcrmcust'       : break;
			case 'cpcrmcont'       : break;		

		    case 'cpcrmaddcol'     : break;
		    case 'cpcrmaddoffer'   : break;
			
		    case 'cpcrmremfav'     : break;
		    case 'cpcrmaddfav'     : break;			
			case 'cpcrmframe'      : break;
			
			case 'cpcrmdataprofile': 				
			case 'cpcrmtimeline'   :			
		    case 'cpcrmcontact'    : 
			case 'cpcrmactivities' : 
			case 'cpcrmsaveprofile': 
			case 'cpcrmeditprofile': 
			case 'cpcrmprofile'    : 					  
			case 'cpcrmtrace'      :
			default                : $out = "<div id=\"crmdetails\"></div>"; //null;
		}	 

	  return ($out);
    }
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}	

    public function isIPUser($string) {
		$valid = filter_var($string, FILTER_VALIDATE_IP);
		return ($valid);
	}
	
    public function iseMailUser($string) {
		$valid = filter_var($string, FILTER_VALIDATE_EMAIL);
		return ($valid);
	}
	
	public function readContactField($fieldname=null, $ucfirst=false) {
		if ((!$fieldname) || (empty($this->contactData))) return null;
		
		$ret = $ucfirst ? ucfirst($this->contactData[$fieldname]) : $this->contactData[$fieldname];
		return ($ret);
	}
	
	public function readVar($var=null) {
		if (!$var) return false;
		return ($this->{$var});
	}
	
	public function readContactID() {
		if (empty($this->contactData)) return null;
		
		if (strcmp($this->ref, 'contact')==0) //only when native crm contact (use on form to update/replace)
			$ret = $this->contactData['id'];
		else
			$ret = null;
		return ($ret);
	}	

	public function readContactRef($thisRefOn=false, $ucfirst=false) {
		if ($thisRefOn)
			$ret = $this->ref ? $this->ref : $this->contactData['reference'];
		else
			$ret = $this->contactData['reference'] ? $this->contactData['reference'] : $this->ref;
		return ($ucfirst ? ucfirst($ret) : $ret);
	}	
	
	public function readContactSource() {
		$ret = $this->contactData['source'] ? $this->contactData['source'] : $this->source;
		return ($ret);
	}	
	
	public function readContactIP() {
		$ret = $this->contactData['ip'] ? $this->contactData['ip'] : $this->visitorIP;
		return ($ret);
	}		
	
	public function readContactWeb($fieldname=null) {
		if ((!$fieldname) || (empty($this->contactData))) return null;
		$undef = localize('_undefined', getlocal());		
		
		$ret = $this->contactData[$fieldname]!=$undef ? $this->contactData[$fieldname] : '#';
		$h = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
		return ($ret!='#' ? (strstr($ret, $h) ? $ret : $h.$ret) : '#');
	}

	public function readContactMail($fieldname=null) {
		if ((!$fieldname) || (empty($this->contactData))) return null;
		
		$ret = $this->contactData[$fieldname];
		return ($ret);
	}	
	
	public function contactMenu($v=null) {
		$visitor = $v ? $v : $this->currentVisitor('email');
		if (!$this->iseMailUser($visitor)) return null;		
		
		if (defined('CRMFORMS_DPC')) 
			$ret = _m("crmforms.formsMenu use ".$visitor."+crmdoc");
		//else
			//$ret = "<a href='cpcrmoffers.php?v=".$visitor."'>".$visitor."</a>";
		
		return ($ret);
	}
	
	public function readContactName() {
		$undef = localize('_undefined', getlocal());
		$name = ($this->contactData['firstname'] != $undef ) ? 
		            $this->contactData['firstname'] : $this->visitor;
				
		$name .= ($this->resolved) ? 
		         (strcmp($this->visitor, $this->visitorIP)!==0 ? " (" . $this->visitorIP. ")" : null) : 
				 null;	
				 
		//$name .= " (". $this->contactData['reference'] . ")";			
		return ($name);
	}	
	
    public function currentVisitor($type=null) {
		
		switch ($type) {
			case 'auto' : $ret = $this->visitorEmail ? $this->visitorEmail : $this->visitorIP; break;
			case 'ip'   : $ret = $this->visitorIP; break;
			case 'email': $ret = $this->visitorEmail; break;
			default     : $ret = $this->v;
		}
		
		return ($ret);
	}
	
	protected function crmframe() {
		$id = GetParam('id');
		$cmd = 'cpcrm.php?t=cpcrmshowusr&id='. $id . '&iframe=1';
		$bodyurl = $cmd; //seturl("t=$cmd&iframe=1");
	
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"520px\"><p>Your browser does not support iframes</p></iframe>";    

		return ($frame); 
	}	
	
	protected function urlframe() {
		$cmd = urldecode(base64_decode(GetParam('url')));
		if (strstr($cmd,'|')) 
			list($url, $h) = explode('|',$cmd);
		else 
			$url = $cmd;
		
	    $height = $h ? $h : 520;
		$frame = "<iframe src =\"$url\" width=\"100%\" height=\"{$height}px\"><p>Your browser does not support iframes</p></iframe>";    

		return ($frame); 
	}	
		
	protected function readUserProfile() {	
		$db = GetGlobal('db');
		$visitor = $this->visitor;
		
		if ($this->iseMailUser($visitor)) {
			
			$sSQL2 = "select id,timein,code1,code2,notes,email,fname,lname,notes,username from users ";
			$sSQL2.= "WHERE username=" . $db->qstr($visitor) . " OR email=" . $db->qstr($visitor) . " order by notes asc"; //ACTIVE note first		   
			$result = $db->Execute($sSQL2);				
			
			if ($result) {
				$this->ref = 'user'; 				
				
				//handle rec
				$undef = localize('_undefined', getlocal());
				foreach ($this->contactRec as $i=>$contactField) {
					$this->contactData[$contactField] = isset($result->fields[$i]) ? $result->fields[$i] : $undef;
				}
			
				//last fields params
				$this->contactData['reference'] = $result->fields['reference'] ? $result->fields['reference'] : $this->ref;
				$this->source = $visitor;
				$this->contactData['source'] = $result->fields['source'] ? $result->fields['source'] : $this->source; //$this->resolved ? $visitor . '(resolved)' : $visitor;
				$this->contactData['ip'] = $result->fields['ip'] ? $result->fields['ip'] :$this->visitorIP;
				$this->contactData['owner'] = $result->fields['owner'] ? $result->fields['owner'] :$this->owner;
				return true;
			}
		} 
		
		return false;
	}
	
	protected function readCustomerProfile() {	
		$db = GetGlobal('db');
		$visitor = $this->visitor;
		
		if ($this->iseMailUser($visitor)) {
			
			$sSQL1 = "select id,timein,code1,code2,active,mail,name,afm,address,city,prfid,prfdescr,voice1,fax,voice2,area from customers ";
			$sSQL1.= "WHERE mail=" . $db->qstr($visitor) . " OR code2=" . $db->qstr($visitor) . " order by active desc"; //active first		   
			$result = $db->Execute($sSQL1);				
			
			if ($result) {
				$this->ref = 'customer'; 
				
				//handle rec
				$undef = localize('_undefined', getlocal());
				foreach ($this->contactRec as $i=>$contactField) {
					$this->contactData[$contactField] = isset($result->fields[$i]) ? $result->fields[$i] : $undef;
				}
			
				//last fields params
				$this->contactData['reference'] = $result->fields['reference'] ? $result->fields['reference'] : $this->ref;
				$this->source = $visitor;
				$this->contactData['source'] = $result->fields['source'] ? $result->fields['source'] : $this->source; //$this->resolved ? $visitor . '(resolved)' : $visitor;
				$this->contactData['ip'] = $result->fields['ip'] ? $result->fields['ip'] :$this->visitorIP;
				$this->contactData['owner'] = $result->fields['owner'] ? $result->fields['owner'] :$this->owner;
				return true;
			}
		} 
		
		return false;		
	}
	
	protected function readContactProfile() {	
		$db = GetGlobal('db');
		$visitor = $this->visitor;
		
		if ($this->iseMailUser($visitor)) {

			$crmfields = implode(',', $this->contactRec);
			$sSQL = "select $crmfields,reference,source,ip,owner from crmcontacts ";		   
			$sSQL.= "WHERE email=" . $db->qstr($visitor);
			$result = $db->Execute($sSQL);

			if ($result) {
				$this->ref = 'contact'; //crm contact
				
				//handle rec
				$undef = localize('_undefined', getlocal());
				foreach ($this->contactRec as $i=>$contactField) {
					$this->contactData[$contactField] = isset($result->fields[$i]) ? $result->fields[$i] : $undef;
				}
			
				//last fields params
				$this->contactData['reference'] = $result->fields['reference'] ? $result->fields['reference'] : $this->ref;
				$this->source = $visitor;
				$this->contactData['source'] = $result->fields['source'] ? $result->fields['source'] : $this->source; //$this->resolved ? $visitor . '(resolved)' : $visitor;
				$this->contactData['ip'] = $result->fields['ip'] ? $result->fields['ip'] :$this->visitorIP;
				$this->contactData['owner'] = $result->fields['owner'] ? $result->fields['owner'] :$this->owner;
				return true;
			}			
		} 
		
		return false;		
	}
	
	private function readProfile() {
		$db = GetGlobal('db');
		
		//resolve if ip (or not pre-resolved)
		if (($this->isIPUser($this->visitor)) && ($visitor = $this->resolveIP($this->visitor))) {
			$this->visitorEmail = $visitor; //email			
			$this->visitorIP = $this->visitor; //ip			
			$this->resolved = true;
		}	
		else
			$visitor = $this->visitor; //is email
		
		//if pre-resolved or now resolved ip
		if (($this->iseMailUser($visitor)) || (($this->resolved) && ($this->iseMailUser($visitor)))) {
		
			//crm contact (default)
			$crmfields = implode(',', $this->contactRec);
			$sSQL = "select $crmfields,reference,source,ip,owner from crmcontacts ";		   
			$sSQL.= "WHERE email=" . $db->qstr($visitor);
			$result = $db->Execute($sSQL);
			$this->ref = 'contact'; //crm contact
		
			if (!$result->fields[0]) { //search for customer data
			
				$sSQL1 = "select id,timein,code1,code2,active,mail,name,afm,address,city,prfid,prfdescr,voice1,fax,voice2,area from customers ";
				$sSQL1.= "WHERE mail=" . $db->qstr($visitor) . " OR code2=" . $db->qstr($visitor) . " order by active desc"; //active first		   
				$result = $db->Execute($sSQL1);
				$this->ref = 'customer'; 

				if (!$result->fields[0]) { //search for user data
			
					$sSQL2 = "select id,timein,code1,code2,notes,email,fname,lname,notes,username from users ";
					$sSQL2.= "WHERE username=" . $db->qstr($visitor) . " OR email=" . $db->qstr($visitor) . " order by notes asc"; //ACTIVE note first		   
					$result = $db->Execute($sSQL2);			
					$this->ref = 'user';
				}
			}
		}
		else {
			//no user, customer or crm rec (may newsletter or other action resolved mail)
			$result = true; //dummy
			$this->ref = 'visitor';
		}
		//echo $this->ref;
		
		if ($result) {
			//handle rec
			$undef = localize('_undefined', getlocal());
			foreach ($this->contactRec as $i=>$contactField) {
				$this->contactData[$contactField] = isset($result->fields[$i]) ? $result->fields[$i] : $undef;
			}
			
			//last fields params
			$this->contactData['reference'] = $result->fields['reference'] ? $result->fields['reference'] : $this->ref;
			$this->source = ($this->resolved) ? ((strcmp($visitor, $this->visitorIP)!==0) ? $visitor . " (resolved $this->visitorIP)" : $visitor) : $visitor;
			$this->contactData['source'] = $result->fields['source'] ? $result->fields['source'] : $this->source; //$this->resolved ? $visitor . '(resolved)' : $visitor;
			$this->contactData['ip'] = $result->fields['ip'] ? $result->fields['ip'] :$this->visitorIP;
			$this->contactData['owner'] = $result->fields['owner'] ? $result->fields['owner'] :$this->owner;
			return true;
		}
		return false;	
	}
	
	private function saveProfile() {
		$db = GetGlobal('db');
		$undef = localize('_undefined', getlocal());
		$cr = array();
				
		foreach ($this->contactRec as $i=>$contactField) {
			//echo $_POST[$contactField] . '<br>';
			if ($value = GetParam($contactField)) {
				$value2 = strcmp($value, $undef)!==0 ? $value : null;
				$cr[] = $contactField;
				$ins_params[] = $db->qstr($value2);
				$upd_params[] = $contactField . "=" . $db->qstr($value2);
			}	
		}
        /*
		if (!empty($upd_params)) {
			$sSQL = "REPLACE crmcontacts set ";
			$sSQL .= implode(',', $upd_params) . ",udate=" . $db->qstr(time());
			$sSQL .= GEtParam('id') ? " where id=" . $db->qstr($id) : null;
			echo $sSQL;	
		}*/
		
		if ($id = GetParam('id')) {
			//update
			if (!empty($upd_params)) {
				$fields = implode(',', $cr);
				$sSQL = "update crmcontacts set ";
				$sSQL.= implode(',', $upd_params) . 
						",udate=" . $db->qstr(date('Y-m-d H:i:s')) .
						",owner=" . $db->qstr($this->owner);
				$sSQL.= " where id=" . $db->qstr($id);
				//echo $sSQL;
				$result = $db->Execute($sSQL);
				
				$this->addActivity($this->visitor, 'Profile updated.');
				
				return true;
			}				
		}
		else {
			//insert
			if (!empty($ins_params)) {
				$fields = implode(',', $cr);
				$sSQL = "insert into crmcontacts (". $fields .",reference,source,ip,owner) values (";
				$sSQL.= implode(',', $ins_params) . 
						",".$db->qstr(GetParam('reference')).
						",".$db->qstr(GetParam('source')).
						",".$db->qstr(GetParam('ip')).
						",".$db->qstr($this->owner).")";
				//echo $sSQL;
				$result = $db->Execute($sSQL);
				
				$this->addActivity($this->visitor, 'Profile created.');
				
				return true;
			}	
		}

		return false;
    }	
	

	/*search for name based on email*/
	public function resolveProfile($email=null)	{
		if (!$email) return false;
		$db = GetGlobal('db');
		
		if ($this->iseMailUser($email)) {
		
			//crm contact (default)
			$crmfields = implode(',', $this->contactRec);
			$sSQL = "select firstname,lastname,occupation from crmcontacts ";		   
			$sSQL.= "WHERE email=" . $db->qstr($email);
			$result = $db->Execute($sSQL);
			$ref = 'contact'; //crm contact
		
			if (!$result->fields[0]) { //search for customer data
				$sSQL1 = "select name,prfdescr from customers ";		   
				$sSQL1.= "WHERE mail=" . $db->qstr($email) . " OR code2=" . $db->qstr($email) . " order by active desc";
				$result = $db->Execute($sSQL1);	
				$ref = 'customer'; 
				
				if (!$result->fields[0]) { //search for user data
			
					$sSQL2 = "select fname,lname from users ";
					$sSQL2.= "WHERE username=" . $db->qstr($email) . " OR email=" . $db->qstr($email) . " order by notes asc"; //ACTIVE note first		   
					$result = $db->Execute($sSQL2);			
					$ref = 'user';
				}				
			}
			
			if ($result->fields) {
				$ret = $result->fields[0] . ' ' . $result->fields[1] . ' ' . $result->fields[2];
				return ($ret);
			}
		}

		//return false;	
		return ($email); //input out
	}	

	public function addfavProfile($listID=null) {
		if (!$item = GetReq('item')) return null;
		$listname = $listID ? $listID : 'crmfav';
		$db = GetGlobal('db');
		
		if ($visitor = GetReq('v')) {
			$sSQL = "select tid from wishlist where tid='$item' and listname='$listname' and cid=" . $db->qstr($visitor);
			$res = $db->Execute($sSQL);
			if (!$res->fields[0]) {
			
				$sSQL = "insert into wishlist (tid,cid,listname) values (" . 
					$db->qstr($item) .",". 
					$db->qstr($visitor) .",'$listname'".
					")";				 
				$res = $db->Execute($sSQL);		
				$ret = localize('_favadded', getlocal()) . ' ' . $item . ' ' . _m('rccontrolpanel.getItemName use '.$item);
				$this->addActivity($visitor, $ret);
			}
			else
				$ret = localize('_favexist', getlocal()) . ' ' . $item . ' ' . _m('rccontrolpanel.getItemName use '.$item);
			
			return ($ret);
		}
		return false;		
	}	
	
	public function remfavProfile($listID=null) {	
		if (!$item = GetReq('item')) return null;
		$listname = $listID ? $listID : 'crmfav';		
		$db = GetGlobal('db');
		
		if ($visitor = GetReq('v')) {
			$sSQL = "delete from wishlist where tid=" . 
					$db->qstr($item) ." and cid=". $db->qstr($visitor) .
					" and listname='$listname'";				 
			$res = $db->Execute($sSQL);		
			
			$ret = localize('_favremoved', getlocal()) . ' ' . $item . ' ' . _m('rccontrolpanel.getItemName use '.$item);
			$this->addActivity($visitor, $ret);
			return ($ret);
		}
		return false;				
	}	

	/*add item to collection */
	public function addCollection() {	
		if (!$item = GetReq('item')) return null;
		$visitor = GetReq('v');
		
		if (defined('RCCOLLECTIONS_DPC')) { 
			if ($add = _m("rccollections.addtoList use " . $item))
				$ret = localize('_addcollection', getlocal()) . ' ' . $item;// . " [$visitor]";
				
			return ($ret);
		}
        
		return false;	
	}
	
	/*search for email based on ip*/
	public function resolveIP($ip=null)	{
		if (!$ip) return false;
		$db = GetGlobal('db');
        $year = GetParam('year') ? GetParam('year') : date('Y'); 
	    $month = GetParam('month') ? GetParam('month') : date('m');

		//into current date range
		//$timein = _m('rccontrolpanel.sqlDateRange use date+1+1');
		
		//back one month from now
		//$timein = "AND DATE(date) BETWEEN DATE( DATE_SUB( NOW() , INTERVAL 30 DAY ) ) AND DATE ( NOW() ) ";		
		
		//back 60 days from date/month max selected
		if ($daterange = GetParam('rdate')) {
			$range = explode('-',$daterange);
			$dend = str_replace('/','-',trim($range[1]));
			$fromDate = "STR_TO_DATE('$dend','%m-%d-%Y')";			
		}	
		elseif (($m = GetReq('month')) && ($m!=date('m'))) {
			$y = GetReq('year') ? GetReq('year') : date('Y');
			$daysofmonth = cal_days_in_month(CAL_GREGORIAN, $m, $y);
			$fromDate = "'$y-$m-$daysofmonth'";
		}	
		else 
			$fromDate = "NOW()";	
		
		$timein = "AND DATE(date) BETWEEN DATE( DATE_SUB( $fromDate , INTERVAL 60 DAY ) ) AND DATE ( $fromDate ) ";
				
		$sSQL = "SELECT attr2,attr3 FROM stats where REMOTE_ADDR='$ip' $timein order by id desc"; 
		//echo $sSQL;
        $result = $db->Execute($sSQL);
		if (!$result) return false;

		foreach ($result as $i=>$rec) {
			if ($this->iseMailUser($rec[0]))
				return $rec[0];
			elseif ($this->iseMailUser($rec[1]))
				return $rec[1];
		}	
		
		return false;
	}
	
    public function visitors($template=null) {
		$db = GetGlobal('db'); 	

		//$recognize = GetReq('recognized') ? true : false;
		//$resolve = GetReq('resolved') ? true : false;
		$limit = ($this->recognize) ? null : ( $this->resolve ? " LIMIT 3000" : " LIMIT 500" ); //????
		
		$cpGet = _v('rcpmenu.cpGet');
		
		if ($v = $this->visitor)  //ip / mail / session
			$vSQL = $this->isIPUser($v) ? " AND REMOTE_ADDR='$v' " : 
			       ($this->iseMailUser($v) ? " AND (attr2='$v' OR attr3='$v') " : " AND attr2='$v' " );
		else {
			if ($this->fb)
				$vSQL = " AND ref like 'facebook%' ";
			elseif ($this->login)
				$vSQL = " AND tid='action' AND (attr1='login' OR attr1='fblogin') ";
			else
				$vSQL = null;		
		}	
		
        if ($id = $cpGet['id']) {
			$timein = _m('rccontrolpanel.sqlDateRange use date+1+1');
			$sSQL = "SELECT id,date,DATE_FORMAT(date, '%d-%m-%Y') as day,attr2,attr3,ref,REMOTE_ADDR FROM stats where tid='$id' $timein $vSQL group by day,attr2,attr3,REMOTE_ADDR order by id desc " . $limit;
		}
		elseif ($cat = $cpGet['cat']) {
			$timein = _m('rccontrolpanel.sqlDateRange use date+1+1');
			$sSQL = "SELECT id,date,DATE_FORMAT(date, '%d-%m-%Y') as day,attr2,attr3,ref,REMOTE_ADDR FROM stats where attr1='$cat' $timein $vSQL group by day,attr2,attr3,REMOTE_ADDR order by id desc " . $limit;
		}
		else {
			$timein = _m('rccontrolpanel.sqlDateRange use date+1+0');
			$sSQL = "SELECT id,date,DATE_FORMAT(date, '%d-%m-%Y') as day,attr2,attr3,ref,REMOTE_ADDR FROM stats where $timein $vSQL group by day,attr2,attr3,REMOTE_ADDR order by id desc " . $limit;
		}
		//echo $sSQL;	
        $result = $db->Execute($sSQL);
		if (!$result) return ;
		
		$t = $template ? _m("cmsrt.select_template use $template+1") : null;

		foreach ($result as $i=>$rec) {
			$rtokens = array();
			$resolved = null;
			
			$visitor = $this->iseMailUser($rec['attr3']) ? $rec['attr3'] : 
						( $this->iseMailUser($rec['attr2']) ? $rec['attr2'] : $rec['REMOTE_ADDR']);
						
			if (($this->recognize) && (!$this->iseMailUser($visitor))) 
				continue;		
			elseif (($this->resolve) && ($this->isIPUser($visitor))) {
				$resolved = $this->resolveIP($visitor);		
				if (!$this->iseMailUser($resolved)) continue;
			}
			
			
			$fbmark = $rec['ref'] ? ((substr($rec['ref'],0,8)=='facebook') ? "<i class='icon-facebook'></i>" : null ) : null;
			$name = $this->recognize ? $visitor . " -&gt resolved : " . $this->resolveProfile($visitor) : $visitor; 
			
			$rtokens[] = $resolved ? $name . " -&gt resolved : " . $this->resolveProfile($resolved) : $name; 
			$rtokens[] = _m('rccontrolpanel.timeSayWhen use '. strtotime($rec['date'])); 
			$rtokens[] = 'cpcrmtrace.php?t=cpcrmprofile&v=' . ($resolved ? $resolved.'|'.$visitor : $visitor); //link
			$rtokens[] = null;//$rec[3]; //hash
			
			$rtokens[] = $resolved ? _m("crmforms.formsMenu use ".$resolved."+crmdoc") . $fbmark : 
			              ((filter_var($visitor, FILTER_VALIDATE_EMAIL)) ? 
							_m("crmforms.formsMenu use ".$visitor."+crmdoc") . $fbmark : $fbmark);			
			
			$ret .= $t ? $this->combine_tokens($t, $rtokens) : 
			             "<option value=\"$hash\">".$rtokens[1]."</option>";
			
			unset($rtokens);
		}
		//echo $ret;
		return ($ret);		
	}
	
	public function getMonth() {
		return (GetReq('month') ? GetReq('month') :  date('m'));
	}
	
	public function getYear() {
		return (GetReq('year') ? GetReq('year') :  date('Y'));
	}	
	
	public function getDateRange() {
		if ($rdate = GetReq('rdate'))
			$ret = "rdate=" . $rdate;
		else
			$ret = "month=".$this->getMonth()."&year=".$this->getYear();
		
		return ($ret);
	}	
	
	
	/*save actions*/
	protected function addActivity($profile, $say, $type=null) {
		if ((!$say)||(!$profile)) return false;
		$db = GetGlobal('db');
		$t = $type ? $type : 0; //int
	
		$sSQL = "insert into crmactivities (profile, memo, type) values (";
		$sSQL.= $db->qstr($profile) . "," . $db->qstr($say). "," . $t . ")";
		//echo $sSQL;
		$result = $db->Execute($sSQL);		
		
		return true;
	}
	
	/*post data */
	protected function saveActivity() {
		$db = GetGlobal('db');
		$t = 1; //int
		
		if (($say = GetParam('about')) && ($profile=GetParam('v'))) {
	
			$sSQL = "insert into crmactivities (profile, memo, type) values (";
			$sSQL.= $db->qstr($profile) . "," . $db->qstr($say). "," . $t . ")";
			$result = $db->Execute($sSQL);	
			return true;
		}
		return false;	
	}		
	
	public function showActivities($template=null) {
		$db = GetGlobal('db');
		
		$timein = _m('rccontrolpanel.sqlDateRange use date+1+1');

		$sSQL = "select DATE_FORMAT(date, '%d-%m-%Y %H:%i:%s') as date,memo,type from crmactivities where profile=" . $db->qstr($this->visitor) . $timein;	
		$sSQL.= "order by date desc LIMIT 100";
		//echo $sSQL;
		$result = $db->Execute($sSQL);	
			
		if ($result) {
			$t = _m("cmsrt.select_template use $template+1");			
			
			foreach ($result as $i=>$rec) {
				$tokens = array($rec['date'], $rec['memo']); //,$rec['type']
				if ($template)
					$ret .= $this->combine_tokens($t, $tokens);
				else
					$ret[] = $tokens;	
			}	
		}	
		
		return ($ret);
	}
	
	public function searchTags($template=null) {
		$db = GetGlobal('db');

		$timein = _m('rccontrolpanel.sqlDateRange use date+1+1');
		
		if ($ip = $this->visitorIP)
			$iSQL = " REMOTE_ADDR=" . $db->qstr($ip);		
		if ($v = $this->visitorEmail)
			$vSQL = " and (attr2=" . $db->qstr($v) . " or attr3=" . $db->qstr($v) . ($iSQL ? " or " . $iSQL : null) . ")";
		else
			$vSQL = $iSQL ? " and " . $iSQL : null;
		
		$sSQL = "select count(id) as c,attr1 from stats where tid='search'" . $vSQL . $timein;	
		$sSQL.= " group by attr1 order by c desc";//" LIMIT 30";
		//echo $sSQL;
		$result = $db->Execute($sSQL);	
			
		if ($result) {
			$t = _m("cmsrt.select_template use $template+1");
					
			foreach ($result as $i=>$rec) {
				$tokens = array($rec['attr1'], $rec['c'], '#');
				if ($template)
					$ret .= $this->combine_tokens($t, $tokens);
				else
					$ret[] = $tokens;	
			}	
		}	
		
		return ($ret);
	}	
	
	public function mailResponds($template=null) {
		$db = GetGlobal('db');
			
		if (!$v = $this->visitorEmail)
			return false;
		
		$timein = _m('rccontrolpanel.sqlDateRange use timeout+1+1');			
					
		$sSQL = "select timeout,subject,reply,status from mailqueue where receiver='$v'" . $timein;	
		$sSQL.= " order by id desc";//" LIMIT 30";
		//echo $sSQL;
		$result = $db->Execute($sSQL);	
			
		if ($result) {
			$t = _m("cmsrt.select_template use $template+1");

			foreach ($result as $i=>$rec) {
				$title = $rec['timeout'];
				$views = $rec['status'] ? ' ('. $rec['reply'] .')' : null;
				$details =  $rec['subject'] . $views;
				$tokens = array($title, $details);
				if ($template)
					$ret .= $this->combine_tokens($t, $tokens);
				else
					$ret[] = $tokens;	
			}	
		}	
		
		return ($ret);
	}	
	
	/*copied and used in crmtimeline dpc*/
	public function showTimeline($template=null, $color=null, $icon=null, $time=null) {
		$db = GetGlobal('db');
		$c = $color ? $color : 'gray';
		$ic = $icon ? $icon : 'icon-time';
		$time = $time ? $time : date('Y-m-d H:i');

		$timein = _m('rccontrolpanel.sqlDateRange use date+1+1');
		
		if ($this->visitorIP) $iSQL = " REMOTE_ADDR=" . $db->qstr($this->visitorIP);		
		if ($this->visitorEmail) 
			$vSQL = "(attr2=" . $db->qstr($this->visitorEmail) . " or attr3=" . $db->qstr($this->visitorEmail) . ($iSQL ? " or " . $iSQL : null) . ")"; 
		else 
			$vSQL = $iSQL ? $iSQL : null;		
		
		$sSQL = "select DATE_FORMAT(date, '%d-%m-%Y %H:%i') as datetime, DATE_FORMAT(date, '%d-%m-%Y') as date, DATE_FORMAT(date, '%H:%i') as time, tid, attr1, attr2, attr3, ref, REMOTE_ADDR from stats where ";
		$sSQL.=  $vSQL . $timein;
		$sSQL.= " order by id desc LIMIT 100";
		//echo $sSQL;
		$result = $db->Execute($sSQL);	
			
		if ($result) {
			$t = _m("cmsrt.select_template use $template+1");
			
			foreach ($result as $i=>$rec) {
				$item = null;
				$link = '#';
				switch ($rec['tid']) {
					case 'search' : $c = 'orange'; $item = 'Search: ' . $rec['attr1']; break;
					case 'filter' : $c = 'blue'; $item = 'Filter: ' . $rec['attr1']; break;
					default       : if ($rec['tid']) {
										$c = 'purple'; 
										$item = _m('rccontrolpanel.getItemName use '.$rec['tid']);
										$link = seturl('t=kshow&id='.$rec['tid']);
									}	
					
					                switch ($rec['attr1']) {
										case 'cartin'  : $c = 'green'; $item = 'Cart in: ' . _m('rccontrolpanel.getItemName use '.$rec['tid']); break;
										case 'cartout' : $c = 'red';   $item = 'Cart out: ' . _m('rccontrolpanel.getItemName use '.$rec['tid']); break;
										case 'checkout': $c = 'gray';  $item = 'Checkout: ' . _m('rccontrolpanel.getItemName use '.$rec['tid']); break;
										default        : if ($rec['attr1']) {
															$c = 'yellow'; 
															$item = _m("cmsrt.replace_spchars use ".$rec['attr1']."+1");
															$link = seturl('t=klist&cat='.$rec['attr1']);
										                 }	
					                } 
				}
				
				$details = $rec['attr3'] ? 'Reference:' . $rec['ref'] .' ('.$rec['REMOTE_ADDR']. ')' : $rec['REMOTE_ADDR'];
						
				$tokens = array($c, $ic, $rec['datetime'], $rec['date'], $rec['time'], $item, $details, $link); 
				
				if ($template)
					$ret .= $this->combine_tokens($t, $tokens);
				else
					$ret[] = $tokens;	
			}	
		}	
		
		return ($ret);
	}	
	
    public function select_timeline($template=null, $year=null, $month=null) {
		$t = GetReq('t') ? GetReq('t') . '&v=' . $this->visitor : 'cpcrmtrace';
		$year = GetParam('year') ? GetParam('year') : date('Y'); 
	    $month = GetParam('month') ? GetParam('month') : date('m');
		$daterange = GetParam('rdate');
			
	    if ($template) {
			
			$tdata = _m("cmsrt.select_template use $template+1");
			
			for ($y=(date('Y')-2); $y<=intval(date('Y')); $y++) {
				$yearsli .= '<li>'. seturl('t='.$t.'&month='.$month.'&year='.$y, $y) .'</li>';
			}
		
			for ($m=1;$m<=12;$m++) {
				$mm = sprintf('%02d',$m);
				$monthsli .= '<li>' . seturl('t='.$t.'&month='.$mm.'&year='.$year, $mm) .'</li>';
			}	  
			
			//call cpGet from rcpmenu not this (only def action)
			$cpGet = _v('rcpmenu.cpGet');	
			if ($id = $cpGet['id']) {
				$itmname = _m('rccontrolpanel.getItemName use '.$id);
				$section = ' &gt; ' . $itmname;
			}	
			elseif ($cat = $cpGet['cat']) {
				//$section = ' &gt; ' . str_replace($this->cseparator, ' &gt; ', _m("cmsrt.replace_spchars use $cat+1"));
				$ccat = explode($this->cseparator, $cat);
				foreach ($ccat as $i=>$mycat)
					$section .= _m("cmsrt.replace_spchars use $mycat+1") . ' &gt; ';
			}	
			else
				$section = null;
	  
	        $posteddaterange = $daterange ? ' &gt; ' . $daterange : ($year ? ' &gt; ' . $month . ' ' . $year : null) ;
	  
			$tokens[] = localize('_crm',getlocal()) . $section . $posteddaterange; 
			$tokens[] = $year;
			$tokens[] = $month;
			$tokens[] = localize('_year',getlocal());
			$tokens[] = $yearsli;
			$tokens[] = localize('_month',getlocal());			
			$tokens[] = $monthsli;	
            $tokens[] = $daterange;			
		
			$ret = $this->combine_tokens($tdata, $tokens); 				
     
			return ($ret);
		}
		
		return null;	
    }		
	
	//tokens method	
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