<?php
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
		$http->follow_redirect=0;
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


echo "\n __      __        .__  __ /\      /\    ";
echo "\n/  \    /  \_____  |__|/  |\ \    /  \   ";
echo "\n\   \/\/   /\__  \ |  \   __\ \   \/\/   ";
echo "\n \        /  / __ \|  ||  |  \ \         ";
echo "\n  \__/\  /  (____  /__||__|   \ \        ";
echo "\n       \/        \/            \/        ";
	
		echo "\r\n\r\n";
		break;
				
		case 9 :
echo "\n~~~~~~_~~~~~~~~~~~~~~~~~~~~~~_~~~~~_~_~~~";
echo "\n~~~~~|~|~~~~~~~~~~~~~~~~~~~~|~|~~~(_)~|~~";
echo "\n~~___|~|_~___~_~__~___~~___~|~|__~~_|~|_~";
echo "\n~/~__|~__/~_~\~'__/~_~\/~_~\|~'_~\|~|~__|";
echo "\n~\__~\~||~~__/~|~|~~__/~(_)~|~|_)~|~|~|_~";
echo "\n~|___/\__\___|_|~~\___|\___/|_.__/|_|\__|";
echo "\n~~~~~|~|~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~__|~|~__~_~~___~_~__~___~~~___~~_~__~~";
echo "\n~~/~_\`~|/~_\`~|/~_~\~'_~\`~_~\~/~_~\|~\~";
echo "\n~|~(_|~|~(_|~|~~__/~|~|~|~|~|~(_)~|~|~|~|";
echo "\n~~\__,_|\__,_|\___|_|~|_|~|_|\___/|_|~|_|";
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";


		echo "\r\n\r\n";
		break;
				
		case 8 :	
echo "\n~~~oo_~~~(o)__(o)~~~~~))~~~~~~~~~~~~~.-.~~~~~_~~~wW~~Ww(o)__(o)~~~~~~~~~~~~~~~~";
echo "\n~~/~~_)-<(__~~__)wWw~(Oo)-.~wWw~~~~c(O_O)c~~/||_~(O)(O)(__~~__)~~~~~~~~~~~~~~~~";
echo "\n~~\__~\`.~~~(~~)~~(O)_~|~(_))(O)_~~,'.---.\`,~~/\`_)~(..)~(~~)~~~~~~~~~~~~~~~~~";
echo "\n~~~~~\`.~|~~~)(~~.'~__)|~~.'.'~__)/~/|_|_|\~\|~~\`.~~||~~~~~)(~~~~~~~~~~~~~~~~~";
echo "\n~~~~~_|~|~~(~~)(~~_)~~)|\\(~~_)~~|~\_____/~||~(_))_||_~~~(~~)~~~~~~~~~~~~~~~~~~";
echo "\n~~,-'~~~|~~~)/~~\`.__)(/~~\)\`.__)~'.~\`---'~.\`(.'-'(_/\_)~~~)~~~~~~~~~~~~~~~~";
echo "\n~(_..--'~~~(~~~~~~~~~~)~~~~~~~~~~~~\`-...-'~~~)~~~~~~~~~~~(~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~~~~_~~~~~~~~~~~~~\\\~~~~///~~~.-.~~~\\\~~///~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~~_||\~~/)~~~~wWw~((O)~~(O))~c(O_O)c~((O)(O))~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~(_'\~(o)(O)~~(O)_~|~\~~/~|~,'.---.\`,~|~\~||~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~.'~~|~//\\~~.'~__)||\\//||/~/|_|_|\~\||\\||~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~((_)~||(__)|(~~_)~~||~\/~|||~\_____/~|||~\~|~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~\`-\`.)/,-.~|~\`.__)~||~~~~||'.~\`---'~.\`||~~||~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~~~~(-'~~~''~~~~~~(_/~~~~\_)~\`-...-'~(_/~~\_)~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";


		echo "\r\n\r\n";
		break;
		
		case 7:
echo "\n~~~_~~~_~~~_~~~_~~~_~~~_~~~_~~~_~~~_~~";
echo "\n~~/~\~/~\~/~\~/~\~/~\~/~\~/~\~/~\~/~\~";
echo "\n~(~s~|~t~|~e~|~r~|~e~|~o~|~b~|~i~|~t~)";
echo "\n~~\_/~\_/~\_/~\_/~\_/~\_/~\_/~\_/~\_/~";
echo "\n~~~_~~~_~~~_~~~_~~~_~~~_~~~~~~~~~~~~~~";
echo "\n~~/~\~/~\~/~\~/~\~/~\~/~\~~~~~~~~~~~~~";
echo "\n~(~d~|~a~|~e~|~m~|~o~|~n~)~~~~~~~~~~~~";
echo "\n~~\_/~\_/~\_/~\_/~\_/~\_/~~~~~~~~~~~~~";


		echo "\r\n\r\n";
		break;
			
		case 6:
		
echo "\n~~~~~~_~~~~~~~~~~~~~~~~~~~~~~_~~~~~_~_~~~";
echo "\n~~___|~|_~___~_~__~___~~___~|~|__~(_)~|_~";
echo "\n~/~__|~__/~_~\~'__/~_~\/~_~\|~'_~\|~|~__|";
echo "\n~\__~\~||~~__/~|~|~~__/~(_)~|~|_)~|~|~|_~";
echo "\n~|___/\__\___|_|~~\___|\___/|_.__/|_|\__|";
echo "\n~~~~~~_~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~__|~|~__~_~~___~_~__~___~~~___~~_~__~~";
echo "\n~~/~_\`~|/~_\`~|/~_~\~'_~\`~_~\~/~_~\|~\~";
echo "\n~|~(_|~|~(_|~|~~__/~|~|~|~|~|~(_)~|~|~|~|";
echo "\n~~\__,_|\__,_|\___|_|~|_|~|_|\___/|_|~|_|";
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
		
		echo "\r\n\r\n";
		break;

		case 5 :
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~___~~~~~~~~";
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~/~_~\~~~~~~~";
echo "\n~~____~___~___~~___~~___~___~|~|_)~)_~___~";
echo "\n~/~~._|~~~)~__)/~_~\/~__)~_~\|~~_~<|~(~~~)";
echo "\n(~()~)~|~|>~_)|~|_)~>~_|~(_)~)~|_)~)~||~|~";
echo "\n~\__/~~~\_)___)~~__/\___)___/|~~__/~\_)\_)";
echo "\n~~~~~~~~~~~~~~|~|~~~~~~~~~~~~|~|~~~~~~~~~~";
echo "\n~~~~~~~~~~~~~~|_|~~~~~~~~~~~~|_|~~~~~~~~~~";
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~__~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~/~_)~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~\~\~~~__~~_____~_~~~_~~___~~_~~__~~~~~~~";
echo "\n~/~_~\~/~~\/~/~__)~|~|~|/~_~\|~|/~/~~~~~~~";
echo "\n(~(_)~|~()~~<>~_)|~|_|~(~(_)~)~/~/~~~~~~~~";
echo "\n~\___/~\__/\_\___)~._,_|\___/|__/~~~~~~~~~";
echo "\n~~~~~~~~~~~~~~~~~|~|~~~~~~~~~~~~~~~~~~~~~~";
echo "\n~~~~~~~~~~~~~~~~~|_|~~~~~~~~~~~~~~~~~~~~~~";
		
		echo "\r\n\r\n";
		break;
		
        case 4 :
echo "\n*****_**********************_*****_*_***";
echo "\n****|*|********************|*|***(_)*|**";
echo "\n*___|*|_*___*_*__*___**___*|*|__**_|*|_*";
echo "\n/*__|*__/*_*\*'__/*_*\/*_*\|*'_*\|*|*__|";
echo "\n\__*\*||**__/*|*|**__/*(_)*|*|_)*|*|*|_*";
echo "\n|___/\__\___|_|**\___|\___/|_.__/|_|\__|";
echo "\n****************************************";
echo "\n****************************************";
echo "\n*****_**********************************";
echo "\n****|*|*********************************";
echo "\n**__|*|*__*_**___*_*__*___***___**_*__**";
echo "\n*/*_\`*|/*_\`*|/*_*\*'_*\`*_*\*/*_*\|*\*";
echo "\n|*(_|*|*(_|*|**__/*|*|*|*|*|*(_)*|*|*|*|";
echo "\n*\__,_|\__,_|\___|_|*|_|*|_|\___/|_|*|_|";
echo "\n****************************************";
echo "\n****************************************";
		
		
		echo "\r\n\r\n";
		break;
		
		case 3 :
echo "\n*****_**********************_*****_*_***";
echo "\n*___|*|_*___*_*__*___**___*|*|__*(_)*|_*";
echo "\n/*__|*__/*_*\*'__/*_*\/*_*\|*'_*\|*|*__|";
echo "\n\__*\*||**__/*|*|**__/*(_)*|*|_)*|*|*|_*";
echo "\n|___/\__\___|_|**\___|\___/|_.__/|_|\__|";
echo "\n****************************************";
echo "\n*****_**********************************";
echo "\n**__|*|*__*_**___*_*__*___***___**_*__**";
echo "\n*/*_\`*|/*_\`*|/*_*\*'_*\`*_*\*/*_*\|*\*";
echo "\n|*(_|*|*(_|*|**__/*|*|*|*|*|*(_)*|*|*|*|";
echo "\n*\__,_|\__,_|\___|_|*|_|*|_|\___/|_|*|_|";
echo "\n****************************************";
		
		echo "\r\n\r\n";
		break;
		
		case 2:
		
echo "\n*****_**********************_*****_*_***";
echo "\n*___|*|_*___*_*__*___**___*|*|__*(_)*|_*";
echo "\n/*__|*__/*_*\*'__/*_*\/*_*\|*'_*\|*|*__|";
echo "\n\__*\*||**__/*|*|**__/*(_)*|*|_)*|*|*|_*";
echo "\n|___/\__\___|_|**\___|\___/|_.__/|_|\__|";
echo "\n****************************************";
echo "\n*****_**********************************";
echo "\n**__|*|*__*_**___*_*__*___***___**_*__**";
echo "\n*/*_\`*|/*_\`*|/*_*\*'_*\`*_*\*/*_*\|*\*";
echo "\n|*(_|*|*(_|*|**__/*|*|*|*|*|*(_)*|*|*|*|";
echo "\n*\__,_|\__,_|\___|_|*|_|*|_|\___/|_|*|_|";
echo "\n****************************************";
		
		echo "\r\n\r\n";	
		break;

		
		case 1 :
		//default:	
/*		
echo "\n**************************************************";
echo "\n* stereobit daemon - a minimal script agency*.   *";
echo "\n*                                                *";
echo "\n*   Copyright 2015-18,  balexiou@stereobit.com   *";
echo "\n*                                                *";
echo "\n*   This digital loop is owned by the numbers.   *";
echo "\n*   Is free for them but you can play as long    *";
echo "\n*   your personal pc can consume electric energy.*";
echo "\n*   Distribute with care and ask for detailsit   *";
echo "\n*   if you like to modify it under the terms of  *";
echo "\n*   the GNU Library General Public License.      *";
echo "\n*                                                *";
echo "\n*   License as published by the Free Software    *";
echo "\n*   Foundation; either version 2 of the License, *";
echo "\n*   (at your option) any later version.          *";
echo "\n*                                                *";
echo "\n*   This piece of software is distributed in the *";
echo "\n*   hope that it will be useful somehow,         *";
echo "\n*   but WITHOUT ANY WARRANTY without even        *";
echo "\n*   the implied warranty of MERCHANTABILITY or   *";
echo "\n*   FITNESS FOR A PARTICULAR PURPOSE.            *";
echo "\n*   See the GNU Library General Public License   *";
echo "\n*   for Library General Public License for more  *";
echo "\n*   details.                                     *";
echo "\n*                                                *";
echo "\n*   You should have received a copy of the GNU   *";
echo "\n*   Library General Public License along with    *";
echo "\n*   this library.                                *";
echo "\n*	If not, write to the Free Software			 *";
echo "\n*                                                *";
echo "\n*   (*)If you feel that writing scripts and code *";
echo "\n*   is your forte, these are some agents who     *";
echo "\n*   specialise in handling this type of material *";
echo "\n*                                                *";
echo "\n**************************************************";

	    echo "\n\r\n\r";*/
		echo self::licence();
			
		}//switch
	}

	static public function licence() {
		$ret =
 "\n/***************************************************************************".
 "\n*                                                                          *".
 "\n*  Copyright 2018,     balexiou@stereobit.com                              *".
 "\n*                                                                          *".
 "\n*  Licensed under the Apache License, Version 2.0 (the \"License\");       *".
 "\n*  you may not use this file except in compliance with the License         *".
 "\n*  You may obtain a copy of the License at                                 *".
 "\n*                                                                          *".
 "\n*  http://www.apache.org/licenses/LICENSE-2.0                              *".
 "\n*                                                                          *".
 "\n*  Unless required by applicable law or agreed to in writing, software     *".
 "\n*  distributed under the License is distributed on an \"AS IS\" BASIS,     *".
 "\n*  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.*".
 "\n*  See the License for the specific language governing permissions and     *".
 "\n*  limitations under the License.                                          *".
 "\n*                                                                          *".
 "\n*                                                                          *".
 "\n****************************************************************************/\n";	
		return ($ret);
	}
}
?>