        <div id="$10$">    
			<div id="single-product" class="row">
                <!--hpdac>cms.include_part use /parts/section/single-product-gallery.php+++media-center</phpda-->
				<div class="no-margin col-xs-12 col-sm-6 col-md-5 gallery-holder">
					<div class="product-item-holder size-big single-product-gallery small-gallery">

						<div id="owl-single-product">
							<div class="single-product-gallery-item" id="slide1">
							    <phpdac>cmsrt.nvltokens use $26$+<div class='ribbon blue'><span>++</phpdac> 
								<phpdac>cmsrt.nvltokens use $26$+<?php return(localize('_WITHDISCOUNT', getlocal())) ?>++</phpdac>
								<phpdac>cmsrt.nvltokens use $26$+</span></div>++</phpdac>
								<phpdac>cmsrt.nvltokens use $41$+<div class='ribbon red'><span>$28$ ++</phpdac>
								<phpdac>cmsrt.nvltokens use $41$+<?php return(localize('_POINTS', getlocal())) ?>++</phpdac>
								<phpdac>cmsrt.nvltokens use $41$+</span></div>++</phpdac>
								<a data-rel="prettyphoto" href="$19$">
									<img class="img-responsive" alt="$0$" src="assets/images/blank.gif" data-echo="$18$" />
								</a>
							</div><!-- /.single-product-gallery-item -->
							
							<phpdac>shkatalogmedia.show_aditional_files use $10$++$0$+fpitemaddfiles</phpdac>	
							
						</div><!-- /.single-product-slider -->


						<div class="single-product-gallery-thumbs gallery-thumbs">

							<div id="owl-single-product-thumbnails">
								<a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="0" href="#slide1">
									<img width="67" alt="$0$" src="assets/images/blank.gif" data-echo="$17$" />
								</a>

								<phpdac>shkatalogmedia.show_aditional_files use $10$++$0$+fpitemaddfiles-thumb</phpdac>

							</div><!-- /#owl-single-product-thumbnails -->

							<div class="nav-holder left hidden-xs">
								<a class="prev-btn slider-prev" data-target="#owl-single-product-thumbnails" href="#prev"></a>
							</div><!-- /.nav-holder -->
            
							<div class="nav-holder right hidden-xs">
								<a class="next-btn slider-next" data-target="#owl-single-product-thumbnails" href="#next"></a>
							</div><!-- /.nav-holder -->

						</div><!-- /.gallery-thumbs -->
						
						<!-- video -->
						<phpdac>cms.nvltokens use $45$+<br/><div class="videoWrapper"><iframe allowfullscreen="" frameborder="0" width="560 height="349" src="$45$"></iframe></div>++</phpdac>

					</div><!-- /.single-product-gallery -->
				</div><!-- /.gallery-holder (single-product-gallery)-->
				

                <!--hpdac>cms.include_part use /parts/section/single-product-detail.php+++media-center</phpda-->
				<div class="no-margin col-xs-12 col-sm-7 body-holder">
					<div class="body">
						<div class="star-holder inline"><div class="star" data-score="$7$"></div></div>
						<div class="availability"><label>
						<phpdac>cms.slocale use _AVAILABILITY</phpdac>:
						</label>
						<span class="available">
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
						</span></div>

						<div class="title"><a href="$8$">$0$</a></div>
						<div class="brand">$29$</div>

						<div class="buttons-holder">
							<a class="btn-add-to-wishlist" href="wishadd/$10$/"><phpdac>cms.slocale use _ADDTOWISHLIST</phpdac></a>
							<a class="btn-add-to-compare" href="cmpadd/$10$/"><phpdac>cms.slocale use _ADDTOCOMPARE</phpdac></a>
						</div>						

						<div class="excerpt">
							<p>$1$</p>
						</div>
						
						$25$
						<div class="fb-like" data-href="<phpdac>cmsrt.php_self use 1</phpdac>" data-width="100" data-height="10" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="false" data-send="true"></div>	

						<div class="qnt-holder">
							<div class="le-quantity">
							<form>
								<a class="minus" href="#reduce" onclick="preselqty('PRESELQTY',-1,1)"></a>
								<input id="PRESELQTY" name="PRESELQTY" readonly="readonly" type="text" value="<phpdac>shcart.getCartItemQty use $10$+1</phpdac>" />
								<a class="plus" href="#add" onclick="preselqty('PRESELQTY',1,24)"></a>
							</form>
							</div>
							<!--hpdac>cms.nvl use shcart.agentIsIE+$6$+<a id="addto-cart" href="javascript:void(0)" onclick="addtocart('PRESELQTY','$27$');" class="le-button huge">Στο καλάθι</a>+1</phpda-->
							<phpdac>
							cmsrt.nvl use shcart.agentIsIE+
								$6$
								+
								<?php 
									if (floatval(str_replace(',','.','$5$'))>0.0) {
										$ret = '<a id="addto-cart" href="javascript:void(0)" onclick="addtocart(\'PRESELQTY\',\'$27$\');" class="le-button huge">';
										$ret.= localize('_INCART', getlocal());
										$ret.='</a>';
									}
									else {
										$ret = '<a id="addto-cart" href="javascript:void(0)" onclick="#" class="le-button huge">';
										$ret.= localize('_ZEROVAL', getlocal());
										$ret.='</a>';
									}
									return $ret;
								?>
								+1
							</phpdac>
							<!--6-->
						</div><!-- /.qnt-holder -->
						
						<!-- start qty policy -->
						$12$
						<!-- end qty policy -->
						
						<!-- fb quote -->
						<div class="fb-quote"></div>
						
					</div><!-- /.body -->

				</div><!-- /.body-holder (single-product-detail)-->				

            </div><!-- /.row #single-product -->
        </div>    
<phpdac>cms.setGlobal use containerClass+no-container</phpdac>
<phpdac>cms.setGlobal use hasSidebar+1</phpdac>

<!-- ========================================= SINGLE PRODUCT TAB ========================================= -->
<div id="$10$-details">
<section id="single-product-tab">
    <div class="<phpdac>cms.nvldac2 use containerClass+cms.getGlobal:containerClass+cms.paramload:MEDIA-CENTER|containerClass+</phpdac>">
        <div class="tab-holder">
            
            <ul class="nav nav-tabs simple" >
				
				<li class="active"><a href="#description" data-toggle="tab"><phpdac>cms.slocale use _DESCRIPTION</phpdac></a></li>			
				<li><a href="#additional-info" data-toggle="tab"><phpdac>cms.slocale use _ADDITIONALINFO</phpdac></a></li>
                <li><a href="#reviews" data-toggle="tab"><phpdac>cms.slocale use _REVIEWS</phpdac> (<span class="fb-comments-count" data-href="<phpdac>cmsrt.paramload use SHELL+urlbase</phpdac><phpdac>cmsrt.php_self</phpdac>"></span>)</a></li>				
            </ul><!-- /.nav-tabs -->

            <div class="tab-content">

                <div class="tab-pane active" id="description">
                    <p>					
						$53$
					</p>		
                    <div class="meta-row">
                        <div class="inline">
                            <label>SKU:</label>
                            <span><phpdac>cms.nvl use $29$+$10$+$29$+</phpdac></span>
                        </div><!-- /.inline -->

                        <!--span class="seperator">/</span-->

                        <div class="inline">
                            <label><phpdac>cms.slocale use CATEGORY</phpdac>:</label>
                            <span><a href="$14$">$15$</a></span>
                        </div><!-- /.inline -->

                        <!--span class="seperator">/</span-->

                        <div class="inline">
                            <label><phpdac>cms.slocale use _TAGS</phpdac>:</label>
                            $47$
                        </div><!-- /.inline -->
                    </div><!-- /.meta-row -->
                </div><!-- /.tab-pane #description -->			

                <div class="tab-pane" id="additional-info">
                    <ul class="tabled-data">					
                        <li>
							<label><phpdac>cms.slocale use _MANUFACTURERALT</phpdac></label>
                            <div class="value">$32$</div>
                        </li>
                        <li>
                            <label><phpdac>cms.slocale use _SIZEALT</phpdac></label>
                            <div class="value">$23$</div>
                        </li>						
                        <li>
                            <label><phpdac>cms.slocale use _COLORALT</phpdac></label>
                            <div class="value">$24$</div>
                        </li>
                        <li>
                            <label><phpdac>cms.slocale use _WEIGHTALT</phpdac></label>
                            <div class="value">$20$</div>
                        </li>
                        <li>
                            <label><phpdac>cms.slocale use _DIMENSIONSALT</phpdac></label>
							<div class="value">$22$</div>
                        </li>						
                        <li>
                            <label><phpdac>cms.slocale use _VOLUMEALT</phpdac></label>
							<div class="value">$21$</div>
							<!--label>Διαθεσιμότητα</label-->
                            <!--div class="value"><-hpdac>cms.nvldecode use $31$+1-3 ημέρες παράδοσης+Διαθέσιμο+0+$22$</phpda-></div-->
                        </li>							
                    </ul><!-- /.tabled-data -->

                    <div class="meta-row">
                        <div class="inline">
                            <label>SKU:</label>
                            <span><phpdac>cms.nvl use $29$+$10$+$29$+</phpdac></span>
                        </div><!-- /.inline -->

                        <!--span class="seperator">/</span-->

                        <div class="inline">
                            <label><phpdac>cms.slocale use CATEGORY</phpdac>:</label>
                            <span><a href="$14$">$15$</a></span>
                        </div><!-- /.inline -->

                        <!--span class="seperator">/</span-->

                        <div class="inline">
                            <label><phpdac>cms.slocale use _TAGS</phpdac>:</label>
                            $47$
                        </div><!-- /.inline -->
                    </div><!-- /.meta-row -->
                </div><!-- /.tab-pane #additional-info -->	

				<div class="tab-pane" id="reviews">
					<div class="fb-comments" data-href="<phpdac>cmsrt.paramload use SHELL+urlbase</phpdac><phpdac>cmsrt.php_self</phpdac>#configurator" data-numposts="5"></div>				
				</div><!-- /.tab-content -->					

            </div><!-- /.tab-content -->		

        </div><!-- /.tab-holder -->
    </div><!-- /.container -->
</section><!-- /#single-product-tab -->
</div>

<div id="$10$-relative">
</div>
<!-- ========================================= SINGLE PRODUCT TAB : END ========================================= -->						