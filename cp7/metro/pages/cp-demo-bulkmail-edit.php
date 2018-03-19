<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Create campaign</title>
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
	
   <phpdac>fronthtmlpage.nvl use rcbulkmail.ckeditver+<script src="http://www.stereobit.gr/ckeditor/ckeditor.js"></script>+<script type="text/javascript" src="assets/ckeditor/ckeditor.js">+3</phpdac>
   </script>   

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top" onLoad="init()">
   <!-- BEGIN HEADER -->
	<phpdac>frontpage.include_part use /parts/header-demo.php+++metro</phpdac>
   <!-- END HEADER -->
   <!-- BEGIN CONTAINER -->
   <div id="container" class="row-fluid">
      <!-- BEGIN SIDEBAR -->
		<phpdac>frontpage.include_part use /parts/sidebar-demo.php+++metro</phpdac>
      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
			<phpdac>frontpage.include_part use /parts/pageheader-demo.php+++metro</phpdac>
            <!-- END PAGE HEADER-->

            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget box purple">
                        <div class="widget-title">
                            <h4>
                                <i class="icon-reorder"></i> Campaign wizard</span>
                            </h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <!--a href="javascript:;" class="icon-remove"></a-->
                        </span>
                        </div>
                        <div class="widget-body">
                            <form id="tForm" method="post" action="cpbulkmail.php?t=cpsavemailadv&editmode=1" class="form-horizontal">
							
								<input type="hidden" name="FormName" value="cpsavemailadv" />
								<input type="hidden" name="FormAction" value="cpsavemailadv" />
								
                                <div id="tabsleft" class="tabbable tabs-left">
                                <ul>
                                    <li><a href="#tabsleft-tab1" data-toggle="tab"><span class="strong">Step 1</span> <span class="muted">Select content</span></a></li>
                                    <li<phpdac>fronthtmlpage.nvl use rcbulkmail.ulistselect+ class="active"++</phpdac>><a href="#tabsleft-tab2" data-toggle="tab"><span class="strong">Step 2</span> <span class="muted">Distribution lists</span></a></li>
                                    <li><a href="#tabsleft-tab3" data-toggle="tab"><span class="strong">Step 3</span> <span class="muted">Message Options</span></a></li>
                                    <li><a href="#tabsleft-tab4" data-toggle="tab"><span class="strong">Step 4</span> <span class="muted">Message Details</span></a></li>
                                </ul>
                                <div class="progress progress-info progress-striped">
                                    <div class="bar"></div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tabsleft-tab1">
                                        <h3>Select content</h3>
										<div class="control-group">
											<label class="control-label">Select template</label>
											<div id="select_template" class="controls">
												<!--select name="template" class="span6 " data-placeholder="Choose a template" tabindex="1">
												<option value="">Select...</option-->
												<!--hpdac>rcbulkmail.viewTemplates</phpda-->
												<!--/select-->
												<phpdac>rcbulkmail.viewTemplateSelect</phpdac>
												<a href="cpbulkmail.php?t=cptemplatenew&stemplate=<phpdac>fronthtmlpage.calldpc_var use rcbulkmail.template</phpdac>" class="btn"><i class="icon-pencil"></i> Edit</a>
												<a href="cpbulkmail.php?t=cptemplatenew" class="btn"><i class="icon-plus"></i> New</a>
											</div>
										</div>										
										<!--div class="control-group">
											<label class="control-label">Use collections</label>
											<div class="controls">
												<label class="checkbox">
													<input type="checkbox" name="ulistON" checked="<phpdac>nvl use rccollections.savedlist+checked++</phpdac>"/> On
												</label>
											</div>
										</div-->										
										
										<div id="edit_template" class="control-group">
										<!-- BEGIN FORM-->
										<form action="#" class="form-horizontal">
										<div class="control-group">
											<label class="control-label"><phpdac>fronthtmlpage.nvldac use rcbulkmail.template+rcbulkmail.templateLoaded+fronthtmlpage.echostr use Template+</phpdac></label>
											<div class="controls">
												<textarea class="span12 ckeditor" name="mail_text" rows="8">
												<phpdac>fronthtmlpage.calldpc_var use rcbulkmail.mailbody</phpdac>
												</textarea>
                                        		<phpdac>rcbulkmail.ckeditorjs use mail_text+minimize+1</phpdac>										
											</div>
										</div>
										</form>
										<!-- END FORM-->
										</div>
                                    </div>
                                    <div class="tab-pane <phpdac>fronthtmlpage.nvl use rcbulkmail.ulistselect+ active++</phpdac>" id="tabsleft-tab2">
                                        <h3>Distribution lists</h3>
										<!--div class="control-group">
											<label class="control-label">Mailing list</label>
											<div id="select_ulists" class="controls">
												<-hpdac>rcbulkmail.uListSelect</phpda->
											</div>
										</div-->
										<div class="control-group">
											<label class="control-label">Select from list (multiple)</label>
											<div id="select_ulists_multiple" class="controls">
												<select name="ulistname[]" class="span6 " multiple="multiple" data-placeholder="Choose mailing lists" tabindex="1">
													<phpdac>rcbulkmail.viewUList use 1</phpdac>
												</select>
											</div>
										</div>										
										<div class="control-group">
											<label class="control-label">CSV Addon Mails</label>
											<div id="edit_csv" class="controls">
												<textarea name="csv" class="span6 " rows="3"></textarea>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Addon components</label>
											<div id="select_addons" class="controls">
												<label class="checkbox">
													<input name="siteusers" type="checkbox" /> Users
												</label>
												<label class="checkbox">
													<input name="sitecusts" type="checkbox"  /> Customers
												</label>
												<label class="checkbox">
													<input name="timetable" type="checkbox" checked="" /> Timetable
												</label>
											</div>
										</div>	
                                    </div>
                                    <div class="tab-pane" id="tabsleft-tab3">
                                        <h3>Message options</h3>										
										<div id="select_webpage" class="control-group">
											<label class="control-label">View as web page</label>
											<div class="controls">
												<div id="normal-toggle-button">
													<input name="webviewlink" type="checkbox" checked="checked">
												</div>
											</div>
                                        </div>	
										<div id="edit_webpage" class="control-group">
											<label class="control-label">Text</label>
											<div class="controls">
												<textarea name="webviewtext" class="span6 " rows="3">Πατήστε _WEBLINK_ αν δεν βλέπετε σωστά το newsletter.
												</textarea>
											</div>
										</div>																				
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
												<textarea name="unsubscribetext" class="span6 " rows="3"><phpdac>rcbulkmail.spam_conditions_text</phpdac></textarea>
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
									
                                    <div class="tab-pane" id="tabsleft-tab4">
                                        <h3>Message details</h3>
										<div id="edit_from" class="control-group">
											<label class="control-label">From</label>
											<div class="controls">
												<select name="from" class="span6 " data-placeholder="Choose a mailing list" tabindex="1">
													<option value="<phpdac>fronthtmlpage.calldpc_var use rcbulkmail.mailuser</phpdac>"><phpdac>fronthtmlpage.calldpc_var use rcbulkmail.mailuser</phpdac></option>
												</select>
											</div>
										</div>	
                                        <div id="edit_to" class="control-group">
											<label class="control-label">To</label>
											<div class="controls">
												<div class="input-icon left">
												<i class="icon-envelope"></i>
												<input class=" " name="submail" type="text" placeholder="Email Address" />
												</div>
											</div>
                                        </div>
                                        <div id="edit_subject" class="control-group">
                                            <label class="control-label">Subject</label>
                                            <div class="controls">
                                                <input type="text" name="subject" class="span6">
                                                <span class="help-inline">Insert a subject</span>
                                            </div>
                                        </div>
										<div class="control-group">
										    <label class="control-label">Settings</label>
											<div class="controls">
												<div class="input-icon left">
													<i class="icon-user"></i>
													<input name="user" class=" " type="text" <phpdac>rcbulkmail.disableSettings</phpdac> />
													<span class="help-inline">
														<i class="icon-lock"></i>
														<input name="pass" class=" " type="text" <phpdac>rcbulkmail.disableSettings</phpdac> />
													</span>
													<span class="help-inline">
														<i class="icon-tasks"></i>
														<input name="server" class=" " type="text" <phpdac>rcbulkmail.disableSettings</phpdac> />
													</span>													
												</div>														
											</div>	
										</div>										
                                        <div class="control-group">
                                            <label class="control-label"></label>
                                            <div class="controls">
                                                <label class="checkbox">
                                                    <input name="savecmp" type="checkbox" value="1" checked /> Save campaign
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="pager wizard">
                                        <li class="previous"><a href="javascript:;">Previous</a></li>
                                        <li class="next"><a href="javascript:;">Next</a></li>
                                        <li class="next finish" style="display:none;"><a href="javascript:document.getElementById('tForm').submit();">Finish</a></li>
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
								<form id="sortCollection" name="sortCollection" action="cpbulkmail.php" method="post">
								<input type="hidden" name="FormName" value="cpsubloadhtmlmail" />
								<input type="hidden" name="FormAction" value="cpsubloadhtmlmail" />
								<input type="hidden" name="stemplate" value="<phpdac>fronhtmlpage.echostr use stemplate</phpdac>" />
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
					    <?METRO/INDEX?>
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
	<phpdac>frontpage.include_part use /parts/footer-demo.php+++metro</phpdac>
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
              { element : '#edit_csv', 'tooltip' : 'Λίστα csv', 'position' : 'BL', 'text' : '<h3>CSV λίστα</h3><p>Μία λίστα e-mails -csv (comma separated values, διακεκομένη με κόμμα (,)- μπορεί να συμπληρωθεί σε αυτό το σημείο ώστε να συμπεριλάβει τους αποδέκτες στην διανόμη.<br/> ΠΡΟΣΟΧΗ: Για λόγους επίδειξής είναι ενεργοποιημένη μόνο αυτή η δυνατότητα αποστολής και σε μέγεθος όχι μεγαλύτερο των τριών (3) αποδεκτών. Η επιλόγη προ-ρυθμισμένων λιστών δεν λαμβάνεται υπόψιν στο περιβάλλον επίδειξης.</p>' },
              { element : '#select_addons', 'tooltip' : 'Πρόσθετα', 'position' : 'BL', 'text' : '<h3>Πρόσθετα</h3><p>Επιλέξτε τα πρόσθετα που θα συνυπολογιστούν στην διανομή. Αυτά μπορεί να είναι χρήστες της e-Enterprise εφαρμογής, πελάτες της e-Enterprise εφαρμογής ή άλλο.</p>' },
			  { element : '.pager.wizard', 'tooltip' : 'Πατήστε Next', 'position' : 'BR', 'text' : '<h3>Πατήστε Next</h3><p>Πατήστε το πλήκρο Next για να συνεχίσετε.</p>' },
              { element : '#select_webpage', 'tooltip' : 'Προβολή ως ιστοσελίδα', 'position' : 'BL', 'text' : '<h3>View as webpage</h3><p>Επιλογή προσθήκης συνδέσμου για την προβολή του περιεχομένου ως ιστοσελίδα. Αφορά εγκαταστάσεις e-Enterprise, που έχουν την δυνατότητα να οδηγούν τους παραλήπτες στο κανάλι προβολής τους.</p>' },
              { element : '#edit_webpage', 'tooltip' : 'Κείμενο προστροπής', 'position' : 'BL', 'text' : '<h3>Κείμενο προστροπής</h3><p>Κείμενο που εμφανίζεται στο προ-ρυθμισμένο περιεχόμενο και σύνδεσμος για την προβολή του περιεχομένου ως ιστοσελίδα.</p>' },
              { element : '#select_unsubscribe', 'tooltip' : 'Σύνδεσμος δυνατότητας αφαίρεσης παραλήπτη απο την λίστα', 'position' : 'BL', 'text' : '<h3>Επιλογή αφαίρεσης απο την λίστα</h3><p>Δίνεται πάντα η δυνατότητα στον παραλήπτη να ενημερώθει για την ισχύουσα νομοθεσία αποστολή μηνυμάτων και τη δυνατότητα του να αφαιρέσει το e-mail του απο την λίστα διανομής.</p>' },
              { element : '#edit_unsubscribe', 'tooltip' : 'Κείμενο προτροπής', 'position' : 'BL', 'text' : '<h3>Κείμενο προστροπής</h3><p>Κείμενο προτροπής για την ενημέρωση του παραλήπτη.</p>' },
			  { element : '.pager.wizard', 'tooltip' : 'Πατήστε Next', 'position' : 'BR', 'text' : '<h3>Πατήστε Next</h3><p>Πατήστε το πλήκρο Next για να συνεχίσετε.</p>' },
              { element : '#edit_from', 'tooltip' : 'Αποστολέας', 'position' : 'BL', 'text' : '<h3>Αποστολέας</h3><p>Συμπληρώστε ή αφήστε την προεπιλογή ως έχει, για τα στοιχεία του αποστολέα.</p>' },
              { element : '#edit_to', 'tooltip' : 'Παραλήπτης', 'position' : 'BL', 'text' : '<h3>Παραλήπτης</h3><p>Συμπλήρώστε το e-mail του παραλήπτη. Έκτος της λίστας διανομής μπορεί να συμπεριλαμβάνεται και ένας τυπικός παραλήπτης. Συνήθως αφορά στοιχεία του ίδιου ή άλλου e-mail λογαριασμού του αποστολέα για την λήψη του περιεχομένου.<br/> ΠΡΟΣΟΧΗ: Για λόγους επίδειξής το σύνολο των παραληπτών δεν δύναται να υπερβαίνει τους τρείς (3) παραλήπτες, συμπεριλαμβανομένου και των στοιχείων που εισάγονται εδώ.</p>' },
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
   
   <phpdac>frontpage.include_part use /parts/google-analytics.php+++metro</phpdac>
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->     

</body>
<!-- END BODY -->
</html>