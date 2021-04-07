<form class="navbar-search" name="searchbigform" action="search.php" method="get">
	<label class="sr-only screen-reader-text" for="search">Search for:</label>
	<div class="input-group">
		<input type="text" id="biginput" class="form-control search-field" dir="ltr" value="" name="input" placeholder="<phpdac>cms.slocale use SHNSEARCH_DPC</phpdac>" />
		<div class="input-group-addon search-categories">
			<select name='searchincat' id='searchincat' class='postform resizeselect' > <!-- onchange='gocatsearch(this.options[this.selectedIndex].value)' -->
				<option value='search/all/' selected='selected'><phpdac>cms.slocale use SHKATEGORIES_DPC</phpdac> <phpdac>cms.slocale use _ALL</phpdac></option>
				<phpdac>shkategories.getKategoryCombo use 1++++++++search+search-combo+0</phpdac>
			</select>
		</div>
		<div class="input-group-btn">
			<!--input type="hidden" id="search-param" name="post_type" value="product" /-->
			<!--button type="submit" class="btn btn-secondary"><i class="ec ec-search"></i></button-->
			<a id="search-button" onclick="javascript:gocatsearch(document.getElementById('searchincat').value);" class="btn btn-secondary"><i class="ec ec-search"></i></a>
		</div>
	</div>
</form>