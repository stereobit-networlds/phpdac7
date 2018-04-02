<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Dynamic Table</title>
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
            <!-- BEGIN ADVANCED TABLE widget-->
            <div class="row-fluid">
                <div class="span12">
                <!-- BEGIN EXAMPLE TABLE widget-->
                <div class="widget red">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Dynamic Table</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                    </div>
                    <div class="widget-body">
                        <table class="table table-striped table-bordered" id="sample_1">
                            <thead>
                            <tr>
                                <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                                <th>Username</th>
                                <th class="hidden-phone">Email</th>
                                <th class="hidden-phone">Points</th>
                                <th class="hidden-phone">Joined</th>
                                <th class="hidden-phone"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>Jhone doe</td>
                                <td class="hidden-phone"><a href="mailto:jhone-doe@gmail.com">jhone-doe@gmail.com</a></td>
                                <td class="hidden-phone">10</td>
                                <td class="center hidden-phone">02.03.2013</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>gada</td>
                                <td class="hidden-phone"><a href="mailto:gada-lal@gmail.com">gada-lal@gmail.com</a></td>
                                <td class="hidden-phone">34</td>
                                <td class="center hidden-phone">08.03.2013</td>
                                <td class="hidden-phone"><span class="label label-warning">Suspended</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>soa bal</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@yahoo.com">soa bal@yahoo.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">1.12.2013</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>ram sag</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">soa bal@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">7.2.2013</td>
                                <td class="hidden-phone"><span class="label label-inverse">Blocked</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>durlab</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">test@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">03.07.2013</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>durlab</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">lorem-ip@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">05.04.2013</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>sumon</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">lorem-ip@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">05.04.2013</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>bombi</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">lorem-ip@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">05.04.2013</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>ABC ho</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">lorem-ip@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">05.04.2013</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>test</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">lorem-ip@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">05.04.2013</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>soa bal</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">soa bal@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">03.07.2013</td>
                                <td class="hidden-phone"><span class="label label-inverse">Blocked</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>test</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">test@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">03.07.2013</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>goop</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">lorem-ip@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">05.04.2013</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>sumon</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">lorem-ip@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">01.07.2013</td>
                                <td class="hidden-phone"><span class="label label-inverse">Blocked</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>woeri</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">lorem-ip@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">09.10.2013</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>soa bal</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">soa bal@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">9.12.2013</td>
                                <td class="hidden-phone"><span class="label label-inverse">Blocked</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>woeri</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">test@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">14.12.2013</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>uirer</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">lorem-ip@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">13.11.2013</td>
                                <td class="hidden-phone"><span class="label label-warning">Suspended</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>samsu</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">lorem-ip@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">17.11.2013</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>dipsdf</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">lorem-ip@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">05.04.2013</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>soa bal</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">soa bal@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">03.07.2013</td>
                                <td class="hidden-phone"><span class="label label-inverse">Blocked</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>hilor</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">test@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">03.07.2013</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>test</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">lorem-ip@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">19.12.2013</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>botu</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">lorem-ip@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">17.12.2013</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td>sumon</td>
                                <td class="hidden-phone"><a href="mailto:soa bal@gmail.com">lorem-ip@gmail.com</a></td>
                                <td class="hidden-phone">33</td>
                                <td class="center hidden-phone">15.11.2011</td>
                                <td class="hidden-phone"><span class="label label-success">Approved</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE widget-->
                </div>
            </div>

            <!-- END ADVANCED TABLE widget-->
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
   <script src="js/jquery.blockui.js"></script>
   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   <script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
   <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
   <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>


   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!--script for this page only-->
   <script src="js/dynamic-table.js"></script>

   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>