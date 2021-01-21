      <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href=".">e-Enterprise</a>
        </div>
        
        <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dac7<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <phpdac>rcpmenu.getEngineTailsList use 9+<li><a class="file" href="#$0$">$0$</a></li></phpdac>
                            <li><a href="#" id="grepKeyword">Settings</a></li>
                        </ul>
                    </li>
                    <!--li><a href="#" id="grepKeyword">Settings</a></li>
                    <li><span class="navbar-text" id="grepspan"></span></li>
                    <li><span class="navbar-text" id="invertspan"></span></li-->
                    
                    <!-- BEGIN SETTINGS -->
                       <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <i class="icon-tasks"></i>
                               <span id="cptasksno" class="badge badge-important"></span>
                           </a>
                           <ul class="dropdown-menu extended tasks-bar">
							   <div id="cptasks"></div>
                               <li class="external">
                                   <a href="#"><phpdac>frontpage.slocale use _alltasks</phpdac></a>
                               </li>
                           </ul>
                       </li>
                       <!-- END SETTINGS -->
                       <!-- BEGIN NOTIFICATION DROPDOWN -->
                       <li class="dropdown" id="header_notification_bar">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <i class="icon-bell-alt"></i>
                               <span id="cpmessagesno" class="badge badge-warning"></span>
                           </a>
                           <ul class="dropdown-menu extended notification">
							   <div id="cpmessages"></div>
                               <li>
                                   <a href="cpcmsactions.php"><phpdac>frontpage.slocale use _allnotifications</phpdac></a>
                               </li>
                           </ul>
                       </li>
                       <!-- END NOTIFICATION DROPDOWN -->

                       <!-- BEGIN INBOX DROPDOWN -->
                       <li class="dropdown" id="header_inbox_bar">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <i class="icon-envelope-alt"></i>
                               <span id="cpinboxno" class="badge badge-important"></span>
                           </a>
                           <ul class="dropdown-menu extended inbox">
                               <div id="cpinbox"></div>
                               <li>
                                   <a href="cpcmsevents.php"><phpdac>frontpage.slocale use _allnotifications</phpdac></a>
                               </li>							   
                           </ul>
                       </li>
                    <!-- END INBOX DROPDOWN -->	                    
                    
                </ul>
                <!--p class="navbar-text navbar-right" id="current"></p-->
   
 
          <ul class="nav navbar-nav navbar-right">
            <!--li><a class='cplink' href="#/metro2/bootstrap-ajax-dashboard.html">Dashboard</a></li>
            <li><a class='cplink' href="#/metro2/bootstrap-theme-ajax-fetch.html">Settings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Help</a></li-->
            
					  <li class="dropdown mtop5">
                           <a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="#" onClick="top.location.href='<phpdac>rcpmenu.exiturl</phpdac>';" data-original-title="<phpdac>frontpage.slocale use _exit</phpdac>">
                               <i class="icon-reply-all"></i>
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
					   <phpdac>frontpage.include_part use /parts/nav/user-dropdown.php+++metro</phpdac>
                       <!-- END USER LOGIN DROPDOWN -->            
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>
