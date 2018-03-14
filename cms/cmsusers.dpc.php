<?php
$__DPCSEC['CMSUSERS_DPC']='1;1;1;1;1;1;1;1;1;1;1';
$__DPCSEC['SIGNUP_']='2;2;1;1;1;2;2;2;9;9;9';
$__DPCSEC['USERSMNG_']='7;1;1;1;1;1;1;7;9;9;9';
$__DPCSEC['DELETEUSR_']='2;1;1;1;1;1;1;1;9;9;9';
$__DPCSEC['UPDATEUSR_']='1;1;2;2;2;2;2;2;9;9;9';
$__DPCSEC['ACCOUNTMNG_']='2;1;2;2;2;2;2;2;9;9;9';

if ((!defined("CMSUSERS_DPC")) && (seclevel('CMSUSERS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CMSUSERS_DPC",true);

$__DPC['CMSUSERS_DPC'] = 'cmsusers';

$__EVENTS['CMSUSERS_DPC'][0]='cmsusers';
$__EVENTS['CMSUSERS_DPC'][1]='signup';
$__EVENTS['CMSUSERS_DPC'][2]='insert';
$__EVENTS['CMSUSERS_DPC'][3]='update';
$__EVENTS['CMSUSERS_DPC'][4]='delete';
$__EVENTS['CMSUSERS_DPC'][5]='useractivate';
$__EVENTS['CMSUSERS_DPC'][6]='insertajax';

$__ACTIONS['CMSUSERS_DPC'][0]='cmsusers';
$__ACTIONS['CMSUSERS_DPC'][1]='signup';
$__ACTIONS['CMSUSERS_DPC'][2]='insert';
$__ACTIONS['CMSUSERS_DPC'][3]='update';
$__ACTIONS['CMSUSERS_DPC'][4]='delete';
$__ACTIONS['CMSUSERS_DPC'][5]='useractivate';
$__ACTIONS['CMSUSERS_DPC'][6]='insertajax';

$__DPCATTR['CMSUSERS_DPC']['signup'] = 'signup,1,0,1';

$__LOCALE['CMSUSERS_DPC'][0]='CMSUSERS_DPC;Users;Users';
$__LOCALE['CMSUSERS_DPC'][1]='_USERNAME;Username;Χρήστης';
$__LOCALE['CMSUSERS_DPC'][2]='_PASSWORD;Password;Κωδικός';
$__LOCALE['CMSUSERS_DPC'][3]='_MSG9;The following fields are optional.;Τα παρακάτω πεδία εξυπηρετούν στατιστικούς λόγους και δεν είναι απαραίτητα.';
$__LOCALE['CMSUSERS_DPC'][4]='_MSG10;Successfull registration!;Επιτυχής καταχώρηση!';
$__LOCALE['CMSUSERS_DPC'][5]='_MSG11;is required;είναι απαραίτητο';
$__LOCALE['CMSUSERS_DPC'][6]='_MSG12;The field;Το στοιχείο';
$__LOCALE['CMSUSERS_DPC'][7]='_MSG13;No valid Password !;Ο κωδικός δεν συμφωνεί με την επιβεβαιωσή του';
$__LOCALE['CMSUSERS_DPC'][8]='_MSG17;Invalid data. Your username used by someone else!;Μη αποδεκτά δεδομένα. Το όνομα χρήστη είναι δεσμευμένο';
$__LOCALE['CMSUSERS_DPC'][9]='_MSG18;Invalid update or the data has no diference!;Μη αποδεκτά δεδομένα ή μη διαφορά νέων δεδομένων';
$__LOCALE['CMSUSERS_DPC'][10]="_MSG19;Can't delete this record!;Αδύνατη η διαγραφή";
$__LOCALE['CMSUSERS_DPC'][11]='_FNAME;First name;Ονομα';
$__LOCALE['CMSUSERS_DPC'][12]='_LNAME;Last name;Επωνυμο';
$__LOCALE['CMSUSERS_DPC'][13]='_VPASS;Verify Password;Επιβεβαίωση Κωδικού';
$__LOCALE['CMSUSERS_DPC'][14]='_EMAIL;e-mail;Ηλ. Ταχυδρομείο';
$__LOCALE['CMSUSERS_DPC'][15]='_COUNTRY;Country;Χώρα';
$__LOCALE['CMSUSERS_DPC'][16]='_LANGUAGE;Language;Γλώσσα';
$__LOCALE['CMSUSERS_DPC'][17]='_AGE;Age;Ηλικία';
$__LOCALE['CMSUSERS_DPC'][18]='_GENDER;Gender;Φύλλο';
$__LOCALE['CMSUSERS_DPC'][19]='_SEARCHUSR;Search User;Αναζήτηση Χρήστη';
$__LOCALE['CMSUSERS_DPC'][20]='_SIGNUP;SignUp;Εγγραφή';
$__LOCALE['CMSUSERS_DPC'][21]='_UPDATE;Update;Αλλαγή';
$__LOCALE['CMSUSERS_DPC'][22]='_DELETE;Delete;Διαγραφή';
$__LOCALE['CMSUSERS_DPC'][23]='_USERS;Users;Χρήστες';
$__LOCALE['CMSUSERS_DPC'][24]='_FORMWARN;Fields with (*) required.;Τα πεδία με αστερίσκο (*) ειναι απαραίτητα.';
$__LOCALE['CMSUSERS_DPC'][25]='_PDATA;Personal Data;Προσωπικά Στοιχεία';
$__LOCALE['CMSUSERS_DPC'][26]='SHUSERS_CNF;Manage my Account;Διαχείρηση Λογαριασμού';
$__LOCALE['CMSUSERS_DPC'][27]='_NOPRIV;Denied! No privileges.;Αρνηση! Δεν έχετε δικαίωμα.';
$__LOCALE['CMSUSERS_DPC'][28]="_MSG20;Record not affected;Η εγγραφή δεν καταχωρήθηκε.";
$__LOCALE['CMSUSERS_DPC'][29]="_MSG21;Password and verify password doesn't match!;Η επιβαιβαιωση κωδικου δεν συμφωνει με τον κωδικο σας.";
$__LOCALE['CMSUSERS_DPC'][30]='_UNMSG;Username will be send to you at the end of this proccess!;Το ονομα χρήστη θα σας αποσταλει μετα το τελος της διαδικασίας!';
$__LOCALE['CMSUSERS_DPC'][31]='_UMAILSUBH;New Registration ;Νεα εγγραφη';
$__LOCALE['CMSUSERS_DPC'][32]='_UMAILSUBC;New user;Νέος χρήστης';
$__LOCALE['CMSUSERS_DPC'][33]='_UNKNOWNENTRY;WARNING:You are not an official registrated user, you can not use all of our company services until to physicaly register by phone!;ΠΡΟΣΟΧΗ: Δεν ειστε έγκυρος πελάτης της εταιρείας μας και δεν θα έχετε δικαίωμα παραγγελίας, επικοιωνήστε τηλεφωνικώς για την πρώτη σας εγγραφή και επαναλάβετε την διαδικασία εγγραφής!';
$__LOCALE['CMSUSERS_DPC'][34]='_TIMEZONE;Timezone;Ζωνη ωρας';
$__LOCALE['CMSUSERS_DPC'][35]='_PASS;Password;Κωδικός';
$__LOCALE['CMSUSERS_DPC'][36]='_USEREXISTS;Username exists. Already registered!;Ο χρήστης υπάρχει. Είστε ήδη καταχωρημένος';
$__LOCALE['CMSUSERS_DPC'][37]='_CUSTEXISTS;Customer exists. Already registered!;Είστε ήδη καταχωρημενος';
$__LOCALE['CMSUSERS_DPC'][38]='_SUCCESSREG;An mail send to you. Follow the instruction in order to complete the registartion process!;Ένα email σταλθηκε στον λογαριασμό ηλ. ταχυδρομείου που δηλώσατε. Ακολουθήστε τις οδηγίες για την ολοκληρωση της διαδικασίας εγγραφής.';
$__LOCALE['CMSUSERS_DPC'][39]='_ACTIVATEOK;Account activated;Ο λογαριασμός σας ενεργοποιήθηκε';
$__LOCALE['CMSUSERS_DPC'][40]='_ACTIVATEERR;User activation error;Ο λογαριασμός σας παρουσίασε σφάλμα';
$__LOCALE['CMSUSERS_DPC'][41]='_USERREGISTRATION;User registration;Εγγραφή χρήστη';
$__LOCALE['CMSUSERS_DPC'][42]='_MSGPWD;Invalid password format, 8 characters length required;Μη αποδεκτός κωδικός, 8 χαρακτήρες τουλάχιστον είναι απαραίτητοι';
$__LOCALE['CMSUSERS_DPC'][43]='_ACTIVATEERR2;User is activated;Ο λογαριασμός είναι ενεργοποιημένος';
$__LOCALE['CMSUSERS_DPC'][44]='_USRPLEASETEXT;Create your account;Δημιουργήστε ενα λογαριασμό';
$__LOCALE['CMSUSERS_DPC'][45]="_MSG21;Record not affected;Πρόβλημα κατά την αποθήκευση.";

class cmsusers  {

	var $urlpath;	
	var $userLevelID, $msg, $pagenum, $searchtext;
	var $country_id, $language_id, $age_id, $gender_id, $job_id;

	var $username, $userid, $security;
	var $tell_it, $tell_subject, $it_sendfrom;
	var $new_user_id, $usemail2send, $usemailasusername;
	var $usrform, $usrformtitles, $checkuseasterisk;
    var $deny_multiple_users, $inactive_on_register, $stay_inactive;	
	//var $appname, $mtrackimg;	

	public function __construct() {

		$UserSecID = GetGlobal('UserSecID');
		$sFormErr = GetGlobal('sFormErr');
		$UserName = GetGlobal('UserName');
		$UserID = GetGlobal('UserID');

		$this->userLevelID = $UserSecID ? decode($UserSecID) : 0;
		$this->username = $UserName ? decode($UserName) : null;
		$this->userid = $UserID ? decode($UserID) : null;
		
		$this->path = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');	   

		$this->country_id = remote_paramload('CMSUSERS','countryid',$this->path);
		$this->language_id = remote_paramload('CMSUSERS','lanid',$this->path);
		$this->age_id = remote_paramload('CMSUSERS','ageid',$this->path);
		$this->gender_id = remote_paramload('CMSUSERS','genderid',$this->path);
		$this->tmz_id = remote_paramload('CMSUSERS','tmzid',$this->path);	   		
		$this->it_sendfrom = remote_paramload('CMSUSERS','sendusernamefrom',$this->path);
		$this->usemailasusername =  remote_paramload('CMSUSERS','usemailasusername',$this->path);
		$this->usemail2send =  remote_paramload('CMSUSERS','usemail2send',$this->path);
		$this->tell_it = remote_paramload('CMSUSERS','tellregisterto',$this->path);
	    $this->tell_subject = remote_paramload('CMSUSERS','tellsubject',$this->path);
		$this->usrform = remote_arrayload('CMSUSERS','usrform',$this->path);		   
		$this->usrformtitles = remote_arrayload('CMSUSERS','usrformtitles',$this->path);		
		$this->checkuseasterisk = remote_paramload('CMSUSERS','checkasterisk',$this->path);	 
		$this->deny_multiple_users = remote_paramload('CMSUSERS','denymultuser',$this->path);	   
		$this->inactive_on_register = remote_paramload('CMSUSERS','inactive_on_register',$this->path);	   
		$this->stay_inactive = remote_paramload('CMSUSERS','stay_inactive',$this->path); 
	   	
		$this->security = 1; //default	
		$this->job_id = 0;
		$this->pagenum = 30;		
		$this->msg = $sFormErr;			
	}

    public function event($sAction) {

       if (!$this->msg) {

         switch($sAction)   {
		 
		    case 'useractivate' : 	$this->msg = $this->user_activate(); 
									break;

			case "insertajax" 	:
            case "insert"		: 	$this->insert();
									break;
						   
            case "update"		:  	if (defined('CMSSUBSCRIBE_DPC')) { 
										$email = GetParam("eml");	
										if (GetParam('autosub')) //=='on')
											_m("cmssubscribe.dosubscribe use $email+1");
										//else
											//_m("cmssubscribe.dounsubscribe use $email+1");
									}	
									
									$this->update();
									$this->fbjs();							
									break;
							
            case "delete"		:  	if (defined('CMSSUBSCRIBE_DPC')) {
										$email = GetParam("eml");
										_m("cmssubscribe.dounsubscribe use $email+1");
									}
									$this->_delete();
									$this->fbjs();							
									break;
							
			default      		:  	$this->fbjs();				
          }
       }
	}

	public function action($action) {

        switch ($action) {
	        case 'useractivate':    $out = 	$this->userActivateForm();	
	                                break;
										 
			case "insertajax":		$msg = ($sFormErr=="ok") ? localize('_SUCCESSREG',getlocal()) :  GetGlobal('sFormErr');
									die($msg); break;						 
			 
		    case 'signup'    :
			default          :	$out = $this->register();
        }

        return ($out);
	}

	protected function fbjs() {
		$hash = GetSessionParam('fbhash'); 	
        if ($hash) {  
		
			$fbin = (defined('SHLOGIN_DPC')) ? _m('shlogin.is_fb_logged_in') : _m('cmslogin.is_fb_logged_in');
			$fbid = (defined('SHLOGIN_DPC')) ? _v('shlogin.facebook_userId') : _v('cmslogin.facebook_userId');
			
			//load fb js when in update page
			if (_m('cms.paramload use CMS+fbLogMode')==1) 
				$code = (defined('SHLOGIN_DPC')) ? _m('shlogin.fblogin_javascript use 1') : _m('cmslogin.fblogin_javascript use 1');
			
			$code .= "function fbfetch() {
FB.api('/me?fields=id,email,first_name,last_name,gender,timezone', function(response) {\$('#fname').val(response.first_name); \$('#lname').val(response.last_name); })};		
";

			if (iniload('JAVASCRIPT')) {
				$js = new jscript;		   	 	
				$js->load_js($code,null,1);		
				unset ($js);
			}
		}		
	}	

    public function get_seclevels() {

      $levels = explode(",",paramload('CMSUSERS','groups'));
      return ($levels);
    }

    public function regform($fields='',$cmd=null,$isupdate=null,$isadmin=null,$nodelivery=null,$noinvtype=null,$noincludecusform=null) {
		$UserName = GetGlobal('UserName');
		$sFormErr = GetGlobal('sFormErr');
		//readonly username field when update
		$is_update = $UserName ? true : false; 
		if ($is_update)
			$readonly = 'READONLY';	   

		$_t = ($isupdate) ? 'usrupdate00' : 'usrregister00';	   
		$mytemplate = _m('cmsrt.select_template use ' . $_t);
	   
		if ($fields) {
			$myfields = explode(";",$fields); //print_r($myfields);
			$fname = $myfields[0];
			$lname = $myfields[1];
			$uname = $myfields[2];
			$pwd = $myfields[3];
			$pwd2 = $myfields[4];
			$eml = $myfields[5];
			$country_id = $myfields[6];
			$language_id = $myfields[7];
			$age_id = $myfields[8];
			$gender_id = $myfields[9];   
		   	$tmz_id = $myfields[10];		
		}
		else {//get post data on error
			$fname = GetParam('fname');
			$lname = GetParam('lname');
			$uname = GetParam('uname');
			//$pwd = $myfields[3];
			//$pwd2 = $myfields[4];
			$eml = GetParam('eml');  
		}

		$sFileName = seturl("t=signup",0,1);

        $tokens[] = localize('_FORMWARN',getlocal()) . '<br>' . $sFormErr . "<form method=\"POST\" action=\"" .$sFileName. "\" name=\"Registration\">";	   
	    $tokens[] = "<input type=\"text\" class=\"myf_input\" name=\"fname\" maxlength=\"50\" value=\"" . ToHTML($fname) . "\" size=\"30\" >";
	    $tokens[] = "<input type=\"text\" class=\"myf_input\" name=\"lname\" maxlength=\"50\" value=\"" . ToHTML($lname) . "\" size=\"30\" >";
	    $tokens[] =  ($this->usemailasusername)  ? "<input type=\"text\" class=\"myf_input\" name=\"uname\" maxlength=\"55\" value=\"" . ToHTML($uname) . "\" size=\"25\" $readonly>" :
		 										   "<input type=\"text\" class=\"myf_input\" name=\"uname\" maxlength=\"50\" value=\"" . ToHTML($uname) . "\" size=\"15\" $readonly>";
	    $tokens[] = "<input type=\"password\" class=\"myf_input\" name=\"pwd\" maxlength=\"50\" value=\"" . ToHTML($pwd) . "\" size=\"15\" >";
	    $tokens[] = "<input type=\"password\" class=\"myf_input\" name=\"pwd2\" maxlength=\"50\" value=\"" . ToHTML($pwd2) . "\" size=\"15\" >";
	   
        if (!$this->usemailasusername) 
	        $tokens[] = "<input type=\"text\" class=\"myf_input\" name=\"eml\" maxlength=\"55\" value=\"" . ToHTML($eml) . "\" size=\"25\" >";   

	    $tokens[] = localize('_MSG9',getlocal());

	    $cntr = isset($country_id) ? $country_id : $this->country_id;	   
	    $tokens[] = "<select name=\"country_id\" class=\"myf_select\">" . get_options_file('country',false,true,$cntr) . "</select>";
	   
	    $lan = isset($language_id) ? $language_id : $this->language_id;   
	    $tokens[] = "<select name=\"language_id\" class=\"myf_select\">" . get_options_file('languages',false,true,$lan) . "</select>";
	   
	    $age = isset($age_id) ? $age_id : $this->age_id;  
	    $tokens[] = "<select name=\"age\" class=\"myf_select\">" . get_options_file('age',false,true,$age) . "</select>";
	   
	    $gender = isset($gender_id) ? $gender_id : $this->gender_id;   
	    $tokens[] = "<select name=\"gender\" class=\"myf_select\">" . get_options_file('gender',false,true,$gender) . "</select>";
	   
		$tmz = isset($tmz_id) ? $tmz_id : $this->tmz_id;   
		$tokens[] = "<select name=\"timezone\" class=\"myf_select\">" . get_options_file('timezones',false,true,$tmz) . "</select>";

		if (defined('CMSSUBSCRIBE_DPC')) {
			//check if user is in sub list
			if (_m('cmssubscribe.isin use '.$eml))  
				$statin = 'checked';

			$tokens[] = "<input type=\"checkbox\" class=\"myf_checkbox\" name=\"autosub\"". $statin . ">";      
	    }

		//submit section
        if ((seclevel('UPDATEUSR_',$this->userLevelID)) || ($isupdate)) {
              $updcmd = $cmd ? $cmd : 'update';
              $submitout .= "<input type=\"submit\" class=\"myf_button\" value=\"" . trim(localize('_UPDATE',getlocal())) . "\">";// onclick=\"document.forms('Registration').FormAction.value = '$updcmd';\">";
              $submitout .= "<input type=\"hidden\" value=\"$updcmd\" name=\"FormAction\"/>";			  
		}     
		$submitout .= "<input type=\"hidden\" value=".GetReq('rec')." name=\"rec\"/>";		   
		$submitout .= "<input type=\"hidden\" name=\"FormName\" value=\"Registration\">";
		$submitout .= "</form>";

	    $tokens[] = $submitout;
		if ($isupdate) { 
		    $tokens[] = $fname;
		    $tokens[] = $lname;
			$tokens[] = $statin; //subscription
		}
		
		//print_r($tokens);					
		$ret = $this->combine_tokens($mytemplate,$tokens);

		return ($ret);			  
	}

    protected function checkFields($bypass=null,$checkasterisk=null) {
		$sFormErr = GetGlobal('sFormErr');
		SetGlobal('sFormErr',"");
		$lan = getlocal() ? getlocal() : '0';	
	   
		if ($bypass) 
			return null;		   
	   
		$recfields = (array) $this->usrform;//custom fields
		$titlefields = (array) $this->usrformtitles;
	   
		if (!$recfields) {
			if ($this->usemailasusername) { 
				$recfields = array('uname','pwd','pwd2','fname','lname');
				$titlefields = array('_EMAIL','_PASS','_VPASS','_FNAME','_LNAME');
			}
			else {
				$recfields = array('eml','pwd','pwd2','fname','lname');
				$titlefields = array('_EMAIL','_PASS','_VPASS','_FNAME','_LNAME');
			}  
		}	   
	   
	   
		if ($checkasterisk) {

			foreach ($recfields as $field_num => $fieldname) {
				$titles = explode('/', remote_paramload('CMSUSERS',$fieldname,$this->path));
				$title = $titles[$lan];
				
				if (strstr($title,'*')) { //check by title using *
					if (!strlen(GetParam(_with($fieldname)))) 
						$sFormErr .= localize('_MSG12',getlocal()) . " <font color=\"red\">" . $title . "</font> " . localize('_MSG11',getlocal()) . "<br/>";
				}
			}		   
		}	
		else { 
			foreach ($recfields as $field_num => $fieldname) {

				if(!strlen(GetParam(_with($fieldname)))) 
					$sFormErr .= localize('_MSG12',getlocal()) . " <font color=\"red\">" . localize($titlefields[$field_num],getlocal()) . "</font> " . localize('_MSG11',getlocal()) . "<br/>";
			}	     
		}
	   
		//extra checks
		if ((is_numeric(GetParam("pwd"))) && (strlen(GetParam("pwd"))<8))
			$sFormErr .= localize('_MSGPWD',getlocal()) . "<br>";		 	   
	   
		//...password verification
		if (GetParam("pwd")!=GetParam("pwd2"))
			$sFormErr .= localize('_MSG13',getlocal()) . "<br>";	
		 
		//mail check	 
		if ($this->usemailasusername) { 
			if ($this->_checkmail(GetParam("uname"))==false)
				$sFormErr .= localize('_INVALIDMAIL',getlocal()) . "<br>";	
		}
		else {
			if ($this->_checkmail(GetParam("eml"))==false)
				$sFormErr .= localize('_INVALIDMAIL',getlocal()) . "<br>";		   
		}
	   
		//if (GetGlobal('FormAction')=='insert') {//only at insert
		if (GetParam('FormAction')!=='update') {//only when no update
			if (($this->deny_multiple_users) && ($this->user_exists(GetParam("uname")))) {
				$sFormErr .= localize('_USEREXISTS',getlocal()) . "<br>";		 
			}
		}
		 	   
		SetGlobal('sFormErr',$sFormErr);
		return $sFormErr;
    }

    protected function getuser($id="",$fkey=null,$isadmin=null,$isupdate=null) {
		$db = GetGlobal('db');
		$UserName = GetGlobal('UserName');
		$myfkey = $fkey?$fkey:'username';
		$a = GetReq('a');
		$g = GetReq('g');
		$un = decode($UserName); //echo $un;
		$myrec = $id?$id:$un;
	   

		if ($isupdate) {    
			$recfields = array('fname','lname','username','password','vpass','email');//,'lname');
			$basicfields = implode(',',$recfields);	   
		 
			$sSQL = "select " . $basicfields . ",CNTRYID,LANID,AGEID,GENID,TIMEZONE,SUBSCRIBE from users";//,NOTES,STARTDATE,IPINS,IPUPD,LASTLOGON,SECPARAM,SESID,SECLEVID,TIMEZONE FROM users" .
			if (strstr($myfkey,'id'))
				$sSQL.= " WHERE " . $myfkey . "=" . $myrec;// ."'";	
			else
				$sSQL.= " WHERE " . $myfkey . "='" . $myrec . "'";	   
		 //$sSQL.= " and lname<>'SUBSCRIBER'"; //compatibility with extra rec as subscriber		  
		}
		else {//????
			if ($isadmin) {//admin selection
				$sSQL = "SELECT FNAME,LNAME,USERNAME,PASSWORD,VPASSWRD,EMAIL,CNTRYID,LANID,AGEID,GENID,NOTES,STARTDATE,IPINS,IPUPD,LASTLOGON,SECPARAM,SESID,SECLEVID,TIMEZONE FROM users" .
				" WHERE ".$myfkey."='" . $myrec . "'";// . " AND USERNAME='" . $g . "'";
			}
			elseif ((!$a) || (!seclevel('USERSMNG_',$this->userLevelID))) { //unique selection
				$sSQL = "SELECT FNAME,LNAME,USERNAME,PASSWORD,VPASS,EMAIL,CNTRYID,LANID,AGEID,GENID,NOTES,STARTDATE,IPINS,IPUPD,LASTLOGON,SECPARAM,SESID,SECLEVID,TIMEZONE FROM users" .
				" WHERE " . $myfkey . "='" . $myrec . "'";// ."'";
			}
			else {//admin selection
				$sSQL = "SELECT FNAME,LNAME,USERNAME,PASSWORD,VPASSWRD,EMAIL,CNTRYID,LANID,AGEID,GENID,NOTES,STARTDATE,IPINS,IPUPD,LASTLOGON,SECPARAM,SESID,SECLEVID,TIMEZONE FROM users" .
				" WHERE ".$myfkey."='" . $a . "' AND USERNAME='" . $g . "'";
			} 
		}//elseif
	   
		$result = $db->Execute($sSQL,2);
		//echo $sSQL;	   

		if (count($result->fields)>1) {//check result...
			foreach ($result->fields as $i=>$rec) {
				if (is_numeric($i)) {
					$record[] = $rec;
				}
			}  
			$ret = implode(";",$record); //echo $record;		   
	   }	 
  
	   return ($ret);
	}

	//return array of record
    protected function getuserdata($what=null) {
		//read data
		$fields = $this->getuser();
		//in case of no customer data this must return null
		if (strlen($fields)>3) { //if empty returns ';;;'
			$myfields = explode(";",$fields);
			$data = $myfields;
		}
		
		//print_r($data);
		if (isset($what)) 
			return ($data[$what]);
	   
	     
		return ($data);
	}

	protected function register($myuser=null,$myfkey=null,$selectid=null,$cmd=null) {
        $user = decode(GetGlobal('UserID'));
	    $sFormErr = GetGlobal('sFormErr');
	    $a = GetReq($selectid) ? GetReq($selectid) : GetReq('a');
	    $mycmd_update = $cmd ? $cmd : 'update';	   

        if ($sFormErr=="ok") {

			SetGlobal('sFormErr',"");

			$myaction = GetGlobal('dispatcher')->getqueue(); 
			switch ($myaction) {

				case "insert":  $out = $this->after_registration_goto();break;
				case "update":  $out = $this->after_update_goto();	break;
				case "delete":  $out = $this->after_delete_goto();	break;
			}
	    }
	    else {
			if ((!$user) && (seclevel('SIGNUP_',$this->userLevelID))) {
				//echo 'a';			  
				$out .= $this->regform(); //insert action
			}	   
			elseif (seclevel('ACCOUNTMNG_',$this->userLevelID)) {
				//echo 'b';
				if ($myuser)
					$record = $this->getuser($myuser,$myfkey,null,1);
				else				 
					$record = $this->getuser(null,null,null,1);
				   
	            $out .= $this->regform($record,$mycmd_update,1,null,1,1,1); //update action

		   }
	   }

	   return ($out);
	}
	
	protected function after_registration_goto() {
	    $sFormErr = GetGlobal('sFormErr');

		if (defined('CMSLOGIN_DPC')) 
		    $out = _m('cmslogin.html_form');		
			   				   
						   
	    return ($out);
	}	
	
	protected function after_update_goto() {
	    $myaction = GetParam('FormAction');

	    if ((GetGlobal('UserID')) && 
			(stristr($myaction,'update'))) {//already in..modify account

				$out .= $this->register();
	    }	
	   
	    return ($out);
	}
	
	protected function after_delete_goto() {
	
		return ($out);
	}
	
	protected function pre_insert_task($preset=null) {
		$a = GetParam('fname');
		$b = GetParam('lname');	
		//$c = GetParam('uname');	
		$c = ($this->usemailasusername) ? GetParam("uname") : GetParam("eml");	
	          
		if ($this->_checkmail($c))	
			$genun = strtolower(trim($c)); //string = code of cus
		else
			return null; 
		
		//$genun = $this->usemailasusername ? : $a.' '.$b;
		//echo '>'.$genun;	 
		return ($genun);
	}
	
    //mail registration info to the company
	public function mailtohost($username=null,$password=null,$fname=null,$lname=null,$tell=false) {
		
		$tellit =	$tell ? $tell : $this->tell_it;
		
		if ($tellit) {
		  
			$mytemplate = _m('cmsrt.select_template use userinserttell');
		
			$tokens = array(); //reset		
			$tokens[] = $username;	
			$tokens[] = $password;	
			$tokens[] = $fname;	
			$tokens[] = $lname;			  					
			
			$mailbody = $this->combine_tokens($mytemplate,$tokens);

			$ss = $this->tell_subject;
			$subject = localize($ss, getlocal());
			$mysubject = $subject ? $subject : localize('_UMAILSUBC',getlocal());
		
			//$this->mailto($this->usemail2send,$this->tell_it,$mysubject,$mailbody);
			$body = str_replace('+','<SYN/>',$mailbody); 
			$mailerr = _m("cmsrt.cmsMail use {$this->usemail2send}+{$this->tell_it}+$mysubject+$body");
		}	
	} 

	//send username/password to user
	public function mailtoclient($username=null,$password=null,$fname=null,$lname=null) {
		
		if ($this->it_sendfrom) {

			$hash = md5('stereobit9networlds8and7the6heart5breakers');
			$sectoken = urlencode(base64_encode($username.'|'.$hash));
			$account_enable_link = seturl('t=useractivate&sectoken='.$sectoken);
			//echo $account_enable_link;
		
			$mytemplate = _m('cmsrt.select_template use userinsert'); 
			$tokens = array(); //reset	
			$tokens[] = $username;	
			$tokens[] = $password;
			$tokens[] = $account_enable_link;		  
			
			$mailbody = $this->combine_tokens($mytemplate,$tokens);
		
			$ss = $this->tell_subject;
			$subject = localize($ss, getlocal());
			$mysubject = $subject ? $subject : localize('_UMAILSUBC',getlocal());

			$body = str_replace('+','<SYN/>',$mailbody); 
			
			if ($this->usemailasusername) { 
				//$this->mailto($this->it_sendfrom,$username,$mysubject,$mailbody);
				$mailerr = _m("cmsrt.cmsMail use {$this->it_sendfrom}+$username+$mysubject+$body");
			}	
			else {
				$mail = GetParam('eml');
				//$this->mailto($this->it_sendfrom,$mail,$mysubject,$mailbody);
				$mailerr = _m("cmsrt.cmsMail use {$this->it_sendfrom}+$mail+$mysubject+$body");
			}	
			
			return true;
		}
		
		return false;	
	}	

	//parameter is the result of input = username
	protected function after_insert_task($username=null,$password=null,$fname=null,$lname=null) {

		//mail registration info to the company
		$this->mailtohost($username,$password,$fname,$lname);
	  
		//send username/password to user
		$this->mailtoclient($username,$password,$fname,$lname);
	  
		$this->auto_subscribe();
		
		return true;
	}
	
	protected function auto_subscribe() {		
		$subscribe = GetParam('autosub');
		$email = ($this->usemailasusername) ? GetParam("uname") : GetParam("eml");	
		if (!$email) return false;
		 
		if (defined('CMSSUBSCRIBE_DPC')) {
			//if (trim(GetParam('autosub'))=='on') {
			if ($subscribe) {	
				_m("cmssubscribe.dosubscribe use $email+1");
				return true;
			}  
	    }	

		return false;
	}	

	protected function insert() {
		$db = GetGlobal('db');
		$sFormErr = GetGlobal('sFormErr');
		$seclevid = $this->security;  	   

		if (!$err = $this->checkFields(null,$this->checkuseasterisk)) {		
		
			$user_code = $this->pre_insert_task();	
			//echo '+',$user_code;
	   
			if (!$user_code) {
				SetGlobal('sFormErr',localize('_MSG21',getlocal()).' #1');
				return null;	   
			}
	   
			//save it to restore if 2nd step exist to insert custime and to connect
			SetSessionParam('new_user_code',$user_code); 

			if ($un = $this->username_exist()) {
				SetGlobal('sFormErr', localize('_MSG17',getlocal()) . ' ' . $un);
			}
			else {
		 
				$activ = $this->inactive_on_register ? '0' : '1';
		  
				$sSQL = "insert into users" . " (" . "active,code2,fname,lname,username,password,vpass,email,CNTRYID,LANID,AGEID,GENID,timezone,notes,fb";
				if (seclevel('USERSMNG_',$this->userLevelID)) 
					$sSQL .= ",STARTDATE,IPINS,IPUPD,LASTLOGON,SECPARAM,SESID,SECLEVID";
				else 
					$sSQL .= ",SECLEVID"; //only security

				$sSQL .= ")" .  " values ($activ," .
						"'" . addslashes($user_code) . "'," . //username as usercode
						"'" . addslashes(GetParam("fname")) . "'," .
						"'" . addslashes(GetParam("lname")) . "'," .
						"'" . addslashes($user_code) . "'," . //username=usercode
						"'" . md5(addslashes(GetParam("pwd"))) . "'," .
						"'" . md5(addslashes(GetParam("pwd2"))) . "',";

				if ($this->usemailasusername)
					$sSQL .= "'" . addslashes($user_code) . "',";//email = usercode
				else
					$sSQL .= "'" . addslashes(GetParam("eml")) . "',";

				$country = GetParam("country_id")?GetParam("country_id"):0;
				$language = GetParam("language_id")?GetParam("language_id"):0;
				$age = GetParam("age")?GetParam("age"):0;
				$gender = GetParam("gender")?GetParam("gender"):0;
				$tmz = GetParam("timezone")?GetParam("timezone"):0;
		  
				$notes = '';
		  
				$sSQL .= $country . "," . $language . "," . $age . "," . $gender . "," . $db->qstr($tmz) . "," .	$db->qstr($notes) . ",0"; 

				if (seclevel('USERSMNG_',$this->userLevelID)) {
					$sSQL .= "," .
							GetParam("dcreate") . "," .
							"'" . GetParam("ipins")  . "'," .
							"'" . GetParam("ipupd")  . "'," .
							"'" . GetParam("llogin")  . "'," .
							"'" . GetParam("sparam")  . "'," .
							"'" . GetParam("sesid")  . "'," .
							"'" . GetParam("seclevid") ;
				}
				else 
					$sSQL .= "," . $seclevid;//only security automated (predefined customer)

				$sSQL .= ")";
				//echo $sSQL;
				$ret = $db->Execute($sSQL);	 //print_r($ret);

				if ($ret = $db->Affected_Rows()) {
					SetGlobal('sFormErr',"ok");
		   
					$this->update_statistics('registration', $user_code);

					//send code to customer
					$this->after_insert_task($user_code, GetParam("pwd"), GetParam("fname"), GetParam("lname"));
		   
					//INCLUDE CUSTOMER DATA TO MIX IN ONE FORM..SQL EXECUTE USER AND CUS QUERY... 
					/* DISABLED
					if ($this->includecusform) {		
						$sFormErr = _m('shcustomers.subinsert use '.$user_code);
						SetGlobal('sFormErr',$sFormErr);	   
					}*/
					//////////////////////////////////////////////////////////////////////////		   
					return true;
				}
				else {
					$ret = $db->ErrorMsg();
					SetGlobal('sFormErr',localize('_MSG20',getlocal()).' #2');
				}
			}
		}
		
		return false;	
	}

	public function update_user_code($c,$codef=null) {
		$db = GetGlobal('db');	
		$currentuser = decode($UserName);	   
	
		$code = $codef ? $codef : 'code2';
		$sSQL = "UPDATE users set $code=" . $c;
		$sSQL .= " WHERE USERNAME ='" . $currentuser . "'";
	   
		$db->Execute($sSQL);
		if($db->Affected_Rows()) return (true);
	                       else return (false);	   	    	
	}

	protected function update($id=null) {
		$db = GetGlobal('db');
		$UserName = GetGlobal('UserName');
		$sFormErr = GetGlobal('sFormErr');

		$rec = $id ? $id : GetParam('rec');
		$a = GetReq('a');
		$g = GetReq('g');
		$currentuser = decode($UserName);

		if (!$err = $this->checkFields(true,$this->checkuseasterisk)) {		

			$sSQL = "UPDATE users set " .
					"fname=" . $db->qstr(GetParam("fname"))  . "," .
					"lname=" . $db->qstr(GetParam("lname"));			

			$subscribe = GetParam('autosub') ? 1 : 0;	
			$CNTRYID = GetParam("country_id") ? GetParam("country_id") : '0';	   
			$LANID = GetParam("language_id") ? GetParam("language_id") : '0';
			$AGEID = GetParam("age") ? GetParam("age") : '0';
			$GENID = GetParam("gender") ? GetParam("gender") : '0';
			$TIMEZONE = GetParam("timezone") ? GetParam("timezone") : '';
	   

			$sSQL .= "," ;						
			$sSQL .= "CNTRYID=" . $CNTRYID  . ",";
			$sSQL .= "LANID=" . $LANID  . ",";
			$sSQL .= "AGEID=" . $AGEID  . ",";
			$sSQL .= "GENID=" . $GENID . ",";
			$sSQL .= "TIMEZONE=" . $db->qstr($TIMEZONE) . ",";	
			$sSQL .= "SUBSCRIBE=" . $subscribe . ",";	 			
			$sSQL .= "CLOGON=0";
         
			if ($rec) {
				$sSQL .= " WHERE ID =" . $rec;		 
			}
			elseif ($a) {
				$sSQL .= " WHERE CODE2 ='" . $a . "' AND USERNAME='" . $g . "'";		 
			}  
			else 
				$sSQL .= " WHERE USERNAME ='" . $currentuser . "'";

			//echo $sSQL;
			$db->Execute($sSQL,1);
			
			if($db->Affected_Rows()) { 
				SetGlobal('sFormErr',"ok");
				return true;
			}	
			else 
				SetGlobal('sFormErr',localize('_MSG18',getlocal()));
		
		}
		return false;
	}

	protected function _delete($id=null,$fkey=null) {
		$db = GetGlobal('db');
		$UserID = GetGlobal('UserID');
		$sFormErr = GetGlobal('sFormErr');	;
		$myfkey = $fkey?$fkey:'code2';
	
		$a = GetReq('a');
		$g = GetReq('g');

		if (!$a) $currentuserID = decode($UserID);
			else $currentuserID = $a;

		$myrec = $id ? $id : $currentuserID;

		if (seclevel('USERSMNG_',$this->userLevelID)) {

			//exclude record 1=admin
			if (GetReq('editmode')) {
				$sSQL = "delete from users where id=" . GetReq('rec');
			}
			elseif ($g!='admin') {
				$sSQL = "UPDATE users set active=0";
     
				if (!$a)
					$sSQL .= " WHERE $myfkey =" . $myrec . "'";
				else  		   
					$sSQL .= " WHERE $myfkey =" . $myrec . " AND USERNAME='" . $g . "'";

			}
			//echo $sSQL;		 
			$db->Execute($sSQL);
			
			if($db->Affected_Rows()) {
				SetGlobal('sFormErr',"ok");
				return true;
			}	
	        else 
				SetGlobal('sFormErr',localize('_MSG18',getlocal()));		 
	    }
		
		return false;
	}

	protected function update_statistics($id, $user=null) {
		
        if (defined('CMSVSTATS_DPC'))	
			return _m('cmsvstats.update_event_statistics use '.$id.'+'.$user);			
		
		return false;
	}		

    /////////////////////////////////////////////////////////////////
    // generate user selection list
    /////////////////////////////////////////////////////////////////
    protected function selectUser($select=0) {
		$levels = explode(",",paramload('CMSUSERS','groups'));

		if ($levels) {
			reset ($levels);
			//asort ($levels);

			$toprint .= "<select name=\"userlevel\" class=\"myf_select\">";//<OPTION value=\"1\">ALL</OPTION>\n";

			foreach ($levels as $lan_num => $lan_descr) {

				//not display users above this user
				if ($lan_num<=$this->userLevelID) {

					//is selected ?
					if ($lan_num==$select) $issel = 'selected';
									  else $issel = '';
					//have description
					if ($lan_descr!='')
						$toprint .= "<OPTION value=\"$lan_num\" $issel>$lan_descr</OPTION>\n";
				}
			}

			$toprint .= "\n</select>";
		}

		return ($toprint);
    }

    //- function returns options for HMTL control "<select>" as one string
    protected function get_options($sql,$is_search,$is_required,$selected_value) {
	    $db = GetGlobal('db');
        $options_str="";

        if ($is_search)
			$options_str.="<option value=\"\">All</option>";
        else  {
			if (!$is_required) 
				$options_str.="<option value=\"\"></option>";
        }

        $result = $db->Execute($sql,3);

        if ($result) {
			while (!$result->EOF)  {

				$id=$result->fields[0];
				$value=$result->fields[1];
				$selected="";
				if ($id == $selected_value) 
					$selected = "SELECTED";

				$options_str.= "<option value='".$id."' ".$selected.">".$value."</option>";

				$result->MoveNext();
			}
        }

        return $options_str;
    }

	public function get_user_name($prefix=null,$edituser=null) {
        $db = GetGlobal('db');
		$user = decode(GetGlobal('UserID'));
		if (!$user) return;
		$name = $user;
		
		if ($prefix) {
			if ($edituser) {
				$nk = seturl('t=signup');
				$ret = $prefix . "<a href='$nk'>" . '&nbsp;'. $name . "</a>";
			}
			else
				$ret = $prefix . $name;
		}  
		else {
			if ($edituser) {
				$nk = seturl('t=signup');		
				$ret = "<a href='$nk'>" . $name . "</a>";
			}
			else
				$ret = $name;			
		}  

		return ($ret);		
	}					
	
	public function get_user_timezone($c=null, $codef=null) {
		$db = GetGlobal('db');	
		$currentuser = $this->username;	   
	
		$code = $codef ? $codef : 'code2';
		$sSQL = "select timezone from users";
		if ($c)
			$sSQL .= " WHERE " . $code."=" . $c;
		else	
			$sSQL .= " WHERE USERNAME ='" . $currentuser . "'";
	   
		$result = $db->Execute($sSQL);	 	
		$timezone_descr = $result->fields['timezone'];
		$tmzid = $this->create_timezone_id($timezone_descr);
	   
		return ($tmzid);	//+- hours 
	}
	
	public function set_user_timezone($tmz, $c=null, $codef=null) {
		$db = GetGlobal('db');	
		$currentuser = $this->username;	   
	
		$code = $codef ? $codef : 'code2';
		$sSQL = "update users set timezone='$tmz'";
		if ($c)
			$sSQL .= " WHERE " . $code."=" . $c;
		else	
			$sSQL .= " WHERE USERNAME ='" . $currentuser . "'";
	   
		$db->Execute($sSQL);
		
		if($db->Affected_Rows()) 
			return true;
		
	    return false;	 		 
	}
	
	protected function create_timezone_id($timezone=null) {
	
		if (!$timezone) return 0;
	
		$p = explode(' ',$timezone);
		if (stristr($p[0],':')) {
	   
			if (stristr($p[0],'+')) {
				$t = explode('+',$p[0]);
				$ret = floatval(str_replace(':','.',$t[1]));
				//echo '+++',$ret;		   
			}  
			elseif (stristr($p[0],'-')) {  
				$t = explode('-',$p[0]);
				$ret = (floatval(str_replace(':','.',$t[1])) * -1);
				//echo '---',$ret;
			}  
			else 
				$ret = 0;//...  
		}
		else
			$ret = 0; //gmt time
		 
		return ($ret);	 
	}	
	
	public function get_user_country($c=null, $codef=null) {
		$db = GetGlobal('db');	
		$currentuser = $this->username;	   
	
		$code = $codef ? $codef : 'code2';
		$sSQL = "select cntryid from users";
		if ($c)
			$sSQL .= " WHERE " . $code."=" . $c;
		else	
			$sSQL .= " WHERE USERNAME ='" . $currentuser . "'";

		$result = $db->Execute($sSQL);	 	
		$country_id = $result->fields['cntryid'];
	   
		return ($country_id);	 
	}
	
	public function set_user_country($cntryid, $c=null, $codef=null) {
		$db = GetGlobal('db');	
		$currentuser = $this->username;	   
	
		$code = $codef ? $codef : 'code2';
		$sSQL = "update users set cntryid='$cntryid'";
		if ($c)
			$sSQL .= " WHERE " . $code."=" . $c;
		else	
			$sSQL .= " WHERE USERNAME ='" . $currentuser . "'";
	   
		$db->Execute($sSQL);
		
		if($db->Affected_Rows()) 
			return true;
		
	    return false;	 		 
	}	
	
	public function username_exist($myusername=null) {
       $db = GetGlobal('db');	
	
	   $sSQL1 = "select USERNAME from users where USERNAME='" . $myusername . "'";
       $res1 = $db->Execute($sSQL1,3);
	   $existed_username = trim($res1->fields[0]);	
	   
	   return ($existed_username);
	}	
	
	public function user_exists($username=null) {
		$db = GetGlobal('db');	
		if (!$username) return false;
	  
		$sSQL = "select username from users";
		$sSQL .= " WHERE username=" . $db->qstr($username);
	   
		$result = $db->Execute($sSQL,2);   	
		$res = $result->fields['username'];	  
	   
		$ret = $res ? true : false;
		return ($ret); 
	}
	
	protected function user_activate() {
	    if ($this->stay_inactive) return false;
	
	    $db = GetGlobal('db');	
		$id = GetReq('sectoken'); //by mail link
		if (!$id) {
		   SetGlobal('sFormErr',localize('_ACTIVATEERR',getlocal()));
		   return false;
		   //return (localize('_ACTIVATEERR',getlocal()));
		} 		 
		 
		$toks = explode('|',base64_decode(urldecode($id)));
		$email = $toks[0];
        $hash = $toks[1];
		$hash2cmp = md5('stereobit9networlds8and7the6heart5breakers');
		//echo '>',strcmp($hash,$hash2cmp);
        if (($this->user_exists($email)) && (strcmp($hash,$hash2cmp)==0)) {		 
		 
			$sSQL = "update users set active=1 where email = '" . $email ."'";
			//echo $sSQL;		 
			$db->Execute($sSQL);
			if($db->Affected_Rows()) {
				
				$this->update_statistics('activation', $email);
		   
				SetGlobal('sFormErr',localize('_ACTIVATEOK',getlocal()));
				return (localize('_ACTIVATEOK',getlocal()));
			}  
			else {
				SetGlobal('sFormErr',localize('_ACTIVATEERR2',getlocal()));			 
				return false;
				//return (localize('_ACTIVATEERR',getlocal()));
			} 

			//reset fails at login (see cmslogin)
			SetSessionParam('failedLogin', null); 	
		}
		 
		return false;
	}	
	
	protected function userActivateForm() {
		if (defined('SHLOGIN_DPC')) { 
			if (defined('SHCART_DPC')) {
			    $carthasvalue = _m("shcart.getcartTotal use 1");
				if ($carthasvalue>0)
			 	    $out .= _m("shlogin.quickform use +viewcart+shcart>cartview+status+1");	 
				else   
				    $out .= _m('shlogin.form use html');
			}
            else 										 
			    $out .= _m('shlogin.form');
		}
		elseif (defined('CMSLOGIN_DPC')) { 
		    if (defined('SHCART_DPC')) {
			    $carthasvalue = _m("shcart.getcartTotal use 1");
				if ($carthasvalue>0)
				    $out .= _m("cmslogin.quickform use +viewcart+shcart>cartview+status+1");	 
				else   
				    $out .= _m('cmslogin.form use html');
			}
            else 										 
				$out .= _m('cmslogin.form');
		}
		else
			$out = null;

		return ($out);	
	}
	
    protected function _checkmail($data) {

        $ret = filter_var($data, FILTER_VALIDATE_EMAIL);
		return ($ret);  
	}		
	
	protected function combine_tokens($template_contents,$tokens) {
	
	    if (!is_array($tokens)) return;
		
		if (defined('FRONTHTMLPAGE_DPC')) {
		  $fp = new fronthtmlpage(null);
		  $ret = $fp->process_commands($template_contents);
		  unset ($fp);	  		
		}		  		
		else
		  $ret = $template_contents;
		  
		//echo $ret;
	    foreach ($tokens as $i=>$tok) {
		    $ret = str_replace("$".$i."$",$tok,$ret);
	    }
		//clean unused token marks
		for ($x=$i;$x<20;$x++)
		  $ret = str_replace("$".$x."$",'',$ret);
		return ($ret);
	}		

	public function free() {
	}
};
}
?>