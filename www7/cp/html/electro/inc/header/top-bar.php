<div class="top-bar">
	<div class="container">
		<nav>
			<ul id="menu-top-bar-left" class="nav nav-inline pull-left animate-dropdown flip">
				<li class="menu-item animate-dropdown"><a title="Welcome to Worldwide Electronics Store" href="#">Welcome to Worldwide Electronics Store</a></li>
			</ul>
		</nav>

		<nav>
			<ul id="menu-top-bar-right" class="nav nav-inline pull-right animate-dropdown flip">
				<li class="menu-item animate-dropdown"><a title="Company" href="company.php"><i class="ec ec-map-pointer"></i><phpdac>cms.slocale use _company</phpdac></a></li>
				<li class="menu-item animate-dropdown"><a title="Store Locator" href="contact.php"><i class="ec ec-map-pointer"></i><phpdac>cms.slocale use _contact</phpdac></a></li>
				
				<li class="menu-item animate-dropdown"><a title="Track Your Order" href="index.php?page=track-your-order"><i class="ec ec-transport"></i>Track Your Order</a></li>
				<li class="menu-item animate-dropdown"><a title="Shop" href="index.php?page=shop"><i class="ec ec-shopping-bag"></i>Shop</a></li>

				<phpdac>cms.nvl use UserName+<li class="menu-item animate-dropdown"><a href="signup/"><i class="ec ec-user"></i>++</phpdac>
				<phpdac>cms.nvldac2 use UserName+shusers.get_cus_name:1++</phpdac>
				<phpdac>cms.nvl use UserName+</a></li>++</phpdac>

                <phpdac>cms.nvl use UserName++<li class="menu-item animate-dropdown"><a href="signup/"><i class="ec ec-user"></i>+</phpdac>
				<phpdac>cms.nvldac2 use UserName++cms.slocale:_SIGNUP</phpdac>
				<phpdac>cms.nvl use UserName++</a></li>+</phpdac>

				<li class="menu-item animate-dropdown"><phpdac>shlogin.myf_login_logout use +<i class="ec ec-user"></i></phpdac></li>
				
				<li class="menu-item animate-dropdown">
				<phpdac>cms.nvl use cmsrt.language+<a href="lan/0/"><i class="ec ec-comment"></i>+<a href="lan/1/"><i class="ec ec-comment"></i>+Greek</phpdac>
				<phpdac>cms.nvldac2 use cmsrt.language+cms.slocale:English+cms.slocale:Greek+Greek</phpdac>
				</a></li>
				<!--li class="menu-item animate-dropdown"><phpdac>cms.echostr use cmsrt.language</phpdac></li-->
				
				<li class="menu-item animate-dropdown"><a href="index.php"><i class="ec ec-tvs"></i><phpdac>cms.slocale use _HOME</phpdac></a></li>
			</ul>
		</nav>
	</div>
</div><!-- /.top-bar -->
