<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Mail</title>
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

    <link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen/chosen.css" />


    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> 
	
   <script src="http://www.xix.gr/ckeditor/ckeditor.js"></script>	
   	
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
                 <div class="span12">
                    <!-- BEGIN  widget-->
                    <div class="widget yellow">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Content</h4>
                        <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <a href="javascript:;" class="icon-remove"></a>
                           </span>
                        </div>	
						<div class="widget-body form">						
							<?METRO/INDEX?>
                        </div>
                    </div>					 
                 </div>
             </div>
			 
	
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORMPORTLET-->
                    <div class="widget orange">
                        <div class="widget-title">
                            <h4>
                                <i class="icon-reorder"></i> Dual Select
                            </h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
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

                                                <select id="box1View" multiple="multiple" style="height:300px;width:75%">

                                                    <option value="501649">2008-2009 "Mini" Baja</option>

                                                    <option value="501497">AAPA - Asian American Psychological Association</option>

                                                    <option value="501053">Academy of Film Geeks</option>

                                                    <option value="500001">Accounting Association</option>

                                                    <option value="501227">ACLU</option>

                                                    <option value="501610">Active Minds</option>

                                                    <option value="501514">Activism with A Reel Edge (A.W.A.R.E.)</option>

                                                    <option value="501656">Adopt a Grandparent Program</option>

                                                    <option value="501050">Africa Awareness Student Organization</option>

                                                    <option value="501075">African Diasporic Cultural RC Interns</option>

                                                    <option value="501493">Agape</option>

                                                    <option value="501562">AGE-Alliance for Graduate Excellence</option>

                                                    <option value="500676">AICHE (American Inst of Chemical Engineers)</option>

                                                    <option value="501460">AIDS Sensitivity Awareness Project ASAP</option>

                                                    <option value="500004">Aikido Club</option>

                                                    <option value="500336">Akanke</option>

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

                                                <select id="box2View" multiple="multiple" style="height:300px;width:75%;">

                                                </select><br/>

                                                <span id="box2Counter" class="countLabel"></span>

                                                <select id="box2Storage">

                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="mtop20">
                                    <input type="submit" value="Submit" class="btn"/>
                                </div>
                            </form>
                            <!-- END DUAL SELECT-->
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
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

   <script src="js/jquery-1.8.2.min.js"></script>
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <!--script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script-->
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <!--script type="text/javascript" src="assets/bootstrap/js/bootstrap-fileupload.js"></script-->
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
   <!-- END JAVASCRIPTS --> 

	<phpdac>frontpage.include_part use /parts/google-analytics.php+++meteor</phpdac>
	<!-- e-Enterprise, stereobit.networlds (phpdac5) -->   
</body>
<!-- END BODY -->
</html>