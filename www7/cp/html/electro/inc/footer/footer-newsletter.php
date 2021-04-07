<div class="footer-newsletter">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-7">
				<h5 class="newsletter-title">Sign up to Newsletter</h5>
				<!--span class="newsletter-marketing-text">...and receive <strong>$20 coupon for first shopping</strong></span-->
			</div>
			<div class="col-xs-12 col-sm-5">
				<form  method="post" action="subscribe/">
					<div class="input-group">
						<input name="submail" type="text" class="form-control" placeholder="<phpdac>cms.slocale use _MSG2</phpdac>">
						<span class="input-group-btn">
							<!--button class="btn btn-secondary" type="button"><phpdac>cms.slocale use _SUBSCR</phpdac></button-->
							<a href="subscribe/" class="btn btn-secondary" type="button" onclick="this.form.submit();"><phpdac>cms.slocale use _SUBSCR</phpdac></a>
						</span>
					</div>
					<input type="hidden" name="t" value="subscribe" />
				</form>
			</div>
		</div>
	</div>
</div>