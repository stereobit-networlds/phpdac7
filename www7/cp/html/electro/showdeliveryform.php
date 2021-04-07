<form method="post" action="savenewdeliv/">
	<div id="customer_details" class="col2-set">
	
		<div class="col-1">
			<div class="woocommerce-billing-fields">	

				<h3><phpdac>cms.slocale use _DELIVERYWAYADD</phpdac></h3>			

				<p id="billing_address_1_field" class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_address_1"><phpdac>cmsrt.slocale use _ADDRESS</phpdac> <abbr title="required" class="required">*</abbr></label><input type="text" value="$1$" placeholder="<phpdac>cms.slocale use _STREETNO</phpdac>" id="billing_address_1" name="address_d" class="input-text "></p>

				<p id="billing_address_2_field" class="form-row form-row form-row-wide address-field"><input type="text" value="$2$" placeholder="<phpdac>cmsrt.slocale use _AREA</phpdac>" id="billing_address_2" name="area_d" class="input-text "></p>

				<p id="billing_state_field" class="form-row form-row form-row-first validate-required validate-email"><label class="" for="billing_state"><phpdac>cmsrt.slocale use _COUNTRY</phpdac> <abbr title="required" class="required">*</abbr></label><input type="text" value="$4$" placeholder="" id="billing_state" name="country_d" class="input-text "></p>

				<p id="billing_postcode_field" class="form-row form-row form-row-last address-field validate-postcode validate-required" data-o_class="form-row form-row form-row-last address-field validate-required validate-postcode"><label class="" for="billing_postcode"><phpdac>cmsrt.slocale use _POBOX</phpdac></label> <abbr title="required" class="required">*</abbr></label><input type="text" value="$3$" placeholder="" id="billing_postcode" name="zip_d" class="input-text "></p>
				
				<p id="billing_phone1_field" class="form-row form-row form-row-first validate-required validate-phone"><label class="" for="billing_phone"><phpdac>cmsrt.slocale use _PHONE</phpdac> 1 <abbr title="required" class="required">*</abbr></label><input type="tel" value="$5$" placeholder="" id="billing_phone1" name="voice1_d" class="input-text "></p>

				<p id="billing_phone2_field" class="form-row form-row form-row-last validate-required validate-phone"><label class="" for="billing_phone"><phpdac>cmsrt.slocale use _PHONE</phpdac> 2 <abbr title="required" class="required">*</abbr></label><input type="tel" value="$6$" placeholder="" id="billing_phone2" name="voice2_d" class="input-text "></p><div class="clear"></div>
								
				<p id="billing_email_field" class="form-row form-row form-row-first validate-required validate-email"><label class="" for="billing_email"><phpdac>cmsrt.slocale use _EMAIL</phpdac> <abbr title="required" class="required">*</abbr></label><input type="email" value="$8$" placeholder="" id="billing_email" name="mail" class="input-text "></p>

				<p id="billing_phone3_field" class="form-row form-row form-row-last validate-required validate-phone"><label class="" for="billing_phone"><phpdac>cmsrt.slocale use _PHONEALT</phpdac> <abbr title="required" class="required">*</abbr></label><input type="tel" value="$7$" placeholder="" id="billing_phone_alt" name="fax_d" class="input-text "></p><div class="clear"></div>

				<div class="clear"></div>

			</div>
		</div>
		<div class="col-2">
		
			<div class="woocommerce-shipping-fields">
			
				$0$
				
                <button type="submit" class="button"><phpdac>cms.slocale use _REGISTER</phpdac></button>
				<input type="hidden" name="FormAction" value="savenewdeliv" />			
			
			</div>	
		</div>	
	</div>			
</form>