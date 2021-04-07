
				<h3><phpdac>cmsrt.slocale use _REGUSRTITLE</phpdac></h3>
				
				<form method="post"> <!--action="gdprtools.php"-->
				
					<p id="billing_first_name_field" class="form-row form-row form-row-first validate-required"><label class="" for="billing_first_name"><phpdac>cmsrt.slocale use _REGFULLNAME</phpdac> </label><input type="text" value="$14$" placeholder="" id="billing_first_name" name="fname" class="input-text "></p>

					<p id="billing_last_name_field" class="form-row form-row form-row-last validate-required"><label class="" for="billing_last_name"><phpdac>cmsrt.slocale use _REGCONTACTNAME</phpdac> </label><input type="text" value="$15$" placeholder="" id="billing_last_name" name="lname" class="input-text "></p><div class="clear"></div>				
				
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
					
					<p>
						<input  class="le-checkbox big" type="checkbox" name="autosub" value="$16$"/>
                        <a class="simple-link bold" href="#"><phpdac>cmsrt.slocale use _REGUSRINFO01</phpdac></a>
					</p>

					<phpdac>cms.getGlobal use sFormErr</phpdac>
					<button type="submit" class="button"><phpdac>cms.slocale use _UPDATE</phpdac></button>
					<input type="hidden" name="FormAction" value="update" />
				
				</form>			
