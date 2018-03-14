<?php
$__DPCSEC['RCCMSTEMPLATES_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCCMSTEMPLATES_DPC")) && (seclevel('RCCMSTEMPLATES_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCCMSTEMPLATES_DPC",true);

$__DPC['RCCMSTEMPLATES_DPC'] = 'rccmstemplates';

$__EVENTS['RCCMSTEMPLATES_DPC'][0]='cpcmstemplates';
$__EVENTS['RCCMSTEMPLATES_DPC'][1]='cpcmsfshow';
$__EVENTS['RCCMSTEMPLATES_DPC'][2]='cpcmsshowform';
$__EVENTS['RCCMSTEMPLATES_DPC'][3]='cpcmsformdetail';
$__EVENTS['RCCMSTEMPLATES_DPC'][4]='cpcmsformdata';
$__EVENTS['RCCMSTEMPLATES_DPC'][5]='cpcmsformsubdetail';

$__ACTIONS['RCCMSTEMPLATES_DPC'][0]='cpcmstemplates';
$__ACTIONS['RCCMSTEMPLATES_DPC'][1]='cpcmsfshow';
$__ACTIONS['RCCMSTEMPLATES_DPC'][2]='cpcmsshowform';
$__ACTIONS['RCCMSTEMPLATES_DPC'][3]='cpcmsformdetail';
$__ACTIONS['RCCMSTEMPLATES_DPC'][4]='cpcmsformdata';
$__ACTIONS['RCCMSTEMPLATES_DPC'][5]='cpcmsformsubdetail';

$__LOCALE['RCCMSTEMPLATES_DPC'][0]='RCCMSTEMPLATES_DPC;Templates;Templates';
$__LOCALE['RCCMSTEMPLATES_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['RCCMSTEMPLATES_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['RCCMSTEMPLATES_DPC'][3]='_templates;Templates;Templates';
$__LOCALE['RCCMSTEMPLATES_DPC'][4]='_owner;Owner;Καταχώρητης';
$__LOCALE['RCCMSTEMPLATES_DPC'][5]='_active;Active;Ενεργό';
$__LOCALE['RCCMSTEMPLATES_DPC'][6]='_title;Title;Τίτλος';
$__LOCALE['RCCMSTEMPLATES_DPC'][7]='_descr;Description;Περιγραφή';
$__LOCALE['RCCMSTEMPLATES_DPC'][8]='_cat;Category;Κατηγορία';
$__LOCALE['RCCMSTEMPLATES_DPC'][9]='_class;Class;Κλάση';
$__LOCALE['RCCMSTEMPLATES_DPC'][10]='_code;Code;Κωδικός';
$__LOCALE['RCCMSTEMPLATES_DPC'][11]='_webpages;Web pages;Ιστοσελίδες';
$__LOCALE['RCCMSTEMPLATES_DPC'][12]='_catalogs;Catalogs;Κατάλογοι';
$__LOCALE['RCCMSTEMPLATES_DPC'][13]='_landpages;Landing pages;Landing pages';
$__LOCALE['RCCMSTEMPLATES_DPC'][14]='_cat0;Category 1;Κατηγορία 1';
$__LOCALE['RCCMSTEMPLATES_DPC'][15]='_cat1;Category 2;Κατηγορία 2';
$__LOCALE['RCCMSTEMPLATES_DPC'][16]='_cat2;Category 3;Κατηγορία 3';
$__LOCALE['RCCMSTEMPLATES_DPC'][17]='_cat3;Category 4;Κατηγορία 4';
$__LOCALE['RCCMSTEMPLATES_DPC'][18]='_cat4;Category 5;Κατηγορία 5';


class rccmstemplates {
	
    var $title, $path, $urlpath;
	var $seclevid, $userDemoIds;
	var $ckeditver, $url;	
	var $appname, $urkRedir, $isHostedApp; 
	
	function __construct() {

		$this->path = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		$this->url = paramload('SHELL','urlbase');
		$this->title = localize('RCCMSTEMPLATES_DPC',getlocal());	 
	  
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
		$this->userDemoIds = array(5,6,7,8); 		  
		
		$this->ckeditver = 3;
		
		$this->appname = paramload('ID','instancename');
		$this->urlRedir = remote_paramload('RCBULKMAIL','urlredir', $this->path);
		$this->isHostedApp = remote_paramload('RCBULKMAIL','hostedapp', $this->path);		
	}

    function event($event=null) {
	
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;		 
	
		switch ($event) {
			case 'cpcmsformsubdetail': break;				
			
			case 'cpcmsformdata': echo $this->loadsubframe();
		                          die();
		                          break;
							   
			case 'cpcmsformdetail':
			                      break;		
			case 'cpcmsshowform': break;
			case 'cpcmsfshow'   : echo $this->loadframe();
		                          die();
							      break;
			case 'cpcmstemplates':
			default             :    
		                      
		}
			
    }   
	
    function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	
	 
		switch ($action) {	
			case 'cpcmsformsubdetail': $out = $this->showFormDetail(); 
			                           break;		
		
		    case 'cpcmsformdata': break;
			
			case 'cpcmsformdetail': 
			                      break;
			case 'cpcmsshowform': $out = $this->show(); 
			                      break;	
			case 'cpcmsfshow'   : break;
			case 'cpcmstemplates':
			default             : $out = $this->cmsTemplatesMode();
		}	 

		return ($out);
    }
	
	protected function cmsTemplatesMode() {
		$mode = GetReq('mode') ? GetReq('mode') : 'templates';
        
		$turl0 = seturl('t=cpcmstemplates&mode=landpages');		
		$turl1 = seturl('t=cpcmstemplates&mode=catalogs');
		$turl2 = seturl('t=cpcmstemplates&mode=webpages');
		$button = $this->createButton(localize('_templates', getlocal()), 
										array(localize('_landpages', getlocal())=>$turl0,
										      localize('_catalogs', getlocal())=>$turl1,
											  localize('_webpages', getlocal())=>$turl2,
		                                ),'success');		
																	
		switch ($mode) {
			
			case 'landpages':
			case 'webpages' :
			case 'catalogs' :
			case 'templates':   
			default         :   $content = $this->templates_grid(null,140,5,'d', true); 
		}			
					
		$ret = $this->window('e-CMS: '.localize('_'.$mode, getlocal()), $button, $content);
		
		return ($ret);
	}	
	
	protected function loadframe($ajaxdiv=null, $mode=null) {
		$id = GetParam('id');
		$cmd = 'cpcmsshowform&id='.$id ;//$mode not used
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
		
		if ($module=='formtest') {
			_m("crmrt.renderTemplate use ". $id . "++_test.php");
			if (is_readable($this->urlpath . '/_test.php')) {
				$frame = "<iframe src =\"{$this->url}/_test.php\" width=\"100%\" height=\"460px\"><p>Your browser does not support iframes</p></iframe>";    
				return ($frame);
			}
		}
		else
			@unlink($this->urlpath . '/_test.php'); //erase test file
		
		if ($init)
			$bodyurl = seturl("t=cpcmsformdetail&iframe=1&id=$id&module=$module");
		else
			$bodyurl = seturl("t=cpcmsformsubdetail&iframe=1&id=$id&module=$module");
	
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
			case 'formitems'  : $ret = $this->items_grid(null,360,15,'r', true); 
			                    break; 
			case 'formscript' : break; //see loadsubframe
			case 'formrender' : $ret = _m("crmrt.renderTemplate use ". $formid); 
			                    die($ret);
			case 'formcode'   :
			case 'formhtml'   :
			case 'formscript' :
			default           :
		}
		
		return ($ret);
	}
	
	protected function fetchField($id=null, $field=null) {
		if ((!$id) || (!$field)) return null;
		
		$db = GetGlobal('db');
		$sSQL = "select $field from cmstemplates where id=".$id;
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		return $res->fields[0];
	}
	
	protected function saveFormData($id, $data=null) {
		if (!$id) return null;
		
		$db = GetGlobal('db');
		$sSQL = "update cmstemplates set data=" . $db->qstr($data);
		$sSQL.= " where id=" . $id;
		$res = $db->Execute($sSQL);
		return true;
	}	
	
	public function fetchFormData() {
		$id = GetParam('id');
		
		if ($_POST['id'])
			$ret = $this->saveFormData($id, base64_encode($_POST['formdata']));
		
		return base64_decode($this->fetchField($id, 'data'));
	}
	
	protected function saveCodeData($id, $data=null) {
		if (!$id) return null;
		
		$db = GetGlobal('db');
		$sSQL = "update cmstemplates set code=" . $db->qstr($data);
		$sSQL.= " where id=" . $id;
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		return true;
	}		
	
	public function fetchCodeData() {
		$id = GetParam('id');
		
		if ($_POST['id'])
			$ret = $this->saveCodeData($id, base64_encode($_POST['codedata']));
		
		return base64_decode($this->fetchField($id, 'code'));
	}	
	
	protected function saveScriptData($id, $data=null) {
		if (!$id) return null;
		
		$db = GetGlobal('db');
		$sSQL = "update cmstemplates set script=" . $db->qstr($data);
		$sSQL.= " where id=" . $id;
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		return true;
	}		
	
	public function fetchScriptData() {
		$id = GetParam('id');
		
		if ($_POST['id'])
			$ret = $this->saveScriptData($id, base64_encode($_POST['scriptdata']));
		
		return base64_decode($this->fetchField($id, 'script'));
	}	
	
	protected function templates_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_templates', getlocal()); 
		
        $xsSQL = "SELECT * from (select id,active,date,name,descr,class,type from cmstemplates) o ";		   
		   							
		_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|");//"|link|5|"."javascript:editform(\"{id}\");".'||');			
		_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|boolean|1|");		
		_m("mygrid.column use grid1+date|".localize('_date',getlocal())."|link|5|"."javascript:editform(\"{id}\");".'||'); //"|5|0|");			
		_m("mygrid.column use grid1+name|".localize('_title',getlocal())."|10|1|");
		_m("mygrid.column use grid1+descr|".localize('_descr',getlocal())."|19|1|");
		_m("mygrid.column use grid1+class|".localize('_class',getlocal())."|5|1|");
		_m("mygrid.column use grid1+type|".localize('_type',getlocal())."|5|1|");

		$out = _m("mygrid.grid use grid1+cmstemplates+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
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
							<hr/><div id="cmsform"></div>
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
		$treeTitle = $this->fetchField(GetReq('id'), 'name');

		$ret = '	
                            <ul id="tree_2" class="tree">
                                <li>
                                    <a data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle" data-role="branch" href="#">'.substr($treeTitle, 0, 9).'</a>
                                    <ul class="branch in">
										<li><a data-role="leaf" href="javascript:subdetails(\'formhtml'.$id.'\')"><i class="icon-user"></i> Html</a></li>
                                        <li><a data-role="leaf" href="javascript:subdetails(\'formcode'.$id.'\')"><i class=" icon-book"></i> Code</a></li>
										<li><a data-role="leaf" href="javascript:subdetails(\'formscript'.$id.'\')"><i class=" icon-book"></i> Script</a></li>
										<li><a data-role="leaf" href="javascript:subdetails(\'formitems'.$id.'\')"><i class=" icon-book"></i> Items</a></li>
                                        <li><a data-role="leaf" href="javascript:subdetails(\'formrender'.$id.'\')"><i class="icon-share"></i> View</a></li>											
										<li><a data-role="leaf" href="javascript:subdetails(\'formtest'.$id.'\')"><i class="icon-share"></i> Test</a></li>
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
		
		$sSQL = "select type from cmstemplates where id=$id";
		$res = $db->Execute($sSQL);
		
		return ($res->fields[0]);	
	}
	
	protected function getTemplateItems($id=null) {
		$db = GetGlobal('db');		
		if (!$id) return null;			
		$objSQL = "select objects from cmstemplates WHERE id=" . $db->qstr($id);
		
		$oret = $db->Execute($objSQL);
		return ($oret->fields[0]);			
	}		
	
	protected function items_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_items',getlocal());
	
	    if (defined('MYGRID_DPC')) {
			
			$ilist = $this->getTemplateItems($selected);
			if (!empty($ilist)) {
				$dSQL = " id in (". $ilist . ")";
			}	
			else
				$dSQL = ' code5=0'; //dummy, null grid			
			
			$xsSQL2 = "SELECT * FROM (SELECT id,datein,code5,itmactive,active,itmname,sysins,cat0,cat1,cat2,cat3,cat4 FROM products WHERE $dSQL) x";
			//echo $xsSQL2;
			_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|0|||1");
			_m("mygrid.column use grid1+datein|".localize('_date',getlocal()). "|5|0|");
			_m("mygrid.column use grid1+code5|".localize('_code',getlocal())."|link|4|"."javascript:showdetails(\"{code5}~$selected\");".'||');
		    _m("mygrid.column use grid1+itmactive|".localize('_active',getlocal())."|2|0|");		
			_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|2|0|");
			_m("mygrid.column use grid1+sysins|".localize('_date',getlocal())."|5|0|");			
			_m("mygrid.column use grid1+itmname|".localize('_title',getlocal())."|10|0|");	
			_m("mygrid.column use grid1+cat0|".localize('_cat0',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat1|".localize('_cat1',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat2|".localize('_cat2',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat3|".localize('_cat3',getlocal())."|5|0|");	
			_m("mygrid.column use grid1+cat4|".localize('_cat4',getlocal())."|5|0|");	
			$ret .= _m("mygrid.grid use grid1+products+$xsSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	
	
};
}
?>