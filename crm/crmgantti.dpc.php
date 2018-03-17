<?php
/*  <!-- gantti -->
  <!--link rel="stylesheet" href="css/gantti/css/screen.css" /-->
  <link rel="stylesheet" href="css/gantti/css/gantti.css" />
  <!--[if lt IE 9]>
  <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->*/
$d = GetGlobal('controller')->require_dpc('crm/crmgantti.lib.php');
require_once($d); 

	   
$__DPCSEC['CRMGANTTI_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if (!defined("CRMGANTTI_DPC")) {
define("CRMGANTTI_DPC",true);

$__DPC['CRMGANTTI_DPC'] = 'crmgantti';

$__EVENTS['CRMGANTTI_DPC'][0]= "crmgantti";
$__EVENTS['CRMGANTTI_DPC'][1]= "getprojectdetails";
$__EVENTS['CRMGANTTI_DPC'][2]= "getprojectlocation";
$__EVENTS['CRMGANTTI_DPC'][3]= "show_gantti";

$__ACTIONS['CRMGANTTI_DPC'][0]= "crmgantti";
$__ACTIONS['CRMGANTTI_DPC'][1]= "getprojectdetails";
$__ACTIONS['CRMGANTTI_DPC'][2]= "getprojectlocation";
$__ACTIONS['CRMGANTTI_DPC'][3]= "show_gantti";

$__LOCALE['CRMGANTTI_DPC'][0]='CRMGANTTI_DPC;Gantt chart;Χρονοδιάγραμμα';
$__LOCALE['CRMGANTTI_DPC'][1]='January;January;Ιανουάριος';
$__LOCALE['CRMGANTTI_DPC'][2]='February;February;Φεβρουάριος';
$__LOCALE['CRMGANTTI_DPC'][3]='March;March;Μάρτιος';
$__LOCALE['CRMGANTTI_DPC'][4]='April;April;Απρίλιος';
$__LOCALE['CRMGANTTI_DPC'][5]='May;May;Μαίος';
$__LOCALE['CRMGANTTI_DPC'][6]='June;June;Ιούνιος';
$__LOCALE['CRMGANTTI_DPC'][7]='July;July;Ιούλιος';
$__LOCALE['CRMGANTTI_DPC'][8]='August;August;Αύγουστος';
$__LOCALE['CRMGANTTI_DPC'][9]='September;September;Σεπτέμβριος';
$__LOCALE['CRMGANTTI_DPC'][10]='October;October;Οκτώβριος';
$__LOCALE['CRMGANTTI_DPC'][11]='November;November;Νοέμβριος';
$__LOCALE['CRMGANTTI_DPC'][12]='December;December;Δεκέμβριος';
$__LOCALE['CRMGANTTI_DPC'][13]='_newsubproject;New;Νέο';

class crmgantti { 

    var $title, $cellwidth, $cellheight, $today;
	var $data, $global_times;

	function __construct($title=null, $cellwidth=25, $cellheight=35, $today=true) {
	
	    $this->title = $title ? $title : 'Demo';
		$this->cellwidth = $cellwidth;
		$this->cellheight = $cellheight;
		$this->today = $today;
		
		$this->data = array();
		
		// Possible reservation times. Use the same syntax as below (TimeFrom-TimeTo)
		$this->global_times = array('09-10', '10-11', '11-12', '12-13', '13-14', '14-15', '15-16', '16-17', '17-18', '18-19', '19-20', '20-21');

	    //$this->javascript(); //call by host script at event
	}
	
    function event($event) {

	  switch ($event) {
	    
		case 'show_gantti'       : die($this->show_gantti()); break;		  
	    case 'getprojectlocation': die($this->get_project_location()); break;		  
	    case 'getprojectdetails' : die($this->get_project_details()); break;
		default : break;
	  }
    }	  
	
	
    function action($action) {

	  switch ($action) {
	  	  
		case 'show_gantti'       : break;  
	    case 'getprojectlocation': break;
	    case 'getprojectdetails' : break;	
		default : $out = null;
	  }	
	  return ($out);
	}	
	
	public function javascript() {
		$UserName = GetGlobal('UserName');
		if (!$UserName) return false;

        if (iniload('JAVASCRIPT')) {
	   	
		    $js = new jscript;	
			$code = $this->javascript_code();
			$js->load_css('javascripts/mgantti/css/gantti.css');
			$js->load_js($code,null,1);		
		    unset ($js);
	    }	
	}	
	
	public function javascript_code() {
	
	    $ajaxurl = seturl('t=');
	
		$cj = <<<JS
		
function showDirections(lat, lon, divmap, drive, iproject, divdir) {
  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;
  
  directionsDisplay = new google.maps.DirectionsRenderer(); 
  
  var drive = parseInt(drive);
  mydrive = drive ? drive : 0;  
  var iproject = parseInt(iproject);
  myproject = iproject ? iproject : 0;   
  var divdir = divdir ? divdir : 'phoca_dir';	 

  lat= lat ? lat : document.getElementById('user_latitude_input').value;
  lon= lon ? lon : document.getElementById('user_longitude_input').value;
  start=new google.maps.LatLng(lat, lon);
  
  var divmap = divmap ? divmap : 'mapholder';
  mapholder=document.getElementById(divmap);
  mapholder.style.height='250px';
  mapholder.style.width='100%';   

  var myOptions={
	center:start,zoom:14,
	mapTypeId:google.maps.MapTypeId.ROADMAP,
	mapTypeControl:false,
	navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
  };
  var map=new google.maps.Map(document.getElementById(divmap),myOptions);
  var marker=new google.maps.Marker({position:start,map:map,title:"You are here!"});
      
  directionsDisplay.setMap(map);
  directionsDisplay.setPanel(document.getElementById(divdir));
  
  if ((mydrive > 0) && (iproject)) {
		   
    document.getElementById(divdir).innerHTML = '';
		
	$.get('{$ajaxurl}getprojectlocation&iproject='+iproject, function(data)
    {
	    //alert(data);
		var array = data.split(',');
		var end = new google.maps.LatLng(array[0],array[1]);
		//alert(array[0]+'x'+array[1]);
		//var end = new google.maps.LatLng(41.3333,22.3333);
		
		var request = {
			origin:start,
			destination:end,
			travelMode: google.maps.TravelMode.DRIVING
		};
		directionsService.route(request, function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
			}
		});			
    });	
  }	
  else
	document.getElementById(divdir).innerHTML = '';	
} 		
		
function cart_load_project(code)
{	
    $.get('{$ajaxurl}getprojectdetails&project_id='+code, function(data) { location='addcart/'+data+'/0/1/'; });
};	

$(document).ready( function()
{
	// Buttons
	//$(document).on('submit', '#project_details_form', function() { save_project_configuration(); return false; });

});		
JS;
		
		return ($cj);
	}	
	
	public function get_project_location($project_id=null) {
		$db = GetGlobal('db');
		$iproject = $project_id ? $project_id : GetReq('iproject');
	    $UserName = GetGlobal('UserName');
		if ((!$UserName)||(!$iproject)) return false;
		
		//select project lat,long
		$query = "SELECT latitude,longitude from projects WHERE id='{$iproject}'";
		$result = $db->Execute($query,2);
        if ($result) {
		
			$ret = $result->fields['latitude'].','.$result->fields['longitude'];	
			return ($ret); //lon,lat 		
        }

		return false;
	}		
	
	protected function get_project_details() {
	    $db = GetGlobal('db');
		$UserName = GetGlobal('UserName');
		$project_id = GetReq('project_id');
		if ((!$UserName) || (!$project_id)) return false;	

		$user = decode($UserName); 
		$sum_price = 0;
		$sum_qty = 0;			
		$res_details = array();	
		$day = date('N');
		$week = date('W');
		$year = date('Y');		
				
		if (defined('RESERVATIONS_DPC')) {
		
			$sSQL = 'select r.id AS rid,p.id,p.title,r.project_id,r.ryear,r.rweek,r.rday,r.rtime,r.rprice from reservations r';
			$sSQL .= " INNER JOIN projects p ON p.id = r.project_id"; 		
			$sSQL .= " WHERE p.active=1 AND p.id={$project_id}";
			$sSQL .= " AND r.ruser_id='{$user}' AND r.active=1";
			$sSQL .= " AND r.ryear={$year} AND r.rweek<={$week} AND r.rday<'{$day}'";			
			$sSQL .= " AND r.invoiced=0 ";//AND r.oapprove=1 "; //test
			//echo $sSQL;	
			$result = $db->Execute($sSQL,2);		

			foreach ($result as $r=>$rec) {
			    $rid = $rec['rid'];//reservaion id
				$pid = $rec['id']; //project_id
			    $y = $rec['ryear'];
				$w = sprintf('%02d',$rec['rweek']);
				$d = $rec['rday'];
				$rtime = $rec['rtime'];
				$sdate = date('d-m-Y', strtotime("{$y}W{$w}{$d}"));
				$rprice = $rec['rprice'] ? $rec['rprice'] : 0;
							
				$reservations = $rec['title'] . ' ' . $sdate . ' '. $rec['rtime']; 
				$reservations .= ($rprice) ?  ' ' . $rprice : null;
				//$reservations .= '<br/>';
				$res_details[$rid] = $reservations;
				
				$sum_price += $rprice;
				$sum_qty += 1;
				
                //save add2cart res details
                $this->addtocart($pid,$res_details);				
			}
            //echo $reservations;			
		}
		/*else {*/
		
			if (defined('SHKATALOGMEDIA_DPC')) {		
				$lan = getlocal();
				$itmname = $lan?'itmname':'itmfname';
				$itmdescr = $lan?'itmdescr':'itmfdescr';
			
				$icode = GetGlobal('controller')->calldpc_method('shkatalogmedia.getmapf use code');			
				$sSQL = "SELECT i.{$itmname},p.id,p.code,p.cat,p.owner,p.start,p.end,p.title FROM projects p";			
				$sSQL .= " INNER JOIN products i ON p.code=i.{$icode}";
				$sSQL .= " WHERE p.active=1 AND p.id={$project_id}";
				//echo $sSQL;
			}
			else {	
			    $itmname = null; //dummy
			    $sSQL = "SELECT id,code,cat,owner,start,end,title FROM projects WHERE";
				$sSQL .= " active=1 AND id={$project_id}";
			}	
			$result = $db->Execute($sSQL,2);	
			
			$item = ($itmname) ? $result->fields[$itmname].'<br>' : null;
			$title = $item .
			         $result->fields['title'] . ' ' .
			         date('d-m-Y',strtotime($result->fields['start'])) . ' ' .
					 date('d-m-Y',strtotime($result->fields['end']));
			$title .= (!empty($res_details)) ? '<br>' . implode('<br>',$res_details) : null;//details					 
			
			//save project id to title			
			$str = $result->fields['code'] . ';'; //code
			
			$str.= $project_id . '-' .$title . ';;'; //title-pid / null
			$str.= ';';//$result->fields['DB_NAME'] . ';';//dbname 
			/*for ($i=0;$i<5;$i++) 
				$category .= ($i>0) ? '^'.$result->fields['cat'.$i] : 
									$result->fields['cat0'];*/
			$str.= $result->fields['cat'] . ';0;;';//category / page/ descr
			//$str.= (!empty($res_details)) ? implode(',',$res_details) : ';';//details
			$str.= $result->fields['code']  . ';';//code 
			
			$sprice = ($sum_price) ? ($sum_price*-1) : 0; //-1 
			$str.= $sprice . ';';//price / null
			$sqty = $sum_qty ? $sum_qty : '0';
			$str.= $sqty . ';';//qty / null			
		//}
				
		return ($str);
	}
	
	//get project selected data
	public function get_project($project_id, $retfields=null) {
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
	
    public function is_project_full($project_id=null) {
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
	
	//check for private project allowed users
	protected function is_allowed_user($owner=null,$include=null,$exclude=null) {
		$UserName = GetGlobal('UserName');
		if (!$UserName) return false;
		$user = decode($UserName);
		
		//owner always is valid user
	    if ($owner==$user) 
			return true;
		
        //exclusions list
		$exc = @explode(';',$exclude);		
		//print_r($exc);	
		$e = (in_array($user,$exc)) ? true : false;	
			
		
		//inclusions list	 
		$inc = @explode(';',$include);	
		//print_r($inc);
			
		//$z = in_array($user,$inc);
		//echo $user,'>',$z;
	
		return ($e ? false : (in_array($user,$inc)));		

    }
	
	protected function get_data() {
	    $db = GetGlobal('db');
		$id = GetReq('id') ? GetReq('id') : GetReq('cat');
		
		$sSQL = 'select id,pid,owner,title,code,start,end,class,resclass,private,include,exclude from projects WHERE';	
		$sSQL .= " code='". $id . "'";
		if (!$this->is_super_owner())
			$sSQL .= ' AND active=1';		
		$sSQL .= " order by start DESC";// group by pid";
		//echo $sSQL;
		$result = $db->Execute($sSQL,2);		
 
	    foreach ($result as $p=>$prj) {
		
		    //is private project..dont show
			$isprivate = ($prj['private']>0) ? true : false;
			$allowed = $this->is_allowed_user($prj['owner'],$prj['include'],$prj['exclude']);
		    if (($isprivate) && (!$allowed))
				continue;
		
		    switch ($prj['class']) {
			    case  2 : $class = 'urgent'; break;
			    case  1 : $class = 'important'; break;
			    case  0 :
				default : $class = null; 
			}
		
			$this->data[] = array(
						'label' => $prj['title'],
						'start' => $prj['start'], 
						'end'   => $prj['end'],
						'class' => $class,
						'link'  => 'javascript:void(0)', //add link 
						'project'  => $prj['id'],//project id
						'project_title'  => $prj['title'],//project title
						'group'=>$prj['pid'],
						'owner'=>$prj['owner'],//sub owner
						'code'=>$prj['code'],//prj code (GetReq(id) used in this case)
					);			
        }	
        //print_r($this->data);
        return (!empty($this->data) ? true : false);		
	}
	
	public function render($title=null, $cellwidth=25, $cellheight=35, $today=true) {
		$UserName = GetGlobal('UserName');
		if (!$UserName) return false;	
		
		$id = GetReq('id');// ? GetReq('id') : GetReq('cat');
		//echo $id;
				
		$cellwidth = $cellwidth ? $cellwidth : $this->cellwidth;
		$cellheight = $cellheight ? $cellheight : $this->cellheight;
		$today = $today ? true : $this->today;
		/*if ($id) {
			$title = strstr($id,':') ? 
			         array_shift(explode(':',$id)) : 
			         (strstr($id,'@') ? array_pop(explode('@',$id)) : $id);
		}	
		else*/	
			$title = $title ? $title : $this->title;
			
	    $is_owner = $this->is_super_owner(); //return true
	
	    if ($this->get_data()) {
			
			$ret = GetGlobal('controller')->calldpc_method('crmacal.render use +1'); //hidden div
			
			$ret .= new Gantti($this->data, array(
						'title'      => $title,
						'cellwidth'  => $cellwidth,
						'cellheight' => $cellheight,
						'today'      => $today
						),	$is_owner);	
							
			return ($ret);
        }
		elseif ($is_owner) {
		    //start new project button
            $newp_label = null;//localize('_newsubproject',getlocal());			
			
			if (defined('CRMACAL_DPC'))  {
				$mydate = time(); //is now timestamp
				$project = null;//id
				$ptitle = null;//title
				$href = '#';
				//$jsref = GetGlobal('controller')->calldpc_method("crmacal.get_href use $mydate");//+$days++".$project.'+'.$ptitle);//+1 for date format Y-m-d,+project id,title 
				//$ret = "<a class='btn btn-small' href='$href' $jsref><i class='icon-bolt'></i>$newp_label</a>";
				
				$ret = GetGlobal('controller')->calldpc_method('crmacal.render'); //show div
			}
			else { 
				$href = 'javascript: void(0)';	  	 
				$ret = "<a class='btn btn-small' href='$href' $jsref><i class='icon-bolt'></i>$newp_label</a>";
			}	
			return ($ret);
		}	
		
		return false;		
	}
	
	//render alias ajax call
	public function show_gantti($title=null, $cellwidth=25, $cellheight=35, $today=true) {
		$UserName = GetGlobal('UserName');
		if (!$UserName) return false;

		$ret = $this->render($title, $cellwidth, $cellheight, $today);	
		return ($ret);
	}
	
	protected function get_sum_data() {
	    $db = GetGlobal('db');
		//$cat = (GetReq('id')) ? false : GetReq('cat');//false when id
		//if (!$cat) return false;
		
		//if (defined('SHKATALOGMEDIA_DPC')) {
		 
		  //$ucodes = GetGlobal('controller')->calldpc_var('shkatalogmedia.result');
		  //$usecode = GetGlobal('controller')->calldpc_method('shkatalogmedia.getmapf use code');
		
		  $sSQL = 'select id,pid,owner,title,code,start,end,class,resclass,private,include,exclude from projects where active=1';
		  /*foreach ($ucodes as $u=>$rec) {
			$cont = ($u>0) ? 'OR' : 'AND';
			$supercode = $rec['DB_NAME'] ? $rec[$usecode].':'.$rec['DB_NAME'] : $rec[$usecode];
			$sSQL .= " $cont code='". $supercode . "'";
		  }	*/
		  $sSQL .= " order by start DESC";// group by pid";
		  //echo $sSQL;
		  $result = $db->Execute($sSQL,2);		
 
		  foreach ($result as $p=>$prj) {
		
		    //is private project..dont show
			$isprivate = ($prj['private']>0) ? true : false;
			$allowed = $this->is_allowed_user($prj['owner'],$prj['include'],$prj['exclude']);
		    if (($isprivate) && (!$allowed))
				continue;
		
		    switch ($prj['class']) {
			    case  2 : $class = 'urgent'; break;
			    case  1 : $class = 'important'; break;
			    case  0 :
				default : $class = null; 
			}
		
			$this->data[] = array(
						'label' => $prj['title'],
						'start' => $prj['start'], 
						'end'   => $prj['end'],
						'class' => $class,
						'link'  => 'javascript:void(0)', //add link 
						'project'  => $prj['id'],//project id
						'project_title'  => $prj['title'],//project title
						'group'=>$prj['pid'],
						'owner'=>$prj['owner'],//sub-owner
						'code'=>$prj['code'],//prj code
					);			
		  }
		  //print_r($this->data);
		  return (!empty($this->data) ? true : false);	
		//}
	}	
	
	public function render_sum($title=null) {
		$UserName = GetGlobal('UserName');
		if (!$UserName) return false;
		//$cat = (GetReq('id')) ? false : GetReq('cat');//false when id
		$cellwidth = $cellwidth ? $cellwidth : $this->cellwidth;
		$cellheight = $cellheight ? $cellheight : $this->cellheight;
		$today = $today ? true : $this->today;
		$title = $title ? $title : 'Projects';//($cat) ? $cat : ($title ? $title : $this->title);
	
	    if ($this->get_sum_data()) {
	
			$ret = new Gantti($this->data, array(
						'title'      => $title,
						'cellwidth'  => $cellwidth,
						'cellheight' => $cellheight,
						'today'      => $today
						));	
							
			return ($ret);
        }
		
		return false;		
	}
	
	public function is_super_owner($owner=null) {
		
		return true; //always true
		
		$UserName = GetGlobal('UserName');
		$id = GetReq('id') ? GetReq('id') : null;
		if ((!$UserName)||(!$id)) return false;	
		
		if (($owner) && ($owner==decode($UserName)))
			return true;
			
		//else see internal..
		if (strstr($id,'@')) {//post user item
			$p = explode('@',$id);
			$u = array_shift($p);
			if ($u == hash('crc32',decode($UserName))) 
			    return true; 
		}	
		elseif (strstr($id,':')) {//is xix app remote product
		    $p = explode(':',$id);
			/*$urlpath = paramload('SHELL','urlpath');
			$xixapppath = $urlpath . '/'.$p[1] . '/cp/';
			//echo $xixapppath,'>';
			$xixmail = remote_paramload('INDEX','e-mail', $xixapppath); 
			//echo $xixmail; //??????
			if ($xixmail==decode($UserName))*/
			
			if (strstr(decode($UserName),array_pop(explode('_',$p[1])))) {
				//$app = explode('_',$p[1]);
				//print_r($app); echo decode($UserName);
				//if (strstr(decode($UserName),array_pop(explode('_',$p[1]))))
					return true; //app user item
			}	
        }		
        else { 
		    //xix contact admin
			$prpath = paramload('SHELL','prpath');
		    $xixmail = remote_paramload('INDEX','e-mail', $prpath); 
			if ($xixmail==decode($UserName))
				return true;
        }		
		return false;
	}
	
	//for cart
	protected function user_in_projects($user=null, $date=null) {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');
		if (!$UserName) return false;			
		$user = $user ? $user : decode($UserName);
		$date = $date ? $date : date('Y-m-d');
		$day = date('N');
		$week = date('W');
		$year = date('Y');
        $ret = false;
		
		
		if (defined('SHKATALOGMEDIA_DPC')) {
			$lan = getlocal();
			$itmname = $lan ? 'itmname' : 'itmfname';		
			$icode = GetGlobal('controller')->calldpc_method('shkatalogmedia.getmapf use code');
			$sSQL = "select i.{$itmname},p.id,p.title,r.project_id,r.ryear,r.rweek,r.rday,r.rtime from reservations r";
			$sSQL .= " INNER JOIN projects p ON p.id = r.project_id"; 			
			$sSQL .= " INNER JOIN products i ON p.code=i.{$icode}";
			$sSQL .= " WHERE p.active=1";
		}
		else {
		    $itmname = 'noitem';//dummy
			$sSQL = 'select p.id,p.title,r.project_id,r.ryear,r.rweek,r.rday,r.rtime from reservations r';
			$sSQL .= " INNER JOIN projects p ON p.id = r.project_id"; 		
			$sSQL .= " WHERE p.active=1";
		}	
			
		//test 
		$sSQL .= " AND r.invoiced=0 ";//AND r.oapprove=1";
		$sSQL .= " AND r.ryear={$year} AND r.rweek<={$week} AND r.rday<'{$day}'";		
		$sSQL .= " AND r.ruser_id='{$user}' ";//AND p.end<= date '$date'";		

		//echo $sSQL,'<br/><br/>';
		$result = $db->Execute($sSQL,2);		
        
		if (!empty($result)) {
		  foreach ($result as $r=>$rec) {
		    $item = ($rec[$itmname]) ? $rec[$itmname].' ' : null;
			$ret[] = array('id'=>$rec['id'],'title'=>$item.$rec['title']);//.' '.$rec['rtime']);
		  }
        } 
		return ($ret);
	}
	
	//exchange time for products
	public function user_in_projects_button($code=null) {
	  $UserName = GetGlobal('UserName');
	  if ((!$UserName)||(!$code)) return false;
	  
	  $prj = $this->user_in_projects();
	  //print_r($prj);
	  
	  if (!empty($prj)) {
		
		/*if (count($prj)==1) { //one project button //get_href..NOT EXIST
			$mydate = time();//$block['start']; //is timestamp
			$pid = $prj[0]['id'];//$block['project'];
			$ptitle = $prj[0]['title'];//localize('_ADDCARTITEM',getlocal());//$block['ptitle'];
			$button = $this->get_href($mydate,$ptitle,null,$pid,$ptitle,$code);		
		}	
		else {//many projects ..select option
		*/
		    $projects_label = localize('CRMGANTTI_DPC', getlocal());
            $mydate = time();

			$projects[0] = "--{$projects_label}--";
			foreach ($prj as $p=>$proj) {
				$pid = $proj['id'];
				$ptitle = $proj['title'];
				//$action = $this->get_href($mydate,null,null,$pid,$ptitle,$code,true);
				$projects[$pid] = $ptitle;
            }
			$combo = $this->make_combo('exchange_projects_for_'.$code,$projects,null,'cart_load_project');			
			return ($combo);
		//}
		
        //return ($button);		
	  }	
	  
	  return false;
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

	//clear cart reservation transactions when cart has submit
    public function clear() {
	
		SetSessionParam('restr',null);
		
		//echo '<pre>';
		//print_r(GetSessionParam('restr'));		
		//echo '</pre>';
		
        return true;		
    }

	//remove reservation transactions when cart line deleted
    public function remove($id=null) {
	    if (!$id) return false;
	
		$restr = (array) GetSessionParam('restr');
		if (empty($restr)) return;
		
		//echo '<pre>';
		//print_r(GetSessionParam('restr'));		
		//echo '</pre>';		
		
		foreach ($restr as $pid=>$res) {
			if ($pid!=$id)
				$restr_out[$pid] = $res;	
		}
		//save array...
		SetSessionParam('restr', $restr_out);
		
		//echo '<pre>';
		//print_r(GetSessionParam('restr'));		
		//echo '</pre>';
		
        return true;		
    }

	//save reservations to session when saving transaction	
    public function addtocart($project_id,$res_details=null) {
	    if ((!$res_details)||(!$project_id)) return false;
	
	    //init/fetch session reservation transactions
		$restr = GetSessionParam('restr') ?
		         (array) GetSessionParam('restr') :
				 array();
	    
		//add details
		$restr[$project_id] = $res_details;		
		SetSessionParam('restr',$restr);		
		
		return true;
    }
	
	//finalize cart (-/+) 
	public function finalize($code=null, $trid=null, $price=null, $qty=1) {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');	
		$user = decode($UserName);

	    if ((!$trid)||(!$user)||(!$code)) return false;
		
		//echo '<pre>';
		//print_r(GetSessionParam('restr'));		
		//echo '</pre>';		
		
		$restr = (array) GetSessionParam('restr');
		if (empty($restr)) return false;

		$affected = 0;
		foreach ($restr as $pid=>$res) {
			$query = "SELECT p.owner,p.title,r.id,r.project_id,r.ruser_id,r.ryear,r.rweek,r.rday,r.rtime,r.rprice FROM reservations r ";
			$query.= "INNER JOIN projects p ON p.id=r.project_id WHERE ";		
			
			$rcodes = array(); //init
			foreach ($res as $rid=>$reservation) {
				$rcodes[] = "r.id=".$rid;
            }		
            $query.= "(" . implode(' OR ', $rcodes) ." )";				
			$query.= " AND r.project_id=".$pid;
			$query.= " AND r.ruser_id='{$user}' AND r.trid='{$trid}'";
			$query.= " AND r.invoiced=1"; //0	..after invoicing..			
			$result = $db->Execute($query,2);	
            //echo $query,'<br/><br/>';
			
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

					$query = "INSERT INTO trdata SET isservice=1,pid=$pid,";
					$query.= "code='".$code ."',";
					$query.= "weight=0,";
					$query.= "volume=0,";
					$query.= "latitude={$latitude},";
					$query.= "longitude={$longitude},";					
					$query.= "owner='".$rec['owner']."',";
					
					$name = $rec['title'] . ' ' . $sdate . ' '. $rec['rtime']; 					
					$query.= "name='" .$name."',";					
					
					//when the item has price, put the price - ?
					$p_price = ($rec['rprice']*-1);//($price<0) ? ($rec['rprice']*-1) : $rec['rprice'];
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

        $this->clear();		

		return (($affected) ? true : false);
	}	

	//reservation transactions marked as invoiced
    public function invoice_user_reservations($code=null, $trid=null) {
	    $db = GetGlobal('db');
	    $UserName = GetGlobal('UserName');	
		$user = decode($UserName);
		$transaction_id = $trid ? $trid : $user;	
	    if ((!$trid)||(!$user)) return false;
		$itemcode = $code; //not used...
	
		$restr = (array) GetSessionParam('restr');
		if (empty($restr)) return false;	
	
		//finalize
		if (defined('RESERVATIONS_DPC')) {
			foreach ($restr as $pid=>$res) {
			
				$query = "UPDATE reservations SET invoiced=1,trid='{$transaction_id}' WHERE ";		
				
			    $rcodes = array(); //init
				foreach ($res as $rid=>$reservation) {
					$rcodes[] = "id=".$rid;
                }		
                $query.= "(" . implode(' OR ', $rcodes) ." )";				
				$query.= " AND project_id=".$pid;
				$query.= " AND ruser_id='{$user}'";
				$query.= " AND invoiced=0";				
				$result = $db->Execute($query,1);	
				//echo $query.'<br/><br/>';
			}		
		}
		
		//$this->clear(); //NOT HERE...SEE finalize
		
        return true;		
    }	
	
};
}
?>