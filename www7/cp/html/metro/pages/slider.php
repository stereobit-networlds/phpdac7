<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Slider</title>
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

   <link href="assets/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet"/>
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

            <div class="row-fluid">
                <div class="span12">
                  <!-- BEGIN SLIDER PORTLET-->
                  <div class="widget">
                        <div class="widget-title">
                           <h4><i class="icon-bar-chart"></i> jQuery UI Sliders </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                        </div>
                        <div class="widget-body">
                            <table class="table sliders">
                                <tbody>
                                <tr>
                                    <td style="width:12%">Default</td>
                                    <td>
                                        <div id="default-slider" class="slider"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Snap to Increments</td>
                                    <td>
                                        <div id="snap-inc-slider" class="slider"></div>
                                        <div class="slider-info">
                                            Amount ($50 increments):
                                            <span id="snap-inc-slider-amount"></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Range</td>
                                    <td>
                                        <div id="slider-range" class="slider"></div>
                                        <div class="slider-info">
                                            Price range:
                                            <span id="slider-range-amount"></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Maximum</td>
                                    <td>
                                        <div id="slider-range-max" class="slider"></div>
                                        <div class="slider-info">
                                            Maximum Value:
                                            <span id="slider-range-max-amount"></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Minimum</td>
                                    <td>
                                        <div id="slider-range-min" class="slider"></div>
                                        <div class="slider-info">
                                            Minimum Value:
                                            <span class="slider-info" id="slider-range-min-amount"></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Graphic EQ</td>
                                    <td>
                                        <div id="eq">
                                            <span>88</span>
                                            <span>77</span>
                                            <span>55</span>
                                            <span>33</span>
                                            <span>40</span>
                                            <span>45</span>
                                            <span>70</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bound to Select</td>
                                    <td>
                                        <select name="minbeds" id="minbeds">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Vertical</td>
                                    <td>
                                        <div class="slider-vertical-value">
                                            Value:
                                            <span  class="slider-info" id="slider-vertical-amount"></span>
                                        </div>
                                        <div id="slider-vertical" class="slider bg-green" style="height: 250px;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Range(Vertical)</td>
                                    <td>
                                        <div class="slider-vertical-value">
                                            Target(Millions):
                                            <span  class="slider-info" id="slider-range-vertical-amount"></span>
                                        </div>
                                        <div id="slider-range-vertical" class="slider bg-grey" style="height: 250px;"></div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                  </div>
                  <!-- END SLIDER PORTLET-->
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
   <script src="assets/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->

   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!--script for this page only-->
   <script src="js/sliders.js" type="text/javascript"></script>

   <!-- END JAVASCRIPTS -->
   <phpdac>frontpage.include_part use /parts/google-analytics.php+++meteor</phpdac>
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->        
</body>
<!-- END BODY -->
</html>