<?php
$__DPCSEC['CPMHTMLEDITOR_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CPMHTMLEDITOR_DPC")) && (seclevel('CPMHTMLEDITOR_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CPMHTMLEDITOR_DPC",true);

$a = GetGlobal('controller')->require_dpc('images/wateresize.lib.php');
require_once($a);

$b= GetGlobal('controller')->require_dpc('images/SimpleImage.lib.php');
require_once($b);

$__DPC['CPMHTMLEDITOR_DPC'] = 'cpmhtmleditor';

$__EVENTS['CPMHTMLEDITOR_DPC'][0]='cpmhtmleditor';
$__EVENTS['CPMHTMLEDITOR_DPC'][1]='cpmdropzone';
$__EVENTS['CPMHTMLEDITOR_DPC'][2]='cpmvphoto';
$__EVENTS['CPMHTMLEDITOR_DPC'][3]='cpmvdel';
$__EVENTS['CPMHTMLEDITOR_DPC'][4]='cpmvphotoadddb';
$__EVENTS['CPMHTMLEDITOR_DPC'][5]='cpmvphotodeldb';
$__EVENTS['CPMHTMLEDITOR_DPC'][6]='cpmedititem';
$__EVENTS['CPMHTMLEDITOR_DPC'][7]='cpmnewitem';
$__EVENTS['CPMHTMLEDITOR_DPC'][8]='cpmdelitem';

$__ACTIONS['CPMHTMLEDITOR_DPC'][0]='cpmhtmleditor';
$__ACTIONS['CPMHTMLEDITOR_DPC'][1]='cpmdropzone';
$__ACTIONS['CPMHTMLEDITOR_DPC'][2]='cpmvphoto';
$__ACTIONS['CPMHTMLEDITOR_DPC'][3]='cpmvdel';
$__ACTIONS['CPMHTMLEDITOR_DPC'][4]='cpmvphotoadddb';
$__ACTIONS['CPMHTMLEDITOR_DPC'][5]='cpmvphotodeldb';
$__ACTIONS['CPMHTMLEDITOR_DPC'][6]='cpmedititem';
$__ACTIONS['CPMHTMLEDITOR_DPC'][7]='cpmnewitem';
$__ACTIONS['CPMHTMLEDITOR_DPC'][8]='cpmdelitem';

$__LOCALE['CPMHTMLEDITOR_DPC'][0]='SHLOGIN_DPC;Login;Εισαγωγή';
$__LOCALE['CPMHTMLEDITOR_DPC'][1]='_submit;Save;Αποθήκευση';
$__LOCALE['CPMHTMLEDITOR_DPC'][2]='_title;Subject;Θέμα';
$__LOCALE['CPMHTMLEDITOR_DPC'][3]='_tags;Tags;Ετικέτες';
$__LOCALE['CPMHTMLEDITOR_DPC'][4]='_subject;My subject;Το θέμα μου';

class cpmhtmleditor {

	static $staticpath;
	var $encoding, $prpath, $template, $one_attachment, $slan;
	var $htmlfile, $ckeditor4, $cke4, $ckjs;
	var $urlpath, $urlbase, $msg;
	var $photodb, $restype, $cseparator, $map_t, $map_f, $encodeimageid;
	var $itmplpath, $mcpagespath, $selectSQL;
	
	var $messages, $postok, $record;

	public function __construct() {
	
		self::$staticpath = paramload('SHELL','urlpath');
	
		$this->urlpath = paramload('SHELL','urlpath');		  
		//$this->urlbase = paramload('SHELL','urlbase');	
		//$this->urlbase = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
		//$this->urlbase.= (strstr($_SERVER['HTTP_HOST'], 'www')) ? $_SERVER['HTTP_HOST'] : 'www.' . $_SERVER['HTTP_HOST'];		
		$this->urlbase = _v('cmsrt.httpurl');
		
		$this->prpath = paramload('SHELL','prpath');
		$tmpl_path = remote_paramload('FRONTHTMLPAGE','template',$this->prpath);
		$this->template = $tmpl_path ? $tmpl_path .'/' : null;

		$this->one_attachment = remote_paramload('SHKATALOG','oneattach',$this->prpath);
		$lan = getlocal();
		$this->slan = ($this->one_attachment) ? null : ($lan?$lan:'0');

		//save editable file
		$this->htmlfile = urldecode(base64_decode($_GET['htmlfile']));
		//echo $htmlfile;
		/*if php editable file extend template path to pages path*/
		$this->template .= stristr($htmlfile,'.php') ? 
							(stristr($htmlfile,'index.php') ? null :'pages/') : 
							null;

		//ckeditor 4

		//$ckeditor4 = GetReq('cke4') ? GetReq('cke4') : false;
		//$this->ckeditor4 = true;//((GetReq('cke4'))||($template)) ? false : false; 
		$this->ckeditor4 = remote_paramload('CKEDITOR','ckeditor4',$this->prpath);
		$this->cke4_inline = $this->ckeditor4 ? true/*false*/ : false; 

		$ckeditorurl = remote_paramload('CKEDITOR','ckeditorurl',$this->prpath);		
		$ckeditor4url = remote_paramload('CKEDITOR','ckeditor4url',$this->prpath);		
		$this->ckjs = $this->ckeditor4 ? $ckeditor4url : $ckeditorurl;
		//$this->ckjs = $this->ckeditor4 ? "http://stereobit.gr/ckeditor4/ckeditor.js" : "http://stereobit.gr/ckeditor/ckeditor.js";
	
		$this->encodeimageid = remote_paramload('RCITEMS','encodeimageid',$this->path);
	    $this->photodb = remote_paramload('RCITEMS','photodb',$this->prpath);
		$this->restype = remote_paramload('RCITEMS','restype',$this->prpath);
	    $this->msg = null;
		
	    $this->map_t = remote_arrayload('RCITEMS','maptitle',$this->path);	
	    $this->map_f = remote_arrayload('RCITEMS','mapfields',$this->path);		
		$csep = remote_paramload('RCITEMS','csep',$this->path); 
		$this->cseparator = $csep ? $csep : '^';

		$this->itmplpath = 'templates/';
		$this->mcpagespath = 'pages/';
		
		$this->activecode = $this->getmapf('code');
		$this->selectSQL = "select id,sysins,code1,pricepc,price2,sysins,itmname,itmfname,uniname1,uniname2,active,code4," .
							"price0,price1,cat0,cat1,cat2,cat3,cat4,itmdescr,itmfdescr,itmremark,ypoloipo1,resources,".
							$this->activecode . ",weight,volume,dimensions,size,color,manufacturer,orderid," .
							"template,owner,itmactive from products ";		
		
		$this->record = null;
		$this->messages = array();
		$this->postok = false;	
	}	
	
	public function event($sEvent) {
	
		switch ($sEvent) {
			case 'cpmdelitem'     : $this->delete_item();  break;
			case 'cpmnewitem'     : $this->render_new();  break;
			case 'cpmedititem'    : $this->render_edit(); break;
			
			case 'cpmvphotoadddb' : $this->add_photo2db(null,null,GetReq('size')); break;
			case 'cpmvphotodeldb' : $this->delete_photodb(GetReq('size')); break;
			
		    case 'cpmvdel'     	  : $this->delete_photo(); break;
			case 'cpmvphoto'      : break; 
		    case 'cpmdropzone'    : $this->dropzone(); break; //fast-entry photo
			default 		      : 
		}
    }
	
	public function action($sAction) {
		switch ($sAction) {
			case 'cpmdelitem'     :
		    case 'cpmnewitem'     : break;
		    case 'cpmedititem'    : break;
		
			case 'cpmvphotoadddb' : 
			case 'cpmvphotodeldb' : 		
		    case 'cpmvdel'        :
		    case 'cpmvphoto'      : $out = $this->gallery(); break; 
			case 'cpmdropzone'    : break;
			default 		      : $out = $this->editor();
		}	
		return ($out);
    }
	
    public function editor($itemcode=null, $itemtype=null, $file = null) {
		$type = $itemtype ? $itemtype : (GetReq('type') ? GetReq('type') : '.html');
		$htmlfile = $file ? $file : $this->htmlfile; 
		
		if (!empty($_POST)) {
			$ret = $this->render();//$myfile);
		}
		else {
			$p = explode('/',$htmlfile);
			$fa = array_pop($p);
			$myfile = getcwd() . '/html/' . $this->template .  $fa;
			//$tempname = getcwd() . '/modify_html.tmp';
			$ret = $this->render($myfile);	  	  
		}	
		return ($ret);
    }	

	//generic html edit
    protected function render($file=null,$tempfile=null) {
		$_id = GetParam('id') ? GetParam('id') : $cpGet['id'];
		$cpGet = _v('rcpmenu.cpGet');		
		$id = _m("cmsrt.getRealItemCode use " . $_id);		
				
		$type = GetParam('type') ? GetParam('type') : '.html'; //default type for text attachment
		$isTemplate = (substr($mydata,0,8)=='<!DOCTYPE') ? false : true; //html5 !!!!!	
      
		if (isset($_POST['htmltext'])) {
			if ($id) { //db	 
				$mytext = str_replace(' use','&nbsp;use',str_replace('+','<SYN>',$this->unload_spath(str_replace("'","\'",$_POST['htmltext'])))); //!!!!!!!!!!!!!!
				//$save = _m("rcitems.add_attachment_data use ".$id ."+". $type."+".$mytext);		 
				$save = $this->add_attachment_data($id,$type,$mytext);
				//$mydata = _m("rcitems.has_attachment2db use " . $id ."+$type+1"); 
				$mydata = $this->has_attachment2db($id,$type,1);
			}
			else {//text
				$this->savefile($file,null);		 
				$mydata = file_get_contents($file);//$_POST['htmltext'];
			}		 
		}
		else {//load
			if ($id) { //db
				//$mydata = _m("rcitems.has_attachment2db use " . $id ."+$type+1"); 
				$mydata = $this->has_attachment2db($id,$type,1);
			}
			else {//text
				if (($file) && is_readable($file)) {
					$mydata = @file_get_contents($file);
				}  
				else
					$mydata = 'File not exist!' . " ($file)";			
			}	  
		}
	  
		$purl = $_SERVER['PHP_SELF'].'?encoding='.$_GET['encoding'].'&htmlfile='.$_GET['htmlfile'];
		$out = "<form name=\"htmlform\" action=\"".$purl."\" method=\"post\">";  

		$out .= $this->ckeditor($mydata, $isTemplate);
	
		$mytempfile = GetParam('tempfile')?	GetParam('tempfile') : $tempfile;	   
		$myfile = GetParam('file2saveon') ?	GetParam('file2saveon') : $file;
		if ($iframe = GetReq('iframe'))
			$out .= "<input type=\"hidden\" name=\"iframe\" value=\"1\" />";	
		if ($ajax = GetReq('ajax'))
			$out .= "<input type=\"hidden\" name=\"ajax\" value=\"1\" />";		
		
		$out .= "<input type=\"hidden\" name=\"file2saveon\" value=\"" . $myfile . "\" />";	  
		$out .= "<input type=\"hidden\" name=\"filetemp\" value=\"" . $mytempfile . "\" />";	 
		$out .= "<input type=\"hidden\" name=\"id\" value=\"" . $id . "\" />";	 
		$out .= "<input type=\"hidden\" name=\"type\" value=\"" . $type . "\" />";		   
		$out .= "</form>";
      
		return ($out); 
    }	
	
	//new item
    protected function render_new() {
		$db = GetGlobal('db');		
		$type = '.html'; //default type for text attachment
		$cpGet = _v('rcpmenu.cpGet');
		$id = GetParam('id');	

		if (isset($_POST['insert'])) { 

			if ($title = GetParam('title')) {
				
				$code = $this->replace_spchars($title);
				$tags = GetParam('tags') ;
				$text = GetParam('htmltext');
				$descr = GetParam('descr') ? GetParam('descr') : substr(trim(strip_tags($text)),0,250).'...';
				$active = GetParam('active') ? '101' : '0';
				$itmactive = GetParam('itmactive') ? '1' : '0';
				$template = GetParam('mctemplate');
				$mcpage = GetParam('mcpage');
				
				$this->writeMCPage($code, $mcpage, _v('cmsrt.template'));
				
				if (!empty($_POST['include'])) 
					$category = array_shift($_POST['include']); //get first from list
				else					
					$category = $this->replace_spchars($cpGet['cat'], 1);
				$cat = explode($this->cseparator, $category);
					
				$save_tags = $this->add_tags_data($code,$title,$descr,$tags);
				$this->messages[] = "Add tags:".$tags;		
				$save_cat = $this->add_kategory_data($category);
				$this->messages[] = "Add category:".$category;		
				
				$sSQL = "insert into products ({$this->activecode},itmname,itmfname,itmdescr,itmfdescr,sysins,active,itmactive,cat0,cat1,cat2,cat3,cat4,template) values (";
				$sSQL .= $db->qstr($code).",".$db->qstr($title).",".$db->qstr($title).",".$db->qstr($descr).",".$db->qstr($descr).",".$db->qstr(date('Y-m-d h:m:s')).",$active,$itmactive,";			
				$sSQL .= $db->qstr($cat[0]).",".$db->qstr($cat[1]).",".$db->qstr($cat[2]).",".$db->qstr($cat[3]).",".$db->qstr($cat[4]).",";			
				$sSQL .= $template ? $db->qstr($template . '.php') : $db->qstr('');
				$sSQL .= ")"; 

				$result = $db->Execute($sSQL);				
				$this->messages[] = "Add item:".$code;
				
				//read 
				$sSQL = $this->selectSQL . " WHERE {$this->activecode}=" . $db->qstr($id);
				$res = $db->Execute($sSQL);	
				$this->record = $res->fields;
				$this->messages[] = "Load record";				
			
				if (isset($_POST['htmltext'])) {
					$mytext = str_replace(' use','&nbsp;use',str_replace('+','<SYN>',$this->unload_spath(str_replace("'","\'",$_POST['htmltext'])))); 		 
					$save = $this->add_attachment_data($code,$type,$mytext);		
					$mydata = $this->has_attachment2db($code,$type,1);
					$this->messages[] = "Save text:".$type;
				}
				
				/*if ($mcpage = GetParam('mcpage')) {
					$mydata = _m("fronthtmlpage.mcSavePage use ".$title."+".$mcpage); 			
					$this->messages[] = "MCPAGE:".$mcpage;
				}*///DISABLED
			
				$this->postok = $code; //active code
				
				//update turl global variables to change the exit
				$newUrl = 'katalog.php?t='.$cpGet['t'].'&cat='.$cpGet['cat'].'&id='.$code;
				$target_url = urlencode(encode($newUrl));
				//echo $newUrl;
				SetSessionParam('turl', $target_url);//urlencode(base64_encode($newUrl)));
				SetSessionParam('turldecoded', $newUrl);
				$urlquery = parse_url($newUrl);
				parse_str($urlquery['query'], $getp);	
				SetSessionParam('cpGet', base64_encode(serialize($getp)));
				_v('rcpmenu.cpGet', $getp);	//update cpGet	
			}
			else
				$this->messages[] = "Insert subject";			
		}
		else {//load	  
			$mydata = $id ? $this->has_attachment2db($id,$type,1) : null;
			$this->messages[] = $id ? "Load text" : null;
		}
	  
	    return true;
    }	
	
	//edit item
    protected function render_edit() { 
		$db = GetGlobal('db');
		$type = '.html'; //default type for text attachment
	    $lan = getlocal();
	    $itmname = $lan ? 'itmname' : 'itmfname';
	    $itmdescr = $lan ? 'itmdescr' : 'itmfdescr';		
		$cpGet = _v('rcpmenu.cpGet');
		$id = GetParam('id') ? _m("cmsrt.getRealItemCode use " . GetParam('id')) : 
							   _m("cmsrt.getRealItemCode use " . $cpGet['id']);		
      
		if (isset($_POST['update'])) { //post edit

			if ($title = GetParam('title')) {
			
				$code = $id; 
				$tags = GetParam('tags') ;
				$text = GetParam('htmltext');
				$descr = GetParam('descr');// ? GetParam('descr') : substr(trim(strip_tags($text)),0,250).'...';
				$active = GetParam('active') ? '101' : '0';
				$itmactive = GetParam('itmactive') ? '1' : '0';
				$template = GetParam('mctemplate');
				$mcpage = GetParam('mcpage');
				
				$this->writeMCPage($code, $mcpage, _v('cmsrt.template'));
				
				if (!empty($_POST['include'])) 
					$category = array_shift($_POST['include']); //get first from list
				else		
					$category = $this->replace_spchars($cpGet['cat'], 1);
				$cat = explode($this->cseparator, $category);

				//update tags
				$save_tags = $this->upd_tags_data($code,$title,$descr,$tags);
				$this->messages[] = "Update tags:".$tags;				
				
				//update
				$sSQL = "update products set $itmname=" . $db->qstr($title) . ",$itmdescr=" . $db->qstr($descr);
				$sSQL.= ",itmactive=" . $itmactive . ",active=" . $active . ",template=". $db->qstr($template);
				foreach($cat as $i=>$c) 
					$sSQL .= ",cat{$i}=" . $db->qstr($c);
				$sSQL .= " WHERE {$this->activecode}=" . $db->qstr($id);
				$res = $db->Execute($sSQL);	
				$this->messages[] = "Update record";				
				
				//read 
				$sSQL2 = $this->selectSQL . " WHERE {$this->activecode}=" . $db->qstr($id);
				$res2 = $db->Execute($sSQL2);	
				$this->record = $res2->fields;
				$this->messages[] = "Load record";									
				
				if (isset($_POST['htmltext'])) {
					$mytext = str_replace(' use','&nbsp;use',str_replace('+','<SYN>',$this->unload_spath(str_replace("'","\'",$_POST['htmltext'])))); 		 
					$save = $this->add_attachment_data($code,$type,$mytext); 			
					$mydata = $this->has_attachment2db($code,$type,1);
					$this->messages[] = "Save text:".$type;
				}
				
				/*if ($mcpage = GetParam('mcpage')) {
					$mydata = _m("fronthtmlpage.mcSavePage use ".$title."+".$mcpage); 			
					$this->messages[] = "MCPAGE:".$mcpage;
				}*///DISABLED				
			
				$this->postok = $id; //active code
			}
			else
				$this->messages[] = "Insert subject";	
		}
		else {//load
			$mydata = $id ? $this->has_attachment2db($id,$type,1) : null; 
			$this->messages[] = $id ? "Load text" : null;
			
			if ($id) {
				$sSQL = $this->selectSQL;	
				$sSQL .= " WHERE {$this->activecode}=" . $db->qstr($id);
				$res = $db->Execute($sSQL);	
				$this->record = $res->fields;
			    //echo $sSQL; print_r($this->record);
				$this->messages[] = "Load record";
			}
		}
	  
	    return true;
    }	
	
	public function hrefEshopDetails() {
		$cpGet = _v('rcpmenu.cpGet');		
		$id = $this->postok ? $this->postok : 
				(GetParam('id') ? _m("cmsrt.getRealItemCode use " .GetParam('id')) : 
								  _m("cmsrt.getRealItemCode use " . $cpGet['id']));
		return $id ? seturl('t=cpmhtmldetails&id='.$id) : '#';
	}
	
	public function hrefCopyItem() {
		$cpGet = _v('rcpmenu.cpGet');		
		$id = $this->postok ? $this->postok : 
			(GetParam('id') ? _m("cmsrt.getRealItemCode use " . GetParam('id')) : 
							  _m("cmsrt.getRealItemCode use " . $cpGet['id']));		
			
		return $id ? seturl('t=cpmhtmlcopy&id='.$id) : '#';
	}	

    protected function savefile($filename=null,$tempfile=null) {
        //echo $filename;
	 
	    if (GetSessionParam('LOGIN')!='yes') 
			die("Not logged in!");
			
        $this->write2disk($filename,$_POST['htmltext']); //save temp
             
        if ($tempfile)
            $this->write2disk($tempfile,$_POST['htmltext']); //save original
			  
    }

    protected function remove_spchars($text=null) {

		$p1 = str_replace("\'","'",$text);
		$p2 = str_replace('\"','"',$p1);

		return $p2;
    }

    protected function handle_phpdac_tags($text,$savemode=null) {

		if ($savemode==null) {//load
			$p1 = str_replace("<?","<phpdac5>",$text);
			$p2 = str_replace('?>','</phpdac5>',$p1);
		}
		else {//save 
			$p1 = str_replace("<phpdac5>","<?",$text);
			$p2 = str_replace('</phpdac5>','?>',$p1);
		}

		return $p2;
    }

    protected function load_spath($text=null) {

       $p1 = str_replace("images/","../images/",$text);

       $ret = $this->handle_phpdac_tags($p1);
       return ($ret);

    }

    protected function unload_spath($text=null) {	

       $p1 = str_replace("../images/","images/",$text);

       $ret = $this->handle_phpdac_tags($p1,1);
       return ($ret);

    }

    protected function write2disk($file,$data=null) {

	    $indata = $this->remove_spchars($this->unload_spath($data));
		//keep a backup
		@copy($file, str_replace(array('.htm','.php'),array('._htm','._php'),$file));
		
        if ($fp = @fopen ($file , "w")) {
            fwrite ($fp, $indata);
            fclose ($fp);

            return true;
        }
        else {
            $this->msg = "File creation error ($file)!";
        }
        return false;

    }
	
	
	//IMAGES
	
	protected function watermark($s, $f) {
		$image2add = remote_paramload('RCITEMS','image2add',$this->path);
	
		if (is_file($s)) {
	        $process_img = new wateresize();
			$process_img->loadimg($s, 0, 0, 'jpg', 1, $this->urlpath, $this->image2add);
			$process_img->set_jpg_quality(filesize($s));
	        $ret = $process_img->saveimg($this->urlpath, $f);	
	        unset($process_img);		
		}   
	    else
			$ret = move_uploaded_file($s,$f);
				
	}

    protected function create_thumbnail($s, $file, $ptype, $uphotoid=null) {
	
        $restype = remote_paramload('RCITEMS','restype',$this->prpath);//'.jpg'; 				  			
		$autoresize = remote_arrayload('RCITEMS','autoresize',$this->prpath);
		
		//3 sized scaled images
		$photo_bg = remote_paramload('RCITEMS','photobgpath',$this->prpath);		  
		$img_large = $photo_bg ? $this->urlpath ."/images/$photo_bg/" : $thubpath;	  	  
		$photo_md = remote_paramload('RCITEMS','photomdpath',$this->prpath);		  
		$img_medium = $photo_md ? $this->urlpath ."/images/$photo_md/" : $thubpath;	  	  
		$photo_sm = remote_paramload('RCITEMS','photosmpath',$this->prpath);		  
		$img_small = $photo_sm ? $this->urlpath ."/images/$photo_sm/" : $thubpath;	  
		
		$f = $file . $restype;
		
		switch ($ptype) {
		
			  case 'SMALL' : //resize medium, small and save at once
                             if (!empty($autoresize)) {							 
                               $image = new SimpleImage();
                               $image->load($s);
							   						   
							   if ($dim_small = $autoresize[0]) {
                                 $image->resizeToWidth($dim_small);
                                 $image->save($img_small . $f);
								 //auto add to db
								 $this->add_photo2db($file,$restype,'SMALL');
                               }
                               return 1;							   
							 }							 
			                 break;
							 
			  case 'MEDIUM' : //resize medium, small and save at once
                             if (!empty($autoresize)) {							 
                               $image = new SimpleImage();
                               $image->load($s);
							   
							   if ($dim_medium = $autoresize[1]) {
                                 $image->resizeToWidth($dim_medium);
                                 $image->save($img_medium . $f);
								 //auto add to db
								 $this->add_photo2db($file,$restype,'MEDIUM');
							   }							   
							   if ($dim_small = $autoresize[0]) {
                                 $image->resizeToWidth($dim_small);
                                 $image->save($img_small . $myfilename);
								 //auto add to db
								 $this->add_photo2db($file,$restype,'SMALL');
                               }
                               return 1;							   
							 }
			                 break;
							 
			  case 'LARGE' : //resize large, medium and small and save at once	
                             if (!empty($autoresize)) {							 
                               $image = new SimpleImage();
                               $image->load($s);
							   
							   if ($dim_large = $autoresize[2]) {
                                 $image->resizeToWidth($dim_large);
                                 $image->save($img_large . $f);	
								 //auto add to db
								 $this->add_photo2db($file,$restype,'LARGE');
							   }								   
							   if ($dim_medium = $autoresize[1]) {
                                 $image->resizeToWidth($dim_medium);
                                 $image->save($img_medium . $f);	
								 //auto add to db
								 $this->add_photo2db($file,$restype,'MEDIUM');
							   }
							   if ($dim_small = $autoresize[0]) {
                                 $image->resizeToWidth($dim_small);
                                 $image->save($img_small . $f);	
								 //auto add to db
								 $this->add_photo2db($file,$restype,'SMALL');
							   }
                               return 1; 							   
							 }
			                 break;
							 							 							 
			  default      : //DEFAULT 1 sized photo
                             $path = $uphotoid ? 
							         $this->urlpath . remote_paramload('RCITEMS','adrespath',$this->prpath) : 
									 $this->urlpath . remote_paramload('RCITEMS','respath',$this->prpath);
							         
							 //resize large autoresize
                             if (!empty($autoresize)) {							 
                               $image = new SimpleImage();
                               $image->load($s);
							   						   
							   if ($dim_large = $autoresize[2]) {
                                 $image->resizeToWidth($dim_large);
                                 $image->save($path . $f);	
								 //auto add to db
								 $this->add_photo2db($file,$restype,'');
                               }
                               return 1;							   
							 }
                             else
								move_uploaded_file($s, $path . $f);
		}
    }	
	
	//handle dropzone js form for pic uploading
	protected function dropzone($accepted_filetypes=null) {
		//$cpGet = _v('rcpmenu.cpGet');		
		$realid = _m("cmsrt.getRealItemCode use " . $_GET['title']) ;//$cpGet['id']);		

	    //$title = $_GET['title'] ? str_replace(' ','-',$_GET['title']) : 'title'; //posted item code
		$title = $realid ? str_replace(' ','-',$realid) : 'title'; //real id
		
		$ds = DIRECTORY_SEPARATOR;  
		//$storeFolder = 'uploads'; 

		$restype = remote_paramload('RCITEMS','restype',$this->prpath);//'.jpg'; 				  		
        $phototype = remote_paramload('RCITEMS','phototype',$this->path);

		$mixphoto = remote_paramload('RCITEMS','mixphoto',$this->prpath);	 
		$photoquality = remote_paramload('RCITEMS','photoquality',$this->prpath);
	  
		$mixx = remote_paramload('RCITEMS','mixx',$this->prpath);	 
		$mixy = remote_paramload('RCITEMS','mixy',$this->prpath);	 	  
		$mixx = $mixx ? $mixx : 'CENTER';	 
		$mixy = $mixy ? $mixy : 'MIDDLE';		
		
		$rp = remote_paramload('RCITEMS','respath',$this->prpath);		
		$rrp = $rp ? $rp : '/images/thub/';
		$thubpath = $this->urlpath . $rrp;	  
		$rp2 = remote_paramload('RCITEMS','adrespath',$this->prpath);
		$rrp2 = $rp2 ? $rp2 : '/images/uphotos/';
		$uphotos = $this->urlpath . $rrp2;
		
 		$photo_sm = remote_paramload('RCITEMS','photosmpath',$this->prpath);		  
		$img_small = $photo_sm ? $this->urlpath ."/images/$photo_sm/" : $thubpath;	  
		
		if (!empty($_FILES)) {
     
			$tempFile = $_FILES['file']['tmp_name'];               
			//$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  
			//$targetFile =  $targetPath. $_FILES['file']['name'];  
			$f = $_FILES['file']['name'];//$title . $restype;
			$targetFile =  $thubpath . $f;	
            //move_uploaded_file($tempFile,$targetFile); 
			//die();
			$targetName = $this->encode_image_id($title);			
			
            $targetMainPath = $phototype ? $img_small : $thubpath; 			
			$targetSecPath = $uphotos;
			$targetMainFile = $targetMainPath . $targetName; 
			$targetSecFile = $targetSecPath . $targetName; 
			
			if (is_readable($targetMainFile.$restype)) { //look if pic exist
			    //save at uphotos a,b,c..
				for ($iz='A';$iz<'Z';$iz++) {
					if (!is_readable($targetSecFile.$iz.$restype))
						break;
				}
				$targetName .= $iz; //'A';
				$this->create_thumbnail($tempFile, $targetName, null, $iz);
			}
			else {
			    //save at main path
				switch ($phototype) {
					case 1  : $this->create_thumbnail($tempFile, $targetName, 'SMALL'); break;
					case 2  : $this->create_thumbnail($tempFile, $targetName, 'MEDIUM'); break;
					default : $this->create_thumbnail($tempFile, $targetName, 'LARGE');
				}
			}
		}
		//file_put_contents($this->prpath.'dropzone.txt' ,$targetName);
		die();
	}
	
	protected function gallery($title=null) {
		$cpGet = _v('rcpmenu.cpGet');		
		$realid = _m("cmsrt.getRealItemCode use " . $cpGet['id']);		
		
	    $_id = $title ? $title : $realid; 
		$name = $this->encode_image_id($_id);
		$ret = null;
		$id = 0;

		$xlink = 'cpmhtmleditor.php?t=cpmvdel&id='; 
		$restype = remote_paramload('RCITEMS','restype',$this->prpath);//'.jpg'; 				  		
	
		$photo_bg = remote_paramload('RCITEMS','photobgpath',$this->prpath);		  
		$img = "/images/$photo_bg/" . $name . $restype;
		$img_large = $photo_bg ? $this->urlpath . $img : null;	

        if ($this->photodb) {
			$add2db_url = seturl('t=cpmvphotoadddb&size=LARGE&id='.$name);
			$add2db_button = '<div class="mega-link mega-red"><a href="'.$add2db_url.'"><div class="mega-link mega-red"></div></a></div>';
			$del2db_url = seturl('t=cpmvphotodeldb&size=LARGE&id='.$name);
			$del2db_button = '<div class="mega-link mega-red"><a href="'.$del2db_url.'"><div class="mega-link mega-red"></div></a></div>';			
		}
		
		if (($img_large) && is_readable($img_large)) {
		    $id += 1;
			$ret = '<div class="mega-entry cat-large cat-all" id="mega-entry-'.$id.'" data-src="'.$img.'" data-lowsize="">
                        <div class="mega-covercaption mega-square-bottom mega-landscape-right mega-portrait-bottom mega-red">
                            <!-- The Content Part with Hidden Overflow Container -->
                            <div class="mega-title"><img src="img/gallery/icons/grid.png" alt="" style="float: left; padding-right: 15px;"/>'.$name.'</div>
                            <div class="mega-date">Lorem ipsun dolor</div>
                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua...<br/><br/><a href="#">Read the whole story</a></p>
                        </div>
                        <!-- The Link Buttons -->
                        <div class="mega-coverbuttons">
							'.$add2db_button . $del2db_button.'
                            <div class="mega-link mega-red"><a href="'.$xlink.$name.'&type=LARGE"><div class="mega-link mega-red"></div></a></div>
                            <a class="fancybox" rel="group" href="'.$img.'" title="'.$name.'"><div class="mega-view mega-red"></div></a>
                        </div>
                    </div>';
		}
		
		$photo_md = remote_paramload('RCITEMS','photomdpath',$this->prpath);		  
		$img = "/images/$photo_md/" . $name . $restype;
		$img_medium = $photo_md ? $this->urlpath . $img : null;
		
        if ($this->photodb) {
			$add2db_url = seturl('t=cpmvphotoadddb&size=MEDIUM&id='.$name);
			$add2db_button = '<div class="mega-link mega-red"><a href="'.$add2db_url.'"><div class="mega-link mega-red"></div></a></div>';
			$del2db_url = seturl('t=cpmvphotodeldb&size=MEDIUM&id='.$name);
			$del2db_button = '<div class="mega-link mega-red"><a href="'.$del2db_url.'"><div class="mega-link mega-red"></div></a></div>';			
		}		
		
		if (($img_medium) && is_readable($img_medium)) {
		    $id += 1;
			$ret .= '<div class="mega-entry cat-medium cat-all" id="mega-entry-'.$id.'" data-src="'.$img.'" data-lowsize="">
                        <div class="mega-covercaption mega-square-bottom mega-landscape-right mega-portrait-bottom mega-red">
                            <!-- The Content Part with Hidden Overflow Container -->
                            <div class="mega-title"><img src="img/gallery/icons/grid.png" alt="" style="float: left; padding-right: 15px;"/>'.$name.'</div>
                            <div class="mega-date">Lorem ipsun dolor</div>
                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua...<br/><br/><a href="#">Read the whole story</a></p>
                        </div>
                        <!-- The Link Buttons -->
                        <div class="mega-coverbuttons">
							'.$add2db_button . $del2db_button.'
                            <div class="mega-link mega-red"><a href="'.$xlink.$name.'&type=MEDIUM"><div class="mega-link mega-red"></div></a></div>
                            <a class="fancybox" rel="group" href="'.$img.'" title="'.$name.'"><div class="mega-view mega-red"></div></a>
                        </div>
                    </div>';		
		}
		
 		$photo_sm = remote_paramload('RCITEMS','photosmpath',$this->prpath);		  
		$img = "/images/$photo_sm/" . $name . $restype;
		$img_small = $photo_sm ? $this->urlpath . $img : null;
		
        if ($this->photodb) {
			$add2db_url = seturl('t=cpmvphotoadddb&size=SMALL&id='.$name);
			$add2db_button = '<div class="mega-link mega-red"><a href="'.$add2db_url.'"><div class="mega-link mega-red"></div></a></div>';
			$del2db_url = seturl('t=cpmvphotodeldb&size=SMALL&id='.$name);
			$del2db_button = '<div class="mega-link mega-red"><a href="'.$del2db_url.'"><div class="mega-link mega-red"></div></a></div>';			
		}		
		
		if (($img_small) && is_readable($img_small)) {
		    $id += 1;
			$ret .= '<div class="mega-entry cat-small cat-all" id="mega-entry-'.$id.'" data-src="'.$img.'" data-lowsize="">
                        <div class="mega-covercaption mega-square-bottom mega-landscape-right mega-portrait-bottom mega-red">
                            <!-- The Content Part with Hidden Overflow Container -->
                            <div class="mega-title"><img src="img/gallery/icons/grid.png" alt="" style="float: left; padding-right: 15px;"/>'.$name.'</div>
                            <div class="mega-date">Lorem ipsun dolor</div>
                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua...<br/><br/><a href="#">Read the whole story</a></p>
                        </div>
                        <!-- The Link Buttons -->
                        <div class="mega-coverbuttons">
							'.$add2db_button . $del2db_button.'
                            <div class="mega-link mega-red"><a href="'.$xlink.$name.'&type=SMALL"><div class="mega-link mega-red"></div></a></div>
                            <a class="fancybox" rel="group" href="'.$img.'" title="'.$name.'"><div class="mega-view mega-red"></div></a>
                        </div>
                    </div>';		
		}
	
		$rp = remote_paramload('RCITEMS','respath',$this->prpath);		
		$rrp = $rp ? $rp : '/images/thub/';
		$img = $rrp . $name . $restype;
		$img_thub = $this->urlpath . $img;	

        if ($this->photodb) {
			$add2db_url = seturl('t=cpmvphotoadddb&size=&id='.$name);
			$add2db_button = '<div class="mega-link mega-red"><a href="'.$add2db_url.'"><div class="mega-link mega-red"></div></a></div>';
			$del2db_url = seturl('t=cpmvphotodeldb&size=&id='.$name);
			$del2db_button = '<div class="mega-link mega-red"><a href="'.$del2db_url.'"><div class="mega-link mega-red"></div></a></div>';			
		}	
		
		if (($img_thub) && is_readable($img_thub)) {
		    $id += 1;
			$ret .= '<div class="mega-entry cat-thumb cat-all" id="mega-entry-'.$id.'" data-src="'.$img.'" data-lowsize="">
                        <div class="mega-covercaption mega-square-bottom mega-landscape-right mega-portrait-bottom mega-red">
                            <!-- The Content Part with Hidden Overflow Container -->
                            <div class="mega-title"><img src="img/gallery/icons/grid.png" alt="" style="float: left; padding-right: 15px;"/>'.$name.'</div>
                            <div class="mega-date">Lorem ipsun dolor</div>
                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua...<br/><br/><a href="#">Read the whole story</a></p>
                        </div>
                        <!-- The Link Buttons -->
                        <div class="mega-coverbuttons">
							'.$add2db_button.$del2db_button.'
                            <div class="mega-link mega-red"><a href="'.$xlink.$name.'&type=THUMB"><div class="mega-link mega-red"></div></a></div>
                            <a class="fancybox" rel="group" href="'.$img.'" title="'.$name.'"><div class="mega-view mega-red"></div></a>
                        </div>
                    </div>';		
		}
		
		$rp2 = remote_paramload('RCITEMS','adrespath',$this->prpath);
		$rrp2 = $rp2 ? $rp2 : '/images/uphotos/';
		for ($i='A';$i<'Z';$i++) {
		    $img = $rrp2 . $name . $i . $restype;
			$img_uphoto = $this->urlpath . $img;
			if (($img_uphoto) && is_readable($img_uphoto)) {
				$id += 1;
				$ret .= '<div class="mega-entry cat-uphotos cat-all" id="mega-entry-'.$id.'" data-src="'.$img.'" data-lowsize="">
                        <div class="mega-covercaption mega-square-bottom mega-landscape-right mega-portrait-bottom mega-red">
                            <!-- The Content Part with Hidden Overflow Container -->
                            <div class="mega-title"><img src="img/gallery/icons/grid.png" alt="" style="float: left; padding-right: 15px;"/>'.$name.'</div>
                            <div class="mega-date">Lorem ipsun dolor</div>
                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua...<br/><br/><a href="#">Read the whole story</a></p>
                        </div>
                        <!-- The Link Buttons -->
                        <div class="mega-coverbuttons">
                            <div class="mega-link mega-red"><a href="'.$xlink.$name.'&type=UPHOTO&uid='.$i.'"><div class="mega-link mega-red"></div></a></div>
                            <a class="fancybox" rel="group" href="'.$img.'" title="'.$name.'"><div class="mega-view mega-red"></div></a>
                        </div>
						</div>';			
			}
		}
		
		return ($ret);
	}
	
	function delete_photo($title=null) {
		$db = GetGlobal('db');
		$type = GetReq('type');  
		$id = $title ? $title : GetReq('id');
		$uid = null;
		
		$restype = remote_paramload('RCITEMS','restype',$this->prpath);//'.jpg'; 				  		
		  
		//3 sized scaled images
		$photo_bg = remote_paramload('RCITEMS','photobgpath',$this->prpath);		  
		$img_large = $photo_bg ? $this->urlpath ."/images/$photo_bg/" : $thubpath;	  	  
		$photo_md = remote_paramload('RCITEMS','photomdpath',$this->prpath);		  
		$img_medium = $photo_md ? $this->urlpath ."/images/$photo_md/" : $thubpath;	  	  
		$photo_sm = remote_paramload('RCITEMS','photosmpath',$this->prpath);		  
		$img_small = $photo_sm ? $this->urlpath ."/images/$photo_sm/" : $thubpath;	  
			  
		$rp = remote_paramload('RCITEMS','respath',$this->prpath);		
		$rrp = $rp ? $this->urlpath . $rp : $this->urlpath . '/images/thub/';
		$rp2 = remote_paramload('RCITEMS','adrespath',$this->prpath);
		$rrp2 = $rp2 ? $this->urlpath . $rp2 : $this->urlpath . '/images/uphotos/';
		
		switch ($type) {
		    case 'SMALL' : $w = $img_small; break;
			case 'MEDIUM': $w = $img_medium; break;
			case 'LARGE' : $w = $img_large; break;
			case 'THUMB' : $w = $rrp; break;
			case 'UPHOTO': $w = $rrp2; 
			               $uid = GetReq('uid');
			               break;
		    default      : $w = $rrp;
		}

        $pic_file = $w . $id . $uid . $restype;
		
		if (file_exists($pic_file)) {
		  unlink($pic_file);
		  return true;
		}  
		return false;
    }
	
	protected function delete_photodb($size=null) {
		$db = GetGlobal('db');
		$sizetype = $size ? $size : null;   
		$id = GetReq('id');
		

        $sSQL = "delete from pphotos ";
	    $sSQL .= " WHERE code='" . $id . "'";
	    if (isset($sizetype))
	      $sSQL .= " and stype='" . $sizetype . "'";
        else //is null
		  $sSQL .= " and stype=''";
		
        //echo $sSQL; 
	    $resultset = $db->Execute($sSQL);		
		return true;
	}

	protected function add_photo2db($itmcode,$type=null,$size=null) {
	  $itmcode = $itmcode ? $itmcode : GetReq('id');
      $db = GetGlobal('db');	
	  $type = $type ? $type : $this->restype;	  
      $myfilename = $this->encode_image_id($itmcode) . $this->restype;	

	  if (!$this->photodb) return;
	  
		//3 sized scaled images
		$photo_bg = remote_paramload('RCITEMS','photobgpath',$this->prpath);		  
		$img_large = $photo_bg ? $this->urlpath ."/images/$photo_bg/" : $thubpath;	  	  
		$photo_md = remote_paramload('RCITEMS','photomdpath',$this->prpath);		  
		$img_medium = $photo_md ? $this->urlpath ."/images/$photo_md/" : $thubpath;	  	  
		$photo_sm = remote_paramload('RCITEMS','photosmpath',$this->prpath);		  
		$img_small = $photo_sm ? $this->urlpath ."/images/$photo_sm/" : $thubpath;

		//DEFAULT 1 sized photo
        $path = $uphotoid ? remote_paramload('RCITEMS','adrespath',$this->prpath) : 
							remote_paramload('RCITEMS','respath',$this->prpath);		
	  
	  switch ($size) {
	    case "LARGE" :  $photo = $img_large . $myfilename; break;
	    case "MEDIUM":  $photo = $img_medium . $myfilename; break;
        case "SMALL" :  $photo = $img_small . $myfilename; break;
        default      :  $photo = $path . $myfilename;
                        $size = 'LARGE';		
	  }  

	  //echo $photo;	 
	  if (is_readable($photo)) {   
		$sSQL = "select code from pphotos ";
		$sSQL .= " WHERE code='" . $itmcode . "' and type='". $type . "' and stype='". $size ."'";
		//echo $sSQL;
	  
		$resultset = $db->Execute($sSQL,2);	
		$result = $resultset;
		$exist = $db->Affected_Rows();
	  
		$data = base64_encode(@file_get_contents($photo));
	  
	    //65535 chars limit...
		//else keep the file version in images dir...
		if (strlen($data)<65535) {//cuted pic when max that 65535 (text field max width)
	  
			if ($exist) {
				$sSQL = "update pphotos set data='". $data ."'";
				$sSQL .= " WHERE code='" . $itmcode . "' and type='" . $type ."'";
				if (isset($size))
					$sSQL .= " and stype='" . $size . "'";		  		  
			}
			else 
				$sSQL = "insert into pphotos (data,type,code,stype) values ('". $data ."','" . $type ."','" . $itmcode ."','".$size."')";  	  
	
			//echo $sSQL;	
	  
			$db->Execute($sSQL,1);	
			$affected = $db->Affected_Rows();
	  
			if (($affected) && ($this->erase2db))
				unlink($photo); 	
			
		}//limit
		//else
		  // echo '65535 limit!';
	  }//is readable	
	  return ($affected);  	  
	}

	protected function show_photodb($itmcode=null, $stype=null, $type=null) {
      $db = GetGlobal('db');
	  if (!$itmcode) return;
	  $type = $type?$type:$this->restype;
	  	  
      $sSQL = "select data,type,code from pphotos ";
	  $sSQL .= " WHERE code='" . $itmcode . "'";
	  if (isset($type))
	    $sSQL .= " and type='". $type ."'";
	  if (isset($stype))
	    $sSQL .= " and stype='". $stype ."'";		

	  
	  $resultset = $db->Execute($sSQL,2);	
	  $result = $resultset;	  
	  
	  $mime_type = 'image/'.str_replace('.','',$result->fields['type']);
	  //$mime_type = 'image/jpeg';
	  echo $mime_type;
	  //header('Content-type: ' . $mime_type);

	  if ($result->fields['code']) //photo exists
        echo base64_decode($result->fields['data']);
	  else {//additional photo or standart nopic
	    echo null;
      }  
	  
	  die();
	}

	protected function photo2db($notexisted=null) {
      $db = GetGlobal('db');	
	  $i=0;

	  $code = $this->getmapf('code'); 
      $sSQL = "select id,".$code." from products where ";
	  
	  if ($id = GetReq('id')) 
	    $sSQL .= $code . "='" . $id . "' and ";	
	  elseif ($cat = GetReq('cat')) {
	    $cat_tree = explode($this->cseparator,$this->replace_spchars($cat,1));
		
		foreach ($cat_tree as $c=>$cc)
	      $whereClause[] = "cat$c=" . $db->qstr(rawurldecode($this->replace_spchars($cc,1)));	
		  
		$sSQL .= implode(' and ', $whereClause) . ' and ';	  	
	  }	
	  $sSQL .= " itmactive>0 and active>0";	
	  
	  if ($notexisted)
		$sSQL .= " and ". $code . " NOT IN (select code from pphotos)";		  
	  //echo $sSQL;
	  
	  $resultset = $db->Execute($sSQL,2);	
	  $result = $resultset;
	  //print_r($result);	
	  $max_items = $db->Affected_Rows();
	  //echo $max_items;  
	  $this->msg = 'Total items:'. $max_items . '<br>';
	  
	  if (!empty($result)) {		  
	    //echo $i,'>';
	    foreach ($result as $n=>$rec) {
		  //echo $this->attachpath,$rec[$code],'<br>';
		  if ($this->img_large) {//large,medium,small photos	
			
		    $i+= $this->add_photo2db($rec[$code],$this->restype,'SMALL');

		    $i+= $this->add_photo2db($rec[$code],$this->restype,'MEDIUM');

		    $i+= $this->add_photo2db($rec[$code],$this->restype,'LARGE');
          }
          else //one photo
		    $i+= $this->add_photo2db($rec[$code],$this->restype);
		}
	  } 
	  $this->msg .=  $i . ' photos added to dababase.';
	  
	  if (GetReq('editmode')) {
	    die($this->msg);
	  }
	}

	protected function has_photo2db($itmcode=null,$type=null,$stype=null) {
      $db = GetGlobal('db');	
  
      $sSQL = "select code from pphotos ";
	  $sSQL .= " WHERE code='" . $itmcode . "'";
	  if (isset($type))
	    $sSQL .= " and type='". $type ."'";
	  if (isset($stype))
	    $sSQL .= " and stype='". $stype ."'";		

	  //echo $sSQL;
	  $resultset = $db->Execute($sSQL,2);	
	  $result = $resultset;
	  //print_r($result);	
	  
	  $exist = $db->Affected_Rows();
    
	  if ($result->fields[0])//($exits) 
	    return true;
	  
	  return false;
	}	

	protected function ckeditor($mydata=null,$isTemplate=false) {
		$ckattr = $this->ckeditor4 ?
	           "fullpage : true, 
               filebrowserBrowseUrl : '/cp/ckfinder/ckfinder.html',
	           filebrowserImageBrowseUrl : '/cp/ckfinder/ckfinder.html?type=Images',
	           filebrowserFlashBrowseUrl : '/cp/ckfinder/ckfinder.html?type=Flash',
	           filebrowserUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	           filebrowserImageUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	           filebrowserFlashUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
	           filebrowserWindowWidth : '1000',
 	           filebrowserWindowHeight : '700'"	  
	           : 
	           "skin : 'v2', 
			   fullpage : true, 
			   extraPlugins :'docprops',
               filebrowserBrowseUrl : '/cp/ckfinder/ckfinder.html',
	           filebrowserImageBrowseUrl : '/cp/ckfinder/ckfinder.html?type=Images',
	           filebrowserFlashBrowseUrl : '/cp/ckfinder/ckfinder.html?type=Flash',
	           filebrowserUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	           filebrowserImageUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	           filebrowserFlashUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
	           filebrowserWindowWidth : '1000',
 	           filebrowserWindowHeight : '700'";
	 
		$out .= '<div>'; 
		$out .= "<textarea id='htmltext' name='htmltext'>".$this->load_spath($mydata)."</textarea>";	
		$out .= "<script type='text/javascript'> 
	           CKEDITOR.replace('htmltext',
			   {
               $ckattr		   
			   }		   
			   );";	 
        /*
		if ($isTemplate==false)	
			$out .= "			   
	           CKEDITOR.config.fullPage=true;";				   
		*/
		$maximize = 'minimize';	
		$out .= "		   
               CKEDITOR.config.entities = false;
               CKEDITOR.config.entities_greek = false;
               CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;			   
               CKEDITOR.on('instanceReady',
               function( evt )
               {
                  var editor = evt.editor;
                  editor.execCommand('$maximize');
               });
			   </script>"; 
		$out .= '</div>';

		return ($out);	
	}
	
	public function ckeditorAttributes() {
		
		$ckattr = $this->ckeditor4 ?
	           "fullpage : true, 
               filebrowserBrowseUrl : '/cp/ckfinder/ckfinder.html',
	           filebrowserImageBrowseUrl : '/cp/ckfinder/ckfinder.html?type=Images',
	           filebrowserFlashBrowseUrl : '/cp/ckfinder/ckfinder.html?type=Flash',
	           filebrowserUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	           filebrowserImageUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	           filebrowserFlashUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
	           filebrowserWindowWidth : '1000',
 	           filebrowserWindowHeight : '700'"	  
	           : 
	           "skin : 'v2', 
			   fullpage : true, 
			   extraPlugins :'docprops',
               filebrowserBrowseUrl : '/cp/ckfinder/ckfinder.html',
	           filebrowserImageBrowseUrl : '/cp/ckfinder/ckfinder.html?type=Images',
	           filebrowserFlashBrowseUrl : '/cp/ckfinder/ckfinder.html?type=Flash',
	           filebrowserUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	           filebrowserImageUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	           filebrowserFlashUploadUrl : '/cp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
	           filebrowserWindowWidth : '1000',
 	           filebrowserWindowHeight : '700'";
	 
		$out .= "<script type='text/javascript'> 
	           CKEDITOR.replace('htmltext',
			   {
               $ckattr		   
			   }		   
			   );";	 	
		$maximize = 'minimize';	
		$out .= "		   
               CKEDITOR.config.entities = false;
               CKEDITOR.config.entities_greek = false;
               CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;			   
               CKEDITOR.on('instanceReady',
               function( evt )
               {
                  var editor = evt.editor;
                  editor.execCommand('$maximize');
               });
			   </script>"; 
		return ($out);		
	}	
	
	public function itemText($isupdate=null) {
		$type = '.html'; //default type for text attachment
		$cpGet = _v('rcpmenu.cpGet');
		if ($isupdate)
			$id = GetParam('id') ? _m("cmsrt.getRealItemCode use " . GetParam('id')) : 
								   _m("cmsrt.getRealItemCode use " . $cpGet['id']);	
		else
			$id = GetParam('id') ? GetParam('id') : null;
				
		$ret = $id ? $this->has_attachment2db($id,$type,1) : GetParam('htmltext'); 		
		return ($ret);
	}		
	
	public function itemEditor($isupdate=null) {
		$data = $this->itemText($isupdate);
		
		$editor = $this->ckeditor($data);
		return ($editor);
	}	

	public function getSelectedCategory() {
		$db = GetGlobal('db');
		$lan = getlocal();
		$cpGet = _v('rcpmenu.cpGet');
		$scat = $cpGet['cat'];
		$sid = GetReq('id');//_m("cmsrt.getRealItemCode use " . $cpGet['id']);
			
		$sSQL = "select cat2,cat3,cat4,cat5,cat{$lan}2,cat{$lan}3,cat{$lan}4,cat{$lan}5 from categories ";
		if (!empty($this->record)) {//edit mode
			$sSQL.= "where ";
			for($x=0;$x<4;$x++) {
				$ic = $x+2;
				$w[] = "cat{$ic}=" . $db->qstr($this->replace_spchars($this->record["cat{$x}"],1));
			}	
			$sSQL .= implode(' AND ', $w);				
		}
		elseif ($scat) { //new mode		
			//return null;
			
			$sSQL.= "where ";
			$xcat = explode($this->cseparator, $scat);
			foreach($xcat as $i=>$c) {
				$ic = $i+2;
				$w[] = "cat{$ic}=" . $db->qstr($this->replace_spchars($c,1));
			}	
			$sSQL .= implode(' AND ', $w);	
		}
		else 
			return null; 
		
		$res = $db->Execute($sSQL);	
		//echo $sSQL;
		
		foreach ($res as $i=>$rec) {
			$cat = $rec[0];
			$cat.= $rec[1] ? $this->cseparator.$rec[1] : null;
			$cat.= $rec[2] ? $this->cseparator.$rec[2] : null;
			$cat.= $rec[3] ? $this->cseparator.$rec[3] : null;
			
			$tcat = $rec[4];
			$tcat.= $rec[5] ? $this->cseparator.$rec[5] : null;
			$tcat.= $rec[6] ? $this->cseparator.$rec[6] : null;
			$tcat.= $rec[7] ? $this->cseparator.$rec[7] : null;

			$lcat = $rec[7] ? $rec[6].'-&gt'.$rec[7] : ($rec[6] ? $rec[5].'-&gt'.$rec[6] : ($rec[5] ? $rec[4].'-&gt'.$rec[5] :($rec[4] ? $rec[4] : null)));	
			
			$aret[] = "<option value='$cat'>$lcat</option>";
		}	
        $ret = array_unique($aret); 
		return (implode('',$ret));	
	}	
	
	public function getCategories() {
		$db = GetGlobal('db');
		$lan = getlocal();
		$cpGet = _v('rcpmenu.cpGet');
		$scat = $cpGet['cat'];			
		$sid = GetReq('id'); //_m("cmsrt.getRealItemCode use " . $cpGet['id']);
		
		$sSQL = "select cat2,cat3,cat4,cat5,cat{$lan}2,cat{$lan}3,cat{$lan}4,cat{$lan}5 from categories ";	
		if (!empty($this->record)) {//edit mode
			$sSQL.= "where ";
			for($x=0;$x<4;$x++) {
				$ic = $x+2;
				$w[] = ($x<3) ? "cat{$ic}=" . $db->qstr($this->replace_spchars($this->record["cat{$x}"],1)) :
								"cat{$ic}<>" . $db->qstr($this->replace_spchars($this->record["cat{$x}"],1));
			}	
			$sSQL .= implode(' AND ', $w);				
		}
		elseif ($scat) { //new mode		
			$sSQL.= "where ";
			$xcat = explode($this->cseparator, $scat);
			//$depth = count($xcat)-1;
			//$current = array_pop($xcat);
			foreach($xcat as $i=>$c) {
				//if ($i>=$depth) continue;
				$ic = $i+2;
				$w[] = "cat{$ic}=" . $db->qstr($this->replace_spchars($c,1));
			}	
			$sSQL .= implode(' AND ', $w);	
			//$sSQL .= " AND cat{$ic}<>" . $db->qstr($current);
		}		
		$res = $db->Execute($sSQL);	
		//echo $sSQL;
		
		foreach ($res as $i=>$rec) {
			$cat = $rec[0];
			$cat.= $rec[1] ? $this->cseparator.$rec[1] : null;
			$cat.= $rec[2] ? $this->cseparator.$rec[2] : null;
			$cat.= $rec[3] ? $this->cseparator.$rec[3] : null;
			
			$tcat = $rec[4];
			$tcat.= $rec[5] ? $this->cseparator.$rec[5] : null;
			$tcat.= $rec[6] ? $this->cseparator.$rec[6] : null;
			$tcat.= $rec[7] ? $this->cseparator.$rec[7] : null;
			
			$lcat = $rec[7] ? $rec[6].'-&gt'.$rec[7] : ($rec[6] ? $rec[5].'-&gt'.$rec[6] : ($rec[5] ? $rec[4].'-&gt'.$rec[5] :($rec[4] ? $rec[4] : null)));
			
			$aret[] = "<option value='$cat'>$lcat</option>";
		}	
		
		if (!empty($aret)) {
			
			$ret = array_unique($aret);
			return (implode('', $ret));		
		}	
		
		return array();
	}

	protected function add_tags_data($code=null,$title=null,$descr=null,$keywords=null) {
        if (!$code) return;
        $db = GetGlobal('db'); 
	    $lan = getlocal();
	    $itmkeywords = $lan ? 'keywords'.$lan : 'keywords0';
	    $itmdescr = $lan ? 'descr'.$lan : 'descr0'; 
        $itmtitle = $lan ? 'title'.$lan : 'title0';  
  
        $sSQL = "insert into ptags (code,tag,$itmkeywords,$itmdescr,$itmtitle) values (";
	    $sSQL .= $db->qstr($code).",".
	             $db->qstr($title).",".
				 $db->qstr($keywords).",".
				 $db->qstr($descr).",".
				 $db->qstr($title).
				 ")"; 
        //echo $sSQL;
		$result = $db->Execute($sSQL);
        return ($result);		
    }	
  
	protected function upd_tags_data($code=null,$title=null,$descr=null,$keywords=null) {
        if (!$code) return;
        $db = GetGlobal('db'); 
	    $lan = getlocal();
	    $itmkeywords = $lan ? 'keywords'.$lan : 'keywords0';
	    $itmdescr = $lan ? 'descr'.$lan : 'descr0'; 
        $itmtitle = $lan ? 'title'.$lan : 'title0';  
  
        $sSQL = "update ptags set ";
	    $sSQL .= "tag=" . $db->qstr($title).",".
				 "$itmkeywords=" . $db->qstr($keywords).",".
				 "$itmdescr=" . $db->qstr($descr).",".
				 "$itmtitle=" . $db->qstr($title).
				 " where code=" . $db->qstr($code); 
        //echo $sSQL;
		$result = $db->Execute($sSQL);
        return ($result);		
    }
	
	public function getTags() {
		$cpGet = _v('rcpmenu.cpGet');
		$code = GetParam('id') ? _m("cmsrt.getRealItemCode use " . GetParam('id')) : 
								 _m("cmsrt.getRealItemCode use " . $cpGet['id']);	
        if (!$code) return;
		
        $db = GetGlobal('db'); 
	    $lan = getlocal();
	    $itmkeywords = $lan ? 'keywords' . $lan : 'keywords0';
  
        $sSQL = "select $itmkeywords from ptags where code=" . $db->qstr($code);
		$result = $db->Execute($sSQL);
		
        return ($result->fields[0]);		
    }		
	
	protected function add_kategory_data($cat=null) {
        if (!$cat) return;
        $db = GetGlobal('db'); 
	    $lan = getlocal();
	    $lan = $lang ? $lang : getlocal();	
		
	    if (stristr($cat ,$this->cseparator))
			$cats = explode($this->cseparator,$cat);  
		else
			$cats[] = $cat;	
			
		$cat_to_add = array();	
		$loop = 1;
        while (($loop) && (!empty($cats))) {		
			//print_r($cats);

			$sSQL = "select id from categories ";
			$sSQL .= " WHERE cat1='ITEMS' and ";
	        $where = null;
			foreach ($cats as $i=>$c) {
				$id = $i+2;//+2;...root_name added
				$where[] = "cat$id='" . $this->replace_spchars($c,1) . "'";	
			}	 
			$sSQL .= implode(' and ',$where);
			$sSQL .= ' LIMIT 1';// in case of many recs...???'
			//echo $sSQL,'<br/>';
			$resultset = $db->Execute($sSQL,2);	
			//print_r($resultset->fields);
			$retid = $resultset->fields['id'];
			
            $loop = $retid ? 0 : 1;
            if ($loop) {
			    $addcat = array_pop($cats); //prev level sql select			
                $cat_to_add[] = $addcat;//add category for adding 
			}	
        }
		//print_r($cats); //existed cat record 
        //print_r($cat_to_add); //categories to add
        if (!empty($cat_to_add)) {
		
		    $newcats = array_reverse($cat_to_add); //due to array_pop..
			
			/*check for null field before update / insert */
			$cid = $id+1;
			$checkSQL = "select id from categories WHERE ";
			$checkSQL.= "id='$retid' and (cat{$cid}='' or cat{$cid} is NULL)";
			//echo $checkSQL.'<br/>';
			$rset = $db->Execute($checkSQL,2);
			$retid_checked = $rset->fields['id'];
			
		    if (/*(!empty($cats)) &&*/ ($retid_checked)) {//checked
				$sSQL = "update categories set ";
				if (!empty($newcats)) {//new cats
				  foreach ($newcats as $key=>$value) {
					$k = $key+count($cats)+2;
					if ($k<6) //max cat0..5
						$nc[] = "cat{$k}='$value',cat0{$k}='$value',cat1{$k}='$value'";
				  }
				}
				$sSQL .= implode(",",$nc);
				$sSQL .= " where id='$retid' and cat1='ITEMS' and " . implode(' and ',$where);			
			}
			else {
			    $nc = array();
			    $sSQL = "insert into categories set ctgid=1,cat1='ITEMS',cat01='ITEMS',cat11='ITEMS',";
				if (!empty($cats)) {//existed cats when dublicated record
				  foreach ($cats as $key=>$value) {
					$k = $key+count($cats)+1;
					$nc[] = "cat{$k}='$value',cat0{$k}='$value',cat1{$k}='$value'";
				  }
				}
				if (!empty($newcats)) {//new cats
				  foreach ($newcats as $key=>$value) {
				    $k = $key+count($cats)+2;
					if ($k<6) //max cat0..5
						$nc[] = "cat{$k}='$value',cat0{$k}='$value',cat1{$k}='$value'";
				  }
				}
				$sSQL .= implode(",",$nc);
			}
			//echo $sSQL;
			$result = $db->Execute($sSQL);
			return ($result);
        }		
	}	
	
	public function has_attachment2db($itmcode=null,$type=null,$retattachment=null) {
		$db = GetGlobal('db');	
		$lan = getlocal(); //lan handle ?
		$one_attachment = remote_paramload('SHKATALOG','oneattach',$this->path);
		if ($one_attachment) 
			$slan = null;
		else
			$slan = $lan?$lan:'0';	  
		//echo $slan,'>',$itmcode,'>',$this->cseparator;
	  
		//in case of category id search for the last category branch	  
		if (strstr($itmcode,$this->cseparator)) {
			$itmcatdepth = explode($this->cseparator,$itmcode);
			$itmcode = array_pop($itmcatdepth);	  
		}	
	  
		$code = $this->getmapf('code');	  
		$sSQL = "select data,type from pattachments ";
		$sSQL .= " WHERE code='" . $itmcode . "'";
		if (isset($type))
			$sSQL .= " and type='". $type ."'";
		if (isset($slan))
			$sSQL .= " and lan=" . $slan;	
		//echo $sSQL;
	  
		$resultset = $db->Execute($sSQL,2);	
		$result = $resultset;
	  
		//$exist = $db->Affected_Rows();
		foreach ($result as $i=>$rec) {
			$type = $rec['type'];
			$att = $rec['data'];
		}	
	  
		if ($retattachment) {
			$attachment = $att;
			return ($attachment);
		}

		return ($type);
	}	
	
	protected function add_attachment_data($itmcode,$type=null,$data=null) {
		$db = GetGlobal('db');	
		$lan = getlocal(); 
		$one_attachment = remote_paramload('SHKATALOG','oneattach',$this->path);
		$slan = $one_attachment ? null : ($lan?$lan:'0');		
		$type = '.html'; //default type for text attachment	  	  
	  	    
		$sSQL = "select code from pattachments ";
		$sSQL .= " WHERE code='" . $itmcode . "' and type='". $type ."'";
		if (isset($slan))
			$sSQL .= " and lan=" . $slan;	
		//echo $sSQL;
	  
		$resultset = $db->Execute($sSQL,2);	
		$result = $resultset;
		$exist = $db->Affected_Rows();
	  
		if ($exist) {
			$sSQL = "update pattachments set data='". str_replace('<SYN>','+',$data) ."'";
			$sSQL .= " WHERE code='" . $itmcode . "' and type='" . $type ."'";
			if (isset($slan))
				$sSQL .= " and lan=" . $slan;		  		
			//echo $sSQL;	  
		}
		else {
			if (isset($slan))
				$sSQL = "insert into pattachments (data,type,code,lan) values ('". str_replace('<SYN>','+', $data) ."','" . $type ."','" . $itmcode ."',$slan)";
			else
				$sSQL = "insert into pattachments (data,type,code) values ('". str_replace('<SYN>','+',$data) ."','" . $type ."','" . $itmcode ."')"; 	  
		}
	  
		$db->Execute($sSQL,1);	
		$affected = $db->Affected_Rows();

		return ($affected);  	  
	}
	
	protected function delete_item() {
		$db = GetGlobal('db');		
		$lan = getlocal(); 
		$one_attachment = remote_paramload('SHKATALOG','oneattach',$this->path);
		$slan = $one_attachment ? null : ($lan ? $lan : '0');		
		$type = '.html'; //default type for text attachment
		$id = GetReq('id');
		
		//delete product
		$sSQL = "delete from products where {$this->activecode}=" . $db->qstr($id);
		$db->Execute($sSQL);

		//delete ptags
		$sSQL = "delete from ptags where code=" . $db->qstr($id);
		$db->Execute($sSQL);		
		
		//delete pattachment
		$sSQL = "delete from pattachments where code=" . $db->qstr($id) . " and type=". $db->qstr($type);
		if (isset($slan)) $sSQL .= " and lan=" . $slan;			
		$db->Execute($sSQL);		
		
		//delete pb photos
		$sSQL = "delete from pphotos where code=" . $db->qstr($id);	
		$db->Execute($sSQL);		
		
		return true;
	}

	//select templates to publish post with
	public function templates() {
		$t_current_page = GetParam('mctemplate') ? GetParam('mctemplate') : $this->getField('template'); 
		$ppath = $this->prpath . _v('cmsrt.tpath') .'/'. _v('cmsrt.template') .'/'. $this->itmplpath ; 
		
		foreach (glob($ppath . "*.php") as $filename) {
			
			$tf = str_replace(array(".php", $ppath),array('',''), $filename);
			
			$selected = ($tf==$t_current_page) ? 'selected' : null;
			$ret .= "<option value='$tf' $selected>$tf</option>";			
		}
		
		return ($ret);	
	}	
	
	protected function readMCPage($id=null, $templatename=null) {
		if (!$id) return false;
		$db = GetGlobal('db');
		
		$sSQL = "select mcname from wftmpl where mcid=" . $db->qstr($id);
		if ($templatename)
			$sSQL .= " and mctmpl=" . $db->qstr($templatename);
		
		$res = $db->Execute($sSQL);
		
		return ($res->fields[0]);
	}
	
	protected function writeMCPage($id=null, $mcpage=null, $templatename=null) {
		if ((!$id) || (!$mcpage)) return false;	
		$db = GetGlobal('db');
		
		$currentmcpage = $this->readMCPage($id, $templatename);
		
		if ($currentmcpage)
			$sSQL = "update wftmpl set mcname=" . $db->qstr($mcpage);
		else
			$sSQL = "insert into wftmpl (mcid,mcname,mctmpl) values ('$id','$mcpage', '$templatename')";
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		
		return true;
	}	
	
	//select mcpages to publish post with
	public function mcpages() {
		$cpGet = _v('rcpmenu.cpGet');
		$code = GetParam('id') ? _m("cmsrt.getRealItemCode use " .GetParam('id')) : 
								 _m("cmsrt.getRealItemCode use " . $cpGet['id']);
		$curMCPage = $this->readMCPage($code, _v('cmsrt.template'));
		
		$t_current_page = GetParam('mcpage') ? GetParam('mcpage') : $curMCPage;//$this->getMcPage(); 
		$ppath = $this->prpath . _v('cmsrt.tpath') .'/'. _v('cmsrt.template') .'/'. $this->mcpagespath ; 
		
		foreach (glob($ppath . "*.php") as $filename) {
			
			$tf = str_replace(array(".php", $ppath),array('',''), $filename);
			
			$selected = ($tf==$t_current_page) ? 'selected' : null;
			$ret .= "<option value='$tf' $selected>$tf</option>";			
		}
		
		return ($ret);	
	}	
	
	public function getVar($var=null) {
		if (!$var) return null;
		return ($this->{$var});
	}
	
	public function getField($field=null, $scan=false) {
	    $lan = getlocal();
	    $itmname = $lan ? 'itmname' : 'itmfname';
	    $itmdescr = $lan ? 'itmdescr' : 'itmfdescr';		
		if (!$field) return null;
		$ret = null;
		
		if (!empty($this->record)) {
			
		    switch ($field) {
				//2 way call for update form
				case 'itmname'   : return $this->record[$itmname]; break;
				case 'itmdescr'  : return $this->record[$itmdescr]; break;
				
				case 'itmfname'  : return $this->record[$itmname]; break;
				case 'itmfdescr' : return $this->record[$itmdescr]; break;				
				//---
				default : //continue	
			}
			
			if (!$scan)
				return ($this->record[$field]);

		    switch ($field) {				
				case 'itmactive' : $ret = ($this->record[$field]>0) ? 'checked' : null; break;
				case 'active'    : $ret = ($this->record[$field]>0) ? 'checked' : null; break;
				default 		 : $ret = $this->record[$field];
			}
		}
		return $ret;
	}	

	public function cpGet($var=null) {
		$cpGet = _v('rcpmenu.cpGet');
		
		if (!$var) 
			return ($this->replace_spchars($cpGet['cat'],1)); //without special chars
		
		return _m("cmsrt.getRealItemCode use " . $cpGet['id']);
	}
	
	public function viewMessages($var=null) {
		
		foreach ($this->messages as $m=>$msg)
			$ret .= "<option>$msg<option>";
		
		return ($ret);		
	}

	protected function getmapf($name) {
	
		if (empty($this->map_t)) return 0;
	  
		foreach ($this->map_t as $id=>$elm)
			if ($elm==$name) break;
				
		$ret = $this->map_f[$id];
		return ($ret);
	}	
	
	//for utf strings as products code..encode to digits for saving image
	public function encode_image_id($id=null) {
	    if (!$id) return null;

		if ($this->encodeimageid) 
			$out = md5($id);
		else
		    $out = $id;
			
        return $out;
	}		

	protected function replace_spchars($string, $reverse=false) {
	
		switch ($this->replacepolicy) {	
	
			case '_' : $ret = $reverse ?  str_replace('_',' ',$string) : str_replace(' ','_',$string); break;
			case '-' : $ret = $reverse ?  str_replace('-',' ',$string) : str_replace(' ','-',$string);break;
			default :	
			if ($reverse) {
				$g1 = array("'",',','"','+','/',' ',' & ');
				$g2 = array('_','~',"*","plus",":",'-',' n ');		  
				$ret = str_replace($g2,$g1,$string);
			}	 
			else {
				$g1 = array("'",',','"','+','/',' ','-&-');
				$g2 = array('_','~',"*","plus",":",'-','-n-');		  
				$ret = str_replace($g1,$g2,$string);
			}	
	    }
		return ($ret);
	}		

};
}
?>