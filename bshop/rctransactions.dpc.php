<?php
$__DPCSEC['RCTRANSACTIONS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCTRANSACTIONS_DPC")) && (seclevel('RCTRANSACTIONS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCTRANSACTIONS_DPC",true);

$__DPC['RCTRANSACTIONS_DPC'] = 'rctransactions';

$d = GetGlobal('controller')->require_dpc('bshop/shtransactions.dpc.php');
require_once($d);
 
$__EVENTS['RCTRANSACTIONS_DPC'][0]='cptransactions';
$__EVENTS['RCTRANSACTIONS_DPC'][1]='cptransshow';
$__EVENTS['RCTRANSACTIONS_DPC'][2]='cptranslink';
$__EVENTS['RCTRANSACTIONS_DPC'][3]='cptransview';
$__EVENTS['RCTRANSACTIONS_DPC'][4]='cptransviewhtml';
$__EVENTS['RCTRANSACTIONS_DPC'][5]='cploadframe';

$__ACTIONS['RCTRANSACTIONS_DPC'][0]='cptransactions';
$__ACTIONS['RCTRANSACTIONS_DPC'][1]='cptranssshow';
$__ACTIONS['RCTRANSACTIONS_DPC'][2]='cptranslink';
$__ACTIONS['RCTRANSACTIONS_DPC'][3]='cptransview';
$__ACTIONS['RCTRANSACTIONS_DPC'][4]='cptransviewhtml';
$__ACTIONS['RCTRANSACTIONS_DPC'][5]='cploadframe';

$__DPCATTR['RCTRANSACTIONS_DPC']['cptransactions'] = 'cptransactions,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCTRANSACTIONS_DPC'][0]='RCTRANSACTIONS_DPC;Transactions;Συναλλαγές';
$__LOCALE['RCTRANSACTIONS_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['RCTRANSACTIONS_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['RCTRANSACTIONS_DPC'][3]='_status;Status;Φάση';
$__LOCALE['RCTRANSACTIONS_DPC'][4]='_payway;Pay method;Πληρωμή';
$__LOCALE['RCTRANSACTIONS_DPC'][5]='_roadway;Delivery;Διανομή';
$__LOCALE['RCTRANSACTIONS_DPC'][6]='_qty;Qty;Ποσοτ.';
$__LOCALE['RCTRANSACTIONS_DPC'][7]='_cost;Cost A;Κόστος A';
$__LOCALE['RCTRANSACTIONS_DPC'][8]='_costpt;Cost B;Κόστος B';
$__LOCALE['RCTRANSACTIONS_DPC'][9]='_xxx;Cost B;Κόστος Β';
$__LOCALE['RCTRANSACTIONS_DPC'][10]='_user;User;Πελάτης';
$__LOCALE['RCTRANSACTIONS_DPC'][11]='_referer;Ref;Ref';

$__LOCALE['RCTRANSACTIONS_DPC'][12]='_status0;Submited;Παρελήφθει';
$__LOCALE['RCTRANSACTIONS_DPC'][13]='_status1;Active;Ενεργή';
$__LOCALE['RCTRANSACTIONS_DPC'][14]='_status2;Processing;Επεξεργασία';
$__LOCALE['RCTRANSACTIONS_DPC'][15]='_status3;Closed;Κλεισμένο';
$__LOCALE['RCTRANSACTIONS_DPC'][16]='_status1m;Canceled;Ακυρώθηκε';
$__LOCALE['RCTRANSACTIONS_DPC'][17]='_status2m;ERROR;ERROR';
$__LOCALE['RCTRANSACTIONS_DPC'][18]='_status3m;ERROR:Send mail;ERROR:αποστολή e-mail';
$__LOCALE['RCTRANSACTIONS_DPC'][19]='_status4m;ERROR:Cast submit;ERROR:αποστολή στοιχείων';

$__LOCALE['RCTRANSACTIONS_DPC'][28]='Eurobank;Credit card;Πιστωτική κάρτα'; //used by mchoice param
$__LOCALE['RCTRANSACTIONS_DPC'][29]='Piraeus;Credit card;Πιστωτική κάρτα'; //used by mchoice param
$__LOCALE['RCTRANSACTIONS_DPC'][30]='Paypal;Credit card;Πιστωτική κάρτα'; //used by mchoice param
$__LOCALE['RCTRANSACTIONS_DPC'][31]='PayOnsite;Pay on site;Πληρωμή στο κατάστημά μας';//used by mchoice param
$__LOCALE['RCTRANSACTIONS_DPC'][32]='BankTransfer;Bank transfer;Κατάθεση σε τραπεζικό λογαριασμό';//used by mchoice param
$__LOCALE['RCTRANSACTIONS_DPC'][33]='PayOndelivery;Pay on delivery;Αντικαταβολή';//used by mchoice param
$__LOCALE['RCTRANSACTIONS_DPC'][34]='Invoice;Invoice;Τιμολόγιο';//used by mchoice param
$__LOCALE['RCTRANSACTIONS_DPC'][35]='Receipt;Receipt;Απόδειξη';//used by mchoice param
$__LOCALE['RCTRANSACTIONS_DPC'][36]='CompanyDelivery;Our Delivery Service;Διανομή με όχημα της εταιρείας';//used by mchoice param
$__LOCALE['RCTRANSACTIONS_DPC'][37]='Logistics;3d Party Logistic Service;Μεταφορική εταιρεία';//used by mchoice param
$__LOCALE['RCTRANSACTIONS_DPC'][38]='Courier;Courier;Courier';//used by mchoice param
$__LOCALE['RCTRANSACTIONS_DPC'][39]='CustomerDelivery;Self Service;Παραλαβή απο το κατάστημα μας';//used by mchoice param


class rctransactions extends shtransactions {

    var $title, $path;
    var $status_sid, $status_sidexp;
		
	public function rctransactions() {
	
		shtransactions::__construct();

		if ($tpath = paramload('RCTRANSACTIONS','path'))
			$this->path = paramload('SHELL','prpath') . $tpath;
     	 
		$this->title = localize('RCTRANSACTIONS_DPC',getlocal());		
		$this->status_sid = arrayload('RCTRANSACTIONS','sid');  
		$this->status_exp = arrayload('RCTRANSACTIONS','sidexp');    
	}
	
    public function event($event=null) {
	
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;		 
	
		switch ($event) {
			case 'cptransviewhtml' 	: 	echo $this->viewTransactionHtml();
										die();
										break;	   
			case 'cptransview'		:   break;		   
			case 'cptranslink'		:	echo $this->show_transaction_data();//'trans');
										die();
										break;	   
			case 'cploadframe'		: 	echo $this->loadframe('trans');
										die();
										break;								 
			case 'cptransshow'		:   break; 	   
			case 'cptransactions'	:
			default            	: 
		}		
    }   
	
    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	
	 
		switch ($action) {
			case 'cptransviewhtml' 	: 	//$out = $this->viewTransactionHtml();
										break;		  
			case 'cptransview'		: 	$out = $this->viewTransactions();
										break;
							 	  
			case 'cptranssshow'		:   break; 
			case 'cptransactions'   :
			default            		: 	$out .= $this->show_transactions();
		}	 

		return ($out);
    }
	
	protected function show_transactions() {	
		if ($this->msg) 
			$out = $this->msg;

		$out = $this->show_grids();	   	
	   
		//HIDDEN FIELD TO HOLD STATS ID FOR AJAX HANDLE
		$out .= "<INPUT TYPE= \"hidden\" ID= \"statsid\" VALUE=\"0\" >";	   	    
	  
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
	
	protected function getStatusELT($flname, $as=null) {
		if (!$flname) return null;
		$lan = getlocal();
		$a = $as ? "as $as" : null;
		
		$ret = "ELT(FIELD($flname, '0','1','2','3','-1','-2','-3','-4'),".
				                  "'".localize('_status0',$lan)."',".
					   		      "'".localize('_status1',$lan)."',".
								  "'".localize('_status2',$lan)."',".
								  "'".localize('_status3',$lan) . "',".
								  "'".localize('_status1m',$lan)."',".
					   		      "'".localize('_status2m',$lan)."',".
								  "'".localize('_status3m',$lan)."',".
								  "'".localize('_status4m',$lan).
								  "') $a";
		return ($ret);
	}	
	
	public function show_grid($x=null,$y=null,$filter=null,$bfilter=null) {
	    $selected_cus = urldecode(GetReq('cusmail'));
	
	    if (defined('MYGRID_DPC')) {

			$lookup1 = $this->getPaymentsELT('i.payway', 'pw'); 
			$lookup2 = $this->getTransportsELT('i.roadway', 'rw');
			$lookup3 = $this->getStatusELT('i.tstatus', 'ts');
			
		    if ($selected_cus) 
				$xsSQL2 = "SELECT * FROM (SELECT DISTINCT i.recid,i.tid,i.cid,i.tdate,i.ttime,$lookup3,$lookup1,$lookup2,i.qty,i.cost,i.costpt,i.referer FROM transactions i WHERE i.cid='$selected_cus') x";
			else 
				$xsSQL2 = "SELECT * FROM (SELECT i.recid,i.tid,i.cid,i.tdate,i.ttime,$lookup3,$lookup1,$lookup2,i.qty,i.cost,i.costpt,i.referer FROM transactions i) x";

			_m("mygrid.column use grid2+recid|".localize('id',getlocal())."|5|0|||1|1");
			//_m("mygrid.column use grid2+tid|".localize('id',getlocal())."|5|0|||0");
			//_m("mygrid.column use grid2+tid|".localize('id',getlocal())."|5|0|||1|0");//"|link|5|".seturl('t=cptransviewhtml&editmode=1&tid={tid}').'||');
			_m("mygrid.column use grid2+tid|".localize('id',getlocal())."|5|0|"); //"|link|5|"."javascript:show_body({tid});".'||');
			//_m("mygrid.column use grid2+username|".localize('_user',getlocal())."|10|0|||0|1");
			_m("mygrid.column use grid2+cid|".localize('_user',getlocal())."|link|10|"."javascript:show_body({tid});".'||');//."|20|1|");
			//_m("mygrid.column use grid2+tdate|".localize('_date',getlocal())."|boolean|1|ACTIVE:DELETED");			
			_m("mygrid.column use grid2+tdate|".localize('_date',getlocal())."|6|0|");
		    _m("mygrid.column use grid2+ttime|".localize('_time',getlocal())."|6|0|");	
			_m("mygrid.column use grid2+ts|".localize('_status',getlocal())."|10|0|");//"|2|0|||||right");	
			//_m("mygrid.column use grid2+tstatus|".localize('_status',getlocal())."|link|10|"."javascript:show_body({tid});".'||');
		    _m("mygrid.column use grid2+pw|".localize('_payway',getlocal())."|18|0|");			
		    _m("mygrid.column use grid2+rw|".localize('_roadway',getlocal())."|18|0|");
	        _m("mygrid.column use grid2+qty|".localize('_qty',getlocal())."|5|0|||||right");				
			_m("mygrid.column use grid2+cost|".localize('_cost',getlocal())."|5|0|||||right");
			_m("mygrid.column use grid2+costpt|".localize('_costpt',getlocal())."|5|0|||||right");
			_m("mygrid.column use grid2+referer|".localize('_referer',getlocal())."|10|0|");
			$ret .= _m("mygrid.grid use grid2+customers+$xsSQL2+r+".localize('RCTRANSACTIONS_DPC',getlocal())."+recid+1+1+12+300+$x+0+1+1");

	    }
		else 
			$ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}
	
	protected function show_grids() {
		
		$ret = "<div id='trans'></div>";		
		$ret .= $this->show_grid();		   
		return ($ret);	
	}	
	
	protected function show_transaction_data() {
		$db = GetGlobal('db'); 	
		$tid = GetReq('tid');
		$cid = GetReq('cid');
	  
		$customer_data = _m('shcustomers.showcustomerdata use '.$cid.'+code2');	
	
		$sSQL = "select tdata,cost,costpt from transactions where tid=".$this->initial_word.$tid;
		$result = $db->Execute($sSQL);
	  
		if (!$out = $this->loadTransactionHtml($this->initial_word.$tid)) {	
	  
			$cart_data = unserialize($result->fields['tdata']);
			$cartshow = _m('shcart.head');	  
			//print_r($cart_data);
			foreach ($cart_data as $cart_id=>$cart_val) {
				$vals = explode(';',$cart_val);
				//$cartshow .= _m('shcart.viewcart use '.$vals[0].'+'.$vals[1].'++++++++'.$vals[8].'+'.$vals[9]);
				$pvals = implode('+',$vals);
				$cartshow .= _m('shcart.viewcart use '.$pvals);
			}
	  
			$cartshow .= "<hr>".localize('_SUBTOTAL',getlocal()).':'.$result->fields['cost'].
						"<hr>".localize('_TOTAL',getlocal()).':'.$result->fields['costpt'];
	
			$ret = $customer_data . $cartshow;
	  
	
			$headtitle = paramload('SHELL','urltitle');			
			$printpage = new phtml('../themes/style.css',$ret,"<B><h1>$headtitle</h1></B>");
			$out = $printpage->render();	
			unset($printpage);	
		}  

	     return ($out);
	}
	
	protected function loadframe($ajaxdiv=null) {
		$bodyurl = seturl("t=cptranslink&tid=").GetReq('tid');
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";    
		
		return ($ajaxdiv) ? $ajaxdiv.'|'.$frame : $frame;
	}
	
	protected function loadTransactionHtml($id) {
        $file = $this->path . $id . ".html"; 

		if (is_readable($file)) {
		  $ret = @file_get_contents($file);
		  return ($ret);	
		}

		return false;
	} 		
		
	public function viewTransactionHtml($id=null) {
	    $id = $id ? $id : GetReq('tid');
        $file = $this->path . $id . ".html"; 

		if (is_readable($file)) {
		  $ret = @file_get_contents($file);
		  return ($ret);	
		}

		return false;
	} 

};
}
?>