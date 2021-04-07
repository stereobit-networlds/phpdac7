<div id="content" class="site-content" tabindex="-1">
	<div class="container">

		<nav class="woocommerce-breadcrumb" >
			<a href="index.php"><phpdac>cms.slocale use _HOME</phpdac></a><span class="delimiter"><i class="fa fa-angle-right"></i></span>
			<!--hpdac>shkategories.getcurrentkategory</phpda-->
			<phpdac>shkategories.tree_navigation use klist++1+fpkatnav-dropdown</phpdac>
		</nav>
		
		<div id="primary" class="content-area">
			<main id="main" class="site-main">

				<phpdac>shkatalogmedia.show_filtering</phpdac>
				<!--section class="section-product-cards-carousel" >
					<header>
						<h2 class="h1"><phpdac>cmsrt.slocale use _fpprosfores</phpdac></h2>
					</header>
				</section-->
			
				<!--div id="page-<phpdac>shkategories.getcurrentkategory use ++1</phpdac>"-->			
				<?XBODY?>
				<!--/div-->

			</main><!-- #main -->
		</div><!-- #primary -->

		<div id="sidebar" class="sidebar" role="complementary">
			<phpdac>cmsrt.include_part use /inc/components/sidebar/product-categories-widget.php</phpdac>
			<phpdac>cmsrt.include_part use /inc/components/sidebar/product-filters-sidebar.php</phpdac>
			<phpdac>cmsrt.include_part use /inc/components/sidebar/home-v2/home-v2-ad-block.php</phpdac>
			<phpdac>cmsrt.include_part use /inc/components/sidebar/home-v2/latest-products.php</phpdac>
		</div>

	</div><!-- .container -->
</div><!-- #content -->