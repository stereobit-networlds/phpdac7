<?php
$__DPCSEC['FRONTHTMLPAGE_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if (!defined("FRONTHTMLPAGE_DPC")) {
define("FRONTHTMLPAGE_DPC",true);

$__DPC['FRONTHTMLPAGE_DPC'] = 'fronthtmlpage';

$__LOCALE['FRONTHTMLPAGE_DPC'][1]='_addspace;Limited space, add space;Πρόσθεσε χωρητικότητα';
$__LOCALE['FRONTHTMLPAGE_DPC'][2]='English;English;Αγγλικά';
$__LOCALE['FRONTHTMLPAGE_DPC'][3]='Greek;Greek;Ελληνικά';

class fronthtmlpage {

	var $t_fronthtmlpage, $userLevelID;
	var $htmlfile, $htmlpage, $argument;
	var $urlpath, $url, $urltitle;
	var $modify, $charset, $verbose, $editmode_point;
	var $edithtml, $prpath, $htmlext;
	
	var $BASE_URL, $MC_ROOT, $MC_TEMPLATE, $MC_DEBUG, $MC_CURRENT_PAGE;
	var $language, $isolanguage;
	
	var $anel, $anel_signin;
	var $template, $cptemplate, $bodyname;
	var $preprocess;
	
	static $staticpath, $staticprpath, $cmsTemplates, $localpath;
	 
	public function __construct($file=null, $theme=null) { 
        $UserSecID = GetGlobal('UserSecID');			
		$userSid = decode($UserSecID);
		
	    $this->t_fronthtmlpage = new ktimer;
	    $this->t_fronthtmlpage->start('fronthtmlpage'); 						
        $this->userLevelID = $userSid ? $userSid : 0;  
        $this->prpath = paramload('SHELL','prpath');		
		$this->urlpath = paramload('SHELL','urlpath');			
		$this->urltitle = paramload('SHELL','urltitle');			
		$this->session_use_cookie = paramload('SHELL','sessionusecookie');	
				
		$this->url = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
		$this->url.= $_SERVER['HTTP_HOST'];		
		
		$this->lan = getlocal() ? getlocal() : '0';		
		$lans = arrayload('SHELL','languages');
		$this->language = $lans[$this->lan];		
		$isolans = arrayload('SHELL','isolangs');
		$this->isolanguage = $isolans[$this->lan];
		//echo $this->isolanguage,'>';		
		
		$fpath = paramload('FRONTHTMLPAGE','path');
		$this->htmlpage = $fpath ? $fpath : 'html'; 
				
		//check if html file name based on action exist
		$cmd = GetParam('FormAction') ? GetParam('FormAction') : GetReq('t');
		if ($cmd) {
			$mylan = getlocal() ? getlocal() : '0';
			$autofile = GetGlobal('UserID') ? $cmd . '_in' . $this->lan . '.html' : $cmd . $this->lan . '.html';
		  
			$htmlfile = $this->prpath . $this->htmlpage . "/" . $autofile;
			if (!is_readable($htmlfile)) //default
				$htmlfile = $file ? $this->prpath . $this->htmlpage . "/" . $file : null;
		}
		else
			$htmlfile = $file ? $this->prpath . $this->htmlpage . "/" . $file : null;
		//echo '>',$htmlfile;
		
		//$cphtmlpath = '/cp/' . $this->htmlpage;		
		$this->htmlfile = $htmlfile;
		//echo '>',$this->htmlfile;

		$p = explode(".",$file);
		//$this->argument = strtoupper($p[0]); //the name without ext		
		//in case of dot(.) in name
		$extension = array_pop($p);
		//now with the rest of array
		$pdotname = implode('.',$p);
		$this->argument = strtoupper($pdotname); //the name with dots and without ext		
		//echo $this->argument,'>';
	
		$this->modify = urldecode(base64_decode(GetReq('modify')))=='stereobit' ? true : false;
   
		$this->verbose = remote_paramload('FRONTHTMLPAGE','verbose',$this->prpath); 
		$this->edithtml = remote_paramload('FRONTHTMLPAGE','edithtml',$this->prpath); 
	  	$this->editmode_point  = '[E]';		
		
		$htmlfile_extension = remote_paramload('FRONTHTMLPAGE','htmlext',$this->prpath);
        $this->htmlext = $htmlfile_extension ? $htmlfile_extension : '.htm'; 		
		
		self::$staticpath = paramload('SHELL','urlpath');
		self::$staticprpath = paramload('SHELL','prpath');
		
		$this->template = remote_paramload('FRONTHTMLPAGE','template',$this->prpath);
		$this->cptemplate = remote_paramload('FRONTHTMLPAGE','cptemplate',$this->prpath);
		
		//body name is the taged name inside template files which replace MEDIA_CENTER/INDEX
		$this->bodyname =   strstr($_SERVER['REQUEST_URI'], 'cp/') ? //is in cp
								null : //old method when in cp
								remote_paramload('FRONTHTMLPAGE','bodyname',$this->prpath);
        //when dac =true means that all is inside a phar stream file or fetched from phpdac7 stream	
        //then when localpath =true fetch templates from local project path		
		$_localp =  strstr($_SERVER['REQUEST_URI'], 'cp/') ? //is in cp
						null : //old method when in cp
						remote_paramload('FRONTHTMLPAGE','localpath',$this->prpath);
		self::$localpath = $_localp ? true : false;
		
		$this->BASE_URL = $this->baseURL();
		$this->MC_TEMPLATE = $theme ? $theme : 
		                     (strstr($_SERVER['REQUEST_URI'], 'cp/') ? //is in cp
								$this->cptemplate : $this->template); 		
		$this->MC_ROOT = $this->mcRoot($this->MC_TEMPLATE);
		$this->MC_DEBUG = remote_paramload('FRONTHTMLPAGE','debug',$this->prpath);
		$this->MC_CURRENT_PAGE = null;	

        $this->anel = remote_paramload('FRONTHTMLPAGE','anel',$this->prpath); 		
		$this->anel_signin = remote_paramload('FRONTHTMLPAGE','anelsignin',$this->prpath); 		
		
		//problem returning part (outside html body)
		$this->preprocess = 0;//_v('pcntl.preprosess')

		//print_r(str_replace(';','<br/>',GetSessionParam('cmsTemplates')));		

		//cmsTemplate stack - start/reset	
		self::$cmsTemplates[$this->htmlfile] = 1;
		/*if (isset($_GET['modify'])) {}
		elseif (strpos($_SERVER['REQUEST_URI'], 'cp/')) {}
        else {		
			echo '!!!sss';
			SetSessionParam('cmsTemplates', self::$cmsTemplates);	//reset / start ehen not in cp	
		}*/
		//echo $_SERVER['REQUEST_URI'];
	}	
	
    public function render($actiondata, $extraTokens=null) { 
		global $_cleanOB;

	    if ($this->modify) 
			$out = $this->modify_page();
 
        $out .= $this->process_html_file($actiondata, $this->modify, $extraTokens);		  
	  		   	 
		//timer
		$this->t_fronthtmlpage->stop('fronthtmlpage');
		
		//if ($_cleanOB > 2) 
			//ob_clean ();
	  	  		  
		return ($out);
    }

	public function pushTokens($str=null) {
		global $_tokens;
		//echo $str;
		
		if ($str) {
			//echo hex2bin($str);
			$gz = bzdecompress(hex2bin($str));
			//echo $gz;
			//$this->tokens = json_decode($gz);
			//print_r($this->tokens);
			
			$_tokens = json_decode($gz);
			//print_r($_tokens);
			return true;
		}	
		
		return false;
	}	
	
	protected function process_html_file($data, $admin=null, $extraTokens=null) {
		global $_tokens, $_html;
		
		if ($admin) { 
			if ($this->anel) 
				$htmldata = $this->anel_panel(); //anel angular js
			elseif ($this->cptemplate)
				$htmldata = $this->cpanel_iframe();
			else
				$htmldata = 'cptemplate missing';	

			return ($htmldata);
		}
		
		//First basic tokens 
		$isServer = (!empty($_SERVER)) ? true : false;
		$tokens['http'] = $isServer ? ((isset($_SERVER['HTTPS'])) ? 'https://' : 'http://') : paramload('SHELL','protocol');	//0
		$tokens['host'] = $isServer ? $_SERVER['HTTP_HOST'] : paramload('SHELL','ip'); //1
		$tokens['requri'] = $isServer ? $_SERVER['REQUEST_URI'] : '.'; //2
		$tokens['charset'] = paramload('SHELL','charset');		//3	
		$tokens['urlbase'] = paramload('SHELL','urlbase');
		$tokens['reqcat'] = GetReq('cat');
		$tokens['reqid'] = GetReq('id');
		$tokens['reqpage'] = GetReq('page');
		
		//extra tokens at runtime (dac7 pcntlui)
		if (!empty($extraTokens)) {
			foreach ($extraTokens as $n=>$v) //push tokens
				$tokens[$n] = $v;
		}	
		
		if (isset($_html)) {
			$htmdata = $_html;
		}			
		elseif ($this->htmlfile) {
			//$htmdata = file_get_contents($this->htmlfile);
			//$htmdata = GetGlobal('controller')::streamfile_contents($this->htmlfile);
			$htmdata = self::streamfile_contents($this->htmlfile); //ver 5
		}
		else {
			$hfile = $this->htmlfile ? $this->htmlfile : 'none';	
			return "Undefined template data ($hfile)";
		}	
		
		//htmdata exists		
		$this->process_javascript($htmdata, $pageout);		
		$ret = $this->process_commands($pageout);
		$_ARG = $this->bodyname ? $this->bodyname : $this->argument; //"XDATA";		
		//echo $_ARG;	
		$ret = str_replace("<?". $_ARG ."?>",$data,$ret);					
		
		if (!empty($_tokens)) {
			$ret = $this->process_loop($ret, $_tokens, $tokensLoop); //ret tokens
			//print_r($tokens);
			//if (!empty($tokensLoop))//no need
				//array_merge_recursive($tokens, $tokensLoop);
			foreach ($tokensLoop as $n=>$v) //push tokens
				$tokens[$n] = $v;
		}
		$this->process_tokens($tokens, $ret);			

		//if (!$this->session_use_cookie) //DISABLED
			//$ret = $this->propagate_session($ret); 
		
		return ($ret);	
	}
	
	//process named tokens[last or oneitem] to the whole html body
	public function process_tokens($tokens, &$data) {
		if (empty($tokens)) return false;
		//print_r($tokens);
		foreach ($tokens as $name=>$value) 
			$data = str_replace("{{{$name}}}", $value, $data);
			
		return true;	
	}	
	

	//execute loop areas with named tokens and return last token array set
	//for full text named tokens replacements
	public function process_loop($data, $tokensarray=null, &$retTokens=null) {
		if (!$tokensarray) return $data; //as is
		$retTokens = array();
		
		$pattern = "@<phpdac-loop.*?>(.*?)</phpdac-loop>@s";
		preg_match_all($pattern, $data, $matches, PREG_PATTERN_ORDER);
		if (!$matches[1]) return $data; // as is
		
		foreach ($matches[1] as $r=>$cmd) {
			//echo '<br/>' . $r . '--------------------------------->';
			$repl = $cmd; //reset
			foreach ($tokensarray as $tokens) {
				//print_r($tokens);		
				//echo $tokens->itmname .  '<br/>';
				foreach ($tokens as $name=>$value) {
			
					$repl = str_replace("{{{$name}}}", $value, $repl);
					$retTokens[$name] = $value; //save ret values
				}
			}
			//$_cmd = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", "", $cmd)));
			//$ret = _m($_cmd); //,1); //no error stop 					 
			$data = str_replace("<phpdac-loop-$r>". $cmd . "</phpdac-loop>", $repl, $data);			
		}
	  
		return ($data);
	}	

	public function process_commands($data,$is_serialized=null) {
		$debug = false;
		if ($is_serialized) 
			$data = unserialize($data);
	  
		$pattern = "@<phpdac.*?>(.*?)</phpdac>@s";
		preg_match_all($pattern, $data, $matches, PREG_PATTERN_ORDER);

		foreach ($matches[1] as $r=>$cmd) {
			
			if ($debug==true)
				echo '<br/>' . $cmd;
			
			$_cmd = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", "", $cmd)));
			$ret = _m($_cmd); //,1); //no error stop 					 
			$data = str_replace("<phpdac>".$cmd."</phpdac>",$ret,$data);
		}
	  
		return ($data);
	}
	
	protected function process_javascript($data, &$pageout) {
		//global $_tokens; //if _tokens exist do not load generated js 
		
		//call javascript 
		if (defined('JAVASCRIPT_DPC')) { //REMOVE JAVASCRIPT_DPC when js not needed		  
		//if ((empty($_tokens)) && (defined('JAVASCRIPT_DPC'))) {		  

			_m('javascript.onLoad');
			$jret = _m('javascript.callJavaS');
			//echo $jret;
			//if ($jret) 
			$pageout = str_replace("</body>", $jret."</body>", $data); //body jqgrid problem 
		}
		else
			$pageout = $data; //as is	
	}

	protected function propagate_session($data,$ext='.php') {
	
		$ret = str_replace($ext.'?',$ext."?".SID."&",$data);//.php with args	
		$ret2 = str_replace($ext.'"',$ext."?".SID.'"',$ret);//.php without args
	  
		return ($ret2);
	}

	public function get_copyright($fromyear=null) {
	    $is_cropwiz = (GetSessionParam('LOGIN')=='yes') ? $this->app_crop_wizard() : null;
		$url = paramload('SHELL','urlbase');
	    $t = '<a href="'.$url.'">'.remote_paramload('INDEX','title',$this->prpath).'</a>';
		$y = $fromyear?$fromyear.'-'.date('Y'):date('Y');
	    $ret .= "&copy; $y, $t &nbsp;";// - All Rights Reserved. ";	  
		
		if (!$is_cropwiz)
		  $ret .= $this->get_admin_link();
				
		return ($ret);	
	}	

	public function get_admin_link($notheme=false) {	
	
		if (is_array($_GET)) {
		  foreach ($_GET as $i=>$t) {
		    if ( ($i!='action') && ($i!='turl') ) 
		      $newquery .= '&'.$i.'='.urlencode($t);
	      }
		}
		else 
		  $newquery = '&t=';		
		  
		$mynewquery = $newquery?$newquery:null;//'&t=';  
			
		$current_page = pathinfo($_SERVER['PHP_SELF']);//parse_url($_SERVER['PHP_SELF'],PHP_URL_PAGE);				
		$target_url = urlencode(encode($current_page['basename'] . "?".$mynewquery));		
        $admin_url = '/' . $current_page['basename'] . "?modify=".encode('stereobit')."&turl=".$target_url;		
		$icon_file = $this->urlpath . '/images/editpage.png';
		
        SetSessionParam('authverify',1);		
		/*	
		$ret .= $notheme ? seturl("modify=".urlencode(base64_encode('stereobit'))."&turl=".$target_url.$mynewquery):
		                   seturl("modify=".urlencode(base64_encode('stereobit'))."&turl=".$target_url.$mynewquery,$this->editmode_point); 	
		*/		
		$modurl = "modify=" . urlencode(base64_encode('stereobit')). "&turl=". $target_url . $mynewquery;		
		$ret .= ($notheme) ? _m("cmsrt.seturl use $modurl+++1") : _m("cmsrt.seturl use $modurl+{$this->editmode_point}++1");				   
			
		return ($ret);
	}
	
	protected function modify_page() {
	    //echo 'modify';
	}
	
	//demo admin
	public function get_admin_demo_link($editmode_point=null) {

		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;
       	
		if (is_array($_GET)) {
		  foreach ($_GET as $i=>$t) {
		    if ( ($i!='action') && ($i!='turl') ) 
		      $newquery .= '&'.$i.'='.urlencode($t);
	      }
		}
		else 
		  $newquery = '&t=';		
		  
		$mynewquery = $newquery ? $newquery : null;  
			
		$current_page = pathinfo($_SERVER['PHP_SELF']);			
		$target_url = urlencode(base64_encode($current_page['basename'] . "?".$mynewquery));		

		if ($editmode_point) {
			$img = "<img src='$editmode_point' />";
			$ret = "<a href='$httpurl/cp.php?turl=".$target_url ."' alt='e-Enterprise'>".$editmode_point."</a>"; 	
		}	
		else
            $ret = "$httpurl/cp.php?turl=".$target_url; 	
		
		return ($ret);
	}	

	protected function anel_panel($query=null) {
		$is_oversized = $this->app_is_oversized();
		$is_cpwizard = $this->app_cp_wizard();
		$is_cropwiz = (GetSessionParam('LOGIN')=='yes') ? $this->app_crop_wizard() : null;
		
		if (is_array($_GET)) {
		  foreach ($_GET as $i=>$t) {
		    if ( ($i!='pcntladmin') && ($i!='action') ) //??action //bypass pcntladmin=.. param for repoladn same url...
		      $newquery .= '&'.$i.'='.$t;
	      }
		}
		else 
		  $newquery = '&t=';		  
		  
	    $query = $query?$query:$newquery;
        $turl = urldecode(decode(GetReq('turl')));			
		$mc_page = $this->mc_parse_editurl($turl);		
        $this->MC_CURRENT_PAGE = $mc_page;		
		$file2edit = $this->MC_TEMPLATE ? $mc_page : strtolower($this->argument).$this->htmlext;
		
		//save params
		@file_put_contents('cp/.turl',urlencode(base64_encode($turl)),LOCK_EX);
		@file_put_contents('cp/.htmlfile',urlencode(base64_encode($file2edit)),LOCK_EX);
		
		$mainframe_url = $this->url . str_replace('.','#',$this->anel);	
			
		$fp = <<<EOF
<html>
  <head>
    <title>IU Webmaster redirect</title>
    <META http-equiv="refresh" content="0;URL=$mainframe_url">
  </head>
  <body bgcolor="#ffffff">
    <center>You will be redirected to the new cp location automatically in 1 second. </center>
  </body>
</html>

EOF;
	   
	   return ($fp);
	}

	//cpanel template iframe win
    protected function cpanel_iframe($query=null) {
		$is_oversized = $this->app_is_oversized();
		$is_cpwizard = $this->app_cp_wizard();
		$is_cropwiz = (GetSessionParam('LOGIN')=='yes') ? $this->app_crop_wizard() : null;
		
		if (is_array($_GET)) {
		  foreach ($_GET as $i=>$t) {
		    if ( ($i!='pcntladmin') && ($i!='action') ) //??action //bypass pcntladmin=.. param for repoladn same url...
		      $newquery .= '&'.$i.'='.$t;
	      }
		}
		else 
		  $newquery = '&t=';		  
		  
	    $query = $query?$query:$newquery;
        $turl = urldecode(decode(GetReq('turl')));			
		$mc_page = $this->mc_parse_editurl($turl);		
        $this->MC_CURRENT_PAGE = $mc_page;		
		$file2edit = $this->MC_TEMPLATE ? $mc_page : strtolower($this->argument).$this->htmlext;
		
		//save params
		@file_put_contents('cp/.turl',urlencode(base64_encode($turl)),LOCK_EX);
		@file_put_contents('cp/.htmlfile',urlencode(base64_encode($file2edit)),LOCK_EX);
		
		if (GetSessionParam('LOGIN')=='yes') {
			if (($this->argument) && ($this->edithtml)) {
				//edit html...
				if ($is_cpwizard)
				    $mainframe_url = $this->url;
				elseif ($is_cropwiz)	
					$mainframe_url = $turl; //$this->url;					
				else
				    $mainframe_url = $is_oversized ? $this->self_addspace(true) : $this->cpeditor($file2edit);
		    }						 
			else {
                if ($is_cpwizard)
				    $mainframe_url = $this->url;
				elseif ($is_cropwiz)	
					$mainframe_url = $turl; 					
				else			
				    $mainframe_url = $is_oversized ? $this->self_addspace(true) : $this->cpfp($turl);
			}					 
		}  
		else { 
		    if ($is_cpwizard)
				$mainframe_url = $this->url;
			else
			    $mainframe_url = $is_oversized ?  $this->self_addspace(true) : $this->cpfp($turl);
	  	}
	
	    //loading text : stackoverflow.com/questions/8626638/how-to-display-loading-message-when-an-iframe-is-loading
		$fp = <<<EOF
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="EN"> 
<head> 
<title>e-Enterprise</title>
<meta http-equiv="Content-Type" content="text/html; charset=$encoding" />   
	<style type="text/css">
		body { margin: 0; overflow: hidden; }
		.mainframe { position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;  
					 /*background: url('data:image/svg+xml;charset=utf-8,<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 100% 100%"><text fill="%23FF0000" x="50%" y="50%" font-family="\'Lucida Grande\', sans-serif" font-size="24" text-anchor="middle">Loading</text></svg>') 0px 0px no-repeat;*/
					 background:url(images/loading.gif) center center no-repeat; 
				   }	   
	</style>
</head> 
<body> 
<div class="mainframe">
<iframe id="mainFrame" name="mainFrame" src="$mainframe_url" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="100%" scrolling="auto"></iframe> 
</div>
</body> 
</html>

EOF;
	   
	   return ($fp);
	}	
	
	protected function cpfp($turl) {
			
		$ret = 	$this->url . "/cp/cp.php?turl=" . urlencode(base64_encode($turl));		
		return ($ret);
	}	
	
	protected function cpeditor($file) {
			
		$ret = 	$this->url . "/cp/cpmhtmleditor.php?htmlfile=" . urlencode(base64_encode($file));		
		return ($ret);
	}		
	
	protected function self_addspace($retlink=false) {
			
		$ret = $retlink ? $this->url . '/cp/cp.php?t=cpupgrade&wf=addspace' :
			              "<a href='{$this->url}/cp/cp.php?t=cpupgrade&wf=addspace'>" . localize('_addspace', getlocal())."</a>";				
		return ($ret);
	}	
	
	protected function app_cp_wizard() {
	    $wizfile = $this->prpath . 'cpwizard.ini';
		
	    if (is_readable($wizfile)) 
		    return true;   

		return false;
	}
	
	protected function app_crop_wizard() {
	    $cropfile = $this->prpath . 'crop.ini';
		
	    if ((is_readable($cropfile)) || (GetReq('cropwiz')))  
		    return true;   	

		return false;
	}	

    protected function get_app_size() {
  
		$tsize = $this->cached_disk_size();
        $dsize = $this->cached_database_filesize();	
		$total_size = $tsize + $dsize;
 
		return ($total_size);
    }

    protected function app_is_oversized() {
		
		if(substr(PHP_OS, 0, 3) == "WIN")
			return false; //never
  
        $allowed_size = intval(@file_get_contents($this->prpath .'/maxsize.conf.php'));	
		$current_size = $this->get_app_size();				
					   
		if ($allowed_size < $current_size)			   
		    return ($current_size);
		
        return false;		
    }  
	
	
    protected function bytesToSize1024($bytes, $precision = 2) {
        $unit = array('B','KB','MB','GB');
        return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), $precision).' '.$unit[$i];
    }  
 
 
    protected function filesize_r($path){
		if (!file_exists($path)) return 0;
		
	    if (is_file($path)) return filesize($path);
		$ret = 0;
		
		$glob = glob($path."/*", GLOB_NOSORT);
		
		if (is_array($glob)) {
			foreach(glob($path."/*", GLOB_NOSORT) as $fn)
				$ret += $this->filesize_r($fn);
		}	
		return $ret;
    } 
  
    protected function cached_disk_size($path=null) {
		$path = $path ? $path : $this->urlpath; 
		$tsize = $this->prpath . 'a-tsize.size';
		$size = 0;

		if (is_readable($tsize)) 
			$size = @file_get_contents($tsize);
		else {
            $size = $this->filesize_r($path);
			@file_put_contents($tsize, $size);
		}
	   
		return ($size);
    }
  
    protected function cached_database_filesize() {
		$db = GetGlobal('db'); 
		$size = 0;
	
		if ($db) {
			$dsize = $this->prpath . 'a-dsize.size';	
    
			if (is_readable($dsize)) 
				$size = @file_get_contents($dsize);
			else {
				$sSQL = "SHOW TABLE STATUS";
				$res = $db->Execute($sSQL,2);		
				$size = 0;

				if (!empty($res)) { 
					foreach ($res as $n=>$rec) {
						$size += $rec[ "Data_length" ] + $rec[ "Index_length" ];					
					}
				}
				@file_put_contents($dsize, $size);
			}	
		}	
		
		return ($size);
    }		
	
	
	/********* PUBLIC FUNCS *********/
	
	public function combine_tokens(&$template, $toks, $execafter=null) {
	    //if (!is_array($tokens)) return ($template);		

		if (!$execafter) 
			$ret = $this->process_commands($template);	  		
		else
			$ret = $template;
		
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
	
	public function included($fname=null, $uselans=null, $enable_ajax=false) {
	
	    if ($fname) {
			$name = ($uselans) ? str_replace('.', getlocal() . '.', $fname) : $fname;	
			$pathname = $this->urlpath . '/cp/'.$name;

			//if (is_readable($pathname)) {
				//$contents = @file_get_contents($pathname);
				//...
			if ($contents = trim(self::streamfile_contents($pathname))) {
				
				self::stackTemplate($pathname);
				$ret = $this->process_commands($contents);
				return ($ret);
			}
        }	
        return null; 		
	}
	
	public function php_self($usedomain=null) {
	
	    if ($usedomain)
		  $ret = $this->url . '/';
		  
	    $ret .= $_SERVER['REQUEST_URI'];// ? '/'.$_SERVER['REQUEST_URI'] : null;
		return urldecode($ret);
	    //return $_SERVER['PHP_SELF'];
    }
	
	public function phpcode($evalCode=null) {
		if (!$evalCode) return null;
		
		/*if ((substr($evalCode,0,2)=='<?') &&
		   (substr($evalCode,0,5)!='<?php'))
			echo "php:($evalCode)<br/>";
		*/
		if (strstr($evalCode, '?>')) {
			//$evalCode = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", "", $evalCode)));
			$evalCode = '?>' . $evalCode . ((substr($evalCode, -2) == '?>') ? '<?php ' : '');
			return eval($evalCode);
		}

		return $evalCode; //return no php code
	}

	public function nvl($param=null,$state1=null,$state2=null,$value=null) {
	    global ${$param};
		
	    $var = (stristr($param,'.')) ? _v($param) :
					(GetGlobal($param) ? GetGlobal($param) : (GetParam($param) ? GetParam($param) : $_SESSION[$param]));				
		
        if ($value) { 
			if (strstr($value, '?>'))
				$ret = ($this->phpcode($value)==$var) ? $this->phpcode($state1) : $this->phpcode($state2);		
			elseif (strstr($value, '|')) {
			    $nvalues = explode('|',$value); 
				$ret = (in_array($var, $nvalues)) ? $this->phpcode($state1) : $this->phpcode($state2); 
			}
			elseif (strstr($value, '.'))
				$ret = (_v($value)==$var) ? $this->phpcode($state1) : $this->phpcode($state2);
			else	
				$ret = ($value==$var) ? $this->phpcode($state1) : $this->phpcode($state2);  		
		}   
        else
			$ret = $var ? $this->phpcode($state1) : $this->phpcode($state2);
		   
		return ($ret);
    }
	
	/*numeric ver*/
	public function nvlnum($param=null,$state1=null,$state2=null,$value=null) {
	    global ${$param};
		
	    $var = (stristr($param,'.')) ? _v($param) :
					(GetGlobal($param) ? GetGlobal($param) : (GetParam($param) ? GetParam($param) : $_SESSION[$param]));				
			
        if ($value) { 
			if (!is_numeric($var)) $this->phpcode($state2);
				
			if (strstr($value, '?>'))
				$ret = ($this->phpcode($value)==$var) ? $this->phpcode($state1) : $this->phpcode($state2);		
			elseif (strstr($value, '|')) {
			    $nvalues = explode('|',$value); 
				$ret = (in_array($var, $nvalues)) ? $this->phpcode($state1) : $this->phpcode($state2); 
			}
			elseif (strstr($value, '.'))
				$ret = (_v($value)==$var) ? $this->phpcode($state1) : $this->phpcode($state2);
			else	
				$ret = ($value==$var) ? $this->phpcode($state1) : $this->phpcode($state2);  		
		}   
        else
			$ret = is_numeric($var) ? $this->phpcode($state1) : $this->phpcode($state2);
		   
		return ($ret);
    }	
	
	public function nvltokens($token=null,$state1=null,$state2=null,$value=null) {
	    //always string compare...
		if ($value) {	
			if (strstr($value, '?>'))
				$ret = ($this->phpcode($value)==$token) ? $this->phpcode($state1) : $this->phpcode($state2);		
			elseif (strstr($value, '|')) {
			    $nvalues = explode('|',$value); 
				$ret = (in_array($token, $nvalues)) ? $this->phpcode($state1) : $this->phpcode($state2); 
			}
			elseif (strstr($value, '.'))
				$ret = (_v($value)==$token) ? $this->phpcode($state1) : $this->phpcode($state2);  	 			
			else		
				$ret = ($token==$value) ? $this->phpcode($state1) : $this->phpcode($state2);  	
		}	
        else		
           $ret = $token ? $this->phpcode($state1) : $this->phpcode($state2);
		   
		return ($ret);

    }	
	
	public function nvldecode($token=null,$state1=null,$state2=null,$value=null,$default=null) {

		if (is_numeric($value)) { 
            $ret = $default ? $default : (($token==$value) ? $this->phpcode($state1) : $this->phpcode($state2));			
		}   
		elseif ($value) {
			if (strstr($value, '?>'))
				$ret = ($this->phpcode($value)==$token) ? $this->phpcode($state1) : $this->phpcode($state2);		
			elseif (strstr($value, '|')) {
			    $nvalues = explode('|',$value); 
				$ret = $default ? $default : ((in_array($token, $nvalues)) ? $this->phpcode($state1) : $this->phpcode($state2)); 
			}
			elseif (strstr($value, '.'))
				$ret = $default ? $default : ((_v($value)==$token) ? $this->phpcode($state1) : $this->phpcode($state2));   			
			else			
				$ret = $default ? $default : (($token==$value) ? $this->phpcode($state1) : $this->phpcode($state2));  	
		}	
        else 	
           $ret = $token ? $this->phpcode($state1) : $this->phpcode($state2);
  
		return ($ret);
    }		
	
	/*single dac cmds per state*/
	public function nvldac($param=null,$state1=null,$state2=null,$value=null) {
	    
	    $var = (stristr($param,'.')) ? _v($param) :
						(GetGlobal($param) ? GetGlobal($param) : (GetParam($param) ? GetParam($param) : $this->{$param}));		
		
        if ($value) { 
			if (strstr($value, '?>'))
				$ret = ($this->phpcode($value)==$var) ? _m(str_replace('::','+',$state1)) : _m(str_replace('::','+',$state2));		
			elseif (strstr($value, '|')) {
			    $nvalues = explode('|',$value); 
				$ret = (in_array($var, $nvalues)) ? _m(str_replace('::','+',$state1)) : _m(str_replace('::','+',$state2)); 
			}
			elseif (strstr($value, '.'))
				$ret = (_v($value)==$var) ? _m(str_replace('::','+',$state1)) : _m(str_replace('::','+',$state2));  		
			else
				$ret = ($value==$var) ? _m(str_replace('::','+',$state1)) : _m(str_replace('::','+',$state2));   		
		}		   
        else      
           $ret = $var ? _m(str_replace('::','+',$state1)) : _m(str_replace('::','+',$state2));				  

		return ($ret);

    }	
	
	/*split and execute multiple dac cmds*/
	protected function dacexec($dcmds=null) {
	    if (!$dcmds) return null;
		$ret = null;
		
	    $mcmds = explode('::',$dcmds);
		foreach ($mcmds as $c=>$cmd) { 
		
			$mycall = str_replace(array(':','|','^'),array(' use ','+','|'),$cmd);
			$ret .= _m($mycall);
		}  
		return ($ret);
	}
	
	/*multiple dac cmds per state*/
	public function nvldac2($param=null,$states1=null,$states2=null,$value=null) {

	    $var = (stristr($param,'.')) ? _v($param) : 
		                (GetGlobal($param) ? GetGlobal($param) : (GetParam($param) ? GetParam($param) : $this->{$param}));

        if ($value) {    
			if (strstr($value, '?>'))
				$ret = ($this->phpcode($value)==$var) ? $this->dacexec($states1) : $this->dacexec($states2);			
			elseif (strstr($value, '|')) {
			    $nvalues = explode('|',$value); 
				$ret = (in_array($var, $nvalues)) ? $this->dacexec($states1) : $this->dacexec($states2) ; 
			}
			elseif (strstr($value, '.'))
				$ret = (_v($value)==$var) ? $this->dacexec($states1) : $this->dacexec($states2) ;
			else		
				$ret = ($value==$var) ? $this->dacexec($states1) : $this->dacexec($states2) ;
		}						   
        else      
            $ret = $var ? $this->dacexec($states1) : $this->dacexec($states2) ;				  

		return ($ret);

    }	

    public function nvlfile($filename=null,$states1=null,$states2=null) {
	    if (!$filename) return null;
		
	    if (file_exists($filename))
			$ret = $this->dacexec($states1); 
		else	
		    $ret = $this->dacexec($states2);	
		return ($ret);	
	}
	
	//dummy dpc exec
	public function nvlnull() {
	    return ''; 
    }	
	
	//used in front page as login / logout
	static public function myf_button($title,$link=null,$image=null) {

	   $path = self::$staticpath;
	   
	   if (($image) && (is_readable($path."/images/".$image.".png"))) 
	      $imglink = "<a href=\"$link\" title='$title'><img src='images/".$image.".png'/></a>";
	   
	   if (preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT'])) { 
	      //echo 'ie';
		  $_b = $imglink ? $imglink : "[$title]";
		  $ret = "&nbsp;<a href=\"$link\">$_b</a>&nbsp;";
		  return ($ret);
	   }	
	   
	   if ($imglink)
	       return ($imglink);
	
       //else button	
	   if ($link)
	      $ret = "<a href=\"$link\">";
		  
	   $ret .= "<input type=\"button\" class=\"myf_button\" value=\"".$title."\" />";
	   
	   if ($link)
          $ret .= "</a>";	   
		  
	   return ($ret);
	}		
	
	/*template engine functions*/
    public function getGlobal($param, $isSession=false) {
		if ($isSession) 
			return ($_SESSION[$param]);
  
		return ($GLOBALS[$param]);
    }

	public function setGlobal($param,$val=null,$isSession=false) {
	    if ($isSession) 
			$_SESSION[$param] = $val;
		else	
		    $GLOBALS[$param] = $val;
	}	
	
    public function getParam($param) {
		if ($_POST[$param]) 
			return ($_POST[$param]);
  
		return ($_GET[$param]);
    }		
	
	public function serverSTR($str=null) {
	    $server_str = $str ? $str : 'REQUEST_URI';
	    return htmlspecialchars($_SERVER[$str]);
	}
	
	public function baseURL($uri=null){
	    $request_uri = $uri ? $uri : $_SERVER['REQUEST_URI'];
		return ($this->url);
	}

    public function mcRoot($tmplname=null) {
	   $tmplpath = $tmplname ? $tmplname : null;
	   
	   $this->MC_ROOT = $this->prpath . $this->htmlpage . "/" . $tmplpath; //dirname(__FILE__);
	   return ($this->MC_ROOT);
    }

	public function include_part($fname=null, $args=null, $uselans=null, $tmplname=null) {	
	    $tmpln = $tmplname ? $this->mcRoot($tmplname) . $fname : 
		                     $this->mcRoot($this->MC_TEMPLATE) . $fname;
	    //echo 'INCLUDE_PART :'.$tmpln . '<br>';
		$pattern = "@<(.*?)>@"; /*search for content params*/
		$arguments = explode('|',$args);
		//print_r($arguments);
		
	    if ($fname) {
		    if ($uselans) {
			    $pathname = $tmplname ? 
				            str_replace($tmplname, $tmplname.'/'.$this->lan, $tmpln) :
				            str_replace($this->MC_TEMPLATE, $this->MC_TEMPLATE.'/'.$this->lan, $tmpln);
			}
			else
			    $pathname = $tmpln;
				
			//echo 'INCLUDE_PART:'.$pathname;
			//if ($contents = trim(@file_get_contents($pathname))) {	
			//if ($contents = trim(GetGlobal('controller')::streamfile_contents($pathname))) {	
			if ($contents = trim(self::streamfile_contents($pathname))) { //ver 5	
			
				self::stackTemplate($pathname);
				
				$contents = $this->dCompile($contents);
				
				//replace content args
				if (!empty($arguments)) {
					preg_match_all($pattern,$contents,$matches);
					foreach ($matches[1] as $r=>$cmd) {
						$arg = array_shift($arguments); //form 1st to last
						$contents = str_replace('<arg'.$r.'>',$arg,$contents);
					}				
			    }
				
				//execute commands
				$ret = $this->process_commands($contents);
			
				return ($ret);
			}

        }	
		if ($this->MC_DEBUG)
			return ('<b>Invalid part:</b>'.$pathname);
		else	
			return null; 		
	}
	
	/*fname argument*/
	public function include_part_arg($fname=null, $args=null, $uselans=null, $tmplname=null) {
	    $pattern = "@<(.*?)>@"; /*search for fname params*/
	    preg_match_all($pattern,$fname,$matches);
	  
        foreach ($matches[1] as $r=>$cmd) {
		  //echo $cmd . '>' . GetGlobal($cmd);	
		  $arg = GetParam($cmd) ? GetParam($cmd) : GetGlobal($cmd);
		  $fname_arg = str_replace('<'.$cmd.'>',$arg,$fname);
	    }	
	
	    $tmpln = $tmplname ? $this->mcRoot($tmplname) . $fname_arg : 
		                     $this->mcRoot($this->MC_TEMPLATE) . $fname_arg;
	    //echo 'INCLUDE_PART_ARG:'.$tmpln;
		$arguments = explode('|',$args);
		
	    if ($fname) {
		    if ($uselans) {
			    $pathname = $tmplname ? 
				            str_replace($tmplname, $tmplname.'/'.$this->lan, $tmpln) :
				            str_replace($this->MC_TEMPLATE, $this->MC_TEMPLATE.'/'.$this->lan, $tmpln);
			}
			else
			    $pathname = $tmpln;
				
			//echo 'INCLUDE_PART:'.$pathname;
			//if ($contents = trim(@file_get_contents($pathname))) {	
			//if ($contents = trim(GetGlobal('controller')::streamfile_contents($pathname))) {
			if ($contents = trim(self::streamfile_contents($pathname))) {//ver 5

			    self::stackTemplate($pathname);
			
				$contents = $this->dCompile($contents);
				
				//replace content args
				if (!empty($arguments)) {
					preg_match_all($pattern,$contents,$matches);
					foreach ($matches[1] as $r=>$cmd) {
						$arg = array_shift($arguments); //form 1st to last
						$contents = str_replace('<arg'.$r.'>',$arg,$contents);
					}				
			    }				
			    //js for arg include 
			    $this->process_javascript($contents, $pageout);
				//execute commands
				$ret = $this->process_commands($pageout);
			
				return ($ret);
			}

        }	
		if ($this->MC_DEBUG)
		    return ('<b>Invalid part argument:</b>'.$pathname);
		else  
            return null; 		
	}	
	
	public function dCompile($data=null) {
		if (!$data) return null;
		
		if (substr($data, -2) == '?>') {
			//$data = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", "", $data)));
			$data = '?>' . $data . ((substr($data, -2) == '?>') ? '<?php ' : '');
			return eval($data);				
		}
		elseif (substr($data, -8) == '/phpdac>') {
			//one big cmd with other phpdac inside as raw text
			return _m(substr($data,8,-9));
		}
		else
			return ($data);		
	}	

	/*todo: read form external template file*/
	public function mcPages($retarray=false, $url=null) {
	    $ret = null;
	    $urlpagename = $url ? $url : 'index.php';
		$pages_list_file = $this->prpath.$this->htmlpage."/".$this->MC_TEMPLATE."/pages.ini";
		//echo $pages_list_file,'<br/>';
		if (is_readable($pages_list_file)) //in cp
		  $pages = @parse_ini_file($pages_list_file,false);//,INI_SCANNER_ROW); 
		else   
	      $pages = array(
		'home' => 'Home',
		'home-2' => 'Home Alt',
		'category-grid' => 'Category - Grid/List',
		'category-grid-2' => 'Category 2 - Grid/List',
		'single-product' => 'Single Product',
		'single-product-sidebar' => 'Single Product with Sidebar',
		'cart' => 'Shopping Cart',
		'checkout' => 'Checkout',
		'about' => 'About Us',
		'contact' => 'Contact Us',
		'blog' => 'Blog',
		'blog-fullwidth' => 'Blog Full Width',
		'blog-post' => 'Blog Post',
		'faq' => 'FAQ',
		'terms' => 'Terms & Conditions',
		'authentication' => 'Login/Register',
		'404' => '404',
		'wishlist' => 'Wishlist',
		'compare' => 'Product Comparison',
		'track-your-order' => 'Track your Order'
	    );	
		//print_r($pages);
		if ($retarray) return $pages;
		  
		foreach ( $pages as $key => $packagePage )
			$ret .=	'<li><a href="'.$urlpagename.'?mc_page='.$key.'&amp;style='. $_GET['style'].'">'.$packagePage.'</a></li>';
		return ($ret);
	}
	
	public function mcPagesChunk($chunk=0, $p=6, $url=null) {
	    $pageChunkes = array_chunk($this->mcPages(true), $p, true);
	    $urlpagename = $url ? $url : 'index.php';		
	    $ret = null;		
		
		foreach ( $pageChunkes[$chunk] as $key => $packagePage )
			$ret .=	'<li><a href="'.$urlpagename.'?mc_page='.$key.'&amp;style='. $_GET['style'].'">'.$packagePage.'</a></li>';
		return ($ret);		
	}
	
	public function mcSelectPage($id=null,$defpage=null,$tmplname=null,$forcet=null) {
	    $db = GetGlobal('db');
	    $pageid = $id ? $id : (GetReq('id') ? GetReq('id') : GetReq('cat'));
		$mc_page = GetReq('t') ? GetReq('t') : (isset($_GET['mc_page']) ? $_GET['mc_page'] : $defpage);
		$force_page = GetReq('t') ? GetReq('t') : $_GET['mc_page'];
		
		//override due to cptemplate
		$MC_TEMPLATE = $this->template; 
				
		$mctmpl = $tmplname ? $tmplname : $MC_TEMPLATE;
		
		if ($MC_TEMPLATE) {		
		
			$sSQL = 'select mcname from wftmpl where ';
			$sSQL.= ($pageid) ? 'mcid=' . '"' . $pageid . '" ' : 'mcid=' . '"' . $mc_page . '" ';
			//$sSQL.= 'and mctmpl='. '"' . $mctmpl . '" ';

            //echo $sSQL;			  
			$result = $db->Execute($sSQL,2);
			$page = $result->fields['mcname'];
			
			if ($forcet)
				$ret = $force_page ? $force_page : $page;
			else
				$ret = $page ? $page : $mc_page;

            $this->MC_CURRENT_PAGE = $ret;
		    //echo $this->MC_CURRENT_PAGE;			
			return ($ret); 
		}
        $this->MC_CURRENT_PAGE = $mc_page;
		//echo $this->MC_CURRENT_PAGE;
        return ($mc_page);   		
	}
	
	public function mcSavePage($id=null,$mcpage=null,$tmplname=null) {
	    if ((!$id) || (!$mcpage)) return;
	    $db = GetGlobal('db');
		//$mctmpl = $tmplname ? $tmplname : $this->MC_TEMPLATE;
		
		//override due to cptemplate
		$MC_TEMPLATE = $this->template; 		
		
		$mctmpl = $tmplname ? $tmplname : $MC_TEMPLATE;
		
		if ($MC_TEMPLATE) {		
		
			$sSQL = 'select mcname from wftmpl where ';
			$sSQL.= 'mcid=' . '"' . $id . '" ';
			$sSQL.= 'and mctmpl='. '"' . $mctmpl . '" ';
            //echo $sSQL;			  
			$result = $db->Execute($sSQL,2);
			$current_page = $result->fields['mcname'];
			//echo $current_page,'>';
			if (!$current_page) {
				$sSQL = 'insert into wftmpl (mcid,mcname,mctmpl) values (';
				$sSQL.= "'".$id."',";
				$sSQL.= "'".$mcpage."',";
				$sSQL.= "'".$mctmpl."')";
			}
			else {
				$sSQL = 'update wftmpl set mcname="'. $mcpage .'" where';
				$sSQL.= " mcid='".$id."' and";
				$sSQL.= " mctmpl='".$mctmpl."'";			
			}
			$result = $db->Execute($sSQL);
			//echo $sSQL;
			return true;
		}
        
        return false;   		
	}	
	
	/*fetch t cmd from turl editmode*/
	public function mc_parse_editurl($turl=null) {
	    
	    if ($turl) {
			$pt = explode('?',$turl);
			parse_str($pt[1], $args);
			$query_page = ($args['t']!=null) ? $args['t'] . '.php' : $pt[0];
			$default_page = str_replace('.php','',$query_page);
											   
			/*sql select*/								
			$pageid = $args['id'] ? $args['id'] : ($args['cat'] ? $args['cat'] : ($args['t'] ? $args['t'] : $default_page));	
            $mc_page = $this->mcSelectPage($pageid, $default_page) . '.php';			
			//echo $mc_page;
			return ($mc_page);
		}
		return 'index.php';
	}	
	
	public function mc_read_files($path=null,$ext=null,$url=null,$retarray=null) {
	    $urlpagename = $url ? $url : 'index.php';
	    $path = $path ? $path : null;
		$ext = $ext ? $ext : 'php';

		//override due to cptemplate
		$MC_TEMPLATE = $this->template; 
		
		$bpath = $this->prpath.$this->htmlpage."/".$MC_TEMPLATE.'/'.$path;		
		
	    $mydir = dir($bpath);
		while ($fileread = $mydir->read ()) { 
			if (($fileread!='.') && ($fileread!='..')) {
				if (stristr($fileread,'.'.$ext))
                    $mcfiles[str_replace('.'.$ext,'',$fileread)] = str_replace('.'.$ext,'',$fileread); 				
            }
        }
        ksort($mcfiles);
        //return ($mcfiles);
		if ($retarray) return $mcfiles;
		  
		foreach ( $mcfiles as $mcf => $mcname )
			$ret .=	'<li><a href="'.$urlpagename.'?mc_page='.$mcf.'&amp;style='. $_GET['style'].'">'.$mcname.'</a></li>';
		return ($ret);		
	}
	
	public function current_language() {
		$loclan = localize($this->language, getlocal());
		return ($loclan);
    }	
	
	public function iso_language() {
		return ($this->isolanguage);
    }
	
	public function slocale($id=null) {
	    $ret = localize($id, getlocal());
		return ($ret ? $ret : '_loc_');
	}
	
	public function slocaleParam($param=null) {
		$id = GetGlobal($param) ? GetGlobal($param) : (GetSessionParam($param) ?? getParam($param)); 
	    $ret = localize($id, getlocal());
		return ($ret ? $ret : '_loc_');
	}	
	
	
	//UTF-8
	
	public function strutf2iso($string=null,$encoding='ISO-8859-7') {
		$ret = iconv("UTF-8", 'ISO-8859-7', $string);	
		return ($ret);
	}	
	
	public function strutf2ascii($string=null) { //CP437,ASCII,CP1252
	    //echo 'source:'.$string;
		//$ret = iconv("UTF-8", 'ASCII//TRANSLIT', $string);	
		//$ret = mb_convert_encoding($string,'CP1252');
		$ret = urlencode($string);
		return ($ret);
	}
	
	public function strutf2md5($string=null) {
		$ret = md5($string);
		return ($ret);	
	}
	
	public function echostr($param=null) {
		if (stristr($param,'.')) //dpc var
		  $s = _v($param);
		else  
		  $s = GetGlobal($param) ? GetGlobal($param) : (GetParam($param) ? GetParam($param) : $param);		
		return ($s);
	}
	
    public function cpUsername() {
		$username = GetSessionParam('LoginName') ? GetSessionParam('LoginName') : $_POST['cpuser'];
		$p = explode('@', $username);
		$name =  $p[0];	
		
		return ($name);
    }	
	
	
    protected function javascript_ajax()  {
   
      $jscript = <<<EOF
function createRequestObject() {var ro; var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer"){ro = new ActiveXObject("Microsoft.XMLHTTP");} 
	else{ro = new XMLHttpRequest();} return ro;}
var http = createRequestObject();
function sndUrl(url) {http.open('get', url); http.onreadystatechange = handleResponse; http.send(null);}
function sndReqArg(url) {var params = url; http.open('post', params, true); http.setRequestHeader("Content-Type", "text/html; charset=utf-8");
    http.setRequestHeader("encoding", "utf-8");	http.onreadystatechange = handleResponse; http.send(null);}
function handleResponse() {if(http.readyState == 4){
    var response = http.responseText;
    var update = new Array();
    response = response.replace( /^\s+/g, "" ); 
    response = response.replace( /\s+$/g, "" );		
    if(response.indexOf('|' != -1)) { update = response.split('|');
        document.getElementById(update[0]).innerHTML = update[1];}}}

EOF;

      return ($jscript);
   }

	protected function createcookie_js() {
		
		$ret = '
function cc(name,value,days) {
    if (days) { var date = new Date(); date.setTime(date.getTime()+(days*24*60*60*1000)); var expires = "; expires="+date.toGMTString();} else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/; domain=.'.$_SERVER['HTTP_HOST'].';" }
';
        return ($ret);
	}

	protected function javascript() {
        if (iniload('JAVASCRIPT')) {
           	$code = $this->createcookie_js();				
			$code.= $this->javascript_ajax();

		    $js = new jscript;
            $js->load_js($code,"",1);			   
		    unset ($js);		
     	}	  
	}
	
	//store templates used
	static protected function stackTemplate($tmpl=null) {
		if (!$tmpl) return false;
		if (strstr($tmpl, 'metro/')) return false; //static
		
		self::$cmsTemplates[$tmpl] = 1;
		//SetSessionParam('cmsTemplates', self::$cmsTemplates);
		//$stackT = GetSessionParam('cmsTemplates') . $tmpl . ';';
		//SetSessionParam('cmsTemplates', $stackT);
		return true;
	}
	
	//fetch stream content
	static public function streamfile_contents($f=null, $falt=null) {
		if (!$f) return null;
		global $dac, $st;
		//echo $dac, ':', $st, '-------------------------------------' . PHP_EOL;
		if (($dac) && (self::$localpath==false)) { 
			$fp = str_replace(self::$staticprpath, '/cp/', $f);
			//phpdac7\__log('fetch remote:' . $fp); //dac7 not comaptible
			//echo "$st/www7" . $fp . PHP_EOL;
			return @file_get_contents("$st/www7" . $fp);	
		}
		
		//else filesystem default
		$fout = $falt ? $falt : $f;
		return @file_get_contents($fout);
	}	

	function __destruct() {
		if (isset($_GET['modify'])) {
			//echo 'modify:',$_SERVER['REQUEST_URI'];	
		}
		elseif (strstr($_SERVER['REQUEST_URI'], 'cp/')) {
			//echo 'cp:', $_SERVER['REQUEST_URI'];		
		}
        else {
			//echo $_SERVER['REQUEST_URI'];	
			SetSessionParam('cmsTemplates', self::$cmsTemplates);
			//print_r(GetSessionParam('cmsTemplates'));
		}
	}	

};
}
?>