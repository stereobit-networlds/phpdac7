<!--form enctype="multipart/form-data" action="$0$" class="checkout woocommerce-checkout" method="post" name="cartview"-->
	<div id="customer_details" class="col2-set">
		<div class="col-1">
			<div class="woocommerce-billing-fields">

				<h3><phpdac>cmsrt.slocale use _BILLINGDETAILS</phpdac></h3>
				
				<!-- customer form data -->
				$2$
				<!--hpdac>shcustomer.getcustomer</phpda-->
			</div>
		</div>

		<div class="col-2">
		
			<div class="woocommerce-shipping-fields">
			
				$0$	
				
				<!-- 1 -->
				
				<!--a class="button" href="transview/"><phpdac>cmsrt.slocale use _TRANSLIST</phpdac></a-->
				<phpdac>
					cmsrt.nvl use createaccount+
					<?php
						$title =  localize('_TRANSLIST', getlocal());	
						$link = _v('shcart.baseurl') . "/transview/";							
						$ret = "<a class='button' href='$link'>$title</a>";	
						return $ret;
					?>
					+
					<?php
						$title =  localize('_CREATEACCOUNTOPTIONREJECTED', getlocal());	
						$link = _v('shcart.baseurl') . "/tools/";							
						$ret = "<a class='button' href='$link'>$title</a>";	
						return $ret;
					?>
					+
				</phpdac>
				
				<!--a class="button" href="clickaway/"><phpdac>cmsrt.slocale use _CLICKAWAYENABLE</phpdac></a-->				
				<phpdac>
					cmsrt.nvl use shcart.clickaway+
					<?php
						$title =  localize('_CLICKAWAYENABLE', getlocal());	
						$link = _v('shcart.baseurl') . "/clickaway/";							
						$ret = "<a class='button' href='$link'>$title</a>";
						return $ret;		
					?>
					++
				</phpdac>	
						
			</div>
		</div>
	</div>

	<h3 id="order_review_heading"><phpdac>cmsrt.slocale use _CART</phpdac></h3>

	<div class="woocommerce-checkout-review-order" id="order_review">
		<table class="shop_table woocommerce-checkout-review-order-table">
			<thead>
				<tr>
					<th class="product-name"><phpdac>cmsrt.slocale use _item</phpdac></th>
					<th class="product-total"><phpdac>cmsrt.slocale use _TOTAL</phpdac></th>
				</tr>
			</thead>
			<tbody>
				$3$
			</tbody>
			<tfoot>
				$4$
			</tfoot>
			
		</table>

		<div class="woocommerce-checkout-payment" id="payment">
			<div class="form-row place-order">

			    <!--p class="form-row terms wc-terms-and-conditions">
					<input type="checkbox" id="terms" name="terms" class="input-checkbox">
			        <label class="checkbox" for="terms">I’ve read and accept the <a target="_blank" href="index.php?page=terms-and-conditions">terms &amp; conditions</a> <span class="required">*</span></label>
			        <input type="hidden" value="1" name="terms-field">					
			    </p-->

				<!--input type="submit" data-value="Place order" value="Place order" class="button alt"-->
				<a href="katalog.php?page=track-your-order" class="button alt">Track your order</a>
			</div>
		</div>
	</div>
<!--/form-->