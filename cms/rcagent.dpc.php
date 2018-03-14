<?php
$__DPCSEC['RCAGENT_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCAGENT_DPC")) && (seclevel('RCAGENT_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCAGENT_DPC",true);

$__DPC['RCAGENT_DPC'] = 'rcagent';

$__EVENTS['RCAGENT_DPC'][0]='cpagent';
$__EVENTS['RCAGENT_DPC'][1]='cpagnfetch';
$__EVENTS['RCAGENT_DPC'][2]='cpagnform';
$__EVENTS['RCAGENT_DPC'][3]='cpagentfetch';
$__EVENTS['RCAGENT_DPC'][4]='cpagndivform';
$__EVENTS['RCAGENT_DPC'][5]='cpagndivfetch';
$__EVENTS['RCAGENT_DPC'][6]='cpagnsave';
$__EVENTS['RCAGENT_DPC'][7]='cpagnsavediv';
$__EVENTS['RCAGENT_DPC'][8]='cpagentload';

$__ACTIONS['RCAGENT_DPC'][0]='cpagent';
$__ACTIONS['RCAGENT_DPC'][1]='cpagnfetch';
$__ACTIONS['RCAGENT_DPC'][2]='cpagnform';
$__ACTIONS['RCAGENT_DPC'][3]='cpagentfetch';
$__ACTIONS['RCAGENT_DPC'][4]='cpagndivform';
$__ACTIONS['RCAGENT_DPC'][5]='cpagndivfetch';
$__ACTIONS['RCAGENT_DPC'][6]='cpagnsave';
$__ACTIONS['RCAGENT_DPC'][7]='cpagnsavediv';
$__ACTIONS['RCAGENT_DPC'][8]='cpagentload';

$__LOCALE['RCAGENT_DPC'][0]='RCAGENT_DPC;Agency;Agency';
$__LOCALE['RCAGENT_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['RCAGENT_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['RCAGENT_DPC'][3]='_cdiv;Div;Τμήμα';
$__LOCALE['RCAGENT_DPC'][4]='_agn;Agents;Agents';
$__LOCALE['RCAGENT_DPC'][5]='_active;Active;Ενεργό';
$__LOCALE['RCAGENT_DPC'][6]='_title;Title;Τίτλος';
$__LOCALE['RCAGENT_DPC'][7]='_ms;ms;ms';
$__LOCALE['RCAGENT_DPC'][8]='_cpage;Page;Σελίδα';
$__LOCALE['RCAGENT_DPC'][9]='_agency;Agency;Συμπεριφορές';
$__LOCALE['RCAGENT_DPC'][10]='_agndiv;Divs;Divs';
$__LOCALE['RCAGENT_DPC'][11]='_divstats;Statistics;Στατιστική';
$__LOCALE['RCAGENT_DPC'][12]='_ip;Ip;Ip';
$__LOCALE['RCAGENT_DPC'][13]='_referer;Referer;Πηγή προέλευσης';
$__LOCALE['RCAGENT_DPC'][14]='_save;Save;Αποθήκευση';
$__LOCALE['RCAGENT_DPC'][15]='_csession;User id;Αναγνωριστικό';
$__LOCALE['RCAGENT_DPC'][16]='_cname;Name;Όνομα';
$__LOCALE['RCAGENT_DPC'][17]='_httpagent;Http agent;Http agent';

class rcagent {
	
    var $title, $path, $urlpath;
	var $seclevid, $userDemoIds;	
	
	public function __construct() {

		$this->path = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		$this->title = localize('RCAGENT_DPC',getlocal());	 
	  
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
		$this->userDemoIds = array(5,6,7,8); 		  
	}

    public function event($event=null) {
	
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;		 
	
		switch ($event) {
			
			case 'cpagentfetch' : break;
			case 'cpagentload'  : echo $this->loadAgency(); die(); break;			
		
		    case 'cpagnsave'    : break;
			case 'cpagndivsave' : break;
		
			case 'cpagndivform' : break;				
			case 'cpagnform'    : break;
			
			case 'cpagndivfetch': echo $this->loaddivframe(); die(); break;
			case 'cpagnfetch'   : echo $this->loadagnframe(); die(); break;
			
			case 'cpagent'      :
			default             :    
		                      
		}
			
    }   
	
    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	
	 
		switch ($action) {	
		
		    case 'cpagentfetch' : $out = $this->agent_grid(null,340,12,'d', true); break;
			case 'cpagentload'  : break;

		    case 'cpagnsave'    : break;
			case 'cpagndivsave' : break;			
		
			case 'cpagndivform' : $out = $this->editdiv(); break;			
			case 'cpagnform'    : $out = $this->editagn(); break;
			
			case 'cpagndivfetch': break;								  
			case 'cpagnfetch'   : break;
			
			case 'cpagent'      :
			default             : $out = $this->agencyMode();
		}	 

		return ($out);
    }
	
	protected function agencyMode() {
		$mode = GetReq('mode') ? GetReq('mode') : 'agn';
        
		$turl0 = seturl('t=cpagent&mode=agn');		
		$turl1 = seturl('t=cpagent&mode=agndiv');
		$turl2 = seturl('t=cpagent&mode=divstats');
		$button = $this->createButton(localize('_agency', getlocal()), 
										array(localize('_agn', getlocal())=>$turl0,
										      localize('_agndiv', getlocal())=>$turl1,
											  localize('_divstats', getlocal())=>$turl2,
		                                ),'success');		
																
		switch ($mode) {
	        case 'divstats' : $content = $this->divstats_grid(null,480,20,'r', true); break;
			case 'agndiv'   : $content = $this->agndiv_grid(null,140,5,'d', true); break;   
			case 'agn'      : 
			default         : $content = $this->agn_grid(null,140,5,'d', true); 
			
		}			
					
		$ret = $this->window($this->title .': '.localize('_'.$mode, getlocal()), $button, $content);
		
		return ($ret);
	}	
	
	protected function loadagnframe($ajaxdiv=null, $mode=null) {
		$id = GetParam('id');
		$cmd = 'cpagnform&id='.$id ;//$mode not used
		$bodyurl = seturl("t=$cmd&iframe=1");
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"460px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}

	protected function editagn() {
		$id = GetReq('id');
		$title = 'ID:' . $id; 
		$ret = null; //$title; //test
		
		return ($ret); //continue to page form
	}		
	
	protected function saveAgentScript($id) {	
		if ((!$id) || (!$_POST)) return null;
		$db = GetGlobal('db');
		
		$data = base64_encode(trim($_POST['formdata']));			

		$sSQL = "select cscript from cagn where id=" . $id;
		$res = $db->Execute($sSQL);	
		
		if ($res->fields[0])
			$sSQL1 = ($data) ? 
						"update cagn set cscript="  . $db->qstr($data) . " where id=" . $id :
						"update cagn set cscript='' where id=" . $id; 
		else
			$sSQL1 = ($data) ? 
						"update cagn set cscript="  . $db->qstr($data) . " where id=" . $id :
						null;
		
		if ($sSQL1)
			$db->Execute($sSQL1);
		
		return true;	
	}		
	
	public function fetchAgentScript() {
		$id = GetParam('id');
		$db = GetGlobal('db');		
		
		if ($id) 
			$ret = $this->saveAgentScript($id);
		
		$sSQL = "select cscript from cagn where id=" . $id;
		$res = $db->Execute($sSQL);	
		return (base64_decode($res->fields[0]));
	}	
	
	protected function agn_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_agn', getlocal()); 
		
        $xsSQL = "SELECT * FROM (SELECT id,ctime,active,cagent,sid FROM cagn) x";
		   							
		_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|");			
		_m("mygrid.column use grid1+ctime|".localize('_date',getlocal()) . "|link|5|"."javascript:editagn(\"{id}\");".'||');			
		_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|boolean|1|");			
		_m("mygrid.column use grid1+cagent|".localize('_title',getlocal())."|10|1|");	
		_m("mygrid.column use grid1+sid|".localize('_ms',getlocal())."|5|1|");
		
		$out = _m("mygrid.grid use grid1+cagn+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}	
	
	
	
	
	protected function loaddivframe() {
		$id = GetParam('id');
		$cmd = 'cpagndivform&id='.$id ;//$mode not used
		$bodyurl = seturl("t=$cmd&iframe=1");
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"460px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}		
	
	protected function editdiv() {
		$id = GetReq('id');
		$title = 'ID:' . $id; 
		$ret = null; //$title; //test
		
		return ($ret); //continue to page form
	}		
	
	protected function saveDivScript($id) {	
		if ((!$id) || (!$_POST)) return null;
		$db = GetGlobal('db');
		
		$data = base64_encode(trim($_POST['formdata']));			

		$sSQL = "select cscript from cagndiv where id=" . $id;
		$res = $db->Execute($sSQL);	
		
		if ($res->fields[0])
			$sSQL1 = ($data) ? 
						"update cagndiv set cscript="  . $db->qstr($data) . " where id=" . $id :
						"update cagndiv set cscript='' where id=" . $id; 
		else
			$sSQL1 = ($data) ? 
						"update cagndiv set cscript="  . $db->qstr($data) . " where id=" . $id :
						null;
		
		if ($sSQL1)
			$db->Execute($sSQL1);
		
		return true;	
	}		
	
	public function fetchDivScript() {
		$id = GetParam('id');
		$db = GetGlobal('db');		
		
		if ($id) 
			$ret = $this->saveDivScript($id);
		
		$sSQL = "select cscript from cagndiv where id=" . $id;
		$res = $db->Execute($sSQL);	
		return (base64_decode($res->fields[0]));
	}	
	
	protected function agndiv_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_agndiv',getlocal());
	
	    if (defined('MYGRID_DPC')) {
			
			$xsSQL2 = "SELECT * FROM (SELECT id,ctime,active,cid,cdiv,cpage,cbody,cms FROM cagndiv) x";
			//$out.= $xsSQL2;
			_m("mygrid.column use grid2+id|".localize('id',getlocal())."|5|0|||1");
			_m("mygrid.column use grid2+ctime|".localize('_date',getlocal())."|link|6|"."javascript:editagndiv(\"{id}\");".'||');//. "|6|0|");
			_m("mygrid.column use grid2+active|".localize('_active',getlocal())."|boolean|1|");	
			_m("mygrid.column use grid2+cid|".localize('_cname',getlocal())."|10|1|"); //|||1|"); //hide code
			_m("mygrid.column use grid2+cdiv|".localize('_cdiv',getlocal())."|10|1|");
		    _m("mygrid.column use grid2+cpage|".localize('_cpage',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+cbody|".localize('_title',getlocal())."|20|1|");
			_m("mygrid.column use grid2+cms|".localize('_ms',getlocal())."|5|1|");			

			$ret .= _m("mygrid.grid use grid2+cagndiv+$xsSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}
	
	
	protected function divstats_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_divstats', getlocal()); 
		
        $xsSQL = "SELECT * from (select id,ctime,cid,cdiv,cpage,csession,REMOTE_ADDR,HTTP_USER_AGENT,REFERER from cagnstats) o ";		   
		   							
		_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|");			
		_m("mygrid.column use grid1+ctime|".localize('_date',getlocal())."|5|0|");	
		_m("mygrid.column use grid1+cdiv|".localize('_cdiv',getlocal())."|10|0|");
		_m("mygrid.column use grid1+cpage|".localize('_cpage',getlocal())."|10|0|");
		_m("mygrid.column use grid1+csession|".localize('_csession',getlocal())."|10|0|");	
		_m("mygrid.column use grid1+REMOTE_ADDR|".localize('_ip',getlocal())."|5|0|");					
		_m("mygrid.column use grid1+HTTP_USER_AGENT|".localize('_httpagent',getlocal())."|15|0|");				
		_m("mygrid.column use grid1+REFERER|".localize('_referer',getlocal())."|10|0|");

		$out = _m("mygrid.grid use grid1+cagnstats+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}	


	protected function loadAgency($ajaxdiv=null, $mode=null) {
		$id = GetParam('id');
		$cmd = 'cpagentfetch&id='.$id ;//$mode not used
		$bodyurl = seturl("t=$cmd&iframe=1");
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"460px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}	
	
	//NOT USED
	protected function agent_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));

	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_points',getlocal());  
	
	    if (defined('MYGRID_DPC')) {
			
			$xsSQL2 = "SELECT * FROM (SELECT id,datein,ccode,active,item,source,points,notes FROM custpoints WHERE ccode='$selected') x";
			//echo $xsSQL2;
			_m("mygrid.column use grid2+id|".localize('id',getlocal())."|2|0|||1");
			_m("mygrid.column use grid2+datein|".localize('_date',getlocal())."|10|0|");			
			_m("mygrid.column use grid2+active|".localize('_active',getlocal())."|boolean|1|");	
			_m("mygrid.column use grid2+ccode|".localize('_ccode',getlocal())."|10|1|");//|||1|");
			_m("mygrid.column use grid2+item|".localize('_item',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+source|".localize('_source',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+points|".localize('_points',getlocal())."|5|1|");
			_m("mygrid.column use grid2+notes|".localize('_notes',getlocal())."|20|1|");	
			
			$ret .= _m("mygrid.grid use grid2+custpoints+$xsSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	
		
	
	protected function createButton($name=null, $urls=null, $t=null, $s=null) {
		$type = $t ? $t : 'primary'; //danger /warning / info /success
		switch ($s) {
			case 'large' : $size = 'btn-large '; break;
			case 'small' : $size = 'btn-small '; break;
			case 'mini'  : $size = 'btn-mini '; break;
			default      : $size = null;
		}
		
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
	
	
	protected function window($title, $buttons, $content) {
		$ret = '	
		    <div class="row-fluid">
                <div class="span12">
                  <div class="widget red">
                        <div class="widget-title">
                           <h4><i class="icon-reorder"></i> '.$title.'</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                        </div>
                        <div class="widget-body">
							<div class="btn-toolbar">
							'. $buttons .'
							<hr/><div id="agentform"></div>
							</div>
							'.  $content .'
                        </div>
                  </div>
                </div>
            </div>
';
		return ($ret);
	}		
	
};
}
?>