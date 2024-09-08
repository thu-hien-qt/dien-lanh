<?php

namespace App\Ecommerce\Controller\Front;

use App\Ecommerce\ContainerBuilder;
use App\Ecommerce\Controller\CheckPermission;
use App\Ecommerce\Repository\ProductRepository;

class HomeController extends CheckPermission
{
    public function index()
    {
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions("../config/di-config.php");
        $container = $builder->build();
        $p = $container->get(ProductRepository::class);
        print_r($p->getAll());
    }

    public function category() {}
}
