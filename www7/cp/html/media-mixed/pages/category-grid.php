<!--php
    $isListView = isset($_GET['view']) && ($_GET['view'] == 'list') ? true : false;
-->
<section id="category-grid">
    <div class="container">
        
        <!-- ========================================= SIDEBAR ========================================= -->
        <div class="col-xs-12 col-sm-3 no-margin sidebar narrow">

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/product-filter.php</phpdac>

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/special-offers.php</phpdac>

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/sidebar-banner.php</phpdac>

            <phpdac>frontpage.include_part use /parts/widgets/sidebar/featured-products.php</phpdac>

        </div>
        <!-- ========================================= SIDEBAR : END ========================================= -->

        <!-- ========================================= CONTENT ========================================= -->

        <div class="col-xs-12 col-sm-9 no-margin wide sidebar">

            <phpdac>frontpage.include_part use /parts/section/recommended-products.php</phpdac>
            
            <phpdac>frontpage.include_part use /parts/section/category-products.php</phpdac>
            
        </div><!-- /.col -->
        <!-- ========================================= CONTENT : END ========================================= -->    
    </div><!-- /.container -->
</section><!-- /#category-grid -->