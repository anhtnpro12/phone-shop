<?php

trait User {     
    public $name;
    public $age;
    public $address;
    public $email;
    public $phone;

    public function Hello()
    {
        echo "hello";
    }
}

trait Security {

    public $user_name;
    public $password;

    public function checkLogin($user_name, $password) {        
        if ($this->user_name === $user_name && $this->password === $password) {
            return true;
        }
        return false;
    }
}

class Employee {
    use User, Security;   
    
    function __construct($user_name = '', 
                        $password = '') {                                    
        $this->user_name = $user_name;
        $this->password = $password;
    }
}

$test = new Employee('admin', '123');
echo $test->Hello().'<br>';
var_dump($test->checkLogin('admin', '123'));