<?php
namespace App\Ecommerce\Model;
class Category {
    private $Id;
    private $name;

    public function __construct($data = null)
    {
        if($data)
        {
            $this->Id = $data->categoryID;
            $this->name = $data->name;
        }
    }
    public function getId()
    {
        return $this->Id;
    }

    public function setId($Id)
    {
        $this->Id = $Id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}