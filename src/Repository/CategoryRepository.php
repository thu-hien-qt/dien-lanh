<?php
namespace App\Ecommerce\Repository;

use App\Ecommerce\Database;
use App\Ecommerce\Model\Category;

class CategoryRepository {
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAll()
    {
        $query = "SELECT * FROM category";
        $stmt = $this->database->query($query);

        $categories = [];
        while ($row = $stmt->fetchObject()) 
        {
            $categories[] = new Category($row);
        }
        return $categories;
    }

    public function insert(Category $category)
    {
        $query = "INSERT INTO category (name) VALUES (:name)";
        $stmt = $this->database->prepare($query);
        $stmt->execute([":name" => $category->getName()]);
    }

    public function update(Category $category)
    {
        $query = "UPDATE FROM category SET name = :name WHERE id = :id";
        $stmt = $this->database->prepare($query);
        $stmt->execute([":name" => $category->getName(),
                        ":id" => $category->getID()]);
    }

    public function delete(Category $category)
    {
        $query = "DELETE FROM"
    }

}