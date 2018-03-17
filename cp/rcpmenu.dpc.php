<?php

$__DPCSEC['RCPMENU_DPC']='1;1;1;2;2;2;2;2;6;9';

if (!defined("RCPMENU_DPC")) {
define("RCPMENU_DPC",true);

$__DPC['RCPMENU_DPC'] = 'rcpmenu';

$a = GetGlobal('controller')->require_dpc('jsdialog/jsdialogStreamSrv.dpc.php');
require_once($a);

$__EVENTS['RCPMENU_DPC'][1]='cpmenu';
$__EVENTS['RCPMENU_DPC'][2]='cpmenu1';
$__EVENTS['RCPMENU_DPC'][3]='cpmenu2';

$__ACTIONS['RCPMENU_DPC'][1]='cpmenu';
$__ACTIONS['RCPMENU_DPC'][2]='cpmenu1';
$__ACTIONS['RCPMENU_DPC'][3]='cpmenu2';


$__LOCALE['RCPMENU_DPC'][0]='RCPMENU_CNF;Cp Menu;Cp Menu';	   

$__LOCALE['RCPMENU_DPC'][13]='_awstats;Web statistics;Στατιστικά';
$__LOCALE['RCPMENU_DPC'][14]='_google_analytics;Google Analytics;Στατιστικά Google';
$__LOCALE['RCPMENU_DPC'][15]='_siwapp;Siwapp;Siwapp τιμολόγηση';
$__LOCALE['RCPMENU_DPC'][16]='_MENU1;Size;Μέγεθος';
$__LOCALE['RCPMENU_DPC'][17]='_MENU2;People;Συναλλασόμενοι';
$__LOCALE['RCPMENU_DPC'][18]='_MENU3;Photos & attachments;Φωτογραφίες και έγγραφα';
$__LOCALE['RCPMENU_DPC'][19]='_MENU4;Inventory;Αποθήκη';
$__LOCALE['RCPMENU_DPC'][20]='_MENU5;Synchronize;Συγχρονισμοί';
$__LOCALE['RCPMENU_DPC'][21]='_MENU6;Newsletters;Αποστολές';
$__LOCALE['RCPMENU_DPC'][22]='_MENU7;Orders;Κινήσεις';
$__LOCALE['RCPMENU_DPC'][23]='_add_categories;Upload Categories;Εισαγωγή κατηγοριών';
$__LOCALE['RCPMENU_DPC'][24]='_add_products;Upload Products;Εισαγωγή ειδών';

$__LOCALE['RCPMENU_DPC'][25]='_google_addwords;Google Adwords;Google Adwords';
$__LOCALE['RCPMENU_DPC'][26]='_upload_logo;Upload logo;Αλλαγή λογοτύπου';
$__LOCALE['RCPMENU_DPC'][27]='_add_recaptcha;ReCaptcha;ReCaptcha';
$__LOCALE['RCPMENU_DPC'][28]='_update;Update;Αναβάθμιση';
$__LOCALE['RCPMENU_DPC'][29]='_backup;Backup;Αποθήκευση';
$__LOCALE['RCPMENU_DPC'][30]='_backup_content;Backup contents;Αποθήκευση στοιχείων';
$__LOCALE['RCPMENU_DPC'][31]='_maildbqueue;Newsletters & mailing lists;Μαζικές αποστολές e-mails';
$__LOCALE['RCPMENU_DPC'][32]='_sendnewsletters;Enable newsletter mailing list feature;Ενεργοποίηση μαζικών αποστολών e-mails';
$__LOCALE['RCPMENU_DPC'][33]='_TWEETSRSS;Feeds & tweets;Ενημέρωση';
$__LOCALE['RCPMENU_DPC'][34]='_add_domainname;Domain name;Domain name';
$__LOCALE['RCPMENU_DPC'][35]='_customers;Customers;Πελάτες';
$__LOCALE['RCPMENU_DPC'][36]='_installeshop;Install e-shop;Εγκατάσταση e-shop';
$__LOCALE['RCPMENU_DPC'][37]='_uninstalleshop;Uninstall e-shop;Κατάργηση e-shop';
$__LOCALE['RCPMENU_DPC'][38]='_eshop;e-shop module;e-shop πρόσθετο';
$__LOCALE['RCPMENU_DPC'][39]='_install;Install;Εγκατάσταση';
$__LOCALE['RCPMENU_DPC'][40]='_ckfinder;CKfinder;CKfinder';
$__LOCALE['RCPMENU_DPC'][41]='_jqgrid;JQgrid;JQgrid';
$__LOCALE['RCPMENU_DPC'][42]='_ieditor;IEditor;IEditor';
$__LOCALE['RCPMENU_DPC'][43]='_addons;Addons;Πρόσθετα';
$__LOCALE['RCPMENU_DPC'][44]='_edit_htmlfiles;Edit system files;Επεξεργασία αρχείων συστήματος';
$__LOCALE['RCPMENU_DPC'][45]='_addspace;Limited space, add space;Πρόσθεσε χωρητικότητα';
$__LOCALE['RCPMENU_DPC'][46]='_ago;after expiration;που έληξε';
$__LOCALE['RCPMENU_DPC'][47]='_fromnow;before expire;πρίν τη λήξη';
$__LOCALE['RCPMENU_DPC'][48]='_modified;modified;Ενημερώθηκε';
$__LOCALE['RCPMENU_DPC'][49]='_ago2;ago;πρίν';
$__LOCALE['RCPMENU_DPC'][50]='_fromnow2;from now;μετά';
$__LOCALE['RCPMENU_DPC'][51]='_cpimages;Update icons;Ενημέρωση εικονιδίων';
$__LOCALE['RCPMENU_DPC'][52]='_addkey;Add key;Εισαγωγή κλειδιού';
$__LOCALE['RCPMENU_DPC'][53]='_genkey;Gen key;Δημιουργία κλειδιού';
$__LOCALE['RCPMENU_DPC'][54]='_validatekey;Validate key;Έλεγχος κλειδιού';
$__LOCALE['RCPMENU_DPC'][55]='_desendnewsletters;Uninstall newsletter feature;Απεγκατάσταση μαζικών αποστολών e-mails';
$__LOCALE['RCPMENU_DPC'][56]='_newsletters;Newsletter feature installed;Αποστολή e-mails εγκατεστημένο';
$__LOCALE['RCPMENU_DPC'][57]='_year;Year;Έτος';
$__LOCALE['RCPMENU_DPC'][58]='_month;Month;Μήνας';
$__LOCALE['RCPMENU_DPC'][59]='_more;More...;Περισσότερα...';

$__LOCALE['RCPMENU_DPC'][60]='_exit;Exit;Έξοδος';
$__LOCALE['RCPMENU_DPC'][61]='_dashboard;Dashboard;Πίνακας ελέγχου';
$__LOCALE['RCPMENU_DPC'][62]='_logout;Logout;Αποσύνδεση';
$__LOCALE['RCPMENU_DPC'][63]='_rssfeeds;RSS Feeds;RSS Feeds';
$__LOCALE['RCPMENU_DPC'][64]='_edititemtext;Edit Item Text;Μεταβολή κειμένου';// (text) αντικειμένου';
$__LOCALE['RCPMENU_DPC'][65]='_deleteitemattachment;Delete Item Attachment;Διαγραφή συνημμένου';// είδους';
$__LOCALE['RCPMENU_DPC'][66]='_editcat;Edit Category;Μεταβολή κατηγορίας';
$__LOCALE['RCPMENU_DPC'][67]='_addcat;Add Category;Νέα Κατηγορία';
$__LOCALE['RCPMENU_DPC'][68]='_additem;Add Item;Νέο Είδος';
$__LOCALE['RCPMENU_DPC'][69]='_webstatistics;Statistics;Στατιστικά';
$__LOCALE['RCPMENU_DPC'][70]='_addcathtml;Add Category Html;Προσθήκη κειμένου';// κατηγορίας';
$__LOCALE['RCPMENU_DPC'][71]='_editcathtml;Edit Category Html;Μεταβολή κειμένου';// κατηγορίας';
$__LOCALE['RCPMENU_DPC'][72]='_edititem;Edit Item;Μεταβολή';// αντικειμένου';
$__LOCALE['RCPMENU_DPC'][73]='_edititemphoto;Edit Photo;Φωτογραφία';// αντικειμένου';
$__LOCALE['RCPMENU_DPC'][74]='_edititemdbhtm;Text;Κείμενο';// (htm) αντικειμένου (db)';
$__LOCALE['RCPMENU_DPC'][75]='_edititemdbhtml;Text;Κείμενο';// (html) αντικειμένου (db)';
$__LOCALE['RCPMENU_DPC'][76]='_edititemdbtext;Text;Κείμενο';// (text) αντικειμένου (db)';
$__LOCALE['RCPMENU_DPC'][77]='_senditemmail;Send e-mail;Αποστολή e-mail';
$__LOCALE['RCPMENU_DPC'][78]='_delitemattachment;Delete Text;Διαγραφή κειμένου';// (db)';
$__LOCALE['RCPMENU_DPC'][79]='_edititemtext;Edit Item Text;Κείμενο';// (text) αντικειμένου';
$__LOCALE['RCPMENU_DPC'][80]='_edititemhtm;Edit Item Htm;Κείμενο';// (htm) αντικειμένου';
$__LOCALE['RCPMENU_DPC'][81]='_edititemhtml;Edit Item Html;Κείμενο';// (html) αντικειμένου';
$__LOCALE['RCPMENU_DPC'][82]='_additemhtml;Add Item Html;Νέο Κείμενο';// στο αντικείμενο';
$__LOCALE['RCPMENU_DPC'][83]='_transactions;Transactions;Συναλλαγές';
$__LOCALE['RCPMENU_DPC'][84]='_users;Users;Χρήστες';
$__LOCALE['RCPMENU_DPC'][85]='_itemattachments2db;Attach to DB;Μεταφορά κειμένων σε Β.Δ.';//βάση δεδομένων';
$__LOCALE['RCPMENU_DPC'][86]='_importdb;Import Database;Εισαγωγή β.δ.';
$__LOCALE['RCPMENU_DPC'][87]='_config;Configuration;Ρυθμίσεις';
$__LOCALE['RCPMENU_DPC'][88]='_contactform;Contact Form;Επαφές';
$__LOCALE['RCPMENU_DPC'][89]='_subscribers;Subscribers;Συνδρομητές';
$__LOCALE['RCPMENU_DPC'][90]='_sitemap;Sitemap;Χάρτης πλοήγησης';// αντικειμένων';
$__LOCALE['RCPMENU_DPC'][91]='_search;Search;Φόρμα Αναζήτησης';
$__LOCALE['RCPMENU_DPC'][92]='_upload;Upload files;Μεταφόρτωση';
$__LOCALE['RCPMENU_DPC'][93]='_uploadid;Upload item files;Μεταφόρτωση';// αντικειμένου';
$__LOCALE['RCPMENU_DPC'][94]='_uploadcat;Upload category files;Μεταφόρτωση';// κατηγορίας';
$__LOCALE['RCPMENU_DPC'][95]='_syncphoto;Sync photos;Συγχρονισμός φωτογραφιών';
$__LOCALE['RCPMENU_DPC'][96]='_syncsql;Sync data;Συγχρονισμός δεδομένων';
$__LOCALE['RCPMENU_DPC'][97]='_dbphoto;Image in DB;Εικόνα στην β.δ.';
$__LOCALE['RCPMENU_DPC'][98]='_editctag;Tags;Tags';
$__LOCALE['RCPMENU_DPC'][99]='_edititag;Tags;Tags';
$__LOCALE['RCPMENU_DPC'][100]='_menu;Menu settings;Ρυθμίσεις menu';
$__LOCALE['RCPMENU_DPC'][101]='_slideshow;Slideshow;Slideshow';
$__LOCALE['RCPMENU_DPC'][102]='_ckfinder;CKFinder;CKFinder';
$__LOCALE['RCPMENU_DPC'][103]='_webmail;Web Mail;Web Mail';
$__LOCALE['RCPMENU_DPC'][104]='_editpage;Edit Page;Επεξεργασία σελίδας';
$__LOCALE['RCPMENU_DPC'][105]='_rempass;Forgotten password;Υπενθύμιση κωδικού';
$__LOCALE['RCPMENU_DPC'][106]='_chpass;Change password;Αλλαγή κωδικού';
$__LOCALE['RCPMENU_DPC'][107]='_cphelp;Ηelp;Βοήθεια';
$__LOCALE['RCPMENU_DPC'][108]='_cpupgrade;Upgrade;Αναβάθμιση';
$__LOCALE['RCPMENU_DPC'][109]='_cpwizard;Enable wizard;Οδηγός εγκατάστασης';
$__LOCALE['RCPMENU_DPC'][110]='_cpdhtmlon;Windows mode;Πλοήγηση Windows';
$__LOCALE['RCPMENU_DPC'][111]='_cpdhtmloff;Frames mode;Πλοήγηση Frames';
$__LOCALE['RCPMENU_DPC'][112]='_cpcropwiz;Crop wizard;Crop wizard';
$__LOCALE['RCPMENU_DPC'][113]='_OPTIONS;Options;Επιλογές';
$__LOCALE['RCPMENU_DPC'][114]='_ADD;Add;Προσθήκη';
$__LOCALE['RCPMENU_DPC'][115]='_CATEGORY;Category;Κατηγορία';
$__LOCALE['RCPMENU_DPC'][116]='_ITEM;Item;Είδος';
$__LOCALE['RCPMENU_DPC'][117]='_SETTINGS;Settings;Ρυθμίσεις';
$__LOCALE['RCPMENU_DPC'][118]='_customers;Customers;Πελάτες';
$__LOCALE['RCPMENU_DPC'][119]='_EDITHTML;Edit Html;Σελίδες Html';
$__LOCALE['RCPMENU_DPC'][120]='_SELECTHTML;Select Html;Επιλογή Html';
$__LOCALE['RCPMENU_DPC'][121]='_ADDFAST;Add item;Εισαγωγή είδους';
$__LOCALE['RCPMENU_DPC'][122]='_addtag;Add Tag;Εισαγωγή Ετικέτας';
$__LOCALE['RCPMENU_DPC'][123]='_back;Back;Επιστροφή';
$__LOCALE['RCPMENU_DPC'][124]='_mailqueue;Mail queue;Αποστολές';
$__LOCALE['RCPMENU_DPC'][125]='_ENTITIES;Entities;Στοιχεία';
$__LOCALE['RCPMENU_DPC'][126]='_categories;Sections;Κατηγορίες';
$__LOCALE['RCPMENU_DPC'][127]='_items;Items;Αντικείμενα';
$__LOCALE['RCPMENU_DPC'][128]='_configmenu;Config menu;Ρυθμίσεις menu';
$__LOCALE['RCPMENU_DPC'][129]='_xmlfeeds;XML feeds;XML feeds';
$__LOCALE['RCPMENU_DPC'][130]='_dynsql;SQL Syncs;Συγχρονισμοί';
$__LOCALE['RCPMENU_DPC'][131]='_bmailqueue;Responds;Απαντήσεις';
$__LOCALE['RCPMENU_DPC'][132]='_bmailqueueadd;Subscribers;Λίστες';
$__LOCALE['RCPMENU_DPC'][133]='_bmailsend;Send;Αποστολή';
$__LOCALE['RCPMENU_DPC'][134]='_bmail;e-Mail;e-Mail';
$__LOCALE['RCPMENU_DPC'][135]='_bmailstats;Statistics;Στατιστική';
$__LOCALE['RCPMENU_DPC'][136]='_bmailcamp;Campaigns;Καμπάνιες';
$__LOCALE['RCPMENU_DPC'][137]='_ITEMCOLLECTION;Collect;Συλλογή';
$__LOCALE['RCPMENU_DPC'][138]='_myprofile;My profile;Οι ρυθμίσεις μου';
$__LOCALE['RCPMENU_DPC'][139]='_allnotifications;See all notifications;Όλα τα μηνύματα';
$__LOCALE['RCPMENU_DPC'][140]='_allmessages;See all messages;Όλες τα μηνύματα ';
$__LOCALE['RCPMENU_DPC'][141]='_alltasks;See all notifications;Όλες οι εργασίες';
$__LOCALE['RCPMENU_DPC'][142]='_youhave;You have;Υπάρχουν';
$__LOCALE['RCPMENU_DPC'][143]='_newnotifications;new notifications;μηνύματα';
$__LOCALE['RCPMENU_DPC'][144]='_pendingtasks;pending tasks;εργασίες';
$__LOCALE['RCPMENU_DPC'][145]='_itemrelation;Relationships;Σύνδεσμοι';
$__LOCALE['RCPMENU_DPC'][146]='_itemrel;Relations;Συσχετισμοί';
$__LOCALE['RCPMENU_DPC'][147]='_bmailcreate;Build;Κατασκευή';
$__LOCALE['RCPMENU_DPC'][148]='_COLLECT;Collect;Επιλογή';
$__LOCALE['RCPMENU_DPC'][149]='_help;Help;Βοήθεια';
$__LOCALE['RCPMENU_DPC'][150]='_tour;Guided tour;Βοήθεια';
$__LOCALE['RCPMENU_DPC'][151]='_analyze;Analyse;Ανάλυση';
$__LOCALE['RCPMENU_DPC'][152]='_sync;Synchronize;Συγχρονισμός';
$__LOCALE['RCPMENU_DPC'][153]='_fscanner;Scanner;Scanner';
$__LOCALE['RCPMENU_DPC'][154]='_cron;Cron;Cron';
$__LOCALE['RCPMENU_DPC'][155]='_replication;Replication;Replication';
$__LOCALE['RCPMENU_DPC'][156]='_backup;Backup;Backup';
$__LOCALE['RCPMENU_DPC'][157]='_blacklist;IP Blacklist;Εξαιρέσεις IP';
$__LOCALE['RCPMENU_DPC'][158]='_crm;Crm;Crm';
$__LOCALE['RCPMENU_DPC'][159]='_crmplus;Plus;Plus';
$__LOCALE['RCPMENU_DPC'][160]='_crmforms;Forms;Φόρμες';
$__LOCALE['RCPMENU_DPC'][161]='_itemqpolicy;Qty policy;Ποσοτικές εκπτώσεις';
$__LOCALE['RCPMENU_DPC'][162]='_crmtrace;Contacts;Επαφές';
$__LOCALE['RCPMENU_DPC'][163]='_crmoffers;Offers;Προσφορές';
$__LOCALE['RCPMENU_DPC'][164]='_outoflist;out of list;εξήχθει απο';
	   
class rcpmenu {

	var $path, $urlpath, $inpath, $menufile;
	var $delimiter, $dropdown_class, $dropdown_class2;  

	var $seclevid, $turl, $cpGet, $turldecoded; 
	
	public function __construct() {
	   
        $this->path = paramload('SHELL','prpath');	   
	   
	    $this->urlpath = paramload('SHELL','urlpath');
	    $this->inpath = paramload('ID','hostinpath');	
	  
        $this->menufile = $this->path . 'menucp.ini';
	    $this->delimiter = ',';

        $this->dropdown_class = remote_paramload('RCPMENU','dropdownclass',$this->path);	   
	    $this->dropdown_class2 = remote_paramload('RCPMENU','dropdownclass2',$this->path); 

	    //$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];		
			   
        $this->getTURL();	   
    }
   

    public function event($event=null) {
   
		switch ($event) {

			case 'cpmenu'        :	
			default              : 						
		}
	}
   

	public function action($action=null) {

		switch ($action) {

			case 'cpmenu'        :						
			default              : 
		}
	   
		return ($out);
	}
   
    protected function getTURL() {
		$postedTURL = $_POST['turl'] ? $_POST['turl'] : $_GET['turl'];
	   
	    if ($postedTURL) {//a post from login screen
			$this->turl = $postedTURL;
			$this->turldecoded = str_replace('_&_', '_%26_', base64_decode($postedTURL));
			$urlquery = parse_url($this->turldecoded); 
			parse_str($urlquery['query'], $getp); 	
			$this->cpGet = $getp;
			
			SetSessionParam('turl', $postedTURL);
			SetSessionParam('turldecoded', $this->turldecoded);		
			SetSessionParam('cpGet', base64_encode(serialize($this->cpGet)));
	    }		   
	    elseif ($turl = $_SESSION['turl']) { //GetSessionParam('turl')) {
			$this->turl = $turl;
			$this->turldecoded = GetSessionParam('turldecoded');
			$this->cpGet = unserialize(base64_decode($_SESSION['cpGet']));
	    }   
	   
	    return ($this->turldecoded);
	}  

	protected function getPageName() {
		$pn = explode('/',$this->url);
		$pname = array_pop($pn);
		$pnurl = stristr($pname,'?') ? explode('?',$pname) : array('0'=>$pname);
		$pagename = $pnurl[0];
		
		return ($pagename);
	}
   
	public function exiturl() {
	   return ('../' . $this->getTURL());//$this->turl);
	}
	
	protected function parse_config() {
	    $conf = $this->path . "myconfig.txt.php";
		include($conf);
		$cnf = parse_ini_string($myconf,1, INI_SCANNER_RAW);
		
		foreach ($cnf as $s=>$section) {
			foreach ($section as $var=>$val)
				$ret[$s.'-'.$var] = $val;
		}

		return ($ret);		
	}
   
	public function parse_environment($save_session=false) {	   
		$this->seclevid = $_SESSION['ADMINSecID'] ? $_SESSION['ADMINSecID'] : $GLOBALS['ADMINSecID'];
		$sl = ($this->seclevid>1) ? intval($this->seclevid)-1 : 1;
		//echo 'ADMINSecID:'.$GLOBALS['ADMINSecID'].':'.$sl.':'.$this->seclevid;

		$ini = @parse_ini_file($this->path . "cp.ini");
		if (!$ini) die('Environment error!');	
	
		foreach ($ini as $env=>$val) {
			if (stristr($val,',')) {
				$uenv = explode(',',$val);
				$ret[$env] = $uenv[$sl];  
			}
			else
				$ret[$env] = $val;
		}

		if (($save_session) && (!$_SESSION['env'])) 
			SetSessionParam('env', $ret); 		
	
		return ($ret);
	}

	//for each user up to current, set security on	
	protected function parse_userSecurity() {
        $ret = array();
		//for($usrsec=$this->seclevid; $usrsec<=9; $usrsec++)
			//$ret['USER'.$usrsec] = 1;
		
		$ret['USER'] = $this->seclevid;
		$ret['USER'.$this->seclevid] = 1;
		//print_r($ret);
		return ($ret);
	}
   
	protected function readINI() {  

        if (defined('CCPP_VERSION')) { //override, customized per line
			$cat = $this->cpGet['cat'] ? array('ON'=>1,'OFF'=>null) : array('ON'=>null,'OFF'=>1);
			$id = $this->cpGet['id'] ? array('ON'=>1,'OFF'=>null) : array('ON'=>null,'OFF'=>1);  		
			$config = array('CAT'=>$cat, 
							'ID'=>$id, 
							'SEC'=>$this->parse_environment(),
							'CNF'=>$this->parse_config(),
							'ADMIN'=>$this->parse_userSecurity(),
							);
			//print_r($config);
			
			if (is_readable($this->menufile)) {
				$sini = @file_get_contents($this->menufile);
				//echo $sini;
			    
				$preprocessor = new CCPP($config, true); //new ccpp
				$rawini = $preprocessor->execute($sini, 0, true, true);
				unset($preprocessor);
				//echo $rawini;
				$m = parse_ini_string($rawini,1,INI_SCANNER_RAW);
				return ($m);	
			}
		}
        else {
			//echo $this->menufile;
			if (is_readable($this->menufile))
				$m = parse_ini_file($this->menufile,1,INI_SCANNER_RAW);			
			
			return ($m);
		}
		
		return false;	
	}
   			

	public function render($menu_template=null,$glue_tag=null,$submenu_template=null) {
        $lan = getlocal() ? getlocal() : '0';
		$this->seclevid = $_SESSION['ADMINSecID'] ? $_SESSION['ADMINSecID'] : $GLOBALS['ADMINSecID'];
		$sl = ($this->seclevid>1) ? intval($this->seclevid)-1 : 1;		
	  
	    $m = $this->readINI();
		if (!$m) return false;
		  
		//print_r($m);
		foreach ($m as $menu_item) {
				
			if (isset($menu_item['title'])) { 		
		  
				$title = explode($this->delimiter ,$menu_item['title']);
				$link = explode($this->delimiter ,$menu_item['link']); 		  
		  
				//SECURITY
				if (stristr($menu_item['spaces'],',')) {
					$uenv = explode(',',$menu_item['spaces']);
					$allow = $uenv[$sl];  
				}
				else
					$allow = $menu_item['spaces'];

				if ($allow) {
					$submenu = explode($this->delimiter ,$menu_item['submenu']); 
					if ($smenu = $submenu[$lan]) 
						$smu[$title[$lan].'-submenu'] = $smenu;
					else	
						$smu[$title[$lan].'-submenu'] = null;
		
					$t = localize($title[$lan], $lan);
					$menu[$t] = $link[$lan];
				}	
			}
		}
		
		if (!empty($menu)) {

			$tmpl = $menu_template ? _m("cmsrt.select_template use $menu_template+1") : null;

            foreach ($menu as $name=>$url) {
				
			    $tokens = array(); 
			    $murl = $url ? $this->make_link($url) : '#';
				$name_space = $name;  	
                    
                if ($sub_menu = $smu[$name.'-submenu']) {
					
					$_smenu = (array) $m[$sub_menu];
					$ret2 = $this->render_submenu($_smenu, $submenu_template, $glue_tag);
					$tokens[] = $this->dropdown_class;
					   
					if ($tmpl) {
						$tokens[] = $murl;
						$tokens[] = $name;
						$tokens[] = $ret2;
						$ret .= $this->combine_tokens($tmpl,$tokens,true);
					}
					else {
						$line = "<a href='$murl'>$name</a>";
						$ret .= $gstart . $line . $gend;							
					}
                } 					
				else {
					if ($tmpl) {
						$tokens[] = ''; 
						$tokens[] = $murl;
						$tokens[] = $name;
						$tokens[] = ''; 
						$ret .= $this->combine_tokens($tmpl, $tokens, true);
					}
					else {
						$line = "<a href='$murl'>$name</a>";
						$ret .= $gstart . $line . $gend;
					}							
				}   
			}	
		    return ($ret);
		}
	}
   
	protected function render_submenu($smenu=null,$template=null,$glue_tag=null) { 
        $lan = getlocal() ? getlocal() : '0';
		$sl = ($this->seclevid>1) ? intval($this->seclevid)-1 : 1;		
        if (empty($smenu)) return;
		 	 
		$allow = 1; //start				 
		foreach ($smenu as $m=>$v) {
		    $cv = explode($this->delimiter ,$v);
	
			if (strstr($m,'spaces')) 
			   $allow = $cv[$sl];			
		    elseif ((strstr($m,'title')) && ($allow))
			   $subm_titles[] = localize($cv[$lan], $lan);
			elseif ((strstr($m,'link')) && ($allow))
			   $subm_links[] = $this->make_link($cv[$lan]);
		}		   
	
		$gstart = $glue_tag ? '<'.$glue_tag.'>' : null;
		$gend = $glue_tag ? '</'.$glue_tag.'>' : null;

		if ($template) {
			$tmpl = _m("cmsrt.select_template use $template+1");
			foreach ($subm_titles as $t=>$title) {
				$tokens = array();
				$tokens[] = $subm_links[$t];
				$tokens[] = $title;
				$out .= $this->combine_tokens($tmpl,$tokens,true);
			}	
		}
		else {		
			foreach ($subm_titles as $t=>$title) {
				$line = "<a href='$subm_links[$t]'>$title</a>";
				$out .= $gstart . $line . $gend;
			}
		}		
	 
	    return ($out);
    }
	
	//transform links for special chars
	private function make_link($link=null) {
		$cat = $this->cpGet['cat']; 
		$id = $this->cpGet['id']; 
		$csep = _m('cmsrt.sep');
	    $mycurrentcat = explode($csep,$cat);
	    $selected_cat = array_pop($mycurrentcat);		

		//_SCAT ->$selected_cat (last branch) 
	    //_CAT -> $cat
		//_ID -> $id
	    //| -> ? special char
	    //@ -> ?t= special char
	    //, -> ^  comma is language separator
	    //www. -> http://www. (CCPP takes // as remark)
	
	    $h = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
		$ret = str_replace(array('@','^','www.','|','_CAT','_ID','_SCAT'),
		                   array('?t=',$csep,$h.'www.','?',$cat, $id, $selected_cat),$link);
		/*				   	
		$sslMenu = _m('cmsrt.paramload use CMS+ssl');					
		//$httpurl = _v('cms.httpurl');
		$httpurl = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
		$httpurl.= (strstr($_SERVER['HTTP_HOST'], 'www')) ? $_SERVER['HTTP_HOST'] : 'www.' . $_SERVER['HTTP_HOST'];		
		//if no ssl param then use standard protocol (https jqgid licence)
		$sslMenu ? $httpurl .'/cp/' : 'http://' . $_SERVER['HTTP_HOST'] .'/cp/';
		*/
		$sslurl = null;
		
		return ($sslurl . $ret);
	}

	protected function combine_tokens($template_contents,$tokens, $execafter=null) {
	
	    if (!is_array($tokens)) return;
		
		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
			$fp = new fronthtmlpage(null);
			$ret = $fp->process_commands($template_contents);
			unset ($fp);		  		
		}		  		
		else
			$ret = $template_contents;
		  
	    foreach ($tokens as $i=>$tok) 
		    $ret = str_replace("$".$i."$",$tok,$ret);

		//clean unused token marks
		for ($x=$i;$x<20;$x++)
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

	/*stream dialog for srv called by js */ 
	/*universal stream dialog loader, to not load dpc into every php cp page */
	public function streamDialog() {
		
		$sd = new jsdialogStreamSrv();
		$ret= $sd->streamDialog();
		
		return ($ret);
	}
   
};
}
?>