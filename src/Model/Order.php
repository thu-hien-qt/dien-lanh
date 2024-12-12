<?php
namespace App\Ecommerce\Model;
class Order {
    private $id;
    private $productId;
    private $quantity;
    private $unitPrice;
    private $userId;
    private $date;

    public function __construct($data = null)
    {
        if($data)
        {
            $this->id = $data->id;
            $this->productId = $data->product_id;
            $this->quantity = $data->quantity;
            $this->unitPrice = $data->unitPrice;
            $this->userId = $data->user_id;
            $this->date = $data->date;
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

    public function getProductId()
    {
        return $this->productId;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }
    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }
}

