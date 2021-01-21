                               
	<script src="vendors/popper.js/dist/umd/popper.min.js"></script> 

    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
                     
	<script src="../js/zebra/zebra_dialog.js"></script>				 
	<script src="../js/toastr/toastr.min.js"></script> 
	                    
	<script type="text/javascript">
    <phpdac>rcpmenu.jAjaxRead use 1++
			toastr.info('Page Loaded!');
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