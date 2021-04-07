<div id="content" class="site-content" tabindex="-1">
	<div class="container">

		<nav class="woocommerce-breadcrumb" >
			<a href="index.php"><phpdac>cms.slocale use _HOME</phpdac></a>
			<span class="delimiter"><i class="fa fa-angle-right"></i></span>
			<phpdac>cms.slocale use SHLOGIN_DPC</phpdac>
		</nav><!-- .woocommerce-breadcrumb -->

		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<article id="post-8" class="hentry">

					<div class="entry-content">
						<div class="woocommerce">
							<div class="customer-login-form">
								<span class="or-text">-</span>

								<div class="col2-set" id="customer_login">

									<div class="col-1">

										<h2 class="bordered"><phpdac>cmsrt.slocale use CMSLOGIN_DPC</phpdac></h2>
										<?XBODY?>

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

				</article><!-- #post-## -->

			</main><!-- #main -->
		</div><!-- #primary -->


	</div><!-- .col-full -->
</div><!-- #content -->
