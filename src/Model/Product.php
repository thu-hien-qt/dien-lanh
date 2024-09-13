<?php
namespace App\Ecommerce\Model;
class Product {
    private $name;
    private $category;
    private $price;
    private $imgURL;
    private $description;

    public function __construct($data)
    {
        $this->setName($data->name);
        $this->setCategory($data->category);
        $this->setPrice($data->price);
        $this->setImgURL($data->imgURL);
        $this->setDescription($data->description);
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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}