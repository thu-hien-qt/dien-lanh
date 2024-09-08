<?php

namespace App\Ecommerce;

use App\Ecommerce\Repository\ProductRepository;

class ContainerBuilder
{
    private $container;
    
    public function __construct()
    {
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions("../config/di-config.php");
        $this->container = $builder->build();
    }

    public function getContainer()
    {
        return $this->container;
    }
}
