<?php

namespace App\Ecommerce\DTO;

use App\Ecommerce\Model\Category;

class CategoryDto implements \JsonSerializable
{
    private $Id;
    private $name;

    public function __construct(Category $category = null)
    {
        if ($category) {
            $this->Id = $category->getId();
            $this->name = $category->getName();
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

    public function jsonSerialize(): array
    {
        return [
            'Id' => $this->getId(),
            'name' => $this->getName(),
        ];
    }
}
