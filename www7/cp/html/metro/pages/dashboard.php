<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Metro Lab</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="Mosaddek" name="author" />
   <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" />
   <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="css/style.css" rel="stylesheet" />
   <link href="css/style-responsive.css" rel="stylesheet" />
   <link href="css/style-default.css" rel="stylesheet" id="style_color" />
   <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
   <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
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
                <!--BEGIN METRO STATES-->
                <div class="metro-nav">
                    <div class="metro-nav-block nav-block-orange">
                        <a data-original-title="" href="#">
                            <i class="icon-user"></i>
                            <div class="info">321</div>
                            <div class="status">New User</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-olive">
                        <a data-original-title="" href="#">
                            <i class="icon-tags"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Transactions+revenue</phpdac> &euro;</div>
                            <div class="status">Sales</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-yellow">
                        <a data-original-title="" href="#">
                            <i class="icon-comments-alt"></i>
                            <div class="info">49</div>
                            <div class="status">Comments</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-green double">
                        <a data-original-title="" href="#">
                            <i class="icon-eye-open"></i>
                            <div class="info">+897</div>
                            <div class="status">Unique Visitor</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-red">
                        <a data-original-title="" href="#">
                            <i class="icon-bar-chart"></i>
                            <div class="info">+288</div>
                            <div class="status">Update</div>
                        </a>
                    </div>
                </div>
                <div class="metro-nav">
                    <div class="metro-nav-block nav-light-purple">
                        <a data-original-title="" href="#">
                            <i class="icon-shopping-cart"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Transactions+subtotal</phpdac></div>
                            <div class="status">New Order</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-light-blue double">
                        <a data-original-title="" href="#">
                            <i class="icon-tasks"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Items</phpdac></div>
                            <div class="status"><phpdac>frontpage.slocale use _items</phpdac></div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-light-green">
                        <a data-original-title="" href="#">
                            <i class="icon-envelope"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Mail+subtotal</phpdac></div>
                            <div class="status">Messages</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-light-brown">
                        <a data-original-title="" href="#">
                            <i class="icon-remove-sign"></i>
                            <div class="info">34</div>
                            <div class="status">Cancelled</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-grey ">
                        <a data-original-title="" href="#">
                            <i class="icon-external-link"></i>
                            <div class="info"><phpdac>rccontrolpanel.getStats use Transactions</phpdac> &euro;</div>
                            <div class="status">Total Profit</div>
                        </a>
                    </div>
                </div>
                <div class="space10"></div>
                <!--END METRO STATES-->
            </div>
            <div class="row-fluid">
                <div class="span6">
                    <!-- BEGIN CHART PORTLET-->
                    <div class="widget ">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Doughnut</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div class="text-center">
                                <canvas id="doughnut" height="300" width="400"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- END CHART PORTLET-->
                </div>
                <div class="span6">
                    <!-- BEGIN CHART PORTLET-->
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"> </i> Line</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div class="text-center">
                                <canvas id="line" height="300" width="450"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- END CHART PORTLET-->
                </div>
            </div>

            <div class="row-fluid">
                <div class="span7">
                    <!--BEGIN GENERAL STATISTICS-->
                    <div class="widget orange">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> General Statistics </h4>
                         <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                         </span>
                            <div class="update-btn">
                                <a href="javascript:;" class="btn update-easy-pie-chart"><i class="icon-repeat"></i> Update</a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="text-center">
                                <div class="easy-pie-chart">
                                    <div class="percentage success" data-percent="55"><span>55</span>%</div>
                                    <div class="title">New visits</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="46"><span>46</span>%</div>
                                    <div class="title">Bounce rate</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="92"><span>92</span>%</div>
                                    <div class="title">Server load</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="84"><span>752</span>MB</div>
                                    <div class="title">Used RAM</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--END GENERAL STATISTICS-->
                </div>
                <div class="span5">
                    <!--BEGIN GENERAL STATISTICS-->
                    <div class="widget purple">
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
                    </div>
                    <!--END GENERAL STATISTICS-->
                </div>
            </div>
            <div class="row-fluid">
                 <div class="span6">
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
                 <div class="span6">
                     <!-- BEGIN CHAT PORTLET-->
                     <div class="widget red">
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
            <div class="row-fluid">
                <div class="span7 responsive" data-tablet="span7 fix-margin" data-desktop="span7">
                    <!-- BEGIN CALENDAR PORTLET-->
                    <div class="widget yellow">
                        <div class="widget-title">
                            <h4><i class="icon-calendar"></i> Calendar</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div id="calendar" class="has-toolbar"></div>
                        </div>
                    </div>
                    <!-- END CALENDAR PORTLET-->
                </div>
                <div class="span5">
                    <!-- BEGIN PROGRESS PORTLET-->
                    <div class="widget purple">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> Task In progress </h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <ul class="unstyled">
                                <li>
                                    <span class="btn btn-inverse"> <i class="icon-refresh"></i></span>  Update Jquery <strong class="label"> 48%</strong>
                                    <div class="space10"></div>
                                    <div class="progress">
                                        <div style="width: 48%;" class="bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <span class="btn btn-inverse"> <i class="icon-check"></i></span>  Update font awesome <strong class="label label-success"> 85%</strong>
                                    <div class="space10"></div>
                                    <div class="progress progress-success">
                                        <div style="width: 85%;" class="bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <span class="btn btn-inverse"> <i class="icon-fire"></i></span>  Update CSS3 <strong class="label label-important"> 65%</strong>
                                    <div class="space10"></div>
                                    <div class="progress progress-danger">
                                        <div style="width: 65%;" class="bar"></div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- END PROGRESS PORTLET-->
                    <!-- BEGIN ALERTS PORTLET-->
                    <div class="widget orange">
                        <div class="widget-title">
                            <h4><i class="icon-bell-alt"></i> Alerts</h4>
                            <span class="tools">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div class="alert">
                                <button data-dismiss="alert" class="close">×</button>
                                <strong>Warning!</strong> Best check yo self, you're not looking too good.
                            </div>
                            <div class="alert alert-success">
                                <button data-dismiss="alert" class="close">×</button>
                                <strong>Success!</strong> You successfully read this important message.
                            </div>
                            <div class="alert alert-info">
                                <button data-dismiss="alert" class="close">×</button>
                                <strong>Info!</strong> Heads up! This alert needs your attention.
                            </div>
                            <div class="alert alert-error">
                                <button data-dismiss="alert" class="close">×</button>
                                <strong>Error!</strong> Change a few things. Please submit again.
                            </div>
                        </div>
                    </div>
                    <!-- END ALERTS PORTLET-->
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
   <script src="assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->

   <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
   <script src="js/jquery.sparkline.js" type="text/javascript"></script>
   <script src="assets/chart-master/Chart.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>


   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!--script for this page only-->

   <script src="js/easy-pie-chart.js"></script>
   <script src="js/sparkline-chart.js"></script>
   <script src="js/home-page-calender.js"></script>
   <script src="js/home-chartjs.js"></script>

   <!-- END JAVASCRIPTS --> 
   
   <phpdac>frontpage.include_part use /parts/google-analytics.php+++meteor</phpdac>
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->     
</body>
<!-- END BODY -->
</html>