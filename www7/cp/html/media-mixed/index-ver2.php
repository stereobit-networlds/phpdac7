		<phpdac>cms.nvldac2param use CMS.megamenu+cms.include_part:/mm/mega-menu.php++</phpdac>

		<phpdac>cms.nvl use headerStyle+<!-- NO BR -->+<!-- BR --><div id='header'></div><br/>+1</phpdac>
		<phpdac>cms.nvldac2 use headerStyle+cms.include_part:/parts/navigation/top-menu-bar.php::cms.include_part:/parts/section/header.php+cmsrt.include_part:/parts/navigation/horizontal-menu.php::cms.include_part:/parts/breadcrumb/breadcrumb.php+1</phpdac>
	
		<!--phpdac>cms.include_part_arg use /pages/<mc_page>.php</phpda-->
		<phpdac>cms.nvldac2 use cmsrt.MC_CURRENT_PAGE+cms.include_part_arg:/pages/<mc_page>_rtl.php+cms.include_part_arg:/pages/<mc_page>.php+klist|kshow|product|products|kfilter|search</phpdac>
		
		<phpdac>cms.include_part use /parts/section/footer.php</phpdac>
		