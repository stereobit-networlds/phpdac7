<?php

class xmlnodeloop {
	
	public function __construct(&$env) {

		//initialize async service conf
		$confclass = array_shift($env->_stack); //exclude 'conf' call	
		if (!$conf = new $confclass()) die('Invalid conf parameters!' . PHP_EOL);
		
		if (empty($conf->xmlfile)) die("Please specify xml file to parse" . PHP_EOL);		
		$xmlhttp = ('http' == substr($conf->xmlfile,0,4)) ? true : false;
		$xmlname = ($xmlhttp==true) ? time() : str_replace('.xml', '', $conf->xmlfile);
		$xmlout  = $conf->xmlout ? $conf->xmlout : 'out-'. $xmlname . '.xml';				
			
		if (!$fp = @fopen ($xmlout, "w")) 
			echo "Can't create export file!" . PHP_EOL;
		else
		{
			if ($etl = $env->runETL($env->_stack)) 
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
					
					/*$prod = $conf->nodemain($element);
					$immA = ImmutableC::create()
							->arr($prod)
							->build();
							
					//echo (string) $immA;*/
					
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
		}	
		return false;	
	}
}
?>