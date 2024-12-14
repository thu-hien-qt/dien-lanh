<?php

namespace App\Ecommerce\DTO;

use App\Ecommerce\Model\Category;

class CategoryDto implements \JsonSerializable
{
    private $id;
    private $name;
    private $parentId;
    private $children = [];

    public function __construct(Category $category = null)
    {
        if ($category) {
            $this->id = $category->getId();
            $this->name = $category->getName();
            $this->children = array_map(function ($child) {
                return new CategoryDto($child);
            }, $category->getChildren());
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

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
           'children' => array_map(function ($child) {
            return $child->jsonSerialize();
        }, $this->getChildren())
        ];
    }
}
