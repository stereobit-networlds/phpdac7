 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <!--link rel="canonical" href="https://getbootstrap.com/docs/3.4/examples/dashboard/"-->

    <title>e-Enterprise Dashboard Template for Bootstrap</title>

	<!-- Bootstrap core CSS -->
	<!--link href="dist/css/bootstrap.min.css" rel="stylesheet"-->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="../css/toastr/toastr.min.css" rel="stylesheet"/>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!--link href="dashboard.css" rel="stylesheet"-->
    <link href="theme.css" rel="stylesheet">    

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../js/themes/flick/jquery-ui.custom.css" rel="stylesheet" /> 
<link href="../js/jqgrid/css/ui.jqgrid.css" rel="stylesheet" />  

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->	
	
<style type="text/css">
/*
 * Base structure
 */

/* Move down content because we have a fixed navbar that is 50px tall */
body {
  padding-top: 50px;
}


/*
 * Global add-ons
 */

.sub-header {
  padding-bottom: 10px;
  border-bottom: 1px solid #eee;
}

/*
 * Top navigation
 * Hide default border to remove 1px line.
 */
.navbar-fixed-top {
  border: 0;
}

/*
 * Sidebar
 */

/* Hide for mobile, show later */
.sidebar {
  display: none;
}
@media (min-width: 768px) {
  .sidebar {
    position: fixed;
    top: 51px;
    bottom: 0;
    left: 0;
    z-index: 1000;
    display: block;
    padding: 20px;
    overflow-x: hidden;
    overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
    background-color: #f5f5f5;
    border-right: 1px solid #eee;
  }
}

/* Sidebar navigation */
.nav-sidebar {
  margin-right: -21px; /* 20px padding + 1px border */
  margin-bottom: 20px;
  margin-left: -20px;
}
.nav-sidebar > li > a {
  padding-right: 20px;
  padding-left: 20px;
}
.nav-sidebar > .active > a,
.nav-sidebar > .active > a:hover,
.nav-sidebar > .active > a:focus {
  color: #fff;
  background-color: #428bca;
}


/*
 * Main content
 */

.main {
  padding: 20px;
}
@media (min-width: 768px) {
  .main {
    padding-right: 40px;
    padding-left: 40px;
  }
}
.main .page-header {
  margin-top: 0;
}


/*
 * Placeholder dashboard ideas
 */

.placeholders {
  margin-bottom: 30px;
  text-align: center;
}
.placeholders h4 {
  margin-bottom: 0;
}
.placeholder {
  margin-bottom: 20px;
}
.placeholder img {
  display: inline-block;
  border-radius: 50%;
}



#grepKeyword, #settings {
    /*font-size: 80%;*/
}
.float {
    background: white;
    border-bottom: 1px solid black;
    padding: 10px 0 10px 0;
    margin: 0px;
    height: 30px;
    width: 100%;
    text-align: left;
}
.contents {
    margin-top: 30px;
}
/*
.results {
    padding-bottom: 20px;
    font-family: monospace;
    font-size: small;
    white-space: pre;
}
*/
</style>

<!--script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>	
	
<script src="../js/jqgrid/js/i18n/grid.locale-en.js"></script>			
<script src="../js/jqgrid/js/jquery.jqGrid.min.js"></script>
<script src="../js/toastr/toastr.min.js"></script>

<script type="text/javascript">
  <phpdac>rcpmenu.jread use 1++
                $(function () {
					$('#table').bootstrapTable({
						data: mydata
					});
				});
				scrollToBottom();
				toastr.info('Array loaded!');				
				</phpdac>	
				
toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-bottom-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};	

function goBack() {
  console.log(window.history.state);
  window.history.go(-1);
}				
	
 var $table = $('#table');
    var mydata = 
[
    {
        "id": 0,
        "name": "test0",
        "price": "$0"
    },
    {
        "id": 1,
        "name": "test1",
        "price": "$1"
    },
    {
        "id": 2,
        "name": "test2",
        "price": "$2"
    },
    {
        "id": 3,
        "name": "test3",
        "price": "$3"
    },
    {
        "id": 4,
        "name": "test4",
        "price": "$4"
    },
    {
        "id": 5,
        "name": "test5",
        "price": "$5"
    },
    {
        "id": 6,
        "name": "test6",
        "price": "$6"
    },
    {
        "id": 7,
        "name": "test7",
        "price": "$7"
    },
    {
        "id": 8,
        "name": "test8",
        "price": "$8"
    },
    {
        "id": 9,
        "name": "test9",
        "price": "$9"
    },
    {
        "id": 10,
        "name": "test10",
        "price": "$10"
    },
    {
        "id": 11,
        "name": "test11",
        "price": "$11"
    },
    {
        "id": 12,
        "name": "test12",
        "price": "$12"
    },
    {
        "id": 13,
        "name": "test13",
        "price": "$13"
    },
    {
        "id": 14,
        "name": "test14",
        "price": "$14"
    },
    {
        "id": 15,
        "name": "test15",
        "price": "$15"
    },
    {
        "id": 16,
        "name": "test16",
        "price": "$16"
    },
    {
        "id": 17,
        "name": "test17",
        "price": "$17"
    },
    {
        "id": 18,
        "name": "test18",
        "price": "$18"
    },
    {
        "id": 19,
        "name": "test19",
        "price": "$19"
    },
    {
        "id": 20,
        "name": "test20",
        "price": "$20"
    }
];

$(function () {
    $('#table').bootstrapTable({
        data: mydata
    });
});		
</script>
  </head>
