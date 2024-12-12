<?php

namespace App\Ecommerce\Model;

class Product
{
    private $id;
    private $name;
    private $category;
    private $price;
    private $imgURL;
    private $brand;
    private $description;

    public function __construct($data = null)
    {
        if ($data) {
            $this->setId($data->id);
            $this->setName($data->name);
            $this->setCategory($data->category);
            $this->setPrice($data->price);
            $this->setImgURL($data->imgURL);
            $this->setDescription($data->description);
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
}
