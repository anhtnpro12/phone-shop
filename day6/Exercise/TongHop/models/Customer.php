<?php

namespace Model;

class Customer {
    private $id;
    private $name;
    private $address;
    private $phone;
    private $email;
    private $status;
    
    public function __construct($id = '',
                                $name = '',
                                $address = '',
                                $phone = '',
                                $email = '',
                                $status = '')
    {
        $this->id = $id;
        $this->name = $name;        
        $this->address = $address;        
        $this->phone = $phone;
        $this->email = $email;
        $this->status = $status;
    }

    public function &__get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        } else {
            die('Property not exist');
        }
    }    

    public function __set($name, $value)    
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            die('Property not exist');
        }
    }
}