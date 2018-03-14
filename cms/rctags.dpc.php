<?php
$__DPCSEC['RCTAGS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ( (!defined("RCTAGS_DPC")) && (seclevel('RCTAGS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCTAGS_DPC",true);

$__DPC['RCTAGS_DPC'] = 'rctags';

$d = GetGlobal('controller')->require_dpc('cms/shtags.dpc.php');
require_once($d);

$__EVENTS['RCTAGS_DPC'][0]='cptags';
$__EVENTS['RCTAGS_DPC'][1]='tags';
$__EVENTS['RCTAGS_DPC'][2]='cpaddtag';
$__EVENTS['RCTAGS_DPC'][3]='cpedittag';
$__EVENTS['RCTAGS_DPC'][4]='cpeditctag';
$__EVENTS['RCTAGS_DPC'][5]='cpedititag';
$__EVENTS['RCTAGS_DPC'][6]='cptagsall';

$__ACTIONS['RCTAGS_DPC'][0]='cptags';
$__ACTIONS['RCTAGS_DPC'][1]='tags';
$__ACTIONS['RCTAGS_DPC'][2]='cpaddtag';
$__ACTIONS['RCTAGS_DPC'][3]='cpedittag';
$__ACTIONS['RCTAGS_DPC'][4]='cpeditctag';
$__ACTIONS['RCTAGS_DPC'][5]='cpedititag';
$__ACTIONS['RCTAGS_DPC'][6]='cptagsall';

$__LOCALE['RCTAGS_DPC'][0]='RCTAGS_DPC;Tags;Tags';
$__LOCALE['RCTAGS_DPC'][1]='_LEVEL1;Category Level 1;Κατηγορία επιπέδου 1';
$__LOCALE['RCTAGS_DPC'][2]='_LEVEL2;Category Level 2;Κατηγορία επιπέδου 2';
$__LOCALE['RCTAGS_DPC'][3]='_LEVEL3;Category Level 3;Κατηγορία επιπέδου 3';
$__LOCALE['RCTAGS_DPC'][4]='_LEVEL4;Category Level 4;Κατηγορία επιπέδου 4';
$__LOCALE['RCTAGS_DPC'][5]='_LEVEL5;Category Level 5;Κατηγορία επιπέδου 5';
$__LOCALE['RCTAGS_DPC'][6]='_NEWLEVEL;<b>New category</b>;<b>Νέα κατηγορία</b>';
$__LOCALE['RCTAGS_DPC'][7]='_FLEVEL1;Foreign Alias Level 1;Κατηγορία επιπέδου 1 (Ξενόγλωσση)';
$__LOCALE['RCTAGS_DPC'][8]='_FLEVEL2;Foreign Alias Level 2;Κατηγορία επιπέδου 2 (Ξενόγλωσση)';
$__LOCALE['RCTAGS_DPC'][9]='_FLEVEL3;Foreign Alias Level 3;Κατηγορία επιπέδου 3 (Ξενόγλωσση)';
$__LOCALE['RCTAGS_DPC'][10]='_FLEVEL4;Foreign Alias Level 4;Κατηγορία επιπέδου 4 (Ξενόγλωσση)';
$__LOCALE['RCTAGS_DPC'][11]='_FLEVEL5;Foreign Alias Level 5;Κατηγορία επιπέδου 5 (Ξενόγλωσση)';
$__LOCALE['RCTAGS_DPC'][12]='_FNEWLEVEL;<b>New category alias</b>;<b>Νέα κατηγορία (Ξενόγλωσση)</b>';
$__LOCALE['RCTAGS_DPC'][13]='_code;Id;Id';
$__LOCALE['RCTAGS_DPC'][14]='_tag;Tag;Tag';
$__LOCALE['RCTAGS_DPC'][15]='_keywords;Keywords;Λέξεις κλειδιά';
$__LOCALE['RCTAGS_DPC'][16]='_descr;Description;Περιγραφή';
$__LOCALE['RCTAGS_DPC'][17]='_CLEAR;Clear;Καθαρισμός';
$__LOCALE['RCTAGS_DPC'][18]='_POST;Post;Αποστολή';
$__LOCALE['RCTAGS_DPC'][19]='_OK;Success;Επιτυχώς';
$__LOCALE['RCTAGS_DPC'][20]='_title;Title;Τίτλος';
$__LOCALE['RCTAGS_DPC'][21]='_tagid;Id;Id';
$__LOCALE['RCTAGS_DPC'][22]='_tagcode;Code;Κωδικός';
$__LOCALE['RCTAGS_DPC'][23]='_tagdescr;Description;Περιγραφή';
$__LOCALE['RCTAGS_DPC'][24]='_tagtitle;Title;Τίτλος';
$__LOCALE['RCTAGS_DPC'][25]='_tagkeywords;Keywords;Κλειδιά';
$__LOCALE['RCTAGS_DPC'][26]='_tagtag;Tag;Ετικέτα';

class rctags extends shtags {
  
    var $title, $path, $catpath, $catfkey, $cext, $initfile;
	var $post, $msg;
	var $browser;
	var $cseparator;

	public function __construct() {
	
      shtags::shtags(); 
	  	
	  $this->title = localize('RCTAGS_DPC',getlocal());	
	  $this->post = false;  
	  $this->msg = null;

	  $csep = remote_paramload('RCITEMS','csep',$this->path); 
      $this->cseparator = $csep ? $csep : '^';		  
	}
	
	public function event($event=null) {
	
	   	$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;				
	
	    switch ($event) {
			
		  case 'cptagsall'  :   break;	

		  case 'cpeditctag' :	break;	
		  case 'cpedititag' :	break;			  							
          case 'cptags' :
		  default             : 							  
        }			
    }
	
	public function action($action=null) {	 		 
	
	    switch ($action) {	
		
		  case 'cptagsall'  : 	$out = $this->show_alltags_list_grid(null,300,12,null,'d',true);	
								break;
		  case 'cpeditctag' :	 
		  case 'cpedititag' :									
          case 'cptags'     : 
		  default           :   $out = $this->show_tag_list_grid(null,300,12,null,'d',true); 
								//$out.= $this->show_alltags_list_grid(null,300,12,null,'d',true);
											
        }
		
		return ($out);
    }	

	public function show_tags() {
        $db = GetGlobal('db');
		$cpGet = _v('rcpmenu.cpGet');		
		$item = _m("cmsrt.getRealItemCode use " . $cpGet['id']);
		$cat = $cpGet['cat'];
		
		$greek_cat = iconv("UTF-8", "ISO-8859-7", $cat);
		$greek_item = iconv("UTF-8", "ISO-8859-7", $id);		
	    $lan = getlocal();
	    $itmkeywords = $lan?'keywords'.$lan:'keywords0';
	    $itmdescr = $lan ? 'descr'.$lan : 'descr0';  
		$itmtitle = $lan ? 'title'.$lan : 'title0';
	
		$code = $item ? $item : $cat;
		
        $sSQL = "select code,tag,$itmkeywords,$itmdescr,$itmtitle from ptags ";
	    $sSQL .= " WHERE code='" . $code . "'";

	    $resultset = $db->Execute($sSQL,2);	
	    $result = $resultset;		
		
		if ($itmcode = $result->fields[0]) 
		    $ret = $this->edit_tags($code);	
		else
            $ret = $this->add_tags($code);	

			
        return ($ret);        		
    }	
  
	public function add_tags($code=null) {
       $db = GetGlobal('db'); 
	   $lan = getlocal();
	   $itmkeywords = $lan ? 'keywords'.$lan : 'keywords0';
	   $itmdescr = $lan ? 'descr'.$lan : 'descr0'; 	
       $itmtitle = $lan ? 'title'.$lan : 'title0';	   
 	   	 
	   if (stristr($code ,$this->cseparator))
	     $cc = explode($this->cseparator,$code);  
	   else
	     $cc[] = $code;	 
	   //print_r($cc);
	   
	   $i = array_pop($cc);

       //SQL CATEGORIE WITHOUT BRANCH EXIST...
       $sSQL = "select code,tag,$itmkeywords,$itmdescr,$itmtitle from ptags ";
	   $sSQL .= " WHERE code='" . $code . "'";
	   
	   $resultset = $db->Execute($sSQL,2);	
	   $id = $resultset->fields['code']	; 	

	   if ($id) { 
	   
	     $out = $this->edit_tags($code);
	   }
       else {	 		 
  
	     if ($editmode = GetReq('editmode')) {//default form colors	
		    global $config;
			$config['FORM']['element_bgcolor1'] = 'EEEEEE';
			$config['FORM']['element_bgcolor2'] = 'DDDDDD';				
			
			$myfields = "code,tag,$itmkeywords,$itmdescr,$itmtitle,"; //'ctgid,ctgoutline,ctgoutlnorder,';
			$mytitles = localize('_code',getlocal()) . ',' . localize('_tag',getlocal()) . ',' . localize('_keywords',getlocal()) . ','. localize('_descr',getlocal()) . ','. localize('_title',getlocal());				

			//$myfields .= ',active,view,search';
			//$mytitles .= ','. localize('_active',getlocal()) . ',' . localize('_view',getlocal()) . ',' . localize('_search',getlocal());
			
			SetParam('code',$code);
			
	     } //editmode
		 
	     $gocat = GetReq('cat');	   
	     GetGlobal('controller')->calldpc_method('dataforms.setform use myform+myform+5+5+80+100+0+0');
	     GetGlobal('controller')->calldpc_method('dataforms.setformadv use 0+0+120+10+id');	  	   
	 				 
         $post = 	localize('_POST',getlocal());
	     $clear = localize('_CLEAR',getlocal());
	     $out .= GetGlobal('controller')->calldpc_method("dataforms.getform use insert.ptags+dataformsinsert&cat=$gocat&editmode=$editmode+$post+$clear+$myfields+$mytitles+++dummy");	  
		 
	   } //id
	   
       return ($out);  
    }
  
	public function edit_tags($code=null) {
		$db = GetGlobal('db'); 
		$lan = getlocal();
		$itmkeywords = $lan ? 'keywords'.$lan : 'keywords0';
		$itmdescr = $lan ? 'descr'.$lan : 'descr0'; 
		$itmtitle = $lan ? 'title'.$lan : 'title0';  
	   
		//$cc = urlencode($code);
		$out = $code.':'.$cc;
	   
		global $config;
		$config['FORM']['element_bgcolor1'] = 'EEEEEE';
		$config['FORM']['element_bgcolor2'] = 'DDDDDD';	

		$myfields = "tag,$itmkeywords,$itmdescr,$itmtitle,"; //'ctgid,ctgoutline,ctgoutlnorder,';
		$mytitles = localize('_tag',getlocal()) . ',' . localize('_keywords',getlocal()) . ','. localize('_descr',getlocal()) . ','. localize('_title',getlocal());				
   
	    //$gocat = GetReq('cat');		
		$cpGet = _v('rcpmenu.cpGet');		
		$gocat = $this->cpGet['cat'];    
	   
		_m('dataforms.setform use myform+myform+5+5+80+100+0+0');
		_m('dataforms.setformadv use 0+0+120+10');	  

				 	                    
		$post = 	localize('_POST',getlocal());
		$clear = localize('_CLEAR',getlocal());
		$out .= GetGlobal('controller')->calldpc_method("dataforms.getform use update.ptags+dataformsupdate&cat=$gocat&editmode=$editmode+$post+$clear+$myfields+$mytitles++code=$code+dummy");	  
	   	
		return ($out);		 
	}
  
	//check if code is a tag..so sent back original code
	public function is_tag($code=null) {
        $db = GetGlobal('db');	
		
		if (!$code)
		    return false;
		
        $sSQL = "select code,tag from ptags ";
	    $sSQL .= " WHERE tag='" . $code . "'";
		//echo $sSQL;
	    $resultset = $db->Execute($sSQL,2);	
	    $result = $resultset;  
		
        if ($istag = $result->fields[1]) 
            return ($result->fields[0]);		
		//else	
            //return ($code);//as-is..no tag
		return false;	
	}

	public function show_tag_list_grid($width=null, $height=null, $rows=null, $editlink=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 600;
        $rows = $rows ? $rows : 26;
        $width = $width ? $width : null; //wide
        $mode = $mode ? $mode : 'd';
	    $noctrl = $noctrl ? 0 : 1;  
	    $lan = getlocal() ? getlocal() : 0;
		
		$cpGet = _v('rcpmenu.cpGet');		
		$selected_code = $cpGet['id'] ? _m("cmsrt.getRealItemCode use " . $cpGet['id']) :
		                 ($cpGet['cat'] ? $cpGet['cat'] : null);
						 
						 
  
		if (defined('MYGRID_DPC')) {
		
			//$xsSQL = "select id,code,tag,keywords{$lan},descr{$lan},title{$lan} from ptags ";
			//$out .= _m("mygrid.grid use grid1+ptags+$xsSQL+d++id+1+1+20+400");
			
			$myfields = 'id,code,tag,';
			$mytitles = localize('_tagid',getlocal()) . ',' . localize('_tagcode',getlocal()) . ',' . localize('_tagtag',getlocal()) . ',';				 		
			$myfields .= "keywords{$lan},descr{$lan},title{$lan}";
			$mytitles .= localize('_tagkeywords',getlocal()) . ',' . localize('_tagdescr',getlocal()) . ',' . localize('_tagtitle',getlocal()) . ',';		 		 
		
		    if ($selected_code)
			   $where = " where code='$selected_code'";
			$xsSQL = 'select * from (select '.$myfields . " from ptags $where) as o";

			$farr = explode(',',$myfields);
			$tarr = explode(',',$mytitles);
			foreach ($farr as $i=>$t) {
				if ($t=='id') {
					$type = 6;
					$edit = null;	
					$options = null;					    
				}
				elseif ($t=='code') {
					if ((($mode=='e') || ($mode=='r')) && ($editlink)) {//only edit/read mode
						$type = 'link';
						$edit = 6;			  
						$options = $editlink ;
					}
					else {
						$type = 6;
						$edit = 1;	
						$options = null;	
					}				
				}		   
				/*elseif (stristr($t,'active') || stristr($t,'search') || stristr($t,'view')) {
					$type = 'boolean';
					$edit = 1;
					$options = "1:0";
				}
				elseif (stristr($t,'cat')) {
					$type = 10;//'select';//if jqgrid is not paid, not applicable
					$edit = 1;
				}*/
				else {
					$type = 20;
					$edit = 1;
					$options = null; 
				}
				$title = $tarr[$i];//localize('_'.$t,getlocal());
				_m("mygrid.column use grid1+$t|".$title."|$type|$edit|$options");
			} 

			$out .= _m("mygrid.grid use grid1+ptags+$xsSQL+$mode+{$this->title}+id+$noctrl+1+$rows+$height+$width");			
		}  
		else 
		   $out .= 'Initialize jqgrid.';
	   
		return ($out);
	}  
	
	
	//all tags 2nd grid
	public function show_alltags_list_grid($width=null, $height=null, $rows=null, $editlink=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 600;
        $rows = $rows ? $rows : 26;
        $width = $width ? $width : null; //wide
        $mode = $mode ? $mode : 'd';
	    $noctrl = $noctrl ? 0 : 1;  
	    $lan = getlocal() ? getlocal() : 0;	
				 
		if (defined('MYGRID_DPC')) {
		
			//$xsSQL = "select id,code,tag,keywords{$lan},descr{$lan},title{$lan} from ptags ";
			//$out .= _m("mygrid.grid use grid1+ptags+$xsSQL+d++id+1+1+20+400");
			
			$myfields = 'id,code,tag,';
			$mytitles = localize('_tagid',getlocal()) . ',' . localize('_tagcode',getlocal()) . ',' . localize('_tagtag',getlocal()) . ',';				 		
			$myfields .= "keywords{$lan},descr{$lan},title{$lan}";
			$mytitles .= localize('_tagkeywords',getlocal()) . ',' . localize('_tagdescr',getlocal()) . ',' . localize('_tagtitle',getlocal()) . ',';		 		 
		
			$xsSQL = 'select * from (select '.$myfields . " from ptags) as o";

			$farr = explode(',',$myfields);
			$tarr = explode(',',$mytitles);
			foreach ($farr as $i=>$t) {
				if ($t=='id') {
					$type = 6;
					$edit = null;	
					$options = null;					    
				}
				elseif ($t=='code') {
					if ((($mode=='e') || ($mode=='r')) && ($editlink)) {//only edit/read mode
						$type = 'link';
						$edit = 6;			  
						$options = $editlink ;
					}
					else {
						$type = 6;
						$edit = 1;	
						$options = null;	
					}				
				}		   
				/*elseif (stristr($t,'active') || stristr($t,'search') || stristr($t,'view')) {
					$type = 'boolean';
					$edit = 1;
					$options = "1:0";
				}
				elseif (stristr($t,'cat')) {
					$type = 10;//'select';//if jqgrid is not paid, not applicable
					$edit = 1;
				}*/
				else {
					$type = 20;
					$edit = 1;
					$options = null; 
				}
				$title = $tarr[$i];//localize('_'.$t,getlocal());
				_m("mygrid.column use grid2+$t|".$title."|$type|$edit|$options");
			} 

			$out .= _m("mygrid.grid use grid2+ptags+$xsSQL+$mode+{$this->title}+id+$noctrl+1+$rows+$height+$width");			
		}  
		else 
		   $out .= 'Initialize jqgrid.';
	   
		return ($out);
	}	
  
	/*used by fast item insert cp*/
	public function add_tags_data($code=null,$title=null,$descr=null,$keywords=null) {
        if (!$code) return;
        $db = GetGlobal('db'); 
	    $lan = getlocal();
	    $itmkeywords = $lan ? 'keywords'.$lan : 'keywords0';
	    $itmdescr = $lan ? 'descr'.$lan : 'descr0'; 
        $itmtitle = $lan ? 'title'.$lan : 'title0';  
  
        $sSQL = "insert into ptags (code,tag,$itmkeywords,$itmdescr,$itmtitle) values (";
	    $sSQL .= $db->qstr($code).",".
	             $db->qstr($title).",".
				 $db->qstr($keywords).",".
				 $db->qstr($descr).",".
				 $db->qstr($title).
				 ")"; 
        //echo $sSQL;
		$result = $db->Execute($sSQL);
        return ($result);		
	}
  
};
}
?>