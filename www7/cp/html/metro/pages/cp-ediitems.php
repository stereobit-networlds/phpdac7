<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>EDI items</title>
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
	
	<link href="../javascripts/themes/redmond/jquery-ui.custom.css" rel="stylesheet" /> 
	<link href="../javascripts/jqgrid/css/ui.jqgrid.css" rel="stylesheet" />  
	
    <!--script src="../javascripts/jquery.min.js"></script-->
	<script src="js/jquery-1.8.3.min.js"></script>
	<script src="../javascripts/jqgrid/js/i18n/grid.locale-en.js"></script>			
	<script src="../javascripts/jqgrid/js/jquery.jqGrid.min.js"></script>
	<script src="../javascripts/themes/jquery-ui.custom.min.js"></script>    	
	
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
			<!--div class="row-fluid">
                 <div class="span12">
                    <METRO/INDEX>					 
                 </div>	 
             </div-->	
			 
            <div class="row-fluid">
                <div class="span12">
				
					<?METRO/INDEX?>
										
                    <div class="widget box purple">
                        <div class="widget-title">
                            <h4>
                                <i class="icon-reorder"></i> <phpdac>cmsrt.slocale use _ediitems</phpdac></span>
                            </h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                        </span>
                        </div>
                        <div class="widget-body">
                            <form id="tForm" method="post" action="cpediitems.php?t=cpsaveediitems" class="form-horizontal">
								<input type="hidden" name="FormName" value="saveediitems" />
								<input type="hidden" name="FormAction" value="cpsaveediitems" />
								<input type="hidden" name="cat" value="<phpdac>rcediitems.currentCategory</phpdac>" />
								<input type="hidden" name="mode" value="<phpdac>rcediitems.currentMode</phpdac>" />
								
								<input type="hidden" name="flt" value="<phpdac>rcediitems.getFilter use 1</phpdac>" />
								<input type="hidden" name="val" value="<phpdac>rcediitems.getFilter</phpdac>" />
								
                                <div id="tabsleft" class="tabbable tabs-left">
                                <ul>
                                    <li><a href="#tabsleft-tab1" data-toggle="tab"><span class="strong"><phpdac>cmsrt.slocale use _options</phpdac></span></a></li>
									<li><a href="#tabsleft-tab2" data-toggle="tab"><span class="strong"><phpdac>cmsrt.slocale use _messages</phpdac></span></a></li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane" id="tabsleft-tab1">
										<h3><phpdac>cmsrt.slocale use _insupd</phpdac></h3>	
										<div class="control-group">
											<label class="control-label">
												<phpdac>cmsrt.slocale use _moveincategory</phpdac>
											</label>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="moveincat" type="checkbox" <phpdac>cmsrt.getSubmitedParam use moveincat+checked</phpdac> >
													<phpdac>rcediitems.showCategory</phpdac> 
												<label>
													<phpdac>cmsrt.slocale use _fromhere</phpdac>
												</label>
												<label class="checkbox">
                                                    <input name="catoverroot" type="checkbox" <phpdac>cmsrt.getSubmitedParam use catoverroot+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _overroot</phpdac>
                                                </label>
												<label class="checkbox">
                                                    <input name="catfromroot" type="checkbox" <phpdac>cmsrt.getSubmitedParam use catfromroot+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _fromroot</phpdac>
                                                </label>
												<label class="checkbox">
                                                    <input name="slugon" type="checkbox" <phpdac>cmsrt.getSubmitedParam use slugon+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _slug</phpdac>
                                                </label>
												<label class="checkbox">
                                                    <input name="sluggreekon" type="checkbox" <phpdac>cmsrt.getSubmitedParam use sluggreekon+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _sluggreeklish</phpdac>
                                                </label>
												</div>
											</div>
										</div>	
										<div class="control-group">
											<label class="control-label">
												<phpdac>cmsrt.slocale use _updateincategory</phpdac>
											</label>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="updincat" type="checkbox" <phpdac>cmsrt.getSubmitedParam use updincat+checked</phpdac> >
													<phpdac>rcediitems.showCategory</phpdac>
												
												<label class="checkbox">
                                                    <input name="catupd" type="checkbox" <phpdac>cmsrt.getSubmitedParam use catupd+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _catsetupdate</phpdac> <phpdac>cmsrt.slocale use _fromhere</phpdac>
                                                </label>
												<label class="checkbox">
                                                    <input name="catoverroot" type="checkbox" <phpdac>cmsrt.getSubmitedParam use catoverroot+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _overroot</phpdac>
                                                </label>												
												<label class="checkbox">
                                                    <input name="catfromroot" type="checkbox" <phpdac>cmsrt.getSubmitedParam use catfromroot+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _fromroot</phpdac>
                                                </label>												
												<label class="checkbox">
                                                    <input name="slugon" type="checkbox" <phpdac>cmsrt.getSubmitedParam use slugon+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _slug</phpdac>
                                                </label>
												<label class="checkbox">
                                                    <input name="sluggreekon" type="checkbox" <phpdac>cmsrt.getSubmitedParam use sluggreekon+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _sluggreeklish</phpdac>
                                                </label>
												</div>
											</div>
										</div>										
                                        <div class="control-group">
                                            <label class="control-label">
												<phpdac>cmsrt.slocale use _createcategory</phpdac>
											</label>
                                            <div class="controls">
												<div id="normal-toggle-button">
													<input name="createcat" type="checkbox" <phpdac>cmsrt.getSubmitedParam use createcat+checked</phpdac>>
													<phpdac>rcediitems.showCategory</phpdac>
													
												<label>
													<phpdac>cmsrt.slocale use _overroot</phpdac>
												</label>
												<label class="checkbox">
                                                    <input name="createcatfromroot" type="checkbox" <phpdac>cmsrt.getSubmitedParam use createcatfromroot+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _fromroot</phpdac>
                                                </label>
												<label class="checkbox">
                                                    <input name="slugon" type="checkbox" <phpdac>cmsrt.getSubmitedParam use slugon+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _slug</phpdac>
                                                </label>
												<label class="checkbox">
                                                    <input name="sluggreekon" type="checkbox" <phpdac>cmsrt.getSubmitedParam use sluggreekon+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _sluggreeklish</phpdac>
                                                </label>												
												
                                                <label class="checkbox">
                                                    <input name="catact" type="checkbox" <phpdac>cmsrt.getSubmitedParam use catact+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _active</phpdac>
                                                </label>
												<label class="checkbox">
                                                    <input name="catview" type="checkbox" <phpdac>cmsrt.getSubmitedParam use catview+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _viewable</phpdac>
                                                </label>
												<label class="checkbox">
                                                    <input name="catsearch" type="checkbox" <phpdac>cmsrt.getSubmitedParam use catsearch+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _searchable</phpdac>
                                                </label>
												</div>
                                            </div>
                                        </div>
										
										<h3><phpdac>cmsrt.slocale use _remove</phpdac></h3>	
										<div class="control-group">
											<label class="control-label">
												<phpdac>cmsrt.slocale use _deleteincategory</phpdac>
											</label>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="delincat" type="checkbox" <phpdac>cmsrt.getSubmitedParam use delincat+checked</phpdac> >
													<phpdac>rcediitems.showCategory</phpdac>
												</div>
											</div>
										</div>										
										<div class="control-group">
                                            <label class="control-label">
												<phpdac>cmsrt.slocale use _deletecategory</phpdac>
											</label>
                                            <div class="controls">
												<div id="normal-toggle-button">
													<input name="deletecat" type="checkbox" <phpdac>cmsrt.getSubmitedParam use deletecat+checked</phpdac> >
													<phpdac>rcediitems.showCategory</phpdac> 
												<label>
													<phpdac>cmsrt.slocale use _overroot</phpdac>
												</label>
												<label class="checkbox">
                                                    <input name="deletecatfromroot" type="checkbox" <phpdac>cmsrt.getSubmitedParam use deletecatfromroot+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _fromroot</phpdac>
                                                </label>												
												<label class="checkbox">
                                                    <input name="slugon" type="checkbox" <phpdac>cmsrt.getSubmitedParam use slugon+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _slug</phpdac>
                                                </label>
												<label class="checkbox">
                                                    <input name="sluggreekon" type="checkbox" <phpdac>cmsrt.getSubmitedParam use sluggreekon+checked</phpdac> /> 
													<phpdac>cmsrt.slocale use _sluggreeklish</phpdac>
                                                </label>
												</div>
                                            </div>
                                        </div>
										
										<h3><phpdac>cmsrt.slocale use _dblog</phpdac></h3>	
										<div class="control-group">
											<div class="controls">
												<label class="checkbox">
                                                    <input name="dbset" type="checkbox" /> 
													<phpdac>cmsrt.slocale use _dbset</phpdac>
                                                </label>
												<label class="checkbox">
                                                    <input name="logset" type="checkbox" /> 
													<phpdac>cmsrt.slocale use _logset</phpdac>
                                                </label>
												<label class="checkbox">
                                                    <input name="logclear" type="checkbox" /> 
													<phpdac>cmsrt.slocale use _logclear</phpdac>
                                                </label>
											</div>
										</div>	

										<h3><phpdac>rcediitems.showFilter</phpdac></h3>		
                                    </div>	
									<div class="tab-pane" id="tabsleft-tab2">
                                    	<h3><phpdac>cmsrt.slocale use _messages</phpdac></h3>
										<div class="control-group">
											<label class="control-label"><phpdac>cmsrt.slocale use _messages</phpdac></label>
											<div class="controls">
												<select id="messages" multiple="multiple" style="height:100px;width:100%;">
												<phpdac>rcediitems.viewMessages</phpdac>
												</select>
											</div>
										</div>										
                                    </div>

                                    <ul class="pager wizard">
										<phpdac>rcediitems.noFilterWarning</phpdac>
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