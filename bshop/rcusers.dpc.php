<?php

$__DPCSEC['RCUSERS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCUSERS_DPC")) && (seclevel('RCUSERS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCUSERS_DPC",true);

$__DPC['RCUSERS_DPC'] = 'rcusers';

$b = GetGlobal('controller')->require_dpc('bshop/shusers.dpc.php');
require_once($b);


$__EVENTS['RCUSERS_DPC'][0]='cpusers';
$__EVENTS['RCUSERS_DPC'][1]='deluser';
$__EVENTS['RCUSERS_DPC'][2]='reguser';
$__EVENTS['RCUSERS_DPC'][3]='insuser';
$__EVENTS['RCUSERS_DPC'][4]='upduser';
$__EVENTS['RCUSERS_DPC'][5]='saveupduser';
$__EVENTS['RCUSERS_DPC'][6]='cpupdate';
$__EVENTS['RCUSERS_DPC'][7]='cpupdateadv';
$__EVENTS['RCUSERS_DPC'][8]='cpusractiv';
$__EVENTS['RCUSERS_DPC'][9]='regusercus';
$__EVENTS['RCUSERS_DPC'][10]='cpsusers';

$__ACTIONS['RCUSERS_DPC'][0]='cpusers';
$__ACTIONS['RCUSERS_DPC'][1]='deluser';
$__ACTIONS['RCUSERS_DPC'][2]='reguser';
$__ACTIONS['RCUSERS_DPC'][3]='insuser';
$__ACTIONS['RCUSERS_DPC'][4]='upduser';
$__ACTIONS['RCUSERS_DPC'][5]='saveupduser';
$__ACTIONS['RCUSERS_DPC'][6]='cpupdate';
$__ACTIONS['RCUSERS_DPC'][7]='cpupdateadv';
$__ACTIONS['RCUSERS_DPC'][8]='cpusractiv';
$__ACTIONS['RCUSERS_DPC'][9]='regusercus';
$__ACTIONS['RCUSERS_DPC'][10]='cpsusers';

$__DPCATTR['RCUSERS_DPC']['cpusers'] = 'cpusers,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCUSERS_DPC'][0]='RCUSERS_DPC;Users;Χρήστες';
$__LOCALE['RCUSERS_DPC'][1]='_reason;Reason;Αιτία';
$__LOCALE['RCUSERS_DPC'][2]='_cdate;Date in;Ημ/νία εισοδου';
$__LOCALE['RCUSERS_DPC'][3]='_price;Price;Τιμή';
$__LOCALE['RCUSERS_DPC'][4]='_ftype;Pay;Πληρωμή';
$__LOCALE['RCUSERS_DPC'][5]='_name1;First Name;Ονομα';
$__LOCALE['RCUSERS_DPC'][6]='_name2;Last Name;Επώνυμο';
$__LOCALE['RCUSERS_DPC'][7]='_kybismos;Kyb.;Κυβικα';
$__LOCALE['RCUSERS_DPC'][8]='_color;Color;Χρώμα';
$__LOCALE['RCUSERS_DPC'][9]='_extras;Extras;Εχτρα';
$__LOCALE['RCUSERS_DPC'][10]='_address;Address;Διεύθυνση';
$__LOCALE['RCUSERS_DPC'][11]='_tel;Tel.;Τηλέφωνο';
$__LOCALE['RCUSERS_DPC'][12]='_mob;Mobile;Κινητό';
$__LOCALE['RCUSERS_DPC'][13]='_email;e-mail;e-mail';
$__LOCALE['RCUSERS_DPC'][14]='_fax;Fax;Fax';
$__LOCALE['RCUSERS_DPC'][15]='_TIMEZONE;Timezone;Ζωνη ωρας';
$__LOCALE['RCUSERS_DPC'][16]='_fname;Contact person;Υπεύθυνος επικοινωνίας';
$__LOCALE['RCUSERS_DPC'][17]='_lname;Title;Επωνυμια';
$__LOCALE['RCUSERS_DPC'][18]='_username;Username;Χρήστης';
$__LOCALE['RCUSERS_DPC'][19]='_password;Password;Κωδικός';
$__LOCALE['RCUSERS_DPC'][20]='_notes;Notes;Σημειωσεις';
$__LOCALE['RCUSERS_DPC'][21]='_subscribe;Subscriber;Συνδρομητης';
$__LOCALE['RCUSERS_DPC'][22]='_seclevid;seclevid;seclevid';
$__LOCALE['RCUSERS_DPC'][23]='_secparam;Param;Param';
$__LOCALE['RCUSERS_DPC'][24]='_active;Active;Ενεργός';
$__LOCALE['RCUSERS_DPC'][25]='_newuser;Add user;Προσθήκη χρήστη';
$__LOCALE['RCUSERS_DPC'][26]='_newcus;Add customer;Προσθήκη πελάτη';
$__LOCALE['RCUSERS_DPC'][27]='_newcususer;Add new;Προσθήκη συναλλασόμενου';
$__LOCALE['RCUSERS_DPC'][28]='_secparam;Param;Param';
$__LOCALE['RCUSERS_DPC'][29]='_code;Code;Κωδικός';
$__LOCALE['RCUSERS_DPC'][30]='_country;Country;Χώρα';
$__LOCALE['RCUSERS_DPC'][31]='_timezone;Tmzone;Tmzone';
$__LOCALE['RCUSERS_DPC'][32]='_language;Country;ΓλώσσαΧώρα';
$__LOCALE['RCUSERS_DPC'][33]='_age;Age;Ηλικία';
$__LOCALE['RCUSERS_DPC'][34]='_level;Level;Πρόσβαση';
$__LOCALE['RCUSERS_DPC'][35]='_fb;Linked;Σύνδεση';

class rcusers extends shusers {

    var $title, $msg, $path, $post;
	var $tell_activate, $tell_deactivate;
	var $subj_activate, $subj_deactivate;
	var $body_activate, $body_deactivate;

	public function __construct() {
		$lan = getlocal();
	
		shusers::__construct();
	
		$this->title = localize('RCUSERS_DPC',$lan);
		$this->path = paramload('SHELL','prpath');

		$this->delete = localize('_delete',$lan);
		$this->edit = localize('_edit',$lan);
		$this->add = localize('_add',$lan);
		$this->mail = localize('_mail',$lan);

		$this->msg = null;
		$this->sep = "|";
	  
		$this->tell_activate = remote_paramload('RCUSERS','mail_on_activate',$this->path);
		$this->tell_deactivate = remote_paramload('RCUSERS','mail_on_deactivate',$this->path);	
		$this->subj_activate = remote_paramload('RCUSERS','subject_on_activate',$this->path);
		$this->subj_deactivate = remote_paramload('RCUSERS','subject_on_deactivate',$this->path);
		$this->body_activate = remote_paramload('RCUSERS','text_on_activate',$this->path);
		$this->body_deactivate = remote_paramload('RCUSERS','text_on_deactivate',$this->path);

	}

    public function event($event=null) {

		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;

		switch ($event) {
			case 'cpusractiv'    : 	$this->activate_deactivate();
									break;
			case 'cpupdateadv'   :	break;
			case 'cpupdate'      : 	if (!$this->checkFields(null,$this->checkuseasterisk)) {		 
										//auto subscribe
										if (defined('CMSSUBSCRIBE_DPC'))  {
											if (trim(GetParam('autosub'))=='on')
												_m('cmssubscribe.dosubscribe use '.GetParam("eml"));//.'++-1');
											else
												_m('cmssubscribe.dounsubscribe use '.GetParam("eml"));//.'+-1');
										}
										$this->update();
									}	 
									break;
		 
			case 'regusercus'  	:   break;
			case 'reguser' 		:   break;
			case 'insuser' 		:   //$this->insert();
									$this->insert_user_customer();  
									break;
			case 'upduser' 		:   break;
			case 'saveupduser'  :   $this->update();
									break;
							  
			case 'deluser' 		:   $this->_delete(GetReq('rec'),'id');
									break;
			case 'searchtopic' 	: 					 
			case 'cpsusers'    	: 		 
			case 'cpusers'     	: 
			default            	: 
		}
    }

    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	

		switch ($action) {
			case 'cpupdateadv' : 	$out .= $this->user_form();
									break;
			case 'deluser'     : 	$out .= $this->viewUsers();
									break;
			case 'regusercus'  :  	$out .= $this->regform(null,'insuser');
									break;							  
			case 'reguser'     : 	$out .= $this->regform();
									break; 
			case 'cpupdate'    :	$out .= $this->viewUsers();	
									break;		  
			case 'upduser' 	   :    $out .= $this->update_user_form();   
									break;
			case 'cpsusers'    : 	$out .= $this->viewSuperUsers();
									break;
			case 'saveupduser' :
			case 'insuser'     :
			case 'cpusers'     :
			case 'cpusractiv'  :
			case 'searchtopic' :			 
			default            : 	$out .= $this->viewUsers();	
		}

		return ($out);
    }
	
	protected function getFbELT($flname, $as=null, $eltarr=null) {
		if (!$flname) return null;
		$lan = getlocal();

		if (empty($eltarr)) return null;
		
		foreach ($eltarr as $id=>$descr) {
			$fields[] = $id;
			$locales[] = localize($descr, $lan);
		}	
		
		$f = "'" . implode("','", $fields) ."'";
		$l = "'" . implode("','", $locales) . "'";
		
		$a = $as ? "as $as" : null;
		$ret = "ELT(FIELD({$flname}, {$f}), {$l}) {$a}";
		return ($ret);
	}	
	
	protected function viewUsers() {	   
        $sFormErr = GetGlobal('sFormErr');
		$lan = getlocal();
	    if (($msg = $this->msg) || ($msg = $sFormErr)) 
			$out = $msg;	
		
		$isadmin = _m('cmsrt.isLevelUser use 9');
			
	    if (defined('MYGRID_DPC')) {
			
			$edit = $isadmin ? 'd' : 'e';
			$editf = $isadmin ? 1 : 0;
			
			$u = localize('_user', $lan);
			$lookup1 = $this->getFbELT('fb', 'fbdescr', array('0'=>'Site '.$u, '1'=>'Facebook '.$u, '2'=>'Guest '.$u));
			
			$where = null; //"where seclevid<5";  //order by id desc //disable search
            $xsSQL = "SELECT * from (select id,timein,active,code2,ageid,cntryid,lanid,timezone,email,notes,fname,lname,username,seclevid,$lookup1 from users $where) o ";		   
		   
		    _m("mygrid.column use grid1+id|".localize('id',$lan) . "|link|5|".seturl('t=cpusractiv&rec={id}')); //"|5|0|||1");
		    _m("mygrid.column use grid1+timein|".localize('_date',$lan)."|8|0|");//"|link|0|".seturl('t=cptransactions&cusmail={username}').'||');	   
			_m("mygrid.column use grid1+active|".localize('_active',$lan)."|boolean|1|");
		    _m("mygrid.column use grid1+notes|".localize('_active',$lan)."|8|1|"); 
		    _m("mygrid.column use grid1+username|".localize('_username',$lan)."|20|0|");						
			_m("mygrid.column use grid1+fbdescr|".localize('_fb',$lan)."|8|1|");
		    _m("mygrid.column use grid1+fname|".localize('_fname',$lan)."|20|1|");
		    _m("mygrid.column use grid1+lname|".localize('_lname',$lan)."|20|1|");
		    _m("mygrid.column use grid1+ageid|".localize('_age',$lan)."|2|1|");
		    _m("mygrid.column use grid1+cntryid|".localize('_country',$lan)."|2|1|");
		    _m("mygrid.column use grid1+lanid|".localize('_language',$lan)."|2|1|");
		    _m("mygrid.column use grid1+timezone|".localize('_timezone',$lan)."|2|1|");
		    _m("mygrid.column use grid1+email|".localize('_email',$lan)."|20|1|");
		    _m("mygrid.column use grid1+code2|".localize('_code',$lan)."|20|1|");			
			_m("mygrid.column use grid1+seclevid|".localize('_level',$lan)."|5|$editf|");
		   
		    $out .= _m("mygrid.grid use grid1+users+$xsSQL+$edit+".localize('RCUSERS_DPC',$lan)."+id+0+1+36+600++0+1+1");
		   
		    return ($out); 	
	    }

		return ('ENABLE JQGRID:'.$out);		
	}	
	
	protected function viewSuperUsers() {	   
        $sFormErr = GetGlobal('sFormErr');
		$lan = getlocal();
		$AdminSecID = GetSessionParam('ADMINSecID');
		$from = "seclevid>=5";
		$to = ($AdminSecID>=5) ? "seclevid<=" . intval($AdminSecID) : "seclevid<5";
	    if (($msg = $this->msg) || ($msg = $sFormErr)) 
			$out = $msg;	
			
		$isadmin = _m('cmsrt.isLevelUser use 9');
			
	    if (defined('MYGRID_DPC')) {
			
			$edit = $isadmin ? 'd' : 'e';
			$edif = $isadmin ? 1 : 0;
			
            $xsSQL = "SELECT * from (select id,timein,active,code2,ageid,cntryid,lanid,timezone,email,notes,fname,lname,username,seclevid from users where $from and $to) o ";		   
		   
		    _m("mygrid.column use grid1+id|".localize('id',$lan)."|link|5|".seturl('t=cpusractiv&rec={id}').'||');;//."|5|0|||1");
		    _m("mygrid.column use grid1+timein|".localize('_date',$lan)."|link|1|".seturl('t=cptransactions&cusmail={username}').'||');	   
			_m("mygrid.column use grid1+active|".localize('_active',$lan)."|boolean|1|");
		    _m("mygrid.column use grid1+notes|".localize('_active',$lan)."|5|1|") ;
		    _m("mygrid.column use grid1+username|".localize('_username',$lan)."|20|$edif|");						
		    _m("mygrid.column use grid1+fname|".localize('_fname',$lan)."|20|1|");
		    _m("mygrid.column use grid1+lname|".localize('_lname',$lan)."|20|1|");
		    _m("mygrid.column use grid1+ageid|".localize('_age',$lan)."|2|1|");
		    _m("mygrid.column use grid1+cntryid|".localize('_country',$lan)."|2|1|");
		    _m("mygrid.column use grid1+lanid|".localize('_language',$lan)."|2|1|");
		    _m("mygrid.column use grid1+timezone|".localize('_timezone',$lan)."|2|1|");
		    _m("mygrid.column use grid1+email|".localize('_email',$lan)."|20|1|");
		    _m("mygrid.column use grid1+code2|".localize('_code',$lan)."|20|1|");			
		    _m("mygrid.column use grid1+seclevid|".localize('_level',$lan)."|5|$edif|");		   
		    $out .= _m("mygrid.grid use grid1+users+$xsSQL+$edit+".localize('RCUSERS_DPC',$lan)."+id+0+1+36+600++0+1+1");
		   
		    return ($out); 	
	    }

		return ('ENABLE JQGRID:'.$out);		
	}		
	
	protected function update_user_form() {
	
		//update form
		$out = $this->register(GetReq('rec'),'id','rec','cpupdate');
	   
		if (defined('RCTRANSACTIONS_DPC')) 
			$out .= _m("rctransactions.show_grid use +150+1");	        
       
		return ($out); 	   
	}
	
	//when post
	protected function insert_user_customer() {
	
        if ($this->includecusform) {
			//RCCUSTOMERS...extends shcaustomers
			if ( (defined('SHCUSTOMERS_DPC')) ) {// && (seclevel('SHCUSTOMERS_DPC',$this->userLevelID)) ) {
				//echo 'a>';
			    if ($this->check_existing_customer) {
				    //echo 'b>';
                    if ($cid = _m('shcustomers.customer_exist use 1')) {
		                if ($cid<>-1) {//not mapped customer	
								     //echo 'c1>';
								     $checkcuserr = null;
									 $this->map_customer = true;						 
									 $this->customer_exist_id = $cid;
						}
						else {//already maped customer
								     //echo 'c2>';
								     $checkcuserr = localize('_CUSTEXISTS',getlocal());//'Customer exist!';
									 $this->map_customer = false;	
									 $this->customer_exist_id = null;
									 SetGlobal('sFormErr',$checkcuserr);
						}
					}
					else  {//new customer
					    //echo 'c>';
					    $checkcuserr = _m('shcustomers.checkFields use +'.$this->checkuseasterisk);   
				 	    $this->map_customer = null; //new customer	
				    } 
			    }
			    else {//new customer
			        $checkcuserr = _m('shcustomers.checkFields use +'.$this->checkuseasterisk);
			   	    //SetGlobal('sFormErr',$checkcuserr);
			    }
		    }
							   
			//user check  
			$checkusrerr = $this->checkFields(null,$this->checkuseasterisk);
			//echo 'errors:',$checkusrerr,'|',$checkcuserr;
							 
			if ((!$checkusrerr) && (!$checkcuserr))  {		
			    //echo 'e>';
				$this->insert_with_customer();							  					 
			} 
							 
	    }//not include cus form
	    else {
	        if (!$this->checkFields(null,$this->checkuseasterisk)) {	
	            $this->insert();
            }
        }	
	}	
	
	protected function user_form() {
		global $config;	
		$db = GetGlobal('db');	
		$id = GetReq('rec');
		$lan = getlocal();
	
		$config['FORM']['element_bgcolor1'] = 'EEEEEE';
		$config['FORM']['element_bgcolor2'] = 'DDDDDD';	
		   
		$sSQL = "select id from users ";
		$sSQL .= " WHERE id='" . $id . "'";	
	  
		$resultset = $db->Execute($sSQL,2);	
		$id = $resultset->fields['id']	;  
		 
		_m('dataforms.setform use myform+myform+5+5+50+100+0+0');
		_m('dataforms.setformadv use 0+0+50+10');
		_m('dataforms.setformgoto use DPCLINK:cpusers:OK');
		_m('dataforms.setformtemplate use cpupdateadvok');	   
	   
		$fields = "code1,code2,ageid,clogon,cntryid,email,fname,genid,lanid,lastlogon,lname,notes,seclevid,sesdata" .
					",startdate,subscribe,username,password,vpass,timezone";		   
				 
		$farr = explode(',',$fields);
		foreach ($farr as $t)
			$title[] = localize($t,$lan);
			
		$titles = implode(',',$title);			 	 						 	
		 
		$out .= _m("dataforms.getform use update.users+dataformsupdate+Post+Clear+$fields+$titles++id=$id+dummy");	  
	   
		return ($out);		 
	}
	
	public function activate_user() {
	    $db = GetGlobal('db');	
		$id = GetReq('rec');
		 
		$sSQL = "update users set active=1,notes='ACTIVE' where id = " . $id;
        $db->Execute($sSQL);
		
        if($db->Affected_Rows()) {
			SetGlobal('sFormErr',"ok");
			return ($id);
		}  

		SetGlobal('sFormErr',localize('_MSG18',getlocal()));			 
		return false;
	}
	
	public function deactivate_user() {
	    $db = GetGlobal('db');	
		$id = GetReq('rec');
		 
		$sSQL = "update users set active=0,notes='DELETED' where id = " . $id;
        $db->Execute($sSQL);
		
        if($db->Affected_Rows()) {
			SetGlobal('sFormErr',"ok");
			return ($id);
		}		 

		SetGlobal('sFormErr',localize('_MSG18',getlocal()));			 
		return false;
	}		
	
	public function is_activated_user() {
	    $db = GetGlobal('db');	
		$id = GetReq('rec');
		 
		$sSQL = "select active,notes from users where id = " . $id;	 
        $result = $db->Execute($sSQL,2);
		 
		if ($result->fields[0])
			return true;
		 
		return false;
	}
	
	protected function fetch_user_data($id, $fields=null) {
	    $db = GetGlobal('db');	
		if ((!$id) || (!$fields)) return false;
		 
		if (stristr($fields,'::')) {
			$mfa = explode('::',$fields);//array of fields
			$mf = str_replace('::',',',$fields);
		}  
		else {
			$mfa = $fields; //one element		 
			$mf = $fields;
		}
		 
		$sSQL = "select $mf from users where id = " . $id;
        $result = $db->Execute($sSQL,2);
		 
		if (is_array($mfa)) {
			foreach ($mfa as $i=>$f)
				$ret[$f] = $result->fields[$f];
		}
		else
			$ret = $result->fields[$mfa];
		  
		return ($ret);  
	}	
	
	protected function activate_deactivate() {
	
	    if ($this->is_activated_user()) {
	   
			$uid = $this->deactivate_user();
		 
			if (($uid) && ($this->tell_deactivate)) {
				
				$user_email = $this->fetch_user_data($uid,'email');
				if ($mytemplate = _m('cmsrt.select_template use userdeactivatetell')) {
					$tokens[] = $user_email;
					$mailbody = $this->combine_tokens($mytemplate,$tokens);
					$this->mailto($this->tell_it, $user_email, $this->subj_activate, $mailbody);
				}
				else			
					$this->mailto($this->tell_it, $user_email, $this->subj_deactivate, $this->body_deactivate);
			}		 
	    }	 
	    else {
	   
			$uid = $this->activate_user();	 
		 
			if (($uid) && ($this->tell_activate)) {
				
				$user_email = $this->fetch_user_data($uid,'email');
				if ($mytemplate = _m('cmsrt.select_template use useractivatetell')) {
					$tokens[] = $user_email;
					$mailbody = $this->combine_tokens($mytemplate,$tokens);
					$this->mailto($this->tell_it, $user_email, $this->subj_activate, $mailbody);
				}
				else
					$this->mailto($this->tell_it, $user_email, $this->subj_activate, $this->body_activate);		 
			}
		}	 
	}	
	
};
}
?>