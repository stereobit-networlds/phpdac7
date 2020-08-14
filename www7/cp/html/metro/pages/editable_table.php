<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Editable Table</title>
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
   <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
   <link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css" />

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
            <!-- BEGIN EDITABLE TABLE widget-->
             <div class="row-fluid">
                 <div class="span12">
                     <!-- BEGIN EXAMPLE TABLE widget-->
                     <div class="widget purple">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Editable Table</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                         </div>
                         <div class="widget-body">
                             <div>
                                 <div class="clearfix">
                                     <div class="btn-group">
                                         <button id="editable-sample_new" class="btn green">
                                             Add New <i class="icon-plus"></i>
                                         </button>
                                     </div>
                                     <div class="btn-group pull-right">
                                         <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
                                         </button>
                                         <ul class="dropdown-menu pull-right">
                                             <li><a href="#">Print</a></li>
                                             <li><a href="#">Save as PDF</a></li>
                                             <li><a href="#">Export to Excel</a></li>
                                         </ul>
                                     </div>
                                 </div>
                                 <div class="space15"></div>
                                 <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                     <thead>
                                     <tr>
                                         <th>Username</th>
                                         <th>Full Name</th>
                                         <th>Points</th>
                                         <th>Notes</th>
                                         <th>Edit</th>
                                         <th>Delete</th>
                                     </tr>
                                     </thead>
                                     <tbody>
                                     <tr class="">
                                         <td>Jondi Rose</td>
                                         <td>Alfred Jondi Rose</td>
                                         <td>1234</td>
                                         <td class="center">super user</td>
                                         <td><a class="edit" href="javascript:;">Edit</a></td>
                                         <td><a class="delete" href="javascript:;">Delete</a></td>
                                     </tr>
                                     <tr class="">
                                         <td>Dulal</td>
                                         <td>Jonathan Smith</td>
                                         <td>434</td>
                                         <td class="center">new user</td>
                                         <td><a class="edit" href="javascript:;">Edit</a></td>
                                         <td><a class="delete" href="javascript:;">Delete</a></td>
                                     </tr>
                                     <tr class="">
                                         <td>Sumon</td>
                                         <td> Sumon Ahmed</td>
                                         <td>232</td>
                                         <td class="center">super user</td>
                                         <td><a class="edit" href="javascript:;">Edit</a></td>
                                         <td><a class="delete" href="javascript:;">Delete</a></td>
                                     </tr>
                                     <tr class="">
                                         <td>vectorlab</td>
                                         <td>dk mosa</td>
                                         <td>132</td>
                                         <td class="center">elite user</td>
                                         <td><a class="edit" href="javascript:;">Edit</a></td>
                                         <td><a class="delete" href="javascript:;">Delete</a></td>
                                     </tr>
                                     <tr class="">
                                         <td>Admin</td>
                                         <td> Admin lab</td>
                                         <td>462</td>
                                         <td class="center">new user</td>
                                         <td><a class="edit" href="javascript:;">Edit</a></td>
                                         <td><a class="delete" href="javascript:;">Delete</a></td>
                                     </tr>
                                     <tr class="">
                                         <td>Rafiqul</td>
                                         <td>Rafiqul dulal</td>
                                         <td>62</td>
                                         <td class="center">new user</td>
                                         <td><a class="edit" href="javascript:;">Edit</a></td>
                                         <td><a class="delete" href="javascript:;">Delete</a></td>
                                     </tr>
                                     <tr class="">
                                         <td>Jhon Doe</td>
                                         <td>Jhon Doe </td>
                                         <td>1234</td>
                                         <td class="center">super user</td>
                                         <td><a class="edit" href="javascript:;">Edit</a></td>
                                         <td><a class="delete" href="javascript:;">Delete</a></td>
                                     </tr>
                                     <tr class="">
                                         <td>Dulal</td>
                                         <td>Jonathan Smith</td>
                                         <td>434</td>
                                         <td class="center">new user</td>
                                         <td><a class="edit" href="javascript:;">Edit</a></td>
                                         <td><a class="delete" href="javascript:;">Delete</a></td>
                                     </tr>
                                     <tr class="">
                                         <td>Sumon</td>
                                         <td> Sumon Ahmed</td>
                                         <td>232</td>
                                         <td class="center">super user</td>
                                         <td><a class="edit" href="javascript:;">Edit</a></td>
                                         <td><a class="delete" href="javascript:;">Delete</a></td>
                                     </tr>
                                     <tr class="">
                                         <td>vectorlab</td>
                                         <td>dk mosa</td>
                                         <td>132</td>
                                         <td class="center">elite user</td>
                                         <td><a class="edit" href="javascript:;">Edit</a></td>
                                         <td><a class="delete" href="javascript:;">Delete</a></td>
                                     </tr>
                                     <tr class="">
                                         <td>Admin</td>
                                         <td> Admin lab</td>
                                         <td>462</td>
                                         <td class="center">new user</td>
                                         <td><a class="edit" href="javascript:;">Edit</a></td>
                                         <td><a class="delete" href="javascript:;">Delete</a></td>
                                     </tr>
                                     <tr class="">
                                         <td>Rafiqul</td>
                                         <td>Rafiqul dulal</td>
                                         <td>62</td>
                                         <td class="center">new user</td>
                                         <td><a class="edit" href="javascript:;">Edit</a></td>
                                         <td><a class="delete" href="javascript:;">Delete</a></td>
                                     </tr>
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                     <!-- END EXAMPLE TABLE widget-->
                 </div>
             </div>

            <!-- END EDITABLE TABLE widget-->
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
   <script src="js/editable-table.js"></script>

   <!-- END JAVASCRIPTS -->
   <script>
       jQuery(document).ready(function() {
           EditableTable.init();
       });
   </script>
      
   
</body>
<!-- END BODY -->
</html>