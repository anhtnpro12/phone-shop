<?php

namespace Model;

class Pay {
    private $id;
    private $pay_detail;
    private $pay_amount;
    private $customer;
    private $paid_at;
    
    public function __construct($id = '',
                                $pay_detail = '',
                                $pay_amount = '',
                                $customer = '',
                                $paid_at = '')
    {
        $this->id = $id;
        $this->pay_detail = $pay_detail;        
        $this->pay_amount = $pay_amount;                
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