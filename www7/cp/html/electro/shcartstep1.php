<form enctype="multipart/form-data" action="$0$" class="checkout woocommerce-checkout" method="post" name="cartview">
	<div id="customer_details" class="col2-set">
		<div class="col-1">
			<div class="woocommerce-billing-fields">

				<h3><phpdac>cmsrt.slocale use _BILLINGDETAILS</phpdac></h3>
				
				<phpdac>
				cmsrt.nvl use shcart.status+
				<?php
					$title = localize('_BILLINGDETAILS', getlocal());
					$title_onestep = localize('_ONESTEPREGISTRATION', getlocal());
					$title_fastcart = localize('_FATCARTREGISTRATION', getlocal());
					return (GetGlobal('UserID')) ? null : 
					'<!--h3 id="guestuser">'. $title .'</h3-->
					<a id="guestdetailsbutton" href="cart-checkout/#guestuser" class="button">'. $title_fastcart. '</a>';	
				?>
				++1
				</phpdac>
				
				<div id="guestdetails">	
					<phpdac>cms.nvldac2 use UserID++cmsrt.include_part:/shcartguestform.php+</phpdac>
				</div>
				
				<!-- customer form data -->
				$2$

			</div>
		</div>

		<div class="col-2">
		
			<!--h3><phpdac>cmsrt.slocale use _DELIVERYADDRESS</phpdac></h3-->
			<h3>
			<phpdac>
			cmsrt.phpcode use
			<?php
				$title1 = localize('_DELIVERYADDRESS', getlocal());
				$title2 = localize('_REGISTER', getlocal());
				return _v('shcart.superfastcart') ? $title1 : (GetGlobal('UserID') ? $title1 : $title2) ;
			?>
			</phpdac>
			</h3>
			
			<div class="woocommerce-shipping-fields">
			
				<phpdac>
				cmsrt.nvl use UserID++
				<?php
					$title1 = localize('_DELIVADDRESS', getlocal());
					$title2 = localize('_NOTES', getlocal());
					$placeholder = localize('_SXOLIA', getlocal());
					$sxolia = GetParam('sxolia');
					$addressway = GetParam('addressway') ? 'checked' : null;
					return _v('shcart.superfastcart') ? 
					"<h3 id=\"ship-to-different-address\"><label class=\"checkbox\" for=\"ship-to-different-address-checkbox\">$title1?</label>
					<input type=\"checkbox\" $addressway name=\"addressway\" class=\"input-checkbox\" id=\"ship-to-different-address-checkbox\"></h3>
					<p id=\"order_comments_field\" class=\"form-row form-row notes\"><label class=\"\" for=\"order_comments\">$title2</label><textarea cols=\"5\" rows=\"2\" placeholder=\"$placeholder\" id=\"order_comments\" class=\"input-text \" name=\"sxolia\">$sxolia</textarea></p>" :
						null;
				?>
				+
				</phpdac>	
				<!--hpdac>cmsrt.nvldac2 use UserID++cms.include_part:/qlogin-alt.php+</phpda-->	
				<phpdac>
				cmsrt.nvl use UserID++
				<?php
					$title1 = localize('_USRPLEASETEXT', getlocal());
					$title2 = localize('CMSLOGIN_DPC', getlocal());
					return "<a class=\"button\" href=\"signup/\">$title1</a><a class=\"button\" href=\"login/\">$title2</a>";
				?>
				+
				</phpdac>					

				<phpdac>
				cmsrt.nvl use UserID+
				<?php
					$addrs = _m("shcart.addressway2");
					return str_replace('<ADDR/>',$addrs,'<p><ADDR/></p>');
				?>
				++
				</phpdac>					

				<phpdac>
				cmsrt.nvl use UserID+
				<?php
				    $title = localize('_SELECTCUSTYPE', getlocal());
					$cus = _m("shcart.customerway2");
					return str_replace('<CUS/>',$cus,"<h3>$title</h3><p><CUS/></p>");
				?>
				++
				</phpdac>	

				<phpdac>
				cmsrt.nvl use UserID+
				<?php
					$title = localize('_SELECTINVTYPE', getlocal());
					$inv = _m("shcart.invoiceway2");
					return str_replace('<INV/>',$inv,"<h3>$title</h3><p><INV/></p>");
				?>
				++
				</phpdac>	

				<phpdac>
				cmsrt.nvl use UserID+
				<?php
					$title = localize('_NOTES', getlocal());
					$placeholder = localize('_SXOLIA', getlocal());
					return "<p id=\"order_comments_field\" class=\"form-row form-row notes\">
					<label class=\"\" for=\"order_comments\">$title</label>
					<textarea cols=\"5\" rows=\"2\" placeholder=\"$placeholder\" id=\"order_comments\" class=\"input-text \" name=\"sxolia\">$sxolia</textarea></p>";
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
		
			<phpdac>cmsrt.nvldac2 use shcart.superfastcart+shcart.payFast:1++</phpdac>
			
			<div class="form-row place-order">

			    <p class="form-row terms wc-terms-and-conditions">
					<!--input type="checkbox" id="terms" name="terms" class="input-checkbox">
			        <label class="checkbox" for="terms">I’ve read and accept the <a target="_blank" href="terms.php">terms &amp; conditions</a> <span class="required">*</span></label>
			        <input type="hidden" value="1" name="terms-field"-->
					
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

				<!--input type="submit" data-value="Place order" value="Place order" class="button alt"-->
				<phpdac>
					cmsrt.nvl use shcart.status+
					<?php
						$cancel = _v('shcart.testcart') ?
									'<input type="submit" class="button" name="FormAction" value="' . _v('shcart.cancel') . '">' :
									null;	
									
						if (_v('shcart.superfastcart'))	 
							$submit = 	'<input type="submit" class="button" name="FormAction" value="' . _v('shcart.submit') . '">';
						else						
							$submit = _v('shcart.fastcart') ? 
											(GetGlobal('UserID') ? 
												'<input type="submit" class="button" name="FormAction" value="' . _v('shcart.order') . '">':
												'<input type="button" onClick="javascript:guestreg(\'cart-checkout\');" class="button" name="guestregister" value="'. _v('shcart.checkout') .'">') :
											'<input type="submit" class="button" name="FormAction" value="' . _v('shcart.order') . '">';
																					
						return $cancel . $submit;
					?>
					++1
				</phpdac>
			</div>
		</div>
	</div>
</form>