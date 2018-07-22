<?php
class umon 
{	
	private $env, $pstart, $pend;
	
	public function __construct(& $env=null) 
	{
		$this->env = $env;
		
		$this->ip = $this->env->daemon_ip;
		$this->pstart = 19126;
		$this->pend = 19999;
	}

	public function go($uuid=null) 
	{
		if (!$uuid) return false;
		//$this->env->cnf->_say('uuid: ' . $uuid, 'TYPE_LION');		
		$cwd = getcwd();
		
		$port = '19125'; //generate port...
		
		$tport = $this->portAdd($uuid);
		_verbose('Port:' . $tport . PHP_EOL);
		
		if (!@file_get_contents($cwd . _UMONFILE . $uuid . '.log'))
		{
			$this->env->cnf->_say('uMonitor (new): '. $uuid, 'TYPE_IRON');	
			@file_put_contents($cwd . _UMONFILE . $uuid . '.log', "1\r\n", LOCK_EX);
			
			if (defined('_BELL')) _verbose(_BELL); //"\007"; //beep
			
			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
				exec("start /D $cwd\\tier tierp.bat -x {$this->ip} $port $uuid"); 
			}
			else {//require screen gnu package
				exec("screen $cwd/tier.sh -x {$this->ip} $port $uuid");	
			}
			
			$this->portTableView();			
			
			return $tport; //$this->port;
		}			
		
		return false;
	}

	public function portAdd($uuid) 
	{
		$portTable = json_decode($this->env->read('srvPorts'), true);
		print_r($portTable);
		
		$portTable = $this->cleanPorts();
		print_r($portTable);		
		
		if ($port = $this->portFind($uuid, $portTable))
			$portTable[$uuid] = $port;
		
		//save to mem
		$this->env->save('srvPorts', json_encode($portTable));		
		print_r($portTable);
		
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
				_verbose('Port scan has exhausted' . PHP_EOL);
				return false;
			}
			//else	
				
			$i+= 1;
			_verbose('Port scan:' . $i . PHP_EOL);
		}
		
		_verbose('Port selected :' . $i . PHP_EOL);
		return $i;	
	}
	
	//re-create port map for active connections
	public function cleanPorts()
	{
		$cwd = getcwd();
		$portTable = json_decode($this->env->read('srvPorts'), true);		
		
		foreach ($portTable as $u=>$p)	
		{
			if (@file_exists($cwd . _UMONFILE . $u . '.log'))
				$newPortTable[$u] = $portTable[$u];
		}

		//print_r($newPortTable);		
		return (array) $newPortTable;
	}

	//view port table (use scheduled tasks)
	public function portTableView() 
	{
		$portTable = json_decode($this->env->read('srvPorts'), true);
		
		_verbose('[-------- session --------]' . "\tport" . PHP_EOL); //header
		reset($portTable);
		foreach ($portTable as $u=>$p)
			_verbose('[' . $u . ']' . "\t" . $p . PHP_EOL);
			
		return $ret;
	}	
	
	public function checkPorts() {
		
		$portTable = $this->cleanPorts();
		
		//save to mem
		$this->env->save('srvPorts', json_encode($portTable));
		
		$this->env->cnf->_say('check ports... ', 'TYPE_LION');  
		return true; 
	}
}	
?>