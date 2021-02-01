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
	
	<phpdac>cmsrt.included use /parts/message-footer</phpdac>

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
				    <!-- <phpdac>shtags.pageTags use 2</phpdac>&nbsp; -->
					&copy; 2020 <a href="<phpdac>cmsrt.get_admin_link use 1</phpdac>"><img alt="e-Enterprise" src="images/icon_cp.png"/></a>
					<!--hpdac>fronthtmlpage.get_copyright</phpda--> 
					<!--a href="sitemap.php"><img src="images/sitemap.png" border="0" /></a--> 
					all rights reserved.  
					&nbsp;|&nbsp; <a href="http://www.stereobit.gr/enterprise.php" target="_blank"> &egrave;-Enterprise</a> by stereobit
                </div><!-- /.copyright -->
            </div>
            <div class="col-xs-12 col-sm-6 no-margin">
                <div class="payment-methods ">
                    <ul>
                        <li><img alt="visa" src="assets/images/payments/payment-visa.png"></li>
                        <li><img alt="master" src="assets/images/payments/payment-master.png"></li>
                        <li><img alt="paypal" src="assets/images/payments/payment-paypal.png"></li>
                        <li><img alt="scrill" src="assets/images/payments/payment-skrill.png"></li>
                    </ul>
                </div><!-- /.payment-methods -->
            </div>
        </div><!-- /.container -->
    </div><!-- /.copyright-bar -->

</footer><!-- /#footer -->
<!-- ============================================================= FOOTER : END ============================================================= -->