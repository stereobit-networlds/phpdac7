        <header id="header" class="header sticky-top">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
						
                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-tasks"></i>
                                <span id="cptasksno" class="count bg-danger"></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <!--p class="red">You have <span id="cptasksno" >0</span> Tasks</p-->
                    
                                <div id="cptasks"></div>
                                <!--hpdac>rcpmenu.getEngineTailsList use 9+<a class="dropdown-item media bg-flat-color-1 cpfile" href="#$0$"><i class="fa fa-info"></i><p>$0$</p></a>++</phpda-->
                                
                                <!--a class="dropdown-item media bg-flat-color-1" href="#">
                                <i class="fa fa-check"></i>
                                <p>Server #1 overloaded.</p>
                                </a-->
								<a class='cplink' href="#Worker-0"><phpdac>cms.slocale use _allnotifications</phpdac></a>
                            </div>
                        </div>						

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span id="cpmessagesno" class="count bg-info"></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <!--p class="red">You have <span id="cpmessagesno" >0</span> Notifications</p-->
								
                                <div id="cpmessages"></div>
                                
                                <!--a class="dropdown-item media bg-flat-color-1" href="#">
                                <i class="fa fa-check"></i>
                                <p>Server #1 overloaded.</p>
                                </a-->
								<a class='cplink' href="#/sufee/cp-cmsactions.html"><phpdac>cms.slocale use _allnotifications</phpdac></a>
                            </div>
                        </div>

                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-email"></i>
                                <span id="cpinboxno" class="count bg-primary"></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <!--p class="red">You have <span id="cpinboxsno">0</span> Mails</p-->
								
								<div id="cpinbox"></div>	
								
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Jonathan Smith</span>
                                    <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                </span>
                                </a>
								
								<a class='cplink' href="#/sufee/cp-cmsevents.html"><phpdac>frontpage.slocale use _allnotifications</phpdac></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">				   				
					
                    <div class="user-area dropdown float-right">
					
						<!--hpdac>cms.include_part use /parts/sufee-rightpanel-header-user-dropdown.php+++sufee</phpda-->
										
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
							<!--button type="button" class="btn btn-outline-primary float-right"><i class="fa fa-user"></i></button-->
                        </a>

                        <div class="user-menu dropdown-menu">
							<a class="nav-link" href="cp.php?t=lang&langsel=0"><i class="fa fa-desktop"></i> <phpdac>cms.slocale use English</phpdac></a>
							<a class="nav-link" href="cp.php?t=lang&langsel=1"><i class="fa fa-desktop"></i> <phpdac>cms.slocale use Greek</phpdac></a>
                            <a class="nav-link" href="cpconfig.php?cpart=INDEX"><i class="fa fa-user"></i> <phpdac>cms.slocale use _myprofile</phpdac></a>
                            <a class="nav-link" href="cpconfig.php"><i class="fa fa-cog"></i> <phpdac>cms.slocale use _config</phpdac></a>
                            <a class="nav-link" href="#" onClick="top.location.href='../dologout/';"><i class="fa fa-power-off"></i> <phpdac>cms.slocale use _logout</phpdac></a>							
                        </div>
                    </div>

                    <!--div class="language-select dropdown" id="language-select">					
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-us"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language">
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-fr"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-it"></i>
                            </div>
                        </div>
                    </div-->
					
					<button type="button" class="btn btn-link float-right" href="#" onClick="top.location.href='<phpdac>rcpmenu.exiturl</phpdac>';">
						<i class="fa fa-reply-all"></i>
					</button>
					<button type="button" class="btn btn-link float-right" href="#" onClick="openmsg();">
						<i class="fa fa-comments"></i>
					</button>
					<button type="button" class="btn btn-link float-right" id="startTour" >
						<i class="fa fa-headphones"></i>
					</button>					

                </div>
            </div>

        </header><!-- /header -->
