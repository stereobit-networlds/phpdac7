<section id="category-grid">
    <div class="container">

        <!-- ========================================= CONTENT ========================================= -->

        <div class="col-xs-12 col-sm-9 no-margin wide sidebar">

            <div id="grid-page-banner">
                <a href="#">
					<phpdac>shkategories.show_category_image</phpdac>
                </a>
            </div>
			
			<div id="page-<phpdac>shkategories.getcurrentkategory use ++1</phpdac>">			
			<?XBODY?>
			</div>
            
        </div><!-- /.col -->
        <!-- ========================================= CONTENT : END ========================================= -->    
		
        <!-- ========================================= SIDEBAR ========================================= -->
        <div class="col-xs-12 col-sm-3 no-margin sidebar narrow">

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/product-filter.php</phpdac>

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/category-tree.php</phpdac>

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/le-links.php</phpdac>

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/sidebar-banner.php</phpdac>

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/featured-products.php</phpdac>

        </div>
        <!-- ========================================= SIDEBAR : END ========================================= -->		
    </div><!-- /.container -->
</section><!-- /#category-grid -->