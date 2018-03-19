<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Relation details</title>
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
<?METRO/INDEX?>

   <script>
	function joincat() {
		var itm = arguments[0]; 
		var join = arguments[1];
		$('#saverel').load("cpitemrel.php?t=cpireljoincat&item="+itm+"&jcat="+join);}
	function joinitem() {
		var itm = arguments[0]; 
		var join = arguments[1];
		$('#saverel').load("cpitemrel.php?t=cpireljoinitem&item="+itm+"&jitem="+join);}		
   </script>  
   
</body>
<!-- END BODY -->
</html>