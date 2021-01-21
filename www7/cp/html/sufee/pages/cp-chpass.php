<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><phpdac>cms.slocale use _RESETPASS</phpdac><</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>



</head>

<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.php">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form  method="POST" action=".">
                        <div class="form-group">
                            <label>New password</label>
                            <input type="password" name="Password"  class="form-control" placeholder="Your new password">
							<label>Retype password</label>
							<input type="email" name="vPassword" class="form-control" placeholder="Retype your new password">
                        </div>
                            <button type="submit" class="btn btn-primary btn-flat m-b-15">Submit</button>
					
					<input type="hidden" name="FormAction" value="chpass" />		
					<input type="hidden" name="sectoken" value="<phpdac>cms.echostr use sectoken</phpdac>" />
					<input type="hidden" name="turl" value="<phpdac>cms.echostr use turl</phpdac>">
					<input type="hidden" name="turldecoded" value="<phpdac>cms.echostr use turldecoded</phpdac>">
					<input type="hidden" name="cpGet" value="<phpdac>cms.echostr use cpGet</phpdac>">
					<input type="hidden" name="editmode" value="1">	
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


</body>

</html>
