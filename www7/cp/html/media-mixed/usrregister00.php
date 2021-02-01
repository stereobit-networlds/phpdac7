            <div class="billing-address">
				<div class="row field-row">
                    <div id="create-account" class="col-xs-12">
						<!--hpdac>frontpage.getGlobal use sFormErr</phpda-->
                    </div>
                </div><!-- /.field-row -->				
			
                <h2 class="border h1"><phpdac>cmsrt.slocale use _REGUSRTITLE</phpdac></h2>
				<p><phpdac>cmsrt.slocale use _REGUSRWARNING</phpdac></p>
                <form method="post" action="signup/">
                    <div class="row field-row">
					    <div class="col-xs-12 col-sm-6">
                            <label><phpdac>cmsrt.slocale use _REGFULLTITLE</phpdac>*</label>
                            <input class="le-input" name="lname" value="<phpdac>cmsrt.nvldac2 use lname+cmsrt.echostr:lname++</phpdac>">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label><phpdac>cmsrt.slocale use _REGFULLNAME</phpdac>*</label>
                            <input class="le-input" name="fname" value="<phpdac>cmsrt.nvldac2 use fname+cmsrt.echostr:fname++</phpdac>">
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
                            <input  class="le-checkbox big" type="checkbox" name="autosub" />
                            <a class="simple-link bold" href="#"><phpdac>cmsrt.slocale use _REGUSRINFO01</phpdac></a>
                        </div>
                    </div><!-- /.field-row -->					

                    <div class="row field-row">
                        <div id="create-account" class="col-xs-12">
							<phpdac>cmsrt.slocale use _REGUSRWARN01</phpdac>
                        </div>
                    </div><!-- /.field-row -->
					
					<div class="buttons-holder">
						<span class="pull-right">
                        <button type="submit" class="le-button huge"><phpdac>frontpage.slocale use SHLOGIN_DPC</phpdac></button>
					    <input type="hidden" name="FormAction" value="insert" />
						<input type="hidden" name="invtype" value="0" />
					    </span>	
                    </div><!-- /.buttons-holder -->

                </form>
            </div><!-- /.billing-address -->
