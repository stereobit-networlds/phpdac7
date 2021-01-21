<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="<phpdac>cms.iso_language</phpdac>"">
<!--<![endif]-->
   <phpdac>frontpage.include_part use /parts/sufee-head.php+++sufee</phpdac>
  <body>
    <!--hpdac>frontpage.include_part use /parts/sufee-leftpanel.php+++sufee</phpda-->	
	<!--hpdac>frontpage.include_part use /parts/sufee-rightpanel.php+++sufee</phpda-->	
	<?SUFEE/INDEX?>
    <phpdac>frontpage.include_part use /parts/sufee-javascript.php+++sufee</phpdac>
   <script>
	function joincat() {
		var itm = arguments[0]; 
		var join = arguments[1];
		$('#saverel').load("cpitemrel.php?t=cpireljoincat&item="+itm+"&jcat="+join);}
	function joinitem() {
		var itm = arguments[0]; 
		var join = arguments[1];
		$('#saverel').load("cpitemrel.php?t=cpireljoinitem&item="+itm+"&jitem="+join);}		
   </script>  
  </body>
</html>
