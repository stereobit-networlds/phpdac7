										<h3 class="bordered"><phpdac>cmsrt.slocale use CMSLOGIN_DPC</phpdac></h3>
										<form method="post" class="login">
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
													<a class="button" href="signup/"><phpdac>cms.slocale use _SIGNUP</phpdac></a>
												</label>
											</p>

											<input type="hidden" name="FormAction" value="dologin" />
											<input type="hidden" name="FormGoto" value="<phpdac>cmsrt.baseURL</phpdac>" />
										</form>