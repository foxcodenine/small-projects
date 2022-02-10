<?php
namespace app\Model;

class Cat {

    public $name;
    public $age;

    function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }
}
?>