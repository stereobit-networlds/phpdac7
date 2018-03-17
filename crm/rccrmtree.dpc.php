<?php

$__DPCSEC['RCCRMTREE_DPC']='1;1;1;1;1;1;2;2;9;9;9';

if ( (!defined("RCCRMTREE_DPC")) && (seclevel('RCCRMTREE_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCCRMTREE_DPC",true);

$__DPC['RCCRMTREE_DPC'] = 'rccrmtree';


$__EVENTS['RCCRMTREE_DPC'][0]='cpcrmtree';
$__EVENTS['RCCRMTREE_DPC'][1]='cpcrmsavetree';
$__EVENTS['RCCRMTREE_DPC'][2]='cpcrmloadtree';
$__EVENTS['RCCRMTREE_DPC'][3]='cpcrmtreeframe';
$__EVENTS['RCCRMTREE_DPC'][4]='cpcrmtreeusers';

$__ACTIONS['RCCRMTREE_DPC'][0]='cpcrmtree';
$__ACTIONS['RCCRMTREE_DPC'][1]='cpcrmsavetree';
$__ACTIONS['RCCRMTREE_DPC'][2]='cpcrmloadtree';
$__ACTIONS['RCCRMTREE_DPC'][3]='cpcrmtreeframe';
$__ACTIONS['RCCRMTREE_DPC'][4]='cpcrmtreeusers';

$__LOCALE['RCCRMTREE_DPC'][0]='RCCRMTREE_DPC;e-CRM Tree;e-CRM Προσδιοριστικά χαρακτηριστικά';
$__LOCALE['RCCRMTREE_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['RCCRMTREE_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['RCCRMTREE_DPC'][3]='_active;Active;Ενεργό';
$__LOCALE['RCCRMTREE_DPC'][4]='_title;Title;Τίτλος';
$__LOCALE['RCCRMTREE_DPC'][5]='_descr;Description;Περιγραφή';
$__LOCALE['RCCRMTREE_DPC'][6]='_treedescr;Crm tree;Crm προσδιοριστικά χαρακτηριστικά';
$__LOCALE['RCCRMTREE_DPC'][7]='_treeattach;Map objects;Επισύναψη χαρακτηριστικού';
$__LOCALE['RCCRMTREE_DPC'][8]='_users;Users;Χρήστες';
$__LOCALE['RCCRMTREE_DPC'][9]='_mode;Select;Επιλογή';
$__LOCALE['RCCRMTREE_DPC'][10]='_search;Search;Αναζητήσιμο';
$__LOCALE['RCCRMTREE_DPC'][11]='_active;Active;Ενεργό';
$__LOCALE['RCCRMTREE_DPC'][12]='_view;Show;Εμφανές';
$__LOCALE['RCCRMTREE_DPC'][13]='_OK;Success;Επιτυχώς';
$__LOCALE['RCCRMTREE_DPC'][14]='_tree;Tree;Δέντρο';
$__LOCALE['RCCRMTREE_DPC'][15]='_leaf;Childs;Παιδιά';
$__LOCALE['RCCRMTREE_DPC'][16]='_rel;Relation;Σχέση';

$__LOCALE['RCCRMTREE_DPC'][17]='_birthday;Birthday;Ημ. γέννησης';
$__LOCALE['RCCRMTREE_DPC'][18]='_occupation;Occupation;Επάγγελμα';
$__LOCALE['RCCRMTREE_DPC'][19]='_reply;Replies;Απαντήσεις';
$__LOCALE['RCCRMTREE_DPC'][20]='_address;Address;Διεύθυνση';
$__LOCALE['RCCRMTREE_DPC'][21]='_tel;Tel.;Τηλέφωνο';
$__LOCALE['RCCRMTREE_DPC'][22]='_mob;Mobile;Κινητό';
$__LOCALE['RCCRMTREE_DPC'][23]='_email;e-mail;e-mail';
$__LOCALE['RCCRMTREE_DPC'][24]='_fax;Fax;Fax';
$__LOCALE['RCCRMTREE_DPC'][25]='_TIMEZONE;Timezone;Ζωνη ωρας';
$__LOCALE['RCCRMTREE_DPC'][26]='_fname;Contact person;Υπεύθυνος επικοινωνίας';
$__LOCALE['RCCRMTREE_DPC'][27]='_lname;Title;Επωνυμια';
$__LOCALE['RCCRMTREE_DPC'][28]='_username;Username;Χρήστης';
$__LOCALE['RCCRMTREE_DPC'][29]='_password;Password;Κωδικός';
$__LOCALE['RCCRMTREE_DPC'][30]='_notes;Notes;Σημειωσεις';
$__LOCALE['RCCRMTREE_DPC'][31]='_subscribe;Subscriber;Συνδρομητης';
$__LOCALE['RCCRMTREE_DPC'][32]='_seclevid;seclevid;seclevid';
$__LOCALE['RCCRMTREE_DPC'][33]='_secparam;Param;Param';
$__LOCALE['RCCRMTREE_DPC'][34]='_active;Active;Ενεργός';
$__LOCALE['RCCRMTREE_DPC'][35]='_secparam;Param;Param';
$__LOCALE['RCCRMTREE_DPC'][36]='_code;Code;Κωδικός';
$__LOCALE['RCCRMTREE_DPC'][37]='_country;Country;Χώρα';
$__LOCALE['RCCRMTREE_DPC'][38]='_timezone;Tmzone;Tmzone';
$__LOCALE['RCCRMTREE_DPC'][39]='_language;Country;ΓλώσσαΧώρα';
$__LOCALE['RCCRMTREE_DPC'][40]='_age;Age;Ηλικία';
$__LOCALE['RCCRMTREE_DPC'][41]='_level;Level;Πρόσβαση';
$__LOCALE['RCCRMTREE_DPC'][42]='_firstname;Firstname;Όνομα';
$__LOCALE['RCCRMTREE_DPC'][43]='_lastname;Lastname;Επώνυμο';
$__LOCALE['RCCRMTREE_DPC'][44]='_timein;Date;Ημερομηνία';
$__LOCALE['RCCRMTREE_DPC'][45]='_id;ID;ID';
$__LOCALE['RCCRMTREE_DPC'][46]='_title;Title;Τίτλος';
$__LOCALE['RCCRMTREE_DPC'][47]='_descr;Description;Περιγραφή';
$__LOCALE['RCCRMTREE_DPC'][48]='_code;Code;Κωδικός';
$__LOCALE['RCCRMTREE_DPC'][49]='_parent;Parent;Σχέση';
$__LOCALE['RCCRMTREE_DPC'][50]='_orderid;Order;Σειρά';
$__LOCALE['RCCRMTREE_DPC'][51]='_title0;Title L1;Τίτλος L1';
$__LOCALE['RCCRMTREE_DPC'][52]='_title1;Title L2;Τίτλος L2';
$__LOCALE['RCCRMTREE_DPC'][53]='_title2;Title L3;Τίτλος L3';
$__LOCALE['RCCRMTREE_DPC'][54]='_fields;Identifier;Πρόθεμα';
$__LOCALE['RCCRMTREE_DPC'][55]='_id;ID;ID';
$__LOCALE['RCCRMTREE_DPC'][56]='_zip;Zip;Τ.Κ.';
$__LOCALE['RCCRMTREE_DPC'][57]='_dateins;Start at;Εκκίνηση';
$__LOCALE['RCCRMTREE_DPC'][58]='_dateupd;Updated;Ενημερώση';
$__LOCALE['RCCRMTREE_DPC'][59]='_subject;Subject;Θέμα';
$__LOCALE['RCCRMTREE_DPC'][60]='_ulist;Leads;Λίστες';
$__LOCALE['RCCRMTREE_DPC'][61]='_contacts;Contacts;Επαφές';
$__LOCALE['RCCRMTREE_DPC'][62]='_sales;Sales;Πωλήσεις';
$__LOCALE['RCCRMTREE_DPC'][63]='_visitors;Visitors;Επισκέπτες';
$__LOCALE['RCCRMTREE_DPC'][64]='_campaigns;Campaigns;Καμπάνιες';
$__LOCALE['RCCRMTREE_DPC'][65]='_mail;e-mail;e-mail';
$__LOCALE['RCCRMTREE_DPC'][66]='_name;Name;Όνομα';
$__LOCALE['RCCRMTREE_DPC'][67]='_afm;Vat ID;ΑΦΜ';
$__LOCALE['RCCRMTREE_DPC'][68]='_area;Area;Περιοχή';
$__LOCALE['RCCRMTREE_DPC'][69]='_prfdescr;Occupation;Επάγγελμα';
$__LOCALE['RCCRMTREE_DPC'][70]='_doy;DOY.;ΔΟΥ.';
$__LOCALE['RCCRMTREE_DPC'][71]='_street;Street;Οδός';
$__LOCALE['RCCRMTREE_DPC'][72]='_number;No;Αριθμος';
$__LOCALE['RCCRMTREE_DPC'][73]='_city;City;Πόλη';
$__LOCALE['RCCRMTREE_DPC'][74]='_attr1;P1;P1';
$__LOCALE['RCCRMTREE_DPC'][75]='_attr2;P2;P2';
$__LOCALE['RCCRMTREE_DPC'][76]='_attr3;P3;P3';
$__LOCALE['RCCRMTREE_DPC'][77]='_attr4;P4;P4';
$__LOCALE['RCCRMTREE_DPC'][78]='_custaddress;Addresses;Διευθύνσεις';
$__LOCALE['RCCRMTREE_DPC'][79]='_active;Active;Ενεργός';
$__LOCALE['RCCRMTREE_DPC'][80]='_code2;Code;Κωδικός';
$__LOCALE['RCCRMTREE_DPC'][81]='_failed;Fails;Αποτυχίες';
$__LOCALE['RCCRMTREE_DPC'][82]='_listname;List name;Όνομα λίστας';
$__LOCALE['RCCRMTREE_DPC'][83]='_status;Status;Κατάσταση';
$__LOCALE['RCCRMTREE_DPC'][84]='_cid;cid;cid';
$__LOCALE['RCCRMTREE_DPC'][85]='_user;User;Χρήστης';
$__LOCALE['RCCRMTREE_DPC'][86]='_payway;Payment;Πληρωμή';
$__LOCALE['RCCRMTREE_DPC'][87]='_roadway;Transport;Μεταφορά';
$__LOCALE['RCCRMTREE_DPC'][88]='_qty;Qty;Ποσοτ.';
$__LOCALE['RCCRMTREE_DPC'][89]='_cost;Net;Ποσό Net';
$__LOCALE['RCCRMTREE_DPC'][90]='_costpt;Gross;Ποσό';

class rccrmtree {
	
	var $title, $prpath, $urlpath, $url;
	var $listName, $owner, $fid, $echoSQL;
	var $seclevid, $userDemoIds;

    function __construct() {
	  
		$this->prpath = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');	
		$this->url = paramload('SHELL','urlbase');
		$this->title = localize('RCCRMTREE_DPC',getlocal());

		$this->owner = GetSessionParam('LoginName');
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
		$this->userDemoIds = array(5,6,7,8); 			

        $this->listName = 'mycrmtreelist';
        $this->savedlist = GetSessionParam($this->listName) ? GetSessionParam($this->listName) : null;
	
		$this->fid = GetReq('fid');
		$this->echoSQL = false; //true;
	}
	
    function event($event=null) {
	
	   $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   if ($login!='yes') return null;				

       if (!$this->msg) {
  
	     switch ($event) {
			 
			case 'cpcrmtreeframe' : echo $this->loadframe();
		                            die(); 
			case 'cpcrmtreeusers' : //direct saving to list when grid click on email
			                        if ((GetReq('mode')=='email') && ($email= GetReq('id'))) {
										$this->addtoSessionList($email);
										//echo 'add to session:'.$email;
										//print_r(explode(',',$this->savedlist));
									}	
			                        break;	 	 
		    case 'cpcrmloadtree'  : break;			 
		    case 'cpcrmsavetree'  : $this->savedlist = $this->saveList();				
	                                break;									
			case 'cpcrmtree'      :
			default               :							  
         }
      }
    }	

    function action($action=null)  { 
	
	     $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	     if ($login!='yes') return null;		

	     switch ($action) {
			 
		   case 'cpcrmtreeframe' :  break;	 
		   case 'cpcrmtreeusers' :  break;		 	 
		   case 'cpcrmloadtree'  :  break;		   
		   case 'cpcrmsavetree'  :  break;			   
		   case 'cpcrmtree'      :						   
		   default               :  $out = $this->gridMode();
		 }			 

	     return ($out);
	}
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}		
	
	protected function loadframe($mode=null) {
		$selectmode = $mode ? $mode : GetReq('mode');
		$id = GetReq('id');
		
		switch ($selectmode) {
			case 'ulist'    :   $bodyurl = seturl("t=cpcrmtreeusers&mode=ulist&id=". $id); break;
			case 'campaign' :   $bodyurl = seturl("t=cpcrmtreeusers&mode=campaign&id=". $id); break;			
			case 'users'    :   $bodyurl = seturl("t=cpcrmtreeusers&mode=users&id=". $id); break;	
			case 'contacts' :   $bodyurl = seturl("t=cpcrmtreeusers&mode=contacts&id=". $id); break;
			case 'customers':   $bodyurl = seturl("t=cpcrmtreeusers&mode=customers&id=". $id); break;
			case 'sales'    :   $bodyurl = seturl("t=cpcrmtreeusers&mode=sales&id=". $id); break;
            case 'email'    :   $bodyurl = seturl("t=cpcrmtreeusers&mode=email&id=". $id); break;			
			case 'tree'     : 
			default         :   $bodyurl = seturl("t=cpcrmtreeusers&mode=tree&id=". $id);
		}
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"500px\"><p>Your browser does not support iframes</p></iframe>";    

		return ($frame); 
	}		

	protected function gridMode() {
		$mode = GetReq('mode') ? GetReq('mode') : 'tree';
		
		$turl0 = seturl('t=cpcrmtree&mode=contacts');
		$turl1 = seturl('t=cpcrmtree&mode=users');
		$turl2 = seturl('t=cpcrmtree&mode=customers');		
		$turl3 = seturl('t=cpcrmtree&mode=ulist');
		$turl4 = seturl('t=cpcrmtree&mode=campaigns');
		$turl5 = seturl('t=cpcrmtree&mode=sales');
		$turl6 = seturl('t=cpcrmtree&mode=visitors');
		$turl7 = seturl('t=cpcrmtree&mode=tree');
		$button = $this->createButton(localize('_mode', getlocal()), 
										array(localize('_contacts', getlocal())=>$turl0,
										      localize('_users', getlocal())=>$turl1,
									  		  localize('_customers', getlocal())=>$turl2,
											  localize('_ulist', getlocal())=>$turl3,
											  localize('_campaigns', getlocal())=>$turl4,
											  localize('_sales', getlocal())=>$turl5,
											  localize('_visitors', getlocal())=>$turl6,
											  0=>null,
											  localize('_tree', getlocal())=>$turl7,
		                                ),'success');
													

		switch ($mode) {
			case 'visitors' :   $content = $this->visitors_grid(null,140,5,'r', true); break;
			case 'sales'    :   $content = $this->sales_grid(null,140,5,'r', true); break;
			case 'contacts' :	$content = $this->contacts_grid(null,140,5,'r', true); break;
			case 'customers':	$content = $this->customers_grid(null,140,5,'r', true); break;
			case 'ulist'    :   $content = $this->ulist_grid(null,140,5,'e', true); break;
			case 'campaigns':   $content = $this->campaigns_grid(null,140,5,'r', true); break;			
			case 'users'    :   $content = $this->users_grid(null,140,5,'r', true); break; 
			case 'tree'     :
			default         :   $content = $this->tree_grid(null,140,5,'r', true);
		}			
					
		$ret = $this->window($this->title .': '.localize('_'.$mode, getlocal()), $button, $content);
		
		return ($ret);
	}	

	protected function tree_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_tree', getlocal()); 
		
        $xsSQL = "SELECT * from (select id,timein,active,tid,pid,tname,tdescr,tname0,tname1,tname2,items,users,orderid from ctree) o ";		   
					
		_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|");		
		//_m("mygrid.column use grid1+itmactive|".localize('_active',getlocal())."|2|0|");//"|boolean|1|1:0");		
		_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|boolean|1|1:0|");
		_m("mygrid.column use grid1+timein|".localize('_date',getlocal())."|5|0|");		
		_m("mygrid.column use grid1+tid|".localize('_code',getlocal())."|5|0|");
		_m("mygrid.column use grid1+pid|".localize('_parent',getlocal())."|5|1|");			
		_m("mygrid.column use grid1+tname|".localize('_title',getlocal())."|link|10|"."javascript:ttree(\"{tid}\");".'||');	
		_m("mygrid.column use grid1+tdescr|".localize('_descr',getlocal())."|5|0|");		
		_m("mygrid.column use grid1+tname0|".localize('_title0',getlocal())."|5|1|");			
		_m("mygrid.column use grid1+tname1|".localize('_title1',getlocal())."|5|1|");		
		_m("mygrid.column use grid1+tname2|".localize('_title2',getlocal())."|5|1|");			
		//_m("mygrid.column use grid1+manufacturer|".localize('_manufacturer',getlocal())."|5|0|");
		_m("mygrid.column use grid1+items|".localize('_items',getlocal())."|boolean|1|1:0|");
		_m("mygrid.column use grid1+users|".localize('_users',getlocal())."|boolean|1|1:0|");
		_m("mygrid.column use grid1+orderid|".localize('_orderid',getlocal())."|2|1|");

		$out = _m("mygrid.grid use grid1+ctree+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
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
        _m("mygrid.column use grid1+email|".localize('_mail',getlocal())."|link|10|"."javascript:tmail(\"{email}\");".'||');
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
		_m("mygrid.column use grid1+date|".localize('_date',getlocal())."|link|10|"."javascript:tcontacts(\"{date}\");".'||');//"|5|0|");	   
		_m("mygrid.column use grid1+udate|".localize('_date',getlocal())."|10|1|");		
		_m("mygrid.column use grid1+code|".localize('_code',getlocal())."|5|1|");		
		_m("mygrid.column use grid1+type|".localize('_type',getlocal())."|2|1|");
		_m("mygrid.column use grid1+email|".localize('_email',getlocal())."|link|10|"."javascript:tmail(\"{email}\");".'||');
		_m("mygrid.column use grid1+firstname|".localize('_firstname',getlocal())."|10|1|");						
		_m("mygrid.column use grid1+lastname|".localize('_lastname',getlocal())."|10|1|");
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
	
	
	protected function getPaymentsELT($flname, $as=null) {
		if (!$flname) return null;
		$db = GetGlobal('db');
		$lan = getlocal();

		$sSQL = "select code,lantitle from ppayments";
		$result = $db->Execute($sSQL);

		foreach ($result as $i=>$rec) {
			$field = $rec['lantitle'] ? $rec['lantitle'] : $rec['code'];
			$fields[] = $field;
			$locales[] = localize($field, $lan);
		}	
		
		$f = "'" . implode("','", $fields) ."'";
		$l = "'" . implode("','", $locales) ."'";
		
		$a = $as ? "as $as" : null;
		$ret = "ELT(FIELD({$flname}, {$f}), {$l}) {$a}";
		return ($ret);
	}
	
	protected function getTransportsELT($flname, $as=null) {
		if (!$flname) return null;
		$db = GetGlobal('db');
		$lan = getlocal();

		$sSQL = "select code,lantitle from ptransports";
		$result = $db->Execute($sSQL);

		foreach ($result as $i=>$rec) {
			$field = $rec['lantitle'] ? $rec['lantitle'] : $rec['code'];
			$fields[] = $field;
			$locales[] = localize($field, $lan);
		}	
		
		$f = "'" . implode("','", $fields) ."'";
		$l = "'" . implode("','", $locales) . "'";
		
		$a = $as ? "as $as" : null;
		$ret = "ELT(FIELD({$flname}, {$f}), {$l}) {$a}";
		return ($ret);
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
			
			$lookup1 = $this->getPaymentsELT('i.payway', 'pw'); 
			$lookup2 = $this->getTransportsELT('i.roadway', 'rw');
						
			
			$xsSQL2 = "SELECT * FROM (SELECT i.recid,i.tid,i.cid,i.timein,i.tdate,i.ttime,i.tstatus,$lookup1,$lookup2,i.qty,i.cost,i.costpt FROM transactions i) x";
				//echo $xsSQL2;

			_m("mygrid.column use grid3+recid|".localize('id',getlocal())."|5|0|||1|1");
			_m("mygrid.column use grid3+tid|".localize('id',getlocal())."|5|0|");
			_m("mygrid.column use grid3+timein|".localize('_date',getlocal())."|link|10|"."javascript:tsales(\"{timein}\");".'||');//"|10|0|");
			_m("mygrid.column use grid3+cid|".localize('_user',getlocal())."|link|10|"."javascript:tmail(\"{cid}\");".'||');			
		    //_m("mygrid.column use grid3+ttime|".localize('_time',getlocal())."|9|0|");	
			_m("mygrid.column use grid3+tstatus|".localize('_status',getlocal())."|2|0|||||right");	
		    _m("mygrid.column use grid3+pw|".localize('_payway',getlocal())."|20|0|");		
		    _m("mygrid.column use grid3+rw|".localize('_roadway',getlocal())."|20|0|");
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
		_m("mygrid.column use grid1+timein|".localize('_date',getlocal())."|link|5|"."javascript:tusers(\"{timein}\");".'||');//"|5|0|");	   
		_m("mygrid.column use grid1+notes|".localize('_active',getlocal())."|5|1|");
		_m("mygrid.column use grid1+username|".localize('_username',getlocal())."|link|10|"."javascript:tmail(\"{username}\");".'||');						
		_m("mygrid.column use grid1+fname|".localize('_fname',getlocal())."|19|1|");
		_m("mygrid.column use grid1+lname|".localize('_lname',getlocal())."|19|1|");
		_m("mygrid.column use grid1+ageid|".localize('_age',getlocal())."|2|1|");
		_m("mygrid.column use grid1+cntryid|".localize('_country',getlocal())."|2|1|");
		_m("mygrid.column use grid1+lanid|".localize('_language',getlocal())."|2|1|");
		_m("mygrid.column use grid1+timezone|".localize('_timezone',getlocal())."|2|1|");
		_m("mygrid.column use grid1+email|".localize('_email',getlocal())."|link|10|"."javascript:tmail(\"{email}\");".'||');
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
		_m("mygrid.column use grid2+timein|".localize('_date',getlocal())."|link|10|"."javascript:tcustomers(\"{timein}\");".'||');// "|10|0|");
		_m("mygrid.column use grid2+active|".localize('_active',getlocal())."|2|0|");	
		_m("mygrid.column use grid2+code2|".localize('_code2',getlocal())."|link|10|"."javascript:tmail(\"{code2}\");".'||');
		_m("mygrid.column use grid2+mail|".localize('_mail',getlocal())."|link|10|"."javascript:tmail(\"{mail}\");".'||');		
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
        _m("mygrid.column use grid1+email|".localize('_mail',getlocal())."|link|10|"."javascript:tmail(\"{email}\");".'||');
        _m("mygrid.column use grid1+startdate|".localize('_dateins',getlocal()).'|10|0');		   
		_m("mygrid.column use grid1+datein|".localize('_dateupd',getlocal())."|10|0|");			
        _m("mygrid.column use grid1+name|".localize('_lname',getlocal()).'|19|1');	
		_m("mygrid.column use grid1+active|".localize('_active',getlocal()).'|boolean|0');	
		_m("mygrid.column use grid1+failed|".localize('_failed',getlocal()).'|5|0');	
		_m("mygrid.column use grid1+listname|".localize('_listname',getlocal())."|link|10|"."javascript:tulist(\"{listname}\");".'||');			
		   
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
		_m("mygrid.column use grid1+receiver|".localize('_mail',getlocal())."|link|10|"."javascript:tmail(\"{receiver}\");".'||');						
		_m("mygrid.column use grid1+subject|".localize('_subject',getlocal())."|19|1|");
		_m("mygrid.column use grid1+reply|".localize('_reply',getlocal())."|2|1|");
		_m("mygrid.column use grid1+status|".localize('_status',getlocal())."|2|1|");
		_m("mygrid.column use grid1+mailstatus|".localize('_failed',getlocal())."|2|1|");
		_m("mygrid.column use grid1+cid|".localize('_cid',getlocal())."|link|10|"."javascript:tcamp(\"{cid}\");".'||');
		   
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
		
		if (!empty($urls)) {
			foreach ($urls as $n=>$url)
				$links .= $url ? '<li><a href="'.$url.'">'.$n.'</a></li>' : '<li class="divider"></li>';
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
							<hr/><div id="crmform"></div>
							</div>
							'.  $content .'
                        </div>
                  </div>
                </div>
            </div>
';
		return ($ret);
	}	
	
	public function currentSelectedTreeType() {
		$db = GetGlobal('db');		
		$tid = GetParam('id');
		
		$sSQL = 'select items,users from ctree where tid=' . $db->qstr($tid);
		$result = $db->Execute($sSQL);
		
		$isitemstype = $result->fields[0];
		$isuserstype = $result->fields[1];
		
		$ret = $isitemstype ? 1 : ($isuserstype ? 2 : 0);
		//echo $ret;
		return ($ret);
	}	
	
	public function currentSelectedTree() {
		$db = GetGlobal('db');		
		$lan = getlocal() ?  getlocal() : '0';
		$tid = GetParam('id');
		
		$sSQL = 'select tname, tname0, tname1, tname2 from ctree where tid=' . $db->qstr($tid);
		$result = $db->Execute($sSQL);
		
		$ret = $result->fields['tname'.$lan] ? $result->fields['tname'.$lan] : $result->fields[0];
		return ($ret);
	}
	
	//select field to display
	public function selectFieldUrl($field=null) {
		$t=GetReq('t');
		$id = GetReq('id');
		$mode = GetReq('mode');
		
		switch ($field) {
			case 'qty' :
			default    : $fid = $field ? $field : null;
		}
		
		$ret = seturl("t=$t&mode=$mode&id=$id&fid=". $fid);
		
		return ($ret);
	}
	
	public function selectFieldButton() {
		$mode = GetParam('mode');
		//echo $mode;
		switch ($mode) {
			case 'ulist' :  $fields = 'startdate,datein,active,failed,name,listname';
							break;
					  
			case 'campaign' : $fields = 'subject,reply,status,mailstatus';
							break;		  
		
			case 'users' :	$fields = 'timein,code2,ageid,cntryid,lanid,timezone,notes,fname,lname,seclevid';
							break;	
							
			case 'customers' :	$fields = 'timein,active,name,afm,eforia,prfdescr,street,address,number,area,city,zip,voice1,voice2,fax,attr1,attr2,attr3,attr4';
							break;

			case 'sales' :	$fields = 'tstatus,qty,cost,costpt';
							break;							
	
	        case 'email' : 	break; //direct input in session

			case 'contacts'  :  
			case 'tree'  :  
		    default      :  $fields = 'type,firstname,lastname,address,country,birthday,occupation,mobile,phone';
		}		
		if (!$fields) return null;
		$f = explode(',', $fields);
		
		foreach ($f as $i=>$field) {
			$myfields[$field] = $this->selectFieldUrl($field);
		}
		
		if (empty($myfields)) return null;
		$button = $this->createButton(localize('_fields', getlocal()), $myfields);		
		
		return ($button);
	}	
	

	//exclude existed session items
    protected function getCurrentSessionList() {
		$db = GetGlobal('db');
	    $lan = getlocal();	
		$f = $this->fid ? ',' . $this->fid : null;
		$mode = GetParam('mode');
		$ret = null;	
		
		$and = false;
		$where = false;
		$group = false;
		$email = 'email';
		
		switch ($mode) {
			case 'ulist' :  $sSQL = GetReq('id') ? "select $email $f from ulists where listname=" . $db->qstr(GetReq('id')) : null;
							$and = true;
							break;
					  
			case 'campaign' : $email = 'receiver'; 
			                $sSQL = GetReq('id') ? "select $email $f from mailqueue where cid=" . $db->qstr(GetReq('id')) : null;
			                $and = true;
							break;		  
		
			case 'users' :	$sSQL = "select $email $f from users";
							$where = true;
							break;	
							
			case 'customers' : $email = 'mail';	
			                $sSQL = "select $email $f from customers";
							$where = true;
							break;

			case 'sales' :	$email = 'cid';
			                $sSQL = "select $email ". str_replace($this->fid, "sum($this->fid) as $this->fid", $f) . " from transactions";
							$where = true;
							$group = " GROUP BY $email";
							//$group.= $f ? $f : null;
							break;						
	
	        case 'email' : 	break; //direct input in session

			case 'contacts':
			case 'tree'  :  
		    default      :  $sSQL = "select $email $f from crmcontacts";
			                $where = true;
		}

        if (!$sSQL) return false;  
		
		//check session
		if (!empty($_POST[$this->listName]))  
			$list = implode(',', $_POST[$this->listName]);	
        else
			$list = $this->savedlist; 		
			
		if ($list)
			$sSQL .= $where ? " WHERE $email NOT REGEXP '" . str_replace(',','|',$list) . "'" :
		                      ($and ? " and $email NOT REGEXP '" . str_replace(',','|',$list) . "'" : null);
		
		$sSQL .= $group ? $group : null;
		
		if ($this->echoSQL)
			echo $sSQL . '<br/>';
		
		$resultset = $db->Execute($sSQL);	
		foreach ($resultset as $n=>$rec) {
			$title = $this->fid ? $rec[$this->fid] .'-'. $rec[0] : $rec[0];
			$ret[] = "<option value='".$rec[0]."'>". $title."</option>" ;
		}		
		
		return (implode('',$ret));	
	}
	
	//exclude existed tree map items and session items
    protected function getCurrentTreeList() {
		$db = GetGlobal('db');
	    $lan = getlocal();	
		$f = $this->fid ? ',' . $this->fid : null;
		$tid = GetParam('id');
		$mode = GetParam('mode');		
		$ret = null;

		$and = false;
		$where = false;
		$email = 'email';
		
		switch ($mode) {
			case 'tree'  :  
		    default      :  $sSQL = "select $email $f from crmcontacts";
			                $where = true;
		}
		
        if (!$sSQL) return false; 		
		
		//check session		
		if (!empty($_POST[$this->listName]))  
			$list = implode(',', $_POST[$this->listName]);	
        else
			$list = $this->savedlist; 		
			
		if ($list)
			$sSQL .= $where ? " WHERE $email NOT REGEXP '" . str_replace(',','|',$list) . "'" :
		                      ($and ? " and $email NOT REGEXP '" . str_replace(',','|',$list) . "'" : null);	
		
		//check tree maps
		if (isset($tid)) {
			$treeSQL = "select code from ctreemap WHERE tid=" . $db->qstr($tid);
			$sSQL .= " and $email not in (" . $treeSQL . ')';
		}			
		
		if ($this->echoSQL)
			echo $sSQL . '<br/>';
		
		$resultset = $db->Execute($sSQL);	
		foreach ($resultset as $n=>$rec) {
			$title = $this->fid ? $rec[$this->fid] .'-'. $rec[0] : $rec[0];
			$ret[] = "<option value='".$rec[0]."'>". $title."</option>" ;
		}		
		
		return (implode('',$ret));
	}	

    public function getCurrentList() {
		
        switch (GetReq('mode')) { 
			case 'tree'  : $ret = $this->getCurrentTreeList(); break;		
			default      : $ret = $this->getCurrentSessionList();
		}	
		
		return ($ret);
    }	

	
	//include session items	
	protected function viewSessionList() {
		$db = GetGlobal('db');		
		$f = $this->fid ? ',' . $this->fid : null;
		
		if (!empty($_POST[$this->listName]))  
			$list = implode(',', $_POST[$this->listName]);	
        else
			$list = $this->savedlist;	
		
		if (!$list) return ;

		$resultset = (!empty($list)) ? explode(',', $list) : array();
		foreach ($resultset as $n=>$email) {
			$ret[] = "<option value='".$email."'>". $email."</option>" ;
        }		
		return (implode('',$ret));			
	}	
	
	//include tree map items or session items
	protected function viewTreeList() {
		$db = GetGlobal('db');
		$f = $this->fid ? ',' . $this->fid : null;
		$tid = GetParam('id');
		
		//if not users tree return
		if ($this->currentSelectedTreeType()!=2) return null; 		
			
		//check session	
		if (!empty($_POST[$this->listName]))  
			$list = implode(',', $_POST[$this->listName]);	
        else
			$list = $this->savedlist;	
		
		$sSQL = "select code from ctreemap where tid=" . $db->qstr($tid);
		$resultset = $db->Execute($sSQL);	
		
		if ($this->echoSQL)
			echo $sSQL . '<br/>';			
		
		$intreelist = array();
		foreach ($resultset as $n=>$rec) {
			$ret[] = "<option value='".$rec[0]."'>". $rec[0]."</option>" ;
			$intreelist[] = $rec[0];
		}		
		
		$insessionlist = (!empty($list)) ? explode(',', $list) : array();		
		foreach ($insessionlist as $n=>$email) {
			$ret[] = in_array($email, $intreelist) ? null : "<option value='".$email."'>". '[+]' . $email."</option>" ;
		}				

		return (implode('',$ret));				
	}

	public function viewList() {
		
        switch (GetReq('mode')) { 
			case 'tree'  : $ret = $this->viewTreeList(); break;		
			default      : $ret = $this->viewSessionList();	
		}			
			
		return ($ret);
	}	
		
	
	public function postSubmit($action, $title=null, $class=null) {
		if (!$action) return;
		$submit = $title ? $title : 'Submit';
		$cl = $class ? "class=\"$class\"" : null;
		 
		$id = GetReq('id'); 
		$c = "<INPUT type=\"hidden\" name=\"id\" value=\"{$id}\" />";
		$mode = GetReq('mode');
		$c .= "<INPUT type=\"hidden\" name=\"mode\" value=\"{$mode}\" />";
		
        $c .= "<INPUT type=\"submit\" name=\"submit\" value=\"" . $submit . "\" $cl />";  
        $c .= "<INPUT type=\"hidden\" name=\"FormName\" value=\"Treedescr\" />";		   
        $c .= "<INPUT type=\"hidden\" name=\"FormAction\" value=\"" . $action . "\" $cl />";
        return ($c);   		   
	}

	protected function saveTreeList($data=null) {
		$db = GetGlobal('db');		
		$tid = GetParam('id');
		$m=0;
		
		if ($data) {
			$ids = explode(',', $data);
			
			//insert if not in tree
			foreach ($ids as $i=>$item) {
				$existSQL = "select code from ctreemap WHERE code=" . $db->qstr($item) . " and tid=" . $db->qstr($tid);	
				$resultset = $db->Execute($existSQL);
				
				if ($this->echoSQL)	echo $existSQL;
				
				if ($resultset->fields[0]) {
					//dont insert
					if ($this->echoSQL)	echo '0<br/>';
					continue;
				}
				else {
					$sSQL = 'insert into ctreemap (tid, code) values';
					$sSQL .= ' ('. $db->qstr($tid) . ',' . $db->qstr($item) . ')';		   
					$db->Execute($sSQL);
					$m+=1;	
					if ($this->echoSQL) echo "1&nbsp;$sSQL<br/>";
				}
			}			
		}
		
		return ($m);
	}	
	
	protected function remTreeList($data=null) {
		$db = GetGlobal('db');		
		$tid = GetParam('id');
		$m=0;	
		
		if ($data) {
			$ids = explode(',', $data);
			
			//delete if not in post list
			$treeSQL = "select code from ctreemap WHERE tid=" . $db->qstr($tid);	
			$result = $db->Execute($treeSQL);
			if (!empty($result->fields)) {
				foreach ($result as $r=>$rec) {
					if (in_array($rec['code'], $ids)) {
						//dont remove
						continue;						
					}
					else {
						$sSQL = 'delete from ctreemap where tid='. $db->qstr($tid) . ' and code=' . $db->qstr($rec['code']);		   
						$db->Execute($sSQL);
						$m+=1;	
						if ($this->echoSQL) echo "1&nbsp;$sSQL<br/>";						
					}
				}
			}
		}
		
		return ($m);
	}				
					
	
	protected function saveList() {
		$mode = GetParam('mode');
		$list = null;	
		
		if (!empty($_POST[$this->listName])) { 
		
			$plist = implode(',', $_POST[$this->listName]); //post list
			
			switch (GetReq('mode')) { 
			
				case 'tree'  :  if ($this->currentSelectedTreeType()==2) { //users tree
									$this->remTreeList($plist); //remove post list
									$this->saveTreeList($plist); //save list at table
									SetSessionParam($this->listName, ''); //reset session list
				                }	
								break;		
					
				default      :	SetSessionParam($this->listName, $plist); //save session list
			}	
			
		}
		else
			SetSessionParam($this->listName, '');
		  
		return ($list);
	}

	/*add emails to session list*/
	protected function addtoSessionList($ecode=null) {
        if (!$ecode) return false;
		
		//check if exist
		if (isset($this->savedlist)) 
			$inlist = explode(',', $this->savedlist);
		else
			$inlist = array(); //dummy
		
		if (strstr($ecode, ',')) { //list of email, csv
            $mails = explode(',', $ecode); 
			$m = 0;
		    foreach ($mails as $i=>$email) {
				if ((filter_var($email, FILTER_VALIDATE_EMAIL)) && (!in_array($email, $inlist)))  { 
					$c[] = $email;
					$m+=1;
				}	
			}	
			$list = isset($this->savedlist) ?  $this->savedlist . "," . implode(',', $c) : implode(',', $c);
			SetSessionParam($this->listName, $list);
			
			$this->savedlist = $list; //save savedList when email added directly from url
			return $m;	
		}
		else {
			if ((filter_var($ecode, FILTER_VALIDATE_EMAIL)) && (!in_array($ecode, $inlist))) {
				$list = isset($this->savedlist) ?  $this->savedlist . "," . $ecode : $ecode;
				SetSessionParam($this->listName, $list);
				
				$this->savedlist = $list; //save savedList when email added directly from url
				return true;
			}
		}
		
		return false;	
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
	
	
	
};
}
?>