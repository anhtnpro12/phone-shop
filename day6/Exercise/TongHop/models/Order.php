<?php

namespace Model;

class Order {
    private $id;
    private $customer_id;
    private $amount;
    private $state;
    private $delete_flag;
    private $ship_id;
    private $payment_id;
    private $created_at;        
    private $paid_at;        
    private $shipped_at;        

    public function __construct($id = '',
                                $customer_id = '',
                                $amount = '',
                                $state = '',
                                $delete_flag = '',
                                $ship_id = '',
                                $payment_id = '',
                                $created_at = '',
                                $paid_at = '',
                                $shipped_at = '')
    {
        $this->id = $id;
        $this->customer_id = $customer_id;        
        $this->amount = $amount;        
        $this->state = $state;
        $this->delete_flag = $delete_flag;
        $this->ship_id = $ship_id;
        $this->payment_id = $payment_id;
        $this->created_at = $created_at;
        $this->paid_at = $paid_at;
        $this->shipped_at = $shipped_at;
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