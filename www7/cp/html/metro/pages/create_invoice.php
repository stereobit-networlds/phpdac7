<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Create Invoice</title>
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

   <link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen/chosen.css" />
   <link rel="stylesheet" type="text/css" href="assets/jquery-tags-input/jquery.tagsinput.css" />
   <link rel="stylesheet" type="text/css" href="assets/clockface/css/clockface.css" />
   <link rel="stylesheet" type="text/css" href="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
   <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
   <link rel="stylesheet" type="text/css" href="assets/bootstrap-timepicker/compiled/timepicker.css" />
   <link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" />
   <link rel="stylesheet" href="assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
   <link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" />

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

                    <div class="metro-nav-block  nav-block-grey">
                        <a href="invoice.html" data-original-title="">
                            <div class="text-center">
                                <i class="icon-eye-open"></i>
                            </div>
                            <div class="status">View Invoice</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-blue ">
                        <a href="create_invoice.html" data-original-title="">
                            <div class="text-center">
                                <i class="icon-edit"></i>
                            </div>
                            <div class="status">Create Invoice</div>
                        </a>
                    </div>
                    <div class="metro-nav-block  nav-block-red">
                        <a href="invoice_list.html" data-original-title="">
                            <div class="text-center">
                                <i class="icon-th-list"></i>
                            </div>
                            <div class="status">Invoice List</div>
                        </a>
                    </div>
                </div>
                <div class="space10"></div>
                <!--END METRO STATES-->
            </div>
             <div class="row-fluid">
                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget purple">
                         <div class="widget-title">
                             <h4><i class="icon-edit"></i> Create Invoice </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                             <div class="portlet-body">
                                 <div class="invoice-date-range span12 form">
                                     <h4>Invoice Info</h4>
                                     <form action="#" class="form-horizontal form-row-seperated">
                                         <div class="control-group ">
                                             <label class="control-label">In Date</label>
                                             <input id="dp1" type="text" value="12-02-2012" size="16" class="m-ctrl-medium">
                                             <label class="control-label">Due Date</label>
                                             <input id="dp2" type="text" value="12-02-2012" size="16" class="m-ctrl-medium">
                                             <label class="control-label">Status</label>
                                             <select>
                                                 <option>Paid</option>
                                                 <option>Due</option>
                                             </select>
                                         </div>
                                     </form>
                                 </div>
                                 <div class="space15"></div>
                                 <div class="row-fluid">
                                     <div class="span6 billing-form">
                                         <h4>Billing Address</h4>
                                         <div class="space10"></div>
                                         <form action="#">
                                             <div class="control-group ">
                                                 <label class="control-label">Company Name</label>
                                                 <input type="text" value="" size="16" class=" span8">
                                             </div>
                                             <div class="control-group ">
                                                 <label class="control-label">Address</label>
                                                 <input type="text" value="" size="16" class=" span8">
                                             </div>
                                             <div class="control-group ">
                                                 <label class="control-label">Phone</label>
                                                 <input type="text" value="" size="16" class=" span8">
                                             </div>
                                             <div class="control-group ">
                                                 <label class="control-label">Email</label>
                                                 <input type="text" value="" size="16" class=" span8">
                                             </div>

                                         </form>

                                     </div>

                                     <div class="span6 billing-form">
                                         <h4>Shipping Address</h4>
                                         <div class="space10"></div>
                                         <form action="#">
                                             <div class="control-group ">
                                                 <label class="control-label">Company Name</label>
                                                 <input type="text" value="" size="16" class=" span8">
                                             </div>
                                             <div class="control-group ">
                                                 <label class="control-label">Address</label>
                                                 <input type="text" value="" size="16" class=" span8">
                                             </div>
                                             <div class="control-group ">
                                                 <label class="control-label">Phone</label>
                                                 <input type="text" value="" size="16" class=" span8">
                                             </div>
                                             <div class="control-group ">
                                                 <label class="control-label">Email</label>
                                                 <input type="text" value="" size="16" class=" span8">
                                             </div>

                                         </form>

                                     </div>
                                 </div>
                                 <div class="space15"></div>
                                 <div class="row-fluid">
                                     <div class="span12">
                                         <h4>Invoice</h4>
                                         <table class="table table-hover invoice-input">
                                             <thead>
                                             <tr>
                                                 <th>Item</th>
                                                 <th>Description</th>
                                                 <th>Unit Price</th>
                                                 <th>Quantity</th>
                                                 <th>Total</th>
                                             </tr>
                                             </thead>
                                             <tbody>
                                             <tr>
                                                 <td><input type="text" class="input-mini"></td>
                                                 <td><input type="text" class="input-xlarge"></td>
                                                 <td><input type="text" class="input-mini"></td>
                                                 <td><input type="text" class="input-mini"></td>
                                                 <td><input type="text" class="input-mini"></td>
                                             </tr>
                                             <tr>
                                                 <td><input type="text" class="input-mini"></td>
                                                 <td><input type="text" class="input-xlarge"></td>
                                                 <td><input type="text" class="input-mini"></td>
                                                 <td><input type="text" class="input-mini"></td>
                                                 <td><input type="text" class="input-mini"></td>
                                             </tr>
                                             <tr>
                                                 <td><input type="text" class="input-mini"></td>
                                                 <td><input type="text" class="input-xlarge"></td>
                                                 <td><input type="text" class="input-mini"></td>
                                                 <td><input type="text" class="input-mini"></td>
                                                 <td><input type="text" class="input-mini"></td>
                                             </tr>
                                             <tr>
                                                 <td><input type="text" class="input-mini"></td>
                                                 <td><input type="text" class="input-xlarge"></td>
                                                 <td><input type="text" class="input-mini"></td>
                                                 <td><input type="text" class="input-mini"></td>
                                                 <td><input type="text" class="input-mini"></td>
                                             </tr>
                                             <tr>
                                                 <td colspan="4"></td>
                                                 <td><a href="#">Add More +</a></td>
                                             </tr>
                                             </tbody>
                                         </table>
                                         <div class="row-fluid text-center">
                                             <a class="btn btn-primary btn-large hidden-print">Submit Invoice </a>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
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

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   <script type="text/javascript" src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
   <script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
   <script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
   <script type="text/javascript" src="assets/clockface/js/clockface.js"></script>
   <script type="text/javascript" src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
   <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
   <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
   <script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
   <script type="text/javascript" src="assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>

   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>
   <!--script for this page-->
   <script src="js/form-component.js"></script>

   <!-- END JAVASCRIPTS -->      
</body>
<!-- END BODY -->
</html>