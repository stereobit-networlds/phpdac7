<?php

class asyncloop extends processInst {
	
	protected $caller, $env, $nextCmd;
	public $_stack;
	
	public function __construct(& $caller, $callerName, $stack=null) {

		parent::__construct($caller, $callerName, $stack);
		$this->processStepName = __CLASS__;
		
		$this->caller = $caller;
		$this->env = $caller->env;
		$this->_stack = $stack['kernel'];

		$pid = $this->getChainId(); //next
		$this->nextCmd = $this->_stack[$pid];
		echo "process asyncloop ( $this->nextCmd ): ". $this->caller->status . PHP_EOL;
		
		include_once($this->_include("tier/imot.lib.php"));
		$this->loader("vendor/process/async/xmlnode/");
	}
	
	//override
	protected function go($data=null) {
		if (!$this->env->ldscheme) 
		{	
			//is srv call, dont exec
			echo "--------- tier go()!!" . PHP_EOL;
			return false;
		}
		$async = array_shift($this->_stack); //exclude self 'async' call	
		return new xmlnodeloop($this);
		
		//initialize async service conf
		/*$confclass = array_shift($this->_stack); //exclude 'conf' call	
		if (!$conf = new $confclass()) die('Invalid conf parameters!' . PHP_EOL);
		
		if (empty($conf->xmlfile)) die("Please specify xml file to parse" . PHP_EOL);		
		$xmlhttp = ('http' == substr($conf->xmlfile,0,4)) ? true : false;
		$xmlname = ($xmlhttp==true) ? time() : str_replace('.xml', '', $conf->xmlfile);
		$xmlout  = $conf->xmlout ? $conf->xmlout : 'out-'. $xmlname . '.xml';				
			
		if (!$fp = @fopen ($xmlout, "w")) 
			echo "Can't create export file!" . PHP_EOL;
		else
		{
			if ($etl = $this->runETL($this->_stack)) 
			{
				$countIx = 0;
				$xml = new XMLReader();
				$xml->open($conf->xmlfile);
				
				$immDateC = ImmutableC::create()
								->set('date-created', strval(date('Y-m-d h:i')))
								->build();		
				fwrite ($fp, (string) $immDateC . PHP_EOL); 
				
				while($xml->read() && $xml->name != $conf->xmlnode)
				{
					if (($xml->name == $conf->xmldate) && ($date = $xml->readInnerXML())) 
					{
						$immDateU = ImmutableC::create()
										->set('last-update', strval($date))
										->build();
						fwrite ($fp, (string) $immDateU . PHP_EOL); 				
					}
				}	
				while($xml->name == $conf->xmlnode)
				{
					$element = new SimpleXMLElement($xml->readOuterXML());	
					
					//$prod = $conf->nodemain($element);
					//$immA = ImmutableC::create()
						//	->arr($prod)
							///->build();
							
					//echo (string) $immA;
					
					$prod = $etl->xmltnode($conf->nodemain($element));
					fwrite ($fp, (string) $prod . PHP_EOL);
					
					$xml->next($conf->xmlnode);
					unset($element);							
					$countIx++;					
				}		
				echo "Number of items=$countIx" . PHP_EOL;	
				$xml->close();
				fclose ($fp); 
				echo "Finished!" . PHP_EOL;		
				return true;	
			}	
		}*/	
		return false;
	}
 
	//override
	public function nextStep($event=null) {
		return parent::nextStep($event);
	}
	
	//override
	public function prevStep($event=null) {
		return parent::prevStep($event);
	}	
	
	//override
	public function isFinished($event=null, $data=null) {
		
		if (!parent::isFinished($event)) {
			//$this->stackRunStep();
			return false;
		}	
		
		if ($this->runCode(0, $event)) {
			
			$this->stackRunStep(1);
			//return true;
			return ($this->go($data));
		};
		
		//$this->stackRunStep();		
		return false;		
	}	

}
?>