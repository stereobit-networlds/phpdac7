<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Crm trace</title>
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
                 <div class="span12">
                     <!-- BEGIN BLOG PORTLET-->
                     <div class="row-fluid">
                         <div class="span8 ">
                             <div class="row-fluid">
							 
								<!--BEGIN METRO STATES-->
								<div class="metro-nav">

									<div class="metro-nav-block  nav-block-grey">
										<a href="cpcrmtrace.php?t=cpcrmtrace&recognized=1&<phpdac>rccrmtrace.getDateRange</phpdac>" data-original-title="">
											<div class="text-center">
											<i class="icon-puzzle-piece"></i>
											</div>
											<div class="status">Recognize</div>
										</a>
									</div>
									<div class="metro-nav-block nav-block-yellow ">
										<a href="cpcrmtrace.php?t=cpcrmtrace&resolved=1&<phpdac>rccrmtrace.getDateRange</phpdac>" data-original-title="">
											<div class="text-center">
											<i class="icon-cogs"></i>
											</div>
											<div class="status">Resolve</div>
										</a>
									</div>
									<div class="metro-nav-block nav-block-green ">
										<a href="cpcrmtrace.php?t=cpcrmtrace&recognized=<phpdac>rccrmtrace.readVar use recognize</phpdac>&login=1&<phpdac>rccrmtrace.getDateRange</phpdac>" data-original-title="">
											<div class="text-center">
											<i class="icon-book"></i>
											</div>
											<div class="status">Login</div>
										</a>
									</div>
									<div class="metro-nav-block nav-block-blue ">
										<a href="cpcrmtrace.php?t=cpcrmtrace&recognized=<phpdac>rccrmtrace.readVar use recognize</phpdac>&fb=1&<phpdac>rccrmtrace.getDateRange</phpdac>" data-original-title="">
											<div class="text-center">
											<i class="icon-facebook"></i>
											</div>
											<div class="status">Facebook</div>
										</a>
									</div>									
									<div class="metro-nav-block  nav-block-red">
										<a href="cpcrmtrace.php?t=cpcrmtrace&<phpdac>rccrmtrace.getDateRange</phpdac>" data-original-title="">
											<div class="text-center">
											<i class="icon-user"></i>
											</div>
											<div class="status">All</div>
										</a>
									</div>
								</div>
								<div class="space10"></div>
								<!--END METRO STATES-->							 
							 
								<div id="visits" class="widget blue">
									<div class="widget-title">
										<h4><i class="icon-bell-alt"></i> <phpdac>frontpage.slocale use _visits</phpdac></h4>
										<span class="tools">
										<a class="icon-chevron-down" href="javascript:;"></a>
										<!--a class="icon-remove" href="javascript:;"></a-->
										</span>
									</div>
									<div class="widget-body">
										<phpdac>rccrmtrace.visitors use crm-alert-important</phpdac>
									</div>
								</div>

                             </div>
                         </div>
                         <div class="span4">
							<div class="widget orange">
								<div class="widget-title">
									<h4><i class="icon-tasks"></i> Analytics </h4>
									<span class="tools">
									<a href="javascript:;" class="icon-chevron-down"></a>
									</span>
								</div>
								<div class="widget-body">
									<div id="widgetIframe"> 
										<phpdac>siteanalytics.widget use Live+widget+++++yes</phpdac>
									</div>								
								</div>
							</div>
                             <div class="blog-side-bar orange-box">
                                 <h2> <i class=" icon-tasks"></i> Archive</h2>
                                 <ul>
                                     <li>
                                         <a href="cpcrmtrace.php?t=cpcrmtrace&month=01&year=<phpdac>rccrmtrace.getYear</phpdac>">
                                             <span class="large">Jan</span>
                                             <span><phpdac>rccrmtrace.getYear</phpdac></span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="cpcrmtrace.php?t=cpcrmtrace&month=02&year=<phpdac>rccrmtrace.getYear</phpdac>">
                                             <span class="large">Feb</span>
                                             <span><phpdac>rccrmtrace.getYear</phpdac></span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="cpcrmtrace.php?t=cpcrmtrace&month=03&year=<phpdac>rccrmtrace.getYear</phpdac>">
                                             <span class="large">Mar</span>
                                             <span><phpdac>rccrmtrace.getYear</phpdac></span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="cpcrmtrace.php?t=cpcrmtrace&month=04&year=<phpdac>rccrmtrace.getYear</phpdac>">
                                             <span class="large">Apr</span>
                                             <span><phpdac>rccrmtrace.getYear</phpdac></span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="cpcrmtrace.php?t=cpcrmtrace&month=05&year=<phpdac>rccrmtrace.getYear</phpdac>">
                                             <span class="large">May</span>
                                             <span><phpdac>rccrmtrace.getYear</phpdac></span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="cpcrmtrace.php?t=cpcrmtrace&month=06&year=<phpdac>rccrmtrace.getYear</phpdac>">
                                             <span class="large">Jun</span>
                                             <span><phpdac>rccrmtrace.getYear</phpdac></span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="cpcrmtrace.php?t=cpcrmtrace&month=07&year=<phpdac>rccrmtrace.getYear</phpdac>">
                                             <span class="large">Jul</span>
                                             <span><phpdac>rccrmtrace.getYear</phpdac></span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="cpcrmtrace.php?t=cpcrmtrace&month=08&year=<phpdac>rccrmtrace.getYear</phpdac>">
                                             <span class="large">Aug</span>
                                             <span><phpdac>rccrmtrace.getYear</phpdac></span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="cpcrmtrace.php?t=cpcrmtrace&month=09&year=<phpdac>rccrmtrace.getYear</phpdac>">
                                             <span class="large">Sep</span>
                                             <span><phpdac>rccrmtrace.getYear</phpdac></span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="cpcrmtrace.php?t=cpcrmtrace&month=10&year=<phpdac>rccrmtrace.getYear</phpdac>">
                                             <span class="large">Okt</span>
                                             <span><phpdac>rccrmtrace.getYear</phpdac></span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="cpcrmtrace.php?t=cpcrmtrace&month=11&year=<phpdac>rccrmtrace.getYear</phpdac>">
                                             <span class="large">Nov</span>
                                             <span><phpdac>rccrmtrace.getYear</phpdac></span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="cpcrmtrace.php?t=cpcrmtrace&month=12&year=<phpdac>rccrmtrace.getYear</phpdac>">
                                             <span class="large">Dec</span>
                                             <span><phpdac>rccrmtrace.getYear</phpdac></span>
                                         </a>
                                     </li>									 
                                 </ul>
                             </div>	
                             <div class="blog-side-bar red-box">
                                 <h2> <i class=" icon-tags"></i> searches</h2>
                                 <ul class="unstyled tag">
									 <span><phpdac>rccrmtrace.searchTags use crm-searchtags</phpdac></span>
                                 </ul>
                             </div>							 
                             <!--div class="blog-side-bar green-box">
                                 <h2> <i class="  icon-comments-alt"></i> Latest messages</h2>
                                 <div class="space20"></div>
                                 <div class="row-fluid">
                                     <div class="green-box-blog">
                                         <div class="span3">
                                             <img alt="" src="img/blog/blog-thumb-3.jpg">
                                         </div>
                                         <div class="span9">
                                             <h5>
                                                 <a href="javascript:;">02 MAY 2013</a>
                                             </h5>
                                             <p>Nam sed arcu non tellus
                                                 fringilla fringilla ut vel ipsum.</p>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="space10"></div>
                                 <div class="row-fluid">
                                     <div class="green-box-blog">
                                         <div class="span3">
                                             <img alt="" src="img/blog/blog-thumb-2.jpg">
                                         </div>
                                         <div class="span9">
                                             <h5>
                                                 <a href="javascript:;">02 MAY 2013</a>
                                             </h5>
                                             <p>Nam sed arcu non tellus
                                                 fringilla fringilla ut vel ipsum.</p>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="space10"></div>
                                 <div class="row-fluid">
                                     <div class="green-box-blog">
                                         <div class="span3">
                                             <img alt="" src="img/blog/blog-thumb-3.jpg">
                                         </div>
                                         <div class="span9">
                                             <h5>
                                                 <a href="javascript:;">02 MAY 2013</a>
                                             </h5>
                                             <p>Nam sed arcu non tellus
                                                 fringilla fringilla ut vel ipsum.</p>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="space10"></div>
                             </div-->
                         </div>
                     </div>
                     <!-- END BLOG PORTLET-->
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
       
</body>
<!-- END BODY -->
</html>