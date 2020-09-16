<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Handle group items</title>
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

    <link href="assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
	
	<link rel="stylesheet" href="css/zebra/flat/zebra_dialog.css" type="text/css">
   </script>		

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
				
					<?METRO/INDEX?>
										
                    <div class="widget box purple">
                        <div class="widget-title">
                            <h4>
                                <i class="icon-reorder"></i> <phpdac>cmsrt.slocale use _handleitems</phpdac></span>
                            </h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                        </span>
                        </div>
                        <div class="widget-body">
                            <form id="tForm" method="post" action="cphandleitems.php?t=cpsavehitems" class="form-horizontal">
								<input type="hidden" name="FormName" value="savehitems" />
								<input type="hidden" name="FormAction" value="cpsavehitems" />
								<input type="hidden" name="cat" value="<phpdac>rchandleitems.postCategory</phpdac>" />
								
                                <div id="tabsleft" class="tabbable tabs-left">
                                <ul>
                                    <li><a href="#tabsleft-tab1" data-toggle="tab"><span class="strong"><phpdac>cmsrt.slocale use _options</phpdac></span></a></li>
									<li><a href="#tabsleft-tab2" data-toggle="tab"><span class="strong"><phpdac>cmsrt.slocale use _messages</phpdac></span></a></li>
									<!--li><a href="#tabsleft-tab3" data-toggle="tab"><span class="strong"><phpdac>cmsrt.slocale use _messages</phpdac></span></a></li-->
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane" id="tabsleft-tab1">
										<!--h3>Options</h3-->
										<!--div class="control-group">
											<label class="control-label">Don't send email</label>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="dontmail" type="checkbox">
												</div>
											</div>
										</div-->	
										<div class="control-group">
											<label class="control-label">
												<phpdac>cmsrt.slocale use _moveincategory</phpdac>
											</label>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="moveincat" type="checkbox" <phpdac>cmsrt.getSubmitedParam use moveincat+checked</phpdac>>
													<phpdac>rchandleitems.currCategory</phpdac>
												</div>
											</div>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="movecatincat" type="checkbox" <phpdac>cmsrt.getSubmitedParam use movecatincat+checked</phpdac>>
													<phpdac>cmsrt.slocale use _movecatincategory</phpdac>
												</div>
											</div>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="movecatfromroot" type="checkbox" <phpdac>cmsrt.getSubmitedParam use movecatfromroot+checked</phpdac>>
													<phpdac>cmsrt.slocale use _movecatfromroot</phpdac>
												</div>
											</div>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="delmovedcat" type="checkbox" <phpdac>cmsrt.getSubmitedParam use delmovedcat+checked</phpdac>>
													<phpdac>cmsrt.slocale use _delmovedcat</phpdac>
												</div>
											</div>	
										</div>
										<div class="control-group">
											<label class="control-label">
												<phpdac>cmsrt.slocale use _slug</phpdac>
											</label>
											<div class="controls">
												<label class="checkbox">
													<input name="slugon" type="checkbox" <phpdac>cmsrt.getSubmitedParam use slugon+checked</phpdac> > 
													<phpdac>cmsrt.slocale use _enable</phpdac>
												</label>
												<label class="checkbox">
													<input name="sluggreekon" type="checkbox" <phpdac>cmsrt.getSubmitedParam use sluggreekon+checked</phpdac> > 
													<phpdac>cmsrt.slocale use _sluggreeklish</phpdac>
												</label>												
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">
												<phpdac>cmsrt.slocale use _deleteincategory</phpdac>
											</label>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="delincat" type="checkbox" <phpdac>cmsrt.getSubmitedParam use delincat+checked</phpdac>>
													<phpdac>rchandleitems.currCategory</phpdac>
												</div>
											</div>
										</div>										
                                        <div class="control-group">
                                            <label class="control-label">
												<phpdac>cmsrt.slocale use _recomments</phpdac>
											</label>
                                            <div class="controls">
                                                <label class="checkbox">
                                                    <input name="setfav" type="checkbox" <phpdac>cmsrt.getSubmitedParam use setfav+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _recommentson</phpdac>
                                                </label>
												<label class="checkbox">
                                                    <input name="remfav" type="checkbox" <phpdac>cmsrt.getSubmitedParam use remfav+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _recommentsoff</phpdac>
                                                </label>
                                            </div>
                                        </div>
										
										<!--h3>Extras</h3>										
										<div id="sendnow" class="control-group">
											<label class="control-label">Send now</label>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="sendnow" type="checkbox" checked="checked">
												</div>
											</div>
                                        </div>																				
										<div id="select_unsubscribe" class="control-group">
											<label class="control-label">Unsubscribe</label>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="unsubscribelink" type="checkbox" checked="checked">
												</div>
											</div>
										</div>																				
										<div class="control-group">
											<label class="control-label">Tokens</label>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="usetokens" type="checkbox" checked="checked">
												</div>
											</div>
										</div-->										
                                    </div>	
									<div class="tab-pane" id="tabsleft-tab2">
                                    	<h3><phpdac>cmsrt.slocale use _messages</phpdac></h3>
										<div class="control-group">
											<label class="control-label"><phpdac>cmsrt.slocale use _messages</phpdac></label>
											<div class="controls">
												<select id="messages" multiple="multiple" style="height:100px;width:100%;">
												<phpdac>rchandleitems.viewMessages</phpdac>
												</select>
											</div>
										</div>
										<div class="control-group">
										    <label class="control-label">Items</label>
											<div class="controls">
												<phpdac>rchandleitems.editItems</phpdac>														
											</div>	
										</div>										
                                    </div>
									<!--div class="tab-pane" id="tabsleft-tab3">
                                    	<h3><phpdac>cmsrt.slocale use _messages</phpdac></h3>
										<div class="control-group">
											<label class="control-label"><phpdac>cmsrt.slocale use _messages</phpdac></label>
											<div class="controls">
												<textarea name="tail" id="tailafile" rows="8" cols="150">
												<-hpdac>rchandleitems.tail</phpda->
												</textarea>
											</div>
										</div>										
                                    </div-->

                                    <ul class="pager wizard">
										<li class="next"><a href="javascript:document.getElementById('tForm').submit();">Submit</a></li>
                                    </ul>
                                </div>
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
							<div class="update-btn">
							    <!--hpdac>rchandleitems.buttonListToCollection</phpda-->
								<a href="JavaScript:void(0);" id="btn-up" class="btn"><i class="icon-long-arrow-up"></i> Up</a>
								<a href="JavaScript:void(0);" id="btn-down" class="btn"><i class="icon-long-arrow-down"></i> Dn</a>
                                <a href="cpgroup.php" class="btn"><i class="icon-repeat"></i> Edit</a>
                            </div>
                        </div>	
						<div class="widget-body form">
							<div>								
                            <table style="width: 100%;" class="">
                            <tr>
                                <td style="width: 100%">
								<form id="sortGroup" name="sortGroup" action="cphandleitems.php" method="post">
								<input type="hidden" name="FormName" value="sortgroup" />
								<input type="hidden" name="FormAction" value="cpsortgroup" />
                                    <select id="group-sort" name="groupsort[]" multiple="multiple" style="height:300px;width:100%;">
									<phpdac>rcgroup.viewCollection</phpdac>
                                    </select>
									<br/>
									<button type="submit" class="btn btn-success">Save</button>
								</form>	
                                </td>
                            </tr>
                            </table>
							</div>
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

    <!-- stream dialog -->
   <script type="text/javascript" src="js/zebra/zebra_dialog.js"></script>
   <script language="JavaScript">		
		setInterval(function() {<phpdac>rchandleitems.streamDialog</phpdac>}, 30000);	
   </script>
   <!-- end stream dialog -->    
   <!-- END JAVASCRIPTS -->

</body>
<!-- END BODY -->
</html>