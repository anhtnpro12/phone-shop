<?php
    
class Product {
    private $name;
    private $cost;

    public function payment()
    {
        return 'Mua bằng tiền mặt';
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of cost
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set the value of cost
     */
    public function setCost($cost): self
    {
        $this->cost = $cost;

        return $this;
    }
}

class electronicProduct extends Product {
    public function payment()
    {
        return 'Mua bằng quẹt thẻ';
    }    
}

class foodProduct extends Product {
    public function payment()
    {
        return 'Mua bằng chuyển khoản ngân hàng';
    }    
}



?>