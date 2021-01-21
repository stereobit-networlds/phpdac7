
$subpage = new pcntl('
super javascript;

load_extension adodb refby _ADODB_; 
super database;

/---------------------------------load and create libs
use jqgrid.jqgrid;
use i18n.i18n;

/---------------------------------load not create dpc (internal use)
#include networlds.clientdpc;	

/---------------------------------load all and create after dpc objects
public jqgrid.mygrid;
public cms.cmsrt;
#ifdef SES_LOGIN
public cp.rcampcache;
public cp.rcpmenu;
#endif
public cp.cplogin;
public cp.rccontrolpanel;
public i18n.i18nL;

',1);

$ret = $subpage->action('');

		$height = $height ? $height : 300;
        $rows = $rows ? $rows : 12;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = 'mytitle2';  
	
	    if (defined('MYGRID_DPC')) {
			
			$sSQL = "select * from (";
			$sSQL.= "SELECT id,date,tid,attr1,attr3,REMOTE_ADDR,HTTP_X_FORWARDED_FOR,HTTP_USER_AGENT from stats where tid='action'";
			$sSQL .= ') as o';  		   
			//echo $sSQL;
			_m("mygrid.column use grid1+id|".localize('_ID',getlocal()).'|2|0');
			_m("mygrid.column use grid1+date|".localize('_DATE',getlocal()).'|5|0');		   
			_m("mygrid.column use grid1+attr1|".localize('_TYPE',getlocal()).'|5|0');	
			//_m("mygrid.column use grid1+attr3|".localize('_MAIL',getlocal()).'|10|0');	
			_m("mygrid.column use grid1+REMOTE_ADDR|".localize('_ip',getlocal()).'|5|1');	
			_m("mygrid.column use grid1+HTTP_X_FORWARDED_FOR|".localize('_ip',getlocal()).'|5|1');		
			_m("mygrid.column use grid1+HTTP_USER_AGENT|".localize('_agent',getlocal()).'|10|1');		
			
			$ret .= _m("mygrid.grid use grid1+stats+$sSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';	
return $ret;
