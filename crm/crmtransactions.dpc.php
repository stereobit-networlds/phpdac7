<?php
$__DPCSEC['CRMTRANSACTIONS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CRMTRANSACTIONS_DPC")) && (seclevel('CRMTRANSACTIONS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CRMTRANSACTIONS_DPC",true);

$__DPC['CRMTRANSACTIONS_DPC'] = 'crmtransactions';

$b = GetGlobal('controller')->require_dpc('crm/crmmodule.dpc.php');
require_once($b);

$__LOCALE['CRMTRANSACTIONS_DPC'][0]='CRMTRANSACTIONS_DPC;Transactions;Συναλλαγές';
$__LOCALE['CRMTRANSACTIONS_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['CRMTRANSACTIONS_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['CRMTRANSACTIONS_DPC'][3]='_status;Status;Φάση';
$__LOCALE['CRMTRANSACTIONS_DPC'][4]='_payway;Pay method;Πληρωμή';
$__LOCALE['CRMTRANSACTIONS_DPC'][5]='_roadway;Delivery;Διανομή';
$__LOCALE['CRMTRANSACTIONS_DPC'][6]='_qty;Qty;Ποσοτ.';
$__LOCALE['CRMTRANSACTIONS_DPC'][7]='_cost;Cost A;Κόστος A';
$__LOCALE['CRMTRANSACTIONS_DPC'][8]='_costpt;Cost B;Κόστος B';
$__LOCALE['CRMTRANSACTIONS_DPC'][9]='_xxx;Cost B;Κόστος Β';
$__LOCALE['CRMTRANSACTIONS_DPC'][10]='_user;User;Πελάτης';

$__LOCALE['CRMTRANSACTIONS_DPC'][28]='Eurobank;Credit card;Πιστωτική κάρτα';  
$__LOCALE['CRMTRANSACTIONS_DPC'][29]='Piraeus;Credit card;Πιστωτική κάρτα';  
$__LOCALE['CRMTRANSACTIONS_DPC'][30]='Paypal;Credit card;Πιστωτική κάρτα';  
$__LOCALE['CRMTRANSACTIONS_DPC'][31]='PayOnsite;Pay on site;Πληρωμή στο κατάστημά μας'; 
$__LOCALE['CRMTRANSACTIONS_DPC'][32]='BankTransfer;Bank transfer;Κατάθεση σε τραπεζικό λογαριασμό'; 
$__LOCALE['CRMTRANSACTIONS_DPC'][33]='PayOndelivery;Pay on delivery;Αντικαταβολή'; 
$__LOCALE['CRMTRANSACTIONS_DPC'][34]='Invoice;Invoice;Τιμολόγιο'; 
$__LOCALE['CRMTRANSACTIONS_DPC'][35]='Receipt;Receipt;Απόδειξη'; 
$__LOCALE['CRMTRANSACTIONS_DPC'][36]='CompanyDelivery;Our Delivery Service;Διανομή με όχημα της εταιρείας'; 
$__LOCALE['CRMTRANSACTIONS_DPC'][37]='Logistics;3d Party Logistic Service;Μεταφορική εταιρεία'; 
$__LOCALE['CRMTRANSACTIONS_DPC'][38]='Courier;Courier;Courier'; 
$__LOCALE['CRMTRANSACTIONS_DPC'][39]='CustomerDelivery;Self Service;Παραλαβή απο το κατάστημα μας'; 



class crmtransactions extends crmmodule  {
		
	function __construct() {
	
	  crmmodule::__construct();
	}

	public function transactions_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected_cus = urldecode(GetReq('id'));
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('CRMTRANSACTIONS_DPC',getlocal()); // .'_'. str_replace('@','AT',$selected_cus); 
	
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
		
		    if ($selected_cus) {
				$xsSQL2 = "SELECT * FROM (SELECT DISTINCT i.recid,i.tid,i.cid,i.timein,i.tstatus,$lookup1,$lookup2,i.qty,i.cost,i.costpt FROM transactions i WHERE i.cid='$selected_cus') x";
				//echo $xsSQL2;
			}
			else {
				$xsSQL2 = "SELECT * FROM (SELECT i.recid,i.tid,i.cid,i.timein,i.tstatus,$lookup1,$lookup2,i.qty,i.cost,i.costpt FROM transactions i ) x";
				//echo $xsSQL2;
			}

			_m("mygrid.column use grid3+recid|".localize('id',getlocal())."|5|0|||1|1");
			_m("mygrid.column use grid3+tid|".localize('id',getlocal())."|link|5|"."javascript:showdetails({tid});".'||');
			//_m("mygrid.column use grid3+cid|".localize('_user',getlocal())."|20|0|");			
			_m("mygrid.column use grid3+timein|".localize('_date',getlocal())."|10|0|");
		    //_m("mygrid.column use grid3+ttime|".localize('_time',getlocal())."|9|0|");	
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
		
	public function showdetails($data=null) {
		
		//return ("details:" . $data);
		
	    $bodyurl = 'cptransactions.php?t=cptranslink&tid='.$data; //seturl("t=cptranslink&tid=".$data);
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";    

		return ($frame);		
	}	
	
};
}
?>