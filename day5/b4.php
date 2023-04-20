<?php

abstract class Animal {
    public $name;
    public $age;
    public $color;

    public function __construct($name = '', $age = 0, $color = '')
    {
        $this->name = $name;
        $this->age = $age;
        $this->color = $color;
    }

    abstract public function eat();

    abstract public function run();        

    abstract public function sleep();
}

interface CanFly {
    public function fly();
}

class Bird extends Animal implements CanFly {
    public function eat() {
        return '...Quạc';
    }

    public function run() {
        return '...Quạc Quạc';
    } 

    public function sleep() {
        return '...Quạc Quạc Quạc';
    }

    public function fly() {
        return '...Quạc Quạc Quạc Quạc';
    }
}

$bird = new Bird();

echo 'Bird eat: '.$bird->eat().'<br>';
echo 'Bird run: '.$bird->run().'<br>';
echo 'Bird sleep: '.$bird->sleep().'<br>';
echo 'Bird fly: '.$bird->fly().'<br>';