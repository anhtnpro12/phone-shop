<?php

class User {
    private $id;
    private $user_name;
    private $password;
    private $name;
    private $age;
    private $address;
    private $sex;
    private $last_active;

    public function __construct($id = '',
                                $user_name = '',
                                $password = '',
                                $name = '',
                                $age = '',
                                $address = '',
                                $sex = '',
                                $last_active = '')
    {
        $this->id = $id;
        $this->user_name = $user_name;
        $this->password = $password;
        $this->name = $name;
        $this->age = $age;
        $this->address = $address;
        $this->sex = $sex;
        $this->last_active = $last_active;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of user_name
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * Set the value of user_name
     */
    public function setUserName($user_name): self
    {
        $this->user_name = $user_name;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
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
     * Get the value of age
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of age
     */
    public function setAge($age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     */
    public function setAddress($address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of sex
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set the value of sex
     */
    public function setSex($sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get the value of last_active
     */
    public function getLastActive()
    {
        return $this->last_active;
    }

    /**
     * Set the value of last_active
     */
    public function setLastActive($last_active): self
    {
        $this->last_active = $last_active;

        return $this;
    }
}