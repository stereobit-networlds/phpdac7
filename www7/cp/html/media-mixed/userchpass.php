                <section class="section sign-in inner-right-xs">
					<h2 class="bordered"><phpdac>cms.slocale use _RESETPASS</phpdac></h2>
					<p>
						<phpdac>cms.slocale use _PLEASETEXT</phpdac> 
						<b>(<phpdac>cms.slocale use _REGUSRPASSPOLICY</phpdac>).</b>
						<br/>
						$0$ 
					</p>

					<form role="form" class="login-form cf-style-1" method="post">
						<div class="field-row">
                            <label><phpdac>cms.slocale use _USERPASSTITLE2</phpdac></label>
                            <input type="password" class="le-input" name="Password">
                        </div><!-- /.field-row -->

                        <div class="field-row">
                            <label><phpdac>cms.slocale use _USERPASSTITLE1</phpdac></label>
                            <input type="password" class="le-input" name="vPassword">
                        </div><!-- /.field-row -->
						
						<!-- $1$ -->
						<div class="row field-row">
                            <div class="col-xs-12 col-sm-6">
                                <label><phpdac>cmsrt.slocale use _CAPTCHATITLE</phpdac></label>
                                <input type="text" class="le-input" name="mycaptcha">
                            </div>
							<div class="col-xs-12 col-sm-6">
                                <img src="index.php?t=captchaimage" alt="captcha"/>
                            </div>							
                        </div><!-- /.field-row -->

                        <div class="buttons-holder">
							<span class="pull-right">
                            <button type="submit" class="le-button huge"><phpdac>cms.slocale use _RESETPASS</phpdac></button>
							</span>
							<input type="hidden" name="FormAction" value="chpass" />
							<input type="hidden" name="sectoken" value="$2$" />						
                        </div><!-- /.buttons-holder -->
					</form><!-- /.cf-style-1 -->

				</section><!-- /.sign-in -->
