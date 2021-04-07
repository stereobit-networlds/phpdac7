<select name="$0$" onChange="ajaxCall('katalog.php?t=cartaddress&addressway='+this.options[this.selectedIndex].value ,'addressdetails')">
$1$
</select>
<div id='addressdetails'>
<phpdac>shcart.addressDetails</phpdac>
</div>

<h3><phpdac>cms.slocale use _DELIVERYWAYADD</phpdac></h3>				
<a class="button" href="addnewdeliv/" ><phpdac>cms.slocale use _DELIVERYWAYNEW</phpdac></a>