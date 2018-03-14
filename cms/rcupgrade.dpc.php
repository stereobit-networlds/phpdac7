<?php
$__DPCSEC['RCUPGRADE_DPC']='1;1;1;1;1;1;2;2;9;9;9';

if ( (!defined("RCUPGRADE_DPC")) && (seclevel('RCUPGRADE_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCUPGRADE_DPC",true);

$__DPC['RCUPGRADE_DPC'] = 'rcupgrade';

$__EVENTS['RCUPGRADE_DPC'][0]='cpupgrade';
$__EVENTS['RCUPGRADE_DPC'][1]='cpmupgrade';
$__EVENTS['RCUPGRADE_DPC'][2]='cpmcheckcrc';

$__ACTIONS['RCUPGRADE_DPC'][0]='cpupgrade';
$__ACTIONS['RCUPGRADE_DPC'][1]='cpmupgrade';
$__ACTIONS['RCUPGRADE_DPC'][2]='cpmcheckcrc';

$__LOCALE['RCUPGRADE_DPC'][0] = 'RCUPGRADE_DPC;Upgrade;Αναβάθμιση;';
$__LOCALE['RCUPGRADE_DPC'][1] = '_noresponse;Server not respond;Αποτυχία λήψης;';

class rcupgrade {
	
	var $urlpath, $url, $prpath, $isrootapp;	
    var $upgrade_root_path, $update_root_path;
	var $upgdirs, $isremote, $remoteurl, $app;	
	
	public function __construct() {
		
		$this->prpath = paramload('SHELL','prpath'); 
		$this->urlpath = paramload('SHELL','urlpath'); 
		$this->url = paramload('SHELL','urlbase'); 	
		
		$this->isrootapp = remote_paramload('RCCONTROLPANEL', 'isrootapp', $this->prpath) ? true : false;
		$this->templatePath = remote_paramload('FRONTHTMLPAGE', 'path', $this->prpath);		
		
		$upgpath = $this->isrootapp ? 'upgrade-app/' : '../../cp/upgrade-app/';
		$this->upgrade_root_path = $this->prpath . $upgpath;	
		
		$updpath = $this->isrootapp ? 'update-app/' : '../../cp/update-app/';
		$this->update_root_path = $this->prpath . $updpath;
		
		$u = explode('/', $this->urlpath);
		$this->app = array_pop($u);
		
		$this->upgdirs = null;
		$this->isremote = true; //strstr($this->prpath, 'public_html/'.$this->app) ? false : true;//false;	
		$this->remoteurl = "http://www.xix.gr/upgrade/cpupgrader.php";
	}

	public function event($event=null) {
	
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;
	
	    switch ($event) {
			
			case 'cpmcheckcrc': //if ($this->isremote)
								echo $this->checkCRC();	die();	
								break;			
			
			case 'cpmupgrade': 	if ($this->isremote)
									echo $this->remote_upgradeapp_ajax();
								else	
									echo $this->upgradeapp_ajax(); 
								die();	
								break;			
		
			case 'cpupgrade' : 
			default          : 	$this->javascript();
		                     
        }			
    }
	
	public function action($action=null) {		
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;
	
	    switch ($action) {	
			case 'cpmcheckcrc'	:   break;
			case 'cpmupgrade'	:   break;		
							 	
			case 'cpupgrade' 	:
			default          	: 	if ($this->isremote)
									$out = $this->remote_runscan();
										else
									$out = $this->runscan();
								
        }
		
        return ($out);

    }
	
	protected function javascript() {	

        if (iniload('JAVASCRIPT')) {   
	        $code = $this->javascript_code();	   	
		    $js = new jscript;
            $js->load_js($code,null,1);   			   
		    unset ($js);
	    }	
	}		
	
	//call from page
	public function javascript_code()  {
		
		$ajaxurl = seturl("t=");
		
		if ($this->isremote) {
			
			$arr = $this->serverRequest();
			if (!$arr)	
				return "$('#message_p').html('" . localize('_noresponse', getlocal()) . "')";	
			
			$c = count($arr);			
			$m = 100 / $c;
			
			//create js list
			foreach ($arr as $n1=>$r1) {
				foreach ($r1 as $n2=>$r2)
					if (strstr($r2, '/')) $jr[] = $r2;
					
			}
			//add empty string at start as 0 element
			$jarr = '["","' . implode('","', $jr) . '"]';;		
	
			$js = <<<EOFR

function remotestart(app,m,c,i)
{	
	var nf = $jarr;	
    var ii = (i>=0) ? i : parseInt('$c');
    var mm = m ? m : parseInt('$m'); 
    var cc = c ? c : 100;	
	$('#message_p').html('<img src="images/loading.gif" alt="Processing">');
	$('.label').html(cc+'%');
	$('.bar').css({"width": cc+"%"});
	
	$.ajax({
	  url: '{$ajaxurl}cpmupgrade&id='+app+'&m='+ii+'&f='+nf[ii],
	  type: 'GET',
	  success:function(data) {		
	    if (data) {	
			$('#message_p').html(data);
			$('.label').html(cc+'%');
			$('.bar').css({"width": cc+"%"});
			setTimeout(function() { remotestart(app, mm, cc-mm, ii-1);},1000);
		}
		else {
			$('.label').html('0%');
			$('.bar').css({"width": "0%"});			
			$('#message_p').html('');
			$.ajax({
				url: '{$ajaxurl}cpmcheckcrc&id='+app,
				type: 'GET',
				success:function(data) {
					$('#message_p').html(data);
				}});		
		}		
	  }
	}); 
}		
EOFR;
		}		
		else {
				
			$c = count($this->updatePath());			
			$m = 100 / $c;
	
			$js = <<<EOF

function start(app,m,c)
{	
    var mm = m ? m : parseInt('$m'); 
    var cc = c ? c : 100;	
	$('#message_p').html('<img src="images/loading.gif" alt="Processing">');
	$('.label').html(cc+'%');
	$('.bar').css({"width": cc+"%"});
	
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
		}
		return ($js);	
    }		
			
	
	/*scan root app files */
	protected function runscan() {
		
		$upaths = $this->updatePath();
		if (empty($upaths)) return false;		
		
		foreach ($upaths as $path) {
			$report .= $this->scan($path, null, true);
			$report .= '<hr/>';
		}
		$report .= "<button onClick='start(\"{$this->app}\")' class='btn btn-danger'>Start</button><br/>" ;		
		
		return ($report);
	}
	
	protected function remote_runscan() {
		
		$response = $this->serverRequest();
		if (!$response)	
			return (localize('_noresponse', getlocal()));
		
		//print_r($response);
		foreach ($response as $r=>$el) {
			foreach ($el as $e) 
				$ret .= $e;	
			$ret .= '<br/>';	
		}
		if ($ret)	
			$ret .= "<button onClick='remotestart(\"{$this->app}\")' class='btn btn-danger'>Start</button><br/>" ;		
		
		return $ret;
	}	

	protected function upgradeapp_ajax() {
		$upaths = $this->updatePath();
		if (empty($upaths)) return false;
		
		$index = intval(@file_get_contents($this->prpath . $this->app. '.app'));
		
		foreach ($upaths as $idx=>$path) {
			if ($idx == $index)
				return $this->scan($path, null, true, $index+1);
		}
		@unlink($this->prpath . $this->app . '.app'); //reset	
		return false;
	}

	protected function remote_upgradeapp_ajax() {
		$app = GetReq('id');
		$fid = GetReq('m');
		$file = GetReq('f');

		if (($fid>0) && ($file)) {

			$response = $this->serverRequest($file);
			if (!$response)	
				return (localize('_noresponse', getlocal()));			
			
			foreach ($response as $r) {
				//$ret .= $r;
				//one elm array with base64 encoded data
				$contents.= $r; 
			}	
			$ret = @file_put_contents($this->savetmpfile($file) , base64_decode($contents), LOCK_EX);
			
			//return 'file ' . $fid . '->' . $file . '->' . $ret;	
			
			$kbytes = _m("rccontrolpanel.bytesToSize1024 use $ret");
			return $kbytes . ' downloaded';
		}	
			
		return false;	
	}
	
	protected function updatePath() {

		$path = $this->upgrade_root_path;	
		
		if (is_dir($path . $this->app . '-ext')) { //if app dir exclusive (=appname + '-ext') see dir for updates
			$ret = array(0=>$path . $this->app . '-ext',	
						 1=>$this->prpath . 'replication',
						);
		}
		else {
			$upgdirs = is_file($path . 'dir.upg') ? file($path . 'dir.upg') : array();
			foreach ($upgdirs as $dirline) {
				if ($l = trim($dirline))
					$ret[] = $path . $l;
			}
		}					
		return ($ret);			
	}	
	
	protected function scan($path=null, $skipdir=null, $reportout=false, $ajaxid=false) {
	
		$repout = $reportout ? true : false;
	
		$_p = explode('/',$path);
        $saypath = array_pop($_p);

		$dpath = GetReq('upgpath') ? base64_decode(GetReq('upgpath')) :  false;	
		$exec = (($dpath==$path) || ($ajaxid)) ? true : false;	

		//save step file for ajax or reset
		$aj = ($ajaxid>0) ? @file_put_contents($this->prpath . $this->app . '.app', strval($ajaxid), LOCK_EX) : 
							@unlink($this->prpath . $this->app . '.app');		
		
		if (!is_dir($path)) 
			return (nl2br("Invalid path ($saypath)\r\n"));
		
		$scan_path_length = strlen($path);

	    ini_set('max_execution_time', 600);
	    ini_set('memory_limit','1024M');		
		
		$ext_array = array();
		$ext_array = array_map('strtolower',$ext_array);
		$excl_array = array();//'ftpquota','txt','swf','fla','ini'); //<< ini
		$excl_array = array_map('strtolower',$excl_array);
		$extensionless = false;
		$skip = is_array($skipdir) ? $skipdir : array();	

		//	Clear and title the report variable before starting
		$report = "Scan File Check for $acct ($saypath)\r\n";	
		$current = array();
		$added = array();

		$count_baseline = 0;
		$start = microtime(true);

		//	SCAN		
		
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
					$updateFile = str_replace($this->upgrade_root_path, $this->urlpath . '/', $file_path);
					$_updFile = $this->replace_pseudo_dir($updateFile);
					if ((is_readable($_updFile)) && (filemtime($_updFile) < filemtime($file_path))) {	
					    //update
						$added[$file_path] = array('file_hash' => $current[$file_path]['file_hash'], 'file_last_mod' => $current[$file_path]['file_last_mod'], 'update' => $_updFile);
					}
					elseif (!is_readable($_updFile)) {
						if (strstr($_updFile, '.conf')) {
							$conf = $this->prpath . 'myconfig.txt.php';
							if (filemtime($conf) < filemtime($file_path))
								$added[$file_path] = array('file_hash' => $current[$file_path]['file_hash'], 'file_last_mod' => $current[$file_path]['file_last_mod'], 'update' => $_updFile);					
						}
						elseif (strstr($_updFile, '.sql')) {
							$dbupd = $this->prpath. 'sqlupgrade.txt';
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
	
		//	Get scan duration
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
				//$report .= substr($filename,$scan_path_length);
				if ($exec) {
					$report .= $this->_update($filename, $value['update'], true);
					//$report .= $r."[+]\r\n";
				}	
				//else
					//$report .= "\r\n";
			}	
        }

		if ($count_added) {
			$url = seturl("t=cpupgrade&upgpath=".base64_encode($path));
			$button = "<a href=\"$url\" class=\"btn btn-danger\">Upgrade</a>";
			$cmd = $exec ? null : $button;//seturl('t=cpupgrade&upgpath='.base64_encode($path), '[Upgrade]');
			
			$report .= "\r\nSummary:
Current Baseline: $count_current
Added: $count_added $cmd
Scan executed in $elapsed seconds.\r\n";
		}

		//	Destroy tables (release to memory)
		$baseline = $current = $added = array();
		
		//log
		if ($ajaxid>0)
			$log = @file_put_contents($this->prpath . $this->app . '.log', $report, LOCK_EX | FILE_APPEND);		
		
		if ($repout) 
			return(nl2br($report));
		
		return (true);	
	}

	protected function _update($source, $dest, $mkdir=false) {
		
		if (strstr($source,'replication')) {//prpath replication dir
		    if (strstr($source,'.sql')) //must be admindb
				$ret = $this->_execsql($source);	
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
		if ($mkdir) 
			//create dir if not exist
			$this->mkdir(pathinfo($dest, PATHINFO_DIRNAME));
			//@mkdir(dirname($dest), 0777, true);
			
		//echo $source,'-',$dest,'<br/>';
		$ret = copy($source, $dest);		
		return ($ret ? '*' : false);
	}
	
	protected function _execsql($sqlfile) {
		$db = GetGlobal('db');
		
		$sql = @file_get_contents($sqlfile);		
		if ($sql) {
			//db->Execute($sql);
			//return $sql;
			
			$sql_parts = explode(';',$sql);
			$queries = 0; 
			foreach ($sql_parts as $i=>$sSQL) {
				$ret = $db->Execute($sSQL,1);			  
				$queries+=1;
			}	
			$ret = file_put_contents($this->prpath . 'sqlupgrade.txt', $sql, LOCK_EX);
			return $queries . ' queries executed.';			
		}
		return false;
	}
	
	protected function _execini($inifile) {
		$inif = $this->prpath . 'myconfig.txt.php';
		@copy($inif, str_replace('.txt', '._xt', $inif)); //backup
		
		//$inidata = @file_get_contents($inifile);
		include($inifile); //new conf .php type
		
		$fp = new fronthtmlpage(null);
		$pini = $fp->process_commands($myconf); //$inidata);
		unset ($fp);
		
		$inif_local = $this->prpath . 'ini.local';		
		@file_put_contents($inif_local, $pini, LOCK_EX); //copy local		
		
		$ini_array = parse_ini_file($inif_local, true, INI_SCANNER_RAW);
		//alternative after check 
		//$ini_array = parse_ini_string($pini, true, INI_SCANNER_RAW);
		
		if (!empty($ini_array)) {
		    $i = 0;
		    foreach ($ini_array as $s=>$section) {
				foreach ($section as $var=>$val) {
					$variable = strtolower($s) . '.' . strtolower($var); 
					$a = _m("rcconfig.setconf use $variable+".$val);		
					$i+=1;	
				}
			}
			return $i;
		}
		return false;
	}	

	protected function savetmpfile($file=null) {
		if (!$file) $file = 'file.tmp';
		$tmp = '/cp/tmp'; 
		$d = $this->urlpath . $tmp . $file;
		
		//create dir if not exist
		$this->mkdir(pathinfo($d, PATHINFO_DIRNAME));
		
		return ($d);
	}	
	
	protected function getVersion() {
		$vfile = $this->prpath . '.ver';
		
		$ret = is_readable($vfile) ? @file_get_contents($vfile) : null;
		return (trim($ret));
	}
	
	protected function setVersion($ver=null) {
		if (!$ver) return false;
		$vfile = $this->prpath . '.ver';
		
		$ret = @file_put_contents($vfile, $ver, LOCK_EX);
		return ($ret);
	}	
	
	//pseudo-dir replacement
	protected function replace_pseudo_dir($d) {
			
		if (strstr($d,'/home'))
			return str_replace('/home', '', $d);			
		elseif (strstr($d,'/homefiles'))
			return str_replace('/homefiles', '', $d);
		elseif (strstr($d,'/cpfiles'))
			return str_replace('/cpfiles', '', $d);
			
		return $d;
	}

	protected function serverRequest($file=null) {
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->remoteurl);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array('app'=>$this->app, 
												   'element'=>$file,
												   'version'=>$this->getVersion(),
												   'tmpl'=>$this->templatePath,	
												  ));

		// receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec ($ch);

		curl_close ($ch);

		$rdec = $response ? json_decode($response) : null;
		return (!empty($rdec)) ? $rdec : false;	
	}

	protected function checkCRC() {
		$version = $this->getVersion(); //current version
		$errors = 0;
		$backdir = '/lastknowconf';
		$tmp = '/cp/tmp'; 
		$localdir = $this->urlpath . $tmp;		
		
		//call again server for hash list
		$response = $this->serverRequest();
		if (!$response)	
			return localize('_noresponse', getlocal());	
		
		foreach ($response as $r=>$el) {
			$i=0;
			foreach ($el as $e) { 
				if ($i==0) {
					//$ret .= $e;	
					$crc = $e;
					$ret .= $e;
				}	
				elseif ($i==1) {
					$date = $e;
					$ret .= '&gt;' . $e;
				}
				elseif ($i==2) {
					$file_path = $localdir . $e;
					$thiscrc = hash_file("sha1", $file_path);
					if ($crc == $thiscrc)
						$ret .= '&gt;' . basename($file_path) . ': ok'; 
					else {
						$ret .= '&gt;' . $thiscrc . '&gt;' . basename($file_path) . ': failed'; 
						$errors += 1;
					}

					$updatefiles[] = $file_path;		
				}
				elseif ($i==3) 
					$version = $e;
					
				$i+=1;
			}	
			$ret .= '<br/>';	
		}
		
		if ($errors>0) {
			$ret .= 'Please repeat the upgrade procedure.';
		}
		else {
			//backup original files (last known conf)
			$ret .= 'Created last know configuration<br/>';			
			$this->mkdir($localdir . $backdir);
			foreach ($updatefiles as $i=>$f) {
				
				$backfile = str_replace($tmp, $tmp . $backdir, $f);
				$this->mkdir(pathinfo($backfile, PATHINFO_DIRNAME));
				//may the source file not exist	
				@copy(str_replace($tmp, '', $f), $backfile);
				//$ret .= str_replace($tmp, '', $f) . '->' . $backfile . '<br/>';
			}
			
			//do the copy replacing original files
			$ret .= 'Updating...<br/>';
			reset($updatefiles);
			foreach ($updatefiles as $u=>$tmpfile) {				
				$updfile = str_replace($tmp, '', $tmpfile);
				//may the dir not exist
				$this->mkdir(pathinfo($updfile, PATHINFO_DIRNAME));
				if (@copy($tmpfile, $updfile))
					@unlink($tmpfile);
				//$ret .= $tmpfile . '->' . $updfile . '<br/>';
				
				//save dirs to erase order by depth
				/*$tmpdirname = pathinfo($tmpfile, PATHINFO_DIRNAME);
				$ms = explode('/', $tmpdirname);
				$depth = count($ms);
				$id = array_pop($ms);
				$tmpdir[$depth . $id] = $tmpdirname;	
				//$ret .= $depth . $id . '->' . $tmpdirname . '<br/>';		*/
			}	
			
			//clean dirs
			/*rsort($tmpdir);
			foreach ($tmpdir as $d=>$dir) {
				if (is_dir($dir))
					rmdir($dir);
				$ret .= $d .'->' . $dir . '<br/>';
			}*/			
			
			//save current version
			$this->setVersion($version);
			$ret .= 'Finished successfully<br/>';
		}

		return ($ret);	
	}	
	
    public static function mkdir($path) 
	{
        if (!is_dir($path)) {
            // the mode in mkdir is modified by the current umask
            @mkdir($path, self::getChmodForPath($path), $recursive = true);
        }

        // try to overcome restrictive umask (mis-)configuration
        if (!is_writable($path)) {
            @chmod($path, 0755);
            /*if (!is_writable($path)) {
                @chmod($path, 0775);
                // enough! we're not going to make the directory world-writeable
            }*/
        }
        //self::createIndexFilesToPreventDirectoryListing($path);
    }	
	
    private static function getChmodForPath($path)
    {
        return 0755;
    }

};
}
?>