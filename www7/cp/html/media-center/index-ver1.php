		<phpdac>cms.nvldac2param use CMS.megamenu+cms.include_part:/mm/mega-menu.php++</phpdac>
	    <phpdac>cms.nvldac2param use CMS.megamenu+cms.include_part:/parts/navigation/top-menu-bar-empty-space.php+cms.include_part:/parts/navigation/top-menu-bar.php+</phpdac>

		<phpdac>cms.nvldac2 use headerStyle+cms.include_part:/parts/section/header.php::cms.include_part:/parts/breadcrumb/breadcrumb.php+cms.include_part:/parts/section/header-2.php+1</phpdac>
	
		<!--phpdac>cms.include_part_arg use /pages/<mc_page>.php</phpdac-->
		<phpdac>cms.nvldac2 use cmsrt.MC_CURRENT_PAGE+cms.include_part_arg:/pages/<mc_page>_rtl.php+cms.include_part_arg:/pages/<mc_page>.php+klist|kshow|product|products|kfilter|search</phpdac>
		<!--phpdac>cms.nvldac2param use CMS.rtl+cms.include_part_arg:/pages/<mc_page>_rtl.php+cms.include_part_arg:/pages/<mc_page>.php+1</phpdac-->		
					
		<phpdac>cms.include_part use /parts/section/footer.php</phpdac>
		