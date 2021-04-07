				<header class="page-header">
					<h1 class="page-title"><phpdac>shkategories.getcurrentkategory</phpdac></h1>
					<!--p class="woocommerce-result-count"><span><phpdac>shkatalogmedia.dataSetValue</phpdac>-<phpdac>shkatalogmedia.dataSetValue use +1</phpdac></span> <phpdac>cms.slocale use _OF</phpdac> <span><phpdac>shkatalogmedia.dataSetValue use 1</phpdac></span></p-->
				</header>
				
				<!--hpdac>shkatalogmedia.show_filtering</phpda-->

				<div class="shop-control-bar">
					<ul class="shop-view-switcher nav nav-tabs" role="tablist">
						<li class="nav-item"><a class="nav-link <phpdac>cms.nvl use shkatalogmedia.isListView++active+1</phpdac>" data-toggle="tab" title="Grid View" href="#grid" onClick="cc('viewmode','grid','1');"><i class="fa fa-th"></i></a></li>
						<!--li class="nav-item"><a class="nav-link " data-toggle="tab" title="Grid Extended View" href="#grid-extended"><i class="fa fa-align-justify"></i></a></li-->
						<li class="nav-item"><a class="nav-link <phpdac>cms.nvl use shkatalogmedia.isListView+active++1</phpdac>" data-toggle="tab" title="List View" href="#list-view" onClick="cc('viewmode','list','1');"><i class="fa fa-list"></i></a></li>
						<!--li class="nav-item"><a class="nav-link " data-toggle="tab" title="List View Small" href="#list-view-small"><i class="fa fa-th-list"></i></a></li-->
					</ul>
					
					<!--hpdac>cmsrt.include_part use /inc/components/shop-control-bar.php'</phpda-->
					<phpdac>shkatalogmedia.show_asceding use ++orderby</phpdac>		
				</div>

				<div class="tab-content">
					<!--hpdac>cmsrt.include_part use /inc/components/product-grid.php'</phpda-->
					<!--hpdac>cmsrt.include_part use /inc/components/product-grid-ext.php'</phpda-->
					<!--hpdac>cmsrt.include_part use /inc/components/product-list-view.php'</phpda-->
					<!--hpdac>cmsrt.include_part use /inc/components/product-list-view-small.php'</phpda-->
					
					<div role="tabpanel" class="tab-pane <phpdac>cms.nvl use shkatalogmedia.isListView++active+1</phpdac>" id="grid" aria-expanded="true">
						$0$
					</div>
					<!--div role="tabpanel" class="tab-pane" id="grid-extended" aria-expanded="true">
						0
					</div-->
					<div role="tabpanel" class="tab-pane <phpdac>cms.nvl use shkatalogmedia.isListView+active++1</phpdac>" id="list-view" aria-expanded="true">
						$1$
					</div>
					<!--div role="tabpanel" class="tab-pane" id="list-view-small" aria-expanded="true">
						1
					</div-->
				</div>		

				<!--hpdac>cmsrt.include_part use /inc/components/shop-control-bar-bottom.php'</phpda-->
