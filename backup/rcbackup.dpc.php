<?php
$__DPCSEC['RCBACKUP_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCBACKUP_DPC")) && (seclevel('RCBACKUP_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCBACKUP_DPC",true);

$__DPC['RCBACKUP_DPC'] = 'rcbackup';
 
$__EVENTS['RCBACKUP_DPC'][0]='cpbackup';
$__EVENTS['RCBACKUP_DPC'][1]='cpbackupdtl';
$__EVENTS['RCBACKUP_DPC'][2]='cpbackupsh';
$__EVENTS['RCBACKUP_DPC'][3]='cpbackupget';
$__EVENTS['RCBACKUP_DPC'][4]='cpbackupsave';
$__EVENTS['RCBACKUP_DPC'][5]='cpbackupdn';

$__ACTIONS['RCBACKUP_DPC'][0]='cpbackup';
$__ACTIONS['RCBACKUP_DPC'][1]='cpbackupdtl';
$__ACTIONS['RCBACKUP_DPC'][2]='cpbackupsh';
$__ACTIONS['RCBACKUP_DPC'][3]='cpbackupget';
$__ACTIONS['RCBACKUP_DPC'][4]='cpbackupsave';
$__ACTIONS['RCBACKUP_DPC'][5]='cpbackupdn';

//$__DPCATTR['RCBACKUP_DPC']['cpbackup'] = 'cpbackup,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCBACKUP_DPC'][0]='RCBACKUP_DPC;Backup;Backup';
$__LOCALE['RCBACKUP_DPC'][1]='_stamp;Stamp;Stamp';
$__LOCALE['RCBACKUP_DPC'][2]='_name;Name;Ονομασία';
$__LOCALE['RCBACKUP_DPC'][3]='_filepath;Object;Στοιχείο';
$__LOCALE['RCBACKUP_DPC'][4]='_filedate;Date created;Ημερομηνία';
$__LOCALE['RCBACKUP_DPC'][5]='_results;Results;Αποτέλεσμα';
$__LOCALE['RCBACKUP_DPC'][6]='_code;Code;Κωδικός';
$__LOCALE['RCBACKUP_DPC'][7]='_id;ID;ID';
$__LOCALE['RCBACKUP_DPC'][8]='_save;Save;Αποθήκευση';

class rcbackup  {

    var $title, $path, $urlpath;
	var $seclevid, $userDemoIds, $owner;
	
	var $instDownload;
		
	function __construct() {
	
		$this->path = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');
		$this->title = localize('RCBACKUP_DPC',getlocal());	 
	  
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];
		$this->userDemoIds = array(5,6,7,8); 
		
		$this->owner = $_POST['Username'] ? $_POST['Username'] : GetSessionParam('LoginName'); 
		$this->instDownload = true;//false;	
	}
	
    function event($event=null) {
	
	   $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	   if ($login!='yes') return null;		 
	
	   switch ($event) {
		 case 'cpbackupdn'   : echo $this->loadframeDn();
		                       die();
							   break;		   
		 case 'cpbackupsave' : $file = $this->downloadFile(); 
							   if ($this->instDownload) die($file);		
		                       break;  		   
		   							   
		 case 'cpbackupget'  : $this->download($this->urlpath . urldecode(GetReq('file')));
							   //die();
							   break;	
							 
		 case 'cpbackupsh'   : break;
		 case 'cpbackupdtl'  : echo $this->loadframe();
		                       die();
							   break; 	   
	     case 'cpbackup'     :
		 default             :    
		                      
	   }
			
    }   
	
    function action($action=null) {
		
	  $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	  if ($login!='yes') return null;	
	 
	  switch ($action) {
		 
		 case 'cpbackupdn'    : break;	
         case 'cpbackupget'   : break;			 
			
		 case 'cpbackupsave'  : if (!$this->instDownload) { 
									$grid = $this->backup_grid(null,140,5,'r', true);
									//$btn = $this->getFilesButtons();		 
									$btn = $this->getFilesJSButtons();
									$out = $this->window($btn, $grid);
								}	
								break; 										  
								
		 case 'cpbackupsh'    : $out = $this->downloadReport(GetReq('id'));
							    break; 
		 case 'cpbackupdtl'   : break;					  
	     case 'cpbackup'      :

		 default              : $grid = $this->backup_grid(null,140,5,'r', true);
							    //$btn = $this->getFilesButtons();
								$btn = $this->getFilesJSButtons();									
							    $out = $this->window($btn, $grid);
	  }	 

	  return ($out);
    }
	
	public function isDemoUser() {
		return (in_array($this->seclevid, $this->userDemoIds));
	}		

	protected function loadframe($ajaxdiv=null) {
		$id = GetParam('id');
		$bodyurl = seturl("t=cpbackupsh&iframe=1&id=$id");
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"240px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}	

	protected function loadframeDn($ajaxdiv=null) {
		$cmd = str_replace(array('|','.'),array('&','='), urldecode(GetReq('cmd')));
		$bodyurl = seturl("t=cpbackupsave&iframe=1&". $cmd);
			
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"40px\"><p>Your browser does not support iframes</p></iframe>";    

		if ($ajaxdiv)
			return $ajaxdiv. '|' . $frame;
		else
			return ($frame); 
	}		
	
	protected function backup_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('RCBACKUP_DPC',getlocal()); //localize('_items', $lan);	
		
		//$backtrace = date("Y-m-d H:i:s", mktime(date('H'), date('i'), date('s'), date('n'), date('j')-30,date('Y')));

		$xsSQL = "select * from (SELECT id, stamp, name, REPLACE(file_path,'{$this->urlpath}','') as file_path, file_created FROM fsbackup) as o";		
		//echo $xsSQL;  
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+id|".localize('_id',getlocal())."|2|0");	
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+stamp|".localize('_stamp',getlocal()). '|5|1|'); //"|link|5|"."javascript:bdetails(\"{id}\");".'||');			
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+name|".localize('_name',getlocal())."|link|5|"."javascript:bdetails(\"{id}\");".'||');		
		//if (!$this->isDemoUser())
			GetGlobal('controller')->calldpc_method("mygrid.column use grid1+file_path|".localize('_filepath',getlocal())."|19|1"); 		
		GetGlobal('controller')->calldpc_method("mygrid.column use grid1+file_created|".localize('_filedate',getlocal())."|5|1|");
	
		$out = GetGlobal('controller')->calldpc_method("mygrid.grid use grid1+fsbackup+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}		
	
	
    public function backup_directory($path=null, $name=null, $download=false, $ziprecur=false) {
		
		//ini_set('max_execution_time', 600);
	    //ini_set('memory_limit','1024M');
	
        $app_path = $this->urlpath . '/';			
	
	    static $dirname;
		$dirname .= $path .'/'; //goto next dir
		static $zip; 
		$zip = new ZipArchive();
		
        $d = date('Ymd-Hi');
        $zname = $name ? /*$d.'-'.*/$name.'.zip' : /*$d.'-'.*/'backup.zip';			
		$zfilename = $this->path . "/uploads/" . $zname; //to save into
         
		if ($zip->open($zfilename, ZipArchive::CREATE)!==TRUE) {
            die("cannot open $zfilename");//false;
        }			
		
	    if (is_dir($app_path . $dirname)) {
		
		  //if (!$ziprecur)
		    $zip->addEmptyDir(str_replace('../','',$dirname));//clean ..
		   
          $mydir = dir($app_path . $dirname);
		 
			
          while ($fileread = $mydir->read ()) {
		   if (($fileread!='.') && ($fileread!='..'))  {   
  	             if (!is_dir($app_path . $dirname."/".$fileread))  {   
					$zip->addFile($app_path . $dirname."/".$fileread, str_replace('../','',$dirname).$fileread); //to sub path
				 }
				 else //recursion
				    $x = $this->backup_directory($fileread, $name, $download, true);
		   } 
	      }
	      $mydir->close ();
		  //goto prev dir
		  $dirname = str_replace($path .'/','',$dirname);
		  
		  if (!$ziprecur) {
			$ret .= "numfiles: " . $zip->numFiles . "<br/>";
			$ret .= "status:" . $zip->status . "<br/>";
		  }
		  
		  if (!$ziprecur) {
			$zip->close();	
			$this->savefsBackup($name, $zfilename);
		  }	
        }
		
		if ((!$ziprecur) && ($download==true)) {
		    $dn = new DOWNLOADFILE($zfilename);
			$ret = $dn->df_download();
		}
		
        //echo $ret;
		return ($ret);
    }

   //zip directory without recursion
    public function backup_directory_norec($path=null, $name=null, $download=false) {
		
		//ini_set('max_execution_time', 600);
	    //ini_set('memory_limit','1024M');

        $app_path = $this->urlpath . '/';	
	
        $d = date('Ymd-Hi');
		$zpath = $path ? $path : '';
        $zname = $name ? /*$d.'-'.*/$name.'.zip' : /*$d.'-'.*/'backup.zip';
		$dirname = $app_path . '/' . $zpath;
		
	    if (is_dir($dirname)) {
		   
          $mydir = dir($dirname);
		  
		  $zip = new ZipArchive();
		  $zfilename = $this->path . "/uploads/" . $zname; //to save into
         
		  if ($zip->open($zfilename, ZipArchive::CREATE)!==TRUE) {
              return "cannot open $zfilename";//false;
          }		  

          while ($fileread = $mydir->read ()) {
		   if (($fileread!='.') && ($fileread!='..'))  {   
  	             if (!is_dir($fileread))  {   
                    $zip->addFile($dirname."/".$fileread, $fileread); //or basename of full path					
				 }
		   } 
	      }
	      $mydir->close ();
		  
          $ret = "numfiles: " . $zip->numFiles . "<br/>";
          $ret .= "status:" . $zip->status . "<br/>";
		  
		  $zip->close();
		  $this->savefsBackup($name, $zfilename);		  
        }
		
		if ($download==true) {
		    //$dn = new DOWNLOADFILE($zfilename);
			//$ret = $dn->df_download();
			
			$this->download($zfilename);
		}
		

		return ($ret);
    } 	
	
	
	protected function backup_Files($name=null, $download=false) {
		$db = GetGlobal('db');
		$backtrace = date("Y-m-d H:i:s", mktime(date('H'), date('i'), date('s'), date('n'), date('j')-30,date('Y')));

		static $zip; 
		$zip = new ZipArchive();
        $d = date('Ymd-Hi');
        $zname = $name ? $d.'-'.$name : $d.'-'.'backup.zip';			
		$zfilename = $this->path . "/uploads/" . $zname; //to save into
         
		if ($zip->open($zfilename, ZipArchive::CREATE)!==TRUE) {
            echo "Cannot open $zfilename";
			return false;
		}
		else {
			$sSQL = "SELECT id, stamp, status, file_path, file_last_mod FROM fshistory WHERE (status='ADDED' or status='ALTERED') and file_path NOT LIKE 'FIRST SCAN%' and stamp > '$backtrace'";
			$result = $db->Execute($sSQL);
		
			foreach ($result as $r=>$rec) {
				if (is_readable($rec['file_path']))  {   
				
					$f = str_replace($this->urlpath .'/', '', $rec['file_path']);
					$zip->addFile($rec['file_path'], $f);
					
					if (!$download) echo $f . '<br/>';
				}	
			}
			
			$zip->close();	
			$this->savefsBackup($zname, $zfilename);	
		
			if ($download==true) {
				$dn = new DOWNLOADFILE($zfilename, 'application/zip');
				$ret = $dn->df_download();
				//return ($ret);	
			}	
			else 
				return true;		
		}
		
	}
	
    protected function backup_Table($table=null, $name=null, $download=false) {
		$db = GetGlobal('db');  
		$d = date('Ymd-Hi');
	    $meter = 0;
		$m = 0;
		$zname = $name ? /*$d.'-'.*/$name : /*$d.'-'.*/ $table . '.zip';
		if (!$table) return false;
		
  	    $zip = new ZipArchive();		
		$zfilename = $this->path . "/uploads/" . $zname; //to save into
         
		if ($zip->open($zfilename, ZipArchive::CREATE)!==TRUE) {
		    echo 'Zip error!';
			return false;
        }				
		else {					  
	
            $ztablename = $this->path . "/uploads/" . $d.'-'. $table . '.csv';		
            
			$result = $db->Execute("SELECT * FROM " . $table);
            if ($result) {	
			
			  $fh = fopen($ztablename, 'w');
			  
			  // Now UTF-8 - Add byte order mark / UTF8 BOM
			  //if (($this->encoding=='utf-8') || ($this->encoding=='utf8'))
			  fwrite($fh, pack("CCC",0xef,0xbb,0xbf)); 
			         
			  foreach ($result as $r=>$rec) {
				for($i = 0; $i < count($rec); $i++) {
					fwrite($fh, $rec[$i] . ';');//implode(';', $rec));
				//foreach ($rec as $i=>$field) {	
				    //NULL VALUES..0 zeros ???
				    //$cell = $row[$i] ? $row[$i] : 'null';
					//is_numeric($i) ? fwrite($fh, $field . ';') : null;
				}                                                                 
				fwrite($fh, PHP_EOL);//"\n");
			  }
			  @fclose($fh);	
			  
			  $zip->addFile($ztablename, $table . '.csv');
			}
						 
			if ($zip->close())	{
				@unlink($ztablename); //for big files delete csv data
				$this->savefsBackup($zname, $zfilename);
			}	
			
			if ($download==true) {
		  
				//$dn = new DOWNLOADFILE($zfilename);
				//$ret = $dn->df_download();
				//return ($ret);
				
				/*header("Pragma: no-cache"); 
				header("Expires: 0"); 
				header("Content-type: application/zip");
				header("Content-Disposition: attachment; filename=\"". $zname ."\"");
				//header("Content-Length: ". filesize($zfilename));				
				$handle = fopen($zfilename, "rb");
				while (!feof($handle)){
					echo fread($handle, 8192);
				}
				fclose($handle);
				exit;	*/
				
				$this->download($zfilename);
			}	
			else
				return true;		
		}	
    }	

	//not used
	protected function backup_Pics($path=null, $name=null, $download=false) {
		$db = GetGlobal('db');
		$backtrace = date("Y-m-d H:i:s", mktime(date('H'), date('i'), date('s'), date('n'), date('j')-30,date('Y')));

		static $zip; 
		$zip = new ZipArchive();
        $d = date('Ymd-Hi');
        $zname = $name ? /*$d.'-'.*/$name : /*$d.'-'.*/'backup.zip';			
		$zfilename = $this->path . "/uploads/" . $zname; //to save into
         
		if ($zip->open($zfilename, ZipArchive::CREATE)!==TRUE) {
            echo "Cannot open $zfilename";
			return false;
		}
		else {
		
			$picpath = $this->urlpath . realpath($path); //<<< urlpath /this->path = cp
			if (is_dir($picpath)) {
				$source = $picpath;
				if (is_dir($source)) {
					$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
					foreach ($files as $file) {
						$file = realpath($file);
						if (is_dir($file)) {
							$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
						} else if (is_file($file)) {
							$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
						}
					}
				} else if (is_file($source)) {
					$zip->addFromString(basename($source), file_get_contents($source));
				}			
			
				$zip->close();	
				$this->savefsBackup($zname, $zfilename);
		
				if ($download==true) {
					$dn = new DOWNLOADFILE($zfilename, 'application/zip');
					$ret = $dn->df_download();
					//return ($ret);	
				}	
				else 
					return true;
			}
			else {
				echo "Not a path ($this->path . $path)";
				return false;	
			}	
		}
		
	}	
	
	protected function downloadFile() {
		$mode = GetReq('mode');
		
		ini_set('max_execution_time', 600);
		ini_set('memory_limit','1024M');

		//set_time_limit(180); 	
		
		switch ($mode) {
			case 'root'  : $path = GetReq('cp'); 
						   $p = explode('/', '/'.$path); // / at start in case of one level
						   $name = array_pop($p);	
			               $ret = $this->backup_directory_norec($path, $name, $this->instDownload);
						   break;				
			case 'system': $path = GetReq('cp'); 
						   $p = explode('/', '/'.$path); // / at start in case of one level
						   $name = array_pop($p);	
			               $ret = $this->backup_directory($path, $name, $this->instDownload);
						   break;	
			case 'dir'   : $path = GetReq('path');
						   $p = explode('/', '/'.$path); // / at start in case of one level	
						   $name = array_pop($p);	
						   $ret = $this->backup_directory($path, $name, $this->instDownload);
			               break;
			case 'pics'  : $path = GetReq('path');
						   $p = explode('/', $path);	
						   $name = array_pop($p);	
						   $ret = $this->backup_directory_norec($path, $name, $this->instDownload);
			               break;
			case 'table' : $table = GetReq('table');
						   $ret = $this->backup_Table($table, null, $this->instDownload);
			               break;  
			case 'files' :
			default      : $ret = $this->backup_Files(null, $this->instDownload);
		}
		
		return($ret);
	}
	
	
	protected function getFilesButtons() {
		
		$furl1 = seturl('t=cpbackupsave&mode=dir&path=files');
		$furl2 = seturl('t=cpbackupsave&mode=dir&path=newsletters');
		$button = $this->createButton('Documents', array('Files'=>$furl1,
														 'Newsletters'=>$furl2,
													));
													
		$turl1 = seturl('t=cpbackupsave&mode=pics&path=images/photo_sm');													  
		$turl2 = seturl('t=cpbackupsave&mode=pics&path=images/photo_md');
		$turl3 = seturl('t=cpbackupsave&mode=pics&path=images/photo_bg');		
		$turl4 = seturl('t=cpbackupsave&mode=pics&path=images');
		$turl5 = seturl('t=cpbackupsave&mode=pics&path=images/thub');
		$turl6 = seturl('t=cpbackupsave&mode=pics&path=images/uphotos');
		$turl7 = seturl('t=cpbackupsave&mode=pics&path=images/catfiles');
		$button .= $this->createButton('Images', array('Small'=>$turl1,
													   'Medium'=>$turl2,
													   'Large'=>$turl3,
													   'Main'=>$turl4,
													   'Thumb'=>$turl5,
													   'Uphotos'=>$turl6,
													   'Category'=>$turl7,
		                                               ),'warning');														
		
		$turl1 = seturl('t=cpbackupsave&mode=table&table=users');
		$turl2 = seturl('t=cpbackupsave&mode=table&table=ulists');		
		$button .= $this->createButton('Persons', array('Users'=>$turl1,
													   'e-Mails'=>$turl2,
		                                                ),'success');
		$turl1 = seturl('t=cpbackupsave&mode=table&table=customers');
		$turl2 = seturl('t=cpbackupsave&mode=table&table=custaddress');														  
		$button .= $this->createButton('Clients', array('Customers'=>$turl1,
													    'Addresses'=>$turl2,
		                                                ),'warning');
													  
		$turl1 = seturl('t=cpbackupsave&mode=table&table=products');													  
		$turl2 = seturl('t=cpbackupsave&mode=table&table=categories');
		$turl3 = seturl('t=cpbackupsave&mode=table&table=transactions');
		$button .= $this->createButton('Inventory', array('Products'=>$turl1,
													      'Categories'=>$turl2,
														  'Transactions'=>$turl3,
		                                                  ),'info');	
														  
		if ($this->isDemoUser()) {}											   
		else {
			$turl0 = seturl('t=cpbackupsave&mode=files');
			$turl1 = seturl('t=cpbackupsave&mode=root&cp=cp');													  
			$turl2 = seturl('t=cpbackupsave&mode=system&cp=cp/html/metro');
			$turl3 = seturl('t=cpbackupsave&mode=system&cp=cp/transactions');		
			$button .= $this->createButton('System', array(
													   'Scanned files'=>$turl0,
		                                               'Root'=>$turl1,
													   'Dashboard'=>$turl2,
													   'Transactions'=>$turl3,
		                                               ));
		}
		return ($button);
	}
	
	protected function createButton($name=null, $urls=null, $t=null, $s=null) {
		$blank = ($this->instDownload) ? "target='_blanc'" : null; //in a new page ....
		
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
				$links .= '<li><a href="'.$url.'" '.$blank.'>'.$n.'</a></li>';
			$lnk = '<ul class="dropdown-menu">'.$links.'</ul>';
		} 
		
		$ret = '
			<div class="btn-group">
                <button data-toggle="dropdown" class="btn '.$size.'btn-'.$type.' dropdown-toggle">'.$name.' <span class="caret"></span></button>
                '.$lnk.'
            </div>'; 
			
		return ($ret);
	}
	

	/*JS iframe load*/
	protected function getFilesJSButtons() {
		
		$button = $this->createJSButton('Documents', array('Files'=>'mode.dir|path.files',
														 'Newsletters'=>'mode.dir|path.newsletters',
													));
													
		$button .= $this->createJSButton('Images', array('Small'=>'mode.pics|path.images/photo_sm',
													   'Medium'=>'mode.pics|path.images/photo_md',
													   'Large'=>'mode.pics|path.images/photo_bg',
													   'Main'=>'mode.pics|path.images',
													   'Thumb'=>'mode.pics|path.images/thub',
													   'Uphotos'=>'mode.pics|path.images/uphotos',
													   'Category'=>'mode.pics|path.images/catfiles',
		                                               ),'warning');													
			
		$button .= $this->createJSButton('Persons', array('Users'=>'mode.table|table.users',
													   'e-Mails'=>'mode.table|table.ulists',
		                                                ),'success');
																											  
		$button .= $this->createJSButton('Clients', array('Customers'=>'mode.table|table.customers',
													    'Addresses'=>'mode.table|table.custaddress',
		                                                ),'warning');
													  
		$button .= $this->createJSButton('Inventory', array('Products'=>'mode.table|table.products',
													      'Categories'=>'mode.table|table.categories',
														  'Transactions'=>'mode.table|table.transactions',
		                                                  ),'info');	
															  
		if ($this->isDemoUser()) {}											   
		else {	
			$button .= $this->createJSButton('System', array(
													   'Scanned files'=>'mode.files',
		                                               'Root'=>'mode.root|cp.cp',
													   'Dashboard'=>'mode.system|cp.cp/html/metro',
													   'Transactions'=>'mode.system|cp.cp/transactions',
		                                               ));
		}
		return ($button);
	}
	
	protected function createJSButton($name=null, $urls=null, $t=null, $s=null) {
		$type = $t ? $t : 'primary'; //danger /warning / info /success
		
		switch ($s) {
			case 'large' : $size = 'btn-large '; break;
			case 'small' : $size = 'btn-small '; break;
			case 'mini'  : $size = 'btn-mini '; break;
			default      : $size = null;
		}
		
		if (!empty($urls)) {
			foreach ($urls as $n=>$url) {
				$js = "onClick=\"bdn('$url');\"";
				$links .= '<li><a href="#" '.$js.'>'.$n.'</a></li>';
			}	
			$lnk = '<ul class="dropdown-menu">'.$links.'</ul>';
		} 
		
		$ret = '
			<div class="btn-group">
                <button data-toggle="dropdown" class="btn '.$size.'btn-'.$type.' dropdown-toggle">'.$name.' <span class="caret"></span></button>
                '.$lnk.'
            </div>'; 
			
		return ($ret);
	}	

	protected function window($buttons, $content) {
		$ret = '	
		    <div class="row-fluid">
                <div class="span12">
                  <div class="widget red">
                        <div class="widget-title">
                           <h4><i class="icon-reorder"></i> Downloads</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                        </div>
                        <div class="widget-body">
							<div class="btn-toolbar">
							'.$buttons .'
							<hr/><div id="bdetails"></div><div id="bdn" style="display:none"></div>
							</div>
							'.$content.'
                        </div>
                  </div>
                </div>
            </div>
';
		return ($ret);
	}	

    protected function bytesToSize1024($bytes, $precision = 2) {
        $unit = array('B','KB','MB','GB');
        return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), $precision).' '.$unit[$i];
    } 	
	
	protected function downloadReport($id) {
		$db = GetGlobal('db');
		$sSQL = "select name, stamp, file_path, hash, file_created from fsbackup where id=".$id;
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		if ($res) {
			
			$url = paramload('SHELL', 'urlname');
			
			$out .= "<br/>File name:" . "<a href=\"".$url.$res->fields[2]."\">".$res->fields[0]."</a>";;
			$out .= "<br/>File stamp:" . $res->fields[1];
			$out .= "<br/>File size:" . $this->bytesToSize1024(filesize($this->urlpath.$res->fields[2]));
			if (!$this->isDemoUser())
				$out .= "<br/>File path:" . $res->fields[2];
			$out .= "<br/>File hash:" . $res->fields[3];
			$out .= "<br/>Created at:" . $res->fields[4];
			return ($out);
		}
		
		return false;
	}
	
	protected function savefsBackup($name, $file_path) {
		$db = GetGlobal('db');
		if ((!$file_path) || (!$name)) return false;
		$acct = $this->owner ? $this->owner : 'system';
		$current = array('file_hash' => hash_file("sha1", $file_path), 'file_created' => date("Y-m-d H:i:s", filemtime($file_path)));
		
		$sfpath = str_replace($this->urlpath, '', str_replace('//','/',$file_path)); //hide root and '//'
		$res = $db->Execute("INSERT INTO fsbackup SET `stamp` = '" . date('Y-m-d h:i:s') . "', `name` = '$name', `file_path` = '$sfpath', `hash` = '" . $current['file_hash'] . "', `file_created` = '" . $current['file_created'] . "', `acct` = '$acct'");
		
		return ($res);
	}
	
	protected function download($file) {
		
		// clean the output buffer
		ob_clean();
		
		if (file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($file).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			readfile($file);
			exit;
		}			
	}	
	
	protected function writeLog($data = '') {
		if (empty($data)) return;

		$data = date('d-m-Y H:i:s')."\r\n" . $data . "\r\n----\r\n";
		$ret = file_put_contents($this->path . 'scanner.log', $data, FILE_APPEND | LOCK_EX);
		
		return $ret;
	}	
};
}
?>