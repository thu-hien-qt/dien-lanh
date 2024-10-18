<?php

namespace App\Ecommerce\Kernel;
use App\Ecommerce\Controller\API\AuthMiddleware;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

class Kernel
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    function run($interface) {

        $app = AppFactory::create(null, $this->container);

        $app->get('/', \App\Ecommerce\Controller\Front\HomePage\IndexAction::class);
        $app->get("/product/{id}", \App\Ecommerce\Controller\Front\Product::class);
        $app->get("/products", \App\Ecommerce\Controller\Front\Products::class);
        
        $app->get("/admin/product/{id}", \App\Ecommerce\Controller\Admin\Product\ViewAction::class);

        $app->group("/api", function (RouteCollectorProxy $group) {
            $group->get("/products", \App\Ecommerce\Controller\API\ProductListingAction::class);
            $group->post("/products", \App\Ecommerce\Controller\API\ProductCreatingAction::class);
            $group->put("/products/{id}", \App\Ecommerce\Controller\API\ProductUpdatingAction::class);
            $group->delete("/products/{id}", \App\Ecommerce\Controller\API\ProductDeleteAction::class);
        })->add(new AuthMiddleware());


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
