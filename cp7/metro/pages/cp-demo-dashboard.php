<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>e-Enterprise</title>
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
   
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" />
	
   <!--link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" /-->
   <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
   
   <link rel="stylesheet" href="css/zebra/flat/zebra_dialog.css" type="text/css">
    
</head>
<!-- END HEAD -->

<!-- START FUNCS (CP MSGS once here) -->
	<phpdac>cp.getInactiveUsers</phpdac>
	<phpdac>cp.getActiveUsers</phpdac>
<!-- END FUNCS -->	

<!-- BEGIN BODY -->
<body class="fixed-top" onLoad="init()">
   <!-- BEGIN HEADER -->
	<phpdac>frontpage.include_part use /parts/header-demo.php+++metro</phpdac>
   <!-- END HEADER -->
   <!-- BEGIN CONTAINER -->
   <div id="container" class="row-fluid">
      <!-- BEGIN SIDEBAR -->
		<phpdac>frontpage.include_part use /parts/sidebar-demo.php+++metro</phpdac>
      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
				<!--phpdac>frontpage.include_part use /parts/pageheader.php+++metro</phpdac-->
				<phpdac>frontpage.nvldac2 use rccontrolpanel.cpStats+rccontrolpanel.select_timeline:cptimeline++1</phpdac>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <!--BEGIN METRO STATES-->
                <div class="metro-nav">
                    <div class="metro-nav-block nav-block-orange">
                        <a data-original-title="" href="javascript:sndReqArg('cp.php?t=cpinfo&s=users&statsid='+statsid.value,'cpinfo');">
                            <i class="icon-user"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Users</phpdac></div>
                            <div class="status">Users</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-olive">
                        <a data-original-title="" href="javascript:sndReqArg('cp.php?t=cpinfo&s=customers&statsid='+statsid.value,'cpinfo');">
                            <i class="icon-tags"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Users+customers</phpdac></div>
                            <div class="status">Customers</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-yellow">
                        <a data-original-title="" href="javascript:sndReqArg('cp.php?t=cpinfo&s=ulists&statsid='+statsid.value,'cpinfo');">
                            <i class="icon-comments-alt"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Mail+maillist</phpdac></div>
                            <div class="status">Subscribers</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-green double">
                        <a data-original-title="" href="javascript:sndReqArg('cp.php?t=cpinfo&s=mails&statsid='+statsid.value,'cpinfo');">
                            <i class="icon-eye-open"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Mail</phpdac></div>
                            <div class="status">Mails sent</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-red">
                        <a data-original-title="" href="javascript:sndReqArg('cp.php?t=cpinfo&s=mails&statsid='+statsid.value,'cpinfo');">
                            <i class="icon-envelope"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Mail+send</phpdac></div>
                            <div class="status">Mails to send</div>
                        </a>
                    </div>
                </div>
                <div class="metro-nav">
                    <div class="metro-nav-block nav-light-green">
                        <a data-original-title="" href="javascript:sndReqArg('cp.php?t=cpinfo&s=&statsid='+statsid.value,'cpinfo');">
                            <i class="icon-bar-chart"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Diskspace</phpdac></div>
                            <div class="status">Resources</div>
                        </a>
                    </div>				
                    <div class="metro-nav-block nav-light-blue double">
                        <a data-original-title="" href="javascript:sndReqArg('cp.php?t=cpinfo&s=items&statsid='+statsid.value,'cpinfo');">
                            <i class="icon-tasks"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Items+active</phpdac></div>
                            <div class="status">Active Items</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-light-brown">
                        <a data-original-title="" href="javascript:sndReqArg('cp.php?t=cpinfo&s=items&statsid='+statsid.value,'cpinfo');">
                            <i class="icon-remove-sign"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Items+inactive</phpdac></div>
                            <div class="status">Inactive Items</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-light-purple">
                        <a data-original-title="" href="javascript:sndReqArg('cp.php?t=cpinfo&s=transactions&statsid='+statsid.value,'cpinfo');">
                            <i class="icon-shopping-cart"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Transactions</phpdac></div>
                            <div class="status">Orders</div>
                        </a>
                    </div>					
                    <div class="metro-nav-block nav-block-grey ">
                        <a data-original-title="" href="javascript:sndReqArg('cp.php?t=cpinfo&s=transactions&statsid='+statsid.value,'cpinfo');">
                            <i class="icon-external-link"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Transactions+revenue</phpdac> &euro;</div>
                            <div class="status">Total Profit</div>
                        </a>
                    </div>
                </div>
                <div class="space10"></div>
                <!--END METRO STATES-->
            </div>

            <div class="row-fluid">
                <div class="span6">
						<div class="widget-body">
                            <div class="text-left">
								<div id="cpinfo"></div>
                            </div>
                        </div>				
                    <!--BEGIN GENERAL STATISTICS-->
                    <!--div class="widget orange">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> General Statistics </h4>
                         <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                         </span>
                            <div class="update-btn">
                                <a href="javascript:;" class="btn"><i class="icon-repeat"></i> Update</a>
                            </div>
                        </div-->
                        <div class="widget-body">
                            <div class="text-center">
                                <div class="easy-pie-chart">
                                    <div class="percentage success" data-percent="<phpdac>rccontrolpanel.getStats use Diskspace+remainsizepercent</phpdac>"><span><phpdac>rccontrolpanel.getStats use Diskspace+remainsizepercent</phpdac></span>%</div>
                                    <div class="title"><phpdac>i18nL.translate use usedspace</phpdac></div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<phpdac>rccontrolpanel.getStats use Diskspace+remainhdpercent</phpdac>"><span><phpdac>rccontrolpanel.getStats use Diskspace+remainhdpercent</phpdac></span>%</div>
                                    <div class="title"><phpdac>i18nL.translate use hdusage</phpdac></div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<phpdac>rccontrolpanel.getStats use Diskspace+remainmxpercent</phpdac>"><span><phpdac>rccontrolpanel.getStats use Diskspace+remainmxpercent</phpdac></span>%</div>
                                    <div class="title"><phpdac>i18nL.translate use mxusage</phpdac></div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<phpdac>rccontrolpanel.getStats use Diskspace+remaindbpercent</phpdac>"><span><phpdac>rccontrolpanel.getStats use Diskspace+remaindbpercent</phpdac></span>%</div>
                                    <div class="title"><phpdac>i18nL.translate use dbusage</phpdac></div>
                                </div>
                            </div>
                        </div>
                    <!--/div-->
					
					<!-- BEGIN ALERTS PORTLET-->
                    <div class="widget orange">
                        <div class="widget-title">
                            <h4><i class="icon-bell-alt"></i> System messages</h4>
                            <span class="tools">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                            </span>
                        </div>
                        <div class="widget-body">
						    <phpdac>rccontrolpanel.viewSysMessages use alert-important</phpdac>
							<div class="space10"></div>
                            <a href="cp.php?t=cpsysMessages" class="pull-right"><phpdac>frontpage.slocale use _viewallmessages</phpdac></a>
                            <div class="clearfix no-top-space no-bottom-space"></div>
                        </div>
                    </div>
                    <!-- END ALERTS PORTLET-->	

					<div class="plots"></div>		
					
                    <div class="widget purple">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> Items </h4>
                         <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                         </span>
						 <div class="update-btn">
                            <a href="javascript:sndReqArg('cp.php?t=cpchartshow&group=&ai=2&report=statistics&statsid='+statsid.value,'statistics');" class="btn"><i class="icon-repeat"></i> Update</a>
                         </div>
                        </div>
                        <div class="widget-body">
                            <div class="text-center">
                                <div id="statistics"></div>
                            </div>
                        </div>
                    </div>	
					<div class="widget red">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> Categories </h4>
                         <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                         </span>
						 <div class="update-btn">
                            <a href="javascript:sndReqArg('cp.php?t=cpchartshow&group=&ai=1&report=statisticscat&statsid='+statsid.value,'statisticscat');" class="btn"><i class="icon-repeat"></i> Update</a>
                         </div>
                        </div>
                        <div class="widget-body">
                            <div class="text-center">
                                <div id="statisticscat"></div>
                            </div>
                        </div>
                    </div>	
					<div class="widget yellow">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> Mail Queue </h4>
                         <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                         </span>
						 <div class="update-btn">
                            <a href="javascript:sndReqArg('cp.php?t=cpchartshow&group=&ai=1&report=mailqueue&statsid='+statsid.value,'mailqueue');" class="btn"><i class="icon-repeat"></i> Update</a>
                         </div>
                        </div>
                        <div class="widget-body">
                            <div class="text-center">
                                <div id="mailqueue"></div>
								<div id="chart-1" class="chart"></div>
                            </div>
                        </div>
                    </div>
					<div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> Transactions </h4>
                         <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                         </span>
						 <div class="update-btn">
                            <a href="javascript:sndReqArg('cp.php?t=cpchartshow&group=&ai=2&report=transactions&statsid='+statsid.value,'transactions');" class="btn"><i class="icon-repeat"></i> Update</a>
                         </div>
                        </div>
                        <div class="widget-body">
                            <div class="text-center">
                                <div id="transactions"></div>
								<div id="chart-2" class="chart"></div>
                            </div>
                        </div>
                    </div>						
                    <!--END GENERAL STATISTICS-->
                </div>
                <div class="span6">
                    <!--BEGIN GENERAL STATISTICS-->
                    <!--div class="widget purple">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> General Statistics </h4>
                         <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                         </span>
                        </div>
                        <div class="widget-body">
                            <div class="row-fluid">
                                <div class="text-center">
                                    <div class="sparkline">
                                        <div id="metro-sparkline-type1"></div>
                                        <div class="sparkline-tittle">Server Load</div>
                                    </div>
                                    <div class="sparkline">
                                        <div id="metro-sparkline-type2"></div>
                                        <div class="sparkline-tittle">Network Load</div>
                                    </div>
                                    <div class="sparkline">
                                        <div id="metro-sparkline-type3"></div>
                                        <div class="sparkline-tittle">Visit Load</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div-->
					<!--END GENERAL STATISTICS-->
					<!-- BEGIN ALERTS PORTLET-->
                    <div id="alerts" class="widget blue">
                        <div class="widget-title">
                            <h4><i class="icon-bell-alt"></i> Alerts</h4>
                            <span class="tools">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                            </span>
                        </div>
                        <div class="widget-body">
							<phpdac>rccontrolpanel.viewMessages use alert</phpdac>
                            <div class="space10"></div>
                            <a href="cp.php?t=cpshowMessages" class="pull-right"><phpdac>frontpage.slocale use _viewallmessages</phpdac></a>
                            <div class="clearfix no-top-space no-bottom-space"></div>
                        </div>
                    </div>					
                </div>
            </div>
            <div class="row-fluid">
                 <div class="span6">
					 
					<!-- BEGIN PROGRESS PORTLET-->
                    <div id="tasks" class="widget purple">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> Tasks Progress </h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <ul class="unstyled">
								<phpdac>rcbulkmail.percentofCamps use task-in-progress-important</phpdac>
								<phpdac>rcbulkmail.lastCamps use task-in-progress-success+5</phpdac>
                            </ul>
                        </div>
                    </div>
                    <!-- END PROGRESS PORTLET-->					 
					 
                     <!-- BEGIN NOTIFICATIONS PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-download"></i> <phpdac>frontpage.slocale use _update</phpdac> </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                             <ul class="item-list scroller padding"  style="overflow: hidden; width: auto; " data-always-visible="1">
                                 <phpdac>rccontrolpanel.getStats use Update+html</phpdac>
                             </ul>
                             <!--div class="space10"></div>
                             <a href="#" class="pull-right">View all notifications</a>
                             <div class="clearfix no-top-space no-bottom-space"></div-->
                         </div>
                     </div>
                     <!-- END NOTIFICATIONS PORTLET-->					 
                 </div>
				 
				 <!--hpdac>rccontrolpanel._show_charts</phpda-->
				 <INPUT TYPE= "hidden" ID="statsid" VALUE="0" />
					
                 <div class="span6">
                     <!-- BEGIN CHAT PORTLET-->
                     <div id="addons" class="widget red">
                         <div class="widget-title">
                             <h4><i class="icon-plus-sign"></i> <phpdac>frontpage.slocale use _addons</phpdac></h4>
									<span class="tools">
									<a href="javascript:;" class="icon-chevron-down"></a>
									<a href="javascript:;" class="icon-remove"></a>
									</span>
                         </div>
                         <div class="widget-body">
                             <div class="timeline-messages">
                                <phpdac>rccontrolpanel.getStats use Addons+html</phpdac> 
                             </div>
                         </div>
                     </div>
                     <!-- END CHAT PORTLET-->
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
	<phpdac>frontpage.include_part use /parts/footer-demo.php+++metro</phpdac>
   <!-- END FOOTER -->

   <!-- BEGIN JAVASCRIPTS -->
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
   
   <script type="text/javascript" src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
   <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
   <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
   
   <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
   <script src="js/jquery.sparkline.js" type="text/javascript"></script>
   <script src="assets/chart-master/Chart.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>


   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!--script for this page only-->
   <script language="javascript" type="text/javascript">
   
    <phpdac>cpflotcharts.jsflotcharts</phpdac> 
	   
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

	<script src="js/aSimpleTour.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        /*$('#startTour').click(function(){*/
          options = {
            data : [
              { element : '.metro-nav', 'tooltip' : 'Σύνολα στατιστικών', 'position' : 'T', 'text' : '<h3>Metro</h3><p>Παρακολουθήστε με μια ματια τα κρίσιμα στατιστικά μεγέθη που αφορούν τις εργασίες που έχετε αναθέσει στο σύστημα.</p>'  },
              { element : '.metro-nav-block.nav-light-purple', 'tooltip' : 'Ενότητα αναφοράς', 'position' : 'TL', 'text' : '<h3>Ενότητες</h3><p>Κάθε πλαίσιο αναφέρεται στον δείκτη που παρακολουθείται. Ενημερώνεται είτε απο δικές σας ενέργειες είτε απο αποτελέσματα που προκύπτουν απο τις εργασίες που αναθέτετε στο σύστημα είτε απο τις απαντήσεις που λαμβάνονται σε βάθος χρόνου.</p>' },
			  { element : '.easy-pie-chart', 'tooltip' : 'Δείκτες συστήματος', 'position' : 'T', 'text' : '<h3>Δείκτες</h3><p>Βασικοί δείκτες που αφορούν την χωρητικότητα του συστήματος και την κατανομή του χώρου ανάλογα με το είδος της αποθηκευμένης πληροφορίας.</p>' },
			  { element : '#alerts', 'tooltip' : 'Μηνύματα συστήματος', 'position' : 'L', 'text' : '<h3>Μηνύματα και ειδοποιήσεις</h3><p>Εδώ εμφανίζονται τα μηνύματα του συστήματος και αφορούν εγγραφές νέων χρηστών, χρήστες που δεν ενεργοποίησαν τον λογαραισμό τους κατα την διαδικασία εγγραφής, παραστατικά πωλήσεων που παράγονται, μηνύματα φορμών κλπ.</p>' },
              { element : '.update-btn', 'tooltip' : 'Ενημέρωση γραφήμάτων', 'position' : 'R', 'text' : '<h3>Γραφήματα</h3><p>Καλέστε τα σχετικά γραφήματα που αφορούν σύνολα εργασιών ως προς τον χρόνο εκτέλεσης τους. Κατόπιν επιλέξτε τύπο γραφήματος και χρονική περίοδο αναφοράς.</p>' },
			  { element : '#tasks', 'tooltip' : 'Πλάισιο εργασιών', 'position' : 'TL', 'text' : '<h3>Εργασίες</h3><p>Παρακολουθήστε τις εργασίες που ανατέθηκαν στο σύστημα και είναι σε εξέλιξη ή έχουν ολοκληρωθεί. Το click στον τίτλο σας μεταφέρει στην προεπισκόπηση-προβολή της εργασίας, το click στο σύμβολο ολοκλήρωσης ή εξέλιξης της εργασίας ενημερώνει τα στατιστικά μεγέθη σύμφωνα με τις μετρήσεις που έχουν αποθηκευτεί για την συγκεκριμένη εργασία.</p>' },
			  { element : '#addons', 'tooltip' : 'Πρόσθετα', 'position' : 'T', 'text' : '<h3>Πρόσθετα</h3><p>Λίστα πρόσθετων χαρακτηριστικών που έχουν ενεργοποιηθεί ή μπορούν να ενεργοποιηθούν για τον εμπλουτισμό του συστήματος.<br/>ΠΡΟΣΟΧΗ: Απαιτείται γνώση των χειρισμών καθώς και των ιδιαίτερων χαρακτηριστικών για κάθε πρόσθετο, διαφορετικά μπορεί να απορυθμιστούν ενότητες του e-Enterprise που είναι απαραίτητες για την λειτουργεία του.</p>' },
              { element : '#reservation', 'tooltip' : 'Επιλογή ημερομηνιακού διαστήματος αναφοράς', 'position' : 'R', 'text' : '<h3>Αναφορές</h3><p>Επιλογή ημερομηνιακού διαστήματος που ανανεώνει τα στατιστικά στοιχεία σύμφωνα με την επιλεγμένη χρονική περίοδο.</p>' },
              { element : '.divider-vertical', 'tooltip' : 'Αναφορές ανα μήνα και έτη', 'position' : 'B', 'text' : '<h3>Αναφορές</h3><p>Επιλογή μήνα ή έτους, ημερομηνιακού διαστήματος που ανανεώνει τα στατιστικά στοιχεία σύμφωνα με την επιλεγμένη χρονική περίοδο. Εξ όρισμού η πρώτη είσοδος στο σύστημα ανακτεί τα στοιχεία του τρέχοντος έτους.</p>' },
              { element : '.nav.top-menu', 'tooltip' : 'Δείκτες εργασιών και μηνυμάτων', 'position' : 'B', 'text' : '<h3>Συντόμευσεις</h3><p>Τρέχουσες εργασίες και μηνύματα εμφανίζονται σε αυτή την περιοχή.</p>' },
              { element : '.sidebar-menu', 'tooltip' : 'Μενου επιλογών', 'position' : 'R', 'text' : '<h3>Μενου</h3><p>Επιλέξτε ενότητα και εφαρμογή κάνοντας click σε αυτή την περιοχή.</p>' },
              { element : '#console_exit', 'tooltip' : 'Προσωρινή έξοδος', 'position' : 'B', 'text' : '<h3>Προσωρινή έξοδος</h3><p>Επιστρέψτε στις σελίδες του e-shop και επιστρέψτε στο e-Enterprise κάθε φορά που θέλετε να εμφανίσετε την περιοχή εποπτίας ή να ρυθμίσετε λειτουργίες χρησιμοποιώντας τα στοιχεία του e-shop, πατώντας το πλήκτρο εισαγωγής και χωρίς να ξαναζητηθούν τα στοιχεία πιστοποίησης χρήστη.</p>' },
			  { element : '#eshop_exit', 'tooltip' : 'Έναρξη περιήγησης στο e-shop', 'position' : 'B', 'text' : '<h3>Περιήγηση στο e-shop</h3><p>Περιηγηθείτε στο e-shop, προβάλετε κατηγορίες και προϊόντα. Κάθε φορά που θέλετε να εισαχθείτε στο περιβάλλον διαχείρισης πατήστε το πλήκτρο e-Enterprise που θα βρείτε στο πάνω μέρος κάθε σελίδας, εφόσον έχετε κάνει login στην περιοχή εποπτίας του e-Enterprise. Μπορείτε να χρησιμοποιείτε το πλήκτρο εισαγωγής Επιστρέψτε στις σελίδες του e-shop και ξαναεισαχθείτε στις σελίδες διαχείρισης με ένα click και χωρίς να ξαναζητηθούν τα στοιχεία πιστοποίησης χρήστη.</p>' },
			  { element : '.username', 'tooltip' : 'Επιλογές χρήστη', 'position' : 'B', 'text' : '<h3>Eπιλογές χρήστη</h3><p>Εξοδος απο το σύστημα ή ρύθμιση ειδικών στοιχείων που αφορούν τον χειριστή του συστήματος. Η βοήθεια παραμένει ενεργή και επαναλαμβάνει την ξενάγηση στο σύστημα, κάθε φορά που θα επιλεχθεί απο αυτή την περιοχή.</p>' }
            ] ,
            controlsPosition : 'BR'
          };

          $.aSimpleTour(options);  
        /*});*/
      });
	  
      $(document).ready(function(){
        $('#startTour').click(function(){
          options = {
            data : [
              { element : '.metro-nav', 'tooltip' : 'Σύνολα στατιστικών', 'position' : 'T', 'text' : '<h3>Metro</h3><p>Παρακολουθήστε με μια ματια τα κρίσιμα στατιστικά μεγέθη που αφορούν τις εργασίες που έχετε αναθέσει στο σύστημα.</p>'  },
              { element : '.metro-nav-block.nav-light-purple', 'tooltip' : 'Ενότητα αναφοράς', 'position' : 'TL', 'text' : '<h3>Ενότητες</h3><p>Κάθε πλαίσιο αναφέρεται στον δείκτη που παρακολουθείται. Ενημερώνεται είτε απο δικές σας ενέργειες είτε απο αποτελέσματα που προκύπτουν απο τις εργασίες που αναθέτετε στο σύστημα είτε απο τις απαντήσεις που λαμβάνονται σε βάθος χρόνου.</p>' },
			  { element : '.easy-pie-chart', 'tooltip' : 'Δείκτες συστήματος', 'position' : 'T', 'text' : '<h3>Δείκτες</h3><p>Βασικοί δείκτες που αφορούν την χωρητικότητα του συστήματος και την κατανομή του χώρου ανάλογα με το είδος της αποθηκευμένης πληροφορίας.</p>' },
			  { element : '#alerts', 'tooltip' : 'Μηνύματα συστήματος', 'position' : 'L', 'text' : '<h3>Μηνύματα και ειδοποιήσεις</h3><p>Εδώ εμφανίζονται τα μηνύματα του συστήματος και αφορούν εγγραφές νέων χρηστών, χρήστες που δεν ενεργοποίησαν τον λογαραισμό τους κατα την διαδικασία εγγραφής, παραστατικά πωλήσεων που παράγονται, μηνύματα φορμών κλπ.</p>' },
              { element : '.update-btn', 'tooltip' : 'Ενημέρωση γραφήμάτων', 'position' : 'R', 'text' : '<h3>Γραφήματα</h3><p>Καλέστε τα σχετικά γραφήματα που αφορούν σύνολα εργασιών ως προς τον χρόνο εκτέλεσης τους. Κατόπιν επιλέξτε τύπο γραφήματος και χρονική περίοδο αναφοράς.</p>' },
			  { element : '#tasks', 'tooltip' : 'Πλάισιο εργασιών', 'position' : 'TL', 'text' : '<h3>Εργασίες</h3><p>Παρακολουθήστε τις εργασίες που ανατέθηκαν στο σύστημα και είναι σε εξέλιξη ή έχουν ολοκληρωθεί. Το click στον τίτλο σας μεταφέρει στην προεπισκόπηση-προβολή της εργασίας, το click στο σύμβολο ολοκλήρωσης ή εξέλιξης της εργασίας ενημερώνει τα στατιστικά μεγέθη σύμφωνα με τις μετρήσεις που έχουν αποθηκευτεί για την συγκεκριμένη εργασία.</p>' },
			  { element : '#addons', 'tooltip' : 'Πρόσθετα', 'position' : 'T', 'text' : '<h3>Πρόσθετα</h3><p>Λίστα πρόσθετων χαρακτηριστικών που έχουν ενεργοποιηθεί ή μπορούν να ενεργοποιηθούν για τον εμπλουτισμό του συστήματος.<br/>ΠΡΟΣΟΧΗ: Απαιτείται γνώση των χειρισμών καθώς και των ιδιαίτερων χαρακτηριστικών για κάθε πρόσθετο, διαφορετικά μπορεί να απορυθμιστούν ενότητες του e-Enterprise που είναι απαραίτητες για την λειτουργεία του.</p>' },
              { element : '#reservation', 'tooltip' : 'Επιλογή ημερομηνιακού διαστήματος αναφοράς', 'position' : 'R', 'text' : '<h3>Αναφορές</h3><p>Επιλογή ημερομηνιακού διαστήματος που ανανεώνει τα στατιστικά στοιχεία σύμφωνα με την επιλεγμένη χρονική περίοδο.</p>' },
              { element : '.divider-vertical', 'tooltip' : 'Αναφορές ανα μήνα και έτη', 'position' : 'B', 'text' : '<h3>Αναφορές</h3><p>Επιλογή μήνα ή έτους, ημερομηνιακού διαστήματος που ανανεώνει τα στατιστικά στοιχεία σύμφωνα με την επιλεγμένη χρονική περίοδο. Εξ όρισμού η πρώτη είσοδος στο σύστημα ανακτεί τα στοιχεία του τρέχοντος έτους.</p>' },
              { element : '.nav.top-menu', 'tooltip' : 'Δείκτες εργασιών και μηνυμάτων', 'position' : 'B', 'text' : '<h3>Συντόμευσεις</h3><p>Τρέχουσες εργασίες και μηνύματα εμφανίζονται σε αυτή την περιοχή.</p>' },
              { element : '.sidebar-menu', 'tooltip' : 'Μενου επιλογών', 'position' : 'R', 'text' : '<h3>Μενου</h3><p>Επιλέξτε ενότητα και εφαρμογή κάνοντας click σε αυτή την περιοχή.</p>' },
              { element : '#console_exit', 'tooltip' : 'Προσωρινή έξοδος', 'position' : 'B', 'text' : '<h3>Προσωρινή έξοδος</h3><p>Επιστρέψτε στις σελίδες του e-shop και επιστρέψτε στο e-Enterprise κάθε φορά που θέλετε να εμφανίσετε την περιοχή εποπτίας ή να ρυθμίσετε λειτουργίες χρησιμοποιώντας τα στοιχεία του e-shop, πατώντας το πλήκτρο εισαγωγής και χωρίς να ξαναζητηθούν τα στοιχεία πιστοποίησης χρήστη.</p>' },
			  { element : '#eshop_exit', 'tooltip' : 'Έναρξη περιήγησης στο e-shop', 'position' : 'B', 'text' : '<h3>Περιήγηση στο e-shop</h3><p>Περιηγηθείτε στο e-shop, προβάλετε κατηγορίες και προϊόντα. Κάθε φορά που θέλετε να εισαχθείτε στο περιβάλλον διαχείρισης πατήστε το πλήκτρο e-Enterprise που θα βρείτε στο πάνω μέρος κάθε σελίδας, εφόσον έχετε κάνει login στην περιοχή εποπτίας του e-Enterprise. Μπορείτε να χρησιμοποιείτε το πλήκτρο εισαγωγής Επιστρέψτε στις σελίδες του e-shop και ξαναεισαχθείτε στις σελίδες διαχείρισης με ένα click και χωρίς να ξαναζητηθούν τα στοιχεία πιστοποίησης χρήστη.</p>' },
			  { element : '.username', 'tooltip' : 'Επιλογές χρήστη', 'position' : 'B', 'text' : '<h3>Eπιλογές χρήστη</h3><p>Εξοδος απο το σύστημα ή ρύθμιση ειδικών στοιχείων που αφορούν τον χειριστή του συστήματος. Η βοήθεια παραμένει ενεργή και επαναλαμβάνει την ξενάγηση στο σύστημα, κάθε φορά που θα επιλεχθεί απο αυτή την περιοχή.</p>' }
            ] ,
            controlsPosition : 'BR'
          };

          $.aSimpleTour(options);  
        });
      });
    </script>      

   <script src="js/easy-pie-chart.js"></script>
   <script src="js/sparkline-chart.js"></script>
   
   <!--script src="js/home-page-calender.js"></script>
   <script src="js/home-chartjs.js"></script-->
   
   <!-- stream dialog -->
   <script type="text/javascript" src="js/zebra/zebra_dialog.js"></script>
   <script language="JavaScript">		
		/*setInterval(function() {<phpdac>rcpmenu.streamDialog</phpdac>}, 30000);	//disabled for demo*/
   </script>
   <!-- end stream dialog -->    
  
   <!-- END JAVASCRIPTS --> 
   
   <phpdac>frontpage.include_part use /parts/google-analytics.php+++metro</phpdac>
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->     
</body>
<!-- END BODY -->
</html>