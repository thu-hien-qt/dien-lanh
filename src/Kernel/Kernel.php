<?php

namespace App\Ecommerce\Kernel;

use Psr\Container\ContainerInterface;

class Kernel
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    function run($interface) {

        $router = $this->container->get(Router::class);

        $callback = $router->routing();
        if (empty($callback)) {
            throw new \Exception("Route invalid");
        }

        $class = $callback["class"];
        $method = $callback["function"];

        $controllerInstance = $this->container->get($class);
        $controllerInstance->checkPermission();

        $controllerInstance->{$method}();
    }

}
