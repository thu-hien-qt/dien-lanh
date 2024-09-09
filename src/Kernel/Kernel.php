<?php

namespace App\Ecommerce\Kernel;

class Kernel
{
    function run($interface) {

        $router = new Router();
        $callback = $router->routing();
        if (empty($callback)) {
            throw new \Exception("Route invalid");
        }

        $class = $callback["class"];
        $method = $callback["function"];

        $controllerInstance = new $class();
        $controllerInstance->checkPermission();

        $controllerInstance->{$method}();
    }

}
