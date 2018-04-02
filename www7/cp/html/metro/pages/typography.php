<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Typography</title>
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

   <link href="assets/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet"/>
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
                <div class="span8" id="right_column">
                <!-- BEGIN GENERAL PORTLET-->
                <div class="widget green">
                    <div class="widget-title">
                        <h4><i class=" icon-trophy"></i>  General</h4>
									<span class="tools">
									<a href="javascript:;" class="icon-chevron-down"></a>
									<a href="javascript:;" class="icon-remove"></a>
									</span>
                    </div>
                    <div class="widget-body">
                        <div class="row-fluid">
                            <div class="span6">
                                <h3>Headings</h3>
                                <h1>h1. Heading 1</h1>
                                <h2>h2. Heading 2</h2>
                                <h3>h3. Heading 3</h3>
                                <h4>h4. Heading 4</h4>
                                <h5>h5. Heading 5</h5>
                                <h6>h6. Heading 6</h6>
                            </div>
                            <div class="span6">
                                <h3>Texts</h3>
                                <p class="muted">Fusce dapibus, tellus ac cursus commodo, tortor mauris nibh.</p>
                                <p class="text-warning">Etiam porta sem malesuada magna mollis euismod.</p>
                                <p class="text-error">Donec ullamcorper nulla non metus auctor fringilla.</p>
                                <p class="text-info">Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis.</p>
                                <p class="text-success">Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- END GENERAL PORTLET-->

                <!-- BEGIN SAMPLE PORTLET-->
                <div class="widget yellow">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i>  Sample Text</h4>
									<span class="tools">
									<a href="javascript:;" class="icon-chevron-down"></a>
									<a href="javascript:;" class="icon-remove"></a>
									</span>
                    </div>
                    <div class="widget-body">
                        <div class="row-fluid">
                            <div class="span6">
                                <h3>Sample text with lead body</h3>
                                <p class="lead">
                                    Lead body. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at. Nulla tellus elit, varius non commodo eget, mattis vel eros. In sed ornare nulla.
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at. Nulla tellus elit, varius non commodo eget, mattis vel eros. In sed ornare nulla.
                                </p>
                            </div>
                            <div class="span6">
                                <h3>Sample text</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at. Nulla tellus elit, varius non commodo eget, mattis vel eros. In sed ornare nulla.
                                </p>
                                <p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui.</p>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6">
                                <h3>Address</h3>
                                <div class="well">
                                    <address>
                                        <strong>Vector Lab, Inc.</strong><br />
                                        Dreamland Ave, Suite 73<br />
                                        AU, PC 1361<br />
                                        <abbr title="Phone">P:</abbr> (123) 456-7891
                                    </address>
                                    <address>
                                        <strong>Full Name</strong><br />
                                        <a href="mailto:#">first.last@email.com</a>
                                    </address>
                                </div>
                            </div>
                            <div class="span6">
                                <h3>Some more text here</h3>
                                <p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SAMPLE PORTLET-->

                <!-- BEGIN BLOCKQUOTES PORTLET-->
                <div class="widget blue">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Blockquotes</h4>
									<span class="tools">
									<a href="javascript:;" class="icon-chevron-down"></a>
									<a href="javascript:;" class="icon-remove"></a>
									</span>
                    </div>
                    <div class="widget-body">
                        <blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Duis mollis, est non commodo luctus, nisi erat porttitor ligula integer posuere erat a ante.</p>
                        </blockquote>
                        <blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                            <small>Someone famous <cite title="Source Title">Source Title</cite></small>
                        </blockquote>
                        <div class="clearfix">
                            <blockquote class="pull-right">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                <small>Someone famous <cite title="Source Title">Source Title</cite></small>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <!-- END BLOCKQUOTES PORTLET-->

                <!-- BEGIN DESCRIPTION LISTS PORTLET-->
                <div class="widget purple">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Description Lists</h4>
                                    <span class="tools">
                                    <a href="javascript:;" class="icon-chevron-down"></a>
                                    <a href="javascript:;" class="icon-remove"></a>
                                    </span>
                    </div>
                    <div class="widget-body">
                        <dl>
                            <dt>Description lists</dt>
                            <dd>A description list is perfect for defining terms. Etiam porta sem malesuada magna mollis euismod. Etiam porta sem malesuada magna mollis euismod. Etiam porta sem malesuada magna mollis euismod. Etiam porta sem malesuada magna mollis euismod.</dd>
                            <dt>Euismod</dt>
                            <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                            <dd>Donec id elit non mi porta gravida at eget metus.</dd>
                            <dt>Malesuada porta</dt>
                            <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
                            <dt>Jhon Doe </dt>
                            <dd>Etiam porta sem malesuada magna mollis euismod. Etiam porta sem malesuada magna mollis euismod. Etiam porta sem malesuada magna mollis euismod. Etiam porta sem malesuada magna mollis euismod. Etiam porta sem malesuada magna mollis euismod.</dd>
                        </dl>
                    </div>
                </div>
                <!-- END DESCRIPTION LISTS PORTLET-->
                <!-- BEGIN HORIZONTAL DESCRIPTION LISTS PORTLET-->
                <div class="widget orange">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Horizontal Description Lists</h4>
                                    <span class="tools">
                                    <a href="javascript:;" class="icon-chevron-down"></a>
                                    <a href="javascript:;" class="icon-remove"></a>
                                    </span>
                    </div>
                    <div class="widget-body">
                        <dl class="dl-horizontal">
                            <dt>Description lists</dt>
                            <dd>A description list is perfect for defining terms.</dd>
                            <dt>Euismod</dt>
                            <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                            <dd>Donec id elit non mi porta gravida at eget metus.</dd>
                            <dt>Malesuada porta</dt>
                            <dd>Etiam porta sem malesuada magna mollis euismod. Etiam porta sem malesuada magna mollis euismod. </dd>
                            <dt>Description lists</dt>
                            <dd>A description list is perfect for defining terms. A description list is perfect for defining terms. A description list is perfect for defining terms. A description list is perfect for defining terms.</dd>
                            <dt>Euismod</dt>
                            <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                            <dd>Donec id elit non mi porta gravida at eget metus.</dd>
                            <dt>Malesuada porta</dt>
                            <dd>Etiam porta sem malesuada magna mollis euismod. Etiam porta sem malesuada magna mollis euismod. </dd>
                        </dl>
                    </div>
                </div>
                <!-- END HORIZONTAL DESCRIPTION LISTS PORTLET-->
            </div>
                <div class="span4">
                <!-- BEGIN ORDERED LISTS PORTLET-->
                <div class="widget orange">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Ordered Lists</h4>
									<span class="tools">
									<a href="javascript:;" class="icon-chevron-down"></a>
                                    <a href="javascript:;" class="icon-remove"></a>
									</span>
                    </div>
                    <div class="widget-body">
                        <ol>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Consectetur adipiscing elit</li>
                            <li>Integer molestie lorem at massa</li>
                            <li>Facilisis in pretium nisl aliquet</li>
                            <li>Nulla volutpat aliquam velit</li>
                            <li>Facilisis in pretium nisl aliquet</li>
                            <li>Faucibus porta lacus fringilla vel</li>
                            <li>Aenean sit amet erat nunc</li>
                            <li>Eget porttitor lorem</li>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Consectetur adipiscing elit</li>
                            <li>Integer molestie lorem at massa</li>
                        </ol>
                    </div>
                </div>
                <!-- END ORDERED LISTS PORTLET-->
                <!-- BEGIN UNORDERED LISTS PORTLET-->
                <div class="widget">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Unordered Lists</h4>
									<span class="tools">
									<a href="javascript:;" class="icon-chevron-down"></a>
                                    <a href="javascript:;" class="icon-remove"></a>
									</span>
                    </div>
                    <div class="widget-body">
                        <ul>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Consectetur adipiscing elit</li>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Integer molestie lorem at massa</li>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Facilisis in pretium nisl aliquet</li>
                            <li>
                                Nulla volutpat aliquam velit
                                <ul>
                                    <li>Phasellus iaculis neque</li>
                                    <li>Purus sodales ultricies</li>
                                    <li>Vestibulum laoreet porttitor sem</li>
                                    <li>Ac tristique libero volutpat at</li>
                                </ul>
                            </li>
                            <li>Faucibus porta lacus fringilla vel</li>
                            <li>Aenean sit amet erat nunc</li>
                            <li>Eget porttitor lorem</li>
                        </ul>
                    </div>
                </div>
                <!-- END UNORDERED LISTS PORTLET-->
                <!-- BEGIN UNSTYLED LISTS PORTLET-->
                <div class="widget purple">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Unstyled Lists</h4>
									<span class="tools">
									<a href="javascript:;" class="icon-chevron-down"></a>
                                    <a href="javascript:;" class="icon-remove"></a>
									</span>
                    </div>
                    <div class="widget-body">
                        <ul class="unstyled">
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Consectetur adipiscing elit</li>
                            <li>Integer molestie lorem at massa</li>
                            <li>Facilisis in pretium nisl aliquet</li>
                            <li>
                                Nulla volutpat aliquam velit
                                <ul>
                                    <li>Phasellus iaculis neque</li>
                                    <li>Purus sodales ultricies</li>
                                    <li>Vestibulum laoreet porttitor sem</li>
                                    <li>Ac tristique libero volutpat at</li>
                                </ul>
                            </li>
                            <li>Faucibus porta lacus fringilla vel</li>
                            <li>Aenean sit amet erat nunc</li>
                            <li>Eget porttitor lorem</li>
                            <li>Aenean sit amet erat nunc</li>
                            <li>Lorem ipsum dolor sit amet</li>
                        </ul>
                    </div>
                </div>
                <!-- END UNSTYLED LISTS PORTLET-->
                <!-- BEGIN UNSTYLED LISTS PORTLET-->
                <div class="widget green">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Letter List </h4>
									<span class="tools">
									<a href="javascript:;" class="icon-chevron-down"></a>
                                    <a href="javascript:;" class="icon-remove"></a>
									</span>
                    </div>
                    <div class="widget-body">
                        <ul class="upper-alpha">
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Consectetur adipiscing elit</li>
                            <li>Integer molestie lorem at massa</li>
                            <li>Facilisis in pretium nisl aliquet</li>
                            <li>
                                Nulla volutpat aliquam velit
                                <ul>
                                    <li>Phasellus iaculis neque</li>
                                    <li>Purus sodales ultricies</li>
                                    <li>Vestibulum laoreet porttitor sem</li>
                                    <li>Ac tristique libero volutpat at</li>
                                </ul>
                            </li>
                            <li>Faucibus porta lacus fringilla vel</li>
                            <li>Aenean sit amet erat nunc</li>
                            <li>Eget porttitor lorem</li>
                            <li>Aenean sit amet erat nunc</li>
                            <li>Lorem ipsum dolor sit amet</li>
                        </ul>
                    </div>
                </div>
                <!-- END UNSTYLED LISTS PORTLET-->
                <!-- BEGIN UNSTYLED LISTS PORTLET-->
                <div class="widget blue">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Roman List  </h4>
									<span class="tools">
									<a href="javascript:;" class="icon-chevron-down"></a>
                                    <a href="javascript:;" class="icon-remove"></a>
									</span>
                    </div>
                    <div class="widget-body">
                        <ul class="roman-list">
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Consectetur adipiscing elit</li>
                            <li>Integer molestie lorem at massa</li>
                            <li>Facilisis in pretium nisl aliquet</li>
                            <li>
                                Nulla volutpat aliquam velit
                                <ul>
                                    <li>Phasellus iaculis neque</li>
                                    <li>Purus sodales ultricies</li>
                                    <li>Vestibulum laoreet porttitor sem</li>
                                    <li>Ac tristique libero volutpat at</li>
                                </ul>
                            </li>
                            <li>Faucibus porta lacus fringilla vel</li>
                            <li>Aenean sit amet erat nunc</li>
                            <li>Eget porttitor lorem</li>
                            <li>Aenean sit amet erat nunc</li>
                            <li>Lorem ipsum dolor sit amet</li>
                        </ul>
                    </div>
                </div>
                <!-- END UNSTYLED LISTS PORTLET-->
                <!-- BEGIN ICONIN LISTS PORTLET-->
                <div class="widget yellow">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Iconic Lists</h4>
									<span class="tools">
									<a href="javascript:;" class="icon-chevron-down"></a>
                                    <a href="javascript:;" class="icon-remove"></a>
									</span>
                    </div>
                    <div class="widget-body">
                        <ul class="unstyled icons">
                            <li><i class="icon-ok"></i>  Lorem ipsum dolor sit amet</li>
                            <li><i class="icon-fire"></i>  Consectetur adipiscing elit</li>
                            <li><i class="icon-bolt"></i>  Integer molestie lorem at massa</li>
                            <li><i class="icon-pencil"></i>  Facilisis in pretium nisl aliquet</li>
                            <li><i class="icon-book"></i> 
                                Nulla volutpat aliquam velit
                                <ul class="icons">
                                    <li><i class="icon-leaf"></i>  Phasellus iaculis neque</li>
                                    <li><i class="icon-link"></i>  Purus sodales ultricies</li>
                                    <li><i class="icon-lock"></i>  Vestibulum laoreet porttitor sem</li>
                                    <li><i class="icon-random"></i>  Ac tristique libero volutpat at</li>
                                </ul>
                            </li>
                            <li><i class="icon-pushpin"></i>  Faucibus porta lacus fringilla vel</li>
                            <li><i class="icon-plane"></i>  Aenean sit amet erat nunc</li>
                            <li><i class="icon-cogs"></i>  Eget porttitor lorem</li>
                        </ul>
                    </div>
                </div>
                <!-- END ICONIC LISTS PORTLET-->

            </div>
            </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->  
   </div>
   </div>
   <!-- END CONTAINER -->

   <!-- BEGIN FOOTER -->
	<phpdac>frontpage.include_part use /parts/footer.php+++metro</phpdac>
   <!-- END FOOTER -->

   <!-- BEGIN JAVASCRIPTS -->    
   <!-- Load javascripts at bottom, this will reduce page load time -->
   <script src="js/jquery-1.8.3.min.js"></script>
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   <script src="assets/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
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


   <!-- END JAVASCRIPTS -->
   <phpdac>frontpage.include_part use /parts/google-analytics.php+++meteor</phpdac>
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->        
</body>
<!-- END BODY -->
</html>