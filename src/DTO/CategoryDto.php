<?php

namespace App\Ecommerce\DTO;

use App\Ecommerce\Model\Category;

class CategoryDto implements \JsonSerializable
{
    private $id;
    private $name;
    private $parentId;

    public function __construct(Category $category = null)
    {
        if ($category) {
            $this->id = $category->getId();
            $this->name = $category->getName();
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

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
        ];
    }
}
