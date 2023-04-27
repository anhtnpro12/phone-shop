<?php

namespace Model;

class OrderDetail {
    private $id;
    private $order_id;
    private $product;    
    private $quantity;
    
    public function __construct($id = '',
                                $order_id = '',
                                $product = '',                                
                                $quantity = '')
    {
        $this->id = $id;
        $this->order_id = $order_id;        
        $this->product = $product;                
        $this->quantity = $quantity;        
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