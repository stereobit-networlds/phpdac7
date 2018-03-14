<?php
$__DPCSEC['CMSMENU_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CMSMENU_DPC")) && (seclevel('CMSMENU_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CMSMENU_DPC",true);

$__DPC['CMSMENU_DPC'] = 'cmsmenu';

$__EVENTS['CMSMENU_DPC'][1]='cmsmenu';
$__EVENTS['CMSMENU_DPC'][2]='menu';
$__EVENTS['CMSMENU_DPC'][3]='menu1';

$__ACTIONS['CMSMENU_DPC'][1]='cmsmenu';
$__ACTIONS['CMSMENU_DPC'][2]='menu';
$__ACTIONS['CMSMENU_DPC'][3]='menu1';

$__LOCALE['CMSMENU_DPC'][0]='CMSMENU_DPC;Menu;Menu';	   
	   
class cmsmenu {

	var $path, $urlpath, $inpath, $menufile, $sliderfile;
	var $delimiter, $httpurl;
	var $dropdown_class, $dropdown_class2;   
	
	public function __construct() {
		$UserName = GetGlobal('UserName');	
		$UserSecID = GetGlobal('UserSecID');
		$UserID = GetGlobal('UserID');		
		$this->userLevelID = (((decode($UserSecID))) ? (decode($UserSecID)) : 0);
		$this->username = decode($UserName);
		$this->userid = decode($UserID);
	   
		$this->path = paramload('SHELL','prpath');	   
		$this->urlpath = paramload('SHELL','urlpath');
		$this->inpath = paramload('ID','hostinpath');
		$this->httpurl = paramload('SHELL','urlbase');		
	  
		$this->menufile = $this->path . 'menu.ini';
		$this->sliderfile = $this->path . 'slideshow.ini';
		$this->delimiter = ',';
		
	    //SHMENU !!!
		$this->dropdown_class = remote_paramload('SHMENU','dropdownclass',$this->path);	   
		$this->dropdown_class2 = remote_paramload('SHMENU','dropdownclass2',$this->path);
	}
   

	public function event($event=null) {
   
       switch ($event) {
		 case 'cmsmenu'       :	
		 default              : 						
	   }
	}
   

	public function action($action=null) {

       switch ($action) {
		 case 'cmsmenu'       :						
		 default              : 
	   }
	   
	   return ($out);
	} 

	//text conf sliders (slideshow.ini and sld files)
	public function callSlider($name=null,$slider_template=null,$glue_tag=null,$subslider_template=null) {
	    $lan = getlocal() ? getlocal() : '0';	
		$gstart = $glue_tag ? '<'.$glue_tag.'>' : null;
		$gend = $glue_tag ? '</'.$glue_tag.'>' : null;	
		
		$ret = null;
		$tmpl = _m('cmsrt.select_template use ' . $slider_template);		

		if ($name) {//sld file
			$slidername = ($name=='slider') ? $name : 'slider-' . $name;
			$slfile = $this->path . str_replace('.sld','',$slidername) . $lan . '.sld';
			$conf = @parse_ini_file($slfile, 1, INI_SCANNER_RAW);
		}	
		else //slideshow.ini	
			$conf = @parse_ini_file($this->sliderfile, 1, INI_SCANNER_RAW);

		//echo $slfile; print_r($conf);
		if (empty($conf)) return null;
		
		foreach ($conf as $section=>$params) {
			
			$tokens = array();
			foreach ($params as $p=>$v) {
				$nl = $name ? $v : explode(',', $v);
				$tokens[] = $name ? $nl : (strstr($p, 'link') ? $this->make_link($nl[$lan]) : $nl[$lan]);
			}			
			//print_r($tokens);
			$slide[] = $this->combine_tokens($tmpl, $tokens, true);
		}
		
		$slides = $gstart . implode(''. $gend . $gstart , $slide) . $gend;

		if ($subslider_template) {
			//echo $subslider_template . '>';
			$subtmpl = _m('cmsrt.select_template use ' . $subslider_template);
			$ret = $this->combine_tokens($subtmpl, array(0=>$slides), true);
		}
		else
			$ret = $slides;		
		
		return ($ret);	
	}	
   			
	//db based
	public function callMenu($name=null,$menu_template=null,$glue_tag=null,$submenu_template=null,$wrap_submenu=null) {
		if (!$name) return null;
	    $lan = getlocal() ? getlocal() : '0';	
		$gstart = $glue_tag ? '<'.$glue_tag.'>' : null;
		$gend = $glue_tag ? '</'.$glue_tag.'>' : null;			
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
		$tmpl = $menu_template ? _m('cmsrt.select_template use ' . $menu_template) : null; 
		
		ksort($menu);
		$mid = 1;
		foreach ($menu as $i=>$m) {
			$ret2 = null;
			list ($section, $name, $value) = explode('|', $m);			
			
			if ($sb = (array) $submenu[$section]) {
				ksort($sb);
				$tmpl2 = $submenu_template ? _m('cmsrt.select_template use ' . $submenu_template) : null;
				
				foreach ($sb as $j=>$c) {
					list ($cname, $cvalue) = explode('|', $c);
					
					if ($tmpl2) {
						$tokens2[] = trim($cvalue) ? $this->make_link($cvalue) : '#';
						$tokens2[] = $cname;
						$ret2 .= $this->combine_tokens($tmpl2, $tokens, true);
						unset($tokens2);
					}
					else {
						$link = trim($cvalue) ? $this->make_link($cvalue) : '#';
						$line = "<a href='$link'>$cname</a>";
						$ret2 .= $gstart . $line . $gend;
					}						
				}

				if ($wrap_submenu) {
					$wraptmpl = _m('cmsrt.select_template use ' . $wrap_submenu);
					$sbmenu = $this->combine_tokens($wraptmpl, array(0=>$ret2, 1=>$cname, 2=>$mid++), true);
				}
				else
					$sbmenu = $ret2;	
			}
			
			if ($tmpl) {
				$tokens[] = $this->dropdown_class;
				$tokens[] = trim($value) ? $this->make_link($value) : '#';
				$tokens[] = $name;
				$tokens[] = $sbmenu; 
				$ret .= $this->combine_tokens($tmpl, $tokens, true);
				unset($tokens);
			}
			else {
				$link = trim($value) ? $this->make_link($value) : '#';
				$line = "<a href='$link'>$name</a>";
				$ret .= $gstart . $line . $gend;
			}	
		}	
		
		return ($ret);		
	}

	//used by dac pages for template loading
	public function readMenuElements($menu, $submenu=null, $all=false) {
		if (!$menu) return null;
		$lan = getlocal() ? getlocal() : '0';
		$db = GetGlobal('db');	

		//db based menu items (1 level)
		$sSQL = "select relation,locale,notes from relatives where ";
		$sSQL.= "type='$lan' and active=1 and ismenu=1 and ";
		if ($submenu) 
			$sSQL.= "relative=" . $db->qstr($submenu) . " and locale=" . $db->qstr($menu);		
		else
			$sSQL.= $all ? "locale=" . $db->qstr($menu) : 
						   "relative=" . $db->qstr($menu); //partial menu 1st level
		
		$sSQL.= " ORDER BY orderid";
	    $result = $db->Execute($sSQL);	

		foreach ($result as $r=>$rec) {
			if ($rec[0])
				$ret[] = $rec[0];
		}	
			
		return ($ret);	
	}	
			
    //text based
	public function render($menufile=null,$menu_template=null,$glue_tag=null,$submenu_template=null) {
        $lan = getlocal() ? getlocal() : '0';
		$gstart = $glue_tag ? '<'.$glue_tag.'>' : null;
		$gend = $glue_tag ? '</'.$glue_tag.'>' : null;	
		$mlang = true; //multi lan delimiter default on
		$ret = null;		
		
		$csep = _v("cmsrt.cseparator");		

		if ($menufile) {
			$m = @parse_ini_file($this->path . $menufile . $lan . '.ini', 1, INI_SCANNER_RAW);
			$mlang = false; //multi lan delimiter off
		}
		else {
			if (is_readable(str_replace('.ini', $lan.'.ini',$this->menufile))) {//lan menu file
				$m = @parse_ini_file(str_replace('.ini', $lan.'.ini',$this->menufile), 1, INI_SCANNER_RAW);
				$mlang = false; //multi lan delimiter off
			}	
			else
				$m = @parse_ini_file($this->menufile, 1, INI_SCANNER_RAW);
		}  
		//print_r($m);
		if (!is_array($m)) return null;
		
		foreach ($m as $menu_item) {
			//menu items		
			if (isset($menu_item['title'])) { 		
		  
				$title = ($mlang && strstr($menu_item['title'], $this->delimiter)) ? 
							explode($this->delimiter ,$menu_item['title']) : $menu_item['title'];
				$_title = (is_array($title)) ? $title[$lan] : $title; 
				
				$link = ($mlang && strstr($menu_item['link'], $this->delimiter)) ? 
							explode($this->delimiter ,$menu_item['link']) : $menu_item['link']; 		  
				$_link = (is_array($link)) ? $link[$lan] : $link; 
				
				//spaces before and after title
				$spaces = ($mlang && strstr($menu_item['spaces'], $this->delimiter)) ? 
							explode($this->delimiter ,$menu_item['spaces']) : $menu_item['spaces']; 
				$sps[$_title.'-spaces'] = (is_array($spaces)) ? $spaces[$lan] : ($spaces ? $spaces : 0);

				//submenu
				$submenu = ($mlang && strstr($menu_item['submenu'], $this->delimiter)) ? 
							explode($this->delimiter ,$menu_item['submenu']) : $menu_item['submenu']; 
				$smu[$_title.'-submenu'] = (is_array($submenu)) ? $submenu[$lan] : ($submenu ? $submenu : null);
		
				//set title / link
				$menu[$_title] = $_link;
			}
		}
		
		if (!empty($menu)) {
			
            $tmpl = $menu_template ? _m('cmsrt.select_template use ' . $menu_template) : null; 
				
            foreach ($menu as $name=>$url) {
				
			    $tokens = array(); //reset tokens
			    $murl = $url ? $this->make_link($url) : '#';
					  
                if ($sub_menu = $smu[$name.'-submenu']) {
					
					if (stristr($sub_menu,'shkategories.')) {//phpdac cmd
						if (defined('SHKATEGORIES_DPC')) {
							$cmddac = str_replace('^', $csep, $sub_menu);
							$ret2 = _m($cmddac); //cat sep
							$tokens[] = $this->dropdown_class; 
						}
					}
					elseif (stristr($sub_menu,'.htm')) {//htm/php template file
						//echo 'a',$sub_menu;
						$mytemplate = _m('cmsrt.select_template use ' . str_replace('.htm','',$sub_menu));  
						$ret2 = $this->combine_tokens($mytemplate, array(0=>''), true);
						$tokens[] = $this->dropdown_class2;
					}
					else {
						//echo 'b',$sub_menu;
						$_smenu = (array) $m[$sub_menu];
						$ret2 = $this->render_submenu($_smenu, $submenu_template, $glue_tag, $mlang);
						$tokens[] = $this->dropdown_class;
					}
					   
					if ($tmpl) {
						$tokens[] = $murl;
						$tokens[] = $name;
						$tokens[] = $ret2;
						$ret .= $this->combine_tokens($tmpl, $tokens, true);
					}
					else {
						$line = "<a href='$murl'>$name</a>";
						$ret .= $gstart . $line . $gend;						
					}	
                } 					
				else {
					if ($tmpl) {
						$tokens[] = ''; //dummy
						$tokens[] = $murl;
						$tokens[] = $name;
						$tokens[] = ''; 
						$ret .= $this->combine_tokens($tmpl, $tokens, true);
					}
					else {
						$line = "<a href='$murl'>$name</a>";
						$ret .= $gstart . $line . $gend;
					}							
				}	
			}	     
		}
		
		return ($ret);
	}
   
	protected function render_submenu($smenu=null, $template=null, $glue_tag=null, $mlang=true) {
        $lan = getlocal() ? getlocal() : '0';
        if (empty($smenu))
		   return;
		   
		foreach ($smenu as $m=>$v) {
		    $cv = ($mlang && strstr($v, $this->delimiter)) ? explode($this->delimiter ,$v) : $v;
		
		    if (strstr($m,'title')) {
				$subm_titles[] = (is_array($cv)) ? $cv[$lan] : $cv;
			}   
			elseif (strstr($m,'link')) {
				$_cv = (is_array($cv)) ? $cv[$lan] : $cv;
				$subm_links[] = $this->make_link($_cv);
			}   
		}		   
		
        $ret = null;
		$gstart = $glue_tag ? '<'.$glue_tag.'>' : null;
		$gend = $glue_tag ? '</'.$glue_tag.'>' : null;		
		
		if ($template) {
			$tmpl = _m('cmsrt.select_template use ' . $template);
			foreach ($subm_titles as $t=>$title) {
				$tokens = array();
				$tokens[] = $subm_links[$t];
				$tokens[] = $title;
				$out .= $this->combine_tokens($tmpl,$tokens,true);
			}	
		}
		else {
			foreach ($subm_titles as $t=>$title) {
				$line = "<a href='{$subm_links[$t]}'>$title</a>";
				$out .= $gstart . $line . $gend;
			}		
		}
 
	    return ($out);
    }
	
	//transform links for special chars
	protected function make_link($link=null) {
		$csep = _v("cmsrt.cseparator");
		
	    $ret = str_replace(array('@','^'), array('?t=',$csep), $link);
		return ($ret);
	}
   
	//tokens method	
	protected function combine_tokens($template_contents,$tokens, $execafter=null) {
		
	    if (!is_array($tokens)) return;
		
		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
		  $fp = new fronthtmlpage();
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


		if (($execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
		  $fp = new fronthtmlpage();
		  $retout = $fp->process_commands($ret);
		  unset ($fp);
          
		  return ($retout);
		}		
		
		return ($ret);
	}   
   
};
}
?>