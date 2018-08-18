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

class umon 
{	
	private $env, $pstart, $pend, $ukeys;
	
	public function __construct(& $env=null) 
	{
		$this->env = $env;
		
		$this->ip = $this->env->daemon_ip;
		$this->pstart = 19126;
		$this->pend = 19999;
		
		$this->ukeys = array('netport', 'uuid');
	}

	public function go($uuid=null) 
	{
		if (!$uuid) return 'undefined uuid'; //when no uuid port err at return
		//$this->env->cnf->_say('uuid: ' . $uuid, 'TYPE_LION');		
		$cwd = getcwd();
		
		//generate port...		
		$tport = $this->portAdd($uuid);
		$port = $tport ? $tport : 19125; 
		//_verbose('Port:' . $tport . PHP_EOL);
		
		if (!@file_get_contents($cwd . _UMONFILE . $uuid . '.log'))
		{
			$this->env->_say("uMonitor ($port): ". $uuid, 'TYPE_IRON');	
			
			@file_put_contents($cwd . _UMONFILE . $uuid . '.log', "$port\r\n", LOCK_EX);
			
			if (defined('_BELL')) _verbose(_BELL); //"\007"; //beep
			
			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
				exec("start /D $cwd\\tier tierp.bat -x {$this->ip} $port $uuid"); 
			}
			else {//require screen gnu package
				exec("screen $cwd/tier.sh -x {$this->ip} $port $uuid");	
			}
			
			$this->portTableView();			
			
			return $port;
		}			
		
		return 'file ptr exist!';
	}

	public function portAdd($uuid) 
	{
		$portTable = json_decode($this->env->read('srvPorts'), true);
		//print_r($portTable);
		
		$portTable = $this->cleanPorts();
		//print_r($portTable);		
		
		if ($port = $this->portFind($uuid, $portTable))
			$portTable[$uuid] = $port;
		
		//save to mem
		$this->env->save('srvPorts', json_encode($portTable));		
		//print_r($portTable);
		
		return $port;//true;
	}	
	
	//scan alowed ports range
	public function portFind($uuid, $portTable)
	{
		$cwd = getcwd();
				
		//check for already defined port and open tier
		if (@file_exists($cwd . _UMONFILE . $uuid . '.log'))
		{
			$retport = $portTable[$uuid];
			_verbose('Port exist:' . $retport . PHP_EOL);			
			
			return $retport; 
		}	
		
		//scan ports
		$i = $this->pstart;
		while (in_array($i, $portTable))
		{
			if ($i == $this->pend)
			{
				//_verbose('Port scan has exhausted' . PHP_EOL);
				$this->env->_say('Port scan has exhausted', 'TYPE_LION');
				return false;
			}
			//else	
				
			$i+= 1;
			//_verbose('Port scan:' . $i . PHP_EOL);
			$this->env->_say('Port scan:' . $i, 'TYPE_LION');
		}
		
		//_verbose('Port selected :' . $i . PHP_EOL);
		$this->env->_say('Port selected :' . $i, 'TYPE_LION');
		return $i;	
	}
	
	//re-create port map for active connections
	public function cleanPorts()
	{
		$cwd = getcwd();
		$portTable = json_decode($this->env->read('srvPorts'), true);		
		if (empty($portTable)) return array();
			
		foreach ($portTable as $u=>$p)	
		{
			if (@file_exists($cwd . _UMONFILE . $u . '.log'))
				$newPortTable[$u] = $portTable[$u];
		}

		//print_r($newPortTable);		
		return (array) $newPortTable;
	}

	//view port table (use scheduled tasks)
	public function portTableView($msgType=null) 
	{
		$_type = $msgType ? $msgType : 'TYPE_BIRD';
		$portTable = json_decode($this->env->read('srvPorts'), true);
		
		$this->env->_say('[-------- session --------]' . "\tport", $_type); //header
		if (empty($portTable)) return ;
		
		reset($portTable);
		foreach ($portTable as $u=>$p)
			$this->env->_say('[' . $u . ']' . "\t" . $p, $_type);
			
		return ;
	}	
	
	public function checkPorts($msgType=null) {
		
		$_type = $msgType ? $msgType : 'TYPE_BIRD';
		$portTable = $this->cleanPorts();
		
		//save to mem
		$this->env->save('srvPorts', json_encode($portTable));
		
		$this->env->_say('check ports', $_type);  
		return true; 
	}
	
	//get the umon port number, fetch to phpdac7(uuid)
	public function umonPort($uuid=null)
	{
		//manual tiers has no uuid 
		if (!$uuid) return false; 
		
		$cwd = getcwd(); 
		$uufile = $cwd . _UMONFILE . $uuid . '.log';
		//echo $uufile . '>>>>>>>>>>>>>>>>>>>>>>' . PHP_EOL;		
		$port = @file_get_contents($uufile);
		
		return $port ? trim($port) : false; 	
	}	
	
	public function iscmd($k=null)
	{
		if (!$k) return false;
		
		return in_array($k, $this->ukeys);
	}

	public function netport($args=null)
	{
		$port = $this->umonPort($args[0]);
		$this->env->_say('netport reply:'. $port , 'TYPE_BIRD');
		
		return $port;
	}	
}