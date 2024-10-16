<?php

namespace App\Ecommerce\Controller\API;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ProductListingAction
{

    public function __invoke(Request $request, Response $response)
    {
        $data = ["exemple" => "abc"]; // todo change this

        $response->withHeader("Content-Type", "application/json")->getBody()
            ->write(json_encode($data));

        return $response;
    }
}