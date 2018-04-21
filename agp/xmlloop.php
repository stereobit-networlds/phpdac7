<?php

class xmlloop extends processInst {
	
	protected $caller, $env, $_stack;
	private $xmlhttp, $xmlname, $xmlout, $readnode; 
	
	public function __construct(& $caller, $callerName, $stack=null) {

		parent::__construct($caller, $callerName, $stack);
		$this->processStepName = __CLASS__;
		
		$this->caller = $caller;
		$this->env = $caller->env;
		$this->_stack = $stack['kernel'];
		array_shift($this->_stack); //exclude self 'async' call
		
		$pid = $this->getChainId(); //next
		echo "process xmlloop ({$this->_stack[$pid]}): ". $this->caller->status . PHP_EOL;
		
		//initialie xml service conf		
		include_once($this->_include("tier/imot.lib.php"));
		include_once($this->_include("vendor/process/xml/xmlconf.php"));		
		$this->loader('vendor/process/xml/');
		
		if(empty($xmlfile))
			die("Please specify xml file to parse.\n");

		$this->readnode = $node; //conf var
		$this->xmlhttp = ('http' == substr($xmlfile,0,4)) ? true : false;
		$this->xmlname = ($xmlhttp==true) ? time() : str_replace('.xml', '', $xmlfile);
		$this->xmlout  = 'vendor/process/xml/out/out-'. $xmlname . '.xml';				
	}
	
	//override
	protected function go($data=null) {
		if (!$fp = @fopen ($this->xmlout, "w")) 
			echo "Can't create export file!" . PHP_EOL;
		else
		{
			$etl = $this->runETL($this->_stack);
			
			if (is_object($etl)) 
			{
				$countIx = 0;
				$xml = new XMLReader();
				$xml->open($this->xmlfile);
					
				while($xml->read() && $xml->name != $this->readnode)
				{
					if (($xml->name == 'created_at') && 
						($date = $xml->readInnerXML())) 
					{
						$immDate = ImmutableC::create()
								->set('date-created', strval(date('Y-m-d h:i')))
								->set('last-update', strval($date))
								->build();
						
						if ($fp) 
							fwrite ($fp, (string) $immDate . PHP_EOL); 				
					}
				}	
				while($xml->name == $this->readnode)
				{
					$element = new SimpleXMLElement($xml->readOuterXML());
					$prod = _main($element);
					/*$immA = ImmutableC::create()
							->arr($prod)
							->build();
							
					//echo (string) $immA;*/	
					$etl->xmltnode(_main($element));
					
					if ($fp) 
						fwrite ($fp, (string) $immA . PHP_EOL);
					
					$xml->next($this->readnode);
					unset($element);							
					$countIx++;					
				}		
					
				/*for($i=1;$i<=10;$i++) {
				
				$immX = ImmutableC::create()
							->set('test', 'a string goes here:' . $i)
							->set('another', 100)
							->arr([1,2,3,4,5,6])
							->arr(['a' => 1, 'b' => 2])
							->build();
				echo 'asyncloop:' . $immX . PHP_EOL;				
				
				$etl->writeText('['.$i.']' . $str, $immX);//$str);
				}*/
			}
			return true;
		}	
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