					<div class="entry-content">
						<div class="woocommerce">
							<div class="customer-login-form">
								<span class="or-text">or</span>

								<div class="col2-set" id="customer_login">

									<div class="col-1">

										<h2 class="bordered"><phpdac>cmsrt.slocale use CMSLOGIN_DPC</phpdac></h2>
										<form method="post" class="login">

											<p class="before-login-text">
												$0$	
												<phpdac>cmsrt.slocale use _PLEASETEXT</phpdac>
											</p>

											<p class="form-row form-row-wide">
												<label for="username"><phpdac>cmsrt.slocale use _EMAIL</phpdac></label>
												<input type="text" class="input-text" name="Username" id="username" value="" />
											</p>

											<p class="form-row form-row-wide">
												<label for="password"><phpdac>cmsrt.slocale use _PASSWORD</phpdac></label>
												<input class="input-text" type="password" name="Password" id="password" />
											</p>


											<p class="form-row">
												<input class="button" type="submit" value="<phpdac>cmsrt.slocale use CMSLOGIN_DPC</phpdac>" name="login">
												<label for="rememberme" class="inline">
													<!--input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember me -->
													<a href="rempwd/"><phpdac>cmsrt.slocale use _PASSFORGOTTEN</phpdac></a>
												</label>
											</p>

											<!--p class="lost_password">
												<a href="rempwd/"><phpdac>cmsrt.slocale use _PASSFORGOTTEN</phpdac></a>
											</p-->
											<input type="hidden" name="FormAction" value="dologin" />
											<input type="hidden" name="FormGoto" value="<phpdac>cmsrt.baseURL</phpdac>" />
										</form>

									</div><!-- .col-1 -->

									<div class="col-2">

										<h2><phpdac>cms.slocale use _USERREGISTRATION</phpdac></h2>

										<form method="get" class="register" action="signup/">

											<p class="before-register-text">
												<phpdac>cms.slocale use _USRPLEASETEXT</phpdac>
											</p>


											<!--p class="form-row form-row-wide">
												<label for="reg_email">Email address
												<span class="required">*</span></label>
												<input type="email" class="input-text" name="email" id="reg_email" value="" />
											</p-->


											<p class="form-row">
												<input type="submit" class="button" name="register" value="<phpdac>cms.slocale use _SIGNUP</phpdac>" />
											</p>

											<div class="register-benefits">
												<phpdac>cmsrt.include_part use /empty-message.php</phpdac>
											</div>

										</form>

									</div><!-- .col-2 -->

								</div><!-- .col2-set -->

							</div><!-- /.customer-login-form -->
						</div><!-- .woocommerce -->
					</div><!-- .entry-content -->