<?php

$__DPCSEC['SHMENU_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("SHMENU_DPC")) && (seclevel('SHMENU_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("SHMENU_DPC",true);

$__DPC['SHMENU_DPC'] = 'shmenu';


$__EVENTS['SHMENU_DPC'][1]='menu';
$__EVENTS['SHMENU_DPC'][2]='menu1';
$__EVENTS['SHMENU_DPC'][3]='menu2';

$__ACTIONS['SHMENU_DPC'][1]='menu';
$__ACTIONS['SHMENU_DPC'][2]='menu1';
$__ACTIONS['SHMENU_DPC'][3]='menu2';


$__LOCALE['SHMENU_DPC'][0]='SHMENU_CNF;Menu;Menu';	   

	   
class shmenu {

	var $path, $urlpath, $inpath, $menufile;
	var $delimiter, $cseparator;
   
	var $tmpl_path, $tmpl_name;
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
	  
       $this->menufile = $this->path . 'menu.ini';
	   $this->delimiter = ',';
	   
	   $this->tmpl_path = remote_paramload('FRONTHTMLPAGE','path',$this->path);
	   $this->tmpl_name = remote_paramload('FRONTHTMLPAGE','template',$this->path);  
	   
       $csep = remote_paramload('SHMENU','csep',$this->path); 
       $this->cseparator = $csep ? $csep : '^';	/*for cat links */

       $this->dropdown_class = remote_paramload('SHMENU','dropdownclass',$this->path);	   
	   $this->dropdown_class2 = remote_paramload('SHMENU','dropdownclass2',$this->path);
	}
   

	public function event($event=null) {
   
       switch ($event) {
		 case 'menu'          :	
		 default              : 						
	   }
	}
   

	public function action($action=null) {

       switch ($action) {
		 case 'menu'          :						
		 default              : 
	   }
	   
	   return ($out);
	}   
   			

	public function render($menu_template=null,$glue_tag=null,$submenu_template=null) {
        $lan = getlocal() ? getlocal() : '0';
   
        //echo $this->menufile;
		if (is_readable($this->menufile))
          $m = parse_ini_file($this->menufile,1,INI_SCANNER_RAW);
		  
		//print_r($m);
		foreach ($m as $menu_item) {
		
          //menu items		
		  if (isset($menu_item['title'])) { 		
		  
		    $title = explode($this->delimiter ,$menu_item['title']);
		    $link = explode($this->delimiter ,$menu_item['link']); 		  
		  
		    //spaces before and after title
		    $spaces = explode($this->delimiter ,$menu_item['spaces']); 
		    if ($sp = $spaces[$lan]) 
		      $sps[$title[$lan].'-spaces'] = $sp;
		    else	
			  $sps[$title[$lan].'-spaces'] = 0;

		    //submenu
		    $submenu = explode($this->delimiter ,$menu_item['submenu']); 
		    if ($smenu = $submenu[$lan]) 
		      $smu[$title[$lan].'-submenu'] = $smenu;
		    else	
			  $smu[$title[$lan].'-submenu'] = null;
		
		    
			//set title / link
		    $menu[$title[$lan]] = $link[$lan];
		  }
		}
		
		//print_r($smu);
		//print_r($sps);
		//print_r($menu);
		if (!empty($menu)) {
		   $ret = null;
	       $mytemplate = $menu_template?$menu_template:'menu.htm';
		   $subtemplate = $submenu_template ? $submenu_template : $mytemplate;
		   //echo '>',$mytemplate;	   
	       //$tfile = $this->urlpath .'/' . $this->inpath . '/cp/html/'. $mytemplate ;
           $tfile = $this->path . $this->tmpl_path .'/'. $this->tmpl_name .'/'. $mytemplate ;		   
           //echo $tfile;
		   
           if (is_readable($tfile)) {
		   
                $tt = file_get_contents($tfile);
				
                foreach ($menu as $name=>$url) {
				
				    $tokens = array(); //reset tokens
				    $murl = $url ? $this->make_link($url) : '#';
					
					if ($space_count = $sps[$name.'-spaces']) {
					  $name_space = str_repeat('&nbsp;', $space_count) . $name . str_repeat('&nbsp;', $space_count);
					  //echo $name.'-spaces>',$name_space,'>',$space_count,'<br>';
					}  
					else  
					  $name_space = $name;  	
                    
                    if ($sub_menu = $smu[$name.'-submenu']) {
					
					   if (stristr($sub_menu,'shkategories.')) {//phpdac cmd
					     if (defined('SHKATEGORIES_DPC')) {
							$cmddac = str_replace('^',$this->cseparator,$sub_menu);
							$ret2 = GetGlobal('controller')->calldpc_method($cmddac); //cat sep
							$tokens[] = $this->dropdown_class;//'dropdown'; 
						 }
					   }
					   elseif (stristr($sub_menu,'.htm')) {//htm template file
					     //echo 'a',$sub_menu;
                         $menusubfile = $this->path . $this->tmpl_path .'/'. $this->tmpl_name .'/'. str_replace('.',getlocal().'.',$sub_menu) ; 
					     if (is_readable($menusubfile)) {
					       //echo $menusubfile;
		                   $mytemplate = file_get_contents($menusubfile);
					       $ret2 = $this->combine_tokens($mytemplate,array(0=>''),true);
						   $tokens[] = $this->dropdown_class2;//'dropdown yamm-fw';
					     }					   
					   }
					   else {
					     //echo 'b',$sub_menu;
					     $_smenu = (array) $m[$sub_menu];
					     $ret2 = $this->render_submenu($_smenu, $subtemplate, $glue_tag);
						 $tokens[] = $this->dropdown_class;//'dropdown';
					   }
					   
					   //echo $ret2;
					   $menu_contents = $this->combine_tokens($tt,$tokens,true);
					   $ret .= str_replace('@SHMENU-SUBMENU@',$ret2,str_replace('@SHMENU-TITLE@',$name_space,str_replace('@SHMENU-LINK@',$murl,$menu_contents)));
                    } 					
					else
					   $ret .= str_replace('@SHMENU-SUBMENU@','',str_replace('@SHMENU-TITLE@',$name_space,str_replace('@SHMENU-LINK@',$murl,$menu_contents)));
				}	
           }
           else {
                foreach ($menu as $name=>$url) {
				    $murl = $url ? $this->make_link($url) : '#';
					$ss = $name . '-spaces';
					if ((isset($sp[$ss])) && ($space_count = $sp[$ss]))
					  $name_space = str_repeat('&nbsp;', $space_count) . $name . str_repeat('&nbsp;', $space_count);
					else  
					  $name_space = $name;  	
					  
                    $ret .= "<a href='$murl'>$name_space</a>";

                    $mm = $name . '-submenu'; 
                    if ((isset($smu[$mm])) && ($sub_menu = $smu[$mm])) {
					   //echo 'a',$sub_menu;
					   $_smenu = (array) $m[$sub_menu];
					   $ret .= $this->render_submenu($_smenu, $subtemplate, $glue_tag);
                    }					
				}	
		   }	     
		   //echo $ret;
		   return ($ret);
		}
	}
   
	protected function render_submenu($smenu=null,$template=null,$glue_tag=null) {
        $lan = getlocal() ? getlocal() : '0';
        if (empty($smenu))
		   return;
		   
		foreach ($smenu as $m=>$v) {
		    $cv = explode($this->delimiter ,$v);
		
		    if (strstr($m,'title'))
			   $subm_titles[] = $cv[$lan];
			elseif (strstr($m,'link'))
			   $subm_links[] = $this->make_link($cv[$lan]);
		}		   
		   
		//echo '>',$smenu;   
		//echo '<pre>';
		//print_r($subm_titles);  
		//print_r($subm_links);
		//echo '</pre>';
		
        $ret = null;
	    $mytemplate = $template?$template:'menu.htm';
		//echo '>',$mytemplate;	   
	    //$tfile = $this->urlpath .'/' . $this->inpath . '/cp/html/'. $mytemplate ;				
		$tfile = $this->path . $this->tmpl_path .'/'. $this->tmpl_name .'/'. $mytemplate ;
		//echo $tfile;
		$gstart = $glue_tag ? '<'.$glue_tag.'>' : null;
		$gend = $glue_tag ? '</'.$glue_tag.'>' : null;		
		
	    foreach ($subm_titles as $t=>$title) {
		   $line = "<a href='$subm_links[$t]'>$title</a>";
		   $out .= $gstart . $line . $gend;
	    }		
	
		/*if (is_readable($tfile)) 
		   $ret = str_replace('@SHMENU-SUBMENU@',$out,file_get_contents($tfile));
		else*/   
		   return ($out);
    }
	
	//transform links for special chars
	protected function make_link($link=null) {
	
	    $ret = str_replace('@','?t=',$link);
		$out = str_replace('^',$this->cseparator,$ret);
		return ($out);
	}
   
	//tokens method	
	protected function combine_tokens($template_contents,$tokens, $execafter=null) {
	
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
		for ($x=$i;$x<20;$x++)
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