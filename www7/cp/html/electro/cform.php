								<div role="form" class="wpcf7">
									<div class="screen-reader-response"></div>
									<form id="contact-form" action="contact.php?t=sendamail" method="post" class="wpcf7-form">

										<div class="form-group row">
											<div class="col-xs-12 col-md-6">
												<label><phpdac>cmsrt.slocale use _name</phpdac>*</label><br />
												<span class="wpcf7-form-control-wrap first-name">
													<input type="text" name="cperson" value="" size="40" class="wpcf7-form-control input-text" aria-required="true" aria-invalid="false" />
												</span>
											</div>

											<div class="col-xs-12 col-md-6">
												<label><phpdac>cmsrt.slocale use _email</phpdac>*</label><br />
												<span class="wpcf7-form-control-wrap last-name">
													<input type="text" name="email" value="" size="40" class="wpcf7-form-control input-text" aria-required="true" aria-invalid="false" />
												</span>
											</div>
										</div>

										<div class="form-group">
											<label><phpdac>cmsrt.slocale use _subject</phpdac>*</label><br />
											<span class="wpcf7-form-control-wrap subject"><input type="text" name="subject" value="" size="40" class="wpcf7-form-control input-text" aria-invalid="false" /></span>
										</div>

										<div class="form-group">
											<label><phpdac>cmsrt.slocale use _message</phpdac>*</label><br />
											<span class="wpcf7-form-control-wrap your-message"><textarea name="mail_text" cols="40" rows="10" class="wpcf7-form-control input-text wpcf7-textarea" aria-invalid="false"></textarea></span>
										</div>
										
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

										<div class="form-group clearfix">
											<p><input type="submit" value="<phpdac>cmsrt.slocale use _submit</phpdac>" class="wpcf7-form-control wpcf7-submit" /></p>
										</div>
										<input type="hidden" name="FormAction" value="sendamail">
									</form>
								</div>					