<?php
$__DPCSEC['RCCRMFORMS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCCRMFORMS_DPC")) && (seclevel('RCCRMFORMS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCCRMFORMS_DPC",true);

$__DPC['RCCRMFORMS_DPC'] = 'rccrmforms';

$__EVENTS['RCCRMFORMS_DPC'][0]='cpcrmforms';
$__EVENTS['RCCRMFORMS_DPC'][1]='cpcrmfshow';
$__EVENTS['RCCRMFORMS_DPC'][2]='cpcrmshowform';
$__EVENTS['RCCRMFORMS_DPC'][3]='cpcrmformdetail';
$__EVENTS['RCCRMFORMS_DPC'][4]='cpcrmformdata';
$__EVENTS['RCCRMFORMS_DPC'][5]='cpcrmformsubdetail';

$__ACTIONS['RCCRMFORMS_DPC'][0]='cpcrmforms';
$__ACTIONS['RCCRMFORMS_DPC'][1]='cpcrmfshow';
$__ACTIONS['RCCRMFORMS_DPC'][2]='cpcrmshowform';
$__ACTIONS['RCCRMFORMS_DPC'][3]='cpcrmformdetail';
$__ACTIONS['RCCRMFORMS_DPC'][4]='cpcrmformdata';
$__ACTIONS['RCCRMFORMS_DPC'][5]='cpcrmformsubdetail';

$__LOCALE['RCCRMFORMS_DPC'][0]='RCCRMFORMS_DPC;Crm forms;Crm forms';
$__LOCALE['RCCRMFORMS_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['RCCRMFORMS_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['RCCRMFORMS_DPC'][3]='_forms;Forms;Φόρμες';
$__LOCALE['RCCRMFORMS_DPC'][4]='_owner;Owner;Καταχώρητης';
$__LOCALE['RCCRMFORMS_DPC'][5]='_active;Active;Ενεργό';
$__LOCALE['RCCRMFORMS_DPC'][6]='_title;Title;Τίτλος';
$__LOCALE['RCCRMFORMS_DPC'][7]='_descr;Description;Περιγραφή';
$__LOCALE['RCCRMFORMS_DPC'][8]='_cat;Category;Κατηγορία';
$__LOCALE['RCCRMFORMS_DPC'][9]='_class;Class;Κλάση';
$__LOCALE['RCCRMFORMS_DPC'][10]='_code;Code;Κωδικός';
$__LOCALE['RCCRMFORMS_DPC'][11]='_messages;Messages;Μηνύματα';
$__LOCALE['RCCRMFORMS_DPC'][12]='_offers;Offers;Προσφορές';


class rccrmforms {
	
    var $title, $path, $urlpath;
	var $seclevid, $userDemoIds;
	var $crmplus, $ckeditver;	
	var $appname, $urkRedir, $isHostedApp; 
	
	function __construct() {

		$this->path = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		$this->title = localize('RCCRMFORMS_DPC',getlocal());	 
	  
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
		$this->userDemoIds = array(5,6,7,8); 		  
		
		$this->crmplus = false;	
		$this->ckeditver = 3;
		
		$this->appname = paramload('ID','instancename');
		$this->urlRedir = remote_paramload('RCBULKMAIL','urlredir', $this->path);
		$this->isHostedApp = remote_paramload('RCBULKMAIL','hostedapp', $this->path);		
	}

    function event($event=null) {
	
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;		 
	
		switch ($event) {
			case 'cpcrmformsubdetail': break;				
			
			case 'cpcrmformdata': echo $this->loadsubframe();
		                          die();
		                          break;
							   
			case 'cpcrmformdetail':
			                      break;		
			case 'cpcrmshowform': break;
			case 'cpcrmfshow'   : echo $this->loadframe();
		                          die();
							      break;
			case 'cpcrmforms'   :
			default             :    
		                      
		}
			
    }   
	
    function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	
	 
		switch ($action) {	
			case 'cpcrmformsubdetail': $out = $this->showFormDetail(); 
			                           break;		
		
		    case 'cpcrmformdata': break;
			
			case 'cpcrmformdetail': 
			                      break;
			case 'cpcrmshowform': $out = $this->show(); 
			                      break;	
			case 'cpcrmfshow'   : break;
			case 'cpcrmforms'   :
			default             : $out = $this->crmFormsMode();
		}	 

		return ($out);
    }
	
	protected function crmFormsMode() {
		$mode = GetReq('mode') ? GetReq('mode') : 'forms';
        
		$turl0 = seturl('t=cpcrmforms&mode=messages');		
		$turl1 = seturl('t=cpcrmforms&mode=offers');
		$button = $this->createButton(localize('_forms', getlocal()), 
										array(localize('_messages', getlocal())=>$turl0,
										      localize('_offers', getlocal())=>$turl1,
		                                ),'success');		
																	
		switch ($mode) {
			
			case 'messages' :
			case 'offers'   :
			case 'forms'    :   
			default         :   $content = $this->forms_grid(null,140,5,'d', true); 
		}			
					
		$ret = $this->window('e-CRM: '.localize('_'.$mode, getlocal()), $button, $content);
		
		return ($ret);
	}	
	
	protected function loadframe($ajaxdiv=null, $mode=null) {
		$id = GetParam('id');
		$cmd = 'cpcrmshowform&id='.$id ;//$mode not used
		$bodyurl = seturl("t=$cmd&iframe=1");
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"460px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}
	
	protected function loadsubframe($ajaxdiv=null, $module=null, $init=false) {
		$module = $module ? $module : GetParam('module'); //module details
		$id = GetParam('id'); //form id
		
		if ($init)
			$bodyurl = seturl("t=cpcrmformdetail&iframe=1&id=$id&module=$module");
		else
			$bodyurl = seturl("t=cpcrmformsubdetail&iframe=1&id=$id&module=$module");
	
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"460px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}	

	protected function show() {
		$id = GetReq('id');
		$title = 'ID:' . $id; 
		$ret = null; //$title; //test
		
		$ret = $this->loadsubframe(null,'formhtml', true);
		
		return ($ret);
	}	
	
	protected function showFormDetail() {
		$module = GetReq('module');
		$formid = GetReq('id');
		
		switch ($module) {
			case 'formrender' : $ret = $this->renderForm($formid);
			                    die($ret);
			case 'formcode'   :
			case 'formhtml'   :
			default           :
		}
		
		return ($ret);
	}
	
	protected function fetchField($id=null, $field=null) {
		if ((!$id) || (!$field)) return null;
		
		$db = GetGlobal('db');
		$sSQL = "select $field from crmforms where id=".$id;
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		return $res->fields[0];
	}
	
	protected function saveFormData($id, $data=null) {
		if (!$id) return null;
		
		$db = GetGlobal('db');
		$sSQL = "update crmforms set formdata=" . $db->qstr($data);
		$sSQL.= " where id=" . $id;
		$res = $db->Execute($sSQL);
		return $res->fields[0];
	}	
	
	public function fetchFormData() {
		$id = GetParam('id');
		
		if ($_POST['id'])
			$ret = $this->saveFormData($id, base64_encode(trim($_POST['formdata'])));
		
		return base64_decode($this->fetchField($id, 'formdata'));
	}
	
	protected function saveCodeData($id, $data=null) {
		if (!$id) return null;
		
		$db = GetGlobal('db');
		$sSQL = "update crmforms set codedata=" . $db->qstr($data);
		$sSQL.= " where id=" . $id;
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		return $res->fields[0];
	}		
	
	public function fetchCodeData() {
		$id = GetParam('id');
		
		if ($_POST['id'])
			$ret = $this->saveCodeData($id, base64_encode(trim($_POST['codedata'])));
		
		return base64_decode($this->fetchField($id, 'codedata'));
	}	
	
	protected function forms_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_forms', getlocal()); 
		
        $xsSQL = "SELECT * from (select id,active,date,title,descr,code,class,type from crmforms) o ";		   
		   							
		_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|");//"|link|5|"."javascript:editform(\"{id}\");".'||');			
		_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|boolean|1|");		
		_m("mygrid.column use grid1+date|".localize('_date',getlocal())."|link|5|"."javascript:editform(\"{id}\");".'||'); //"|5|0|");		
		_m("mygrid.column use grid1+code|".localize('_code',getlocal())."|5|1|");		
		_m("mygrid.column use grid1+title|".localize('_title',getlocal())."|10|1|");
		_m("mygrid.column use grid1+descr|".localize('_descr',getlocal())."|19|1|");
		_m("mygrid.column use grid1+class|".localize('_class',getlocal())."|5|1|");
		_m("mygrid.column use grid1+type|".localize('_type',getlocal())."|5|1|");

		$out = _m("mygrid.grid use grid1+crmforms+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
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
							<hr/><div id="crmform"></div>
							</div>
							'.  $content .'
                        </div>
                  </div>
                </div>
            </div>
';
		return ($ret);
	}	
	
	public function formsTree() {
		if (!GetReq('id')) return false;		
		
		$id = "&id=" . GetReq('id');
		$treeTitle = $this->fetchField(GetReq('id'), 'code');
		/*
		$this->crmplus = (defined('CRMPLUS_DPC')) ? true : false;		
		$crmplustree = $this->crmplus ? '
										<li>
											<a data-value="gh_Repos" data-toggle="branch" class="tree-toggle closed" role="branch" href="#">Plus</a>
                                            <ul class="branch">
											<li><a href="#">Actions</a></li>
                                            <li><a href="javascript:subdetails(\'plus'.$id.'\')">Projects</a></li>
                                            <li>
                                                <a data-value="GitHub_Repos" data-toggle="branch" class="tree-toggle closed" role="branch" href="#">Automations</a>
                                                <ul class="branch">
                                                    <li><a href="#">Events</a></li>
                                                    <li><a href="#">Users</a></li>
                                                    <li><a href="#">Feedbacks</a></li>
                                                    <li><a href="#">Reports</a></li>
                                                    <li><a href="#">Sales</a></li>
                                                    <li><a href="#">Revenue</a></li>
                                                </ul>
                                            </li></ul>
                                        </li>' : null;		
		*/
		$ret = '	
                            <ul id="tree_2" class="tree">
                                <li>
                                    <a data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle" data-role="branch" href="#">'.substr($treeTitle, 0, 9).'</a>
                                    <ul class="branch in">
										<li><a data-role="leaf" href="javascript:subdetails(\'formhtml'.$id.'\')"><i class="icon-user"></i> Html</a></li>
                                        <li><a data-role="leaf" href="javascript:subdetails(\'formcode'.$id.'\')"><i class=" icon-book"></i> Code</a></li>
                                        <li><a data-role="leaf" href="javascript:subdetails(\'formrender'.$id.'\')"><i class="icon-share"></i> View</a></li>										
                                        <!--li><a data-role="leaf" href="javascript:subdetails(\'customers'.$id.'\')"><i class=" icon-bullhorn"></i> Customers</a></li>
                                        <li><a data-role="leaf" href="javascript:subdetails(\'items'.$id.'\')"><i class="icon-tasks"></i> Items</a></li>
										<li><a data-role="leaf" href="javascript:subdetails(\'tasks'.$id.'\')"><i class="icon-share"></i> Tasks</a></li-->
											
										'.$crmplustree.'												
                                    </ul>
                                </li>
                            </ul>		
';
		return ($ret);
	}
		
    public function ckeditorjs($element=null, $maxmininit=false, $disable=false) {
		//CKEDITOR.config.basicEntities = false;
		//CKEDITOR.config.htmlEncodeOutput = false;	
	    //...		
		//ckeditor attributes depend on template edit new / mail text
		//$readonly = (($_GET['t']=='cptemplatenew')||($_GET['t']=='cptemplatesav')) ? 0 : 1;  
		$readonly = $disable ? 1 : 0;  
	
        //$element_name = (($_GET['t']=='cptemplatenew')||($_GET['t']=='cptemplatesav')) ? 'template_text' : 'mail_text';	
		$element_name = $element; // ? $element : ((($_GET['t']=='cptemplatenew')||($_GET['t']=='cptemplatesav')) ? 'template_text' : 'mail_text');
		
		//minmax only when select for new/edit not when select for mail sent
		//$minmax = (($_GET['t']=='cptemplatenew')||($_GET['t']=='cptemplatesav')) ? ($_GET['stemplate'] ? 'maximize' : 'minimize') : 'minimize' ;
		$minmax = $maxmininit ? $maxmininit : ($_GET['stemplate'] ? 'maximize' : 'minimize') ;
		//echo $minmax;	
		
		$ftype = $this->getFormType(GetReq('id'));
		$fullpage = ($ftype>1) ? 'false' : 'true'; //'true'; //when type=1 = html contents else partial content
		
	    $ckattr = ($this->ckeditver==4) ?
	           "fullpage : $fullpage,"	  
	           : 
	           "skin : 'v2', 
			   fullpage : $fullpage, 
			   extraPlugins :'docprops',";		
		
		$ret = "
			<script type='text/javascript'>
	           CKEDITOR.replace('$element_name',
			   {
				$ckattr	
				filebrowserBrowseUrl : '/cp/ckfinder/ckfinder.html',
	            filebrowserImageBrowseUrl : '/cp/ckfinder/ckfinder.html?type=Images',
	            filebrowserFlashBrowseUrl : '/cp/ckfinder/ckfinder.html?type=Flash',
	            filebrowserUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	            filebrowserImageUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	            filebrowserFlashUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
	            filebrowserWindowWidth : '1000',
 	            filebrowserWindowHeight : '700'				
			   }		   
			   );
			   CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
			   CKEDITOR.config.forcePasteAsPlainText = true; // default so content won't be manipulated on load
			   CKEDITOR.config.fullPage = $fullpage;
               CKEDITOR.config.entities = false;
			   CKEDITOR.config.basicEntities = false;
			   CKEDITOR.config.entities_greek = false;
			   CKEDITOR.config.entities_latin = false;
			   CKEDITOR.config.entities_additional = '';
			   CKEDITOR.config.htmlEncodeOutput = false;
			   CKEDITOR.config.entities_processNumerical = false;
			   CKEDITOR.config.fillEmptyBlocks = function (element) {
				return true; // DON'T DO ANYTHING!!!!!
               };
			   CKEDITOR.config.allowedContent = true; // don't filter my data	
			   CKEDITOR.config.protectedSource.push( /<phpdac[\s\S]*?\/phpdac>/g );
			   CKEDITOR.on('instanceReady',
               function( evt )
               {
                  var editor = evt.editor;
                  editor.execCommand('$minmax');
				  editor.setReadOnly($readonly);
               });			   
		    </script>		
";
		//     CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
		return ($ret);
	}

	public function encUrl($url, $nohost=false) {
		if ($url) {
			
			if (($this->isHostedApp)&&($nohost==false)) {
				$burl = explode('/', $url);
				array_shift($burl); //shift http
				array_shift($burl); //shift //
				array_shift($burl); //www //
				$xurl = implode('/',$burl);
				$qry = 't=mt&a='.$this->appname.'_AMP_u=' . $xurl . '_AMP_cid=_CID_' . '_AMP_r=_TRACK_'; //CKEditor &amp; issue				
			}
			else {
				//$xurl = $url; //as is
				$qry = 't=mt&u=' . $url . '_AMP_cid=_CID_' . '_AMP_r=_TRACK_'; //CKEditor &amp; issue				
			}	
			
			$uredir = $this->urlRedir .'?'. $qry; //'?turl=' . $encoded_qry;
			return ($uredir); 
		}
		else
			return ('#');
	}
	
	public function getFormType($id=null) {
		$db = GetGlobal('db');		
		if (!$id) return null;	
		
		$sSQL = "select type from crmforms where id=$id";
		$res = $db->Execute($sSQL);
		
		return ($res->fields[0]);	
	}	
	
	public function renderForm($id=null) {
		$db = GetGlobal('db');		
		if (!$id) return null;
		//$template = GetReq('stemplate');		
		$sSQL = "select id,title,descr,formdata,codedata from crmforms where id=$id";// . $db->qstr($template);
		//echo $sSQL;
		$res = $db->Execute($sSQL);			
		$form = base64_decode($res->fields['formdata']);		
		$code = base64_decode($res->fields['codedata']);
		$template = $res->fields['title'];
		
		if ($code)  {
			$pf = explode('>|',$code);
			//search last edited line
			foreach ($pf as $line) {
				if (trim($line)) {
					$joins = explode(',', array_pop($pf)); 
					break;
				}
			}
			//rest lines
			foreach ($pf as $line) {
				$subtemplates .= trim($line);
			}
			$_pattern[0] = explode(',', $subtemplates);
			$_pattern[1] = (array) $joins;
			//print_r($_pattern);
			//return ($_pattern);
			
			//render pattern
			if (is_array($_pattern)) {
				$pattern = (array) $_pattern[0];
				$join = (array) $_pattern[1];				
				
				//make pseudo-items arrray
				$maxitm = count($pattern); 
				//echo count($pattern) . '>';
				for($i=1;$i<=$maxitm;$i++)
					$items[] = array(0=>$i, 1=>'test item title'.$i, 2=>'test decr'.$i, 14=>'http://placehold.it/680x300');
				//print_r($items);
				
				//render
				$out = null;
				$tts = array();
				$gr = array();
				$itms = array();
				$cc = array_chunk($items, count($pattern));//, true);

				foreach ($cc as $i=>$group) {
					//print_r($group);
					foreach ($group as $j=>$child) {
						//echo $pattern[$j] . '<br>';// . print_r($child, true) . '<br>';
						$tts[] = $this->ct($pattern[$j], $child, true);
						if ($cmd = trim($join[$j])) {
							//echo $j . '>' . $join[$j] . '!<br>';
							switch ($cmd) {
							    case '_break' : $out .= implode('', $tts); break;
								default       : $out .= $this->ct($cmd, $tts, true); 
								                //echo $j; print_r($tts);
							} 
							unset($tts);
						}
					}
					
					$gr[] = (empty($tts)) ? $out : $out . implode('', $tts) ;
					unset($tts);
					$out = null;
				}
			}//has pattern data
		}//has pattern
		
		$sSQL = "select formdata from crmforms where title=" . $db->qstr($template.'-sub');
		$res = $db->Execute($sSQL);
		//echo $sSQL;	
		if (isset($res->fields['formdata'])) {		
			$itms[] = (!empty($gr)) ? implode('',$gr) : null;  

			if (!empty($itms))			
			    $ret = $this->combine_tokens(base64_decode($res->fields['formdata']), $itms, true);
		}	
		else
			$ret = (!empty($gr)) ? implode('',$gr) : null;
		
		//echo $template.'-sub:' . $ret;				
		$data = ($ret) ? str_replace('<!--?'.$template.'-sub'.'?-->', $ret, $form) : $form;
		
		return $data;
	}		

    //combine tokens with load tmpl data inside	
	public function ct($template, $tokens, $execafter=null) {
	    //if (!is_array($tokens)) return;
		$db = GetGlobal('db');

		//type 2 sub template data into html/body text
		$sSQL = "select formdata from crmforms where type=2 and title=" . $db->qstr($template);
		$res = $db->Execute($sSQL);			
		$template_contents = base64_decode($res->fields['formdata']);		
		
		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
		  $fp = new fronthtmlpage(null);
		  $ret = $fp->process_commands($template_contents);
		  unset ($fp);		  		
		}		  		
		else
		  $ret = $template_contents; 
		  
		//echo $ret;
	    foreach ($tokens as $i=>$tok) {
		    $ret = str_replace("$".$i."$",$tok,$ret);
	    }
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