<?php
$__DPCSEC['RCTREE_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCTREE_DPC")) && (seclevel('RCTREE_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCTREE_DPC",true);

$__DPC['RCTREE_DPC'] = 'rctree';
 
$__EVENTS['RCTREE_DPC'][0]='cptree';
$__EVENTS['RCTREE_DPC'][1]='cptreerel';
$__EVENTS['RCTREE_DPC'][2]='cptreeleaf';
$__EVENTS['RCTREE_DPC'][3]='cptreeopt';
$__EVENTS['RCTREE_DPC'][4]='cptreerun';

$__ACTIONS['RCTREE_DPC'][0]='cptree';
$__ACTIONS['RCTREE_DPC'][1]='cptreerel';
$__ACTIONS['RCTREE_DPC'][2]='cptreeleaf';
$__ACTIONS['RCTREE_DPC'][3]='cptreeopt';
$__ACTIONS['RCTREE_DPC'][4]='cptreerun';

$__LOCALE['RCTREE_DPC'][0]='RCTREE_DPC;Tree;Δέντρο';
$__LOCALE['RCTREE_DPC'][1]='_leaf;Childs;Παιδιά';
$__LOCALE['RCTREE_DPC'][2]='_rel;Relation;Σχέση';
$__LOCALE['RCTREE_DPC'][3]='_active;Active;Ενεργό';
$__LOCALE['RCTREE_DPC'][4]='_timein;Date;Ημερομηνία';
$__LOCALE['RCTREE_DPC'][5]='_id;ID;ID';
$__LOCALE['RCTREE_DPC'][6]='_title;Title;Τίτλος';
$__LOCALE['RCTREE_DPC'][7]='_descr;Description;Περιγραφή';
$__LOCALE['RCTREE_DPC'][8]='_code;Code;Κωδικός';
$__LOCALE['RCTREE_DPC'][9]='_parent;Parent;Σχέση';
$__LOCALE['RCTREE_DPC'][10]='_orderid;Order;Σειρά';
$__LOCALE['RCTREE_DPC'][11]='_title0;Title L1;Τίτλος L1';
$__LOCALE['RCTREE_DPC'][12]='_title1;Title L2;Τίτλος L2';
$__LOCALE['RCTREE_DPC'][13]='_title2;Title L3;Τίτλος L3';
$__LOCALE['RCTREE_DPC'][14]='_tree;Tree;Δέντρο';
$__LOCALE['RCTREE_DPC'][15]='_runopts;Run Οpts;Εκτέλεση Οpts';
$__LOCALE['RCTREE_DPC'][16]='_opts;Οpts;Οpts';
$__LOCALE['RCTREE_DPC'][17]='_mode;Select;Επιλογή';

class rctree  {

    var $title, $path;
	var $seclevid, $userDemoIds;
		
	function __construct() {
	
	  $this->path = paramload('SHELL','prpath');
	  $this->title = localize('RCTREE_DPC',getlocal());	 
	  
	  $this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
	  $this->userDemoIds = array(5,6,7); //8 
	  //echo $this->seclevid;  
	}
	
    function event($event=null) {
	
	   $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   if ($login!='yes') return null;		 
	
	   switch ($event) {
		   
		 case 'cptreerun'    : $this->runTreeOpts();   
							   break;
		 case 'cptreeopt'    :
							   break;	
							 
		 case 'cptreeleaf'   : //die('test-first-level');
		                       break;
		 case 'cptreerel'    : echo $this->loadframe();
		                       die();
							   break; 	   
	     case 'cptree'       :
		 default             :    
		                      
	   }
			
    }   
	
    function action($action=null) {
		
	  $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	  if ($login!='yes') return null;	
	 
	  switch ($action) {
		  
		 case 'cptreerun'   : 
		 case 'cptreeopt'   :
							  //$edit = $this->isDemoUser() ? 'r' : 'd';
		                      //$out .= $this->opts_grid(null,140,5,$edit, true);
							  $out = $this->gridMode('opts');
							  break;		  
													  
		 case 'cptreeleaf'  : $edit = $this->isDemoUser() ? 'r' : 'd';
		                      $out = $this->childs_grid(null,340,14,$edit, true);	 
							  break; 
		 case 'cptreerel'   : 
							  break;					  
	     case 'cptree'      :
		 default            : //$edit = $this->isDemoUser() ? 'r' : 'd';
		                      //$out .= $this->tree_grid(null,140,5,$edit, true);
							  $out = $this->gridMode();	
							  
	  }	 

	  return ($out);
    }
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}		

	protected function loadframe($ajaxdiv=null) {
		$parent = GetReq('id');
		$bodyurl = seturl("t=cptreeleaf&iframe=1&id=$parent");
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"460px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}	

	protected function gridMode($mode=null) {
		$mode = GetReq('mode') ? GetReq('mode') : ($mode ? $mode : 'tree');
		$edit = $this->isDemoUser() ? 'r' : 'd';		
        
		$turl0 = seturl('t=cptree&mode=tree');		
		$turl1 = seturl('t=cptree&mode=opts');
		$turl2 = seturl('t=cptreerun&mode=opts');

		$button = $this->createButton(localize('_mode', getlocal()), 
										array(localize('_tree', getlocal())=>$turl0,
											  localize('_opts', getlocal())=>$turl1,
											  0=>'',
											  localize('_runopts', getlocal())=>$turl2,
		                                ),'success');		
																	
		switch ($mode) {
			case 'opts'     : $content = $this->opts_grid(null,140,5,'r', true); break;  
	        case 'tree'     :
			default         : $content = $this->tree_grid(null,140,5,$edit, true);
		}			
					
		//$ret = $this->window(localize('_treemap', getlocal()).': '.localize('_'.$mode, getlocal()), $button, $content);
		//return ($ret);
		
		return ($button .'<hr/>'. $content);
	}	

	protected function opts_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_opts',getlocal()); 
		
		for ($i=0;$i<4;$i++) {
			$in = $i ? strval($i) : '0';
			$opts[] = 'opt'.$in;
		}	
		$_opts = empty($opts) ? null : ',' . implode(',', $opts);

        $xsSQL = "SELECT * from (select id,dateins,activ,code$_opts from ctreeopt) o ";		   
					
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+id|".localize('id',getlocal())."|5|0|");//."|link|2|"."javascript:treerel(\"{tid}\");".'||');		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+activ|".localize('_active',getlocal())."|boolean|1|1:0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+dateins|".localize('_date',getlocal())."|5|0|"); //"|link|8|"."javascript:treerel(\"{tid}\");".'||');;//."|5|0|");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+code|".localize('_code',getlocal())."|5|0|");	
		
		foreach ($opts as $o)
			GetGlobal('controller')->calldpc_method("mygrid.column use grid1+$o|".localize($o,getlocal())."|5|0|");	

		$out = GetGlobal('controller')->calldpc_method("mygrid.grid use grid1+ctreeopt+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}		
	
	
	protected function tree_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('RCTREE_DPC',getlocal()); //localize('_items', $lan);	

        $xsSQL = "SELECT * from (select id,timein,active,tid,pid,tname,tdescr,tname0,tname1,tname2,items,users,orderid from ctree) o ";		   
					
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+id|".localize('id',getlocal())."|5|0|");//."|link|2|"."javascript:treerel(\"{tid}\");".'||');		
		//GetGlobal('controller')->calldpc_method("mygrid.column use grid1+itmactive|".localize('_active',getlocal())."|2|0|");//"|boolean|1|1:0");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+active|".localize('_active',getlocal())."|boolean|1|1:0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+timein|".localize('_date',getlocal())."|link|8|"."javascript:treerel(\"{tid}\");".'||');;//."|5|0|");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tid|".localize('_code',getlocal())."|5|1|");	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+pid|".localize('_parent',getlocal())."|5|1|");			
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tname|".localize('_title',getlocal())."|5|1|");	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tdescr|".localize('_descr',getlocal())."|5|1|");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tname0|".localize('_title0',getlocal())."|5|1|");			
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tname1|".localize('_title1',getlocal())."|5|1|");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tname2|".localize('_title2',getlocal())."|5|1|");			
		//GetGlobal('controller')->calldpc_method("mygrid.column use grid1+manufacturer|".localize('_manufacturer',getlocal())."|5|0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+items|".localize('_items',getlocal())."|boolean|1|1:0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+users|".localize('_users',getlocal())."|boolean|1|1:0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+orderid|".localize('_orderid',getlocal())."|2|1|");

		$out = GetGlobal('controller')->calldpc_method("mygrid.grid use grid1+ctree+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}		
	
	
    protected function childs_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
		$pid = GetReq('id');
	    $height = $height ? $height : 440;
        $rows = $rows ? $rows : 18;
        $width = $width ? $width : null; //wide
        $mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;					
        $lan = getlocal() ? getlocal() : 0;
		$title = localize('_leaf', $lan);	

        $xsSQL = "SELECT * from (select id,timein,active,tid,pid,tname,tdescr,tname0,tname1,tname2,items,users,orderid from ctree WHERE pid='$pid') o ";		   
					
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|");		
		//GetGlobal('controller')->calldpc_method("mygrid.column use grid1+itmactive|".localize('_active',getlocal())."|2|0|");//"|boolean|1|1:0");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+active|".localize('_active',getlocal())."|boolean|1|1:0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+timein|".localize('_date',getlocal())."|5|0|");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tid|".localize('_code',getlocal())."|5|1|");	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+pid|".localize('_parent',getlocal())."|5|1|");			
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tname|".localize('_title',getlocal())."|5|1|");	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tdescr|".localize('_descr',getlocal())."|5|1|");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tname0|".localize('_title0',getlocal())."|5|1|");			
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tname1|".localize('_title1',getlocal())."|5|1|");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+tname2|".localize('_title2',getlocal())."|5|1|");			
		//GetGlobal('controller')->calldpc_method("mygrid.column use grid1+manufacturer|".localize('_manufacturer',getlocal())."|5|0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+items|".localize('_items',getlocal())."|boolean|1|1:0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+users|".localize('_users',getlocal())."|boolean|1|1:0|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+orderid|".localize('_orderid',getlocal())."|2|1|");

		$out = GetGlobal('controller')->calldpc_method("mygrid.grid use grid1+ctree+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  
	
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
				$links .= $url ? '<li><a href="'.$url.'">'.$n.'</a></li>' : '<li class="divider"></li>';
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
							<hr/><div id="crmform"></div>
							</div>
							'.  $content .'
                        </div>
                  </div>
                </div>
            </div>
';
		return ($ret);
	}	
	
	//OPTS ////////////////////////////////////////////////////////////////////
		
	
	protected function _sqlReplace($code, $optid, $optval=null) {
		
		return "REPLACE ctreeopt set activ=1, id='$code', code='$code', opt$optid='$optval';";
	}		
	
	//truncate table
	protected function _sqlx() {
		$db = GetGlobal('db');		
		//$sSQL = 'insert into ctreemap (tid, code) values';
		//$sSQL .= ' ('. $db->qstr($tid) . ',' . $db->qstr($item) . ')';	
		
		$sSQL = "TRUNCATE TABLE ctreeopt";
		$db->Execute($sSQL);
	}		

	protected function runTreeOpts() {
		$db = GetGlobal('db');
	    $itmname = _v("cmsrt.itmname");
	    $itmdescr = _v("cmsrt.itmdescr");		
		$code = $this->fid ? $this->fid : _m("cmsrt.getmapf use code");		
		
		//$saveSQL = $this->_sqlReplace('test', 1, 'xxx');
		$this->_sqlx();		
		
		$sSQL = 'select id,tid,code from ctreemap'; //no where = all
		//if ($this->echoSQL)
			//echo $sSQL . '<br/>';	
		
		$resultset = $db->Execute($sSQL,2);			
		
		$i=0;
		foreach ($resultset as $n=>$rec) {
			
			$id = $rec['id'];
			$tid = $rec['tid'];
			$code = $rec['code'];
			if ($tid)
				$ret[$code] .= $tid . ',';
			
			$i++;
		}		
		//print_r($ret);	
		//echo $i;
		if (empty($ret)) return false;	
		
		$j=0;	
		$z=0;		
		foreach ($ret as $id=>$optlist) {
			
			$olist = explode(',', $optlist);
			//print_r($olist);
			
			foreach ($olist as $optID=>$o) {
				if ($o!='') {
					//echo '<br>' . $this->_sqlReplace($id, $optID+1, $o);
					//$db->Execute($this->_sqlReplace($id, $optID+1, $o));					
					
					if ($optID>0) {
						$sSQL = "UPDATE ctreeopt set activ=1, opt$optID='$o' where code='$id';";
						$z++;
					}	
					else	
						$sSQL = "INSERT INTO ctreeopt (activ,code,opt0) values (1, '$id', '$o');";
					
					//echo '<br>' . $sSQL;
					
					$db->Execute($sSQL);
					$j++;
				}	
			}
		}
		$sum = $j - $z;
		//echo $j . "($sum)" . $z;			
		return $j;		
	}		
	
};
}
?>