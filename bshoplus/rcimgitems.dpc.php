<?php
$__DPCSEC['RCIMGITEMS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ( (!defined("RCIMGITEMS_DPC")) && (seclevel('RCIMGITEMS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCIMGITEMS_DPC",true);

$__DPC['RCIMGITEMS_DPC'] = 'rcimgitems';

require_once(_r('images/wateresize.lib.php'));
require_once(_r('images/SimpleImage.lib.php'));

$__EVENTS['RCIMGITEMS_DPC'][0]='cpimgitems';
$__EVENTS['RCIMGITEMS_DPC'][1]='cpsaveimgitems';

$__ACTIONS['RCIMGITEMS_DPC'][0]='cpimgitems';
$__ACTIONS['RCIMGITEMS_DPC'][1]='cpsaveimgitems';

$__LOCALE['RCIMGITEMS_DPC'][0]='RCIMGITEMS_DPC;Image items;Διαχείριση φωτογραφειών ειδών';
$__LOCALE['RCIMGITEMS_DPC'][1]='_imgitems;Image items;Εικόνες ειδών';
$__LOCALE['RCIMGITEMS_DPC'][2]='_addimages;Insert images;Εισαγωγή εικόνων';
$__LOCALE['RCIMGITEMS_DPC'][3]='_date;Date;Ημερ.';
$__LOCALE['RCIMGITEMS_DPC'][4]='_time;Time;Ώρα';
$__LOCALE['RCIMGITEMS_DPC'][5]='_qty;Quantity;Ποσότητα';
$__LOCALE['RCIMGITEMS_DPC'][6]='_items;Items;Είδη';
$__LOCALE['RCIMGITEMS_DPC'][7]='_active;Active;Ενεργό';
$__LOCALE['RCIMGITEMS_DPC'][8]='_title;Title;Τίτλος';
$__LOCALE['RCIMGITEMS_DPC'][9]='_descr;Description;Περιγραφή';
$__LOCALE['RCIMGITEMS_DPC'][10]='_owner;Owner;Owner';
$__LOCALE['RCIMGITEMS_DPC'][11]='_color;Color;Χρώμα';
$__LOCALE['RCIMGITEMS_DPC'][12]='_code;Code;Κωδικός';
$__LOCALE['RCIMGITEMS_DPC'][13]='_dimensions;Dimension;Διαστάσεις';
$__LOCALE['RCIMGITEMS_DPC'][14]='_size;Size;Μέγεθος';
$__LOCALE['RCIMGITEMS_DPC'][15]='_dimensions;Dimensions;Διαστάσεις';
$__LOCALE['RCIMGITEMS_DPC'][16]='_xmlcreate;Create XML;Δημιούργησε XML';
$__LOCALE['RCIMGITEMS_DPC'][17]='_xml;XML item;Είδος XML';
$__LOCALE['RCIMGITEMS_DPC'][18]='_manufacturer;Manufacturer;Κατασκευαστής';
$__LOCALE['RCIMGITEMS_DPC'][19]='_uniname1;Unit;Μον.μετρ.';
$__LOCALE['RCIMGITEMS_DPC'][20]='_ypoloipo1;Qty;Υπόλοιπο';
$__LOCALE['RCIMGITEMS_DPC'][21]='_price0;Price 1;Αξία 1';
$__LOCALE['RCIMGITEMS_DPC'][22]='_price1;Price 2;Αξία 2';
$__LOCALE['RCIMGITEMS_DPC'][23]='_cat;Category;Κατηγορία';
$__LOCALE['RCIMGITEMS_DPC'][24]='_photodbrem;Remove photo from DB;Εξαγωγή εικόνας απο τη ΒΔ.';
$__LOCALE['RCIMGITEMS_DPC'][25]='_updateincategory;Update images;Μεταβολή εικόνων στην κατηγορία';
$__LOCALE['RCIMGITEMS_DPC'][26]='_insupd;Insert - Update;Εισαγωγή - Μεταβολή';
$__LOCALE['RCIMGITEMS_DPC'][27]='_remove;Remove;Διαγραφές';
$__LOCALE['RCIMGITEMS_DPC'][28]='_overwrite;Overwrite;Επικάλυψη παλαιών';
$__LOCALE['RCIMGITEMS_DPC'][29]='_deleteincategory;Delete images in category;Διαγραφή εικόνων στην κατηγορία';
$__LOCALE['RCIMGITEMS_DPC'][30]='_dblog;Affect database and logs;Ενημέρωση ΒΔ και αρχείο καταγραφής';
$__LOCALE['RCIMGITEMS_DPC'][31]='_dbset;Affect database;Ενημέρωση Βασης Δεδομένων';
$__LOCALE['RCIMGITEMS_DPC'][32]='_logset;Affect logs;Ενημέρωση αρχείων καταγραφής';
$__LOCALE['RCIMGITEMS_DPC'][33]='_logclear;Clear logs;Άδειασμα αρχείων καταγραφής';
$__LOCALE['RCIMGITEMS_DPC'][34]='_photodb;Add photo in DB;Εισαγωγή εικόνας στη ΒΔ.';
$__LOCALE['RCIMGITEMS_DPC'][35]='_filter;Filter;Φίλτρο';
$__LOCALE['RCIMGITEMS_DPC'][36]='_large;Large;Μεγάλες';
$__LOCALE['RCIMGITEMS_DPC'][37]='_medium;Medium;Μεσαίες';
$__LOCALE['RCIMGITEMS_DPC'][38]='_small;Small;Μικρές';
$__LOCALE['RCIMGITEMS_DPC'][39]='_options;Options;Ρυθμίσεις';
$__LOCALE['RCIMGITEMS_DPC'][40]='_lrp;Long Running Process;Long Running Process';
$__LOCALE['RCIMGITEMS_DPC'][42]='_edi;EDI Data;EDI Data';
$__LOCALE['RCIMGITEMS_DPC'][43]='_dif;DIF Data;DIF Data';
$__LOCALE['RCIMGITEMS_DPC'][44]='_mode;Select data source;Επιλογή προέλευσης';
$__LOCALE['RCIMGITEMS_DPC'][45]='_selectsource;Select data source;Επιλογή προέλευσης';

class rcimgitems {
	
	var $title, $prpath, $urlpath, $url;
	var $fields, $etlfields, $messages;
	
	var $encodeimageid, $restype, $photodb;
	var $photoquality, $mixphoto, $erase2db, $autoresize, $img_small, $img_medium, $img_large;
	var $iLimit, $catTitles;
	
	var $dac7, $indac7, $dacEnv;
		
    public function __construct() {
	  
		$this->prpath = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');	
		$this->url = paramload('SHELL','urlbase');
		$this->title = localize('RCIMGITEMS_DPC',getlocal());	
		
		$this->messages = array(); 
		$this->fields = array('id','datein','code3','code5','owner','itmactive','active','itmname','uniname1','ypoloipo1','price0','price1','manufacturer','size','color','cat0','cat1','cat2','cat3','cat4');	
		$this->etlfields = implode(',', $this->fields);
		
		$this->encodeimageid = remote_paramload('RCITEMS','encodeimageid',$this->prpath);
	    $this->photodb = remote_paramload('RCITEMS','photodb',$this->prpath);
		$this->restype = remote_paramload('RCITEMS','restype',$this->prpath);		
		
		$this->erase2db = remote_paramload('RCITEMS','erase2db',$this->prpath);	  
		$this->mixphoto = remote_paramload('RCITEMS','mixphoto',$this->prpath);	 
		$this->photoquality = remote_paramload('RCITEMS','photoquality',$this->prpath);
		
        $this->autoresize = remote_arrayload('RCITEMS','autoresize',$this->prpath);
		
		//3 sized scaled images
		$photo_bg = remote_paramload('RCITEMS','photobgpath',$this->prpath);		  
		$this->img_large = $photo_bg ? $this->urlpath ."/images/$photo_bg/" : $thubpath;	  	  
		$photo_md = remote_paramload('RCITEMS','photomdpath',$this->prpath);		  
		$this->img_medium = $photo_md ? $this->urlpath ."/images/$photo_md/" : $thubpath;	  	  
		$photo_sm = remote_paramload('RCITEMS','photosmpath',$this->prpath);		  
		$this->img_small = $photo_sm ? $this->urlpath ."/images/$photo_sm/" : $thubpath;	  
		
		$this->dac7 = _m('cmsrt.isDacRunning');
		$this->indac7 = _m('cmsrt.runningInsideDac');
		$this->dacEnv = GetGlobal('controller')->env;			

		$this->iLimit = ($this->indac7==true) ? 15000 : 500;//500;	
	}
	
    public function event($event=null) {
	
	    $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;

	    switch ($event) {
			
			case 'cpsaveimgitems' :  $this->submit();
			                          break;
																		
			case 'cpimgitems'     :
			default               :	
        }			
			
    }	

    public function action($action=null)  { 	

        $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;
		
	    switch ($action) {										  									 
			
			case 'cpsaveimgitems'      :
			case 'cpimgitems'          : 
		    default                    :$this->catTitles = _m('rcpmenu.showCategoryTitles use +&nbsp;&gt;&nbsp;'); 
			
										//$out = $this->showEdiItems();
										$out = $this->itemsEdiMode();
		}		
		
        return ($out);
	}
	
	protected function itemsEdiMode() {
		$lan = getlocal();
		$mode = $this->currentMode(); //GetReq('mode') ? GetReq('mode') : 'edi';
        
		$turl0 = seturl('t=cpimgitems&mode=edi');		
		$turl1 = seturl('t=cpimgitems&mode=dif');
		$button = $this->createButton(localize('_mode', getlocal()), 
										array(localize('_edi', getlocal())=>$turl0,
										      localize('_dif', getlocal())=>$turl1,
		                                ),'success');		
																	
		switch ($mode) {
			
			case 'dif' :   $content = $this->itemsDIFgrid(null,140,5,'e', true); break;
			case 'edi' :   
			default    :   $content = $this->itemsEDIgrid(null,140,5,'e', true);
		}			
					
		$ret = $this->window(localize('_imgitems', $lan).': '.
							localize('_selectsource', $lan).' &gt; '.
							localize('_'.$mode, $lan), $button, $content);
		
		return ($ret);
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
	
	public function showEdiItems() {
		
		return $this->itemsEDIgrid(null,140,5,'e', true);
	}
	
	public function showfilter() {
		if (!$filter=GetParam('flt')) return null;
		if (!$fvalue=GetParam('val')) return null;
		$title = localize('_filter',getlocal());
		
		if ($filter=='datein') {
			$now = time(); // or your date as well
			$_datein = strtotime($fvalue); //"2010-01-01");
			$datediff = $now - $_datein;

			$daysback =  round($datediff / (60 * 60 * 24));
			
			$title.= " : items updated before $daysback day(s)";
		}		
		else
			$title .= " ($filter : $fvalue)";
		
		return $title; 
	}
	
	public function getFilter($name=false) {
		
		return ($name==true) ? GetReq('flt') : GetReq('val');
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
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_items', getlocal()); 
		$mode = "mode=" . $this->currentMode();
		
		$_wf = $this->whereFilter();
		$xsSQL = "SELECT * from (select {$this->etlfields}  from etlproducts $_wf) o ";		   
		   							
		_m("mygrid.column use grid1+id|".localize('id',$lan)."|2|0|");
		_m("mygrid.column use grid1+itmactive|".localize('_active',$lan)."|boolean|1|1:0");		
		_m("mygrid.column use grid1+active|".localize('_active',$lan)."|boolean|1|101:0|");
		_m("mygrid.column use grid1+datein|".localize('_date',$lan)."|link|5|cpimgitems.php?$mode&flt=datein&val={datein}");	
		_m("mygrid.column use grid1+code3|".localize('_code',$lan)."|5|0|");
		_m("mygrid.column use grid1+code5|".localize('_code',$lan)."|link|5|cpimgitems.php?$mode&flt=code5&val={code5}");	
		_m("mygrid.column use grid1+itmname|".localize('_title',$lan)."|10|0|");	
		_m("mygrid.column use grid1+cat0|".localize('_cat',$lan)."|link|5|cpimgitems.php?$mode&flt=cat0&val={cat0}");	
		_m("mygrid.column use grid1+cat1|".localize('_cat',$lan)."|link|5|cpimgitems.php?$mode&flt=cat1&val={cat1}");
		_m("mygrid.column use grid1+cat2|".localize('_cat',$lan)."|link|5|cpimgitems.php?$mode&flt=cat2&val={cat2}");
		_m("mygrid.column use grid1+cat3|".localize('_cat',$lan)."|link|5|cpimgitems.php?$mode&flt=cat3&val={cat3}");
		_m("mygrid.column use grid1+cat4|".localize('_cat',$lan)."|link|5|cpimgitems.php?$mode&flt=cat4&val={cat4}");
		_m("mygrid.column use grid1+uniname1|".localize('_uniname1',$lan)."|5|0|");		
		_m("mygrid.column use grid1+ypoloipo1|".localize('_ypoloipo1',$lan)."|5|0|");			
		_m("mygrid.column use grid1+price0|".localize('_price0',$lan)."|5|0|");		
		_m("mygrid.column use grid1+price1|".localize('_price1',$lan)."|5|0|");			
		_m("mygrid.column use grid1+manufacturer|".localize('_manufacturer',$lan)."|link|5|cpimgitems.php?$mode&flt=manufacturer&val={manufacturer}");//."|5|0|");
		_m("mygrid.column use grid1+size|".localize('_size',$lan)."|5|0|");
		_m("mygrid.column use grid1+color|".localize('_color',$lan)."|5|0|");
		_m("mygrid.column use grid1+owner|".localize('_owner',$lan)."|link|5|cpimgitems.php?$mode&flt=owner&val={owner}");

		$out = _m("mygrid.grid use grid1+etlproducts+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}		
	
	protected function itemsDIFgrid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_items', getlocal()); 
		$mode = "mode=" . $this->currentMode();		
		
		$_wf = $this->whereFilter();
		$xsSQL = "SELECT * from (select {$this->etlfields}  from difproducts $_wf) o ";		   
		   							
		_m("mygrid.column use grid1+id|".localize('id',$lan)."|2|0|");
		_m("mygrid.column use grid1+itmactive|".localize('_active',$lan)."|boolean|1|1:0");		
		_m("mygrid.column use grid1+active|".localize('_active',$lan)."|boolean|1|101:0|");
		_m("mygrid.column use grid1+datein|".localize('_date',$lan)."|link|5|cpimgitems.php?$mode&flt=datein&val={datein}");	
		_m("mygrid.column use grid1+code3|".localize('_code',$lan)."|5|0|");
		_m("mygrid.column use grid1+code5|".localize('_code',$lan)."|link|5|cpimgitems.php?$mode&flt=code5&val={code5}");	
		_m("mygrid.column use grid1+itmname|".localize('_title',$lan)."|10|0|");	
		_m("mygrid.column use grid1+cat0|".localize('_cat',$lan)."|link|5|cpimgitems.php?$mode&flt=cat0&val={cat0}");	
		_m("mygrid.column use grid1+cat1|".localize('_cat',$lan)."|link|5|cpimgitems.php?$mode&flt=cat1&val={cat1}");
		_m("mygrid.column use grid1+cat2|".localize('_cat',$lan)."|link|5|cpimgitems.php?$mode&flt=cat2&val={cat2}");
		_m("mygrid.column use grid1+cat3|".localize('_cat',$lan)."|link|5|cpimgitems.php?$mode&flt=cat3&val={cat3}");
		_m("mygrid.column use grid1+cat4|".localize('_cat',$lan)."|link|5|cpimgitems.php?$mode&flt=cat4&val={cat4}");
		_m("mygrid.column use grid1+uniname1|".localize('_uniname1',$lan)."|5|0|");		
		_m("mygrid.column use grid1+ypoloipo1|".localize('_ypoloipo1',$lan)."|5|0|");			
		_m("mygrid.column use grid1+price0|".localize('_price0',$lan)."|5|0|");		
		_m("mygrid.column use grid1+price1|".localize('_price1',$lan)."|5|0|");			
		_m("mygrid.column use grid1+manufacturer|".localize('_manufacturer',$lan)."|link|5|cpimgitems.php?$mode&flt=manufacturer&val={manufacturer}");//."|5|0|");
		_m("mygrid.column use grid1+size|".localize('_size',$lan)."|5|0|");
		_m("mygrid.column use grid1+color|".localize('_color',$lan)."|5|0|");
		_m("mygrid.column use grid1+owner|".localize('_owner',$lan)."|link|5|cpimgitems.php?$mode&flt=owner&val={owner}");

		$out = _m("mygrid.grid use grid1+difproducts+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);   	
	}	
	
	protected function submit() { 

		if ($this->dac7==true) {
			//when in dac mode submit is all at once ()see async/ppost/bshopplus_rchandleitems_submit
			
			//if ($this->savePostCookie()) {
			if (_m('cmsrt.savePostCookie')) {	
				
				//execute long running processs	
				$cmd = 'async/ppost/bshopplus_rcimgitems_submit/';
				phpdac7\getT($cmd); //exec cmd and close tier
				
				$this->jsDialog('Start', localize('_lrp', getlocal()), 3000, 'cdact.php?t=texit');
				$this->messages[] = 'LRP started!';	
				
				return true;
			}
			else
				$this->messages[] = 'LRP failed!';	
		}
		else {		
		
			if (GetParam('imgincat')) { //insert - copy
				//echo 'a1';	
				$this->imgInCategory();
				return true;
			}
			elseif (GetParam('imgupdcat')) { //update -ovewrite
				//echo 'a1';	
				$this->imgUpdCategory();
				return true;
			}
			elseif (GetParam('imgdelcat')) { //delete -remove
				//echo 'a1';	
				$this->imgDelCategory();
				return true;
			}		
		}
		return false;	
	}
	
	public function currCategory() {
		
		return $this->catTitles;
	}

	public function imgInCategory($checkexist=false) {
		$db = GetGlobal('db'); 
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$csep = _m('cmsrt.sep');
		$fcode = _v('cmsrt.fcode');
		
		$_itype = $this->select_image_type();
		$_type = $this->select_image_type(true);
		$_cat = explode($csep, $cat);
		
		//if (!empty($_cat)) { //NOT DEPEND ON CATEGORY

			//clear log files
			if (GetParam('logclear')) {
				@unlink($this->prpath . 'edi-img-counter.log');
				@unlink($this->prpath . 'edi-images.log');
			}		
		
			$_wf = $this->whereFilter();
			$tbl = $this->currentTable();
			$sSQL = "select " .$this->etlfields. " from $tbl ";
			$sSQL.= $_wf ? $_wf . ' and active>0 and itmactive>0' : 
								' where active>0 and itmactive>0' ;			
			$items = $db->Execute($sSQL);
			if (empty($items)) return false;
			
			$_x = @file_get_contents($this->prpath . 'edi-img-counter.log');
			$x = $_x ? $_x : 1;
			foreach ($items as $zi=>$rec) {
				if (($_x) && ($zi < $_x)) continue;
				if ($x == $_x + $this->iLimit) { //300
				
					file_put_contents($this->prpath . 'edi-img-counter.log', $x);
					
					//$this->messages[] = '(' . $x . ') Press submit to continue...';
					$this->_echo('(' . $x . ') Press submit to continue...');

					return true;
				}				
				
				//check existance of small
				if (($checkexist==true) && ($this->exist_photo($rec[$fcode], $_type))) {
					$this->_echo($x . " ($_itype) Insert image:" . $rec[$fcode] . $this->restype . ' exists !');
				}	
				else {
					if ($this->add_photo($rec[$fcode], $_itype, $rec['owner'])) 				
					    $this->_echo($x ." ($_itype) Insert image:". $rec[$fcode] . $this->restype . ' inserted ');
					else
						$this->_echo($x . " ($_itype) " . $rec[$fcode] . $this->restype . ' not exist ');
				}
				$x+=1;	
			}	
			
			@unlink($this->prpath . 'edi-img-counter.log');
			return true;
		/*}
		else
			//$this->messages[] = 'There is no selected category';
			$this->_echo('There is no selected category');
		
		return false;
		*/
	}
	
	public function imgUpdCategory() {

		return $this->imgInCategory(true);
	}
	
	public function imgDelCategory() {
		$db = GetGlobal('db'); 
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$csep = _m('cmsrt.sep');
		$fcode = _v('cmsrt.fcode');
		
		$_itype = $this->select_image_type(true);
		$_cat = explode($csep, $cat);
		
		//if (!empty($_cat)) { //NOT DEPEND ON CATEGORY

			//clear log files
			if (GetParam('logclear')) {
				@unlink($this->prpath . 'edi-img-counter.log');
				@unlink($this->prpath . 'edi-images.log');
			}		
		
			$_wf = $this->whereFilter();
			$tbl = $this->currentTable();
			$sSQL = "select " .$this->etlfields. " from $tbl ";
			$sSQL.= $_wf ? $_wf . ' and active>0 and itmactive>0' : 
								' where active>0 and itmactive>0' ;			
			$items = $db->Execute($sSQL);
			if (empty($items)) return false;
			
			$_x = @file_get_contents($this->prpath . 'edi-img-counter.log');
			$x = $_x ? $_x : 1;
			foreach ($items as $zi=>$rec) {
				if (($_x) && ($zi < $_x)) continue;
				if ($x == $_x + $this->iLimit) { //300
				
					file_put_contents($this->prpath . 'edi-img-counter.log', $x);
					
					//$this->messages[] = '(' . $x . ') Press submit to continue...';
					$this->_echo('(' . $x . ') Press submit to continue...');
				
					return true;
				}				
				
				if ($this->delete_photo($rec[$fcode], $_itype)) 
				{
					switch ($_itype) {
						case 'LARGE' :  $this->delete_photo($rec[$fcode], 'MEDIUM');
										$this->delete_photo($rec[$fcode], 'SMALL');
										if (GetParam('photodbrem')) {
											$this->delete_photodb($rec[$fcode], 'LARGE');
											$this->delete_photodb($rec[$fcode], 'MEDIUM');
											$this->delete_photodb($rec[$fcode], 'SMALL');
										}
										break;
						case 'MEDIUM':  $this->delete_photo($rec[$fcode], 'SMALL');
										if (GetParam('photodbrem')) {
											$this->delete_photodb($rec[$fcode], 'MEDIUM');
											$this->delete_photodb($rec[$fcode], 'SMALL');
										}	
										break;
						case 'SMALL' :  if (GetParam('photodbrem'))
											$this->delete_photodb($rec[$fcode], 'SMALL');
										break;
					}

					//$this->messages[] = $x ." ($_itype) Delete image:". $rec[$fcode] . $this->restype . ' deleted ';					
					$this->_echo($x ." ($_itype) Delete image:". $rec[$fcode] . $this->restype . ' deleted ');
				}
				else
					//$this->messages[] = $x . " ($_itype) Delete image:" . $rec[$fcode] . $this->restype . ' not exists ';
					$this->_echo($x . " ($_itype) Delete image:" . $rec[$fcode] . $this->restype . ' not exists ');

				$x+=1;	
			}	
			
			@unlink($this->prpath . 'edi-img-counter.log');
			return true;
		/*}
		else
			//$this->messages[] = 'There is no selected category';
			$this->_echo('There is no selected category');
		
		return false;
		*/
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
	
	
	protected function select_image_type($str=false) {
		$large = GetParam('large') ? 1 : 0;
		$medium = GetParam('medium') ? 1 : 0;
		$small = GetParam('small') ? 1 :0;
		
		if ($large)
			return $str ? 'LARGE' : 3;
		elseif ($medium)
			return $str ? 'MEDIUM' : 2;
		elseif ($small)	
			return $str ? 'SMALL' : 1;
			
		return $str ? 'LARGE' : 3;	
	}
	
    protected function create_thumbnail($s, $file, $ptype, $uphotoid=null) {
		
		$f = $file . $this->restype;
		
		switch ($ptype) {
		
			  case 'SMALL' : //resize medium, small and save at once
							 //$this->messages[] = 'Autoresize:' . implode(' , ',$autoresize);
                             if (!empty($this->autoresize)) {							 
                               $image = new SimpleImage();
                               $image->load($s);
							   //$this->messages[] = 'Load small:' . $s;						   
							   
							   if ($dim_small = $this->autoresize[0]) {
                                 $image->resizeToWidth($dim_small);
                                 $image->save($this->img_small . $f);
								 //$this->messages[] = 'Save small:' . $img_small . $f;
								 
								 //auto add to db
								 if (GetParam('photodb'))
									$this->add_photo2db($file,$this->restype,'SMALL');
                               }
                               return 1;							   
							 }							 
			                 break;
							 
			  case 'MEDIUM' : //resize medium, small and save at once
                             if (!empty($this->autoresize)) {							 
                               $image = new SimpleImage();
                               $image->load($s);
							   
							   if ($dim_medium = $this->autoresize[1]) {
                                 $image->resizeToWidth($dim_medium);
                                 $image->save($this->img_medium . $f);
								 //auto add to db
								 if (GetParam('photodb'))
									$this->add_photo2db($file,$this->restype,'MEDIUM');
							   }							   
							   if ($dim_small = $this->autoresize[0]) {
                                 $image->resizeToWidth($dim_small);
                                 $image->save($this->img_small . $f);
								 //auto add to db
								 if (GetParam('photodb'))
									$this->add_photo2db($file,$this->restype,'SMALL');
                               }
                               return 1;							   
							 }
			                 break;
							 
			  case 'LARGE' : //resize large, medium and small and save at once	
                             if (!empty($this->autoresize)) {							 
                               $image = new SimpleImage();
                               $image->load($s);
							   
							   if ($dim_large = $this->autoresize[2]) {
                                 $image->resizeToWidth($dim_large);
                                 $image->save($this->img_large . $f);	
								 //auto add to db
								 if (GetParam('photodb'))
									$this->add_photo2db($file,$this->restype,'LARGE');
							   }								   
							   if ($dim_medium = $this->autoresize[1]) {
                                 $image->resizeToWidth($dim_medium);
                                 $image->save($this->img_medium . $f);	
								 //auto add to db
								 if (GetParam('photodb'))
									$this->add_photo2db($file,$this->restype,'MEDIUM');
							   }
							   if ($dim_small = $this->autoresize[0]) {
                                 $image->resizeToWidth($dim_small);
                                 $image->save($this->img_small . $f);	
								 //auto add to db
								 if (GetParam('photodb'))
									$this->add_photo2db($file,$this->restype,'SMALL');
							   }
                               return 1; 							   
							 }
			                 break;
							 							 							 
			  default      : //DEFAULT 1 sized photo
                             $path = $uphotoid ? 
							         $this->urlpath . remote_paramload('RCITEMS','adrespath',$this->prpath) : 
									 $this->urlpath . remote_paramload('RCITEMS','respath',$this->prpath);
							         
							 //resize large autoresize
                             if (!empty($this->autoresize)) {							 
                               $image = new SimpleImage();
                               $image->load($s);
							   						   
							   if ($dim_large = $this->autoresize[2]) {
                                 $image->resizeToWidth($dim_large);
                                 $image->save($path . $f);	
								 //auto add to db
								 if (GetParam('photodb'))
									$this->add_photo2db($file,$this->restype,'');
                               }
                               return 1;							   
							 }
                             //else
								//move_uploaded_file($s, $path . $f);
		}
		
		return false;
    }		
	
	
	protected function add_photo($id=null, $phototype=null, $dirname=null) {
		if (!$id) return;
		
		$subdir = $dirname ? "uploads/$dirname/" : 'uploads/images/';
		$tempFile = $this->prpath . $subdir . $id . $this->restype;
		//$this->messages[] = 'Load:' . $tempFile;
		
		if (is_readable($tempFile)) {	
     
			$targetName = $this->encode_image_id($id);			

			switch ($phototype) {
				case 1  : $this->create_thumbnail($tempFile, $targetName, 'SMALL'); break;
				case 2  : $this->create_thumbnail($tempFile, $targetName, 'MEDIUM'); break;
				case 3  :
				default : $this->create_thumbnail($tempFile, $targetName, 'LARGE');
			}
			
			return true;
		}
		
		return false;
	}
	
	protected function exist_photo($id, $type=null) {
		if (!$id) return;
		$ret = false;
		
		$f = $id . $this->restype;
		
		switch ($type) {
			case 'LARGE' : $ret = is_file($this->img_large . $f); break;
			case 'MEDIUM': $ret = is_file($this->img_medium . $f);break;
			case 'SMALL' : 
			default      : $ret = is_file($this->img_small . $f);
		}

		return $ret;	
	}	

	function delete_photo($id=null, $type=null) {
		$uid = null;
		
		//3 sized scaled images
		$photo_bg = remote_paramload('RCITEMS','photobgpath',$this->prpath);		  
		$img_large = $photo_bg ? $this->urlpath ."/images/$photo_bg/" : $thubpath;	  	  
		$photo_md = remote_paramload('RCITEMS','photomdpath',$this->prpath);		  
		$img_medium = $photo_md ? $this->urlpath ."/images/$photo_md/" : $thubpath;	  	  
		$photo_sm = remote_paramload('RCITEMS','photosmpath',$this->prpath);		  
		$img_small = $photo_sm ? $this->urlpath ."/images/$photo_sm/" : $thubpath;	  
			  
		$rp = remote_paramload('RCITEMS','respath',$this->prpath);		
		$rrp = $rp ? $this->urlpath . $rp : $this->urlpath . '/images/thub/';
		$rp2 = remote_paramload('RCITEMS','adrespath',$this->prpath);
		$rrp2 = $rp2 ? $this->urlpath . $rp2 : $this->urlpath . '/images/uphotos/';
		
		switch ($type) {
		    case 'SMALL' : $w = $img_small; break;
			case 'MEDIUM': $w = $img_medium; break;
			case 'LARGE' : $w = $img_large; break;
			case 'THUMB' : $w = $rrp; break;
			case 'UPHOTO': $w = $rrp2; 
			               $uid = GetReq('uid');
			               break;
		    default      : $w = $rrp;
		}

        $pic_file = $w . $id . $uid . $this->restype;
		
		if (file_exists($pic_file)) {
		  @unlink($pic_file);
		  return true;
		}  
		return false;
    }	
	
	protected function add_photo2db($itmcode=null, $type=null, $size=null) {
		if (!$itmcode) return;
		
		$db = GetGlobal('db');	
		$type = $type ? $type : $this->restype;	  
		$myfilename = $itmcode . $type; //already encoded $this->encode_image_id($itmcode) . $this->restype;	

		//handled by param
		//if (!$this->photodb) return;
	  
		//3 sized scaled images
		$photo_bg = remote_paramload('RCITEMS','photobgpath',$this->prpath);		  
		$img_large = $photo_bg ? $this->urlpath ."/images/$photo_bg/" : $thubpath;	  	  
		$photo_md = remote_paramload('RCITEMS','photomdpath',$this->prpath);		  
		$img_medium = $photo_md ? $this->urlpath ."/images/$photo_md/" : $thubpath;	  	  
		$photo_sm = remote_paramload('RCITEMS','photosmpath',$this->prpath);		  
		$img_small = $photo_sm ? $this->urlpath ."/images/$photo_sm/" : $thubpath;

		//DEFAULT 1 sized photo
        $path = $uphotoid ? remote_paramload('RCITEMS','adrespath',$this->prpath) : 
							remote_paramload('RCITEMS','respath',$this->prpath);		
	  
		switch ($size) {
			case "LARGE" :  $photo = $img_large . $myfilename; break;
			case "MEDIUM":  $photo = $img_medium . $myfilename; break;
			case "SMALL" :  $photo = $img_small . $myfilename; break;
			default      :  $photo = $path . $myfilename;
							$size = 'LARGE';		
		}  

		//echo $photo;	 
		if (is_readable($photo)) {   
			$sSQL = "select code from pphotos ";
			$sSQL .= " WHERE code='" . $itmcode . "' and type='". $type . "' and stype='". $size ."'";
			//echo $sSQL;
	  
			$resultset = $db->Execute($sSQL,2);	
			$result = $resultset;
			$exist = $db->Affected_Rows();
	  
			$data = base64_encode(@file_get_contents($photo));
	  
			//65535 chars limit...
			//else keep the file version in images dir...
			if (strlen($data)<65535) {//cuted pic when max that 65535 (text field max width)
	  
				if ($exist) {
					$sSQL = "update pphotos set data='". $data ."'";
					$sSQL .= " WHERE code='" . $itmcode . "' and type='" . $type ."'";
					if (isset($size))
						$sSQL .= " and stype='" . $size . "'";		  		  
				}
				else 
					$sSQL = "insert into pphotos (data,type,code,stype) values ('". $data ."','" . $type ."','" . $itmcode ."','".$size."')";  	  
	
				//echo $sSQL;	
	  
				$db->Execute($sSQL,1);	
				$affected = $db->Affected_Rows();
	  
				if (($affected) && ($this->erase2db))
					@unlink($photo); 	
			
			}//limit
			//else
			// echo '65535 limit!';
		}//is readable	
		return ($affected);  	  
	}
	
	protected function delete_photodb($id, $size=null) {
		$db = GetGlobal('db');
		$sizetype = $size ? $size : null;   
		
        $sSQL = "delete from pphotos ";
	    $sSQL .= " WHERE code='" . $id . "'";
	    if (isset($sizetype))
	      $sSQL .= " and stype='" . $sizetype . "'";
        else //is null
		  $sSQL .= " and stype=''";
		
        //echo $sSQL; 
	    $db->Execute($sSQL);
		
		return true;
	}	

	protected function encode_image_id($id=null) {
	    if (!$id) return null;

		$out = ($this->encodeimageid) ? md5($id) : $id;		
        return $out;
	}

	protected function watermark($s, $f) {
		$image2add = remote_paramload('RCITEMS','image2add',$this->path);
	
		if (is_file($s)) {
	        $process_img = new wateresize();
			$process_img->loadimg($s, 0, 0, 'jpg', 1, $this->urlpath, $this->image2add);
			$process_img->set_jpg_quality(filesize($s));
	        $ret = $process_img->saveimg($this->urlpath, $f);	
	        unset($process_img);		
		}   
	    else
			$ret = move_uploaded_file($s,$f);
				
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