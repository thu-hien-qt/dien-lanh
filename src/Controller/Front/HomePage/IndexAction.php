<?php
namespace App\Ecommerce\Controller\Front\HomePage;

use App\Ecommerce\Repository\ProductRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class IndexAction {
    
    private $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    
    public function __invoke(Request $request, Response $response)
    {
        
        $genres = $this->productRepo->getAll();
        print_r($genres);
        // $response->getBody()->write("Hello World");
        require_once "../template/public/index.php";
        return $response;
    }
}