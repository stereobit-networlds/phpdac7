<?php

//stackoverflow.com/questions/9058158/using-php-preg-replace-to-change-html-links-href-attribute
//href preplace
echo preg_replace('/<a(.*)href="([^"]*)"(.*)>/','<a$1href="javascript:alert(\'Test\');"$3>',$string_of_text);


//www.damnsemicolon.com/php/parse-emails-in-php-with-email-piping-part-2
//include email parser
require_once('/path/to/class/rfc822_addresses.php');
require_once('/path/to/class/mime_parser.php');

// read email in from stdin
$fd = fopen("php://stdin", "r");
$email = "";
while (!feof($fd)) {
    $email .= fread($fd, 1024);
}
fclose($fd);

//create the email parser class
$mime=new mime_parser_class;
$mime->ignore_syntax_errors = 1;
$parameters=array(
	'Data'=>$email,
);
	
$mime->Decode($parameters, $decoded);

//---------------------- GET EMAIL HEADER INFO -----------------------//

//get the name and email of the sender
$fromName = $decoded[0]['ExtractedAddresses']['from:'][0]['name'];
$fromEmail = $decoded[0]['ExtractedAddresses']['from:'][0]['address'];

//get the name and email of the recipient
$toEmail = $decoded[0]['ExtractedAddresses']['to:'][0]['address'];
$toName = $decoded[0]['ExtractedAddresses']['to:'][0]['name'];

//get the subject
$subject = $decoded[0]['Headers']['subject:'];

$removeChars = array('<','>');

//get the message id
$messageID = str_replace($removeChars,'',$decoded[0]['Headers']['message-id:']);

//get the reply id
$replyToID = str_replace($removeChars,'',$decoded[0]['Headers']['in-reply-to:']);


//---------------------- FIND THE BODY -----------------------//

//get the message body
if(substr($decoded[0]['Headers']['content-type:'],0,strlen('text/plain')) == 'text/plain' && isset($decoded[0]['Body'])){
	
	$body = $decoded[0]['Body'];

} elseif(substr($decoded[0]['Parts'][0]['Headers']['content-type:'],0,strlen('text/plain')) == 'text/plain' && isset($decoded[0]['Parts'][0]['Body'])) {
	
	$body = $decoded[0]['Parts'][0]['Body'];

} elseif(substr($decoded[0]['Parts'][0]['Parts'][0]['Headers']['content-type:'],0,strlen('text/plain')) == 'text/plain' && isset($decoded[0]['Parts'][0]['Parts'][0]['Body'])) {
	
	$body = $decoded[0]['Parts'][0]['Parts'][0]['Body'];

}

//print out our data
echo "

Message ID: $messageID

Reply ID: $replyToID

Subject: $subject

To: $toName $toEmail

From: $fromName $fromEmail

Body: $body

";

//show all the decoded email info
print_r($decoded);


//www.siteground.com/kb/how_to_pipe_an_email_to_a_php_script/

//#!/usr/bin/php -q
/* Read the message from STDIN */
$fd = fopen("php://stdin", "r");
$email = ""; // This will be the variable holding the data.
while (!feof($fd)) {
$email .= fread($fd, 1024);
}
fclose($fd);
/* Saves the data into a file */
$fdw = fopen("/home/user/pipemail.txt", "w+");
fwrite($fdw, $email);
fclose($fdw);
/* Script End */


//[an error occurred while processing this directive]

//davidwalsh.name/php-email-validator

function domain_exists($email, $record = 'MX'){
	list($user, $domain) = explode('@', $email);
	return checkdnsrr($domain, $record);
}

//The Usage
if(domain_exists('user@davidwalsh.name')) {
	echo('This MX records exists; I will accept this email as valid.');
}
else {
	echo('No MX record exists;  Invalid email.');
}


function domain_exists($email){
        list($user, $domain) = explode('@', $email);
        $arr= dns_get_record($domain,DNS_MX);
        if($arr[0]['host']==$domain&&!empty($arr[0]['target'])){
                return $arr[0]['target'];
        }
}
$email= 'user@radiffmail.com';

if(domain_exists($email)) {
        echo('This MX records exists; I will accept this email as valid.');
}
else {
        echo('No MX record exists;  Invalid email.');
}


//www.catswhocode.com/blog/15-php-regular-expressions-for-web-developers

//MATCHING A XML/HTML TAG
//This simple function takes two arguments: The first is the tag you’d like to match, 
//and the second is the variable containing the XML or HTML. Once again, this can be very powerful used along with cURL.

function get_tag( $tag, $xml ) {
  $tag = preg_quote($tag);
  preg_match_all('{<'.$tag.'[^>]*>(.*?)</'.$tag.">.'}",
                   $xml,
                   $matches,
                   PREG_PATTERN_ORDER);

  return $matches[1];
}


//MATCHING AN XHTML/XML TAG WITH A CERTAIN ATTRIBUTE VALUE
//This function is very similar to the previous one, but it allow you to match a tag having a specific attribute. 
//For example, you could easily match <div id=”header”>.

function get_tag( $attr, $value, $xml, $tag=null ) {
  if( is_null($tag) )
    $tag = '\w+';
  else
    $tag = preg_quote($tag);

  $attr = preg_quote($attr);
  $value = preg_quote($value);

  $tag_regex = "/<(".$tag.")[^>]*$attr\s*=\s*".
                "(['\"])$value\\2[^>]*>(.*?)<\/\\1>/"

  preg_match_all($tag_regex,
                 $xml,
                 $matches,
                 PREG_PATTERN_ORDER);

  return $matches[3];
}

    function unlinkRecursive($dir) {
		if (!$dh = @opendir($dir)) return "Warning: folder $dir couldn't be read by PHP";
		while (false !== ($obj = readdir($dh))) {
			if ($obj == '.' || $obj == '..') {
				continue;
			}
			if (!@unlink($dir . '/' . $obj)) {
				unlinkRecursive($dir . '/' . $obj, true);
			}
		}
		closedir($dh);
		@rmdir($dir);
		return "Folder $dir deleted!";
	}	

?>