<?php
$__DPCSEC['ADMDBUSER_']='8;1;1;1;1;1;1;1;8;9;9';

if (!defined("PDODB_DPC"))  {
	define("PDODB_DPC",true);

	$__DPC['PDODB_DPC'] = 'pdodb';

	$__PRIORITY['PDODB_DPC'] = 1;//under construction

	//$d = GetGlobal('controller')->require_dpc('database/pdoconn.lib.php');
	//require_once($d);

class pdodb {

    var $userLevelID;
    var $dbp;
    var $path, $hosted_path;
	var $serviceMode;
	var $app;

    public function __construct() {
		static $i;
		$dbpdo = GetGlobal('dbpdo');
	  
	    $this->app = paramload('ID','name');
		$this->path = paramload('SHELL','prpath');  
		$this->hosted_path = $this->path;	 
	  
		$smode = paramload('SHELL','servicemode'); 
		$this->serviceMode = $smode ? true : false;
	  
		//echo '>>>>>>>>>>>>>',paramload('DATABASE','dbhost');
		$this->dbp = &$dbpdo;

		$this->userLevelID = (((decode(GetSessionParam('UserSecID')))) ? (decode(GetSessionParam('UserSecID'))) : 0);	  

		if ((iniload('DATABASE')) && (!$this->dbp)) { //no re-connection at new
	  
			//$i++; echo $i . ">>>>>>>>>>>>";
			$_Dbtype   = paramload('DATABASE','dbtype');
			$dtype = ((stristr($_Dbtype,'mysql')) || (stristr($_Dbtype,'mysqli'))) ? 'mysql' : $_Dbtype;
			
			$_Dbname   = paramload('DATABASE','dbname');
		
			if (seclevel('ADMDBUSER_',$this->userLevelID)) {//require modules as file becouse db does'nt exist at this state
				$_User     = paramload('DATABASE','dbauser') ?? paramload('DATABASE','dbuser');
				$_Password = paramload('DATABASE','dbapwd') ?? paramload('DATABASE','dbpwd');		
				//echo "admin db user";
			}
			else {
				$_User     = paramload('DATABASE','dbuser');
				$_Password = paramload('DATABASE','dbpwd');
				//echo "common user";
			}  
			$_Host = paramload('DATABASE','dbhost'); 
			$cs = paramload('DATABASE','charset') ?? 'utf8';

			try 
			{	//https://phpdelusions.net/pdo
				//$host = '176.9.106.50';//'127.0.0.1'; //176.9.106.50:3306
				//$db   = 'stereobi_bit78'; //'admin_pangr'; //stereobi_bit78
				//$user = 'stereobi_panik'; //'panik'; //stereobi_panik
				//$pass = 'fxpower77';
				//$charset = 'utf8';

				$dsn = "$dtype:host=$_Host;dbname=$_Dbname;charset=$cs";
				$options = [
							PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
							PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
							PDO::ATTR_EMULATE_PREPARES   => false,
							];
				$this->dbp = new PDO($dsn, $_User, $_Password, $options);			

				if ($this->dbp) { 	
					//echo("[----]PDO start" . PHP_EOL);
					SetGlobal('dbpdo', $this->dbp);//global alias
					
					//test
					$query = "SELECT count(id) as syncounter FROM syncsql";
					$q = $this->dbp->prepare($query);
					$q->execute();
					$counter = $q->fetch(PDO::FETCH_ASSOC)['syncounter'];	
					echo("[----]PDO counter:" . $counter . PHP_EOL);
					//$this->env->_say('Sync counter: ' . $counter, 'TYPE_IRON');
				}
				else
					echo("[----]PDO failed" . PHP_EOL);
					
			} 
			catch (PDOException $e) 
			{
				echo("[----]Failed to get DB handle: " . $e->getMessage() . PHP_EOL);
			}				  
		
			///////////////////////////////////////// check service mode
			if ($this->serviceMode==true)
				die('Temporary unavailable. (service mode)');
		
			///////////////////////////////////////// check blacklist ip
			$this->checkBlackListIP();
		}
    }
   
    protected function checkBlackListIP() {
		if (!$db = GetGlobal('dbpdo')) return false;
		$clientip = $_SERVER['REMOTE_ADDR']; //$_SERVER['HTTP_X_FORWARDED_FOR']
		//echo $clientip;
		
		$sql = "select REMOTE_ADDR from blacklistip where status=1 and REMOTE_ADDR = ?";
		$stmt = $db->prepare($sql);
		$stmt->execute([$clientip]);
		$name = $stmt->fetchColumn();
		
		if ($name) 
			die("IP blocked. ($clientip)");
		
		/*
		$sSQL = "select REMOTE_ADDR from blacklistip where status=1 and REMOTE_ADDR=" . $db->qstr($clientip);
		//echo $sSQL;
		$result = $db->Execute($sSQL);
		
		if ($result->fields[0]) 
			die("IP blocked. ($clientip)");
		*/
		return true;
	}
   
	public function switch_db($appname=null,$rootdb=null,$returnpointer=null, $check_object=false) {
		if ($appname) 
			$this->hosted_path = $this->path . 'apps/' . $appname .'/';

		if ($rootdb)//force root db connection
			$path = $this->path ; //'/home/stereobi/projects/';//demosoft/';
		else
			$path = $this->hosted_path;
		
		//echo "\r\n\r\nSWITCH DB CONF FILE:" . $path . "\r\n";  
		$_Dbtype   = remote_paramload('DATABASE','dbtype', $path ,1);
		$dtype = ((stristr($_Dbtype,'mysql')) || (stristr($_Dbtype,'mysqli'))) ? 'mysql' : $_Dbtype;
		
		$_Dbname   = remote_paramload('DATABASE','dbname', $path, 1);
		$_User     = remote_paramload('DATABASE','dbuser', $path, 1);
		$_Password = remote_paramload('DATABASE','dbpwd', $path, 1);
		$cs 	   = remote_paramload('DATABASE','charset', $path, 1) ?? 'utf8';
		//echo "\r\nDB Params:" . $_Dbname .' '. $_User .' '. $_Password . PHP_EOL;		
		
		try 
		{
			$dsn = "$dtype:host=$_Host;dbname=$_Dbname;charset=$cs";
			$options = [
						PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
						PDO::ATTR_EMULATE_PREPARES   => false,
						];
			$mydbp = new PDO($dsn, $_User, $_Password, $options);			

			if ($mydbp) { 	
				//echo("[----]PDO switch start" . PHP_EOL);
				//...test
			}
			else
				echo("[----]PDO switch failed" . PHP_EOL);
					
		} 
		catch (PDOException $e) 
		{
			echo("[----]Failed to switch DB handle: " . $e->getMessage() . PHP_EOL);
		}	
		
		//return pointer...... 
		if ($returnpointer)	return ($mydbp);			
		
		//else	
		SetGlobal('dbpdo', $mydbp);//global alias 		  
		return true;		
	}   
   
	public function clear() {
     
		$this->dbp = null;
	}
   
	//inactive
	public function qstr($str) {
   
		return ($str);
	}
   
	public function affected(&$stm) {
     
		return ($stm->rowCount());
	}
   
	public function exesql($sql, $stm) {
   
		$ret = $stm->execute($sql);
		return ($ret);
	}   
   
	public function droptable($table, $stm) {
     
		$sSQL = "drop table if exists " . $table;
		return $stm->exesql($sSQL, $stm);
	}
   
	public function DLookUp($Table, $fName, $sWhere) { 
		if (!$db = GetGlobal('dbpdo')) return false;
		
		$query = "SELECT " . $fName . " FROM " . $Table . " WHERE " . $sWhere;
		$retval = $db->query($query)->fetchColumn();
		
		//$q = $db->prepare($query); //->execute();
		//$q->execute();
		//$retval = $q->fetch(PDO::FETCH_ASSOC)[$fName];

		return ($retval);	
	}

	//- function returns options for HMTL control "<select>" as one string
	public function get_options($sql,$is_search,$is_required,$selected_value) {
		if (!$db2) $db2 = &$this->dbp;  
  
		$options_str="";
		if ($is_search) {
			$options_str.="<option value=\"\">All</option>";
		}	
		else {
			if (!$is_required)
				$options_str.="<option value=\"\"></option>";
		}
  
		$q = $db2->prepare($sql);
		$q->execute();
		
		while ($row = $q->fetch(PDO::FETCH_NUM)) {

			$id = $row[0];
			$value = $row[1];
				
			$selected = "";
			if ($id == $selected_value)
				$selected = "SELECTED";
				
			$options_str.= "<option value='".$id."' ".$selected.">".$value."</option>";
		}

		return $options_str;
	}

};
}
?>