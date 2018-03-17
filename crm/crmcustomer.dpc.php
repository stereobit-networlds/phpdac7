<?php
$__DPCSEC['CRMCUSTOMER_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CRMCUSTOMER_DPC")) && (seclevel('CRMCUSTOMER_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CRMCUSTOMER_DPC",true);

$__DPC['CRMCUSTOMER_DPC'] = 'crmcustomer';

$b = GetGlobal('controller')->require_dpc('crm/crmmodule.dpc.php');
require_once($b);

$__LOCALE['CRMCUSTOMER_DPC'][0]='CRMCUSTOMER_DPC;Client;Πελάτης';
$__LOCALE['CRMCUSTOMER_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['CRMCUSTOMER_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['CRMCUSTOMER_DPC'][3]='_address;Address;Διεύθυνση';
$__LOCALE['CRMCUSTOMER_DPC'][4]='_tel;Tel.;Τηλέφωνο';
$__LOCALE['CRMCUSTOMER_DPC'][5]='_mob;Mobile;Κινητό';
$__LOCALE['CRMCUSTOMER_DPC'][6]='_mail;e-mail;e-mail';
$__LOCALE['CRMCUSTOMER_DPC'][7]='_fax;Fax;Fax';
$__LOCALE['CRMCUSTOMER_DPC'][8]='_ptype;Price type;Τύπος Τιμών';
$__LOCALE['CRMCUSTOMER_DPC'][9]='_name;Name;Όνομα';
$__LOCALE['CRMCUSTOMER_DPC'][10]='_afm;Vat ID;ΑΦΜ';
$__LOCALE['CRMCUSTOMER_DPC'][11]='_area;Area;Περιοχή';
$__LOCALE['CRMCUSTOMER_DPC'][12]='_prfdescr;Occupation;Επάγγελμα';
$__LOCALE['CRMCUSTOMER_DPC'][13]='_doy;DOY.;ΔΟΥ.';
$__LOCALE['CRMCUSTOMER_DPC'][14]='_street;Street;Οδός';
$__LOCALE['CRMCUSTOMER_DPC'][15]='_number;No;Αριθμος';
$__LOCALE['CRMCUSTOMER_DPC'][16]='_city;City;Πόλη';
$__LOCALE['CRMCUSTOMER_DPC'][17]='_attr1;P1;P1';
$__LOCALE['CRMCUSTOMER_DPC'][18]='_attr2;P2;P2';
$__LOCALE['CRMCUSTOMER_DPC'][19]='_attr3;P3;P3';
$__LOCALE['CRMCUSTOMER_DPC'][20]='_attr4;P4;P4';
$__LOCALE['CRMCUSTOMER_DPC'][21]='_custaddress;Addresses;Διευθύνσεις';
$__LOCALE['CRMCUSTOMER_DPC'][22]='_active;Active;Ενεργός';
$__LOCALE['CRMCUSTOMER_DPC'][23]='_code2;Code;Κωδικός';



class crmcustomer extends crmmodule  {
		
	function __construct() {
	
	  crmmodule::__construct();
	}

	public function customer_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('CRMCUSTOMER_DPC',getlocal());
	
	    if (defined('MYGRID_DPC')) {
			
			$xsSQL2 = "SELECT * FROM (SELECT id,timein,active,code2,name,afm,eforia,prfdescr,street,address,number,area,city,zip,voice1,voice2,fax,mail,attr1,attr2,attr3,attr4 FROM customers WHERE code2='$selected' or mail='$selected') x";
			//$out.= $xsSQL2;
			_m("mygrid.column use grid2+id|".localize('id',getlocal())."|5|0|||1");
			_m("mygrid.column use grid2+timein|".localize('_date',getlocal()). "|10|0|");
			_m("mygrid.column use grid2+active|".localize('_active',getlocal())."|boolean|1|");	
			_m("mygrid.column use grid2+code2|".localize('_code2',getlocal())."|10|0||||1|");
			_m("mygrid.column use grid2+name|".localize('_name',getlocal())."|link|30|"."javascript:showdetails(\"{code2}\");".'||');
		    _m("mygrid.column use grid2+prfdescr|".localize('_prfdescr',getlocal())."|20|1|");			
		    _m("mygrid.column use grid2+afm|".localize('_afm',getlocal())."|10|1|");
	        _m("mygrid.column use grid2+eforia|".localize('_doy',getlocal())."|20|1|");				
		    _m("mygrid.column use grid2+street|".localize('_street',getlocal())."|20|1|");
			_m("mygrid.column use grid2+address|".localize('_address',getlocal())."|30|1|");
			_m("mygrid.column use grid2+number|".localize('_number',getlocal())."|5|1|");
			_m("mygrid.column use grid2+area|".localize('_area',getlocal())."|10|1|");
		    _m("mygrid.column use grid2+city|".localize('_city',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+zip|".localize('_zip',getlocal())."|10|1|||1|1");
			_m("mygrid.column use grid2+voice1|".localize('_tel',getlocal())."|10|1|");
		    _m("mygrid.column use grid2+voice2|".localize('_tel',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+fax|".localize('_fax',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+mail|".localize('_mail',getlocal())."|20|1|");
			_m("mygrid.column use grid2+attr1|".localize('_attr1',getlocal())."|5|1|");
		    _m("mygrid.column use grid2+attr2|".localize('_attr2',getlocal())."|5|1|");							
			_m("mygrid.column use grid2+attr3|".localize('_attr3',getlocal())."|5|1|");
		    _m("mygrid.column use grid2+attr4|".localize('_attr4',getlocal())."|5|1|");			

			$ret .= _m("mygrid.grid use grid2+customers+$xsSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	
	
	protected function address_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));

	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_custaddress',getlocal());  
	
	    if (defined('MYGRID_DPC')) {
			
			$xsSQL2 = "SELECT * FROM (SELECT id,ccode,active,address,area,zip,voice1,voice2,fax,mail FROM custaddress WHERE ccode='$selected') x";
			//echo $xsSQL2;
			_m("mygrid.column use grid2+id|".localize('id',getlocal())."|5|0|||1");
			_m("mygrid.column use grid2+active|".localize('_active',getlocal())."|boolean|1|");	
			//_m("mygrid.column use grid2+ccode|".localize('_code2',getlocal())."20|0|");
			_m("mygrid.column use grid2+address|".localize('_address',getlocal())."|20|1|");
			_m("mygrid.column use grid2+area|".localize('_area',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+zip|".localize('_zip',getlocal())."|10|1|||1|1");
			_m("mygrid.column use grid2+voice1|".localize('_tel',getlocal())."|10|1|");
		    _m("mygrid.column use grid2+voice2|".localize('_tel',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+fax|".localize('_fax',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+mail|".localize('_mail',getlocal())."|20|1|");	
			
			$ret .= _m("mygrid.grid use grid2+custaddress+$xsSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	
	
	public function address() {
		$out = $this->address_grid(null,250,10,'r',true);
		return ($out);
	}	
	
	protected function user_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));

	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_custaddress',getlocal());  
	
	    if (defined('MYGRID_DPC')) {
			
			$xsSQL = "SELECT * from (select id,timein,code2,ageid,cntryid,lanid,timezone,email,notes,fname,lname,username,seclevid from users) o ";		   
		   
			_m("mygrid.column use grid1+id|".localize('id',getlocal())."|5|0|||1");
			_m("mygrid.column use grid1+timein|".localize('_date',getlocal())."|5|0|");	   
			_m("mygrid.column use grid1+notes|".localize('_active',getlocal())."|5|1|");
			_m("mygrid.column use grid1+username|".localize('_username',getlocal())."|10|1|");						
			_m("mygrid.column use grid1+fname|".localize('_fname',getlocal())."|19|1|");
			_m("mygrid.column use grid1+lname|".localize('_lname',getlocal())."|19|1|");
			_m("mygrid.column use grid1+ageid|".localize('_age',getlocal())."|2|1|");
			_m("mygrid.column use grid1+cntryid|".localize('_country',getlocal())."|2|1|");
			_m("mygrid.column use grid1+lanid|".localize('_language',getlocal())."|2|1|");
			_m("mygrid.column use grid1+timezone|".localize('_timezone',getlocal())."|2|1|");
			_m("mygrid.column use grid1+email|".localize('_email',getlocal())."|10|0|");
			_m("mygrid.column use grid1+code2|".localize('_code',getlocal())."|10|0|");			
			_m("mygrid.column use grid1+seclevid|".localize('_level',getlocal())."|5|1|");
		   
			$ret .= _m("mygrid.grid use grid1+user+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	
	
	public function user() {
		$out = $this->address_grid(null,250,10,'r',true);
		return ($out);
	}	
	
    protected function _checkmail($data) {

		if( !eregi("^[a-z0-9]+([_\\.-][a-z0-9]+)*" . "@([a-z0-9]+([\.-][a-z0-9]{1,})+)*$", $data, $regs) )  
			return false;

		return true;  
	}	
		
	public function showdetails($data=null) {
		
		//return ("details:" . $data);
		//echo $data.'>';
		
		/*if ($this->_checkmail($data)) //email 
			$bodyurl = 'cpcrm.php?t=cpcrmrun&mod=crmcustomer.user&id='.$data; 
		else*/ //also email		
			$bodyurl = 'cpcrm.php?t=cpcrmrun&mod=crmcustomer.address&id='.$data; 
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";    

		return ($frame);		
	}	
	
};
}
?>