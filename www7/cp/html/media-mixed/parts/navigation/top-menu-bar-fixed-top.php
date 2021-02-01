<!-- ============================================================= TOP NAVIGATION ============================================================= -->
<nav class="top-bar animate-dropdown navbar-fixed-top">
    <div class="container">
        <div class="col-xs-12 col-sm-6 no-margin">
            <ul>
                <li><a href="<phpdac>cms.paramload use SHELL+urlbase</phpdac>"><phpdac>frontpage.slocale use _HOME</phpdac></a></li>
                <li><a href="company.php"><phpdac>frontpage.slocale use _company</phpdac></a></li>
                <li><a href="contact.php"><phpdac>frontpage.slocale use _contact</phpdac></a></li>
            </ul>
        </div><!-- /.col -->

        <div class="col-xs-12 col-sm-6 no-margin">
            <ul class="right">
                <!--li class="dropdown">
                    <a class="dropdown-toggle"  data-toggle="dropdown" href="#change-language"><phpdac>frontpage.current_language</phpdac></a>
                    <ul class="dropdown-menu" role="menu" >
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="lan/0/"><phpdac>frontpage.slocale use English</phpdac></a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="lan/1/"><phpdac>frontpage.slocale use Greek</phpdac></a></li>
                    </ul>
                </li-->
				<phpdac>frontpage.nvl use UserName+<li>++</phpdac>
				<!--hpdac>shusers.get_user_name use +0</phpda-->
				<phpdac>frontpage.nvldac2 use UserName+shusers.get_cus_name++</phpdac>
				<phpdac>frontpage.nvl use UserName+</li>++</phpdac>
				
                <phpdac>frontpage.nvl use UserName++<li><a href="signup/">+</phpdac> <!-- signup/ -->
				<phpdac>frontpage.nvldac2 use UserName++frontpage.slocale:_SIGNUP</phpdac>
				<phpdac>frontpage.nvl use UserName++</a></li>+</phpdac>
				<!--li><a href="login/">Register</a></li-->
                <!--li><a href="login/">Login</a></li-->
				<li><phpdac>shlogin.myf_login_logout use 1</phpdac></li>
            </ul>
        </div><!-- /.col -->
    </div><!-- /.container -->
</nav><!-- /.top-bar -->
<!-- ============================================================= TOP NAVIGATION : END ============================================================= -->