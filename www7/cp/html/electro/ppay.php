<div>
	<phpdac>shcart.roadDetails</phpdac>
</div>

<h3><phpdac>cms.slocale use _CARTPAYWAY</phpdac></h3>
<select name="$0$" onChange="ajaxCall('katalog.php?t=cartpayment&payway='+this.options[this.selectedIndex].value ,'paymentdetails')">
$1$
</select>

<div id="paymentdetails">
	<phpdac>shcart.payDetails</phpdac>
</div>
