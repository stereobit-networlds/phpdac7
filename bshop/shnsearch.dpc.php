<?php

$__DPCSEC['SHNSEARCH_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ( (!defined("SHNSEARCH_DPC")) && (seclevel('SHNSEARCH_DPC',decode(GetSessionParam('UserSecID')))) ) {

define("SHNSEARCH_DPC",true);

$__DPC['SHNSEARCH_DPC'] = 'shnsearch';

$__EVENTS['SHNSEARCH_DPC'][0]='search';
$__EVENTS['SHNSEARCH_DPC'][1]='shsearch';
$__EVENTS['SHNSEARCH_DPC'][2]='shnsearch';
$__EVENTS['SHNSEARCH_DPC'][3]='addtocart';     //continue with ..cart
$__EVENTS['SHNSEARCH_DPC'][4]='removefromcart';//continue with ..cart
$__EVENTS['SHNSEARCH_DPC'][5]='searchtopic';
$__EVENTS['SHNSEARCH_DPC'][6]='filter';

$__ACTIONS['SHNSEARCH_DPC'][0]='search';
$__ACTIONS['SHNSEARCH_DPC'][1]='shsearch';
$__ACTIONS['SHNSEARCH_DPC'][2]='shnsearch';
$__ACTIONS['SHNSEARCH_DPC'][3]='addtocart';     //continue with ..from cart
$__ACTIONS['SHNSEARCH_DPC'][4]='removefromcart';//continue with ..from cart
$__ACTIONS['SHNSEARCH_DPC'][5]='searchtopic'; 
$__ACTIONS['SHNSEARCH_DPC'][6]='filter';

$__LOCALE['SHNSEARCH_DPC'][0]='SHNSEARCH_DPC;Search;Αναζήτηση';
$__LOCALE['SHNSEARCH_DPC'][1]='_SEARCHIN;Search In:;Αναζήτηση σε:';
$__LOCALE['SHNSEARCH_DPC'][2]='_founded;items found;εγγραφές βρέθηκαν';
$__LOCALE['SHNSEARCH_DPC'][3]='_FILTERS;Product filters;Φίλτρο αναζήτησης';
$__LOCALE['SHNSEARCH_DPC'][4]='_ALL;All;Όλα';
$__LOCALE['SHNSEARCH_DPC'][5]='_MSG3;Advance Search;Σύνθετη Αναζήτηση';
$__LOCALE['SHNSEARCH_DPC'][6]='_ASPHRASE;As a Phrase;Ως Φράση';
$__LOCALE['SHNSEARCH_DPC'][7]='_ANYTERMS;Any Terms;Κάποιο απο τα συνθετικά';
$__LOCALE['SHNSEARCH_DPC'][8]='_ALLTERMS;All Terms;Όλα τα συνθετικά';
$__LOCALE['SHNSEARCH_DPC'][9]='_SEARCHTYPE;Type;Τύπος';
$__LOCALE['SHNSEARCH_DPC'][10]='_CSENSE;Case Sensitive;Κεφαλαία/Μικρά';
$__LOCALE['SHNSEARCH_DPC'][11]='_TTIME;Total time;Συνολικός Χρόνος';
$__LOCALE['SHNSEARCH_DPC'][12]='_SEARCHR;Search Results;Αποτελέσματα Αναζήτησης';
$__LOCALE['SHNSEARCH_DPC'][13]='_SEARCH;Search;Αναζήτηση';
$__LOCALE['SHNSEARCH_DPC'][13]='_BRANDS;Brands;Κατασκευαστές';

class shnsearch {

    var $title, $msg;
	var $post, $result, $meter, $pager, $text2find;
	var $path, $urlpath, $inpath;
    var $imageclick, $attachsearch;

	public function __construct() {

		$this->title = localize('SHNSEARCH_DPC',getlocal());
		$this->path = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		$this->inpath = paramload('ID','hostinpath');			  
		
		$this->title = localize('SHNSEARCH_DPC',getlocal()); 
	  
		$this->imageclick = remote_paramload('SHNSEARCH','imageclick',$this->path);	  
		$this->attachsearch = remote_paramload('SHNSEARCH','attachsearch',$this->path);		  	

		$this->post = false;
		$this->msg = null;		  	 
	  
		$this->meter = 0; 
		$this->pager = 10;

		$this->text2find = GetParam('Input') ? GetParam('Input') : GetReq('input');			
		
		//on all pages
		$this->javascript();			
	}

	public function event($event=null) {

		switch ($event) {
		    //not used
			case 'filter'         :     $this->do_filter_search($this->text2find);
										break;		
										
			//cart
			case 'searchtopic'   :
			case 'addtocart'     :
			case 'removefromcart':		break;  
	  
			case 'search' 		 :	  
			default 			 : 		$this->search_javascript();
										$this->do_quick_search($this->text2find);
										//$this->do_search();//not used
		} 
	}


	public function action($action=null) {
	
		switch ($action) {
		  
			case 'filter'        : 	if ((GetReq('page'))  || (GetReq('asc')) || 
										(GetReq('order')) || (GetReq('pager'))) { //ajax
										if (_v('shkatalogmedia.filterajax'))
											die($this->form_search());
										else
											$out = $this->form_search();
									}
									else
										$out = $this->form_search();
									break;			  
	  
			//cart
			case 'searchtopic'   :
			case 'addtocart'     :
			case 'removefromcart':	break;	 
	  
			case 'search' 		 :		
			default       		 : 	if ((GetReq('page'))  || (GetReq('asc')) || 
										(GetReq('order')) || (GetReq('pager'))) { //ajax
										if (_v('shkatalogmedia.filterajax') && (!_v('shkatalogmedia.mobile')))
											die($this->form_search());
										else
											$out = $this->form_search();
									}
									else 	
										$out = $this->form_search();
		}	
	  
		return ($out);
	}
	
	public function javascript() {
		//$id = remote_paramload('SHKATEGORIES','idsearch',$this->path);	  
			
		$fid = _m('cmsrt.paramload use CMS+search-id');	
		$bid = _m('cmsrt.paramload use CMS+search-button-id');
			
		$code = $this->js_search_onclick($bid, $fid);	
			
		$js = new jscript;	
		$js->load_js($code,null,1);			   
		unset ($js);
	}	
	
	protected function js_search_onclick($buttonId=null, $inputId=null) {
	    $felement= $inputId ? $inputId : 'input';
		$belement= $buttonId ? $buttonId : 'search-button';
//$(document).ready(function () {		
//});
		$code = "
	$('#$belement').on('click',function(){
		var url = 'search/*/';
		var inp = document.getElementById('$felement').value;
		var ret = inp ? url.replace('*', inp) : url.replace('*/', '*/');
		//alert('search:'+ret);
		window.location.href = ret;
	});
";
      return ($code);	
	}	
	
	protected function search_javascript() {
		
		if (iniload('JAVASCRIPT')) {	
		
			$code2 = $this->js_make_search_url();
			
			$js = new jscript;	
			$js->load_js($code2,"",1);			   
			unset ($js);
		}			   	   	     
	}
	
	protected function js_make_search_url() {
		$mobileDevices = _m('cmsrt.mobileMatchDev');		
		$searchincat = _m('shkategories.getcurrentkategory');		
		
		$out = "
function get_sinput()
{
  var ret = document.searchform.input.value;
  return ret;
}
function get_scase()
{
  var ret = document.searchform.searchcase.value;
  return ret;
}
function get_stype()
{
  var ret = document.searchform.searchtype.value;
  return ret;
}

$(document).ready(function () {
	if (/{$mobileDevices}/i.test(navigator.userAgent)) 
		window.scrollTo(0,parseInt($('#section-{$searchincat}').offset().top, 10));
	else {
		gotoTop('section-{$searchincat}');

		$(window).scroll(function() { 
		
			if (agentDiv('category-grid',300)) {	
				$.ajax({ url: 'jsdialog.php?t=jsdcode&id=search&div=search', cache: false, success: function(jsdialog){
					eval(jsdialog);		
				}})	
			}
		});
	}		
});	
";

		return ($out);	
	}	
	
    public function form($entry="",$cmd=null,$message=null)  {
		$entry = GetParam('input');
		$this->scase = GetParam('searchcase') ? true : false;
		$this->stype = GetParam('searchtype') ? GetParam('searchtype') : null;
	  
		$mycmd = $cmd ? $cmd : 'search';
		$filename = _m("cmsrt.seturl use t=$mycmd+++1");  
		$lan = getlocal()?getlocal():'0';
	  
		//template form
		$contents = _m('cmsrt.select_template use searchform');	   

	    $tokens[] = $this->stime . $message;
	    $tokens[] = "<FORM name='searchform' action=". $filename . " method=POST>" . //post 
		            "<INPUT type=\"text\" name=\"input\" value=\"$entry\" size=25 class=\"myf_input\"  onfocus=\"this.style.backgroundColor='#F5F5F5'\" onblur=\"this.style.backgroundColor='#FFFFFF'\" style=\"background-color: rgb(255, 255, 255); \">"; 
						
        if ($this->stype) {
			switch ($this->stype) {
				case $this->anyterms   : $tokens[] = "<SELECT name=searchtype class=\"myf_select\"> <OPTION selected>$this->anyterms<OPTION>$this->allterms<OPTION>$this->asphrase</OPTION></SELECT>"; break;
				case $this->allterms   : $tokens[] = "<SELECT name=searchtype class=\"myf_select\"> <OPTION>$this->anyterms<OPTION selected>$this->allterms<OPTION>$this->asphrase</OPTION></SELECT>";break;
				case $this->asphrase   : 
				default                : $tokens[] = "<SELECT name=searchtype class=\"myf_select\"> <OPTION>$this->anyterms<OPTION>$this->allterms<OPTION selected>$this->asphrase</OPTION></SELECT>";break;
			}
	    }
	    else 
			$tokens[] = "<SELECT name=searchtype class=\"myf_select\"> <OPTION selected>$this->anyterms<OPTION>$this->allterms<OPTION>$this->asphrase</OPTION></SELECT>";					
  
        $check = $this->scase ? "checked" : "";
        $tokens[] = "<input type=\"hidden\" name=\"searchcase\" value=\"$check \"". $check . " class=\"myf_input\"  onfocus=\"this.style.backgroundColor='#F5F5F5'\" onblur=\"this.style.backgroundColor='#FFFFFF'\" style=\"background-color: rgb(255, 255, 255); \">";		   
		$tokens[] = "<input type=\"submit\" name=\"Submit\" class=\"myf_button\" value=\"$this->t_searchtitle\">" .
                    "<input type=\"hidden\" name=\"FormAction\" value=\"$mycmd\">" .
                    "</FORM>";		
		
		//search in cat form			
        $tokens[] = $this->searchin();							
	      
		$tokout = $this->combine_tokens($contents, $tokens);
		return ($tokout);    
    }		
	
	public function form_search() {
		$typos = trim(GetParam('typos'));	
		$extras = trim(GetParam('extras'));
		$price = trim(GetParam('price'));
		$price2 = trim(GetParam('price2'));	   
		$this->msg = null;
	      
		$out = $this->form(null,'search',$msg);
	   
		$out .= $this->search_categories($this->text2find,'searchcatres');
		
		$out .= $this->list_katalog(0,'search&input='.$this->text2find);//,'searchres'); //use fpkatalog default
	  
	    $f1 = _v('shkatalogmedia.max_selection');	    
	    $f2 = _v('shkategories.max_selection');	   	
		$f = $f1+$f2;	  
		
		return ($out);	
	}	
	
	protected function do_search() {
		$db = GetGlobal('db');	
		$page = GetReq('page')?GetReq('page'):0;	  
		$asc = GetReq('asc');
		$order = GetReq('order');		
		$lan = getlocal();
		$mylan = $lan ? $lan : '0';
		$itmname = $mylan ? 'itmname' : 'itmfname';
		$itmdescr = $mylan ? 'itmdescr' : 'itmfdescr';			    
	  
		if (GetReq('cat')!=null)
			$cat = GetReq('cat');	  
	  
		$dataerror = null;
	 
		if (empty($_POST)) return -1;  
	  
		if (isset($cat) || isset($marka) || isset($typos) || 
			isset($color) || isset($pdate) || isset($extras) || isset($price) || isset($price2)) {
				
			$code = _m('shkatalogmedia.getmapf use code');
			$sSQL = _v('shkatalogmedia.selectSQL');
		  
			if ($id_cat>=0) {
				$sSQL .= " WHERE ";		
		
				$cat_tree = explode('^',str_replace('_',' ',$cat)); 
			
				//$whereClause .= '( cat0=' . $db->qstr(str_replace('_',' ',$cat_tree[0]));		  
				if ($cat_tree[0])
					$whereClause .= ' cat1=' . $db->qstr(rawurldecode(str_replace('_',' ',$cat_tree[0])));		  
				if ($cat_tree[1])	
					$whereClause .= 'and cat2=' . $db->qstr(rawurldecode(str_replace('_',' ',$cat_tree[1])));		 
				if ($cat_tree[2])	
					$whereClause .= 'and cat3=' . $db->qstr(rawurldecode(str_replace('_',' ',$cat_tree[2])));		   
				if ($cat_tree[3])	
					$whereClause .= 'and cat4=' . $db->qstr(rawurldecode(str_replace('_',' ',$cat_tree[3])));
			
				$sSQL .= $whereClause;				  
		  	  		  	  
			}
		
			$sSQL .= " and itmactive>0 and active>0";					
			$sSQL .= ' ORDER BY';
		  
			switch ($order) {
				case 1  : $sSQL .=  ' '.$itmname.','.$itmdescr; break;
				case 2  : $sSQL .= ' price0';break;  
				case 3  : $sSQL .= ' '. _m('shkatalogmedia.getmapf use code'); break;//must be converted to the text equal????
				case 4  : $sSQL .= ' cat1';break;			
				case 5  : $sSQL .= ' cat2';break;
				case 6  : $sSQL .= ' cat3';break;			
				case 9  : $sSQL .= ' cat4';break;						
				default : $sSQL .=  ' '.$itmname.','.$itmdescr;
			}
		  
			switch ($asc) {
				case 1  : $sSQL .= ' ASC'; break;
				case 2  : $sSQL .= ' DESC';break;
				default : $sSQL .= ' ASC';
			}
		  
			if ($this->pager) {
				$p = $page * $this->pager;
				$sSQL .= " LIMIT $p,".$this->pager; //page element count
			}	
		
			//echo $sSQL;
			if ($dataerror==null) {
				$resultset = $db->Execute($sSQL,2);
				$ret = $db->fetch_array_all($resultset);	 
	   	   
				$this->result = $ret; 
				$this->meter = $db->Affected_Rows();
				$this->msg = $this->meter . ' ' . localize('_founded',getlocal());																		
			}
			else
				$this->msg = $dataerror;		
		
		} 
	}		

	public function show_combo($title=null,$preselcat=null,$isleaf=null) {

        $ret = _m('shkategories.show_combo_results use '.$title.'+'.$preselcat.'+'.$isleaf);
		return ($ret);
	}		
	
	protected function do_quick_search($text2find) {
	
		_m('shkatalogmedia.do_quick_search use '.$text2find);
		_m('shkatalogmedia.javascript');		  
	}
	
	protected function do_filter_search($filter) {
	
		 _m('shkatalogmedia.do_filter_search use '.$filter);
	}	
	
	protected function search_categories($text2find=null,$template=null) {
		
        $ret = _m('shkategories.search_tree use ' . $text2find ."+klist+".$template);//klist or seach in cat,= +search
			  
		return ($ret);	  
	}		
	
	protected function list_katalog($imageclick=null,$cmd=null,$template=null) {
		
		$ret = _m('shkatalogmedia.list_katalog use '.$imageclick.'+'.$cmd.'+'.$template);

		return ($ret);	  
	}		
	
	public function searchin($staticmenu=0) {
	
        $ret = _m('shkategories.show_combo_results use '.$title.'+++search');
		
		return ($ret);
	}	
	
    public function findsql($terms, $fields2searchin, $stype=null, $scase=null) {
		$st = $stype ? $stype : $this->stype;
		$sc = $scase ? $scase : $this->scase;
		$extra_sql = null;
		 
		$fields = unserialize($fields2searchin); 		 
		 
		if (!empty($fields)) {	
	  
			$extra_codes = (array) $this->search_attachments($terms);
		   	   
			if (!empty($extra_codes)) {
				foreach ($extra_codes as $i=>$c) 
					$codesql[] = ' code3="'.$c.'"';
		   
				$extra_sql = ' or (';
				$extra_sql .= implode (' or ',$codesql); 
				$extra_sql .= ') ';
			}
   
		  
			switch ($st) {

				case $this->allterms : // AND
										$ret .= $this->mysql_AND($terms,$fields,$sc); 		
										break;
				case $this->asphrase : // AS IS
										$ret .= $this->mysql_ASIS($terms,$fields,$sc); 							
										break;																														  
				case $this->anyterms : // OR
				default              :		   
										$ret .= $this->mysql_OR($terms,$fields,$sc);
										break;								  
			}
		 
			if ($extra_sql) 
				$ret .= $extra_sql;
 	
			return ($ret);
		}//empty array

	    return null;	
	}
    
    ////////////////////////////////////////////////////////
    // this return true if all array of terms is in text
    ////////////////////////////////////////////////////////
    protected function mysql_AND($terms,$fields,$csence) {
	
		$words = explode (" ", $terms);	
		reset($fields);	  
	  
		foreach ($fields as $fid=>$fieldname) {
			reset($words);
			foreach ($words as $word_no => $word) {		
				if ($csence) 			  
					$data[$word_no] = $fieldname . " like '%" . $word . "%'"; 
				else
					$data[$word_no] = '(' . $fieldname . " like '%" . strtolower($word) . "%' OR " . $fieldname . " like '%" . strtoupper($word) . "%')"; 	
			}
		
			$data2[$fid] = '(' . implode(' AND ',$data) . ')';
		}
	  
		$ret = '(' . implode(' OR ',$data2) . ')';
	  
		return $ret;
    }

    ////////////////////////////////////////////////////////
    // this return true if one term of terms is in text
    ////////////////////////////////////////////////////////
    protected function mysql_OR($terms,$fields,$csence) {
	
		$words = explode (" ", $terms);	
		reset($words);  

		foreach ($words as $word_no => $word) {
			reset($fields);	  
			foreach ($fields as $fid=>$fieldname) {
				if ($csence) 		  
					$data[$fid] = $fieldname . " like '%" . $word . "%'";
				else	
					$data[$fid] = '(' . $fieldname . " like '%" . strtolower($word) . "%' OR " . $fieldname . " like '%" . strtoupper($word) . "%')";
			}
		
			$data2[$word_no] = '(' . implode(' OR ',$data) . ')';	
		}
  
		$ret = '(' . implode(' OR ',$data2) . ')';
   
		return ($ret);
    }

    ////////////////////////////////////////////////////////
    // this return true if one terms=text is in text as is
    ////////////////////////////////////////////////////////
    protected function mysql_ASIS($terms,$fields,$csence) {

		foreach ($fields as $fid=>$fieldname) {
		  
			if ($csence)  
				$data[] = $fieldname . " like '%" . $terms . "%'";
			else
				$data[] = '(' . $fieldname . " like '%" . strtolower($terms) . "%' OR " . $fieldname . " like '%" . strtoupper($terms) . "%')";
		  
		}	  
  
		$ret = '(' . implode(' OR ',$data) . ')';
    
		return $ret;
    }  
	
	protected function search_attachments($terms=null) {
		$db = GetGlobal('db');	
		$lan = getlocal();
	
		if (!$this->attachsearch) 
			return array();
	  
		$sSQL = "select code from pattachments";	
		$sSQL .= " where lan=" . $lan;
		$sSQL .= " and data LIKE '%$terms%'";
		//echo $sSQL;	  
	  
		$result = $db->Execute($sSQL,2); 
	  
		if (empty($result))
			return array();
		
		foreach ($result as $n=>$rec)   
			$ret[$rec[0]] = $rec[0];

		return ($ret);	
	}	
	
	
	//FILTERS
	protected function filter($field=null, $template=null, $incategory=null, $cmd=null, $head=null) {	
		if (!$field) return;
	    $db = GetGlobal('db');		
        $filename = _m("cmsrt.seturl use t=$mycmd+++1"); 
	    $lan = getlocal()?getlocal():'0';
		$command = $cmd ? $cmd : 'search';
		$tokens = array(); 
		$r = array();		
	  
		$contents = _m("cmsrt.select_template use searchfilter");	
		
	    $sSQL = "SELECT DISTINCT ".$field.",count(id) from products WHERE ";			
        if ($incategory) {	
		    $csep = _v('shkategories.cseparator');
		    $cats = explode($csep, GetReq('cat'));
			
		    foreach ($cats as $c=>$mycat) {
				$_c = _m('shkategories.replace_spchars use '. $mycat . '+1');
				$s[] = 'cat'.$c ." ='" . $_c . "'";		  	  
			}	
		}		

		$sSQL .= implode(" AND ", $s);
		$sSQL .= " and itmactive>0 and active>0";
		$sSQL .= " group by " . $field;  
	  
		$result = $db->Execute($sSQL,2); 
	  
		if (!empty($result)) {

			foreach ($result as $n=>$t) {
				if (trim($t[0])!='') {
					$tokens[] = $t[0];
					$tokens[] = $t[1];
					$tokens[] = _m("cmsrt.url use t=$command&input=" . $t[0] . "cat=$cat" . GetReq('cat')); 
					$tokens[] = ($t[0]==GetReq('input')) ? 'checked="checked"' : null;
					$r[] = $template ? $this->combine_tokens($contents,$tokens) : $rec;	
					unset($tokens);		
                }				
			}	
		}
		
					
		//header
        if ($header) {		
			$tokens[] = localize('_ALL',getlocal());
			$tokens[] = '*';
			$tokens[] = _m("cmsrt.url use t=klist&cat=" . GetReq('cat'));
			$tokens[] = (!GetReq('input')) ? 'checked="checked"' : null;
			if ($template) $r[] = $this->combine_tokens($contents,$tokens);
			unset($tokens);
		}		
       
		$ret = (empty($r)) ? null : implode('',$r);	
		return ($ret);   
	}
	
	public function combine_tokens(&$template_contents,$tokens, $execafter=null) {
	
	    if (!is_array($tokens)) return;
		
		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
			$fp = new fronthtmlpage(null);
			$ret = $fp->process_commands($template_contents);
			unset ($fp);		  		
		}		  		
		else
			$ret = $template_contents;
		  
	    foreach ($tokens as $i=>$tok) {
		    $ret = str_replace("$".$i."$",$tok,$ret);
	    }
		//clean unused token marks
		for ($x=$i;$x<20;$x++)
			$ret = str_replace("$".$x."$",'',$ret);
		
		//execute after replace tokens
		if (($execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
			$fp = new fronthtmlpage(null);
			$retout = $fp->process_commands($ret);
			unset ($fp);
          
			return ($retout);
		}		
		
		return ($ret);
	}		
};
}
?>