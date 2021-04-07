										<form method="post" class="login">
											
											<p class="before-login-text">
												<phpdac>cms.slocale use _REGUSRPASSPOLICY2</phpdac>
												$0$
											</p>

											<p class="form-row form-row-wide">
												<label for="username"><phpdac>cmsrt.slocale use _EMAIL</phpdac>
												<span class="required">*</span></label>
												<input type="text" class="input-text" name="myemail" id="username" value="" />
											</p>

											<div class="form-group row">
											<div class="col-xs-12 col-md-6">
												<label><phpdac>cmsrt.slocale use _CAPTCHATITLE</phpdac>*</label><br />
												<span class="wpcf7-form-control-wrap first-name">
													<input type="text" name="mycaptcha" value="" size="10" class="wpcf7-form-control input-text" aria-required="true" aria-invalid="false" />
												</span>
											</div>

											<div class="col-xs-12 col-md-6">
												<img src="index.php?t=captchaimage" alt="captcha"/>
											</div>
											</div>


											<p class="form-row">
												<input class="button" type="submit" value="<phpdac>cmsrt.slocale use _ok</phpdac>" name="login">
											</p>

											<input type="hidden" name="FormAction" value="shremember" />
										</form>					
		