<?php

$__DPCSEC['RCCMSCTG_DPC']='1;1;1;1;1;1;2;2;9;9;9';

if ( (!defined("RCCMSCTG_DPC")) && (seclevel('RCCMSCTG_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCCMSCTG_DPC",true);

$__DPC['RCCMSCTG_DPC'] = 'rccmsctg';


$__EVENTS['RCCMSCTG_DPC'][0]='cpcmsctg';
$__EVENTS['RCCMSCTG_DPC'][1]='cpsavectg';
$__EVENTS['RCCMSCTG_DPC'][2]='cpctgframe';
$__EVENTS['RCCMSCTG_DPC'][3]='cpctgitems';
$__EVENTS['RCCMSCTG_DPC'][4]='cpcatalog';
$__EVENTS['RCCMSCTG_DPC'][5]='cpsortpage';
$__EVENTS['RCCMSCTG_DPC'][6]='cpsortsave';

$__ACTIONS['RCCMSCTG_DPC'][0]='cpcmsctg';
$__ACTIONS['RCCMSCTG_DPC'][1]='cpsavectg';
$__ACTIONS['RCCMSCTG_DPC'][2]='cpctgframe';
$__ACTIONS['RCCMSCTG_DPC'][3]='cpctgitems';
$__ACTIONS['RCCMSCTG_DPC'][4]='cpcatalog';
$__ACTIONS['RCCMSCTG_DPC'][5]='cpsortpage';
$__ACTIONS['RCCMSCTG_DPC'][6]='cpsortsave';

$__LOCALE['RCCMSCTG_DPC'][0]='RCCMSCTG_DPC;Catalogs;Κατάλογοι';
$__LOCALE['RCCMSCTG_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['RCCMSCTG_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['RCCMSCTG_DPC'][3]='_qty;Quantity;Ποσότητα';
$__LOCALE['RCCMSCTG_DPC'][4]='_items;Items;Είδη';
$__LOCALE['RCCMSCTG_DPC'][5]='_active;Active;Ενεργό';
$__LOCALE['RCCMSCTG_DPC'][6]='_title;Title;Τίτλος';
$__LOCALE['RCCMSCTG_DPC'][7]='_descr;Description;Περιγραφή';
$__LOCALE['RCCMSCTG_DPC'][8]='_xml;Xml;Xml';
$__LOCALE['RCCMSCTG_DPC'][9]='_color;Color;Χρώμα';
$__LOCALE['RCCMSCTG_DPC'][10]='_code;Code;Κωδικός';
$__LOCALE['RCCMSCTG_DPC'][11]='_dimensions;Dimension;Διαστάσεις';
$__LOCALE['RCCMSCTG_DPC'][12]='_size;Size;Μέγεθος';
$__LOCALE['RCCMSCTG_DPC'][13]='_dimensions;Dimensions;Διαστάσεις';
$__LOCALE['RCCMSCTG_DPC'][14]='_xmlcreate;Create XML;Δημιούργησε XML';
$__LOCALE['RCCMSCTG_DPC'][15]='_xml;XML item;Είδος XML';
$__LOCALE['RCCMSCTG_DPC'][16]='_manufacturer;Manufacturer;Κατασκευαστής';
$__LOCALE['RCCMSCTG_DPC'][17]='_uniname1;Unit;Μον.μετρ.';
$__LOCALE['RCCMSCTG_DPC'][18]='_ypoloipo1;Qty;Υπόλοιπο';
$__LOCALE['RCCMSCTG_DPC'][19]='_price0;Price 1;Αξία 1';
$__LOCALE['RCCMSCTG_DPC'][20]='_price1;Price 2;Αξία 2';
$__LOCALE['RCCMSCTG_DPC'][21]='_catalog;Catalogs;Κατάλογοι';
$__LOCALE['RCCMSCTG_DPC'][22]='_selecto;Select objects;Επιλογή στοιχείων';
$__LOCALE['RCCMSCTG_DPC'][23]='_items;Items;Προϊόντα';
$__LOCALE['RCCMSCTG_DPC'][24]='_users;Users;Χρήστες';
$__LOCALE['RCCMSCTG_DPC'][25]='_mode;Select;Επιλογή';
$__LOCALE['RCCMSCTG_DPC'][26]='_cats;Categories;Κατηγορίες';
$__LOCALE['RCCMSCTG_DPC'][27]='_ctgid;Id;A/A';
$__LOCALE['RCCMSCTG_DPC'][28]='_ctgoutline;Branch;Κλαδί';
$__LOCALE['RCCMSCTG_DPC'][29]='_ctgoutlnorder;Branch order;Ταξινόμηση';
$__LOCALE['RCCMSCTG_DPC'][30]='_search;Search;Αναζητήσιμο';
$__LOCALE['RCCMSCTG_DPC'][31]='_active;Active;Ενεργό';
$__LOCALE['RCCMSCTG_DPC'][32]='_view;Show;Εμφανές';
$__LOCALE['RCCMSCTG_DPC'][33]='_OK;Success;Επιτυχώς';
$__LOCALE['RCCMSCTG_DPC'][34]='_cat0;Category 1;Κατηγορία 1';
$__LOCALE['RCCMSCTG_DPC'][35]='_cat1;Category 2;Κατηγορία 2';
$__LOCALE['RCCMSCTG_DPC'][36]='_cat2;Category 3;Κατηγορία 3';
$__LOCALE['RCCMSCTG_DPC'][37]='_cat3;Category 4;Κατηγορία 4';
$__LOCALE['RCCMSCTG_DPC'][38]='_cat4;Category 5;Κατηγορία 5';
$__LOCALE['RCCMSCTG_DPC'][39]='_id;ID;ID';
$__LOCALE['RCCMSCTG_DPC'][40]='_tree;Tree;Δέντρο';
$__LOCALE['RCCMSCTG_DPC'][41]='_leaf;Childs;Παιδιά';
$__LOCALE['RCCMSCTG_DPC'][42]='_rel;Relation;Σχέση';
$__LOCALE['RCCMSCTG_DPC'][43]='_active;Active;Ενεργό';
$__LOCALE['RCCMSCTG_DPC'][44]='_timein;Date;Ημερομηνία';
$__LOCALE['RCCMSCTG_DPC'][45]='_id;ID;ID';
$__LOCALE['RCCMSCTG_DPC'][46]='_title;Title;Τίτλος';
$__LOCALE['RCCMSCTG_DPC'][47]='_descr;Description;Περιγραφή';
$__LOCALE['RCCMSCTG_DPC'][48]='_code;Code;Κωδικός';
$__LOCALE['RCCMSCTG_DPC'][49]='_parent;Parent;Σχέση';
$__LOCALE['RCCMSCTG_DPC'][50]='_orderid;Order;Σειρά';
$__LOCALE['RCCMSCTG_DPC'][51]='_title0;Title L1;Τίτλος L1';
$__LOCALE['RCCMSCTG_DPC'][52]='_title1;Title L2;Τίτλος L2';
$__LOCALE['RCCMSCTG_DPC'][53]='_title2;Title L3;Τίτλος L3';
$__LOCALE['RCCMSCTG_DPC'][54]='_fields;Identifier;Πρόθεμα';
$__LOCALE['RCCMSCTG_DPC'][55]='_relatives;Relations;Συσχετισμοί';
$__LOCALE['RCCMSCTG_DPC'][56]='_sortitems;Sort objects;Ταξινόμηση στοιχείων';
$__LOCALE['RCCMSCTG_DPC'][57]='_class;Class;Κλάση';

class rccmsctg {
	
	var $title, $prpath, $urlpath, $url;
	var $map_t, $map_f, $cseparator, $onlyincategory;
	var $listName;
	
	var $imgxval, $imgyval, $image_size_path;
	var $selected_items, $autoresize, $restype, $odd;	
	
	var $filename, $fields, $photodb, $sizeDB;
	var $owner, $fid, $echoSQL;
	
	var $tpath, $template;

    function __construct() {
	  
		$this->prpath = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');	
		$this->url = paramload('SHELL','urlbase');
		$this->title = localize('RCCMSCTG_DPC',getlocal());

		$this->owner = GetSessionParam('LoginName');

		$this->tpath = remote_paramload('FRONTHTMLPAGE','path',$this->prpath);	
		$this->template = remote_paramload('FRONTHTMLPAGE','template',$this->prpath);		
		
		$this->map_t = remote_arrayload('RCITEMS','maptitle',$this->prpath);	
		$this->map_f = remote_arrayload('RCITEMS','mapfields',$this->prpath);		
		
		$csep = remote_paramload('RCITEMS','csep',$this->prpath); 
		$this->cseparator = $csep ? $csep : '^';	

		$this->onlyincategory = remote_paramload('SHKATALOGMEDIA','onlyincategory',$this->prpath);
		
		$this->autoresize = remote_arrayload('RCITEMS','autoresize',$this->prpath);
		$this->restype = remote_paramload('RCITEMS','restype',$this->prpath);
		$image_def_xsize = remote_paramload('RCEDITITEMS','imgdefsizex',$this->prpath);		
        $image_def_ysize = remote_paramload('RCEDITITEMS','imgdefsizey',$this->prpath);				
		$this->imgxval = $image_def_xsize ? $image_def_xsize : ((!empty($this->autoresize)) ? $this->autoresize[0] : 0);//90;//as it is
		$this->imgyval = $image_def_ysize ? $image_def_ysize : 0;//90; //as it is	
		
		$this->photodb = remote_paramload('RCITEMS','photodb',$this->prpath);
		
		$ip = remote_paramload('RCCOLLECTIONS','imagepath',$this->prpath);
		$ipath = $ip ? $ip : '/images/';
		$ia = remote_paramload('RCCOLLECTIONS','imageabs',$this->prpath);
		if (!$ia) {
			$pt = remote_paramload('RCITEMS','phototype',$this->prpath);	
			$csize = remote_paramload('RCCOLLECTIONS','itemphotosize',$this->prpath);
			$phototype = $csize ? $csize : ( $pt ? $pt : 0); 		
			switch ($phototype) {
				case 3  : $this->image_size_path = $ipath . remote_paramload('RCITEMS','photobgpath',$this->prpath); $this->sizeDB = 'LARGE'; break;
				case 2  : $this->image_size_path = $ipath . remote_paramload('RCITEMS','photomdpath',$this->prpath); $this->sizeDB = 'MEDIUM'; break;
				case 1  : $this->image_size_path = $ipath . remote_paramload('RCITEMS','photosmpath',$this->prpath); $this->sizeDB = 'SMALL'; break;
				case 0  :
				default : $this->image_size_path = $ipath . remote_paramload('RCITEMS','photobgpath',$this->prpath); $this->sizeDB = 'LARGE';
			}
        }
		else
			$this->image_size_path = $ipath; //absolute path		
		
		$this->selected_items = null;		
		
        $this->listName = 'myctglist';
        $this->savedlist = GetSessionParam($this->listName) ? GetSessionParam($this->listName) : null;
	
		$this->fid = GetSessionParam('fid') ? GetSessionParam('fid') : GetReq('fid');
		$this->echoSQL = false;//true;
	}
	
    function event($event=null) {
	
	   $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   if ($login!='yes') return null;				

       if (!$this->msg) {
  
	     switch ($event) {
			 
			case 'cpsortsave'     : $this->savedlist = $this->saveList();
			                        break;  
			case 'cpsortpage'     : break; 
			case 'cpcatalog'      : break;			
			case 'cpctgframe'     : echo $this->loadframe();
		                            die(); 
			case 'cpctgitems'     : if ($fid = $this->fid) {
										SetSessionParam('fid', $fid); //save fid 
									}
			                        break;			 		 
		    case 'cpsavectg'      : $this->savedlist = $this->saveList();				
	                                break;									
			case 'cpcmsctg'       :
			default               :							  
         }
      }
    }	

    function action($action=null)  {

	     $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	     if ($login!='yes') return null;		

	     switch ($action) {
			 
		   case 'cpsortsave'     :  break;	 
		   case 'cpsortpage'     :  break;
		   case 'cpcatalog'      :  break;		   
		   case 'cpctgframe'     :  break;	 
		   case 'cpctgitems'     :  break;			 	 	   
		   case 'cpsavectg'      :  break;
		   case 'cpcmdctg'       :						   
		   default               :  $out = $this->gridMode();
		 }			 

	     return ($out);
	}
	
	
	protected function loadframe($mode=null) {
		$selectmode = $mode ? $mode : GetReq('mode');
		$id = GetReq('id');
		$fidparam = $this->fid ? "&fid=" . $this->fid : null;
		
		switch ($selectmode) {
			case 'sort'  : $bodyurl = seturl("t=cpsortpage&mode=sort&id=". $id . $fidparam); break;
			
			case 'rels'  : $bodyurl = seturl("t=cpctgitems&mode=rels&id=". $id . $fidparam); break;
			case 'cats'  : $bodyurl = seturl("t=cpctgitems&mode=cats&id=". $id . $fidparam); break;
			case 'items' : $bodyurl = seturl("t=cpctgitems&mode=items&id=". $id . $fidparam); break;
			case 'tree'  : $bodyurl = seturl("t=cpctgitems&mode=tree&id=". $id . $fidparam); break;
			case 'catalog':
			default      : $bodyurl = seturl("t=cpctgitems&mode=catalog&id=". $id . $fidparam);
		}
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"500px\"><p>Your browser does not support iframes</p></iframe>";    

		return ($frame); 
	}		
		
	protected function gridMode() {
		$mode = GetReq('mode') ? GetReq('mode') : 'catalog';
        
		$turl0 = seturl('t=cpcmsctg&mode=items');		
		$turl1 = seturl('t=cpcmsctg&mode=cats');
		$turl2 = seturl('t=cpcmsctg&mode=rel');
		$turl3 = seturl('t=cpcmsctg&mode=tree');
		$turl4 = seturl('t=cpcmsctg&mode=catalog');
		$turl5 = "javascript:tsort();";
		$button = $this->createButton(localize('_mode', getlocal()), 
										array(localize('_items', getlocal())=>$turl0,
										      localize('_relatives', getlocal())=>$turl2,
											  localize('_cats', getlocal())=>$turl1,											  
											  localize('_tree', getlocal())=>$turl3,
											  0=>'',
											  localize('_sortitems', getlocal())=>$turl5,
											  1=>'',
											  localize('RCCMSCTG_DPC', getlocal())=>$turl4,
		                                ),'success');		
																	
		switch ($mode) {
			case 'rel'      : $content = $this->relatives_grid(null,140,5,'r', true); break;
	        case 'tree'     : $content = $this->tree_grid(null,140,5,'r', true); break;
	        case 'cats'     : $content = $this->categories_grid(null,140,5,'r', true); break;
			case 'items'    : $content = $this->items_grid(null,140,5,'r', true); break;  
			case 'sort'     :
			case 'catalog'  : 			
			default         : $content = $this->catalogs_grid(null,140,5,'r', true); break;	
		}			
					
		$ret = $this->window(localize('RCCMSCTG_DPC', getlocal()).': '.localize('_'.$mode, getlocal()), $button, $content);
		
		return ($ret);
	}	
	
	protected function catalogs_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = str_replace(' ', '_', $this->title); //localize('_catalogs', getlocal()); 
		
	    if (defined('MYGRID_DPC')) {
		
		    $ttype = " where type=4";
		
			$xSQL2 = "SELECT * from (select id,active,date,name,descr,objects,class,type from cmstemplates $ttype) o ";		   
		   							
			_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|");			
			_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|2|0|");		
			_m("mygrid.column use grid1+date|".localize('_date',getlocal())."|5|0|");			
			_m("mygrid.column use grid1+name|".localize('_title',getlocal())."|link|10|"."javascript:tctg(\"{id}\");".'||');
			_m("mygrid.column use grid1+descr|".localize('_descr',getlocal())."|link|19|"."javascript:tsort(\"{id}\");".'||');
			//_m("mygrid.column use grid1+objects|".localize('_items',getlocal())."|10|0|");
			_m("mygrid.column use grid1+class|".localize('_class',getlocal())."|5|0|");
			_m("mygrid.column use grid1+type|".localize('_type',getlocal())."|5|0|");

			$ret .= _m("mygrid.grid use grid1+cmstemplates+$xSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);		
	}		

	protected function tree_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_tree', getlocal()); 
		
        $xsSQL = "SELECT * from (select id,timein,active,tid,pid,tname,tdescr,tname0,tname1,tname2,items,users,orderid from ctree) o ";		   
					
		_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|");		
		//_m("mygrid.column use grid1+itmactive|".localize('_active',getlocal())."|2|0|");//"|boolean|1|1:0");		
		_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|2|0|");
		_m("mygrid.column use grid1+timein|".localize('_date',getlocal())."|5|0|");		
		_m("mygrid.column use grid1+tid|".localize('_code',getlocal())."|2|0|");
		_m("mygrid.column use grid1+pid|".localize('_parent',getlocal())."|2|1|");			
		_m("mygrid.column use grid1+tname|".localize('_title',getlocal())."|link|10|"."javascript:ttree(\"{tid}\");".'||');	
		_m("mygrid.column use grid1+tdescr|".localize('_descr',getlocal())."|5|0|");		
		_m("mygrid.column use grid1+tname0|".localize('_title0',getlocal())."|5|1|");			
		_m("mygrid.column use grid1+tname1|".localize('_title1',getlocal())."|5|1|");		
		_m("mygrid.column use grid1+tname2|".localize('_title2',getlocal())."|5|1|");			
		//_m("mygrid.column use grid1+manufacturer|".localize('_manufacturer',getlocal())."|5|0|");
		_m("mygrid.column use grid1+items|".localize('_items',getlocal())."|2|0|");
		_m("mygrid.column use grid1+users|".localize('_users',getlocal())."|2|0|");
		_m("mygrid.column use grid1+orderid|".localize('_orderid',getlocal())."|2|1|");

		$out = _m("mygrid.grid use grid1+ctree+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}	
	
	protected function items_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_items', getlocal());
	    $itmname = $lan ? 'itmname' : 'itmfname';
	    $itmdescr = $lan ? 'itmdescr' : 'itmfdescr';		
		
        $xsSQL = "SELECT * from (select id,sysins,code5,xml,itmactive,active,$itmname,$itmdescr,uniname1,ypoloipo1,price0,price1,manufacturer,size,color from products) o ";		   
		//code3,cat0,cat1,cat2,cat3,cat4,resources
		   							
		_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|");//"|link|5|"."javascript:editform(\"{id}\");".'||');			
		_m("mygrid.column use grid1+itmactive|".localize('_active',getlocal())."|2|0|");//"|boolean|1|1:0");		
		_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|2|0|");//"|boolean|1|101:0|");
		_m("mygrid.column use grid1+sysins|".localize('_date',getlocal())."|5|0|");		
		_m("mygrid.column use grid1+code5|".localize('_code',getlocal())."|link|5|"."javascript:titems(\"{id}\");".'||');	
		_m("mygrid.column use grid1+$itmname|".localize('_title',getlocal())."|10|0|");	
		_m("mygrid.column use grid1+$itmdescr|".localize('_descr',getlocal())."|10|0|");	
		_m("mygrid.column use grid1+uniname1|".localize('_uniname1',getlocal())."|5|0|");		
		_m("mygrid.column use grid1+ypoloipo1|".localize('_ypoloipo1',getlocal())."|5|1|");			
		_m("mygrid.column use grid1+price0|".localize('_price0',getlocal())."|5|1|");		
		_m("mygrid.column use grid1+price1|".localize('_price1',getlocal())."|5|1|");			
		_m("mygrid.column use grid1+manufacturer|".localize('_manufacturer',getlocal())."|5|0|");
		_m("mygrid.column use grid1+size|".localize('_size',getlocal())."|5|0|");
		_m("mygrid.column use grid1+color|".localize('_color',getlocal())."|5|0|");
		_m("mygrid.column use grid1+xml|".localize('_xml',getlocal())."|link|2|"."javascript:tusers(\"{code5}\");".'||');

		$out = _m("mygrid.grid use grid1+products+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}
	
	protected function relatives_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
        $active_code = 	_m("cmsrt.getmapf use code");
		$name_active = $lan?'itmname':'itmfname'; 		
		$title = localize('_relatives', $lan);
        $myfields = "id,$active_code,cat0,cat1,cat2,cat3,$name_active,itmactive,active";  		

		$fathersSQL = " WHERE $active_code in (select relative from relatives where isitem=1)"; //and iscatalog=1
		$xsSQL = 'select * from (select '.$myfields . ' from products '.$fathersSQL.') as o';
		  
		_m("mygrid.column use grid1+id|".localize('_id',getlocal())."|2|0|");	
		_m("mygrid.column use grid1+$active_code|".localize('_code',getlocal())."|link|5|"."javascript:trels(\"{".$active_code."}\");".'||');		
		_m("mygrid.column use grid1+cat0|".localize('_cat0',getlocal())."|10|0|");
	    _m("mygrid.column use grid1+cat1|".localize('_cat1',getlocal())."|10|0|");				
		_m("mygrid.column use grid1+cat2|".localize('_cat2',getlocal())."|10|0|");
		_m("mygrid.column use grid1+cat3|".localize('_cat3',getlocal())."|10|0|");
	    _m("mygrid.column use grid1+$name_active|".localize('_title',getlocal()).'|20|0');	
		_m("mygrid.column use grid1+itmactive|".localize('_active',getlocal()).'|boolean|1:0|');	
		_m("mygrid.column use grid1+active|".localize('_active',getlocal()).'|boolean|1|101:0');		
		$out = _m("mygrid.grid use grid1+products+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width");
		
		return ($out);  	
	}

    protected function categories_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 440;
        $rows = $rows ? $rows : 18;
        $width = $width ? $width : null; //wide
        $mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;
		$title = localize('_cats', getlocal());							   
        $lan = getlocal()?getlocal():0;
	
		$myfields = 'id,ctgid,';
		$mytitles = localize('id',getlocal()) . ',' . localize('_ctgid',getlocal()) . ',';
		//$myfields .= "REPLACE(cat1,cat2,cat3,cat4,cat5,";
		$myfields .= "REPLACE(cat1,'&','~') as cat1, REPLACE(cat2,'&','~') as cat2, REPLACE(cat3,'&','~') as cat3, REPLACE(cat4,'&','~') as cat4, REPLACE(cat5,'&','~') as cat5,";
		$myfields .= "cat{$lan}1,cat{$lan}2,cat{$lan}3,cat{$lan}4,cat{$lan}5,";
		$mytitles .= localize('_cat0',$lan).','.localize('_cat1',$lan).','.localize('_cat2',$lan).','.localize('_cat3',$lan).','.localize('_cat4',$lan).','.localize('_cat0',$lan).',';
		$mytitles .= localize('_cat1',getlocal()) .','.localize('_cat2',$lan).','.localize('_cat3',$lan).','.localize('_cat4',$lan).',';		
		
		$myfields .= 'active,view,search';
		$mytitles .= localize('_active',getlocal()) . ',' . localize('_view',getlocal()) . ',' . localize('_search',getlocal());
		
		$CS = $this->cseparator;

		$xsSQL = 'select * from (select '.$myfields . ' from categories) as o';
		
		_m("mygrid.column use grid2+id|".localize('_id',getlocal())."|2|1|");	
		_m("mygrid.column use grid2+ctgid|".localize('_ctgid',getlocal())."|2|1|");
		//_m("mygrid.column use grid2+cat1|".localize('_cat0',getlocal())."|5|1|");
		_m("mygrid.column use grid2+cat2|".localize('_cat1',getlocal())."|5|1|");
		_m("mygrid.column use grid2+cat3|".localize('_cat2',getlocal())."|5|1|");				
		_m("mygrid.column use grid2+cat4|".localize('_cat3',getlocal())."|5|1|");
		_m("mygrid.column use grid2+cat5|".localize('_cat4',getlocal())."|5|1|");			
		//_m("mygrid.column use grid2+cat{$lan}1|".localize('_cat0',getlocal())."|link|10|"."javascript:tcats(\"{cat1}\");".'||');
		_m("mygrid.column use grid2+cat{$lan}2|".localize('_cat1',getlocal())."|link|10|"."javascript:tcats(\"{cat2}\");".'||');
		_m("mygrid.column use grid2+cat{$lan}3|".localize('_cat2',getlocal())."|link|10|"."javascript:tcats(\"{cat2}$CS{cat3}\");".'||');				
		_m("mygrid.column use grid2+cat{$lan}4|".localize('_cat3',getlocal())."|link|10|"."javascript:tcats(\"{cat2}$CS{cat3}$CS{cat4}\");".'||');
		_m("mygrid.column use grid2+cat{$lan}5|".localize('_cat4',getlocal())."|link|10|"."javascript:tcats(\"{cat2}$CS{cat3}$CS{cat4}$CS{cat5}\");".'||');
		_m("mygrid.column use grid2+active|".localize('_active',getlocal()).'|boolean|1');	
		_m("mygrid.column use grid2+search|".localize('_search',getlocal()).'|boolean|1');	
		_m("mygrid.column use grid2+view|".localize('_view',getlocal()).'|boolean|1');	
		
		$out .= _m("mygrid.grid use grid2+categories+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width");
			
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
							<hr/><div id="cmsframe"></div>
							</div>
							'.  $content .'
                        </div>
                  </div>
                </div>
            </div>
';
		return ($ret);
	}	
	
	public function currentSelectedPageType() {
		$db = GetGlobal('db');		
		$id = GetParam('id');
		
		$sSQL = 'select type from cmstemplates where id=' . $db->qstr($id);
		$result = $db->Execute($sSQL);
		
		return ($result->fields[0]);
	}	
	
	public function currentSelectedTree() {
		$db = GetGlobal('db');		
		$lan = getlocal() ?  getlocal() : '0';
		$tid = GetParam('id');
		
		$sSQL = 'select tname, tname0, tname1, tname2 from ctree where tid=' . $db->qstr($tid);
		$result = $db->Execute($sSQL);
		
		$ret = $result->fields['tname'.$lan] ? $result->fields['tname'.$lan] : $result->fields[0];
		return ($ret);
	}
	
	//select field to display
	public function selectFieldUrl($field=null) {
		$t=GetReq('t');
		$id = GetReq('id');
		$mode = GetReq('mode');
		
		switch ($field) {
			case 'code0': $fid = 'id'; break;
			default     : $fid = $field ? $field : _m("cmsrt.getmapf use code");
		}
		
		$ret = seturl("t=$t&mode=$mode&id=$id&fid=". $fid);
		
		return ($ret);
	}
	
	public function selectFieldButton() {
		
        $fields = 'datein,code0,code1,code2,code3,code4,code5,active,itmactive,uniname1,uniname2,price0,price1,ypoloipo1,ypoloipo2,weight,volume,dimensions,size,color,manufacturer,xml';
		$f = explode(',', $fields);
		
		foreach ($f as $i=>$field) {
			$myfields[$field] = $this->selectFieldUrl($field);
		}
		
		$button = $this->createButton(localize('_fields', getlocal()), $myfields);			
		
		return ($button);
	}	
	

	//exclude existed template objects and posted items
    protected function getCurrentSessionList() {
		$db = GetGlobal('db');
	    $lan = getlocal();
	    $itmname = $lan ? 'itmname':'itmfname';
	    $itmdescr = $lan ? 'itmdescr':'itmfdescr';		
		$code = $this->fid ? $this->fid : _m("cmsrt.getmapf use code");
		$catalog = false;
		
		$cpGet = _v('rcpmenu.cpGet');

        switch (GetReq('mode')) { 
		
			case 'cats'     : $cat = GetReq('id'); break;
			case 'items'    : $id = GetReq('id'); break;		
			case 'sort'     : 
		    case 'catalog'  : 	//check existed objects in catalog
			                    if ($catalog = GetReq('id')) {
									$objSQL = "select objects from cmstemplates WHERE id=" . $db->qstr($catalog);
									if ($this->echoSQL)	echo $objSQL . '<br/>';
									$oret = $db->Execute($objSQL);
									$objects = $oret->fields[0];								
								} 
								//break;
								
			default         : $id = $cpGet['id'];
					          $cat = $cpGet['cat'];	
		}		
		
		$sSQL = 'select id,'.$code.',' . $itmname .' from products where ';
		
		if ($id) {
			//$sSQL .= $code . '=' . $db->qstr($id);
			$sSQL .= 'id =' . $db->qstr($id);
		}	
		elseif ($cat) {
			
			$cat_tree = explode($this->cseparator, str_replace('~', '&' ,$cat)); //js url

			if ($cat_tree[0])
				$whereClause .= ' cat0=' . $db->qstr(_m('cmsrt.replace_spchars use ' .$cat_tree[0]. '+1'));		
			elseif ($this->onlyincategory)
				$whereClause .= ' (cat0 IS NULL OR cat0=\'\') ';				  
			if ($cat_tree[1])	
				$whereClause .= ' and cat1=' . $db->qstr(_m('cmsrt.replace_spchars use ' .$cat_tree[1]. '+1'));	
			elseif ($this->onlyincategory)
				$whereClause .= ' and (cat1 IS NULL OR cat1=\'\') ';	 
			if ($cat_tree[2])	
				$whereClause .= ' and cat2=' . $db->qstr(_m('cmsrt.replace_spchars use ' .$cat_tree[2]. '+1'));	
			elseif ($this->onlyincategory)
			 	$whereClause .= ' and (cat2 IS NULL OR cat2=\'\') ';		   
			if ($cat_tree[3])	
				$whereClause .= ' and cat3=' . $db->qstr(_m('cmsrt.replace_spchars use ' .$cat_tree[3]. '+1'));
			elseif ($this->onlyincategory)
				$whereClause .= ' and (cat3 IS NULL OR cat3=\'\') ';
		   		
		    
			$sSQL .= $whereClause;	

		}
		else
			return null;	
		
		//check existed post objects
        if (!empty($_POST[$this->listName]))    
            $plist = implode(',',$_POST[$this->listName]);
        if ($sl = GetSessionParam($this->listName)) 
			$plist .= ($plist ? ','. $sl : $sl);
		if ($plist)
			$sSQL .= ' and id NOT in (' . $plist . ')';
		elseif ($objects) //check existed objects in catalog
			$sSQL .= " and id NOT in (" . $objects . ')';
		
		
		//$sSQL .= " and itmactive>0 and active>0";			   
		$sSQL .= " ORDER BY " . $itmname;	//order unselected list by name	
		
		if ($this->echoSQL)
			echo $sSQL . '<br/>';
		
	    $resultset = $db->Execute($sSQL,2);	
		foreach ($resultset as $n=>$rec) {
			$ret[] = "<option value='".$rec['id']."'>". $rec[$code].'-'.$rec[$itmname]."</option>" ;
        }		

		return (implode('',$ret));	
	}
	
	//exclude session items
    protected function getCurrentTreeList() {
		$db = GetGlobal('db');
	    $lan = getlocal();
	    $itmname = $lan ? 'itmname':'itmfname';
	    $itmdescr = $lan ? 'itmdescr':'itmfdescr';		
		$code = $this->fid ? $this->fid : _m("cmsrt.getmapf use code");
		$id = GetParam('id');
		
		$sSQL = 'select id,'.$code.',' . $itmname .' from products where ';
		
		if ($id) {
			$treeSQL = "select code from ctreemap WHERE tid=" . $db->qstr($id);			
			$sSQL .= ' id in (' . $treeSQL . ')';
		}	
        else
			return null;	
		
		//check session
        if (!empty($_POST[$this->listName]))    
            $plist = implode(',',$_POST[$this->listName]);

        if ($sl = GetSessionParam($this->listName)) 
			$plist .= ($plist ? ','. $sl : $sl);			
			
		if ($plist)
			$sSQL .= ' and id not in (' . $plist . ')';
		
		//$sSQL .= " and itmactive>0 and active>0";			   
		$sSQL .= " ORDER BY " . $code;	//order unselected list by name	
		
		if ($this->echoSQL)
			echo $sSQL . '<br/>';
		
	    $resultset = $db->Execute($sSQL,2);	
		//print_r($resultset);
		foreach ($resultset as $n=>$rec) {
			$ret[] = "<option value='".$rec['id']."'>". $rec[$code].'-'.$rec[$itmname]."</option>" ;
        }		

		return (implode('',$ret));	
	}	

	//exclude session items
    protected function getCurrentRelationList() {
		$db = GetGlobal('db');
	    $lan = getlocal();
	    $itmname = $lan ? 'itmname':'itmfname';
	    $itmdescr = $lan ? 'itmdescr':'itmfdescr';		
		$active_code = 	_m("cmsrt.getmapf use code");		
		$code = $this->fid ? $this->fid : $active_code;
		$id = GetParam('id');	
		
		$sSQL = 'select id,'.$code.',' . $itmname .' from products where ';
		
		if ($id) {
			$relSQL = "select relation from relatives WHERE isitem=1 and relative=" . $db->qstr($id);			
			$sSQL .= $active_code . ' in (' . $relSQL . ')';
		}	
        else
			return null;	
		
		//check session
        if (!empty($_POST[$this->listName]))    
            $plist = implode(',',$_POST[$this->listName]);

        if ($sl = GetSessionParam($this->listName)) 
			$plist .= ($plist ? ','. $sl : $sl);			
			
		if ($plist)
			$sSQL .= ' and id not in (' . $plist . ')';
		
		//$sSQL .= " and itmactive>0 and active>0";			   
		$sSQL .= " ORDER BY " . $itmname;	//order unselected list by name	
		
		if ($this->echoSQL)
			echo $sSQL . '<br/>';
		
	    $resultset = $db->Execute($sSQL,2);	
		//print_r($resultset);
		foreach ($resultset as $n=>$rec) {
			$ret[] = "<option value='".$rec['id']."'>". $rec[$code].'-'.$rec[$itmname]."</option>" ;
        }		

		return (implode('',$ret));	
	}	
	
    public function getCurrentList() {
		//echo GetReq('mode');
        switch (GetReq('mode')) {   
		    case 'rels'  : $ret = $this->getCurrentRelationList(); break;		
			case 'tree'  : $ret = $this->getCurrentTreeList(); break;		
			case 'cats'  : 
			case 'items' : 			
			case 'catalog': 
			default      : $ret = $this->getCurrentSessionList();
		}	
		
		return ($ret);
    }	

	
	//include session items	
	protected function viewSessionList() {
		$db = GetGlobal('db');
	    $lan = getlocal();
	    $itmname = $lan ? 'itmname':'itmfname';
	    $itmdescr = $lan ? 'itmdescr':'itmfdescr';		
		$code = $this->fid ? $this->fid : _m("cmsrt.getmapf use code");
		
        switch (GetReq('mode')) { 
		
			case 'cats'     : break;
			case 'items'    : break;		
			case 'sort'     :
		    case 'catalog' : 	//check existed objects in catalog
			                    if ($catalog = GetReq('id')) {
									$oSQL = "select objects from cmstemplates WHERE id=" . $db->qstr($catalog);
									if ($this->echoSQL)	echo $oSQL . '<br/>';
									$oret = $db->Execute($oSQL);
									$objects = $oret->fields[0];								
								} 
								break;
			default         : 	
		}			
		
		$sSQL = 'select id,'.$code.',' . $itmname .' from products where ';
		
		//check session	
		if (!empty($_POST[$this->listName]))  
			$list = implode(',', $_POST[$this->listName]);	
        else
			$list = $this->savedlist;
		
		//echo 'savedlist:'.$this->savedlist;
		//if (!$list) return ;
		
		$olist = $list ? ($objects ? $objects.','.$list : $list) : $objects;
		$sSQL .= ' id in (' . $olist . ')';
		//$sSQL .= " and itmactive>0 and active>0";		
		$sSQL .= " ORDER BY FIELD(id,".  $olist .")";
		
		if ($this->echoSQL)
			echo $sSQL . '<br/>';
		
	    $resultset = $db->Execute($sSQL,2);	
		
		$objarr = explode(',',$objects);
		foreach ($resultset as $n=>$rec) {
			$ret[] = ((!empty($objarr)) && (in_array($rec[0], $objarr))) ? 
			            "<option value='".$rec['id']."'>". $rec[$code].'-'.$rec[$itmname]."</option>" :
			            "<option value='".$rec['id']."'>". '[+]' .$rec[$code].'-'.$rec[$itmname]."</option>";
        }		

		return (implode('',$ret));			
	}	

	public function viewList() {
		
        switch (GetReq('mode')) { 
			case 'rels'  :
			case 'tree'  :	
			case 'cats'  : 
			case 'items' :
			case 'sort'  :
		    case 'catalog':			
			default      : $ret = $this->viewSessionList();	
		}			
			
		return ($ret);
	}		
	
	public function postSubmit($action, $title=null, $class=null) {
		if (!$action) return;
		$submit = $title ? $title : 'Submit';
		$cl = $class ? "class=\"$class\"" : null;
		 
		$id = GetReq('id'); 
		$c = "<INPUT type=\"hidden\" name=\"id\" value=\"{$id}\" />";
		$mode = GetReq('mode');
		$c .= "<INPUT type=\"hidden\" name=\"mode\" value=\"{$mode}\" />";
		
        $c .= "<INPUT type=\"submit\" name=\"submit\" value=\"" . $submit . "\" $cl />";  
        $c .= "<INPUT type=\"hidden\" name=\"FormName\" value=\"catalogs\" />";		   
        $c .= "<INPUT type=\"hidden\" name=\"FormAction\" value=\"" . $action . "\" $cl />";
        return ($c);   		   
	}

	protected function saveTemplateList($data=null) {
		$db = GetGlobal('db');		
		$id = GetParam('id');
		if (!$id) return false;
		
		//if ($data) { //when empty update
			$sSQL = 'update cmstemplates set objects=' . $db->qstr($data) . ' WHERE id=' . $id;
			$db->Execute($sSQL);
			if ($this->echoSQL) echo "1&nbsp;$sSQL<br/>";		
			
			return true;
		//}
		
		//return false;
	}	

	protected function saveTemplateFile() {
		$db = GetGlobal('db');		
		$id = GetParam('id');
		if (!$id) return false;
		
		if ($id) {
			$sSQL = 'select active,date,name,descr,class,type,script,objects,data from cmstemplates' . ' WHERE id=' . $id;
			$res = $db->Execute($sSQL);
			//if ($this->echoSQL) echo "1&nbsp;$sSQL<br/>";		
			
			if (!$res->fields[0]) return false; //return if inactive
		
		    $template = $res->fields['class'] ? $res->fields['class'] : $this->template;
		    $filename = $res->fields['descr'] ? str_replace(' ','-',$res->fields['descr']) : str_replace(' ','-',$res->fields['name']);			
				
			$ret = _m('crmrt.renderTemplate use '.$id.'+'.$res->fields['objects'].'+'.$filename.'.php');
			
			return $ret;
			
		}		
		return false;
	}		
	
	protected function deleteTemplateFile() {	
		$db = GetGlobal('db');		
		$id = GetParam('id');
		if (!$id) return false;
		
		if ($id) {
			$sSQL = 'select active,date,name,descr,class,type,script,objects,data from cmstemplates' . ' WHERE id=' . $id;
			$res = $db->Execute($sSQL);
			//if ($this->echoSQL) echo "1&nbsp;$sSQL<br/>";		
			
			if (!$res->fields[0]) return false; //return if inactive
		
		    $template = $res->fields['class'] ? $res->fields['class'] : $this->template;
		    $filename = $res->fields['descr'] ? str_replace(' ','-',$res->fields['descr']) : str_replace(' ','-',$res->fields['name']);			
		
			if ($script = $res->fields['script']) {
				//remove template file
				$templatefilepath = $this->prpath . $this->tpath . "/" . $template; 
				//echo $templatefilepath . '/pages/' . $filename.'.php';
				$ret = @unlink($templatefilepath . '/pages/' . $filename.'.php');
			}
		
			if ($filename) {
				//remove public file
				$ret = @unlink($this->urlpath . '/' . $filename.'.php');
				return $ret;
			}	
	
		}		
		return false;
	}	
	
	protected function saveList() {
		$mode = GetParam('mode');		
		
		if (!empty($_POST[$this->listName])) { 
		
			$plist = implode(',', $_POST[$this->listName]); //post list
			$slist = GetSessionParam($this->listName); //current session list			
			//$list = $slist ? $slist . ',' . $plist : $plist;
			$list = $plist ? $plist : $slist; //as post sort
			//$list = $slist ? $slist : $plist; //order be session (not usable)
			
			switch (GetReq('mode')) { 
			    case 'sort'     :  //echo 'sort';
				case 'catalog'  :  //if ($this->currentSelectedType()==1) { //catalog
									if ($this->saveTemplateList($list)) {
										$this->saveTemplateFile();
										SetSessionParam($this->listName, ''); //reset session list
									}	
				                   //}	
								   break;		
			 
			    case 'tree'  :
			    case 'rels'  :
				case 'cats'  :
				case 'items' : 	//break;	
				default      :	SetSessionParam($this->listName, $list); //save session list
			}	
			
		}
		elseif (($_POST) && (empty($_POST[$this->listName]))) {
			
			switch (GetReq('mode')) { 
			    case 'sort'     :
				case 'catalog'  : 	if ($this->saveTemplateList($list)) {
										$this->deleteTemplateFile();
										SetSessionParam($this->listName, ''); //empty when post has no items
									}	
			
			    case 'tree'  :
			    case 'rels'  :
				case 'cats'  :
				case 'items' : 	//break;	
				default      :	SetSessionParam($this->listName, ''); //save session list
			}	
			
		}		  
		return ($list);
	}		
					
};
}
?>