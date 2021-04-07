<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Edit item</title>
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
    <link rel="stylesheet" type="text/css" href="assets/jquery-tags-input/jquery.tagsinput.css" />
	<link rel="stylesheet" href="assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />	
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
   
    <script src="<phpdac>cpmhtmleditor.getVar use ckjs</phpdac>"></script>
	<!--script type="text/javascript" src="assets/ckeditor/ckeditor.js"-->
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
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget red">
                         <div class="widget-title">
                             <h4><i class="icon-edit"></i> <phpdac>cmsrt.slocale use _edititem</phpdac></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                             <!--METRO/INDEX-->
							 
                            <!-- BEGIN FORM-->
                            <form method="post" action="#" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label"><phpdac>cmsrt.slocale use _itemtitle</phpdac></label>
                                <div id="edit_subject" class="controls">
                                    <input name="title" value="<phpdac>fronthtmlpage.nvldac2 use title+fronthtmlpage.echostr:title+cpmhtmleditor.getField:itmname+</phpdac>" type="text" class="span6 " />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><phpdac>cmsrt.slocale use _itemdescr</phpdac></label>
                                <div id="edit_descr" class="controls">
                                    <textarea class="span12" name="descr" rows="3"><phpdac>fronthtmlpage.nvldac2 use descr+fronthtmlpage.echostr:descr+cpmhtmleditor.getField:itmdescr+</phpdac></textarea>
                                </div>
                            </div>								
							<div class="control-group">
								<label class="control-label"><phpdac>cmsrt.slocale use _itemtext</phpdac></label>
								<div class="controls">
									<!--textarea class="span12 ckeditor" name="htmltext" rows="6"><-hpdac>cpmhtmleditor.itemText use 1</phpda-></textarea-->
									<phpdac>cpmhtmleditor.itemEditor use 1</phpdac>
								</div>
							</div>	
							
                            <div class="control-group">
                                <label class="control-label"><phpdac>cmsrt.slocale use _itemactive</phpdac></label>
                                <div class="controls">
                                            <div id="normal-toggle-button">
                                                <input name="active" type="checkbox" <phpdac>cpmhtmleditor.getField use active+1</phpdac> />
                                            </div>
                                            <div id="info-toggle-button">
                                                <input name="itmactive" type="checkbox" class="toggle" <phpdac>cpmhtmleditor.getField use itmactive+1</phpdac> />
                                            </div>
                                </div>
                            </div>	
							
							<div class="control-group">
                                    <label class="control-label"><phpdac>cmsrt.slocale use _tags</phpdac></label>
                                    <!--div id="edit_to" class="controls">	
										<input id="tags_1" name="tags" type="text" class="tags" value="<phpdac>cphtmleditor.getTags</phpdac>" />
                                    </div-->
									<div id="edit_to" class="controls">
										<input id="tags" name="tags" type="text" class="span12" value="<phpdac>cphtmleditor.getTags</phpdac>" />
									</div>
									
                            </div>							

							<div class="control-group">
                                    <label class="control-label"><phpdac>cmsrt.slocale use _itemdetails</phpdac></label>
                                    <div id="edit_to" class="controls">
	
										<label class="control-label"><phpdac>cmsrt.slocale use _WEIGHT</phpdac></label>
										<input id="weight" name="weight" type="text" class="span12" value="<phpdac>cphtmleditor.getField use weight</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _VOLUME</phpdac></label>
										<input id="volume" name="volume" type="text" class="span12" value="<phpdac>cphtmleditor.getField use volume</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _DIMENSIONS</phpdac></label>
										<input id="dimensions" name="dimensions" type="text" class="span12" value="<phpdac>cphtmleditor.getField use dimensions</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _SIZE</phpdac></label>
										<input id="size" name="size" type="text" class="span12" value="<phpdac>cphtmleditor.getField use size</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _COLOR</phpdac></label>
										<input id="color" name="color" type="text" class="span12" value="<phpdac>cphtmleditor.getField use color</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _MANUFACTURER</phpdac></label>
										<input id="manufacturer" name="manufacturer" type="text" class="span12" value="<phpdac>cphtmleditor.getField use manufacturer</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _CONDITION</phpdac></label>
										<input id="cond" name="cond" type="text" class="span12" value="<phpdac>cphtmleditor.getField use cond</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _AVAILABILITY</phpdac></label>
										<input id="availalt" name="availalt" type="text" class="span12" value="<phpdac>cphtmleditor.getField use availalt</phpdac>" />
                                    </div>
                            </div>		

                            <div class="control-group">
                                <label class="control-label"><phpdac>cmsrt.slocale use _itemxml</phpdac></label>
                                <div class="controls">
                                            <div id="info-toggle-button">
                                                <input name="xml" type="checkbox" class="toggle" <phpdac>cpmhtmleditor.getField use xml+1</phpdac> />
                                            </div>
                                </div>
                            </div>								

							<div class="control-group">
                                    <label class="control-label"><phpdac>cmsrt.slocale use _itemoptions</phpdac></label>
                                    <div id="edit_to" class="controls">
	
										<label class="control-label"><phpdac>cmsrt.slocale use _itemp</phpdac> 1</label>
										<input id="p1" name="p1" type="text" class="span12" value="<phpdac>cphtmleditor.getField use p1</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _itemp</phpdac> 2</label>
										<input id="p2" name="p2" type="text" class="span12" value="<phpdac>cphtmleditor.getField use p2</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _itemp</phpdac> 3</label>
										<input id="p3" name="p3" type="text" class="span12" value="<phpdac>cphtmleditor.getField use p3</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _itemp</phpdac> 4</label>
										<input id="p4" name="p4" type="text" class="span12" value="<phpdac>cphtmleditor.getField use p4</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _itemp</phpdac> 5</label>
										<input id="p5" name="p5" type="text" class="span12" value="<phpdac>cphtmleditor.getField use p5</phpdac>" />
                                    </div>
                            </div>	
							
							<div class="control-group">
                                    <label class="control-label"><phpdac>cmsrt.slocale use _itemcodes</phpdac></label>
                                    <div id="edit_to" class="controls">
	
										<label class="control-label"><phpdac>cmsrt.slocale use _itemcode</phpdac> 1</label>
										<input id="code1" name="code1" type="text" class="span12" value="<phpdac>cphtmleditor.getField use code1</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _itemcode</phpdac> 2</label>
										<input id="code2" name="code2" type="text" class="span12" value="<phpdac>cphtmleditor.getField use code2</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _itemcode</phpdac> 3</label>
										<input id="code3" name="code3" type="text" class="span12" value="<phpdac>cphtmleditor.getField use code3</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _itemcode</phpdac> 4</label>
										<input id="code4" name="code4" type="text" class="span12" value="<phpdac>cphtmleditor.getField use code4</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _itemcode</phpdac> 5</label>
										<input id="code5" name="code5" type="text" class="span12" value="<phpdac>cphtmleditor.getField use code5</phpdac>" />
                                    </div>
                            </div>	

                            <div class="control-group">
                                <label class="control-label"><phpdac>cmsrt.slocale use _iteminventory</phpdac></label>
                                <div class="controls">
									<label class="control-label"><phpdac>cmsrt.slocale use _uniname1</phpdac></label>
									<input id="uniname1" name="uniname1" type="text" class="span12" value="<phpdac>cphtmleditor.getField use uniname1</phpdac>" />
									<label class="control-label"><phpdac>cmsrt.slocale use _uniname2</phpdac></label>
									<input id="uniname2" name="uniname2" type="text" class="span12" value="<phpdac>cphtmleditor.getField use uniname2</phpdac>" />								
									
									<label class="control-label"><phpdac>cmsrt.slocale use _uni1uni2</phpdac></label>
									<input id="uni1uni2" name="uni1uni2" type="text" class="span12" value="<phpdac>cphtmleditor.getField use uni1uni2</phpdac>" />
									<label class="control-label"><phpdac>cmsrt.slocale use _uni2uni1</phpdac></label>
									<input id="uni2uni1" name="uni2uni1" type="text" class="span12" value="<phpdac>cphtmleditor.getField use uni2uni1</phpdac>" />									
								
									<label class="control-label"><phpdac>cmsrt.slocale use _ypoloipo1</phpdac></label>
									<input id="ypoloipo1" name="ypoloipo1" type="text" class="span12" value="<phpdac>cphtmleditor.getField use ypoloipo1</phpdac>" />
									<label class="control-label"><phpdac>cmsrt.slocale use _ypoloipo2</phpdac></label>
									<input id="ypoloipo2" name="ypoloipo2" type="text" class="span12" value="<phpdac>cphtmleditor.getField use tpoloipo2</phpdac>" />
                                </div>
                            </div>							

							<div class="control-group">
                                    <label class="control-label"><phpdac>cmsrt.slocale use _itemprices</phpdac></label>
                                    <div id="edit_to" class="controls">
	
										<label class="control-label"><phpdac>cmsrt.slocale use _itemprice</phpdac> 0</label>
										<input id="price0" name="price0" type="text" class="span12" value="<phpdac>cphtmleditor.getField use price0</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _itemprice</phpdac> 1</label>
										<input id="price1" name="price1" type="text" class="span12" value="<phpdac>cphtmleditor.getField use price1</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _itemprice</phpdac> 2</label>
										<input id="price2" name="price2" type="text" class="span12" value="<phpdac>cphtmleditor.getField use price2</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _itemprice</phpdac> PC</label>
										<input id="pricepc" name="pricepc" type="text" class="span12" value="<phpdac>cphtmleditor.getField use pricepc</phpdac>" />									
                                    </div>
                            </div>	
							
							<div class="control-group">
                                    <label class="control-label"><phpdac>cmsrt.slocale use _itemcategories</phpdac></label>
                                    <div id="edit_to" class="controls">
	
										<label class="control-label"><phpdac>cmsrt.slocale use _itemcat</phpdac> 0</label>
										<input id="cat0" name="cat0" type="text" class="span12" value="<phpdac>cphtmleditor.getField use cat0</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _itemcat</phpdac> 1</label>
										<input id="cat1" name="cat1" type="text" class="span12" value="<phpdac>cphtmleditor.getField use cat1</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _itemcat</phpdac> 2</label>
										<input id="cat2" name="cat2" type="text" class="span12" value="<phpdac>cphtmleditor.getField use cat2</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _itemcat</phpdac> 3</label>
										<input id="cat3" name="cat3" type="text" class="span12" value="<phpdac>cphtmleditor.getField use cat3</phpdac>" />
										<label class="control-label"><phpdac>cmsrt.slocale use _itemcat</phpdac> 4</label>
										<input id="cat4" name="cat4" type="text" class="span12" value="<phpdac>cphtmleditor.getField use cat4</phpdac>" />
                                    </div>
                            </div>

							<div class="control-group">
                                    <label class="control-label"><phpdac>cmsrt.slocale use _itemextras</phpdac></label>
                                    <div id="edit_to" class="controls">

									<label class="control-label">Resources</label>
									<input id="resources" name="resources" type="text" class="span12" value="<phpdac>cphtmleditor.getField use resources</phpdac>" />
									<label class="control-label">Synins</label>
									<input id="sysins" name="sysins" type="text" class="span12" value="<phpdac>cphtmleditor.getField use sysins</phpdac>" readonly/>
									<label class="control-label">Sysupd</label>
									<input id="sysupd" name="susupd" type="text" class="span12" value="<phpdac>cphtmleditor.getField use sysupd</phpdac>" readonly/>
                                    </div>
                            </div>							
							
							<div id="select_template" class="control-group">
                                <label class="control-label"><phpdac>cmsrt.slocale use _articletmpl</phpdac></label>
                                <div id="template_page" class="controls">
                                    <select name="mctemplate" class="span6 chzn-select" data-placeholder="Choose a template" tabindex="1">
                                        <option value=""><phpdac>cmsrt.slocale use _select</phpdac></option>
										<phpdac>cpmhtmleditor.templates</phpdac>
										<option value="removeoption"><phpdac>cmsrt.slocale use _remselect</phpdac></option>										
                                    </select>
                                </div>								
                            </div>	
							<div id="select_page" class="control-group">
                                <label class="control-label"><phpdac>cmsrt.slocale use _pagetmpl</phpdac></label>
                                <div id="mc_page" class="controls">
                                    <select name="mcpage" class="span6 chzn-select" data-placeholder="Choose a page" tabindex="1">
                                        <option value=""><phpdac>cmsrt.slocale use _select</phpdac></option>
										<phpdac>cpmhtmleditor.mcpages</phpdac>
										<option value="removeoption"><phpdac>cmsrt.slocale use _remselect</phpdac></option>
                                    </select>
                                </div>								
                            </div>	
							
                            <div class="form-actions">
                                <button type="submit" class="<phpdac>cmsrt.nvl use cpmhtmleditor.postok+btn btn-success+btn btn-danger+</phpdac>"><phpdac>cmsrt.slocale use _save</phpdac></button>
								<input type="hidden" name="FormName" value="edititem" />
								<input type="hidden" name="FormAction" value="cpmedititem" />
								<input type="hidden" name="id" value="<phpdac>cmsrt.nvldac2 use id+cmsrt.getParam:id+cpmhtmleditor.getItemCode+</phpdac>">
								<input type="hidden" name="update" value="1">
								
								<!--a href="cpmhtmleditor.php?t=cpmhtmlcopy&copyid=<phpdac>fronthtmlpage.echostr use id</phpdac>" class="btn btn-success">Copy</a>
								<a href="cpmhtmleditor.php?t=cpmitemedit&copyid=<phpdac>fronthtmlpage.echostr use id</phpdac>" class="btn btn-info">Details</a-->							
                            </div>							
							<div>
							<div id="exclude" class="control-group">
								<label class="control-label"><phpdac>cmsrt.slocale use _itemcategories</phpdac></label>
								<div class="controls">							
                                    <table style="width: 100%;" class="">
                                        <tr>
                                            <td style="width: 35%">
                                                <div class="d-sel-filter">
                                                    <span><phpdac>cmsrt.slocale use _filter</phpdac>:</span>
                                                    <input type="text" id="box1Filter" />
                                                    <button type="button" class="btn" id="box1Clear">X</button>
                                                </div>

                                                <select name="exclude[]" id="box1View" multiple="multiple" style="height:300px;width:75%">
                                                    <phpdac>cpmhtmleditor.getCategories</phpdac>
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
                                                    <span><phpdac>cmsrt.slocale use _filter</phpdac>:</span>
                                                    <input type="text" id="box2Filter" />
                                                    <button type="button" class="btn" id="box2Clear">X</button>
                                                </div>

                                                <select name="include[]" id="box2View" multiple="multiple" style="height:300px;width:75%;">
													<phpdac>cpmhtmleditor.getSelectedCategory</phpdac>
                                                </select><br/>

                                                <span id="box2Counter" class="countLabel"></span>

                                                <select id="box2Storage">

                                                </select>
                                            </td>
                                        </tr>
                                    </table>
								</div>	
                            </div>	
							<div id="messages" class="control-group">
								<label class="control-label"><phpdac>cmsrt.slocale use _messages</phpdac></label>
								<div class="controls">
									<select id="messages" multiple="multiple" style="height:100px;width:100%;">
										<phpdac>cpmhtmleditor.viewMessages</phpdac>
									</select>
								</div>
							</div>	

							<div class="form-actions">
								<a href="cpmhtmleditor.php?t=cpmdelitem&id=<phpdac>fronthtmlpage.echostr use id</phpdac>" class="btn btn-danger"><phpdac>cmsrt.slocale use _delete</phpdac></a>							
							</div>	
                            </form>
                            <!-- END FORM-->							 
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
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
   <!--script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script-->
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="assets/bootstrap/js/bootstrap-fileupload.js"></script>
   <script src="js/jquery.blockui.js"></script>

   <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
   <script src="js/jQuery.dualListBox-1.3.js" language="javascript" type="text/javascript"></script>  

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   
   <script type="text/javascript" src="assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
   <script type="text/javascript" src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>   
   <script type="text/javascript" src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
   <script type="text/javascript" src="assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
   <script src="assets/fancybox/source/jquery.fancybox.pack.js"></script>   
   <script src="js/jquery.scrollTo.min.js"></script>   

   <!--common script for all pages-->
   <script src="js/common-scripts.js"></script>
   
   <!--script for this page-->
   <script src="js/form-component.js"></script>

   <script language="javascript" type="text/javascript">
       $(function() {
           $.configureBoxes();
       });
   </script>   

   <!-- END JAVASCRIPTS -->  
</body>
<!-- END BODY -->
</html>