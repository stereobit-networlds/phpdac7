<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>New app</title>
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

	<link href="../javascripts/themes/redmond/jquery-ui.custom.css" rel="stylesheet" /> 
	<link href="../javascripts/jqgrid/css/ui.jqgrid.css" rel="stylesheet" />  
	
    <!--script src="../javascripts/jquery.min.js"></script-->
	<script src="js/jquery-1.8.3.min.js"></script <!-- error in js buttons-->
	<script src="../javascripts/jqgrid/js/i18n/grid.locale-en.js"></script>			
	<script src="../javascripts/jqgrid/js/jquery.jqGrid.min.js"></script>
	<script src="../javascripts/themes/jquery-ui.custom.min.js"></script>    
   	
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
                    <!-- BEGIN SAMPLE FORMPORTLET-->
                    <div class="widget red">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> New Application</h4>
                            <!--span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span-->
                        </div>
                        <div class="widget-body">
                            <!-- BEGIN FORM-->
                            <form name="subins" method="post" action="cpulists.php" class="form-horizontal">

                            <div class="control-group">
                                <label class="control-label">Email</label>
                                <div class="controls">
                                    <div class="input-icon left">
                                        <i class="icon-envelope"></i>
                                        <input class=" " id="email" name="email" type="text" placeholder="Email Address" />
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Theme</label>
                                <div class="controls">
                                    <select id="theme" name="theme" class="span6 " data-placeholder="Choose an existing mailing list" tabindex="1">
                                        <option value="">Select...</option>
										<!--hpdac>rculists.viewUList</phpda-->
                                    </select>
                                </div>
                            </div>
							
                            <div class="control-group">
                                <label class="control-label">Title</label>
                                <div id="edit_ulist" class="controls">
                                    <input id="appname" name="appname" type="text" class="span6 " />
                                    <span class="help-inline">Enter an app name</span>
                                </div>
                            </div>							

                            <div class="control-group">
                                <label class="control-label">Details</label>
                                <div id="edit_subscribers" class="controls">
                                    <textarea name="details" class="span6 " rows="3"></textarea>
                                </div>
                            </div>
							
                            <div class="control-group">
                                <label class="control-label">Prefix</label>
                                <div class="controls">
                                            <div id="normal-toggle-button">
                                                <input id="prefix" name="prefix" type="checkbox" />
                                            </div>
                                            <!--div id="success-toggle-button">
                                                <input type="checkbox" class="toggle" checked="checked" />
                                            </div>
                                            <div id="warning-toggle-button">
                                                <input type="checkbox" class="toggle" checked="checked" />
											</div-->
                                </div>
                            </div>								
							
							<div class="control-group">
                                <label class="control-label">Progress</label>
                                <div class="controls">
                                    <!--div class="input-prepend">
                                        <span class="add-on">;</span>
										<input name="separator" class=" " type="text" placeholder="Email Separator" />
                                    </div-->
									<ul class="unstyled">
									<li>
										<strong class="label"> 0%</strong>
										<div class="space10"></div>
											<div class="progress">
											<div style="width: 0%;" class="bar"></div>
										</div>
									</li>
									</ul>	
									<div id="message_p"></div>									
                                </div>
                            </div>						
							
                            <div class="form-actions">
                                <!--button type="submit" class="btn btn-success">Submit</button>
								<input type="hidden" name="FormName" value="cpmnew" />
								<input type="hidden" name="FormAction" value="cpmnew" /-->
								
								<button onClick="start()" class='btn btn-danger'>Start</button>
                            </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
            </div>			
			
			
            <div class="row-fluid">
                 <div id="newappdetails" class="span12">
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
     
   <!-- END JAVASCRIPTS --> 

	<!-- e-Enterprise, stereobit.networlds (phpdac5) -->   
</body>
<!-- END BODY -->
</html>