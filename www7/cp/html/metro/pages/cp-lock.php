<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title><phpdac>cms.slocale use _RESETPASS</phpdac></title>
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
        <a class="center" id="logo" href="#" onClick="top.location.href='../<phpdac>cms.echostr use turldecoded</phpdac>'">
            <img class="center" alt="logo" src="img/logo.png">
        </a>
        <!-- END LOGO -->
    </div>
    <div class="lock-wrap">
	<form method="POST" action="cp.php">
        <div class="metro single-size gray">
            <img src="img/lock-thumb.jpg" alt="" style="height: 165px" >
        </div>
        <div class="metro double-size blue">
		    <br/>
            <!--hpdac>shlogin.recaptcha</phpda-->
			<img src="cp.php?t=captchaimage" alt="captcha"/><br/>
			<input type="text" name="mycaptcha" class="" placeholder="Captcha"><br/>
        </div>
        <div class="metro double-size green">
                <div class="input-append lock-input">
					<input type="text" name="myemail" class="" placeholder="Username">
					<input type="hidden" name="FormAction" value="shremember" />
					<input type="hidden" name="turl" value="<phpdac>cms.echostr use turl</phpdac>">
					<input type="hidden" name="turldecoded" value="<phpdac>cms.echostr use turldecoded</phpdac>">
					<input type="hidden" name="cpGet" value="<phpdac>cms.echostr use cpGet</phpdac>">					
                    <button type="submit" class="btn tarquoise"><i class=" icon-arrow-right"></i></button>
                </div>
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
			<div class="forgot-hint pull-left">
                <a id="forget-password" class="" href="#" onClick="top.location.href='../<phpdac>cms.echostr use turldecoded</phpdac>'"><phpdac>cms.slocale use _back</phpdac></a>
            </div>
        </div>
	</form>		
    </div>
</body>
<!-- END BODY -->
</html>