<?php

namespace Model;

class Order {
    private $id;
    private $customer_id;
    private $address;
    private $total;
    private $state;
    private $payment;
    private $status;
    private $created_at;
    private $created_by;
    private $modified_at;
    private $modified_by;  
    
    public function __construct($id = '', $customer_id = '', $address = '', $total = '', $state = '', $payment = ''
                        , $status = '', $created_at = '', $created_by = '', $modified_at = '', $modified_by = '') 
    {
        $this->id = $id;
        $this->customer_id = $customer_id;
        $this->address = $address;
        $this->total = $total;
        $this->state = $state;
        $this->payment = $payment;
        $this->status = $status;
        $this->created_at = $created_at;
        $this->created_by = $created_by;
        $this->modified_at = $modified_at;
        $this->modified_by = $modified_by;
    }

    public function &__get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        } else {
            die('Properties not exist');
        }
    }

    public function __set($name, $value) {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            die('Properties not exist');
        }
    }

    public function __toString() {
        return "id: $this->id, customer_id: $this->customer_id, address: $this->address, 
                total: $this->total, state: $this->state, payment: $this->payment, status: $this->status
                , created_at: $this->created_at, created_by: $this->created_by, modified_at: $this->modified_at
                , modified_by: $this->modified_by";
    }
}