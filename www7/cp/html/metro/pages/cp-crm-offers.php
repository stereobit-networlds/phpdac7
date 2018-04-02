<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Create document</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
    <link href="assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link href="css/style-default.css" rel="stylesheet" id="style_color" />

    <link href="assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
	
   <phpdac>fronthtmlpage.nvl use rccrmoffers.ckeditver+<script src="http://www.stereobit.gr/ckeditor/ckeditor.js"></script>+<script type="text/javascript" src="assets/ckeditor/ckeditor.js">+3</phpdac>
   </script>		

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
				
					<?METRO/INDEX?>
										
                    <div class="widget box purple">
                        <div class="widget-title">
                            <h4>
                                <i class="icon-reorder"></i> Create document</span>
                            </h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                        </span>
                        </div>
                        <div class="widget-body">
                            <form id="tForm" method="post" action="cpcrmoffers.php?t=cpsavedocument" class="form-horizontal">
								<input type="hidden" name="v" value="<phpdac>fronthtmlpage.echostr use rccrmoffers.visitor</phpdac>" />
								<input type="hidden" name="FormName" value="savedoc" />
								<input type="hidden" name="FormAction" value="cpsavedocument" />
								
                                <div id="tabsleft" class="tabbable tabs-left">
                                <ul>
                                    <li><a href="#tabsleft-tab1" data-toggle="tab"><span class="strong">Step 1</span> <span class="muted">Content</span></a></li>
									<li><a href="#tabsleft-tab2" data-toggle="tab"><span class="strong">Step 2</span> <span class="muted">Options</span></a></li>
                                    <li><a href="#tabsleft-tab3" data-toggle="tab"><span class="strong">Step 3</span> <span class="muted">Details</span></a></li>
                                </ul>
                                <!--div class="progress progress-info progress-striped">
                                    <div class="bar"></div>
                                </div-->
                                <div class="tab-content">
                                    <div class="tab-pane" id="tabsleft-tab1">
										<!--h3>Content</h3-->
										<div id="edit_from" class="control-group">
											<label class="control-label">From</label>
											<div class="controls">
												<select name="from" class="span6 " tabindex="1">
													<option value="<phpdac>fronthtmlpage.echostr use rccrmoffers.mailuser</phpdac>"><phpdac>fronthtmlpage.echostr use rccrmoffers.mailuser</phpdac></option>
												</select>
											</div>
										</div>	
                                        <div id="edit_to" class="control-group">
											<label class="control-label">To</label>
											<div class="controls">
												<div class="input-icon left">
													<i class="icon-envelope"></i>
													<input name="visitor" value="<phpdac>fronthtmlpage.echostr use rccrmoffers.visitor</phpdac>" type="text" placeholder="Email Address" disabled />
													
													<span class="help-inline">
													<a href="cpcrmtrace.php?t=cpcrmprofile&v=<phpdac>fronthtmlpage.echostr use rccrmoffers.visitor</phpdac>" class="btn">Contact</a>
													</span>
												</div>
											</div>
                                        </div>
                                        <div id="edit_subject" class="control-group">
                                            <label class="control-label">Subject</label>
                                            <div class="controls">
                                                <input type="text" name="subject" value="<phpdac>fronthtmlpage.echostr use rccrmoffers.doctitle</phpdac>" class="span6">
                                                <span class="help-inline">Insert a subject</span>
                                            </div>
                                        </div>									
										<div class="control-group">
											<label class="control-label">Select form</label>
											<div id="select_template" class="controls">
												<phpdac>rccrmoffers.viewTemplateSelect</phpdac>
												<!--a href="cpcrmoffers.php?t=cptemplatenew&stemplate=<phpdac>fronthtmlpage.echostr use rccrmoffers.template</phpdac>" class="btn"><i class="icon-pencil"></i> Edit</a>
												<a href="cpcrmoffers.php?t=cptemplatenew" class="btn"><i class="icon-plus"></i> New</a-->
											</div>
										</div>																				
										
										<div id="edit_template" class="control-group">

										<div class="control-group">
											<label class="control-label"><phpdac>fronthtmlpage.nvldac use rccrmoffers.template+rccrmoffers.templateLoaded+fronthtmlpage.echostr use Template+</phpdac></label>
											<div class="controls">
												<textarea class="span12 ckeditor" name="document" rows="8">
												<phpdac>fronthtmlpage.echostr use rccrmoffers.document</phpdac>
												</textarea>
                                        		<phpdac>rccrmoffers.ckeditorjs use document+minimize+1</phpdac>										
											</div>
										</div>

										</div>
                                    </div>	
									<div class="tab-pane" id="tabsleft-tab2">
                                        <h3>Options</h3>										
										<div id="sendnow" class="control-group">
											<label class="control-label">Send now</label>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="sendnow" type="checkbox" checked="checked">
												</div>
											</div>
                                        </div>	
										<!--div id="edit_webpage" class="control-group">
											<label class="control-label">Text</label>
											<div class="controls">
												<textarea name="webviewtext" class="span6 " rows="3">Πατήστε _WEBLINK_ αν δεν βλέπετε σωστά το newsletter.
												</textarea>
											</div>
										</div-->																				
										<div id="select_unsubscribe" class="control-group">
											<label class="control-label">Unsubscribe</label>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="unsubscribelink" type="checkbox" checked="checked">
												</div>
											</div>
										</div>										
                                        <div id="edit_unsubscribe" class="control-group">
											<label class="control-label">Text</label>
											<div class="controls">
												<textarea name="unsubscribetext" class="span6 " rows="3"><phpdac>rccrmoffers.spam_conditions_text</phpdac></textarea>
											</div>
										</div>										
										<div class="control-group">
											<label class="control-label">Tokens</label>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="usetokens" type="checkbox" checked="checked">
												</div>
											</div>
										</div>										
                                    </div>
                                    <div class="tab-pane" id="tabsleft-tab3">
                                        <h3>Details</h3>
										<div class="control-group">
											<label class="control-label">Don't send email</label>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="dontmail" type="checkbox">
												</div>
											</div>
										</div>	
										<div class="control-group">
											<label class="control-label">Don't save the document</label>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="dontsave" type="checkbox">
												</div>
											</div>
										</div>										
                                        <div class="control-group">
                                            <label class="control-label"></label>
                                            <div class="controls">
                                                <label class="checkbox">
                                                    <input name="setfav" type="checkbox" /> Set items as recommendations
                                                </label>
												<label class="checkbox">
                                                    <input name="remfav" type="checkbox" /> Remove items as recommendations
                                                </label>
                                            </div>
                                        </div>
										<div class="control-group">
											<label class="control-label">Messages</label>
											<div class="controls">
												<select id="messages" multiple="multiple" style="height:100px;width:100%;">
												<phpdac>rccrmoffers.viewMessages</phpdac>
												</select>
											</div>
										</div>
										<div class="control-group">
										    <label class="control-label">Items</label>
											<div class="controls">
												<phpdac>rccrmoffers.editItems</phpdac>														
											</div>	
										</div>											
                                    </div>
                                    <ul class="pager wizard">
                                        <!--li class="previous"><a href="javascript:;">Previous</a></li>
                                        <li class="next"><a href="javascript:;">Next</a></li>
                                        <li class="next finish" style="display:none;"><a href="javascript:document.getElementById('tForm').submit();">Finish</a></li-->
										<li class="next"><a href="javascript:document.getElementById('tForm').submit();">Submit</a></li>
                                    </ul>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->

             <div class="row-fluid">
                 <div class="span12">
                    <!-- BEGIN  widget-->
                    <div class="widget yellow">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Object selection list</h4>
							<span class="tools">
								<a href="javascript:;" class="icon-chevron-down"></a>
								<!--a href="javascript:;" class="icon-remove"></a-->
							</span>
							<div class="update-btn">
							    <phpdac>rccrmoffers.buttonListToCollection</phpdac>
								<a href="JavaScript:void(0);" id="btn-up" class="btn"><i class="icon-long-arrow-up"></i> Up</a>
								<a href="JavaScript:void(0);" id="btn-down" class="btn"><i class="icon-long-arrow-down"></i> Dn</a>
                                <a href="cpcollections.php" class="btn"><i class="icon-repeat"></i> Edit</a>
                            </div>
                        </div>	
						<div class="widget-body form">
							<div>								
                            <table style="width: 100%;" class="">
                            <tr>
                                <td style="width: 100%">
								<form id="sortCollection" name="sortCollection" action="cpcrmoffers.php" method="post">
								<input type="hidden" name="FormName" value="sortcollection" />
								<input type="hidden" name="FormAction" value="cpsortcollection" />
								<input type="hidden" name="stemplate" value="<phpdac>fronhtmlpage.echostr use stemplate</phpdac>" />
								<input type="hidden" name="v" value="<phpdac>fronhtmlpage.echostr use rccrmoffers.visitor</phpdac>" />
                                    <select id="col-sort" name="colsort[]" multiple="multiple" style="height:300px;width:100%;">
									<phpdac>rccollections.viewCollection</phpdac>
                                    </select>
									<br/>
									<button type="submit" class="btn btn-success">Save</button>
								</form>	
                                </td>
                            </tr>
                            </table>
							</div>
                        </div>
                    </div>					 
                 </div>	 
             </div>			

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
   <script src="js/jquery-1.8.3.min.js"></script>
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="assets/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
   <script src="js/jquery.blockui.js"></script>
   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   
   <script type="text/javascript" src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>   
   
   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>
   <!--script for this page-->
   <script src="js/form-wizard.js"></script>

   <!-- END JAVASCRIPTS -->
   <script>
       $(function () {
           $(" input[type=radio], input[type=checkbox]").uniform();
       });

$(document).ready(function() {
    $('#btn-up').bind('click', function() {
        $('#col-sort option:selected').each( function() {
            var newPos = $('#col-sort option').index(this) - 1;
            if (newPos > -1) {
                $('#col-sort option').eq(newPos).before("<option value='"+$(this).val()+"' selected='selected'>"+$(this).text()+"</option>");
                $(this).remove();
            }
        });
    });
    $('#btn-down').bind('click', function() {
        var countOptions = $('#col-sort option').size();
        $('#col-sort option:selected').each( function() {
            var newPos = $('#col-sort option').index(this) + 1;
            if (newPos < countOptions) {
                $('#col-sort option').eq(newPos).after("<option value='"+$(this).val()+"' selected='selected'>"+$(this).text()+"</option>");
                $(this).remove();
            }
        });
    });
	
	$('#sortCollection').submit( function() {
		$('#col-sort option').attr('selected', 'selected');
	}); 

    $('#startTour').click(function(){
          options = {
            data : [
              { element : '#tabsleft', 'tooltip' : 'Βήματα κατασκευής περιεχομένου', 'position' : 'TL', 'text' : '<h3>Content wizard</h3><p>Με την επιλογή και την συμπλήρωση στοιχείων που αφορούν την κατασκευή του περιεχομένου, την επιλογή λίστας ή πολλαπλών λιστών και την χρήση των επιλεγμένων αντικειμένων, μπορείτε να δημιουργήσετε το περιεχόμενο σας αυτόματα, να το αποθηκεύσετε ως εργασία και να το αποστείλετε στους αποδέκτες σας.</p>'  },
              { element : '#select_template', 'tooltip' : 'Επιλογή εικαστικού θέματος', 'position' : 'TL', 'text' : '<h3>Επιλογή εικαστικού</h3><p>Επιλέξτε ένα απο τα έτοιμα εικαστικά θέματα. Φόρτώστε το περιεχόμενο τους και αποτυπώστε μέσα σε αυτό, αυτόματα τις πιθανές επιλογές των αντικειμένων που επιλέξατε σε προηγούμενα βήματα.</p>' },
              { element : '#edit_template', 'tooltip' : 'Προβολή εικαστικού θέματος', 'position' : 'Β', 'text' : '<h3>Εικαστικό θέμα</h3><p>Απεικόνιση του περιεχόμενου που επιλέξατε. Μπορείτε να δείτε πώς μεταβάλεται η δυναμική σχεδιάση καθώς ρυθμίζετε τα αντικείμενα προβολής.</p>' },
			  { element : '#sortCollection', 'tooltip' : 'Ρύθμιση ταξινόμησης', 'position' : 'T', 'text' : '<h3>Ταξινόμηση ειδών</h3><p>Επιλέξτε ένα απο τα αντικείμενα της λίστας για να ρυθμίσετε την θέση του στο εικαστικό που επιλέξατε.</p>' },
			  { element : '.update-btn', 'tooltip' : 'Πλήκτρα κίνησης', 'position' : 'TR', 'text' : '<h3>Πλήκτα κίνησης</h3><p>Εφόσον επιλέξετε αντικείμενο, μετακινείστε το στην λίστα χρησιμοποιώντας τα πλήκτρα κατεύθυνσης. Με το πλήκτρο Edit μπορείτε να επιστρέψετε στην διαδικασία επιλογής ειδών για να προσθαφαιρέσετε αντικείμενα.</p>' },
			  { element : '.pager.wizard', 'tooltip' : 'Πατήστε Next', 'position' : 'BR', 'text' : '<h3>Πατήστε Next</h3><p>Πατήστε το πλήκρο Next για να συνεχίσετε.</p>' },
              { element : '#select_ulists', 'tooltip' : 'Επιλογή λίστας', 'position' : 'BL' , 'text' : '<h3>Επιλογή λίστας</h3><p>Επιλέξτε λίστα διανομής που αποθηκεύσατε ώστε να συμμετάσχει στην διανομή του περιεχομένου.</p>' },
              { element : '#select_ulists_multiple', 'tooltip' : 'Επιλογή πολλαπλών λιστών', 'position' : 'BL', 'text' : '<h3>Πολλαπλές λίστες</h3><p>Επιλέξτε μία ή περισσότερες λίστες διανομής κρατώντας το ctrl πατημένο όσο επιλέγετε το όνομα της λίστας που θέλετε να συμμετέχει στην αποστολή.</p>' },
              { element : '#edit_csv', 'tooltip' : 'Λίστα csv', 'position' : 'BL', 'text' : '<h3>CSV λίστα</h3><p>Μία λίστα e-mails -csv (comma separated values, διακεκομένη με κόμμα (,)- μπορεί να συμπληρωθεί σε αυτό το σημείο ώστε να συμπεριλάβει τους αποδέκτες στην διανόμη.</p>' },
              { element : '#select_addons', 'tooltip' : 'Πρόσθετα', 'position' : 'BL', 'text' : '<h3>Πρόσθετα</h3><p>Επιλέξτε τα πρόσθετα που θα συνυπολογιστούν στην διανομή. Αυτά μπορεί να είναι χρήστες της e-Enterprise εφαρμογής, πελάτες της e-Enterprise εφαρμογής ή άλλο.</p>' },
			  { element : '.pager.wizard', 'tooltip' : 'Πατήστε Next', 'position' : 'BR', 'text' : '<h3>Πατήστε Next</h3><p>Πατήστε το πλήκρο Next για να συνεχίσετε.</p>' },
              { element : '#select_webpage', 'tooltip' : 'Προβολή ως ιστοσελίδα', 'position' : 'BL', 'text' : '<h3>View as webpage</h3><p>Επιλογή προσθήκης συνδέσμου για την προβολή του περιεχομένου ως ιστοσελίδα. Αφορά εγκαταστάσεις e-Enterprise, που έχουν την δυνατότητα να οδηγούν τους παραλήπτες στο κανάλι προβολής τους.</p>' },
              { element : '#edit_webpage', 'tooltip' : 'Κείμενο προστροπής', 'position' : 'BL', 'text' : '<h3>Κείμενο προστροπής</h3><p>Κείμενο που εμφανίζεται στο προ-ρυθμισμένο περιεχόμενο και σύνδεσμος για την προβολή του περιεχομένου ως ιστοσελίδα.</p>' },
              { element : '#select_unsubscribe', 'tooltip' : 'Σύνδεσμος δυνατότητας αφαίρεσης παραλήπτη απο την λίστα', 'position' : 'BL', 'text' : '<h3>Επιλογή αφαίρεσης απο την λίστα</h3><p>Δίνεται πάντα η δυνατότητα στον παραλήπτη να ενημερώθει για την ισχύουσα νομοθεσία αποστολή μηνυμάτων και τη δυνατότητα του να αφαιρέσει το e-mail του απο την λίστα διανομής.</p>' },
              { element : '#edit_unsubscribe', 'tooltip' : 'Κείμενο προτροπής', 'position' : 'BL', 'text' : '<h3>Κείμενο προστροπής</h3><p>Κείμενο προτροπής για την ενημέρωση του παραλήπτη.</p>' },
			  { element : '.pager.wizard', 'tooltip' : 'Πατήστε Next', 'position' : 'BR', 'text' : '<h3>Πατήστε Next</h3><p>Πατήστε το πλήκρο Next για να συνεχίσετε.</p>' },
              { element : '#edit_from', 'tooltip' : 'Αποστολέας', 'position' : 'BL', 'text' : '<h3>Αποστολέας</h3><p>Συμπληρώστε ή αφήστε την προεπιλογή ως έχει, για τα στοιχεία του αποστολέα.</p>' },
              { element : '#edit_to', 'tooltip' : 'Παραλήπτης', 'position' : 'BL', 'text' : '<h3>Παραλήπτης</h3><p>Συμπλήρώστε το e-mail του παραλήπτη. Έκτος της λίστας διανομής μπορεί να συμπεριλαμβάνεται και ένας τυπικός παραλήπτης. Συνήθως αφορά στοιχεία του ίδιου ή άλλου e-mail λογαριασμού του αποστολέα για την λήψη του περιεχομένου.</p>' },
			  { element : '#edit_subject', 'tooltip' : 'Θέμα εργασίας-αποστολής', 'position' : 'BL', 'text' : '<h3>Θέμα εργασίας</h3><p>Τίτλος θέματος εργασίας - αποστολής βάση του οποίου αποθηκεύεται η εργασία και αποστέλεται στις λίστες διανομής.</p>' },
			  { element : '.pager.wizard', 'tooltip' : 'Τέλος ρυθμίσεων', 'position' : 'BR', 'text' : '<h3>Τέλος ρυθμίσεων</h3><p>Πατήστε το πλήκρο Finish για να αποθηκέυσετε τις ρυθμίσεις της εργασίας.</p>' }
            ] ,
            controlsPosition : 'BR'
          };

        $.aSimpleTour(options);  
    });	
	
});	  
	   
   </script>
   <script src="js/aSimpleTour.js" type="text/javascript"></script>   

</body>
<!-- END BODY -->
</html>