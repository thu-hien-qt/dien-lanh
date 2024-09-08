<?php
namespace App\Ecommerce;
class Database extends \PDO {
    public function __construct($dsn, $username = null, $password =null, $option = null)
    {
        parent::__construct($dsn, $username, $password, $option);
    }
}