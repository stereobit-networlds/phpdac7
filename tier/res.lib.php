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

class res {

	var $_resources, $_resptr;
	var $ip2get, $port2get;
	var $env;
	var $daemon_port;

	public function __construct($env=null) {
   
		$this->env = $env;
   
		$this->_resources = array();   
		$this->_resptr = array();	
	  
		$this->ip2get = $env->phpdac_ip; 
		$this->port2get = $env->phpdac_port;  
		$this->daemon_port = $env->daemon_port;
	}
  
	public function set_resource($rname,$resource) {
   
		//in case of resource name with spaces
		$rname = str_replace(' ','_',$rname);

		if (is_object($resource)) {
			//echo 'RESOURCE object:'.$rname. '(' . memory_get_usage() .")\n";
			$this->_resources[$rname] = serialize($resource);//serialized object???
			$this->_resptr[$rname] = & $resource;//object instance		
		
			return true;
		}
		elseif (is_resource($resource)) {
			//echo 'RESOURCE resource:'.$rname. '(' . memory_get_usage() .")\n";
			$type = get_resource_type($resource);
			$this->_resources[$rname] = $type;
			$this->_resptr[$type] = & $resource;
		
			return true;
		}
		elseif (is_scalar($resource)) {//integer,float,string,boolean
			//echo 'RESOURCE scalar:'.$rname. '(' . memory_get_usage() .")\n";
			$this->_resources[$rname] = $resource;
			$this->_resptr[$rname] = & $resource;	

			return $resource; //true;
		}
	  
		$this->env->_say("resource [$rname] failed to register!", 'TYPE_LION');
		return false;
	}
   
	//delete local resource
	public function del_resource($resource) {
   
		if (@array_key_exists($resource, $this->_resources)) {
	 
			$this->env->_say('resource delete:'.$resource, 'TYPE_BIRD');
			
			unset($this->_resources[$resource]);
			unset($this->_resptr[$resource]);

			return true;
		}
		
		return false;
	}
	
	//alias
    public function unset_resource($resource) {
   
	   return $this->del_resource($resource);	 
    }	
   
	public function get_resource($resource=null, $name=null) {
		if (!$resource) return false;
	   
		if (!array_key_exists($resource, $this->_resources)) {
		   
		    $sres = (substr_compare($resource, "/", 0, 1)==0) ? $resource : '/' . $resource;
			
			$this->env->_say('res remote:' . $this->env->ldscheme . $sres, 'TYPE_BIRD');  
		 
			//get from phpdac5
			if ($r = file_get_contents($this->env->ldscheme . $sres)) {
			 
				//$this->env->_say('Res remote (' .$resource . ') ok!', 'TYPE_BIRD');		
				return $this->set_resource($resource, $r);
			}
			else {
				//$this->env->_say('Res remote (' . $resource . ' error!', 'TYPE_BIRD');
				return false;
			}	
		}
		else {
		   	$this->env->_say('res local:'.$resource, 'TYPE_BIRD');

			if ($r = $this->_resources[$resource]) {
				//$this->env->_say('Res local (' . $resource . ') ok!', 'TYPE_BIRD');
				return ($name ? $r : $this->_resptr[$resource]);
			}
			else {
				//$this->env->_say('Res local (' . $resource . ') error!', 'TYPE_BIRD');
				return false;
			}	
		}	 
		 
		return false;	 
	}
   
	//experimental
	public function create_resource($resource_name,$resource_string) {
   
      switch ($resource_name) {
	  
	    case 'printer' : $resource = printer_open($resource_string);//true;
	                     if (is_resource($resource) &&
		                   get_resource_type($resource)=='printer') {
	                       printer_set_option($resource, PRINTER_MODE, 'RAW'); 
		                   //echo ">>>>>>>>>>>>",$resource_string,">>>>\n";
		                  // $this->set_resource($resource_string,$resource);
	                     }	
		                 break; 
		
		case 'odbc link':				 
		case 'odbc link persistent' : _verbose('zzz'); break;
		
		case 'sqlite'  : $db_name = $this->get_resource('sqlite_name');
		                 $resource = new SQLiteDatabase($db_name, 0666, $sqliteerror);				  
						 if ($sqliteerror) _verbose('ERROR:' . $sqliteerror . PHP_EOL);
						 
		default        : //scalar
		                 //if (is_scalar($resource_string))
		                   //$this->set_resource($resource_name,$resource_string);	
						   
						 //DO NOTHING....  
						   			 
	  }
	  
	  return ($resource);
	} 
   
	//show the resources running ........ 
	public function showresources($ptr=false) {
		//print_r($this->_resources);
	
		if ($ptr) {
			foreach ($this->_resources as $t=>$d) {
				//$ret .= "[" . $t . "]\r\n";
				$ret .= $t . "=" . $d;
				if (is_object($this->_resptr[$t]))
					$ret .= " (object) " . get_class($this->_resptr[$t]) . PHP_EOL;
				else
					$ret .= " (scalar) " . $this->_resptr[$t] . PHP_EOL;
			}  
     
			return ($ret);  
		}
		//else
		foreach ($this->_resources as $rname=>$rdata) 
		{
			$this->env->_say($rname . "\t" . strlen($rdata), 'TYPE_IRON');
		}
		return true;		 
	} 
  
	public function has_resource($resource) {
  
		return (array_key_exists($resource,$this->_resources));
	} 
  
	//experimental
	public function findresource($resource,$showname=null) {
	 
		return false;
	}  
}
?>