<?php

namespace App\Ecommerce\Controller\API\Category;

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
        // Lấy danh sách tất cả các danh mục
        $categories = $this->categoryRepo->getAll();

        // Tạo mảng dữ liệu để trả về API dưới dạng JSON
        $categoryData = [];
        foreach ($categories as $category) {
            $categoryData[] = [
                'id' => $category->getID(),
                'name' => $category->getName(),
            ];
        }
        
        $response->withHeader("Content-Type", "application/json")->getBody()
            ->write(json_encode($categoryData));
        return $response;
    }



}