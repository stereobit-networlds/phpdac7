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

//require_once('mail/smtpmail.dpc.php'); //mail 2 send
require_once('agp/pstack.lib.php');
require_once('agp/processInst.lib.php');
require_once("agp/process.dpc.php");

class proc 
{	
	public $env, $envname, $async;
	private $process, $processStack, $startProcess;	
	public static $pdo;	
	
	public function __construct(& $env=null) 
	{	
		$this->env = $env;
		$this->envname = get_class($env);
		
		self::$pdo = $env::pdoConn();

		$this->processStack = array();
		$this->startProcess = array();	
		
		$this->process = null;					
		$this->async = false;		
	}
	
	public function isAsyncProc()
	{
		return $this->async;
	}		
	
	//dmn Println
	public function _echo($msg) 
	{
		$this->env->_echo($msg);
	}
	
	//env interface
	public function pdoQuery($dpc)
	{
		return ($this->env->pdoQuery($dpc));
	}
	
	//env interface
	public function pdoExec($prep, $vals)
	{
		return ($this->env->pdoExec($prep, $vals));
	}	

	//cnf say
	public function _say($msg, $type='TYPE_LION') 
	{
		$this->env->cnf->_say($msg, $type);
	}	
	
	//MUST BE POOLED (async) ...
	
	//add / init
	public function set($cmd=null) //from whom client !!! 
	{
		if (!$cmd) return $this; // fluent //false;
		$this->async = false; //reset
		
		if ($stack = $this->setProcessStack($cmd)) 
		{		
			$this->env->cnf->_say('set new proc: ' . $cmd, 'TYPE_LION');
			//return $this; //fluent
		}
		return $this; //fluent
	}
	
	//reduce saved stack (other proc call)
	public function reduce($reduce=null)  
	{
		if (!$reduce) return false;
		//print_r($reduce);
				
		//fetch from sh mem (another proc call)
		$this->processStack = $this->readProcessStack();
		foreach ($this->processStack as $chain)
		{
			//print_r($chain);
			$df = array_diff($chain, $reduce);
			//print_r($df);	
			if (!empty($df))
				$newStack[] = $chain;
		}	
		
		//save stack
		$this->saveProcessStack(json_encode($newStack));
		//print_r($this->processStack); //has no meanining (new proc)
		
		return $this; //fluent
	}	
	
	public function go($event=null, $inputdata=null) 
	{
		$this->processStack = $this->readProcessStack();
		if (empty($this->processStack)) return false;
		//print_r($this->processStack);
		
		$data = $inputdata;
		foreach ($this->processStack as $p=>$chain)
		{	
		    //print_r($chain);
			$this->process = new process($this, null, $data);
			if ($data = $this->process->isFinished($event)) 
			{   //async escape
				//echo '>PROCESSDATA:'. $data . PHP_EOL;
				$this->env->_say('Process data :' . $data, 'TYPE_IRON');
				
				if ($data=='async') 
				//if ($chain[0]=='async') 
				{
					if (defined('_BELL')) _verbose(_BELL); //echo "\x07"; //beep
					
					$achain = implode('/',$chain) .'/';
					
					//echo '>OPENPROCESS:'. $achain . PHP_EOL;
					$this->env->_say('Open Process:' . $achain, 'TYPE_IRON');
					$this->env->openProcess('process', $chain);
					//tier must return closed chain (server update stack)
					//setvar option
					return false; //one by one async chain
		  		}			
				unset($this->process); 
				//return null;//$data; //true; //////////////test
			}
		}
		//unset($this->process);	
		//return $this; //fluent
		return ($data!=='async') ? $data : null; //true; //////////////test
		//return null;//false;
	}
	
	//private function processStack($processes) 
	private function setProcessStack($cmd) 
	{
		if (!$cmd) return false; 
		
		//piping async/x/y/z|a/b/c/
		if (strstr($cmd, '|')) 
		{
			$ps = explode('|', $cmd);
			foreach ($ps as $pd)
				$pcmd[] = explode('/',$pd);
		}	
		else 
			$pcmd[0] = explode('/',$cmd);		
		
		//print_r($processes);
		foreach ($pcmd as $p)
			$this->processStack[] = array_filter($p);

		$this->startProcess = array_filter($pcmd[0]); //1st !!
	
		//save stack
		$this->saveProcessStack(json_encode($this->processStack));
		//print_r($this->getProcessStack());
		
		return (array) $this->processStack;
	}
	
	public function getProcessStack() 
	{
		//mem alternative !!!
		return $this->readProcessStack();
		//return (array) $this->processStack;
	}

	//!!!
	public function getProcessChain() 
	{	
		//return $this->startProcess[$this->envname];
		return (array) $this->startProcess; //1st
	}	
	
	public function getNextProcessChain() 
	{	
		//mem alternative !!!
		$next = array_shift($this->getProcessStack());	
		//$next = array_shift($this->processStack);
		
		//print_r($next);
		//print_r($this->processStack);
		
		return (array) $next;
	}
	
	private function saveProcessStack($stack=null)
	{		
		//save stack
		$this->env->save('srvProcessStack', $stack);		
		return true;
	}
	
	private function readProcessStack()
	{		
		//read mem stack
		return json_decode($this->env->read('srvProcessStack'), true);		
	}	
	
	//public function free()	
	public function __destruct() 
	{	
        unset($this->async);	
	} 	
}	
?>	