<?php

namespace App\Ecommerce\Kernel;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;

class Kernel
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    function run($interface) {

        $app = AppFactory::create(null, $this->container);

        $app->get('/', \App\Ecommerce\Controller\Front\HomePage\IndexAction::class);
        $app->get("/product/{id}", \App\Ecommerce\Controller\Front\ProductAction::class);
        
        $app->get("/admin/product/{id}", \App\Ecommerce\Controller\Admin\Product\ViewAction::class);

        $app->get("/api/products", \App\Ecommerce\Controller\API\ProductListingAction::class);
        $app->post("/api/products", \App\Ecommerce\Controller\API\ProductCreatingAction::class);
        $app->put("/api/products/{id}", \App\Ecommerce\Controller\API\ProductUpdatingAction::class);
        $app->delete("/api/products/{id}", \App\Ecommerce\Controller\API\ProductDeleteAction::class);

        $app->run();
        // $router = $this->container->get(Router::class);

        // $callback = $router->routing();
        // if (empty($callback)) {
        //     throw new \Exception("Route invalid");
        // }

        // $class = $callback["class"];
        // $method = $callback["function"];
        // $params = $callback["params"];

        // $controllerInstance = $this->container->get($class);
        // $controllerInstance->checkPermission();

        // $controllerInstance->{$method}($params["id"]);
    }

}
