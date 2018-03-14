<?php
$__DPCSEC['CMS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

function _l($value=null) {
	return (localize($value, getlocal()));
}

function _r($r=null) {
	return $r ? GetGlobal('controller')->require_dpc($r) : null;
}

function _v($v=null,$val=null) {
	return $v ? GetGlobal('controller')->calldpc_var($v, $val) : null;
}

function _m($m=null, $noerr=null) {
	return $m ? GetGlobal('controller')->calldpc_method($m, $noerr) : null;
}

function _m2($m=null, $params=array()) {
	$mf = $m ? explode('.', $m) : null;
	return empty($mf) ? null : call_user_func_array(array($mf[0], $mf[1]), $params);
	//call_user_func_array(array(__NAMESPACE__ . "\\" . $mf[0], $mf[1]), $params); //5.3.0 namespace
}

if ((!defined("CMS_DPC")) && (seclevel('CMS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CMS_DPC",true);

$__DPC['CMS_DPC'] = 'cms';

require_once(_r('cms/minify.dpc.php'));
require_once(_r('cms/pxml.lib.php'));
require_once(_r('libs/scaptcha.lib.php'));

require_once(_r('cms/fronthtmlpage.dpc.php'));

class cms extends fronthtmlpage {

    var $appname, $httpurl, $tpath;
	var $user, $seclevid, $userDemoIds, $useragent, $mobile;
	var $session_use_cookie, $protocol, $secprotocol, $sslpath;
	var $activeSSL, $encURLparam, $shellfn, $aliasExt, $aliasID, $aliasUrl;
	var $cmsSdkLoc;
		
	public function __construct() {
		$UserName = GetGlobal('UserName');		
		$UserSecID = GetGlobal('UserSecID');
		$this->user = decode($UserName);			
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : 
							($_SESSION['ADMINSecID'] ? $_SESSION['ADMINSecID'] :
								(((decode($UserSecID))) ? (decode($UserSecID)) : 0));		
		
		fronthtmlpage::__construct();
		
		$language = getlocal();
	    $this->lan = $language ? $language : '0';
		
		$this->appname = paramload('ID','instancename');
		$this->tpath = $this->htmlpage; //fronthtmlpage
		
		//$this->httpurl = paramload('SHELL','protocol') . $this->url;	
		$this->httpurl = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
		$this->httpurl.= (strstr($_SERVER['HTTP_HOST'], 'www')) ? $_SERVER['HTTP_HOST'] : 'www.' . $_SERVER['HTTP_HOST'];				
		
		$this->useragent = $_SERVER['HTTP_USER_AGENT'];	
		$this->mobile = $this->isMobile();		
		
		$this->session_use_cookie = paramload('SHELL','sessionusecookie');
		$this->protocol = paramload('SHELL','protocol');
		$this->secprotocol = paramload('SHELL','secureprotocol');  
		$this->sslpath  = paramload('SHELL','sslpath');	
		$this->activeSSL = paramload('SHELL','ssl');
        $this->encURLparam = paramload('SHELL','encodeurl');
		$this->shellfn = paramload('SHELL','filename');
		$this->cmsSdkLoc = ($this->lan==1) ? 'el_GR' : 'en_US';

		$this->loadVariables();
		
		$this->aliasUrl = $this->paramload('CMS', 'aliasUrl'); //1
		$this->aliasExt = $this->paramload('CMS', 'aliasExt'); //.html		
		$this->aliasID = $this->paramload('CMS', 'aliasID'); //p5		
		
		$this->userDemoIds = array(5,6,7,8); //8 
	}
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}	

	public function isLevelUser($level=6) {
		return ($this->seclevid >= $level) ? true : false;
	}

    public function paramload($section,$param) {
		$config = GetGlobal('config');
		//echo $param;
		if ($ret = $config[$section][$param]) 
			return ($ret); 
    }

    public function arrayload($section,$array) {
		$config = GetGlobal('config');
  
		if ($data = $config[$section][$array]) 
			return(explode(",",$data));
    }
	
	
	public function isUaBot($a=null) {
		$agent = $a ? $a : $this->useragent;
		$avoiduseragent = _m("cms.arrayload use CMS+httpUserAgentsToAvoid");
		
		if (!empty($avoiduseragent)) {
			foreach ($avoiduseragent as $i=>$ua) {
				if (stristr($agent, $ua)) 
					return true;
			}
		}
		
		return false;	
	}

	public function mobileMatchDev() {
		$mstr = $this->paramload('CMS', 'mobileDevices');
		$ret = $mstr ? str_replace(',','|',$mstr) : "Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini";
		return $ret;
	}	
	
	//http://stackoverflow.com/questions/4117555/simplest-way-to-detect-a-mobile-device
	public function isMobile() {
		//return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $this->useragent);
		$pregmob = strtolower($this->mobileMatchDev());
		return preg_match("/($pregmob)/i", $this->useragent);
	}	
	
	public function cssMin($css=null) {
		if (!$css) return null;
		//if (paramload('CMS','minify'))
			return minify::cssMinify($css);
	
		return ($css);
	}	
	
	public function jsMin($js=null) {
		if (!$js) return null;
		//if (paramload('CMS','minify'))
			return minify::jsMinify($js);
	
		return ($js);
	}

	public function htmlMin($htm=null) {
		if (!$htm) return null;
		//if (paramload('CMS','minify'))
			return minify::htmlMinify($htm);
	
		return ($htm);
	}	

	public function validMail($mail=null) {
		$valid = filter_var($mail, FILTER_VALIDATE_EMAIL);
		return ($valid);		
	}	
	
		
    //URL funcs	
	
	public function getHttpUrl() {
		return ($this->httpurl);
	}	
	
	//page cntrl logic url creator
	protected function getpurl($query=null, $title=null) {
	
		parse_str($query, $parts);
	  
		if (array_key_exists('t', $parts)) {
	  
			$pagename = $parts['t'];
			$url = $this->urlpath;
			
			if ($this->activeSSL)
				$url .= $this->sslpath;
			
			$url .= "/" . $pagename . ".php"; 

			if (file_exists($url))
				return ($pagename . ".php");
		}	
	  
		return false;
	} 	
	
	public function seturl($query=null, $title=null, $jscript=null, $norewrite=null) {   
   
		$name = $this->httpurl;
                         
		//mv controller or page controller caller???
		$xurl = "/" . pathinfo($_SERVER['PHP_SELF'],PATHINFO_BASENAME);

		//fun called by mv cntrl
		if ($this->shellfn == $xurl) {
		    //get page if exist..(t=page)!!!!!!!!!!!!!!!!!!!!!!!!!!
            if ($page = $this->getpurl($query, $title)) {
			    $name .= "/" . $page;//page cntrl
			    //echo "[",$name,"]<br>";
			}
			else						 
			    $name .= "/" . $this->shellfn;				
		}  		   
		else  
		    $name .= "/" . pathinfo($_SERVER['PHP_SELF'],PATHINFO_BASENAME);  
						 
		//echo $name,"<br>";
						 
        if (isset($query)) {
            if ($query!="#") {
				if ($norewrite) {
					$url = $name . "?" . $query;
				}	
				elseif (strstr($query, '=')) { //NOT & (may t=) unparsed query
					/*parse query*/
					parse_str($query, $parts);
					$url =  /*$ip. '/' .*/ implode('/', $parts) . '/';
				}
				else  //already parsed query from this->url()
	                $url = $query; //as is
	        }  
	        else 
	            $url = "#"; 
        }				
        else  
            $url = $name; 
                         
        $out = $title ? "<a href='" . $url . "' $jscript>" . $title . "</a>" : $url;

		return ($out);
	}
	
	public function url($query=null, $title=null, $jscript=null, $usealias=null) {
		//$rewritedothtml = $usealias ? $this->aliasID : false;
		//disable inside page urls
		$rewritedothtml = false; //$this->useUrlAlias(); //false; //!!!!!!!!
			
		/*.html handler for categories and items 
		
		RewriteCond %{REQUEST_FILENAME} !-f
		RewriteRule ^([^\.]+)/([^\.]+).html$ katalog.php?t=kshow&cat=$1&id=$2 [L]
		RewriteRule ^([^\.]+).html$ katalog.php?t=klist&cat=$1 [NC,L]
		*/
		if ($rewritedothtml) { 
		
			if (isset($query)) {

				parse_str($query, $parsed_params);
				$parsed_query =  implode('/', $parsed_params) . '/';
				$cpq = count($parsed_params); //count query params
				
				switch ($cpq) {
					case 3  : 	//t,cat,id
								$ret = (($parsed_params['id']) && ($parsed_params['cat'])) ?
										$parsed_params['cat'] . '/' . $parsed_params['id'] . $this->aliasExt :
										$this->seturl($parsed_query, $title, $jscript);
								break;	
					case 2  : 	//t,cat
								$ret = ($parsed_params['cat']) ?
										$parsed_params['cat'] . $this->aliasExt :
										$this->seturl($parsed_query, $title, $jscript);
								break;	
					case 1  : 	//t
					default :	$ret = $this->seturl($parsed_query, $title, $jscript);			
				}
				return ($ret);
			}
		}
		
		return $this->seturl($query, $title, $jscript);
	}
	
	public function useUrlAlias($retext=null) {

		$useAlias = $this->aliasUrl ? 
					($this->aliasID ? $this->aliasID : false) : false;		

		if (($retext) && ($useAlias))
			return ($this->aliasExt);
		
		return ($useAlias);
	}
	
	
	//variable funcs
	
	//load (and override) config db variables
	protected function loadVariables() {
		$db = GetGlobal('db');
		$lan = getlocal();
		$currlang = $lan ? $lan : '0';
		$vars = null;
		
		global $__DPCLOCALE;
		
		if (!$variablesloaded = GetSessionParam('cmsvars')) {

			$sSQL = "select name,value,value0,value1,value2,translate,cookie,session,section,varname,usevarname from cmsvariables WHERE active=1";
			$res = $db->Execute($sSQL);
			
			foreach ($res as $i=>$rec) {
				//echo $rec['name'].':'.$rec['value'];
				$s = $rec['section'] ? $rec['section'] : 'VAR';
				$n = $rec['usevarname'] ? $rec['varname'] : $rec['name'];					
				$v = $rec['value'];				
				
				if ($rec['translate']==1) {
					//set translation variable
					$__DPCLOCALE[$n] = $rec['value0'] . ';' . $rec['value1'] . ';' . $rec['value2'];
				}
				elseif ($rec['cookie']==1) {
					//save as cookie
					//settheCookie($n, $v); //always DO NOT
				}
				elseif ($rec['session']==1) {
					//save in session
					//SetSessionParam($n, $v); //always DO NOT
				}
				else {
					//save as global var, config style global var
				    $vars[$s][$n] = $v;
				}
			}
			
			//extra variable conf, overwrite prev conf values
			if (!empty($vars)) {
				$config = array_merge(GetGlobal('config'), $vars); 			
				SetGlobal('config',$config); 
				//echo 'conf';
			}	

			//SetSessionParam('cmsvars', 1); //save loaded state DO NOT
			return true;
		}

		return false; //already loaded	
	}
	
	protected function exVar($var) {
		if (!$var) return null;
		return (strstr($var, '.')) ? _m($var) : $var;		
	}
	
	public function callVar($name=null, $section=null) {
		if (!$name) return null;
		$sec = $section ? $section : 'VAR';		
		
		//time based vars TTL //STR_TO_DATE('$dstart','%m-%d-%Y')
		$db = GetGlobal('db');
		$sSQL = "select value,start,stop,inodd,ineven,inday,inmonth,inyear,isvar,islocale,";
		$sSQL.= " DAY(NOW()) as day, MONTH(NOW()) as month, YEAR(NOW()) as year, NOW() as now from cmsvartimes";
		$sSQL.= " WHERE active=1 and name=" . $db->qstr($name);
		$sSQL.= " and NOW() BETWEEN start AND stop";
		$sSQL.= " order by datein DESC LIMIT 1"; //newest record
		$res = $db->Execute($sSQL);
		//echo $res->fields['day'];
		
		if ($value = $res->fields[0]) {
			$oddday = ($res->fields['day'] % 2 == 0) ? false : true;
			$oddmonth = ($res->fields['month'] % 2 == 0) ? false : true;	
			$oddyear = ($res->fields['year'] % 2 == 0) ? false : true;
			//echo $oddday,$sSQL;
			
			if ($res->fields['islocale']) {
				$varvalue = $res->fields['isvar'] ?	_l($this->paramload($sec, $value)) : _l($value);
				return ($varvalue);
			}	
			else {
				$varvalue = $res->fields['isvar'] ? $this->paramload($sec, $value) : $value;
			
				if (($res->fields['inday']) && ($res->fields['inodd']) && ($oddday==true)) {
					//echo 'odd day',$varvalue;
					return $this->exVar($varvalue);
				}
				elseif (($res->fields['inday']) && ($res->fields['ineven']) && ($oddday==false)) {
					//echo 'even day';
					return $this->exVar($varvalue);
				}
				elseif (($res->fields['inmonth']) && ($res->fields['inodd']) && ($oddmonth==true)) {
					//echo 'odd month';
					return $this->exVar($varvalue);
				}
				elseif (($res->fields['inmonth']) && ($res->fields['ineven']) && ($oddmonth==false)) {
					//echo 'even month';
					return $this->exVar($varvalue);
				}
				elseif (($res->fields['inyear']) && ($res->fields['inodd']) && ($oddyear==true)) {
					//echo 'odd year';
					return $this->exVar($varvalue);
				}
				elseif (($res->fields['inyear']) && ($res->fields['ineven']) && ($oddyear==false)) {
					//echo 'even year';
					return $this->exVar($varvalue);
				}
				else { //if odd and even is off
					//echo $varvalue . 'a';
					if ((!$res->fields['inodd']) && (!$res->fields['ineven']))
						return $this->exVar($varvalue); //always
				}	
			}
		}	
		//else 
		//standart vars, conf or locale values
		$varvalue = $this->paramload($sec, $name);
		//echo $varvalue . '>';
		return $this->exVar($varvalue);
	}
};
}
?>