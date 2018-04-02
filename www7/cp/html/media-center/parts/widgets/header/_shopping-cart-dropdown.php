<div class="top-cart-row-container">
    <div class="wishlist-compare-holder">
        <div class="wishlist ">
            <a href="wslist/"><i class="fa fa-heart"></i> <phpdac>frontpage.slocale use _WISHLIST</phpdac> <span class="value">(<phpdac>shwishlist2.wishcount</phpdac>)</span> </a>
        </div>
        <div class="compare">
            <a href="cmplist/"><i class="fa fa-exchange"></i> <phpdac>frontpage.slocale use _COMPARE</phpdac> <span class="value">(<phpdac>shwishlist2.cmpcount</phpdac>)</span> </a>
        </div>
    </div>

    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
    <div class="top-cart-holder dropdown animate-dropdown">
        
        <div class="basket">
            
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <div class="basket-item-count">
                    <span class="count"><phpdac>shcart.getcartItems</phpdac></span>
                    <img src="assets/images/icon-cart.png" alt="" />
                </div>

                <div class="total-price-basket"> 
                    <span class="lbl"><phpdac>frontpage.slocale use _MYCART</phpdac>:</span>
                    <span class="total-price">
                        <span class="value"><phpdac>shcart.getcartTotal</phpdac></span><span class="sign">&euro;</span>
                    </span>
                </div>
            </a>

            <ul class="dropdown-menu">
			    <phpdac>shcart.quickview</phpdac>

                <li class="checkout">
                    <div class="basket-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <a href="cart/" class="le-button inverse"><phpdac>frontpage.slocale use _VIEWCART</phpdac></a>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <a href="cart-checkout/" class="le-button"><phpdac>frontpage.slocale use _CHECKOUT</phpdac></a>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </div><!-- /.basket -->
    </div><!-- /.top-cart-holder -->
</div><!-- /.top-cart-row-container -->
<!-- ============================================================= SHOPPING CART DROPDOWN : END ============================================================= -->