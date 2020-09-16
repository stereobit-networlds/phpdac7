<?php
$__DPCSEC['RCAPPS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCAPPS_DPC")) && (seclevel('RCAPPS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCAPPS_DPC",true);

$__DPC['RCAPPS_DPC'] = 'rcapps';

require_once(_r('libs/cpanelx3.lib.php'));
require_once(_r('libs/htaccess.lib.php'));
 
$__EVENTS['RCAPPS_DPC'][0]='cpapps';
$__EVENTS['RCAPPS_DPC'][1]='cpappsshow';
$__EVENTS['RCAPPS_DPC'][2]='cpappslink';
$__EVENTS['RCAPPS_DPC'][3]='cpappsview';
$__EVENTS['RCAPPS_DPC'][4]='cpappsviewhtml';
$__EVENTS['RCAPPS_DPC'][5]='cpappsframe';
$__EVENTS['RCAPPS_DPC'][6]='cpappupgrade';
$__EVENTS['RCAPPS_DPC'][7]='cpdoupgrade';
$__EVENTS['RCAPPS_DPC'][8]='cpmupgrade';
$__EVENTS['RCAPPS_DPC'][9]='cpappnew';
$__EVENTS['RCAPPS_DPC'][10]='cpmnew';

$__ACTIONS['RCAPPS_DPC'][0]='cpapps';
$__ACTIONS['RCAPPS_DPC'][1]='cpappssshow';
$__ACTIONS['RCAPPS_DPC'][2]='cpappslink';
$__ACTIONS['RCAPPS_DPC'][3]='cpappsview';
$__ACTIONS['RCAPPS_DPC'][4]='cpappsviewhtml';
$__ACTIONS['RCAPPS_DPC'][5]='cpappsframe';
$__ACTIONS['RCAPPS_DPC'][6]='cpappupgrade';
$__ACTIONS['RCAPPS_DPC'][7]='cpdoupgrade';
$__ACTIONS['RCAPPS_DPC'][8]='cpmupgrade';
$__ACTIONS['RCAPPS_DPC'][9]='cpappnew';
$__ACTIONS['RCAPPS_DPC'][10]='cpmnew';

$__DPCATTR['RCAPPS_DPC']['cpapps'] = 'cpapps,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCAPPS_DPC'][0]='RCAPPS_DPC;Applications;Εφαρμογές';
$__LOCALE['RCAPPS_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['RCAPPS_DPC'][2]='_theme;Theme;Θέμα';
$__LOCALE['RCAPPS_DPC'][3]='_expires;Expire;Λήξη χρήσης';
$__LOCALE['RCAPPS_DPC'][4]='_user;User;Χρήστης';
$__LOCALE['RCAPPS_DPC'][5]='_pass;Pass;Κωδικός';
$__LOCALE['RCAPPS_DPC'][6]='_app;Application;Εφαρμογή';
$__LOCALE['RCAPPS_DPC'][7]='_newapp;New App;Νέα εφαρμογή';


class rcapps {

    var $title, $prpath, $urlpath;
	var $seclevid, $userDemoIds;
	var $dir_prefix, $db_prefix, $rootdomain, $mailto;	
	var $isrootapp, $cpanel_user, $cpanel_pass, $upgrade_root_app, $install_root_path, $themes_path;
	var $posted_mail, $posted_appname, $posted_theme, $app_location;
		
	public function __construct() {
	
		$this->prpath = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		$this->title = localize('RCAPPS_DPC',getlocal());		
	  
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
		$this->userDemoIds = array(5,6,7,8); 	  
		
		$this->cpanel_user = remote_paramload('RCCONTROLPANEL', 'cpaneluser', $this->prpath);
		$this->cpanel_pass = remote_paramload('RCCONTROLPANEL', 'cpanelpass', $this->prpath);			

		$this->isrootapp = remote_paramload('RCCONTROLPANEL', 'isrootapp', $this->prpath) ? true : false;	
		
		$this->dir_prefix = remote_paramload('RCCONTROLPANEL', 'rootpath', $this->prpath) . '_';
		$this->db_prefix = $this->dir_prefix; 	
				
		$this->rootdomain = remote_paramload('RCCONTROLPANEL','rootdomain',$this->prpath);
		$this->mailto = remote_paramload('INDEX','e-mail',$this->prpath);

		$inspath = $this->isrootapp ? 'init-app/' : '../../cp/init-app/';		
		$this->install_root_path = $this->prpath . $inspath;		

		$thmpath = $this->isrootapp ? 'init-app-themes/' : '../../init-app-themes/';		
		$this->themes_path = $this->prpath . $thmpath;			
		
		$upgpath = $this->isrootapp ? 'upgrade-app/' : '../../cp/upgrade-app/';
		$this->upgrade_root_path = $this->prpath . $upgpath;	
		
		//form submited data 
		$this->posted_mail = GetParam('email');
		$this->posted_theme = GetParam('theme');
		$this->posted_appname = GetParam('appname');
		//$this->posted_password = GetParam('upass');
		//$this->posted_password_retyped = GetParam('upassretype');

		//app dir location
		if (GetParam('prefix'))
			$this->app_location = $this->urlpath . '/' . $this->dir_prefix . $this->posted_appname;		
		else
			$this->app_location = $this->urlpath . '/' . $this->posted_appname;
	}
	
    public function event($event=null) {
	
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;		 
	
		switch ($event) {
			case 'cpmnew'			: echo $this->installapp_ajax(); die();
									  break;			
			case 'cpappnew'			: $this->javascript_install(); 
			                          break;			
			
			case 'cpmupgrade'	    : echo $this->upgradeapp_ajax(); die();	
			                          break;
			case 'cpdoupgrade'	    : $this->javascript_upgrade(); 
			                          break;  
			
			case 'cpappupgrade'		: echo $this->upgradeapp('trans'); die();
									  break;		   
		   
			case 'cpappsviewhtml' 	: echo $this->viewAppHtml('trans'); die();
									  break;	   
			case 'cpappsview'		: break;		   
			case 'cpappslink'		: //echo $this->show_app_data();  die();
									  break;	   
			case 'cpappsframe'		: echo $this->loadframe('trans'); die();
									  break;								 
			case 'cpappssshow'		: break; 	   
			case 'cpapps'     		:
			default           		:  
	   }
			
    }   
	
    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	
	 
		switch ($action) {	
			case 'cpmnew'	 	    : break;
		    case 'cpappnew' 	    : $out = $this->installScan(); break;		
		    case 'cpmupgrade'	    : break;
			case 'cpdoupgrade'	    : $out = $this->upgradeScan(); break;
			case 'cpappupgrade'		: break;	  
			case 'cpappsviewhtml' 	: break;		  
			case 'cpappsview'		: break;
			case 'cpappslink'		: $out = $this->show_app_data();			
			case 'cpappssshow'		: break; 
			case 'cpapps'    		:

			default            	: $out = $this->show_apps();
		}	 

		return ($out);
    }
	
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}			

	protected function javascript_upgrade() {	

        if (iniload('JAVASCRIPT')) {   
	        $code = $this->javascript_upgrade_code();	   	
		    $js = new jscript;
            $js->load_js($code,null,1);   			   
		    unset ($js);
	    }	
	}		
	
	protected function javascript_upgrade_code()  {
		
	    $ajaxurl = seturl("t=");	
		$m = 100 / count($this->updatePath());
		$c = count($this->updatePath());
	
		$js = <<<EOF

function start(app,m,c)
{	
    var mm = m ? m : parseInt('$m'); 
    var cc = c ? c : 100;
	$('#message_p').html('<img src="images/loading.gif" alt="Processing">');

	$.ajax({
	  url: '{$ajaxurl}cpmupgrade&id='+app,
	  type: 'GET',
	  success:function(data) {		
	    if (data) {	
			$('#message_p').html(data);
			$('.label').html(cc+'%');
			$('.bar').css({"width": cc+"%"});
			setTimeout(function() { start(app, mm, cc-mm);},1000);
		}
		else {
			$('.label').html('0%');
			$('.bar').css({"width": "0%"});			
			$('#message_p').html('');
		}		
	  }
	}); 
}		
EOF;
		return ($js);	
    }	

	protected function createButton($name=null, $urls=null, $t=null, $s=null) {
		$type = $t ? $t : 'primary'; //danger /warning / info /success
		switch ($s) {
			case 'large' : $size = 'btn-large '; break;
			case 'small' : $size = 'btn-small '; break;
			case 'mini'  : $size = 'btn-mini '; break;
			default      : $size = null;
		}
		
		if (!empty($urls)) {
			foreach ($urls as $n=>$url)
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
		
	protected function appbutton() {
		$mode = GetReq('mode') ? GetReq('mode') : 'catalog';
        
		$turl0 = seturl('t=cpappnew');		

		$ret = $this->createButton(localize('_app', getlocal()), array(localize('_newapp', getlocal())=>$turl0), 'success');	
		return ('<div class="btn-toolbar">'  . $ret . '</div><hr/>');
	}											
	
	protected function show_grid($x=null,$y=null,$filter=null,$bfilter=null) {
	
	    if (defined('MYGRID_DPC')) {
		
			$xsSQL2 = "SELECT * FROM (SELECT id,active,name,theme,cdate,expires,user,pass FROM apps) x";

			//$out.= $xsSQL2;
			_m("mygrid.column use grid2+id|".localize('id',getlocal())."|5|0|");
			_m("mygrid.column use grid2+active|".localize('_active',getlocal())."|boolean|1|1:0");				
			_m("mygrid.column use grid2+name|".localize('name',getlocal())."|20|0|");
			_m("mygrid.column use grid2+theme|".localize('_theme',getlocal())."|link|20|"."javascript:show_html(\"{name}\");".'||');	
			_m("mygrid.column use grid2+cdate|".localize('_date',getlocal())."|date|0|");
		    _m("mygrid.column use grid2+expires|".localize('_expire',getlocal())."|9|0|");	
			_m("mygrid.column use grid2+user|".localize('_user',getlocal())."|link|20|"."javascript:show_body({id});".'||');	
			_m("mygrid.column use grid2+pass|".localize('_pass',getlocal())."|link|20|"."javascript:upgrade(\"{name}\");".'||');	
			$ret .= _m("mygrid.grid use grid2+apps+$xsSQL2+e+".localize('RCAPPS_DPC',getlocal())."+id+1+1+14+340+$x+0+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
	}
	
	protected function show_apps() {
	
	    if (!$this->isDemoUser())
			$ret = $this->appbutton();
		
       	$ret .= "<div id='trans'></div>";	
	    $ret .= $this->show_grid();	

	    return ($ret);	
	}	
	
	protected function show_app_data() {
		$db = GetGlobal('db'); 	
		$id = GetReq('id');
		
		$sSQL = "select log from apps where id=".$id;
	    $result = $db->Execute($sSQL,2);
	  
	    if ($data = $result->fields['log']) {
			$out = $data;
	    }
		else 
		    $out = 'no log';
			
	    return ($out);
	}	
	
	protected function viewAppHtml($ajaxdiv=null) {
	    $app = GetReq('appname');
        $bodyurl = str_replace($this->dir_prefix,'',$app).'.'.$this->rootdomain;
		
		$frame = "<iframe src =\"http://$bodyurl\" width=\"100%\" height=\"550px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv.'|'.$frame;
		else
			return ($frame);		
	} 	
	
	
	protected function loadframe($ajaxdiv=null) {
	    $bodyurl = seturl("t=cpappslink&id=".GetReq('id'));
	
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv.'|'.$frame;
		else
			return ($frame);
	}	
	
	protected function upgradeapp($ajaxdiv=null) {
	    $bodyurl = seturl("t=cpdoupgrade&id=".GetReq('appname'));
	
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv.'|'.$frame;
		else
			return ($frame);
	}
	
	protected function upgradeapp_ajax() {
		$app = GetReq('id');		
		$index = intval(@file_get_contents($this->prpath . $app. '.app'));
		
		foreach ($this->updatePath() as $idx=>$path) {
			if ($idx == $index)
				return $this->upgrade_scan($path, null, true, $index+1);
		}
		@unlink($this->prpath . $app . '.app'); //reset	
		return false;
	}

	protected function upgradeScan() {
		$app = GetReq('id');
		
		foreach ($this->updatePath() as $path) {
			$report .= $this->upgrade_scan($path, null, true);
			$report .= '<hr/>';
		}	
		
		$report .= "<button onClick='start(\"$app\")' class='btn btn-danger'>Start</button><br/>" ;
		
		return ($report);
	}	
	
	protected function updatePath() {
		$app = GetReq('id');
		$tpath = remote_paramload('FRONTHTMLPAGE', 'path', $this->prpath);
		
		$path = $this->upgrade_root_path;	
		if (is_dir($path . $app . '-ext')) { //if app dir exclusive (=appname + '-ext') see dir for updates
			$datalines = array(0=>$path . $app.'-ext',	1=>$this->urlpath . "/$app/cp/replication",);
		}
		else //common dir
		 $datalines = array(0=>$path . 'homefiles',
		                    1=>$path . 'cgi-bin',
							2=>$path . 'newsletters',
							3=>$path . 'js',
							4=>$path . 'javascripts',
							5=>$path . 'cp/images',
							6=>$path . 'cp/assets',
							7=>$path . 'cp/font',
							8=>$path . 'cp/dpc',
							9=>$path . 'cp/css',
							10=>$path . 'cp/img',
							11=>$path . 'cp/js',
							12=>$path . 'cp/sql',
							13=>$path . 'cp/lang',
							14=>$path . 'cp/cpfiles',
							15=>$path . "cp/$tpath",
							16=>$path . $app,							
							17=>$this->urlpath . "/$app/cp/replication",
							);
							
		return ($datalines);			
	}	
	
	protected function upgrade_scan($path=null, $skipdir=null, $reportout=false, $ajaxid=false) {
		$app = GetReq('id');
		$repout = $reportout ? true : false;
		$scan_path_length = strlen($path);		
		$ext_array = array();
		$ext_array = array_map('strtolower',$ext_array);
		$excl_array = array();//'ftpquota','txt','swf','fla','ini'); //<< ini
		$excl_array = array_map('strtolower',$excl_array);
		$extensionless = false;
		$skip = is_array($skipdir) ? $skipdir : array();	
		$current = array();
		$added = array();
		$count_baseline = 0;
		$start = microtime(true);		
		
		$_p = explode('/',$path);
        $saypath = array_pop($_p);
		
		$report = "Scan File Check for $acct ($saypath)\r\n";			
		
		if (!is_dir($path)) 
			return (nl2br("Invalid path ($saypath)\r\n"));		

		$dpath = GetReq('upgpath') ? base64_decode(GetReq('upgpath')) :  false;	
		$exec = (($dpath==$path) || ($ajaxid)) ? true : false;		
		
		//save step file for ajax or reset
		$aj = ($ajaxid>0) ? @file_put_contents($this->prpath . $app . '.app', strval($ajaxid), LOCK_EX) : 
							@unlink($this->prpath . $app . '.app');
	
	    ini_set('max_execution_time', 600);
	    ini_set('memory_limit','1024M');	
		
		$dir = new RecursiveDirectoryIterator($path);
		$iter = new RecursiveIteratorIterator($dir);
		while ($iter->valid())
		{
			// 	Not in Dot AND not in $skip (prohibited) directories
			if (!$iter->isDot() && !(in_array($iter->getSubPath(), $skip)))
			{
				//	Get or set file extension ('' vs null)
				if (is_null(pathinfo($iter->key(), PATHINFO_EXTENSION)))
					$ext = '';
				else 
					$ext = strtolower(pathinfo($iter->key(), PATHINFO_EXTENSION));

				if (
					(in_array($ext, $ext_array, true)) ||	
					// in allowed extension array
					(empty($ext_array) && !in_array($ext, $excl_array, true)) ||	
					// OR NOT in excluded extension array
					(empty($ext) && $extensionless) )	
					// OR extensionless AND extensionless is allowed
				{
					$file_path = $iter->key();
					//	Ensure $file_path without \'s
					$file_path = str_replace(chr(92),chr(47),$file_path);
			
					//	Handle addition to $current array
					$current[$file_path] = array('file_hash' => hash_file("sha1", $file_path), 'file_last_mod' => date("Y-m-d H:i:s", filemtime($file_path)));

					//	IF file_path is newer file was ADDED
					$updateFile = str_replace($this->upgrade_root_path, $this->urlpath . '/'. $app. '/', $file_path);
					$_updFile = $this->replace_pseudo_dir($updateFile);
					if ((is_readable($_updFile)) && (filemtime($_updFile) < filemtime($file_path))) {	
					    //update
						$added[$file_path] = array('file_hash' => $current[$file_path]['file_hash'], 'file_last_mod' => $current[$file_path]['file_last_mod'], 'update' => $_updFile);
					}
					elseif (!is_readable($_updFile)) {
						if (strstr($_updFile, '.conf')) {
							$conf = $this->urlpath . '/'. $app. '/cp/myconfig.txt';
							if (filemtime($conf) < filemtime($file_path))
								$added[$file_path] = array('file_hash' => $current[$file_path]['file_hash'], 'file_last_mod' => $current[$file_path]['file_last_mod'], 'update' => $_updFile);					
						}
						elseif (strstr($_updFile, '.sql')) {
							$dbupd = $this->urlpath . '/'. $app. '/cp/sqlupgrade.txt';
							if (filemtime($dbupd) < filemtime($file_path))
								$added[$file_path] = array('file_hash' => $current[$file_path]['file_hash'], 'file_last_mod' => $current[$file_path]['file_last_mod'], 'update' => $_updFile);							
						}
						else //new	
							$added[$file_path] = array('file_hash' => $current[$file_path]['file_hash'], 'file_last_mod' => $current[$file_path]['file_last_mod'], 'update' => $_updFile);					
					}
					else {} //do nothing
				}	
			}	// End of handling $current record entry
			$iter->next();
		}//while
		
		//	PREPARE Report 
		$elapsed = round(microtime(true) - $start, 5);
	
		//	Add count summary to report
		$count_current = count($current);
		$report .= "$count_current files collected in scan.\r\n";
		if (0 == $count_current) {
			$report .= "\r\nThere are NO files in the specified location.\r\n";
		}
        else { 
			$count_added = count($added);
			$report .= "$count_added files ADDED to baseline.\r\n";
			foreach($added as $filename => $value) { 	
				if ($exec) 
					$report .= $this->_update($filename, $value['update'], true);	
			}	
        }

		if ($count_added) {
			$url = seturl("t=cpdoupgrade&id=$app&upgpath=".base64_encode($path));
			$button = "<a href=\"$url\" class=\"btn btn-danger\">Upgrade</a>";
			$cmd = $exec ? null : $button; //seturl("t=cpdoupgrade&id=$app&upgpath=".base64_encode($path), '[Upgrade]');
			
			$report .= "\r\nSummary:
Current Baseline: $count_current
Added: $count_added $cmd
Scan executed in $elapsed seconds.\r\n";
		}

		//	Destroy tables (release to memory)
		$baseline = $current = $added = array();

		//log
		if ($ajaxid>0)
			$log = @file_put_contents($this->prpath . $app . '.log', $report, LOCK_EX | FILE_APPEND);		
		
		if ($repout) 
			return(nl2br($report));
		
		return (true);	
	}

	protected function _update($source, $dest, $mkdir=false) {
		
		if (strstr($source,'replication')) {//prpath replication dir
		    if (strstr($source,'.sql')) //must be admindb
				$ret = $this->_execsql($source);
			/*elseif (strstr($source,'.conf')) //update ini
				$ret = $this->_execini($source);*/					
			else
				$ret = $this->_copy($source, $dest, $mkdir);
			
			@unlink($source);	
		}			
		elseif (strstr($source,'.sql')) //common update, must be admindb
			$ret = $this->_execsql($source);
		elseif (strstr($source,'.conf')) //update ini
			$ret = $this->_execini($source);				
		else //common update copy 
			$ret = $this->_copy($source, $dest, $mkdir);
		
		return ($ret);
	}
	
	protected function _copy($source, $dest, $mkdir=false) {
		if ($mkdir) @mkdir(dirname($dest), 0777, true);
		//echo $source,'-',$dest,'<br/>';
		$ret = copy($source, $dest);		
		return ($ret ? '*' : false);
	}
	
	protected function _execsql($sqlfile) {
		$db = GetGlobal('db');
		$app = GetReq('id');
		$log = $this->urlpath . '/'. $app . '/cp/sqlupgrade.txt';
		
		$appdb = _m('database.switch_db use '.$app.'+1+1+1');
		$sql = @file_get_contents($sqlfile);		
		
		if (($appdb) && ($sql)) {
			//echo $app . ': switched succesfuly!';
			@file_put_contents($log, $app . ': switched succesfuly!', LOCK_EX);
			
			//$appdb->Execute($sql);
			//return $sql;
						
			$sql_parts = explode(';',$sql);
			//$sql_parts[] = "INSERT INTO users set code2='3',email='b.alexiou@stereobit.gr',fname='balexiou',active=1,notes='ACTIVE',seclevid=9,username='b.alexiou@stereobit.gr', password='".md5('vk7dp')."',vpass='".md5('vk7dp')."'"; //test
			$queries = 0; 
			foreach ($sql_parts as $i=>$sSQL) {
				$ret = $appdb->Execute($sSQL,1);			  
				$queries+=1;
			}		
						
			$ret = file_put_contents($log, $sql . "\r\n " . $queries . " queries executed.", FILE_APPEND | LOCK_EX);
			
			return $queries . ' queries executed.';
		}
		@file_put_contents($log, $app . ': sql failed.', LOCK_EX);
		return false;
	}

	protected function _execini($inifile) {
		$app = GetReq('id');
		$inif = $this->urlpath . '/'. $app. '/cp/myconfig.txt';
		@copy($inif, str_replace('.txt', '._xt', $inif)); //backup
		
		$inidata = @file_get_contents($inifile);
		$fp = new fronthtmlpage(null);
		$pini = $fp->process_commands($inidata);
		unset ($fp);
		
		$inif_local = $this->urlpath . '/'. $app. '/cp/ini.local';		
		@file_put_contents($inif_local, $this->remote_vars($pini, $inif)); //copy local
				
		$ini_array = parse_ini_file($inif_local, true, INI_SCANNER_RAW);

		if (!empty($ini_array)) {
			
		    $i = 0;
			$conf_array = parse_ini_file($inif, true, INI_SCANNER_RAW);
			$r = array_merge($conf_array, $ini_array);
			//print_r($r);
			$f = null;
		    foreach ($r as $s=>$section) {
				$f .= "[$s]\n";
				foreach ($section as $var=>$val) {
					$f .= $var.'='.$val."\n";
				}
				$f .= "\n";
			}
			$ret = file_put_contents($inif, $f);
			return $ret ? true : false;
		}
		
		return false;
	}		
	
	//pseudo-dir replacement
	protected function replace_pseudo_dir($d) {
			
		if (strstr($d,'/homefiles'))
			return str_replace('/homefiles', '', $d);
		elseif (strstr($d,'/cpfiles'))
			return str_replace('/cpfiles', '', $d);
			
		return $d;
	}

	//replace local variables with apps vars at ini handler
	protected function remote_vars($ini, $appconf) {
		$inif = $this->prpath . 'myconfig.txt';
		$ini_array = parse_ini_file($inif, true, INI_SCANNER_RAW);
		$conf_array = parse_ini_file($appconf, true, INI_SCANNER_RAW);
		$ret = $ini;
		foreach($ini_array['INDEX'] as $var=>$val) {
			//echo $var,'-',$val,'>',$conf_array['INDEX'][$var];
			$ret = str_replace($val, $conf_array['INDEX'][$var], $ret);
		}	
			
		return ($ret);	
	}


	
	
	//add cp htaccess security...
    protected function add_cp_htaccess() {
  
		$htpass_path = $this->prpath;// . '/'; 
		$htaccess_path = $this->app_location . '/cp/'; 
		$this->log .=   '<br>HTACCESS PATH:'. $htpass_path.'>'.	$htaccess_path;	
		
		if (is_dir($htaccess_path)) {
		
			$htpass_file = $htpass_path . 'htpasswd-'.$this->posted_appname;//per app
			$htaccess_file = $htaccess_path . '.htaccess';
		    $this->log .=  '<br>HTACCESS FILE:'. $htpass_file.'>'.	$htaccess_file;	
	    }
		else
		    return false;
			
		// Initializing class htaccess as $ht
		$ht = new htaccess($htaccess_file, $htpass_file);//"/var/www/.htaccess","/var/www/htpasswd");
		// Adding user
		//$ht->addUser($this->posted_appname, $this->posted_password); //<< NOT THE APP NAME AS USERNAME..
		$ht->addUser($this->posted_mail, $this->posted_password); 
		//2nd user
		$ht->addUser('admin', '#####');
		
		// Changing password for User
		//$ht->setPasswd("username","newPassword");
		// Getting all usernames from set password file
		$users = $ht->getUsers();
		for($i=0;$i<count($users);$i++){
			$this->log .= $users[$i];
		}
		// Deleting user
		//$ht->delUser("username");
		// Setting authenification type
		// If you don't set, the default type will be "Basic"
		$ht->setAuthType("Basic");
		// Setting authenification area name
		// If you don't set, the default name will be "Internal Area"
		$ht->setAuthName("Control Panel");
		//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		// finally you have to process addLogin()
		// to write out the .htaccess file
		$ht->addLogin();
		// To delete a Login use the delLogin function
		//$ht->delLogin();	
		
		return true;
	}	
	
	
	
	
	protected function javascript_install() {	

        if (iniload('JAVASCRIPT')) {   
	        $code = $this->javascript_install_code();	   	
		    $js = new jscript;
            $js->load_js($code,null,1);   			   
		    unset ($js);
	    }	
	}	
	
	protected function javascript_install_code()  {
		
	    $ajaxurl = seturl("t=");	
		$m = 100 / count($this->installPath());
		$c = count($this->installPath());
	
		$js = <<<EOF

function start(app, m,c, email, theme)
{	
	var theme = theme ? theme : $('#theme').val();
	var email = email ? email : $('#email').val();
    var appp = app ? app : $('#appname').val();
	var mm = m ? m : parseInt('$m'); 
    var cc = c ? c : 100;
	$('#message_p').html('<img src="images/loading.gif" alt="Processing">');

	$.ajax({
	  url: '{$ajaxurl}cpmnew&appname='+app+'&email='+email+'&theme='+theme,
	  type: 'GET',
	  success:function(data) {		
	    if (data) {	
			$('#message_p').html(data);
			$('.label').html(cc+'%');
			$('.bar').css({"width": cc+"%"});
			setTimeout(function() { start(appp, mm, cc-mm, email);},1000);
		}
		else {
			$('.label').html('0%');
			$('.bar').css({"width": "0%"});			
			$('#message_p').html('');
		}		
	  }
	}); 
}		
EOF;
		return ($js);	
    }	
	
	protected function installapp_ajax() {		
		$app = GetReq('appname');	
		if (!$email) return 'Invalid app name';		
		$email = GetReq('email');
		if (!$email) return 'Invalid email';
		
		if (!is_dir($this->urlpath .'/'. $this->dir_prefix . $app)) { 
			if (!$dir = @mkdir($this->urlpath .'/'. $this->dir_prefix . $app, 0777, true)) //create app path
				return 'App mkdir failed';
		}	
		//else
			//return 'App exists'; //repeated ajax procedure
		
		$index = intval(@file_get_contents($this->urlpath .'/'. $this->dir_prefix . $app . '/' . $app . '.app'));
		
		foreach ($this->installPath() as $idx=>$path) {
			if ($idx == $index)
				return $this->install_scan($path, null, true, $index+1);
		}
		@unlink($this->urlpath .'/'. $this->dir_prefix . $app . '/' . $app . '.app'); //reset	
		return false;
	}

	protected function installScan() {

		foreach ($this->installPath() as $path) {
			$report .= $this->install_scan($path, null, true);
			$report .= '<hr/>';
		}	
		
		//$report .= "<button onClick='start()' class='btn btn-danger'>Start</button><br/>" ;
		
		return ($report);
	}	
	
	protected function installPath() {
		$tpath = remote_paramload('FRONTHTMLPAGE', 'path', $this->prpath);
		
		$path = $this->install_root_path;	
		$datalines = array(0=>$path . 'homefiles',
		                    1=>$path . 'cgi-bin',
							2=>$path . 'newsletters',
							3=>$path . 'js',
							4=>$path . 'javascripts',
							5=>$path . 'cp/images',
							6=>$path . 'cp/assets',
							7=>$path . 'cp/font',
							8=>$path . 'cp/dpc',
							9=>$path . 'cp/css',
							10=>$path . 'cp/img',
							11=>$path . 'cp/js',
							12=>$path . 'cp/sql',
							13=>$path . 'cp/lang',
							14=>$path . 'cp/cpfiles',
							);
							
		return ($datalines);			
	}

	protected function install_scan($path=null, $skipdir=null, $reportout=false, $ajaxid=false) {
		$app = GetReq('appname');
		$repout = $reportout ? true : false;		
		$scan_path_length = strlen($path);		
		$ext_array = array();
		$ext_array = array_map('strtolower',$ext_array);
		$excl_array = array();//'ftpquota','txt','swf','fla','ini'); //<< ini
		$excl_array = array_map('strtolower',$excl_array);
		$extensionless = false;
		$skip = is_array($skipdir) ? $skipdir : array();		
		$current = array();
		$added = array();
		$count_baseline = 0;
		$start = microtime(true);	
		
		$_p = explode('/',$path);
        $saypath = array_pop($_p);
		
		$report = "Scan File Check for $acct ($saypath)\r\n";		
		
		if (!is_dir($path)) 
			return (nl2br("Invalid path ($saypath)\r\n"));				

		/*$thePath = str_replace($this->install_root_path, $this->urlpath . '/'. $this->dir_prefix . $app. '/', $path);
		if (is_dir($thePath)) //check if exist
			return (nl2br("Destination exists ($thePath)\r\n"));		
		elseif (!$dir = @mkdir($thePath, 0777, true)) //create destination path
			return (nl2br("Path failed ($thePath)\r\n"));
		*/
		$exec = $ajaxid ? true : false;		
		
		//save step file for ajax or reset
		$aj = ($ajaxid>0) ? @file_put_contents($this->prpath . $app . '.app', strval($ajaxid), LOCK_EX) : 
							@unlink($this->prpath . $app . '.app');
							
	    ini_set('max_execution_time', 600);
	    ini_set('memory_limit','1024M');							

		$dir = new RecursiveDirectoryIterator($path);
		$iter = new RecursiveIteratorIterator($dir);
		while ($iter->valid())
		{
			// 	Not in Dot AND not in $skip (prohibited) directories
			if (!$iter->isDot() && !(in_array($iter->getSubPath(), $skip)))
			{
				//	Get or set file extension ('' vs null)
				if (is_null(pathinfo($iter->key(), PATHINFO_EXTENSION)))
					$ext = '';
				else 
					$ext = strtolower(pathinfo($iter->key(), PATHINFO_EXTENSION));

				if (
					(in_array($ext, $ext_array, true)) ||	
					// in allowed extension array
					(empty($ext_array) && !in_array($ext, $excl_array, true)) ||	
					// OR NOT in excluded extension array
					(empty($ext) && $extensionless) )	
					// OR extensionless AND extensionless is allowed
				{
					$file_path = $iter->key();
					//	Ensure $file_path without \'s
					$file_path = str_replace(chr(92),chr(47),$file_path);
			
					//	Handle addition to $current array
					$current[$file_path] = array('file_hash' => hash_file("sha1", $file_path), 'file_last_mod' => date("Y-m-d H:i:s", filemtime($file_path)));

					//	IF file_path is newer file was ADDED
					$copyFile = str_replace($this->install_root_path, $this->urlpath . '/'.  $this->dir_prefix . $app. '/', $file_path);
					$_cpyFile = $this->replace_pseudo_dir($copyFile);
					//if (!is_readable($_cpyFile)) {
						if (strstr($_cpyFile, '.conf')) {
							$conf = $this->urlpath . '/'. $this->dir_prefix . $app. '/cp/myconfig.txt';
							$added[$file_path] = array('file_hash' => $current[$file_path]['file_hash'], 'file_last_mod' => $current[$file_path]['file_last_mod'], 'file' => $_cpyFile);					
						}
						elseif (strstr($_cpyFile, '.sql')) {
							$dbupd = $this->urlpath . '/'. $this->dir_prefix . $app. '/cp/sqlupgrade.txt';
							$added[$file_path] = array('file_hash' => $current[$file_path]['file_hash'], 'file_last_mod' => $current[$file_path]['file_last_mod'], 'file' => $_cpyFile);							
						}
						else //new	
							$added[$file_path] = array('file_hash' => $current[$file_path]['file_hash'], 'file_last_mod' => $current[$file_path]['file_last_mod'], 'file' => $_cpyFile);					
					//}
					//else {} //do nothing
				}	
			}	// End of handling $current record entry
			$iter->next();
		}//while
		
		//	PREPARE Report 
		$elapsed = round(microtime(true) - $start, 5);
	
		//	Add count summary to report
		$count_current = count($current);
		$report .= "$count_current files collected in scan.\r\n";
		if (0 == $count_current) {
			$report .= "\r\nThere are NO files in the specified location.\r\n";
		}
        else { 
			$count_added = count($added);
			$report .= "$count_added files ADDED to baseline.\r\n";
			foreach($added as $filename => $value) { 	
				if ($exec) 
					$report .= $this->_create($filename, $value['file'], true);
			}	
        }

		if ($count_added) {			
			$report .= "\r\nSummary:
Current Baseline: $count_current
Added: $count_added
Scan executed in $elapsed seconds.\r\n";
		}

		//	Destroy tables (release to memory)
		$baseline = $current = $added = array();

		//log
		if ($ajaxid>0)
			$log = file_put_contents($this->urlpath . '/' . $this->dir_prefix . $app . '/' . $app . '.log', $report, LOCK_EX | FILE_APPEND);		
		
		if ($repout) 
			return(nl2br($report));
		
		return (true);	
	}	
	
	protected function _create($source, $dest, $mkdir=false) {
		
		if (strstr($source,'.sql')) //common copy, must be admindb
			$ret = $this->_execsql($source);
		elseif (strstr($source,'.conf')) //create ini
			$ret = $this->_execini($source);				
		else //common copy 
			$ret = $this->_copy($source, $dest, $mkdir);
		
		return ($ret);
	}	
	
};
}
?>