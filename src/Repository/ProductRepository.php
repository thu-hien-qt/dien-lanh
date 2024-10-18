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
        $query = 'SELECT p.productID, p.name, p.price, p.imgURL, p.description, category.name AS category 
                FROM products p JOIN category ON p.categoryID = category.categoryID 
                GROUP BY p.productID';
        $stmt = $this->database->query($query);
        $products = [];
        while ($row = $stmt->fetchObject()) {
            $product = new Product($row);
            $products[] = $product;
        }

        return $products;
    }


    public function getProductByID($id)
    {
        $query = 'SELECT p.productID, p.name, p.price, p.imgURL, p.description, category.name AS category 
                FROM products p JOIN category ON p.categoryID = category.categoryID 
                WHERE p.productID = :productID
                GROUP BY p.productID';

        $stmt = $this->database->prepare($query);
        $stmt->execute(['productID' => $id]);
        $row = $stmt->fetchObject();
        $product = new Product($row);
        return $product;
    }

    public function get10()
    {
        $query = 'SELECT p.productID, p.name, p.price, p.imgURL, p.description, category.name AS category 
                FROM products p JOIN category ON p.categoryID = category.categoryID 
                GROUP BY p.productID LIMIT 10';
        $stmt = $this->database->query($query);
        $products = [];
        while ($row = $stmt->fetchObject()) {
            $product = new Product($row);
            $products[] = $product;
        }

        return $products;
    }

    public function insert(Product $product)
    {

        $query = 'SELECT categoryID FROM category WHERE name = :category';
        $stmt = $this->database->prepare($query);
        $stmt->execute(['category' => $product->getCategory()]);
        $categoryID = $stmt->fetchColumn();

        if (!$categoryID) {
            $insertQuery = 'INSERT INTO category (name) VALUES (:category)';
            $insertStmt = $this->database->prepare($insertQuery);
            $insertStmt->execute(['category' => $product->getCategory()]);
            $categoryID = $this->database->lastInsertId();
        }


        $query2 = 'INSERT INTO products (name, categoryID, price, imgURL, brand, description) VALUES (:name, :categoryID, :price, :imgURL, :brand, :description)';
        $stmt = $this->database->prepare($query2);
        if ($stmt->execute([
            "name" => $product->getName(),
            "categoryID" => $categoryID,
            "price" => $product->getPrice(),
            "imgURL" => $product->getImgURL(),
            "brand" => $product->getBrand(),
            "description" => $product->getDescription()
        ]));
    }

    public function update(Product $product)
    {
        $query = 'SELECT categoryID FROM category WHERE name = :category';
        $stmt = $this->database->prepare($query);
        $stmt->execute(['category' => $product->getCategory()]);
        $categoryID = $stmt->fetchColumn();

        if (!$categoryID) {
            $insertQuery = 'INSERT INTO category (name) VALUES (:category)';
            $insertStmt = $this->database->prepare($insertQuery);
            $insertStmt->execute(['category' => $product->getCategory()]);
            $categoryID = $this->database->lastInsertId();
        }

        $query2 = 'UPDATE products SET name = :name, categoryID = :categoryID, price = :price, imgURL = :imgURL, brand = :brand, description = :description WHERE productID = :productID';
        $stmt = $this->database->prepare($query2);
        $stmt->execute([
            "productID" => $product->getProductID(),
            "name" => $product->getName(),
            "categoryID" => $categoryID,
            "price" => $product->getPrice(),
            "imgURL" => $product->getImgURL(),
            "brand" => $product->getBrand(),
            "description" => $product->getDescription()
        ]);
    }

    public function delete($id)
    {
        $query = 'DELETE FROM products WHERE productID = :productID';
        $stmt = $this->database->prepare($query);
        $stmt->execute(["productID" => $id]);
    }

}
