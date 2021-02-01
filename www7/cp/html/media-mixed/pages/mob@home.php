<!--div id="top-banner-and-menu"> <- class="homepage2" ->
	<div class="container">
		<div class="col-xs-12">
			<-hpdac>cmsrt.include_part use /parts/section/home-page-slider-2.php</phpda->
			<-hpdac>cms.callVar use fpslider</phpda->
		</div>
	</div>
</div--><!-- /#top-banner-and-menu -->

<!--hpdac>cmsrt.include_part use /parts/section/home-banners.php</phpda-->
<phpdac>cms.callVar use fpbanner</phpdac>

<phpdac>cmsrt.include_part use /parts/section/home-page-tabs.php</phpdac>

<!--hpdac>cmsrt.include_part use /parts/section/best-sellers.php</phpda-->
<!--hpdac>cmsrt.renderTemplate use fpbestsellers+55112,55597,55595,55829,55165,55275,56050++code5++bestsellers</phpda-->
<phpdac>cms.callVar use fpbestsellers</phpdac>

<phpdac>cmsrt.include_part use /parts/section/recently-viewed.php</phpdac>

<phpdac>cmsrt.include_part use /parts/section/top-brands.php</phpdac>

<!-- homepage 2 -->