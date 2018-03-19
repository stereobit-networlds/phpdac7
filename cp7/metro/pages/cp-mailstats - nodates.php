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
   <meta content="Mosaddek" name="author" />
   <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" />
   <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="css/style.css" rel="stylesheet" />
   <link href="css/style-responsive.css" rel="stylesheet" />
   <link href="css/style-default.css" rel="stylesheet" id="style_color" />
   <!--link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" /-->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" />
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" />	
	
   <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
   
    <link href="assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />  
    <link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen/chosen.css" />
	<!--link rel="stylesheet" type="text/css" href="assets/jquery-tags-input/jquery.tagsinput.css" />
    <link rel="stylesheet" type="text/css" href="assets/clockface/css/clockface.css" /-->	
   
   <script language="JavaScript">
function createRequestObject() {
    var ro;
    var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer"){
        ro = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
        ro = new XMLHttpRequest();
    }
    return ro;
}
var http = createRequestObject();

function sndReqArg(url) {
    var params = url+'&ajax=1';

    http.open('post', params, true);
    http.setRequestHeader("Content-Type", "text/html; charset=utf-8");
    http.setRequestHeader("encoding", "utf-8");	
    http.onreadystatechange = handleResponse;	
    http.send(null);
}

function handleResponse() {
    if(http.readyState == 4){
        var response = http.responseText;
        var update = new Array();
        response = response.replace( /^\s+/g, "" ); // strip leading 
        response = response.replace( /\s+$/g, "" ); // strip trailing		
        if(response.indexOf('|' != -1)) {
            //alert(response); 	
            update = response.split('|');
            document.getElementById(update[0]).innerHTML = update[1];
        }	
    }
}   
   
window.setInterval("sndReqArg('cpbulkmail.php?t=cpchartshow&group=&ai=1&report=mailqueue&statsid='+statsid.value,'mailqueue')",63000);
   </script>
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
                            <div class="info"><phpdac>rcbulkmail.getStats use totalSubscribers</phpdac></div>
                            <div class="status">Subscribers</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-olive double">
                        <a data-original-title="" href="#">
                            <i class="icon-envelope"></i>
                            <div class="info"><phpdac>rcbulkmail.getStats use inactiveQueue</phpdac></div>
                            <div class="status">Sent</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-green">
                        <a data-original-title="" href="#">
                            <i class="icon-comments-alt"></i>
                            <div class="info"><phpdac>rcbulkmail.getStats use succeed</phpdac></div>
                            <div class="status">Succeed</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-yellow">
                        <a data-original-title="" href="#">
                            <i class="icon-eye-open"></i>
                            <div class="info"><phpdac>rcbulkmail.getStats use repliedQueue</phpdac></div>
                            <div class="status">Viewed</div>
                        </a>
                    </div>					
                    <div class="metro-nav-block nav-light-brown">
                        <a data-original-title="" href="#">
                            <i class="icon-remove-sign"></i>
                            <div class="info"><phpdac>rcbulkmail.getStats use failed</phpdac></div>
                            <div class="status">Failed</div>
                        </a>
                    </div>								
                </div>
                <div class="metro-nav">
                    <div class="metro-nav-block nav-light-blue">
                        <a data-original-title="" href="#">
                            <i class="icon-tasks"></i>
                            <div class="info"><phpdac>rcbulkmail.getStats use totalQueue</phpdac></div>
                            <div class="status"><phpdac>frontpage.slocale use Total Queue</phpdac></div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-light-green">
                        <a data-original-title="" href="#">
                            <i class="icon-tags"></i>
                            <div class="info"><phpdac>rcbulkmail.getStats use campaigns</phpdac></div>
                            <div class="status">Total Campaigns</div>
                        </a>
                    </div>					
                    <div class="metro-nav-block nav-light-purple">
                        <a data-original-title="" href="#">
                            <i class="icon-shopping-cart"></i>
                            <div class="info"><phpdac>rcbulkmail.getStats use usedCampaigns</phpdac></div>
                            <div class="status">Campaigns In Use</div>
                        </a>
                    </div>						
                    <div class="metro-nav-block nav-block-red">
                        <a data-original-title="" href="#">
                            <i class="icon-bar-chart"></i>
                            <div class="info">+<phpdac>rcbulkmail.getStats use runningCampaigns</phpdac></div>
                            <div class="status">Running Campaigns</div>
                        </a>
                    </div>															
                    <div class="metro-nav-block nav-block-grey double">
                        <a data-original-title="" href="#">
                            <i class="icon-external-link"></i>
                            <div class="info"><phpdac>rcbulkmail.getStats use activeQueue</phpdac></div>
                            <div class="status">Tasks In Proccess</div>
                        </a>
                    </div>
                </div>
                <div class="space10"></div>
                <!--END METRO STATES-->
            </div>
			<div class="row-fluid">
                <div class="span7">
                    <!-- BEGIN PROGRESS PORTLET-->
                    <div class="widget purple">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> Tasks</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <ul class="unstyled">
                                <phpdac>rcbulkmail.percentofCamps use task-in-progress</phpdac>
								<phpdac>rcbulkmail.lastCamps use task-in-progress-check+5</phpdac>
                            </ul>
							<div class="control-group">
                                <label class="control-label">Search</label>
                                <div class="controls">
									<phpdac>rcbulkmail.campaignSelect use cpmailstats</phpdac>
                                </div>
								<label class="control-label">Instances (last 5)</label>
                            </div>
							<ul class="unstyled">
								<phpdac>rcbulkmail.instanceCamps use task-in-progress-instance+5</phpdac>
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
						    <phpdac>rcbulkmail.viewMessages use alert</phpdac>
                        </div>
                    </div>
                    <!-- END ALERTS PORTLET-->
                </div>			
                <div class="span5">
					<div class="widget-body">
                            <div class="text-center">
                                <div class="easy-pie-chart">
                                    <div class="percentage success" data-percent="<phpdac>rcbulkmail.getStats use percentSucceed</phpdac>">
									<span><phpdac>rcbulkmail.getStats use percentSucceed</phpdac></span>%
									</div>
                                    <div class="title">Succeed</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<phpdac>rcbulkmail.getStats use percentSucceed</phpdac>">
									<span><phpdac>rcbulkmail.getStats use percentFailed</phpdac></span>%
									</div>
                                    <div class="title">Failed</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<phpdac>rcbulkmail.getStats use percentSubscribersLeft</phpdac>">
									<span><phpdac>rcbulkmail.getStats use percentSubscribersLeft</phpdac></span>%
									</div>
                                    <div class="title">Subscribers load</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<phpdac>rcbulkmail.getStats use percentMailsLeft</phpdac>">
									<span><phpdac>rcbulkmail.getStats use percentMailsLeft</phpdac></span>%
									</div>
                                    <div class="title">Data used</div>
                                </div>
                            </div>
                    </div>					
				
					<phpdac>rcbulkmail._show_charts</phpdac>
					<INPUT TYPE= "hidden" ID="statsid" VALUE="0" />
					
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

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   <script type="text/javascript" src="assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
   <script type="text/javascript" src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
   <!--script type="text/javascript" src="assets/clockface/js/clockface.js"></script>
   <script type="text/javascript" src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
   <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
   <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>  
	<script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
   <script type="text/javascript" src="assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script-->   
   <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
   <script src="js/jquery.sparkline.js" type="text/javascript"></script>
   <script src="assets/chart-master/Chart.js"></script>
    <script type="text/javascript" src="assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
   <script src="assets/fancybox/source/jquery.fancybox.pack.js"></script>	
   <script src="js/jquery.scrollTo.min.js"></script>


   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!--script for this page only-->  
   <script src="js/form-component.js"></script>   

   <script src="js/easy-pie-chart.js"></script>
   <script src="js/sparkline-chart.js"></script>
   <!--script src="js/home-page-calender.js"></script>
   <script src="js/home-chartjs.js"></script-->

   <script language="javascript" type="text/javascript">

       $(function() {

           $.configureBoxes();

       });

   </script>   
   
   <!-- END JAVASCRIPTS --> 
   
   <phpdac>frontpage.include_part use /parts/google-analytics.php+++meteor</phpdac>
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->     
</body>
<!-- END BODY -->
</html>