<?php
$__DPCSEC['RCITEMREL_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCITEMREL_DPC")) && (seclevel('RCITEMREL_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCITEMREL_DPC",true);

$__DPC['RCITEMREL_DPC'] = 'rcitemrel';
 
$__EVENTS['RCITEMREL_DPC'][0]='cpitemrel';
$__EVENTS['RCITEMREL_DPC'][1]='cpirelshow';
$__EVENTS['RCITEMREL_DPC'][2]='cploadrelf';
$__EVENTS['RCITEMREL_DPC'][3]='cpireljoincat';
$__EVENTS['RCITEMREL_DPC'][4]='cpireljoinitem';
$__EVENTS['RCITEMREL_DPC'][5]='cpirelmod';
$__EVENTS['RCITEMREL_DPC'][6]='cpirelmodshow';

$__ACTIONS['RCITEMREL_DPC'][0]='cpitemrel';
$__ACTIONS['RCITEMREL_DPC'][1]='cpirelshow';
$__ACTIONS['RCITEMREL_DPC'][2]='cploadrelf';
$__ACTIONS['RCITEMREL_DPC'][3]='cpireljoincat';
$__ACTIONS['RCITEMREL_DPC'][4]='cpireljoinitem';
$__ACTIONS['RCITEMREL_DPC'][5]='cpirelmod';
$__ACTIONS['RCITEMREL_DPC'][6]='cpirelmodshow';

$__DPCATTR['RCITEMREL_DPC']['cpitemrel'] = 'cpitemrel,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCITEMREL_DPC'][0]='RCITEMREL_DPC;Relations;Συσχετισμοί';
$__LOCALE['RCITEMREL_DPC'][1]='_icat1;Category 1;Κατηγορία 1'; //for categories
$__LOCALE['RCITEMREL_DPC'][2]='_icat2;Category 2;Κατηγορία 2';
$__LOCALE['RCITEMREL_DPC'][3]='_icat3;Category 3;Κατηγορία 3';
$__LOCALE['RCITEMREL_DPC'][4]='_icat4;Category 4;Κατηγορία 4';
$__LOCALE['RCITEMREL_DPC'][5]='_icat5;Category 5;Κατηγορία 5';
$__LOCALE['RCITEMREL_DPC'][6]='_active;Active;Ενεργό';
$__LOCALE['RCITEMREL_DPC'][7]='_itmactive;Active;Ενεργό';
$__LOCALE['RCITEMREL_DPC'][8]='_itmdescr;Description;Περιγραφή';
$__LOCALE['RCITEMREL_DPC'][9]='_itmname;Title;Τίτλος';
$__LOCALE['RCITEMREL_DPC'][10]='_code;Code;Κωδικός';
$__LOCALE['RCITEMREL_DPC'][11]='_items;Items;Προϊόντα';
$__LOCALE['RCITEMREL_DPC'][12]='_categories;Categories;Κατηγορίες';
$__LOCALE['RCITEMREL_DPC'][13]='_id;ID;ID';
$__LOCALE['RCITEMREL_DPC'][14]='_ctgid;Id;A/A';
$__LOCALE['RCITEMREL_DPC'][15]='_view;View;Ορατό';
$__LOCALE['RCITEMREL_DPC'][16]='_cat0;Category 1;Κατηγορία 1'; //for items, no ITEMS cat field
$__LOCALE['RCITEMREL_DPC'][17]='_cat1;Category 2;Κατηγορία 2';
$__LOCALE['RCITEMREL_DPC'][18]='_cat2;Category 3;Κατηγορία 3';
$__LOCALE['RCITEMREL_DPC'][19]='_cat3;Category 4;Κατηγορία 4';
$__LOCALE['RCITEMREL_DPC'][20]='_cat4;Category 5;Κατηγορία 5';
$__LOCALE['RCITEMREL_DPC'][21]='_title;Title;Τίτλος';
$__LOCALE['RCITEMREL_DPC'][22]='_relatives;Relatives;Σύνδεσμοι';
$__LOCALE['RCITEMREL_DPC'][23]='_date;Date ins;Ημ/νια εισαγωγής';
$__LOCALE['RCITEMREL_DPC'][24]='_type;Type;Τύπος';
$__LOCALE['RCITEMREL_DPC'][25]='_relative;Code;Κωδικός'; //Relative;Σχετικό';
$__LOCALE['RCITEMREL_DPC'][26]='_relation;Relation;Σχετιζόμενο';
$__LOCALE['RCITEMREL_DPC'][27]='_item;Item;Item';
$__LOCALE['RCITEMREL_DPC'][28]='_child;Child;Child';
$__LOCALE['RCITEMREL_DPC'][29]='_father;Father;Father';
$__LOCALE['RCITEMREL_DPC'][30]='_category;Category;Κατηγορία';
$__LOCALE['RCITEMREL_DPC'][31]='_catalog;Katalog;Κατάλογος';
$__LOCALE['RCITEMREL_DPC'][32]='_menu;Menu;Menu';
$__LOCALE['RCITEMREL_DPC'][33]='_master;Master;Master';
$__LOCALE['RCITEMREL_DPC'][34]='_locale;Locale;Locale';
$__LOCALE['RCITEMREL_DPC'][35]='_notes;Notes;Σχόλια';
$__LOCALE['RCITEMREL_DPC'][36]='_orderid;Order ID;Α/Α';


class rcitemrel  {

    var $title, $path;
	var $field2save_cat_relation, $field2save_itm_relation;
	var $field2save_cat_separator, $field2save_itm_separator;
		
	function __construct() {
	
	  $this->path = paramload('SHELL','prpath');
	  $this->title = localize('RCITEMREL_DPC',getlocal());	

	  $this->map_t = remote_arrayload('RCITEMS','maptitle',$this->path);	
	  $this->map_f = remote_arrayload('RCITEMS','mapfields',$this->path);	  
	  
	  $this->field2save_cat_relation = remote_paramload('RCITEMREL','mapcatfield',$this->path);
	  $this->field2save_itm_relation = remote_paramload('RCITEMREL','mapitmfield',$this->path);
	  
	  $this->field2save_cat_separator = remote_paramload('RCITEMREL','sepcatchar',$this->path);
	  $this->field2save_itm_separator = remote_paramload('RCITEMREL','sepitmchar',$this->path);	  
	}
	
    function event($event=null) {
	
	   $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   if ($login!='yes') return null;		 
	
	   switch ($event) {
		 case 'cpirelmodshow': 
		                       break;  		   
		   
		 case 'cpirelmod'    : //die('test-second-level');
		                       break;  
							   
		 case 'cpireljoinitem': //die('saverel|test join other item');	
		 
                               $this->join_item_with_item(); 	
							   
							   echo $this->loadsubframe();//'saverel'); //loaded by jquery
		                       die();
							   
		 case 'cpireljoincat': //die('saverel|test join cat');	
		 
                               $this->join_item_with_category(); 	
							   
							   echo $this->loadsubframe();//'saverel'); //loaded by jquery
		                       die();
							 
		 case 'cpirelshow'   : //die('test-first-level');
		                       break;
		 case 'cploadrelf'   : echo $this->loadframe();//'relcat'); //loaded by jquery
		                       die();
							   break; 	   
	     case 'cpitemrel'    :
		 default             :    
		                      
	   }
			
    }   
	
    function action($action=null) {
		
	  $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	  if ($login!='yes') return null;	
	 
	  switch ($action) {
			
		 case 'cpirelmodshow' : $out = $this->relatives_grid(null,640,24,'d', true);
		                      break;			
		 case 'cpirelmod'     : $out = $this->relatives_grid(null,140,14,'d', true);
		                      break;
         case 'cpireljoinitem': 	
							  break;			
         case 'cpireljoincat' : 	
							  break;								  
		 case 'cpirelshow'    : if ($_GET['item']) //join with cat
									$out = $this->categories_grid(null,140,14,'r', true);
							    elseif ($_GET['id']) //join with other item
									$out = $this->otheritems_grid(null,140,14,'r', true);
								  
								$out .= "<div id='saverel'></div>"; //2nd div inside this save	 
							    break; 
		 case 'cploadrelf'  : 
							  break;					  
	     case 'cpitemrel'   :

		 default            : //$out = '<h3>'.localize('RCITEMREL_DPC',getlocal()).'</h3>';
							  $out .= $this->items_grid(null,140,14,'r', true);	
							  $out .= "<div id='relcat'></div>";//1nd div inside this show categories grid
	  }	 

	  return ($out);
    }

	protected function loadframe($ajaxdiv=null) {
		if ($item = $_GET['item']) //relate to category
			$bodyurl = seturl("t=cpirelshow&iframe=1&item=$item");
		elseif ($id = $_GET['id']) //relate to other item
			$bodyurl = seturl("t=cpirelshow&iframe=1&id=$id");
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"540px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}		
	
	protected function items_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
		$title = localize('RCITEMREL_DPC', getlocal()); 	
        $active_code = 	_m("cmsrt.getmapf use code");
		$name_active = _v("cmsrt.itmname"); 
		//$itmdescr = _v("cmsrt.itmdescr"); 
        $myfields = "id,$active_code,cat0,cat1,cat2,cat3,$name_active,itmactive,active";  		

		$xsSQL = 'select * from (select '.$myfields . ' from products) as o';
		  
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+id|".localize('_id',getlocal())."|link|5|"."javascript:relateitm({id});".'||');	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+$active_code|".localize('_code',getlocal())."|link|5|"."javascript:relatecat(\"{".$active_code."}\");".'||');		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+cat0|".localize('_cat0',getlocal())."|10|1|");
	    GetGlobal('controller')->calldpc_method("mygrid.column use grid1+cat1|".localize('_cat1',getlocal())."|10|1|");				
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+cat2|".localize('_cat2',getlocal())."|10|1|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+cat3|".localize('_cat3',getlocal())."|10|1|");
	    GetGlobal('controller')->calldpc_method("mygrid.column use grid1+$name_active|".localize('_title',getlocal()).'|20|1');	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+itmactive|".localize('_itmactive',getlocal()).'|boolean|1:0|');	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+active|".localize('_active',getlocal()).'|boolean|1|101:0');		
		$out = GetGlobal('controller')->calldpc_method("mygrid.grid use grid1+products+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width");
		
		return ($out);  	
	}
	
	
	protected function loadsubframe($ajaxdiv=null) {
	    $bodyurl = seturl("t=cpirelmod&iframe=1");
	
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"260px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}		
	
    protected function categories_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
		$item = GetReq('item');
	    $height = $height ? $height : 440;
        $rows = $rows ? $rows : 18;
        $width = $width ? $width : null; //wide
        $mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;
		$title = $this->title;						
        $lan = getlocal()?getlocal():0;

		$myfields = 'id,ctgid,';
		$mytitles = localize('id',getlocal()) . ',' . localize('_ctgid',getlocal()) . ',';
        $myfields .= /*"cat{$lan}1,*/"cat{$lan}2,cat{$lan}3,cat{$lan}4,cat{$lan}5,";
        $mytitles .= /*localize('_cat0',$lan).','.*/localize('_cat1',getlocal()) .','.
					 localize('_cat2',$lan).','.localize('_cat3',$lan).','.localize('_cat4',$lan).',';		
		$myfields .= 'active,view,search';
		$mytitles .= localize('_active',getlocal()) . ',' . localize('_view',getlocal()) . ',' . localize('_search',getlocal());
		
		$xsSQL = 'select * from (select '.$myfields . ' from categories) as o';

		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+id|".localize('_id',getlocal())."|5|0|");	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+ctgid|".localize('_ctgid',getlocal())."|link|5|"."javascript:joincat(\"$item\",{ctgid});".'||');		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+cat{$lan}2|".localize('_icat1',getlocal())."|10|1|");
	    GetGlobal('controller')->calldpc_method("mygrid.column use grid2+cat{$lan}3|".localize('_icat2',getlocal())."|10|1|");				
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+cat{$lan}4|".localize('_icat3',getlocal())."|10|1|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+cat{$lan}5|".localize('_icat4',getlocal())."|10|1|");
	    GetGlobal('controller')->calldpc_method("mygrid.column use grid2+active|".localize('_active',getlocal()).'|boolean|1');	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+search|".localize('_search',getlocal()).'|boolean|1');	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+view|".localize('_view',getlocal()).'|boolean|1');	
		
		$title = localize('_categories', getlocal());
		$out .= GetGlobal('controller')->calldpc_method("mygrid.grid use grid2+categories+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width");
	    return ($out);
	
    }	
	
	
    protected function otheritems_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
		$id = GetReq('id');
	    $height = $height ? $height : 440;
        $rows = $rows ? $rows : 18;
        $width = $width ? $width : null; //wide
        $mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;					
        $active_code = 	_m("cmsrt.getmapf use code");
		$name_active = _v("cmsrt.itmname"); 
		$title = localize('_items', getlocal());	

		$xsSQL = "select * from (select id,$active_code,cat0,cat1,cat2,cat3,$name_active,itmactive,active from products) as o";

		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+id|".localize('_id',getlocal())."|5|0|");	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+$active_code|".localize('_code',getlocal())."|link|5|"."javascript:joinitem($id,\"{".$active_code."}\");".'||');		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+cat0|".localize('_cat0',getlocal())."|10|1|");
	    GetGlobal('controller')->calldpc_method("mygrid.column use grid2+cat1|".localize('_cat1',getlocal())."|10|1|");				
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+cat2|".localize('_cat2',getlocal())."|10|1|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+cat3|".localize('_cat3',getlocal())."|10|1|");
	    GetGlobal('controller')->calldpc_method("mygrid.column use grid2+$name_active|".localize('_title',getlocal()).'|20|1');	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+itmactive|".localize('_itmactive',getlocal()).'|boolean|1|1:0|');	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid2+active|".localize('_active',getlocal()).'|boolean|1|101:0');	

		$out .= GetGlobal('controller')->calldpc_method("mygrid.grid use grid2+products+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width");
	    return ($out);
	
    }		
	
	
    protected function relatives_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
		$item = GetReq('item');
	    $height = $height ? $height : 440;
        $rows = $rows ? $rows : 18;
        $width = $width ? $width : null; //wide
        $mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;
		$title = $this->title;						
        $lan = getlocal()?getlocal():0;
		$title = localize('_relatives', $lan);
		
		$xsSQL = 'select * from (select id,timein,active,type,relative,relation,isitem,ischild,isfather,iscategory,iscatalog,ismenu,ismaster,locale,notes,orderid from relatives) as o';

		GetGlobal('controller')->calldpc_method("mygrid.column use grid3+id|".localize('_id',$lan)."|5|0|");	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid3+timein|".localize('_date',$lan)."|date|0|");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid3+active|".localize('_active',$lan)."|boolean|1|");
	    GetGlobal('controller')->calldpc_method("mygrid.column use grid3+type|".localize('_type',$lan)."|5|1|");				
		GetGlobal('controller')->calldpc_method("mygrid.column use grid3+relative|".localize('_relative',$lan)."|10|1|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid3+relation|".localize('_relation',$lan)."|10|1|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid3+isitem|".localize('_item',$lan)."|boolean|1|");		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid3+ischild|".localize('_child',$lan)."|boolean|1|");
	    GetGlobal('controller')->calldpc_method("mygrid.column use grid3+isfather|".localize('_father',$lan).'|boolean|1');	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid3+iscategory|".localize('_category',$lan).'|boolean|1');	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid3+iscatalog|".localize('_catalog',$lan).'|boolean|1');	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid3+ismenu|".localize('_menu',$lan).'|boolean|1');
		GetGlobal('controller')->calldpc_method("mygrid.column use grid3+ismaster|".localize('_master',$lan).'|boolean|1');
	    GetGlobal('controller')->calldpc_method("mygrid.column use grid3+locale|".localize('_locale',$lan)."|10|1|");
	    GetGlobal('controller')->calldpc_method("mygrid.column use grid3+notes|".localize('_notes',$lan)."|10|1|");
		GetGlobal('controller')->calldpc_method("mygrid.column use grid3+orderid|".localize('_orderid',$lan)."|5|1|");
		
		$out .= GetGlobal('controller')->calldpc_method("mygrid.grid use grid3+relatives+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
	    return ($out);
	
    }		
	
	
	protected function join_item_with_category() {
		$item = $_GET['item'];
		$jcat = $_GET['jcat'];
        $db = GetGlobal('db');
		$active_code = 	_m("cmsrt.getmapf use code");	

		//check for same entry ?..
		
        $sSQL = "insert into relatives (type,active,relative,relation,iscategory) values (";
		$sSQL.= "2,1,".$db->qstr($item).",".$db->qstr($jcat).",1)";
	    $resultset = $db->Execute($sSQL,1);	
	    $ret = $db->Affected_Rows();	

		if ($f = $this->field2save_cat_relation) {  
		    //echo 'b';
			if ($s = $this->field2save_cat_separator) {
				$sSQL1 = "select $f from products where $active_code=" . $db->qstr($item);
				$res = $db->Execute($sSQL1,2);
                $preval = $res->fields[0] ? $res->fields[0] . $s : null;
				//echo $sSQL1;
            }
			else
				$preval = null;		
			//beware of jqgrid relation delete, field in product table remain
			$sSQL2 = "update products set $f=" . $db->qstr($preval . $jcat);
			$sSQL2 .= " WHERE $active_code=" . $db->qstr($item);
			$result = $db->Execute($sSQL2,1);	
			$ret = $db->Affected_Rows();
			//echo $sSQL2;
		}		
		
		return ($ret);
	}
	
	protected function join_item_with_item() {
		$id = $_GET['item'];
		$jitem = $_GET['jitem'];
		$db = GetGlobal('db');		
		$active_code = 	_m("cmsrt.getmapf use code");
		
		//check for same entry ?..
		
		//replace id by active code
		$sSQL0 = "select $active_code from products where id=" . $id;
		$res1 = $db->Execute($sSQL0,2);
        $acode = $res1->fields[0];
		if ($acode) {

          $sSQL = "insert into relatives (type,active,relative,relation,isitem) values (";
		  $sSQL.= "1,1,".$db->qstr($acode).",".$db->qstr($jitem).",1)"; //**item id as string**
	      $resultset = $db->Execute($sSQL,1);	
	      $ret = $db->Affected_Rows();	

		  if ($f = $this->field2save_itm_relation) {
			//echo 'a';  
			if ($s = $this->field2save_itm_separator) {
				$sSQL1 = "select $f from products where id=" . $id;
				$res = $db->Execute($sSQL1,2);
                $preval = $res->fields[0] ? $res->fields[0] . $s : null;
				//echo $sSQL1;
            }
			else
				$preval = null;		
			//beware of jqgrid relation delete, field in product table remain
			$sSQL2 = "update products set $f=" . $db->qstr($preval . $jitem);
			$sSQL2 .= " WHERE id=" . $id;
			$result = $db->Execute($sSQL2,1);	
			$ret = $db->Affected_Rows();
			//echo $sSQL2;	
		  }		
		}//acode
		return ($ret);
	}	
};
}
?>