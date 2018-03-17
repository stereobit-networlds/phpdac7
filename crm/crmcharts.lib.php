<?php

$__DPCSEC['CRMCHARTS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CRMCHARTS_DPC")) && (seclevel('CRMCHARTS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CRMCHARTS_DPC",true);

$__DPC['CRMCHARTS_DPC'] = 'crmcharts';

$a = GetGlobal('controller')->require_dpc('cp/cpflotcharts.lib.php');
require_once($a);

$__LOCALE['CRMCHARTS_DPC'][0]='CRMCHARTS_DPC;Charts;Διαγράμματα';
$__LOCALE['CRMCHARTS_DPC'][1]='_day;Day;Ημέρα';
$__LOCALE['CRMCHARTS_DPC'][2]='_hits;views;προβολές';
$__LOCALE['CRMCHARTS_DPC'][3]='_clicks;Clicks;Clicks';
$__LOCALE['CRMCHARTS_DPC'][4]='_uclicks;Unique;Unique';
$__LOCALE['CRMCHARTS_DPC'][5]='_mailqueue;Mails sent;Αποστολές e-mail';
$__LOCALE['CRMCHARTS_DPC'][6]='_mailreply;Mails viewed;Προβολές e-mail';
$__LOCALE['CRMCHARTS_DPC'][7]='_mailbounce;Mails bounced;Αποτυχημένα e-mail';

class crmcharts extends cpflotcharts {

    function __construct() {
		
		cpflotcharts::__construct();
    }
	
    protected function flot_crm_stats() {
		$db = GetGlobal('db'); 	
		$diff = 0;	
		$noBots = _m('rccontrolpanel.avoidBotsSQL use HTTP_USER_AGENT+1');		

        if ($cid = urldecode(GetReq('id'))) { //email
		
			$timeins = $this->sqlDateRange('date', true, true, $diff);
			$sSQL = "select count(id) as hits, DAY(date) as day from stats where (attr2='$cid' or attr3='$cid') " . $timeins . " group by DAY(date) order by DAY(date)";
			$res = $db->Execute($sSQL,2);
            $this->make_chart_data('Visits0', $res, array('day','hits'), $item, array('day',$diff));

			$timeins = $this->sqlDateRange('timein', true, true, $diff);				
			$sSQL = "select count(recid) as hits, DAY(timein) as day from transactions where cid='$cid' " . $timeins . " group by DAY(timein) order by DAY(timein)";
			$res = $db->Execute($sSQL,2);
            $this->make_chart_data('Transactions', $res, array('day','hits'), localize('_transactions',getlocal()), array('day',$diff));
		
			$this->chartGroup = array('Visits0','Transactions');
		}		
		else {
			/*$timeins = $this->sqlDateRange('date', true, false, $diff);			
			$sSQL = "select count(id) as hits, DAY(date) as day from stats where  " . $timeins . " group by DAY(date) order by DAY(date)";
			$res = $db->Execute($sSQL,2);
            $this->make_chart_data('Visits0', $res, array('day','hits'), $item, array('day',$diff));			
			*/
			$timeins = $this->sqlDateRange('timein', true, false, $diff);	
			$sSQL = "select count(recid) as hits, DAY(timein) as day from transactions where " . $timeins . " group by DAY(timein) order by DAY(timein)";
			$res = $db->Execute($sSQL,2);
            $this->make_chart_data('Transactions', $res, array('day','hits'), localize('_transactions',getlocal()), array('day',$diff));
		
			$this->chartGroup = array(/*'Visits0',*/'Transactions');		
        } 
        return (1);     	
    }		
	
	public function jsflotCrmCharts() {
		$daylabel = localize('_day',getlocal());
		$clicks = localize('_transactions',getlocal());
		
		$this->flot_crm_stats();	
		$js = <<<FLOTCRM
		
var Script = function () {

   //flot crm chart visits

    var metro = {
        showTooltip: function (x, y, contents) {
            $('<div class="metro_tips">' + contents + '</div>').css( {
                position: 'absolute',
                display: 'none',
                top: y + 5,
                left: x + 5
            }).appendTo("body").fadeIn(200);
        }

    }

    if (!!$(".plots").offset() ) {

        $.plot($(".plots"), [ {$this->callChartGroup($this->chartGroup)}  ],
            {
                colors: ["#4a8bc2", "#de577b", "#cc99cc", "#008800", "#99ff6b"],

                series: {
                    lines: {
                        show: true,
                        lineWidth: 2
                    },
                    points: {show: true},
                    shadowSize: 2
                },

                grid: {
                    hoverable: true,
                    show: true,
                    borderWidth: 0,
                    labelMargin: 12
                },

                legend: {
                    show: true,
                    margin: [0,-24],
                    noColumns: 0,
                    labelBoxBorderColor: null
                },

                yaxis: { min: 0, max: {$this->callChartGroupMax($this->chartGroup, 'ymax','0')}},
                xaxis: { min: 1, max: {$this->callChartGroupMax($this->chartGroup, 'xmax','1')}}
            });

        // plot tooltip show
        var previousPoint = null;
        $(".plots").bind("plothover", function (event, pos, item) {
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                    $(".charts_tooltip").fadeOut("fast").promise().done(function(){
                        $(this).remove();
                    });
                    var x = item.datapoint[0].toFixed(0),
                        y = item.datapoint[1].toFixed(0);
                    metro.showTooltip(item.pageX, item.pageY, item.series.label + " {$daylabel} " + x + " {$clicks} " + y);
                }
            }
            else {
                $(".metro_tips").fadeOut("fast").promise().done(function(){
                    $(this).remove();
                });
                previousPoint = null;
            }
        });
    }

}();


		
		
FLOTCRM;
		return $js;
	} 		 
};
}   
?>