<?php
$__DPCSEC['RCAMPCACHE_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ( (!defined("RCAMPCACHE_DPC")) && (seclevel('RCAMPCACHE_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCAMPCACHE_DPC",true);

$__DPC['RCAMPCACHE_DPC'] = 'rcampcache';

$__EVENTS['RCAMPCACHE_DPC'][0]='cpampcache';
$__EVENTS['RCAMPCACHE_DPC'][1]='cpsaveamp';

$__ACTIONS['RCAMPCACHE_DPC'][0]='cpampcache';
$__ACTIONS['RCAMPCACHE_DPC'][1]='cpsaveamp';

$__LOCALE['RCAMPCACHE_DPC'][0]='RCAMPCACHE_DPC;Amp Cache App;Amp Cache App';
$__LOCALE['RCAMPCACHE_DPC'][1]='_ampcache;Amp Cache App;Amp Cache App';
$__LOCALE['RCAMPCACHE_DPC'][2]='_ampitems;AMP for items;AMP for Items';
$__LOCALE['RCAMPCACHE_DPC'][3]='_ampkatalog;AMP for Categories;AMP for Categories';
$__LOCALE['RCAMPCACHE_DPC'][4]='_unsubscribe;Unsubscribe;Διαγραφή απο την λίστα';
$__LOCALE['RCAMPCACHE_DPC'][5]='_msgsuccess;Mail sent;Το μήνυμα στάλθηκε επιτυχώς';
$__LOCALE['RCAMPCACHE_DPC'][6]='_msgerror;Sent error;Το μήνυμα απέτυχε να σταλθεί';
$__LOCALE['RCAMPCACHE_DPC'][7]='_slug;Slug on;Ενεργοποίηση Slug';
$__LOCALE['RCAMPCACHE_DPC'][8]='_sluggreeklish;Greeklish translations;Greeklish μετάφραση';
$__LOCALE['RCAMPCACHE_DPC'][9]='_options;Options;Ρυθμίσεις';
$__LOCALE['RCAMPCACHE_DPC'][10]='_enable;Set active;Ενεργοποίηση';
$__LOCALE['RCAMPCACHE_DPC'][11]='_lrp;Long Running Process;Long Running Process';
$__LOCALE['RCAMPCACHE_DPC'][12]='_tail;Tail;Tail';
$__LOCALE['RCAMPCACHE_DPC'][13]='_ampinsert;Insert into Amp cache;Εισαγωγή νεων αντικειμένων στην Amp Cache';
$__LOCALE['RCAMPCACHE_DPC'][14]='_ampupdate;Update Amp cache;Μεταβολή αντικειμένων στην Amp Cache';
$__LOCALE['RCAMPCACHE_DPC'][15]='_ampdelete;Deactivate inactive items from Amp cache;Aπενεργοποίηση μη ενεργών αντικειμένων απο Amp Cache';
$__LOCALE['RCAMPCACHE_DPC'][16]='_ampcacheset;Create Amp pages;Κατασκευή Amp σελίδων';
$__LOCALE['RCAMPCACHE_DPC'][17]='_ampitemins;Insert;Εισαγωγή';
$__LOCALE['RCAMPCACHE_DPC'][18]='_ampitemupd;Update;Μεταβολή';
$__LOCALE['RCAMPCACHE_DPC'][19]='_ampitemdel;Deactivate;Απενεργοποίηση';
$__LOCALE['RCAMPCACHE_DPC'][20]='_ampdeleteperm;Delete inactive items from Amp cache;Διαγραφή μη ενεργών αντικειμένων απο Amp Cache';
$__LOCALE['RCAMPCACHE_DPC'][21]='_ampusediff;Use differencial table;Χρήση πίνακα διαφορών';

class rcampcache {
	
	var $title, $prpath, $urlpath, $url, $messages, $catTitles;
	var $dac7;
		
    public function __construct() {
		global $stream, $dp, $dac;
	    //echo $stream, $dp;
		
		$this->prpath = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');	
		$this->url = paramload('SHELL','urlbase');
		$this->title = localize('RCAMPCACHE_DPC',getlocal());	
		
		$this->messages = array(); 

		$this->dac7 = false;
		if ((substr($stream,-5)==$dp) && ($dac==true))
			$this->dac7 = true;
		
		//echo 'dac7:'.$this->dac7;
	}
	
    public function event($event=null) {
	
	    $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;

	    switch ($event) {
			
			case 'cpsaveamp'      :  $this->submit();
			                          break;				 
														
			case 'cpampcache'     :
			default               :	
        }			
			
    }	

    public function action($action=null)  { 	

        $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;
		
	    switch ($action) {										  									 
			
			case 'cpsaveamp'           :
			case 'cpampcache'          : 
		    default                    :  $this->catTitles = _m('rcpmenu.showCategoryTitles use +&nbsp;&gt;&nbsp;');	
		}		
		
        return ($out);
	}
	
	protected function submit() {
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$id = $cpGet['id'];  	

		if ($this->dac7==true) {

			if (_m('cmsrt.savePostCookie use &id=' . $id)) {
				
				// async/pcntl/ampcache/imgnode/
				
				//execute long running processs	
				//if ((GetParam('ampitems')) && (GetParam('ampkatalog'))) {
				if (GetParam('ampcacheset')) {	
					
					$usediff = GetParam('ampusediff');
					
					if (GetParam('ampitemins')) 
						$cmd = ($usediff) ? 'async/pcntl/ampcache_diffitems_insert/imgnode/':
											'async/pcntl/ampcache_insert/imgnode/';
					elseif (GetParam('ampitemupd'))
						$cmd = ($usediff) ? 'async/pcntl/ampcache_diffitems_update/imgnode/':
											'async/pcntl/ampcache_update/imgnode/';
					elseif (GetParam('ampitemdel')) 
						$cmd = ($usediff) ? 'async/pcntl/ampcache_diffitems_delete/imgnode/':
											'async/pcntl/ampcache_delete/imgnode/';
					else	
						$cmd = ($usediff) ? 'async/pcntl/ampcache/imgnode_diffitems/':
											'async/pcntl/ampcache/imgnode/';
					
					phpdac7\getT($cmd); //exec cmd and close tier
					//echo $cmd;
				
					$this->jsDialog('Start', localize('_lrp', getlocal()), 3000, 'cdact.php?t=texit');
					$this->messages[] = 'LRP ampcache started!';	
				}
				elseif (GetParam('ampitemdeldisabled')) {
					
						$delperm = GetParam('ampdeldisabledperm');					
					
						$cmd = 	($delperm) ? 'async/pcntl/ampcache_delete_disabled_permanent/imgnode/':
											 'async/pcntl/ampcache_delete_disabled/imgnode/';				
				}							 
				/*elseif ((GetParam('ampitems')) && (!GetParam('ampkatalog'))) {
					
					$cmd = 'async/pcntl/kshow/imgnode/p5node/|async/img/_products/imgread/';
					phpdac7\getT($cmd); //exec cmd and close tier
				
					$this->jsDialog('Start', localize('_lrp', getlocal()), 3000, 'cdact.php?t=texit');
					$this->messages[] = 'LRP kshow started!';						
				}
				elseif ((GetParam('ampkatalog')) && (!GetParam('ampitems'))) {
					
					$cmd = 'async/pcntl/klist/imgnode/p5node/|async/img/_products/imgread/';
					phpdac7\getT($cmd); //exec cmd and close tier
				
					$this->jsDialog('Start', localize('_lrp', getlocal()), 3000, 'cdact.php?t=texit');
					$this->messages[] = 'LRP klist started!';						
				}*/	
				else
					$this->messages[] = 'Please select an option before start!';	
				
			}
			else
				$this->messages[] = 'LRP failed!';	
		}
		else 
			$this->messages[] = $this->makeAmpFiles();
			
		return true;	
	}	

	protected function makeAmpFiles() {
		$db = GetGlobal('db'); 
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$csep = _m('cmsrt.sep');
		$fcode = _v('cmsrt.fcode');
		
		return "Not supported in NON LRP mode!";
	}	
	
	public function currentCategory() {
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$id = $cpGet['id'];  	
		
		return ($cat);
	}	
	
	public function showCategory() {
		
		return $this->catTitles;
	}	
	
	public function tail($_file=null, $_lines=null) {
		$file = $_file ?? $this->prpath . '/pcntlpharmake.log';
		$lines = $_lines ?? 10;
		if (!is_readable($file)) return 'none';
		
		if ($lines < 1)
			return '';

		$line = '';
		$line_count = 0;
		$prev_char = '';
		$fp = fopen($file, 'r');
		$cursor = -1;

		fseek($fp, $cursor, SEEK_END);
		$char = fgetc($fp);

		while ($char !== false) {

			if ($char === "\n" || $char === "\r")
			{
				fseek($fp, --$cursor, SEEK_END);
				$next_char = fgetc($fp);

				if ($char === "\n" && $next_char === "\r")
				{
					$line_count++;
				}
				elseif ($char === "\r" && $prev_char !== "\n")
				{
					$line_count++;
				}
				elseif ($char === "\n")
				{
					$line_count++;
				}

				fseek($fp, ++$cursor, SEEK_END);
			}

			if ($line_count == $lines)
				break;

			$line = $char.$line;
			$prev_char = $char;
			fseek($fp, --$cursor, SEEK_END);
			$char = fgetc($fp);
		}

		fclose($fp);

		return $line;
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
				$links .= '<li><a href="'.$url.'">'.$n.'</a></li>';
			$lnk = '<ul class="dropdown-menu">'.$links.'</ul>';
		} 
		
		$ret = '
			<div class="btn-group">
                <button data-toggle="dropdown" class="btn '.$size.'btn-'.$type.' dropdown-toggle">'.$name.' <span class="caret"></span></button>
                '.$lnk.'
            </div>'; 
			
		return ($ret);
	}
		
	//tokens method	
	protected function combine_tokens($template, $tokens, $execafter=null) {
	    if (!is_array($tokens)) return;		

		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
		  $fp = new fronthtmlpage(null);
		  $ret = $fp->process_commands($template);
		  unset ($fp);		  		
		}		  		
		else
		  $ret = $template;
		  
		//echo $ret;
	    foreach ($tokens as $i=>$tok) {
            //echo $tok,'<br>';
		    $ret = str_replace("$".$i."$",$tok,$ret);
	    }
		//clean unused token marks
		for ($x=$i;$x<30;$x++)
		  $ret = str_replace("$".$x."$",'',$ret);
		//echo $ret;
		
		//execute after replace tokens
		if (($execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
		  $fp = new fronthtmlpage(null);
		  $retout = $fp->process_commands($ret);
		  unset ($fp);
          
		  return ($retout);
		}		
		
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

	public function streamDialog() {
		
		return _m('rcpmenu.streamDialog');
	}	

};
}
?>