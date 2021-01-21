<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="<phpdac>cms.iso_language</phpdac>"">
<!--<![endif]-->
   <phpdac>cms.include_part use /parts/sufee-head.php+++sufee</phpdac>
  <body>
    <!--hpdac>cms.include_part use /parts/sufee-leftpanel.php+++sufee</phpda-->	
	<!--hpdac>cms.include_part use /parts/sufee-rightpanel.php+++sufee</phpda-->	
	<?SUFEE/INDEX?>
    <phpdac>cms.include_part use /parts/sufee-javascript.php+++sufee</phpdac>

 	<script language="Javascript" type="text/javascript" src="../js/edit_area/edit_area_full.js"></script>
	<script language="Javascript" type="text/javascript">
		// initialisation
		editAreaLoader.init({
			id: "crondata"	
			,start_highlight: true	
			,allow_resize: "both"
			,allow_toggle: false
			,word_wrap: true
			,language: "en"
			,syntax: "php"
			,toolbar: "undo, redo, |, select_font, |, change_smooth_selection, highlight, reset_highlight"			
			,replace_tab_by_spaces: 4
			,save_callback: "submitform"
		});	
		
		function jobcode() {var str = arguments[0]; $('#jobcode').load("cpcron.php?t=cpjobcode&id="+str);}	
		function submitform() { document.form1.submit();}
   </script>  
  </body>
</html>
