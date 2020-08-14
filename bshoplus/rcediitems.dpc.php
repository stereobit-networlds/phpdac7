<?php
$__DPCSEC['RCEDIITEMS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ( (!defined("RCEDIITEMS_DPC")) && (seclevel('RCEDIITEMS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCEDIITEMS_DPC",true);

$__DPC['RCEDIITEMS_DPC'] = 'rcediitems';

$__EVENTS['RCEDIITEMS_DPC'][0]='cpediitems';
$__EVENTS['RCEDIITEMS_DPC'][1]='cpsaveediitems';

$__ACTIONS['RCEDIITEMS_DPC'][0]='cpediitems';
$__ACTIONS['RCEDIITEMS_DPC'][1]='cpsaveediitems';

$__LOCALE['RCEDIITEMS_DPC'][0]='RCEDIITEMS_DPC;Handle group items;Διαχείριση ειδών επιλογής';
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

class rcediitems {
	
	var $title, $prpath, $urlpath, $url;
	var $fields, $etlfields, $messages;
	var $iLimit, $lan, $exitcode;
		
    public function __construct() {
		
		$this->lan = getlocal();
	  
		$this->prpath = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');	
		$this->url = paramload('SHELL','urlbase');
		$this->title = localize('RCEDIITEMS_DPC', $lan);	
		
		$this->messages = array(); 
		$this->fields = array('id','datein','code3','code5','owner','itmactive','active','itmname','uniname1','ypoloipo1','price0','price1','manufacturer','size','color','cat0','cat1','cat2','cat3','cat4');	
		$this->etlfields = implode(',', $this->fields);
		
		$this->iLimit = 500; //200 //insert,update,delete loop limit
		$this->exitCode = '-001';
	}
	
    public function event($event=null) {
	
	    $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;

	    switch ($event) {
			
			case 'cpsaveediitems' :  $this->submit();
			                          break;
																		
			case 'cpediitems'     :
			default               :	 //$this->javascript(); //todo auto re-post
        }			
			
    }	

    public function action($action=null)  { 	

        $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;
		
	    switch ($action) {										  									 
			
			case 'cpsaveediitems'      :
			case 'cpediitems'          : 
		    default                    : $out = $this->showEdiItems();
		}		
		
        return ($out);
	}
	
	protected function javascript($enc=null) {	

        if (iniload('JAVASCRIPT')) {   
		
	        $code = $this->javascript_code();	
			
		    $js = new jscript;
            $js->load_js($code,null,1);   			   
		    unset ($js);
	    }	
	}		
	
	public function javascript_code()  {
		
	    $ajaxurl = seturl("t=");	
		$process = localize('_process',getlocal());
	
		$js = <<<EOF

function startediitems(subject, from, xcid, bid, isrecur)
{
    var s = $('#subject').val(); 
	var sub = subject ? subject : s;
	
	var f = $('#from').val(); 
	var frm = from ? from : f;
 
	var sbid = $('#bid').val();	
	var xbid = bid ? bid : parseInt(sbid);	
	
	var cid = xcid ? xcid : '{$this->cid}';	
	var to = isrecur ? '' : '&ulist=' + $('#tags_1').val();	
	
	var xc = '{$this->exitCode}';
	var lc = xc.length * -1;
	
	//$('#message_p').html('');
	str = $('#message_p').html();
	if (str.substr(lc) == xc) return; 
	
	$.ajax({
	  url: '{$ajaxurl}cpiscontent&cid='+cid+to,
	  type: 'GET',
	  success:function(datavalid) {		
	    if (datavalid == 1) {	
		
			$('#message_p').html('<img src="images/loading.gif" alt="Processing"> {$process}');
			
			setTimeout(function() { 

			  $.ajax({
				url: '{$ajaxurl}cpsaveediitems',
				type: 'POST',
				data: {FormAction: 'cpsaveediitems', xcid: cid, bid: xbid, subject: sub, from: frm},
				success:function(postdata) {
					if ((postdata.substr(lc)) == xc) {
						$('#message_p').html(postdata);
					}					
					else {	
						$('#message_p').append(postdata);				
						var nxbid = parseInt(postdata.substr(lc));
						setTimeout(function() { startediitems(sub, frm, cid, nxbid, 1);},5000);
					}
					//$('#message_p').html('');
				}
			  });
			}, 1000);  
		}
		else {
			$('#message_p').html(datavalid);
		}
	  }
	}); 
}		
EOF;
		return ($js);	
    }		
	
	public function showEdiItems() {
		
		return $this->items_grid(null,140,5,'e', true);
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
	
	protected function items_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = $this->lan ? $this->lan : 0;  
		$title = localize('_items', $lan); 
		
		$_wf = $this->whereFilter();
		$xsSQL = "SELECT * from (select {$this->etlfields}  from etlproducts $_wf) o ";		   
		   							
		_m("mygrid.column use grid1+id|".localize('id',$lan)."|2|0|");
		_m("mygrid.column use grid1+itmactive|".localize('_active',$lan)."|boolean|1|1:0");		
		_m("mygrid.column use grid1+active|".localize('_active',$lan)."|boolean|1|101:0|");
		_m("mygrid.column use grid1+datein|".localize('_date',$lan)."|link|5|cpediitems.php?flt=datein&val={datein}");	
		_m("mygrid.column use grid1+code3|".localize('_code',$lan)."|5|0|");
		_m("mygrid.column use grid1+code5|".localize('_code',$lan)."|link|5|cpediitems.php?flt=code5&val={code5}");	
		_m("mygrid.column use grid1+itmname|".localize('_title',$lan)."|10|0|");	
		_m("mygrid.column use grid1+cat0|".localize('_cat',$lan)."|link|5|cpediitems.php?flt=cat0&val={cat0}");	
		_m("mygrid.column use grid1+cat1|".localize('_cat',$lan)."|link|5|cpediitems.php?flt=cat1&val={cat1}");
		_m("mygrid.column use grid1+cat2|".localize('_cat',$lan)."|link|5|cpediitems.php?flt=cat2&val={cat2}");
		_m("mygrid.column use grid1+cat3|".localize('_cat',$lan)."|link|5|cpediitems.php?flt=cat3&val={cat3}");
		_m("mygrid.column use grid1+cat4|".localize('_cat',$lan)."|link|5|cpediitems.php?flt=cat4&val={cat4}");
		_m("mygrid.column use grid1+uniname1|".localize('_uniname1',$lan)."|5|0|");		
		_m("mygrid.column use grid1+ypoloipo1|".localize('_ypoloipo1',$lan)."|5|0|");			
		_m("mygrid.column use grid1+price0|".localize('_price0',$lan)."|5|0|");		
		_m("mygrid.column use grid1+price1|".localize('_price1',$lan)."|5|0|");			
		_m("mygrid.column use grid1+manufacturer|".localize('_manufacturer',$lan)."|link|5|cpediitems.php?flt=manufacturer&val={manufacturer}");//."|5|0|");
		_m("mygrid.column use grid1+size|".localize('_size',$lan)."|5|0|");
		_m("mygrid.column use grid1+color|".localize('_color',$lan)."|5|0|");
		_m("mygrid.column use grid1+owner|".localize('_owner',$lan)."|link|5|cpediitems.php?flt=owner&val={owner}");

		$out = _m("mygrid.grid use grid1+etlproducts+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}	
	
	protected function submit() { 		
		
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

		return false;	
	}
	
	public function currCategory() {
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$id = $cpGet['id'];  		
			
		//echo $cat . '-' . $id;
		$csep = _m('cmsrt.sep');
		//$currcat = str_replace($csep, ' &gt; ', $cat);
		//return $currcat;
		
		$cats = explode($csep, $cat);
		foreach ($cats as $i=>$c)
			$_cat[] = _m("cmsrt.replace_spchars use $c+1");
		
		if (!empty($_cat))
			return implode(' &gt; ', $_cat);	
		
		return false;
	}

	protected function moveInCategory() {
		$db = GetGlobal('db'); 
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$csep = _m('cmsrt.sep');
		$fcode = _v('cmsrt.fcode');
		
		$_cat = explode($csep, $cat);
		
		if (!empty($_cat)) {

			//clear log files
			if (GetParam('logclear')) {
				@unlink($this->prpath . 'edi-ins-counter.log');
				@unlink($this->prpath . 'edi-insert.log');
			}	

			//slug
			$slug = GetParam('slugon') ? 1 : 0;
			$greeklish = GetParam('sluggreekon') ? 1 : 0;			
		
		    $_wf = $this->whereFilter();
			$sSQL = "select " .$this->etlfields. " from etlproducts ";
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
					$this->messages[] = '(' . $x . ') Press submit to continue...';
					//break;
					return true;
				}
				
				$cc = array();	//reset
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

				$_cc = implode($csep, $cc);
				$sSQL = "select $fcode from products where $fcode = " . $db->qstr($rec[$fcode]);
				$check = $db->Execute($sSQL);
				
				if ($check->fields[0]) {
					$this->messages[] = $x . ' ' . $rec[$fcode] . ' exists ';
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
					
					if ($slug) {
						$aliasID = _m('cmsrt.useUrlAlias');		
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
					
					if (GetParam('dbset'))
						$res = $db->Execute($sSQL);
					if (GetParam('logset'))
						file_put_contents($this->prpath . 'edi-insert.log', $sSQL . ";\r\n", FILE_APPEND | LOCK_EX);
				
					$with = $slug ? ($greeklish ? 'with greeklish slug ':' with slug ') : '';
					$this->messages[] = $x .' '. $rec[$fcode] .' Inserted ' . $with; 
				}
				$x+=1;	
			}	
			
			@unlink($this->prpath . 'edi-ins-counter.log');
			return true;
		}
		else
			$this->messages[] = 'There is no selected category';
		
		return false;
	}

	/* https://stackoverflow.com/questions/5727827/update-one-mysql-table-with-values-from-another
		UPDATE tobeupdated
		INNER JOIN original ON (tobeupdated.value = original.value)
		SET tobeupdated.id = original.id
	*/	
	protected function updateInCategory() {
		$db = GetGlobal('db'); 
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$csep = _m('cmsrt.sep');
		$fcode = _v('cmsrt.fcode');
		
		$_cat = explode($csep, $cat);
		
		if (!empty($_cat)) { 
		
			//clear log files
			if (GetParam('logclear')) {
				@unlink($this->prpath . 'edi-upd-counter.log');
				@unlink($this->prpath . 'edi-update.log');
			}		
			
			//params
			$slug = GetParam('slugon') ? 1 : 0;
			$greeklish = GetParam('sluggreekon') ? 1 : 0;				
		
			$_wf = $this->whereFilter();
			$sSQL = "select " .$this->etlfields. " from etlproducts ";
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
					$this->messages[] = '(' . $x . ') Press submit to continue...';
					//break;
					return true;
				}	
				
				$cc = array();	//reset
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

				$_cc = implode($csep, $cc);
				
				$sSQL = "select $fcode from products where $fcode = " . $db->qstr($rec[$fcode]);
				$check = $db->Execute($sSQL);
				
				if (!$check->fields[0]) {
					$this->messages[] = $x . ' ' . $rec[$fcode] . ' not exists ';
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
					if (GetParam('catupd')) {
						$sSQL.= ",";	
						$sSQL.= implode(',', $cc);	
					}
					//slug
					if ($slug) {
						$_itmname = _m('cmsrt.stralias use '.$rec['itmname']);
						$aliasID = _m('cmsrt.useUrlAlias');	
						$sSQL.= ", $aliasID = '" . ($greeklish ? _m('cmsrt.slugstr use '.$rec['itmname']) : $_itmname) . "'";		
					}	
					$sSQL.= " where $fcode = " . $db->qstr($rec[$fcode]);
					
					if (GetParam('dbset'))
						$res = $db->Execute($sSQL);
					if (GetParam('logset'))
						file_put_contents($this->prpath . 'edi-update.log', $sSQL . ";\r\n", FILE_APPEND | LOCK_EX);
				
					$with = $slug ? ($greeklish ? 'with greeklish slug ':' with slug ') : '';
					$this->messages[] = $x .' '. $rec[$fcode] .' Updated ' . $with;
				}
				$x+=1;	
			}	
			
			@unlink($this->prpath . 'edi-upd-counter.log');
			return true;
		}
		else
			$this->messages[] = 'There is no selected category';
		
		return false;
	}	
	
	protected function deleteInCategory() {
		$db = GetGlobal('db'); 
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$csep = _m('cmsrt.sep');
		$fcode = _v('cmsrt.fcode');
		
		$_cat = explode($csep, $cat);
		
		if (!empty($_cat)) {

			//clear log files
			if (GetParam('logclear')) {
				@unlink($this->prpath . 'edi-del-counter.log');
				@unlink($this->prpath . 'edi-delete.log');
			}		
		
			$_wf = $this->whereFilter();
			$sSQL = "select " .$this->etlfields. " from etlproducts ";
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
					$this->messages[] = '(' . $x . ') Press submit to continue...';
					//break;
					return true;
				}	
				
				$sSQL = "select $fcode from products where $fcode = " . $db->qstr($rec[$fcode]);
				$check = $db->Execute($sSQL);
				
				if (!$check->fields[0]) {
					$this->messages[] = $x . ' ' . $rec[$fcode] . ' not exists ';
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
				
					$this->messages[] = $x .' '. $rec[$fcode] .' Deleted ';//$res ? $sSQL : $rec[0] . " error ($sSQL)";
				}
				$x+=1;	
			}	
			
			@unlink($this->prpath . 'edi-del-counter.log');
			return true;
		}
		else
			$this->messages[] = 'There is no selected category';
		
		return false;
	}
	
	
	protected function createCategory() {
		$db = GetGlobal('db'); 
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$csep = _m('cmsrt.sep');
		$fcode = _v('cmsrt.fcode');
		$lan = $this->lan ? $this->lan : '0';
		
		$_cat = explode($csep, $cat);
		
		if (!empty($_cat)) {

			//clear log files
			if (GetParam('logclear')) {
				@unlink($this->prpath . 'edi-insert-categories.log');
			}	
			
			//fetch current category alias names
			$sSQL = "select DISTINCT cat1,cat2,cat3,cat4,cat5,cat01,cat02,cat03,cat04,cat05,cat11,cat12,cat13,cat14,cat15 from categories ";
			foreach ($_cat as $cid=>$ccat)
				$sql[] = "cat" . strval($cid+2) . "='" . $ccat . "'";
			$sSQL.= ' WHERE ' . implode(' AND ', $sql);			
			//echo $sSQL;
			$cres = $db->Execute($sSQL);
		
		    //param
			$slug = GetParam('slugon') ? 1 : 0;	
			$greeklish = GetParam('sluggreekon') ? 1 : 0;		
			$active = GetParam('catact') ? 1 : 0;
			$view = GetParam('catview') ? 1 : 0;
			$search = GetParam('catsearch') ? 1 : 0;
		
			$_wf = $this->whereFilter();
			$sSQL = 'select DISTINCT cat0,cat1,cat2,cat3,cat4 from etlproducts ';
			$sSQL.= $_wf ? $_wf . ' and active>0 and itmactive>0' : 
								' where active>0 and itmactive>0' ;			
			$res = $db->Execute($sSQL);
			if (empty($res)) return false;
			
			$x = 1;
			foreach ($res as $zi=>$rec) {
				
				$cc = array();	//reset mkcat replacements
				$ccalias = array();	//reset use for original text
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
				
				$_cc = implode(',', $cc);
				$_ccalias = implode(',', $ccalias);
				$_id = hash('crc32', implode('', $cc));
				
				$sSQL = "select ctgoutline from categories where ctgoutline = '$_id'";
				$check = $db->Execute($sSQL);
				
				if ($check->fields[0]) {
					$this->messages[] = $x . ' Exist ' . $_cc;
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
					
					if (GetParam('dbset'))
						$res = $db->Execute($sSQL);
					if (GetParam('logset'))
						file_put_contents($this->prpath . 'edi-insert-categories.log', $sSQL . ";\r\n", FILE_APPEND | LOCK_EX);
				
					$with = $slug ? ($greeklish ? 'with greeklish slug ':' with slug ') : '';
					$this->messages[] = $x . ' Inserted '. $with . $_cc;
				}
				$x+=1;
			}	
			
			return true;
		}
		else
			$this->messages[] = 'There is no selected category';		
		
		return false;
	}	
	
	protected function deleteCategory() {
		$db = GetGlobal('db'); 
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$csep = _m('cmsrt.sep');
		$fcode = _v('cmsrt.fcode');
		
		$_cat = explode($csep, $cat);
		
		if (!empty($_cat)) { 
		
			//clear log files
			if (GetParam('logclear')) {
				@unlink($this->prpath . 'edi-delete-categories.log');
			}		
			
			//params
			$slug = GetParam('slugon') ? 1 : 0;	
			$greeklish = GetParam('sluggreekon') ? 1 : 0;				
		
			$_wf = $this->whereFilter();
			$sSQL = 'select DISTINCT cat0,cat1,cat2,cat3,cat4 from etlproducts ';
			$sSQL.= $_wf ? $_wf . ' and active>0 and itmactive>0' : 
								' where active>0 and itmactive>0' ;			
			$res = $db->Execute($sSQL);
			if (empty($res)) return false;
			
			$x = 1;
			foreach ($res as $zi=>$rec) {
				
				$cc = array();	//reset mkcat replacements
				$ccalias = array();	//reset use for original text
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
				
				$_cc = implode($csep, $cc);
				$_ccalias = implode(',', $ccalias);
				$_id = hash('crc32', implode('', $cc));
				
				$sSQL = "select ctgoutline from categories where ctgoutline = '$_id'"; //based on id
				$check = $db->Execute($sSQL);
				
				if (!$check->fields[0]) {
					$this->messages[] = $x . ' not exist ' . $_cc;
				}
				else {				
					$sSQL = "delete from categories";
					$sSQL.= " where ctgoutline='$_id'";
					
					if (GetParam('dbset'))
						$res = $db->Execute($sSQL);
					if (GetParam('logset'))
						file_put_contents($this->prpath . 'edi-delete-categories.log', $sSQL . ";\r\n", FILE_APPEND | LOCK_EX);
				
					$with = $slug ? ($greeklish ? 'with greeklish slug ':' with slug ') : '';
					$this->messages[] = $x . ' Deleted ' . $with . $_cc;
				}
				$x+=1;
			}	
			
			return true;
		}
		else
			$this->messages[] = 'There is no selected category';		
		
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

};
}
?>