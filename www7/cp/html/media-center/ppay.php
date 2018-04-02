<div>
	<phpdac>shcart.roadDetails</phpdac>
</div>

<h2 class="border"><phpdac>cms.slocale use _CARTPAYWAY</phpdac></h2>
<select name="$0$" onChange="ajaxCall('katalog.php?t=cartpayment&payway='+this.options[this.selectedIndex].value ,'paymentdetails')">
$1$
</select>

<div id="paymentdetails">
	<phpdac>shcart.payDetails</phpdac>
</div>
