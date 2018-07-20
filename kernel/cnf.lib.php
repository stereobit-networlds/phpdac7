<?php
/*
new Config(Config::TYPE_ALL);
// cat dog rat lion bird
new Config(Config::TYPE_BIRD);
//bird
new Config(Config::TYPE_BIRD | Config::TYPE_DOG);
//dog bird
new Config(Config::TYPE_ALL & ~Config::TYPE_DOG & ~Config::TYPE_CAT);
//rat lion bird
//https://stackoverflow.com/questions/2209934/php-operator
*/
class Config 
{
    // our constants must be 1,2,4,8,16,32,64 ....so on
    const TYPE_CAT=1; //MEM WRITES
    const TYPE_DOG=2; //SPINLOCKS / READS
    const TYPE_LION=4;//MESSAGES 
    const TYPE_RAT=8; //DATA
    const TYPE_BIRD=16; //VAR
    const TYPE_IRON=32; //..
    const TYPE_ZION=64; //..	
    const TYPE_ALL=127; //31;

    private $config;
	
    static $foreground_colors = array(
        'bold'         => '1',    'dim'          => '2',
        'black'        => '0;30', 'dark_gray'    => '1;30',
        'blue'         => '0;34', 'light_blue'   => '1;34',
        'green'        => '0;32', 'light_green'  => '1;32',
        'cyan'         => '0;36', 'light_cyan'   => '1;36',
        'red'          => '0;31', 'light_red'    => '1;31',
        'purple'       => '0;35', 'light_purple' => '1;35',
        'brown'        => '0;33', 'yellow'       => '1;33',
        'light_gray'   => '0;37', 'white'        => '1;37',
        'normal'       => '0;39',
    );
    
    static $background_colors = array(
        'black'        => '40',   'red'          => '41',
        'green'        => '42',   'yellow'       => '43',
        'blue'         => '44',   'magenta'      => '45',
        'cyan'         => '46',   'light_gray'   => '47',
    );
 
    static $options = array(
        'underline'    => '4',    'blink'         => '5', 
        'reverse'      => '7',    'hidden'        => '8',
    );	
	
	
	static $confcl = array(
		'TYPE_CAT' => 'yellow',		'TYPE_DOG' => 'light_red',
		'TYPE_RAT' => 'light_cyan',	'TYPE_LION' => 'light_gray',
		'TYPE_BIRD' => 'white',	'TYPE_IRON' => 'light_green',
		'TYPE_ZION' => 'light_purple',
	);
	
	static $confbcl = array(
		'TYPE_CAT' => '',	'TYPE_DOG' => '',
		'TYPE_RAT' => '',	'TYPE_LION' => ''/*'red'*/,
		'TYPE_BIRD' => '',	'TYPE_IRON' => ''/*'light_green'*/,
		'TYPE_ZION' => '',
	);	
	
	static $confopt = array(
		'TYPE_CAT' => '',	'TYPE_DOG' => '',
		'TYPE_RAT' => '',	'TYPE_LION' => '',
		'TYPE_BIRD' => '',	'TYPE_IRON' => ''/*'reverse'*/,
		'TYPE_ZION' => '',
	);	

    public function __construct($config)
	{
        $this->config=$config;

        if($this->is(Config::TYPE_CAT)){
            //echo '[cat ]';
        }
        if($this->is(Config::TYPE_DOG)){
            //echo '[dog ]';
        }
        if($this->is(Config::TYPE_RAT)){
            //echo '[rat ]';
        }
        if($this->is(Config::TYPE_LION)){
            //echo '[lion]';
        }
        if($this->is(Config::TYPE_BIRD)){
            //echo '[bird]';
        }
        if($this->is(Config::TYPE_IRON)){
            //echo '[iron]';
        }		
        if($this->is(Config::TYPE_ZION)){
            //echo '[zion]';
        }		
        //echo PHP_EOL;
    }

    private function is($value)
	{
        return $this->config & $value;
    }
	
	private function _echo($str='', $color='normal', $bcolor=null, $option=null)
	{
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') 
		{
			echo $str;
			return true;
		}
		else
		{
			//echo $str;
			//return true;
			$colorstr = '';
			
			// Check if given foreground color found
			if( isset(self::$foreground_colors[$color]) ) 
				$colorstr .= "\033[" . self::$foreground_colors[$color] . "m";
			
			// Check if given background color found
            if(isset(self::$background_colors[$bcolor])) 
                $colorstr .= "\033[" . self::$background_colors[$bcolor] . "m";
			
			// Check if given option found
            if(isset(self::$options[$option])) 
                $colorstr .= "\033[" . self::$options[$option] . "m";

			// Add string and end coloring
			$colorstr .= $str . "\033[0m";
			
			echo $colorstr;	
			return true;
		}	

		return false;	
	}
	
    private function checktype($type=null)
	{
		if (!$type) return true; //show
		
        if (($type=='TYPE_CAT') && ($this->is(Config::TYPE_CAT)))
		{
            //echo '[cat ]';
			return $this->_echo('[cat ]', self::$confcl['TYPE_CAT']); //true
        }
        if (($type=='TYPE_DOG') && ($this->is(Config::TYPE_DOG)))
		{
            //echo '[dog ]';
			return $this->_echo('[dog ]', self::$confcl['TYPE_DOG']); 
        }
        if (($type=='TYPE_RAT') && ($this->is(Config::TYPE_RAT)))
		{
            //echo '[rat ]';
			return $this->_echo('[rat ]', self::$confcl['TYPE_RAT']); 
        }
        if (($type=='TYPE_LION') && ($this->is(Config::TYPE_LION)))
		{
            //echo '[lion]';
			return $this->_echo('[lion]', self::$confcl['TYPE_LION'], 'red'); 
        }
        if (($type=='TYPE_BIRD') && ($this->is(Config::TYPE_BIRD)))
		{
            //echo '[bird]';
			return $this->_echo('[bird]', self::$confcl['TYPE_BIRD'], 'magenta');//, 'reverse'); 
        }	
        if (($type=='TYPE_IRON') && ($this->is(Config::TYPE_IRON)))
		{
            //echo '[iron]';
			return $this->_echo('[iron]', self::$confcl['TYPE_IRON'], 'yellow', 'reverse'); 
        }	
        if (($type=='TYPE_ZION') && ($this->is(Config::TYPE_ZION)))
		{
            //echo '[zion]';
			return $this->_echo('[zion]', self::$confcl['TYPE_ZION']); 
        }			
        //echo "\n";
		return false;
    }	
	
	public function _say($str, $level=0, $crln=true) 
	{
	    $cr = $crln ? PHP_EOL : null;
		
		if (($this->checktype($level)===true))	
			//echo ucfirst($str) . $cr;
			$this->_echo(ucfirst($str) . $cr, self::$confcl[$level],
											  self::$confbcl[$level],
											  self::$confopt[$level]); 
		
		_dump(date ("Y-m-d H:i:s :").$str.PHP_EOL,'a+','/' . _DUMPFILE);
	}	
}
?>