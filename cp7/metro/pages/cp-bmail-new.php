<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Create content</title>
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
                    <div class="widget box red">			
                        <div class="widget-title">
                            <h4>
                                <i class="icon-reorder"></i> <phpdac>frontpage.slocale use _templatewiz</phpdac></span>
                            </h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <!--a href="javascript:;" class="icon-remove"></a-->
                        </span>
                        </div>
                        <div class="widget-body">
                            <form id="tForm" method="post" action="cpbulkmail.php" class="form-horizontal">
							    <input type="hidden" name="stemplate" value="<phpdac>fronthtmlpage.echostr use stemplate</phpdac>" />
								<input type="hidden" name="FormName" value="cptemplatenew" />
								<input type="hidden" name="FormAction" value="cptemplatesav" />
								
                                <div id="tabsleft" class="tabbable tabs-left">
                                <ul>
                                    <li><a href="#tabsleft-tab1" data-toggle="tab"><span class="strong"><phpdac>frontpage.slocale use _step</phpdac> 1</span> <span class="muted"><phpdac>frontpage.slocale use _content</phpdac></span></a></li>
                                    <li><a href="#tabsleft-tab2" data-toggle="tab"><span class="strong"><phpdac>frontpage.slocale use _step</phpdac> 2</span> <span class="muted"><phpdac>frontpage.slocale use _components</phpdac></span></a></li>
                                    <li><a href="#tabsleft-tab3" data-toggle="tab"><span class="strong"><phpdac>frontpage.slocale use _step</phpdac> 3</span> <span class="muted"><phpdac>frontpage.slocale use _pattern</phpdac></span></a></li>
                                    <li><a href="#tabsleft-tab4" data-toggle="tab"><span class="strong"><phpdac>frontpage.slocale use _step</phpdac> 4</span> <span class="muted"><phpdac>frontpage.slocale use _preview</phpdac></span></a></li>
                                </ul>
                                <div class="progress progress-info progress-striped">
                                    <div class="bar"></div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tabsleft-tab1">
                                        <h3><phpdac>frontpage.slocale use _content</phpdac> <?METRO/INDEX?></h3>
										<div id="controls" class="control-group">
											<phpdac>rcbulkmail.viewTemplateCopy</phpdac>
											<input class=" " name="tmplname" value="<phpdac>fronthtmlpage.nvldac2 use rcbulkmail.savedname+fronthtmlpage.echostr:rcbulkmail.savedname+fronthtmlpage.echostr:rcbulkmail.template</phpdac>" type="text" placeholder="<phpdac>frontpage.slocale use _title</phpdac>" />
											<a href="cpbulkmail.php?t=cpsubloadhtmlmail&stemplate=<phpdac>fronthtmlpage.nvldac2 use rcbulkmail.savedname+fronthtmlpage.echostr:rcbulkmail.savedname+fronthtmlpage.echostr:rcbulkmail.template</phpdac>" class="btn"><i class="icon-envelope"></i> <phpdac>frontpage.slocale use _startcamp</phpdac></a>
										</div>																			
										
										<div id="template" class="control-group">
										<div class="control-group">
											<textarea class="span12 ckeditor" name="template_text" rows="8">
											<phpdac>fronthtmlpage.calldpc_var use rcbulkmail.newtemplatebody</phpdac>
											</textarea>
                                        	<phpdac>rcbulkmail.ckeditorjs use template_text</phpdac>										
										</div>
										</div>
                                    </div>
                                    <div class="tab-pane" id="tabsleft-tab2">
                                        <h3><phpdac>frontpage.slocale use _components</phpdac></h3>									
										<div id="components" class="control-group">
											<textarea class="span12 ckeditor" name="subtemplate_text" rows="8">
											<phpdac>fronthtmlpage.calldpc_var use rcbulkmail.newsubtemplatebody</phpdac>
											</textarea>
                                        	<!--hpdac>rcbulkmail.ckeditorjs use subtemplate_text+minimize</phpda-->
										</div>
                                    </div>
                                    <div class="tab-pane" id="tabsleft-tab3">
                                        <h3><phpdac>frontpage.slocale use _pattern</phpdac></h3>										
										<div id="pattern" class="control-group">
											<textarea class="span12" name="pattern_text" rows="8"><phpdac>fronthtmlpage.calldpc_var use rcbulkmail.newpatternbody</phpdac></textarea>
										</div>										
                                    </div>
														
                                    <div class="tab-pane" id="tabsleft-tab4">
                                        <h3><phpdac>frontpage.slocale use _preview</phpdac></h3>
										<div id="preview" class="control-group">
											<phpdac>rcbulkmail.renderTemplate</phpdac>	
										</div>											
                                    </div>
                                    <ul class="pager wizard">
                                        <li class="previous"><a href="javascript:;"><phpdac>frontpage.slocale use _prev</phpdac></a></li>
                                        <li class="next"><a href="javascript:;"><phpdac>frontpage.slocale use _next</phpdac></a></li>
                                        <li class="next finish" style="display:none;"><a href="javascript:document.getElementById('tForm').submit();"><phpdac>frontpage.slocale use _finish</phpdac></a></li>
                                    </ul>
                                    </ul>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
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
              { element : '#template', 'tooltip' : 'Βήματα κατασκευής εικαστικού προτύπου', 'position' : 'TL', 'text' : '<h3>Template wizard</h3><p>Με την επιλογή και τις ενέργειες σχεδίασης, μπορείτε να δημιουργήσετε ή να επεξεργαστείτε το πρωτότυπο περιεχόμενο.</p>'  },
              { element : '#controls', 'tooltip' : 'Επιλογή εικαστικού θέματος', 'position' : 'TL', 'text' : '<h3>Αντιγραφή ή μεταβολή εικαστικού</h3><p>Επιλέξτε ένα απο τα έτοιμα εικαστικά θέματα. Φόρτώστε το περιεχόμενο τους και επανασχεδιάστε το. Εναλλακτικά, δημιουγήστε ένα νέο σχεδιο έχοντας ως βάση αυτό που φορτώσατε, αποθηκεύοντας το με διαφορετικό όνομα. Μόλις ολοκληρώσετε τις ρυθμίσεις και εφόσον αποθηκέυσετε το περιεχόμενο μπορείτε να μεταβείτε στις αποστολές δημιουργώντας μια νέα καμπάνια βασισμένη στο σχεδιαστικό που δημιουργήσατε.</p>' },
			  { element : '.pager.wizard', 'tooltip' : 'Πατήστε Next', 'position' : 'BR', 'text' : '<h3>Πατήστε Next</h3><p>Πατήστε το πλήκρο Next για να συνεχίσετε.</p>' },
              { element : '#components', 'tooltip' : 'Στοιχεία επεξεργασίας', 'position' : 'T' , 'text' : '<h3>Στοιχεία</h3><p>Ρυθμίσεις που αφορούν το πώς εμφωλιάζεται το γενικό γραφιστικό θέμα σε πιο εξειδικευμένα στοιχεία απεικόνισης.</p>' },
			  { element : '.pager.wizard', 'tooltip' : 'Πατήστε Next', 'position' : 'BR', 'text' : '<h3>Πατήστε Next</h3><p>Πατήστε το πλήκρο Next για να συνεχίσετε.</p>' },
              { element : '#pattern', 'tooltip' : 'Πατρόν', 'position' : 'TL', 'text' : '<h3>Πατρόν</h3><p>Ειδικές ρυθμίσεις που αφορούν την τοποθέτηση των αντικειμένων.</p>' },
			  { element : '.pager.wizard', 'tooltip' : 'Πατήστε Next', 'position' : 'BR', 'text' : '<h3>Πατήστε Next</h3><p>Πατήστε το πλήκρο Next για να συνεχίσετε.</p>' },
              { element : '#preview', 'tooltip' : 'Προεπισκόπηση', 'position' : 'TL', 'text' : '<h3>Προεπισκόπηση</h3><p>Δείτε πως εμαφνίζεται το εικαστικό στην οθόνη σας και ρυθμίστε ανάλογα με το αποτέλεσμα που θέλετε.</p>' },
			  { element : '.pager.wizard', 'tooltip' : 'Τέλος ρυθμίσεων', 'position' : 'BR', 'text' : '<h3>Τέλος ρυθμίσεων</h3><p>Εφόσον ολοκληρώσετε την σχεδίαση του εικαστικού προτύπου πατήστε το πλήκρο Finish για να αποθηκέυσετε τις αλλαγές.</p>' }
            ] ,
            controlsPosition : 'BR'
          };

        $.aSimpleTour(options);  
    });	
	
});	  
	   
   </script>
   <script src="js/aSimpleTour.js" type="text/javascript"></script>
   
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->     

</body>
<!-- END BODY -->
</html>