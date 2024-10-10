<?php

namespace App\Ecommerce\Controller\Admin\Template;

use App\Ecommerce\Repository\ProductRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ViewAction {
    private $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    
    public function __invoke(Request $request, Response $response, $args)
    {
        
        $product = $this->productRepo->getProductByID($args["id"]);
        print_r($product);
        return $response;
    }
}