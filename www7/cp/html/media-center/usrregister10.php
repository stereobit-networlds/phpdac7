            <div class="billing-address">
				<div class="row field-row">
                    <div id="create-account" class="col-xs-12">
						<!--hpdac>frontpage.getGlobal use sFormErr</phpda-->
                    </div>
                </div><!-- /.field-row -->				
			
                <h2 class="border h1"><phpdac>cmsrt.slocale use _DOCTYPE</phpdac>: $30$</h2>
				<ul class="categories-filter animate-dropdown">
					<li class="dropdown">
						<a class="dropdown-toggle"  data-toggle="dropdown" href="#"><phpdac>cmsrt.slocale use _DOCTYPESELECT</phpdac></a>
						<ul class="dropdown-menu" role="menu" >
							<li role="presentation"><a role="menuitem" tabindex="-1" href="signup/0/"><phpdac>cmsrt.slocale use _DOCTYPERECEIPT</phpdac></a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="signup/1/"><phpdac>cmsrt.slocale use _DOCTYPEINVOICE</phpdac></a></li>							
						</ul>
					</li>
				</ul>	
				
                <h2 class="border h1"><phpdac>cmsrt.slocale use _REGUSRTITLE</phpdac></h2>				
				<p><phpdac>cmsrt.slocale use _REGUSRWARNING</phpdac></p>				
				
                <form method="post" action="signup/">
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-6">
                            <label><phpdac>cmsrt.slocale use _REGFULLTITLE</phpdac>*</label>
                            <input class="le-input" data-placeholder="<phpdac>cmsrt.slocale use _REGFULLNAME</phpdac>" name="lname" value="<phpdac>cmsrt.nvldac2 use lname+cmsrt.echostr:lname++</phpdac>">
                        </div>					
                        <div class="col-xs-12 col-sm-6">
                            <label><phpdac>cmsrt.slocale use _REGCONTACTNAME</phpdac>*</label>
                            <input class="le-input" data-placeholder="<phpdac>cmsrt.slocale use _REGFULLNAME</phpdac>" name="fname" value="<phpdac>cmsrt.nvldac2 use fname+cmsrt.echostr:fname++</phpdac>">
                        </div>
                    </div><!-- /.field-row -->

                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-6">
                            <label><phpdac>cmsrt.slocale use _ADDRESS</phpdac>*</label>
                            <input class="le-input" data-placeholder="<phpdac>cmsrt.slocale use _STREETNO</phpdac>" name="address" value="<phpdac>cmsrt.nvldac2 use address+cmsrt.echostr:address++</phpdac>">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>&nbsp;</label>
                            <input class="le-input" data-placeholder="<phpdac>cmsrt.slocale use _COUNTRYTOWN</phpdac>" name="area" value="<phpdac>cmsrt.nvldac2 use area+cmsrt.echostr:area++</phpdac>">
                        </div>
                    </div><!-- /.field-row -->

                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cmsrt.slocale use _POBOX</phpdac>*</label>
                            <input class="le-input"  name="zip" value="<phpdac>cmsrt.nvldac2 use zip+cmsrt.echostr:zip++</phpdac>">
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cmsrt.slocale use _PHONE</phpdac>*</label>
                            <input class="le-input" name="voice1" value="<phpdac>cmsrt.nvldac2 use voice1+cmsrt.echostr:voice1++</phpdac>">
                        </div>

                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cmsrt.slocale use _PHONEALT</phpdac></label>
                            <input class="le-input" name="voice2" value="<phpdac>cmsrt.nvldac2 use voice2+cmsrt.echostr:voice2++</phpdac>">
                        </div>
                    </div><!-- /.field-row -->
					
                    <div class="row field-row">
                        <div id="create-account" class="col-xs-12">
                            <phpdac>cmsrt.slocale use _REGUSRINFO02</phpdac>
                        </div>
                    </div><!-- /.field-row -->					

                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cmsrt.slocale use _EMAIL</phpdac> (<phpdac>cmsrt.slocale use _USERNAMETITLE</phpdac>)*</label>
                            <input class="le-input" name="uname" value="<phpdac>cmsrt.nvldac2 use uname+cmsrt.echostr:uname++</phpdac>">
                        </div>

                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cmsrt.slocale use _USERPASSTITLE</phpdac>*</label>
                            <input type="password" class="le-input" name="pwd">
                        </div>
						
                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cmsrt.slocale use _USERPASSTITLE1</phpdac>*</label>
                            <input type="password" class="le-input" name="pwd2">
                        </div>						
                    </div><!-- /.field-row -->
					
					<div class="row field-row">
                        <div id="create-account" class="col-xs-12">
                            <input  class="le-checkbox big" type="checkbox" name="autosub" checked />
                            <a class="simple-link bold" href="#"><phpdac>cmsrt.slocale use _REGUSRINFO01</phpdac></a>
                        </div>
                    </div><!-- /.field-row -->

					<h2 class="border h1"><phpdac>cmsrt.slocale use _REGUSRDELIVADDRESS</phpdac></h2>
					<p><phpdac>cmsrt.slocale use _REGUSRWARN02</phpdac></p>					
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-4">
                            <label>&nbsp;</label>
                            <input class="le-input" data-placeholder="<phpdac>cmsrt.slocale use _STREETNO</phpdac>" name="address_d" value="<phpdac>cmsrt.nvldac2 use address_d+cmsrt.echostr:address_d++</phpdac>">
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label>&nbsp;</label>
                            <input class="le-input" data-placeholder="<phpdac>cmsrt.slocale use _COUNTRYTOWN</phpdac>" name="area_d" value="<phpdac>cmsrt.nvldac2 use area_d+cmsrt.echostr:area_d++</phpdac>">
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label>&nbsp;</label>
                            <input class="le-input" data-placeholder="<phpdac>cmsrt.slocale use _POBOX</phpdac>"name="zip_d" value="<phpdac>cmsrt.nvldac2 use zip_d+cmsrt.echostr:zip_d++</phpdac>">
                        </div>
                    </div><!-- /.field-row -->						

                    <div class="row field-row">
                        <div id="create-account" class="col-xs-12">
							<phpdac>cmsrt.slocale use _REGUSRWARN01</phpdac>
                        </div>
                    </div><!-- /.field-row -->
					
					<div class="buttons-holder">
						<span class="pull-right">
                        <button type="submit" class="le-button huge"><phpdac>cmsrt.slocale use _SUBMIT</phpdac></button>
					    <input type="hidden" name="FormAction" value="insert" />
						<input type="hidden" name="invtype" value="0" />
						</span>
                    </div><!-- /.buttons-holder -->

                </form>
            </div><!-- /.billing-address -->