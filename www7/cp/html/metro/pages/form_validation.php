<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Form Validation</title>
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
                     <!-- BEGIN VALIDATION STATES-->
                     <div class="widget red">
                         <div class="widget-title">
                             <h4><i class=" icon-key"></i> Basic validations </h4>
                            <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                            </span>
                         </div>
                         <div class="widget-body form">
                             <!-- BEGIN FORM-->
                             <form action="#" class="form-horizontal">
                                 <div class="control-group success">
                                     <label class="control-label" for="inputSuccess">First Name  </label>
                                     <div class="controls">
                                         <input type="text" class="span6" id="inputSuccess" />
                                         <span class="help-inline ">Successfully done</span>
                                     </div>
                                 </div>

                                 <div class="control-group error">
                                     <label class="control-label" for="inputError">Last Name</label>
                                     <div class="controls">
                                         <input type="text" class="span6" id="inputError" />
                                         <span class="help-inline">Aha you gave a wrong info</span>
                                     </div>
                                 </div>

                                 <div class="control-group warning">
                                     <label class="control-label" for="inputWarning">Email Address</label>
                                     <div class="controls">
                                         <input type="text" class="span6" id="inputWarning" />
                                         <span class="help-inline">Something went wrong</span>
                                     </div>
                                 </div>

                                 <div class="control-group success">
                                     <label class="control-label">Password</label>
                                     <div class="controls input-icon">
                                         <input type="text" class="span6 ">
                                         <span data-original-title="Success input!" class="input-success tooltips">
                                         <i class="icon-ok"></i>
                                         </span>
                                     </div>
                                 </div>
                                 <div class="control-group error">
                                     <label class="control-label">Confirm Password</label>
                                     <div class="controls input-icon">
                                         <input type="text" class="span6 ">
                                         <span data-original-title="please write a valid email" class="input-error tooltips">
                                         <i class="icon-exclamation-sign"></i>
                                         </span>
                                     </div>
                                 </div>
                                 <div class="control-group warning">
                                     <label class="control-label">Phone Number</label>
                                     <div class="controls input-icon">
                                         <input type="text" class="span6 ">
                                         <span data-original-title="please write a valid email" class="input-warning tooltips">
                                         <i class="icon-warning-sign"></i>
                                         </span>
                                     </div>
                                 </div>

                                 <div class="form-actions">
                                     <button type="submit" class="btn btn-success">Save</button>
                                     <button type="button" class="btn">Cancel</button>
                                 </div>
                             </form>
                             <!-- END FORM-->
                         </div>
                     </div>
                     <!-- END VALIDATION STATES-->
                 </div>
             </div>

            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="widget yellow">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Form Validation</h4>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"></a>
                                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                <a href="javascript:;" class="reload"></a>
                                <a href="javascript:;" class="remove"></a>
                            </div>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->

                            <form class="cmxform form-horizontal" id="commentForm" method="get" action="">
                                <div class="control-group ">
                                    <label for="cname" class="control-label">Name (required)</label>
                                    <div class="controls">
                                        <input class="span6 " id="cname" name="name" minlength="2" type="text" required />
                                    </div>
                                </div>
                                <div class="control-group ">
                                    <label for="cemail" class="control-label">E-Mail (required)</label>
                                    <div class="controls">
                                        <input class="span6 " id="cemail" type="email" name="email" required />
                                    </div>
                                </div>
                                <div class="control-group ">
                                    <label for="curl" class="control-label">URL (optional)</label>
                                    <div class="controls">
                                        <input class="span6 " id="curl" type="url" name="url" />
                                    </div>
                                </div>
                                <div class="control-group ">
                                    <label for="ccomment" class="control-label">Your Comment (required)</label>
                                    <div class="controls">
                                        <textarea class="span6 " id="ccomment" name="comment" required></textarea>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button class="btn btn-success" type="submit">Save</button>
                                    <button class="btn" type="button">Cancel</button>
                                </div>


                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Advanced form Validation</h4>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"></a>
                                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                <a href="javascript:;" class="reload"></a>
                                <a href="javascript:;" class="remove"></a>
                            </div>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <form class="cmxform form-horizontal" id="signupForm" method="get" action="">
                                <div class="control-group ">
                                    <label for="firstname" class="control-label">Firstname</label>
                                    <div class="controls">
                                        <input class="span6 " id="firstname" name="firstname" type="text" />
                                    </div>
                                </div>
                                <div class="control-group ">
                                    <label for="lastname" class="control-label">Lastname</label>
                                    <div class="controls">
                                        <input class="span6 " id="lastname" name="lastname" type="text" />
                                    </div>
                                </div>
                                <div class="control-group ">
                                    <label for="username" class="control-label">Username</label>
                                    <div class="controls">
                                        <input class="span6 " id="username" name="username" type="text" />
                                    </div>
                                </div>
                                <div class="control-group ">
                                    <label for="password" class="control-label">Password</label>
                                    <div class="controls">
                                        <input class="span6 " id="password" name="password" type="password" />
                                    </div>
                                </div>
                                <div class="control-group ">
                                    <label for="confirm_password" class="control-label">Confirm Password</label>
                                    <div class="controls">
                                        <input class="span6 " id="confirm_password" name="confirm_password" type="password" />
                                    </div>
                                </div>
                                <div class="control-group ">
                                    <label for="email" class="control-label">Email</label>
                                    <div class="controls">
                                        <input class="span6 " id="email" name="email" type="email" />
                                    </div>
                                </div>
                                <div class="control-group ">
                                    <label for="agree" class="control-label">Agree to Our Policy</label>
                                    <div class="controls">
                                        <input  type="checkbox" class="checkbox" id="agree" name="agree" />
                                    </div>
                                </div>
                                <div class="control-group ">
                                    <label for="newsletter" class="control-label">Receive the Newsletter</label>
                                    <div class="controls">
                                        <input  type="checkbox" class="checkbox" id="newsletter" name="newsletter" />
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button class="btn btn-success" type="submit">Save</button>
                                    <button class="btn" type="button">Cancel</button>
                                </div>

                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END VALIDATION STATES-->
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
   <script type="text/javascript" src="js/jquery.validate.min.js"></script>
   <script type="text/javascript" src="js/additional-methods.min.js"></script>
   <script type="text/javascript" src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>

   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>
   <!--script for this page-->
   <script src="js/form-validation-script.js"></script>

   <!-- END JAVASCRIPTS -->
   <phpdac>frontpage.include_part use /parts/google-analytics.php+++meteor</phpdac>
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->     

</body>
<!-- END BODY -->
</html>