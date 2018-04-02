<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Collections</title>
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

    <link href="assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />

    <link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen/chosen.css" />


    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> 
	
   <script src="http://www.xix.gr/ckeditor/ckeditor.js"></script>	
   	
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
			
             <!--div class="row-fluid">
                 <div class="span12">
                    <div class="widget yellow">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Content</h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <a href="javascript:;" class="icon-remove"></a>
                           </span>
                        </div>	
						<div class="widget-body form">						
							<?METRO/INDEX?>
                        </div>
                    </div>					 
                 </div>
             </div-->
			 
	
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORMPORTLET-->
                    <div class="widget orange">
                        <div class="widget-title">
                            <h4>
                                <i class="icon-reorder"></i> Match fields
                            </h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <!-- BEGIN DUAL SELECT-->
                            <form name="form1" method="post" action="#" id="form1">
                                <div>
                                    <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKMTk5MjI0ODUwOWRkJySmk0TGHOhSY+d9BU9NHeCKW6o=" />
                                </div>
                                <div>								
                                    <table style="width: 100%;" class="">
                                        <tr>
                                            <td style="width: 50%">
                                                <div class="control-group">
												<label class="control-label">Select db field</label>
													<div class="controls">
													<select name="dbfield" class="span6 " multiple="multiple" data-placeholder="Choose db field" tabindex="1">
														<phpdac>rccollections.viewDBKeys</phpdac>
													</select>
													</div>
												</div>	
                                            </td>
                                            
                                            <td style="width: 50%">
                                                <div class="control-group">
												<label class="control-label">Select xml field</label>
													<div class="controls">
													<select name="xmlfield" class="span6 " multiple="multiple" data-placeholder="Choose xml field" tabindex="1">
														<phpdac>rccollections.viewXMLKeys</phpdac>
													</select>
													</div>
												</div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
								
								<div class="mtop20">
									<div class="control-group">
										<label class="control-label">Procced</label>
										<div class="controls">
											<div id="normal-toggle-button">
												<input name="goxml" type="checkbox">
											</div>
										</div>
                                    </div>						
								</div>	
                                <div class="mtop20">
									<div class="control-group">
                                        <label class="control-label">Save As:</label>
                                        <div class="controls">
                                            <input name="xmlfile" type="text" value="<phpdac>fronthtmlpage.echostr use rccollections.xmlfile</phpdac>" class="span6" />
											<span>
												<phpdac>rccollections.viewXMLPresetsSelect</phpdac>
											</span>
                                        </div>
                                    </div>
									<phpdac>rccollections.postXMLSubmit use cpsavexml+Ok+btn</phpdac>
                                </div>
                            </form>
                            <!-- END DUAL SELECT-->
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
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
   <!--script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script-->
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <!--script type="text/javascript" src="assets/bootstrap/js/bootstrap-fileupload.js"></script-->
   <script src="js/jquery.blockui.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->

   <script type="text/javascript" src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
   <script type="text/javascript" src="assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>

   <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
   <script src="js/jQuery.dualListBox-1.3.js" language="javascript" type="text/javascript"></script>


   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!--script for this page-->
   <script src="js/form-component.js"></script>
  <!-- END JAVASCRIPTS -->

   <script language="javascript" type="text/javascript">

       $(function() {

           $.configureBoxes();

       });

   </script>
   <!-- END JAVASCRIPTS --> 

	<phpdac>frontpage.include_part use /parts/google-analytics.php+++metro</phpdac>
	<!-- e-Enterprise, stereobit.networlds (phpdac5) -->   
</body>
<!-- END BODY -->
</html>