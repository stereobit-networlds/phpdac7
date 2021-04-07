<!DOCTYPE html>
<html lang="<phpdac>cms.iso_language</phpdac>" itemscope="itemscope" itemtype="http://schema.org/WebPage">
    <head>
	    <base href="<phpdac>cms.paramload use SHELL+urlbase+1</phpdac>/" />
		
		<phpdac>cms.nvldac2param use CMS.demo+cmsrt.included:index-meta-demo+cmsrt.included:index-meta+</phpdac>

        <phpdac>cms.nvldac2param use CMS.demo+cmsrt.included:index-css-demo+cmsrt.included:index-css+</phpdac>
		
		<!--script> var sc = new Array();	</script-->
			
		<!--script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="css/cookiesLibrary/style.min.css" type="text/css"/>
		<script src="js/cookiesLibrary.min.js"></script-->		
		
		<phpdac>cms.include_partDb use headstyle+++style</phpdac>			
	</head>
<body class="<phpdac>cms.echostr use bodyClass</phpdac>">
	<!--div id="fb-root"></div>
	<div class="fb-customerchat"
        attribution=setup_tool
        page_id="<phpdac>cms.paramload use INDEX+messengerpageid</phpdac>"
  logged_in_greeting="<phpdac>cms.paramload use INDEX+messengerin</phpdac>"
  logged_out_greeting="<phpdac>cms.paramload use INDEX+messengerout</phpdac>">
      </div-->

	<!--div class="wrapper"-->
		<!--hpdac>cms.nvldac2param use CMS.noheader+cmsrt.included:index-ver2+cmsrt.included:index-ver1+</phpda-->
	<!--/div-->
	<div id="page" class="hfeed site">
            <a class="skip-link screen-reader-text" href="#site-navigation">Skip to navigation</a>
            <a class="skip-link screen-reader-text" href="#content">Skip to content</a>

            <phpdac>cmsrt.include_part use /inc/header/top-bar.php</phpdac>
			<!--hpdac>cmsrt.include_part use /inc/header/header-v2.php</phpda-->
			<phpdac>cms.include_part_arg use /inc/header/<headerfile>.php</phpdac>

            <!--hpdac>cmsrt.include_part use /pages/home.php</phpda-->
			<phpdac>cms.include_part_arg use /pages/<mc_page>.php</phpdac>
            <!--hpdac>cms.nvldac2 use cmsrt.MC_CURRENT_PAGE+cms.include_part_arg:/pages/<mc_page>_rtl.php+cms.include_part_arg:/pages/<mc_page>.php+klist|kshow|product|products|kfilter|search</phpda-->

            <phpdac>cmsrt.include_part use /inc/footer/brands-carousel.php</phpdac>
            <phpdac>cmsrt.include_part use /inc/footer/footer.php</phpdac>

    </div><!-- #page -->
	
	<phpdac>cms.nvldac2param use CMS.demo+cmsrt.included:index-js-demo+cmsrt.included:index-js+</phpdac>	
	
<!--script type="text/javascript" src="jsdialog.php?t=divstart"></script-->
</body>
</html>