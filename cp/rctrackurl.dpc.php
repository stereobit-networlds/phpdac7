<?php

$__DPCSEC['RCTRACKURL_DPC']='1;1;1;1;1;1;1;1;1;1;1';


if ((!defined("RCTRACKURL_DPC")) ) { //&& (seclevel('RCTRACKURL_DPC',decode(GetSessionParam('UserSecID')))) ) {

define("RCTRACKURL_DPC",true);


$__DPC['RCTRACKURL_DPC'] = 'rctrackurl';

$__EVENTS['RCTRACKURL_DPC'][0]='mtrackurl';
$__EVENTS['RCTRACKURL_DPC'][1]='cptrackurl';
$__EVENTS['RCTRACKURL_DPC'][2]='mt';

$__ACTIONS['RCTRACKURL_DPC'][0]='mtrackurl';
$__ACTIONS['RCTRACKURL_DPC'][1]='cptrackurl';
$__ACTIONS['RCTRACKURL_DPC'][2]='mt';

$__DPCATTR['RCTRACKURL_DPC']['cptrackurl'] = 'cptrackurl,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCTRACKURL_DPC'][0]='RCTRACKURL_DPC;Track;Track';

class rctrackurl  {

    var $reset_db, $title;
	var $_grids, $charts;
	var $ajaxLink;
	var $hasgraph;
	var $graphx, $graphy;
	
	var $prpath, $location;
	var $appstring, $urlstring, $hashstring;
		
	function __construct() {
		
	  $this->prpath = paramload('SHELL','prpath');	
	  $this->location = null;

	  $this->title = localize('RCTRACKURL_DPC',getlocal());			
	  $this->ajaxLink = seturl('t=cpvstatsshow&statsid='); //for use with...	      

	  //sndReqArg('index.php?t=existapp&application=meme2','existapp'
	  $this->hasgraph = false;
	  $this->graphx = remote_paramload('RCTRACKURL','graphx',$this->path);
	  $this->graphy = remote_paramload('RCTRACKURL','graphy',$this->path);

	  $this->appstring = null;
	  $this->urlstring = null; 
	  $this->hashstring = null;
	}

	

    function event($event=null) { 

	   switch ($event) {

		 case 'cptrackurl'  : 
							  break; 	   

	     case 'mtrack'      :
		 case 'mt'          :
		 default            : 
		                      $this->insert_into_local_ulist();	
		                      $this->urlTracker();
							  $this->javascript();
	   }
		
    }   

    function action($action=null) {

	  switch ($action) {

		 case 'cptrackurl'  : /*if ($this->hasgraph)
		                        $out = $this->show_graph('statistics','Product statistics',$this->ajaxLink,'stats');
							  else
							    $out = "<h3>".localize('_GNAVAL',0)."</h3>";	
							  die('stats|'.$out); //ajax return*/
							  break; 
	     case 'mtrack  '    :
         case 'mt'          :
		 default            : //$out .= $this->show_statistics();

	  }	 
	  return ($out);
    }

	
	protected function javascript() {
        if (iniload('JAVASCRIPT')) {
		
           	$code = $this->redirect_js();	
			
		    $js = new jscript;
            $js->load_js($code,"",1);			   
		    unset ($js);		
     	}	  
	}
	
	protected function redirect_js($location=null) {
		
		//$location = $this->appstring . $this->urlstring .  $this->hashstring;
		//$jlocation = "'".$this->appstring."'+encodeURIComponent('".$this->urlstring ."')+'".$this->hashstring."'";
		//echo $location;
		$ret ="window.location = '".$this->location."';"; 
	
        return ($ret);	
	}
	
	protected function urlTracker() {
		//print_r($_GET);
		$u = $_GET['u'];     //url to go
		$cid = $_GET['cid']; //mail campaign id
		$a = $_GET['a'];     //app name
		$r = $_GET['r'];     //base64 dont decode...
		
		//when a, fire up redir js to start mail client monitoring
		if ($a) {
		
			$hosted_path = $this->prpath . '../' . $a . '/cp/' ;
			$appurl  = remote_paramload('SHELL','urlbase',$hosted_path,1);
		
			$url = $appurl .'/'. $u . '#' . $cid.'|'. urlencode($r);
			//$url = $appurl .'/'. str_replace('-','/',$u) . '#' . $cid.'|'.$r; //htaccess / problem
			$this->location = $url;
			
			$this->appstring = $appurl .'/';
			$this->urlstring = $u;
			$this->hashstring = '#' . $cid.'|'. urlencode($r);
			
			//$link = "<a href='$url'>".$url."</a>";
			//echo $link;
		}
		else { //not a handled www
		
		    $url = $u . '#' . $cid.'|'. urlencode($r);
		    $this->location = $url;
			
			$this->appstring = null;
			$this->urlstring = $u;
			$this->hashstring = '#' . $cid.'|'. urlencode($r);			
		}	
		
		return true;		
	}	
	
	protected function insert_into_local_ulist() {
		$db = GetGlobal('db');
		$dtime = date('Y-m-d h:i:s');
		$cmail = base64_decode($_GET['r']);
		$cid = $_GET['cid']; //mail campaign id
		$a = $_GET['a'];     //app name		
		
		$listname = $a ? $a : 'urltarck';
		$name = $cid ? $cid : 'unknown';
		
		$sSQL = "insert into ulists (startdate,active,lid,listname,name,email) values (".
				$db->qstr($dtime). ",1,1," . $db->qstr($listname). ",". $db->qstr($name) .",".$db->qstr($cmail).")";
		//echo $sSQL;
		$db->Execute($sSQL,1);			
		
		return true;
	}
};
}
?>	