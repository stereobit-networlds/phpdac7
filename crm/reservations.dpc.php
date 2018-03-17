<?php

//<script src="js/jquery.js" type="text/javascript"></script>
//<script src="js/jquery-cookies.js" type="text/javascript"></script>
//<script src="js/jquery-base64.js" type="text/javascript"></script>
//include('js/myrez/header-js.php'); //in-line
//<script src="js/myrez/main.js" type="text/javascript"></script> //in-line

//<link href="css/myrez/style.css" rel="stylesheet" type="text/css">
	   
$__DPCSEC['RESERVATIONS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if (!defined("RESERVATIONS_DPC")) {
define("RESERVATIONS_DPC",true);

$__DPC['RESERVATIONS_DPC'] = 'reservations';

$__EVENTS['RESERVATIONS_DPC'][0]= "reservations";
$__EVENTS['RESERVATIONS_DPC'][1]= 'make_reservation';
$__EVENTS['RESERVATIONS_DPC'][2]= 'delete_reservation';
$__EVENTS['RESERVATIONS_DPC'][3]= 'read_reservation';
$__EVENTS['RESERVATIONS_DPC'][4]= 'read_reservation_details';
$__EVENTS['RESERVATIONS_DPC'][5]= 'day_number';
$__EVENTS['RESERVATIONS_DPC'][6]= 'showreservations';
$__EVENTS['RESERVATIONS_DPC'][7]= 'hidereservations';
$__EVENTS['RESERVATIONS_DPC'][8]= 'send_mail_notifications';
$__EVENTS['RESERVATIONS_DPC'][9]= 'send_invitation_notifications';
$__EVENTS['RESERVATIONS_DPC'][10]= 'userverify';
$__EVENTS['RESERVATIONS_DPC'][11]= 'ownerverify';


$__ACTIONS['RESERVATIONS_DPC'][0]= "reservations";
$__ACTIONS['RESERVATIONS_DPC'][1]= 'make_reservation';
$__ACTIONS['RESERVATIONS_DPC'][2]= 'delete_reservation';
$__ACTIONS['RESERVATIONS_DPC'][3]= 'read_reservation';
$__ACTIONS['RESERVATIONS_DPC'][4]= 'read_reservation_details';
$__ACTIONS['RESERVATIONS_DPC'][5]= 'day_number';
$__ACTIONS['RESERVATIONS_DPC'][6]= 'showreservations';
$__ACTIONS['RESERVATIONS_DPC'][7]= 'hidereservations';
$__ACTIONS['RESERVATIONS_DPC'][8]= 'send_mail_notifications';
$__ACTIONS['RESERVATIONS_DPC'][9]= 'send_invitation_notifications';
$__ACTIONS['RESERVATIONS_DPC'][10]= 'userverify';
$__ACTIONS['RESERVATIONS_DPC'][11]= 'ownerverify';

$__LOCALE['RESERVATIONS_DPC'][0]='RESERVATIONS_DPC;Reservations;Καταχωρήσεις';
$__LOCALE['RESERVATIONS_DPC'][1]='Sunday;Sun;Κυρ';
$__LOCALE['RESERVATIONS_DPC'][2]='Monday;Mon;Δευ';
$__LOCALE['RESERVATIONS_DPC'][3]='Tuesday;Tue;Τρι';
$__LOCALE['RESERVATIONS_DPC'][4]='Wednesday;Wed;Τε';
$__LOCALE['RESERVATIONS_DPC'][5]='Thursday;Thu;Πε';
$__LOCALE['RESERVATIONS_DPC'][6]='Friday;Fri;Παρ';
$__LOCALE['RESERVATIONS_DPC'][7]='Saturday;Sat;Σαβ';
$__LOCALE['RESERVATIONS_DPC'][8]='today;Today;Σήμερα';
$__LOCALE['RESERVATIONS_DPC'][9]='close;Close;Κλείσε';
$__LOCALE['RESERVATIONS_DPC'][10]='prevweek;Previous week;Πίσω';
$__LOCALE['RESERVATIONS_DPC'][11]='nextweek;Next week;Εμπρός';
$__LOCALE['RESERVATIONS_DPC'][12]='reservationsweek;Reservations for week;Καταχωρήσεις για την εβδομάδα';
$__LOCALE['RESERVATIONS_DPC'][13]='_dhcr;Day have changed. Refreshing...;Άλλαξε η ημέρα. Ανανέωση...';
$__LOCALE['RESERVATIONS_DPC'][14]='_iwn;Invalid week number;Άκυρος αριθμός εβδομάδας';
$__LOCALE['RESERVATIONS_DPC'][15]='_loading;Loading...;Φόρτωση...';
$__LOCALE['RESERVATIONS_DPC'][16]='_abr;You are reserving back in time. You can do that because you are an admin;Ρύθμιση εκτός ορίων επειδή είστε διαχειριστής';
$__LOCALE['RESERVATIONS_DPC'][17]='_dhcr;Day have changed. Refreshing...;Άλλαξε η ημέρα. Ανανέωση...';
$__LOCALE['RESERVATIONS_DPC'][18]='_yrmt;You are reserving more than;Καταχώρηση περισσότερων απο';
$__LOCALE['RESERVATIONS_DPC'][19]='_wfa;weeks forward in time. You can do that because you are an admin;εβδομάδων στο μέλλον, επειδή είστε διαχειριστής';
$__LOCALE['RESERVATIONS_DPC'][20]='_ocie;One click is enough;Ένα κλίκ αρκεί';
$__LOCALE['RESERVATIONS_DPC'][21]='_ycr;You cannot remove other users reservations;Δεν μπορείτε να αφαιρέσετε καταχωρήσεις άλλων χρηστών';
$__LOCALE['RESERVATIONS_DPC'][22]='_ycrbit;You cannot reserve back in time;Δεν επιτρέπεται η καταχώρηση στο παρελθόν';
$__LOCALE['RESERVATIONS_DPC'][23]='_ycor;You can only reserve;Μπορείς να καταχωρήσεις μόνο';
$__LOCALE['RESERVATIONS_DPC'][24]='_wfit;weeks forward in time;εβδομάδες μπροστά στον χρόνο';
$__LOCALE['RESERVATIONS_DPC'][25]='_ser;Someone else just reserved this time;Καταχωρήθηκε απο άλλο χρήστη';
$__LOCALE['RESERVATIONS_DPC'][26]='_reserved;Reserved;Δεσμευμένο';
$__LOCALE['RESERVATIONS_DPC'][27]='_reservationmade;Reservation made:;Ημερ/νία καταχώρησης:';
$__LOCALE['RESERVATIONS_DPC'][28]='_usermail;Users email:;Email χρήστη:';
$__LOCALE['RESERVATIONS_DPC'][29]='_projecttitle;Project:;Έργο:';
$__LOCALE['RESERVATIONS_DPC'][30]='_codetitle;Code:;Κωδικός:';

$__LOCALE['RESERVATIONS_DPC'][31]='_sendnotifications;Send Notifications;Στείλε ειδοποίηση';
$__LOCALE['RESERVATIONS_DPC'][32]='_mailnotification;Notify users;Ενημέρωση συμμετεχόντων';
$__LOCALE['RESERVATIONS_DPC'][33]='_sendinvitations;Send Invitations;Στείλε πρόσκληση';
$__LOCALE['RESERVATIONS_DPC'][34]='_success;Success;Επιτυχώς';
$__LOCALE['RESERVATIONS_DPC'][35]='_failed;Failed;Πρόβλημα';
$__LOCALE['RESERVATIONS_DPC'][36]='_notauserornotintime;Not a user or not in time;Δεν υπάρχουν συμμετέχοντες ή εκτός χρόνου';
$__LOCALE['RESERVATIONS_DPC'][37]='_notauser;Not a user;Δεν υπάρχουν συμμετέχοντες';
$__LOCALE['RESERVATIONS_DPC'][38]='_isubject;Invitation for;Πρόσκληση σε δράση';
$__LOCALE['RESERVATIONS_DPC'][39]='_rsubject;Reminder for;Ειδοποίηση για δράση';
$__LOCALE['RESERVATIONS_DPC'][40]='_longitude;Longitude;Γεωγραφικό μήκος';
$__LOCALE['RESERVATIONS_DPC'][41]='_latitude;Latitude;Γεωγραφικό πλάτος';
$__LOCALE['RESERVATIONS_DPC'][42]='_pressbutton;Press;Ενημέρωση';
$__LOCALE['RESERVATIONS_DPC'][43]='_wait;Wait...;Περίμενε...';
$__LOCALE['RESERVATIONS_DPC'][44]='_resnotexist;This reservation no longer exists.;Η καταχώρηση δεν υπάρχει πιά.';
$__LOCALE['RESERVATIONS_DPC'][45]='_insertres;Registration;Καταχώρηση συμμετοχής';
$__LOCALE['RESERVATIONS_DPC'][46]='_removeres;Cancel registration;Ακύρωση συμμετοχής';
$__LOCALE['RESERVATIONS_DPC'][47]='_ycrinvoiced;You cannot remove invoiced reservations;Δεν μπορείτε να αφαιρέσετε τιμολογημένες καταχωρήσεις';

class reservations { 

	var $data, $global_times, $global_price, $global_week_number;
	var $global_weeks_forward, $global_day_name, $global_day_number;
	var $global_year, $global_currency, $global_reservation_reminders_code;
    var $global_css_animations;
	var $timestamp;
	
	var $reserve_only_projects, $show_user, $isprivate;
	var $xixuser;
	
	function __construct() {
	    $UserName = GetGlobal('UserName');
	
		$this->data = array();
	    $this->path = paramload('SHELL','prpath');
	    $this->urlpath = paramload('SHELL','urlpath');
	    $this->inpath = paramload('ID','hostinpath');

		$su = remote_paramload('SHRESERVATIONS','showusers',$this->path);
        $this->show_user = $su ? true : true;//false;
		$sp = remote_paramload('SHRESERVATIONS','showprojectdetails',$this->path);
        $this->show_project_details = $sp ? true : true;//false;		
		
		$rp = remote_paramload('SHRESERVATIONS','onlyprojects',$this->path);
		$this->reserve_only_projects = $rp ? true : false; 

        $this->isprivate = false;	
		
		//timezone	   
        //date_default_timezone_set('Europe/Athens');	
		
		// Possible reservation times. Use the same syntax as below (TimeFrom-TimeTo)
		$this->global_times = array('09-10', '10-11', '11-12', '12-13', '13-14', '14-15', '15-16', '16-17', '17-18', '18-19', '19-20', '20-21');
		
		//in case of ajax call and year change
		//if (GetReq('iyear')!=$this->global_year)
		$this->timestamp = (GetReq('istamp')) ? GetReq('istamp') : null;
		
		$pr = remote_paramload('SHRESERVATIONS','price',$this->path);
		$this->global_price = $pr ? $pr : 1;
		
		$cc = remote_paramload('SHRESERVATIONS','currency',$this->path);
		$this->global_currency = $cc ? $cc : '&euro;';			
		
		$wf = remote_paramload('SHRESERVATIONS','resweekforward',$this->path);
		$this->global_weeks_forward = $wf ? $wf : 2; 	
		
		$this->global_year = date('Y');//, $this->timestamp);		
		$this->global_week_number = ltrim(date('W'), '0');
		$this->global_day_name = localize(date('l'), getlocal());		
		$this->global_day_number = date('N');
		$this->global_reservation_reminders_code = '1234';
		$this->global_css_animations = '1';
		
		$p = $this->get_xixuser('user_name');
		$u = array_shift($p);
		$this->xixuser = ($UserName) ? $u : null;
		
		//call by host script at event
		/*$id = GetReq('id');
		if ($id) {	
			//$this->uagent(); //LOADED BY XIXUSER
			$this->javascript();
			//$this->social_post_javascript(); //disabled
		}*/
		
	}
	
    function event($event) {

	  switch ($event) {
	  
	    case 'userverify' : die($this->user_verify_reservation()); break;
		case 'ownerverify': die($this->owner_verify_reservation()); break;
	  
	    case 'send_invitation_notifications':
			die($this->reminders_job(true));
	        break;		
	    case 'send_mail_notifications': 
			die($this->reminders_job());
	        break;							
	    case 'make_reservation':
			$out =  $this->make_reservation(GetReq('week'), GetReq('day'), GetReq('time'));
			die($out);
			break;		
		case 'delete_reservation':
			$out = $this->delete_reservation(GetReq('week'), GetReq('day'), GetReq('time'));
            die($out);			
			break;		
		case 'read_reservation':
			$out = $this->read_reservation(GetReq('week'), GetReq('day'), GetReq('time'));
			die($out);
			break;		
		case 'read_reservation_details':
			$out = $this->read_reservation_details(GetReq('week'), GetReq('day'), GetReq('time'));		
			die($out);
			break;			
			
		case 'day_number'  : die(date('N'));//,$this->timestamp)); 
		
	    case 'hidereservations': $out = '';
		                         die($out);		
	    case 'showreservations': $out = $this->render();
		                         die($out);		
	    case 'reservations'    : $out = $this->render();
								 die($out);
	    default                : //$out = $this->render();
		                         //die($out);
	  }
    }	

    function action($action) {

	  switch ($action) {
	 
	    case 'userverify' : break;
		case 'ownerverify': break;
	  
	    case 'send_invitation_notifications': break;	  
	    case 'send_mail_notifications': break;	  
		
	    case 'make_reservation': break;
		case 'delete_reservation': break;
		case 'read_reservation': break;
		case 'read_reservation_details': break;		
        case 'day_number'  : break;
		case 'hidereservations': break; 
		case 'showreservations': break;		
	    case 'reservations': 
	    default            : //$out = $this->render();
	  }
	  
	  return ($out);
    }	
	
	protected function social_post_javascript() {
	
        if ((iniload('JAVASCRIPT')) && (defined('SHLOGIN_DPC'))) {
		
			if (GetGlobal('controller')->calldpc_method('shlogin.is_fb_logged_in')) {		
					
				$code = GetGlobal('controller')->calldpc_method('shlogin.fblogin_javascript');	
				$code .= $this->fb_post_javascript();	   		
	        }
			elseif (GetGlobal('controller')->calldpc_method('shlogin.is_google_logged_in')) {
			
			    $code = $this->gplus_post_javascript();
			}
			else //empty func
				$code = 'function social_post(){};';
			  	
			$js = new jscript;		   	 	
			$js->load_js($code,null,1);		
			unset ($js);	
	    }	
	}	
	
	protected function fb_post_javascript($method=null,$name=null,$caption=null, $descr=null) {
		$nam = $name ? $name : 'Test';
	    $cap = $caption ? $caption : 'Test post';
		$des = $descr ? $descr : 'Test description';
		$method = $method ? $method : 'feed';
		
		$href = GetGlobal('controller')->calldpc_method('frontpage.php_self use 1');
		$myhref = $href ? $href : 'http://www.xix.gr';
		$mypic = 'http://www.xix.gr/images/logo.png';
		
		$fbpostjs = <<<FBPOST

		function social_post(name,caption,descr) {  
		
			FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
				FB.ui({
						method: '$method', 
						name: name,
						link: '$myhref',
						picture: '$mypic',
						caption: caption,
						description: descr,
						//display: 'popup'
				},
				function(response) {
					if (response && response.post_id) {
						//alert('Post was published.');
						notify('Post was published.', 2);
					} else {
						//alert('Post was not published.');
						notify('Post was not published.', 2);
					}
				});
			} else {
				//alert('User cancelled login or did not fully authorize.');
				notify('User cancelled login or did not fully authorize.', 2);
			}
			}, {scope: 'user_likes,offline_access,publish_stream'});
			return false;
		};		
FBPOST;
		return ($fbpostjs);	
    }
	
	protected function gplus_post_javascript($method=null,$name=null,$caption=null, $descr=null) {
	
		$href = GetGlobal('controller')->calldpc_method('frontpage.php_self use 1');	
		
		$gpostjs = <<<GPLUSPOST
			
function social_post(name,caption,descr) {			
    var leftPosition, topPosition;
    leftPosition = (window.screen.width / 2) - ((540 / 2) + 10);
    topPosition = (window.screen.height / 2) - ((480 / 2) + 50);
    var windowFeatures = "status=no,height=" + "480" + ",width=" + "540" + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
    u='$href';//location.href;
    t=document.name;//title+','+name+','+caption+','+descr;
    window.open('https://plus.google.com/share?url='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer', windowFeatures);
    return false;	
};	
GPLUSPOST;
			
		return ($gpostjs);
	}	

	public function javascript() {
	
       if (iniload('JAVASCRIPT')) {
	   
	       $code = $this->javascript_code();
		   $js = new jscript;	

		   $js->load_css('javascripts/reservations/css/reservations.css');   
           //$js->load_js('reservations/jquery.js'); //loaded by frontpage
		   //$js->load_js('reservations/jquery-cookies.js');//==			   
		   //$js->load_js('reservations/jquery-base64.js');//==
           $js->load_js($code,null,1);		
		   unset ($js);
	   }	
	}	
	
	public function javascript_code()  {
		$UserName = GetGlobal('UserName');
		
		//in case of no id (cart) append ajaxurl with id var...
	    $keep_id = GetReq('id') ? 'id='.GetReq('id').'&cat='.GetReq('cat') : 'cat='.GetReq('cat');
	    $ajaxurl = seturl($keep_id."&t=");
		
		$istamp = GetReq('istamp');
		$iyear = GetReq('iyear');
		$iproject = GetReq('iproject');
	
	    $Day_have_changed_Refreshing = localize('_dhcr',getlocal());
		$Invalid_week_number = localize('_iwn',getlocal());
		$Loading = localize('_loading',getlocal());
		$adminbackreserve = localize('_abr',getlocal());
		$You_are_reserving_more_than = localize('_yrmt',getlocal());
		$weeks_forward_admin = localize('_wfa',getlocal());
		$One_click_is_enough = localize('_ocie',getlocal());
		$ycantremove = localize('_ycr',getlocal());
		$wait = localize('_wait',getlocal());
		$resnotexist = localize('_resnotexist',getlocal());
		$remove_res = localize('_removeres',getlocal());
		$insert_res = localize('_insertres',getlocal()); 
	
		if (isset($UserName)) {
		
			$isadmin = $this->is_admin() ? '1' : '0';	
		   
			$sesdata = 'session_logged_in = 1;';
			$sesdata.= 'session_user_id = \'' . decode($UserName) . '\';';
			$sesdata.= 'session_user_name = \'' . decode($UserName) . '\';';
			$sesdata.= 'session_user_is_admin = \'' . $isadmin . '\';';
			$sesdata.= 'session_xixuser = \'' . decode($UserName) . '\';';
		} 
   
		$jscript = <<<EOF
global_cookie_prefix = 'myrez' ;		
global_css_animations = {$this->global_css_animations} ;
global_weeks_forward =  {$this->global_weeks_forward} ;
global_year = {$this->global_year} ;
global_week_number = {$this->global_week_number} ;
global_day_number = {$this->global_day_number};

$sesdata	

function showreservations(iweek, iwday, iyear, istamp, iproject, icode)
{
	var iproject = parseInt(iproject)
	var istamp = parseInt(istamp);
	var iyear = parseInt(iyear);
	var iwday = parseInt(iwday);
	var iweek = parseInt(iweek);
    myweek = iweek ? iweek : global_week_number;
	selectedcode = icode ? '&id='+icode : '';
	
	//alert('Week:'+myweek);
	
	page_load('reservation');
	div_hide('#content_div');

	$.get('{$ajaxurl}reservations&iproject='+iproject+selectedcode, function(data)
	{
		$('#content_div').html(data);
		
		$('#week_number_span').html(myweek);//myweek
		
		div_fadein('#content_div');

		$.get('{$ajaxurl}reservations&week='+myweek+'&day='+iwday+'&iyear='+iyear+'&istamp='+istamp+'&iproject='+iproject+selectedcode, function(data)
		{
			$('#reservation_table_div').html(data).slideDown('slow', function() { setTimeout(function() { div_fadein('#reservation_table_div'); }, 250); });
			page_loaded();
			
			if(myweek != global_week_number) //myweek
			{
				$('#reservation_today_button').css('visibility', 'visible');
			}

			$('#reservation_hide_button').css('visibility', 'visible');
			
		});
	});
};

function hidereservations()
{	
	//page_load();
	div_hide('#content_div');
	$.get('{$ajaxurl}hidereservations', function(data) { $('#content_div').html(data); div_fadein('#content_div'); page_loaded(); });	
	//page_loaded();
};

function showweek(week, option, iyear, istamp)
{
    var istamp = parseInt(istamp);
    var iyear = parseInt(iyear);

	if(week == 'next')
	{
		var week = parseInt($('#week_number_span').html()) + 1;
	}
	else if(week == 'previous')
	{
		var week = parseInt($('#week_number_span').html()) - 1;
	}
	else
	{
		var week = parseInt(week);
	}

	if(isNaN(week))
	{
		notify('{$Invalid_week_number}', 4);
	}
	else
	{
		if(week < 1)
		{
			var week = 52;
		}
		else if(week > 52)
		{
			var week = 1;
		}

		page_load('week');
		div_hide('#reservation_table_div');

		$.get('{$ajaxurl}reservations&week='+week+'&iyear='+iyear+'&istamp='+istamp, function(data)
		{
			$('#reservation_table_div').html(data);
			$('#week_number_span').html(week);
			div_fadein('#reservation_table_div');
			page_loaded('week');

			if(week != global_week_number)
			{
				$('#reservation_today_button').css('visibility', 'visible');
			}

			$('#reservation_hide_button').css('visibility', 'visible');

			if(option == 'today')
			{
				setTimeout(function() { $('#today_span').animate({ opacity: 0 }, 250, function() { $('#today_span').animate({ opacity: 1 }, 250);  }); }, 500);
			}
		});
	}
};

function send_mail_notifications()
{
	var iproject = parseInt($('#iproject_span').html());

	$('#usage_message_p').html('<img src="images/loading.gif" alt="Loading"> {$saving}').slideDown('fast');

	$.get('{$ajaxurl}send_mail_notifications&iproject='+iproject, function(data)
	{
		if(data == 1)
		{
			setTimeout(function()
			{
				if($('#users_div').length)
				{
					list_users();
				}

				//get_usage();
				$('#usage_message_p').slideUp('fast');
			}, 1000);
		}
		else
		{
			$('#usage_message_p').html(data);
		}
	});
};

function send_invitation_notifications()
{
	var iproject = parseInt($('#iproject_span').html());

	$('#usage_message_p').html('<img src="images/loading.gif" alt="Loading"> {$saving}').slideDown('fast');

	$.get('{$ajaxurl}send_invitation_notifications&iproject='+iproject, function(data)
	{
		if(data == 1)
		{
			setTimeout(function()
			{
				if($('#users_div').length)
				{
					list_users();
				}

				//get_usage();
				$('#usage_message_p').slideUp('fast');
			}, 1000);
		}
		else
		{
			$('#usage_message_p').html(data);
		}
	});
};

function page_load(page)
{
	// All
	setTimeout(function()
	{
		if($('#content_div').css('opacity') == 0)
		{
			notify('{$Loading}', 300);
		}
	}, 500);

	// Individual
	if(page == 'reservation')
	{
		setTimeout(function()
		{
			if($('#reservation_table_div').is(':hidden'))
			{
				notify('{$Loading}', 300);
			}
		}, 500);
	}		
	else if(page == 'week')
	{
		setTimeout(function()
		{
			if($('#reservation_table_div').css('opacity') == 0)
			{
				notify('{$Loading}', 300);
			}
		}, 500);
	}
};

function page_loaded(page)
{
	// All
	$.get('{$ajaxurl}day_number', function(data)
	{
		if(data != global_day_number)
		{
			notify('{$Day_have_changed_Refreshing}', '300');
			setTimeout(function() { window.location.replace('.'); }, 2000);
		}
	});

	setTimeout(function()
	{
		if($('#notification_inner_cell_div').is(':visible') && $('#notification_inner_cell_div').html() == '{$Loading}')
		{
			notify();
		}
	}, 1000);

	read_reservation_details();

	// Individual
	if(page == 'about')
	{
		$('#about_latest_version_p').html('<img src="images/loading.gif" alt="Loading"> Getting latest version...');

		setTimeout(function()
		{
			$.get('main.php?latest_version', function(data)
			{
				if($('#about_latest_version_p').length)
				{
					$('#about_latest_version_p').html(data);
				}
			});
		}, 1000);
	}
};

function toggle_reservation_time(id, week, day, time, from, iproject)
{
	if(session_user_is_admin == '1')
	{
		if(week < global_week_number || week == global_week_number && day < global_day_number)
		{
			notify('{$adminbackreserve}', 4);
		}
		else if(week > global_week_number + global_weeks_forward)
		{
			notify('{$You_are_reserving_more_than} '+global_weeks_forward+' {$weeks_forward_admin}', 4);
		}
	}

	var user_name = $(id).html();
	var icode = $('#item_code_span').html();
	selectedcode = icode ? '&id='+icode : '';

	if(user_name == '')
	{
		$(id).html('{$wait}'); 

		$.post('{$ajaxurl}make_reservation'+selectedcode, { week: week, day: day, time: time, iproject: iproject }, function(data) 
		{
			if(data == 1)
			{
				setTimeout(function() { read_reservation(id, week, day, time, iproject); }, 1000);
			}
			else
			{
				notify(data, 4);
				setTimeout(function() { read_reservation(id, week, day, time, iproject); }, 2000);			
			}
		});
		
		//socialize
		/*$.get('{$ajaxurl}is_social', function(data) {
		
		    if (data == 1) {
			    var descr = $('#project_title_span').html(); 
				var iurl = '<a href="{$ajaxurl}">{$insert_res}</a>';
				$.post('{$ajaxurl}read_reservation_details'+selectedcode, { week: week, day: day, time: time, iproject: iproject }, function(details)
			    {
				  setTimeout(function() { social_post(descr,'{$insert_res}',details+iurl); }, 2000);
				}); 
			}	
		});	*/
	}
	else
	{

		if(offclick_event == 'mouseup' || from == 'details')
		{
			if(user_name == '{$wait}')
			{
				notify('{$One_click_is_enough}', 4);
			}
			else if(user_name == session_user_name || user_name == session_xixuser || session_user_is_admin == '1')
			{
				if(user_name != session_user_name && user_name != session_xixuser && session_user_is_admin == '1')
				{
					var delete_confirm = confirm('This is not your reservation, but because you\'re an admin you can remove other users\' reservations. Are you sure you want to do this?');
				}
				else
				{
					var delete_confirm = true;
				}

				if(delete_confirm)
				{
					$(id).html('{$wait}');

					$.post('{$ajaxurl}delete_reservation'+selectedcode, { week: week, day: day, time: time, iproject: iproject }, function(data)
					{
						if(data == 1)
						{
							setTimeout(function() { read_reservation(id, week, day, time, iproject); }, 1000);
						}
						else
						{
							notify(data, 4);
							setTimeout(function() { read_reservation(id, week, day, time, iproject); }, 2000);
						}
					});
				}
			}
			else
			{
				notify('{$ycantremove}', 2);
			}

			if($('#reservation_details_div').is(':visible'))
			{
				read_reservation_details();
			}
		}
		
		//..socialize
		/*$.get('{$ajaxurl}is_social', function(data) {
		
		    if (data == 1) {
			    var descr = $('#project_title_span').html(); 
				var iurl = '<a href="{$ajaxurl}">{$insert_res}</a>';
				$.post('{$ajaxurl}read_reservation_details'+selectedcode, { week: week, day: day, time: time, iproject: iproject }, function(details)
			    { 
				  setTimeout(function() { social_post(descr,'{$remove_res}',details+iurl); }, 1000);
				}); 
			}					
		});	*/		
	}
	
};

function read_reservation(id, week, day, time, iproject)
{
	var icode = $('#item_code_span').html();
	selectedcode = icode ? '&id='+icode : '';

	$.post('{$ajaxurl}read_reservation'+selectedcode, { week: week, day: day, time: time, iproject: iproject }, function(data) { $(id).html(data); });
};

function read_reservation_details(id, week, day, time, iproject)
{
	var icode = $('#item_code_span').html();
	selectedcode = icode ? '&id='+icode : '';

	if(typeof id != 'undefined' && $(id).html() != '' && $(id).html() != '{$wait}')
	{
		if($('#reservation_details_div').is(':hidden'))
		{
			var position = $(id).position();
			var top = position.top + 50;
			var left = position.left - 100;

			$('#reservation_details_div').html('Getting details...');
			$('#reservation_details_div').css('top', top+'px').css('left', left+'px');
			$('#reservation_details_div').fadeIn('fast');

			reservation_details_id = id;
			reservation_details_week = week;
			reservation_details_day = day;
			reservation_details_time = time;
			reservation_details_project = iproject;

			$.post('{$ajaxurl}read_reservation_details'+selectedcode, { week: week, day: day, time: time, iproject: iproject }, function(data)
			{
				setTimeout(function()
				{
					if(data == 0)
					{
						$('#reservation_details_div').html('{$resnotexist} {$wait}');
						
						setTimeout(function()
						{
							if($('#reservation_details_div').is(':visible') && $('#reservation_details_div').html() == '{$resnotexist} {$wait}')
							{
								read_reservation(reservation_details_id, reservation_details_week, reservation_details_day, reservation_details_time, reservation_details_project);
								read_reservation_details();
							}
						}, 2000);
					}
					else
					{
						$('#reservation_details_div').html(data);

						if(offclick_event == 'touchend')
						{
							if($(reservation_details_id).html() == session_user_name || session_user_is_admin == '1')
							{
								var delete_link_html = '<a href="." onclick="toggle_reservation_time(reservation_details_id, reservation_details_week, reservation_details_day, reservation_details_time, \'details\'); return false">Delete</a> | ';
							}
							else
							{
								var delete_link_html = '';
							}

							$('#reservation_details_div').append('<br><br>'+delete_link_html+'<a href="." onclick="read_reservation_details(); return false">Close this</a>');
						}
					}
				}, 500);
			});
		}
	}
	else
	{
		$('div#reservation_details_div').fadeOut('fast');
	}
};

function div_fadein(id)
{
	setTimeout(function()
	{
		if(global_css_animations == 1)
		{
			$(id).addClass('div_fadein');
		}
		else
		{
			$(id).animate({ opacity: 1 }, 250);
		}
	}, 1);
};

function div_hide(id)
{
	$(id).removeClass('div_fadein');
	$(id).css('opacity', '0');
};

function notify(text, time)
{
	if(typeof text != 'undefined')
	{
		if(typeof notify_timeout != 'undefined')
		{
			clearTimeout(notify_timeout);
		}

		$('#notification_inner_cell_div').css('opacity', '1');

		if($('#notification_div').is(':hidden'))
		{
			$('#notification_inner_cell_div').html(text);
			$('#notification_div').slideDown('fast');
		}
		else
		{
			$('#notification_inner_cell_div').animate({ opacity: 0 }, 250, function() { $('#notification_inner_cell_div').html(text); $('#notification_inner_cell_div').animate({ opacity: 1 }, 250); });
		}

		notify_timeout = setTimeout(function() { $('#notification_inner_cell_div').animate({ opacity: 0 }, 250, function() { $('#notification_div').slideUp('fast'); }); }, 1000 * time);
	}
	else
	{
		if($('#notification_div').is(':visible'))
		{
			$('#notification_inner_cell_div').animate({ opacity: 0 }, 250, function() { $('#notification_div').slideUp('fast'); });
		}
	}
};

function input_focus(id)
{
	if(offclick_event == 'touchend')
	{
		$('input').blur();
	}
	if(typeof id != 'undefined')
	{
		$(id).focus();
	}
};

$(document).ready( function()
{
	// Detect touch support
	if('ontouchstart' in document.documentElement)
	{
		onclick_event = 'touchstart';
		offclick_event = 'touchend';
	}
	else
	{
		onclick_event = 'mousedown';
		offclick_event = 'mouseup';
	}

	// Visual feedback on click
	$(document).on(onclick_event, 'input:submit, input:button, .reservation_time_div', function() { $(this).css('opacity', '0.5'); });
	$(document).on(offclick_event+ ' mouseout', 'input:submit, input:button, .reservation_time_div', function() { $(this).css('opacity', '1.0'); });

	// Buttons
	$(document).on('click', '#reservation_hide_button', function() { hidereservations(); });	
	$(document).on('click', '#reservation_today_button', function() { showweek(global_week_number, 'today'); });
	$(document).on('click', '#send_invitation_notifications_button', function() { send_invitation_notifications(); });
	$(document).on('click', '#send_mail_notifications_button', function() { send_mail_notifications(); });

	// Checkboxes

	// Forms

	// Links
	$(document).on('click mouseover', '#user_secret_code_a', function() { div_fadein('#user_secret_code_div'); return false; });
	$(document).on('click', '#previous_week_a', function() { showweek('previous'); return false; });
	$(document).on('click', '#next_week_a', function() { showweek('next'); return false; });

	// Divisions
	$(document).on('mouseout', '.reservation_time_cell_div', function() { read_reservation_details(); });
	$(document).on('mouseout', '.reservation_time_cell_div_project', function() { read_reservation_details(); });
	$(document).on('mouseout', '.reservation_time_cell_div_important', function() { read_reservation_details(); });
	$(document).on('mouseout', '.reservation_time_cell_div_urgent', function() { read_reservation_details(); });

	$(document).on('click', '.reservation_time_cell_div', function()
	{
		var array = this.id.split(':');
		toggle_reservation_time(this, array[1], array[2], array[3], array[0], array[4]);
	});
	$(document).on('click', '.reservation_time_cell_div_project', function()
	{
		var array = this.id.split(':');
		toggle_reservation_time(this, array[1], array[2], array[3], array[0], array[4]);
	});
	$(document).on('click', '.reservation_time_cell_div_important', function()
	{
		var array = this.id.split(':');
		toggle_reservation_time(this, array[1], array[2], array[3], array[0], array[4]);
	});
	$(document).on('click', '.reservation_time_cell_div_urgent', function()
	{
		var array = this.id.split(':');
		toggle_reservation_time(this, array[1], array[2], array[3], array[0], array[4]);
	});	

	$(document).on('mousemove', '.reservation_time_cell_div', function()
	{
		var array = this.id.split(':');
		read_reservation_details(this, array[1], array[2], array[3], array[4]);
	});
	$(document).on('mousemove', '.reservation_time_cell_div_project', function()
	{
		var array = this.id.split(':');
		read_reservation_details(this, array[1], array[2], array[3], array[4]);
	});
	$(document).on('mousemove', '.reservation_time_cell_div_important', function()
	{
		var array = this.id.split(':');
		read_reservation_details(this, array[1], array[2], array[3], array[4]);
	});
	$(document).on('mousemove', '.reservation_time_cell_div_urgent', function()
	{
		var array = this.id.split(':');
		read_reservation_details(this, array[1], array[2], array[3], array[4]);
	});	

	// Mouse pointer
	$(document).on('mouseover', 'input:button, input:submit, .reservation_time_div', function() { this.style.cursor = 'pointer'; });
});

$(document).ready( function()
{
	$.ajaxSetup({ cache: false });
});

EOF;
		return ($jscript);
    }	
	
	public function get_href($timestamp=null, $hasproject=false, $projectid=null) {
	    $code = GetReq('id') ? GetReq('id') : GetReq('cat');
			
		//global set for reservation only projects
		if (($this->reserve_only_projects) && (!$hasproject))
			return ('javascript: void(0)');
		
		if ($timestamp) {
			$week  = (int)date('W', $timestamp);
			$day_of_week = (int)date('N', $timestamp);
			$year = (int)date('Y', $timestamp);
		}	
		else {
			$week = $this->global_week_number;
			$day_of_week = date('N');//, $this->timestamp);
			$year = $this->global_year;
		}	
		
		if (($code) && ($projectid))
			return("javascript: showreservations($week, $day_of_week, $year, $timestamp, $projectid, '{$code}')");
		elseif ($projectid)	
			return("javascript: showreservations($week, $day_of_week, $year, $timestamp, $projectid)");
		else	
			return("javascript: showreservations($week, $day_of_week, $year, $timestamp)");

	}	
	
	public function header() {
	    $UserName = GetGlobal('UserName');
		if (!$UserName) return false;	
        //if ($this->is_admin()==false) return false;
        $id = GetReq('id') ? GetReq('id') : GetReq('cat');
        if (!$id) return false;  		
	
		$ret = '<div id="header_inner_div"><div id="header_inner_left_div"><a href="#about">About</a>';

		if ($UserName) 
			$ret .=  ' | <a href="#help">Help</a>';
   
        $ret .= '</div><div id="header_inner_center_div">';

		if ($UserName) 
			$ret .= '<b>Week ' . 
			        $this->global_week_number . ' - ' . 
					$this->global_day_name . ' ' . 
					date('jS F Y') . '</b>';

		$ret .= '</div><div id="header_inner_right_div">';

		if ($UserName) 
			$ret .= '<a href="#cp">Control panel</a> | <a href="#logout">Log out</a>';
		else 
			$ret .= 'Not logged in';

		$ret .= '</div></div>';
	
	    return ($ret);
	}
	
	protected function get_data($project_id=null) {
	    $db = GetGlobal('db');
		$UserName = GetGlobal('UserName');
		$code = GetReq('id') ? GetReq('id') : GetReq('cat');
		
		if (defined('CRMGANTTI_DPC')) 
			$is_owner = GetGlobal('controller')->calldpc_method("gantti.is_super_owner");
		else
			$is_owner = false;		
		
		$sSQL = 'select id,pid,owner,title,code,start,end,class,resclass,type,plan,reswforward,';
		$sSQL .= 'hideusers,private,include,exclude from projects WHERE';		
		$sSQL .= " code='". $code . "'";
		if (!$is_owner)
			$sSQL .= ' AND active=1';
			
		if ($project_id>0)
			$sSQL .= ' and id='.$project_id;
		//echo $sSQL;
		$result = $db->Execute($sSQL,2);

		//get value override reservations global val 
		if ($project_id>0) {//when project_id exist
		
			$this->reserve_only_projects = $result->fields['resclass'];
            			
			
			switch ($result->fields['type']) {
			    case 'daily':
				default :
			}
			
			//override project plan
			if ($result->fields['plan']) 
				$this->global_times = explode(',',$result->fields['plan']);
			//overrride how other users reservations
			//$this->show_user = ($result->fields['hideusers']>0) ? false : true;//local call		
			//is private project
			$this->isprivate = ($result->fields['private']>0) ? true : false;
			//override week forward to reserve
			$this->global_weeks_forward = ($result->fields['reswforward']>0) ?
										   $result->fields['reswforward'] :
										   $this->global_weeks_forward;
										   
		}	
 
	    foreach ($result as $p=>$prj) {
		
		    switch ($prj['class']) {
			    case  2 : $class = 'urgent'; break;
			    case  1 : $class = 'important'; break;
			    case  0 :
				default : $class = 'project'; 
			}
		
			$this->data[] = array(
						'label' => $prj['title'],
						'start' => $prj['start'], 
						'end'   => $prj['end'],
						'class' => $class,
						'project'  => $prj['id'],
						'project_title'  => $prj['title'],
					);			
        }	
        //print_r($this->data);
        return (!empty($this->data) ? true : false);		
	}
	
	//print date week num and day 1=mon to 7 =sun
	protected function dayinw($weekNum=1, $d=1) {
	    //$y = $this->global_year;
	    $tstamp = GetReq('istamp') ? GetReq('istamp') : null;
		//$sdate = date('d-m-Y', $tstamp);		
		$d = $d ? $d : date('w',$tstamp);//0-6
	
	    /*datetime::ISO8601*/
	    if ($tstamp) 
			$ret = date('d-m-Y', strtotime(date('Y',$tstamp)."W".date('W',$tstamp).$d)); //<<string
		else {//..error date when next prev..solved	
			$ww = sprintf('%02d',$weekNum);
			$ret = date('d-m-Y', strtotime("{$y}W{$ww}{$d}"));
		}	
					
		return (strval($ret));	 
	}
	
	function daysInWeek($weekNum) {
		$result = array();
		$datetime = new DateTime();
		
		//if ($this->timestamp)
			//$datetime->setTimestamp($this->timestamp);
		
		$datetime->setISODate((int)$datetime->format('Y'), $weekNum, 1);
		$interval = new DateInterval('P1D');
		$week = new DatePeriod($datetime, $interval, 6);

		foreach($week as $day){
			$result[] = $day->format('d-m-Y');
		}
		return $result;
	}
	
	protected function is_admin($id=null) {
		$is_super_owner = false;
		
		if (defined('CRMGANTTI_DPC')) //super owner 
			$is_super_owner = GetGlobal('controller')->calldpc_method("crmgantti.is_super_owner");
		//echo '>',$is_super_owner;
		
		return 	($is_super_owner);		
		//???
		$sid = $id ? $id : 5;
		
		$adminsecid = GetSessionParam('ADMINSecID') ? GetSessionParam('ADMINSecID') : $GLOBALS['ADMINSecID'];
		$seclevid = ($adminsecid>1) ? intval($adminsecid)-1 : 1;
		if (($adminsecid) && ($seclevid>=$sid))
			return true;	
			
		return false;	
	}	
	
	//check if week/day is in project time
	protected function in_project($weekNum=null, $iwday=null, $year=null) {
		if (!$weekNum) return false;
		$y = $year ? $year : $this->global_year;
		$d = $iwday ? $iwday : '0'; //0-6
		$tstamp = GetReq('istamp') ? GetReq('istamp') : null;
		
	    if ($tstamp) 
			$sdate = date('Y-m-d', strtotime(date('Y',$tstamp)."W".date('W',$tstamp).$d)); 
		else {//..error date when no tstamp ..solved sprintf 2 digits	
		    $ww = sprintf('%02d',$weekNum);
			$sdate = date('Y-m-d', strtotime("{$y}W{$ww}{$d}"));
		}	

		//echo $weekNum,':',$iwday,':',$year,'>';	  
		$start = $this->data[0]['start'];
		//echo $start,'>';
		$end = $this->data[0]['end'];
		//echo $end,'-',$sdate;//,'<br/>';
		
        if ((strtotime($sdate) >= strtotime($start)) &&
		    (strtotime($sdate) < strtotime($end))) {
			
			//return true;
			//$ret = $this->colorize_reservation_time_div(); //#color
			$ret = $this->data[0]['class'] ?
			       '_'.$this->data[0]['class'] : true; //color class
			//echo '-',$ret,'<br/>';	   
            return ($ret ? $ret : true); 			
		}
		
		return false;
	}	
	
	protected function colorize_reservation_time_div() {
	
		switch ($this->data[0]['class']) {//$class) {
			case 'urgent'   : $color = 'd33682';
			case 'important': $color = 'b58900';
			case 'project'  : $color = '268bd2';
			default 	    : $color = null;
		}
		return ($color);
	}
	
	public function render() {
		$UserName = GetGlobal('UserName');
		if (!$UserName) return false;
		
		$iproject = GetReq('iproject'); //echo $iproject,'>';
		$istamp = GetReq('istamp');
		$iyear = GetReq('iyear');
		$iwday = GetReq('day');		
		$week = GetReq('week');
		
		$id = GetReq('id') ? GetReq('id') : GetReq('cat');
		$itemcode = $id;
		//$title = strstr($id,':') ? array_shift(explode(':',$id)) : (strstr($id,'@') ? array_pop(explode('@',$id)) : $id);
	
	    //2nd call from js func
	    if (($this->get_data($iproject)) && (isset($_GET['week'])) && ($id)) {
		    //echo 'project:',$iproject;
			//$week = $_GET['week'];//already set
			$project_id = ($iproject>0) ? '_'.$this->data[0]['project'] : '0';
			$project_color = ($iproject>0) ? '_'.$this->data[0]['class'] : null; 
			$project_title = ($iproject>0) ? $this->data[0]['label'] : null; 
			$ret = '<strong><span id="project_title_span">'.$project_title.'</span></strong>';
			
			$ret .= '<table id="reservation_table"><colgroup span="1" id="reservation_time_colgroup"></colgroup><colgroup span="7" id="reservation_day_colgroup"></colgroup>';

			//$wd = $this->highlight_selected_date($this->daysInWeek($week));
			$wd2 = $this->highlight_selected_date(array(0=>$this->dayinw($week,1),
			                                            1=>$this->dayinw($week,2), 
														2=>$this->dayinw($week,3),
														3=>$this->dayinw($week,4),
														4=>$this->dayinw($week,5),
														5=>$this->dayinw($week,6),
														6=>$this->dayinw($week,7),
			                                     ));
			
			$mon = localize('Monday',getlocal()) . ' '. array_shift($wd2);// . ' '.array_shift($wd);
			$tue = localize('Tuesday',getlocal()) . ' '. array_shift($wd2);// . ' '.array_shift($wd);
			$wed = localize('Wednesday',getlocal()) . ' '. array_shift($wd2);// . ' '.array_shift($wd);
			$thu = localize('Thursday',getlocal()) . ' '. array_shift($wd2);// . ' '.array_shift($wd);
			$fri = localize('Friday',getlocal()) . ' '. array_shift($wd2);// . ' '.array_shift($wd);
			$sat = localize('Saturday',getlocal()) . ' '. array_shift($wd2);// . ' '.array_shift($wd);	
			$sun = localize('Sunday',getlocal()) . ' '. array_shift($wd2);// . ' '.array_shift($wd);
           	$today = localize('today',getlocal());	
			$close = localize('close',getlocal());
			
			$days_row = '<tr><td id="reservation_corner_td">';
			$days_row.= ($iproject>0) ? '' : '<input type="button" class="btn" id="reservation_today_button" value="'.$today.'">';
			$days_row.= '<input type="button" class="btn" id="reservation_hide_button" value="'.$close.'">'.
						'</td><th class="reservation_day_th">'.$mon.
						'</th><th class="reservation_day_th">'.$tue.
						'</th><th class="reservation_day_th">'.$wed.
						'</th><th class="reservation_day_th">'.$thu.
						'</th><th class="reservation_day_th">'.$fri.
						'</th><th class="reservation_day_th">'.$sat.
						'</th><th class="reservation_day_th">'.$sun.
						'</th></tr>';
			
			
			/*highlight_selected_date used...
			if ($day_of_week = GetReq('wday')) { 
				$ret .= $this->highlight_selected_day($days_row, $week, $day_of_week);
			}
			else*/if ($week == $this->global_week_number)	{
				$ret .= $this->highlight_day($days_row);
			}			
			else {
				$ret .= $days_row;
			}			

			foreach($this->global_times as $time) {
			
				$ret .= '<tr><th class="reservation_time_th">' . $time . '</th>';
				
				$i = 0;
				while ($i < 7) {
					$i++;
					
					//get color from day if in project
					if ($color = $this->in_project($week, $i, $iyear)) {
						$project_color = ($color!==true) ? $color : null;
						$project_id = $iproject;
					}	
					else {
						$project_color = null;
						$project_id = '0';
					}	
								
					if (($iproject) && ($this->reserve_only_projects)) {
					
					    if ($color) {//($this->in_project($week, $i, $iyear)) {
							$ret .= '<td><div class="reservation_time_div"><div class="reservation_time_cell_div'.$project_color.'" id="div:' . 
									$week . ':' . $i . ':' . $time . ':' . $project_id . '" onclick="void(0)">' . 
									$this->read_reservation($week, $i, $time, $project_id) . 
									'</div></div></td>';
						}
						else
							$ret .= '<td><div class="reservation_time_div">' . 
									/*$this->read_reservation($week, $i, $time, $project_id) . */
									'</div></td>';					
					}
					else
						$ret .= '<td><div class="reservation_time_div"><div class="reservation_time_cell_div'.$project_color.'" id="div:' . 
					        $week . ':' . $i . ':' . $time . ':' . $project_id . '" onclick="void(0)">' . 
					        $this->read_reservation($week, $i, $time, $project_id) . 
							'</div></div></td>';
				}
				$ret .= '</tr>';
			}
			$ret .= '</table>';
		}
		elseif ($this->get_data($iproject)) {//1st call from js func
		  
			$project_id = ($iproject>0) ? '_'.$this->data[0]['project'] : '0';
			$project_color = ($iproject>0) ? '_'.$this->data[0]['class'] : null; 
			$project_title = ($iproject>0) ? $this->data[0]['label'] : null; 		  
		  
			$ret.= '</div><div class="box_div'. $project_color .'" id="reservation_div"><div class="box_top_div" id="reservation_top_div"><div id="reservation_top_left_div">';
			$ret.= ($iproject>0) ? '' : '<a href="." id="previous_week_a">&lt; '.localize('prevweek',getlocal()).'</a>';
			$ret.= '</div><div id="reservation_top_center_div">'.
			        '<span id="item_code_span">' . $itemcode . '</span>' .
					', <span id="project_title_span">' . $project_title . '</span>: ' . 
			        localize('reservationsweek',getlocal()).
					' <span id="week_number_span">' . 
			        $this->global_week_number . 
					'</span></div><div id="reservation_top_right_div">';
			$ret.= ($iproject>0) ? '' : '<a href="." id="next_week_a">'.localize('nextweek',getlocal()).' &gt;</a>';
			$ret.= '</div></div><div class="box_body_div"><div id="reservation_table_div"></div></div></div><div id="reservation_details_div">';
        }
		
		return ($ret);		
	}
	
	//reservations
	protected function highlight_day($day) {
	
		$day = str_ireplace($this->global_day_name, '<span id="today_span">' . $this->global_day_name . '</span>', $day);
		return $day;
	}
	
	protected function highlight_selected_day($day, $week, $wday=null) {
		
	    if ($wday) {
		
			$wd = $this->daysInWeek($week);
			
			//calibrate
			/*if (($y = GetReq('iyear')) && ($this->global_year != $y)) {
			
				$diff = $this->global_year - GetReq('iyear');			
				$wday+=$diff;
			    $wcycle = ($wday<=0) ? (7-$wday) : (($wday>7) ? ($wday-7) : $wday);
			
				$sel_day = $wd[$wcycle]; 
			}
			else*/
				$sel_day = $wd[$wday-1]; 
			
			$day = str_ireplace($sel_day, '<span id="today_span">' . $sel_day . '</span>', $day);
		}
		return $day;
	}	
	
	//reservations date
	protected function highlight_selected_date($date) {
	    $tstamp = GetReq('istamp') ? GetReq('istamp') : null;
		if (!$tstamp) return ($date); //as is
		$sdate = date('d-m-Y', $tstamp);
		$dret = array();
		$hdate = null;
		
		if (is_array($date)) {
			foreach ($date as $i=>$d) {
			    $dret[$i] = ($sdate==$d) ? 
				            '<span id="selected_span">' . $d . '</span>':
                            $d;							
			}
			return ($dret);
		}
	    else {//string element
			$hdate = ($sdate==$date) ? 
				     '<span id="selected_span">' . $d . '</span>':
                     $date;			
		}			 

		return $hdate;
	}	
	
	protected function highlight_today($day, $force=false) {
	    $today = date('d-m-Y');
		
		$retday = ((strtotime($today)==strtotime($day)) || ($force)) ?
		          str_ireplace($day, '<span id="selected_span">' . $day . '</span>', $day) :
				  $day;
				
		return $retday;
	}	

	protected function read_reservation($week, $day, $time, $project_id=null) {
	    $db = GetGlobal('db');
		$code = GetReq('id') ? GetReq('id') : GetReq('cat');
		$UserName = GetGlobal('UserName');
		$label = false; //empty 
		$year = $this->global_year;
		$iproject = $project_id ? $project_id : GetParam('iproject'); 		
	    if (!$iproject) return null; //not a user when not project
	
		$query = "SELECT rname,ruser_id FROM reservations WHERE ryear='$year' AND rweek='$week' AND rday='$day' AND rtime='$time' AND code='$code' AND active=1";
		if ($iproject>0)
			$query .= " AND project_id=" . $iproject;		
		$result = $db->Execute($query,2);
		//echo $query,'<br/>';
		$reservation = $result->fields['ruser_id'];
		if ($reservation) {

			//$user = @array_shift($this->get_xixuser('user_name',$reservation));
			$p = $this->get_xixuser('user_name',$reservation);
			$user = array_shift($p);			
			
            //$hide_user = array_shift($this->get_project($iproject,'hideusers')) ? true : false;	
			$projectdata = $this->get_project($iproject,'owner,hideusers');
			$hide_user = ($projectdata['owner']==decode($UserName)) ?
			              false :
                         ($projectdata['hideusers'] ? true : false);  						  
			
			if (!$hide_user) 
			    $label = $user ;
			else	
				$label = ($reservation==decode($UserName)) ? 
				          $user : 
						  localize('_reserved',getlocal());
		}	
		
		return($label);
	}

	protected function read_reservation_details($week, $day, $time, $project_id=null) {
	    $db = GetGlobal('db');
		$code = GetReq('id') ? GetReq('id') : GetReq('cat');
		$UserName = GetGlobal('UserName');
		$iproject = $project_id ? $project_id : GetParam('iproject'); 
		//if (!$iproject) return null; //not a user when not project
		$year = $this->global_year;
		
		//$hide_user = array_shift($this->get_project($iproject,'hideusers')) ? true : false;		
		$projectdata = $this->get_project($iproject,'owner,hideusers');
		$hide_user = ($projectdata['owner']==decode($UserName)) ?
		              false :
                     ($projectdata['hideusers'] ? true : false);  						  
					
		$query = "SELECT rdate,ruser_id,remail,project_id FROM reservations WHERE ryear='$year' AND rweek='$week' AND rday='$day' AND rtime='$time' AND code='$code' AND active=1";
		if ($iproject>0)
			$query .= " AND project_id=" . $iproject;
		$result = $db->Execute($query,2);		
		//$reservation = $result->fields['rname'];
		
        $rm = localize('_reservationmade', getlocal());//Reservation made:
		$um = localize('_usermail', getlocal());//User\'s email:
 		
		if ($date = $result->fields['rdate']) {
		
		    $user = $result->fields['ruser_id'];
		
            $label_text = '<b>'.$rm.'</b> ' . $date;
			if (!$hide_user) {
			
				$label_text .= '<br><b>'.$um.'</b> ' . $user;
			}	
			else {
			    $user_label =  ($user==decode($UserName)) ? $user : localize('_reserved',getlocal());
				$label_text .= '<br><b>'.$um.'</b> ' . $user_label;
			}	
				
			if (($this->show_project_details) && 
			    ($project_id = $result->fields['project_id'])) {

                //if (defined('CRMGANTTI_DPC')) {
					$p_query = "SELECT title,descr,closed,code,start,end,class,resclass FROM projects WHERE id=".$project_id;
					$result = $db->Execute($p_query,2);
					
					$ptitle = localize('_projecttitle', getlocal());//project
					$label_text .= '<br><b>'.$ptitle.'</b> ' . $result->fields['title'];
					$pcode = localize('_codetitle', getlocal());//code
					$label_text .= '<br><b>'.$pcode.'</b> ' . $result->fields['code'];
					$label_text .= '<br><p>'. $result->fields['descr'] . '</p>';
                //}				
			}   
		    //$label_text .=  $query;	//text
			return($label_text);	
		}	

		return(0);
	}

	protected function make_reservation($week, $day, $time, $project_id=null) {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		if (!$UserName) return false;

		$code = GetReq('id') ? GetReq('id') : GetReq('cat');
		$iproject = $project_id ? $project_id : GetParam('iproject'); 
	
		$user_id = decode($UserName);//$UserName;
		$user_email = decode($UserName);
		$user_name = $this->xixuser ? $this->xixuser : decode($UserName);
		$price = $this->global_price;
		
		$isadmin = $this->is_admin();
		
		$ycrbit = localize('_ycrbit', getlocal());//'You can\'t reserve back in time'
		$ycor = localize('_ycor', getlocal());//You can only reserve
		$wfit = localize('_wfit', getlocal());//weeks forward in time
		$ser = localize('_ser', getlocal());//Someone else just reserved this time

		if($week < $this->global_week_number && 
			   $isadmin != '1' || 
			   $week == $this->global_week_number && $day < $this->global_day_number && 
			   $isadmin != '1') {
			//echo $ycrbit;  
			return($ycrbit);//'You can\'t reserve back in time'
		}
		elseif($week > $this->global_week_number + $this->global_weeks_forward && 
		       $isadmin != '1') {
		    //echo $ycor.' ' . $this->global_weeks_forward . ' '.$wfit;
			return($ycor.' ' . $this->global_weeks_forward . ' '.$wfit);
		}
		else { 
		    //echo 'a';
			$query = "SELECT id,ryear,active,deleted from reservations WHERE rweek='$week' AND rday='$day' AND rtime='$time' AND code='$code'";
			$query.= " AND ruser_id='$user_id' AND project_id=".$iproject; 
			$result = $db->Execute($query,2);

			//if(mysql_num_rows($query) < 1) {
			if ($result->fields['id']==null) { 
			    //echo 'b';
				$year = $this->global_year;
				
				$query = "INSERT INTO reservations (code,rdate,ryear,rweek,rday,rtime,rprice,ruser_id,remail,rname,active,project_id) VALUES ('$code',now(),'$year','$week','$day','$time','$price','$user_id','$user_email','$user_name',1,$iproject)";
				$result = $db->Execute($query,1);	
				echo localize('_loading',getlocal());//$query;
				return(1);
			}
			elseif ($result->fields['deleted']) {
			
			    $year = $result->fields['ryear'];
			
			    //update change user
				$query = "UPDATE reservations SET ruser_id='$user_id',remail='$user_email',rname='$user_name',active=1,deleted=0 WHERE id=".$result->fields['id'];
				//AND ryear= '$year' AND rweek='$week' AND rday='$day' AND rtime='$time' AND code='$code'";
				$query.= " AND ruser_id='$user_id' AND project_id=".$iproject; 
				$result = $db->Execute($query,1);	
				echo localize('_loading',getlocal());//$query;
				return(1);				
			}
			else {
			    //echo $ser; 
				return($ser);
			}	
		}
	}

	protected function delete_reservation($week, $day, $time, $project_id=null) {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		if (!$UserName) return false;	
		
		$code = GetReq('id') ? GetReq('id') : GetReq('cat');
        $iproject = $project_id ? $project_id : GetParam('iproject');
		
		$isadmin = $this->is_admin();	

		$ycrbit = localize('_ycrbit', getlocal());//'You can\'t reserve back in time' 
		$ycor = localize('_ycor', getlocal());//You can only reserve
		$wfit = localize('_wfit', getlocal());//weeks forward in time		
	    $ycantremove = localize('_ycr',getlocal());
		$ycantremoveinvoiced = localize('_ycrinvoiced',getlocal());
		
		if ($week < $this->global_week_number && 
		    $isadmin != '1' || 
			$week == $this->global_week_number && 
			$day < $this->global_day_number && 
			$isadmin != '1') {
			//echo $ycrbit;
			return($ycrbit);
		}
		elseif($week > $this->global_week_number + $this->global_weeks_forward && 
		       $isadmin != '1') {
			//echo  $ycor.' ' . $this->global_weeks_forward . ' '.$yfit;  
			return($ycor.' ' . $this->global_weeks_forward . ' '.$yfit);
		}
		else {
		    $year = $this->global_year;
		
			$query = "SELECT id,ruser_id,remail,invoiced from reservations WHERE ryear='$year' AND rweek='$week' AND rday='$day' AND rtime='$time' AND code='$code' AND active=1";
			$query.= " AND project_id=".$iproject;
			//$query .= " AND invoiced=0";
			$result = $db->Execute($query,2);

			if ($result->fields['ruser_id'] == decode($UserName) || 
			    $isadmin == '1') {
			   
			    if (!$result->fields['invoiced']) {
					$query = "UPDATE reservations SET active=0,deleted=1 WHERE id=".$result->fields['id'];
					//$query.= " AND rweek='$week' AND rday='$day' AND rtime='$time' AND code='$code'";
					//$query.= " AND project_id=".$iproject;
					$result = $db->Execute($query,1);
					echo localize('_loading',getlocal());
					return(1);
				}
				else {
					//echo $ycantremoveinvoiced;
					return($ycantremoveinvoiced);
                }				
			}
			else {
			    //echo $ycantremove;
				return($ycantremove);// . " ({$result->fields['remail']})");//'You can\'t remove other users\' reservations');
			}
		}
	}
	
	//alias in gantti............????!!!!!
	protected function get_project($project_id, $retfields=null) {
		$db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		if ((!$UserName)||(!$project_id)) return false;			
		$user = decode($UserName);

		$qf = $retfields ? ','.$retfields : null; 
		$query = "SELECT id{$qf} from projects WHERE id='{$project_id}'";
		$result = $db->Execute($query,2);
		
		if ($result->fields['id'])	{
		    if ($retfields) {
			    $retarray = array();
			    $fx = explode(',',$retfields);
			    foreach ($fx as $field)
					$retarray[$field] = $result->fields[$field];	
				return (array) $retarray;	
			}
			else
				return true; //already in
		}

        return false;		
	}

	//called as category
	public function show_public_projects($template=null) {
		$db = GetGlobal('db');
		$today = date('Y-m-d');//date from db is Y-m-d
		
		//use template
		$t = $this->urlpath .'/' . $this->infolder . '/cp/html/'. str_replace('.',getlocal().'.',$template) ;
		if (is_readable($t)) 
			$tdata = @file_get_contents($t);		
				
		$query = "SELECT id,title,code,cat from projects WHERE";
		$query .= " active=1 AND private=0";	
		$query .= ' order by date DESC LIMIT 10';	
		//echo $query;	
		$result = $db->Execute($query,2);

		if (!empty($result->fields)) {

		    foreach ($result as $n=>$rec) {
				$ptitle = seturl('t=kshow&cat='.$rec['cat'].'&id='.$rec['code'],$rec['title'],null,null,null,1);
            	
		   	    $out .= ($tdata) ?		
					   $this->combine_tokens2($tdata, array(0=>$ptitle), true)
				       :
					   $ptitle;
			}		   
		}					

        return ($out); 		
	}		
	
	
	protected function get_xixuser($retfields=null,$user_id=null) {
		$db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		if (!$UserName) return false;			
		$user = decode($UserName);
		
		return (array(0=>$user)); //return always this user

		/*
		$qf = $retfields ? ','.$retfields : null; 
		$query = "SELECT user_email{$qf} from xixusers WHERE";
		if ($user_id)
			$query .= " user_email='{$user_id}'";
		else
			$query .= " user_email='{$user}'";		
		$result = $db->Execute($query,2);
		
		if ($result->fields['user_email'])	{
		    if ($retfields) {
			    $retarray = array();
			    $fx = explode(',',$retfields);
			    foreach ($fx as $field)
					$retarray[$field] = $result->fields[$field];	
				return (array) $retarray;	
			}
			else
				return true; //alredy in
		}
        else {
			$query = "INSERT INTO xixusers SET user_email='{$user}'";
			$result = $db->Execute($query,1);	
            return true; 			
        }

        return false;	*/	
	}	
	
	//user, owner actions by mail
	protected function user_verify_reservation() {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		//if (!$UserName) return false;	
		
		$id = GetReq('pid') ? GetReq('pid') : null;
        if (!$id) return false;
		
		$query = "UPDATE reservations SET rapprove=1 WHERE id=".$id . " AND active=1";
		$result = $db->Execute($query,1);		
		//echo $query;
		if ($db->Affected_Rows()) {
		
			$query2 = "SELECT p.title,r.ruser_id,r.ryear,r.rweek,r.rday,r.rtime,r.remail,r.rname FROM reservations r INNER JOIN projects p ON p.id=r.project_id WHERE r.id=".$id. " AND r.active=1";
			$result2 = $db->Execute($query2,2);
			//echo $query2;
			$xixuser = $result2->fields['rname'] ? $result2->fields['rname'] : $result2->fields['remail'];
			$project_title = $result2->fields['title'];
			$press_button = localize('_pressbutton',getlocal());
		    $project_url = seturl('t=kshow&cat='.GetReq('cat').'&id='.GetReq('id'),$press_button,null,null,null,1);
			
			$Y = $result2->fields['ryear'];
			$W = sprintf('%02d',$result2->fields['rweek']);
			$D = $result2->fields['rday'];
			$user_date = date('d-m-Y',strtotime("{$Y}W{$W}{$D}"));
            $user_time = $result2->fields['rtime'];			
				
		
		    $msg = $this->create_message_body('xixreminder.htm',
				                               array('0'=>$project_title,
											         '1'=>$user_date,
													 '2'=>$user_time,
													 '3'=>$project_url,
													 '4'=>'YES',
													 '5'=>$xixuser,));
		
			return isset($msg) ? $msg : "Approved user reservation";
		}	
		
        return "Error";		
		//return false;	
	}
	
	protected function owner_verify_reservation() {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		//if (!$UserName) return false;	
		
		$id = GetReq('pid') ? GetReq('pid') : null;
        if (!$id) return false;
		
		$query = "UPDATE reservations SET oapprove=1 WHERE id=".$id. " AND active=1";
		$result = $db->Execute($query,1);		
		//echo $query;
		if ($db->Affected_Rows()) {
		
			$query2 = "SELECT p.title,r.ruser_id,r.ryear,r.rweek,r.rday,r.rtime,r.remail,r.rname FROM reservations r INNER JOIN projects p ON p.id=r.project_id WHERE r.id=".$id. " AND r.active=1";
			$result2 = $db->Execute($query2,2);
			
			$xixuser = $result2->fields['rname'] ? $result2->fields['rname'] : $result2->fields['remail'];
			$project_title = $result2->fields['title'];
			$press_button = localize('_pressbutton',getlocal());
		    $project_url = seturl('t=kshow&cat='.GetReq('cat').'&id='.GetReq('id'),$press_button,null,null,null,1);
			
			$Y = $result2->fields['ryear'];
			$W = sprintf('%02d',$result2->fields['rweek']);
			$D = $result2->fields['rday'];
			$user_date = date('d-m-Y',strtotime("{$Y}W{$W}{$D}"));
            $user_time = $result2->fields['rtime'];			
		
		    $msg = $this->create_message_body('xixownertell.htm',
				                               array('0'=>$project_title,
											         '1'=>$user_date,
													 '2'=>$user_time,
													 '3'=>$project_url,
													 '4'=>'YES',
													 '5'=>$xixuser,));		
		
			return isset($msg) ? $msg : "Approved owner reservation";
		}	
		
        return "Error";	
		//return false;	
	}	
	
	//remiders,invitations run by owner
	protected function reminders_job($isinvitation=false) {
		$db = GetGlobal('db');
		$week_number = $this->global_week_number;
		$day_number = $this->global_day_number;	
		$global_organization = 'XIX';	
		$global_reservation_reminders_email = 'noreply@xix.gr';
		$global_url = array_shift(arrayload('SHELL','ip'));//'www.xix.gr';
		$send_from = paramload('SMTPMAIL','user');
		$project_id = GetReq('iproject');
		$press_button = localize('_pressbutton',getlocal());
		$register_url = '<a href="'.$global_url . '/xix.php'.'">'.$press_button.'</a>';
		$ret = null;
		//return ('mails send '.$project_id);//true;
	
		if ($project_id) {
		
		    $notauser = localize('_notauser',getlocal());
			$notauserornotintime = localize('_notauserornotintime',getlocal());
		    $success = localize('_success',getlocal());
			$failed = localize('_failed',getlocal());
			$inv_subject = localize('_isubject',getlocal());
			$rem_subject = localize('_rsubject',getlocal());
			
		    //$nickname = @array_shift($this->get_xixuser('user_name'));
			$p = $this->get_xixuser('user_name');
			$nickname = array_shift($p);
			
            if ($isinvitation) {
				$iquery = "SELECT code,cat,owner,start,end,title,class,type,plan,exclude,include FROM projects WHERE";
				$iquery.= " id=".$project_id;		
				$iresult = $db->Execute($iquery,2);
				
				$xixname = $nickname ? $nickname : $iresult->fields['owner'];
				$ex = explode(',',$iresult->fields['exclude']);
				$in = explode(',',$iresult->fields['include']);
				$start = date('d-m-Y',strtotime($iresult->fields['start']));
				$end = date('d-m-Y',strtotime($iresult->fields['end']));
				$plan = $iresult->fields['plan'] ? $iresult->fields['plan'] : $this->global_times;
				//print_r($in);
				$project_url = '<a href="'.$global_url .'/'. seturl('t=kshow&cat='.$iresult->fields['cat'].'&id='.$iresult->fields['code'],null,null,null,null,1) . '">'.$press_button.'</a>';
				
				foreach ($in as $m=>$mail) {
					if (!in_array($mail,$ex)) {
					
						$subject = $inv_subject.' '.$iresult->fields['title'];
						$headers = "From: " . $global_organization . " <" . $global_reservation_reminders_email . ">\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						//$headers .= "Content-type: text/plain; charset=utf-8\r\n";
						
						if (!$message = $this->create_message_body('xixreminder.htm',
				                                           array('0'=>$iresult->fields['title'],
														         '1'=>$start.','.$end,
																 '2'=>$plan,
																 '3'=>$project_url,
																 '4'=>$register_url,
																 '5'=>$xixname,)))	{					
							$message = "This is a invitation for {$iresult->fields['title']} starting from {$start} to {$end}.\r\n\nYou have been invited by {$xixname} to make a reservation at the following plan(s): " . $plan . "\r\n\nIf you don't have a XIX account, create your XIX profile to make your reservation.\r\n\n" . $global_url;
							$headers .= "Content-type: text/plain; charset=utf-8\r\n";
						}
						else
							$headers .= "Content-type: text/html; charset=utf-8\r\n";
						
						$s = $this->sendmail_inqueue($send_from,$mail,$subject,$message,1,1);
						//$s = mail($mail, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $headers, "-f".$global_reservation_reminders_email);
						$ret .= $s ? $mail." {$success}<br/>" : $mail." {$failed}<br/>";					
					}	
				}
				//update flag
				$uquery = "UPDATE projects SET invsend = invsend + 1";
				$uquery.= " WHERE id=".$project_id;		
				$uresult = $db->Execute($uquery,1);
				return ($ret?$ret:$notauser);//.$iquery);
            }			

			
			$query = "SELECT x.user_email,r.id,r.rday,r.rweek,r.ryear,r.rtime,r.remail,r.project_id,p.title,p.owner,p.code,p.cat FROM reservations r ";
			$query.= " INNER JOIN projects p ON p.id = r.project_id INNER JOIN xixusers x ON x.user_email = r.ruser_id ";
			$query.= " AND r.project_id={$project_id} AND r.active=1 AND x.user_reservation_reminder='1'";		
			//$query.= " AND r.ryear='$year' AND r.rweek='$week' AND r.rday='$day_of_week'";
			$query.= " ORDER BY r.rtime";
			$result = $db->Execute($query,2);			
			//echo $query;

			foreach ($result as $r=>$rec) {

				$user_id = $rec['user_email'];//$user['user_id'];
				$project_title = $rec['title'] ? $rec['title'] : null;
				$project_url =  '<a href="'.$global_url .'/'. seturl('t=kshow&cat='.$rec['cat'].'&id='.$rec['code'],null,null,null,null,1).'">'.$press_button.'</a>';
				$reservation_id = $rec['id'];
				$verify_url = '<a href="'.$global_url .'/'.'xix.php?t=userverify&cat='.$rec['cat'].'&id='.$rec['code'].'&pid='.$reservation_id.'">'.$press_button.'</a>';
				
				$xixname = $nickname ? $nickname : $rec['owner'];
                $user_time = $rec['rtime'];
				
				$Y = $rec['ryear'];
				$W = sprintf('%02d',$rec['rweek']);
				$D = $rec['rday'];
				$user_date = date('d-m-Y',strtotime("{$Y}W{$W}{$D}"));
				
				$subject = $rem_subject.' '.$project_title;
				$headers = "From: " . $global_organization . " <" . $global_reservation_reminders_email . ">\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				//$headers .= "Content-type: text/plain; charset=utf-8\r\n";
				
				if (!$message = $this->create_message_body('xixreminder.htm',
				                                           array('0'=>$project_title,
														         '1'=>$user_date,
																 '2'=>$user_time,
																 '3'=>$project_url,
																 '4'=>$verify_url,
																 '5'=>$xixname,))) {
					$message = "This is a reservation reminder for action at $user_date.\r\n\nYou have made a reservation at the following time: " . $user_time . "\r\n\nIf you don't want to receive reservation reminders, you can turn it off in the control panel.\r\n\n" . $global_url;
					$headers .= "Content-type: text/plain; charset=utf-8\r\n";
				}
				else
					$headers .= "Content-type: text/html; charset=utf-8\r\n";
						
				$s = $this->sendmail_inqueue($send_from,$rec['remail'],$subject,$message,1,1);					
				//$s = mail($rec['remail'], '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $headers, "-f".$global_reservation_reminders_email);
				$say_label = "{$rec['remail']} $user_date $user_time";
				$ret .= $s ? $say_label." {$success}<br/>" : $rec['remail']." {$failed}<br/>";				
			}
			//update flag
			$uquery = "UPDATE projects SET remsend = remsend + 1";
			$uquery.= " WHERE id=".$project_id;		
			$uresult = $db->Execute($uquery,1);	
			return ($ret?$ret:$notauserornotintime);//.$query.' '.$query2);
		}	
	}
	
	//template based message body
	protected function create_message_body($template=null, $tokens=null) {
		if (!$template) return false;
		
		//use template
		//$tokens = array(0=>$ret);
		//$template = 'xixpanel.htm';
	    $t = $this->urlpath .'/' . $this->infolder . '/cp/html/'. str_replace('.',getlocal().'.',$template) ;
	    if (is_readable($t)) 
			$tdata = @file_get_contents($t);			
	   
	    if (($tdata) && (!empty($tokens))) 		
			$out = $this->combine_tokens2($tdata, $tokens, true);
		else
            $out = $ret;
			
		return ($out);		
	}	
	
	//send mail to db queue
	function sendmail_inqueue($from,$to,$subject,$mail_text='',$is_html=false, $trackmail=false) {
	   $db = GetGlobal('db');	
	   $ishtml = $is_html?$is_html:0;
       $sFormErr = GetGlobal('sFormErr');
	   $ccs = null;//GetParam('cc'); //echo $ccs;		 	      
	   $bccs = null;//GetParam('bcc');	//echo $bccs;	
	   $altbody = null;//GetParam('alttext'); 
	   $origin = $this->prpath; 
	   $user = paramload('SMTPMAIL','user');
	   $pass = paramload('SMTPMAIL','password');
	   $name = paramload('SMTPMAIL','realm');
	   $server = paramload('SMTPMAIL','smtpserver');//null; //default values
   	   $appname = null;//'xix';
		   
	   if ($trackmail) {
		 
       	 $i = rand(1000,1999);//++$m; 	 
		 $trackid = date('YmdHms') . $i . 'a@' . $appname;		 
		 
		 if (!$ishtml) {
		   $ishtml = 1;		 
		   $html_mail_text = '<HTML><BODY>' . $mail_text . '</BODY></HTML>';
		   $body = $this->add_tracker_to_mailbody($html_mail_text,$trackid,$to,$ishtml);
		 }
		 else //already html body ...leave it as is
	       $body = $this->add_tracker_to_mailbody($mail_text,$trackid,$to,$ishtml);
	   }
	   else
	     $body = $mail_text;

       if ((checkmail($from)) && ($subject)) {//echo $to,'<br>';
	   
         //add to db...local table
		 $datetime = date('Y-m-d h:s:m');
		 $active = 1;
         if (($trackmail) && (isset($trackid))) 
		   $sSQL = "insert into mailqueue (timein,active,sender,receiver,subject,body,altbody,cc,bcc,ishtml,encoding,origin,user,pass,name,server,trackid) ";
		 else  		 
		   $sSQL = "insert into mailqueue (timein,active,sender,receiver,subject,body,altbody,cc,bcc,ishtml,encoding,origin,user,pass,name,server) ";
		   
		 $sSQL .=  "values (" .
				 $db->qstr($datetime) . "," . $active . "," .
		 	     $db->qstr(strtolower($from)) . "," . $db->qstr(strtolower($to)) . "," .
			     $db->qstr($subject) . "," . 
				 $db->qstr($body) . "," .
				 $db->qstr($altbody) . "," .				 
				 $db->qstr($ccs) . "," .
				 $db->qstr($bccs) . "," .
				 $ishtml . "," .
				 $db->qstr('utf-8') . "," .  
		         $db->qstr($origin) . "," .			 
				 $db->qstr($user) . "," .
				 $db->qstr($pass) .	"," .	
				 $db->qstr($name) . "," .
				 $db->qstr($server);
				 
         if (($trackmail) && (isset($trackid))) {
		    $sSQL .= "," . $db->qstr($trackid) . ")";
		 }
		 else				 					 
			$sSQL .= ")"; 
	     //echo $sSQL;			
	     $result = $db->Execute($sSQL,1);			 
		 //$ret = $result->Affected_Rows();

		 return true;
 
       }
		 
	   return false;			 
	}	
	
	function add_tracker_to_mailbody($mailbody=null,$id=null,$receiver=null,$is_html=false) {
	
	   if (!$id) return;
	   
	   $i = rawurlencode(encode($id));
	
	   if ($receiver) {
	     $r = rawurlencode(encode($receiver));
	     $ret = "<img src=\"http://www.xix.gr/mtrack.php?i=$i&r=$r\" border=\"0\" width=\"1\" height=\"2\">";
	   }
	   else
	     $ret = "<img src=\"http://www.xix.gr/mtrack.php?i=$i\" border=\"0\" width=\"1\" height=\"2\">";
		 
	   if (($is_html) && (stristr($mailbody,'</BODY>')))
	     $out = str_ireplace('</BODY>',$ret.'</BODY>',$mailbody);
	   else
	     $out = $mailbody . $ret;

       @file_put_contents($this->prpath.'/trackcode.txt',$out);	 	 
		 
	   return ($out);	 
	} 		
	
	//tokens method	 $x$
	protected function combine_tokens2($template_contents,$tokens, $execafter=null) {
	
	    if (!is_array($tokens)) return;
		
		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
		  $fp = new fronthtmlpage(null);
		  $ret = $fp->process_commands($template_contents);
		  unset ($fp);
          //$ret = GetGlobal('controller')->calldpc_method("fronthtmlpage.process_commands use ".$template_contents);		  		
		}		  		
		else
		  $ret = $template_contents;
		  
		//echo $ret;
	    foreach ($tokens as $i=>$tok) {
            //echo $tok,'<br>';
		    $ret = str_replace("$".$i."$",$tok,$ret);
	    }
		//clean unused token marks
		for ($x=$i;$x<20;$x++)
		  $ret = str_replace("$".$x."$",'',$ret);
		//echo $ret;
		
		//execute after replace tokens
		if (($execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
		  $fp = new fronthtmlpage(null);
		  $retout = $fp->process_commands($ret);
		  unset ($fp);
          
		  return ($retout);
		}		
		
		return ($ret);
	}	

};
}
?>