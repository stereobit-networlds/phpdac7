<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Crm profile contact</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="stereobit.networlds" name="author" />
   <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" />
   <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="css/style.css" rel="stylesheet" />
   <link href="css/style-responsive.css" rel="stylesheet" />
   <link href="css/style-default.css" rel="stylesheet" id="style_color" />
   
   <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
   <link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" />
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
				<phpdac>rccrmtrace.select_timeline use crm-cptimeline</phpdac>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
             <div class="row-fluid">
                 <!-- BEGIN PROFILE PORTLET-->
                 <div class=" profile span12">
                     <div class="span2">
                         <div class="profile-photo">
                             <img src="img/lock-thumb.jpg" alt="">
                             <a href="javascript:vdetails('<phpdac>rccrmtrace.currentVisitor use email</phpdac>');" class="edit" title="Dashboard">
                                 <i class="icon-pencil"></i>
                             </a>
                         </div>
                         <a href="cpcrmtrace.php?t=cpcrmprofile&v=<phpdac>rccrmtrace.currentVisitor</phpdac>&<phpdac>rccrmtrace.getDateRange</phpdac>" class="profile-features ">
                             <i class=" icon-user"></i>
                             <p class="info">Profile</p>
                         </a>
                         <a href="cpcrmtrace.php?t=cpcrmactivities&v=<phpdac>rccrmtrace.currentVisitor</phpdac>&<phpdac>rccrmtrace.getDateRange</phpdac>" class="profile-features">
                             <i class=" icon-calendar"></i>
                             <p class="info">Activities</p>
                         </a>
                         <a href="cpcrmtrace.php?t=cpcrmtimeline&v=<phpdac>rccrmtrace.currentVisitor</phpdac>&<phpdac>rccrmtrace.getDateRange</phpdac>" class="profile-features">
                             <i class=" icon-th-list"></i>
                             <p class="info">Timeline</p>
                         </a>							 
                         <a href="cpcrmtrace.php?t=cpcrmcontact&v=<phpdac>rccrmtrace.currentVisitor</phpdac>&<phpdac>rccrmtrace.getDateRange</phpdac>" class="profile-features active">
                             <i class=" icon-phone"></i>
                             <p class="info">Contact</p>
                         </a>
                     </div>
                     <div class="span10">
                         <div class="profile-head">
                             <div class="span4">
                                 <h1><phpdac>rccrmtrace.readContactName</phpdac></h1>
                                 <p><phpdac>rccrmtrace.currentVisitor use auto</phpdac></p>
                             </div>

                             <div class="span4">
                                 <ul class="social-link-pf">
                                     <li><a href="<phpdac>rccrmtrace.readContactWeb use facebook</phpdac>" target="_blank">
                                         <i class="icon-facebook"></i>
                                     </a></li>
                                     <li><a href="<phpdac>rccrmtrace.readContactWeb use twitter</phpdac>" target="_blank">
                                         <i class="icon-twitter"></i>
                                     </a></li>
                                     <li><a href="<phpdac>rccrmtrace.readContactWeb use linkedin</phpdac>" target="_blank">
                                         <i class="icon-linkedin"></i>
                                     </a></li>
                                 </ul>
                             </div>

                             <div class="span4">
                                 <a href="cpcrmtrace.php?t=cpcrmeditprofile&v=<phpdac>rccrmtrace.currentVisitor</phpdac>" class="btn btn-edit btn-large pull-right mtop20"> Edit Profile </a>
                             </div>
                         </div>
                         <div class="space15"></div>
						 
						 <?METRO/INDEX?>
						 
                         <div class="row-fluid"> 
                             <div class="span8 profile-contact">
                                 <h2>Contact</h2>
                                 <strong><phpdac>rccrmtrace.readContactField use firstname+1</phpdac> <phpdac>rccrmtrace.readContactField use lastname+1</phpdac></strong>
                                 <p><phpdac>rccrmtrace.readContactField use occupation+1</phpdac></p>
                                 <p><phpdac>rccrmtrace.readContactField use address+1</phpdac></p>

                                 <br>

                                 <strong>
                                     Phone
                                 </strong>
                                 <br>
                                 <phpdac>rccrmtrace.readContactField use phone</phpdac>
                                 <br><br>
                                 <strong>
                                     Email
                                 </strong>
                                 <br>
								 <a href="cpcrmoffers.php?v=<phpdac>rccrmtrace.readContactField use email</phpdac>"><phpdac>rccrmtrace.readContactField use email</phpdac></a>
                                 <br>
                                 <br>

                                 <strong>
                                     Skype
                                 </strong>
                                 <br>

                                 <phpdac>rccrmtrace.readContactField use skype</phpdac>
                                 <br>
                                 <br>
                                 <strong>
                                     Website
                                 </strong>
                                 <br>
                                 <a href="<phpdac>rccrmtrace.readContactWeb use website</phpdac>" target="_blank"><phpdac>rccrmtrace.readContactField use website</phpdac></a>

                                 <div class="space20"></div>

                             </div>
                             <div class="span4">
                                 <div class="profile-side-box red">
                                     <h1>Profile</h1>
                                     <div class="desk">
                                         <div class="row-fluid">
                                             <div class="span4">
                                                <div class="text-center">
                                                    <a href="cpcrmtrace.php?t=cpcrmuser&v=<phpdac>rccrmtrace.currentVisitor</phpdac>"><img src="img/avatar1.jpg" alt=""></a>
                                                    <p><a href="cpcrmtrace.php?t=cpcrmuser&v=<phpdac>rccrmtrace.currentVisitor</phpdac>">User</a></p>
                                                </div>
                                             </div>
                                             <div class="span4">
                                                 <div class="text-center">
                                                     <a href="cpcrmtrace.php?t=cpcrmcust&v=<phpdac>rccrmtrace.currentVisitor</phpdac>"><img src="img/avatar2.jpg" alt=""></a>
                                                     <p><a href="cpcrmtrace.php?t=cpcrmcust&v=<phpdac>rccrmtrace.currentVisitor</phpdac>">Customer</a></p>
                                                 </div>
                                             </div>
                                             <div class="span4">
                                                 <div class="text-center">
                                                     <a href="cpcrmtrace.php?t=cpcrmcont&v=<phpdac>rccrmtrace.currentVisitor</phpdac>"><img src="img/avatar3.jpg" alt=""></a>
                                                     <p><a href="cpcrmtrace.php?t=cpcrmcont&v=<phpdac>rccrmtrace.currentVisitor</phpdac>">Contact</a></p>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
							     <div class="profile-side-box green">
                                     <h1>Mail responds</h1>
                                     <div class="desk">
									     <span><phpdac>rccrmtrace.mailResponds use crm-responds</phpdac></span>
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
   <script src="assets/flot/jquery.flot.js"></script>
   <script src="assets/flot/jquery.flot.resize.js"></script>
   <script src="assets/flot/jquery.flot.pie.js"></script>
   <script src="assets/flot/jquery.flot.stack.js"></script>
   <script src="assets/flot/jquery.flot.crosshair.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   <script type="text/javascript" src="assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
   <script type="text/javascript" src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
   
   <script type="text/javascript" src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
   <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
   <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
   
   <script src="js/jquery.scrollTo.min.js"></script>


   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!--script for this page only-->
   <script src="js/flot-chart.js"></script>
   <script src="js/custom-flot-chart.js"></script>   
   <script language="javascript" type="text/javascript">
	   
    //chosen select
    $(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true});
	   
	   
    //daterange picker

    $('#reservation').daterangepicker();

    $('#reportrange').daterangepicker(
        {
            ranges: {
                'Today': ['today', 'today'],
                'Yesterday': ['yesterday', 'yesterday'],
                'Last 7 Days': [Date.today().add({ days: -6 }), 'today'],
                'Last 30 Days': [Date.today().add({ days: -29 }), 'today'],
                'This Month': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
                'Last Month': [Date.today().moveToFirstDayOfMonth().add({ months: -1 }), Date.today().moveToFirstDayOfMonth().add({ days: -1 })]
            },
            opens: 'left',
            format: 'MM/dd/yyyy',
            separator: ' to ',
            startDate: Date.today().add({ days: -29 }),
            endDate: Date.today(),
            minDate: '01/01/2012',
            maxDate: '12/31/2013',
            locale: {
                applyLabel: 'Submit',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom Range',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            },
            showWeekNumbers: true,
            buttonClasses: ['btn-danger']
        },
        function(start, end) {
            $('#reportrange span').html(start.toString('MMMM d, yyyy') + ' - ' + end.toString('MMMM d, yyyy'));
        }
    );

    //Set the initial state of the picker label
    $('#reportrange span').html(Date.today().add({ days: -29 }).toString('MMMM d, yyyy') + ' - ' + Date.today().toString('MMMM d, yyyy'));

   </script>    
  
   <!-- END JAVASCRIPTS --> 
   <script>
	function vdetails() {var str = arguments[0]; if (str) $('#crmdetails').load("cpcrmtrace.php?t=cpcrmdataprofile&id="+str);}
   </script>      
   
   <phpdac>frontpage.include_part use /parts/google-analytics.php+++metro</phpdac>
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->     
</body>
<!-- END BODY -->
</html>