<?php
$__DPCSEC['RCCRM_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCCRM_DPC")) && (seclevel('RCCRM_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCCRM_DPC",true);

$__DPC['RCCRM_DPC'] = 'rccrm';
 
$__EVENTS['RCCRM_DPC'][0]='cpcrm';
$__EVENTS['RCCRM_DPC'][1]='cpcrmcus';
$__EVENTS['RCCRM_DPC'][2]='cpcrmusers';
$__EVENTS['RCCRM_DPC'][3]='cpcrmshowcus';
$__EVENTS['RCCRM_DPC'][4]='cpcrmshowusr';
$__EVENTS['RCCRM_DPC'][5]='cpcrmdata';
$__EVENTS['RCCRM_DPC'][6]='cpcrmdetails';
$__EVENTS['RCCRM_DPC'][7]='cpcrmmoduledtl';
$__EVENTS['RCCRM_DPC'][8]='cpcrmrun';
$__EVENTS['RCCRM_DPC'][9]='cpcrmdashboard';
$__EVENTS['RCCRM_DPC'][10]='crmstats';
$__EVENTS['RCCRM_DPC'][11]='crmtree';

$__ACTIONS['RCCRM_DPC'][0]='cpcrm';
$__ACTIONS['RCCRM_DPC'][1]='cpcrmcus';
$__ACTIONS['RCCRM_DPC'][2]='cpcrmusers';
$__ACTIONS['RCCRM_DPC'][3]='cpcrmshowcus';
$__ACTIONS['RCCRM_DPC'][4]='cpcrmshowusr';
$__ACTIONS['RCCRM_DPC'][5]='cpcrmdata';
$__ACTIONS['RCCRM_DPC'][6]='cpcrmdetails';
$__ACTIONS['RCCRM_DPC'][7]='cpcrmmoduledtl';
$__ACTIONS['RCCRM_DPC'][8]='cpcrmrun';
$__ACTIONS['RCCRM_DPC'][9]='cpcrmdashboard';
$__ACTIONS['RCCRM_DPC'][10]='crmstats';
$__ACTIONS['RCCRM_DPC'][11]='crmtree';

$__LOCALE['RCCRM_DPC'][0]='RCCRM_DPC;Crm;Crm';
$__LOCALE['RCCRM_DPC'][1]='_id;ID;ID';
$__LOCALE['RCCRM_DPC'][2]='_save;Save;Αποθήκευση';
$__LOCALE['RCCRM_DPC'][3]='_date;Date;Ημερ.';
$__LOCALE['RCCRM_DPC'][4]='_time;Time;Ώρα';
$__LOCALE['RCCRM_DPC'][5]='_customers;Customers;Πελάτες';
$__LOCALE['RCCRM_DPC'][6]='_users;Users;Χρήστες';
$__LOCALE['RCCRM_DPC'][7]='_campaigns;Campaigns;Καμπάνιες';
$__LOCALE['RCCRM_DPC'][8]='_ulist;Leads;Λίστες';
$__LOCALE['RCCRM_DPC'][9]='_failed;Fails;Αποτυχίες';
$__LOCALE['RCCRM_DPC'][10]='_listname;List name;Όνομα λίστας';
$__LOCALE['RCCRM_DPC'][11]='_mode;Search in;Αναζήτηση σε';
$__LOCALE['RCCRM_DPC'][12]='_reply;Replies;Απαντήσεις';
$__LOCALE['RCCRM_DPC'][13]='_subject;Subject;Θέμα';
$__LOCALE['RCCRM_DPC'][14]='_dateins;Start at;Εκκίνηση';
$__LOCALE['RCCRM_DPC'][15]='_dateupd;Updated;Ενημερώση';
$__LOCALE['RCCRM_DPC'][16]='_contacts;Contacts;Επαφές';
$__LOCALE['RCCRM_DPC'][17]='_birthday;Birthday;Ημ. γέννησης';
$__LOCALE['RCCRM_DPC'][18]='_occupation;Occupation;Επάγγελμα';
$__LOCALE['RCCRM_DPC'][19]='_visitors;Visitors;Επισκέπτες';
$__LOCALE['RCCRM_DPC'][20]='_address;Address;Διεύθυνση';
$__LOCALE['RCCRM_DPC'][21]='_tel;Tel.;Τηλέφωνο';
$__LOCALE['RCCRM_DPC'][22]='_mob;Mobile;Κινητό';
$__LOCALE['RCCRM_DPC'][23]='_email;e-mail;e-mail';
$__LOCALE['RCCRM_DPC'][24]='_fax;Fax;Fax';
$__LOCALE['RCCRM_DPC'][25]='_TIMEZONE;Timezone;Ζωνη ωρας';
$__LOCALE['RCCRM_DPC'][26]='_fname;Contact person;Υπεύθυνος επικοινωνίας';
$__LOCALE['RCCRM_DPC'][27]='_lname;Title;Επωνυμια';
$__LOCALE['RCCRM_DPC'][28]='_username;Username;Χρήστης';
$__LOCALE['RCCRM_DPC'][29]='_password;Password;Κωδικός';
$__LOCALE['RCCRM_DPC'][30]='_notes;Notes;Σημειωσεις';
$__LOCALE['RCCRM_DPC'][31]='_subscribe;Subscriber;Συνδρομητης';
$__LOCALE['RCCRM_DPC'][32]='_seclevid;seclevid;seclevid';
$__LOCALE['RCCRM_DPC'][33]='_secparam;Param;Param';
$__LOCALE['RCCRM_DPC'][34]='_active;Active;Ενεργός';
$__LOCALE['RCCRM_DPC'][35]='_secparam;Param;Param';
$__LOCALE['RCCRM_DPC'][36]='_code;Code;Κωδικός';
$__LOCALE['RCCRM_DPC'][37]='_country;Country;Χώρα';
$__LOCALE['RCCRM_DPC'][38]='_timezone;Tmzone;Tmzone';
$__LOCALE['RCCRM_DPC'][39]='_language;Country;ΓλώσσαΧώρα';
$__LOCALE['RCCRM_DPC'][40]='_age;Age;Ηλικία';
$__LOCALE['RCCRM_DPC'][41]='_level;Level;Πρόσβαση';
$__LOCALE['RCCRM_DPC'][42]='_firstname;Firstname;Όνομα';
$__LOCALE['RCCRM_DPC'][43]='_lastname;Lastname;Επώνυμο';
$__LOCALE['RCCRM_DPC'][44]='_breg;Registered users;Εγγραφές χρηστών';
$__LOCALE['RCCRM_DPC'][45]='_mailsent;e-Mails sent;Απεσταλμένα e-mails';


$__LOCALE['RCCRM_DPC'][55]='_mail;e-mail;e-mail';
$__LOCALE['RCCRM_DPC'][56]='_name;Name;Όνομα';
$__LOCALE['RCCRM_DPC'][57]='_afm;Vat ID;ΑΦΜ';
$__LOCALE['RCCRM_DPC'][58]='_area;Area;Περιοχή';
$__LOCALE['RCCRM_DPC'][59]='_prfdescr;Occupation;Επάγγελμα';
$__LOCALE['RCCRM_DPC'][60]='_doy;DOY.;ΔΟΥ.';
$__LOCALE['RCCRM_DPC'][61]='_street;Street;Οδός';
$__LOCALE['RCCRM_DPC'][62]='_number;No;Αριθμος';
$__LOCALE['RCCRM_DPC'][63]='_city;City;Πόλη';
$__LOCALE['RCCRM_DPC'][64]='_attr1;P1;P1';
$__LOCALE['RCCRM_DPC'][65]='_attr2;P2;P2';
$__LOCALE['RCCRM_DPC'][66]='_attr3;P3;P3';
$__LOCALE['RCCRM_DPC'][67]='_attr4;P4;P4';
$__LOCALE['RCCRM_DPC'][68]='_custaddress;Addresses;Διευθύνσεις';
$__LOCALE['RCCRM_DPC'][69]='_active;Active;Ενεργός';
$__LOCALE['RCCRM_DPC'][70]='_code2;Code;Κωδικός';

$__LOCALE['RCCRM_DPC'][100]='_crmdashb;Dashboard;Συνοπτικά';
$__LOCALE['RCCRM_DPC'][101]='_inbox;Inbox;Εισερχόμενα';
$__LOCALE['RCCRM_DPC'][102]='_details;Details;Στοιχεία';
$__LOCALE['RCCRM_DPC'][103]='_sales;Sales;Πωλήσεις';
$__LOCALE['RCCRM_DPC'][104]='_tasks;Tasks;Εργασίες';
$__LOCALE['RCCRM_DPC'][105]='_stats;History;Ιστορικό';
$__LOCALE['RCCRM_DPC'][106]='_purchases;Purchases;Αγορές';
$__LOCALE['RCCRM_DPC'][107]='_wishlist;Wishlist;Wishlist';
$__LOCALE['RCCRM_DPC'][108]='_compares;Compares;Συγκρίσεις';
$__LOCALE['RCCRM_DPC'][109]='_favorites;Recommended;Προτιμήσεις';
$__LOCALE['RCCRM_DPC'][110]='_views;Views;Επικέψεις';
$__LOCALE['RCCRM_DPC'][111]='_returns;Returns;Επιστροφές';
$__LOCALE['RCCRM_DPC'][112]='_offers;Offers;Προσφορές';
$__LOCALE['RCCRM_DPC'][113]='_behaviors;Behavior;Δράσεις';
$__LOCALE['RCCRM_DPC'][114]='_actions;Actions;Ενέργειες';
$__LOCALE['RCCRM_DPC'][115]='_projects;Projects;Projects';
$__LOCALE['RCCRM_DPC'][116]='_items;Items;Είδη';
$__LOCALE['RCCRM_DPC'][117]='_forms;Forms;Φόρμες';
$__LOCALE['RCCRM_DPC'][118]='_templates;Templates;Templates';
$__LOCALE['RCCRM_DPC'][119]='_attach;Attach;Επαφές';
$__LOCALE['RCCRM_DPC'][120]='_view;View;Όψεις';
$__LOCALE['RCCRM_DPC'][121]='_reports;Reports;Αναφορές';
$__LOCALE['RCCRM_DPC'][122]='_plus;Plus;Plus';
$__LOCALE['RCCRM_DPC'][123]='_automations;Automations;Αυτοματισμοί';
$__LOCALE['RCCRM_DPC'][124]='_finance;Finance;Οικονομικές';
$__LOCALE['RCCRM_DPC'][125]='_outbox;Outbox;Εξερχόμενα';
$__LOCALE['RCCRM_DPC'][126]='_docs;Documents;Έγγραφα';
$__LOCALE['RCCRM_DPC'][127]='_events;Events;Περιστατικά';

class rccrm  {

    var $title, $path, $urlpath;
	var $seclevid, $userDemoIds;
	
	var $crmplus, $crmstats;
		
	function __construct() {
	
		$this->path = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		$this->title = localize('RCCRM_DPC',getlocal());	 
	  
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
		$this->userDemoIds = array(5,6,7,8); 		  
		
		$plus = remote_paramload('CRM','plus',$this->prpath);
		$this->crmplus = $plus ? true : false; 
		
		$this->crmstats = array();
	}
	
    function event($event=null) {
	
	   $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   if ($login!='yes') return null;		 
	
	   switch ($event) {
		   
		 case 'crmtree'      : /*menu call for one user dahsboard*/
							   break; 		   
		   
		 case 'crmstats'     : $this->crm_stats(); break;   
		   
		 case 'cpcrmrun'     : /*if ($crm_module = GetReq('mod')) {//module calls inside mod.showdetails
								$m = explode('.', $crm_module);
								_m($m[0].".event use ".$m[1]);		
		                       }*/
		                       break;   
		   
		 case 'cpcrmmoduledtl' : //call module detail function
								echo $this->moduleGridDetails();
                                die();
		                        break;
		 case 'cpcrmdata'    : echo $this->loadsubframe();
		                       die();
		                       break;

		 case 'cpcrmdashboard' : //echo $this->loadsubframe(null, 'dashboard', true);
		                        //die(); 
		                        break;								   
							   						   
		 case 'cpcrmdetails' : break; 
		 
		 case 'cpcrmshowcus' : break; 										  
		 case 'cpcrmshowusr' : break; 		 
		 case 'cpcrmcus'     : echo $this->loadframe(null,'customers');
		                       die();	
		                       break;  	
		 case 'cpcrmusers'   : echo $this->loadframe(null,'users');
		                       die();
							   break; 	   
	     case 'cpcrm'        :
		 default             :    
		                      
	   }
			
    }   
	
    function action($action=null) {
		
	  $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	  if ($login!='yes') return null;	
	 
	  switch ($action) {
		  
		 case 'crmtree'        : $frame = $this->loadframe(null,'users');//,'560px'); /*menu call for one user dahsboard*/
								 $out = $this->window('e-CRM: '.GetReq('id'), null, $frame);
							     break; 		  

		 case 'crmstats'       : break;	  
	  
		 case 'cpcrmrun'       : if ($crm_module = GetReq('mod')) //module calls inside mod.showdetails 
									$out = 	_m($crm_module);		
							     break;  	  
			
		 case 'cpcrmmoduledtl' : break;	
		 case 'cpcrmdata'      : break; 
		 case 'cpcrmdashboard' : break;			 
		 case 'cpcrmdetails'   : $out = $this->moduleGrid(); break;	
		 case 'cpcrmshowcus'   : $out = $this->show(); break; 
		 case 'cpcrmshowusr'   : $out = $this->show(); break; 	 
		 case 'cpcrmcus'       :						
		 case 'cpcrmusers'     : break;					  
	     case 'cpcrm'          :
		 default               : $out = $this->crmMode();
	  }	 

	  return ($out);
    }
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}	

	protected function crmMode() {
		$mode = GetReq('mode') ? GetReq('mode') : 'contacts';
		
		$turl0 = seturl('t=cpcrm&mode=contacts');
		$turl1 = seturl('t=cpcrm&mode=users');
		$turl2 = seturl('t=cpcrm&mode=customers');		
		$turl3 = seturl('t=cpcrm&mode=ulist');
		$turl4 = seturl('t=cpcrm&mode=campaigns');
		$turl5 = seturl('t=cpcrm&mode=sales');
		$turl6 = seturl('t=cpcrm&mode=visitors');
		$button = $this->createButton(localize('_mode', getlocal()), 
										array(localize('_contacts', getlocal())=>$turl0,
										      localize('_users', getlocal())=>$turl1,
									  		  localize('_customers', getlocal())=>$turl2,
											  localize('_ulist', getlocal())=>$turl3,
											  localize('_campaigns', getlocal())=>$turl4,
											  localize('_sales', getlocal())=>$turl5,
											  localize('_visitors', getlocal())=>$turl6,
		                                ));
													

		switch ($mode) {
			case 'visitors' :   $content = $this->visitors_grid(null,140,5,'r', true); break;
			case 'sales'    :   $content = $this->sales_grid(null,140,5,'r', true); break;
			case 'contacts' :	$content = $this->contacts_grid(null,140,5,'r', true); break;
			case 'customers':	$content = $this->customers_grid(null,140,5,'r', true); break;
			case 'ulist'    :   $content = $this->ulist_grid(null,140,5,'e', true); break;
			case 'campaigns':   $content = $this->campaigns_grid(null,140,5,'r', true); break;			
			case 'users'    :   
			default         :   $content = $this->users_grid(null,140,5,'r', true); break;
		}			
					
		$ret = $this->window('e-CRM: '.localize('_'.$mode, getlocal()), $button, $content);
		
		return ($ret);
	}

	protected function show() {
		$id = GetReq('id');
		//$ret = 'ID:' . $id; //some 1st line message
		
		//$ret = $this->loadsubframe(null,'transactions'); //default action
		$ret = $this->loadsubframe(null,'dashboard', true); //default action
		
		return ($ret);
	}	

	protected function loadframe($ajaxdiv=null, $mode=null, $height=null) {
		$id = GetParam('id');
		$cmd = ($mode=='customers') ? 'cpcrmshowcus&id='.$id : 'cpcrmshowusr&id='.$id;
		$bodyurl = seturl("t=$cmd&iframe=1");
		$ht = $height ? $height : '460px';
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"$ht\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}	

	protected function loadsubframe($ajaxdiv=null, $mode=null, $isdashboard=false) {
		$module = $mode ? $mode : GetParam('module'); //module details
		$id = GetParam('id'); //crm email

		if (($isdashboard) || ($module=='dashboard'))
			$bodyurl = seturl("t=cpcrmdashboard&iframe=1&id=$id&module=$module");
		else
			$bodyurl = seturl("t=cpcrmdetails&iframe=1&id=$id&module=$module");
	
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"460px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}
	
	protected function moduleGrid($mode=null) {
		$module = $mode ? $mode : GetReq('module'); //details id
		
		/*
		$method = $module . '_grid';
		if (method_exists($this, $method)) 
			$ret = $this->$method(null,280,11,'r', true);
		else {*/
			//crm module
			$class = 'crm' . $module;
			$method = $module . '_grid'; 
			$ret = _m("$class.$method use +360+15+r+1");
		//}	
		
		return ($ret);
	}		

	protected function moduleGridDetails() {
		$data = GetReq('data') ;
		$module = GetReq('module'); 
		//return ('>'.$module . ":" . $data. ':test');
		
		$class = 'crm' . $module;
		$method = 'showdetails'; 
		$ret = _m("$class.$method use $data");		
		
		return ($ret);
	}
	
	/*search for email based on ip*/
	protected function resolveIP($ip=null)	{
		if (!$ip) return false;
		$db = GetGlobal('db');
        $year = GetParam('year') ? GetParam('year') : date('Y'); 
	    $month = GetParam('month') ? GetParam('month') : date('m');

		//into current date range
		//$timein = _m('rccontrolpanel.sqlDateRange use date+1+1');
		
		//back one month from now
		//$timein = "AND DATE(date) BETWEEN DATE( DATE_SUB( NOW() , INTERVAL 30 DAY ) ) AND DATE ( NOW() ) ";		
		
		//back 60 days from date/month max selected
		if ($daterange = GetParam('rdate')) {
			$range = explode('-',$daterange);
			$dend = str_replace('/','-',trim($range[1]));
			$fromDate = "STR_TO_DATE('$dend','%m-%d-%Y')";			
		}	
		elseif (($m = GetReq('month')) && ($m!=date('m'))) {
			$y = GetReq('year') ? GetReq('year') : date('Y');
			$daysofmonth = cal_days_in_month(CAL_GREGORIAN, $m, $y);
			$fromDate = "'$y-$m-$daysofmonth'";
		}	
		else 
			$fromDate = "NOW()";	
		
		$timein = "AND DATE(date) BETWEEN DATE( DATE_SUB( $fromDate , INTERVAL 60 DAY ) ) AND DATE ( $fromDate ) ";
				
		$sSQL = "SELECT attr2,attr3 FROM stats where REMOTE_ADDR='$ip' $timein order by id desc"; 
		//echo $sSQL;
        $result = $db->Execute($sSQL);
		if (!$result) return false;

		foreach ($result as $i=>$rec) {
			if (filter_var($rec[0], FILTER_VALIDATE_EMAIL))
				return $rec[0];
			elseif (filter_var($rec[1], FILTER_VALIDATE_EMAIL))
				return $rec[1];
		}		
		
		return false;
	}	
	
    protected function visitors_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
		$db = GetGlobal('db'); 
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_visitors', getlocal());		

		$recognize = true;
		$resolve = false;
		$limit = ($recognize) ? null : ( $resolve ? " LIMIT 5000" : " LIMIT 500" ); //????
		
		$cpGet = _v('rcpmenu.cpGet');
		
		
        if ($id = $cpGet['id']) {
			$cat = $cpGet['cat'];
			$timein = $this->sqlDateRange('date', true, true);
			$sSQL = "SELECT id,date,DATE_FORMAT(date, '%d-%m-%Y') as day,attr2,attr3,REMOTE_ADDR FROM stats where (tid='$id' OR attr1='$cat') $timein group by day,attr2,attr3,REMOTE_ADDR order by id desc " . $limit;
		}
		elseif ($cat = $cpGet['cat']) {
			$timein = $this->sqlDateRange('date', true, true);
			$sSQL = "SELECT id,date,DATE_FORMAT(date, '%d-%m-%Y') as day,attr2,attr3,REMOTE_ADDR FROM stats where attr1='$cat' $timein group by day,attr2,attr3,REMOTE_ADDR order by id desc " . $limit;
		}
		else {
			$timein = $this->sqlDateRange('date', true, false);
			$sSQL = "SELECT id,date,DATE_FORMAT(date, '%d-%m-%Y') as day,attr2,attr3,REMOTE_ADDR FROM stats where $timein group by day,attr2,attr3,REMOTE_ADDR order by id desc " . $limit;
		}
		//echo $sSQL;	
        $result = $db->Execute($sSQL);
		
        $vis = array();
		foreach ($result as $i=>$rec) {
			$rtokens = array();
			$resolved = null;
			
			$visitor = filter_var($rec['attr3'], FILTER_VALIDATE_EMAIL) ? $rec['attr3'] : 
						( filter_var($rec['attr2'], FILTER_VALIDATE_EMAIL) ? $rec['attr2'] : $rec['REMOTE_ADDR']);
						
			if (($recognize) && (!filter_var($visitor, FILTER_VALIDATE_EMAIL))) 
				continue;		
			elseif (($resolve) && (filter_var($visitor, FILTER_VALIDATE_IP))) {
				$resolved = $this->resolveIP($visitor);		
				if (!filter_var($resolved, FILTER_VALIDATE_EMAIL)) continue;
			}

			$vis[] = $visitor;
		}
		//print_r($vis);
		if (!empty($vis)) {
			$rvis = implode("','", $vis); 
			$uSQL = "WHERE email in ('" . $rvis . "')"; 
		}
		else
			$uSQL = "WHERE email = ''"; //dummy null		
		  		
		
		$xsSQL = "select * from (";
		$xsSQL.= "SELECT id,startdate,datein,active,failed,name,email,listname FROM ulists " . $uSQL;
		$xsSQL .= ') as o'; 
		
		_m("mygrid.column use grid1+id|".localize('_id',getlocal())."|5|0");
        _m("mygrid.column use grid1+email|".localize('_mail',getlocal())."|link|10|"."javascript:udetails(\"{email}\");".'||');
        _m("mygrid.column use grid1+startdate|".localize('_dateins',getlocal()).'|10|0');		   
		_m("mygrid.column use grid1+datein|".localize('_dateupd',getlocal())."|10|0|");			
        _m("mygrid.column use grid1+name|".localize('_lname',getlocal()).'|19|1');	
		_m("mygrid.column use grid1+active|".localize('_active',getlocal()).'|boolean|0');	
		_m("mygrid.column use grid1+failed|".localize('_failed',getlocal()).'|5|0');	
		_m("mygrid.column use grid1+listname|".localize('_listname',getlocal()).'|10|0');			
		   		
		$out = _m("mygrid.grid use grid1+users+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  		
		
		//echo $xsSQL;  
		return ($ret);		
	}	
	
	protected function contacts_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_contacts', getlocal()); 
		
        $xsSQL = "SELECT * from (select id,date,udate,code,type,email,firstname,lastname,address,country,birthday,occupation,mobile,phone,skype,website,facebook,twitter from crmcontacts) o ";		   
		   
		_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|||1");	
		_m("mygrid.column use grid1+date|".localize('_date',getlocal())."|5|0|");	   
		_m("mygrid.column use grid1+udate|".localize('_date',getlocal())."|5|1|");		
		_m("mygrid.column use grid1+code|".localize('_code',getlocal())."|5|1|");		
		_m("mygrid.column use grid1+type|".localize('_type',getlocal())."|2|1|");
		_m("mygrid.column use grid1+email|".localize('_email',getlocal())."|10|1|");
		_m("mygrid.column use grid1+firstname|".localize('_firstname',getlocal())."|link|10|"."javascript:udetails(\"{email}\");".'||');						
		_m("mygrid.column use grid1+lastname|".localize('_lastname',getlocal())."|link|10|"."cpcrmtrace.php?t=cpcrmprofile&v={email}".'||');
		_m("mygrid.column use grid1+adderss|".localize('_address',getlocal())."|5|1|");
		_m("mygrid.column use grid1+country|".localize('_country',getlocal())."|5|1|");
		_m("mygrid.column use grid1+birthday|".localize('_birthday',getlocal())."|5|1|");
		_m("mygrid.column use grid1+occupation|".localize('_occupation',getlocal())."|5|1|");
		_m("mygrid.column use grid1+mobile|".localize('_tel',getlocal())."|5|1|");
		_m("mygrid.column use grid1+phone|".localize('_tel',getlocal())."|5|1|");
		_m("mygrid.column use grid1+skype|".localize('Skype',getlocal())."|5|1|");
		_m("mygrid.column use grid1+website|".localize('Website',getlocal())."|link|5|"."{website}".'||');		
		_m("mygrid.column use grid1+facebook|".localize('Facebook',getlocal())."|link|5|"."{facebook}".'||');			
		_m("mygrid.column use grid1+twitter|".localize('Twitter',getlocal())."|link|5|"."{twitter}".'||');
		   
		$out = _m("mygrid.grid use grid1+crmcontacts+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  
	}	
	
	public function sales_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected_cus = urldecode(GetReq('id'));
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_sales',getlocal());  
	
	    if (defined('MYGRID_DPC')) {
			
			$lookup1 = "ELT(FIELD(i.payway, 'Eurobank','Piraeus','Paypal','BankTransfer','PayOnsite','PayOndelivery'),".
			                      "'".localize('Eurobank',getlocal())."',".
								  "'".localize('Piraeus',getlocal())."',".
								  "'".localize('Paypal',getlocal())."',".
			                      "'".localize('BankTransfer',getlocal())."',".
								  "'".localize('PayOnsite',getlocal())."',".
								  "'".localize('PayOndelivery',getlocal())."') as pw";			
								  
			$lookup2 = "ELT(FIELD(i.roadway, 'CompanyDelivery','CustomerDelivery','Logistics','Courier'),".
				                  "'".localize('CompanyDelivery',getlocal())."',".
					   		      "'".localize('CustomerDelivery',getlocal())."',".
								  "'".localize('Logistics',getlocal())."',".
								  "'".localize('Courier',getlocal())."') as rw";								  
		
			$xsSQL2 = "SELECT * FROM (SELECT i.recid,i.tid,i.cid,i.timein,i.tdate,i.ttime,i.tstatus,$lookup1,$lookup2,i.qty,i.cost,i.costpt FROM transactions i) x";
				//echo $xsSQL2;

			_m("mygrid.column use grid3+recid|".localize('id',getlocal())."|5|0|||1|1");
			_m("mygrid.column use grid3+tid|".localize('id',getlocal())."|link|5|"."javascript:showdetails({tid});".'||');
			_m("mygrid.column use grid3+cid|".localize('_user',getlocal())."|10|0|");			
			_m("mygrid.column use grid3+timein|".localize('_date',getlocal())."|10|0|");
		    //_m("mygrid.column use grid3+ttime|".localize('_time',getlocal())."|9|0|");	
			_m("mygrid.column use grid3+tstatus|".localize('_status',getlocal())."|2|0|||||right");	
		    _m("mygrid.column use grid3+pw|".localize('_payway',getlocal())."|link|20|"."javascript:udetails(\"{cid}\");".'||');		
		    _m("mygrid.column use grid3+rw|".localize('_roadway',getlocal())."|link|20|"."cpcrmtrace.php?t=cpcrmprofile&v={cid}".'||');
	        _m("mygrid.column use grid3+qty|".localize('_qty',getlocal())."|5|0|||||right");				
			_m("mygrid.column use grid3+cost|".localize('_cost',getlocal())."|5|0|||||right");
			_m("mygrid.column use grid3+costpt|".localize('_costpt',getlocal())."|5|0|||||right");
			
			$ret .= _m("mygrid.grid use grid3+transactions+$xsSQL2+$mode+$title+recid+$noctrl+1+$rows+$height+$width+0+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	
	
	protected function users_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_users', getlocal());
		
        $xsSQL = "SELECT * from (select id,timein,code2,ageid,cntryid,lanid,timezone,email,notes,fname,lname,username,seclevid from users) o ";		   
		   
		_m("mygrid.column use grid1+id|".localize('id',getlocal())."|5|0|||1");	
		_m("mygrid.column use grid1+timein|".localize('_date',getlocal())."|5|0|");	   
		_m("mygrid.column use grid1+notes|".localize('_active',getlocal())."|5|1|");
		_m("mygrid.column use grid1+username|".localize('_username',getlocal())."|link|10|"."javascript:udetails(\"{username}\");".'||');						
		_m("mygrid.column use grid1+fname|".localize('_fname',getlocal())."|19|1|");
		_m("mygrid.column use grid1+lname|".localize('_lname',getlocal())."|19|1|");
		_m("mygrid.column use grid1+ageid|".localize('_age',getlocal())."|2|1|");
		_m("mygrid.column use grid1+cntryid|".localize('_country',getlocal())."|2|1|");
		_m("mygrid.column use grid1+lanid|".localize('_language',getlocal())."|2|1|");
		_m("mygrid.column use grid1+timezone|".localize('_timezone',getlocal())."|2|1|");
		_m("mygrid.column use grid1+email|".localize('_email',getlocal())."|link|10|"."cpcrmtrace.php?t=cpcrmprofile&v={email}".'||');
		_m("mygrid.column use grid1+code2|".localize('_code',getlocal())."|10|0|");			
		_m("mygrid.column use grid1+seclevid|".localize('_level',getlocal())."|5|1|");
		   
		$out = _m("mygrid.grid use grid1+users+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}
	
	protected function customers_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_'.GetReq('mode'), getlocal());//localize('RCCRM_DPC',getlocal()); 	
		
		$xsSQL = "SELECT * FROM (SELECT id,timein,active,code2,name,afm,eforia,prfdescr,street,address,number,area,city,zip,voice1,voice2,fax,mail,attr1,attr2,attr3,attr4 FROM customers) x";
		//$out.= $xsSQL;
		_m("mygrid.column use grid2+id|".localize('id',getlocal())."|5|0|||1");
		_m("mygrid.column use grid2+timein|".localize('_date',getlocal()). "|5|0|");
		_m("mygrid.column use grid2+active|".localize('_active',getlocal())."|boolean|1|");	
		_m("mygrid.column use grid2+code2|".localize('_code2',getlocal())."|link|10|"."cpcrmtrace.php?t=cpcrmprofile&v={code2}".'||');
		_m("mygrid.column use grid2+mail|".localize('_mail',getlocal())."|link|10|"."javascript:cdetails(\"{mail}\");".'||');		
		_m("mygrid.column use grid2+name|".localize('_name',getlocal())."|19|1|");
		_m("mygrid.column use grid2+prfdescr|".localize('_prfdescr',getlocal())."|20|1|");			
		_m("mygrid.column use grid2+afm|".localize('_afm',getlocal())."|10|1|");
	    _m("mygrid.column use grid2+eforia|".localize('_doy',getlocal())."|10|1|");				
		_m("mygrid.column use grid2+street|".localize('_street',getlocal())."|19|1|");
		_m("mygrid.column use grid2+address|".localize('_address',getlocal())."|10|1");
		_m("mygrid.column use grid2+number|".localize('_number',getlocal())."|5|1|");
		_m("mygrid.column use grid2+area|".localize('_area',getlocal())."|10|1|");
		_m("mygrid.column use grid2+city|".localize('_city',getlocal())."|10|1|");			
		_m("mygrid.column use grid2+zip|".localize('_zip',getlocal())."|10|1|");
		_m("mygrid.column use grid2+voice1|".localize('_tel',getlocal())."|10|1|");
		_m("mygrid.column use grid2+voice2|".localize('_tel',getlocal())."|10|1|");			
		_m("mygrid.column use grid2+fax|".localize('_fax',getlocal())."|10|1|");			
		_m("mygrid.column use grid2+attr1|".localize('_attr1',getlocal())."|5|1|");
		_m("mygrid.column use grid2+attr2|".localize('_attr2',getlocal())."|5|1|");							
		_m("mygrid.column use grid2+attr3|".localize('_attr3',getlocal())."|5|1|");
		_m("mygrid.column use grid2+attr4|".localize('_attr4',getlocal())."|5|1|");
		
		$out = _m("mygrid.grid use grid2+customers+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}

	protected function ulist_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_'.GetReq('mode'), getlocal());//localize('RCCRM_DPC',getlocal()); 
		
		$xsSQL = "select * from (";
		$xsSQL.= "SELECT id,startdate,datein,active,failed,name,email,listname FROM ulists";
		$xsSQL .= ') as o';
		
		_m("mygrid.column use grid1+id|".localize('_id',getlocal())."|5|0");
        _m("mygrid.column use grid1+email|".localize('_mail',getlocal())."|link|10|"."javascript:udetails(\"{email}\");".'||');
        _m("mygrid.column use grid1+startdate|".localize('_dateins',getlocal()).'|10|0');		   
		_m("mygrid.column use grid1+datein|".localize('_dateupd',getlocal())."|10|0|");			
        _m("mygrid.column use grid1+name|".localize('_lname',getlocal()).'|19|1');	
		_m("mygrid.column use grid1+active|".localize('_active',getlocal()).'|boolean|0');	
		_m("mygrid.column use grid1+failed|".localize('_failed',getlocal()).'|5|0');	
		_m("mygrid.column use grid1+listname|".localize('_listname',getlocal()).'|10|0');			
		   
		$out = _m("mygrid.grid use grid1+ulists+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}	
	
	protected function campaigns_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_'.GetReq('mode'), getlocal());//localize('RCCRM_DPC',getlocal()); 
				   
		$xsSQL = "SELECT * from (select id,timein,receiver,subject,reply,status,mailstatus,cid from mailqueue) o ";		   
		   
		_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|||1");
		_m("mygrid.column use grid1+timein|".localize('_date',getlocal())."|5|0|");	   
		_m("mygrid.column use grid1+receiver|".localize('_mail',getlocal())."|link|10|"."javascript:udetails(\"{receiver}\");".'||');						
		_m("mygrid.column use grid1+subject|".localize('_subject',getlocal())."|19|1|");
		_m("mygrid.column use grid1+reply|".localize('_reply',getlocal())."|2|1|");
		_m("mygrid.column use grid1+status|".localize('_status',getlocal())."|2|1|");
		_m("mygrid.column use grid1+mailstatus|".localize('_failed',getlocal())."|2|1|");
		_m("mygrid.column use grid1+cid|".localize('_cid',getlocal())."|10|1|");
		   
		$out = _m("mygrid.grid use grid1+mailqueue+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}	
	
	protected function createButton($name=null, $urls=null, $t=null, $s=null) {
		$type = $t ? $t : 'primary'; //danger /warning / info /success
		switch ($s) {
			case 'large' : $size = 'btn-large '; break;
			case 'small' : $size = 'btn-small '; break;
			case 'mini'  : $size = 'btn-mini '; break;
			default      : $size = null;
		}
		
		//$ret = "<button class=\"btn  btn-primary\" type=\"button\">Primary</button>";
		
		if (!empty($urls)) {
			foreach ($urls as $n=>$url)
				$links .= '<li><a href="'.$url.'">'.$n.'</a></li>';
			$lnk = '<ul class="dropdown-menu">'.$links.'</ul>';
		} 
		
		$ret = '
			<div class="btn-group">
                <button data-toggle="dropdown" class="btn '.$size.'btn-'.$type.' dropdown-toggle">'.$name.' <span class="caret"></span></button>
                '.$lnk.'
            </div>'; 
			
		return ($ret);
	}

	protected function window($title, $buttons, $content) {
		$ret = '	
		    <div class="row-fluid">
                <div class="span12">
                  <div class="widget red">
                        <div class="widget-title">
                           <h4><i class="icon-reorder"></i> '.$title.'</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                        </div>
                        <div class="widget-body">
							<div class="btn-toolbar">
							'. $buttons .'
							<hr/><div id="crmdetails"></div>
							</div>
							'.  $content .'
                        </div>
                  </div>
                </div>
            </div>
';
		return ($ret);
	}	
	
	public function actionTree() {
		$user = GetReq('id');
		if (!$user) return false;		
		
		$id = GetReq('id') ? "&id=" . $user : null ;
		
		$l = getlocal();
		$t_plus = localize('_plus', $l);
		$t_auto = localize('_automations', $l);
		$t_projects = localize('_projects', $l);
		$t_actions = localize('_actions', $l);
		$t_events = localize('_events', $l);
		$t_docs = localize('_docs', $l);
		$t_behaviors = localize('_behaviors', $l);
		
		$crmplustree = $this->crmplus ? '
										<li>
											<a data-value="gh_Repos" data-toggle="branch" class="tree-toggle closed" role="branch" href="#">'.$t_plus.'</a>
                                            <ul class="branch">
											<li><a href="javascript:subdetails(\'docs'.$id.'\')"><i class="icon-book"></i>'.$t_docs.'</a></li>
											<li><a href="javascript:subdetails(\'events'.$id.'\')"><i class="icon-book"></i>'.$t_events.'</a></li>
											<li><a href="javascript:subdetails(\'actions'.$id.'\')"><i class="icon-book"></i>'.$t_actions.'</a></li>
                                            <li><a href="javascript:subdetails(\'plus'.$id.'\')"><i class="icon-tasks"></i>'.$t_projects.'</a></li>
											<li><a data-role="leaf" href="#"><i class="icon-magic"></i> '.$t_behaviors.'</a></li>
                                            <li>
                                                <a data-value="GitHub_Repos" data-toggle="branch" class="tree-toggle closed" role="branch" href="#">'.$t_auto.'</a>
                                                <ul class="branch">
                                                    <li><a href="#">Events</a></li>
                                                    <li><a href="#">Users</a></li>
                                                    <li><a href="#">Feedbacks</a></li>
                                                    <li><a href="#">Reports</a></li>
                                                    <li><a href="#">Sales</a></li>
                                                    <li><a href="#">Revenue</a></li>
                                                </ul>
                                            </li></ul>
                                        </li>' : null;		
										
										
		$t_dashboard = localize('_crmdashb', $l);
		$t_inbox = localize('_inbox', $l);
		$t_outbox = localize('_outbox', $l);
		$t_details = localize('_details', $l);
		$t_sales = localize('_sales', $l);
		$t_tasks = localize('_tasks', $l);
		$t_stats = localize('_stats', $l);
		$t_purchases = localize('_purchases', $l);
		$t_wishlist = localize('_wishlist', $l);		
		$t_compares = localize('_compares', $l);
		$t_favorites = localize('_favorites', $l);
		$t_views = localize('_views', $l);
		$t_returns = localize('_returns', $l);	
		$t_offers = localize('_offers', $l);
		$t_templates = localize('_templates', $l);
		$t_forms = localize('_forms', $l);	
		$t_attach = localize('_attach', $l);
		$t_view = localize('_view', $l);
		$t_reports = localize('_reports', $l);
		$t_finance = localize('_finance', $l);		
		$t_items = localize('_items', $l);
		
		$ret = '	
                            <!--div class="actions">
                                <a class="btn btn-small btn-success" id="tree_2_collapse" href="javascript:;"> Collapse All</a>
                                <a class="btn btn-small btn-warning" id="tree_2_expand" href="javascript:;"> Expand All</a>
                            </div>
                            <div class="space10"></div-->
                            <ul id="tree_2" class="tree">
                                <li>
                                    <a data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle" data-role="branch" href="#">'.substr($user, 0, 9).'</a>
                                    <ul class="branch in">
										<li><a data-role="leaf" href="javascript:subdetails(\'dashboard'.$id.'\')"><i class="icon-user"></i> '.$t_dashboard.'</a></li>
                                        <li><a data-role="leaf" href="javascript:subdetails(\'inbox'.$id.'\')"><i class=" icon-book"></i> '.$t_inbox.'</a></li>
										<li><a data-role="leaf" href="javascript:subdetails(\'outbox'.$id.'\')"><i class=" icon-book"></i> '.$t_outbox.'</a></li>
                                        <li><a data-role="leaf" href="javascript:subdetails(\'customer'.$id.'\')"><i class="icon-share"></i> '.$t_details.'</a></li>										
                                        <li><a data-role="leaf" href="javascript:subdetails(\'transactions'.$id.'\')"><i class=" icon-bullhorn"></i> '.$t_sales.'</a></li>
                                        <li><a data-role="leaf" href="javascript:subdetails(\'tasks'.$id.'\')"><i class="icon-tasks"></i> '.$t_tasks.'</a></li>
										<li><a data-role="leaf" href="javascript:subdetails(\'stats'.$id.'\')"><i class="icon-share"></i> '.$t_stats.'</a></li>
										
                                        <li>
                                            <a id="nut6" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle closed" href="#">
                                                '.$t_items.'
                                            </a>
                                            <ul class="branch">											
                                                <li><a data-role="leaf" href="javascript:subdetails(\'purchases'.$id.'\')"><i class="icon-tags"></i> '.$t_purchases.'</a></li>
												<li><a data-role="leaf" href="javascript:subdetails(\'wishlist'.$id.'\')"><i class="icon-tags"></i> '.$t_wishlist.'</a></li>
												<li><a data-role="leaf" href="javascript:subdetails(\'wishcmp'.$id.'\')"><i class="icon-tags"></i> '.$t_compares.'</a></li>
												<li><a data-role="leaf" href="javascript:subdetails(\'wishfav'.$id.'\')"><i class="icon-tags"></i> '.$t_favorites.'</a></li>
												<li><a data-role="leaf" href="javascript:subdetails(\'itemstats'.$id.'\')"><i class="icon-tags"></i> '.$t_views.'</a></li>												
                                                <li><a data-role="leaf" href="javascript:subdetails(\'docsitem'.$id.'\')"><i class="icon-tags"></i> '.$t_offers.'</a></li>
                                                <li><a data-role="leaf" href="javascript:subdetails(\'returns'.$id.'\')"><i class="icon-tags"></i> '.$t_returns.'</a></li>												
                                            </ul>
                                        </li>
										
										'.$crmplustree.'		
										<!--li>
                                            <a id="nut3" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle closed" href="#">
                                                '.$t_templates.'
                                            </a>
                                            <ul class="branch">
                                                <li><a data-role="leaf" href="javascript:subdetails(\'forms'.$id.'\')"><i class="icon-cloud"></i> '.$t_forms.'</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-user-md"></i> '.$t_attach.'</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-retweet"></i> '.$t_view.'</a></li>
                                            </ul>
                                        </li-->
										<li><a data-role="leaf" href="javascript:subdetails(\'reports'.$id.'\')"><i class="icon-tags"></i> '.$t_reports.'</a></li>
										<li><a data-role="leaf" href="javascript:subdetails(\'forms'.$id.'\')"><i class="icon-cloud"></i> '.$t_forms.'</a></li>
                                        <!--li>
                                            <a id="nut8" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle closed" href="#">
                                                '.$t_reports.'
                                            </a>
                                            <ul class="branch">
                                                <li><a data-role="leaf" href="#"><i class="icon-tags"></i> '.$t_finance.'</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-magic"></i> ICT</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-user"></i> Human Resources</a></li>
                                            </ul>
                                        </li-->										
                                    </ul>
                                </li>
                            </ul>		
';
		return ($ret);
	}
		

	public function actionTree2() {
		$ret = '
                            <div class="actions">
                                <a class="btn btn-small btn-success" id="tree_1_collapse" href="javascript:;"> Collapse All</a>
                                <a class="btn btn-small btn-warning" id="tree_1_expand" href="javascript:;"> Expand All</a>
                            </div>
                            <div class="space10"></div>
                            <ul id="tree_1" class="tree">
                                <li>
                                    <a data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle" data-role="branch" href="#">
                                        Bootstrap Tree
                                    </a>
                                    <ul class="branch in">
                                        <li>
                                            <a id="nut1" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle" href="#">
                                                Documents
                                            </a>
                                            <ul class="branch in">
                                                <li>
                                                    <a id="nut2" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle closed" href="#">
                                                        Finance
                                                    </a>
                                                    <ul class="branch">
                                                        <li><a data-role="leaf" href="#"><i class="icon-book"></i> Sale Revenue</a></li>
                                                        <li><a data-role="leaf" href="#"><i class="icon-fire"></i> Promotions</a></li>
                                                        <li><a data-role="leaf" href="#"><i class="icon-edit"></i> IPO</a></li>
                                                    </ul>
                                                </li>
                                                <li><a data-role="leaf" href="#"><i class="icon-magic"></i> ICT</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-user"></i> Human Resources</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a id="nut3" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle closed" href="#">
                                                Examples
                                            </a>
                                            <ul class="branch">
                                                <li><a data-role="leaf" href="#"><i class="icon-cloud"></i> Internal</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-user-md"></i> Client Base</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-retweet"></i> Product Base</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a id="nut4" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle" href="#">
                                                Tasks
                                            </a>
                                            <ul class="branch in">
                                                <li><a data-role="leaf" href="#"><i class="icon-suitcase"></i> Internal Projects</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-cloud-download"></i> Outsourcing</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-sitemap"></i> Bug Tracking</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a id="nut6" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle closed" href="#">
                                                Customers
                                            </a>
                                            <ul class="branch">
                                                <li><a data-role="leaf" href="#"><i class="icon-tags"></i> Finance</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-magic"></i> ICT</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-user"></i> Human Resources</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a id="nut8" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle closed" href="#">
                                                Reports
                                            </a>
                                            <ul class="branch">
                                                <li><a data-role="leaf" href="#"><i class="icon-tags"></i> Finance</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-magic"></i> ICT</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-user"></i> Human Resources</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a data-role="leaf" href="#">
                                                <i class="icon-share"></i> External Link
                                            </a>
                                        </li>
                                        <li>
                                            <a data-role="leaf" href="#">
                                                <i class="icon-share"></i> Another External Link
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
';
		return ($ret);
	}
	
    public function select_timeline($template,$year=null, $month=null) {
		$user = urldecode(GetReq('id'));
		$year = GetParam('year') ? GetParam('year') : date('Y'); 
	    $month = GetParam('month') ? GetParam('month') : date('m');
		$daterange = GetParam('rdate');
		
		$t = ($template!=null) ? _m("cmsrt.select_template use $template+1") : null;		
	    if ($t) {
			for ($y=(date('Y')-2); $y<=intval(date('Y')); $y++) {
				$yearsli .= '<li>'. seturl("t=crmstats&id=$user&month=".$month.'&year='.$y, $y) .'</li>';
			}
		
			for ($m=1;$m<=12;$m++) {
				$mm = sprintf('%02d',$m);
				$monthsli .= '<li>' . seturl("t=crmstats&id=$user&month=".$mm.'&year='.$year, $mm) .'</li>';
			}	  
	  
	        $posteddaterange = $daterange ? ' &gt; ' . $daterange : ($year ? ' &gt; ' . $month . ' ' . $year : null) ;
	  
			$tokens[] = localize('RCCRM_DPC', getlocal()) . ' &gt; ' . localize('_crmdashb', getlocal()) . ' ' . $posteddaterange;
			$tokens[] = $year;
			$tokens[] = $month;
			$tokens[] = localize('_year',getlocal());
			$tokens[] = $yearsli;
			$tokens[] = localize('_month',getlocal());			
			$tokens[] = $monthsli;	
            $tokens[] = $daterange;			
		
			$ret = $this->combine_tokens($t, $tokens); 				
     
			return ($ret);
		}
		
		return null;	
    }	

	protected function sqlDateRange($fieldname, $istimestamp=false, $and=false) {
		$sqland = $and ? ' AND' : null;
		if ($daterange = GetParam('rdate')) {//post
			$range = explode('-',$daterange);
			$dstart = str_replace('/','-',trim($range[0]));
			$dend = str_replace('/','-',trim($range[1]));
			if ($istimestamp)
				$dateSQL = $sqland . " DATE($fieldname) BETWEEN STR_TO_DATE('$dstart','%m-%d-%Y') AND STR_TO_DATE('$dend','%m-%d-%Y')";
			else			
				$dateSQL = $sqland . " $fieldname BETWEEN STR_TO_DATE('$dstart','%m-%d-%Y') AND STR_TO_DATE('$dend','%m-%d-%Y')";			
		}				
		elseif ($y = GetReq('year')) {
			if ($m = GetReq('month')) { $mstart = $m; $mend = $m;} else { $mstart = '01'; $mend = '12';}
			$daysofmonth = cal_days_in_month(CAL_GREGORIAN, $m, $y);
			
			if ($istimestamp)
				$dateSQL = $sqland . " DATE($fieldname) BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";
			else
				$dateSQL = $sqland . " $fieldname BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";		
		}	
        else {
			//$dateSQL = null; 
			
			//always this year by default
			//$mstart = '01'; $mend = '12';
			//always this month by default
			$mstart = date('m'); $mend = date('m');
			$y = date('Y');
			$daysofmonth = date('t');
			
			if ($istimestamp)
				$dateSQL = $sqland . " DATE($fieldname) BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";
			else
				$dateSQL = $sqland . " $fieldname BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";	
            //echo $dateSQL;			
		}	
		
		return ($dateSQL);
	}	
	
	protected function nformat($n, $dec=0) {
		return (number_format($n,$dec,',','.'));
	}
	
	public function getStats($section=null, $subsection=null) {
		if (!$section) return 0;
		$sb = $subsection ? $subsection : 'value';
		return ($this->crmstats[$section][$sb]);
	}		
	
    protected function crm_stats() {
        $db = GetGlobal('db');		
		
		$origin = "origin='crm' and ";
		$timein = $this->sqlDateRange('timein', true);
		
		$sSQL = "select count(id) from mailqueue where $origin and active=0 and " . $timein; 
		$res = $db->Execute($sSQL);
		$this->crmstats['outbox']['sent'] = $this->nformat($res->fields[0]);
		/*
		$sSQL = "select count(id) from mailqueue where $origin active=0 and status<0 and " . $timein; 
		$res = $db->Execute($sSQL);
		$this->crmstats['outbox']['failed'] = $this->nformat($res->fields[0]);	
        */
		$sSQL = "select count(id) from mailqueue where $origin active=1 and " . $timein; 
		$res = $db->Execute($sSQL);
		$this->crmstats['outbox']['value'] = $this->nformat($res->fields[0]);
		
		
		$sSQL = "select count(id) from cform where " . $this->sqlDateRange('date', true); 
		$res = $db->Execute($sSQL);
		$this->crmstats['inbox']['value'] = $this->nformat($res->fields[0]);		

		$date = $this->sqlDateRange('date', true);
		$sSQL = "select count(id) from stats where ref IS NOT NULL and " . $date; 
		$res = $db->Execute($sSQL);
		$this->crmstats['stats']['clicks'] = $this->nformat($res->fields[0]);	
		
		//$sSQL = "select count(id) from stats where attr2='$user' or attr3='$user'";
		//$sSQL.= " and " . $date; 
		//$res = $db->Execute($sSQL);
		//$this->crmstats['stats']['pageview'] = $this->nformat($res->fields[0]);		
		
		
		$timein = $this->sqlDateRange('timein', true);
		
		$sSQL = "select count(recid) from transactions where " . $timein; 
		$res = $db->Execute($sSQL);
		$this->crmstats['transactions']['value'] = $this->nformat($res->fields[0]);	

		$sSQL = "select sum(costpt) from transactions where " . $timein; 
		$res = $db->Execute($sSQL);
		$this->crmstats['transactions']['sales'] = $this->nformat($res->fields[0],2);

		
		$sSQL = "select count(id) from crmdocs where " . $this->sqlDateRange('date', true); 
		$res = $db->Execute($sSQL);
		$this->crmstats['crmdocs']['value'] = $this->nformat($res->fields[0]);	

		$sSQL = "select count(id) from users where " . $this->sqlDateRange('timein', true); 
		$res = $db->Execute($sSQL);
		$this->crmstats['contacts']['users'] = $this->nformat($res->fields[0]);	

		$sSQL = "select count(id) from crmcontacts where " . $this->sqlDateRange('date', true); 
		$res = $db->Execute($sSQL);
		$this->crmstats['contacts']['value'] = $this->nformat($res->fields[0]);			
		
		return true;
	}	

	public function itemsPurchased() {
       $db = GetGlobal('db');
	   $user = urldecode(GetReq('id'));
	   $ret = array();
	   
	   //search serialized data for id
	   $sSQL = "select tdata from transactions where " . $this->sqlDateRange('timein', true, false);
       $result = $db->Execute($sSQL,2);
	   //echo $sSQL;
	   
	   foreach ($result as $n=>$rec) {	
         $tdata = $rec['tdata'];
		 
		 if ($tdata) {
		   $cdata = unserialize($tdata);
		   if (is_array($cdata)) { //(count($cdata)>1) {//if many items
		     foreach ($cdata as $i=>$buffer_data) {
		        $param = explode(";",$buffer_data);
				if (!in_array($param[0],$ret))  
					$ret[] = $param[0];  
		     }	 
		   }
		 } 
	   }
	   
	   return $this->nformat(count($ret));  	   	
	}

	public function itemsPurchasedQty() {
       $db = GetGlobal('db');
	   $user = urldecode(GetReq('id'));
	   $ret = 0;
	   
	   //search serialized data for id
	   $sSQL = "select tdata from transactions where " . $this->sqlDateRange('timein', true, false);
       $result = $db->Execute($sSQL,2);
	   //echo $sSQL;
	   
	   foreach ($result as $n=>$rec) {	
         $tdata = $rec['tdata'];
		 
		 if ($tdata) {
		   $cdata = unserialize($tdata);
		   if (is_array($cdata)) { //if (count($cdata)>1) {//if many items
		     foreach ($cdata as $i=>$buffer_data) {
		       $param = explode(";",$buffer_data);
		       $ret += $param[9];  
		     }	 
		   }
		 } 
	   }
	   
	   return $this->nformat($ret);   	   	
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
		  
		//echo $ret;
	    foreach ($tokens as $i=>$tok) {
            //echo $tok,'<br>';
		    $ret = str_replace("$".$i."$",$tok,$ret);
	    }
		//clean unused token marks
		for ($x=$i;$x<30;$x++)
		  $ret = str_replace("$".$x."$",'',$ret);
		//echo $ret;
		
		//execute after replace tokens
		if (($execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
		  $fp = new fronthtmlpage(null);
		  $retout = $fp->process_commands($ret);
		  unset ($fp);
          
		  return ($retout);
		}		
		
		return ($ret);
	}		
	
	public function charts() {
		
	}
	
	protected function writeLog($data = '') {
		if (empty($data)) return;

		$data = date('d-m-Y H:i:s')."\r\n" . $data . "\r\n----\r\n";
		$ret = file_put_contents($this->path . 'crm.log', $data, FILE_APPEND | LOCK_EX);
		
		return $ret;
	}	
};
}
?>