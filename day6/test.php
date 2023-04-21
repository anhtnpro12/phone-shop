<?php
class Person
{    

    function __construct()
    {
        echo "Khởi tạo lớp Person";
    }
}

class Student extends Person
{
    private $name;
    private $bla;

    function __construct()
    {
        echo "Khởi tạo lớp Student";
    }

    public function doSomething()
    {
        echo 'Do something';
    }

    function __destruct()
    {
        echo 'Hủy đối tượng';
    }
    
    function __set($key, $value)
    {
        if (property_exists($this, $key))
        {
            $this->key = $value;
        } else {
            die ('Thuộc tính không tồn tại');
        }
    }

    // function __get($name)
    // {
        
    // }
}

$a = new Student();
// $a->doSomething();
$a->name = 'vvq';