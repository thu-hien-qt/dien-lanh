<?php
namespace App\Ecommerce\Kernel;

class Router
{
    public function routing($controller, $action)
    {
        $mapping = [
            "admin.home" => [
                "index" => [
                    "class" => \App\Ecommerce\Controller\Admin\HomeController::class,
                    "function" => "index"
                ]
            ],

            "front.home" => [
                "index" => [
                    "class" => \App\Ecommerce\Controller\Front\HomeController::class,
                    "function" => "index"
                ]
            ]
        ];
        
        if (empty($mapping[$controller][$action])) {
            throw new \Exception("Route not found : controller $controller, action $action");
        }
        return $mapping[$controller][$action];
    }

    public function redirect($controller, $action) {
        header("location:index.php?controller=$controller&action=$action");
    }
}