				<tr class="cart-subtotal">
                    <th><phpdac>cmsrt.slocale use _CARTTOTAL</phpdac></th>
                    <td data-title="Subtotal"><span class="amount">$0$</span></td>
                </tr>
				
				<phpdac>
				cms.nvltokens use $1$+
				<?php
				$ret = "<tr class=\"cart-subtotal\"><th>";
				$ret.= localize('_CARTDISCOUNT', getlocal());
				$ret.= "</th><td><span class=\"amount\">$1$</span></td></tr>";
				return ($ret);	   
				?>	
				+
				</phpdac>				
				
				<phpdac>
				cms.nvltokens use $2$+
				<?php
				$ret = "<tr class=\"cart-subtotal\"><th>";
				$ret.= localize('_CARTVAT', getlocal());
				$ret.= "</th><td><span class=\"amount\">$2$</span></td></tr>";
				return ($ret);	   
				?>	
				+
				</phpdac>

				<!--hpdac>
				cms.nvltokens use $3$+
				<
				$ret = "<tr class=\"cart-subtotal\"><th>";
				$ret.= localize('_CARTDELIVCOST', getlocal());
				$ret.= "</th><td><span class=\"amount\">$3$</span></td></tr>";
				return ($ret);	   
				?>	
				+
				</phpda-->

				<phpdac>
				cms.nvltokens use $5$+
				<?php
				$ret = "<tr class=\"shipping\"><th>";
				$ret.= localize('_CARTSHIPCOST', getlocal());
				$ret.= "</th><td><span class=\"amount\">$5$</span></td></tr>";
				return ($ret);	   
				?>	
				+
				</phpdac>

				<phpdac>
				cms.nvltokens use $6$+
				<?php
				$ret = "<tr class=\"cart-subtotal\"><th>";
				$ret.= localize('_CARTPAYCOST', getlocal());
				$ret.= "</th><td><span class=\"amount\">$6$</span></td></tr>";
				return ($ret);	   
				?>	
				+
				</phpdac>

				<tr class="order-total">
                    <th><phpdac>cmsrt.slocale use _CARTORDERTOTAL</phpdac></th>
                    <td><strong><span class="amount"><phpdac>shcart.getcartTotal use +1</phpdac> &euro;</span></strong> </td>
                </tr>