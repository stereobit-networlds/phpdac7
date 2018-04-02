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
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
							<div class="update-btn">
                                <a href="cpmhtmleditor.php?t=cpmvphoto&id=<phpdac>fronthtmlpage.getParam use id</phpdac>" class="btn update-easy-pie-chart"><i class="icon-repeat"></i> Refresh</a>
                            </div>
                        </div>
                        <div class="widget-body form">
                            <form action="cpmhtmleditor.php?t=cpmdropzone&title=<phpdac>fronthtmlpage.getParam use id</phpdac>" class="dropzone" id="my-awesome-dropzone"></form>
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

   <!-- BEGIN FOOTER -->
	<phpdac>frontpage.include_part use /parts/footer.php+++metro</phpdac>
   <!-- END FOOTER -->

   <!-- BEGIN JAVASCRIPTS -->
   <!-- Load javascripts at bottom, this will reduce page load time -->
   <script src="js/jquery-1.8.3.min.js"></script>
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="js/jquery.blockui.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>
   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   <script src="assets/fancybox/source/jquery.fancybox.pack.js"></script>

   <!-- MEGAFOLIO PRO GALLERY JS FILES  -->
   <script type="text/javascript" src="assets/metr-folio/js/jquery.metro-gal.plugins.min.js"></script>
   <script type="text/javascript" src="assets/metr-folio/js/jquery.metro-gal.megafoliopro.js"></script>

   <script src="assets/dropzone/dropzone.js"></script>
   <script>
		Dropzone.options.myAwesomeDropzone = {
			paramName: "file", 
			acceptedFiles: "image/*",			
			maxFilesize: 2, // MB
			accept: function(file, done) {
			    var nstr = file.name;//unescape(encodeURIComponent(file.name));
				var sstr = nstr.slice(-4);
				if (sstr.toLowerCase() == "<phpdac>rcserver.paramload use RCITEMS+restype</phpdac>") {
					done();
				}
				else { 
					done("Error");
					console.log("Uploading size or type error!");
			    }
			}
		};
	</script>   
   
   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!-- END JAVASCRIPTS -->

   <script type="text/javascript">

       jQuery(document).ready(function() {

           var api=jQuery('.metro-gal-container').megafoliopro(
                   {
                       filterChangeAnimation:"pagebottom",			// fade, rotate, scale, rotatescale, pagetop, pagebottom,pagemiddle
                       filterChangeSpeed:400,					// Speed of Transition
                       filterChangeRotate:99,					// If you ue scalerotate or rotate you can set the rotation (99 = random !!)
                       filterChangeScale:0.6,					// Scale Animation Endparameter
                       delay:20,
                       defaultWidth:980,
                       paddingHorizontal:10,
                       paddingVertical:10,
                       layoutarray:[9,11,5,3,7,12,4,6,13]		// Defines the Layout Types which can be used in the Gallery. 2-9 or "random". You can define more than one, like {5,2,6,4} where the first items will be orderd in layout 5, the next comming items in layout 2, the next comming items in layout 6 etc... You can use also simple {9} then all item ordered in Layout 9 type.
                   });

           // FANCY BOX ( LIVE BOX) WITH MEDIA SUPPORT
           jQuery(".fancybox").fancybox();

           // THE FILTER FUNCTION
           jQuery('.filter').click(function() {
               jQuery('.filter').each(function() { jQuery(this).removeClass("selected")});
               api.megafilter(jQuery(this).data('category'));
               jQuery(this).addClass("selected");
           });


       });

   </script>

   <phpdac>frontpage.include_part use /parts/google-analytics.php+++meteor</phpdac>
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->     

</body>
<!-- END BODY -->
</html>