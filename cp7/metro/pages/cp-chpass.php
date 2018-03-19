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
        <a class="center" id="logo" href="#" onClick="top.location.href='../<phpdac>fronthtmlpage.echostr use turldecoded</phpdac>'">
            <img class="center" alt="logo" src="img/logo.png">
        </a>
        <!-- END LOGO -->
    </div>
    <div class="lock-wrap">
		<form method="POST" action="cp.php">
            <div class="metro double-size orange">
				<div class="input-append lock-input">
                    <input type="password" name="Password" class="" placeholder="Your new password">                    
				</div>
			</div>
			<div class="metro double-size green">
                <div class="input-append lock-input">
                    <input type="password" name="vPassword" class="" placeholder="Retype password">
					<input type="hidden" name="FormAction" value="chpass" />
					<input type="hidden" name="sectoken" value="<phpdac>fronthtmlpage.echostr use sectoken</phpdac>" />
					<input type="hidden" name="turl" value="<phpdac>fronthtmlpage.echostr use turl</phpdac>">
					<input type="hidden" name="turldecoded" value="<phpdac>fronthtmlpage.echostr use turldecoded</phpdac>">
					<input type="hidden" name="cpGet" value="<phpdac>fronthtmlpage.echostr use cpGet</phpdac>">
					<input type="hidden" name="editmode" value="1">					
                    <button type="submit" class="btn tarquoise"><i class=" icon-arrow-right"></i></button>
                </div>
			</div>
		</form>
        <div class="metro single-size terques">
            <div class="locked">
                <i class="icon-lock"></i>
                <span>Locked</span>
            </div>
        </div>
        <!--div class="metro double-size gray ">
            <a href="login.html" class="user-position">
                <i class="icon-user"></i>
                <span>Login Another User</span>
            </a>
        </div>
        <div class="metro double-size orange">
            <a href="javascript:;" class="user-position">
                <i class="icon-key"></i>
                <span>Forgot Password ?</span>
            </a>
        </div-->
		
        <div class="login-footer">
            <!--div class="remember-hint pull-left">
                <input type="checkbox" id=""> Remember Me
            </div-->
			<div class="forgot-hint pull-left">
                <a id="forget-password" class="" href="#" onClick="top.location.href='../<phpdac>cms.echostr use turldecoded</phpdac>'"><phpdac>cms.slocale use _back</phpdac></a>
            </div>
            <div class="forgot-hint pull-right">
                <a id="forget-password" class="" href="cp.php?turl=<phpdac>cms.echostr use turl</phpdac>"><phpdac>cms.slocale use SHLOGIN_DPC</phpdac></a>
            </div>
        </div>		
    </div>
</body>
<!-- END BODY -->
</html>