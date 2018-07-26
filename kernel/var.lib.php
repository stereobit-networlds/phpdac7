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