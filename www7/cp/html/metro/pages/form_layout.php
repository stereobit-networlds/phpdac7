<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Form Layouts</title>
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
                    <!-- BEGIN SAMPLE FORMPORTLET-->
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Form Layouts</h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <!-- BEGIN FORM-->
                            <form action="#" class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label">Mini Input</label>
                                    <div class="controls">
                                        <input type="text" placeholder=".input-mini" class="input-mini" />
                                        <span class="help-inline">Some hint here</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Small Input</label>
                                    <div class="controls">
                                        <input type="text" placeholder=".input-small" class="input-small" />
                                        <span class="help-inline">Some hint here</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Meduam Input</label>
                                    <div class="controls">
                                        <input type="text" placeholder=".input-medium" class="input-medium" />
                                        <span class="help-inline">Some hint here</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Large Input</label>
                                    <div class="controls">
                                        <input type="text" placeholder=".input-large" class="input-large" />
                                        <span class="help-inline">Some hint here</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">xLarge Input</label>
                                    <div class="controls">
                                        <input type="text" placeholder=".input-xlarge" class="input-xlarge" />
                                        <span class="help-inline">Some hint here</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">xxLarge Input</label>
                                    <div class="controls">
                                        <input type="text" placeholder=".input-xxlarge" class="input-xxlarge" />
                                        <span class="help-inline">Some hint here</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Disabled Input</label>
                                    <div class="controls">
                                        <input class="medium" type="text" placeholder="Disabled input here..." disabled />
                                        <span class="help-inline">Some hint here</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Readonly Input</label>
                                    <div class="controls">
                                        <input class="medium" readonly type="text" placeholder="Readonly input here..." disabled />
                                        <span class="help-inline">Some hint here</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Small Dropdown</label>
                                    <div class="controls">
                                        <select class="input-small m-wrap" tabindex="1">
                                            <option value="Category 1">Category 1</option>
                                            <option value="Category 2">Category 2</option>
                                            <option value="Category 3">Category 5</option>
                                            <option value="Category 4">Category 4</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Medium Dropdown</label>
                                    <div class="controls">
                                        <select class="input-medium m-wrap" tabindex="1">
                                            <option value="Category 1">Category 1</option>
                                            <option value="Category 2">Category 2</option>
                                            <option value="Category 3">Category 5</option>
                                            <option value="Category 4">Category 4</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Large Dropdown</label>
                                    <div class="controls">
                                        <select class="input-large m-wrap" tabindex="1">
                                            <option value="Category 1">Category 1</option>
                                            <option value="Category 2">Category 2</option>
                                            <option value="Category 3">Category 5</option>
                                            <option value="Category 4">Category 4</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Radio Buttons</label>
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios1" value="option1" />
                                            Option 1
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios1" value="option2" checked />
                                            Option 2
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios1" value="option2" />
                                            Option 3
                                        </label>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Radio Buttons</label>
                                    <div class="controls">
                                        <label class="radio line">
                                            <input type="radio" name="optionsRadios2" value="option1" />
                                            Option 1
                                        </label>
                                        <label class="radio line">
                                            <input type="radio" name="optionsRadios2" value="option2" checked />
                                            Option 2
                                        </label>
                                        <label class="radio line">
                                            <input type="radio" name="optionsRadios2" value="option2" />
                                            Option 3
                                        </label>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Checkbox</label>
                                    <div class="controls">
                                        <label class="checkbox">
                                            <input type="checkbox" value="" /> Checkbox 1
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" /> Checkbox 2
                                        </label>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Checkbox</label>
                                    <div class="controls">
                                        <label class="checkbox line">
                                            <input type="checkbox" value="" /> Checkbox 1
                                        </label>
                                        <label class="checkbox line">
                                            <input type="checkbox" value="" /> Checkbox 2
                                        </label>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Textarea</label>
                                    <div class="controls">
                                        <textarea class="input-medium" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Large Textarea</label>
                                    <div class="controls">
                                        <textarea class="input-large" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">xLarge Textarea</label>
                                    <div class="controls">
                                        <textarea class="input-xlarge" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">xxLarge Textarea</label>
                                    <div class="controls">
                                        <textarea class="input-xxlarge" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="icon-ok"></i> Save</button>
                                    <button type="button" class="btn"><i class=" icon-remove"></i> Cancel</button>
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
                    <!-- BEGIN SAMPLE FORMPORTLET-->
                    <div class="widget red">
                        <div class="widget-title">
                            <h4>
                                <i class="icon-reorder"></i> Label above input (grid)
                            </h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <!-- BEGIN FORM-->
                            <form class="form-vertical" method="get" action="#">
                                <div class="row-fluid">
                                    <div class="span3">
                                        <div class="control-group">
                                            <label class="control-label" >Label 3</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span3">
                                        <div class="control-group">
                                            <label class="control-label" >label 3</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span3">
                                        <div class="control-group">
                                            <label class="control-label" >Label 3</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span3">
                                        <div class="control-group">
                                            <label class="control-label" >label 3</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span4">
                                        <div class="control-group">
                                            <label class="control-label" >label 4</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span4">
                                        <div class="control-group">
                                            <label class="control-label" >Label 4</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span4">
                                        <div class="control-group">
                                            <label class="control-label" >label 4</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span1">
                                        <div class="control-group">
                                            <label class="control-label" >Label 1</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span11">
                                        <div class="control-group">
                                            <label class="control-label" >label 11</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span2">
                                        <div class="control-group">
                                            <label class="control-label" >Label 2</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span10">
                                        <div class="control-group">
                                            <label class="control-label" >label 10</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span3">
                                        <div class="control-group">
                                            <label class="control-label" >Label 3</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span9">
                                        <div class="control-group">
                                            <label class="control-label" >label 9</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span4">
                                        <div class="control-group">
                                            <label class="control-label" >Label 4</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span8">
                                        <div class="control-group">
                                            <label class="control-label" >label 8</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span5">
                                        <div class="control-group">
                                            <label class="control-label" >Label 5</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span7">
                                        <div class="control-group">
                                            <label class="control-label" >label 7</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span6">
                                        <div class="control-group">
                                            <label class="control-label" >Label 6</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span6">
                                        <div class="control-group">
                                            <label class="control-label" >label 6</label>
                                            <div class="controls controls-row">
                                                <input type="text" class="input-block-level" placeholder="Text input"  name="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
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


   <!-- END JAVASCRIPTS -->
   <script>
       $(function () {
           $(" input[type=radio], input[type=checkbox]").uniform();
       });
   </script>

</body>
<!-- END BODY -->
</html>