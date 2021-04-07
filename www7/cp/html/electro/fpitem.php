				<div class="product">

					<div class="single-product-wrapper">
						<div class="product-images-wrapper">
							<span class="onsale">Sale</span>
							<phpdac>cmsrt.nvltokens use $26$+<span class="onsale">Discount</span>++</phpdac> 
							<phpdac>cmsrt.nvltokens use $41$+<span class="onsale">Points</span>++</phpdac>
							
							 <!--hpdac>cmsrt.include_part use /inc/blocks/single-product/images-block.php</phpda-->
							<div class="images electro-gallery">
								<div class="thumbnails-single owl-carousel">
									<a href="$19$" class="zoom" title="$0$" data-rel="prettyPhoto[product-gallery]">
										<img src="assets/images/blank.gif" data-echo="$18$" class="wp-post-image" alt="$0$">
									</a>
									<phpdac>shkatalogmedia.show_aditional_files use $10$++$0$+fpitemaddfiles</phpdac>
								</div><!-- .thumbnails-single -->

								<div class="thumbnails-all columns-5 owl-carousel"> <!-- columns 5 muste set as thumbs no+1 -->
									<a href="$17$" class="first" title="$0$">
										<img src="assets/images/blank.gif" data-echo="$18$" class="wp-post-image" alt="$0$">
									</a>
									<phpdac>shkatalogmedia.show_aditional_files use $10$++$0$+fpitemaddfiles-thumb</phpdac>
								</div><!-- .thumbnails-all -->
							</div><!-- .electro-gallery -->								 
							 <!-- -->
							 
							<!-- video -->
							<phpdac>cms.nvltokens use $45$+<br/><div class="videoWrapper"><iframe allowfullscreen="" frameborder="0" width="560 height="349" src="$45$"></iframe></div>++</phpdac>
						</div><!-- /.product-images-wrapper -->

						<!--hpdac>cmsrt.include_part use /inc/blocks/single-product/single-product-summary.php</phpda-->
	<div class="summary entry-summary">

	<span class="loop-product-categories">
		<a href="<phpdac>shkategories.getcurrenturlkategory</phpdac>" rel="tag"><phpdac>shkategories.getcurrentkategory</phpdac></a>
	</span><!-- /.loop-product-categories -->

	<h1 itemprop="name" class="product_title entry-title">$0$</h1>

	<div class="woocommerce-product-rating">
		<div class="star-rating" title="Rated 4.33 out of 5">
			<span style="width:86.6%">
				<strong itemprop="ratingValue" class="rating">4.33</strong> 
				out of <span itemprop="bestRating">5</span>				based on
				<span itemprop="ratingCount" class="rating">3</span>
				customer ratings			
			</span>
		</div>

		<a href="#reviews" class="woocommerce-review-link">
			(<span itemprop="reviewCount" class="count"><span class="fb-comments-count" data-href="<phpdac>cmsrt.paramload use SHELL+urlbase</phpdac><phpdac>cmsrt.php_self</phpdac>"></span></span> customer reviews)
		</a>	
	</div><!-- .woocommerce-product-rating -->

	<!--div class="brand">
		<a href="$8$">
			<img src="assets/images/single-product/brand.png" alt="Gionee" />
		</a>		
	</div--><!-- .brand -->
	
	<div class="availability in-stock">
		<phpdac>cms.slocale use _AVAILABILITY</phpdac>: 
		<span>
		<!--In stock -->
		<phpdac>
			cms.nvldecode use $31$
			+
			<?php return(localize('_NOTAVAILABLE', getlocal())) ?>
			+
			<?php return(localize('_AVAILABLE', getlocal())) ?>
			+0
			+
			$54$
		</phpdac>
		</span>
	</div><!-- .availability -->

	<hr class="single-product-title-divider" />
	
	<div class="action-buttons">
		<a href="wishadd/$10$/" class="add_to_wishlist" ><phpdac>cms.slocale use _ADDTOWISHLIST</phpdac></a>
		<a href="cmpadd/$10$/" class="add-to-compare-link" data-product_id="2452"><phpdac>cms.slocale use _ADDTOCOMPARE</phpdac></a>
	</div><!-- .action-buttons -->

	<div itemprop="description">
		<p>$1$</p>
		<p><strong>SKU</strong>: <span><phpdac>cms.nvl use $29$+$29$+$10$+</phpdac></span> $3$</p>
	</div><!-- .description -->

	<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

		<p class="price">
			<span class="electro-price"><ins><span class="amount">$5$ &euro;</span></ins>
			<!--del><span class="amount">$5$ &euro;</span></del></span-->
			<small>
			<span class="amount"><phpdac>shcart.price_with_tax use $5$</phpdac></span>
			<span class="amount">
				<phpdac>cms.slocale use _WITHTAX</phpdac>
			</span>
			</small>
		</p>

		<meta itemprop="price" content="$5$" />
		<meta itemprop="priceCurrency" content="EUR" />
		<link itemprop="availability" href="http://schema.org/InStock" />

	</div><!-- /itemprop -->

	<!--hpdac>cmsrt.include_part use /inc/blocks/single-product/variations-form.php</phpda-->
<form class="variations_form cart" method="post">

	<table class="variations">
		<tbody>
			<tr>
				<td class="label"><label>Color</label></td>
				<td class="value">
					<select class="" name="attribute_pa_color">
						<option value="">Choose an option</option>
						<option value="black-with-red" >Black with Red</option>
						<option value="white-with-gold"  selected='selected'>White with Gold</option>
					</select>
					<a class="reset_variations" href="#">Clear</a>
				</td>
			</tr>
		</tbody>
	</table>


	<div class="single_variation_wrap">
		<div class="woocommerce-variation single_variation"></div>
		<div class="woocommerce-variation-add-to-cart variations_button">
			<div class="quantity">
				<label>Quantity:</label>
				<input type="number" id="PRESELQTY" name="PRESELQTY" value="<phpdac>shcart.getCartItemQty use $10$+1</phpdac>" title="Qty" class="input-text qty text"/>
				<!--input type="number" name="quantity" value="1" title="Qty" class="input-text qty text"/-->
			</div>
			
			<!--button type="submit" class="single_add_to_cart_button button">Add to cart</button-->
			<phpdac>
				cmsrt.nvl use shcart.agentIsIE+
				$6$
				+
				<?php 
					if (floatval(str_replace(',','.','$5$'))>0.0) {
						$ret = '<a type="submit" class="single_add_to_cart_button button" id="addto-cart" href="javascript:void(0)" onclick="addtocart(\'PRESELQTY\',\'$27$\');">';
						$ret.= localize('_INCART', getlocal());
						$ret.='</a>';
					}
					else {
						$ret = '<a type="submit" class="single_add_to_cart_button button" id="addto-cart" href="javascript:void(0)" onclick="#">';
						$ret.= localize('_ZEROVAL', getlocal());
						$ret.='</a>';
					}
					return $ret;
				?>
				+1
				</phpdac>
			    <!-- 6 -->
			<input type="hidden" name="add-to-cart" value="2452" />
			<input type="hidden" name="product_id" value="$10$" />
			<input type="hidden" name="variation_id" class="variation_id" value="0" />
		</div>
	</div>
</form>	
	<!-- -->

    <!-- start qty policy -->
		$12$
	<!-- end qty policy -->
	
	<!-- fb quote -->
	<div class="fb-quote"></div>
						
</div><!-- .summary -->
	<!-- -->						

					</div><!-- /.single-product-wrapper -->

					<div id="$10$-details">
					<div class="woocommerce-tabs wc-tabs-wrapper">
						<ul class="nav nav-tabs electro-nav-tabs tabs wc-tabs" role="tablist">
							<li class="nav-item accessories_tab">
								<a href="#tab-accessories" <phpdac>cms.nvlparam use ESHOP.kshowactivetab+class="active"++1</phpdac> data-toggle="tab"><phpdac>cms.slocale use _recommended</phpdac></a>
							</li>

							<li class="nav-item description_tab">
								<a href="#tab-description" <phpdac>cms.nvlparam use ESHOP.kshowactivetab+class="active"++2</phpdac> data-toggle="tab"><phpdac>cms.slocale use _DESCRIPTION</phpdac></a>
							</li>

							<li class="nav-item specification_tab">
								<a href="#tab-specification" <phpdac>cms.nvlparam use ESHOP.kshowactivetab+class="active"++3</phpdac> data-toggle="tab"><phpdac>cms.slocale use _ADDITIONALINFO</phpdac></a>
							</li>

							<li class="nav-item reviews_tab">
								<a href="#tab-reviews" <phpdac>cms.nvlparam use ESHOP.kshowactivetab+class="active"++4</phpdac> data-toggle="tab"><phpdac>cms.slocale use _REVIEWS</phpdac></a>
							</li>
						</ul>

						<div class="tab-content">
							<div class="tab-pane <phpdac>cms.nvlparam use ESHOP.kshowactivetab+active in++1</phpdac> panel entry-content wc-tab" id="tab-accessories">
								<!--hpdac>cmsrt.include_part use /inc/blocks/single-product/woocommerce-tabs/accessories-tab.php</phpda-->
								<phpdac>shkatalogmedia.show_p use 3+3+fpproducts-item-accesories+1+p4+fpproducts-item-accesories-line</phpdac>								
							</div>

							<div class="tab-pane <phpdac>cms.nvlparam use ESHOP.kshowactivetab+active in++2</phpdac> panel entry-content wc-tab" id="tab-description">
								<!--hpdac>cmsrt.include_part use /inc/blocks/single-product/woocommerce-tabs/description-tab.php</phpda-->
								<div class="electro-description">
									$53$
							    </div><!-- /.electro-description -->

								<div class="product_meta">
									<span class="sku_wrapper">SKU: <span class="sku" itemprop="sku"><span><phpdac>cms.nvl use $29$+$29$+$10$+</phpdac></span></span></span>

									<span class="posted_in"><phpdac>cms.slocale use KATEGORIES_DPC</phpdac>:
										<a href="<phpdac>shkategories.getcurrenturlkategory</phpdac>" rel="tag"><phpdac>shkategories.getcurrentkategory</phpdac></a>
									</span>

									<span class="tagged_as"><phpdac>cms.slocale use _TAG</phpdac>: 
										<phpdac>shtag.get_tags use $10$+keywords</phpdac>
									</span>

								</div><!-- /.product_meta -->	
							</div>

							<div class="tab-pane <phpdac>cms.nvlparam use ESHOP.kshowactivetab+active in++3</phpdac> panel entry-content wc-tab" id="tab-specification">
								<!--hpdac>cmsrt.include_part use /inc/blocks/single-product/woocommerce-tabs/specification-tab.php</phpda-->
								<!--h3>Technical Specifications</h3-->
								<table class="table">
									<tbody>
									<tr>
										<td><phpdac>cms.slocale use _WEIGHT</phpdac></td>
										<td>$20$</td>
									</tr>
									<tr>
										<td><phpdac>cms.slocale use _VOLUME</phpdac></td>
										<td>$21$</td>
									</tr>						
									<tr>
										<td><phpdac>cms.slocale use _DIMENSIONS</phpdac></td>
										<td>$22$</td>
									</tr>
									<tr>
										<td><phpdac>cms.slocale use _SIZE</phpdac></td>
										<td>$23$</td>
									</tr>
									<tr>
										<td><phpdac>cms.slocale use _COLOR</phpdac></td>
										<td>$24$</td>
									</tr>									
									</tbody>
								</table>

								<div class="product_meta">
									<span class="sku_wrapper">SKU: <span class="sku" itemprop="sku"><span><phpdac>cms.nvl use $29$+$29$+$10$+</phpdac></span></span></span>

									<span class="posted_in"><phpdac>cms.slocale use KATEGORIES_DPC</phpdac>:
										<a href="<phpdac>shkategories.getcurrenturlkategory</phpdac>" rel="tag"><phpdac>shkategories.getcurrentkategory</phpdac></a>
									</span>

									<span class="tagged_as"><phpdac>cms.slocale use _TAG</phpdac>: 
										<phpdac>shtag.get_tags use $10$+keywords</phpdac>
									</span>

								</div><!-- /.product_meta -->								
							</div><!-- /.panel -->

							<div class="tab-pane <phpdac>cms.nvlparam use ESHOP.kshowactivetab+active in++4</phpdac> panel entry-content wc-tab" id="tab-reviews">
								<!--hpdac>cmsrt.include_part use /inc/blocks/single-product/woocommerce-tabs/reviews-tab.php</phpda-->
								<div class="fb-comments" data-href="<phpdac>cmsrt.paramload use SHELL+urlbase</phpdac><phpdac>cmsrt.php_self</phpdac>#configurator" data-numposts="5"></div>								
							</div><!-- /.panel -->
						</div>
					</div><!-- /.woocommerce-tabs -->
					</div>
					
					<div id="$10$-relative">			
					<!--hpdac>cmsrt.include_part use /inc/blocks/single-product/related-products.php</phpda-->
					<!--hpdac>shkatalogmedia.show_group use 3+1+fpproducts-tab+1+$4$+fpproducts-tab-line</phpda-->
					
					<!--hpdac>shkategories.show_item_categories use $30$+fpcategories-tab</phpda-->
					<!--hpdac>shkatalogmedia.show_pcat use 3+1+fpproducts-tab+1+p3+ΠΕΡΙΒΑΛΛΟΝ_ΓΡΑΦΕΙΟΥ+fpproducts-tab-line</phpda-->
					<!--hpdac>shkatalogmedia.show_p use 3+1+fpproducts-tab+1+p3+fpproducts-tab-line</phpda-->
					<!--hpdac>shkatalogmedia.show_kategory_items use 3+1+fpproducts-tab+1+ΥΛΙΚΑ_PLOTTER,KAPA++fpproducts-tab-line</phpda-->
					<!--hpdac>shkatalogmedia.show_offers use 3+1+fpproducts-featured-footer+1++fpproducts-tab-line</phpda-->					
					
					<!--hpdac>shkatalogmedia.show_relative_sales use 3+2+fpproducts-item-related+++fpproducts-item-related-line</phpda-->
					<phpdac>shkatalogmedia.show_p use 8+4+fpproducts-item-related+1+p4+fpproducts-item-related-line</phpdac>
					</div>					
				</div>