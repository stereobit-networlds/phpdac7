		<phpdac>cms.nvldac2param use CMS.megamenu+cms.include_part:/mm/mega-menu.php|||media-center++</phpdac>

		<phpdac>cms.nvl use headerStyle+<!-- NO BR -->+<!-- BR --><div id='header'></div><br/>+1</phpdac>
		<phpdac>cms.nvldac2 use headerStyle+cms.include_part:/parts/navigation/top-menu-bar.php|||media-center::cms.include_part:/parts/section/header.php|||media-center+cmsrt.include_part:/parts/navigation/horizontal-menu.php|||media-center::cms.include_part:/parts/breadcrumb/breadcrumb.php|||media-center+1</phpdac>
	
		<!--phpdac>cms.include_part_arg use /pages/<mc_page>.php+++media-center</phpda-->
		<phpdac>cms.nvldac2 use cmsrt.MC_CURRENT_PAGE+cms.include_part_arg:/pages/<mc_page>_rtl.php|||media-center+cms.include_part_arg:/pages/<mc_page>.php|||media-center+klist|kshow|product|products|kfilter|search</phpdac>
		
		<phpdac>cms.include_part use /parts/section/footer.php+++media-center</phpdac>
		