<?php

class Animal {
    public $name;
    public $age;
    public $color;

    function __construct($name = '', $age = 0, $color = '')
    {
        $this->name = $name;
        $this->age = $age;
        $this->color = $color;
    }

    public function eat()
    {
        return 'Măm Măm<br>';
    }

    public function sleep()
    {
        return 'Khò khò<br>';
    }

    public function run()
    {
        return 'hộc hộc<br>';
    }
}

class Cat extends Animal {

    public function eat()
    {
        return '... meow<br>';
    }

    public function sleep()
    {
        return '... meow meow<br>';
    }

    public function run()
    {
        return '... meow meow meow<br>';
    }
}

class Dog extends Animal {
    public function eat()
    {
        return '... gâu<br>';
    }

    public function sleep()
    {
        return '... gâu gâu<br>';
    }

    public function run()
    {
        return '... gâu gâu gâu<br>';
    }         
}

class Crocodile extends Animal {
    public function eat()
    {
        return '... goàm<br>';
    }

    public function sleep()
    {
        return '... goàm goàm<br>';
    }

    public function run()
    {
        return '... goàm goàm goàm<br>';
    }         
}

$animal = new Animal('Động vật', 100, 'Hồng');
echo $animal->name.', '.$animal->age.' tuổi, màu '.$animal->color.' đang:<br>';
echo 'Ăn: '.$animal->eat();
echo 'Ngủ: '.$animal->sleep();
echo 'Chạy: '.$animal->run();
echo '<br>';

$cat = new Cat('Mồn lèo', 20, 'độc lạ');
echo $cat->name.', '.$cat->age.' tuổi, màu '.$cat->color.' đang:<br>';
echo 'Ăn: '.$cat->eat();
echo 'Ngủ: '.$cat->sleep();
echo 'Chạy: '.$cat->run();
echo '<br>';

$dog = new Dog('john', 30, 'đen');
echo $dog->name.', '.$dog->age.' tuổi, màu '.$dog->color.' đang:<br>';
echo 'Ăn: '.$dog->eat();
echo 'Ngủ: '.$dog->sleep();
echo 'Chạy: '.$dog->run();
echo '<br>';

$cro = new Crocodile('cá sấu', 40, 'đỏ');
echo $cro->name.', '.$cro->age.' tuổi, màu '.$cro->color.' đang:<br>';
echo 'Ăn: '.$cro->eat();
echo 'Ngủ: '.$cro->sleep();
echo 'Chạy: '.$cro->run();
echo '<br>';


?>