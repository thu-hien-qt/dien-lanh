<?php

namespace App\Ecommerce\Controller\API;

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
    public function __invoke(Request $request, Response $response)
    {
        $products = $this->productRepo->get10();
        $productData = [];
        foreach($products as $product) {
            $data = [
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'imgURL' => $product->getImgURL(),
            'brand' => $product->getBrand(),
            'description' => $product->getDescription(),
            'category' => $product->getCategory(),
            ];
            $productData[] = $data;
        }
        $response->withHeader("Content-Type", "application/json")->getBody()
            ->write(json_encode($productData));
        return $response;
    }
}