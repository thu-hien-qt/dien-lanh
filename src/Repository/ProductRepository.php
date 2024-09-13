<?php

namespace App\Ecommerce\Repository;

use App\Ecommerce\Database;
use App\Ecommerce\Model\Product;

class ProductRepository
{
    private $database;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAll()
    {
        $query = 'SELECT products.name, products.price, products.imgURL, products.description, category.name AS category 
                FROM products JOIN category ON products.categoryID = category.categoryID 
                GROUP BY products.productID';
        $stmt = $this->database->query($query);
        $products = [];
        while ($row = $stmt->fetchObject()) {
            $product = new Product($row);
            $products[] = $product;
        }

        return $products;
    }

    public function getProductByID()
    {
        $query = 'SELECT products.productID, products.name, products.price, products.imgURL, products.description, category.name AS category 
                FROM products JOIN category ON products.categoryID = category.categoryID 
                WHERE products.producID = :productID
                GROUP BY products.productID';
        $stmt = $this->database->query($query);
        $row = $stmt->fetchObject();
        $product = new Product($row);
        return $product;
    }
}
