<?php

$__DPCSEC['RCCMSVARIABLES_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCCMSVARIABLES_DPC")) && (seclevel('RCCMSVARIABLES_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCCMSVARIABLES_DPC",true);

$__DPC['RCCMSVARIABLES_DPC'] = 'rccmsvariables';

$a = GetGlobal('controller')->require_dpc('cms/cmsplus.dpc.php');
require_once($a);

$__EVENTS['RCCMSVARIABLES_DPC'][0]='cpcmsvars';
$__EVENTS['RCCMSVARIABLES_DPC'][1]='cpcmstimevars';
$__EVENTS['RCCMSVARIABLES_DPC'][2]='cpcmsvarcalendar';
$__EVENTS['RCCMSVARIABLES_DPC'][3]='cpcmsframe';
$__EVENTS['RCCMSVARIABLES_DPC'][4]='cpcmscalevents';
$__EVENTS['RCCMSVARIABLES_DPC'][5]='cpcmssavecalendar';

$__ACTIONS['RCCMSVARIABLES_DPC'][0]='cpcmsvars';
$__ACTIONS['RCCMSVARIABLES_DPC'][1]='cpcmstimevars';
$__ACTIONS['RCCMSVARIABLES_DPC'][2]='cpcmsvarcalendar';
$__ACTIONS['RCCMSVARIABLES_DPC'][3]='cpcmsframe';
$__ACTIONS['RCCMSVARIABLES_DPC'][4]='cpcmscalevents';
$__ACTIONS['RCCMSVARIABLES_DPC'][5]='cpcmssavecalendar';

$__DPCATTR['RCCMSVARIABLES_DPC']['cpcmsvariables'] = 'cpcmsvariables,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCCMSVARIABLES_DPC'][0]='RCCMSVARIABLES_DPC;Variables;Μεταβλητές';
$__LOCALE['RCCMSVARIABLES_DPC'][1]='_active;Active;Ενεργό';
$__LOCALE['RCCMSVARIABLES_DPC'][2]='_name;Name;Όνομα';
$__LOCALE['RCCMSVARIABLES_DPC'][3]='_id;Id;Α/Α';
$__LOCALE['RCCMSVARIABLES_DPC'][4]='_value;Value;Τιμή';
$__LOCALE['RCCMSVARIABLES_DPC'][5]='_date;Date;Ημερομηνία';
$__LOCALE['RCCMSVARIABLES_DPC'][6]='_varname;Var;Var';
$__LOCALE['RCCMSVARIABLES_DPC'][7]='_usevarname;Use var;Use var';
$__LOCALE['RCCMSVARIABLES_DPC'][8]='_v0;v0;v0';
$__LOCALE['RCCMSVARIABLES_DPC'][9]='_v1;v1;v1';
$__LOCALE['RCCMSVARIABLES_DPC'][10]='_v2;v2;v2';
$__LOCALE['RCCMSVARIABLES_DPC'][11]='_section;Group;Τομέας';
$__LOCALE['RCCMSVARIABLES_DPC'][12]='_cookie;Cookie;Cookie';
$__LOCALE['RCCMSVARIABLES_DPC'][13]='_session;Session;Session';
$__LOCALE['RCCMSVARIABLES_DPC'][14]='_translate;Translate;Translate';
$__LOCALE['RCCMSVARIABLES_DPC'][15]='_timetable;Timetable;Χρονοπρογραμματισμός';
$__LOCALE['RCCMSVARIABLES_DPC'][16]='_odd;Odd;Μονά';
$__LOCALE['RCCMSVARIABLES_DPC'][17]='_even;Even;Ζυγά';
$__LOCALE['RCCMSVARIABLES_DPC'][18]='_day;Day;Ημέρα';
$__LOCALE['RCCMSVARIABLES_DPC'][19]='_start;Start;Εκκίνηση';
$__LOCALE['RCCMSVARIABLES_DPC'][20]='_stop;Stop;Λήξη';
$__LOCALE['RCCMSVARIABLES_DPC'][21]='_var;Var;Μεταβλητή';
$__LOCALE['RCCMSVARIABLES_DPC'][22]='_locale;Translate;Μετάφραση';
$__LOCALE['RCCMSVARIABLES_DPC'][23]='_varlist;Variable table;Πίνακας μεταβλητών';
$__LOCALE['RCCMSVARIABLES_DPC'][24]='_calendar;Calendar;Ημερολόγιο';
$__LOCALE['RCCMSVARIABLES_DPC'][25]='_remafterdrop;Remove after drop;Αφαίρεση μετα την τοποθέτηση';
$__LOCALE['RCCMSVARIABLES_DPC'][26]='_save;Save;Αποθήκευση';
$__LOCALE['RCCMSVARIABLES_DPC'][27]='_newvar;New variable;Νέα μεταβλητή';

class rccmsvariables extends cmsplus  {

	public function __construct() {
		
		cmsplus::__construct();
	}

    public function event($event=null) {

		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;

		switch ($event) {
			case 'cpcmsframe'       :
			case 'cpcmssavecalendar': $ret = $this->calendarSave(); 
									  die($ret); //break;			
			case 'cpcmscalevents'   : $ret = $this->calendarPeriodEvents(); 
									  die($ret); //break;
			case 'cpcmsvarcalendar'	:
			case 'cpcmstimevars'    :
			case 'cpcmsvars'        :
			default                 :                    
		}
    }

    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	

		switch ($action) {
			case 'cpcmsframe'       : break;//$out = $this->add_event(); break;
			case 'cpcmssavecalendar': break;			
			case 'cpcmscalevents'   : break;
			case 'cpcmsvarcalendar' : $out .= $this->select(); 
									  break;
			
			case 'cpcmstimevars'	: $editvars = _m("cmsrt.isLevelUser use 8") ? 'd' : 'r';
			                          $out .= $this->select();
									  $out .= "<hr/>"; //"<div id='cmstimevars'></div>";
									  $out .= $this->show_timetable(null,null,null, $editvars, true);
									  break;
			
			case 'cpcmsvars'    	:
			default             	: $editvars = _m("cmsrt.isLevelUser use 8") ? 'd' : 'r';
			                          $out .= $this->select();
									  $out .= "<hr/>"; //"<div id='cmsvars'></div>";	
									  $out .= $this->show_vars(null,null,null, $editvars, true);
		}

		return ($out);
    }

	protected function select() {
		$turl1 = seturl('t=cpcmsvars');
		$turl2 = seturl('t=cpcmstimevars');		
		$turl3 = seturl('t=cpcmsvarcalendar');	
		$button = $this->createButton(localize('RCCMSVARIABLES_DPC',getlocal()), 
				  array(localize('_varlist',getlocal())=>$turl1,
						localize('_timetable',getlocal())=>$turl2,
						localize('_calendar',getlocal())=>$turl3,
		          ));
													
		return ($button);											
	}

	protected function show_vars($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 600;
        $rows = $rows ? $rows : 25;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'r';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('RCCMSVARIABLES_DPC',getlocal());		

	    if (defined('MYGRID_DPC')) {
		
			$sSQL = "select * from (";
			$sSQL.= "SELECT id,active,datein,name,value,value0,value1,value2,translate,section,cookie,session,varname,usevarname from cmsvariables";
			$sSQL .= ') as o';  		   
			//echo $sSQL;
			_m("mygrid.column use grid1+id|".localize('_id',getlocal()).'|2|0');
			_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|boolean|1|");
			_m("mygrid.column use grid1+datein|".localize('_date',getlocal()).'|8|0');		   
			_m("mygrid.column use grid1+name|".localize('_name',getlocal()).'|5|1');	
			_m("mygrid.column use grid1+value|".localize('_value',getlocal()).'|16|1');	
			_m("mygrid.column use grid1+value0|".localize('_v0',getlocal()).'|5|1');	
			_m("mygrid.column use grid1+value1|".localize('_v1',getlocal()).'|5|1');		
			_m("mygrid.column use grid1+value2|".localize('_v2',getlocal()).'|5|1');		
			_m("mygrid.column use grid1+section|".localize('_section',getlocal()).'|5|1');	
			_m("mygrid.column use grid1+translate|".localize('_translate',getlocal())."|boolean|1|");				
			_m("mygrid.column use grid1+cookie|".localize('_cookie',getlocal())."|boolean|1|");		
			_m("mygrid.column use grid1+session|".localize('_session',getlocal())."|boolean|1|");
			_m("mygrid.column use grid1+varname|".localize('_varname',getlocal()).'|5|1');	
			_m("mygrid.column use grid1+usevarname|".localize('_usevarname',getlocal())."|boolean|1|");	
			
			$out .= _m("mygrid.grid use grid1+cmsvariables+$sSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1+1");

	    }
		else 
		   $out .= 'Initialize jqgrid.';
		   
        return ($out); 
	}
	
	protected function show_timetable($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 600;
        $rows = $rows ? $rows : 25;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'r';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_timetable',getlocal());		

	    if (defined('MYGRID_DPC')) {
		
			$sSQL = "select * from (";
			$sSQL.= "SELECT id,active,datein,name,value,start,stop,inodd,ineven,inday,inmonth,inyear,isvar,islocale from cmsvartimes";
			$sSQL .= ') as o';  		   
			//echo $sSQL;
			_m("mygrid.column use grid1+id|".localize('_id',getlocal()).'|2|0');
			_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|boolean|1|");
			_m("mygrid.column use grid1+datein|".localize('_date',getlocal()).'|8|0');		   
			_m("mygrid.column use grid1+name|".localize('_name',getlocal()).'|8|1');	
			_m("mygrid.column use grid1+value|".localize('_value',getlocal()).'|16|1');	
			_m("mygrid.column use grid1+start|".localize('_start',getlocal()).'|8|1');	
			_m("mygrid.column use grid1+stop|".localize('_stop',getlocal()).'|8|1');		
			_m("mygrid.column use grid1+inodd|".localize('_odd',getlocal()).'|boolean|1');		
			_m("mygrid.column use grid1+ineven|".localize('_even',getlocal()).'|boolean|1');	
			_m("mygrid.column use grid1+inday|".localize('_day',getlocal())."|boolean|1|");				
			_m("mygrid.column use grid1+inmonth|".localize('_month',getlocal())."|boolean|1|");		
			_m("mygrid.column use grid1+inyear|".localize('_year',getlocal())."|boolean|1|");
			_m("mygrid.column use grid1+isvar|".localize('_var',getlocal()).'|boolean|1');	
			_m("mygrid.column use grid1+islocale|".localize('_locale',getlocal())."|boolean|1|");	
			
			$out .= _m("mygrid.grid use grid1+cmsvartimes+$sSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1+1");

	    }
		else 
		   $out .= 'Initialize jqgrid.';
		   
        return ($out); 
	}	
	
	protected function add_event() {
		
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

	public function variablesDrugList($gluestart=null, $glueend=null) {
		$db = GetGlobal('db');
		
		$sSQL = "select name from cmsvariables where active=1 order by name";
		$res = $db->Execute($sSQL);	

		foreach ($res as $i=>$rec)	{
			$ret .= $gluestart . $rec[0] . $glueend;
		}
		return ($ret);
	}

	public function timevariablesDrugList($gluestart=null, $glueend=null) {
		$db = GetGlobal('db');
		
		$sSQL = "select name from cmsvartimes where active=1 order by name";
		$res = $db->Execute($sSQL);	

		foreach ($res as $i=>$rec)	{
			$ret .= $gluestart . $rec[0] . $glueend;
		}
		return ($ret);
	}

	public function calendarEvents() {
		$db = GetGlobal('db');
		
		$sSQL = "select id,name,start,stop,value from cmsvartimes where active=1 order by name";
		$res = $db->Execute($sSQL);	

		/*foreach ($res as $i=>$rec)	{
			$ret[$i]['id'] = $rec[0];
			$ret[$i]['title'] = $rec[1];
			$ret[$i]['start'] = $rec[2];
			$ret[$i]['end'] = $rec[3];
			$ret[$i]['allDay'] = 'false';
		}
		return (json_encode($ret));
		
		$events[] = "{
                title: 'Lunch',
                start: new Date(y, m, d, 12, 0),
                end: new Date(y, m, d, 14, 0),
                allDay: false
            }";
		*/	
		foreach ($res as $i=>$rec)	
			$events[] = "{
				id: {$rec[0]},
                title: '{$rec[1]}: {$rec[4]}',
                start: '$rec[2]',
                end: '$rec[3]'
            }";

		$ret = (!empty($events)) ? implode(',', $events) : null;
		return ($ret);	
	}	
	
	protected function calendarPeriodEvents() {
		$db = GetGlobal('db');
		$_start = GetReq('start'); //calendar var
		$_end = GetReq('end'); //calendar var
	
		$events[] = "{
                title: 'Lunch',
                start: new Date(y, m, d, 12, 0),
                end: new Date(y, m, d, 14, 0),
                allDay: false
            }";
	
		$sSQL = "select id,name,start,stop,value from cmsvartimes where active=1";
		//$sSQL.= "and start BETWEEN STR_TO_DATE('$_start','%Y-%m-%d') AND STR_TO_DATE('$_end','%Y-%m-%d')";
		$res = $db->Execute($sSQL);	
	    //echo $sSQL; 
		/*foreach ($res as $i=>$rec)	
			$events[] = "{
				id: {$rec[0]},
                title: '{$rec[1]}',
                start: new Date(y, m, d-5),
                end: new Date(y, m, d-2)
            }";

		//$ret = (!empty($events)) ? implode(',', $events) : null;
		//return ('['. $ret .']');	
		*/
		foreach ($res as $i=>$rec)	{
			$ret[$i]['id'] = $rec[0];
			$ret[$i]['title'] = $rec[1];
			$ret[$i]['start'] = $rec[2];
			$ret[$i]['end'] = $rec[3];
			$ret[$i]['allDay'] = 'false';
		}
		return (json_encode($ret));		
	}	
	
	protected function calendarSave() {
		$db = GetGlobal('db');		
		$start = GetParam('start'); //post var
		$stop = GetParam('stop'); //post var		
		$id = GetParam('event'); //post var	
		$title = GetParam('title'); //post var	
		if ( (!$start) || (!$stop) ) return 'Date error';
		
		
		if ($id) 
			$sSQL = "update cmsvartimes set start='$start',stop='$stop' where id=" . $id;
		else
			$sSQL = "insert into cmsvartimes (name, start, stop, value, active) values ('$title','$start','$stop', 'myvalue', 1)";
		$res = $db->Execute($sSQL);			
		
		return $sSQL;
	}	

};
}
?>