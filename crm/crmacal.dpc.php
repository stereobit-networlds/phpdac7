<?php
//    <!-- add styles and scripts -->
//    <link href="css/acal.css" rel="stylesheet" type="text/css" />
//    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	
$__DPCSEC['CRMACAL_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if (!defined("CRMACAL_DPC")) {
define("CRMACAL_DPC",true);

$__DPC['CRMACAL_DPC'] = 'crmacal';

$__EVENTS['CRMACAL_DPC'][0]= "crmacal";
$__EVENTS['CRMACAL_DPC'][1]= "acalajax";
$__EVENTS['CRMACAL_DPC'][2]= "acalnew";
$__EVENTS['CRMACAL_DPC'][3]= "acalclose";
$__EVENTS['CRMACAL_DPC'][4]= "set_project_combo";
$__EVENTS['CRMACAL_DPC'][5]= 'toggleprojectcheckbox';
$__EVENTS['CRMACAL_DPC'][6]= 'getprojectcheckbox';
$__EVENTS['CRMACAL_DPC'][7]= 'saveprojectconfiguration';

$__ACTIONS['CRMACAL_DPC'][0]= "crmacal";
$__ACTIONS['CRMACAL_DPC'][1]= "acalajax";
$__ACTIONS['CRMACAL_DPC'][2]= "acalnew";
$__ACTIONS['CRMACAL_DPC'][3]= "acalclose";
$__ACTIONS['CRMACAL_DPC'][4]= "set_project_combo";
$__ACTIONS['CRMACAL_DPC'][5]= 'toggleprojectcheckbox';
$__ACTIONS['CRMACAL_DPC'][6]= 'getprojectcheckbox';
$__ACTIONS['CRMACAL_DPC'][7]= 'saveprojectconfiguration';

$__LOCALE['CRMACAL_DPC'][0]='CRMACAL_DPC;Calendar;Ημερολόγιο';
$__LOCALE['CRMACAL_DPC'][1]='sun;Sun;Κυρ';
$__LOCALE['CRMACAL_DPC'][2]='mon;Mon;Δευ';
$__LOCALE['CRMACAL_DPC'][3]='tue;Tue;Τρι';
$__LOCALE['CRMACAL_DPC'][4]='wed;Wed;Τε';
$__LOCALE['CRMACAL_DPC'][5]='thu;Thu;Πε';
$__LOCALE['CRMACAL_DPC'][6]='fri;Fri;Παρ';
$__LOCALE['CRMACAL_DPC'][7]='sat;Sat;Σαβ';
$__LOCALE['CRMACAL_DPC'][8]='_newproject;New;Νέο';
$__LOCALE['CRMACAL_DPC'][9]='_pname;Name;Όνομα';
$__LOCALE['CRMACAL_DPC'][10]='_pstart;Start;Εκκίνηση';
$__LOCALE['CRMACAL_DPC'][11]='_pend;End;Λήξη';
$__LOCALE['CRMACAL_DPC'][12]='_setproject;Save;Αποθήκευση';
$__LOCALE['CRMACAL_DPC'][13]='_planlabel;Plan;Πλάνο';	
$__LOCALE['CRMACAL_DPC'][14]='_fwlabel;Week forward;Πρόβλεψη';
$__LOCALE['CRMACAL_DPC'][15]='_classlabel;Class;Τάξη';
$__LOCALE['CRMACAL_DPC'][16]='_privlabel;Private;Ιδιωτικό';
$__LOCALE['CRMACAL_DPC'][17]='_hideulabel;Hide users;Κρύψε χρήστες';
$__LOCALE['CRMACAL_DPC'][18]='_inclabel;Include;Συμπεριέλαβε';
$__LOCALE['CRMACAL_DPC'][19]='_exclabel;Exclude;Απέριψε';
$__LOCALE['CRMACAL_DPC'][20]='_activelabel;Active;Ενεργό';
$__LOCALE['CRMACAL_DPC'][21]='_ownerlabel;Owner;Ιδιοκτήτης';
$__LOCALE['CRMACAL_DPC'][22]='_resclasslabel;R class;R τύπος';
$__LOCALE['CRMACAL_DPC'][23]='_typelabel;Type;Τύπος';
$__LOCALE['CRMACAL_DPC'][24]='_grouplabel;Group;Ομαδοποίηση';
$__LOCALE['CRMACAL_DPC'][25]='_invitelabel;Invite friends;Κάλεσε φίλους';
$__LOCALE['CRMACAL_DPC'][26]='_invitebutton;Invitation;Κλήση';
$__LOCALE['CRMACAL_DPC'][27]='_close;Close;Κλείσε';
$__LOCALE['CRMACAL_DPC'][28]='_loading;Loading...;Φόρτωση...';
$__LOCALE['CRMACAL_DPC'][29]='_project;Project;Δράση';
$__LOCALE['CRMACAL_DPC'][30]='_important;Important;Σημαντική δράση';
$__LOCALE['CRMACAL_DPC'][31]='_urgent;Urgent;Επείγουσα δράση';
$__LOCALE['CRMACAL_DPC'][32]='_latitude;Latitude;Γ. Πλάτος';
$__LOCALE['CRMACAL_DPC'][33]='_longitude;Longitude;Γ. Μήκος';
$__LOCALE['CRMACAL_DPC'][34]='_recordinserted;Saved;Αποθηκεύθηκε';
$__LOCALE['CRMACAL_DPC'][35]='_recordupdated;Updated;Ενημερώθηκε';

class crmacal { 

	var $data, $reserve_only_projects, $subowner;
	var $sMonthName, $sCalTblRows, $iYear, $iNextMonth, $iPrevMonth, $iNextYear , $iPrevYear;

	function __construct($title=null, $cellwidth=25, $cellheight=25, $today=true) {
	    $UserName = GetGlobal('UserName');
		
        //timezone	   
        //date_default_timezone_set('Europe/Athens');		
	
		$this->data = array();
		$this->reserve_only_projects = false; //init
		$this->subowner = false; //init subowner
		
		$this->sMonthName = '';
		$this->sCalTblRows = '';
		$this->iYear ='';
		$this->iNextMonth = '';
		$this->iPrevMonth = '';
		$this->iNextYear = '';
		$this->iPrevYear = '';	

		//call by html
		/*$id = GetReq('id');	
		if ($id) {
			$this->javascript();
			//$this->social_invitation_javascript(); //disabled	
        }*/		
	}
	
    function event($event) {

	  switch ($event) {
	  
		case 'saveprojectconfiguration' : die($this->save_project_configuration());	break;
		case 'toggleprojectcheckbox':die($this->toggle_project_checkbox()); break;
        case 'getprojectcheckbox'   :die($this->get_project_checkbox()); break;			  
	  
	    case 'set_project_combo' : die($this->set_project_combo()); break;

	    case 'acalajax' : 	//if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_GET['month'])) {
		                    if ((isset($_GET['month'])) || (isset($_GET['date']))) {
								header('Content-Type: text/html; charset=utf-8');
								die($this->render(true));
							}
	    case 'acalclose': 	die(''); break;
														
							
	    case 'acalnew':    $this->create_new_project(); break;
	    case 'crmacal': 
	    default       :  
	  }
    }	

    function action($action) {

	  switch ($action) {
	  
	    case 'saveprojectconfiguration' : break;
	    case 'toggleprojectcheckbox': break;
        case 'getprojectcheckbox'   : break;	  
	  
	    case 'set_project_combo' : break;
	    case 'acalajax' : break;
		case 'acalclose': break;
	  
	    case 'acalnew':
	    case 'crmacal': 
	    default       : $out = $this->render();
	  }
	  
	  return ($out);
    }	
	
	protected function social_invitation_javascript() {
	
        if ((iniload('JAVASCRIPT')) && (defined('SHLOGIN_DPC'))) {
		
			if (GetGlobal('controller')->calldpc_method('shlogin.is_fb_logged_in')) {		
					
				$code = GetGlobal('controller')->calldpc_method('shlogin.fblogin_javascript');	
				$code .= $this->fb_invitation_javascript();	   		
	        }
			elseif (GetGlobal('controller')->calldpc_method('shlogin.is_google_logged_in')) {
			
			    $code = $this->gplus_invitation_javascript();
			}
			else //empty func
				$code = 'function social_invitation(){};';
			  	
			$js = new jscript;		   	 	
			$js->load_js($code,null,1);		
			unset ($js);	
	    }	
	}	
	
	protected function fb_invitation_javascript($method=null,$name=null,$caption=null, $descr=null) {
		$nam = $name ? $name : 'Test';
	    $cap = $caption ? $caption : 'Test invitation';
		$des = $descr ? $descr : 'Test description';
		$method = $method ? $method : 'apprequests';
		
		$href = GetGlobal('controller')->calldpc_method('frontpage.php_self use 1');
		$myhref = $href ? $href : 'http://www.xix.gr';
		$mypic = 'http://www.xix.gr/images/logo.png';
		/*		
		//Sending requests to specific people:		
		FB.ui({method: 'apprequests',
		  message: 'My Great Request',
		  to: {user-ids}
        }, requestCallback);
		//Sending requests using the Friend Picker:
		FB.ui({method: 'apprequests',
		  message: 'My Great Request'
		}, requestCallback);		
		*/
		
	    $keep_id = GetReq('id') ? 'id='.GetReq('id').'&cat='.GetReq('cat') : 'cat='.GetReq('cat');
	    $ajaxurl = seturl($keep_id."&t=");		
		
		$fbpostjs = <<<FBPOST

		function social_invitation(name,caption,descr) { 

          $.get('{$ajaxurl}is_social', function(data) {		
		  if (data) {
		  
			FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
				FB.ui({
						method: '$method', 
						message: name+','+caption+','+descr,
				},
				function(response) {
					if (response && response.post_id) {
						//alert('Invitation was send.');
						notify('Invitation was send.', 2);
					} else {
						//alert('Invitation not send.');
						notify('Invitation not send.', 2);
					}
				});
			} else {
				//alert('User cancelled login or did not fully authorize.');
				notify('User cancelled login or did not fully authorize.', 2);
			}
			}, {scope: 'user_likes,offline_access,publish_stream'});
			return false;
		  }
		  });	
		};		
FBPOST;
		return ($fbpostjs);	
    }
	
	protected function gplus_invitation_javascript($method=null,$name=null,$caption=null, $descr=null) {
	
		$href = GetGlobal('controller')->calldpc_method('frontpage.php_self use 1');		
	
		$gpostjs = <<<GPLUSPOST
			
function social_invitation(name,caption,descr) {			
/*
	gapi.client.load('plus','v1', function(){
		var request = gapi.client.plus.people.list({
		'userId': 'me',
		'collection': 'visible'
		});
		request.execute(function(resp) {
			console.log('Num people visible:' + resp.totalItems);
		});
	});	*/
    
	var leftPosition, topPosition;
    leftPosition = (window.screen.width / 2) - ((540 / 2) + 10);
    topPosition = (window.screen.height / 2) - ((480 / 2) + 50);
    var windowFeatures = "status=no,height=" + "480" + ",width=" + "540" + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
    u='$href';//location.href;
    t=name;//document.name;//title+','+name+','+caption+','+descr;
    window.open('https://plus.google.com/share?url='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer', windowFeatures);
    return false;		
};	
GPLUSPOST;
			
		return ($gpostjs);
	}		
	
	public function javascript() {
		//$UserName = GetGlobal('UserName');
		//if (!$UserName) return false;
			
        if (iniload('JAVASCRIPT')){
	       $code = $this->javascript_code();	   	
		   $js = new jscript;		

		   $js->load_css('javascripts/acal/css/acal.css');
		   //$js->load_js('https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js',null,null,null,true);
           $js->load_js($code,null,1);		
		   unset ($js);
	    }	
	}

	public function javascript_code()  {
	    $keep_id = 'id='. GetReq('id');
	    $ajaxurl = seturl($keep_id."&t=");		
		
		$Loading = localize('_loading',getlocal());
		$Inserted = localize('_recordinserted',getlocal());
		$Updated = localize('_recordupdated',getlocal());		

		if (defined('RESERVATIONS_DPC')) {
			$jscript = <<<RESJS
function acalclose()
{	
	hidereservations();
	$.get('{$ajaxurl}acalclose', function(data) { 
		$('#acal').html(data); 
	});	
};	
			
function acal_load(url)
{

	setTimeout(function()
	{
		if($('#content_div').css('opacity') == 0)
		{
			notify('{$Loading}', 300);
		}
					
	}, 500);	
	
	acalclose();
	$('#acal').load(url);
	
	setTimeout(function()
	{		
		if($('#notification_inner_cell_div').is(':visible') && $('#notification_inner_cell_div').html() == '{$Loading}')
		{
			notify();
		}
	}, 1000);
};
RESJS;

		}
		else {
		$jscript = <<<JSACAL
function acalclose()
{	
	$.get('{$ajaxurl}acalclose', function(data) {  
		$('#acal').html(data); 
	});	
};	
		
function acal_load(url)
{	
    acalclose();
	$('#acal').load(url);
};
JSACAL;
		}
		
		//if (!$UserName) return ($jscript);
		//else as logged in item owner set new project
		
		$jscript .= <<<JSEOF
function selectdate(date) {

  var pstart = document.getElementById('project_start').value;
  var pend = document.getElementById('project_end').value;

  var a = pstart ? new Date(pstart) : null;
  var b = pend ? new Date(pend) : null;    
  var d = date ? new Date(date) : null;  
  
  if (d>b) {
	document.getElementById('project_end').value = date;
  }	
  else {
    if (d>a)
	  document.getElementById('project_start').value = date;	
  }
  //alert(pstart);
  //id = (pstart == '') ? 'project_start' : 'project_end';
  //alert(id);
  //document.getElementById(id).value = date;  
  
};	

function set_project_combo(cvalue,cname)
{
    var project_id = parseInt($('#project_id_span').html());
	$('#project_details_checkbox_p').html('<img src="images/loading.gif" alt="Loading"> {$saving}').slideDown('fast');
	
	$.post('{$ajaxurl}set_project_combo', { cname: cname, cvalue: cvalue, project_id: project_id },function(data)
	{
		if(data == 1)
		{
			setTimeout(function()
			{
				//get_project_combo(project_id, cname);
				$('#project_details_checkbox_p').slideUp('fast');
	
			}, 1000);
		}
		else
		{
			$('#project_details_checkbox_p').html(data);
		}
	});
};	

function save_project_configuration()
{
	var project_name = $('#project_name').val();
	var project_start = $('#project_start').val();
	var project_end = $('#project_end').val();
	var project_plan = $('#project_plan').val();
	var project_id = $('#project_id').val();
	var code_id = $('#code_id').val();
	var project_owner = $('#project_owner').val();
	var project_active = $('#project_active').val();
	var project_type = $('#project_type').val();
	var project_class = $('#project_class').val();
	var project_resclass = $('#project_resclass').val();
	var project_private = $('#project_private').val();
	var project_hideusers = $('#project_hideusers').val();
	var project_forward = $('#project_forward').val();
	var project_include = $('#project_include').val();
	var project_exclude = $('#project_exclude').val();	
	var project_latitude = $('#project_latitude').val();
	var project_longitude = $('#project_longitude').val();	

	$('#project_details_message_p').html('<img src="images/loading.gif" alt="Loading"> {$savingandrefresh}').slideDown('fast');

	$.post('{$ajaxurl}saveprojectconfiguration', { project_active: project_active, project_owner: project_owner, project_name: project_name, project_start: project_start, project_end: project_end, project_plan: project_plan, project_class: project_class, project_resclass: project_resclass, project_type: project_type, project_forward: project_forward, project_private: project_private, project_hideusers: project_hideusers, project_include: project_include, project_exclude: project_exclude, project_latitude: project_latitude, project_longitude: project_longitude, project_id: project_id, code_id: code_id}, function(data)
	{
			//if(data == 1)
			if ((data=='{$Inserted}') || (data=='{$Updated}'))	
			{
				$('#project_title').html(project_name); /*update  title*/
				$('#project_id_span').html(project_id); /*update id in title*/
				
				$('#project_details_message_p').html(''); //data);
				
				input_focus();
				if (data=='{$Inserted}')
					window.location.reload(true);
			}
			else
			{
				input_focus();
				$('#project_details_message_p').html(data);
			}
			
			//socialize
			/*$.get('{$ajaxurl}is_social', function(data) {
		
				if (data) {
					setTimeout(function() { social_post(project_name,project_start,project_plan); }, 2000);
				}	
			});*/				
	});
};	

function get_project_checkbox(cpid)
{
    var project_id = parseInt($('#project_id_span').html());
	
	$.get('{$ajaxurl}getprojectcheckbox&pid='+project_id+'&cpid='+cpid, function(data) { 
		$('#project_'+cpid).html(data); 
	});
};		
		
function toggle_project_checkbox(cpid)
{
    var project_id = parseInt($('#project_id_span').html());
	//alert(cpid+'->'+project_id);
	
	$('#project_details_checkbox_p').html('<img src="images/loading.gif" alt="Loading"> {$saving}').slideDown('fast');
	
	$.post('{$ajaxurl}toggleprojectcheckbox', { cpid: cpid, project_id: project_id },function(data)
	{
		if(data == 1)
		{
			setTimeout(function()
			{
				get_project_checkbox(cpid);
				$('#project_details_checkbox_p').slideUp('fast');
	
			}, 1000);
		}
		else
		{
			$('#project_details_checkbox_p').html(data);
		}
	});
};	

$(document).ready( function()
{
	// Buttons
	//$(document).on('submit', '#project_details_form', function() { save_project_configuration(); return false; });
	// Checkboxes
	$(document).on('click', '#project_active', function() { toggle_project_checkbox('active'); });
	$(document).on('click', '#project_private', function() { toggle_project_checkbox('private'); });
	$(document).on('click', '#project_hideusers', function() { toggle_project_checkbox('hideusers'); });
	$(document).on('click', '#project_resclass', function() { toggle_project_checkbox('resclass'); });	

});	

JSEOF;
		return ($jscript);
    }
	
	protected function save_project_configuration() {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		
		if (!$UserName) return false;
 
		$code = GetParam('code_id') ? GetParam('code_id') : GetReq('id'); 
		if (!$code) return 'Invalid Id.';
		//$code = $id;// ? $id : $cat;
		$cat = 'x'; //no cat used
		
	    $o = GetParam('project_owner');		
		$owner = $o ? $o : decode($UserName);
	
	    $title = GetParam('project_name');
		if (!$title) return 'Invalid title.';
		$start = GetParam('project_start');
		if (!$start) return 'Invalid start date.';
		$end = GetParam('project_end');
		if (!$end) return 'Invalid end date.'; 
		$plan = GetParam('project_plan');
		
		$private = GetParam('project_private') ? '1' : '0';
		$hideusers = GetParam('project_hideusers') ? '1' : '0';
		$active = GetParam('project_active') ? '1' : '0';
		$class = GetParam('project_class') ? '1' : '0';
		$resclass = GetParam('project_resclass') ? '1' : '0';
		$type = GetParam('project_type');
		$forward = GetParam('project_forward') ? '1' : '0';
		$include = GetParam('project_include');
		$exclude = GetParam('project_exclude');
		$group = GetParam('project_group') ? intval(GetParam('project_group')) : 1;
		$latitude = GetParam('project_latitude');
		$longitude = GetParam('project_longitude');
		
		//check to see if is project for update
		$project_id = GetParam('project_id'); //form hidden field
		//print_r($_POST);
		
		if ($project_id) {
			//update
			$upddate = date('Y-m-d H:i:s');
			$sSQL = "UPDATE projects SET dateupd='$upddate',pid=$group,active=$active,owner='$owner',code='$code',cat='$cat',title='$title',start='$start',end='$end',class=$class,resclass=$resclass,type='$type',plan='$plan',reswforward=$forward,hideusers=$hideusers,private=$private,include='$include',exclude='$exclude',latitude='$latitude',longitude='$longitude'";
			$sSQL.= " WHERE id=".$project_id;
			$result = $db->Execute($sSQL,1);
			//echo $sSQL;		
			return (localize('_recordupdated',getlocal()));//'Record updated.');
		}
		else {
		    //extra checks 
			//if (strtotime($start)<time()) return 'Invalid start date.'; //(must be next day)
			if (strtotime($start) < mktime(0, 0, 0, date("m")  , date("d"), date("Y")))
				return 'Invalid start date.';
			if (strtotime($end) <= strtotime($start))
				return 'Invalid end date.';
			
			//insert
			$insdate = date('Y-m-d H:i:s');
			$sSQL = "INSERT INTO projects SET date='$insdate',dateupd='$insdate',pid=1,active=1,owner='$owner',code='$code',cat='$cat',title='$title',start='$start',end='$end',class=$class,resclass=$resclass,type='$type',plan='$plan',reswforward=$forward,hideusers=$hideusers,private=$private,include='$include',exclude='$exclude',latitude='$latitude',longitude='$longitude'";
			$result = $db->Execute($sSQL,1);
			//echo $sSQL;	
			return (localize('_recordinserted',getlocal()));//'Record added.');
        }		
		
	    //return (1);//'Record added.'); //never here
	}		

	protected function get_project_checkbox() {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		if (!$UserName) return false;		
		$cpid = GetReq('cpid');
		$project_id = GetReq('pid');
		if ((!$cpid)||(!$project_id)) return false;

		$query = "SELECT $cpid from projects WHERE id='{$project_id}'";	
		$result = $db->Execute($query,1);		
		//echo $query;
		
		return ($result->fields[$cpid]);	
	}		
	
	protected function toggle_project_checkbox() {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		if (!$UserName) return false;		
		$cpid = GetParam('cpid');
		$project_id = GetParam('project_id');
		if ((!$cpid)||(!$project_id)) return false;
		
		$upddate = date('Y-m-d');
		$query = "UPDATE projects SET dateupd='$upddate',$cpid = 1 - $cpid WHERE id='{$project_id}'";	
		$result = $db->Execute($query,1);		
		//echo $query;
		
		return(1);
	}	
	
	protected function has_reservations($timestamp=null) {
	    $db = GetGlobal('db');
		$code = GetReq('id') ? GetReq('id') : GetReq('cat');
		$reservation = false;
		
		if (!defined('RESERVATIONS_DPC')) return false;
		
		if ($timestamp) {
			$week  = (int)date('W', $timestamp);
			$day_of_week = (int)date('N', $timestamp);
			$year = (int)date('Y', $timestamp);
		}	
		else {
			$week = $this->global_week_number;
			$day_of_week = date('N');//, $this->timestamp);
			$year = date('Y');//$this->global_year;
		}		
		
		$query = "SELECT rname FROM reservations WHERE rweek='$week' AND rday='$day_of_week' AND ryear='$year' AND code='$code' AND active=1";
		$query.= " LIMIT 1";
		$result = $db->Execute($query,2);		
		$reservation = $result->fields['rname'];
		
		return($reservation);		
	
	}
	
	protected function has_project($date=null, &$projectid) {
	    $db = GetGlobal('db');
		$code = GetReq('id') ? GetReq('id') : GetReq('cat');
		$project_class = false;
		$project_id = GetReq('projectid') ? GetReq('projectid') : null;
		
		if (!defined('CRMGANTTI_DPC')) return false;

		$sSQL = 'select id,start,end,class,resclass from projects where active=1';
		$sSQL .= " and code='". $code . "'";
		$sSQL .= " and start<= date '$date' and end> date '$date'";		
		if ($project_id) //only project / code
			$sSQL .= " and id=" . $project_id;
		else //generic select all code projects	
			$sSQL .= " order by class DESC LIMIT 1";
		//echo $sSQL,'<br/><br/>';
		$result = $db->Execute($sSQL,2);

        if ($result->fields['id']) {
		    $projectid = $result->fields['id'];
			$project_class = $result->fields['class'];
					   
			switch ($project_class) {
				case  2 : $class = 'urgent'; break;
				case  1 : $class = 'important'; break;
				case  0 :
				default : $class = 'project'; 
			}
      			   	
			return($class);
        }
		return false;
		//$project = $result->fields['id'];
		//return($project);			
	}	
	
    protected function is_project_full($project_id=null) {
		$db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		if ((!$UserName) || (!$project_id)) return false;
				
		$year = date('Y');//$this->global_year;
		
		$sSQL = "SELECT start,end,plan from projects WHERE id=".$project_id;
		$result = $db->Execute($sSQL,2);
		$p_plan = $result->fields['plan'] ? 
		          explode(',',$result->fields['plan']) :
				  $this->global_times;
		$datetime1 = date_create($result->fields['start']);
		$datetime2 = date_create($result->fields['end']);
		$interval = date_diff($datetime1, $datetime2);
		$diff_days = $interval->format('%a');//%R%a days');
		//echo $diff_days;
		//print_r($p_plan);		  
		if (!empty($p_plan)) {	
			$plan_meter = 0;
			
			$query = "SELECT count(id) FROM reservations WHERE ";
			$query .= "ryear='$year' AND project_id=" . $project_id . " AND active=1 AND";

			foreach ($p_plan as $p=>$ptime) {
			    $plan_meter+=1;
			    $or = ($p>0) ? 'OR' : '(';
				$query .= " $or rtime='$ptime'";  	
			}		
			$query .= ')';
			//echo $plan_meter,'<br/>';
			$result = $db->Execute($query,2);
			//echo $query,'<br/>';
			
			$max_result = ($plan_meter * $diff_days);

			if (!empty($result)) {
				//echo $max_result,'<br/>',$result->fields[0];			
			    if ($result->fields[0]<$max_result)
					return false;
			}
			else
				return false; 			
		}
		
		return true;		
    }		
	
	protected function init($href=null, $is_new_project=false) {
	    $code = GetReq('id') ? GetReq('id') : GetReq('cat');
	
	    if ($is_new_project)
			$href = $href ? $href : 'javascript: void(0)';
	    elseif (defined('RESERVATIONS_DPC'))//'javascript:showhelp()';
			$href = GetGlobal('controller')->calldpc_method('reservations.get_href');
		else
			$href = $href ? $href : 'javascript: void(0)';
			
		// Get current year, month and day
		list($iNowYear, $iNowMonth, $iNowDay) = explode('-', date('Y-m-d'));

		// Get current year and month depending on possible GET parameters
		if (isset($_GET['month'])) { //month-year format
			list($iMonth, $this->iYear) = explode('-', $_GET['month']);
			$iMonth = (int)$iMonth;
			$this->iYear = (int)$this->iYear;
		} 
		if (isset($_GET['date'])) { //full date
			$pd = explode('-', $_GET['date']);
			$iMonth = (int)$pd[1];
			$this->iYear = (int)$pd[0];
		}	
		else {
			list($iMonth, $this->iYear) = explode('-', date('n-Y'));
		}

		// Get name and number of days of specified month days 
		$offs = (($iNowDay>=1) && ($iNowDay<=3)) ? 0 : 3;//-3 fro feb,31,30 (solve bug skipping feb)
		$iTimestamp = mktime(0, 0, 0, $iMonth, $iNowDay-$offs, $this->iYear);
		list($this->sMonthName, $iDaysInMonth) = explode('-', date('F-t', $iTimestamp));

		// Get previous year and month
		$this->iPrevYear = $this->iYear;
		$this->iPrevMonth = $iMonth - 1;
		if ($this->iPrevMonth <= 0) {
			$this->iPrevYear--;
			$this->iPrevMonth = 12; // set to December
		}

		// Get next year and month
		$this->iNextYear = $this->iYear;
		$this->iNextMonth = $iMonth + 1;
		if ($this->iNextMonth > 12) {
			$this->iNextYear++;
			$this->iNextMonth = 1;
		}

		// Get number of days of previous month 
		$offs = (($iNowDay>=1) && ($iNowDay<=3)) ? 0 : 3;//-3 fro feb,31,30 (solve bug skipping feb)
		$iPrevDaysInMonth = (int)date('t', mktime(0, 0, 0, $this->iPrevMonth, $iNowDay-$offs, $this->iPrevYear));

		// Get numeric representation of the day of the week of the first day of specified (current) month
		$iFirstDayDow = (int)date('w', mktime(0, 0, 0, $iMonth, 1, $this->iYear));

		// On what day the previous month begins
		$iPrevShowFrom = $iPrevDaysInMonth - $iFirstDayDow + 1;

		// If previous month
		$bPreviousMonth = ($iFirstDayDow > 0);

		// Initial day
		$iCurrentDay = ($bPreviousMonth) ? $iPrevShowFrom : 1;

		$bNextMonth = false;
		$this->sCalTblRows = '';

		// Generate rows for the calendar
		for ($i = 0; $i < 6; $i++) { // 6-weeks range
			$this->sCalTblRows .= '<tr>';
			for ($j = 0; $j < 7; $j++) { // 7 days a week

				$sClass = '';
				if ($iNowYear == $this->iYear && $iNowMonth == $iMonth && $iNowDay == $iCurrentDay && !$bPreviousMonth && !$bNextMonth) {
					$sClass = 'today';
				} elseif (!$bPreviousMonth && !$bNextMonth) {
					$sClass = 'current';
				}
				
				$cl = null; //has project...reset
				$projectid = null; //init reset
				if ((defined('CRMGANTTI_DPC')) && 
				    ($sClass == 'today') || ($sClass == 'current')) {
					$mydate = $this->iYear.'-'.$iMonth.'-'.$iCurrentDay;
					//bg color based on projects
					if ($cl = $this->has_project($mydate, $projectid)) {
						if ($sClass == 'today')
							$sClass = $cl.'today'; //projecttoday
						else	
							$sClass = $cl;					
					}
				}
                //else
                  //  $cl = $sClass;//for comparison below 				
				
				//override href for each day
				if ($is_new_project) {
					$mydate = date('Y-m-d',mktime(0, 0, 0, $iMonth, $iCurrentDay, $this->iYear));
					if ($sClass)
						$href = "javascript:selectdate('".$mydate."')";
					else
						$href = 'javascript: void(0)';	
				}
				elseif ((defined('RESERVATIONS_DPC')) && 
				    ($sClass == 'current') || ($sClass == 'today') ||
					($sClass == 'project') || ($sClass == 'projecttoday') ||
					($sClass == 'urgent') || ($sClass == 'urgenttoday') ||
					($sClass == 'important') || ($sClass == 'importanttoday')) {
				    $mydate = mktime(0, 0, 0, $iMonth, $iCurrentDay, $this->iYear);
					
					//get href to reservations (if project optional)..override reserve_only_projects	
					//echo $this->reserve_only_projects . '->' .$cl. '->' .$iCurrentDay.'<br/>';
					//remark reserve_only_projects for not allowing reservations out of projects range
					if (($this->reserve_only_projects) && (!$cl))
					    $href = 'javascript: void(0)';	
					else	
						$href = GetGlobal('controller')->calldpc_method("reservations.get_href use $mydate+$cl+$projectid");				
					
					//bg color based on reservations
					if ($this->has_reservations($mydate)) {
						if (($sClass == 'today') ||
						    ($sClass == 'projecttoday') ||
							($sClass == 'urgenttoday') ||
							($sClass == 'importanttoday'))
							$sClass .= 'reservedtoday';
						else	
							$sClass .= 'reserved';
					}
				}
                else
					$href = 'javascript: void(0)';
				//echo $sClass . ' ' .$iCurrentDay.'<br/>';	
				//echo $this->reserve_only_projects . '->' .$cl. '->' .$iCurrentDay.'<br/>';	
					
				$this->sCalTblRows .= '<td class="'.$sClass.'"><a href="'.$href.'">'.$iCurrentDay.'</a></td>';

				// Next day
				$iCurrentDay++;
				if ($bPreviousMonth && $iCurrentDay > $iPrevDaysInMonth) {
					$bPreviousMonth = false;
					$iCurrentDay = 1;
				}
				if (!$bPreviousMonth && !$bNextMonth && $iCurrentDay > $iDaysInMonth) {
					$bNextMonth = true;
					$iCurrentDay = 1;
				}
			}
			$this->sCalTblRows .= '</tr>';
		}	
	}
	
	protected function debug() {
	
	    $ret = $iNowYear.','. $iNowMonth.','. $iNowDay.',';
		$ret.= '<br/>'.$this->iPrevMonth.','.$this->iNextMonth.',';
		$ret.= '<br/>'.$this->sMonthName.','. $iDaysInMonth;
		
		return ($ret);
	}
	
	public function get_href($timestamp=null,$value=null,$isdate=false, $project=null, $project_title=null, $code=null, $ajaxlink=false) {

		if ($timestamp) {
		    //$value .= ':'.$date; 
			
            if ($format = $isdate) {	
                $myformat = (strstr($format,'%')) ? $format : '%Y-%m-%d';			
				//$timestamp = strtotime($date);
				//$a = strptime('2008-09-02', '%Y-%m-%d');
				//$timestamp = mktime(0, 0, 0, $a['tm_mon'], $a['tm_mday'], $a['tm_year']);			
				$a = date_parse_from_format($myformat, $timestamp);//'2008-09-02'); //> php 5.3
				$timestamp = mktime(0, 0, 0, $a['month'], $a['day'], $a['year']);
			}	
			$month = (int)date('m', $timestamp);	
			$week  = (int)date('W', $timestamp);
			$day_of_week = (int)date('N', $timestamp);
			$year = (int)date('Y', $timestamp);
		}	
		else {
		    $month = date('m');
			$week = date('W');
			$day_of_week = date('N');
			$year = date('Y');
		}	
		
		//keep project + id (id may have many projects in time)
        $project_id_title = $project ? '&projectid='.$project.'&ptitle='.urlencode($project_title) : null;		
		$id = $code ? $code : GetReq('id');
		$keep_id = '&id='.$id;
		$_month = "{$month}-{$year}";
		
		$_ajax_link = seturl('t=acalajax'.$project_id_title.$keep_id.'&month='.$_month.'&_r=');
		if ($ajaxlink)
			return ($_ajax_link);
		
		if ($value)
			$xlink = "<a class='btn btn-small' href='$_ajax_link' onclick=\"$('#acal').load('$_ajax_link' + Math.random()); return false;\">$value</a>";
		else
			$xlink = " onclick=\"$('#acal').load('$_ajax_link' + Math.random()); return false;\"";		
		
		return ($xlink);
	}
		
	protected function get_data($project_id=null, $is_super_owner=false) {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');		
		$id = GetReq('id');// ? GetReq('id') : GetReq('cat');
		$project_id = $project_id ? $project_id : GetReq('projectid');
		if (!$project_id) return false;
			
		$sSQL = 'select id,owner,pid,title,code,start,end,class,resclass from projects WHERE';
		$sSQL .= " code='". $id . "'";
		//if ($project_id)
		$sSQL .= " AND id=".$project_id;
		if (!$is_super_owner)
			$sSQL .= ' AND active=1';			
		//echo $sSQL;
		$result = $db->Execute($sSQL,2);

		//get value override reservations global val
		$this->reserve_only_projects = $result->fields['resclass'];

		return ($result->fields['owner']);
	}
	
	public function render($ajax=false, $hide=false) {
	    $UserName = GetGlobal('UserName');
		if (!$UserName) return false;	

	    if ($hide) {//init
			$ret = '<div id="acal"></div>';
			return ($ret);
		}	
	
	    $keep_id = '&id='.GetReq('id');
		$project_id = GetReq('projectid') ? GetReq('projectid') : null;
		$project_title = GetReq('ptitle') ? urldecode(GetReq('ptitle')).':' : null;
		//save project when calendar next,prev
		$project_id_title = $project_id ? '&projectid='.GetReq('projectid').'&ptitle='.urlencode(GetReq('ptitle')) : null;		
	
	
		$sun = localize('sun',getlocal());
		$mon = localize('mon',getlocal());
		$tue = localize('tue',getlocal());
		$wed = localize('wed',getlocal());
		$thu = localize('thu',getlocal());
		$fri = localize('fri',getlocal());
		$sat = localize('sat',getlocal());
							
		//item owner = super owner
		if (defined('CRMGANTTI_DPC')) //super owner 
			$is_super_owner = GetGlobal('controller')->calldpc_method("crmgantti.is_super_owner");
				
		//project is_owner = subowner..	
	    if ($is_owner = $this->get_data($project_id, $is_super_owner)) {
		
		    //init calendar
			$this->init();		
			
			$__prev_month = "{$this->iPrevMonth}-{$this->iPrevYear}";
			$__next_month = "{$this->iNextMonth}-{$this->iNextYear}";
			$__cal_caption = $project_title . localize($this->sMonthName, getlocal()) . ', ' . $this->iYear;
			$__cal_rows = $this->sCalTblRows;
			$__prev_link = seturl('t=acalajax'.$project_id_title.$keep_id.'&month='.$__prev_month);
			$__next_link = seturl('t=acalajax'.$project_id_title.$keep_id.'&month='.$__next_month);
			$__ajax_prev_link = seturl('t=acalajax'.$project_id_title.$keep_id.'&month='.$__prev_month.'&_r=');
			$__ajax_next_link = seturl('t=acalajax'.$project_id_title.$keep_id.'&month='.$__next_month.'&_r=');
			
			$sCalendarItself = '<div id="calendar">';	
			$sCalendarItself .= (($is_owner == decode($UserName)) || ($is_super_owner)) ? $this->project_form($project_id) : null;		
			
			$sCalendarItself .= <<<EOF
			
<div class="navigation">
    <a class="prev" href="$__prev_link" onclick="$('#acal').load('$__ajax_prev_link' + Math.random()); return false;"></a>
    <div class="title" >$__cal_caption</div>
    <a class="next" href="$__next_link" onclick="$('#acal').load('$__ajax_next_link' + Math.random()); return false;"></a>
</div>

<table>
    <tr>
        <th class="weekday">$sun</th>
        <th class="weekday">$mon</th>
        <th class="weekday">$tue</th>
        <th class="weekday">$wed</th>
        <th class="weekday">$thu</th>
        <th class="weekday">$fri</th>
        <th class="weekday">$sat</th>
    </tr>
    $__cal_rows
</table>
</div> <!--calendar div-->			
EOF;
			
			// AJAX requests - return the calendar
			/*if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_GET['month'])) {
			//if (isset($_GET['month'])) {
				header('Content-Type: text/html; charset=utf-8');
				echo $sCalendarItself;
				exit;
			}*/
			if ($ajax)
				return ($sCalendarItself);

			$ret = '<div id="acal">';
			$ret .=  $sCalendarItself;
			$ret .= '</div>';
							
			return ($ret);
        }
		elseif ($is_super_owner) { //if super_owner
		    //new project calendar call
			$this->init('javascript:selectdate()', true);
			
			$newname = localize('_newproject',getlocal());
					
			$__prev_month = "{$this->iPrevMonth}-{$this->iPrevYear}";
			$__next_month = "{$this->iNextMonth}-{$this->iNextYear}";
			$__cal_caption = $newname. ':' . localize($this->sMonthName, getlocal()) . ', ' . $this->iYear;
			$__cal_rows = $this->sCalTblRows;
			$__prev_link = seturl('t=acalajax'.$project_id_title.$keep_id.'&month='.$__prev_month);
			$__next_link = seturl('t=acalajax'.$project_id_title.$keep_id.'&month='.$__next_month);
			$__ajax_prev_link = seturl('t=acalajax'.$project_id_title.$keep_id.'&month='.$__prev_month.'&_r=');
			$__ajax_next_link = seturl('t=acalajax'.$project_id_title.$keep_id.'&month='.$__next_month.'&_r=');
			
			$sCalendarItself = '<div id="calendar">';
			$sCalendarItself .= ($is_super_owner) ? $this->project_form() : null;
			
			$sCalendarItself .= <<<EOF
<div class="navigation">
    <a class="prev" href="$__prev_link" onclick="$('#acal').load('$__ajax_prev_link' + Math.random()); return false;"></a>
    <div class="title" >$__cal_caption</div>
    <a class="next" href="$__next_link" onclick="$('#acal').load('$__ajax_next_link' + Math.random()); return false;"></a>
</div>

<table>
    <tr>
        <th class="weekday">$sun</th>
        <th class="weekday">$mon</th>
        <th class="weekday">$tue</th>
        <th class="weekday">$wed</th>
        <th class="weekday">$thu</th>
        <th class="weekday">$fri</th>
        <th class="weekday">$sat</th>
    </tr>
    $__cal_rows
</table>
</div> <!--calendar div-->				
EOF;
					
			if ($ajax)
				return ($sCalendarItself);
				
			$ret = '<div id="acal">';
			$ret .=  $sCalendarItself;
			$ret .= '</div>';
							
			return ($ret);			
			//return ('-nodata');
		}	
		else { //is cart selectable
		    //init calendar
			$this->init(); 	
			
			$__prev_month = "{$this->iPrevMonth}-{$this->iPrevYear}";
			$__next_month = "{$this->iNextMonth}-{$this->iNextYear}";
			$__cal_caption = $project_title . localize($this->sMonthName, getlocal()) . ', ' . $this->iYear;
			$__cal_rows = $this->sCalTblRows;
			$__prev_link = seturl('t=acalajax'.$project_id_title.$keep_id.'&month='.$__prev_month);
			$__next_link = seturl('t=acalajax'.$project_id_title.$keep_id.'&month='.$__next_month);
			$__ajax_prev_link = seturl('t=acalajax'.$project_id_title.$keep_id.'&month='.$__prev_month.'&_r=');
			$__ajax_next_link = seturl('t=acalajax'.$project_id_title.$keep_id.'&month='.$__next_month.'&_r=');
			
			$sCalendarItself = '<div id="calendar">';
			$sCalendarItself .= ($is_super_owner) ? $this->project_form() : null;
			
			$sCalendarItself .= <<<EOF
<div class="navigation">
    <a class="prev" href="$__prev_link" onclick="$('#acal').load('$__ajax_prev_link' + Math.random()); return false;"></a>
    <div class="title" >$__cal_caption</div>
    <a class="next" href="$__next_link" onclick="$('#acal').load('$__ajax_next_link' + Math.random()); return false;"></a>
</div>

<table>
    <tr>
        <th class="weekday">$sun</th>
        <th class="weekday">$mon</th>
        <th class="weekday">$tue</th>
        <th class="weekday">$wed</th>
        <th class="weekday">$thu</th>
        <th class="weekday">$fri</th>
        <th class="weekday">$sat</th>
    </tr>
    $__cal_rows
</table>
</div> <!--calendar div-->				
EOF;
					
			if ($ajax)
				return ($sCalendarItself);
				
			$ret = '<div id="acal">';
			$ret .=  $sCalendarItself;
			$ret .= '</div>';
							
			return ($ret);				
		}
		
		return false;		
	}
	
	protected function project_metroForm($project_id=null) {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		if (!$UserName) return false;
		
		$code_id = GetReq('id');
		
		//$this->get_friends();
		if (defined('XIXUSER_DPC')) { 
			$location = GetGlobal('controller')->calldpc_method('xixuser.get_user_location');
			$xy = explode(',',$location);
			$ulatitude = $xy[0];
			$ulongitude = $xy[1];
		}
        else {
			$ulatitude = 0;
			$ulongitude = 0;		
        }  
		//echo $ulatitude,'-',$ulongitude;		
		
		$name_label = localize('_pname' ,getlocal());
		$start_label = localize('_pstart' ,getlocal());
		$end_label = localize('_pend' ,getlocal());
		$newname = localize('_newproject',getlocal());
		$projectset = localize('_setproject',getlocal());
		$plan_label = localize('_planlabel',getlocal());	
		$forward_label = localize('_fwlabel',getlocal());
		$class_label = localize('_classlabel',getlocal());
		$resclass_label = localize('_resclasslabel',getlocal());
		$type_label = localize('_typelabel',getlocal());
		$isprivate_label = localize('_privlabel',getlocal());
		$hideusers_label = localize('_hideulabel',getlocal());
		$include_label = localize('_inclabel',getlocal());
		$exclude_label = localize('_exclabel',getlocal());
		$active_label = localize('_activelabel',getlocal());
		$owner_label = localize('_ownerlabel',getlocal());
		$group_label = localize('_grouplabel',getlocal());			
		$invite_social_label = localize('_invitelabel',getlocal());
		$project_social_invite = localize('_invitebutton',getlocal());
		$close = localize('close',getlocal());
		$latitude_label = localize('_latitude',getlocal());
		$longitude_label = localize('_longitude',getlocal());		
		
		if ($project_id) {//fetch project
		
			$sSQL = "SELECT pid,owner,active,title,start,end,class,resclass,type,plan,reswforward,hideusers,private,include,exclude,latitude,longitude from projects WHERE id=".$project_id;
			$result = $db->Execute($sSQL,2);
			//echo $sSQL;
		    $project_title = $result->fields['title'];
			$project_group = $result->fields['pid'] ? intval($result->fields['pid']) : 1;
			$start = $result->fields['start'];	
			$end = $result->fields['end'];
			$plan = $result->fields['plan'];
			$owner = $result->fields['owner'];
			$active = $result->fields['active'] ? 'checked="checked"' : null;
			$isprivate = $result->fields['private'] ? 'checked="checked"' : null;
			$hideusers = $result->fields['hideusers'] ? 'checked="checked"' : null;
			$resclass = $result->fields['resclass']? 'checked="checked"' : null;
			$class = $result->fields['class'];
			$forward = $result->fields['reswforward'];
			$type = $result->fields['type'];
			$include = $result->fields['include'];
			$exclude = $result->fields['exclude'];
			$latitude = $result->fields['latitude'] ? $result->fields['latitude'] : $ulatitude ;
			$longitude = $result->fields['longitude'] ? $result->fields['longitude'] : $ulongitude;
            $readonly = 'readonly';		

			$inv_js = "onclick='javascript: social_invitation(\"{$project_title}\",\"{$start} {$end}\",\"{$plan}\")'";	
		}
		else {
		    $project_title = null;//$newname;
			$project_group = 1;
			$start = date('Y-m-d');	
			$end = date('Y-m-d',mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"))); //+1 day
			$plan = null;
			$owner = decode($UserName);
			$active = 'checked="checked"';
			$isprivate = 'checked="checked"';
			$hideusers = 'checked="checked"';			
			$resclass = '1';
			$class = '1';
			$forward = '1';//1 week
			$type = 'daily';
			$include = GetReq('id');////null;
			$exclude = null;
			$latitude = $ulatitude;
			$longitude = $ulongitude;			
			$readonly = null;
			
			$inv_js = null;
		}
		
		//$social_inv_button = $this->social_invite_button($inv_js);
		
		if (defined('RESERVATIONS_DPC')) {
			$post_url = '.'; //js call from reservations
			$method = null;
		}	
		else {
			//$post_url = seturl("t=kshow&cat=".GetReq('cat').'&id='.GetReq('id'),null,null,null,null,true);
			$post_url = seturl("t=cpcrmshowgant&id=".GetReq('id'));//,null,null,null,null,true);
			$method = "method='post'";
		}	
		
		$pid = $project_id ? $project_id : '0';//new pid

        //weeks forward combo selector		
		$cweek = date('W');
		for($i=1;$i<=(52-$cweek);$i++)
			$weeks[$i] = $i;
		$weeks_forward = $this->make_combo('reswforward',$weeks,$forward,'set_project_combo','myf_select_small');
		//class combo selector
		$classes = array(0=>localize('_project',getlocal()),
		                 1=>localize('_important',getlocal()),
						 2=>localize('_urgent',getlocal()));
		$project_class = $this->make_combo('class',$classes,$class,'set_project_combo');		

        $form = <<<FORM

	
		    <div class="row-fluid">
                <div class="span12">
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> $project_title </h4>
							<span id="project_id_span">$pid</span>
                            <span class="tools">
                            <!--a href="javascript:;" class="icon-chevron-down"></a-->
                            <a href="javascript:acalclose();" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
						
						
	<table>
	<tr>
	<td>
	<form action="$post_url" $method id="project_details_form" autocomplete="off">	
	<label for="project_start" style='font-weight:bold'>{$start_label}:</label><br/>
	<input type="text" id="project_start" value="{$start}" {$readonly}><br/>		
	<label for="project_latitude" style='font-weight:bold'>{$latitude_label}:</label><br>
	<input type="text" id="project_latitude" value="{$latitude}"><br/>	
	<label for="project_name" style='font-weight:bold'>{$name_label}:</label><br/>
	<input type="text" id="project_name" value="{$project_title}"><br/>	
	<label for="project_owner" style='font-weight:bold'>{$owner_label}:</label><br/>
	<input type="text" id="project_owner" value="{$owner}"><br/>
	<label for="project_type" style='font-weight:bold'>{$type_label}:</label><br/>	
	<input type="text" id="project_type" value="{$type}"><br/>
	<label for="project_plan" style='font-weight:bold'>{$plan_label}:</label><br/>
	<input type="text" id="project_plan" value="{$plan}"><br/>	
	</td>
	<td>
	<label for="project_end" style='font-weight:bold'>{$end_label}:</label><br/>
	<input type="text" id="project_end" value="{$end}"><br/>
	<label for="project_longitude" style='font-weight:bold'>{$longitude_label}:</label><br>
	<input type="text" id="project_longitude" value="{$longitude}"><br/>		
	<label for="project_group" style='font-weight:bold'>{$group_label}:</label><br/>
	<input type="text" id="project_group" value="{$project_group}"><br/>	
	<label for="project_include" style='font-weight:bold'>{$include_label}:</label><br/>		
	<input type="text" id="project_include" value="{$include}"><br/>
	<label for="project_exclude" style='font-weight:bold'>{$exclude_label}:</label><br/>	
	<input type="text" id="project_exclude" value="{$exclude}"><br/>	
	<input type="hidden" name="FormAction" value="acalnew">
	<input type="hidden" name="project_id" id="project_id" value="{$project_id}">
	<input type="hidden" name="code_id" id="code_id" value="{$code_id}">	
	<!--input type="submit" class="btn" value="{$projectset}"-->
	<input type="button" class="btn" onclick='javascript: save_project_configuration()' value="{$projectset}">
	<input type="button" class="btn" onclick='javascript: acalclose()' value="{$close}">
	</form>
	<p id="project_details_message_p"></p>	
	</td>
	<td>
	{$active_label}:<br/>
	{$forward_label}:<br/>
	{$class_label}:<br/>
	{$resclass_label}:<br/>
    {$isprivate_label}:<br/>
	{$hideusers_label}:<br/>
	<hr/>
	{$invite_social_label}:<br/>
	</td>
	<td>
	<input type="checkbox" id="project_active" $active ><br/>
	{$weeks_forward}
	<!--input type="checkbox" id="project_forward" $forward--><br/>
	{$project_class}	
	<!--input type="checkbox" id="project_class" $class--><br/>
	<input type="checkbox" id="project_resclass" $resclass><br/>
	<input type="checkbox" id="project_private" $isprivate><br/>
	<input type="checkbox" id="project_hideusers" $hideusers><br/>
	<p id="project_details_checkbox_p"></p>
	<hr/>
	<input type="button" class="btn btn-small" $inv_js value="{$project_social_invite}">
	</td>	
	</tr>
	</table>							
						
                        </div>
                    </div>
                </div>
            </div>		
	

FORM;
		return ($form); 

	}
	
	protected function project_form($project_id=null) {
		
		
		return ($this->project_metroForm($project_id)); 
		
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		if (!$UserName) return false;
		
		$code_id = GetReq('id');
		
		//$this->get_friends();
		if (defined('XIXUSER_DPC')) { 
			$location = GetGlobal('controller')->calldpc_method('xixuser.get_user_location');
			$xy = explode(',',$location);
			$ulatitude = $xy[0];
			$ulongitude = $xy[1];
		}
        else {
			$ulatitude = 0;
			$ulongitude = 0;		
        }  
		//echo $ulatitude,'-',$ulongitude;		
		
		$name_label = localize('_pname' ,getlocal());
		$start_label = localize('_pstart' ,getlocal());
		$end_label = localize('_pend' ,getlocal());
		$newname = localize('_newproject',getlocal());
		$projectset = localize('_setproject',getlocal());
		$plan_label = localize('_planlabel',getlocal());	
		$forward_label = localize('_fwlabel',getlocal());
		$class_label = localize('_classlabel',getlocal());
		$resclass_label = localize('_resclasslabel',getlocal());
		$type_label = localize('_typelabel',getlocal());
		$isprivate_label = localize('_privlabel',getlocal());
		$hideusers_label = localize('_hideulabel',getlocal());
		$include_label = localize('_inclabel',getlocal());
		$exclude_label = localize('_exclabel',getlocal());
		$active_label = localize('_activelabel',getlocal());
		$owner_label = localize('_ownerlabel',getlocal());
		$group_label = localize('_grouplabel',getlocal());			
		$invite_social_label = localize('_invitelabel',getlocal());
		$project_social_invite = localize('_invitebutton',getlocal());
		$close = localize('close',getlocal());
		$latitude_label = localize('_latitude',getlocal());
		$longitude_label = localize('_longitude',getlocal());		
		
		if ($project_id) {//fetch project
		
			$sSQL = "SELECT pid,owner,active,title,start,end,class,resclass,type,plan,reswforward,hideusers,private,include,exclude,latitude,longitude from projects WHERE id=".$project_id;
			$result = $db->Execute($sSQL,2);
			//echo $sSQL;
		    $project_title = $result->fields['title'];
			$project_group = $result->fields['pid'] ? intval($result->fields['pid']) : 1;
			$start = $result->fields['start'];	
			$end = $result->fields['end'];
			$plan = $result->fields['plan'];
			$owner = $result->fields['owner'];
			$active = $result->fields['active'] ? 'checked="checked"' : null;
			$isprivate = $result->fields['private'] ? 'checked="checked"' : null;
			$hideusers = $result->fields['hideusers'] ? 'checked="checked"' : null;
			$resclass = $result->fields['resclass']? 'checked="checked"' : null;
			$class = $result->fields['class'];
			$forward = $result->fields['reswforward'];
			$type = $result->fields['type'];
			$include = $result->fields['include'];
			$exclude = $result->fields['exclude'];
			$latitude = $result->fields['latitude'] ? $result->fields['latitude'] : $ulatitude ;
			$longitude = $result->fields['longitude'] ? $result->fields['longitude'] : $ulongitude;
            $readonly = 'readonly';		

			$inv_js = "onclick='javascript: social_invitation(\"{$project_title}\",\"{$start} {$end}\",\"{$plan}\")'";	
		}
		else {
		    $project_title = null;//$newname;
			$project_group = 1;
			$start = date('Y-m-d');	
			$end = date('Y-m-d',mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"))); //+1 day
			$plan = null;
			$owner = decode($UserName);
			$active = 'checked="checked"';
			$isprivate = 'checked="checked"';
			$hideusers = 'checked="checked"';			
			$resclass = '1';
			$class = '1';
			$forward = '1';//1 week
			$type = 'daily';
			$include = GetReq('id');////null;
			$exclude = null;
			$latitude = $ulatitude;
			$longitude = $ulongitude;			
			$readonly = null;
			
			$inv_js = null;
		}
		
		//$social_inv_button = $this->social_invite_button($inv_js);
		
		if (defined('RESERVATIONS_DPC')) {
			$post_url = '.'; //js call from reservations
			$method = null;
		}	
		else {
			//$post_url = seturl("t=kshow&cat=".GetReq('cat').'&id='.GetReq('id'),null,null,null,null,true);
			$post_url = seturl("t=cpcrmshowgant&id=".GetReq('id'));//,null,null,null,null,true);
			$method = "method='post'";
		}	
		
		$pid = $project_id ? $project_id : '0';//new pid

        //weeks forward combo selector		
		$cweek = date('W');
		for($i=1;$i<=(52-$cweek);$i++)
			$weeks[$i] = $i;
		$weeks_forward = $this->make_combo('reswforward',$weeks,$forward,'set_project_combo','myf_select_small');
		//class combo selector
		$classes = array(0=>localize('_project',getlocal()),
		                 1=>localize('_important',getlocal()),
						 2=>localize('_urgent',getlocal()));
		$project_class = $this->make_combo('class',$classes,$class,'set_project_combo');

        $form = <<<FORM
	<div class="navigation">
	<div class="title" >
	<!--label for="project_id">ID:</label-->
	<span id="project_id_span">$pid</span>
	<label id="project_title" for="project_title">$project_title</label>
	</div>
	</div>
	<table>
	<tr>
	<td>
	<form action="$post_url" $method id="project_details_form" autocomplete="off">	
	<label for="project_start" style='font-weight:bold'>{$start_label}:</label><br/>
	<input type="text" id="project_start" value="{$start}" {$readonly}><br/>		
	<label for="project_latitude" style='font-weight:bold'>{$latitude_label}:</label><br>
	<input type="text" id="project_latitude" value="{$latitude}"><br/>	
	<label for="project_name" style='font-weight:bold'>{$name_label}:</label><br/>
	<input type="text" id="project_name" value="{$project_title}"><br/>	
	<label for="project_owner" style='font-weight:bold'>{$owner_label}:</label><br/>
	<input type="text" id="project_owner" value="{$owner}"><br/>
	<label for="project_type" style='font-weight:bold'>{$type_label}:</label><br/>	
	<input type="text" id="project_type" value="{$type}"><br/>
	<label for="project_plan" style='font-weight:bold'>{$plan_label}:</label><br/>
	<input type="text" id="project_plan" value="{$plan}"><br/>	
	</td>
	<td>
	<label for="project_end" style='font-weight:bold'>{$end_label}:</label><br/>
	<input type="text" id="project_end" value="{$end}"><br/>
	<label for="project_longitude" style='font-weight:bold'>{$longitude_label}:</label><br>
	<input type="text" id="project_longitude" value="{$longitude}"><br/>		
	<label for="project_group" style='font-weight:bold'>{$group_label}:</label><br/>
	<input type="text" id="project_group" value="{$project_group}"><br/>	
	<label for="project_include" style='font-weight:bold'>{$include_label}:</label><br/>		
	<input type="text" id="project_include" value="{$include}"><br/>
	<label for="project_exclude" style='font-weight:bold'>{$exclude_label}:</label><br/>	
	<input type="text" id="project_exclude" value="{$exclude}"><br/>	
	<input type="hidden" name="FormAction" value="acalnew">
	<input type="hidden" name="project_id" id="project_id" value="{$project_id}">	
	<input type="hidden" name="code_id" id="code_id" value="{$code_id}">
	<!--input type="submit" class="btn" value="{$projectset}"-->
	<input type="button" class="btn" onclick='javascript: save_project_configuration()' value="{$projectset}">
	<input type="button" class="btn" onclick='javascript: acalclose()' value="{$close}">
	</form>
	<p id="project_details_message_p"></p>	
	</td>
	<td>
	{$active_label}:<br/>
	{$forward_label}:<br/>
	{$class_label}:<br/>
	{$resclass_label}:<br/>
    {$isprivate_label}:<br/>
	{$hideusers_label}:<br/>
	<hr/>
	{$invite_social_label}:<br/>
	</td>
	<td>
	<input type="checkbox" id="project_active" $active ><br/>
	{$weeks_forward}
	<!--input type="checkbox" id="project_forward" $forward--><br/>
	{$project_class}	
	<!--input type="checkbox" id="project_class" $class--><br/>
	<input type="checkbox" id="project_resclass" $resclass><br/>
	<input type="checkbox" id="project_private" $isprivate><br/>
	<input type="checkbox" id="project_hideusers" $hideusers><br/>
	<p id="project_details_checkbox_p"></p>
	<hr/>
	<input type="button" class="btn btn-small" $inv_js value="{$project_social_invite}">
	</td>	
	</tr>
	</table>	
FORM;
		return ($form);
	}
	
	protected function get_friends() {
	
	    //google
		if ($gtoken = GetSessionParam('gtoken')) {	
		
			$gclient = new Google_Client();
			$gclient->setApplicationName('Google Contacts Sample');
			$gclient->setScopes("https://www.google.com/m8/feeds/");			
			$gclient->setClientId('111972355706-5i4gdd3d8ci401rp2umro3itonorg6tq.apps.googleusercontent.com');
			$gclient->setClientSecret('axlYm5fpYspb3TW_zckzNNtd');
			$gclient->setRedirectUri('http://www.xix.gr/oauth2callback');
			$gclient->setDeveloperKey('AIzaSyDgNfkKVLswLHyY4tpCT7oJQjIBDVLpoYs');	
						
			if  (!is_object($gclient)) 
				return false;

			$req = new Google_HttpRequest("https://www.google.com/m8/feeds/contacts/default/full");
			$val = $gclient->getIo()->authenticatedRequest($req);

			// The contacts api only returns XML responses.
			$response = json_encode(simplexml_load_string($val->getResponseBody()));
			print "<pre>" . print_r(json_decode($response, true), true) . "</pre>";

			// The access token may have been updated lazily.
			//$_SESSION['token'] = $client->getAccessToken();				
		
		}
		//echo 'z';
	}
	
	//save project..handled by reservations dpc...
	protected function create_new_project() {
		echo 'new';
	}
	
	//for cart
	protected function is_code_in_projects($id, $date=null) {
	    $db = GetGlobal('db');
		$code = $id ? $id : (GetReq('id') ? GetReq('id') : null);
		if (!$code) return false;
		$date = $date ? $date : date('Y-m-d');
        $ret = false;
		
		$sSQL = 'select id,title,start,end from projects where active=1';
		$sSQL .= " and code='". $code . "'";
		//$sSQL .= " and start<= date '$date' and end> date '$date'";		
		$sSQL .= " and end> date '$date'";		

		//echo $sSQL,'<br/><br/>';
		$result = $db->Execute($sSQL,2);

		foreach ($result as $r=>$rec) {
			$ret[] = array('id'=>$rec['id'],'title'=>$rec['title']);
		}
        //return projects id / code - item
		//return (!empty($ret) ? implode(',',$ret) : false);
		//print_r($ret);
		return ($ret);
	}
	
	public function calendar_item_button($code=null) {
	  $UserName = GetGlobal('UserName');
	  if ((!$UserName)||(!$code)) return false;
	  
	  $prj = $this->is_code_in_projects($code);
	  //print_r($prj);
	  
	  if (!empty($prj)) {
		
		if (count($prj)==1) { //one project button
			$mydate = time();//$block['start']; //is timestamp
			$pid = $prj[0]['id'];//$block['project'];
			$ptitle = $prj[0]['title'];//localize('_ADDCARTITEM',getlocal());//$block['ptitle'];
			$button = $this->get_href($mydate,$ptitle,null,$pid,$ptitle,$code);		
		}	
		else {//many projects ..select option
		
		    $projects_label = localize('CRMACAL_DPC', getlocal());
            $mydate = time();	

			$close_url = seturl('t=acalclose');
			$projects[$close_url] = "--{$projects_label}--";
			foreach ($prj as $p=>$proj) {
				$pid = $proj['id'];
				$ptitle = $proj['title'];
				$action = $this->get_href($mydate,null,null,$pid,$ptitle,$code,true);
				$projects[$action] = $ptitle;
            }
			$combo = $this->make_combo('select_projects_to_'.$code,$projects,null,'acal_load');			
			return ($combo);
		}
		
        return ($button);		
	  }	
	  
	  return false;
	}	
	
	protected function is_user_in_project($project_id, $id=null, $date=null, $force_date=null, $isdescr=false) {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		$code = $id ? $id : (GetReq('id') ? GetReq('id') : null);		
		if ((!$UserName) || (!$code) || (!$project_id)) return false;		
		
		$user = decode($UserName);

		//$date = date('Y-m-d');
		$timestamp = $date ? strtotime($date) : time();
		$week  = (int)date('W', $timestamp);
		$day = (int)date('N', $timestamp);
		$year = (int)date('Y', $timestamp);		
		//$year = date('Y');//$this->global_year;
		if ($force_date) {
		    //date range to check in future...
			$timestamp_force = $force_date ? strtotime($force_date) : time();
			$week_force  = (int)date('W', $timestamp_force);
			$day_force = (int)date('N', $timestamp_force);
			$year_force = (int)date('Y', $timestamp_force);		  
		}
		
		if ($isdescr) { //return details
			$query = "SELECT id,rdate,ryear,rweek,rday,rtime FROM reservations WHERE ";
			$query .= "ryear='$year' AND rweek>='$week'";//AND rday='$day'";//AND rtime='$time'
			$query .= " AND project_id=" . $project_id . " AND active=1";
			$query .= " AND code='$code' AND ruser_id='{$user}'";
			$query .= " AND invoiced=0";

			$result = $db->Execute($query,2);
			//echo $query;
			if (!empty($result)) {
			  foreach ($result as $r=>$rec) { 
			    $id = $rec['id'];
				$y = $rec['ryear'];
				$w = $rec['rweek'];
				$d = $rec['rday'];
				$ww = sprintf('%02d',$w);
				$resdate = date('d-m-Y', strtotime("{$y}W{$ww}{$d}"));
		
				$ret[$id] .= $resdate . ',' . $rec['rtime'];		
			  }		  
			}
            else
				$ret = false;	
		}
		else { //return sum of reservations
			$query = "SELECT count(id) FROM reservations WHERE ";
			$query .= "ryear='$year' AND rweek>='$week'";//AND rday='$day'";//AND rtime='$time'
			$query .= " AND project_id=" . $project_id . " AND active=1";
			$query .= " AND code='$code' AND ruser_id='{$user}'";
			$query .= " AND invoiced=0";
			$result = $db->Execute($query,2);
			//echo $query;
		
			$ret = $result->fields[0] ? $result->fields[0] : 0;
		}	
		return ($ret);
	}	
	
	public function get_user_reservations($code=null, $qty=1) {
	    $UserName = GetGlobal('UserName');
	    //if ((!$UserName)||(!$code)) return false; 
	
	    $in = 0;
		$prj = $this->is_code_in_projects($code);
		
        if (!empty($prj)) {		
			foreach ($prj as $p=>$proj) {
				$pid = $proj['id'];
				$ptitle = $proj['title'];
				
				$inp = $this->is_user_in_project($pid,$code);
				$in += $inp;
			}
			return (($in>=$qty) ? $in : 0);
		}
		return ($qty); //qty if not in projects
	}
	
	public function get_user_reservations_description($code=null) {
	    $UserName = GetGlobal('UserName');
	    //if ((!$UserName)||(!$code)) return false; 
	
	    $in = 0;
		$prj = $this->is_code_in_projects($code);
		
        if (!empty($prj)) {		
			foreach ($prj as $p=>$proj) {
				$pid = $proj['id'];
                
				//if ($descr = $this->is_user_in_project($pid,$code,null,null,true))
					//$ret .= '<br/>' . $proj['title'] . ' (' . $descr .')';
					
				$d = $this->is_user_in_project($pid,$code,null,null,true);	
				if (!empty($d)) {
				    foreach ($d as $r=>$descr)   
						$ret[$r] = $proj['title'] . ' (' . $descr .')';
					return (array) $ret;	
				}	
			}
			//return $ret;
		}
		return (false); 
	}	
	
	protected function remove_user_from_project($project_id, $id=null, $date=null, $force_date=null) {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		$code = $id ? $id : (GetReq('id') ? GetReq('id') : null);		
		if ((!$UserName) || (!$code) || (!$project_id)) return false;		
		
		$user = decode($UserName);

		//$date = date('Y-m-d');
		$timestamp = $date ? strtotime($date) : time();
		$week  = (int)date('W', $timestamp);
		$day = (int)date('N', $timestamp);
		$year = (int)date('Y', $timestamp);		
		//$year = date('Y');//$this->global_year;
		if ($force_date) {
		    //date range to check in future...
			$timestamp_force = $force_date ? strtotime($force_date) : time();
			$week_force  = (int)date('W', $timestamp_force);
			$day_force = (int)date('N', $timestamp_force);
			$year_force = (int)date('Y', $timestamp_force);		  
		}
		
		$query = "SELECT id FROM reservations WHERE ";
		$query .= "ryear='$year' AND rweek>='$week'";//AND rday='$day'";//AND rtime='$time'
		$query .= " AND project_id=" . $project_id . " AND active=1";
		$query .= " AND code='$code' AND ruser_id='{$user}'";
		$query .= " AND invoiced=0";
		$result = $db->Execute($query,2);
		//echo $query;
		
		//do delete
		foreach ($result as $i=>$rec) {
		
			$query = "UPDATE reservations SET active=0,deleted=1 WHERE ryear='$year' AND id=".$rec['id'];
			$query.= " AND project_id=".$project_id;
			$query.= " AND code='{$code}' AND ruser_id='{$user}'";
			$result = $db->Execute($query,1);			
		}
		
		return true;
	}		
	
	public function remove_user_reservations($code=null) {
	    $UserName = GetGlobal('UserName');
	    //if ((!$UserName)||(!$code)) return false; 
	
		$prj = $this->is_code_in_projects($code);
		
        if (!empty($prj)) {		
			foreach ($prj as $p=>$proj) {
				$pid = $proj['id'];
				$ptitle = $proj['title'];
				
				$inp = $this->remove_user_from_project($pid,$code);
			}
			return (($inp) ? true : false);
		}
		return 1; //true default if not in projects
	}	
	
	protected function invoice_user_from_project($project_id, $id=null, $date=null, $force_date=null, $trid=null) {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		$code = $id ? $id : (GetReq('id') ? GetReq('id') : null);		
		if ((!$UserName) || (!$code) || (!$project_id)) return false;		
		
		$user = decode($UserName);
		$transaction_id = $trid ? $trid : $user;

		//$date = date('Y-m-d');
		$timestamp = $date ? strtotime($date) : time();
		$week  = (int)date('W', $timestamp);
		$day = (int)date('N', $timestamp);
		$year = (int)date('Y', $timestamp);		
		//$year = date('Y');//$this->global_year;
		if ($force_date) {
		    //date range to check in future...
			$timestamp_force = $force_date ? strtotime($force_date) : time();
			$week_force  = (int)date('W', $timestamp_force);
			$day_force = (int)date('N', $timestamp_force);
			$year_force = (int)date('Y', $timestamp_force);		  
		}
		
		$query = "SELECT id FROM reservations WHERE ";
		$query .= "ryear='$year' AND rweek>='$week'";//AND rday='$day'";//AND rtime='$time'
		$query .= " AND project_id=" . $project_id . " AND active=1";
		$query .= " AND code='$code' AND ruser_id='{$user}'";
		$result = $db->Execute($query,2);
		//echo $query;
		
		//do invoicing
		foreach ($result as $i=>$rec) {
		
			$query = "UPDATE reservations SET invoiced=1,trid='{$transaction_id}' WHERE ryear='$year' AND id=".$rec['id'];
			$query.= " AND project_id=".$project_id;
			$query.= " AND code='{$code}' AND ruser_id='{$user}'";
			$query .= " AND invoiced=0";
			$result = $db->Execute($query,1);			
		}
		
		return true;
	}		
	
	public function invoice_user_reservations($code=null, $trid=null) {
	    $UserName = GetGlobal('UserName');
	    //if ((!$UserName)||(!$code)) return false; 
	
		$prj = $this->is_code_in_projects($code);
		
        if (!empty($prj)) {		
			foreach ($prj as $p=>$proj) {
				$pid = $proj['id'];
				$ptitle = $proj['title'];
				
				$inp = $this->invoice_user_from_project($pid,$code,null,null,$trid);
			}
			return (($inp) ? true : false);
		}
		return 1; //true default if not in projects
	}	
	
	protected function set_project_combo() {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		if (!$UserName) return false;	
		$name = GetParam('cname');
		$value = GetParam('cvalue') ? GetParam('cvalue') : '0';
		$project_id = GetParam('project_id');
		if ((!$project_id)||(!$name)) return false;
		
		$upddate = date('Y-m-d');
		$query = "UPDATE projects SET {$name}={$value} WHERE id='{$project_id}'";	
		$result = $db->Execute($query,1);		
		//echo $query;
		
		return(1);		
	}

	protected function make_combo($name=null, $choices=null, $selection=null,$callback=false, $class=null) {
		if ((empty($choices))||(!$name)) return false;
		$class = $class ? $class : 'myf_select';
		
		$combo = "<select name=\"{$name}\" id=\"{$name}\" class=\"$class\"";
		$combo.=($callback) ? " onChange=\"$callback(this.options[this.selectedIndex].value,'{$name}'); return false;\">" : ">"; 
			
        foreach ($choices as $c=>$chname) {

			$combo.= "<option value='$c' ".($c == $selection ? " selected" : "").">$chname</option>";
        }
        $combo.= "</select>"; 		
		
		return ($combo);
	}	
	
	//finalize cart add reservations (+)
	public function finalize($code=null, $trid=null, $price=null, $qty=1) {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		if ((!$UserName) || (!$code) || (!$trid)) return false;		
		$user = decode($UserName);
		$week  = (int)date('W', time());
		$day = (int)date('N', time());
		$year = (int)date('Y', time());		
		$affected = 0;
		
		$prj = $this->is_code_in_projects($code);

        if (!empty($prj)) {		
			foreach ($prj as $p=>$proj) {
				$pid = $proj['id'];
				$ptitle = $proj['title'];
			
				$query = "SELECT p.owner,p.title,r.id,r.ryear,r.rweek,r.rday,r.rtime,r.rprice FROM reservations r";
				$query .= " INNER JOIN projects p ON p.id=r.project_id WHERE";
				$query .= " r.ryear='$year' AND r.rweek>='$week'";
				$query .= " AND r.project_id=" . $pid . " AND r.active=1";
				$query .= " AND r.code='$code' AND r.ruser_id='{$user}'";
				$query .= " AND r.invoiced=1 AND r.trid='{$trid}'";
				$result = $db->Execute($query,2);
				//echo $query;

				if (!empty($result)) {
			    
				  foreach ($result as $r=>$rec) {
				
					$y = $rec['ryear'];
					$w = sprintf('%02d',$rec['rweek']);
					$d = $rec['rday'];
					$sdate = date('d-m-Y', strtotime("{$y}W{$w}{$d}"));
					
					if (defined('XIXUSER_DPC')) {
						$location= GetGlobal('controller')->calldpc_method('xixuser.get_user_location use '.$rec['owner']);
						$xy = explode(',',$location);
						$latitude = $xy[0];
						$longitude = $xy[1];						
					}
					else {
						$latitude = 0;
						$longitude = 0;
					}					

					$query = "INSERT INTO trdata SET isreservation=1,pid=$pid,";
					$query.= "code='".$code ."',";
					$query.= "weight=0,";
					$query.= "volume=0,";
					$query.= "latitude={$latitude},";
					$query.= "longitude={$longitude},";						
					$query.= "owner='".$rec['owner']."',";
					
					$name = $rec['title'] .' '. $sdate . ' '. $rec['rtime']; 					
					$query.= "name='" .$name."',";					
					
					//when the reservation has price, put the price +
					$p_price = /*($price<0) ? ($rec['rprice']*-1) :*/ $rec['rprice'];
					$query.= "value=" .$p_price.",";			
			
					$query.= "qty=".$qty.",";
					$query.= "cid='".$user."',";			
					$query.= "tid='".$trid."'";					
					
					$insert = $db->Execute($query,1);
					$affected += $db->Affected_Rows();
                    //echo $query,'<br/><br/>';					
				  }
				}				
			}
			return (($affected) ? true : false);
		}		
	
		return false;	
	}

};
}
?>