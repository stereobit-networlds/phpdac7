<?php

$__DPCSEC['RCXMLFEEDS_DPC']='1;1;1;1;1;1;1;6;7;8;9';

if (!defined("RCXMLFEEDS_DPC")) {
define("RCXMLFEEDS_DPC",true);

$__DPC['RCXMLFEEDS_DPC'] = 'rcxmlfeeds';

$__EVENTS['RCXMLFEEDS_DPC'][0]='cpxmlfeeds';
$__EVENTS['RCXMLFEEDS_DPC'][1]='cpxmlcreate';

$__ACTIONS['RCXMLFEEDS_DPC'][0]='cpxmlfeeds';
$__ACTIONS['RCXMLFEEDS_DPC'][1]='cpxmlcreate';

$__LOCALE['RCXMLFEEDS_DPC'][0]='RCXMLFEEDS_DPC;XML feeds;XML feeds';
$__LOCALE['RCXMLFEEDS_DPC'][1]='_XMLFILE;XML file;XML file';
$__LOCALE['RCXMLFEEDS_DPC'][2]='_XMLITEMS;XML items;XML είδη';
$__LOCALE['RCXMLFEEDS_DPC'][3]='_dimensions;Dimension;Διαστάσεις';
$__LOCALE['RCXMLFEEDS_DPC'][4]='_size;Size;Μέγεθος';
$__LOCALE['RCXMLFEEDS_DPC'][5]='_resources;Resources;Resources';
$__LOCALE['RCXMLFEEDS_DPC'][6]='_xmlcreate;Create XML;Δημιούργησε XML';
$__LOCALE['RCXMLFEEDS_DPC'][7]='_xml;XML item;Είδος XML';
$__LOCALE['RCXMLFEEDS_DPC'][8]='_manufacturer;Manufacturer;Κατασκευαστής';
$__LOCALE['RCXMLFEEDS_DPC'][9]='_cat0;Category 1;Κατηγορία 1';
$__LOCALE['RCXMLFEEDS_DPC'][10]='_cat1;Category 2;Κατηγορία 2';
$__LOCALE['RCXMLFEEDS_DPC'][11]='_cat2;Category 3;Κατηγορία 3';
$__LOCALE['RCXMLFEEDS_DPC'][12]='_cat3;Category 4;Κατηγορία 4';
$__LOCALE['RCXMLFEEDS_DPC'][13]='_cat4;Category 5;Κατηγορία 5';
$__LOCALE['RCXMLFEEDS_DPC'][14]='_code0;Code 0;Κωδικός 0';
$__LOCALE['RCXMLFEEDS_DPC'][15]='_code1;Code 1;Κωδικός 1';
$__LOCALE['RCXMLFEEDS_DPC'][16]='_code2;Code 2;Κωδικός 2';
$__LOCALE['RCXMLFEEDS_DPC'][17]='_code3;Code 3;Κωδικός 3';
$__LOCALE['RCXMLFEEDS_DPC'][18]='_code4;Code 4;Κωδικός 4';
$__LOCALE['RCXMLFEEDS_DPC'][19]='_code5;Code 5;Κωδικός 5';
$__LOCALE['RCXMLFEEDS_DPC'][20]='_itmactive;Active;Ενεργό';
$__LOCALE['RCXMLFEEDS_DPC'][21]='_active;Active;Ενεργό';
$__LOCALE['RCXMLFEEDS_DPC'][22]='_itmname;Title;Τίτλος';
$__LOCALE['RCXMLFEEDS_DPC'][23]='_uniname1;Unit;Μονάδα μ.';
$__LOCALE['RCXMLFEEDS_DPC'][24]='_ypoloipo1;Qty 1;Υπόλοιπο 1';
$__LOCALE['RCXMLFEEDS_DPC'][25]='_ypoloipo2;Qty 2;Υπόλοιπο 2';
$__LOCALE['RCXMLFEEDS_DPC'][26]='_price0;Price 1;Αξία 1';
$__LOCALE['RCXMLFEEDS_DPC'][27]='_price1;Price 2;Αξία 2';
$__LOCALE['RCXMLFEEDS_DPC'][28]='_color;Color;Χρώμα';
$__LOCALE['RCXMLFEEDS_DPC'][29]='_resources;Res;Συσχ.';
$__LOCALE['RCXMLFEEDS_DPC'][30]='_weight;Weight;Βάρος';
$__LOCALE['RCXMLFEEDS_DPC'][31]='_volume;Volume;Όγκος';
$__LOCALE['RCXMLFEEDS_DPC'][32]='_itmfname;Title;Τίτλος';

class rcxmlfeeds {

    var $prpath, $title, $select_fields, $xmlindex, $cdate, $savepath;
	var $cseparator, $url, $imgpath, $restype;
	var $pricef, $pricevat, $decimal, $httpurl;

    public function __construct() {
	  
		$this->title = localize('RCXMLFEEDS_DPC',getlocal());	  
		
		$this->prpath = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		
		$this->xmlfiles = remote_arrayload('RCXMLFEEDS','files',$this->prpath); 
	   
		$this->savepath = $this->urlpath . remote_paramload('RCXMLFEEDS','savepath',$this->prpath);
		$this->imgpath = remote_paramload('RCXMLFEEDS','imgpath',$this->prpath);	   
	   
		$this->select_fields = remote_arrayload('RCXMLFEEDS','selectfields',$this->prpath); 
		$this->xmlindex = remote_arrayload('RCXMLFEEDS','xmlindex',$this->prpath);	   	
	   
		$this->cdate = date(DATE_RFC822);//'m-d-Y');
	   
		$csep = remote_paramload('RCXMLFEEDS','csep',$this->path); 
		$this->cseparator = $csep ? $csep : '^';	
	   
		$this->pricef = remote_arrayload('RCXMLFEEDS','pricefields',$this->path); //not used
		$this->pricevat = remote_arrayload('RCXMLFEEDS','pricevat',$this->path); //use inside templates <phpdac>rcxmlfeeds.pricewithtax use $8$+23</phpdac>
		$this->decimal = remote_paramload('RCXMLFEEDS','decimal',$this->path);

		$murl = arrayload('SHELL','ip');
		$this->url = $murl[0];

		$this->httpurl = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
		$this->httpurl.= (strstr($_SERVER['HTTP_HOST'], 'www')) ? $_SERVER['HTTP_HOST'] : 'www.' . $_SERVER['HTTP_HOST'];						

		$this->restype = remote_paramload('RCITEMS','restype',$this->path);	   
	}
	
    public function event($event=null) {
	
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;			

		if (!$this->msg) {
			switch ($event) {
				case 'cpxmlcreate'  : 	$this->create_xml();
										break;
				default             :		
			                        						  
			}
		}
    }	

    public function action($action=null)  { 
	
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;
		
	    switch ($action) {
			case 'cpxmlcreate'  :
			default             :  $out = $this->form();
		}			 

	     return ($out);
	}	
	
	
	protected function create_xml() {
		//echo GetParam('xmlfeed'); 
		$f = explode('=', GetParam('xmlfeed'));
		$fl = array_pop($f);
		$file = $this->savepath .'/'. $fl . '.xml';
		
        //$ret = file_put_contents($file, '123', LOCK_EX);		
		$data = $this->create_data($fl);
		$ret = @file_put_contents($file, $data, LOCK_EX);
		
		return $ret;		
	}
	
	protected function load_xml_file() {
		if (GetParam('FormAction')) {
  		  $f = explode('=', GetParam('xmlfeed'));
		  $file = $this->savepath .'/'. array_pop($f) . '.xml';
		}
        else
          $file = $this->savepath .'/'. GetReq('xmlfeed') . '.xml';
	  
		if (is_readable($file))
			return file_get_contents($file);
	}	
	
	
	protected function form() {
	
        $out = $this->xmlform(); 	   
	    $out .= $this->show_grids(1);  
	    return ($out);		
	}	
	
    protected function xmlform()  { 	
	
		if (GetParam('FormAction')) {
			$f = explode('=', GetParam('xmlfeed'));
			$file = array_pop($f);
		}
        else
			$file = GetReq('xmlfeed');	   

		$opt = "<option value='#'>".localize('RCXMLFEEDS_DPC',getlocal())."</option>";	   
		//$opt .= implode("</option><option>",$this->xmlfiles);
		foreach ($this->xmlfiles as $i=>$v) {
		    $myvalue = str_replace('#',$i,seturl('t=cpxmlfeeds&xmlfeed='.$v)); 
			$opt .= "<option value=\"$myvalue\"".($v == $file ? " selected" : "").">$v</option>";		
		}  
		$opt .= "</option>";	
	
		$filename = seturl("t=cpxmlfeeds&editmode=".GetReq('editmode'));
    
		$toprint .= "<FORM action=". "$filename" . " method=post>";
		$toprint .= "<P><FONT face=\"Arial, Helvetica, sans-serif\" size=1><STRONG>";
		$toprint .= localize('_XMLFILE',getlocal());
		$toprint .= "</STRONG><br>";
		//$toprint .= "<INPUT type=\"text\" name=submail maxlenght=\"64\" size=25><br>"; 
		$toprint .= "<select name='xmlfeed' onChange='location=this.options[this.selectedIndex].value'>" .
				   $opt . "</select>";
	   
		$toprint .= "<DIV class=\"monospace\"><TEXTAREA style=\"width:100%\" NAME=\"csvmails\" ROWS=10 cols=60 wrap=\"virtual\" readonly>";
		$toprint .=  $this->load_xml_file();		 
		$toprint .= "</TEXTAREA></DIV><br>";	   
	   
 
		$toprint .= "<input type=\"hidden\" name=\"FormName\" value=\"xmlcreate\">"; 
		$toprint .= "<INPUT type=\"submit\" name=\"submit\" value=\"" . localize('_xmlcreate',getlocal()) . "\">&nbsp;";  
		$toprint .= "<input type=\"checkbox\" name=\"actives\" value=\"1\" checked>&nbsp;All active items" ; 
		$toprint .= "<INPUT type=\"hidden\" name=\"FormAction\" value=\"" . "cpxmlcreate" . "\">";	 	   
	   	    
		$toprint .= "</FONT></FORM>";	    

		return ($toprint);
    }		
	
	
	protected function show_grids() {

		$title = str_replace(' ','_',localize('_XMLITEMS',getlocal()));
        $myfields = implode(',', $this->select_fields);	

		$sSQL = 'select * from (select id,'.$myfields . ' from products) as o';	   
		//echo $sSQL;

		foreach ($this->select_fields as $i=>$f) {
			if (stristr($f,'active')) {
				$type = 'boolean';
				$edit = 0;
				$options = ($f=='itmactive') ? "1:0" : "101:0";	
				$align = 'left';
                //$title = localize('_'.$f,getlocal());					
			}
			else {
				$type = 10;
				$edit = /*stristr($f,$this->xmlindex*/in_array($f, $this->xmlindex) ? 1 : 0;
				$options = null; 
				$align = 'left';
				//$title = stristr($f,$this->xmlindex) ? localize('_xmlindex',getlocal()) : localize('_'.$f,getlocal());
			}				
			_m("mygrid.column use grid9+$f|".localize('_'.$f,getlocal())."|$type|$edit|$options|$link_option|$search|$hidden|$align");	
		}
			
		$out = _m("mygrid.grid use grid9+products+$sSQL+e+$title+id+1+1+12+300++0+1+1");
			
		return ($out);	
	}	
	
	
	protected function get_xml_items() {
        $db = GetGlobal('db');		
	    $lan = $lang?$lang:getlocal();
	    $itmname = $lan?'itmname':'itmfname';
	    $itmdescr = $lan?'itmdescr':'itmfdescr';
		$code = _m('cmsrt.getmapf use code');
		
		$myfields = implode(',', $this->select_fields);	

		$sSQL = "select id," . $myfields . " from products";			
		$sSQL .= " WHERE itmactive>0 and active>0 ";
		//print_r($_POST);
		if ($_POST['actives']) {/*echo 'actives';*/} 
		else
			$sSQL .= " and "	. $this->xmlindex[0] . "=1";			

		//echo $sSQL;	
	    $resultset = $db->Execute($sSQL,2);	
		//print_r($resultset);
		foreach ($resultset as $n=>$rec) {
			
			foreach ($this->select_fields as $i=>$f) {
				$recarray[$f] = $rec[$f];
			} 
		    $id = $rec[$code];	
			$cat = $rec['cat0'] ? $rec['cat0'] : null;
			$cat .= $rec['cat1'] ? $this->cseparator.$rec['cat1'] : null;
			$cat .= $rec['cat2'] ? $this->cseparator.$rec['cat2'] : null;
			$cat .= $rec['cat3'] ? $this->cseparator.$rec['cat3'] : null;
			$cat .= $rec['cat4'] ? $this->cseparator.$rec['cat4'] : null;
			
			$_cat = _m('cmsrt.replace_spchars use '.$cat);//str_replace(' ','_', $cat);
			
			$recarray['itemurl'] = $this->httpurl . '/' . seturl('t=kshow&cat='.$_cat.'&id='.$id,null,null,null,null,1);
			$recarray['itemimg'] = $this->httpurl . '/' . $this->imgpath . $id . $this->restype;
			$recarray['itemcat'] = $cat; /** <<<<<<<<<<<<<<<<<<<<<<<<<<< also add **/
			
			$ret_array[] = (array) $recarray;
		
		}
		
		return ($ret_array);		
	}		
	
	protected function create_data($template=null) {

	    if (($template) && (is_readable($this->savepath .'/'. $template.'.xht'))) {
	        $xmltemplate = @file_get_contents($this->savepath .'/'. $template.'.xht');
			$xmltemplate_products = @file_get_contents($this->savepath .'/'. $template.'.xhm');
			//echo '>SEE:',$xmltemplate_products;
		}
        else
            return false;			
		
	    $data = $this->get_xml_items();
		//print_r($data);
		//echo count($data); >1 ?
		$tokens = array();
		$items = array();
		foreach ($data as $n=>$rec) {
			
			foreach ($this->select_fields as $i=>$f) {
				$tokens[] = $rec[$f];
            }	
			$tokens[] = $rec['itemurl'];
			$tokens[] = $rec['itemimg'];
			$tokens[] = $rec['itemcat']; /** <<<<<<<<<<<<<<<<<<<<<<<<<<< also add **/
			//if ($n==0) print_r($tokens);
			$items[] = $this->combine_tokens($xmltemplate_products, $tokens, true);
            unset($tokens);						
		}	
		
		$tt = array();
		$tt[] = $this->cdate = date('Y-m-d h:m'); //$this->cdate;
		$tt[] = implode("", $items);
		$ret = $this->combine_tokens($xmltemplate, $tt, true);
		unset($tt);
		return ($ret);
	}	

	protected function combine_tokens($template_contents,$tokens, $execafter=null) {
	    //print_r($tokens); //<<<<<<<<<<<<<, test
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
	
	public function fnum($n, $dec_digits, $dp=null, $tp=null) {
	  $dec = $dp ? $dp : $this->decimal;
      $ret = number_format(floatval($n),$dec_digits,$dec,$tp);
      return ($ret);	  
	}

	public function pricewithtax($price,$tax=null) {

		if ($tax) {
			$mytax = (($price*$tax)/100);	
			$value = ($price+$mytax);		  
		}
		else
			$value = $price;
	 
		$ret = $this->fnum($value,2,',',''); //'.'
	
		return ($ret);
	}	
	
	//override from fronthtmlpage (use rcxmlfeeds.nvltokens)
	public function nvltokens($token=null,$state1=null,$state2=null,$value=null,$isdigit=null) {
		//echo '>',$token,':',$value,'<br/>';
		if (is_numeric($value) && ($isdigit==true)) 
           $ret = ($token==$value) ? $state1 : $state2;			
		elseif ($value) 
			$ret = ($token==$value) ? $state1 : $state2;  	
        else 	
           $ret = $token ? $state1 : $state2;
 
		return ($ret);
    }		
};
}
?>