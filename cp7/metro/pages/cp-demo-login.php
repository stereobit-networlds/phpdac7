<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Login</title>
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
    <div class="login-wrap">
        <div class="metro single-size red">
            <div class="locked">
                <i class="icon-lock"></i>
                <span>Login</span>
            </div>
        </div>
		<form method="POST" action="cp.php">
        <div class="metro double-size green">
                <div class="input-append lock-input">
                    <input name="cpuser" id="cpuser" type="text" class="" placeholder="Username">
                </div>
        </div>
        <div class="metro double-size yellow">
                <div class="input-append lock-input">
                    <input name="cppass" id="cppass" type="password" class="" placeholder="Password">
                </div>
        </div>
        <div class="metro single-size terques login">
                <button type="submit" class="btn login-btn">
                    Login
                    <i class=" icon-long-arrow-right"></i>
                </button>
        </div>
		<input type="hidden" name="FormAction" value="cp">
		</form>

        <div class="login-footer">
            <!--div class="remember-hint pull-left">
                <input type="checkbox" id=""> Remember Me
            </div-->
			<div class="forgot-hint pull-left">
                <a id="forget-password" class="" href="index.php"><phpdac>frontpage.slocale use _back</phpdac></a>
            </div>
            <div class="forgot-hint pull-right">
                <a id="forget-password" class="" href="cp.php?t=chpass"><phpdac>frontpage.slocale use _rempass</phpdac>?</a>
            </div>
        </div>
    </div>
</body>
<!-- END BODY -->
</html>