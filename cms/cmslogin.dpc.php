<?php
$__DPCSEC['CMSLOGIN_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CMSLOGIN_DPC")) && (seclevel('CMSLOGIN_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CMSLOGIN_DPC",true);

$__DPC['CMSLOGIN_DPC'] = 'cmslogin';

//define('YOUR_APP_ID', '1402380970015617');
$a = GetGlobal('controller')->require_dpc('fb/facebook.lib.php');
require_once($a);

$__EVENTS['CMSLOGIN_DPC'][0]='cmslogin';
$__EVENTS['CMSLOGIN_DPC'][1]='dologin';
$__EVENTS['CMSLOGIN_DPC'][2]='dologout';
$__EVENTS['CMSLOGIN_DPC'][3]='rempwd';
$__EVENTS['CMSLOGIN_DPC'][4]='shremember';
$__EVENTS['CMSLOGIN_DPC'][5]='shcaptcha';
$__EVENTS['CMSLOGIN_DPC'][6]='chpass';
$__EVENTS['CMSLOGIN_DPC'][7]='shrememberajax';
$__EVENTS['CMSLOGIN_DPC'][8]='chpassajax';
$__EVENTS['CMSLOGIN_DPC'][9]='dologinajax';
$__EVENTS['CMSLOGIN_DPC'][10]='shreg';
$__EVENTS['CMSLOGIN_DPC'][11]='shlogin';

$__ACTIONS['CMSLOGIN_DPC'][0]='cmslogin';
$__ACTIONS['CMSLOGIN_DPC'][1]='dologin';
$__ACTIONS['CMSLOGIN_DPC'][2]='dologout';
$__ACTIONS['CMSLOGIN_DPC'][3]='rempwd';
$__ACTIONS['CMSLOGIN_DPC'][4]='shremember';
$__ACTIONS['CMSLOGIN_DPC'][5]='shcaptcha';
$__ACTIONS['CMSLOGIN_DPC'][6]='chpass';
$__ACTIONS['CMSLOGIN_DPC'][7]='shrememberajax';
$__ACTIONS['CMSLOGIN_DPC'][8]='chpassajax';
$__ACTIONS['CMSLOGIN_DPC'][9]='dologinajax';
$__ACTIONS['CMSLOGIN_DPC'][10]='shreg';
$__ACTIONS['CMSLOGIN_DPC'][11]='shlogin';

$__DPCATTR['CMSLOGIN_DPC']['cmslogin'] = 'cmslogin,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['CMSLOGIN_DPC'][0]='CMSLOGIN_DPC;Login;Σύνδεση';
$__LOCALE['CMSLOGIN_DPC'][1]='_CMSLOGOUT;Logout;Αποσύνδεση';
$__LOCALE['CMSLOGIN_DPC'][2]='CMSLOGIN_CNF;Logout;Αποσύνδεση';
$__LOCALE['CMSLOGIN_DPC'][3]='CMSLOGIN_UNK;Login;Σύνδεση';
$__LOCALE['CMSLOGIN_DPC'][4]='_USERNAME;Username;Χρήστης';
$__LOCALE['CMSLOGIN_DPC'][5]='_PASSWORD;Password;Κωδικός';
$__LOCALE['CMSLOGIN_DPC'][6]='_WELLCOME;Welcome;Καλωσήρθες';
$__LOCALE['CMSLOGIN_DPC'][7]='_SEEYOU;See you next time;Τα λέμε';
$__LOCALE['CMSLOGIN_DPC'][8]='_MSG1;Incorrect data!;Λανθασμένα στοιχεία!';
$__LOCALE['CMSLOGIN_DPC'][9]='_VERPASS;Verify password;Επαληθευση κωδικου';
$__LOCALE['CMSLOGIN_DPC'][10]='_PASSREMINDER;Please change your password!;Παρακαλω αλλαξτε τον κωδικό σας!';
$__LOCALE['CMSLOGIN_DPC'][11]='_VERPASSUCCESS;Password changed!;Επιτυχης αλλαγη κωδικου';
$__LOCALE['CMSLOGIN_DPC'][12]='_HERE;here;εδώ';
$__LOCALE['CMSLOGIN_DPC'][13]="_IFORGET;If you dont remember your password click ;Αν δεν θυμαστε τον κωδικο σας πατηστε";
$__LOCALE['CMSLOGIN_DPC'][14]='_PRESSHERE;Click here;Πατήστε εδώ';
$__LOCALE['CMSLOGIN_DPC'][15]='_MSG2;Username and Password send at your mail account!;Το όνομα χρήστη και ο κωδικός στάλθηκαν στο ηλεκτρονικό σας ταχυδρομείο!';
$__LOCALE['CMSLOGIN_DPC'][16]='_SENDCRE;Username and Password send at your mail account!;Το όνομα χρήστη και ο κωδικός στάλθηκαν στο ηλεκτρονικό σας ταχυδρομείο!';
$__LOCALE['CMSLOGIN_DPC'][17]='_UMAILREMSUBC;Account reset;Αλλαγή κωδικού χρήστη';
$__LOCALE['CMSLOGIN_DPC'][18]='_OK;Success;Επιτυχης εργασια';
$__LOCALE['CMSLOGIN_DPC'][19]='_OKREMINDER;Your account details has been send by e-mail.;Τα στοιχεία του λογαριασμού σας σταλθηκσν με e-mail.';
$__LOCALE['CMSLOGIN_DPC'][20]='_RESET;Reset;Αλλαγή';
$__LOCALE['CMSLOGIN_DPC'][21]='_RESETPASS;Reset password;Αλλαγή κωδικού';
$__LOCALE['CMSLOGIN_DPC'][22]="_MSG21;Password and verify password doesn't match!;Η επιβαιβαιωση κωδικου δεν συμφωνει με τον κωδικο σας.";
$__LOCALE['CMSLOGIN_DPC'][23]='_MSGPWD;Invalid password length, 8 characters required;Μη αποδεκτός κωδικός, 8 χαρακτήρες τουλάχιστον είναι απαραίτητοι';
$__LOCALE['CMSLOGIN_DPC'][24]='ok;A message sent to your e-mail. Please use the link to activate your account;Ένα μήνυμα στάλθηκε στο e-mail που δηλώσατε. Παρακαλώ ενεργοποιήστε τον λογαριασμό σας';
$__LOCALE['CMSLOGIN_DPC'][25]='_ok;Submit;Αποστολή';
$__LOCALE['CMSLOGIN_DPC'][26]='ok2;Password changed;Ο κωδικός άλλαξε';
$__LOCALE['CMSLOGIN_DPC'][27]='_ERRSECTOKEN;Invalid token;Λάνθασμένο στοιχείο';
$__LOCALE['CMSLOGIN_DPC'][28]='_NOTAFFECTED;Record not affected;Δεν έγινε η αλλαγή';
$__LOCALE['CMSLOGIN_DPC'][29]='_PLEASETEXT;Please fill out the information bellow and proceed;Παρακαλώ εισάγετε τα στοιχεία που ειναι απαραίτητα για την εισαγωγή στο σύστημα';
$__LOCALE['CMSLOGIN_DPC'][30]='_WELCOME2GO;Press here to proceed;Πατήστε εδώ για να συνεχίσετε την περιηγησή σας';
$__LOCALE['CMSLOGIN_DPC'][31]='_back;Back;Επιστροφή';
$__LOCALE['CMSLOGIN_DPC'][32]='SHLOGIN_DPC;Login;Εισαγωγή';
$__LOCALE['CMSLOGIN_DPC'][33]='_FBLOGIN;Login with Facebook;Σύνδεση με Facebook';
$__LOCALE['CMSLOGIN_DPC'][34]='_mailmxerr;Wrong e-mail;Λανθασμένο e-mail';
$__LOCALE['CMSLOGIN_DPC'][35]='_MSGDISABLEDUSER;Disabled user account;Απενεργοποιημένος λογαριασμός χρήστη';
$__LOCALE['CMSLOGIN_DPC'][36]='_MSGRESENDACTIVE;A message sent to your e-mail. Please use the link to activate your account;Ένα μήνυμα στάλθηκε στο e-mail που δηλώσατε. Παρακαλώ ενεργοποιήστε τον λογαριασμό σας';

class cmslogin {

	var $path, $urlpath, $userLevelID, $msg, $time_of_session;
	var $username, $userid;
    var $iname, $load_sesssion;
    var $after_goto, $dpc_after_goto,$login_successfull;
	var $login_goto, $logout_goto;  
	var $recaptcha_public_key, $recaptcha_private_key;	
	var $resetPass, $isLogin, $isRegistered, $ssl, $failedLogins;
	var $inactive_on_register, $recaptcha, $appname, $mtrackimg;	
	var $facebook_id, $facebook_key, $facebook_userId, $facebook, $fbhash, $fbmode, $fbredir, $fbin;		

	public function __construct() {
	    $sFormErr = GetGlobal('sFormErr');
	    $UserName = GetGlobal('UserName');
	    $UserSecID = GetGlobal('UserSecID');
	    $UserID = GetGlobal('UserID'); 
	   
	    $this->username = decode($UserName);
	    $this->userid = decode($UserID);
        $this->userLevelID = (((decode($UserSecID))) ? (decode($UserSecID)) : 0);
	    $this->msg = $sFormErr;

        $this->path = paramload('SHELL','prpath');
	    $this->urlpath = paramload('SHELL','urlpath');			
		
        $logintime = remote_paramload('CMSLOGIN','logintime',$this->path);
	    $this->time_of_session = $logintime ? $logintime : 3600;//1 hour is default

	    $this->title = localize('CMSLOGIN_DPC',getlocal());		
	    $this->load_session = remote_paramload('CMSLOGIN','loadsession',$this->path);
	    //$this->reseller_attr = remote_paramload('CMSLOGIN','reseller',$this->path); //DISABLED
	    $this->accountmailfrom = remote_paramload('CMSLOGIN','accountmailfrom',$this->path);	   
	    $this->logout_goto = remote_paramload('CMSLOGIN','logout_goto',$this->path);
	    $this->login_goto = remote_paramload('CMSLOGIN','login_goto',$this->path);		
	    $this->after_goto = remote_paramload('CMSLOGIN','aftergoto',$this->path);
	    $this->dpc_after_goto = GetSessionParam('afterlogingoto') ? GetSessionParam('afterlogingoto') : $this->after_goto;		
		
		$flogins = _m('cms.paramload use CMS+failedLogins');
		$this->failedLogins = is_numeric($flogins) ? ($flogins-1) : 2;	//zero count	
		
	    $this->recaptcha_public_key = remote_paramload('RECAPTCHA','pubkey',$this->path);							  
	    $this->recaptcha_private_key = remote_paramload('RECAPTCHA','privkey',$this->path);			
	    $rp = remote_paramload('CMSLOGIN','recaptcha',$this->path);
	    $this->recaptcha = $rp ? true : false;	

		$this->appname = paramload('ID','instancename');
		$tcode = remote_paramload('RCBULKMAIL','trackurl', $this->prpath);
		$this->mtrackimg = $tcode ? $tcode : "http://www.stereobit.gr/mtrack.php";				
		
	    $this->inactive_on_register = remote_paramload('SHUSERS','inactive_on_register',$this->path);		
   		
        $this->must_reenter_password = null;		
	    $this->login_successfull = false;		
	    $this->resetPass = false;
	    $this->isLogin = false;
	    $this->isRegistered = false;
	    $this->formerror = null;
		$this->ssl = (isset($_SERVER['HTTPS'])) ? true : false;		
	
	    //facebook login 	
	    $this->facebook_id = _m('cms.paramload use CMS+fbid'); //remote_paramload('CMSLOGIN','fbid',$this->path); 
	    $this->facebook_key = _m('cms.paramload use CMS+fbkey'); //remote_paramload('CMSLOGIN','fbkey',$this->path); 
		$this->fbmode = _m('cms.paramload use CMS+fbLogMode');	
		$this->fbauto = _m('cms.paramload use CMS+fbAutoLogin');
		$this->fbhash = GetSessionParam('fbhash');		
		$this->fbin = GetSessionParam('fbin');	
	    $this->facebook_userId = null;			
		//echo $this->fbmode,'>';		
		
		if (!$this->fbmode)
			$this->login_javascript(); //load allways, redirect anypage
	}

    public function event($sAction) {

        switch($sAction)   {
			case 'shreg'        : 	$this->register();
									break;			
			
		    case 'rempwd'       : 	break;
			case 'shrememberajax':
		    case 'shremember'   : 	$this->do_the_job(); 
			
									if ($this->fbmode==1)
										$this->login_javascript(); //redirect only when in login page
									
									break;
									
		    case 'shcaptcha'    : 	$this->do_the_captcha(); 
									break;
			case 'shlogin'      :
            case 'cmslogin'     : 	if ($this->fbmode==1)
										$this->login_javascript(); //redirect only when in login page
									break;

			case "dologinajax"  :
            case "dologin"      : 	if (GetParam('Username')) //default login
										$this->login_successfull = $this->do_login();
									else //fb etc login	
										$this->login_successfull = $this->is_fb_logged_in() ? $this->do_facebook_login() : $this->do_login();
							        
									if ($this->login_successfull) {
										/* 
										if (defined('SHCART_DPC')) 
											$cartnotempty = _m('shcart.notempty');
											
										//goto after login...	
										$this->login_goto = ($cartnotempty) ? $this->login_goto : '/';//'signup/';
										*/
										
										if (($this->login_goto) && ($this->login_successfull)) {
											if (!$this->dpc_after_goto)// inside code command
												$this->refresh_page_js($this->login_goto);	
										}										
									}	
									else {
										if ($this->fbmode==1)
											$this->login_javascript(); 
									}	
									break;

            case "dologout"     :   if ($this->is_fb_logged_in()) 
										$this->do_facebook_logout();
									else 
										$this->do_logout();
											
                                    if ($this->logout_goto)
			                            $this->refresh_page_js($this->logout_goto); 											
                                    break;
			
             case "chpassajax"  :			
			 case "chpass"      : 	$this->do_reenter_pasword(); 
			                        break;
							 					 
        }
	}

    public function action($action=null)  {

        switch($action)   {
		    case 'shreg'        : 	break;			
		
			case 'shrememberajax':	if ($this->formerror!=localize("ok",getlocal()))
										die($this->formerror);
									else
										die(localize('_OKREMINDER', getlocal()));
									break;
								  
		    case 'rempwd'       :
		    case 'shremember'   :	if ($this->formerror!=localize("ok",getlocal())) 
										$out .= $this->html_remform();	 
									else //login  
										$out = $this->html_form(); 
									break;
								 
		    case 'shcaptcha'    : 	$out = $this->show_the_captcha(); 
									break;
			case 'shlogin'      :
            case "cmslogin"     : 	$out = $this->form(); 
									break;

			case "dologinajax"  : 	$gurl = $_POST['FormGoto'] ? $_POST['FormGoto'] : $this->login_goto;
									$goto = $gurl ? '<a href="'.$gurl.'">'.localize('_WELCOME2GO',getlocal()).'</a>' : null;
									die(localize('_WELLCOME',getlocal()) . ' ' . $goto); 
									break;
								 
            case "dologin"      : 	if ($this->login_successfull) {
										
										//echo 'cmslogin:',$this->dpc_after_goto,'>';
										if ($this->dpc_after_goto) {
											$out = _m($this->dpc_after_goto); 
											
											$this->dpc_after_goto = null; //reset
											SetSessionParam('afterlogingoto',''); //reset											
										}
										else		
											$out = $this->form();
									}
									else 
										$out = $this->form(); 

									break;

            case "dologout"     : 	$out = $this->form(); 
									break;
			
		    case "chpass"       : 	$out = $this->html_reset_pass();
									break;
							
			case "chpassajax"   : 	die($this->formerror); 
									break;				
		}

		return ($out);
	}	
	
	public function login_javascript() {
	
        if (iniload('JAVASCRIPT')) {
	   
			$code = $this->fblogin_javascript();
			if ($code) {
				$js = new jscript;		   	 	
				$js->load_js($code,null,1);		
				unset ($js);
			}
	    }	
	}		
	
	public function fblogin_javascript($isUser=false) {
		$UserID = GetGlobal('UserID');	
		if (($isUser==false) && ($UserID)) return null; //not a fb login when already logged in
		
	    if (!$this->facebook_id) return null;	
		$localization = (getlocal()==1) ? 'el_GR' : 'en_US';
		
		if ($this->fbauto) {
			$fbRedir = "FB.Event.subscribe('auth.login', function(response) {
		var hash = window.location;	  
		if (response.status === 'connected') { 
			window.location.href='dologin/#facebook^'+hash;}	
		else window.location.href='dologout/#^'+hash;
		 });
"; 
		}	
	
	
		$fbjslogin = <<<FBLOGIN
		window.fbAsyncInit = function() { 
		  FB.init({appId: '{$this->facebook_id}', xfbml: true, cookie: true, version: 'v2.7'});
		  	
		  FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                var uid = response.authResponse.userID;
                var accessToken = response.authResponse.accessToken;
				/* //Do something with the access token
				testAPI(); */
			} 
			else {
				var hash = window.location;				
                // Subscribe to the event 'auth.authResponseChange' and wait for the user to autenticate
                FB.Event.subscribe('auth.authResponseChange', function(response) {
					window.location.href='dologin/#facebook^'+hash;
                },true);           
            }
		  });	
 
		  $fbRedir
        };	
		
		/*MOVED TO PAGE (function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/{$localization}/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

		function testAPI() {
			console.log('Welcome!  Fetching your information.... ');
			FB.api('/me?fields=id,email,name', function(response) {
				console.log('Successful login for: ' + response.email);
				document.getElementById('status').innerHTML =
				'Thanks for logging in, ' + response.name + '!';
			});
		}*/		
FBLOGIN;
	
		return ($fbjslogin);
	}
	
	public function facebook_login($init_only=false, $js=false) {

	    //if u want to see when logout...reg FP..remark return
		//if ($this->is_fb_logged_in()) return('Facebook logged in');
	
	    $ret = '<div id="fb-root"></div>';
		if ($js) {//for quickform call
			$ret .= '<script>' .
			        $this->fblogin_javascript(). 
					'</script>';
		} //for all at construct...
		
		if ($init_only==false) 
			$ret .= '<div id="fb-div" class="fb-login-button" data-auto-logout-link="true" scope="public_profile,email">' . localize('_FBLOGIN',getlocal()) . '</div>';
	  	
		return ($ret);
	}	
	
	public function displayFBLoginButton() {
		return '<fb:login-button show-faces="false" width="600" max-rows="1" scope="publish_stream, manage_pages, email" onlogin="afterFbLogin()"></fb:login-button>';
	}	
	
	public function is_fb_logged_in() {
	    //print_r($_COOKIE);
		$this->facebook = new Facebook(array(
							'appId'  => $this->facebook_id,
							'secret' => $this->facebook_key,
							));		
							
	    if ((!$this->facebook_id) || (!is_object($this->facebook))) 
			return false;
		
		$cookie_name = 'fbsr_'. $this->facebook->getAppId();
		//echo $cookie_name.'>';
		if (array_key_exists($cookie_name, $_COOKIE)) {
			SetSessionParam('fbin',1);
			return true;
		}	
		
		$this->facebook->destroySession();
		
		SetSessionParam('fbin',null);
		return false;	
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
		
		$ret = "var hash = window.location.hash.substring(1);
var value = hash.split('^'); var rurl= (value[1]!=null) ? value[1] : '$goto';		
function neu() { top.frames.location.href = rurl;} 
window.setTimeout('neu()',10);
";
		return ($ret);
    }   


	protected function do_the_captcha() {

	}

	protected function show_the_captcha() {

	    $result = decode(GetReq('c'));
		$captcha = new captcha(strlen($result),'jpeg',$result);

		die();
	}	
	
    public function form() {
		$failedtimes = GetSessionParam('failedLogin');
	   
        if ($this->login_successfull) {
			$user = decode(GetSessionParam('UserName'));
			$tokens = array(0=>$user);
			return _m('cmsrt._ct use loginsuccess+' . serialize($tokens));
	    }	 
        else {
			//return $this->html_form();
			$form = ($failedtimes > $this->failedLogins) ? $this->html_remform() : $this->html_form();
			return $form;
		}	
    }	
	
	public function html_form() {
	    $sFormErr = GetGlobal('sFormErr');
	    $UserID = GetGlobal('UserID');
        $logonurl = _m('cmsrt.seturl use t=dologin'); 	
		 
		if ($UserID) {
			
			$tokens[] = _m('cmsrt.seturl use t=dologout'); 
			$tokens[] = localize('_CMSLOGOUT',getlocal());

			$ret = _m('cmsrt._ct use logout+' . serialize($tokens));
	 	
		    return ($ret);
		}	 
		
	    if (($sFormErr=='ok')||($sFormErr=='Ok')||($sFormErr=='OK')||($sFormErr=='OKREMINDER')) 
  		    $tokens[] = (stristr($sFormErr,'ok')) ? localize('_OK', getlocal()) : localize('_OKREMINDER', getlocal());
		else
		    $tokens[] = $sFormErr; 
				   
		return _m('cmsrt._ct use login+' . serialize($tokens));
	}

    public function quickform($attr=null,$after_goto=null,$dpc_after_goto=null,$param_name=null,$param=null) {
		$UserID = GetGlobal('UserID');
		$this->after_goto = $after_goto;
		$sFormErr = GetGlobal('sFormErr');		
	
		if ($dpc_after_goto) 
			SetSessionParam('afterlogingoto',str_replace('>','.',$dpc_after_goto));

        if ($this->after_goto) {
            $logonurl = _m('cmsrt.seturl use t=' .$this->after_goto . "&$param_name=".$param); //seturl("t=".$this->after_goto."&$param_name=".$param,0,1);
            $this->after_goto = null;
        }
        else
            $logonurl = _m('cmsrt.seturl use t='); //seturl("",0,1);

		if (!$UserID) {
			$tokens[] = $sFormErr;
			$tokens[] = $logonurl;
			$tokens[] = $this->after_goto;
			$ret = _m('cmsrt._ct use qlogin+' . serialize($tokens));
			return ($ret);	
		}	
		
		return false;
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
		return _m('cmsrt._ct use remlogin+' . serialize($tokens)); //$this->combine_tokens($mytemplate,$tokens);
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
			
	protected function html_reset_pass($editmode=null) {
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
				$ret = $this->html_form(); 
	    }	
		  
	    return ($ret);  
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
       
	    if ($this->valid_recaptcha()) {
		//if (_m('cmsrt.valid_captcha')===true) {	
		  if (($pwd!=null) && ($pwd2!=null)) {

			if ((strcmp($pwd,$pwd2)==0)) {
		 
				if ((!is_numeric($pwd)) && (strlen($pwd)>=8)) {

					$sSQL = "UPDATE users set password='" . md5(addslashes($pwd))  . "',vpass='" . md5(addslashes($pwd2))  . "',clogon=0";
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
	    }//recaptcha
	}	

	protected function do_the_job() {
	    $db = GetGlobal('db');
	    $u = GetParam("myusername");
	    $m = GetParam("myemail");  
	   
        if ($this->valid_recaptcha()) {	
		//if (_m('cmsrt.valid_captcha')===true) {		

			if ($this->domain_exists($m)) {
				//$sSQL = "SELECT username, password FROM users WHERE email='" . addslashes($m) . "' and username is not null";
				$sSQL = "SELECT username, password FROM users WHERE username=" . $db->qstr(addslashes($m));
				$result = $db->Execute($sSQL,2);

				if (($u=$result->fields['username']) && ($p=$result->fields['password'])) {

					$tokens[] = $u;
					$tokens[] = null; 
			  
					$timestamp = time(); 
					$sectoken = urlencode(base64_encode($u.'|'.$timestamp));
					$reset_url = seturl('t=chpass&sectoken='.$sectoken); //_m('cmsrt.seturl use t=chpass&sectoken=' . $sectoken); 
					$tokens[] = $reset_url;			  
				
					$mailbody = _m('cmsrt._ct use userremind+' . serialize($tokens) . '+1');
					$body = str_replace('+','<SYN/>',$mailbody); 
					$from = $this->accountmailfrom;
					$subject = localize('_UMAILREMSUBC',getlocal());
					//$this->mailto($from,$m,localize('_UMAILREMSUBC',getlocal()),$mailbody);
					$mailerr = _m("cmsrt.cmsMail use $from+$m+$subject+$body");
					
					$this->formerror = localize("ok", getlocal());
					$this->update_login_statistics('login-renew', $u);
					
					//reset fails at login after successful submit
					SetSessionParam('failedLogin', null); 
					
					$this->resetPass = true;
					return true;
				}
				else 
					$this->formerror = localize('_MSG1',getlocal());
			}
			else
				$this->formerror = localize('_MSG1',getlocal());
		    
			if ($this->formerror!='ok') 
				SetGlobal('sFormErr',$this->formerror);		   
			else 
				SetGlobal('sFormErr',"OKREMINDER");
		 
	    }//recaptcha

		//reset fails at login even when not a correct remember submit
		SetSessionParam('failedLogin', null); 		
		$this->resetPass = false;

		return false;	
	}	
	
    public function do_login($user='',$pwd='') {
	    $db = GetGlobal('db');
	    $sFormErr = GetGlobal('sFormErr');
	    $UserName = GetGlobal('UserName'); 
		$failedtimes = GetSessionParam('failedLogin');	
		
	    //recaptcha NOT FOR PASSWORDS FORM 
        //if ($this->valid_recaptcha()) {		   		

        if (!$user) $sUsername = GetParam("Username", adText);
	        else $sUsername = $user; 
        if (!$pwd) $sPassword = GetParam("Password", adText);
	        else $sPassword = $pwd;

	    if (($sUsername) && ($sPassword)) {

	        $sSQL = "SELECT username, sesid, active, seclevid, clogon FROM users" . " WHERE username ='" .
			   	    addslashes($sUsername) . "' AND password='" . md5(addslashes($sPassword)) . "'";	
			//echo $sSQL;
            $result = $db->Execute($sSQL,2);

			if (($result->fields['username']) && ($result->fields['active']>0)) {
				//echo 'ACTIVE:'.$result->fields['active'];
		        if (intval($result->fields['seclevid'])>=5) { 
					$GLOBALS['LOGIN'] = 'yes';					
		            SetSessionParam('LOGIN','yes');	
		            SetSessionParam('ADMIN','yes');	
				    SetSessionParam('ADMINSecID',$result->fields['seclevid']);
					SetSessionParam("LoginName", $sUsername);
                    return true;								   
				}  

                if ($this->load_session)
				    $this->loadSession($sUsername);

				$GLOBALS['UserID'] = encode($result->fields['username']);
                SetSessionParam("UserName", encode($sUsername));
                SetSessionParam("UserID", encode($result->fields['username']));
                SetSessionParam("UserSecID", encode($result->fields['seclevid']));
							  
				if ((defined('SHCUSTOMERS_DPC')))   						  
	                _m('shcustomers.is_reseller');		

			    //re-enter password flag
			    if ($result->fields['clogon']==1) {
				    $this->must_reenter_password=1;
					$chpass = _m('cmsrt.seturl use t=chpass+' . localize('_PASSREMINDER',getlocal())); //seturl("t=chpass",localize('_PASSREMINDER',getlocal()),1,'',1);
					setInfo($chpass);
				}
				else
  		            setInfo(localize('_WELLCOME',getlocal()) . " " . $sUsername);

				//set cookie
				if (paramload('SHELL','cookies')) {
				    setcookie("cuser", $UserName, time()+$this->time_of_session);
					setcookie("csess", session_id(), time()+$this->time_of_session);
				}
				
				$this->update_login_statistics('login', $sUsername);
				
				$this->isLogin = true;
				return true;
            }
            else { 
				if (($result->fields['username']) && (!$result->fields['active'])) {
					$this->update_login_statistics('login-disabled', $sUsername);
					//echo 'disabled>';
					SetGlobal('sFormErr',localize('_MSGDISABLEDUSER',getlocal()));
					
					//send enable message...
					$user = $result->fields['username'];
					if (defined('SHUSERS_DPC'))  
						_m("shusers.mailtoclient use $user");
					else	
						_m("cmsusers.mailtoclient use $user");
					
					SetGlobal('sFormErr',localize('_MSGRESENDACTIVE',getlocal()));
				}
				else {
					//echo $failedtimes . '>';
					SetSessionParam('failedLogin', $failedtimes+1);
					$this->update_login_statistics('login-failed', $sUsername);
					SetGlobal('sFormErr',localize('_MSG1',getlocal()));
				}
				
				return false;
            }
	    }  
	    //}//recaptcha
	    $this->isLogin = false;
		
	    return false;
	}

    public function do_logout() {
		$UserName = GetGlobal('UserName');
		$un  = decode($UserName);
		
		$this->saveSession();
		$this->update_login_statistics('logout', $un);
		setInfo(localize('_SEEYOU',getlocal()) . " $un");

		//zero cookie
		if (paramload('SHELL','cookies')) {
			setcookie("cuser","");
			setcookie("csess","");
		}
	}	
	
	
    /*[id] => 1678788437
    [name] => Βασίλης Κομήτης
    [first_name] => Βασίλης
    [last_name] => Κομήτης
    [link] => https://www.facebook.com/stereobit.networlds
    [gender] => male
    [email] => vasalex21@gmail.com
    [timezone] => 2
    [locale] => el_GR
    [verified] => 1
    [updated_time] => 2013-05-14T09:01:06+0000
    [username] => stereobit.networlds*/		
	public function do_facebook_login() {
	    $db = GetGlobal('db');	
	
		if ($this->is_fb_logged_in()) {
			$this->facebook_userId = $this->facebook->getUser();
			//echo "FB User Id : " . $this->facebook_userId;
			//when use api /me error...OAuthException: An active access token must be used to query information about the current user
			//$userInfo = $this->facebook->api('/me?fields=id,email,name,first_name,last_name');
			if ($this->facebook_userId) 
				$userInfo = $this->facebook->api('/'.$this->facebook_userId . '?fields=id,email,name,first_name,last_name');			

			//echo "<pre>";
			//print_r($userInfo);
			//echo "</pre>";
			
			if ($sUsername = $userInfo['email']) {
  			  $this->fbhash = '#facebook';
			  SetSessionParam('fbhash', '#facebook');
						  
			  $sName = $userInfo['name'];
			  $sId = $userInfo['email'];//name'];//id'];
			
			  $sSQL = "select id from users WHERE username='{$userInfo['email']}' and active=1 order by id desc LIMIT 1"; //last entry
			  $uret = $db->Execute($sSQL);
		
			  if (!$uret->fields[0]) {
				 
				$fbpass	= md5('!@test@!'.time()); //auto gen password
				  
				//insert facebook user (active by def)	  
				$sSQL = "insert into users (code2,fname,lname,email,username,subscribe,seclevid, password, vpass, active, fb) values ";
				$sSQL.= "('{$sUsername}','{$userInfo['first_name']}','{$userInfo['last_name']}','{$userInfo['email']}','{$userInfo['email']}',1,1, '{$fbpass}','{$fbpass}',1,1)";
				$ret = $db->Execute($sSQL);
							  
				if ($db->Affected_Rows()) {
					if (defined('SHUSERS_DPC'))  
						_m("shusers.mailtohost use $sUsername++".$userInfo['first_name'].'+'.$userInfo['last_name']);
					else	
						_m("cmsusers.mailtohost use $sUsername++".$userInfo['first_name'].'+'.$userInfo['last_name']);
					
				    if (defined('CMSSUBSCRIBE_DPC'))  
						_m('cmssubscribe.dosubscribe use '.$sUsername.'+1');
					
					$this->update_statistics('registration', $sUsername);
				}
				//else
					//return false;		
			  }	
			  else {  
			    //update existed user with facebook data (active by def)
				$sSQL = "UPDATE users set fname='{$userInfo['first_name']}',lname='{$userInfo['last_name']}', active=1, fb=1 WHERE username='{$userInfo['email']}'";
                $uret = false; 				
				$ret = $db->Execute($sSQL);
              } 
              //echo $sSQL;
			  
		      //if (($uret) || ($ret = $db->Affected_Rows())) {
		        //SetGlobal('sFormErr',"ok");
				
			    //if ($this->load_session)
			      // $this->loadSession($sUsername);

			    $GLOBALS['UserID'] = encode($sId);
				SetSessionParam("UserName", encode($sUsername));
				SetSessionParam("UserID", encode($sId));
				SetSessionParam("UserSecID", encode('1'));
				
				if ((defined('SHCUSTOMERS_DPC')))   						  
	                _m('shcustomers.is_reseller');					
				
				//set cookie
				if (paramload('SHELL','cookies')) {
					setcookie("cuser", $sUserName, time()+$this->time_of_session);
					setcookie("csess", session_id(), time()+$this->time_of_session);
				}

				$this->update_login_statistics('fblogin', $sUsername);	
			  //}
			  return true;
            }
            return false;			
		}
        else 
		    SetGlobal('sFormErr',localize('_MSG1',getlocal()));	
		
		return false;
	}
	
    public function do_facebook_logout() {
        $UserName = GetGlobal('UserName');
		$un  = decode($UserName);			

		//$this->saveSession();
		$this->update_login_statistics('fblogout', $un);
		setInfo(localize('_SEEYOU',getlocal()) . " $un");

		//if ($this->is_fb_logged_in()) {
		
			/*$cookie_name = 'fbsr_'. $this->facebook->getAppId();
			$cookie_name2 = 'fbm_'.$this->facebook->getAppId();
			echo $cookie_name.'>'.$cookie_name2;
			unset($_COOKIE[$cookie_name]);
			unset($_COOKIE[$cookie_name2]);*/
		
			$this->facebook->destroySession();	//<<<<<<< not destroyed
			SetSessionParam('fbhash', null);
			SetSessionParam('fbin', null);
		//}			
	  
	    $GLOBALS['UserID'] = null;
		SetSessionParam("UserName", null);
		SetSessionParam("UserID", null);
		SetSessionParam("UserSecID", null);	  

		//zero cookie
		if (paramload('SHELL','cookies')) {
			setcookie("cuser","");
			setcookie("csess","");
		}
	}	
	
	public function do_guest_login($email=null,$name=null,$address=null,$postcode=null,$country=null,$tel=null) {
	    $db = GetGlobal('db');	
		if (!$email) return false;
		
		if (($name) && (strstr($name, ' '))) {
			$p = explode(' ', $name);
			$fname = array_shift($p);
			$lname = implode(' ', $p); //rest array
		}
		else
			$fname = $lname = ($name ? $name : 'unknown');
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			
			$sUsername = $email;
			//$this->fbhash = '#facebook';
			//SetSessionParam('fbhash', '#facebook');
						  
			$sName = $name;
			$sId = $email;
			
			$sSQL = "select id from users WHERE username='{$email}' and active=1 order by id desc LIMIT 1"; //last entry
			$uret = $db->Execute($sSQL);
		
			if (!$uret->fields[0]) {
				 
				$pass = md5('!@test@!' . time()); //auto gen password
				  
				//insert guest user (active by def)	  
				$sSQL = "insert into users (code2,fname,lname,email,username,subscribe,seclevid, password, vpass, active, fb) values ";
				$sSQL.= "('{$sUsername}','{$fname}','{$lname}','{$email}','{$email}',1,1,'{$pass}','{$pass}',1,2)";
				$ret = $db->Execute($sSQL);
							  
				if ($db->Affected_Rows()) {
					if (defined('SHUSERS_DPC'))  
						_m("shusers.mailtohost use $sUsername++".$fname.'+'.$lname);
					else
						_m("cmsusers.mailtohost use $sUsername++".$fname.'+'.$lname);
					//if (defined('CMSSUBSCRIBE_DPC'))  
						//_m('cmssubscribe.dosubscribe use '.$sUsername.'+1');
				
				    //add customer 
					if (defined('SHCUSTOMERS_DPC')) 
						$save = _m("shcustomers.save_guest_customer use $email+$name+$address+$postcode+$country+$tel");
					
				
					$this->update_statistics('registration', $sUsername);
										
				}
				else
					return false;		
			}	
			else {  
				//update existed user 
				/*$sSQL = "UPDATE users set fname='{$fname}',lname='{$lname}', active=1, fb=0 WHERE username='{$email}'";
				$uret = false; 				
				$ret = $db->Execute($sSQL);
				*/ //NOT AN UPDATE (EXISTING VALID USER !!!)
				
				//add customer address
				if (defined('SHCUSTOMERS_DPC')) 
					$save = _m("shcustomers.save_guest_deliveryaddress use $email+$name+$address+$postcode+$country+$tel"); 
					
			}
			
			$GLOBALS['UserID'] = encode($sId);
			SetSessionParam("UserName", encode($sUsername));
			SetSessionParam("UserID", encode($sId));
			SetSessionParam("UserSecID", encode('1'));
					
			//set cookie
			if (paramload('SHELL','cookies')) {
				setcookie("cuser", $sUserName, time()+$this->time_of_session);
				setcookie("csess", session_id(), time()+$this->time_of_session);
			}

			$this->update_login_statistics('login', $sUsername);	

			return true;			
			
		}
        else 
		    SetGlobal('sFormErr',localize('_MSG1',getlocal()));	
		
		return false;
	}	
	
	protected function saveSession() {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');

		$currentses = session_id();
		$currentuser = decode($UserName);
		$session_data = str_replace("\"","<@>",session_encode());
		//echo '>',$session_data;
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

	public function myf_login_logout($link=null,$glue=null) {
	
	    if ($UserID = GetGlobal('UserID')) {
	        $url = _m('cmsrt.url use t=dologout+' . localize('_CMSLOGOUT',getlocal())); 
			$myfb = ($link) ? (($glue) ? '<'.$glue.'>'.$url.'</'.$glue.'>' : $url) :
			                  $this->myf_button(localize('_CMSLOGOUT',getlocal()),'dologout/','_CMSLOGOUT');
	    }
	    else {
		    $url = _m('cmsrt.url use t=login+' . localize('CMSLOGIN_DPC',getlocal())); 
		    $myfb = ($link) ? (($glue) ? '<'.$glue.'>'.$url.'</'.$glue.'>' : $url) :
			                  $this->myf_button(localize('CMSLOGIN_DPC',getlocal()),'login/','_CMSLOGIN');
	    }
	   
	    return ($myfb);
	}
	
	protected function update_login_statistics($id, $user=null) {
		if ($this->userLevelID >= 5) return false;
		
        if (defined('CMSVSTATS_DPC'))	
			return _m('cmsvstats.update_action_statistics use '.$id.'+'.$user);			
		
		return false;
	}
	
	protected function update_statistics($id, $user=null) {
        if (defined('CMSVSTATS_DPC'))	
			return _m('cmsvstats.update_event_statistics use '.$id.'+'.$user);			
		
		return false;
	}	

	//special reg for cp
    protected function register() {
		$db = GetGlobal('db');
		$mode = $_POST['mode'];
		$fname = $_POST['fname'];
		$fn = explode(' ', $fname);
		$uname = $_POST['uname'];
		$pwd = $_POST['pwd'];
		$pwd2 = $_POST['pwd2'];
        $seclevid = $mode ? $mode : '1';

		//extra checks
	    if ((is_numeric($pwd)) && (strlen($pwd)<8)) {
		  $this->formerror = localize('Password does not match the complexity rules',getlocal());
		  SetGlobal('sFormErr',$this->formerror);				
		  return false;			
		}
        else {		
		  if ($pwd!=$pwd2) {
			$this->formerror = localize('Password does not match the confirm password',getlocal());
			SetGlobal('sFormErr',$this->formerror);				
			return false;
		  }		
		
		  if ($this->domain_exists($uname)) {
			$firstname = array_shift($fn);
			$lastname = implode(' ', $fn);
			
			$activ = $this->inactive_on_register ? '0' : '1';
			
            $sSQL = "insert into users (active,code2,fname,lname,username,password,vpass,email,notes,seclevid)" .  
			        " values ($activ," .
				    $db->qstr(addslashes($uname)) . "," . 
                    $db->qstr(addslashes($firstname)) . "," . //first name
			        $db->qstr(addslashes($lastname)) . "," . //rest as last name
                    $db->qstr(addslashes($uname)) . "," . 
                    $db->qstr(md5(addslashes($pwd))) . "," .
                    $db->qstr(md5(addslashes($pwd2))) . ",";

            if ($this->usemailasusername)
                $sSQL .= $db->qstr(addslashes($uname)) . ",";//email = usercode
		    else
                $sSQL .= $db->qstr(addslashes($uname)) . ",";
			
			$notes = ''; 
			
			$sSQL .= $db->qstr($notes) . "," . $seclevid;
	        $sSQL .= ")";
            //echo $sSQL;
            $ret = $db->Execute($sSQL);	 //print_r($ret);

            if ($ret = $db->Affected_Rows()) {
				$this->formerror = localize('ok',getlocal());
				SetGlobal('sFormErr',localize('ok',getlocal()));		

				$this->after_insert_task($uname, $pwd, $firstname, $lastname);
	
				$this->isRegistered = true;
				return true;
			}
			$this->formerror = localize('Error in Db',getlocal());
			SetGlobal('sFormErr',$this->formerror);			
			return false;	
		  }
		}  
		
		$this->isRegistered = false;
		$this->formerror = localize('_mailmxerr',getlocal());
		SetGlobal('sFormErr',$this->formerror);
		
		return false;
	}	

	protected function after_insert_task($username=null,$password=null,$fname=null,$lname=null) {

		//mail registration info to the company
		$this->tell_it = remote_paramload('SHUSERS','tellregisterto',$this->path);
		if ($this->tell_it) {

			$tokens = array();	
			$tokens[] = $username;	
			$tokens[] = $password;	
			$tokens[] = $fname;	
			$tokens[] = $lname;			  					

			$mailbody = _m('cmsrt._ct use userinserttell+' . serialize($tokens));
			$body = str_replace('+','<SYN/>',$mailbody); 
			$ss = remote_paramload('SHUSERS','tellsubject',$this->path);
			$subject = localize($ss, getlocal());
			$mysubject = $subject ? $subject : localize('_UMAILSUBC',getlocal());
			//$this->mailto($this->usemail2send,$this->tell_it,$mysubject,$mailbody);
			$mailerr = _m("cmsrt.cmsMail use {$this->usemail2send}+{$this->tell_it}+$mysubject+$body");
		}	
	  
		//send username/password to user
		$this->it_sendfrom = remote_paramload('SHUSERS','sendusernamefrom',$this->path);
		if ($this->it_sendfrom) {

			$hash = md5('stereobit9networlds8and7the6heart5breakers');
			$sectoken = urlencode(base64_encode($username.'|'.$hash));
			$account_enable_link = _m('cmsrt.seturl use t=useractivate&sectoken=' . $sectoken); //seturl('t=useractivate&sectoken='.$sectoken);

			$tokens = array(); //reset	
			$tokens[] = $username;	
			$tokens[] = $password;
			$tokens[] = $account_enable_link;		  

			$mailbody = _m('cmsrt._ct use userinsert+' . serialize($tokens));
			$body = str_replace('+','<SYN/>',$mailbody); 
			$ss = remote_paramload('SHUSERS','tellsubject',$this->path);
			$subject = localize($ss, getlocal());
			//$this->mailto($this->it_sendfrom,$username,$subject,$mailbody);	  	
			$mailerr = _m("cmsrt.cmsMail use {$this->it_sendfrom}+$username+$subject+$body");
	    }
	  
		if (defined('CMSFORM_DPC'))
			_m('cmsform.subscribe use '.$username);
		
		return true;

	}

	public function setMessage() {
		if (is_array($_POST)) {
			if ($this->isReg()==1)
				$ret = localize('_welcome',getlocal());
			elseif ($this->isLogin()==1)
				$ret = localize('_welcome',getlocal());
			//elseif ($this->isResetPass()==1)
				//$ret = localize('_welcome',getlocal());			
			
			$ret = $this->formerror;
			return $ret;	
		}
		return false;
	}
	
	public function isReg() {
		if ($_POST['uname'] && $this->isRegistered==true) 
			return 1;
		elseif ($_POST['uname'] && $this->isRegistered==false)
			return -1;
		return 0;
	}
	
	public function isLogin() {
		if ($_POST['Username'] && ($this->dologin==true)) 
			return 1;
		elseif ($_POST['Username'] && ($this->dologin==false))
			return -1;
		return 0;
	}

	public function is_logged_in() {
	    if (GetSessionParam('UserID'))
		    return true;

		return false;
	}
	
	public function getUserName() {
	    $UserName = GetGlobal('UserName');	
	    $ret = decode($UserName);
	  
	    return ($ret);
	}		
	
	protected function domain_exists($email, $record = 'MX'){
		list($user, $domain) = explode('@', $email);
		return checkdnsrr($domain, $record);
	} 		
	/*
	public function mailto($from,$to,$subject=null,$body=null) {

		if (defined('SMTPMAIL_DPC')) {
			
			$trackid = $this->get_trackid($from,$to);
			$mbody = $this->add_tracker_to_mailbody($body,$trackid,$to,1);
			
		    $smtpm = new smtpmail;
		    $smtpm->to($to);
			$smtpm->from($from);
			$smtpm->subject($subject);
			$smtpm->body($mbody);
			$mailerror = $smtpm->smtpsend();
			unset($smtpm);
			
			$this->save_outbox($from, $to, $subject, $body, $trackid);

			return ($mailerror);
		}
	}
	
	//send mail to db queue
	protected function save_outbox($from,$to,$subject,$body=null, $trackid=null) {
		$db = GetGlobal('db');		
		$ishtml = 1;
		$origin = 'login'; 
		$datetime = date('Y-m-d h:s:m');
		$active = 0; 	
		
		$sSQL = "insert into mailqueue (timein,timeout,active,sender,receiver,subject,body,origin,cid) ";
		$sSQL .=  "values (" .
			 $db->qstr($datetime) . "," . 
			 $db->qstr($datetime) . "," . 
			 $active . "," .
		     $db->qstr(strtolower($from)) . "," . 
			 $db->qstr(strtolower($to)) . "," .
		     $db->qstr($subject) . "," . 
			 $db->qstr($body) . "," .
			 $db->qstr($origin) . "," .			 
			 $db->qstr($trackid) . ")";
			 		
		$result = $db->Execute($sSQL,1);			 

		return (true);			 
	}	
	
	protected function add_tracker_to_mailbody($mailbody=null,$id=null,$receiver=null,$is_html=false) {
		if (!$id) return;
		$i = $id;
	
		if ($receiver) {
			$r = $receiver;
			$ret = "<img src=\"{$this->mtrackimg}?i=$i&r=$r\" border=\"0\" width=\"1\" height=\"1\"/>";
		}
		else
			$ret = "<img src=\"{$this->mtrackimg}?i=$i\" border=\"0\" width=\"1\" height=\"1\"/>";
		 
		if (($is_html) && (stristr($mailbody,'</BODY>'))) {
			if (strstr($mailbody,'</BODY>'))
				$out = str_replace('</BODY>',$ret.'</BODY>',$mailbody);
			else  
				$out = str_replace('</body>',$ret.'</body>',$mailbody);
		}	 
		else
			$out = $mailbody . $ret;	 	 
		 
		return ($out);	 
	}	

	protected function get_trackid($from,$to) {
	
		$i = rand(100000,999999);//++$m;	 
		$tid = date('YmdHms') .  $i . '@' . $this->appname;
		 
		return ($tid);	
	}	
	*/
	public function recaptcha() {
		
		if ((defined('RECAPTCHA_DPC')) && ($this->recaptcha==true)) {
	        $recaptcha = recaptcha_get_html($this->recaptcha_public_key, null, $this->ssl);	   
			return $recaptcha;
	    }
		//else
			//die(_m('cmsrt.captchaImage'));
		
		return false;
	}		
   
	protected function valid_recaptcha() {
	 
	    if ((defined('RECAPTCHA_DPC')) && ($this->recaptcha==true)) { 

			if ($_POST["recaptcha_response_field"]) {
				$resp = recaptcha_check_answer ($this->recaptcha_private_key,
												$_SERVER["REMOTE_ADDR"],
												$_POST["recaptcha_challenge_field"],
												$_POST["recaptcha_response_field"]);
											
				if ($resp->is_valid) {
					$error = null;//echo "You got it!";
					$ret = true;
				} 
				else {
					// set the error code so that we can display it
					$error = $resp->error;
					$ret = false;
					$msg = "Incorrect recaptcha entry!";				
				}
			}
			else {
				$ret = false;
				$msg = "Recaptcha entry required!";			  
			}
		  
			$this->formerror = $msg;
			SetGlobal('sFormErr',$msg);
		}
		else
			$ret = _m('cmsrt.valid_captcha');
		  
		return ($ret);																			 
    }   	
	
};
}
?>