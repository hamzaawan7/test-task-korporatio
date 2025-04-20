<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ProductService;
use App\Services\CategoryService;

class HomePage extends Component
{
    public $featuredProducts;
    public $categories;

    protected ProductService $productService;

    public function mount(
        ProductService $productService,
        CategoryService $categoryService
    ) {
        $this->productService = $productService;

        $this->featuredProducts = $productService->getFeaturedProducts(8);
        $this->categories = $categoryService->getCategoryTree();
    }

    public function getLatestProductsProperty()
    {
        return $this->productService->getProductsWithFilters([
            'sort' => 'latest',
            'limit' => 8
        ]);
    }

    public function render()
    {
        return view('livewire.home-page')
            ->with([
                'latestProducts' => $this->latestProducts,
            ])
            ->extends('layouts.app')
            ->section('content');
    }
}

