<?php
$__DPCSEC['SHTAGS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if (!defined("SHTAGS_DPC")) {
define("SHTAGS_DPC",true);

$__DPC['SHTAGS_DPC'] = 'shtags';
 
$__EVENTS['SHTAGS_DPC'][0]='cpshtags';
$__EVENTS['SHTAGS_DPC'][1]='kshow';
$__EVENTS['SHTAGS_DPC'][2]='klist';
$__EVENTS['SHTAGS_DPC'][3]='products';
$__EVENTS['SHTAGS_DPC'][4]='product';
$__EVENTS['SHTAGS_DPC'][5]='search';
$__EVENTS['SHTAGS_DPC'][6]='kfilter';

$__ACTIONS['SHTAGS_DPC'][0]='cpshtags';
$__ACTIONS['SHTAGS_DPC'][1]='kshow';
$__ACTIONS['SHTAGS_DPC'][2]='klist';
$__ACTIONS['SHTAGS_DPC'][3]='products';
$__ACTIONS['SHTAGS_DPC'][4]='product';
$__ACTIONS['SHTAGS_DPC'][5]='search';
$__ACTIONS['SHTAGS_DPC'][6]='kfilter';

$__DPCATTR['SHTAGS_DPC']['cpshtags'] = 'cpshtags,1,0,0,0,0,0,0,0,1,1,1,1';

$__LOCALE['SHTAGS_DPC'][0]='SHTAGS_DPC;Tags;Tags';
$__LOCALE['SHTAGS_DPC'][1]='_TAG;Tag;Tag';
$__LOCALE['SHTAGS_DPC'][2]='_searchall;Search;Αναζήτηση';
$__LOCALE['SHTAGS_DPC'][3]='manufacturer;manufacturer;κατασκευαστής';
$__LOCALE['SHTAGS_DPC'][4]='color;color;χρώμα';
$__LOCALE['SHTAGS_DPC'][5]='colors;colors;χρώματα';
$__LOCALE['SHTAGS_DPC'][6]='price-min;minimum price;μικρότερη τιμή';
$__LOCALE['SHTAGS_DPC'][7]='price-max;maximum priceh;μεγιστη τιμή';
$__LOCALE['SHTAGS_DPC'][8]='size;size;μέγεθος';
$__LOCALE['SHTAGS_DPC'][9]='dimension;dimension;διάσταση';
$__LOCALE['SHTAGS_DPC'][10]='search;search;αναζήτηση';
$__LOCALE['SHTAGS_DPC'][11]='_TAGS;Tags;Tags';

class shtags {

   var $result, $zeroprice_msg;
   var $default_tag;
   var $meta_file, $default_meta_file;
   var $prpath;
   var $item,$descr,$price,$keywords;
   var $metadb, $tagcat, $tagid;
   var $cseparator, $replacepolicy, $reset_input;
   
   var $tmpl_path, $tmpl_name;   
   
   var $shclass;

    function __construct() {
   
		$this->prpath = paramload('SHELL','prpath');
   
		$this->default_tag = paramload('SHTAGS','tags');//"vehicles, sales, cars, motorcycles";
	 
		$mf = remote_paramload('SHTAGS','metafile',$this->prpath);
		$this->meta_file = $mf ? $mf : 'meta.txt'; 
	 
		$df = remote_paramload('SHTAGS','defmetafile',$this->prpath);
		$this->default_meta_file = $df?$df:'metad.txt'; 

		$this->metadb = remote_paramload('SHTAGS','metadb',$this->prpath); 
		$this->tagcat = GetReq('cat'); //holds category tag ..default val
		$this->tagitem = GetReq('id');  //holds item tag	 
	 	 
		//read at init if there is tags in url...???
		//$this->save_global_tag_vars();

		$this->replacepolicy = remote_paramload('SHKATEGORIES','replacechar',$this->prpath);	 
		$csep = remote_paramload('SHKATEGORIES','csep',$this->prpath); 
		$this->cseparator = $csep ? $csep : '^';	

		$this->tmpl_path = remote_paramload('FRONTHTMLPAGE','path',$this->prpath);
		$this->tmpl_name = remote_paramload('FRONTHTMLPAGE','template',$this->prpath); 

		$this->maintitle = remote_paramload('INDEX','title', $this->prpath);
		$this->maindescr = remote_paramload('INDEX','meta-description', $this->prpath);	
		$this->mainkeys = remote_paramload('INDEX','meta-keywords', $this->prpath);	

		$this->use_canonical_for_filters = _m('cmsrt.paramload use ESHOP+canonicalfilter') ?: false; //else use category for rel
		$this->reset_input = array();	
		
		$this->shclass = defined('SHKATALOGMEDIA_DPC') ? 'shkatalogmedia' : 'shkatalog';
    }

	public function event($event=null) {
	
	    switch ($event) {
			
			case 'search'      :
			case 'kfilter'     :    //$this->get_filter_info();
									//$this->get_tag_info();
									//break;
			
			case 'product'     : 		
			case 'kshow'       :    

			case 'products'    :			
			case 'klist'       : 	
			default            :	///if ($this->metadb) {
										$this->get_tag_info(); 
									//}  
									//else //default ..from categories,products table
										//$this->get_data_info();
		}							
	}
   
	public function action($act=null) {

	}
	
	//h1 seo header	
	public function showH1($text=null) {
		if (!$text) return null;
		$ret = '<h1>' . $text . '</h1>';
		
		return ($ret);
	}	
	
	//call at tag rel=canonical at index file
	//must return the canonical (klist/kshow) url, not the alias !!	
	//use instead of cmsrt/version
	public function urlCanonical() {
		$httpurl = _v('cmsrt.httpurl');
		$aliasID = _v('cmsrt.userUrlAlias');
		$klistcmd = _v('cmsrt.klistcmd');
		$kshowcmd = _v('cmsrt.kshowcmd');
		$cat = GetReq('cat');
		$id = GetReq('id');	
		$t = GetReq('t');
		

				switch ($t) {
					
					case 'product' :
					case 'kshow'   :
					case $kshowcmd : if ($aliasID)
										$ret = $httpurl . "/$kshowcmd/$cat/". $this->getRealItemCode($id, $aliasID) ."/";
									 else
										$ret = $httpurl . "/$kshowcmd/$cat/$id/";
									 break;
									 
					case 'kfilter' : if ($this->use_canonical_for_filters) {
						
										$filter = implode(',', $this->reset_input);
										$ret = $httpurl . "/kfilter/$cat/$filter/";
										
										break;									 
					                 }//else continue to use klist/products as canonical url
					case 'products':
					case 'klist'   :
					case $klistcmd : $ret = $httpurl . "/".$klistcmd."/$cat/"; 
									 break;
					
					default 	   : $ret = $httpurl . _m('cmsrt.php_self');
				}			
		
		return $ret;
	}		
	
	protected function readfilter() {
		$input = GetReq('input');
		$out = array();
		$priceSQL = null;
		$_all = _v($this->shclass . '._catAllFilter');	
		if (!$input) return false;	
		
		if (strstr($input, ',')) {
			//multiple values
			$fltvalue = null;
			$fl = explode(',', $input);
			foreach ($fl as $feaf) {
				if (strstr($feaf, ':')) {
					$_hv = explode(':', $feaf);
					$fltname = $_hv[0];
					$fltvalue = $this->replace_spchars($_hv[1],1);
					
					$out[$fltname] = $fltvalue;  
				}
				elseif (strstr($feaf, '.')) {
					$_prices = explode('.', $feaf);
							
					$out['price-min'] = $_prices[0];	
					$out['price-max'] = $_prices[1];					
				}
				else//if ($feaf) 
					$out['search'] = $feaf;
					
				$this->reset_input[] = $feaf;	
			}
		}
		elseif ($input) {//single value
			if (strstr($input, ':')) { //single pair value
				$_hv = explode(':', $input);
				$fltname = $_hv[0];
				$fltvalue = $this->replace_spchars($_hv[1],1);
					
				$out[$fltname] = $input;
			}
			elseif (strstr($input, '.')) {//if (is_numeric($input)) { //single numeric value (slider values)
				$_prices = explode('.', $input);
				
				$out['price-min'] = $_prices[0];	
				$out['price-max'] = $_prices[1];				 
			}			
			elseif ($input!=$_all) //non * single searchable value (save-reset except * from categories)
				$out['search'] = $input;
				
			$this->reset_input[] = $input;				
        }		

		return ($out);	
	}	
	
	public function get_filter_info() {
		$item = GetReq('id');	
		$cat = GetReq('cat');
	    $lan = getlocal();	
		$_all = _v($this->shclass . '._catAllFilter');			
		
		if ($data = $this->readfilter()) {
			print_r($data);
			return true;
		}	
		
/*		foreach ($data as $f=>$v) {
			$_fdata .= ' '. localize($f, $lan) .' '. $v;  
		}	
		
		if ($cat!=$_all) { // && (strstr($input, $this->cseparator))
			$cc = explode($this->cseparator, $cat);
			$xcat = array_pop($cc);
			$this->item =  $this->replace_spchars($xcat,1);
		}
		else 
			$this->item =   localize('_searchall', $lan);
		
		$this->descr = $this->item . $_fdata;
		$this->price = null; //$data['price-min'] !! -max
		$this->keywords = str_replace(',,',',', str_replace(' ',',',$this->item . $_fdata));	*/	
		
		return false;
	}
   
	public function get_category_info() {
		$cat = GetReq('cat');
   
		if ($cat) {
			$mycat = $this->replace_spchars($cat,1);
				
			if (defined("RCCATEGORIES_DPC")) {
				$cstring = explode($this->cseparator,$mycat);
			}
			elseif (defined("RCKATEGORIES_DPC")) {	
				$cstring = rawurldecode(explode($this->cseparator,$mycat));	   	        
			}
			$ret = (!empty($cstring)) ? implode(',',$cstring) : null;

			return ($ret); 	   
		}  
		
		return false;
	}
   
    public function get_data_info() {
		$item = GetReq('id');	
		$cat = GetReq('cat');
	    $lan = getlocal();
	    $itmname = $lan?'itmname':'itmfname';
	    $itmdescr = $lan?'itmdescr':'itmfdescr';
		$_all = _v($this->shclass . '._catAllFilter');	

		//$cc =null;	
		$_cc = null;
		//$rec = null;
		$fcat = null;
		
		if ($data = $this->readfilter()) {
			
			foreach ($data as $f=>$v) {
				$_fdata .= ' '. localize($f, $lan) .' '. $v;  
			}	
		
			if ($cat != $_all) { // && (strstr($input, $this->cseparator))
				$cc = explode($this->cseparator, $cat);
				$xcat = array_pop($cc);
				$this->item =  $this->replace_spchars($xcat,1);
			}
			else 
				$this->item =   localize('_searchall', $lan);
		
			$this->descr = $this->item . $_fdata;
			$this->price = null; //$data['price-min'] !! -max
			$this->keywords = str_replace(',,',',', str_replace(' ',',',$this->item . $_fdata));				
		}	
	    elseif ($item) { 
 
			$this->result = _v($this->shclass . ".result");
			$ppol = _m($this->shclass . ".read_policy");
			//print_r($this->result);		
		
			$this->item = $this->result->fields[$itmname];
			$this->descr = $this->result->fields[$itmdescr];
			$this->price = $this->result->fields[$ppol];
			$this->keywords = str_replace(',,',',', str_replace(' ',',',$this->item));
		}
		elseif ($cat) {//echo 'z'; print_r($mytree);
			//$cc = explode($this->cseparator, $cat);
			$fcat = _m('shkategories.getkategories use '. $cat);
			$_cc = explode($this->cseparator, $fcat);
			//print_r($_cc);
			$xcat = array_pop($_cc); //$cc);
			//echo $xcat;
			$this->item = $xcat; //$this->replace_spchars($xcat,1);
			$this->descr = $this->item;
			$this->price = null;
			$this->keywords = str_replace(',,',',', str_replace(' ',',', $this->item));		
		}
        else { //front page
		
			$this->item = null;//localize(GetReq('t'), getlocal());
			$this->descr = remote_paramload('INDEX','meta-description', $this->prpath);
			$this->price = null;
			$this->keywords = remote_paramload('INDEX','meta-keywords', $this->prpath);			
        }		
		
		
	    $ret = $this->item . ", " . 
		       $this->descr . ", " . 
			   $this->keywords;
		
	    //echo 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz';
        $this->page_tags = $ret;
		return ($ret);
    }
	
	public function pageTags($part=null) {

        if ($part) {
			$p = explode(', ', $this->page_tags);
			return ($p[$part-1]); //0,1,2 of array
		}		
	   
		return $this->page_tags;
	}	

    public function get_page_info($key=null,$defkey=null) {
		//echo '>'.$this->{$key};
		$meta_title = ($defkey=='NULL') ? null : ((isset($defkey)) ? $defkey : $this->maintitle);
		$meta_descr = ($defkey=='NULL') ? null : ((isset($defkey)) ? $defkey : $this->maindescr);
		$meta_keywords = ($defkey=='NULL') ? null : ((isset($defkey)) ? $defkey : $this->mainkeys);			
   	   
		//echo $this->item,'>',$key;
		if ($key=='item') 
			return ($this->item ? $this->item :$meta_title);	 
		elseif ($key=='descr')
			return ($this->descr ? $this->descr :$meta_descr);	
		elseif ($key=='keywords')
			return ($this->keywords ? $this->keywords :$meta_keywords);
		elseif ($key=='tag')
			return ($this->itmtag ? $this->itmtag :null);			 
		else 
			return ($this->page_tags);
    }
   
    public function get_tag_info() {
        $db = GetGlobal('db');
		$item = GetReq('id');	

		$cat = GetReq('cat');
	    $lan = getlocal();
	    $itmkeywords = $lan?'keywords'.$lan:'keywords0';
	    $itmdescr = $lan?'descr'.$lan:'descr0';  
		$itmtitle = $lan?'title'.$lan:'title0';
		$_all = _v($this->shclass . '._catAllFilter');				

        $code = $item ? _v($this->shclass . '.realID') : (($cat!=$_all) ? $cat : null);		
		
		if ($code) {
			$sSQL = "select code,tag,$itmkeywords,$itmdescr,$itmtitle from ptags ";
			$sSQL .= " WHERE code='" . $code . "'";
			//echo $code;
		
			$resultset = $db->Execute($sSQL,2);	
			$result = $resultset;		
		
			if ($itmcode = $result->fields[0]) { 
				//echo $sSQL;	
				
				if ($data = $this->readfilter()) {
					
					foreach ($data as $f=>$v) {
						$_fdata .= ' '. localize($f, $lan) .' '. $v;  
					}	
		
					$this->itmcode = $itmcode; 
					$this->itmtag = $result->fields[1];		
					$this->keywords = str_replace(',,',',', str_replace(' ',',',$result->fields[2] . $_fdata));			
					$this->descr = $result->fields[3] . $_fdata;						
					$this->item = $result->fields[4];
				}
				else {
					$this->itmcode = $itmcode; 
					$this->itmtag = $result->fields[1];
					$this->keywords = $result->fields[2];		  
					$this->descr = $result->fields[3];
					$this->item = $result->fields[4];						
				}
				
				$ret = $this->item . ", " . 
						$this->descr . ", " .  
						$this->keywords;
		
				//echo 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
				$this->page_tags = $ret;			
				return true;			
			}
			//else
				//$this->get_data_info();
		}	
		//else 	
		$this->get_data_info(); //default

		return true;
    }

   
    /*fpitem*/
    public function get_tags($code=null,$retf=null,$tmpl=null) {
        $db = GetGlobal('db');
		$tokens = array();
		$template = $tmpl ? $tmpl : 'fptags';
		$tcont = _m("cmsrt.select_template use $template");
		
		$code = $code ? $code : (GetReq('id') ? GetReq('id') : GetReq('cat'));
		$field = $retf ? $retf : 'tag'; 
		$fieldlan = $field . getlocal();
   
        $sSQL = "select $fieldlan from ptags ";
	    $sSQL .= " WHERE code='" . $code . "'"; //" WHERE tag='" . $tag . "'";
	
		//echo $sSQL;
	    $resultset = $db->Execute($sSQL,2);	
	    $result = $resultset;	

		$mytags =  $result->fields[0] ? $result->fields[0] : $this->keywords;
			
		if (stristr($mytags, ',')) {
		    $tags = explode(',',$mytags);
			foreach ($tags as $tt=>$tag) {
				
			    if (!trim($tag)) continue;
				
				if ($tcont) {	
					$tokens[] = $tag;
					$r[] = $this->combine_tokens($tcont, $tokens); 
					unset($tokens);
				}	
				else
					$r[] = $tag;			  
			}
			if (!empty($r))
				$ret = implode(', ', $r);
		}
		else {
			if ($tcont) {	
			    $tokens[] = $mytags;
				$ret .= $this->combine_tokens($tcont, $tokens); 
				unset($tokens);
            }	
            else
				$ret .= $mytags;	
		} 
		
		return ($ret);		
    }   
   
	//tokens method	
	protected function combine_tokens($template_contents,$tokens, $execafter=null) {
	
	    if (!is_array($tokens)) return;
		
		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
			$fp = new fronthtmlpage(null);
			$ret = $fp->process_commands($template_contents);
			unset ($fp);		  		
		}		  		
		else
			$ret = $template_contents;
		  
	    foreach ($tokens as $i=>$tok) 
		    $ret = str_replace("$".$i."$",$tok,$ret);

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

	protected function replace_spchars($string, $reverse=false) {
		$pc = null; //$this->replacepolicy; //DISABLE POLICY
		
		switch ($pc) {	
	
			case '_' : $ret = $reverse ?  str_replace('_',' ',$string) : str_replace(' ','_',$string); break;
			case '-' : $ret = $reverse ?  str_replace('-',' ',$string) : str_replace(' ','-',$string);break;
			default  :	
			if ($reverse) {
				$g1 = array("'",',','"','+','/',' ',' & ');
				$g2 = array('_','~',"*","plus",":",'-',' n ');		  
				$ret = str_replace($g2,$g1,$string);
			}	 
			else {
				$g1 = array("'",',','"','+','/',' ','-&-');
				$g2 = array('_','~',"*","plus",":",'-','-n-');		  
				$ret = str_replace($g1,$g2,$string);
			}	
	    }
		return ($ret);
	}		
   
};
}
?>