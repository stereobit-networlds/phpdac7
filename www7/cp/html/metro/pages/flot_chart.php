<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Flot chart</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" />
   <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="css/style.css" rel="stylesheet" />
   <link href="css/style-responsive.css" rel="stylesheet" />
   <link href="css/style-default.css" rel="stylesheet" id="style_color" />

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
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
			<phpdac>frontpage.include_part use /parts/pageheader.php+++metro</phpdac>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <div id="page-wraper">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget">
                            <div class="widget-title">
                                <h4><i class="icon-bar-chart"></i> Statistics </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                            </div>
                            <div class="widget-body" style="width: 96%">
                                <div class="plots"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN TRACKING CURVES PORTLET-->
                        <div class="widget purple">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Tracking Chart</h4>
							<span class="tools">
							<a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
							</span>
                            </div>
                            <div class="widget-body">
                                <div id="chart-1" class="chart"></div>
                            </div>
                        </div>
                        <!-- END TRACKING CURVES PORTLET-->
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span6">
                        <!-- BEGIN BASIC CHART PORTLET-->
                        <div class="widget orange">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Selection Chart</h4>
							<span class="tools">
							<a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
							</span>
                            </div>
                            <div class="widget-body">
                                <div id="chart-2" class="chart"></div>
                            </div>
                        </div>
                        <!-- END BASIC CHART PORTLET-->
                    </div>
                    <div class="span6">
                        <!-- BEGIN INTERACTIVE CHART PORTLET-->
                        <div class="widget green">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Live Chart</h4>
							<span class="tools">
							<a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
							</span>
                            </div>
                            <div class="widget-body">
                                <div id="chart-3" class="chart"></div>
                            </div>
                        </div>
                        <!-- END INTERACTIVE CHART PORTLET-->
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span6">
                        <!-- BEGIN DYNAMIC CHART PORTLET-->
                        <div class="widget yellow">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Support Chart</h4>
                                    <span class="tools">
                                    <a href="javascript:;" class="icon-chevron-down"></a>
                                    <a href="javascript:;" class="icon-remove"></a>
                                    </span>
                            </div>
                            <div class="widget-body">
                                <div id="chart-4" class="chart"></div>
                            </div>
                        </div>
                        <!-- END DYNAMIC CHART PORTLET-->
                    </div>
                    <div class="span6">
                        <!-- BEGIN Bar Chat PORTLET-->
                        <div class="widget blue">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Bar Chat</h4>
							<span class="tools">
							<a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
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
                        </div>
                        <!-- END Bar Chat PORTLET-->
                    </div>
                </div>


                <!-- BEGIN PIE CHART PORTLET-->
                <div class="row-fluid">
                    <div class="span6">
                        <div class="widget red">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Pie Chart</h4>
									<span class="tools">
									<a href="javascript:;" class="icon-chevron-down"></a>
                                    <a href="javascript:;" class="icon-remove"></a>
									</span>
                            </div>
                            <div class="widget-body">
                                <div id="graph1" class="chart"></div>
                            </div>
                        </div>
                        <div class="widget green">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Pie Chart</h4>
									<span class="tools">
									<a href="javascript:;" class="icon-chevron-down"></a>
                                    <a href="javascript:;" class="icon-remove"></a>
									</span>
                            </div>
                            <div class="widget-body">
                                <div id="graph2" class="chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="widget">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Pie Chart</h4>
									<span class="tools">
									<a href="javascript:;" class="icon-chevron-down"></a>
                                    <a href="javascript:;" class="icon-remove"></a>
									</span>
                            </div>
                            <div class="widget-body">
                                <div id="graph3" class="chart"></div>
                            </div>
                        </div>
                        <div class="widget purple">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Donut Chart</h4>
									<span class="tools">
									<a href="javascript:;" class="icon-chevron-down"></a>
                                    <a href="javascript:;" class="icon-remove"></a>
									</span>
                            </div>
                            <div class="widget-body">
                                <div id="donut" class="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PIE CHART PORTLET-->
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
   <script src="js/jquery.scrollTo.min.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->


   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!--script for this page only-->
   <script src="js/flot-chart.js"></script>
   <script src="js/custom-flot-chart.js"></script>

   <!-- END JAVASCRIPTS -->    
   
</body>
<!-- END BODY -->
</html>