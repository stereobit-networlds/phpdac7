        <p id="billing_company_field" class="form-row form-row form-row-wide validate-required"><label class="" for="billing_company"><phpdac>cmsrt.slocale use _FULLNAME</phpdac></label><abbr title="required" class="required">*</abbr></label><input type="text" value="<phpdac>cms.phpcode use <?php return GetParam('guestname')?></phpdac>" placeholder="" id="guestname" name="guestname" class="input-text "></p>           
		 
		<p id="billing_address_1_field" class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_address_1"><phpdac>cmsrt.slocale use _ADDRESS</phpdac> <abbr title="required" class="required">*</abbr></label><input type="text" value="<phpdac>cms.phpcode use <?php return GetParam('guestaddress')?></phpdac>" placeholder="<phpdac>cms.slocale use _STREETNO</phpdac>" id="guestaddress" name="guestaddress" class="input-text "></p>

		<p id="billing_address_2_field" class="form-row form-row form-row-wide address-field"><input type="text" value="<phpdac>cms.phpcode use <?php return GetParam('guestcountry')?></phpdac>" placeholder="<phpdac>cmsrt.slocale use _AREA</phpdac>" id="guestcountry" name="guestcountry" class="input-text "></p>		 
		
		<p id="billing_postcode_field" class="form-row form-row form-row-first address-field validate-postcode validate-required" data-o_class="form-row form-row form-row-last address-field validate-required validate-postcode"><label class="" for="billing_postcode"><phpdac>cmsrt.slocale use _POBOX</phpdac></label> <abbr title="required" class="required">*</abbr></label><input type="text" value="<phpdac>cms.phpcode use <?php return GetParam('guestpostcode')?></phpdac>" placeholder="" id="guestpostcode" name="guestpostcode" class="input-text ">
				
		<p id="billing_phone_field" class="form-row form-row form-row-last validate-required validate-phone"><label class="" for="billing_phone"><phpdac>cmsrt.slocale use _PHONE</phpdac> <abbr title="required" class="required">*</abbr></label><input type="tel" value="<phpdac>cms.phpcode use <?php return GetParam('guestphone')?></phpdac>" placeholder="" id="guestphone" name="guestphone" class="input-text "></p></p><div class="clear"></div>

		<p id="billing_email_field" class="form-row form-row form-row-wide validate-required validate-email"><label class="" for="billing_email"><phpdac>cmsrt.slocale use _EMAIL</phpdac> <abbr title="required" class="required">*</abbr></label><input type="email" value="<phpdac>cms.phpcode use <?php return GetParam('guestemail')?></phpdac>" placeholder="" id="guestemail" name="guestemail" class="input-text "></p>
		
		<div class="clear"></div>
					
		<!--input type="button" onClick="javascript:guestreg('cart-order');" class="button" name="guestregister" value="<-hpdac>cms.phpcode use <-hp return _v('shcart.order')-></phpda->"-->
		
		<p class="form-row form-row-wide create-account"><input type="checkbox" value="1" checked="checked" name="createaccount" id="createaccount" class="input-checkbox"> <label class="checkbox" for="createaccount"><phpdac>cmsrt.slocale use _CREATEACCOUNTOPTION</phpdac>?</label></p>