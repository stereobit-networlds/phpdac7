			<div class="billing-address">
                <h2 class="border h1"><phpdac>cmsrt.slocale use _REGUSRTITLE</phpdac></h2>
				<!--hpdac>cms.nvl use fbhash+<button onclick="fbfetch()" class="le-button">Facebook</button>++</phpda-->
				
                <form method="post"> <!--action="gdprtools.php"--> 
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-6">
                            <label><phpdac>cmsrt.slocale use _REGFULLNAME</phpdac>*</label>
                            <input class="le-input" name="fname" id="fname" value="$14$">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label><phpdac>cmsrt.slocale use _REGFULLTITLE</phpdac>*</label>
                            <input class="le-input" name="lname" id="lname" value="$15$">
                        </div>
                    </div><!-- /.field-row -->					

                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cmsrt.slocale use _COUNTRY</phpdac></label>
							$7$
                        </div>

                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cmsrt.slocale use _LANGUAGE</phpdac></label>
							$8$
                        </div>
						
                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cmsrt.slocale use _AGE</phpdac></label>
							$9$
                        </div>						
                    </div><!-- /.field-row -->
					
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cmsrt.slocale use _GENDER</phpdac></label>
							$10$
                        </div>

                        <div class="col-xs-12 col-sm-4">
                            <label><phpdac>cmsrt.slocale use _TIMEZONE</phpdac></label>
							$11$
                        </div>
												
                    </div><!-- /.field-row -->					
					
					<!--div class="row field-row">
                        <div id="create-account" class="col-xs-12">
                            <input  class="le-checkbox big" type="checkbox" name="autosub" $16$/>
                            <a class="simple-link bold" href="#"><phpdac>cmsrt.slocale use _REGUSRINFO01</phpdac></a>
                        </div>
                    </div--><!-- /.field-row -->					

                    <div class="row field-row">
                        <div id="create-account" class="col-xs-12">
                            <!--input  class="le-checkbox big" type="checkbox"  />
                            <a class="simple-link bold" href="#">Create Account?</a> 
							Μετά την εγγραφή σας θα λάβετε email επιβεβαίωσης και ενεργοποίησης του λογαριασμού.
							<br/-->
							<phpdac>cms.getGlobal use sFormErr</phpdac>
                        </div>
                    </div><!-- /.field-row -->
					
					<div class="buttons-holder">
						<span class="pull-right">
                        <button type="submit" class="le-button huge"><phpdac>cms.slocale use _UPDATE</phpdac></button>
					    <input type="hidden" name="FormAction" value="updgdpr" />
						</span>
                    </div><!-- /.buttons-holder -->

                </form>
            </div><!-- /.billing-address -->
			<br/>
			<br/>
			<br/>			
			
			<div class="billing-address">
				<h2 class="border h1"><phpdac>cmsrt.slocale use _ULISTS</phpdac></h2>
				
				<form method="post">
					<div class="row field-row">
                        <div id="create-account" class="col-xs-12">
                            <input  class="le-checkbox big" type="checkbox" name="autosub" $16$/>
                            <a class="simple-link bold" href="#"><phpdac>cmsrt.slocale use _REGUSRINFO01</phpdac></a>
                        </div>
                    </div><!-- /.field-row -->
					
					<div class="buttons-holder">
						<span class="pull-right">
                        <button type="submit" class="le-button huge"><phpdac>cms.slocale use _UPDATE</phpdac></button>
					    <input type="hidden" name="FormAction" value="subgdpr" />
						</span>
                    </div><!-- /.buttons-holder -->					
				</form>	
			</div>
			
			<br/>
			<br/>
			<br/>		

			<div class="billing-address">
				<h2 class="border h1"><phpdac>cmsrt.slocale use _GDPRGET</phpdac></h2>
				
				<form method="post">
					<div class="buttons-holder">
						<span class="pull-right">
                        <button type="submit" class="le-button huge"><phpdac>cms.slocale use _GETDATA</phpdac></button>
					    <input type="hidden" name="FormAction" value="gdprget" />
						</span>
                    </div><!-- /.buttons-holder -->					
				</form>	
			</div>		
			
			<br/>
			<br/>
			<br/>			
			
			<div class="billing-address">
				<h2 class="border h1"><phpdac>cmsrt.slocale use _UDELETE</phpdac></h2>
				
				<form method="post">
					<div class="buttons-holder">
						<span class="pull-right">
                        <!--button type="submit" class="le-button huge"><-hpdac>cms.slocale use _DELETE</phpda-></button-->
					    <!--input type="hidden" name="FormAction" value="gdprdel" /-->
						
						<a onclick="new $.Zebra_Dialog('<phpdac>cmsrt.slocale use _userdeletefinalquestion</phpdac> <form method=\'post\'><button type=\'submit\' class=\'le-button huge\'><phpdac>cms.slocale use _DELETE</phpdac></button><input type=\'hidden\' name=\'FormAction\' value=\'gdprdel\'></form>', {
		'type':     'question',
		'title':    '<phpdac>cmsrt.slocale use _userdelete</phpdac>',
		'buttons':  [{caption: '<phpdac>cmsrt.slocale use _CANCEL</phpdac>', callback: function() { /*alert('Cancel was clicked')*/}}]
	});" class="le-button huge"><phpdac>cms.slocale use _DELETE</phpdac></a>
						</span>
                    </div><!-- /.buttons-holder -->					
				</form>	
			</div>		
			
			<br/>
			<br/>
			<br/>	