<select name="$0$" onChange="ajaxCall('katalog.php?t=cartaddress&addressway='+this.options[this.selectedIndex].value ,'addressdetails')">
$1$
</select>
<div id='addressdetails'>
<phpdac>shcart.addressDetails</phpdac>
</div>

<h2 class='border'>Προσθέστε διεύθυνση αποστολής</h2>
<div class="buttons-holder">
<span class="pull-right">					
    <a class="simple-link block" href="addnewdeliv/" >Νέα διεύθυνση αποστολής</a>
	<!--a href='addnewdeliv/'><input type='button' class='le-button' value='Νέα διεύθυνση αποστολής'></a-->
</span>	
</div>
