<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>View campaign contents</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link href="css/style-default.css" rel="stylesheet" id="style_color" />

    <link href="assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />

    <link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen/chosen.css" />
    <link rel="stylesheet" type="text/css" href="assets/jquery-tags-input/jquery.tagsinput.css" />
    <link rel="stylesheet" href="assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

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
			<phpdac>frontpage.include_part use /parts/pageheader.php+++metro</phpdac>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->			 
			 <div class="row-fluid">
                 <div class="span12">
                    <!-- BEGIN  widget-->
					<div class="widget">
                            <div class="widget-title">
                                <h4><i class="icon-bar-chart"></i> <phpdac>i18nL.translate use CPFLOTCHARTS_DPC+CPFLOTCHARTS</phpdac></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                            </div>
                            <div class="widget-body" style="width: 96%">
                                <div class="plots"></div>
                            </div>
                    </div>
                    <div class="widget yellow">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> <phpdac>frontpage.slocale use _content</phpdac></h4>
							<span class="tools">
								<a href="javascript:;" class="icon-chevron-down"></a>
								<!--a href="javascript:;" class="icon-remove"></a-->
							</span>
							<div class="update-btn">
                                <a href="cpbulkmail.php?t=cpviewcamp&cid=<phpdac>fronthtmlpage.echostr use rcbulkmail.cid</phpdac>" class="btn"><i class="icon-repeat"></i> <phpdac>frontpage.slocale use _back</phpdac></a>
                            </div>
                        </div>	
						<div class="widget-body form">
						    <iframe src ="cpbulkmail.php?t=cpcampcontent&cid=<phpdac>fronthtmlpage.echostr use rcbulkmail.cid</phpdac>" width="100%" height="540px"></iframe>
							<!--?METRO/INDEX?-->
                        </div>
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

   <script src="js/jquery-1.8.2.min.js"></script>
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="assets/flot/jquery.flot.js"></script>
   <script src="assets/flot/jquery.flot.resize.js"></script>
   <script src="assets/flot/jquery.flot.pie.js"></script>
   <script src="assets/flot/jquery.flot.stack.js"></script>
   <script src="assets/flot/jquery.flot.crosshair.js"></script>
   <script src="js/jquery.blockui.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   <script type="text/javascript" src="assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
   <script type="text/javascript" src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
   <script type="text/javascript" src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
   <script type="text/javascript" src="assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
   <script src="assets/fancybox/source/jquery.fancybox.pack.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>


   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!--script for this page-->
   <script src="js/form-component.js"></script>
     
  <!-- END JAVASCRIPTS -->

   <script language="javascript" type="text/javascript">
   
	   <phpdac>cpflotcharts.jsflotMailcharts</phpdac>

       $(function() {
           $.configureBoxes();
       });

   </script>

   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->     

</body>
<!-- END BODY -->
</html>			 