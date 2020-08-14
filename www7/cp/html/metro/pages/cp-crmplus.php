<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Crm+</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="css/style.css" rel="stylesheet" />
   <link href="css/style-responsive.css" rel="stylesheet" />
   <link href="css/style-default.css" rel="stylesheet" id="style_color" />
   
    <link href="../javascripts/reservations/css/reservations.css" rel="stylesheet" />
	<link href="../javascripts/acal/css/acal.css" rel="stylesheet" /> 
    <link href="../javascripts/mgantti/css/gantti.css" rel="stylesheet" />	

	<link href="../javascripts/themes/redmond/jquery-ui.custom.css" rel="stylesheet" /> 
	<link href="../javascripts/jqgrid/css/ui.jqgrid.css" rel="stylesheet" />  
	
    <!--script src="../javascripts/jquery.min.js"></script-->
	<script src="js/jquery-1.8.3.min.js"></script>
	<script src="../javascripts/jqgrid/js/i18n/grid.locale-en.js"></script>			
	<script src="../javascripts/jqgrid/js/jquery.jqGrid.min.js"></script>
	<script src="../javascripts/themes/jquery-ui.custom.min.js"></script>    
   	
	<!--script src="http://www.stereobit.gr/ckeditor/ckeditor.js"></script-->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">

	<div id="notification_div">
	<div id="notification_inner_div">
		<div id="notification_inner_cell_div"></div>
	</div>
	</div>

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
					 <div id="content_div"></div> <!--reservation div-->
					 <?METRO/INDEX?>
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
   
   <!--script src="js/jquery-1.8.3.min.js"></script-->
   
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->

   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>
   
    <script>
    <!--res-->
    <phpdac>reservations.javascript_code</phpdac>
	<!--acal-->
	<phpdac>crmacal.javascript_code</phpdac>
	<!--gantti-->
	<!--hpdac>crmgantti.javascript_code</phpda-->
   </script>  

   <!-- END JAVASCRIPTS -->  
   <script>
	function udetails() {var str = arguments[0]; $('#crmdetails').load("cpcrmplus.php?t=cpcrmgant&id="+str);}
	function cdetails() {var str = arguments[0]; $('#crmdetails').load("cpcrmplus.php?t=cpcrmgant&id="+str);}
   </script>
</body>
<!-- END BODY -->
</html>