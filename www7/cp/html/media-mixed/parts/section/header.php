<!-- ============================================================= HEADER ============================================================= -->
<header id="header">
	<div class="container no-padding">
		
		<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
			<phpdac>cmsrt.include_part use /parts/widgets/header/logo.php</phpdac>
		</div><!-- /.logo-holder -->

		<div class="col-xs-12 col-sm-12 col-md-6 top-search-holder no-margin">
			<phpdac>cmsrt.include_part use /parts/widgets/header/search-bar.php</phpdac>
		</div><!-- /.top-search-holder -->

		<div class="col-xs-12 col-sm-12 col-md-3 top-cart-row no-margin">
			<phpdac>cmsrt.include_part use /parts/widgets/header/shopping-cart-dropdown.php</phpdac>
		</div><!-- /.top-cart-row -->
	</div><!-- /.container -->
	
	<phpdac>cms.nvldac2 use cmsrt.mobile+cmsrt.include_part:/parts/navigation/horizontal-menu.php++</phpdac>

	<phpdac>cms.nvldac2 use cmsrt.mobile+cmsrt.include_part:/parts/breadcrumb/breadcrumb.php++</phpdac>
</header>

<phpdac>cmsrt.included use /parts/message-header</phpdac>	
<!-- ============================================================= HEADER : END ============================================================= -->