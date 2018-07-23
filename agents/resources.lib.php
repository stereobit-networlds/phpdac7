<?php
$__DPCSEC['RESOURCES_DPC']='1;1;1;1;1;1;1;1;2';

if (!defined("RESOURCES_DPC")) {
define("RESOURCES_DPC",true);

$__DPC['RESOURCES_DPC'] = 'resources';

class resources {

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
		
			$this->env->update_agent($this,'resources');			
		
			return true;
		}
		elseif (is_resource($resource)) {
			//echo 'RESOURCE resource:'.$rname. '(' . memory_get_usage() .")\n";
			$type = get_resource_type($resource);
			$this->_resources[$rname] = $type;
			$this->_resptr[$type] = & $resource;
		
			$this->env->update_agent($this,'resources');
   
			return true;
		}
		elseif (is_scalar($resource)) {//integer,float,string,boolean
			//echo 'RESOURCE scalar:'.$rname. '(' . memory_get_usage() .")\n";
			$this->_resources[$rname] = $resource;
			$this->_resptr[$rname] = & $resource;	
		
			$this->env->update_agent($this,'resources');			

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
			
			$this->env->update_agent($this,'resources');
			return true;
		}
		
		return false;
	}
   
	//local version
	//name called by stream of server
	public function get_resource($resource=null, $name=null) {
	   if (!$resource) return ($resource . ' undefined!');
	   
	   //print_r($this->_resources); 
	   //print_r($this->_resptr);	    
	    
       //auto get from net 
	   //if no resource or invalid resource...
       if (!array_key_exists($resource, $this->_resources)) {
		   
		    $sres = (substr_compare($resource, "/", 0, 1)==0) ? $resource : '/' . $resource;
			
			//$this->env->_say('remote:['.$this->ip2get.']:'.$resource, 'TYPE_LION');  
			$this->env->_say('resource remote:' . $this->env->ldscheme . $sres, 'TYPE_BIRD');  
		 
			//$r = $this->get_resourcec($resource,$this->ip2get,$this->port2get);
			//get from phpdac5
			if ($r = file_get_contents($this->env->ldscheme . $sres)) {
				
				//$this->env->_say('Resource remote (' .$resource . ') ok!', 'TYPE_BIRD');		
				return $this->set_resource($resource, $r);
			}
			else {
				//$this->env->_say('Resource remote (' . $resource . ' error!', 'TYPE_BIRD');
				return ('undefined');
			}	
	   }
	   else {
		   	$this->env->_say('resource local:'.$resource, 'TYPE_BIRD');

			if ($r = $this->_resources[$resource]) {
				//$this->env->_say('Resource local (' . $resource . ') ok!', 'TYPE_BIRD');
				return ($name ? $r : $this->_resptr[$resource]);
			}
			else {
				//$this->env->_say('Resource local (' . $resource . ') error!', 'TYPE_BIRD');
				return ('undefined');
			}	
	   }	 
		 	    		 	 
	   /* 
	   if ($name!=null)
	     return ($this->_resources[$resource]); 
	   else
		 return ($rp);
	   */ 
	    	 
	   //else search the net for the specified resource.....	 
	   //or..autometed
	   //get it from server (default)
		 
	   return false;	 
   }
   
   //remote version
   public function get_resourcec($resource,$from=null,$port=null) {
   
      $ip = ($from ? $from : $this->ip2get);
	  $po = ($port ? $port : $this->port2get);
	   
      //if (!$port)
	    //$port = '19123';//server port = default connection
		
	  //echo $from,':',$port;
      //get resource
      $f_res = @file_get_contents("phpres5://$ip:$po/" . $resource);
	  
	  $tokens = explode($resource,$f_res);//explode based on word of resource
	  $s_res = $tokens[1];
      //echo '>',$s_res,'<';   
	  
	  //copy it in local resources array
	  if ($r = trim($s_res)) {
	    //$this->create_resource($resource,$r); //PRINTER DLL?????
	    return ($r);
	  }
	  
	  return false;	
   }
   
   public function unset_resource($resource_name) {
   
       //if (in_array($resource_name,$this->_resources))
	     //remove resource by value!!!!!
		 
	   return false;	 
   }
   
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
  
     if (!array_key_exists($resource,$this->_resources)) 
	   return false;
	 else
	   return true;  
  } 
  
  public function findresource($resource,$showname=null) {
  
  
    /* if (!$res=$this->get_resource($resource,$showname)) {//local
  
       $connections = $this->env->show_connections(null,1);
	   //print_r($connections);
	   //echo "---------------\n";
	 
	   if (is_array($connections)) {//remote
	     foreach ($connections as $s=>$sd) {
	       $hosts[] = $sd['host'];
		 
		   if (($sd['host']!='127.0.0.1') && //localhost
		       ($sd['host']!=$this->ip2get) && //bypass remote master
			   ($sd['host']!='192.168.1.35')) {//real self address
	         if ($res = $this->get_resourcec($resource,$sd['host'],$this->daemon_port)) {
		     
		       echo $sd['host'],":",$res,"\r\n"; 		 
			   break;
		     }
		   }  
	     }
	   
	     echo implode("\r\n",array_unique($hosts));	
	   }
	 }//local*/
	 //echo 'zzzzzzzzzz';
	 //$res = $this->get_resourcec($resource,'192.168.1.247','19125');
	 $res = file_get_contents("phpres5://192.168.1.247:19125/" . $resource);
	 
	 
		/*$socket = pfsockopen('192.168.1.247', '19125', $errno, $errstr, 5); 

		if (!$socket) {
		  echo $errstr,"(",$errno,")\n";
		  return false;
		}
		//stream_set_blocking($socket,1);
		$request = "getresource xx" . "\r\n\r\n";		
        fputs($socket, $request); 

        $res = ''; 
        while (!feof($socket)) { 
          $res .= fgets($socket, 1096);
        }  
        fclose($socket);*/  	 
	 
	 _verbose('end');
	 
	 return ($res);
  
  }  
  
};
}
?>