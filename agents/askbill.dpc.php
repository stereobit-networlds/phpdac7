<?php
if (!defined("ASKBILL_DPC")) {
define("ASKBILL_DPC",true);

$__DPC['ASKBILL_DPC'] = 'askbill';

//require_once("phpdac5://localhost:19123/askbill/gengtk.gtk.php");
//require_once("askbill/mbox.gtk.php");
//require_once("askbill/excel.lib.php");

class askbill {  
   
   var $action;
   var $path;
   var $proj;


   function askbill($env=null) {	
      global $argv; 
	  
	  $this->proj = null;  
	  $this->path = null;
	  
	  $this->env = $env;
	  
    /*if (!class_exists('gtk')) {	  
      if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') 
        dl('php_gtk.dll'); 
      else 
        dl('php_gtk.so');   
	  }	*/
   
      //define ('STDIN',fopen("php://stdin","r"));
   }  

   function render($arg1=null,$arg2=null,$arg3=false) {      	   
	   $executed = false;

	   while (!0) { 

          echo $this->proj."ASKBILL $>"; 

		  //$this->action = trim(fgets(STDIN,256)); //echo $action;
		  if (($arg1) && (!$executed)) {
			  //echo $cmd . "----\n";
			  $command = array($arg1,$arg2,$arg3); 
			  //print_r($command);
			  $this->action = $arg1; //$command[0];
			  $executed = true;
		  }
		  else {//echo $i++ , $arg1 , $arg3, $executed;
		      if ($arg3) break; //exit code for arg3
			  
              $command = explode(" ",trim(fgets(STDIN,256)));
			  $this->action = $command[0]; 
		  }
  
          switch ($this->action) {
			  
		   case 'http' :
				//require_once($this->env->ldscheme . "/tcp/saslclient.lib.php");
				//require_once($this->env->ldscheme . "/tcp/httpclient.lib.php");
				//include at agents.ini
				$http=new httpclient($this->env);
				$http->timeout=0;
				$http->data_timeout=0;
				$http->debug=1;
				$http->html_debug=1;				
				$http->user_agent="Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
				$http->follow_redirect=0;
				$http->prefer_curl=0;
				$user="info@e-basis.gr";
				$password="basis2012!@";
				$realm="";       /* Authentication realm or domain      */
				$workstation=""; /* Workstation for NTLM authentication */
				$authentication=(strlen($user) ? UrlEncode($user).":".UrlEncode($password)."@" : "");
				
				$url="http://".$authentication.$command[1];//"www.php.net/";
				
				$error=$http->GetRequestArguments($url,$arguments);

				if(strlen($realm))
					$arguments["AuthRealm"]=$realm;

				if(strlen($workstation))
					$arguments["AuthWorkstation"]=$workstation;

				$http->authentication_mechanism=""; // force a given authentication mechanism;
				$arguments["Headers"]["Pragma"]="nocache";
				
				echo "Opening connection to:\n",HtmlSpecialChars($arguments["HostName"]),"\n";
				flush();
				$error=$http->Open($arguments);
				
	if($error=="")
	{
		echo "Sending request for page:\n";
		echo HtmlSpecialChars($arguments["RequestURI"]),"\n";
		if(strlen($user))
			echo "\nLogin:    ",$user,"\nPassword: ",str_repeat("*",strlen($password));
		echo "\n";
		flush();
		$error=$http->SendRequest($arguments);
		echo "\n";

		if($error=="")
		{
			echo "Request:\n\n".HtmlSpecialChars($http->request)."\n";
			echo "Request headers:\n\n";
			for(Reset($http->request_headers),$header=0;$header<count($http->request_headers);Next($http->request_headers),$header++)
			{
				$header_name=Key($http->request_headers);
				if(GetType($http->request_headers[$header_name])=="array")
				{
					for($header_value=0;$header_value<count($http->request_headers[$header_name]);$header_value++)
						echo $header_name.": ".$http->request_headers[$header_name][$header_value],"\r\n";
				}
				else
					echo $header_name.": ".$http->request_headers[$header_name],"\r\n";
			}
			echo "\n";
			flush();

			$headers=array();
			$error=$http->ReadReplyHeaders($headers);
			echo "\n";
			if($error=="")
			{
				echo "Response status code:\n".$http->response_status;
				switch($http->response_status)
				{
					case "301":
					case "302":
					case "303":
					case "307":
						echo " (redirect to ".$headers["location"].")\nSet the follow_redirect variable to handle redirect responses automatically.";
						break;
				}
				echo "\n";
				echo "Response headers:\n\n";
				for(Reset($headers),$header=0;$header<count($headers);Next($headers),$header++)
				{
					$header_name=Key($headers);
					if(GetType($headers[$header_name])=="array")
					{
						for($header_value=0;$header_value<count($headers[$header_name]);$header_value++)
							echo $header_name.": ".$headers[$header_name][$header_value],"\r\n";
					}
					else
						echo $header_name.": ".$headers[$header_name],"\r\n";
				}
				echo "\n";
				flush();

				echo "Response body:\n\n";
				/*You can read the whole reply body at once or
				block by block to not exceed PHP memory limits.
				*/
				/*
				$error = $http->ReadWholeReplyBody($body);
				if(strlen($error) == 0)
					echo HtmlSpecialChars($body);
				*/

				for(;;)
				{
					$error=$http->ReadReplyBody($body,1000);
					if($error!=""
					|| strlen($body)==0)
						break;
					echo $body;//HtmlSpecialChars($body);
				}

				echo "\n";
				flush();
			}
		}
		$http->Close();
	}
	if(strlen($error))
		echo "Error: ",$error,"\n";
                //MEM ALLOC ERROR (intime)
				//$this->env->get_agent('resources')->set_resource('httpvar',$body);
                break;	

				
			  
		   case 'printipp' : 	 
		   
		        require_once($this->env->ldscheme . "/tcp/PrintIPP.lib.php");
				
				if ($text = $command[1]) {						
				    $ipp = new PrintIPP();
					//$ipp = new \LIB\tcp\PrintIPP();

					//$ipp->setUnix();

					$ipp->setHost($command[2] ? $command[2] : 'www.e-basis.gr');
					$ipp->setPort($command[3] ? $command[3] : 80);

					//$ipp->setPrinterUri("ipp://localhost:631/printers/Parallel_Port_1");
					//$ipp->setPrinterUri("http://www.stereobit.gr/e-Enterprise.printer");
					$ipp->setPrinterUri("http://www.e-basis.gr/e-Enterprise.printer");

					$ipp->setData($text);
					//$ipp->setUserName('info@e-basis.gr');

					//$ipp->setCharset('utf-8');
					//$ipp->setLanguage($language);

					//$ipp->setAuthentication('info@e-basis.gr','basis2012!@');

					echo "printing job: ", $ipp->printJob(), "\n";
					unset($ipp);
				}
				else
					echo "No text specified.\n";
			               break;
						   
           case 'level'  : $ret = $this->userLevelID; break;
           case 'ver'    : $ret =  'shell script engine V0.01 on PHP'. phpversion(); break;
		   case 'time'   : 
           case 'date'   : $ret = date("d-M-Y H:i:s", time()); break;
           case 'foo'    : $ret = 'bar'; break;	
           case 'q'      : $this->quit();		   
		   case 'quit'   :			 
							//exit(); break;
							break(2);

		   case 'mis'    : $ret = $this->exportCrystalReportToPDF($command[1],$command[2]); break;		   
		   case 'explore': $ret = $this->iexplorer($command[1]); break;
		   case 'supply' : $ret = $this->search_excel($command[1]); break;	
		   	   					   
			   
           default       : //$ret = $this->exe_project($command[0]);
		                   //$ret = $this->search_excel($command[0]);
						   
						   $ret = shell_exec($command[0]);
          }		
		  
		  if ($ret) echo $ret . "\n";  
       }
   } 
   
   function quit() {
   
       fclose(STDIN);
	   die("\nAskbill died!\n");
   }
   
   function use_project($path,$proj) {   
   
      if (is_dir($path.$proj)) {

        $this->path = $path;
		$this->proj = $proj;	
		
		//unset ($this->project); //if is any
		//$this->project = new startup($this->path,$this->proj); 
		
		$ret = 'Done!';
	  }
	  else
	    $ret = 'NOT Done!!!';
		
	  return ($ret);	
   }
   
   function exe_project($cmd) {
   
    /*  if ((isset($this->path) && isset($this->proj)) &&
	      (is_dir($this->path.$this->proj)) && ($cmd)) { 
	  
	    //echo $this->path,$this->proj,'<<<<<';
        $pr = new startup($this->path,$this->proj);
        $pr->render('SH',$cmd);   
		unset($pr);
		
	    $ret = 'ok!';
	  }
	  else 
	    $ret = '<>';*/
	  
	  return ($ret);
   }
   
   function search_excel($cmd) {
   
     $result = null;
	 $sheet = null;
   
     $x = new excel();
	 $ret = "----------- Searhing AANKAL...\n";
	 $ret .= $x->search('N:\ASKBILL\bin\aankal.xls',$cmd,$result['AANKAL'],$sheet['AANKAL']);
	 $ret .= "----------- Searhing KPG...\n";	 
	 $ret .= $x->search('N:\ASKBILL\bin\kpg.xls',$cmd,$result['KPG'],$sheet['KPG']);
	 $ret .= "----------- Searhing IASON...\n";	 
	 $ret .= $x->search('N:\ASKBILL\bin\iason.xls',$cmd,$result['IASON'],$sheet['IASON']);
	 
	 
	 //print_r ($result);
	 
	 $ret .= $this->search_best_price($result,$sheet);
	 	 
	 return $ret;
   } 
   
   function search_best_price($recarray,$sheet) {
   
     $offset['AANKAL'] = 3;
     $offset['KPG'] = 3;	 
     $offset['IASON'] = 4;	 
   
     $index=null;
	 $best=99999999.99;
     foreach ($recarray as $id=>$record) {
	
	   if (is_array($record)) {
	
         //reduce prise	   
         if ($id=='IASON') 
	         $percent = 20;  
         elseif ($id=='AANKAL') {
           if (($sheet[$id]=='hp') || ($sheet[$id]=='HP'))
	         $percent = 8; 
	       else		  
             $percent = 10;
	     }		 
		 elseif ($id=='KPG')
		   $percent = 2;  
		   	   
		   
		 $ret .= "PERSENT ($id):".$percent."\n";  

	     $current_offset = $offset[$id];
	     $p = trim($record[$current_offset]);//str_replace(',','.',trim($record[$current_offset]));		 
		 $_price = floatval($p);
		 $price = ($p - ($p*$percent)/100);
		 //echo $price,">>>>>>>\n";
		 if ($price<=$best) {
	         $index = $id;
		     $best = $price;
			 //echo 'best ',$best,' ',$price;		 
		 }
		/* 
	     //echo $id;
	     foreach ($record as $i=>$rec) {
	       //echo "\n\n",$rec,"\n\n";
		   if (is_float(str_replace(',','.',trim($rec)))) {//(strstr($rec,',')) {//has ,
		   
		   echo $rec, ' ';
		   $current = floatval(str_replace(',','.',$rec)); 
		   //echo $current;
	       if (is_float($current) && ($current<=$best)) {echo $current,'>>>>>>>>>>>>>>>>',"\n";
	         $index = $id;
		     $best = $current;
			 echo 'best ',$best;
	       }	 
		   }
	     }*/
	   }	   
	 }
	 
	 $ret .= $index;
	 
	 $msg = "The best price is " . $best . " from supplier " . $index;
     //$nAnswer = MessageBox( $msg, "Answer", MB_OK + MB_ICONQUESTION + MB_DEFBUTTON2 + MB_CENTER);
	    
     $ret = $msg;
	 

      /*  $dialog = new GtkMessageDialog(Gtk::GtkWindow, Gtk::DIALOG_MODAL | Gtk::DIALOG_DESTROY_WITH_PARENT,Gtk::MESSAGE_INFO, Gtk::BUTTONS_OK,$ret);

        $dialog->run();

        $dialog->destroy();*/
	 
	 return ($ret);
   }
   
   
   function iexplorer($url) {
   
     //open PDF Documents with Internet Explorer

     $browser = new COM("InternetExplorer.Application");
     $browser->Visible = true;
     $browser->Navigate($url);   
   }
   
function exportCrystalReportToPDF( $my_report, $my_pdf )
{
  $my_report = 'c:\\panik_b_ekptoseis.rpt';
  $my_pdf = 'c:\\ppdf.pdf';

  // by dfcp/mar/06
  $ObjectFactory= New COM("CrystalReports8.ObjectFactory.1");
  $crapp = $ObjectFactory->CreateObject("CrystalDesignRunTime.Application");
  $creport = $crapp->OpenReport($my_report, 1);

  $creport->ExportOptions->DiskFileName=$my_pdf;
  $creport->ExportOptions->PDFExportAllPages=true;
  $creport->ExportOptions->DestinationType=1; // Export to File
  $creport->ExportOptions->FormatType=31; // Type: PDF
  $creport->Export(false);
  
  
  
  $this->iexplorer($my_pdf);
}    

function cr() {

$crapp = new COM("CrystalDesignRunTime.Application");
$creport = $crapp->OpenReport("d:\\athermal\\reports\\backlog.rpt", 1);
$creport->SelectPrinter("winspool", "HP LaserJet 1200 Series PCL",
"Ne01:");
$creport->PaperOrientation = 0;
$creport->PrintOut(False);
}   
     
};
}

//$sh = new askbill();
//$sh->render();
//unset($sh);

?>