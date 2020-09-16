<?php
$__DPCSEC['RCEDIIMPORT_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ( (!defined("RCEDIIMPORT_DPC")) && (seclevel('RCEDIIMPORT_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCEDIIMPORT_DPC",true);

$__DPC['RCEDIIMPORT_DPC'] = 'rcediimport';

$__EVENTS['RCEDIIMPORT_DPC'][0]='cpediimport';
$__EVENTS['RCEDIIMPORT_DPC'][1]='cpdoediimport';

$__ACTIONS['RCEDIIMPORT_DPC'][0]='cpediimport';
$__ACTIONS['RCEDIIMPORT_DPC'][1]='cpdoediimport';

$__LOCALE['RCEDIIMPORT_DPC'][0]='RCEDIIMPORT_DPC;EDI import;Εισαγωγή EDI';
$__LOCALE['RCEDIIMPORT_DPC'][1]='_ediimport;EDI import;Εισαγωγή EDI';
$__LOCALE['RCEDIIMPORT_DPC'][2]='_moveincategory;Insert items in category;Εισαγωγή ειδών στην κατηγορία';
$__LOCALE['RCEDIIMPORT_DPC'][3]='_date;Date;Ημερ.';
$__LOCALE['RCEDIIMPORT_DPC'][4]='_time;Time;Ώρα';
$__LOCALE['RCEDIIMPORT_DPC'][5]='_qty;Quantity;Ποσότητα';
$__LOCALE['RCEDIIMPORT_DPC'][6]='_items;Items;Είδη';
$__LOCALE['RCEDIIMPORT_DPC'][7]='_active;Active;Ενεργό';
$__LOCALE['RCEDIIMPORT_DPC'][8]='_title;Title;Τίτλος';
$__LOCALE['RCEDIIMPORT_DPC'][9]='_descr;Description;Περιγραφή';
$__LOCALE['RCEDIIMPORT_DPC'][10]='_owner;Owner;Owner';
$__LOCALE['RCEDIIMPORT_DPC'][11]='_color;Color;Χρώμα';
$__LOCALE['RCEDIIMPORT_DPC'][12]='_code;Code;Κωδικός';
$__LOCALE['RCEDIIMPORT_DPC'][13]='_dimensions;Dimension;Διαστάσεις';
$__LOCALE['RCEDIIMPORT_DPC'][14]='_size;Size;Μέγεθος';
$__LOCALE['RCEDIIMPORT_DPC'][15]='_dimensions;Dimensions;Διαστάσεις';
$__LOCALE['RCEDIIMPORT_DPC'][16]='_xmlcreate;Create XML;Δημιούργησε XML';
$__LOCALE['RCEDIIMPORT_DPC'][17]='_xml;XML item;Είδος XML';
$__LOCALE['RCEDIIMPORT_DPC'][18]='_manufacturer;Manufacturer;Κατασκευαστής';
$__LOCALE['RCEDIIMPORT_DPC'][19]='_uniname1;Unit;Μον.μετρ.';
$__LOCALE['RCEDIIMPORT_DPC'][20]='_ypoloipo1;Qty;Υπόλοιπο';
$__LOCALE['RCEDIIMPORT_DPC'][21]='_price0;Price 1;Αξία 1';
$__LOCALE['RCEDIIMPORT_DPC'][22]='_price1;Price 2;Αξία 2';
$__LOCALE['RCEDIIMPORT_DPC'][23]='_cat;Category;Κατηγορία';
$__LOCALE['RCEDIIMPORT_DPC'][24]='_createcategory;Create categories in category;Δημιουργία κατηγοριών στην κατηγορία';
$__LOCALE['RCEDIIMPORT_DPC'][25]='_updateincategory;Update items in category;Μεταβολή ειδών στην κατηγορία';
$__LOCALE['RCEDIIMPORT_DPC'][26]='_insupd;Insert - Update;Εισαγωγή - Μεταβολή';
$__LOCALE['RCEDIIMPORT_DPC'][27]='_remove;Remove;Διαγραφές';
$__LOCALE['RCEDIIMPORT_DPC'][28]='_deletecategory;Delete categories in category;Διαγραφή κατηγοριών στην κατηγορία';
$__LOCALE['RCEDIIMPORT_DPC'][29]='_deleteincategory;Delete items in category;Διαγραφή ειδών στην κατηγορία';
$__LOCALE['RCEDIIMPORT_DPC'][30]='_dblog;Affect database and logs;Ενημέρωση ΒΔ και αρχείο καταγραφής';
$__LOCALE['RCEDIIMPORT_DPC'][31]='_dbset;Affect database;Ενημέρωση Βασης Δεδομένων';
$__LOCALE['RCEDIIMPORT_DPC'][32]='_logset;Affect logs;Ενημέρωση αρχείων καταγραφής';
$__LOCALE['RCEDIIMPORT_DPC'][33]='_logclear;Clear logs;Άδειασμα αρχείων καταγραφής';
$__LOCALE['RCEDIIMPORT_DPC'][34]='_catupd;Update categories;Ενημέρωση κατηγοριών';
$__LOCALE['RCEDIIMPORT_DPC'][35]='_filter;Filter;Φίλτρο';
$__LOCALE['RCEDIIMPORT_DPC'][36]='_settings;Settings;Ρυθμίσεις';
$__LOCALE['RCEDIIMPORT_DPC'][37]='_out;Exports;Εξαγωγές';
$__LOCALE['RCEDIIMPORT_DPC'][38]='xml;Exports XML;Εξαγωγές XML';
$__LOCALE['RCEDIIMPORT_DPC'][39]='csv;Exports CSV;Εξαγωγές CSV';
$__LOCALE['RCEDIIMPORT_DPC'][40]='sql;Exports SQL;Εξαγωγές SQL';
$__LOCALE['RCEDIIMPORT_DPC'][41]='log;Exports LOG;Εξαγωγές LOG';
$__LOCALE['RCEDIIMPORT_DPC'][42]='_lrp;Long Running Process;Long Running Process';

class rcediimport {
	
	var $title, $prpath, $urlpath, $url;
	var $fields, $etlfields, $messages;
	var $etlPath, $etlLOG, $i, $now, $maxLines, $maxPage;
	
	var $dac7, $indac7, $dacEnv;
		
    public function __construct() {
	  
		$this->prpath = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');	
		$this->url = paramload('SHELL','urlbase');
		$this->title = localize('RCEDIIMPORT_DPC',getlocal());	
		
		$this->messages = array(); 
		$this->fields = array('id','datein','code3','code5','owner','itmactive','active','itmname','uniname1','ypoloipo1','price0','price1','manufacturer','size','color','cat0','cat1','cat2','cat3','cat4');	
		$this->etlfields = implode(',', $this->fields);
		
		$this->etlPath = $this->prpath . 'uploads/';
		$this->etlLOG = array('kaisidis'=>array('xml'=>'datamedia-out.xml','csv'=>'datamedia-out.csv','sql'=>'datamedia-out.sql','log'=>'datamedia-out.log'),
							  'aidonitsa'=>array('xml'=>'aidonitsa-out.xml','csv'=>'aidonitsa-out.csv','sql'=>'aidonitsa-out.sql','log'=>'aidonitsa-out.log'),	
							  'logicom'=>array('xml'=>'logicom-out.xml','csv'=>'logicom-out.csv','sql'=>'logicom-out.sql','log'=>'logicom-out.log'),
							  'agc'=>array('xml'=>'agc-out.xml','csv'=>'agc-out.csv','sql'=>'agc-out.sql','log'=>'agc-out.log'),
							  'tradesor'=>array('xml'=>'tradesor-out.xml','csv'=>'tradesor-out.csv','sql'=>'tradesor-out.sql','log'=>'tradesor-out.log'),
						);		
		
		$this->i = 0;
		$this->now = date("Y-m-d H:m:s");
		
		$this->dac7 = _m('cmsrt.isDacRunning');
		$this->indac7 = _m('cmsrt.runningInsideDac');
		$this->dacEnv = GetGlobal('controller')->env;		
		
		$this->maxLines = ($this->indac7==true) ? 50000 : 5000;
		$this->maxPage = ($this->indac7==true) ? 10000 : 500;
	}
	
    public function event($event=null) {
	
	    $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;

	    switch ($event) {
			
			case 'cpdoediimport'  :  $this->submit();
			                         break;
																		
			case 'cpediimport'    :
			default               :	
        }			
			
    }	

    public function action($action=null)  { 	

        $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;
		
	    switch ($action) {										  									 
			
			case 'cpdoediimport'       :
			case 'cpediimport'         : 
		    default                    :  //$out = $this->selectLOG(); //in page
										  //$out = $this->showEdiItems();//DISABLED
		}		
		
        return ($out);
	}
	
	public function showEdiItems() {
		
		return $this->items_grid(null,140,5,'e', true);
	}	
	
	public function showfilter() {
		if (!$filter=GetParam('flt')) return null;
		if (!$fvalue=GetParam('val')) return null;
		$title = localize('_filter',getlocal());
		
		if ($filter=='datein') {
			$now = time(); // or your date as well
			$_datein = strtotime($fvalue); //"2010-01-01");
			$datediff = $now - $_datein;

			$daysback =  round($datediff / (60 * 60 * 24));
			
			$title .= " : items updated before $daysback day(s)";
		}		
		else
			$title .= " ($filter : $fvalue)";
		
		return $title; 
	}	
	
	public function getFilter($name=false) {
		
		return ($name==true) ? GetReq('flt') : GetReq('val');
	}	
	
	protected function whereFilter() {
		if (!$filter=GetParam('flt')) return null;
		if (!$fvalue=GetParam('val')) return null;
		
		if ($filter=='datein') {
			$now = time(); // or your date as well
			$_datein = strtotime($fvalue); //"2010-01-01");
			$datediff = $now - $_datein;

			$daysback =  round($datediff / (60 * 60 * 24));
			//echo " where DATE(datein) BETWEEN DATE( DATE_SUB( NOW() , INTERVAL $daysback DAY ) ) AND DATE ( NOW() )";
			return " where DATE(datein) BETWEEN DATE( DATE_SUB( NOW() , INTERVAL $daysback DAY ) ) AND DATE ( NOW() )";
		}
		
		$v = is_numeric($fvalue) ? $fvalue : "'$fvalue'";
		return " where $filter=" . $v; 
	}
	
	protected function items_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;				   
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('_items', getlocal()); 
		
		$_wf = $this->whereFilter();
		$xsSQL = "SELECT * from (select {$this->etlfields}  from etlproducts $_wf) o ";		   
		   							
		_m("mygrid.column use grid1+id|".localize('id',$lan)."|2|0|");
		_m("mygrid.column use grid1+itmactive|".localize('_active',$lan)."|boolean|1|1:0");		
		_m("mygrid.column use grid1+active|".localize('_active',$lan)."|boolean|1|101:0|");
		_m("mygrid.column use grid1+datein|".localize('_date',$lan)."|link|5|cpediimport.php?flt=datein&val={datein}");	
		_m("mygrid.column use grid1+code3|".localize('_code',$lan)."|5|0|");
		_m("mygrid.column use grid1+code5|".localize('_code',$lan)."|link|5|cpediimport.php?flt=code5&val={code5}");	
		_m("mygrid.column use grid1+itmname|".localize('_title',$lan)."|10|0|");	
		_m("mygrid.column use grid1+cat0|".localize('_cat',$lan)."|link|5|cpediimport.php?flt=cat0&val={cat0}");	
		_m("mygrid.column use grid1+cat1|".localize('_cat',$lan)."|link|5|cpediimport.php?flt=cat1&val={cat1}");
		_m("mygrid.column use grid1+cat2|".localize('_cat',$lan)."|link|5|cpediimport.php?flt=cat2&val={cat2}");
		_m("mygrid.column use grid1+cat3|".localize('_cat',$lan)."|link|5|cpediimport.php?flt=cat3&val={cat3}");
		_m("mygrid.column use grid1+cat4|".localize('_cat',$lan)."|link|5|cpediimport.php?flt=cat4&val={cat4}");
		_m("mygrid.column use grid1+uniname1|".localize('_uniname1',$lan)."|5|0|");		
		_m("mygrid.column use grid1+ypoloipo1|".localize('_ypoloipo1',$lan)."|5|0|");			
		_m("mygrid.column use grid1+price0|".localize('_price0',$lan)."|5|0|");		
		_m("mygrid.column use grid1+price1|".localize('_price1',$lan)."|5|0|");			
		_m("mygrid.column use grid1+manufacturer|".localize('_manufacturer',$lan)."|link|5|cpediimport.php?flt=manufacturer&val={manufacturer}");//."|5|0|");
		_m("mygrid.column use grid1+size|".localize('_size',$lan)."|5|0|");
		_m("mygrid.column use grid1+color|".localize('_color',$lan)."|5|0|");
		_m("mygrid.column use grid1+owner|".localize('_owner',$lan)."|link|5|cpediimport.php?flt=owner&val={owner}");

		$out = _m("mygrid.grid use grid1+etlproducts+$xsSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1");
		
		return ($out);  	
	}	
	
	public function currCategory() {
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$id = $cpGet['id'];  		
			
		//echo $cat . '-' . $id;
		$csep = _m('cmsrt.sep');
		//$currcat = str_replace($csep, ' &gt; ', $cat);
		//return $currcat;
		
		$cats = explode($csep, $cat);
		foreach ($cats as $i=>$c)
			$_cat[] = _m("cmsrt.replace_spchars use $c+1");
		
		if (!empty($_cat))
			return implode(' &gt; ', $_cat);	
		
		return false;
	}
	
	public function viewMessages($template=null) {
		if (empty($this->messages)) return;
	    $t = ($template!=null) ? _m("cmsrt.select_template use $template+1") : null;
		
		foreach ($this->messages as $m=>$message) {
			if ($t) 	
				$ret .= $this->combine_tokens($t, array(0=>$message));
			else
				$ret .= "<option value=\"$m\">$message</option>";
		}
		return ($ret);
	}	

	public function currFile($fullpath=false) {
		if (!$file = GetParam('imp')) return;
	    
		$ret = $fullpath ? $this->etlPath . $file : $file; 
		return ($ret);
	}	
	
	public function currSettings() {
		$currfile = $this->currFile();
		$settingsFile = $this->etlPath . 'import_' . $currfile . '.ini';
		$settings = @file($settingsFile);
		if (empty($settings)) return;

		foreach ($settings as $m=>$line) 
			$ret .= "<option value=\"$m\">$line</option>";

		return ($ret);
	}

	
	//log export files
	public function selectLOG() {
		if ($this->currFile()) return null;
		$table = GetReq('edi');
		$lan = getlocal();
		$LOGselectButton = null;
		
		if (!empty($this->etlLOG)) {
			
			foreach ($this->etlLOG as $cnf=>$logfiles) { 
				$menu = array();
				foreach ($logfiles as $title=>$log) {
				
					$_title = localize($title, $lan);
					$menu[$_title] = "cpediimport.php?imp=". $log;
				}	
				$btitle = localize('_out', $lan) .' '. ucfirst($cnf);	
				$LOGselectButton .= $this->createButton($btitle, $menu, 'info');				
			}
		}		  
				  
		return $LOGselectButton . '<hr/>';		
	}	
	
	protected function createButton($name=null, $urls=null, $t=null, $s=null) {
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

	protected function submit() {
		
		if ($this->dac7==true) {
			//when in dac mode submit is all at once ()see async/ppost/bshopplus_rchandleitems_submit
			
			//if ($this->savePostCookie()) {
			if (_m('cmsrt.savePostCookie')) {	
				
				//execute long running processs	
				$cmd = 'async/ppost/bshopplus_rcediimport_submit/';
				phpdac7\getT($cmd); //exec cmd and close tier
				
				$this->jsDialog('Start', localize('_lrp', getlocal()), 3000, 'cdact.php?t=texit');
				$this->messages[] = 'LRP started!';	
				
				return true;
			}
			else
				$this->messages[] = 'LRP failed!';	
		}
		else {		
			$currfile = $this->currFile();
			$currfilePath = $this->currFile(true);		
		
			if (!is_readable($currfilePath)) {	
			
				$this->messages[] = "File ($currfilePath) not exists";
				return false;
			}	
		
			if (stristr($currfile, '.csv')) { //csv file
		
				$this->messages[] = "File $currfile";
				$this->istextCSV($currfile, false, true);
			}
			elseif (stristr($currfile, '.sql')) { //sql file
			
				$this->messages[] = "File $currfile";
				$this->istextSQL(false, true);
			}
			else {//xml
		
				$this->messages[] = "Unhandled file $currfile";
				//$this->istextSQL(false, true);
			}	
			
			return true;
		}
		return false;	
	}
	

	//partial SQL insert
	public function istextSQL($log=false, $logdb=false) {	
		$db = GetGlobal('db');
		
		$cntfile = $this->etlPath . 'import-counter.log';
		$logfile = $this->etlPath . 'import-messages.log';
		$errfile = $this->etlPath . 'import-errors.log';
		//clear log files
		if (GetParam('logclear')) {
			@unlink($cntfile);
			@unlink($logfile);
			@unlink($errfile);
		}	
		
		//$sqlarray = file($this->currFile(true));
		
		$line_delimiter =  ';;'; //DOUBLE COLLON	//');;' . PHP_EOL;
		$sqlarray = explode($line_delimiter, file_get_contents( $this->currFile(true)));
		
		$errmsg = 0;
		if (!empty($sqlarray))
		{	
			$start = microtime(true);
			$_max = count($sqlarray);
			if ($_max <= $this->maxLines) { //$this->maxLines not include <Br/><13> 
		
			$i=1;
			$ix=0;
			$_x = @file_get_contents($cntfile);
			$x = $_x ? $_x : 1;
			foreach ($sqlarray as $zi=>$rec) {
				if (($_x) && ($zi < $_x)) continue;
				if ($x == $_x + $this->maxPage) {
						
					file_put_contents($cntfile, $x);
					//$this->messages[] = '(' . $x . ') Press submit to continue...';
					$this->_echo('(' . $x . ') Press submit to continue...');
						
					//save log messages
					//if (GetParam('logset'))
						file_put_contents($logfile, implode(PHP_EOL, $this->messages), LOCK_EX);	
		
					return true;
				}				
				
				$sqlstatement = trim($rec);

				if ($sqlstatement) 
				{
					$runSQL = trim(str_replace("\r\n", "", $sqlstatement));// . $line_delimiter; //add delimiter trail
					//$ix=0;
					
					if ((stristr($runSQL,'insert')) || (stristr($runSQL,'update')) ||
						(stristr($runSQL,'delete ')) || (stristr($runSQL,'select'))) 
					{
					
					//support multiple sql separated by ; -last separator must be ); = $line_delimiter -
					/*$mSQL = array(); //reset
					if (strstr($runSQL, ';')) 
						$mSQL = explode(';', $runSQL); //many sql cmds
					else
						$mSQL[] = $runSQL; //one elemet array
					
					foreach ($mSQL as $m=>$rSQL)
					{*/
						//if (trim($rSQL)) {
							
							if ($res = $db->Execute($runSQL,1)) //runSQL
							{
								$ix=1;
								//$this->_echo('Executed: ' . $rSQL);
							}
							else 
							{
								//$this->messages[] = $runSQL . " (" . $db->error . ")";
								$this->_echo('Error: ' . $runSQL . " (" . $db->error . ")");
								$errmsg += 1;
							}

							$i+=1;	
						//}
					}	
				}				
				$x+=1;
			} //foreach			
			} //max
		} //not empty array
	
		$this->_echo("(". date('Y-m-d H:i:s') . ")"); 
		$this->_echo("----------------------- End of process");
		$this->_echo("Row SQL file readed!");	
		$this->_echo($_max . " records in file!");		
		$this->_echo(($_counter + $i) . " records readed!");		
		$this->_echo($i . " records executed!");
		$this->_echo("Import done!");	 			
		$this->_echo('----------------------- Errors');			
		$this->_echo($errmsg);
		$this->_echo("Time elapsed:" . (microtime(true) - $start)/60);
		$this->_echo('------------------------------');	
	
	    //erase counter file
		@unlink($cntfile);
	    //save err messages
		//if (GetParam('logset'))		
			file_put_contents($logfile, implode(PHP_EOL, $this->messages), LOCK_EX);
	
		return true;	
	}		

	//partial CSV insert
	public function istextCSV($name=null, $log=false, $logdb=false) {
		$db = GetGlobal('db'); 
		  		
		$cntfile = $this->etlPath . 'import-counter.log';
		$logfile = $this->etlPath . 'import-messages.log';
		$errfile = $this->etlPath . 'import-errors.log';		
		//clear log files
		if (GetParam('logclear')) {
			@unlink($cntfile);
			@unlink($logfile);
			@unlink($errfile);
		}		
      
	  	$name = $this->currFile(); //override  
		$scenario = 'import_' . $name . '.ini';
		if (file_exists($this->etlPath . $scenario)) {			
		  
			$data = @file_get_contents($this->currFile(true));
	        if (!$data) {
				//$this->messages[] = "File ($name) is empty!";
				$this->_echo("File ($name) is empty!");
				return false;
			}
			
			//READ SCENARIO  	   
			$sc = parse_ini_file($this->etlPath .  $scenario, false, INI_SCANNER_RAW);
			$delimiter = $sc['delimiter'] ? $sc['delimiter'] : ';';
			$eol = $sc['eol']; //for raw csv printing last in line  = .
			$line_delimiter =  $delimiter . $eol; //"\n"; //"\r\n"; 
			$getrec = explode(',',$sc['getrec']);
			$attrrec = explode(',',$sc['attrrec']);
			/*
			$titlelines = @file_get_contents($cntfile) ? 
							intval(file_get_contents($cntfile)) + 1 :
							($sc['titles'] ? $sc['titles'] : 0);		 
			*/
			$errmsg = 0;
			$i = 1;	
			$ix = 0;			
			$mode = trim($sc['mode']);
			$source = explode($line_delimiter, $data);
					
			if (!empty($source)) 
			{	
				$start = microtime(true);	 
				//$this->messages[] = "Start : $start, mode: $mode";
				$this->_echo("Start : $start, mode: $mode");
				
				$_max = count($source);
				if ($_max <= $this->maxLines) { //max lines to check
				//$this->messages[] = "Max : $_max";
				$this->_echo("Max : $_max");
				
				//for ($_i = $titlelines; $_i <= $_max ; $_i++) {	
				$_x = @file_get_contents($cntfile);
				$x = $_x ? $_x : 1;
				foreach ($source as $zi=>$rec) {
					if (($_x) && ($zi < $_x)) continue;
					if ($x == $_x + $this->maxPage) {
						
						file_put_contents($cntfile, $x);
						//$this->messages[] = '(' . $x . ') Press submit to continue...';
						$this->_echo('(' . $x . ') Press submit to continue...');
						
						//save log messages
						//if (GetParam('logset'))
							file_put_contents($logfile, implode(PHP_EOL, $this->messages), LOCK_EX);	
		
						return true;
					}

					$this->i = $_i; 
					//$field = explode($delimiter, trim($source[$_i]));
					$field = explode($delimiter, trim($rec));

					if (trim($field[0]))  
					{
						switch ($mode) {
				  
							case 'update' :   
									  $sSQL = $this->update_cmd($sc,$field,$getrec,$attrrec);
									  if ($sSQL) {
										if ($res = $db->Execute($sSQL,1)) {
											$ix+=1;
										}
										else {
											//$this->messages[] = $sSQL . " (" . $db->error . ")";
											$this->_echo($sSQL . " (" . $db->error . ")");
											$errmsg += 1;
										}
									  }					  
					                  break;
				  
							case 'insert' :   
									  $sSQL = $this->insert_cmd($sc,$field,$getrec,$attrrec);
									  if ($sSQL) {
										if ($res = $db->Execute($sSQL,1)) {
											$ix+=1;
										}
										else {
											//$this->messages[] = $sSQL . " (" . $db->error . ")";
											$this->_echo($sSQL . " (" . $db->error . ")");
											$errmsg += 1;			
										}
									  }						  
					                  break;
									  
							case 'replace':				  
							default       : 
									  $sres = null;
									  
									  //select first then choose upd or ins
									  $sltSQL = $this->select_cmd($sc,$field,$getrec,$attrrec);
									  $sres = $db->Execute($sltSQL);
									  
									  if ($sres->fields[0]) 
										$sSQL = $this->update_cmd($sc,$field,$getrec,$attrrec);	
									  else 
										$sSQL = $this->insert_cmd($sc,$field,$getrec,$attrrec);   
									
									  //$this->messages[] = $sSQL; //$sltSQL . "\t" . $sSQL;
								      
									  if ($res = $db->Execute($sSQL)) 
									  {	
                                        $ix+=1;									  			
									  }
									  else {
										//$this->messages[] = $sSQL . " (" . $db->error . ")";
										$this->_echo($sSQL . " (" . $db->error . ")");
										$errmsg += 1;		   
									  }
									  //if (GetParam('dbset'))
										//$res = $db->Execute($sSQL);
						}//switch			  
						$i+=1;
					}//if trim
					
					$x+=1;
				}//foreach	/ for
				}//max
			} //if array	
		
			$this->_echo("(". date('Y-m-d H:i:s') . ")"); 
			$this->_echo("----------------------- End of process");
			$this->_echo($scenario . " file readed!");
			$this->_echo("Mode:" . $mode);
			$this->_echo($_max . " records in file!");			
			$this->_echo(($titlelines + $i) . " records readed!");			
			$this->_echo($i . " records executed!");
			$this->_echo("Import done!");	 			
			$this->_echo('----------------------- Errors');			
			$this->_echo($errmsg);
			$this->_echo("Time elapsed:" . (microtime(true) - $start)/60);
			$this->_echo('------------------------------');			 
		}
		else 
			//$this->messages[] = "Scenario missing! (" . $scenario . ")";
			$this->_echo("Scenario missing! (" . $scenario . ")");
		
		//erase counter file
		@unlink($cntfile);
		//save err messages
		//if (GetParam('logset'))
			file_put_contents($logfile, implode(PHP_EOL, $this->messages), LOCK_EX);	
		
		return true; 	
	} 

	protected function insert_cmd($sc,$field,$getrec,$attrrec) {
   
		$sSQL = "insert into ". $sc['table'] . " (";
		$sSQL.= $sc['setrec'] . $sc['setrec2'] . ') values (';
		 
	    $datasql = array();
		foreach ($field as $fid=>$fdata) {
		   //echo $fdata,'+';
		   if (in_array($fid,$getrec))
		     $datasql[] = $fdata;
		}
		 
		$datasqltype = array();
		foreach ($datasql as $fr=>$fd) 
		{
		    if ($attrrec[$fr]=='s')
				$datasqltype[] = "'" . $this->make_replaces($fd) ."'";
			elseif ($attrrec[$fr]=='n') {
				//$datasqltype[] = 0 + str_replace($sc['sdecimal'],$sc['tdecimal'],trim($fd));//casting to num  
			  if (is_numeric($fd))
				$datasqltype[] = 0 + str_replace($sc['sdecimal'],$sc['tdecimal'],trim($fd));//casting to num  
			  else
				$datasqltype[] = 0;	
			}				
			elseif ($attrrec[$fr]=='d') //date
				$datasqltype[] = '"' . $datetime .'"';									  
			else   
				$datasqltype[] = trim($fd);
		}  
		 
        $sSQL.= implode(',',$datasqltype); 
		 
		$sSQL.= $this->replace_params($sc['getrec2']);//str_replace('^datetime',"'".$this->datetime."'",$sc['getrec2'])/* . ",'$this->datetime'"*/ . 
		$sSQL.= ');';   
		 
		return $sSQL;
	}
	
	protected function update_cmd($sc,$field,$getrec,$attrrec) {
   
        $sSQL = "update " . $sc['table'] . " set ";
        $field_names = explode(',',$sc['setrec']);
        $extra_field_names = explode(',',$sc['setrec2']);
        $extra_field_values = explode(',',$sc['getrec2']);
		 
		$datasql = array();
		foreach ($field as $fid=>$fdata) 
		{
		   if (in_array($fid,$getrec))
				$datasql[] = $fdata;
		}	
		 
		$datasqltype = array();
		foreach ($datasql as $fr=>$fd) 
		{
		    if ($attrrec[$fr]=='s')
				$datasqltype[] = "'" . $this->make_replaces($fd) ."'";
			elseif ($attrrec[$fr]=='n') {
			  //$datasqltype[] = 0 + str_replace($sc['sdecimal'],$sc['tdecimal'],trim($fd));//casting to num  WARNINGS when no num
			  if (is_numeric($fd))
				$datasqltype[] = 0 + str_replace($sc['sdecimal'],$sc['tdecimal'],trim($fd));//casting to num  
			  else
				$datasqltype[] = 0;	
			}
			elseif ($attrrec[$fr]=='d') //date
				$datasqltype[] = "'" . $datetime . "'";									  
			else   
				$datasqltype[] = trim($fd);
		}  
								 
		foreach ($field_names as $fn=>$name) 					 
			$sqlupdate[] = $name.'='.$datasqltype[$fn];

        $sSQL.= implode(',',$sqlupdate);
								 
		foreach ($extra_field_names as $fne=>$namee) {
			$value = $this->replace_params($extra_field_values[$fne], $sc);
			$sqlupdate2[] = $value ? $namee.'='.$value : null ;
		}
								 
        $sSQL.= implode(',',$sqlupdate2); 	
        $sSQL .= ' where ';
		$where = explode(',', $sc['where']);
		foreach ($where as $w=>$wcl) 
		{
			if ($wcl) 
			    $sSQL .= str_replace(array('eq','gt','lt'), 
			                     array('='.$datasqltype[$w],
								       '>'.$datasqltype[$w],
									   '<'.$datasqltype[$w]), $wcl); 
		}
		$sSQL.= ';';	   
		 
		return ($sSQL);
	}   

	protected function replace_cmd($sc,$field,$getrec,$attrrec) {
   
         $sSQL = "REPLACE ". $sc['table'] . " set ";
         $field_names = explode(',',$sc['setrec']);
         $extra_field_names = explode(',',$sc['setrec2']);
         $extra_field_values = explode(',',$sc['getrec2']);
		 
		 $datasql = array();
		 foreach ($field as $fid=>$fdata) {
		   if (in_array($fid,$getrec))
		     $datasql[] = $fdata;
		 }	

		 $datasqltype = array();
		 foreach ($datasql as $fr=>$fd) {
		    if ($attrrec[$fr]=='s')
			  $datasqltype[] = "'" . $this->make_replaces($fd) ."'";
			elseif ($attrrec[$fr]=='n') {
			  //$datasqltype[] = 0 + str_replace($sc['sdecimal'],$sc['tdecimal'],trim($fd));//casting to num  WARNINGS when no num  
			  if (is_numeric($fd))
				$datasqltype[] = 0 + str_replace($sc['sdecimal'],$sc['tdecimal'],trim($fd));//casting to num  
			  else
				$datasqltype[] = 0;		
			}
			elseif ($attrrec[$fr]=='d') //date
			  $datasqltype[] = "'" . $datetime . "'";									  
			else   
			  $datasqltype[] = trim($fd);
		 } 
						 
		 foreach ($field_names as $fn=>$name) 					 
		   $sqlreplace[] = $name.'='.$datasqltype[$fn];

         $sSQL.= implode(',',$sqlreplace);
		
		 foreach ($extra_field_names as $fne=>$namee) {
		   $value = $this->replace_params($extra_field_values[$fne], $sc);
		   $sqlupdate2[] = $value ? $namee.'='.$value : null ;
		 }
					 
         $sSQL.= implode(',',$sqlupdate2); 	
		 
		 $sSQL.= ';';	   
		 
		 return ($sSQL);
	} 	
	
	protected function select_cmd($sc,$field,$getrec,$attrrec) {	

         $field_names = explode(',',$sc['setrec']);   
   
		 $datasql = array();
		 foreach ($field as $fid=>$fdata) {
		   if (in_array($fid,$getrec))
		     $datasql[] = $fdata;
		 }			 
		 
		 $datasqltype = array();
		 foreach ($datasql as $fr=>$fd) {
		    if ($attrrec[$fr]=='s')
			  $datasqltype[] = "'" . $this->make_replaces($fd) ."'";
			elseif ($attrrec[$fr]=='n') {
			  //$datasqltype[] = 0 + str_replace($sc['sdecimal'],$sc['tdecimal'],trim($fd));//casting to num  WARNINGS when no num				
			  if (is_numeric($fd))
				$datasqltype[] = 0 + str_replace($sc['sdecimal'],$sc['tdecimal'],trim($fd));//casting to num  
			  else
				$datasqltype[] = 0;		
			} 
			elseif ($attrrec[$fr]=='d') //date
			  $datasqltype[] = "'" . $datetime . "'";									  
			else   
			  $datasqltype[] = trim($fd);		 
		 }
		 
		 $where = explode(',', $sc['where']);
		 foreach ($where as $w=>$wcl) {
			if ($wcl) {
				$sSQL = 'SELECT ' . $field_names[$w] . ' from ' . $sc['table'] . ' where ';				
			    $sSQL .= str_replace(array('eq','gt','lt'), 
			                     array('='.$datasqltype[$w],
								       '>'.$datasqltype[$w],
									   '<'.$datasqltype[$w]), $wcl); 
				break;					   
			}						   
		 }
		 
		 $sSQL.= ';';	   
		 
		 return ($sSQL);   
	}
   
	protected function make_replaces($str=null) {
   
		if ($str) {
			$ret = addslashes(trim($str));// str_replace('"','\"',trim($str)); 
			return ($ret);
		}
	 
		return null;
	}

	protected function replace_params($rec=null, $params=null) {
		if (!$rec) return;
		if (!empty($params)) {
			$intI = ($params['i']=='n') ? true : false;
		}
	  
		$f = explode(',',$rec);
		foreach ($f as $i=>$field) 
		{
			switch ($field) {
			case '^datetime' : $rf[] = "'" . $this->now . "'"; 
		                      break;
							  
			case '^i'        : $rf[] = $intI ? $this->i : "'" . $this->i . "'"; 
		                      break;
							  
			case '^stamp'    : $stamp = time() - $this->i; //dec by 1 to be unique as index
		                      $rf[] = $intI ? $stamp : "'" . $stamp . "'"; 
		                      break;							  
							  
			default          : if (is_numeric($field))
		                        $rf[] = $field;
							  elseif ($field)
                                $rf[] = "'" . $field . "'";							  
							  else
                                $rf[] = null;							  
			}
		}
		$ret = implode(',',$rf);

		return $ret;	  
	}	
	
	protected function jsDialog($text=null, $title=null, $time=null, $source=null) {
	   $stay = $time ? $time : 3000;//2000;

       if (defined('JSDIALOGSTREAMSRV_DPC')) {
			$sd = new jsdialogStreamSrv();
			//$ret= $sd->streamDialog();
			
			if ($text)	
				$code = $sd->say($text, $title, $source, $stay);
			else
				$code = $sd->streamDialog('jsdtime');
		   
			$js = new jscript;	
			$js->load_js($code,null,1);		
			unset ($js);
	   }	
	}

	public function streamDialog() {
		
		return _m('rcpmenu.streamDialog');
	}	

	//say a message 
	protected function _echo($message=null, $type='TYPE_IRON') {
		if (!$message) return false;
		
		$this->messages[] = $message;
		
		if ($this->indac7==true) 
			$this->dacEnv->_say($message, $type);				
		
		return true;
	}	
  	
};
}
?>