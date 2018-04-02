						<div class="prices"> 
							<div class="price-current">
							    <phpdac>shcart.price_with_tax use $1$</phpdac>
								<span class="price-prev"><phpdac>cmsrt.slocale use _WITHTAX</phpdac></span>
							</div>
							<br/><div class="price-prev">$1$ &euro; <phpdac>cmsrt.slocale use _WITHOUTTAX</phpdac> ($0$ <phpdac>cmsrt.slocale use _PCS</phpdac>)</div>
						</div>
						<!--div class="qnt-holder">2</div-->
						<div class="qnt-holder">
							<div class="le-quantity">
							<form>
								<a class="minus" href="#reduce" onclick="preselqty('PRESELQTY2',-1,$0$)"></a>
								<input id="PRESELQTY2" name="PRESELQTY2" readonly="readonly" type="text" value="$0$" />
								<a class="plus" href="#add" onclick="preselqty('PRESELQTY2',1,9999)"></a>
							</form>
							</div>
							<!--2-->
							<!--hpdac>cmsrt.nvl use shcart.agentIsIE+$2$+<a id="addto-cart" href="javascript:void(0)" onclick="addtocart('PRESELQTY2','$4$');" class="le-button huge">Στο καλάθι</a>+1</phpda-->
							<phpdac>
							cmsrt.nvl use shcart.agentIsIE+
								$2$
								+
								<?php 
								    if (floatval(str_replace(',','.','$1$'))>0.0) {
										$ret = '<a id="addto-cart" href="javascript:void(0)" onclick="addtocart(\'PRESELQTY2\',\'$4$\');" class="le-button huge">';
										$ret.= localize('_INCART', getlocal());
										$ret.='</a>';
									}
									else {
										$ret = '<a id="addto-cart" href="javascript:void(0)" onclick="#" class="le-button huge">';
										$ret.= localize('_ZEROVAL', getlocal());
										$ret.='</a>';
									}
									return $ret;
								?>
								+1
							</phpdac>							
						</div><!-- /.qnt-holder -->