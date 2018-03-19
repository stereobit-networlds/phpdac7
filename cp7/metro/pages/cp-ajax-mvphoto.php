<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Gallery</title>
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

    <link rel="stylesheet" type="text/css" href="assets/metr-folio/css/metro-gallery.css" media="screen" />
    <link href="assets/dropzone/css/dropzone.css" rel="stylesheet"/>
	
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
   <!-- BEGIN CONTAINER -->
   <div id="container" class="row-fluid">
      <!-- BEGIN PAGE -->
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE CONTENT-->
             <div class="row-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORMPORTLET-->
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-camera"></i> Gallery</h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div class="megaexamples">
                                <!--  FILTER STYLED  -->
                                <div class="filter_padder" >
                                    <div class="filter_wrapper">
                                        <div class="filter selected" data-category="cat-all">ALL</div>
										<div class="filter" data-category="cat-large">LARGE</div>
										<div class="filter" data-category="cat-medium">MEDIUM</div>
										<div class="filter" data-category="cat-small">SMALL</div>
										<div class="filter" data-category="cat-uphotos">UPHOTOS</div>
										<div class="filter" data-category="cat-thumb">THUMB</div>
										<div class="filter last-child" data-category="cat-dummy">DROPZONE</div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="metro-gallery">
                                    <!-- The GRID System -->
                                    <div class="metro-gal-container noborder norounded dark-bg-entries">
										<?METRO/INDEX?>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
					<!-- BEGIN DROPZONE -->
					<div class="widget red">
                        <div class="widget-title">
                            <h4><i class="icon-asterisk"></i> Dropzone File Upload</h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <!--a href="javascript:;" class="icon-remove"></a-->
                            </span>
							<div class="update-btn">
                                <a href="cpmhtmleditor.php?t=cpmvphoto&ajax=1&id=<phpdac>fronthtmlpage.getParam use id</phpdac>" class="btn update-easy-pie-chart"><i class="icon-repeat"></i> Refresh</a>
                            </div>
                        </div>
                        <div class="widget-body form">
                            <form action="cpmhtmleditor.php?t=cpmdropzone&ajax=1&title=<phpdac>fronthtmlpage.getParam use id</phpdac>" class="dropzone" id="my-awesome-dropzone"></form>
                        </div>
                    </div>	
					<!-- END DROPZONE -->					
                </div>
             </div>
            <!-- END PAGE CONTENT-->
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER --> 

</body>
<!-- END BODY -->
</html>   