<?php
$__DPCSEC['RCPHARAPP_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ( (!defined("RCPHARAPP_DPC")) && (seclevel('RCPHARAPP_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCPHARAPP_DPC",true);

$__DPC['RCPHARAPP_DPC'] = 'rcpharapp';

$__EVENTS['RCPHARAPP_DPC'][0]='cppharapp';
$__EVENTS['RCPHARAPP_DPC'][1]='cpsavephar';

$__ACTIONS['RCPHARAPP_DPC'][0]='cppharapp';
$__ACTIONS['RCPHARAPP_DPC'][1]='cpsavephar';

$__LOCALE['RCPHARAPP_DPC'][0]='RCPHARAPP_DPC;Phar App;Phar App';
$__LOCALE['RCPHARAPP_DPC'][1]='_pharapp;Create phar;Create phar';
$__LOCALE['RCPHARAPP_DPC'][2]='_usecp;cp phar;cp phar';
$__LOCALE['RCPHARAPP_DPC'][3]='_date;Date sent;Ημ. αποστολής';
$__LOCALE['RCPHARAPP_DPC'][4]='_unsubscribe;Unsubscribe;Διαγραφή απο την λίστα';
$__LOCALE['RCPHARAPP_DPC'][5]='_here;here;εδώ';
$__LOCALE['RCPHARAPP_DPC'][6]='_docid;Document;Έγγραφο';
$__LOCALE['RCPHARAPP_DPC'][7]='_docactivity;Document created;Δημιουργία εγγράφου';
$__LOCALE['RCPHARAPP_DPC'][8]='_msgsuccess;Mail sent;Το μήνυμα στάλθηκε επιτυχώς';
$__LOCALE['RCPHARAPP_DPC'][9]='_msgerror;Sent error;Το μήνυμα απέτυχε να σταλθεί';
$__LOCALE['RCPHARAPP_DPC'][10]='_recomments;Recomentations;Προτεινόμενα';
$__LOCALE['RCPHARAPP_DPC'][11]='_recommentson;Set recommendation;Χαρακτηρισμός ως προτεινόμενα';
$__LOCALE['RCPHARAPP_DPC'][12]='_recommentsoff;Remove recommendations;Αφαιρεση ιδιότητας προτεινόμενων';
$__LOCALE['RCPHARAPP_DPC'][13]='_slug;Slug on;Ενεργοποίηση Slug';
$__LOCALE['RCPHARAPP_DPC'][14]='_sluggreeklish;Greeklish translations;Greeklish μετάφραση';
$__LOCALE['RCPHARAPP_DPC'][15]='_options;Options;Ρυθμίσεις';
$__LOCALE['RCPHARAPP_DPC'][16]='_enable;Set active;Ενεργοποίηση';
$__LOCALE['RCPHARAPP_DPC'][17]='_lrp;Long Running Process;Long Running Process';
$__LOCALE['RCPHARAPP_DPC'][18]='_tail;Tail;Tail';

class rcpharapp {
	
	var $title, $prpath, $urlpath, $url, $messages;
	var $dac7;
		
    public function __construct() {
		global $stream, $dp, $dac;
	    //echo $stream, $dp;
		
		$this->prpath = paramload('SHELL','prpath');
		$this->urlpath = paramload('SHELL','urlpath');	
		$this->url = paramload('SHELL','urlbase');
		$this->title = localize('RCPHARAPP_DPC',getlocal());	
		
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
			
			case 'cpsavephar'     :  $this->submit();
			                          break;				 
														
			case 'cppharapp'      :
			default               :	
        }			
			
    }	

    public function action($action=null)  { 	

        $login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
	    if ($login!='yes') return null;
		
	    switch ($action) {										  									 
			
			case 'cpsavephar'          :
			case 'cppharapp'           : 
		    default                    : 
		}		
		
        return ($out);
	}
	
	protected function submit() {
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$id = $cpGet['id'];  	

		if ($this->dac7==true) {

			if (_m('cmsrt.savePostCookie')) {	
				
				//execute long running processs	
				if (GetParam('usecp'))
					$cmd = 'async/pphar/makecp/';
				else
					$cmd = 'async/pphar/makefp/';
				
				phpdac7\getT($cmd); //exec cmd and close tier
				
				$this->jsDialog('Start', localize('_lrp', getlocal()), 3000, 'cdact.php?t=texit');
				$this->messages[] = 'LRP started!';	
			}
			else
				$this->messages[] = 'LRP failed!';	
		}
		else {
			if (GetParam('usecp')) {	
				//echo $cat . '-' . $id;	
				$this->messages[] = $this->makePhar(true);
			}
			else
				$this->messages[] = $this->makePhar();
			
			return true;	
		}
		return false;	
	}	

	protected function makePhar() {
		$db = GetGlobal('db'); 
		$cpGet = _v('rcpmenu.cpGet');
		$cat = $cpGet['cat'];
		$csep = _m('cmsrt.sep');
		$fcode = _v('cmsrt.fcode');
		
		return "Not supported in NON LRP mode!";
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