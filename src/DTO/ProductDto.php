<?php

namespace App\Ecommerce\DTO;

use App\Ecommerce\Model\Product;

class ProductDto implements \JsonSerializable
{
    private $id;
    private $name;
    private $category;
    private $price;
    private $imgURL;
    private $brand;
    private $description;

    public function __construct(Product $product = null)
    {
        if ($product) {
            $this->setId($product->getId());
            $this->setName($product->getName());
            $this->setCategory($product->getCategory());
            $this->setPrice($product->getPrice());
            $this->setImgURL($product->getImgURL());
            $this->setDescription($product->getDescription());
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

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getImgURL()
    {
        return $this->imgURL;
    }

    public function setImgURL($imgURL)
    {
        $this->imgURL = $imgURL;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function jsonSerialize() :array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'imgURL' => $this->getImgURL(),
            'brand' => $this->getBrand(),
            'description' => $this->getDescription(),
            'category' => $this->getCategory(),
        ];
    }
}