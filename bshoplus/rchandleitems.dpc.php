<?php
$__DPCSEC['RCHANDLEITEMS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ( (!defined("RCHANDLEITEMS_DPC")) && (seclevel('RCHANDLEITEMS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCHANDLEITEMS_DPC",true);

$__DPC['RCHANDLEITEMS_DPC'] = 'rchandleitems';

$__EVENTS['RCHANDLEITEMS_DPC'][0]='cphandleitems';
$__EVENTS['RCHANDLEITEMS_DPC'][1]='cpsavehitems';
$__EVENTS['RCHANDLEITEMS_DPC'][2]='cpsortgroup';

$__ACTIONS['RCHANDLEITEMS_DPC'][0]='cphandleitems';
$__ACTIONS['RCHANDLEITEMS_DPC'][1]='cpsavehitems';
$__ACTIONS['RCHANDLEITEMS_DPC'][2]='cpsortgroup';

$__LOCALE['RCHANDLEITEMS_DPC'][0]='RCHANDLEITEMS_DPC;Handle group items;Διαχείριση ειδών επιλογής';
$__LOCALE['RCHANDLEITEMS_DPC'][1]='_handleitems;Handle group items;Ενέργειες επιλεγμένων ειδών';
$__LOCALE['RCHANDLEITEMS_DPC'][2]='_moveincategory;Move in category;Μετακίνηση στην κατηγορία';
$__LOCALE['RCHANDLEITEMS_DPC'][3]='_deleteincategory;Delete current category;Διαγραφή επιλεγμένης κατηγορίας';
$__LOCALE['RCHANDLEITEMS_DPC'][4]='_movecatincategory;Move product categories;Μετακίνηση κατηγοριων στην κατηγορία';
$__LOCALE['RCHANDLEITEMS_DPC'][5]='_movecatfromroot;Move from root category;Μετακίνηση στην κατηγορία απο την ρίζα';
$__LOCALE['RCHANDLEITEMS_DPC'][6]='_delmovedcat;Delete source category;Διαγραφή πηγαίας κατηγορίας';
$__LOCALE['RCHANDLEITEMS_DPC'][7]='_docactivity;Document created;Δημιουργία εγγράφου';
$__LOCALE['RCHANDLEITEMS_DPC'][8]='_msgsuccess;Mail sent;Το μήνυμα στάλθηκε επιτυχώς';
$__LOCALE['RCHANDLEITEMS_DPC'][9]='_msgerror;Sent error;Το μήνυμα απέτυχε να σταλθεί';
$__LOCALE['RCHANDLEITEMS_DPC'][10]='_recomments;Recomentations;Προτεινόμενα';
$__LOCALE['RCHANDLEITEMS_DPC'][11]='_recommentson;Set recommendation;Χαρακτηρισμός ως προτεινόμενα';
$__LOCALE['RCHANDLEITEMS_DPC'][12]='_recommentsoff;Remove recommendations;Αφαιρεση ιδιότητας προτεινόμενων';
$__LOCALE['RCHANDLEITEMS_DPC'][13]='_slug;Slug on;Ενεργοποίηση Slug';
$__LOCALE['RCHANDLEITEMS_DPC'][14]='_sluggreeklish;Greeklish translations;Greeklish μετάφραση';
$__LOCALE['RCHANDLEITEMS_DPC'][15]='_options;Options;Ρυθμίσεις';
$__LOCALE['RCHANDLEITEMS_DPC'][16]='_enable;Set active;Ενεργοποίηση';
$__LOCALE['RCHANDLEITEMS_DPC'][17]='_lrp;Long Running Process;Long Running Process';

class rchandleitems {
	
	var $title, $prpath, $urlpath, $url, $messages, $lan, $catTitles;
	var $dac7, $indac7, $dacEnv;
		
    public function __construct() {

		$this->prpath = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');	
		$this->url = paramload('SHELL','urlbase');
		$this->title = localize('RCHANDLEITEMS_DPC',getlocal());	
		
		$this->messages = array();
		$lan = getlocal();
		$this->lan = $lan ? $lan :'0';

		$this->dac7 = _m('cmsrt.isDacRunning');
		$this->indac7 = _m('cmsrt.runningInsideDac');
		$this->dacEnv = GetGlobal('controller')->env;
	}
	
    public function event($event=null) {
	
	    $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;

	    switch ($event) {
			
			case 'cpsavehitems'    :  $this->submit();
									  //SetSessionParam('messages',$this->messages); 
			                          break;
									
			case 'cpsortgroup'	   :  if (!empty($_POST['groupsort'])) { 
										$slist = implode(',', $_POST['groupsort']);	
										_m("rcgroup.saveSortedlist use " . $slist);
									  }
                                      break;			
			 	  									 
														
			case 'cphandleitems'  :
			default               :	 
        }			
			
    }	

    public function action($action=null)  { 	

        $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;
		
	    switch ($action) {										  									 
			
			case 'cpsavehitems'        :
			
			case 'cpsortgroup'         :
			case 'cphandleitems'       : 
		    default                    : $this->catTitles = _m('rcpmenu.showCategoryTitles use +&nbsp;&gt;&nbsp;');	 
		}		
		
        return ($out);
	}	
	
	protected function submit() {
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$id = $cpGet['id'];  	

		if ($this->dac7==true) {
			//when in dac mode submit is all at once ()see async/ppost/bshopplus_rchandleitems_submit
			
			if (_m('cmsrt.savePostCookie')) {	
				
				//execute long running processs	
				//$cmd = 'async/ppost/submit/'; //generic 
				$cmd = 'async/ppost/bshopplus_rchandleitems_submit/'; //postparam/';
				phpdac7\getT($cmd); //exec cmd and close tier
				
				$this->jsDialog('Start', localize('_lrp', getlocal()), 3000, 'cdact.php?t=texit');
				$this->messages[] = 'LRP started!';	
				
				return true;
			}
			else
				$this->messages[] = 'LRP failed!';	
		}
		else { //all at once //when not in dac mode submit one by one ..elseif!!
			if (GetParam('moveincat')) {	
				//echo $cat . '-' . $id;	
				$this->moveInCategory();
			}
			elseif (GetParam('slugon')) {	
		
				$greeklish = GetParam('sluggreekon');
				$this->makeSlug($greeklish);
			}
			elseif (GetParam('delincat')) {	

				$this->deleteCurrentCategory();
			}			

			return true;	
		}
		return false;	
	}	

	public function moveInCategory() {
		$db = GetGlobal('db'); 
		$cpGet = _v('rcpmenu.cpGet');
		//when running inside dac, cat passed as post param, else fetch from cpGet
		$cat = GetReq('cat') ? GetReq('cat'): $cpGet['cat'];
		$csep = _m('cmsrt.sep');
		$fcode = _v('cmsrt.fcode');
		$lan = $this->lan;
		
		$_cat = explode($csep, $cat);
		
		if ((defined('RCGROUP_DPC')) && (!empty($_cat))) { 
		
		    //when dac7 there is no session at runtime
			//session item codes saved at preset _rcgroup by default
			$items = ($this->indac7==true) ? 
						_m("rcgroup.get_collected_items use _rcgroup") :
						_m("rcgroup.get_collected_items");
			
			if (empty($items)) {
				$this->_echo("No items selected");
				return false;
			}	
			
			//param
			$moveCategories= GetParam('movecatincat') ? 1 : 0;
			$deleteCategories= GetParam('delmovedcat') ? 1 : 0;
			$moveCatFromRoot= GetParam('movecatfromroot') ? 1 : 0;
			
			//when movecatincat is on with move products..
			if ($moveCategories) {
				//first create categories based on current cat and subcats of products	
				$this->moveCategories($items); 
			}	
			
			foreach ($items as $ir=>$rec) {
				
				//fetch products categories names
				$sql = array(); //reset
				$sSQLP = "select cat1,cat2,cat3,cat4,cat5 from categories ";
				for ($cidx=0;$cidx<4;$cidx++) {
					$m = $cidx+7; //7 to 11 (items array as return from rcgroup)
					$sql[] = "cat" . strval($cidx+2) . "='" . $rec[$m] . "'";
				}	
				$sSQLP.= ' WHERE ' . implode(' AND ', $sql);			
				//echo $sSQLP;
				$cresP = $db->Execute($sSQLP);
					
				$cc = array();	//reset
				if ($moveCatFromRoot) {//fetch whole tree
					$ix = 0;
					//first current selection
					for ($i=0;$i<5;$i++) {
						if ($_cat[$i]) {
							$_c = _m("cmsrt.replace_spchars use ".$_cat[$i]."+1");
							$ix+=1;
							$cc[] = "cat$i='$_c'";
						}
					}
					//after add product tree ( -ix = minus selection subcats)
					for ($i=0;$i<(5-$ix);$i++) {
						if ($rcat = $cresP->fields('cat'.strval($i+2))) { 
							$_c = $rcat;
							$index = $i + $ix;
							$cc[] = "cat$index='$_c'";
						}	
					}		
				}
				else { //fetch subcats from the end of current tree
					for ($i=0;$i<5;$i++) {
					
						if ($_cat[$i]) 
							//current (cp selected) category subcat
							$_c = _m("cmsrt.replace_spchars use ".$_cat[$i]."+1");
						else 
							//product category subcat that exist after select cat
							$_c = $cresP->fields('cat'.strval($i+2));
					
						$cc[] = "cat$i='$_c'";
					}
				}	
				//print_r($cc);
				$sSQL = "update products set ";
				$sSQL.= implode(',', $cc);	
				$sSQL.= " where $fcode='{$rec[0]}'";
				//echo $sSQL;
				
				$res = $db->Execute($sSQL);
				$msg = $res ? $rec[0] . " updated" : $rec[0] . " update error" ;//" error ($sSQL)";

				$this->_echo($msg);
			}

			//if ($moveCategories) {
			if ($deleteCategories) {	
				//second delete categories that refered at products table
				$this->deleteMovedCategories($items);
			}				
			
			return true;
		}
		else 
			$this->_echo("No category selected");
		
		return false;
	}	
	
	//create categories based on current cat and subcats of products
	public function moveCategories($_items=null) {
		$db = GetGlobal('db'); 
		$cpGet = _v('rcpmenu.cpGet');
		//when running inside dac, cat passed as post param, else fetch from cpGet
		$cat = GetReq('cat') ? GetReq('cat'): $cpGet['cat'];
		$csep = _m('cmsrt.sep');
		$fcode = _v('cmsrt.fcode');
		$lan = $this->lan;
		$sql = array();
		$_sql = array();
		
		$_cat = explode($csep, $cat); //current cat replace the category of products in selected depth
		
		if ((defined('RCGROUP_DPC')) && (!empty($_cat))) { 
		
		    //when dac7 there is no session at runtime
			//session item codes saved at preset _rcgroup by default
			$items = (!empty($_items)) ? $_items :
						(($this->indac7==true) ? 
						_m("rcgroup.get_collected_items use _rcgroup") :
						_m("rcgroup.get_collected_items"));
			
			if (empty($items)) {
				$this->_echo("No items selected");
				return false;
			}
			
			//fetch current category alias names
			$sSQL = "select cat1,cat2,cat3,cat4,cat5,cat01,cat02,cat03,cat04,cat05,cat11,cat12,cat13,cat14,cat15 from categories ";
			foreach ($_cat as $cid=>$ccat)
				$sql[] = "cat" . strval($cid+2) . "='" . _m("cmsrt.replace_spchars use $ccat+1") . "'";
			$sSQL.= ' WHERE ' . implode(' AND ', $sql);			
			//echo $sSQL;
			$cres = $db->Execute($sSQL);
		
		    //param
			$slug = GetParam('slugon') ? 1 : 0;	
			$greeklish = GetParam('sluggreekon') ? 1 : 0;		
			$active = 1;//GetParam('catact') ? 1 : 0;
			$view = 1;//GetParam('catview') ? 1 : 0;
			$search = 1;//GetParam('catsearch') ? 1 : 0;			
			$moveCatFromRoot= GetParam('movecatfromroot') ? 1 : 0;

			$x = 1;
			foreach ($items as $zi=>$rec) {
				//fetch products categories alias names
				$sql = array(); //reset
				$sSQLP = "select cat1,cat2,cat3,cat4,cat5,cat01,cat02,cat03,cat04,cat05,cat11,cat12,cat13,cat14,cat15 from categories ";
				for ($cidx=0;$cidx<4;$cidx++) {
					$m = $cidx+7; //7 to 11 (items array as return from rcgroup)
					$sql[] = "cat" . strval($cidx+2) . "='" . $rec[$m] . "'";
				}	
				$sSQLP.= ' WHERE ' . implode(' AND ', $sql);			
				//echo $sSQLP;
				$cresP = $db->Execute($sSQLP);
				
				$cc = array();	//reset mkcat replacements
				$ccalias = array();	//reset use for original text
				
				if ($moveCatFromRoot) {//fetch whole tree
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
						$m = $i+7; //7 to 11 (items array as return from rcgroup)
						if ($rcat = $rec[$m]) {
							$cccat = $slug ? strtolower($rcat) : $rcat;
							$slugcat = $greeklish ? _m('cmsrt.slugstr use '. $rcat) : $cccat;
							$cc[] = $slugcat ? $db->qstr($slugcat) : "''";				
			
							//$ccalias[] = $db->qstr($cresP->fields('cat'.$lan.strval($i+2))); 
							$ralias = $cresP->fields('cat'.$lan.strval($i+2));
							$cccatalias = $slug ? strtolower($ralias) : $ralias;
							$slugcatalias = $greeklish ? _m('cmsrt.slugstr use '. $ralias) : $cccatalias;		
							$ccalias[] = $db->qstr($slugcatalias); 
						}
 						else { //fill all, not nulls
							$cc[] = "''";							
							$ccalias[] = "''";
						}	
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
							$m = $i+7; //7 to 11 (items array as return from rcgroup)
							$cccat = $slug ? strtolower($rec[$m]) : $rec[$m];		
							$slugcat = $greeklish ? _m('cmsrt.slugstr use '. $rec[$m]) : $cccat;
							$cc[] = $slugcat ? $db->qstr($slugcat) : "''";	
							
							//$ccalias[] = $db->qstr($cresP->fields('cat'.$lan.strval($i+2))); 
							$ralias = $cresP->fields('cat'.$lan.strval($i+2));
							$cccatalias = $slug ? strtolower($ralias) : $ralias;
							$slugcatalias = $greeklish ? _m('cmsrt.slugstr use '. $ralias) : $cccatalias;		
							$ccalias[] = $db->qstr($slugcatalias); 
						}	
					}
				}
				//print_r($cc);				
				$_cc = implode(',', $cc);
				$_ccalias = implode(',', $ccalias);
				$_id = hash('crc32', implode('', $cc));

				$sSQL = "select ctgoutline from categories where ctgoutline = '$_id'";
				$check = $db->Execute($sSQL);
				//echo $sSQL;
				
				if ($check->fields[0]) {

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
					
					$_sql[$_id] = $sSQL; // save unique array of sql
					
				}
				$x+=1;
			}	
			
			if (!empty($_sql)) {
				$with = $slug ? ($greeklish ? 'with greeklish slug ':' with slug ') : '';
				
				foreach ($_sql as $id=>$sSQL) {
					//echo $sSQL . PHP_EOL;
					$res = $db->Execute($sSQL);
					//file_put_contents($this->prpath . '/_sql.log' ,$sSQL . PHP_EOL);

					$this->_echo($id . ' Inserted '. $with);
				}	
			}			
			
			return true;
		}
		else 
			$this->_echo('There is no selected category');	

		return false;
	}	
	
	//delete categories of items that refered at products table
	public function deleteMovedCategories($_items=null) {
		$db = GetGlobal('db'); 
		$cpGet = _v('rcpmenu.cpGet');
		//when running inside dac, cat passed as post param, else fetch from cpGet
		$cat = GetReq('cat') ? GetReq('cat'): $cpGet['cat'];
		$csep = _m('cmsrt.sep');
		$fcode = _v('cmsrt.fcode');
		$lan = $this->lan;
		$_sql = array();
		
		if (!defined('RCGROUP_DPC')) die('RCGROUP_DPC required');
		
		$_cat = explode($csep, $cat); 
		
		//when dac7 there is no session at runtime
		//session item codes saved at preset _rcgroup by default
		$items = (!empty($_items)) ? $_items :
					(($this->indac7==true) ? 
						_m("rcgroup.get_collected_items use _rcgroup") :
						_m("rcgroup.get_collected_items"));		
		
		if (!empty($items)) { 
		
		    //case 1 : delete categories based on selected items 
			
		    //param
			$slug = GetParam('slugon') ? 1 : 0;	
			$greeklish = GetParam('sluggreekon') ? 1 : 0;				
			//print_r($items);
			$x = 1;
			foreach ($items as $zi=>$rec) {
				
				$cc = array();	//reset mkcat replacements

				for ($i=0;$i<4;$i++) { //to 4 not 5 (ITEMS at start)
					
					$m = $i+7; //7 to 11 (items array as return from rcgroup)
					$cc[] = $rec[$m] ? $db->qstr($rec[$m]) : "''";
				}
				
				$_cc = implode($csep, $cc);
				$_id = hash('crc32', implode('', $cc));
				
				$sSQL = "select ctgoutline from categories where ctgoutline = '$_id'"; //based on id
				$check = $db->Execute($sSQL);
				
				if (!$check->fields[0]) {

					$this->_echo($x . ' not exist ' . $_cc);	
				}
				else {
					$sSQL = "delete from categories where ctgoutline='$_id'";
					//echo $sSQL;
					$_sql[$_id] = $sSQL; // save unique array of sql
				}
				$x+=1;
			}	
			
			if (!empty($_sql)) {
				//SLUG/GREEKLISH HAS NO EFFECT WHEN DELETE CATEGORIES (DELETE AS IS)
				//$with = $slug ? ($greeklish ? 'with greeklish slug ':' with slug ') : '';
				
				foreach ($_sql as $id=>$sSQL) {
					//echo $sSQL . PHP_EOL;
					$res = $db->Execute($sSQL);

					$this->_echo($id . ' deleted ');// . $with);	
				}	
			}	
			
			return true;
		}
		else 
			$this->_echo("No items selected");	
		
		return false;
	}	
	
	//delete categories of items that refered at products table
	public function deleteCurrentCategory($_items=null) {
		$db = GetGlobal('db'); 
		$cpGet = _v('rcpmenu.cpGet');
		//when running inside dac, cat passed as post param, else fetch from cpGet
		$cat = GetReq('cat') ? GetReq('cat'): $cpGet['cat'];
		$csep = _m('cmsrt.sep');
		$fcode = _v('cmsrt.fcode');
		$lan = $this->lan;
		$_sql = array();
		
		$_cat = explode($csep, $cat); 
		
		if (!empty($_cat)) { 

			//based on selected categories	(delete subcats after selected cat)
			for ($i=0;$i<4;$i++) { //to 4 not 5 (ITEMS at start)	
				if ($_cat[$i])
					$cc[] = 'cat'.strval($i+2).'=' . $db->qstr(_m("cmsrt.replace_spchars use ".$_cat[$i]."+1"));
			}
			$_cc = implode(' AND ', $cc);
			
			$sSQL = "delete from categories where " . $_cc;
			//echo $sSQL;
			if ($res = $db->Execute($sSQL)) {

				$this->_echo('Where ' . $_cc . ' deleted ');
				return true;	
			}	
		}	
		else 
			$this->_echo('There is no selected category');
		
		return false;
	}	
	
	public function makeSlug($greeklish=false) {
		$db = GetGlobal('db'); 
		$csep = _m('cmsrt.sep');
		$fcode = _v('cmsrt.fcode');
		$aliasID = _m('cmsrt.useUrlAlias');
		 
		if ((defined('RCGROUP_DPC')) && ($aliasID)) { 
		
			$items = _m("rcgroup.get_collected_items");
			if (empty($items)) {

				$this->_echo("No items selected");
				return false;
			}	
			
			foreach ($items as $i=>$rec) {
				
				$iname = _m('cmsrt.stralias use '. $rec[1]);
				$itmname = ($greeklish==true) ? _m('cmsrt.slugstr use ' . $rec[1]) : $iname;
				if ($itmname) {
					//$sSQL = "update products set $aliasID =";
					//$sSQL.= " replace(replace(replace(replace(replace(replace(replace(replace(replace('$itmname','#','-'),\"'\",'-'),'\"','-'),',','-'),'+','-'),'/','-'),'&','-'),'.','-'),' ','-')";
					//$sSQL.= " where $fcode='{$rec[0]}'";
					
					$sSQL = "update products set $aliasID ='";
					$sSQL.= $itmname;
					$sSQL.= "' where $fcode='{$rec[0]}'";	
					
					$res = $db->Execute($sSQL);	
					$msg = $res ? $rec[0] . " updated"  . (($greeklish==true) ? ' with greeklish' : null) : $rec[0] . (($greeklish==true) ? ' with greeklish' : null) ." update error" ;//" error ($sSQL)";
					
					$this->_echo($msg);
					//echo $sSQL;
				}
				else 
					$this->_echo("Translations error ($itmname)");
			}	
			
			return true;
		}
		else 
			$this->_echo("Alias ID error");	
		
		return false;
	}
		

	//call from hrml to save the category when passed to dac
	public function postCategory() {
		$cpGet = _v('rcpmenu.cpGet');
		//when running inside dac, cat passed as post param, else fetch from cpGet
		$cat = GetReq('cat') ? GetReq('cat'): $cpGet['cat'];	

		return $cat;	
	}		
	
	public function currCategory() {
		
		return $this->catTitles;	
	}
	
	public function tail($_file=null, $_lines=null) {
		$file = $_file ?? $this->prpath . '/_cookie.txt';
		$lines = $_lines ?? 10;
		if (!is_readable($file)) return 'none';
		
		if ($lines < 1)
			return '';

		$line = '';
		$line_count = 0;
		$prev_char = '';
		$fp = fopen($file, 'r');
		$cursor = -1;

		fseek($fp, $cursor, SEEK_END);
		$char = fgetc($fp);

		while ($char !== false) {

			if ($char === "\n" || $char === "\r")
			{
				fseek($fp, --$cursor, SEEK_END);
				$next_char = fgetc($fp);

				if ($char === "\n" && $next_char === "\r")
				{
					$line_count++;
				}
				elseif ($char === "\r" && $prev_char !== "\n")
				{
					$line_count++;
				}
				elseif ($char === "\n")
				{
					$line_count++;
				}

				fseek($fp, ++$cursor, SEEK_END);
			}

			if ($line_count == $lines)
				break;

			$line = $char.$line;
			$prev_char = $char;
			fseek($fp, --$cursor, SEEK_END);
			$char = fgetc($fp);
		}

		fclose($fp);

		return $line;
	}	

	
	
	public function editItems() {
		
		if (defined('RCGROUP_DPC')) 
			$items = _m("rcgroup.get_collected_items");
			
		if (is_array($items)) {
			
			foreach ($items as $i=>$rec) {
				
				//update prices
				$price0 = (GetParam('price'.$i)) ? str_replace(',','.',GetParam('price'.$i)) : str_replace(',','.',$rec[5]);
				//$price1 = (GetParam('price'.$i)) ? str_replace(',','.',GetParam('price'.$i)) : str_replace(',','.',$rec[6]);	
				//update qty
				$qty = (GetParam('qty'.$i)) ? str_replace(',','.',GetParam('qty'.$i)) : 1;
				
				$line .= "						<div class=\"input-icon left\">
													<i class=\"icon-user\"></i>
													<input name=\"code$i\" class=\" \" type=\"text\"  value=\"{$rec[0]}\" disabled />
													<span class=\"help-inline\">
														<i class=\"icon-lock\"></i>
														<input name=\"name$i\" class=\" \" type=\"text\" value=\"{$rec[1]}\" disabled/>
													</span>
													<span class=\"help-inline\">
														<i class=\"icon-tasks\"></i>
														<input name=\"qty$i\" class=\" \" type=\"text\" value=\"$qty\" />
													</span>
													<span class=\"help-inline\">
														<i class=\"icon-tasks\"></i>
														<input name=\"percent$i\" class=\" \" type=\"text\" value=\"0\" />
													</span>													
													<span class=\"help-inline\">
														<i class=\"icon-tasks\"></i>
														<input name=\"price$i\" class=\" \" type=\"text\" value=\"{$price0}\" />
													</span>														
												</div>";
			}	
			
			return ($line);
		}
		return false;		
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
		
	//tokens method	
	protected function combine_tokens($template, $tokens, $execafter=null) {
	    if (!is_array($tokens)) return;		

		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
		  $fp = new fronthtmlpage(null);
		  $ret = $fp->process_commands($template);
		  unset ($fp);		  		
		}		  		
		else
		  $ret = $template;
		  
		//echo $ret;
	    foreach ($tokens as $i=>$tok) {
            //echo $tok,'<br>';
		    $ret = str_replace("$".$i."$",$tok,$ret);
	    }
		//clean unused token marks
		for ($x=$i;$x<30;$x++)
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