<?php
$__DPCSEC['RCCMSHTML_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCCMSHTML_DPC")) && (seclevel('RCCMSHTML_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCCMSHTML_DPC",true);

$__DPC['RCCMSHTML_DPC'] = 'rccmshtml';

$__EVENTS['RCCMSHTML_DPC'][0]='cpcmshtml';
$__EVENTS['RCCMSHTML_DPC'][1]='cpcmsfshow';
$__EVENTS['RCCMSHTML_DPC'][2]='cpcmsformshow';
$__EVENTS['RCCMSHTML_DPC'][3]='cpcmshtmlsave';

$__ACTIONS['RCCMSHTML_DPC'][0]='cpcmshtml';
$__ACTIONS['RCCMSHTML_DPC'][1]='cpcmsfshow';
$__ACTIONS['RCCMSHTML_DPC'][2]='cpcmsformshow';
$__ACTIONS['RCCMSHTML_DPC'][3]='cpcmshtmlsave';

$__LOCALE['RCCMSHTML_DPC'][0]='RCCMSHTML_DPC;Html Templates;Html Templates';
$__LOCALE['RCCMSHTML_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['RCCMSHTML_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['RCCMSHTML_DPC'][3]='_forms;Forms;Φόρμες';
$__LOCALE['RCCMSHTML_DPC'][4]='_owner;Owner;Καταχώρητης';
$__LOCALE['RCCMSHTML_DPC'][5]='_active;Active;Ενεργό';
$__LOCALE['RCCMSHTML_DPC'][6]='_title;Title;Τίτλος';
$__LOCALE['RCCMSHTML_DPC'][7]='_descr;Description;Περιγραφή';
$__LOCALE['RCCMSHTML_DPC'][8]='_cat;Category;Κατηγορία';
$__LOCALE['RCCMSHTML_DPC'][9]='_class;Class;Κλάση';
$__LOCALE['RCCMSHTML_DPC'][10]='_code;Code;Κωδικός';
$__LOCALE['RCCMSHTML_DPC'][11]='_messages;Messages;Μηνύματα';
$__LOCALE['RCCMSHTML_DPC'][12]='_offers;Offers;Προσφορές';


class rccmshtml {
	
    var $title, $path, $urlpath;
	var $ckeditver;	 
	
	function __construct() {

		$this->path = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		$this->title = localize('RCCMSHTML_DPC',getlocal());	 
	  
		$this->ckeditver = 3;
				
	}

    function event($event=null) {
	
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;		 
	
		switch ($event) {
			case 'cpcmshtmlsave': break;				
					
			case 'cpcmsformshow': break;
			case 'cpcmsfshow'   : echo $this->loadframe();
		                          die();
							      break;
			case 'cpcmshtml'    :
			default             :    
		                      
		}
			
    }   
	
    function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	
	 
		switch ($action) {	
			case 'cpcmshtmlsave': $out = $this->htmlSave(); 
			                      break;		
		
			case 'cpcmsformshow': $out = $this->show(); 
			                      break;	
			case 'cpcmsfshow'   : break;
			case 'cpcmshtml'    :
			default             : $out = $this->cmsTemplates();
		}	 

		return ($out);
    }
	
	protected function cmsTemplates() {
		
		//$content = $this->formsTree();			
		//$ret = $this->window($this->title, $button, $content);
		$ret = null;
		return ($ret);
	}	
	
	protected function loadframe($ajaxdiv=null, $mode=null) {
		$id = GetParam('id');
		$cmd = 'cpcmsformshow&id='.$id ;//$mode not used
		$bodyurl = seturl("t=$cmd&iframe=1");
			
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
		
		//$ret = $this->loadsubframe(null,'formhtml', true);
		
		return ($ret);
	}	
	
	protected function htmlSave() {
		$id = GetParam('id');
		
		/*if ($_POST['id']) {
			$ret = $this->saveHtmlData($id, trim($_POST['codedata']));
		}*/	
	}
		
	
	public function fetchHtmlData() {
		$id = GetParam('id');
		
		return file_get_contents($id);
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
		$tmpls = GetSessionParam('cmsTemplates');
		print_r($tmpls);
		if (!empty($tmpls)) {
			foreach ($tmpls as $t=>$i) {
				if ($t) {
					$ft = explode('/', $t);
					$title = array_pop($ft);
					$selectTree .= "<li><a data-role=\"leaf\" href=\"javascript:editform('$t')\"><i class=\" icon-book\"></i> $title</a></li>";
				}
			}
		}

		$ret = '	
                            <ul id="tree_2" class="tree">
                                <li>
                                    <a data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle" data-role="branch" href="#">'.substr($treeTitle, 0, 9).'</a>
                                    <ul class="branch in">																						
										' . $selectTree . '
                                    </ul>
                                </li>
                            </ul>		
';
		return ($ret);
	}
	
	public function editAreaJS() {
		return _m("cmsrt.paramload use CMS+editAreaJS");
	}
	
	public function ckEditJS() {
		return _m("cmsrt.paramload use CMS+ckEditorJS");
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
		
		$fullpage = 'true'; //when type=1 = html contents else partial content
		
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
	
	
};
}
?>