<?php

$__DPCSEC['RCXMLFEEDS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

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
	var $map_f, $map_t, $pprice, $is_reseller;
	var $lan, $itmname, $itmdescr, $fcode, $kshowcmd, $klistcmd, $availability, $decimals, $tax;

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
	   
		//$csep = remote_paramload('RCXMLFEEDS','csep',$this->path); 
		$this->cseparator = _v('cmsrt.cseparator'); //$csep ? $csep : '^';	
	   
		$this->pricef = remote_arrayload('RCXMLFEEDS','pricefields',$this->path); //not used
		$this->pricevat = remote_arrayload('RCXMLFEEDS','pricevat',$this->path); //use inside templates <phpdac>rcxmlfeeds.pricewithtax use $8$+23</phpdac>
		$this->decimal = remote_paramload('RCXMLFEEDS','decimal',$this->path);
		$_tax = remote_paramload('RCXMLFEEDS','tax',$this->path);
		$this->tax = $_tax ?? 24;
		
		$dec_num = remote_paramload('SHKATALOG','decimals',$this->path);
		$this->decimals = $dec_num ? $dec_num : 2;   		

		$murl = arrayload('SHELL','ip');
		$this->url = $murl[0];

		//$this->httpurl = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
		//$this->httpurl.= (strstr($_SERVER['HTTP_HOST'], 'www')) ? $_SERVER['HTTP_HOST'] : 'www.' . $_SERVER['HTTP_HOST'];						
		$this->httpurl = _v('cmsrt.httpurl');
	    $this->lan = $lang ? $lang : getlocal();
	    $this->itmname = $this->lan ? 'itmname' : 'itmfname';
	    $this->itmdescr = $this->lan ? 'itmdescr' : 'itmfdescr';
		$this->fcode = _m('cmsrt.getmapf use code');

		$this->klistcmd = _m('cmsrt.paramload use ESHOP+klistcmd') ?: 'klist'; //products
		$this->kshowcmd = _m('cmsrt.paramload use ESHOP+kshowcmd') ?: 'kshow'; //product
		$this->availability = remote_arrayload('SHKATALOG','qtyavail',$this->path);		
		$this->restype = remote_paramload('RCITEMS','restype',$this->path);	 
		$this->map_t = remote_arrayload('SHKATALOG','maptitle',$this->path);	
		$this->map_f = remote_arrayload('SHKATALOG','mapfields',$this->path);
		
		$this->is_reseller = GetSessionParam('RESELLER');
		$this->pprice = remote_arrayload('SHKATALOG','pricepolicy',$this->path);
		if (empty($this->pprice)){//default
			$this->pprice[0]='price0';
			$this->pprice[1]='price1';
		}
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
			
		//$data = $this->create_data($fl);
		$data = $this->create_data_ver2($fl);
		
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
			
			$u = _m("cmsrt.seturl use t=cpxmlfeeds&xmlfeed=$v+++1"); //seturl('t=cpxmlfeeds&xmlfeed='.$v);
		    $myvalue = str_replace('#', $i, $u ); 
			$opt .= "<option value=\"$myvalue\"".($v == $file ? " selected" : "").">$v</option>";		
		}  
		$opt .= "</option>";	
	
		$filename = _m("cmsrt.seturl use t=cpxmlfeeds+++1"); //seturl("t=cpxmlfeeds");
    
		$toprint .= "<FORM action=". "$filename" . " method=post>";
		$toprint .= "<P><FONT face=\"Arial, Helvetica, sans-serif\" size=1><STRONG>";
		$toprint .= localize('_XMLFILE',getlocal());
		$toprint .= "</STRONG><br>";
		//$toprint .= "<INPUT type=\"text\" name=submail maxlenght=\"64\" size=25><br>"; 
		$toprint .= "<select name='xmlfeed' onChange='location=this.options[this.selectedIndex].value'>" .
				   $opt . "</select>";
				   
		/* //REMOVE AS A NON SECURE POST
		$toprint .= "<DIV class=\"monospace\"><TEXTAREA style=\"width:100%\" NAME=\"csvmails\" ROWS=10 cols=60 wrap=\"virtual\" readonly>";
		$toprint .=  $this->load_xml_file();		 
		$toprint .= "</TEXTAREA></DIV><br>";	   
	    */
		$toprint .= "<br>";
 
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
			
			$_cat = _m('cmsrt.replace_spchars use '.$cat); //str_replace(' ','_', $cat);
			
			$u = _m("cmsrt.seturl use t=kshow&cat=$_cat&id=$id+++1"); //seturl('t=kshow&cat='.$_cat.'&id='.$id,null,null,null,null,1);
			$recarray['itemurl'] = $this->httpurl . '/' . $u;
			$recarray['itemimg'] = $this->httpurl . '/' . $this->imgpath . $id . $this->restype;
			$recarray['itemcat'] = $cat; 
			
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
			$tokens[] = $rec['itemcat']; 
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
	
	//get tokens as is from shkatalogmedia
	protected function get_xml_items_ver2() {
        $db = GetGlobal('db');	

		$fcode = _m("cmsrt.getmapf use code");	
        $lp = _m("cmsrt.getmapf use lastprice");
		$lastprice = $lp ? ','. $lp : ',xml';

		$sSQL = "select id,sysins,code1,pricepc,price2,itmname,itmfname,uniname1,uniname2,active,code4," .
				"price0,price1,cat0,cat1,cat2,cat3,cat4,itmdescr,itmfdescr,itmremark,ypoloipo1,resources,".
				$fcode. $lastprice . ",weight,volume,dimensions,size,color,manufacturer,orderid,YEAR(sysins) as year,MONTH(sysins) as month,DAY(sysins) as day, DATE_FORMAT(sysins, '%h:%i') as time, DATE_FORMAT(sysins, '%b') as monthname," .
				"template,owner,itmactive,p1,p2,p3,p4,p5,code2,code3,datein from products ";			
		$sSQL .= " WHERE itmactive>0 and active>0 ";
		//print_r($_POST);
		if ($_POST['actives']) {/*echo 'actives';*/} 
		else
			$sSQL .= " and "	. $this->xmlindex[0] . "=1";			

		//echo $sSQL;	
	    $resultset = $db->Execute($sSQL,2);	
		//print_r($resultset);
		
		$aliasID = _m("cmsrt.useUrlAlias");
		$aliasExt = _v("cmsrt.aliasExt");
		$pp = $this->read_policy(); 	
		$pz = 2; //medium
			
		foreach ($resultset as $n=>$rec) {
			$ret_array[] = $this->tokenizeRecord($rec, $pp, true, $aliasID, $pz);
		}
		
		return ($ret_array);		
	}	
	
	protected function create_data_ver2($template=null) {

	    if (($template) && (is_readable($this->savepath .'/'. $template.'.xht'))) {
	        $xmltemplate = file_get_contents($this->savepath .'/'. $template.'.xht');
			$xmltemplate_products = file_get_contents($this->savepath .'/'. $template.'.xhm');
			//echo '>SEE:',$xmltemplate_products;
		}
        else
            return false;			
		
	    $data = $this->get_xml_items_ver2();
		//print_r($data);
		//echo count($data); >1 ?
		$tokens = array();
		$items = array();
		//echo $xmltemplate_products . '--->';
		foreach ($data as $n=>$tokens) {
			//print_r($tokens);
			$items[] = $this->combine_tokens($xmltemplate_products, $tokens, true);
            unset($tokens);						
		}	
		//print_r($items);
		
		$tt = array();
		$tt[] = $this->cdate = date('Y-m-d h:m'); //$this->cdate;
		$tt[] = implode("", $items);
		$ret = $this->combine_tokens($xmltemplate, $tt, true);
		unset($tt);
		return ($ret);
	}		
	
	public function read_policy($leeid=null) {
		 
		$v = $this->is_reseller ? $this->pprice[0] : $this->pprice[1]; 
		return ($v);
	}	
	
	/*tokenize list of items */		
	protected function tokenizeRecord($rec, $priceID=null, $cart=null, $aliasID=false, $imgsize=1, $otherimgpath=null) {
		if (!$rec) return null;
		$tokens = array(); 
		$pp = $priceID ? $priceID : 'price1';
		$lastprice = _m("cmsrt.getmapf use lastprice");
		
		//url alias or canonical	
		$id2 = $aliasID ? ($rec[$aliasID] ? $this->stralias($rec[$aliasID]) : $rec[$this->fcode]) : $rec[$this->fcode]; 		
		$aliasExt = _v("cmsrt.aliasExt");
			
		$cat = $this->getkategoriesS(array(0=>$rec['cat0'],1=>$rec['cat1'],2=>$rec['cat2'],3=>$rec['cat3'],4=>$rec['cat4']));
		$price = ($rec[$pp]>0) ? $this->spt($rec[$pp]) : 0;//$this->zeroprice_msg;
		$availability = $this->show_availability($rec['ypoloipo1']);	
		$details = null;
        $detailink = $this->httpurl . '/' . _m("cmsrt.url use t={$this->kshowcmd}&cat=$cat&id=".$rec[$this->fcode]) . '#details';
		$itemlink = $this->httpurl . '/' . _m("cmsrt.url use t={$this->kshowcmd}&cat=$cat&id=".$rec[$this->fcode]); 
		$itemlinkname = _m("cmsrt.url use t={$this->kshowcmd}&cat=$cat&id=" . $rec[$this->fcode] . "+". $rec[$this->itmname]);
			
		//tokens
		$tokens[] = $itemlinkname; //use href token 11 / name token 16
		$tokens[] = $rec[$this->itmdescr];
		$tokens[] = $this->httpurl . '/' . $this->imgpath . $rec[$this->fcode] . $this->restype; //$this->list_photo($rec[$this->fcode],null,null,1,$cat,$imgsize,null,$rec[$this->itmname]);
		$units = $rec['uniname2'] ? localize($rec['uniname1'], $this->lan) .' / '. localize($rec['uniname2'], $this->lan):
									localize($rec['uniname1'], $this->lan);  
		$tokens[] = $units;		  
			  
		$tokens[] = $rec['itmremark'];
		$tokens[] = number_format(floatval($price),$this->decimals);//,',','.');
			
		//if (($cart==true) && (defined("SHCART_DPC"))) {
			$page = isset($_GET['page']) ? $_GET['page'] : 0;

			$cartstr = $rec[$this->fcode].';'.
						$this->replace_cartchars($rec[$this->itmname]).';;;'.
						$cat.';'.$page.';;'.$rec[$this->fcode].';'.$price.';1;';				
							
			$tokens[] = $cartstr; //_m("shcart.showsymbol use $cartstr",1);			
		/*}	
		else
            $tokens[] = null;			
		*/	
		$tokens[] = $availability;
		$tokens[] = $details;
		$tokens[] = $detailink;
		$tokens[] = $rec[$this->fcode]; //10
			
		$tokens[] = ($aliasID) ? $this->httpurl ."/$cat/$id2" . $aliasExt : 
							     $itemlink;	
			 
		$qty = 1; //(($cart==true) && (defined("SHCART_DPC"))) ?	_m("shcart.getCartItemQty use ".$rec[$this->fcode]) : 1;			
		$tokens[] = 1;//(($cart==true) && (defined("SHCART_DPC"))) ? $qty : '0';
		$tokens[] = //(($cart==true) && (defined("SHCART_DPC"))) ? 
					$this->httpurl . "/addcart/{$rec[$this->fcode]}/$cat/1/";// : null;

        $tokens[] = ($otherimgpath) ?
		            $this->httpurl . '/' . $otherimgpath . $rec[$this->fcode] . $this->restype :
					$this->httpurl . '/' . $this->imgpath . $rec[$this->fcode] . $this->restype;
		            //$this->httpurl . $this->get_photo_url($rec[$this->fcode], $imgsize);	
						
        $tokens[] = isset($rec[$lastprice]) ? $rec[$lastprice] : 0;	
        $tokens[] = $rec[$this->itmname]; 
        $tokens[] = _m("cmsrt.replace_spchars use $cat+1");  

        $tokens[] = 0; //$this->item_has_discount($rec[$this->fcode]);
			
		$cart_title = $this->replace_cartchars($rec[$this->itmname]);
        //$tokens[] = $this->httpurl . "/addcart/{$rec[$this->fcode]};{$rec[$this->itmname]};;;$cat;0;;{$rec[$this->fcode]};$price;1/$cat/1/";				  
		$tokens[] = $this->httpurl . "/addcart/{$rec[$this->fcode]}/$cat/1/";				  
		      
		/*date time */
		$tokens[] = $rec['year'];  //20
		$tokens[] = $rec['month'];
		$tokens[] = $rec['day'];
		$tokens[] = $rec['time'];
		$tokens[] = $rec['monthname']; 
			  
		$tokens[] = $rec['template'];
		$tokens[] = $rec['owner'];			  
		$tokens[] = $rec['itmactive'];
			
		$tokens[] = 0; //$this->item_has_points($rec[$this->fcode]);
			
		$tokens[] = $rec['p1']; 
		$tokens[] = $rec['p2']; //30
		$tokens[] = $rec['p3'];
		$tokens[] = $rec['p4'];
		$tokens[] = $rec['p5'];
			
		$tokens[] = $rec['weight'];
		$tokens[] = $rec['volume'];
		$tokens[] = $rec['dimensions'];
		$tokens[] = $rec['size'];
		$tokens[] = $rec['color'];				
		$tokens[] = $rec['manufacturer'];

		$tokens[] = $rec['code1']; //40
		$tokens[] = $rec['code2'];				
		$tokens[] = $rec['code3'];			
		$tokens[] = $rec['code4'];	
		$tokens[] = $rec['resources']; 
		$tokens[] = $rec['ypoloipo1'] ;
		$tokens[] = $rec['ypoloipo1'] ? '1' : '0';				
			
		$pwt = //(($cart==true) && (defined("SHCART_DPC"))) ?
				$this->pricewithtax($price, $this->tax); //_v('shcart.tax')); // : $price;
		$tokens[] = number_format($pwt, $this->decimals); //,',','.'); //(floatval($price)*24/100)+floatval($price)
		
		$tokens[] = $rec['datein'] ; //48
				
		return ($tokens);
	}	
	
	public function show_availability($qty=null) {
		if (!$this->availability) 
			return 0;

		$r_scale = array_reverse($this->availability,1);
		
		foreach ($r_scale as $i=>$s) 
			if (floatval($qty)>=floatval($s)) return ($i+1);

		return 0;
	}	
		
	protected function getkategoriesS($categories) {	
		$c = $this->sep();
		
		if (empty($categories)) return null;
		foreach ($categories as $i=>$cat)
			if ($cat) $xc[] = str_replace($g1,$g2,$cat);
			
		$ret = (empty($xc)) ? null : implode($c, $xc);
		return ($ret);
	}	
	
	public function replace_cartchars($string, $reverse=false) {
		if (!$string) return null;

		$g1 = array("'",',','"','+','/',' ','-&-');
		$g2 = array('_','~',"*","plus",":",'-','-n-');		
	  
		return $reverse ? str_replace($g2,$g1,$string) : str_replace($g1,$g2,$string);
	}		
	
	protected function sep() {
		$s = _v('cmsrt.cseparator'); //$this->cseparator;
		return $s;
	}	
	
	public function stralias($string) {
		
		return _m('cmsrt.stralias use '. $string);
	}		
	

	/*
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
	*/
	public function pricewithtax($price,$tax=null) {
	
		if ($tax) {
			$mytax = ((floatval($price) * $tax)/100);	
			$value = (floatval($price) + $mytax);		  
		}
		else {
			if (defined('SHCART_DPC')) {
				$tax = _v('shcart.tax'); 
				$mytax = ((floatval($price) * $tax)/100);	
				$value = (floatval($price) + $mytax);		  
			}
			else		
				$value = floatval($price);
		}	
	
		return ($value);
	}	

	//select price type..overriten error when no cart
	public function spt($price,$tax=null) {

		if ($tax) 
			$p = $this->pricewithtax($price, $tax);	  
		elseif ($this->is_reseller) 
			$p = $price;
		elseif ((defined('SHCART_DPC')) && (_v('shcart.showtaxretail'))) 
			$p = $this->pricewithtax($price, _v('shcart.tax'));
		else
			$p = $price;		

		return ($p);
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

	protected function combine_tokens(&$template_contents, $tokens, $execafter=null) {
		//$toks = serialize($tokens);
		//return _m("cmsrt.combine_tokens use $template_contents+$toks+$execafter");
	    if (!is_array($tokens)) return;
		$ret = null;
		
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

		for ($x=$i;$x<60;$x++)
			$ret = str_replace("$".$x."$",'',$ret);
		
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