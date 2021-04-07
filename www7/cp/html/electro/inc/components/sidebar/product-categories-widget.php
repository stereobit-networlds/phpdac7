<aside class="widget woocommerce widget_product_categories electro_widget_product_categories">
    <ul class="product-categories category-single">
        <li class="product_cat">
            <ul class="show-all-cat">
                <li class="product_cat"><span class="show-all-cat-dropdown"><phpdac>cms.paramload use INDEX+title</phpdac> <phpdac>cms.slocale use SHKATEGORIES_DPC</phpdac></span>
                    <ul>
                        <phpdac>shkategories.show_selected_tree use klist++1+SHOW++ins_left_nav+++fpcatsleft+</phpdac>
                    </ul>
                </li>
            </ul>
            <ul>
                <li class="cat-item current-cat"><a href="<phpdac>shkategories.getcurrenturlkategory</phpdac>"><phpdac>shkategories.getcurrentkategory</phpdac></a>
                    <ul class='children'>
						<phpdac>shkategories.show_selected_tree use klist+++SHOW++ins_left_nav+++fpcatsleft+</phpdac>
                    </ul>
                </li>
            </ul>
			
        </li>
    </ul>
	<!--hpdac>shkategories.show_menu use +fpkatnav-accordion</phpda-->
</aside>