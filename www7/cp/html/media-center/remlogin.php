                <section class="section sign-in inner-right-xs">
					<h2 class="bordered"><phpdac>cmsrt.slocale use _RESETPASS</phpdac></h2>
					<p>
						<phpdac>cms.slocale use _REGUSRPASSPOLICY2</phpdac>
						$0$
					</p>

					<form role="form" class="login-form cf-style-1" method="post">
						<div class="field-row">
                            <label><phpdac>cmsrt.slocale use _EMAIL</phpdac></label>
                            <input type="text" class="le-input" name="myemail">
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
                            <button type="submit" class="le-button huge"><phpdac>cmsrt.slocale use _ok</phpdac></button>
							</span>
                            <input type="hidden" name="FormAction" value="shremember" />						
                        </div><!-- /.buttons-holder -->
					</form><!-- /.cf-style-1 -->

				</section><!-- /.sign-in -->
		