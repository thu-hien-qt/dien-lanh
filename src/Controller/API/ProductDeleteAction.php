<?php

namespace App\Ecommerce\Controller\API;

use App\Ecommerce\Repository\ProductRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ProductDeleteAction
{
    private $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        $this->productRepo->delete($id);

        $response->getBody()->write(json_encode([
            'status' => 'success',
            'message' => 'Dữ liệu đã được xoá thành công',
            'productID' => $id
        ]));
        
        return $response->withHeader('Content-Type', 'application/json');
    }
}