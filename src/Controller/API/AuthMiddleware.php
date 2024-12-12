<?php

namespace App\Ecommerce\Controller\API;

use App\Ecommerce\Database;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class AuthMiddleware
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function __invoke(Request $request, RequestHandlerInterface $handler): Response
    {
        $authHeader = $request->getHeader('Authorization')[0] ?? '';

        if (strpos($authHeader, 'Bearer ') === 0) {
            $apiKey = substr($authHeader, 7);

            $stmt = $this->database->prepare("SELECT * FROM api_keys WHERE api_key = :apiKey");
            $stmt->execute([":apiKey" => $apiKey]);
            $keyRecord = $stmt->fetch();

            if ($keyRecord) {
                return $handler->handle($request);
            } else {
                $response = new Response();
                $response->getBody()->write(json_encode(["error" => 'Unauthorized - Invalid Authorization header']));
                return $response->withStatus(401);
            }
        }

        if (strpos($authHeader, 'Basic ') === 0) {
            $response = new Response();
            $response->getBody()->write(json_encode(["error" => 'Unauthorized - Invalid Authorization header']));
            return $response->withStatus(401);
        }

        $base = substr($authHeader, 6);
        $base = base64_decode($base);

        list($username, $password) = explode(':', $base, 2);

        $stmt = $this->database->prepare("SELECT * FROM users WHERE username = :username AND  password = :password");
        $stmt->execute([":username" => $username,
                        ":password" => $password]);
        $user = $stmt->fetch();

        if (!$user) {
            $response = new Response();
            $response->getBody()->write(json_encode(["error" => 'Unauthorized - Invalid Authorization header']));
            return $response->withStatus(401);
        }

        $api_key = bin2hex(random_bytes(16));

        $this->database->prepare("INSERT INTO api_keys (api_key, user_id) VALUES (:api_key, :user_id)")
                 ->execute([":api_key" => $api_key, ":user_id" => $user['user_id']]);

        $response = new Response();
        $response->getBody()->write(json_encode(['api_key' => $api_key]));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
