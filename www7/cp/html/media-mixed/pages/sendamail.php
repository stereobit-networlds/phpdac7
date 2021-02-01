<!-- ========================================= MAIN ========================================= -->
<main id="contact-us" class="inner-bottom-md">
	<section class="google-map map-holder">
		<div id="map" class="map center"></div>
		<!--form role="form" class="get-direction">
			<div class="container">
				<div class="row">
					<div class="center-block col-lg-10">
						<div class="input-group">
							<input type="text" class="le-input input-lg form-control" placeholder="Enter Your Starting Point">
							<span class="input-group-btn">
								<button class="btn btn-lg le-button" type="button">Get Directions</button>
							</span>
						</div>
					</div>
				</div>
			</div>
		</form-->
	</section>

	<div class="container">
		<div class="row">
			
			<div class="col-md-8">
				<section class="section leave-a-message">
					<h2 class="bordered"><phpdac>i18nL.translate use contactform+RCCONTROLPANEL</phpdac></h2>
					<p><phpdac>cmsrt.nvldac2 use cmsform.msg+cmsrt.echostr:cmsform.msg++</phpdac></p>
                    <?XBODY?> 
				</section><!-- /.leave-a-message -->
			</div><!-- /.col -->

			<div class="col-md-4">
				<section class="our-store section inner-left-xs">
					<h2 class="bordered">We are here</h2>
					<address>
						<phpdac>cmsrt.paramload use INDEX+address</phpdac> <br/>
						+30 <phpdac>cmsrt.paramload use INDEX+tel1</phpdac> <br/>
						+30 <phpdac>cmsrt.paramload use INDEX+tel2</phpdac>
					</address>
					<!--h3>Ώρες λειτουργίας</h3>
				</section><!-- /.our-store -->
			</div><!-- /.col -->

		</div><!-- /.row -->
	</div><!-- /.container -->
</main>
<!-- ========================================= MAIN : END ========================================= -->