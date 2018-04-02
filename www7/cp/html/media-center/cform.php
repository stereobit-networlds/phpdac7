					<form id="contact-form" class="contact-form cf-style-1 inner-top-xs" method="post" action="contact.php?t=sendamail">
                        <div class="row field-row">
                            <div class="col-xs-12 col-sm-6">
                                <label><phpdac>cmsrt.slocale use _name</phpdac>*</label>
                                <input class="le-input" name="cperson">
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <label><phpdac>cmsrt.slocale use _email</phpdac>*</label>
                                <input class="le-input" name="email">
                            </div>
                        </div><!-- /.field-row -->
                        
                        <div class="field-row">
                            <label><phpdac>cmsrt.slocale use _subject</phpdac>*</label>
                            <input type="text" class="le-input" name="subject">
                        </div><!-- /.field-row -->

                        <div class="field-row">
                            <label><phpdac>cmsrt.slocale use _message</phpdac>*</label>
                            <textarea rows="8" class="le-input" name="mail_text"></textarea>
                        </div><!-- /.field-row -->
						
						<div class="row field-row">
                            <div class="col-xs-12 col-sm-6">
                                <label>Captcha text*</label>
                                <input type="text" class="le-input" name="mycaptcha">
                            </div>
							<div class="col-xs-12 col-sm-6">
                                <img src="index.php?t=captchaimage" alt="captcha"/>
                            </div>							
                        </div><!-- /.field-row -->

                        <div class="buttons-holder">
							<span class="pull-right">
								<!-- @RECAPTCHA@ -->
								<button type="submit" class="le-button huge"><phpdac>cmsrt.slocale use _submit</phpdac></button>
							</span>
							<input type="hidden" name="FormAction" value="sendamail">
                        </div><!-- /.buttons-holder -->
                    </form><!-- /.contact-form -->  