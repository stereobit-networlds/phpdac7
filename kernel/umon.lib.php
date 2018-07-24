<?php
/*
	Licence
	
	Copyright (c) 2018 stereobit.networlds | Vassilis Alexiou
	balexiou@stereobit.com | https://www.stereobit.com
	
	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:
	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.
	
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
	
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
	public function portTableView() 
	{
		$portTable = json_decode($this->env->read('srvPorts'), true);
		
		$this->env->_say('[-------- session --------]' . "\tport", 'TYPE_IRON'); //header
		if (empty($portTable)) return ;
		
		reset($portTable);
		foreach ($portTable as $u=>$p)
			$this->env->_say('[' . $u . ']' . "\t" . $p, 'TYPE_IRON');
			
		return ;
	}	
	
	public function checkPorts() {
		
		$portTable = $this->cleanPorts();
		
		//save to mem
		$this->env->save('srvPorts', json_encode($portTable));
		
		$this->env->_say('check ports', 'TYPE_IRON');  
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
		$this->env->_say('netport reply:'. $port , 'TYPE_IRON');
		
		return $port;
	}	
}	
?>