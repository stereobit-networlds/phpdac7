<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Run campaign</title>
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

    <link href="assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />

    <link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen/chosen.css" />
    <link rel="stylesheet" type="text/css" href="assets/jquery-tags-input/jquery.tagsinput.css" />
    <!--link rel="stylesheet" type="text/css" href="assets/clockface/css/clockface.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" /-->
    <link rel="stylesheet" href="assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
    <!--link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" /-->

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />


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
                    <!-- BEGIN SAMPLE FORMPORTLET-->
                    <div class="widget red">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Campaign</h4>
                            <!--span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span-->
                        </div>
                        <div class="widget-body">
                            <!-- BEGIN FORM-->
                            <form method="post" action="#" class="form-horizontal">
						
							<div id="select_campaign" class="control-group">
                                <label class="control-label">Title</label>
                                <div id="campaign_buttons" class="controls">
                                    <!--select class="span6 chzn-select" data-placeholder="Choose a Category" tabindex="1">
                                        <option value="">Select...</option>
										<-hpdac>rcbulkmail.viewCampaigns</phpda->
                                    </select-->
									<phpdac>rcbulkmail.campaignSelect</phpdac>
									<br/>
									<a href="cpbulkmail.php?t=cppreviewcamp&cid=<phpdac>fronthtmlpage.echostr use rcbulkmail.cid</phpdac>" class="btn btn-success">View content</a>
									<a href="cpbulkmail.php?t=cpmailstats&cid=<phpdac>fronthtmlpage.echostr use rcbulkmail.cid</phpdac>" class="btn btn-success">View statistics</a>
									<a href="cpbulkmail.php?t=cpdeletecamp&cid=<phpdac>fronthtmlpage.echostr use rcbulkmail.cid</phpdac>" class="btn btn-danger">Delete</a>
									<a href="cpbulkmail.php" class="btn btn-success">New campaign</a>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Subject</label>
                                <div id="edit_subject" class="controls">
                                    <input name="subject" value="<phpdac>fronthtmlpage.nvldac2 use subject+fronthtmlpage.echostr:subject++</phpdac>" type="text" class="span6 " />
                                    <span class="help-inline">Insert a subject </span>
                                </div>
                            </div>	
						    <div class="control-group">
                                <label class="control-label">From</label>
                                <div id="edit_from" class="controls">
                                    <div class="input-icon left">
                                        <i class="icon-envelope"></i>
                                        <input name="from" value="<phpdac>fronthtmlpage.nvldac2 use from+fronthtmlpage.echostr:from++</phpdac>" class=" " type="text" />
										<span class="help-inline">
											<i class="icon-user"></i>
											<input name="realm" value="<phpdac>fronthtmlpage.nvldac2 use realm+fronthtmlpage.echostr:realm++</phpdac>" class=" " type="text" readonly="readonly" />
										</span>
                                    </div>
                                </div>
                            </div>	
						    <div class="control-group">
                                <label class="control-label">Settings</label>
                                <div class="controls">
                                    <div class="input-icon left">
                                        <i class="icon-user"></i>
										<input name="user" value="<phpdac>fronthtmlpage.nvldac2 use user+fronthtmlpage.echostr:user++</phpdac>" class=" " type="text" <phpdac>rcbulkmail.disableSettings</phpdac> />
										</span>
										<span class="help-inline">
											<i class="icon-lock"></i>
											<input name="pass" value="<phpdac>fronthtmlpage.nvldac2 use pass+fronthtmlpage.echostr:pass++</phpdac>" class=" " type="text" <phpdac>rcbulkmail.disableSettings</phpdac> />
										</span>
										<span class="help-inline">
											<i class="icon-tasks"></i>
											<input name="server" value="<phpdac>fronthtmlpage.nvldac2 use server+fronthtmlpage.echostr:server++</phpdac>" class=" " type="text" <phpdac>rcbulkmail.disableSettings</phpdac> />
										</span>
                                    </div>
                                </div>
                            </div>								
							<div class="control-group">
                                    <label class="control-label">To</label>
                                    <div id="edit_to" class="controls">
										<!--div class="input-icon left">
											<i class="icon-envelope"></i>
											<input name="to" value="<phpdac>fronthtmlpage.nvldac2 use submail+fronthtmlpage.echostr:submail++</phpdac>" class=" " type="text"  />
											<span class="help-inline">
											Insert e-mail in order to test before sending	
											</span>
										</div-->	
										<input id="tags_1" type="text" class="tags" value="<phpdac>fronthtmlpage.echostr use ulists</phpdac>" disabled />									
                                    </div>
                            </div>							
                            <div class="form-actions">
                                <button type="submit" class="<phpdac>fronthtmlpage.nvl use rcbulkmail.sendOk+btn btn-success+btn btn-danger+</phpdac>">Submit</button>
                                <!--button type="button" class="btn">Cancel</button-->
								<input type="hidden" name="FormName" value="cpsubsend" />
								<input type="hidden" name="FormAction" value="<phpdac>fronthtmlpage.nvl use rcbulkmail.sendOk+cpmailstats+cpsubsend+</phpdac>" />
								<input type="hidden" name="cid" value="<phpdac>fronthtmlpage.echostr use rcbulkmail.cid</phpdac>">
								<input type="hidden" name="bid" value="<phpdac>fronthtmlpage.echostr use rcbulkmail.batchid</phpdac>">
								<!--hpdac>rccollections.postSubmit use cpsubscribe+Ok+btn</phpda-->
                            </div>							
							<div>
							<div id="exclude" class="control-group">
								<label class="control-label">Exclude</label>
								<div class="controls">							
                                    <table style="width: 100%;" class="">
                                        <tr>
                                            <td style="width: 35%">
                                                <div class="d-sel-filter">
                                                    <span>Filter:</span>
                                                    <input type="text" id="box1Filter" />
                                                    <button type="button" class="btn" id="box1Clear">X</button>
                                                </div>

                                                <select name="exclude[]" id="box1View" multiple="multiple" style="height:300px;width:75%">
                                                    <!--hpdac>rccollections.getCurrentList</phpda-->
                                                </select><br/>

                                                <span id="box1Counter" class="countLabel"></span>

                                                <select id="box1Storage">

                                                </select>
                                            </td>
                                            <td style="width: 21%; vertical-align: middle">
                                                <button id="to2" class="btn" type="button">&nbsp;>&nbsp;</button>

                                                <button id="allTo2" class="btn" type="button">&nbsp;>>&nbsp;</button>

                                                <button id="allTo1" class="btn" type="button">&nbsp;<<&nbsp;</button>

                                                <button id="to1" class="btn" type="button">&nbsp;<&nbsp;</button>
                                            </td>
                                            <td style="width: 35%">
                                                <div class="d-sel-filter">
                                                    <span>Filter:</span>
                                                    <input type="text" id="box2Filter" />
                                                    <button type="button" class="btn" id="box2Clear">X</button>
                                                </div>

                                                <select name="include[]" id="box2View" multiple="multiple" style="height:300px;width:75%;">
													<phpdac>rcbulkmail.getCmpMails use 1</phpdac>
                                                </select><br/>

                                                <span id="box2Counter" class="countLabel"></span>

                                                <select id="box2Storage">

                                                </select>
                                            </td>
                                        </tr>
                                    </table>
								</div>	
                            </div>	
							<div id="messages" class="control-group">
								<label class="control-label">Messages</label>
								<div class="controls">
									<select id="messages" multiple="multiple" style="height:100px;width:100%;">
										<phpdac>rcbulkmail.viewMessages</phpdac>
									</select>
								</div>
							</div>							
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
            </div>			
            <div class="row-fluid">
                 <div class="span12">
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
	<phpdac>frontpage.include_part use /parts/footer-demo.php+++metro</phpdac>
   <!-- END FOOTER -->

   <!-- BEGIN JAVASCRIPTS -->
   <!-- Load javascripts at bottom, this will reduce page load time -->

   <script src="js/jquery-1.8.2.min.js"></script>
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <!--script type="text/javascript" src="assets/bootstrap/js/bootstrap-fileupload.js"></script-->
   <script src="js/jquery.blockui.js"></script>

   <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
   <script src="js/jQuery.dualListBox-1.3.js" language="javascript" type="text/javascript"></script>


   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   <script type="text/javascript" src="assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
   <script type="text/javascript" src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
   <!--script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
   <script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
   <script type="text/javascript" src="assets/clockface/js/clockface.js"></script-->
   <script type="text/javascript" src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
   <!--script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
   <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
   <script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
   <script type="text/javascript" src="assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script-->
   <script type="text/javascript" src="assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
   <script src="assets/fancybox/source/jquery.fancybox.pack.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>



   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!--script for this page-->
   <script src="js/form-component.js"></script>
     
  <!-- END JAVASCRIPTS -->

   <script language="javascript" type="text/javascript">
       $(function() {
           $.configureBoxes();
       });
   </script>
   
	<script src="js/aSimpleTour.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#startTour').click(function(){
          options = {
            data : [
              { element : '#select_campaign', 'tooltip' : 'Επιλεγμένη εργασία', 'position' : 'T', 'text' : '<h3>Όνομα εργασίας</h3><p>Επιλεγμένη εργασία, όπως αυτή αποθηκεύτηκε κατα την διαδικασία κατασκευής και δυνατότητα επιλογής άλλης εργασίας όταν θέλουμε να επαναλάβουμε μια απο αυτές.</p>'  },
			  { element : '#campaign_buttons', 'tooltip' : 'Σχετικές ενέργειες', 'position' : 'L', 'text' : '<h3>Ενέργειες εργασίας</h3><p>Ενέργειες εργασίας που αφορούν την προεπισκόπηση του περιεχομένου, τα στατιστικά μιας ήδη εκτελεσμένης εργασίας, την διαγραφή της ή την έναρξη μιας νέας εργασίας.</p>'  },
              { element : '#edit_subject', 'tooltip' : 'Αλλαγή θέματος-τίλτου αποστολής', 'position' : 'L', 'text' : '<h3>Θέμα - τίτλος</h3><p>Δυνατότητα αλλαγής του τίτλου αποστολής σε παραλήπτες. Είναι ο τίτλος που θα εμφανιστεί ως θέμα στο mailbox του παραλήπτη.</p>' },
              { element : '#edit_from', 'tooltip' : 'Αποστολέας', 'position' : 'L', 'text' : '<h3>Αποστολέας</h3><p>Αφορά τα στοιχεία αποστολής του αποστολέα και συνήθως είναι προτεινόμενα απο το σύστημα βάση των ρυθμίσεων που έχουν προηγηθεί.</p>' },
              { element : '#edit_to', 'tooltip' : 'Παραλήπτες', 'position' : 'L' , 'text' : '<h3>Παραλήπτες</h3><p>Αναφορά στην λίστα / λίστες που έχουν επιλεγεί για την συμμετοχή τους στην αποστολή.</p>' },
			  { element : '#exclude', 'tooltip' : 'Αφαίρεση μεμονομένων παραληπτών', 'position' : 'T', 'text' : '<h3>Παραλήπτες</h3><p>Αφαιρέστε μεμονομένους παραλήπτες σε αυτή την περιοχή.</p>'  },
              { element : '.d-sel-filter', 'tooltip' : 'Φίλτρο αναζήτησης παραληπτών', 'position' : 'T', 'text' : '<h3>Αναζήτηση στην λίστα</h3><p>Αναζητήστε είδη που έιναι προς επιλογή ή έχετε ήδη επιλέξει, πληκτρολογώντας το είδος όπως αναφέρεται.</p>' },			  
              { element : '#box2View', 'tooltip' : 'Λίστα επιλεγμένων παραληπτών', 'position' : 'B', 'text' : '<h3>Λίστα παραληπτών</h3><p>Περιοχή συνολικά επιλεγμένων ειδών. Αφαιρέστε παραλήπτες που επιλέξατε προτύτερα, επιλέγοντας έναν ή περισσότερους απο αυτούς.</p>' },
              { element : '#to1', 'tooltip' : 'Αφαίρεση μερικών απο την λίστα', 'position' : 'B' , 'text' : '<h3>Αφαίρεση μερικών</h3><p>Χρησιμοποιήστε το πλήκτρο για την αφαίρεση ενός ή μερικών απο την λίστα, αν το ctrl είναι πατημένο.</p>' },
              { element : '#allTo1', 'tooltip' : 'Αφαίρεση όλων', 'position' : 'B', 'text' : '<h3>Αφαίρεση όλων</h3><p>Χρησιμοποιήστε το πλήκτρο για να αφαιρεθούν όλα τα επιλεγμένα είδη.</p>' },			  
			  { element : '#box1View', 'tooltip' : 'Λίστα εξαιρεθέντων παραληπτών', 'position' : 'T', 'text' : '<h3>Εξαιρέσεις παραληπτών</h3><p>Λίστα παραληπτών που έχουν εξαιρεθεί.</p>'  },
			  { element : '#to2', 'tooltip' : 'Επαναφόρτωση στην λίστα επιλογής', 'position' : 'T', 'text' : '<h3>Πρόσθεση μερικών</h3><p>Χρησιμοποιήστε το πλήκτρο για την μεταφορά ενός ή μερικών, αν το ctrl είναι πατημένο καθώς επιλέγετε είδη.</p>' },			  
              { element : '#allTo2', 'tooltip' : 'Επαναφόρτωση όλων στην λίστα επιλογής', 'position' : 'T', 'text' : '<h3>Πρόσθεση όλων</h3><p>Χρησιμοποιήστε το πλήκτρο για να μεταφερθούν όλοι οι εξαιρεθέντες παραλήπτες ξανά στην λίστα διανομής.</p>' },			  
              { element : '.form-actions', 'tooltip' : 'Πλήκτρο εκτέλεσης εργασίας', 'position' : 'TL', 'text' : '<h3>Αποστολή</h3><p>Εφόσον ρυθμίσετε τις λεπτομέριες της αποστολής, πατήστε το πλήκτρο submit για την έναρξη της εργασίας. Το σύστημα αναλαμβάνει να αποστείλει το περιεχόμενο της εργασίας σε κάθε έναν απο τους παραλήπτες μέσα σε υπολογιζόμενο χρονικό όριζοντα, ώστε να η παραλαβή να γίνει βάση των προδιαγραφών αποστολής, παραλάβης και ασφάλειας παράδοσης.</p>' }
            ] ,
            controlsPosition : 'BR'
          };

          $.aSimpleTour(options);  
        });
      });
    </script>     

   <phpdac>frontpage.include_part use /parts/google-analytics.php+++metro</phpdac>
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->     

</body>
<!-- END BODY -->
</html>