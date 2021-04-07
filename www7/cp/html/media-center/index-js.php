	<script src="assets/js/jquery-1.10.2.min.js"></script>
	<script src="assets/js/jquery-migrate-1.2.1.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	
	<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->
	<phpdac>cms.nvlparam use CMS.megamenu+<script type="text/javascript" src="js/mega-menu.js"></script>++</phpdac>
	
	<phpdac>cms.nvl use cmsrt.MC_CURRENT_PAGE+<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk1w69McHeTmaXIPkOOFcKLnR8l_COWaA"></script><script src="assets/js/gmap3.min.js"></script>++contact|sendamail</phpdac>
	<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	<script src="assets/js/css_browser_selector.min.js"></script>
	<script src="assets/js/echo.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.raty.min.js"></script>
    <script src="assets/js/jquery.prettyPhoto.min.js"></script>
    <script src="assets/js/jquery.customSelect.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="assets/js/scripts.min.js"></script>

	<script type="text/javascript">
	/*$(document).ready(function(){
		$.cookieBar({ message: '<phpdac>cmsrt.slocale use _cookiesmsg</phpdac>', policyButton: true, policyText: 'Περισσότερα', policyURL:'cookies-policy.php', acceptButton: true, acceptText: '.', element: 'body', autoEnable: false, acceptOnScroll: 100, acceptFunction: function(cookieValue){if(cookieValue!='enabled' && cookieValue!='accepted') start();}
		});
		
		<!--hpdac>jsdialog.startDialog</phpda-->
        <!--setInterval(function() {<-hpdac>jsdialogstream.streamDialog use jsdtime</phpda-}, 30000);-->			
		
	});	*/
	function start() {}
    </script>
	
	<script type="text/javascript" src="js/zebra/zebra_dialog.min.js"></script>

	<phpdac>cmsrt.nvldac2 use cmsrt.MC_CURRENT_PAGE+cmsrt.included:addtocart-side-select++addtocart</phpdac>

<phpdac>cms.nvlparam use CMS.stickymenu+
	<script>
function sticktothetop() {
    var window_top = $(window).scrollTop();
    var top = $('#stick-position').offset().top;
    if (window_top > top) {
        $('#stick-element').addClass('stick');
        $('#stick-position').height($('#stickThis').outerHeight());
    } else {
        $('#stick-element').removeClass('stick');
        $('#stick-position').height(0);
    }
}
$(function() {
    $(window).scroll(sticktothetop);
    sticktothetop();
});	
	</script>
++1</phpdac>
	