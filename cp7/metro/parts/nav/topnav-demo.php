       <div class="navbar-inner">
           <div class="container-fluid">
               <!--BEGIN SIDEBAR TOGGLE-->
               <div class="sidebar-toggle-box hidden-phone">
                   <div class="icon-reorder tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
               </div>
               <!--END SIDEBAR TOGGLE-->
               <!-- BEGIN LOGO -->
               <a class="brand" href="cp.php">
                   <img src="img/logo.png" alt="Metro Lab" />
               </a>
               <!-- END LOGO -->
               <!-- BEGIN RESPONSIVE MENU TOGGLER -->
               <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="arrow"></span>
               </a>
               <!-- END RESPONSIVE MENU TOGGLER -->
			   
			   <!-- BEGIN NOTIFICATION -->
			   <phpdac>frontpage.include_part use /parts/nav/notifications-demo.php+++metro</phpdac>
               <!-- END  NOTIFICATION -->

               <div class="top-nav ">
                   <ul class="nav pull-right top-menu" >
                       <li id="console_exit" class="dropdown mtop5">
                           <a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="<phpdac>fronthtmlpage.nvldac2 use rcpmenu.turldecoded+rcpmenu.exiturl+fronthtmlpage.echostr:/+</phpdac>" data-original-title="<phpdac>frontpage.slocale use _exit</phpdac>">
                               <i class="icon-reply-all"></i>
                           </a>
                       </li>
                       <li id="eshop_exit" class="dropdown mtop5">
                           <a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="index/" data-original-title="eshop">
                               <i class="icon-shopping-cart"></i>
                           </a>
                       </li>
					   <!-- BEGIN SUPPORT -->
                       <li class="dropdown mtop5">
                           <a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="#" onClick="openmsg();" data-original-title="Chat">
                               <i class="icon-comments-alt"></i>
                           </a>
                       </li>
                       <li class="dropdown mtop5">
                           <a id="startTour" class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="<phpdac>frontpage.slocale use _tour</phpdac>">
                               <i class="icon-headphones"></i>
                           </a>
                       </li>					   				   
                       <!-- END SUPPORT -->
					   
                       <!-- BEGIN USER LOGIN DROPDOWN -->
					   <phpdac>frontpage.include_part use /parts/nav/user-dropdown-demo.php+++metro</phpdac>
                       <!-- END USER LOGIN DROPDOWN -->
                   </ul>
                   <!-- END TOP NAVIGATION MENU -->
               </div>
           </div>
       </div>