<?php

abstract class Car {
    public $name;
    public $color;
    public $cost;    

    function __construct($name = '', $color = '', $cost = 0)
    {
        $this->name = $name;
        $this->color = $color;
        $this->cost = $cost;        
    }

    abstract public function run();    
}

class GasCar extends Car {
    public function run() {
        return 'Tiêu thụ xăng';
    }
}

class ElectricCar extends Car {
    public function run() {
        return 'Tiêu thụ điện';
    }
}

$gasCar = new GasCar('toyota', 'trắng', 2000);
$electricCar = new ElectricCar('tesla', 'đen', 3000);

echo $gasCar->name.' '.$gasCar->run().'<br>';
echo $electricCar->name.' '.$electricCar->run();

?>