<aside class="widget widget_electro_products_filter">
    <h3 class="widget-title"><phpdac>cmsrt.slocale use _FILTERS</phpdac></h3>	
	
	<phpdac>shkatalogmedia.filterExtAll use 1++1</phpdac>
	<!--hpdac>shkatalogmedia.filterExt use Colors++1</phpda-->
	<!--hpdac>shkatalogmedia.filterExt use Size++1</phpda-->
	
    <aside class="widget woocommerce widget_layered_nav" style="overflow-y:auto; height:<phpdac>cmsrt.echostr use shkatalogmedia.fpx</phpdac>;">
        <h3 class="widget-title"><phpdac>cmsrt.slocale use _brands</phpdac></h3>
        <ul>
		    <phpdac>shkatalogmedia.filter use manufacturer+searchfilter+1+kfilter+1</phpdac>
        </ul>
    </aside>
	
    <aside class="widget woocommerce widget_layered_nav" style="overflow-y:auto; height:<phpdac>cmsrt.echostr use shkatalogmedia.fpx</phpdac>;">
        <h3 class="widget-title"><phpdac>cmsrt.slocale use _COLOR</phpdac></h3>
        <ul>
            <phpdac>shkatalogmedia.filter use color+searchfilter+1+kfilter+1</phpdac>
        </ul>
    </aside>
	
    <aside class="widget woocommerce widget_layered_nav" style="overflow-y:auto; height:<phpdac>cmsrt.echostr use shkatalogmedia.fpx</phpdac>;">
        <h3 class="widget-title"><phpdac>cmsrt.slocale use _SIZE</phpdac></h3>
        <ul>
            <phpdac>shkatalogmedia.filter use size+searchfilter+1+kfilter+1</phpdac>
        </ul>
    </aside>
	
    <aside class="widget woocommerce widget_price_filter">
        <h3 class="widget-title"><phpdac>cmsrt.slocale use _price</phpdac>
			<phpdac>cmsrt.nvlnum use input+<?php 
				$p = explode('.', GetReq('input'));	
				$pr1 = number_format($p[0],2,',','.') . '&euro;';
				$pr2 = number_format($p[1],2,',','.') . '&euro;';
				return $pr1 .'-'. $pr2 ?>
				+<?php
				$pr1 = number_format(_v('shkatalogmedia.min_price'),2,',','.') . '&euro;';
				$pr2 = number_format(_v('shkatalogmedia.max_price'),2,',','.') . '&euro;';
				return '<span class="from">'. $pr1 .'</span> &mdash; <span class="to">'. $pr2 .'</span>' ?>+
			</phpdac>
		</h3>
        <form action="#">
            <div class="price_slider_wrapper">
							
                <!--div style="" class="price_slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                    <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div>
                    <span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 0%;"></span>
                    <span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 100%;"></span>
                </div-->
				
				<!--input id="ex2" type="text" class="span2" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]"/-->
				<phpdac>cmsrt.nvlnum use input+<?php 
					$p = explode('.', GetReq('input'));
					$min = floor(_v('shkatalogmedia.min_price'));
					$max = ceil(_v('shkatalogmedia.max_price'));	
					$diff = ($max - $min);
					$step = ($diff<=100) ? 1 : 10;
					$pr1 = $p[0];
					$pr2 = $p[1];
					return "<input id=\"ex2\" type=\"text\" class=\"span2\" value=\"\" data-slider-min=\"$min\" data-slider-max=\"$max\" data-slider-step=\"$step\" data-slider-value=\"[$pr1,$pr2]\"/>" ?>
					+<?php
					$min = floor(_v('shkatalogmedia.min_price'));
					$max = ceil(_v('shkatalogmedia.max_price'));
					$diff = ($max - $min);
					$step = ($diff<=100) ? 1 : 10;
					return "<input id=\"ex2\" type=\"text\" class=\"span2\" value=\"\" data-slider-min=\"$min\" data-slider-max=\"$max\" data-slider-step=\"$step\" data-slider-value=\"[$min,$max]\"/>" ?>+
				</phpdac>				
				<span id="ex6CurrentSliderValLabel"> &nbsp;&nbsp;&nbsp; <span id="ex6SliderVal"></span></span>
				
                <div class="price_slider_amount">
				
                    <!--a href="klist/<phpdac>cmsrt.echostr use cat</phpdac>/" class="button"><del><phpdac>cmsrt.slocale use _filter</phpdac><del></a-->		
					<a onclick="javascript:priceFilter()" class="button"><phpdac>cmsrt.slocale use _filter</phpdac></a>
					
                    <div style="" class="price_label">
						<!--span class="from">$428</span> &mdash; <span class="to">$3485</span-->
					</div>
                    <div class="clear"></div>
                </div>
            </div>
        </form>
		
    </aside>

    <aside class="widget woocommerce widget_layered_nav"  style="overflow-y:auto; height:<phpdac>cmsrt.echostr use shkatalogmedia.fpx</phpdac>;">
		<h3 class="widget-title"><phpdac>cmsrt.slocale use _filter</phpdac></h3>
        <ul>
		    <phpdac>shkatalogmedia.filterDel</phpdac>
        </ul>
    </aside>	
</aside>
