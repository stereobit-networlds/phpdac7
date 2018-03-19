<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>CKFinder</title>
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
	<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
	<style type="text/css">
		body, html, iframe, #ckfinder {
			margin: 0;
			padding: 0;
			border: 0;
			width: 100%;
			height: 100%;
			overflow: hidden;
		}
	</style>
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
             <!--div class="row-fluid">
                 <div class="span12"-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <!--div class="widget red">
                         <div class="widget-title">
                             <h4><i class="icon-edit"></i> CK Finder </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                         </div>
                         <div class="widget-body"-->
                             <div id="ckfinder" style="height:800px;"></div>
                         <!--/div>
                     </div-->
                     <!-- END BLANK PAGE PORTLET-->
                 <!--/div>
             </div-->
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
   
	<script type="text/javascript">
(function()
{
		var config = {
		};
		var get = CKFinder.tools.getUrlParam;
		var getBool = function( v )
		{
			var t = get( v );

			if ( t === null )
				return null;

			return t == '0' ? false : true;
		};

		var tmp;
		if ( tmp = get( 'basePath' ) )
			CKFINDER.basePath = tmp;

		if ( tmp = get( 'startupPath' ) )
			config.startupPath = decodeURIComponent( tmp );

		config.id = get( 'id' ) || '';

		if ( ( tmp = getBool( 'rlf' ) ) !== null )
			config.rememberLastFolder = tmp;

		if ( ( tmp = getBool( 'dts' ) ) !== null )
			config.disableThumbnailSelection = tmp;

		if ( tmp = get( 'data' ) )
			config.selectActionData = tmp;

		if ( tmp = get( 'tdata' ) )
			config.selectThumbnailActionData = tmp;

		if ( tmp = get( 'type' ) )
			config.resourceType = tmp;

		if ( tmp = get( 'skin' ) )
			config.skin = tmp;

		if ( tmp = get( 'langCode' ) )
			config.language = tmp;

		// Try to get desired "File Select" action from the URL.
		var action;
		if ( tmp = get( 'CKEditor' ) )
		{
			if ( tmp.length )
				action = 'ckeditor';
		}
		if ( !action )
			action = get( 'action' );

		var parentWindow = ( window.parent == window )
			? window.opener : window.parent;

		switch ( action )
		{
			case 'js':
				var actionFunction = get( 'func' );
				if ( actionFunction && actionFunction.length > 0 )
					config.selectActionFunction = parentWindow[ actionFunction ];

				actionFunction = get( 'thumbFunc' );
				if ( actionFunction && actionFunction.length > 0 )
					config.selectThumbnailActionFunction = parentWindow[ actionFunction ];
				break ;

			case 'ckeditor':
				var funcNum = get( 'CKEditorFuncNum' );
				if ( parentWindow['CKEDITOR'] )
				{
					config.selectActionFunction = function( fileUrl, data )
					{
						parentWindow['CKEDITOR'].tools.callFunction( funcNum, fileUrl, data );
					};

					config.selectThumbnailActionFunction = config.selectActionFunction;
				}
				break;

			default:
				if ( parentWindow && parentWindow['FCK'] && parentWindow['SetUrl'] )
				{
					action = 'fckeditor' ;
					config.selectActionFunction = parentWindow['SetUrl'];

					if ( !config.disableThumbnailSelection )
						config.selectThumbnailActionFunction = parentWindow['SetUrl'];
				}
				else
					action = null ;
		}

		config.action = action;

		// Always use 100% width and height when nested using this middle page.
		config.width = config.height = '100%';

		var ckfinder = new CKFinder( config );
		ckfinder.replace( 'ckfinder', config );
})();
	</script>   

	<phpdac>frontpage.include_part use /parts/google-analytics.php+++meteor</phpdac>
	<!-- e-Enterprise, stereobit.networlds (phpdac5) -->   
</body>
<!-- END BODY -->
</html>