<?php
$__DPCSEC['ADMDBUSER_']='8;1;1;1;1;1;1;1;8;9;9';

if (!defined("DATABASE_DPC"))  {
	define("DATABASE_DPC",true);

	$__DPC['DATABASE_DPC'] = 'database';

	$__PRIORITY['DATABASE_DPC'] = 1;//under construction

	$d = GetGlobal('controller')->require_dpc('database/dbconnect.lib.php');
	require_once($d);

class database {

    var $userLevelID;
    var $dbp;
    var $path, $hosted_path;
	var $serviceMode;

    public function __construct() {
		static $i;
		$db = GetGlobal('db');
	  
		$this->path = paramload('SHELL','prpath');  
		$this->hosted_path = $this->path;	 
	  
		$smode = paramload('SHELL','servicemode'); 
		$this->serviceMode = $smode ? true : false;
	  
		//echo '>>>>>>>>>>>>>',paramload('DATABASE','dbhost');
		$this->dbp = &$db;

		$this->userLevelID = (((decode(GetSessionParam('UserSecID')))) ? (decode(GetSessionParam('UserSecID'))) : 0);	  

		if ((iniload('DATABASE')) && (!$this->dbp)) { //no re-connection at new
	  
			//$i++; echo $i . ">>>>>>>>>>>>";
			$_Dbtype   = paramload('DATABASE','dbtype');
			$_Dbname   = paramload('DATABASE','dbname');
		
			if (seclevel('ADMDBUSER_',$this->userLevelID)) {//require modules as file becouse db does'nt exist at this state
				$_User     = paramload('DATABASE','dbauser') ? paramload('DATABASE','dbauser') : paramload('DATABASE','dbuser');
				$_Password = paramload('DATABASE','dbapwd') ? paramload('DATABASE','dbapwd') : paramload('DATABASE','dbpwd');		
				//echo "admin db user";
			}
			else {
				$_User     = paramload('DATABASE','dbuser');
				$_Password = paramload('DATABASE','dbpwd');
				//echo "common user";
			}  
			$_Host     = paramload('DATABASE','dbhost');  

			if (defined(_ADODB_)) { 
		
				$ADODB_CACHE_DIR = paramload('SHELL','prpath') . paramload('DATABASE','pathcacheq');		
				
				$this->dbp = ADONewConnection($_Dbtype);
				$this->dbp->PConnect($_Host, $_User, $_Password, $_Dbname);
				//echo 'ADODB loaded !';

			if ( ($cs=paramload('DATABASE','charset')) && (stristr($_Dbtype,'mysqli')) )
				$this->dbp->_connectionID->set_charset($cs);

			}
			else {
				//echo "ADODB extension not loaded....";

				$this->dbp = new dbconnect($_Dbtype,null);//,'SQLITE');
				$this->dbp->PConnect($_Host, $_User, $_Password, $_Dbname);
			}			  
		
			SetGlobal('db',$this->dbp);//global alias
			//echo $_Dbname;
		
			//test code
			//$sSQL = "SELECT * from users";

			//$result = $db->Execute($sSQL);
			//print_r($result->GetRows());
			/*
			$i=0;
			while(!$result->EOF) {
				$i+=1;
				print "$i>" . $result->fields[0] ."\n";
				$result->MoveNext();
			}
			*/
		
		
			///////////////////////////////////////// check service mode
			if ($this->serviceMode==true)
				die('Temporary unavailable. (service mode)');
		
			///////////////////////////////////////// check blacklist ip
			$this->checkBlackListIP();
		}
    }
   
    protected function checkBlackListIP() {
		$db = GetGlobal('db');
		$clientip = $_SERVER['REMOTE_ADDR']; //$_SERVER['HTTP_X_FORWARDED_FOR']
		//echo $clientip;
		
		$sSQL = "select REMOTE_ADDR from blacklistip where status=1 and REMOTE_ADDR=" . $db->qstr($clientip);
		//echo $sSQL;
		$result = $db->Execute($sSQL);
		
		if ($result->fields[0]) 
			die("IP blocked. ($clientip)");
		/*
		$i=0;
		while(!$result->EOF) {
         $i+=1;
         //print "$i>" . $result->fields[0] ."\n";
	     $result->MoveNext();
	    }*/
		
		return true;
	}
   
	public function switch_db($appname=null,$rootdb=null,$returnpointer=null, $check_object=false) {
		if ($appname) 
			$this->hosted_path = $this->path . '../' . $appname . '/cp/' ;

		if ($rootdb)//force root db connection
			$path = $this->path ; //'/home/stereobi/projects/';//demosoft/';
		else
			$path = $this->hosted_path;
		//echo $path,'-<br>-';
		  		  
		$_Dbtype   = remote_paramload('DATABASE','dbtype', $path ,1);
		$_Dbname   = remote_paramload('DATABASE','dbname', $path, 1);
		$_User     = remote_paramload('DATABASE','dbuser', $path, 1);
		$_Password = remote_paramload('DATABASE','dbpwd', $path, 1);
		//echo $_Dbname,$_User,$_Password,'!<br>';
		  
		//return ;		  
		if ((stristr($_Dbtype,'mysql')) || (stristr($_Dbtype,'mysqli'))) {	
			//$ADODB_CACHE_DIR = paramload('SHELL','prpath') . paramload('DATABASE','pathcacheq');		
				
			$dbp = ADONewConnection($_Dbtype);
			$dbp->PConnect($_Host, $_User, $_Password, $_Dbname);
			//echo 'ADODB loaded !';
		  
			if ($check_object) {
				//....WHEN CHECK OBJ ERROR AT GLOBAL MAIL QUEUE DB CALL(ENCODING....????)
				if (is_object($dbp)) {
					if ( ($cs=paramload('DATABASE','charset')) && (stristr($_Dbtype,'mysqli')) ) {
						if (method_exists($dbp, 'set_charset')) {
							$dbp->_connectionID->set_charset($cs);
							//echo 'z';
						}	 
					}	
				}
				else
					return false; 
			}//check object...
			else {
				if ( ($cs=paramload('DATABASE','charset')) && (stristr($_Dbtype,'mysqli')) ) {
					$dbp->_connectionID->set_charset($cs);
					//echo 'z';
				}			  
			}

			//return pointer...... 
			if ($returnpointer)
				return ($dbp);
			else	
				SetGlobal('db',$dbp);//global alias 		  
		}				
	}   
   
	public function clear() {
     
		$this->dbp = null;
	}
   
	//interface to adodb   
	public function qstr($str) {
   
		return ($this->dbp->qstr($str));
	}
   
	public function affected() {
     
		return ($this->dbp->Affected_Rows());
	}
   
	public function exesql($sql) {
   
		$ret = $this->dbp->Execute($sql);
		return ($ret);
	}   
   
	public function droptable($table) {
     
		$sSQL = "drop table if exists " . $table;
		$this->exesql($sSQL);
	}
   
	public function DLookUp($Table, $fName, $sWhere) {  
		//global $ADODB_FETCH_MODE;
		//global $_Dbtype, $_Dbname, $_User, $_Password, $_Host;
		$ADODB_FETCH_MODE = GetGlobal('ADODB_FETCH_MODE');  
		$_Dbtype = GetGlobal('_Dbtype');
		$_Dbname = GetGlobal('_Dbname');
		$_User = GetGlobal('_User');
		$_Password = GetGlobal('_Password');
		$_Host = GetGlobal('_Host');

		$db_look = NewADOConnection('mysql');
		$db_look->PConnect($_Host, $_User, $_Password, $_Dbname);  

		//$ADODB_FETCH_MODE = ADODB_FETCH_NUM; //associate field's number 
		SetGlobal('ADO_DB_FETCH_MODE',ADODB_FETCH_NUM);
  
		$result = $db_look->Execute("SELECT " . $fName . " FROM " . $Table . " WHERE " . $sWhere);
		if($result)
			$retval = $result->fields[0];
		else 
			$retval = "";

		//$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC; //back to association in  field's name 
		SetGlobal('ADO_DB_FETCH_MODE',ADODB_FETCH_ASSOC);
  
		return ($retval);	
	}

	//- function returns options for HMTL control "<select>" as one string
	public function get_options($sql,$is_search,$is_required,$selected_value) {
		//global $ADODB_FETCH_MODE;
		//$ADODB_FETCH_MODE = GetGlobal('ADODB_FETCH_MODE');   
  
		//if(!$db2) $db2=$db; //-- if it's not estblished we use standart main connection
		if (!$db2) $db2 = &$this->dbp;//SetGlobal('db2',&$this->dbp);  
  
		$options_str="";
		if ($is_search) {
			$options_str.="<option value=\"\">All</option>";
		}	
		else {
			if (!$is_required)
				$options_str.="<option value=\"\"></option>";
		}
  
		//$ADODB_FETCH_MODE = ADODB_FETCH_NUM; //associate field's number 

		$result = $db2->Execute($sql);
		if ($result) {
			while (!$result->EOF) {
				
				$id = $result->fields[0];
				$value = $result->fields[1];
				
				$selected = "";
				if ($id == $selected_value)
					$selected = "SELECTED";
				
				$options_str.= "<option value='".$id."' ".$selected.">".$value."</option>";
				$result->MoveNext();
			}
		}
		//$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC; //back to association in  field's name 
		return $options_str;
	}

};
}
?>