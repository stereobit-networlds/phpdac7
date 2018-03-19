<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Crm add activity</title>
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
                             <a href="javascript:;" class="edit" title="Edit Photo">
                                 <i class="icon-pencil"></i>
                             </a>
                         </div>
                         <a href="cpcrmtrace.php?t=cpcrmprofile&v=<phpdac>rccrmtrace.currentVisitor</phpdac>&<phpdac>rccrmtrace.getDateRange</phpdac>" class="profile-features">
                             <i class=" icon-user"></i>
                             <p class="info">Profile</p>
                         </a>
                         <a href="cpcrmtrace.php?t=cpcrmactivities&v=<phpdac>rccrmtrace.currentVisitor</phpdac>&<phpdac>rccrmtrace.getDateRange</phpdac>" class="profile-features active">
                             <i class=" icon-calendar"></i>
                             <p class="info">Activities</p>
                         </a>
                         <a href="cpcrmtrace.php?t=cpcrmtimeline&v=<phpdac>rccrmtrace.currentVisitor</phpdac>&<phpdac>rccrmtrace.getDateRange</phpdac>" class="profile-features">
                             <i class=" icon-th-list"></i>
                             <p class="info">Timeline</p>
                         </a>							 
                         <a href="cpcrmtrace.php?t=cpcrmcontact&v=<phpdac>rccrmtrace.currentVisitor</phpdac>&<phpdac>rccrmtrace.getDateRange</phpdac>" class="profile-features ">
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
                                 <a href="javascript:document.getElementById('pForm').submit();" class="btn btn-edit btn-large pull-right mtop20"> Save Activity </a>
                             </div>
                         </div>
                         <div class="space15"></div>
                         <div class="row-fluid">
                             <div class="span12 bio form">
                                 <h2> Add activity</h2>
                                 <form id="pForm" class="form-horizontal" method="POST" action="cpcrmtrace.php?t=cpcrmsaveactivity&v=<phpdac>rccrmtrace.currentVisitor</phpdac>">
								     <input type="hidden" name="FormName" value="saveactivity" />
								     <input type="hidden" name="FormAction" value="cpcrmsaveactivity" />
								     <input type="hidden" name="v" value="<phpdac>rccrmtrace.currentVisitor</phpdac>">
                                     <div class="control-group">
                                         <label class="control-label">About</label>
                                         <div class="controls">
                                             <textarea rows="5" class="span10 " name="about"><phpdac>rccrmtrace.readContactField use about</phpdac></textarea>
                                         </div>
                                     </div>
                                     <!--div class="control-group">
                                         <label class="control-label">First Name</label>
                                         <div class="controls">
                                             <input type="text" class="span6 " name="firstname" value="<phpdac>rccrmtrace.readContactField use firstname+1</phpdac>" >
                                         </div>
                                     </div>
                                     <div class="control-group">
                                         <label class="control-label">Last Name</label>
                                         <div class="controls">
                                             <input type="text" class="span6 " name="lastname" value="<phpdac>rccrmtrace.readContactField use lastname+1</phpdac>" >
                                         </div>
                                     </div>
                                     <div class="control-group">
                                         <label class="control-label">Address</label>
                                         <div class="controls">
                                             <input type="text" class="span6 " name="address" value="<phpdac>rccrmtrace.readContactField use address+1</phpdac>" >
                                         </div>
                                     </div>									 
                                     <div class="control-group">
                                         <label class="control-label">Country</label>
                                         <div class="controls">
                                             <input type="text" name="country" data-source="[&quot;Alabama&quot;,&quot;Alaska&quot;,&quot;Arizona&quot;,&quot;Arkansas&quot;,&quot;California&quot;,&quot;Colorado&quot;,&quot;Connecticut&quot;,&quot;Delaware&quot;,&quot;Florida&quot;,&quot;Georgia&quot;,&quot;Hawaii&quot;,&quot;Idaho&quot;,&quot;Illinois&quot;,&quot;Indiana&quot;,&quot;Iowa&quot;,&quot;Kansas&quot;,&quot;Kentucky&quot;,&quot;Louisiana&quot;,&quot;Maine&quot;,&quot;Maryland&quot;,&quot;Massachusetts&quot;,&quot;Michigan&quot;,&quot;Minnesota&quot;,&quot;Mississippi&quot;,&quot;Missouri&quot;,&quot;Montana&quot;,&quot;Nebraska&quot;,&quot;Nevada&quot;,&quot;New Hampshire&quot;,&quot;New Jersey&quot;,&quot;New Mexico&quot;,&quot;New York&quot;,&quot;North Dakota&quot;,&quot;North Carolina&quot;,&quot;Ohio&quot;,&quot;Oklahoma&quot;,&quot;Oregon&quot;,&quot;Pennsylvania&quot;,&quot;Rhode Island&quot;,&quot;South Carolina&quot;,&quot;South Dakota&quot;,&quot;Tennessee&quot;,&quot;Texas&quot;,&quot;Utah&quot;,&quot;Vermont&quot;,&quot;Virginia&quot;,&quot;Washington&quot;,&quot;West Virginia&quot;,&quot;Wisconsin&quot;,&quot;Wyoming&quot;]" data-items="4" data-provide="typeahead" style="margin: 0 auto;" class="span6 " value="<phpdac>rccrmtrace.readContactField use country+1</phpdac>">
                                             <p class="help-block">Start typing to auto complete!. E.g: Florida</p>
                                         </div>
                                     </div>
                                     <div class="control-group">
                                         <label class="control-label">Birthday</label>

                                         <div class="controls">
                                             <input type="text" class="m-ctrl-medium span6" size="16" name="birthday" value="<phpdac>rccrmtrace.readContactField use birthday</phpdac>" id="dp1">
                                         </div>
                                     </div>
                                     <div class="control-group">
                                         <label class="control-label">Occupation</label>
                                         <div class="controls">
                                             <input type="text" class="span6 " name="occupation" value="<phpdac>rccrmtrace.readContactField use occupation+1</phpdac>" >
                                         </div>
                                     </div>
                                     <div class="control-group">
                                         <label class="control-label">Email</label>
                                         <div class="controls">
                                             <input type="text" class="span6 " name="email" value="<phpdac>rccrmtrace.readContactField use email</phpdac>" >
                                         </div>
                                     </div>
                                     <div class="control-group">
                                         <label class="control-label">Mobile</label>
                                         <div class="controls">
                                             <input type="text" class="span6 " name="mobile" value="<phpdac>rccrmtrace.readContactField use mobile</phpdac>" >
                                         </div>
                                     </div>
                                     <div class="control-group">
                                         <label class="control-label">Phone</label>
                                         <div class="controls">
                                             <input type="text" class="span6 " name="phone" value="<phpdac>rccrmtrace.readContactField use phone</phpdac>" >
                                         </div>
                                     </div>	
                                     <div class="control-group">
                                         <label class="control-label">Skype</label>
                                         <div class="controls">
                                             <input type="text" class="span6 " name="skype" value="<phpdac>rccrmtrace.readContactField use skype</phpdac>" >
                                         </div>
                                     </div>
                                     <div class="control-group">
                                         <label class="control-label">Facebook</label>
                                         <div class="controls">
                                             <input type="text" class="span6 " name="facebook" value="<phpdac>rccrmtrace.readContactField use facebook</phpdac>" >
                                         </div>
                                     </div>		
                                     <div class="control-group">
                                         <label class="control-label">Twitter</label>
                                         <div class="controls">
                                             <input type="text" class="span6 " name="twitter" value="<phpdac>rccrmtrace.readContactField use twitter</phpdac>" >
                                         </div>
                                     </div>									 
                                     <div class="control-group">
                                         <label class="control-label">Linkedin</label>
                                         <div class="controls">
                                             <input type="text" class="span6 " name="linkedin" value="<phpdac>rccrmtrace.readContactField use linkedin</phpdac>" >
                                         </div>
                                     </div>									 
                                     <div class="control-group">
                                         <label class="control-label">Website Url</label>
                                         <div class="controls">
                                             <input type="text" class="span6" name="website" placeholder="http://www.example.com" value="<phpdac>rccrmtrace.readContactWeb use website</phpdac>" >
                                         </div>
                                     </div>
                                     <div class="control-group">
                                         <label class="control-label">Longitude</label>
                                         <div class="controls">
                                             <input type="text" class="span6 " name="longitude" value="<phpdac>rccrmtrace.readContactField use longitude</phpdac>" >
                                         </div>
                                     </div>	
                                     <div class="control-group">
                                         <label class="control-label">Latitude</label>
                                         <div class="controls">
                                             <input type="text" class="span6 " name="latitude" value="<phpdac>rccrmtrace.readContactField use latitude</phpdac>" >
                                         </div>
                                     </div-->									 
                                     <div class="form-actions">
                                         <button class="btn btn-success" type="submit">Save</button>
                                         <!--button class="btn" type="button">Cancel</button-->
                                     </div>
                                 </form>

                                 <div class="space10"></div>

                                 <!--h2>Change Password</h2>

                                 <div class="widget orange">
                                     <div class="widget-title">
                                          <h4><i class="icon-reorder"></i> Sets New Password</h4>
                                           <span class="tools">
                                                <a class="icon-chevron-down" href="javascript:;"></a>
                                                <a class="icon-remove" href="javascript:;"></a>
                                           </span>
                                     </div>
                                     <div class="widget-body ">
                                         <form class="form-horizontal" action="#">
                                             <div class="control-group">
                                                 <label class="control-label">Current Password</label>
                                                 <div class="controls">
                                                     <input type="password" class="span6 ">
                                                 </div>
                                             </div>
                                             <div class="control-group">
                                                 <label class="control-label">New Password</label>
                                                 <div class="controls">
                                                     <input type="password" class="span6 ">
                                                 </div>
                                             </div>
                                             <div class="control-group">
                                                 <label class="control-label">Re-type New Password</label>
                                                 <div class="controls">
                                                     <input type="password" class="span6 ">
                                                 </div>
                                             </div>

                                             <div class="form-actions">
                                                 <button type="submit" class="btn btn-success">Change Password</button>
                                                 <button type="button" class="btn">Cancel</button>
                                             </div>

                                         </form>
                                     </div>
                                 </div>

                                 <h2>Project Progress</h2>

                                 <div class="widget red">
                                     <div class="widget-title">
                                         <h4><i class="icon-reorder"></i> Sets Projects</h4>
                                           <span class="tools">
                                                <a class="icon-chevron-down" href="javascript:;"></a>
                                                <a class="icon-remove" href="javascript:;"></a>
                                           </span>
                                     </div>
                                     <div class="widget-body ">
                                         <form class="form-horizontal" action="#">
                                             <div class="control-group">
                                                 <label class="control-label">Project Name</label>
                                                 <div class="controls">
                                                     <input type="text" class="span8 ">
                                                 </div>
                                             </div>
                                             <div class="control-group">
                                                 <label class="control-label">Start and End Date</label>
                                                 <div class="controls">
                                                     <div class="input-prepend">
                                                         <span class="add-on"><i class="icon-calendar"></i></span>
                                                         <input type="text" class=" m-ctrl-medium" id="reservation">
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="control-group">
                                                 <label class="control-label">Progress</label>
                                                 <div class="controls">
                                                     <div id="slider-range-max" class="slider"></div>
                                                     <div class="slider-info">
                                                         Progress Value:
                                                         <span id="slider-range-max-amount"></span>
                                                     </div>
                                                 </div>
                                             </div>

                                             <div class="text-center">
                                                 <button class="btn btn-inverse "><i class="icon-plus"></i> Add Projects</button>
                                             </div>

                                         </form>
                                     </div>
                                 </div>

                                 <h2> Change Avatar</h2>
                                 <div class="widget green">
                                     <div class="widget-title">
                                         <h4><i class="icon-user"></i> Avatar Change </h4>
                                           <span class="tools">
                                                <a class="icon-chevron-down" href="javascript:;"></a>
                                                <a class="icon-remove" href="javascript:;"></a>
                                           </span>
                                     </div>
                                     <div class="widget-body form">

                                         <form class="form-horizontal" action="#">

                                             <div class="control-group">
                                                 <label class="control-label">Without input</label>
                                                 <div class="controls">
                                                     <div data-provides="fileupload" class="fileupload fileupload-new">
                                                        <span class="btn btn-file">
                                                            <span class="fileupload-new">Select file</span>
                                                            <span class="fileupload-exists">Change</span>
                                                            <input type="file" class="default">
                                                        </span>
                                                         <span class="fileupload-preview"></span>
                                                         <a style="float: none" data-dismiss="fileupload" class="close fileupload-exists" href="#">×</a>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="control-group">
                                                 <label class="control-label">Image Upload</label>
                                                 <div class="controls">
                                                     <div data-provides="fileupload" class="fileupload fileupload-new">
                                                         <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
                                                             <img alt="" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
                                                         </div>
                                                         <div style="max-width: 200px; max-height: 150px; line-height: 20px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                                                         <div>
                                                            <span class="btn btn-file"><span class="fileupload-new">Select image</span>
                                                            <span class="fileupload-exists">Change</span>
                                                            <input type="file" class="default"></span>
                                                            <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a>
                                                         </div>
                                                     </div>
                                                     <span class="label label-important">NOTE!</span>
                                                     <span>
                                                     Attached image thumbnail is
                                                     supported in Latest Firefox, Chrome, Opera,
                                                     Safari and Internet Explorer 10 only
                                                     </span>
                                                 </div>
                                             </div>
                                         </form>

                                     </div>
                                 </div>
                                 <div class="text-center">
                                     <button class="btn btn-inverse btn-large "> Save & Continue</button>
                                 </div>
                                 <div class="space20"></div-->
                                 <div class="space20"></div>
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
   
   <phpdac>frontpage.include_part use /parts/google-analytics.php+++metro</phpdac>
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->     
</body>
<!-- END BODY -->
</html>