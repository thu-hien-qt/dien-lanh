<?php
namespace App\Ecommerce\Repository;

use App\Ecommerce\Database;

class UserRepository {
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    
}