<?php

class img {
	
	public function __construct(& $env) {

		//initialize async service conf
		$confclass = array_shift($env->_stack); //exclude 'conf' call	
		if (!$conf = new $confclass()) die('Invalid conf parameters!' . PHP_EOL);
		
		if (empty($conf->xmlout)) die("Please specify imgxml file to parse" . PHP_EOL);		
		//$xmlhttp = ('http' == substr($conf->xmlfile,0,4)) ? true : false;
		//$xmlname = ($xmlhttp==true) ? time() : str_replace('.xml', '', $conf->xmlfile);
		//$xmlout  = $conf->xmlout ? $conf->xmlout : 'out-'. $xmlname . '.xml';				
		$logfile = substr($conf->xmlout, 0, -3) . 'log';
			
		if (!$fp = @fopen ($logfile, "w")) 
			echo "Can't create log file!" . PHP_EOL;
		elseif (!isset($conf->imgfolder))
			echo "Undefined export folder!" . PHP_EOL;
		else
		{	
			if ($etl = $env->runETL($env->_stack)) 
			{
				//create dest dir
				@mkdir($conf->imgfolder, 0777);
				
				$countIx = 0;
				$xml = new XMLReader();
				$xml->open($conf->xmlout);
				
				while($xml->read() && $xml->name != 'image')
				{
					;
				}	
				while($xml->name == 'image')
				{
					$element = new SimpleXMLElement($xml->readOuterXML());						
					
					$url = $element->url;
					$fn = $element->attributes()->filename;
					$fd = $conf->imgfolder . $fn;					
					if ($imgdata = $etl->xmltnode($element, $conf))
					{
						if (file_put_contents($fd, $imgdata))
							$log = "Saved ($countIx) image ($fn): ". $url . PHP_EOL;
						else
							$log = "Not saved ($countIx) image ($fn): ". $url . PHP_EOL;
					
						echo $log;
						fwrite ($fp, date('Y-m-d h:i').': '.$log);
					}
					else 
					{
						$log = "Exist ($countIx) image: ". $fn . PHP_EOL;
						echo $log;
						fwrite ($fp, date('Y-m-d h:i').': '.$log);
					}	
						
					$xml->next('image');
					unset($element);							
					$countIx++;					
				}		
				echo "Number of images=$countIx" . PHP_EOL;	
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