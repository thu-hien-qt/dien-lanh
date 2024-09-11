<?php
namespace App\Ecommerce\Repository;

use App\Ecommerce\Database;
use App\Ecommerce\Model\Product;

class ProductRepository {
    private $database;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAll()
    {
        $query = 'SELECT * FROM genres';
        $stmt = $this->database->query($query);
        $genres = [];
        while ($row = $stmt->fetchObject()) {
            $genre = new Product;
            $genre->setName($row->name);
            $genres[] = $genre;
        }

        return $genres;
    }
}