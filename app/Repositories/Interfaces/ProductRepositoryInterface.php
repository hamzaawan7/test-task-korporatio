<?php

namespace App\Repositories\Interfaces;

use App\Models\Product;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function getFeaturedProducts($limit = 5);
    public function getProductsByCategory($categoryId);
    public function searchProducts($query);
    public function getProductsWithFilters($filters);

    public function findBySlug(string $slug);
    public function getRelatedProducts(Product $product, int $limit = 4);
}
