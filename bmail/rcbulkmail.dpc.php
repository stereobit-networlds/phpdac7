<?php

$__DPCSEC['RCBULKMAIL_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ( (!defined("RCBULKMAIL_DPC")) && (seclevel('RCBULKMAIL_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCBULKMAIL_DPC",true);

$__DPC['RCBULKMAIL_DPC'] = 'rcbulkmail';

$v = GetGlobal('controller')->require_dpc('crypt/ciphersaber.lib.php');
require_once($v); 

$a = GetGlobal('controller')->require_dpc('libs/appkey.lib.php');
require_once($a);


$__EVENTS['RCBULKMAIL_DPC'][0]='cpbulkmail';
$__EVENTS['RCBULKMAIL_DPC'][1]='cpsavemailadv';
$__EVENTS['RCBULKMAIL_DPC'][2]='cpsubsend';
$__EVENTS['RCBULKMAIL_DPC'][3]='cpsubloadhtmlmail';
$__EVENTS['RCBULKMAIL_DPC'][4]='cpviewcamp';
$__EVENTS['RCBULKMAIL_DPC'][5]='cppreviewcamp';
$__EVENTS['RCBULKMAIL_DPC'][6]='cpmailstats';
$__EVENTS['RCBULKMAIL_DPC'][7]='cpviewclicks';
$__EVENTS['RCBULKMAIL_DPC'][8]='cpviewtrace';
$__EVENTS['RCBULKMAIL_DPC'][9]='cpcampcontent';
$__EVENTS['RCBULKMAIL_DPC'][10]='cpdeletecamp';
$__EVENTS['RCBULKMAIL_DPC'][11]='cptemplatenew';
$__EVENTS['RCBULKMAIL_DPC'][12]='cptemplatesav';
$__EVENTS['RCBULKMAIL_DPC'][13]='cppausecamp';
$__EVENTS['RCBULKMAIL_DPC'][14]='cpstopcamp';
$__EVENTS['RCBULKMAIL_DPC'][15]='cpcontinuecamp';
$__EVENTS['RCBULKMAIL_DPC'][16]='cpstartcamp';
$__EVENTS['RCBULKMAIL_DPC'][17]='cpiscontent';

$__ACTIONS['RCBULKMAIL_DPC'][0]='cpbulkmail';
$__ACTIONS['RCBULKMAIL_DPC'][1]='cpsavemailadv';
$__ACTIONS['RCBULKMAIL_DPC'][2]='cpsubsend';
$__ACTIONS['RCBULKMAIL_DPC'][3]='cpsubloadhtmlmail';
$__ACTIONS['RCBULKMAIL_DPC'][4]='cpviewcamp';
$__ACTIONS['RCBULKMAIL_DPC'][5]='cppreviewcamp';
$__ACTIONS['RCBULKMAIL_DPC'][6]='cpmailstats';
$__ACTIONS['RCBULKMAIL_DPC'][7]='cpviewclicks';
$__ACTIONS['RCBULKMAIL_DPC'][8]='cpviewtrace';
$__ACTIONS['RCBULKMAIL_DPC'][9]='cpcampcontent';
$__ACTIONS['RCBULKMAIL_DPC'][10]='cpdeletecamp';
$__ACTIONS['RCBULKMAIL_DPC'][11]='cptemplatenew';
$__ACTIONS['RCBULKMAIL_DPC'][12]='cptemplatesav';
$__ACTIONS['RCBULKMAIL_DPC'][13]='cppausecamp';
$__ACTIONS['RCBULKMAIL_DPC'][14]='cpstopcamp';
$__ACTIONS['RCBULKMAIL_DPC'][15]='cpcontinuecamp';
$__ACTIONS['RCBULKMAIL_DPC'][16]='cpstartcamp';
$__ACTIONS['RCBULKMAIL_DPC'][17]='cpiscontent';

$__LOCALE['RCBULKMAIL_DPC'][0]='RCBULKMAIL_DPC;Mail queue;Mail queue';
$__LOCALE['RCBULKMAIL_DPC'][1]='_campaigns;Campaigns;Καμπάνιες';
$__LOCALE['RCBULKMAIL_DPC'][2]='_MAILCAMPAIGNS;Mail campaigns;Αποστολές σε συνδρομητές';
$__LOCALE['RCBULKMAIL_DPC'][3]='_active;Active;Ενεργό';
$__LOCALE['RCBULKMAIL_DPC'][4]='_sender;Sender;Αποστολέας';
$__LOCALE['RCBULKMAIL_DPC'][5]='_receiver;Receiver;Παραλήπτης';
$__LOCALE['RCBULKMAIL_DPC'][6]='_reply;Views;Εμφανίσεις';
$__LOCALE['RCBULKMAIL_DPC'][7]='_subject;Subject;Θέμα';
$__LOCALE['RCBULKMAIL_DPC'][8]='_id;Id;Α/Α';
$__LOCALE['RCBULKMAIL_DPC'][9]='_HTMLSELECTEDITEMS;Selected items;Επιλεγμένα αντικείμενα';
$__LOCALE['RCBULKMAIL_DPC'][10]='_inlist;List;Σε λίστα';
$__LOCALE['RCBULKMAIL_DPC'][11]='_sendtousers;Send to Users;Αποστολή σε χρήστες';
$__LOCALE['RCBULKMAIL_DPC'][12]='_sendtolists;Send to Lists;Αποστολη σε λίστες';
$__LOCALE['RCBULKMAIL_DPC'][13]='_savenewsletter;Save Newsletter;Αποθήκευση περιεχομένου';
$__LOCALE['RCBULKMAIL_DPC'][14]='_options;Options;Ρυθμίσεις';
$__LOCALE['RCBULKMAIL_DPC'][15]='_ACTIVE;Active;Ενεργό';
$__LOCALE['RCBULKMAIL_DPC'][16]='_LISTNAME;List;Όνομα λίστας';
$__LOCALE['RCBULKMAIL_DPC'][17]='_ID;Id;Α/Α';
$__LOCALE['RCBULKMAIL_DPC'][18]='_email;e-Mail;e-Mail';
$__LOCALE['RCBULKMAIL_DPC'][19]='_MAILQUEUE;Mail list;Λίστα αποστολών';
$__LOCALE['RCBULKMAIL_DPC'][20]='_MAILQUEUEACTIVE;Active queue;Πρός αποστολή';
$__LOCALE['RCBULKMAIL_DPC'][21]='_SELECTITEMS;Select Items;Επιλογή στοιχείων';
$__LOCALE['RCBULKMAIL_DPC'][22]='_OPTIONS;Options;Επιλογές';
$__LOCALE['RCBULKMAIL_DPC'][23]='_status;Status;Κατάσταση';
$__LOCALE['RCBULKMAIL_DPC'][24]='_mailstatus;Reason;Αιτία';
$__LOCALE['RCBULKMAIL_DPC'][25]='_date;Date sent;Ημ. αποστολής';
$__LOCALE['RCBULKMAIL_DPC'][26]='_unsubscribe;Unsubscribe;Διαγραφή απο την λίστα';
$__LOCALE['RCBULKMAIL_DPC'][27]='_viewasweb;View as web page;Πατήστε εδώ για να δείτε την ιστοσελίδα';
$__LOCALE['RCBULKMAIL_DPC'][28]='_notifications;Notifications;Ειδοποιήσεις';
$__LOCALE['RCBULKMAIL_DPC'][29]='_viewallnotifications;View all notifications;Όλες οι ειδοποιήσεις';
$__LOCALE['RCBULKMAIL_DPC'][30]='_owner;Owner;Owner';
$__LOCALE['RCBULKMAIL_DPC'][31]='_dashboard;Dashboard;Στατιστικά';
$__LOCALE['RCBULKMAIL_DPC'][32]='_year;Year;Έτος';
$__LOCALE['RCBULKMAIL_DPC'][33]='_month;Month;Μήνας';
$__LOCALE['RCBULKMAIL_DPC'][34]='_here;here;εδώ';
$__LOCALE['RCBULKMAIL_DPC'][35]='_cid;Campaign;Καμπάνια';
$__LOCALE['RCBULKMAIL_DPC'][36]='_MAILTRACE;Actions;Ενέργειες';
$__LOCALE['RCBULKMAIL_DPC'][37]='_msgsuccess;Mail sent;Το μήνυμα στάλθηκε επιτυχώς';
$__LOCALE['RCBULKMAIL_DPC'][38]='_msgerror;Sent error;Το μήνυμα απέτυχε να σταλθεί';
$__LOCALE['RCBULKMAIL_DPC'][39]='_delcamp;Campaign deleted;Επιτυχής διαγραφή';
$__LOCALE['RCBULKMAIL_DPC'][40]='_template;Template;Template';
$__LOCALE['RCBULKMAIL_DPC'][41]='_collection;Collection;Collection';
$__LOCALE['RCBULKMAIL_DPC'][42]='_transactions;Transaction/Month;Συναλλαγές ανα μήνα';
$__LOCALE['RCBULKMAIL_DPC'][43]='_applications;Applications Birth/Month;Νεές εφαρμογές ανα μήνα';
$__LOCALE['RCBULKMAIL_DPC'][44]='_appexpires;Applications Expires/Month;Ληξεις εφαρμογών ανα μήνα';
$__LOCALE['RCBULKMAIL_DPC'][45]='_mailqueue;Mail send/Month;Σταλθέντα e-mail ανα μήνα';
$__LOCALE['RCBULKMAIL_DPC'][46]='_mailsendok;Mail Received/Month;Παρεληφθέντα e-mail ανα μήνα';
$__LOCALE['RCBULKMAIL_DPC'][47]='_income;Income;Εισόδημα';
$__LOCALE['RCBULKMAIL_DPC'][48]='_moretrans;All transactions;Όλες οι συναλλαγές';
$__LOCALE['RCBULKMAIL_DPC'][49]='_list;List;Λίστα';
$__LOCALE['RCBULKMAIL_DPC'][50]='_campaign;Campaign;Καμπάνια';
$__LOCALE['RCBULKMAIL_DPC'][51]='_code;Item;Κωδικός';
$__LOCALE['RCBULKMAIL_DPC'][52]='_category;Category;Κατηγορία';
$__LOCALE['RCBULKMAIL_DPC'][53]='_outoflist;out of list;εξήχθει απο';
$__LOCALE['RCBULKMAIL_DPC'][54]='_FAILED;Bounce;Bounce';
$__LOCALE['RCBULKMAIL_DPC'][55]='_pausecamp;Campaign paused;Καμπάνια σε παύση';
$__LOCALE['RCBULKMAIL_DPC'][56]='_stopcamp;Campaign stoped;Καμπάνια σταματημένη';
$__LOCALE['RCBULKMAIL_DPC'][57]='_unpausecamp;Campaign unpaused;Καμπάνια ενεργοποιήθηκε';
$__LOCALE['RCBULKMAIL_DPC'][58]='_activecamp;Campaign active;Καμπάνια σε εξέλιξη';
$__LOCALE['RCBULKMAIL_DPC'][59]='_completecamp;Campaign completed;Καμπάνια ολοκληρωμένη';
$__LOCALE['RCBULKMAIL_DPC'][60]='_lastrun;Last submit;Τελευταία αποστολή';
$__LOCALE['RCBULKMAIL_DPC'][61]='_instantmail;The first in lists will receive instant e-mail;Η πρώτη καταχώρηση θα λάβει το μήνυμα άμεσα';
$__LOCALE['RCBULKMAIL_DPC'][62]='_neverrun;Not runned;Δεν εκτελέστηκε';
$__LOCALE['RCBULKMAIL_DPC'][63]='_schedule;Set time;Χρονορύθμιση';
$__LOCALE['RCBULKMAIL_DPC'][65]='_step;Step;Βήμα';
$__LOCALE['RCBULKMAIL_DPC'][66]='_content;Content;Περιεχόμενο';
$__LOCALE['RCBULKMAIL_DPC'][67]='_template;Template;Πρότυπο';
$__LOCALE['RCBULKMAIL_DPC'][68]='_components;Components;Στοιχεία';
$__LOCALE['RCBULKMAIL_DPC'][69]='_pattern;Pattern;Ακολουθία';
$__LOCALE['RCBULKMAIL_DPC'][70]='_preview;Preview;Προεπισκόπηση';
$__LOCALE['RCBULKMAIL_DPC'][71]='_prev;Previous;Προηγούμενο';
$__LOCALE['RCBULKMAIL_DPC'][72]='_next;Next;Επόμενο';
$__LOCALE['RCBULKMAIL_DPC'][73]='_startcamp;Start;Εκκίνηση';
$__LOCALE['RCBULKMAIL_DPC'][74]='_campwiz;Campaign wizard;Οδηγός καμπάνιας';
$__LOCALE['RCBULKMAIL_DPC'][75]='_distlist;Distribution lists;Λίστες διανομής';
$__LOCALE['RCBULKMAIL_DPC'][76]='_options;Options;Ρυθμίσεις';
$__LOCALE['RCBULKMAIL_DPC'][77]='_selectlist;Select list;Επιλογή λίστας';
$__LOCALE['RCBULKMAIL_DPC'][78]='_addon;Addon components;Επιπλέον στοιχεία';
$__LOCALE['RCBULKMAIL_DPC'][79]='_csv;CSV mails;CSV λίστα';
$__LOCALE['RCBULKMAIL_DPC'][80]='_edit;Edit;Επεξεργασία';
$__LOCALE['RCBULKMAIL_DPC'][81]='_new;New;Νέο';
$__LOCALE['RCBULKMAIL_DPC'][82]='_customers;Application customers;Πελάτες εφαρμογής';
$__LOCALE['RCBULKMAIL_DPC'][83]='_users;Application users;Χρήστες εφαρμογής';
$__LOCALE['RCBULKMAIL_DPC'][84]='_timetable;Timetable;Χρονοπίνακας';
$__LOCALE['RCBULKMAIL_DPC'][85]='_viewasweb;View as web page link;Σύνδεσμος προβολής στο web';
$__LOCALE['RCBULKMAIL_DPC'][86]='_linetext;Show text;Προτροπή';
$__LOCALE['RCBULKMAIL_DPC'][87]='_viewunsub;Unsubscribe link;Σύνδεσμος διαγραφής απο την λίστα διανομής';
$__LOCALE['RCBULKMAIL_DPC'][88]='_tokens;Tokens;Tokens';
$__LOCALE['RCBULKMAIL_DPC'][89]='_start;Start;Εκκίνηση';
$__LOCALE['RCBULKMAIL_DPC'][90]='_finish;Finish;Τέλος';
$__LOCALE['RCBULKMAIL_DPC'][91]='_savecamp;Save campaign;Αποθήκευση καμπάνιας';
$__LOCALE['RCBULKMAIL_DPC'][92]='_details;Details;Λεπτομέριες';
$__LOCALE['RCBULKMAIL_DPC'][93]='_select;Select;Επιλογή';
$__LOCALE['RCBULKMAIL_DPC'][94]='_objselect;Object selection list;Επιλογή αντικειμένων';
$__LOCALE['RCBULKMAIL_DPC'][95]='_up;Up;Πάνω';
$__LOCALE['RCBULKMAIL_DPC'][96]='_dn;Dn;Κάτω';
$__LOCALE['RCBULKMAIL_DPC'][97]='_save;Save;Αποθήκευση';
$__LOCALE['RCBULKMAIL_DPC'][98]='_title;Title;Τίτλος';
$__LOCALE['RCBULKMAIL_DPC'][99]='_templatewiz;Template wizard;Οδηγός κατασκευής περιεχομένου';
$__LOCALE['RCBULKMAIL_DPC'][100]='_back;Return;Επιστροφή';
$__LOCALE['RCBULKMAIL_DPC'][101]='_pause;Pause;Παύση';
$__LOCALE['RCBULKMAIL_DPC'][102]='_stop;Stop;Σταμάτημα';
$__LOCALE['RCBULKMAIL_DPC'][103]='_delete;Delete;Διαγραφή';
$__LOCALE['RCBULKMAIL_DPC'][104]='_continue;Continue;Συνέχεια';
$__LOCALE['RCBULKMAIL_DPC'][105]='_newcamp;New campaign;Νέα καμπάνια';
$__LOCALE['RCBULKMAIL_DPC'][106]='_start;Start;Εκκίνηση';
$__LOCALE['RCBULKMAIL_DPC'][107]='_end;End;Τέλος';
$__LOCALE['RCBULKMAIL_DPC'][108]='_process;Processing;Αποστολή';
$__LOCALE['RCBULKMAIL_DPC'][109]='_saybatch;e-mail(s) have been processed;μηνύματα έχουν επεξεργαστεί';
$__LOCALE['RCBULKMAIL_DPC'][110]='_saybatchtotal;e-mail(s) as total, have been processed; συνολικά μηνύματα έχουν επεξεργαστεί.';
$__LOCALE['RCBULKMAIL_DPC'][111]='_cancel;Cancel;Ακύρωση';

class rcbulkmail {
	
	var $title, $prpath, $urlpath, $url, $mtrackimg;
    var $trackmail, $overwrite_encoding, $encoding, $templatepath;
	var $mailname, $mailuser, $mailpass, $mailserver;
	var $ishtml, $mailbody, $template_ext, $template_images_path, $template;
	var $ulistselect, $messages, $cid, $savehtmlpath, $savehtmlurl;
	var $stats, $cpStats, $hasgraph, $goto, $refresh, $ajaxgraph, $objcall;
	var $sendOk, $iscollection, $disable_settings, $user_realm;
	
	var $appname, $appkey, $cptemplate, $urlRedir, $urlRedir2, $webview, $nsPage;
	var $owner, $seclevid, $isHostedApp;
	
	var $userDemoIds, $crmLevel, $maxinpvars, $batchid, $ckeditver;
	var $newtemplatebody, $saved, $savedname, $newsubtemplatebody, $newpatternbody;
	var $_OPT, $exitCode;
		
    public function __construct() {
	  
		$this->prpath = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');	
		$this->url = paramload('SHELL','urlbase');
		$this->title = localize('RCBULKMAIL_DPC',getlocal());	

		$tcode = remote_paramload('RCBULKMAIL','trackurl', $this->prpath);
		$this->mtrackimg = $tcode ? $tcode : "http://www.stereobit.gr/mtrack.php";
		$track = remote_paramload('RCBULKMAIL','track',$this->prpath);
	    $this->trackmail = $track ? true : false;		
		
		$this->mailname = remote_paramload('RCBULKMAIL','realm',$this->prpath);
		$this->mailuser = remote_paramload('RCBULKMAIL','user',$this->prpath);
		$this->mailpass = remote_paramload('RCBULKMAIL','password',$this->prpath);
		$this->mailserver = remote_paramload('RCBULKMAIL','server',$this->prpath);	
						
		$char_set  = arrayload('SHELL','char_set');	  
		$charset  = paramload('SHELL','charset');	  		
		if (($charset=='utf-8') || ($charset=='utf8'))
			$this->encoding = 'utf-8';
		else  
			$this->encoding = $char_set[getlocal()];
		
		$this->overwrite_encoding = remote_paramload('RCBULKMAIL','encoding',$this->prpath);
        $this->templatepath = $this->urlpath . remote_paramload('RCBULKMAIL','templatepath',$this->prpath);
		$tmplext = remote_paramload('RCBULKMAIL','tmplext', $this->prpath);
		$this->template_ext = $tmplext ? $tmplext : '.html';
		$tmplsubext = remote_paramload('RCBULKMAIL','tmplsubext', $this->prpath);
		$this->template_subext = $tmplsubext ? $tmplsubext : '-sub.htm';
		
		$ipath = remote_paramload('RCBULKMAIL','tmplpathimg',$this->prpath);
	    $this->template_images_path = $this->urlpath . $ipath;		
		$this->template = GetReq('stemplate') ? GetReq('stemplate') : GetSessionParam('stemplate');
		
		$this->ulistselect = GetReq('ulistselect') ? GetReq('ulistselect') : GetSessionParam('ulistselect');
		$this->ishtml = true;
		$this->mailbody = null;
		$this->cid = $_GET['cid'] ? $_GET['cid'] : $_POST['xcid']; //XCID for POST //no gereq,getparam may cid used by campaigns is in cookies
		
        //$defaultsavepath = remote_paramload('FRONTHTMLPAGE','path', $this->prpath);
		$tmplsavepath = remote_paramload('RCBULKMAIL','tmplsavepath', $this->prpath);		
		$this->nsPage = remote_paramload('RCBULKMAIL','webview', $this->prpath);
		$this->webview = $this->nsPage ? 1 : 0;
		
		$savepath = $tmplsavepath ? $tmplsavepath : null;//$defaultsavepath;
		$this->savehtmlpath = $savepath ? $this->urlpath . $savepath : null;
		$this->savehtmlurl = $savepath ? ($this->webview ? $this->url .'/'. $this->nsPage : $this->url . $savepath) : null;

		$this->appname = paramload('ID','instancename');
		$this->appkey = new appkey();			
		
		$this->messages = array(); //reset messages any time page reload - local msg system

		$this->urlRedir = remote_paramload('RCBULKMAIL','urlredir', $this->prpath);
		$this->urlRedir2 = remote_paramload('RCBULKMAIL','urlredir2', $this->prpath);	

		$settings = remote_paramload('RCBULKMAIL','settingsdisable', $this->prpath);		
		$this->disable_settings = $settings ? true : false; //form disable
		$this->user_realm = remote_paramload('RCBULKMAIL','userrealm', $this->prpath);
		
		$this->owner = $_POST['Username'] ? $_POST['Username'] : GetSessionParam('LoginName'); //decode(GetSessionParam('UserName'));	
		$this->seclevid = GetSessionParam('ADMINSecID');			

		$this->isHostedApp = remote_paramload('RCBULKMAIL','hostedapp', $this->prpath);
		//echo '>', GetSessionParam('LoginName').'<br/>'.GetSessionParam('UserName').'<br/>'.decode(GetSessionParam('UserName'));
		//$timeZone = 'Europe/Athens';  // +2 hours !!! (cron must run at the same timezone)
		
		$this->sendOk = 0; //false unitl bid decrease to 0
		$this->batchid = GetParam('bid') ? GetParam('bid') : 0; //as reade by post form when send submit
		$this->maxinpvars = 2500; //ini_get('max_input_vars') - 50; //DEPEND ON SRV AND DEFINES THE BATCH OUTPUT		
		
		$this->userDemoIds = array(5,6);//,7); //remote_arrayload('RCBULKMAIL','demouser', $this->prpath);
		$this->crmLevel = 9;
		
		$ckeditorVersion = remote_paramload('RCBULKMAIL','ckeditor',$this->prpath);		
		$this->ckeditver = $ckeditorVersion ? $ckeditorVersion : 4; //default version 4
		//override ckeditver
		$this->ckeditver = (($_GET['t']=='cptemplatenew') ||
							($_GET['t']=='cptemplatesav')) ? 
							3 : 4; //depends on select or edit/new template

		$this->newtemplatebody = null;	
		$this->newsubtemplatebody = null;
		$this->newpatternbody = null;
		$this->saved = false;
        $this->savedname = null;
		$this->iscollection = false;

		$this->_OPT = false;
		$this->exitCode = '-001';	
	}
	
    public function event($event=null) {
	
	    $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;
		
		if (defined('RCCOLLECTIONS_DPC')) //used by wizard html page !!
			$this->iscollection = _m('rccollection.isCollection');  		
					
  
	    switch ($event) {
			
			case 'cptemplatenew'	: 	$this->newcopyTemplate(); 
										break;
								  
			case 'cptemplatesav'	: 	$this->saved = $this->saveTemplate(); 
										$this->newcopyTemplate();	//load
										break;		
									 
			case 'cppreviewcamp'   	: 	break;
			case 'cpcampcontent'   	: 	die($this->preview_campaign());
										break;							 
			 
			case 'cpsubloadhtmlmail': 	if ($this->iscollection>0) {
											if (!empty($_POST['colsort'])) { 
												$slist = implode(',', $_POST['colsort']);	
												_m("rccollections.saveSortedlist use " . $slist);
											}
										
											$this->loadTemplate2(); 	
										}										
										else
											$this->loadTemplate();
									  
										if ($this->ulistselect = GetReq('ulistselect')) 
											SetSessionParam('ulistselect', $this->ulistselect); 
										break;
	  
			case 'cpiscontent'    	: 	die($this->is_content()); //ajax check content						  
									  
			case 'cpstartcamp'   	:	die($this->sendit(true));//ajax based cpsubsend								  
									
			case "cpsubsend"      	:	$this->sendOk = $this->send_mails();
										SetSessionParam('messages',$this->messages);
										$this->load_campaign();
										//$this->javascript(); dont allow second push
										break; 									 
			
	        case 'cpsavemailadv'  	:	$this->save_campaign();
										SetSessionParam('messages',$this->messages); //save messages
										$this->javascript(); 
										break;
									
			case 'cppausecamp'    	: 	$this->pause_campaign(); 
										$this->load_campaign(true);
										$this->javascript(); 			
										break;
									
			case 'cpstopcamp'     	: 	$this->stop_campaign(); 
										$this->load_campaign(true);
										$this->javascript();			
										break;
									
			case 'cpcontinuecamp' 	: 	$this->continue_campaign(); 
										$this->load_campaign(true);
										$this->javascript(); 			
										break;	

	        case 'cpdeletecamp'   	: 	$this->delete_campaign();
										$this->load_campaign(true);
										$this->javascript(); 
										break;								
									
	        case 'cpviewcamp'     	: 	$this->load_campaign(true);
										$this->javascript(); 
										break;				
														
			case 'cpbulkmail'     	:
			default               	:	if ($this->template) {
											//also when returns in cp and template is selected
											if ($this->iscollection>0)
												$this->loadTemplate2(); //subtemp						  
											else
												$this->loadTemplate();						  
										}									
        }			
			
    }	

    public function action($action=null)  { 	

        $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;
		
	    switch ($action) {
			
			case 'cptemplatesav'       : 	$out = ($this->saved==true) ? "Saved" : null; 
											break;
			case 'cptemplatenew'       : 	break;
			
			case 'cpiscontent'         : 	break; 
			case 'cpstartcamp'         : 	break; 
			
			case 'cpsubloadhtmlmail'   :
            case 'cpsavemailadv'       :		
			case 'cpsubsend'           :
			case 'cpcampcontent'       : 
            case 'cpdeletecamp'        :
			case 'cppreviewcamp'       : 
			case 'cppausecamp'         : 
			case 'cpstopcamp'          : 
			case 'cpcontinuecamp'      : 		 			
			case 'cpviewcamp'          : 	$out = $this->campaigns_grid(null,140,5,'r', true);  
											break;
			case 'cpbulkmail'          : 
		    default                    : 
		}			
		
        return ($out);
	}
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}
	
	public function isLevelUser($level=6) {
		return ($this->seclevid>=$level ? true : false);
	}	
	
	public function isCrmUser() {
		return ($this->seclevid>=$this->crmLevel ? true : false);
	}		
	
	/*disable settings in form*/
	public function disableSettings() {
		
		$ret = $this->disable_settings ? 'disabled' : null; //form disable
		return ($ret);
	}
	
	protected function domain_exists($email, $record = 'MX'){
		list($user, $domain) = explode('@', $email);
		return checkdnsrr($domain, $record);
	} 

    protected function _checkmail($data) {

        $ret = filter_var($data, FILTER_VALIDATE_EMAIL);
		return ($ret);  
	}
	
	protected function javascript() {	
	    return null; //!!!!!!
		//if ($this->isDemoUser()) return;
		//if (!$this->cid) return;

        if (iniload('JAVASCRIPT')) {   
	        $code = $this->javascript_code();	   	
		    $js = new jscript;
            $js->load_js($code,null,1);   			   
		    unset ($js);
	    }	
	}		
	
	//call from page
	public function javascript_code()  {
		
	    $ajaxurl = seturl("t=");	
		$process = localize('_process',getlocal());
	
		$js = <<<EOF

function startcampaign(subject, from, xcid, bid, isrecur)
{
    var s = $('#subject').val(); 
	var sub = subject ? subject : s;
	
	var f = $('#from').val(); 
	var frm = from ? from : f;
 
	var sbid = $('#bid').val();	
	var xbid = bid ? bid : parseInt(sbid);	
	
	var cid = xcid ? xcid : '{$this->cid}';	
	var to = isrecur ? '' : '&ulist=' + $('#tags_1').val();	
	
	var xc = '{$this->exitCode}';
	var lc = xc.length * -1;
	
	//$('#message_p').html('');
	str = $('#message_p').html();
	if (str.substr(lc) == xc) return; 
	
	$.ajax({
	  url: '{$ajaxurl}cpiscontent&cid='+cid+to,
	  type: 'GET',
	  success:function(datavalid) {		
	    if (datavalid == 1) {	
		
			$('#message_p').html('<img src="images/loading.gif" alt="Processing"> {$process}');
			
			setTimeout(function() { 

			  $.ajax({
				url: '{$ajaxurl}cpstartcamp',
				type: 'POST',
				data: {FormAction: 'cpstartcamp', xcid: cid, bid: xbid, subject: sub, from: frm},
				success:function(postdata) {
					if ((postdata.substr(lc)) == xc) {
						$('#message_p').html(postdata);
					}					
					else {	
						$('#message_p').append(postdata);				
						var nxbid = parseInt(postdata.substr(lc));
						setTimeout(function() { startcampaign(sub, frm, cid, nxbid, 1);},5000);
					}
					//$('#message_p').html('');
				}
			  });
			}, 1000);  
		}
		else {
			$('#message_p').html(datavalid);
		}
	  }
	}); 
}		
EOF;
		return ($js);	
    }		
	
	
	
	protected function campaigns_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 600;
        $rows = $rows ? $rows : 25;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_campaigns', getlocal()); 
		
        $xsSQL = "SELECT * from (select id,timein,ctype,cdate,active,title,ulists,cc,template,collection,owner,cid from mailcamp) o ";		   
		   
		_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|||1");	
		//_m("mygrid.column use grid1+timein|".localize('_date',getlocal())."|5|0|");	   		
		_m("mygrid.column use grid1+cdate|".localize('_date',getlocal())."|5|0|");		
		_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|2|1|");
		//_m("mygrid.column use grid1+cc|".localize('_email',getlocal())."|5|0|");//."cpuliststats.php?t=cpadvsubscribe&cid={cid}".'||');
		_m("mygrid.column use grid1+title|".localize('_subject',getlocal())."|link|15|"."cpbulkmail.php?t=cpviewcamp&cid={cid}".'||'); //."javascript:cid(\"{cid}\");".'||');						
		_m("mygrid.column use grid1+ctype|".localize('_type',getlocal())."|2|1|");		
		//_m("mygrid.column use grid1+ulists|".localize('_LISTNAME',getlocal())."|link|1|"."cpulists.php?t=cpadvsubscribe".'||');
		_m("mygrid.column use grid1+template|".localize('_template',getlocal())."|5|1|");
		//_m("mygrid.column use grid1+collection|".localize('_collection',getlocal())."|5|1|");
		_m("mygrid.column use grid1+owner|".localize('_owner',getlocal())."|5|0|");
		_m("mygrid.column use grid1+cid|".localize('_cid',getlocal())."|5|0|");
		   
		$out = _m("mygrid.grid use grid1+mailcamp+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  
	}		
	
	public function viewUList($exclude_selected=false) {
		$db = GetGlobal('db');
		
		$sSQL = 'select distinct listname from ulists ';		   
		if ($exclude_selected)
			$sSQL .= " where listname <> " . $db->qstr($this->ulistselect);	
		$sSQL .= " ORDER BY listname";	
	    $resultset = $db->Execute($sSQL,2);	

		foreach ($resultset as $n=>$rec) 
			$ret  .= "<option value='".$rec[0]."'>". $rec[0]."</option>" ;	
        
		return ($ret);			
	}		
	
	function show_select_ulist($name, $taction=null, $class=null) {
		$db = GetGlobal('db');
		$selecttitle = localize('_select', getlocal());
			
		$sSQL = 'select distinct listname from ulists ';		   
		$sSQL .= " ORDER BY listname";	

	    $resultset = $db->Execute($sSQL,2);	
	
		$url = ($taction) ? seturl('t='.$taction.'&ulistselect=',null,null,null,null) : 
		                    seturl('t=cpsubloadhtmlmail&ulistselect=',null,null,null,null);
		
	 
		$ret .= "<select name=\"$name\" onChange=\"location=this.options[this.selectedIndex].value\" $class>"; 
		$ret .= "<option value=\"\">$selecttitle</option>";

		foreach ($resultset as $n=>$rec) {
			$selection = ($rec[0] == $this->ulistselect) ? " selected" : null;
			$ret .= "<option value='".$url . $rec[0]."' $selection >". $rec[0]."</option>" ;
        }		
		
		//$ret .= $this->viewUList();		
		$ret .= "</select>";			    	
		       
	    return ($ret);		
	}	

	public function uListSelect() {
		
		$ret = $this->show_select_ulist('myulistselector', null, $this->template_ext, null);
		return ($ret);
	}			
	
	
	protected function show_files($ext=null) {

        if (defined('RCFS_DPC')) {
		   
			$path = $this->templatepath;
			$myext = explode(',',$ext);
			$extensions = is_array($myext) ? $myext : array(0=>".png",1=>".gif",2=>".jpg");
			$ret = null;
		
			if (is_dir($path)) {
				$this->fs= new rcfs($path);
				$ddir = $this->fs->read_directory($path,$extensions); 
			
				if (!empty($ddir)) {
		  
					sort($ddir);
					foreach ($ddir as $i=>$name) {
						$parts = explode(".",$name);
						$title = $parts[0];
						$ret .= "<option value=\"$name\">$title</option>";		
					}	 			    
				}
			}  	   
	    }	  
	    return ($ret);		
	}	
	
	public function viewTemplates() {
		
		$ret = $this->show_files($this->template_ext);
		return ($ret);
	}
	
	protected function show_select_files($name, $taction=null, $ext=null, $class=null) {
		$selecttitle = localize('_select', getlocal());		
		$tmpl = $this->savedname ? $this->savedname :
				(GetReq('stemplate') ? GetReq('stemplate') : GetSessionParam('stemplate'));
	
		$url = ($taction) ? seturl('t='.$taction.'&stemplate=',null,null,null,null) : 
		                    seturl('t=cpsubloadhtmlmail&stemplate=',null,null,null,null);
		
		if (defined('RCFS_DPC')) {
			$path = $this->templatepath;
			$myext = explode(',',$ext);
			$extensions = is_array($myext) ? $myext : array(0=>".png",1=>".gif",2=>".jpg");
			
			if (is_dir($path)) {
		
				$this->fs= new rcfs($path);
				$ddir = $this->fs->read_directory($path,$extensions); 

				if (!empty($ddir)) {
		  
					sort($ddir);	 
					
					$ret .= "<select name=\"$name\" onChange=\"location=this.options[this.selectedIndex].value\" $class>"; 
					$ret .= "<option value=\"$url\">$selecttitle</option>";
					
					foreach ($ddir as $id=>$fname) {
						$parts = explode(".",$fname);
						$title = $parts[0];
						$parts2 = explode(".",$tmpl);
						$template = $parts2[0];
						$selection = ($title == $template) ? " selected" : null;
						
						$ret .= "<option value=\"". $url . $fname. "\"". $selection .">$title</option>";		
					}	
		
					$ret .= "</select>";			    
				}
			}//empty dir
	    }  
		       
	    return ($ret);		
	}

	public function viewTemplateSelect() {
		
		$ret = $this->show_select_files('mytemplate', null, $this->template_ext, null);
		return ($ret);
	}	
	
	public function viewTemplateCopy() {
		
		$ret = $this->show_select_files('mytemplate', 'cptemplatenew', $this->template_ext, null);
		return ($ret);
	}		
	
	public function templateLoaded() {
		
		$tmpl = GetReq('stemplate') ? GetReq('stemplate') : GetSessionParam('stemplate');
		return (str_replace($this->template_ext ,'', $tmpl));
	}	
	
	
	protected function get_mail_body($tmpl=null) {
		$template = $tmpl ? $tmpl : GetReq('stemplate'); 
		$mailbody = null;
		
		if (defined('RCCOLLECTIONS_DPC')) {

		    if ($template) {
				$template_file = $this->templatepath . $template;
				$mailbody = _m("rccollections.create_page use ".$template_file.'+'.$this->templatepath);
			}
			else
				$mailbody = _m("rccollections.create_page");
		}									   
	 
		return ($mailbody);	 
	}		
	
	//subload template including collections
    public function loadData($template) {
		$path = $this->templatepath;	
		$data = null;	
		
		$data = @file_get_contents($path . $template); 			 
		$sub_template = str_replace($this->template_ext,$this->template_subext,$template);
			 
		if (is_readable($path . $sub_template)) { 
		    $sub_data = $this->get_mail_body($sub_template);//<<selected items sub-template !!!!!!!!!!!!!!!!!!!!!!!!
			$data = str_replace('<!--?'.$sub_template.'?-->',$sub_data,$data);	/**changed the subtemplate mask **/	   
		}

		return ($data);		
	}		
	
	//load template including collections
    protected function loadTemplate2() {
		$path = $this->templatepath;
		$template = GetReq('stemplate') ? GetReq('stemplate') : GetSessionParam('stemplate');				
		   
		if (is_readable($path . $template)) {
		    SetSessionParam('stemplate', $template); //save tmpl 
		    $this->mailbody = $this->loadData($template);			
			return true;
		}
		return false;	  			
	}	
	
	protected function loadTemplate() {
		$path = $this->templatepath;
		$template = GetReq('stemplate') ? GetReq('stemplate') : GetSessionParam('stemplate');
		
		if (($template) && (is_readable($path . $template))) {
			SetSessionParam('stemplate', $template); //save tmpl 
			$this->mailbody = @file_get_contents($path . $template); 			
			return true;			
		}	
		return false;
	}	
	
	/*copied or new template design*/
	protected function newcopyTemplate() {
		$path = $this->templatepath;
		$template = $this->savedname ? $this->savedname : GetReq('stemplate');

		if (($template) && (is_readable($path . $template))) {

			$this->newtemplatebody = @file_get_contents($path . $template); 

            //subtemplate loading
			$sub_template = str_replace($this->template_ext, $this->template_subext, $template);
			if (is_readable($path . $sub_template))
				$this->newsubtemplatebody = @file_get_contents($path . $sub_template);
			
			//pattern loading
			$pattern_file = str_replace($this->template_subext, '', $sub_template) . '.pattern.txt';
			if (is_readable($path . $sub_template))
				$this->newpatternbody = @file_get_contents($path . $pattern_file);
			
			return true;			
		}	
		//else (not a selected template -ignore session name when create new template)
		//reset template name
		SetSessionParam('stemplate', '');
		$this->template=null;		
		
		return false;
	}	

	public function renderTemplate() {
		$path = $this->templatepath;
		$template = GetReq('stemplate');
		$file = str_replace($this->template_ext, '', $template) . '.pattern.txt';
		
		if (is_readable($path . $file))  {
			$pf = file($path . $file);
			//search last edited line
			foreach ($pf as $line) {
				if (trim($line)) {
					$joins = explode(',', array_pop($pf)); 
					break;
				}
			}
			//rest lines
			foreach ($pf as $line) {
				$subtemplates .= trim($line);
			}
			$_pattern[0] = explode(',', $subtemplates);
			$_pattern[1] = (array) $joins;
			
			//render pattern
			if (is_array($_pattern)) {
				$pattern = (array) $_pattern[0];
				$join = (array) $_pattern[1];				
				
				//make pseudo-items arrray
				$maxitm = count($pattern);
				for($i=1;$i<=$maxitm;$i++)
					$items[] = array(0=>$i, 1=>'test item title'.$i, 2=>'test decr'.$i, 14=>'http://placehold.it/680x300');
				//print_r($items);
				
				//render
				$out = null;
				$tts = array();
				$gr = array();
				$itms = array();
				$cc = array_chunk($items, count($pattern));//, true);

				foreach ($cc as $i=>$group) {
					foreach ($group as $j=>$child) {
						$tts[] = $this->ct($path . $pattern[$j], $child, true);
						if ($cmd = $join[$j]) {
							switch ($cmd) {
							    case '_break' : $out .= implode('', $tts); break;
								default       : $out .= $this->ct($path . $cmd, $tts, true);		
							} 
							unset($tts);
						}
					}
					$gr[] = (empty($tts)) ? $out : $out . implode('', $tts) ;
					unset($tts);
					$out = null;
				}
			}//has pattern data
		}//has pattern
		
		$subtemplate = str_replace($this->template_ext, $this->template_subext, $template);
		if ($subtemplatedata = @file_get_contents($path . $subtemplate)) {
			
			$itms[] = (!empty($gr)) ? implode('',$gr) : null;
			if (!empty($itms))
				$ret = $this->combine_tokens($subtemplatedata, $itms, true);				
		}	
		else
			$ret = (!empty($gr)) ? implode('',$gr) : null;
						
		$templatedata = @file_get_contents($path . $template);
		$data = ($ret) ? str_replace('<!--?'.$subtemplate.'?-->', $ret, $templatedata) : $templatedata;
					
		if ($data) {				
			$path2save = ($this->isDemoUser()) ? $this->urlpath . '/' : $this->prpath;
			@file_put_contents($path2save . '_pview.html', $data, LOCK_EX);

			$frame = "<iframe src =\"_pview.html\" width=\"100%\" height=\"540px\"><p>Your browser does not support iframes</p></iframe>";    	
			return ($frame);	
		}

		return null;
	}	
	
	protected function saveTemplate() {
		$path = $this->templatepath;
		$template_name = GetParam('tmplname');
		if (!$template_name) return false;
		
		$this->savedname = stristr($template_name, '.html') ? $template_name : $template_name . '.html';
		
		$preghref = '/<a(.*)href="([^"]*)"(.*)>/';
		$pregCallback = function ($m) { 
			if (stristr($m[2], 'phpdac'))	
				return "<a{$m[1]}href=\"{$m[2]}\"{$m[3]}>"; //as is
			else
				return	"<a{$m[1]}href=\"<phpdac>rcbulkmail.encUrl use {$m[2]}+1</phpdac>\"{$m[3]}>";
		};		

		if ($template = GetParam('template_text')) {	

			if ($this->isDemoUser()) 	
				$text = preg_replace_callback($preghref, $pregCallback, $template);
			else 	  
				$text = preg_replace_callback($preghref, $pregCallback, $template);	
		
		    //save pattern
			$pattern_file = str_replace($this->template_ext, '', $this->savedname) . '.pattern.txt';
			if ($pattern = GetParam('pattern_text'))
				$ret = @file_put_contents($path . $pattern_file, $pattern, LOCK_EX);
			
			//save subtemplate
			$subtemplate_file = str_replace($this->template_ext, $this->template_subext, $this->savedname);
			if ($subtemplate = GetParam('subtemplate_text'))
				$ret = @file_put_contents($path . $subtemplate_file, $subtemplate, LOCK_EX);			
		
		    //save template
			if ($template_copy = GetParam('stemplate')) //as stored in html form
				$subtemplate_copy = str_replace($this->template_ext, $this->template_subext, $template_copy);
			
			//in case of copy, replace subtemplate name
			$this->newtemplatebody = str_replace('<!--?'.$subtemplate_copy.'?-->', '<!--?'.$subtemplate_file.'?-->', $text); 
			$ret = @file_put_contents($path . $this->savedname, $this->newtemplatebody, LOCK_EX); 

			return ($ret);			
		}	
		
		return false;
	}		
	
	public function userRealm() {
       $db = GetGlobal('db');	
	
	   if ($UserName) {//???
		    $sSQL = 'select fname from users where username=' . $db->qstr($this->owner);
			$result = $db->Execute($sSQL,2);
			return ($result->fields[0]);
	   }
	   return false;
	}
	
	////build when post a new campaign or fetch existed
	protected function _CID($a=null, $b=null, $c=null) {
		$cid = null;
		
		if ($a && $b && $c) { //build
			$cid = md5($a . '|' . $b .'|'. $c);
		}
		else {
			if ($text = GetParam('mail_text')) //new posted campaign
				$cid = md5($text . '|' . GetParam('subject') .'|'. GetParam('submail'));
			else //existed		
				$cid = $this->cid;	
		}		
		return ($cid);		
	}	
	
	public function isCampaignOwner($id=null) {
		$db = GetGlobal('db');	
		$cid = $id ? $id : $this->cid;
		if (!$cid) return null;	
		
		if ($this->seclevid==9) return true;
		
		$sSQL = 'select id from mailcamp where cid=' . $db->qstr($cid) . ' and owner=' . $db->qstr($this->owner);
		$res = $db->Execute($sSQL,2);
        //echo ($res->fields[0]>0) ? '-owner' : null;
		return ($res->fields[0] ? true : false);
	}	
	
	public function isCampaignActive($id=null) {
		$db = GetGlobal('db');	
		$cid = $id ? $id : $this->cid;
		if (!$cid) return null;	
		
		$sSQL = 'select count(id) from mailqueue where cid=' . $db->qstr($cid) . ' and active=1';
		$res = $db->Execute($sSQL,2);
        //echo ($res->fields[0]>0) ? '-active' : null;
		return ($res->fields[0]>0 ? $res->fields[0] : false);
	}
	
	public function isCampaignPaused($id=null) {
		$db = GetGlobal('db');	
		$cid = $id ? $id : $this->cid;
		if (!$cid) return null;			
		
		$sSQL = 'select count(id) from mailqueue where cid=' . $db->qstr($cid) . ' and active=-8';
		$res = $db->Execute($sSQL,2);
        //echo ($res->fields[0]>0) ? '-paused' : null;
		return ($res->fields[0]>0 ? $res->fields[0] : false);		
	}
	
	public function isCampaignStopped($id=null) {
		$db = GetGlobal('db');	
		$cid = $id ? $id : $this->cid;
		if (!$cid) return null;	

		$sSQL = 'select count(id) from mailqueue where cid=' . $db->qstr($cid) . ' and active=-9';
		$res = $db->Execute($sSQL,2);
        //echo ($res->fields[0]>0) ? '-stopped' : null;
		return ($res->fields[0]>0 ? $res->fields[0] : false);		
	}
	
	public function isCampaignCompleted($id=null) {
		$db = GetGlobal('db');	
		$cid = $id ? $id : $this->cid;
		if (!$cid) return null;		

		$sSQL = 'select count(id) from mailqueue where cid=' . $db->qstr($cid) . ' and active<=-8';
		$res = $db->Execute($sSQL,2);
		
        if (!$res->fields[0]) {
			
			$sSQL2 = 'select count(id) from mailqueue where cid=' . $db->qstr($cid) . ' and active=1';
			$res2 = $db->Execute($sSQL2,2);				
			//echo ($res2->fields[0]>0) ? '-completed' : null;
			return ($res2->fields[0] ? false : true);
		}
				
		return false;
	}		
	
	public function campaignLastRun($id=null) {
		$db = GetGlobal('db');	
		$cid = $id ? $id : $this->cid;
		if (!$cid) return null;		

		$sSQL = 'select timeout from mailqueue where cid=' . $db->qstr($cid) . ' and active=0 order by timeout DESC LIMIT 1';
		$res = $db->Execute($sSQL,2);

		return ($res->fields[0] ? $res->fields[0] : false);		
	}	
	
	public function viewCampaigns() {
		$db = GetGlobal('db');	
		
		//all as 9 user or only owned		
		$ownerSQL = ($this->seclevid==9) ? null : 'owner=' . $db->qstr($this->owner);		
		
		$sSQL = 'select cdate,cid,title,timein from mailcamp where ' . $ownerSQL . ' and ';		   
		if ($text = GetParam('mail_text')) {
			//$cid = md5($text . '|' . GetParam('subject') .'|'. GetParam('submail'));
			$cid = $this->_CID($text, GetParam('subject'), GetParam('submail'));
			$sSQL .= "cid = " . $db->qstr($cid);	
			$sSQL .= GetParam('savecmp') ?  ' and active=1' : null; //temp camps without multiple selection
		}
        else		
			$sSQL .= "active=1";
		$sSQL .= " ORDER BY timein desc";	

	    $resultset = $db->Execute($sSQL,2);	
		foreach ($resultset as $n=>$rec) {
			$selection = ($rec[1] == $cid) ? " selected" : null;
			$ret[] = "<option value='".$rec[1]."' $selection>". $rec[2]."</option>" ;
        }		

		return (implode('',$ret));			
	}	
	
	//ajax use
	protected function is_content() {
        //check expiration key
        //if ($this->appkey->isdefined('RCBULKMAIL')==false) 
	        //return "Failed, module expired."; 

		if (is_readable($this->savehtmlpath .'/'. $this->cid.'.html')) { 						
		
			$res = $this->load_campaign(true); //before start, load campaign once and update new ulists field
			
			return $res ? '1' : 'Failed: Campaign not loaded!'; 
		}	
		 
		return 'Failed: Empty content, file not exist ('. $this->cid . '.html)';			
	}	

	protected function load_campaign($reset=false) {
		$db = GetGlobal('db');		
        if (!$this->cid) return false;
		
		//all as 9 user or only owned		
		$ownerSQL = null;//($this->seclevid==9) ? null : 'owner=' . $db->qstr($this->owner);	
		$cidSQL = $ownerSQL ? 'and cid='.$db->qstr($this->cid) : 'cid='.$db->qstr($this->cid);	

		$sSQL = 'select title,ctype,ulists,cc,bcc,user,pass,server from mailcamp where '. $ownerSQL . $cidSQL;
		$res = $db->Execute($sSQL);
		
		SetParam('subject', $res->fields[0]); //make it global to used be html form
		
		//SetParam('bid', $res->fields[1]); //saved bid
		$this->batchid = $res->fields[1]; //saved bid only in 1st time of re-post (semi-executed posts)
		
		SetParam('ulists', $res->fields[2]); //ulists
		SetParam('from', $res->fields[3]); // from cc
		SetParam('bcc', $res->fields[4]); // ulist copy after send
			
		//make it global to used be html form (hide default settings)
		if ($res->fields[5]!=$this->mailuser) SetParam('user', $res->fields[5]); //alternative mail user
		if ($res->fields[6]!=$this->mailpass) SetParam('pass', $res->fields[6]); //alternative mail pass
		if ($res->fields[7]!=$this->mailserver) SetParam('server', $res->fields[7]); //alternative mail server
		
		//fetch user realm from users
		$realm = $this->userRealm();		
		$m_realm = $realm ? $realm : $this->mailname; 
		SetParam('realm', $m_realm);
		
		if ($reset) {
			if ($ulist = GetReq('ulist')) { //re-post (ajax call, is_content check - first call)
		
				$sSQL = 'update mailcamp set ulists=' . $db->qstr($ulist);
				$sSQL .= ' where '. $ownerSQL . $cidSQL;	
				$resultset = $db->Execute($sSQL);
				$this->messages[] = $sSQL;	

				SetParam('include', $ulist);
			}
			else
				SetParam('include', $res->fields[2]);
		}	
		else {	
			$ul = strstr($res->fields[2], ',') ? explode(',',$res->fields[2]) : array([0]=>$res->fields[2]);
			$this->messages[] = $this->_checkmail($ul[0]) ? 
			                    $ul[0] . ' ' . localize('_instantmail', getlocal())  : 
								$ul[0] . ' ' . localize('_instantmail', getlocal()) ;
		}		

		
		if ($timeout = $this->campaignLastRun()) {
			if ($this->isCampaignActive())
				$this->messages[] = localize('_activecamp', getlocal());		
			elseif ($this->isCampaignPaused())
				$this->messages[] = localize('_pausecamp', getlocal());
			elseif ($this->isCampaignStopped())
				$this->messages[] = localize('_stopcamp', getlocal());				
			elseif ($this->isCampaignCompleted())
				$this->messages[] = localize('_completecamp', getlocal());				
			
			$this->messages[] = localize('_lastrun', getlocal()) . ' ' . $timeout;
		}	
		else	
		    $this->messages[] = localize('_neverrun', getlocal());
	   
		return ($res->fields[0]); //one rec
	}
	
	public function instanceCamp($template=null, $limit=null) {
		if (!$cid = $_GET['cid']) return false;
		$db = GetGlobal('db');			
		$l = $limit ? $limit : 5;
		$t = ($template!=null) ? _m("cmsrt.select_template use $template+1") : null;
		$tokens = array();
		
		$sSQL = "SELECT cid,subject, AVG(active),MIN(timein),MAX(timeout) AS a FROM mailqueue where active>=0 and cid='{$this->cid}' GROUP BY subject ORDER BY a DESC LIMIT ".$l;
		$resultset = $db->Execute($sSQL,2);
		//echo $sSQL;
		foreach ($resultset as $n=>$rec) {
			if ($t) {
				$tokens[] = $rec[0];
				$tokens[] = $rec[1];
				$tokens[] = (100-intval($rec[2]*100));
				$tokens[] = $rec[3];
				$tokens[] = $rec[4];						
				$ret .= $this->combine_tokens($t, $tokens);
				unset($tokens);
			}
		}

		return ($ret);	
	}

	public function controlCamp($ajax=null) {
		$newcamp = localize('_newcamp', getlocal());		
		$submit = $ajax ? "onClick='startcampaign()'" : "type='submit'";
		
		if ($this->cid) {
			
			$start = localize('_start', getlocal());
			$stop = localize('_cancel', getlocal());
			$pause = localize('_pause', getlocal());
			$continue = localize('_continue', getlocal());
			$end = localize('_end', getlocal());
			$delete = localize('_delete', getlocal());
			
			if (!$this->isCampaignOwner()) return false;
		
		    $complete = $this->isCampaignCompleted();
			$paused = $this->isCampaignPaused();
			$active = $this->isCampaignActive();
			$lastrun = $this->campaignLastRun();
		
			if (!$active) {
				if ($ajax)
					$ret = "<button onClick='startcampaign()' class='btn btn-danger'>$start</button>&nbsp;" ;
				else	
					$ret = $this->sendOK ?	"<button type=\"submit\" class=\"btn btn-success\">$start</button>&nbsp;" : 
											"<button type=\"submit\" class=\"btn btn-danger\">$start</button>&nbsp;" ;
		    }
			if (($lastrun) && (!$complete)) {
		
				$ret .= ($paused) ? "<a href=\"cpbulkmail.php?t=cpcontinuecamp&cid={$this->cid}\" class=\"btn btn-success\">$continue</a>&nbsp;" :
								   "<a href=\"cpbulkmail.php?t=cppausecamp&cid={$this->cid}\" class=\"btn btn-danger\">$pause</a>&nbsp;";
												  
				if (($active) || ($paused))
					$ret .= "<a href=\"cpbulkmail.php?t=cpstopcamp&cid={$this->cid}\" class=\"btn btn-danger\">$stop</a>&nbsp;";
			}
			
			if (!$complete)
				$ret .= "<a href=\"cpbulkmail.php?t=cpdeletecamp&cid={$this->cid}\" class=\"btn btn-danger\">$delete</a>&nbsp;";
		}
		
		$ret .= "<a href=\"cpbulkmail.php\" class=\"btn btn-success\">$newcamp</a>&nbsp;";		

		return ($ret);	
	}	
	
	protected function preview_campaign() {
		$db = GetGlobal('db');	
        if (!$this->cid) return false; //die("CID error");
		
		//all as 9 user or only owned		
		$ownerSQL = null;//($this->seclevid==9) ? null : 'owner=' . $db->qstr($this->owner);
        $cidSQL = $ownerSQL ? 'and cid='.$db->qstr($this->cid) : 'cid='.$db->qstr($this->cid);	
		
		$sSQL = 'select body from mailcamp where '. $ownerSQL . $cidSQL;
        //echo $sSQL;		
		
		$result = $db->Execute($sSQL,2);
		$text = base64_decode($result->fields[0]); 
		
		return ($text);
	}
	
	/* to be deleted permanetly, delete messages from mailqueue */
	protected function delete_campaign() {
		$db = GetGlobal('db');	
        if (!$this->cid) return false; //die("CID error");
		
		if ($this->isDemoUser()) {
			$this->messages[] = "Campaign NOT deleted (demo user).";
			return true;
		}	
		
		//all as 9 user or only owned		
		$ownerSQL = ($this->seclevid==9) ? null : 'owner=' . $db->qstr($this->owner);
        $cidSQL = $ownerSQL ? 'and cid='.$db->qstr($this->cid) : 'cid='.$db->qstr($this->cid);	
		
		$sSQL = 'update mailcamp set active=0 where '. $ownerSQL . $cidSQL;
		$resultset = $db->Execute($sSQL,1);
		
		if ($db->Affected_Rows()) {
			//stop sending mesages if it is active
			$this->stop_campaign();
			
			$this->messages[] = localize('_delcamp', getlocal());
			return true;
		}	
		
		return false;
	}	
	
	protected function pause_campaign() {
		$db = GetGlobal('db');	
        if (!$this->cid) return false; 
		
		if ($this->isDemoUser()) {
			$this->messages[] = "Campaign NOT paused (demo user).";
			return true;
		}	
		
		//all as 9 user or only owned		
		$ownerSQL = ($this->seclevid==9) ? null : ' and owner=' . $db->qstr($this->owner);
        $cidSQL = 'and cid='. $db->qstr($this->cid);	
		
		$sSQL = 'update mailqueue set active=-8,mailstatus='.$db->qstr('PAUSE'). 
		        ' where active=1 '. $ownerSQL . $cidSQL;
		$resultset = $db->Execute($sSQL,1);

		if ($db->Affected_Rows()) {
			$this->messages[] = localize('_pausecamp', getlocal());
			return true;
		}	
		
		return false;
	}	
	
	protected function continue_campaign() {
		$db = GetGlobal('db');	
        if (!$this->cid) return false; 
		
		if ($this->isDemoUser()) {
			$this->messages[] = "Campaign NOT paused (demo user).";
			return true;
		}	
		
		//all as 9 user or only owned		
		$ownerSQL = ($this->seclevid==9) ? null : ' and owner=' . $db->qstr($this->owner);
        $cidSQL = 'and cid='. $db->qstr($this->cid);	
		
		$sSQL = "update mailqueue set active=1,mailstatus=''". 
		        ' where active=-8 '. $ownerSQL . $cidSQL;
		$resultset = $db->Execute($sSQL,1);
		
		if ($db->Affected_Rows()) {
			$this->messages[] = localize('_unpausecamp', getlocal());
			return true;
		}	
		
		return false;
	}		
	
	protected function stop_campaign() {
		$db = GetGlobal('db');	
        if (!$this->cid) return false; 
		
		if ($this->isDemoUser()) {
			$this->messages[] = "Campaign NOT stoped (demo user).";
			return true;
		}	
		
		//all as 9 user or only owned		
		$ownerSQL = ($this->seclevid==9) ? null : ' and owner=' . $db->qstr($this->owner);
        $cidSQL = 'and cid='. $db->qstr($this->cid);	
		
		$sSQL = 'update mailqueue set active=-9,mailstatus='.$db->qstr('STOP'). 
		        ' where (active=1 or active=-8) '. $ownerSQL . $cidSQL;
		$resultset = $db->Execute($sSQL,1);
		
		if ($db->Affected_Rows()) {
			$this->messages[] = localize('_stopcamp', getlocal());
			return true;
		}	
		
		return false;
	}		
	
    /*type : 0 save text as mail body /1 save collections as text to reproduce (offers, katalogs) */	
    protected function save_campaign($type=null) {
        $db = GetGlobal('db'); 	
		$rtokens= null;
		$ctype = $type ? $type : 0;
		$r = rand(000001, 999999);
				
        $cc = GetParam('from'); //from origin		
		$to = GetParam('submail'); //to origin
		
		$bcc = null;//$this->getmails($to, true); //fetch mails plus 'to' origin //DISABLED
		$ulists = $this->getmails($to, false, ',');
		if (!$ulists) {
			$this->messages[] = 'Campaign NOT saved (no receipients)';
			return false;
		}	
		SetParam('include',$ulists); //used by form
		
		$m_user = GetParam('user') ? GetParam('user') : $this->mailuser; //user origin
		$m_pass = GetParam('pass') ? GetParam('pass') : $this->mailpass;//pass origin
		$m_server = GetParam('server') ? GetParam('server') : $this->mailserver; //server origin
		//make it global to used be html form (hide default settings)
		if ($m_user!=$this->mailuser) SetParam('user', $m_user); 
		if ($m_pass!=$this->mailpass) SetParam('pass', $m_pass);
		if ($m_server!=$this->mailserver) SetParam('server', $m_server);
        //fetch user realm from users
        $realm = $this->userRealm();		
		$m_realm = $realm ? $realm : $this->mailname; 
		SetParam('realm', $m_realm);
		
		$body = GetParam('mail_text');
		$title = GetParam('subject') ? GetParam('subject') : 'Campaign ' . $r;
		
		$date = date('Y-m-d H:m:s');
		//$cid = md5($body .'|'. $title .'|'. $to);
		$cid = $this->_CID($body, $title, $to);
        $active = GetParam('savecmp') ? 1 : 0;	
		
		//weblink token 10 (0..9 token reserved frontpage.process_html_file)
		if ($viewashtml = GetParam('webviewlink')) {
			$pageurl = $this->webview ? $this->encUrl($this->savehtmlurl):
										$this->encUrl($this->savehtmlurl . $cid . '.html');
			$plink = "<a href='$pageurl'>".localize('_here',getlocal())."</a>";	
			
			$text = str_replace('_WEBLINK_',$plink, GetParam('webviewtext'));	//replace special words		
			$rtext = $this->add_remarks_to_hide($text); //add remark to easilly remove 
			//if use tokens place at atoken
			if ($hastokens = GetParam('usetokens')) 
				$rtokens[10] = $this->add_remarks_to_hide($text); 
			else  //else at end of body
				$body = str_replace('</body>',$rtext .'</body>', $body);							   	
		}
		else
			$rtokens[10] = ''; //dummy token to replace if $0$ exist in page
		
		//unsub link token 11 (0..9 token reserved frontpage.process_html_file)
		if ($unsublink = GetParam('unsubscribelink')) {
			$unlink = "<a href=\"" . $this->encUrl($this->url . '/unsubscribe/_SUBSCRIBER_/') ."\">".localize('_here',getlocal())."</a>";			
			
			$text = str_replace(array('_UNSUBSCRIBE_','_MAILSENDER_'),array($unlink, $cc), GetParam('unsubscribetext'));			
			$rtext = $this->add_remarks_to_hide($text);
			//if use tokens place at atoken
			if ($hastokens = GetParam('usetokens'))
				$rtokens[11] = $this->add_remarks_to_hide($text);
			else //else at end of body
				$body = str_replace('</body>',$rtext .'</body>', $body);		
		}
		else
			$rtokens[11] = ''; //dummy token to replace if $1$ exist in page

		$body =  $this->combine_tokens($body, $rtokens); //in case of tokens	
		
		
		if (defined('RCCOLLECTIONS_DPC')) 
			$collection = GetGlobal('controller')->calldpc_var("rccollections.savedlist");
		else
			$collection = '';	
  
        $sSQL = "insert into mailcamp (cid,ctype,cdate,active,title,ulists,cc,bcc,template,body,collection,owner,user,pass,name,server) values (";
	    $sSQL .= $db->qstr($cid).",".
		         $ctype .",". 
				 $db->qstr($date).",$active,".
	             $db->qstr($title).",".
				 $db->qstr($ulists).",".
				 $db->qstr($cc).",".
				 $db->qstr($bcc).",".
				 $db->qstr($this->template).",".
				 $db->qstr(base64_encode($body)).",".
				 $db->qstr($collection).",".
				 $db->qstr($this->owner).",".
				 $db->qstr($m_user).",".
				 $db->qstr($m_pass).",".
				 $db->qstr($m_realm).",".
				 $db->qstr($m_server).				 
				 ")"; 
        //echo $sSQL;
		$result = $db->Execute($sSQL,1);
		
		if ($db->Affected_Rows()) {
			$this->messages[] = $active ? 'Campaign stored' : 'Campaign is temporary';
			
			//save the file
			if ($p = $this->savehtmlpath) {
				$s = @file_put_contents($p .'/'. $cid . '.html' , $body, LOCK_EX);	
				
				if ($s) 
					$this->messages[] = 'Saved as ' . $cid . '.html';
				else
					$this->messages[] = $cid . '.html NOT saved!';				
			}
			
			//reset campaign
			SetSessionParam('stemplate', '');
			$this->template=null;
			SetSessionParam('ulistselect', '');
			$this->mailbody = null;
			
			$this->cid = $cid; //hold cid in form after submit
			
			return (true);		
		}
		
		$this->messages[] = 'Campaign NOT saved';
		
		return (false);		
	}
	
	public function getCmpMails($option=null) {
        $db = GetGlobal('db'); 
		
		$cid = $this->_CID(GetParam('mail_text'), GetParam('subject'), GetParam('submail'));
		
		//all as 9 user or only owned		
		$ownerSQL = ($this->seclevid==9) ? null : 'owner=' . $db->qstr($this->owner);
        $cidSQL = $ownerSQL ? 'and cid='.$db->qstr($cid) : 'cid='.$db->qstr($cid);			
		
		$sSQL = 'select ulists from mailcamp where '. $ownerSQL . $cidSQL;
		$res = $db->Execute($sSQL);

		$c = $res->fields[0];
		$list = strstr($c, ',') ? explode(',',$c) : array(0=>$c);
		foreach ($list as $m)
			$oret[] = $option ? "<option value='".$m."'>". $m."</option>" : $m;
        		
		if (is_array($oret))
			$ret = $option ? implode('',$oret) : implode(',',$oret);
		
		return ($ret);		
	}	
	
	protected function count_maillist($listname=null) {
		$db = GetGlobal('db');	
		$ulistname = $listname ? $listname : 'default';

		$sSQL = "select count(email) from ulists where active=1 and listname=" . $db->qstr($ulistname);
		$result = $db->Execute($sSQL,2);
		$ret = $result->fields[0] ? $result->fields[0] : 0;
		
		return ($ret);
	}
	
	protected function get_mails_from_lists($listname=null, $retarray=false, $limit=null, $start=null) {
		$db = GetGlobal('db');	
		$ulistname = $listname ? $listname : 'default';
		$out = null; 
	   
		$sSQL = "SELECT email FROM ulists where active=1 and listname=" . $db->qstr($ulistname); 
		$sSQL.= (isset($start)) ? ($limit ? " LIMIT " . $start . "," . $limit : ($limit ? " LIMIT " . $limit : null)) : null;
		//echo $sSQL;
		//$this->messages[] = $sSQL;	
		$result = $db->Execute($sSQL,2);
	   
		if (count($result)>0) {		   
			foreach ($result as $n=>$rec) {
				//MUST ALWAYS RETURN BATCH AS WHOLE, iF IT IS REDUCED BATCH WILL STOPPED
				/*if ($m = $this->checkmail(trim($rec['email']))) 		 
					$ret[] = trim($m);*/
				$ret[] = $rec['email'];
			}
			
			if (!empty($ret)) {  
				if ($retarray)
					return (array_unique($ret));
				else		
					return (implode(';',$ret));
			}			
		}

		return false;		   
	}
	
	
	protected function checkmail($mail=null) {
		if (!$mail) return false;
		
		if ($this->_checkmail($mail))
			return ($mail);
		else 
			$this->messages[] = 'Invalid mail address ('. $mail .')';
		
		return false;	
	}
	
	public function viewMessages($template=null) {
		if (empty($this->messages)) return;
	    $t = ($template!=null) ? _m("cmsrt.select_template use $template+1") : null;
		
		foreach ($this->messages as $m=>$message) {
			if ($t) 	
				$ret .= $this->combine_tokens($t, array(0=>$message));
			else
				$ret .= "<option value=\"$m\">$message</option>";
		}
		return ($ret);
	}

	protected function csvTrim($mail=null) {
		$ret = str_replace(array("\r\n", "\r", "\n", " "), array("","","",""), $mail);
		return $ret;
	}
	
	
	//demo user allow 3max csv list
	protected function getmails($mail=null, $fetchlist=false, $sep=null) {
        $db = GetGlobal('db');	
		$this->messages[] = 'Get mails...'; 
		$ret = null;
		$_s = $sep ? $sep : ';';
		
		$mails = $mail ? $mail : null;
		
		/*csv addons */
		if ($csvlist = $_POST['csv']) { 
		    $this->messages[] = 'Call csv mail list '; 
			
		    $m = explode(',', $csvlist); //comma sep value
			if (is_array($m)) {
				
			  if ($this->isDemoUser())  { //demo user
			    $max = (count($m)<2) ? count($m) : 2; //max 3 addresess (2csv+'to')
				for ($i=0;$i<$max;$i++) { 
					$tcsvMail = $this->csvTrim($m[$i]);
                    if ($ml = $this->checkmail($tcsvMail)) 					
						$mails .= $_s . $ml;
				}	
			  }
			  else {	
				foreach ($m as $csvmail) {
					$tcsvMail = $this->csvTrim($csvmail);
                    if ($ml = $this->checkmail($tcsvMail)) 					
						$mails .= $_s . $ml;
				}	
              }				
			}
			else {  //one address
				$tcsvList = $this->csvTrim($csvlist); 
			    $ml = $this->checkmail($tcsvList);	
				$mails .= $ml  ? $_s . $tcsvList : '';
			}			
		}		
		
		/*combo with reload func*/
	    if ((!$this->isDemoUser()) && ($selectedlist = $_POST['myulistselector'])) {
			$this->messages[] = 'Call mail list ' . $this->ulistselect;
			
			$_ulistselect = $fetchlist ? $this->get_mails_from_lists($this->ulistselect) : $this->ulistselect; //just the name
			$mails .= $_s .  $_ulistselect; 	   
		}	
		
		/*multiple combo as alternatives */
		if ((!$this->isDemoUser()) && ($altlist = $_POST['ulistname'])) {
			if (is_array($altlist)) {
				$lm = null;
				foreach ($altlist as $i=>$list) {
				   $this->messages[] = 'Call mail list ' . $list; 	
				   $_list = $fetchlist ? $this->get_mails_from_lists($list) : $list; //just the name
				   $lm .= $_s . $_list;
				}   
				$mails .= $lm;
			}
			else {
				$this->messages[] = 'Call mail list ' . $altlist; 
				$_list = $fetchlist ? $this->get_mails_from_lists($altlist) : $altlist; //just the name
				$mails .= $_s . $_list;			
			}	
		}
	   
	    /*app users checkbox (todo, make ulist)*/
	    if ((!$this->isDemoUser()) && ($users = $_POST['siteusers'])) {		
			$seclevid = 1;
			$this->messages[] = 'Call user mail list ' . $seclevid;			
			 
			$sSQL .="SELECT email FROM users where";	
			$sSQL .= " seclevid=" . $seclevid; //1 SEC LEVEL USERS
		    $sSQL .= " and notes='ACTIVE'";	//NOT THE INACTIVE USERS   

			$result = $db->Execute($sSQL,2);	
	   
			if ($db->Affected_Rows()>0) {		   
				foreach ($result as $n=>$rec) {
                    if ($m = $this->checkmail(trim($rec[0]))) 					
						$ret[] = $m;
				}
			} 
			if (!empty($ret)) {  
				$mails .= $_s . implode($_s,$ret); 
			}
	    }
		
	    /*app customers checkbox (todo, make ulist)*/
	    if ((!$this->isDemoUser()) &&($users = $_POST['sitecusts'])) {
		
			$this->messages[] = 'Call customers mail list ';			
			  
			$sSQL .="SELECT mail FROM customers ";	 
			$result = $db->Execute($sSQL,2);
	   
			if ($db->Affected_Rows()>0) {		   
				foreach ($result as $n=>$rec) {
                    if ($m = $this->checkmail(trim($rec[0]))) 					
						$ret[] = $m;
				}
			}
			if (!empty($ret)) {  
				$mails .= $_s . implode($_s,$ret); 
			}
	    }
		
		if ($mails) {
			$mcsv = explode($_s, str_replace($_s . $_s, $_s, $mails)); //clean ;;->;
			//print_r($mcsv);
			//some clean
			foreach ($mcsv as $i=>$m)
				if ($m) $subs[] = $m;
				
			$uret = array_unique($subs);
			$this->messages[] = 'Extract duplicate mails';
			$ret = implode($_s, $uret);
		}	

	    return $ret;	
	}			
	
	/*on resend or batch send */
	protected function nextbatch($xcid=null, $step=0, $ulist=null, $segment=null, $counter=0) {
		$db = GetGlobal('db');		
		$cid = $xcid ? $xcid : $this->cid;
        if (!$cid) return false;
		
		//all as 9 user or only owned		
		$ownerSQL = ($this->seclevid==9) ? null : 'owner=' . $db->qstr($this->owner);	
		$cidSQL = $ownerSQL ? 'and cid='.$db->qstr($this->cid) : 'cid='.$db->qstr($this->cid);	
		
		$sSQL = 'update mailcamp set ctype=' . $step; //enable by updat if not enabled
		if (($ulist) && ($segment)) {//email or ulist
			//remove tag from ulists and move to bcc
			$sSQL .= ", ulists= REPLACE(ulists, " . $db->qstr($segment) . ", '')" ;
			$sSQL .= ", bcc=CONCAT_WS(',', bcc, " . $db->qstr($segment) . ")" ;
		}
		$sSQL .= ' where '. $ownerSQL . $cidSQL;
        //echo $sSQL;		
		
		$resultset = $db->Execute($sSQL);

		$restToProceed = $this->maxinpvars;// - $counter; //maxinpvars is modified (MAXINPVARS MUST BE STORED IN AJAX LOOP!!!!)
		
		return array(0=>0,1=>0,2=>$restToProceed);
	}	
	
	protected function isPostFinished() {
		$db = GetGlobal('db');	
		
		$sSQL = 'select ulists from mailcamp where cid=' . $db->qstr($this->cid); 
		$res = $db->Execute($sSQL);
		
		$f = str_replace(',','',$res->fields[0]);
		//echo $f,':',$res->fields[0];
		
		$ret = (trim($f)!='') ? false : true;
		return ($ret);
	}
	
	protected function send_mails() {	  
        //check expiration key
        if ($this->appkey->isdefined('RCBULKMAIL')==false) {
	        //$this->messages[] = "Failed, module expired.";
		    //return false;  //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< appkey --------------------------!!
	    }
		
		if (is_readable($this->savehtmlpath .'/'. $this->cid.'.html')) {
							
			$res = $this->sendit();					
			return ($res); 
		}
		else 
			$this->messages[] = 'Failed: Empty content, file not exist ('. $this->cid . '.html)';			
		
	    return false;   
	}	
	
	protected function sendit($ajax=null) {	
		$db = GetGlobal('db');
		$optSQL = null;	
		$cid = $this->cid;
		
		if (!$cid) { 
			$this->messages[] = 'CID form error!';
			return ($ajax) ? 'CID form error!' : false;		
        }
		
		$mail_text = @file_get_contents($this->savehtmlpath .'/'. $cid.'.html');
		
		$mailuser = GetParam('user') ? GetParam('user') : $this->mailuser;
		$mailpass = GetParam('pass') ? GetParam('pass') : $this->mailpass;
		$mailserver = GetParam('server') ? GetParam('server') : $this->mailserver;
		$mailname = GetParam('realm') ? GetParam('realm') : $this->mailname; //a per user submit (realm)
		
		$from = GetParam('from') ? GetParam('from') : $mailuser; //replace sender when another server settings ? 
		if (!$from) {
			$this->messages[] = 'From field missing!';
			return ($ajax) ? 'From field missing! '.$this->exitCode : false;
		}	
		
		if (!$subject = GetParam('subject')) {
			$this->messages[] = 'Subject field missing!';
			return ($ajax) ? 'Subject field missing! '.$this->exitCode : false;
		}			
		
		if (!$inc = GetParam('include')) {
			$sSQL = 'select ulists from mailcamp where cid=' . $db->qstr($cid);
			$result = $db->Execute($sSQL);
			if (!$inc = $result->fields[0]) {
				$this->messages[] = "No recipients, e-mail distribution completed!";
				return ($ajax) ? "No recipients! ".$this->exitCode : false;
			}
			//else $this->messages[] = 'Load ulists from db:'.$inc;
		}
		//else $this->messages[] = 'Load ulists:'.$inc;
			
		//echo $inc;
		//clean to, from remaing commas
		for ($i=0;$i<strlen($inc);$i++) 
			$to = (substr($inc,0,1)==',') ? substr($inc, 1) : $inc;
		$cc = $to ? (strstr($to ,',') ? explode(',', $inc) : array(0=>$to)) : null; //ulist csv text or one element
        //echo $to; print_r($cc);
		
		$i = 0;
		$meter = 0;
		$sum = ($this->batchid * $this->maxinpvars); //hold prev sends sum
        $index = $this->batchid * $this->maxinpvars;
		$this->messages[] = 'Index:' . $this->batchid .",".$this->maxinpvars.",".$index ;//."<br>post:" . implode('-',$_POST);
		
		if ($cc) {	
	
			set_time_limit(120); 
		
			foreach ($cc as $z=>$m) {
				
				if (!$m) continue;
		
				if ($ismail = filter_var($m, FILTER_VALIDATE_EMAIL)) {
		 									
					$text = str_replace('_SUBSCRIBER_', $m, $mail_text); 	
					$meter += ($z<1) ?  $this->sendmail_instant($from,$m,$subject,$text,$this->ishtml,$mailuser,$mailpass,$mailname,$mailserver) :
										$this->sendmail_inqueue($from,$m,$subject,$text,$this->ishtml,$mailuser,$mailpass,$mailname,$mailserver);
					$i+=1; 				
					
					list($this->batchid, $index, $this->maxinpvars) = $this->nextbatch($cid ,$this->batchid, $to, $m, $i);		
				}
				else {//list name
				
					$mails = $this->get_mails_from_lists($m, true, $this->maxinpvars, $index);
					//$this->messages[] = $m .': '.count($mails);
					
					if (!empty($mails)) {
						foreach ($mails as $z1=>$m1) {	
                            
							$text = str_replace('_SUBSCRIBER_', $m1, $mail_text); 	
							if ($this->_OPT) //ERROR see below
								$optSQL .= $this->sendmail_inqueue_opt($from,$m1,$subject,$text,$this->ishtml,$mailuser,$mailpass,$mailname,$mailserver);								
							else
								$meter += $this->sendmail_inqueue($from,$m1,$subject,$text,$this->ishtml,$mailuser,$mailpass,$mailname,$mailserver);								
							$i+=1; 
						}
						
					    //if ($this->maxinpvars==count($mails)) { 
						if ($i >= $this->maxinpvars) {
							$i = 0;
							$this->batchid += 1;
							$this->nextbatch($cid ,$this->batchid); //set only the batchid
							//$this->messages[] = 'Stop:'.$m.' Bid:'.$this->batchid. ' List length:'.(count($mails) * $this->batchid);
							break 1;
							
						}//if not a full set page
						else //next tag
							list($this->batchid, $index, $this->maxinpvars) = $this->nextbatch($cid ,$this->batchid, $to, $m, $i); 
					}//has mails
					else //next tag
						list($this->batchid, $index, $this->maxinpvars) = $this->nextbatch($cid ,$this->batchid, $to, $m, $i);			
				}
			}	
			
			set_time_limit(ini_get('max_execution_time'));	//return to default			
					
		} 
		else {
			$this->messages[] =  'Send failed: NO receipients (cc)';
			//$this->batchid = -1;
			return ($ajax) ? 'Send failed: NO receipients (cc) '.$this->exitCode : false;
		}	
		
		if ($optSQL) {
			$optimizeSQL = "insert into mailqueue (timein,active,sender,receiver,subject,body,altbody,cc,bcc,ishtml,encoding,origin,user,pass,name,server,trackid,cid,owner) values ";
			$runSQL = $optimizeSQL . $optSQL;
			//$s = @file_put_contents($this->savehtmlpath .'/sql-'. $cid . '.txt' , $runSQL, LOCK_EX);
			$result = $db->Execute($runSQL);
			$af = $db->Affected_Rows();  
			$this->messages[] = $af . ' records added in mail queue.'.$s;
			//ERROR : Allowed memory size of 268435456 bytes exhausted (tried to allocate 79088397 bytes) in /home/stereobi/public_html/cp/dpc/system/extensions/adodb/adodb.ext.php on line 1233	
		}	
		
		if ($this->isPostFinished()) {

			$this->messages[] = ($sum + $meter) . ' '.localize('_saybatchtotal', getlocal());
			
			$this->nextbatch($cid ,0); //set only the batchid - reset = 0
			$this->batchid = intval($this->exitCode);//-1; 		
        }			
		else
			$this->messages[] = ($sum + $meter) . ' '.localize('_saybatch', getlocal()) . ' ('.$this->batchid.')';		
			
		
		$ret = implode('<br/>',$this->messages) .' '. sprintf('%+04d',$this->batchid); //exitcode length !!!
		return ($ret);			 
    }	
	
	//send mail to db queue optimized
	protected function sendmail_inqueue_opt($from,$to,$subject,$mail_text='',$is_html=false,$user=null,$pass=null,$name=null,$server=null) {
		$db = GetGlobal('db');		
		$ishtml = $is_html?$is_html:0;
		$altbody = null;
		$origin = $this->prpath; 
		$encoding = $this->overwrite_encoding ? $this->overwrite_encoding : $this->encoding;
		$datetime = date('Y-m-d h:s:m');
		$active = 1;		
		$cid = $this->cid; 
		
		//test
		//$this->messages[] = $to;
		return true; //test ..ADO MEM ERROR
	   
		//tracking var
		if ($this->trackmail) {
	     		 
			$trackid = $this->get_trackid($from,$to);
		 
			if (!$ishtml) {
				$ishtml = 1;
				$html_mail_text = '<html><body>' . $mail_text . '</body></html>';
				$body = $this->add_tracker_to_mailbody($html_mail_text,$trackid,$to,$ishtml);
			}
			else //already html body ...leave it as is		 
				$body = $this->add_tracker_to_mailbody($mail_text,$trackid,$to,$ishtml);

			$body = $this->add_urltracker_to_mailbody($body,$to,$cid);			
		}
		else {
			$body = $mail_text;	   
			$trackid = '';
		}	 
	    
		$sSQL =  " (" .
			 $db->qstr($datetime) . "," . $active . "," . $db->qstr(strtolower($from)) . "," . $db->qstr(strtolower($to)) . "," .
		     $db->qstr($subject) . "," .  $db->qstr($body) . "," . $db->qstr($altbody) . "," . $db->qstr($ccs) . "," .
			 $db->qstr($bccs) . "," . $ishtml . "," . $db->qstr($encoding) . "," . $db->qstr($origin) . "," . $db->qstr($user) . "," .
			 $db->qstr($pass) .	"," . $db->qstr($name) . "," . $db->qstr($server) . "," . $db->qstr($trackid) . "," .
			 $db->qstr($cid) . "," . $db->qstr($this->owner) . "),";  
 
		return ($sSQL);			 
	}		
	
	//send mail to db queue
	protected function sendmail_inqueue($from,$to,$subject,$mail_text='',$is_html=false,$user=null,$pass=null,$name=null,$server=null) {
		$db = GetGlobal('db');		
		$ishtml = $is_html?$is_html:0;
		$altbody = null;
		$origin = $this->prpath; 
		$encoding = $this->overwrite_encoding ? $this->overwrite_encoding : $this->encoding;
		$datetime = date('Y-m-d h:s:m');
		$active = 1;		
		$cid = $this->cid; 
		
		//test
		//$this->messages[] = $to;
		//return true; //test
	   
		//tracking var
		if ($this->trackmail) {
	     		 
			$trackid = $this->get_trackid($from,$to);
		 
			if (!$ishtml) {
				$ishtml = 1;
				$html_mail_text = '<html><body>' . $mail_text . '</body></html>';
				$body = $this->add_tracker_to_mailbody($html_mail_text,$trackid,$to,$ishtml);
			}
			else //already html body ...leave it as is		 
				$body = $this->add_tracker_to_mailbody($mail_text,$trackid,$to,$ishtml);

			$body = $this->add_urltracker_to_mailbody($body,$to,$cid);			
		}
		else {
			$body = $mail_text;	   
			$trackid = '';
		}	 
	    
		$sSQL = "insert into mailqueue (timein,active,sender,receiver,subject,body,altbody,cc,bcc,ishtml,encoding,origin,user,pass,name,server,trackid,cid,owner) ";
		$sSQL .=  "values (" .
			 $db->qstr($datetime) . "," . 
			 $active . "," .
		     $db->qstr(strtolower($from)) . "," . 
			 $db->qstr(strtolower($to)) . "," .
		     $db->qstr($subject) . "," . 
			 $db->qstr($body) . "," .
			 $db->qstr($altbody) . "," .				 
			 $db->qstr($ccs) . "," .
			 $db->qstr($bccs) . "," .
			 $ishtml . "," .
			 $db->qstr($encoding) . "," .
			 $db->qstr($origin) . "," .			 
			 $db->qstr($user) . "," .
			 $db->qstr($pass) .	"," .	
			 $db->qstr($name) . "," .
			 $db->qstr($server) . "," .
			 $db->qstr($trackid) . "," .
			 $db->qstr($cid) . "," .
			 $db->qstr($this->owner) . ")";
			 
		//echo $sSQL,'<br>';			
		$result = $db->Execute($sSQL,1);			 
		$ret = $db->Affected_Rows();    
 
		return ($ret);			 
	}		
	
	//send mail to db queue
	protected function sendmail_instant($from,$to,$subject,$mail_text='',$is_html=false,$user=null,$pass=null,$name=null,$server=null) {
		$db = GetGlobal('db');		
		$ishtml = $is_html?$is_html:0;
		$altbody = null;
		$origin = $this->prpath; 
		$encoding = $this->overwrite_encoding ? $this->overwrite_encoding : $this->encoding;
		$datetime = date('Y-m-d h:s:m');
		$active = 0; 		
		$cid = $this->cid; 
		
		//test		
		//$this->messages[] = $to . ' instant message has been sent.';
		//return true; //test
	   
		//tracking var
		if ($this->trackmail) {
	     		 
			$trackid = $this->get_trackid($from,$to);
		 
			if (!$ishtml) {
				$ishtml = 1;
				$html_mail_text = '<html><body>' . $mail_text . '</body></html>';
				$body = $this->add_tracker_to_mailbody($html_mail_text,$trackid,$to,$ishtml);
			}
			else //already html body ...leave it as is		 
				$body = $this->add_tracker_to_mailbody($mail_text,$trackid,$to,$ishtml);

			$body = $this->add_urltracker_to_mailbody($body,$to,$cid);			
		}
		else {
			$body = $mail_text;	   
			$trackid = '';
		}
		
		//inseert as deactivated queue tasks (to keep track)
		$sSQL = "insert into mailqueue (timein,timeout,active,sender,receiver,subject,body,altbody,cc,bcc,ishtml,encoding,origin,user,pass,name,server,trackid,cid,owner) ";
		$sSQL .=  "values (" .
			 $db->qstr($datetime) . "," . 
			 $db->qstr($datetime) . "," . //timeout = timein
			 $active . "," .
		     $db->qstr(strtolower($from)) . "," . 
			 $db->qstr(strtolower($to)) . "," .
		     $db->qstr($subject) . "," . 
			 $db->qstr($body) . "," .
			 $db->qstr($altbody) . "," .				 
			 $db->qstr($ccs) . "," .
			 $db->qstr($bccs) . "," .
			 $ishtml . "," .
			 $db->qstr($encoding) . "," .
			 $db->qstr($origin) . "," .			 
			 $db->qstr($user) . "," .
			 $db->qstr($pass) .	"," .	
			 $db->qstr($name) . "," .
			 $db->qstr($server) . "," .
			 $db->qstr($trackid) . "," .
			 $db->qstr($cid) . "," .
			 $db->qstr($this->owner) . ")";
			 
		//echo $sSQL,'<br>';			
		$result = $db->Execute($sSQL,1);			 
		$ret = $db->Affected_Rows();   		

		$ret = $this->sendmail($from,$to,$subject,$body,$this->ishtml,$user,$pass,$name,$server);		
 
		return ($ret);			 
	}	
	
    protected function sendmail($from,$to,$subject,$mail_text='',$is_html=false) {
		$sFormErr = GetGlobal('sFormErr');
		$err = null; 

		if (($this->_checkmail($to)) && ($subject)) {//echo $to,'<br>';
	   
			$smtpm = new smtpmail($this->encoding,$this->mailuser,$this->mailpass,$this->mailname,$this->mailserver);
		   	   
			if ((SMTP_PHPMAILER=='true') || ($method=='SMTP')) {
				$smtpm->from($from,$this->mailname);		   
				$smtpm->to($to);  
				$smtpm->subject($subject);
				$smtpm->body($mail_text,$is_html);		   			   	   
			}
			elseif ((SENDMAIL_PHPMAILER=='true') || ($method=='SENDMAIL')) {	  	   
				$smtpm->from($from,$this->mailname);		   
				$smtpm->to($to);  			    
				$smtpm->subject($subject);
				$smtpm->body($mail_text,$is_html);		  		      
			} 
			else {
				$smtpm->to($to); 
				$smtpm->from($from); 
				$smtpm->subject($subject);
				$smtpm->body($mail_text);			   			   	    
			}
			 
			$err .= $smtpm->smtpsend();
			unset($smtpm);				 
		  			     	  	
			if (!$err) {
				$this->messages[] = localize('_msgsuccess',getlocal());	//send message ok
				return true;
			}         
			else 
				$this->messages[] = "Error: " . $err;	//error
		}
		else 
			$this->messages[] = localize('_msgerror',getlocal());
		 
	   return (false);	  	   
    } 	
	
	/*when web view hide texts */
	protected function add_remarks_to_hide($text=null) {
		//remark used to rename when webview (not to show as web page)
		$ret = "<!--REMARK--><p>" . $text. "</p><!--REMARK-->";
		return ($ret);
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
	
	/* todo : add list name to unsubscribe in specific list*/
	protected function get_trackid($from,$to) {
	
		$i = rand(100000,999999);//++$m;	 
		$tid = date('YmdHms') .  $i . '@' . $this->appname;
		 
		return ($tid);	
	}
	
	public function spam_conditions_text() {
		$lan = getlocal() ? 1 : 0;
		
		$text0 = "This e-mail sent to _SUBSCRIBER_ from _MAILSENDER_. This e-mail can not be considered spam as long as we include: Contact information & remove instructions. 
If you have somehow gotten on this list in error, or for any other reason would like to be removed, please click _UNSUBSCRIBE_. 
This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. Any unauthorized disclosure, use of dissemination, either whole or partial, is prohibited.
(Relative as A5-270/2001 of European Council).";
	  
		$text1 = "Αυτο το e-mail στάλθηκε στον λογαριασμό ηλ. ταχυδρομείου _SUBSCRIBER_ από τον λογαριασμό _MAILSENDER_. Δεν μπορει να θεωρηθεί spam εφόσον αναγράφονται τα στοιχεία του αποστολέα και διαδικασίες διαγραφής απο την λίστα παραληπτών.  
Αν είσαστε σε αυτή τη λίστα κατα λάθος ή για οποιονδήποτε άλλο λογο θέλετε να διαγραφεί το e-mail απο αυτή τη λίστα παραληπτών e-mail απλά πατήστε _UNSUBSCRIBE_.   
Το μήνυμα πληρεί τις προυποθέσεις της Ευρωπαικής Νομοθεσίας περί διαφημιστικών μηνυμάτων. Κάθε μήνυμα θα πρέπει να φέρει τα πλήρη στοιχεια του αποστολέα ευκρινώς και θα πρέπει να δίνει στο δέκτη τη δυνατότητα διαγραφής. 
(Directiva 2002/31/CE του Ευρωπαικού Κοινοβουλίου).";	

        $ret = $lan ? $text1 : $text0;	
		return ($ret);
    }

	public function weblink_text() {
		$lan = getlocal() ? 1 : 0;
		
		$text0 = "Press _WEBLINK_ to see this newsletter as webpage.";
		$text1 = "Πατήστε _WEBLINK_ για να δείτε το newsletter ως ιστοσελίδα.";
		
		$ret = $lan ? $text1 : $text0;	
		return ($ret);
	}	
	
	public function encUrl($url, $nohost=false) {
		
		$url = $url ? $url : _m('cms.getHttpUrl'); //default this
		
		if ($url) {
			
			if (($this->isHostedApp)&&($nohost==false)) {
				$burl = explode('/', $url);
				array_shift($burl); //shift http
				array_shift($burl); //shift //
				array_shift($burl); //www //
				$xurl = implode('/',$burl);
				//$qry = 'a='.$this->appname.'&u=' . $xurl . '&cid=_CID_' . '&r=_TRACK_';
				$qry = 't=mt&a='.$this->appname.'_AMP_u=' . $xurl . '_AMP_cid=_CID_' . '_AMP_r=_TRACK_'; //CKEditor &amp; issue				
			}
			else {
				//$xurl = $url; //as is
				$qry = 't=mt&u=' . $url . '_AMP_cid=_CID_' . '_AMP_r=_TRACK_'; //CKEditor &amp; issue				
			}	
			
			$uredir = $this->urlRedir .'?'. $qry; //'?turl=' . $encoded_qry;
			
			/*RewriteRule ^m/([^/]*)/([^/]*)/([^/]*)/([^/]*)/$ /mtrackurl.php?t=mtrack&a=$1&u=$2&cid=$3&r=$4 [L] */
			//$uredir = $this->urlRedir2 .'/'. $this->appname .'/'. str_replace('/','-', $xurl) . '/_CID_/_TRACK_/' ; // htaccess / problem
			
			return ($uredir); 
		}
		else
			return ('#');
	}
	
	protected function add_urltracker_to_mailbody($mailbody=null,$id=null,$cid=null) {

		$ret = str_replace(array('_TRACK_','_CID_','_AMP_'), array(base64_encode($id), $cid, "&"), $mailbody);
		return ($ret);
	}
	

	public function ckjavascript() {
		if ($this->ckeditver==3)
			return '<script src="' . 
					_v('cms.paramload use CKEDITOR+ckeditorjs') .
					'"></script>';
		else
			return '<script src="assets/ckeditor/ckeditor.js"></script>';
	}
	
    public function ckeditorjs($element=null, $maxmininit=false, $disable=false) {

		$readonly = $disable ? 1 : 0;  	
		$element_name = $element ? $element : ((($_GET['t']=='cptemplatenew')||($_GET['t']=='cptemplatesav')) ? 'template_text' : 'mail_text');
		$minmax = $maxmininit ? $maxmininit : ($_GET['stemplate'] ? 'maximize' : 'minimize') ;
		//echo $minmax;	
		
	    $ckattr = ($this->ckeditver==4) ?
	           "fullpage : true,"	  
	           : 
	           "skin : 'v2', 
			   fullpage : true, 
			   extraPlugins :'docprops',";		
		
		$ret = "
			<script type='text/javascript'>
	           CKEDITOR.replace('$element_name',
			   {
				$ckattr	
				filebrowserBrowseUrl : '/cp/ckfinder/ckfinder.html',
	            filebrowserImageBrowseUrl : '/cp/ckfinder/ckfinder.html?type=Images',
	            filebrowserFlashBrowseUrl : '/cp/ckfinder/ckfinder.html?type=Flash',
	            filebrowserUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	            filebrowserImageUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	            filebrowserFlashUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
	            filebrowserWindowWidth : '1000',
 	            filebrowserWindowHeight : '700'				
			   }		   
			   );
			   CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
			   CKEDITOR.config.forcePasteAsPlainText = false; // default so content won't be manipulated on load
			   CKEDITOR.config.fullPage = true;
               CKEDITOR.config.entities = false;
			   CKEDITOR.config.basicEntities = false;
			   CKEDITOR.config.entities_greek = false;
			   CKEDITOR.config.entities_latin = false;
			   CKEDITOR.config.entities_additional = '';
			   CKEDITOR.config.htmlEncodeOutput = false;
			   CKEDITOR.config.entities_processNumerical = false;
			   CKEDITOR.config.fillEmptyBlocks = function (element) {
				return true; // DON'T DO ANYTHING!!!!!
               };
			   CKEDITOR.config.allowedContent = true; // don't filter my data	
			   CKEDITOR.config.protectedSource.push( /<phpdac[\s\S]*?\/phpdac>/g );
			   CKEDITOR.on('instanceReady',
               function( evt )
               {
                  var editor = evt.editor;
                  editor.execCommand('$minmax');
				  editor.setReadOnly($readonly);
               });			   
		    </script>		
";
		return ($ret);
	}	
	
	//tokens method	
	protected function combine_tokens($template, $tokens, $execafter=null) {
	    if (!is_array($tokens)) return;		

		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
		  $fp = new fronthtmlpage(null);
		  $ret = $fp->process_commands($template);
		  unset ($fp);		  		
		}		  		
		else
		  $ret = $template;
		  
	    foreach ($tokens as $i=>$tok) {
		    $ret = str_replace("$".$i."$",$tok,$ret);
	    }
		//clean unused token marks
		for ($x=$i;$x<30;$x++)
		  $ret = str_replace("$".$x."$",'',$ret);
		
		//execute after replace tokens
		if (($execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
		  $fp = new fronthtmlpage(null);
		  $retout = $fp->process_commands($ret);
		  unset ($fp);
          
		  return ($retout);
		}		
		
		return ($ret);
	}
	
    //combine tokens with load tmpl data inside	
	public function ct($template, $tokens, $execafter=null) {
	    //if (!is_array($tokens)) return;
		$template_contents = @file_get_contents($template);
		
		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
		  $fp = new fronthtmlpage(null);
		  $ret = $fp->process_commands($template_contents);
		  unset ($fp);		  		
		}		  		
		else
		  $ret = $template_contents; 
		  
		//echo $ret;
	    foreach ($tokens as $i=>$tok) {
		    $ret = str_replace("$".$i."$",$tok,$ret);
	    }
		//clean unused token marks
		for ($x=$i;$x<30;$x++)
		  $ret = str_replace("$".$x."$",'',$ret);
		
		//execute after replace tokens
		if (($execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
		  $fp = new fronthtmlpage(null);
		  $retout = $fp->process_commands($ret);
		  unset ($fp);
          
		  return ($retout);
		}		
		
		return ($ret);
	}						
};
}
?>