<?php

abstract class Animal {
    public $name;
    public $age;
    public $color;

    function __construct($name = '', $age = 0, $color = '')
    {
        $this->name = $name;
        $this->age = $age;
        $this->color = $color;
    }

    abstract function eat();

    abstract function run();        

    abstract function sleep();
}

class Dog extends Animal {
    function eat() {
        return '...Gâu';
    }

    function run() {
        return '...Gâu Gâu';
    }
    
    function sleep() {
        return '...Gâu Gâu Gâu';
    }
}

class Cat extends Animal {
    function eat() {
        return '...Meow';
    }

    function run() {
        return '...Meow Meow';
    }
    
    function sleep() {
        return '...Meow Meow Meow';
    }
}

$dog = new Dog('john', 20, 'hồng');
$cat = new Cat('miu', 20, 'đỏ');

echo $dog->eat().'<br>';
echo $cat->eat().'<br>';