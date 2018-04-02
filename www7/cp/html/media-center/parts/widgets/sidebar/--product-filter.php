<!-- ========================================= PRODUCT FILTER ========================================= -->
<div
	class="fb-like"
	data-share="true"
	data-width="450"
	data-show-faces="false"
	data-send="false">
</div>

<div class="widget">
    <h1><phpdac>cmsrt.slocale use _FILTERS</phpdac></h1>
    <div class="body bordered">
        
        <div class="category-filter">
            <h2><phpdac>cmsrt.slocale use _brands</phpdac></h2>
			<!--h2><phpdac>cmsrt.slocale use _SEARCH</phpdac></h2-->
            <hr>
            <ul>
				<!--hpdac>shnsearch.filter use manufacturer+searchfilter.htm+1+filter</phpda-->
				<phpdac>shkatalogmedia.filter use manufacturer+searchfilter+1+kfilter+1</phpdac>
            </ul>
        </div><!-- /.category-filter -->
        
        <div class="price-filter">
            <h2><phpdac>cmsrt.slocale use _price</phpdac></h2>
            <hr>
            <div class="price-range-holder">

                <input type="text" class="price-slider" value="" name="kprice">

                <span class="min-max">
                    <phpdac>cmsrt.slocale use _price</phpdac>:
					<phpdac>cmsrt.nvlnum use input+<? 
						$p = explode('.', GetReq('input'));	
						$pr1 = number_format($p[0],2,',','.') . '&euro;';
						$pr2 = number_format($p[1],2,',','.') . '&euro;';
						return $pr1 .'-'. $pr2 ?>+
						*+
					</phpdac> 
                </span>
                <span class="filter-button">
                    <a href="klist/<phpdac>cmsrt.echostr use cat</phpdac>/"><phpdac>cmsrt.slocale use _filter</phpdac></a>
                </span>
            </div>
        </div><!-- /.price-filter -->

    </div><!-- /.body -->
</div><!-- /.widget -->
<!-- ========================================= PRODUCT FILTER : END ========================================= -->