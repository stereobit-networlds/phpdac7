<?php

$__DPCSEC['DBLOCALES_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("DBLOCALES_DPC")) && (seclevel('DBLOCALES_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("DBLOCALES_DPC",true);

$__DPC['DBLOCALES_DPC'] = 'dblocales';

class dblocales {

    function __construct() {
	}
	
	public function loc($lc, $f=null) {
		if (!$lc || !$f) return null;
		$lan = getlocal();
		$l = explode(';', $f[$lc]);
		return $l[$lan];
	}	
	
	public function customers() {
		/*global $__LOCALE;
		
		$__LOCALE['DBLOCALES_DPC'][10]='_timein;Date;Ημ/νια';
		$__LOCALE['DBLOCALES_DPC'][11]='_active;Active;Ενεργό';
		$__LOCALE['DBLOCALES_DPC'][12]='_mail;e-mail;Ηλ. ταχ.';
		$__LOCALE['DBLOCALES_DPC'][13]='_name;Name;Όνομα';
		$__LOCALE['DBLOCALES_DPC'][14]='_afm;Vat;ΑΦΜ';
		$__LOCALE['DBLOCALES_DPC'][15]='_eforia;Vat name;ΔΟΥ';
		$__LOCALE['DBLOCALES_DPC'][16]='_prfdescr;Occupation;Επάγγελμα';
		$__LOCALE['DBLOCALES_DPC'][17]='_street;Street;Οδός';
		$__LOCALE['DBLOCALES_DPC'][18]='_address;Address;Αριθμός';
		$__LOCALE['DBLOCALES_DPC'][19]='_number;No;Νο';
		$__LOCALE['DBLOCALES_DPC'][20]='_area;Area;Περιοχή';
		$__LOCALE['DBLOCALES_DPC'][21]='_zip;Zip;ΤΚ';
		$__LOCALE['DBLOCALES_DPC'][22]='_city;City;Πόλη';
		$__LOCALE['DBLOCALES_DPC'][23]='_country;Country;Χώρα';
		$__LOCALE['DBLOCALES_DPC'][24]='_voice1;Tel 1;Τηλ 1';
		$__LOCALE['DBLOCALES_DPC'][25]='_voice2;Tel 2;Τηλ 2';
		$__LOCALE['DBLOCALES_DPC'][26]='_fax;Fax;Φαξ';
		*/
		$f = array('id',
				   'timein'=>'Date;Ημ/νια',
				   'active'=>'Active;Ενεργό',
				   'mail'=>'e-mail;Ηλ. ταχ.',
				   'name'=>'Name;Όνομα',
				   'afm'=>'Vat;ΑΦΜ',
				   'eforia'=>'Vat name;ΔΟΥ',
				   'prfdescr'=>'Occupation;Επάγγελμα',
				   'street'=>'Street;Οδός',
				   'address'=>'Address;Αριθμός',
				   'number'=>'No;Νο',
				   'area'=>'Area;Περιοχή',
				   'zip'=>'Zip;ΤΚ',
				   'city'=>'City;Πόλη',
				   'country'=>'Country;Χώρα',
				   'voice1'=>'Tel 1;Τηλ 1',
				   'voice2'=>'Tel 2;Τηλ 2',
				   'fax'=>'Fax;Φαξ'
				   );
		return $f;		   
	}
	
	public function users() {
		
		$f = array('id'=>'id,α/α',
				   'timein'=>'Date;Ημ/νια',
				   'active'=>'Active;Ενεργό',
				   'email'=>'e-mail;Ηλ. Ταχ.',
				   'fname'=>'Name;Όνομα',
				   'lname'=>'Surname;Επωμυμία',
				   'timezone'=>'Timezone;Ζώνη ώρας',
				   'fb'=>'Fb user;Fb χρήστης'
				   );
				   
		return $f;		   
	}
	
	public function ulists() {
		
		$f = array('id'=>'id,α/α',
				   'datein'=>'Date;Ημ/νια',
				   'startdate'=>'Start;Εγγραφή',
				   'active'=>'Active;Ενεργό',
				   'gdpr'=>'GDPR Sign;GDPR υπογραφή',
				   'listname'=>'Listname;Όνομα λίστας',
				   'email'=>'e-mail;Ηλ. ταχ.',
				   'failed'=>'Failed;Αποτυχίες',
				   'owner'=>'Owner;Ιδιοκτήτης'
				   );
		
		return $f;
	}
	
	public function products() {
		
		$f = array('id'=>'id,α/α',
				   'datein'=>'Date;Ημ/νια',
				   'code1'=>'Code 1;Κωδ. 1',
				   'code2'=>'Code 2;Κωδ. 2',
				   'code3'=>'Code 3;Κωδ. 3',
				   'code4'=>'Code 4;Κωδ. 4', 
				   'code5'=>'Code 5;Κωδ. 5', 
				   'itmname'=>'Title;Τίτλος', 
				   'itmfname'=>'Title;Τίτλος', 
				   'uniname1'=>'Uniname 1;Μμ 1', 
				   'uniname2'=>'Uniname 2;Μμ 2', 
				   'ypoloipo1'=>'Qty 1;Υπόλοιπο 1', 
				   'ypoloipo2'=>'Qty 2;Υπόλοιπο 2', 
				   'price0'=>'Price A;Τιμή Α', 
				   'price1'=>'Price B;Τιμή Β', 
				   'price2'=>'Price C;Τιμή Γ', 
				   'pricepc'=>'Price PC;Τιμή PC', 
				   'weight'=>'Weight;Βάρος', 
				   'volume'=>'Volume;Όγκος', 
				   'dimensions'=>'Dimensions;Διάσταση', 
				   'size'=>'Size;Μέγεθος', 
				   'color'=>'Color;Χρώμα', 
				   'manufacturer'=>'Manufacturer;Κατασκευαστής', 
				   'xml'=>'Xml;Xml', 
				   'owner'=>'Owner;Ιδιοκτήτης'
				   );
		
		return $f;
	}

	public function transactions() {
		
		$f = array('recid'=>'id,α/α',
				   'timein'=>'Date;Ημ/νια',
				   'tid'=>'TrID;TrID',
				   'cid'=>'Customer;Πελάτης',
				   'tdate'=>'Date;Ημ/νία',
				   'ttime'=>'Time;Ώρα', 
				   'tstatus'=>'Status;Κατάσταση', 
				   'payway'=>'Pay method;Τρόπος πληρωμής', 
				   'roadway'=>'Shippment;Τρόπος μεταφοράς', 
				   'qty'=>'Qty;Ποσ.', 
				   'cost'=>'Net;Καθαρή αξία', 
				   'costpt'=>'Value;Αξία', 
				   'referer'=>'Referer;Πηγή αναφοράς');
		
		return $f;
	}

	public function mailqueue() {
		
		$f = array('id'=>'id,α/α',
				   'timein'=>'Date in;Ημ/νια εισαγωγής',
				   'timeout'=>'Date out;Ημ/νια αποστολής',
				   'active'=>'Active;Ενεργό',
				   'sender'=>'Sender;Αποστολέας',
				   'receiver'=>'Receiver;Παραλήπτης', 
				   'subject'=>'Subject;Θέμα', 
				   'reply'=>'Replies;Αναγνώσεις', 
				   'status'=>'Viewed;Επισκόπηση', 
				   'mailstatus'=>'State;Κατάσταση', 
				   'trackid'=>'Track Id;Track Id', 
				   'cid'=>'Campaign;Καμπάνια', 
				   'owner'=>'Owner;Ιδιοκτήτης'
				   );
		
		return $f;
	}
	
	public function stats() {
		
		$f = array('id'=>'id,α/α',
				   'date'=>'Date;Ημ/νια',
				   'tid'=>'Tid;Tid',
				   'attr1'=>'Attr1;Χαρακτηριστικό 1',
				   'attr2'=>'Attr2;Χαρακτηριστικό 2',
				   'vid'=>'Vid;Vid',
				   'ref'=>'Ref;Ref',
				   'REMOTE_ADDR'=>'Ip;Ip',
				   'HTTP_USER_AGENT'=>'User agent;User agent',
				   'REFERER'=>'Referer;Πηγή αναφοράς'
				   );
		
		return $f;
	}
	
	public function mailcamp() {
		
		$f = array('id'=>'id,α/α',
				   'cdate'=>'Date;Ημ/νια',
				   'ctype'=>'Type;Τύπος',
				   'title'=>'Title;Τίτλος',
				   'ulists'=>'Lists;Λίστες',
				   'cc'=>'cc;cc', 
				   'bcc'=>'bcc;bcc', 
				   'template'=>'Template;Πρότυπο', 
				   'active'=>'Active;Ενεργό', 
				   'owner'=>'Owner;Ιδιοκτήτης', 
				   'cid'=>'Campaign;Καμπάνια'
				   );
		
		return $f;
	}
	
};
}   
?>