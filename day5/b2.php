<?php

interface Shape {
    public function area();
    
    public function perimeter();
}

class Square implements Shape {
    public $edge;    
    
    public function __construct($edge)
    {
        $this->edge = $edge;
    }

    public function area() {
        return $this->edge ** 2;
    }

    public function perimeter() {
        return $this->edge * 4;
    }
}

class Circle implements Shape {
    public $radius;    
    
    public function __construct($radius)
    {
        $this->radius = $radius;
    }

    public function area() {
        return ($this->radius ** 2) * pi();
    }

    public function perimeter() {
        return $this->radius * 2 * pi();
    }
}

$square = new Square(5);
echo 'Area = '.$square->area().', Perimeter = '.$square->perimeter().'<br>';

$circle = new Circle(4);
echo 'Area = '.$circle->area().', Perimeter = '.$circle->perimeter().'<br>';