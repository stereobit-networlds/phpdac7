<!-- ============================================================= FOOTER ============================================================= -->
<footer id="footer" class="color-bg">
    
    <div class="container">
        <div class="row no-margin widgets-row">
            <div class="col-xs-12  col-sm-4 no-margin-left">
                <phpdac>frontpage.include_part use /parts/widgets/footer/featured-products-footer.php+++media-center</phpdac>
            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-4 ">
                <phpdac>frontpage.include_part use /parts/widgets/footer/on-sale-products-footer.php+++media-center</phpdac>
            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-4 ">
                <phpdac>frontpage.include_part use /parts/widgets/footer/top-rated-products-footer.php+++media-center</phpdac>
            </div><!-- /.col -->

        </div><!-- /.widgets-row-->
    </div><!-- /.container -->

	<!-- when global nosubform disable subscribe form -->
    <phpdac>frontpage.nvldac2 use nosubform++frontpage.include_part:/parts/widgets/footer/subscribe-form.php|||media-center</phpdac>

    <div class="link-list-row">
        <div class="container no-padding">
            <div class="col-xs-12 col-md-4 ">
                <phpdac>frontpage.include_part use /parts/widgets/footer/contact-info-footer.php+++media-center</phpdac>
            </div>

            <div class="col-xs-12 col-md-8 no-margin">
                <phpdac>frontpage.include_part use /parts/widgets/footer/links-footer.php+++media-center</phpdac>
            </div>
        </div><!-- /.container -->
    </div><!-- /.link-list-row -->

    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-margin">
                <div class="copyright"> 
					<phpdac>fronthtmlpage.get_copyright</phpdac> 
					<!--a href="sitemap.php"><img src="images/sitemap.png" border="0" /></a--> 
					- all rights reserved.  
					<!--a href="http://www.stereobit.gr" target="_blank"><img src="images/stereobit.png" width="88" height="12" border="0" /></a-->
					&nbsp;|&nbsp; <a href="http://www.stereobit.gr/enterprise.php" target="_blank"> e-Enterprise</a>&reg; by stereobit
                </div><!-- /.copyright -->
            </div>
            <div class="col-xs-12 col-sm-6 no-margin">
                <div class="payment-methods ">
                    <ul>
                        <li><img alt="" src="assets/images/payments/payment-visa.png"></li>
                        <li><img alt="" src="assets/images/payments/payment-master.png"></li>
                        <li><img alt="" src="assets/images/payments/payment-paypal.png"></li>
                        <li><img alt="" src="assets/images/payments/payment-skrill.png"></li>
                    </ul>
                </div><!-- /.payment-methods -->
            </div>
        </div><!-- /.container -->
    </div><!-- /.copyright-bar -->

</footer><!-- /#footer -->
<!-- ============================================================= FOOTER : END ============================================================= -->