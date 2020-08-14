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
$__LOCALE['RCHANDLEITEMS_DPC'][1]='_handleitems;Handle group items;Ενέγειες επιλεγμένων ειδών';
$__LOCALE['RCHANDLEITEMS_DPC'][2]='_moveincategory;Move in category;Μετακίνηση στην κατηγορία';
$__LOCALE['RCHANDLEITEMS_DPC'][3]='_date;Date sent;Ημ. αποστολής';
$__LOCALE['RCHANDLEITEMS_DPC'][4]='_unsubscribe;Unsubscribe;Διαγραφή απο την λίστα';
$__LOCALE['RCHANDLEITEMS_DPC'][5]='_here;here;εδώ';
$__LOCALE['RCHANDLEITEMS_DPC'][6]='_docid;Document;Έγγραφο';
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

class rchandleitems {
	
	var $title, $prpath, $urlpath, $url, $messages;
		
    public function __construct() {
	  
		$this->prpath = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');	
		$this->url = paramload('SHELL','urlbase');
		$this->title = localize('RCHANDLEITEMS_DPC',getlocal());	
		
		$this->messages = array(); 			
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
		    default                    : 
		}		
		
        return ($out);
	}
	
	protected function submit() {
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$id = $cpGet['id'];  		
		
		if (GetParam('moveincat')) {	
			//echo $cat . '-' . $id;	
			$this->moveInCategory();
		}
		elseif (GetParam('slugon')) {	
		
			$greeklish = GetParam('sluggreekon');
			$this->makeSlug($greeklish);
		}

		return true;	
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
		
		if ((defined('RCGROUP_DPC')) && (!empty($_cat))) { 
		
			$items = _m("rcgroup.get_collected_items use ". $this->visitor);
			if (empty($items)) {
				$this->messages[] = "No items selected";
				return false;
			}	
			
			foreach ($items as $i=>$rec) {
				
				//if ($id = _m("cmsrt.getRealItemCode use " . $rec[0]))
					
				$cc = array();	
				for ($i=0;$i<5;$i++) {
					
					$_c = _m("cmsrt.replace_spchars use ".$_cat[$i]."+1");
					$cc[] = "cat$i='$_c'";
				}	
				
				$sSQL = "update products set ";
				$sSQL.= implode(',', $cc);	
				$sSQL.= " where $fcode='{$rec[0]}'";
				$res = $db->Execute($sSQL);
				
				$this->messages[] = $res ? $rec[0] . " updated" : $rec[0] . " update error" ;//" error ($sSQL)";
			}	
			
			return true;
		}
		else
			$this->messages[] = "No category selected";
		
		return false;
	}	
	
	protected function makeSlug($greeklish=false) {
		$db = GetGlobal('db'); 
		$csep = _m('cmsrt.sep');
		$fcode = _v('cmsrt.fcode');
		$aliasID = _m('cmsrt.useUrlAlias');
		 
		if ((defined('RCGROUP_DPC')) && ($aliasID)) { 
		
			$items = _m("rcgroup.get_collected_items");
			if (empty($items)) {
				$this->messages[] = "No items selected";
				return false;
			}	
			
			foreach ($items as $i=>$rec) {
				
				$iname = _m('cmsrt.stralias use '. $rec[1]);
				//$itmname = ($greeklish==true) ? $this->translateSlug($iname) : $iname;
				$itmname = ($greeklish==true) ? _m('cmsrt.slugstr use ' . $rec[1]) : $iname;
				if ($itmname) {
					//$sSQL = "update products set $aliasID =";
					//$sSQL.= " replace(replace(replace(replace(replace(replace(replace(replace(replace('$itmname','#','-'),\"'\",'-'),'\"','-'),',','-'),'+','-'),'/','-'),'&','-'),'.','-'),' ','-')";
					//$sSQL.= " where $fcode='{$rec[0]}'";
					
					$sSQL = "update products set $aliasID ='";
					$sSQL.= $itmname;
					$sSQL.= "' where $fcode='{$rec[0]}'";	
					
					$res = $db->Execute($sSQL);				
					$this->messages[] = $res ? $rec[0] . " updated"  . (($greeklish==true) ? ' with greeklish' : null) : $rec[0] . (($greeklish==true) ? ' with greeklish' : null) ." update error" ;//" error ($sSQL)";
					//echo $sSQL;
				}
				else
					$this->messages[] = "Translations error ($itmname)" ;
			}	
			
			return true;
		}
		else
			$this->messages[] = "Alias ID error";
		
		return false;
	}	
	
	protected function translateSlug($str=null) {
		if (!$str) return false;
		$expressions = array(
        '/[αΑ][ιίΙΊ]/u' => 'ai',
        //'/[οΟ][ιίΙΊ]/u' => 'ei',
        //'/[Εε][ιίΙΊ]/u' => 'oi',

        '/[αΑ][υύΥΎ]([θΘκΚξΞπΠσςΣτTφΡχΧψΨ]|\s|$)/u' => 'af$1',
        '/[αΑ][υύΥΎ]/u' => 'av',
        '/[εΕ][υύΥΎ]([θΘκΚξΞπΠσςΣτTφΡχΧψΨ]|\s|$)/u' => 'ef$1',
        '/[εΕ][υύΥΎ]/u' => 'ev',
        '/[οΟ][υύΥΎ]/u' => 'ou',

        //'/(^|\s)[μΜ][πΠ]/u' => '$1b',
        //'/[μΜ][πΠ](\s|$)/u' => 'b$1',
        '/[μΜ][πΠ]/u' => 'mp',
        '/[νΝ][τΤ]/u' => 'nt',
        '/[τΤ][σΣ]/u' => 'ts',
        '/[τΤ][ζΖ]/u' => 'tz',
        '/[γΓ][γΓ]/u' => 'ng',
        '/[γΓ][κΚ]/u' => 'gk',
        '/[ηΗ][υΥ]([θΘκΚξΞπΠσςΣτTφΡχΧψΨ]|\s|$)/u' => 'if$1',
        '/[ηΗ][υΥ]/u' => 'iu',

        '/[θΘ]/u' => 'th',
        '/[χΧ]/u' => 'ch',
        '/[ψΨ]/u' => 'ps',

        '/[αάΑΆ]/u' => 'a',
        '/[βΒ]/u' => 'v',
        '/[γΓ]/u' => 'g',
        '/[δΔ]/u' => 'd',
        '/[εέΕΈ]/u' => 'e',
        '/[ζΖ]/u' => 'z',
        '/[ηήΗΉ]/u' => 'i',
        '/[ιίϊΙΊΪ]/u' => 'i',
        '/[κΚ]/u' => 'k',
        '/[λΛ]/u' => 'l',
        '/[μΜ]/u' => 'm',
        '/[νΝ]/u' => 'n',
        '/[ξΞ]/u' => 'ks',
        '/[οόΟΌ]/u' => 'o',
        '/[πΠ]/u' => 'p',
        '/[ρΡ]/u' => 'r',
        '/[σςΣ]/u' => 's',
        '/[τΤ]/u' => 't',
        '/[υύϋΥΎΫ]/u' => 'y',
        '/[φΦ]/iu' => 'f',
        '/[ωώ]/iu' => 'o',

        '/[«]/iu' => '',
        '/[»]/iu' => ''
		);		
		
		// Translitaration
		$text = preg_replace(
			array_keys( $expressions ),
			array_values( $expressions ),
			$str
		);		
		
		return $text;
		
		//...
		//$retstr = preg_replace('/\s\s+/', ' ', $str);
		//return $retstr;
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

};
}
?>