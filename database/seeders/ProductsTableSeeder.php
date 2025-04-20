<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'iPhone 13 Pro',
                'description' => 'The latest iPhone with A15 Bionic chip and Pro camera system.',
                'price' => 999.99,
                'stock_quantity' => 50,
                'is_active' => true,
                'categories' => [5], // Smartphones
            ],
            [
                'name' => 'MacBook Pro 14"',
                'description' => 'Powerful laptop with M1 Pro chip and Liquid Retina XDR display.',
                'price' => 1999.99,
                'stock_quantity' => 30,
                'is_active' => true,
                'categories' => [6], // Laptops
            ],
            [
                'name' => 'Men\'s Casual Shirt',
                'description' => 'Comfortable cotton shirt for casual occasions.',
                'price' => 29.99,
                'stock_quantity' => 100,
                'is_active' => true,
                'categories' => [7], // Men's Clothing
            ],
            [
                'name' => 'Women\'s Summer Dress',
                'description' => 'Lightweight dress perfect for summer.',
                'price' => 49.99,
                'stock_quantity' => 75,
                'is_active' => true,
                'categories' => [8], // Women's Clothing
            ],
            [
                'name' => 'Dining Table Set',
                'description' => '6-seater dining table with chairs.',
                'price' => 599.99,
                'stock_quantity' => 15,
                'is_active' => true,
                'categories' => [9], // Furniture
            ],
            [
                'name' => 'Blender',
                'description' => 'High-speed blender for smoothies and food preparation.',
                'price' => 79.99,
                'stock_quantity' => 40,
                'is_active' => true,
                'categories' => [10], // Kitchen
            ],
        ];

        foreach ($products as $productData) {
            $productData['slug'] = Str::slug($productData['name']);
            $categories = $productData['categories'];
            unset($productData['categories']);

            $product = Product::create($productData);
            $product->categories()->attach($categories);
        }
    }
}
