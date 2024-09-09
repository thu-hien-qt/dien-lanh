<?php

use App\Ecommerce\Kernel\Kernel;

include '..\vendor\autoload.php';
// // use App\Ecommerce\Database;
// // use App\Ecommerce\Repository\ProductRepository;
// // use App\Ecommerce\Repository\UserRepository;

// // // $db = new Database("host", 80, "name", 2);
// // // $userRepository = new UserRepository($db);
// // // print_r($userRepository);

// // $userRepository = $container->get("App\Ecommerce\Repository\UserRepository");
// // $productRepository = $container->get( ProductRepository::class);
var_dump($_SERVER['REQUEST_URI']);
$index = new Kernel;
$index->run("front");
