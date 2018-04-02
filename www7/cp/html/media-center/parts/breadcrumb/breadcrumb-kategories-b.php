<!-- ========================================= BREADCRUMB B ========================================= -->
<div id="breadcrumb-alt">
    <div class="container">
        <div class="breadcrumb-nav-holder minimal">
            <ul>
                <li class="dropdown breadcrumb-item">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <phpdac>cms.paramload use INDEX+title</phpdac>
                    </a>
                    <ul class="dropdown-menu">
                        <phpdac>shkategories.show_selected_tree use klist++1+SHOW++ins_left_nav+++fpcatsleft.htm+</phpdac>
                    </ul>
                </li>
				<phpdac>shkategories.tree_navigation use klist++1+fpkatnav-dropdown.htm</phpdac>
				
				<phpdac>
				cmsrt.nvl use shcart.status+
					<?php  
						$incart = ((GetParam('FormAction')== _v('shcart.checkout')) ||
								   (GetParam('FormAction')== _v('shcart.order')) ||
								   (GetParam('FormAction')== _v('shcart.submit'))) ? true : false;
									
						$title = (_v('shcart.status')==2) ? '_SUBMITORDER' : '_CHECKOUT' ;
						return ($incart) ? str_replace('<TITLE/>', localize($title, getlocal()), '
											<li class="breadcrumb-item">
												<a href="cart/"><TITLE/></a>
											</li>') : null;
					?>
					++1|2
				</phpdac>
            </ul>
        </div><!-- /.breadcrumb-nav-holder -->
    </div><!-- /.container -->
</div><!-- /#breadcrumb-alt -->
<!-- ========================================= BREADCRUMB B : END ========================================= -->