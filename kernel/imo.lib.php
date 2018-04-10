<?php
/* Usage:
//Simple usage.
$immX = Immutable::create()
    ->set('test', 'a string goes here')
    ->set('another', 100)
    ->arr([1,2,3,4,5,6])
    ->arr(['a' => 1, 'b' => 2])
    ->build();
echo (string) $immX;

//You can also put a trusted object into the immutable as well
$immY = Immutable::create()
    ->set('anObject', $immX)
    ->build();
echo (string) $immY;

echo $immY->get('test'); // a string goes here
var_dump($immY->has('test')); // bool(true)
var_dump($immY->has('non-existent')); // bool(false)
echo $immY->getOrElse('test', 'some default text'); // a string goes here
echo $immY->getOrElse('non-existent', 'some default text'); // some default text

//Modifying copies of the immutable structure using the generator
$immZ = Immutable::with($immY)
    ->set('a story', 'This is where someone should write a story')
    ->setIntKey(300, 'My int indexed value')
    ->arr(['arr: int indexed', 'arr' => 'arr: assoc key becomes immutable key'])
    ->build();
echo (string) $immZ;

//Use arr() or setInt() here in the same way too when setting new values or overwriting existing ones.
$throwAway = Immutable::with($immZ)
    ->set('a story', 'My story begins by the slow moving waters of the meandering river.')
    ->build();
echo (string) $throwAway;

//It is also used to remove items from the data list quite simply too. 
//We can either remove them one at time with unset($key) or you can remove many by supplying a list to unsetArr().
$immAA = Immutable::with($immZ)
    ->unset('x')
    ->unsetArr(['a story', 300])
    ->build();
echo (string) $immAA;

//You can unset(), unsetArr, set, setIntKey and arr as much as you like before calling build() all in the one building chain.
//Now you have a generalised immutable data structure that you can store anything you like in. 
//If you have an untrusted object you will need store it as a string using either serialize() or var_export(). 
//The same goes for resources like file handles where you will need to extract value as text before storing it.
//https://www.simonholywell.com/post/2017/04/php-and-immutability-part-three/
*/
require_once("imod.lib.php");

class Immutable {
    private $data = [];
    private function __construct() {}
    public static function create(): self {
        return new self;
    }
    public static function with(ImmutableData $old): self {
        $new = static::create();
        $new->data = $old->getAsArray();
        return $new;
    }
    public function set(string $key, $value): self {
        return $this->setData($key, $value);
    }
    public function unset($key): self {
        unset($this->data[$key]);
        return $this;
    }
    public function setIntKey(int $key, $value): self {
        return $this->setData($key, $value);
    }
    private function setData($key, $value): self {
        $this->data[$key] = $value;
        return $this;
    }
    public function arr(array $arr): self {
        foreach($arr as $key => $value) {
            if (is_string($key)) {
                $this->set($key, $value);
            } else if (is_int($key)) {
                $this->setIntKey($key, $value);
            }
        }
        return $this;
    }
    public function unsetArr(array $arr): self {
        foreach($arr as $key) {
            $this->unset($key);
        }
        return $this;
    }
    public function build(): ImmutableData {
        return ImmutableData::create($this->data);
    }
    public function getAsArray(): array {
        return $this->data;
    }
}
?>