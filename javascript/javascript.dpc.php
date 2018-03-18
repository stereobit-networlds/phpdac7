<?php
if (!defined("JAVASCRIPT_DPC")) {
define("JAVASCRIPT_DPC",true);

$__DPC['JAVASCRIPT_DPC'] = 'jscript';

GetGlobal('controller')->_require('javascript/minifier.lib.php');

class jscript {

    var $codearray;
	var $extcodearray;
	var $encoding, $url, $jspath, $csspath, $obf;

	function __construct() { 
	    //encoding
		$this->encoding = 'utf-8';
		//$this->url = paramload('SHELL','urlbase');
		$this->url = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
		$this->url.= $_SERVER['HTTP_HOST'];//(strstr($_SERVER['HTTP_HOST'], 'www')) ? $_SERVER['HTTP_HOST'] : 'www.' . $_SERVER['HTTP_HOST'];

		//js path
		$jp = paramload('JAVASCRIPT','jspath');
        $this->jspath = $jp ? $jp : null;//'js'; //maybe in root ?	
		
		//css path
		$cp = paramload('JAVASCRIPT','csspath');
		$this->csspath = $cp ? $cp : null;//'css'; //maybe in js dir
		
		$o = paramload('JAVASCRIPT','obf');
		$this->obf = $o ? true : false;
	}



function startJS() {
  $js = "\n\n<script language=\"JavaScript\">\n"; 
  return ($js);
} 

function endJS() {
  $js .= "</script>\n";
  return ($js);
} 

function callJavaS() {
   $codebuffer = GetGlobal('codebuffer');
   $externalcodebuffer = GetGlobal('externalcodebuffer');

   $this->codearray = array();
   $this->codearray = (array)$codebuffer;   
   //print_r($externalcodebuffer);
   
   //initialize js .. call default js scripts
   //$js = $this->startJS();     
   
   // call all the used java scripts from codebuffer   
   reset($this->codearray);
   //while (list ($line_num, $codeline) = each ($codearray)) {
   $_js = null;
   foreach ($this->codearray as $line_num => $codeline) {   
     $_js .= $codeline;
   }
   if ($_js)
     $js = $this->startJS() . $_js . $this->endJS();

   $this->extcodearray = array();
   $this->extcodearray = (array)$externalcodebuffer;   
   
   // call all the external java files scripts 
   reset($this->extcodearray); 
   //while (list ($linenum, $cline) = each ($extcodearray)) {
   foreach ($this->extcodearray as $linenum => $cline) {   
     $js .= $cline;
   }   
   
   unset ($codearray);  
   unset ($extcodearray);
   
   return ($js);
}

function JS_function($code,$params) {

  $codebuffer = GetGlobal('codebuffer');

  //getparams
  $param = explode(";" , $params);

  switch ($code) {
     case "js_openwin"  : $codeout = "onClick=\"MM_openBrWindow('$param[0]','$param[1]','$param[2]')\""; break;
	 
     //require chromewin jscript load
	 case "js_chromewin": $codeout = "onClick=\"$param[0]=openIT('$param[1]',$param[2],$param[3],$param[4],$param[5],'$param[0]',5,true,true,true);return false\""; break;	 
	 
	 case "js_closewin" : switch ($param[1]) {
	                        case 1  : $codeout = "<a href=\"#\" onClick=\"closeWindow()\">$param[0]</a>"; break;
	                        default : $codeout = "<input type=\"submit\" class='myf_button' name=\"closewin\" value=\"$param[0]\" onClick=\"closeWindow()\">";
						  }
						  break;
	 case "js_printwin" : switch ($param[1]) {
	                        case 1  : $codeout = "<a href=\"#\" onClick=\"printWindow()\">$param[0]</a>"; break;
	                        default : $codeout = "<input type=\"submit\" class='myf_button' name=\"printwin\" value=\"$param[0]\" onClick=\"window.print()\">";
						  }
						  break;
	 case "js_popimage" : $codeout = "onClick=\"jkpopimage('$param[0]',$param[1],$param[2],'$param[3]')\""; break;					  
  } 
  

    if (!$this->isincodebuffer($code)) {
       switch ($code) {	
	     case "js_openwin"  : $codebuffer[] = $this->js_openwin(); break;
	     case "js_chromewin": $codebuffer[] = $this->js_chromewin(); break;		 
	     case "js_closewin" : $codebuffer[] = $this->js_closewin(); break;
	     case "js_printwin" : $codebuffer[] = $this->js_printwin(); break;		 		 
	     case "js_popimage" : $codebuffer[] = $this->js_popimage(); break;			 		 
	   }
	}  
  
  SetGlobal('codebuffer',$codebuffer);
  
  return ($codeout);

}

function isincodebuffer($command) {
  $combuffer = GetGlobal('combuffer');
  
  if (!in_array($command,(array)$combuffer)) {
  
    $combuffer[] = $command; 
	SetGlobal('combuffer',$combuffer);
	
	return false;   
  }
  return true;
}

//open browser new window
//onLoad="MM_openBrWindow('...
function js_openwin() {
  $js =  "<!-- start java script -->\n";
  $js .= "function MM_openBrWindow(theURL,winName,features) {\n";
  $js .= "window.open(theURL,winName,features);\n}\n";
  
  return ($js);
}

function js_chromewin() {
  $js  = "<!-- start java script -->\n";  
  $js .= "function openIT(u,W,H,X,Y,n,b,x,m,r) {\n";
  $js .= "var cU  ='close.gif'\n";
  $js .= "var cO  ='close.gif'\n";
  $js .= "var cL  ='clock.gif'\n";
  $js .= "var mU  ='minimize.gif'\n";
  $js .= "var mO  ='minimize.gif'\n";
  $js .= "var xU  ='max.gif'\n";
  $js .= "var xO  ='max.gif'\n";
  $js .= "var rU  ='restore.gif'\n";
  $js .= "var rO  ='restore.gif'\n";
  $js .= "var tH  ='<font face=verdana size=2>Chromeless Window</font>' \n";
  $js .= "var tW  ='Chromeless Window'   \n";
  $js .= "var wB  ='#D5D5FF' \n";
  $js .= "var wBs ='#D5D5FF' \n";
  $js .= "var wBG ='#D5D5FF' \n";
  $js .= "var wBGs='#D5D5FF' \n";
  $js .= "var wNS ='toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0' \n";
  $js .= "var fSO ='scrolling=auto noresize'   \n";
  $js .= "var brd =b||5;   \n";
  $js .= "var max =x||false;\n";
  $js .= "var min =m||false; \n";
  $js .= "var res =r||false;\n";
  $js .= "var tsz =20;\n";
  $js .= "return chromeless(u,n,W,H,X,Y,cU,cO,cL,mU,mO,xU,xO,rU,rO,tH,tW,wB,wBs,wBG,wBGs,wNS,fSO,brd,max,min,res,tsz)\n";
  $js .= "}\n";

  return ($js);
}

function js_closewin() {
  $js = "<!-- start java script -->\n";
  $js .="function closeWindow() {\n";
  $js .="window.close();\n}\n";
  
  return ($js);
}

function js_printwin() {
  $js = "<!-- start java script -->\n";
  $js .="function printWindow() {\n";
  $js .="window.print();\n}\n";
  
  return ($js);
}

function js_popimage() {

  $js = <<<EOF
var popbackground="lightskyblue" 
var windowtitle="Image Window"  

function detectexist(obj){
return (typeof obj !="undefined")
}

function jkpopimage(imgpath, popwidth, popheight, textdescription){

function getpos(){
leftpos=(detectexist(window.screenLeft))? screenLeft+document.body.clientWidth/2-popwidth/2 : detectexist(window.screenX)? screenX+innerWidth/2-popwidth/2 : 0
toppos=(detectexist(window.screenTop))? screenTop+document.body.clientHeight/2-popheight/2 : detectexist(window.screenY)? screenY+innerHeight/2-popheight/2 : 0
if (window.opera){
leftpos-=screenLeft
toppos-=screenTop
}
}

getpos()
var winattributes='width='+popwidth+',height='+popheight+',resizable=yes,left='+leftpos+',top='+toppos
var bodyattribute=(popbackground.indexOf(".")!=-1)? 'background="'+popbackground+'"' : 'bgcolor="'+popbackground+'"'
if (typeof jkpopwin=="undefined" || jkpopwin.closed)
jkpopwin=window.open("","",winattributes)
else{
jkpopwin.resizeTo(popwidth, popheight+30)
}
jkpopwin.document.open()
jkpopwin.document.write('<html><title>'+windowtitle+'</title><body '+bodyattribute+'><img src="'+imgpath+'" style="margin-bottom: 0.5em"><br>'+textdescription+'</body></html>')
jkpopwin.document.close()
jkpopwin.focus()
}
  
EOF;

  return ($js);
}


function load_js($jscript,$ver='',$istext=0,$additional_text=null,$nopath=null) {
    $externalcodebuffer = GetGlobal('externalcodebuffer');
	$fjspathname = ($nopath) ? $jscript : $this->url . $this->jspath . $jscript;

    if (!$istext) 
		$js = "<script type=\"text/javascript\" src=\"$fjspathname\"></script>\n";
	else 
		$js = "<script type=\"text/javascript\">\n" . $this->obfuscate($jscript) . "</script>\n";
	
	//test purposes (used to pass css text)		 
	$js .= $additional_text;		 

	//check for doubles	
	$isin = 0;
	if (!empty($externalcodebuffer)) {	
		for ($i=0;$i<count($externalcodebuffer);$i++)
			if ($externalcodebuffer[$i] == $js) $isin=1;	
	}  
	if (!$isin) $externalcodebuffer[] = $js;	
	
    SetGlobal('externalcodebuffer',$externalcodebuffer);
	
	return ($js);
}

function js_button() {
}



function setLoadParams($params) {
   $loader_code = GetGlobal('loader_code');
   
   //check if param exist
   for ($i=0;$i<count($loader_code);$i++)
      if ($loader_code[$i]==$params) return(0);   
   
   $loader_code[] = $params;
   
   SetGlobal('loader_code',$loader_code);   

}

function onLoad() {
   $loader_code = GetGlobal('loader_code');
   
   $out = null;
   if (!empty($loader_code)) {
	   
	$ar_code = (array) $loader_code;
	for ($i=0;$i<count($loader_code);$i++)
      $code .= $loader_code[$i];
	 
	$out = "onLoad=\"$code\"";
   }
   
   return ($out);
}

function startCSS() {
  $css = '';
  return ($css);
} 

function endCSS() {
  $css .= '';
  return ($css);
} 

function load_css($cssname) {
    if (!$cssname) return;
	
    $externalcodebuffer = GetGlobal('externalcodebuffer');
	$csspathname = $this->url .'/'. $this->csspath . $cssname;			 
	$css = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"" . $csspathname . "\"></link>\n";
		 

	//check for doubles		 
    for ($i=0;$i<count($externalcodebuffer);$i++)
	  if ($externalcodebuffer[$i] == $css) $isin=1;	
	  
	if (!$isin) $externalcodebuffer[] = $css;	
	
    SetGlobal('externalcodebuffer',$externalcodebuffer);
	
	return ($css);
}

function obfuscate($script=null) {
	if (!$script) return false;
	
	if (($this->obf) || (paramload('CMS','obfuscate')))
		//return \JShrink\Minifier::minify($script);
		return Minifier::minify($script);
		
	return ($script);
}

};
}
?>