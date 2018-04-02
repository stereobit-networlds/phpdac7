<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Crm profile timeline</title>
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
   <link href="css/timeline-component.css" rel="stylesheet"  type="text/css" />
   
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
                <!--BEGIN METRO STATES-->
                <div class="metro-nav">

                    <div class="metro-nav-block  nav-block-grey">
                        <a href="cpcrmtrace.php?t=cpcrmprofile&v=<phpdac>rccrmtrace.currentVisitor</phpdac>&<phpdac>rccrmtrace.getDateRange</phpdac>" data-original-title="">
                            <div class="text-center">
                                <i class="icon-user"></i>
                            </div>
                            <div class="status">Profile</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-blue ">
                        <a href="cpcrmtrace.php?t=cpcrmactivities&v=<phpdac>rccrmtrace.currentVisitor</phpdac>&<phpdac>rccrmtrace.getDateRange</phpdac>" data-original-title="">
                            <div class="text-center">
                                <i class="icon-calendar"></i>
                            </div>
                            <div class="status">Activities</div>
                        </a>
                    </div>
                    <div class="metro-nav-block  nav-block-red">
                        <a href="cpcrmtrace.php?t=cpcrmcontact&v=<phpdac>rccrmtrace.currentVisitor</phpdac>&<phpdac>rccrmtrace.getDateRange</phpdac>" data-original-title="">
                            <div class="text-center">
                                <i class="icon-phone"></i>
                            </div>
                            <div class="status">Contact</div>
                        </a>
                    </div>
					<div class="metro-nav-block  nav-block-red">
                        <div class="profile-photo">
                            <img src="img/lock-thumb.jpg" alt="">
                            <a href="cpcrmoffers.php?v=<phpdac>rccrmtrace.currentVisitor</phpdac>" class="edit" title="<phpdac>rccrmtrace.currentVisitor use auto</phpdac>">
                                <i class="icon-envelope"></i>
                            </a>
                        </div>
                    </div>
					<phpdac>crmtimeline.selectTimelineButton</phpdac>	
                </div>
                <div class="space10"></div>
                <!--END METRO STATES-->
            </div>			
			
            <div class="row-fluid">
                <ul class="metro_tmtimeline">
					<phpdac>crmtimeline.showTimeline use crm-timeline-details</phpdac>
                </ul>
				<!--div class="text-center">
                    <button class="btn btn-inverse ">Load More</button>
                </div>
                <div class="space20"></div-->
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
   
   <phpdac>frontpage.include_part use /parts/google-analytics.php+++metro</phpdac>
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->     
</body>
<!-- END BODY -->
</html>