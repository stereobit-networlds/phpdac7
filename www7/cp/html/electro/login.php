										<form method="post" class="login">

											<p class="before-login-text">
												$0$	
												<phpdac>cmsrt.slocale use _PLEASETEXT</phpdac>
											</p>

											<p class="form-row form-row-wide">
												<label for="username"><phpdac>cmsrt.slocale use _EMAIL</phpdac>
												<span class="required">*</span></label>
												<input type="text" class="input-text" name="Username" id="username" value="" />
											</p>

											<p class="form-row form-row-wide">
												<label for="password"><phpdac>cmsrt.slocale use _PASSWORD</phpdac>
												<span class="required">*</span></label>
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
