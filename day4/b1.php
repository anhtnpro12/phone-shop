<?php

class Rectangle {
    public $width;
    public $height;       
    
    function __construct($width = 0, $height = 0)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function perimeter()
    {        
        return ($this->width+$this->height)*2;
    }

    public function area()
    {
        return $this->width * $this->height;
    }    
}

class Square extends Rectangle {    

    public function perimeter()
    {                       
        return $this->width*4;
    }

    public function area()
    {
        return $this->width * $this->width;
    }
}


$width = 5;
$height = 6;
$rec = new Rectangle($width, $height);
echo 'Perimeter of rectangle with width = ' . $width . ', height = ' . $height . ' is ' . $rec->perimeter() . '<br>';
echo 'Area of rectangle with width = ' . $width . ', height = ' . $height . ' is ' . $rec->area() . '<br>';


$edge = 5;
$square = new Square($edge);
echo 'Perimeter of square with edge = ' . $edge . ' is ' . $square->perimeter() . '<br>';
echo 'Area of square with edge = ' . $edge . ' is ' . $square->area() . '<br>';

?>