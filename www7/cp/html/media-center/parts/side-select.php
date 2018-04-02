<!-- side-select -->		
	<div class="config open">
		<div class="config-options">
			<div class="widget">
				<h1 class="border"><phpdac>cms.slocale use _recommended</phpdac></h1>
				<ul class="product-list">		
					<phpdac>shkatalogmedia.show_menu_items use 9+1+fpproducts-featured-sidebar+1+sidefeatured</phpdac>
				</ul><!-- /.product-list -->
			</div><!-- /.widget -->		
		</div>
		<a class="show-theme-options" href="#"><i class="fa fa-info"></i></a>
	</div>
	
	
	<script>
		$(document).ready(function(){ 
			$('.show-theme-options').click(function(){
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function() {
		   $('.show-theme-options').delay(2000).trigger('click');
		});
	</script>	
<!-- end of side-select -->	