			<form method="post" class="login">
											
				<h3><phpdac>cms.slocale use _RESETPASS</phpdac></h3>
				<p>
					<phpdac>cms.slocale use _PLEASETEXT</phpdac> 
					<b>(<phpdac>cms.slocale use _REGUSRPASSPOLICY</phpdac>).</b>
					<br/>
					$0$ 
				</p>

				<p class="form-row form-row-wide">
					<label for="username"><phpdac>cms.slocale use _USERPASSTITLE2</phpdac>
					<span class="required">*</span></label>
						<input type="password" class="input-text" name="Password" id="username" value="" />
				</p>
				<p class="form-row form-row-wide">
					<label for="username"><phpdac>cms.slocale use _USERPASSTITLE1</phpdac>
					<span class="required">*</span></label>
						<input type="password" class="input-text" name="vPassword" id="username" value="" />
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
					<input class="button" type="submit" value="<phpdac>cms.slocale use _RESETPASS</phpdac>" name="login">
				</p>

				<input type="hidden" name="FormAction" value="chpass" />
				<input type="hidden" name="sectoken" value="$2$" />	
			</form>	