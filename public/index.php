<?php

use App\Ecommerce\ContainerBuilder;
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
$builder = new \DI\ContainerBuilder();
$builder->addDefinitions("../config/di-config.php");
$container = $builder->build();
$kernel = $container->get(Kernel::class);
$kernel->run("front");
