<?php

$__DPCSEC['RCCUSTOMERS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCCUSTOMERS_DPC")) && (seclevel('RCCUSTOMERS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCCUSTOMERS_DPC",true);

$__DPC['RCCUSTOMERS_DPC'] = 'rccustomers';

$b = GetGlobal('controller')->require_dpc('bshop/shcustomers.dpc.php');
require_once($b);

$__EVENTS['RCCUSTOMERS_DPC'][0]='cpcustomers';
$__EVENTS['RCCUSTOMERS_DPC'][1]='delcustomer';
$__EVENTS['RCCUSTOMERS_DPC'][2]='regcustomer';
$__EVENTS['RCCUSTOMERS_DPC'][3]='cpcusmail';
$__EVENTS['RCCUSTOMERS_DPC'][4]='cpcusmsend';
$__EVENTS['RCCUSTOMERS_DPC'][5]='cpctype';
$__EVENTS['RCCUSTOMERS_DPC'][6]='insert2';
$__EVENTS['RCCUSTOMERS_DPC'][7]='signup3';
$__EVENTS['RCCUSTOMERS_DPC'][8]='updcustomer';
$__EVENTS['RCCUSTOMERS_DPC'][9]='saveupdcus';
$__EVENTS['RCCUSTOMERS_DPC'][10]='caddress';

$__ACTIONS['RCCUSTOMERS_DPC'][0]='cpcustomers';
$__ACTIONS['RCCUSTOMERS_DPC'][1]='delcustomer';
$__ACTIONS['RCCUSTOMERS_DPC'][2]='regcustomer';
$__ACTIONS['RCCUSTOMERS_DPC'][3]='cpcusmail';
$__ACTIONS['RCCUSTOMERS_DPC'][4]='cpcusmsend';
$__ACTIONS['RCCUSTOMERS_DPC'][5]='cpctype';
$__ACTIONS['RCCUSTOMERS_DPC'][6]='insert2';
$__ACTIONS['RCCUSTOMERS_DPC'][7]='signup3';
$__ACTIONS['RCCUSTOMERS_DPC'][8]='updcustomer';
$__ACTIONS['RCCUSTOMERS_DPC'][9]='saveupdcus';
$__ACTIONS['RCCUSTOMERS_DPC'][10]='caddress';

$__DPCATTR['RCCUSTOMERS_DPC']['cpcustomers'] = 'cpcustomers,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCCUSTOMERS_DPC'][0]='RCCUSTOMERS_DPC;Customers;Πελάτες';
$__LOCALE['RCCUSTOMERS_DPC'][1]='_reason;Reason;Αιτία';
$__LOCALE['RCCUSTOMERS_DPC'][2]='_cdate;Date in;Ημ/νία εισοδου';
$__LOCALE['RCCUSTOMERS_DPC'][3]='_price;Price;Τιμή';
$__LOCALE['RCCUSTOMERS_DPC'][4]='_ftype;Pay;Πληρωμή';
$__LOCALE['RCCUSTOMERS_DPC'][5]='_name1;First Name;Ονομα';
$__LOCALE['RCCUSTOMERS_DPC'][6]='_name2;Last Name;Επώνυμο';
$__LOCALE['RCCUSTOMERS_DPC'][7]='_kybismos;Kyb.;Κυβικα';
$__LOCALE['RCCUSTOMERS_DPC'][8]='_color;Color;Χρώμα';
$__LOCALE['RCCUSTOMERS_DPC'][9]='_extras;Extras;Εχτρα';
$__LOCALE['RCCUSTOMERS_DPC'][10]='_address;Address;Διεύθυνση';
$__LOCALE['RCCUSTOMERS_DPC'][11]='_tel;Tel.;Τηλέφωνο';
$__LOCALE['RCCUSTOMERS_DPC'][12]='_mob;Mobile;Κινητό';
$__LOCALE['RCCUSTOMERS_DPC'][13]='_mail;e-mail;e-mail';
$__LOCALE['RCCUSTOMERS_DPC'][14]='_fax;Fax;Fax';
$__LOCALE['RCCUSTOMERS_DPC'][15]='_ptype;Price type;Τύπος Τιμών';
$__LOCALE['RCCUSTOMERS_DPC'][16]='_name;Name;Όνομα';
$__LOCALE['RCCUSTOMERS_DPC'][17]='_afm;Vat ID;ΑΦΜ';
$__LOCALE['RCCUSTOMERS_DPC'][18]='_area;Area;Περιοχή';
$__LOCALE['RCCUSTOMERS_DPC'][19]='_prfdescr;Occupation;Επάγγελμα';
$__LOCALE['RCCUSTOMERS_DPC'][20]='_doy;DOY;ΔΟΥ';
$__LOCALE['RCCUSTOMERS_DPC'][21]='_street;Street;Οδός';
$__LOCALE['RCCUSTOMERS_DPC'][22]='_number;No;Αριθμος';
$__LOCALE['RCCUSTOMERS_DPC'][23]='_city;City;Πόλη';
$__LOCALE['RCCUSTOMERS_DPC'][24]='_p1;P1;P1';
$__LOCALE['RCCUSTOMERS_DPC'][25]='_p2;P2;P2';
$__LOCALE['RCCUSTOMERS_DPC'][26]='_p3;P3;P3';
$__LOCALE['RCCUSTOMERS_DPC'][27]='_p4;P4;P4';
$__LOCALE['RCCUSTOMERS_DPC'][28]='_custaddress;Addresses;Διευθύνσεις';
$__LOCALE['RCCUSTOMERS_DPC'][29]='_active;Active;Ενεργός';
$__LOCALE['RCCUSTOMERS_DPC'][30]='_code2;Code;Κωδικός';
$__LOCALE['RCCUSTOMERS_DPC'][31]='_country;Country;Χώρα';

class rccustomers extends shcustomers {

    var $title;
	var $msg;
	var $path, $urlpath, $inpath;
	var $post;
	var $actcode;
	var $updrec;
	var $usemailasusername;

	public function __construct() {
	  
		shcustomers::__construct();
		
		$this->title = localize('RCCUSTOMERS_DPC',getlocal());	
		$this->path = paramload('SHELL','prpath'); 
		
        $this->delete = localize('_delete',getlocal());
        $this->edit = localize('_edit',getlocal());
        $this->add = localize('_add',getlocal());
        $this->mail = localize('_mail',getlocal());
        $this->type = localize('_ptype',getlocal());
		
		$this->msg = null;	
		$this->sep = "|";
		
		$acode = remote_paramload('RCCUSTOMERS','activecode',$this->path);
		$this->actcode = 'id';
	}

    public function event($event=null) {

		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;

		switch ($event) {
		   
			case 'caddress'   :	break;		   

			case "signup3"    :	if (!$this->checkFields())
									$this->insert();
								break;

			case 'cpctype'    : $this->make_cus_type();
								break;
			case 'cpcusmsend' : $this->send_mail();
								break;
			case 'cpcusmail'  : break;
			case 'regcustomer': break;
			case 'updcustomer': $this->updrec = $this->getcustomer(GetReq('rec'),$this->actcode);
								break;
			case 'saveupdcus' : $this->update(GetReq('rec'),$this->actcode);
								break;
			case 'delcustomer': $this->delete_customer(GetReq('rec'),$this->actcode);
								break;
			case 'cpcustomers':
			default           : 
		                      
	    }
    }

    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	

		switch ($action) {
		  
			case 'caddress'    :	$out = $this->show_custaddress();
									break;		  
			case 'cpcusmsend'  : 	$out = $this->show_customers();
									break;
			case 'cpcusmail'   : 	$out = $this->show_mail();
									break;
			case 'delcustomer' : 	$out = $this->show_customers();
									break;
			case 'regcustomer' : 	$out = $this->makeform(null,1,'signup3');
									break;
			case 'updcustomer' :	$out = $this->update_customer_form();
									break;
			case 'saveupdcus'  :
			case 'signup3'     :
			case 'cpctype'     :
			case 'cpcustomers' :
			default            :   $out = $this->show_customers();
	 }

	 return ($out);
    }
	
	
	protected function update_customer_form() {
	
		//update form
		$goto = 't=cpcustomers&rec=' . GetReq('rec');
		$out = $this->makeform($this->updrec,1,'saveupdcus',1,$goto,1);	   

		if (defined('RCTRANSACTIONS_DPC')) {
			//user transactions
			$out .= _m("rctransactions.show_grid use +150+1");	      
		}
		return ($out); 
    }		

	protected function delete_customer($id,$key=null) {
        $db = GetGlobal('db');

		$sSQL = "delete from customers where ";
		if ($key)
		  $sSQL .= $key . "=" . $id;//'' must added to param
		else
		  $sSQL .= "email = " . $db->qstr($id);

        $db->Execute($sSQL,1);
	    //echo $sSQL;

		$this->msg = "Customer with $key=$id deleted!";
	}

	protected function show_customers() {
     	$sFormErr = GetGlobal('sFormErr');

	    if ($this->msg) 
			$out = $this->msg;

        $out .= $sFormErr;

	    if (defined('MYGRID_DPC')) {
		
			$xsSQL2 = "SELECT * FROM (SELECT id,timein,active,code2,name,afm,eforia,prfdescr,street,address,number,area,city,zip,country,voice1,voice2,fax,mail,attr1,attr2,attr3,attr4 FROM customers) x";
			//$out.= $xsSQL2;
			_m("mygrid.column use grid2+id|".localize('id',getlocal())."|5|0|||1");
			_m("mygrid.column use grid2+timein|".localize('_date',getlocal()). "|10|0|");
			_m("mygrid.column use grid2+active|".localize('_active',getlocal())."|boolean|1|");	
			_m("mygrid.column use grid2+code2|".localize('_code2',getlocal())."|10|1|");
			_m("mygrid.column use grid2+name|".localize('_name',getlocal())."|link|30|".seturl('t=cptransactions&cusmail={code2}').'||');
		    _m("mygrid.column use grid2+prfdescr|".localize('_prfdescr',getlocal())."|20|1|");			
		    _m("mygrid.column use grid2+afm|".localize('_afm',getlocal())."|10|1|");
	        _m("mygrid.column use grid2+eforia|".localize('_doy',getlocal())."|20|1|");				
		    _m("mygrid.column use grid2+street|".localize('_street',getlocal())."|20|1|");
			_m("mygrid.column use grid2+address|".localize('_address',getlocal())."|link|20|".seturl('t=caddress&id={code2}').'||');
			_m("mygrid.column use grid2+number|".localize('_number',getlocal())."|5|1|");
			_m("mygrid.column use grid2+area|".localize('_area',getlocal())."|10|1|");
		    _m("mygrid.column use grid2+city|".localize('_city',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+country|".localize('_country',getlocal())."|10|1|");
			_m("mygrid.column use grid2+zip|".localize('_zip',getlocal())."|10|1|||1|1");
			_m("mygrid.column use grid2+voice1|".localize('_tel',getlocal())."|10|1|");
		    _m("mygrid.column use grid2+voice2|".localize('_tel',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+fax|".localize('_fax',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+mail|".localize('_mail',getlocal())."|20|1|");
			_m("mygrid.column use grid2+attr1|".localize('_p1',getlocal())."|5|1|");
		    _m("mygrid.column use grid2+attr2|".localize('_p2',getlocal())."|5|1|");							
			_m("mygrid.column use grid2+attr3|".localize('_p3',getlocal())."|5|1|");
		    _m("mygrid.column use grid2+attr4|".localize('_p4',getlocal())."|5|1|");			
			$out .= _m("mygrid.grid use grid2+customers+$xsSQL2+d+".localize('RCCUSTOMERS_DPC',getlocal())."+id+0+1+25+600++0+1+1");

	    }
		else 
		   $out .= 'Initialize jqgrid.';
		   
        return ($out); 
	}
	
	protected function show_custaddress($id=null) {
        $id = GetReq('id');
		$wSQL = $id ?  "where ccode='$id'" : null;

	    if (defined('MYGRID_DPC')) {
		
			$xsSQL2 = "SELECT * FROM (SELECT id,ccode,active,address,area,zip,country,voice1,voice2,fax,mail FROM custaddress $wSQL) x";
			//$out.= $xsSQL2;
			_m("mygrid.column use grid2+id|".localize('id',getlocal())."|5|0|||1");
			_m("mygrid.column use grid2+active|".localize('_active',getlocal())."|boolean|1|");	
			_m("mygrid.column use grid2+ccode|".localize('_code2',getlocal())."|20|0|");
			_m("mygrid.column use grid2+address|".localize('_address',getlocal())."|20|1|");
			_m("mygrid.column use grid2+area|".localize('_area',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+zip|".localize('_zip',getlocal())."|10|1|||1|1");
			_m("mygrid.column use grid2+country|".localize('_country',getlocal())."|10|1|");
			_m("mygrid.column use grid2+voice1|".localize('_tel',getlocal())."|10|1|");
		    _m("mygrid.column use grid2+voice2|".localize('_tel',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+fax|".localize('_fax',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+mail|".localize('_mail',getlocal())."|20|1|");			
			$out .= _m("mygrid.grid use grid2+custaddress+$xsSQL2+d+".localize('_custaddress',getlocal())."+id+0+1+25+600");

	    }
		else 
		   $out .= 'Initialize jqgrid.';
		   
        return ($out); 
	}	

	//not used
    protected function get_country_from_ip() {

		$mycountry = _m("country.find_country");
		return ($mycountry);
    }

	protected function show_mail() {
		$sFormErr = GetGlobal('sFormErr');
		$sendto = GetReq('m');

		if (defined('ABCMAIL_DPC')) {
			$ret = $sFormErr;
			$ret .= _m('abcmail.create_mail use cpcusmsend+'.$sendto);
		}
		return ($ret);
	}

	protected function send_mail() {

		if (!defined('ABCMAIL_DPC')) return;

		$from = GetParam('from');
		$to = GetParam('to');
		$subject = GetParam('subject');
		$body = GetParam('mail_text');

		if ($res = _m('abcmail.sendit use '.$from.'+'.$to.'+'.$subject.'+'.$body))
			$this->mailmsg = "Send successfull";
		else
			$this->mailmsg = "Send failed";
	}

	protected function make_cus_type() {
        $db = GetGlobal('db');
		$mycode = $this->actcode;

	    $sSQL = "select attr1 from customers where $mycode=".GetReq('rec');
		$ret = $db->Execute($sSQL,2);

		switch ($ret->fields[0]) {
		  case $this->reseller_attr  : $sw = ''; break;
		  default                    : $sw = $this->reseller_attr ;
		}

	    $sSQL = "update customers set attr1="."'$sw' where $mycode=".GetReq('rec');
		$db->Execute($sSQL,1);

		$sSQL = "update users set sesdata='' where $mycode=".GetReq('rec');
		$db->Execute($sSQL,1);
		$this->msg = "Job completed!(Customer type: $sw)";
	}
	
	//override
	protected function update($id=null,$fkey=null) {
		$db = GetGlobal('db');
	   
		if ($error = $this->checkFields(null,$this->checkuseasterisk)) {
			SetGlobal('sFormErr',$error);
			return ($error);
		}		   

		if ($this->usemailasusername) {
			if (GetParam('uname')) //= mail
				$recfields = array('name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax');
			else
				$recfields = array('name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax','mail');
		}
		else
			$recfields = array('code2','name','afm','eforia','prfdescr','address','area','zip','voice1','voice2','fax','mail');

		if (!$id) 
		 SetGlobal('sFormErr',localize('_MSG20',getlocal()));	 

		$sSQL = "update customers set ";
		$sSQL.= /*'code2='.$db->qstr(GetParam('code2')) . ',' .*/
	           'name='.$db->qstr(addslashes(GetParam('name'))) . ',' .
	           'afm='.$db->qstr(addslashes(GetParam('afm'))) . ',' .
	           'eforia='.$db->qstr(addslashes(GetParam('eforia'))) . ',' .
	           'prfdescr='.$db->qstr(addslashes(GetParam('prfdescr'))) . ',' .
	           'address='.$db->qstr(addslashes(GetParam('address'))) . ',' .
	           'area='.$db->qstr(addslashes(GetParam('area'))) . ',' .
	           'zip='.$db->qstr(addslashes(GetParam('zip'))) . ',' .
			   'country='.$db->qstr(addslashes(GetParam('country'))) . ',' .
	           'voice1='.$db->qstr(addslashes(GetParam('voice1'))) . ',' .
	           'voice2='.$db->qstr(addslashes(GetParam('voice2'))) . ',' .
	           'fax='.$db->qstr(addslashes(GetParam('fax'))) . ',' .
	           'mail='.$db->qstr(addslashes(GetParam('mail')))  .
	           " where id=".$id;// . " and " . "code2=" . $db->qstr($key);

		$result = $db->Execute($sSQL,1);

		if ($db->Affected_Rows()) {	   
			SetGlobal('sFormErr',"ok");
			return true;
		}
		else {
			//echo $db->ErrorMsg();
			SetGlobal('sFormErr',localize('_MSG20',getlocal()));
		}	 

		return false;
	}

};
}
?>