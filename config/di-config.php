<?php

use App\Ecommerce\Database;
use Psr\Container\ContainerInterface;

return [
    'db.dsn' => 'mysql:host=localhost;dbname=movie',
    'db.username' => "root",
    'db.password' => "",

    Database::class => function (ContainerInterface $c) {
        return new Database($c->get('db.dsn'),$c->get('db.username'), $c->get('db.password'));
    }
];