<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ProductService;
use App\Services\CategoryService;
use Livewire\WithPagination;

class ProductListing extends Component
{
    use WithPagination;

    private ProductService $productService;
    private CategoryService $categoryService;

    public $categories;
    public $featuredProducts;

    public $search = '';
    public $category = '';
    public $sort = 'latest';

    protected $queryString = [
        'search' => ['except' => '', 'as' => 'q'],
        'category' => ['except' => '', 'as' => 'cat'],
        'sort' => ['except' => 'latest', 'as' => 's'],
    ];

    public function boot(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function mount()
    {
        $this->category = request()->query('category', '');
        $this->categories = $this->categoryService->all();
        $this->featuredProducts = $this->productService->getFeaturedProducts();
    }

    public function render()
    {
        $filters = $this->getFilters();

        $products = $this->productService->getProductsWithFilters($filters);

        return view('livewire.product-listing', [
            'products' => $products->items(), // Only pass the items
            'pagination' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'prev_page_url' => $products->previousPageUrl(),
                'next_page_url' => $products->nextPageUrl(),
            ],
            'categories' => $this->categories,
            'featuredProducts' => $this->featuredProducts,
        ])->extends('layouts.app')
            ->section('content');
    }

    public function updated($property)
    {
        if (in_array($property, ['search', 'category', 'sort'])) {
            $this->resetPage();
        }
    }

    protected function getFilters(): array
    {
        return [
            'search' => $this->search,
            'category' => $this->category,
            'sort' => $this->getSortOption(),
            'per_page' => 12, // Make sure this matches your blade
        ];
    }

    protected function getSortOption(): string
    {
        return match ($this->sort) {
            'price_low' => 'price_asc',
            'price_high' => 'price_desc',
            'name_asc' => 'name_asc',
            'name_desc' => 'name_desc',
            default => 'created_at_desc',
        };
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();
    }
}
