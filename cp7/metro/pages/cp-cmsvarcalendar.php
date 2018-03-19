<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Calendar</title>
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
   <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />    
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
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
                <div class="span3">
					<div class="btn-toolbar">
						<?METRO/INDEX?>
						<hr/>
					</div>	
					
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-calendar"></i> <phpdac>frontpage.slocale use RCCMSVARIABLES_DPC</phpdac></h4>
                        </div>
                        <div class="widget-body">
                            <div id='external-events'>
                                <!--div class='external-event label'>My Event 1</div-->
								<phpdac>rccmsvariables.variablesDrugList use <div class='external-event label'>+</div></phpdac>
                            </div>
                        </div>
                    </div>

                    <div class="widget blue">
                        <div class="widget-title">
                            <h4><i class="icon-calendar"></i> <phpdac>frontpage.slocale use RCCMSVARIABLES_DPC</phpdac></h4>
                        </div>
                        <div class="widget-body">
                            <div id='external-events'>
								<div class='external-event label'><phpdac>frontpage.slocale use _newvar</phpdac></div>
								<phpdac>rccmsvariables.timevariablesDrugList use <div class='external-event label'>+</div></phpdac>
                                <p>
                                    <input type='checkbox' id='drop-remove' />
                                    <phpdac>cms.slocale use _remafterdrop</phpdac>
                                </p>								
                            </div>
                        </div>
                    </div>					

                </div>
                <div class="span9 responsive" data-tablet="span9 fix-margin" data-desktop="span9">
					<div class="btn-toolbar">
						<button type="button" class="btn" id="save"><phpdac>cms.slocale use _save</phpdac></button>
						<hr/>
					</div>
                    <!-- BEGIN CALENDAR PORTLET-->
                    <div class="widget yellow">
                        <div class="widget-title">
                            <h4><i class="icon-calendar"></i> <phpdac>frontpage.slocale use _calendar</phpdac></h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div id="calendar" class="has-toolbar"></div>
                        </div>
                    </div>
                    <!-- END CALENDAR PORTLET-->
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
   <script src="js/jquery-1.8.3.min.js"></script>
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <script type="text/javascript" src="assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>
   <script type="text/javascript" src="assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
   <script src="assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->

   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>
   
   <!--script for this page only-->
   <!--script src="js/external-dragging-calendar.js"></script-->   
   <script>
	var Script = function () {


    /* initialize the external events
     -----------------------------------------------------------------*/

    $('#external-events div.external-event').each(function() {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
        });

    });


    /* initialize the calendar
     -----------------------------------------------------------------*/

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function(date, allDay) { // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			
            //alert(copiedEventObject.title + " was dropped on " + copiedEventObject.start); 
			var start = $.fullCalendar.formatDate(copiedEventObject.start, "yyyy-MM-dd' 'HH:mm:ss");
			var end = $.fullCalendar.formatDate(copiedEventObject.start, "yyyy-MM-dd' '23:59:00");			
			$.ajax({
				type: 'POST',
				url: 'cpcmsvars.php?t=cpcmssavecalendar',
				data: {'event': copiedEventObject.id, 
					   'title': copiedEventObject.title,
				       'start': start, 
					   'stop': end},
				success: function(msg) {
					//alert(msg);
					location.reload(); //due to id loss drug error
				}
			});
			
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }

        },
		events : [ <phpdac>rccmsvariables.calendarEvents</phpdac> ],
		eventClick: function(event, element) {
						event.title = event.title + " CLICKED!";
						$('#calendar').fullCalendar('updateEvent', event);
					},
		eventDrop:  function(event, delta, revertFunc) {
						var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd' 'HH:mm:ss");
						var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd' '23:59:00");
						$.ajax({
							type: 'POST',
							url: 'cpcmsvars.php?t=cpcmssavecalendar',
							data: {'event': event.id, 'start': start, 'stop': end},
							success: function(msg) {
								//alert(msg);
							}
						});							
					},	
		eventResize:function(event, revertFunc) {
						var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd' 'HH:mm:ss");
						var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd' '23:59:00");
						$.ajax({
							type: 'POST',
							url: 'cpcmsvars.php?t=cpcmssavecalendar',
							data: {'event': event.id, 'start': start, 'stop': end},
							success: function(msg) {
								//alert(msg);
							}
						});						
					}					
    });


	}();  

/*
events: {url:'cpcmsvars.php?t=cpcmscalevents'}	
events: [ <phpdac>rccmsvariables.calendarEvents</phpdac> ]
	
$('#save').click(function() {
  $.ajax({
    type: 'POST',
    url: 'cpcmsvars.php?t=cpcmssavecalendar',
    data: {'event': '', 'start': '', 'stop': ''},
    success: function(msg) {
      alert(msg);
    }
  });
});		
*/
   </script>

   <!-- END JAVASCRIPTS -->  
</body>
<!-- END BODY -->
</html>