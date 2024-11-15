<?php

namespace App\Ecommerce\Controller\API\Product\ProductByCategory;

use App\Ecommerce\DTO\ProductDto;
use App\Ecommerce\Repository\ProductRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ProductListingAction
{
    private $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    public function __invoke(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        $products = $this->productRepo->getProductByCategoryID($id);
        $productData = [];
        foreach($products as $product) {
            $productDto = new ProductDto($product);
            $productData[] = $productDto;
        }
        $response->withHeader("Content-Type", "application/json")->getBody()
            ->write(json_encode($productData));
        return $response;
    }
}