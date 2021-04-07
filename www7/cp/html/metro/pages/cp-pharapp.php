<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Phar application</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
    <!--link href="assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" /-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link href="css/style-default.css" rel="stylesheet" id="style_color" />

    <link href="assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
	
	<link rel="stylesheet" href="css/zebra/flat/zebra_dialog.css" type="text/css">
   </script>		

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
				
					<?METRO/INDEX?>
										
                    <div class="widget box purple">
                        <div class="widget-title">
                            <h4>
                                <i class="icon-reorder"></i> <phpdac>cmsrt.slocale use _pharapp</phpdac></span>
                            </h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                        </span>
                        </div>
                        <div class="widget-body">
                            <form id="tForm" method="post" action="cppharapp.php?t=cpsavephar" class="form-horizontal">
								<input type="hidden" name="FormName" value="savephar" />
								<input type="hidden" name="FormAction" value="cpsavephar" />
								
                                <div id="tabsleft" class="tabbable tabs-left">
                                <ul>
                                    <li><a href="#tabsleft-tab1" data-toggle="tab"><span class="strong"><phpdac>cmsrt.slocale use _options</phpdac></span></a></li>
									<li><a href="#tabsleft-tab2" data-toggle="tab"><span class="strong"><phpdac>cmsrt.slocale use _messages</phpdac></span></a></li>
									<li><a href="#tabsleft-tab3" data-toggle="tab"><span class="strong"><phpdac>cmsrt.slocale use _tail</phpdac></span></a></li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane" id="tabsleft-tab1">	
										<div class="control-group">
											<label class="control-label">
												<phpdac>cmsrt.slocale use _usecp</phpdac>
											</label>										
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="usecp" type="checkbox" <phpdac>cmsrt.getSubmitedParam use usecp+checked</phpdac>>
												</div>
											</div>												
										</div>
										<div class="control-group">
											<div id="select_template" class="control-group">
												<label class="control-label"><phpdac>cmsrt.slocale use _selecttmpl</phpdac></label>
												<div id="template_page" class="controls">
													<select name="selectedtemplate" class="span6 chzn-select" data-placeholder="Choose a template" tabindex="1">
														<option value=""><phpdac>cmsrt.slocale use _selectnone</phpdac></option>
														<phpdac>rcpharapp.pharTemplates</phpdac>										
													</select>
												</div>								
											</div>										
										</div>		
                                    </div>	
									<div class="tab-pane" id="tabsleft-tab2">
                                    	<h3><phpdac>cmsrt.slocale use _messages</phpdac></h3>
										<div class="control-group">
											<label class="control-label"><phpdac>cmsrt.slocale use _messages</phpdac></label>
											<div class="controls">
												<select id="messages" multiple="multiple" style="height:100px;width:100%;">
												<phpdac>rcpharapp.viewMessages</phpdac>
												</select>
											</div>
										</div>									
                                    </div>


                                    <ul class="pager wizard">
										<li class="next"><a href="javascript:document.getElementById('tForm').submit();">Submit</a></li>
                                    </ul>
                                </div>
                            </div>
                            </form>
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
   <script src="js/jquery-1.8.3.min.js"></script>
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="assets/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
   <script src="js/jquery.blockui.js"></script>
   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   
   <script type="text/javascript" src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>   
   
   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>
   <!--script for this page-->
   <script src="js/form-wizard.js"></script>

    <!-- stream dialog -->
   <script type="text/javascript" src="js/zebra/zebra_dialog.js"></script>
   <script language="JavaScript">		
		setInterval(function() {<phpdac>rcpharapp.streamDialog</phpdac>}, 30000);	
   </script>
   <!-- end stream dialog -->    
   <!-- END JAVASCRIPTS -->

</body>
<!-- END BODY -->
</html>