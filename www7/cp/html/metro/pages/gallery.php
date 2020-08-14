<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Gallery</title>
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

    <link rel="stylesheet" type="text/css" href="assets/metr-folio/css/metro-gallery.css" media="screen" />


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
                            <h4><i class="icon-camera"></i> Gallery</h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div class="megaexamples">
                                <!--  FILTER STYLED  -->
                                <div class="filter_padder" >
                                    <div class="filter_wrapper">
                                        <div class="filter selected" data-category="cat-all">ALL</div>
                                        <div class="filter" data-category="cat-one">CATEGORY ONE</div>
                                        <div class="filter" data-category="cat-two">CATEGORY TWO</div>
                                        <div class="filter" data-category="cat-three">CATEGORY THREE</div>
                                        <div class="filter last-child" data-category="cat-four">CATEGORY FOUR</div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="metro-gallery">
                                    <!-- The GRID System -->
                                    <div class="metro-gal-container noborder norounded dark-bg-entries">

                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-two cat-all" id="mega-entry-1" data-src="img/gallery/image1.jpg" data-width="780" data-height="585" data-lowsize="">

                                        <div class="mega-covercaption mega-square-bottom mega-landscape-right mega-portrait-bottom mega-red">
                                            <!-- The Content Part with Hidden Overflow Container -->

                                            <div class="mega-title"><img src="img/gallery/icons/grid.png" alt="" style="float: left; padding-right: 15px;"/>Good for Nothing</div>
                                            <div class="mega-date">Lorem ipsun dolor</div>
                                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua...<br/><br/><a href="#">Read the whole story</a></p>

                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-red"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image1.jpg" title="Good for Nothing"><div class="mega-view mega-red"></div></a>
                                        </div>

                                    </div>


                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-one cat-all"  id="mega-entry-2"  data-src="img/gallery/image2.jpg" data-width="780" data-height="385" data-lowsize="">

                                        <div class="mega-covercaption mega-square-bottom mega-landscape-left mega-portrait-bottom mega-orange mega-white ">

                                            <div class="mega-title">Might is Right</div>
                                            <div class="mega-date">loerm sum doleo</div>
                                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt...</p>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-orange"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image2.jpg" title="Too Much !"><div class="mega-view mega-orange"></div></a>
                                        </div>

                                    </div>


                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-three cat-all"  id="mega-entry-3" data-src="img/gallery/image3.jpg" data-width="780" data-height="485">

                                        <div class="mega-covercaption mega-square-bottom mega-landscape-bottom mega-portrait-bottom mega-turquoise ">
                                            <div class="mega-title"><img src="img/gallery/icons/flexible.png" alt="" style="float: left; padding-right: 15px;"/>Honesty</div>
                                            <div class="mega-date">Lorem ispusn ament</div>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-turquoise"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image3.jpg" title="Might is right"><div class="mega-view mega-turquoise"></div></a>
                                        </div>

                                    </div>

                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-four cat-all"  id="mega-entry-4" data-src="img/gallery/image4.jpg" data-width="680" data-height="685">

                                        <div class="mega-covercaption mega-square-bottom mega-landscape-bottom mega-portrait-bottom mega-black ">
                                            <div class="mega-title">Hi this is Sam</div>
                                            <div class="mega-date">Lorem ipsum dolor sit</div>
                                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt...</p>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-black"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image4.jpg" title="Do the Best"><div class="mega-view mega-black"></div></a>
                                        </div>

                                    </div>

                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-one cat-all"  id="mega-entry-5" data-src="img/gallery/image5.jpg" data-width="780" data-height="585">

                                        <div class="mega-covercaption mega-square-bottom mega-landscape-bottom mega-portrait-bottom mega-violet ">
                                            <div class="mega-title"><img src="img/gallery/icons/light.png" alt="" style="float: left; padding-right: 15px;"/>Fantastic Four</div>
                                            <div class="mega-date">Lorem ipsum dolor sit</div>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons ">
                                            <a class="fancybox" rel="group" href="img/gallery/image5.jpg" title="Awesome Creativity"><div class="mega-view mega-violet"></div></a>
                                        </div>

                                    </div>

                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-two cat-all"  id="mega-entry-6" data-src="img/gallery/image6.jpg" data-width="580" data-height="435">

                                        <div class="mega-covercaption mega-square-bottom mega-landscape-left mega-portrait-bottom mega-green ">
                                            <div class="mega-title"><img src="img/gallery/icons/nike.png" alt="" style="float: left; padding-right: 15px;"/>Rainy Day</div>
                                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat....</p>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-green"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image6.jpg" title="Be Good "><div class="mega-view mega-green"></div></a>
                                        </div>

                                    </div>



                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-three cat-all"  id="mega-entry-7" data-src="img/gallery/image7.jpg" data-width="780" data-height="385">

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-green"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image7.jpg"><div class="mega-view mega-green"></div></a>
                                        </div>

                                    </div>

                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-four cat-all"  id="mega-entry-8" data-src="img/gallery/image8.jpg" data-width="780" data-height="525">

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-orange"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image8.jpg"><div class="mega-view mega-orange"></div></a>
                                        </div>

                                    </div>

                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-two cat-all"  id="mega-entry-9" data-src="img/gallery/image9.jpg" data-width="780" data-height="585">

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-black"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image9.jpg"><div class="mega-view mega-black"></div></a>
                                        </div>

                                    </div>


                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-two cat-all"  id="mega-entry-11" data-src="img/gallery/image11.jpg" data-width="780" data-height="565">

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-black"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image11.jpg"><div class="mega-view mega-black"></div></a>
                                        </div>

                                    </div>

                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-three cat-all"  id="mega-entry-12" data-src="img/gallery/image12.jpg" data-width="780" data-height="525">

                                        <div class="mega-covercaption mega-square-bottom mega-landscape-bottom mega-portrait-bottom mega-turquoise ">
                                            <div class="mega-title">Metro Style</div>
                                            <div class="mega-date">Just one thing thats possible</div>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-turquoise"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image12.jpg" title="Lorem ipsum dloe"><div class="mega-view mega-turquoise"></div></a>
                                        </div>

                                    </div>


                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-one cat-all"  id="mega-entry-10" data-src="img/gallery/image10.jpg" data-width="780" data-height="585">

                                        <div class="mega-covercaption mega-square-right mega-landscape-right mega-portrait-bottom mega-blue ">
                                            <div class="mega-title">Get Back to Work</div>
                                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr...
                                                <img src="img/gallery/icons/runner.png" alt="" style="padding-top: 15px;"/>
                                            </p>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-blue"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image10.jpg" title="Get A Move On"><div class="mega-view mega-blue"></div></a>
                                        </div>

                                    </div>

                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-four cat-all"  id="mega-entry-13" data-src="img/gallery/image14.jpg" data-width="780" data-height="585">

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-black"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image14.jpg"><div class="mega-view mega-black"></div></a>
                                        </div>

                                    </div>

                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-one cat-all"  id="mega-entry-14" data-src="img/gallery/image16.jpg" data-width="780" data-height="585">

                                        <div class="mega-covercaption mega-square-bottom mega-landscape-left mega-portrait-bottom mega-red">
                                            <div class="mega-title">Summer Wine</div>
                                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua...</p>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-orange"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image16.jpg" title="Good Morning"><div class="mega-view mega-orange"></div></a>
                                        </div>

                                    </div>


                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-two cat-all"  id="mega-entry-15" data-src="img/gallery/image13.jpg" data-width="780" data-height="585">

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-orange"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image13.jpg"><div class="mega-view mega-orange"></div></a>
                                        </div>

                                    </div>

                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-one cat-all"  id="mega-entry-25" data-src="img/gallery/image15.jpg" data-width="780" data-height="585">

                                        <div class="mega-covercaption mega-square-top mega-landscape-left mega-portrait-top mega-violet ">
                                            <div class="mega-title"><img src="img/gallery/icons/mobile.png" alt="" style="float: left; padding-right: 15px;"/>Hi There.</div>
                                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros...</p>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-violet"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image15.jpg" title="Mobile Optimized"><div class="mega-view mega-violet"></div></a>
                                        </div>

                                    </div>

                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-two cat-all"  id="mega-entry-26" data-src="img/gallery/image18.jpg" data-width="780" data-height="585">

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-blue"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image18.jpg"><div class="mega-view mega-blue"></div></a>
                                        </div>

                                    </div>

                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-three cat-all"  id="mega-entry-27" data-src="img/gallery/image17.jpg" data-width="780" data-height="585">

                                        <div class="mega-covercaption mega-square-top mega-landscape-left mega-portrait-top mega-green">
                                            <div class="mega-title"><img src="img/gallery/icons/leaf.png" alt="" style="float: left; padding-right: 15px;"/>Enjoy Youseft !</div>
                                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros...</p>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-green"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image17.jpg" title="Good Day"><div class="mega-view mega-green"></div></a>
                                        </div>

                                    </div>

                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-one cat-all" id="mega-entry-28" data-src="img/gallery/image1.jpg" data-width="780" data-height="585" data-lowsize="">

                                            <div class="mega-covercaption mega-square-right mega-landscape-right mega-portrait-bottom mega-red">
                                                <!-- The Content Part with Hidden Overflow Container -->

                                                <div class="mega-title"><img src="img/gallery/icons/grid.png" alt="" style="float: left; padding-right: 15px;"/>Lorem ipsum dolor set ament</div>
                                                <div class="mega-date">Lorem ipsum dolor sit</div>
                                                <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua...<br/><br/><a href="#">Read the whole story</a></p>

                                            </div>

                                            <!-- The Link Buttons -->
                                            <div class="mega-coverbuttons mega-square-top mega-landscape-right mega-portrait-bottom">
                                                <div class="mega-link mega-red"></div>
                                                <a class="fancybox" rel="group" href="img/gallery/image1.jpg" title="Might is right"><div class="mega-view mega-red"></div></a>
                                            </div>

                                        </div>


                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-two cat-all"  id="mega-entry-29"  data-src="img/gallery/image2.jpg" data-width="780" data-height="585" data-lowsize="">

                                            <div class="mega-covercaption mega-square-bottom mega-landscape-left mega-portrait-bottom mega-orange mega-white ">

                                                <div class="mega-title">Sumon Mosa</div>
                                                <div class="mega-date">dolro ispum imit</div>
                                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua...</p>
                                            </div>

                                            <!-- The Link Buttons -->
                                            <div class="mega-coverbuttons">
                                                <div class="mega-link mega-orange"></div>
                                                <a class="fancybox" rel="group" href="img/gallery/image2.jpg" title="Might is right"><div class="mega-view mega-orange"></div></a>
                                            </div>

                                        </div>



                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-four cat-all"  id="mega-entry-3" data-src="img/gallery/image3.jpg" data-width="780" data-height="585">

                                            <div class="mega-covercaption mega-square-top mega-landscape-bottom mega-portrait-bottom mega-turquoise ">
                                                <div class="mega-title"><img src="img/gallery/icons/flexible.png" alt="" style="float: left; padding-right: 15px;"/>Flexibility</div>
                                                <div class="mega-date">Never seen before</div>
                                            </div>

                                            <!-- The Link Buttons -->
                                            <div class="mega-coverbuttons">
                                                <div class="mega-link mega-turquoise"></div>
                                                <a class="fancybox" rel="group" href="img/gallery/image3.jpg" title="Be Happy"><div class="mega-view mega-turquoise"></div></a>
                                            </div>

                                        </div>



                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-three cat-all"  id="mega-entry-4" data-src="img/gallery/image4.jpg" data-width="780" data-height="585">

                                        <div class="mega-covercaption mega-square-bottom mega-landscape-bottom mega-portrait-bottom mega-black ">
                                            <div class="mega-title">Hi There !</div>
                                            <div class="mega-date">And so should you</div>
                                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt...</p>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-black"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image4.jpg" title="Do the Best"><div class="mega-view mega-black"></div></a>
                                        </div>

                                    </div>

                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-two cat-all"  id="mega-entry-5" data-src="img/gallery/image5.jpg" data-width="780" data-height="585">

                                        <div class="mega-covercaption mega-square-bottom mega-landscape-right mega-portrait-bottom mega-violet ">
                                            <div class="mega-title"><img src="img/gallery/icons/light.png" alt="" style="float: left; padding-right: 15px;"/>Creative Ideas</div>
                                            <div class="mega-date">Good for Nothing</div>
                                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua...</p>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-violet"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image5.jpg" title="Awesome Creativity"><div class="mega-view mega-violet"></div></a>
                                        </div>

                                    </div>


                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-one cat-all"  id="mega-entry-6" data-src="img/gallery/image6.jpg" data-width="780" data-height="585">

                                        <div class="mega-covercaption mega-square-bottom mega-landscape-left mega-portrait-bottom mega-green ">
                                            <div class="mega-title"><img src="img/gallery/icons/nike.png" alt="" style="float: left; padding-right: 15px;"/>Do the Best</div>
                                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi....</p>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-green"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image6.jpg" title="Be Good "><div class="mega-view mega-green"></div></a>
                                        </div>

                                    </div>


                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-four cat-all"  id="mega-entry-7" data-src="img/gallery/image7.jpg" data-width="780" data-height="585">

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-green"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image7.jpg"><div class="mega-view mega-green"></div></a>
                                        </div>

                                    </div>


                                    <div class="mega-entry cat-three cat-all"  id="mega-entry-8" data-src="img/gallery/image8.jpg" data-width="780" data-height="585">

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-orange"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image8.jpg"><div class="mega-view mega-orange"></div></a>
                                        </div>

                                    </div>


                                    <!-- A GALLERY ENTRY -->
                                    <div class="mega-entry cat-one cat-all"  id="mega-entry-9" data-src="img/gallery/image9.jpg" data-width="780" data-height="585">

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-black"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image9.jpg"><div class="mega-view mega-black"></div></a>
                                        </div>

                                    </div>


                                    <div class="mega-entry cat-four cat-all"  id="mega-entry-11" data-src="img/gallery/image11.jpg" data-width="780" data-height="585">

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-black"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image11.jpg"><div class="mega-view mega-black"></div></a>
                                        </div>

                                    </div>


                                  <!-- A GALLERY ENTRY -->
                                   <div class="mega-entry cat-two cat-all"  id="mega-entry-12" data-src="img/gallery/image12.jpg" data-width="780" data-height="585">

                                        <div class="mega-covercaption mega-square-bottom mega-landscape-bottom mega-portrait-bottom mega-turquoise ">
                                            <div class="mega-title">Metro Style</div>
                                            <div class="mega-date">As you so so you rep</div>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-turquoise"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image12.jpg" title="Lorem ipsum dloe"><div class="mega-view mega-turquoise"></div></a>
                                        </div>

                                    </div>


                                   <!-- A GALLERY ENTRY -->
                                   <div class="mega-entry cat-four cat-all"  id="mega-entry-10" data-src="img/gallery/image10.jpg" data-width="780" data-height="585">

                                        <div class="mega-covercaption mega-square-right mega-landscape-right mega-portrait-bottom mega-blue ">
                                            <div class="mega-title">Out or Order</div>
                                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr...
                                                <img src="img/gallery/icons/runner.png" alt="" style="padding-top: 15px;"/>
                                            </p>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-blue"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image10.jpg" title="Get A Move On"><div class="mega-view mega-blue"></div></a>
                                        </div>

                                    </div>


                                   <!-- A GALLERY ENTRY -->
                                   <div class="mega-entry cat-one cat-all"  id="mega-entry-13" data-src="img/gallery/image14.jpg" data-width="780" data-height="585">

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-black"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image14.jpg"><div class="mega-view mega-black"></div></a>
                                        </div>

                                    </div>


                                   <!-- A GALLERY ENTRY -->
                                   <div class="mega-entry cat-two cat-all"  id="mega-entry-14" data-src="img/gallery/image16.jpg" data-width="780" data-height="585">

                                        <div class="mega-covercaption mega-square-bottom mega-landscape-left mega-portrait-bottom mega-red">
                                            <div class="mega-title">Might is Right</div>
                                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua...</p>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-orange"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image16.jpg" title="Good Morning"><div class="mega-view mega-orange"></div></a>
                                        </div>

                                    </div>


                                   <!-- A GALLERY ENTRY -->
                                   <div class="mega-entry cat-one cat-all"  id="mega-entry-15" data-src="img/gallery/image13.jpg" data-width="780" data-height="585">

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-orange"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image13.jpg"><div class="mega-view mega-orange"></div></a>
                                        </div>

                                    </div>


                                   <!-- A GALLERY ENTRY -->
                                   <div class="mega-entry cat-two cat-all"  id="mega-entry-25" data-src="img/gallery/image15.jpg" data-width="780" data-height="585">

                                        <div class="mega-covercaption mega-square-bottom mega-landscape-bottom mega-portrait-top mega-violet ">
                                            <div class="mega-title"><img src="img/gallery/icons/mobile.png" alt="" style="float: left; padding-right: 15px;"/>Be Honest</div>
                                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros...</p>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-violet"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image15.jpg" title="Mobile Optimized"><div class="mega-view mega-violet"></div></a>
                                        </div>

                                    </div>


                                   <!-- A GALLERY ENTRY -->
                                   <div class="mega-entry cat-one cat-all"  id="mega-entry-26" data-src="img/gallery/image18.jpg" data-width="780" data-height="585">

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-blue"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image18.jpg"><div class="mega-view mega-blue"></div></a>
                                        </div>

                                    </div>


                                   <!-- A GALLERY ENTRY -->
                                   <div class="mega-entry cat-four cat-all"  id="mega-entry-27" data-src="img/gallery/image17.jpg" data-width="780" data-height="585">

                                        <div class="mega-covercaption mega-square-top mega-landscape-left mega-portrait-top mega-green ">
                                            <div class="mega-title"><img src="img/gallery/icons/leaf.png" alt="" style="float: left; padding-right: 15px;"/>Hi Boss !</div>
                                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros...</p>
                                        </div>

                                        <!-- The Link Buttons -->
                                        <div class="mega-coverbuttons">
                                            <div class="mega-link mega-green"></div>
                                            <a class="fancybox" rel="group" href="img/gallery/image17.jpg" title="Good Day"><div class="mega-view mega-green"></div></a>
                                        </div>

                                    </div>

                                </div>
                                </div>
                            </div>
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
   <script src="js/jquery.scrollTo.min.js"></script>
   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   <script src="assets/fancybox/source/jquery.fancybox.pack.js"></script>

   <!-- MEGAFOLIO PRO GALLERY JS FILES  -->
   <script type="text/javascript" src="assets/metr-folio/js/jquery.metro-gal.plugins.min.js"></script>
   <script type="text/javascript" src="assets/metr-folio/js/jquery.metro-gal.megafoliopro.js"></script>


   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>

   <!-- END JAVASCRIPTS -->

   <script type="text/javascript">

       jQuery(document).ready(function() {

           var api=jQuery('.metro-gal-container').megafoliopro(
                   {
                       filterChangeAnimation:"pagebottom",			// fade, rotate, scale, rotatescale, pagetop, pagebottom,pagemiddle
                       filterChangeSpeed:400,					// Speed of Transition
                       filterChangeRotate:99,					// If you ue scalerotate or rotate you can set the rotation (99 = random !!)
                       filterChangeScale:0.6,					// Scale Animation Endparameter
                       delay:20,
                       defaultWidth:980,
                       paddingHorizontal:10,
                       paddingVertical:10,
                       layoutarray:[9,11,5,3,7,12,4,6,13]		// Defines the Layout Types which can be used in the Gallery. 2-9 or "random". You can define more than one, like {5,2,6,4} where the first items will be orderd in layout 5, the next comming items in layout 2, the next comming items in layout 6 etc... You can use also simple {9} then all item ordered in Layout 9 type.
                   });

           // FANCY BOX ( LIVE BOX) WITH MEDIA SUPPORT
           jQuery(".fancybox").fancybox();

           // THE FILTER FUNCTION
           jQuery('.filter').click(function() {
               jQuery('.filter').each(function() { jQuery(this).removeClass("selected")});
               api.megafilter(jQuery(this).data('category'));
               jQuery(this).addClass("selected");
           });


       });

   </script>


</body>
<!-- END BODY -->
</html>