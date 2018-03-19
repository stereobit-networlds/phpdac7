<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Statistics</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="stereobit.networlds" name="author" />
   <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <!--link href="assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" /-->
   <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="css/style.css" rel="stylesheet" />
   <link href="css/style-responsive.css" rel="stylesheet" />
   <link href="css/style-default.css" rel="stylesheet" id="style_color" />
   <!--link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" /-->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" />
	<!--link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" /-->	
	
   <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
   
    <!--link href="assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" /-->
    <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />  
    <link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen/chosen.css" />
	<!--link rel="stylesheet" type="text/css" href="assets/jquery-tags-input/jquery.tagsinput.css" />
    <link rel="stylesheet" type="text/css" href="assets/clockface/css/clockface.css" /-->	
   
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
			<phpdac>rccrm.select_timeline use crm-timeline</phpdac>
			<!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">				
                <!--BEGIN METRO STATES-->
                <div class="metro-nav">
                    <div class="metro-nav-block nav-block-orange">
                        <a data-original-title="" href="cpform.php">
                            <i class="icon-user"></i>
                            <div class="info"><phpdac>rccrm.getStats use inbox</phpdac></div>
                            <div class="status">Inbox</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-olive">
                        <a data-original-title="" href="cpcrm.php">
                            <i class="icon-user"></i>
                            <div class="info"><phpdac>rccrm.getStats use contacts+users</phpdac></div>
                            <div class="status"><phpdac>frontpage.slocale use _breg</phpdac></div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-light-brown">
                        <a data-original-title="" href="cpcrmtrace.php">
                            <i class="icon-user"></i>
                            <div class="info"><phpdac>rccrm.getStats use contacts</phpdac></div>
                            <div class="status"><phpdac>i18nL.translate use contacts+RCCRM</phpdac></div>
                        </a>
                    </div>					
                    <div class="metro-nav-block nav-block-green double">
                        <a data-original-title="" href="cpcrmoffers.php">
                            <i class="icon-eye-open"></i>
                            <div class="info"><phpdac>rccrm.getStats use outbox+sent</phpdac></div>
                            <div class="status"><phpdac>frontpage.slocale use _mailsent</phpdac></div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-red">
                        <a data-original-title="" href="cpbulkmail.php?t=cpviewsubsqueue">
                            <i class="icon-envelope"></i>
                            <div class="info"><phpdac>rccrm.getStats use outbox</phpdac></div>
                            <div class="status">Outbox</div>
                        </a>
                    </div>
                </div>
                <div class="metro-nav">
                    <div class="metro-nav-block nav-light-green">
                        <a data-original-title="" href="cptransactions.php">
                            <i class="icon-bar-chart"></i>
                            <div class="info"><phpdac>rccrm.itemsPurchasedQty</phpdac></div>
                            <div class="status"><phpdac>i18nL.translate use qty+RCITEMQPOLICY</phpdac></div>
                        </a>
                    </div>				
                    <div class="metro-nav-block nav-light-blue double">
                        <a data-original-title="" href="cptransactions.php">
                            <i class="icon-tasks"></i>
                            <div class="info"><phpdac>rccrm.itemsPurchased</phpdac></div>
                            <div class="status"><phpdac>i18nL.translate use items+RCCRM</phpdac></div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-yellow">
                        <a data-original-title="" href="cpbulkmail.php?t=cpviewclicks">
                            <i class="icon-comments-alt"></i>
                            <div class="info"><phpdac>rccrm.getStats use crmdocs</phpdac></div>
                            <div class="status"><phpdac>i18nL.translate use offers+RCCRM</phpdac></div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-light-purple">
                        <a data-original-title="" href="cptransactions.php">
                            <i class="icon-shopping-cart"></i>
                            <div class="info"><phpdac>rccrm.getStats use transactions</phpdac></div>
                            <div class="status"><phpdac>i18nL.translate use transactions+RCCONTROLPANEL</phpdac></div>
                        </a>
                    </div>					
                    <div class="metro-nav-block nav-block-grey ">
                        <a data-original-title="" href="cpcrm.php?t=cpcrmdetails&iframe=0&id=<phpdac>cmsrt.nvldac2 use id+cmsrt.echostr:id++</phpdac>&module=transactions">
                            <i class="icon-external-link"></i>
                            <div class="info"><phpdac>rccrm.getStats use transactions+sales</phpdac> &euro;</div>
                            <div class="status"><phpdac>frontpage.slocale use _revenue</phpdac></div>
                        </a>
                    </div>
                </div>
                <div class="space10"></div>
                <!--END METRO STATES-->
            </div>

            <div class="row-fluid">
				<div class="span12">
					<div class="widget yellow">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> <phpdac>i18nL.translate use CPFLOTCHARTS_DPC+CPFLOTCHARTS</phpdac></h4>
                         <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                         </span>
                        </div>
                        <div class="widget-body">
							<div class="plots"></div>							
                        </div>
                    </div>
				</div>				
            </div>
            <div class="row-fluid"> 
				 <!--hpdac>rccontrolpanel._show_charts</phpda-->
				 <INPUT TYPE= "hidden" ID="statsid" VALUE="0" />
            </div>
			<!-- END PAGE CONTAINER-->
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
   <!--script language="JavaScript">
   <-hpdac>rccrm.javascript</phpda->   
   </script-->  
   
   <!-- Load javascripts at bottom, this will reduce page load time -->
   <script src="js/jquery-1.8.3.min.js"></script>
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <script type="text/javascript" src="assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>
   <script type="text/javascript" src="assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
   <!--script src="assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script-->
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
   <!--script type="text/javascript" src="assets/clockface/js/clockface.js"></script-->
   <script type="text/javascript" src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
   <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
   <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>  
	<!--script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
   <script type="text/javascript" src="assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script-->   
   <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
   <script src="js/jquery.sparkline.js" type="text/javascript"></script>
   <script src="assets/chart-master/Chart.js"></script>
    <!--script type="text/javascript" src="assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
   <script src="assets/fancybox/source/jquery.fancybox.pack.js"></script-->	
   <script src="js/jquery.scrollTo.min.js"></script>


   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!--script for this page only-->
   <script language="javascript" type="text/javascript">
	   
    <phpdac>cpflotcharts.jsflotCrmCharts</phpdac>	   
	   
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

   <script src="js/easy-pie-chart.js"></script>
   <script src="js/sparkline-chart.js"></script>
   
   <!--script src="js/home-page-calender.js"></script>
   <script src="js/home-chartjs.js"></script-->
	
   <!-- END JAVASCRIPTS --> 
   
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->     
</body>
<!-- END BODY -->
</html>