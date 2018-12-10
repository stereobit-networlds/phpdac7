<?php
/**
 * This file is part of phpdac7.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    balexiou<balexiou@stereobit.com>
 * @copyright balexiou<balexiou@stereobit.com>
 * @link      http://www.stereobit.com/php-dac7.php
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

class app {

	protected $env, $appenv, $conf;
	protected $db;

	public function __construct($env=null, $appenv=null) {
   
		$this->env = $env;
		$this->appenv = $appenv;
		$this->conf = null;
		$this->db = null;
		
		//save app config
		$this->conf = $this->appIni($this->appenv['cppath']);
		
		//re-init connection to db
		if ($this->connPDO()==true)
			$this->env->_say("PDO connection: ok!" , 'TYPE_IRON');
					
	}
  
	//read and save app ini files
	private function appIni($cppath=null) {
		if (!empty($this->conf)) return $this->conf;

		if (is_readable($cppath . "/config.ini.php")) {
			
			include($cppath . "/config.ini.php");
			$config = @parse_ini_string($conf, 1, INI_SCANNER_RAW);

			include($cppath . "/myconfig.txt.php");
			$myconfig = parse_ini_string($myconf, 1, INI_SCANNER_RAW);			
		}			
		else {	
			$this->env->_say("App configuration error, config.ini not exist!" , 'TYPE_LION');
			return false;
		}	
		
		//extra conf
		if (!empty($myconfig))
			$config = array_merge($config, $myconfig); 

		return $config;	
	}  
	
	//init db connection based on app db
	private function connPDO() 
	{
		if (empty($this->conf))	
		{
			$this->env->_say("App connection failed!", 'TYPE_LION');
			return false;
		}

		try 
		{
			$con = trim($this->conf['DATABASE']['dbname']);
			$usr = trim($this->conf['DATABASE']['dbuser']);
			$pas = trim($this->conf['DATABASE']['dbpwd']);
			$options    = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
              ];			
			
			$this->db = @new PDO("mysql:host=localhost:3306;dbname=$con;charset=utf8", $usr, $pas, $options);
			
			$this->env->_say("App db connection $usr@$con ok!", 'TYPE_IRON');
			
			return true;
	    } 
		catch (PDOException $e) 
		{
			$this->env->_say("App failed to get DB handle: " . $e->getMessage(), 'TYPE_LION');
        }
		return false;	
	}	
	
	//call by env cmd
	public function appInfo()
	{
		$this->pdoTest();
		//return json_encode($this->appenv);	
		//$username = $this->decode($this->appenv['username']);
		
		//print_r(self::$_APPENV);
		foreach($this->appenv as $k=>$v)
		{
			if (substr($k,0,4)=='user') 
			{
				$_dv = $this->decode($v);
				$ret[$k] = $_dv;
							
				//$this->env->_say($k . "=" . $_dv , 'TYPE_IRON'); 
			}	
			//else
				//$this->env->_say($k . "=" . $v , 'TYPE_IRON');
		}	
			
		return is_array($ret) ? json_encode($ret) : null;	
	}
	
	
    private function pdoTest()
	{
		$start = microtime(true);
		
		$sql = "SELECT * 
          FROM users
         WHERE notes = :notes";
         
		$notes = 'ACTIVE';

		$statement = $this->db->prepare($sql);
		$statement->bindParam(':notes', $notes, PDO::PARAM_STR);
		$statement->execute();

		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
		$rcount = count($rows);
		
		foreach ($rows as $row) {
			echo $row['email'] . PHP_EOL;
		}
		$tm = (microtime(true) - $start);
		$this->env->_say("PDO microtime ($rcount) :" . $tm, 'TYPE_LION');
	}	
	
	//decode function (simulate decode pcntl system function)
	protected function decode($var=null)
	{
		if (!$var) return null;
		
		//require_once($this->_include('system/azdgcrypt.lib.php'));
		require_once($this->env->ldscheme . '/system/azdgcrypt.lib.php');
		
		$az = new AzDGCrypt('1234567890abcdefdgklm#$%^&');
	    $ret = $az->decrypt($var);
	    unset($az);
		
		return $ret;
	}	

}