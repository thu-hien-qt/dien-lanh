<?php
namespace App\Ecommerce\Model;
class Category {
    private $id;
    private $name;
    private $parentId;

    public function __construct($data = null)
    {
        if($data)
        {
            $this->id = $data->id;
            $this->name = $data->name;
            $this->parentId = $data->parent_id;
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

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }
}