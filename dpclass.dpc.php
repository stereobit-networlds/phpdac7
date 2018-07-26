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
abstract class _dpc {
  
  abstract public function action(); 
  abstract public function event();  

}

interface _dpcobj {

  public function render();
}

interface _dpclib {

  public function example();
}

//example class absatraction
class dpclass extends _dpc implements _dpcobj {
  
  function __construct() {
  }
  
  public function event($event=null) {
    //....
  }
  
  public function action($action=null) {
    //....
  }
  
  public function render() {
    //....
  } 
  
  function __destruct() {
    //....
  }
  
}


?>