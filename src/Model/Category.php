<?php
namespace App\Ecommerce\Model;
class Category {
    private $id;
    private $name;
    private $parentId;
    private $children = [];

    public function __construct($data = null)
    {
        if($data)
        {
            $this->id = $data->id ?? null;
            $this->name = $data->name ?? null;
            $this->parentId = $data->parent_id ?? null;
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

    public function getChildren()
    {
        return $this->children;
    }

    public function setChildren( array $children)
    {
        $this->children = $children;
    }
}