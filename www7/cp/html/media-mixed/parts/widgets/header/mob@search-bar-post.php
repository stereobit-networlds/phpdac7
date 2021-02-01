<div class="contact-row">
    <div class="phone inline">
        <i class="fa fa-phone"></i>(0030) <phpdac>rcserver.paramload use INDEX+tel1</phpdac>
    </div>
    <div class="contact inline">
        <i class="fa fa-envelope"></i><a href='contact.php'><phpdac>rcserver.paramload use INDEX+e-mail</phpdac></a> <!--contact@<span class="le-color">oursupport.com</span-->
    </div>
</div><!-- /.contact-row -->
<!-- ============================================================= SEARCH AREA ============================================================= -->
<div class="search-area">
    <form name="searchbigform" action="search.php" method="get">
        <div class="control-group">
            <input id="biginput" name="input" class="search-field" placeholder="<phpdac>frontpage.slocale use SHNSEARCH_DPC</phpdac>" />
			<br/>
			<a class="search-button" href="javascript:document.searchbigform.submit()" ></a>
			<!--input type="submit" class="search-button"-->
			<input type="hidden" name="FormAction" value="search">

        </div>
    </form>
	
	    <div class="control-group">
            <ul class="categories-filter animate-dropdown">
                <li class="dropdown">

                    <a class="dropdown-toggle"  data-toggle="dropdown" href="#"><phpdac>frontpage.slocale use SHKATEGORIES_DPC</phpdac></a>

                    <ul class="dropdown-menu" role="menu" >
					    <phpdac>shkategories.getKategoryCombo use 1++++++++search+search-combo+1</phpdac>
                    </ul>
                </li>
            </ul>
		</div>
</div><!-- /.search-area -->
<!-- ============================================================= SEARCH AREA : END ============================================================= -->