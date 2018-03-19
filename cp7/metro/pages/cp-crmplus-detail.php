<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Crm+ details</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <!--link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" /-->
   <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="css/style.css" rel="stylesheet" />
   <link href="css/style-responsive.css" rel="stylesheet" />
   <link href="css/style-default.css" rel="stylesheet" id="style_color" /> 
    
   <!--link rel="stylesheet" type="text/css" href="assets/bootstrap-tree/bootstrap-tree/css/bootstrap-tree.css" /-->   
   
   	<link href="../javascripts/reservations/css/reservations.css" rel="stylesheet" />
	<link href="../javascripts/acal/css/acal.css" rel="stylesheet" />    
	<link href="../javascripts/mgantti/css/gantti.css" rel="stylesheet" />	
	
	<!--script src="../javascripts/jquery.js"></script>
    <script src="../javascripts/jquery-cookies.js"></script>
    <script src="../javascripts/jquery-base64.js"></script-->	   	

	<script src="js/jquery-1.8.3.min.js"></script>
	
	<!--link href="../javascripts/themes/redmond/jquery-ui.custom.css" rel="stylesheet" /> 
	<link href="../javascripts/jqgrid/css/ui.jqgrid.css" rel="stylesheet" />  
	
    <script src="../javascripts/jquery.min.js"></script>
	<script src="../javascripts/jqgrid/js/i18n/grid.locale-en.js"></script>			
	<script src="../javascripts/jqgrid/js/jquery.jqGrid.min.js"></script>
	<script src="../javascripts/themes/jquery-ui.custom.min.js"></script-->
   	
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body style="margin:0;padding:0">

	<div id="notification_div">
	<div id="notification_inner_div">
		<div id="notification_inner_cell_div"></div>
	</div>
	</div>

	<div id="crmsubdetails">
		<div id="content_div"></div> <!--reservation div-->
		<?METRO/INDEX?>
	</div>

   
   <script>
    <!--res-->
    <phpdac>reservations.javascript_code</phpdac>
	<!--acal-->
	<phpdac>crmacal.javascript_code</phpdac>
	<!--gantti-->
	<!--hpdac>crmgantti.javascript_code</phpda-->
   </script>

   <!--script src="js/jquery-1.8.3.min.js"></script-->
   <!--script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="assets/bootstrap-tree/bootstrap-tree/js/bootstrap-tree.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script-->

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->

   <!--common script for all pages-->
   <!--script src="js/common-scripts.js"></script-->
   
   <!--script for this page only-->
   <!--script src="js/tree.js"></script-->

   <!--script>
	function subdetails() {var str = arguments[0]; $('#crmsubdetails').load("cpcrmplus.php?t=cpcrmplusdata&module="+str);}
	function dashboard() {var str = arguments[0]; $('#crmsubdetails').load("cpcrmplus.php?t=cpcrmplusdashboard&module="+str);}
   </script-->
   
</body>
<!-- END BODY -->
</html>