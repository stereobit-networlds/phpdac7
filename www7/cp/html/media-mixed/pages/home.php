<div id="top-banner-and-menu">
	<div class="container">
		
		<div class="col-xs-12 col-sm-4 col-md-3 sidemenu-holder">
			<phpdac>cmsrt.include_part use /parts/navigation/sidemenu.php</phpdac>
		</div><!-- /.sidemenu-holder -->

		<div class="col-xs-12 col-sm-8 col-md-9 homebanner-holder">
			<!--hpdac>cmsrt.include_part use /parts/section/home-page-slider.php</phpda-->	
			<phpdac>cms.callVar use fpslider</phpdac>
		</div><!-- /.homebanner-holder -->

	</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

<!--hpdac>cmsrt.include_part use /parts/section/home-banners.php</phpda-->
<phpdac>cms.callVar use fpbanner</phpdac>

<phpdac>cmsrt.include_part use /parts/section/home-page-tabs.php</phpdac>

<!--hpdac>cmsrt.include_part use /parts/section/best-sellers.php</phpda-->
<!--hpdac>cmsrt.renderTemplate use fpbestsellers+55112,55597,55595,55829,55165,55275,56050++code5++bestsellers</phpda-->
<phpdac>cms.callVar use fpbestsellers</phpdac>

<phpdac>cmsrt.include_part use /parts/section/recently-viewed.php</phpdac>

<phpdac>cmsrt.include_part use /parts/section/top-brands.php</phpdac>

<!-- homepage -->