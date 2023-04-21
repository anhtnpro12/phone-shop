<?php

class Person {
    private $name;
    private $age;
    
    function __get($key)
    {
        if (property_exists($this, $key)) {
            return $this->$key;
        } else {
            die('Thuộc tính không tồn tại');
        }
    }
    
    function __set($key, $value)
    {
        if (property_exists($this, $key)) {
            $this->$key = $value;
        } else {
            die('Thuộc tính không tồn tại');
        }
    }
}

$a = new Person();
$a->name = 'Anh';
echo $a->name;