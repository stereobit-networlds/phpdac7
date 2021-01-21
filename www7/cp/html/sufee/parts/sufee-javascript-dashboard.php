                               
	<script src="vendors/popper.js/dist/umd/popper.min.js"></script> 

    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
                     
	<script src="../js/zebra/zebra_dialog.js"></script>					 
	<script src="../js/toastr/toastr.min.js"></script> 
	                    
	<script type="text/javascript">
    <phpdac>rcpmenu.jAjaxRead use 1++
			toastr.info('Ajax loaded!')
			</phpdac>	
				
toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-bottom-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};	
    <!--script src="assets/js/main.js"></script-->
    <!-- removed strict mode "assets/js/main.js -->
	[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
		new SelectFx(el);
	} );

	$('.selectpicker').selectpicker;


	$('#menuToggle').on('click', function(event) {
		$('body').toggleClass('open');
	});

	$('.search-trigger').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').addClass('open');
	});

	$('.search-close').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').removeClass('open');
	});		
	
function openmsg() {
	var viewportwidth = document.documentElement.clientWidth; var viewportheight = document.documentElement.clientHeight;
	window.resizeBy(-450,0); window.moveTo(0,0); window.open("https://el-gr.messenger.com/login?next=https%3A%2F%2Fwww.messenger.com%2Ft%2Fstereobit.gr%2F","messenger","height=680,width=450,left="+(viewportwidth-450)+",top=0,scrollbar=0");
};				
</script> 

    <!--  Chart js -->
    <!--script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/init-scripts/chart-js/chartjs-init.js"></script-->
    
    <!--  flot-chart js -->
    <!--script src="vendors/flot/excanvas.min.js"></script>
    <script src="vendors/flot/jquery.flot.js"></script>
    <script src="vendors/flot/jquery.flot.pie.js"></script>
    <script src="vendors/flot/jquery.flot.time.js"></script>
    <script src="vendors/flot/jquery.flot.stack.js"></script>
    <script src="vendors/flot/jquery.flot.resize.js"></script>
    <script src="vendors/flot/jquery.flot.crosshair.js"></script>
    <script src="assets/js/init-scripts/flot-chart/curvedLines.js"></script>
    <script src="assets/js/init-scripts/flot-chart/flot-tooltip/jquery.flot.tooltip.min.js"></script>
    <script src="assets/js/init-scripts/flot-chart/flot-chart-init.js"></script-->
    
    <!--  peity chart -->
    <!--script src="vendors/peity/jquery.peity.min.js"></script>
    <script src="assets/js/init-scripts/peitychart/peitychart.init.js"></script-->
    
    <!-- forms -->
    <!--script src="vendors/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script-->
    
    <!--  forms advanced -->
<!--script src="vendors/chosen/chosen.jquery.min.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });
</script-->    

	<!-- index (dashboard:1st level call) -->
    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script>
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
    </script>    
