<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Clean Lists</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <!--link href="assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" /-->
   <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="css/style.css" rel="stylesheet" />
   <link href="css/style-responsive.css" rel="stylesheet" />
   <link href="css/style-default.css" rel="stylesheet" id="style_color" />

	<link href="../javascripts/themes/redmond/jquery-ui.custom.css" rel="stylesheet" /> 
	<link href="../javascripts/jqgrid/css/ui.jqgrid.css" rel="stylesheet" />  
	
    <!--script src="../javascripts/jquery.min.js"></script-->
	<script src="js/jquery-1.8.3.min.js"></script>
	<script src="../javascripts/jqgrid/js/i18n/grid.locale-en.js"></script>			
	<script src="../javascripts/jqgrid/js/jquery.jqGrid.min.js"></script>
	<script src="../javascripts/themes/jquery-ui.custom.min.js"></script>    
   	
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
                    <div class="widget red">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> <phpdac>frontpage.slocale use _cleanlist</phpdac></h4>
                            <!--span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span-->
                        </div>
                        <div class="widget-body">
                            <!-- BEGIN FORM-->
                            <form method="post" action="#" class="form-horizontal">	

							<div class="control-group">
                                <label class="control-label"><phpdac>cms.slocale use _selectlist</phpdac></label>
                                <div id="select_ulist" class="controls">
                                    <select name="ulist" onChange="location='cpulists.php?t=cpcleanbounce&ulist='+this.options[this.selectedIndex].value" class="span6 " data-placeholder="<phpdac>cms.slocale use _sellistprompt</phpdac>" tabindex="1">
                                        <option value=""><phpdac>cms.slocale use _selectlist</phpdac></option>
										<phpdac>rculists.viewUList use +ulist</phpdac>
                                    </select>
                                </div>
                            </div>
							
                            <div class="control-group">
                                <label class="control-label"><phpdac>frontpage.slocale use _failmargin</phpdac> (&gt;)</label>
                                <div class="controls">

                                    <select name="fid" class="span6 " data-placeholder="Choose a limit" tabindex="1">
										<option value="10">10</option>
										<option value="9">9</option>
										<option value="8">8</option>
										<option value="7">7</option>
                                        <option value="6">6</option>
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
										<option value="2">2</option>
										<option value="1">1</option>
                                    </select>
							
                                    <div class="input-append date" id="dpYears" data-date=""
                                        data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input class="m-ctrl-medium" size="16" type="text" name="schdate" readonly>
                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                    </div>
									<!--input id="dp1" type="text" value="" size="16" class="m-ctrl-medium"-->		
    
                                    <div class="input-append bootstrap-timepicker">
                                        <input id="timepicker4" type="text" name="schtime" class="input-small">
                                        <span class="add-on"> <i class="icon-time"></i></span>
                                    </div>
                                </div>
                            </div>							
							<div id="messages" class="control-group">
								<label class="control-label"><phpdac>i18nL.translate use messages+RCCONTROLPANEL</phpdac></label>
								<div class="controls">
									<select id="messages" multiple="multiple" style="height:90px;width:100%;">
										<phpdac>rculists.viewMessages</phpdac>
									</select>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label"><phpdac>cms.slocale use _subutils</phpdac></label>
								<div class="controls">
									<label class="checkbox">
										<input name="cleanbad" type="checkbox" /> <phpdac>cms.slocale use _cleanbad</phpdac>
									</label>
									<label class="checkbox">
										<input name="cleanfailed" type="checkbox" checked /> <phpdac>cms.slocale use _cleanfailed</phpdac>
									</label>									
								</div>
							</div>							
								
                            <div class="form-actions">
								<button type="submit" class="btn btn-danger"><phpdac>frontpage.slocale use _cleanlist</phpdac></button>
								<input type="hidden" name="FormName" value="cleanbounce" />
								<input type="hidden" name="FormAction" value="cpcleanbounce" />
                            </div>							
							
                            </form>
                            <!-- END FORM-->
							
							<?METRO/INDEX?>
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
   
   <!--script src="js/jquery-1.8.3.min.js"></script-->
   
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->

   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

    <script language="JavaScript">   
function show_body() { var taskid = arguments[0];  sndReqArg('cpulists.php?t=cploadframe&id='+taskid,'mailbody');}	
function show_trace() { var m = arguments[0]; var cid = arguments[1];  sndReqArg('cpulists.php?t=cpulframe&m='+m+'&cid='+cid,'tracebody');}		
function enable(){ var id = arguments[0]; sndReqArg('cpulists.php?t=cpactivatequeuerec&rec='+id,'mailbody');}		
function disable(){ var id = arguments[0]; sndReqArg('cpulists.php?t=cpdeactivatequeuerec&rec='+id,'mailbody');}
	</script>   
   <!-- END JAVASCRIPTS --> 

	<!-- e-Enterprise, stereobit.networlds (phpdac5) -->   
</body>
<!-- END BODY -->
</html>