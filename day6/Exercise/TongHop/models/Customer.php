<?php

namespace Model;

class Customer {
    private $id;
    private $name;
    private $address;
    private $phone;
    private $email;
    private $delete_flag;
    
    public function __construct($id = '',
                                $name = '',
                                $address = '',
                                $phone = '',
                                $email = '',
                                $delete_flag = '')
    {
        $this->id = $id;
        $this->name = $name;        
        $this->address = $address;        
        $this->phone = $phone;
        $this->email = $email;
        $this->delete_flag = $delete_flag;
    }

    public function &__get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        } else {
            die('Property '.$name.' not exist');
        }
    }    

    public function __set($name, $value)    
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            die('Property '.$name.' not exist');
        }
    }
}