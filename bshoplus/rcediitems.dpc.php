<?php
$__DPCSEC['RCEDIITEMS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ( (!defined("RCEDIITEMS_DPC")) && (seclevel('RCEDIITEMS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCEDIITEMS_DPC",true);

$__DPC['RCEDIITEMS_DPC'] = 'rcediitems';

$__EVENTS['RCEDIITEMS_DPC'][0]='cpediitems';
$__EVENTS['RCEDIITEMS_DPC'][1]='cpsaveediitems';

$__ACTIONS['RCEDIITEMS_DPC'][0]='cpediitems';
$__ACTIONS['RCEDIITEMS_DPC'][1]='cpsaveediitems';

$__LOCALE['RCEDIITEMS_DPC'][0]='RCEDIITEMS_DPC;EDI items;EDI ειδών';
$__LOCALE['RCEDIITEMS_DPC'][1]='_ediitems;EDI items;EDI ειδών';
$__LOCALE['RCEDIITEMS_DPC'][2]='_moveincategory;Insert items in category;Εισαγωγή ειδών στην κατηγορία';
$__LOCALE['RCEDIITEMS_DPC'][3]='_date;Date;Ημερ.';
$__LOCALE['RCEDIITEMS_DPC'][4]='_time;Time;Ώρα';
$__LOCALE['RCEDIITEMS_DPC'][5]='_qty;Quantity;Ποσότητα';
$__LOCALE['RCEDIITEMS_DPC'][6]='_items;Items;Είδη';
$__LOCALE['RCEDIITEMS_DPC'][7]='_active;Active;Ενεργό';
$__LOCALE['RCEDIITEMS_DPC'][8]='_title;Title;Τίτλος';
$__LOCALE['RCEDIITEMS_DPC'][9]='_descr;Description;Περιγραφή';
$__LOCALE['RCEDIITEMS_DPC'][10]='_owner;Owner;Owner';
$__LOCALE['RCEDIITEMS_DPC'][11]='_color;Color;Χρώμα';
$__LOCALE['RCEDIITEMS_DPC'][12]='_code;Code;Κωδικός';
$__LOCALE['RCEDIITEMS_DPC'][13]='_dimensions;Dimension;Διαστάσεις';
$__LOCALE['RCEDIITEMS_DPC'][14]='_size;Size;Μέγεθος';
$__LOCALE['RCEDIITEMS_DPC'][15]='_dimensions;Dimensions;Διαστάσεις';
$__LOCALE['RCEDIITEMS_DPC'][16]='_xmlcreate;Create XML;Δημιούργησε XML';
$__LOCALE['RCEDIITEMS_DPC'][17]='_xml;XML item;Είδος XML';
$__LOCALE['RCEDIITEMS_DPC'][18]='_manufacturer;Manufacturer;Κατασκευαστής';
$__LOCALE['RCEDIITEMS_DPC'][19]='_uniname1;Unit;Μον.μετρ.';
$__LOCALE['RCEDIITEMS_DPC'][20]='_ypoloipo1;Qty;Υπόλοιπο';
$__LOCALE['RCEDIITEMS_DPC'][21]='_price0;Price 1;Αξία 1';
$__LOCALE['RCEDIITEMS_DPC'][22]='_price1;Price 2;Αξία 2';
$__LOCALE['RCEDIITEMS_DPC'][23]='_cat;Category;Κατηγορία';
$__LOCALE['RCEDIITEMS_DPC'][24]='_createcategory;Create categories in category;Δημιουργία κατηγοριών στην κατηγορία';
$__LOCALE['RCEDIITEMS_DPC'][25]='_updateincategory;Update items in category;Μεταβολή ειδών στην κατηγορία';
$__LOCALE['RCEDIITEMS_DPC'][26]='_insupd;Insert - Update;Εισαγωγή - Μεταβολή';
$__LOCALE['RCEDIITEMS_DPC'][27]='_remove;Remove;Διαγραφές';
$__LOCALE['RCEDIITEMS_DPC'][28]='_deletecategory;Delete categories in category;Διαγραφή κατηγοριών στην κατηγορία';
$__LOCALE['RCEDIITEMS_DPC'][29]='_deleteincategory;Delete items in category;Διαγραφή ειδών στην κατηγορία';
$__LOCALE['RCEDIITEMS_DPC'][30]='_dblog;Affect database and logs;Ενημέρωση ΒΔ και αρχείο καταγραφής';
$__LOCALE['RCEDIITEMS_DPC'][31]='_dbset;Affect database;Ενημέρωση Βασης Δεδομένων';
$__LOCALE['RCEDIITEMS_DPC'][32]='_logset;Affect logs;Ενημέρωση αρχείων καταγραφής';
$__LOCALE['RCEDIITEMS_DPC'][33]='_logclear;Clear logs;Άδειασμα αρχείων καταγραφής';
$__LOCALE['RCEDIITEMS_DPC'][34]='_catupd;Update categories;Ενημέρωση κατηγοριών';
$__LOCALE['RCEDIITEMS_DPC'][35]='_filter;Filter;Φίλτρο';
$__LOCALE['RCEDIITEMS_DPC'][36]='_viewable;Viewable;Ορατό';
$__LOCALE['RCEDIITEMS_DPC'][37]='_searchable;Searchable;Αναζητήσιμο';
$__LOCALE['RCEDIITEMS_DPC'][38]='_slug;Slug on;Ενεργοποίηση Slug';
$__LOCALE['RCEDIITEMS_DPC'][39]='_sluggreeklish;Greeklish translations;Greeklish μετάφραση';
$__LOCALE['RCEDIITEMS_DPC'][40]='_options;Options;Ρυθμίσεις';
$__LOCALE['RCEDIITEMS_DPC'][41]='_lrp;Long Running Process;Long Running Process';
$__LOCALE['RCEDIITEMS_DPC'][42]='_edi;EDI Data;EDI Data';
$__LOCALE['RCEDIITEMS_DPC'][43]='_dif;DIF Data;DIF Data';
$__LOCALE['RCEDIITEMS_DPC'][44]='_mode;Select data source;Επιλογή προέλευσης';
$__LOCALE['RCEDIITEMS_DPC'][45]='_fromroot;Do not overwrite parent leaf by selected categoty;Απο την τρέχουσα θέση και επέκταση με την κατηγοριοποίηση της επιλογής';
$__LOCALE['RCEDIITEMS_DPC'][46]='_overroot;Οverwrited parent leaf by selected categoty;Με επικάλυψη απο την επιλεγμένη κατηγορία και επέκταση με το υπόλοιπο της επιλογής';
$__LOCALE['RCEDIITEMS_DPC'][47]='_fromhere;use selected category (default);στην επιλεγμένη κατηγορία (προεπιλογή)';
$__LOCALE['RCEDIITEMS_DPC'][48]='_nofilter;Warning: Without filter may affect all objects;Προειδοποίηση: Χωρίς επιλεγμένο φίλτρο ενδέχεται να επηρεαστούν όλα τα αντικείμενα';
$__LOCALE['RCEDIITEMS_DPC'][49]='_catsetupdate;Update item category;Με ενημέρωση κατηγορίας είδους';
$__LOCALE['RCEDIITEMS_DPC'][50]='_selectsource;Select data source;Επιλογή προέλευσης';

class rcediitems {
	
	var $title, $prpath, $urlpath, $url;
	var $fields, $etlfields, $messages;
	var $iLimit, $lan, $exitcode, $catTitles;
	
	var $dac7, $indac7, $dacEnv;
		
    public function __construct() {
		
		$this->lan = getlocal();
	  
		$this->prpath = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');	
		$this->url = paramload('SHELL','urlbase');
		$this->title = localize('RCEDIITEMS_DPC', $lan);	
		
		$this->messages = array(); 
		$this->fields = array('id','datein','code3','code5','owner','itmactive','active','itmname','uniname1','ypoloipo1','price0','price1','manufacturer','size','color','cat0','cat1','cat2','cat3','cat4');	
		$this->etlfields = implode(',', $this->fields);
		
		$this->dac7 = _m('cmsrt.isDacRunning');
		$this->indac7 = _m('cmsrt.runningInsideDac');
		$this->dacEnv = GetGlobal('controller')->env;			
		
		$this->iLimit = ($this->indac7==true) ? 10000 : 500;//500; //200 //insert,update,delete loop limit
		$this->exitCode = '-001';
	}
	
    public function event($event=null) {
	
	    $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;

	    switch ($event) {
			
			case 'cpsaveediitems' :  $this->submit();
			                          break;
																		
			case 'cpediitems'     :
			default               :	 
        }			
			
    }	

    public function action($action=null)  { 	

        $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;
		
	    switch ($action) {										  									 
			
			case 'cpsaveediitems'      :
			case 'cpediitems'          : 
		    default                    : $this->catTitles = _m('rcpmenu.showCategoryTitles use +&nbsp;&gt;&nbsp;');	
			
                         			     //$out = $this->showEdiItems();
										 $out = $this->itemsEdiMode();	
		}		
		
        return ($out);
	}

	protected function itemsEdiMode() {
		$lan = getlocal();
		$mode = $this->currentMode(); //GetReq('mode') ? GetReq('mode') : 'edi';
        
		$turl0 = seturl('t=cpediitems&mode=edi');		
		$turl1 = seturl('t=cpediitems&mode=dif');
		$button = $this->createButton(localize('_mode', getlocal()), 
										array(localize('_edi', getlocal())=>$turl0,
										      localize('_dif', getlocal())=>$turl1,
		                                ),'success');		
																	
		switch ($mode) {
			
			case 'dif' :   $content = $this->itemsDIFgrid(null,140,5,'e', true); break;
			case 'edi' :   
			default    :   $content = $this->itemsEDIgrid(null,140,5,'e', true);
		}			
					
		$ret = $this->window(localize('_ediitems', $lan).': '.
							localize('_selectsource', $lan).' &gt; '.
							localize('_'.$mode, $lan), $button, $content);
		
		return ($ret);
	}
	
	public function showEdiItems() {
		
		return $this->itemsEDIgrid(null,140,5,'e', true);
	}	
	
	public function showfilter() {
		if (!$filter=GetParam('flt')) return null;
		if (!$fvalue=GetParam('val')) return null;
		$title = localize('_filter', $this->lan);
		
		if ($filter=='datein') {
			$now = time(); // or your date as well
			$_datein = strtotime($fvalue); //"2010-01-01");
			$datediff = $now - $_datein;

			$daysback =  round($datediff / (60 * 60 * 24));
			
			$title .= " : items updated before $daysback day(s)";
		}		
		else
			$title .= " ($filter : $fvalue)";
		
		return $title; 
	}	
	
	public function getFilter($name=false) {
		
		return ($name==true) ? GetReq('flt') : GetReq('val');
	}	
	
	public function noFilterWarning() {
		if ((!$filter=GetParam('flt')) || (!$fvalue=GetParam('val')))  
			return '<h3>' . localize('_nofilter',getlocal()) .'</h3>';
		
		return null;
	}		
	
	protected function whereFilter() {
		if (!$filter=GetParam('flt')) return null;
		if (!$fvalue=GetParam('val')) return null;
		
		if ($filter=='datein') {
			$now = time(); // or your date as well
			$_datein = strtotime($fvalue); //"2010-01-01");
			$datediff = $now - $_datein;

			$daysback =  round($datediff / (60 * 60 * 24));
			//echo " where DATE(datein) BETWEEN DATE( DATE_SUB( NOW() , INTERVAL $daysback DAY ) ) AND DATE ( NOW() )";
			return " where DATE(datein) BETWEEN DATE( DATE_SUB( NOW() , INTERVAL $daysback DAY ) ) AND DATE ( NOW() )";
		}
		
		$v = is_numeric($fvalue) ? $fvalue : "'$fvalue'";
		return " where $filter=" . $v; 
	}
	
	protected function itemsEDIgrid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = $this->lan ? $this->lan : 0;  
		$title = localize('_items', $lan); 
		$mode = "mode=" . $this->currentMode();
		
		$_wf = $this->whereFilter();
		$xsSQL = "SELECT * from (select {$this->etlfields}  from etlproducts $_wf) o ";		   
		   							
		_m("mygrid.column use grid1+id|".localize('id',$lan)."|2|0|");
		_m("mygrid.column use grid1+itmactive|".localize('_active',$lan)."|boolean|1|1:0");		
		_m("mygrid.column use grid1+active|".localize('_active',$lan)."|boolean|1|101:0|");
		_m("mygrid.column use grid1+datein|".localize('_date',$lan)."|link|5|cpediitems.php?$mode&flt=datein&val={datein}");	
		_m("mygrid.column use grid1+code3|".localize('_code',$lan)."|5|0|");
		_m("mygrid.column use grid1+code5|".localize('_code',$lan)."|link|5|cpediitems.php?$mode&flt=code5&val={code5}");	
		_m("mygrid.column use grid1+itmname|".localize('_title',$lan)."|10|0|");	
		_m("mygrid.column use grid1+cat0|".localize('_cat',$lan)."|link|5|cpediitems.php?$mode&flt=cat0&val={cat0}");	
		_m("mygrid.column use grid1+cat1|".localize('_cat',$lan)."|link|5|cpediitems.php?$mode&flt=cat1&val={cat1}");
		_m("mygrid.column use grid1+cat2|".localize('_cat',$lan)."|link|5|cpediitems.php?$mode&flt=cat2&val={cat2}");
		_m("mygrid.column use grid1+cat3|".localize('_cat',$lan)."|link|5|cpediitems.php?$mode&flt=cat3&val={cat3}");
		_m("mygrid.column use grid1+cat4|".localize('_cat',$lan)."|link|5|cpediitems.php?$mode&flt=cat4&val={cat4}");
		_m("mygrid.column use grid1+uniname1|".localize('_uniname1',$lan)."|5|0|");		
		_m("mygrid.column use grid1+ypoloipo1|".localize('_ypoloipo1',$lan)."|5|0|");			
		_m("mygrid.column use grid1+price0|".localize('_price0',$lan)."|5|0|");		
		_m("mygrid.column use grid1+price1|".localize('_price1',$lan)."|5|0|");			
		_m("mygrid.column use grid1+manufacturer|".localize('_manufacturer',$lan)."|link|5|cpediitems.php?$mode&flt=manufacturer&val={manufacturer}");//."|5|0|");
		_m("mygrid.column use grid1+size|".localize('_size',$lan)."|5|0|");
		_m("mygrid.column use grid1+color|".localize('_color',$lan)."|5|0|");
		_m("mygrid.column use grid1+owner|".localize('_owner',$lan)."|link|5|cpediitems.php?$mode&flt=owner&val={owner}");

		$out = _m("mygrid.grid use grid1+etlproducts+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}	
	
	protected function itemsDIFgrid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = $this->lan ? $this->lan : 0;  
		$title = localize('_items', $lan); 
		$mode = "mode=" . $this->currentMode();		
		
		$_wf = $this->whereFilter();
		$xsSQL = "SELECT * from (select {$this->etlfields}  from difproducts $_wf) o ";		   
		   							
		_m("mygrid.column use grid1+id|".localize('id',$lan)."|2|0|");
		_m("mygrid.column use grid1+itmactive|".localize('_active',$lan)."|boolean|1|1:0");		
		_m("mygrid.column use grid1+active|".localize('_active',$lan)."|boolean|1|101:0|");
		_m("mygrid.column use grid1+datein|".localize('_date',$lan)."|link|5|cpediitems.php?$mode&flt=datein&val={datein}");	
		_m("mygrid.column use grid1+code3|".localize('_code',$lan)."|5|0|");
		_m("mygrid.column use grid1+code5|".localize('_code',$lan)."|link|5|cpediitems.php?$mode&flt=code5&val={code5}");	
		_m("mygrid.column use grid1+itmname|".localize('_title',$lan)."|10|0|");	
		_m("mygrid.column use grid1+cat0|".localize('_cat',$lan)."|link|5|cpediitems.php?$mode&flt=cat0&val={cat0}");	
		_m("mygrid.column use grid1+cat1|".localize('_cat',$lan)."|link|5|cpediitems.php?$mode&flt=cat1&val={cat1}");
		_m("mygrid.column use grid1+cat2|".localize('_cat',$lan)."|link|5|cpediitems.php?$mode&flt=cat2&val={cat2}");
		_m("mygrid.column use grid1+cat3|".localize('_cat',$lan)."|link|5|cpediitems.php?$mode&flt=cat3&val={cat3}");
		_m("mygrid.column use grid1+cat4|".localize('_cat',$lan)."|link|5|cpediitems.php?$mode&flt=cat4&val={cat4}");
		_m("mygrid.column use grid1+uniname1|".localize('_uniname1',$lan)."|5|0|");		
		_m("mygrid.column use grid1+ypoloipo1|".localize('_ypoloipo1',$lan)."|5|0|");			
		_m("mygrid.column use grid1+price0|".localize('_price0',$lan)."|5|0|");		
		_m("mygrid.column use grid1+price1|".localize('_price1',$lan)."|5|0|");			
		_m("mygrid.column use grid1+manufacturer|".localize('_manufacturer',$lan)."|link|5|cpediitems.php?$mode&flt=manufacturer&val={manufacturer}");//."|5|0|");
		_m("mygrid.column use grid1+size|".localize('_size',$lan)."|5|0|");
		_m("mygrid.column use grid1+color|".localize('_color',$lan)."|5|0|");
		_m("mygrid.column use grid1+owner|".localize('_owner',$lan)."|link|5|cpediitems.php?$mode&flt=owner&val={owner}");

		$out = _m("mygrid.grid use grid1+difproducts+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}		
	
	
	protected function submit() { 	

		if ($this->dac7==true) {
			//when in dac mode submit is all at once ()see async/ppost/bshopplus_rchandleitems_submit
			
			//if ($this->savePostCookie()) {
			if (_m('cmsrt.savePostCookie')) {	
				
				//execute long running processs	
				$cmd = 'async/ppost/bshopplus_rcediitems_submit/';
				phpdac7\getT($cmd); //exec cmd and close tier
				
				$this->jsDialog('Start', localize('_lrp', getlocal()), 3000, 'cdact.php?t=texit');
				$this->messages[] = 'LRP started!';

				return true;	
			}
			else
				$this->messages[] = 'LRP failed!';	
		}
		else {		
		
			if (GetParam('moveincat')) {
				//echo 'a1';	
				$this->moveInCategory();
				return true;
			}
			elseif (GetParam('updincat')) {
				//echo 'a2';
				$this->updateInCategory();
				return true;
			}	
			elseif (GetParam('delincat')) {
				//echo 'a2';
				$this->deleteInCategory();
				return true;
			}		
			elseif (GetParam('createcat')) {
				//echo 'a2';
				$this->createCategory();
				return true;
			}
			elseif (GetParam('deletecat')) {
				//echo 'a2';
				$this->deleteCategory();
				return true;
			}		
		}
		
		return false;	
	}
	
	public function currentCategory() {
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$id = $cpGet['id'];  	
		
		return ($cat);
	}		
	
	public function showCategory() {
		
		return $this->catTitles;
	}
	
	public function currentMode() {	
		$mode = GetParam('mode') ? GetParam('mode') : GetReq('mode');	
		
		return $mode ? $mode : 'edi';
	}	

	public function currentTable() {	
		$mode = $this->currentMode();	
		
		switch ($mode) {
			case 'dif' : $tbl = 'difproducts'; break;
			case 'edi' :
			default    : $tbl = 'etlproducts';
		}	
		return ($tbl);
	}

	//remove item from difproducts table when inserted to products
	//leave etlproducts table as is when insert in case of dif procedures re-update the item
	protected function deleteFromDifTable($fcode, $value) {
		$db = GetGlobal('db'); 		
		if ((!$fcode) || (!$value)) return false;
		
		$sSQL = "delete from difproducts WHERE $fcode=" . $db->qstr($value);
		$res = $db->Execute($sSQL);
		
		return true;
	}		

	public function moveInCategory() {
		$db = GetGlobal('db'); 
		//$cpGet = _v('rcpmenu.cpGet');
		//$cat = $cpGet['cat'];
		
		//is post param for html post or dac7 lrp
		if ($cat = GetParam('cat')) { 
			
			$csep = _m('cmsrt.sep');
			$fcode = _v('cmsrt.fcode');
			$aliasID = _m('cmsrt.useUrlAlias');	
		
			$_cat = explode($csep, $cat);			

			//clear log files
			if (GetParam('logclear')) {
				@unlink($this->prpath . 'edi-ins-counter.log');
				@unlink($this->prpath . 'edi-insert.log');
			}	

			//parameters
			$catFromRoot= GetParam('catfromroot') ? 1 : 0;
			$catOverRoot= GetParam('catoverroot') ? 1 : 0;
			$slug = GetParam('slugon') ? 1 : 0;
			$greeklish = GetParam('sluggreekon') ? 1 : 0;			
		
		    $_wf = $this->whereFilter();
			$tbl = $this->currentTable();
			$sSQL = "select " .$this->etlfields. " from $tbl ";
			$sSQL.= $_wf ? $_wf . ' and active>0 and itmactive>0' : 
								' where active>0 and itmactive>0' ;
			$items = $db->Execute($sSQL);
			if (empty($items)) return false;
			
			$_x = @file_get_contents($this->prpath . 'edi-ins-counter.log');
			$x = $_x ? $_x : 1;
			foreach ($items as $zi=>$rec) {
				if (($_x) && ($zi < $_x)) continue;
				if ($x == $_x + $this->iLimit) {
					
					file_put_contents($this->prpath . 'edi-ins-counter.log', $x);
					
					//$this->messages[] = '(' . $x . ') Press submit to continue...';
					$this->_echo('(' . $x . ') Press submit to continue...');

					return true;
				}
				
				$cc = array();	//reset
				if ($catFromRoot) {//fetch whole tree
					$ix = 0;
					//first current selection
					for ($i=0;$i<5;$i++) {
						if ($_cat[$i]) {
							$_c = _m("cmsrt.replace_spchars use ".$_cat[$i]."+1");
							$ix+=1;
							$cc[] = $db->qstr($_c);
						}
					}
					//after add product tree ( -ix = minus selection subcats)
					for ($i=0;$i<(5-$ix);$i++) {
						$slugcat = $slug ? ($greeklish ? _m('cmsrt.slugstr use '. $rec["cat$i"]) : strtolower($rec["cat$i"])) : $rec["cat$i"];
						$cc[] = $slugcat ? $db->qstr($this->_mkcat($slugcat)) : "''";
					}		
				}
				elseif ($catOverRoot) { //fetch subcats from the end of current tree				
					for ($i=0;$i<5;$i++) {					
						if ($_cat[$i]) {
							$_c = _m("cmsrt.replace_spchars use ".$_cat[$i]."+1");
							$cc[] = $db->qstr($_c);
						}
						else {
							$slugcat = $slug ? ($greeklish ? _m('cmsrt.slugstr use '. $rec["cat$i"]) : strtolower($rec["cat$i"])) : $rec["cat$i"];
							$cc[] = $slugcat ? $db->qstr($this->_mkcat($slugcat)) : "''";
						}
					}
				}
				else { //selected category
					for ($i=0;$i<5;$i++) {
							$_c = _m("cmsrt.replace_spchars use ".$_cat[$i]."+1");
							$cc[] = $_c ? $db->qstr($_c) : "''";
					}	
				}					
				$_cc = implode($csep, $cc);
				$sSQL = "select $fcode from products where $fcode = " . $db->qstr($rec[$fcode]);
				$check = $db->Execute($sSQL);
				
				if ($check->fields[0]) {
					//$this->messages[] = $x . ' ' . $rec[$fcode] . ' exists ';
					$this->_echo($x . ' ' . $rec[$fcode] . ' exists ');
					
					//already removed
					//if (($tbl=='difproducts') && ($rdif = $this->deleteFromDifTable($fcode, $rec[$fcode])))
						//$this->_echo($x . ' ' . $rec[$fcode] . ' removed from diffs ');		
				}
				else {
					
					$_xc = count($this->fields);
					$_fields = array(); //reset
					$_farr = array(); //reset
					for ($i=2;$i<$_xc -5;$i++) { //2 to -5 = cat fields, replace with implode
						$_f = $this->fields[$i];	
						$_farr[] = $_f;
						$_fields[] = is_numeric($rec[$_f]) ? $rec[$_f] : $db->qstr($rec[$_f]);
					}
					$fields = implode(',', $_farr); //$this->etlfields;		
					
					if (($slug) && ($aliasID)) {
						//$aliasID = _m('cmsrt.useUrlAlias');		
						$sSQL = "insert into products ($fields,cat0,cat1,cat2,cat3,cat4,$aliasID) values (";
					}				
					else
						$sSQL = "insert into products ($fields,cat0,cat1,cat2,cat3,cat4) values (";
					$sSQL.= implode(',', $_fields);
					$sSQL.= ",";	
					$sSQL.= implode(',', $cc);
					if ($slug) {
						$_itmname = _m('cmsrt.stralias use '.$rec['itmname']);
						$sSQL.= ",'" . ($greeklish ? _m('cmsrt.slugstr use '.$rec['itmname']) : $_itmname) . "'";
					}	
					$sSQL.= ")";	
					
					if (GetParam('dbset')) {
						$res = $db->Execute($sSQL);
						
						if (($tbl=='difproducts') && ($rdif = $this->deleteFromDifTable($fcode, $rec[$fcode])))
						{} //$this->_echo($x . ' ' . $rec[$fcode] . ' removed from difs ');
					}	
					if (GetParam('logset'))
						file_put_contents($this->prpath . 'edi-insert.log', $sSQL . ";\r\n", FILE_APPEND | LOCK_EX);
				
					$with = $slug ? ($greeklish ? 'with greeklish slug ':' with slug ') : '';
					//$this->messages[] = $x .' '. $rec[$fcode] .' Inserted ' . $with; 
					$this->_echo($x .' '. $rec[$fcode] .' Inserted ' . $with);
				}
				$x+=1;	
			}	
			
			@unlink($this->prpath . 'edi-ins-counter.log');
			return true;
		}
		else
			//$this->messages[] = 'There is no selected category';
			$this->_echo('There is no selected category');
		
		return false;
	}

	/* https://stackoverflow.com/questions/5727827/update-one-mysql-table-with-values-from-another
		UPDATE tobeupdated
		INNER JOIN original ON (tobeupdated.value = original.value)
		SET tobeupdated.id = original.id
	*/	
	public function updateInCategory() {
		$db = GetGlobal('db'); 
		//$cpGet = _v('rcpmenu.cpGet');
		//$cat = $cpGet['cat'];
		
		//is post param for html post or dac7 lrp
		if ($cat = GetParam('cat')) { 
		
			$csep = _m('cmsrt.sep');
			$fcode = _v('cmsrt.fcode');
			$aliasID = _m('cmsrt.useUrlAlias');	
		
			$_cat = explode($csep, $cat);		
		
			//clear log files
			if (GetParam('logclear')) {
				@unlink($this->prpath . 'edi-upd-counter.log');
				@unlink($this->prpath . 'edi-update.log');
			}		
			
			//params
			$categoryUpdate = GetParam('catupd');
			$catFromRoot= GetParam('catfromroot') ? 1 : 0;
			$catOverRoot= GetParam('catoverroot') ? 1 : 0;
			$slug = GetParam('slugon') ? 1 : 0;
			$greeklish = GetParam('sluggreekon') ? 1 : 0;				
		
			$_wf = $this->whereFilter();
			$tbl = $this->currentTable();
			$sSQL = "select " .$this->etlfields. " from $tbl ";
			$sSQL.= $_wf ? $_wf . ' and active>0 and itmactive>0' : 
								' where active>0 and itmactive>0' ;			
			$items = $db->Execute($sSQL);
			if (empty($items)) return false;
			
			$_x = @file_get_contents($this->prpath . 'edi-upd-counter.log');
			$x = $_x ? $_x : 1;
			foreach ($items as $zi=>$rec) {
				if (($_x) && ($zi < $_x)) continue;
				if ($x == $_x + $this->iLimit) {
					
					file_put_contents($this->prpath . 'edi-upd-counter.log', $x);
					
					//$this->messages[] = '(' . $x . ') Press submit to continue...';
					$this->_echo('(' . $x . ') Press submit to continue...');

					return true;
				}	
				
				if ($categoryUpdate) { //if category update
					
				$cc = array();	//reset
				if ($catFromRoot) {//fetch whole tree
					$ix = 0;
					//first current selection
					for ($i=0;$i<5;$i++) {
						if ($_cat[$i]) {
							$_c = _m("cmsrt.replace_spchars use ".$_cat[$i]."+1");
							$ix+=1;
							$cc[] = "cat$i=" . $db->qstr($_c);
						}
					}
					//after add product tree ( -ix = minus selection subcats)
					for ($i=0;$i<(5-$ix);$i++) {
						$slugcat = $slug ? ($greeklish ? _m('cmsrt.slugstr use '. $rec["cat$i"]) : strtolower($rec["cat$i"])) : $rec["cat$i"];
						$cc[] = $slugcat ? $db->qstr($this->_mkcat($slugcat)) : "''";
					}		
				}
				elseif ($catOverRoot) { //fetch subcats from the end of current tree					
					for ($i=0;$i<5;$i++) {
					
						if ($_cat[$i]) {
							$_c = _m("cmsrt.replace_spchars use ".$_cat[$i]."+1");
							$cc[] = "cat$i=" . $db->qstr($_c);
						}
						else {
							$slugcat = $slug ? ($greeklish ? _m('cmsrt.slugstr use '. $rec["cat$i"]) : strtolower($rec["cat$i"])) : $rec["cat$i"];
							$cc[] = $slugcat ? $db->qstr($this->_mkcat($slugcat)) : "''";
						}
					}
				}
				else { //selected category
					for ($i=0;$i<5;$i++) {
					
						if ($_cat[$i]) {
							$_c = _m("cmsrt.replace_spchars use ".$_cat[$i]."+1");
							$cc[] = "cat$i=" . $db->qstr($_c);
						}
					}	
				}	
				$_cc = implode($csep, $cc);
				} //if category update
				
				$sSQL = "select $fcode from products where $fcode = " . $db->qstr($rec[$fcode]);
				$check = $db->Execute($sSQL);
				
				if (!$check->fields[0]) {
					//$this->messages[] = $x . ' ' . $rec[$fcode] . ' not exists ';
					$this->_echo($x . ' ' . $rec[$fcode] . ' not exists ');
					
					//already removed
					//if (($tbl=='difproducts') && ($rdif = $this->deleteFromDifTable($fcode, $rec[$fcode])))
						//$this->_echo($x . ' ' . $rec[$fcode] . ' removed from diffs ');							
				}
				else {
					
					$_xc = count($this->fields);
					$_fields = array(); //reset
					for ($i=2;$i<$_xc -5;$i++) { //2 to -5 = cat fields, replace with implode
						$_f = $this->fields[$i];	
						$_fields[] = is_numeric($rec[$_f]) ? $_f . '=' . $rec[$_f] : $_f . '=' . $db->qstr($rec[$_f]);
					}
				
					$sSQL = "update products set ";
					$sSQL.= implode(',', $_fields);
					if ($categoryUpdate) {
						$sSQL.= ",";	
						$sSQL.= implode(',', $cc);	
					}
					//slug
					if (($slug) && ($aliasID)) {
						$_itmname = _m('cmsrt.stralias use '.$rec['itmname']);
						//$aliasID = _m('cmsrt.useUrlAlias');	
						$sSQL.= ", $aliasID = '" . ($greeklish ? _m('cmsrt.slugstr use '.$rec['itmname']) : $_itmname) . "'";		
					}	
					$sSQL.= " where $fcode = " . $db->qstr($rec[$fcode]);
					
					if (GetParam('dbset')) {
						$res = $db->Execute($sSQL);
						
						if (($tbl=='difproducts') && ($rdif = $this->deleteFromDifTable($fcode, $rec[$fcode])))
							{} //$this->_echo($x . ' ' . $rec[$fcode] . ' removed from difs ');						
					}	
					if (GetParam('logset'))
						file_put_contents($this->prpath . 'edi-update.log', $sSQL . ";\r\n", FILE_APPEND | LOCK_EX);
				
					$with = $slug ? ($greeklish ? 'with greeklish slug ':' with slug ') : '';
					//$this->messages[] = $x .' '. $rec[$fcode] .' Updated ' . $with;
					$this->_echo($x .' '. $rec[$fcode] .' Updated ' . $with);
				}
				$x+=1;	
			}	
			
			@unlink($this->prpath . 'edi-upd-counter.log');
			return true;
		}
		else
			//$this->messages[] = 'There is no selected category';
			$this->_echo('There is no selected category');
		
		return false;
	}	
	
	public function deleteInCategory() {
		$db = GetGlobal('db'); 
		//$cpGet = _v('rcpmenu.cpGet');
		//$cat = $cpGet['cat'];
		
		//is post param for html post or dac7 lrp
		if ($cat = GetParam('cat')) { 
			
			$csep = _m('cmsrt.sep');
			$fcode = _v('cmsrt.fcode');
		
			$_cat = explode($csep, $cat);			

			//clear log files
			if (GetParam('logclear')) {
				@unlink($this->prpath . 'edi-del-counter.log');
				@unlink($this->prpath . 'edi-delete.log');
			}		
		
			$_wf = $this->whereFilter();
			$tbl = $this->currentTable();
			$sSQL = "select " .$this->etlfields. " from $tbl ";
			$sSQL.= $_wf ? $_wf . ' and active>0 and itmactive>0' : 
								' where active>0 and itmactive>0' ;			
			$items = $db->Execute($sSQL);
			if (empty($items)) return false;
			
			$_x = @file_get_contents($this->prpath . 'edi-del-counter.log');
			$x = $_x ? $_x : 1;
			foreach ($items as $zi=>$rec) {
				if (($_x) && ($zi < $_x)) continue;
				if ($x == $_x + $this->iLimit) {
					
					file_put_contents($this->prpath . 'edi-del-counter.log', $x);
					
					//$this->messages[] = '(' . $x . ') Press submit to continue...';
					$this->_echo('(' . $x . ') Press submit to continue...');
					
					return true;
				}	
				
				$sSQL = "select $fcode from products where $fcode = " . $db->qstr($rec[$fcode]);
				$check = $db->Execute($sSQL);
				
				if (!$check->fields[0]) {
					//$this->messages[] = $x . ' ' . $rec[$fcode] . ' not exists ';
					$this->_echo($x . ' ' . $rec[$fcode] . ' not exists ');
				}
				else {

					$sSQL = "delete from products";
					$sSQL.= " where $fcode = " . $db->qstr($rec[$fcode]);
					
					if (GetParam('dbset')) {
						$res = $db->Execute($sSQL);
						
						//delete attachments
						$sSQL2 = "delete from pattachments";
						$sSQL2.= " where code = " . $db->qstr($rec[$fcode]);
						$res = $db->Execute($sSQL2);
					}	
					if (GetParam('logset'))
						file_put_contents($this->prpath . 'edi-delete.log', $sSQL . ";\r\n", FILE_APPEND | LOCK_EX);
				
					//$this->messages[] = $x .' '. $rec[$fcode] .' Deleted ';//$res ? $sSQL : $rec[0] . " error ($sSQL)";
					$this->_echo($x .' '. $rec[$fcode] .' Deleted ');
				}
				$x+=1;	
			}	
			
			@unlink($this->prpath . 'edi-del-counter.log');
			return true;
		}
		else
			//$this->messages[] = 'There is no selected category';
			$this->_echo('There is no selected category');
		
		return false;
	}
	
	
	public function createCategory() {
		$db = GetGlobal('db'); 
		//$cpGet = _v('rcpmenu.cpGet');
		//$cat = $cpGet['cat'];
		
		//is post param for html post or dac7 lrp
		if ($cat = GetParam('cat')) { 
			
			$csep = _m('cmsrt.sep');
			$fcode = _v('cmsrt.fcode');
			$lan = $this->lan ? $this->lan : '0';
		
			$_cat = explode($csep, $cat);			

			//clear log files
			if (GetParam('logclear')) {
				@unlink($this->prpath . 'edi-insert-categories.log');
			}	
			
			//fetch current category alias names
			$sSQL = "select DISTINCT cat1,cat2,cat3,cat4,cat5,cat01,cat02,cat03,cat04,cat05,cat11,cat12,cat13,cat14,cat15 from categories ";
			foreach ($_cat as $cid=>$ccat)
				$sql[] = "cat" . strval($cid+2) . "='" . _m("cmsrt.replace_spchars use $ccat+1") . "'";
			$sSQL.= ' WHERE ' . implode(' AND ', $sql);			
			//echo $sSQL;
			$cres = $db->Execute($sSQL);
		
		    //param
			$slug = GetParam('slugon') ? 1 : 0;	
			$greeklish = GetParam('sluggreekon') ? 1 : 0;		
			$active = GetParam('catact') ? 1 : 0;
			$view = GetParam('catview') ? 1 : 0;
			$search = GetParam('catsearch') ? 1 : 0;
			$createCatFromRoot= GetParam('createcatfromroot') ? 1 : 0;
		
			$_wf = $this->whereFilter();
			$tbl = $this->currentTable();
			$sSQL = "select DISTINCT cat0,cat1,cat2,cat3,cat4 from $tbl ";
			$sSQL.= $_wf ? $_wf . ' and active>0 and itmactive>0' : 
								' where active>0 and itmactive>0' ;			
			//echo $sSQL;					
			$res = $db->Execute($sSQL);
			if (empty($res)) return false;
			
			$x = 1;
			foreach ($res as $zi=>$rec) {
				
				$cc = array();	//reset mkcat replacements
				$ccalias = array();	//reset use for original text
				if ($createCatFromRoot) {//fetch whole tree
					$ix = 0;
					//first current selection
					for ($i=0;$i<4;$i++) {
						if ($_cat[$i]) {
							$_c = _m("cmsrt.replace_spchars use ".$_cat[$i]."+1");
							$ix+=1;
							$cc[] = $db->qstr($_c);
							$ccalias[] = $db->qstr($cres->fields('cat'.$lan.strval($i+2))); 
						}
					}
					//after add product tree ( -ix = minus selection subcats)
					for ($i=0;$i<(4-$ix);$i++) {
						$cccat = $slug ? strtolower($rec["cat$i"]) : $rec["cat$i"];		
						$slugcat = $greeklish ? _m('cmsrt.slugstr use '. $rec["cat$i"]) : $cccat;
						$cc[] = $slugcat ? $db->qstr($this->_mkcat($slugcat)) : "''";							
						$ccalias[] = $rec["cat$i"] ? $db->qstr($rec["cat$i"]) : "''";	
					}		
				}
				else { //fetch subcats from the end of current tree
					for ($i=0;$i<4;$i++) { //to 4 not 5 (ITEMS at start)
					
						if ($_cat[$i]) {
							$_c = _m("cmsrt.replace_spchars use ".$_cat[$i]."+1");
							$cc[] = $db->qstr($_c);
							$ccalias[] = $db->qstr($cres->fields('cat'.$lan.strval($i+2))); 
						}
						else {
							$cccat = $slug ? strtolower($rec["cat$i"]) : $rec["cat$i"];		
							$slugcat = $greeklish ? _m('cmsrt.slugstr use '. $rec["cat$i"]) : $cccat;
							$cc[] = $slugcat ? $db->qstr($this->_mkcat($slugcat)) : "''";							
							$ccalias[] = $rec["cat$i"] ? $db->qstr($rec["cat$i"]) : "''";
						}	
					}
				}
				$_cc = implode(',', $cc);
				$_ccalias = implode(',', $ccalias);
				$_id = hash('crc32', implode('', $cc));
				//print_r($cc); echo $ix;
				$sSQL = "select ctgoutline from categories where ctgoutline = '$_id'";
				$check = $db->Execute($sSQL);
				
				if ($check->fields[0]) {
					//$this->messages[] = $x . ' Exist ' . $_cc;
					$this->_echo($x . ' Exist ' . $_cc);
				}
				else {	
					$sSQL = "insert into categories (ctgid,ctgoutline,cat1,cat2,cat3,cat4,cat5,active,view,search,cat01,cat02,cat03,cat04,cat05,cat11,cat12,cat13,cat14,cat15) values (";
					$sSQL.= "1,'$_id','ITEMS',"; //cthid must be set to be shown
					$sSQL.= $_cc;	
					$sSQL.= ", $active, $view, $search";
					$sSQL.= ",'ITEMS',";
					$sSQL.= $_ccalias;
					$sSQL.= ",'ITEMS',";
					$sSQL.= $_ccalias;				
					$sSQL.= ")";
					//echo $sSQL;
										
					if (GetParam('dbset'))
						$res = $db->Execute($sSQL);
					if (GetParam('logset'))
						file_put_contents($this->prpath . 'edi-insert-categories.log', $sSQL . ";\r\n", FILE_APPEND | LOCK_EX);

					$with = $slug ? ($greeklish ? 'with greeklish slug ':' with slug ') : '';
					//$this->messages[] = $x . ' Inserted '. $with . $_cc;
					$this->_echo($x . ' Inserted '. $with . $_cc);
				}
				$x+=1;
			}	
			
			return true;
		}
		else
			//$this->messages[] = 'There is no selected category';	
			$this->_echo('There is no selected category');
		
		return false;
	}	
	
	public function deleteCategory() {
		$db = GetGlobal('db'); 
		//$cpGet = _v('rcpmenu.cpGet');
		//$cat = $cpGet['cat'];
		
		//is post param for html post or dac7 lrp
		if ($cat = GetParam('cat')) { 
		
			$csep = _m('cmsrt.sep');
			$fcode = _v('cmsrt.fcode');
		
			$_cat = explode($csep, $cat);		
		
			//clear log files
			if (GetParam('logclear')) {
				@unlink($this->prpath . 'edi-delete-categories.log');
			}		
			
			//params
			$slug = GetParam('slugon') ? 1 : 0;	
			$greeklish = GetParam('sluggreekon') ? 1 : 0;	
			$deleteCatFromRoot= GetParam('deletecatfromroot') ? 1 : 0;	
		
			$_wf = $this->whereFilter();
			$tbl = $this->currentTable();
			$sSQL = "select DISTINCT cat0,cat1,cat2,cat3,cat4 from $tbl ";
			$sSQL.= $_wf ? $_wf . ' and active>0 and itmactive>0' : 
								' where active>0 and itmactive>0' ;			
			$res = $db->Execute($sSQL);
			if (empty($res)) return false;
			
			$x = 1;
			foreach ($res as $zi=>$rec) {
				
				$cc = array();	//reset mkcat replacements
				$ccalias = array();	//reset use for original text
				
				if ($deleteCatFromRoot) {//fetch whole tree
					$ix = 0;
					//first current selection
					for ($i=0;$i<4;$i++) {
						if ($_cat[$i]) {
							$_c = _m("cmsrt.replace_spchars use ".$_cat[$i]."+1");
							$ix+=1;
							$cc[] = $db->qstr($_c);
							$ccalias[] = $db->qstr($_c); //delete based on id
						}
					}
					//after add product tree ( -ix = minus selection subcats)
					for ($i=0;$i<(4-$ix);$i++) {
						$cccat = $slug ? strtolower($rec["cat$i"]) : $rec["cat$i"];	
						$slugcat = $greeklish ? _m('cmsrt.slugstr use '. $rec["cat$i"]) : $cccat;
						$cc[] = $slugcat ? $db->qstr($this->_mkcat($slugcat)) : "''";							
						$ccalias[] = $rec["cat$i"] ? $db->qstr($rec["cat$i"]) : "''";	
					}		
				}
				else { //fetch subcats from the end of current tree				
					for ($i=0;$i<4;$i++) { //to 4 not 5 (ITEMS at start)
					
						if ($_cat[$i]) {
							$_c = _m("cmsrt.replace_spchars use ".$_cat[$i]."+1");
							$cc[] = $db->qstr($_c);
							$ccalias[] = $db->qstr($_c); //delete based on id
						}
						else {
							$cccat = $slug ? strtolower($rec["cat$i"]) : $rec["cat$i"];	
							$slugcat = $greeklish ? _m('cmsrt.slugstr use '. $rec["cat$i"]) : $cccat;
							$cc[] = $slugcat ? $db->qstr($this->_mkcat($slugcat)) : "''";							
							$ccalias[] = $rec["cat$i"] ? $db->qstr($rec["cat$i"]) : "''";						
						}	
					}
				}
				$_cc = implode($csep, $cc);
				$_ccalias = implode(',', $ccalias);
				$_id = hash('crc32', implode('', $cc));
				//print_r($cc);
				$sSQL = "select ctgoutline from categories where ctgoutline = '$_id'"; //based on id
				$check = $db->Execute($sSQL);
				
				if (!$check->fields[0]) {
					//$this->messages[] = $x . ' not exist ' . $_cc;
					$this->_echo($x . ' not exist ' . $_cc);
				}
				else {				
					$sSQL = "delete from categories where ctgoutline='$_id'";
					
					if (GetParam('dbset'))
						$res = $db->Execute($sSQL);
					if (GetParam('logset'))
						file_put_contents($this->prpath . 'edi-delete-categories.log', $sSQL . ";\r\n", FILE_APPEND | LOCK_EX);
				
					$with = $slug ? ($greeklish ? 'with greeklish slug ':' with slug ') : '';
					//$this->messages[] = $x . ' Deleted ' . $with . $_cc;
					$this->_echo($x . ' Deleted ' . $with . $_cc);
				}
				$x+=1;
			}	
			
			return true;
		}
		else
			//$this->messages[] = 'There is no selected category';		
			$this->_echo('There is no selected category');
		
		return false;
	}

	//special char replacement
	protected function _mkcat($name=null) {
		if (!$name) return null;
		
		$ret = str_replace(
				array('/','-','.',',','(',')','&','\\','*',':'), 
				array(' ',' ','','','','','','','',''), 
				$name);
				
		return str_replace(array('----','---','--'),'-', $ret);		
	}
	
	public function viewMessages($template=null) {
		if (empty($this->messages)) return;
	    $t = ($template!=null) ? _m("cmsrt.select_template use $template+1") : null;
		
		foreach ($this->messages as $m=>$message) {
			if ($t) 	
				$ret .= $this->combine_tokens($t, array(0=>$message));
			else
				$ret .= "<option value=\"$m\">$message</option>";
		}
		return ($ret);
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
				$links .= '<li><a href="'.$url.'">'.$n.'</a></li>';
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
							<hr/><div id="cmsform"></div>
							</div>
							'.  $content .'
                        </div>
                  </div>
                </div>
            </div>
';
		return ($ret);
	}	
	
	protected function jsDialog($text=null, $title=null, $time=null, $source=null) {
	   $stay = $time ? $time : 3000;//2000;

       if (defined('JSDIALOGSTREAMSRV_DPC')) {
			$sd = new jsdialogStreamSrv();
			//$ret= $sd->streamDialog();
			
			if ($text)	
				$code = $sd->say($text, $title, $source, $stay);
			else
				$code = $sd->streamDialog('jsdtime');
		   
			$js = new jscript;	
			$js->load_js($code,null,1);		
			unset ($js);
	   }	
	}

	public function streamDialog() {
		
		return _m('rcpmenu.streamDialog');
	}	
	
	//say a message 
	protected function _echo($message=null, $type='TYPE_IRON') {
		if (!$message) return false;
		
		$this->messages[] = $message;
		
		if ($this->indac7==true) 
			$this->dacEnv->_say($message, $type);				
		
		return true;
	}		

};
}
?>