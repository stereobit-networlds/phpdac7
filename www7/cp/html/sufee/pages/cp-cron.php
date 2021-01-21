<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="<phpdac>cms.iso_language</phpdac>"">
<!--<![endif]-->
   <phpdac>cms.include_part use /parts/sufee-head.php+++sufee</phpdac>
  <body>
    <phpdac>cms.include_part use /parts/sufee-leftpanel.php+++sufee</phpdac>	
	<phpdac>cms.include_part use /parts/sufee-rightpanel.php+++sufee</phpdac>	
    <phpdac>cms.include_part use /parts/sufee-javascript.php+++sufee</phpdac>
   <script>
	function cronjobs() {
		var str = arguments[0]; 
		$('#cronjobs').load("cpcron.php?t=cpcronjobs&id="+str);
		scrollToTop();
	}
   </script>	
  </body>
</html>
