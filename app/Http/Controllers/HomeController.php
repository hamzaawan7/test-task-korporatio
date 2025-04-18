<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(
        ProductService $productService,
        CategoryService $categoryService
    ) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display the homepage with featured content
     */
    public function index(): View
    {
        return view('home', [
            'featuredProducts' => $this->productService->getFeaturedProducts(8),
            'categories' => $this->categoryService->getCategoryTree(),
            'latestProducts' => $this->productService->getProductsWithFilters([
                'sort' => 'latest',
                'limit' => 8
            ])
        ]);
    }
}
