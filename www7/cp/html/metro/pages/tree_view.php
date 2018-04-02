<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Tree</title>
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

   <link rel="stylesheet" type="text/css" href="assets/bootstrap-tree/bootstrap-tree/css/bootstrap-tree.css" />
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
                <div class="span6">
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class=" icon-indent-left"></i> Inline Tree</h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <a href="javascript:;" class="icon-remove"></a>
                           </span>
                        </div>
                        <div class="widget-body">
                            <div class="actions">
                                <a class="btn btn-small btn-success" id="tree_1_collapse" href="javascript:;"> Collapse All</a>
                                <a class="btn btn-small btn-warning" id="tree_1_expand" href="javascript:;"> Expand All</a>
                            </div>
                            <div class="space10"></div>
                            <ul id="tree_1" class="tree">
                                <li>
                                    <a data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle" data-role="branch" href="#">
                                        Bootstrap Tree
                                    </a>
                                    <ul class="branch in">
                                        <li>
                                            <a id="nut1" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle" href="#">
                                                Documents
                                            </a>
                                            <ul class="branch in">
                                                <li>
                                                    <a id="nut2" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle closed" href="#">
                                                        Finance
                                                    </a>
                                                    <ul class="branch">
                                                        <li><a data-role="leaf" href="#"><i class="icon-book"></i> Sale Revenue</a></li>
                                                        <li><a data-role="leaf" href="#"><i class="icon-fire"></i> Promotions</a></li>
                                                        <li><a data-role="leaf" href="#"><i class="icon-edit"></i> IPO</a></li>
                                                    </ul>
                                                </li>
                                                <li><a data-role="leaf" href="#"><i class="icon-magic"></i> ICT</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-user"></i> Human Resources</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a id="nut3" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle closed" href="#">
                                                Examples
                                            </a>
                                            <ul class="branch">
                                                <li><a data-role="leaf" href="#"><i class="icon-cloud"></i> Internal</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-user-md"></i> Client Base</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-retweet"></i> Product Base</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a id="nut4" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle" href="#">
                                                Tasks
                                            </a>
                                            <ul class="branch in">
                                                <li><a data-role="leaf" href="#"><i class="icon-suitcase"></i> Internal Projects</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-cloud-download"></i> Outsourcing</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-sitemap"></i> Bug Tracking</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a id="nut6" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle closed" href="#">
                                                Customers
                                            </a>
                                            <ul class="branch">
                                                <li><a data-role="leaf" href="#"><i class="icon-tags"></i> Finance</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-magic"></i> ICT</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-user"></i> Human Resources</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a id="nut8" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle closed" href="#">
                                                Reports
                                            </a>
                                            <ul class="branch">
                                                <li><a data-role="leaf" href="#"><i class="icon-tags"></i> Finance</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-magic"></i> ICT</a></li>
                                                <li><a data-role="leaf" href="#"><i class="icon-user"></i> Human Resources</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a data-role="leaf" href="#">
                                                <i class="icon-share"></i> External Link
                                            </a>
                                        </li>
                                        <li>
                                            <a data-role="leaf" href="#">
                                                <i class="icon-share"></i> Another External Link
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="widget purple">
                        <div class="widget-title">
                            <h4><i class=" icon-indent-left"></i> Data Sources</h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <a href="javascript:;" class="icon-remove"></a>
                           </span>
                        </div>
                        <div class="widget-body">
                            <div class="actions">
                                <a class="btn btn-small btn-success" id="tree_2_collapse" href="javascript:;"> Collapse All</a>
                                <a class="btn btn-small btn-warning" id="tree_2_expand" href="javascript:;"> Expand All</a>
                            </div>
                            <div class="space10"></div>
                            <ul id="tree_2" class="tree">
                                <li>
                                    <a data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle" data-role="branch" href="#">Bootstrap Tree
                                    </a>
                                    <ul class="branch in">
                                        <li><a id="nut" data-role="leaf" href="#"><i class=" icon-book"></i> Documents</a></li>
                                        <li><a data-role="leaf" href="#"><i class=" icon-bullhorn"></i> Projects</a></li>
                                        <li><a data-role="leaf" href="#"><i class="icon-tasks"></i> Tasks</a></li>
                                        <li>
                                            <a data-role="leaf"  href="#">
                                                <i class="icon-share"></i> External Link
                                            </a>
                                        </li>
                                        <li>
                                            <a data-role="leaf"  href="#">
                                                <i class="icon-share"></i> Another External Link
                                            </a>
                                        </li>
                                        <li>
                                            <a data-value="XML_Example" data-toggle="branch" class="tree-toggle closed" data-role="branch" href="assets/bootstrap-tree/xmlexample.xml">Load data from XML document via Ajax
                                            </a>
                                            <ul class="branch">
                                                <li><a role="branch" class="tree-toggle closed folder" data-toggle="branch" data-value="number_8" data-itemid="root/number_8" href="#">this branch</a>
                                                    <ul class="branch">
                                                        <li><a role="leaf" data-value="2" data-itemid="root/number_8/wow" href="#"><i class="icon-shopping-cart"></i> Purchase metro lab Today</a></li>
                                                    </ul>
                                                </li>
                                                <li><a role="branch" class="tree-toggle folder" data-toggle="branch" data-value="number_9" data-itemid="root/number_9" href="#">Check this Out!</a>
                                                    <ul class="branch in">
                                                        <li><a role="leaf" data-value="But metro lab Today" data-itemid="root/number_9/metro lab" href="#"><i class="icon-shopping-cart"></i> Purchase metro lab Today</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a data-value="HTML_Example" data-toggle="branch" class="tree-toggle closed" data-role="branch" href="assets/bootstrap-tree/htmlexample.html">Load data from HTML page via Ajax
                                            </a><ul class="branch"><li><a target="_blank" href="#">Some Link</a></li>
                                            <li><a target="_blank" href="#">Another Link</a></li>
                                            <li>
                                                <a data-value="GitHub_Repos" data-toggle="branch" class="tree-toggle closed" role="branch" href="#">Some Structure</a>
                                                <ul class="branch">
                                                    <li><a href="#">Events</a></li>
                                                    <li><a href="#">Users</a></li>
                                                    <li><a href="#">Feedbacks</a></li>
                                                    <li><a href="#">Reports</a></li>
                                                    <li><a href="#">Sales</a></li>
                                                    <li><a href="#">Revenue</a></li>
                                                </ul>
                                            </li></ul>
                                        </li>

                                        <li><a data-value="JSON_Example" data-toggle="branch" class="tree-toggle closed" data-role="branch" href="assets/bootstrap-tree/jsonexample.json">Load data from JSON via Ajax</a></li>
                                    </ul>
                                </li>
                            </ul>
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
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="assets/bootstrap-tree/bootstrap-tree/js/bootstrap-tree.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->

   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!--script for this page only-->
   <script src="js/tree.js"></script>


   <!-- END JAVASCRIPTS -->
   <phpdac>frontpage.include_part use /parts/google-analytics.php+++meteor</phpdac>
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->        
</body>
<!-- END BODY -->
</html>