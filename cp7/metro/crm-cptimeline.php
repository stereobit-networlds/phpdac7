	                        <div class="bs-docs-example">
                                <h4>$0$</h4>
                                <div class="navbar">
                                    <div class="navbar-inner">
                                        <div class="container">
                                            <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </a>
                                            <!--a href="cp.php?t=cp&year=$1$&month=$2$" class="brand">$1$ $2$</a-->
                                            <div class="nav-collapse collapse navbar-responsive-collapse">
                                                <ul class="nav">
                                                    <!--li class="active"><a href="#">Home</a></li>
                                                    <li><a href="#">Link</a></li>
                                                    <li><a href="#">Link</a></li-->													
                                                </ul>
                                                <form method="post" action="#" class="navbar-search pull-left">
                                                    <!--input type="text" placeholder="Search" class="search-query input-medium"-->
									                <div class="id="input-prepend">
														<span class="add-on"><i class="icon-calendar"></i></span>
														<input id="reservation" name="rdate" type="text" class=" m-ctrl-medium" />
														<input type="hidden" name="FormAction" value="<phpdac>fronthtmlpage.echostr use t</phpdac>" />
														<input type="hidden" name="v" value="<phpdac>rccrmtrace.currentVisitor</phpdac>">														
													</div>
                                                </form>
												<a href="#" class="brand">$7$</a>												
												<ul class="nav pull-right">
                                                    <li class="dropdown">
                                                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">$3$ <b class="caret"></b></a>
                                                        <ul class="dropdown-menu">'.
                                                            $4$
                                                        </ul>
                                                    </li>
													<a href="cpcrmtrace.php?t=<phpdac>fronthtmlpage.echostr use t</phpdac>&v=<phpdac>rccrmtrace.currentVisitor</phpdac>&year=$1$" class="brand">$1$</a>
													<li class="divider-vertical"></li>
                                                    <li class="dropdown">
                                                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">$5$ <b class="caret"></b></a>
                                                        <ul class="dropdown-menu">'.
                                                            $6$
                                                        </ul>
                                                    </li>												
                                                    <a href="cpcrmtrace.php?t=<phpdac>fronthtmlpage.echostr use t</phpdac>&v=<phpdac>rccrmtrace.currentVisitor</phpdac>&year=$1$&month=$2$" class="brand">$2$</a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>