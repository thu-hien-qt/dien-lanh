<?php

namespace App\Ecommerce\Kernel;

class Router
{
    public function routing()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        $mapping = $this->getMapping();

        foreach ($mapping as $item) {

            if ($method !== $item['method']) {
                continue;
            }

            $route = $item['route'];
            $params = $this->match($route, $uri);
            $route = [];
            if ($params !== false) {
                $route["class"] = $item['class'];
                $route["function"] = $item['function'];
                $route["params"] = $params;
                return $route;
            }
        }

        return null;
    }

    private function getMapping()
    {
        return [
            [
                "route" => "admin",
                "method" => "GET",
                "class" => \App\Ecommerce\Controller\Admin\HomeController::class,
                "function" => "index"
            ],
            [
                "route" => "admin/product/{id}",
                "method" => "GET",
                "class" => \App\Ecommerce\Controller\Admin\ProductController::class,
                "function" => "viewProduct"
            ],


            [
                "route" => "/",
                "method" => "GET",
                "class" => \App\Ecommerce\Controller\Front\HomeController::class,
                "function" => "index"
            ]
        ];
    }

    public function redirect($controller, $action)
    {
        header("location:index.php?controller=$controller&action=$action");
    }

    private function match(string $route, string $uri)
    {
        $route = '/' . trim($route, '/');
        $uri = '/'. trim($uri, '/');

        $pattern = preg_replace("/\{([^{}]+)}/", "(?<$1>[^/]+)", $route);
        $pattern = "#^" . $pattern . "$#";

        if(preg_match($pattern, $uri, $matches)) {
            $params = [];
            foreach ($matches as $key => $value) {
                if (!is_int($key)) {
                    $params[$key] = $value;
                } else {
                    $params[] = $value;
                }
            }
            return $params;
        }

        return false;
    }
}