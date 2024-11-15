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

        // Middleware CORS
        $app->add(function ($request, $handler) {
            $response = $handler->handle($request);
            $origin = $request->getHeaderLine('Origin');

            return $response
                ->withHeader('Access-Control-Allow-Origin', $origin ?: '*')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Authorization')
                ->withHeader('Access-Control-Allow-Credentials', 'true');
        });

        // Handle OPTIONS requests for all routes
        $app->options('/{routes:.+}', function ($request, $response, $args) {
            return $response->withStatus(200);
        });

        // Error Handling Middleware
        $app->addErrorMiddleware(true, true, true);

        // Define routes
        $app->get('/', \App\Ecommerce\Controller\Front\HomePage\IndexAction::class);
        $app->get("/product/{id}", \App\Ecommerce\Controller\API\Product\Product\ProductByIdAction::class);
        $app->get("/products", \App\Ecommerce\Controller\Front\Products::class);
        $app->get("/category", \App\Ecommerce\Controller\Front\Category::class);
        $app->get("/productsByCategory/{id}", \App\Ecommerce\Controller\Front\ProductsByCategory::class);
        

        $app->get("/admin/product/{id}", \App\Ecommerce\Controller\Admin\Product\ViewAction::class);

        $app->group("/api", function (RouteCollectorProxy $group) {
            $group->get("/products", \App\Ecommerce\Controller\API\Product\products\ProductListingAction::class);
            $group->post("/products", \App\Ecommerce\Controller\API\Product\products\ProductCreatingAction::class);
            $group->put("/products/{id}", \App\Ecommerce\Controller\API\Product\products\ProductUpdatingAction::class);
            $group->delete("/products/{id}", \App\Ecommerce\Controller\API\Product\products\ProductDeleteAction::class);

            $group->get("/product/{id}", \App\Ecommerce\Controller\API\Product\Product\ProductByIdAction::class);
            $group->get("/productsByCategory/{id}", \App\Ecommerce\Controller\API\Product\ProductByCategory\ProductListingAction::class);

            $group->get("/category", \App\Ecommerce\Controller\API\Category\CategoryListingAction::class);

            $group->post("/contact", \App\Ecommerce\Controller\API\Contact\SendEmail::class);
        })->add(AuthMiddleware::class);

        $app->run();
    }
}
