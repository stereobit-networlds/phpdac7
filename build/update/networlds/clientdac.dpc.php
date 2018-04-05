<?php
$__DPC['CLIENTDAC_DPC'] = 'clientdac';

class clientdac 
{
	public $debug = FALSE;
    /*. DOC Enable debugging messages.*/

	public $debug_stderr = FALSE;
	/*. DOC Send debugging messages to stderr rather than to stdout. .*/

	const ERR_STILL_NOT_CONNECTED = "still not connected";

    private $smtp_conn = NULL;  // the socket to the server
    private $helo_rply;  // the reply the server sent to us for HELO

	
	function __construct()
	{
        $this->smtp_conn = NULL;
        $this->helo_rply = NULL;

        $this->debug = FALSE;		
	}
	
	private function log($s)
	{
		if($this->debug_stderr)
			error_log($s);
		else
			echo $s;
	}	
	
	function Close()
    {
        $this->helo_rply = NULL;
        if( $this->smtp_conn !== NULL ) {
            // close the connection and cleanup
            fclose($this->smtp_conn);
            $this->smtp_conn = NULL;
        }
    }	
	
    function Connected()
    /*. DOC Returns TRUE if connected to a server otherwise FALSE .*/
    {
        if($this->smtp_conn === NULL)
			return FALSE;

		$sock_status = socket_get_status($this->smtp_conn);
		if(/*. (bool) .*/ $sock_status["eof"]) {
			// hmm this is an odd situation... the socket is
			// valid but we aren't connected anymore
			if( $this->debug ) {
				// FIXME: should raise exception instead?
				$this->log("SMTP -> NOTICE: EOF caught while checking if connected\n");
			}
			try { $this->Close(); }
			catch ( Exception $e ) { }
			return FALSE;
		}
		return TRUE; // everything looks good
    }

	private function put_line($line)
	{
		if($this->debug) {
			$this->log("DAC Client: $line\n");
		}
        fputs($this->smtp_conn, $line);
        fputs($this->smtp_conn, "\r\n");
	}

    private function get_lines()
    /*. DOC
       Read in as many lines as possible
       either before eof or socket timeout occurs on the operation.
       With SMTP we can tell if we have more lines to read if the
       4th character is '-' symbol. If it is a space then we don't
       need to read anything else.
     .*/
    {
        $data = "";
        while(FALSE !== ($str = fgets($this->smtp_conn,515))) {
            if($this->debug) {
                $this->log("SMTP Server: $str\n");
            }
            $data .= $str;
            if(substr($str,3,1) === " ") { break; }
        }
        return $data;
    }

    function Connect($host, $port=19123, $tval=30)
    {
        // make sure we are __not__ connected
        if($this->Connected()) {
            // ok we are connected! what should we do?
			throw new ErrorException("Already connected to a server");
        }

        //connect to the smtp server
        $this->smtp_conn = @fsockopen($host, $port, $errno, $errstr, $tval);   
			 
        // verify we connected properly
        if ($this->smtp_conn === FALSE ) 
		{
			$this->smtp_conn = NULL;
			//throw new ErrorException("Failed to connect to server: $errstr ($errno)");
			die("Failed to connect to server: $errstr ($errno)");
        }

        // sometimes the SMTP server takes a little longer to respond
        // so we will give it a longer timeout for the first read
        // Windows still does not have support for this timeout function
        if(substr(PHP_OS, 0, 3) != "WIN")
           socket_set_timeout($this->smtp_conn, $tval, 0);

        // get any announcement stuff
        //$ignore_announce =  $this->get_lines();

        // set the timeout  of any socket functions at 1/10 of a second
        //if(function_exists("socket_set_timeout"))
        //   socket_set_timeout($this->smtp_conn, 0, 100000);
	
    }

    function Authenticate($username, $password)
    {
        if(!$this->Connected()) {
			throw new ErrorException(self::ERR_STILL_NOT_CONNECTED);
        }

        // Start authentication
        $this->put_line("AUTH LOGIN");

        $rply = $this->get_lines();
        $code = (int) substr($rply,0,3);

        if($code != 334) {
			throw new ErrorException("AUTH not accepted from server: "
			. substr($rply,4) . " ($code)");
        }

        // Send encoded username
        $this->put_line(base64_encode($username));

        $rply = $this->get_lines();
        $code = (int) substr($rply,0,3);

        if($code != 334) {
			throw new ErrorException("Username not accepted from server: "
			. substr($rply,4) . " ($code)");
        }

        // Send encoded password
        $this->put_line(base64_encode($password));

        $rply = $this->get_lines();
        $code = (int) substr($rply,0,3);

        if($code != 235) {
			throw new ErrorException("Password not accepted from server: "
			. substr($rply,4) . " ($code)");
        }
    }

    /**************************************************************
                              SMTP COMMANDS                       *
      ************************************************************/

	function Data($msg_data)
    {
        if(!$this->Connected()) {
			throw new ErrorException(self::ERR_STILL_NOT_CONNECTED);
        }

        $this->put_line("DATA");

        $rply = $this->get_lines();
        $code = (int) substr($rply,0,3);

        if($code != 354) {
			throw new ErrorException("DATA command not accepted from server: "
			. substr($rply,4) . " ($code)");
        }

        // normalize the line breaks so we know the explode works
        $msg_data = /*. (string) .*/ str_replace("\r\n","\n",$msg_data);
        $msg_data = /*. (string) .*/ str_replace("\r","\n",$msg_data);
        $lines = explode("\n",$msg_data);

        // we need to find a good way to determine is headers are
        // in the msg_data or if it is a straight msg body
        // currently I'm assuming RFC 822 definitions of msg headers
        // and if the first field of the first line (':' sperated)
        // does not contain a space then it _should_ be a header
        // and we can process all lines before a blank "" line as
        // headers.
        $field = substr($lines[0],0,strpos($lines[0],":"));
        $in_headers = FALSE;
        if(!empty($field) && FALSE===strstr($field," ")) {
            $in_headers = TRUE;
        }

        $max_line_length = 998; // used below; set here for ease in change

        foreach($lines as $line) {
            $lines_out = /*. (array[int]string) .*/ NULL;
            if($line === "" && $in_headers) {
                $in_headers = FALSE;
            }
            // ok we need to break this line up into several
            // smaller lines
            while(strlen($line) > $max_line_length) {
                $pos = strrpos(substr($line,0,$max_line_length)," ");

                // Patch to fix DOS attack
                if($pos===FALSE) {
                    $pos = $max_line_length - 1;
                }

                $lines_out[] = substr($line,0,$pos);
                $line = substr($line,$pos + 1);
                // if we are processing headers we need to
                // add a LWSP-char to the front of the new line
                // RFC 822 on long msg headers
                if($in_headers) {
                    $line = "\t" . $line;
                }
            }
            $lines_out[] = $line;

            // now send the lines to the server
            // FIXED
            //while(list(,$line_out) = @each($lines_out)) {
            foreach($lines_out as $line_out) {
                if(strlen($line_out) > 0)
                {
                    if(substr($line_out, 0, 1) === ".") {
                        $line_out = "." . $line_out;
                    }
                }
                $this->put_line($line_out);
            }
        }

        // ok all the message data has been sent so lets get this
        // over with aleady
        $this->put_line(".");

        $rply = $this->get_lines();
        $code = (int) substr($rply,0,3);

        if($code != 250) {
			throw new ErrorException("DATA not accepted from server: "
			. substr($rply,4) . " ($code)");
        }
    }	  

    function SendHello($hello, $host)
	{
        if(!$this->Connected()) {
			throw new ErrorException(self::ERR_STILL_NOT_CONNECTED);
        }

        $this->put_line($hello . " " . $host);

        $rply = $this->get_lines();
        $code = (int) substr($rply,0,3);

        if($code != 250) {
			throw new ErrorException($hello . " not accepted from server: "
			. substr($rply,4) . " ($code)");
        }

        $this->helo_rply = $rply;
    }

    function Hello($host="")
    {
        if(!$this->Connected()) {
			throw new ErrorException(self::ERR_STILL_NOT_CONNECTED);
        }

        // if a hostname for the HELO wasn't specified determine
        // a suitable one to send
        if(empty($host)) {
            // we need to determine some sort of appropriate default
            // to send to the server
            $host = "localhost";
        }

        // Send extended hello first (RFC 2821)
		try {
			$this->SendHello("EHLO", $host);
		}
		catch ( ErrorException $e ) {
            $this->SendHello("HELO", $host);
        }
    }

    function Help($keyword="")
    {
        if(!$this->Connected()) {
			throw new ErrorException(self::ERR_STILL_NOT_CONNECTED);
        }

        $extra = "";
        if(!empty($keyword)) {
            $extra = " " . $keyword;
        }

        $this->put_line("HELP" . $extra);

        $rply = $this->get_lines();
        $code = (int) substr($rply,0,3);

        if($code != 211 && $code != 214) {
			throw new ErrorException("HELP not accepted from server: "
			. substr($rply,4) . " ($code)");
        }

        return $rply;
    }	
	
    function Mail($from)
    {
        if(!$this->Connected()) {
			throw new ErrorException(self::ERR_STILL_NOT_CONNECTED);
        }

        $this->put_line("MAIL FROM: <$from>");

        $rply = $this->get_lines();
        $code = (int) substr($rply,0,3);

        if($code != 250) {
			throw new ErrorException("MAIL not accepted from server: "
			. substr($rply,4) . " ($code)");
        }
    }

    function Noop()
    {
        if(!$this->Connected()) {
			throw new ErrorException(self::ERR_STILL_NOT_CONNECTED);
        }

        $this->put_line("NOOP");

        $rply = $this->get_lines();
        $code = (int) substr($rply,0,3);

        if($code != 250) {
			throw new ErrorException("NOOP not accepted from server: "
			. substr($rply,4) . " ($code)");
        }
    }

    function Quit()
    {
	 	if( $this->smtp_conn === NULL )
			return;

        // send the quit command to the server
        $this->put_line("QUIT");

        // get any good-bye messages
        $byemsg = $this->get_lines();

		$this->Close();

        $code = (int) substr($byemsg,0,3);
        if($code != 221) {
			throw new ErrorException("SMTP server rejected quit command: "
			. substr($byemsg,4) . " ($code)");
        }
    }

    function Recipient($to)
    {
        if(!$this->Connected()) {
			throw new ErrorException(self::ERR_STILL_NOT_CONNECTED);
        }

        $this->put_line("RCPT TO: <$to>");

        $rply = $this->get_lines();
        $code = (int) substr($rply,0,3);

        if($code != 250 && $code != 251) {
			throw new ErrorException("RCPT not accepted from server: "
			. substr($rply,4) . " ($code)");
        }
    }

    function Reset()
    {
        if(!$this->Connected()) {
			throw new ErrorException(self::ERR_STILL_NOT_CONNECTED);
        }

        $this->put_line("RSET");

        $rply = $this->get_lines();
        $code = (int) substr($rply,0,3);

        if($code != 250) {
			throw new ErrorException("RSET failed: $rply");
        }
    }

    function Send($from)
    {
        if(!$this->Connected()) {
			throw new ErrorException(self::ERR_STILL_NOT_CONNECTED);
        }

        $this->put_line("SEND FROM: $from");

        $rply = $this->get_lines();
        $code = (int) substr($rply,0,3);

        if($code != 250) {
			throw new ErrorException("SEND not accepted from server: $rply");
        }
    }	
	
    function SendAndMail($from)
    {
        if(!$this->Connected()) {
			throw new ErrorException(self::ERR_STILL_NOT_CONNECTED);
        }

        $this->put_line("SAML FROM: $from ");

        $rply = $this->get_lines();
        $code = (int) substr($rply,0,3);

        if($code != 250) {
			throw new ErrorException("SAML not accepted from server: $rply");
        }
    }

    function SendOrMail($from)
    {
        if(!$this->Connected()) {
			throw new ErrorException(self::ERR_STILL_NOT_CONNECTED);
        }

        $this->put_line("SOML FROM: $from");

        $rply = $this->get_lines();
        $code = (int) substr($rply,0,3);

        if($code != 250) {
			throw new ErrorException("SOML not accepted from server: $rply");
        }
    }

    function Turn()
    {
		throw new ErrorException("This method, TURN, of the SMTP is not implemented");
    }

    function Verify(/*. string .*/ $name)
    {
        if(!$this->Connected()) {
			throw new ErrorException(self::ERR_STILL_NOT_CONNECTED);
        }

        $this->put_line("VRFY $name");

        $rply = $this->get_lines();
        $code = (int) substr($rply,0,3);

        if($code != 250 && $code != 251) {
			//throw new ErrorException("VRFY failed on name '$name': $rply");
        }
        return $code;
    }	
} 