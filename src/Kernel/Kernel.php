<?php

namespace App\Ecommerce\Kernel;

use App\Ecommerce\ContainerBuilder;
use Psr\Container\ContainerInterface;

class Kernel
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
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
