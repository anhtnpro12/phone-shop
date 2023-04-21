<?php

class User 
{
    private $name;
    private $age;

    function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            die('Propertie not exist');
        }
    }

    function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        } else {
            die('Propertie not exist');
        }
    }
}

$a = new User();
$a->name = 'Anh';
$a->age = 18;
echo $a->name.' - '.$a->age;