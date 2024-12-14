<?php

namespace App\Ecommerce\Repository;

use App\Ecommerce\Database;
use App\Ecommerce\Model\Category;

class CategoryRepository
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAll()
{
    
    $query = "SELECT * FROM categories ORDER BY parent_id ASC, id ASC";
    $stmt = $this->database->query($query);

    $categories = [];
    while ($row = $stmt->fetchObject()) {
        $categories[] = new Category($row);
    }

    return $this->buildCategoryTree($categories);
}

private function buildCategoryTree($categories, $parentId = null)
{
    $tree = [];
    foreach ($categories as $category) {
        if ($category->getParentId() == $parentId) {
            $children = $this->buildCategoryTree($categories, $category->getId());
            $category->setChildren($children);
            $tree[] = $category;
        }
    }
    return $tree;
}


    public function insert(Category $category)
    {
        $query = "INSERT INTO categories (name, parent_id) VALUES (:name, :parent_id)";
        $stmt = $this->database->prepare($query);
        $stmt->execute([
            ":name" => $category->getName(),
            ":parent_id" => $category->getParentId()
        ]);
    }

    public function update(Category $category)
    {
        $query = "UPDATE FROM categories SET name = :name, parent_id = :parentId WHERE id = :id";
        $stmt = $this->database->prepare($query);
        $stmt->execute([
            ":name" => $category->getName(),
            ":parentId" => $category->getParentId(),
            ":id" => $category->getID()
        ]);
    }

    public function delete(Category $category)
    {
        $query = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->database->prepare($query);
        $stmt->execute([":id" => $category->getID()]);
    }
}
