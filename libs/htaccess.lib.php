<?php

/**
* Class for handling htaccess of Apache
* @author    Sven Wagener <sven.wagener@intertribe.de>
* @copyright Intertribe - Internetservices Germany
* @include 	 Funktion:_include_
// Here are some examples for the htaccess class
// (Groups are not implemented yet! Only Passwd and htaccess)

include("htaccess.class.php");

// Initializing class htaccess as $ht
$ht = new htaccess("/var/www/.htaccess","/var/www/htpasswd");

// Adding user
$ht->addUser("username","0815");

// Changing password for User
$ht->setPasswd("username","newPassword");

// Getting all usernames from set password file
$users=$ht->getUsers();

for($i=0;$i<count($users);$i++){
	echo $users[$i];
}

// Deleting user
$ht->delUser("username");

// Setting authenification type
// If you don't set, the default type will be "Basic"
$ht->setAuthType("Basic");

// Setting authenification area name
// If you don't set, the default name will be "Internal Area"
$ht->setAuthName("My private Area");

//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// finally you have to process addLogin()
// to write out the .htaccess file
$ht->addLogin();

// To delete a Login use the delLogin function
$ht->delLogin();
*/

class htaccess{
    var $fHtaccess=""; // path and filename for htaccess file
    var $fHtgroup="";  // path and filename for htgroup file
    var $fPasswd="";   // path and filename for passwd file
    
    var $authType="Basic"; // Default authentification type
    var $authName="Internal area"; // Default authentification name

    /**
    * Initialising class htaccess
    */
    function htaccess($htaccess, $htpass, $htgroup=null){
	 
	    $this->setFHtaccess($htaccess);
		$this->setFPasswd($htpass);
		
		if ($htgroup)
		  $this->setFHtgroup($htgroup);
    }

    /**
    * Sets the filename and path of .htaccess to work with
    * @param string	$filename    the name of htaccess file
    */
    function setFHtaccess($filename){
        $this->fHtaccess=$filename;
    }
    
    /**
    * Sets the filename and path of the htgroup file for the htaccess file
    * @param string	$filename    the name of htgroup file
    */
    function setFHtgroup($filename){
        $this->fHtgroup=$filename;
    }
    
    /**
    * Sets the filename and path of the password file for the htaccess file
    * @param string	$filename    the name of htgroup file
    */
    function setFPasswd($filename){
        $this->fPasswd=$filename;
    }

    /**
    * Adds a user to the password file
    * @param string $username     Username
    * @param string $password     Password for Username
    * @param string $group        Groupname for User (optional)
    * @return boolean $created         Returns true if user have been created otherwise false
    */
    function addUser($username,$password,$group=""){
        // checking if user already exists
        $file=@fopen($this->fPasswd,"r");
        $isAlready=false;
        while($line=@fgets($file,200)){
            $lineArr=explode(":",$line);
            if($username==$lineArr[0]){
                $isAlready=true;
             }
        }
        
        if($isAlready==false){
            $file=fopen($this->fPasswd,"a");
            
			if(strtolower(substr($_ENV["OS"],0,7))!="windows"){
				$password=crypt($password);
			}
            
            $newLine=$username.":".$password."\n";

            fputs($file,$newLine);
            fclose($file);
            return true;
        }else{
            return false;
        }
    }

    /**
    * Adds a group to the htgroup file
    * @param string $groupname     Groupname
    */
    function addGroup($groupname){
        $file=fopen($this->fHtgroup,"a");
        fclose($file);
    }

    /**
    * Deletes a user in the password file
    * @param string $username     Username to delete
    * @return boolean $deleted    Returns true if user have been deleted otherwise false
    */
    function delUser($username){
        // Reading names from file
        $file=fopen($this->fPasswd,"r");
        $i=0;
        while($line=fgets($file,200)){
            $lineArr=explode(":",$line);
            if($username!=$lineArr[0]){
                $newUserlist[$i][0]=$lineArr[0];
                $newUserlist[$i][1]=$lineArr[1];
                $i++;
            }else{
                $deleted=true;
            }
        }
        fclose($file);

        // Writing names back to file (without the user to delete)
        $file=fopen($path.$this->fPasswd,"w");
        for($i=0;$i<count($newUserlist);$i++){
            fputs($file,$newUserlist[$i][0].":".$newUserlist[$i][0]."\n");
        }
        fclose($file);
        
        if($deleted==true){
            return true;
        }else{
            return false;
        }
    }
    
    /**
    * Returns an array of all users in a password file
    * @return array $users         All usernames of a password file in an array
    * @see setFPasswd()
    */
    function getUsers(){
    }
    
    /**
    * Sets a password to the given username
    * @param string $username     The name of the User for changing password
    * @param string $password     New Password for the User
    * @return boolean $isSet      Returns true if password have been set
    */    
    function setPasswd($username,$new_password){
        // Reading names from file
        $newUserlist="";
        
        $file=fopen($this->fPasswd,"r");
        $x=0;
        for($i=0;$line=fgets($file,200);$i++){
            $lineArr=explode(":",$line);
            if($username!=$lineArr[0] && $lineArr[0]!="" && $lineArr[1]!=""){
                $newUserlist[$i][0]=$lineArr[0];
                $newUserlist[$i][1]=$lineArr[1];
                $x++;
            }else if($lineArr[0]!="" && $lineArr[1]!=""){
                $newUserlist[$i][0]=$lineArr[0];
                $newUserlist[$i][1]=crypt($new_password)."\n";
                $isSet=true;
                $x++;
            }
        }
        fclose($file);

        unlink($this->fPasswd);

        /// Writing names back to file (with new password)
        $file=fopen($this->fPasswd,"w");
        for($i=0;$i<count($newUserlist);$i++){
            $content=$newUserlist[$i][0].":".$newUserlist[$i][1];
            fputs($file,$content);
        }
        fclose($file);

        if($isSet==true){
            return true;
        }else{
            return false;
        }
    }

    /**
    * Sets the Authentification type for Login
    * @param string $authtype     Authentification type as string
    */
    function setAuthType($authtype){
        $this->authType=$authtype;
    }

    /**
    * Sets the Authentification Name (Name of the login area)
    * @param string $authname     Name of the login area
  	*/
    function setAuthName($authname){
        $this->authName=$authname;
    }

    /**
    * Writes the htaccess file to the given Directory and protects it
    * @see setFhtaccess()
  	*/
    function addLogin(){
       $file=fopen($this->fHtaccess,"w+");
       fputs($file,"Order allow,deny\n");
       fputs($file,"Allow from all\n");
       fputs($file,"AuthType        ".$this->authType."\n");
       fputs($file,"AuthUserFile    ".$this->fPasswd."\n\n");
       fputs($file,"AuthName        \"".$this->authName."\"\n");
       fputs($file,"require valid-user\n");
       fclose($file);
    }

    /**
    * Deletes the protection of the given directory
    * @see setFhtaccess()
    */
    function delLogin(){
        unlink($this->fHtaccess);
    }
}
?>