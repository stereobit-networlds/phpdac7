<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title><phpdac>frontpage.slocale use _RESETPASS</phpdac></title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="css/style.css" rel="stylesheet" />
   <link href="css/style-responsive.css" rel="stylesheet" />
   <link href="css/style-default.css" rel="stylesheet" id="style_color" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="lock">
    <div class="lock-header">
        <!-- BEGIN LOGO -->
        <a class="center" id="logo" href="index.php">
            <img class="center" alt="logo" src="img/logo.png">
        </a>
        <!-- END LOGO -->
    </div>
    <div class="lock-wrap">
        <div class="metro single-size gray">
            <img src="img/lock-thumb.jpg" alt="" style="height: 165px" >
        </div>
        <div class="metro double-size blue">
		    <br/>
		    <phpdac>shlogin.recaptcha</phpdac>
        </div>
        <div class="metro double-size green">
            <form method="POST" action="cp.php">
                <div class="input-append lock-input">
                    <input type="text" name="myemail" class="" placeholder="Username">
					<input type="hidden" name="FormAction" value="shremember" />
					<input type="hidden" name="turl" value="<phpdac>fronthtmlpage.echostr use turl</phpdac>">
					<input type="hidden" name="turldecoded" value="<phpdac>fronthtmlpage.echostr use turldecoded</phpdac>">
					<input type="hidden" name="cpGet" value="<phpdac>fronthtmlpage.echostr use cpGet</phpdac>">					
                    <button type="submit" class="btn tarquoise"><i class=" icon-arrow-right"></i></button>
                </div>
            </form>
        </div>
        <div class="metro single-size terques">
            <div class="locked">
                <i class="icon-lock"></i>
                <span>Locked</span>
            </div>
        </div>
        <div class="metro double-size orange">
            <a href="javascript:;" class="user-position">
                <i class="icon-key"></i>
                <span>An e-mail will be send</span>
            </a>
        </div>
        <div class="metro double-size gray ">
            <h1>Jim Administropoulos</h1>
            <p>admin@superduper.com</p>
        </div>		
        <div class="login-footer">
            <!--div class="remember-hint pull-left">
                <input type="checkbox" id=""> Remember Me
            </div-->
			<div class="forgot-hint pull-left">
                <a id="forget-password" class="" href="index.php"><phpdac>frontpage.slocale use _back</phpdac></a>
            </div>
            <!--div class="forgot-hint pull-right">
                <a id="forget-password" class="" href="cp.php?turl=<phpdac>fronthtmlpage.echostr use turl</phpdac>"><phpdac>frontpage.slocale use SHLOGIN_DPC</phpdac></a>
            </div-->
        </div>		
    </div>
</body>
<!-- END BODY -->
</html>