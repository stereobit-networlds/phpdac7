<?php
$__DPCSEC['SHAGENT_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if (!defined("SHAGENT_DPC")) {
define("SHAGENT_DPC",true);

$__DPC['SHAGENT_DPC'] = 'shagent';

$a = GetGlobal('controller')->require_dpc('cms/cmsagent.dpc.php');
require_once($a);
 
GetGlobal('controller')->get_parent('CMSAGENT_DPC','SHAGENT_DPC');

$__EVENTS['SHAGENT_DPC'][10]='divstart';

$__ACTIONS['SHAGENT_DPC'][10]='divstart';

$__DPCATTR['SHAGENT_DPC']['shagent'] = 'shagent,1,0,0,0,0,0,0,0,1,1,1,1';

$__LOCALE['SHAGENT_DPC'][0]='SHAGENT_DPC;Shop Agent;Shop Agent';

class shagent extends cmsagent {
   
    protected $remoteScript; //use when it is service
    protected $agnStartsAfterNMsg; //start show msgs after a msg silent period
	protected $agnStopsAfterNMsg; //stop show msgs after a number of messages
	
	var $divlist, $http_referer;
   
	public function __construct() {
		
		cmsagent::__construct();
		
		$this->http_referer = $_SESSION['http_referer']; //as saved at vstats
		
		//XMLHttpRequest cannot load http://www.stereobit.gr/jsdialog.php?t=jsdcode&id=ff134785e032f39bd9509e58262c4c6c&div=last&_=1487604756270. 
		//No 'Access-Control-Allow-Origin' header is present on the requested resource. 
		//Origin 'http://www.e-basis.gr' is therefore not allowed access.
		$this->remoteScript = null;//'//www.stereobit.gr/'; //remote js call
		
		$this->agnStartsAfterNMsg = 0;
		$this->agnStopsAfterNMsg = $this->agnStartsAfterNMsg + 9990; //a big no if not a limit
	}
   
	public function event($event=null) {

		switch ($event) {
			   
			case 'divstart' :   $js = $this->jsdivStart();
								$js.= $this->jsOnScroll();
			                    die($js); //break;

			default 		: 	cmsagent::event($event);
		}
	}
   
	public function action($action=null) {

		$out = cmsagent::action($action);
		return ($out);
	}
	
	/* override using array_key */
	protected function isLoadedMessage() {
		if (empty($this->pastMsg)) return false;
		
		if ((array_key_exists($this->msgId, $this->pastMsg)) && 
			($this->pastMsg[$this->msgId] == $this->currentDiv)) 
				return true;
		
		return false;
	}	

	//override
	public function respond() {
		if ($this->isBot()) return null;
		if ($this->isLoadedMessage()) //return $this->renderMessage($this->currentDiv . "($this->msgId)");
			return null;		
	
		//return $this->showMessage();
		
        //phpdac processing...
		$data = $this->showMessage();
		
		$pattern = "@<phpdac.*?>(.*?)</phpdac>@s";
		preg_match_all($pattern, $data, $matches, PREG_PATTERN_ORDER);

		foreach ($matches[1] as $r=>$cmd) {
			$_cmd = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", "", $cmd)));
			$ret = _m($_cmd,1); //,1); //no error stop 					 
			$data = str_replace("<phpdac>".$cmd."</phpdac>",$ret,$data);
		}
		return ($data);	
			
	}	
	
	//override
	protected function saveMessage() {	
	    $db = GetGlobal('db');	
		$cuser = GetGlobal('UserID');			
		
		cmsagent::saveMessage();
		
		$id = $this->msgId;
		$cdiv = $this->currentDiv;
		$cpage = urldecode($this->currentPage);
		$cses = $cuser ? decode($cuser) : session_id();
		
		//todo: server vars must be js call vars
		$sSQL = "insert into cagnstats (cid,cdiv,cpage,csession,REMOTE_ADDR,HTTP_USER_AGENT,REFERER) values (";					
		$sSQL.= $db->qstr($id) . ',';
        $sSQL.= $db->qstr($cdiv) . ','; 
		$sSQL.= $db->qstr($cpage) . ','; 
		$sSQL.= $db->qstr($cses) . ','; 		
		$sSQL.= $db->qstr($_SERVER['REMOTE_ADDR']) . ",";
		$sSQL.= $db->qstr($_SERVER['HTTP_USER_AGENT']). ",";
		$sSQL.= $db->qstr($this->http_referer). ")";			
		//echo $sSQL;
		$db->Execute($sSQL);	

		return true;	
	}
	
	//override
	protected function showMessage($msg=null) {
		if(!defined('JSDIALOGSTREAM_DPC'))
			return null;
		
		$msgShown = (!empty($this->pastMsg)) ? count($this->pastMsg) : 0;
		
		if (($msgShown >= $this->agnStartsAfterNMsg) && 
		    ($msgShown <= $this->agnStopsAfterNMsg)) {
			
			list($body,$cms,$script) = $this->findMessage();
			if (!$body) { 
			    //end of page exception
				if ($this->currentDiv != 'endofpage')
					$msg = $this->renderStory(); //say a story
			}	
			else
			//if ($body)
				$msg = $this->renderMessage($body, $cms, $script);
			
			$this->saveMessage(); //save the viewed message
			
			//if (($msg) && ($this->ip == '109.242.189.69')) //debug, only me 
			if ($msg)
				return ($msg);
		}	
		
		return null;
	}	
	
	protected function renderMessage($body=null,$cms=null,$script=null) {

		if ($script) 
			return str_replace(array('$0','$1'), array($body, $cms) , $script);
		
		$close = $cms ? $cms : 2000;		
		return _m("jsdialogStream.say use $body+++$close");
	}	
	
	protected function renderStory() {
	    $db = GetGlobal('db');
		
		$id = $this->msgId;
		$cdiv = $this->currentDiv;
		$cpage = $this->currentPage ? $this->currentPage : '*';

		//$sesStoryName = '_ssn' . $id . $cdiv . ($cpage=='*' ? '' : $cpage ); 

		//get story state
		$state = GetSessionParam('agnsid') ? GetSessionParam('agnsid') : 0;		

        $sSQL = "select cscript,sid from cagn WHERE active=1 ";
		$sSQL .= " and (cagent='$id' or cagent='$cdiv' or cagent='$cpage')";	
		$sSQL.= " and sid=$state ";
		$sSQL .= " ORDER BY ctime DESC LIMIT 1";		
	    $res = $db->Execute($sSQL);		
		//return _m("jsdialogStream.say use $cpage+++2000");
		
		if ($data = base64_decode($res->fields[0])) { 
		//if ($data = $res->fields[0]) {
			
				//$_hvars = $this->getHistory(true, 1); //....
				//find a story message //...			
				
				//save story state
				/*if ($res->fields[1]<$state) //max id has reached
					SetSessionParam('agnsid',null); //reset
				else*/	
					SetSessionParam('agnsid',$state+1); //stop after avail states 
				
				return _m('cmsrt.phpcode use ' . $data);
		}		
					
		//return _m("jsdialogStream.say use test+++2000");
		return null;
	}		
	
	protected function findMessage() {
	    $db = GetGlobal('db');

		$id = $this->msgId;
		$cdiv = $this->currentDiv;
		$cpage = $this->currentPage;	
		
        $sSQL = "select cbody,cms,cscript from cagndiv WHERE active=1";	
		$sSQL .= " and (cid='$id' or cid='*') and (cdiv='$cdiv' or cdiv='*')";	
		$sSQL .= " and (cpage ='$cpage' or cpage='*') ";
		$sSQL .= " ORDER BY ctime DESC LIMIT 1";
	    $res = $db->Execute($sSQL);
		
		$script= base64_decode($res->fields[2]);
		
		return (array($res->fields[0],$res->fields[1],$script));	
	}
	
	
	
	/** remote js call based on predefined divs !!! **/
	
	protected function divBrowser() {
		
		$code = $this->jsDivStart();		
		$code.= $this->jsOnScroll();
		
		if ($code) {
			$js = new jscript;	
			$js->load_js($code,null,1);		
			unset ($js);
		}
	}

	//return basic js code to the caller page (use script on index)
	protected function jsDivStart() {
 
		$code = "
var MD5 = function(s){function L(k,d){return(k<<d)|(k>>>(32-d))}function K(G,k){var I,d,F,H,x;F=(G&2147483648);H=(k&2147483648);I=(G&1073741824);d=(k&1073741824);x=(G&1073741823)+(k&1073741823);if(I&d){return(x^2147483648^F^H)}if(I|d){if(x&1073741824){return(x^3221225472^F^H)}else{return(x^1073741824^F^H)}}else{return(x^F^H)}}function r(d,F,k){return(d&F)|((~d)&k)}function q(d,F,k){return(d&k)|(F&(~k))}function p(d,F,k){return(d^F^k)}function n(d,F,k){return(F^(d|(~k)))}function u(G,F,aa,Z,k,H,I){G=K(G,K(K(r(F,aa,Z),k),I));return K(L(G,H),F)}function f(G,F,aa,Z,k,H,I){G=K(G,K(K(q(F,aa,Z),k),I));return K(L(G,H),F)}function D(G,F,aa,Z,k,H,I){G=K(G,K(K(p(F,aa,Z),k),I));return K(L(G,H),F)}function t(G,F,aa,Z,k,H,I){G=K(G,K(K(n(F,aa,Z),k),I));return K(L(G,H),F)}function e(G){var Z;var F=G.length;var x=F+8;var k=(x-(x%64))/64;var I=(k+1)*16;var aa=Array(I-1);var d=0;var H=0;while(H<F){Z=(H-(H%4))/4;d=(H%4)*8;aa[Z]=(aa[Z]| (G.charCodeAt(H)<<d));H++}Z=(H-(H%4))/4;d=(H%4)*8;aa[Z]=aa[Z]|(128<<d);aa[I-2]=F<<3;aa[I-1]=F>>>29;return aa}function B(x){var k=\"\",F=\"\",G,d;for(d=0;d<=3;d++){G=(x>>>(d*8))&255;F=\"0\"+G.toString(16);k=k+F.substr(F.length-2,2)}return k}function J(k){k=k.replace(/rn/g,\"n\");var d=\"\";for(var F=0;F<k.length;F++){var x=k.charCodeAt(F);if(x<128){d+=String.fromCharCode(x)}else{if((x>127)&&(x<2048)){d+=String.fromCharCode((x>>6)|192);d+=String.fromCharCode((x&63)|128)}else{d+=String.fromCharCode((x>>12)|224);d+=String.fromCharCode(((x>>6)&63)|128);d+=String.fromCharCode((x&63)|128)}}}return d}var C=Array();var P,h,E,v,g,Y,X,W,V;var S=7,Q=12,N=17,M=22;var A=5,z=9,y=14,w=20;var o=4,m=11,l=16,j=23;var U=6,T=10,R=15,O=21;s=J(s);C=e(s);Y=1732584193;X=4023233417;W=2562383102;V=271733878;for(P=0;P<C.length;P+=16){h=Y;E=X;v=W;g=V;Y=u(Y,X,W,V,C[P+0],S,3614090360);V=u(V,Y,X,W,C[P+1],Q,3905402710);W=u(W,V,Y,X,C[P+2],N,606105819);X=u(X,W,V,Y,C[P+3],M,3250441966);Y=u(Y,X,W,V,C[P+4],S,4118548399);V=u(V,Y,X,W,C[P+5],Q,1200080426);W=u(W,V,Y,X,C[P+6],N,2821735955);X=u(X,W,V,Y,C[P+7],M,4249261313);Y=u(Y,X,W,V,C[P+8],S,1770035416);V=u(V,Y,X,W,C[P+9],Q,2336552879);W=u(W,V,Y,X,C[P+10],N,4294925233);X=u(X,W,V,Y,C[P+11],M,2304563134);Y=u(Y,X,W,V,C[P+12],S,1804603682);V=u(V,Y,X,W,C[P+13],Q,4254626195);W=u(W,V,Y,X,C[P+14],N,2792965006);X=u(X,W,V,Y,C[P+15],M,1236535329);Y=f(Y,X,W,V,C[P+1],A,4129170786);V=f(V,Y,X,W,C[P+6],z,3225465664);W=f(W,V,Y,X,C[P+11],y,643717713);X=f(X,W,V,Y,C[P+0],w,3921069994);Y=f(Y,X,W,V,C[P+5],A,3593408605);V=f(V,Y,X,W,C[P+10],z,38016083);W=f(W,V,Y,X,C[P+15],y,3634488961);X=f(X,W,V,Y,C[P+4],w,3889429448);Y=f(Y,X,W,V,C[P+9],A,568446438);V=f(V,Y,X,W,C[P+14],z,3275163606);W=f(W,V,Y,X,C[P+3],y,4107603335);X=f(X,W,V,Y,C[P+8],w,1163531501);Y=f(Y,X,W,V,C[P+13],A,2850285829);V=f(V,Y,X,W,C[P+2],z,4243563512);W=f(W,V,Y,X,C[P+7],y,1735328473);X=f(X,W,V,Y,C[P+12],w,2368359562);Y=D(Y,X,W,V,C[P+5],o,4294588738);V=D(V,Y,X,W,C[P+8],m,2272392833);W=D(W,V,Y,X,C[P+11],l,1839030562);X=D(X,W,V,Y,C[P+14],j,4259657740);Y=D(Y,X,W,V,C[P+1],o,2763975236);V=D(V,Y,X,W,C[P+4],m,1272893353);W=D(W,V,Y,X,C[P+7],l,4139469664);X=D(X,W,V,Y,C[P+10],j,3200236656);Y=D(Y,X,W,V,C[P+13],o,681279174);V=D(V,Y,X,W,C[P+0],m,3936430074);W=D(W,V,Y,X,C[P+3],l,3572445317);X=D(X,W,V,Y,C[P+6],j,76029189);Y=D(Y,X,W,V,C[P+9],o,3654602809);V=D(V,Y,X,W,C[P+12],m,3873151461);W=D(W,V,Y,X,C[P+15],l,530742520);X=D(X,W,V,Y,C[P+2],j,3299628645);Y=t(Y,X,W,V,C[P+0],U,4096336452);V=t(V,Y,X,W,C[P+7],T,1126891415);W=t(W,V,Y,X,C[P+14],R,2878612391);X=t(X,W,V,Y,C[P+5],O,4237533241);Y=t(Y,X,W,V,C[P+12],U,1700485571);V=t(V,Y,X,W,C[P+3],T,2399980690);W=t(W,V,Y,X,C[P+10],R,4293915773);X=t(X,W,V,Y,C[P+1],O,2240044497);Y=t(Y,X,W,V,C[P+8],U,1873313359);V=t(V,Y,X,W,C[P+15],T,4264355552);W=t(W,V,Y,X,C[P+6],R,2734768916);X=t(X,W,V,Y,C[P+13],O,1309151649);Y=t(Y,X,W,V,C[P+4],U,4149444226);V=t(V,Y,X,W,C[P+11],T,3174756917);W=t(W,V,Y,X,C[P+2],R,718787259);X=t(X,W,V,Y,C[P+9],O,3951481745);Y=K(Y,h);X=K(X,E);W=K(W,v);V=K(V,g)}var i=B(Y)+B(X)+B(W)+B(V);return i.toLowerCase()};		
		
function agentEndDiv() {
	if ($(window).scrollTop() + $(window).height() == $(document).height()) 
			return 1; else return 0;
}
function agentDiv(div,offset=0,margin=100) {
	if (!div) return agentEndDiv();
	if (($(window).scrollTop() >= $('#'+div).offset().top + offset) &&
		($(window).scrollTop() <= $('#'+div).offset().top + offset + margin))
		return 1; else return 0;	
}				
";
		
		return ($code);
	}	
	
	protected function jsOnScroll($page=null) {
		
		$code = " $(document).ready(function () { $(window).scroll(function() {";
		$code.= $this->getDivList();
		$code.= "}); });";
		
		return ($code);
	}

	protected function getDivList() {
	    $db = GetGlobal('db');		
		$rurl = $this->remoteScript; //remote js !!!
		
		$ret = null;		
		
        $sSQL = "select cid,cdiv from cagndiv WHERE active=1 ";			 
		$sSQL .= " and cid='*' and cpage='*'";
		$sSQL .= " LIMIT 10"; //free use limit ... 						 
	    $res = $db->Execute($sSQL); //other table for div predef selection
		
		foreach ($res as $i=>$rec) {
			
			$divId = md5(time()); //$rec[0]; 
			$divName = $rec[1];
			
			$ret .= "if (agentDiv('$divName')) {
			//console.log('$divName');
			uri = encodeURIComponent(window.location.href);			
			$.ajax({ url: '{$rurl}jsdialog.php?t=jsdcode&div=$divName&id=$divId&uri='+uri, cache: false, 
				success: function(jsdialog){
					eval(jsdialog);		
				}})	
			} ";
		}
		//$pageEnd = ($pagename) ? $pagename . '-end' : md5(time()); //random
		$ret .= "if (agentEndDiv()) {
			//console.log('endOfPage');
			uri = encodeURIComponent(window.location.href);
			md5uri = MD5(window.location.href);			
			$.ajax({ url: '{$rurl}jsdialog.php?t=jsdcode&div=endofpage&id='+md5uri+'&uri='+uri, cache: false, 
				success: function(jsdialog){		
					eval(jsdialog);	
				}})					
		}";
		
		
		return ($ret);
	}	
	
	public function addDivToList($divId, $divName, $offset=0) {
		$rurl = $this->remoteScript; //remote js !!!
		
		$this->divlist[$id] = $div;
		
		$ret = "if (agentDiv('$divName',$offset)) {
		//console.log('$divName');
		uri = encodeURIComponent(window.location.href);			
		$.ajax({ url: '{$rurl}jsdialog.php?t=jsdcode&div=$divName&id=$divId&uri='+uri, cache: false, 
			success: function(jsdialog){
				eval(jsdialog);		
			}})	
		} ";

		return ($ret);	
	}
   
};
}
?>