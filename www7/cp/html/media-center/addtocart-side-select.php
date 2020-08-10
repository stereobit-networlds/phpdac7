<!-- side-select -->		
	<div class="config open">
		<div class="config-options">
			<!--h4><phpdac>cms.slocale use _recommended</phpdac></h4-->
			<div class="widget">
				<!--h1 class="border"><phpdac>cms.slocale use _recommended</phpdac></h1-->
				<ul class="product-list">		
					<phpdac>shkatalogmedia.show_side_select use 3+1+fpproducts-featured-sidebar+1</phpdac>
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