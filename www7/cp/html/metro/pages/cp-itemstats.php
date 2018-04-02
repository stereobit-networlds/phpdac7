<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>e-Enterprise</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="stereobit.networlds" name="author" />
   <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" />
   <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="css/style.css" rel="stylesheet" />
   <link href="css/style-responsive.css" rel="stylesheet" />
   <link href="css/style-default.css" rel="stylesheet" id="style_color" />
   
   <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
   <link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" />
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="fixed-top" onLoad="init()">
   <!-- BEGIN HEADER -->
	<phpdac>frontpage.include_part use /parts/header.php+++metro</phpdac>
   <!-- END HEADER -->
   <!-- BEGIN CONTAINER -->
   <div id="container" class="row-fluid">
      <!-- BEGIN SIDEBAR -->
		<phpdac>frontpage.include_part use /parts/sidebar.php+++metro</phpdac>
      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
				<!--phpdac>frontpage.include_part use /parts/pageheader.php+++metro</phpdac-->
				<phpdac>frontpage.nvldac2 use rccontrolpanel.cpStats+rccontrolpanel.select_timeline:cptimeline++1</phpdac>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <!--BEGIN METRO STATES-->
                <div class="metro-nav">
                    <div class="metro-nav-block nav-block-orange">
                        <a data-original-title="" href="cp.php?t=cpitemVisits">
                            <i class="icon-user"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Visits</phpdac></div>
                            <div class="status"><phpdac>frontpage.slocale use _visits</phpdac></div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-red">
                        <a data-original-title="" href="#">
                            <i class="icon-eye-open"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Visits+unique</phpdac></div>
                            <div class="status">Unique <phpdac>frontpage.slocale use _visits</phpdac></div>
                        </a>
                    </div>					
                    <div class="metro-nav-block nav-olive">
                        <a data-original-title="" href="#">
                            <i class="icon-tags"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Visits+cartin</phpdac></div>
                            <div class="status"><phpdac>i18nL.translate use LOADCART+SHTRANSACTIONS</phpdac> in</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-deep-gray">
                        <a data-original-title="" href="#">
                            <i class="icon-remove-sign"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Visits+cartout</phpdac></div>
                            <div class="status"><phpdac>i18nL.translate use LOADCART+SHTRANSACTIONS</phpdac> out</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-green double">
                        <a data-original-title="" href="#">
                            <i class="icon-dashboard"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Item+ypoloipo1</phpdac></div>
                            <div class="status"><phpdac>i18nL.translate use ypoloipo1+RCITEMQPOLICY</phpdac></div>
                        </a>
                    </div>
                </div>
                <div class="metro-nav">
                    <div class="metro-nav-block nav-light-green">
                        <a data-original-title="" href="#">
                            <i class="icon-star-empty"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Visits+wishall</phpdac></div>
                            <div class="status"><phpdac>i18nL.translate use favorites+RCCRM</phpdac></div>
                        </a>
                    </div>				
                    <div class="metro-nav-block nav-light-blue double">
                        <a data-original-title="" href="#">
                            <i class="icon-comments-alt"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Purchase+orders</phpdac></div>
                            <div class="status"><phpdac>i18nL.translate use transactions+RCCONTROLPANEL</phpdac></div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-yellow">
                        <a data-original-title="" href="#">
                            <i class="icon-bar-chart"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Purchase+transactions</phpdac></div>
                            <div class="status"><phpdac>i18nL.translate use transactions+RCCONTROLPANEL</phpdac></div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-light-purple">
                        <a data-original-title="" href="#">
                            <i class="icon-shopping-cart"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Purchase+qty</phpdac></div>
                            <div class="status"><phpdac>i18nL.translate use qty+RCITEMQPOLICY</phpdac></div>
                        </a>
                    </div>					
                    <div class="metro-nav-block nav-block-grey ">
                        <a data-original-title="" href="#">
                            <i class="icon-external-link"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Purchase</phpdac> &euro;</div>
                            <div class="status"><phpdac>frontpage.slocale use _revenue</phpdac></div>
                        </a>
                    </div>
                </div>
                <div class="space10"></div>
                <!--END METRO STATES-->
            </div>
			
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget purple">
                        <div class="widget-title">
                            <h4><i class="icon-bar-chart"></i> <phpdac>i18nL.translate use CPFLOTCHARTS_DPC+CPFLOTCHARTS</phpdac></h4>
                        <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                        </span>
                        </div>
                        <div class="widget-body">
							<div class="tabbable ">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_1_1" data-toggle="tab"><phpdac>cms.slocale use _views</phpdac></a></li>
									<li><a href="#tab_1_2" data-toggle="tab"><phpdac>i18nL.translate use transactions+RCCONTROLPANEL</phpdac></a></li>
                                </ul>
								<div class="tab-content">
                                    <div class="tab-pane active" id="tab_1_1">
										<div class="plots"></div>
									</div>
									<div class="tab-pane" id="tab_1_2">
										<div id="chart-1" class="chart"></div>
									</div>
								</div>				
							</div>
                        </div>
                    </div>
                </div>
            </div>		

            <div class="row-fluid">
                <div class="span6">

					<div class="widget purple">
						<div class="widget-title">
							<h4><i class="icon-tasks"></i> Analytics </h4>
							<span class="tools">
							<a href="javascript:;" class="icon-chevron-down"></a>
							</span>
						</div>
						<div class="widget-body">
							<div id="widgetIframe"> 
								<phpdac>siteanalytics.widget use Live+widget+++++yes</phpdac>
							</div>								
						</div>
					</div>
					
                    <div class="widget orange">
                        <div class="widget-title">
                            <h4><i class="icon-bell-alt"></i> <phpdac>i18nL.translate use system+RCCONTROLPANEL</phpdac> <phpdac>i18nL.translate use messages+RCCONTROLPANEL</phpdac></h4>
                            <span class="tools">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            </span>
                        </div>
                        <div class="widget-body">
						    <phpdac>rcmessages.viewSysMessages use alert-important</phpdac>
							<div class="space10"></div>
                            <a href="cpmessages.php?t=cpmsg" class="pull-right"><phpdac>frontpage.slocale use _viewallmessages</phpdac></a>
                            <div class="clearfix no-top-space no-bottom-space"></div>
                        </div>
                    </div>
					
                    <!--div class="widget purple">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Tracking Chart</h4>
						<span class="tools">
						<a href="javascript:;" class="icon-chevron-down"></a>
						</span>
                        </div>
                        <div class="widget-body">
                            <div id="chart-2" class="chart"></div>
                        </div>
                    </div>

                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Live Chart</h4>
						<span class="tools">
						<a href="javascript:;" class="icon-chevron-down"></a>
						</span>
                        </div>
                        <div class="widget-body">
                            <div id="chart-3" class="chart"></div>
                        </div>
                    </div>

                    <div class="widget yellow">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Support Chart</h4>
                                <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                </span>
                        </div>
                        <div class="widget-body">
                            <div id="chart-4" class="chart"></div>
                        </div>
                    </div>

                    <div class="widget blue">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Bar Chat</h4>
						<span class="tools">
						<a href="javascript:;" class="icon-chevron-down"></a>
						</span>
                        </div>
                        <div class="widget-body">
                            <div id="chart-5" style="height:350px;"></div>
                            <div class="btn-toolbar">
                                <div class="btn-group stackControls">
                                    <input type="button" class="btn btn-info" value="With stacking" />
                                    <input type="button" class="btn btn-danger" value="Without stacking" />
                                </div>
                                <div class="space5"></div>
                                <div class="btn-group graphControls">
                                    <input type="button" class="btn" value="Bars" />
                                    <input type="button" class="btn" value="Lines" />
                                    <input type="button" class="btn" value="Lines with steps" />
                                </div>
                            </div>
                        </div>
                    </div-->						
                </div>
                <div class="span6">
					<!-- BEGIN ALERTS PORTLET-->
                    <div id="visits" class="widget blue">
                        <div class="widget-title">
                            <h4><i class="icon-bell-alt"></i> <phpdac>frontpage.slocale use _visits</phpdac></h4>
                            <span class="tools">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            </span>
                        </div>
                        <div class="widget-body">
							<phpdac>rcmessages.viewItemStatistics use alert-important</phpdac>
							<div class="space10"></div>
                            <a href="<phpdac>cmsrt.nvl use rccontrolpanel.isCrm+cpcrmtrace.php+cpmessages.php?t=cpitemvisits+</phpdac>" class="pull-right"><phpdac>frontpage.slocale use _viewallmessages</phpdac></a>
                            <div class="clearfix no-top-space no-bottom-space"></div>
                        </div>
                    </div>				
                    <!-- END ALERTS PORTLET-->						
                </div>
            </div>
            <!-- END PAGE CONTENT-->         
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->  
   </div>
   <!-- END CONTAINER -->

   <!-- BEGIN FOOTER -->
	<phpdac>frontpage.include_part use /parts/footer.php+++metro</phpdac>
   <!-- END FOOTER -->

   <!-- BEGIN JAVASCRIPTS -->
   <!-- Load javascripts at bottom, this will reduce page load time -->
   <script src="js/jquery-1.8.3.min.js"></script>
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="assets/flot/jquery.flot.js"></script>
   <script src="assets/flot/jquery.flot.resize.js"></script>
   <script src="assets/flot/jquery.flot.pie.js"></script>
   <script src="assets/flot/jquery.flot.stack.js"></script>
   <script src="assets/flot/jquery.flot.crosshair.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   <script type="text/javascript" src="assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
   <script type="text/javascript" src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
   
   <script type="text/javascript" src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
   <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
   <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
   
   <script src="js/jquery.scrollTo.min.js"></script>


   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!--script for this page only-->
   <!--script src="js/flot-chart.js"></script>
   <script src="js/custom-flot-chart.js"></script-->   
   <script language="javascript" type="text/javascript">
   
    <phpdac>cmscharts.jsflotcharts</phpdac>
	   
    //chosen select
    $(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true});
	   
	   
    //daterange picker

    $('#reservation').daterangepicker();

    $('#reportrange').daterangepicker(
        {
            ranges: {
                'Today': ['today', 'today'],
                'Yesterday': ['yesterday', 'yesterday'],
                'Last 7 Days': [Date.today().add({ days: -6 }), 'today'],
                'Last 30 Days': [Date.today().add({ days: -29 }), 'today'],
                'This Month': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
                'Last Month': [Date.today().moveToFirstDayOfMonth().add({ months: -1 }), Date.today().moveToFirstDayOfMonth().add({ days: -1 })]
            },
            opens: 'left',
            format: 'MM/dd/yyyy',
            separator: ' to ',
            startDate: Date.today().add({ days: -29 }),
            endDate: Date.today(),
            minDate: '01/01/2012',
            maxDate: '12/31/2013',
            locale: {
                applyLabel: 'Submit',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom Range',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            },
            showWeekNumbers: true,
            buttonClasses: ['btn-danger']
        },
        function(start, end) {
            $('#reportrange span').html(start.toString('MMMM d, yyyy') + ' - ' + end.toString('MMMM d, yyyy'));
        }
    );

    //Set the initial state of the picker label
    $('#reportrange span').html(Date.today().add({ days: -29 }).toString('MMMM d, yyyy') + ' - ' + Date.today().toString('MMMM d, yyyy'));

   </script>    
  
   <!-- END JAVASCRIPTS -->    
</body>
<!-- END BODY -->
</html>