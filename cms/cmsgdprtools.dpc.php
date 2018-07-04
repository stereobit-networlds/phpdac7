<?php
$__DPCSEC['CMSGDPRTOOLS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if (!defined("CMSGDPRTOOLS_DPC")) {
define("CMSGDPRTOOLS_DPC",true);

$__DPC['CMSGDPRTOOLS_DPC'] = 'cmsgdprtools';

$__EVENTS['CMSGDPRTOOLS_DPC'][0]='gdprtools';
$__EVENTS['CMSGDPRTOOLS_DPC'][1]='updgdpr'; 
$__EVENTS['CMSGDPRTOOLS_DPC'][2]='subgdpr'; 
$__EVENTS['CMSGDPRTOOLS_DPC'][3]='gdpron'; 
$__EVENTS['CMSGDPRTOOLS_DPC'][4]='gdproff'; 
$__EVENTS['CMSGDPRTOOLS_DPC'][5]='gdprdel'; 
$__EVENTS['CMSGDPRTOOLS_DPC'][6]='gdprget';

$__ACTIONS['CMSGDPRTOOLS_DPC'][0]='gdprtools';
$__ACTIONS['CMSGDPRTOOLS_DPC'][1]='updgdpr'; 
$__ACTIONS['CMSGDPRTOOLS_DPC'][2]='subgdpr'; 
$__ACTIONS['CMSGDPRTOOLS_DPC'][3]='gdpron'; 
$__ACTIONS['CMSGDPRTOOLS_DPC'][4]='gdproff'; 
$__ACTIONS['CMSGDPRTOOLS_DPC'][5]='gdprdel';
$__ACTIONS['CMSGDPRTOOLS_DPC'][6]='gdprget';

$__LOCALE['CMSGDPRTOOLS_DPC'][0]='CMSGDPRTOOLS_DPC;GDPR Tools;GDPR Tools';
$__LOCALE['CMSGDPRTOOLS_DPC'][1]='_ULISTS;Newsletter;Newsletter';
$__LOCALE['CMSGDPRTOOLS_DPC'][2]='_GDPR;GDPR Regulation;GDPR Regulation';
$__LOCALE['CMSGDPRTOOLS_DPC'][3]='_userupdate;Data updated;Επιτυχής καταχώρηση';
$__LOCALE['CMSGDPRTOOLS_DPC'][4]='_userupdateerr;Data ΝΟΤ updated;Πρόβλημα καταχώρησης';
$__LOCALE['CMSGDPRTOOLS_DPC'][5]='_subon;Subscription enabled;Ενεργοποίηση συνδρομητή';
$__LOCALE['CMSGDPRTOOLS_DPC'][6]='_suboff;Subscription disabled;Απενεργοποίηση συνδρομητή';
$__LOCALE['CMSGDPRTOOLS_DPC'][7]='_UDELETE;Delete my account;Διαγραφή στοιχείων λογαριασμού';
$__LOCALE['CMSGDPRTOOLS_DPC'][8]='_userdelete;Delete;Διαγραφή';
$__LOCALE['CMSGDPRTOOLS_DPC'][9]='_userupdated;Data updated;Τα στοιχεία ενημερώθηκαν';
$__LOCALE['CMSGDPRTOOLS_DPC'][10]='_userdeleted;Data deleted;Τα στοιχεία διαγράφηκαν';
$__LOCALE['CMSGDPRTOOLS_DPC'][11]='_GDPRFORM;Approve form;Αποδοχή χρήσης στοιχείων';
$__LOCALE['CMSGDPRTOOLS_DPC'][12]='_APPROVEFORM;Press here;Φόρμα αποδοχής';
$__LOCALE['CMSGDPRTOOLS_DPC'][13]='_GDPRGET;Download your data;Μεταφορά - Αποθήκευση στοιχείων λογαριασμού';
$__LOCALE['CMSGDPRTOOLS_DPC'][14]='_GETDATA;Press here;Αποθήκευση';
$__LOCALE['CMSGDPRTOOLS_DPC'][15]='_GETDATEAPPROVE;Approval date;Ημερομηνία αποδοχής';
$__LOCALE['CMSGDPRTOOLS_DPC'][16]='_NOTAPPROVED;Not approved;Δεν έχει γίνει αποδοχή';


//$__PARSECOM['CMSGDPRTOOLS_DPC']['quickform']='_QUICKSHSUBSCRIBE_';
require_once(_r('cms/cmssubscribe.dpc.php'));
require_once(_r('filesystem/downloadfile.lib.php'));

class cmsgdprtools extends cmssubscribe {
	
    var $userLevelID, $user, $activeUser;
	var $prpath;

	public function __construct() {
	
		parent::__construct();
	  
		$this->title = localize('CMSGDPRTOOLS_DPC',getlocal());	
		
		$UserName = GetGlobal('UserName');
		$UserSecID = GetGlobal('UserSecID');	
		$this->userLevelID = (((decode($UserSecID))) ? (decode($UserSecID)) : 0);		
		$this->user = $UserName ? decode($UserName) : null;	  
		
		$aUser = GetParam('actuser'); //md5ed - security !!!
		$this->activeUser = $this->user;// ? $this->user : $aUser;
	    $this->prpath = paramload('SHELL','prpath');
	}
	
    public function event($event) {	
  
	    switch ($event) {
			case 'gdprget'         :  $file = $this->getUserData('customers', 'code2'); 
									  //if ($this->instDownload) 
										  die($file);		
									  break;
									  
	        case 'gdprdel'         :  if ($this->delUser()==true) {
										if ((defined('CMSLOGIN_DPC')) && ($this->user)) {
											if (_m('cmslogin.is_fb_logged_in')) 
												_m('cmslogin.do_facebook_logout');
											else 
												_m('cmslogin.do_logout');
										}
									  }
									  $this->jsBrowser();
									  break;			 
		 
	        case 'gdpron'          :  if ($m = GetParam('submail')) 
										$this->dosubscribe($m); 
									
									  $this->jsBrowser();
									  break;											
									  
	        case 'gdproff'         :  if ($m = GetParam('submail')) 
										$this->dounsubscribe($m);

									  $this->jsBrowser();		
									  break;		  
			
			case 'subgdpr'		   :  $this->subUser();
									  $this->jsBrowser();
									  break;
									  
			case 'updgdpr'         :  $this->updUser();
									  $this->jsBrowser();
									  break;
			case 'gdprtools'       :	
			default                :  $this->jsBrowser();
        }
    }	

    public function action($action)  { 

		 switch ($action) {
			case 'gdprget'         :
			 
	        case 'gdprdel'         :
			
	        case 'gdpron'          : 										
	        case 'gdproff'         : 
			case 'subgdpr'         :
			case 'updgdpr'         :			
			case 'gdprtools'       :	
	        default 			   :  //$f = (GetParam('FormAction')) ? GetParam('FormAction') : (GetReq('t') ? GetReq('t') : null);
			                          $out = $this->form($action); 
         }
		 
	     return ($out);
	}
	
	//called by shusers.dologin
	protected function jsBrowser() {		
		   
		if ($code = $this->jsStatus()) {
			$js = new jscript;	
			$js->load_js($code,null,1);		
			unset ($js);
		}
	}	
	
	//cart view
	protected function jsStatus() {
		$mobileDevices = _m('cmsrt.mobileMatchDev');		
		$gotoSection = 'gdpr-page'; 
		$urlstr = "&id=" . $gotoSection;
		
		$code.= "
$(document).ready(function () {
	if (/{$mobileDevices}/i.test(navigator.userAgent)) 
		window.scrollTo(0,parseInt($('#$gotoSection').offset().top, 10));
	else {		
		gotoTop('$gotoSection');	
	
		$(window).scroll(function() { 
			if (agentDiv('$gotoSection')) {
				$.ajax({ url: 'jsdialog.php?t=jsdcode{$urlstr}&div=$gotoSection', cache: false, success: function(jsdialog){
					eval(jsdialog);		
				}})	
			}
			else if (agentDiv('cart-page')) { /* !!! */
				$.ajax({ url: 'jsdialog.php?t=jsdcode{$urlstr}&div=cart-page', cache: false, success: function(jsdialog){
					eval(jsdialog);		
				}})	
			}	
		});	
	}		
});	
";

		return ($code);
	}

	public function jsDialog($text=null, $title=null, $time=null, $source=null) {
	   $stay = $time ? $time : 6000;//2000;
	   
       if (defined('JSDIALOGSTREAM_DPC')) {
	   
			if ($text)	
				$code = _m("jsdialogstream.say use $text+$title+$source+$stay");
			else
				$code = _m('jsdialogstream.streamDialog use jsdtime');
		   
			$js = new jscript;	
			$js->load_js($code,null,1);		
			unset ($js);
	   }	
	}	

	//override
    protected function form($action=null)  { 	
        
		//if (!$this->user) {//not logged in user / ulist user
			switch ($action) {	   
				case 'gdproff' : $stemplate= "unsubscribe-gdpr"; break;
				case 'gdpron'  : $stemplate= "subscribe-gdpr"; break;
				default 	   : if (!$this->user) //no logged in
									$stemplate= "unsubscribe-gdpr";
			}
		
			if ($stemplate) {
				//echo '-' . $stemplate;
				$tokens = array();		
				$tokens[] = $this->msg;		 
				$tokens[] = $this->strcrypt($this->activeUser);
				$out = _m("cmsrt._ct use $stemplate+" . serialize($tokens));
			}
        //}
		
		//registred users NOT this->activeUser
		$out.= $this->gdprRegister($this->user,'username',null,'updategdpr');
		
        return ($out);
    }
	
	/* user reg data - shusers register() cpy */
	protected function gdprRegister($myuser=null,$myfkey=null,$selectid=null,$cmd=null) {
		if (defined('SHUSERS_DPC')) //check first adapter
			$usrv = 'shusers';
		elseif (defined('CMSUSERS_DPC')) //second adapter
			$usrv = 'cmsusers';
		else
			return false; //back	
		
		$UserName = GetGlobal('UserName');
        $user = decode($UserName);
	    $sFormErr = GetGlobal('sFormErr');
	    $a = GetReq($selectid) ? GetReq($selectid) : GetReq('a');
	    $mycmd_update = $cmd ? $cmd : 'update';	   

        if ($sFormErr=="ok") {

			SetGlobal('sFormErr',"");

			$myaction = GetGlobal('controller')->getqueue(); //echo $myaction,"<><><><";
			switch ($myaction) {

				case "gdprdel"  :  $out = localize('_userdeleted', $this->lan); break;
				case "gdproff"  :  $out = localize('_userdeleted', $this->lan); break;
				case "gdpron"   :  $out = localize('_userupdated', $this->lan); break;
				case "subgdpr"  :  $out = localize('_userupdated', $this->lan); break;
				case "updgdpr"  :  $out = localize('_userupdated', $this->lan); break;
				default 		:  $out = localize('_userupdated', $this->lan); break;
			}
			
			//cms+ text
			$tokens = array();
			$out .= _m("cmsrt.ct use gdpr-" . $myaction, $tokens, true);
	    }
	    else {
			
			if (_m("$usrv.username_exist use $myuser")) {

				//if ($myuser)
					$record = $this->getUser($myuser,$myfkey,null,1);
					//$record = _m("$usrv.getuser use $myuser+$myfkey++1");
				//else				 
					//$record = $this->getUser(null,null,null,1);
					//$record = _m("$usrv.getuser use +++1");
				   
	            $out .= $this->regform($record,$mycmd_update,1,null,1,1,1); //update action
				//$out .= _m("$usrv.regform use $record+$mycmd_update+1");//++0+0+");
				//echo 'z',$record;
				
				//VIEW CUSTOMER LISTS (must logged in)
				if ((defined('SHCUSTOMERS_DPC')) && ($this->user)) {
					$out .= _m('shcustomers.show_customers_list');
					$out .= '<br/><br/><br/>';		
					$out .= _m('shcustomers.show_customer_delivery');
				}	
		   }	   
	   }

	   return ($out);
	}

    protected function regform($fields='',$cmd=null,$isupdate=null,$isadmin=null,$nodelivery=null,$noinvtype=null,$noincludecusform=null) {
		$UserName = GetGlobal('UserName');
		$sFormErr = GetGlobal('sFormErr');
		$myinvtype = GetParam('invtype');
		if ($isupdate)	
			$readonly = 'READONLY';	   
	    /*
		if (isset($noinvtype))//no for update
			$invtype = '0';
		else {
			$invtype = _m('shcustomers.get_invoice_type');
			$invtypedescr = _m('shcustomers.get_invoice_type_descr');
		}	 
		 
		if (isset($nodelivery))//no for update
			$delivery = '0';
		else	 	   
			$delivery = _m('shcustomers.get_delivery_address');	 
		
		//ger req when error	
		$myinvoice = isset($myinvtype) ? $myinvtype : ($invtype ? $invtype : '0');  
		//echo $myinvoice,'?',$myinvtype,'>',$invtype,'>',$delivery;

		$_t = ($isupdate) ? 'usrupdate' . $delivery . $myinvoice : 
							'usrregister' . $delivery . $myinvoice;	   
		*/					
		$_t = 'usrupdate-gdpr'; //!!!!	
		$mytemplate = _m('cmsrt.select_template use ' . $_t);
	    //echo $_t;
		
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

		//$sFileName = seturl("t=signup&a=$a&g=$g&invtype=".$myinvtype,0,1);
		$sFileName = seturl("t=signup&invtype=".$myinvtype,0,1);

        $tokens[] = localize('_FORMWARN',getlocal()) . '<br>' . $sFormErr . "<form method=\"POST\" action=\"" .$sFileName. "\" name=\"Registration\">";	   
	    $tokens[] = "<input type=\"text\" class=\"myf_input\" name=\"fname\" maxlength=\"50\" value=\"" . ToHTML($fname) . "\" size=\"30\" >";
	    $tokens[] = "<input type=\"text\" class=\"myf_input\" name=\"lname\" maxlength=\"50\" value=\"" . ToHTML($lname) . "\" size=\"30\" >";
	    $tokens[] =  ($this->usemailasusername)  ? "<input type=\"text\" class=\"myf_input\" name=\"uname\" maxlength=\"55\" value=\"" . ToHTML($uname) . "\" size=\"25\" $readonly>" :
		 										   "<input type=\"text\" class=\"myf_input\" name=\"uname\" maxlength=\"50\" value=\"" . ToHTML($uname) . "\" size=\"15\" $readonly>";
	    $tokens[] = "<input type=\"password\" class=\"myf_input\" name=\"pwd\" maxlength=\"50\" value=\"" . ToHTML($pwd) . "\" size=\"15\" >";
	    $tokens[] = "<input type=\"password\" class=\"myf_input\" name=\"pwd2\" maxlength=\"50\" value=\"" . ToHTML($pwd2) . "\" size=\"15\" >";
	    //!!!
        //if (!$this->usemailasusername) 
	      //  $tokens[] = "<input type=\"text\" class=\"myf_input\" name=\"eml\" maxlength=\"55\" value=\"" . ToHTML($eml) . "\" size=\"25\" >";
	   
	   
	    //INCLUDE CUSTOMER DATA TO MIX IN ONE FORM..SQL EXECUTE USER AND CUS QUERY... 
        if (($this->includecusform) && (!$noincludecusform)) {
			$custokens = _m('shcustomers.makesubform');	
			foreach ($custokens as $t)	 
				$tokens[] = $t;    
	    }	   

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

		//if (defined('CMSSUBSCRIBE_DPC')) {
			//check if user is in sub list
			//if (_m('cmssubscribe.isin use '.$eml))  
			if ($this->isin($eml))	
				$statin = 'checked';

			$tokens[] = "<input type=\"checkbox\" class=\"myf_checkbox\" name=\"autosub\"". $statin . ">";      
	    //}

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
		//if ($isupdate) { 
		    $tokens[] = $fname;
		    $tokens[] = $lname;
			$tokens[] = $statin; //subscription
		//}
		//else
		  //  $tokens[] = $invtypedescr;//$myinvtype ? 'B' : 'A'; /*inv type title*
		
		//print_r($tokens);					
		$ret = $this->combine_tokens($mytemplate,$tokens);

		return ($ret);			  
	}
	
    protected function getUser($id="",$fkey=null,$isadmin=null,$isupdate=null) {
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
		}
		else {//????
			if ((!$a) || (!seclevel('USERSMNG_',$this->userLevelID))) { //unique selection
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

		$cr = !empty($result->fields) ? count($result->fields) : 0;
		if ($cr > 1) {//check result...
			foreach ($result->fields as $i=>$rec) {
				if (is_numeric($i)) {
					$record[] = $rec;
				}
			}  
			$ret = implode(";",$record); //echo $record;		   
	   }	 
  
	   return ($ret);
	}

	/* update user */
	protected function updUser($id=null) {
		$db = GetGlobal('db');
		$UserName = GetGlobal('UserName');
		$sFormErr = GetGlobal('sFormErr');
		if (defined('SHUSERS_DPC')) //check first adapter
			$adapter = 'shusers';
		elseif (defined('CMSUSERS_DPC')) //second adapter
			$adapter = 'cmsusers';
		else
			return false; //back		

		$rec = $id ? $id : GetParam('rec');
		$a = GetReq('a');
		$g = GetReq('g');
		
		$currentuser = $this->activeUser; //decode($UserName);

		//if (!$err = $this->checkFields(true,$this->checkuseasterisk)) {		
		$checka = _v("$adapter.checkuseasterisk");
		if (!$err = _m("$adapter.checkFields use 1+$checka")) {		

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

				$this->update_statistics('updatedata', $currentuser);
			
				SetGlobal('sFormErr',"ok");
				$this->jsDialog(localize('_userupdate', $this->lan), localize('_GDPR', $this->lan));
				return true;
			}	
			else {
				SetGlobal('sFormErr',localize('_MSG18',getlocal()));
				$this->jsDialog(localize('_userupdateerr', $this->lan), localize('_GDPR', $this->lan));
			}	
		
		}
		return false;
	}	
	
	/* logged in user, ulists on - off */
	protected function subUser() {
		$email = $this->activeUser;	
		
		$subonoff = trim(GetParam('autosub'));
			$this->dosubscribe($email,false);
		//echo $email,'>z>'.$subonoff.'>';
		
		$ret = (strlen($subonoff) > 0) ?
				$this->dosubscribe($email,false) :
				$this->dounsubscribe($email,false);		

		$subonofftext = (strlen($subonoff) > 0) ?
						localize('_subon', $this->lan) :
						localize('_suboff', $this->lan);
		
		$this->jsDialog($subonofftext, localize('_GDPR', $this->lan));	
		SetGlobal('sFormErr',"ok");		
		return true;
	}
	
	//override, gdpr=1
	public function dosubscribe($mail=null,$bypasscheck=null,$telltouser=null) {
		$db = GetGlobal('db');
		$name = $name ? $name : 'unknown';
		$dlist = 'default';		
		$mail_tell_user = isset($telltouser) ? $telltouser : $this->tell_user;	
		$mail = $mail ? $mail : GetParam('submail');	 
		if (!$mail) return;	   
	   
		$dtime = date('Y-m-d h:i:s');	   	
	   
		if ($this->checkmail($mail))  {
			
			$tokens[] = $mail;	
			$mailbody = _m('cmsrt._ct use subinsert+' . serialize($tokens));			

			$sSQL = "SELECT email FROM ulists where email=". $db->qstr($mail) . " and listname='$dlist'"; 
		  
			$ret = $db->Execute($sSQL,2);
			$mymail = $ret->fields['email'];
		  
			if ($mymail==$mail) {//is in db but already enabled or disabled  re-enable subscription
				$sSQL = "update ulists set active=1, gdpr=1 where listname='$dlist' and email=" . $db->qstr(strtolower($mail));  
				$db->Execute($sSQL,1);
				
				//echo $sSQL;		
				if (!$bypasscheck)    
					//$this->msg =  localize('_MSG6',getlocal());			 
					//cms+ text
					$this->msg = _m("cmsrt.ct use gdpr-gdpron", array(), true);
		    
				 
				if ($this->tell_it) {//tell to me
					//$this->mailto($this->tell_from,$this->tell_it,$this->subject,$mailbody);
					$body = str_replace('+','<SYN/>',$mailbody); //_v("cmsrt.mbody use $mailbody");
					$mailerr = _m("cmsrt.cmsMail use {$this->tell_from}+{$this->tell_it}+{$this->subject}+$body");
				}	
				 			     							  
				//tell to subscriber
				if ($mail_tell_user>0) {	   
					//$this->mailto($this->tell_from,$mail,$this->subject,$mailbody);	 
					$body = str_replace('+','<SYN/>',$mailbody); //_v("cmsrt.mbody use $mailbody");
					$mailerr = _m("cmsrt.cmsMail use {$this->tell_from}+$mail+{$this->subject}+$body");
				}	
		  }		  
          else {
				$sSQL = "insert into ulists (email,startdate,active,gdpr,lid,listname,name,owner) " .
						"values (" .
						$db->qstr(strtolower($mail)) . "," . $db->qstr($dtime) . "," .
						"1,1,1,'$dlist'," . $db->qstr($name) . ",". $db->qstr($this->owner). ")";   			   
				$db->Execute($sSQL,1);	
			   
				if (!$bypasscheck)	    
					$this->msg = localize('_MSG6',getlocal());	
				 
				//echo $sSQL;
				if ($this->tell_it) {//tell to me
					//$this->mailto($this->tell_from,$this->tell_it,$this->subject,$mailbody);
					$body = str_replace('+','<SYN/>',$mailbody); //_v("cmsrt.mbody use $mailbody");
					$mailerr = _m("cmsrt.cmsMail use {$this->tell_from}+{$this->tell_it}+{$this->subject}+$body");
				}	
				 			     							  
				//tell to subscriber	   
				//$this->mailto($this->tell_from,$mail,$this->subject,$mailbody);	 	 	 
				$body = str_replace('+','<SYN/>',$mailbody); //_v("cmsrt.mbody use $mailbody");
				$mailerr = _m("cmsrt.cmsMail use {$this->tell_from}+$mail+{$this->subject}+$body");
		  }
		  
		  $this->update_statistics('subscribe', $mail);
	   }
	   else {
			if (!$bypasscheck)
				$this->msg = localize('_MSG5',getlocal());		   	 
	   }	   
	}
	
	//override, gdpr=0
	public function dounsubscribe($mail=null,$telltouser=null) {
		$db = GetGlobal('db');	
		$mail_tell_user = isset($telltouser) ? $telltouser : $this->tell_user;
		$ulistname = GetParam('ulistname') ? GetParam('ulistname') : 'default';	    
		$mail = $mail ? $mail : GetParam('submail'); 
		if (!$mail) return;		   
	   
		if ($this->checkmail($mail))  {

			$tokens[] = $mail;	
			$mailbody = _m('cmsrt._ct use subdelete+' . serialize($tokens));			   

			//disable from ulists
			//if ($this->isin_ulists($mail, $ulistname)) { //!!!!!!!!!!!!!!!! not a known list name
			$sSQL = "update ulists set active=0, gdpr=0 where email=" . $db->qstr($mail);
			//$sSQL .= ' and listname=' . $db->qstr($ulistname);  //from all the lists !!!!!(nwsletter have to include the list while unsub)
			$result = $db->Execute($sSQL,1);
            //echo $sSQL;
			//$this->msg = localize('_MSG8',getlocal());
			//cms+ text
			$this->msg = _m("cmsrt.ct use gdpr-gdproff", array(), true);
		    
			if ($this->tell_it) {//tell to me
				//$this->mailto($this->tell_from,$this->tell_it,$this->subject2,$mailbody);
				$body = str_replace('+','<SYN/>',$mailbody); //_v("cmsrt.mbody use $mailbody");
				$mailerr = _m("cmsrt.cmsMail use {$this->tell_from}+{$this->tell_it}+{$this->subject2}+$body");
			}	
				 			     							  
			//tell to subscriber   
			if ($mail_tell_user>0) { 			 
				//$this->mailto($this->tell_from,$mail,$this->subject2,$mailbody);	 	  
				$body = str_replace('+','<SYN/>',$mailbody); //_v("cmsrt.mbody use $mailbody");
				$mailerr = _m("cmsrt.cmsMail use {$this->tell_from}+$mail+{$this->subject2}+$body");		
			}		
			
			$this->update_statistics('unsubscribe', $mail);
		  //}  
		}
		else 
			$this->msg = localize('_MSG5',getlocal());	  
	}	
	
	/* delete user */
	protected function delUser($id=null) {
		$db = GetGlobal('db');
		$UserName = GetGlobal('UserName');
		$sFormErr = GetGlobal('sFormErr');
		
		$currentuser = $this->activeUser;	
		
		$sSQL = "DELETE from ulists where email=" . $db->qstr($currentuser);
		//echo $sSQL;
		//$db->Execute($sSQL,1); //!!!
		$sSQL = "DELETE from custaddress where ccode=" . $db->qstr($currentuser);
		//echo $sSQL;
		//$db->Execute($sSQL,1); //!!!
		$sSQL = "DELETE from customers where code2=" . $db->qstr($currentuser);
		//echo $sSQL;
		//$db->Execute($sSQL,1); //!!!
		$sSQL = "DELETE from users where username=" . $db->qstr($currentuser);
		//echo $sSQL;
		//$db->Execute($sSQL,1); //!!!		
			
		if($db->Affected_Rows()) {

			$this->update_statistics('deletedata', $currentuser);
			
			SetGlobal('sFormErr',"ok");
			$this->jsDialog(localize('_userdelete', $this->lan), localize('_GDPR', $this->lan));
			return true;
		}	
		else {
			SetGlobal('sFormErr',localize('_MSG18',getlocal()));
			$this->jsDialog(localize('_userupdateerr', $this->lan), localize('_GDPR', $this->lan));
		}

		return false;		
	}	
	
	/* create and dnload data file */
    protected function getUserData($table=null, $recid=null) {
		$db = GetGlobal('db');  
		$d = date('Ymd-Hi');
	    $meter = 0;
		$m = 0;
		$zname = $d . '-' . md5($this->user) . '.zip';
		if (!$table) return false;
		
  	    $zip = new ZipArchive();		
		$zfilename = $this->prpath . "/uploads/" . $zname; //to save into
         
		if ($zip->open($zfilename, ZipArchive::CREATE)!==TRUE) {
		    echo 'Zip error!';
			return false;
        }				
		else {					  
			$tables = array('customers'=>'code2', 'custaddress'=>'ccode');
			foreach ($tables as $table=>$recid) {
			
				$ztablename = $this->prpath . "/uploads/" . $zname.'-'.$table . '.csv';		
            
				$result = $db->Execute("SELECT * FROM $table where $recid =" . $db->qstr($this->user));
				if ($result) {	
			
					$fh = fopen($ztablename, 'w');
			  
					// Now UTF-8 - Add byte order mark / UTF8 BOM
					//if (($this->encoding=='utf-8') || ($this->encoding=='utf8'))
					fwrite($fh, pack("CCC",0xef,0xbb,0xbf)); 
			         
					foreach ($result as $r=>$rec) {
						for($i = 0; $i < count($rec); $i++) {
							fwrite($fh, $rec[$i] . ';');
						}                                                                 
						fwrite($fh, PHP_EOL);//"\n");
					}
					@fclose($fh);	
			  
					$zip->addFile($ztablename, md5($table) . '.csv');
				}	
			}
						 
			if ($zip->close()) { //erase csv files
				reset($tables);				
				foreach ($tables as $table=>$recid) { 
					$zippedtablename = $this->prpath . "/uploads/" . $zname.'-'.$table . '.csv';
					@unlink($zippedtablename); 
				}
			}	
			
			$this->download($zfilename);
		}	
    }

	protected function download($file) {
		
		// clean the output buffer
		ob_clean();
		
		if (file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($file).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			readfile($file);
			exit;
		}			
	}	
	
	public function ApprovalLink() {
		if (!$this->user) {
			// subscribe
			$umail = GetParam('submail');
			return $umail ? "tools/gdpron/$umail/" : 'tools/gdpron/';
		}	
		
		//edit customer form
		return 'editcus/' . _m('shcustomers.get_cus_id') .'/';
	}
	
	public function ApprovalDate() {
		if (!$this->user) {
			//is ulist mail
			if ($umail = GetParam('submail')) 
				$apdate = $this->get_ulist_lastupdate($umail);
			
			return $apdate ? localize('_GETDATEAPPROVE', getlocal()) . ' :' . $apdate : 
							 localize('_NOTAPPROVED', getlocal());
		}	
		
		//logged in customer
		if ($apdate = _m("shusers.get_cus_lastupdate"))
			return localize('_GETDATEAPPROVE', getlocal()) . ' :' . $apdate;
		
		return localize('_NOTAPPROVED', getlocal());
	}
	
	public function get_ulist_lastupdate($umail=null) {
		$db = GetGlobal('db');
		if (!$umail) return null;
		
		$sSQL = "select max(datein) from ulists where active=1 and email=" . $db->qstr($umail);
		//echo $sSQL;
		$res = $db->Execute($sSQL,1);
		return $res->fields[0];
	}
	
	protected function strcrypt($str=null) {
		if (!$str) return null;
		$cstr = null;
		
		for ($i=0;$i<strlen($str);$i++)
			$cstr .= (($i>1) && ($i<strlen($str)-1) && ($str[$i]!='@')) ?
					'*' : $str[$i];
		
		return $cstr;
	}
	
	protected function checkmail($mail=null) {
		$valid = filter_var($mail, FILTER_VALIDATE_EMAIL);
		return ($valid);		
	}

	protected function update_statistics($id, $user=null) {
        if (defined('CMSVSTATS_DPC'))	
			return _m('cmsvstats.update_event_statistics use '.$id.'+'.$user);			
		
		return false;
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

};
}
?>