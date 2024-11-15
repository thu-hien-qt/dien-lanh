<?php
namespace App\Ecommerce\Model;
class Category {
    private $ID;
    private $name;

    public function __construct($data = null)
    {
        if($data)
        {
            $this->ID = $data->categoryID;
            $this->name = $data->name;
        }
    }
    public function getID()
    {
        return $this->ID;
    }

    public function setID($id)
    {
        $this->ID = $id;
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