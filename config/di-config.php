<?php

use App\Ecommerce\Database;
use App\Ecommerce\Kernel\Kernel;
use DI\Container;
use Psr\Container\ContainerInterface;

return [
    'db.dsn' => 'mysql:host=localhost;dbname=ecommerce',
    'db.username' => "root",
    'db.password' => "",

    Database::class => function (ContainerInterface $c) {
        return new Database($c->get('db.dsn'),$c->get('db.username'), $c->get('db.password'));
    },

    Kernel::class => function (ContainerInterface $c) {
        return new Kernel($c);
    }
];