<?php
$__DPCSEC['SMTPMAIL_DPC']='1;1;1;1;1;1;1;1;1;1;1';
$__DPCSEC['_DEBUGSMTPMAIL']='1;0;0;0;0;0;1;1;1;1;1';

if (!defined("SMTPMAIL_DPC"))  {
define("SMTPMAIL_DPC",true);

$__DPC['SMTPMAIL_DPC'] = 'smtpmail';


if ((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true')) {
  
	require_once(_r('mailer/phpmailer.lib.php'));
	//require_once(_r('mailer/Exception.lib.php'));	
	require_once(_r('mailer/SMTP.lib.php'));	
	//echo 'SMTP';
}
elseif ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true')) {

	require_once(_r('mailer/phpmailer.lib.php'));
	require_once(_r('mailer/Exception.lib.php'));
	require_once(_r('mailer/POP3.lib.php'));
	//echo 'POP3';
}
else {
	
	require_once(_r('mailer/phpmailer.lib.php'));
	//require_once(_r('mailer/Exception.lib.php'));
	//echo 'DEFAULT';
}


class smtpmail {

    var $smtp, $mcharset, $path;

	/*Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages*/
    public function __construct($charset=null,$user=null,$pass=null,$name=null,$server=null) {
		$UserSecID = GetGlobal('UserSecID');  
	
		$this->userLevelID = (((decode($UserSecID))) ? (decode($UserSecID)) : 0);	
		$this->path = paramload('SHELL','prpath');	

		$smtp_user = remote_paramload('SMTPMAIL','user',$this->path);	 
		$smtp_password = remote_paramload('SMTPMAIL','password',$this->path);	  
		$myuser = $user ? $user : $smtp_user;
		$mypass = $pass ? $pass : $smtp_password;
		//echo $myuser . '::' . $user . '::' . $smtp_user;
		
		$smtp_name = remote_paramload('SMTPMAIL','realm',$this->path);
		$myname = $name ? $name : $smtp_name;
	  
		$smtp_server = remote_paramload('SMTPMAIL','smtpserver',$this->path);
		$myserver = $server ? $server : $smtp_server;	     	
	  
		//define("SMTP_SERVER", $myserver);    //here the SMTP server of your ISP
		//define("MY_EMAIL", $myuser);	//"root@localhost");  # here your email address
		//define("MY_NAME", $myname);   //here your plain name	 
			  
		//$myserver = 'mail.panikidis.gr';
		echo '>>>>'. $myserver . '--' . $myuser . '-'. $mypass .'--';
						    
		if ((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true')) {
			//echo 'SMTP_PHPMAILER';
		
			$this->smtp = new PHPMailer(true);   // Passing `true` enables exceptions
		  
			//Server settings
			$this->smtp->SMTPDebug = 2;                                 // Enable verbose debug output
			$this->smtp->isSMTP();                                      // Set mailer to use SMTP
			$this->smtp->Host = $myserver;//'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
			$this->smtp->SMTPAuth = true;                               // Enable SMTP authentication
			$this->smtp->Username = $myuser;//'user@example.com';                 // SMTP username
			$this->smtp->Password = $mypass;//'secret';                           // SMTP password
			$this->smtp->SMTPSecure = 'tls'; //ssl is deprecated        // Enable TLS encryption, `ssl` also accepted
			$this->smtp->Port = 25;//465; //587; //25 or 465 or 587;  		
			
			//$this->smtp->AuthType = 'PLAIN'; //def CRAM-MD5
			//$this->smtp->SMTPAutoTLS = true; 
			/*$mail->SMTPOptions = array (
					'ssl' => array(
					'verify_peer'  => true,
					'verify_depth' => 3,
					'allow_self_signed' => true,
					'peer_name' => 'Plesk',
					)
			);		*/	
		}
		elseif ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true')) {
			//echo 'SENDMAIL_PHPMAILER';	  
			
			//Authenticate via POP3.
			//After this you should be allowed to submit messages over SMTP for a few minutes.
			//Only applies if your host supports POP-before-SMTP.
			//$pop = POP3::popBeforeSmtp('pop3.example.com', 110, 30, 'username', 'password', 1);
			$pop = POP3::popBeforeSmtp($myserver, 110, 30, $myuser, $mypass, 1);

			$this->smtp = new PHPMailer(true);   // Passing `true` enables exceptions
		  
			//Server settings
			$this->smtp->SMTPDebug = 2;                                 // Enable verbose debug output
			$this->smtp->isSMTP();                                      // Set mailer to use SMTP
			$this->smtp->Host = $myserver;//'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
			$this->smtp->SMTPAuth = false;                               // Enable SMTP authentication
			//$this->smtp->Username = $myuser;//'user@example.com';                 // SMTP username
			//$this->smtp->Password = $mypass;//'secret';                           // SMTP password
			//$this->smtp->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$this->smtp->Port = 25; //25 or 465 or 587;  						  
		}
		else {
		    //sending a message using a local sendmail binary.
			
			$this->smtp = new PHPMailer();
			
			//Server settings
			//$this->smtp->isSendmail(); //Send messages using $Sendmail.
			$this->smtp->isMail(); //Send messages using PHP's mail() function.
		}

	  /*
		$sitecharset = paramload('SHELL','charset');
	  
		if (($sitecharset=='utf-8') || ($sitecharset=='utf8'))
			$this->mcharset = $charset ? $charset : 'utf-8';
		else  
			$this->mcharset = $charset ? $charset : $char_set[getlocal()]; 	  
	  */		
		$this->smtp->CharSet = $charset ? $charset : 'utf-8';	
	}
	
	public function addrecipients($r, $name = null) {
	
		$this->smtp->addAddress($r, $name);
		
      /*if ((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true'))  {
        $this->smtp->AddAddress($r, $name);	  
	  }
      elseif ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true')) {
        $this->smtp->AddAddress($r, $name);	  
	  }
	  else 	  	
	    $this->recipients[] = $r;*/
	}
	
	public function to($to, $name=null) {
		
		$this->smtp->addAddress($to, $name);
	}
	
	public function cc($to, $name=null) {
		
		$this->smtp->addCC($r); //, $name);	
	}
	
	public function bcc($to, $name=null) {
	
		$this->smtp->addBCC($r); //, $name);	
	}		
	
	public function from($from, $name=null) {
		
		$this->smtp->setFrom($from, $name);
	}

	public function replyTo($reply, $name=null) {
		
		$this->smtp->addReplyTo($reply, $name);
	}	
	
	public function subject($subject) {
		
		$this->smtp->Subject = $subject;
	/*
      if ((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true'))  {
        $this->smtp->Subject = $subject;	  
	  }
      elseif ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true')) {
        $this->smtp->Subject = $subject;	  
	  }
	  else	
	    $this->subject = $subject;*/
	}	
	
	public function body($body, $ishtml=true) {
		
		/*if ($ishtml) {
			//$this->smtp->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			//$this->smtp->MsgHTML($body);
		}
		else*/
			
		$this->smtp->isHTML($ishtml);
		$this->smtp->Body = $body;

	}
	
	public function altBody($altbody, $ishtml=true) {
		
		$this->smtp->AltBody = $altbody;
	}	
	
	public function attach($filename, $asname=null, $mime=null) {
	
		$this->smtp->addAttachment($filename, $asname);
	}	
	
	public function addimage($imgname, $asname=null, $mime=null, $id=null) {
		
		$this->smtp->addAttachment($filename, $asname);
		
		/*
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
	  }*/
	}

	//Configure message signing (the actual signing does not occur until sending)
	public function sign() {

		$this->smtp->sign(
    '/path/to/cert.crt', //The location of your certificate file
    '/path/to/cert.key', //The location of your private key file
    //The password you protected your private key with (not the Import Password!
    //May be empty but the parameter must not be omitted!
    'yourSecretPrivateKeyPassword',
    '/path/to/certchain.pem' //The location of your chain file
		);		
	}	
	
	//DKIM sign
	public function dkimSign($from=null) {
		$f = MY_USER; //$from ? $from : $this->smtp->From;
		$_d = explode('@', MY_USER);
		$d = $_d[1];
		
		//This should be the same as the domain of your From address
		$this->smtp->DKIM_domain = $d; //MY_NAME; //$my_name; //'example.com';
		
		//See the DKIM_gen_keys.phps script for making a key pair -
		//here we assume you've already done that.
		//Path to your private key: //!!!!!!!!!!!!!
		$this->smtp->DKIM_private = 'dkim_private.pem';
		
		//Set this to your own selector
		$this->smtp->DKIM_selector = 'phpmailer';
		
		//Put your private key's passphrase in here if it has one
		$this->smtp->DKIM_passphrase = '';
		
		//The identity you're signing as - usually your From address
		$this->smtp->DKIM_identity = $f;
		
		//Suppress listing signed header fields in signature, defaults to true for debugging purpose
		$this->smtp->DKIM_copyHeaderFields = false;
		
		//Optionally you can add extra headers for signing to meet special requirements
		//$this->smtp->DKIM_extraHeaders = ['List-Unsubscribe', 'List-Help'];		
			
		//https://support.google.com/mail/answer/81126?hl=en	
		//List-Unsubscribe-Post: List-Unsubscribe=One-Click
		//List-Unsubscribe: <https://example.com/unsubscribe/opaquepart>
	}
	
	public function smtpsend($altbody=null, $dataInFile=false, $path=null) {
		
		if ($altbody)
			$this->smtp->AltBody = $altbody;//'This is a plain-text message body';
		
		if ($dataInFile) {
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//and convert the HTML into a basic plain-text alternative body
			$this->smtp->msgHTML(file_get_contents($dataInFile, $path));//, __DIR__);		
		}	
		
		if ((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true')) {
			
			//send the message, check for errors
			if (!$this->smtp->send()) {
				
				$error = $this->smtp->ErrorInfo;
				echo 'Mailer Error: ' . $error;
			} 
			else {
				echo 'Message sent!';
			}
		}
		elseif ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true')) { 
		
			try {
				//Note that we don't need check the response from this because it will throw an exception if it has trouble
				$this->smtp->send();
				echo 'Message sent!';	
			} 
			catch (mailerException $e) {
				$error = $e->errorMessage();
				echo $error; //Pretty error messages from PHPMailer
			} 
			catch (Exception $e) {
				$error = $e->errorMessage();
				echo $error; //Boring error messages from anything else!
			}
		}
		else {
			//send the message, check for errors
			if (!$this->smtp->send()) {
				$error = $this->smtp->ErrorInfo;
				echo "Mailer Error: " . $error;
			} 
			else {
				echo "Message sent!";
			}
		}
		
		return $error ? $error : null;
	}

};
}
?>