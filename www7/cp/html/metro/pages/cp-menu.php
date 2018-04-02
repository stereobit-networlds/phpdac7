<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Menu</title>
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

   <link rel="stylesheet" type="text/css" href="assets/nestable/jquery.nestable.css" />
   <link rel="stylesheet" href="css/zebra/flat/zebra_dialog.css" type="text/css">
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
                <div class="span12">
                    <div class="margin-bottom-10 pull-right" id="nestable_list_menu">
						<phpdac>rcmenu.menuButtonSelect</phpdac>
                        <button type="button" class="btn btn-success" data-action="expand-all"><phpdac>frontpage.slocale use _expand</phpdac></button>
                        <button type="button" class="btn btn-warning" data-action="collapse-all"><phpdac>frontpage.slocale use _collapse</phpdac></button>
						<button type="button" class="btn" id="save" data-action="collapse-all"><phpdac>frontpage.slocale use _save</phpdac></button>
                    </div>
                </div>
            </div>
			<div class="row-fluid">
				<?METRO/INDEX?>
			</div>
            <!--div class="row-fluid">
                <div class="span12">
                    <h3>Serialised Output (per list)</h3>
                    <div class="row-fluid">
                        <div class="span6">
                            <textarea id="nestable_list_1_output" class="m-wrap span12"></textarea>
                        </div>
                        <div class="span6">
                            <textarea id="nestable_list_2_output" class="m-wrap span12"></textarea>
                        </div>
                    </div>
                </div>
            </div-->
			<!-- menuname var -->
			<input type="hidden" id="menuname" name="menuname" value="<phpdac>cmsrt.echostr use menu</phpdac>" />
			<!-- menuname var -->
            <div class="row-fluid">
                <div class="span6">
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-align-left"></i> <phpdac>frontpage.slocale use _currentmenu</phpdac></h4>
                            <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <!--a href="javascript:;" class="icon-remove"></a-->
                           </span>
                        </div>
                        <div class="widget-body">
                            <div class="dd" id="nestable_list_1">
                                <ol class="dd-list">
                                    <!--li class="dd-item" data-id="recycle-bin">
                                        <div class="dd-handle">Drop element</div>
                                    </li-->									
									<phpdac>rcmenu.readCurrentMenu</phpdac>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="widget purple">
                        <div class="widget-title">
                            <h4><i class="icon-align-left"></i> <phpdac>rcmenu.currentMenuName</phpdac></h4>
                            <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <!--a href="javascript:;" class="icon-remove"></a-->
                           </span>
                        </div>
                        <div class="widget-body">
                            <div class="dd" id="nestable_list_2">
                                <ol class="dd-list">
									<phpdac>rcmenu.readSelectedMenu</phpdac>
                                </ol>
                            </div>
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
   <script src="assets/nestable/jquery.nestable.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->

   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!--script for this page only-->
   <script src="js/nestable.js"></script>
   
   <!-- stream dialog -->
   <script type="text/javascript" src="js/zebra/zebra_dialog.js"></script>   
   <script>
$('#save').click(function() {
  var menuname = $('#menuname').val();			
  var m = JSON.stringify($('#nestable_list_2').nestable('serialize'));
  var tmp = JSON.stringify($('#nestable_list_1').nestable('serialize'));
  //tmp value: [{"id":21,"children":[{"id":196},{"id":195},{"id":49},{"id":194}]},{"id":29,"children":[{"id":184},{"id":152}]},...]
  $.ajax({
    type: 'POST',
    url: 'cpmenu.php?t=cpmsavenest',
    data: {'list': m, 'tmplist': tmp, 'menu': menuname},
    success: function(msg) {
	  new $.Zebra_Dialog(msg, {'type':'information','title':menuname});
    }
  });
});	
  </script>
  
   <!-- END JAVASCRIPTS -->     
</body>
<!-- END BODY -->
</html>