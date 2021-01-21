           	$.getScript("vendors/chosen/chosen.jquery.min.js", function() {
						
				$(".standardSelect").chosen({
					disable_search_threshold: 10,
					no_results_text: "Oops, nothing found!",
					width: "100%"
				});
				
				console.log('advanced forms js loaded!!!');
			});  
