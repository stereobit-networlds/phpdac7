        <div clss='row'>    
			<div class='col-md-6'>
				<section class="section sign-in inner-right-xs">
			
					<h2 class="bordered">Facebook Connect</h2>
					<div class="field-row">	
						<span class="pull-right">
						<phpdac>cms.nvl use fbin+<a href="dologin/" class="le-button">Login</a>+<div class="fb-login-button" data-size="large" data-show-faces="false" data-auto-logout-link="true" scope="public_profile,email"></div>+</phpdac>
						</span>
					</div>				
				
					<h2 class="bordered"><phpdac>cmsrt.slocale use CMSLOGIN_DPC</phpdac></h2>
					<p>
						$0$ 
						<phpdac>cmsrt.slocale use _PLEASETEXT</phpdac>
					</p>

					<!--div class="social-auth-buttons">
						<div class="row">
							<div class="col-md-6">
								<button class="btn-block btn-lg btn btn-facebook"><i class="fa fa-facebook"></i> Sign In with Facebook</button>
							</div>
							<div class="col-md-6">
								<button class="btn-block btn-lg btn btn-twitter"><i class="fa fa-twitter"></i> Sign In with Twitter</button>
							</div>
						</div>
					</div-->

					<form role="form" class="login-form cf-style-1" method="post">
						<div class="field-row">
                            <label><phpdac>cmsrt.slocale use _PASSWORD</phpdac></label>
                            <input type="text" class="le-input" name="Username">
                        </div><!-- /.field-row -->

                        <div class="field-row">
                            <label><phpdac>cmsrt.slocale use _PASSWORD</phpdac></label>
                            <input type="password" class="le-input" name="Password">
                        </div><!-- /.field-row -->

                        <div class="field-row clearfix">
                        	<!--span class="pull-left">
                        		<label class="content-color"><input type="checkbox" name="savelogin" class="le-checbox auto-width inline"> <span class="bold">Remember me</span></label>
                        	</span-->
                        	<span class="pull-right">
                        		<a href="rempwd/" class="content-color bold"><phpdac>cmsrt.slocale use _PASSFORGOTTEN</phpdac></a>
                        	</span>
                        </div>

                        <div class="buttons-holder">
							<!--span class="pull-right" (mobile not clickable) -->
                            <button type="submit" class="le-button huge"><phpdac>cmsrt.slocale use CMSLOGIN_DPC</phpdac></button>
							<!--/span-->
							<input type="hidden" name="FormAction" value="dologin" />
							<input type="hidden" name="FormGoto" value="<phpdac>cms.baseURL</phpdac>" />							
                        </div><!-- /.buttons-holder -->
					</form><!-- /.cf-style-1 -->
				</section>	
			</div>		
			<div class='col-md-6'>
				<section class="section sign-in inner-left-xs">				

					<h1 class="bordered"><phpdac>cmsrt.slocale use _USERREGISTRATION</phpdac></h1>
					<p>
						<phpdac>cmsrt.slocale use _USRPLEASETEXT</phpdac>
					</p>
              
					<form role="form" class="register-form cf-style-1" method="get" action="signup/"> 
                        <div class="buttons-holder">
                            <button type="submit" class="le-button huge"><phpdac>cms.slocale use _SIGNUP</phpdac></button>
                        </div><!-- /.buttons-holder -->
					</form>


					<h2 class="semi-bold"><phpdac>cms.slocale use _USRPLEASETEXT</phpdac> :</h2>

					<phpdac>cms.include_part use /parts/empty-message.php+++media-center</phpdac>
					
				</section><!-- /.sign-in -->
			</div>
		</div>	