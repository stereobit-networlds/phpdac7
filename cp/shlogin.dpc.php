<?php
$__DPCSEC['SHLOGIN_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("SHLOGIN_DPC")) && (seclevel('SHLOGIN_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("SHLOGIN_DPC",true);

$__DPC['SHLOGIN_DPC'] = 'shlogin';

require_once(_r('libs/scaptcha.lib.php'));

$__EVENTS['SHLOGIN_DPC'][0]='shlogin';
$__EVENTS['SHLOGIN_DPC'][1]='dologin';
$__EVENTS['SHLOGIN_DPC'][2]='dologout';
$__EVENTS['SHLOGIN_DPC'][3]='rempwd';
$__EVENTS['SHLOGIN_DPC'][4]='shremember';
$__EVENTS['SHLOGIN_DPC'][5]='shcaptcha';
$__EVENTS['SHLOGIN_DPC'][6]='chpass';
$__EVENTS['SHLOGIN_DPC'][7]='shrememberajax';
$__EVENTS['SHLOGIN_DPC'][8]='chpassajax';
$__EVENTS['SHLOGIN_DPC'][9]='dologinajax';

$__ACTIONS['SHLOGIN_DPC'][0]='shlogin';
$__ACTIONS['SHLOGIN_DPC'][1]='dologin';
$__ACTIONS['SHLOGIN_DPC'][2]='dologout';
$__ACTIONS['SHLOGIN_DPC'][3]='rempwd';
$__ACTIONS['SHLOGIN_DPC'][4]='shremember';
$__ACTIONS['SHLOGIN_DPC'][5]='shcaptcha';
$__ACTIONS['SHLOGIN_DPC'][6]='chpass';
$__ACTIONS['SHLOGIN_DPC'][7]='shrememberajax';
$__ACTIONS['SHLOGIN_DPC'][8]='chpassajax';
$__ACTIONS['SHLOGIN_DPC'][9]='dologinajax';

$__DPCATTR['SHLOGIN_DPC']['shlogin'] = 'shlogin,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['SHLOGIN_DPC'][0]='SHLOGIN_DPC;Login;Εισαγωγή';
$__LOCALE['SHLOGIN_DPC'][1]='_SHLOGOUT;Logout;Αποσύνδεση';
$__LOCALE['SHLOGIN_DPC'][2]='SHLOGIN_CNF;Logout;Αποσύνδεση';
$__LOCALE['SHLOGIN_DPC'][3]='SHLOGIN_UNK;Login;Εισαγωγή';
$__LOCALE['SHLOGIN_DPC'][4]='_USERNAME;Username;Χρήστης';
$__LOCALE['SHLOGIN_DPC'][5]='_PASSWORD;Password;Κωδικός';
$__LOCALE['SHLOGIN_DPC'][6]='_WELLCOME;Welcome;Καλωσήρθες';
$__LOCALE['SHLOGIN_DPC'][7]='_SEEYOU;See you next time;Τα λέμε';
$__LOCALE['SHLOGIN_DPC'][8]='_MSG1;Incorrect data!;Λάθος στοιχεία!';
$__LOCALE['SHLOGIN_DPC'][9]='_VERPASS;Verify password;Επαληθευση κωδικου';
$__LOCALE['SHLOGIN_DPC'][10]='_PASSREMINDER;Please change your password!;Παρακαλω αλλαξτε τον κωδικό σας!';
$__LOCALE['SHLOGIN_DPC'][11]='_VERPASSUCCESS;Password changed!;Επιτυχης αλλαγη κωδικου';
$__LOCALE['SHLOGIN_DPC'][12]='_HERE;here;εδώ';
$__LOCALE['SHLOGIN_DPC'][13]="_IFORGET;If you dont remember your password click ;Αν δεν θυμαστε τον κωδικο σας πατηστε";
$__LOCALE['SHLOGIN_DPC'][14]='_PRESSHERE;Click here;Πατήστε εδώ';
$__LOCALE['SHLOGIN_DPC'][15]='_MSG2;Username and Password send at your mail account!;Το όνομα χρήστη και ο κωδικός στάλθηκαν στο ηλεκτρονικό σας ταχυδρομείο!';
$__LOCALE['SHLOGIN_DPC'][16]='_SENDCRE;Username and Password send at your mail account!;Το όνομα χρήστη και ο κωδικός στάλθηκαν στο ηλεκτρονικό σας ταχυδρομείο!';
$__LOCALE['SHLOGIN_DPC'][17]='_UMAILREMSUBC;Account reset;Αλλαγή κωδικού χρήστη';
$__LOCALE['SHLOGIN_DPC'][18]='_OK;Success;Επιτυχης εργασια';
$__LOCALE['SHLOGIN_DPC'][19]='_OKREMINDER;Your account details has been send by e-mail.;Τα στοιχεία του λογαριασμού σας σταλθηκσν με e-mail.';
$__LOCALE['SHLOGIN_DPC'][20]='_RESET;Reset;Αλλαγή';
$__LOCALE['SHLOGIN_DPC'][21]='_RESETPASS;Reset password;Αλλαγή κωδικού';
$__LOCALE['SHLOGIN_DPC'][22]="_MSG21;Password and verify password doesn't match!;Η επιβαιβαιωση κωδικου δεν συμφωνει με τον κωδικο σας.";
$__LOCALE['SHLOGIN_DPC'][23]='_MSGPWD;Invalid password length, 8 characters required;Μη αποδεκτός κωδικός, 8 χαρακτήρες τουλάχιστον είναι απαραίτητοι';
$__LOCALE['SHLOGIN_DPC'][24]='ok;An mail send to you. Follow the instruction in order to complete the process;Ένα email σταλθηκε στον λογαριασμό ηλ. ταχυδρομείου που δηλώσατε. Ακολουθήστε τις οδηγίες για την ολοκληρωση της διαδικασίας';
$__LOCALE['SHLOGIN_DPC'][25]='_ok;Submit;Αποστολή';
$__LOCALE['SHLOGIN_DPC'][26]='ok2;Password changed;Ο κωδικός άλλαξε';
$__LOCALE['SHLOGIN_DPC'][27]='_ERRSECTOKEN;Invalid token;Λάνθασμένο στοιχείο';
$__LOCALE['SHLOGIN_DPC'][28]='_NOTAFFECTED;Record not affected;Δεν έγινε η αλλαγή';
$__LOCALE['SHLOGIN_DPC'][29]='_PLEASETEXT;Please fill out the information bellow and proceed;Παρακαλώ εισάγετε τα στοιχεία που ειναι απαραίτητα για την εισαγωγή στο σύστημα';
$__LOCALE['SHLOGIN_DPC'][30]='_WELCOME2GO;Press here to proceed;Πατήστε εδώ για να συνεχίσετε την περιηγησή σας';
$__LOCALE['SHLOGIN_DPC'][31]='_back;Back;Επιστροφή';

class shlogin {

	var $userLevelID;
	var $msg;
	var $outpoint;
    var $time_of_session;
	var $reseller_attr, $path;
	var $username, $userid;
    var $actcode;
    var $iname, $load_sesssion;
    var $after_goto, $dpc_after_goto,$login_successfull;
	var $login_goto,$logout_goto;  
	var $urlpath, $inpath;
	var $recaptcha_public_key, $recaptcha_private_key, $ssl;	
	
	static $staticpath;

	function shlogin() {
	   $sFormErr = GetGlobal('sFormErr');
	   $UserName = GetGlobal('UserName');
	   $UserSecID = GetGlobal('UserSecID');
	   $UserID = GetGlobal('UserID'); 
	   
	   $this->username = decode($UserName);
	   $this->userid = decode($UserID);
       $this->userLevelID = (((decode($UserSecID))) ? (decode($UserSecID)) : 0);
	   $this->msg = $sFormErr;
	   
	   self::$staticpath = paramload('SHELL','urlpath');

       $this->path = paramload('SHELL','prpath');
	   $this->urlpath = paramload('SHELL','urlpath');
	   $this->inpath = paramload('ID','hostinpath');			 

       $this->must_reenter_password	= null;

	   $this->link = seturl("t=rempwd",localize("_HERE",getlocal()));
	   $this->message = localize("_IFORGET",getlocal());
	   $this->formerror = null;
	   $this->ssl = (isset($_SERVER['HTTPS'])) ? true : false;		   

	   $this->title = localize('SHLOGIN_DPC',getlocal());
       $logintime = remote_paramload('SHLOGIN','logintime',$this->path);
	   $this->time_of_session = $logintime?$logintime:3600;//1 hour is default
	   
	   $this->reseller_attr = remote_paramload('SHLOGIN','reseller',$this->path); //DISABLED
	   
	   $this->accountmailfrom = remote_paramload('SHLOGIN','accountmailfrom',$this->path);

	   $acode = remote_paramload('RCCUSTOMERS','activecode',$this->path);
	   $this->actcode = $acode?$acode:'code2';

	   $this->iname = paramload('ID','instancename');
	   $this->load_session = remote_paramload('SHLOGIN','loadsession',$this->path);

	   $this->after_goto = remote_paramload('SHLOGIN','aftergoto',$this->path);
	   $this->dpc_after_goto = GetSessionParam('afterlogingoto')?GetSessionParam('afterlogingoto'):$this->after_goto;
	   $this->login_successfull = false;
	   
	   $this->logout_goto = remote_paramload('SHLOGIN','logout_goto',$this->path);
	   $this->login_goto = remote_paramload('SHLOGIN','login_goto',$this->path);	
	   
	   $this->recaptcha_public_key = remote_paramload('RECAPTCHA','pubkey',$this->path);							  
	   $this->recaptcha_private_key = remote_paramload('RECAPTCHA','privkey',$this->path);	      
	   		   
	}

    function event($sAction) {
		$__USERAGENT = GetGlobal('__USERAGENT');
		$UserName = GetGlobal('UserName');
		$param1 = GetGlobal('param1');
		$param2 = GetGlobal('param2');
	   
        switch($sAction)   {
		    case 'rempwd'        : break;
			case 'shrememberajax':
		    case 'shremember'    : $this->do_the_job(); 
			                       break;
		    case 'shcaptcha'     : $this->do_the_captcha(); break;
            case 'shlogin'       : break;

			case "dologinajax"   :
            case "dologin"       :  
			               switch ($__USERAGENT) {
	                          case 'HTML' :  $this->login_successfull = $this->do_login();
                                             if (($this->login_goto)&& ($this->login_successfull)) {
							                    if (!$this->dpc_after_goto)// inside code command
			                                      $this->refresh_page_js($this->login_goto);	
											 }	
																		  
							                 if (defined('UONLINE_DPC'))
											   GetGlobal('controller')->calldpc_method('uonline.isOnline');
											 break;
	                          case 'XML'  :
	                          case 'GTK'  :
							  case 'XUL'  :
		                      case 'CLI'  :
	                          case 'TEXT' :  $this->do_login($param1,$param2);
							                 break;
						   }
						   //reset database connection
						   $db = null;
                           break;

            case "dologout":  
			                switch ($__USERAGENT) {
	                          case 'HTML' : if (defined('UONLINE_DPC'))
    	                                      GetGlobal('controller')->calldpc_method('uonline.isOffline');
											  
                                            $this->do_logout();
											
                                            if ($this->logout_goto)
			                                  $this->refresh_page_js($this->logout_goto); 											
                                            break;
	                          case 'XML'  :
	                          case 'GTK'  :
							  case 'XUL'  :
		                      case 'CLI'  :
	                          case 'TEXT' : $this->do_logout();
							                break;
						   }
                           break;
			
             case "chpassajax" :			
			 case "chpass"     : $this->do_reenter_pasword(); 
			                     break;
							 					 
        }
	}

    function action($action=null)  {
	    $__USERAGENT = GetGlobal('__USERAGENT');
	    $sFormErr = GetGlobal('sFormErr');

        switch($action)   {
		
			case 'shrememberajax':if ($this->formerror!=localize("ok",getlocal()))
			                        die($this->formerror);
								  else
								    die(localize('_OKREMINDER', getlocal()));
			                      break;
								  
		    case 'rempwd'        :
		    case 'shremember'    :if ($this->formerror!=localize("ok",getlocal())) 
									$out .= $this->html_remform();	  
								  else //login
									$out = $this->html_form();
								  break;
								  
		    case 'shcaptcha'   : $out .= $this->show_the_captcha(); break;
            case "shlogin"     : $out = $this->form(); break;

			case "dologinajax" : $gurl = $_POST['FormGoto'] ? $_POST['FormGoto'] : $this->login_goto;
			                     $goto = $gurl ? '<a href="'.$gurl.'">'.localize('_WELCOME2GO',getlocal()).'</a>' : null;
			                     die(localize('_WELLCOME',getlocal()) . ' ' . $goto); 
								 break;
								 
            case "dologin"     : //goto after login with ses param
								 if (($this->dpc_after_goto) && ($this->login_successfull)) {
									//echo $this->dpc_after_goto,'>';
									$mydpc = explode('.',$this->dpc_after_goto);//check security
									$mydpcname = strtoupper($mydpc[0]).'_DPC';				 
									if (seclevel($mydpcname,$this->userLevelID)) 
										$out .= GetGlobal('controller')->calldpc_method($this->dpc_after_goto);
									else
										$out .= $this->form();//default action  
									$this->dpc_after_goto = null;
									SetSessionParam('afterlogingoto','');
								 }
								 else 
									$out = $this->form(); 

								break;

            case "dologout"    : $out = $this->form(); 
			                     break;
			
		    case "chpass"      : $out = $this->html_reset_pass();
			                     break;
							
			case "chpassajax"  : die($this->formerror); 
			                     break;				
		}

		return ($out);
	}	
	
    protected function refresh_page_js($goto) {
   
		if (iniload('JAVASCRIPT')) {

	       $code = $this->javascript($goto);
	   
		   $js = new jscript;
           $js->load_js($code,"",1);			   
		   unset ($js);
		}   
    }   
   
    //after login/logout goto...
    protected function javascript($goto) {
		$ret = "
function neu(){	top.frames.location.href = \"$goto\"} window.setTimeout(\"neu()\",10);
"; 
		return ($ret);
    }   	

	public function html_form() {
	    $sFormErr = GetGlobal('sFormErr');
	    $UserID = GetGlobal('UserID');
        $logonurl = _m('cmsrt.seturl use t=dologin'); 	
		 
		if ($UserID) {
			
			$tokens[] = _m('cmsrt.seturl use t=dologout'); 
			$tokens[] = localize('_SHLOGOUT',getlocal());

			$ret = _m('cmsrt._ct use logout+' . serialize($tokens));
	 	
		    return ($ret);
		}	 
		
	    if (($sFormErr=='ok')||($sFormErr=='Ok')||($sFormErr=='OK')||($sFormErr=='OKREMINDER')) 
  		    $tokens[] = (stristr($sFormErr,'ok')) ? localize('_OK', getlocal()) : localize('_OKREMINDER', getlocal());
		else
		    $tokens[] = $sFormErr; 
				   
		return _m('cmsrt._ct use login+' . serialize($tokens));
	}

    public function form() {
	   
        if ($this->login_successfull) {
			$user = decode(GetSessionParam('UserName'));
			$tokens = array(0=>$user);
			return _m('cmsrt._ct use loginsuccess+' . serialize($tokens));
	    }	 
        else
			return $this->html_form();
    }	

    public function quickform($attr=null,$after_goto=null,$dpc_after_goto=null,$param_name=null,$param=null) {
		$UserID = GetGlobal('UserID');
		$this->after_goto = $after_goto;
		$sFormErr = GetGlobal('sFormErr');		
	
		if ($dpc_after_goto) 
			SetSessionParam('afterlogingoto',str_replace('>','.',$dpc_after_goto));

        if ($this->after_goto) {
            $logonurl = _m('cmsrt.seturl use t=' .$this->after_goto . '&$param_name='.$param); //seturl("t=".$this->after_goto."&$param_name=".$param,0,1);
            $this->after_goto = null;
        }
        else
            $logonurl = _m('cmsrt.seturl use t='); //seturl("",0,1);

		if (!$UserID) {
			$tokens[] = $sFormErr;
			$tpkens[] = $logonurl;
			$tokens[] = $this->after_goto;
			$ret = _m('cmsrt._ct use qlogin+' . serialize($tokens));
			return ($ret);	
		}	
		
		return false;
    }
	

    public function do_login($user='',$pwd='',$editmode=null) {
	    $db = GetGlobal('db');
	    $sFormErr = GetGlobal('sFormErr');
	    $UserName = GetGlobal('UserName');

        if (!$user) $sUsername = GetParam("Username");
	        else $sUsername = $user;
			
        if (!$pwd) $sPassword = GetParam("Password");
	        else $sPassword = $pwd;

	    if (($sUsername) && ($sPassword)) {

			$sSQL = "SELECT ".$this->actcode.", sesid, notes, seclevid, clogon FROM users" . " WHERE username ='" .
				addslashes($sUsername) . "' AND password='" . md5(addslashes($sPassword)) . "'";		  
          
			$result = $db->Execute($sSQL,2);

			if (($result->fields[$this->actcode]) && (strcmp(trim($result->fields['notes']),"DELETED")!=0)) {
		  
				if (intval($result->fields['seclevid'])>=5) { 	 //echo 'admin';
		            $_SESSION['LOGIN'] = 'yes';
					$GLOBALS['LOGIN'] = 'yes';
		            SetSessionParam('ADMIN','yes');	
				    SetSessionParam('ADMINSecID',$result->fields['seclevid']);
					SetSessionParam("LoginName", $sUsername); //un-encoded	
				}  
				
                //if ($this->load_session)
				//    $this->loadSession($sUsername);
				
                SetSessionParam("UserName", encode($sUsername)); 
                SetSessionParam("UserID", encode($result->fields[$this->actcode]));
				$GLOBALS['UserID']=encode($result->fields[$this->actcode]);
                SetSessionParam("UserSecID", encode($result->fields['seclevid']));
				$GLOBALS['ADMINSecID']= $result->fields['seclevid'];
				SetSessionParam('ADMINSecID',$result->fields['seclevid']);	
							  
				if ((defined('SHCUSTOMERS_DPC'))) 							  
	                GetGlobal('controller')->calldpc_method('shcustomers.is_reseller');	

			    //re-enter password flag
			    if ($result->fields['clogon']==1) {
				    $this->must_reenter_password=1;
			   	    $chpass = seturl("t=chpass",localize('_PASSREMINDER',getlocal()),1,'',1);
					setInfo($chpass);
				}
				else
  		            setInfo(localize('_WELLCOME',getlocal()) . " " . $sUsername);
                
				//set cookie
				/*if (paramload('SHELL','cookies')) {
				    setcookie("cuser",$UserName,time()+$this->time_of_session);//,time()+3600,"","stereobit.gr",0);
					setcookie("csess",session_id(),time()+$this->time_of_session);
				}*/
				
				$this->update_login_statistics('cplogin', $sUsername);
				
				return true;
			}
			else {
				$this->update_login_statistics('cplogin-failed', $sUsername);
				
				return false;
			}	
	   }
	   
	   return false;
	}

    public function do_logout() {
		$UserName = GetGlobal('UserName');

		$un  = decode($UserName);
		$this->saveSession();

		setInfo(localize('_SEEYOU',getlocal()) . " $un ...");

		//zero cookie
		if (paramload('SHELL','cookies')) {
			setcookie("cuser","");
			setcookie("csess","");
		}
		
		$this->update_login_statistics('cplogout', $un);
	}
	
	public function getUserName() {
	    $UserName = GetGlobal('UserName');	
	    $ret = decode($UserName);
	  
	    return ($ret);
	}
	
	public function recaptcha() {
		if (defined('RECAPTCHA_DPC')) {
	        $recaptcha = recaptcha_get_html($this->recaptcha_public_key, null, $this->ssl);	   
			return $recaptcha;
	    }
		
		return false;
	}		

    protected function do_reenter_pasword($myusername=null) {
	    $db = GetGlobal('db');
	    $sFormErr = GetGlobal('sFormErr');
	    $UserName = GetGlobal('UserName');

	    if ($id = GetParam('sectoken')) {//by mail link or form hidden element ajax call
		    $toks = explode('|',base64_decode(urldecode($id)));
		    $currentuser = $toks[0]; 
	    } 			   
	    else
	        $currentuser = $myusername ? $myusername : decode($UserName);

	    if (!$currentuser) return false;

	    $pwd = GetParam("Password");
	    $pwd2 = GetParam("vPassword");

	    //if ($this->valid_recaptcha()) {
	    if (($pwd!=null) && ($pwd2!=null)) {

			if  ((strcmp($pwd,$pwd2)==0)) {
		 
				//extra checks
				if ((!is_numeric($pwd)) && (strlen($pwd)>=8)) {

					$sSQL = "UPDATE users set " .
							"password='" . md5(addslashes($pwd))  . "'," .
							"vpass='" . md5(addslashes($pwd2))  . "'," .
							"clogon=0";

					$sSQL .= " WHERE username ='" . $currentuser . "'";

					$db->Execute($sSQL,1);
					$this->formerror = localize('ok2',getlocal());
					SetGlobal('sFormErr',$this->formerror);
				}
				else {
					$this->formerror = localize('_MSGPWD',getlocal());
					SetGlobal('sFormErr',$this->formerror);	 	   
				} 		   
			}
			else {
				$this->formerror = localize('_MSG21',getlocal());
				SetGlobal('sFormErr',$this->formerror);
			}  
	   }
	   //}//recaptcha
	}

    protected function form_reset_pass($username=null) {
	    $sectoken = GetReq('sectoken') ? '&sectoken='.GetReq('sectoken') : null;
        $url = _m('cmsrt.seturl use t=chpass' . $sectoken); 
	   
	    if (defined('RECAPTCHA_DPC')) 
	        $recaptcha = recaptcha_get_html($this->recaptcha_public_key, null, $this->ssl);	   
		
		$tokens[] = $this->formerror;		   
		$tokens[] = $recaptcha;		   
        $tokens[] = GetReq('sectoken');//use in form hidden element ajax call					   		   
		 
	    return ($tokens); 		 
    }	
	
	protected function html_reset_pass() {
	    $UserName = GetGlobal('UserName');
	   
	    if ($id = base64_decode(urldecode(GetReq('sectoken')))) {//by mail link
		    $toks = explode('|',$id);
		    $timestamp = time(); 
		    if (is_numeric($toks[1]) && (($timestamp-(intval($toks[1])))<3600)) {//timestamp < 1 hour
				$currentuser = $toks[0]; 
			}	 
			else {//timestamp is invalid	 
				$currentuser = null; 
				$this->formerror = localize('_ERRSECTOKEN',getlocal());
				SetGlobal('sFormErr',$this->formerror);
		    }	 
		    //echo $timestamp,intval($toks[1]),'>',$currentuser;
	    } 			   
	    elseif ($UserName)	   
			$currentuser = decode($UserName);	
	    else
			$currentuser = null;	   
	
	    if (($currentuser) && ($this->formerror!=localize('ok2',getlocal()))) {
			$tokens = (array) $this->form_reset_pass($currentuser);
			$ret = _m('cmsrt._ct use userchpass+' . serialize($tokens));			
	    }	  
	    else {//login
			//if (!$editmode)
				//$ret = $this->html_form(); 
	    }	
		  
	    return ($ret);  
	}		

	protected function saveSession() {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');

		$currentses = session_id();
		$currentuser = decode($UserName);
		$session_data = str_replace("\"","<@>",session_encode());

		//save ses id
		$sSQL = "UPDATE users set sesid='" . $currentses .
                    "',sesdata='" . $session_data .
		       "' WHERE username ='" . $currentuser . "'" ;

		$db->Execute($sSQL,1);
	   
	    //unregister all selected session params
	    ResetSessionParams();

        //session_write_close();

        session_unset();

	    //session_destroy();
	}

	protected function loadSession($uname) {
		$db = GetGlobal('db');

	    $sSQL = "select sesdata from users where username='" . $uname ."'" ;
        $res = $db->Execute($sSQL,2);//null,1);

	    session_decode(str_replace("<@>","\"",$res->fields[0]));
    }

	public function is_reseller($leeid=null) {
	    $db = GetGlobal('db');

	    if ($leeid!=null)
			$id = $leeid;
	    else
			$id = decode(GetSessionParam('UserID'));

	    //if is in cuatomers table then....
	    if ($id) {

			$sSQL = "select attr1 from customers where ".$this->actcode."=" . $id;
			$result = $db->Execute($sSQL,2);

			if ($result->fields[0]==$this->reseller_attr) {
				SetSessionParam('RESELLER','true');
				return true;
			}
	    }

	    return false;
	}

	protected function iforgotmypassword() {

	    $ret = $this->message . "&nbsp;" . $this->link;
		return ($ret);
	}

    protected function remform() {

  	    if ($this->formerror!=localize("ok", getlocal())) {
	        $url = _m('cmsrt.seturl use t=shremember');
			
			if (defined('RECAPTCHA_DPC')) 
				$recaptcha = recaptcha_get_html($this->recaptcha_public_key, null, $this->ssl);	   	   
         
			$tokens[] = $this->formerror;
			$tokens[] = $recaptcha;		    
		}
		else {	
            $logonurl = _m('cmsrt.seturl use t='); //seturl("",0,1);		
			$tokens[] = localize('_SENDCRE',getlocal());	
			$tokens[] = null; //dummy	
	    }
		return ($tokens); 		
    }
	
	public function html_remform() {

		$tokens = (array) $this->remform();	
		return _m('cmsrt._ct use remlogin+' . serialize($tokens));		
	}

	protected function do_the_job() {
	   $db = GetGlobal('db');
	   $u = GetParam("myusername");
	   $m = GetParam("myemail");  
	   //$captcha = GetParam("mycaptcha");
	   
        //if ($this->valid_recaptcha($norecaptcha)) {	 
	    //if (($captcha) && ($captcha==$_SESSION['CAPTCHA'])) {
		if (true===$this->valid_captcha()) {	

			if ($m) {// && (!$u)) {//mail only -> send username and password
				$sSQL = "SELECT username, password, notes FROM users WHERE " .
						"email='" . addslashes($m) . "'";

				//echo "remember:",$sSQL;
				$result = $db->Execute($sSQL,2);

				if (($u=$result->fields['username']) && ($p=$result->fields['password'])) {
 
					$tokens[] = $u;
					$tokens[] = null; 
					
					$timestamp = time(); 
					$sectoken = urlencode(base64_encode($u.'|'.$timestamp));
					$reset_url = seturl('t=chpass&sectoken='.$sectoken);
					$tokens[] = $reset_url;			  
				
					$mailbody = _m('cmsrt._ct use userremind+' . serialize($tokens) . '+1');
			   
					$from = $this->accountmailfrom;
					$this->mailto($from,$m,localize('_UMAILREMSUBC',getlocal()),$mailbody);

					$this->formerror = localize("ok", getlocal());
					$this->update_login_statistics('cplogin-renew', $u);
				}
				else 
					$this->formerror = localize('_MSG1',getlocal());
			}
			else
				$this->formerror = localize('_MSG1',getlocal());
		   
		   
			if ($this->formerror!='ok') 
				SetGlobal('sFormErr',$this->formerror);		   
			else 	
				SetGlobal('sFormErr',"OKREMINDER");////$msg);
		 
	    }//recaptcha	       
	}

	//alias
	protected function do_the_captcha() {
		
		return $this->valid_captcha();
	}

	//alias
	protected function show_the_captcha() {

		die($this->captchaImage());
	}

	public function is_logged_in() {

	    if (GetSessionParam('UserID'))
		    return true;

		return false;
	}

	public function mailto($from,$to,$subject=null,$body=null) {

		if ((defined('SMTPMAIL_DPC')) && (seclevel('SMTPMAIL_DPC',$this->UserLevelID)) ) {
		    $smtpm = new smtpmail;
		    $smtpm->to = $to;
			$smtpm->from = $from;
			$smtpm->subject = $subject;
			$smtpm->body = $body ;

			$mailerror = $smtpm->smtpsend();

			unset($smtpm);

			return ($mailerror);
		}
	}
   
	protected function valid_recaptcha() {
	 
	    if (!defined('RECAPTCHA_DPC')) return true;
		  
		//print_r($_POST);
		  
        if ($_POST["recaptcha_response_field"]) {
            $resp = recaptcha_check_answer ($this->recaptcha_private_key,
                                            $_SERVER["REMOTE_ADDR"],
                                            $_POST["recaptcha_challenge_field"],
                                            $_POST["recaptcha_response_field"]);
											
            //print_r($resp);
            if ($resp->is_valid) {
                $error = null;//echo "You got it!";
				$ret = true;
            } 
			else {
                # set the error code so that we can display it
                $error = $resp->error;
				$ret = false;
		        $msg = '<br>' . "Incorrect recaptcha entry!";				
            }
		}
		else {
		    $ret = false;
		    $msg = '<br>' . "Recaptcha entry required!";			  
		}
		  
		$this->formerror = $msg;//'recaptcha error';
		SetGlobal('sFormErr',$msg);
		  
		return ($ret);																			 
    }     
	 
	public function combine_tokens($template_contents,$tokens) {
	
	    if (!is_array($tokens)) return;
		
		if (defined('FRONTHTMLPAGE_DPC')) {
			$fp = new fronthtmlpage(null);
			$ret = $fp->process_commands($template_contents);
			unset ($fp);	  		
		}		  		
		else
			$ret = $template_contents;
		  
	    foreach ($tokens as $i=>$tok) 
		    $ret = str_replace("$".$i,$tok,$ret);

		//clean unused token marks
		for ($x=$i;$x<10;$x++)
			$ret = str_replace("$".$x,'',$ret);

		return ($ret);
	}   

	public static function myf_button($title,$link=null,$image=null) {

	    $path = self::$staticpath;//$this->urlpath;//
	   
	    if (($image) && (is_readable($path."/images/".$image.".png"))) {
			//echo 'a';
			$imglink = "<a href=\"$link\" title='$title'><img src='images/".$image.".png'/></a>";
	    }
	   
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
		  
	    $ret .= "<input type=\"button\" class=\"myf_button\" value=\"".$title."\" />";
	   
	    if ($link)
			$ret .= "</a>";	   
		  
	    return ($ret);
	}
	
	public function myf_login_logout($link=null,$glue=null) {
	
	    if ($UserID = GetGlobal('UserID')) {
	        $url = seturl("t=dologout",localize('_SHLOGOUT',getlocal()),null,null,null,true);
			$myfb = ($link) ? (($glue) ? '<'.$glue.'>'.$url.'</'.$glue.'>' : $url) :
			                  $this->myf_button(localize('_SHLOGOUT',getlocal()),'dologout/','_SHLOGOUT');
	    }
	    else {
		    $url = seturl("t=login",localize('SHLOGIN_DPC',getlocal()),null,null,null,true);
		    $myfb = ($link) ? (($glue) ? '<'.$glue.'>'.$url.'</'.$glue.'>' : $url) :
			                  $this->myf_button(localize('SHLOGIN_DPC',getlocal()),'login/','_SHLOGIN');
	    }
	   
	    return ($myfb);
	}
	
	protected function update_login_statistics($id, $user=null) {
        $db = GetGlobal('db'); 

	    $currentdate = time();	
	    $myday  = date('d',$currentdate);	
	    $mymonth= date('m',$currentdate);	
	    $myyear = date('Y',$currentdate);
						
		$sSQL = "insert into stats (day,month,year,attr1,attr3,REMOTE_ADDR,HTTP_X_FORWARDED_FOR) values (";
		$sSQL.= $myday . ",";
		$sSQL.= $mymonth . ",";
		$sSQL.= $myyear . ",";						
		$sSQL.= $db->qstr($id) . ',';
		$sSQL.= $db->qstr($user) . ',';
		$sSQL.= $db->qstr($_SERVER['REMOTE_ADDR']) . ",";
		$sSQL.= $db->qstr($_SERVER['HTTP_X_FORWARDED_FOR']) . ")";			

		$db->Execute($sSQL,1);	 
		
		if ($db->Affected_Rows()) 
			return true;
		else 
			return false;		
	}

	public function captchaImage() {
		
		if (defined('SCAPTCHA_DPC')) {
			$cpc = new scaptcha();
			$_SESSION['CAPTCHA'] = $cpc->captchaInit();
			
			return $cpc->captchaImage();
		}

		return 'scpatcha is not defined';	
	}

	protected function valid_captcha($fieldname=null) {
	    $captcha = $fieldname ? GetParam($fieldname) : GetParam("mycaptcha");		
	    if (!defined('SCAPTCHA_DPC')) return true;

		if (($captcha) && ($captcha==$_SESSION['CAPTCHA'])) 	
			return true;
		
		return false;
	}	
	
};
}
?>