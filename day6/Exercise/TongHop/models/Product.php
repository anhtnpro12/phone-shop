<?php

namespace Model;

class Product {
    private $id;
    private $name;
    private $description;
    private $price;
    private $quantity;
    private $delete_flag;
    
    public function __construct($id = '',
                                $name = '',
                                $description = '',
                                $price = '',
                                $quantity = '',
                                $delete_flag = '')
    {
        $this->id = $id;
        $this->name = $name;        
        $this->description = $description;        
        $this->price = $price;
        $this->quantity = $quantity;
        $this->delete_flag = $delete_flag;
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