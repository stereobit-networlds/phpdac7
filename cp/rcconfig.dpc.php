<?php
$__DPCSEC['RCCONFIG_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCCONFIG_DPC")) && (seclevel('RCCONFIG_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCCONFIG_DPC",true);

$__DPC['RCCONFIG_DPC'] = 'rcconfig';

$a = GetGlobal('controller')->require_dpc('gui/form.dpc.php');
require_once($a);

$__EVENTS['RCCONFIG_DPC'][0]='cpconfig';
$__EVENTS['RCCONFIG_DPC'][1]='cpconfedit';
$__EVENTS['RCCONFIG_DPC'][2]='cpconfdel';
$__EVENTS['RCCONFIG_DPC'][3]='cpconfadd';
$__EVENTS['RCCONFIG_DPC'][4]='cpconfmod';

$__ACTIONS['RCCONFIG_DPC'][0]='cpconfig';
$__ACTIONS['RCCONFIG_DPC'][1]='cpconfedit';
$__ACTIONS['RCCONFIG_DPC'][2]='cpconfdel';
$__ACTIONS['RCCONFIG_DPC'][3]='cpconfadd';
$__ACTIONS['RCCONFIG_DPC'][4]='cpconfmod';

$__LOCALE['RCCONFIG_DPC'][0]='RCCONFIG_DPC;Configuration;Configuration;';
$__LOCALE['RCCONFIG_DPC'][1]='SHFORM;Contact Form;Φόρμα επικοινωνίας;';
$__LOCALE['RCCONFIG_DPC'][2]='RCXMLFEEDS;Xml Feeds;Xml αρχεία;';
$__LOCALE['RCCONFIG_DPC'][3]='SHSUBSCRIBE;Subscription;Συνδρομές;';
$__LOCALE['RCCONFIG_DPC'][4]='SHKATALOG;Page view;Προβολή σελίδας;';
$__LOCALE['RCCONFIG_DPC'][5]='SHKATALOGMEDIA;Page view (ext.);Προβολή σελίδας (ext.);';
$__LOCALE['RCCONFIG_DPC'][6]='RCITEMREL;Item relations;Συσχετισμοί ειδών;';
$__LOCALE['RCCONFIG_DPC'][7]='RCSYNCSQL;SQL Syncs;Συγχρονισμοί SQL;';
$__LOCALE['RCCONFIG_DPC'][8]='RCTRANSSQL;Dynamic SQL;Δυναμική SQL;';
$__LOCALE['RCCONFIG_DPC'][9]='SHCART;Cart;Καλάθι;';
$__LOCALE['RCCONFIG_DPC'][10]='SHEUROBANK;Eurobank;Eurobank;';
$__LOCALE['RCCONFIG_DPC'][11]='SHPAYPAL;Paypal;Paypal;';
$__LOCALE['RCCONFIG_DPC'][12]='RCITEMS;Items (cp);Είδη (cp);';
$__LOCALE['RCCONFIG_DPC'][13]='SHLOGIN;Login;Login;';
$__LOCALE['RCCONFIG_DPC'][14]='SHUSERS;Users;Χρήστες;';
$__LOCALE['RCCONFIG_DPC'][15]='SHCUSTOMERS;Customers;Πελάτες;';
$__LOCALE['RCCONFIG_DPC'][16]='SHTRANSACTIONS;Transactions;Συναλλαγές;';
$__LOCALE['RCCONFIG_DPC'][17]='RCCUSTOMERS;Customers (cp);Πελάτες (cp);';
$__LOCALE['RCCONFIG_DPC'][18]='SHKATEGORIES;Categories;Κατηγορίες;';
$__LOCALE['RCCONFIG_DPC'][19]='SHMENU;Menu;Μενού;';
$__LOCALE['RCCONFIG_DPC'][20]='SHLANGS;Languages;Γλώσσες;';
$__LOCALE['RCCONFIG_DPC'][21]='RECAPTCHA;Recaptcha;Recaptcha;';
$__LOCALE['RCCONFIG_DPC'][22]='SHNSEARCH;Search;Αναζήτηση;';
$__LOCALE['RCCONFIG_DPC'][23]='SHDOWNLOAD;Downloads;Μεταφορτώσεις;';
$__LOCALE['RCCONFIG_DPC'][24]='RCSHSUBSCRIBERS;Subscribers (cp);Συνδρομητές (cp);';
$__LOCALE['RCCONFIG_DPC'][25]='RCSHSUBSQUEUE;Mail queue (cp);Αποστολές email(cp);';
$__LOCALE['RCCONFIG_DPC'][26]='RCBULKMAIL;Bulk mail (cp);Μαζικές αποστολές (cp);';
$__LOCALE['RCCONFIG_DPC'][27]='RCCOLLECTIONS;Collections;Συλλογές;';
$__LOCALE['RCCONFIG_DPC'][28]='SHTAGS;Tags;Tags;';
$__LOCALE['RCCONFIG_DPC'][29]='RCUSERS;Users (cp);Χρήστες (cp);';
$__LOCALE['RCCONFIG_DPC'][30]='FRONTHTMLPAGE;Page options;Ρυθμίσεις σελίδας;';
$__LOCALE['RCCONFIG_DPC'][31]='MEDIA-CENTER;Theme options;Ρυθμίσεις θέματος;';
$__LOCALE['RCCONFIG_DPC'][32]='CKEDITOR;CK Editor;Κειμενογράφος;';
$__LOCALE['RCCONFIG_DPC'][33]='SLIDESHOW;Slide show;Slide show;';
$__LOCALE['RCCONFIG_DPC'][34]='RCAWSTATS;AW stats;Στατιστικά aw;';
$__LOCALE['RCCONFIG_DPC'][35]='RCCONTROLPANEL;Control panel;Πίνακας ελέγχου;';
$__LOCALE['RCCONFIG_DPC'][36]='INDEX;My configuration;Οι ρυθμίσεις μου;';
$__LOCALE['RCCONFIG_DPC'][37]='ESHOP;e-shop;e-shop;';
$__LOCALE['RCCONFIG_DPC'][38]='RCSHSUBSQUEUE;Mail queue;Αποστολές email;';

$__LOCALE['RCCONFIG_DPC'][98]='_edit;Edit;Επεξεργασία;';
$__LOCALE['RCCONFIG_DPC'][99]='_del;Del;Αφαίρεση;';

//WARNING :TO OVERWRITE CONFIG VALUES USE THIS CLASS AS SUPER IN PHP FILES

class rcconfig {

    var $crlf, $path, $title;
	var $g_config;
	var $t_config;
	var $config; //merged 
	var $tabheaders;
	var $seclevid, $owner;
	
    public function __construct() {
	
	    $this->title = localize('RCCONFIG_DPC',getlocal());		
	
	    $os =  php_uname();//'>';
        $info = strtolower($os);// $_SERVER['HTTP_USER_AGENT'] );  
        $this->crlf = ( strpos( $info, "windows" ) === false ) ? "\n" : "\r\n" ;	
		  
		$this->path = paramload('SHELL','prpath');		
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] :GetSessionParam('ADMINSecID');
		$this->owner = GetSessionParam('LoginName');
	
	    //get global config
        $this->g_config = GetGlobal('config');	
		//get local config
		$this->t_config = $this->read_config();
		//merge 2 configs		
		$this->config = $this->merge_configurations();
		  	  
		$this->tabheaders = array();
	}
	
    public function event($event=null) {	
	
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	
	
		switch ($event) {

			case "cpconfmod" :	$this->paramset(null,GetReq('var'),GetReq('val'));
                                break;	   

			case "cpconfedit": 	break;
			case "cpconfdel" :	if ($this->backup_config()) {
									$this->write_config(GetParam('cpart'),GetParam('cvar'));  
									$this->t_config = $this->read_config(); //re-read
								}
								else 
									echo 'Backup conf failed!';	
								break;
			case "cpconfadd" :	break;								 							 
			case "cpconfig"  :     
			default          : 	if (GetReq('save')==1) {
									if ($this->backup_config()) {
										$this->write_config();  
										$this->t_config = $this->read_config(); //re-read
									}
									else 
										echo 'Backup conf failed!';
								}
								elseif (GetReq('add')==1) {
									$this->paramset(GetParam('section'),GetParam('variable'),GetParam('value'));
									if ($this->backup_config()) {
										$this->write_config();  
										$this->t_config = $this->read_config(); //re-read
									}
									else 
										echo 'Backup conf failed!';			
								}								
		}
	  	  
    }
  
    public function action($action=null) {
		$cpart = GetReq('cpart') ? GetReq('cpart') : null;
		
	    $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;	   

		switch ($action) {	
	   
			case "cpconfmod" :  $out = $this->edit_configuration("Edit","cpconfedit",true,$cpart); 
                                break;	  	   
			case "cpconfedit":  $out = $this->edit_configuration("Save","cpconfig&save=1",false,$cpart);
		                        break;
			case "cpconfdel" :  $out = $this->show_configuration("Edit","cpconfedit",true,$cpart); 
								break;
			case "cpconfadd" :  $out = $this->add_configuration("Add","cpconfig&add=1",$cpart);  
								break;	
			case "cpconfig"  :     
			default          :  $out = $this->show_configuration("Edit","cpconfedit",true,$cpart); 
								 
        }
	 
	    return ($out);
    } 	
	
	
	//to call from page
	public function tabheaders() {
		
        return (implode('',$this->tabheaders));
	}

	protected function setTabHeader($id, $title, $isactive=false) {
		
		$tmpl = $isactive ? 'tab-header-active' : 'tab-header';
        $data = _m("cmsrt.select_template use $tmpl+1");
		$tokens[] = $id;
		$tokens[] = $title;
		
		$out = $this->combine_tokens($data,$tokens,true);
		return ($out);
	}

		
	protected function setTabBody($id, $body, $isactive=false) {
		
		$tmpl = $isactive ? 'tab-content-active' : 'tab-content';
        $data = _m("cmsrt.select_template use $tmpl+1");
		$tokens[] = $id;
		$tokens[] = $body;
		
		$out = $this->combine_tokens($data,$tokens,true);
		return ($out);
	}

	protected function setTabInput($id, $name, $value=null, $etext=null) {
		
		$tmpl = 'tab-form-input';
        $data = _m("cmsrt.select_template use $tmpl+1");
		$tokens[] = ucfirst(strtolower($name));	
		$tokens[] = $id;
		$tokens[] = $value;	
		$tokens[] = $etext;
		
		$out = $this->combine_tokens($data,$tokens,true);
		return ($out);
	}	
	
	protected function editButton($section) {
        $url = "cpconfig.php?t=cpconfedit&cpart=".$section;
		
		if (($section=='INDEX')&&($this->seclevid>=8))
			$ret = '<button onClick="location.href=\''.$url.'\'" class="btn btn-info">'.localize('_edit',getlocal()).'</button><hr/>';
		elseif ($this->seclevid==9)
			$ret = '<button onClick="location.href=\''.$url.'\'" class="btn btn-info">'.localize('_edit',getlocal()).'</button><hr/>';
		else
			$ret = null;

		return ($ret);	
	}
	
	protected function delButton($section, $var) {
        $url = "cpconfig.php?t=cpconfdel&cpart=". $section . "&cvar=" . $var;
		
		if (($section=='INDEX')&&($this->seclevid>=8))
			$ret = '<button onClick="location.href=\''.$url.'\'" class="btn btn-danger">'.localize('_del',getlocal()).'</button><hr/>';
		elseif ($this->seclevid==9)
			$ret = '<button onClick="location.href=\''.$url.'\'" class="btn btn-danger">'.localize('_del',getlocal()).'</button><hr/>';
		else
			$ret = null;

		return ($ret);	
	}	
	
	protected function show_configuration($button_title,$action,$editable=false,$cpart=null) {
		$myaction = seturl("t=".$action."&cpart=".$cpart."&editmode=".GetReq('editmode')); 	
		$lan = getlocal();
	   
		if ($cpart) {//partial config
			foreach ($this->t_config as $section=>$data) {
				if ($section==$cpart) { 
		   
					$tabname = ucfirst(localize($section, $lan));
					$this->tabheaders[] = $this->setTabHeader(strtolower($section), $tabname, true);       
			 
					$b = $this->editButton($section);
					foreach ($data as $var=>$val) 
						$b .= $this->setTabInput(localize($var,$lan), $var, $val, $this->delButton($section, $var));

					$b .= $this->editButton($section);
					$ret = $this->setTabBody(strtolower($section), $b, true);			 
				}
			}		 
		}
		else {//all config
			$i=0; 
			foreach ($this->t_config as $section=>$data) {
				
				$tabname = ucfirst(localize($section, $lan));
				$this->tabheaders[] = $this->setTabHeader(strtolower($section), $tabname, ($i==0 ? true : false)); 
				
				$b = $this->editButton($section);
				foreach ($data as $var=>$val) 
					$b .= $this->setTabInput(localize($var,$lan), $var, $val, $this->delButton($section, $var));

				$b .= $this->editButton($section);
				$ret .= $this->setTabBody(strtolower($section), $b, ($i==0 ? true : false));
				$i+=1;
			}
		}
	   
		return ($ret);   
	}

	protected function edit_configuration($button_title,$action,$editable=false,$cpart=null) {
		$lan = getlocal();
		$myaction = seturl("t=".$action."&cpart=".$cpart."&editmode=".GetReq('editmode')); 	
		$form = new form(localize('RCCONFIG_DPC',getlocal()), "RCCONFIG", FORM_METHOD_POST, $myaction);	
	   
		if ($cpart) {//partial config
			foreach ($this->t_config as $section=>$data) {
				if ($section==$cpart) { 
					$form->addGroup($section,ucfirst(localize($section, $lan)));
		  	   
					foreach ($data as $var=>$val) 
						$form->addElement($section,new form_element_text($var,strtolower($section).$var,$val,"span11",60,255,$editable));
				}
				$form->addElement($section,new form_element_onlytext("New element",seturl("t=cpconfadd&section=$section&cpart=$cpart&editmode=".GetReq('editmode'),'press here'),"span11"));
			}	   
		}
		else {//all config
			foreach ($this->t_config as $section=>$data) {
				if ($section) 
					$form->addGroup($section,ucfirst(localize($section, $lan)));
		  	   
				foreach ($data as $var=>$val) 
					$form->addElement($section,new form_element_text($var,strtolower($section).$var,$val,"span11",60,255,$editable));
		 
				$form->addElement($section,new form_element_onlytext("New element",seturl("t=cpconfadd&section=$section&cpart=$cpart&editmode=".GetReq('editmode'),'press here'),"span11"));
			}
		}
	   
		// Adding a hidden field
		$form->addElement(FORM_GROUP_HIDDEN,new form_element_hidden ("FormAction", "$action"));
 
		// Showing the form
		$fout = $form->getform(0,0,$button_title);	
	   
		return ($fout);	   
	}
	
	protected function add_configuration($button_title,$action,$cpart=null) {
		$myaction = seturl("t=".$action."&cpart=".$cpart."&editmode=".GetReq('editmode')); 	
		$form = new form(localize('RCCONFIG_DPC',getlocal()), "RCCONFIG", FORM_METHOD_POST, $myaction);	
		$lan = getlocal();	
		if ($section=GetReq('section')) {
			$form->addGroup($section,ucfirst(localize($section, $lan)));		
		 
			$data = $this->t_config[$section];
			foreach ($data as $var=>$val) 
				$form->addElement($section,new form_element_onlytext($var,$val,"span11",20,255,0));
		 	
			$form->addElement($section,new form_element_text('variable','variable','variable',"span11",20,255,0));		 	 
			$form->addElement($section,new form_element_text('value','value','value',"span11",20,255,0));			 
		 
			// Adding section as hidden field
			$form->addElement		(FORM_GROUP_HIDDEN,		new form_element_hidden ("section", $section));		 
		 
			// Adding a hidden field
			$form->addElement		(FORM_GROUP_HIDDEN,		new form_element_hidden ("FormAction", "$action"));
		}	
	   
		// Showing the form
		$fout = $form->getform(0,0,$button_title);	
	   
		return ($fout);		   	    
	}
	
    public function paramload($section,$param) {
        $config = $this->t_config;

        if (is_array($config[$section]))     
			return ($config[$section][$param]);
    }
	
	public function paramset($section=null,$param=null,$value=null) {
		if (!$param) return false;

		$parts = explode('.',$param);
		if ($parts[1]) {

			$param = $parts[1];
			$section = strtoupper($parts[0]);
		}	
	
	    $this->t_config[$section][$param] = $value;
		return true;
	}

    public function arrayload($section,$array) {
        $config = $this->t_config;
  
        if (is_array($config[$section]))
			$data = $config[$section][$array];
	
	    if ($data) 
			return(explode(",",$data));
    }
	
	public function arrayset($section,$array,$serialized_array=null) {
	
	    $data = unserialize($serialized_array);
		  
	    if (is_array($data)) 
		    $this->t_config[$section][$array] = implode(",",$data) . $this->crlf;
	}
	
	public function read_config() {
	
	    $conf = $this->path . "myconfig.txt.php";
		include($conf);
		$ret = parse_ini_string($myconf,1, INI_SCANNER_RAW);

		return ($ret);
		/*
	    $filename = "myconfig.txt"; //relative and in the same dir
	
		if (file_exists($filename) && is_readable($filename)) {
			$ret = parse_ini_file($filename,1, INI_SCANNER_NORMAL);

			//print "<pre>"; print_r($ret); print "</pre>";
			return ($ret);
		}
		*/	
	}
	
	public function write_config($_section=null,$_param=null) {
		
		$this->storeMessage();
		
		foreach ($this->t_config as $section=>$params) {
			 
			$fileCONTENTS .= $this->crlf;
			$fileCONTENTS .= '[' . strtoupper($section) . ']' . $this->crlf;
			
			foreach ($params as $var=>$val) {
			  
			    if ($newval = GetParam(strtolower($section).$var)) {
				  
					$myval = ($newval=='null') ? ';null' : $newval; 
					$fileCONTENTS .= $var . '=' . $myval . $this->crlf;
				}	
				else {
					if (($_section==$section) && ($_param==$var)) 
					{} //remove variable
					else 
						$fileCONTENTS .= $var . '=' . $val . $this->crlf;
				}	
			}
		}	
	    $conf = "myconfig.txt.php";
		$phpize = '<?php' . $this->crlf . '$myconf=<<<EOF' . $this->crlf;
		$phpize.= str_replace('"',"\"", $fileCONTENTS);
		$phpize.= $this->crlf . 'EOF;' . $this->crlf . '?>';
		return file_put_contents($conf, $phpize);	
	/*
	    $filename = "myconfig.txt";
		//echo '<pre>';
	    //print_r($this->t_config);
		//echo '</pre><pre>';
		//print_r($_POST);
		//echo '</pre>';
		//return null;
		 
		if (file_exists($filename) && is_writeable($filename)) {
		 
		    foreach ($this->t_config as $section=>$params) {
			 
			  $fileCONTENTS .= $this->crlf;
			  $fileCONTENTS .= '[' . strtoupper($section) . ']' . $this->crlf;
			
			  foreach ($params as $var=>$val) {
			  
			    if ($newval=GetParam(strtolower($section).$var)) {
				  
				  $myval = ($newval=='null') ? ';null' : $newval; 
				  //if ($newval=='null') echo $myval,'<br/>';
				  $fileCONTENTS .= $var . '=' . $myval . $this->crlf;
				}  
				else //as is 
			      $fileCONTENTS .= $var . '=' . $val . $this->crlf;
			  }
			}
		    
			//echo $fileCONTENTS;
            $hFile = fopen( $filename, "w+" );
            fwrite( $hFile, $fileCONTENTS );
            fclose( $hFile );		 	
		}*/
	} 
	
	protected function merge_configurations() {
		if (!is_array($this->t_config)) return;		
	    global $config;
	
	    foreach ($this->t_config as $section=>$data) {
			foreach ($data as $var=>$val) {
		  
				if ((is_array($config[$section])) && (array_key_exists($var,$config[$section]))) 
					$config[$section][$var] = $val; 
				else
					$config[$section][$var] = $val;  
			}
		}
		
		return ($config);
	} 

	public function backup_config() {	
	    $date = date('Ymd');
	
		$filename = "myconfig.txt.php";	
		$backup_filename = $date . "-myconfig.txt.php";
		$ret = @copy($filename, $backup_filename);		
		
		return ($ret);
		/*
		$filename = "myconfig.txt";	
		$backup_filename = $date . "myconfig.txt";
		$ret = @copy($filename, $backup_filename);	 
		 
		return ($ret);
		*/
	}

	//one step write... called by wizard to save data to myconfig
	public function setconf($param=null, $value=null) {
	    if (!$param) return false;
		if (!stristr($param,'.')) return false;

		$this->paramset(null,$param,$value);	
	    if ($this->backup_config()) {

			$this->write_config();  
			$this->t_config = $this->read_config();   
			return true;

		}

		return false;
    } 	
	
	//one step read... called by wizard to save data to myconfig
	public function getconf($param=null) {
	    if (!$param) return false;
		if (!stristr($param,'.')) return false;
        $p = explode('.',$param);
		$section = $p[0];
		$pname = $p[1];
		
		$ret = $this->t_config[$section][$pname];	

		return ($ret ? $ret : false);
    } 	
	
	//called by rccontrolpanel to check expired services
	public function get_expirations($param=null) {
	   
	    foreach ($this->t_config as $section=>$data) {
			foreach ($data as $var=>$val) {
	    
				if ($var=='expires') {
					$exps[$section] = $val;
					//echo $section,'=',$val;
				}
			}			
	    }
		
		return (serialize($exps));
	}
	
	//insert message into db	
	protected function storeMessage() {
		$db = GetGlobal('db');
	    $date = date('Ymd');		
		
		$sSQL = "insert into cpmessages (hash, msg, type, owner) values (";
		$sSQL.= $db->qstr(md5($date.'config')) . ",";
		$sSQL.= $db->qstr('Configuration file modified') . ",";
		$sSQL.= $db->qstr('system') . ",";
		$sSQL.= $db->qstr($this->owner);
		$sSQL.= ")";
		$result = $db->Execute($sSQL,1);			 	
		
		return true;
	}
	
	protected function combine_tokens(&$template_contents, $tokens, $execafter=null) {
	
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
		for ($x=$i;$x<30;$x++)
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

};
}
?>