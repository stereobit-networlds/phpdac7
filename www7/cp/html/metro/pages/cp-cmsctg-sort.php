<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Sort items</title>
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
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>	
   <!--div id="container" class="row-fluid">
      <div id="main-content">
         <div class="container-fluid"-->

            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget yellow">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> <phpdac>frontpage.slocale use _sortitems</phpdac></h4>
							<span class="tools">
								<a href="javascript:;" class="icon-chevron-down"></a>
							</span>
							<div class="update-btn">
								<a href="JavaScript:void(0);" id="btn-up" class="btn"><i class="icon-long-arrow-up"></i> Up</a>
								<a href="JavaScript:void(0);" id="btn-down" class="btn"><i class="icon-long-arrow-down"></i> Dn</a>
                                <phpdac>rccmsctg.selectFieldButton</phpdac>
                                <a href="<phpdac>rctreedescr.selectFieldUrl</phpdac>" class="btn"><i class="icon-repeat"></i> Default</a>
                            </div>
                        </div>	
						<div class="widget-body form">
                        <div>								
                            <table style="width: 100%;" class="">
                            <tr>
                                <td style="width: 100%">
								<form id="sortCollection" name="sortCollection" action="cpcmslandp.php?t=cpsortsave" method="post">
								<input type="hidden" name="FormName" value="cpsortsave" />
								<input type="hidden" name="FormAction" value="cpsortsave" />
								<input type="hidden" name="mode" value="<phpdac>frontpage.echostr use mode</phpdac>" />
								<input type="hidden" name="id" value="<phpdac>frontpage.echostr use id</phpdac>" />
                                    <select id="col-sort" name="mylandlist[]" multiple="multiple" style="height:400px;width:100%;">
									<phpdac>rccmsctg.viewList</phpdac>
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
			
			<div class="row-fluid">
                 <div class="span12">
					 <?METRO/INDEX?>
                 </div>
            </div>
			 
            <!-- END PAGE CONTENT-->
         <!--/div>		
      </div>
   </div-->

   
   <!-- BEGIN JAVASCRIPTS -->
   <!-- Load javascripts at bottom, this will reduce page load time -->

   <script src="js/jquery-1.8.3.min.js"></script>
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
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
   <!--script src="js/form-component.js"></script-->
        
  <!-- END JAVASCRIPTS -->	
   <script language="javascript" type="text/javascript">
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
	
});		   
	   
   </script>  
	<!-- e-Enterprise, stereobit.networlds (phpdac5) -->   
</body>
<!-- END BODY -->
</html>