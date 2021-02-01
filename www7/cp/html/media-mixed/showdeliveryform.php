			<div class="billing-address">

				<h1 class="border"><phpdac>cms.slocale use _DELIVERYWAYADD</phpdac></h1>
				<br/>
				$0$
				
				<form method="post" action="savenewdeliv/">
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cms.slocale use _ADDRESS</phpdac></label>
                            <input class="le-input" data-placeholder="<phpdac>cms.slocale use _STREETNO</phpdac>" name="address_d" value="$1$">
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cms.slocale use _AREA</phpdac></label>
                            <input class="le-input" data-placeholder="<phpdac>cms.slocale use _TOWN</phpdac>" name="area_d" value="$2$">
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cms.slocale use _POBOX</phpdac></label>
                            <input class="le-input" data-placeholder="" name="zip_d" value="$3$">
                        </div>
                    </div><!-- /.field-row -->

                    <div class="row field-row">	
					    <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cms.slocale use _COUNTRY</phpdac></label>
                            <input class="le-input" name="country_d" value="$4$">
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cms.slocale use _PHONE</phpdac> 1</label>
                            <input class="le-input" name="voice1_d" value="$5$">
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cms.slocale use _PHONE</phpdac> 2</label>
                            <input class="le-input" name="voice2_d" value="$6$">
                        </div>
                    </div><!-- /.field-row -->	

                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-6">
                            <label><phpdac>cms.slocale use _EMAIL</phpdac></label>
                            <input class="le-input" name="mail_d" value="$8$">
                        </div>					
                        <div class="col-xs-12 col-sm-6">
                            <label><phpdac>cms.slocale use _PHONEALT</phpdac></label>
                            <input class="le-input" name="fax_d" value="$7$">
                        </div>
                    </div><!-- /.field-row -->						

					<div class="buttons-holder">
					<span class="pull-right">
                        <button type="submit" class="le-button huge"><phpdac>cms.slocale use _REGISTER</phpdac></button>
					    <input type="hidden" name="FormAction" value="savenewdeliv" />
					</span>	
                    </div><!-- /.buttons-holder -->

                </form>
            </div><!-- /.billing-address -->