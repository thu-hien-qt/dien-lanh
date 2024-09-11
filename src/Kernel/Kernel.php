<?php

namespace App\Ecommerce\Kernel;

use App\Ecommerce\ContainerBuilder;

class Kernel
{
    protected $container;

    public function __construct() {
        $containerBuilder = new ContainerBuilder();
        $this->container = $containerBuilder->getContainer();
    }

    function run($interface) {

        if (empty($controller) && empty($action)) {
            if ($interface == 'front') {
                $controller = "front.home";
            } elseif ($interface == 'admin') {
                $controller = "admin.home";
            }
            $action = "index";
        }
        $router = $this->container->get(Router::class);
        $callback = $router->routing($controller, $action);
        $class = $callback["class"];
        $method = $callback["function"];

        $controllerInstance = $this->container->get($class);
        $controllerInstance->checkPermission();

        $controllerInstance->{$method}();
    }

}
