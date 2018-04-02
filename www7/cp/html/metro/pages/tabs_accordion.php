<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Tabs & Accordion</title>
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
                <div class="span12">
                        <!-- BEGIN INLINE TABS PORTLET-->
                        <div class="widget orange">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Inline Tab</h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <a href="javascript:;" class="icon-remove"></a>
                           </span>
                            </div>
                            <div class="widget-body">
                                <div class="bs-docs-example">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                                        <li><a data-toggle="tab" href="#profile">Profile</a></li>
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Dropdown <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a data-toggle="tab" href="#dropdown1">@fat</a></li>
                                                <li><a data-toggle="tab" href="#dropdown2">@mdo</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div id="home" class="tab-pane fade in active">
                                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                        </div>
                                        <div id="profile" class="tab-pane fade">
                                            <p>
                                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                            </p>
                                            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                                        </div>
                                        <div id="dropdown1" class="tab-pane fade">
                                            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                        </div>
                                        <div id="dropdown2" class="tab-pane fade">
                                            <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
                                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END INLINE TABS PORTLET-->
                    </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN INLINE TABS PORTLET-->
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Inline Tabs</h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <a href="javascript:;" class="icon-remove"></a>
                           </span>
                        </div>
                        <div class="widget-body">
                            <div class="row-fluid">
                                <div class="span6">
                                    <!--BEGIN TABS-->
                                    <div class="tabbable custom-tab">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_1_1" data-toggle="tab">Section 1</a></li>
                                            <li><a href="#tab_1_2" data-toggle="tab">Section 2</a></li>
                                            <li><a href="#tab_1_3" data-toggle="tab">Section 3</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_1">
                                                <p>I'm in Section 1.</p>
                                                <p>
                                                    Phasellus fringilla suscipit risus nec eleifend. Pellentesque eu quam sem, ac malesuada leo. Sed ut quam at magna porttitor hendrerit.
                                                    Maecenas quis erat fringilla augue feugiat vulputate a eu sem.Vivamus ut diam at turpis varius tempor. Aliquam dictum sagittis erat,
                                                    vehicula adipiscing diam condimentum id.
                                                </p>
                                            </div>
                                            <div class="tab-pane" id="tab_1_2">
                                                <p>Howdy, I'm in Section 2.</p>
                                                <p>
                                                    Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur,
                                                </p>
                                            </div>
                                            <div class="tab-pane" id="tab_1_3">
                                                <p>What up girl, this is Section 3.</p>
                                                <p>
                                                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END TABS-->
                                </div>
                                <div class="space10 visible-phone"></div>
                                <div class="span6">
                                    <!--BEGIN TABS-->
                                    <div class="tabbable custom-tab tabs-below">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_2_1">
                                                <p>I'm in Section 1.</p>
                                                <p>
                                                    Phasellus fringilla suscipit risus nec eleifend. Pellentesque eu quam sem, ac malesuada leo. Sed ut quam at magna porttitor hendrerit.
                                                    Maecenas quis erat fringilla augue feugiat vulputate a eu sem.Vivamus ut diam at turpis varius tempor. Aliquam dictum sagittis erat,
                                                    vehicula adipiscing diam condimentum id.
                                                </p>
                                            </div>
                                            <div class="tab-pane" id="tab_2_2">
                                                <p>Howdy, I'm in Section 2.</p>
                                                <p>
                                                    Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur,
                                                </p>
                                            </div>
                                            <div class="tab-pane" id="tab_2_3">
                                                <p>What up girl, this is Section 3.</p>
                                                <p>
                                                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                                                </p>
                                            </div>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_2_1" data-toggle="tab">Section 1</a></li>
                                            <li><a href="#tab_2_2" data-toggle="tab">Section 2</a></li>
                                            <li><a href="#tab_2_3" data-toggle="tab">Section 3</a></li>
                                        </ul>
                                    </div>
                                    <!--END TABS-->
                                </div>
                            </div>
                            <div class="spance20"></div>
                            <div class="row-fluid">
                                <div class="span6">
                                    <!--BEGIN TABS-->
                                    <div class="tabbable custom-tab tabs-left">
                                        <!-- Only required for left/right tabs -->
                                        <ul class="nav nav-tabs tabs-left">
                                            <li class="active"><a href="#tab_3_1" data-toggle="tab">Section 1</a></li>
                                            <li><a href="#tab_3_2" data-toggle="tab">Section 2</a></li>
                                            <li><a href="#tab_3_3" data-toggle="tab">Section 3</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_3_1">
                                                <p>I'm in Section 1.</p>
                                                <p>
                                                    Phasellus fringilla suscipit risus nec eleifend. Pellentesque eu quam sem, ac malesuada leo. Sed ut quam at magna porttitor hendrerit.
                                                    Maecenas quis erat fringilla augue feugiat vulputate a eu sem.Vivamus ut diam at turpis varius tempor. Aliquam dictum sagittis erat,
                                                    vehicula adipiscing diam condimentum id.
                                                </p>
                                            </div>
                                            <div class="tab-pane" id="tab_3_2">
                                                <p>Howdy, I'm in Section 2.</p>
                                                <p>
                                                    Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur,
                                                </p>
                                            </div>
                                            <div class="tab-pane" id="tab_3_3">
                                                <p>What up girl, this is Section 3.</p>
                                                <p>
                                                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END TABS-->
                                </div>
                                <div class="space10 visible-phone"></div>
                                <div class="span6">
                                    <!--BEGIN TABS-->
                                    <div class="tabbable custom-tab tabs-right">
                                        <!-- Only required for left/right tabs -->
                                        <ul class="nav nav-tabs tabs-right">
                                            <li class="active"><a href="#tab_4_1" data-toggle="tab">Section 1</a></li>
                                            <li><a href="#tab_4_2" data-toggle="tab">Section 2</a></li>
                                            <li><a href="#tab_4_3" data-toggle="tab">Section 3</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_4_1">
                                                <p>I'm in Section 1.</p>
                                                <p>
                                                    Phasellus fringilla suscipit risus nec eleifend. Pellentesque eu quam sem, ac malesuada leo. Sed ut quam at magna porttitor hendrerit.
                                                    Maecenas quis erat fringilla augue feugiat vulputate a eu sem.Vivamus ut diam at turpis varius tempor. Aliquam dictum sagittis erat,
                                                    vehicula adipiscing diam condimentum id.
                                                </p>
                                            </div>
                                            <div class="tab-pane" id="tab_4_2">
                                                <p>Howdy, I'm in Section 2.</p>
                                                <p>
                                                    Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur,
                                                </p>
                                            </div>
                                            <div class="tab-pane" id="tab_4_3">
                                                <p>What up girl, this is Section 3.</p>
                                                <p>
                                                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END TABS-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END INLINE TABS PORTLET-->
                </div>
            </div>

            <div class="row-fluid">
                <div class="span6">
                    <!-- BEGIN TAB PORTLET-->
                    <div class="widget widget-tabs purple">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Widget Tab</h4>
                        </div>
                        <div class="widget-body">
                            <div class="tabbable ">
                                <ul class="nav nav-tabs">
                                    <li><a href="#widget_tab3" data-toggle="tab">Tab 3</a></li>
                                    <li><a href="#widget_tab2" data-toggle="tab">Tab 2</a></li>
                                    <li class="active"><a href="#widget_tab1" data-toggle="tab">Tab 1</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="widget_tab1">
                                        <p>
                                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                        </p>
                                        <p>
                                            The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="widget_tab2">
                                        <p>
                                            The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                                        </p>
                                        <p>
                                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                        </p>

                                    </div>
                                    <div class="tab-pane" id="widget_tab3">
                                        <p>
                                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                        </p>
                                        <p>
                                            The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END TAB PORTLET-->
                </div>
                <div class="span6">
                    <!-- BEGIN ACCORDION PORTLET-->
                    <div class="widget red">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Accordion</h4>
                            <span class="tools">
                           <a class="icon-chevron-down" href="javascript:;"></a>
                           <a class="icon-remove" href="javascript:;"></a>
                           </span>
                        </div>
                        <div class="widget-body">
                            <div class="accordion" id="accordion1">
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1">
                                            Collapsible Group Item #1
                                        </a>
                                    </div>
                                    <div id="collapse_1" class="accordion-body collapse in">
                                        <div class="accordion-inner">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_2">
                                            Collapsible Group Item #2
                                        </a>
                                    </div>
                                    <div id="collapse_2" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_3">
                                            Collapsible Group Item #3
                                        </a>
                                    </div>
                                    <div id="collapse_3" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- END ACCORDION PORTLET-->
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