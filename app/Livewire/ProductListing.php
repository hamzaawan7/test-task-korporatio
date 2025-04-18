<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ProductService;
use App\Services\CategoryService;
use Livewire\WithPagination;

class ProductListing extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $sort = 'latest';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'sort' => ['except' => 'latest'],
    ];

    public function render(ProductService $productService, CategoryService $categoryService)
    {
        $filters = [
            'search' => $this->search,
            'category' => $this->category,
            'sort' => $this->getSortOption(),
        ];

        return view('livewire.product-listing', [
            'products' => $productService->getProductsWithFilters($filters),
            'categories' => $categoryService->all(),
            'featuredProducts' => $productService->getFeaturedProducts(),
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingSort()
    {
        $this->resetPage();
    }

    protected function getSortOption()
    {
        switch ($this->sort) {
            case 'price_low': return 'price_asc';
            case 'price_high': return 'price_desc';
            case 'name_asc': return 'name_asc';
            case 'name_desc': return 'name_desc';
            default: return null;
        }
    }
}
