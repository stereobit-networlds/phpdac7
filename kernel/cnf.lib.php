<?php
//https://stackoverflow.com/questions/2209934/php-operator
/*
new Config(Config::TYPE_ALL);
// cat dog rat lion bird
new Config(Config::TYPE_BIRD);
//bird
new Config(Config::TYPE_BIRD | Config::TYPE_DOG);
//dog bird
new Config(Config::TYPE_ALL & ~Config::TYPE_DOG & ~Config::TYPE_CAT);
//rat lion bird
*/
class Config {

    // our constants must be 1,2,4,8,16,32,64 ....so on
    const TYPE_CAT=1; //MEM WRITES
    const TYPE_DOG=2; //SPINLOCKS / READS
    const TYPE_LION=4;//MESSAGES 
    const TYPE_RAT=8; //DATA
    const TYPE_BIRD=16; //VAR
    const TYPE_ALL=31;

    private $config;

    public function __construct($config)
	{
        $this->config=$config;

        if($this->is(Config::TYPE_CAT)){
            echo 'cat ';
        }
        if($this->is(Config::TYPE_DOG)){
            echo 'dog ';
        }
        if($this->is(Config::TYPE_RAT)){
            echo 'rat ';
        }
        if($this->is(Config::TYPE_LION)){
            echo 'lion ';
        }
        if($this->is(Config::TYPE_BIRD)){
            echo 'bird ';
        }
        echo "\n";
    }

    private function is($value)
	{
        return $this->config & $value;
    }
	
    private function checktype($type=null)
	{
		if (!$type) return true; //show
		
        if (($type=='TYPE_CAT') && ($this->is(Config::TYPE_CAT)))
		{
            echo 'cat ';
			return true;
        }
        if (($type=='TYPE_DOG') && ($this->is(Config::TYPE_DOG)))
		{
            echo 'dog ';
			return true;
        }
        if (($type=='TYPE_RAT') && ($this->is(Config::TYPE_RAT)))
		{
            echo 'rat ';
			return true;
        }
        if (($type=='TYPE_LION') && ($this->is(Config::TYPE_LION)))
		{
            echo 'lion ';
			return true;
        }
        if (($type=='TYPE_BIRD') && ($this->is(Config::TYPE_BIRD)))
		{
            echo 'bird ';
			return true;
        }	
        //echo "\n";
		return false;
    }	
	
	public function _say($str, $level=0, $crln=true) 
	{
	    $cr = $crln ? PHP_EOL : null;
		
		if (($this->checktype($level)===true))	
			echo ucfirst($str) . $cr;
		
		_dump(date ("Y-m-d H:i:s :").$str.PHP_EOL,'a+','/dumpsrv-'.$_SERVER['COMPUTERNAME'].'.log');
	}	
}
?>