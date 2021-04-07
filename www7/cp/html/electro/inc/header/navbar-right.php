<ul class="navbar-mini-cart navbar-nav animate-dropdown nav pull-right flip">
	<li class="nav-item dropdown">
		<a href="index.php?page=cart" class="nav-link" data-toggle="dropdown">
			<i class="ec ec-shopping-bag"></i>
			<span class="cart-items-count count"><phpdac>shcart.getcartItems</phpdac></span>
			<span class="cart-items-total-price total-price"><span class="amount"><phpdac>shcart.getcartTotal</phpdac></span></span>
		</a>
		<ul class="dropdown-menu dropdown-menu-mini-cart">
			<li>
				<div class="widget_shopping_cart_content">
					<ul class="cart_list product_list_widget ">
						<phpdac>shcart.quickview</phpdac>
					</ul><!-- end product list -->

					<p class="total"><strong>Subtotal:</strong> <span class="amount"><phpdac>shcart.getcartTotal</phpdac></span></p>

					<p class="buttons">
						<a class="button wc-forward" href="cart/"><phpdac>cms.slocale use _VIEWCART</phpdac></a>
						<a class="button checkout wc-forward" href="cart-checkout/"><phpdac>cms.slocale use _CHECKOUT</phpdac></a>
					</p>
				</div>
			</li>
		</ul>
	</li>
</ul>

<ul class="navbar-wishlist nav navbar-nav pull-right flip">
	<li class="nav-item">
		<a href="wslist/" class="nav-link"><i class="ec ec-favorites"></i></a>
	</li>
</ul>
<ul class="navbar-compare nav navbar-nav pull-right flip">
	<li class="nav-item">
		<a href="cmplist/" class="nav-link"><i class="ec ec-compare"></i></a>
	</li>
</ul>