<?php

namespace App\Ecommerce\Controller\API\Product\products;

use App\Ecommerce\Model\Product;
use App\Ecommerce\Repository\ProductRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ProductUpdatingAction
{
    private $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        $data = json_decode($request->getBody()->getContents(), true);
        if (is_null($data)) {
            $response->getBody()->write(json_encode([
                'status' => 'error',
                'message' => 'Invalid JSON data'
            ]));
            return $response->withHeader('Content-Type', 'application/json');
        }


        $requiredFields = ['name', 'price', 'imgURL', 'brand', 'description', 'category'];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                $response->getBody()->write(json_encode([
                    'status' => 'error',
                    'message' => "Missing required field: $field"
                ]));
                return $response->withHeader('Content-Type', 'application/json');
            }
        }

        $product = new Product();
        $product->setProductID($id);
        $product->setName($data['name']);
        $product->setCategory($data['category']);
        $product->setPrice($data['price']);
        $product->setImgURL($data['imgURL']);
        $product->setBrand($data['brand']);
        $product->setDescription($data['description']);

        $this->productRepo->update($product);

        $response->getBody()->write(json_encode([
            'status' => 'success',
            'message' => 'Dữ liệu đã được cập nhật thành công',
            'data' => $data
        ]));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
