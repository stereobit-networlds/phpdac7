	<form name='cartview' method='POST' action='$0$'>
	
    <table class="shop_table shop_table_responsive cart">
        <thead>
            <tr>
                <th class="product-remove">&nbsp;</th>
                <th class="product-thumbnail">&nbsp;</th>
                <th class="product-name">&nbsp;</th>
                <th class="product-price"><phpdac>cmsrt.slocale use _PRICE</phpdac></th>
                <th class="product-quantity"><phpdac>cmsrt.slocale use _QTY</phpdac></th>
                <th class="product-subtotal"><phpdac>cmsrt.slocale use _TOTAL</phpdac></th>
            </tr>
        </thead>
        <tbody>	
       <!-- ========================================= CONTENT ========================================= -->
        <!--div class="col-xs-12 col-md-9 items-holder no-margin"-->
			<!--1 datetime-->				
	        $3$  
			<!-- 4 footer -->
			<!-- 2 user data-->						
						
			
        <!--/div-->
        <!-- ========================================= CONTENT : END ========================================= -->
		    <tr>
                <td class="actions" colspan="6">

                    <!--div class="coupon">
                        <label for="coupon_code">Coupon:</label> <input type="text" placeholder="Coupon code" value="" id="coupon_code" class="input-text" name="coupon_code"> <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
                    </div-->	

					<!-- coupon 0/1 -->
					<phpdac>
					cmsrt.nvl use shcart.status+
					<?php
						return _m('shcart.validCoupon') ? null : '
					<div class="coupon">
                        <label for="coupon_code">Coupon:</label> <input type="text" placeholder="Coupon code" value="" id="coupon_code" class="input-text" name="coupon"> <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
                    </div>';
					?>
					++0|1
					</phpdac>

					<!-- info 0 text -->						

					<!-- info 1 text/form -->				
										

                    <!--input type="submit" value="Update Cart" name="update_cart" class="button"-->
					<!--utton type="submit" value="cart-checkout" name="update_cart" class="button">checkout</button-->

                    <div class="wc-proceed-to-checkout">

                        <!--a class="checkout-button button alt wc-forward" href="index.php?page=checkout">Proceed to Checkout</a-->
						<phpdac>
						cmsrt.nvl use shcart.status++
						<?php
						if ($cat = GetReq('cat')) {
							$title =  localize('_CONTINUESHOP', getlocal());	
							$link = _v('shcart.baseurl') . "/klist/$cat/";							
							$ret = "<a class='button' href='$link'>$title</a>";		
							return $ret;							
						}	
						?>
						+
						</phpdac>

						<phpdac>
						cmsrt.nvl use shcart.fastpick++
						<?php
						if (!$button = _v('shcart.fastpickbutton')) return;
						if (!$status = _v('shcart.status')) {
							if ($cat = GetReq('cat')) {
								$title =  localize('_FASTPICK', getlocal());	
								$link = _v('shcart.baseurl') . "/fastpick/";							
								$ret = "<a class='button' href='$link'>$title</a>";
							}
							else
								$ret = "";
							return $ret;
						}	
						?>
						+
						</phpdac>						
						
						<phpdac>
						cmsrt.nvl use shcart.status++
						<?php	
						$submit = '<input type="submit" class="button" name="FormAction" value="' . _v('shcart.checkout') . '">';
						return $submit;
						?>
						+
						</phpdac>					
                    </div>
                </td>
            </tr>												
        </tbody>
    </table>
	
	$4$
	
    </form>