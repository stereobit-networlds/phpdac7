<?php
//https://www.simonholywell.com/post/2017/04/php-and-immutability-part-three/
declare(strict_types=1);

final class ImmutableData {
    private $data = [];
    private function __construct() {}
    public static function create(array $args): ImmutableData {
        $immutable = new self;
        $immutable->data = static::sanitiseInput($args);
        return $immutable;
    }
    public function has($key) {
        return array_key_exists($key, $this->data);
    }
    public function get($key) {
        return $this->data[$key];
    }
    public function getOrElse($key, $default) {
        if($this->has($key)) {
            return $this->get($key);
        }
        return $default;
    }
    public function getAsArray(): array {
        return $this->data;
    }
    protected static function sanitiseInput(array $arr): array {
        return array_map(function($x) {
            if (is_scalar($x)) return $x;
            else if (is_object($x)) return static::sanitiseObject($x);
            else if (is_array($x)) return static::sanitiseInput($x);
            else throw new \InvalidArgumentException(gettype($x) . ' cannot be stored in an Immutable.');
        }, $arr);
    }
    protected static function sanitiseObject(ImmutableData $object): ImmutableData {
        return clone $object;
    }

    // return a parsable text representation of the class
    public function __toString(): string {
        return var_export($this->getAsArray(), true);
    }
    // called when a var_export'd class is parsed
    public function __set_state(array $args): ImmutableData {
        return static::create($args);
    }
    public function __unset($a): void {}
    public function __set($a, $b): void {}
    private function __clone() {
        $this->data = static::sanitiseInput($this->data);
    }
}
?>