<?php

abstract class Shape {
    public $edges;

    public function __construct(...$edges)
    {                   
        $this->edges = $edges;
    }
    
    abstract public function getArea();
}

class Square extends Shape {   
    public function __construct($edge = 0)
    {
        $this->edges = $edge;
    }

    public function getArea()
    {
        return $this->edges ** 2;
    }
}

$test = new Square(3);

echo $test->getArea();