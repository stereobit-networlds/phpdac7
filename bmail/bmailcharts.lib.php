<?php

$__DPCSEC['BMAILCHARTS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("BMAILCHARTS_DPC")) && (seclevel('BMAILCHARTS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("BMAILCHARTS_DPC",true);

$__DPC['BMAILCHARTS_DPC'] = 'bmailcharts';

$a = GetGlobal('controller')->require_dpc('cp/cpflotcharts.lib.php');
require_once($a);

$__LOCALE['BMAILCHARTS_DPC'][0]='BMAILCHARTS_DPC;Charts;Διαγράμματα';
$__LOCALE['BMAILCHARTS_DPC'][1]='_day;Day;Ημέρα';
$__LOCALE['BMAILCHARTS_DPC'][2]='_hits;views;προβολές';
$__LOCALE['BMAILCHARTS_DPC'][3]='_clicks;Clicks;Clicks';
$__LOCALE['BMAILCHARTS_DPC'][4]='_uclicks;Unique;Unique';
$__LOCALE['BMAILCHARTS_DPC'][5]='_mailqueue;Mails sent;Αποστολές e-mail';
$__LOCALE['BMAILCHARTS_DPC'][6]='_mailreply;Mails viewed;Προβολές e-mail';
$__LOCALE['BMAILCHARTS_DPC'][7]='_mailbounce;Mails bounced;Αποτυχημένα e-mail';

class bmailcharts extends cpflotcharts {

    function __construct() {
		
		cpflotcharts::__construct();
    }
	
    protected function flot_mail_stats() {
		$db = GetGlobal('db'); 	
		$mqlabel = localize('_mailqueue',getlocal());
		$mqreplies = localize('_mailreply',getlocal());
		$mqbounce = localize('_mailbounce',getlocal());	

		$diff = 0;
		$timeins = $this->sqlDateRange('timein', true, true, $diff);		

		//print_r($_GET);
        if ($cid = $_GET['cid']) { //GetReq('cid')) {
			
			//stats (mailqueue)
			$sSQL = "select count(id) as hits, DAY(timeout) as day from mailqueue where cid='$cid' and active=0 " . $timeins . " group by DAY(timeout) order by DAY(timeout)";
			$res = $db->Execute($sSQL,2);
            $this->make_chart_data('Mailqueue', $res, array('day','hits'), $mqlabel, array('day',$diff));
			//stats (mailqueue replied)
			$sSQL = "select count(id) as hits, DAY(timeout) as day from mailqueue where cid='$cid' and active=0 and status=1 " . $timeins . " group by DAY(timeout) order by DAY(timeout)";
			$res = $db->Execute($sSQL,2);
            $this->make_chart_data('Mailreplies', $res, array('day','hits'), $mqreplies, array('day',$diff));			
			//stats (mailqueue bounced)
			$sSQL = "select count(id) as hits, DAY(timeout) as day from mailqueue where cid='$cid' and active=0 and status<0 " . $timeins . " group by DAY(timeout) order by DAY(timeout)";
			$res = $db->Execute($sSQL,2);
            $this->make_chart_data('Mailbounce', $res, array('day','hits'), $mqbounce, array('day',$diff));			
					
			//Campaign clicks
			$sSQL = "select count(id) as hits, DAY(date) as day from stats where ref='$cid' group by DAY(date) order by DAY(date)";
			$res = $db->Execute($sSQL,2);
            $this->make_chart_data('CampaignClicks', $res, array('day','hits'), localize('_clicks',getlocal()), array('day',$diff));	
			/*echo $sSQL;
			$sSQL = "select count(id) as hits, DAY(date) as day from stats where ref='$cid' group by DAY(date) order by DAY(date)";
			$res = $db->Execute($sSQL,2);
            $this->make_chart_data('UniqueClicks', $res, array('day','hits'), localize('_uclicks',getlocal()), array('day',$diff));		
			*/
			$this->chartGroup = array('Mailqueue', 'Mailreplies', 'Mailbounce', 'CampaignClicks');//, 'UniqueClicks');			
		}		
		else {
			
			//stats (mailqueue)
			$sSQL = "select count(id) as hits, DAY(timeout) as day from mailqueue where active=0 " . $timeins . " group by DAY(timeout) order by DAY(timeout)";
			$res = $db->Execute($sSQL,2);
            $this->make_chart_data('Mailqueue', $res, array('day','hits'), $mqlabel, array('day',$diff));
			//stats (mailqueue replied)
			$sSQL = "select count(id) as hits, DAY(timeout) as day from mailqueue where active=0 and status=1 " . $timeins . " group by DAY(timeout) order by DAY(timeout)";
			$res = $db->Execute($sSQL,2);
            $this->make_chart_data('Mailreplies', $res, array('day','hits'), $mqreplies, array('day',$diff));			
			//stats (mailqueue bounced)
			$sSQL = "select count(id) as hits, DAY(timeout) as day from mailqueue where active=0 and status<0 " . $timeins . " group by DAY(timeout) order by DAY(timeout)";
			$res = $db->Execute($sSQL,2);
            $this->make_chart_data('Mailbounce', $res, array('day','hits'), $mqbounce, array('day',$diff));			
			

			$this->chartGroup = array('Mailqueue', 'Mailreplies', 'Mailbounce');			
        } 
        return (1);     	
    }	
	
	public function jsflotMailcharts($div=null) {
		$plotdiv = $div ? $div : 'plots';
		$daylabel = localize('_day',getlocal());
		$clicks = ': '; //localize('_clicks',getlocal());
		
		$this->flot_mail_stats();	
		$js = <<<FLOTMAIL
		
var Script = function () {

   //flot mail chart visits

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

    if (!!$(".$plotdiv").offset() ) {

        $.plot($(".$plotdiv"), [ {$this->callChartGroup($this->chartGroup)}  ],
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

                yaxis: { min: 0, max: {$this->callChartGroupMax($this->chartGroup, 'ymax', '0')}},
                xaxis: { min: 1, max: {$this->callChartGroupMax($this->chartGroup, 'xmax', '1')}}
            });

        // plot tooltip show
        var previousPoint = null;
        $(".$plotdiv").bind("plothover", function (event, pos, item) {
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


		
		
FLOTMAIL;
		return $js;
	}   
};
}   
?>