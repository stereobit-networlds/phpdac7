	<div id="customer_details" class="col2-set">
		<div class="col-1">
			<div class="woocommerce-billing-fields">		

				<h3><phpdac>cmsrt.slocale use _REGUSRTITLE</phpdac></h3>
				
				<form method="post"> <!--action="gdprtools.php"-->
				
					<p id="billing_first_name_field" class="form-row form-row form-row-first validate-required"><label class="" for="billing_first_name"><phpdac>cmsrt.slocale use _REGFULLNAME</phpdac> </label><input type="text" value="$14$" placeholder="" id="billing_first_name" name="fname" class="input-text "></p>

					<p id="billing_last_name_field" class="form-row form-row form-row-last validate-required"><label class="" for="billing_last_name"><phpdac>cmsrt.slocale use _REGFULLTITLE</phpdac> </label><input type="text" value="$15$" placeholder="" id="billing_last_name" name="lname" class="input-text "></p><div class="clear"></div>				
				
					<!--p id="billing_city_field" class="form-row form-row form-row-wide address-field validate-required" data-o_class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_city"><phpdac>cmsrt.slocale use _COUNTRY</phpdac></label>
					$7$
					</p>	
					<p id="billing_city_field" class="form-row form-row form-row-wide address-field validate-required" data-o_class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_city"><phpdac>cmsrt.slocale use _LANGUAGE</phpdac></label>
					$8$
					</p>
					<p id="billing_city_field" class="form-row form-row form-row-wide address-field validate-required" data-o_class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_city"><phpdac>cmsrt.slocale use _AGE</phpdac></label>
					$9$
					</p>				
					<p id="billing_city_field" class="form-row form-row form-row-wide address-field validate-required" data-o_class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_city"><phpdac>cmsrt.slocale use _GENDER</phpdac></label>
					$10$
					</p>
					<p id="billing_city_field" class="form-row form-row form-row-wide address-field validate-required" data-o_class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_city"><phpdac>cmsrt.slocale use _TIMEZONE</phpdac></label>
					$11$
					</p-->
					<div class="clear"></div>

					<phpdac>cms.getGlobal use sFormErr</phpdac>
					<button type="submit" class="button"><phpdac>cms.slocale use _UPDATE</phpdac></button>
					<input type="hidden" name="FormAction" value="updgdpr" />
				
				</form>	
			</div>
		</div>

		<div class="col-2">
			<h3><phpdac>cmsrt.slocale use _ULISTS</phpdac></h3>
				
			<form method="post">
                <input  class="le-checkbox big" type="checkbox" name="autosub" $16$/>
                <a class="simple-link bold" href="#"><phpdac>cmsrt.slocale use _REGUSRINFO01</phpdac></a>

                <button type="submit" class="le-button huge"><phpdac>cms.slocale use _UPDATE</phpdac></button>
				<input type="hidden" name="FormAction" value="subgdpr" />
			</form>	


			<h3><phpdac>cmsrt.slocale use _GDPRGET</phpdac></h3>
				
			<form method="post">
                <button type="submit" class="le-button huge"><phpdac>cms.slocale use _GETDATA</phpdac></button>
				<input type="hidden" name="FormAction" value="gdprget" />				
			</form>	

			<h3><phpdac>cmsrt.slocale use _UDELETE</phpdac></h3>

			<form method="post">
			<a onclick="new jQuery.Zebra_Dialog('<phpdac>cmsrt.slocale use _userdeletefinalquestion</phpdac> <form method=\'post\'><button type=\'submit\' class=\'button\'><phpdac>cms.slocale use _DELETE</phpdac></button><input type=\'hidden\' name=\'FormAction\' value=\'gdprdel\'></form>', {
		'type':     'question',
		'title':    '<phpdac>cmsrt.slocale use _userdelete</phpdac>',
		'buttons':  [{caption: '<phpdac>cmsrt.slocale use _CANCEL</phpdac>', callback: function() { /*alert('Cancel was clicked')*/}}]
	});" class="button"><phpdac>cms.slocale use _DELETE</phpdac></a>
					
			</form>	
			
		</div>
	</div>
	
	<!--h3 id="order_review_heading"><phpdac>cmsrt.slocale use _CART</phpdac></h3>

	<div class="woocommerce-checkout-review-order" id="order_review">
		<table class="shop_table woocommerce-checkout-review-order-table">
			<thead>
				<tr>
					<th class="product-name"><phpdac>cmsrt.slocale use _item</phpdac></th>
					<th class="product-total"><phpdac>cmsrt.slocale use _TOTAL</phpdac></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
			</tfoot>
			
		</table>

		<div class="woocommerce-checkout-payment" id="payment">
			<div class="form-row place-order">
				<input type="submit" data-value="Place order" value="Place order" class="button alt">
			</div>
		</div>
	</div-->
</form>			