<?php
$__DPCSEC['SHKATEGORIES_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ( (!defined("SHKATEGORIES_DPC")) && (seclevel('SHKATEGORIES_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("SHKATEGORIES_DPC",true);

$__DPC['SHKATEGORIES_DPC'] = 'shkategories';

$__EVENTS['SHKATEGORIES_DPC'][0]='shkategories';
$__EVENTS['SHKATEGORIES_DPC'][1]='category';
$__EVENTS['SHKATEGORIES_DPC'][2]='openf';
$__EVENTS['SHKATEGORIES_DPC'][3]='kshow';
$__EVENTS['SHKATEGORIES_DPC'][4]='klist';
$__EVENTS['SHKATEGORIES_DPC'][5]='catfetch';

$__ACTIONS['SHKATEGORIES_DPC'][0]='shkategories';
$__ACTIONS['SHKATEGORIES_DPC'][1]='category';
$__ACTIONS['SHKATEGORIES_DPC'][2]='openf';
$__ACTIONS['SHKATEGORIES_DPC'][3]='kshow';
$__ACTIONS['SHKATEGORIES_DPC'][4]='klist';
$__ACTIONS['SHKATEGORIES_DPC'][5]='catfetch';

$__LOCALE['SHKATEGORIES_DPC'][0]='SHKATEGORIES_DPC;Categories;Κατηγορίες';
$__LOCALE['SHKATEGORIES_DPC'][1]='SHSUBKATEGORIES_;Subcategories;Υποκατηγορίες';
$__LOCALE['SHKATEGORIES_DPC'][2]='_cfounded; categories found; κατηγορίες βρέθηκαν';

class shkategories {

    var $title, $path, $nav_on, $urlpath, $inpath, $httpurl;
	var $menu, $title2, $resourcepath, $resourcefilepath;
	var $depthview, $selected_category, $showcatbannerpath, $showcatimagepath;
	var $max_selection, $rewrite, $notencodeurl, $result_in_table;
	var $cseparator, $cat_result, $replacepolicy, $encodeimageid;
	var $imagex, $imagey, $wordlength, $aliasID, $aliasExt,$userLevelID;

	public function __construct() {	
		$UserSecID = GetGlobal('UserSecID');	
		$this->userLevelID = (((decode($UserSecID))) ? (decode($UserSecID)) : 0);	
	
		$this->title = localize('SHKATEGORIES_DPC',getlocal());	
		$this->title2 = localize('SHSUBKATEGORIES_',getlocal());	  
		
		//$this->httpurl = paramload('SHELL','urlbase');  
		$this->httpurl = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
		$this->httpurl.= (strstr($_SERVER['HTTP_HOST'], 'www')) ? $_SERVER['HTTP_HOST'] : 'www.' . $_SERVER['HTTP_HOST'];				
		
		$this->path = paramload('SHELL','prpath');		  
		$this->urlpath = paramload('SHELL','urlpath');
		$this->inpath = paramload('ID','hostinpath');			  

		$this->outpoint = '&gt;';
		$this->bullet = '&gt;';
        $this->rightarrow = '&gt;';
			 
		if ($resources = remote_paramload('SHKATEGORIES','resources',$this->path)) {
			
	        $this->resourcepath = $this->httpurl . $this->inpath . $resources;	 			  
		    $this->resourcefilepath = $this->urlpath . $this->inpath . $resources;	 			    
		}
		else  
		    $this->resourcepath = null; 
		
	  	$this->restype = remote_paramload('SHKATEGORIES','restype',$this->path);	   
		$this->home = localize(paramload('SHELL','rootalias'),getlocal()); 
		$this->nav_on = remote_paramload('KATEGORIES','navigate',$this->path);
		$this->menu = remote_paramload('SHKATEGORIES','menu',$this->path);	  
		//$this->usetablelocales = remote_paramload('SHKATEGORIES','locales',$this->path);	 
		$this->depthview = remote_paramload('SHKATEGORIES','depthview',$this->path);	
	  
		$this->showcatbannerpath = remote_paramload('SHKATEGORIES','catbannerpath',$this->path);	
		$this->showcatimagepath = remote_paramload('SHKATEGORIES','catimagepath',$this->path);		  	  
	  
		//$this->rewrite = remote_paramload('SHKATEGORIES','rewrite',$this->path); //DISABLED
		$this->notencodeurl = remote_paramload('SHKATEGORIES','notencodeurl',$this->path);
		$this->result_in_table = remote_paramload('SHKATEGORIES','resultintable',$this->path);
	  
		$csep = remote_paramload('SHKATEGORIES','csep',$this->path); 
		$this->cseparator = $csep ? $csep : '^';	

		//thumb xy ..overwriten by shkatalog/shkatlogmedia
		$this->imagex = remote_paramload('SHKATEGORIES','imagex',$this->path);	
		$this->imagey = remote_paramload('SHKATEGORIES','imagey',$this->path);	
		//replace policy
		$this->replacepolicy = remote_paramload('SHKATEGORIES','replacechar',$this->path);	
		$this->encodeimageid = remote_paramload('SHKATEGORIES','encodeimageid',$this->path);	  
	  
	  	$this->aliasID = _m("cmsrt.useUrlAlias");
		$this->aliasExt = _v("cmsrt.aliasExt");
		
		$this->cat_result = null; //save as var for tags
		$this->wordlength = 60;  // max word chars
		
		//on all pages
		$this->search_javascript();		  
	}  
	
	public function event($event=null) {
	
	    switch ($event) {
			case "catfetch"		:  	//ajax menu call
									$cat = GetReq('cat');
									if ($this->userLevelID < 5) 
										_m("cmsvstats.update_category_statistics use $cat+menu");
									
			                        $ps = $this->show_tree1($cat,1,null,1);
			                        //die($cat . "|" . $ps); //sndReqArg method
									die($ps); //ajaxCall jquery method
									break;			
			
			case 'openf'        : 	break;			
			case 'shkategories' :
			default             :								
        }					
    }
	
	public function action($action=null) {	
	
	    switch ($action) {	
		    case "catfetch"		: break;
		
			case 'openf'        : break;		
			case 'shkategories' :
			default             :								                      	
        }	
		
		return ($out);		
    }
	
	public function search_javascript() {
	
		if (iniload('JAVASCRIPT')) {

			//$id = remote_paramload('SHKATEGORIES','idsearch',$this->path);	  
			$code = $this->js_make_search_url();//$id);	
			
			$js = new jscript;	
			$js->load_js($code,null,1);			   
			unset ($js);
		}			   	   	     
	}	
	
	//for utf strings as products code..encode to digits for saving image
	public function encode_image_id($id=null) {
	    if (!$id) return null;
		$out = _m("cmsrt.encode_image_id use $id+".$this->encodeimageid); //$this->encodeimageid ? md5($id) : $id;
        return $out;
	}	
	
	public function show_category_banner($template=null) {
		$db = GetGlobal('db');	
		$cat = GetReq('cat');
		$lan = getlocal() ? getlocal() : '0';
	   
		$mytemplate = $template ? $this->select_template($template) : $this->select_template('fpkatbanner');	   
	   
		if ($this->showcatbannerpath) {		   
			$catdepth = explode($this->cseparator,$cat);
			$alsoseedir = $this->urlpath . $this->inpath . '/' . $this->showcatbannerpath;
	   
			//from inside to outer cat ...  
			while ($mycurrentsubcat = $this->replace_spchars(array_pop($catdepth))) {
 	  
				$sSQL = "select data from pattachments ";
				$sSQL .= " WHERE (type='.html' or type='.htm') and code='" . $mycurrentsubcat . "'";
				$sSQL .= " and (lan=" . $lan . ")";// or (lan=NULL)";	
	  
				$resultset = $db->Execute($sSQL,2);	
				$result = $resultset;

				if ($exist = $db->Affected_Rows()) {
					if ($mytemplate) {
						$tok[] = $result->fields['data'];
						$out .= $this->combine_tokens($mytemplate, $tok);
						return ($out);			 
					}
					else 
						return ($result->fields['data']);
				}		   
				else {			   
					$nn = str_replace('/','-',$mycurrentsubcat); //replace title / with -	 
					$catname = '/' . $nn . $lan . '.htm';

					if (@is_file($alsoseedir.$catname)) {
						$htmlret = @file_get_contents($alsoseedir.$catname);
						if ($mytemplate) {
							$tok[] = $htmlret;
							$out .= $this->combine_tokens($mytemplate, $tok);
							return ($out);
						}
						else
							return ($htmlret);
					}
				}	 
				//$ret = 'banner';
			}//while  
		} 
		return null; 
	}
	
	public function show_category_image() {
		$cat = GetReq('cat');
		$t = GetReq('t');

		if ($this->showcatimagepath) {	
			$catdepth = explode($this->cseparator,$cat);
			$alsoseedir = $this->urlpath . $this->inpath . '/' . $this->showcatimagepath;
		
			if ($cat) { 
				//from inside to outer cat ...  
				while ($mycurrentsubcat = $this->replace_spchars(array_pop($catdepth))) {
	   
					$nn = str_replace('/','-',$mycurrentsubcat); //replace title / with -
           
					$catname = '/';
					$catname.= $this->encode_image_id($nn);
					$catname.= $this->restype;   

					if (@is_file($alsoseedir.$catname)) {
						$image = $this->showcatimagepath.$catname;
						$htmlret = "<img src='$image' alt='' />";//file_get_contents($alsoseedir.$catname);
						$ret = $htmlret;
						return ($ret);
					}
					//echo 'image';
				}//while
			}//if
			else {
				$tname = '/';
				$tname.= $this->encode_image_id($tid);
				$tname.= $this->restype; 
	  
				if (@is_file($alsoseedir.$tname)) {
					$image = $this->showcatimagepath.$tname;
					$htmlret = "<img src='$image' alt='' />";//file_get_contents($alsoseedir.$catname);
					$ret = $htmlret;
					return ($ret);
				}		 
			}
		} 
		return null;//($ret);	 
	}	
	
	protected function get_image_icon($catcode=null) {	
        $alsoseedir = $this->urlpath . $this->inpath . '/' . $this->showcatimagepath;
		
        $x = $this->imagex ? "width=\"".$this->imagex."\"":null; 
        $y = $this->imagey ? "height=\"".$this->imagey."\"":null;			
		
	    if (!$catcode) {
		    $tname = 'nopic' . $this->restype ;
		}	
		else {
			  $tname = $this->encode_image_id($catcode);
			  $tname.= $this->restype; 	
		} 	
		
		if (is_readable($alsoseedir.$tname)) 
		     $image = $this->showcatimagepath.$tname;
		else 
		     $image = $this->showcatimagepath. 'nopic' . $this->restype ;
		
		$htmlret = "<img src='$image' $x $y>";
		$ret = $htmlret;
		return ($ret);		 
	}		
	
	//setof groups used by search to get def group per res for non view cats
	//group is null in this case
	//setofdepths is the real depth comes from
    protected function view_category($ddir,$type=1,$mode=0,$group=null,$cmd=null,$tokens=null,$setofgroups=null,$setofdepths=null,$template=null) {
		$t = $cmd ? $cmd : 'shkategories';
	    $mytemplate = $template ? str_replace('.htm', '', $template) : 'fpkatlist';			
		
		$cdepth = $this->get_treedepth();
		
		if (($this->depthview) && ($this->depthview<=$cdepth)) {
			//don't show
			return;
		}
		 
        if ($ddir)  {					 
			$i=0;	
			$this->max_selection = 0;	
		   	   	 
			reset($ddir);
			foreach ($ddir as $line_num => $line) {	
		   					    
				if (stristr($t,'input=')) { //ti replaces first search with result name
				   $text2find = GetParam('Input') ? GetParam('Input') : GetReq('input'); 
				   $ti = str_replace($text2find,$line,$t);
				}
				else
				   $ti = $t;
			 
				$loctitle = $line;
				$title = $loctitle;		
					
				if (trim($group)==null) {				  
					$search_array_group = $setofgroups[$line_num];
					if ($search_array_group) 			
					    $gr = $search_array_group . $this->cseparator . $this->replace_spchars($line_num);					
					else
             	        $gr = $this->replace_spchars($line_num);					
				}
				else		
				    $gr = $group . $this->cseparator . $this->replace_spchars($line_num); 
		  				  				  
                switch ($type) {
                    case  2 :  	$mytokens[] =  _m("cmsrt.url use t=$ti&cat=$gr+$loctitle") . '<br/>';
								break;
							   
                    case  3 :  	$mytokens[] = _m("cmsrt.url use t=$ti&cat=$gr+<b>$loctitle</b>"); 
								break;
							   
					case  4 :  	$mytokens[] = _m("cmsrt.url use t=$ti&cat=$gr+<b>$loctitle</b>"); 
								break;

					case  1 : 
                    default :   $mytokens[] = _m("cmsrt.url use t=$ti&cat=$gr+$loctitle") . " " . $this->outpoint . " "; 
								$tok2[$i][] = _m("cmsrt.url use t=$ti&cat=$gr+$loctitle") . " " . $this->outpoint . " "; 
								$tok2[$i][] = $gr; //cat name
								$tok2[$i][] = $loctitle; //cat title
								$tok2[$i][] = $this->catUrl($gr, $ti); 
								$tok2[$i][] = $this->get_image_icon($gr);//$this->show_category_image();//image
                }  
			   
			    $i+=1;
			    $this->max_selection+=1;
			  
			}//foreach 
		   	  
			$mydatatemplate = _m('cmsrt.select_template use ' . $mytemplate);
			$tokret = $this->combine_n_tokens($mydatatemplate, $mytokens, $tok2);
			return ($tokret);
	    }
	}		
	
	public function show_tree($cmd=null,$group=null,$treespaces='',$sp=0,$mode=0,$wordlength=19,$notheme=null,$stylesheet=null) {		
		$cat = GetReq('cat'); //$this->replace_spchars(GetReq('cat'),1);
		if (!$wordlength) $wordlength = 19;//for calldpc purposes
		$mystylesheet = $stylesheet ? $stylesheet : 'group_category_title';	
		$mystylesheet_selected = $mystylesheet . '_selected';   
	   	$t = $cmd ? $cmd : 'shkategories';   

		static $cd = -1;
	   
		$ptree = explode($this->cseparator,$cat); //print_r($ptree);
		$depth = count($ptree)-1; //echo 'DEPTH:',$depth;  
		$ddir = $this->read_tree($group);
 
		$i=0;	 
		if ($ddir)  {	   
			reset($ddir);
			foreach ($ddir as $id => $line) {	
		    
				if ($line) {
					$_id = $this->replace_spchars($id);
			
					if (trim($group)!=null) {
						$folder = $group . $this->cseparator . $id; 
						$gr = $group . $this->cseparator . $_id;			   
					}	
					else {
						$folder = $id;
						$gr = $_id; 
					}	
			
					$cgroup = $ptree[$cd+1];
					$_u = $this->catUrl($gr, $t);
					$mycat = $treespaces . $this->outpoint . "<a href=\"" . $_u . "\">";
					$mycat .= $this->summarize(($wordlength-$sp),$line);	
					$mycat .= "</a>";
			  
					$out .= $mycat . '<br/>';

					//if ($cgroup==$line) {
					if (mb_strstr($cgroup,$_id)) {	  
						$cd+=1;
						if ($cd+1<$this->depthview) {//depth view param for hidden categories
							$mysp=($cd+1) * 3;
							$mytreespaces = str_repeat("&nbsp;",($cd+1)*3);	   
							$out .= $this->show_tree($cmd,$folder,$mytreespaces,$mysp,$mode,$wordlength,$notheme);
						}
					}			  
				}//if line
				$i+=1;
			}//foreach
		}//if ddir	
	   
		return ($out); 			      
	}
	
	/*using accordion template version 2*/
	public function show_tree2($group=null,$mode=0,$template=null) {		
		$cat = GetReq('cat');    
		$t = 'klist';			
	   
	   	static $cd = -1;
	   
		$tokens = array();		 
		$line_data = _m('cmsrt.select_template use fpkatnav-accordion-line');
		$inner_data = _m('cmsrt.select_template use fpkatnav-accordion-inner');    
		   
		$ptree = explode($this->cseparator,$cat); 
		$depth = count($ptree)-1;   
		$ddir = $this->read_tree($group);
 
		$i=0;	 
		if ($ddir)  {	   
			reset($ddir);
			foreach ($ddir as $id => $line) {	
				if ($line) {
					$_id = $this->replace_spchars($id);
			
					if (trim($group)!=null) {
						$folder = $group . $this->cseparator . $id; 
						$gr = $this->replace_spchars($group) . $this->cseparator . $_id;		   
					}	
					else {
						$folder = $id;
						$gr = $_id;
					}	
			  	
					//$gr = $current_leaf;		 
					$cgroup = $ptree[$cd+1]; 	 		

					$tokens[0] = $_id;
					$tokens[1] = $this->summarize(null,$line);//accordion cat name
					$tokens[2] = null;//_m("cmsrt.url use t=$t&cat=$gr"); //url

					//if ($cgroup==$line) {
					if (mb_strstr($cgroup,$_id)) {
						$cd+=1;
						if ($cd+1<$this->depthview) {//depth view param for hidden categories
							$subcat_tokens = $this->show_tree2($folder,$mode,$template);
							$tokens[3] = 1;//isset($subcat_tokens) ? 1 : 0;//accordion expand-collapse
							$tokens[4] = isset($subcat_tokens) ? $this->combine_tokens($inner_data,array('0'=>$_id,'1'=>$subcat_tokens)) : null;
							$tokens[5] = $group ? 1 : 0; //check for subtree
							$tokens[6] = $this->catUrl($gr, $t);
							$out .= $this->combine_tokens($template,$tokens,true);
						}
					}//=group
					else {
				        $_u = $this->catUrl($gr, $t); 
						$_t = $this->summarize(null, $line);	
						$out .= ($group) ? $this->combine_tokens($line_data, array(0=>$_u, 1=>$_t), true) : null;
					}
					//print_r($tokens);	
					unset($tokens);
					unset($subcat_tokens);						
				}//if line
				$i+=1;
			}//foreach
		}//if ddir	

		return ($out); 			      
	}	
	
	/*using accordion template*/
	public function show_tree1($group=null,$mode=0,$template=null,$ajaxcall=false) {		
		$cat = GetReq('cat');    
		$t = 'klist';			
	   
	   	static $cd = -1;
	   
		$tokens = array();		 
		$line_data = _m('cmsrt.select_template use fpkatnav-accordion-line');
		$inner_data = _m('cmsrt.select_template use fpkatnav-accordion-inner');    
			   
		$ptree = explode($this->cseparator,$cat); 
		$depth = count($ptree)-1;   
		$ddir = $this->read_tree($group);
 
		$i=0;	 
		if ($ddir)  {	   
			reset($ddir);
			foreach ($ddir as $id => $line) {	
				if ($line) {
					$_id = $this->replace_spchars($id);
			
					if (trim($group)!=null) {
						$folder = $group . $this->cseparator . $id; 
						$gr = $this->replace_spchars($group) . $this->cseparator . $_id;		   
					}	
					else {
						$folder = $id;
						$gr = $_id;
					}	
			  	
					//$gr = $current_leaf;		 
					$cgroup = $ptree[$cd+1]; 	 		

					$tokens[0] = $_id;
					$tokens[1] = $this->summarize(null,$line);//accordion cat name
					$tokens[2] = $this->catUrl($gr, $t); 

					//if ($cgroup==$line) {
					if (mb_strstr($cgroup,$_id)) { //selected cat
						$template = ($cd<0) ? $template : "<li>" . $template . "</li>";
						$cd+=1;
						if ($cd+1<$this->depthview) {//depth view param for hidden categories
							$subcat_tokens = $this->show_tree1($folder,$mode,$template);
							$tokens[3] = 1;//accordion expand-collapse
							$tokens[4] = isset($subcat_tokens) ? $this->combine_tokens($inner_data, array('0'=>$_id,'1'=>$subcat_tokens)) : null;
							$tokens[5] = $group ? 1 : 0; //check for subtree
							$tokens[6] = $this->catUrl($gr, $t);
							$out .= $this->combine_tokens($template,$tokens,true);
						}
					}//=group
					else {				   
						if ($mode) {
							if ($group) { //child cat
								$out .= $this->combine_tokens($line_data, $tokens, true);
							}
							else { //parent cat
								$accordion_group = _m('cmsrt.select_template use fpkatnav-accordion-group');
								$out .= $this->combine_tokens($accordion_group, $tokens, true);
							}
						}	
						else //browse only selected cat children
							$out .= ($group) ? $this->combine_tokens($line_data, $tokens, true) : null;
					}	
					//print_r($tokens);	
					unset($tokens);
					unset($subcat_tokens);						
				}//if line
				$i+=1;
			}//foreach
		}//if ddir	

		if ($ajaxcall==true) { //fetch inner data
			$ajaxout = $this->combine_tokens($inner_data, array('0'=>GetReq('cat'),'1'=>$out));
			return ($ajaxout);
		}
		else 
			return ($out);		      
	}			
	
    public function show_menu($group=null,$template=null) { 
		$group = $group ? $group : GetReq('cat');	 
		
		if ($group) {
			
			$mytemplate = ($template) ? _m('cmsrt.select_template use ' . str_replace('.htm', '', $template)) :
										_m('cmsrt.select_template use fpkatnav-accordion');
			$subtemplate = _m('cmsrt.select_template use fpkatnav-accordion-group-selected');			
			
			switch ($viewtype) {  
                case 2  : /*safe copy showtree*/
				          $stree[] = $this->show_tree2(null,1,$subtemplate); 
						  break;	 			 
			    case 1  : 
				default : $stree[] = $this->show_tree1(null,1,$subtemplate);		 
			}
			 
            $out = $this->combine_tokens($mytemplate, $stree, true);			 
		}		
        return ($out);
    }		

	
	//  SHOW SELECTED TREE FUNCTIONS
	protected function show_selected_branch($id,$line,$t=null,$myselcat=null,$expand=null,$stylesheet=null,$outpoint=null,$br=1,$template=null,$linkclass=null,$linksonly=null,$titlesonly=null,$idsonly=null) {
	    $mystylesheet = $stylesheet ? $stylesheet : 'group_category_title';	
	
	    $mytemplate = $template ? $this->select_template($template,$cat) :		   
								  $this->select_template('fpcatcolumn',$cat);			   
			  
		if ($line) {	
			if (trim($myselcat)!=null) {
			    $folder = $myselcat . $this->cseparator . $id; 
			    $gr = $this->replace_spchars($myselcat . $this->cseparator . $id);			   
			}	
			else {
			    $folder = $id;
			    $gr = $this->replace_spchars($id);
			}	

			if ($outpoint)
			    $mycat .= str_repeat('&nbsp;',$outpoint) . $this->outpoint;		  
            $mycat .= "<a href=\"" . $this->catUrl($gr, $t); 
			$mycat .=  ($linkclass) ? "\" class=\"$linkclass\">" : "\">";
			$mycat .= $line;		
			$mycat .= "</a>";	
		
			$tokens[] = ($linksonly) ? $this->catUrl($gr, $t) :
				                   ($titlesonly ? $line : ($idsonly ? $id : $mycat));
			$tokens[] = $id;
			$out .= $this->combine_tokens($mytemplate, $tokens, true);					

		}//if  	 
		  
		return ($out);  
	}
	
    public function show_selected_tree($cmd=null,$group=null,$showroot=null,$expand=null,$viewlevel=null,$stylesheet=null,$outpoint=null,$br=1,$template=null,$linkclass=null,$linksonly=null,$titlesonly=null,$idsonly=null) {
		$mystylesheet = $stylesheet ? $stylesheet : 'group_category_title';	
		$myselcat = $group ? $group : GetReq('cat'); 	  

		static $cd = -1;
		$wordlength = 19;//for calldpc purposes
		$t = $cmd ? $cmd : 'klist';

		$ptree = explode($this->cseparator,$myselcat); 
			  
		if ($viewlevel) {
			$depth = count($ptree);//-1 echo 'DEPTH:',$depth;
			//echo $cat;    
			if ($depth>$viewlevel) {
				foreach ($ptree as $p=>$pt) {
					if ($p<$viewlevel) 
						$pv[] = $pt;
				}	
				$myselcat = implode($this->cseparator,$pv);
			}
		}
		    
		if ($showroot) 
			$ddir = $this->read_tree(null,null,1);
		elseif ($myselcat) 	
			$ddir = $this->read_tree($myselcat,null,1);	
		
		$i=0;	 
		if ($ddir)  {	   
			reset($ddir);
			foreach ($ddir as $id => $line) {		  
				$out .= ($showroot) ? 
						$this->show_selected_branch($id,$line,$t,null,$expand,$mystylesheet,$outpoint,$br,$template,$linkclass,$linksonly,$titlesonly,$idsonly):
						$this->show_selected_branch($id,$line,$t,$myselcat,$expand,$mystylesheet,$outpoint,$br,$template,$linkclass,$linksonly,$titlesonly,$idsonly);
			
				$i+=1; 
			}//foreach				
		}//if ddir
	  
		return ($out);
    }	
	//.....  SHOW SELECTED TREE FUNCTIONS	
			
	
	//read tree table
	public function read_tree($g=null,$debug=null,$orderctg=null) {
		$db = GetGlobal('db');	
		$lan = getlocal();
		$mylan = $lan?$lan:'0'; 	   
		$f = $mylan;   
		$depth = 0;
	   
		if (strlen(trim($g))>0) {
			$group = explode($this->cseparator,$g);   //print_r($group);
			$mg = count($group);
			$depth = ($mg ? $mg : 0); //echo 'DEPTH:',$depth;
			//if ($depth>3) return null; //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! 		 
		}

		switch ($depth) {
			case 1 : $sSQL = "select cat3,cat{$f}3,cat2,cat{$f}2 from categories where "; break;
			case 2 : $sSQL = "select cat4,cat{$f}4,cat3,cat{$f}3,cat2,cat{$f}2 from categories where "; break;
			case 3 : $sSQL = "select cat5,cat{$f}5,cat4,cat{$f}4,cat3,cat{$f}3,cat2,cat{$f}2 from categories where "; break;
			case 4 : $sSQL = "select null from categories"; break;
			default: $sSQL = "select cat2,cat{$f}2 from categories where "; break;
		}
		//$sSQL .= ' where '; 
		switch ($depth) {
			case 4 : 
			case 3 : $sSQL .= "(cat4='" . $this->replace_spchars($group[2],1) . "' or cat{$f}4='" . $this->replace_spchars($group[2],1) . "') and ";
			case 2 : $sSQL .= "(cat3='" . $this->replace_spchars($group[1],1) . "' or cat{$f}3='" . $this->replace_spchars($group[1],1) . "') and ";
			case 1 : $sSQL .= "(cat2='" . $this->replace_spchars($group[0],1) . "' or cat{$f}2='" . $this->replace_spchars($group[0],1) . "') and "; //break;
			default: $sSQL .= "ctgid>0 and active>0 and view>0";
		} 	   
		 
		$sSQL .= " order by ctgid"; /*ctgoutlnorder";//,ctgid asc"; ***************************/
		 
		if ($debug) 
			echo $sSQL; 
	   
		$result = $db->Execute($sSQL,2);
			   					   
		if ($result) {      
			foreach ($result as $i=>$rec) {
				if ($f = $rec[0]) 
					$res[$f] = $rec[1]; 
			}
			return ($this->distinct($res));
		}
	}	

	protected function set_tree_path($array_path) {
		$max = count($array_path);
		
		foreach ($array_path as $id=>$path) {
			if (trim($path)) 
				$ret = ($id==0) ? $path : $this->cseparator . $path;
		}
		return $ret;
	}	
	
	//????
    protected function isparent($group=null) {
	    if ($this->alias) $group = $this->alias; 
		
		if (is_array($this->read_tree($group))) 
		  return true;

		return false;
	}			
	
    //get depth of group	
    protected function get_treedepth($group=null) {  
	    if (!$group) $group = GetReq('cat');
		$selection = GetReq('sel');
	
        $splitx = explode ($this->cseparator, $group);
		
	    if ($selection != array_pop($splitx)) 
		    $cats = explode ($this->cseparator, $group . $this->cseparator . $selection);
		else
		    $cats = explode ($this->cseparator, $group);
		         
        return (count($cats)-1);
    }		
	
    protected function analyzedir($group,$startup=0,$isroot=false) {
	    $db = GetGlobal('db');	
        $sel = GetReq('sel');
	    $lan = getlocal();
	    $f = $lan ? $lan : '0';			
		
        $adir = array();		
		
	    //if executed at event...
		if (($this->cat_result) && ($isroot==false))
		    return ($this->cat_result);
		
	    if ($isroot) {
			$depth = 1;			
			$sSQL = "select distinct cat2,cat{$f}2 from categories where ";
			$sSQL .= "(ctgid>0 and active>0 and view>0) order by ctgid";
			$result = $db->Execute($sSQL,2);
			
			if ($result) { 
				foreach ($result as $i=>$rec) {
					 $adir[$rec[0]] = $rec[1];
				}
				$ret_adir = $adir;
			}
		}
        else {
		    if ($startup) 
				$adir[] = $this->home; //set home
	  
			$splitx = explode ($this->cseparator, $group);   
		
		    $sSQL = "select distinct cat2,cat{$f}2,cat3,cat{$f}3,cat4,cat{$f}4,cat5,cat{$f}5 from categories where ";
			$depth = count($splitx)-1;
			switch ($depth) {
			  case 3  :$sSQL .= "cat5=\"".$this->replace_spchars($splitx[3],1)."\" and ";
			  case 2  :$sSQL .= "cat4=\"".$this->replace_spchars($splitx[2],1)."\" and ";
			  case 1  :$sSQL .= "cat3=\"".$this->replace_spchars($splitx[1],1)."\" and ";
			  case 0  :$sSQL .= "cat2=\"".$this->replace_spchars($splitx[0],1)."\""; 
			  default :
			}
			$sSQL .= " and (ctgid>0 and active>0 and view>0) order by ctgid";
			//$sSQL .= "ctgid>0 order by ctgid";
			$result = $db->Execute($sSQL,2);
			
			if ($result) {     
				for ($i=0;$i<=$depth;$i++) {
					$c = $i+2;
					if ($result->fields["cat{$f}{$c}"])
						$adir[$result->fields["cat{$c}"]] = $result->fields["cat{$f}{$c}"];			 
				} 
			}			  					

			//save as var for tags
			$this->cat_result = $adir;
			
			//depthview restiction	
			if ($this->depthview) {	
				$depthview = $this->depthview+$startup;
				$i=0;
				foreach ($adir as $a=>$b) {
					if ($i<$depthview) {
						$ret_adir[$a] = $b;
					}
					$i+=1;
				}	
			}  
			else
				$ret_adir = $adir;  				
		}	  
        
        //return ($adir);
		return ($ret_adir);
    }
	
    protected function view_analyzedir($cmd=null,$prefix=null,$startup=0,$nolinks=null,$isroot=false) { 	
		$t = ($cmd?$cmd:GetReq('t'));	
		$g = $this->replace_spchars(GetReq('cat'));
		$a = GetReq('a');	   	
		
		if ($prefix) 
          $mytokens[] = $prefix;
	
        $adirs = $this->analyzedir($g,$startup, $isroot);	

        if (!empty($adirs)) {					
		    //startup meters
		    $max = count($adirs)-1; 
		    if ($startup) $m = 1;
		             else $m = 0;		
			$m2 = 0;		 	
		    foreach ($adirs as $id=>$cname) {	
				if ($isroot) $curl = null; //reset
				$locname = $cname;	
			  
				if ($m2<=$max) { //< .......... link last element 
			  
					if ($m2==$max)
						$title = ($m2==$max) ? "<b>" . $locname . "</b>" : $locname;			  
			  
					if ($cname != $this->home) {
						if (($m2>$m)&&(!$isroot)) 
							$curl .= $this->cseparator . $this->replace_spchars($id);
						else 
							$curl .= $this->replace_spchars($id);
					  
						$mygroup = $curl;
			   
						$_u = $this->catUrl($mygroup, $t);			   
						$a = $_u; 
						$b = "<a href=\"" . $_u . "\">" . $locname . "</a>";
					}	
					else {
						$_u = $this->catUrl();
						$a = $_u; 
						$b = "<a href=\"" . $_u . "\">" . $locname . "</a>";					
					}
				
					$ablink = ($nolinks) ? $a : $b;						  
					$mytokens[] = ($nolinks) ? $ablink.'@'.$locname.'@'.$mygroup : $ablink;				      
				}	
				else 
					$mytokens[] = $locname;				   
	  	
				$m2+=1;	 
			}//foreach  
 
		}//adirs
		//echo '<pre>';
		//print_r($mytokens);
		//echo '</pre>';
		return ($mytokens);
    }	
	
	public function getcurrentkategory($toplevel=null, $url=null, $urlname=false) {
		$cat = GetReq('cat');
		if ($urlname) {
			$urlcats = explode ($this->cseparator, $cat);  	
			return (array_pop($urlcats)); 		
		}	
		
		$mycattree = $this->analyzedir($cat);
		
		if (empty($mycattree)) return;
	  
		if ($toplevel) {
			switch ($toplevel) {
				case 2  ://prevlevel
						$dummy = array_pop($mycattree);
						if (!$ret = array_pop($mycattree)) 	  
							$ret = $dummy;	 
						break;
				case 1  ://toplevel
				default :if ($url) { 
							//$ret = _m("cmsrt.url use t=klist&cat=" . GetReq('cat') . "+" . array_pop($mycattree)); 
							$_t = array_pop($mycattree);
							$ret = "<a href=\"" . $this->catUrl($cat) . "\">" . $_t . "</a>";
						 }	
						 else 
							$ret = array_pop(array_reverse($mycattree));	  
			}
		}	
		else {//actual
			if ($url) { 
				//$ret = _m("cmsrt.url use t=klist&cat=" . GetReq('cat') . "+" . array_pop($mycattree));
				$_t = array_pop($mycattree);
				$ret = "<a href=\"" . $this->catUrl($cat) . "\">" . $_t . "</a>";	
			}	
			else  
				$ret = array_pop($mycattree);	  	
		}
  
		return ($ret);
	}	
	
    public function tree_navigation($cmd=null,$prefix=null,$home=0,$dropdown_tmpl=null) {
		$mytemplate = _m('cmsrt.select_template use fpkatnav');
		
	    //dropdown 2nd template
        if ($dropdown_tmpl) {
		  
		  	$navdata = $this->view_analyzedir($cmd,$prefix,null,1);
			//print_r ($navdata);
			if (!empty($navdata)) { // dropdown			
			    //$mytemplate1 = _m('cmsrt.select_template use fpkatnav-element');
				$mytemplate2 = _m('cmsrt.select_template use ' . $dropdown_tmpl);
			
				foreach ($navdata as $n=>$data) {
					$tdata = explode('@',$data); 
					$tok[] = $tdata[0]; //url
					$tok[] = $tdata[1]; //title
					$tok[] = $tdata[2];
					$tok[] = ($n==count($navdata)-1) ? 1 : 0; 
					$navdata2[] = $this->combine_tokens($mytemplate2,$tok,true);
					unset($tok);
				}  
			  
				$out = $this->combine_tokens($mytemplate,$navdata2);
			}
        }
        else	{	  
		    $navdata = $this->view_analyzedir($cmd,$prefix,$home);
			$out = $this->combine_tokens($mytemplate,$navdata);
		}	
		    
		return ($out);
    }
	
	public function tree_root_navigation($cmd=null,$prefix=null,$home=0,$dropdown_tmpl=null) {
		$mytemplate = _m('cmsrt.select_template use fpkatnav');
		
	    //dropdown 2nd template
        if ($dropdown_tmpl) {
		  
		  	$navdata = $this->view_analyzedir($cmd,$prefix,null,null,true);
			$x = count($navdata)-1;   
			// dropdown
			//$mytemplate1 = _m('cmsrt.select_template use fpkatnav-element');
			$mytemplate2 = _m('cmsrt.select_template use ' . $dropdown_tmpl);
 
			foreach ($navdata as $n=>$data) {
				$tdata = explode('@',$data); 
				$tok[] = $tdata[0]; //url
				$tok[] = $tdata[1]; //title
				$tok[] = $tdata[2];
				//$tok[] = ($n==$x) ? 1 : 0; 
				$navdata2[] = $this->combine_tokens($mytemplate2,$tok,true);
				unset($tok);
				unset($tdata);
			}  
			//print_r($navdata2);  
			$out = $this->combine_tokens($mytemplate,array(0=>implode('',$navdata2)), true);

        }
        else {	  
		    $navdata = $this->view_analyzedir($cmd,$prefix,$home);
			$out = $this->combine_tokens($mytemplate,$navdata);
		}	  
		  
		return ($out);
    }		
		
	protected function distinct($arr) {
	  
	    if (is_array($arr)) {
			$out = array_unique($arr);
			asort($out);
			return ($out);
	    }	 
	}
	
    protected function getgroup($localize=0) {
	    $group = GetReq("g");   
		$ret_a = explode($this->cseparator,$group);
		$max = count($ret_a)-1;
		
		if (($clanguage=getlocal())!=$this->deflan)
		    $localizeit = localize($ret_a[$max],$clanguage);
		else  
		    $localizeit = $ret_a[$max];			
		
		return ($localizeit);	 
	}
	
	//to be disabled ?
    public function getkategories($rec=null,$links=null,$lan=null,$cmd=null, $debug=false) {
		$db = GetGlobal('db');
		$cmd = $cmd ? $cmd : 'klist';
		$lang = $lan ? $lan : getlocal();
		$f = $lang ? $lang : '0';
	   
		$sSQL = "select distinct cat2,cat{$f}2,cat3,cat{$f}3,cat4,cat{$f}4,cat5,cat{$f}5 from categories where ";

		if (($rec['cat0']) && ($this->depthview>=1)) $sSQL .= "cat2='".$this->replace_spchars($rec['cat0'])."'"; 
		if (($rec['cat1']) && ($this->depthview>=2)) $sSQL .= "and cat3='".$this->replace_spchars($rec['cat1'])."'";
		if (($rec['cat2']) && ($this->depthview>=3)) $sSQL .= "and cat4='".$this->replace_spchars($rec['cat2'])."'";
		if (($rec['cat3']) && ($this->depthview>=4)) $sSQL .= "and cat5='".$this->replace_spchars($rec['cat3'])."'";			  			  			  

	    $result = $db->Execute($sSQL,2);	
	  					
		$_cat0 = $result->fields["cat{$f}2"] ? $result->fields["cat{$f}2"] : $this->replace_spchars($rec['cat0']);
		$_cat1 = $result->fields["cat{$f}3"] ? $result->fields["cat{$f}3"] : $this->replace_spchars($rec['cat1']);
		$_cat2 = $result->fields["cat{$f}4"] ? $result->fields["cat{$f}4"] : $this->replace_spchars($rec['cat2']);
		$_cat3 = $result->fields["cat{$f}5"] ? $result->fields["cat{$f}5"] : $this->replace_spchars($rec['cat3']);
						
        if (($rec['cat0']) && ($this->depthview>=1)) {
		    if ($links)
			    $ck[0] = _m("cmsrt.url use t=$cmd&cat=" . $rec['cat0'] . "+" . $_cat0); 
		    else
                $ck[0] = $_cat0;
		}  	
				 	
        if (($rec['cat1']) && ($this->depthview>=2)) {
		    if ($links)
			    $ck[1] = _m("cmsrt.url use t=$cmd&cat=" . $rec['cat0'].$this->cseparator.$rec['cat1'] . "+" . $_cat1); 
			else				   
                $ck[1] = $_cat1;
		}		

        if (($rec['cat2']) && ($this->depthview>=3)) {
		    if ($links)
			    $ck[2] = _m("cmsrt.url use t=$cmd&cat=" . $rec['cat0'].$this->cseparator.$rec['cat1'].$this->cseparator.$rec['cat2'] . "+" . $_cat2); 
			else					 
                $ck[2] = $_cat2;
		}		  
 
        if (($rec['cat3']) && ($this->depthview>=4)) {
		    if ($links)
		   	    $ck[3] = _m("cmsrt.url use t=$cmd&cat=" . $rec['cat0'].$this->cseparator.$rec['cat1'].$this->cseparator.$rec['cat2'].$this->cseparator.$rec['cat3'] . "+" . $_cat3); 
			else				 
                $ck[3] = $_cat3;
		}	
				   
        if (($rec['cat4']) && ($this->depthview>=5)) {
		    if ($links)
		  	    $ck[4] = _m("cmsrt.url use t=$cmd&cat=" . $rec['cat0'].$this->cseparator.$rec['cat1'].$this->cseparator.$rec['cat2'].$this->cseparator.$rec['cat3'].$this->cseparator.$rec['cat4'] . "+" . $_cat4); 
			else				 
                $ck[4] = $this->replace_spchars($rec['cat4']);
		}	
				  	  	
        if (!empty($ck))
            $cat = implode($this->cseparator,$ck);
		
        unset($ck); //reset ck

        return ($cat);
    }	
	
	public function search_tree($text2find=null,$cmd='shkategories',$template=null) {
		if (!$text2find) return;	 
		$db = GetGlobal('db');			
		$cat2findin = GetReq('cat');
		$meter=0;	
		$viewtype=1;
		$lan = getlocal();   
		$mylan = $lan ? $lan : '0';   
		$f = $mylan;  
	
		for($i=2;$i<=5;$i++) {
	   
			$sSQL = 'select ';   
		 
			switch ($i) {
				case 2 : $sSQL .= "cat2,cat{$f}2"; break;
				case 3 : $sSQL .= "cat2,cat{$f}2,cat3,cat{$f}3"; break;
				case 4 : $sSQL .= "cat2,cat{$f}2,cat3,cat{$f}3,cat4,cat{$f}4"; break;
				case 4 : $sSQL .= "cat2,cat{$f}2,cat3,cat{$f}3,cat4,cat{$f}4,cat5,cat{$f}5"; break;		   
			}

			$sSQL.= ' from categories where ';
			$sSQL.= "(cat{$f}$i like ". $db->qstr('%'.strtolower($text2find).'%') . ' or ' . "cat{$f}$i like ". $db->qstr('%'.strtoupper($text2find).'%');		   
			$sSQL .= ") and ctgid>0 and active>0 and view>0 and search>0";		 	 
			$result = $db->Execute($sSQL,2);	
	   					   					   
			if ($result) {      
         
				while(!$result->EOF) {
		 
					switch ($i) {
						case 2 : $of = $result->fields['cat2']; $of2 = $result->fields["cat{$f}2"]; 
								$dp = 0;
								break;
						case 3 : $of = $result->fields['cat3']; $of2 = $result->fields["cat{$f}3"]; 
								if (($this->depthview) && ($this->depthview>=1)) 
									if ($result->fields['cat2']) 
										$group = $result->fields['cat2']; 	
								else
									$group = $result->fields['cat2']; 	
								$dp = 1;
								break;
						case 4 : $of = $result->fields['cat4']; $of2 = $result->fields["cat{$f}4"]; 
								if (($this->depthview) && ($this->depthview>=1)) {
									if ($result->fields['cat2']) 
										$group = $result->fields['cat2'];
									$group.= (($result->fields['cat3']) && ($this->depthview>=2)) ? $this->cseparator . $result->fields['cat3'] : null; 
								}
								else
									$group = $result->fields['cat2'] . $this->cseparator . $result->fields['cat3'];
								$dp = 2;	
								break;
						case 5 : $of = $result->fields['cat5']; $of2 = $result->fields["cat{$f}5"]; 
								if (($this->depthview) && ($this->depthview>=1)) {
									if ($result->fields['cat2']) 
										$group = $result->fields['cat2'];
									$group.= (($result->fields['cat3']) && ($this->depthview>=2)) ? $this->cseparator . $result->fields['cat3'] : null; 
									$group.= (($result->fields['cat4']) && ($this->depthview>=3)) ? $this->cseparator . $result->fields['cat4'] : null; 					  
								}
								else	
									$group = $result->fields['cat2'] . $this->cseparator . $result->fields['cat3'] . $this->cseparator . $result->fields['cat4'];
								$dp = 3;						
								break;		   		   		   
					}		 

					if ($of) {
						$res[$of] = $of2; 
						if ($group) $gr[$of] = $group;
						if ($dp) $dpp[$of] = $dp;

						$hostcat  = $result->fields["cat{$f}2"] ? $result->fields["cat{$f}2"].$this->bullet : null;
						$hostcat .= $result->fields["cat{$f}3"] ? $result->fields["cat{$f}3"].$this->bullet : null;
						$hostcat .= $result->fields["cat{$f}4"] ? $result->fields["cat{$f}4"].$this->bullet : null;
			 
						$hcat[] = $hostcat;		   
			 
					}
		   		   
					$result->MoveNext();

				}//while

				$data = $this->view_category($res,$viewtype,$mode,$group,$cmd,null,$gr,$dpp,$template);
   		 
				if ($data) {
					$mret[] = $data;
					$meter+=1;
				}
		 
				unset($res); unset($result); unset($exists);
			}//result   
		}//for !!!!!!
	   
		if (is_array($mret)) {
			foreach ($mret as $i=>$d)
				$ret .= $d;		 
		}	   
	   
		//table generation
		if ($ret) {
			if ($this->result_in_table) { 
				$categories = explode('<SPLIT/>',$ret); //<li> split..
				$out = $this->make_table($categories, $this->result_in_table, 'fptreetable');  	  
			}
			else
				$out = $ret;
		}
		return ($out);	   
	}
	
	//called by getCombo, getKategoryCombo without select
	protected function js_make_search_url() { //$id=null) {
		$fid = _m('cmsrt.paramload use CMS+search-id');	
	    $id_element= $fid ? $fid : 'input';
		
		$out = "function gocatsearch(url) {
	var inp = document.getElementById('$id_element').value;
	var ret = inp ? url.replace('*', inp) : url.replace('*/', '*/');
	window.location.href = ret;
}
";
      return ($out);	
	}		

	/*rewrite url ver*/
	protected function getCombo($cid,$name,$cat=null,$style="",$size=10,$multiple="",$values=null,$selection='',$cmd=null,$tmpl=null,$noselect=null) {
		$mycmd = $cmd ? $cmd : 'klist';
		$goto = $this->httpurl . '/'; 
		$selected_cat = $cat ? $cat : GetReq('cat');
		$cats = explode($this->cseparator,$selected_cat);
		
		$template = $this->select_template($tmpl);
		
		$tokens[] = null; //dummy	
			  
		if (!empty($values)) {
			$option_tokens[] = null; 
			$option_tokens[] = $name;
			$option_tokens[] = 0;
			$options[] = null;
			unset($option_tokens);		
		  
			while (list ($value, $title) = each ($values)) {
		  
				if ($selected_cat) {
					switch ($cid) {
						case 1 : $myvalue = $goto . _m("cmsrt.url use t=$mycmd&cat=$value"); break;
						case 2 : $myvalue = $goto . _m("cmsrt.url use t=$mycmd&cat=" . $cats[0] . $this->cseparator . $value); break;
						case 3 : $myvalue = $goto . _m("cmsrt.url use t=$mycmd&cat=" . $cats[0] . $this->cseparator . $cats[1] . $this->cseparator . $value); break;
						case 4 : $myvalue = $goto . _m("cmsrt.url use t=$mycmd&cat=" . $cats[0] . $this->cseparator . $cats[1] . $this->cseparator . $cats[2] . $this->cseparator .$value); break;
						case 5 : $myvalue = $goto . _m("cmsrt.url use t=$mycmd&cat=" . $cats[0] . $this->cseparator . $cats[1] . $this->cseparator . $cats[2] . $this->cseparator . $cats[3] .$this->cseparator. $value); break;
						default: $myvalue = $goto . _m("cmsrt.url use t=$mycmd&cat=" . $selected_cat . $this->cseparator . $value);
					}
				}  
				else
					$myvalue = $goto . _m("cmsrt.url use t=$mycmd&cat=$value");
			  
				$loctitle = localize($title, getlocal());
			
			    //rewrite url by adding $ as input  and 0 as page ( replace * in js )
			    $rewrite_value = str_replace($mycmd.'/', $mycmd.'/*/', $myvalue) . '0/'; 
				
				$option_tokens[] = ($noselect) ? "javascript:gocatsearch('$rewrite_value')" : $rewrite_value; 
				$option_tokens[] = $loctitle;
				$option_tokens[] = ($value == $selection ? 1 : 0);
				$options[] = $this->combine_tokens($template, $option_tokens);
				unset($option_tokens);		
			}	
	    }

        $tokens[] = (!empty($options)) ? implode('',$options) : null;
		$ret = implode('',$tokens);
		return ($ret);	
	}	
	
	protected function asksql($cat,$presel=null) {
		$db = GetGlobal('db');	
		$selcat = GetReq('cat');
		$lan = getlocal();
		$mylan = $lan ? $lan : '0';	   
  	    $f = $mylan; 		
		$mylancat = substr($cat,0,3). $f . substr($cat,-1); //echo $mylancat;
        $sSQL = "select distinct $cat,$mylancat from categories where ctgid>0 and active>0 and view>0 and search>0";

		if ($presel) 
			$sSQL .= ' and ' . $presel;
 
	    $result = $db->Execute($sSQL,2);	   	
	    if ($result) {      

			foreach($result as $i=>$rec) { 	

				$f = $this->replace_spchars($rec[0]);
				$ff = $rec[1];			   
				if ($f) 
					$data[$f] = isset($ff) ? $ff : $f; 
			}  
	
			@asort($data); 
			$mydata = $data; //$this->distinct($data);
	    }	 
	    return ($mydata);
	}		
	
	public function show_combo_results($title=null,$preselcat=null,$isleaf=null,$scmd=null) {
		$db = GetGlobal('db');	
		$cmd = $scmd ? $scmd : 'klist';
		$loctitle = localize($title,getlocal());
		$mytitle = $loctitle ? $loctitle : $this->title;
		$mytitle2 = ($isleaf) ? ($loctitle ? $loctitle : $this->title2) : $this->title2;		   
		$cat = $preselcat ? $preselcat : GetReq('cat');

		$mydata = $this->asksql('cat2');
	   
	    $ret = "<form name=\"jumpy\">";
	   
		if ($cat) {
			$mycat = explode($this->cseparator,$cat);
	     
			if (!$isleaf) //dont show main combo when leaf (last cat)
				$ret .= $this->getCombo(1,$mytitle,$cat,'myf_select',null,null,$mydata,$mycat[0],$cmd).'<br>';   	   
		 
			if ($dv = $this->depthview) {
				//echo $dv,'a';
				if (($mycat[0])&&($dv>=2)) {
				$mydata2 = $this->asksql('cat3',"cat2='$mycat[0]'");
					if (!empty($mydata2))
						$ret .= $this->getCombo(2,$mytitle2,$cat,'myf_select',null,null,$mydata2,$mycat[1],$cmd).'<br>';   	   
						if (($mycat[1])&&($dv>=3)) {
							$mydata3 = $this->asksql('cat4',"cat3='$mycat[1]' and cat2='$mycat[0]'");
						if (!empty($mydata3))
							$ret .= $this->getCombo(3,$mytitle2,$cat,'myf_select',null,null,$mydata3,$mycat[2],$cmd).'<br>'; 
						if (($mycat[2])&&($dv>=4)) {
							$mydata4 = $this->asksql('cat5',"cat4='$mycat[2]' and cat3='$mycat[1]' and cat2=$mycat[0]");
							if (!empty($mydata4))
								$ret .= $this->getCombo(4,$mytitle2,$cat,'myf_select',null,null,$mydata4,$mycat[3],$cmd); 		 		 
						}
					}
				}		    		 
			}
			else {
				if ($mycat[0]) {
					$mydata2 = $this->asksql('cat3',"cat2='$mycat[0]'");
					if (!empty($mydata2))
						$ret .= $this->getCombo(2,$mytitle2,$cat,'myf_select',null,null,$mydata2,$mycat[1],$cmd).'<br>';   	   
					if ($mycat[1]) {
						$mydata3 = $this->asksql('cat4',"cat3='$mycat[1]' and cat2='$mycat[0]'");
						if (!empty($mydata3))
							$ret .= $this->getCombo(3,$mytitle2,$cat,'myf_select',null,null,$mydata3,$mycat[2],$cmd).'<br>'; 
						if ($mycat[2]) {
							$mydata4 = $this->asksql('cat5',"cat4='$mycat[2]' and cat3='$mycat[1]' and cat2=$mycat[0]");
							if (!empty($mydata4))
								$ret .= $this->getCombo(4,$mytitle2,$cat,'myf_select',null,null,$mydata4,$mycat[3],$cmd); 		 		 
						}
					}
				}
			}//depthview
		}
		else {	   
			$ret .= $this->getCombo(1,$mytitle,$cat,'myf_select',null,null,$mydata,'',$cmd).'<br>';   
			/*$ret .= $this->getCombo(2,'b','',null,null,null,'').'<br>'; 
			$ret .= $this->getCombo(3,'c','',null,null,null,'').'<br>'; 
			$ret .= $this->getCombo(4,'d','',null,null,null,'');*/
		}
	   
		$ret .= "</form>";
	   
		return ($ret);
	}
  	
	public function getKategoryCombo($root,$name,$preselcat=null,$style="",$size=10,$multiple="",$values=null,$selection='',$cmd=null,$tmpl=null,$noselect=null) {
		$search_cmd = $cmd ? $cmd : 'klist';
		$mytitle = $name ? $name : $this->title;	   
		$cat = $preselcat ? $preselcat : GetReq('cat');
	   
		if ($root) {/*always return default main categories*/
			$mydata = $this->asksql("cat2");
			$ret = $this->getCombo(1,$mytitle,$cat,'myf_select',null,$multiple,$mydata,$mycat[0],$search_cmd,$tmpl,$noselect);   	   	
			return ($ret);
		}	   
	   
		if ($cat) {
			$mycat = explode($this->cseparator,$cat);
			foreach ($mycat as $m=>$mcat) {
				if ($m<=count(mycat))
					$mcatpresel[] = "cat".($m+2)."='". $mycat[$m]."'"; 
			}  
			$ps = (!empty($mcatpresel)) ? implode(' and ',$mcatpresel) : null;	  
		}	
	   
		$mydata = $this->asksql("cat".(count($mycat)+2), $ps);
		$ret = $this->getCombo(count($mycat)+1,$mytitle,$cat,'myf_select',null,$multiple,$mydata,$mycat[0],$search_cmd,$tmpl,$noselect);   	   	
	   
		if ($ret==null) {
			$mydata = $this->asksql("cat2");
			$ret = $this->getCombo(1,$mytitle,$cat,'myf_select',null,$multiple,$mydata,$mycat[0],$search_cmd,$tmpl,$noselect);   	   	
		}	  
		return ($ret);
	}
	
	//phpdac func
	//fetch names of categories based on proposal field (resources) - updated by rcitemrel (relatives)
	public function show_item_categories($rs, $template) {
		$db = GetGlobal('db');
		$id = GetReq('id');
		$lan = getlocal();   
	    $f = $lan ? $lan : '0';
		
		$fpath = $this->urlpath . '/' . $this->showcatimagepath;
		$tdata = $this->select_template($template); 

		if ($rs) {
			
			$rscats = explode(',',$rs);
			$sSQL = "select cat2,cat{$f}2,cat3,cat{$f}3,cat4,cat{$f}4,cat5,cat{$f}5 from categories where ctgid in (" . $rs . ")";
		    $res = $db->Execute($sSQL,2);
			
			foreach ($res as $i=>$rec) {
				$icat = array();
				if ($rec['cat2']) $icat[] = $rec['cat2'];
				if ($rec['cat3']) $icat[] = $rec['cat3'];
				if ($rec['cat4']) $icat[] = $rec['cat4'];
				if ($rec['cat5']) $icat[] = $rec['cat5'];
				$id = str_replace(' ', '_', implode($this->cseparator, $icat));
				$link = 'klist/' . $id .'/';
				$tcat = array();
				if ($rec["cat{$f}2"]) $tcat[] = $rec["cat{$f}2"];
				if ($rec["cat{$f}3"]) $tcat[] = $rec["cat{$f}3"];
				if ($rec["cat{$f}4"]) $tcat[] = $rec["cat{$f}4"];
				if ($rec["cat{$f}5"]) $tcat[] = $rec["cat{$f}5"];
				$title = implode($this->cseparator, $tcat);				
				if ($title) {
					$tokens[] = "<a href='$link'>$title</a>";
					$tokens[] = $link;	
					$tokens[] = is_readable($fpath . $id . $this->restype) ? 
					            $this->showcatimagepath . $this->encode_image_id($id) . $this->restype : null;
					$ret .= $this->combine_tokens($tdata, $tokens);
					unset($tokens);
				}	
			}			
			return ($ret);			
		}
		return false;
	}	
	
	
	//...
	protected function isCatalogNextClick() {
		//check stats (?) id is the Nnd category click 
		//if it is goto anchor list (bypass header html)
		
		return null;
	}
	
	protected function catUrl($cat=null, $action=null) {
		$t = $action ? $action : 'klist';
		if ($cat) { 
		
		    $nextList = $this->isCatalogNextClick() ? '#list' : null;
		
			$ret = ($this->aliasID) ? 
					$this->httpurl ."/$cat" . $this->aliasExt : 
					$this->httpurl . '/' . _m("cmsrt.url use t=$t&cat=$cat");
					
			$ret .= $nextList;		
		}							  
		else
			$ret = $this->httpurl . '/' . _m("cmsrt.url use t=$t");	
		
		return ($ret);
	}		
	
	protected function summarize($maxchar,$text=null) {
		if (!$text) return null;
		$mc = $maxchar ? $maxchar : $this->wordlength;
		
		if (strlen($text)>$mc) 
			$res = substr($text,0,$mc);
	    else 
			$res = $text;
		
		return ($res);
	}	

	protected function make_table($items=null, $mylinemax=null, $template=null, $pcat=null) {
	    $cat = $pcat ? $pcat : GetReq('cat'); 	
		$mytemplate = $template ? $this->select_template($template, $cat) : null;

	    if ($items[0]) {

	        $itemscount = count($items);
	        $timestoloop = floor($itemscount/$mylinemax)+1;
	        $meter = 0;
			$linetoken = null;
			$tokens = array();
			
	        for ($i=0;$i<$timestoloop;$i++) {

				for ($j=0;$j<$mylinemax;$j++) {
					$linetoken .= $items[$meter];
					$meter+=1;	 
				}
				$tokens[] = $linetoken; 
                $toprint .= $this->combine_tokens($mytemplate, $tokens);					
				$linetoken = null; 
				$tokens = array();
  
	        }
		}	
        return ($toprint); 		
    }
	
	protected function replace_spchars($string, $reverse=false) {
		
		switch ($this->replacepolicy) {	
			case '_' : 	$ret = $reverse ?  str_replace('_',' ',$string) : str_replace(' ','_',$string); break;
			case '-' :	 $ret = $reverse ?  str_replace('-',' ',$string) : str_replace(' ','-',$string);break;
			default  :
						if ($reverse) {
							$g1 = array("'",'"','+','/',' ',' & ');
							$g2 = array('_',"*","plus",":",'-',' n ');		  
							$ret = str_replace($g2,$g1,$string);
						}	 
						else {
							$g1 = array("'",'"','+','/',' ','-&-');
							$g2 = array('_',"*","plus",":",'-','-n-');		  
							$ret = str_replace($g1,$g2,$string);
						}	
		}
		return ($ret);
	}
	

	/*cat based template */
	public function select_template($tfile=null, $cat=null) {
		if (!$tfile) return;
	  
		if ($cat) {
			$pcats = explode($this->cseparator,$cat);
			foreach ($pcats as $c) {
				if ($mytemplate = _m('cmsrt.select_template use ' . $c.'@'. str_replace('.htm', '', $tfile))) 
					return ($mytemplate); 
			}
		} 
		$mytemplate = _m('cmsrt.select_template use ' . str_replace('.htm', '', $tfile));
		return ($mytemplate);	 
    }		
	
	//tokens method	
	protected function combine_tokens(&$template_contents, $tokens, $execafter=null) {
	
	    if (!is_array($tokens)) return;
		
		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
		  $fp = new fronthtmlpage(null);
		  $ret = $fp->process_commands($template_contents);
		  unset ($fp);		  		
		}		  		
		else
		  $ret = $template_contents;
		  
	    foreach ($tokens as $i=>$tok) {
		    $ret = str_replace("$".$i."$",$tok,$ret);
	    }
		//clean unused token marks
		for ($x=$i;$x<40;$x++)
		  $ret = str_replace("$".$x."$",'',$ret);
		
		if (($execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
		  $fp = new fronthtmlpage(null);
		  $retout = $fp->process_commands($ret);
		  unset ($fp);
          
		  return ($retout);
		}		
		
		return ($ret);
	}
	
	//n tokens method
	protected function combine_n_tokens(&$template_contents, $tokens, $tokens2=null) {
	    if (!is_array($tokens)) return;
		
		if (defined('FRONTHTMLPAGE_DPC')) {
		  $fp = new fronthtmlpage(null);
		  $ret = $fp->process_commands($template_contents);
		  unset ($fp);		  		
		}		  		
		else
		  $ret = $template_contents;
		  
	    foreach ($tokens as $i=>$tok) {
			$n = str_replace('$N$',$tok,$ret);
			if (is_array($tokens2[$i])) {//mix combination
			   $nret .= $this->combine_tokens($n, $tokens2[$i]);
			}
			else
		      $nret .= $n;
	    }
		return ($nret);
	} 	
};
}
?>