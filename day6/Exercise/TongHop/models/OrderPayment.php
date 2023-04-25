<?php

namespace Model;

class OrderPayment {
    private $id;
    private $payment;
    private $amount;
    private $customer;
    private $paid_at;
    
    public function __construct($id = '',
                                $payment = '',
                                $amount = '',
                                $customer = '',
                                $paid_at = '')
    {
        $this->id = $id;
        $this->payment = $payment;        
        $this->amount = $amount;                
        $this->customer = $customer;
        $this->paid_at = $paid_at;
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