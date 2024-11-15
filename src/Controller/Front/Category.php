<?php
namespace App\Ecommerce\Controller\Front;

use App\Ecommerce\Controller\CheckPermission;
use App\Ecommerce\Repository\CategoryRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class Category extends CheckPermission
{
    private $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function __invoke(Request $request, Response $response, $args)
    {
        
        $category = $this->categoryRepo->getAll();
        var_dump($category);
        return $response;
    }
}