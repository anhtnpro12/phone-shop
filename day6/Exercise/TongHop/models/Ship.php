<?php

namespace Model;

class Ship {
    private $id;
    private $ship_detail;
    private $customer;
    private $shiped_at;
    
    public function __construct($id = '',
                                $ship_detail = '',
                                $customer = '',
                                $shiped_at = '')
    {
        $this->id = $id;
        $this->ship_detail = $ship_detail;        
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