<?php
class _var 
{
    private $subscribers;
	public $name, $value;

    public function __construct($name, $value=null)
	{
		$this->name = $name;
		$this->attr = new stdClass();
		
		//$this->subscribers = array();
	}
	
	public function set($s)
	{
		$this->attr->value = $s;
		
		return ($this);
	}	

	public function subscribe($s)
	{
		$this->attr->subscriber[] = $s;
		
		return ($this);
	}
	
}
?>