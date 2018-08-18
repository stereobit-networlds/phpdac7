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

class agn {

	private $env;
	public $agent, $active_agent, $active_o_agent;

	public function __construct($env=null) {
   
		$this->env = $env;
   
		$this->active_agent = null;
		$this->active_o_agent = null;	
		$this->agent = 'SH'; //default		
	}
   
	//read file of agents to initialize
	public function init_agents() 
	{    
	   $f = $this->env->ldscheme . "/tier/tierds.ini";			
	   $this->env->_say('Init agents file: ' . $f, 'TYPE_LION');
	   
	   $code = @file_get_contents($f);
	   if (isset($code))
	   {
		    $file = explode(PHP_EOL, $code);
		   
			//clean code by nulls and commends
			foreach ($file as $num=>$line) 
			{
				if ($trimedline = trim(str_replace(array("\r", "\n", ';'), '', $line)))
					if ($trimedline[0]!="#") //comment          
						$lines[] = $trimedline;
			}
			
			//print_r($lines);
			//$toktext = implode("",$lines); //one line may have more than one cmds sep by ;
			//$token = explode(";",$toktext);	//tokenize	  			
	        foreach ($lines as $tid=>$tcmd) 
			{  
			   //echo $tcmd .PHP_EOL;
			   $part = explode(' ', $tcmd);
			   
			   switch ($part[0]) {	
			   
			     case 'system':	//run system cmds
				                $name = explode(".",trim($part[0]));
				                break;				  
								
			     case 'schedule': //run scheduled cmds
				                $this->get_agent('scheduler')->schedule($part[1],$part[2],$part[3]); 
				                break;
								
				 case 'library' : if ($part[1]) 
				                {
								  $name = explode(".",trim($part[1]));
								  $this->create_agent($name[1],$name[0],null,null,'lib',false);
								} 
				                break; 

				 case 'include' : if ($part[1]) 
								{
								  $name = explode(".",trim($part[1]));
								  $this->create_agent($name[1],$name[0],null,null,'lib',true);
								} 
				                break;								
							  
				 default      : //create agents  
			  		            if ($part[0]) 
								{
								  $name = explode(".",trim($part[0]));
								  $this->create_agent($name[1],$name[0]);//$part[1]);-RESIDENT disbaled
								} 
				                
			   }
			   $i+=1;
			   //echo $i .'-----['. $tcmd .']-----' . PHP_EOL;
	        }	 
			return true;
	   }
	   
	   return false;
	}  
   
	public function create_agent($agent,$domain=null,$include_ip=null,$as_name=null,$type='dpc',$includeonly=false) 
	{
		global $__DPC;  
		$dpc = $domain ? $domain : 'agents';
		$class = strtoupper($agent).'_DPC';	  
		//echo $class;
	  
		if (defined($class)) 
		{
			$this->env->_say($agent . " exists!", 'TYPE_IRON');
			return true;
		}	  
	  
		if (isset($include_ip))
			require("phpdac5://$include_ip:". $this->env->phpdac_port . "/$dpc/$agent" .'.'. $type.'.php');    
		else 
			require($this->env->ldscheme . "/$dpc/$agent" . '.'. $type.'.php');    
	  
		if (($type=='lib') && ($includeonly)) 
		{
			$this->env->_say('include library: '.$agent, 'TYPE_LION');
			return true;
		}	  
	  
		$class = strtoupper($agent).'_DPC';	 
		//echo $class;
		if ((defined($class)) && (class_exists($__DPC[$class])) ) 
		{
			try 
			{
				$o_agent = new $__DPC[$class]($this->env);
		  		  
				if (is_object($o_agent)) 
				{ 
					$s_agent = serialize($o_agent); 
			
					if (isset($as_name)) 
					{
						if ( $_m = $this->env->mem->add($as_name,$s_agent))
							$this->env->_say("Create agent [$agent] as $as_name", 'TYPE_LION');
					}
					else {
						if ($_m = $this->env->mem->add($agent,$s_agent))
							$this->env->_say("Create agent [$agent]", 'TYPE_LION');
					}  
 
					return $_m; //true;
				}
				else 
					$this->env->_say("loading agent [$agent] failed!", 'TYPE_LION');		  
			}
			catch (Exception $e) {
				//serialize err !!
				$this->env->_say("Agent [$agent] failed to initialize", 'TYPE_LION');
			} 
		}

		return false;	 	   
	} 
   
	public function destroy_agent($agent) 
	{
		$o_agent = $this->get_agent($agent);
	  
		//seems to load the 1st agent in case of invalid agent name   
		if (is_object($o_agent) && ($this->active_agent != $agent)) {   
     
			if ($this->env->mem->removememagn($agent)) 
			{
				$o_agent->destroy();
				unset($this->env->mem->agn_attr[$agent]);//RESIDENT ATTRIBUTE
				
				$this->env->_say("[$agent] destroyed", 'TYPE_LION');
				return true;
			}	
			else 
			{
				$this->env->_say("[$agent] NOT destroyed!", 'TYPE_LION');			
				return false;
			}	
		}
		//else
		$this->cnf->_say("Invalid object or agent is active!", 'TYPE_LION');
	}
   
	//update the object data in shared mem
	public function update_agent(&$o_agent, $agent=null) 
	{	
		//$o_agent = $this->get_agent($agent); //!!!!!!!!!!!!!
	
		if ($this->env->mem->agn_mem_type==2)
		{
			if (is_object($o_agent)) // is object !!!
			{		
				if ($agent)
				{	
					$s_agent = serialize($o_agent);
					
					if ($_m = $this->env->mem->upd($agent, $s_agent))
					{
						$this->env->_say("update agent [$agent] ", 'TYPE_LION');	
						return true;
					}
					else
						$this->env->_say("update agent [$agent] failed:" . $length, 'TYPE_LION');
						
				}
				else
					$this->env->_say("update agent [$agent] has no id!", 'TYPE_LION');
			}
			else
				$this->env->_say("Update agent [$agent] is not an object:" . gettype($o_agent), 'TYPE_LION');
		}
		else  //1/0
		{
			//var_dump($this->agn_addr);
			//var_dump($this->agn_length);	  
			//echo "\n",$this->agn_mem_store,"\n",strlen($this->agn_mem_store),"\n";   
			//echo "\n,.",strlen($this->shared_buffer),$this->shared_buffer;
	   
			if (is_object($o_agent)) 
			{
				$old_agent = $this->get_agent($agent,true);
          
				//$o_agent->env = $this;
				$s_agent = serialize($o_agent);    
		  
				//if (strlen($old_agent)!=strlen($s_agent)) 
				//{
				if (strcmp($old_agent,$s_agent)) 
				{
					//echo '+++++',strcmp($old_agent,$s_agent),'++++'; 
		  
					//1st method
					//$this->updatememagn($agent,$s_agent);
		  
					//2nd method
					//remove and then insert 2ND METHOD
					//echo  strlen($this->agn_mem_store),">>>>>\n";			
					$removed = $this->env->mem->removememagn($agent);
					//echo  strlen($this->agn_mem_store),">>>>>\n";
					if ($removed) 
					{		  
						$this->env->mem->add($agent,$s_agent);
						
						$this->env->_say("Update agent [$agent]", 'TYPE_LION');			
						return true;
					}
					else
						$this->env->_say("Update agent [$agent] failed!", 'TYPE_LION');
				}
				else
					$this->env->_say("Update agent [$agent] not neccesery!", 'TYPE_LION');	 
			}
			else
				$this->env->_say("Update agent [$agent] is not an object!", 'TYPE_LION');		  		
		}
		
		return false;
	} 
   
	//return object pointer of agent OR serialized string of agent
	public function get_agent($agent, $serialized=null) 
	{
		if (!$agent)
		{
			$this->env->_say("getAgent id not defined! ", 'TYPE_LION');
			return false;
		}	
		
		if ($this->env->mem->agn_mem_type==2)
		{
			$mem = & $this->env->mem->agn_addr[$agent];
			$length = $this->env->mem->agn_length[$agent];
			$free = $this->env->mem->agn_free[$agent];
			
			if ($free>0) 
			{
				if ($s_agent = $mem->read(0,$length)) 
				{				
					if (!$serialized) 
					{
						$o_agent = unserialize($s_agent);
	  
						//auto update
						$o_agent->env = &$this->env;
						//echo "get_agent($size):" . get_class($o_agent) . '(' . memory_get_usage() .")\n";
		  
						$this->env->_say("getAgent [$agent]: " . $length, 'TYPE_LION');
						return ($o_agent);
					}
					
					$this->env->_say("getAgent [$agent] serialized: " . $length, 'TYPE_LION');
					return ($s_agent);
				}
				
				$this->env->_say("getAgent [$agent] read error:" . $length, 'TYPE_LION');		  
				return false;
			}
			
			$this->env->_say("getAgent [$agent] free error " . $length, 'TYPE_LION');		  
			return false;
		}
		else //1
		{	
			//echo $agent,"\n>>>>>>>>>>>>>";
			if (isset($this->env->mem->agn_addr[$agent])) 
			{
				if ($this->env->mem->agn_mem_type==1) 
				{
					$a_index = $this->env->mem->agn_addr[$agent];
					$a_size = $this->env->mem->agn_length[$agent];
					//echo $a_index,':',$a_size,"\n";	
				
					$s_agent = shmop_read($this->env->mem->agn_shm_id,$a_index,$a_size); 
				}	
				else 
				{
					$a_index = $this->env->mem->agn_addr[$agent];
					$a_size = $this->env->mem->agn_length[$agent];
					//echo $a_index,':',$a_size,"\n";				
				
					$s_agent = substr($this->env->mem->agn_mem_store,$a_index,$a_size);		
				}  
				//echo '>',$s_agent,'<',strlen($s_agent); 

				if ($serialized) 
				{
					//auto update ?????  
					return ($s_agent);
				}
				else 
				{  
					$size = strlen($s_agent);
					$o_agent = unserialize($s_agent);
	  
					//auto update
					$o_agent->env = &$this->env;
		  
					//echo "get_agent($size):" . get_class($o_agent) . '(' . memory_get_usage() .")\n";
					return ($o_agent);
				}  
			}
	    }
		
		return null;	   
	}    
   
	//call agent's methods from cmd line!!!
	public function call_agent($agent,$daemon) 
	{
		$o_agent = $this->get_agent($agent);
	  
        //seems to load the 1st agent in case of invalid agent name   
	    if (is_object($o_agent)) 
		{
			//$daemon->changePrompt($agent.">");   
			if (method_exists($o_agent,'iam')) 
				$ret = $o_agent->iam();
			else 
				$ret = "Ok!";
    
			$this->active_o_agent = $o_agent;
			//var_dump(get_class_methods($this->active_o_agent));
			$this->active_agent = $agent;
			$daemon->changePrompt($agent . '>');
		
			$ret = implode(".", get_class_methods($this->active_o_agent)) . "\n";
	    }
	    else 
			$ret = "Invalid agent!";	
	
		return ($ret);	      
	}
   
	//uncall agent from cmd
	public function uncall_agent($daemon=null) 
	{
		if (is_object($this->active_o_agent)) 
		{   
			$this->active_o_agent = null;
			$this->active_agent = null;		
			$ret = "Ok!";				

			if (is_object($daemon))
				$daemon->changePrompt($daemon->promptString);	
		}
		else
			$ret = "Invalid agent!";	
		
		return ($ret);			  
	}
   
	//call agent from sh mem buffer (client version)
	//use local
	public function call_agentc($agent) 
	{	
		$s_agent = $this->get_agent($agent,1);
	  
	    //delete agent from host
		/*if ($this->agn_attr[$agent]!='RESIDENT') //???
			$this->destroy_agent($agent);
	  	*/  
	    return ($s_agent);
	}
   
	//send agent to other agent station
	public function move_agentc($agent,$to) 
	{
	}   
   
	//accept agent from other agent station
	//$from = ip:port
	public function accept_agentc($agent, $from=null, $include=null) 
	{
		//get agent
		$f_agent = file_get_contents("phpagn5://$from:19125/" . $agent);//call callagentc from $from
		$s_agent = substr($f_agent,68,strlen($f_agent)-68-1);//header of daemon OFF
		$this->env->_say('>'.$s_agent.'<', 'TYPE_BIRD');
		/*for ($i=0;$i<68;$i++) 
		{
			echo ord($f_agent{$i}),'.';
			$x .= $f_agent{$i};
		}	
		echo $x;*/
	  
		if (isset($s_agent)) 
		{
			//MUST BE INCLUDED TO UNSERIALZE OBJECTS
			if (!isset($include)) 
			{
				$inc = isset($from) ? $from : $this->env->phpdac_ip;
			}   
			require("phpdac5://$inc:{$this->env->phpdac_port}/" . "agents/$agent.dpc.php");
	  	  
			$o_agent = unserialize($s_agent);	  
      
			if (is_object($o_agent)) 
			{
				//$daemon->changePrompt($agent.">");   
				$ret = (method_exists($o_agent,'iam')) ?
								$o_agent->iam() : "Ok!";
		  
				$this->env->mem->add($agent,$s_agent); 
			}
			else
				$ret = "Invalid agent!";	
		}
		else
			$ret = "Invalid agent!";	
	  			
	  return ($ret);	   
	}
   
	public function show_agents() 
	{
		if (!is_array($this->env->mem->agn_addr)) return -1;
	  
		//var_dump($this->agn_addr);	  
		//var_dump($this->agn_length);  
		$xi = 0;
		foreach ($this->env->mem->agn_addr as $agn=>$addr) 
		{	
			$xi+= 1;
			
			if ($this->env->mem->agn_mem_type==2) 
			{
				$mem = & $addr;
				$length = $this->env->mem->agn_length[$agn];
				$free = $this->env->mem->agn_free[$agn];
				$s_agent = $mem->read(0,$length);
			}
			else 
			{

				/*if ($this->agn_mem_type==2) 
					$s_agent = shmop_read($this->shm_id,$addr,$this->agn_length[$agn]);  
				else*/if ($this->env->mem->agn_mem_type==1) 
					$s_agent = shmop_read($this->env->mem->agn_shm_id,$addr,$this->env->mem->agn_length[$agn]);  
				else 
					$s_agent = substr($this->env->mem->agn_mem_store,$addr,$this->env->mem->agn_length[$agn]);  		
 
				$this->env->_say($this->env->mem->agn_addr[$agn].":".$this->env->mem->agn_length[$agn], 'TYPE_BIRD');
				//echo $s_agent,"\n";
			}
		   
			$o_agent = unserialize($s_agent);	
		
			if (is_object($o_agent)) 
			{
				//$daemon->changePrompt($agent.">");   
				/*$ret .= (method_exists($o_agent,'iam')) ?
							$o_agent->iam()."\t" : $agn." Ok!"."\t";*/
				if (method_exists($o_agent,'iam')) 
				{			
					$this->env->_say($o_agent->iam(), 'TYPE_IRON');
					//$this->env->_say("agent [$agn] ok!", 'TYPE_IRON');
				}	
				else
					$this->env->_say($agn . ' ok!', 'TYPE_IRON');
			}
			else
				//$ret .= "Invalid agent [$agn]!\t";	
				$this->env->_say("Invalid agent [$agn]", 'TYPE_LION');
	    
		}

		return $xi; //($ret);
	}
}