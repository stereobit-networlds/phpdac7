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
            <!-- BEGIN PAGE HEADER-->   
				<phpdac>frontpage.nvldac2 use rculiststats.cpStats+rculiststats.select_timeline:bmail-timeline</phpdac>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <!--BEGIN METRO STATES-->
                <div class="metro-nav">
                    <div class="metro-nav-block nav-block-orange">
                        <a data-original-title="" href="#">
                            <i class="icon-user"></i>
                            <div class="info"><phpdac>rculiststats.getStats use totalSubscribers</phpdac></div>
                            <div class="status"><phpdac>frontpage.slocale use _breg</phpdac></div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-olive double">
                        <a data-original-title="" href="#">
                            <i class="icon-envelope"></i>
                            <div class="info"><phpdac>rculiststats.getStats use inactiveQueue</phpdac></div>
                            <div class="status"><phpdac>frontpage.slocale use _mailsent</phpdac></div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-green">
                        <a data-original-title="" href="#">
                            <i class="icon-comments-alt"></i>
                            <div class="info"><phpdac>rculiststats.getStats use succeed</phpdac></div>
                            <div class="status"></i><phpdac>i18nL.translate use success+RCCONTROLPANEL</phpdac></div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-yellow">
                        <a data-original-title="" href="#">
                            <i class="icon-eye-open"></i>
                            <div class="info"><phpdac>rculiststats.getStats use repliedQueue</phpdac></div>
                            <div class="status"></i><phpdac>i18nL.translate use view+RCCRM</phpdac></div>
                        </a>
                    </div>					
                    <div class="metro-nav-block nav-light-brown">
                        <a data-original-title="" href="#">
                            <i class="icon-remove-sign"></i>
                            <div class="info"><phpdac>rculiststats.getStats use failed</phpdac></div>
                            <div class="status"></i><phpdac>i18nL.translate use failed+RCCRM</phpdac></div>
                        </a>
                    </div>								
                </div>
                <div class="metro-nav">
                    <div class="metro-nav-block nav-light-blue">
                        <a data-original-title="" href="#">
                            <i class="icon-tasks"></i>
                            <div class="info"><phpdac>rculiststats.getStats use totalQueue</phpdac></div>
                            <div class="status"><phpdac>frontpage.slocale use _bqueue</phpdac></div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-light-green">
                        <a data-original-title="" href="#">
                            <i class="icon-user"></i>
                            <div class="info"><phpdac>rculiststats.getStats use activeSubscribers</phpdac></div>
                            <div class="status"><phpdac>frontpage.slocale use _breg</phpdac></div>
                        </a>
                    </div>					
                    <div class="metro-nav-block nav-light-purple">
                        <a data-original-title="" href="#">
                            <i class="icon-user"></i>
                            <div class="info"><phpdac>rculiststats.getStats use inactiveSubscribers</phpdac></div>
                            <div class="status"><phpdac>frontpage.slocale use _bunreg</phpdac></div>
                        </a>
                    </div>						
                    <div class="metro-nav-block nav-block-red">
                        <a data-original-title="" href="#">
                            <i class="icon-bar-chart"></i>
                            <div class="info"><phpdac>rculiststats.getStats use runningCampaigns</phpdac></div>
                            <div class="status"><phpdac>frontpage.slocale use _runningcamps</phpdac></div>
                        </a>
                    </div>															
                    <div class="metro-nav-block nav-block-grey double">
                        <a data-original-title="" href="#">
                            <i class="icon-external-link"></i>
                            <div class="info"><phpdac>rculiststats.getStats use activeQueue</phpdac></div>
                            <div class="status"><phpdac>frontpage.slocale use _activequeue</phpdac></div>
                        </a>
                    </div>
                </div>
                <div class="space10"></div>
                <!--END METRO STATES-->
            </div>
			<div class="row-fluid">
                <div class="span7">
								
                    <div class="widget blue">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> <phpdac>i18nL.translate use bmailcamp+RCPMENU</phpdac></h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
							<div class="tabbable ">
                                <ul class="nav nav-tabs">
									<li class="active"><a href="#widget_tab1" data-toggle="tab"><phpdac>i18nL.translate use bmailcamp+RCPMENU</phpdac></a></li>
									<li><a href="#widget_tab2" data-toggle="tab"><phpdac>i18nL.translate use MAILCLICKS+RCBULKMAIL</phpdac></a></li>									
                                    <li><a href="#widget_tab3" data-toggle="tab"><phpdac>frontpage.slocale use _bclick</phpdac></a></li>                                    
                                </ul>
								<div class="tab-content">
                                    <div class="tab-pane active" id="widget_tab1">
										<ul class="unstyled">
										<phpdac>rculiststats.percentofCamps use bmail-task-in-progress-important</phpdac>
										<phpdac>rculiststats.lastCamps use bmail-task-in-progress-success+5</phpdac>
										</ul>
										<div class="control-group">
											<label class="control-label"><phpdac>i18nL.translate use SEARCH+SHSEARCH</phpdac></label>
											<div class="controls">
												<phpdac>rculiststats.campaignSelect</phpdac>
											</div>
											<label class="control-label">Instances (last 5)</label>
										</div>
										<ul class="unstyled">
											<phpdac>rculiststats.instanceCamps use bmail-task-in-progress-instance+5</phpdac>
										</ul>
									</div>	
									<div class="tab-pane" id="widget_tab2">
                                        <ul class="item-list scroller padding"  style="overflow: hidden; width: auto; " data-always-visible="1">
										<phpdac>rculiststats.getViews use notification-success+9</phpdac>
										</ul>
										<div class="space10"></div>
										<a href="cpulists.php?t=cpulists&cid=<phpdac>cms.nvldac2 use cid+cms.echostr:cid++</phpdac>" class="pull-right"><phpdac>i18nL.translate use viewallmessages+RCCONTROLPANEL</phpdac></a>
										<div class="clearfix no-top-space no-bottom-space"></div>
                                    </div>
                                    <div class="tab-pane" id="widget_tab3">
                                        <ul class="item-list scroller padding"  style="overflow: hidden; width: auto; " data-always-visible="1">							 
										<phpdac>rculiststats.getClicks use notification-success+9</phpdac>
										</ul>
										<div class="space10"></div>
										<a href="cpulists.php?t=cpviewclicks&cid=<phpdac>fronthtmlpage.echostr use rculiststats.cid</phpdac>" class="pull-right"><phpdac>i18nL.translate use viewallmessages+RCCONTROLPANEL</phpdac></a>
										<div class="clearfix no-top-space no-bottom-space"></div>
                                    </div>
								</div>	
							</div>
                        </div>
                    </div>
					
                    <div class="widget purple">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> <phpdac>frontpage.slocale use _bounce</phpdac></a></h4>
							<span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div class="tabbable ">
                                <ul class="nav nav-tabs">
									<li class="active"><a href="#tab_1_1" data-toggle="tab"><phpdac>frontpage.slocale use _bounce</phpdac></a></li>
									<li><a href="#tab_1_2" data-toggle="tab"><phpdac>i18nL.translate use unsubscribe+RCBULKMAIL</phpdac></a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1_1">
                                        <ul class="item-list scroller padding"  style="overflow: hidden; width: auto; " data-always-visible="0">
										<phpdac>rculiststats.getMailBounce use notification-warning+9</phpdac>							 
										</ul>
										<div class="space10"></div>
										<a href="cpulists.php?t=cpcleanbounce&cid=<phpdac>cms.nvldac2 use cid+cms.echostr:cid++</phpdac>" class="pull-right"><phpdac>i18nL.translate use viewallmessages+RCCONTROLPANEL</phpdac></a>
										<div class="clearfix no-top-space no-bottom-space"></div>
                                    </div>
                                    <div class="tab-pane" id="tab_1_2">
                                        <ul class="item-list"  style="overflow: hidden; width: auto; " data-always-visible="1">
										<phpdac>rculiststats.getUnsubs use notification-warning+9</phpdac>							 
										</ul>
										<div class="space10"></div>
										<a href="cpsubscribers.php" class="pull-right"><phpdac>i18nL.translate use viewallmessages+RCCONTROLPANEL</phpdac></a>
										<div class="clearfix no-top-space no-bottom-space"></div>
                                    </div>									
                                </div>
                            </div>
                        </div>
                    </div>	
					
                </div>			
                <div class="span5">
					<div class="widget-body">
                            <div class="text-center">
                                <div class="easy-pie-chart">
                                    <div class="percentage success" data-percent="<phpdac>rculiststats.getStats use percentSucceed</phpdac>">
									<span><phpdac>rculiststats.getStats use percentSucceed</phpdac></span>%
									</div>
                                    <div class="title"><phpdac>i18nL.translate use mailsucceed</phpdac></div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<phpdac>rculiststats.getStats use percentUnread</phpdac>">
									<span><phpdac>rculiststats.getStats use percentUnread</phpdac></span>%
									</div>
                                    <div class="title"><phpdac>i18nL.translate use mailnotviewed</phpdac></div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<phpdac>rculiststats.getStats use percentFailed</phpdac>">
									<span><phpdac>rculiststats.getStats use percentFailed</phpdac></span>%
									</div>
                                    <div class="title"><phpdac>i18nL.translate use mailfailed</phpdac></div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<phpdac>rculiststats.getStats use percentUnsend</phpdac>">
									<span><phpdac>rculiststats.getStats use percentUnsend</phpdac></span>%
									</div>
                                    <div class="title"><phpdac>i18nL.translate use mailinprocess</phpdac></div>
                                </div>
                            </div>
                    </div>
					
					<div class="widget yellow">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> <phpdac>i18nL.translate use mailqueue+CPFLOTCHARTS</phpdac> </h4>
                         <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                         </span>
						 <div class="update-btn">
                            <a href="javascript:sndReqArg('cp.php?t=cpchartshow&group=&ai=1&report=mailqueue&statsid='+statsid.value,'mailqueue');" class="btn"><i class="icon-repeat"></i> <phpdac>i18nL.translate use CPFLOTCHARTS_DPC+CPFLOTCHARTS</phpdac></a>
                         </div>
                        </div>
                        <div class="widget-body">
                            <div class="text-center">
                                <div id="mailqueue"></div>
                            </div>
							<div class="plots"></div>							
                        </div>
                    </div>		
					
					<!--hpdac>rculiststats._show_charts</phpda-->
					<INPUT TYPE= "hidden" ID="statsid" VALUE="0" />					
					
					<!--div class="widget red">
                         <div class="widget-title">
                             <h4><i class="icon-download"></i> <phpdac>frontpage.slocale use _bounce</phpdac> </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                             
                         </div>
                     </div-->			

                    <div class="widget orange">
                        <div class="widget-title">
                            <h4><i class="icon-bell-alt"></i> <phpdac>i18nL.translate use messages+RCCONTROLPANEL</phpdac></h4>
                            <span class="tools">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            </span>
                        </div>
                        <div class="widget-body">
						    <phpdac>rculiststats.viewMessages use alert</phpdac>
                        </div>
                    </div>					 								
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
   <!--script src="js/form-component.js"></script partial -->   
   <script language="javascript" type="text/javascript">
   
    <phpdac>bmailcharts.jsflotMailcharts</phpdac>  
	
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
        $('#startTour').click(function(){
          options = {
            data : [
              { element : '.metro-nav', 'tooltip' : 'Σύνολα στατιστικών', 'position' : 'T', 'text' : '<h3>Metro</h3><p>Παρακολουθήστε με μια ματια τα κρίσιμα στατιστικά μεγέθη που αφορούν τις εργασίες που έχετε αναθέσει στο σύστημα.</p>'  },
              { element : '.metro-nav-block.nav-light-blue', 'tooltip' : 'Ενότητα αναφοράς', 'position' : 'TL', 'text' : '<h3>Ενότητες</h3><p>Κάθε πλαίσιο αναφέρεται στον δείκτη που παρακολουθείται. Ενημερώνεται είτε απο δικές σας ενέργειες είτε απο αποτελέσματα που προκύπτουν απο τις εργασίες που αναθέτετε στο σύστημα είτε απο τις απαντήσεις που λαμβάνονται, σε βάθος χρόνου.</p>' },
              { element : '.widget.purple', 'tooltip' : 'Πλάισιο εργασιών', 'position' : 'TL', 'text' : '<h3>Εργασίες</h3><p>Παρακολουθήστε τις εργασίες που ανατέθηκαν στο σύστημα και είναι σε εξέλιξη ή έχουν ολοκληρωθεί. Το click στον τίτλο σας μεταφέρει στην προεπισκόπηση-προβολή της εργασίας, το click στο σύμβολο ολοκλήρωσης ή εξέλιξης της εργασίας ενημερώνει τα στατιστικά μεγέθη σύμφωνα με τις μετρήσεις που έχουν αποθηκευτεί για την συγκεκριμένη εργασία.</p>' },
              { element : '.controls', 'tooltip' : 'Αναζήτηση εργασιών που ανατέθηκαν στο παρελθόν', 'position' : 'BL' , 'text' : '<h3>Εργασίες</h3><p>Αναζητήστε εργασίες που ολοκληρώθηκαν και είναι αποθηκευμένες στο σύστημα.<br/> Δείτε τα στατιστικά παλιοτέρων εργασιών και ρυθμίστε αναλόγως τις επόμενες εργασίες σας.</p>' },
              { element : '.easy-pie-chart', 'tooltip' : 'Δείκτες αποτελεσματικότητας', 'position' : 'B', 'text' : '<h3>Δείκτες</h3><p>Ποσοστιαίοι δείκτες αναφέρουν τα ποσοστά επιτυχίας ή αποτυχίας των εργασιών που αντίθενται. Τα click των παραληπτών ανανεώνουν αυτόματα τις μετρήσεις και μεταβάλονται σε βάθος χρόνου.</p>' },
              { element : '.update-btn', 'tooltip' : 'Ενημέρωση γραφήμάτων', 'position' : 'L', 'text' : '<h3>Γραφήματα</h3><p>Καλέστε τα σχετικά γραφήματα που αφορούν σύνολα εργασιών ως προς τον χρόνο εκτέλεσης τους. Κατόπιν επιλέξτε τύπο γραφήματος και χρονική περίοδο αναφοράς.</p>' },
              { element : '.icon-download', 'tooltip' : 'Ειδοποιήσεις παραληπτών', 'position' : 'T', 'text' : '<h3>Ειδοποιήσεις</h3><p>Τα click και οι συνακόλουθες ενέργειες των παραληπτών καταγράφονται και συνοπτικά αναφέρονται σε αυτή την περιοχή.</p>' },
              { element : '.widget.orange', 'tooltip' : 'Μηνύματα συστήματος', 'position' : 'R', 'text' : '<h3>Μηνύματα</h3><p>Εδώ εμφανίζονται τα μηνύματα του συστήματος και αφορόυν συνήθως τις ενέργειες που εκτελούνται απο το συστήμα.</p>' },
              { element : '#reservation', 'tooltip' : 'Επιλογή ημερομηνιακού διαστήματος αναφοράς', 'position' : 'R', 'text' : '<h3>Αναφορές</h3><p>Επιλογή ημερομηνιακού διαστήματος που ανανεώνει τα στατιστικά στοιχεία σύμφωνα με την επιλεγμένη χρονική περίοδο.</p>' },
              { element : '.divider-vertical', 'tooltip' : 'Αναφορές ανα μήνα και έτη', 'position' : 'B', 'text' : '<h3>Αναφορές</h3><p>Επιλογή μήνα ή έτους, ημερομηνιακού διαστήματος που ανανεώνει τα στατιστικά στοιχεία σύμφωνα με την επιλεγμένη χρονική περίοδο. Εξ όρισμού η πρώτη είσοδος στο σύστημα ανακτεί τα στοιχεία του τρέχοντος έτους.</p>' },
              { element : '.nav.top-menu', 'tooltip' : 'Δείκτες εργασιών και μηνυμάτων', 'position' : 'B', 'text' : '<h3>Συντόμευσεις</h3><p>Τρέχουσες εργασίες και μηνύματα εμφανίζονται σε αυτή την περιοχή.</p>' },
              { element : '.sidebar-menu', 'tooltip' : 'Μενου επιλογών', 'position' : 'R', 'text' : '<h3>Μενου</h3><p>Επιλέξτε ενότητα και εφαρμογή κάνοντας click σε αυτή την περιοχή.</p>' },
              { element : '.dropdown.mtop5', 'tooltip' : 'Προσωρινή έξοδος', 'position' : 'B', 'text' : '<h3>Προσωρινή έξοδος</h3><p>Επιστρέψτε στις σελίδες του e-Enterprise και επιστρέψτε κάθε φορά που θέλετε να εμφανίσετε την περιοχή εποπτίας, πατώντας το πλήκτρο εισαγωγής και χωρίς να ξαναζητηθούν τα στοιχεία πιστοποίησης χρήστη.</p>' },
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
  
   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>