<div id="content" class="site-content" tabindex="-1">
	<div class="container">

		<nav class="woocommerce-breadcrumb" ><a href="index.php"><phpdac>cms.slocale use _HOME</phpdac></a><span class="delimiter"><i class="fa fa-angle-right"></i></span><phpdac>shkategories.getcurrentkategory</phpdac></nav>

		<div id="primary" class="content-area">
			<main id="main" class="site-main">
			
				<!--div id="page-<phpdac>shkategories.getcurrentkategory use ++1</phpdac>"-->			
				<?XBODY?>
				<!--/div-->			

				<section class="section-product-cards-carousel" >
					<header>
						<h2 class="h1"><phpdac>cmsrt.slocale use _fpprosfores</phpdac></h2>
						<div class="owl-nav">
							<a href="#products-carousel-prev" data-target="#recommended-product" class="slider-prev"><i class="fa fa-angle-left"></i></a>
							<a href="#products-carousel-next" data-target="#recommended-product" class="slider-next"><i class="fa fa-angle-right"></i></a>
						</div>
					</header>

					<div id="recommended-product">
						<div class="woocommerce columns-4">
							<div class="products owl-carousel products-carousel columns-4 owl-loaded owl-drag">
								<!--hpdac>cmsrt.include_part use /inc/components/product-carousel-item.php'</phpda-->
								<phpdac>shkatalogmedia.show_menu_items use 9++fpproducts-carousel-tab+1+prosfores</phpdac>
							</div>
						</div>
					</div>
				</section>

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