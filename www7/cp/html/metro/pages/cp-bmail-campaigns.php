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
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link href="css/style-default.css" rel="stylesheet" id="style_color" />

    <link href="assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />

    <link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen/chosen.css" />
    <link rel="stylesheet" type="text/css" href="assets/jquery-tags-input/jquery.tagsinput.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" href="assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
    <!--link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" /-->	

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	
	<link href="../javascripts/themes/redmond/jquery-ui.custom.css" rel="stylesheet" /> 
	<link href="../javascripts/jqgrid/css/ui.jqgrid.css" rel="stylesheet" />  
	
    <!--script src="../javascripts/jquery.js"></script-->
	<script src="js/jquery-1.8.3.min.js"></script> 
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
                            <h4><i class="icon-reorder"></i> <phpdac>i18nL.translate use campaign+RCBULKMAIL</phpdac></h4>
                            <!--span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span-->
                        </div>
                        <div class="widget-body">
                            <!-- BEGIN FORM-->
                            <form method="post" action="#" class="form-horizontal">
						
							<ul class="unstyled">
								<phpdac>rcbulkmail.instanceCamp use bmail-task-in-progress-success</phpdac>
							</ul>
													
                            <div class="control-group">
                                <label class="control-label"><phpdac>i18nL.translate use subject+RCBULKMAIL</phpdac></label>
                                <div id="edit_subject" class="controls">
                                    <input id="subject" name="subject" value="<phpdac>cms.nvldac2 use subject+cms.echostr:subject++</phpdac>" type="text" class="span6 " />
                                    <!--span class="help-inline">Insert a subject </span-->
                                </div>
                            </div>	
						    <div class="control-group">
                                <label class="control-label"><phpdac>i18nL.translate use sender+RCBULKMAIL</phpdac></label>
                                <div id="edit_from" class="controls">
                                    <div class="input-icon left">
                                        <i class="icon-envelope"></i>
                                        <input id="from" name="from" value="<phpdac>cms.nvldac2 use from+cms.echostr:from++</phpdac>" class=" " type="text" / readonly="readonly">
										<span class="help-inline">
											<i class="icon-user"></i>
											<input name="realm" value="<phpdac>cms.nvldac2 use realm+cms.echostr:realm++</phpdac>" class=" " type="text" readonly="readonly" />
										</span>
                                    </div>
                                </div>
                            </div>	
						    <div class="control-group">
                                <label class="control-label"><phpdac>i18nL.translate use SETTINGS+RCCONTROLPANEL</phpdac></label>
                                <div class="controls">
                                    <div class="input-icon left">
                                        <i class="icon-user"></i>
										<input name="user" value="<phpdac>cms.nvldac2 use user+cms.echostr:user++</phpdac>" class=" " type="text" <phpdac>rcbulkmail.disableSettings</phpdac> />
										</span>
										<span class="help-inline">
											<i class="icon-lock"></i>
											<input name="pass" value="<phpdac>cms.nvldac2 use pass+cms.echostr:pass++</phpdac>" class=" " type="text" <phpdac>rcbulkmail.disableSettings</phpdac> />
										</span>
										<span class="help-inline">
											<i class="icon-tasks"></i>
											<input name="server" value="<phpdac>cms.nvldac2 use server+cms.echostr:server++</phpdac>" class=" " type="text" <phpdac>rcbulkmail.disableSettings</phpdac> />
										</span>
                                    </div>
                                </div>
                            </div>

							<div class="control-group">
                                <label class="control-label"><phpdac>i18nL.translate use receiver+RCBULKMAIL</phpdac></label>
                                <div id="select_ulist" class="controls">
                                    <select id="tags_1" name="include" class="span6 " data-placeholder="<phpdac>cms.slocale use _sellistprompt</phpdac>" tabindex="1">
                                        <option value=""><phpdac>cms.slocale use _selectlist</phpdac></option>
										<phpdac>rculists.viewUList</phpdac>
                                    </select>
                                </div>
                            </div>
							
							<div class="control-group">
                                <!--label class="control-label"><phpdac>i18nL.translate use receiver+RCBULKMAIL</phpdac></label>
                                <div id="editto" class="controls">
									<input name="include" id="tags_1" type="text" class="tags" value="<phpdac>cms.nvldac2 use ulists+cms.echostr:ulists++</phpdac>" />									
                                </div-->
                                <div id="editsend" class="controls">
									<input id="receivers" name="receivers" type="text" value="<phpdac>cms.nvldac2 use bcc+cms.echostr:bcc++</phpdac>" class="span12 " readonly="readonly" />									
                                </div>																
                            </div>	
                            <div class="control-group">
                                <label class="control-label"><phpdac>frontpage.slocale use _schedule</phpdac></label>
                                <div class="controls">
                                    <div class="input-append date" id="dpYears" data-date=""
                                        data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input class="m-ctrl-medium" size="16" type="text" name="schdate" readonly>
                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                    </div>
									<!--input id="dp1" type="text" value="" size="16" class="m-ctrl-medium"-->		
    
                                    <div class="input-append bootstrap-timepicker">
                                        <input id="bid" name="bid" type="text" value="<phpdac>cms.echostr use rcbulkmail.batchid</phpdac>" class="input-small" readonly>
                                        <span class="add-on"> <i class="icon-time"></i></span>
                                    </div>
                                </div>
                            </div>														
							<div id="messages" class="control-group">
								<label class="control-label"><phpdac>i18nL.translate use messages+RCCONTROLPANEL</phpdac></label>
								<div class="controls">
									<select id="messages" multiple="multiple" style="height:60px;width:100%;">
										<phpdac>rcbulkmail.viewMessages</phpdac>
									</select>
									<div id="message_p"></div>	
								</div>
							</div>		

                            <!--div class="form-actions">
								<-hpdac>rcbulkmail.controlCamp</phpda->
								<input type="hidden" name="FormName" value="cpsubsend" />
								<input type="hidden" name="FormAction" value="<phpdac>cms.nvl use rcbulkmail.sendOk+cppreviewcamp+cpsubsend+</phpdac>" />
								<input type="hidden" name="xcid" value="<phpdac>cms.echostr use rcbulkmail.cid</phpdac>">
								<input type="hidden" name="bid" value="<phpdac>cms.echostr use rcbulkmail.batchid</phpdac>">
                            </div-->										
							
                            </form>
                            <!-- END FORM-->
							
							<div class="form-actions">
								<!--button type='submit' onClick='startcampaign()' class='btn btn-danger'>start</button-->
								<phpdac>rcbulkmail.controlCamp use 1</phpdac>
							</div>							
							
							<?METRO/INDEX?>
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
            </div>			
            <div class="row-fluid">
                 <div class="span12">
					 
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

   <!--script src="js/jquery-1.8.2.min.js"></script-->
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="js/jquery.blockui.js"></script>
   
   <!--script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
   <script src="js/jQuery.dualListBox-1.3.js" language="javascript" type="text/javascript"></script-->  

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   
   <script type="text/javascript" src="assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
   <script type="text/javascript" src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
   <script type="text/javascript" src="assets/clockface/js/clockface.js"></script>
   <script type="text/javascript" src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
   <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
   <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
   <script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
   <!--script type="text/javascript" src="assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script reload out of frame-->  
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
	   
		<phpdac>rcbulkmail.javascript_code</phpdac>	   
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

   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->     

</body>
<!-- END BODY -->
</html>