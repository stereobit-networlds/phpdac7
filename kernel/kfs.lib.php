<?php
class kfs {
	
	private $env, $dpcpath;
	
	function __construct(& $env=null) {
		
		$this->env = $env;
		$this->dpcpath = $env->dpcpath;	
	}
	
	public function _readPHP($filename=null) 
	{
		if (!$filename) return false;
		
		$fdata = @file_get_contents($filename);
		
		return $fdata; //stop here
		
		///////////////////////////////////////////////////
		return  (
						  preg_replace("/^<\?php/","<?php",						  
 						  //preg_replace(	
							//'/<<<(\w+).*(\1);/' , "\r\n$0\r\n",
						  //preg_replace(
						    //"/\s\s+/", " ", /* beware spaces at heredocs else err*/
						    preg_replace(
							    "/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", PHP_EOL,
								//preg_replace(	
							    //"/<<<(\w+).*(\1);/" , "\r\n$1\r\n",
								preg_replace( /* comments // without : at back char :* */
								    "/(?<![*:\"'])[ \t]*\/\/.*/", '',
									preg_replace( /* comments * */		
										'!/\*.*?\*/!s', '',
										@file_get_contents($filename)
									)
								)
								//)
							)
						  //)	
						  //)
						  )
				);
    }

	public function read_dpcs() 
	{
        $dpath = $this->dpcpath;
		
		$selections = array('libs');//array('agents','tcp'); 
		//echo '>>>>>>>>>>>>>>>>>>'. realpath($this->dpcpath);
		/*
		foreach (glob("*.php") as $filename) {
			echo "$filename size " . filesize($filename) . "\n";
		}
		*/
	    if (is_dir($dpath)) {
		
          $mydir = dir($dpath);
		 
          while ($fileread = $mydir->read ()) 
		  {
	   
           //read directories
		   //if (($fileread!='.') && ($fileread!='..'))  { //ALL
		   if (in_array($fileread, $selections)) 
		   { 

	          if (is_dir($dpath. DIRECTORY_SEPARATOR .$fileread)) 
			  {

                 $mysubdir = dir($dpath."/".$fileread);
                 while ($subfileread = $mysubdir->read ()) 
				 {	
				 
		           if (($subfileread!='.') && ($subfileread!='..'))  
				   {
                       if ((stristr ($subfileread,".dpc.php")) || 
						   (stristr ($subfileread,".ext.php")) || 
					       (stristr ($subfileread,".lib.php")))  
				           $mydpc[] = $fileread . DIRECTORY_SEPARATOR . $subfileread;								     
				   }
				 }
			  }
		   }
	      }
	      $mydir->close ();
        }
		//echo $dpath,'>';
		//print_r($mydpc);
		return ($mydpc);   
	}
   
	//UNDER CONSTRUCTION: recur
	public function read_extensions() 
	{
        $dpath = $this->dpcpath . "system/extensions";
   
	    if (is_dir($dpath)) {
          $mydir = dir($dpath);
          while ($fileread = $mydir->read ()) 
		  {
		   if (($fileread!='.') && ($fileread!='..'))  
		   {
	          if (is_dir($dpath . DIRECTORY_SEPARATOR . $fileread)) 
			  {
                 $mysubdir = dir($dpath . DIRECTORY_SEPARATOR . $fileread);
                 while ($subfileread = $mysubdir->read ()) 
				 {	
		           if (($subfileread!='.') && ($subfileread!='..'))  
				   {
                       if (stristr ($subfileread,".php")) 
				           $mydpcext[] = 'system/extensions/'.$fileread."/".$subfileread;							     
				   }
				 }
			  }
		   }
	      }
	      $mydir->close ();
        }
		return ($mydpcext);   
   }   	
}	
?>	