    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/tether.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-hover-dropdown.min.js"></script>
    <script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="assets/js/echo.min.js"></script>
    <script type="text/javascript" src="assets/js/wow.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.easing.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.waypoints.min.js"></script>
    <script type="text/javascript" src="assets/js/electro.js"></script>	
	

	<phpdac>cms.nvlparam use CMS.megamenu+<script type="text/javascript" src="js/mega-menu.js"></script>++</phpdac>
	
	<!--hpdac>cms.nvl use cmsrt.MC_CURRENT_PAGE+<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk1w69McHeTmaXIPkOOFcKLnR8l_COWaA"></script><script src="assets/js/gmap3.min.js"></script>++contact|sendamail</phpda-->


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

	<!--hpdac>cmsrt.nvldac2 use cmsrt.MC_CURRENT_PAGE+cmsrt.included:addtocart-side-select++addtocart</phpda-->

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
	