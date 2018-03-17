<?php
$__DPCSEC['RCDYNSQL_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCDYNSQL_DPC")) && (seclevel('RCDYNSQL_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCDYNSQL_DPC",true);

$__DPC['RCDYNSQL_DPC'] = 'rcdynsql';
 
$__EVENTS['RCDYNSQL_DPC'][0]='cpdynsql';
$__EVENTS['RCDYNSQL_DPC'][1]='cpsqlshow';
$__EVENTS['RCDYNSQL_DPC'][2]='cpsqlsave';
$__EVENTS['RCDYNSQL_DPC'][3]='cpdynview';
$__EVENTS['RCDYNSQL_DPC'][4]='cptransviewhtml';
$__EVENTS['RCDYNSQL_DPC'][5]='cploadframe';
$__EVENTS['RCDYNSQL_DPC'][6]='cpsqlrun';

$__ACTIONS['RCDYNSQL_DPC'][0]='cpdynsql';
$__ACTIONS['RCDYNSQL_DPC'][1]='cpsqlshow';
$__ACTIONS['RCDYNSQL_DPC'][2]='cpsqlsave';
$__ACTIONS['RCDYNSQL_DPC'][3]='cpdynview';
$__ACTIONS['RCDYNSQL_DPC'][4]='cptransviewhtml';
$__ACTIONS['RCDYNSQL_DPC'][5]='cploadframe';
$__ACTIONS['RCDYNSQL_DPC'][6]='cpsqlrun';

$__DPCATTR['RCDYNSQL_DPC']['cpdynsql'] = 'cpdynsql,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCDYNSQL_DPC'][0]='RCDYNSQL_DPC;SyncSQL;Συγχρονισμός';
$__LOCALE['RCDYNSQL_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['RCDYNSQL_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['RCDYNSQL_DPC'][3]='_status;Status;Φάση';
$__LOCALE['RCDYNSQL_DPC'][4]='_fid;id;id';
$__LOCALE['RCDYNSQL_DPC'][5]='_savesql;Save;Save';
$__LOCALE['RCDYNSQL_DPC'][6]='_SQL;SQL Query;SQL Query';
$__LOCALE['RCDYNSQL_DPC'][7]='_xdate;X Date;X Date';
$__LOCALE['RCDYNSQL_DPC'][8]='_ref;Reference;Reference';
$__LOCALE['RCDYNSQL_DPC'][9]='_sqlres;Res;Res';
$__LOCALE['RCDYNSQL_DPC'][10]='_sqlrun;Run;Run';


class rcdynsql {

    var $title;
    var $status_sid, $status_sidexp;
	var $seclevid, $userDemoIds;
		
	public function __construct() {
	
      $this->path = paramload('SHELL','prpath');
     	
	  $this->title = localize('RCDYNSQL_DPC',getlocal());		

      $this->status_sid = arrayload('RCTRANSACTIONS','sid');  
      $this->status_exp = arrayload('RCTRANSACTIONS','sidexp'); 
	  
	  $this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
	  $this->userDemoIds = array(5,6,7,8); 	    
	}
	
    public function event($event=null) {
	
	   $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   if ($login!='yes') return null;		 
	
	   switch ($event) {
	     case 'cpsqlrun'   : $this->run_sql(); 
					         echo $this->form(GetParam('tid')); die();
		                     break;		   
	     case 'cpsqlsave'  : $this->save_sql_file(); 
					         echo $this->form(GetParam('tid')); die();
		                     break;	   
		 case 'cpdynview'  : echo $this->form(GetReq('tid')); die();
		                     break;		   
		 case 'cploadframe': echo $this->loadframe('trans');
		                     die();
		                     break;		
							 
		 case 'cpsqlshow'	: if (!$cvid = GetParam('statsid')) $cvid=-1;  
							  break; 	   
	     case 'cpdynsql'    :
		 default            : 
	   }
			
    }   
	
    public function action($action=null) {
		
	  $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	  if ($login!='yes') return null;	
	 
	  switch ($action) {	 
         case 'cpsqlrun'    :	  
	     case 'cpsqlsave'   : 	//die($this->save_sql()); 
								break;
		 case 'cpdynview'   : 	break;
							 	  
		 case 'cpsqlshow'	:   break; 
	     case 'cpdynsql'    :

		 default            : 	$out .= $this->show_syncs();
	  }	 

	  return ($out);
    }
	
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}		
	
	function show_syncs() {
	
	   if ($this->msg) $out = $this->msg;

	   $out = $this->show_grids();	   	
	   
	   //HIDDEN FIELD TO HOLD STATS ID FOR AJAX HANDLE
	   //$out .= "<INPUT TYPE= \"hidden\" ID= \"statsid\" VALUE=\"0\" >";	   	    
	  
	   return ($out);		   
	}		

	function show_grid($x=null,$y=null,$filter=null,$bfilter=null) {

	    if (defined('MYGRID_DPC')) {
			
								  
			$lookup2 = "ELT(FIELD(i.status, 1,0),".
				                  "'".localize('1',getlocal())."',".
								  "'".localize('0',getlocal())."') as s";								  
		
			if ($this->isDemoUser()) //search capabilities when where only in superivisor
				$where =  "where i.reference NOT LIKE 'system' and reference NOT LIKE 'cron'";

			$xsSQL2 = "SELECT * FROM (SELECT i.id,i.fid,i.time,i.date,i.execdate,i.status,i.sqlres,REPLACE(i.reference,'{$this->path}','') as reference FROM syncsql i $where) x";
				//echo $xsSQL2;

			//$out.= $xsSQL2;
			_m("mygrid.column use grid2+id|".localize('id',getlocal())."|5|1|");
            _m("mygrid.column use grid2+fid|".localize('fid',getlocal())."|link|5|"."javascript:show_body({id});".'||');
			_m("mygrid.column use grid2+date|".localize('_date',getlocal())."|5|0|");			
			_m("mygrid.column use grid2+execdate|".localize('_xdate',getlocal())."|5|0|");			
			_m("mygrid.column use grid2+status|".localize('_status',getlocal())."|5|1|");
		    _m("mygrid.column use grid2+sqlres|".localize('_sqlres',getlocal())."|10|1|");			
		    _m("mygrid.column use grid2+reference|".localize('_ref',getlocal())."|10|1|");
			$ret .= _m("mygrid.grid use grid2+syncsql+$xsSQL2+r+".localize('RCDYNSQL_DPC',getlocal())."+id+1+1+15+360+$x+0+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}
	
	function show_grids() {
	
       	$ret = "<div id='trans'></div>";	
	    $ret .= $this->show_grid();	

	    return ($ret);	
	}	
	
	protected function load_sql_file($id=null) {
		$db = GetGlobal('db'); 
		if (!$id) return;
		$sql = "select sqlquery from syncsql where id=".$id;
		$result = $db->Execute($sql);
		
		return ($result->fields['sqlquery']);
	}
	
	protected function save_sql_file() {
		$db = GetGlobal('db'); 
		if (!$id=GetParam('tid')) return;
		$sql = "UPDATE syncsql SET sqlquery=" . $db->qstr(GetParam('sqlcmd')) . "where id=".$id;
		$result = $db->Execute($sql,2);

		return (true);
	}

	protected function save_sql() {
       if (GetParam('tid'))
			return (GetParam('sqlcmd'));	
		
	} 

	protected function run_sql() {
		$db = GetGlobal('db'); 
		if (!$id=GetParam('tid')) return;
		$sql = "select sqlquery from syncsql where id=".$id;
		$result = $db->Execute($sql);
		
		if ($query = $result->fields[0]) {
			$result = $db->Execute($query);
		}

		return (true);
	}
	
	
    protected function form($id=null)  { 
	   $readonly = $this->isDemoUser() ? 'readonly' : null; 
       $filename = seturl("t=cpsqlsave");      
	   $filename2 = seturl("t=cpsqlrun");
	   
   
       //show/update qry form
       $toprint = "<FORM action=". "$filename" . " method=post>";
       $toprint .= "<FONT face=\"Arial, Helvetica, sans-serif\" size=1>";
	   
       $toprint .= "<DIV class=\"monospace\"><TEXTAREA style=\"width:100%\" NAME=\"sqlcmd\" ROWS=14 cols=60 wrap=\"virtual\" $readonly>";
	   $toprint .=  $this->load_sql_file($id);		 
       $toprint .= "</TEXTAREA></DIV><br>";	   
	   
       if (!$this->isDemoUser()) { 
			if ($_POST['sqlcmd']) $toprint .= 'Saved';
			$toprint .= "<input type=\"hidden\" name=\"FormName\" value=\"savesql\">"; 
			$toprint .= "<input type=\"hidden\" name=\"tid\" value=\"".$id."\">";
			$toprint .= "<INPUT type=\"submit\" name=\"submit\" value=\"" . localize('_savesql',getlocal()) . "\">&nbsp;";  
			$toprint .= "<INPUT type=\"hidden\" name=\"FormAction\" value=\"cpsqlsave\">";
	   }	
	   	    
       $toprint .= "</FONT></FORM>"; 
	   
	   //run query form
       if (!$this->isDemoUser()) { 
			if ($_POST['tid']) $toprint .= 'Executed';
	        $toprint .= "<FORM action=". "$filename2" . " method=post>";
			$toprint .= "<FONT face=\"Arial, Helvetica, sans-serif\" size=1>";
			$toprint .= "<input type=\"hidden\" name=\"FormName\" value=\"runsql\">"; 
			$toprint .= "<input type=\"hidden\" name=\"tid\" value=\"".$id."\">";
			$toprint .= "<INPUT type=\"submit\" name=\"submit\" value=\"" . localize('_sqlrun',getlocal()) . "\">&nbsp;";  
			$toprint .= "<INPUT type=\"hidden\" name=\"FormAction\" value=\"cpsqlrun\">";				
			$toprint .= "</FONT></FORM>"; 
   	   }	   

       return ($toprint);
    }		
	
	
	function loadframe($ajaxdiv=null) {
	    $bodyurl = seturl("t=cpdynview&tid=").GetReq('tid');
		$frame = "<html><head></head><iframe src =\"$bodyurl\" width=\"100%\" height=\"300px\"><p>Your browser does not support iframes</p></iframe></html>";    

		if ($ajaxdiv)
			return $ajaxdiv.'|'.$frame;
		else
			return ($frame);
	}
};
}
?>