<?php

$__DPCSEC['CMSCHARTS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("CMSCHARTS_DPC")) && (seclevel('CMSCHARTS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("CMSCHARTS_DPC",true);

$__DPC['CMSCHARTS_DPC'] = 'cmscharts';

$a = GetGlobal('controller')->require_dpc('cp/cpflotcharts.lib.php');
require_once($a);

$__LOCALE['CMSCHARTS_DPC'][0]='CMSCHARTS_DPC;Charts;Διαγράμματα';
$__LOCALE['CMSCHARTS_DPC'][1]='_day;Day;Ημέρα';
$__LOCALE['CMSCHARTS_DPC'][2]='_hits;views;προβολές';
$__LOCALE['CMSCHARTS_DPC'][3]='_clicks;Clicks;Clicks';
$__LOCALE['CMSCHARTS_DPC'][4]='_uclicks;Unique;Unique';
$__LOCALE['CMSCHARTS_DPC'][5]='_mailqueue;Mails sent;Αποστολές e-mail';
$__LOCALE['CMSCHARTS_DPC'][6]='_mailreply;Mails viewed;Προβολές e-mail';
$__LOCALE['CMSCHARTS_DPC'][7]='_mailbounce;Mails bounced;Αποτυχημένα e-mail';

class cmscharts extends cpflotcharts {

    function __construct() {
		
		cpflotcharts::__construct();
    }
	
    protected function flot_stats() {
		$db = GetGlobal('db'); 	
        $year = GetParam('year') ? GetParam('year') : date('Y'); 
	    $month = GetParam('month') ? GetParam('month') : date('m');	

		$cpGet = _v('rcpmenu.cpGet');	
		$noBots = _m('rccontrolpanel.avoidBotsSQL use HTTP_USER_AGENT+1');		
			
        if ($id = _m("cmsrt.getRealItemCode use " . $cpGet['id'])) {
			
			$item = _m('rccontrolpanel.getItemName use '.$id);		
			
			$diff = 0;
			$timeins = $this->sqlDateRange('date', true, true, $diff);
			
			//stats (item)
			//$sSQL = "select count(id) as hits,year,month from stats where tid='$id' " . $timeins . " group by year, month order by year, month";
			$noBots = _m('rccontrolpanel.avoidBotsSQL use HTTP_USER_AGENT+1');
			$sSQL = "select count(id) as hits, DAY(date) as day from stats where $noBots tid='$id' " . $timeins . " group by DAY(date) order by DAY(date)";
			$res = $db->Execute($sSQL,2);
			//echo $sSQL;
            $this->make_chart_data('Visits0', $res, array('day','hits'), $item, array('day',$diff));
			//echo '<br/>' . $this->callChart('Visits');
			//echo '<br/>' . $diff;
			
			//stats (categories)
			$csep = _m('cmsrt.sep');
			$categories = explode($csep, $cpGet['cat']);			
			$csepcat = null; //loop from cat0 to cat4
			foreach ($categories as $i=>$cat) {
				
			  $csepcat = isset($csepcat) ? $csepcat . $csep . $cat : $cat; 	
			  //echo $csepcat . '<br/>'; 	
			  $sSQL = "select count(id) as hits, DAY(date) as day from stats where $noBots attr1='". $csepcat ."' ". $timeins ." group by DAY(date) order by DAY(date)";
			  $res = $db->Execute($sSQL,2);
			  
			  $ix = $i + 1;
			  $this->make_chart_data('Visits'.$ix, $res, array('day','hits'), _m("cmsrt.replace_spchars use $cat+1"), array('day',$diff));	
			  //echo '<br/>' . $this->callChart('VisitsCat'.$i);
			}
			
			$this->chartGroup = array('Visits1','Visits2','Visits3','Visits4','Visits5','Visits0');
			
			//transactions
			$diff = 0;
			$timeins = $this->sqlDateRange('timein', true, true, $diff);
			
			$sSQL = "select count(recid) as hits, DAY(timein) as day from transactions where tdata like '%$id%'" . $timeins . " group by DAY(timein) order by DAY(timein)";
			$res = $db->Execute($sSQL,2);
            $this->make_chart_data('Transactions', $res, array('day','hits'), localize('_transactions',getlocal()), array('day',$diff));	
            //echo $sSQL;
			//echo '<br/>' . $this->callChart('Transactions');
		}
		elseif ($cat = $cpGet['cat']) {
			
			$diff = 0;
			$timeins = $this->sqlDateRange('date', true, true, $diff);			
			
			//stats (categories)
			$csep = _m('cmsrt.sep');
			$categories = explode($csep, $cat);			
			$csepcat = null; //loop from cat0 to cat4
			foreach ($categories as $i=>$cat) {
				
			  $csepcat = isset($csepcat) ? $csepcat . $csep . $cat : $cat; 		
			  $sSQL = "select count(id) as hits, DAY(date) as day from stats where $noBots attr1='". $csepcat ."' ". $timeins ." group by DAY(date) order by DAY(date)";
			  $res = $db->Execute($sSQL,2);
			  
			  $this->make_chart_data('Visits'.$i, $res, array('day','hits'), _m("cmsrt.replace_spchars use $cat+1"), array('day',$diff));	
			}
			
			$this->chartGroup = array('Visits0','Visits1','Visits2','Visits3','Visits4');			
			
			//return (0); //test bypass

			/**** find category's items ***/
			$activecode = _v('cmsrt.fcode');
			foreach ($categories as $c=>$category)
				$catSQL .= " AND cat$c = " . $db->qstr(_m("cmsrt.replace_spchars use $category+1"));
			
			//items group
			$sSQL = "select $activecode from products where active>0 AND itmactive>0 " . $catSQL;
			$result = $db->Execute($sSQL,2);
			foreach ($result as $i=>$rec) 
				$items[] = $rec[0];
			
			//transactions
			$diff = 0;
			$timeins = $this->sqlDateRange('timein', true, true, $diff);
			
			$sSQL = "select count(recid) as hits, DAY(timein) as day from transactions where tdata REGEXP '". implode('|', $items) ."'" . $timeins . " group by DAY(timein) order by DAY(timein)";
			$res = $db->Execute($sSQL,2);
            $this->make_chart_data('Transactions', $res, array('day','hits'), localize('_transactions',getlocal()), array('day',$diff));
		
		}		
		else {
			
			//return (0); //test bypass			
			
			//stats (items)
			$diff = 0;
			$timeins = $this->sqlDateRange('date', true, false, $diff);			
			
			//where tid IS NOT NULL 
			$sSQL = "select count(id) as hits, DAY(date) as day from stats where $noBots $timeins group by DAY(date) order by DAY(date)";
			$res = $db->Execute($sSQL,2);
			//echo $sSQL;
            $this->make_chart_data('Visits0', $res, array('day','hits'), localize('_hits',getlocal()), array('day',$diff));

			$this->chartGroup = array('Visits0');
			
			//transactions
			$diff = 0;
			$timeins = $this->sqlDateRange('timein', true, false, $diff);
			
			$sSQL = "select count(recid) as hits, DAY(timein) as day from transactions where " . $timeins . " group by DAY(timein) order by DAY(timein)";
			$res = $db->Execute($sSQL,2);
            $this->make_chart_data('Transactions', $res, array('day','hits'), localize('_transactions',getlocal()), array('day',$diff));				
			
			//stats (mailqueue)
			//$diff = 0;
			//$timeins = $this->sqlDateRange('timein', true, true, $diff);
		    /*
			$sSQL = "select count(id) as hits, DAY(timeout) as day from mailqueue where active=0 " . $timeins . " group by DAY(timeout) order by DAY(timeout)";
			$res = $db->Execute($sSQL,2);
            $this->make_chart_data('Mailqueue', $res, array('day','hits'), $mqlabel, array('day',$diff));
			*/
		}  

        return (1);     	
    }
   
	public function jsflotcharts() {
		$daylabel = localize('_day',getlocal());
		$clicks = localize('_hits',getlocal());
		$orders = localize('_transactions',getlocal());
		
		$this->flot_stats();
		
		/*
		<script src="js/flot-chart.js"></script>
        <script src="js/custom-flot-chart.js"></script>  
		*/
		$js = <<<FLOT
		
var Script = function () {

    //purchases chart

    $(function () {
        var data = [
			{$this->callChartGroupLast($this->chartGroup)} , {$this->callChart('Transactions')} 			
        ];

        var options = {
            series: {
                lines: { show: true },
                points: { show: true }
            },
            legend: { noColumns: 2 },
            xaxis: { tickDecimals: 0 },
            yaxis: { min: 0 },
            selection: { mode: "x" }
        };

        var placeholder = $("#chart-1");

        placeholder.bind("plotselected", function (event, ranges) {
            $("#selection").text(ranges.xaxis.from.toFixed(1) + " to " + ranges.xaxis.to.toFixed(1));

            var zoom = $("#zoom").attr("checked");
            if (zoom)
                plot = $.plot(placeholder, data,
                    $.extend(true, {}, options, {
                        xaxis: { min: ranges.xaxis.from, max: ranges.xaxis.to }
                    }));
        });

        placeholder.bind("plotunselected", function (event) {
            $("#selection").text("");
        });

        var plot = $.plot(placeholder, data, options);

        $("#clearSelection").click(function () {
            plot.clearSelection();
        });

        $("#setSelection").click(function () {
            plot.setSelection({ xaxis: { from: 0, to: {$this->callChartGroupLast($this->chartGroup, 'xmax', '0')} } });
        });
    });
	
   //  tracking chart

    var plot;
    $(function () {
        var sin = [], cos = [];
        for (var i = 0; i < 14; i += 0.1) {
            sin.push([i, Math.sin(i)]);
            cos.push([i, Math.cos(i)]);
        }

        plot = $.plot($("#chart-2"),
            [ 
			   { data: sin, label: "sin(x) = -0.00"},
                { data: cos, label: "cos(x) = -0.00" } ], {
                series: {
                    lines: { show: true }
                },
                crosshair: { mode: "x" },
                grid: { hoverable: true, autoHighlight: false },
                yaxis: { min: -1.2, max: 1.2 }
            });
        var legends = $("#chart-2 .legendLabel");
        legends.each(function () {
            // fix the widths so they don't jump around
            $(this).css('width', $(this).width());
        });

        var updateLegendTimeout = null;
        var latestPosition = null;

        function updateLegend() {
            updateLegendTimeout = null;

            var pos = latestPosition;

            var axes = plot.getAxes();
            if (pos.x < axes.xaxis.min || pos.x > axes.xaxis.max ||
                pos.y < axes.yaxis.min || pos.y > axes.yaxis.max)
                return;

            var i, j, dataset = plot.getData();
            for (i = 0; i < dataset.length; ++i) {
                var series = dataset[i];

                // find the nearest points, x-wise
                for (j = 0; j < series.data.length; ++j)
                    if (series.data[j][0] > pos.x)
                        break;

                // now interpolate
                var y, p1 = series.data[j - 1], p2 = series.data[j];
                if (p1 == null)
                    y = p2[1];
                else if (p2 == null)
                    y = p1[1];
                else
                    y = p1[1] + (p2[1] - p1[1]) * (pos.x - p1[0]) / (p2[0] - p1[0]);

                legends.eq(i).text(series.label.replace(/=.*/, "= " + y.toFixed(2)));
            }
        }

        $("#chart-2").bind("plothover",  function (event, pos, item) {
            latestPosition = pos;
            if (!updateLegendTimeout)
                updateLegendTimeout = setTimeout(updateLegend, 50);
        });
    });	

	//    live chart

    $(function () {
        // we use an inline data source in the example, usually data would
        // be fetched from a server
        var data = [], totalPoints = 300;
        function getRandomData() {
            if (data.length > 0)
                data = data.slice(1);

            // do a random walk
            while (data.length < totalPoints) {
                var prev = data.length > 0 ? data[data.length - 1] : 50;
                var y = prev + Math.random() * 10 - 5;
                if (y < 0)
                    y = 0;
                if (y > 100)
                    y = 100;
                data.push(y);
            }

            // zip the generated y values with the x values
            var res = [];
            for (var i = 0; i < data.length; ++i)
                res.push([i, data[i]])
            return res;
        }

        // setup control widget
        var updateInterval = 30;
        $("#updateInterval").val(updateInterval).change(function () {
            var v = $(this).val();
            if (v && !isNaN(+v)) {
                updateInterval = +v;
                if (updateInterval < 1)
                    updateInterval = 1;
                if (updateInterval > 2000)
                    updateInterval = 2000;
                $(this).val("" + updateInterval);
            }
        });

        // setup plot
        var options = {
            series: { shadowSize: 0 }, // drawing is faster without shadows
            yaxis: { min: 0, max: 100 },
            xaxis: { show: false }
        };
        var plot = $.plot($("#chart-3"), [ getRandomData() ], options);

        function update() {
            plot.setData([ getRandomData() ]);
            // since the axes don't change, we don't need to call plot.setupGrid()
            plot.draw();

            setTimeout(update, updateInterval);
        }

        update();
    });
    
	//    support chart

    $(function () {
        var d1 = [];
        for (var i = 0; i < 14; i += 0.5)
            d1.push([i, Math.sin(i)]);

        var d2 = [[0, 3], [4, 8], [8, 5], [9, 13]];

        var d3 = [];
        for (var i = 0; i < 14; i += 0.5)
            d3.push([i, Math.cos(i)]);

        var d4 = [];
        for (var i = 0; i < 14; i += 0.1)
            d4.push([i, Math.sqrt(i * 10)]);

        var d5 = [];
        for (var i = 0; i < 14; i += 0.5)
            d5.push([i, Math.sqrt(i)]);

        var d6 = [];
        for (var i = 0; i < 14; i += 0.5 + Math.random())
            d6.push([i, Math.sqrt(2*i + Math.sin(i) + 5)]);

        $.plot($("#chart-4"), [
            {
                data: d1,
                lines: { show: true, fill: true }
            },
            {
                data: d2,
                bars: { show: true }
            },
            {
                data: d3,
                points: { show: true }
            },
            {
                data: d4,
                lines: { show: true }
            },
            {
                data: d5,
                lines: { show: true },
                points: { show: true }
            },
            {
                data: d6,
                lines: { show: true, steps: true }
            }
        ]);
    });

	//    bar chart

    $(function () {
        var d1 = [];
        for (var i = 0; i <= 10; i += 1)
            d1.push([i, parseInt(Math.random() * 30)]);

        var d2 = [];
        for (var i = 0; i <= 10; i += 1)
            d2.push([i, parseInt(Math.random() * 30)]);

        var d3 = [];
        for (var i = 0; i <= 10; i += 1)
            d3.push([i, parseInt(Math.random() * 30)]);

        var stack = 0, bars = true, lines = false, steps = false;

        function plotWithOptions() {
            $.plot($("#chart-5"), [ d1, d2, d3 ], {
                series: {
                    stack: stack,
                    lines: { show: lines, fill: true, steps: steps },
                    bars: { show: bars, barWidth: 0.6 }
                }
            });
        }

        plotWithOptions();

        $(".stackControls input").click(function (e) {
            e.preventDefault();
            stack = $(this).val() == "With stacking" ? true : null;
            plotWithOptions();
        });
        $(".graphControls input").click(function (e) {
            e.preventDefault();
            bars = $(this).val().indexOf("Bars") != -1;
            lines = $(this).val().indexOf("Lines") != -1;
            steps = $(this).val().indexOf("steps") != -1;
            plotWithOptions();
        });
    });

	//    graph chart


    $(function () {
        // data
        /*var data = [
         { label: "Series1",  data: 10},
         { label: "Series2",  data: 30},
         { label: "Series3",  data: 90},
         { label: "Series4",  data: 70},
         { label: "Series5",  data: 80},
         { label: "Series6",  data: 110}
         ];*/
        /*var data = [
         { label: "Series1",  data: [[1,10]]},
         { label: "Series2",  data: [[1,30]]},
         { label: "Series3",  data: [[1,90]]},
         { label: "Series4",  data: [[1,70]]},
         { label: "Series5",  data: [[1,80]]},
         { label: "Series6",  data: [[1,0]]}
         ];*/
        var data = [];
        var series = Math.floor(Math.random()*10)+1;
        for( var i = 0; i<series; i++)
        {
            data[i] = { label: "Series"+(i+1), data: Math.floor(Math.random()*100)+1 }
        }



        // GRAPH 1
        $.plot($("#graph1"), data,
            {
                series: {
                    pie: {
                        show: true
                    }
                },
                legend: {
                    show: false
                }
            });

        // GRAPH 2
        $.plot($("#graph2"), data,
            {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 1,
                            formatter: function(label, series){
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                            },
                            background: { opacity: 0.8 }
                        }
                    }
                },
                legend: {
                    show: false
                }
            });

        // GRAPH 3
        $.plot($("#graph3"), data,
            {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 3/4,
                            formatter: function(label, series){
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                            },
                            background: { opacity: 0.5 }
                        }
                    }
                },
                legend: {
                    show: false
                }
            });


        // DONUT
        $.plot($("#donut"), data,
            {
                series: {
                    pie: {
                        innerRadius: 0.5,
                        show: true
                    }
                }
            });



    });

    function pieHover(event, pos, obj)
    {
        if (!obj)
            return;
        percent = parseFloat(obj.series.percent).toFixed(2);
        $("#hover").html('<span style="font-weight: bold; color: '+obj.series.color+'">'+obj.series.label+' ('+percent+'%)</span>');
    }

    function pieClick(event, pos, obj)
    {
        if (!obj)
            return;
        percent = parseFloat(obj.series.percent).toFixed(2);
        alert(''+obj.series.label+': '+percent+'%');
    }

    
}();		
		
		
var Script = function () {

   //flot chart visits

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


		
		
FLOT;
		return $js;
	}  
};
}   
?>