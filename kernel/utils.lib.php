<?php
/**
 * This file is part of phpdac7.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    balexiou<balexiou@stereobit.com>
 * @copyright balexiou<balexiou@stereobit.com>
 * @link      http://www.stereobit.com/php-dac7.php
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

class utils {
	
	private $env;
	
	public function __construct(& $env=null) {
		
		$this->env = $env;
	}
	
	//for data streams dpc address extract args
	public function dehttpDpc($dpc) 
	{	
	  if (strstr($dpc,"\\")) 
	  {     //data stream
			//cut cmd params
			$arg = explode("\\",$dpc);
			return $arg[1];
      }
	  return $dpc; //as is
    }  
	
	public function convert($size)
	{
		$unit=array('b','kb','mb','gb','tb','pb');
		return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
	}	
	
	public function httpcl($url=null, $user=null,$password=null) 
	{
		if (!$url) return null;
		//echo ">>>>>>>>>>>>>$url<<<<<<<<<<<<<<<\n";
		require_once("tcp/saslclient.lib.php");
		require_once("tcp/httpclient.lib.php");		
		
		//$http=new \LIB\tcp\httpclient;
		$http= new httpclient;
		
		$http->timeout=0;
		$http->data_timeout=0;
		$http->debug=0;//1
		$http->html_debug=0;//1				
		$http->user_agent="Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
		$http->follow_redirect=0; // enabled for 301,2
		$http->prefer_curl=0;
		
		$realm="";       /* Authentication realm or domain      */
		$workstation=""; /* Workstation for NTLM authentication */
		$authentication=(strlen($user) ? UrlEncode($user).":".UrlEncode($password)."@" : "");
				
		$url="http://".$authentication.$url;//"www.php.net/";
				
		$error=$http->GetRequestArguments($url,$arguments);

		if(strlen($realm))
			$arguments["AuthRealm"]=$realm;

		if(strlen($workstation))
			$arguments["AuthWorkstation"]=$workstation;

		$http->authentication_mechanism=""; // force a given authentication mechanism;
		$arguments["Headers"]["Pragma"]="nocache";
				
		$this->env->cnf->_say("Opening connection to: " . HtmlSpecialChars($arguments["HostName"]), 'TYPE_LION');
		flush();
		$error=$http->Open($arguments);
				
		if ($error=="") 
		{
			$this->env->cnf->_say("Sending request for page: " . HtmlSpecialChars($arguments["RequestURI"]),'TYPE_LION');
			if(strlen($user))
				$this->env->cnf->_say("\nLogin:    ".$user."\nPassword: ".str_repeat("*",strlen($password)),'TYPE_RAT');
			$this->env->cnf->_say('', 'TYPE_RAT');
			flush();
			$error=$http->SendRequest($arguments);
			$this->env->cnf->_say('', 'TYPE_RAT');

			if($error=="") 
			{
				$this->env->cnf->_say("Request:\n\n".HtmlSpecialChars($http->request), 'TYPE_RAT');
				$this->env->cnf->_say("Request headers:\n", 'TYPE_RAT');
				for(Reset($http->request_headers),$header=0;$header<count($http->request_headers);Next($http->request_headers),$header++)
				{
					$header_name=Key($http->request_headers);
					if(GetType($http->request_headers[$header_name])=="array")
					{
						for($header_value=0;$header_value<count($http->request_headers[$header_name]);$header_value++)
							$this->env->cnf->_say($header_name.": ".$http->request_headers[$header_name][$header_value], 'TYPE_RAT');
					}
					else
						$this->env->cnf->_say($header_name.": ".$http->request_headers[$header_name], 'TYPE_RAT');
				}
				$this->env->cnf->_say('', 'TYPE_RAT');
				flush();
				
				$headers=array();
				$error=$http->ReadReplyHeaders($headers);
				$this->env->cnf->_say('', 'TYPE_RAT');
				if($error=="")
				{
					$this->env->cnf->_say("Response status code:\n".$http->response_status, 'TYPE_RAT');
					switch($http->response_status)
					{
						case "301":
						case "302":
						case "303":
						case "307":
							$this->env->cnf->_say(" (redirect to ".$headers["location"].")\nSet the follow_redirect variable to handle redirect responses automatically.", 'TYPE_RAT');
							break;
					}
					$this->env->cnf->_say('', 'TYPE_RAT');
					$this->env->cnf->_say("Response headers:\n", 'TYPE_RAT');
					for(Reset($headers),$header=0;$header<count($headers);Next($headers),$header++)
					{
						$header_name=Key($headers);
						if(GetType($headers[$header_name])=="array")
						{
							for($header_value=0;$header_value<count($headers[$header_name]);$header_value++)
								$this->env->cnf->_say($header_name.": ".$headers[$header_name][$header_value], 'TYPE_RAT');
						}
						else
							$this->env->cnf->_say($header_name.": ".$headers[$header_name], 'TYPE_RAT');
					}
					$this->env->cnf->_say('', 'TYPE_RAT');
					flush();
					
					//echo "Response body:\n\n";
					/*You can read the whole reply body at once or
					block by block to not exceed PHP memory limits.
					*/
					
					$error = $http->ReadWholeReplyBody($body);
					//if(strlen($error) == 0)
						//echo HtmlSpecialChars($body);
					
					/*for(;;)
					{
						$error=$http->ReadReplyBody($body,1000);
						if($error!="" || strlen($body)==0)
							break;
						//echo $body;//HtmlSpecialChars($body);
						//return...
					}*/

					$this->env->cnf->_say('', 'TYPE_RAT');
					//flush();
				}
			}
			$http->Close();
			unset($http);
		}
		
		if(strlen($error)) 
		{
			$this->env->cnf->_say("Error: ".$error, 'TYPE_LION');
			return null;	
		}

		return ($body);		
	}	
	
	static protected function _say($msg=null, $silent=null)
	{
		if (($msg) && (!$silent))
			return _verbose('[----]'. $msg . PHP_EOL);
		
		return ;
	}

	//http://patorjk.com/software/taag
	static public function grapffiti($x=null, $silent=null) 
	{
		$xz = $x ? $x : rand(2,12); //+2 empty
		//echo '>>>>>>>>>>>>>>>>>>>>>>.'.$xz."\n";
		switch ($xz) {
			
	    case 10 :
self::_say(" __      __        .__  __ /\      /\    ", $silent);
self::_say("/  \    /  \_____  |__|/  |\ \    /  \   ", $silent);
self::_say("\   \/\/   /\__  \ |  \   __\ \   \/\/   ", $silent);
self::_say(" \        /  / __ \|  ||  |  \ \         ", $silent);
self::_say("  \__/\  /  (____  /__||__|   \ \        ", $silent);
self::_say("       \/        \/            \/        ", $silent);
	
//self::_say("\r\n\r\n", $silent);
		break;
				
		case 9 :
self::_say("~~~~~~_~~~~~~~~~~~~~~~~~~~~~~_~~~~~_~_~~~", $silent);
self::_say("~~~~~|~|~~~~~~~~~~~~~~~~~~~~|~|~~~(_)~|~~", $silent);
self::_say("~~___|~|_~___~_~__~___~~___~|~|__~~_|~|_~", $silent);
self::_say("~/~__|~__/~_~\~'__/~_~\/~_~\|~'_~\|~|~__|", $silent);
self::_say("~\__~\~||~~__/~|~|~~__/~(_)~|~|_)~|~|~|_~", $silent);
self::_say("~|___/\__\___|_|~~\___|\___/|_.__/|_|\__|", $silent);
self::_say("~~~~~|~|~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~~__|~|~__~_~~___~_~__~___~~~___~~_~__~~", $silent);
self::_say("~~/~_\`~|/~_\`~|/~_~\~'_~\`~_~\~/~_~\|~\~", $silent);
self::_say("~|~(_|~|~(_|~|~~__/~|~|~|~|~|~(_)~|~|~|~|", $silent);
self::_say("~~\__,_|\__,_|\___|_|~|_|~|_|\___/|_|~|_|", $silent);
self::_say("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~", $silent);

//self::_say("\r\n\r\n", $silent);
		break;
				
		case 8 :	
self::_say("~~~oo_~~~(o)__(o)~~~~~))~~~~~~~~~~~~~.-.~~~~~_~~~wW~~Ww(o)__(o)~~~~~~~~~~~~~~~~", $silent);
self::_say("~~/~~_)-<(__~~__)wWw~(Oo)-.~wWw~~~~c(O_O)c~~/||_~(O)(O)(__~~__)~~~~~~~~~~~~~~~~", $silent);
self::_say("~~\__~\`.~~~(~~)~~(O)_~|~(_))(O)_~~,'.---.\`,~~/\`_)~(..)~(~~)~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~~~~\`.~|~~~)(~~.'~__)|~~.'.'~__)/~/|_|_|\~\|~~\`.~~||~~~~~)(~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~~~~_|~|~~(~~)(~~_)~~)|\\(~~_)~~|~\_____/~||~(_))_||_~~~(~~)~~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~,-'~~~|~~~)/~~\`.__)(/~~\)\`.__)~'.~\`---'~.\`(.'-'(_/\_)~~~)~~~~~~~~~~~~~~~~", $silent);
self::_say("~(_..--'~~~(~~~~~~~~~~)~~~~~~~~~~~~\`-...-'~~~)~~~~~~~~~~~(~~~~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~~~~~_~~~~~~~~~~~~~\\\~~~~///~~~.-.~~~\\\~~///~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~~~_||\~~/)~~~~wWw~((O)~~(O))~c(O_O)c~((O)(O))~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~~(_'\~(o)(O)~~(O)_~|~\~~/~|~,'.---.\`,~|~\~||~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~~.'~~|~//\\~~.'~__)||\\//||/~/|_|_|\~\||\\||~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~((_)~||(__)|(~~_)~~||~\/~|||~\_____/~|||~\~|~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~~\`-\`.)/,-.~|~\`.__)~||~~~~||'.~\`---'~.\`||~~||~~~~~~~~~~~~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~~~~~(-'~~~''~~~~~~(_/~~~~\_)~\`-...-'~(_/~~\_)~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~", $silent);

//self::_say("\r\n\r\n", $silent);
		break;
		
		case 7:
self::_say("~~~_~~~_~~~_~~~_~~~_~~~_~~~_~~~_~~~_~~", $silent);
self::_say("~~/~\~/~\~/~\~/~\~/~\~/~\~/~\~/~\~/~\~", $silent);
self::_say("~(~s~|~t~|~e~|~r~|~e~|~o~|~b~|~i~|~t~)", $silent);
self::_say("~~\_/~\_/~\_/~\_/~\_/~\_/~\_/~\_/~\_/~", $silent);
self::_say("~~~_~~~_~~~_~~~_~~~_~~~_~~~~~~~~~~~~~~", $silent);
self::_say("~~/~\~/~\~/~\~/~\~/~\~/~\~~~~~~~~~~~~~", $silent);
self::_say("~(~d~|~a~|~e~|~m~|~o~|~n~)~~~~~~~~~~~~", $silent);
self::_say("~~\_/~\_/~\_/~\_/~\_/~\_/~~~~~~~~~~~~~", $silent);

//self::_say("\r\n\r\n", $silent);
		break;
			
		case 6:
self::_say("~~~~~~_~~~~~~~~~~~~~~~~~~~~~~_~~~~~_~_~~~", $silent);
self::_say("~~___|~|_~___~_~__~___~~___~|~|__~(_)~|_~", $silent);
self::_say("~/~__|~__/~_~\~'__/~_~\/~_~\|~'_~\|~|~__|", $silent);
self::_say("~\__~\~||~~__/~|~|~~__/~(_)~|~|_)~|~|~|_~", $silent);
self::_say("~|___/\__\___|_|~~\___|\___/|_.__/|_|\__|", $silent);
self::_say("~~~~~~_~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~~__|~|~__~_~~___~_~__~___~~~___~~_~__~~", $silent);
self::_say("~~/~_\`~|/~_\`~|/~_~\~'_~\`~_~\~/~_~\|~\~", $silent);
self::_say("~|~(_|~|~(_|~|~~__/~|~|~|~|~|~(_)~|~|~|~|", $silent);
self::_say("~~\__,_|\__,_|\___|_|~|_|~|_|\___/|_|~|_|", $silent);
self::_say("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~", $silent);
		
//self::_say("\r\n\r\n", $silent);
		break;

		case 5 :
self::_say("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~___~~~~~~~~", $silent);
self::_say("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~/~_~\~~~~~~~", $silent);
self::_say("~~____~___~___~~___~~___~___~|~|_)~)_~___~", $silent);
self::_say("~/~~._|~~~)~__)/~_~\/~__)~_~\|~~_~<|~(~~~)", $silent);
self::_say("(~()~)~|~|>~_)|~|_)~>~_|~(_)~)~|_)~)~||~|~", $silent);
self::_say("~\__/~~~\_)___)~~__/\___)___/|~~__/~\_)\_)", $silent);
self::_say("~~~~~~~~~~~~~~|~|~~~~~~~~~~~~|~|~~~~~~~~~~", $silent);
self::_say("~~~~~~~~~~~~~~|_|~~~~~~~~~~~~|_|~~~~~~~~~~", $silent);
self::_say("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~~__~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~/~_)~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~\~\~~~__~~_____~_~~~_~~___~~_~~__~~~~~~~", $silent);
self::_say("~/~_~\~/~~\/~/~__)~|~|~|/~_~\|~|/~/~~~~~~~", $silent);
self::_say("(~(_)~|~()~~<>~_)|~|_|~(~(_)~)~/~/~~~~~~~~", $silent);
self::_say("~\___/~\__/\_\___)~._,_|\___/|__/~~~~~~~~~", $silent);
self::_say("~~~~~~~~~~~~~~~~~|~|~~~~~~~~~~~~~~~~~~~~~~", $silent);
self::_say("~~~~~~~~~~~~~~~~~|_|~~~~~~~~~~~~~~~~~~~~~~", $silent);
		
//self::_say("\r\n\r\n", $silent);
		break;
		
        case 4 :
self::_say("*****_**********************_*****_*_***", $silent);
self::_say("****|*|********************|*|***(_)*|**", $silent);
self::_say("*___|*|_*___*_*__*___**___*|*|__**_|*|_*", $silent);
self::_say("/*__|*__/*_*\*'__/*_*\/*_*\|*'_*\|*|*__|", $silent);
self::_say("\__*\*||**__/*|*|**__/*(_)*|*|_)*|*|*|_*", $silent);
self::_say("|___/\__\___|_|**\___|\___/|_.__/|_|\__|", $silent);
self::_say("****************************************", $silent);
self::_say("****************************************", $silent);
self::_say("*****_**********************************", $silent);
self::_say("****|*|*********************************", $silent);
self::_say("**__|*|*__*_**___*_*__*___***___**_*__**", $silent);
self::_say("*/*_\`*|/*_\`*|/*_*\*'_*\`*_*\*/*_*\|*\*", $silent);
self::_say("|*(_|*|*(_|*|**__/*|*|*|*|*|*(_)*|*|*|*|", $silent);
self::_say("*\__,_|\__,_|\___|_|*|_|*|_|\___/|_|*|_|", $silent);
self::_say("****************************************", $silent);
self::_say("****************************************", $silent);
				
//self::_say("\r\n\r\n", $silent);
		break;
		
		case 3 :
self::_say("*****_**********************_*****_*_***", $silent);
self::_say("*___|*|_*___*_*__*___**___*|*|__*(_)*|_*", $silent);
self::_say("/*__|*__/*_*\*'__/*_*\/*_*\|*'_*\|*|*__|", $silent);
self::_say("\__*\*||**__/*|*|**__/*(_)*|*|_)*|*|*|_*", $silent);
self::_say("|___/\__\___|_|**\___|\___/|_.__/|_|\__|", $silent);
self::_say("****************************************", $silent);
self::_say("*****_**********************************", $silent);
self::_say("**__|*|*__*_**___*_*__*___***___**_*__**", $silent);
self::_say("*/*_\`*|/*_\`*|/*_*\*'_*\`*_*\*/*_*\|*\*", $silent);
self::_say("|*(_|*|*(_|*|**__/*|*|*|*|*|*(_)*|*|*|*|", $silent);
self::_say("*\__,_|\__,_|\___|_|*|_|*|_|\___/|_|*|_|", $silent);
self::_say("****************************************", $silent);
		
//self::_say("\r\n\r\n", $silent);
		break;
		
		case 2:
		
self::_say("*****_**********************_*****_*_***", $silent);
self::_say("*___|*|_*___*_*__*___**___*|*|__*(_)*|_*", $silent);
self::_say("/*__|*__/*_*\*'__/*_*\/*_*\|*'_*\|*|*__|", $silent);
self::_say("\__*\*||**__/*|*|**__/*(_)*|*|_)*|*|*|_*", $silent);
self::_say("|___/\__\___|_|**\___|\___/|_.__/|_|\__|", $silent);
self::_say("****************************************", $silent);
self::_say("*****_**********************************", $silent);
self::_say("**__|*|*__*_**___*_*__*___***___**_*__**", $silent);
self::_say("*/*_\`*|/*_\`*|/*_*\*'_*\`*_*\*/*_*\|*\*", $silent);
self::_say("|*(_|*|*(_|*|**__/*|*|*|*|*|*(_)*|*|*|*|", $silent);
self::_say("*\__,_|\__,_|\___|_|*|_|*|_|\___/|_|*|_|", $silent);
self::_say("****************************************", $silent);
		
//self::_say("\r\n\r\n", $silent);	
		break;

		
		case 1 :
		//default:			

				//echo self::licence($silent);
				//self::_say("Copyright (c) 2018 stereobit.networlds | Vassilis Alexiou", $silent);
				//self::_say("balexiou@stereobit.com | https://www.stereobit.com", $silent);		
				self::licenceFile('LICENCE-phpdac7.txt', $silent);	
				
		}//switch
	}
	
	static public function licenceFile($file=null, $silent=null) {
		if (!$file) return ;
		
		$lf = @file(getcwd() . '/' . $file);
		if (!empty($lf)) {
			foreach ($lf as $line)
				self::_say($line, $silent);
		}
		else {
			self::_say("Copyright (c) 2018 stereobit.networlds | Vassilis Alexiou", $silent);
			self::_say("balexiou@stereobit.com | https://www.stereobit.com", $silent);						
		}
	}	

	static public function licence($silent) {
		if ($silent) return ;
		
		$ret = "[----]Copyright (c) 2018 stereobit.networlds | Vassilis Alexiou
[----]balexiou@stereobit.com | https://www.stereobit.com
";
/*	
 "\n ***************************************************************************".
 "\n*                                                                          *".                                                                         *".
 "\n****************************************************************************\n";	
 */
		return ($ret);
	}
	
	//public function free()	
	public function __destruct() 
	{	
        //unset($this->dpcpath);	
	} 	
}