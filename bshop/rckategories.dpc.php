<?php
$__DPCSEC['RCKATEGORIES_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ( (!defined("RCKATEGORIES_DPC")) && (seclevel('RCKATEGORIES_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCKATEGORIES_DPC",true);

$__DPC['RCKATEGORIES_DPC'] = 'rckategories';

//$a = GetGlobal('controller')->require_dpc('rc/rcbrowser.lib.php');
//require_once($a);

$d = GetGlobal('controller')->require_dpc('bshop/shkategories.dpc.php');
require_once($d);

$__EVENTS['RCKATEGORIES_DPC'][0]='cpkategories';
$__EVENTS['RCKATEGORIES_DPC'][1]='cats';
$__EVENTS['RCKATEGORIES_DPC'][2]='editcats';
$__EVENTS['RCKATEGORIES_DPC'][3]='openfolder';
$__EVENTS['RCKATEGORIES_DPC'][4]='savecats';
$__EVENTS['RCKATEGORIES_DPC'][5]='delcats';
$__EVENTS['RCKATEGORIES_DPC'][6]='addcats';
$__EVENTS['RCKATEGORIES_DPC'][7]='gencats';
$__EVENTS['RCKATEGORIES_DPC'][8]='disablecat';
$__EVENTS['RCKATEGORIES_DPC'][9]='cpread';
$__EVENTS['RCKATEGORIES_DPC'][10]='cpwrite';
$__EVENTS['RCKATEGORIES_DPC'][11]='cpbradd';
$__EVENTS['RCKATEGORIES_DPC'][12]='cpbredit';
$__EVENTS['RCKATEGORIES_DPC'][13]='cpbrdel';
$__EVENTS['RCKATEGORIES_DPC'][14]='cpaddcat';
$__EVENTS['RCKATEGORIES_DPC'][15]='cpeditcat';
$__EVENTS['RCKATEGORIES_DPC'][16]='cpeditframe';

$__ACTIONS['RCKATEGORIES_DPC'][0]='cpkategories';
$__ACTIONS['RCKATEGORIES_DPC'][1]='cats';
$__ACTIONS['RCKATEGORIES_DPC'][2]='editcats';
$__ACTIONS['RCKATEGORIES_DPC'][3]='openfolder';
$__ACTIONS['RCKATEGORIES_DPC'][4]='savecats';
$__ACTIONS['RCKATEGORIES_DPC'][5]='delcats';
$__ACTIONS['RCKATEGORIES_DPC'][6]='addcats';
$__ACTIONS['RCKATEGORIES_DPC'][7]='gencats';
$__ACTIONS['RCKATEGORIES_DPC'][8]='disablecat';
$__ACTIONS['RCKATEGORIES_DPC'][9]='cpread';
$__ACTIONS['RCKATEGORIES_DPC'][10]='cpwrite';
$__ACTIONS['RCKATEGORIES_DPC'][11]='cpbradd';
$__ACTIONS['RCKATEGORIES_DPC'][12]='cpbredit';
$__ACTIONS['RCKATEGORIES_DPC'][13]='cpbrdel';
$__ACTIONS['RCKATEGORIES_DPC'][14]='cpaddcat';
$__ACTIONS['RCKATEGORIES_DPC'][15]='cpeditcat';
$__ACTIONS['RCKATEGORIES_DPC'][16]='cpeditframe';

$__LOCALE['RCKATEGORIES_DPC'][0]='RCKATEGORIES_DPC;Categories;Κατηγορίες';
$__LOCALE['RCKATEGORIES_DPC'][1]='_LEVEL1;Category 1;Κατηγορία 1';
$__LOCALE['RCKATEGORIES_DPC'][2]='_LEVEL2;Category 2;Κατηγορία 2';
$__LOCALE['RCKATEGORIES_DPC'][3]='_LEVEL3;Category 3;Κατηγορία 3';
$__LOCALE['RCKATEGORIES_DPC'][4]='_LEVEL4;Category 4;Κατηγορία 4';
$__LOCALE['RCKATEGORIES_DPC'][5]='_LEVEL5;Category 5;Κατηγορία 5';
$__LOCALE['RCKATEGORIES_DPC'][6]='_NEWLEVEL;New category;Νέα κατηγορία';
$__LOCALE['RCKATEGORIES_DPC'][7]='_FLEVEL1;Foreign Alias Level 1;Κατηγορία 1 (Ξενόγλωσση)';
$__LOCALE['RCKATEGORIES_DPC'][8]='_FLEVEL2;Foreign Alias Level 2;Κατηγορία 2 (Ξενόγλωσση)';
$__LOCALE['RCKATEGORIES_DPC'][9]='_FLEVEL3;Foreign Alias Level 3;Κατηγορία 3 (Ξενόγλωσση)';
$__LOCALE['RCKATEGORIES_DPC'][10]='_FLEVEL4;Foreign Alias Level 4;Κατηγορία 4 (Ξενόγλωσση)';
$__LOCALE['RCKATEGORIES_DPC'][11]='_FLEVEL5;Foreign Alias Level 5;Κατηγορία 5 (Ξενόγλωσση)';
$__LOCALE['RCKATEGORIES_DPC'][12]='_FNEWLEVEL;New category alias;Νέα κατηγορία (Ξενόγλωσση)';
$__LOCALE['RCKATEGORIES_DPC'][13]='_ctgid;Id;A/A';
$__LOCALE['RCKATEGORIES_DPC'][14]='_ctgoutline;Branch;Κλαδί';
$__LOCALE['RCKATEGORIES_DPC'][15]='_ctgoutlnorder;Branch order;Ταξινόμηση';
$__LOCALE['RCKATEGORIES_DPC'][16]='_search;Search;Αναζητήσιμο';
$__LOCALE['RCKATEGORIES_DPC'][17]='_active;Active;Ενεργό';
$__LOCALE['RCKATEGORIES_DPC'][18]='_view;Show;Εμφανές';
$__LOCALE['RCKATEGORIES_DPC'][19]='_OK;Success;Επιτυχώς';
$__LOCALE['RCKATEGORIES_DPC'][20]='_cat0;Category 1;Κατηγορία 1';
$__LOCALE['RCKATEGORIES_DPC'][21]='_cat1;Category 2;Κατηγορία 2';
$__LOCALE['RCKATEGORIES_DPC'][22]='_cat2;Category 3;Κατηγορία 3';
$__LOCALE['RCKATEGORIES_DPC'][23]='_cat3;Category 4;Κατηγορία 4';
$__LOCALE['RCKATEGORIES_DPC'][24]='_cat4;Category 5;Κατηγορία 5';
$__LOCALE['RCKATEGORIES_DPC'][25]='_id;ID;ID';

class rckategories extends shkategories {
  
    var $title, $path;
	var $post, $msg;
	var $urlbase;	
	//var $cptemplate;

	public function __construct() {
	
		shkategories::__construct();  
	  	
		$this->title = localize('RCKATEGORIES_DPC',getlocal());	 
		//$this->urlbase = paramload('SHELL','urlbase');
		$this->urlbase = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
		$this->urlbase.= (strstr($_SERVER['HTTP_HOST'], 'www')) ? $_SERVER['HTTP_HOST'] : 'www.' . $_SERVER['HTTP_HOST'];		
		
		$csep = remote_paramload('SHKATEGORIES','csep',$this->path); 
		$this->cseparator = $csep ? $csep : '^';	
		
		$this->post = false;  
		$this->msg = null; 		
	
		//$this->ajaxLink = seturl('t=cpvstatsshow&statsid=');
		//$this->cptemplate = remote_paramload('FRONTHTMLPAGE','cptemplate',$this->path);	  
	}
	
	public function event($event=null) {
	
	  $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	  if ($login!='yes') return null;		
	
	    switch ($event) {
		  case 'cpaddcat'  :	break;
		  case 'cpeditcat' :	break;		
		
		  //rcbrowser hacks
		  case 'cpbradd'  :	break;
		  case 'cpbredit' :	break;
		  case 'cpbrdel'  : break; 				
		
          case 'disablecat' :   
		                        $this->disable_category(GetReq('cat'));
		                        break;				
		  case "savecats":      $this->save_category();
		                        $this->post = true;
		                        break;		
		  case "delcats" :      $this->delete_category();
		                        $this->post = true;
		                        break;										
          case 'openfolder' : 
		                        break;		
          case 'cats' : 
		                        break;	
		  case 'gencats'  :     
		                        break;									
		  case 'addcats'  :
		                        break;								
          case 'editcats' : 
		                        break;
		  case 'cpread'  :     													
								break;
		  case 'cpwrite' :     
		                        break;
		  case 'cpeditframe':   echo $this->loadframe('editcat');
								die();
		                        break;								
          case 'cpkategories' :
		  default             : 
		  
		}  
		                       
    }
	
	public function action($action=null) {	
	
	    $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;
			 
	
	    switch ($action) {	
		  case 'cpaddcat'  :	$out .= $this->add_category2(null,null,null,null,'d',true); 
								break;
		  case 'cpeditcat' :	$out .= $this->edit_category(); 
								break;				
		  		
		  case "delcats" :      $title = $this->title;
		                        $out .= 'delete';
		                        break;		
		  case "savecats":      $title = $this->title;
		                        $out .= 'save';
		                        break;			
		
          case 'openfolder' :   $title = $this->tree_navigation('cats',null,0);
		                        $out .= 'openfolder';
		                        break;	
		  case 'gencats'  :     $title = 'Generate Categories';
		                        $out .= $this->generate_categories(GetReq('keys'));
		                        break;									
          case 'addcats' :      $add=true;								
          case 'editcats':      $title = $this->tree_navigation('cats',null,0);
		                        $out .= 'edit /add';
		                        break;								
          case 'cats'    :      $title = $this->title;
		                        $out = $this->show_menu('cpkategories',3,$this->treeview,GetReq('cat'),'',1);
		                        break;									
          case 'disablecat'   :  								
          case 'cpkategories' : 
		  default             :	$out = $this->edit_kategories();								  
        }
		
		
		return ($out);
    }	
	
	//call from html
	/*public function javascript() {
		$editurl = seturl("t=cpeditframe&id=");
		$out = "function edit_cat() { var str = arguments[0]; sndReqArg('$editurl'+str,'editcat');}";		
		return ($out);
	}*/
	
	/*not used */
    protected function set_viewable() {
		$g = GetReq('g');	 
		$group = explode($this->cseparator,$g);
		$cat = $group[count($group)-1];

		$file = paramload('SHELL','prpath')."exclude_sen.txt";
	 	  
		if (@file_exists($file)) {
	 
			$f = fopen($file,"a");
			$data = fwrite($f,",".$g);
			fclose($f);   
		}	  
    }
	
    /*not used */
    protected function menu($adv=null) {
		$g = GetReq('cat');	   
		$out .= $this->msg; 

		$cmd .= seturl("t=disablecat&cat=$g","Disable category") . "|";   
		$cmd .= seturl("t=enablecat&cat=$g","Enable category");		   
  
		$myadd = new window('',$cmd);
		$out .= $myadd->render("center::100%::0::group_article_selected::right::0::0::");	   
		unset ($myadd);   
	   
		return ($out);
    }
  
    //export text ... bug in first sub tree (write main cat 2 times)
    protected function generate_categories($keys=false,$current=null,$leaf=null,$depth=0) {
  
        return ($out);
    }
  
    protected function disable_category($g) {
		$db = GetGlobal('db');	
	   
		if (strlen(trim($g))>0) {
			$group = explode($this->cseparator,$g);   //print_r($group);
			$mg = count($group);
			$depth = ($mg ? $mg : 0); //echo 'DEPTH:',$depth;
		}
		else
			$depth = 0;	    
	   
		switch ($depth) {
		/*     case 1 : $sSQL = "select cat3,cat2 from categories where "; break;
		   case 2 : $sSQL = "select cat4,cat3,cat2 from categories where "; break;
		   case 3 : $sSQL = "select cat5,cat4,cat3,cat2 from categories where "; break;
		   case 4 : $sSQL = "select null from categories"; break;*/
			default: $sSQL = "update categories set ctgid=0 where "; 
		}
		//$sSQL .= ' where '; 
		switch ($depth) {
			case 4 : 
			case 3 : $sSQL .= "cat4='" . $this->replace_spchars($group[2],1) . "' and ";
			case 2 : $sSQL .= "cat3='" . $this->replace_spchars($group[1],1) . "' and ";
			case 1 : $sSQL .= "cat2='" . $this->replace_spchars($group[0],1) . "' and "; //break;
			default: $sSQL .= "ctgid>0";
		}	
		//echo $sSQL;   
	    
		$result = $db->Execute($sSQL,2);
		if ($result)   
			$this->msg = str_replace($this->cseparator,'>',$group) . 'disabled!';					   		     
    }
  
    //2nd version..handle inside from rcbrowser
    public function disable($id=null) {
		$db = GetGlobal('db');	
		$id = GetReq('id');//is the recid of rcbrowser call
	   
		//get ctgid (positive number)
		$sSQL = "select ctgid from categories where id=" . $id;     
		$result = $db->Execute($sSQL,2);	
		if ($result) {      
			while(!$result->EOF) {	      
				$ctgid = $result->fields[0];
				$result->MoveNext();			 		 
			}
		}	
		//make ctgid negative number	
		$sSQL = "update categories set ctgid=-" . $ctgid . " where id=" . $id;  
		$result = $db->Execute($sSQL,2);
		if ($result)   
			$ret = ' disabled!';
	   
		return ($ret);  						   		     
    }  
  
    //handle inside from rcbrowser
    public function enable($id=null) {
		$db = GetGlobal('db');	
		$id = GetReq('id');//is the recid of rcbrowser call
	   
		//get ctgid (negative number)
		$sSQL = "select ctgid from categories where id=" . $id;     
		$result = $db->Execute($sSQL,2);	
		if ($result) {      
			while(!$result->EOF) {	      
				$ctgid = $result->fields[0];
				$result->MoveNext();			 		 
			}
		}	
		//make ctgid negative number	
		$sSQL = "update categories set ctgid=" . abs($ctgid) . " where id=" . $id;  
		$result = $db->Execute($sSQL,2);
		if ($result)  
			$ret = ' enabled!';
	   
		return ($ret);   
						   		     
    }  
  
    public function toggle_category() {
		$db = GetGlobal('db');	
		$id = GetReq('id');//is the recid of rcbrowser call 
	   
		//get ctgid (positive number)
		$sSQL = "select ctgid from categories where id=" . $id;     
		$result = $db->Execute($sSQL,2);	
		if ($result) {      
			while(!$result->EOF) {	      
				$ctgid = $result->fields[0];
				$result->MoveNext();			 		 
			}
		}
	   
		if ($ctgid>0)		    
			$ret = $this->disable($id);
		else	 
			$ret = $this->enable($id);
		 
		return ($ret);  
    } 
  
    //import to categories table from text cats (called from rccategories)...disabled
    public function generate_from_text($cat,$ctgid) {
		$db = GetGlobal('db');	  

		//echo $cat;
		$tcat = explode($this->cseparator,str_replace('<br>','',$cat));//br came from text processing at the end of string
	
		$sSQL = "insert into categories (ctgid,cat1";
		foreach ($tcat as $id=>$c) {
			$cid = $id+2;
			$sSQL .= ',cat'.$cid;	
		}  
		$sSQL.= ") values (";
		$sSQL.= $ctgid . ",'ΚΑΤΗΓΟΡΙΕΣ ΕΙΔΩΝ'";
	
		reset($tcat);
		foreach ($tcat as $id=>$c)
			$sSQL .= ",'".trim($c)."'";
		$sSQL .= ')';
	
		$result = $db->Execute($sSQL,2);
		if (!$result)  
			echo $sSQL,' failed!<br>';

    }
  
    protected function add_category1($width=null, $height=null, $rows=null, $editlink=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 440;
        $rows = $rows ? $rows : 18;
        $width = $width ? $width : null; //wide
        $mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;
        $editlink = $editlink ? $editlink : seturl("t=cpeditcat&cat={cat2}");
		$title = $this->title;						
	
	    if (!defined('MYGRID_DPC')) 
		   return ($this->add_category()); 
		   
        $lan = getlocal() ? getlocal() : 0;
        /*$root_name = 'ITEMS';	 
	    $selected_cat = GetReq('cat') ? $root_name . $this->cseparator . str_replace('_',' ',GetReq('cat')) : $root_name;	
	    if (stristr($selected_cat ,$this->cseparator))
	     $cats = explode($this->cseparator,$selected_cat);  
	    else
	     $cats[] = $selected_cat;*/ 

		$myfields = 'id,ctgid,';
		$mytitles = localize('id',getlocal()) . ',' . localize('_ctgid',getlocal()) . ',';
        $myfields .= /*"cat{$lan}1,*/"cat{$lan}2,cat{$lan}3,cat{$lan}4,cat{$lan}5,";
        $mytitles .= /*localize('_cat0',$lan).','.*/localize('_cat1',getlocal()) .','.
					 localize('_cat2',$lan).','.localize('_cat3',$lan).','.localize('_cat4',$lan).',';		
		$myfields .= 'active,view,search';
		$mytitles .= localize('_active',getlocal()) . ',' . localize('_view',getlocal()) . ',' . localize('_search',getlocal());

		$xsSQL = 'select * from (select '.$myfields . ' from categories) as o';

		_m("mygrid.column use grid2+id|".localize('_id',getlocal())."|5|0|");	
		_m("mygrid.column use grid2+ctgid|".localize('_ctgid',getlocal())."|link|5|".$editlink.'||');		
		_m("mygrid.column use grid2+cat{$lan}2|".localize('_cat1',getlocal())."|10|1|");
	    _m("mygrid.column use grid2+cat{$lan}3|".localize('_cat2',getlocal())."|10|1|");				
		_m("mygrid.column use grid2+cat{$lan}4|".localize('_cat3',getlocal())."|10|1|");
		_m("mygrid.column use grid2+cat{$lan}5|".localize('_cat4',getlocal())."|10|1|");
	    _m("mygrid.column use grid2+active|".localize('_active',getlocal()).'|boolean|1');	
		_m("mygrid.column use grid2+search|".localize('_search',getlocal()).'|boolean|1');	
		_m("mygrid.column use grid2+view|".localize('_view',getlocal()).'|boolean|1');	
		
		$out .= _m("mygrid.grid use grid2+categories+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width");
		
	    return ($out);
	
    }
	
    protected function add_category2($width=null, $height=null, $rows=null, $editlink=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 440;
        $rows = $rows ? $rows : 18;
        $width = $width ? $width : null; //wide
        $mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;
        $editlink = $editlink ? $editlink : seturl("t=cpeditcat&cat={cat2}");
		$title = $this->title;						
	
	    if (!defined('MYGRID_DPC')) 
		   return ($this->add_category()); 
		   
        $lan = getlocal()?getlocal():0;
	
	    if (GetReq('cat')) {
			$myfields = 'id,ctgid,';
			$mytitles = localize('id',getlocal()) . ',' . localize('_ctgid',getlocal()) . ',';
			$myfields .= /*"cat{$lan}1,*/"cat{$lan}2,cat{$lan}3,cat{$lan}4,cat{$lan}5,";
			$mytitles .= /*localize('_cat0',$lan).','.*/localize('_cat1',getlocal()) .','.
					 localize('_cat2',$lan).','.localize('_cat3',$lan).','.localize('_cat4',$lan).',';		
			$myfields .= 'active,view,search';
			$mytitles .= localize('_active',getlocal()) . ',' . localize('_view',getlocal()) . ',' . localize('_search',getlocal());

			$xsSQL = 'select * from (select '.$myfields . ' from categories) as o';

			_m("mygrid.column use grid2+id|".localize('_id',getlocal())."|5|0|");	
			_m("mygrid.column use grid2+ctgid|".localize('_ctgid',getlocal())."|link|5|".$editlink.'||');		
			_m("mygrid.column use grid2+cat{$lan}2|".localize('_cat1',getlocal())."|10|1|");
			_m("mygrid.column use grid2+cat{$lan}3|".localize('_cat2',getlocal())."|10|1|");				
			_m("mygrid.column use grid2+cat{$lan}4|".localize('_cat3',getlocal())."|10|1|");
			_m("mygrid.column use grid2+cat{$lan}5|".localize('_cat4',getlocal())."|10|1|");
			_m("mygrid.column use grid2+active|".localize('_active',getlocal()).'|boolean|1');	
			_m("mygrid.column use grid2+search|".localize('_search',getlocal()).'|boolean|1');	
			_m("mygrid.column use grid2+view|".localize('_view',getlocal()).'|boolean|1');	
			$out .= _m("mygrid.grid use grid2+categories+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width");
			return ($out);
		} 
		else {

			$myfields = 'id,ctgid,';
			$mytitles = localize('id',getlocal()) . ',' . localize('_ctgid',getlocal()) . ',';
			$myfields .= "cat1,cat2,cat3,cat4,cat5,";
			$myfields .= "cat{$lan}1,cat{$lan}2,cat{$lan}3,cat{$lan}4,cat{$lan}5,";
			$mytitles .= localize('_cat0',$lan).','.localize('_cat1',$lan).','.localize('_cat2',$lan).','.localize('_cat3',$lan).','.localize('_cat4',$lan).','.localize('_cat0',$lan).',';
			$mytitles .= localize('_cat1',getlocal()) .','.localize('_cat2',$lan).','.localize('_cat3',$lan).','.localize('_cat4',$lan).',';		
		
			$myfields .= 'active,view,search';
			$mytitles .= localize('_active',getlocal()) . ',' . localize('_view',getlocal()) . ',' . localize('_search',getlocal());

			$xsSQL = 'select * from (select '.$myfields . ' from categories) as o';

			_m("mygrid.column use grid2+id|".localize('_id',getlocal())."|5|1|");	
			_m("mygrid.column use grid2+ctgid|".localize('_ctgid',getlocal())."|5|1|");
			_m("mygrid.column use grid2+cat1|".localize('_cat0',getlocal())."|10|1|");
			_m("mygrid.column use grid2+cat2|".localize('_cat1',getlocal())."|10|1|");
			_m("mygrid.column use grid2+cat3|".localize('_cat2',getlocal())."|10|1|");				
			_m("mygrid.column use grid2+cat4|".localize('_cat3',getlocal())."|10|1|");
			_m("mygrid.column use grid2+cat5|".localize('_cat4',getlocal())."|10|1|");			
			_m("mygrid.column use grid2+cat{$lan}1|".localize('_cat0',getlocal())."|10|1|");
			_m("mygrid.column use grid2+cat{$lan}2|".localize('_cat1',getlocal())."|10|1|");
			_m("mygrid.column use grid2+cat{$lan}3|".localize('_cat2',getlocal())."|10|1|");				
			_m("mygrid.column use grid2+cat{$lan}4|".localize('_cat3',getlocal())."|10|1|");
			_m("mygrid.column use grid2+cat{$lan}5|".localize('_cat4',getlocal())."|10|1|");
			_m("mygrid.column use grid2+active|".localize('_active',getlocal()).'|boolean|1');	
			_m("mygrid.column use grid2+search|".localize('_search',getlocal()).'|boolean|1');	
			_m("mygrid.column use grid2+view|".localize('_view',getlocal()).'|boolean|1');	
			$out .= _m("mygrid.grid use grid2+categories+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width");
			return ($out);
		}
	
    }
  	
    protected function add_category($category=null) {
		$db = GetGlobal('db'); 
 	   
		$root_name = 'ITEMS';
		$mycat = $category ? $category : GetReq('cat');	   
		$selected_cat = $mycat ? $root_name . $this->cseparator . $mycat : $root_name;
	   
		if (stristr($selected_cat ,$this->cseparator))
			$cats = explode($this->cseparator,$selected_cat);  
		else
			$cats[] = $selected_cat;	 
	 
		//SQL CATEGORIE WITHOUT BRANCH EXIST...
		$sSQL = "select id from categories ";
		$sSQL .= " WHERE ";

		foreach ($cats as $i=>$c) {
			$idx = $i+1;//+2;...root_name added
			$where[] = "cat$idx='" . $this->replace_spchars($c,1) . "'";	
		}	 
		$sSQL .= implode(' and ',$where);
	   
		$nextbranch = $idx+1;
		$sSQL .= ' and (cat' . $nextbranch . ' is NULL' . ' or cat' . $nextbranch . "='')";
	   
		$sSQL .= ' LIMIT 1';	 //in case of many recs...???'
		//echo $sSQL;
	  
		$resultset = $db->Execute($sSQL,2);	
		$id = $resultset->fields['id']	; 	  
	   
		if ($id) { //exist category with empty leaf (last catN)
			$out = $this->edit_category(1);
		}
		else {	 

			//SQL CATEGORIE BRANCH EXIST SO MAKE A NEW...GETTING CTG DATA...
			$sSQL = "select id,ctgid,ctgoutline,ctgoutlnorder,cat1,cat2,cat3,cat4,cat5,cat01,cat02,cat03,cat04,cat05,cat11,cat12,cat13,cat14,cat15 from categories ";
			$sSQL .= " WHERE ";

			foreach ($cats as $iz=>$cz) {
				$idy = $iz+1;
				$where2[] = "cat$idy='" . $this->replace_spchars($cz,1) . "'";	
			}	 

			$sSQL .= implode(' and ',$where2);   
			//$sSQL .= ' LIMIT 1';	 //in case of many recs...???'

			$resultset = $db->Execute($sSQL,2);	
			//print_r($resultset->fields);
		 
			$nextbranchid = $db->Affected_Rows() + 1;		 	 
  
		    global $config;
			$config['FORM']['element_bgcolor1'] = 'EEEEEE';
			$config['FORM']['element_bgcolor2'] = 'DDDDDD';				
			
			$myfields = 'ctgid,ctgoutline,ctgoutlnorder,';
			$mytitles = localize('_ctgid',getlocal()) . ',' . localize('_ctgoutline',getlocal()) . ',' . localize('_ctgoutlnorder',getlocal()) . ',';				

			if (GetReq('cat')) {//($selected_cat) { //..selected_cat has 'ITEM'..but works fine!
				SetParam('ctgid', $resultset->fields['ctgid']+1);    
				SetParam('ctgoutline', $resultset->fields['ctgoutline']?$resultset->fields['ctgoutline']. '.'.$nextbranchid : $nextbranchid);  
				SetParam('ctgoutlnorder', $resultset->fields['ctgoutlnorder']+1);  			
			
				// STANDART DESCR ....			
				$fields = 'cat1,cat2,cat3,cat4,cat5';
				$catfields = explode(',',$fields);
				$titles = '_LEVEL1,_LEVEL2,_LEVEL3,_LEVEL4,_LEVEL5';				
				$cattitles = explode(',',$titles);
		  		
				foreach ($cats as $i=>$mycat) {
					if ($catlevel = $mycat) {
						$_fields[] = $catfields[$i];
						//SetParam($catfields[$i],$catlevel); //set predef cat level
						SetParam($catfields[$i],$resultset->fields[$catfields[$i]]); 
						$localized_cattitles[] = localize($cattitles[$i],getlocal());
					}
				}
				$_fields[] = $catfields[$i+1]; //plus 1 cat			  
				$localized_cattitles[] = localize('_NEWLEVEL',getlocal());	
			  
				// FOREIGN DESCR ....0			  
				$fields0 = 'cat01,cat02,cat03,cat04,cat05';
				$catfields0 = explode(',',$fields0);
				$titles0 = '_FLEVEL1,_FLEVEL2,_FLEVEL3,_FLEVEL4,_FLEVEL5';				
				$cattitles0 = explode(',',$titles0);
			
				reset($cats);
				foreach ($cats as $i=>$mycat) {
					//echo $i,$mycat;
					if ($catlevel = $mycat) {
						$_fields0[] = $catfields0[$i];
						SetParam($catfields0[$i],$resultset->fields[$catfields0[$i]]); 
						$localized_cattitles0[] = localize($cattitles0[$i],getlocal());
					}
				}	
				$_fields0[] = $catfields0[$i+1]; //plus 1 cat			  
				$localized_cattitles0[] = localize('_FNEWLEVEL',getlocal());	
			  
				// FOREIGN DESCR ....1			  
				$fields1 = 'cat11,cat12,cat13,cat14,cat15';
				$catfields1 = explode(',',$fields1);
				$titles1 = '_FLEVEL1,_FLEVEL2,_FLEVEL3,_FLEVEL4,_FLEVEL5';				
				$cattitles1 = explode(',',$titles1);
			
				reset($cats);
				foreach ($cats as $i=>$mycat) {
					//echo $i,$mycat;
					if ($catlevel = $mycat) {
						$_fields1[] = $catfields1[$i];
						SetParam($catfields1[$i],$resultset->fields[$catfields1[$i]]);
						$localized_cattitles1[] = localize($cattitles1[$i],getlocal());
					}
				}				  

				$_fields1[] = $catfields1[$i+1]; //plus 1 cat			  
				$localized_cattitles1[] = localize('_FNEWLEVEL',getlocal());
			  
				$myfields .= implode(',',$_fields) . ',' . implode(',',$_fields0) . ',' . implode(',',$_fields1);
				$mytitles .= implode(',',$localized_cattitles) . ',' . implode(',',$localized_cattitles0) . ',' . implode(',',$localized_cattitles1);			  
			}
			else {//root cat
				//echo 'ROOT:';
				SetParam('ctgid', $nextbranchid);   	 
				SetParam('ctgoutline', $nextbranchid);  
				SetParam('ctgoutlnorder', $nextbranchid); 
			  
				$myfields .= 'cat1,cat2,cat01,cat02,cat11,cat12';
				$mytitles .= localize('_LEVEL1',getlocal()).','.localize('_NEWLEVEL',getlocal()) .','.
			               localize('_FLEVEL1',getlocal()).','.localize('_FNEWLEVEL',getlocal()).','.
						   localize('_FLEVEL1',getlocal()).','.localize('_FNEWLEVEL',getlocal());			
			 
				SetParam('cat1', $resultset->fields['cat1']?$resultset->fields['cat1']:$root_name); 
				SetParam('cat01', $resultset->fields['cat01']?$resultset->fields['cat01']:$root_name); 
				SetParam('cat11', $resultset->fields['cat11']?$resultset->fields['cat11']:$root_name); 			  			  
			}
			
			$myfields .= ',active,view,search';
			$mytitles .= ','. localize('_active',getlocal()) . ',' . localize('_view',getlocal()) . ',' . localize('_search',getlocal());
			
			SetParam('active',1);
			SetParam('view',1);
			SetParam('search',1);
			//echo $myfields,'-',$mytitles;
		
			$gocat = GetReq('cat'); 
			_m('dataforms.setform use myform+myform+5+5+50+100+0+0');
			_m('dataforms.setformadv use 0+0+50+10+id');	  	   
			//_m("dataforms.setformgoto use PHPDAC:rcupload.editmode_upload_files:".localize('_OK',getlocal()));
			//_m('dataforms.setformtemplate use cpitemsadd'); //use template		   
				 				 
			$post = 	localize('_POST',getlocal());
			$clear = localize('_CLEAR',getlocal());
			$out .= _m("dataforms.getform use insert.categories+dataformsinsert&cat=$gocat&editmode=$editmode+$post+$clear+$myfields+$mytitles++dummy+dummy");	  
		 
		} //id
	   
		if (defined('MYGRID_DPC')) {
           $xsSQL = "select id,ctgid,ctgoutline,ctgoutlnorder,cat1,cat2,cat3,cat4,cat5,cat01,cat02,cat03,cat04,cat05,cat11,cat12,cat13,cat14,cat15 from categories ";
		   $out .= _m("mygrid.grid use grid1+categories+$xsSQL+d++id+1+1+20+400");
		}		   
	   
		return ($out);  
    }
  
    protected function edit_category($addcat=null) {
		$db = GetGlobal('db'); 
	   
		$root_name = 'ITEMS';	   
		if ($root_name)	   
			$selected_cat = $root_name . $this->cseparator .  GetReq('cat');	   
		//$selected_cat = GetReq('cat');
		//echo $selected_cat;	   
	   
		if (stristr($selected_cat ,$this->cseparator))
			$cats = explode($this->cseparator,$selected_cat);  
		else
			$cats[] = $selected_cat;		  
  
		$sSQL = "select id from categories ";
		$sSQL .= " WHERE ";
	   
		foreach ($cats as $i=>$c) {
			$id = $i+1;//+2;...root_name added
			$where[] = "cat$id='" . $this->replace_spchars($c,1) . "'";	
		}	 
		$sSQL .= implode(' and ',$where);
		$sSQL .= ' LIMIT 1';	 //in case of many recs...???'
		//echo $sSQL;
	  
		$resultset = $db->Execute($sSQL,2);	
		//print_r($resultset->fields);
		$id = $resultset->fields['id']	; 	   
	   
		global $config;
		$config['FORM']['element_bgcolor1'] = 'EEEEEE';
		$config['FORM']['element_bgcolor2'] = 'DDDDDD';	

		$myfields = 'ctgid,ctgoutline,ctgoutlnorder,';	
		$mytitles = localize('_ctgid',getlocal()) . ',' . localize('_ctgoutline',getlocal()) . ',' . localize('_ctgoutlnorder',getlocal()) . ',';			
						
        $fields = 'cat1,cat2,cat3,cat4,cat5';
		$catfields = explode(',',$fields);
        $titles = '_LEVEL1,_LEVEL2,_LEVEL3,_LEVEL4,_LEVEL5';				
		$cattitles = explode(',',$titles);	
			
        reset($cats);
		foreach ($cats as $i=>$mycat) {
		    //echo $i,$mycat;
			if ($catlevel = $mycat) {
				$_fields[] = $catfields[$i];
				$localized_cattitles[] = localize($cattitles[$i],getlocal());
			}
		}	

		//when add a category..comming from add_category procedure  ...modify an existing rec with empty leaf
        if ($addcat) {
            $_fields[] = $catfields[$i+1]; //plus 1 cat		
			$localized_cattitles[] = localize('_NEWLEVEL',getlocal());			  
        } 			
			
        $fields0 = 'cat01,cat02,cat03,cat04,cat05';
		$catfields0 = explode(',',$fields0);
        $titles0 = '_FLEVEL1,_FLEVEL2,_FLEVEL3,_FLEVEL4,_FLEVEL5';				
		$cattitles0 = explode(',',$titles0);
			
		reset($cats);
		foreach ($cats as $i=>$mycat) {
			//echo $i,$mycat;
			if ($catlevel = $mycat) {
				$_fields0[] = $catfields0[$i];
				$localized_cattitles0[] = localize($cattitles0[$i],getlocal());
			}
		}	

		//when add a category..comming from add_category procedure  ...modify an existing rec with empty leaf
        if ($addcat) {
            $_fields0[] = $catfields0[$i+1]; //plus 1 cat		
			$localized_cattitles0[] = localize('_FNEWLEVEL',getlocal());			  
        } 			

        $fields1 = 'cat11,cat12,cat13,cat14,cat15';
		$catfields1 = explode(',',$fields1);
        $titles1 = '_FLEVEL1,_FLEVEL2,_FLEVEL3,_FLEVEL4,_FLEVEL5';				
		$cattitles1 = explode(',',$titles1);
			
		reset($cats);
		foreach ($cats as $i=>$mycat) {
			//echo $i,$mycat;
			if ($catlevel = $mycat) {
				$_fields1[] = $catfields1[$i];
				$localized_cattitles1[] = localize($cattitles1[$i],getlocal());
			}
		}	

		//when add a category..comming from add_category procedure  ...modify an existing rec with empty leaf
        if ($addcat) {
            $_fields1[] = $catfields1[$i+1]; //plus 1 cat		
			$localized_cattitles1[] = localize('_FNEWLEVEL',getlocal());			  
        } 			
						  
		$myfields .= implode(',',$_fields) . ',' . implode(',',$_fields0) . ',' . implode(',',$_fields1);
		$mytitles .= implode(',',$localized_cattitles) . ',' . implode(',',$localized_cattitles0) . ',' . implode(',',$localized_cattitles1);
			
		$myfields .= ',active,view,search';
		$mytitles .= ','. localize('_active',getlocal()) . ',' . localize('_view',getlocal()) . ',' . localize('_search',getlocal());	

        //echo $myfields,'-',$mytitles;			
	    
		$gocat = GetReq('cat');
	   
		_m('dataforms.setform use myform+myform+5+5+50+100+0+0');
		_m('dataforms.setformadv use 0+0+50+10');	  
				 	                    
		$post = 	localize('_POST',getlocal());
		$clear = localize('_CLEAR',getlocal());
		$out .= _m("dataforms.getform use update.categories+dataformsupdate&cat=$gocat&editmode=$editmode+$post+$clear+$myfields+$mytitles++id=$id+dummy");	  
	   	
		return ($out);		 
    }
	
	protected function loadframe($ajaxdiv=null) {
	    $db = GetGlobal('db');
		$id = GetReq('id');
		//due to str id of code2..transform from rec id
	    $sSQL = 'select cat2,cat3,cat4,cat5 from categories where id='.$id;
		$ret = $db->Execute($sSQL,2);	 			
		$cats[] = $ret->fields['cat2'];
		$cats[] = $ret->fields['cat3'];
		$cats[] = $ret->fields['cat4'];
		$cats[] = $ret->fields['cat5'];
		
		//$cat = implode($this->cseparator,$cats);
		//$editurl = seturl("t=cpeditcat&editmode=1&cat=".$cat);//$id;
		$frame = '';
		$editurl = null;
		//get all/last cat
		foreach ($cats as $c) {
		   if (trim($c)) {//$cat = str_replace(' ','_',$c);
		       $cat = $this->replace_spchars($c);
		       $editurl = $this->urlbase . "/cp/cpmhtmleditor.php?t=cpmhtmleditor&iframe=1&htmlfile=&type=.html&id=".$cat;
               $frame .= "<iframe src =\"$editurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";    		   
		   }
		}   
		//$editurl = $this->urlbase . "/cp/cpmhtmleditor.php?htmlfile=&type=.html&id=".$cat;
		//$frame = "<iframe src =\"$editurl\" width=\"100%\" height=\"750px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return ($ajaxdiv.'|'.$frame);
		else
			return ($frame);
	}	
	
	protected function edit_kategories() {
		$cpGet = GetGlobal('controller')->calldpc_var('rcpmenu.cpGet');
		//print_r($cpGet); echo '>';	  
		$cat = $cpGet['cat']; //stored cat for cp
		$id = 'id';//$this->getmapf('code');
		$editlink = "javascript:edit_cat({".$id."})";
	   
		$rd = $this->add_category2(null,300,12, $editlink, 'e', true);

		if ($cat) {//preselected cat
			//$editurl = seturl("t=cpeditcat&editmode=1&cat=".$cat);//$id;
			$editurl = $this->urlbase . "/cp/cpmhtmleditor.php?t=cpmhtmleditor&iframe=1&htmlfile=&type=.html&id=".$cat;
			$init_content = "<iframe src =\"$editurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";    
		}
		else
			$init_content = null; 
	 
		//$rd .= _m("ajax.setajaxdiv use editcat+".$init_content);	   	   
		$rd .= "<div id=\"editcat\">".$init_content . "</div>";	   	   
	   		
		return ($rd);			     
	}
	
	/*used by fast item insert cp*/
	public function add_kategory_data($cat=null) {
        if (!$cat) return;
        $db = GetGlobal('db'); 
	    $lan = getlocal();
	    $lan = $lang?$lang:getlocal();	
		
	    if (stristr($cat ,$this->cseparator))
			$cats = explode($this->cseparator,$cat);  
		else
			$cats[] = $cat;	
			
		$cat_to_add = array();	
		$loop = 1;
        while (($loop) && (!empty($cats))) {		
			//print_r($cats);

			$sSQL = "select id from categories ";
			$sSQL .= " WHERE cat1='ITEMS' and ";
	        $where = null;
			foreach ($cats as $i=>$c) {
				$id = $i+2;//+2;...root_name added
				$where[] = "cat$id='" . $this->replace_spchars($c,1) . "'";	
			}	 
			$sSQL .= implode(' and ',$where);
			$sSQL .= ' LIMIT 1';// in case of many recs...???'
			//echo $sSQL,'<br/>';
			$resultset = $db->Execute($sSQL,2);	
			//print_r($resultset->fields);
			$retid = $resultset->fields['id'];
			
            $loop = $retid ? 0 : 1;
            if ($loop) {
			    $addcat = array_pop($cats); //prev level sql select			
                $cat_to_add[] = $addcat;//add category for adding 
			}	
        }
		//print_r($cats); //existed cat record 
        //print_r($cat_to_add); //categories to add
        if (!empty($cat_to_add)) {
		
		    $newcats = array_reverse($cat_to_add); //due to array_pop..
			
			/*check for null field before update / insert */
			$cid = $id+1;
			$checkSQL = "select id from categories WHERE ";
			$checkSQL.= "id='$retid' and (cat{$cid}='' or cat{$cid} is NULL)";
			//echo $checkSQL.'<br/>';
			$rset = $db->Execute($checkSQL,2);
			$retid_checked = $rset->fields['id'];
			
		    if (/*(!empty($cats)) &&*/ ($retid_checked)) {//checked
				$sSQL = "update categories set ";
				if (!empty($newcats)) {//new cats
				  foreach ($newcats as $key=>$value) {
					$k = $key+count($cats)+2;
					if ($k<6) //max cat0..5
						$nc[] = "cat{$k}='$value',cat0{$k}='$value',cat1{$k}='$value'";
				  }
				}
				$sSQL .= implode(",",$nc);
				$sSQL .= " where id='$retid' and cat1='ITEMS' and " . implode(' and ',$where);			
			}
			else {
			    $nc = array();
			    $sSQL = "insert into categories set ctgid=1,cat1='ITEMS',cat01='ITEMS',cat11='ITEMS',";
				if (!empty($cats)) {//existed cats when dublicated record
				  foreach ($cats as $key=>$value) {
					$k = $key+count($cats)+1;
					$nc[] = "cat{$k}='$value',cat0{$k}='$value',cat1{$k}='$value'";
				  }
				}
				if (!empty($newcats)) {//new cats
				  foreach ($newcats as $key=>$value) {
				    $k = $key+count($cats)+2;
					if ($k<6) //max cat0..5
						$nc[] = "cat{$k}='$value',cat0{$k}='$value',cat1{$k}='$value'";
				  }
				}
				$sSQL .= implode(",",$nc);
			}
			//echo $sSQL;
			$result = $db->Execute($sSQL);
			return ($result);
        }		
	}
  
};
}
?>