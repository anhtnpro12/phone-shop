<?php

class User
{
    private $user_name;
    private $password;
    private $email;

    function __construct($user_name = '', $password = '', $email = '')
    {
        $this->user_name = $user_name;
        $this->password = $password;
        $this->email = $email;
    }

    public function login()
    {
        return 'Login with user role successful';
    }

    public function register()
    {
        return 'Register successful';
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
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }
}

class Admin extends User {
    public function login()
    {
        return 'Login with admin role successful';
    }
}

$user = new User('Nam Anh', '1234', 'anh@gmail.com');
echo $user->getUserName().'<br>';
echo $user->getPassword().'<br>';
echo $user->getEmail().'<br>';
echo $user->login().'<br>';
echo $user->register().'<br>';

$admin = new Admin('vẫn là Nam Anh', '1234', 'admin@gmail.com');
echo $admin->getUserName().'<br>';
echo $admin->getPassword().'<br>';
echo $admin->getEmail().'<br>';
echo $admin->login().'<br>';
echo $admin->register().'<br>';