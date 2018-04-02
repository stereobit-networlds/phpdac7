<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Contact Us</title>
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
                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget">
                         <div class="widget-title">
                             <h4><i class="icon-envelope"></i> Contact Us </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                             <div class="contact-us">
                                 <div class="row-fluid">
                                     <div id="map-canvas" style="width: 100%; height: 400px"></div>
                                 </div>
                                 <div class="space15"></div>
                                 <h3>Our Contacts</h3>
                                 <div class="space15"></div>
                                 <div class="row-fluid">
                                     <div class="span4">
                                         <div class="widget red">
                                             <div class="widget-title">
                                                 <h4>Location</h4>
                                             </div>
                                             <div class="widget-body">
                                                 <p>Jonathon Smith <br>
                                                     House 31, Road 12, Sector 4<br>
                                                     Dream Town,  Dreamland 1230<br>
                                                     Phone: +966 1 000000<br>
                                                     Fax : 1234 5678 909</p>
                                             </div>
                                         </div>

                                     </div>
                                     <div class="span4">
                                         <div class="widget green">
                                             <div class="widget-title">
                                                 <h4>Online</h4>
                                             </div>
                                             <div class="widget-body">
                                                 <p> <strong>Email :</strong> info@vectorlab.com <br>
                                                     <strong>Support :</strong> support@vectorlab.com<br>
                                                     <strong>Live Chat :</strong> live@vectorlab.com<br>
                                                     <strong>Skype :</strong> skype@vectorlab.com<br>
                                                     <strong>Fax :</strong> 1234 5678 909</p>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="span4">
                                         <div class="widget orange">
                                             <div class="widget-title">
                                                 <h4>Social Network</h4>
                                             </div>
                                             <div class="widget-body">
                                                 <p>
                                                     <strong>Facebook :</strong> www.facebook.com/vectorlab1<br>
                                                     <strong>Twitter :</strong> www.twitter.com/vectorlab1<br>
                                                     <strong>Google + :</strong> www.googleplus.com/vectorlab1<br>
                                                 </p>
                                                 <div class="space15"></div>
                                                 <div class="space15"></div>
                                                 <div class="space10"></div>
                                             </div>
                                         </div>


                                     </div>
                                 </div>
                                 <div class="space20"></div>
                                 <div class="row-fluid">
                                     <div class="feedback">
                                         <h3>Feedback</h3>
                                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore</p>
                                         <div class="space20"></div>

                                         <form class="form-inline ">
                                             <div class="control-group">
                                                 <input type="text" placeholder="Name" class="span12">
                                             </div>
                                             <div class="control-group ">
                                                 <input type="text" placeholder="Email" class="span6 one-half">
                                                 <input type="text" placeholder="Phone" class="span6">
                                             </div>
                                             <div class="control-group">
                                                 <textarea placeholder="Message" class="span12" rows="5"></textarea>
                                             </div>
                                             <div class="text-center">
                                                 <button class="btn btn-success " type="submit">Submit</button>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
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
   <script src="js/jquery.scrollTo.min.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->

   <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!-- END JAVASCRIPTS -->

   <script>
       //google map
       function initialize() {
           var myLatlng = new google.maps.LatLng(-37.815207, 144.963937);
           var mapOptions = {
               zoom: 15,
               center: myLatlng,
               mapTypeId: google.maps.MapTypeId.ROADMAP
           }
           var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

           var marker = new google.maps.Marker({
               position: myLatlng,
               map: map,
               title: 'Hello World!'
           });
       }

       google.maps.event.addDomListener(window, 'load', initialize);


   </script>
   
	<phpdac>frontpage.include_part use /parts/google-analytics.php+++meteor</phpdac>
	<!-- e-Enterprise, stereobit.networlds (phpdac5) -->      
</body>
<!-- END BODY -->
</html>