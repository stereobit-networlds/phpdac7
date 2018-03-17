<?php

$__DPCSEC['MAILDBQUEUE_DPC']='1;1;1;1;1;1;1;1;1;1;1';
$__DPCSEC['_MAILQUEUEDAEMON']='9;1;1;1;1;1;2;2;9;9;9';

if ( (!defined("MAILDBQUEUE_DPC")) && (seclevel('MAILDBQUEUE_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("MAILDBQUEUE_DPC",true);

$__DPC['MAILDBQUEUE_DPC'] = 'maildbqueue';

$v = GetGlobal('controller')->require_dpc('crypt/ciphersaber.lib.php');
require_once($v); 

$__EVENTS['MAILDBQUEUE_DPC'][0]='cpmaildbqueue';
$__EVENTS['MAILDBQUEUE_DPC'][1]='cpngetqueue';
$__EVENTS['MAILDBQUEUE_DPC'][2]='cpnsetqueue';

$__ACTIONS['MAILDBQUEUE_DPC'][0]='cpmaildbqueue';
$__ACTIONS['MAILDBQUEUE_DPC'][1]='cpngetqueue';
$__ACTIONS['MAILDBQUEUE_DPC'][2]='cpnsetqueue';

$__LOCALE['MAILDBQUEUE_DPC'][0]='MAILDBQUEUE_DPC;Mail Queue;Mail Queue';
$__LOCALE['MAILDBQUEUE_DPC'][1]='_TIMEIN;In Date;Εισαγωγή';
$__LOCALE['MAILDBQUEUE_DPC'][2]='_TIMEOUT;Out Date;Εξαγωγή';
$__LOCALE['MAILDBQUEUE_DPC'][3]='_SENDER;From;Απο';
$__LOCALE['MAILDBQUEUE_DPC'][4]='_RECEIVER;To;Σε';
$__LOCALE['MAILDBQUEUE_DPC'][5]='_SUBJECT;Subject;Θεμα';
$__LOCALE['MAILDBQUEUE_DPC'][6]='_BODY;Body;Κείμενο';

class maildbqueue  {

    var $userLevelID;	
	var $result;
	var $path, $post, $msg, $urlpath, $url;
	var $inpath, $languages, $title, $default_lang;
	var $encoding;
	var $hosted_path, $app_pool;
	var $grids, $ajax_link, $has_graph;	
	var $trackmail, $trackapp;
	var $appname;	
	var $mail_encoding;
	
	var $thisapp;
	
	var $cpanelmailpath;

	function maildbqueue() {
		$UserSecID = GetGlobal('UserSecID'); 	
		$this->userLevelID = (((decode($UserSecID))) ? (decode($UserSecID)) : 0);	 
	  
		$this->path = paramload('SHELL','prpath');  	
		$this->urlpath = paramload('SHELL','urlpath');
		$murl = arrayload('SHELL','ip');
		$this->url = $murl[0]; 
		$this->inpath = paramload('ID','hostinpath');		   
		$this->title = localize('MAILDBQUEUE_DPC',getlocal());		  
	    
		$this->languages = remote_arrayload('SHELL','languages',$this->path);
		$this->default_lang = remote_paramload('SHELL','dlang',$this->path);
	  
		$ba = remote_paramload('MAILDBQUEUE','batch',$this->path);
		$this->batch = $ba?$ba:1;//1000;  //mails in queue pre batch
		$this->auto_refresh = GetParam('refresh')?GetParam('refresh'):0;
		$this->timeout = 3601+1000;//one hour+1000 sec

		$this->mail_encoding = remote_paramload('MAILDBQUEUE','encoding',$this->path);	  
	  
		$char_set  = arrayload('SHELL','char_set');	  
		$charset  = paramload('SHELL','charset');	  		
		if ($charset=='utf-8')
			$this->encoding = 'utf-8';
		else  
			$this->encoding = $char_set[getlocal()]; 
		
		$this->hosted_path = $this->path;	  
	  
		$appsinpool = remote_arrayload('MAILDBQUEUE','applications',$this->path);
		$this->app_pool = (array) $appsinpool;

		//extra apps
		if ($extra_apps = @file_get_contents($this->path . 'mailqueue-apps.ini')) {
	      if (stristr($extra_apps,',')) { //many apps
		    $ea = explode(',',$extra_apps);
			foreach ($ea as $a=>$app)
				$this->app_pool[] = $app;  
		  }
          else //one app
            $this->app_pool[] = $extra_apps;   		  
		}	     
	  
		$this->appname = null;//'rootapp';//paramload('ID','instancename');	  
		//app side track vars
		$track = remote_paramload('MAILDBQUEUE','track',$this->path);
		$this->trackmail = $track?true:false;								    	  
		//server-root app side vars
		$this->trackapp = remote_arrayload('MAILDBQUEUE','apptrack',$this->path);	  
	  
		$this->thisapp = paramload('ID','instancename');	
	  
		$rootpath = paramload('RCCONTROLPANEL','rootpath', $this->prpath);
		$this->cpanelmailpath = $rootpath ? '/home/'.$rootpath.'/mail/' : '/home/stereobi/mail/';	 
	  
		$tcode = remote_paramload('RCBULKMAIL','trackurl', $this->prpath); //MAILDBQUEUE
		$this->mtrackimg = $tcode ? $tcode : "http://www.stereobit.gr/mtrack.php";	  
	}
	
	function event($event=null) {		
	
		  	  
	    $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;			
	      
	
	    switch ($event) {
	      case 'cpngetqueue'        : 		 
	      case 'cpnsetqueue'        : 
		  case 'cpmaildbqueuejob'   : break;
		  default                   : 
		                            									
        }	
	}		
	
	function action($action=null) {
	
	    $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;
	  
	    switch ($action) {
		
		  case 'cpmaildbqueuejob'  : 	  
		  case 'cpmaildbqueue'     : 
		  default                  : 
		                             
		                       
        }	  
	  
	    return ($out);
	}
					
		
    //excuted every hour sending mails to limit		
	public function sendmail_daemon($limit=null,$forcelimits=null) {
        $db = GetGlobal('db'); 		
		//$limit = 2;//$limit?$limit:$this->batch;//batch in an hour or limit=3 in min		 
		$sumi = 0;
		 
		if ($forcelimits) {//calibrate mail send queue
		 
			$boostlimits = $this->force_mail_limits($limit,$forcelimits);
			echo 'BOOST LIMITS ARRAY:';
			print_r($boostlimits);
		   
			$mylimit = (is_array($boostlimits)) ? array_shift($boostlimits) : $limit;
		}
        else
			$mylimit = $limit;		 
		 
		 
		//first this db
		$sSQL = "select id,timein,active,sender,receiver,subject,body,altbody,cc,bcc,ishtml,encoding,origin,user,pass,name,server from mailqueue where active=1 order by id ";
		$sSQL .= ($mylimit>0) ? "limit " . $mylimit : "limit " . $this->batch; 		
	    $result = $db->Execute($sSQL,2);
			
		echo '\r\nROOTAPP-select:',$mylimit,'-',$this->batch,'-',$sSQL . "\r\n";		
		
	    if (!empty($result)) {		
			$i = 0;	
			foreach ($result as $n=>$rec) {
				$id = $rec['id'];	     
				$from = $rec['sender'];//$user . '@' . $domain;
				$to = $rec['receiver'];
				$subject = $rec['subject'];
				$body = $rec['body'];			 			 			 
				$altbody = $rec['altbody'];				 
				$cc = $rec['cc'];	
				$bcc = $rec['bcc'];				 			 
				$ishtml = $rec['ishtml'];	
			       
				$encoding = $rec['encoding'] ? $rec['encoding'] : ($this->mail_encoding ? $this->mail_encoding :$this->encoding);	
				 
				$origin = $rec['origin'];	 
				$user = $rec['user']; 			 		 
				$pass = $rec['pass']; 
				$name = $rec['name']; 
				$server = $rec['server']; 			 			 			 
			 
				//server side root app depending tracking var..NOT FOR ROOT APP (appvar depends)			 
				//update db
				$datetime = date('Y-m-d h:s:m');
				$active = 0;
			    if ($this->is_valid_email($to)) { 
					$error = $this->sendmail($from,$to,$subject,$body,$altbody,$cc,$bcc,$ishtml,$encoding,$user,$pass,$name,$server);				
					$sSQL = "update mailqueue set timeout=".$db->qstr($datetime).
			            ",mailstatus=".$db->qstr($error).",active=" . $active ." where id=" . $id;
						
					$i+=1;
				}
				else {//invalid email address...disable it 
					$sSQL = "update mailqueue set status=-1,timeout=".$db->qstr($datetime).
							",mailstatus=".$db->qstr('Invalid email address').",active=" . $active ." where id=" . $id;				   
				}
				//exec
				$result = $db->Execute($sSQL,1);
			}
			$sumi+=$i; //sum of messages of all app
			$ret .= '[mailqueue]'.$i.' message(s) send from root application!';		
			
			//SCAN FOR BOUNCED MAILS (this app)
			$ret .= $this->scanBounce($from, false, $mylimit);						
	    }
		else {
			$ret .= '[mailqueue]...no messages to send from root application!';		 		 
			$limit += $limit;
		}  	
		
		 
		echo 'DAEMON LOOP:<pre>';		 
		print_r($this->app_pool);
		echo '</pre>';	  
		
		//after all other apps
		if (empty($this->app_pool)) return;
		
        foreach ($this->app_pool as $aid=>$ap) {
		 
			GetGlobal('controller')->calldpc_method('database.switch_db use '.$ap);		 
			$db = GetGlobal('db'); 
		   
			if ($forcelimits) {
				$force_limit = $boostlimits[$ap];
				$mylimit = $force_limit; 
				echo "\r\nFORCE LIMITS:".$ap.'='.$mylimit;
			}
			else
				$mylimit = $limit;		   
		   
			$sSQL = "select id,timein,active,sender,receiver,subject,body,altbody,cc,bcc,ishtml,encoding,origin,user,pass,name,server from mailqueue where active=1 order by id ";		   
			$sSQL .= ($mylimit>0) ? "limit " . $mylimit : "limit " . $this->batch; 		   			
			$result = $db->Execute($sSQL,2);			 
			
			echo "\r\n".$ap.'-select:',$mylimit,'-',$this->batch,'-',$sSQL . "\r\n";			
		 
			if (!empty($result)) {	
				$i = 0;
				foreach ($result as $n=>$rec) {
					$id = $rec['id'];	     
					$from = $rec['sender'];//$user . '@' . $domain;
					$to = $rec['receiver'];
					$subject = $rec['subject'];
					$body = $rec['body'];			 			 			 
					$altbody = $rec['altbody'];				 
					$cc = $rec['cc'];	
					$bcc = $rec['bcc'];				 			 
					$ishtml = $rec['ishtml'];	
			   
					$encoding = $rec['encoding'] ? $rec['encoding'] : ($this->mail_encoding ? $this->mail_encoding :$this->encoding);
			
					$origin = $rec['origin'];	 
					$user = $rec['user']; 			 		 
					$pass = $rec['pass']; 
					$name = $rec['name']; 
					$server = $rec['server']; 		
			   
					//server side root app depending tracking var		
					if ($this->trackapp[$aid]) {
						$ta[] = encode(date('Ymd-H:m:s'));
						$ta[] = $from;
						$ta[] = $ap;
						$tc = implode('<DLM>',$ta);
						$tid = rawurlencode(encode($tc));		 
						$trackid = $tid;	
				 
						$mybody = $this->add_tracker_to_mailbody($body,$trackid,$to,$ishtml);				 			   
					}
					else
						$mybody = $body;
			   			   	 			 			
					$datetime = date('Y-m-d h:s:m');
					$active = 0;													

					if ($this->is_valid_email($to)) {
						$error = $this->sendmail($from,$to,$subject,$mybody,$altbody,$cc,$bcc,$ishtml,$encoding,$user,$pass,$name,$server);			 
						//update db
						$sSQL = "update mailqueue set timeout=".$db->qstr($datetime).
								",mailstatus=".$db->qstr($error).",active=" . $active . " where id=" . $id;				 
			 
						$i+=1;
					}
					else {//invalid email address...disable it 
						$sSQL = "update mailqueue set status=-1,timeout=".$db->qstr($datetime).
								",mailstatus=".$db->qstr('Invalid email address').",active=" . $active . " where id=" . $id;				   
					}
					//exec
					$result = $db->Execute($sSQL,1);
				}
				
				$sumi+=$i; //sum of messages of all app
				$ret .= "\r\n[mailqueue]".$i.' message(s) send from application '. $ap ."!";			
				
				//SCAN FOR BOUNCED MAILS
				$ret .= $this->scanBounce($from, false, $mylimit);				
			}		   	 
			else {
				$ret .= "\r\n[mailqueue]...no messages to send from application ". $ap .'!';
				$limit += $limit;			 	
			}	
		   
		}//app loop
		
		return ($ret);   
    }	
	
    public function is_valid_email($email) {
		//if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$",$email)) return true;
		//else return false;		
		$ret = filter_var($email, FILTER_VALIDATE_EMAIL);
		return ($ret); 
	}	
	
	//check mail queue to send more than limit
	protected function force_mail_limits($limit=null,$forcelimits=null) {
         $db = GetGlobal('db'); 	 
		 
		 //first this db
		 $sSQL = "select count('id') from mailqueue where active=1";// and origin like %demosoft%";
			 
	     //echo $sSQL . '<br>';			
	     $result = $db->Execute($sSQL,2);
	     if (!empty($result)) 
           $mail_pool['demosoft'] = $result->fields[0];
         else		  
           $mail_pool['demosoft'] = 0;

		 //after all other apps
		 if (!empty($this->app_pool)) {
           foreach ($this->app_pool as $aid=>$ap) {

		     GetGlobal('controller')->calldpc_method('database.switch_db use '.$ap);		 
             $db = GetGlobal('db');		

		     $sSQL = "select count('id') from mailqueue where active=1";// and origin like %$ap%";	
	         $result = $db->Execute($sSQL,2);
	         if (!empty($result)) 
               $mail_pool[$ap] = $result->fields[0];
             else		  
               $mail_pool[$ap] = 0;			 
		   }
		 } 
         echo 'LAST APP:'.$ap.'-mail-pool:'."\r\n<pre>";		 
		 print_r($mail_pool);
		 echo '</pre>';
		 $ret = $this->mail_limits_boost($mail_pool,$limit,$forcelimits);
        		   
		 return ($ret);		   
	}
	
	protected function mail_limits_boost($mail_pool=null,$limit=null,$forcelimits=null) {
	  //$mail_pool = array('demosoft'=>653,'wayoflife'=>0,'panikidis'=>345,'netko'=>5677,'stereobit'=>23,'demosoft1'=>63,'wayoflife1'=>0,'panikidis1'=>0,'netko1'=>5437,'stereobit1'=>0);
	  $x=0;
	  foreach ($mail_pool as $t=>$ti)
	    $x+=$ti;
	  if ($x==0) return; //no mails return	
	  	
	  
      $cpool = is_array($mail_pool)?count($mail_pool):null; //include root app	
	  //echo 'COUNT>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>',$cpool,'>>>><br>';	  
	  $maxinpool = 0;	
	  $loop = 0;
	  
	  if ($cpool) {
	  
	     //echo $maxinpool,'<br>mail_pool';
		 echo 'BOOST-INIT:<pre>';		 
		 print_r($mail_pool);
		 echo '</pre>';	  
	  
	     //make an array of mail limits ..app1=>0,app2=>20,app3=>0 
	     foreach ($mail_pool as $appname=>$mails2send) {
		   if ($mails2send>$limit) {
		     $ret[$appname] = $limit;
			 $maxinpool += $limit;
		   }	 
		   elseif ($mails2send<=$limit) {
		     $ret[$appname] = $mails2send;
			 $maxinpool += $mails2send;		   
		   }
		   else
		     $ret[$appname] = 0;
		 }		
		 
	     //echo $maxinpool,'ret<pre>';		 
		 //print_r($ret);
		 //echo '</pre>';
		 
		 if ($cpool>1) {	//root app plus 1
		   while (($maxinpool+$limit<=$forcelimits) && ($loop<100)) { //loop until forcelimit or loop...to not out of bound
		     $loop+=1;
		     reset($mail_pool); 
	         foreach ($mail_pool as $appname=>$mails2send) {
			 
			   //$prevappmails = prev($mail_pool);
			   $nextappmails = next($mail_pool);
			   //echo 'NEXT>>>>>>>>>>>>>>>>>>>>>>',$nextappmails,'<br>';
			   
               if ($nextappmails == 0)	{ //prev/next array element mails 2 send = 0 or false = 0 out of array...when 0 not exists		       	
			     if (($mails2send>=$limit) && ($ret[$appname]/*+$limit*/<=$mails2send) && ($maxinpool+$limit<=$forcelimits)) { //when have mails 2 send and not out of bound
			       $ret[$appname] += $limit;
				   $maxinpool += $limit;
				 } 
			   }
			   /*elseif ($nextappmails < $limit) { //prev/next array mails 2 send < limit
			     if (($mails2send>=($limit-$nextappmails)) && ($ret[$appname]+($limit-$nextappmails)<=$mails2send) && ($maxinpool+($limit-$nextappmails)<=$forcelimits)) { //when have mails 2 send and not out of bound
			       $ret[$appname] += ($limit-$nextappmails);
				   $maxinpool += ($limit-$nextappmails);
				 }
                 echo '++++++++++++++++++==',$nextappmails; 				 
			   }*/
		     }
		     $mail_pool = array_reverse($mail_pool);
			 
	         //echo $maxinpool,' ',$loop,' reverse:ret<pre>';		 
		     //print_r($ret);
		     //echo '</pre>';	
			 
		   } //while
		 }
         else {//only root app [0]
		   if ($mail_pool['demosoft']>$forcelimits) //more mails than forcelimit
		     $ret['demosoft'] = $forcelimits; //keep it in forcelimit
		   else	//<= small mails than forcelimit
		     $ret['demosoft'] = $mail_pool['demosoft']; //send all
         } 	
		 
	     //echo '<br>maxinpool',$maxinpool,'<br>>>>>>>>>>>>>>>>>>>>>>>>';
		 echo 'BOOST RESULT:<pre>';		 
		 print_r($ret);
	     echo '</pre>';		 
		 return ($ret); //array
	  }//mail_pool exist
	  
	  return null;
	}
	
	
	//real send mail from db queue to mailer
    protected function sendmail($from,$to,$subject,$mail_text='',$altbody=null,$mycc=null,$mybcc=null,$ishtml=null,$encoding=null,$user=null,$pass=null,$name=null,$server=null) {
       $db = GetGlobal('db');	
       $sFormErr = GetGlobal('sFormErr');
	   if ($mycc) {
	     if (stristr($mycc,';'))	
	       $ccaddress = explode(';',$mycc);  
	     else
	       $ccaddress = array(0=>$mycc);
	   }	 
		 
	   if ($mybcc) {		 
	     if (stristr($mybcc,';'))		 	 
	       $bccaddress = explode(';',$mybcc); 	    
         else
	   	   $bccaddress = array(0=>$mybcc);	 
	   }  
       //if ((checkmail($to)) && ($subject)) {//echo $to,'<br>';
	   
       $smtpm = new smtpmail($encoding,$user,$pass,$name,$server);
	   //echo '>',$encoding,$user,$name,$pass,$server;
		   	   
       if ((defined('SMTP_PHPMAILER')) && (SMTP_PHPMAILER=='true')) {
		   //echo 'smtp';	
		   $smtpm->from($from,$name);		   
		   $smtpm->to($to);  
		   if (!empty($ccaddress)) {
		     foreach ($ccaddress as $cc) {
			   //echo $cc,'<br>';
			   if (trim($cc)) {
		         //$smtpm->cc($cc);//ONLY WIN32  
			     $smtpm->to($cc);
			   }
			 }  
		   }  	 
		   if (!empty($bccaddress)) {
		     foreach ($bccaddress as $bcc) {
			   //echo $bcc,'<br>';		
			   if (trim($bcc)) {	 
		         //$smtpm->bcc($bcc); //ONLY WIN32  
			     $smtpm->to($bcc);  
			   }	 
			 }  
		   }		   
		   $smtpm->subject($subject);
		   $smtpm->body($mail_text,$ishtml); 	//rawurldecode from db
		   
           # Optional alternate text-only body:
           $smtpm->smtp->AltBody = $altbody;	//rawurldecode from db
		   		 
		   # url images to Embeded images replacement
		   if (!empty($this->images)) {
		     foreach ($this->images as $a=>$image) {
		       if ($image) {
			     foreach ($this->imgtypes as $ext) {		 
			       if (strstr($image,$ext)) {
				     $myext = str_replace('.','',$ext);//without dot
                     $err .= $smtpm->smtp->AddEmbeddedImage($this->template_images_path . $image, "1", $image, "base64", "image/$myext");		 
				   }  
			     }
			   }  
		     }	  
		   }
           # Attached file containing this source code:
		   if (!empty($this->attachments)) {
		     foreach ($this->attachments as $a=>$attachment) {
		       if ($attachment) {
			     foreach ($this->doctypes as $ext) {		 
			       if (strstr($attachment,$ext)) {		
				     $myext = str_replace('.','',$ext);//without dot???? switch	 
                     $err .= $smtpm->smtp->AddAttachment($this->template_document_path . $attachment, $attachment, "base64", "text/plain");
				   }  
			     }
			   }  
		     }
		   }		   			   	   
	   }
       elseif ((defined('SENDMAIL_PHPMAILER')) && (SENDMAIL_PHPMAILER=='true')) { 	   
		   //echo 'phpmailer';
		   $smtpm->from($from,$this->mailname);		   
		   $smtpm->to($to);  
		   if (!empty($ccaddress)) {
		     foreach ($ccaddress as $cc) {
			   //echo $cc,'<br>';			 
			   if (trim($cc)) {			 
		         //$smtpm->cc($cc); //ONLY WIN32  
			     $smtpm->to($cc);
			   }	 
			 }  
		   }
		   if (!empty($bccaddress)) {
		     foreach ($bccaddress as $bcc) {
 			   //echo $bcc,'<br>';
			   if (trim($bcc)) {				   
		         //$smtpm->bcc($bcc);//ONLY WIN32   
			     $smtpm->to($bcc);
			   }	 
			 }  
		   }			    
		   $smtpm->subject($subject);
		   $smtpm->body($mail_text,$ishtml); 	//rawurldecode from db		
		   
           # Optional alternate text-only body:
           $smtpm->smtp->AltBody = $altbody;	//rawurldecode from db	 
		   
		   # url images to Embeded images replacement
		   if (!empty($this->images)) {
		     foreach ($this->images as $a=>$image) {
		       if ($image) {
			     foreach ($this->imgtypes as $ext) {		 
			       if (strstr($image,$ext)) {
				     $myext = str_replace('.','',$ext);//without dot
                     $err .= $smtpm->smtp->AddEmbeddedImage($this->template_images_path . $image, "1", $image, "base64", "image/$myext");		 
				   }  
			     }
			   }  
		     }	  
		   }
           # Attached file containing this source code:
		   if (!empty($this->attachments)) {
		     foreach ($this->attachments as $a=>$attachment) {
		       if ($attachment) {
			     foreach ($this->doctypes as $ext) {		 
			       if (strstr($attachment,$ext)) {		
				     $myext = str_replace('.','',$ext);//without dot???? switch	 
                     $err .= $smtpm->smtp->AddAttachment($this->template_document_path . $attachment, $attachment, "base64", "text/plain");
				   }  
			     }
			   }  
		     }
		   }		      
	  } 
	  else {
		   //echo 'default';	
		   $smtpm->to($to); 
		   $smtpm->from($from); 
		   $smtpm->subject($subject); //rawurldecode from db
		   $smtpm->body($mail_text);			   			   	    
	  }
			 
	  $err = $smtpm->smtpsend();
	  unset($smtpm);				 
		  			     	  	
  	  if ($err) 
		   return ($err); 
      //}
       //else 
	     //SetGlobal('sFormErr',localize('_MLS4',getlocal()));
		 
	   return (false);	 	   
  	   
    } 
	
	protected function add_tracker_to_mailbody($mailbody=null,$id=null,$receiver=null,$is_html=false) {
	
	   if (!$id) return;
	   
	   $i = rawurlencode(encode($id));
	
	   if ($receiver) {
	     $r = rawurlencode(encode($receiver));
	     $ret = "<img src=\"{$this->mtrackimg}?i=$i&r=$r\" border=\"0\" width=\"1\" height=\"2\">";
	   }
	   else
	     $ret = "<img src=\"{$this->mtrackimg}?i=$i\" border=\"0\" width=\"1\" height=\"2\">";
		 
	   if (($is_html) && (stristr($mailbody,'</BODY>')))
	     $out = str_replace('</BODY>',$ret.'</BODY>',$mailbody);
	   else
	     $out = $mailbody . $ret;	 	 
		 
	   return ($out);	 
	} 
	
	public function sendmail_tracker() {
	
	   //$i = 'VhAMbVwyATdWSQkTUzQEHFcCUFAIRgJQUAdVAAg0VWABQV0TWWVcSVZADDBTMV1CVxgLJ1QsAVBWEQFTVBEDW1YCDHxcZAEGVmkJE1NkBCJXD1B8CDwCUlAFVRAIa1UjAVtdElkzXFpWXgwGU0FdUFcZCwxUGgFnVgQBVFQVAzNWFgw3XH8BDlZuCWNTVQQNVx5QUwg8AkNQBVVgCEFVIwFBXTlZVFxcVlEMBlM1XWBXDQswVB0BTlYTAUNUYQNIVgEMU1xCAQZWRAkTU1EEGlcbUFUIMAJMUABVJghvVQIBVl0QWUBcWlZODAFTY11jVx4LbFQ7AUlWBwFpVB4DdFYQDHxcQgEfVloJPlN3BG1XD1BOCFkCQ1AaVRAIZ1U9AVtdZFl1XElWRgwwU2RdNVcMC25UAgFXVhEBVFRhA2pWFQxBXDIBAlZFCRNTWgQoVwxQbAhnAk1QNVUHCHxVcQExXRVZRlxhVn8MM1NiXTBXHAtpVBABeFYaAUBUHwNDVhEMcFxDAQFWfAkaU04EDlcbUGwIXQJKUGRVCQhDVQUBOl1iWUBcOVZZDANTYl1mV2MLE1QXAUVWLwFmVDEDM1YWDGlcRgESVj8JGFNPBA5XY1BuCEkCUVAAVXQIP1UQ';
	   //$r = 'BGQMZ15pBzUDJllrX2MAKQBNUXQBdQdiUSJVNAdsB2RSOQB%2BDHkHM1VnW20%3D';
	
	   if (!$i = GetReq('i')) return;

	   $trackid = $i;//decode($i); echo $i,'<br>';
	   $receiver = $r;//decode($r);
	   
	   $p = explode('@',$trackid);	   
	   if (!empty($p)) {	   
	   
	       $app = trim($p[1]);	   
		   //echo $app,'>';
		   if (($app) && ($app!=$this->thisapp))
		     $db = GetGlobal('controller')->calldpc_method('database.switch_db use '.$app.'++1');
		   else
		     $db = GetGlobal('db');//root db
			 
           $sSQL = "select id,trackid,reply from mailqueue where trackid=" . $db->qstr($trackid);			 	 
		   $result = $db->Execute($sSQL,2);
		   //echo $sSQL;
		   
		   if ($tid = $result->fields['trackid']) {//if trackid exist...
		     
			 $replies = intval($result->fields['reply'])+1;//addon replies
			 
             $sSQL = "update mailqueue set reply=$replies, status=1 where trackid=" . $db->qstr($trackid);			 	 
		     $result = $db->Execute($sSQL,1);
			 //echo $sSQL;		     
		   }
		   	 
	   }
	}
	
	protected function get_trackid($from,$to) {
		 
		 $i = rand(1000,1999);//++$m;
		 
		 //YmdHmsu u only at >5.2.2
		 $tid = date('YmdHms') . $i . 'a@' . $this->appname;		 
		 
		 return ($tid);	
	}	


	public function scanBounce($sender, $delete=false, $maxfiles=null) {
		$maxf = $maxfiles ? $maxfiles : $this->batch;
		//$maxbatch = 2400; //100*24
		$db = GetGlobal('db'); //for every app in cycle or def(this) app
		
		if (!$sender) return ("Scan bounce sender not exists \r\n");
		$mp = explode('@',$sender);
		$app_sendermailfolder = $mp[1] . '/' . str_replace('.','_',$mp[0]) . '/cur/';
		$senderfolder = $this->cpanelmailpath . $app_sendermailfolder;		
		$folder = is_dir($senderfolder) ? $senderfolder : null;
		echo "\r\nSender folder:" . $folder;
		if (!$folder) return false;
		
		//$daysback = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
		$ret = null;
		
		$mfiles = scandir($folder, SCANDIR_SORT_DESCENDING); //desc
		if (empty($mfiles)) return ($folder . " : Empty\n");	
		
		$c = count($mfiles);
		$max = ($c<$maxf) ? $c : $maxf;		
		
		$bouncehandler = new Bouncehandler();
		
		for ($f=0;$f<=$max;$f++) {
			
			$file = $mfiles[$f];
			
			if ($file=='.' || $file=='..') continue; 
			
			$fsize = filesize($folder . $file);
			if  ($fsize<(1024*20)) { //20kb max
			
			  echo "\r\n" . $folder . ' : ' . $file;
			  $bounce = @file_get_contents($folder . $file);
			  $rep = $bouncehandler->parse_email($bounce); 
			  if ($a = $bouncehandler->is_a_bounce()) { 
				$to = $rep[0]['recipient'];
				
				$sSQL = "select failed from ulists where email=" . $db->qstr($to);
				$result = $db->Execute($sSQL,2);
		
				$xtimes = $result->fields[0] ? intval($result->fields[0])+1 : 1;
		
				$sSQL = 'update ulists set failed=' . $xtimes . " where email=" . $db->qstr($to);
				$result = $db->Execute($sSQL,1);

				//also update mailqueue (last sending mail)		
				$sSQL = "select id from mailqueue where active=0 and receiver=" . $db->qstr($to) . " order by id desc LIMIT 1";
				$result = $db->Execute($sSQL,2);
						
				$sSQL = "update mailqueue set status=-2, mailstatus='BOUNCE' where id=" . $result->fields[0];
				$result = $db->Execute($sSQL,1);

				$ret .= "\r\n" . $file;
				$ret .= " was last modified: " . date ("d m Y H:i:s.", filemtime($folder . $file));
				$ret .= " Send to: " . $to ."\r\n";
				if ($delete==true) {
					$ret .= "Deleted\r\n";
					unlink($folder . $mfiles[$f]);
				}				
			  }//is bounce
			}//filesize
		}
		return $ret;			
	}	

};
}		
?>