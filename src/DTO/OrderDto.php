<?php
namespace App\Ecommerce\DTO;

use App\Ecommerce\Model\Order;
use App\Ecommerce\Model\Product;
use App\Ecommerce\Model\User;

class OrderDto implements \JsonSerializable {
    private $id;
    private $product;
    private $quantity;
    private $unitPrice;
    private $userName;
    private $date;

    public function __construct(Order $order = null, User $user = null, Product $product = null )
    {
        if($order && $user && $product)
        {
            $this->id = $order->getId();
            $this->product = $product->getName();
            $this->quantity = $order->getQuantity();
            $this->unitPrice = $order->getUnitPrice();
            $this->userName = $user->getName();
            $this->date = $order->getDate();
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

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product)
    {
        $this->product = $product;
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
    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function jsonSerialize() :array
    {
        return [
            'id' => $this->getId(),
            'product' => $this->getProduct(),
            'quantity' => $this->getQuantity(),
            'unitPrice' => $this->getUnitPrice(),
            'user' => $this->getUserName(),
            'date' => $this->getdate(),
        ];
    }
}

