    <ul class="tabled-data no-border inverse-bold">
		<li>
			<label><phpdac>cmsrt.slocale use _CARTTOTAL</phpdac></label>
			<div class='value pull-right'>$0$</div>
		</li>

		<phpdac>
			cms.nvltokens use $1$+
			<?php
				$ret = "<li><label>";
				$ret.= localize('_CARTDISCOUNT', getlocal());
				$ret.= "</label><div class='value pull-right'>$1$</div></li>";
				return ($ret);	   
			?>	
			+
		</phpdac>
		
		<phpdac>
			cms.nvltokens use $2$+
			<?php
				$ret = "<li><label>"; 
				$ret.= localize('_CARTVAT', getlocal());
				$ret.= "</label><div class='value pull-right'>$2$</div></li>";
				return ($ret);	   
			?>	
			++
		</phpdac>
		
		<!--hpdac>
			cms.nvltokens use $3$+
			<- 	$ret = "<li><label>";
				$ret.= localize('_CARTDELIVCOST', getlocal());
				$ret.= "</label><div class='value pull-right'>$3$</div></li>";
				return ($ret);	
			->	
			+
		</phpda-->
		
		<phpdac>
			cms.nvltokens use $5$+
			<?php
				$ret = "<li><label>";
				$ret.= localize('_CARTSHIPCOST', getlocal());
				$ret.= "</label><div class='value pull-right'>$5$</div></li>";
				return ($ret);	
			?>	
			+
		</phpdac>

		<phpdac>
			cms.nvltokens use $6$+
			<?php
				$ret = "<li><label>";
				$ret.= localize('_CARTPAYCOST', getlocal());
				$ret.= "</label><div class='value pull-right'>$6$</div></li>";
				return ($ret);	
			?>	
			+
		</phpdac>		
		
		<!--hpdac>
			cms.nvltokens use $4$+
			<-
				$ret = "<li><label>";
				$ret.= localize('_CARTTOTAL', getlocal());
				$ret.= ":</label><div class='value pull-right'>$4$</div></li>";
				return ($ret);		
			->
		+</phpda-->
		
        <!--li>
            <label><phpdac>cmsrt.slocale use _CARTSUBTOTAL</phpdac></label>
            <div class="value pull-right"><phpdac>shcart.getcartSubtotal</phpdac> &euro;</div>
        </li-->
        <!--li>
            <label><phpdac>cmsrt.slocale use _CARTDELIVCOST</phpdac></label>
            <div class="value pull-right">free shipping</div>
        </li-->
    </ul>
	
    <ul id="total-price" class="tabled-data inverse-bold no-border">
        <li>
            <label><phpdac>cmsrt.slocale use _CARTORDERTOTAL</phpdac></label>
            <div class="value pull-right"><phpdac>shcart.getcartTotal use +1</phpdac> &euro;</div>
        </li>
		<!--hpdac>cms.nvltokens use $4$+<li><label>Σύνολο:</label><div class='value pull-right'>$4$</div></li>+</phpda-->
    </ul>
    <!--div class="buttons-holder">
        <a class="le-button big" href="<-hpdac>rcserver.paramload use SHELL+urlbase</phpda->/index.php?page=checkout" >checkout</a>
        <a class="simple-link block" href="<-hpdac>rcserver.paramload use SHELL+urlbase</phpda->" >continue shopping</a>
    </div-->	
    <!-- 
    $5$ $6$ $7$ $8$ $9$ $10$ $11$ $12$ $13$ $14$ $15$ $16$
	-->
