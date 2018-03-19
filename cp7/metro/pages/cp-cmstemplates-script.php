<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Tscript</title>
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
<body style="margin:0;padding:0">

             <div class="row-fluid">
                 <div class="span12">
				 	<?METRO/INDEX?>	
					<div id="edit_script" class="control-group">
						<form name="form1" method="post" action="#" class="form-horizontal">
							<textarea wrap="virtual" id="scriptdata" class="span12" name="scriptdata" rows="20"><phpdac>rccmstemplates.fetchScriptData</phpdac></textarea>
							<input type="hidden" name="id" value="<phpdac>fronthtmlpage.echostr use id</phpdac>">									
							<input type="hidden" name="module" value="<phpdac>fronthtmlpage.echostr use module</phpdac>">
							<input type="hidden" name="FormName" value="scriptform">									
							<input type="hidden" name="FormAction" value="cpcmsformsubdetail">									
							<input type="submit" value="Save">										
						</form>
					</div>				
                 </div>
             </div>

   <script src="js/jquery-1.8.3.min.js"></script>
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="assets/bootstrap-tree/bootstrap-tree/js/bootstrap-tree.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->

   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script> 
   
	<script language="Javascript" type="text/javascript" src="http://www.stereobit.gr/javascripts/edit_area/edit_area_full.js"></script>
	<script language="Javascript" type="text/javascript">
		// initialisation
		editAreaLoader.init({
			id: "scriptdata"	
			,start_highlight: true	
			,allow_resize: "both"
			,allow_toggle: false
			,word_wrap: true
			,language: "en"
			,syntax: "php"
			,toolbar: "undo, redo, |, select_font, |, change_smooth_selection, highlight, reset_highlight"			
			,replace_tab_by_spaces: 4
			,save_callback: "submitform"
		});		
		
	function submitform() { document.form1.submit();}	
	</script>	   
   
</body>
<!-- END BODY -->
</html>