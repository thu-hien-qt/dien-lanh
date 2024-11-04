<?php

namespace App\Ecommerce\Kernel;

use App\Ecommerce\Controller\API\AuthMiddleware;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Psr7\Response;

class Kernel
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    function run($interface) {

        $app = AppFactory::create(null, $this->container);

        // Middleware CORS
        $app->add(function ($request, $handler) {
            $response = $handler->handle($request);
            return $response
                ->withHeader('Access-Control-Allow-Origin', '*') // Cài đặt nguồn gốc cho phép
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS') // Phương thức cho phép
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Authorization'); // Header cho phép
        });

        // Handle OPTIONS requests for all routes
        $app->options('/{routes:.+}', function ($request, $response, $args) {
            return $response;
        });

        // Define routes
        $app->get('/', \App\Ecommerce\Controller\Front\HomePage\IndexAction::class);
        $app->get("/product/{id}", \App\Ecommerce\Controller\Front\Product::class);
        $app->get("/products", \App\Ecommerce\Controller\Front\Products::class);

        $app->get("/admin/product/{id}", \App\Ecommerce\Controller\Admin\Product\ViewAction::class);

        $app->group("/api", function (RouteCollectorProxy $group) {
            $group->get("/products", \App\Ecommerce\Controller\API\ProductListingAction::class);
            $group->post("/products", \App\Ecommerce\Controller\API\ProductCreatingAction::class);
            $group->put("/products/{id}", \App\Ecommerce\Controller\API\ProductUpdatingAction::class);
            $group->delete("/products/{id}", \App\Ecommerce\Controller\API\ProductDeleteAction::class);
        })->add(AuthMiddleware::class);

        $app->run();
    }
}
