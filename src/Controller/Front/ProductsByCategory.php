<?php
namespace App\Ecommerce\Controller\Front;

use App\Ecommerce\Controller\CheckPermission;
use App\Ecommerce\Repository\ProductRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ProductsByCategory extends CheckPermission
{
    private $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function __invoke(Request $request, Response $response, $args)
    {
        $id = $args["id"];
        $product = $this->productRepo->getProductByCategoryID($id);
        print_r($id);
        return $response;
    }
}