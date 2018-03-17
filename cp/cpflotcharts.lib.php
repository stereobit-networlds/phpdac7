<?php

$__DPCSEC['CPFLOTCHARTS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CPFLOTCHARTS_DPC")) && (seclevel('CPFLOTCHARTS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CPFLOTCHARTS_DPC",true);

$__DPC['CPFLOTCHARTS_DPC'] = 'cpflotcharts';

$__LOCALE['CPFLOTCHARTS_DPC'][0]='CPFLOTCHARTS_DPC;Flot charts;Διαγράμματα';
$__LOCALE['CPFLOTCHARTS_DPC'][1]='_day;Day;Ημέρα';
$__LOCALE['CPFLOTCHARTS_DPC'][2]='_hits;views;προβολές';
$__LOCALE['CPFLOTCHARTS_DPC'][3]='_transactions;Transactions;Αγορές';
$__LOCALE['CPFLOTCHARTS_DPC'][4]='_clicks;Clicks;Clicks';
$__LOCALE['CPFLOTCHARTS_DPC'][5]='_uclicks;Unique;Unique';
$__LOCALE['CPFLOTCHARTS_DPC'][6]='_mailqueue;Mails sent;Αποστολές e-mail';
$__LOCALE['CPFLOTCHARTS_DPC'][7]='_mailreply;Mails viewed;Προβολές e-mail';
$__LOCALE['CPFLOTCHARTS_DPC'][8]='_mailbounce;Mails bounced;Αποτυχημένα e-mail';

class cpflotcharts {
	
	var $charts, $chartGroup;

    function __construct() {
		
		$this->charts = array();
		$this->chartGroup = array();
    }
	
	public function isChart($name=null) {
		$p = isset($this->charts[$name]['data']);
		return $p ? true : false;
	}	
	
	public function callChart($name=null, $param=null) {
		$p = $param ? $param : 'data';
		return $this->charts[$name][$p];
	}
	
	public function callChartGroup($group=null) {
		if (empty($group)) return null;
		
		foreach ($group as $g) {
			if ($this->isChart($g))
				$charts[] = $this->callChart($g);
		}	
			
		return ((!empty($charts)) ? implode(' , ', $charts) : null);
	}
	
	public function callChartGroupFirst($group=null, $param=null, $default='0') {
		if (empty($group)) return $default;

		foreach ($group as $g) {
			if ($this->isChart($g)) 
				return $param ? $this->charts[$g][$param] : $this->callChart($g);
		}	

		return $default;
	}		
	
	public function callChartGroupLast($group=null, $param=null, $default='0') {
		if (empty($group)) return $default;
		$rgroup = array_reverse($group); 

		foreach ($rgroup as $g) {
			if ($this->isChart($g)) 
				return $param ? $this->charts[$g][$param] : $this->callChart($g);
		}	

		return $default;
	}	

	public function callChartGroupMin($group=null, $param=null, $default='0') {
		$p = $param ? $param : 'ymin';
		if (empty($group)) return $default;	

		foreach ($group as $g) 
			$min[] = $this->charts[$g][$p];
		
		return ((!empty($min)) ? max($min) : $default );	
	}	
	
	public function callChartGroupMax($group=null, $param=null, $default='0') {
		$p = $param ? $param : 'ymax';
		if (empty($group)) return $default;	

		foreach ($group as $g) 
			$max[] = isset($this->charts[$g][$p]) ? $this->charts[$g][$p] : 0;

		return ((!empty($max)) ? max($max) : $default );	
	}	
	
	protected function nformat($n, $dec=0) {
		return (number_format($n,$dec,',','.'));
	}	
	
	//////////////////////////////////////////////////////////////////////
	//PARA: Date Should In YYYY-MM-DD Format
	//RESULT FORMAT:
	// '%y Year %m Month %d Day %h Hours %i Minute %s Seconds'        =>  1 Year 3 Month 14 Day 11 Hours 49 Minute 36 Seconds
	// '%y Year %m Month %d Day'                                    =>  1 Year 3 Month 14 Days
	// '%m Month %d Day'                                            =>  3 Month 14 Day
	// '%d Day %h Hours'                                            =>  14 Day 11 Hours
	// '%d Day'                                                        =>  14 Days
	// '%h Hours %i Minute %s Seconds'                                =>  11 Hours 49 Minute 36 Seconds
	// '%i Minute %s Seconds'                                        =>  49 Minute 36 Seconds
	// '%h Hours                                                    =>  11 Hours
	// '%a Days                                                        =>  468 Days
	//////////////////////////////////////////////////////////////////////
	public function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' ) {
		$datetime1 = date_create($date_1);
		$datetime2 = date_create($date_2);
    
		$interval = date_diff($datetime1, $datetime2);
    
		return $interval->format($differenceFormat);
	}	
	/*use timestamps*/
	public function dateDifferenceTS($date_1 , $date_2 , $differenceFormat = '%a' ) {
		$datetime1 = date_create("@$date_1");
		$datetime2 = date_create("@$date_2");
    
		$interval = date_diff($datetime1, $datetime2);
    
		return $interval->format($differenceFormat);
	}	
	
 	protected function sqlDateRange($fieldname, $istimestamp=false, $and=false, &$diff=0) {
		$sqland = $and ? ' AND' : null;
		if ($daterange = GetParam('rdate')) {//post
			$range = explode('-',$daterange);
			$dstart = str_replace('/','-',trim($range[0]));
			$dend = str_replace('/','-',trim($range[1]));
			
			//$diff = $this->dateDifference($dstart, $dend); //!!! format = m d y !!! ERROR
			$d1 = explode('-',$dstart); $d2 = explode('-',$dend); //reverse format from mdy to dmy
			$diff = $this->dateDifference($d1[1].'-'.$d1[0].'-'.$d1[2] , $d2[1].'-'.$d2[0].'-'.$d2[2]);
			
			if ($istimestamp)
				$dateSQL = $sqland . " DATE($fieldname) BETWEEN STR_TO_DATE('$dstart','%m-%d-%Y') AND STR_TO_DATE('$dend','%m-%d-%Y')";
			else			
				$dateSQL = $sqland . " $fieldname BETWEEN STR_TO_DATE('$dstart','%m-%d-%Y') AND STR_TO_DATE('$dend','%m-%d-%Y')";		
		}				
		elseif ($y = GetReq('year')) {
			if ($m = GetReq('month')) { $mstart = $m; $mend = $m;} else { $mstart = '01'; $mend = '12'; $m = '12';}
			$daysofmonth = cal_days_in_month(CAL_GREGORIAN, $m, $y);
			$diff = $this->dateDifference("01-$mstart-$y", "$daysofmonth-$mend-$y");
			
			if ($istimestamp)
				$dateSQL = $sqland . " DATE($fieldname) BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";
			else
				$dateSQL = $sqland . " $fieldname BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";
		}	
        else {
			//always this year by default
			//$mstart = '01'; $mend = '12';
			//always this month by default
			$mstart = date('m'); $mend = date('m');
			$y = date('Y');
			$daysofmonth = date('t');
			$diff = $this->dateDifference("01-$mstart-$y", "$daysofmonth-$mend-$y");
			
			if ($istimestamp)
				$dateSQL = $sqland . " DATE($fieldname) BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";
			else
				$dateSQL = $sqland . " $fieldname BETWEEN '$y-$mstart-01' AND '$y-$mend-$daysofmonth'";	
            //echo $dateSQL;			
		}	
		
		return ($dateSQL);
	} 	
	
	/*read db results and convert it to js array */
	protected function make_chart_data($chartID, $data=null, $couple=null, $label=null, $normalize=null) {
		if (empty($data->fields)) return null;
		if (!empty($couple)) {
			list($x, $y) = $couple;
			
			$ret = "{";
			$ret.= $label ? '"label" : "'.$label.'", ' : null;
			$ret.= '"data" : [';
			
			if ($normalize) { //normalize to include range (e,g days 1..31=month max) into recordset
				list($fcheck, $nmax) = $normalize;

				foreach ($data as $i=>$rec) 
					$narr[$rec[$x]] = $rec[$y];
				//print_r($narr);	
				foreach (range(1, $nmax+1) as $n) 
					if (!array_key_exists($n, $narr)) $narr[$n] = 0;
				ksort($narr);	
				//print_r($narr);	
				
				foreach ($narr as $x=>$y) {
					$xy[] = '['. $x . ',' . $y . ']';
					$xval[] = $x;
					$yval[] = $y;
				}				
			}
			else { //recordset
				foreach ($data as $i=>$rec) {
					$xy[] = '['. $rec[$x] . ',' . $rec[$y] . ']';
					$xval[] = $rec[$x];
					$yval[] = $rec[$y];
				}
			}
			
			if (!empty($xy)) {
				$ret.= implode(',', $xy);
				$ret.= "]}";
			
				$this->charts[$chartID]['data'] = $ret;
				$this->charts[$chartID]['xmin'] = min($xval);
				$this->charts[$chartID]['xmax'] = max($xval);
				$this->charts[$chartID]['ymin'] = min($yval);
				$this->charts[$chartID]['ymax'] = max($yval);			
			}
			else
				$ret = null;
			
			//return ($ret);
		}
		
		return null;
	}

};
}   
?>