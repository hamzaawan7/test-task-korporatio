<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductCard extends Component
{
    public Product $product;

    public function render()
    {
        return view('livewire.product-card');
    }

    public function addToCart()
    {
        $this->emit('productAddedToCart', $this->product->id);
    }
}
