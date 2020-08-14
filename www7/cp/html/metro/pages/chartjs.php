<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Chartjs</title>
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
                    <div class="span6">
                        <!-- BEGIN CHART PORTLET-->
                        <div class="widget green">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Doughnut</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <div class="text-center">
                                    <canvas id="doughnut" height="300" width="400"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- END CHART PORTLET-->
                    </div>
                    <div class="span6">
                        <!-- BEGIN CHART PORTLET-->
                        <div class="widget orange">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"> </i> Line</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <div class="text-center">
                                    <canvas id="line" height="300" width="450"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- END CHART PORTLET-->
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span6">
                        <!-- BEGIN CHART PORTLET-->
                        <div class="widget purple">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> PolarArea</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <div class="text-center">
                                    <canvas id="polarArea" height="300" width="400"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- END CHART PORTLET-->
                    </div>
                    <div class="span6">
                        <!-- BEGIN CHART PORTLET-->
                        <div class="widget blue">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Bar</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <div class="text-center">
                                    <canvas id="bar" height="300" width="500"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- END CHART PORTLET-->
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span6">
                        <!-- BEGIN CHART PORTLET-->
                        <div class="widget">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Pie</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <div class="text-center">
                                    <canvas id="pie" height="300" width="400"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- END CHART PORTLET-->
                    </div>
                    <div class="span6">
                        <!-- BEGIN CHART PORTLET-->
                        <div class="widget yellow">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Radar</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <div class="text-center">
                                    <canvas id="radar" height="300" width="400"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- END CHART PORTLET-->
                    </div>
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
   <script src="assets/chart-master/Chart.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->


   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!--script for this page only-->
   <script src="js/all-chartjs.js"></script>

   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>