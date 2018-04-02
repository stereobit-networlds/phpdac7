<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Items</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />

	<link href="../javascripts/themes/redmond/jquery-ui.custom.css" rel="stylesheet" /> 
	<link href="../javascripts/jqgrid/css/ui.jqgrid.css" rel="stylesheet" />  
	
    <script src="../javascripts/jquery.min.js"></script>
	<script src="../javascripts/jqgrid/js/i18n/grid.locale-en.js"></script>			
	<script src="../javascripts/jqgrid/js/jquery.jqGrid.min.js"></script>
	<script src="../javascripts/themes/jquery-ui.custom.min.js"></script>    
   	
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body style="margin:0;padding:0">
<div id="trans"></div>
<?METRO/INDEX?>  
<script>
  function showtrans2() { var str = arguments[0]; $('#trans').load("cptransactions.php?t=cploadframe&tid="+str);}
  function showtrans() { var str = arguments[0]; sndReqArg('cptransactions.php?t=cploadframe&tid='+str,'shopdetails');}
  <phpdac>rccontrolpanel.javascript</phpdac>
</script>
</body>
<!-- END BODY -->
</html>