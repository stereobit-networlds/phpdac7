<?php
$__DPCSEC['CRMWISHFAV_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CRMWISHFAV_DPC")) && (seclevel('CRMWISHFAV_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CRMWISHFAV_DPC",true);

$__DPC['CRMWISHFAV_DPC'] = 'crmwishfav';

$b = GetGlobal('controller')->require_dpc('crm/crmmodule.dpc.php');
require_once($b);

$__LOCALE['CRMWISHFAV_DPC'][0]='CRMWISHFAV_DPC;Favorites;Προτεινόμενα';
$__LOCALE['CRMWISHFAV_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['CRMWISHFAV_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['CRMWISHFAV_DPC'][3]='_qty;Quantity;Ποσότητα';
$__LOCALE['CRMWISHFAV_DPC'][4]='_items;Items;Είδη';
$__LOCALE['CRMWISHFAV_DPC'][5]='_active;Active;Ενεργό';
$__LOCALE['CRMWISHFAV_DPC'][6]='_title;Title;Τίτλος';
$__LOCALE['CRMWISHFAV_DPC'][7]='_descr;Description;Περιγραφή';
$__LOCALE['CRMWISHFAV_DPC'][8]='_xml;Xml;Xml';
$__LOCALE['CRMWISHFAV_DPC'][9]='_color;Color;Χρώμα';
$__LOCALE['CRMWISHFAV_DPC'][10]='_code;Code;Κωδικός';
$__LOCALE['CRMWISHFAV_DPC'][11]='_dimensions;Dimension;Διαστάσεις';
$__LOCALE['CRMWISHFAV_DPC'][12]='_size;Size;Μέγεθος';
$__LOCALE['CRMWISHFAV_DPC'][13]='_dimensions;Dimensions;Διαστάσεις';
$__LOCALE['CRMWISHFAV_DPC'][14]='_xmlcreate;Create XML;Δημιούργησε XML';
$__LOCALE['CRMWISHFAV_DPC'][15]='_xml;XML item;Είδος XML';
$__LOCALE['CRMWISHFAV_DPC'][16]='_manufacturer;Manufacturer;Κατασκευαστής';
$__LOCALE['CRMWISHFAV_DPC'][17]='_uniname1;Unit;Μον.μετρ.';
$__LOCALE['CRMWISHFAV_DPC'][18]='_ypoloipo1;Qty;Υπόλοιπο';
$__LOCALE['CRMWISHFAV_DPC'][19]='_price0;Price 1;Αξία 1';
$__LOCALE['CRMWISHFAV_DPC'][20]='_price1;Price 2;Αξία 2';
$__LOCALE['CRMWISHFAV_DPC'][21]='_name;Name;Όνομα';
$__LOCALE['CRMWISHFAV_DPC'][22]='_cat0;Category 1;Κατηγορία 1';
$__LOCALE['CRMWISHFAV_DPC'][23]='_cat1;Category 2;Κατηγορία 2';
$__LOCALE['CRMWISHFAV_DPC'][24]='_cat2;Category 3;Κατηγορία 3';
$__LOCALE['CRMWISHFAV_DPC'][25]='_cat3;Category 4;Κατηγορία 4';
$__LOCALE['CRMWISHFAV_DPC'][26]='_cat4;Category 5;Κατηγορία 5';
$__LOCALE['CRMWISHFAV_DPC'][27]='_tdata;Notes;Σημειώσεις';

$__LOCALE['CRMWISHFAV_DPC'][30]='_transactions;Transactions;Συναλλαγές';
$__LOCALE['CRMWISHFAV_DPC'][31]='_date;Date;Ημερ.';
$__LOCALE['CRMWISHFAV_DPC'][32]='_time;Time;Ώρα';
$__LOCALE['CRMWISHFAV_DPC'][33]='_status;Status;Φάση';
$__LOCALE['CRMWISHFAV_DPC'][34]='_payway;Pay method;Πληρωμή';
$__LOCALE['CRMWISHFAV_DPC'][35]='_roadway;Delivery;Διανομή';
$__LOCALE['CRMWISHFAV_DPC'][36]='_qty;Qty;Ποσοτ.';
$__LOCALE['CRMWISHFAV_DPC'][37]='_cost;Cost A;Κόστος A';
$__LOCALE['CRMWISHFAV_DPC'][38]='_costpt;Cost B;Κόστος B';
$__LOCALE['CRMWISHFAV_DPC'][39]='_xxx;Cost B;Κόστος Β';
$__LOCALE['CRMWISHFAV_DPC'][40]='_user;User;Πελάτης';
$__LOCALE['CRMWISHFAV_DPC'][41]='Eurobank;Credit card;Πιστωτική κάρτα';  
$__LOCALE['CRMWISHFAV_DPC'][42]='Piraeus;Credit card;Πιστωτική κάρτα';  
$__LOCALE['CRMWISHFAV_DPC'][43]='Paypal;Credit card;Πιστωτική κάρτα';  
$__LOCALE['CRMWISHFAV_DPC'][44]='PayOnsite;Pay on site;Πληρωμή στο κατάστημά μας'; 
$__LOCALE['CRMWISHFAV_DPC'][45]='BankTransfer;Bank transfer;Κατάθεση σε τραπεζικό λογαριασμό'; 
$__LOCALE['CRMWISHFAV_DPC'][46]='PayOndelivery;Pay on delivery;Αντικαταβολή'; 
$__LOCALE['CRMWISHFAV_DPC'][47]='Invoice;Invoice;Τιμολόγιο'; 
$__LOCALE['CRMWISHFAV_DPC'][48]='Receipt;Receipt;Απόδειξη'; 
$__LOCALE['CRMWISHFAV_DPC'][49]='CompanyDelivery;Our Delivery Service;Διανομή με όχημα της εταιρείας'; 
$__LOCALE['CRMWISHFAV_DPC'][50]='Logistics;3d Party Logistic Service;Μεταφορική εταιρεία'; 
$__LOCALE['CRMWISHFAV_DPC'][51]='Courier;Courier;Courier'; 
$__LOCALE['CRMWISHFAV_DPC'][52]='CustomerDelivery;Self Service;Παραλαβή απο το κατάστημα μας'; 



class crmwishfav extends crmmodule  {
		
	function __construct() {
	
	  crmmodule::__construct();
	}

	public function wishfav_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));
		$mode = 'd'; //override mode, allow user to add records
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('CRMWISHFAV_DPC',getlocal());
	
	    if (defined('MYGRID_DPC')) {
			
			$xsSQL2 = "SELECT * FROM (SELECT w.recid,w.cid,w.timein,w.listname,w.tid,w.tdata,w.tstatus,p.itmactive,p.active,p.code5,p.itmname,p.sysins,p.cat0,p.cat1,p.cat2,p.cat3,p.cat4 FROM wishlist w, products p WHERE w.tid=p.code5 AND w.cid='$selected' and w.listname<>'compare' and w.listname<>'wishlist') x";
			//echo $xsSQL2;
			_m("mygrid.column use grid1+recid|".localize('id',getlocal())."|2|0|||1");
			_m("mygrid.column use grid1+timein|".localize('_date',getlocal()). "|5|0|");
			_m("mygrid.column use grid1+cid|".localize('cid',getlocal())."|1|1|");	//hide by width	(insert field)	
			_m("mygrid.column use grid1+listname|".localize('_listname',getlocal()). "|5|1|");
			_m("mygrid.column use grid1+tid|".localize('_code',getlocal())."|5|1|");
		    _m("mygrid.column use grid1+itmactive|".localize('_active',getlocal())."|2|0|");		
			_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|2|0|");
			_m("mygrid.column use grid1+code5|".localize('_code',getlocal())."|link|4|"."javascript:showdetails(\"{tid}~$selected\");".'||');
			_m("mygrid.column use grid1+sysins|".localize('_date',getlocal())."|5|0|");			
			_m("mygrid.column use grid1+itmname|".localize('_title',getlocal())."|10|0|");	
			_m("mygrid.column use grid1+cat0|".localize('_cat0',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat1|".localize('_cat1',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat2|".localize('_cat2',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat3|".localize('_cat3',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat4|".localize('_cat4',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+tdata|".localize('_tdata',getlocal())."|10|1|");	
			_m("mygrid.column use grid1+tstatus|".localize('_status',getlocal())."|2|1|");				
			$ret .= _m("mygrid.grid use grid1+wishlist+$xsSQL2+$mode+$title+recid+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	
	
	
	//return array of purchased item's documents
	protected function getPurchased($id=null, $cid=null) {
       $db = GetGlobal('db');
	   
	   //search serialized data for id
	   $sSQL = "select tid from transactions " . 
	           "where tdata like'%" . $id ."%' and cid= " . $db->qstr($cid);
       $result = $db->Execute($sSQL,2);
	   //echo $sSQL;
	   
	   foreach ($result as $n=>$rec) {	
		 $ret[] = $rec['tid'];	
	   }
	   return $ret;   	   	
	}	
	
	protected function purchased_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));
		$s = explode('~', $selected);
		$id = $s[0];
		$cid = $s[1];

	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_transactions',getlocal());  
	
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
			
			$doclist = $this->getPurchased($id, $cid);
			if (!empty($doclist))
				$dSQL = ' AND i.tid in (' . implode(',', $doclist) . ')';
			else
				$dSQL = ' AND i.tid=0'; //dummy, null grid
			
			$xsSQL2 = "SELECT * FROM (SELECT DISTINCT i.recid,i.tid,i.cid,i.tdate,i.ttime,i.tstatus,$lookup1,$lookup2,i.qty,i.cost,i.costpt FROM transactions i WHERE i.cid='$cid' $dSQL) x";
			//echo $xsSQL2;

			_m("mygrid.column use grid3+recid|".localize('id',getlocal())."|5|0|||1|1");
			_m("mygrid.column use grid3+tid|".localize('id',getlocal())."|link|5|"."javascript:showdetails({tid});".'||');
			//_m("mygrid.column use grid3+cid|".localize('_user',getlocal())."|20|1|");			
			_m("mygrid.column use grid3+tdate|".localize('_date',getlocal())."|date|0|");
		    _m("mygrid.column use grid3+ttime|".localize('_time',getlocal())."|9|0|");	
			_m("mygrid.column use grid3+tstatus|".localize('_status',getlocal())."|5|0|||||right");	
		    _m("mygrid.column use grid3+pw|".localize('_payway',getlocal())."|20|1|");			
		    _m("mygrid.column use grid3+rw|".localize('_roadway',getlocal())."|20|1|");
	        _m("mygrid.column use grid3+qty|".localize('_qty',getlocal())."|5|0|||||right");				
			_m("mygrid.column use grid3+cost|".localize('_cost',getlocal())."|5|0|||||right");
			_m("mygrid.column use grid3+costpt|".localize('_costpt',getlocal())."|5|0|||||right");
			
			$ret .= _m("mygrid.grid use grid3+transactions+$xsSQL2+$mode+$title+recid+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	
	
	public function purchased() {
		$out = $this->purchased_grid(null,250,10,'r',true);
		return ($out);
	}	

	public function showdetails($data=null) {
		
		//return ("details:" . $data);
		//echo $data.'>';
		
		//if ($data<50000) //tid is 1000... when item code start from 50000... (test do not use in production)
		if ((is_numeric($data)) && (intval($data)<50000))	
			$bodyurl = 'cptransactions.php?t=cptranslink&tid='.$data;
		else	
			$bodyurl = 'cpcrm.php?t=cpcrmrun&mod=crmwishcmp.purchased&id='.$data; 
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";    

		return ($frame);		
	}	
	
};
}
?>