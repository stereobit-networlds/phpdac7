    <!--php
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        $column=3;
    -->
<ul class="nav navbar-nav departments-menu animate-dropdown">
    <li class="nav-item dropdown <phpdac>cmsrt.nvl use mc_page+home-v2++home-v2</phpdac>">

        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="departments-menu-toggle" >Shop by Department</a>
        <ul id="menu-vertical-menu" class="dropdown-menu yamm departments-menu-dropdown">
		
		    <phpdac>cmsmenu.callMenu use mymenu+sidemenu-v2++fpmenu-submenu-v2</phpdac>
		
            <li class="highlight menu-item animate-dropdown active"><a title="Value of the Day" href="index.php?page=product-category">Value of the Day</a></li>
            <li class="highlight menu-item animate-dropdown"><a title="Top 100 Offers" href="index.php?page=home-v3">Top 100 Offers</a></li>
            <li class="highlight menu-item animate-dropdown"><a title="New Arrivals" href="index.php?page=home-v3-full-color-background">New Arrivals</a></li>

            <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2584 dropdown">
                <a title="Computers &amp; Accessories" href="index.php?page=product-category" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Computers &#038; Accessories</a>
                <phpdac>cmsrt.include_part use /inc/navigation/department-menu-megamenu.php</phpdac>
            </li>

            <li class="menu-item animate-dropdown"><a title="Software" href="index.php?page=product-category">Software</a></li>
            <li class="menu-item animate-dropdown"><a title="Office Supplies" href="index.php?page=product-category">Office Supplies</a></li>
            <li class="menu-item animate-dropdown"><a title="Computer Components" href="index.php?page=product-category">Computer Components</a></li>
            <li class="menu-item animate-dropdown"><a title="Car Electronic &amp; GPS" href="index.php?page=product-category">Car Electronic &#038; GPS</a></li>
            <li class="menu-item animate-dropdown"><a title="Printers &amp; Ink" href="index.php?page=product-category">Printers &#038; Ink</a></li>
        </ul>
    </li>
</ul>
