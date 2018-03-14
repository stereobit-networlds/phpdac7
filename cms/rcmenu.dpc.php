<?php
$__DPCSEC['RCMENU_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCMENU_DPC")) && (seclevel('RCMENU_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCMENU_DPC",true);

$__DPC['RCMENU_DPC'] = 'rcmenu';

$a = GetGlobal('controller')->require_dpc('gui/form.dpc.php');
require_once($a);

$d = GetGlobal('controller')->require_dpc('cms/cmsmenu.dpc.php');
require_once($d);

$__EVENTS['RCMENU_DPC'][0]='cpmconfig';
$__EVENTS['RCMENU_DPC'][1]='cpmconfedit';
$__EVENTS['RCMENU_DPC'][2]='cpmconfdel';
$__EVENTS['RCMENU_DPC'][3]='cpmconfadd';
$__EVENTS['RCMENU_DPC'][4]='cpmsavenest';
$__EVENTS['RCMENU_DPC'][5]='cpmloadnest';
$__EVENTS['RCMENU_DPC'][6]='cpmnewmenu';
$__EVENTS['RCMENU_DPC'][7]='cpmselectmenu';
$__EVENTS['RCMENU_DPC'][8]='cpmnewelement';
$__EVENTS['RCMENU_DPC'][9]='cpmaddelement';

$__ACTIONS['RCMENU_DPC'][0]='cpmconfig';
$__ACTIONS['RCMENU_DPC'][1]='cpmconfedit';
$__ACTIONS['RCMENU_DPC'][2]='cpmconfdel';
$__ACTIONS['RCMENU_DPC'][3]='cpmconfadd';
$__ACTIONS['RCMENU_DPC'][4]='cpmsavenest';
$__ACTIONS['RCMENU_DPC'][5]='cpmloadnest';
$__ACTIONS['RCMENU_DPC'][6]='cpmnewmenu';
$__ACTIONS['RCMENU_DPC'][7]='cpmselectmenu';
$__ACTIONS['RCMENU_DPC'][8]='cpmnewelement';
$__ACTIONS['RCMENU_DPC'][9]='cpmaddelement';

$__LOCALE['RCMENU_DPC'][0]='RCMENU_DPC;Menu Configuration;Menu Configuration;';
$__LOCALE['RCMENU_DPC'][1]='_newelement;New element;Νέο στοιχείο;';
$__LOCALE['RCMENU_DPC'][2]='_presshere;Press here;Πατήστε εδώ για εισαγωγή;';
$__LOCALE['RCMENU_DPC'][3]='title;Title;Τίτλος;';
$__LOCALE['RCMENU_DPC'][4]='link;Url;Δεσμός Url;';
$__LOCALE['RCMENU_DPC'][5]='_mainmenu;Main menu;Κεντρικό μενού;';
$__LOCALE['RCMENU_DPC'][6]='_newmenu;New;Νέο;';
$__LOCALE['RCMENU_DPC'][7]='_menu;Menu;Μενού;';
$__LOCALE['RCMENU_DPC'][8]='_collapse;Collapse;Συρίκνωση;';
$__LOCALE['RCMENU_DPC'][9]='_expand;Expand;Επέκταση;';
$__LOCALE['RCMENU_DPC'][10]='_save;Save;Αποθήκευση;';
$__LOCALE['RCMENU_DPC'][11]='_currentmenu;Current;Τρέχον;';
$__LOCALE['RCMENU_DPC'][12]='_saved;Saved;Αποθηκεύτηκε;';
$__LOCALE['RCMENU_DPC'][13]='_notsaved;Not saved;Δεν αποθηκεύτηκε;';
$__LOCALE['RCMENU_DPC'][14]='_edit;Edit;Επεξεργασία;';
$__LOCALE['RCMENU_DPC'][15]='_add;Add;Προσθήκη;';
$__LOCALE['RCMENU_DPC'][16]='_newmenu;New menu;Νέο μενού;';
$__LOCALE['RCMENU_DPC'][17]='_menuname;Menu name;Όνομα μενού;';
$__LOCALE['RCMENU_DPC'][18]='_ferror;File error;Πρόβλημα στο αρχείο;';
$__LOCALE['RCMENU_DPC'][19]='_fsuccess;File created;Το αρχείο δημιουργήθηκε;';
$__LOCALE['RCMENU_DPC'][20]='_dropelement;Drop elements;Στοιχείο εναπόθεσης;';
$__LOCALE['RCMENU_DPC'][21]='_newelm;New element;Νέο στοιχείο;';
$__LOCALE['RCMENU_DPC'][22]='_elmname;Element name;Όνομα στοιχείου;';
$__LOCALE['RCMENU_DPC'][23]='_elmurl;Element url;Σύνδεσμος στοιχείου;';
$__LOCALE['RCMENU_DPC'][24]='_selectmenu;Select menu;Επιλέξτε μενού;';

class rcmenu extends cmsmenu {

    var $crlf, $path, $title;
	var $t_config, $t_config0, $t_config1, $t_config2;
	var $edit_per_lan, $selectedMenu, $post, $element;
	
    public function __construct() {
	
	    parent::__construct();
	
	    $this->title = localize('RCMENU_DPC',getlocal());		
	
	    $os =  php_uname();
        $info = strtolower($os);  
        $this->crlf = PHP_EOL; //( strpos( $info, "windows" ) === false ) ? "\n" : "\r\n" ;	
		   
		$this->path = paramload('SHELL','prpath');				  
	    $this->edit_per_lan = true; //false;
		$this->t_config = array();		
		$this->selectedMenu = GetParam('menu');
		$this->post = null;	
		$this->element = null;	
	}
	
    public function event($event=null) {			
	
	   	$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;		
	    	    		  			    
		switch ($event) {	
		
			case "cpmaddelement"    :   $this->t_config = $this->read_config();
										if ($elmname = $_POST['elmname'])
											$this->element = $this->addElement();
										break;
										
			case "cpmnewelement"  	:   $this->t_config = $this->read_config();
			                            break;							
		
		    case "cpmselectmenu"    :	$this->t_config = $this->read_config();
										if ($newmenu = $_POST['menu'])
											$this->post = $this->createMenu($newmenu);
			                            break;
										
			case "cpmnewmenu"       :	$this->t_config = $this->read_config();
										break;
			
			case "cpmloadnest"      : 	$this->t_config = $this->read_config();
										$this->loadNestList(); die();
										break;	
											
			case "cpmsavenest"      : 	$this->t_config = $this->read_config();
										$this->saveNestList($this->selectedMenu); die();
										break;
											
			case "cpmconfedit"      :	
			case "cpmconfdel"       :	
			case "cpmconfadd"       :									 
			case "cpmconfig"        :     
			default                 :	$this->t_config = $this->read_config();
										if (GetReq('save')==1) {
											//echo 'save';
											$this->write_config();  
											$this->t_config = $this->read_config(); //re-read
										}	 
										elseif (GetReq('add')==1) {
											//echo 'add';

											$this->paramset(GetParam('section'),GetParam('variable'),GetParam('value'));
											/*for ($z=0;$z<=2;$z++) {
												$tvar = 't_config'.$z;
												print "<pre>"; print_r($this->{$tvar}); print "</pre>";
											}*/	
	  
											$this->write_config();  
											$this->t_config = $this->read_config(); //re-read
										}				
		}	  
    }
  
    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;			

		switch ($action) {	
		
			case "cpmaddelement"    :	break;	
			case "cpmnewelement"   	:	$out = $this->newElement(localize('_newelm', getlocal()),"cpmaddelement"); 
										break;										
		
		    case "cpmselectmenu"    :	$out = $this->menuMessage($this->post);
			                            break;
			case "cpmnewmenu"       :	$out = $this->newMenu(localize('_newmenu', getlocal()),"cpmselectmenu"); 
										break;		
	   
			case "cpmloadnest"      :	break;	 	   
			case "cpmsavenest"      :	break;	   

			case "cpmconfedit"      :   $out = $this->show_configuration(localize('_save', getlocal()),"cpmconfig&save=1",false);
										break;
			case "cpmconfdel"       :	break;
			case "cpmconfadd"       :   $out = $this->add_configuration(localize('_add', getlocal()),"cpmconfig&add=1");  
										break;								 						 
										 							
			case "cpmconfig"        :     
			default                 :   $out = (GetParam('ismain')=='1') ? 
											$this->show_configuration(localize('_save', getlocal()),"cpmconfedit&save=1",false) : null; 							 
		}
	 
		return ($out);
    } 	
	
	protected function show_configuration($button_title,$action,$editable=false) {
		$myaction = seturl("t=".$action); 	
		$form = new form(localize('RCMENU_DPC',getlocal()), "RCMENU", FORM_METHOD_POST, $myaction);	
		 
		//show params by language
		if ($this->edit_per_lan) {
			$lan = getlocal() ? getlocal() :'0';	   
			$tvar = 't_config'.$lan;
			$c_config = $this->$tvar;
		}
		else
			$c_config = (array)$this->t_config; 	   
	
		foreach ($c_config as $section=>$data) {
	   
			if ($section) $form->addGroup($section,ucfirst(strtolower($section)));
		  	   
			foreach ($data as $var=>$val) {
				$sectionvar = $section .'-'. $var;
				$localize_var = localize($var,getlocal());
				$form->addElement($section,new form_element_text($localize_var,$sectionvar,$val,"span6",60,255,$editable));
			}
			$newelement = localize("_newelement",getlocal());
			$presshere = localize("_presshere",getlocal());
			$form->addElement($section,new form_element_onlytext($newelement,seturl("t=cpmconfadd&section=$section",$presshere),"forminput"));
		}
	   
		// Adding a hidden field
		$form->addElement		(FORM_GROUP_HIDDEN,		new form_element_hidden ("FormAction", "$action"));
		$form->addElement		(FORM_GROUP_HIDDEN,		new form_element_hidden ("ismain", "1"));
 
		// Showing the form
		$fout = $form->getform(0,0,$button_title);	
   		//$fout.= '<br/>';
				
		return ($this->window($this->title,null,$fout));	   
	}
	
	protected function add_configuration($button_title,$action) {
		$myaction = seturl("t=".$action); 
		$title = localize('_add', getlocal());	
		$form = new form(localize('RCMENU_DPC',getlocal()), "RCMENU", FORM_METHOD_POST, $myaction);	
		
		if ($section=GetReq('section')) {
			$form->addGroup($section,ucfirst(strtolower($section)));		
		 
			$data = $this->t_config[$section];
			foreach ($data as $var=>$val) 
				$form->addElement($section,new form_element_onlytext($var,$val,"span6",60,255,0));
		 	
			$form->addElement($section,new form_element_text('variable','variable','variable',"span6",60,255,0));		 	 
			$form->addElement($section,new form_element_text('value','value','value',"span6",60,255,0));			 
		 
			// Adding section as hidden field
			$form->addElement		(FORM_GROUP_HIDDEN,		new form_element_hidden ("section", $section));		 
		 
			// Adding a hidden field
			$form->addElement		(FORM_GROUP_HIDDEN,		new form_element_hidden ("FormAction", "$action"));
			$form->addElement		(FORM_GROUP_HIDDEN,		new form_element_hidden ("ismain", "1"));
		}	
	   
		// Showing the form
		$fout = $form->getform(0,0,$button_title);	
				
		return ($this->window($title .' '. ucfirst(strtolower($section)),null,$fout));		   	    
	}
	
    public function paramload($section,$param) {
        $config = $this->t_config;

        if (is_array($config[$section]))     
	        return ($config[$section][$param]);

    }
	
	public function paramset($section=null,$param=null,$value=null) {
	    //if param is of type foo.bar the section=foo param=bar
		//echo $param;

		$parts = explode('.',$param);
		if ($parts[1]) {//if ok
			//echo '.';
			$param = $parts[1];
			$section = strtoupper($parts[0]);
		}	
	
        //set by language
		if ($this->edit_per_lan) {
		  	$lan = getlocal() ? getlocal() :'0';	   
			
			if (strstr($value,$this->delimiter )) {
				$parts = explode($this->delimiter ,$value);
				foreach ($parts as $lan=>$val) {
					$tvar = 't_config'.$lan;
					$this->{$tvar}[$section][$param] = $val;
				}
			}
			else {
				for ($z=0;$z<=2;$z++) {
					$tvar = 't_config'.$z;
					$this->{$tvar}[$section][$param] = $value;	
				}	
			}
		} 
		else
	        $this->t_config[$section][$param] = $value;
		
		//print_r($this->t_config);
	}

    public function arrayload($section,$array) {
        $config = $this->t_config;//GetGlobal('config');
  
        if (is_array($config[$section]))
            $data = $config[$section][$array];
	
	    if ($data) 
			return(explode(",",$data));
    }
	
	public function arrayset($section,$array,$serialized_array=null) {
	
	    $data = unserialize($serialized_array);
		  
	    if (is_array($data)) 
		    $this->t_config[$section][$array] = implode(",",$data) . $this->crlf;
		//else //common param
		    //$this->paramset($section,$array,$serialized_array);
	}
	
	protected function read_config() {
	    $filename = $this->path . "menu.ini";
	
		if (file_exists($filename) && is_readable($filename)) {
			$ret = parse_ini_file($filename,1,INI_SCANNER_RAW);

			//select by language
			if ($this->edit_per_lan) {
		        foreach ($ret as $section=>$param) {
					foreach ($param as $pt=>$pv) {
						$pparts = explode($this->delimiter ,$pv); 
						foreach ($pparts as $i=>$pp) {
							$retperlan[$i][$section][$pt] = $pp;
						}
					}
		        }

                for ($z=0;$z<=2;$z++) {
				    $tvar = 't_config'.$z;
                    $this->$tvar = (array) $retperlan[$z];	
				}		
	            //echo '<pre>';
	            //print_r($this->t_config1);//print_r($retperlan);
		        //echo '</pre>';										
			}
			//print "<pre>"; print_r($ret); print "</pre>";
			return ($ret);
		}  
	}
	
	protected function write_config() {
	    //echo '<pre>';
	    //print_r($_POST);
		//echo '</pre>';
		 
	    $filename = $this->path . "menu.ini";
	
		if (file_exists($filename) && is_writeable($filename)) {
		 
			//write by language ..merge
			if ($this->edit_per_lan) {
		  
				$lan = getlocal() ? getlocal() :'0';	   
				$tvar = 't_config'.$lan;
				$c_config = $this->$tvar;			
			
				//echo '<pre>';
				//$tvar2 = 't_config0';//.$lan;
				//print_r($this->$tvar);//print_r($retperlan);
				//echo '</pre>';				
			
				foreach ($c_config as $section=>$params) {
			 
					$fileCONTENTS .= $this->crlf;
					$fileCONTENTS .= '[' . strtoupper($section) . ']' . $this->crlf;
			
					foreach ($params as $var=>$val) {
						$sectionvar = $section .'-'. $var;
				
						if ($newval=GetParam($sectionvar)) {
							switch ($lan) {
								case 2 : $lan_new_val = $this->t_config0[$section][$var].$this->delimiter .$this->t_config1[$section][$var].$this->delimiter .$newval;
										break;
								case 1 : $lan_new_val = $this->t_config0[$section][$var].$this->delimiter .$newval.$this->delimiter .$this->t_config2[$section][$var];
										break;
								case 0 :
								default: $lan_new_val = $newval.$this->delimiter .$this->t_config1[$section][$var].$this->delimiter .$this->t_config2[$section][$var];
							}
							//$fileCONTENTS .= $var . '=' . $newval . $this->crlf;
							$fileCONTENTS .= $var . '=' . $lan_new_val . $this->crlf;

						}  
						else {//as is
							$asis = $this->t_config0[$section][$var].$this->delimiter .$this->t_config1[$section][$var].$this->delimiter .$this->t_config2[$section][$var];
							$fileCONTENTS .= $var . '=' . /*$val*/$asis . $this->crlf;
						}  
					}
				}
			}
			else {   
				foreach ($this->t_config as $section=>$params) {
			 
					$fileCONTENTS .= $this->crlf;
					$fileCONTENTS .= '[' . strtoupper($section) . ']' . $this->crlf;
			
					foreach ($params as $var=>$val) {
						$sectionvar = $section .'-'. $var;
				
						if ($newval=GetParam($sectionvar))
							$fileCONTENTS .= $var . '=' . $newval . $this->crlf;
						else //as is
							$fileCONTENTS .= $var . '=' . $val . $this->crlf;
					}
				}
			}//else	
			//echo $fileCONTENTS;
		  
			//keep backup copy
			@copy($filename, str_replace('.ini','._ni', $filename));
		  
			$hFile = fopen( $filename, "w+" );
			fwrite( $hFile, $fileCONTENTS );
			fclose( $hFile );		 	
		}//if file exists
	}
	
	/*2 level tree saver (language based)*/
	protected function writenest_config($nestarray=null, $file=null) {
		$data = $nestarray ? $nestarray : json_decode(GetParam('list'),true);//as come from ajax post		
		$lan = getlocal() ? getlocal() : '0';
		$ret = null;		
		
		$csep = _v("cmsrt.cseparator");
		//var_export($data);	

		$menufile = $file ? (($file=='menu') ? $file : 'menu-' . $file) : 'menu';
        $filename = $this->path . $menufile . $lan . '.ini';	
		//echo $filename;
		
        $fileCONTENTS = null;
		if (!empty($data)) {

            foreach ($data as $i=>$id) {
			    if ($id['id']=='recycle-bin') continue; //drop
				
				$fileCONTENTS .= "[" . $id['id'] . "]" . $this->crlf;
				$fileCONTENTS .= "title=" . $id['name'] . $this->crlf; 
				$fileCONTENTS .= "link=" . str_replace($csep, '^', $id['value']) . $this->crlf;
				$fileCONTENTS .= "spaces=0". $this->crlf;
				if ($submenu = $id['submenu'])
					$fileCONTENTS .= "submenu=" . $submenu . $this->crlf;
				
				$subCONTENTS = null;
				$submenu_items = $id['children'];
				if (is_array($submenu_items)) {//sub ids of nest
					$subCONTENTS = $this->crlf;
					$subCONTENTS .= '['. $submenu . ']' . $this->crlf;
					foreach ($submenu_items as $ci=>$child) {
						$subCONTENTS .= "title$ci=" . $child['name'] . $this->crlf;						
						$subCONTENTS .= "link$ci=" . str_replace($csep, '^', $child['value']) . $this->crlf;						
					}
					$fileCONTENTS .= $subCONTENTS . $this->crlf;	
				}	
				$fileCONTENTS .= $this->crlf;
			}
			
			//keep backup copy
			@copy($filename, str_replace('.ini','._ni', $filename));
		  
			$hFile = fopen( $filename, "w+" );
			$ret = fwrite( $hFile, $fileCONTENTS );
			fclose( $hFile );				
		}

		return ($ret);		
	}
	
	protected function nestdditem($id,$name,$value=null,$submenu=null) {
		$ret = "<li class='dd-item' data-id='$id' data-name='$name' data-value='$value' data-submenu='$submenu'>
                    <div class='dd-handle'>$name</div>
                </li>";
		return ($ret);		
	}
	
	protected function nestddgroup($id,$name,$value=null,$submenu=null,$group=null) {
		$ret = "<li class='dd-item' data-id='$id' data-name='$name' data-value='$value' data-submenu='$submenu'>
					<div class='dd-handle'>$name</div>
					<ol class='dd-list'>
						$group
					</ol>
				</li>";
		return ($ret);	   
	}
	
	/*2 level conf file based nest loader*/
	public function nestBuild($file=null) {
		$n = null;
	    $lan = getlocal() ? getlocal() : '0';
		
	    if ($file) {
			$inifile = $this->path . $file . $lan . '.ini';
			$conf = @parse_ini_file($inifile, 1, INI_SCANNER_RAW);
		}	
		else
			$conf = $this->t_config;//$tvar;	
		
		//print_r($conf);
		if (!$conf) return;
		
		foreach ($conf as $section=>$params) {

            if (substr($section,-8)=='-SUBMENU') continue; //bypass subs		
			
			$cn = null;
			if (isset($params['submenu'])) {
                //echo $section.'-SUBMENU'; 
				$sb = isset($file) ? $params['submenu'] : explode(',', $params['submenu']);	
				$submenu = isset($file) ? $sb : $sb[$lan];
				if (isset($conf[$submenu])) {
				foreach ($conf[$submenu] as $group=>$child) {
				    //echo $child,'<br/>';
					if (substr($group,0,5)=='title') {
						$nz = isset($file) ? $child : explode(',', $child);
						$name = isset($file) ? $nz : $nz[$lan];
						
						$tl = isset($file)?	$conf[$section.'-SUBMENU'][str_replace('title','link',$group)] : 
											explode(',', $conf[$section.'-SUBMENU'][str_replace('title','link',$group)]);
						$value = isset($file) ? $tl : $tl[$lan];
						$linkvalue = $this->make_link($value);
						
						$cn .= $this->nestdditem($section.'-'.$name, $name, $linkvalue);
					}				
				}
				}
			}

			$nz = isset($file) ? $params['title'] : explode(',', $params['title']);
			$name = isset($file) ? $nz : $nz[$lan];
			$nl = isset($file) ? $params['link'] : explode(',', $params['link']);
			$value = isset($file) ? $nl : $nl[$lan];
			if ($cn)
				$n .= $this->nestddgroup($section, $name, $value, $submenu, $cn);
			else
				$n .= $this->nestdditem($section, $name, $value, md5($section.$name).'-SUBMENU');

		}    

		return $n;	
	}	
	
	protected function loadNestList() {
    }	
	
	protected function saveNestList($filename=null) {
		$list = GetParam('list');
		$menu = json_decode($list,true);//,false,5); //stdclass, depth 
		//@file_put_contents("menu.list", $list);				
		//var_export($menu);
		
		if ($menu) {
			//db based, delete menu first save after
			$this->deleteMenu($filename);
			//$this->createMenu($filename);//create master menu (use for copy from text while saving)
			$w = $this->saveMenu($filename, $menu);
		
			//text based save
			$w = $this->writenest_config($menu, $filename);
		}
		$ret = $w ? localize('_saved', getlocal()) : localize('_notsaved', getlocal());
		echo $ret;
		
		//tmp menu
		/*$tmplist = GetParam('tmplist');
		@file_put_contents("menutmp.list", $tmplist);
		$tmpmenu = json_decode($tmplist,true);
		$tmp = $this->writenest_config($tmpmenu, "menutmp");		
		
		echo $tmp ? $ret . " (1)" : $ret;
		*/
    }

	/* 2 level db menu loader */
	protected function loadMenu($name=null) {
		if (!$name) return null;
	    $lan = getlocal() ? getlocal() : '0';		
		$db = GetGlobal('db');
		
		$sSQL = "select type,isfather,ischild,relative,relation,notes,locale,orderid from relatives where ";
		$sSQL.= "type='$lan' and active=1 and ismenu=1 and ismaster=0 and locale=" . $db->qstr($name);
		$sSQL.= " ORDER BY orderid";
		//echo $sSQL;
	    $result = $db->Execute($sSQL);

		$menu = array();
		$submenu = array();
		foreach ($result as $i=>$rec) {
			
			$orderid = $rec['orderid'];
			$relative = $rec['relative'];
			$relation = $rec['relation'];
			
			if ($rec['ischild']) {
				$submenu[$relative][$orderid] = $rec['notes']; 				
			}
			elseif ($rec['isfather']) {
				$menu[$orderid] = $relation .'|'. $rec['notes']; 	
			}
		}	
		
		$ret = null;
		ksort($menu);
		foreach ($menu as $i=>$m) {
			$cn = null;
			list ($section, $name, $value) = explode('|', $m);
			
			if ($sb = (array) $submenu[$section]) {
				ksort($sb);
				foreach ($sb as $j=>$c) {
					list ($cname, $cvalue) = explode('|', $c);
					$cn .= $this->nestdditem(md5($section.$cname), $cname, $cvalue, md5($section.$cname).'-SUBMENU');
				}	
			}
			$ret .= $this->nestddgroup($section, $name, $value, $section.'-SUBMENU', $cn);
		}	
		
		return ($ret);
	}		
	
	/* n level db menu saver */
	protected function saveMenu($name=null, $data=null, $isfather=1, $ischild=0, $father=null) {
		if ((!$name)||(empty($data))) return null;
	    $lan = getlocal() ? getlocal() : '0';			
		$db = GetGlobal('db');		
		$csep = _v("cmsrt.cseparator");
		$rootfather = $father ? $father : $name;
		
		//insert menu
		foreach ($data as $i=>$m) {
			$id = $m['id'];
			$title = $m['name'];
			$link = str_replace($csep, '^', urldecode($m['value']));
			$submenu = $m['submenu'];
			$submenu_items = $m['children'];
			if (is_array($submenu_items)) 
				$this->saveMenu($id, $submenu_items, 0, 1, $rootfather);
			
			$sSQL = "insert into relatives (orderid,type,active,relative,relation,ismenu,ismaster,notes,locale,isfather,ischild) values (";
			$sSQL.= "$i,$lan,1,'$name','$id',1,0,'$title|$link','$rootfather',$isfather, $ischild)"; 
			$result = $db->Execute($sSQL);	
		}
		
		return true;
	}

	protected function deleteMenu($name=null, $delmaster=false) {
		if (!$name) return false;
		$db = GetGlobal('db');

		$sSQL = "delete from relatives where ismenu=1 and ismaster=0 and locale=" . $db->qstr($name);
		$resultset = $db->Execute($sSQL);
		if ($delmaster) {
			$sSQL = "delete from relatives where ismenu=1 and ismaster=1 and relative=" . $db->qstr($name);
			$resultset = $db->Execute($sSQL);
		}

		return true;	
	}

	protected function createMenu($name=null) {
		if (!$name) return;
		$lan = getlocal() ? getlocal() : '0';	
		$db = GetGlobal('db');
		
		$sSQL = "insert into relatives (orderid,type,active,relative,relation,ismenu,ismaster,notes,locale,isfather,ischild) values (";
		$sSQL.= "0,$lan,1,'$name','',1,1,'','',0,0)"; 
	    $result = $db->Execute($sSQL);		
		
		//create text ini
		$menufile = ($name=='menu') ? $name : 'menu-' . $name;
		$inifile = $this->path . $menufile . $lan . '.ini';
		$ret = @file_put_contents($inifile, "[NEW]\r\ntitle=New\r\nlink=\r\nspaces=0\r\n");
		
		$this->selectedMenu = $name; //update var
		
		return ($ret ? 1 : -1);
	}	
	
	protected function newMenu($button_title,$action) {
		$prompt = localize('_menuname', getlocal());		
		$title = localize('_newmenu', getlocal());
		$myaction = seturl("t=".$action); 	
		
		$form = new form(localize('RCMENU_DPC',getlocal()), "RCMENU", FORM_METHOD_POST, $myaction);	
		
		$section = 'newmenu';
		$form->addGroup($section,$button_title);		
		
		//$form->addElement($section,new form_element_text('variable','variable','variable',"span6",60,255,0));		 	 
		$form->addElement($section,new form_element_text($prompt,'menu','',"span6",60,255,0));			 
		$form->addElement(FORM_GROUP_HIDDEN,new form_element_hidden ("FormAction", "$action"));
	   
		// Showing the form
		$fout = $form->getform(0,0,$button_title);	
		
		return ($this->window($title,null,$fout));		   	    
	}
	
	protected function menuMessage($isPost=null) {
		$lan = getlocal() ? getlocal() : '0';
		if ($isPost) {
			$ret = ($isPost<0) ? localize('_ferror', $lan) : localize('_fsuccess', $lan);
		}
		
		if ($this->selectedMenu) {
			$ret .= $ret ? '<br/>' : null;
			
			$menufile = ($this->selectedMenu=='menu') ? $this->selectedMenu : 'menu-' . $this->selectedMenu;
			$inifile = $this->path . $menufile . $lan . '.ini';
			$ret .= is_readable($inifile) ? null : localize('_ferror', $lan); 
		}	
		return ($ret);
	}
	
	protected function readMenuFiles() {
		$menu_array = null;
		$lan = getlocal() ? getlocal() : '0';
		$db = GetGlobal('db');
		
		//db based menu list
		$sSQL = "select relative, locale from relatives where ";
		$sSQL.= "type='$lan' and active=1 and ismenu=1 and ismaster=1";
		$sSQL.= " ORDER BY relative";
	    $result = $db->Execute($sSQL);
		
		foreach ($result as $r=>$rec) {
			$name = $rec[1] ? ucfirst($rec[1]) : ucfirst($rec[0]);
			$menu_array[$name] = seturl('t=cpmselectmenu&menu=' . $rec[0]);
		}		

		//text based menu list
		/*foreach (glob($this->path . "menu-*$lan.ini") as $filename) {
			//echo "$filename size " . filesize($filename) . "\n";
			$name = str_replace(array("menu-","$lan.ini", $this->path),array('','',''), $filename);
			$menu_array[$name] = seturl('t=cpmselectmenu&menu=' . $name);
		}*/	
		
		ksort($menu_array);		
		return ($menu_array);						
	}	
	
	public function currentMenuName() {
		
		return $this->selectedMenu ? ucfirst($this->selectedMenu) : 
									 ucfirst(localize('_selectmenu', getlocal()));
									 /*ucfirst(localize('_mainmenu', getlocal()));*/
	}
	
	public function readSelectedMenu() {
		if ($this->selectedMenu) {

			//db based
			$ret = $this->loadMenu($this->selectedMenu);
			if ($ret)
				return ($ret);
		    //else
		    //text based
			$menufile = ($this->selectedMenu=='menu') ? $this->selectedMenu : 'menu-' . $this->selectedMenu;
			return $this->nestBuild($menufile);
		}	
		
		//return $this->nestBuild(); 
		return null; //not selected
	}
	
	public function readCurrentMenu() {
		$db = GetGlobal('db');
	    $itmname = _v("cmsrt.itmname"); 
	    $itmdescr = _v("cmsrt.itmdescr"); 
		$csep = _v("cmsrt.cseparator");	
		$code = _m("cmsrt.getmapf use code");		
		
		$cpGet = _v('rcpmenu.cpGet');		
		
		if ($id = _m("cmsrt.getRealItemCode use " . $cpGet['id'])) {
			//current id item
			$sSQL = "select $code,$itmname,$itmdescr from products WHERE $code=" . $db->qstr($id);
			$res = $db->Execute($sSQL);
			
			$cat = $cpGet['cat'];
			$ctitles = $this->getCategoriesTitles($cat);
			$title = array_pop($ctitles);
			
			//add new element if any
			$new = $this->element; 			
			//the cat item,link
			$a = $this->nestdditem($cat, $title, $this->menuUrl($cat), md5($cat).'-SUBMENU');
			//the item,link
			$b = $this->nestdditem($res->fields[0], $res->fields[1], $this->menuUrl($cat, $res->fields[0]), md5($res->fields[0]).'-SUBMENU');
			
			return $new . $a . $b;
		}
		elseif ($cat = $cpGet['cat']) {
			//current cat, cat items
			$sSQL = "select $code,$itmname,$itmdescr from products WHERE ";
			$cats = explode($csep, $cat);
			foreach ($cats as $i=>$c) 
				$sql[] = "cat" . $i . "=" . $db->qstr(_m("cmsrt.replace_spchars use $c+1"));	
			$sSQL .= implode(' AND ', $sql);
			$sSQL .= " AND itmactive>0 AND active>0";	
			$sSQL .= _m("cmsrt.orderSQL");
			//echo $sSQL;
			
			$res = $db->Execute($sSQL);
			$catitems = null;
			foreach ($res as $i=>$item)
				$catitems .= $this->nestdditem($item[0], $item[1], $this->menuUrl($cat, $item[0]), md5($item[0]).'-SUBMENU');
				
			$title = array_pop($this->getCategoriesTitles($cat));

			//add new element if any
			$new = $this->element; 	
			//the cat items tree
			$a = $this->nestddgroup($cat, $title, $this->menuUrl($cat), md5($cat).'-SUBMENU', $catitems);			
			//just the cat link item
			$b = $this->nestdditem(array_pop($cats), $title, $this->menuUrl($cat), md5($cat).'-SUBMENU');
			
			return $new . $b . $a;
		}	
		
		//add new element if any
		$ret = $this->element; 
		
		//return drop element
		$ret .= $this->nestdditem('drop', localize('_dropelement', getlocal()), "#", md5('drop'));
		
		//standart menu
		$ret .= $this->nestBuild(); 
		
		return $ret;
	}
	
	protected function menuUrl($cat=null, $id=null) {
		$t = $id ? 'kshow' : 'klist';
		
		if ($id) {
			$ret = ($aliasExt = _m("cmsrt.useUrlAlias use 1")) ? 
					$this->httpurl ."/$cat/$id" . $aliasExt : 
					$this->httpurl . '/' . _m("cmsrt.url use t=$t&cat=$cat&id=$id");			
		}	
		elseif ($cat) { 
			$ret = ($aliasExt = _m("cmsrt.useUrlAlias use 1")) ? 
					$this->httpurl ."/$cat" . $aliasExt : 
					$this->httpurl . '/' . _m("cmsrt.url use t=$t&cat=$cat");
						
		}							  
		else
			$ret = $this->httpurl . '/' . _m("cmsrt.url use t=$t");	
		
		return ($ret);
	}	
	
	protected function newElement($button_title,$action) {
		$promptname = localize('_elmname', getlocal());
		$prompturl = localize('_elmurl', getlocal());
		$title = localize('_newelm', getlocal());
		$myaction = seturl("t=".$action); 	
		
		$form = new form(localize('_newelm',getlocal()), "RCELM", FORM_METHOD_POST, $myaction);	
		
		$section = 'newelement';
		$form->addGroup($section,$button_title);		
		
		$form->addElement($section,new form_element_text($promptname,'elmname','',"span6",60,255,0));		 	 
		$form->addElement($section,new form_element_text($prompturl,'elmurl','',"span6",60,255,0));			 
		$form->addElement(FORM_GROUP_HIDDEN,new form_element_hidden ("FormAction", "$action"));
		//save current menu selection
		$form->addElement(FORM_GROUP_HIDDEN,new form_element_hidden ("menu", GetReq('menu')));
	   
		// Showing the form
		$fout = $form->getform(0,0,$button_title);	
		
		return ($this->window($title,null,$fout));		   	    
	}	
	
	protected function addElement() {
		$title = GetParam('elmname');
		$url = GetParam('elmurl');
		
		//return new element 
		return $this->nestdditem(md5($title), $title, urldecode($url), md5($title));	
	}
	
	protected function getCategoriesTitles($cat=null) {
		$db = GetGlobal('db');
		if (!$cat) return array();
		$lan = getlocal();
		$f = $lan ? $lan : '0'; 	   		
		
		$csep = _v("cmsrt.cseparator");
		$cats = explode($csep, $cat);		
		
		$sSQL = "select cat{$f}2,cat{$f}3,cat{$f}4,cat{$f}5 from categories WHERE ";
		foreach ($cats as $c=>$ct) {
			$sql[] = 'cat' . strval($c+2) .'='. $db->qstr(_m("cmsrt.replace_spchars use $ct+1"));
		}
		$sSQL .= implode(' AND ', $sql);
		
		$res = $db->Execute($sSQL);
		for ($i=0 ; $i<=3 ; $i++)
			if ($ctitle = $res->fields[$i]) $retarray[] = $ctitle;
		
		return ($retarray);
	}
	
	public function menuButtonSelect() {
	    $lan = getlocal() ? getlocal() : '0';
		$menufile = $this->path . 'menu' . $lan . '.ini';	
		
		//$lmenu = localize('_menu', $lan) . ' (' . $lan . ')';	
		//$basicmenu = is_readable($menufile) ? array($lmenu=>seturl('t=cpmselectmenu&menu=menu')) : array();				  
		$basicmenu = array(); //DISABLED (DB MENU USED)
		
		$menuf = $this->readMenuFiles();
		$menus = (empty($menuf)) ? array() : $menuf;
		
		$turl99 = seturl('t=cpmconfig&ismain=1');
		$turl98 = seturl('t=cpmnewmenu');		
		$turl97 = seturl('t=cpmconfig');
		$turl96 = seturl('t=cpmnewelement&menu=' . $this->selectedMenu);
		
		$stdcmd = array(localize('_newmenu', getlocal())=>$turl98,
						localize('_newelm', getlocal())=>$turl96,
						0=>'',									
						/*localize('_mainmenu', getlocal())=>$turl97,	
						localize('_edit', getlocal())=>$turl99,
						1=>'',*/
		                );
		
		
		$button = $this->createButton(localize('_menu', getlocal()), array_merge($stdcmd, $basicmenu, $menus),'info');	
		return $button;	
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
				$links .= $url ? '<li><a href="'.$url.'">'.$n.'</a></li>' : '<li class="divider"></li>';
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
		$btns = $buttons ? '<div class="btn-toolbar">'. $buttons .'<hr/></div></div>' : null;
		
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
							'.  $content .'
                        </div>
                  </div>
                </div>
            </div>
';
		return ($ret);
	}		

};
}
?>