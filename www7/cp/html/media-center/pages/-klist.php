<section id="category-grid">
    <div class="container">

        <!-- ========================================= SIDEBAR ========================================= -->
        <div class="col-xs-12 col-sm-3 no-margin sidebar narrow">

            <!--hpdac>frontpage.include_part use /parts/widgets/sidebar/product-filter.php+++media-center</phpda-->

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/category-tree.php+++media-center</phpdac>

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/le-links.php+++media-center</phpdac>

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/sidebar-banner.php+++media-center</phpdac>

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/featured-products.php+++media-center</phpdac>

        </div>
        <!-- ========================================= SIDEBAR : END ========================================= -->

        <!-- ========================================= CONTENT ========================================= -->

        <div class="col-xs-12 col-sm-9 no-margin wide sidebar">

            <div id="grid-page-banner">
                <a href="#">
                    <!--img src="assets/images/banners/banner-gamer.jpg" alt="" /-->
					<phpdac>shkategories.show_category_image</phpdac>
                </a>
            </div>
            <?MEDIA-CENTER/INDEX?>
            <!--hpdac>frontpage.include_part use /parts/section/category-products.php+++media-center</phpda-->
                        
        </div><!-- /.col -->
        <!-- ========================================= CONTENT : END ========================================= -->    
    </div><!-- /.container -->
</section><!-- /#category-grid -->