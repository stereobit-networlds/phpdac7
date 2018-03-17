<?php

$__DPCSEC['RCANEL_DPC']='1;1;1;1;1;1;1;1;1';

if (!defined("RCANEL_DPC"))  {
define("RCANEL_DPC",true);

$__DPC['RCANEL_DPC'] = 'rcanel';

$a = GetGlobal('controller')->require_dpc('phpdac/rccontrolpanel.dpc.php');
require_once($a);
 
GetGlobal('controller')->get_parent('RCCONTROLPANEL_DPC','RCANEL_DPC');

$__EVENTS['RCANEL_DPC'][8]='cpanel';
$__EVENTS['RCANEL_DPC'][9]='isLoggedIn';
$__EVENTS['RCANEL_DPC'][10]='signout';
$__EVENTS['RCANEL_DPC'][11]='lock';
$__EVENTS['RCANEL_DPC'][12]='unlock';

$__ACTIONS['RCANEL_DPC'][8]='cpanel';
$__ACTIONS['RCANEL_DPC'][9]='isLoggedIn';
$__ACTIONS['RCANEL_DPC'][10]='signout';
$__ACTIONS['RCANEL_DPC'][11]='lock';
$__ACTIONS['RCANEL_DPC'][12]='unlock';

$__DPCATTR['RCANEL_DPC']['cpanel'] = 'cpanel,1,0,0,0,0,0,0,0,0,0,0,1';

class rcanel extends rccontrolpanel {

    var $lock, $username, $name, $adminSecID, $env, $environment;
    var $data, $file2edit, $turl;
		
	function __construct() {
		
		rccontrolpanel::rccontrolpanel();
		
		$this->lock = GetSessionParam('LOCK');
		
		$this->username = GetSessionParam('USER');
		$this->name = GetSessionParam('NAME');
		$this->adminSecID = GetSessionParam('ADMINSecID');
		$this->env = GetSessionParam('env');
		$this->environment = GetSessionParam('env'); //alias
		
		//load params
		$this->turl = urldecode(base64_decode(@file_put_contents($this->prpath . '.turl')));
		$this->file2edit = urldecode(base64_decode(@file_put_contents($this->prpath . '.htmlfile')));
				
		//$this->data = json_decode(file_get_contents("php://input"));		
	}
	 	
    public function event($event) {    	  
	   
	   //if a remote user is in do not allow /cp actions
	   /////////////////////////////////////////////////////////////
	   //if (GetSessionParam('REMOTELOGIN')!='') die("Not allowed!");//	
	   /////////////////////////////////////////////////////////////	
	   
	   //$this->autoupdate();	   	  		  			      
  
	   switch ($event) {

	     case "unlock"      :  die($this->do_unlock()); break;
	     case "lock"        :  die($this->do_lock()); break;	   
	     case "signout"     :  die($this->do_logout()); break;
	     case "isLoggedIn"  :  die($this->isLoggedIn());break;// ? '1' : null); break;
		 case "cpanel"      :
		 default         	:  rccontrolpanel::event($event);				 
       } 
    }
  
    public function action($action) {
	  
	  if (GetSessionParam('LOGIN')=='yes') {
	      switch ($action) {
		    
			case "cpanel"      :	
			default            : $out .= rccontrolpanel::action($action); 
			  
		 } 		 		  
	  }  
	
	  return ($out);
    } 
	
    public function parse_environment($save_session=false, $adminsecid=null) {
	    
		if ($ret = GetSessionParam('env')) 
			return ($ret);

		//$myenvfile = /*$this->prpath .*/ 'cp.ini';
		//$ini = @parse_ini_file($myenvfile ,false, INI_SCANNER_RAW);	
		$ini = @parse_ini_file($this->prpath . "cp.ini");
	
		//if (!$ini) die('Environment error!');

		$adminsecid = GetSessionParam('ADMINSecID') ? GetSessionParam('ADMINSecID') : $adminsecid;
		$seclevid = ($adminsecid>1) ? intval($adminsecid)-1 : 1;//...not instant sec level read//9; //test
		//echo GetSessionParam('ADMINSecID'),'>',$adminsecid,':', $seclevid;	
		//print_r($ini); 
		foreach ($ini as $env=>$val) {
			if (stristr($val,',')) {
				$uenv = explode(',',$val);
				$ret[$env] = $uenv[$seclevid];  
			}
			else
				$ret[$env] = $val;
		}

		if (($save_session) && (!GetSessionParam('env'))) 
			SetSessionParam('env', $ret); 		
	
		return ($ret);
    }		
	
	private function isoldpass($username) {
	   $db = GetGlobal('db');
	   
	   $sSQL = "select password from users where username='".$username."' LIMIT 1";
	   $result = $db->Execute($sSQL,2);
	   $p = $result->fields['password'];
	   //echo $p,$sSQL,strlen($p);
	   if (($p) && (strlen($p)<=10)) //user exist and pass <=10 chars
	      return true;
	
       return false;	
	}	
	
    public function do_login($user=null,$pass=null) {
	    $db = GetGlobal('db');		

	    if (($user) && ($pass)) {

			$sSQL = "SELECT username, password, email, lname, fname, sesid, notes, seclevid, clogon FROM users" . 
			        " WHERE username ='" .	addslashes($user) ."'";

            /*$sSQL.= ($this->isoldpass($user)) ?					
					" AND password='" . addslashes($pass) . "'" :*/
			$sSQL.=	" AND password='" . md5(addslashes($pass)) . "'";
				  
			$sSQL .= " AND seclevid>=7 LIMIT 1";		  
			//echo "login:",$sSQL;
			$result = $db->Execute($sSQL,2);
			//print_r($result->fields);

			if ((!empty($result->fields)) &&
			    (strcmp(trim($result->fields['notes']),"DELETED")!=0)) {
		  
		        SetSessionParam('LOGIN','yes');	
		        SetSessionParam('USER',$result->fields['username']);
				SetSessionParam('NAME',$result->fields['fname']);
		        SetSessionParam('ADMIN','yes');
                SetSessionParam('ADMINSecID',$result->fields['seclevid']);				
				
				//update this
				$this->username = $result->fields['username'];
				$this->name = $result->fields['fname'];
				
				$this->env = parse_environment(true,$result->fields['seclevid']);				

				$arr = array('user'=>array('name'=>$result->fields['fname'],
				                           'email'=>$result->fields['email'])
				        	);
					
                //return true;							   
				$jsn = json_encode($arr);
				return ($jsn);
			}
	    }
	   
	    return false;
	}

    public function do_logout() {
							
		SetSessionParam('LOGIN',null);
		SetSessionParam('ADMIN',null);
		SetSessionParam('ADMINSecID',null);
		SetSessionParam('NAME',null);
		SetSessionParam('USER',null);
		SetSessionParam('env',null);					
					
		$arr = array('data'=>array('signedin'=>0,'user'=>$this->username));			
		$jsn = json_encode($arr);
		return ($jsn);
	}	
	
	public function isLoggedIn() {
	    $signedin = $this->username ? 1 : 0;
	    $arr = array('data'=>array('signedin'=>$signedin,'username'=>$this->username));
		
		//return ($this->username);
		$jsn = json_encode($arr);
		return ($jsn);
	}
	
	public function getUsername() {
		return ($this->username);
    }
	
	public function getTitle() {
		return ($this->name);
    }
	
	public function do_lock() {
		if ($this->username) {
			SetSessionParam('LOCK',1);
			
	        $arr = array('data'=>array('lock'=>1,'user'=>$this->username));			
		    $jsn = json_encode($arr);
            return ($jsn);			
		}
        return false; 		
	}
		
	public function do_unlock($password=null) {
	    $db = GetGlobal('db');
		
		$data = json_decode(file_get_contents("php://input"));
		$pass = $data ? $data->password : (GetReq('pass') ? GetReq('pass') : $password);
		if (!$pass) return false;
		
		if (/*($this->lock) &&*/ ($this->username)) {
			$sSQL = "select username,password, lname from users where username='" .
			        $this->username . "'" . 
					" AND password='" . md5($pass) . "'" .
					" LIMIT 1";
			$result = $db->Execute($sSQL,2);
			//echo $sSQL;
			$p = $result->fields['password'] ? 0 : 1;
		
			SetSessionParam('LOCK',null);	
			
			$arr = array('data'=>array('lock'=>$p,'user'=>$result->fields['lname']));						
			$jsn = json_encode($arr);
			return ($jsn);	
		}	
		
		return false;
	}

};
}
?>