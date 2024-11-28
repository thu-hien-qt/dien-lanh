<?php

namespace App\Ecommerce\Controller\API\Listing;

use App\Ecommerce\DTO\CategoryDto;
use App\Ecommerce\Repository\CategoryRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CategoryListingAction
{
    private $categoryRepo;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }
    public function __invoke(Request $request, Response $response)
    {
        $categories = $this->categoryRepo->getAll();

        $categoryData = [];
        foreach ($categories as $category) {
            $categoryData[] = new CategoryDto($category);
        }
        
        $response->withHeader("Content-Type", "application/json")->getBody()
            ->write(json_encode($categoryData));
        return $response;
    }



}