<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Basic Table</title>
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
            <div id="page-wraper">
                <div class="row-fluid">
                    <div class="span6">
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget purple">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Basic Table</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END BASIC PORTLET-->
                    </div>
                    <div class="span6">
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget red">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Striped Table</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END BASIC PORTLET-->
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span6">
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget green">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Border Table</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td rowspan="2">1</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@TwBootstrap</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td colspan="2">Larry the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END BASIC PORTLET-->
                    </div>
                    <div class="span6">
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget yellow">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Hover Table</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jhone</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td colspan="2">Larry the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END BASIC PORTLET-->
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget orange">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Advanced Table</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <table class="table table-striped table-bordered table-advance table-hover">
                                    <thead>
                                    <tr>
                                        <th><i class="icon-bullhorn"></i> Company</th>
                                        <th class="hidden-phone"><i class="icon-question-sign"></i> Descrition</th>
                                        <th><i class="icon-bookmark"></i> Profit</th>
                                        <th><i class=" icon-edit"></i> Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="#">Vector Ltd</a></td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                        <td>12120.00$ </td>
                                        <td><span class="label label-important label-mini">Due</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                Adimin co
                                            </a>
                                        </td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                        <td>56456.00$ </td>
                                        <td><span class="label label-warning label-mini">Due</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                boka soka
                                            </a>
                                        </td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                        <td>14400.00$ </td>
                                        <td><span class="label label-success label-mini">Paid</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                salbal llb
                                            </a>
                                        </td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                        <td>2323.50$ </td>
                                        <td><span class="label label-danger label-mini">Paid</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">Vector Ltd</a></td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                        <td>12120.00$ </td>
                                        <td><span class="label label-important label-mini">Due</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                Adimin co
                                            </a>
                                        </td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                        <td>56456.00$ </td>
                                        <td><span class="label label-warning label-mini">Due</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">Vector Ltd</a></td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                        <td>12120.00$ </td>
                                        <td><span class="label label-important label-mini">Due</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                Adimin co
                                            </a>
                                        </td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                        <td>56456.00$ </td>
                                        <td><span class="label label-warning label-mini">Due</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">Vector Ltd</a></td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                        <td>12120.00$ </td>
                                        <td><span class="label label-important label-mini">Due</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                Adimin co
                                            </a>
                                        </td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                        <td>56456.00$ </td>
                                        <td><span class="label label-warning label-mini">Due</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END BASIC PORTLET-->
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
   <script src="js/jquery.scrollTo.min.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->


   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!-- END JAVASCRIPTS -->
    
</body>
<!-- END BODY -->
</html>