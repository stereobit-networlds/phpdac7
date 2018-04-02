<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Form Wizard</title>
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

    <link href="assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
	
   <script src="http://www.xix.gr/ckeditor/ckeditor.js"></script>		

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
			<phpdac>frontpage.include_part use /parts/pageheader.php+++metro</phpdac>
            <!-- END PAGE HEADER-->

            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget box purple">
                        <div class="widget-title">
                            <h4>
                                <i class="icon-reorder"></i> Send mail wizard</span>
                            </h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <!--a href="javascript:;" class="icon-remove"></a-->
                        </span>
                        </div>
                        <div class="widget-body">
                            <form id="tForm" method="post" action="cpbulkmail.php?t=cpsubsend&editmode=1" class="form-horizontal">
                                <div id="tabsleft" class="tabbable tabs-left">
                                <ul>
                                    <li><a href="#tabsleft-tab1" data-toggle="tab"><span class="strong">Step 1</span> <span class="muted">Personal Details</span></a></li>
                                    <li><a href="#tabsleft-tab2" data-toggle="tab"><span class="strong">Step 2</span> <span class="muted">Billing Details</span></a></a></li>
                                    <li><a href="#tabsleft-tab3" data-toggle="tab"><span class="strong">Step 3</span> <span class="muted">Payment Details</span></a></a></li>
                                    <li><a href="#tabsleft-tab4" data-toggle="tab"><span class="strong">Step 4</span> <span class="muted">Confirmation</span></a></a></li>
                                </ul>
                                <div class="progress progress-info progress-striped">
                                    <div class="bar"></div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tabsleft-tab1">
                                        <h3>Fill up step 1</h3>
										<div class="control-group">
											<label class="control-label">Select template</label>
											<div class="controls">
												<select name="template" class="span6 " data-placeholder="Choose a template" tabindex="1">
												<option value="">Select...</option>
												<phpdac>rcbulkmail.viewTemplates</phpdac>
											</select>
											</div>
										</div>										
										<div class="control-group">
											<label class="control-label">Selection list</label>
											<div class="controls">
												<label class="checkbox">
													<input type="checkbox" name="ulist" value="<phpdac>nvl use mylist+1+</phpdac>" /> On
												</label>
												<label class="checkbox">
													<input type="checkbox" name="ulist1" value="1" /> Off
												</label>
											</div>
										</div>										
										
                                        <div class="control-group">
                                            <label class="control-label">XML</label>
                                            <div class="controls">
                                                <input type="text" name="xml" class="span6">
                                                <span class="help-inline">Give an xml address</span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">RSS</label>
                                            <div class="controls">
                                                <input type="text" name="rss" class="span6">
                                                <span class="help-inline">Give ab rss address</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabsleft-tab2">
                                        <h3>Fill up step 2</h3>
										<div class="control-group">
											<label class="control-label">Select mailing list</label>
											<div class="controls">
												<select name="ulistname" class="span6 " data-placeholder="Choose a mailing list" tabindex="1">
												<option value="">Select...</option>
													<phpdac>rcbulkmail.viewUList</phpdac>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Radio Buttons</label>
											<div class="controls">
												<label class="radio line">
													<input type="radio" name="includesubs" value="option1" />
													Option 1
												</label>
												<label class="radio line">
													<input type="radio" name="includeall" value="option2" checked />
													Option 2
												</label>
												<label class="radio line">
													<input type="radio" name="ulist2" value="option2" />
													Option 3
												</label>
											</div>
										</div>										
                                        <div class="control-group">
                                            <label class="control-label">Billing Name</label>
                                            <div class="controls">
                                                <input type="text" name="tsave" class="span6">
                                                <span class="help-inline">Give your Billing Name</span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Billing Details</label>
                                            <div class="controls">
                                                <input type="text" name="tname" class="span6">
                                                <span class="help-inline">Give your Billing Details</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabsleft-tab3">
                                        <h3>Fill up step 3</h3>
										<div class="control-group">
											<label class="control-label">From</label>
											<div class="controls">
												<select name="from" class="span6 " data-placeholder="Choose a mailing list" tabindex="1">
													<option value="<phpdac>fronthtmlpage.calldpc_var use rcbulkmail.mailuser</phpdac>"><phpdac>fronthtmlpage.calldpc_var use rcbulkmail.mailuser</phpdac></option>
												</select>
											</div>
										</div>										
                                        <div class="control-group">
											<label class="control-label">To</label>
											<div class="controls">
												<div class="input-icon left">
												<i class="icon-envelope"></i>
												<input class=" " name="submail" type="text" placeholder="Email Address" />
												</div>
											</div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Subject</label>
                                            <div class="controls">
                                                <input type="text" name="subject" class="span6">
                                                <span class="help-inline">Give a subject</span>
                                            </div>
                                        </div>	
                                    </div>
                                    <div class="tab-pane" id="tabsleft-tab4">
                                        <h3>Final step</h3>
                                        <div class="control-group">
                                            <label class="control-label">Fullname:</label>
                                            <div class="controls">
                                                <span class="text">Jhon Doe </span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Email:</label>
                                            <div class="controls">
                                                <span class="text">dkmosa@gmail.com</span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Phone:</label>
                                            <div class="controls">
                                                <span class="text">123456789</span>
                                            </div>
                                        </div>
										<div class="control-group">
										<!-- BEGIN FORM-->
										<form action="#" class="form-horizontal">
										<div class="control-group">
											<label class="control-label">CKEditor</label>
											<div class="controls">
												<textarea class="span12 ckeditor" name="mail_text" rows="6"></textarea>
											</div>
										</div>
										</form>
										<!-- END FORM-->
										</div>
                                        <!--div class="control-group">
                                            <label class="control-label"></label>
                                            <div class="controls">
                                                <label class="checkbox">
                                                    <input type="checkbox" value="" /> I confirm my steps
                                                </label>
                                            </div>
                                        </div-->
                                    </div>
                                    <ul class="pager wizard">
                                        <!--li class="previous first"><a href="javascript:;">First</a></li>
                                        <li class="previous"><a href="javascript:;">Previous</a></li>
                                        <li class="next last"><a href="javascript:;">Last</a></li-->
                                        <li class="next"><a href="javascript:;">Next</a></li>
                                        <li class="next finish" style="display:none;"><a href="javascript:document.getElementById('tForm').submit();">Finish</a></li>
                                    </ul>
                                    </ul>
                                </div>
                            </div>
							<div class="form-actions">
								<input type="hidden" name="FormName" value="cpsubsend" />
								<input type="hidden" name="FormAction" value="cpsubsend" />
								<!--input type="submit" name="submit" value="Submit" class="btn btn-success" /-->
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->

             <div class="row-fluid">
                 <div class="span12">
                    <!-- BEGIN  widget-->
                    <div class="widget yellow">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Selection list</h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <!--a href="javascript:;" class="icon-remove"></a-->
                           </span>
                        </div>	
						<div class="widget-body form">
                        <div>								
                            <table style="width: 100%;" class="">
                            <tr>
                                <td style="width: 100%">
                                    <select id="box2View" multiple="multiple" style="height:300px;width:100%;">
									<phpdac>rccollections.viewCollection</phpdac>
                                    </select><br/>
                                </td>
                            </tr>
                            </table>
                        </div>
					    <?METRO/INDEX?>
                        </div>
                    </div>					 
                 </div>
             </div>			

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
   <script src="assets/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
   <script src="js/jquery.blockui.js"></script>
   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   
   <script type="text/javascript" src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>   
   
   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>
   <!--script for this page-->
   <script src="js/form-wizard.js"></script>


   <!-- END JAVASCRIPTS -->
   <script>
       $(function () {
           $(" input[type=radio], input[type=checkbox]").uniform();
       });

   </script>
   <phpdac>frontpage.include_part use /parts/google-analytics.php+++meteor</phpdac>
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->     

</body>
<!-- END BODY -->
</html>