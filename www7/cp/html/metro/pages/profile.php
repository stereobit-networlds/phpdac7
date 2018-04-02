<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Profile</title>
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
                 <!-- BEGIN PROFILE PORTLET-->
                 <div class=" profile span12">
                     <div class="span2">
                         <div class="profile-photo">
                             <img src="img/lock-thumb.jpg" alt="">
                             <a href="javascript:;" class="edit" title="Edit Photo">
                                 <i class="icon-pencil"></i>
                             </a>
                         </div>
                         <a href="profile.html" class="profile-features active">
                             <i class=" icon-user"></i>
                             <p class="info">Profile</p>
                         </a>
                         <a href="profile_activities.html" class="profile-features ">
                             <i class=" icon-calendar"></i>
                             <p class="info">Activities</p>
                         </a>
                         <a href="profile_contact.html" class="profile-features ">
                             <i class=" icon-phone"></i>
                             <p class="info">Contact</p>
                         </a>
                     </div>
                     <div class="span10">
                         <div class="profile-head">
                             <div class="span4">
                                 <h1>Jonathan Smith</h1>
                                 <p>Lead Designer at <a href="#">Vectorlab Inc.</a></p>
                             </div>

                             <div class="span4">
                                 <ul class="social-link-pf">
                                     <li><a href="#">
                                         <i class="icon-facebook"></i>
                                     </a></li>
                                     <li><a href="#">
                                         <i class="icon-twitter"></i>
                                     </a></li>
                                     <li><a href="#">
                                         <i class="icon-linkedin"></i>
                                     </a></li>
                                 </ul>
                             </div>

                             <div class="span4">
                                 <a href="edit_profile.html" class="btn btn-edit btn-large pull-right mtop20"> Edit Profile </a>
                             </div>
                         </div>
                         <div class="space15"></div>
                         <div class="row-fluid">
                             <div class="span8 bio">
                                 <h2>About Smith</h2>
                                 <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Donec ut volutpat metus. Aliquam tortor lorem, fringilla tempor dignissim at, pretium et arcu. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.</p>
                                 <div class="space15"></div>
                                 <h2>Bio Graph</h2>
                                 <p><label>First Name </label>: Jonathan</p>
                                 <p><label>Last Name </label>: Smith</p>
                                 <p><label>Country </label>: Australia</p>
                                 <p><label>Bithday </label>: 13 July 1983</p>
                                 <p><label>Occupation </label>: Designer</p>
                                 <p><label>Email </label>: <a href="#">smith@vectorlab.net</a></p>
                                 <p><label>Phone </label>: (12) 03 4567890</p>
                                 <p><label>Website Url </label>: <a href="#">http://www.demowebsite.com</a></p>
                                 <div class="space15"></div>
                                 <hr>
                                 <div class="space15"></div>

                                 <h2>Project Progress</h2>
                                 <ul class="unstyled">
                                     <li>
                                           Envato Website <strong class="label"> 48%</strong>
                                         <div class="space10"></div>
                                         <div class="progress">
                                             <div class="bar" style="width: 48%;"></div>
                                         </div>
                                     </li>
                                     <li>
                                         Themeforest CMS Dashboard <strong class="label label-success"> 85%</strong>
                                         <div class="space10"></div>
                                         <div class="progress progress-success">
                                             <div class="bar" style="width: 85%;"></div>
                                         </div>
                                     </li>
                                     <li>
                                         VectorLab Portfolio <strong class="label label-important"> 65%</strong>
                                         <div class="space10"></div>
                                         <div class="progress progress-danger">
                                             <div class="bar" style="width: 65%;"></div>
                                         </div>
                                     </li>

                                 </ul>
                                 <div class="text-center">
                                     <button class="btn btn-primary ">All Projects</button>
                                 </div>
                                 <div class="space20"></div>

                             </div>
                             <div class="span4">
                                 <div class="profile-side-box red">
                                     <h1>Recommended By</h1>
                                     <div class="desk">
                                         <div class="row-fluid">
                                             <div class="span4">
                                                <div class="text-center">
                                                    <a href="#"><img src="img/avatar1.jpg" alt=""></a>
                                                    <p><a href="#">Fill Martin</a></p>
                                                </div>
                                             </div>
                                             <div class="span4">
                                                 <div class="text-center">
                                                     <a href="#"><img src="img/avatar2.jpg" alt=""></a>
                                                     <p><a href="#">Scatel Filip</a></p>
                                                 </div>
                                             </div>
                                             <div class="span4">
                                                 <div class="text-center">
                                                     <a href="#"><img src="img/avatar3.jpg" alt=""></a>
                                                     <p><a href="#">Paul Robin</a></p>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="profile-side-box green">
                                     <h1>Experience</h1>
                                     <div class="desk">
                                         <div class="row-fluid experience">
                                             <h4>Envato</h4>
                                             <p>Duration: 4 years as Senior Designer from June 2033 to June 2007</p>
                                             <a href="#">www.abccompany.com</a>
                                         </div>
                                         <div class="space10"></div>
                                         <div class="row-fluid experience">
                                             <h4>Themeforest</h4>
                                             <p>Duration: 4 years as Senior Designer from June 2033 to June 2007</p>
                                             <a href="#">www.abccompany.com</a>
                                         </div>
                                         <div class="space10"></div>
                                         <div class="row-fluid experience">
                                             <h4>Vector Lab</h4>
                                             <p>Duration: 4 years as Senior Designer from June 2033 to June 2007</p>
                                             <a href="#">www.abccompany.com</a>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- END PROFILE PORTLET-->
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

   <script src="js/jquery.scrollTo.min.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->

   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!-- END JAVASCRIPTS --> 
   <phpdac>frontpage.include_part use /parts/google-analytics.php+++meteor</phpdac>
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->        
</body>
<!-- END BODY -->
</html>