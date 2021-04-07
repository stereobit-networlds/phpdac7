				<!--h3><phpdac>cmsrt.slocale use _DOCTYPE</phpdac>: $33$</h3>
				<ul class="categories-filter animate-dropdown">
					<li class="dropdown">
						<a class="dropdown-toggle"  data-toggle="dropdown" href="#"><phpdac>cmsrt.slocale use _DOCTYPESELECT</phpdac></a>
						<ul class="dropdown-menu" role="menu" >
							<li role="presentation"><a role="menuitem" tabindex="-1" href="signup/0/"><phpdac>cmsrt.slocale use _DOCTYPERECEIPT</phpdac></a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="signup/1/"><phpdac>cmsrt.slocale use _DOCTYPEINVOICE</phpdac></a></li>
						</ul>
					</li>
				</ul-->			
			
				<form method="post" action="signup/">			
				
				<h3><phpdac>cmsrt.slocale use _REGUSRTITLE</phpdac></h3>
	
				<p><phpdac>cmsrt.slocale use _REGUSRWARNING</phpdac></p>				

				<p id="billing_company_field" class="form-row form-row form-row-first validate-required"><label class="" for="billing_company"><phpdac>cmsrt.slocale use _REGFULLTITLE</phpdac> </label><abbr title="required" class="required">*</abbr></label><input type="text" value="<phpdac>cmsrt.nvldac2 use lname+cmsrt.echostr:lname++</phpdac>" placeholder="" id="billing_company" name="fname" class="input-text "></p>
				
				<p id="billing_company_field" class="form-row form-row form-row-last validate-required"><label class="" for="billing_company"><phpdac>cmsrt.slocale use _REGFULLNAME</phpdac></phpdac> </label><abbr title="required" class="required">*</abbr></label><input type="text" value="<phpdac>cmsrt.nvldac2 use fname+cmsrt.echostr:fname++</phpdac>" placeholder="" id="billing_company" name="lname" class="input-text "></p><div class="clear"></div>
				
				<!--p id="billing_first_name_field" class="form-row form-row form-row-first validate-required"><label class="" for="billing_first_name"><phpdac>cmsrt.slocale use _REGUSRVAT</phpdac> </label><input type="text" value="<phpdac>cmsrt.nvldac2 use afm+cmsrt.echostr:afm++</phpdac>" placeholder="" id="billing_first_name" name="afm" class="input-text "></p>

				<p id="billing_last_name_field" class="form-row form-row form-row-last validate-required"><label class="" for="billing_last_name"><phpdac>cmsrt.slocale use _REGUSRVATDETAILS</phpdac> </label><input type="text" value="<phpdac>cmsrt.nvldac2 use eforia+cmsrt.echostr:eforia++</phpdac>" placeholder="" id="billing_last_name" name="eforia" class="input-text "></p>				
				
				<p id="billing_city_field" class="form-row form-row form-row-wide address-field validate-required" data-o_class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_city"><phpdac>cmsrt.slocale use _REGUSRBUSINESS</phpdac></label><input type="text" value="<phpdac>cmsrt.nvldac2 use prfdescr+cmsrt.echostr:prfdescr++</phpdac>" placeholder="" id="billing_city" name="prfdescr" class="input-text "></p>			

				<p id="billing_address_1_field" class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_address_1"><phpdac>cmsrt.slocale use _ADDRESS</phpdac> <abbr title="required" class="required">*</abbr></label><input type="text" value="<phpdac>cmsrt.nvldac2 use address+cmsrt.echostr:address++</phpdac>" placeholder="<phpdac>cms.slocale use _STREETNO</phpdac>" id="billing_address_1" name="address" class="input-text "></p>

				<p id="billing_address_2_field" class="form-row form-row form-row-wide address-field"><input type="text" value="<phpdac>cmsrt.nvldac2 use area+cmsrt.echostr:area++</phpdac>" placeholder="<phpdac>cmsrt.slocale use _AREA</phpdac>" id="billing_address_2" name="area" class="input-text "></p>
				
				<p id="billing_postcode_field" class="form-row form-row form-row-first address-field validate-postcode validate-required" data-o_class="form-row form-row form-row-last address-field validate-required validate-postcode"><label class="" for="billing_postcode"><phpdac>cmsrt.slocale use _POBOX</phpdac></label> <abbr title="required" class="required">*</abbr></label><input type="text" value="<phpdac>cmsrt.nvldac2 use zip+cmsrt.echostr:zip++</phpdac>" placeholder="" id="billing_postcode" name="zip" class="input-text "></p>

				<p id="billing_phone_field" class="form-row form-row form-row-last validate-required validate-phone"><label class="" for="billing_phone"><phpdac>cmsrt.slocale use _PHONE</phpdac> <abbr title="required" class="required">*</abbr></label><input type="tel" value="<phpdac>cmsrt.nvldac2 use voice1+cmsrt.echostr:voice1++</phpdac>" placeholder="" id="billing_phone" name="voice1" class="input-text "></p><div class="clear"></div>

				<p id="billing_state_field" class="form-row form-row form-row-first validate-required validate-phone"><label class="" for="billing_state"><phpdac>cmsrt.slocale use _PHONEALT</phpdac> <abbr title="required" class="required">*</abbr></label><input type="text" value="<phpdac>cmsrt.nvldac2 use fax+cmsrt.echostr:fax++</phpdac>" placeholder="" id="billing_state" name="fax" class="input-text "></p-->

				<p id="billing_email_field" class="form-row form-row form-row-wide validate-required validate-email"><label class="" for="billing_email"><phpdac>cmsrt.slocale use _EMAIL</phpdac> (<phpdac>cmsrt.slocale use _USERNAMETITLE</phpdac>) <abbr title="required" class="required">*</abbr></label><input type="email" value="<phpdac>cmsrt.nvldac2 use uname+cmsrt.echostr:uname++</phpdac>" placeholder="" id="billing_email" name="uname" class="input-text "></p>
				
				<p>	
					<phpdac>cmsrt.slocale use _REGUSRINFO02</phpdac>
				</p>
				
				<p id="billing_phone_field" class="form-row form-row form-row-first validate-required"><label class="" for="billing_phone"><phpdac>cmsrt.slocale use _USERPASSTITLE</phpdac> <abbr title="required" class="required">*</abbr></label><input type="password" value="" placeholder="" id="billing_phone" name="pwd" class="input-text "></p>

				<p id="billing_phone_field" class="form-row form-row form-row-last validate-required"><label class="" for="billing_phone"><phpdac>cmsrt.slocale use _USERPASSTITLE1</phpdac> <abbr title="required" class="required">*</abbr></label><input type="password" value="" placeholder="" id="billing_phone" name="pwd1" class="input-text "></p><div class="clear"></div>
				
				<p>
					<input  class="le-checkbox big" type="checkbox" name="autosub" value="1" />
                    <a class="simple-link bold" href="#"><phpdac>cmsrt.slocale use _REGUSRINFO01</phpdac></a>
				</p>
				
				<p>
					<phpdac>cmsrt.slocale use _REGUSRWARN01</phpdac>
				</p>
				
				<button type="submit" class="button"><phpdac>cmsrt.slocale use SHLOGIN_DPC</phpdac></button>
				
				<input type="hidden" name="FormAction" value="insert" />
				<input type="hidden" name="invtype" value="0" />
				</form>