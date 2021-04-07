<aside id="electro_product_categories_widget-2" class="widget woocommerce widget_product_categories electro_widget_product_categories">
	<ul class="product-categories category-single">
		<li class="product_cat">

			<ul class="show-all-cat">
				<li class="product_cat">
					<span class="show-all-cat-dropdown">
						<phpdac>cms.paramload use INDEX+title</phpdac> <phpdac>cms.slocale use SHKATEGORIES_DPC</phpdac>
					</span>
					<ul style="display: none">
						<phpdac>shkategories.show_selected_tree use klist++1+SHOW++ins_left_nav+++fpcatsleft+</phpdac>
					</ul>
				</li>
			</ul>
			
			<ul>	
				<li class="cat-item cat-item-172 current-cat-parent current-cat-ancestor">

					<a href="<phpdac>shkategories.getcurrenturlkategory</phpdac>"><phpdac>shkategories.getcurrentkategory</phpdac></a> 
					<ul class='children'>
						<phpdac>shkategories.show_selected_tree use klist+++SHOW++ins_left_nav+++fpcatsleft+</phpdac>
					</ul>
				</li>
			</ul>
		</li><!-- .product_cat -->
	</ul><!-- .product-categories -->
</aside><!-- .widget -->