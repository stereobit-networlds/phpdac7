<?php
$__DPCSEC['SHCUSTOMERS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

$__DPCSEC['CUSTOMERSMNG_']='2;1;2;2;2;2;2;2;9;9;9';
$__DPCSEC['DELETECUSTOMER_']='2;1;1;1;1;1;1;2;9;9;9';
$__DPCSEC['UPDATECUSTOMER_']='2;1;2;2;2;2;2;2;9;9;9';
$__DPCSEC['INSERTCUSTOMER_']='1;1;1;1;1;1;2;2;9;9;9';//allow insert after user register
$__DPCSEC['SEARCHCUSTOMER_']='2;1;1;1;1;1;2;2;9;9;9';

if ((!defined("SHCUSTOMERS_DPC")) && (seclevel('SHCUSTOMERS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("SHCUSTOMERS_DPC",true);

$__DPC['SHCUSTOMERS_DPC'] = 'shcustomers';

$__EVENTS['SHCUSTOMERS_DPC'][0]='signup2';
$__EVENTS['SHCUSTOMERS_DPC'][1]='insert2';
$__EVENTS['SHCUSTOMERS_DPC'][2]='update2';
$__EVENTS['SHCUSTOMERS_DPC'][3]='delete2';
$__EVENTS['SHCUSTOMERS_DPC'][4]='searchcustomer';
$__EVENTS['SHCUSTOMERS_DPC'][5]='addnewdeliv';
$__EVENTS['SHCUSTOMERS_DPC'][6]='removedeliv';
$__EVENTS['SHCUSTOMERS_DPC'][7]='savenewdeliv';
$__EVENTS['SHCUSTOMERS_DPC'][8]='addnewcus';
$__EVENTS['SHCUSTOMERS_DPC'][9]='removecus';
$__EVENTS['SHCUSTOMERS_DPC'][10]='savenewcus';
$__EVENTS['SHCUSTOMERS_DPC'][11]='selcus';
$__EVENTS['SHCUSTOMERS_DPC'][12]='inscus';
$__EVENTS['SHCUSTOMERS_DPC'][13]='mapcus';

$__ACTIONS['SHCUSTOMERS_DPC'][0]='signup2';
$__ACTIONS['SHCUSTOMERS_DPC'][1]='insert2';
$__ACTIONS['SHCUSTOMERS_DPC'][2]='update2';
$__ACTIONS['SHCUSTOMERS_DPC'][3]='delete2';
$__ACTIONS['SHCUSTOMERS_DPC'][4]='searchcustomer';
$__ACTIONS['SHCUSTOMERS_DPC'][5]='addnewdeliv';
$__ACTIONS['SHCUSTOMERS_DPC'][6]='removedeliv';
$__ACTIONS['SHCUSTOMERS_DPC'][7]='savenewdeliv';
$__ACTIONS['SHCUSTOMERS_DPC'][8]='addnewcus';
$__ACTIONS['SHCUSTOMERS_DPC'][9]='removecus';
$__ACTIONS['SHCUSTOMERS_DPC'][10]='savenewcus';
$__ACTIONS['SHCUSTOMERS_DPC'][11]='selcus';
$__ACTIONS['SHCUSTOMERS_DPC'][12]='inscus';
$__ACTIONS['SHCUSTOMERS_DPC'][13]='mapcus';

$__LOCALE['SHCUSTOMERS_DPC'][0]='_TITLE;Title;Επωνυμία';
$__LOCALE['SHCUSTOMERS_DPC'][1]='afm;VAT No;Α.Φ.Μ.;';
$__LOCALE['SHCUSTOMERS_DPC'][2]='prfdescr;Job Title;Επαγγελμα';
$__LOCALE['SHCUSTOMERS_DPC'][3]='address;Address 1;Διεύθυνση';
$__LOCALE['SHCUSTOMERS_DPC'][4]='_POBOX1;Post code 1;Τ.Κ.';
$__LOCALE['SHCUSTOMERS_DPC'][5]='_ADDR2;Address 2;Διεύθυνση Παράδοσης';
$__LOCALE['SHCUSTOMERS_DPC'][6]='_POBOX2;P.O. Box 2;Τ.Κ. Παράδοσης';
$__LOCALE['SHCUSTOMERS_DPC'][7]='voice1;Phone;Τηλέφωνο';
$__LOCALE['SHCUSTOMERS_DPC'][8]='fax;Fax;Fax';
$__LOCALE['SHCUSTOMERS_DPC'][9]='_SIGNUP;SignUp;Εγγραφή';
$__LOCALE['SHCUSTOMERS_DPC'][10]='_UPDATE;Update;Ενημέρωση';
$__LOCALE['SHCUSTOMERS_DPC'][11]='_DELETE;Delete;Διαγραφή';
$__LOCALE['SHCUSTOMERS_DPC'][12]='_MSG10;Successfull registration!;Επιτυχής καταχώρηση!';
$__LOCALE['SHCUSTOMERS_DPC'][13]='_MSG11;is required;είναι απαραίτητο';
$__LOCALE['SHCUSTOMERS_DPC'][14]='_MSG12;The field;Το στοιχείο';
$__LOCALE['SHCUSTOMERS_DPC'][15]='_ACCDENIED;Access denied;Απαγορευμένη πρόσβαση';
$__LOCALE['SHCUSTOMERS_DPC'][16]='_EFORIA;Tax department;Δ.Ο.Υ.';
$__LOCALE['SHCUSTOMERS_DPC'][17]='_SEARCHCUST;Searchin;Ευρεση';
$__LOCALE['SHCUSTOMERS_DPC'][18]='_SEARCHRES;Results;Αποτελέσματα Αναζήτησης';
$__LOCALE['SHCUSTOMERS_DPC'][19]='_CUSTLIST;Customers;Πελάτες';
$__LOCALE['SHCUSTOMERS_DPC'][20]='code2;Code;Κωδικός';
$__LOCALE['SHCUSTOMERS_DPC'][21]='eforia;VAT area;ΔΟΥ';
$__LOCALE['SHCUSTOMERS_DPC'][22]='area;Area;Περιοχή';
$__LOCALE['SHCUSTOMERS_DPC'][23]='zip;Zip;Τ.Κ.';
$__LOCALE['SHCUSTOMERS_DPC'][24]='voice2;Phone 2;Τηλέφωνο';
$__LOCALE['SHCUSTOMERS_DPC'][25]='mail;e-mail;Ηλ. Ταχυδρομείο';
$__LOCALE['SHCUSTOMERS_DPC'][26]="_MSG20;Record not affected;Η εγγραφή δεν καταχωρήθηκε.";
$__LOCALE['SHCUSTOMERS_DPC'][27]='name;Name;Επωνυμια';
$__LOCALE['SHCUSTOMERS_DPC'][28]='_UNKNOWNENTRY;WARNING:You are not an official registrated customer, please insert your details below and we will contact you as soon as possible.<br> You can not use our site advance services !;ΠΡΟΣΟΧΗ: Δεν ειστε έγκυρος πελάτης της εταιρείας μας και δεν θα έχετε δικαίωμα παραγγελίας,αν είστε νέος πελατης συμπληρωστε τα παρακατω στοιχεια διαφορετικα επικοιωνήστε τηλεφωνικώς με την εταιρεια μας!';
$__LOCALE['SHCUSTOMERS_DPC'][29]='_UMAILSUBC;New customer;Νέος πελάτης';
$__LOCALE['SHCUSTOMERS_DPC'][30]='_INVOICE;Invoice;Τιμολόγιο';
$__LOCALE['SHCUSTOMERS_DPC'][31]='_APODEIXI;Receipt;Αποδειξη';
$__LOCALE['SHCUSTOMERS_DPC'][32]='_DELIVADDRESS;Delivery Address;Παράδοση σε αλλη διευθυνση';
$__LOCALE['SHCUSTOMERS_DPC'][33]='_ADDDELIVADDRESS;Add Address;Νέα διεύθυνση';
$__LOCALE['SHCUSTOMERS_DPC'][34]='_REMDELIVADDRESS;Remove;Διαγραφή';
$__LOCALE['SHCUSTOMERS_DPC'][35]='_SELDELIVADDRESS;Select;Επιλογή';
$__LOCALE['SHCUSTOMERS_DPC'][36]='_DEFDELIVADDRESS;Default;Βασική';
$__LOCALE['SHCUSTOMERS_DPC'][37]='_INVALIDMAIL;Invalid e-mail address;Ακυρη ηλεκτρονικη διεύθυνση';
$__LOCALE['SHCUSTOMERS_DPC'][38]='_CUSTOMER;Pay Detail;Πελάτης';
$__LOCALE['SHCUSTOMERS_DPC'][39]='_CUSTOMERSLIST;Pay Details\'s;Στοιχεια τιμολογιου';
$__LOCALE['SHCUSTOMERS_DPC'][40]='_ADDCUSTOMER;Add Pay Details;Προσθήκη';
$__LOCALE['SHCUSTOMERS_DPC'][41]='_DEFCUSTOMER;Default Detail;Βασικός';
$__LOCALE['SHCUSTOMERS_DPC'][42]='_REMCUSTOMER;Remove Detail;Διαγραφή';
$__LOCALE['SHCUSTOMERS_DPC'][43]='_SELCUSTOMER;Select Detail;Επιλογή';
$__LOCALE['SHCUSTOMERS_DPC'][44]='_UPDCUSTOMER;Edit Detail;Μεταβολή';
$__LOCALE['SHCUSTOMERS_DPC'][45]='_CUSTEXISTS;Customer exists. Already registered!;Είστε ήδη καταχωρημενος!';
$__LOCALE['SHCUSTOMERS_DPC'][46]='_OK;Submit;Αποστολή';
$__LOCALE['SHCUSTOMERS_DPC'][47]='_DELNOTALLOW;Delete not allowed;Η διαγραφή δεν είναι επιτρεπτή';
$__LOCALE['SHCUSTOMERS_DPC'][48]='CustomerRegistration;Customer registration;Εγγραφή πελάτη';
$__LOCALE['SHCUSTOMERS_DPC'][49]='CustomerInsData;Customer details added;Εισαγωγή στοιχείων πελάτη';
$__LOCALE['SHCUSTOMERS_DPC'][50]='CustomerUpdData;Customer details updated;Μεταβολή στοιχείων πελάτη';
$__LOCALE['SHCUSTOMERS_DPC'][51]="_MSG21;Record not affected;Πρόβλημα κατά την αποθήκευση.";

class shcustomers {
	var $userLevelID;
	var $username;
	var $userid;
	var $T_customers;
	var $selectedfields;
	var $fields;
	var $msg;

	var $recfields;
	var $maxcharfields;
	var $searchres;

	var $fkey; //=foreign key to second db
	var $mailkey; //mail key
	var $tellit, $it_sendfrom, $usemailasusername;
	var $urlpath, $inpath;
	var $cusform, $cusform2, $unknown_customer_msg, $atok;
	var $invtype, $allow_inv_selection;
	var $mydelivery_address, $delivery_fields, $delivery_goto_url, $adddelivgoto, $delivok;
	var $is_reseller, $error, $checkuseasterisk,$asterisk;
	var $cusok, $addcusgoto, $reseller, $reseller_attr;
	var $check_exist, $customer_exist_id;
	var $rewrite; 
	
	static $staticpath, $myf_button_class, $myf_button_submit_class;	
	
	//var $appname, $mtrackimg;	

	public function __construct() {
		$UserSecID = GetGlobal('UserSecID');
		$sFormErr = GetGlobal('sFormErr');
		$UserName = GetGlobal('UserName');
		$UserID = GetGlobal('UserID');
		$this->path = paramload('SHELL','prpath');
	   
		$this->urlpath = paramload('SHELL','urlpath');
		$this->inpath = paramload('ID','hostinpath');
	   
		self::$staticpath = paramload('SHELL','urlpath');	   

		//$this->userLevelID = decode($UserSecID);
		$this->userLevelID = (((decode(GetSessionParam('UserSecID')))) ? (decode(GetSessionParam('UserSecID'))) : 0);
		$this->username = decode($UserName);
		$this->userid = decode($UserID);
		$this->msg = $sFormErr;

		//select fields from table to get
		$this->selectedfields = remote_arrayload('SHCUSTOMERS','select',$this->path);
		$this->fieldalias = remote_arrayload('SHCUSTOMERS','selectalias',$this->path);
		//print_r($this->selectedfields);

		$this->fkey = remote_paramload('SHCUSTOMERS','fkey',$this->path);
		$this->mkey = remote_paramload('SHCUSTOMERS','mailkey',$this->path);
		$this->tellit = remote_paramload('SHCUSTOMERS','sendmailto',$this->path);
		$this->it_sendfrom = remote_paramload('SHCUSTOMERS','sendfrom',$this->path);
		$this->usemailasusername =  remote_paramload('SHCUSTOMERS','usemailasusername',$this->path);
	   
		//subform fields array
		$this->cusform =  remote_arrayload('SHCUSTOMERS','cusform',$this->path);
		$this->cusform2 =  remote_arrayload('SHCUSTOMERS','cusform2',$this->path);	   
		//unknown cus message 
		$this->unknown_customer_msg = remote_paramload('SHCUSTOMERS','unknowncusmsg',$this->path);	 
		//moved from users  
		$this->atok = remote_paramload('SHCUSTOMERS','atok',$this->path);	
	   
		$this->checkuseasterisk = remote_paramload('SHCUSTOMERS','checkasterisk',$this->path);	 
		$this->asterisk = $this->checkuseasterisk?'&nbsp;':'*'; 	
		$this->error = null;	   
	   
		$this->is_reseller = GetSessionParam('RESELLER');	
		$this->allow_inv_selection = remote_paramload('SHCUSTOMERS','invselect',$this->path);	   
		$definvval = remote_paramload('SHCUSTOMERS','invtype',$this->path);
		//echo $this->is_reseller,'>';
	   
		$invt = GetReq('invtype'); //echo $invt,'>';
		$invtses = GetSessionParam('invway');	   
		if ($invt) {
			SetSessionParam('invtype',$invt);
			$this->invtype = $invt;
		}	
		elseif (isset($invtses)) //cart selection is string???
			$this->invtype = $definvval;//$invtses;//?????	   
		else 
	     $this->invtype = $definvval; //no type of cyustomer 9reseller in this phase/($this->is_reseller)?1:1;//$definvval;
		//echo '+',$this->invtype,'+';		 	 
	   
		$delivaddress = remote_paramload('SHCUSTOMERS','deliveryaddress',$this->path);
		$this->mydelivery_address = $delivaddress?$delivaddress:0;  
	   
		$deliveryfields = remote_arrayload('SHCUSTOMERS','delivform',$this->path);	
		if (empty($deliveryfields))
			$this->delivery_fields = array('address','area','zip','country','voice1','voice2','fax','mail');	   
		else
			$this->delivery_fields = (array) $deliveryfields;
		 
		$this->delivery_goto_url = "t=viewcart&status=1";
		$this->adddelivgoto = remote_paramload('SHCUSTOMERS','adddelivgoto',$this->path);
		$this->delivok = false;
	   	   
		$this->customer_goto_url = "t=viewcart&status=1";
		$this->addcusgoto = remote_paramload('SHCUSTOMERS','adddelivgoto',$this->path);	   
		$this->cusok = false;	
	   
		$r_attr = remote_paramload('SHCUSTOMERS','reseller',$this->path);
		if (stristr($r_attr,',')) //multiple attr
			$this->reseller_attr = (array) remote_arrayload('SHCUSTOMERS','reseller',$this->path);	 	   	 
		else
			$this->reseller_attr = $r_attr;
 
		$this->reseller = $this->is_reseller(); 
	   
		$this->check_exist = remote_paramload('SHCUSTOMERS','checkexist',$this->path);	 
		$this->customer_exist_id = null; 	   	   	   
	   
		$myf_button = remote_paramload('SHCUSTOMERS','buttonclass',$this->path);
		self::$myf_button_class = $myf_button ? $myf_button : 'myf_button';
		$myf_submit = remote_paramload('SHCUSTOMERS','buttonclasssubmit',$this->path);
		self::$myf_button_submit_class = $myf_submit ? $myf_submit : 'myf_button';
  
		$this->rewrite = 1;	   
	}

    public function event($sAction) {

		if (!$this->msg) {

	     //$this->getFields();

         switch($sAction)   {
						   
            case "addnewdeliv"      : $this->jsBrowser();
									  break;
            case "removedeliv"      : $this->delivok = $this->removedeliveryaddress();
									  $this->jsBrowser();
						              break;
            case "savenewdeliv"     : $this->delivok = $this->savedeliveryaddress();
									  $this->jsBrowser();
						              break;						   						   						   
									  
            case "addnewus"         : break;
		    case "selcus"           : $this->deactivatecustomers();//make all decative
		                              $this->activatecustomer(GetReq('id')); //activate selected
									  $this->is_reseller();//change type of customer
			                          break;							  								  
            case "removecus"        : $this->cusok = $this->remove_customer();
						              break;
									  
            case "mapcus" 			: //in case of subinsert set username post param
									  $this->cusok = $this->map_customer(GetParam('uname'));	 
									  break;
		 
            case "inscus" 			:  //in case of subinsert set username post param
									  $this->cusok = $this->insert(GetParam('uname'));		 
									  break;									  
									  
            case "savenewcus"       : if ($this->check_exist) {
			                            if ($msg = $this->customer_exist()) {
			                              if ($msg<>-1) {//remap-mail exist
			                                $this->js_map_customer();
							              }	 
							              else {
							                $this->cusok = false;
                                            SetGlobal(localize('_CUSTEXISTS',getlocal()));//'Customer exist!');							   
										    $this->js_exist_mapped_customer();
							              }
										}  
							            else //save new cus
							              $this->cusok = $this->save_customer();	  
			                          }
						              else
			                            $this->cusok = $this->save_customer();
						              break;
            case "searchcustomer"   :
									  $this->searchres = $this->searchcustomer();
						              break;
									  
            case "update2"			: $this->cusok = $this->update(GetParam('a'),'id'); 
									  break;
            case "delete2"			: $this->_delete(); 
									  break;									  
									  
            case "insert2"			:if ($this->check_exist) {
										if ($msg = $this->customer_exist()) {
											if ($msg<>-1) {//remap-mail exist
												$this->js_map_customer();
											}	 
											else {
												$this->cusok = false;
												SetGlobal(localize('_CUSTEXISTS',getlocal()));//'Customer exist!');	
												$this->js_exist_mapped_customer();						   
											}  	 
										}  
										else //save new cus
											$this->cusok = $this->insert();						   
									 }
									 else
										$this->cusok = $this->insert();
									 break;									  
			default                 :							
          }
		}
	}

	public function action($action) {

		switch ($action) {
		   
          case "addnewdeliv"      :
          case "removedeliv"      : $out .= $this->show_customer_delivery();
						            break;	
          case "savenewdeliv"     : if (($this->delivok) && ($goto = GetSessionParam('afterdelivgoto'))) 
		                              $out = _m($goto); 
		                            else 
			                          $out .= $this->show_customer_delivery(); 
						            break;		   
		   
          case "addnewcus"         :		   
          case "selcus"            :	   
          case "removecus"         :$out .= $this->show_customers_list();
						            break;						
									
		  case "mapcus"            :									
		  case "inscus"            :		  												  
          case "savenewcus"        :if (($this->cusok) && ($goto = GetSessionParam('aftercusgoto'))) 
		                              $out = _m($goto);
		                            else 
			                          $out .= $this->show_customers_list(); 
						            break;		   
	   	   
          case "searchcustomer"   : $out = $this->searchresults(); break;

		  case "update2"          :
		  case "delete2"          :
		  case "insert2"          :	  				  
		  default                 : $out = $this->register();
		}
		return ($out);
	}
	
	protected function jsBrowser() {
		
		$code = $this->jsCust();		
		   
		if ($code) {
			$js = new jscript;	
			$js->load_js($code,null,1);		
			unset ($js);
		}
	}

	protected function jsCust() {
		$mobileDevices = _m('cmsrt.mobileMatchDev');
		
		$code = "
	if (/{$mobileDevices}/i.test(navigator.userAgent)) 
		window.scrollTo(0,parseInt($('#checkout-page').offset().top, 10));
	else {		
		gotoTop('checkout-page');	
	
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
	
	protected function checkFieldsJs($err=null, $title=null) {
			
		$code = "
	new $.Zebra_Dialog('$err', {'type':'error','title':'$title'});";
		
		$js = new jscript;	
		$js->load_js($code,null,1);			   
		unset ($js);
	}	
	
	protected function js_map_customer() {	
		$message = 'Customer found. Map?';	
		$vars = $this->make_customerpost_get();  
		$insertcustomerurl = seturl('t=inscus&'.$vars);	  
		$mapcustomerurl = seturl('t=mapcus&id='.$this->customer_exist_id);	  
	
		if (iniload('JAVASCRIPT')) {
		
			$code = "
	   
function map_alert() {

  if (confirm('$message'))
    window.location = '$mapcustomerurl';
   else  
    window.location = '$insertcustomerurl';
}	
window.onload=function(){
  map_alert();
}	
";	  
			$js = new jscript;		   
			$js->load_js($code,"",1);			   
			unset ($js);
		}		  	
	}	
	
	protected function js_exist_mapped_customer() {	
		$message = localize('_CUSTEXISTS',getlocal());//'Customer exist.';	  
	
		if (iniload('JAVASCRIPT')) {
		
			$code = "
window.onload=function(){
  //alert('$message');	
  new $.Zebra_Dialog('$message', {'type':'error','title':''});
} 
";	  
			$js = new jscript;		   
			$js->load_js($code,"",1);			   
			unset ($js);
		}	  	
	}		
	
	protected function make_customerpost_get() {
	
		$recfields = $this->get_cus_record(1,1);	

		foreach ($recfields as $fn=>$fname) {
			$retdata[] = $fname . '=' . GetParam($fname); 
		}	
	  
		$ret = implode('&',$retdata);
		return ($ret);
	}


    public function register() {
	    $sFormErr = GetGlobal('sFormErr');
	    $UserName = GetGlobal('UserName');	   
	    $user = decode($UserName);		
        $mycus = GetReq('a');

        if ($sFormErr=="ok") {
           
			$myaction = GetGlobal('controller')->getqueue(); //echo $myaction,"<><><><";
		   
			switch ($myaction) {

				case "insert2": 
								$out .= localize('_MSG10',getlocal());
								$out .= $this->after_registration_goto();
								break;
				case "update2": 
								$out = localize('_MSG10',getlocal());
								$out .= $this->after_update_goto();
								break;
				case "delete2": $out = localize('_MSG10',getlocal());
								$out .= $this->after_delete_goto();
								break;
			}		   
	   }
	   else {
			if (($mycus) && (seclevel('CUSTOMERSMNG_',$this->userLevelID))) {

				if (seclevel('UPDATECUSTOMER_',$this->userLevelID)) {
			   
					$record = $this->getcustomer($mycus,'id');
					$out .= $this->makeform($record,null,null,1); //update action
				}
				else
					$out .= localize('_ACCDENIED',getlocal());
			}
			elseif (seclevel('INSERTCUSTOMER_',$this->userLevelID)) {
				
				//get the user name if fb user is came in 
				$userfname = _m("shusers.getFullname");
				$record = $userfname . ';;;;;;;;;;' . $user;
				
		        $out = $this->makeform($record);
			}
			else
		        $out .= localize('_ACCDENIED',getlocal());
	   }

	   return ($out);
	}
	
	public function after_registration_goto() {
	
		if ( (defined('CMSLOGIN_DPC')) || (defined('SHLOGIN_DPC')) ) {	
		
		    //already in...
		    if (GetSessionParam('UserID')) {
			    if (defined('SHCART_DPC')) { 
				  $cartitems = _m('shcart.getcartItems');
				  if ($cartitems) 
			        $out = _m('shcart.cartview');
				  else
				    $out = null; //goto fp	
				}  
				else  
			      $out = null; //goto fp
		    } 
			else {
				if (defined('SHLOGIN_DPC'))
					$out .= _m('shlogin.html_form');
				else
					$out .= _m('cmslogin.html_form');
			    SetPreSessionParam('afterlogingoto','shcart.cartview');
			}
		} 		 
			  
		return ($out);	
	}	
	
	protected function after_update_goto() {
	   $myaction = GetParam('FormAction');
	   if ((GetGlobal('UserID')) && ($myaction=='update2')) {//already in..modify account
		  $out .= $this->show_customers_list();//$this->register();   
	   }	
	   
	   return ($out);
	}
	
	protected function after_delete_goto() {
	
	  return ($out);
	}	

    public function getcustomer($id="",$fkey=null) {
		$db = GetGlobal('db');
		$a = GetReq('a');
		//$un = GetGlobal('UserName');
		$myfkey = $fkey ? $fkey : $this->fkey;

		if ($id) 
			$cid = $id;//param
		elseif ($a) 
			$cid = $a;//update
		else {
	        //cart procedure
		    if ($cid = GetSessionParam('customerway')) { 
			    $myfkey = 'id';
			}	
	        else {//insert procedure
				$cid = ($this->usemailasusername) ? "'".$this->username."'" : $this->userid;
				$myfkey = $this->fkey;
			}	
		}
	 
		$recfields = ($this->usemailasusername) ?
					array('name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax','mail') :
					array('code2','name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax','mail');
	   
		$sSQL = ($this->usemailasusername) ?
			    "SELECT name,afm,eforia,prfdescr,address,area,zip,voice1,voice2,fax,mail" :
				"SELECT code2,name,afm,eforia,prfdescr,address,area,zip,voice1,voice2,fax,mail";
		$sSQL .= " FROM customers WHERE ". $myfkey . "=" . $cid;

		$result = $db->Execute($sSQL);
		//print_r($result->fields);
		
		reset($recfields);
		foreach ($recfields as $field_num=>$fieldname) {
			//echo $fid,'><br>';
			$record .= $result->fields[$field_num] . ";";
		}
		//echo $record;
		return ($record);
	}

	//return formed record data as html
    public function showcustomerdata($customer="",$fkey=null,$template=null,$ret_tokens=false) {
		$sFormErr = GetGlobal('sFormErr');
		$data = array();
		
		//template
		$template= $template ? str_replace('.htm', '', $template) : "showcustomerdata";
		$mytemplate = _m('cmsrt.select_template use ' . $template); 
	    /*
		if ($this->usemailasusername)
			$recfields = array('name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax','mail');
		else
			$recfields = array('code2','name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax','mail');
		reset($recfields);
	    */
		//when show activate viewed customer so deactivat all other same user clients
		$this->deactivatecustomers();	   
	   
		//read data
		if ($customerway = GetReq('customerway')) {
			//echo 'z22';
			$fields = $this->getcustomer($customerway,'id');
			SetSessionParam('scustomer',$customerway);
			$this->activatecustomer($customerway);		 
		}	 
		elseif ($selectedcustomer = GetSessionParam('scustomer')) {
			//echo 'a22'; 
			$fields = $this->getcustomer($selectedcustomer,'id');	
			$this->activatecustomer($selectedcustomer);		 
		}	    
		else	{ 
			//echo 'b22';
			$fields = $this->getcustomer($customer,$fkey,1);
			$this->activatecustomer();		 
		}	 

		//in case of no customer data this must return null
		if (strlen($fields)>11) { //if empty returns ';;;;;;;;;'

			$myfields = explode(";",$fields);
			array_pop($myfields); //get out the empty last element

			foreach ($myfields as $id=>$rec) {
		       $data[$id] = ($rec?$rec:"&nbsp;");
			}
		   
		    if (seclevel('CUSTOMERSMNG_',$this->userLevelID)) {
				$uid = $this->userid;
				//signup2 became signup to handle user and customer
				//$data[] = seturl("t=signup&a=$uid" , localize('_UPDATE',getlocal()) );			 
				$data[] = $this->myf_button(localize('_UPDATE',getlocal()),'signup/');
			}
			 
			if ($ret_tokens)//call from shcart to email invoice
			    return ($data);
			else	
				$out = $this->combine_tokens($mytemplate,$data);
		}
		return ($out);
	}

	//return leeid of customer based on ageneric where (suitable for pre register user procedure)
	public function search_customer_id($where_statement) {
		$db = GetGlobal('db');

		$sSQL = "SELECT CODE2 FROM customers WHERE " .$where_statement;
		$result = $db->Execute($sSQL,3);

		return ($result->fields[0]);
	}

    protected function makeform($fields='',$notitle=null,$cmd=null,$isupdate=null,$go_to=null,$setinvtype=null) {
	    $sFormErr = GetGlobal('sFormErr');
		$customerid = GetParam('a');
	    $goto = $go_to ? $go_to : "editcus/$customerid/"; //"t=signup2&a=".GetParam('a'); 
	   
	    if (!$invtype = GetSessionParam('invtype'))
			$invtype = GetParam('invtype') ? GetParam('invtype') : ($setinvtype ? $setinvtype : $this->invtype);
	   
		$mytemplate = _m('cmsrt.select_template use cusregister');

	    $data =  array();       //read data	  
	    $recfields = $this->get_cus_record(1,1);		 
	    reset($recfields);
	   
	    if ($fields) { //get record param
		    $myfields = explode(";",$fields);

            foreach ($recfields as $recid => $rec) 
		        $data[$recid] = $myfields[$recid] ? $myfields[$recid] : null;//"&nbsp;");

	    }
	    else { //read form data
            foreach ($recfields as $fnum => $fname) {
		        $data[$fnum] = ToHTML(GetParam(_with($fname)));
		    }
	    }

        //$sFileName = seturl($goto,0,1);	   
	    if ($sFormErr!="ok") 
			$err = $sFormErr;

	    //message at top
        $tokens[] = $err;     

        //show data
        reset ($recfields);
	    reset ($data);
        foreach ($recfields as $field_num => $fieldname) 
			$tokens[] = $data[$field_num];

		if ((($cid = GetParam('a')) && (seclevel('CUSTOMERSMNG_',$this->userLevelID))) || ($isupdate)) {	   

			if ((seclevel('UPDATECUSTOMER_',$this->userLevelID)) || ($isupdate)) { 
				$updcmd = $cmd ? $cmd : 'update2';
				$out2 = "<input type=\"hidden\" name=\"a\" value=\"".$cid."\">";
				$out2 .= "<input type=\"hidden\" value=\"$updcmd\" name=\"FormAction\"/>";			  
				$out2 .= "<input type=\"submit\" class=\"".self::$myf_button_submit_class."\" value=\"" . localize('_UPDATE',getlocal()) . "\">";// onclick=\"document.forms('Registration2').FormAction.value = '$updcmd';\">";
			}
			elseif (seclevel('DELETECUSTOMER_',$this->userLevelID)) {
				$out2 = "<input type=\"hidden\" value=\"delete2\" name=\"FormAction\"/>";		   
				$out2 .= "<input type=\"submit\" class=\"".self::$myf_button_submit_class."\" value=\"" . localize('_DELETE',getlocal()) . "\">";// onclick=\"document.forms('Registration2').FormAction.value = 'delete2';\">";
			}
		}
		else {
			$dpccmd = $cmd ? $cmd : 'insert2';
			$out2 .= "<input type=\"submit\" class=\"".self::$myf_button_submit_class."\" value=\"" . localize('_SIGNUP',getlocal()) . "\" onclick=\"document.forms('Registration2').FormAction.value = '$dpccmd';\">";
			$out2 .= "<input type=\"hidden\" value=\"$dpccmd\" name=\"FormAction\"/>";
		}
       
	    if ($usermail)//hidden user mail to check
			$out2 .= "<input type=\"hidden\" name=\"mail\" value=\"$usermail\">";
		 
	    //submit buttons
        $tokens[] = $out2;
		   
		$ret = $this->combine_tokens($mytemplate,$tokens);
		return ($ret);		   
	}
	
	//used by userform to combine form in one
	public function makesubform() {

		if (!$invtype = GetSessionParam('invtype'))	   
			$select_inv = GetParam('invtype') ? GetParam('invtype') : $this->invtype;
	   
		if ($this->allow_inv_selection) //show invoice selection
			$tokens[] = $this->select_invoice($select_inv,'signup');	    
		else 
           $tokens[] = null; //first token null	 	   
	   
	    switch ($select_inv) {
			case 1  : 	$recfields = $this->cusform;
						break;  
			case 0  : 
			default : 	$recfields = $this->cusform2;
	    }
	 
	    reset($recfields);
	   
	    if ($fields) { //get record param
		    $myfields = explode(";",$fields);
            foreach ($recfields as $recid => $rec) 
		        $data[$recid] = $myfields[$recid] ? $myfields[$recid] : null;//"&nbsp;";
	    }
	    else { //read form data
            foreach ($recfields as $fnum => $fname) 
		        $data[$fnum] = ToHTML(GetParam(_with($fname)));
	    }
	   
        //show data
        reset ($recfields);
	    reset ($data);
        foreach ($recfields as $field_num => $fieldname) {  
            $tokens[] = "<input type=\"text\" class=\"myf_input\" name=\"" . 
						_with($fieldname) . "\" maxlength=\"" . $maxcharfields[$field_num] . 
						"\" value=\"" . $data[$field_num] . 
						"\" size=\"" . "25" . "\" >";
	    }
		   
	    if ($this->mydelivery_address) {
		    $extratokens = $this->makedelivsubform();
			$etokens = array_merge($tokens,$extratokens);
			return ($etokens);
        }	 
	    else
	        return ($tokens);		   
	   	   	
	}
	
	public function select_invoice($itype=null,$cmd=null) {
	  $selected_inv_type = GetReq('invtype');
	  $t = $cmd?$cmd:GetReq('t');
	  //in case of cart procedure
	  $status = GetParam('status');

      $r  = "<select name='invtype_selector' class='myf_select' ";
      $r .= "onChange=\"location='signup/'+this.options[this.selectedIndex].value+'/'\">"; 	  
	  $r .= "<option value='0' ".($selected_inv_type ? "" : "selected").">".localize('_APODEIXI',getlocal())."</option>";	   
	  $r .= "<option value='1' ".($selected_inv_type ? " selected" : "").">".localize('_INVOICE',getlocal())."</option>";
	  $r .= "</select>";
	  
	  return ($r);
	}
	
	public function get_invoice_type() {
	  
	  $ret = $this->invtype ? $this->invtype : '0';
	  return ($ret);
	}
	
	public function get_invoice_type_descr() {
	  
	  $ret = $this->invtype ? localize('_INVOICE',getlocal()) :
	                          localize('_APODEIXI',getlocal());
	  return ($ret);
	}	
	
	public function customer_exist($returnid=false) {
	   $db = GetGlobal('db');
	   $param = $this->check_exist;//afm
	   $value = GetParam($param)?GetParam($param):null;
	   
	   if (!$value) return false;
	   
       $sSQL = "select $param,id,code2 from customers where $param=" . $db->qstr($value);
       //echo $sSQL;
       $result = $db->Execute($sSQL,2);
	   //print_r($result->fields);
       $paramret = $result->fields[0];
	   
	   //prevent to remap customer
	   if ($result->fields[2]) return (-1);//false; //-1??
	   
	   if ($paramret) {
	     $this->customer_exist_id = $result->fields[1];//true; //return id as map param
		 
		 if ($returnid)
		   return ($this->customer_exist_id);
		 else  
	       return 'Details with ' . $param . '=' . $paramret . ' exist!';//$true;    
	   }	 
		
	   return false;	
	  
	}
	
	//new map param comes form users (dpc call)
	public function map_customer($userid=null,$id=null) {
	   $db = GetGlobal('db');
	   //if already in id is in requets else in param (from new user)
	   $id = $id?$id:GetReq('id');
	   //if already loged if get global userid else set userid=post field (called from func) 
	   $userid = $userid?$userid:decode(GetGlobal('UserID'));
	   //$myfkey = $fkey?$fkey:$this->fkey;	
	   
	   if ($uid = $userid) {   
	   
	     if ($id) {
		 
	       $this->deactivatecustomers($uid); //deactivate all		 
		 
           //$sSQL = "update customers set active=1,code2=" . $db->qstr($uid) . ",mail=" . $db->qstr($uid) . " where id=" . $id;//$db->qstr($value);
		   
		   //update with new submited data..except afm		   
		   //name,eforia,prfdescr,address,area,zip,voice1,voice2,fax,		   
           $sSQL = "update customers set active=1,code2=" . $db->qstr($uid); 
		   $sSQL.= ",name=" . $db->qstr(addslashes(GetParam('lname')));//user's name 
	       //$sSQL.= ",afm=" . $db->qstr(addslashes(GetParam('afm')));
	       $sSQL.= ",eforia=" . $db->qstr(addslashes(GetParam('eforia')));
	       $sSQL.= ",prfdescr=" . $db->qstr(addslashes(GetParam('prfdescr')));
	       $sSQL.= ",address=" . $db->qstr(addslashes(GetParam('address')));
	       $sSQL.= ",area=" . $db->qstr(addslashes(GetParam('area')));
	       $sSQL.= ",zip=" . $db->qstr(addslashes(GetParam('zip')));
		   $sSQL.= ",country=" . $db->qstr(addslashes(GetParam('country')));
	       $sSQL.= ",voice1=" . $db->qstr(addslashes(GetParam('voice1')));
	       $sSQL.= ",voice2=" . $db->qstr(addslashes(GetParam('voice2')));
	       $sSQL.= ",fax=" . $db->qstr(addslashes(GetParam('fax')));
	       $sSQL.= ",mail=" . $db->qstr($db->qstr($uid));//user email		  
		   $sSQL.= " where id=" . $id;//$db->qstr($value);		   
		  
           //echo $sSQL;
           $result = $db->Execute($sSQL,1);  	
		 
           if ($db->Affected_Rows()) {    
				SetGlobal('sFormErr',"ok");	
			 
				if ($this->tellit) {
				
					//fetch existing data and send mail to admin
					$sSQL2 = "select code2,active,name,afm,eforia,prfdescr,address,area,zip,country,voice1,voice2,fax,mail from customers " . " where id=" . $id;
					$res2 = $db->Execute($sSQL2,2); 				
				
					$mytemplate = _m('cmsrt.select_template use customerinserttell'); 
			
					$tokens[] = GetParam('uname');
					$tokens[] = GetParam('lname'); 
					$tokens[] = $res2->fields['afm'];						
					$tokens[] = $res2->fields['eforia'];			
					$tokens[] = $res2->fields['prfdescr'];
					$tokens[] = $res2->fields['address'];
					$tokens[] = $res2->fields['area'];														
					$tokens[] = $res2->fields['zip'];			
					$tokens[] = $res2->fields['country'];
					$tokens[] = $res2->fields['voice1'];			
					$tokens[] = $res2->fields['voice2'];			
					$tokens[] = $res2->fields['fax'];			
					$tokens[] = $uid;	
					$tokens[] = GetParam("fname");//subinsert user insert fname data to be send...			
					
					$mailbody = $this->combine_tokens($mytemplate,$tokens);

					$from = $this->it_sendfrom ? $this->it_sendfrom : $email;
					$subject = localize('CustomerRegistration',getlocal());
					//$this->mailto($from,$this->tellit,$subject,$mailbody);
					$body = str_replace('+','<SYN/>',$mailbody); 
					$mailerr = _m("cmsrt.cmsMail use $from+{$this->tellit}+$subject+$body");
				}				 
		   }
			 	 
		   return true;
         }
	   }
	   return false;	 
	}

	protected function insert($userid=null) {
		$db = GetGlobal('db');
		$checkfields = null;//array('name','address','zip','voice1','mail');
		if ($error = $this->checkFields(null, $this->checkuseasterisk, $checkfields)) {
			//SetGlobal('sFormErr',$error);
			$this->checkFieldsJs($error);
			
			return false;
		}	   
  
		if ($userid) {//code inside
			$uid = $userid;
		}
		elseif ($userid = GetSessionParam('new_user_code')) {//if user has pre-insert???????
			$uid= $userid;
		}
		elseif ($userid = decode(GetSessionParam('UserID'))) {//has login already
			$uid= $userid;
		}	 
		else {
			SetGlobal('sFormErr','Invalid user key!');
			return false;
		}	 
	     	  
		//$recfields = array('code2','name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax','mail');
		
		$sSQL = "insert into customers (code2,active,name,afm,eforia,prfdescr,address,area,zip,country,voice1,voice2,fax,mail)";
		$sSQL.= " values (" .
	           $db->qstr($uid) . ',1,' .
	           $db->qstr(addslashes(GetParam('name'))) . ',' .
	           $db->qstr(addslashes(GetParam('afm'))) . ',' .
	           $db->qstr(addslashes(GetParam('eforia'))) . ',' .
	           $db->qstr(addslashes(GetParam('prfdescr'))) . ',' .
	           $db->qstr(addslashes(GetParam('address'))) . ',' .
	           $db->qstr(addslashes(GetParam('area'))) . ',' .
	           $db->qstr(addslashes(GetParam('zip'))) . ',' .
			   $db->qstr(addslashes(GetParam('country'))) . ',' .
	           $db->qstr(addslashes(GetParam('voice1'))) . ',' .
	           $db->qstr(addslashes(GetParam('voice2'))) . ',' .
	           $db->qstr(addslashes(GetParam('fax'))) . ',' .
	           $db->qstr(addslashes(GetParam('mail'))) .
	           ")";

		//echo $sSQL;
		$result = $db->Execute($sSQL,1);
		
		if ($db->Affected_Rows()) {	   
		
			SetGlobal('sFormErr',"ok");
			//$this->update_statistics('registration', GetParam('mail'));	
			
			if ($this->tellit) {

				$mytemplate = _m('cmsrt.select_template use customerinserttell'); 
			
				$tokens[] = $uid;			
				$tokens[] = GetParam('name');	
				$tokens[] = GetParam('afm');						
				$tokens[] = GetParam('eforia');			
				$tokens[] = GetParam('prfdescr');
				$tokens[] = GetParam('address');
				$tokens[] = GetParam('area');														
				$tokens[] = GetParam('zip');		
				$tokens[] = GetParam('country');
				$tokens[] = GetParam('voice1');			
				$tokens[] = GetParam('voice2');			
				$tokens[] = GetParam('fax');			
				$tokens[] = GetParam('mail');			
			
				$mailbody = $this->combine_tokens($mytemplate,$tokens);

				$from = $this->it_sendfrom ? $this->it_sendfrom : $email;
				$subject = localize('CustomerRegistration',getlocal());
				//$this->mailto($from,$this->tellit,$subject,$mailbody);
				$body = str_replace('+','<SYN/>',$mailbody); 
				$mailerr = _m("cmsrt.cmsMail use $from+{$this->tellit}+$subject+$body");
			}			
		 
			return true;	 
		}
		else 
			SetGlobal('sFormErr',localize('_MSG20',getlocal()));  	 

		return false;//($result);
	}
	
	//used by users in one form combination (usercode must fill to connect)
	//..silent check existing customer
	public function subinsert($userid=null,$bypasscheck=null) {
		$db = GetGlobal('db');
	   
		if ($error = $this->checkFields($bypasscheck, $this->checkuseasterisk)) {
			SetGlobal('sFormErr',$error);
			return ($error);
		}
   
		if ($userid) {//code inside
			$uid = $userid;
		} 
		else {//never must happen
			SetGlobal('sFormErr','Invalid user key!');
			return null;
		}	 
	   
		//what to store as mail ?  
		if ($usemailasusername = _v('shusers.usemailasusername'))	
			$email = $userid;//GetParam('uname');
		else	 
			$email = GetParam('eml');
		 
		//before set active the current record deactive all others  
		$d = $this->deactivatecustomers($uid);			 			 

		$sSQL = "insert into customers (code2,active,name,afm,eforia,prfdescr,address,area,zip,country,voice1,voice2,fax,mail)";
		$sSQL.= " values (" .
	           $db->qstr($uid) . ',1,' .
	           $db->qstr(addslashes(GetParam('lname'))) . ',' . //user's name
	           $db->qstr(addslashes(GetParam('afm'))) . ',' .
	           $db->qstr(addslashes(GetParam('eforia'))) . ',' .
	           $db->qstr(addslashes(GetParam('prfdescr'))) . ',' .
	           $db->qstr(addslashes(GetParam('address'))) . ',' .
	           $db->qstr(addslashes(GetParam('area'))) . ',' .
	           $db->qstr(addslashes(GetParam('zip'))) . ',' .
			   $db->qstr(addslashes(GetParam('country'))) . ',' .
	           $db->qstr(addslashes(GetParam('voice1'))) . ',' .
	           $db->qstr(addslashes(GetParam('voice2'))) . ',' .
	           $db->qstr(addslashes(GetParam('fax'))) . ',' .
	           $db->qstr(addslashes(strtolower($email))) . //user email
	           ")";

		$result = $db->Execute($sSQL,1);

		if ($ret = $db->Affected_Rows()) {	   
			SetGlobal('sFormErr',"ok");
		 
			//$this->update_statistics('registration', $email);
		 
			//delivery address
			if (($this->mydelivery_address) && (!$error = $this->check_delivery_address(1))) {
				//save at customer address book
				$save=0;
				foreach ($this->delivery_fields as $fn=>$fname) {
					$data_entry = GetParam($fname.'_d');
					$delivdata[] = $db->qstr($data_entry); //to separate from default address name fields  
					if ($data_entry) {
						//echo '>',$data_entry;
						$save=1;
					}  
				}
				
				if ($save) {	  
					//before set active the current record deactive all others  
					$d = $this->deactivatedeliveryaddress($uid);
		   		   
					$addressfields = implode(',',$this->delivery_fields);
					$sSQL2 = "insert into custaddress (ccode,active,$addressfields)";
					$sSQL2.= " values (". $db->qstr($uid). ",1,";
					$sSQL2.= implode(',',$delivdata);
					$sSQL2.= ")";

					//echo $sSQL2;
					$result2 = $db->Execute($sSQL2,1);		   	   
				}
			}		 
		 
			if ($this->tellit) {
				$mytemplate = _m('cmsrt.select_template use customerinserttell'); 
			
				$tokens[] = GetParam('uname');			
				$tokens[] = GetParam('lname');	
				$tokens[] = GetParam('afm');						
				$tokens[] = GetParam('eforia');			
				$tokens[] = GetParam('prfdescr');
				$tokens[] = GetParam('address');
				$tokens[] = GetParam('area');														
				$tokens[] = GetParam('zip');			
				$tokens[] = GetParam('country');
				$tokens[] = GetParam('voice1');			
				$tokens[] = GetParam('voice2');			
				$tokens[] = GetParam('fax');			
				$tokens[] = $email;	
				$tokens[] = GetParam("fname");//subinsert user insert fname data to be send...				
			
				$mailbody = $this->combine_tokens($mytemplate,$tokens);

				$from = $this->it_sendfrom ? $this->it_sendfrom : $email;
				$subject = localize('CustomerRegistration',getlocal());
				//$this->mailto($from,$this->tellit,$subject,$mailbody);
				$body = str_replace('+','<SYN/>',$mailbody); 
				$mailerr = _m("cmsrt.cmsMail use $from+{$this->tellit}+$subject+$body");
			}		 
		}
		else 
			SetGlobal('sFormErr',localize('_MSG20',getlocal()));   	 

		return (GetGlobal('sFormErr'));

	}	
	
	//rollabck subinsert from users
	public function subdelete($userid=nul) {
		$db = GetGlobal('db');	
	   
		if ($userid) {
			$sSQL = "delete from customers";
			$sSQL.= " where code2=". $db->qstr($userid);	   
			$result = $db->Execute($sSQL,1);	 
		}
	     
		if ($ret = $db->Affected_Rows())
			return true;		      

		return false;		   
	}   	

	protected function update($id=null,$fkey=null) {
	    $db = GetGlobal('db');
	    $myfkey = $fkey ? $fkey : $this->fkey;
	    $key = decode(GetGlobal('UserName'));//security..foreign to user

	    if ($error = $this->checkFields(null,$this->checkuseasterisk)) {
			//SetGlobal('sFormErr',$error);
			$this->checkFieldsJs($error);
			
			return false;//($error);
	    }		   

        if ($this->usemailasusername) {
			if (GetParam('uname')) //= mail
				$recfields = array('name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax');
			else
				$recfields = array('name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax','mail');
	    }
	    else
			$recfields = array('code2','name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax','mail');

	    if (!$id) { //DISABLED ID AS PARAM ?
			SetGlobal('sFormErr',localize('_MSG21',getlocal()));
			return false;
	    }	 

        $sSQL = "update customers set ";
	    $sSQL.=
	           'name='.$db->qstr(addslashes(GetParam('name'))) . ',' .
	           'afm='.$db->qstr(addslashes(GetParam('afm'))) . ',' .
	           'eforia='.$db->qstr(addslashes(GetParam('eforia'))) . ',' .
	           'prfdescr='.$db->qstr(addslashes(GetParam('prfdescr'))) . ',' .
	           'address='.$db->qstr(addslashes(GetParam('address'))) . ',' .
	           'area='.$db->qstr(addslashes(GetParam('area'))) . ',' .
	           'zip='.$db->qstr(addslashes(GetParam('zip'))) . ',' .
			   'country='.$db->qstr(addslashes(GetParam('country'))) . ',' .
	           'voice1='.$db->qstr(addslashes(GetParam('voice1'))) . ',' .
	           'voice2='.$db->qstr(addslashes(GetParam('voice2'))) . ',' .
	           'fax='.$db->qstr(addslashes(GetParam('fax'))) . ',' .
	           'mail='.$db->qstr(addslashes(GetParam('mail')))  .
			   //" where code2=" . $db->qstr($key); //DISABLED UPDATE WITH ID AS PARAM ?
	           " where $myfkey=".$id . " and " . "code2=" . $db->qstr($key); 

        //echo $sSQL;
        $result = $db->Execute($sSQL,1);
		
        if ($db->Affected_Rows()) {	  

			if ($this->tellit) {

				$mytemplate = _m('cmsrt.select_template use customerupdatetell');
			
				$tokens[] = $key;			
				$tokens[] = GetParam('name');	
				$tokens[] = GetParam('afm');						
				$tokens[] = GetParam('eforia');			
				$tokens[] = GetParam('prfdescr');
				$tokens[] = GetParam('address');
				$tokens[] = GetParam('area');														
				$tokens[] = GetParam('zip');			
				$tokens[] = GetParam('country');
				$tokens[] = GetParam('voice1');			
				$tokens[] = GetParam('voice2');			
				$tokens[] = GetParam('fax');			
				$tokens[] = GetParam('mail');			
			
				$mailbody = $this->combine_tokens($mytemplate,$tokens);

				$from = $this->it_sendfrom ? $this->it_sendfrom : $email;
				$subject = localize('CustomerUpdData',getlocal());
				//$this->mailto($from,$this->tellit,$subject,$mailbody);
				$body = str_replace('+','<SYN/>',$mailbody); 
				$mailerr = _m("cmsrt.cmsMail use $from+{$this->tellit}+$subject+$body");
			}
		
			SetGlobal('sFormErr',"ok");
			return true;
	    }
	    else 
			SetGlobal('sFormErr',localize('_MSG20',getlocal())); 

	    return false;//($result);
	}

	protected function _delete($id=null) {
	    $db = GetGlobal('db');

	    if (!$id) return (false);

		$sSQL = "delete from customers where id=" . $id;
        $result = $db->Execute($sSQL,1);

        if ($db->Affected_Rows()) 	   
			SetGlobal('sFormErr',"ok");
		else 
			SetGlobal('sFormErr',localize('_MSG20',getlocal()));

	    return ($result);
	}

	public function getmaxid() {
		$db = GetGlobal('db');

		$sSQL = "select max(id) from customers";
		$result = $db->Execute($sSQL,2);

	    return ($result->fields[0]);
	}		

    public function checkFields($bypass=null,$checkasterisk=null, $checkf=false) {
		$sFormErr = GetGlobal('sFormErr');
		$lan = getlocal();
	
		if ($bypass) 
			return null;		
	   
		$recfields = $this->get_cus_record();
	
		if ($checkasterisk) {
			foreach ($recfields as $field_num => $fieldname) {
				
				if ((!empty($checkf)) && in_array($fieldname, $checkf)) {
					if (!strlen(GetParam(_with($fieldname)))) {
						$sFormErr .= localize('_MSG12',$lan) . " <font color=\"red\">" .
									$title . "</font> " .
									localize('_MSG11',$lan) . "<br>";		  			
					}
				}
				else {
					$titles = explode('/',remote_paramload('SHCUSTOMERS',$fieldname,$this->path));
					$title = $titles[$lan];			
				
					if (strstr($title,'*')) { //check by title using *

						if (!strlen(GetParam(_with($fieldname)))) {
							$sFormErr .= localize('_MSG12',$lan) . " <font color=\"red\">" .
									$title . "</font> " .
									localize('_MSG11',$lan) . "<br>";		  			
						}
					}
				}
			}		 
	    }
	    else {	   
			foreach ($recfields as $field_num => $fieldname) {
				if(!strlen(GetParam(_with($fieldname)))) {
					$sFormErr .= localize('_MSG12',$lan) . " <font color=\"red\">" .
								localize($recfields[$field_num],$lan) . "</font> " .
								localize('_MSG11',$lan) . "<br>";
				}
			}  
        }

		SetGlobal('sFormErr',$sFormErr);
	   
		return ($sFormErr);
    }
	
	public function get_cus_type($id,$field=null,$istext=0) {
        $db = GetGlobal('db');
		$mycode = $field ? $field : 'code2';

		if ($id) { 
			$sSQL = "select attr1 from customers where active=1 and $mycode=";
			switch ($istext) {
				case 1 : $sSQL .= $db->qstr($id); break;
				case 0 :
				default: $sSQL .= $id;
			}
			$res = $db->Execute($sSQL,2);
			$ret = $res->fields[0];
			return ($ret);	
		}
		
		return false;
	}
	
	public function is_reseller($id=null) {
		$UserName = GetGlobal('UserName');		   
	
		if ($this->usemailasusername) {
			$id = decode($UserName);	
			$ret = $this->get_cus_type($id,null,1);
		}	 
		else	 
			$ret = $this->get_cus_type($id);
	
		if (!$ret) return;	 
		  
		if (is_array($this->reseller_attr) && (!empty($this->reseller_attr))) {	 		   
			foreach ($this->reseller_attr as $i=>$attr) {
				if ($ret==$attr) {
					SetSessionParam('RESELLER','true');
					return true;
				}		 
			}
		}
		else {	   
			if ($ret==$this->reseller_attr) {	 
				SetSessionParam('RESELLER','true');
				return true;
			}
		}	 	 
		 	 	 
		return false;
	}	
	
	protected function get_cus_record($invtype=null,$default_records=null) {
	    $invtype = $invtype ? $invtype : $this->invtype;
		
		if ($default_records) {
			if ($this->usemailasusername) {
		 
				if ($usermail = GetParam('uname')) 
					$recfields = ($invtype==1) ? 
								array('name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax') :
								array('name','address','area','zip','voice1','voice2','fax');  
				else 
					$recfields = ($invtype==1) ? 
								array('name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax','mail') :
								array('name','address','area','zip','voice1','voice2','fax','mail');  
			}
			else 	   
				$recfields = ($invtype==1)	? 
							array('code2','name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax','mail') :
							array('code2','name','address','area','zip','voice1','voice2','fax','mail');			
		}
		else
			$recfields = ($invtype==1) ? $this->cusform : $this->cusform2;
		
	    /*if (!$default_records) 	
			$recfields = ($invtype==1) ? $this->cusform : $this->cusform2;	    
	   
		if (!$recfields) {
			if ($this->usemailasusername) {
		 
				if ($usermail = GetParam('uname')) 
					$recfields = ($invtype==1) ? array('name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax') :
												 array('name','address','area','zip','voice1','voice2','fax');  
				else 
					$recfields = ($invtype==1) ? array('name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax','mail') :
												 array('name','address','area','zip','voice1','voice2','fax','mail');  
			}
			else 	   
				$recfields = ($invtype==1)	? array('code2','name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax','mail') :
										  array('code2','name','address','area','zip','voice1','voice2','fax','mail');
        }*/
	   
	    return ($recfields);	
	}	
	
	public function getCustomers($id=null, $tokens=false) {
        $db = GetGlobal('db');		   
	    $UserName = GetGlobal('UserName');
	    $user = $uid ? $uid : decode($UserName);
		if (!$UserName) return null;
		
		$sSQL = "select id,name from customers where ";
		$sSQL .= ($id) ? "id=" . $id : 'code2=' . $db->qstr($user) ;
		$sSQL .= " order by active DESC"; //active=1 first
   
        $res = $db->Execute($sSQL);
        if (empty($res)) return null;
		
		foreach ($res as $i=>$rec)	
			$ret[] = array($rec[0],$rec[1]);
			
		return ($ret);	
	}	
	
	public function getSelectedCustomer($id=null, $tokens=false) {
        $db = GetGlobal('db');		   
	    $UserName = GetGlobal('UserName');
	    $user = $uid ? $uid : decode($UserName);
		if (!$UserName) return null;
			
		if ($id) { 
			$sSQL = "select name,afm,eforia,prfdescr,address,area,zip,country,voice1,voice2,fax,mail,id from customers";
			$sSQL.= " where id=$id and code2=". $db->qstr($user);	   
		}		
		else { //fetch active by default
			$sSQL = "select name,afm,eforia,prfdescr,address,area,zip,country,voice1,voice2,fax,mail,id from customers";
			$sSQL.= " where active=1 and code2=". $db->qstr($user);   
        }	
		
		$res = $db->Execute($sSQL);
		
		if ($res->fields[0]) //found
			$ret = ($tokens) ? array($res->fields[0],$res->fields[1],$res->fields[2],$res->fields[3],$res->fields[4],$res->fields[5],$res->fields[6],
									 $res->fields[7],$res->fields[8],$res->fields[9],$res->fields[10],$res->fields[11],$res->fields[12]) :
							   implode('<br/>',array($res->fields[0],$res->fields[1],$res->fields[2],$res->fields[3],$res->fields[4],$res->fields[5],$res->fields[6],
									 $res->fields[7],$res->fields[8],$res->fields[9],$res->fields[10],$res->fields[11],$res->fields[12]));		
		
		return ($ret ? $ret : 'Invalid customer');	
	}		
	
	/////////////////////////////////////////////////DELIVERY ADDRESS
	
	protected function makedelivsubform() {
	
		$tokens[] = localize('_DELIVADDRESS',getlocal());
 
		reset($this->delivery_fields);
        
		foreach ($this->delivery_fields as $fnum => $fname) {
			$data[$fnum] = ToHTML(GetParam(_with($fname.'_d')));
		}
	   
		//show data
		reset ($this->delivery_fields);
		reset ($data);
		foreach ($this->delivery_fields as $field_num => $fieldname) {
			//inputs .._d..to separate from default address name fields in the same form  
			$tokens[] = "<input type=\"text\" class=\"myf_input\" name=\"" . _with($fieldname.'_d') . "\" maxlength=\"" . $maxcharfields[$field_num] . "\" value=\"" .
						$data[$field_num] . "\" size=\"" . "25" . "\" >";
		}
	   
		return ($tokens);		   
	}
	
	protected function check_delivery_address($bypass=null,$checkasterisk=null) {
	
	    if ($bypass) 
			return null;	
	
	    if ($checkasterisk) {
			foreach ($this->delivery_fields as $fn=>$fname) {	   
				$title = localize($fname,getlocal());
				if (strstr($title,'*')) { //check by titile using *
					if(!strlen(GetParam(_with($fname.'_d')))) {
						$sFormErr .= localize('_MSG12',getlocal()) . " <font color=\"red\">" .
									$title . "</font> " .
									localize('_MSG11',getlocal()) . "<br>";		  			
					}			
				}
			}		 
	    }
	    else {  
			//if any of fields is set...???
			//_d ..to separate from default address name fields  
			foreach ($this->delivery_fields as $fn=>$fname) {
				//echo '>'.GetParam($fname.'_d');
				$title = localize($fname,getlocal());
				if(!strlen(GetParam(_with($fname.'_d')))) {
					$sFormErr .= localize('_MSG12',getlocal()) . " <font color=\"red\">" .
								$title . "</font> " .
								localize('_MSG11',getlocal()) . "<br>";		  			
				}	
			}	
	    }
	   
	    SetGlobal('sFormErr',$sFormErr);

        return ($sFormErr);
	}
	
	public function get_delivery_address() {
	
		return ($this->mydelivery_address);	
	}	
	
	public function showdeliveryaddress($name=null,$combo=null,$uid=null,$style=null) {
        $db = GetGlobal('db');	
	    $UserName = GetGlobal('UserName');
	    $myui=$uid?$uid:decode($UserName);
	    $addressway = GetReq('addressway');//predef..selected
	    $out = null; 
	    $style = $style ? $style : 'myf_select';
	   
	    $addressfields = implode(',',$this->delivery_fields);
        $sSQL = "select id,active,$addressfields from custaddress";
	    $sSQL.= " where ccode=". $db->qstr($myui);
	    if ($addressway)
	      $sSQL .= " and id=" . $addressway;
	    $sSQL .= " order by id DESC"; //last to first..selected last address inserted
	   	 
	    //echo $sSQL;	   
        $result = $db->Execute($sSQL,2);

        if ($combo) {//not used....
			$out .= "<select name=\"".$name."\" class=\"".$style."\">";		     
		   
			foreach ($result as $n=>$na) {
				if (!empty($na[0])) {	  		
					$title = $na[0];
					$value = $na[1];
					$out .= "<option value=\"$value\"".($value == $addressway ? " selected" : "").">$title</option>";
				}  
			}
			$out .= "</select>";		   
	    }
	    else {
			$hr = '';
		   
			//$ret = localize('_DELIVADDRESS',getlocal()).';';
			if (!$addressway) {//add default address to list as first option
				$defaddr = localize('_DEFDELIVADDRESS',getlocal());	   		   
				$ret = $defaddr . $hr . '<COMMA>';
			}
		   
			foreach ($result as $n=>$na) {	
				if (!empty($na)) {
					$ret .= localize('_DELIVADDRESS',getlocal()) . ' #' . ($n+1);	
					$ret .= '<br/>';
			 
					foreach ($this->delivery_fields as $i=>$in) {
						$ret .= localize($in,getlocal()).':'.$na[$in].'<br>';
					}	
			   
					$ret .= $hr . '<COMMA>';
				}  
			}
		   
			if ($addressway) {//add default address to list as last option
				$defaddr =  localize('_DEFDELIVADDRESS',getlocal()) . $hr . '<COMMA>';	   		   
				$ret .= $defaddr;
			}	
		   
			$out = substr($ret,0,-7);//7=<COMMA>		   	    	 
	    }  
	   
	    return ($out);		   
	}
	
	public function getAddresses() {
        $db = GetGlobal('db');		   
	    $UserName = GetGlobal('UserName');
	    $user = $uid ? $uid : decode($UserName);
		if (!$UserName) return null;
		
		//basic 
        $sSQL = "select id,address,area,zip,country from customers";
	    $sSQL.= " where active=1 and code2=". $db->qstr($user);
	    //$sSQL.= " order by id"; 
	    //echo $sSQL;	   
        $res = $db->Execute($sSQL);
		$ret[] = array(/*$res->fields[0]*/'',$res->fields[1],$res->fields[2],$res->fields[3]);	
	   	   	
        //alternatives (may use active for first line ??)		
        $sSQL = "select id,address,area,zip,country,active from custaddress";
	    $sSQL.= " where ccode=". $db->qstr($user);
	    $sSQL.= " order by id"; 
	    //echo $sSQL;	   
        $result = $db->Execute($sSQL);
        if (empty($result)) return null;
		
		foreach ($result as $i=>$rec)	
			$ret[$rec[0]] = array($rec[0],$rec[1],$rec[2],$rec[3],$rec[4]);
			
		return ($ret);	
	}	
	
	public function getSelectedAddress($id=null, $tokens=false) {
        $db = GetGlobal('db');		   
	    $UserName = GetGlobal('UserName');
	    $user = $uid ? $uid : decode($UserName);
		if (!$UserName) return null;
			
		//alternatives OR _DEFDELIVADDRESS in case of old method	
		if (($id) && ($id != localize('_DEFDELIVADDRESS', getlocal()))) { 
			$sSQL = "select id,address,area,zip,country,voice1,voice2,fax from custaddress";
			$sSQL.= " where id=$id and ccode=". $db->qstr($user);	   
		}		
		else { //basic
			$sSQL = "select id,address,area,zip,country,voice1,voice2,fax from customers";
			$sSQL.= " where active=1 and code2=". $db->qstr($user);	   
        }	
		
		$res = $db->Execute($sSQL);
		
		if ($res->fields[0]) //found, bypass id token
			$ret = ($tokens) ? array($res->fields[1],$res->fields[2],$res->fields[3],$res->fields[4],$res->fields[5],$res->fields[6]) :
							   implode(' ', array($res->fields[1],$res->fields[2],$res->fields[3],$res->fields[4],$res->fields[5],$res->fields[6]));		
		
		return ($ret ? $ret : 'Invalid address');	
	}	
	
	public function addnewdeliverylink($dpc_after_goto=null) {
		$mydpcgoto = $dpc_after_goto?$dpc_after_goto:$this->adddelivgoto;
	
		if ($mydpcgoto) 
			SetSessionParam('afterdelivgoto',str_replace('>','.',$mydpcgoto));

		$link = seturl('t=addnewdeliv');//,localize('_ADDDELIVADDRESS',getlocal()));	
		$out = $this->myf_button(localize('_ADDDELIVADDRESS',getlocal()),$link);
		return ($out);
	}
	
	public function show_customer_delivery() {
        $db = GetGlobal('db');		   
	    $UserName = GetGlobal('UserName');
	    $myui = $uid ? $uid : decode($UserName);
	   	   
	    //template
		$mytemplate = _m('cmsrt.select_template use showdeliverylist'); 
		
		//new form
        $out = $this->adddeliveryform();		
		
		//existed forms to select	
	    $addressfields = implode(',',$this->delivery_fields);
        $sSQL = "select id,$addressfields from custaddress";
	    $sSQL.= " where ccode=". $db->qstr($myui);
	    $sSQL.= " order by id DESC"; //last to first..selected last address inserted	   
	    //echo $sSQL;	   
        $result = $db->Execute($sSQL,2);	
	   
	    if ($UserName) {
		   foreach ($result as $n=>$na) {
			   
				if (!empty($na)) {	   
					$id = $na[0];
					$_deleteaddresslink = seturl('t=removedeliv&id='.$id);
					$deleteaddresslink = $this->myf_button(localize('_REMDELIVADDRESS',getlocal()),$_deleteaddresslink);
					$_selectaddresslink = seturl($this->delivery_goto_url . '&addressway='.$id);
					$selectaddresslink = $this->myf_button(localize('_SELDELIVADDRESS',getlocal()),$_selectaddresslink);

					foreach ($this->delivery_fields as $i=>$in) 
						$tokens[] = $na[$in];	
				   
					$tokens[] = $selectaddresslink; 				   
					$tokens[] = $deleteaddresslink; 		   
			   
					$out .= $this->combine_tokens($mytemplate,$tokens);	
				 
					unset($tokens);		   			      		   
				}//if
			}//foreach	    
	    }//if username	   
	   
	    return ($out);
	}
	
	
	public function adddeliveryform($retokensout=null) {
	    $sFormErr = GetGlobal('sFormErr');		
	
	    //template
		$mytemplate = _m('cmsrt.select_template use showdeliveryform');
	   
	    $o = $sFormErr;  	   	
		$tokens[] = $o;		 
	 
        foreach ($this->delivery_fields as $field_num => $fieldname) { 
			$tokens[] = GetParam($fieldname.'_d');
	    }
	   
		if ($retokensout) 
			return ($tokens);		   
 
		$wout = $this->combine_tokens($mytemplate,$tokens);			   		 
		return ($wout); 
	}
	
	protected function savedeliveryaddress() {
        $db = GetGlobal('db');	
	    $UserName = GetGlobal('UserName');
	    $myui = decode($UserName);
	   
	    //delivery address
	    if (!$error = $this->check_delivery_address(null,$this->checkuseasterisk)) {
	   
			//before set active the current record deactive all others  
			$d = $this->deactivatedeliveryaddress();
	   
			//save at customer address book
			//print_r($_POST);
			foreach ($this->delivery_fields as $fn=>$fname) {
				$delivdata[] = $db->qstr(GetParam($fname.'_d')); //to separate from default address name fields  
			}	  		   
			$addressfields = implode(',',$this->delivery_fields);
			$sSQL2 = "insert into custaddress (ccode,active,$addressfields)";
			$sSQL2.= " values (". $db->qstr($myui). ",1,";
			$sSQL2.= implode(',',$delivdata);
			$sSQL2.= ")";

			//echo $sSQL2;
			$result2 = $db->Execute($sSQL2,1);	
			if ($ret = $db->Affected_Rows()) 
				return true;			   	   	   
	    }
		else 
			SetGlobal('sFormErr',$error);
		
		return false;	   	
	}
	
	protected function removedeliveryaddress() {
	    $id = GetReq('id');
        $db = GetGlobal('db');	
	    $UserName = GetGlobal('UserName');
	    $myui=decode($UserName);	
	   
	    if ($id) {
			$sSQL = "delete from custaddress";
			$sSQL.= " where ccode=". $db->qstr($myui) . ' and id=' . $id;
			//echo $sSQL;	   
			$result = $db->Execute($sSQL,1);	 
	    }
	     
        if ($ret = $db->Affected_Rows()) 
			return true;		     
	    else
			return false;	 
	}
	
	//id = logon name
	protected function deactivatedeliveryaddress($id=null) {
        $db = GetGlobal('db');	
	    $UserName = GetGlobal('UserName');
	    $myui = $id ? $id : decode($UserName);	   
	   
	    if ($id) {
			$sSQL = "update custaddress set active=0";
			$sSQL.= " where ccode=". $db->qstr($myui);
			//echo $sSQL;	   
			$result = $db->Execute($sSQL,1);	 
	    }
	     
        if ($ret = $db->Affected_Rows()) 
			return true;		     

		return false;		
	}
	
	
	
	/////////////////////////////////////////////////// CUSTOMER DETAILS
	
	protected function makecustomerform($tokensout=null) {
	
		$tokens[] = localize('_CUSTOMER',getlocal());
		$recfields = $this->get_cus_record(1);	
        
		foreach ($recfields as $fnum => $fname) {
			$data[$fnum] = ToHTML(GetParam(_with($fname)));
		}
	   
		//show data
		reset ($recfields);
		reset ($data);
		foreach ($recfields as $field_num => $fieldname) {
	   
			//inputs .._d..to separate from default address name fields in the same form  
			$tokens[] = $data[$field_num];

		}
	   
		return ($tokens);		   
	}	

	public function showcustomers($name=null,$combo=null,$uid=null,$style=null,$preselect=null) {
        $db = GetGlobal('db');	
	    $UserName = GetGlobal('UserName');
	    $myui=$uid?$uid:decode($UserName);
	    $customerway = $preselect ? $preselect : GetReq('customerway');
	    $out = null;
	    $style = $style ? $style : "myf_select";
	   
	    $recfields = $this->get_cus_record(1);	   
			  		   
	    $record = implode(',',$recfields);
        $sSQL = "select id,name,$record,active from customers";
	    $sSQL.= " where code2=". $db->qstr($myui);

	    if ($customerway)
			$sSQL .= " and id=" . $customerway;
	    $sSQL .= " order by active DESC"; //id = last to first..selected last address inserted, active first
	   	  
		$result = $db->Execute($sSQL,2);

		$m = 0;    
		if ($db->Affected_Rows()) {

			if ($combo) {
				$out .= "<select name=\"".$name."\" class=\"".$style."\">";		      
		   
				foreach ($result as $n=>$na) {
					if (!empty($na[1])) {	 
				 		
						$title = $na[1];
						$value = $na[0];
						$out .= "<option value=\"$value\"".($value == $customerway ? " selected" : "").">$title</option>";
						$m+=1;
					}  
				}
		   
				$out .= "</select>";		
		   
				return ($out);				
			}
			elseif ($preselect) {
				//return customer name ass tring to show after cart 2nd step
				return ($result->fields['name']);
			}
			else {
				foreach ($result as $n=>$na) {	
					if (!empty($na)) {
						$ret .= localize('_CUSTOMER',getlocal()) . ' ' . $na[1];//($n+1);	
						$ret .= '<br>';
						foreach ($recfields as $i=>$in) {
							$ret .= localize($in,getlocal()).':'.$na[$in].'<br>';
						}	
						$ret .= '<hr><COMMA>'; 
						$m+=1;			       
					}  	   
				}
		   
				$out = substr($ret,0,-1);	
				if ($m>1)
					return ($out);				   	    	 
			}
		}//result 
	}	
	
	public function addnewcustomerlink($dpc_after_goto=null) {
	    $mydpcgoto = $dpc_after_goto ? $dpc_after_goto : $this->addcusgoto;
	
        if ($mydpcgoto) 
       	  SetSessionParam('aftercusgoto',str_replace('>','.',$mydpcgoto));

	    $link = seturl('t=addnewcus');	
	    $out = $this->myf_button(localize('_ADDCUSTOMER',getlocal()),$link);
	    return ($out);
	}	
	
	public function show_customers_list() {
        $db = GetGlobal('db');		   
	    $UserName = GetGlobal('UserName');
	    $myui=$uid?$uid:decode($UserName);
	    $action = GetReq('t');
	   
	    //template 1
		$mytemplate = _m('cmsrt.select_template use showcustomerlist');	
	   
	    //template 2
		$mytemplate2 = _m('cmsrt.select_template use cusshow');	
	   
	    $recfields = $this->get_cus_record(1,1);	      
			  		   
	    $record = implode(',',$recfields);
        $sSQL = "select id,$record,active from customers";
	    $sSQL.= " where code2=". $db->qstr($myui);
	   
	    ///// FETCH also mail=userid !!!!!!!!
	    if ($this->fkey)
			$sSQL .= " or " . $this->fkey . "=" . $db->qstr($myui);//<<<<compatibility	  
		  
	    $sSQL.= " order by active DESC"; //last to first..selected last address inserted	   
	    //echo $sSQL;	   
        $result = $db->Execute($sSQL,2);
	   
	    if ($UserName) {
	   
		    foreach ($result as $n=>$na) {	  
			 
			    $myactions = array();
			 
			    $id = $na[0];
			   
			    if ($action == 'addnewcus') {//in cart change	
					$myactions[] = null; 
			    }	 
			    else {//just modify account
					$signup2 = "editcus/$id/"; //seturl('t=signup2&a='.$id);
					$myactions[] = $this->myf_button(localize('_UPDCUSTOMER',getlocal()),$signup2);
			    }	 
			   
			    if ($action == 'addnewcus') {//in cart change	
					$cgoto = seturl($this->customer_goto_url . '&customerway='.$id);
					$myactions[] = $this->myf_button(localize('_SELCUSTOMER',getlocal()),$cgoto);
			    }	 
			    else {
					$selcus = "selectcus/$id/"; //seturl('t=selcus&id='.$id);			 			   
					$myactions[] = $this->myf_button(localize('_SELCUSTOMER',getlocal()),$selcus);
			    }
			   
			    if ($action == 'addnewcus') {//in cart change
					$myactions[] = null;
		        }		 
			    else {//just modify account
					$remcus = "removecus/$id/";//seturl('t=removecus&id='.$id);
					$myactions[] = $this->myf_button(localize('_REMCUSTOMER',getlocal()),$remcus);
			    }				 
			   
                if ($mytemplate2) 			   
					$data[] = implode('&nbsp;',$myactions);

			    foreach ($recfields as $i=>$in) {
					//$titles[] = localize($in,getlocal());
					$data[] = $na[$in];				 
			    }	 			 
			   				 
		        $ret .= $this->combine_tokens($mytemplate2,$data);					 
 
				unset($data);
			}	    
	    }	
	      
		$out .= $this->combine_tokens($mytemplate,array(0=>$ret));			   
        $out .= $this->addcustomerform();	 
		 
	    return ($out);
	}	
	
	public function addcustomerform($retokensout=null) {
	    $sFormErr = GetGlobal('sFormErr');		
	
	    //template	   
		$mytemplate = _m('cmsrt.select_template use cusregister');		
	   	
		if ($sFormErr!="ok")    
			$o = $sFormErr; 
  	   	
		$tokens[] = $o;		 	
	   
		$recfields = $this->get_cus_record(1,1);		    
		//'name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax','mail'
		foreach ($recfields as $field_num => $fieldname) {
			//inputs .._d..to separate from default address name fields in the same form  
			$tokens[] = GetParam($fieldname);
		}
	   	   
        $o = "<input type=\"submit\" class=\"".self::$myf_button_submit_class."\" value=\"" . localize('_SIGNUP',getlocal()) . "\">";	   
        $o .= "<input type=\"hidden\" name=\"FormName\" value=\"savenewcus\">";   
		$o .= "<input type=\"hidden\" name=\"FormAction\" value=\"savenewcus\">"; 
		$tokens[] = $o;
		//print_r($tokens);
	   
        if ($retokensout) {
		   return ($tokens);		   
	    }
	    else {	 
			$wout = $this->combine_tokens($mytemplate,$tokens);			   
			return ($wout); 
	    }	
	}	
	
	protected function save_customer($userid=null) { 
        $db = GetGlobal('db');	
	    $UserName = GetGlobal('UserName');
	    $myui = $userid ? $userid : decode($UserName);
	   
	    if (!$error = $this->checkFields(null,$this->checkuseasterisk)) {
	   
			//before set active the current record deactive all others  
			$d = $this->deactivatecustomers();	   
	   
			$recfields = $this->get_cus_record(1,1);	

			foreach ($recfields as $fn=>$fname) {
				//echo $fname,':',$db->qstr(GetParam($fname)),'<br>';
				$cusdata[] = $db->qstr(GetParam($fname)); 
			}	 
			  		   
			$cusfields = implode(',',$recfields);
			$sSQL2 = "insert into customers (code2,active,$cusfields)";
			$sSQL2.= " values (". $db->qstr($myui). ",1,";
			$sSQL2.= implode(',',$cusdata);
			$sSQL2.= ")";

			//echo $sSQL2;
			$result2 = $db->Execute($sSQL2,1);	
			if ($ret = $db->Affected_Rows()) {
				
				if ($this->tellit) {

					$mytemplate = _m('cmsrt.select_template use customerinserttell');	
			
					$tokens[] = $myui;			
					$tokens[] = GetParam('name');	
					$tokens[] = GetParam('afm');						
					$tokens[] = GetParam('eforia');			
					$tokens[] = GetParam('prfdescr');
					$tokens[] = GetParam('address');
					$tokens[] = GetParam('area');														
					$tokens[] = GetParam('zip');			
					$tokens[] = GetParam('country');
					$tokens[] = GetParam('voice1');			
					$tokens[] = GetParam('voice2');			
					$tokens[] = GetParam('fax');			
					$tokens[] = GetParam('mail');			
			
					$mailbody = $this->combine_tokens($mytemplate,$tokens);

					$from = $this->it_sendfrom ? $this->it_sendfrom : $email;
					$subject = localize('CustomerInsData',getlocal());
					//$this->mailto($from,$this->tellit,$subject,$mailbody);
					$body = str_replace('+','<SYN/>',$mailbody); 
					$mailerr = _m("cmsrt.cmsMail use $from+{$this->tellit}+$subject+$body");
				}					
				
				return true;			   	   	 
		   }
	    }
		else {
			//SetGlobal('sFormErr',$error);
		   	$this->checkFieldsJs($error);
		}
		
		return false;	   	
	}
	
	protected function remove_customer() {
	    $id = GetReq('id');
        $db = GetGlobal('db');	
	    $UserName = GetGlobal('UserName');
	    $myui=decode($UserName);	
	   
	    if ($id) {
			//check if last record
			$sSQL = "select count(id) from customers";
			$sSQL.= " where code2=". $db->qstr($myui);
			$res = $db->Execute($sSQL,2);	   	 	   
			$counter = intval($res->fields[0]);
		 
			if ($counter>1) {
				//$sSQL = "delete from customers"; //UNMAP
				$sSQL = "update customers set code2='', mail=''";
				$sSQL.= " where code2=". $db->qstr($myui) . ' and id=' . $id;
				//echo $sSQL;	   
				$result = $db->Execute($sSQL,1);	 
		   
				if ($ret = $db->Affected_Rows()) { 
					$this->deactivatecustomers(); //deactivate all
					$this->activatecustomer();//activate last before this deleted	   
					return true;
				}
			}
			else {
				$error = localize('_DELNOTALLOW',getlocal()); //'Last entry can not deleted!';
				SetGlobal('sFormErr',$error);  
			}  
	    }
	   
        return false;	 
	}	
	
	public function deactivatecustomers($id=null) {
        $db = GetGlobal('db');	
	    $UserName = GetGlobal('UserName');
	    $myui = $id?$id:decode($UserName);	
	   
	    if ($myui) {
			$sSQL = "update customers set active=0";
			$sSQL.= " where code2=". $db->qstr($myui);   
			$result = $db->Execute($sSQL,1);	 
	    }
	     
        if ($ret = $db->Affected_Rows()) 
			return true;		     
		
		return false;		
	}	
	
	//id = id record of table
	public function activatecustomer($id=null) {
        $db = GetGlobal('db');	
	    $UserName = GetGlobal('UserName');	   
	    $myui = decode($UserName);		   
	   
	    if (!$id) {
			//find last entry to activate
			$sSQL = "select id from customers";
			$sSQL.= " where code2=". $db->qstr($myui);
			$sSQL .= " order by id "; //last to first..selected last address inserted
	   	 
			//echo $sSQL;	   
			$result = $db->Execute($sSQL,2);	
			foreach ($result as $n=>$na) {	  
				$id = $na[0];
			}
	    } 
	   
	    if ($id) {
			$sSQL = "update customers set active=1";
			$sSQL.= " where id=". $id;   
			$result = $db->Execute($sSQL,1);	 
	    }
	     
        if ($ret = $db->Affected_Rows()) 
			return true;		     

		return false;		
	}	
	
	public function show_customer_title() {
        $db = GetGlobal('db');	
	    $UserName = GetGlobal('UserName');	   
	    $myui = decode($UserName);
	   
	    if ($myui) {
			//find last entry to activate
			$sSQL = "select name from customers";
			$sSQL.= " where code2=". $db->qstr($myui);
			$sSQL .= " order by id "; //last to first..selected last address inserted
   
			$result = $db->Execute($sSQL,2);	
			foreach ($result as $n=>$na) {	  
				$ret = $na[0];
			}
		 
			return ($ret);
	    }
	   
	    return null;	   		
	}
	
	public function save_guest_customer($email=null,$name=null,$address=null,$postcode=null,$country=null,$tel=null) {
		$db = GetGlobal('db');	
		if (!$email) return false;
		
		if ((trim($country)) && (strstr(trim($country), ' '))) {
			$p = explode(' ', trim($country));
			$cuscity = array_shift($p);
			$cuscountry = implode(' ', $p); //rest array
		}
		else
			$cuscity = $cuscountry = ($country ? trim($country) : '');
		
		$sSQL = "insert into customers (code2,active,name,address,area,zip,city,country,mail,voice1)";
		$sSQL.= " values (". $db->qstr($email). ",1,'$name','$address','$address','$postcode','$cuscity','$cuscountry','$email','$tel')";
		//echo $sSQL2;
		
		$result = $db->Execute($sSQL,1);	
		if ($ret = $db->Affected_Rows()) 
			return true;	
		
		return false;
	}

	public function save_guest_deliveryaddress($email=null,$name=null,$address=null,$postcode=null,$country=null,$tel=null) {	
		$db = GetGlobal('db');	
		if (!$email) return false;
		
		if ((trim($country)) && (strstr(trim($country), ' '))) {
			$p = explode(' ', trim($country));
			$cuscity = array_shift($p);
			$cuscountry = array_pop($p); //implode(' ', $p); //rest array
		}
		else
			$cuscity = $cuscountry = ($country ? trim($country) : '');
	   
	    //delivery address

		//before set active the current record deactive all others  
		$d = $this->deactivatedeliveryaddress($email);
	   
		$sSQL = "insert into custaddress (ccode,active,address,area,zip,country,mail,fax,voice1)";
		$sSQL.= " values (". $db->qstr($email). ",1,'$address','$cuscity','$postcode','$cuscountry','$email','$name','$tel')";
		//echo $sSQL;
		
		$result = $db->Execute($sSQL,1);	
		if ($ret = $db->Affected_Rows()) 
			return true;			   	   	   
		
		return false;	   	
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
		  
	    foreach ($tokens as $i=>$tok) {
		    $ret = str_replace("$".$i."$",$tok,$ret);
	    }
		//clean unused token marks
		for ($x=$i;$x<20;$x++)
		  $ret = str_replace("$".$x."$",'',$ret);

		return ($ret);
	}

	protected static function myf_button($title,$link=null,$image=null) {

	    $path = self::$staticpath;//$this->urlpath;//
	    $bc = self::$myf_button_class;
	   
	    if (($image) && (is_readable($path."/images/".$image.".png"))) {
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
		  
	    $ret .= "<input type=\"button\" class=\"$bc\" value=\"".$title."\" />";
	   
	    if ($link)
          $ret .= "</a>";	   
		  
	    return ($ret);
	}	

};
}
?>