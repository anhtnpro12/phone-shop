<?php

namespace Model;

class PayDetail {
    private $id;
    private $name;
    private $description;
    private $status;
    
    public function __construct($id = '',
                                $name = '',
                                $description = '',                                
                                $status = '')
    {
        $this->id = $id;
        $this->name = $name;        
        $this->description = $description;                
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