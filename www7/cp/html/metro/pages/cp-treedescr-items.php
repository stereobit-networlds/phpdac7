<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Item descriptors</title>
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
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> 	
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
                    <!-- BEGIN SAMPLE FORMPORTLET-->
                    <div class="widget orange">
                        <div class="widget-title">
                            <h4>
                                <i class="icon-reorder"></i> <phpdac>cms.slocale use _treeattach</phpdac> <phpdac>rctreedescr.currentSelectedTree</phpdac>
                            </h4>
							<div class="update-btn">
								<phpdac>rctreedescr.selectFieldButton</phpdac>
                                <a href="<phpdac>rctreedescr.selectFieldUrl</phpdac>" class="btn"><i class="icon-repeat"></i> Default</a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <!-- BEGIN DUAL SELECT-->
                            <form name="form1" method="post" action="#" id="form1">
                                <div>
                                    <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKMTk5MjI0ODUwOWRkJySmk0TGHOhSY+d9BU9NHeCKW6o=" />
                                </div>
                                <div>							
                                    <table style="width: 100%;" class="">
                                        <tr>
                                            <td style="width: 35%">
                                                <div class="d-sel-filter">
                                                    <span>Filter:</span>
                                                    <input type="text" id="box1Filter" />
                                                    <button type="button" class="btn" id="box1Clear">X</button>
                                                </div>

                                                <select name="tlist[]" id="box1View" multiple="multiple" style="height:300px;width:75%">
                                                    <phpdac>rctreedescr.getCurrentList</phpdac>
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

                                                <select name="mytreedescr[]" id="box2View" multiple="multiple" style="height:300px;width:75%;">
													<phpdac>rctreedescr.viewList</phpdac>
                                                </select><br/>

                                                <span id="box2Counter" class="countLabel"></span>

                                                <select id="box2Storage">

                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
							
                                <div class="mtop20">
									<phpdac>rctreedescr.postSubmit use cpsavetree+Ok+btn</phpdac>
                                </div>
                            </form>
                            <!-- END DUAL SELECT-->
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
         <!--/div>		
      </div>
   </div-->

   
   <!-- BEGIN JAVASCRIPTS -->
   <!-- Load javascripts at bottom, this will reduce page load time -->

   <script src="js/jquery-1.8.2.min.js"></script>
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="js/jquery.blockui.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->

   <script type="text/javascript" src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
   <script type="text/javascript" src="assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>

   <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
   <script src="js/jQuery.dualListBox-1.3.js" language="javascript" type="text/javascript"></script>


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
	<!-- e-Enterprise, stereobit.networlds (phpdac5) -->   
</body>
<!-- END BODY -->
</html>