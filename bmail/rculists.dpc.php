<?php

$__DPCSEC['RCULISTS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCULISTS_DPC")) && (seclevel('RCULISTS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCULISTS_DPC",true);

$__DPC['RCULISTS_DPC'] = 'rculists';

$__EVENTS['RCULISTS_DPC'][0]='cpulists';
$__EVENTS['RCULISTS_DPC'][1]='cpulframe';
$__EVENTS['RCULISTS_DPC'][2]='cpsubscribe';
$__EVENTS['RCULISTS_DPC'][3]='cpunsubscribe';
$__EVENTS['RCULISTS_DPC'][4]='cpadvsubscribe';
$__EVENTS['RCULISTS_DPC'][5]='cploadframe';
$__EVENTS['RCULISTS_DPC'][6]='cpmailbodyshow';
$__EVENTS['RCULISTS_DPC'][7]='cpviewsubsqueueactiv';
$__EVENTS['RCULISTS_DPC'][8]='cpactivatequeuerec';
$__EVENTS['RCULISTS_DPC'][9]='cpdeactivatequeuerec';
$__EVENTS['RCULISTS_DPC'][10]='cpviewtrace';
$__EVENTS['RCULISTS_DPC'][11]='cpviewclicks';
$__EVENTS['RCULISTS_DPC'][12]='cpcleanbounce';

$__ACTIONS['RCULISTS_DPC'][0]='cpulists';
$__ACTIONS['RCULISTS_DPC'][1]='cpulframe';
$__ACTIONS['RCULISTS_DPC'][2]='cpsubscribe';
$__ACTIONS['RCULISTS_DPC'][3]='cpunsubscribe';
$__ACTIONS['RCULISTS_DPC'][4]='cpadvsubscribe';
$__ACTIONS['RCULISTS_DPC'][5]='cploadframe';
$__ACTIONS['RCULISTS_DPC'][6]='cpmailbodyshow';
$__ACTIONS['RCULISTS_DPC'][7]='cpviewsubsqueueactiv';
$__ACTIONS['RCULISTS_DPC'][8]='cpactivatequeuerec';
$__ACTIONS['RCULISTS_DPC'][9]='cpdeactivatequeuerec';
$__ACTIONS['RCULISTS_DPC'][10]='cpviewtrace';
$__ACTIONS['RCULISTS_DPC'][11]='cpviewclicks';
$__ACTIONS['RCULISTS_DPC'][12]='cpcleanbounce';

$__DPCATTR['RCULISTS_DPC']['cpulists'] = 'cpulists,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCULISTS_DPC'][0]='RCULISTS_DPC;Queue;Αποστολές';
$__LOCALE['RCULISTS_DPC'][1]='_MASSSUBSCRIBE;Mass subscribe;Μαζική εγγραφή συνδρομητών';
$__LOCALE['RCULISTS_DPC'][2]='_MAILCAMPAIGNS;Mail campaigns;Αποστολές σε συνδρομητές';
$__LOCALE['RCULISTS_DPC'][3]='_active;Active;Ενεργό';
$__LOCALE['RCULISTS_DPC'][4]='_sender;Sender;Αποστολέας';
$__LOCALE['RCULISTS_DPC'][5]='_receiver;Receiver;Παραλήπτης';
$__LOCALE['RCULISTS_DPC'][6]='_reply;Views;Εμφανίσεις';
$__LOCALE['RCULISTS_DPC'][7]='_subject;Subject;Θέμα';
$__LOCALE['RCULISTS_DPC'][8]='_id;Id;Α/Α';
$__LOCALE['RCULISTS_DPC'][9]='_MAILQUEUE;Mail list;Λίστα αποστολών';
$__LOCALE['RCULISTS_DPC'][10]='_status;Status;Κατάσταση';
$__LOCALE['RCULISTS_DPC'][11]='_cid;Campaign;Καμπάνια';
$__LOCALE['RCULISTS_DPC'][12]='_MAILCLICKS;Responses;Ανταπόκριση';
$__LOCALE['RCULISTS_DPC'][13]='_MAILTRACE;Actions;Ενέργειες';
$__LOCALE['RCULISTS_DPC'][14]='_code;Item;Κωδικός';
$__LOCALE['RCULISTS_DPC'][15]='_category;Category;Κατηγορία';
$__LOCALE['RCULISTS_DPC'][16]='_mailstatus;Reason;Αιτία';
$__LOCALE['RCULISTS_DPC'][17]='_cleanlist;Clean list;Καθαρισμός λίστας';
$__LOCALE['RCULISTS_DPC'][18]='_failmargin;Fail margin;Αποτυχίες';
$__LOCALE['RCULISTS_DPC'][19]='_denyview;Hidden;Απόκρυψη';
$__LOCALE['RCULISTS_DPC'][20]='_subupdate;Update list;Ενημέρωση λίστας';
$__LOCALE['RCULISTS_DPC'][21]='_subremove;Remove from list;Αφαίρεση απο την λίστα';
$__LOCALE['RCULISTS_DPC'][22]='_subcheck;Force activation;Με ενεργοποποίηση των ανενεργών';
$__LOCALE['RCULISTS_DPC'][23]='_subscan;Extract elements;Εξαγωγή άλλων στοιχείων';
$__LOCALE['RCULISTS_DPC'][24]='_subutils;Utilities;Ενέργειες';
$__LOCALE['RCULISTS_DPC'][25]='_newlistprompt;Enter a name for a new mailing list;Εισάγετε το όνομα της νέας λίστας';
$__LOCALE['RCULISTS_DPC'][26]='_sellistprompt;Choose an existing list;Επιλέξτε λίστα εισαγωγής';
$__LOCALE['RCULISTS_DPC'][27]='_subinsinto;Inset into list;Εισαγωγή σε λίστα';
$__LOCALE['RCULISTS_DPC'][28]='_selectlist;Select list;Επιλέξτε λίστα';
$__LOCALE['RCULISTS_DPC'][29]='_newlist;New list;Νεα λίστα';
$__LOCALE['RCULISTS_DPC'][30]='_listsep;List separator;Σύμβολο διαχωρισμού';
$__LOCALE['RCULISTS_DPC'][31]='_subtext;CSV emails;Emails με διαχωριστικά';
$__LOCALE['RCULISTS_DPC'][32]='_subsubmit;Submit;Εκτέλεση';
$__LOCALE['RCULISTS_DPC'][33]='_INSUPDDATE;Update date;Ημερομηνία μεταβολής';
$__LOCALE['RCULISTS_DPC'][34]='_ACTIVE;Active;Ενεργό';
$__LOCALE['RCULISTS_DPC'][35]='_LISTNAME;List;Όνομα λίστας';
$__LOCALE['RCULISTS_DPC'][36]='_ID;Id;Α/Α';
$__LOCALE['RCULISTS_DPC'][37]='_FAILED;Failed;Αποτυχίες';
$__LOCALE['RCULISTS_DPC'][38]='_doublemailcheck;Double mails check;Έλεγχος διπλοτύπων';
$__LOCALE['RCULISTS_DPC'][39]='_cleanbad;Disable bad mails;Απενεργοποίηση κακογραμμένων email';
$__LOCALE['RCULISTS_DPC'][40]='_cleanfailed;Disable failed;Απενεργοποίηση αποτυχημένων αποστολών';

class rculists  {

    var $title, $urlpath, $path, $seclevid, $userDemoIds;
	var $savehtmlpath, $messages, $owner, $defsep;

	public function __construct() {
	
		$this->title = localize('RCULISTS_DPC',getlocal());
		$this->prpath = paramload('SHELL','prpath'); 
		$this->urlpath = paramload('SHELL','urlpath');	
		
		$tmplsavepath = remote_paramload('RCBULKMAIL','tmplsavepath', $this->prpath);
		$savepath = $tmplsavepath ? $tmplsavepath : null;//$defaultsavepath;
		$this->savehtmlpath = $savepath ? $this->urlpath . $savepath : null;		
		
		$this->seclevid = GetSessionParam('ADMINSecID');
		$this->userDemoIds = array(5,6);//,7); //remote_arrayload('RCBULKMAIL','demouser', $this->prpath);

		$this->owner = decode(GetSessionParam('UserName'));//$_POST['Username'] ? $_POST['Username'] : GetSessionParam('LoginName');		
		$this->defsep = ',';
		$this->messages = null;	
	}

    public function event($event=null) {

		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;

		switch ($event) {	
		
			case 'cpcleanbounce'        :   $clean = $this->cleanListFromBounce(); 
			                                break;

			case 'cpsubscribe'    		: 	//$s1 = $this->dosubscribe();
											//$s2 = (GetParam('scan')) ? $this->mass_subscribe() : $this->bulk_subscribe();				
											$this->subscribePost();
											break;
									
		    case 'cpunsubscribe'  		: 	$this->dounsubscribe();				
											break;										
			case 'cpadvsubscribe' 		: 	break; 					
			case 'cpviewclicks'         :	break;
	        case 'cpviewtrace'          :   break;			
			 
	        case 'cpmailbodyshow' 		: 	die($this->show_mailbody());
											break;			
			
		    case 'cploadframe'    		:  	echo $this->loadframe('tracebody');
											die();
											break;			
			
			case 'cpulframe' 		 	:   echo $this->loadtrace('tracebody');
											die();
											break;

			case 'cpviewsubsqueueactiv' :   break;			
			
			case 'cpactivatequeuerec'   :	$this->activate_queue_rec(); //ajax call
											die('tracebody|<h1>Enabled</h1>');
											break;
									   
			case 'cpdeactivatequeuerec' :	$this->deactivate_queue_rec(); //ajax call
											die('tracebody|<h1>Disabled</h1>');
											break;				
			
			case 'cpulists'  :
			default          :                    
		}
    }

    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	

		switch ($action) {
			
			case 'cpcleanbounce'       : $out = $this->viewBounceList(); 
			                             break;
			
			case 'cpunsubscribe'       :	 
			case 'cpsubscribe'         :			 
		    case 'cpadvsubscribe' 	   : $out = $this->subscribeform(); 
										 break;	
										 
		    case 'cpviewclicks'  	   : $out = $this->viewClicks(); 				
	                                     break;			 
			
			case 'cpviewtrace'         : $out = $this->viewTrace($_GET['m'], $_GET['cid']);
                                         break; 											 
			
			case 'cpmailbodyshow'      :
			case 'cploadframe'         : 
			case 'cpulframe' 		   : break;
			
			case 'cpviewsubsqueueactiv': $out = $this->viewMails(null,400,16,'r',false); 
			                             break;				
			case 'cpactivatequeuerec'  :
			case 'cpdeactivatequeuerec':			
			case 'cpulists'  		   :
			default          		   : $out = $this->viewMails(null,280,12,'r',false);
		}

		return ($out);
    }

	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}	
	
	protected function viewClicks($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 600;
        $rows = $rows ? $rows : 25;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'r';
		$noctrl = $noctrl ? 0 : 1;	
		$nosearch = $_GET['cid'] ? 1 : 1;//0; where in sql

		$cid = $_GET['cid'] ? $_GET['cid'] : null;		
		$refsql = $cid ? "and ref='$cid'" : null;
		$ownerSQL = null;//($this->seclevid==9) ? null : 'and mailcamp.owner=' . $db->qstr($this->owner); 		
		   	
		if (defined('MYGRID_DPC')) {
		    $title = str_replace(' ','_',localize('_MAILCLICKS',getlocal()));
		   
			$sSQL = "select * from (SELECT stats.id,date,tid,attr1,attr3,title FROM stats,mailcamp where stats.ref=mailcamp.cid $refsql $ownerSQL order by date desc";
            $sSQL.= ') as o';  				

		    _m("mygrid.column use grid9+id|".localize('_id',getlocal())."|5|1|");
			_m("mygrid.column use grid9+date|".localize('_date',getlocal()).'|10|1');		   
            _m("mygrid.column use grid9+attr3|".localize('_receiver',getlocal()).'|10|1');
            _m("mygrid.column use grid9+title|".localize('_subject',getlocal()).'|20|1');	
			_m("mygrid.column use grid9+tid|".localize('_code',getlocal()).'|10|1');
            _m("mygrid.column use grid9+attr1|".localize('_category',getlocal()).'|20|1');			

		    $out .= _m("mygrid.grid use grid9+mailqueue+$sSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+$nosearch+1+1");
			
			//mail body ajax renderer
			//$out = "<div id='mailbody'></div>";
		}
        else  
			$out = null;
   		
	    return ($out);	
	}	
	
	//not used
	protected function loadclicks($ajaxdiv=null) {
	    $bodyurl = seturl("t=cpviewclicks&m=".GetReq('m')."&cid=".GetReq('cid'));
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv.'|'.$frame;
		else
			return ($frame);
	}		
	
	protected function viewTrace($mail=null, $cid=null) {
		if (!$mail) return null;
		$email = urldecode($mail);

		if (defined('MYGRID_DPC')) {
		    $title = str_replace(' ','_',localize('_MAILTRACE',getlocal()));
		   
			if ($cid) $cID = " and ref='$cid'";		   
	        $sSQL = "select * from (select id,date,tid,attr1 from stats where attr3='$email' $cID order by id";
            $sSQL.= ') as o';  				

		    _m("mygrid.column use grid9+id|".localize('_id',getlocal())."|5|1|");
			_m("mygrid.column use grid9+date|".localize('_date',getlocal()).'|date|5');				
            _m("mygrid.column use grid9+tid|".localize('_code',getlocal()).'|10|1');
            _m("mygrid.column use grid9+attr1|".localize('_category',getlocal()).'|30|1');			
			
			//view body ajax renderer
			$out .= "<div id='clickbody'></div>";			
			
		    $out .= _m("mygrid.grid use grid9+mailqueue+$sSQL+r+$title+id+1+1+11+260++1+1+1");
		}
        else  
			$out = null;
   		
	    return ($out);	
	}		

	protected function loadtrace($ajaxdiv=null) {
	    $bodyurl = seturl("t=cpviewtrace&m=".GetReq('m')."&cid=".GetReq('cid'));
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv.'|'.$frame;
		else
			return ($frame);
	}	
	
	protected function viewMails($width=null, $height=null, $rows=null, $mode=null, $noctrl=false, $invalid=null) {
	    $height = $height ? $height : 600;
        $rows = $rows ? $rows : 25;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'r';
		$noctrl = $noctrl ? 0 : 1;			
		   	
		if (defined('MYGRID_DPC')) {
		    $title = str_replace(' ','_',localize('_MAILQUEUE',getlocal()));
		    
		    if ($invalid) {
				$campaign = ($cid = GetParam('cid')) ? " and cid='$cid' " : null;
				$sSQL = "select * from (select id,active,timeout,receiver,subject,reply,status,mailstatus,cid from mailqueue where (status=-1 or status=-2) and active>-9 $campaign) as o";	
				$nosearch = 1;
			}
			else {
				$campaign = ($cid = GetParam('cid')) ? " where cid='$cid' " : null;
				$sSQL = "select * from (select id,active,timeout,receiver,subject,reply,status,mailstatus,cid from mailqueue $campaign) as o";  				
				$nosearch = $campaign ? 1 : 0;
			}	
		   		   
		    _m("mygrid.column use grid9+id|".localize('_id',getlocal())."|2|1|");
		    _m("mygrid.column use grid9+active|".localize('_active',getlocal()).'|link|2|'."javascript:disable({id});".'||');			
            _m("mygrid.column use grid9+timeout|".localize('_date',getlocal())."|link|5|"."javascript:enable({id});".'||'); //.'|date|1');				
			_m("mygrid.column use grid9+receiver|".localize('_receiver',getlocal())."|link|5|". "javascript:show_trace(\"{receiver}\",\"{cid}\");".'||'); //seturl('t=cpviewtrace&m={receiver}&cid={cid}').'||');	   
			_m("mygrid.column use grid9+subject|".localize('_subject',getlocal())."|link|15|"."javascript:show_body(\"{cid}\");".'||'); //.seturl('t=cpactivatequeuerec&rec={id}').'||');	
		    _m("mygrid.column use grid9+reply|".localize('_reply',getlocal()).'|2|1|||||right');	
		    _m("mygrid.column use grid9+status|".localize('_status',getlocal()).'|2|1|||||right');
		    _m("mygrid.column use grid9+mailstatus|".localize('_mailstatus',getlocal()).'|2|1');	
            _m("mygrid.column use grid9+cid|".localize('_cid',getlocal())."|link|5|"); 
			
			//trace/mail body ajax renderer
			$out = "<div id='tracebody'></div>";			
			
		    $out .= _m("mygrid.grid use grid9+mailqueue+$sSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+$nosearch+1+1");
			
			//mail body ajax renderer
			//$out .= "<div id='mailbody'></div>";
		}
        else  
			$out = null;
   		
	    return ($out);	
	}		
	
	protected function loadframe($ajaxdiv=null) {
	    $bodyurl = seturl("t=cpmailbodyshow&id=".GetReq('id'));
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv.'|'.$frame;
		else
			return ($frame);
	}	
	
    protected function show_mailbody() {
		$db = GetGlobal('db'); 	
		$_id = GetReq('id'); //as came from crmoubox ...

		if (is_numeric($_id)) {		//if id is numeric 
			$sSQL = 'select body from mailqueue where id=' . $_id;
			$result = $db->Execute($sSQL,2);
			$htmlbody = $result->fields[0]; 				
			//echo $sSQL;
		}
		elseif (strstr($_id, '@')) {//is cid=trackid@app, fetch maiqueue body
			$cid = $_id;
			if (!$cid) die("CID error");
			
			$sSQL = 'select body from mailqueue where cid='. $db->qstr($cid);
			$result = $db->Execute($sSQL,2);
			$htmlbody = $result->fields[0]; 				
			//echo $sSQL;		
		}
		else { //is campaign md5 id, fetch campaign body (not the mailqueue body)
			$cid = $_id;
			if (!$cid) die("CID error");
		
			//all as 9 user or only owned		
			$ownerSQL = null;//($this->seclevid==9) ? null : 'owner=' . $db->qstr($this->owner);
			$cidSQL = $ownerSQL ? 'and cid='.$db->qstr($cid) : 'cid='.$db->qstr($cid);	
		
			$sSQL = 'select body from mailcamp where '. $ownerSQL . $cidSQL;
			//echo $sSQL;		
		
			$result = $db->Execute($sSQL,2);
			$htmlbody = base64_decode($result->fields[0]);	
		}

		return ($htmlbody);	  
    }

	protected function deactivate_queue_rec() {
         $db = GetGlobal('db');
         $rec = GetReq('rec'); 
	   	   
	     $sSQL = "update mailqueue set active=0,mailstatus='USER_CANCEL' where id=" . $rec;	  
	     $res = $db->Execute($sSQL,1);	
	}	

	protected function activate_queue_rec() {
         $db = GetGlobal('db');
         $rec = GetReq('rec'); 
	   	   
	     $sSQL = "update mailqueue set active=1,mailstatus='USER_ACTIV' where id=" . $rec;
	     $res = $db->Execute($sSQL,1);	
	}		

	public function postSubmit($action, $title=null, $class=null) {
		if (!$action) return;
		$submit = $title ? $title : 'Submit';
		$cl = $class ? "class=\"$class\"" : null;
		 
        $c .= "<button type=\"submit\" name=\"submit\" value=\"" . $submit . "\" $cl />";  
        $c .= "<INPUT type=\"hidden\" name=\"FormName\" value=\"MailBulkInsert\" />";		   
        $c .= "<INPUT type=\"hidden\" name=\"FormAction\" value=\"" . $action . "\" $cl />";
        return ($c);   		   
	}	
	
    protected function subscribeform()  { 		
	    if ($this->isDemoUser())  //deny list from demo users
			$out = localize('_denyview',getlocal()); //"[List view kept hidden]";
		else {	
			//$out .= $this->ulistform(GetParam('ulistname'));
			$bodyurl = 'cpsubscribers.php?t=cpsubsframe';; 
			$out = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"320px\"><p>Your browser does not support iframes</p></iframe>";      
		}	
        return ($out);
    }		
	

	protected function subscribePost() {
		
		//$s1 = $this->dosubscribe(); //disabled one field email insert
		
		$subscan = GetParam('subscan'); //scanner mode
		$subupdate = GetParam('subupdate'); //update mode
		$subcheck = GetParam('subcheck'); //check mode
		$subremove = GetParam('subremove'); //remove mode (unsubscribe)
		
		if ($subscan) $this->messages[] = localize('_subscan',getlocal());
		if ($subupdate) $this->messages[] = localize('_subupdate',getlocal());
		if ($subcheck) $this->messages[] = localize('_subcheck',getlocal());
		if ($subremove) $this->messages[] = localize('_subremove',getlocal());
		
		if ($subscan)  {//scanner mode
		
			$this->mass_subscribe(true); 
			
			return true;
		}	
		else { //other modes
		
			if ($subremove) {  
				//if subupdate is on dont delete, update active=0
				$this->bulk_subscribe('remove',$subupdate,false);	
			}		
			elseif ($subupdate) {
				//if subcheck is on, update if mail exists and check if active with subcheck
				$this->bulk_subscribe('update',$subcheck,false);	
			}
			else//insert all mails in selected list (double mails allowed)	
				$this->bulk_subscribe(null,null,true);
			
			return true;
		}

		return false;	
	}	

	protected function dosubscribe($email=null, $name=null, $silent=false, $exist=false) {
        $db = GetGlobal('db');
        $dtime = date('Y-m-d h:i:s');		
        $subname = $name ? $name : 'unknown'; 		
	    $mail = $email ? $email : GetParam('submail');
		$ulistname = GetParam('ulistname') ? GetParam('ulistname') : 
						(GetParam('ulist') ? GetParam('ulist') : null);
		
		if ((!$mail) || (!$ulistname)) return false;		
	
		if ($this->_checkmail(self::strLower($mail)))  {
			$sSQL = "SELECT email,active FROM ulists where email=". $db->qstr(self::strLower($mail)) . 
			        " and listname=" . $db->qstr(self::strLower($ulistname)); 
			$ret = $db->Execute($sSQL,2);
				
            if (empty($ret->fields[0])) {
				
				$sSQL = "insert into ulists (email,startdate,active,lid,listname,name,owner) " .
						"values (" .
						$db->qstr(self::strLower($mail)) . "," . $db->qstr($dtime) . "," .
						"1,1," . 
						$db->qstr(self::strLower($ulistname)) . "," .
						$db->qstr($subname) . "," .
						$db->qstr($this->owner) . 
						")";  
				$db->Execute($sSQL);	
				//$this->messages[] = $sSQL; //test
				
				if (!$silent)
					$this->messages[] = $mail . ' added in list ' . self::strLower($ulistname);	
				
				return true;					
            }
			else {
				if ($exist) { //subcheck on
					//update ENABLE ALREADY DISABLED emails !!!
					$sSQL = "update ulists set active=1 where listname='". self::strLower($ulistname) .
							"' and email=" . $db->qstr(self::strLower($mail));  
					$db->Execute($sSQL,1);
					
					if (!$silent)
						$this->messages[] = $mail . ' activated in list. Exist in ' . self::strLower($ulistname);	
					//$this->messages[] = $sSQL; //test
					return true;		
				}
				else {
					if (!$silent)
						$this->messages[] = $mail . ' NOT added in list. Exist in ' . self::strLower($ulistname);	
					return false;
				}
			}	
		}

		$this->messages[] = localize('_MSG5',getlocal()) .' '. $mail;		
	   
	    return false;	   	
	}

	protected function dounsubscribe($mail=null, $silent=false) {
        $db = GetGlobal('db');
        $sFormErr = GetGlobal('sFormErr');	
	    $mail = $mail ? $mail : GetParam('submail');
		$ulistname = GetParam('ulistname') ? GetParam('ulistname') : 
						(GetParam('ulist') ? GetParam('ulist') : 'none');		
		
		if ((!$mail) || (!$ulistname)) return false;  
		
		if ($this->_checkmail(self::strLower($mail)))  {

			$sSQL = "update ulists set active=0 where email=" . $db->qstr(self::strLower($mail)) . 
					' and listname=' . $db->qstr(self::strLower($ulistname)); 
			$result = $db->Execute($sSQL,1);
		    //$this->messages[] = $sSQL; //test
			
			if (!$silent)
				$this->messages[] = $mail . ' deactivated';
			return true;
		}
			
		$this->messages[] = localize('_MSG5',getlocal()) .' '. $mail;;
		
        return false;		
	}	
	
	protected function bulk_subscribe($mode=null, $force=null, $silent=false) {
        $db = GetGlobal('db');
		$dtime = date('Y-m-d h:i:s');
		$subname = ''; 		
		$separator = GetParam('separator') ? GetParam('separator') : $this->defsep;	  
		$ulistname = GetParam('ulistname') ? GetParam('ulistname') : 
						(GetParam('ulist') ? GetParam('ulist') : null);		
		
		if (!$ulistname) {
			$this->messages[] = localize('_selectlist',getlocal());	
			return false;
		}	
		
		$mailtext = str_replace(array('\r','\n'), array('',''), trim(GetParam('csvmails')));	  		  	
		if (!$mailtext) {
			$this->messages[] = '0 mails added to list ' . self::strLower($ulistname);	
			return false;
		}	
		
		$mymails = strstr($mailtext, $separator) ? 
					explode($separator, $mailtext) : array(0=>trim($mailtext));	
					
		//check double mails
		$this->messages[] = count($mymails) . ' mails scanned';
		$this->messages[] = localize('_doublemailcheck',getlocal());
		$mymails = array_unique($mymails);
		$this->messages[] = count($mymails) . ' mails to import';
		
		$_smails = 0;
		set_time_limit(120);
		switch ($mode) {
			
			case 'update' : foreach ($mymails as $i=>$tok) {
								if (trim($tok)) {
									if ($force) { //subscheck on
										if ($ok = $this->dosubscribe($tok, '', $silent, true))
											$_smails += 1;
									}
									else { //subcheck off
										if ($ok = $this->dosubscribe($tok, '', $silent, false))
											$_smails += 1;	
									}
								}	
							}
							$this->messages[] =  $_smails . ' mails in ' . self::strLower($ulistname);
							break;
			
			case 'remove' : foreach ($mymails as $i=>$tok) {
								if (trim($tok)) {
									if ($force) { //subscheck
										if ($ok = $this->dounsubscribe($tok, $silent))
											$_smails += 1;
									}
									else {
										$sSQL = "delete from ulists where email=". $db->qstr(self::strLower($tok)) .
												" and  listname=" . $db->qstr(self::strLower($ulistname));// . 
												//" and owner=" . $db->qstr($this->owner); //owner restiction
										$db->Execute($sSQL);
										$_smails += 1;		
										//$this->messages[] = $sSQL;
									}
								}
							}
							$this->messages[] = $_smails . ' mails removed from ' . self::strLower($ulistname);	 
							break;
			
			case 'insert':
			default 	:	$sSQL = "insert into ulists (email,startdate,active,lid,listname,name,owner) values ";	
							foreach ($mymails as $i=>$tok) {
								if (trim($tok)) {
									$sql[] = "(" . $db->qstr(self::strLower($tok)) . "," . $db->qstr($dtime) . "," .
											"1,1," . $db->qstr(self::strLower($ulistname)) . "," .	
											$db->qstr($subname) . "," . $db->qstr($this->owner) . ")";  
								}		
							}
							$sSQL .= implode(',', $sql);
							$db->Execute($sSQL);		  
							//$this->messages[] = $sSQL;
							$_smails = count($mymails);
							$this->messages[] = $_smails . ' mails added in ' . self::strLower($ulistname);	 
		}
		set_time_limit(ini_get('max_execution_time'));
		
		return true;	
	}		
	
	protected function mass_subscribe($silent=false) {	  
		$separator = GetParam('separator') ? GetParam('separator') : $this->defsep;
		$ulistname = GetParam('ulistname') ? GetParam('ulistname') : 
						(GetParam('ulist') ? GetParam('ulist') : null);		
					
		if (!$ulistname) {
			$this->messages[] = localize('_selectlist',getlocal());	
			return false;
		}	
		
		$mailtext = str_replace(array('\r','\n'), array('',''), trim(GetParam('csvmails')));
		if (!$mailtext) {
			$this->messages[] = '0 mails added to list ' . $ulistname;	
			return false;
		}			
		
		$mymails = strstr($mailtext, $separator) ? 
					explode($separator, $mailtext) : array(0=>trim($mailtext));	
					
		//check double mails
		$this->messages[] = count($mymails) . ' mails scanned';
		$this->messages[] = localize('_doublemailcheck',getlocal());
		$mymails = array_unique($mymails);
		$this->messages[] = count($mymails) . ' mails to import';					
					
		$x=0; $x2=0;
		$n=0;
		$e=0;
		set_time_limit(120);
		foreach ($mymails as $i=>$tok) {
			
			if (!trim($tok)) continue;
			
			if ($doit = $this->dosubscribe($tok,'undefined',$silent)) {//is a mail address...
				if ($doit>0) 
					$x+=1;
				elseif ($doit<0) 
					$x2+=1;
			}  
			else {//..is a combo mail/name
		
				$doit_2 = $this->subscribe_extracting_name($tok, $silent);
		  
				if ($doit_2) {
					$n+=1;
					if ($doit_2>0) 
						$x+=1;
					elseif ($doit_2<0)
						$x2+=1;			
					else
						$e+=1;    
				}
				else		
					$e+=1; 
			}	
		}
		set_time_limit(ini_get('max_execution_time'));
	  
		$this->messages[] = $x . ' mails added';
		$this->messages[] =	$x2 . ' mails updated from ' . count($mymails);	
		$this->messages[] =	$n . ' names extracted';
		$this->messages[] = $e . ' tokens not recognized';
	  
		SetGlobal('sFormErr', implode(', ', $this->messages));
		
		return true;	
	}	

	protected function subscribe_extracting_name($token=null, $silent=false) {
        $db = GetGlobal('db'); 
		if (!$token) return;	
		$matches = array();
					
	    //method 1 name <mail>
	    $pattern = "@<(.*?)>@";
	    preg_match($pattern,$token,$matches);
	    $extracted_mail = trim(strtolower($matches[1]));

		if ($this->_checkmail($extracted_mail)) {	  
		  if ($name = str_replace($extracted_mail,'',$token)) {
		    //echo $name,'<br>'
		    $name = str_replace('"','',$name);
		    $name = str_replace("'",'',$name);
		    $name = str_replace('<>','',$name);			
		  }
		  $s = $this->dosubscribe($extracted_mail,$name,$silent);
		  return ($s);	   
	    }
		else { //method 2 name [mail]
	      $pattern2 = "@[(.*?)]@";
	      preg_match($pattern2,$token,$matches);
	      //print_r($matches);
	      $extracted_mail = trim(strtolower($matches[1]));
		 
		  if ($this->_checkmail($extracted_mail)) {	  
		    if ($name = str_replace($extracted_mail,'',$token)) {		
		      $name = str_replace('"','',$name);
			  $name = str_replace("'",'',$name);
		      $name = str_replace('[]','',$name);			
		    }
		    $s = $this->dosubscribe($extracted_mail,$name,$silent);
		    return ($s);		   			   
	      }
		  else { //method 3 name mail
		    $mytokens = explode(' ',$token);
		    $name = trim($mytokens[0]);
		    $extracted_mail = trim(strtolower($mytokens[1])); 
		  
		    if ($this->_checkmail($extracted_mail)) {		
		      if ($name = str_replace($extracted_mail,'',$token)) {
		        $name = str_replace('"','',$name);
			    $name = str_replace("'",'',$name);
			  }	
		      $s = $this->dosubscribe($extracted_mail,$name,$silent);
		      return ($s);	   
			}  
	      }		  
		}

        return false;
	}		

	public function viewUList($exclude_selected=false, $selectedID=null) {
		$db = GetGlobal('db');
		
		$sSQL = 'select distinct listname from ulists ';		   
		if ($exclude_selected)
			$sSQL .= " where listname <> " . $db->qstr($this->ulistselect);	
		$sSQL .= " ORDER BY listname";	

		//echo $sSQL;	
	    $resultset = $db->Execute($sSQL,2);	
		
		//print_r($resultset);
		foreach ($resultset as $n=>$rec) {
			$selected = $selectedID ? (GetParam($selectedID)==$rec[0] ? ' selected' : null) : null;
			$ret  .= "<option value='".$rec[0]."'$selected>". $rec[0]."</option>" ;
        }		
        
		return ($ret);			
	}	
	
	
	protected function viewBounceList() {
		$selectUList = ($ulist=GetParam('ulist')) ? " and listname='$ulist' " : null;
		
		if ($ulist) {//selected list
			$title = str_replace(' ','_',$ulist);
			
			$sSQL = "select * from (";
			$sSQL.= "SELECT id,datein,startdate,active,failed,name,email,listname FROM ulists where active=1 and failed>0 $selectUList";
			$sSQL .= ') as o';  		   
			//echo $sSQL;
			_m("mygrid.column use grid1+id|".localize('_ID',getlocal()).'|2|0');
			_m("mygrid.column use grid1+email|".localize('_SUBMAIL',getlocal()).'|10|1');
			_m("mygrid.column use grid1+listname|".localize('_LISTNAME',getlocal()).'|10|1');
			_m("mygrid.column use grid1+startdate|".localize('_SUBDATE',getlocal()).'|8|0');
			_m("mygrid.column use grid1+datein|".localize('_INSUPDDATE',getlocal()).'|8|0');			
			_m("mygrid.column use grid1+name|".localize('_FNAME',getlocal()).'|19|1');	
			_m("mygrid.column use grid1+active|".localize('_ACTIVE',getlocal()).'|boolean|1');	
			_m("mygrid.column use grid1+failed|".localize('_FAILED',getlocal()).'|5|1');	
			//_m("mygrid.column use grid1+listname|".localize('_LISTNAME',getlocal()).'|20|1');		
			$out = _m("mygrid.grid use grid1+ulists+$sSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");
		
		}
		else //campaign msg list
			$out = $this->viewMails(null,400,16,'r',false,true); 
		
		return $out;
	}	

	protected function cleanListFromBounce($fid=null) {
		$db = GetGlobal('db');	
		$cleanbad = GetParam('cleanbad');
		$cleanfailed = GetParam('cleanfailed');		
		$sendtimes = GetParam('fid') ? GetParam('fid') : ($fid ? $fid : 0);
		$campaign = ($cid = GetParam('cid')) ? " and cid='$cid' " : null;
		$ulistname = ($ulist = GetParam('ulist')) ? " and listname='$ulist' " : null;
		$backtime = " and DATE(timein) BETWEEN DATE( DATE_SUB( NOW() , INTERVAL 265 DAY ) ) AND DATE ( NOW() )";
		$camptime = $campaign ? null : $backtime; //time limit 265 days when no campaign id
		$ret = 0;
		
		if ($cleanbad) $this->messages[] = localize('_cleanbad',getlocal());
		if ($cleanfailed) $this->messages[] = localize('_cleanfailed',getlocal());
		
		//clean Invalid mails 
		$m = 0;		
		$sSQL = $ulistname ?
					"select receiver,count(m.id) as c from mailqueue m LEFT JOIN ulists ON receiver=email where m.active=0 and status=-1 $ulistname and ulists.active=1 $backtime group by receiver" :
					"select receiver,count(id) as c from mailqueue where active=0 and status=-1 $campaign $camptime group by receiver";		   				
	    $result = $db->Execute($sSQL,2);
		if (!empty($result)) {
			foreach ($result as $i=>$rec) {
				$m+=1;
				if (($cleanbad) && ($sendtimes) && (intval($rec[1])>0)) { // if post
					$sSQL = "update ulists set active=0 where active=1 and failed>0 and email=".$db->qstr($rec[0]);
					$sSQL.= $ulistname;
					$resultset = $db->Execute($sSQL);
					//$this->messages[] = $rec[0] . ' is invalid, became inactive';				
					//$this->messages[] = $sSQL; //test
					
					//clean body data from queue
					$sSQL2 = "update mailqueue set active=-9,pass='',body='' where active=0 and status=-1 and receiver=".$db->qstr($rec[0]);
					$result = $db->Execute($sSQL2);
				}	
				else
					$this->messages[] = $rec[0] . ' is invalid';				
			}
			if ($m) {			
				$this->messages[] = ($sendtimes) ?  
										$m . ' invalid mails deactivated' :
										$m . ' invalid mails';
			}							
		}
		
		//clean bounced mails
		$m = 0;
		$sSQL = $ulistname ?
					"select receiver,count(m.id) as c from mailqueue m LEFT JOIN ulists ON receiver=email where m.active=0 and reply IS NULL and status=-2 $ulistname and ulists.active=1 $backtime group by receiver" :
					"select receiver,count(id) as c from mailqueue where active=0 and reply IS NULL and status=-2 $campaign $camptime group by receiver";		   			
	    $result = $db->Execute($sSQL,2);
		if (!empty($result)) {
			foreach ($result as $i=>$rec) {
				$m+=1;
				if (($cleanfailed) && ($sendtimes) && (intval($rec[1])>=$sendtimes)) {	//if post
					$sSQL = "update ulists set active=0 where active=1 and failed>$sendtimes and email=".$db->qstr($rec[0]);
					$sSQL.= $ulistname;
					$resultset = $db->Execute($sSQL);		
					//$this->messages[] = $rec[0] . ' became inactive, has failed transmitions:'.$rec[1];			
					//$this->messages[] = $sSQL; //test
					
					//clean body data from queue based on fails					
					$sSQL2 = "update mailqueue set active=-9,pass='',body='' where active=0 and status=-2 and reply IS NULL and receiver=".$db->qstr($rec[0]);
					$result = $db->Execute($sSQL2);	
				}
				else
					$this->messages[] = $rec[0] . ' failed to transmit '.$rec[1] . ' times';
			}
			if ($m) {
				$this->messages[] = ($sendtimes) ?	
										$m . ' emails deactivated':
										$m . ' emails failed to transmit';
			}
		}

		return true;
	}
	
	public function viewMessages() {
		if (empty($this->messages)) return;

		foreach ($this->messages as $m=>$message) {
				$ret .= "<option value=\"$m\">$message</option>";
		}
		return ($ret);
	}		

    protected function _checkmail($data) {

        $ret = filter_var($data, FILTER_VALIDATE_EMAIL);
		return ($ret);  
	}	

	protected static function strLower($str) {
		return strtolower(trim($str));
		//return mb_strtolower(trim($str));
	}

};
}
?>