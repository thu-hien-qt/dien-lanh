<?php

namespace App\Ecommerce\Controller\API;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ProductCreatingAction
{

    public function __invoke(Request $request, Response $response)
    {
        // todo create the product
        $get = $_GET;
        $post = $_POST;

        $body = file_get_contents('php://input');
        $body = json_decode($body);

        $response->withHeader("Content-Type", "application/json")->getBody()
            ->write(json_encode(["get"=>$get,"post"=>$post, "body"=>$body]));

        return $response;
    }
}