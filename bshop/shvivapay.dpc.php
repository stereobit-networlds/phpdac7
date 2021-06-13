<?php
/*
https://developer.vivawallet.com/
https://developer.vivawallet.com/online-checkouts/redirect-checkout/
https://developer.vivawallet.com/getting-started/create-a-payment-source/redirect-checkout/
https://developer.vivawallet.com/getting-started/sandbox-demo-account/
https://demo.vivapayments.com/ 
*/
$__DPCSEC['SHVIVAPAY_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("SHVIVAPAY_DPC")) && (seclevel('SHVIVAPAY_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("SHVIVAPAY_DPC",true);

$__DPC['SHVIVAPAY_DPC'] = 'shvivapay';

//require_once(_r('libs/sha256.lib.php'));
//require_once(_r('libs/sha256pharapp.lib.php'));
//require_once(_r('libs/nanosha2.lib.php'));

$__EVENTS['SHVIVAPAY_DPC'][0]='vivapay';
$__EVENTS['SHVIVAPAY_DPC'][1]='process';
$__EVENTS['SHVIVAPAY_DPC'][2]='payreturn';
$__EVENTS['SHVIVAPAY_DPC'][3]='paycancel';
$__EVENTS['SHVIVAPAY_DPC'][4]='payticket';
 
$__ACTIONS['SHVIVAPAY_DPC'][0]='vivapay';
$__ACTIONS['SHVIVAPAY_DPC'][1]='process';
$__ACTIONS['SHVIVAPAY_DPC'][2]='payreturn';
$__ACTIONS['SHVIVAPAY_DPC'][3]='paycancel';
$__ACTIONS['SHVIVAPAY_DPC'][4]='payticket';


$__DPCATTR['SHVIVAPAY_DPC']['shvivapay'] = 'vivapay,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['SHVIVAPAY_DPC'][0]='SHVIVAPAY_DPC;Viva Pay;Viva Pay'; 
$__LOCALE['SHVIVAPAY_DPC'][1]='_PLEASEWAIT;Please wait, your order is being processed...;Παρακαλώ περιμένετε...';  
$__LOCALE['SHVIVAPAY_DPC'][2]='_PAYCANCEL;Transaction canceled.;Ακυρωση συναλλαγης.';  
$__LOCALE['SHVIVAPAY_DPC'][3]='_PAYERROR;Error during payment. Please try later.;Λανθασμένη συναλαγή. Παρακαλώ δοκιμάστε αργότερα.';  
$__LOCALE['SHVIVAPAY_DPC'][4]='_SRVERROR;Unknown error. Please try later.;Άγνωστο σφάλμα. Παρακαλώ δοκιμαστε αργότερα.';  
$__LOCALE['SHVIVAPAY_DPC'][5]='_VIVAPAY;Credit card;Πιστωτική κάρτα'; 
$__LOCALE['SHVIVAPAY_DPC'][6]='_mailSubject;Transaction No ;Παραστατικό αγοράς Νο '; 
$__LOCALE['SHVIVAPAY_DPC'][7]='_PAYERROR;Error in redirection;Μη έγκυρη ανακατεύθυνση'; 
 
class shvivapay  {

	protected $title, $transaction, $amount, $error, $path, $title2show, $fields, $lancode, $lan;   
	protected $viva_payment, $paysource, $merchantid, $viva_user, $viva_pass, $parambacklink;   
	protected $create_post_args, $return_post_args, $msg, $debug, $debug_return;
	
	public $viva_url;
  
  
	public function __construct() {
		$UserSecID = GetGlobal('UserSecID');
		$UserName = GetGlobal('UserName');
		$UserID = GetGlobal('UserID');

		$this->userLevelID = (((decode($UserSecID))) ? (decode($UserSecID)) : 0);
		$this->username = decode($UserName);
		$this->userid = decode($UserID);   
	 
		$this->path = paramload('SHELL','prpath'); 
		//$inpath = paramload('ID','hostinpath');	 	 
		$this->title = localize('SHVIVAPAY_DPC',getlocal());
	  
		$this->msg = null;
		$this->debug = 0;//1;	  
		$this->debug_return = 0;//1;	  		  
	  
		$this->paysource =  remote_paramload('SHVIVAPAY','paysource',$this->path);	
		$this->title2show =  remote_paramload('SHVIVAPAY','title',$this->path);	  
		//$this->amount = GetSessionParam('amount') ? GetSessionParam('amount') : 0.10;	//cart value
		$pay = GetSessionParam('amount') ? GetSessionParam('amount') : 0.10;	//cart value
		//echo $pay;
		$this->amount = strval(number_format($pay,2,',','.'));	  
	  
		/*if (($this->debug) || ($this->debug_return))
	       //test transaction (already in trnas table)
	    $this->transaction = 1073;
		else*/ //normal cart process
	  	$this->transaction = GetSessionParam('vivapayID') ? GetSessionParam('vivapayID') : GetReq('tid');	 

	  
		$sandbox = true; //remote_paramload('SHVIVAPAY','sandbox',$this->path);
		//echo '>',$sandbox;
		if ($sandbox)
			$this->viva_url = "https://demo.vivapayments.com";
		else  
			$this->viva_url = "https://www.vivapayments.com";
           
		$this->viva_payment = false; //init	   
		$this->fields = array();//empty data to send
	  	
		$this->merchantid =  remote_paramload('SHVIVAPAY','merchantid',$this->path);		
		$this->viva_user =  null;//remote_paramload('SHVIVAPAY','user',$this->path);	
		$this->viva_pass =  remote_paramload('SHVIVAPAY','pass',$this->path);		  	
	  	  
		$this->lan = getlocal();  
		switch ($this->lan) {
			case 1  : $this->lancode =  'el-GR'; break;
			case 0  : 
			default : $this->lancode =  'en-GB'; 
		} 	  		  
		
		$this->create_post_args = array('OrderCode','ErrorCode','ErrorText','TimeStamp','EventId','Success');
	  
		$this->parambacklink = 't=paycancel&tid='.$this->transaction;//remote_paramload('SHEUROBANK','parambacklink',$this->path);       
		$this->return_post_args = array('mid','orderid','status','orderAmount','currency','paymentTotal','message','riskScore','payMethod','txId','paymentRef','digest');
	  
        //$page = $this->parambacklink?$this->parambacklink:$_SERVER['PHP_SELF'].'?t=paycancel&tid='.$this->transaction;
        //$this->this_script = 'http://'.$_SERVER['HTTP_HOST'].$inpath.'/'.$page;
	}
   
	public function event($event=null) {
   
		switch ($event) {  
	 
		case 'payreturn' :	$this->viva_payment = $this->viva_receive_post(); 
	   
							if ($this->viva_payment) {
								// Order was successful...
								$this->handle_Transaction('success');
						   
								if (defined('SHCART_DPC')) {
							   
									$tid = $this->viva_get_post_params('orderid');
									$subject = localize('_mailSubject', getlocal()) . $tid;
									_m("shcart.submitCartOrder use $tid+$subject");//++invoice.htm+".$subject);
								}
							}
							else 
								$this->handle_Transaction('error');
					   
							break;
						 
		case 'paycancel' : 	//$this->savelog("PIRAEUS PAYMENT:CANCELED");	
							$this->handle_Transaction('cancel');
					   
							if (defined('SHCART_DPC')) 
								_m("shcart.cancelCartOrder");
					   
							break;
					   
		case 'payticket' : 	//not used ...procedure executes on process/default                 
							break;
					   
		case 'vivapay' :
		case 'process' :
		default        :	if ($this->amount>0) {	
								if ($this->viva_create_payment())	 
									die(); //must redirect
								else {
									//error
									$errdescr = localize('_PAYERROR', $this->lan);
									$errheader = localize('SHVIVAPAY_DPC', $this->lan);
									$this->jsDialog($errdescr, $errheader);
								}	
							}   
		}
	}
   
	public function action($action=null) {
   
		switch ($action) {
		case 'payreturn' : if ($this->viva_payment) {
			
			                 $tid = $this->viva_get_post_params('orderid');
							 
		                     if (defined('SHCART_DPC')) {
								  
		                          $ret .= _m("shcart.cartview use $tid+3");
								  _m("shcart.clear");
						     }	 
						   }
						   else {
							  
		                      if (defined('SHCART_DPC')) 						  
		                          $ret .= _m("shcart.cartview use ".$tid);//GetReq('tid'));
						   }	 
		                   break;
		case 'paycancel'  :    
						   if (defined('SHCART_DPC')) 
		                       $ret .= _m("shcart.cartview use ".GetReq('tid')."+2");	 
		                   break;
		case 'payticket' : $ret = null;
		                   break; 
		case 'vivapay' :				 
	    case 'process' : 
	    default        : 
		                 if (defined('SHCART_DPC')) {
				             if (_v("shcart.qtytotal")>0)			 
		                       $ret .= _m("shcart.cartview use ".GetReq('tid'));
						 }	 
		}
	 
		return ($ret);
	}
	
	public function redirect($url) {
		ob_start();
		header('Location: '.$url);
		ob_end_flush();
		die();
	}	
	
	public function jsDialog($text=null, $title=null, $time=null, $source=null) {
		if (!defined('JAVASCRIPT_DPC')) return ;
		$_text = $text ? addslashes($text) : null;
		$_title = $title ? addslashes($title) : null;
		
	    $stay = $time ? $time : 3000;//2000;
	   
        if (defined('JSDIALOGSTREAM_DPC')) {
	   
			if ($text)	
				$code = _m("jsdialogstream.say use $_text+$_title+$source+$stay");
			else
				$code = _m('jsdialogstream.streamDialog use jsdtime');
		   
			$js = new jscript;	
			$js->load_js($code,null,1);		
			unset ($js);
	    }	
	}	

	public function viva_create_payment($extcall=false) {
		
		//if (_v('shcart.superfastcart')) {
		if ($cid = GetParam('guestemail')) { //superfastcart
			//echo  'superfastcart';
			//$cid = GetParam('guestemail');
			if ($cust_data = _m("shcustomers.getcustomer use $cid+code2+1"))
				$custfullname = array_shift(explode(';', $cust_data));
			
			//override
			$this->username = $cid; 
			$this->amount = round(_v('shcart.myfinalcost'), 2);			
			$this->transaction = _v('shcart.transaction_id');
		}		
		else {
			if ($cust_data = _m("shcustomers.getcustomer"))
				$custfullname = array_shift(explode(';', $cust_data));
		}
		$fullname = $custfullname ?? $this->username;	//email as name in case of no customer ??!!!	

		//echo $cust_data . '>';
		//echo $this->amount . '>' . $this->username .  '>' . $this->title2show . '>' . $this->transaction . '>' . $this->lancode; 

		//save post to file
		if ($f = fopen($this->path . "viva_create_pay.txt",'w')) {
		  	    
			$pstr0 = "\r\namount: ". $this->amount .
					"\r\nemail: ". $this->username .
					"\r\nfullName:". $fullname .
					"\r\ncustomerTrns: ". $this->title2show .
					"\r\nrequestLang: ". $this->lancode .
					"\r\nsourceCode: ". $this->paysource ;
			$pstr0.= "\r\n" . $this->viva_url . "/api/orders\r\n";
			
			fwrite($f,$pstr0,strlen($pstr0));
			fclose($f);	  
		}		
		//die();
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->viva_url . '/api/orders',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS =>'{
				"amount": '. $this->amount .',
				"email": "'. $this->username .'",
				"fullName": "'. $fullname .'",
				"customerTrns": "'. $this->title2show .'",
				"requestLang": "'. $this->lancode .'",
				"sourceCode": "'.$this->transaction.'"

			}',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Authorization: Basic [Base64-encoded credentials]'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		
		//echo $response;
		//die('----------XX');
		
		if ($response) {
			$rdata = json_decode($response);
			//print_r($rdata);
			
			//save post to file
			if ($f = fopen($this->path."viva_create_pay.txt",'a+')) {
		  	    $pstr1 = null;
				foreach ($rdata as $id=>$val)
					$pstr1 .= "[".$id."]=".$val."\r";
				fwrite($f,$pstr1,strlen($pstr1));
				fclose($f);	  
			}

			if ($extcall)
				return ($rdata);
			
			//else
			//redirect to https://demo.vivapayments.com/web/checkout?ref={OrderCode}
			//<script type="text/javascript">location.href = 'newurl';</script>
			
			if (isset($rdata->OrderCode))
				header("Location: " . $this->viva_url . '/web/checkout?ref=' . $rdata->OrderCode);
			
			return false;
		}	

		return false;
		
		
		/*
	  
		$confirmUrl = 't=payreturn&tid='.$this->transaction;
		$cancelUrl = 't=paycancel&tid='.$this->transaction;
		$description = localize('_mailSubject', getlocal()) . $this->transaction;
	  
		$this->add_field('mid', $this->merchantid);
		$this->add_field('orderid', $this->transaction);
		$this->add_field('orderDesc', $description); //$this->title2show);
		$this->add_field('orderAmount', $this->amount);
		$this->add_field('currency', 'EUR');
		$this->add_field('payerEmail', $this->username);
		$this->add_field('confirmUrl', setUrl($confirmUrl));
		$this->add_field('cancelUrl', setUrl($cancelUrl));
	  
		$form_data = implode("", $this->fields) . $this->viva_pass;
		$digest = base64_encode(sha1($form_data, true));
		$this->add_field('digest', $digest);
	  
		//echo $form_data . "<br/>" . $digest;
		//die();
	  
		$this->submit_data(); // submit the payment fields to piraeus		  	   
		*/
	}
   
	protected function viva_receive_post() {
		$ret = false;
	  
		if ($this->debug_return)
			print_r($_POST);
	
		$post = array();
		foreach ($this->return_post_args as $arg) {	  
			${$arg} = $_POST[$arg];
			if ($arg!='digest') //exclude digest param from post array (exist as $(arg))
				$post[$arg] = $_POST[$arg]; 		
		}  
	  
		if ($this->verify_viva_payment($post, $digest)) {	

			//save post to file
			if ($f = fopen($this->path."viva_last_pay.txt",'a+')) {
		  	    
				foreach ($_POST as $id=>$val)
					$pstr .= "[".$id."]=".$val."\r";
				fwrite($f,$pstr,strlen($pstr));
				fclose($f);	  
			}	  

			if ((strcmp($post['status'], 'AUTHORIZED')==0) || (strcmp($post['status'], 'CAPTURED')==0)) 
				$ret = true;						   					      	   	 
			elseif (strcmp($post['status'], 'CANCELED')==0) 
				$ret = false;
			elseif (strcmp($post['status'], 'REFUSED')==0) 
				$ret = false;
			elseif (strcmp($post['status'], 'ERROR')==0) 
				$ret = false;
			else //unknown error
				$ret = false;
	    
		
		}//verify_viva_payment		
		return ($ret);				    
	}
   
	//check the posted data digest param by replicate it
	protected function verify_viva_payment($post_data=null, $post_digest=null) {
		//echo 'Verify:';
		if (is_array($post_data) && ($post_digest)) { 
	   
			$form_data = implode("",$post_data) . $this->viva_pass;  
			$digest = base64_encode(sha1($form_data, true));
			//echo '>',$digest,'-',$post_digest;
			if (strcmp($digest, $post_digest)==0) {
		 
				$this->savetransaction($post_data);
		   
				if ($this->debug_return)
					echo '<br>Message:'.$post_data['message'];
			 		   		 
				return true;	  
			}	 
		}
	 
		if ($this->debug_return)
			echo '<br>Message:'.$post_data['message'];
   
		return false;
	} 
   
	protected function mybin2hex($str) { 
   
		$strl = strlen($str); 
		$fin = ''; 
		for($i =0; $i < $strl; $i++) {
		 
			$fin .= dechex(ord($str[$i])); 
		 
			if ($this->debug_return) {
				echo '<br>'.$str[$i].'------'.ord($str[$i]).'------'.dechex(ord($str[$i])); 
			}
		} 
		return $fin;    
	}  

	protected function viva_get_post_params($field=null) {
		if ($field==null) return null;
	  
		return ($_POST[$field]);
	}     
   
	protected function handle_Transaction($status,$ticket=null) {

        if ( (defined('SHTRANSACTIONS_DPC')) && (seclevel('SHTRANSACTIONS_DPC',decode(GetSessionParam('UserSecID')))) ) {
                
            $id = $this->transaction ? $this->transaction : GetReq('tid');

            switch ($status) {
                case 'ticket' : _m("shtransactions.setTransactionStatus use $id+1");
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
   
	protected function add_field($field, $value) {
      
      // adds a key=>value pair to the fields array, which is what will be 
      // sent to paypal as POST variables.  If the value is already in the 
      // array, it will be overwritten.
      
      $this->fields["$field"] = $value;
	}
   
	protected function submit_data() {
 
		// this function actually generates an entire HTML page consisting of
		// a form with hidden elements which is submitted to paypal via the 
		// BODY element's onLoad attribute.  We do this so that you can validate
		// any POST vars from you custom form before submitting to paypal.  So 
		// basically, you'll have your own form which is submitted to your script
		// to validate the data, which in turn calls this function to create
		// another hidden form and submit to paypal.
 
		// The user will briefly see a message on the screen that reads:
		// "Please wait, your order is being processed..." and then immediately
		// is redirected to paypal.
	  

		echo "<html>";
		echo "<head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
		echo "<title>Processing Payment...</title>";
		echo "<script type=\"text/javascript\">
		function send_tran() {
			var frm = document.getElementById('form');
			frm.style.visibility=\"hidden\";
			frm.submit();
		}
		</script>";
		echo "</head>";
		if ($this->debug) {//dont send the request just print form
			echo "<body>";
			echo '<br>' . $this->viva_url;
		}
		else //goto bank  	  
			echo "<body onLoad=\"send_tran();\">";
	  
		echo "<center><h3>".localize('_PLEASEWAIT',getlocal())."</h3></center>";
		echo "<form method=\"post\" id=\"form\" name=\"form\" action=\"".$this->viva_url."\" accept-charset=\"UTF-8\">";

		foreach ($this->fields as $name => $value) {
			echo "<input type=\"hidden\" name=\"$name\" value=\"$value\">";
			if ($this->debug) {
				echo '<br>'. $name . '=>'.$value;
			}
		}
		echo "</form>";
		echo "</body></html>"; 
   } 
   
   protected function set_message($case,$errorcode=null) {

	    $template = remote_paramload('SHVIVAPAY',$case,$this->path) . '.htm'; 

	    if ($t = _m("cmsrt.select_template use $template")) 
		  $ret = @file_get_contents($t);
	    else
	      $ret = $m ? $m : localize($errorcode,getlocal()); //plain text	
		  
		$ret .= "<h2>";  
		
		//PIRAEUS response code
		switch ($this->responsecode) {
		
		  case '12' : $ret .= "Transaction Denied! Please check your credit card."; break;
		  case '11' : if ($this->authstatus=='03') {
		                $ret .= "Approved Transaction.";//"<br>Recharge Attempt!"; //...allowed by piraeus just send a info mail..above
					  }	
		              break;		
		  case '12' : if ($this->authstatus=='02')
		                $ret .= "Transaction Declined by the bank! Please use another credit card!"; 
		              break;
		  case '00' : if ($this->authstatus=='01')
		                $ret .= "Approved Transaction.";//VISA 
					  elseif ($this->authstatus=='02')
					    $ret .= "Approved Transaction.";//MASTERCARD 
					  else
					    $ret .= "Approved Transaction.";//anyway		
					  break;
		  default   : if ($this->authstatus=='01') {
		                if ($this->resultcode =='1072')
						  $ret .= "Package is closing! Please try later.";
						elseif ($this->resultcode =='501')
		                  $ret .= "Communication Error! Please try later.";
					  }	
					  elseif ($this->authstatus=='02')	
					    $ret .= "Invalid Card Number! Please check your credit card details or use a different card.";
                      elseif ($this->authstatus=='03')	
					    $ret .= "Under procees transaction was re-send! Please try later.";						
		}
		
		$ret .= "</h2>";    
		  
		return ($ret);    	   
    }
   
    protected function tell_by_mail($subject,$from,$to,$body) {
         
        $smtpm = new smtpmail;
        $smtpm->to = $to; 
        $smtpm->from = $from; 
        $smtpm->subject = $subject;
        $smtpm->body = $body;
        $mailerror = $smtpm->smtpsend();
        unset($smtpm);	
		 
		if ($mailerror) 
			echo "Error sending mail:",$mailerror;
		
		return ($mailerror);   
    }  
   
    protected function savetransaction($status) {
   
		$actfile = paramload('SHELL','prpath') . "transactions" . ".txt";							
		//echo $actfile;
		if ((is_file($actfile)) && (is_writable($actfile))) 
			$mode='a+';
		else 
			$mode='w';
	 
		switch ($status) {
			case 'RESULTCODE' : $data = implode(",", $status); break;
			case 'STATUSFLAG' : $data = implode(",", $status); break;
			case 'REPAY'      : $data = implode(",", $status); break;   
			case 'SUCCESS'    : $data = implode(",", $status); break;
			default           : $data = implode(",", $status);
		}
	   
		$record = date('Y-m-d h:m:s') .','. $data."\n";
	 
		//save in db
		$id = $this->transaction ? $this->transaction : $status['orderid']; 
		_m("shtransactions.setTransactionStoreData use $id+type1+".$status['txId']);
		_m("shtransactions.setTransactionStoreData use $id+type2+".$record);	 	
				 	 
		if ($fp = @fopen ($actfile , $mode)) {	 
            fwrite ($fp,$record);
            fclose ($fp);
		}
		else 
			echo "File creation error!(".$record.')';
	}              
      	
}; 
} 
?>