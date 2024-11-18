<?php
namespace App\Ecommerce\Model;
class UserDto implements \JsonSerializable {
    private $id;
    private $name;
    private $username;
    private $password;
    private $address;
    private $phone;
    private $role;

    public function __construct(User $user = null)
    {
        if ($user) {
            $this->id = $user->getId();
            $this->name = $user->getName();
            $this->username = $user->getUsername();
            $this->password = $user->getPassword();
            $this->address = $user->getAddress();
            $this->phone = $user->getPhone();
            $this->role = $user->getRole();
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function jsonSerialize() :array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'userName' => $this->getUsername(),
            'address' => $this->getAddress(),
            'phone' => $this->getPhone(),
        ];
    }
}