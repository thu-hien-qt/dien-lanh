<?php

namespace App\Ecommerce\Controller\API;

use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class AuthMiddleware
{
    public function __invoke(Request $request, RequestHandlerInterface $handler): Response
    {
        $ok = true; // todo

        if (!$ok) {
            $response = new Response();
            $response->getBody()->write(json_encode(["error" => "Unauthorized"]));
            return $response->withStatus(401);
        }

        $response = $handler->handle($request);

        return $response;
    }
}

