                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cms.slocale use _FULLNAME</phpdac></label>
                            <input class="le-input" id="guestname" data-placeholder="ονοματεπώνυμο">
                        </div>	
                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cms.slocale use _ADDRESS</phpdac></label>
                            <input class="le-input" id="guestaddress" data-placeholder="οδός-αριθμός-πόλη">
                        </div>
						<div class="col-xs-12 col-sm-4">
                            <label><phpdac>cms.slocale use _PHONE</phpdac></label>
                            <input class="le-input" id="guestphone" data-placeholder="τηλέφωνο">
                        </div>						
                    </div><!-- /.field-row -->	
					
					<div class="row field-row">
                        <div class="col-xs-12 col-sm-4">
                            <label>e-Mail</label>
                            <input class="le-input" id="guestemail" data-placeholder="ηλ. ταχυδρομείο">
                        </div>					
                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cms.slocale use _POBOX</phpdac></label>
                            <input class="le-input" id="guestpostcode" data-placeholder="ταχυδρομικός κωδ.">
                        </div>						
                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cms.slocale use _AREA</phpdac></label>
                            <input class="le-input" id="guestcountry" data-placeholder="χώρα">
                        </div>					
					</div>

					<div class="widget cart-summary">		
						<span class="pull-right">				
						<input type="button" onClick="javascript:guestreg();" class="le-button" name="guestregister" value="<phpdac>cms.slocale use _REGISTER</phpdac>">
						</span>
					</div>