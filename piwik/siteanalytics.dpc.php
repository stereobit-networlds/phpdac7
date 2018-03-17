<?php
$__DPCSEC['SITEANALYTICS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("SITEANALYTICS_DPC")) && (seclevel('SITEANALYTICS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("SITEANALYTICS_DPC",true);

$__DPC['SITEANALYTICS_DPC'] = 'siteanalytics';

$__EVENTS['SITEANALYTICS_DPC'][0]='cpanalytics';

$__ACTIONS['SITEANALYTICS_DPC'][0]='cpanalytics';

$__LOCALE['SITEANALYTICS_DPC'][0]='SITEANALYTICS_DPC;Analytics;Analytics';
$__LOCALE['SITEANALYTICS_DPC'][1]='_date;Date;Ημερ.';
$__LOCALE['SITEANALYTICS_DPC'][2]='_time;Time;Ώρα';
$__LOCALE['SITEANALYTICS_DPC'][3]='_status;Status;Κατάσταση';
$__LOCALE['SITEANALYTICS_DPC'][4]='_user;User;Πελάτης';
$__LOCALE['SITEANALYTICS_DPC'][5]='_cid;cid;cid';

/* this token is used to authenticate your API request.
// You can get the token on the API page inside your Piwik interface
$token_auth = 'anonymous';

// we call the REST API and request the 100 first keywords for the last month for the idsite=7
$url = "http://demo.piwik.org/";
$url .= "?module=API&method=Referrers.getKeywords";
$url .= "&idSite=7&period=month&date=yesterday";
$url .= "&format=PHP&filter_limit=20";
$url .= "&token_auth=$token_auth";

$fetched = file_get_contents($url);
$content = unserialize($fetched);

// case error
if (!$content) {
    print("Error, content fetched = " . $fetched);
}

print("<h1>Keywords for the last month</h1>\n");
foreach ($content as $row) {
    $keyword = htmlspecialchars(html_entity_decode(urldecode($row['label']), ENT_QUOTES), ENT_QUOTES);
    $hits = $row['nb_visits'];

    print("<b>$keyword</b> ($hits hits)<br>\n");
}
*/

class siteanalytics   {
	
	var $prpath, $siteID, $purl, $authtoken;
	var $today;
		
	public function __construct() {
		
		$this->prpath = paramload('SHELL','prpath');
		
		$this->piwikurl = remote_paramload('PIWIK','url',$this->prpath);		
		$this->siteID = remote_paramload('PIWIK','id',$this->prpath);
	    $this->authtoken = remote_paramload('PIWIK','authtoken',$this->prpath);

		$this->today = date('Y-m-d');			
	}
	
    public function event($event) {
	
		switch ($event) {	

		    case 'cpanalytics'  :
			default       		: 
		}
	}

    public function action($action) {

		switch ($action) {	

		    case 'cpanalytics' :		
			default       	   : $out = null;
		}
		return ($out);
    }		
	
	//sub selections menu
	public function nav() {
		$ret = '<li class="active"><a href="#">Home</a></li>
<li><a href="#">Link</a></li>
<li><a href="#">Link</a></li>';

		//return ($ret);
		return null;
	}

	public function dashboard_grid($width=null, $height=null, $rows=null, $mode=null, $noctrl=false) {

        return (false);
  	
	}	
		
	public function showdetails($data=null) {

		return (false);		
	}	
	
	//analytics.stereobit.gr/index.php?module=Widgetize&action=iframe&widget=1&moduleToWidgetize=VisitTime&actionToWidgetize=getVisitInformationPerServerTime&idSite=1&period=range&date=last7&disableLink=1&widget=1
	//<div id="widgetIframe"><iframe width="100%" height="350" src="analytics.xix.gr/index.php?module=Widgetize&action=iframe&widget=1&moduleToWidgetize=VisitTime&actionToWidgetize=getByDayOfWeek&idSite=2&period=range&date=2016-12-10,2016-12-10&disableLink=1&widget=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	public function widget($name, $action=null, $period=null, $daterange=null, $height=null, $width=null, $scrollyes=false, $islink=false, $columns=null) {
		$w = $width ? $width : '100%';
		$h = $height ? $height : '350';
		if ((!$name) || (!$this->siteID) || (!$this->authtoken)) 
			return null;

		$purl = $this->piwikurl . "?module=Widgetize&action=iframe&widget=1";
		$purl.= "&moduleToWidgetize=" . $name;
		
		if ($action) 
			$purl.= "&actionToWidgetize=" . $action;	
		if ($columns)
			$purl.= "&columns[]=" . $columns;	
		
		$purl.= "&idSite=" . $this->siteID;
		
		switch ($period) {
			case 'Y'    : $pr = 'year'; break;
			case 'M'    : $pr = 'month'; break;
			case 'W'    : $pr = 'week'; break;			
			case 'D'    : $pr = 'day'; break;
			case 'R'	: $pr = 'range'; break;
			default 	: $pr = 'range';//$pr = 'day';
		}
		$purl.= "&period=" . $pr;
		
		switch ($daterange) {
			case 'P30'	: $dr = 'previous30'; break;
			case 'P7'	: $dr = 'previous7'; break;
			case 'L30'	: $dr = 'last30'; break;
			case 'L7' 	: $dr = 'last7'; break;
			case 'Y'	: $dr = 'yesterday'; break;
			case 'T'    : $dr = 'today'; break;
			default 	: $dr = $this->selectTimeRange();//'today'; //$this->today;
		}
		$purl.= "&date=" . $dr; //2016-12-10 / 2016-12-10,2016-12-10
		
		$purl.= "&disableLink=1&widget=1";
		$purl.= "&token_auth=" . $this->authtoken;
		
		if ($islink)
			return ($purl);
		
		$scroll = $scrollyes ? 'yes' : 'no';
		
		$ret = "<iframe width=\"$w\" height=\"$h\" src=\"$purl\"";
		$ret.= "scrolling=\"$scroll\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\"></iframe>";
		
		return ($ret);
	}
	
	protected function selectTimeRange() {
		
		if ($rdate = GetParam('rdate')) {
			$dr = explode('-', $rdate);
			$dr0 = explode('/', trim($dr[0]));
			$dr1 = explode('/', trim($dr[1]));
			//$range = str_replace(array('-',' ','/'), array(',','','-'), $rdate);
			$range = "{$dr0[2]}-{$dr0[0]}-{$dr0[1]},{$dr1[2]}-{$dr1[0]}-{$dr1[1]}";
		}
		elseif ($y = GetParam('year')) {
			if ($m = GetParam('month')) { 
				$mstart = $m; 
				$mend = $m;
			} 
			else { 
				$mstart = '01'; 
				$mend = '12';
				$m = '12';
			}
			$daysofmonth = cal_days_in_month(CAL_GREGORIAN, $m, $y);
			$range = "$y-$mstart-01,$y-$mend-$daysofmonth";
		}
		else {
			$mstart = date('m');; //'01'; 
			$mend = date('m');; //'12';			
			$y = date('Y');
			$daysofmonth = date('t');
			$range = "$y-$mstart-01,$y-$mend-$daysofmonth";
		}	
		
		return ($range);
	}	
	
    public function select_timeline($template, $year=null, $month=null, $subtitle=null) {
		$year = GetParam('year') ? GetParam('year') : date('Y'); 
	    $month = GetParam('month') ? GetParam('month') : date('m');
		$daterange = GetParam('rdate');
		$t = GetReq('t');
				
	    if ($tmpl = _m("cmsrt.select_template use $template+1")) {
			for ($y=(date('Y')-2); $y<=intval(date('Y')); $y++) {
				$yearsli .= '<li>'. seturl("t=$t&month=".$month.'&year='.$y, $y) .'</li>';
			}
		
			for ($m=1;$m<=12;$m++) {
				$mm = sprintf('%02d',$m);
				$monthsli .= '<li>' . seturl("t=$t&month=".$mm.'&year='.$year, $mm) .'</li>';
			}	  
	  
			$sb = $subtitle ? ' &gt; ' . $subtitle : null;
	        $posteddaterange = $daterange ? ' &gt; ' . $daterange : ($year ? ' &gt; ' . $month . '-' . $year : null) ;
	  
			$tokens[] = localize('SITEANALYTICS_DPC', getlocal()) . $sb .  $posteddaterange; 
			$tokens[] = $year;
			$tokens[] = $month;
			$tokens[] = localize('_year',getlocal());
			$tokens[] = $yearsli;
			$tokens[] = localize('_month',getlocal());			
			$tokens[] = $monthsli;	
            $tokens[] = $daterange;			
		
			$ret = $this->combine_tokens($tmpl, $tokens); 				
     
			return ($ret);
		}
		
		return null;	
    }	
	
	protected function combine_tokens($template, $tokens, $execafter=null) {
	    if (!is_array($tokens)) return;		

		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
			$fp = new fronthtmlpage(null);
			$ret = $fp->process_commands($template);
			unset ($fp);		  		
		}		  		
		else
			$ret = $template;
		  
	    foreach ($tokens as $i=>$tok) {
            //echo $tok,'<br>';
		    $ret = str_replace("$".$i."$",$tok,$ret);
	    }
		//clean unused token marks
		for ($x=$i;$x<30;$x++)
			$ret = str_replace("$".$x."$",'',$ret);
		
		if (($execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
			$fp = new fronthtmlpage(null);
			$retout = $fp->process_commands($ret);
			unset ($fp);
          
			return ($retout);
		}		
		
		return ($ret);
	}		
	
};
}
?>