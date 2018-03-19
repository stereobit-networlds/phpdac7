<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Massive subscription</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <!--link href="assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" /-->
   <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="css/style.css" rel="stylesheet" />
   <link href="css/style-responsive.css" rel="stylesheet" />
   <link href="css/style-default.css" rel="stylesheet" id="style_color" />

	<link href="../javascripts/themes/redmond/jquery-ui.custom.css" rel="stylesheet" /> 
	<link href="../javascripts/jqgrid/css/ui.jqgrid.css" rel="stylesheet" />  
	
    <!--script src="../javascripts/jquery.min.js"></script-->
	<script src="js/jquery-1.8.3.min.js"></script <!-- error in js buttons-->
	<script src="../javascripts/jqgrid/js/i18n/grid.locale-en.js"></script>			
	<script src="../javascripts/jqgrid/js/jquery.jqGrid.min.js"></script>
	<script src="../javascripts/themes/jquery-ui.custom.min.js"></script>    
   	
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top" onLoad="init()">
   <!-- BEGIN HEADER -->
	<phpdac>frontpage.include_part use /parts/header.php+++metro</phpdac>
   <!-- END HEADER -->
   <!-- BEGIN CONTAINER -->
   <div id="container" class="row-fluid">
      <!-- BEGIN SIDEBAR -->
		<phpdac>frontpage.include_part use /parts/sidebar.php+++metro</phpdac>
      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
			<phpdac>frontpage.include_part use /parts/pageheader.php+++metro</phpdac>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORMPORTLET-->
                    <div class="widget red">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Insert emails</h4>
                            <!--span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span-->
                        </div>
                        <div class="widget-body">
                            <!-- BEGIN FORM-->
                            <form name="subins" method="post" action="cpbulkmail.php" class="form-horizontal">

                            <div class="control-group">
                                <label class="control-label">Email Address</label>
                                <div id="edit_email" class="controls">
                                    <div class="input-icon left">
                                        <i class="icon-envelope"></i>
                                        <input class=" " name="submail" type="text" placeholder="Email Address" />
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Insert into</label>
                                <div id="select_ulist" class="controls">
                                    <select name="ulist" class="span6 " data-placeholder="Choose an existing mailing list" tabindex="1">
                                        <option value="">Select...</option>
										<phpdac>rcbulkmail.viewUList</phpdac>
                                    </select>
                                </div>
                            </div>
							
                            <div class="control-group">
                                <label class="control-label">New list</label>
                                <div id="edit_ulist" class="controls">
                                    <input name="ulistname" type="text" class="span6 " />
                                    <span class="help-inline">Enter a name for a new mailing list</span>
                                </div>
                            </div>							

                            <div class="control-group">
                                <label class="control-label">Text</label>
                                <div id="edit_subscribers" class="controls">
                                    <textarea name="csvmails" class="span6 " rows="3"></textarea>
                                </div>
                            </div>
							
							<div class="control-group">
                                <label class="control-label">Email separator</label>
                                <div id="edit_separator" class="controls">
                                    <div class="input-prepend">
                                        <span class="add-on">;</span>
										<input name="separator" class=" " type="text" placeholder="Email Separator" />
                                    </div>
                                </div>
                            </div>
							
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <!--button type="button" class="btn">Cancel</button-->
								<input type="hidden" name="FormName" value="cpsubscribe" />
								<input type="hidden" name="FormAction" value="cpsubscribe" />
								<!--hpdac>rccollections.postSubmit use cpsubscribe+Ok+btn</phpda-->
                            </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
            </div>			
			
			
            <div class="row-fluid">
                 <div id="subscribers_window" class="span12">
					 <?METRO/INDEX?>
                 </div>
            </div>
            <!-- END PAGE CONTENT-->
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->

   <!-- BEGIN FOOTER -->
	<phpdac>frontpage.include_part use /parts/footer.php+++metro</phpdac>
   <!-- END FOOTER -->

   <!-- BEGIN JAVASCRIPTS -->
   <!-- Load javascripts at bottom, this will reduce page load time -->
   
   <!--script src="js/jquery-1.8.3.min.js"></script-->
   
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->

   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script> 
   
	<script src="js/aSimpleTour.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#startTour').click(function(){
          options = {
            data : [
              { element : '#edit_email', 'tooltip' : 'Εισαγωγή e-mail', 'position' : 'TL', 'text' : '<h3>Εισαγωγή e-mails</h3><p>Εισάγετε μια απο τις διαθέσιμες διευθύνσεις ηλεκτρονικού ταχυδρομείου. Εισάγετε την διεύθυνση εδώ ακόμη και αν δεν έχετε στην κατοχή σας άλλα e-mails.</p>'  },
              { element : '#select_ulist', 'tooltip' : 'Επιλογή λίστας εισαγωγής', 'position' : 'TL', 'text' : '<h3>Λίστες εισαφωγής</h3><p>Επιλέξτε μια απο τις λίστες εισαγωγής που έχετε δημιουργήσει. </p>' },
              { element : '#edit_ulist', 'tooltip' : 'Νέα λίστα εισαγωγής', 'position' : 'L', 'text' : '<h3>Νέα λίστα</h3><p>Εισάγετε το όνομα της νέας λίστας που θέλετε να δημιουργήσετε. Το όνομα μιας λίστας χαρακτηρίζει τον τύπο παραληπτών. Τα προς εισαγωγή e-mails Θα χαρακτηριστούν με το όνομα αυτής της λίστας και θα μπορούν να ανακτηθούν μαζικά χρησιμοποιώντας την ονομασία της λίστας.</p>' },
              { element : '#edit_subscribers', 'tooltip' : 'Εισαγωγή λίστας e-mail', 'position' : 'BL', 'text' : '<h3>Εισαγωγή λίστας e-mail</h3><p>Τοποθετήστε την λίστα των e-mails που έχετε στην κατοχή σας, σε αυτή την περιοχή. Εισάγετε την λίστα είτε πληκτρολογώντας είτε κάνοντας copy-paste την λίστα που έχετε στην κατοχή σας.</p>' },
              { element : '#edit_separator', 'tooltip' : 'Σύμβολο διαχωρισμού λίστας', 'position' : 'BL' , 'text' : '<h3>Σύμβολο διαχωρισμού</h3><p>Εισάγετε το σύμβολο διαχωρισμού της λίστας που χρησιμοποιήθηκε στην περιοχή της λίστας των e-mails. Συνήθως το σύμβολο διαχωρισμού είναι το ελληνικό ερωτηματικό (;) ή το κόμμα (,) βάση του οποίου διαχωρίζονται τα e-mails.</p>' },
              { element : '#subscribers_window', 'tooltip' : 'Παράθυρο προβολής λίστας', 'position' : 'TL', 'text' : '<h3>Παράθυρο προβολής λίστας</h3><p>Εδώ θα δείτε όλα τα e-mails που καταχωρείτε στο σύστημα. Προβάλονται όλες οι λίστες και όλα τα e-mails που έχετε εισάγει. Μπορείτε να αναζητήσετε e-mails, να ταξινομήσετε ανα λίστα, να διαγράψετε κάποια απο αυτά ή να ή μεταβάλετε πληροφορίες με διπλό click στην γραμμή αναφοράς.</p>' },			  
              { element : '.form-actions', 'tooltip' : 'Πλήκτρο καταχώρησης', 'position' : 'TL', 'text' : '<h3>Καταχώρησηση</h3><p>Πατήστε το πλήκτρο καταχώρησης όταν έχετε συμπληρώσει όλα τα απαραίτητα πεδία.</p>' }
            ] ,
            controlsPosition : 'BR'
          };

          $.aSimpleTour(options);  
        });
      });
    </script>     
   <!-- END JAVASCRIPTS --> 

	<phpdac>frontpage.include_part use /parts/google-analytics.php+++metro</phpdac>
	<!-- e-Enterprise, stereobit.networlds (phpdac5) -->   
</body>
<!-- END BODY -->
</html>