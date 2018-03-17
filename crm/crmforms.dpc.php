<?php
$__DPCSEC['CRMFORMS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CRMFORMS_DPC")) && (seclevel('CRMFORMS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CRMFORMS_DPC",true);

$__DPC['CRMFORMS_DPC'] = 'crmforms';

$b = GetGlobal('controller')->require_dpc('crm/crmmodule.dpc.php');
require_once($b);

$__LOCALE['CRMFORMS_DPC'][0]='CRMFORMS_DPC;Forms;Φόρμες';
$__LOCALE['CRMFORMS_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['CRMFORMS_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['CRMFORMS_DPC'][3]='_status;Status;Κατάσταση';
$__LOCALE['CRMFORMS_DPC'][4]='_descr;Description;Περιγραφή';
$__LOCALE['CRMFORMS_DPC'][5]='_cat;Category;Κατηγορία';
$__LOCALE['CRMFORMS_DPC'][6]='_class;Class;Κλάση';
$__LOCALE['CRMFORMS_DPC'][7]='_code;Code;Κωδικός';
$__LOCALE['CRMFORMS_DPC'][8]='_title;Title;Τίτλος';
$__LOCALE['CRMFORMS_DPC'][9]='_profile;Profile;Στοιχεία';
$__LOCALE['CRMFORMS_DPC'][10]='_udashboard;Dashboard;Σύνοψη';


class crmforms extends crmmodule  {
	
	var $appname, $urkRedir, $isHostedApp; 
		
	function __construct() {
	
		crmmodule::__construct();
	  
		$this->appname = paramload('ID','instancename');
		$this->urlRedir = remote_paramload('RCBULKMAIL','urlredir', $this->path);
		$this->isHostedApp = remote_paramload('RCBULKMAIL','hostedapp', $this->path);		
	}

	public function forms_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {
	    $selected = urldecode(GetReq('id'));
		
	    $height = $height ? $height : 800;
        $rows = $rows ? $rows : 36;
        $width = $width ? $width : null; //wide	
		$mode = $mode ? $mode : 'd';
		$noctrl = $noctrl ? 0 : 1;	
	    $lan = getlocal() ? getlocal() : 0;  
		$title = localize('CRMFORMS_DPC',getlocal()); 
	
	    if (defined('MYGRID_DPC')) {
		
			$xSQL2 = "SELECT * from (select id,active,date,title,descr,code,class,type from crmforms where class='$selected') o ";		   
		   							
			_m("mygrid.column use grid1+id|".localize('id',getlocal())."|2|1|");			
			_m("mygrid.column use grid1+active|".localize('_active',getlocal())."|boolean|1|");		
			_m("mygrid.column use grid1+date|".localize('_date',getlocal())."|link|5|"."javascript:showdetails(\"{id}\");".'||');		
			_m("mygrid.column use grid1+code|".localize('_code',getlocal())."|5|1|");		
			_m("mygrid.column use grid1+title|".localize('_title',getlocal())."|10|1|");
			_m("mygrid.column use grid1+descr|".localize('_descr',getlocal())."|19|1|");
			_m("mygrid.column use grid1+class|".localize('_class',getlocal())."|5|1|");
			_m("mygrid.column use grid1+type|".localize('_type',getlocal())."|5|1|");

			$ret .= _m("mygrid.grid use grid1+cform+$xSQL2+$mode+$title+id+$noctrl+1+$rows+$height+$width+1+1+1");

	    }
		else 
		   $ret .= 'Initialize jqgrid.';
        
        return ($ret);
  	
	}	
		
	public function showdetails($data=null) {
		
		//return ("details:" . $data);
		
	    $bodyurl = 'cpcrmforms.php?t=cpcrmformsubdetail&iframe=1&module=formhtml&id='.$data; 
		$frame = "<iframe src =\"$bodyurl\" width=\"100%\" height=\"350px\"><p>Your browser does not support iframes</p></iframe>";      

		return ($frame);		
	}	
	
	/*
	*  runtime methods to use as dropdown creator and form submiter
	*  for cp environment
	*/
	
			//$data = $this->renderForm($template, _m("rccollections.get_collected_items")); 
			
			//with visitor (price selection)
			/*if (defined('RCCOLLECTIONS_DPC')) 
				$this->items = _m("rccollections.get_collected_items use ". $this->visitor);
			$data = $this->renderForm($template, $this->items); 
			*/
			//with visitor and preset (collection must have at least one item in this phase)
			//$data = $this->renderForm($template, _m("rccollections.get_collected_items use ". $this->visitor . '+test50')); 
			//with visitor and source preset (collection must have at least one item in this phase)
			//$data = $this->renderForm($template, _m("rccollections.get_collected_items use ". $this->visitor . '+4,5,6,7+1'));		
	
	protected function renderPattern($template, $form=null, $code=null, $items=null, $test=false) {
		$db = GetGlobal('db');	
		if (!$template) return false;
		
		if (strstr($code, '>|')) {
		//if ($code)  {
			$pf = explode('>|',$code);
			
			//search last edited line
			foreach ($pf as $line) {
				if (trim($line)) {
					$joins = explode(',', array_pop($pf)); 
					break;
				}
			}
			
			//rest lines
			foreach ($pf as $line) 
				$subtemplates .= trim($line);

			$_pattern[0] = explode(',', $subtemplates);
			$_pattern[1] = (array) $joins;
			
			//make pseudo-items arrray
			if ((!$items) && ($test)) { 
				$maxitm = count($_pattern[0]);
				for($i=1;$i<=$maxitm;$i++)
					$items[] = array(0=>$i, 1=>'test item title'.$i, 2=>'test decr'.$i, 14=>'http://placehold.it/680x300');			
		    }	
			//render pattern
			if ((!empty($items)) && (is_array($_pattern))) {
				$pattern = (array) $_pattern[0];
				$join = (array) $_pattern[1];				

				//render
				$out = null;
				$tts = array();
				$gr = array();
				$itms = array();
				$cc = array_chunk($items, count($pattern));//, true);

				foreach ($cc as $i=>$group) {
					foreach ($group as $j=>$child) {
						//echo $pattern[$j] . '<br>';
						$tts[] = $this->ct($pattern[$j], $child, true);
						if ($cmd = trim($join[$j])) {
							//echo $join[$j] . '<br>';
							switch ($cmd) {
							    case '_break' : $out .= implode('', $tts); break;
								default       : $out .= $this->ct($cmd, $tts, true);		
							} 
							unset($tts);
						}
					}
					$gr[] = (empty($tts)) ? $out : $out . implode('', $tts) ;
					unset($tts);
					$out = null;
				}
			}//has pattern data
		}//has pattern
		
		$sSQL = "select formdata from crmforms where title=" . $db->qstr($template.'-sub');
		$res = $db->Execute($sSQL);
		//echo $sSQL;	
		if (isset($res->fields['formdata'])) {			
			$itms[] = (!empty($gr)) ? implode('',$gr) : null; 
			if (!empty($itms))			
				$ret = $this->combine_tokens(base64_decode($res->fields['formdata']), $itms, true);
		}	
		else
			$ret = (!empty($gr)) ? implode('',$gr) : null;
		
		//echo $template.'-sub:' . $ret;				
		$data = ($ret) ? str_replace('<!--?'.$template.'-sub'.'?-->', $ret, $form) : $form;
		
		return $data;		
	}
	
	protected function getcsvItems($items=null) {
		if (!is_array($items)) return false;
		
		//csv array of fields
		foreach ($items as $i=>$rec)
			$ritems[] = implode(';', $rec);
			
		return $ritems; 	
	}	

	protected function renderTwing($doctitle=null, $template, $form=null, $code=null, $items=null) {
		$db = GetGlobal('db');	
		if (!$template) return false;	
		$docdescr = $doctitle ? $doctitle : 'Document'; 	
		
		if (defined('TWIGENGINE_DPC')) {
				
			//save db form into temp file
			$tmpl_path = remote_paramload('FRONTHTMLPAGE','path',$this->prpath);
			$tmpl_name = remote_paramload('FRONTHTMLPAGE','template',$this->prpath);
			$twigpath = $this->prpath . $tmpl_path .'/'. $tmpl_name .'/';	
			$tempfile = 'crmform-cache-' . urlencode(base64_encode($template)) . '.html';
				
			if (@file_put_contents($twigpath . $tempfile, $form)) {
				
				//csvitems var
				$this->csvitems = $this->getcsvItems($items);

				$t = array('invoice'=>$docdescr,
							'mynotes'=>'notes 123',
							'mydate'=>date('m.d.y'));
							
				$tokens = serialize($t);
				$ret = _m('twigengine.render use '.$tempfile.'++'.$tokens);
			}
			else
				$ret = 'twig cache error!';
		}
		else 
			$ret = $form;		
		
		return ($ret);
	}		
	
	public function renderForm($title=null, $items=null, $test=false) {
		$db = GetGlobal('db');		
		if (!$title) return null;	
		$sSQL = "select id,title,descr,formdata,codedata from crmforms where title=" . $db->qstr($title);
		//echo $sSQL;
		$res = $db->Execute($sSQL);			
		$form = base64_decode($res->fields['formdata']);		
		$code = base64_decode($res->fields['codedata']);
		$template = $res->fields['title'];
		$docdescr = $res->fields['descr'];
		
		if (strstr($code, '>|')) { //pattern code
			$ret = $this->renderPattern($template, $form, $code, $items, $test);
		}
		else 
		    $ret = $this->renderTwing($docdescr, $template, $form, $code, $items);	
	
		return ($ret);
		
	}	
	
	
	public function formsMenu($user, $class=null, $type=null, $style=null) {
		if ((!$user) || (!$class)) return null;
		
		//if ($this->isdemoUser())  //handled by caller
			//return ($user); //not menu for not allowd users
		
		$db = GetGlobal('db');
		$lan = getlocal();
		
		$sSQL = "select id,title,descr from crmforms where active=1 and type='1' and (class='$user' OR class=" . $db->qstr($class) .")";
		if ($type)
			$sSQL.= " and type=" . $db->qstr($type);
		//echo $sSQL;
		$res = $db->Execute($sSQL);
		
		foreach ($res as $i=>$rec) {
			$_title = localize($rec['title'], $lan);
			$dropdown[$_title] = 'cpcrmoffers.php'.'?v='.$user.'&stemplate='.$rec['title'];
		}
		
		$dropdown[0]=''; //divider
		$dropdown[localize('_udashboard',getlocal())]='cpcrm.php?t=crmtree&id='.$user;
		$dropdown[localize('_profile',getlocal())]='cpcrmtrace.php?t=cpcrmprofile&v='.$user;
		
		$menu = $this->createButton($user, $dropdown, $style);
		
		return ($menu);		
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


	public function encUrl($url, $nohost=false) {
		if ($url) {
			
			if (($this->isHostedApp)&&($nohost==false)) {
				$burl = explode('/', $url);
				array_shift($burl); //shift http
				array_shift($burl); //shift //
				array_shift($burl); //www //
				$xurl = implode('/',$burl);
				$qry = 't=mt&a='.$this->appname.'_AMP_u=' . $xurl . '_AMP_cid=_CID_' . '_AMP_r=_TRACK_'; //CKEditor &amp; issue				
			}
			else {
				//$xurl = $url; //as is
				$qry = 't=mt&u=' . $url . '_AMP_cid=_CID_' . '_AMP_r=_TRACK_'; //CKEditor &amp; issue				
			}	
			
			$uredir = $this->urlRedir .'?'. $qry; //'?turl=' . $encoded_qry;
			return ($uredir); 
		}
		else
			return ('#');
	}	
};
}
?>