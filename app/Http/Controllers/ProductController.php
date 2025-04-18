<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
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
     * Display product listing with filters
     */
    public function index(Request $request): View
    {
        $filters = [
            'search' => $request->input('search'),
            'category' => $request->input('category'),
            'sort' => $request->input('sort'),
            'min_price' => $request->input('min_price'),
            'max_price' => $request->input('max_price')
        ];

        return view('products.index', [
            'products' => $this->productService->getProductsWithFilters($filters),
            'categories' => $this->categoryService->getCategoryTree(),
            'filters' => $filters
        ]);
    }

    /**
     * Display single product details
     */
    public function show(string $slug): View
    {
        $product = $this->productService->findBySlug($slug);
        $relatedProducts = $this->productService->getRelatedProducts($product);

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ]);
    }
}
