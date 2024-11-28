<?php

namespace App\Ecommerce\Controller\API\Product;

use App\Ecommerce\DTO\ProductDto;
use App\Ecommerce\Repository\ProductRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ProductByIdAction
{
    private $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    public function __invoke(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        $product = $this->productRepo->getProductByID($id);

        $productData = new ProductDto($product);
        $response->withHeader("Content-Type", "application/json")->getBody()
            ->write(json_encode($productData));
        return $response;
    }
}