<?php
$__DPCSEC['SHTAGS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if (!defined("SHTAGS_DPC")) {
define("SHTAGS_DPC",true);

$__DPC['SHTAGS_DPC'] = 'shtags';
 
$__EVENTS['SHTAGS_DPC'][0]='cpshtags';
$__EVENTS['SHTAGS_DPC'][1]='kshow';
$__EVENTS['SHTAGS_DPC'][2]='klist';

$__ACTIONS['SHTAGS_DPC'][0]='cpshtags';
$__ACTIONS['SHTAGS_DPC'][1]='kshow';
$__ACTIONS['SHTAGS_DPC'][2]='klist';

//GetGlobal('controller')->get_parent('SHKATALOGMEDIA_DPC','SHTAGS_DPC');

$__DPCATTR['SHTAGS_DPC']['cpshtags'] = 'cpshtags,1,0,0,0,0,0,0,0,1,1,1,1';

$__LOCALE['SHTAGS_DPC'][0]='SHTAGS_DPC;Tags;Tags';
$__LOCALE['SHTAGS_DPC'][1]='_TAG;Tag;Tag';

class shtags {

   var $result, $zeroprice_msg;
   var $default_tag;
   var $meta_file, $default_meta_file;
   var $prpath;
   var $item,$descr,$price,$keywords;
   var $metadb, $tagcat, $tagid;
   var $cseparator, $replacepolicy;
   
   var $tmpl_path, $tmpl_name;   

   function shtags() {
   
     $this->prpath = paramload('SHELL','prpath');
   
     $this->default_tag = paramload('SHTAGS','tags');//"vehicles, sales, cars, motorcycles";
	 
	 $mf = remote_paramload('SHTAGS','metafile',$this->prpath);
	 $this->meta_file = $mf?$mf:'meta.txt'; 
	 
	 $df = remote_paramload('SHTAGS','defmetafile',$this->prpath);
	 $this->default_meta_file = $df?$df:'metad.txt'; 

     $this->metadb = remote_paramload('SHTAGS','metadb',$this->prpath); 
     $this->tagcat = GetReq('cat'); //holds category tag ..default val
     $this->tagitem = GetReq('id');  //holds item tag	 
	 	 
	 //read at init if there is tags in url...???
     $this->save_global_tag_vars();

	 $this->replacepolicy = remote_paramload('SHKATEGORIES','replacechar',$this->path);	 
	 $csep = remote_paramload('SHKATEGORIES','csep',$this->path); 
     $this->cseparator = $csep ? $csep : '^';	

	 $this->tmpl_path = remote_paramload('FRONTHTMLPAGE','path',$this->path);
	 $this->tmpl_name = remote_paramload('FRONTHTMLPAGE','template',$this->path); 	 
   }
   
   function event($evn=null) {
   
	 //if ((GetReq('id')) || (GetReq('cat'))) {
	 
	 if ($this->metadb) {
	   $this->get_tag_info();  //db based
	   $this->save_global_tag_vars();
	 }  
	 else //default ..from categories,products table
	   $this->get_data_info();
	   
	   
	 //}   
     //echo 'tag';	 
   }
   
   function action($act=null) {

   }
   
   function get_category_info() {
     $cat = GetReq('cat');
   
     if ($cat) {
		$mycat = $this->replace_spchars($cat,1);
				
       if (defined("RCCATEGORIES_DPC")) {
	     	$cstring = explode($this->cseparator,$mycat);
	   }
       elseif (defined("RCKATEGORIES_DPC")) {	
	     	$cstring = rawurldecode(explode($this->cseparator,$mycat));	   	        
	   }
	   
	   $ret = implode(',',$cstring);
			   
	   if ($this->meta_file) {
		
		  $out = $this->get_meta_file($ret);
		  return ($out);
	   }	   
	   else
		  return ($ret); 	   
	 }  
   }
   
   function get_data_info() {
		$item = GetReq('id');	
		$cat = GetReq('cat');
	    $lan = getlocal();
	    $itmname = $lan?'itmname':'itmfname';
	    $itmdescr = $lan?'itmdescr':'itmfdescr';		

		if (defined('SHKATEGORIES_DPC')) {
		  //ECHO 'C'; 
		  $mytree = GetGlobal('controller')->calldpc_var("shkategories.cat_result");
		  //print_r($mytree);
		  $thetree = (!empty($mytree))?implode(',',$mytree):null;
		} 		
		
	    if ($item) {
			
		  if (defined('SHKATALOGMEDIA_DPC')) {
			$this->result = GetGlobal('controller')->calldpc_var("shkatalogmedia.result");
			$ppol = GetGlobal('controller')->calldpc_method("shkatalogmedia.read_policy");
		  }  		
		
		  $this->item = $this->result->fields[$itmname];
		  $this->descr = $this->result->fields[$itmdescr];
		  $this->price = $this->result->fields[$ppol];
		  $kwords = str_replace(' ',',',$this->item) . ',' ;
		  $kwords.= $thetree;
		  $this->keywords = str_replace(',,',',', $kwords);
		}
		elseif ($cat) {
		  $cc = explode($this->cseparator, $cat);
		  $xcat = array_pop($cc);
		  $this->item = (!empty($mytree))? array_pop($mytree) : $this->replace_spchars($xcat,1);
		  $this->descr = $this->item .',' . $thetree;
		  $this->price = null;
		  $this->keywords = $this->item . ',' . $thetree;		
		}
        else { //front page
		  $this->item = null;
		  $this->descr = remote_paramload('INDEX','meta-description', $this->prpath);
		  $this->price = null;
		  $this->keywords = remote_paramload('INDEX','meta-keywords', $this->prpath);			
        }		
   }
   
   function get_meta_file($tags=null) {
       //print_r($tags);
	   
       if ($meta_tags = @file_get_contents($this->prpath . $this->meta_file)) {
	   
	     foreach ($tags as $i=>$t) {
		   //echo $i,'=>',$t;
	       $meta_tags = str_replace('$'.$i.'$',$t,$meta_tags);
		 }
		 //echo '>',$i;
		 //clean
		 for ($x=$i;$x<=20;$x++)
		   $meta_tags = str_replace('$'.$i.'$','',$meta_tags);
		   
	     return ($meta_tags);	   
	   }   
   } 
   
   function get_page_info($key=null,$defkey=null) {
       //echo '>'.$this->{$key};
	   $meta_title = ($defkey=='NULL') ? null : ($defkey ? $defkey : remote_paramload('INDEX','title', $this->prpath));
	   $meta_descr = ($defkey=='NULL') ? null : ($defkey ? $defkey : remote_paramload('INDEX','meta-description', $this->prpath));
	   $meta_keywords = ($defkey=='NULL') ? null : ($defkey ? $defkey : remote_paramload('INDEX','meta-keywords', $this->prpath));			
   	   
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
	     return (null);
   }
   
   function get_tag_info() {
        $db = GetGlobal('db');
		$item = GetReq('id');	
		$cat = GetReq('cat');
	    $lan = getlocal();
	    $itmkeywords = $lan?'keywords'.$lan:'keywords0';
	    $itmdescr = $lan?'descr'.$lan:'descr0';  
		$itmtitle = $lan?'title'.$lan:'title0';

        $code = $item ? $item : $cat;		
		
        $sSQL = "select code,tag,$itmkeywords,$itmdescr,$itmtitle from ptags ";
	    $sSQL .= " WHERE code='" . $code . "'";
	    /*$sSQL .= " and type='". $this->restype ."'";
	    if (isset($stype))
	      $sSQL .= " and stype='". $stype ."'";*/	
		//echo $sSQL;
	    $resultset = $db->Execute($sSQL,2);	
	    $result = $resultset;		
		
		if ($itmcode = $result->fields[0]) { 
		  //echo $sSQL;
		  $this->itmcode = $itmcode; 
		  $this->itmtag = $result->fields[1];//'my item';	
		  $this->keywords = $result->fields[2];//'my item';		  
		  $this->descr = $result->fields[3];//'my item';
		  $this->item = $result->fields[4];//=title		  
		  /*$this->keywords = $this->itmtag . ',' . 
		                    $this->keys . ',' . 
		                    $this->itmcode;// . ',' . 
		                    //$thetree;	*/	
		}
		else {
		   //echo 'z';
		   $this->get_data_info(); //default
		}   
   }
   
   function get_content_tag($tag=null,$retf=null) {
        $db = GetGlobal('db');
		
		if (!$this->metadb)
		    return null;
		
		$field = $retf ? $retf : 'code'; 
   
        $sSQL = "select $field from ptags ";
	    $sSQL .= " WHERE tag='" . $tag . "'";
	
		//echo $sSQL;
	    $resultset = $db->Execute($sSQL,2);	
	    $result = $resultset;		
		
		if ($ret = $result->fields[0]) 
            return ($ret);		
   }
   
   function save_global_tag_vars() {
	    $item = GetReq('id');	
		$cat = GetReq('cat');
		//$greek_cat = iconv("UTF-8", "ISO-8859-7", $cat);
		//$greek_item = iconv("UTF-8", "ISO-8859-7", $item);
		//echo $greek_item,'>',$item;
		
        $tcat = $this->get_content_tag($cat); 
        $titem = $this->get_content_tag($item);  
		
        $this->tagcat = $tcat ? $tcat : $cat; 
        $this->tagitem = $titem ? $titem : $item;  		
   }
   
   /*fpitem*/
   function get_tags($code=null,$retf=null,$tmpl=null) {
        $db = GetGlobal('db');
		$tokens = array();
		$template = $tmpl ? $tmpl : 'fptags.htm';
        $t = $this->prpath . $this->tmpl_path .'/'. $this->tmpl_name .'/'. str_replace('.',getlocal().'.',$template) ;
		if (($template) && is_readable($t)) 
			$tcont = @file_get_contents($t);
		
		$code = $code ? $code : (GetReq('id') ? GetReq('id') : GetReq('cat'));
		$field = $retf ? $retf : 'tag'; 
		$fieldlan = $field . getlocal();
   
        $sSQL = "select $fieldlan from ptags ";
	    $sSQL .= " WHERE code='" . $code . "'"; //" WHERE tag='" . $tag . "'";
	
		//echo $sSQL;
	    $resultset = $db->Execute($sSQL,2);	
	    $result = $resultset;	

		if (stristr($result->fields[0],',')) {
		    $tags = explode(',',$result->fields[0]);
			foreach ($tags as $tt=>$tag) {
			
		      if ($tcont) {	
			    $tokens[] = $tag;
				$ret .= $this->combine_tokens($tcont, $tokens); 
				unset($tokens);
              }	
              else
                $ret .= $tag.',';			  
			}
		}
		else {
			if ($tcont) {	
			    $tokens[] = $result->fields[0];
				$ret .= $this->combine_tokens($tcont, $tokens); 
				unset($tokens);
            }	
            else
				$ret .= $result->fields[0];	
		} 
		
		return ($ret);		
   }   
   
	//tokens method	
	function combine_tokens($template_contents,$tokens, $execafter=null) {
	
	    if (!is_array($tokens)) return;
		
		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
		  $fp = new fronthtmlpage(null);
		  $ret = $fp->process_commands($template_contents);
		  unset ($fp);
          //$ret = GetGlobal('controller')->calldpc_method("fronthtmlpage.process_commands use ".$template_contents);		  		
		}		  		
		else
		  $ret = $template_contents;
		  
		//echo $ret;
	    foreach ($tokens as $i=>$tok) {
            //echo $tok,'<br>';
		    $ret = str_replace("$".$i."$",$tok,$ret);
	    }
		//clean unused token marks
		for ($x=$i;$x<20;$x++)
		  $ret = str_replace("$".$x."$",'',$ret);
		//echo $ret;
		
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
		
		switch ($this->replacepolicy) {	
	
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