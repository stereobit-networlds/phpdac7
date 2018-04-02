<section class="sidebar-page">
    <div class="container">
        
        <!-- ========================================= SIDEBAR ========================================= -->
        <div class="col-xs-12 col-sm-3 no-margin sidebar narrow">

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/product-filter.php+++media-center</phpdac>

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/category-tree.php+++media-center</phpdac>
            
            <phpdac>frontpage.include_part use /parts/widgets/sidebar/le-links.php+++media-center</phpdac>
            
            <phpdac>frontpage.include_part use /parts/widgets/sidebar/sidebar-banner.php+++media-center</phpdac>

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/featured-products.php+++media-center</phpdac>
            
        </div>
        <!-- ========================================= SIDEBAR : END ========================================= -->

        <!-- ========================================= CONTENT ========================================= -->

        <div class="col-xs-12 col-sm-9 no-margin wide sidebar page-main-content">
            <div id="single-product" class="row">

                <phpdac>frontpage.include_part use /parts/section/single-product-gallery.php+++media-center</phpdac>

                <phpdac>frontpage.include_part use /parts/section/single-product-detail.php+++media-center</phpdac>

            </div><!-- /.row #single-product -->
            
			<phpdac>frontpage.setGlobal use containerClass+no-container</phpdac>
			<phpdac>frontpage.setGlobal use hasSidebar+1</phpdac>
			<phpdac>frontpage.include_part use /parts/section/single-product-tab.php+++media-center</phpdac>
			
			<phpdac>frontpage.setGlobal use carouselID+owl-recently-viewed-2</phpdac>
			<phpdac>frontpage.setGlobal use containerClass+no-container</phpdac>			
			<phpdac>frontpage.setGlobal use productItemSize+size-medium</phpdac>
			<phpdac>frontpage.include_part use /parts/section/recently-viewed.php+++media-center</phpdac>			

        </div><!-- /.page-main-content -->
        <!-- ========================================= CONTENT : END ========================================= -->

    </div><!-- /.container -->
</section><!-- /.sidebar-page -->