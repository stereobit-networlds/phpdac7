<?php
$__DPCSEC['CRMDASHBOARD_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CRMDASHBOARD_DPC")) && (seclevel('CRMDASHBOARD_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CRMDASHBOARD_DPC",true);

$__DPC['CRMDASHBOARD_DPC'] = 'crmdashboard';

$b = GetGlobal('controller')->require_dpc('crm/crmmodule.dpc.php');
require_once($b);

$__LOCALE['CRMDASHBOARD_DPC'][0]='CRMDASHBOARD_DPC;Dashboard;Συγκεντρωτικός πίνακας';
$__LOCALE['CRMDASHBOARD_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['CRMDASHBOARD_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['CRMDASHBOARD_DPC'][3]='_status;Status;Κατάσταση';
$__LOCALE['CRMDASHBOARD_DPC'][4]='_user;User;Πελάτης';
$__LOCALE['CRMDASHBOARD_DPC'][5]='_cid;cid;cid';


class crmdashboard extends crmmodule  {
	
	var $cptemplate;
		
	function __construct() {
	
	    crmmodule::__construct();
	  
	    $tmpl = remote_paramload('FRONTHTMLPAGE','cptemplate',$this->path);  
	    $this->cptemplate = $tmpl ? $tmpl : 'metro';	  
	}

	public function dashboard_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {

        return (false);
  	
	}	
		
	public function showdetails($data=null) {

		return (false);		
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
	
    public function select_timeline($template,$year=null, $month=null) {
		$user = urldecode(GetReq('id'));
		$year = GetParam('year') ? GetParam('year') : date('Y'); 
	    $month = GetParam('month') ? GetParam('month') : date('m');
		$daterange = GetParam('rdate');
		
		$t = ($template!=null) ? _m("cmsrt.select_template use $template+1") : null;		
	    if ($t) {
			for ($y=(date('Y')-2); $y<=intval(date('Y')); $y++) {
				$yearsli .= '<li>'. seturl("t=cpcrmdashboard&id=$user&month=".$month.'&year='.$y, $y) .'</li>';
			}
		
			for ($m=1;$m<=12;$m++) {
				$mm = sprintf('%02d',$m);
				$monthsli .= '<li>' . seturl("t=cpcrmdashboard&id=$user&month=".$mm.'&year='.$year, $mm) .'</li>';
			}	  
	  
	        $posteddaterange = $daterange ? ' &gt ' . $daterange : ($year ? ' &gt ' . $month . ' ' . $year : null) ;
	  
			$tokens[] = null;//localize('CRMDASHBOARD_DPC',getlocal()) . $posteddaterange; 
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
			if ($m = GetReq('month')) { $mstart = $m; $mend = $m;} else { $mstart = '01'; $mend = '12'; $m = '12';}
			$daysofmonth = cal_days_in_month(CAL_GREGORIAN, $m, $y);
			
			if ($istimestamp)
				$dateSQL = $sqland . " DATE($fieldname) BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";
			else
				$dateSQL = $sqland . " $fieldname BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";		
		}	
        else {
			//$dateSQL = null; 
			
			//always this year by default
			$mstart = '01'; $mend = '12';
			//always this month by default
			//$mstart = date('m'); $mend = date('m');
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

	public function mailSent() {
		$db = GetGlobal('db');
		$user = urldecode(GetReq('id'));
		
		$sSQL = "select count(id) from mailqueue where receiver='$user'";
		$sSQL.= " and active=0 and " . $this->sqlDateRange('timein', true); 
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		$ret = $this->nformat($res->fields[0]);
		
		return ($ret);
	}	
	
	public function mailtoSend() {
		$db = GetGlobal('db');
		$user = urldecode(GetReq('id'));
		
		$sSQL = "select count(id) from mailqueue where receiver='$user'";
		$sSQL.= " and active=1 and " . $this->sqlDateRange('timein', true); 
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		$ret = $this->nformat($res->fields[0]);
		
		return ($ret);
	}	
	
	public function mailsFailed() {
		$db = GetGlobal('db');
		$user = urldecode(GetReq('id'));
		
		$sSQL = "select count(id) from mailqueue where receiver='$user'";
		$sSQL.= " and active=0 and status<0 and " . $this->sqlDateRange('timein', true); 
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		$ret = $this->nformat($res->fields[0]);
		
		return ($ret);
	}

	public function mailClickPath() {
		$db = GetGlobal('db');
		$user = urldecode(GetReq('id'));
		
		$sSQL = "select count(id) from stats where attr3='$user'";
		$sSQL.= " and ref IS NOT NULL and " . $this->sqlDateRange('date', true); 
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		$ret = $this->nformat($res->fields[0]);
		
		return ($ret);
	}	
	
	public function transactions() {
		$db = GetGlobal('db');
		$user = urldecode(GetReq('id'));
		
		$sSQL = "select count(recid) from transactions where cid='$user'";
		$sSQL.= " and " . $this->sqlDateRange('timein', true); 
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		$ret = $this->nformat($res->fields[0]);
		
		return ($ret);
	}

	public function sales() {
		$db = GetGlobal('db');
		$user = urldecode(GetReq('id'));
		
		$sSQL = "select sum(costpt) from transactions where cid='$user'";
		$sSQL.= " and " . $this->sqlDateRange('timein', true); 
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		$ret = $this->nformat($res->fields[0],2);
		
		return ($ret);
	}	
	
	public function inbox() {
		$db = GetGlobal('db');
		$user = urldecode(GetReq('id'));
		
		$sSQL = "select count(id) from cform where email='$user'";
		$sSQL.= " and " . $this->sqlDateRange('date', true); 
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		$ret = $this->nformat($res->fields[0]);
		
		return ($ret);
	}	
	
	public function pageview() {
		$db = GetGlobal('db');
		$user = urldecode(GetReq('id'));
		
		$sSQL = "select count(id) from stats where attr2='$user' or attr3='$user'";
		$sSQL.= " and " . $this->sqlDateRange('date', true); 
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		$ret = $this->nformat($res->fields[0]);
		
		return ($ret);
	}	
	
	
	public function itemsPurchased() {
       $db = GetGlobal('db');
	   $user = urldecode(GetReq('id'));
	   //$ret = 0;
	   
	   //search serialized data for id
	   $sSQL = "select tdata from transactions " . 
	           "where cid= " . $db->qstr($user) . $this->sqlDateRange('timein', true, true);
       $result = $db->Execute($sSQL,2);
	   
	   foreach ($result as $n=>$rec) {	
         $tdata = $rec['tdata'];
		 
		 if ($tdata) {
		   $cdata = unserialize($tdata);
		   if (is_array($cdata)) { //if (count($cdata)>1) {//if many items
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
	   $sSQL = "select tdata from transactions " . 
	           "where cid= " . $db->qstr($user) . $this->sqlDateRange('timein', true, true);
       $result = $db->Execute($sSQL,2);
	   
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
	
};
}
?>