<?php
namespace App\Ecommerce\Controller\Front;

use App\Ecommerce\Controller\CheckPermission;
use App\Ecommerce\Repository\ProductRepository;

class ProductController extends CheckPermission
{
    private $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function index()
    {
        $genres = $this->productRepo->getAll();
        print_r($genres);
    }

    public function viewProduct($id)
    {
        $genre = $this->productRepo->getProductByID($id);
        print_r($genre);
    }
}