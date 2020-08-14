<?php

$__DPCSEC['RCEDITABLES_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCEDITABLES_DPC")) && (seclevel('RCEDITABLES_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCEDITABLES_DPC",true);

$__DPC['RCEDITABLES_DPC'] = 'rceditables';

//loaded at rcpmenu
//require_once(_r('jsdialog/jsdialogstream.dpc.php'));

$__EVENTS['RCEDITABLES_DPC'][0]='cpeditables';
$__EVENTS['RCEDITABLES_DPC'][1]='cpediexec';
$__EVENTS['RCEDITABLES_DPC'][2]='cpedilog';
$__EVENTS['RCEDITABLES_DPC'][3]='cpeditrunc';

$__ACTIONS['RCEDITABLES_DPC'][0]='cpeditables';
$__ACTIONS['RCEDITABLES_DPC'][1]='cpediexec';
$__ACTIONS['RCEDITABLES_DPC'][2]='cpedilog';
$__ACTIONS['RCEDITABLES_DPC'][3]='cpeditrunc';

$__DPCATTR['RCEDITABLES_DPC']['cpeditables'] = 'cpeditables,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCEDITABLES_DPC'][0]='RCEDITABLES_DPC;EDI tables;Πίνακες EDI';
$__LOCALE['RCEDITABLES_DPC'][1]='_edi;EDI;EDI';
$__LOCALE['RCEDITABLES_DPC'][2]='_etl;ETL;ETL';
$__LOCALE['RCEDITABLES_DPC'][3]='_makecsv;Make items csv;Δημιουργία csv ειδών';
$__LOCALE['RCEDITABLES_DPC'][4]='_makesql;Make items descr sql;Δημιουργία sql περιγραφών';
$__LOCALE['RCEDITABLES_DPC'][5]='_makeimg;Sync img;Ενημέρωση εικόνων';
$__LOCALE['RCEDITABLES_DPC'][6]='_filter;Filter;Φίλτρο';
$__LOCALE['RCEDITABLES_DPC'][7]='_out;Exports;Εξαγωγές';
$__LOCALE['RCEDITABLES_DPC'][8]='_log;Log;Log';
$__LOCALE['RCEDITABLES_DPC'][9]='_truncate;Erase EDI data;Διαγραφή EDI';
$__LOCALE['RCEDITABLES_DPC'][10]='xml;Exports XML;Εξαγωγές XML';
$__LOCALE['RCEDITABLES_DPC'][11]='csv;Exports CSV;Εξαγωγές CSV';
$__LOCALE['RCEDITABLES_DPC'][12]='sql;Exports SQL;Εξαγωγές SQL';
$__LOCALE['RCEDITABLES_DPC'][13]='log;Exports LOG;Εξαγωγές LOG';

class rceditables  {

	var $title, $prpath, $urlpath, $url;
	var $ediT, $etlproducts;
	var $etlT, $etlCMD, $etlCNF, $etlOWN, $etlLOG, $etlPath;
	var $messages;

	public function __construct() {
		
		$this->prpath = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');	
		$this->url = paramload('SHELL','urlbase');
		$this->title = localize('RCEDIITEMS_DPC',getlocal());			
		
		//EDI CONF
		$this->etlproducts = array('id','datein','code3','code5','owner','itmactive','active','itmname','uniname1','ypoloipo1','price0','price1','manufacturer','size','color','cat0','cat1','cat2','cat3','cat4');	
		$this->difproducts = array('id','datein','code3','code5','owner','itmactive','active','itmname','uniname1','ypoloipo1','price0','price1','manufacturer','size','color','cat0','cat1','cat2','cat3','cat4');	
		$this->ediT = array('etlproducts'=>$this->etlproducts,
							'difproducts'=>$this->difproducts,
							/*'editest'=>array('a','b'),*/
							 );	
		//ETL CONF
		$this->etlCNF = array('kaisidis', 'aidonitsa', 'logicom', 'agc', 'tradesor');	
		$this->etlOWN = array('kaisidis'=>'data-media', 'aidonitsa'=>'aidonitsa', 'logicom'=>'logicom', 'agc'=>'agc', 'tradesor'=>'tradesor'); //owner title		
		$this->etlCMD = array('_makecsv'=>'async/xml/[confname]/xmlfilter01/xmlfilter02/csvnode/|async/csv/[confname]/csvread/',
							  '_makesql'=>'async/xml/[confname]/xmlfilter01/xmlfilter02/sqlnodepattach/|async/sql/[confname]/sqlread/',	
							  '_makeimg'=>'async/xml/[confname]/xmlfilter01/xmlfilter02/imgnode/|async/img/[confname]/imgread/',
							  //'_makeimg'=>'async/xml/[confname]/xmlfilter01/xmlfilter02/imgnode/|async/img/[confname]/imgread/',
							  //'_makeimg'=>'async/xml/[confname]/xmlfilter01/xmlfilter02/imgnode/|async/img/[confname]/imgread/',
							);
		$this->difCMD = array('_dbo1'=>'async/dbo/_products/dbofilter01/dbofilter02/imgnode/|async/img/_products/imgread/',
							  '_bit77'=>'async/pcntl/bit77/imgnode/|async/dbo/_products/dbofilter01/dbofilter02/imgnode/|async/img/_products/imgread/',	
							  '_kshow'=>'async/pcntl/kshow/imgnode/p5node/|async/img/_products/imgread/',	
							  '_klist'=>'async/pcntl/klist/imgnode/p5node/|async/img/_products/imgread/',	
							  '_pcmd'=>'async/pcmd/env1/envnode/',
							  '_devenv'=>'async/pcmd/devenv/envnode/|async/img/_products/imgread/',			
							  '_ampcache'=>'async/pcntl/ampcache/imgnode/',
							);						
		$this->etlT = array('etlproducts'=>$this->etlCMD,
							'difproducts'=>$this->difCMD,
							);						
		
		//LOG CONF
		$this->etlPath = $this->prpath . 'uploads/';
		$this->etlLOG = array('kaisidis'=>array('xml'=>'datamedia-out.xml','csv'=>'datamedia-out.csv','sql'=>'datamedia-out.sql','log'=>'datamedia-out.log'),
							  'aidonitsa'=>array('xml'=>'aidonitsa-out.xml','csv'=>'aidonitsa-out.csv','sql'=>'aidonitsa-out.sql','log'=>'aidonitsa-out.log'),	
							  'logicom'=>array('xml'=>'logicom-out.xml','csv'=>'logicom-out.csv','sql'=>'logicom-out.sql','log'=>'logicom-out.log'),
							  'agc'=>array('xml'=>'agc-out.xml','csv'=>'agc-out.csv','sql'=>'agc-out.sql','log'=>'agc-out.log'),
							  'tradesor'=>array('xml'=>'tradesor-out.xml','csv'=>'tradesor-out.csv','sql'=>'tradesor-out.sql','log'=>'tradesor-out.log'),
						);
		/*				
		$this->etlLOG2 = array('etlproducts'=>array('xml'=>'etlproducts.xml','csv'=>'etlproducts.csv','log'=>'etlproducts.log'),
						);*/				
		
		$this->messages = array(); 
	}

    public function event($event=null) {

		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;

		switch ($event) {
			
			case 'cpedilog'         : $this->readLOG(); 
									  break;

			case 'cpediexec'        : if ($cmd = GetReq('cmd')) {
				
										phpdac7\getT($cmd); //exec cmd and close tier
										$this->jsDialog('Start', localize('_edi', getlocal()), 3000, 'cdact.php?t=texit');

										$_cmd = explode('|', $cmd);
										foreach ($_cmd as $i=>$c)
											$this->messages[] = "Cmd $i: " . $c;
										$this->messages[] = 'EDI started!';	
									  }	
									  else {
										$this->jsDialog('ETL command missing', localize('_edi', getlocal()) . ' failed');  
										$this->messages[] = 'EDI failed!';
										$this->messages[] = 'ETL command missing!';
									  }	
									  break;

			case 'cpeditrunc'       : if ($edi = GetReq('editable')) {
				
										$this->truncateEDI($edi, GetReq('owner'));
										$this->messages[] = "EDI data ($edi) truncated!";		
									  }
									  else
										$this->messages[] = 'Missing EDI table name';
									  break;	

			case 'cpeditables'      :
			default                 :  //phpdac7\getT('texit'); //close tier before exe a cmd                  
		}
    }

    public function action($action=null) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	

		switch ($action) {
			
			case 'cpedilog'         : 			
			case 'cpediexec'        : $out .= $this->selectEDI(true);
									  $out .= "<hr/>";			
									  $out .= $this->selectLOG();
									  $out .= $this->messageBlock();
									  break;			
			
			case 'cpeditrunc'    	:
			case 'cpeditables'    	:
			default             	: $out .= $this->selectEDI();
									  $out .= "<hr/>"; //"<div id='cmsvars'></div>";	
									  $out .= $this->tablesEDI();
		}

		return ($out);
    }
	
	protected function tablesEDI() {
		
		if (GetReq('edi')) {
			
			$editvars = _m("cmsrt.isLevelUser use 8") ? 'd' : 'r';
			$out = $this->showfilter();
			$out.= $this->show_table(null,null,null, $editvars, true);
		}
		else {
			$out = $this->selectLOG();
			$out .= $this->messageBlock();
		}	
		
		return ($out);
	}
	
	protected function truncateEDI($editable=null, $dataowner=null) {
		$db = GetGlobal('db'); 
		if (!$editable) return false;
		
		$sSQL = "delete from " . $editable;
		if ($dataowner)
			$sSQL .= " where owner = " . $db->qstr($dataowner);
		
		//$this->messages[] = $sSQL;
		
		$ret = $db->Execute($sSQL);
		return $ret;
	}	

	protected function selectEDI($noETL=false) {
		if (empty($this->ediT)) return null;		
		$lan = getlocal();
		$menu = array();
		$menuTrunc = array();		
		
		//EDI select table
		foreach ($this->ediT as $title => $f) { 
			$menu[$title] = 'cpeditables.php?edi='. $title;
			$menuTrunc[$title] = 'cpeditables.php?t=cpeditrunc&editable='. $title;
		}	
		
		if ($table = GetReq('edi')) { 
			//sep
			$menu[0] = '';
			//EDI data export home
			$menu[localize('_out', $lan)] = "cpeditables.php";
		
			$EDIselectButton = $this->createButton(localize('RCEDITABLES_DPC', $lan), $menu); 
		
			if ($noETL==false)
				$EDIselectButton .= $this->selectETL();
		}
		else {
			$EDIselectButton = $this->createButton(localize('RCEDITABLES_DPC', $lan), $menu); 
						
			//ETL truncate table command
			$EDItruncButton = $this->createButton(localize('_truncate', $lan), $menuTrunc, 'warning');
			$EDIselectButton .= $EDItruncButton;
			
			//ETL (etlproducts conf) log files
			//$EDIselectButton .= $this->selectLOGETL();
		}	
													
		return ($EDIselectButton);											
	}
	
	protected function selectETL() {
		if (!$table = GetReq('edi')) return null;
		$lan = getlocal();
		$ETLselectButton = null;
		
		//fetch cp params
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$id = $cpGet['id'];  	
		$csep = _m('cmsrt.sep');
		
		if (!empty($this->etlCNF)) {
			
			foreach ($this->etlCNF as $i=>$cnf) {
				
				$menu = array(); //reset
				//foreach ($this->etlCMD as $title=>$cmd) 
				if (!empty($this->etlT[$table])) {
					foreach ($this->etlT[$table] as $title=>$cmd) 
					{
						$_title = localize($title, $lan);
						
						//save params for dac-7 cmd
						$reqparams = "&cat=" . $cat . "&id=" . $id;
						file_put_contents($this->prpath . '/_cookie.txt', $reqparams, LOCK_EX);
						
						$menu[$_title] = "cpeditables.php?t=cpediexec&edi=$table&cmd=". str_replace('[confname]', $cnf, $cmd);
					}
					//test menu item
					//$menu['Test'] = "cpeditables.php?t=cpediexec&edi=$table&cmd=hello/howru";
				}
				//sep
				$menu[0] = '';
				
				$dataowner = $this->etlOWN[$cnf];
				$menu[localize('_truncate', $lan)] = "cpeditables.php?t=cpeditrunc&editable=$table&owner=$dataowner";
				
				$btitle = localize('_etl', $lan) .' '. ucfirst($cnf);	
				$ETLselectButton .= $this->createButton($btitle, $menu, 'danger');	
			}	
			
		}		  
				  
		return $ETLselectButton;		
	}
	
	//log export files
	protected function selectLOG() {
		//if (!$table = GetReq('edi')) return null;
		$table = GetReq('edi');
		$lan = getlocal();
		$LOGselectButton = null;
		
		if (!empty($this->etlLOG)) {
			
			foreach ($this->etlLOG as $cnf=>$logfiles) { 
				$menu = array();
				foreach ($logfiles as $title=>$log) {
				
					$_title = localize($title, $lan);
					$menu[$_title] = "cpeditables.php?t=cpedilog&edi=$table&log=". $log;
				}	
				$btitle = localize('_out', $lan) .' '. ucfirst($cnf);	
				$LOGselectButton .= $this->createButton($btitle, $menu, 'info');				
			}
		}		  
				  
		return $LOGselectButton;		
	}
	/*
	//etlproducts named export files
	protected function selectLOGETL() {
		//if (!$table = GetReq('edi')) return null;
		$table = GetReq('edi');
		$lan = getlocal();
		$LOGselectButton = null;
		
		if (!empty($this->etlLOG2)) {
			
			foreach ($this->etlLOG2 as $cnf=>$logfiles) { 
				$menu = array();
				foreach ($logfiles as $title=>$log) {
				
					$_title = localize($title, $lan);
					$menu[$_title] = "cpeditables.php?t=cpedilog&edi=$table&log=". $log;
				}	
				$btitle = localize('_out', $lan) .' '. ucfirst($cnf);	
				$LOGselectButton .= $this->createButton($btitle, $menu, 'info');				
			}
		}		  
				  
		return $LOGselectButton;		
	}	
	*/
	protected function readLOG() {
		$log = GetReq('log');
		
		if (is_readable($this->etlPath . $log)) {
		
			$this->messages = file($this->etlPath . $log);	
			return true;
		}
		return false;
	}	
	
	protected function showfilter() {
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
		
		return "<h3>$title</h3>"; 
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

	protected function show_table($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
		if (!$table = GetReq('edi')) return null;
		
	    $height = $height ? $height : 600;
        $rows = $rows ? $rows : 25;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'r';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = ucfirst($table); //str_replace(' ', '_', localize('RCEDITABLES_DPC',getlocal()));		

	    if (defined('MYGRID_DPC')) {

			//if (array_key_exists($table, $this->ediT)) {
			if (is_array($this->ediT[$table])) {
				
				$fields = implode(',', $this->ediT[$table]);
				
				$_wf = $this->whereFilter();
				$sSQL = "select * from (";
				$sSQL.= "SELECT " . $fields . " from " . $table . $_wf;
				$sSQL .= ') as o'; 
			
				foreach ($this->ediT[$table] as $i=>$f)
					_m("mygrid.column use grid1+$f|". localize($f, $lan)."|link|5|cpeditables.php?edi=$table&flt=$f&val=\{$f}\\");//"|5|0|");	
				
				$out = _m("mygrid.grid use grid1+$table+$sSQL+$mode+$title+id+$noctrl+1+$rows+$height+$width+0+1+1+1");
			}
			else
				$out = 'Unknown ' . $table;
	    }
		else 
		   $out = 'Initialize jqgrid.';
		   
        return ($out); 
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

	protected function messageBlock() {
		$log = GetReq('log');
		$logTitle = GetReq('log') ? '('. $log .')' : null;
		$messages = $this->viewMessages(); 
		$importButton = isset($messages) ? 
						"<a href='cpediimport.php?imp=$log'>Import</a>" : null;
		
		return "
		<h3>Messages $logTitle</h3>
			<div class=\"control-group\">
				<!--label class=\"control-label\">Messages</label-->
				<div class=\"controls\">
					<select id=\"messages\" multiple=\"multiple\" style=\"height:300px;width:100%;\">
						$messages
					</select>
				</div>
				<ul class=\"pager wizard\">
					<li class=\"next\">$importButton</li>
                </ul>
			</div>
		";
	}	
	
	//replace on page call
	public function streamDialog() {
		
		/*if ($cmd = GetReq('çmd')) {
			
			$sd = new jsdialogStreamSrv();
			$ret = $sd->say($cmd, 'EDIS', 'cdact.php?t=texit', 5000);
		
			return ($ret);
		}
		else*/
			return _m('rcpmenu.streamDialog');
	}	

};
}
?>