<?php
namespace App\Ecommerce\Model;
class User {
    private $userID;
    private $name;
    private $username;
    private $password;
    private $address;
    private $phone;
    private $role;

    public function getUserID()
    {
        return $this->userID;
    }

    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getaddress()
    {
        return $this->address;
    }

    public function setaddress($address)
    {
        $this->address = $address;
    }

    public function getphone()
    {
        return $this->phone;
    }

    public function setphone($phone)
    {
        $this->phone = $phone;
    }

    public function getrole()
    {
        return $this->role;
    }

    public function setrole($role)
    {
        $this->role = $role;
    }
}