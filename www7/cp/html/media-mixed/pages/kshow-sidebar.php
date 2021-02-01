<section class="sidebar-page">
    <div class="container">
        
        <!-- ========================================= SIDEBAR ========================================= -->
        <div class="col-xs-12 col-sm-3 no-margin sidebar narrow">

            <!--hpdac>frontpage.include_part use /parts/widgets/sidebar/product-filter.php</phpda-->

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/category-tree.php</phpdac>
            
            <phpdac>frontpage.include_part use /parts/widgets/sidebar/le-links.php</phpdac>
            
            <phpdac>frontpage.include_part use /parts/widgets/sidebar/sidebar-banner.php</phpdac>

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/featured-products.php</phpdac>
            
        </div>
        <!-- ========================================= SIDEBAR : END ========================================= -->

        <!-- ========================================= CONTENT ========================================= -->

        <div class="col-xs-12 col-sm-9 no-margin wide sidebar page-main-content">
            <div id="single-product" class="row">
                <?XBODY?> 
                <phpdac>frontpage.include_part use /parts/section/single-product-gallery.php</phpdac>

                <phpdac>frontpage.include_part use /parts/section/single-product-detail.php</phpdac>

            </div><!-- /.row #single-product -->
            
			<phpdac>frontpage.setGlobal use containerClass+no-container</phpdac>
			<phpdac>frontpage.setGlobal use hasSidebar+1</phpdac>
			<phpdac>frontpage.include_part use /parts/section/single-product-tab.php</phpdac>
			
			<phpdac>frontpage.setGlobal use carouselID+owl-recently-viewed-2</phpdac>
			<phpdac>frontpage.setGlobal use containerClass+no-container</phpdac>			
			<phpdac>frontpage.setGlobal use productItemSize+size-medium</phpdac>
			<phpdac>frontpage.include_part use /parts/section/recently-viewed.php</phpdac>			

        </div><!-- /.page-main-content -->
        <!-- ========================================= CONTENT : END ========================================= -->

    </div><!-- /.container -->
</section><!-- /.sidebar-page -->