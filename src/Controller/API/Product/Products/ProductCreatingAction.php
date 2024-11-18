<?php

namespace App\Ecommerce\Controller\API\Product\products;

use App\Ecommerce\Model\Product;
use App\Ecommerce\Repository\ProductRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ProductCreatingAction
{
    private $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function __invoke(Request $request, Response $response)
    {
        $data = json_decode($request->getBody()->getContents(), true);
    
        if (is_null($data)) {
            $response->getBody()->write(json_encode([
                'status' => 'error',
                'message' => 'Invalid JSON data'
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
        
        $requiredFields = ['name', 'price', 'imgURL', 'brand', 'description', 'category'];
        
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                $response->getBody()->write(json_encode([
                    'status' => 'error',
                    'message' => "Missing required field: $field"
                ]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(400); // Trả về HTTP status code 400 (Bad Request)
            }
        }
    
        $product = new Product();
        $product->setName($data['name']);
        $product->setCategory($data['category']);
        $product->setPrice($data['price']);
        $product->setImgURL($data['imgURL']);
        $product->setBrand($data['brand']);
        $product->setDescription($data['description']);
    
        $this->productRepo->insert($product);
    
        $response->getBody()->write(json_encode([
            'status' => 'success',
            'message' => 'Dữ liệu đã được nhận và lưu thành công',
            'data' => $data
        ]));
        
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}