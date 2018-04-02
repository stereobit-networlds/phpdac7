<select name="$0$" onChange="ajaxCall('katalog.php?t=cartaddress&addressway='+this.options[this.selectedIndex].value ,'addressdetails')">
$1$
</select>
<div id='addressdetails'>
<phpdac>shcart.addressDetails</phpdac>
</div>

<h2 class='border'><phpdac>cms.slocale use _DELIVERYWAYADD</phpdac></h2>
<div class="buttons-holder">
<span class="pull-right">					
    <a class="simple-link block" href="addnewdeliv/" ><phpdac>cms.slocale use _DELIVERYWAYNEW</phpdac></a>
	<!--a href='addnewdeliv/'><input type='button' class='le-button' value='Νέα διεύθυνση αποστολής'></a-->
</span>	
</div>
