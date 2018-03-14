<?php
$__DPCSEC['SHSEARCH_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ( (!defined("SHSEARCH_DPC")) && (seclevel('SHSEARCH_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("SHSEARCH_DPC",true);

$__DPC['SHSEARCH_DPC'] = 'shsearch';

$d = GetGlobal('controller')->require_dpc('bshop/search.dpc.php');
require_once($d);

$__EVENTS['SHSEARCH_DPC'][0]='search';
$__EVENTS['SHSEARCH_DPC'][1]='addtocart';     //continue with ..cart
$__EVENTS['SHSEARCH_DPC'][2]='removefromcart';//continue with ..cart
$__EVENTS['SHSEARCH_DPC'][3]='searchtopic';   //continue with ..browser

$__ACTIONS['SHSEARCH_DPC'][0]='search';
$__ACTIONS['SHSEARCH_DPC'][1]='addtocart';     //continue with ..from cart
$__ACTIONS['SHSEARCH_DPC'][2]='removefromcart';//continue with ..from cart
$__ACTIONS['SHSEARCH_DPC'][3]='searchtopic';   //continue with ..from browser

$__LOCALE['SHSEARCH_DPC'][0]='SHSEARCH_DPC;Search;Αναζήτηση';
$__LOCALE['SHSEARCH_DPC'][1]='_founded;found;εγγραφές βρέθηκαν';
$__LOCALE['SHSEARCH_DPC'][2]='SEARCH_DPC;Search;Αναζήτηση';
$__LOCALE['SHSEARCH_DPC'][3]='_MSG3;Advance Search;Σύνθετη Αναζήτηση';
$__LOCALE['SHSEARCH_DPC'][4]='_ASPHRASE;As a Phrase;Ως Φράση';
$__LOCALE['SHSEARCH_DPC'][5]='_ANYTERMS;Any Terms;Κάποιο απο τα συνθετικά';
$__LOCALE['SHSEARCH_DPC'][6]='_ALLTERMS;All Terms;Όλα τα συνθετικά';
$__LOCALE['SHSEARCH_DPC'][7]='_SEARCHTYPE;Type;Τύπος';
$__LOCALE['SHSEARCH_DPC'][8]='_CSENSE;Case Sensitive;Κεφαλαία/Μικρά';
$__LOCALE['SHSEARCH_DPC'][9]='_TTIME;Total time;Συνολικός Χρόνος';
$__LOCALE['SHSEARCH_DPC'][10]='_SEARCHR;Search Results;Αποτελέσματα Αναζήτησης';
$__LOCALE['SHSEARCH_DPC'][11]='_SEARCH;Search;Αναζήτηση';
$__LOCALE['SHSEARCH_DPC'][12]='_ALL;All;Σε Όλα;';

class shsearch extends search {

    var $title,$msg;
	var $queuelist;
	var $post,$result,$meter,$pager,$text2find;
	var $path, $urlpath, $inpath;

	public function __construct() {
	
	  search::__construct();	
	
	  $this->urlpath = paramload('SHELL','urlpath');
	  $this->inpath = paramload('ID','hostinpath');		
	  	
      $this->title = localize('SHSEARCH_DPC',getlocal());
	  $this->path = paramload('SHELL','prpath');	  
	  $this->post = false;
	  $this->msg = null;		  	 
	  
	  $this->meter = 0; 
	  $this->pager = 10;
	
	  $this->path = paramload('SHELL','prpath');	
	  $this->text2find = GetParam('Input');	 
	  $this->imageclick = remote_paramload('SHSEARCH','imageclick',$this->path);	     
	}
	
	public function event($event=null) {
	
	  $this->text2find = GetParam('Input')?GetParam('Input'):GetReq('input');  
	
		switch ($event) {
	  
			//cart
			case 'searchtopic'   :
			case 'addtocart'     :
			case 'removefromcart':			  
	  
			case 'search' 		:
			default       		: 	if ($this->text2find)
										$this->do_quick_search($this->text2find,$marka2find);
									else
										$this->do_search();
	  }
	}
	
	public function action($action=null) {
	
		switch ($action) {
	  
			//cart
			case 'searchtopic'   :
			case 'addtocart'     :
			case 'removefromcart':		 
	  
			case 'search' :
			default       : $out = $this->form_search();
		}	
	  
		return ($out);
	}
	
	public function form_search() {
		$typos = trim(GetParam('typos'));	
		$extras = trim(GetParam('extras'));
		$price = trim(GetParam('price'));
		$price2 = trim(GetParam('price2'));	   
	   
		//KATEGORIES SEARCH
		$out .= $this->search_categories($this->text2find);
	   
		$this->msg = null;//reset not to re-show in list_vehicles functions
		//$out .= $this->msg;
	   
		$myimageclick = $this->imageclick ? $this->imageclick : null;
 	   
		$out .= $this->list_katalog($myimageclick,'search&input='.$this->text2find);
		if ($this->meter) $out .= "<hr>";
	   
		$out .= $this->form(null,'search');
	   
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
			//if ($this->check_fields()===true) return; 	  
	  
		if (isset($cat) || isset($marka) || isset($typos) || 
			isset($color) || isset($pdate) || isset($extras) || isset($price) || isset($price2)) {
				
			$code = _m('shkatalogmedia.getmapf use code');
			$sSQL = "select id,sysins,code1,pricepc,price2,sysins,itmname,uniname1,uniname2,active,code4," .// from abcproducts";// .
					"price0,price1,cat0,cat1,cat2,cat3,cat4,itmremark,ypoloipo1,".$code." from products ";
		  
			//$id_cat = (int) get_selected_id_fromfile($cat,'kategories',0);
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
	
	protected function do_quick_search($text2find,$comboselection=null) {
	
		if (defined("SHKATALOGMEDIA_DPC"))
            _m('shkatalogmedia.do_quick_search use '.$text2find.'+'.$comboselection);
			  
	}
	
	protected function search_categories($text2find=null,$template=null) {
	
		if (defined("SHKATEGORIES_DPC"))			
            $ret = _m('shkategories.search_tree use ' . $text2find ."+search&searchtype=$this->asphrase&input=".$text2find.'+'.$template);//klist or seach in cat,= +search
			  
		return ($ret);	  
	}
	
	protected function list_katalog($imageclick=null,$cmd=null) {
	
		if (defined("SHKATALOGMEDIA_DPC"))
            $ret = _m('shkatalogmedia.list_katalog use '.$imageclick.'+'.$cmd);
			  
		return ($ret);	  
	}	
	
	//override
    public function form($entry="",$cmd=null)  {
		$mycmd = $cmd ? $cmd : 'search';
		$filename = seturl("t=$mycmd");  
		$lan = getlocal()?getlocal():'0';
	  
	    $contents = _m('cmsrt.select_template use searchform');    

	    $tokens[] = $this->stime;
	    $tokens[] = "<FORM action=". $filename . " method=post>" . 
		            "<INPUT type=\"text\" name=\"input\" value=\"$entry\" size=25>"; 
					
					
        if ($this->stype) {
			switch ($this->stype) {
				case $this->anyterms   : $tokens[] = "<SELECT name=searchtype> <OPTION selected>$this->anyterms<OPTION>$this->allterms<OPTION>$this->asphrase</OPTION></SELECT>"; break;
				case $this->allterms   : $tokens[] = "<SELECT name=searchtype> <OPTION>$this->anyterms<OPTION selected>$this->allterms<OPTION>$this->asphrase</OPTION></SELECT>";break;
				case $this->asphrase   : $tokens[] = "<SELECT name=searchtype> <OPTION>$this->anyterms<OPTION>$this->allterms<OPTION selected>$this->asphrase</OPTION></SELECT>";break;
			}
	    }
	    else
		   $tokens[] = "<SELECT name=searchtype> <OPTION>$this->anyterms<OPTION>$this->allterms<OPTION selected>$this->asphrase</OPTION></SELECT>";					
		   
        if ($this->scase) $check = "checked"; else $check = "";
        $tokens[] = "<input type=\"checkbox\" name=\"searchcase\" value=\"$check \"". $check . ">";		   
		
        $tokens[] = $this->searchin();
		
		$tokens[] = "<input type=\"submit\" name=\"Submit\" value=\"$this->t_searchtitle\">" .
                    "<input type=\"hidden\" name=\"FormAction\" value=\"$mycmd\">" .
                    "</FORM>";				
		 	      
		$tokout = $this->combine_tokens($contents,$tokens);
		return ($tokout);    
    }	
	
	//tokens method
	protected function combine_tokens(&$template_contents,$tokens) {
	
	    if (!is_array($tokens)) return;
		
		if (defined('FRONTHTMLPAGE_DPC')) {
		  $fp = new fronthtmlpage(null);
		  $ret = $fp->process_commands($template_contents);
		  unset ($fp);		  		
		}		  		
		else
		  $ret = $template_contents;
		  
	    foreach ($tokens as $i=>$tok) {
		    $ret = str_replace("$".$i,$tok,$ret);
	    }
		//clean unused token marks
		for ($x=$i;$x<10;$x++)
		  $ret = str_replace('$'.$x,'',$ret);

		return ($ret);
	} 			
};
}	
?>