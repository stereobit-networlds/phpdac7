<?php
if (defined("SHKATALOGMEDIA_DPC")) {
$__DPCSEC['SHWISHCMP_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if (!defined("SHWISHCMP")) {
define("SHWISHCMP_DPC",true);

$__DPC['SHWISHCMP_DPC'] = 'shwishcmp';

$__EVENTS['SHWISHCMP_DPC'][0]='wishcmp';
$__EVENTS['SHWISHCMP_DPC'][1]='wishview';
$__EVENTS['SHWISHCMP_DPC'][2]='wsadditem';
$__EVENTS['SHWISHCMP_DPC'][3]='wsdelitem';
$__EVENTS['SHWISHCMP_DPC'][4]='cmpadditem';
$__EVENTS['SHWISHCMP_DPC'][5]='cmpdelitem';
$__EVENTS['SHWISHCMP_DPC'][6]='cmplist';
$__EVENTS['SHWISHCMP_DPC'][7]='wslist';

$__ACTIONS['SHWISHCMP_DPC'][0]='wishcmp';
$__ACTIONS['SHWISHCMP_DPC'][1]='wishview';
$__ACTIONS['SHWISHCMP_DPC'][2]='wsadditem';
$__ACTIONS['SHWISHCMP_DPC'][3]='wsdelitem';
$__ACTIONS['SHWISHCMP_DPC'][4]='cmpadditem';
$__ACTIONS['SHWISHCMP_DPC'][5]='cmpdelitem';
$__ACTIONS['SHWISHCMP_DPC'][6]='cmplist';
$__ACTIONS['SHWISHCMP_DPC'][7]='wslist';

//overwrite for cmd line purpose
$__LOCALE['SHWISHCMP_DPC'][0]='SHWISHCMP_DPC;Wish list;Wish list';
$__LOCALE['SHWISHCMP_DPC'][1]='_WISHLIST;Wishlist;Wishlist';	   
$__LOCALE['SHWISHCMP_DPC'][2]='_COMPARE;Compare;Σύγκριση';	
$__LOCALE['SHWISHCMP_DPC'][3]='_ADDTOWISHLIST;add to wishlist;προσθήκη στη wishlist';
$__LOCALE['SHWISHCMP_DPC'][4]='_ADDTOCOMPARE;add to compare;προσθήκη για σύγκριση';
$__LOCALE['SHWISHCMP_DPC'][5]='SHWISHLIST_CNF;Wish List;Wish List';
 
class shwishcmp extends shkatalogmedia {


    public function __construct() {
   
       shkatalogmedia::__construct();	

    }
   
    public function event($event=null) {
   
       switch ($event) {
	   
	     case 'cmpadditem'    : $this->cmpadd(); 
								$this->jsBrowser();
								break;
								
		 case 'cmpdelitem'    : $this->cmprem(); 
								$this->jsBrowser();
								break;	   
		 
	     case 'wsadditem'     : $this->add(); 
								$this->jsBrowser();
								break;
								
		 case 'wsdelitem'     : $this->rem(); 
								$this->jsBrowser();
								break;
		 
		 default              : //shwishlist::event($event);
								$this->jsBrowser();
	   }
    }
   
    public function action($action=null) {

       switch ($action) {
	     case 'cmpadditem'    : 
		 case 'cmpdelitem'    : 	   
	     case 'cmplist'       : $out .= $this->viewCompareList();
                                break;		 
	     case 'wsadditem'     : 
		 case 'wsdelitem'     : 	   						
		 default              : $out .= $this->viewWishList();
	   }
	   
	   return ($out);
    } 
	
	protected function jsBrowser() {
		
		$code = $this->jsWishCmp();		
		   
		if ($code) {
			$js = new jscript;	
			$js->load_js($code,null,1);		
			unset ($js);
		}
	}

	protected function jsWishCmp() {
		$mobileDevices = _m('cmsrt.mobileMatchDev');
		
		$code = "
	if (/{$mobileDevices}/i.test(navigator.userAgent)) 
		window.scrollTo(0,parseInt($('#main-content').offset().top, 10));
	else {		
		gotoTop('main-content');	
	
		$(window).scroll(function() { 
			if (agentDiv('main-content')) {
				$.ajax({ url: 'jsdialog.php?t=jsdcode&id=cmpwish&div=authentication', cache: false, success: function(jsdialog){
					eval(jsdialog);		
				}})	
			}	
		});	
	}	
";
		
		return ($code);
	}	
	
	
	
	protected function add() {
	    if (!$id=GetReq('id')) return;
        $db = GetGlobal('db');
        $UserName = GetGlobal('UserName');	
        $name = $UserName ? decode($UserName) : null;		
		if ($name) {
			$sSQL = "insert into wishlist (tid,cid,listname) values (" . 
					$db->qstr($id) .",". 
					$db->qstr($name) .",'wishlist'".
					")";				 
			//echo $sSQL;
			$res = $db->Execute($sSQL);		
			return ($res);
		}
		return false;
	}
	
	protected function rem() {
	    if (!$id=GetReq('id')) return;
        $db = GetGlobal('db');
        $UserName = GetGlobal('UserName');	
        $name = $UserName ? decode($UserName) : null;
        if ($name) {		
			$sSQL = "delete from wishlist where tid=" . 
					$db->qstr($id) ." and cid=". $db->qstr($name) .
					" and listname='wishlist'";				 
			//echo $sSQL;
			$res = $db->Execute($sSQL);		
			return ($res);	
		}
		return false;
	}
	
	public function wishcount() {
        $db = GetGlobal('db');
        $UserName = GetGlobal('UserName');	
        $name = $UserName ? decode($UserName) : null;
        if ($name) {		
			$sSQL = "select count(tid) from wishlist where " . 
					"cid=". $db->qstr($name) .
					" and listname='wishlist'";				 
			//echo $sSQL;
			$res = $db->Execute($sSQL);		
			return ($res->fields[0]);	
		}
		return 0;
	}	
	
	protected function getWSLists() {
        $db = GetGlobal('db');
        $UserName = GetGlobal('UserName');	
	    $name = $UserName?decode($UserName):null; 
		$codename = $this->getmapf('code');

        $sSQL = "select id,sysins,code1,pricepc,price2,sysins,itmname,itmfname,uniname1,uniname2,active,code4," .
	            "price0,price1,cat0,cat1,cat2,cat3,cat4,itmdescr,itmfdescr,itmremark,ypoloipo1,resources,".
				$codename .	$lastprice . " from products, wishlist";
		$sSQL .= " WHERE ";					
		$sSQL .= $codename . "= wishlist.tid and cid=" . $db->qstr($name);
		$sSQL .= "and listname='wishlist' order by wishlist.recid DESC";	
		//echo $sSQL;
		$this->result = $db->Execute($sSQL,2);
	    //print_r ($res->fields[5]);
		
		$out = $this->list_katalog(null,null,'fpkatalog-wishlist.htm',null,1,null,1);		
		//$out = 'test';
		return ($out);	
	} 	

	protected function viewWishList() {
       $db = GetGlobal('db');
	   $a = GetReq('a');
       $UserName = GetGlobal('UserName');	   
	   
	   if (!$UserName) {
	     if (defined('CMSLOGIN_DPC')) { 
		   _m("cmslogin.login_javascript"); 
		   $out = _m("cmslogin.quickform use +wsview+wishlist>viewWishList");		   
		 }  
	     elseif (defined('SHLOGIN_DPC')) 
		   $out = _m("shlogin.quickform use +wsview+wishlist>viewWishList");
	     else
	       $out = "You must be logged in to view this page.";
		   
		 return ($out);  
	   }	 

	   $out .= $this->getWSLists();	 
		 
	   return ($out);
	}		
	
	
	/********************* compare items ***********************/
	
	protected function cmpadd() {
	    if (!$id=GetReq('id')) return;
		if ($this->cmpcount()>3) return;
        $db = GetGlobal('db');
        $UserName = GetGlobal('UserName');	
        $name = $UserName ? decode($UserName) : null;		
		if ($name) {
			$sSQL = "insert into wishlist (tid,cid,listname) values (" . 
					$db->qstr($id) .",". 
					$db->qstr($name) .",'compare'".
					")";				 
			//echo $sSQL;
			$res = $db->Execute($sSQL);		
			return ($res);
		}
		return false;
	}
	
	protected function cmprem() {
	    if (!$id=GetReq('id')) return;
        $db = GetGlobal('db');
        $UserName = GetGlobal('UserName');	
        $name = $UserName ? decode($UserName) : null;
        if ($name) {		
			$sSQL = "delete from wishlist where tid=" . 
					$db->qstr($id) ." and cid=". $db->qstr($name) .
					" and listname='compare'";				 
			//echo $sSQL;
			$res = $db->Execute($sSQL);		
			return ($res);	
		}
		return false;
	}	
	
	public function cmpcount() {
        $db = GetGlobal('db');
        $UserName = GetGlobal('UserName');	
        $name = $UserName ? decode($UserName) : null;
        if ($name) {		
			$sSQL = "select count(tid) from wishlist where " . 
					"cid=". $db->qstr($name) .
					" and listname='compare'";				 
			//echo $sSQL;
			$res = $db->Execute($sSQL);		
			return ($res->fields[0]);	
		}
		return 0;
	}		
	
	protected function getCMPLists() {
        $db = GetGlobal('db');
        $UserName = GetGlobal('UserName');	
	    $name = $UserName ? decode($UserName) : null;
		$codename = $this->getmapf('code');
		
        $sSQL = "select id,sysins,code1,pricepc,price2,sysins,itmname,itmfname,uniname1,uniname2,active,code4," .
	            "price0,price1,cat0,cat1,cat2,cat3,cat4,itmdescr,itmfdescr,itmremark,ypoloipo1,resources,".
				$codename .	$lastprice . " from products, wishlist";
		$sSQL .= " WHERE ";					
		$sSQL .= $codename . "= wishlist.tid and cid=" . $db->qstr($name);
		$sSQL .= "and listname='compare' order by wishlist.recid DESC";	
		//echo $sSQL;
		$this->result = $db->Execute($sSQL,2);
	    //print_r ($res->fields[5]);
		
		$out = $this->list_katalog(null,null,'fpkatalog-compare.htm',null,1,null,1);		
		//$out = 'test';
		return ($out);		
	} 	
	
	protected function viewCompareList() {
       $db = GetGlobal('db');
	   $a = GetReq('a');
       $UserName = GetGlobal('UserName');	   
	   
	   if (!$UserName) {
		 if (defined('CMSLOGIN_DPC')) { 
		   _m("cmslogin.login_javascript");  
		   $out = _m("cmslogin.quickform use +wsview+wishlist>viewWishList");  
		 }  
	     elseif (defined('SHLOGIN_DPC')) 
		   $out = _m("shlogin.quickform use +wsview+wishlist>viewWishList");
	     else
	       $out = "You must be logged in to view this page.";
		   
		 return ($out);  
	   }	 

	   $out .= $this->getCMPLists();	 
		 
	   return ($out);
	}	

	public function getpage($array,$id){
	
	   if (count($array)>0) {

         foreach ($array as $num => $data) {
		    $msplit = explode(";",$data);
			if ($msplit[1]==$id) return floor(($num+1) / $this->pagenum)+1;
		 }	  
		 
		 return 1;
	   }	 
	}

    protected function browse($packdata,$view) {
	
	   $data = explode("||",$packdata); 
	
       $out = $this->view_ws($data[0],$data[1],$data[2],$data[3],$data[4]);//,$data[5]);

	   return ($out);
	}		
	
    protected function view_ws($id,$did,$ddate,$dtime,$status) {
    }	
};
}
}
//else die("SHKATALOGMEDIA DPC REQUIRED!");
?>