<?php

class csv {
	
	public $complete;
	
	public function __construct(& $env) {
		$this->complete = false;

		//initialize async service conf
		$confclass = array_shift($env->_stack); //exclude 'conf' call	
		if (!$conf = new $confclass()) die('Invalid conf parameters!' . PHP_EOL);
		
		if (empty($conf->xmlout)) die("Please specify csvxml file to parse" . PHP_EOL);		
		$logfile = substr($conf->xmlout, 0, -3) . 'csv';
			
		if (!$fp = @fopen ($logfile, "w")) 
			echo "Can't create log file!" . PHP_EOL;
		else
		{	
			if ($etl = $env->runETL($env->_stack)) 
			{
				$countIx = 0;
				$xml = new XMLReader();
				$xml->open($conf->xmlout);
				
				while($xml->read() && $xml->name != 'csv')
				{
					;
				}	
				while($xml->name == 'csv')
				{
					$element = new SimpleXMLElement($xml->readOuterXML());						
					$csvline = $etl->xmltnode($element);
					fwrite ($fp, $csvline . PHP_EOL);
					/*
					$csvline = $element->line;
					$csvid = $element->attributes()->id;
					$log = $scsvid . ':' . $csvline . PHP_EOL;
					echo $log;
					fwrite ($fp, date('Y-m-d h:i').': '.$log);
					*/
					$xml->next('csv');
					unset($element);							
					$countIx++;					
				}		
				echo "Number of lines=$countIx" . PHP_EOL;	
				$xml->close();
				fclose ($fp); 
				echo "Finished!" . PHP_EOL;		
				$this->complete = true;	
			}	
		}	
	}
}
?>