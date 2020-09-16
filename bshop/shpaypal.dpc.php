<?php

$__DPCSEC['SHPAYPAL_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("SHPAYPAL_DPC")) && (seclevel('SHPAYPAL_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("SHPAYPAL_DPC",true);

$__DPC['SHPAYPAL_DPC'] = 'shpaypal';

//$d = GetGlobal('controller')->require_dpc('bshop/paypal.dpc.php');
//require_once($d); 
require_once(_r('bshop/paypal.dpc.php'));

GetGlobal('controller')->get_parent('SHPAYPAL_DPC','PAYPAL_DPC');

$__EVENTS['SHPAYPAL_DPC'][0]='paypal';
$__EVENTS['SHPAYPAL_DPC'][1]='process';
$__EVENTS['SHPAYPAL_DPC'][2]='payreturn';
$__EVENTS['SHPAYPAL_DPC'][3]='paycancel';
$__EVENTS['SHPAYPAL_DPC'][4]='payipn';
 
$__ACTIONS['SHPAYPAL_DPC'][0]='paypal';
$__ACTIONS['SHPAYPAL_DPC'][1]='process';
$__ACTIONS['SHPAYPAL_DPC'][2]='payreturn';
$__ACTIONS['SHPAYPAL_DPC'][3]='paycancel';
$__ACTIONS['SHPAYPAL_DPC'][4]='payipn';


$__DPCATTR['SHPAYPAL_DPC']['shpaypal'] = 'paypal,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['SHPAYPAL_DPC'][0]='SHPAYPAL_DPC;Paypal;Paypal';   
 
class shpaypal extends paypal {

	var $title;
	var $reset_database;
	var $paypal_data;
   
	var $transaction, $amount;
	var $error;
	var $path, $title2show;
	var $paypal_mail,$inform_ipn_mail;
   
	var $paypal_payment;     

	public function __construct() {
		$UserSecID = GetGlobal('UserSecID');
		$UserName = GetGlobal('UserName');
		$UserID = GetGlobal('UserID');

		$this->userLevelID = (((decode($UserSecID))) ? (decode($UserSecID)) : 0);
		$this->username = decode($UserName);
		$this->userid = decode($UserID);   
	 
		paypal::__construct();  
	 
		$this->path = paramload('SHELL','prpath'); 
	 	 
		$this->title = localize('SHPAYPAL_DPC',getlocal());	
	  
		$sandbox = remote_paramload('SHPAYPAL','sandbox',$this->path);
		if ($sandbox)
			$this->p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
		else  
			$this->p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
	   
		$this->paypal_payment = false; //init; 
            
		$rp = remote_paramload('SHPAYPAL','returnpage',$this->path);       
		$page = $rp?$rp:$_SERVER['PHP_SELF'];
		$inpath = paramload('ID','hostinpath');
		$this->this_script = paramload('SHELL','urlbase') . '/'. $page;

		// if there is not action variable, set the default action of 'process'
		//if (empty($_GET['action'])) $_GET['action'] = 'process'; 
	  
		//$this->title2show = GetParam('title');
		$this->title2show =  remote_paramload('SHPAYPAL','title',$this->path);	  
		$this->transaction = GetSessionParam('paypalID')?GetSessionParam('paypalID'):GetReq('tid');
	  
		$currency = remote_paramload('SHPAYPAL','currency',$this->path);
	  
		switch ($currency) {
		  
		    case 'EUR'   : $this->amount = number_format(GetSessionParam('amount'),2,'.',',');
			               break;
			case 'DLR'   :
			default      : $this->amount = number_format(GetSessionParam('amount'),2,'.',',');
		}	
    }
   
    public function event($event=null) {
   
		switch ($event) {  
       case 'payreturn'	: 	$this->paypal_payment = $this->verify_paypal_post(); 
							if ($this->paypal_payment) {
								// Order was successful...
								$this->handle_Transaction('success');
								if (defined('SHCART_DPC')) {
									_m("shcart.submitCartOrder use " . GetReq('tid'));
								}						   
							}
							else   
								$this->handle_Transaction('error');
							break;
       case 'paycancel' : 	//$this->savelog("PAYPAL PAYMENT:CANCELED");	
							$this->handle_Transaction('cancel');
							if (defined('SHCART_DPC')) {
								_m("shcart.cancelCartOrder");
							}	 
							break;
       case 'payipn'    : 	// Paypal is calling page for IPN validation...	
							/*if ($this->p->validate_ipn()) {
	                   if ($this->verify_paypal_ipn()) {//to check mail ,txn_id
	                     $this->handle_Transaction('ipn');	
	                     if ($f = fopen($this->path."/paypal_last_ipn.txt",'w+')) {
					       //$pstr = implode('::',$_POST);
						   foreach ($_POST as $id=>$val)
						     $pstr .= "[".$id."]=".$val."\r\n";
	                       fwrite($f,$pstr,strlen($pstr));
		                   fclose($f);
	                     }						   					      	   
					   }	 
					   }
							die();*/
							$status = $this->paypal_ipn();
							if ($status==true)
								$this->savelog("PAYPAL PAYMENT:IPN IN PROCEESS!!!");		
							else
								$this->savelog("PAYPAL PAYMENT:IPN STATUS ERROR!!!");		                      
							break;
					   
	   case 'paypal'	:
	   case 'process'	: 					   
       default      	:    
							$cust_data = _m("shcustomers.getcustomer");//default mail=username.. use ".$this->userid); 					     
							if (is_array($cust_data)) {
					   
								$this->p->add_field('address_override', '1');
					 
								$this->p->add_field('address1', $cust_data[4]);
								$this->p->add_field('address2', $cust_data[5]);
								$this->p->add_field('city', $cust_data[2]);
								//$this->p->add_field('country', 'EUR'); //must be country code
								$this->p->add_field('first_name', $cust_data[0]);
								$this->p->add_field('last_name', $cust_data[1]);
								$this->p->add_field('zip', $cust_data[6]);
							}
					   
							$this->p->add_field('charset', $this->mycharset);//choose based on site lang
					   
							$this->p->add_field('currency_code', 'EUR');
							$this->p->add_field('invoice', $this->transaction );
	   	   
							$this->p->add_field('business', $this->paypal_mail);//'YOUR PAYPAL (OR SANDBOX) EMAIL ADDRESS HERE!');
							$this->p->add_field('return', $this->this_script.'?t=payreturn&tid='.$this->transaction); //back to invoice view
							$this->p->add_field('cancel_return', $this->this_script.'?t=paycancel&tid='.$this->transaction); //back to invoice view
							$this->p->add_field('notify_url', $this->this_script.'?t=payipn&tid='.$this->transaction);
					   
							//$name = _m("stutasks.get_task_pay_title use ".$this->transaction);                       	      
							$this->p->add_field('item_name', $this->title2show);
                       
							//$price = _m("stutasks.get_task_pay_amount use ".$this->transaction);
							$this->p->add_field('amount', $this->amount); 
					   
							if ($this->amount>0) {	
								$this->p->submit_paypal_post(); // submit the fields to paypal
								die();
							}
							//else goto fp	 
	                   
							break;		   
		}
    }
   
    function action($action=null) {
   
		switch ($action) {
		case 'payreturn' :  if ($this->paypal_payment) {
   						      $ret = $this->set_message('success');
		                      if (defined('SHCART_DPC')) {
		                        //$ret = $this->set_message('success'); //NO
								//NO NEED...called into cartview tid+3
		                        //$ret .= _m("shcart.finalize_cart use ".GetReq('tid'));
								
                                $ok = _m("shcart.loadcart use ".GetReq('tid'));
							    if ($ok) {
		                          $ret .= _m("shcart.cartview use ".GetReq('tid')."+3");								
								  _m("shcart.clear");
								}  
						      }	 
							}  
							else {
						      $ret = $this->set_message('error');
		                      if (defined('SHCART_DPC')) {							  
							    //reload cart from error transaction
							    $ok = _m("shcart.loadcart use ".GetReq('tid'));
							    if ($ok)
		                          $ret .= _m("shcart.cartview use ".GetReq('tid'));							
							  }	  
							}
		                 break;
		case 'paycancel'  : if (defined('SHCART_DPC')) {
		                     $ret = $this->set_message('cancel');   
							 //reload cart from canceled transaction
							 $ok = _m("shcart.loadcart use ".GetReq('tid'));
							 if ($ok)
		                       $ret .= _m("shcart.cartview use ".GetReq('tid'));
							 //else goto fp  
						   }	 
						   else 
		                    $ret = $this->set_message('cancel');	
		                 break;
		case 'payipn'     : $ret = null;
		                 break; 
		case 'paypal':				 
	    case 'process' : //$ret = $this->error;//null;//must not have action, if error goto frontpage'Please wait processing...'; 
	    default        : //in case of no amount (error?) goto fp 		
		                 //$ret = seturl('t=',localize('_HOME',getlocal()));
						 $out = setNavigator(seturl("t=",localize('_HOME',getlocal())),$this->title);
		                 $ret .= $this->set_message('error');
						 if (defined('SHCART_DPC')) { 
							 //reload cart from canceled transaction
							 $ok = _m("shcart.loadcart use ".GetReq('tid'));
							 if ($ok)
		                       $ret .= _m("shcart.cartview use ".GetReq('tid'));
							 //else goto fp  
						 }

		}
	 
		return ($ret);
	}
   
    function paypal_ipn() {
   
	    if ($f = fopen($this->path."paypal_last_ipn.txt",'w+')) {
		    $pstr = GetReq('key').'\rInitialize...';
	        fwrite($f,$pstr,strlen($pstr));
		    fclose($f);
	    }
		
		//echo 'a';	 					   
        if ($this->p->validate_ipn()) {
	        if ($f = fopen($this->path."paypal_last_ipn.txt",'a+')) {
		        $pstr = GetReq('key').'\rValidated...';
	            fwrite($f,$pstr,strlen($pstr));
		        fclose($f);
	        }		
	    //echo 'b';			   
	    if ($this->verify_paypal_ipn()) {//to check mail ,txn_id
					   
		    if ($f = fopen($this->path."paypal_last_ipn.txt",'a+')) {
		        $pstr = GetReq('key').'\rVerified...';
	            fwrite($f,$pstr,strlen($pstr));
		        fclose($f);
			}
			//echo 'c';
			$ret = $this->handle_Transaction('ipn');	
						 
			if ($f = fopen($this->path."paypal_last_ipn.txt",'a+')) {
				//$pstr = implode('::',$_POST);
				foreach ($_POST as $id=>$val)
					$pstr .= "[".$id."]=".$val."\r";
					fwrite($f,$pstr,strlen($pstr));
					fclose($f);
			}
			//echo 'd';						   					      	   
		}	 
					   }				   
		return ($ret);				   
    }   
   
    function verify_paypal_ipn() {
		$id = $this->transaction?$this->transaction:GetReq('tid');   
	 
		if (($_POST['receiver_email']==$this->paypal_mail) && ($this->txnid_is_unique())) {
			_m("shtransactions.setTransactionStoreData use $id+costpt+".$_POST['payment_gross']);
			_m("shtransactions.setTransactionStoreData use $id+type1+".$_POST['txn_id']);		 
		   	 
			return true;	  
		}  
	 
		return false;
    } 
   
    function txnid_is_unique() {
   
		$isunique = false;
	 
		//check ipn posts
		if ( (defined('SHTRANSACTIONS_DPC')) && (seclevel('SHTRANSACTIONS_DPC',decode(GetSessionParam('UserSecID')))) ) {
					   	 
			if (isset($_POST['txn_id'])) {
				//$isunique = _m("shtransactions.checkPaypalTXNID use ".$_POST['txn_id']);	 
				$isunique = _m("shtransactions.is_unique use ".$_POST['txn_id']);
	   
				return ($isunique);	
			}
			return false;    
		}
		//else //in case of no transaction modules return always true...
		return true;	  
    }  
   
    function verify_paypal_post() {
   
		if ( (defined('SHTRANSACTIONS_DPC')) && (seclevel('SHTRANSACTIONS_DPC',decode(GetSessionParam('UserSecID')))) ) {
	 
			$status = _m("shtransactions.getTransactionStatus");
			if ($status>0)
				return true;
		}
	 
		return 1;//false;   
    }    
   
    function handle_Transaction($status) {

        if ( (defined('SHTRANSACTIONS_DPC')) && (seclevel('SHTRANSACTIONS_DPC',decode(GetSessionParam('UserSecID')))) ) {
                
                $id = $this->transaction?$this->transaction:GetReq('tid');

                switch ($status) {
                    case 'ipn'    : _m("shtransactions.setTransactionStatus use $id+1");
                                    break;
                    case 'success': _m("shtransactions.setTransactionStatus use $id+2");
                                    break;													
                    case 'cancel' : _m("shtransactions.setTransactionStatus use $id+-1");
                                    break;
                    case 'error'  : _m("shtransactions.setTransactionStatus use $id+-2");
                                    break;									
                }
        }
    }

    //override
    function set_message($case,$errorcode=null) {
   
	    $template = remote_paramload('PAYPAL',$case,$this->path) . '.htm'; //'fpcartline.htm';

	    if ($t = _m("cmsrt.select_template use $template")) 
			$ret = @file_get_contents($t);
	    else
			$ret = $m ? $m : localize($errorcode,getlocal()); //plain text
		  
		if ($errorcode)
			$ret .= "<h2>[ERRORCODE:".$errorcode."]</h2>";
		  
		return ($ret);    	   
    }   
      	
}; 
} 
?>