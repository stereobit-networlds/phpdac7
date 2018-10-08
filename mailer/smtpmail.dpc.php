<?php
$__DPCSEC['SMTPMAIL_DPC']='1;1;1;1;1;1;1;1;1;1;1';
$__DPCSEC['_DEBUGSMTPMAIL']='1;0;0;0;0;0;1;1;1;1;1';

if (!defined("SMTPMAIL_DPC"))  {
define("SMTPMAIL_DPC",true);

$__DPC['SMTPMAIL_DPC'] = 'smtpmail';


if ((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true')) {
	require_once(_r('mailer/Exceptions.lib.php'));  
	require_once(_r('mailer/SMTP.lib.php'));
	require_once(_r('mailer/phpmailer.lib.php'));
	//echo 'SMTP';
}
elseif ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true')) {
	require_once(_r('mailer/Exceptions.lib.php'));
	require_once(_r('mailer/POP3.lib.php'));
	require_once(_r('mailer/phpmailer.lib.php'));
	//echo 'PHPMAILER';
}
else {
	require_once(_r('mailer/Exceptions.lib.php'));
	require_once(_r('mailer/phpmailer.lib.php'));
	//echo 'DEFAULT';
}


class smtpmail {

    var $from,$to,$subject,$body,$smtp;
	var $recipients;
	var $cc,$bcc;
	var $mcharset, $path, $dbgpath;
	var $mailname;

    function __construct($charset=null,$user=null,$pass=null,$name=null,$server=null) {
	  $UserSecID = GetGlobal('UserSecID');  
	
      $this->userLevelID = (((decode($UserSecID))) ? (decode($UserSecID)) : 0);	
	  $this->path = paramload('SHELL','prpath');	
	  $this->dbgpath = paramload('SHELL','dbgpath');	    
	  
	  $sitecharset = paramload('SHELL','charset');
	  
	  if (($sitecharset=='utf-8') || ($sitecharset=='utf8'))
	    $this->mcharset = $charset ? $charset : 'utf-8';
	  else  
	    $this->mcharset = $charset ? $charset : $char_set[getlocal()]; 	  
	  
	  $smtp_user = remote_paramload('SMTPMAIL','user',$this->path);	 
      $smtp_password = remote_paramload('SMTPMAIL','password',$this->path);	  
	  $myuser = $user ? $user : $smtp_user;
	  $mypass = $pass ? $pass : $smtp_password;
	  
	  $smtp_name = remote_paramload('SMTPMAIL','realm',$this->path);
	  $myname = $name ? $name : $smtp_name;	  
	  $this->mailname = $myname;
	  
      $smtp_server = remote_paramload('SMTPMAIL','smtpserver',$this->path);
	  $myserver = $server ? $server : $smtp_server;	     	
	  
      if ((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true')) {
	    //echo 'SMTP_PHPMAILER';
		
        define("SMTP_SERVER", $myserver);    # here the SMTP server of your ISP
        define("MY_EMAIL", $myuser);//"root@localhost");  # here your email address
        define("MY_NAME", $myname);    # here your plain name	 
		
        $this->smtp = new PHPMailer();

        # Errors are returned in english language (default):
        $this->smtp->SetLanguage("en", "../language");

        # Set the SMTP server:
        $this->smtp->Host = SMTP_SERVER;
        $this->smtp->IsSMTP();

        # If a login authorization to the SMTP server required, set these too:
		if ($myuser) {
          $this->smtp->SMTPAuth = TRUE;
          $this->smtp->Username = $myuser;//"YourUserName";
          $this->smtp->Password = $mypass;//"YourPassWord";
		}

        $this->smtp->CharSet = $this->mcharset;//"UTF-8"; # Charset used for subject and body		 	  
	  }
      elseif ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true')) {
        //echo 'SENDMAIL_PHPMAILER';	  
        define("SMTP_SERVER", $myserver);    # here the SMTP server of your ISP
        define("MY_EMAIL", $myuser);//"root@localhost");  # here your email address
		
        $this->smtp = new PHPMailer();

        # Errors are returned in english language (default):
        $this->smtp->SetLanguage("en", "../language"); //FIXED EN)

        $this->smtp->CharSet = $this->mcharset;//"UTF-8"; # Charset used for subject and body
		
        $this->smtp->WordWrap = 76;   # Wrap lines longher than that
        $this->smtp->IsMail();        # Uses PHP internal mail() function
							  
      }
      else {
	    //test vals
	    $this->from="root@localhost";
	    $this->to="root@localhost";
	    $this->subject = "test smtp mail";
	    $this->body = "test";	  
	    $this->cc = null;
	    $this->bcc = null;	  
	    $this->recipients = array();	  
		
	    $this->smtp=new smtp_class;

	    $this->smtp->host_name = $myserver; /* Change this variable to the address of the SMTP server to relay, like "smtp.myisp.com" */
	    $this->smtp->localhost = remote_paramload('SMTPMAIL','localhost',$this->path);//"daidalos"; /* Your computer address */	  	  
	    $this->smtp->direct_delivery = 0;     /* Set to 1 to deliver directly to the recepient SMTP server */
	    $this->smtp->timeout = 10;            /* Set to the number of seconds wait for a successful connection to the SMTP server */
	    $this->smtp->data_timeout = 0;        /* Set to the number seconds wait for sending or retrieving data from the SMTP server.
	                                 Set to 0 to use the same defined in the timeout variable */
	    $debugpcl = arrayload('SMTPMAIL','debug');			
	    $cpdebug = GetParam('smtpdebug'); //cp debug
	    					 
	    $this->smtp->debug = $debugpcl[$this->userLevelID]?$debugpcl[$this->userLevelID]:$cpdebug; //0;            /* Set to 1 to output the communication with the SMTP server */
	    $this->smtp->html_debug = 1;          /* Set to 1 to format the debug output as HTML */
	    $this->smtp->pop3_auth_host = remote_paramload('SMTPMAIL','pop3host',$this->path);     /* Set to the POP3 authentication host if your SMTP server requires prior POP3 authentication */
	    $this->smtp->user = $myuser; /* Set to the user name if the server requires authetication */
	    $this->smtp->realm = $myname; /* Set to the authetication realm, usually the authentication user e-mail domain */
	    $this->smtp->password = $mypass;  /* Set to the authetication password */	  
	    //$this->smtp->authentication_mechanism="NTLM";
      }		
	}
	
	function addrecipients($r, $name = null) {
	
      if ((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true'))  {
        $this->smtp->AddAddress($r, $name);	  
	  }
      elseif ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true')) {
        $this->smtp->AddAddress($r, $name);	  
	  }
	  else 	  	
	    $this->recipients[] = $r;
	}
	
	function to($to, $name=null) {
	
      if ((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true'))  {
        $this->smtp->AddAddress($to, $name);	  
	  }
      elseif ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true')) {
        $this->smtp->AddAddress($to, $name);	  
	  }
	  else {	  
	    $this->to = $to;
	  
	    $this->recipients[] = $to;
      }		
	}
	
	function cc($to, $name=null) {
	
      if ((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true'))  {
        $this->smtp->AddCC($to, $name);	  
	  }
      elseif ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true')) {
        $this->smtp->AddCC($to, $name);	  
	  }
	  else {	  
	    $this->to = $to;
	  
	    $this->recipients[] = $to;
      }		
	}
	
	function bcc($to, $name=null) {
	
      if ((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true'))  {
        $this->smtp->AddBCC($to, $name);	  
	  }
      elseif ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true')) {
        $this->smtp->AddBCC($to, $name);	  
	  }
	  else {	  
	    $this->to = $to;
	  
	    $this->recipients[] = $to;
      }		
	}		
	
	function from($from, $name=null) {
	
      if ((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true'))  {
        $this->smtp->From = $from;
        $this->smtp->FromName = $name?$name:$this->mailname;	
        $this->smtp->Sender = $from;//Sets the Sender email (Return-Path) of the message.		
	  }
      elseif ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true')) {
        $this->smtp->From = $from;
        $this->smtp->FromName = $name?$name:$this->mailname;	  
		$this->smtp->Sender = $from;//Sets the Sender email (Return-Path) of the message.
	  }
	  else 	
	    $this->from = $from;

	}	
	
	function subject($subject) {
	
      if ((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true'))  {
        $this->smtp->Subject = $subject;	  
	  }
      elseif ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true')) {
        $this->smtp->Subject = $subject;	  
	  }
	  else	
	    $this->subject = $subject;
	}	
	
	function body($body,$ishtml=true) {
	
      if ((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true'))  {
        $this->smtp->isHTML($ishtml);	  
        $this->smtp->Body = $body;	  
	  }
      elseif ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true')) {
        $this->smtp->isHTML($ishtml);	  
        $this->smtp->Body = $body;	  
	  }
	  else	
	    $this->body = $body;
	}
	
	function attach($filename, $asname=null, $mime=null) {
	
      if (((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true')) || 	
          ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true'))) {
	    
	    $nametoattach = $asname?$asname:$filename;
		$mymime = $mime?$mime:"text/plain";
	   
        # Attached file containing this source code:
        $this->smtp->AddAttachment($filename, $nametoattach, "base64", $mymime);	  	
	  }
	}	
	
	function addimage($imgname, $asname=null, $mime=null, $id=null) {
	  //static imgID = 1;
	  
	  $imgID = $id?$id:1;
	
      if (((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true')) || 	
          ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true'))) {
	  
	    $nametoattach = $asname?$asname:$imgname;
		$mymime = $mime?$mime:"image/gif";
			  
        $this->smtp->AddEmbeddedImage($imgname, "1", $asname, "base64", $mymime);
		
		//<img src='cid:1'> replace the image at body
		$id = "<img src='cid:".$imgID."'>";
		return ($id);	  	
	  }
	}			
	
	function smtpsend() {
	 
      if ((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true')) {
	    //echo 'smtp>>>>>';
        $this->smtp->Send();		
		
        if ( $error = $this->smtp->IsError() ) {
	      # Feedback to the user:
	      //echo "ERROR sending message to " . MY_EMAIL . ", check email.\n";

	      # Log a more complete error message:
	      error_log("ERROR sending message to " . MY_EMAIL
		  . " via " . SMTP_SERVER
		  . ": " . $this->smtp->ErrorInfo . "\n");
          echo 'error:',$error,':',$this->smtp->ErrorInfo;
		  $ret = "ERROR sending message to [" . MY_EMAIL . "], " . $this->smtp->ErrorInfo;
		  return ($ret);
        } 
		else {
	      # Feedback to the user:
	      //echo "Message succesfully sent to " . MY_EMAIL;
		  return null;
        }			  
	  }
      elseif ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true')) { 
	    
		/*if ($altbody)
          $this->smtp->AltBody = $altbody;	*/   //NO NEED HERE
	    //echo 'sendmail>>>>>';	  
        $this->smtp->Send();
		
        if ( $error = $this->smtp->IsError() ) {
	      # Feedback to the user:
	      //echo "ERROR sending message to " . MY_EMAIL . ", check email.\n";

	      # Log a more complete error message:
	      error_log("ERROR sending message to " . MY_EMAIL
		  . " via " . SMTP_SERVER
		  . ": " . $this->smtp->ErrorInfo . "\n");
          echo 'error:',$error,':',$this->smtp->ErrorInfo;          
		  $ret = "ERROR sending message to [" . MY_EMAIL . "], version=[" . PHPMailer::VERSION . "]: " . $this->smtp->ErrorInfo;
		  return ($ret);
        } 
		else {
	      # Feedback to the user:
	      //echo "Message succesfully sent to " . MY_EMAIL;
		  return null;
        }	  
	  }
	  else {	

	  /*
	   * If you need to use the direct delivery mode and this is running under
	   * Windows or any other platform that does not have enabled the MX
	   * resolution function GetMXRR() , you need to include code that emulates
	   * that function so the class knows which SMTP server it should connect
	   * to deliver the message directly to the recipient SMTP server.
	   */
	  if($this->smtp->direct_delivery) {
	  
		if(!function_exists("GetMXRR"))
		{
			/*
			* If possible specify in this array the address of at least on local
			* DNS that may be queried from your network.
			*/
			$_NAMESERVERS=array();
			include("getmxrr.php");
		}
		/*
		* If GetMXRR function is available but it is not functional, to use
		* the direct delivery mode, you may use a replacement function.
		*/
		/*
		else
		{
			$_NAMESERVERS=array();
			if(count($_NAMESERVERS)==0)
				Unset($_NAMESERVERS);
			include("rrcompat.php");
			$smtp->getmxrr="_getmxrr";
		}
		*/
	  }

	  /*if ($this->smtp->SendMessage($this->from,array($this->to),array("From: $this->from","To: $this->to","Subject: Testing Manuel Lemos' SMTP class",
			"Date: ".strftime("%a, %d %b %Y %H:%M:%S %Z")),	
			"Hello $this->to,\n\nIt is just to let you know that your SMTP class is working just fine.\n\nBye.\n"))
		echo "Message sent to $to OK.\n";
	  else
		echo "Cound not send the message to $to.\nError: ".$this->smtp->error."\n";
	  */	  

	     
	  if ($this->smtp->SendMessage($this->from,
	                               array($this->to),
								   array("From: $this->mailname <$this->from>",
								         "Reply-To:$this->from",
								         "To: $this->to",
								         "Cc: $this->cc",
								         "Bcc: $this->bcc",										 										 
										 "Subject: $this->subject",
										 "Date: ".strftime("%a, %d %b %Y %H:%M:%S %Z"),
										 "MIME-Version: 1.0",
										 "Content-Type: text/html; charset=". $this->mcharset .";",
										 "Content-Transfer-Encoding: base64"),
										 chunk_split(base64_encode($this->body)))
					  			   )	
		return (null);
	  else
		return ($this->smtp->error);
				
	  }	
	}
	
	//use mime msg body as headers!!!!
	function smtpsend_mime() {
	
	  if ($this->smtp->SendMessage($this->from,
	                               array($this->to),
								   array($this->body),
								   null)
					  			   )	
		return (null);
	  else
		return ($this->smtp->error);	
	}

};
}
?>