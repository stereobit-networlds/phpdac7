<?php
$__DPCSEC['RCSLIDESHOW_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCSLIDESHOW_DPC")) && (seclevel('RCSLIDESHOW_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCSLIDESHOW_DPC",true);

$__DPC['RCSLIDESHOW_DPC'] = 'rcslideshow';

$a = GetGlobal('controller')->require_dpc('gui/form.dpc.php');
require_once($a);

$d = GetGlobal('controller')->require_dpc('cms/cmsmenu.dpc.php');
require_once($d);

$__EVENTS['RCSLIDESHOW_DPC'][0]='cpsconfig';
$__EVENTS['RCSLIDESHOW_DPC'][1]='cpsconfedit';
$__EVENTS['RCSLIDESHOW_DPC'][2]='cpsconfdel';
$__EVENTS['RCSLIDESHOW_DPC'][3]='cpsconfadd';
$__EVENTS['RCSLIDESHOW_DPC'][4]='cpssavenest';
$__EVENTS['RCSLIDESHOW_DPC'][5]='cpsloadnest';
$__EVENTS['RCSLIDESHOW_DPC'][6]='cpsnewslider';
$__EVENTS['RCSLIDESHOW_DPC'][7]='cpsselectslider';
$__EVENTS['RCSLIDESHOW_DPC'][8]='cpsnewelement';
$__EVENTS['RCSLIDESHOW_DPC'][9]='cpsaddelement';

$__ACTIONS['RCSLIDESHOW_DPC'][0]='cpsconfig';
$__ACTIONS['RCSLIDESHOW_DPC'][1]='cpsconfedit';
$__ACTIONS['RCSLIDESHOW_DPC'][2]='cpsconfdel';
$__ACTIONS['RCSLIDESHOW_DPC'][2]='cpsconfadd';
$__ACTIONS['RCSLIDESHOW_DPC'][4]='cpssavenest';
$__ACTIONS['RCSLIDESHOW_DPC'][5]='cpsloadnest';
$__ACTIONS['RCSLIDESHOW_DPC'][6]='cpsnewslider';
$__ACTIONS['RCSLIDESHOW_DPC'][7]='cpsselectslider';
$__ACTIONS['RCSLIDESHOW_DPC'][8]='cpsnewelement';
$__ACTIONS['RCSLIDESHOW_DPC'][9]='cpsaddelement';

$__LOCALE['RCSLIDESHOW_DPC'][0]='RCSLIDESHOW_DPC;Slideshow Configuration;Slideshow Configuration;';
$__LOCALE['RCSLIDESHOW_DPC'][1]='_newelement;New element;Νέο στοιχείο;';
$__LOCALE['RCSLIDESHOW_DPC'][2]='_presshere;Press here;Πατήστε εδώ για εισαγωγή;';
$__LOCALE['RCSLIDESHOW_DPC'][3]='title;Title;Τίτλος;';
$__LOCALE['RCSLIDESHOW_DPC'][4]='link;Url;Δεσμός Url;';
$__LOCALE['RCSLIDESHOW_DPC'][5]='_mainslider;Main slider;Κεντρικό slider;';
$__LOCALE['RCSLIDESHOW_DPC'][6]='_newslide;New;Νέο;';
$__LOCALE['RCSLIDESHOW_DPC'][7]='_slider;Slider;Slider;';
$__LOCALE['RCSLIDESHOW_DPC'][8]='_collapse;Collapse;Συρίκνωση;';
$__LOCALE['RCSLIDESHOW_DPC'][9]='_expand;Expand;Επέκταση;';
$__LOCALE['RCSLIDESHOW_DPC'][10]='_save;Save;Αποθήκευση;';
$__LOCALE['RCSLIDESHOW_DPC'][11]='_currentslider;Current;Τρέχον;';
$__LOCALE['RCSLIDESHOW_DPC'][12]='_saved;Saved;Αποθηκεύτηκε;';
$__LOCALE['RCSLIDESHOW_DPC'][13]='_notsaved;Not saved;Δεν αποθηκεύτηκε;';
$__LOCALE['RCSLIDESHOW_DPC'][14]='_edit;Edit;Επεξεργασία;';
$__LOCALE['RCSLIDESHOW_DPC'][15]='_add;Add;Προσθήκη;';
$__LOCALE['RCSLIDESHOW_DPC'][16]='_newslider;New slider;Νέο slider;';
$__LOCALE['RCSLIDESHOW_DPC'][17]='_slidername;Slider name;Όνομα slider;';
$__LOCALE['RCSLIDESHOW_DPC'][18]='_ferror;File error;Πρόβλημα στο αρχείο;';
$__LOCALE['RCSLIDESHOW_DPC'][19]='_fsuccess;File created;Το αρχείο δημιουργήθηκε;';
$__LOCALE['RCSLIDESHOW_DPC'][20]='_dropelement;Drop elements;Στοιχείο εναπόθεσης;';
$__LOCALE['RCSLIDESHOW_DPC'][21]='_newelm;New element;Νέο στοιχείο;';
$__LOCALE['RCSLIDESHOW_DPC'][22]='_elmname;Element name;Όνομα στοιχείου;';
$__LOCALE['RCSLIDESHOW_DPC'][23]='_elmurl;Element url;Σύνδεσμος στοιχείου;';


class rcslideshow extends cmsmenu {

    var $crlf, $path, $title, $urlpath, $url;
	var $t_config, $t_config0, $t_config1, $t_config2;
	var $edit_per_lan, $selectedSlider, $post, $element, $slidervars;	

    public function __construct() {
	
	    parent::__construct();
	
	    $this->title = localize('RCSLIDESHOW_DPC',getlocal());		
	
	    $os =  php_uname();
        $info = strtolower($os);   
        $this->crlf = PHP_EOL; //( strpos( $info, "windows" ) === false ) ? "\n" : "\r\n" ;	
		  
		$this->path = paramload('SHELL','prpath');			
	    $this->edit_per_lan = true; //false;
		$this->t_config = array();		  
		$this->post = null;	
		$this->element = null;	
		$this->selectedSlider = GetParam('slider');		

		//load the var elements used in slideshow.ini 
		//$this->slidervars = array('title', 'subtitle', 'button', 'url', 'image');		
		$this->slidervars = arrayload('CMSMENU', 'slidervars');	
	}
	
    public function event($event=null) {	
	
	   	$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;		
	
  
		switch ($event) {

			case "cpsaddelement"    :   $this->t_config = $this->read_config();
										$title = $this->slidervars[0];
										if ($elmname = $_POST[$title])
											$this->element = $this->addElement();
										break;
										
			case "cpsnewelement"  	:   $this->t_config = $this->read_config();
			                            break;							
		
		    case "cpsselectslider"  :	$this->t_config = $this->read_config();
										if ($newslider = $_POST['slider'])
											$this->post = $this->createSlider($newslider);
			                            break;
										
			case "cpsnewslider"     :	$this->t_config = $this->read_config();
										break;
			
			case "cpsloadnest"      : 	$this->t_config = $this->read_config();
										$this->loadNestList(); die();
										break;	
											
			case "cpssavenest"      : 	$this->t_config = $this->read_config();
										$this->saveNestList($this->selectedSlider); die();
										break;		

			case "cpsconfedit"      :   
			case "cpsconfadd"       :   								 
			case "cpsconfig"        :     
			default                 :	$this->t_config = $this->read_config();
										if (GetReq('save')==1) {
											$this->write_config();  
											$this->t_config = $this->read_config(); //re-read
										}	 
										elseif (GetReq('add')==1) {
											$this->paramset(GetParam('section'),GetParam('variable'),GetParam('value'));
											$this->write_config();  
											$this->t_config = $this->read_config(); 
										}				
		                          							 
		}	  
    }
  
    public function action($action=null) {
	   
	    $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;	   

		switch ($action) {

			case "cpsaddelement"    :	break;	
			case "cpsnewelement"   	:	$out = $this->newElement(localize('_newelm', getlocal()),"cpsaddelement"); 
										break;										
		
		    case "cpsselectslider"  :	$out = $this->sliderMessage($this->post);
			                            break;
			case "cpsnewslider"     :	$out = $this->newSlider(localize('_newslider', getlocal()),"cpsselectslider"); 
										break;		
	   
			case "cpsloadnest"      :	break;	 	   
			case "cpssavenest"      :	break;		   

			case "cpsconfedit"      :     
										$out .= $this->show_configuration(localize('_save', getlocal()),"cpsconfig&save=1", false, GetReq('cpart'));
										break;
			case "cpsconfdel"       :     
		                          
										break;
			case "cpsconfadd"       :     
										$out .= $this->add_configuration(localize('_add', getlocal()),"cpsconfig&add=1");  
										break;								 
			case "cpsconfig"        :     
			default                 :	$out = ((GetParam('ismain')=='1') || ($this->selectedSlider)) ? 
											$this->show_configuration(localize('_save', getlocal()),"cpsconfedit&save=1", false, GetReq('cpart')) : null; 
								 
       }
	 
	   return ($out);
    } 	
	
	protected function show_configuration($button_title,$action,$editable=false, $cpart=null) {
	    $myaction = seturl("t=".$action); 	
        $form = new form(localize('RCSLIDESHOW_DPC',getlocal()), "RCSLIDESHOW", FORM_METHOD_POST, $myaction);	
		 
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
				if (strstr($var, 'image'))
					$form->addElement($section,new form_element_ckfinder($localize_var,$sectionvar,$val,"span11",60,255,$editable));
				else
					$form->addElement($section,new form_element_text($localize_var,$sectionvar,$val,"span11",60,255,$editable));
			}
			$newelement = localize("_newelement",getlocal());
			$presshere = localize("_presshere",getlocal());
			$form->addElement($section,new form_element_onlytext($newelement,seturl("t=cpsconfadd&section=".$section, $presshere),"span11"));
	    }

		// Adding a hidden field
		$form->addElement(FORM_GROUP_HIDDEN,new form_element_hidden ("FormAction", $action));
		if ($this->selectedSlider)
			$form->addElement(FORM_GROUP_HIDDEN,new form_element_hidden ("slider", $this->selectedSlider));     
	    else	
			$form->addElement(FORM_GROUP_HIDDEN,new form_element_hidden ("ismain", "1"));       
		
		// Showing the form
		$fout = $form->getform(0,0,$button_title);
   		//$fout.= '<br/>';		
	   
		return ($this->window($this->title,null,$fout));	   
	}
	
	protected function add_configuration($button_title,$action) {
	    $myaction = seturl("t=".$action); 	
       $form = new form(localize('RCSLIDESHOW_DPC',getlocal()), "RCSLIDESHOW", FORM_METHOD_POST, $myaction);	
		
	    if ($section=GetReq('section')) {
			$form->addGroup($section,ucfirst(strtolower($section)));		
		 
			$data = $this->t_config[$section];
			foreach ($data as $var=>$val) {
		 
				$form->addElement($section,new form_element_onlytext($var,$val,"span11",20,255,0));
			}
		 	
			$form->addElement($section,new form_element_text('variable','variable','variable',"span11",20,255,0));		 	 
			$form->addElement($section,new form_element_text('value','value','value',"span11",20,255,0));			 
		 
			// Adding section as hidden field
			$form->addElement		(FORM_GROUP_HIDDEN,		new form_element_hidden ("section", $section));		 
		 
			// Adding a hidden field
			$form->addElement		(FORM_GROUP_HIDDEN,		new form_element_hidden ("FormAction", "$action"));
        }	
	   
	    // Showing the form
	    $fout = $form->getform(0,0,$button_title);	
	   
	    return ($this->window($title .' '. ucfirst(strtolower($section)),null,$fout));		   	    
	}
	
	
	
    public function paramload($section,$param) {
        $config = $this->t_config;//GetGlobal('config');

        if (is_array($config[$section]))     
	        return ($config[$section][$param]);
    }
	
	public function paramset($section=null,$param=null,$value=null) {
	
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
	
	      if ($data) return(explode(",",$data));
	      //return ($out);
    }
	
	public function arrayset($section,$array,$serialized_array=null) {
	
	      $data = unserialize($serialized_array);
		  
	      if (is_array($data)) {
		  
		    $this->t_config[$section][$array] = implode(",",$data) . $this->crlf;
		  }
		  //else //common param
		    //$this->paramset($section,$array,$serialized_array);
	}
	
	protected function read_config() {
		$lan = getlocal() ? getlocal() : '0';
		if ($this->selectedSlider)	{
			$sliderfile = ($this->selectedSlider=='slider') ? $this->selectedSlider : 'slider-' . $this->selectedSlider;
			$filename = $this->path . $sliderfile . $lan . '.sld';
			$this->edit_per_lan = false;
		}
		else
			$filename = $this->path . "slideshow.ini";
	
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
			}
			else
				$this->t_config = $ret;
		   
			return ($ret);
		}  
	}
	
	protected function write_config() {
		$lan = getlocal() ? getlocal() : '0';
		if ($this->selectedSlider)	{
			$sliderfile = ($this->selectedSlider=='slider') ? $this->selectedSlider : 'slider-' . $this->selectedSlider;
			$filename = $this->path . $sliderfile . $lan . '.sld';
			$this->edit_per_lan = false;
			
		    //keep backup copy
		    @copy($filename, str_replace('.sld','._ld', $filename));			
		}
		else {		 
			$filename = $this->path . "slideshow.ini";
			//keep backup copy
		    @copy($filename, str_replace('.ini','._ni', $filename));
		}	
	
		if (file_exists($filename) && is_writeable($filename)) {
		 
		  //write by language ..merge
		  if ($this->edit_per_lan) {
		  
	        $lan = getlocal() ? getlocal() :'0';	   
	        $tvar = 't_config'.$lan;
	        $c_config = $this->$tvar;					
			
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

		$sliderfile = $file ? (($file=='slider') ? $file : 'slider-' . $file) : 'slider';
        $filename = $this->path . $sliderfile . $lan . '.sld';	
		//echo $filename;
		
        $fileCONTENTS = null;
		if (!empty($data)) {

            foreach ($data as $i=>$id) {
			    if ($id['id']=='recycle-bin') continue; //drop
				
				$fileCONTENTS .= "[" . $id['id'] . "]" . $this->crlf;
				
				$data = unserialize(base64_decode($id['value']));
				foreach ($data as $nam=>$val) {
					$fileCONTENTS .= $nam . '=' . $val . $this->crlf;
				}
				$fileCONTENTS .= $this->crlf;
			}
			
			//keep backup copy
			@copy($filename, str_replace('.sld','._ld', $filename));
		  
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
	
	/*1 level conf file based nest loader*/
	public function nestBuild($file=null) {
		$n = null;
	    $lan = getlocal() ? getlocal() : '0';
		
	    if ($file) {
			$inifile = $this->path . $file . $lan . '.sld';
			$conf = @parse_ini_file($inifile, 1, INI_SCANNER_RAW);
		}	
		else
			$conf = $this->t_config;//$tvar;	
		
		//print_r($conf);
		if (!$conf) return;
		
		foreach ($conf as $section=>$params) {
			
			$title = $this->slidervars[0];
			$nz = isset($file) ? $params[$title] : explode(',', $params[$title]);
			$name = isset($file) ? $nz : $nz[$lan];
			
			$elm = array();
			foreach ($params as $p=>$v) {
				$nl = isset($file) ? $v : explode(',', $v);
				$elm[$p] = isset($file) ? $nl : (strstr($p, 'link') ? $this->make_link($nl[$lan]) : $nl[$lan]);
			}
			$value = base64_encode(serialize($elm));
			
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
		
		//db based, delete menu first save after
		//$this->deleteSlider($filename);
		//$this->createSlider($filename);//create master menu (use for copy from text while saving)
		//$w = $this->saveSlider($filename, $menu);
		
		//text based save
		$w = $this->writenest_config($menu, $filename);
		
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
	protected function loadSlider($name=null) {
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
	protected function saveSlider($name=null, $data=null, $isfather=1, $ischild=0, $father=null) {
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
				$this->saveSlider($id, $submenu_items, 0, 1, $rootfather);
			
			$sSQL = "insert into relatives (orderid,type,active,relative,relation,ismenu,ismaster,notes,locale,isfather,ischild) values (";
			$sSQL.= "$i,$lan,1,'$name','$id',1,0,'$title|$link','$rootfather',$isfather, $ischild)"; 
			$result = $db->Execute($sSQL);	
		}
		
		return true;
	}

	protected function deleteSlider($name=null, $delmaster=false) {
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

	protected function createSlider($name=null) {
		if (!$name) return;
		$lan = getlocal() ? getlocal() : '0';	
		$db = GetGlobal('db');
		/*
		$sSQL = "insert into relatives (orderid,type,active,relative,relation,ismenu,ismaster,notes,locale,isfather,ischild) values (";
		$sSQL.= "0,$lan,1,'$name','',1,1,'','',0,0)"; 
	    $result = $db->Execute($sSQL);		
		*/
		//create text ini(=sld)
		$sliderfile = ($name=='slider') ? $name : 'slider-' . $name;
		$inifile = $this->path . $sliderfile . $lan . '.sld';
		
		foreach ($this->slidervars as $sname)
			$initstring .= $sname . '=' . $this->crlf;
		$ret = @file_put_contents($inifile, "[NEW]\r\n" . $initstring);
		
		$this->selectedSlider = $name; //update var
		
		return ($ret ? 1 : -1);
	}	
	
	protected function newSlider($button_title,$action) {
		$prompt = localize('_slidername', getlocal());		
		$title = localize('_newslide', getlocal());
		$myaction = seturl("t=".$action); 	
		
		$form = new form(localize('RCMENU_DPC',getlocal()), "RCMENU", FORM_METHOD_POST, $myaction);	
		
		$section = 'newslider';
		$form->addGroup($section,$button_title);		
		
		//$form->addElement($section,new form_element_text('variable','variable','variable',"span6",60,255,0));		 	 
		$form->addElement($section,new form_element_text($prompt,'slider','',"span6",60,255,0));			 
		$form->addElement(FORM_GROUP_HIDDEN,new form_element_hidden ("FormAction", $action));
	   
		// Showing the form
		$fout = $form->getform(0,0,$button_title);	
		
		return ($this->window($title,null,$fout));		   	    
	}
	
	protected function sliderMessage($isPost=null) {
		$lan = getlocal() ? getlocal() : '0';
		if ($isPost) {
			$ret = ($isPost<0) ? localize('_ferror', $lan) : localize('_fsuccess', $lan);
		}
		
		if ($this->selectedSlider) {
			$ret .= $ret ? '<br/>' : null;
			
			$sliderfile = ($this->selectedSlider=='slider') ? $this->selectedSlider : 'slider-' . $this->selectedSlider;
			$inifile = $this->path . $sliderfile . $lan . '.sld';
			$ret .= is_readable($inifile) ? null : localize('_ferror', $lan); 
		}	
		return ($ret);
	}	
	
	protected function readSliderFiles() {
		$menu_array = null;
		$lan = getlocal() ? getlocal() : '0';
		/*$db = GetGlobal('db');
		
		//db based menu list
		$sSQL = "select relative, locale from relatives where ";
		$sSQL.= "type='$lan' and active=1 and ismenu=1 and ismaster=1";
		$sSQL.= " ORDER BY relative";
	    $result = $db->Execute($sSQL);
		
		foreach ($result as $r=>$rec) {
			$name = $rec[1] ? ucfirst($rec[1]) : ucfirst($rec[0]);
			$menu_array[$name] = seturl('t=cpsselectslider&slider=' . $rec[0]);
		}*/		

		//text based menu list
		foreach (glob($this->path . "slider*$lan.sld") as $filename) {
			//echo "$filename size " . filesize($filename) . "\n";
			$name = str_replace(array("slider-","$lan.sld", $this->path),array('','',''), $filename);
			$menu_array[ucfirst($name)] = seturl('t=cpsselectslider&slider=' . $name);
		}	
		
		ksort($menu_array);		
		return ($menu_array);						
	}	
	
	public function currentSliderName() {
		return $this->selectedSlider ? ucfirst($this->selectedSlider) : ucfirst(localize('_mainslider', getlocal()));
	}
	
	public function readSelectedSlider() {
		if ($this->selectedSlider) {

			//db based
			/*$ret = $this->loadSlider($this->selectedSlider);
			if ($ret)
				return ($ret);
		    //else*/
		    //text based
			$sliderfile = ($this->selectedSlider=='slider') ? $this->selectedSlider : 'slider-' . $this->selectedSlider;
			return $this->nestBuild($sliderfile);
		}	
		
		return $this->nestBuild(); 
	}
	
	public function readCurrentSlider() {
		$db = GetGlobal('db');
	    $itmname = _v("cmsrt.itmname"); 
	    $itmdescr = _v("cmsrt.itmdescr"); 
		$csep = _v("cmsrt.cseparator");	
		$code = _m("cmsrt.getmapf use code");		
		
		$cpGet = _v('rcpmenu.cpGet');		
		
		if ($id = _m("cmsrt.getRealItemCode use " . $cpGet['id'])) {
			$cat = $cpGet['cat'];
			$ctitles = $this->getCategoriesTitles($cat);
			$title = array_pop($ctitles);			
			
			//current id item
			$sSQL = "select $code,$itmname,$itmdescr from products WHERE $code=" . $db->qstr($id);
			$res = $db->Execute($sSQL);

			$link = "kshow/$cat/".$res->fields[0] . '/';
			$image = "images/photo_bg/". $res->fields[0] . '.jpg';
				
			//map elements ----------------------------(!!!)
			$elm[$this->slidervars[0]] = $res->fields[1];
			$elm[$this->slidervars[1]] = $res->fields[2];
			$elm[$this->slidervars[2]] = $res->fields[0];
			$elm[$this->slidervars[3]] = $link;
			$elm[$this->slidervars[4]] = $image;
			//print_r($elm);
			$elmdata = base64_encode(serialize($elm));				
			
			//add new element if any
			$new = $this->element; 			
			//the cat item,link
			//$a = $this->nestdditem($cat, $title, "klist/$cat/", md5($cat).'-SUBMENU');
			//the item,link
			$b = $this->nestdditem($res->fields[0], $res->fields[1], $elmdata, md5($res->fields[0]).'-SUBMENU');
			
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
			foreach ($res as $i=>$item) {
				$link = "kshow/$cat/".$item[0] . '/';
				$image = "images/photo_bg/". $item[0] . '.jpg';
				
				//map elements --------------------------------(!!!)
				$elm[$this->slidervars[0]] = $item[1];
				$elm[$this->slidervars[1]] = $item[2];
				$elm[$this->slidervars[2]] = $item[0];
				$elm[$this->slidervars[3]] = $link;
				$elm[$this->slidervars[4]] = $image;
				$elmdata = base64_encode(serialize($elm));			
				
				$catitems .= $this->nestdditem($item[0], $item[1], $elmdata, md5($item[0]).'-SUBMENU');
			}	
				
			$title = array_pop($this->getCategoriesTitles($cat));
			
			//add new element if any
			$new = $this->element; 			
			//the cat items tree
			$a = $this->nestddgroup($cat, $title, "klist/$cat/", md5($cat).'-SUBMENU', $catitems);			
			//just the cat link item
			//$b = $this->nestdditem(array_pop($cats), $title, "klist/$cat/", md5($cat).'-SUBMENU');
			
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
	
	
	protected function newElement($button_title,$action) {
		$promptname = localize('_elmname', getlocal());
		$prompturl = localize('_elmurl', getlocal());
		$title = localize('_newelm', getlocal());
		$myaction = seturl("t=".$action); 	
		
		$form = new form(localize('_newelm',getlocal()), "RCELM", FORM_METHOD_POST, $myaction);	
		
		$section = 'newelement';
		$form->addGroup($section,$button_title);		

		foreach ($this->slidervars as $inputname) {
			if (strstr($inputname, 'image'))
				$form->addElement($section,new form_element_ckfinder(ucfirst($inputname),$inputname,'',"span6",60,255,0));		
			else
				$form->addElement($section,new form_element_text(ucfirst($inputname),$inputname,'',"span6",60,255,0));		
		}	
			
		$form->addElement(FORM_GROUP_HIDDEN,new form_element_hidden ("FormAction", $action));
		//save current menu selection
		$form->addElement(FORM_GROUP_HIDDEN,new form_element_hidden ("slider", GetReq('slider')));
	   
		// Showing the form
		$fout = $form->getform(0,0,$button_title);	
		
		return ($this->window($title,null,$fout));		   	    
	}	
	
	protected function addElement() {
		$elm = array();
		foreach ($this->slidervars as $param) {
			$elm[$param] = urldecode(GetParam($param));
		}	
		
		//return new element 
		$title = GetParam($this->slidervars[0]);
		$data = base64_encode(serialize($elm));
		return $this->nestdditem(md5($title), $title, $data, md5($title));	
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
	
	public function sliderButtonSelect() {

		$slds = $this->readSliderFiles();
		$slidelist = (empty($slds)) ? array() : $slds;
		
		$turl99 = $this->selectedSlider ? seturl('t=cpsconfig&slider='.$this->selectedSlider) : 
		          seturl('t=cpsconfig&ismain=1');
		$turl98 = seturl('t=cpsnewslider');		
		$turl97 = seturl('t=cpsconfig');
		$turl96 = seturl('t=cpsnewelement&slider=' . $this->selectedSlider);
		
		$stdcmd = array(localize('_newslider', getlocal())=>$turl98,
						localize('_newelm', getlocal())=>$turl96,
						0=>'',									
						/*localize('_mainslider', getlocal())=>$turl97,	*/	
						localize('_edit', getlocal())=>$turl99,
						1=>'',
		                );
		
		
		$button = $this->createButton(localize('_slider', getlocal()), array_merge($stdcmd, $slidelist),'info');	
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