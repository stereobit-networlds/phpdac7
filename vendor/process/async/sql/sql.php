<?php

class sql {
	
	public function __construct(& $env) {

		//initialize async service conf
		$confclass = array_shift($env->_stack); //exclude 'conf' call	
		if (!$conf = new $confclass()) die('Invalid conf parameters!' . PHP_EOL);
		
		if (empty($conf->xmlout)) die("Please specify sqlxml file to parse" . PHP_EOL);		
		$logfile = substr($conf->xmlout, 0, -3) . 'sql';
			
		if (!$fp = @fopen ($logfile, "w")) 
			echo "Can't create log file!" . PHP_EOL;
		else
		{	
			if ($etl = $env->runETL($env->_stack)) 
			{				
				$countIx = 0;
				$xml = new XMLReader();
				$xml->open($conf->xmlout);
				
				while($xml->read() && $xml->name != 'sql')
				{
					;
				}	
				while($xml->name == 'sql')
				{
					$element = new SimpleXMLElement($xml->readOuterXML());						
					$sqlquery = $etl->xmltnode($element);
					fwrite ($fp, $sqlquery . PHP_EOL);
					/*
					$sqlquery = $element->query;
					$sqlid = $element->attributes()->id;
					$log = $sqlid . ':' . $sqlquery . PHP_EOL;
					echo $log;
					fwrite ($fp, date('Y-m-d h:i').': '.$log);
					*/
					$xml->next('sql');
					unset($element);							
					$countIx++;					
				}		
				echo "Number of queries=$countIx" . PHP_EOL;	
				$xml->close();
				fclose ($fp); 
				echo "Finished!" . PHP_EOL;		
				return true;	
			}	
		}	
		return false;	
	}
}
?>