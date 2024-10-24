<?php
namespace App\Ecommerce\Model;
class Order {
    private $orderID;
    private $productID;
    private $quantity;
    private $unitPrice;
    private $userID;
    private $date;

    public function __construct($data = null)
    {
        if($data)
        {
            $this->orderID = $data->orderID;
            $this->productID = $data->productID;
            $this->quantity = $data->quantity;
            $this->unitPrice = $data->unitPrice;
            $this->userID = $data->userID;
            $this->date = $data->date;
        }
    }

    public function getOrderID()
    {
        return $this->orderID;
    }

    public function setOrderID($orderID)
    {
        $this->orderID = $orderID;
    }

    public function getProductID()
    {
        return $this->productID;
    }

    public function setProductID($productID)
    {
        $this->productID = $productID;
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
    public function getUserID()
    {
        return $this->userID;
    }

    public function setUserID($userID)
    {
        $this->userID = $userID;
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

