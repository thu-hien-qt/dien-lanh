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
        $query = 'SELECT p.id, p.name, p.price, p.imgURL, p.description, categories.name AS category 
                FROM products p JOIN categories ON p.category_id = categories.id 
                GROUP BY p.id';
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
        $query = 'SELECT p.id, p.name, p.price, p.imgURL, p.description, categories.name AS category 
                FROM products p JOIN categories ON p.category_id = categories.id 
                WHERE p.id = :id
                GROUP BY p.id';

        $stmt = $this->database->prepare($query);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetchObject();
        $product = new Product($row);
        return $product;
    }

    public function getProductByCategoryID($id)
    {
        $query = 'SELECT p.id, p.name, p.price, p.imgURL, p.description, c.name AS category 
                FROM products p JOIN categories c ON p.category_id = c.id 
                WHERE c.id = :id
                GROUP BY p.id';

        $stmt = $this->database->prepare($query);
        $stmt->execute([':id'=>$id]);
        $products = [];
        while ($row = $stmt->fetchObject()) {
            $product = new Product($row);
            $products[] = $product;
        }

        return $products;
    }

    public function get10()
    {
        $query = 'SELECT p.id, p.name, p.price, p.imgURL, p.description, categories.name AS category 
                FROM products p JOIN categories ON p.category_id = categories.id 
                GROUP BY p.id LIMIT 10';
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

        $query = 'SELECT id FROM categories WHERE name = :category';
        $stmt = $this->database->prepare($query);
        $stmt->execute(['category' => $product->getCategory()]);
        $categoryId = $stmt->fetchColumn();

        if (!$categoryId) {
            $insertQuery = 'INSERT INTO categories (name) VALUES (:category)';
            $insertStmt = $this->database->prepare($insertQuery);
            $insertStmt->execute(['category' => $product->getCategory()]);
            $categoryId = $this->database->lastInsertId();
        }


        $query2 = 'INSERT INTO products (name, category_id, price, imgURL, brand, description) VALUES (:name, :category_id, :price, :imgURL, :brand, :description)';
        $stmt = $this->database->prepare($query2);
        $stmt->execute([
            ":name" => $product->getName(),
            ":category_id" => $categoryId,
            ":price" => $product->getPrice(),
            ":imgURL" => $product->getImgURL(),
            ":brand" => $product->getBrand(),
            ":description" => $product->getDescription()
        ]);
    }

    public function update(Product $product)
    {
        $query = 'SELECT id FROM categories WHERE name = :category';
        $stmt = $this->database->prepare($query);
        $stmt->execute(['category' => $product->getCategory()]);
        $categoryId = $stmt->fetchColumn();

        if (!$categoryId) {
            $insertQuery = 'INSERT INTO categories (name) VALUES (:category)';
            $insertStmt = $this->database->prepare($insertQuery);
            $insertStmt->execute(['category' => $product->getCategory()]);
            $categoryId = $this->database->lastInsertId();
        }

        $query2 = 'UPDATE products SET name = :name, category_id = :category_id, price = :price, imgURL = :imgURL, brand = :brand, description = :description WHERE id = :id';
        $stmt = $this->database->prepare($query2);
        $stmt->execute([
            ":id" => $product->getId(),
            ":name" => $product->getName(),
            ":category_id" => $categoryId,
            ":price" => $product->getPrice(),
            ":imgURL" => $product->getImgURL(),
            ":brand" => $product->getBrand(),
            ":description" => $product->getDescription()
        ]);
    }

    public function delete($id)
    {
        $query = 'DELETE FROM products WHERE id = :id';
        $stmt = $this->database->prepare($query);
        $stmt->execute([":id" => $id]);
    }
}
