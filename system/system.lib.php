<?php

	function seclevel($modulename,$levelofsec) {
		$sec = GetGlobal('__DPCSEC');
	 
		if (isset($sec[$modulename])) { 
			$parts = explode(";",$sec[$modulename]);
		
			if ($parts[$levelofsec+1] >= $parts[0])
				return 1;
		}
		return 0;
	}
	
	function _lc($element, $id=0, $lan=null) {
		global $__LOCALE;
		$l = isset($lan) ? $lan : getlocal()+1;
	
		$p = explode(';', $__LOCALE[strtoupper($element) . '_DPC'][$id]);
		return $p[$l];
	}	

	function localize($codename,$lang=null,$enc=null,$encto=null,$debug=null) {
		$loc = GetGlobal('__DPCLOCALE');		
		if (!isset($lang)) 
			$lang = getlocal();
   
		$encodingsperlan = arrayload('SHELL','char_set'); 
		$enc = $enc ? $enc : $encodingsperlan[$lang];
   
		if (isset($loc[$codename])) { 
			$parts = explode(";",$loc[$codename]);
			if ($parts[$lang]) 
				return ($parts[$lang]);
		}  	
   
    //CART EMPTY VIEW WHEN IN 2nd LANGUAGE (MUST EXIST THE TRANS)
   if ((!paramload('SHELL','langdb')) || (!$db)) { //text file
	 
	 if ($seslocales = GetSessionParam('locales')) {
	   //in memory
	   $locale_file = unserialize($seslocales);
	 }
	 else {
       if (is_readable("locale.csv")) //in root	  
	     $locale_file = file("locale.csv");
	   elseif (is_readable("cp/locale.csv")) //in cp
         $locale_file = file("cp/locale.csv");  	
	   else
         echo "Configuration warning, locale.csv not exist!";	
		
       SetSessionParam('locales',serialize($locale_file));		
	 }  
	    
	 if (!empty($locale_file)) {	 
	   foreach ($locale_file as $line_num => $line) {	 
		   $split = explode (";", $line);
           //echo $line,'<br>';  
		   if ($split[0] == $codename) {
	         if ($encto)
	           return iconv($enc,$encto,trim($split[$lang+1]));
	         else	
			   return (trim($split[$lang+1]));
           }
       }
	 }
   }   
   
   
		return ($codename); //as input
	}

	function getlans() {
		$mylans = arrayload('SHELL','languages'); //titles of lans
		if (count($mylans)>0) 
			return ($mylans); //get the info from config  

		return null;
	}

	function settheCookie($name,$val) {
		if (!$cookie = $_COOKIE[$name]) 
			setcookie ($name, $val); 
		else 
			setcookie ($name, "" , time() - 3600); //delete cookie

		return true;
	}

	function gettheCookie($cname) {

		return $_COOKIE[$cname];   
	}

	function SetSessionParam($ParamName, $ParamValue) {	 
  
		$_SESSION[$ParamName] = $ParamValue;
	}

	function SetPreSessionParam($ParamName, $ParamValue) {	 

		$_SESSION[$ParamName]= $ParamValue; 
		FreeSessionParam($ParamName);
	}

	function GetSessionParam($ParamName) {

		if ((!isset($_POST[$ParamName]) && !isset($_GET[$ParamName])))
			return $_SESSION[$ParamName];

		return null; 
	}

	function GetPreSessionParam($ParamName) {	 

		return $_SESSION['SESARRAY'][$ParamName]; 
	}

	function FreeSessionParam($param) {
		$sesp = (array)GetSessionParam('SESARRAY');
  
		if (!in_array($param,$sesp)) 
			$sesp[] = $param;
  
		SetSessionParam('SESARRAY',$sesp);
		return true;
	}

	//unregister now
	function DeleteSessionParam($param) {
  
		$_SESSION[$param] = null;
		return true;
	}

	//unregister all pre session array params (usually at shell destruction or logout)
	function ResetSessionParams() {
		$sesp = (array)GetSessionParam('SESARRAY');
 
		foreach ($sesp as $sid=>$sparam)
			$_SESSION[$sparam] = null;
	   
		$_SESSION["SESARRAY"] = null;
		unset($sesp);
		
		return true;
	}

	function getlocal() {
		$deflang = paramload('SHELL','dlang');
		$curlang = GetSessionParam("locale");

		if ($curlang) 
			return ($curlang-1);
		
        return ($deflang ? $deflang : 0);
	}

	function setlocal($local) {
		SetSessionParam("locale",($local+1));
		return true;
	}

	function GetGlobal($param) {
		if ($ret = $_SESSION[$param]) 
			return ($ret);
  
		return ($GLOBALS[$param]);
	}

	function SetGlobal($param,$val=null) {
  
		$GLOBALS[$param] = $val;
		return true;
	}
  
	function redirect($url) {
	 
		echo 'REDIRECT:' . $url;
		header("Location: http://".$url); 
		exit;   
	}
   
	function getthemicrotime() {
   
		list($usec,$sec) = explode(" ",microtime());
		return ((float)$usec + (float)$sec);
	} 

	function get_filesize($dsize) { 

		if (strlen($dsize)>=10)
			return number_format($dsize/1073741824,1)." Gb";
		elseif (strlen($dsize)<=9 and strlen($dsize)>=7)
			return number_format($dsize/1048576,1)." Mb";
		else
			return number_format($dsize/1024,1)." Kb";
	} 

	function copyr($source, $dest) { 
        // Simple copy for a file 
        if (is_file($source)) { 
          return copy($source, $dest); 
        } 
  
        // Make destination directory 
        if (!is_dir($dest)) { 
           mkdir($dest); 
        } 
  
        // Loop through the folder 
        $dir = dir($source); 
        while (false !== $entry = $dir->read()) { 
          // Skip pointers 
          if ($entry == '.' || $entry == '..') { 
            continue; 
          } 
  
          // Deep copy directories 
          if ($dest !== "$source/$entry") { 
            $this->copyr("$source/$entry", "$dest/$entry"); 
          } 
        } 
  
        // Clean up 
        $dir->close(); 
        return true; 
}	 

function scanargs($label) {
  //global $argv,$argc;
  $argc = GetGlobal('argc');
  $argv = GetGlobal('argv');
   
  reset ($argv);  
  foreach ($argv as $arg_num => $arg) {  
    if ($arg==$label) {
	  //print $argv[$arg_num+1]; 
	  return ($argv[$arg_num+1]);
	}  
  }    
} 

function load_dl($extlib,$os) {

  if (!extension_loaded($extlib)) {
    dl($extlib . (strstr(PHP_OS, 'WIN') ? '.dll' : '.so'));
  }
}

function setsyspath($path,$type='UNIX') {
  
  switch ($type) {
    case 'WINDOWS':
    case 'MSDOS': $outpath = ereg_replace("/","\\",$path); break;	
	default     :
	case 'LINUX':
    case 'UNIX' : $outpath = ereg_replace("[\x5c\]","/",$path); break;	
  }

  if ($outpath) return ($outpath); 
           else return ($path);
}

function iniload($section) {
  $config = GetGlobal('config');

  if (is_array($config[$section])) 
    return TRUE;
  else
    return FALSE;
}

function paramload($section,$param) {
  $config = GetGlobal('config');

  if (is_array($config[$section]))     
	return ($config[$section][$param]);

}

function arrayload($section,$array) {
  $config = GetGlobal('config');
  
  if (is_array($config[$section])) {
    $data = $config[$section][$array];
	
	if ($data) 
		return(explode(',',$data));
  }  
}

function remote_paramload($section,$param,$remoteapppath,$usepath=null) {
  $config = GetGlobal('config');
	
  if ($usepath) {//switch db case
    $config = @parse_ini_file($remoteapppath."config.ini",true);
	$t_config = @parse_ini_file($remoteapppath."myconfig.txt",true);
	
    if (is_array($t_config[$section]) && isset($t_config[$section][$param])) 
      return ($t_config[$section][$param]);
    elseif (is_array($config[$section]))     
	  return ($config[$section][$param]);	
  }
  
  //get from mem	
  if ($ret = $config[$section][$param]) 
    return ($ret);

}

function remote_arrayload($section,$array,$remoteapppath,$usepath=null) {
  $config = GetGlobal('config');
	
  if ($usepath) {//switch db case
    $config = @parse_ini_file($remoteapppath."config.ini",true);
	$t_config = @parse_ini_file($remoteapppath."myconfig.txt",true);
	
    if (is_array($t_config[$section]) && isset($t_config[$section][$array])) 
      return (explode(",",$t_config[$section][$array]));
    elseif (is_array($config[$section]))     
	  return (explode(",",$config[$section][$array]));	
  }	
	
  if ($data = $config[$section][$array]) 
    return(explode(",",$data));
}


 //use img from default image dir
 function loadimage($img,$alt=null,$altpicpath=null) {	
   
     $ip = $_SERVER['HTTP_HOST'];
     $pr = paramload('SHELL','protocol');
	 
	 if (isset($altpicpath))
	   $pp = $altpicpath;	 
	 else  
	   $pp = paramload('SHELL','picpath');	 
 
	 $source = $pr . $ip . $pp . $img;	 
     
	 $out = "<img src=\"$source\" border=\"0\" alt=\"$alt\">";

	 return ($out);
 } 
 

 function loadicon($icon,$comment='',$jscript='') { 
     $thema = GetGlobal('thema');	 
     $theme = GetGlobal('theme');	 	 
	 
     $ip = $_SERVER['HTTP_HOST'];
     $pr = paramload('SHELL','protocol'); 
	 $inpath = paramload('ID','hostinpath');
	 	 
	 if (!$thema) $thema = paramload('SHELL','deftheme');
     $themepath = $inpath . '/' . $theme['path'] . $thema . ".theme"; 	  
	 $source = $pr . $ip . $themepath . $icon;      
	 $out = "<img src=\"$source\" border=\"0\" alt=\"$comment\" $jscript>";

	 return ($out);
 }
 
function encode($var,$default=false) {
		
	if ($var) {
	  
	  if ((defined("CRYPT_DPC")) && ($default==false)) {
		$outvar = GetGlobal('controller')->calldpc_method('crypt.encode use '.$var); 
	  }
      elseif (defined("CIPHERSABER_LIB")) {
        $cp = new ciphersaber;
	    $outvar = $cp->encrypt($var,'1234567890abcdefdgklm#$%^&');
	    unset($cp);	  	
	  }  	  
      else {
        $cp = new AzDGCrypt('1234567890abcdefdgklm#$%^&');
	    $outvar = $cp->crypt($var);
	    unset($cp);
	  }	
	  if ($outvar) 
	    return ($outvar);	
    }
	
	return ($var);
}

function decode($var,$default=false) {

	if ($var) {
	  
	  if ((defined("CRYPT_DPC")) && ($default==false)) {
	    //echo 'crypt_dpc';
		$outvar = GetGlobal('controller')->calldpc_method('crypt.decode use '.$var); 
	  }
      elseif (defined("CIPHERSABER_LIB")) {
	    //echo 'cipher lib';
        $cp = new ciphersaber;
	    $outvar = $cp->decrypt($var,'1234567890abcdefdgklm#$%^&');
	    unset($cp);	  	
	  }  	  
	  else {
	    //echo 'az crypt';
        $cp = new AzDGCrypt('1234567890abcdefdgklm#$%^&');
	    $outvar = $cp->decrypt($var);
	    unset($cp);
	  }
	  	
	  if ($outvar) return ($outvar);
		  
	}
	
	return ($var);
} 


function _without($data) {
  $out = str_replace ("_", " ", $data);  
  return ($out);
}

function _with($data) {
  $out = str_replace (" ", "_", $data);  
  return ($out);
}

function setInfo($text) {
  $xerror = GetGlobal('sFormErr');  
   
  $info = ($xerror) ? $sFormErr . $text : $text ;
  SetGlobal('info',$info); 
}


function browse_alphabetical($command=null) {
	
	  $preparam = GetReq('alpha');
	  $ret = seturl("t=$command","Home") . "&nbsp;|";
	
	  for ($c=$preparam.'a';$c<$preparam.'z';$c++) 
			$ret .= seturl("t=$command&alpha=$c",$c) . "&nbsp;|";


	  $ret .= seturl("t=$command&alpha=".$preparam."z",$preparam."z");
	  
	  return ($ret);
}

function url($url,$title,$jscript=null) {

  $out = "<a href=\"" . $url . "\" $jscript>" . $title . "</a>";
  return ($out);
}


function seturl($query='',$title='',$ssl=0,$jscript='',$sid=1,$rewrite=null) {
	$__USERAGENT = GetGlobal('__USERAGENT'); 

	$rewrite = $rewrite ? $rewrite : paramload('SHELL','rewrite');
	$session_use_cookie = paramload('SHELL','sessionusecookie');
	if ($session_use_cookie) $sid=0;  
  
	$subpath = pathinfo($_SERVER['PHP_SELF'],PATHINFO_DIRNAME);  
  
	$query_p = explode("|",$query);

	if (isset($query_p[1])) {
		$query = $query_p[1];
		$subpath = $query_p[0];
	}	
	else 
		$query = $query_p[0];	
 
	if ($subpath=="\\") $subpath = null;  
  
/* 
	$protocol = paramload('SHELL','protocol');
	$secprotocol = paramload('SHELL','secureprotocol');  
	$sslpath  = paramload('SHELL','sslpath');
  
	
    $ipool = arrayload('SHELL','ip'); //print_r($ipool);
    if (in_array($_SERVER['HTTP_HOST'],$ipool)) 
		$ip = $_SERVER['HTTP_HOST']; //remote user call
    else 
		$ip = $ipool[0]; //default  
  
    $activeSSL = paramload('SHELL','ssl');
    $encURLparam = paramload('SHELL','encodeurl');  //echo '>>>',$encURLparam,'<<<';

    if (($activeSSL) && ($ssl)) 
	    $name = $secprotocol . $ip . $sslpath; 
    else 
	   $name = $protocol . $ip; 
*/
	$name = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
	$name.= (strstr($_SERVER['HTTP_HOST'], 'www')) ? $_SERVER['HTTP_HOST'] : 'www.' . $_SERVER['HTTP_HOST'];		
                           
						 //mv controller or page controller caller???
						 $xurl = "/".pathinfo($_SERVER['PHP_SELF'],PATHINFO_BASENAME);

						 //fun called by mv cntrl
						 if (paramload('SHELL','filename')==$xurl) {
						   //get page if exist..(t=page)!!!!!!!!!!!!!!!!!!!!!!!!!!
                           if ($page = getpurl($query,$title,$ssl,$jscript,$ssl)) {
						     $name .= "/" . $page;//page cntrl
						     //echo "[",$name,"]<br>";
						   }
						   else						 
						     $name .= paramload('SHELL','filename');				
						 }  		   
						 else {//fun called by page cntrl  
						   $mysubpath = $subpath<>'/' ? $subpath.'/': $subpath;
						   $name .= $mysubpath . pathinfo($_SERVER['PHP_SELF'],PATHINFO_BASENAME);  //double slash //....solved
						   //echo $mysubpath,'>',pathinfo($_SERVER['PHP_SELF'],PATHINFO_BASENAME),'>';
						 }  
						 
						 //echo $name,"<br>";
						 
                         if (isset($query)) {
                           if ($query!="#") {
						     if ($rewrite) {
							   //$url = $name . "/"; 
							   //$url.= str_replace("&","/",str_replace("=","/",$query));
							   ////////////////////////////////////////////////////////////////// make arg's value dirs...
							   $aquery = explode('&',$query);
							   foreach ($aquery as $a=>$q) {
							     $aparam = explode('=',$q);
								 //if (($aparam[0])=='t')
								   $url .=  $aparam[1] .'/';//value = dpc command = like dir
							   }
							   //print_r($aquery);
							   //echo $url,'<br>';
							 }
							 else {
	                           $url = $name . "?"; //. $query;
	                           (($encURLparam) ? $url .= encode_url($query,$encURLparam) : $url .= $query);
	                           if ($sid) $url .=  "&" . SID;
							 }
	                       }  
	                       else 
	                         $url = "#"; 
                         }				
                         else  
                           (isset($sid) ? $url = $name . '?' . SID : $url = $name); 
                         
						 //echo $url,"<br>";
                         if ($title) $out = "<A href=\"" . $url . "\" $jscript>" . $title . "</A>";
                         else $out = $url;

	return ($out);
}
    
	//page cntrl logic url creator
	function getpurl($query='',$title='',$ssl=0,$jscript='',$sid=1) {
	
	  parse_str($query,$parts);
	  
	  if (is_array($parts)) {
	  
	    if ($parts['t']) {//default
	      $pagename = $parts['t'];
	    }	
		else
		  return false;

		$url = paramload('SHELL','urlpath');
		if ((paramload('SHELL','ssl')) && ($ssl))
		  $url .= paramload('SHELL','sslpath');
		$url .= "/" . $pagename . ".php"; 

		if (file_exists($url))
	      return ($pagename . ".php");
	  }	
	  
      return false;
	  
	} 

    //javascript url 
	function setjsurl($title,$jscript,$id=null,$attributes=null) {
	
	   if ($id) $out = "<a id='$id' href=\"$jscript\" $attributes>" . $title . "</a>";
	       else $out = "<a href=\"$jscript\" $attributes>" . $title . "</a>";
	   
	   return ($out);
	}
	
	//ajax url
	function setajaxurl($query='',$title='',$ssl=0,$jscript='',$sid=1) {
	
	  if ((defined('AJAX_DPC')) && (defined('JAVASCRIPT_DPC'))) {
	     
		 $url = seturl($query,null,$ssl,null,null);
		 $ret = "<a href=\"javascript:sndReqArg('$url')\">$title</a>";
		 
		 return ($ret);
	  }
	  else
	    return 'Ajax! What is this!';
    }

	function encode_url($url,$param='prm'){ 
	    
		if ($url) {
		  $ret = $param . "=" . base64_encode($url);
		}  
	    return ($ret);
	} 
	
	function decode_url ($param='prm'){ // methode to unhide
		
		if($_REQUEST[$param]){ 
			$decode_url=base64_decode($_REQUEST[$param]); 
			parse_str($decode_url, $tbl); 
			
			foreach($tbl as $k=>$v){
				$_REQUEST[$k]=$v;
				SetGlobal($k,$v);
				$$k=$v;
			}
		} 
	}

function checkmail($data) {

  if( !eregi("^[a-z0-9]+([_\\.-][a-z0-9]+)*" . "@([a-z0-9]+([\.-][a-z0-9]{1,})+)*$",
   $data, $regs) )  {

   SetInfo("Error: '$mail' isn't a valid mail address!");
   return false;
  }

  return true;
  
}

function checkmail_mx($email) {

   $exp = "^[a-z\'0-9]+([._-][a-z\'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$";

   if(eregi($exp,$email)){

     if (strstr(PHP_OS, 'WIN')) {//win..  
   
       if (checkdnsrr_winNT(array_pop(explode("@",$email)),"MX")) {
         return true;
       }
	   else{
         return false;
       }
     }
	 else {//unix*...
       if (checkdnsrr(array_pop(explode("@",$email)),"MX")) {
         return true;
       }
	   else{
         return false;
       }	 
	 
	 }
   }else{

     return false;

   }   
}

/******************************************************

These functions can be used on WindowsNT to replace
their built-in counterparts that do not work as
expected.

checkdnsrr_winNT() works just the same, returning true
or false

getmxrr_winNT() returns true or false and provides a
list of MX hosts in order of preference.

*******************************************************/

function checkdnsrr_winNT( $host, $type = '' )
{

   if( !empty( $host ) )
   {

       # Set Default Type:
       if( $type == '' ) $type = "MX";

       @exec( "nslookup -type=$type $host", $output );

       while( list( $k, $line ) = each( $output ) )
       {
           //echo $line,'<br>';
           # Valid records begin with host name:
           if( eregi( "^$host", $line ) )
           {
               # record found:
               return true;
           }

       }

       return false;

   }

}

function getmxrr_winNT( $hostname, &$mxhosts )
{

   if( !is_array( $mxhosts ) ) $mxhosts = array();

   if( !empty( $hostname ) )
   {

       @exec( "nslookup -type=MX $hostname", $output, $ret );

       while( list( $k, $line ) = each( $output ) )
       {

           # Valid records begin with hostname:
           if( ereg( "^$hostname\tMX preference = ([0-9]+), mail exchanger = (.*)$", $line, $parts ) )
           {

               $mxhosts[ $parts[1] ] = $parts[2];

           }

       }

       if( count( $mxhosts ) )
       {

           reset( $mxhosts );

           ksort( $mxhosts );

           $i = 0;

           while( list( $pref, $host ) = each( $mxhosts ) )
           {
               $mxhosts2[$i] = $host;
               $i++;
           }

           $mxhosts = $mxhosts2;

           return true;

       }
       else
       {

           return false;

       }

   }

}

//reverse datetime strings
//ex. 2003-01-10 02:20:31 - 10-01-2003 02:20:31 or the opposite
function reverse_datetime($dtime,$ds='-',$ts=':') {
	
	   $parts = explode(" ",$dtime);
	   $date = $parts[0];
	   $dparts = explode("-",$date);
	   
	   return ($dparts[2].$ds.$dparts[1].$ds.$dparts[0]." ".$parts[1]);
}

// get date    
function get_date ($format) {

   $today = getdate(); 
   $M = $today[month]; 
   $m = $today[mon];  
   $D  = $today[weekday]; 
   $d  = $today[mday];  
   $Y  = $today[year]; 
   $y  = $today[year];
   $hr = $today[hours];
   $mn = $today[minutes];
   $sc = $today[seconds];    
   
   switch ($format) {
     case "h:n" : $my_date = "$hr:$mn"; break;
     case "h:n:c" : $my_date = "$hr:$mn:$sc"; break;
     case "d/m/y,h:n" : $my_date = "$d/$m/$y,$hr:$mn"; break;
     case "MD,Y"  : $my_date = "$M $D, $Y"; break;
     case "DM,Y"  : $my_date = "$D $M, $Y"; break;	 
     case "m/d/y" : $my_date = "$m/$d/$y"; break;
     case "m-d-y" : $my_date = "$m-$d-$y"; break;
     case "d/m/y" : $my_date = "$d/$m/$y"; break;	 	 	 
     case "d-m-y" : $my_date = "$d-$m-$y"; break;
     case "DdMY"  : $my_date = localize($D,getlocal()) . " $d ". localize($M,getlocal()) ." $Y"; break;		 
     default      : $my_date = localize($D,getlocal()) . " $d ". localize($M,getlocal()) ." $Y";
   }
   
   return ($my_date);
}

 
function get_datetime () {

   $today = getdate(); 
   $month = $today[mon]; 
   $mday  = $today[mday]; 
   $year  = $today[year]; 
   $hour  = $today[hours];
   $min   = $today[minutes];
   $sec   = $today[seconds];   
   
   $my_date = "$mday-$month-$year:$hour:$min:$sec";
   
   return ($my_date);
}

//return array of text named days
function getdaysarray($startday=0,$blank=0,$blankalias="-----") {
  
  //if ($blank) $days[] = $blankalias;  
  
  $days[] = localize('Sunday',getlocal());  
  $days[] = localize('Monday',getlocal());
  $days[] = localize('Tuesday',getlocal());
  $days[] = localize('Wednesday',getlocal());
  $days[] = localize('Thursday',getlocal());
  $days[] = localize('Friday',getlocal());
  $days[] = localize('Saturday',getlocal());	
  
  if (($startday) && ($startday<7)) {
    for ($i=1;$i<=$startday;$i++) {
	  $sh = array_shift($days);
	  $days[] = $sh;
	}  
  }	
  
  if ($blank) array_unshift($days,$blankalias);
				 
  return ($days);				 
}

// Get date difference between two given dates
// $returntype: s = seconds, m = minutes, h = hours, d = days
// int date_diff(int start_date, int end_date[, string return_type])
function date_diff_2($start_date, $end_date, $returntype="d") { 
   if ($returntype == "s")
       $calc = 1;
   if ($returntype == "m")
       $calc = 60;
   if ($returntype == "h")
       $calc = (60*60);
   if ($returntype == "d")
       $calc = (60*60*24);   
       
   $_d1 = explode(" ", $start_date);
   $_d11 = explode('-',$_d1[0]); //print_r($_d11);
   $_d12 = explode(':',$_d1[1]); //print_r($_d12);  
   $d1 = $_d11[0]; //echo '<br>',$d1;
   $m1 = $_d11[1];//echo '<br>',$m1;
   $y1 = $_d11[2];//echo '<br>',$y1;
   $h1 = $_d12[0]?$_d12[0]:0;
   $n1 = $_d12[1]?$_d12[1]:0;
   $s1 = $_d12[2]?$_d12[2]:0; 
   //echo $h1,':',$n1,':',$s1,'<br>'; 
   
   $_d2 = explode(" ", $end_date);
   $_d21 = explode('-',$_d2[0]);
   $_d22 = explode(':',$_d2[1]);   
   $d2 = $_d21[0];//echo '<br>',$d2;
   $m2 = $_d21[1];//echo '<br>',$m2;
   $y2 = $_d21[2];//echo '<br>',$y2;
   $h2 = $_d22[0]?$_d22[0]:0;
   $n2 = $_d22[1]?$_d22[1]:0;
   $s2 = $_d22[2]?$_d22[2]:0;
   //echo $h2,':',$n2,':',$s2,'<br>'; 
   
  
   if (($y1 < 1970 || $y1 > 2037) || ($y2 < 1970 || $y2 > 2037)) {
       return 0;
   } 
   else {
       $start_date_stamp    = mktime($h1,$n1,$s1,$m1,$d1,$y1); 
       $end_date_stamp    = mktime($h2,$n2,$s2,$m2,$d2,$y2);
       $difference = round(($end_date_stamp-$start_date_stamp)/$calc);

	   return $difference;  
   }
}

	function convert_date($date,$format,$zero=null) {
		  
	        $parts = explode("-",$date);
		    $day = ($zero ? sprintf("%02d",$parts[0]):$parts[0]);
		    $month = ($zero ? sprintf("%02d",$parts[1]):$parts[1]);
		    $parts2 = explode(" ",$parts[2]);
		    $year = $parts2[0];
		    $time = $parts2[1];
			
			$s = substr($format,0,1);
			$f = substr($format,1);
			switch ($f) {
			  case 'DMYT' : $ret = $day . $s . $month . $s . $year . " " . $time; break;
			  case 'DMY'  : $ret = $day . $s . $month . $s . $year ; break; 
			  case 'MDYT' : $ret = $month . $s . $day . $s . $year . " " . $time; break; 
			  case 'MDYT' : $ret = $month . $s . $day . $s . $year; break; 
			  case 'YMDT' : $ret = $year . $s . $month . $s . $day . " " . $time; break;  
			  case 'YMD'  : $ret = $year . $s . $month . $s . $day; break; 
			  default     : $ret = $day . $s . $month . $s . $year . " " . $time;
			}
			
		  //echo $ret;	
		  return ($ret); 	
	}	

function get_options_file($lookupfile,$is_search,$is_required,$selected_value) {
  
  $options_str="";
  if ($is_search)
    $options_str.="<option value=\"\">All</option>";
  else
  {
    if (!$is_required)
    {
      $options_str.="<option value=\"\"></option>";
    }
  }
  
  $lfile = paramload('SHELL','prpath') . $lookupfile . '.opt';

  if (is_file($lfile)) {
  
    $fd = fopen($lfile, 'r');
    $ret = fread($fd, filesize($lfile));
    fclose($fd); 	   
	
    $result = explode(',',$ret);  
    $lan = getlocal();
  
    if ($result) {
	
      foreach ($result as $id=>$value)  {
	  
	    //language selection
	    $lan_value = explode(";",$value);
		$val = $lan_value[$lan];
		if ($val) $option = $val;
		     else $option = $lan_value[0];
	  
        $selected="";
        if ($id == $selected_value)  {
          $selected = "SELECTED";
        }
        $options_str.= "<option value='".$id."' ".$selected.">".$option."</option>";
	
      }
    }

  }  
  return $options_str;
}


function get_selected_option_fromfile($option,$lookupfile,$languange=null,$filetype=null) {

  $ftype = $filetype?'.'.$filetype:'.opt';

  $lfile = paramload('SHELL','prpath') . $lookupfile . $ftype;
  
  if (is_file($lfile)) {
  
    $fd = fopen($lfile, 'r');
    $ret = fread($fd, filesize($lfile));
    fclose($fd); 	   
	
    $result = explode(',',$ret);  //print_r($result);
	
	if (isset($languange))
	  $lan = $languange;
	else  
      $lan = getlocal();
  
    if ($result) {
	
	  $d = explode(";",$result[$option]);  
	  $ret = trim($d[$lan]);
	  
	  return ($ret);
	}  
  }	
  
  return null;
}

function get_selected_id_fromfile($option,$lookupfile,$filetype=null) {

  $ftype = $filetype?'.'.$filetype:'.opt';

  $lfile = paramload('SHELL','prpath') . $lookupfile . $ftype;
  if (is_file($lfile)) {
  
    $fd = fopen($lfile, 'r');
    $ret = fread($fd, filesize($lfile));
    fclose($fd); 	   
	
    $result = explode(',',$ret);  
	
	if (count($result)>0) {
	 
	  foreach  ($result as $id=>$title) {
	    
		if (@stristr($title,$option))
		  return ($id);
	  }
	}
  }	
  
  return -1; 
}

function ext2ascii($str,$offset=128) {
    $out = '';

	for ($i=0;$i<strlen($str);$i++) {
		$ch = chr(ord($str[$i])-$offset);
		$out .= $ch;
	}
	
	return ($out);
}

function ascii2ext($str,$offset=128) {
    $out = '';

	for ($i=0;$i<strlen($str);$i++) {
		$ch = chr(ord($str[$i])+$offset);
		$out .= $ch;
	}
	
	return ($out);
}

function summarize($maxchar,$text) {

    if (strlen($text)>$maxchar) $res = substr($text,0,$maxchar) . "...";
	                       else $res = $text;
	return ($res);
}


function replace_htmlsestext($param,$htmltext,$mode=1) { 
    
	switch ($mode) {
       case 1 :	//replace all sesid string
	            $out = str_replace("&SESSID=" . session_id(),$param,$htmltext);	
	            break;
	   case 2 : //replace current sessid
	            $out = str_replace(session_id(),$param,$htmltext);	
	            break;
	}			
	return ($out);
}	


function html2cleartext($htmlfile) {

  $myhtmlfile = file ("$htmlfile");

  foreach ($myhtmlfile as $line_num => $line) {    
    if ($line) {
       $html_print .= strip_tags($line);    //read line without tags
    }
  }
  return $html_print; 
}

function html_select_control($id,$num,$zero=0,$val=0) {
   
    if ($zero) $st = 0; else $st = 1;
	 
	$out = "<select name=\"$id\">";
	for ($j=$st;$j<=$num;$j++) { 
		 if (($val) && ($j==$val)) $out .= "<option selected>$j";
		                      else $out .= "<option>$j";
	}  
	$out .= "</option></select>";
	
	return ($out);
}


function _echo($client='HTML',$text=null) {
	echo str_replace("\n","</br>",$text); 
}

function GetParam($ParamName) {
  $ParamValue = "";
  if(isset($_POST[$ParamName]))
    $ParamValue = $_POST[$ParamName];
  else if(isset($_GET[$ParamName]))
    $ParamValue = $_GET[$ParamName];

  return (stripslashes($ParamValue));
}

function SetParam($ParamName,$ParamValue=null) {

  $_POST[$ParamName] = $ParamValue;
}

function GetReq($ParamName) {
  $ParamValue = "";
  if(isset($_REQUEST[$ParamName]))
    $ParamValue = $_REQUEST[$ParamName];
  else 
    $ParamValue = null;
 
  return (stripslashes($ParamValue));
}

function SetReq($ParamName,$ParamValue) {
 
  $_REQUEST[$ParamName] = $ParamValue;
}

function DelReq($ParamName) {

  if (isset($_REQUEST[$ParamName])) 
    $_REQUEST[$ParamName] = null;
}

function is_number($string_value) {

  if(is_numeric($string_value) || !strlen($string_value))
    return true;
  else 
    return false;
}


function IsParam($ParamValue) {

  if($ParamValue)
    return 1;
  else
    return 0;
}


function ToHTML($strValue) {
  return htmlspecialchars($strValue);
}

function ToURL($strValue) {
  return urlencode($strValue);
}


 function loadTheme($src, $comment='',$nohtml=0,$jscript=null) {
     if (!$src) return null;
	 
     $ip = $_SERVER['HTTP_HOST'];
     $pr = paramload('SHELL','protocol');	 
	 $url = $pr . $ip;	 
     $path ='/images/'; 
	 $source = $url . $path . $src;

	   if (!$nohtml) 
	     $out = "<img src=\"". $source . "\" border=\"0\" alt=\"$comment\" $jscript>";
	   else 
	     $out = $source;
	  

	 return ($out);
 }

function _PRAGMA($cp,$cs,$al,$wd,$bd,$cl,$content,$attributes,$style=null) {

      $pragma .= "\n"; //<!-- start pragma -->\n";
      $pragma .= "<TABLE";
	  $pragma .= " cellpadding=" . $cp;
	  $pragma .= " cellspacing=" . $cs;
	  $pragma .= " align=\"" . $al . "\"";
	  $pragma .= " width=\"" . $wd . "\"";  
	  $pragma .= " border=" . $bd;
	  $pragma .= " class=\"" . $cl . "\"";
      $pragma .= ">";		  
	  $pragma .= "<TR $style>";
	  $pragma .= "\n";	  
	  
      //read data array 
	  reset ($content); 
      //while (list ($data_num, $data) = each ($content)) {
	  foreach ($content as $data_num => $data) {
	    if ($data) {
		  $pragma .= "<TD";
		  //read attributes
		  $atr = $attributes[$data_num];
		  if ($atr!="hidden") {
		    $spattr = explode (";", $atr);
			
			if ($spattr[0]) $pragma .= " align=\"$spattr[0]\"";
				       else $pragma .= " align=\"left\"";         
			
		    if ($spattr[1]) $pragma .= " width=\"$spattr[1]\"";
		               else $pragma .= " width=\"99%\"";

		    if ($spattr[2]) $pragma .= " valign=\"$spattr[2]\"";
		               else $pragma .= " valign=\"top\"";
					    
		    if ($spattr[3]) $pragma .= " bgcolor=\"$spattr[3]\"";
						   
		    if ($spattr[4]) $pragma .= " background=\"$spattr[4]\"";					   
			
		    if ($spattr[5]) $pragma .= " class=\"$spattr[5]\""; 
		   
            $pragma .= ">";	
		    $pragma .= $data;
		    $pragma .= "</TD>";
		  }
		}  
	  }
	  
      $pragma .= "\n</TR></TABLE>\n";
	  //$pragma .= "\n<!-- end  pragma -->\n";
	  
	  return ($pragma);
}

function _LAYER($id,$pos,$vis,$state,$overf,$left,$top,$width,$height,$data,$attr='',$level=0) {
    static $zlevel;
	
	$zindex = (++$zlevel)+$level; //calc z index pre group based on $level start
	//echo ">>>>",$zindex,"---";
	
    $ldata = "<DIV id=\"$id\"" . 
             " style=\"". 
		     " BACKGROUND-COLOR: #" . paramload('HTML','f2_bcol') . "; " .
			 " BORDER-BOTTOM: #000000 1px; " .
			 " BORDER-LEFT: #000000 1px; " .
			 " BORDER-RIGHT: #000000 1px; " .
			 " BORDER-TOP: #000000 1px; " .
			 " HEIGHT: $height; " .
			 " LEFT: $left; " .
			 " POSITION: $pos; " .
			 " TOP: $top; " .
			 " VISIBILITY: $vis ; " .
			 " overflow: $overf; " .
			 " WIDTH: $width; " .
			 " Z-INDEX: " . $zindex. "; " .
			 " layer-background-color: #000066 \"";
			 
	if ($state) {
	   switch ($state) {
	     case 1 : $ldata .= " onClick=\"MM_showHideLayers('$id','','hide')\" "; break;
	     case 2 : $ldata .= " onMouseOver=\"MM_showHideLayers('$id','','hide')\" "; break;		 
	   }
	}   	 
			 
	$ldata .= ">";   
			  
    if ($attr) {
      $param = explode ("::", $attr);	
	  
	  $dout[] = $data;
	  $aout[] = "left";
	  $ldata .= _PRAGMA($param[5],$param[6],$param[0],$$param[1],$param[2],$param[3],$dout,$aout);
	}
	else 
	  $ldata .= $data;	  
	  
    $ldata .= "</DIV>\n";
	
	return ($ldata);
}

?>