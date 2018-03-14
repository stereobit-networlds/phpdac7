<?php
$__DPCSEC['CMSRT_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CMSRT_DPC")) && (seclevel('CMSRT_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CMSRT_DPC",true);

$__DPC['CMSRT_DPC'] = 'cmsrt';

$__EVENTS['CMSRT_DPC'][0]='shlangs';
$__EVENTS['CMSRT_DPC'][1]='lang';
$__EVENTS['CMSRT_DPC'][2]='setlanguage';
//$__EVENTS['CMSRT_DPC'][3]='katalog';
//$__EVENTS['CMSRT_DPC'][4]='klist';
//$__EVENTS['CMSRT_DPC'][5]='kshow';
$__EVENTS['CMSRT_DPC'][3]='included_0';
$__EVENTS['CMSRT_DPC'][4]='included_1';
$__EVENTS['CMSRT_DPC'][5]='included_2';
$__EVENTS['CMSRT_DPC'][6]='included_3';
$__EVENTS['CMSRT_DPC'][7]='included_4';
$__EVENTS['CMSRT_DPC'][8]='frontpage';
$__EVENTS['CMSRT_DPC'][9]='captchaimage';

$__ACTIONS['CMSRT_DPC'][0]='shlangs';
$__ACTIONS['CMSRT_DPC'][1]='lang';
$__ACTIONS['CMSRT_DPC'][2]='setlanguage';
$__ACTIONS['CMSRT_DPC'][3]='katalog';
$__ACTIONS['CMSRT_DPC'][4]='klist';
$__ACTIONS['CMSRT_DPC'][5]='kshow';
$__ACTIONS['CMSRT_DPC'][9]= 'captchaimage';

$__DPCATTR['CMSRT_DPC']['shlangs'] = 'shlangs,1,0,0,0,0,0,0,0,0,0,0,1';
$__DPCATTR['CMSRT_DPC']['lang'] = 'lang,0,0,0,0,0,0,0,0,0,0,1';
$__DPCATTR['CMSRT_DPC']['setlanguage'] = 'setlanguage,0,0,0,0,0,0,0,0,0,0,0';

$__LOCALE['CMSRT_DPC'][0]='SHLANGS_DPC;Languanges;Γλώσσα';
$__LOCALE['CMSRT_DPC'][1]='_HOME;Home;Αρχική';

$a = GetGlobal('controller')->require_dpc('cms/cms.dpc.php');
require_once($a); //_r('cms/cms.dpc.php')); not loaded yet

class cmsrt extends cms  {
	
	var $map_t, $map_f, $cseparator, $onlyincategory, $encodeimageid;
	var $imgxval, $imgyval, $image_size_path;
	var $autoresize, $restype, $replacepolicy;	
	var $items, $csvitems;
	
	var $lan_set, $selected_lan, $message;
	var $selectSQL, $fcode, $lastprice, $pager, $itmplpath;	
	var $lan, $itmname, $itmdescr, $itmeter;
	var $picbg, $picmd, $picsm, $home, $cat_result, $isCAttach;
	var $ogTags, $twigTags, $siteTitle, $siteTwiter, $siteFb, $httpurl;	
	var $mtrack, $mbody, $scrollid, $load_mode;
	
	public function __construct() {
	
		cms::__construct();
	  
		$this->owner = GetSessionParam('LoginName');	
		
		$this->map_t = remote_arrayload('RCITEMS','maptitle',$this->prpath);	
		$this->map_f = remote_arrayload('RCITEMS','mapfields',$this->prpath);		
		
		$csep = remote_paramload('RCITEMS','csep',$this->prpath); 
		$this->cseparator = $csep ? $csep : '^';	
		$this->encodeimageid = remote_paramload('SHKATALOGMEDIA','encodeimageid',$this->path);		
		$this->onlyincategory = remote_paramload('SHKATALOGMEDIA','onlyincategory',$this->prpath);
		$this->replacepolicy = remote_paramload('SHKATEGORIES','replacechar',$this->prpath);		
		
		$this->autoresize = remote_arrayload('RCITEMS','autoresize',$this->prpath);
		$this->restype = remote_paramload('RCITEMS','restype',$this->prpath);
		$image_def_xsize = remote_paramload('RCEDITITEMS','imgdefsizex',$this->prpath);		
        $image_def_ysize = remote_paramload('RCEDITITEMS','imgdefsizey',$this->prpath);				
		$this->imgxval = $image_def_xsize ? $image_def_xsize : ((!empty($this->autoresize)) ? $this->autoresize[0] : 0);//90;//as it is
		$this->imgyval = $image_def_ysize ? $image_def_ysize : 0;//90; //as it is	
		
		$this->photodb = remote_paramload('RCITEMS','photodb',$this->prpath);
		
		$ip = remote_paramload('RCCOLLECTIONS','imagepath',$this->prpath); //???
		$ipath = $ip ? $ip : '/images/';
		
		$this->picbg = $ipath . remote_paramload('RCITEMS','photobgpath',$this->prpath);
		$this->picmd = $ipath . remote_paramload('RCITEMS','photomdpath',$this->prpath);
		$this->picsm = $ipath . remote_paramload('RCITEMS','photosmpath',$this->prpath);
		
		$ia = remote_paramload('RCCOLLECTIONS','imageabs',$this->prpath); //???
		if (!$ia) {
			$pt = remote_paramload('RCITEMS','phototype',$this->prpath);	
			$csize = null;//remote_paramload('RCCOLLECTIONS','itemphotosize',$this->prpath);
			$phototype = $csize ? $csize : ( $pt ? $pt : 0); 		
			switch ($phototype) {
				case 3  : $this->image_size_path = $this->picbg; $this->sizeDB = 'LARGE'; break;
				case 2  : $this->image_size_path = $this->picmd; $this->sizeDB = 'MEDIUM'; break;
				case 1  : $this->image_size_path = $this->picsm; $this->sizeDB = 'SMALL'; break;
				case 0  :
				default : $this->image_size_path = $this->picbg; $this->sizeDB = 'LARGE';
			}
        }
		else
			$this->image_size_path = $ipath; //absolute path
		
		$this->items = null;
		$this->csvitems = null;	

		$this->lan_set = arrayload('SHELL','languages');
		$this->message = remote_paramload('SHLANGS','message',$this->path);	
		
		$this->home = localize(paramload('SHELL','rootalias'),$this->lan);
		$this->cat_result = null;
		
		$this->siteTitle = remote_paramload('SHELL','urltitle',$this->path);	
		$this->siteTwitter = remote_paramload('INDEX','twitter', $this->path);	  
		$this->siteFb = remote_paramload('INDEX','facebook', $this->path);
		$this->ogTags = null;	  
		$this->twitTags = null;		
		
		$this->itmeter = 0;
		$this->isCAttach = false;

		$this->itmname = $this->lan ? 'itmname' : 'itmfname';
		$this->itmdescr = $this->lan ? 'itmdescr' : 'itmfdescr';			
		$this->pager = GetReq('pager') ? GetReq('pager') : (GetSessionParam('pager') ? GetSessionParam('pager') : remote_paramload('SHKATALOG','pager',$this->prpath));		
		$this->fcode = $this->getmapf('code');
		$this->lastprice = $this->getmapf('lastprice') ? $this->getmapf('lastprice') : 'xml';		
		$this->selectSQL = "select id,sysins,code1,pricepc,price2,sysins,itmname,itmfname,uniname1,uniname2,active,code4," .
							"price0,price1,cat0,cat1,cat2,cat3,cat4,itmdescr,itmfdescr,itmremark,ypoloipo1,resources,".
							$this->fcode . ',' . $this->lastprice . ",weight,volume,dimensions,size,color,manufacturer,orderid,YEAR(sysins) as year,MONTH(sysins) as month,DAY(sysins) as day, DATE_FORMAT(sysins, '%h:%i') as time, DATE_FORMAT(sysins, '%b') as monthname," .
							"template,owner,itmactive,p1,p2,p3,p4,p5,code2,code3 from products ";	
		$this->itmplpath = 'templates/';	
		
	    $track = $this->paramload('CMS', 'mtrack');
	    $this->mtrack = $track ? $track : "http://www.stereobit.gr/mtrack/";		
		$this->mbody = null; //use for load body as var		
				
	    $this->scrollid = 0;//javascript scroll call meter
		$this->load_mode = 1;	

		$this->javascript();		
	}
	
	public function event($event=null) {
	    $param1 = GetGlobal('param1');	

		//$this->refresh_page_js(); 
		
		switch ($event) {
			case 'captchaimage' : die($this->captchaImage()); break;
			
			case 'frontpage'    : die($this->frontpage()); break;
			case 'included_4'   :
			case 'included_3'   :
			case 'included_2'   :
			case 'included_1'   :
		    case 'included_0'   : die($this->included()); break;				
			
			case "lang"  		: $this->selected_lan = GetParam("langsel"); 
								  $this->refresh_page_js();
								  break;
			case "setlanguage"  : $this->selected_lan = $param1; 
								  break;
			
			case "index"        : 
			default 			: //$this->read_list();
		}
	}
	
	public function action($action=null) { 
		switch ($action) {
			case "lang"         : setlocal($this->selected_lan);
		                          $out = $this->lan_set[$this->selected_lan]; 
								  break;
			case "setlanguage"  : //echo "Current language:",$this->lan_set[$this->selected_lan],"\n";  						
			                      break; 
								  
			case 'kshow'        : if ((!defined('SHKATALOGMEDIA_DPC')) && ($this->userLevelID < 5)) 
									_m("cmsvstats.update_item_statistics use ".GetReq('id'), 1);
			
			                      if (defined('SHKATALOGMEDIA_DPC')) break; else $this->read_item();
			                      $out = (defined('SHKATALOGMEDIA_DPC')) ? null : $this->show_item(); 
								  break;
								  
			case 'klist'        : if ((!defined('SHKATALOGMEDIA_DPC')) &&($this->userLevelID < 5))  
			                         _m("cmsvstats.update_category_statistics use ".GetReq('cat'), 1);
			
			                      $this->isCAttach = $this->get_attachment(GetReq('cat'));
			                      if (defined('SHKATALOGMEDIA_DPC')) break; else $this->read_list(); 
			                      $out = (defined('SHKATALOGMEDIA_DPC')) ? null : $this->list_katalog(); 
								  break;			
			case "index"        : 			
			default 		 	: //$out .= $this->list_katalog(); //call by home page (frontpage func)
		}
		
		return ($out);
	}
	
	//overrite
	protected function javascript() {
        if (iniload('JAVASCRIPT')) {
			
           	$code = $this->createcookie_js();				
			$code.= $this->javascript_ajax();
			$code.= $this->scrolltop_javascript_code();			
			
			if (!strstr($_ENV["SCRIPT_FILENAME"],'/cp/')) {/*CP script, jquery conflict with jqgrid*/	

				switch ($this->load_mode) { 
					case 1 : $code .= $this->scroll_javascript_code(); break;
					case 0 :
					default: $code .= $this->timeout_javascript_code();
				}			
            }
			
		    $js = new jscript;
            $js->load_js($code,"",1);			   
		    unset ($js);		
     	}	  
	}		

	protected function scrollTo() {
		if ($this->mobile) 
			return "new $.Zebra_Dialog('test', {'type':'error','title':'x'});";
		
		return "$('html, body').animate({ scrollTop: sw }, 'slow',function(){ $('html,body').clearQueue();});";
	}
	//http://stackoverflow.com/questions/12260279/scrolltop-not-working-in-android-mobiles
	//http://stackoverflow.com/questions/12225456/jquery-scrolltop-does-not-work-in-scrolling-div-on-mobile-browsers-alternativ
	//if(navigator.userAgent.match(/(iPod|iPhone|iPad|Android)/)) { 
	protected function scrolltop_javascript_code() {
		$mobileDevices = $this->mobileMatchDev();

		$jscroll = <<<SCROLLTOP
function ajaxCall(url,div,goto) {
	$.ajax({ url: url, cache: false, success: function(html){
		$('#'+div).html(html);
	}});
	if (goto) {
		if (/{$mobileDevices}/i.test(navigator.userAgent)) 
			window.scrollTo(0,parseInt($('#'+div).offset().top, 10));
		else 		
			gotoTop(div);  
	}	
}				
function atEnd() {
	if ($(window).scrollTop() + $(window).height() == $(document).height()) 
			return 1; else return 0;
}
function atDiv(div,offset=0,margin=100) {
	if (!div) return atEnd();
	if (($(window).scrollTop() >= $('#'+div).offset().top + offset) &&
		($(window).scrollTop() <= $('#'+div).offset().top + offset + margin))
		return 1; else return 0;	
}
function gotoTop(div) {	
	var sw = (div) ? $('#'+div).offset().top : 0;
	
	$('html, body').animate({ scrollTop: sw }, 'slow', 
	function(){
        $('html,body').clearQueue();
    });
	
	return true;
};

SCROLLTOP;

		return ($jscroll);
    }		
	
    protected function refresh_page_js() {
   
		if (iniload('JAVASCRIPT')) {
			$code = $this->js_refresh();
	   
			$js = new jscript;
			$js->load_js($code,"",1);			   
			unset ($js);
		}   
    } 	
	
    //refresh to set lang
    protected function js_refresh() {
   
		$ret = " 
function neu() {top.frames.location.href = \"index.php\";} 
function goBack() { window.history.back() } 
goBack();
";	 
		return ($ret);
    }	
	
	
	protected function read_list($page=null) {
        $db = GetGlobal('db');	
		$_page = $page ? $page : (GetReq('page') ? GetReq('page') : 0);
		$cat = GetReq('cat');	
		$oper = '='; 			
				     
		$cat_tree = explode($this->sep(), $cat); 
			
	    $sSQL = $this->selectSQL;
		$sSQL .= " WHERE ";		   
		
		if (($cat!=null) && (!is_numeric($cat))) {	//numeric check, when no cat but page - fix !!!!
			if ($cat_tree[0])
				$whereClause .= ' cat0'.$oper . $db->qstr($this->replace_spchars($cat_tree[0],1));		
			elseif ($this->onlyincategory)
				$whereClause .= ' (cat0 IS NULL OR cat0=\'\') ';				  
			if ($cat_tree[1])	
				$whereClause .= ' and cat1'.$oper . $db->qstr($this->replace_spchars($cat_tree[1],1));	
			elseif ($this->onlyincategory)
				$whereClause .= ' and (cat1 IS NULL OR cat1=\'\') ';	 
			if ($cat_tree[2])	
				$whereClause .= ' and cat2'.$oper . $db->qstr($this->replace_spchars($cat_tree[2],1));	
			elseif ($this->onlyincategory)
			 	$whereClause .= ' and (cat2 IS NULL OR cat2=\'\') ';		   
			if ($cat_tree[3])	
				$whereClause .= ' and cat3'.$oper . $db->qstr($this->replace_spchars($cat_tree[3],1));
			elseif ($this->onlyincategory)
				$whereClause .= ' and (cat3 IS NULL OR cat3=\'\') ';
		   		
		    	
		}	
		$sSQL .= $whereClause ? $whereClause . ' and ' : null;
		$sSQL .= " itmactive>0 and active>0";	
		$sSQL .= $this->orderSQL();
		  
		if ($this->pager) {
		    $p = $_page * $this->pager;
		    $sSQL .= " LIMIT $p," . $this->pager; 
		}
		//echo $sSQL;	
	    $this->result = $db->Execute($sSQL);
		return (null);
	}		
	
	protected function list_katalog($linemax=null,$cmd=null,$template=null,$photosize=null,$nopager=null) {
	    $cmd = $cmd ? $cmd : 'klist';
	    $pz = $photosize ? $photosize : 2;	//3	   
	    $xdist = $this->imagex ? $this->imagex:100;
	    $ydist = $this->imagey ? $this->imagey:null;	
        $cat = GetReq('cat');   
	    $page = GetReq('page') ? GetReq('page') : 0;
	    $ogImage = array();

	    $mylinemax = ($linemax) ? $linemax : $this->linemax;   
	    $myimageclick = 1; 
  
        $t = $template ? $template : 'fpkatalog';
	    $mytemplate = $this->select_template($t);			      
	   	
	    if (!empty($this->result)) {
			
			$pp = _m('shkatalogmedia.read_policy',1);		
	
			foreach ($this->result as $n=>$rec) {
	   
				$itemcode   = $rec[$this->fcode];	
				$cat = $this->getkategoriesS(array(0=>$rec['cat0'],1=>$rec['cat1'],2=>$rec['cat2'],3=>$rec['cat3'],4=>$rec['cat4']));
				
				if (defined("SHCART_DPC")) {
					$page       = 0;
					$itemqty    = 1;
					$itemtitle  = $this->replace_cartchars($rec[$this->itmname]);
					$itemdescr  = $this->replace_cartchars($rec[$this->itmdescr]);
					$itemphoto  = $itemcode;
					$itemprice  = ($rec[$pp]>0) ? _m('shkatalogmedia.spt use ' . $rec[$pp],1) : _v('shkatalogmedia.zeroprice_msg');					
					$itemunit   = $rec['uniname2'] ? localize($rec['uniname1'],$this->lan) .'/'. localize($rec['uniname2'],$this->lan) :
											         localize($rec['uniname1'],$this->lan);					
									
					$in_cart = _m("shcart.getCartItemQty use ".$itemcode,1); 
					$icon_cart = _m("shcart.showsymbol use $itemcode;$itemtitle;;;$cat;$page;;$itemphoto;$itemprice;$itemqty;",1);
					$array_cart = _m("shkatalogmedia.read_qty_policy use " . $itemcode . '+'. $itemprice . "+$itemcode;$itemtitle;;;$cat;$page;;$itemphoto;$itemprice;$itemqty",1);	   										
				}			 
		   	

				$itemlink = $this->httpurl . '/' . $this->url('t=kshow&cat='.$cat.'&id='.$itemcode);
				$itemlinkname = $this->url('t=kshow&cat='.$cat.'&id='.$itemcode, $rec[$this->itmname]);		   
				$detailink = $this->httpurl . '/' . $this->url("t=kshow&cat=$cat&id=".$itemcode) . '#details';				
		   		$details = null;
		  											 
				$tokens[] = $itemlinkname;
				$tokens[] = $rec[$this->itmdescr];
				$tokens[] = $this->list_photo($itemcode,$xdist,$ydist,$myimageclick,$cat,$pz,null,$rec[$this->itmname]); 
				$tokens[] = $rec['uniname2'] ? localize($rec['uniname1'],$this->lan) .'/'. localize($rec['uniname2'],$this->lan) :
											   localize($rec['uniname1'],$this->lan); 		  
			  
				$tokens[] = $rec['itmremark'];
				$tokens[] = number_format(floatval($price),$this->decimals,',','.');
				$tokens[] = $cart;
				$tokens[] = null;//_m('shkatalogmedia.show_availability use '. $rec['ypoloipo1'],1);
				$tokens[] = $details;
				$tokens[] = $detailink;
				$tokens[] = $itemcode;
				$tokens[] = $itemlink;	
			  
				$tokens[] = $in_cart  ? $in_cart : '0';
				$tokens[] = $array_cart;

				$tokens[] = $this->get_photo_url($itemcode, $pz);	
				$tokens[] = $rec[$this->lastprice];	
				$tokens[] = $rec[$this->itmname]; 
			  
                $tokens[] = null;   
				$tokens[] = null;//_m('shkatalogmedia.item_has_discount use '. $itemcode,1);
				$tokens[] = "addcart/$itemcode;$itemtitle;;;$cat;$page;;$itemphoto;$itemprice;$itemqty/$cat/$page/";				  
		      
				/*date time */
				$tokens[] = $rec['year'];
				$tokens[] = $rec['month'];
				$tokens[] = $rec['day'];
				$tokens[] = $rec['time'];
				$tokens[] = $rec['monthname'];
				
				$tokens[] = $rec['template'];
				$tokens[] = $rec['owner'];
				$tokens[] = $rec['itmactive'];
				
                //print_r($tokens);
				$items[] = $this->combine_tokens($mytemplate, serialize($tokens), true);

				$ogimage[] = $this->get_photo_url($itemcode,2);
				unset($tokens);			  	 				   	   	   	
			}//foreach 
		  

       	    $ret = implode('', $items);
	        //$ret.= $this->show_paging($cmd,$mytemplate,$nopager);

			$this->ogTags = $this->openGraphTags(array(0=>$this->siteTitle,
		                                           1=>$this->getcurrentkategory(), 
												   2=>str_replace($this->sep(),' ',$this->replace_spchars($cat,1)),														
												   3=>$this->httpurl .'/klist/'. $cat . '/',
												   4=>$ogimage, /*$ogimage array of images (with no httpurl)!!*/
												  ));			

            $this->itmeter = $n+1; 	//echo $this->itmeter;
			
			/*if ($this->load_mode == 1) {
				$ret .= $this->frontpage($page+1, true, "class='tiles'", "section");
			}*/
	    }

	    return ($ret);	
	}		
	
	/*homepage call*/
	/*public function frontpage() {
		$this->read_list();
		return $this->list_katalog(0,'klist','fpkatalog',3);
	}*/
	
	/*ajax loading call after first loading*/
	public function frontpage($page=null, $enable_ajax=false, $divargs=null, $divname=null) {	
		$param = $page ? $page : $_GET['param'];
		
		if ($enable_ajax) {
			$out = $this->get_scrollid(get_class($this),'frontpage', "$param", $divargs, $divname, false); 		
			return ($out);
		}

		$this->read_list($param);
		$out = $this->list_katalog(0,'klist','fpkatalog',3);
		
		return ($out);		
	}	
	
	public function nextpage() {
		$cat = GetReq('cat') ? GetReq('cat') : '0'; //dummy numeric		
		$page = ($this->itmeter < $this->pager) ? intval(GetReq('page')) : + intval(GetReq('page')) + 1;
		$next = $this->url('t=klist&cat='.$cat.'&page='.$page);
		return ($next);
	}
	
	public function prevpage() {
		$cat = GetReq('cat') ? GetReq('cat') : '0'; //dummy numeric	
		$page = (GetReq('page')>0) ? intval(GetReq('page')) - 1 : 0;
		$prev = $this->url('t=klist&cat='.$cat.'&page='.$page);
		return ($prev);
	}	
	
	public function isLastPage() {
		return ($this->itmeter < $this->pager) ? true : false;
	}
	
	public function orderSQL() {
		$page = GetReq('page') ? GetReq('page') : 0;
		
		$sSQL = " ORDER BY id desc";	
		/*if ($this->pager) {
		    $p = $page * $this->pager;
		    $sSQL .= " LIMIT $p,". $this->pager; 
		}	*/	
		return ($sSQL);
	}
	
	protected function read_item($direction=null,$item_id=null) {
        $db = GetGlobal('db');	
		$item = $item_id ? $item_id : GetReq('id');
		$cat = GetReq('cat');				  	
		
	    $sSQL = $this->selectSQL;	
		$sSQL .= " WHERE ". $this->fcode . "=" . $db->qstr($item);	   
	    $sSQL .= " LIMIT 1";
	   
	    $resultset = $db->Execute($sSQL,2);
	    $this->result = $resultset; 	   
	   
	    return (null);//$resultset);   
	}		
	
	protected function show_item($template=null,$no_additional_info=null,$lang=null,$lnktype=1,$pcat=null,$boff=null,$tax=null) {
	    $cat = $pcat ? $pcat : GetReq('cat'); 	
        $page = GetReq('page') ? GetReq('page') : 0;		
	    $id = GetReq('id');
	    $ogimage = array();
	   
	    $mytemplate = $this->select_template('fpitem');	 
	   
	    if (count($this->result->fields)>1) {	
	   
			$pp = _m('shkatalogmedia.read_policy',1);	   
	   
			foreach ($this->result as $n=>$rec) {
						 
				$itemcode   = $rec[$this->fcode];		 
				$cat = $this->getkategoriesS(array(0=>$rec['cat0'],1=>$rec['cat1'],2=>$rec['cat2'],3=>$rec['cat3'],4=>$rec['cat4']));	      			      		   
				
				if (defined("SHCART_DPC")) {
					$page       = 0;
					$itemqty    = 1;
					$itemtitle  = $this->replace_cartchars($rec[$this->itmname]);
					$itemdescr  = $this->replace_cartchars($rec[$this->itmdescr]);
					$itemphoto  = $itemcode;
					$itemprice  = ($rec[$pp]>0) ? _m('shkatalogmedia.spt use ' . $rec[$pp],1) : _v('shkatalogmedia.zeroprice_msg');					
					$itemunit   = $rec['uniname2'] ? localize($rec['uniname1'],$this->lan) .'/'. localize($rec['uniname2'],$this->lan) :
											         localize($rec['uniname1'],$this->lan);					
									
					$in_cart = _m("shcart.getCartItemQty use ".$ritemcode,1); 
					$icon_cart = _m("shcart.showsymbol use $itemcode;$itemtitle;;;$cat;$page;;$itemphoto;$itemprice;$itemqty;+$cat+$page",1);
					$array_cart = _m("shkatalogmedia.read_array_policy use " . $itemcode . '+'. $itemprice . "+$itemcode;$itemtitle;;;$cat;$page;;$itemphoto;$itemprice;$itemqty",1);	   										
				}	
				
				$itemlink = $this->url('t=kshow&cat='.$cat.'&page='.$page.'&id='.$itemcode); 	 	   
				$linkphoto = $this->list_photo($itemcode,null,null,$lnktype,$cat,2,3,$rec[$this->itmname]);	
				$detailink = $this->url("t=kshow&cat=$cat&page=$page&id=".$itemcode) . '#details';							 
				$details = null;
		 		   
				//// tokens method												 
				$tokens[] = $rec[$this->itmname];
				$tokens[] = $rec[$this->itmdescr];
				$tokens[] = $linkphoto; 
				$tokens[] = $itemunit;		 
				$tokens[] = $rec['itmremark'];
				$tokens[] = number_format(floatval($price),$this->decimals,',','.');
				$tokens[] = $icon_cart; //6
				$tokens[] = _m('shkatalogmedia.show_availability use '. $rec['ypoloipo1'],1);
				$tokens[] = $detailink;
				$tokens[] = $details;
				$tokens[] = $itemcode;
				$tokens[] = $in_cart ? $in_cart : '0';
				$tokens[] = $array_cart;
				$tokens[] = $this->get_attachment($itemcode);
				$tokens[] = '';  			 
				$tokens[] = '';
			 
				$tokens[] = $rec[$this->lastprice];	
				$tokens[] = $this->get_photo_url($itemcode,1);
				$tokens[] = $this->get_photo_url($itemcode,2);			 
				$tokens[] = $this->get_photo_url($itemcode,3);			 
			 
				$tokens[] = $rec['weight'];
				$tokens[] = $rec['volume'];
				$tokens[] = $rec['dimensions'];
				$tokens[] = $rec['size'];
				$tokens[] = $rec['color'];	
			 
				$tokens[] = null;
				$tokens[] = _m('shkatalogmedia.item_has_discount use '. $itemcode,1);
				$tokens[] = "addcart/$itemcode;$itemtitle;;;$cat;$page;;$itemphoto;$itemprice;$itemqty/$cat/$page/";			 
			 
				$tokens[] = $rec['code1'];
				$tokens[] = $rec['code4'];
				$tokens[] = $rec['resources']; //id=30
				$tokens[] = $rec['ypoloipo1'];
				$tokens[] = $rec['manufacturer'];	
			 
				/*date time */
				$tokens[] = $rec['year'];
				$tokens[] = $rec['month'];
				$tokens[] = $rec['day'];
				$tokens[] = $rec['time'];
				$tokens[] = $rec['monthname'];

				$tokens[] = $rec['template'];
				$tokens[] = $rec['owner'];
                $tokens[] = $rec['itmactive'];				
			 
				//print_r($tokens);
				if ($itmpl = $rec['template']) {
					$out = $this->_ct($this->itmplpath . $itmpl, serialize($tokens), true);
					//$this_item_template = _m('cmsrt.select_template use ' . $this->itmplpath . $itmpl);
					//$out = $this->combine_tokens($this_item_template, $tokens, true);
				}	
				else	
					$out = $this->combine_tokens($mytemplate, serialize($tokens), true);
			 
				$ogimage[] = $this->get_photo_url($itemcode,2);
			 
				$this->ogTags = $this->openGraphTags(array(0=>$this->siteTitle,
														1=>$tokens[0],
														2=>$tokens[1],														
														3=>$itemlink,
														4=>$ogimage[0],
													));				 
			 
				unset($tokens);	 
			}	   
	    }
   
	    return ($out);	
	}

    protected function get_data_info() { 
		$item = GetReq('id');	
		$cat = GetReq('cat');	

		$mytree = $this->cat_result;
		$thetree = (!empty($mytree))?implode(',',$mytree):null;		
		
	    if ($item) {
			$this->item = $this->result->fields[$this->itmname];
			$this->descr = $this->result->fields[$this->itmdescr];
			$this->price = null;//$this->result->fields[$ppol];
			$kwords = str_replace(' ',',',$this->item) . ',' ;
			$kwords.= $thetree;
			$this->keywords = str_replace(',,',',', $kwords);
		}
		elseif ($cat) {
			$cc = explode($this->sep(), $cat);
			$xcat = array_pop($cc);
			$this->item = (!empty($mytree))? array_pop($mytree) : $this->replace_spchars($xcat,1);
			$this->descr = $this->item .',' . $thetree;
			$this->price = null;
			$this->keywords = $this->item . ',' . $thetree;		
		}
        else { //front page
			$this->item = null;
			$this->descr = $this->paramload('INDEX','meta-description');
			$this->price = null;
			$this->keywords = $this->paramload('INDEX','meta-keywords');			
        }		
   }	
	
    public function get_page_info($key=null,$defkey=null) {
		$meta_title = ($defkey=='NULL') ? null : ($defkey ? $defkey : $this->paramload('INDEX','title'));
		$meta_descr = ($defkey=='NULL') ? null : ($defkey ? $defkey : $this->paramload('INDEX','meta-description'));
		$meta_keywords = ($defkey=='NULL') ? null : ($defkey ? $defkey : $this->paramload('INDEX','meta-keywords'));			
   	   
		if ($key=='item') 
			return ($this->item ? $this->item :$meta_title);	 
		elseif ($key=='descr')
			return ($this->descr ? $this->descr :$meta_descr);	
		elseif ($key=='keywords')
			return ($this->keywords ? $this->keywords :$meta_keywords);
		elseif ($key=='tag')
			return ($this->itmtag ? $this->itmtag :null);			 
		else 
			return (null);
    }
   
    protected function analyzedir($group,$startup=0,$isroot=false) {
	    $db = GetGlobal('db');	
	    $f = $this->lan;			
        $adir = array();
		
	    if ($isroot) {
			$depth = 1;			
			$sSQL = "select distinct cat2,cat{$f}2 from categories where ";
			$sSQL .= "(ctgid>0 and active>0 and view>0) order by ctgid";
			//$sSQL .= "ctgid>0 order by ctgid";
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
	  
			$splitx = explode ($this->sep(), $group);   
		
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
		}	  
        
        //return ($adir);
		return ($adir);
    }	
	
    protected function view_analyzedir($cmd=null,$prefix=null,$startup=0,$nolinks=null,$isroot=false) { 	
		$t = $cmd ? $cmd : GetReq('t');	
		
		$g = $this->replace_spchars(GetReq('cat'));	   	
		if ($prefix) 
			$mytokens[] = $prefix;

		//analyze dir		
        $adirs = $this->analyzedir($g, $startup, $isroot);	

        if (!empty($adirs)) {			
		
		    //startup meters
		    $max = count($adirs)-1; 
		    $m = ($startup) ? 1 : 0;		
			$m2 = 0;		 	
		    foreach ($adirs as $id=>$cname) {	
				if ($isroot) $curl = null; //reset
				$locname = $cname;	
			  
				if ($m2<=$max) { //< .......... link last element 
			  
					if ($m2==$max)
						$title = "<b>$locname</b>";
					else  
						$title = "$locname";			  
			  
					if ($cname != $this->home) {
				
						if (($m2>$m)&&(!$isroot)) 
							$curl .= $this->cseparator . $this->replace_spchars($id);
						else 
							$curl .= $this->replace_spchars($id);
					  
						$mygroup = $curl;
			   
						$a = $this->url("t=$t&cat=$mygroup");
						$b = "<a href=\"" . $this->url("t=$t&cat=$mygroup") . "\">" . $locname . "</a>";
					}	
					else {
						$a = seturl("t=");
						$b = "<a href=\"" . seturl("t=") . "\">" . $locname . "</a>";					
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

    public function tree_navigation($cmd=null,$prefix=null,$home=0,$tmpl=null) {
        $t = $tmpl ? $tmpl : 'fpkatnav';
		$mytemplate = $this->select_template($t);
		
		$navdata = $this->view_analyzedir($cmd,$prefix,null,null,true);
		
		if (!empty($navdata)) { 
			foreach ($navdata as $n=>$data) {
				$tdata = explode('@',$data);
				$tok[] = $tdata[0]; //url
				$tok[] = $tdata[1]; //title
				$tok[] = $tdata[2];
				//$tok[] = ($n==count($navdata)-1) ? 1 : 0; //for root
				$tokens[] = $this->combine_tokens($mytemplate, serialize($tok), true);
				unset($tok);
			}    
			$out = implode('',$tokens); 
		}

		return ($out);
    }	

	public function getcurrentkategory($toplevel=null, $url=null) {
	  $g = $this->replace_spchars(GetReq('cat'));	
      $mycattree = $this->analyzedir($g);	
		
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
			          $title = array_pop($mycattree);
		              $ret = $this->url('t=klist&cat='. GetReq('cat'), $title);
				   }	  
                   else 
		              $ret = array_pop(array_reverse($mycattree));	  
		}
	  }	
	  else {//actual
	    if ($url) {
		  $title = array_pop($mycattree);	
		  $ret = $this->url('t=klist&cat='. GetReq('cat'),$title);
		}  
        else	  
	      $ret = array_pop($mycattree);	  	
	  }
  
	  return ($ret);
	}

	public function getcurrentkategoryAttachment($type=null,$nolan=null) {
		
		return ($this->isCAttach); //$this->get_attachment(GetReq('cat'), $type, $nolan);
	}		

	protected function get_photo_url($code, $photosize=null) {
		$db = GetGlobal('db');
		if (!$code) return;  

		switch ($photosize) {
	       case 3  : $tpath = $this->picbg;
		             $stype = $this->imgLargeDB ? $this->imgLargeDB : 'LARGE';
		             break;	   
	       case 2  : $tpath = $this->picmd; 
		             $stype = $this->imgMediumDB ? $this->imgMediumDB : 'MEDIUM';
		             break;	   
	       case 1  : $tpath = $this->picsm;
                     $stype = $this->imgSmallDB ? $this->imgSmallDB : 'SMALL';		   
		             break;
	       default : $tpath = $this->picbg;	
                     $stype = '';		   
		}

		if ($interface = $this->photodb) { 
			if (is_numeric($interface))	  
				$photo = seturl('t=showimage&id='.$code.'&type='.$stype);
			else  
				$photo = $interface . '?id='.$code.'&type='.$stype;
		}
		else {//ordinal image
	  
			$code = $this->encode_image_id($code, $this->encodeimageid); 		  
			$pfile = $code;
			$photo_file = $this->urlpath . '/' .$tpath .'/'. $pfile . $this->restype;	  
			if (!file_exists($photo_file)) {
				$photo = $this->httpurl . $tpath . '/nopic' . $this->restype;	
			}
			else {
				$photo = $this->httpurl . $tpath . '/'. $pfile . $this->restype;	
			}  
	    }
	   
	    return ($photo);	 	
	}	
	
	protected function list_photo($code,$x=100,$y=null,$imageclick=1,$mycat=null,$photosize=null,$clickphotosize=null,$altname=null) {	
	    $cat = $mycat ? $mycat : GetReq('cat');  
	    $a_name = $altname ? $altname : $code;   
	   
	    $photo = $this->get_photo_url($code,$photosize);//define size
	   
	   	   
	    if (($imageclick==null) || ((is_numeric($imageclick)) && ($imageclick>=0))) {
	    
			if ($imageclick==1) {//phot url	
				$clickphoto = $clickphotosize ? $this->get_photo_url($code,$clickphotosize):
												$this->get_photo_url($code,$photosize);
		   
				$plink = "<A href=\"$photo\">";

				$lo = "<img src=\"" . $photo . "\"";
				$lo.= $y ? "height=\"$y\"" : null; 
				$lo.= "border=\"0\" alt=\"$a_name". localize('_IMAGE',$this->lan) . "\">" . "</A>"; 
				$ret = $plink . $lo;
			}
			elseif ($imageclick==2) {//product url
		  
				$myresource = "<img src=\"" . $photo . "\"";
				$myresource.= "alt=\"$a_name". localize('_IMAGE',$this->lan) . "\">";
		  
				$purl = $this->url("t=kshow"."&cat=".$cat."&id=".$code); 
				$plink = "<a href=\"$purl\">";
				$ret = $plink . $myresource . "</a>";           
			}
			elseif ($imageclick==0) {//item link
		  
				$myresource = "<img src=\"" . $photo . "\"";
				$myresource.= "alt=\"$a_name". localize('_IMAGE',$this->lan) . "\">";
				$ret = $this->url('t=kshow&cat='.$cat.'&page='.$page.'&id='.$code,$myresource);
			} 
			else {//item link
		  
				$myresource = "<img src=\"" . $photo . "\"";
				$myresource.= "alt=\"$a_name". localize('_IMAGE',$this->lan) . "\">";		  
				$ret = $this->url('t=kshow&cat='.$cat.'&page='.$page.'&id='.$code,$myresource);
			} 
		}
		else {
			$plink = "<a href=\"$imageclick\">";
			$ret = $plink . "<img src=\"" . $photo . "\"" . "></a>";           		
	    } 	   		
		
	    return ($ret);
	}		

	public function replace_cartchars($string) {
		if (!$string) return null;

		$g1 = array("'",',','"','+','/',' ','-&-');
		$g2 = array('_','~',"*","plus",":",'-','-n-');		
	  
		return str_replace($g1,$g2,$string);
	}	
	
	public function getkategoriesS($categories) {	
		if (empty($categories)) return null;	
		$c = $this->sep();
		$g1 = array("'",',','"','+','/',' ','-&-');
		$g2 = array('_','~',"*","plus",":",'-','-n-');		
		
		foreach ($categories as $i=>$cat)
			if ($cat) $xc[] = str_replace($g1,$g2,$cat);
			
		$ret = (empty($xc)) ? null : implode($c, $xc);
		return ($ret);
	}	
	
	public function sep() {
		return $this->cseparator; 
	}	
	
	protected function openGraphTags($tokens=null) {
		if (!$tokens) return null;
		$localization = ($this->lan==1) ? 'el_gr' : 'en_us';
		
		//multiple images
		if (is_array($tokens[4])) { 
		    //print_r($tokens[4]);
			foreach ($tokens[4] as $i=>$img)
				$ogimage .= '
		<meta property="og:image" content="'. $img .'" />';
		}
		else
			$ogimage = '<meta property="og:image" content="'.$tokens[4].'" />
';
		
		$ret = <<<EOF
				
		<meta property="og:site_name" content="$tokens[0]" />		
		<meta property="og:title" content="$tokens[1]" />
		<meta property="og:description" content="$tokens[2]" />
		<meta property="og:type" content="product" />
		<meta property="og:url" content="$tokens[3]" />
	    <meta property="og:locale" content="$localization"/>		
		$ogimage
		
EOF;
		
        //extract first image or just one
        $img = is_array($tokens[4]) ? array_shift($tokens[4]) : $tokens[4];

        $ret .= $this->fbTags(array(0=>$tokens[0],1=>$tokens[1],2=>$tokens[2],3=>$tokens[3],4=>$img)) ;//$tokens);
		$ret .= $this->twitterTags(array(0=>$tokens[0],1=>$tokens[1],2=>$tokens[2],3=>$tokens[3],4=>$img)) ;//$tokens);
		$ret .= $this->ldTags(array(0=>$tokens[0],1=>$tokens[1],2=>$tokens[2],3=>$tokens[3],4=>$img)) ;//$tokens);
		
        return $ret;
	}
	
	public function getOGTags() {
		
		return ($this->ogTags);
	}
	
	//The card type, which will be one of summary, summary_large_image, photo, gallery, product, app, or player			
	protected function twitterTags($tokens=null) {
		if (!$tokens) return null;
		
		$twitter = explode('/', $this->siteTwitter); 
		$taddr = '@' . array_pop($twitter); //get last token
		
		$ret = <<<EOF
		
		<meta name="twitter:widgets:csp" content="on">
		<meta name="twitter:card" content="product">
		<meta name="twitter:site" content="$taddr">
		<meta name="twitter:domain" content="$tokens[0]">
		<meta name="twitter:title" content="$tokens[1]">
		<meta name="twitter:description" content="$tokens[2]">
		<meta name="twitter:image" content="$tokens[4]" />	
		
EOF;
        return $ret;
	}
	
	protected function fbTags($tokens=null) {
		if (!$tokens) return null;
		
		$fb = explode('/', $this->siteFb); 
		$fbaddr = array_pop($fb); //get last token
		
		//$fbid = _v('cmslogin.facebook_id');
		$fbid = $this->paramload('CMS', 'fbid'); 
		$ret = <<<EOF
		
	    <meta property="fb:app_id" content="$fbid" />
		<meta property="fb:admins" content="$fbattr" />	
EOF;
        return $ret;
	}	
	
	protected function ldTags($tokens=null) {
		if (!$tokens) return null;
		
		$kw = _m('shtags.get_page_info use keywords', 1);
		$keywords = str_replace(',""','' , '"' . str_replace(',', '","', $kw) . '"');
		
		$ret = <<<EOF
		
		<script type="application/ld+json">
		{
		"@context": "http://schema.org",
		"@type": "Product",
		"name": "$tokens[1]",
		"description: "$tokens[2]",
		"image:" "$tokens[4]", 
		"url": "$tokens[3]",
		"keywords": [$keywords]
		}
		</script>	
EOF;
        return $ret;
	}

	
	
	public function show_lastincat($items=10,$linemax=null,$template=null,$photosize=null,$category=null,$ascdesc=null) {
        $db = GetGlobal('db');		
		$mycat = $category ? $category : GetReq('cat');	   		
		$pz = $photosize ? $photosize : 1;		

        $sSQL = $this->selectSQL;
		$sSQL .= " WHERE ";	
		
		$cat = explode($this->sep(),$mycat);			
		foreach ($cat as $i=>$c) {
		  $myc = $this->replace_spchars($c,1);		
		  $sSQL .= " cat{$i}='$myc' and ";	
		}  
		//only items inside category ..when category param not specified
	    /*if ((!$category) && ($this->onlyincategory)) {
		  $ii = $i+1;
		  $sSQL .= " (cat{$ii} IS NULL or cat{$ii}='') and ";		
		} */ 		

		if ($selected_item = GetReq('id')) 
		  $sSQL .= $this->fcode . " not like '" . $selected_item ."' and ";
		  		
		$sSQL .= "itmactive>0 and active>0";	
		$mysort = ($ascdesc=='ASC') ? 'ASC' : 'DESC'; 
		$sSQL .= " ORDER BY datein " . $mysort;	
		$sSQL .= $items ? " LIMIT " . $items : null;			

	    $resultset = $db->Execute($sSQL,2);	
		$this->result = $resultset;	
		
        $out = $this->list_katalog(null,null,$template,$pz);
		  
		return ($out);	
	}		
	
	public function show_menu_items($items=10,$linemax=null,$template=null,$photosize=null,$menu=null) {
        $db = GetGlobal('db');	
		$pz = $photosize ? $photosize : 1;	
		
		if (defined('CMSMENU_DPC')) {
			
			$list = _m('cmsmenu.readMenuElements use ' . $menu, 1);
			if (empty($list)) return null;
			$menulist = implode("','",$list);
			
			$sSQL = $this->selectSQL;
			$sSQL .= " WHERE ";	
			$sSQL .= $this->fcode . " in ('". $menulist ."') and itmactive>0 and active>0";
			$sSQL .= " ORDER BY FIELD({$this->fcode}, '". $menulist ."')";
			$sSQL .= $items ? " LIMIT " . $items : null;	

			$resultset = $db->Execute($sSQL);	
			$this->result = $resultset;	
		
			if ($linemax>1)
				$out = $this->list_katalog_table($linemax,null,$template,$pz);
			else  	
				$out = $this->list_katalog(null,null,$template,$pz);		
		}
		
		return ($out);
	}	
	
	
   
	public function renderTemplate($id=null, $items=null, $fsave=null, $fcode=null, $limit=null, $menu=null) {
		$db = GetGlobal('db');		
		if (!$id) return null;
	
		$sSQL = "select id,name,descr,data,code,script,objects from cmstemplates where ";
		$sSQL.= is_numeric($id) ? "id=" . $id : "name = '$id'";
		$res = $db->Execute($sSQL);			
		$form = base64_decode($res->fields['data']);		
		$code = base64_decode($res->fields['code']);
		$script = base64_decode($res->fields['script']);
		$objects = $items ? $items : $res->fields['objects'];
		$template = $res->fields['name'];
		$descr = $res->fields['descr'];

		if (strstr($code, '>|')) { //pattern code
			$ret = $this->renderPattern($template, $form, $code, $script, $objects, $fsave, $fcode, $limit, $menu);
		}
		else 
		    $ret = $this->renderTwing($template, $form, $code, $script, $objects, $fsave, $fcode, $limit, $menu);	
	
		return ($ret);
		
	}

	protected function renderPattern($template, $form=null, $code=null, $script=null, $items=null, $fsave=null, $fcode=null, $limit=null, $menu=null) {
		$db = GetGlobal('db');	
		if (!$template) return false;
		
		$this->items = $this->get_items($items, $limit, $fcode, $menu);
		//print_r($this->items);
		
		if (strstr($code, '>|')) {
		//if ($code)  {
			$pf = explode('>|',$code);
			
			//search last edited line
			foreach ($pf as $line) {
				if (trim($line)) {
					$joins = explode(',', array_pop($pf)); 
					break;
				}
			}
			
			//rest lines
			foreach ($pf as $line) 
				$subtemplates .= trim($line);

			$_pattern[0] = explode(',', $subtemplates);
			$_pattern[1] = (array) $joins;			

			//render pattern
			if ((!empty($this->items)) && (!empty($_pattern[1]))) {
				$pattern = (array) $_pattern[0];
				$join = (array) $_pattern[1];				

				//render
				$out = null;
				$tts = array();
				$gr = array();
				$itms = array();
				$cc = array_chunk($this->items, count($pattern));//, true);

				foreach ($cc as $i=>$group) {
					foreach ($group as $j=>$child) {
						//echo $pattern[$j] . '<br>';
						//echo "<!--{$pattern[$j]}-->\r\n";
						$tts[] = $this->ct($pattern[$j], serialize($child), true);
						if ($cmd = trim($join[$j])) {
							//echo $join[$j] . '<br>';
							//echo "<!--{$join[$j]}-->\r\n";
							switch ($cmd) {
							    case '_break' : $out .= implode('', $tts); break;
								default       : $out .= $this->ct($cmd, serialize($tts), true);		
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
		
		$sSQL = "select data,class from cmstemplates where name=" . $db->qstr($template.'-sub');
		$res = $db->Execute($sSQL);
		//echo $sSQL;	
		if (isset($res->fields['data'])) {			
			$itms[] = (!empty($gr)) ? implode('',$gr) : null; 
			if (!empty($itms))	{		
				$encdata = base64_decode($res->fields['data']);
				$ret = $this->combine_tokens($encdata, serialize($itms), true);
			}	
		}	
		else
			$ret = (!empty($gr)) ? implode('',$gr) : null;
		
		//echo $template.'-sub:' . $ret;				
		$data = ($ret) ? str_replace('<!--?'.$template.'-sub'.'?-->', $ret, $form) : $form;
		
		if ($script) {
			//create dynamic phpdac page		
			if ($fsave) {
				//save template file with pattern data
				$saved = @file_put_contents($this->urlpath .'/cp/'.$this->tpath."/".$res->fields['class'].'/pages/'.$fsave, 
				   		  preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $data));
						  
				$page = $script; //script data		  
			}	
			else
				$page = $data; //generated data		
		}
		else {
			//create static page
			$page = $data; //generated data
		}
		
		if ($fsave) {
			$ret = @file_put_contents($this->urlpath . '/' . $fsave, 
			        preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $page));
			return $ret;
		}	
		else
			return $page;			
	}

	protected function getcsvItems($items=null) {
		if (!is_array($items)) return false;

		//csv array of fields
		foreach ($items as $i=>$rec) {
			$ritems[] = implode(';', $rec);
		}	
			
		return $ritems; 	
	}	

	protected function renderTwing($template, $form=null, $code=null, $script=null, $items=null, $fsave=null, $fcode=null, $limit=null, $menu=null) {
		$db = GetGlobal('db');	
		if (!$template) return false;		
		
		if (defined('TWIGENGINE_DPC')) {
				
			//save db form into temp file
			$twigpath = $this->prpath . $this->tpath .'/'. $this->template .'/' ; 
			$tempfile = 'crmform-cache-' . urlencode(base64_encode($template)) . '.html';

			if (@file_put_contents($twigpath . $tempfile, $form)) {
				
				//csvitems var
				$this->csvitems = $this->getcsvitems($this->get_items($items, $limit, $fcode, $menu));

				$t = array('mydate'=>date('m.d.y'));
							
				$tokens = serialize($t);
				$ret = _m('twigengine.render use '.$tempfile.'++'.$tokens, 1);
			}
			else
				$ret = 'twig cache error!';
		}
		else 
			$ret = $form;

		if ($script) {
			//create dynamic phpdac page
			$page = $data;
		}
		else {
			//create static page
			$page = $data;
		}
		
		if ($fsave) {
			$ret = @file_put_contents($this->urlpath . '/' . $fsave, 
			        preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $page));
			return $ret;
		}	
		else
			return $page;		
		
		return ($ret);
	}
	
	protected function _get_items($preset=null, $limit=null, $usecode=null, $usemenu=null) {
        $db = GetGlobal('db');		
		$tid = GetReq('id') ? GetReq('id') : $preset; //$preset ? $preset : GetReq('id');	
		$uid = 'id';
		
		$sSQL = $this->selectSQL . " WHERE ";		
 
		if (isset($usemenu)) {  
			$uid = $usecode ? $usecode : $this->fcode; //usecode, by default active code
			$tid =  implode("','", _m('cmsmenu.readMenuElements use ' . $usemenu, 1)); //override value
			$sSQL .=  (strstr($tid, ',')) ?  " $uid in ('" . $tid . "')" : "$uid=" . $db->qstr($tid);
			$sSQL .= " ORDER BY " . "FIELD($uid,'".  $tid ."')";  //orderid
			//echo $sSQL;
		}				
		elseif (isset($tid)) {
			if (strstr($tid, '.')) { //tree id
				$treeSQL = "select code from ctreemap WHERE tid=" . $db->qstr($tid);	
				$sSQL .=  ' id in (' . $treeSQL . ')';	
			}	
			else {
				$uid = $usecode ? $usecode : 'id'; //if no tree code field is selectable
				$sSQL .=  (strstr($tid, ',')) ?  " $uid in (" . $tid . ")" : "$uid=" . $tid;		
			}
			$sSQL .= " ORDER BY " . "FIELD($uid,".  $tid .")";  //orderid	
		}	
        else
			return null;
		
	    //$sSQL .= " and itmactive>0 and active>0";	
        $sSQL .= $limit ? " limit " . $limit : null;		
		
		//echo $sSQL;	
	    $resultset = $db->Execute($sSQL,2);	
		if (empty($resultset)) return null;
		
		//url alias or canonical	
		$aliasID = $this->useUrlAlias();		 		
		
		$pp = _m('shkatalogmedia.read_policy',1);		
		$ix =1;
		foreach ($resultset as $n=>$rec) {
		
			$itemcode   = $rec[$this->fcode];
			$id2 		= $aliasID ? ($rec[$aliasID] ? $this->stralias($rec[$aliasID]) : $itemcode) : $itemcode; 
			$cat        = $this->getkategoriesS(array(0=>$rec['cat0'],1=>$rec['cat1'],2=>$rec['cat2'],3=>$rec['cat3'],4=>$rec['cat4']));			
			
			$cat = $rec['cat0'] ? $this->replace_spchars($rec['cat0']) : null; 
			$cat .= $rec['cat1'] ? $this->cseparator . $this->replace_spchars($rec['cat1']) : null;
			$cat .= $rec['cat2'] ? $this->cseparator . $this->replace_spchars($rec['cat2']) : null;
			$cat .= $rec['cat3'] ? $this->cseparator . $this->replace_spchars($rec['cat3']) : null;
			$cat .= $rec['cat4'] ? $this->cseparator . $this->replace_spchars($rec['cat4']) : null;
			
			$item_url = ($aliasID) ? $this->httpurl ."/$cat/$id2" . $this->aliasExt :
									 $this->httpurl . '/' . $this->url('t=kshow&cat='.$cat.'&id='.$itemcode);
			$item_name_url = $this->url('t=kshow&cat='.$cat.'&id='.$itemcode, $rec[$this->itmname]);			   
		    $item_name_url_base = "<a href='$item_url'>".$rec[$this->itmname]."</a>";
			
			$imgfile = $this->urlpath . $this->image_size_path . '/' . $itemcode . $this->restype;

			if (file_exists($imgfile)) 	 
				$item_photo_url = $this->httpurl . $this->image_size_path . '/' . $itemcode . $this->restype;
			else 
				$item_photo_url = $this->httpurl .'/'. $this->photodb . '?id='.$itemcode.'&stype='.$this->sizeDB;

			$item_photo_html = "<img src=\"" . $item_photo_url . "\">";
			$item_photo_link = "<a href='$item_url'><img src=\"" . $item_photo_url . "\"></a>";			

			$i = $ix++;
			if ($usecode) { /*shkatalogmedia tokens pattern*/
				$page       = 0;
				$itemqty    = 1;
				$itemtitle  = $rec[$this->itmname]; 
				$citemtitle = $this->replace_cartchars($rec[$this->itmname]);
				$itemdescr  = $rec[$this->itmdescr]; 
				$citemdescr = $this->replace_cartchars($rec[$this->itmdescr]);
				$itemphoto  = $itemcode;
				$itemprice  = ($rec[$pp]>0) ? _m('shkatalogmedia.spt use ' . $rec[$pp],1) : _v('shkatalogmedia.zeroprice_msg');					
				$itemunit   = $rec['uniname2'] ? localize($rec['uniname1'],$this->lan) .'/'. localize($rec['uniname2'],$this->lan) :
											     localize($rec['uniname1'],$this->lan);
				
				$ret_array[$i] = array( 
			                0=>$item_name_url,
							1=>$rec[$this->itmdescr],
							2=>$item_photo_link,
							3=>$itemunit,
							4=>$rec['itmremark'],
							5=> number_format(floatval($itemprice),2,',','.'),
							6=>_m("shcart.showsymbol use $itemcode;$citemtitle;;;$cat;$page;;$itemphoto;$itemprice;$itemqty;+$cat+$page",0),
							7=>_m('shkatalogmedia.show_availability use '. $rec['ypoloipo1'],1),
							8=>'',
							9=>'',
							10=>$itemcode,
							11=>$item_url,
							12=>_m("shcart.getCartItemQty use " . $itemcode,1),
							13=>_m("shkatalogmedia.read_array_policy use " . $itemcode . '+'. $itemprice . "+$itemcode;$citemtitle;;;$cat;$page;;$itemphoto;$itemprice;$itemqty",1),
							14=>$item_photo_url,
							15=>$rec[$this->lastprice],
							16=>$itemtitle,
							17=>null,
							18=>_m('shkatalogmedia.item_has_discount use '. $itemcode,1),
							19=>"addcart/$itemcode;$citemtitle;;;$cat;$page;;$itemphoto;$itemprice;$itemqty/$cat/$page/",
							20=>$rec['year'],			
							21=>$rec['month'],
							22=>$rec['day'],
							23=>$rec['time'],
							24=>localize($rec['monthname'], $this->lan),
						); 
			}			
			else
				$ret_array[$i] = array( /*default tokens pattern */
			                0=>$itemcode,
			                1=>$rec[$this->itmname],
							2=>$rec[$this->itmdescr],
							3=>$rec['itmremark'],
							4=>$rec['uniname1'],
							5=> number_format(floatval($rec['price0']),2,',','.'),
							6=> number_format(floatval($rec['price1']),2,',','.'), 
							7=>$rec['cat0'],
							8=>$rec['cat1'],
							9=>$rec['cat2'],
							10=>$rec['cat3'],
							11=>$rec['cat4'],
							12=>$item_url,
							13=>$item_name_url_base,
							14=>$item_photo_url,
							15=>$item_photo_html,
							16=>$item_photo_link,
							17=>$itemcode,
							18=>$rec[$this->lastprice],
							19=>$rec['ypoloipo1'],
							20=>$rec['resources'],
							21=>$rec['weight'],
							22=>$rec['volume'],
							23=>$rec['dimensions'],
							24=>$rec['size'],
							25=>$rec['color'],
			                26=>$rec['manufacturer'],
							27=>$rec['year'],			
							28=>$rec['month'],
							29=>$rec['day'],
							30=>$rec['time'],
							31=>localize($rec['monthname'], $this->lan),
						);							
		}
		
		return ($ret_array);
	}		
	
	public function get_items($preset=null, $limit=false, $usecode=null, $usemenu=null) {

		$ret = $this->_get_items($preset, $limit, $usecode, $usemenu);
		return ($ret);
	}		

	
	public function get_attachment($itmcode=null,$type=null,$nolan=null) {
		$db = GetGlobal('db');	
		$slan = ($nolan) ? null : $this->lan;	  
	  		  
		$sSQL = "select data,type from pattachments ";
		$sSQL .= " WHERE code='" . $itmcode . "'";
		if (isset($type))
			$sSQL .= " and type='". $type ."'";
		if (isset($slan))
			$sSQL .= " and lan=" . $slan;	
		//echo $sSQL;
	  
		$result = $db->Execute($sSQL);	
	  
		return ($result->fields[0]);
	}
	
    //combine tokens with load tmpl data inside	
	public function ct($template, $toks=null, $execafter=null) {
		$db = GetGlobal('db'); 	

		$sSQL = "select data from cmstemplates where name=" . $db->qstr($template);
		$res = $db->Execute($sSQL);				
		$ret = base64_decode($res->fields['data']);					
		
		if (!$execafter)
			$ret = $this->process_commands($ret);		  		
		
		$tokens = $toks ? unserialize($toks) : array();
		$i=0;
		if (!empty($tokens)) {	 
			foreach ($tokens as $i=>$tok) 
				$ret = str_replace("$".$i."$",$tok,$ret);
		}
		//clean unused token marks
		for ($x=$i;$x<40;$x++)
			$ret = str_replace("$".$x."$",'',$ret);			
		
		if ($execafter)
			$ret = $this->process_commands($ret);	
		
		return ($ret);
	}
	
    //combine tokens with load tmpl data (file) inside	
	public function _ct($template, $toks=null, $execafter=null, $iscp=false) {
			
		$ret = $this->select_template($template, $iscp);					
		
		if (!$execafter)
			$ret = $this->process_commands($ret);		  			  		
		
		$tokens = $toks ? unserialize($toks) : array(); 
		
		$i=0;		
		if (!empty($tokens)) {	
			foreach ($tokens as $i=>$tok) 
				$ret = str_replace("$".$i."$",$tok,$ret);
		}
		//clean unused token marks
		for ($x=$i;$x<40;$x++)
			$ret = str_replace("$".$x."$",'',$ret);			
		
		if ($execafter)
			$ret = $this->process_commands($ret);		
		
		return ($ret);
	}	
	
	public function select_template($tfile=null, $iscp=false, $theme=null) {
		if (!$tfile) return;
		$themePath = $this->prpath . $this->tpath .'/';
	  
	    $path = $iscp ? ($theme ? $theme . '/' : ($themePath . $this->cptemplate . '/')) : 
		                ($theme ? $theme . '/' : ($themePath . $this->template . '/')) ; 

		
		//big file to load in every page
		/*if ($data = trim(@file_get_contents($path . 'template-parts.xml'))) {
			//echo '.xml';
			$xparts = new SimpleXMLElement($data);

			if ((string) $xparts->part->name == $tfile) {
				//echo $tfile . '.xml';
				return ($xparts->part->body);
			}
		}		
		else*/
		if (($this->mobile) && ($data = trim(@file_get_contents($path . 'mob@'.$tfile . '.php')))) {
			//echo 'mobile ver .php';
			//save cmsTemplates to be able to edit in cp
			//self::stackTemplate($path . 'mob@'.$tfile . '.php');
			
			return $this->dCompile($data);
		}
		elseif ($data = trim(@file_get_contents($path . $tfile . '.php'))) {		
			//echo '.php';
			//self::stackTemplate($path . $tfile . '.php');
			
			return $this->dCompile($data);
		}

		//.htm files 
		//self::stackTemplate($path . str_replace('.', $this->lan.'.', str_replace('.htm', '', $tfile) . '.htm'));
					
		//echo '.htm';
		return @file_get_contents($path . str_replace('.', $this->lan.'.', str_replace('.htm', '', $tfile) . '.htm')); 
    }		
	
	public function createButton($name=null, $urls=null, $t=null, $s=null) {
		$type = $t ? $t : 'primary'; //danger /warning / info /success
		switch ($s) {
			case 'large' : $size = 'btn-large '; break;
			case 'small' : $size = 'btn-small '; break;
			case 'mini'  : $size = 'btn-mini '; break;
			default      : $size = null;
		}
		$u = unserialize($urls);
		if (!empty($u)) {
			foreach ($u as $n=>$url)
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
	
	public function encode_image_id($id=null, $encode=null) {
	    if (!$id) return null;
		$out = $encode ? md5($id) : $id;
        return $out;
	}		
	
	public function getmapf($name) {
	
		if (empty($this->map_t)) return 0;
	  
		foreach ($this->map_t as $id=>$elm)
			if ($elm==$name) break;
				
		$ret = $this->map_f[$id];
		return ($ret);
	}	
	
	public function getItemCode($id=null) {
		$db = GetGlobal('db');		
		if (!$id) return null;			
		
		$code = $this->fcode;
		$objSQL = "select $code from products WHERE id=" . $id;
		
		$oret = $db->Execute($objSQL);
		return ($oret->fields[0]);			
	}

	//fetch item real-canonical code when alias used
	public function getRealItemCode($id, $aid=null) {
		$db = GetGlobal('db');		
		if (!$id) return null;
		$aliasID = $aid ? $aid : $this->useUrlAlias();	
		
		if ($aliasID) {
			$code = $this->fcode; //canonical code			
			
			$objSQL = "select $code from products WHERE $aliasID=" . $db->qstr($id);
			$oret = $db->Execute($objSQL);
			
			return ($oret->fields[0] ? $oret->fields[0] : $id);			
		}
		
		return ($id); //as is in case of no alias
	}
	
	//call at tag rel=canonical at index file
	//must return the canonical (klist/kshow) url, not the alias !!
	public function urlCanonical() {

		if ($aliasID = $this->useUrlAlias()) {
			
			if ($id = $_GET['id'])  {
				
				$cat = GetReq('cat');
				
				//when url is "domain.ext/cat/id.html;
				if (!is_numeric($id)) { // alias used
				
					//fetch real (canonical) code
					$c = $this->getRealItemCode($id, $aliasID);	
					$ret = $this->httpurl . "/kshow/$cat/$c/";
				}
				else //as is
					$ret = $this->httpurl . "/kshow/$cat/$id/";
						
			}	
			elseif ($cat = GetReq('cat')) {
				//when url is "domain.ext/cat.html;
				$ret = $this->httpurl . "/klist/$cat/";
			}
			else
				$ret = $this->httpurl . $this->php_self(); 			
		}
		else
			$ret = $this->httpurl . $this->php_self(); 
		
		return $ret;
	}	

	public function nformat($n, $dec=0) {
		return (number_format($n,$dec,',','.'));
	}		

	public function replace_spchars($string, $reverse=false, $rep=null) {
		$repl = $rep ? $rep : $this->replacepolicy;
		
		switch ($repl) {	
	
			case '_' : $ret = $reverse ?  str_replace('_',' ',$string) : str_replace(' ','_',$string); break;
			case '-' : $ret = $reverse ?  str_replace('-',' ',$string) : str_replace(' ','-',$string);break;
			default  :	
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
	
	//update `products` set p5=replace(replace(replace(replace(replace(replace(replace(replace(itmname,"'",'-'),'"','-'),',','-'),'+','-'),'/','-'),'&','-'),'.','-'),' ','-') where code5='66001'
	public function stralias($string) {
		if (!$string) return null;
		$g1 = array("'",',','"','+','/',' ','&','.');
		$g2 = array('-','-',"-","-","-",'-','-','-');
		
		$regstr = trim(preg_replace('/\s\s+/', '-', $string)); //double spaces  
		$str = str_replace($g1,$g2,$regstr);
		return ($str);
	}		
	
	//cron func
	public function replaceAliasCode($csvItems=null, $isStr=false) {
		$db = GetGlobal('db');
		if (!$csvItems) return false;
		
		$itmname = $this->lan ? 'itmname' : 'itmfname';
		
		if ($aliasID = $this->useUrlAlias()) {
			
			if ($isStr) {
				$itms = explode(',', $csvItems);
				$items = "'" . implode("','", $itms) . "'";
			}  
			else
				$items = $csvItems;
			
			$sSQL = "update products set $aliasID = ";
			$sSQL.= " replace(replace(replace(replace(replace(replace(replace(replace(replace($itmname,'#','-'),\"'\",'-'),'\"','-'),',','-'),'+','-'),'/','-'),'&','-'),'.','-'),' ','-')";
			$sSQL.= " where {$this->fcode} IN (" . $items . ")";
			$res = $db->Execute($sSQL);
			
			return ($sSQL);
		}
		
		return false;	
	}
	
	
	
	//send mail
	public function cmsMail($from=null,$to=null,$subject=null,$body=null,$tid=null,$origin=null) {
	    $from = ($this->validMail($from)) ? $from : $this->paramload('INDEX','e-mail');
		  
	    if (($this->validMail($to)) && (defined('SMTPMAIL_DPC'))) {
						
			$mailbody = $body ? str_replace('<SYN/>','+',$body) : $this->body; //preload as _v(cmsrt.mbody use text)
			$trackid = $this->addTracker($mailbody, $tid, $to);				
				 
	        $smtpm = new smtpmail;
		   
		    $smtpm->to($to); 
		    $smtpm->from($from); 
		    $smtpm->subject($subject);
		    $smtpm->body($mailbody);			   

			$mailerror = $smtpm->smtpsend();
			
			$this->saveMail($from, $to, $subject, $body, $trackid, $origin);

			unset($smtpm);
		}
	    else
	        echo "Mail not send! (smtp not loaded)";		
		  
		return ($mailerror);	   	
	}
	
	public function setMailBody($text=null) {
		
		return str_replace('+','<SYN/>',$text);
	}
	
	//save mail to db queue
	protected function saveMail($from,$to,$subject,$body=null,$trackid=null,$orig=null) {
		$db = GetGlobal('db');		
		$ishtml = 1;
		$origin = $orig ? $orig : 'cmsMail'; 
		$datetime = date('Y-m-d h:s:m');
		$active = 0; 
		$cid = $trackid; //cid=trackid	
		
		$sSQL = "insert into mailqueue (timein,timeout,active,sender,receiver,subject,body,origin,trackid,cid) ";
		$sSQL .=  "values (" .
			 $db->qstr($datetime) . "," . 
			 $db->qstr($datetime) . "," . 
			 $active . "," .
		     $db->qstr(strtolower($from)) . "," . 
			 $db->qstr(strtolower($to)) . "," .
		     $db->qstr($subject) . "," . 
			 $db->qstr($body) . "," .
			 $db->qstr($origin) . "," .
			 $db->qstr($trackid) . ",".
			 $db->qstr($cid) . ")";
			 		
		$result = $db->Execute($sSQL,1);			 

		return (true);			 
	}	

	protected function getTrackId($id=null, $salt=null) {
		
		$i = $id ? ($id . $salt) : ($salt ? $salt : rand(100000,999999));	 
		$tid = date('YmdHms') .  $i . '@' . $this->appname;
		 
		return ($tid);	
	}	
	
	protected function addTracker(&$mailbody,$tid=null,$to=null) {
		$salt = $to ? crc32($to) : null;
		$i = $this->getTrackId($tid, $salt); 
		
		if ($mailbody) {
	
			$ret = ($to) ?	"<img src=\"{$this->mtrack}$i/$to/\" border=\"0\" width=\"1\" height=\"1\"/>":
							"<img src=\"{$this->mtrack}$i/\" border=\"0\" width=\"1\" height=\"1\"/>";
		 
			$mailbody = (strstr($mailbody,'</BODY>')) ?
					str_replace('</BODY>',$ret.'</BODY>',$mailbody):
					str_replace('</body>',$ret.'</body>',$mailbody);
		}
		
		return ($i);	 
	}	


	
	public function captchaImage() {
		
		if (defined('SCAPTCHA_DPC')) {
			$cpc = new scaptcha();
			$_SESSION['CAPTCHA'] = $cpc->captchaInit();
			
			return $cpc->captchaImage();
		}

		return 'scpatcha is not defined';	
	}

	public function valid_captcha($fieldname=null) {
	    $captcha = $fieldname ? GetParam($fieldname) : GetParam("mycaptcha");		
	    if (!defined('SCAPTCHA_DPC')) return true;

		if (($captcha) && ($captcha==$_SESSION['CAPTCHA'])) 	
			return true;
		
		return false;
	}	
	
	
	
	//override
	public function include_part($fname=null, $args=null, $uselans=null, $tmplname=null) {	
	
		if ($this->mobile) {
			$fparts = explode('/',$fname);
			$lastpart = 'mob@' . array_pop($fparts);
			$mobilefname = implode('/', $fparts);
			$mobilefname.= '/'. $lastpart;

			$ret = parent::include_part($mobilefname,$args,$uselans,$tmplname);
			//if ($ret) echo $mobilefname . '<br/>';
		} 

		return ($ret) ? $ret : parent::include_part($fname,$args,$uselans,$tmplname);
			
	}	

	//override
	public function include_part_arg($fname=null, $args=null, $uselans=null, $tmplname=null) {
		
		if ($this->mobile) {
			$fparts = explode('/',$fname);
			$lastpart = 'mob@' . array_pop($fparts);
			$mobilefname = implode('/', $fparts);
			$mobilefname.= '/'. $lastpart;

			$ret = parent::include_part_arg($mobilefname,$args,$uselans,$tmplname);
			//if ($ret) echo $mobilefname . '<br/>';
		} 

		return ($ret) ? $ret : parent::include_part_arg($fname,$args,$uselans,$tmplname);
			
	}
	
    //overrite
	public function included($fname=null, $enable_ajax=false, $divargs=null, $divname=null) {

		$p = $_GET['param'] ? $_GET['param'] : $fname;
		$param = ($this->mobile) ? 'mob@' . $p : $p;
	
		if ($enable_ajax) {
			$out = $this->get_scrollid(get_class($this),'included', "$param", $divargs, $divname, true); 		
			return ($out);
		}

		$pathname = $this->prpath . $this->htmlpage . "/" . $this->MC_TEMPLATE . "/" . $param . '.php';
		//echo $pathname;
		
		//self::stackTemplate($pathname);
				
		$contents = @file_get_contents($pathname);
		$out = $this->process_commands($contents);
		
		return ($out);		
	}	
	
	//jquery call phpdac func for scroll fireup load
	protected function get_scrollid($calling_object, $calling_function=null, $param=null, $divargs=null, $divname=null, $variable_func=false) {
	    $_d = $divname ? $divname : 'div';
	    $scm = $this->scrollid++;	
		
	    if (($calling_object) && ($calling_function) && method_exists($calling_object,$calling_function)) {

			$calling_function_varid = ($variable_func) ? $calling_function ."_{$scm}" : $calling_function;
			
			$divret = "<script>sc[{$scm}]='{$calling_function_varid}';</script>";
			$divret.= "<{$_d} {$divargs} id='{$calling_function_varid}' style='visibility:hidden;'>{$param}</{$_d}>";	
			return ($divret);
		}	
		
		return ($scm);	
	}
	
	protected function scroll_javascript_code() {
	    $keep_id = GetReq('id') ? 'id='.GetReq('id').'&cat='.GetReq('cat') : 'cat='.GetReq('cat');
	    $ajaxurl = seturl($keep_id."&t=");	
	
		$jscroll = <<<JJSCROLL
$(document).ready( function() {
	$.ajaxSetup({ cache: false });
	if (sc == undefined) return;
	$(window).scroll(function() { 
        if ($(window).scrollTop() + $(window).height() == $(document).height()) {	
            read_scroll_data();
		}
	});	
});
function read_scroll_data() {
	if (func = sc.shift()) {
	var param = $('#'+func).html();
	if (param) {					
		setTimeout(function() {
			$.ajax({
				url: '{$ajaxurl}'+func+'&param='+param,
				type: 'GET',
				success: function(data) {					
                if (data) {						
					$('#'+func).html(data);
					$('#'+func).css('visibility','visible');
				}
				else {
				    $('#'+func).html('');
					read_scroll_data();
				}}	
			});
		},100);						
	}
	else {
	    $.globalEval(func+'()');
    }}	
}
	
JJSCROLL;
		return ($jscroll);			
	}
	
	protected function timeout_javascript_code() {
	    $keep_id = GetReq('id') ? 'id='.GetReq('id').'&cat='.GetReq('cat') : 'cat='.GetReq('cat');
	    $ajaxurl = seturl($keep_id."&t=");	
	
		$jscroll = <<<JSCROLL
//var sc = new Array(); //moved on top of file
$(document).ready( function() {
	$.ajaxSetup({ cache: false });
	if (sc == undefined) return;
	$.each( sc, function( index, func ) {
		//console.log(func+':'+index);	
		fetch_timeout_data(func, index*100);			    
	});			
});
function fetch_timeout_data(func, outtime) {
	if (func == undefined) return;			
	var param = $('#'+func).html();
	if (param) {		
		setTimeout(function() {
			$.ajax({
				url: '{$ajaxurl}'+func+'&param='+param,
				type: 'GET',
				success: function(data) { $('#'+func).html(data); $('#'+func).css('visibility','visible')}});
        },outtime);				  
	}
	else {
	    $.globalEval(func+'()');
    }
	
}
JSCROLL;
		return ($jscroll);			
	}		
	
};
}
?>