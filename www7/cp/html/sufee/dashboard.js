			$.getScript("vendors/chart.js/dist/Chart.bundle.min.js", function() {});
			$.getScript("assets/js/dashboard.js", function() {});
			$.getScript("assets/js/widgets.js", function() {});			
		
           	$.getScript("vendors/jqvmap/dist/jquery.vmap.min.js", function() {
				$.getScript("vendors/jqvmap/examples/js/jquery.vmap.sampledata.js", function() {
					$.getScript("vendors/jqvmap/dist/maps/jquery.vmap.world.js", function() {
						
						console.log('loaded dashboard content!!');
						
						$('#vmap').vectorMap({
							map: 'world_en',
							backgroundColor: null,
							color: '#ffffff',
							hoverOpacity: 0.7,
							selectedColor: '#1de9b6',
							enableZoom: true,
							showTooltip: true,
							values: sample_data,
							scaleColors: ['#1de9b6', '#03a9f5'],
							normalizeFunction: 'polynomial'
						});
					});
				});
			}); 
