<?php

class MyClass
{
    // function MyClass() {
    //     // to do
    // }

    function __construct()
    {
        echo "1";
    }
}

class children extends MyClass
{
    function __construct($test)
    {
        echo "adsfasdf";
    }
}

class Person
{
    function __construct()
    {
        echo "Lớp Person được khởi tạo<br>";
    }
}

class Student extends Person
{
    private $name;
    private $age;

    function __construct()
    {
        echo "Lớp Student được khởi tạo<br>";
    }

    function doSomething()
    {
        echo "do something";
    }

    function __destruct()
    {
        echo 'Huy doi tuong';
    }

    function __toString()
    {
        return 'hahahahahahha';
    }

    function __set($key, $value)
    {    
        if (property_exists($this, $key)) {            
            $this->$key = $value;
        } else {
            die ('Không tồn tại thuộc tính');
        }
    }

    // function getName() {
    //     return $this->name;
    // }

    function __get($key) {
        //kiểm tra xem trong class có tồn tại thuộc tính không
        if (property_exists($this, $key)) {
            //tiến hành lấy giá trị
            return $this->$key;
        } else {
            die ('Không tồn tại thuộc tính');
        }
    }
}

$a = new Student();
// $a->doSomething();
// echo $a;
// unset($a);
$a->name = 'Anh';
// echo $a->name;

//--------------------------- trait ------------------------
trait MyTrait {
    // code trong trait có properties và function
    public function hello() {
        echo "hello from trait";
    }
}

class MyClass2 {
    use MyTrait {
        hello as public sayHello;
    }

    public function hello() {
        echo "hello from class";
    }
}

$obj = new MyClass2();
$obj->hello();
$obj->sayHello();

trait TraitA {
    public function doSomething() {
        echo 'do something from TraitA';
    }
}

trait TraitB {
    public function doSomething() {
        echo 'do something from TraitB';
    }
}

class MyClass3 {
    use TraitA, traitB {
        TraitA::doSomething insteadof TraitB;
        TraitB::doSomething as doSomethingB ;
    }

    public function doSomethingElse() {
        $this->doSomething();
    }
}