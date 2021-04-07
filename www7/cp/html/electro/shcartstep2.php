<form enctype="multipart/form-data" action="$0$" class="checkout woocommerce-checkout" method="post" name="cartview">
	<div id="customer_details" class="col2-set">
		<div class="col-1">
			<div class="woocommerce-billing-fields">

				<h3><phpdac>cmsrt.slocale use _BILLINGDETAILS</phpdac></h3>
				
				<!-- customer form data -->
				$2$
				
				<div class="clear"></div>

				<!--p class="form-row form-row-wide create-account"><input type="checkbox" value="1" name="createaccount" id="createaccount" class="input-checkbox"> <label class="checkbox" for="createaccount">Create an account?</label></p-->

			</div>
		</div>

		<div class="col-2">
		
			<div class="woocommerce-shipping-fields">
			
				<h3><phpdac>cmsrt.slocale use _DELIVERYADDRESS</phpdac></h3>			
				<phpdac>cmsrt.addressDetails use 1</phpdac>

			    <h3><phpdac>cmsrt.slocale use _CARTDELIVERYWAY</phpdac></h3>
				<phpdac>cmsrt.slocaleParam use roadway</phpdac>				
			
			    <h3><phpdac>cmsrt.slocale use _CARTPAYWAY</phpdac></h3>
				<phpdac>cmsrt.slocaleParam use payway</phpdac>			
				
			    <h3><phpdac>cmsrt.slocale use _SELECTCUSTYPE</phpdac></h3>
				<phpdac>shcart.customerway2</phpdac>			
				
				<h3><phpdac>cmsrt.slocale use _SELECTINVTYPE</phpdac></h3>
				<phpdac>shcart.invoiceway2</phpdac>	

				<phpdac>
				cmsrt.nvl use sxolia+
				<?php
					$title = localize('_NOTES', getlocal());
					$sxolia = GetParam('sxolia');
					return "<h3>$title</h3>" . $sxolia;
				?>
				+
				+
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

			    <p class="form-row terms wc-terms-and-conditions">
					<phpdac>
					cmsrt.nvl use shcart.status+
					<input type="checkbox" id="terms" name="terms" class="input-checkbox">
					<input type="hidden" value="1" name="terms-field">
					++1
					</phpdac>
					
					<phpdac>
					cmsrt.nvl use shcart.status+
					<?php
				    $text = localize('_TERMSTEXT', getlocal());
					$terms = localize('_TERMSTITLE', getlocal());
					return "<label class=\"checkbox\" for=\"terms\">$text <a target=\"_blank\" href=\"terms.php\">$terms</a> <span class=\"required\">*</span></label>";
					?>
					++1|2
					</phpdac>					
			    </p>

				<phpdac>
					cmsrt.nvl use shcart.status+
					<?php
						$cancel = _v('shcart.testcart') ?
									'<input type="submit" class="button" name="FormAction" value="' . _v('shcart.cancel') . '">' :
									null;
						$submit = _v('shcart.fastcart') ? 
									'<input type="submit" class="button" name="FormAction" value="' . _v('shcart.submit') . '">':
						            '<input type="submit" class="button" name="FormAction" value="' . _v('shcart.submit') . '">';
						return $cancel . $submit;
					?>
					++2
				</phpdac>
			</div>
		</div>
	</div>
</form>