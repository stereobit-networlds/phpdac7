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
                    <?MEDIA-CENTER/INDEX?>
				</section><!-- /.leave-a-message -->
			</div><!-- /.col -->

			<div class="col-md-4">
				<section class="our-store section inner-left-xs">
					<h2 class="bordered">Το κατάστημα μας</h2>
					<address>
						<phpdac>rcserver.paramload use INDEX+address</phpdac> <br/>
						<phpdac>rcserver.paramload use INDEX+tel1</phpdac> <br/>
						<phpdac>rcserver.paramload use INDEX+tel2</phpdac>
					</address>
					<h3>Ώρες λειτουργίας</h3>
					<ul class="list-unstyled operation-hours">
						<li class="clearfix">
							<span class="day">Δευτέρα:</span>
							<span class="pull-right hours">9πμ-8μμ PM</span>
						</li>
						<li class="clearfix">
							<span class="day">Τρίτη:</span>
							<span class="pull-right hours">9πμ-8μμ PM</span>
						</li>
						<li class="clearfix">
							<span class="day">Τετάρτη:</span>
							<span class="pull-right hours">9πμ-5μμ PM</span>
						</li>
						<li class="clearfix">
							<span class="day">Πέμτη:</span>
							<span class="pull-right hours">9πμ-8μμ PM</span>
						</li>
						<li class="clearfix">
							<span class="day">Παρασκεύη:</span>
							<span class="pull-right hours">9πμ-8μμ PM</span>
						</li>
						<li class="clearfix">
							<span class="day">Σάββατο:</span>
							<span class="pull-right hours">9πμ-3μμ PM</span>
						</li>
						<li class="clearfix">
							<span class="day">Κυριακή</span>
							<span class="pull-right hours">Κλειστά</span>
						</li>
					</ul>
					<!--h3>Career</h3>
					<p>If you're interested in employment opportunities at MediaCenter, please contact us: <a href="contact.php"><phpdac>rcserver.paramload use INDEX+e-mail</phpdac></a></p-->
				</section><!-- /.our-store -->
			</div><!-- /.col -->

		</div><!-- /.row -->
	</div><!-- /.container -->
</main>
<!-- ========================================= MAIN : END ========================================= -->