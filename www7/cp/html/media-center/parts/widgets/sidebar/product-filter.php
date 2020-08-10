<!-- ========================================= PRODUCT FILTER ========================================= -->
<div
	class="fb-like"
	data-share="true"
	data-width="450"
	data-show-faces="false"
	data-send="false">
</div>

<div class="widget">
    <!--h1><phpdac>cmsrt.slocale use _FILTERS</phpdac></h1-->
    <div class="body bordered">
	
		<div class="category-filter">		
			<ul>
				<phpdac>shkatalogmedia.filterDel</phpdac>
            </ul>	
        </div>	

		<phpdac>shkatalogmedia.filterExtAll use 1++1</phpdac>
		<!--hpdac>shkatalogmedia.filterExt use Colors++1</phpda-->
		<!--hpdac>shkatalogmedia.filterExt use Size++1</phpda-->					
		
        <h2><phpdac>cmsrt.slocale use _brands</phpdac></h2>
        <hr>        
        <div class="category-filter" style="overflow-y:auto; height:<phpdac>cmsrt.echostr use shkatalogmedia.fpx</phpdac>;">
            <ul>
				<phpdac>shkatalogmedia.filter use manufacturer+searchfilter+1+kfilter+1</phpdac>
            </ul>
        </div><!-- /.category-filter -->
		
        <h2><phpdac>cmsrt.slocale use _COLOR</phpdac></h2>
        <hr>		
		<div class="category-filter" style="overflow-y:auto; height:<phpdac>cmsrt.echostr use shkatalogmedia.fpx</phpdac>;">					
            <ul>
				<phpdac>shkatalogmedia.filter use color+searchfilter+1+kfilter+1</phpdac>
            </ul>			
        </div>		
		
        <h2><phpdac>cmsrt.slocale use _SIZE</phpdac></h2>
        <hr>		
		<div class="category-filter" style="overflow-y:auto; height:<phpdac>cmsrt.echostr use shkatalogmedia.fpx</phpdac>;">					
            <ul>
				<phpdac>shkatalogmedia.filter use size+searchfilter+1+kfilter+1</phpdac>
            </ul>			
        </div>			
		
        <div class="price-filter">
            <h2><phpdac>cmsrt.slocale use _price</phpdac></h2>
            <hr>
            <div class="price-range-holder">

                <input type="text" class="price-slider" value="" name="kprice">

                <span class="min-max">
                    <phpdac>cmsrt.slocale use _price</phpdac>:
					<phpdac>cmsrt.nvlnum use input+<?php 
						$p = explode('.', GetReq('input'));	
						$pr1 = number_format($p[0],2,',','.') . '&euro;';
						$pr2 = number_format($p[1],2,',','.') . '&euro;';
						return $pr1 .'-'. $pr2 ?>
						+<?php
						$pr1 = number_format(_v('shkatalogmedia.min_price'),2,',','.') . '&euro;';
						$pr2 = number_format(_v('shkatalogmedia.max_price'),2,',','.') . '&euro;';
						return $pr1 .'-'. $pr2 ?>+
					</phpdac> 
                </span>
                <span class="filter-button">
                    <a href="klist/<phpdac>cmsrt.echostr use cat</phpdac>/"><del><phpdac>cmsrt.slocale use _filter</phpdac></del></a>
                </span>
            </div>
        </div><!-- /.price-filter -->		

    </div><!-- /.body -->
</div><!-- /.widget -->
<!-- ========================================= PRODUCT FILTER : END ========================================= -->