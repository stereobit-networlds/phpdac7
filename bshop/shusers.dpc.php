<?php
$__DPCSEC['SHUSERS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if (!defined("SHUSERS_DPC")) {
define("SHUSERS_DPC",true);

$__DPC['SHUSERS_DPC'] = 'shusers';

$a = GetGlobal('controller')->require_dpc('cms/cmsusers.dpc.php');
require_once($a);
 
$__EVENTS['SHUSERS_DPC'][0]='shusers';
$__ACTIONS['SHUSERS_DPC'][0]='shusers';
GetGlobal('controller')->get_parent('CMSUSERS_DPC','SHUSERS_DPC');

$__DPCATTR['SHUSERS_DPC']['shusers'] = 'shusers,1,0,0,0,0,0,0,0,1,1,1,1';

$__LOCALE['SHUSERS_DPC'][0]='SHUSERS_DPC;Login;Login';

class shusers extends cmsusers {
   
	var $includecusform, $continue_register_customer, $predef_customer;
	var $check_existing_customer, $map_customer, $customer_exist_id;	
	var $customer_sec, $unknown_sec, $leeid, $atok;
	
	public function __construct() {
		
		cmsusers::__construct();
		
		$this->continue_register_customer = remote_paramload('SHUSERS','continueregcus',$this->path);		
		$this->customer_sec = remote_paramload('SHUSERS','ifcustomer',$this->path);		
		$this->atok = remote_paramload('SHUSERS','atok',$this->path);
		$this->leeid = remote_paramload('SHUSERS','leeid',$this->path);
		$cusform = remote_paramload('SHUSERS','includecusform',$this->path); 
		$this->includecusform = $cusform ? true : false;

		$this->check_existing_customer = remote_paramload('SHCUSTOMERS','checkexist',$this->path);
		$this->map_customer = null;
		$this->customer_exist_id = null;
		$this->predef_customer = null;	
		
		//override
		$this->it_sendfrom = remote_paramload('SHUSERS','sendusernamefrom',$this->path);
		$this->usemailasusername =  remote_paramload('SHUSERS','usemailasusername',$this->path);
		$this->usemail2send =  remote_paramload('SHUSERS','usemail2send',$this->path);
		$this->tell_it = remote_paramload('SHUSERS','tellregisterto',$this->path);		
		$this->tell_subject = remote_paramload('CMSUSERS','tellsubject',$this->path);
		$this->usrform = remote_arrayload('SHUSERS','usrform',$this->path);		   
		$this->usrformtitles = remote_arrayload('SHUSERS','usrformtitles',$this->path);		
		$this->checkuseasterisk = remote_paramload('SHUSERS','checkasterisk',$this->path);		
		$this->deny_multiple_users = remote_paramload('SHUSERS','denymultuser',$this->path);
		$this->inactive_on_register = remote_paramload('SHUSERS','inactive_on_register',$this->path);	   
		$this->stay_inactive = remote_paramload('SHUSERS','stay_inactive',$this->path); 
		
	   	//override security
		$this->unknown_sec = remote_paramload('SHUSERS','else',$this->path);
		$this->security = $this->unknown_sec ? $this->unknown_sec : 0; //default

	}
   
	public function event($event=null) {

		switch ($event) {
			
			case "insertajax":
            case "insert"	: 	$this->insertExt();
								$this->jsBrowser(); 
								break;			
			
			case 'update'   :			
			case 'delete'   :
			case 'signup'   :   $this->jsBrowser(); //break;
			default 		: 	cmsusers::event($event);
		}
	}
   
	public function action($action=null) {

		switch ($action) {		
		
			case 'signup'    :  $out = $this->register(); 
								break;
								
			default          :	$out = cmsusers::action($action);
		}	
		
		return ($out);
	}
	
	protected function jsBrowser() {
		
		$code = $this->jsUser();		
		   
		if ($code) {
			$js = new jscript;	
			$js->load_js($code,null,1);		
			unset ($js);
		}
	}

	protected function jsUser() {
		$mobileDevices = _m('cmsrt.mobileMatchDev');
		
		$code = "
	if (/{$mobileDevices}/i.test(navigator.userAgent)) 
		window.scrollTo(0,parseInt($('#checkout-page').offset().top, 10));
	else {		
		gotoTop('checkout-page');	
	
		$(window).scroll(function() { 
			if (agentDiv('checkout-page')) {
				$.ajax({ url: 'jsdialog.php?t=jsdcode&id=user&div=signup', cache: false, success: function(jsdialog){
					eval(jsdialog);		
				}})	
			}	
		});
	}		
";
		
		return ($code);
	}

	protected function checkFieldsJs($err=null, $title=null) {
			
		$code = "
	new $.Zebra_Dialog('$err', {'type':'error','title':'$title'});";
		
		$js = new jscript;	
		$js->load_js($code,null,1);			   
		unset ($js);
	}		
	
	protected function insertExt() {

		if ((defined('SHCUSTOMERS_DPC')) && ($this->includecusform)) {
				
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
			   
			//user check  
			$checkusrerr = $this->checkFields(null,$this->checkuseasterisk);
			//echo 'errors:',$checkusrerr,'|',$checkcuserr;
							 
			if ((!$checkusrerr) && (!$checkcuserr))  {		
				//echo 'e>';
				$ret = $this->insert_with_customer();							  		
				return ($ret);	
			} 
			else
				$this->checkFieldsJs($checkusrerr);// . $checkcuserr);
							 
		}//not include cus form
		else {	
			//parent::insert();		//DISABLED PARTS
			$ret = $this->insert();
			return ($ret);
		}

		return false;	
	}
	
	//override
	protected function insert() {
		$db = GetGlobal('db');
		$sFormErr = GetGlobal('sFormErr');
		$seclevid = $this->security ? $this->security : '0';  	   

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

					$this->after_insert_task($user_code,GetParam("pwd"),GetParam("fname"),GetParam("lname"));//send code to customer
		   
					//INCLUDE CUSTOMER DATA TO MIX IN ONE FORM..SQL EXECUTE USER AND CUS QUERY... 
					if ($this->includecusform) {		
						$sFormErr = _m('shcustomers.subinsert use '.$user_code);
						SetGlobal('sFormErr',$sFormErr);	   
					}
					//////////////////////////////////////////////////////////////////////////		   
					return true;
				}
				else {
					$ret = $db->ErrorMsg();
					SetGlobal('sFormErr',localize('_MSG20',getlocal()).' #2');
				}
			}
		}
		else
			$this->checkFieldsJs($err);
		
		return false;	
	}	
	
	protected function insert_with_customer() {
		$db = GetGlobal('db');
		$sFormErr = GetGlobal('sFormErr');
		$seclevid = $this->security ? $this->security : '0';   

		$user_code = $this->pre_insert_task();	
		//echo '+',$user_code;
	   
		if (!$user_code) {
			SetGlobal('sFormErr',localize('_MSG21',getlocal()).' #3');
			return false;	   
		}	
	   
		//save it to restore if 2nd step exist to insert custime and to connect
		SetSessionParam('new_user_code',$user_code); 

		if ($un = $this->username_exist()) {
			SetGlobal('sFormErr', localize('_MSG17',getlocal()) . ' ' . $un);
		}
		else {	 
			//start map procedure
			$map_customer = null;
	     
			//echo '>',$this->check_existing_customer;
			if ($this->check_existing_customer) {
				if ($this->map_customer===true)//map a customer
					$sFormErr = 'ok';
				elseif ($this->map_customer===false)//already mapped error	 
					$sFormErr = 'Customer is already mapped!';//will not be shown just err...
				else //is null = new customer	 
					$sFormErr = _m('shcustomers.subinsert use '.$user_code.'+1');
			}
			else //register new customer
				$sFormErr = _m('shcustomers.subinsert use '.$user_code.'+1');
		 
			if ($sFormErr=='ok') {//start user registartion
		
				$activ = $this->inactive_on_register ? '0' : '1';	
				  
				//$code2 = $this->leeid;//?$this->leeid:$code; echo $code;
				$sSQL = "insert into users (active,code2,fname,lname,username,password,vpass,email,CNTRYID,LANID,AGEID,GENID,timezone,notes,fb";

				if (seclevel('USERSMNG_',$this->userLevelID)) {
					$sSQL .= ",STARTDATE,IPINS,IPUPD,LASTLOGON,SECPARAM,SESID,SECLEVID";
				}
				else {
					$sSQL .= ",SECLEVID"; //only security
				}

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
				
				$notes = '';

				$sSQL .= GetParam("country_id")  ? (GetParam("country_id") . ",") : "0,";
				$sSQL .= GetParam("language_id") ? (GetParam("language_id") . ",") : "0,";
				$sSQL .= GetParam("age")         ? (GetParam("age") . ",") : "0,";
				$sSQL .= GetParam("gender")      ? (GetParam("gender") . ",") : "0,";
				$sSQL .= GetParam("timezone")    ? ($db->qstr(GetParam("timezone"))) : "'',";				
				$sSQL .= "'$notes',0";

				if (seclevel('USERSMNG_',$this->userLevelID)) {
					$sSQL .= ",";
					$sSQL .= GetParam("dcreate") ? GetParam("dcreate") . "," : date('Y-m-d') . ",";
					$sSQL .= $db->qstr(GetParam("ipins")) . ",";
					$sSQL .= $db->qstr(GetParam("ipupd"))  . ",";
					$sSQL .= $db->qstr(GetParam("llogin")) . ",";
					$sSQL .= $db->qstr(GetParam("sparam")) . ",";
					$sSQL .= $db->qstr(GetParam("sesid"))  . ",";
					$sSQL .= GetParam("seclevid") ;
				}
				else {
					$sSQL .= "," . $seclevid ;//only security automated (predefined customer)
				}

				$sSQL .= ")";
				//echo $sSQL;
				$ret = $db->Execute($sSQL);	 

				if ($ret = $db->Affected_Rows()) {
					//map procedure cntinue after user registration
					if (($this->check_existing_customer) && ($this->map_customer===true)) {
						//echo 'user code:',$user_code;
						$map = _m('shcustomers.map_customer use '.$user_code.'+'.$this->customer_exist_id);
					}
					
					$this->update_statistics('registration', $user_code);
		 
					SetGlobal('sFormErr',"ok");
					$this->after_insert_task($user_code,GetParam("pwd"),GetParam("fname"),GetParam("lname"));//send code to customer	   
					return true;
				}
				else {
					//rollback
					//delete inserted customer.....
					if ((!$this->check_existing_customer) && ($this->map_customer===null)) //if NOT map procedure
						$rollback = _m('shcustomers.subdelete use '.$user_code);
		 
					$ret = $db->ErrorMsg();
					//echo $ret;
					SetGlobal('sFormErr',localize('_MSG20',getlocal()).' #4');
				}
			}	
	    }//if customer inserted
		
		return false;	
	} 
	
	
	//override
	protected function register($myuser=null,$myfkey=null,$selectid=null,$cmd=null) {
		$UserName = GetGlobal('UserName');
        $user = decode($UserName);
	    $sFormErr = GetGlobal('sFormErr');
	    $a = GetReq($selectid) ? GetReq($selectid) : GetReq('a');
	    $mycmd_update = $cmd ? $cmd : 'update';	   

        if ($sFormErr=="ok") {

			SetGlobal('sFormErr',"");

			$myaction = GetGlobal('controller')->getqueue(); //echo $myaction,"<><><><";
			switch ($myaction) {

				case "insert":  $out = $this->after_registration_goto(); break;
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

				//VIEW CUSTOMER LISTS
				if (defined('SHCUSTOMERS_DPC')) {
					//$out .= _m('shcustomers.addcustomerform');	  
					//$out .= _m('shcustomers.show_customer_delivery');  				 
					$out .= _m('shcustomers.show_customers_list');	  
		        }
		   }
	   }

	   return ($out);
	}
	
	protected function after_registration_goto() {
	    $sFormErr = GetGlobal('sFormErr');	
	
        if ($this->predef_customer) {//repdefined customer
			$out .= $this->predef_customer . "<h4>".$this->atok."</h4>";	
	    }
	    elseif ($this->includecusform) {//customer has submited with user form
			if ( (defined('SHCART_DPC')) && (seclevel('SHCART_DPC',$this->userLevelID)) ) {
			    $out .= _m('shcustomers.after_registration_goto');
			}
			elseif (defined('SHLOGIN_DPC')) { 
			    $out .= _m('shlogin.html_form');
		    }
			elseif (defined('CMSLOGIN_DPC')) {
				$out .= _m('cmslogin.html_form');
			}	
	    }
	    else {//goto customer registration
       
		    if ((defined('SHCUSTOMERS_DPC')) && 
				($this->continue_register_customer) ) {
				//find id......
				$this->new_user_id = _m('shcustomers.getmaxid')+1;
                $out .= _m('shcustomers.register use '.$this->new_user_id);
		    }	  
			elseif ( (defined('SHLOGIN_DPC')) ) {
			    $out .= _m('shlogin.html_form');
			}	
		    elseif ( (defined('CMSLOGIN_DPC')) ) {
			    $out .= _m('cmslogin.html_form');
		    }
		    else //continue rendering
				$out .= '';	 
	    }	
						   				   
						   
	    return ($out);
	}	
	
	//override
	protected function after_update_goto() {
	    $myaction = GetParam('FormAction');

	    if (GetGlobal('UserID'))  {
	      
			if ($myaction=='update') {//user
				$out .= $this->register();
			}
			elseif ($myaction=='update2')  {
				if (defined('SHCUSTOMERS_DPC'))   
					$out .= _m('shcustomers.register');		   
			}
	    }	
	   
	    return ($out);
	}	
	
	
	//override
	protected function pre_insert_task($preset=null) {
		$a = GetParam('fname');
		$b = GetParam('lname');	
		$c = GetParam('uname');		  
	          
		if ($this->usemailasusername) {
			if ($this->_checkmail($c))
				$genun = strtolower(trim($c)); //string = code of cus
			else
				return null;  
		}	 
		else { //find predef customer
			$genun = $this->find_predefined_customer(); //number=code2 of cus	 
       
			//CHECK
			//default username = the combination of fname (as inserted by user) plus lname=job title
			//else if is customer this function return leeid of customer where is the username
			if (!$genun)	{
				if ($preset)
					$genun = $preset;
				else  
					$genun = $a.' '.$b; //combine fisrt last name
			}	
		} 
		 
		//echo '>'.$genun;	 
		return ($genun);
	}

	//override
	//check if the registered user is a valid sen user and if it is return his leeid
	//preset is used to pass lanme+fname as default username	
	protected function find_predefined_customer() {
	    $a = GetParam('fname');
	    $b = GetParam('lname');	
	
        //SEN SUPPORT : get customer data or register new customer
        if ( (defined('SHCUSTOMERS_DPC')) && (seclevel('SHCUSTOMERS_DPC',$this->UserLevelID)) ) {

			$WSQL = "NAME='$a' AND PRFDESCR='$b'";//PRFDESCR='$b'";

			$leeid = _m('shcustomers.search_customer_id use '.$WSQL);
			//echo "LEEID:",$leeid;
			if ($leeid) {
				$this->predef_customer = _m('shcustomers.showcustomerdata use '.$leeid);

				//overwrite default user leeid
				$this->leeid = $leeid;
				//set security param
				$this->security = $this->customer_sec; //customer sec id
				//return leeid as username
				return ($leeid);
			}
	    }
	   
	    return null;	
	}	

	//override
    public function regform($fields='',$cmd=null,$isupdate=null,$isadmin=null,$nodelivery=null,$noinvtype=null,$noincludecusform=null) {
		$UserName = GetGlobal('UserName');
		$sFormErr = GetGlobal('sFormErr');
		$myinvtype = GetParam('invtype');
		
		//readonly username field when update
		$is_update = $UserName ? true : false; 
		if ($is_update)	$readonly = 'READONLY';	   
	   
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
		//echo $myinvtype,'>',$invtype,'>',$delivery;

		$_t = ($isupdate) ? 'usrupdate' . $delivery . $myinvoice : 
							'usrregister' . $delivery . $myinvoice;	   
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
	   
        if (!$this->usemailasusername) 
	        $tokens[] = "<input type=\"text\" class=\"myf_input\" name=\"eml\" maxlength=\"55\" value=\"" . ToHTML($eml) . "\" size=\"25\" >";
	   
	   
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
		else
		    $tokens[] = $invtypedescr;//$myinvtype ? 'B' : 'A'; /*inv type title*
		
		//print_r($tokens);					
		$ret = $this->combine_tokens($mytemplate,$tokens);

		return ($ret);			  
	}	
	
	
	public function get_cus_type($id,$field='username',$istext=1) {
        $db = GetGlobal('db');
		$mycode = $field;

	    $sSQL = "select attr1,username from customers,users where $mycode=";
		
		switch ($istext) {
		  case 1 : $sSQL .= $db->qstr($id); break;
		  case 0 :
		  default: $sSQL .= $id;
		}
		
		$sSQL .= " and customers.code2=users.code2";
		$ret = $db->Execute($sSQL,2);
		
		return ($ret->fields[0]);		
	}	
	
	public function get_cus_name() {
        $db = GetGlobal('db');
		$UserName = GetGlobal('UserName');		
		$user = decode($UserName);

	    $sSQL = "select name,username from customers,users where users.code2=" . $db->qstr($user);
		$sSQL .= " and active=1 and customers.code2=users.code2";
		$res = $db->Execute($sSQL,2);
		
		//incase of no mapped customer get username
		$name = $res->fields['name'] ? $res->fields['name'] : $user;
		
		//$nk = seturl('t=signup');//addnewcus&select=1');
		$ret = "<a href='signup/'>" . $name . "</a>";
		return ($ret);		
	}	
	
	//when no customer (fbuser) get fname_lname as fullname descr
	public function getFullname($userid=null) {
        $db = GetGlobal('db');
		$UserName = GetGlobal('UserName');		
		$user = $userid ? $userid : decode($UserName);

	    $sSQL = "select fname,lname from users where username=" . $db->qstr($user);
		//$sSQL .= " and active=1";
		$res = $db->Execute($sSQL);
		
		$ret = $res->fields[0] . ' ' . $res->fields[1];
		
		return ($ret);		
	}

	/*get rec id of active customer use for edit */
	public function get_cus_id() {
        $db = GetGlobal('db');
		$UserName = GetGlobal('UserName');		
		$user = decode($UserName);

	    $sSQL = "select id from customers where active=1 and code2=" . $db->qstr($user);
		$res = $db->Execute($sSQL,2);
		
		return ($res->fields['id']);		
	}

	/*get update data of active customer */
	public function get_cus_lastupdate() {
        $db = GetGlobal('db');
		$UserName = GetGlobal('UserName');		
		$user = decode($UserName);

	    $sSQL = "select timeupd from customers where active=1 and code2=" . $db->qstr($user);
		$res = $db->Execute($sSQL,2);
		
		return ($res->fields['timeupd']);		
	}	
   
};
}
?>