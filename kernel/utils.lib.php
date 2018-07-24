<?php
/*
	Licence
	
	Copyright (c) 2018 stereobit.networlds | Vassilis Alexiou
	balexiou@stereobit.com | https://www.stereobit.com
	
	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:
	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.
	
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
	
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

	//http://patorjk.com/software/taag
	static public function grapffiti($x=null) 
	{
		$xz = $x ? $x : rand(2,12); //+2 empty
		//echo '>>>>>>>>>>>>>>>>>>>>>>.'.$xz."\n";
		switch ($xz) {
			
	    case 10 :
_verbose("\n __      __        .__  __ /\      /\    ");
_verbose("\n/  \    /  \_____  |__|/  |\ \    /  \   ");
_verbose("\n\   \/\/   /\__  \ |  \   __\ \   \/\/   ");
_verbose("\n \        /  / __ \|  ||  |  \ \         ");
_verbose("\n  \__/\  /  (____  /__||__|   \ \        ");
_verbose("\n       \/        \/            \/        ");
	
_verbose("\r\n\r\n");
		break;
				
		case 9 :
_verbose("\n~~~~~~_~~~~~~~~~~~~~~~~~~~~~~_~~~~~_~_~~~");
_verbose("\n~~~~~|~|~~~~~~~~~~~~~~~~~~~~|~|~~~(_)~|~~");
_verbose("\n~~___|~|_~___~_~__~___~~___~|~|__~~_|~|_~");
_verbose("\n~/~__|~__/~_~\~'__/~_~\/~_~\|~'_~\|~|~__|");
_verbose("\n~\__~\~||~~__/~|~|~~__/~(_)~|~|_)~|~|~|_~");
_verbose("\n~|___/\__\___|_|~~\___|\___/|_.__/|_|\__|");
_verbose("\n~~~~~|~|~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
_verbose("\n~~~__|~|~__~_~~___~_~__~___~~~___~~_~__~~");
_verbose("\n~~/~_\`~|/~_\`~|/~_~\~'_~\`~_~\~/~_~\|~\~");
_verbose("\n~|~(_|~|~(_|~|~~__/~|~|~|~|~|~(_)~|~|~|~|");
_verbose("\n~~\__,_|\__,_|\___|_|~|_|~|_|\___/|_|~|_|");
_verbose("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
_verbose("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");

_verbose("\r\n\r\n");
		break;
				
		case 8 :	
_verbose("\n~~~oo_~~~(o)__(o)~~~~~))~~~~~~~~~~~~~.-.~~~~~_~~~wW~~Ww(o)__(o)~~~~~~~~~~~~~~~~");
_verbose("\n~~/~~_)-<(__~~__)wWw~(Oo)-.~wWw~~~~c(O_O)c~~/||_~(O)(O)(__~~__)~~~~~~~~~~~~~~~~");
_verbose("\n~~\__~\`.~~~(~~)~~(O)_~|~(_))(O)_~~,'.---.\`,~~/\`_)~(..)~(~~)~~~~~~~~~~~~~~~~~");
_verbose("\n~~~~~\`.~|~~~)(~~.'~__)|~~.'.'~__)/~/|_|_|\~\|~~\`.~~||~~~~~)(~~~~~~~~~~~~~~~~~");
_verbose("\n~~~~~_|~|~~(~~)(~~_)~~)|\\(~~_)~~|~\_____/~||~(_))_||_~~~(~~)~~~~~~~~~~~~~~~~~~");
_verbose("\n~~,-'~~~|~~~)/~~\`.__)(/~~\)\`.__)~'.~\`---'~.\`(.'-'(_/\_)~~~)~~~~~~~~~~~~~~~~");
_verbose("\n~(_..--'~~~(~~~~~~~~~~)~~~~~~~~~~~~\`-...-'~~~)~~~~~~~~~~~(~~~~~~~~~~~~~~~~~~~~");
_verbose("\n~~~~~~_~~~~~~~~~~~~~\\\~~~~///~~~.-.~~~\\\~~///~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
_verbose("\n~~~~_||\~~/)~~~~wWw~((O)~~(O))~c(O_O)c~((O)(O))~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
_verbose("\n~~~(_'\~(o)(O)~~(O)_~|~\~~/~|~,'.---.\`,~|~\~||~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
_verbose("\n~~~.'~~|~//\\~~.'~__)||\\//||/~/|_|_|\~\||\\||~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
_verbose("\n~~((_)~||(__)|(~~_)~~||~\/~|||~\_____/~|||~\~|~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
_verbose("\n~~~\`-\`.)/,-.~|~\`.__)~||~~~~||'.~\`---'~.\`||~~||~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
_verbose("\n~~~~~~(-'~~~''~~~~~~(_/~~~~\_)~\`-...-'~(_/~~\_)~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");

_verbose("\r\n\r\n");
		break;
		
		case 7:
_verbose("\n~~~_~~~_~~~_~~~_~~~_~~~_~~~_~~~_~~~_~~");
_verbose("\n~~/~\~/~\~/~\~/~\~/~\~/~\~/~\~/~\~/~\~");
_verbose("\n~(~s~|~t~|~e~|~r~|~e~|~o~|~b~|~i~|~t~)");
_verbose("\n~~\_/~\_/~\_/~\_/~\_/~\_/~\_/~\_/~\_/~");
_verbose("\n~~~_~~~_~~~_~~~_~~~_~~~_~~~~~~~~~~~~~~");
_verbose("\n~~/~\~/~\~/~\~/~\~/~\~/~\~~~~~~~~~~~~~");
_verbose("\n~(~d~|~a~|~e~|~m~|~o~|~n~)~~~~~~~~~~~~");
_verbose("\n~~\_/~\_/~\_/~\_/~\_/~\_/~~~~~~~~~~~~~");

_verbose("\r\n\r\n");
		break;
			
		case 6:
_verbose("\n~~~~~~_~~~~~~~~~~~~~~~~~~~~~~_~~~~~_~_~~~");
_verbose("\n~~___|~|_~___~_~__~___~~___~|~|__~(_)~|_~");
_verbose("\n~/~__|~__/~_~\~'__/~_~\/~_~\|~'_~\|~|~__|");
_verbose("\n~\__~\~||~~__/~|~|~~__/~(_)~|~|_)~|~|~|_~");
_verbose("\n~|___/\__\___|_|~~\___|\___/|_.__/|_|\__|");
_verbose("\n~~~~~~_~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
_verbose("\n~~~__|~|~__~_~~___~_~__~___~~~___~~_~__~~");
_verbose("\n~~/~_\`~|/~_\`~|/~_~\~'_~\`~_~\~/~_~\|~\~");
_verbose("\n~|~(_|~|~(_|~|~~__/~|~|~|~|~|~(_)~|~|~|~|");
_verbose("\n~~\__,_|\__,_|\___|_|~|_|~|_|\___/|_|~|_|");
_verbose("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
		
_verbose("\r\n\r\n");
		break;

		case 5 :
_verbose("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
_verbose("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~___~~~~~~~~");
_verbose("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~/~_~\~~~~~~~");
_verbose("\n~~____~___~___~~___~~___~___~|~|_)~)_~___~");
_verbose("\n~/~~._|~~~)~__)/~_~\/~__)~_~\|~~_~<|~(~~~)");
_verbose("\n(~()~)~|~|>~_)|~|_)~>~_|~(_)~)~|_)~)~||~|~");
_verbose("\n~\__/~~~\_)___)~~__/\___)___/|~~__/~\_)\_)");
_verbose("\n~~~~~~~~~~~~~~|~|~~~~~~~~~~~~|~|~~~~~~~~~~");
_verbose("\n~~~~~~~~~~~~~~|_|~~~~~~~~~~~~|_|~~~~~~~~~~");
_verbose("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
_verbose("\n~~~__~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
_verbose("\n~~/~_)~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
_verbose("\n~~\~\~~~__~~_____~_~~~_~~___~~_~~__~~~~~~~");
_verbose("\n~/~_~\~/~~\/~/~__)~|~|~|/~_~\|~|/~/~~~~~~~");
_verbose("\n(~(_)~|~()~~<>~_)|~|_|~(~(_)~)~/~/~~~~~~~~");
_verbose("\n~\___/~\__/\_\___)~._,_|\___/|__/~~~~~~~~~");
_verbose("\n~~~~~~~~~~~~~~~~~|~|~~~~~~~~~~~~~~~~~~~~~~");
_verbose("\n~~~~~~~~~~~~~~~~~|_|~~~~~~~~~~~~~~~~~~~~~~");
		
_verbose("\r\n\r\n");
		break;
		
        case 4 :
_verbose("\n*****_**********************_*****_*_***");
_verbose("\n****|*|********************|*|***(_)*|**");
_verbose("\n*___|*|_*___*_*__*___**___*|*|__**_|*|_*");
_verbose("\n/*__|*__/*_*\*'__/*_*\/*_*\|*'_*\|*|*__|");
_verbose("\n\__*\*||**__/*|*|**__/*(_)*|*|_)*|*|*|_*");
_verbose("\n|___/\__\___|_|**\___|\___/|_.__/|_|\__|");
_verbose("\n****************************************");
_verbose("\n****************************************");
_verbose("\n*****_**********************************");
_verbose("\n****|*|*********************************");
_verbose("\n**__|*|*__*_**___*_*__*___***___**_*__**");
_verbose("\n*/*_\`*|/*_\`*|/*_*\*'_*\`*_*\*/*_*\|*\*");
_verbose("\n|*(_|*|*(_|*|**__/*|*|*|*|*|*(_)*|*|*|*|");
_verbose("\n*\__,_|\__,_|\___|_|*|_|*|_|\___/|_|*|_|");
_verbose("\n****************************************");
_verbose("\n****************************************");
				
_verbose("\r\n\r\n");
		break;
		
		case 3 :
_verbose("\n*****_**********************_*****_*_***");
_verbose("\n*___|*|_*___*_*__*___**___*|*|__*(_)*|_*");
_verbose("\n/*__|*__/*_*\*'__/*_*\/*_*\|*'_*\|*|*__|");
_verbose("\n\__*\*||**__/*|*|**__/*(_)*|*|_)*|*|*|_*");
_verbose("\n|___/\__\___|_|**\___|\___/|_.__/|_|\__|");
_verbose("\n****************************************");
_verbose("\n*****_**********************************");
_verbose("\n**__|*|*__*_**___*_*__*___***___**_*__**");
_verbose("\n*/*_\`*|/*_\`*|/*_*\*'_*\`*_*\*/*_*\|*\*");
_verbose("\n|*(_|*|*(_|*|**__/*|*|*|*|*|*(_)*|*|*|*|");
_verbose("\n*\__,_|\__,_|\___|_|*|_|*|_|\___/|_|*|_|");
_verbose("\n****************************************");
		
_verbose("\r\n\r\n");
		break;
		
		case 2:
		
_verbose("\n*****_**********************_*****_*_***");
_verbose("\n*___|*|_*___*_*__*___**___*|*|__*(_)*|_*");
_verbose("\n/*__|*__/*_*\*'__/*_*\/*_*\|*'_*\|*|*__|");
_verbose("\n\__*\*||**__/*|*|**__/*(_)*|*|_)*|*|*|_*");
_verbose("\n|___/\__\___|_|**\___|\___/|_.__/|_|\__|");
_verbose("\n****************************************");
_verbose("\n*****_**********************************");
_verbose("\n**__|*|*__*_**___*_*__*___***___**_*__**");
_verbose("\n*/*_\`*|/*_\`*|/*_*\*'_*\`*_*\*/*_*\|*\*");
_verbose("\n|*(_|*|*(_|*|**__/*|*|*|*|*|*(_)*|*|*|*|");
_verbose("\n*\__,_|\__,_|\___|_|*|_|*|_|\___/|_|*|_|");
_verbose("\n****************************************");
		
_verbose("\r\n\r\n");	
		break;

		
		case 1 :
		//default:			
/*
	Licence
	
	Copyright (c) 2018 stereobit.networlds | Vassilis Alexiou
	balexiou@stereobit.com | https://www.stereobit.com
	
	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:
	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.
	
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.

	    _verbose("\n\r\n\r");
*/
_verbose(self::licence());
			
		}//switch
	}

	static public function licence() {
		$ret = "
[----]Copyright (c) 2018 stereobit.networlds | Vassilis Alexiou
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
?>