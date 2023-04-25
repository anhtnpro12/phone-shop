<?php

namespace Model;

class OrderShipping {
    private $id;
    private $shipping;
    private $customer;
    private $shiped_at;
    
    public function __construct($id = '',
                                $shipping = '',
                                $customer = '',
                                $shiped_at = '')
    {
        $this->id = $id;
        $this->shipping = $shipping;        
        $this->customer = $customer;                
        $this->shiped_at = $shiped_at;
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