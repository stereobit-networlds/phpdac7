               <div id="top_menu" class="nav notify-row">
                   <ul class="nav top-menu">
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
               </div>