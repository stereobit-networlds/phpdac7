<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Button</title>
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
                  <!-- BEGIN BUTTON PORTLET-->
                  <div class="widget red">
                        <div class="widget-title">
                           <h4><i class="icon-reorder"></i> Buttons </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                        </div>
                        <div class="widget-body">
                            <p>
                                <button class="btn btn-mini" type="button">Default</button>
                                <button class="btn btn-mini btn-primary" type="button">Primary</button>
                                <button class="btn btn-mini btn-info" type="button">Info</button>
                                <button class="btn btn-mini btn-success" type="button">Success</button>
                                <button class="btn btn-mini btn-warning" type="button">Warning</button>
                                <button class="btn btn-mini btn-danger" type="button">Danger</button>
                                <button class="btn btn-mini btn-inverse" type="button">Inverse</button>
                                <button class="btn btn-mini disabled" type="button">Disabled</button>
                            </p>
                            <p>
                                <button class="btn btn-small" type="button">Default</button>
                                <button class="btn btn-small btn-primary" type="button">Primary</button>
                                <button class="btn btn-small btn-info" type="button">Info</button>
                                <button class="btn btn-small btn-success" type="button">Success</button>
                                <button class="btn btn-small btn-warning" type="button">Warning</button>
                                <button class="btn btn-small btn-danger" type="button">Danger</button>
                                <button class="btn btn-small btn-inverse" type="button">Inverse</button>
                                <button class="btn btn-small disabled" type="button">Disabled</button>
                            </p>
                            <p>
                                <button class="btn " type="button">Default</button>
                                <button class="btn  btn-primary" type="button">Primary</button>
                                <button class="btn  btn-info" type="button">Info</button>
                                <button class="btn  btn-success" type="button">Success</button>
                                <button class="btn  btn-warning" type="button">Warning</button>
                                <button class="btn  btn-danger" type="button">Danger</button>
                                <button class="btn  btn-inverse" type="button">Inverse</button>
                                <button class="btn  disabled" type="button">Disabled</button>
                            </p>
                            <p>
                                <button class="btn btn-large" type="button">Default</button>
                                <button class="btn btn-large btn-primary" type="button">Primary</button>
                                <button class="btn btn-large btn-info" type="button">Info</button>
                                <button class="btn btn-large btn-success" type="button">Success</button>
                                <button class="btn btn-large btn-warning" type="button">Warning</button>
                                <button class="btn btn-large btn-danger" type="button">Danger</button>
                                <button class="btn btn-large btn-inverse" type="button">Inverse</button>
                                <button class="btn btn-large disabled" type="button">Disabled</button>
                            </p>
                        </div>
                  </div>
                  <!-- END BUTTON PORTLET-->
                </div>
            </div>
            <div class="row-fluid">
                 <div class="span12">
                     <!-- BEGIN BUTTON DROPDOWN PORTLET-->
                     <div class="widget green">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Dropdown Buttons </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                             <div class="btn-toolbar">
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle">Action <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-mini btn-primary dropdown-toggle">Action <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-mini btn-danger dropdown-toggle">Danger <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-mini btn-warning dropdown-toggle">Warning <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-mini btn-success dropdown-toggle">Success <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-mini btn-info dropdown-toggle">Info <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-mini btn-inverse dropdown-toggle">Inverse <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                             </div>
                             <div class="btn-toolbar">
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-small dropdown-toggle">Action <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-small btn-primary dropdown-toggle">Action <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-small btn-danger dropdown-toggle">Danger <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-small btn-warning dropdown-toggle">Warning <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-small btn-success dropdown-toggle">Success <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-small btn-info dropdown-toggle">Info <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-small btn-inverse dropdown-toggle">Inverse <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                             </div>
                             <div class="btn-toolbar">
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Danger <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Warning <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-success dropdown-toggle">Success <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-info dropdown-toggle">Info <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-inverse dropdown-toggle">Inverse <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                             </div>
                             <div class="btn-toolbar">
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-large dropdown-toggle">Action <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-large btn-primary dropdown-toggle">Action <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-large btn-danger dropdown-toggle">Danger <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-large btn-warning dropdown-toggle">Warning <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-large btn-success dropdown-toggle">Success <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-large btn-info dropdown-toggle">Info <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <div class="btn-group">
                                     <button data-toggle="dropdown" class="btn btn-large btn-inverse dropdown-toggle">Inverse <span class="caret"></span></button>
                                     <ul class="dropdown-menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- END BUTTON DROPDOWN PORTLET-->
                 </div>
             </div>

            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN BUTTON DROPDOWN PORTLET-->
                    <div class="widget yellow">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Dropdown Split Buttons </h4>
                               <span class="tools">
                                   <a href="javascript:;" class="icon-chevron-down"></a>
                                   <a href="javascript:;" class="icon-remove"></a>
                               </span>
                        </div>
                        <div class="widget-body">
                            <div class="btn-toolbar">
                                <div class="btn-group">
                                    <button class="btn btn-mini">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-mini btn-primary">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-mini btn-primary dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-mini btn-info">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-mini btn-info dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-mini btn-success">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-mini btn-success dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-mini btn-warning">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-mini btn-warning dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-mini btn-danger">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-mini btn-danger dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-mini btn-inverse">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-mini btn-inverse dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="btn-toolbar">
                                <div class="btn-group">
                                    <button class="btn">Action</button>
                                    <button data-toggle="dropdown" class="btn dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-primary">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-info">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-info dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-success">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-success dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-warning">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-danger">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-inverse">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-inverse dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="btn-toolbar">
                                <div class="btn-group">
                                    <button class="btn btn-large">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-large dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-large btn-primary">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-large btn-primary dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-large btn-info">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-large btn-info dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-large btn-success">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-large btn-success dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-large btn-warning">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-large btn-warning dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-large btn-danger">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-large btn-danger dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-large btn-inverse">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-large btn-inverse dropdown-toggle b2"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-trash"></i> Remove all</a></li>
                                        <li><a href="#"><i class="icon-music"></i> Play all</a></li>
                                        <li><a href="#"><i class="icon-plus-sign"></i> Add to Favorites</a></li>
                                    </ul>
                                </div>
                                <h4>Drop-up menu</h4>
                                <p>
                                    <div class="btn-group dropup">
                                        <button class="btn"><i class="icon-user"></i> Dropup</button>
                                        <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div>
                                    <div class="btn-group dropup">
                                        <button class="btn btn-warning"><i class="icon-cog"></i> Dropup</button>
                                        <button class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div>
                                    <div class="btn-group dropup">
                                        <button class="btn btn-success"><i class="icon-tasks"></i> Dropup</button>
                                        <button class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div>
                                    <div class="btn-group dropup">
                                        <button class="btn btn-danger"><i class="icon-star"></i> Dropup</button>
                                        <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div>
                                    <div class="btn-group dropup">
                                        <button class="btn btn-inverse"><i class="icon-user"></i> Dropup</button>
                                        <button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END BUTTON DROPDOWN PORTLET-->
            </div>
            <div class="row-fluid">
                <div class="span12">
                <!-- BEGIN ICON BUTTON PORTLET-->
                    <div class="widget purple">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Buttons with Icons</h4>
                               <span class="tools">
                                   <a href="javascript:;" class="icon-chevron-down"></a>
                                   <a href="javascript:;" class="icon-remove"></a>
                               </span>
                        </div>
                        <div class="widget-body">
                            <p>
                                <button class="btn btn-mini"><i class="icon-eye-open"></i> View</button>
                                <button class="btn btn-mini btn-warning"><i class="icon-plus icon-white"></i> Create</button>
                                <button class="btn btn-mini btn-inverse"><i class="icon-refresh icon-white"></i> Update</button>
                                <button class="btn btn-mini btn-primary"><i class="icon-pencil icon-white"></i> Edit</button>
                                <button class="btn btn-mini btn-danger"><i class="icon-remove icon-white"></i> Delete</button>
                                <button class="btn btn-mini btn-info"><i class="icon-ban-circle icon-white"></i> Cancel</button>
                                <button class="btn btn-mini btn-success"><i class="icon-ok icon-white"></i> Approve</button>
                            </p>
                            <p>
                                <button class="btn btn-small"><i class="icon-eye-open"></i> View</button>
                                <button class="btn btn-small btn-warning"><i class="icon-plus icon-white"></i> Create</button>
                                <button class="btn btn-small btn-inverse"><i class="icon-refresh icon-white"></i> Update</button>
                                <button class="btn btn-small btn-primary"><i class="icon-pencil icon-white"></i> Edit</button>
                                <button class="btn btn-small btn-danger"><i class="icon-remove icon-white"></i> Delete</button>
                                <button class="btn btn-small btn-info"><i class="icon-ban-circle icon-white"></i> Cancel</button>
                                <button class="btn btn-small btn-success"><i class="icon-ok icon-white"></i> Approve</button>
                            </p>
                            <p>
                                <button class="btn"><i class="icon-eye-open"></i> View</button>
                                <button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create</button>
                                <button class="btn btn-inverse"><i class="icon-refresh icon-white"></i> Update</button>
                                <button class="btn btn-primary"><i class="icon-pencil icon-white"></i> Edit</button>
                                <button class="btn btn-danger"><i class="icon-remove icon-white"></i> Delete</button>
                                <button class="btn btn-info"><i class="icon-ban-circle icon-white"></i> Cancel</button>
                                <button class="btn btn-success"><i class="icon-ok icon-white"></i> Approve</button>
                            </p>
                            <p>
                                <button class="btn btn-large"><i class="icon-eye-open"></i> View</button>
                                <button class="btn btn-large btn-warning"><i class="icon-plus icon-white"></i> Create</button>
                                <button class="btn btn-large btn-inverse"><i class="icon-refresh icon-white"></i> Update</button>
                                <button class="btn btn-large btn-primary"><i class="icon-pencil icon-white"></i> Edit</button>
                                <button class="btn btn-large btn-danger"><i class="icon-remove icon-white"></i> Delete</button>
                                <button class="btn btn-large btn-info"><i class="icon-ban-circle icon-white"></i> Cancel</button>
                                <button class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Approve</button>
                            </p>
                            <p>
                                <button class="btn"><i class="icon-chevron-left"></i></button>
                                <button class="btn"><i class="icon-chevron-up"></i></button>
                                <button class="btn"><i class="icon-chevron-right"></i></button>
                                <button class="btn"><i class="icon-chevron-down"></i></button>
                                <button class="btn"><i class="icon-plus"></i></button>
                                <button class="btn"><i class="icon-minus"></i></button>
                            </p>
                            <p>
                                <button class="btn btn-inverse"><i class="icon-chevron-left"></i></button>
                                <button class="btn btn-inverse"><i class="icon-chevron-up"></i></button>
                                <button class="btn btn-inverse"><i class="icon-chevron-right"></i></button>
                                <button class="btn btn-inverse"><i class="icon-chevron-down"></i></button>
                                <button class="btn btn-inverse"><i class="icon-plus"></i></button>
                                <button class="btn btn-inverse"><i class="icon-minus"></i></button>
                            </p>
                            <p>
                                <button class="btn btn-primary"><i class="icon-ok"></i></button>
                                <button class="btn btn-inverse"><i class="icon-remove"></i></button>
                                <button class="btn btn-success"><i class="icon-cloud"></i></button>
                                <button class="btn btn-warning"><i class="icon-home"></i></button>
                                <button class="btn btn-info"><i class="icon-search"></i></button>
                                <button class="btn btn-danger"><i class="icon-download"></i></button>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- END ICON BUTTON PORTLET-->
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN GROUP BUTTON PORTLET-->
                    <div class="widget blue">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Group Buttons</h4>
                               <span class="tools">
                                   <a href="javascript:;" class="icon-chevron-down"></a>
                                   <a href="javascript:;" class="icon-remove"></a>
                               </span>
                        </div>
                        <div class="widget-body">
                            <p>Horizontal Group Button</p>
                            <p>
                                <div class="btn-group">
                                    <button class="btn">Left</button>
                                    <button class="btn">Middle</button>
                                    <button class="btn">Right</button>
                                </div>

                                <div class="btn-group">
                                    <button class="btn btn-inverse">Left</button>
                                    <button class="btn btn-inverse">Middle</button>
                                    <button class="btn btn-inverse">Right</button>
                                </div>

                                <div class="btn-group">
                                    <button class="btn btn-info">Left</button>
                                    <button class="btn btn-info">Middle</button>
                                    <button class="btn btn-info">Right</button>
                                </div>
                            </p>
                            <p>Vertical Group Button</p>
                            <p>
                                <div class="btn-group-vertical" style="margin-right: 20px">
                                    <button class="btn">1</button>
                                    <button class="btn">2</button>
                                    <button class="btn">3</button>
                                </div>

                                <div class="btn-group-vertical">
                                    <button class="btn btn-inverse">1</button>
                                    <button class="btn btn-inverse">2</button>
                                    <button class="btn btn-inverse">3</button>
                                </div>
                            </p>
                            <p>Toolbar icon example</p>
                            <div class="btn-group">
                                <button class="btn"><i class="icon-step-backward"></i></button>
                                <button class="btn"><i class="icon-fast-backward"></i></button>
                                <button class="btn hidden-phone"><i class="icon-backward"></i></button>
                                <button class="btn"><i class="icon-play"></i></button>
                                <button class="btn"><i class="icon-pause"></i></button>
                                <button class="btn"><i class="icon-stop"></i></button>
                                <button class="btn hidden-phone"><i class="icon-forward"></i></button>
                                <button class="btn"><i class="icon-fast-forward"></i></button>
                                <button class="btn"><i class="icon-step-forward"></i></button>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-primary"><i class="icon-step-backward"></i></button>
                                <button class="btn btn-primary"><i class="icon-fast-backward"></i></button>
                                <button class="btn hidden-phone btn-primary"><i class="icon-backward"></i></button>
                                <button class="btn btn-primary"><i class="icon-play"></i></button>
                                <button class="btn btn-primary"><i class="icon-pause"></i></button>
                                <button class="btn btn-primary"><i class="icon-stop"></i></button>
                                <button class="btn hidden-phone btn-primary"><i class="icon-forward"></i></button>
                                <button class="btn btn-primary"><i class="icon-fast-forward"></i></button>
                                <button class="btn btn-primary"><i class="icon-step-forward"></i></button>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-success"><i class="icon-step-backward"></i></button>
                                <button class="btn btn-success"><i class="icon-fast-backward"></i></button>
                                <button class="btn hidden-phone btn-success"><i class="icon-backward"></i></button>
                                <button class="btn btn-success"><i class="icon-play"></i></button>
                                <button class="btn btn-success"><i class="icon-pause"></i></button>
                                <button class="btn btn-success"><i class="icon-stop"></i></button>
                                <button class="btn hidden-phone btn-success"><i class="icon-forward"></i></button>
                                <button class="btn btn-success"><i class="icon-fast-forward"></i></button>
                                <button class="btn btn-success"><i class="icon-step-forward"></i></button>
                            </div>
                            <div class="btn-toolbar">
                                <div class="btn-group">
                                    <a href="#" class="btn"><i class="icon-align-left"></i></a>
                                    <a href="#" class="btn"><i class="icon-align-center"></i></a>
                                    <a href="#" class="btn"><i class="icon-align-right"></i></a>
                                    <a href="#" class="btn"><i class="icon-align-justify"></i></a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-info"><i class="icon-align-left"></i></a>
                                    <a href="#" class="btn btn-info"><i class="icon-align-center"></i></a>
                                    <a href="#" class="btn btn-info"><i class="icon-align-right"></i></a>
                                    <a href="#" class="btn btn-info"><i class="icon-align-justify"></i></a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-success"><i class="icon-align-left"></i></a>
                                    <a href="#" class="btn btn-success"><i class="icon-align-center"></i></a>
                                    <a href="#" class="btn btn-success"><i class="icon-align-right"></i></a>
                                    <a href="#" class="btn btn-success"><i class="icon-align-justify"></i></a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-danger"><i class="icon-align-left"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="icon-align-center"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="icon-align-right"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="icon-align-justify"></i></a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-warning"><i class="icon-align-left"></i></a>
                                    <a href="#" class="btn btn-warning"><i class="icon-align-center"></i></a>
                                    <a href="#" class="btn btn-warning"><i class="icon-align-right"></i></a>
                                    <a href="#" class="btn btn-warning"><i class="icon-align-justify"></i></a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-inverse"><i class="icon-align-left"></i></a>
                                    <a href="#" class="btn btn-inverse"><i class="icon-align-center"></i></a>
                                    <a href="#" class="btn btn-inverse"><i class="icon-align-right"></i></a>
                                    <a href="#" class="btn btn-inverse"><i class="icon-align-justify"></i></a>
                                </div>
                            </div>
                            <p>Star Rating Example</p>
                            <span class="rating">
                              <span class="star"></span>
                              <span class="star"></span>
                              <span class="star"></span>
                              <span class="star"></span>
                              <span class="star"></span>
                              </span>
                        </div>
                    </div>
                </div>
                <!-- END GROUP BUTTON PORTLET-->
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN CUSTOM BUTTONS WITH ICONS PORTLET-->
                    <h4>Custom Buttons with Icons</h4>
                    <div class="row-fluid">
                        <a class="icon-btn span2" href="#">
                            <i class="icon-group"></i>
                            <div>Users</div>
                            <span class="badge badge-important">2</span>
                        </a>
                        <a class="icon-btn span2" href="#">
                            <i class="icon-barcode"></i>
                            <div>Products</div>
                            <span class="badge badge-success">4</span>
                        </a>
                        <a class="icon-btn span2" href="#">
                            <i class="icon-reorder"></i>
                            <div>Reports</div>
                        </a>
                        <a class="icon-btn span2" href="#">
                            <i class="icon-sitemap"></i>
                            <div>Categories</div>
                        </a>
                        <a class="icon-btn span2" href="#">
                            <i class="icon-calendar"></i>
                            <div>Calendar</div>
                            <span class="badge badge-success">4</span>
                        </a>
                        <a class="icon-btn span2" href="#">
                            <i class="icon-envelope"></i>
                            <div>Inbox</div>
                            <span class="badge badge-info">12</span>
                        </a>
                    </div>
                    <div class="row-fluid">
                        <a class="icon-btn span2" href="#">
                            <i class="icon-bullhorn"></i>
                            <div>Notification</div>
                            <span class="badge badge-important">3</span>
                        </a>
                        <a class="icon-btn span2" href="#">
                            <i class="icon-map-marker"></i>
                            <div>Locations</div>
                        </a>

                        <a class="icon-btn span2" href="#">
                            <i class="icon-money"></i>
                            <div>Finance</div>
                        </a>
                        <a class="icon-btn span2" href="#">
                            <i class="icon-plane"></i>
                            <div>Projects</div>
                            <span class="badge badge-info">21</span>
                        </a>
                        <a class="icon-btn span2" href="#">
                            <i class="icon-thumbs-up"></i>
                            <div>Feedback</div>
                            <span class="badge badge-info">2</span>
                        </a>
                        <a class="icon-btn span2" href="#">
                            <i class="icon-cloud"></i>
                            <div>Servers</div>
                            <span class="badge badge-important">2</span>
                        </a>
                    </div>
                    <div class="row-fluid">
                        <a class="icon-btn span2" href="#">
                            <i class="icon-globe"></i>
                            <div>Regions</div>
                        </a>
                        <a class="icon-btn span2" href="#">
                            <i class="icon-heart-empty"></i>
                            <div>Popularity</div>
                            <span class="badge badge-info">221</span>
                        </a>
                        <a class="icon-btn span2" href="#">
                            <i class="icon-wrench"></i>
                            <div>Settings</div>
                        </a>
                        <a class="icon-btn span2" href="#">
                            <i class="icon-search"></i>
                            <div>Search</div>
                        </a>
                        <a class="icon-btn span2" href="#">
                            <i class="icon-map-marker"></i>
                            <div>Locations</div>
                        </a>

                        <a class="icon-btn span2" href="#">
                            <i class="icon-money"></i>
                            <div>Finance</div>
                        </a>
                    </div>
                    <!-- END CUSTOM BUTTONS WITH ICONS PORTLET-->
                </div>
                <span class="space20">&nbsp;</span>
            </div>

         </div>


         <!-- END PAGE CONTENT-->
      </div>
     <!-- END PAGE CONTAINER-->
   </div>
  <!-- END PAGE -->
<!-- END CONTAINER -->

   <!-- BEGIN FOOTER -->
	<phpdac>frontpage.include_part use /parts/footer.php+++metro</phpdac>
   <!-- END FOOTER -->

   <!-- BEGIN JAVASCRIPTS -->
   <!-- Load javascripts at bottom, this will reduce page load time -->
   <script src="js/jquery-1.8.3.min.js"></script>
   <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="js/jquery.scrollTo.min.js"></script>

    <!-- ie8 fixes -->
    <!--[if lt IE 9]>
    <script src="js/excanvas.js"></script>
    <script src="js/respond.js"></script>
    <![endif]-->

    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

   <!-- END JAVASCRIPTS -->
   
   <phpdac>frontpage.include_part use /parts/google-analytics.php+++meteor</phpdac>
   <!-- e-Enterprise, stereobit.networlds (phpdac5) -->   
	
</body>
<!-- END BODY -->
</html>