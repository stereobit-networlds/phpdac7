<div id="stick-here"></div>
<!--div id="stickThis">Sticky note</div-->
<div id="stickThis">
<!-- ========================================= NAVIGATION ========================================= -->
<nav id="top-megamenu-nav" class="megamenu-vertical animate-dropdown">
    <div class="container">
        <div class="yamm navbar">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mc-horizontal-menu-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div><!-- /.navbar-header -->
            <div class="collapse navbar-collapse" id="mc-horizontal-menu-collapse">
                <ul class="nav navbar-nav">                            
					<!--hpdac>cmsmenu.render use +fpmenu+li</phpda-->
					<phpdac>cmsmenu.callMenu use menu+fpmenu+li</phpdac>
                </ul><!-- /.navbar-nav -->
            </div><!-- /.navbar-collapse -->
        </div><!-- /.navbar -->
    </div><!-- /.container -->
</nav><!-- /.megamenu-vertical -->
<!-- ========================================= NAVIGATION : END ========================================= -->
</div>
<!--
<style>
#stick-position {
	visibility: hidden; //try to hide a litle space ...no!!
	//position: absolute; !!
	//display:none;!!
}	
#stickThis {
    /*padding: 5px;
    background-color: #fff;
    font-size: 1.5em;*/
    width: 100%;
    /*text-align: center;
    font-weight: bold;
    border: 2px solid #444;
    -webkit-border-radius: 10px;
    border-radius: 10px;*/
}
#stickThis.stick {
    margin-top: 0;
    position: fixed;
    top: -40px;
    z-index: 9999;
    /*-webkit-border-radius: 0 0 10px 10px;
    border-radius: 0 0 10px 10px;*/
}
</style>	

<script>
function sticktothetop() {
    var window_top = $(window).scrollTop();
    var top = $('#stick-here').offset().top;
    if (window_top > top) {
        $('#stickThis').addClass('stick');
        $('#stick-here').height($('#stickThis').outerHeight());
    } else {
        $('#stickThis').removeClass('stick');
        $('#stick-here').height(0);
    }
}
$(function() {
    $(window).scroll(sticktothetop);
    sticktothetop();
});	
	</script>
-->