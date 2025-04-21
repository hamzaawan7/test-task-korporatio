<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\CategoryService;

class ProductDetails extends Component
{
    public $product;
    public $relatedProducts;

    public function mount(string $slug)
    {
        $this->product = Product::where('slug', $slug)->firstOrFail();

        $this->relatedProducts = app(ProductService::class)->getRelatedProducts($this->product);
    }

    public function render()
    {
        return view('livewire.product-details')->extends('layouts.app')
            ->section('content');
    }
}

